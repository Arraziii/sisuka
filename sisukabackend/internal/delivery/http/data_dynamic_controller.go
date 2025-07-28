package http

import (
	"log"

	"github.com/Bangdams/web-profile-API/internal/model"
	"github.com/Bangdams/web-profile-API/internal/usecase"
	"github.com/gofiber/fiber/v2"
)

type DataDynamicController interface {
	Update(ctx *fiber.Ctx) error
	FindByType(ctx *fiber.Ctx) error
}

type DataDynamicControllerImpl struct {
	DataDynamicUsecase usecase.DataDynamicUsecase
}

func NewDataDynamicController(DataDynamicUsecase usecase.DataDynamicUsecase) DataDynamicController {
	return &DataDynamicControllerImpl{
		DataDynamicUsecase: DataDynamicUsecase,
	}
}

// FindByType implements DataDynamicController.
func (controller *DataDynamicControllerImpl) FindByType(ctx *fiber.Ctx) error {
	typeName := ctx.Query("type")

	response, err := controller.DataDynamicUsecase.FindByType(ctx.UserContext(), typeName)
	if err != nil {
		log.Println("failed to find by type")
		return err
	}

	return ctx.JSON(model.WebResponse[*model.DataDynamicResponse]{Data: response})
}

// Update implements DataDynamicController.
func (controller *DataDynamicControllerImpl) Update(ctx *fiber.Ctx) error {
	request := new(model.DataDynamicBatchRequest)

	if err := ctx.BodyParser(request); err != nil {
		log.Println("failed to parse request : ", err)
		return fiber.ErrBadRequest
	}

	response, err := controller.DataDynamicUsecase.Update(ctx.UserContext(), request)
	if err != nil {
		log.Println("failed to update data dynamic")
		return err
	}

	return ctx.JSON(model.WebResponses[model.DataDynamicResponse]{Data: response})
}
