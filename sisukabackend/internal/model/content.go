package model

type ContentResponse struct {
	ID             uint             `json:"id"`
	Title          string           `json:"title"`
	Content        string           `json:"content"`
	Image          string           `json:"image"`
	Category       string           `json:"category"`
	CategoryId     uint             `json:"category_id"`
	CreatedBy      string           `json:"created_by"`
	CreatedAt      string           `json:"created_at"`
	RelatedArticle []RelatedArticle `json:"related_article"`
}

type RelatedArticle struct {
	ID        uint   `json:"id"`
	Title     string `json:"title"`
	Image     string `json:"image"`
	CreatedAt string `json:"created_at"`
}

type ContentCreateRequest struct {
	Title      string `json:"title" validate:"required"`
	Content    string `json:"content" validate:"required"`
	Image      string `json:"image" validate:"required"`
	CategoryId uint   `json:"category_id" validate:"required"`
	CreatedBy  uint   `json:"created_by" validate:"required"`
}

type ContentUpdateRequest struct {
	ID         uint   `json:"id" validate:"required"`
	Title      string `json:"title" validate:"required"`
	Content    string `json:"content" validate:"required"`
	Image      string `json:"image"`
	CategoryId uint   `json:"category_id" validate:"required"`
	CreatedBy  uint   `json:"created_by" validate:"required"`
}
