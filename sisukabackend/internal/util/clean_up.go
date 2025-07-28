package util

import (
	"log"
	"os"
	"path/filepath"
)

// Fungsi helper untuk menghapus file
func CleanupFiles(paths []string) {
	if len(paths) == 0 {
		return
	}
	log.Println("Melakukan cleanup untuk file-file berikut:", paths)
	for _, path := range paths {
		if err := os.Remove(path); err != nil {
			log.Printf("Gagal menghapus file %s: %v\n", path, err)
		}
	}
}

func CleanupOldImages(filenames []string) {
	if len(filenames) == 0 {
		return
	}
	log.Println("Melakukan cleanup untuk file-file lama:", filenames)
	for _, filename := range filenames {
		path := filepath.Join("./uploads/staff", filename)
		if err := os.Remove(path); err != nil {
			log.Printf("Gagal menghapus file lama %s: %v\n", path, err)
		}
	}
}
