package entity

import "time"

type Content struct {
	ID         uint   `gorm:"primaryKey"`
	Title      string `gorm:"not null"`
	Content    string `gorm:"not null"`
	Image      string
	CategoryId uint `gorm:"not null"`
	CreatedBy  uint `gorm:"not null"`
	CreatedAt  time.Time
	UpdatedAt  time.Time
	Admin      Admin    `gorm:"foreignKey:created_by;references:id"`
	Category   Category `gorm:"foreignKey:category_id;references:id"`
}
