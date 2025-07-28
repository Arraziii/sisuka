<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Artikel - Admin Panel Kelurahan Sukaasih</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/img/logo.png" />
    <link rel="shortcut icon" type="image/png" href="../assets/img/logo.png" />
    <link rel="apple-touch-icon" href="../assets/img/logo.png" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
    />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- Custom CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@4.0.0/build/jwt-decode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
      * {
        font-family: "Inter", sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        background: #f8f9fa;
        min-height: 100vh;
      }

      /* Admin Navbar */
      .admin-navbar-custom {
        background-color: #1e3a8a;
      }

      .admin-navbar-custom .navbar-brand {
        font-size: 1.1rem;
      }

      .admin-navbar-custom .nav-link {
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.2s ease-in-out;
        padding: 0.75rem 1rem;
        border-radius: 6px;
      }

      .admin-navbar-custom .nav-link:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
      }

      /* Gaya untuk link yang sedang aktif */
      .admin-navbar-custom .nav-link.active {
        color: #fff;
        background-color: #2563eb;
        font-weight: 600;
      }

      .admin-navbar-custom .dropdown-menu {
        padding: 0.5rem 0;
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
      }

      .admin-navbar-custom .dropdown-item {
        padding: 0.5rem 1rem;
      }

      .logout-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
      }

      .logout-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        transform: translateY(-1px);
      }

      /* Hero Section */
      .hero-section {
        background: linear-gradient(135deg, #4f87d1, #3662a0);
        color: white;
        padding: 3rem 0;
        text-align: center;
      }

      .hero-title {
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
      }

      .hero-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin: 0;
      }

      /* Breadcrumb */
      .breadcrumb-section {
        background: white;
        padding: 1rem 0;
        border-bottom: 1px solid #e5e7eb;
      }

      .breadcrumb-custom {
        background: none;
        margin: 0;
        padding: 0;
      }

      .breadcrumb-custom .breadcrumb-item a {
        color: #1e40af;
        text-decoration: none;
      }

      .breadcrumb-custom .breadcrumb-item.active {
        color: #6b7280;
      }

      /* Main Content */
      .main-content {
        padding: 2rem 0;
        min-height: calc(100vh - 300px);
      }

      .form-container {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
      }

      .section-title {
        color: #1e293b;
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 1.25rem;
      }

      .section-subtitle {
        color: #64748b;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
      }

      /* Form Elements */
      .form-label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
      }

      .form-control,
      .form-select {
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0.75rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
      }

      .form-control:focus,
      .form-select:focus {
        border-color: #1e40af;
        box-shadow: 0 0 0 0.2rem rgba(30, 64, 175, 0.1);
      }

      /* Image Upload */
      .image-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        padding: 3rem 2rem;
        text-align: center;
        background: #f9fafb;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .image-upload-area:hover {
        border-color: #1e40af;
        background: #f0f4ff;
      }

      .image-upload-area.dragover {
        border-color: #1e40af;
        background: #e0e7ff;
      }

      .upload-icon {
        font-size: 3rem;
        color: #9ca3af;
        margin-bottom: 1rem;
      }

      .upload-text {
        color: #374151;
        font-weight: 500;
        margin-bottom: 0.5rem;
      }

      .upload-subtext {
        color: #6b7280;
        font-size: 0.875rem;
      }

      .file-input {
        display: none;
      }

      /* Content Editor */
      .editor-toolbar {
        background: #f8fafc;
        border: 1px solid #d1d5db;
        border-bottom: none;
        border-radius: 8px 8px 0 0;
        padding: 0.5rem;
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
      }

      .editor-btn {
        background: white;
        border: 1px solid #d1d5db;
        color: #374151;
        padding: 0.4rem 0.8rem;
        border-radius: 4px;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .editor-btn:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
      }

      .editor-btn.active {
        background: #1e40af;
        color: white;
        border-color: #1e40af;
      }

      .content-editor {
        min-height: 300px;
        border: 1px solid #d1d5db;
        border-radius: 0 0 8px 8px;
        padding: 1rem;
        font-size: 0.95rem;
        line-height: 1.6;
        resize: vertical;
        outline: none;
        background: white;
      }

      .content-editor:empty:before {
        content: attr(data-placeholder);
        color: #9ca3af;
        font-style: italic;
      }

      .content-editor:focus {
        border-color: #1e40af;
        box-shadow: 0 0 0 0.2rem rgba(30, 64, 175, 0.1);
      }

      /* Sidebar */
      .sidebar-container {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        height: fit-content;
        position: sticky;
        top: 2rem;
      }

      .category-item {
        margin-bottom: 0.75rem;
      }

      .category-checkbox {
        margin-right: 0.75rem;
        transform: scale(1.1);
      }

      .category-label {
        color: #374151;
        font-weight: 500;
        cursor: pointer;
      }

      /* Action Buttons */
      .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
      }

      .btn-secondary-custom {
        background: #6b7280;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 500;
        color: white;
        transition: all 0.3s ease;
      }

      .btn-secondary-custom:hover {
        background: #4b5563;
        color: white;
      }

      .btn-primary-custom {
        background: #1e40af;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 500;
        color: white;
        transition: all 0.3s ease;
      }

      .btn-primary-custom:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(30, 64, 175, 0.3);
      }

      /* Footer */
      .footer-section {
        background: #1e40af;
        color: white;
        padding: 4rem 0 2rem;
        margin-top: auto;
      }

      .footer-link {
        transition: opacity 0.3s ease;
      }

      .footer-link:hover {
        opacity: 0.8;
        color: #e2e8f0 !important;
      }

      .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border-radius: 50%;
        text-decoration: none;
        transition: all 0.3s ease;
      }

      .social-link:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        transform: translateY(-2px);
      }

      /* Responsive */
      @media (max-width: 768px) {
        .hero-title {
          font-size: 2rem;
        }

        .main-content {
          padding: 1rem 0;
        }

        .form-container,
        .sidebar-container {
          padding: 1.5rem;
          margin-bottom: 1.5rem;
        }

        .action-buttons {
          flex-direction: column;
        }

        .image-upload-area {
          padding: 2rem 1rem;
        }
      }
    </style>
  </head>
  <body>
    <!-- Admin Navbar -->
    <div id="navbar-container"></div>

    <!-- Hero Section -->
    <section class="hero-section">
      <div class="container">
        <h1 class="hero-title">Post Artikel</h1>
        <p class="hero-subtitle">Admin panel web profil Kelurahan Sukaasih.</p>
      </div>
    </section>

    <!-- Main Content -->
    <div class="main-content">
      <div class="container">
        <div class="row">
          <!-- Main Form -->
          <div class="col-lg-8">
            <div class="form-container">
              <h3 class="section-title">Informasi Dasar</h3>
              <p class="section-subtitle">
                Masukkan judul dan konten utama artikel
              </p>

              <form id="articleForm">
                <!-- Judul Artikel -->
                <div class="mb-3">
                  <label for="articleTitle" class="form-label">
                    Judul Artikel <span class="text-danger">*</span>
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    id="articleTitle"
                    placeholder="Masukkan nama lengkap Artikel"
                    required
                  />
                  <input type="hidden" class="form-control" id="articleId" />
                </div>

                <!-- Gambar Upload -->
                <div class="mb-3">
                  <label class="form-label">
                    Gambar <span class="text-danger">*</span>
                  </label>
                  <div
                    class="image-upload-area"
                    onclick="document.getElementById('imageFile').click()"
                  >
                    <div id="previewContainer">
                      <div class="upload-icon"><i class="bi bi-image"></i></div>
                      <div class="upload-text">Upload gambar utama</div>
                      <div class="upload-subtext">PNG, JPG up to 5MB</div>
                    </div>
                    <input
                      type="file"
                      id="imageFile"
                      class="file-input"
                      accept="image/*"
                      style="display: none"
                    />
                  </div>
                </div>

                <!-- Tanggal Publikasi -->
                <div class="mb-3">
                  <label for="publishDate" class="form-label"
                    >Tanggal Publikasi</label
                  >
                  <input
                    type="date"
                    class="form-control"
                    id="publishDate"
                    readonly
                  />
                </div>

                <!-- Konten Artikel -->
                <div class="mb-3">
                  <label class="form-label">
                    Konten Artikel <span class="text-danger">*</span>
                  </label>

                  <!-- Editor Toolbar -->
                  <div class="editor-toolbar">
                    <select class="editor-btn" id="formatBlock">
                      <option value="p">Paragraph</option>
                      <option value="h1">Heading 1</option>
                      <option value="h2">Heading 2</option>
                      <option value="h3">Heading 3</option>
                      <option value="h4">Heading 4</option>
                    </select>
                    <button
                      type="button"
                      class="editor-btn"
                      data-command="bold"
                      title="Bold"
                    >
                      <i class="bi bi-type-bold"></i>
                    </button>
                    <button
                      type="button"
                      class="editor-btn"
                      data-command="italic"
                      title="Italic"
                    >
                      <i class="bi bi-type-italic"></i>
                    </button>
                    <button
                      type="button"
                      class="editor-btn"
                      data-command="underline"
                      title="Underline"
                    >
                      <i class="bi bi-type-underline"></i>
                    </button>
                    <button
                      type="button"
                      class="editor-btn"
                      data-command="insertUnorderedList"
                      title="Bulleted List"
                    >
                      <i class="bi bi-list-ul"></i>
                    </button>
                    <button
                      type="button"
                      class="editor-btn"
                      data-command="insertOrderedList"
                      title="Numbered List"
                    >
                      <i class="bi bi-list-ol"></i>
                    </button>
                    <button
                      type="button"
                      class="editor-btn"
                      data-command="createLink"
                      title="Link"
                    >
                      <i class="bi bi-link-45deg"></i>
                    </button>
                    <button
                      type="button"
                      class="editor-btn"
                      data-command="justifyLeft"
                      title="Align Left"
                    >
                      <i class="bi bi-text-left"></i>
                    </button>
                    <button
                      type="button"
                      class="editor-btn"
                      data-command="justifyCenter"
                      title="Align Center"
                    >
                      <i class="bi bi-text-center"></i>
                    </button>
                    <button
                      type="button"
                      class="editor-btn"
                      data-command="justifyRight"
                      title="Align Right"
                    >
                      <i class="bi bi-text-right"></i>
                    </button>
                  </div>

                  <!-- Content Area -->
                  <div
                    class="content-editor"
                    id="articleContent"
                    contenteditable="true"
                    data-placeholder="Tulis konten artikel di sini..."
                  ></div>
                  <textarea
                    class="form-control d-none"
                    id="articleContentHidden"
                    name="content"
                    required
                  ></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                  <button
                    type="button"
                    class="btn btn-secondary-custom"
                    onclick="window.location.href='artikel.html'"
                  >
                    <i class="bi bi-arrow-left me-2"></i>
                    Kembali
                  </button>
                  <button
                    type="submit"
                    id="btn-form"
                    class="btn btn-primary-custom"
                  >
                    <i class="bi bi-send me-2"></i>
                    Publikasikan
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- Sidebar -->
          <div class="col-lg-4">
            <div class="sidebar-container" id="sidebarCategory">
              <h4 class="section-title">Kategori</h4>
              <p class="section-subtitle">
                Pilih kategori yang sesuai dengan artikel
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer id="footer-container"></footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="../assets/js/custom.js"></script>

    <script>
      $(document).ready(function () {
        $.get("navbar.html", function (data) {
          $("#navbar-container").html(data);
          displayUserInfo(token);
        });

        $.get("footer.html", function (data) {
          $("#footer-container").html(data);
        });

        let fileImage = null;
        let existingImageName = "";
        let mode = "create";
        let articleId = null;

        // Cache elemen jQuery
        const articleForm = $("#articleForm");
        const articleTitleInput = $("#articleTitle");
        const articleIdInput = $("#articleId");
        const publishDateInput = $("#publishDate");
        const imageFileInput = $("#imageFile");
        const previewContainer = $("#previewContainer");
        const uploadArea = $(".image-upload-area");
        const editor = $("#articleContent");
        const hiddenTextarea = $("#articleContentHidden");
        const sidebarCategory = $("#sidebarCategory");
        const submitBtn = $("#btn-form");

        /**
         * decode JWT.
         */
        token = $.cookie("token");
        function displayUserInfo(token) {
          try {
            const decoded = decodeJWT(token);
          } catch (error) {
            console.error("Gagal mendekode token:", error);
            window.location.href = "./index.html";
          }
        }

        /**
         * Mengambil daftar kategori dari API dan menampilkannya sebagai radio button.
         */
        function muatDataCategory() {
          return $.ajax({
            url: `${API_URL}/categories`,
            type: "GET",
            xhrFields: { withCredentials: true },
            success: function (response) {
              response.data.forEach((element) => {
                const categoryId = `cat-${element.id}`;
                const content = `
                        <div class="form-check category-item">
                            <input class="form-check-input" type="radio" name="category" id="${categoryId}" value="${
                  element.id
                }" required>
                            <label class="form-check-label" for="${categoryId}">${toTitleCase(
                  element.name
                )}</label>
                        </div>`;
                sidebarCategory.append(content);
              });
            },
          });
        }

        /**
         * Mengambil data artikel spesifik untuk mode edit dan mengisi form.
         */
        function muatDataArtikel(id) {
          return $.ajax({
            url: `${API_URL}/contents/${id}`,
            type: "GET",
            xhrFields: { withCredentials: true },
            success: function (response) {
              const data = response.data;
              existingImageName = data.image;

              articleIdInput.val(data.id);
              articleTitleInput.val(data.title);
              publishDateInput.val(data.created_at.split(" ")[0]);
              editor.html(data.content);
              hiddenTextarea.val(data.content);

              // Centang radio button kategori yang sesuai
              $(`input[name="category"][value="${data.category_id}"]`).prop(
                "checked",
                true
              );

              console.log(data);

              // Menampilkan preview gambar yang sudah ada
              previewContainer.html(`
                    <img src="${API_URL}/assets/image/${data.image}" alt="Preview" class="img-fluid rounded">
                    <div class="mt-2"><div class="upload-text">Klik atau jatuhkan file untuk mengganti gambar</div></div>
                `);
            },
          });
        }

        /**
         * Menginisialisasi editor teks sederhana.
         */
        function initEditor() {
          editor.on("input", () => hiddenTextarea.val(editor.html()));
          // Handle toolbar buttons
          document
            .querySelectorAll(".editor-btn[data-command]")
            .forEach((btn) => {
              btn.addEventListener("click", function (e) {
                e.preventDefault();
                const command = this.getAttribute("data-command");

                if (command === "createLink") {
                  const url = prompt("Enter URL:");
                  if (url) {
                    document.execCommand(command, false, url);
                  }
                } else {
                  document.execCommand(command, false, null);
                }

                editor.focus();
                updateButtonStates();
              });
            });

          // Handle format block dropdown
          document
            .getElementById("formatBlock")
            .addEventListener("change", function () {
              const command = this.value;
              document.execCommand("formatBlock", false, `<${command}>`);
              editor.focus();
              updateButtonStates();
            });
        }

        /**
         * Menangani logika submit form untuk create dan update.
         */
        function handleFormSubmit(e) {
          e.preventDefault();

          const title = articleTitleInput.val();
          const content = editor.html();
          const selectedCategory = $('input[name="category"]:checked');

          // Validasi Sederhana
          if (!title.trim() || !content.trim()) {
            Swal.fire(
              "Error",
              "Judul dan konten artikel tidak boleh kosong.",
              "error"
            );
            return;
          }
          if (selectedCategory.length === 0) {
            Swal.fire("Error", "Silakan pilih kategori artikel.", "error");
            return;
          }
          if (mode === "create" && !fileImage) {
            Swal.fire("Error", "Silakan upload gambar untuk artikel.", "error");
            return;
          }

          const formData = new FormData();
          formData.append("title", title);
          formData.append("content", content);
          formData.append("category_id", selectedCategory.val());

          let ajaxUrl = `${API_URL}/api/contents`;
          let ajaxMethod = "POST";

          if (mode === "update") {
            formData.append("id", articleId);
            ajaxUrl = `${API_URL}/api/contents`;
            ajaxMethod = "PUT";

            if (fileImage) {
              formData.append("image", fileImage);
            } else {
              formData.append("image_name", existingImageName);
            }
          } else {
            formData.append("image", fileImage);
          }

          const originalBtnText = submitBtn.html();
          submitBtn
            .html(
              '<i class="bi bi-arrow-repeat spinning me-2"></i>Menyimpan...'
            )
            .prop("disabled", true);

          $.ajax({
            url: ajaxUrl,
            method: ajaxMethod,
            data: formData,
            processData: false,
            contentType: false,
            xhrFields: { withCredentials: true },
            success: function () {
              Swal.fire({
                title: "Berhasil!",
                text: `Artikel berhasil di${
                  mode === "update" ? "perbarui" : "publikasikan"
                }.`,
                icon: "success",
                timer: 2000,
                showConfirmButton: false,
              }).then(() => {
                window.location.href = "artikel.html";
              });
            },
            error: function () {
              Swal.fire(
                "Gagal!",
                "Terjadi kesalahan. Silakan coba lagi.",
                "error"
              );
              submitBtn.html(originalBtnText).prop("disabled", false);
            },
          });
        }

        // Dapatkan parameter dari URL
        const params = new URLSearchParams(window.location.search);
        const idFromUrl = params.get("id");

        if (idFromUrl) {
          mode = "update";
          articleId = idFromUrl;
          submitBtn.html('<i class="bi bi-send me-2"></i>Perbarui Artikel');
          $(".hero-title").text("Edit Artikel");
        } else {
          publishDateInput.val(new Date().toISOString().split("T")[0]);
        }

        muatDataCategory()
          .then(() => {
            if (mode === "update") {
              muatDataArtikel(articleId);
            }
          })
          .catch((err) => {
            console.error("Gagal memuat data awal:", err);
            Swal.fire("Error", "Gagal memuat data kategori.", "error");
          });

        // Inisialisasi semua event listener
        initEditor();
        articleForm.on("submit", handleFormSubmit);

        imageFileInput.on("change", function (e) {
          const file = e.target.files[0];
          if (file) {
            fileImage = file;
            const reader = new FileReader();
            reader.onload = function (event) {
              previewContainer.html(
                `<img src="${event.target.result}" alt="Preview" class="img-fluid rounded">`
              );
            };
            reader.readAsDataURL(file);
          }
        });

        // Drag & Drop Listener
        uploadArea.on({
          dragover: function (e) {
            e.preventDefault();
            $(this).addClass("dragover");
          },
          dragleave: function (e) {
            e.preventDefault();
            $(this).removeClass("dragover");
          },
          drop: function (e) {
            e.preventDefault();
            $(this).removeClass("dragover");
            const files = e.originalEvent.dataTransfer.files;
            if (files.length > 0) {
              imageFileInput.prop("files", files).trigger("change");
            }
          },
        });
      });
    </script>
  </body>
</html>
