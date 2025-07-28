package converter

import (
	"log"

	"github.com/Bangdams/web-profile-API/internal/entity"
	"github.com/Bangdams/web-profile-API/internal/model"
)

func StaffStructureToResponse(StaffStructure *entity.StaffStructure) *model.StaffStructureResponse {
	log.Println("log from StaffStructure to response")

	return &model.StaffStructureResponse{
		ID:        StaffStructure.ID,
		Name:      StaffStructure.Name,
		Type:      StaffStructure.Type,
		Image:     StaffStructure.Image,
		CreatedAt: StaffStructure.CreatedAt.Format("2006-01-02"),
	}
}

func StaffStructureToResponses(StaffStructures *[]entity.StaffStructure) *[]model.StaffStructureResponse {
	var StaffStructureResponses []model.StaffStructureResponse

	log.Println("log from StaffStructure to responses")

	for _, StaffStructure := range *StaffStructures {
		StaffStructureResponses = append(StaffStructureResponses, *StaffStructureToResponse(&StaffStructure))
	}

	return &StaffStructureResponses
}
