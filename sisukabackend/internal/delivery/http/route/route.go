package route

import (
	"path/filepath"

	"github.com/Bangdams/web-profile-API/internal/delivery/http"
	"github.com/gofiber/fiber/v2"
)

type RouteConfig struct {
	App                      *fiber.App
	AdminController          http.AdminController
	ContentController        http.ContentController
	CategoryController       http.CategoryController
	DataDynamicController    http.DataDynamicController
	StaffStructureController http.StaffStructureController
}

func (config *RouteConfig) Setup() {
	// Api for login
	config.App.Post("/login", config.AdminController.Login)
	config.App.Post("/logout", config.AdminController.Logout)
	config.App.Post("/refresh", config.AdminController.Refresh)

	// API for admin
	config.App.Get("/api/admins", config.AdminController.FindAll)
	config.App.Get("/api/admins/:username", config.AdminController.FindByUsername)
	config.App.Post("/api/admins", config.AdminController.Create)
	config.App.Delete("/api/admins/:id", config.AdminController.Delete)
	config.App.Put("/api/admins", config.AdminController.Update)

	// API for content
	config.App.Get("contents", config.ContentController.ListfindContents)
	config.App.Get("contents/limit", config.ContentController.FindWithLimit)
	config.App.Get("contents/:content_id", config.ContentController.FindById)
	config.App.Post("/api/contents", config.ContentController.Create)
	config.App.Delete("/api/contents/:id", config.ContentController.Delete)
	config.App.Put("/api/contents", config.ContentController.Update)

	// API for category
	config.App.Get("categories", config.CategoryController.Search)
	config.App.Get("categories/:category_id", config.CategoryController.FindById)
	config.App.Post("/api/categories", config.CategoryController.Create)
	config.App.Put("/api/categories", config.CategoryController.Update)
	config.App.Delete("/api/categories/:id", config.CategoryController.Delete)

	// API for data dynamic
	config.App.Get("data-dynamic", config.DataDynamicController.FindByType)
	config.App.Put("/api/data-dynamic", config.DataDynamicController.Update)

	// API for data data staff
	config.App.Get("data-staff", config.StaffStructureController.FindByType)
	config.App.Post("/api/data-staff", config.StaffStructureController.Create)
	config.App.Put("/api/data-staff", config.StaffStructureController.UpdateBatch)

	// API for image
	config.App.Get("/assets/image/:filename", func(ctx *fiber.Ctx) error {
		filename := ctx.Params("filename")
		filepath := filepath.Join("./upload", filename)
		return ctx.SendFile(filepath)
	})

	config.App.Get("/assets/image/user/:filename", func(ctx *fiber.Ctx) error {
		filename := ctx.Params("filename")
		filepath := filepath.Join("./upload/users", filename)
		return ctx.SendFile(filepath)
	})
}
