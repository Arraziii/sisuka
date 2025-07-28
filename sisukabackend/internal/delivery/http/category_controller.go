package http

import (
	"log"

	"github.com/Bangdams/web-profile-API/internal/model"
	"github.com/Bangdams/web-profile-API/internal/usecase"
	"github.com/gofiber/fiber/v2"
)

type CategoryController interface {
	Create(ctx *fiber.Ctx) error
	Update(ctx *fiber.Ctx) error
	Delete(ctx *fiber.Ctx) error
	Search(ctx *fiber.Ctx) error
	FindById(ctx *fiber.Ctx) error
}

type CategoryControllerImpl struct {
	CategoryUsecase usecase.CategoryUsecase
}

func NewCategoryController(CategoryUsecase usecase.CategoryUsecase) CategoryController {
	return &CategoryControllerImpl{
		CategoryUsecase: CategoryUsecase,
	}
}

// Create implements CategoryController.
func (controller *CategoryControllerImpl) Create(ctx *fiber.Ctx) error {
	request := new(model.CategoryCreateRequest)

	if err := ctx.BodyParser(request); err != nil {
		log.Println("failed to parse request : ", err)
		return fiber.ErrBadRequest
	}

	response, err := controller.CategoryUsecase.Create(ctx.UserContext(), request)
	if err != nil {
		log.Println("failed to create category")
		return err
	}

	return ctx.JSON(model.WebResponse[*model.CategoryResponse]{Data: response})

}

// Delete implements CategoryController.
func (controller *CategoryControllerImpl) Delete(ctx *fiber.Ctx) error {
	id, err := ctx.ParamsInt("id")
	if err != nil {
		return fiber.ErrBadRequest
	}

	if err := controller.CategoryUsecase.Delete(ctx.UserContext(), uint(id)); err != nil {
		log.Println("failed to delete category")
		return err
	}

	return nil
}

// Search implements CategoryController.
func (controller *CategoryControllerImpl) Search(ctx *fiber.Ctx) error {
	var responses *[]model.CategoryResponse

	order := ctx.Query("order")
	page := ctx.QueryInt("page")
	search := ctx.Query("search")

	responses, currentPage, totalRecords, totalPages, err := controller.CategoryUsecase.Search(ctx.UserContext(), search, order, page)
	if err != nil {
		log.Println("failed to find all category")
		return err
	}

	return ctx.JSON(model.WebResponsesPagination[model.CategoryResponse]{
		Data:         responses,
		CurrentPage:  currentPage,
		TotalRecords: totalRecords,
		TotalPages:   totalPages,
	})
}

// FindById implements CategoryController.
func (controller *CategoryControllerImpl) FindById(ctx *fiber.Ctx) error {
	categoryId, err := ctx.ParamsInt("category_id")
	if err != nil {
		return fiber.ErrBadRequest
	}

	response, err := controller.CategoryUsecase.FindById(ctx.UserContext(), uint(categoryId))
	if err != nil {
		log.Println("failed to find by id content")
		return err
	}

	return ctx.JSON(model.WebResponse[*model.CategoryResponse]{Data: response})
}

// Update implements CategoryController.
func (controller *CategoryControllerImpl) Update(ctx *fiber.Ctx) error {
	request := new(model.CategoryUpdateRequest)

	if err := ctx.BodyParser(request); err != nil {
		log.Println("failed to parse request : ", err)
		return fiber.ErrBadRequest
	}

	response, err := controller.CategoryUsecase.Update(ctx.UserContext(), request)
	if err != nil {
		log.Println("failed to update category")
		return err
	}

	return ctx.JSON(model.WebResponse[*model.CategoryResponse]{Data: response})
}
