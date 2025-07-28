<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelola Artikel - Admin Panel Kelurahan Sukaasih</title>

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

    <!-- Custom js -->
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
    <!-- Admin Navbar -->
    <div id="navbar"></div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="container">
        <!-- Page Header -->
        <div class="page-header">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <h1 class="page-title">Kelola Artikel</h1>
              <p class="page-subtitle">
                Manajemen artikel dan berita website Kelurahan Sukaasih
              </p>
            </div>
            <button
              class="btn btn-primary-custom"
              onclick="window.location.href='buat-artikel.html'"
            >
              <i class="bi bi-plus-lg me-2"></i>
              Tambah Artikel
            </button>
          </div>
        </div>

        <!-- Articles Table -->
        <div class="articles-container">
          <div class="filter-controls mb-5 p-4 border rounded-3 bg-light">
            <div class="row g-3 align-items-end">
              <div class="col-lg-6 col-md-12">
                <label for="searchInput" class="form-label fw-semibold"
                  >Cari Judul</label
                >
                <div class="input-group">
                  <span class="input-group-text"
                    ><i class="bi bi-search"></i
                  ></span>
                  <input
                    type="search"
                    id="searchInput"
                    class="form-control"
                    placeholder="Ketik judul artikel..."
                  />
                </div>
              </div>
              <div class="col-lg-6 col-md-12">
                <label
                  for="categoryDropdownButton"
                  class="form-label fw-semibold"
                  >Kategori</label
                >
                <div class="dropdown">
                  <button
                    class="btn btn-light border dropdown-toggle w-100 text-start d-flex justify-content-between align-items-center"
                    type="button"
                    id="categoryDropdownButton"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    Semua Kategori
                  </button>
                  <ul
                    class="dropdown-menu w-100"
                    id="categoryDropdownMenu"
                    aria-labelledby="categoryDropdownButton"
                  >
                    <li>
                      <a
                        class="dropdown-item active"
                        href="#"
                        data-filter="semua"
                        >Semua</a
                      >
                    </li>
                  </ul>
                </div>
              </div>

              <div class="col-lg-3 col-md-6">
                <label for="startDateInput" class="form-label fw-semibold"
                  >Dari Tanggal</label
                >
                <input type="date" id="startDateInput" class="form-control" />
              </div>
              <div class="col-lg-3 col-md-6">
                <label for="endDateInput" class="form-label fw-semibold"
                  >Sampai Tanggal</label
                >
                <input type="date" id="endDateInput" class="form-control" />
              </div>
              <div class="col-lg-3 col-md-12">
                <button
                  id="applyDateFilterButton"
                  class="btn btn-primary w-100"
                >
                  Terapkan Filter
                </button>
              </div>
              <div class="col-lg-3 col-md-12">
                <button
                  id="resetFiltersButton"
                  class="btn btn-outline-secondary w-100"
                >
                  Reset Filter
                </button>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 80px">Gambar</th>
                  <th>Judul Artikel</th>
                  <th>Tanggal</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody id="content"></tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div
            id="pagination-container"
            class="d-flex justify-content-center mt-5"
          ></div>

          <div id="no-results" class="text-center py-5" style="display: none">
            <i class="bi bi-emoji-frown fs-1 text-muted"></i>
            <h4 class="mt-3">Artikel tidak ditemukan</h4>
            <p class="text-muted">
              Coba gunakan kata kunci atau filter kategori yang lain.
            </p>
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
        let currentPage = 1;
        let activeCategory = "semua";
        let searchTerm = "";
        let startDate = "";
        let endDate = "";

        const tbody = $("#content");
        const noResultsMessage = $("#no-results");
        const paginationContainer = $("#pagination-container");
        const categoryDropdownButton = $("#categoryDropdownButton");
        const categoryDropdownMenu = $("#categoryDropdownMenu");
        const searchInput = $("#searchInput");
        const startDateInput = $("#startDateInput");
        const endDateInput = $("#endDateInput");
        const applyDateFilterButton = $("#applyDateFilterButton");
        const resetFiltersButton = $("#resetFiltersButton");

        /**
         * Mengambil dan menampilkan data artikel berdasarkan filter dan halaman.
         */
        function muatData(page) {
          currentPage = page;
          let apiUrl = `${API_URL}/contents?page=${currentPage}`;
          if (activeCategory !== "semua") {
            apiUrl += `&category=${activeCategory}`;
          }
          if (searchTerm.trim() !== "") {
            apiUrl += `&search=${searchTerm.trim()}`;
          }
          if (startDate) apiUrl += `&start_date=${startDate}`;
          if (endDate) apiUrl += `&end_date=${endDate}`;

          tbody.html(
            '<tr><td colspan="4" class="text-center p-5"><div class="spinner-border text-primary" role="status"></div></td></tr>'
          );
          paginationContainer.empty();

          $.ajax({
            url: apiUrl,
            type: "GET",
            xhrFields: { withCredentials: true },
            success: function (response) {
              tbody.empty();
              const articles = response.data;
              const paginationInfo = {
                currentPage: response.current_page,
                totalPages: response.total_pages,
              };

              if (articles && articles.length > 0) {
                noResultsMessage.hide();
                articles.forEach((data) => {
                  const trimmedContent = trimWords(data.content, 10);
                  const cleanData = trimmedContent.replace(/<\/?p>/g, "");
                  const linkForUpdate = `buat-artikel.html?id=${data.id}&type=update`;
                  const publicLink = `../artikel-detail.html?id=${data.id}`;

                  const rowHtml = `
                            <tr>
                                <td><img src="${API_URL}/assets/image/${
                    data.image
                  }" alt="Thumbnail" class="article-thumbnail"/></td>
                                <td>
                                    <h6 class="article-title">${toTitleCase(
                                      data.title
                                    )}</h6>
                                    <p class="article-excerpt">${cleanData}</p>
                                </td>
                                <td>
                                    <div class="article-meta">
                                        <div>${formatDate(
                                          data.created_at
                                        )}</div>
                                        <small class="text-muted">oleh ${toTitleCase(
                                          data.created_by
                                        )}</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="${publicLink}" target="_blank" class="btn-action btn-view" title="Lihat"><i class="bi bi-eye"></i></a>
                                        <a href="${linkForUpdate}" class="btn-action btn-edit" title="Edit"><i class="bi bi-pencil"></i></a>
                                        <button class="btn-action btn-delete" title="Hapus" data-id="${
                                          data.id
                                        }" data-title="${
                    data.title
                  }"><i class="bi bi-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        `;
                  tbody.append(rowHtml);
                });
                renderPagination(paginationInfo);
              } else {
                noResultsMessage.show();
              }
            },
            error: function (xhr) {
              tbody.html(
                '<tr><td colspan="4"><div class="alert alert-danger">Gagal memuat artikel. Silakan coba lagi nanti.</div></td></tr>'
              );
            },
          });
        }

        /**
         * Mengambil dan menampilkan daftar kategori di dropdown.
         */
        function muatDataCategory() {
          return $.ajax({
            url: `${API_URL}/categories`,
            type: "GET",
            xhrFields: { withCredentials: true },
            success: function (response) {
              response.data.forEach((element) => {
                const content = `
                        <li><a class="dropdown-item" href="#" data-filter="${element.name.toLowerCase()}">${toTitleCase(
                  element.name
                )}</a></li>`;
                categoryDropdownMenu.append(content);
              });
            },
          });
        }

        /**
         * Membuat tombol-tombol pagination berdasarkan informasi dari API.
         */
        function renderPagination(paginationInfo) {
          if (!paginationInfo || paginationInfo.totalPages <= 1) {
            paginationContainer.empty();
            return;
          }

          let paginationHtml = '<nav><ul class="pagination">';

          // Tombol "Previous"
          paginationHtml += `
      <li class="page-item ${
        paginationInfo.currentPage === 1 ? "disabled" : ""
      }">
        <a class="page-link" href="#" data-page="${
          paginationInfo.currentPage - 1
        }">Previous</a>
      </li>`;

          // Tombol Halaman Angka
          for (let i = 1; i <= paginationInfo.totalPages; i++) {
            paginationHtml += `
        <li class="page-item ${
          i === paginationInfo.currentPage ? "active" : ""
        }">
          <a class="page-link" href="#" data-page="${i}">${i}</a>
        </li>`;
          }

          // Tombol "Next"
          paginationHtml += `
      <li class="page-item ${
        paginationInfo.currentPage === paginationInfo.totalPages
          ? "disabled"
          : ""
      }">
        <a class="page-link" href="#" data-page="${
          paginationInfo.currentPage + 1
        }">Next</a>
      </li>`;

          paginationHtml += "</ul></nav>";
          paginationContainer.html(paginationHtml);
        }

        /**
         * Menangani konfirmasi dan proses hapus artikel.
         */
        function handleDelete(articleId, articleTitle) {
          Swal.fire({
            title: "Anda Yakin?",
            text: `Artikel "${articleTitle}" akan dihapus secara permanen!`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: `${API_URL}/api/contents/${articleId}`,
                type: "DELETE",
                xhrFields: { withCredentials: true },
                success: function () {
                  Swal.fire(
                    "Terhapus!",
                    "Artikel berhasil dihapus.",
                    "success"
                  );
                  muatData(currentPage);
                },
                error: function (xhr) {
                  if (xhr.status === 401) {
                    refreshAccessToken(confirmDelete);
                  } else if (xhr.status === 400) {
                    Swal.fire(
                      "Gagal!",
                      "Terjadi kesalahan saat menghapus artikel.",
                      "error"
                    );
                  }

                  Swal.fire(
                    "Gagal!",
                    "Terjadi kesalahan saat menghapus artikel.",
                    "error"
                  );
                },
              });
            }
          });
        }

        /**
         * Mereset semua filter ke kondisi awal.
         */
        function resetAllFilters() {
          activeCategory = "semua";
          searchTerm = "";
          startDate = "";
          endDate = "";

          searchInput.val("");
          startDateInput.val("");
          endDateInput.val("");
          categoryDropdownButton.text("Semua Kategori");
          categoryDropdownMenu.find(".active").removeClass("active");
          categoryDropdownMenu
            .find('a[data-filter="semua"]')
            .addClass("active");

          muatData(1);
        }

        // Listener untuk semua filter
        applyDateFilterButton.on("click", () => muatData(1));
        resetFiltersButton.on("click", resetAllFilters);

        searchInput.on("input", () => (searchTerm = searchInput.val()));
        startDateInput.on("change", () => (startDate = startDateInput.val()));
        endDateInput.on("change", () => (endDate = endDateInput.val()));

        categoryDropdownMenu.on("click", "a.dropdown-item", function (e) {
          e.preventDefault();
          activeCategory = $(this).data("filter");
          categoryDropdownButton.text($(this).text());
          categoryDropdownMenu.find(".active").removeClass("active");
          $(this).addClass("active");
        });

        // Event delegation untuk tombol delete
        tbody.on("click", ".btn-delete", function () {
          const id = $(this).data("id");
          const title = $(this).data("title");
          handleDelete(id, title);
        });

        // Event listener untuk pagination
        paginationContainer.on("click", "a.page-link", function (e) {
          e.preventDefault();
          const page = $(this).data("page");
          if (page) {
            muatData(page);
          }
        });

        // Cek token otentikasi
        const token = $.cookie("token");
        if (!token) {
          window.location.href = "/admin/index.html";
          return;
        }

        fetch("navbar.html")
          .then((response) => response.text())
          .then((data) => {
            document.getElementById("navbar").innerHTML = data;
            decodeJWT(token);
          });

        $.get("footer.html", function (data) {
          $("#footer-container").html(data);
        });

        muatDataCategory().then(() => {
          muatData(1);
        });
      });
    </script>
  </body>
</html>
