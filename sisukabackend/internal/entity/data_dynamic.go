package entity

import "time"

type DataDynamic struct {
	ID        uint   `gorm:"primaryKey"`
	Value     string `gorm:"not null"`
	Type      string `gorm:"not null"`
	CreatedAt time.Time
	UpdatedAt time.Time
}
