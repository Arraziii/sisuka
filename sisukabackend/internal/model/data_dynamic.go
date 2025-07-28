package model

type DataDynamicResponse struct {
	ID        uint   `json:"id"`
	Value     string `json:"value"`
	Type      string `json:"type"`
	CreatedAt string `json:"created_at"`
}

type DataDynamicBatchRequest struct {
	Items []DataDynamicUpdateRequest `json:"items" validate:"required"`
}

type DataDynamicUpdateRequest struct {
	ID    uint   `json:"id" validate:"required"`
	Value string `json:"value" validate:"required"`
}
