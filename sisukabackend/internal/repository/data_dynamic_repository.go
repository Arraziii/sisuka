package repository

import (
	"github.com/Bangdams/web-profile-API/internal/entity"
	"gorm.io/gorm"
)

type DataDynamicRepository interface {
	Update(tx *gorm.DB, dataDynamic *entity.DataDynamic) error
	FindByType(tx *gorm.DB, dataDynamic *entity.DataDynamic) error
	FindById(tx *gorm.DB, dataDynamic *entity.DataDynamic) error
}

type DataDynamicRepositoryImpl struct {
	Repository[entity.DataDynamic]
}

func NewDataDynamicRepository() DataDynamicRepository {
	return &DataDynamicRepositoryImpl{}
}

// FindById implements DataDynamicRepository.
func (repository *DataDynamicRepositoryImpl) FindById(tx *gorm.DB, dataDynamic *entity.DataDynamic) error {
	return tx.Take(dataDynamic).Error
}

// FindByType implements DataDynamicRepository.
func (repository *DataDynamicRepositoryImpl) FindByType(tx *gorm.DB, dataDynamic *entity.DataDynamic) error {
	return tx.Take(dataDynamic, "type = ?", dataDynamic.Type).Error
}
