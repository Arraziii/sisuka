package usecase

import (
	"context"
	"encoding/json"
	"errors"
	"fmt"
	"log"
	"math"
	"os"
	"path/filepath"
	"strings"

	"github.com/Bangdams/web-profile-API/internal/entity"
	"github.com/Bangdams/web-profile-API/internal/model"
	"github.com/Bangdams/web-profile-API/internal/model/converter"
	"github.com/Bangdams/web-profile-API/internal/repository"
	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
	"gorm.io/gorm"
)

type ContentUsecase interface {
	Create(ctx context.Context, request *model.ContentCreateRequest) (*model.ContentResponse, error)
	Update(ctx context.Context, request *model.ContentUpdateRequest) (*model.ContentResponse, error)
	Delete(ctx context.Context, contentId uint) error
	// FindAll(ctx context.Context, order string, category string, page int) (*[]model.ContentResponse, int, int, int, error)
	FindWithLimit(ctx context.Context, order string, category string) (*[]model.ContentResponse, error)
	FindById(ctx context.Context, contentId uint) (*model.ContentResponse, error)
	Search(ctx context.Context, page int, search string, category string, startDate string, endDate string, order string) (*[]model.ContentResponse, int, int, int, error)
}

type ContentUsecaseImpl struct {
	ContentRepo  repository.ContentRepository
	AdminRepo    repository.AdminRepository
	CategoryRepo repository.CategoryRepository
	DB           *gorm.DB
	Validate     *validator.Validate
}

func NewContentUsecase(contentRepo repository.ContentRepository, adminRepo repository.AdminRepository, categoryRepo repository.CategoryRepository, DB *gorm.DB, validate *validator.Validate) ContentUsecase {
	return &ContentUsecaseImpl{
		ContentRepo:  contentRepo,
		AdminRepo:    adminRepo,
		CategoryRepo: categoryRepo,
		DB:           DB,
		Validate:     validate,
	}
}

// Search implements ContentUsecase.
func (contentUsecase *ContentUsecaseImpl) Search(ctx context.Context, page int, search string, category string, startDate string, endDate string, order string) (*[]model.ContentResponse, int, int, int, error) {
	dbConnection := contentUsecase.DB.WithContext(ctx)

	var contents []entity.Content
	pageSize := 8

	if page <= 0 {
		page = 1
	}

	offset := (page - 1) * pageSize
	var totalRecords int64

	err := contentUsecase.ContentRepo.Search(
		dbConnection,
		&totalRecords,
		pageSize,
		offset,
		search,
		category,
		startDate,
		endDate,
		strings.ToUpper(order),
		&contents,
	)

	if err != nil {
		log.Printf("failed when search repo content: %v", err)
		return nil, 0, 0, 0, fiber.ErrInternalServerError
	}

	totalPages := 0
	if totalRecords > 0 {
		totalPages = int(math.Ceil(float64(totalRecords) / float64(pageSize)))
	}

	log.Println("success search from usecase content")

	contentResponses := converter.ContentToResponses(&contents)

	return contentResponses, page, int(totalRecords), totalPages, nil
}

// Create implements ContentUsecase.
func (contentUsecase *ContentUsecaseImpl) Create(ctx context.Context, request *model.ContentCreateRequest) (*model.ContentResponse, error) {
	tx := contentUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	errorResponse := &model.ErrorResponse{}

	err := contentUsecase.Validate.Struct(request)
	if err != nil {
		var validationErrors []string
		for _, e := range err.(validator.ValidationErrors) {
			msg := fmt.Sprintf("Field '%s' failed on '%s' rule", e.Field(), e.Tag())
			validationErrors = append(validationErrors, msg)
		}

		errorResponse.Message = "invalid request parameter"
		errorResponse.Details = validationErrors

		jsonString, _ := json.Marshal(errorResponse)

		log.Println("error create content : ", err)

		return nil, fiber.NewError(fiber.ErrBadRequest.Code, string(jsonString))
	}

	content := &entity.Content{
		Title:      request.Title,
		Content:    request.Content,
		Image:      request.Image,
		CategoryId: request.CategoryId,
		CreatedBy:  request.CreatedBy,
	}

	category := &entity.Category{
		ID: request.CategoryId,
	}

	if err := contentUsecase.CategoryRepo.FindById(tx, category); err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "Admin data was not found",
				Details: []string{},
			}

			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error find by id content usecase : ", err)

			return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		} else {
			log.Println("Error find by id content usecase:", err)
			return nil, fiber.ErrInternalServerError
		}
	}

	if err := contentUsecase.ContentRepo.Create(tx, content); err != nil {
		log.Println("failed when create repo content : ", err)
		return nil, fiber.ErrInternalServerError
	}

	admin := &entity.Admin{
		ID: request.CreatedBy,
	}

	if err := contentUsecase.AdminRepo.FindById(tx, admin); err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "Admin data was not found",
				Details: []string{},
			}

			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error find by id content usecase : ", err)

			return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		} else {
			log.Println("Error find by id content usecase:", err)
			return nil, fiber.ErrInternalServerError
		}
	}

	content.Admin = *admin
	content.Category = *category

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}

	log.Println("success create from usecase content")
	return converter.ContentToResponse(content), nil
}

// Delete implements ContentUsecase.
func (contentUsecase *ContentUsecaseImpl) Delete(ctx context.Context, contentId uint) error {
	tx := contentUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	content := &entity.Content{
		ID: contentId,
	}

	err := contentUsecase.ContentRepo.FindById(tx, content)
	if err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "content data was not found",
				Details: []string{},
			}
			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error delete content : ", err)

			return fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		}

		log.Println("error delete content : ", err)
		return fiber.ErrInternalServerError
	}

	err = contentUsecase.ContentRepo.Delete(tx, content)
	if err != nil {
		log.Println("failed when delete repo content : ", err)
		return fiber.ErrInternalServerError
	}

	filePath := filepath.Join("./upload", content.Image)
	os.Remove(filePath)

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return fiber.ErrInternalServerError
	}

	log.Println("success delete from usecase content")

	return nil
}

// FindAll implements ContentUsecase.
// func (contentUsecase *ContentUsecaseImpl) FindAll(ctx context.Context, order string, category string, page int) (*[]model.ContentResponse, int, int, int, error) {
// 	tx := contentUsecase.DB.WithContext(ctx).Begin()
// 	defer tx.Rollback()

// 	var contents = &[]entity.Content{}

// 	if category != "" {
// 		categoryEntity := &entity.Category{
// 			Name: category,
// 		}

// 		err := contentUsecase.CategoryRepo.FindByName(tx, categoryEntity)
// 		if err != nil {
// 			if errors.Is(err, gorm.ErrRecordNotFound) {
// 				errorResponse := model.ErrorResponse{
// 					Message: "Category data was not found",
// 					Details: []string{},
// 				}

// 				jsonString, _ := json.Marshal(errorResponse)

// 				log.Println("error find by name category usecase : ", err)

// 				return nil, 0, 0, 0, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
// 			} else {
// 				log.Println("Error find by name category usecase:", err)
// 				return nil, 0, 0, 0, fiber.ErrInternalServerError
// 			}
// 		}
// 	}

// 	// page
// 	pageSize := 8

// 	if page <= 0 {
// 		page = 1
// 	}
// 	if pageSize <= 0 {
// 		pageSize = 10
// 	}

// 	offset := (page - 1) * pageSize
// 	var totalRecords int64

// 	err := contentUsecase.ContentRepo.FindAll(tx, &totalRecords, strings.ToUpper(order), category, pageSize, offset, contents)
// 	if err != nil {
// 		log.Println("failed when find all repo content : ", err)
// 		return nil, 0, 0, 0, fiber.ErrInternalServerError
// 	}

// 	totalPages := int(math.Ceil(float64(totalRecords) / float64(pageSize)))

// 	if err := tx.Commit().Error; err != nil {
// 		log.Println("Failed commit transaction : ", err)
// 		return nil, 0, 0, 0, fiber.ErrInternalServerError
// 	}

// 	log.Println("success find all from usecase content")
// 	return converter.ContentToResponses(contents), page, int(totalRecords), totalPages, nil
// }

// FindWithLimit implements ContentUsecase.
func (contentUsecase *ContentUsecaseImpl) FindWithLimit(ctx context.Context, order string, category string) (*[]model.ContentResponse, error) {
	tx := contentUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	var contents = &[]entity.Content{}

	if category != "" {
		categoryEntity := &entity.Category{
			Name: category,
		}

		err := contentUsecase.CategoryRepo.FindByName(tx, categoryEntity)
		if err != nil {
			if errors.Is(err, gorm.ErrRecordNotFound) {
				errorResponse := model.ErrorResponse{
					Message: "Category data was not found",
					Details: []string{},
				}

				jsonString, _ := json.Marshal(errorResponse)

				log.Println("error find by name category usecase : ", err)

				return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
			} else {
				log.Println("Error find by name category usecase:", err)
				return nil, fiber.ErrInternalServerError
			}
		}
	}

	err := contentUsecase.ContentRepo.FindWithLimit(tx, strings.ToUpper(order), category, contents)
	if err != nil {
		log.Println("failed when FindWithLimit repo content : ", err)
		return nil, fiber.ErrInternalServerError
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}

	log.Println("success find FindWithLimitall from usecase content")
	return converter.ContentToResponses(contents), nil
}

// FindById implements ContentUsecase.
func (contentUsecase *ContentUsecaseImpl) FindById(ctx context.Context, contentId uint) (*model.ContentResponse, error) {
	tx := contentUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	content := new(entity.Content)
	content.ID = contentId

	if err := contentUsecase.ContentRepo.FindById(tx, content); err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "Content data was not found",
				Details: []string{},
			}

			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error find by id conten usecase : ", err)

			return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		} else {
			log.Println("Error find by id conten usecase:", err)
			return nil, fiber.ErrInternalServerError
		}
	}

	relatedArticles := &[]entity.Content{}
	err := contentUsecase.ContentRepo.GetRelatedArticle(tx, contentId, content.CategoryId, relatedArticles)
	if err != nil {
		log.Println("Error find relatedArticle usecase:", err)
		return nil, fiber.ErrInternalServerError
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}
	return converter.ContentDetailToResponse(content, relatedArticles), nil
}

// Update implements ContentUsecase.
func (contentUsecase *ContentUsecaseImpl) Update(ctx context.Context, request *model.ContentUpdateRequest) (*model.ContentResponse, error) {
	tx := contentUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	errorResponse := &model.ErrorResponse{}

	err := contentUsecase.Validate.Struct(request)
	if err != nil {
		var validationErrors []string
		for _, e := range err.(validator.ValidationErrors) {
			msg := fmt.Sprintf("Field '%s' failed on '%s' rule", e.Field(), e.Tag())
			validationErrors = append(validationErrors, msg)
		}

		errorResponse.Message = "invalid request parameter"
		errorResponse.Details = validationErrors

		jsonString, _ := json.Marshal(errorResponse)

		log.Println("error update content : ", err)

		return nil, fiber.NewError(fiber.ErrBadRequest.Code, string(jsonString))
	}

	content := &entity.Content{
		ID: request.ID,
	}

	if err := contentUsecase.ContentRepo.FindByIdForUpdate(tx, content); err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "Content data was not found",
				Details: []string{},
			}

			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error find by id Content usecase : ", err)

			return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		} else {
			log.Println("Error find by id Content usecase:", err)
			return nil, fiber.ErrInternalServerError
		}
	}

	category := &entity.Category{ID: request.CategoryId}
	if err := contentUsecase.CategoryRepo.FindById(tx, category); err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "Category data was not found",
				Details: []string{},
			}

			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error find by id Category usecase : ", err)

			return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		} else {
			log.Println("Error find by id Category usecase:", err)
			return nil, fiber.ErrInternalServerError
		}
	}

	content.Title = request.Title
	content.Content = request.Content
	oldImage := content.Image
	content.Image = request.Image
	content.CategoryId = request.CategoryId
	content.CreatedBy = request.CreatedBy

	log.Println(content.Title)
	log.Println(content.Image)
	log.Println(content.CategoryId)

	if err := contentUsecase.ContentRepo.Update(tx, content); err != nil {
		log.Println("failed when update repo content : ", err)
		return nil, fiber.ErrInternalServerError
	}

	if oldImage != content.Image {
		filePath := filepath.Join("./upload", oldImage)
		os.Remove(filePath)
	}

	content.Category = *category

	admin := &entity.Admin{
		ID: request.CreatedBy,
	}

	if err := contentUsecase.AdminRepo.FindById(tx, admin); err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "Admin data was not found",
				Details: []string{},
			}

			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error find by id content usecase : ", err)

			return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		} else {
			log.Println("Error find by id content usecase:", err)
			return nil, fiber.ErrInternalServerError
		}
	}

	content.Admin = *admin

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}

	log.Println("success update from usecase content")
	return converter.ContentToResponse(content), nil
}
