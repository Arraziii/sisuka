package converter

import (
	"log"

	"github.com/Bangdams/web-profile-API/internal/entity"
	"github.com/Bangdams/web-profile-API/internal/model"
)

func CategoryToResponse(category *entity.Category) *model.CategoryResponse {
	log.Println("log from category to response")

	return &model.CategoryResponse{
		ID:        category.ID,
		Name:      category.Name,
		CreatedAt: category.CreatedAt.Format("2006-01-02"),
	}
}

func CategoryoResponses(categories *[]entity.Category) *[]model.CategoryResponse {
	var categoryResponses []model.CategoryResponse

	log.Println("log from category to responses")

	for _, category := range *categories {
		categoryResponses = append(categoryResponses, *CategoryToResponse(&category))
	}

	return &categoryResponses
}
