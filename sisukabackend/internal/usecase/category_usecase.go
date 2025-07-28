package usecase

import (
	"context"
	"encoding/json"
	"errors"
	"fmt"
	"log"
	"math"
	"strings"

	"github.com/Bangdams/web-profile-API/internal/entity"
	"github.com/Bangdams/web-profile-API/internal/model"
	"github.com/Bangdams/web-profile-API/internal/model/converter"
	"github.com/Bangdams/web-profile-API/internal/repository"
	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
	"gorm.io/gorm"
)

type CategoryUsecase interface {
	Create(ctx context.Context, request *model.CategoryCreateRequest) (*model.CategoryResponse, error)
	Update(ctx context.Context, request *model.CategoryUpdateRequest) (*model.CategoryResponse, error)
	Delete(ctx context.Context, categoryId uint) error
	Search(ctx context.Context, search string, order string, page int) (*[]model.CategoryResponse, int, int, int, error)
	FindById(ctx context.Context, categoryId uint) (*model.CategoryResponse, error)
}

type CategoryUsecaseImpl struct {
	CategoryRepo repository.CategoryRepository
	DB           *gorm.DB
	Validate     *validator.Validate
}

func NewCategoryUsecase(categoryRepo repository.CategoryRepository, DB *gorm.DB, validate *validator.Validate) CategoryUsecase {
	return &CategoryUsecaseImpl{
		CategoryRepo: categoryRepo,
		DB:           DB,
		Validate:     validate,
	}
}

// Create implements CategoryUsecase.
func (categoryUsecase *CategoryUsecaseImpl) Create(ctx context.Context, request *model.CategoryCreateRequest) (*model.CategoryResponse, error) {
	tx := categoryUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	errorResponse := &model.ErrorResponse{}

	err := categoryUsecase.Validate.Struct(request)
	if err != nil {
		var validationErrors []string
		for _, e := range err.(validator.ValidationErrors) {
			msg := fmt.Sprintf("Field '%s' failed on '%s' rule", e.Field(), e.Tag())
			validationErrors = append(validationErrors, msg)
		}

		errorResponse.Message = "invalid request parameter"
		errorResponse.Details = validationErrors

		jsonString, _ := json.Marshal(errorResponse)

		log.Println("error create category : ", err)

		return nil, fiber.NewError(fiber.ErrBadRequest.Code, string(jsonString))
	}

	err = categoryUsecase.CategoryRepo.FindByName(tx, &entity.Category{Name: request.Name})
	if err == nil {
		errorResponse := model.ErrorResponse{
			Message: "Duplicate data",
			Details: []string{},
		}

		jsonString, _ := json.Marshal(errorResponse)

		log.Println("error category usecase : ", err)

		return nil, fiber.NewError(fiber.ErrConflict.Code, string(jsonString))
	}

	category := &entity.Category{
		Name: request.Name,
	}

	if err := categoryUsecase.CategoryRepo.Create(tx, category); err != nil {
		log.Println("failed when create repo category : ", err)
		return nil, fiber.ErrInternalServerError
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}

	log.Println("success create from usecase category")
	return converter.CategoryToResponse(category), nil
}

// Delete implements CategoryUsecase.
func (categoryUsecase *CategoryUsecaseImpl) Delete(ctx context.Context, categoryId uint) error {
	tx := categoryUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	category := &entity.Category{
		ID: categoryId,
	}

	err := categoryUsecase.CategoryRepo.FindById(tx, category)
	if err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "category data was not found",
				Details: []string{},
			}
			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error delete category : ", err)

			return fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		}

		log.Println("error delete category : ", err)
		return fiber.ErrInternalServerError
	}

	err = categoryUsecase.CategoryRepo.Delete(tx, category)
	if err != nil {
		log.Println("failed when delete repo category : ", err)
		return fiber.ErrInternalServerError
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return fiber.ErrInternalServerError
	}

	log.Println("success delete from usecase category")

	return nil
}

// Search implements CategoryUsecase.
func (categoryUsecase *CategoryUsecaseImpl) Search(ctx context.Context, search string, order string, page int) (*[]model.CategoryResponse, int, int, int, error) {
	tx := categoryUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	var categories = &[]entity.Category{}

	// page
	pageSize := 5

	if page <= 0 {
		page = 1
	}
	if pageSize <= 0 {
		pageSize = 10
	}

	offset := (page - 1) * pageSize

	log.Println(offset)
	log.Println(pageSize)

	if order == "" {
		order = "DESC"
	}
	var totalRecords int64

	err := categoryUsecase.CategoryRepo.Search(tx, &totalRecords, search, strings.ToUpper(order), pageSize, offset, categories)
	if err != nil {
		log.Println("failed when find all repo category : ", err)
		return nil, 0, 0, 0, fiber.ErrInternalServerError
	}

	totalPages := int(math.Ceil(float64(totalRecords) / float64(pageSize)))

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, 0, 0, 0, fiber.ErrInternalServerError
	}

	log.Println("success find all from usecase category")
	return converter.CategoryoResponses(categories), page, int(totalRecords), totalPages, nil
}

// FindById implements CategoryUsecase.
func (categoryUsecase *CategoryUsecaseImpl) FindById(ctx context.Context, categoryId uint) (*model.CategoryResponse, error) {
	tx := categoryUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	category := new(entity.Category)
	category.ID = categoryId

	if err := categoryUsecase.CategoryRepo.FindById(tx, category); err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "Category data was not found",
				Details: []string{},
			}

			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error find by id category usecase : ", err)

			return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		} else {
			log.Println("Error find by id category usecase:", err)
			return nil, fiber.ErrInternalServerError
		}
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}
	return converter.CategoryToResponse(category), nil
}

// Update implements CategoryUsecase.
func (categoryUsecase *CategoryUsecaseImpl) Update(ctx context.Context, request *model.CategoryUpdateRequest) (*model.CategoryResponse, error) {
	tx := categoryUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	errorResponse := &model.ErrorResponse{}

	err := categoryUsecase.Validate.Struct(request)
	if err != nil {
		var validationErrors []string
		for _, e := range err.(validator.ValidationErrors) {
			msg := fmt.Sprintf("Field '%s' failed on '%s' rule", e.Field(), e.Tag())
			validationErrors = append(validationErrors, msg)
		}

		errorResponse.Message = "invalid request parameter"
		errorResponse.Details = validationErrors

		jsonString, _ := json.Marshal(errorResponse)

		log.Println("error update category : ", err)

		return nil, fiber.NewError(fiber.ErrBadRequest.Code, string(jsonString))
	}

	category := &entity.Category{
		ID: request.ID,
	}

	if err := categoryUsecase.CategoryRepo.FindById(tx, category); err != nil {
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

	if err := categoryUsecase.CategoryRepo.FindByName(tx, &entity.Category{Name: request.Name}); err == nil {
		errorResponse := model.ErrorResponse{
			Message: "Duplicate Data",
			Details: []string{},
		}

		jsonString, _ := json.Marshal(errorResponse)

		log.Println("error find by name Category usecase : ", err)

		return nil, fiber.NewError(fiber.ErrConflict.Code, string(jsonString))
	}

	category.Name = request.Name

	if err := categoryUsecase.CategoryRepo.Update(tx, category); err != nil {
		log.Println("failed when update repo category : ", err)
		return nil, fiber.ErrInternalServerError
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}

	return converter.CategoryToResponse(category), nil
}
