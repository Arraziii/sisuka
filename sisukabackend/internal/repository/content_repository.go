package repository

import (
	"fmt"
	"time"

	"github.com/Bangdams/web-profile-API/internal/entity"
	"gorm.io/gorm"
)

type ContentRepository interface {
	Create(tx *gorm.DB, content *entity.Content) error
	Update(tx *gorm.DB, content *entity.Content) error
	Delete(tx *gorm.DB, content *entity.Content) error
	GetRelatedArticle(tx *gorm.DB, contentId uint, categoryId uint, contents *[]entity.Content) error
	FindWithLimit(tx *gorm.DB, order string, category string, contents *[]entity.Content) error
	FindById(tx *gorm.DB, content *entity.Content) error
	FindByIdForUpdate(tx *gorm.DB, content *entity.Content) error
	Search(tx *gorm.DB, totalRecord *int64, pageSize int, offset int, search string, category string, startDate string, endDate string, order string, contents *[]entity.Content) error
}

type ContentRepositoryImpl struct {
	Repository[entity.Content]
}

func NewContentRepository() ContentRepository {
	return &ContentRepositoryImpl{}
}

// Search implements ContentRepository.
func (repository *ContentRepositoryImpl) Search(tx *gorm.DB, totalRecord *int64, pageSize int, offset int, search string, category string, startDate string, endDate string, order string, contents *[]entity.Content) error {
	query := tx.Model(&entity.Content{}).
		Joins("Admin").
		Joins("JOIN categories ON categories.id = contents.category_id").
		Where("contents.title LIKE ?", "%"+search+"%")

	if category != "" {
		query = query.Where("categories.name = ?", category)
	}

	// Layout untuk parsing tanggal YYYY-MM-DD
	layout := "2006-01-02"

	if startDate != "" {
		parsedStartDate, err := time.Parse(layout, startDate)
		if err != nil {
			return fmt.Errorf("format tanggal awal salah: %w", err)
		}

		query = query.Where("contents.created_at >= ?", parsedStartDate)
	}

	if endDate != "" {
		parsedEndDate, err := time.Parse(layout, endDate)
		if err != nil {
			return fmt.Errorf("format tanggal akhir salah: %w", err)
		}

		endOfDate := parsedEndDate.AddDate(0, 0, 1)
		query = query.Where("contents.created_at < ?", endOfDate)
	}

	if err := query.Count(totalRecord).Error; err != nil {
		return err
	}

	sortDirection := "DESC"
	if order == "ASC" {
		sortDirection = "ASC"
	}

	return query.
		Order("contents.created_at " + sortDirection).
		Limit(pageSize).
		Offset(offset).
		Find(contents).Error
}

// FindByIdWithAdmin implements ContentRepository.
func (repository *ContentRepositoryImpl) FindByIdWithAdmin(tx *gorm.DB, content *entity.Content) error {
	return tx.First(content).Joins("Admin").Error
}

// GetRelatedArticle implements ContentRepository.
func (repository *ContentRepositoryImpl) GetRelatedArticle(tx *gorm.DB, contentId uint, categoryId uint, contents *[]entity.Content) error {
	if categoryId != 0 {
		return tx.Joins("Admin").
			Joins("Category").Where("Category.id = ?", categoryId).
			Order("contents.created_at DESC").
			Limit(2).
			Not("contents.id = ?", contentId).
			Find(contents).Error
	}

	return nil
}

// FindWithLimit implements ContentRepository.
func (repository *ContentRepositoryImpl) FindWithLimit(tx *gorm.DB, order string, category string, contents *[]entity.Content) error {
	query := tx.Preload("Admin").Preload("Category")

	if category != "" {
		query = query.Joins("Category").Where("Category.name = ?", category)
	}

	sortDirection := "DESC"
	if order == "ASC" {
		sortDirection = "ASC"
	}

	return query.Order("contents.created_at " + sortDirection).
		Limit(4).
		Find(contents).Error
}

// FindById implements ContentRepository.
func (repository *ContentRepositoryImpl) FindById(tx *gorm.DB, content *entity.Content) error {
	return tx.Joins("Admin").Joins("Category").First(content).Error
}

// FindByIdForUpdate implements ContentRepository.
func (repository *ContentRepositoryImpl) FindByIdForUpdate(tx *gorm.DB, content *entity.Content) error {
	return tx.First(content).Error
}
