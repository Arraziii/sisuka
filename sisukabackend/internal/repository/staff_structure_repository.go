package repository

import (
	"github.com/Bangdams/web-profile-API/internal/entity"
	"gorm.io/gorm"
)

type StaffStructureRepository interface {
	Create(tx *gorm.DB, staffStructure *entity.StaffStructure) error
	Update(tx *gorm.DB, staffStructure *entity.StaffStructure) error
	FindByType(tx *gorm.DB, staffStructure *entity.StaffStructure) error
	FindAll(tx *gorm.DB, staffStructure *[]entity.StaffStructure) error
	FindById(tx *gorm.DB, staffStructure *entity.StaffStructure) error
	FindByIdAndType(tx *gorm.DB, staffStructure *entity.StaffStructure, stafId uint, stafType string) error
}

type StaffStructureRepositoryImpl struct {
	Repository[entity.StaffStructure]
}

func NewStaffStructureRepository() StaffStructureRepository {
	return &StaffStructureRepositoryImpl{}
}

// FindByIdAndType implements StaffStructureRepository.
func (repository *StaffStructureRepositoryImpl) FindByIdAndType(tx *gorm.DB, staffStructure *entity.StaffStructure, stafId uint, stafType string) error {
	return tx.Take(staffStructure, "id = ? AND type = ?", stafId, stafType).Error
}

// FindAll implements StaffStructureRepository.
func (repository *StaffStructureRepositoryImpl) FindAll(tx *gorm.DB, staffStructure *[]entity.StaffStructure) error {
	return tx.Find(staffStructure).Error
}

// FindByType implements StaffStructureRepository.
func (repository *StaffStructureRepositoryImpl) FindByType(tx *gorm.DB, staffStructure *entity.StaffStructure) error {
	return tx.Take(staffStructure, "type = ?", staffStructure.Type).Error
}

// FindById implements StaffStructureRepository.
func (repository *StaffStructureRepositoryImpl) FindById(tx *gorm.DB, staffStructure *entity.StaffStructure) error {
	return tx.Take(staffStructure).Error
}
