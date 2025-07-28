package entity

import "time"

type StaffStructure struct {
	ID        uint   `gorm:"primaryKey"`
	Name      string `gorm:"not null"`
	Type      string `gorm:"not null"`
	Image     string `gorm:"not null"`
	CreatedAt time.Time
	UpdatedAt time.Time
}
