package entity

import "time"

type Admin struct {
	ID        uint   `gorm:"primaryKey"`
	Name      string `gorm:"not null"`
	Username  string `gorm:"not null;unique"`
	Password  string `gorm:"not null"`
	CreatedAt time.Time
	UpdatedAt time.Time
	Contents  []Content `gorm:"foreignKey:created_by;references:id"`
}
