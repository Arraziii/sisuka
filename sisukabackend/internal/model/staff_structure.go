package model

type StaffStructureResponse struct {
	ID        uint   `json:"id"`
	Name      string `json:"name"`
	Type      string `json:"type"`
	Image     string `json:"image"`
	CreatedAt string `json:"created_at"`
}

type StaffStructureCreateRequest struct {
	Name  string `json:"name" validate:"required"`
	Type  string `json:"type" validate:"required"`
	Image string `json:"image" validate:"required"`
}

type StaffStructureUpdateRequest struct {
	ID    uint   `json:"id" validate:"required"`
	Name  string `json:"name" validate:"required"`
	Type  string `json:"type" validate:"required"`
	Image string `json:"image"`
}
