<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Kategori - Admin Panel Kelurahan Sukaasih</title>

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
        <h1 class="hero-title">Tambah Kategori</h1>
        <p class="hero-subtitle">Admin panel web profil Kelurahan Sukaasih.</p>
      </div>
    </section>

    <!-- Main Content -->
    <div class="main-content">
      <div class="container">
        <div class="row">
          <!-- Main Form -->
          <div class="col-lg-12">
            <div class="form-container">
              <h3 class="section-title">Informasi Dasar</h3>
              <p class="section-subtitle">
                Masukkan kategori yang akan ditambahkan
              </p>

              <form id="categoryForm">
                <!-- Nama Kategori -->
                <div class="mb-3">
                  <label for="categoryName" class="form-label">
                    Nama Kategori <span class="text-danger">*</span>
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    id="categoryName"
                    placeholder="Masukkan kategori"
                    required
                  />
                  <input type="hidden" class="form-control" id="categoryId" />
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                  <button
                    type="button"
                    class="btn btn-secondary-custom"
                    onclick="window.location.href='kategori.html'"
                  >
                    <i class="bi bi-arrow-left me-2"></i>
                    Kembali
                  </button>
                  <button
                    type="submit"
                    id="btn-form"
                    class="btn btn-primary-custom"
                  >
                    Tambahkan
                  </button>
                </div>
              </form>
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

        let mode = "create";
        let categoryId = null;

        // Cache elemen jQuery
        const categoryForm = $("#categoryForm");
        const categoryNameInput = $("#categoryName");
        const categoryIdInput = $("#categoryId");
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
         * Mengambil data kategori spesifik untuk mode edit dan mengisi form.
         */
        function muatDataCategory(id) {
          return $.ajax({
            url: `${API_URL}/categories/${id}`,
            type: "GET",
            xhrFields: { withCredentials: true },
            success: function (response) {
              const data = response.data;
              categoryIdInput.val(data.id);
              categoryNameInput.val(data.name);
            },
          });
        }

        /**
         * Menangani logika submit form untuk create dan update.
         */
        function handleFormSubmit(e) {
          e.preventDefault();

          const categoryName = categoryNameInput.val();

          // Validasi Sederhana
          if (!categoryName.trim()) {
            Swal.fire("Error", "Kategori tidak boleh kosong.", "error");
            return;
          }

          const formData = new FormData();
          formData.append("name", categoryName);

          let ajaxUrl = `${API_URL}/api/categories`;
          let ajaxMethod = "POST";

          if (mode === "update") {
            formData.append("id", categoryId);
            ajaxUrl = `${API_URL}/api/categories`;
            ajaxMethod = "PUT";
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
                text: `Kategori berhasil di${
                  mode === "update" ? "perbarui" : "simpan"
                }.`,
                icon: "success",
                timer: 2000,
                showConfirmButton: false,
              }).then(() => {
                window.location.href = "kategori.html";
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
          categoryId = idFromUrl;
          submitBtn.html('<i class="bi bi-send me-2"></i>Perbarui Kategori');
          $(".hero-title").text("Edit Kategori");
        }

        if (mode === "update") {
          muatDataCategory(categoryId)
            .then(() => {})
            .catch((err) => {
              console.error("Gagal memuat data awal:", err);
              Swal.fire("Error", "Gagal memuat data kategori.", "error");
            });
        }

        categoryForm.on("submit", handleFormSubmit);
      });
    </script>
  </body>
</html>
