package entity

import "time"

type Category struct {
	ID        uint   `gorm:"primaryKey"`
	Name      string `gorm:"not null"`
	CreatedAt time.Time
	UpdatedAt time.Time
	Contents  []Content `gorm:"foreignKey:category_id;references:id"`
}
