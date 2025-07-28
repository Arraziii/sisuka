package usecase

import (
	"context"
	"encoding/json"
	"errors"
	"fmt"
	"log"

	"github.com/Bangdams/web-profile-API/internal/entity"
	"github.com/Bangdams/web-profile-API/internal/model"
	"github.com/Bangdams/web-profile-API/internal/model/converter"
	"github.com/Bangdams/web-profile-API/internal/repository"
	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
	"gorm.io/gorm"
)

type StaffStructureUsecase interface {
	Create(ctx context.Context, request *model.StaffStructureCreateRequest) (*model.StaffStructureResponse, error)
	UpdateBatch(ctx context.Context, requests []*model.StaffStructureUpdateRequest) ([]*model.StaffStructureResponse, []string, error)
	FindByType(ctx context.Context, typeName string) (*model.StaffStructureResponse, error)
	FindById(ctx context.Context, staffId int) (*model.StaffStructureResponse, error)
	FindAll(ctx context.Context) (*[]model.StaffStructureResponse, error)
}

type StaffStructureUsecaseImpl struct {
	StaffStructureRepo repository.StaffStructureRepository
	DB                 *gorm.DB
	Validate           *validator.Validate
}

func NewStaffStructureUsecase(dataDynamicRepo repository.StaffStructureRepository, DB *gorm.DB, validate *validator.Validate) StaffStructureUsecase {
	return &StaffStructureUsecaseImpl{
		StaffStructureRepo: dataDynamicRepo,
		DB:                 DB,
		Validate:           validate,
	}
}

// FindAll implements StaffStructureUsecase.
func (staffStructureUsecase *StaffStructureUsecaseImpl) FindAll(ctx context.Context) (*[]model.StaffStructureResponse, error) {
	tx := staffStructureUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	staffStructures := new([]entity.StaffStructure)

	if err := staffStructureUsecase.StaffStructureRepo.FindAll(tx, staffStructures); err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "StaffStructure data was not found",
				Details: []string{},
			}

			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error find by id staffStructure usecase : ", err)

			return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		} else {
			log.Println("Error find by id staffStructure usecase:", err)
			return nil, fiber.ErrInternalServerError
		}
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}

	return converter.StaffStructureToResponses(staffStructures), nil
}

// FindById implements StaffStructureUsecase.
func (staffStructureUsecase *StaffStructureUsecaseImpl) FindById(ctx context.Context, staffId int) (*model.StaffStructureResponse, error) {
	tx := staffStructureUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	staffStructure := new(entity.StaffStructure)
	staffStructure.ID = uint(staffId)

	if err := staffStructureUsecase.StaffStructureRepo.FindById(tx, staffStructure); err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "StaffStructure data was not found",
				Details: []string{},
			}

			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error find by id staffStructure usecase : ", err)

			return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		} else {
			log.Println("Error find by id staffStructure usecase:", err)
			return nil, fiber.ErrInternalServerError
		}
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}
	return converter.StaffStructureToResponse(staffStructure), nil
}

// Create implements StaffStructureUsecase.
func (staffStructureUsecase *StaffStructureUsecaseImpl) Create(ctx context.Context, request *model.StaffStructureCreateRequest) (*model.StaffStructureResponse, error) {
	tx := staffStructureUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	errorResponse := &model.ErrorResponse{}

	err := staffStructureUsecase.Validate.Struct(request)
	if err != nil {
		var validationErrors []string
		for _, e := range err.(validator.ValidationErrors) {
			msg := fmt.Sprintf("Field '%s' failed on '%s' rule", e.Field(), e.Tag())
			validationErrors = append(validationErrors, msg)
		}

		errorResponse.Message = "invalid request parameter"
		errorResponse.Details = validationErrors

		jsonString, _ := json.Marshal(errorResponse)

		log.Println("error create staffStructure : ", err)

		return nil, fiber.NewError(fiber.ErrBadRequest.Code, string(jsonString))
	}

	staffStructure := &entity.StaffStructure{
		Type: request.Type,
	}

	err = staffStructureUsecase.StaffStructureRepo.FindByType(tx, staffStructure)
	if err == nil {
		errorResponse := model.ErrorResponse{
			Message: "Duplicate data",
			Details: []string{},
		}

		jsonString, _ := json.Marshal(errorResponse)

		log.Println("error staffStructure usecase : ", err)

		return nil, fiber.NewError(fiber.ErrConflict.Code, string(jsonString))
	}

	staffStructure.Name = request.Name
	staffStructure.Image = request.Image

	if err := staffStructureUsecase.StaffStructureRepo.Create(tx, staffStructure); err != nil {
		log.Println("failed when create repo staffStructure : ", err)
		return nil, fiber.ErrInternalServerError
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}

	log.Println("success create from usecase staffStructure")
	return converter.StaffStructureToResponse(staffStructure), nil
}

// FindByType implements StaffStructureUsecase.
func (staffStructureUsecase *StaffStructureUsecaseImpl) FindByType(ctx context.Context, typeName string) (*model.StaffStructureResponse, error) {
	tx := staffStructureUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	staffStructure := new(entity.StaffStructure)
	staffStructure.Type = typeName

	if err := staffStructureUsecase.StaffStructureRepo.FindByType(tx, staffStructure); err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "Staff Structure data was not found",
				Details: []string{},
			}

			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error find by type staffStructure usecase : ", err)

			return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		} else {
			log.Println("Error find by type staffStructure usecase:", err)
			return nil, fiber.ErrInternalServerError
		}
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}
	return converter.StaffStructureToResponse(staffStructure), nil
}

// UpdateBatch implements StaffStructureUsecase.
var ErrStaffNotFound = errors.New("data staf tidak ditemukan")

func (usecase *StaffStructureUsecaseImpl) UpdateBatch(ctx context.Context, requests []*model.StaffStructureUpdateRequest) ([]*model.StaffStructureResponse, []string, error) {
	tx := usecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	if tx.Error != nil {
		log.Println("Gagal memulai transaksi:", tx.Error)
		return nil, nil, tx.Error
	}

	var responses []*model.StaffStructureResponse
	var oldImagesToDelete []string

	for _, request := range requests {
		err := usecase.Validate.Struct(request)
		if err != nil {
			log.Println("Error validasi request:", err.(validator.ValidationErrors))
			return nil, nil, fmt.Errorf("request tidak valid untuk ID %d", request.ID)
		}

		staff := new(entity.StaffStructure)
		err = usecase.StaffStructureRepo.FindByIdAndType(tx, staff, request.ID, request.Type)
		if err != nil {
			if errors.Is(err, gorm.ErrRecordNotFound) {
				return nil, nil, fmt.Errorf("%w: dengan ID %d dan tipe %s", ErrStaffNotFound, request.ID, request.Type)
			}
			log.Println("Error repo FindByIdAndType:", err)
			return nil, nil, err
		}

		oldImage := staff.Image
		staff.Name = request.Name

		if request.Image != "" {
			staff.Image = request.Image
			if oldImage != "" {
				oldImagesToDelete = append(oldImagesToDelete, oldImage)
			}
		}

		if err := usecase.StaffStructureRepo.Update(tx, staff); err != nil {
			log.Println("Gagal update repo staff:", err)
			return nil, nil, err
		}

		responses = append(responses, converter.StaffStructureToResponse(staff))
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Gagal commit transaksi:", err)
		return nil, nil, err
	}

	return responses, oldImagesToDelete, nil
}
