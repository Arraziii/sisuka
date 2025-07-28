package repository

import (
	"github.com/Bangdams/web-profile-API/internal/entity"
	"gorm.io/gorm"
)

type CategoryRepository interface {
	Create(tx *gorm.DB, category *entity.Category) error
	Update(tx *gorm.DB, category *entity.Category) error
	Delete(tx *gorm.DB, category *entity.Category) error
	Search(tx *gorm.DB, totalRecord *int64, search string, order string, pageSize int, offset int, categories *[]entity.Category) error
	FindById(tx *gorm.DB, category *entity.Category) error
	FindByName(tx *gorm.DB, category *entity.Category) error
}

type CategoryRepositoryImpl struct {
	Repository[entity.Category]
}

func NewCategoryRepository() CategoryRepository {
	return &CategoryRepositoryImpl{}
}

// FindByName implements CategoryRepository.
func (repository *CategoryRepositoryImpl) FindByName(tx *gorm.DB, category *entity.Category) error {
	return tx.Take(category, "name = ?", category.Name).Error
}

// Search implements CategoryRepository.
func (repository *CategoryRepositoryImpl) Search(tx *gorm.DB, totalRecord *int64, search string, order string, pageSize int, offset int, categories *[]entity.Category) error {

	if err := tx.Table("categories").Count(totalRecord).Error; err != nil {
		return err
	}

	return tx.Where("name LIKE ?", "%"+search+"%").
		Order("created_at " + order).
		Limit(pageSize).
		Offset(offset).
		Find(categories).
		Error
}

// FindById implements CategoryRepository.
func (repository *CategoryRepositoryImpl) FindById(tx *gorm.DB, category *entity.Category) error {
	return tx.Take(category).Error
}
