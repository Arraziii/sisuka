package config

import (
	"github.com/Bangdams/web-profile-API/internal/delivery/http"
	"github.com/Bangdams/web-profile-API/internal/delivery/http/route"
	"github.com/Bangdams/web-profile-API/internal/repository"
	"github.com/Bangdams/web-profile-API/internal/usecase"
	"github.com/go-playground/validator/v10"
	"github.com/gofiber/fiber/v2"
	"gorm.io/gorm"
)

type BootstrapConfig struct {
	DB       *gorm.DB
	App      *fiber.App
	Validate *validator.Validate
}

func Bootstrap(config *BootstrapConfig) {
	// repo
	adminRepo := repository.NewAdminRepository()
	refreshTokenRepo := repository.NewRefreshTokenRepository()
	contentRepo := repository.NewContentRepository()
	categoryRepo := repository.NewCategoryRepository()
	dataDynamicRepo := repository.NewDataDynamicRepository()
	staffStructureRepo := repository.NewStaffStructureRepository()

	// usecase
	adminUsecase := usecase.NewAdminUsecase(adminRepo, refreshTokenRepo, config.DB, config.Validate)
	contentUsecas := usecase.NewContentUsecase(contentRepo, adminRepo, categoryRepo, config.DB, config.Validate)
	categoryUsecase := usecase.NewCategoryUsecase(categoryRepo, config.DB, config.Validate)
	dataDynamicUsecase := usecase.NewDataDynamicUsecase(dataDynamicRepo, config.DB, config.Validate)
	staffStructureUsecase := usecase.NewStaffStructureUsecase(staffStructureRepo, config.DB, config.Validate)

	// controller
	adminController := http.NewAdminController(adminUsecase)
	contentController := http.NewContentController(contentUsecas)
	categoryController := http.NewCategoryController(categoryUsecase)
	dataDynamicController := http.NewDataDynamicController(dataDynamicUsecase)
	staffStructureController := http.NewStaffStructureController(staffStructureUsecase)

	routeConfig := route.RouteConfig{
		App:                      config.App,
		AdminController:          adminController,
		ContentController:        contentController,
		DataDynamicController:    dataDynamicController,
		StaffStructureController: staffStructureController,
		CategoryController:       categoryController,
	}

	routeConfig.Setup()
}
