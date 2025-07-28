package http

import (
	"errors"
	"fmt"
	"log"
	"os"
	"path/filepath"
	"strconv"

	"github.com/Bangdams/web-profile-API/internal/model"
	"github.com/Bangdams/web-profile-API/internal/usecase"
	"github.com/Bangdams/web-profile-API/internal/util"
	"github.com/gofiber/fiber/v2"
)

type StaffStructureController interface {
	Create(ctx *fiber.Ctx) error
	UpdateBatch(ctx *fiber.Ctx) error
	FindByType(ctx *fiber.Ctx) error
	FindAll(ctx *fiber.Ctx) error
}

type StaffStructureControllerImpl struct {
	StaffStructureUsecase usecase.StaffStructureUsecase
}

func NewStaffStructureController(StaffStructureUsecase usecase.StaffStructureUsecase) StaffStructureController {
	return &StaffStructureControllerImpl{
		StaffStructureUsecase: StaffStructureUsecase,
	}
}

// FindAll implements StaffStructureController.
func (controller *StaffStructureControllerImpl) FindAll(ctx *fiber.Ctx) error {
	var responses *[]model.StaffStructureResponse

	responses, err := controller.StaffStructureUsecase.FindAll(ctx.UserContext())
	if err != nil {
		log.Println("failed to find all admin")
		return err
	}

	return ctx.JSON(model.WebResponses[model.StaffStructureResponse]{Data: responses})
}

// Create implements StaffStructureController.
func (controller *StaffStructureControllerImpl) Create(ctx *fiber.Ctx) error {
	request := new(model.StaffStructureCreateRequest)

	request.Name = ctx.FormValue("name")
	request.Type = ctx.FormValue("type")

	// upload image
	file, err := ctx.FormFile("image")
	if err != nil {
		log.Println("failed to parse request image : ", err)
		return ctx.Status(fiber.StatusBadRequest).JSON(fiber.Map{"error": "image is required"})
	}

	filename := filepath.Base(file.Filename)
	generateFilename := util.GenerateRandomFilename(filename)
	savePath := filepath.Join("./upload/users", generateFilename)

	if err := ctx.SaveFile(file, savePath); err != nil {
		return ctx.Status(fiber.StatusInternalServerError).JSON(fiber.Map{"error": "failed to save image"})
	}

	request.Image = generateFilename
	// end upload image

	response, err := controller.StaffStructureUsecase.Create(ctx.UserContext(), request)
	if err != nil {
		errRemove := os.Remove(savePath)
		if errRemove != nil {
			log.Printf("Gagal menghapus file %s: %v\n", savePath, err)
			return err
		}

		log.Println("failed to create staff")
		return err
	}

	return ctx.JSON(model.WebResponse[*model.StaffStructureResponse]{Data: response})
}

// FindByType implements StaffStructureController.
func (controller *StaffStructureControllerImpl) FindByType(ctx *fiber.Ctx) error {
	typeName := ctx.Query("type")
	if typeName != "" {
		response, err := controller.StaffStructureUsecase.FindByType(ctx.UserContext(), typeName)
		if err != nil {
			log.Println("failed to find by type")
			return err
		}

		return ctx.JSON(model.WebResponse[*model.StaffStructureResponse]{Data: response})
	}

	responses, err := controller.StaffStructureUsecase.FindAll(ctx.UserContext())
	if err != nil {
		log.Println("failed to find by type")
		return err
	}

	return ctx.JSON(model.WebResponses[model.StaffStructureResponse]{Data: responses})
}

// UpdateBatch menangani pembaruan beberapa data staf sekaligus.
func (controller *StaffStructureControllerImpl) UpdateBatch(ctx *fiber.Ctx) error {
	form, err := ctx.MultipartForm()
	if err != nil {
		log.Println("Error parsing multipart form:", err)
		return fiber.ErrBadRequest
	}

	var requests []*model.StaffStructureUpdateRequest
	var uploadedFiles []string

	defer func() {
		if r := recover(); r != nil {
			util.CleanupFiles(uploadedFiles)
			panic(r)
		}
	}()

	for i := 0; ; i++ {
		idKey := fmt.Sprintf("staff[%d][id]", i)
		nameKey := fmt.Sprintf("staff[%d][name]", i)
		typeKey := fmt.Sprintf("staff[%d][type]", i)
		imageKey := fmt.Sprintf("staff[%d][image]", i)

		idValues, ok := form.Value[idKey]
		if !ok || len(idValues) == 0 {
			break
		}

		staffIdStr := idValues[0]
		name := form.Value[nameKey][0]
		staffType := form.Value[typeKey][0]

		staffId, err := strconv.Atoi(staffIdStr)
		if err != nil {
			util.CleanupFiles(uploadedFiles)
			return ctx.Status(fiber.StatusBadRequest).JSON(fiber.Map{"error": "ID staf tidak valid"})
		}

		req := &model.StaffStructureUpdateRequest{
			ID:   uint(staffId),
			Name: name,
			Type: staffType,
		}

		if files, ok := form.File[imageKey]; ok && len(files) > 0 {
			file := files[0]
			if file.Size > 0 {
				filename := filepath.Base(file.Filename)
				generateFilename := util.GenerateRandomFilename(filename)
				savePath := filepath.Join("./upload/users", generateFilename)

				if err := ctx.SaveFile(file, savePath); err != nil {
					util.CleanupFiles(uploadedFiles)
					return ctx.Status(fiber.StatusInternalServerError).JSON(fiber.Map{"error": "Gagal menyimpan file"})
				}
				req.Image = generateFilename
				uploadedFiles = append(uploadedFiles, savePath)
			}
		}

		requests = append(requests, req)
	}

	if len(requests) == 0 {
		return ctx.Status(fiber.StatusBadRequest).JSON(fiber.Map{"error": "Tidak ada data staf yang dikirim"})
	}

	responses, oldImages, err := controller.StaffStructureUsecase.UpdateBatch(ctx.UserContext(), requests)
	if err != nil {
		util.CleanupFiles(uploadedFiles)
		if errors.Is(err, usecase.ErrStaffNotFound) {
			return ctx.Status(fiber.StatusNotFound).JSON(fiber.Map{"error": err.Error()})
		}
		return ctx.Status(fiber.StatusInternalServerError).JSON(fiber.Map{"error": "Terjadi kesalahan saat memproses data"})
	}

	util.CleanupOldImages(oldImages)

	return ctx.Status(fiber.StatusOK).JSON(model.WebResponse[[]*model.StaffStructureResponse]{Data: responses})
}
