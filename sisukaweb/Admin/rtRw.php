<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelola Staf - Admin Panel Kelurahan Sukaasih</title>

    <meta
      name="description"
      content="Halaman administrasi untuk mengelola data staf Kelurahan Sukaasih."
    />
    <link rel="icon" href="../assets/img/logo.png" type="image/png" />
    <link rel="apple-touch-icon" href="../assets-img/logo.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />

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

      /* Main Content */
      .main-content {
        padding: 2rem 0;
        min-height: calc(100vh - 200px);
      }

      .page-header {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      }

      .page-title {
        color: #1e293b;
        font-weight: 600;
        margin-bottom: 0.5rem;
      }

      .page-subtitle {
        color: #64748b;
        margin: 0;
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
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(30, 64, 175, 0.3);
      }

      /* Article Table */
      .articles-container {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      }

      .table-responsive {
        border-radius: 8px;
        overflow: hidden;
      }

      .table {
        margin: 0;
      }

      .table th {
        background: #f8fafc;
        color: #374151;
        font-weight: 600;
        border: none;
        padding: 1rem;
        vertical-align: middle;
      }

      .table td {
        padding: 1rem;
        vertical-align: middle;
        border-color: #e5e7eb;
      }

      .article-thumbnail {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
      }

      .article-title {
        color: #1e293b;
        font-weight: 500;
        margin: 0;
        line-height: 1.4;
      }

      .article-excerpt {
        color: #64748b;
        font-size: 0.875rem;
        margin: 0.25rem 0 0 0;
        line-height: 1.4;
      }

      .article-meta {
        font-size: 0.875rem;
        color: #6b7280;
      }

      .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
      }

      .status-published {
        background: #dcfce7;
        color: #166534;
      }

      .status-draft {
        background: #fef3c7;
        color: #92400e;
      }

      /* Action Buttons */
      .action-buttons {
        display: flex;
        gap: 0.5rem;
      }

      .btn-action {
        padding: 0.5rem;
        border: none;
        border-radius: 6px;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
      }

      .btn-view {
        background: #0ea5e9;
      }

      .btn-view:hover {
        background: #0284c7;
        color: white;
      }

      .btn-edit {
        background: #f59e0b;
      }

      .btn-edit:hover {
        background: #d97706;
        color: white;
      }

      .btn-delete {
        background: #ef4444;
      }

      .btn-delete:hover {
        background: #dc2626;
        color: white;
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

      /* Responsive */
      @media (max-width: 768px) {
        .main-content {
          padding: 1rem 0;
        }

        .page-header {
          padding: 1.5rem;
          margin-bottom: 1.5rem;
        }

        .articles-container {
          padding: 1.5rem;
        }

        .action-buttons {
          flex-direction: column;
          gap: 0.25rem;
        }

        .table-responsive {
          font-size: 0.875rem;
        }
      }
    </style>
  </head>

  <body>
    <header id="navbar-container"></header>

    <main class="main-content py-5">
      <div class="container">
        <div class="page-header mb-4">
          <h1 class="page-title">Kelola Rt / Rw</h1>
          <p class="page-subtitle text-muted">
            Manajemen jumlah rt/rw yang ditampilkan di halaman publik.
          </p>
        </div>

        <div class="card shadow-sm">
          <div class="card-body p-4">
            <form id="rtRwForm">
              <div class="row g-4">
                <div class="col-lg-12">
                  <fieldset class="border rounded p-3 mb-">
                    <legend class="float-none w-auto px-2 h6">
                      Masukan Jumlah RT
                    </legend>
                    <div class="mb-3">
                      <label for="jumlahRt" class="form-label"
                        >Jumlah RT <span class="text-danger">*</span></label
                      >
                      <input
                        type="number"
                        class="form-control"
                        id="jumlahRt"
                        placeholder="Masukkan jumlah rt"
                        required
                      />
                      <input type="hidden" id="idRt" />
                    </div>
                  </fieldset>

                  <fieldset class="border rounded p-3 mb-">
                    <legend class="float-none w-auto px-2 h6">
                      Masukan Jumlah RW
                    </legend>
                    <div class="mb-3">
                      <label for="jumlahRw" class="form-label"
                        >Jumlah RW <span class="text-danger">*</span></label
                      >
                      <input
                        type="number"
                        class="form-control"
                        id="jumlahRw"
                        placeholder="Masukkan jumlah rw"
                        required
                      />
                      <input type="hidden" id="idRw" />
                    </div>
                  </fieldset>
                </div>
              </div>

              <hr class="my-4" />

              <div class="text-end">
                <button
                  type="submit"
                  id="btn-form"
                  class="btn btn-primary px-4 py-2"
                >
                  <i class="bi bi-save me-2"></i>Simpan Perubahan
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

    <footer id="footer-container"></footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@4.0.0/build/jwt-decode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/custom.js"></script>
    <script>
      $(document).ready(function () {
        const token = $.cookie("token");
        if (!token) {
          window.location.href = "./index.html";
          return;
        }

        $.get("navbar.html", function (data) {
          $("#navbar-container").html(data);
          displayUserInfo(token);
        });
        $.get("footer.html", function (data) {
          $("#footer-container").html(data);
        });

        populateExistingData();
      });

      /**
       * Mengambil data RT dan RW yang sudah ada dan mengisinya ke dalam form.
       */
      function populateExistingData() {
        const rtUrl = `${API_URL}/data-dynamic?type=rt`;
        const rwUrl = `${API_URL}/data-dynamic?type=rw`;

        // Mengambil data RT
        $.ajax({
          url: rtUrl,
          type: "GET",
          xhrFields: { withCredentials: true },
          success: function (response) {
            if (response.data) {
              $("#jumlahRt").val(response.data.value);
              $("#idRt").val(response.data.id);
            }
          },
          error: function (xhr) {
            console.error("Gagal memuat data RT:", xhr.responseText);
          },
        });

        // Mengambil data RW
        $.ajax({
          url: rwUrl,
          type: "GET",
          xhrFields: { withCredentials: true },
          success: function (response) {
            if (response.data) {
              $("#jumlahRw").val(response.data.value);
              $("#idRw").val(response.data.id);
            }
          },
          error: function (xhr) {
            console.error("Gagal memuat data RW:", xhr.responseText);
          },
        });
      }

      /**
       * User Info.
       */
      function displayUserInfo(token) {
        try {
          const decoded = decodeJWT(token);
        } catch (error) {
          console.error("Gagal mendekode token:", error);
          window.location.href = "./index.html";
        }
      }

      /**
       * Event handler untuk submit form.
       */
      $("#rtRwForm").on("submit", function (event) {
        event.preventDefault();

        const btn = $("#btn-form");
        btn
          .prop("disabled", true)
          .html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...'
          );

        // Ambil data dari form
        const dataToUpdate = [
          {
            id: parseInt($("#idRt").val()),
            value: $("#jumlahRt").val(),
          },
          {
            id: parseInt($("#idRw").val()),
            value: $("#jumlahRw").val(),
          },
        ];

        // Panggil fungsi untuk mengirim data ke API
        updateData(dataToUpdate, btn);
      });

      /**
       * Mengirim data yang diperbarui ke REST API.
       */
      function updateData(data, btn) {
        $.ajax({
          url: `${API_URL}/api/data-dynamic`,
          type: "PUT",
          contentType: "application/json",
          data: JSON.stringify({ items: data }),
          xhrFields: { withCredentials: true },
          success: function (response) {
            Swal.fire({
              icon: "success",
              title: "Berhasil!",
              text: "Data jumlah RT dan RW telah berhasil diperbarui.",
              timer: 2000,
              showConfirmButton: false,
            });
          },
          error: function (xhr) {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Gagal memperbarui data. Silakan coba lagi.",
            });
            console.error("Gagal update data:", xhr.responseText);
          },
          complete: function () {
            btn
              .prop("disabled", false)
              .html('<i class="bi bi-save me-2"></i>Simpan Perubahan');
          },
        });
      }
    </script>
  </body>
</html>
