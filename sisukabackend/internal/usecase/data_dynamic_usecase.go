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

type DataDynamicUsecase interface {
	Update(ctx context.Context, request *model.DataDynamicBatchRequest) (*[]model.DataDynamicResponse, error)
	FindByType(ctx context.Context, typeName string) (*model.DataDynamicResponse, error)
}

type DataDynamicUsecaseImpl struct {
	DataDynamicRepo repository.DataDynamicRepository
	DB              *gorm.DB
	Validate        *validator.Validate
}

func NewDataDynamicUsecase(dataDynamicRepo repository.DataDynamicRepository, DB *gorm.DB, validate *validator.Validate) DataDynamicUsecase {
	return &DataDynamicUsecaseImpl{
		DataDynamicRepo: dataDynamicRepo,
		DB:              DB,
		Validate:        validate,
	}
}

// FindByType implements DataDynamicUsecase.
func (dataDynamicUsecase *DataDynamicUsecaseImpl) FindByType(ctx context.Context, typeName string) (*model.DataDynamicResponse, error) {
	tx := dataDynamicUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	dataDynamic := new(entity.DataDynamic)
	dataDynamic.Type = typeName

	if err := dataDynamicUsecase.DataDynamicRepo.FindByType(tx, dataDynamic); err != nil {
		if errors.Is(err, gorm.ErrRecordNotFound) {
			errorResponse := model.ErrorResponse{
				Message: "DataDynamic data was not found",
				Details: []string{},
			}

			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error find by type data dynamic usecase : ", err)

			return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
		} else {
			log.Println("Error find by type data dynamic usecase:", err)
			return nil, fiber.ErrInternalServerError
		}
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}

	return converter.DataDynamicToResponse(dataDynamic), nil
}

// Update implements DataDynamicUsecase.
func (dataDynamicUsecase *DataDynamicUsecaseImpl) Update(ctx context.Context, request *model.DataDynamicBatchRequest) (*[]model.DataDynamicResponse, error) {
	tx := dataDynamicUsecase.DB.WithContext(ctx).Begin()
	defer tx.Rollback()

	errorResponse := &model.ErrorResponse{}
	data := &[]entity.DataDynamic{}

	err := dataDynamicUsecase.Validate.Struct(request)
	if err != nil {
		var validationErrors []string
		for _, e := range err.(validator.ValidationErrors) {
			msg := fmt.Sprintf("Field '%s' failed on '%s' rule", e.Field(), e.Tag())
			validationErrors = append(validationErrors, msg)
		}

		errorResponse.Message = "invalid request parameter"
		errorResponse.Details = validationErrors

		jsonString, _ := json.Marshal(errorResponse)

		log.Println("error update data dynamic : ", err)

		return nil, fiber.NewError(fiber.ErrBadRequest.Code, string(jsonString))
	}

	for _, item := range request.Items {
		err := dataDynamicUsecase.Validate.Struct(item)
		if err != nil {
			var validationErrors []string
			for _, e := range err.(validator.ValidationErrors) {
				msg := fmt.Sprintf("Field '%s' failed on '%s' rule", e.Field(), e.Tag())
				validationErrors = append(validationErrors, msg)
			}

			errorResponse.Message = "invalid request parameter"
			errorResponse.Details = validationErrors

			jsonString, _ := json.Marshal(errorResponse)

			log.Println("error update data dynamic : ", err)

			return nil, fiber.NewError(fiber.ErrBadRequest.Code, string(jsonString))
		}

		dynamic := entity.DataDynamic{
			ID:    item.ID,
			Value: item.Value,
		}

		err = dataDynamicUsecase.DataDynamicRepo.FindById(tx, &dynamic)
		if err != nil {
			if errors.Is(err, gorm.ErrRecordNotFound) {
				errorResponse := model.ErrorResponse{
					Message: "DataDynamic data was not found",
					Details: []string{},
				}

				jsonString, _ := json.Marshal(errorResponse)

				log.Println("error find by type data dynamic usecase : ", err)

				return nil, fiber.NewError(fiber.ErrNotFound.Code, string(jsonString))
			} else {
				log.Println("Error find by type data dynamic usecase:", err)
				return nil, fiber.ErrInternalServerError
			}
		}

		dynamic.Value = item.Value

		if err := dataDynamicUsecase.DataDynamicRepo.Update(tx, &dynamic); err != nil {
			log.Println("failed when update repo data dynamic : ", err)
			return nil, fiber.ErrInternalServerError
		}

		*data = append(*data, dynamic)
	}

	if err := tx.Commit().Error; err != nil {
		log.Println("Failed commit transaction : ", err)
		return nil, fiber.ErrInternalServerError
	}

	log.Println("success update from data dynamic data dynamic")
	return converter.DataDynamicToResponses(data), nil
}
