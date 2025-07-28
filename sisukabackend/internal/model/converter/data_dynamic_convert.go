package converter

import (
	"log"

	"github.com/Bangdams/web-profile-API/internal/entity"
	"github.com/Bangdams/web-profile-API/internal/model"
)

func DataDynamicToResponse(dataDynamic *entity.DataDynamic) *model.DataDynamicResponse {
	log.Println("log from dataDynamic to response")

	return &model.DataDynamicResponse{
		ID:        dataDynamic.ID,
		Value:     dataDynamic.Value,
		Type:      dataDynamic.Type,
		CreatedAt: dataDynamic.CreatedAt.Format("2006-01-02"),
	}
}

func DataDynamicToResponses(dataDynamics *[]entity.DataDynamic) *[]model.DataDynamicResponse {
	var dataDynamicResponses []model.DataDynamicResponse

	log.Println("log from dataDynamic to responses")

	for _, dataDynamic := range *dataDynamics {
		dataDynamicResponses = append(dataDynamicResponses, *DataDynamicToResponse(&dataDynamic))
	}

	return &dataDynamicResponses
}
