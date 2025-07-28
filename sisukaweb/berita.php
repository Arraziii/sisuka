<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Berita & Artikel - Kelurahan Sukaasih</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/logo.png" />
    <link rel="shortcut icon" type="image/png" href="assets/img/logo.png" />
    <link rel="apple-touch-icon" href="assets/img/logo.png" />

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
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jwt-decode@4.0.0/build/jwt-decode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
      * {
        font-family: "Inter", sans-serif;
      }

      .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
          url("./assets/img/thumbnail.jpg");
        background-size: cover;
        background-position: center;
        min-height: 400px;
        display: flex;
        align-items: center;
        color: white;
        position: relative;
      }

      .navbar-brand img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: contain;
      }

      .news-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        height: 100%;
      }

      .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      }

      .news-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
      }

      .featured-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 3rem;
      }

      .featured-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
      }

      .filter-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        border: 2px solid #e5e7eb;
        background: white;
        color: #6b7280;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
      }

      .filter-btn:hover,
      .filter-btn.active {
        background: #2563eb;
        border-color: #2563eb;
        color: white;
        text-decoration: none;
      }

      .article-meta {
        font-size: 0.875rem;
        color: #6b7280;
      }

      .article-meta i {
        margin-right: 0.5rem;
      }

      .btn-read-more {
        background: #2563eb;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
      }

      .btn-read-more:hover {
        background: #1e40af;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
      }

      .help-section {
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        color: white;
        padding: 4rem 0;
        text-align: center;
      }

      .btn-help {
        background: white;
        color: #3b82f6;
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
      }

      .btn-help:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(255, 255, 255, 0.3);
        color: white;
      }

      .footer-section {
        background: #1e40af;
        color: white;
        padding: 4rem 0 2rem;
      }

      .footer-link {
        transition: all 0.3s ease;
      }

      .footer-link:hover {
        color: #93c5fd !important;
      }

      .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
      }

      .social-link:hover {
        background: white;
        color: #2563eb;
        transform: translateY(-2px);
      }

      .map-container {
        height: 220px;
        background: #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
      }

      .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
      }

      .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 2rem;
      }

      .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
      }

      .breadcrumb-item a:hover {
        color: white;
      }

      .breadcrumb-item.active {
        color: white;
      }

      /* Styling untuk Kolom Pencarian */
      .search-input.form-control {
        border-radius: 0 50px 50px 0;
        padding-left: 0;
        transition: all 0.3s ease;
      }

      .search-input.form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.25);
        border-color: #93c5fd;
      }

      .input-group-text {
        border-radius: 50px 0 0 50px;
        background-color: white;
      }

      /* Kustomisasi Tampilan Filter Kategori (Nav Pills) */
      .nav-pills .nav-link {
        border-radius: 50px;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        color: #6b7280;
        background-color: #e5e7eb;
        border: 1px solid transparent;
        transition: all 0.3s ease;
        margin: 0 0.25rem;
      }

      .nav-pills .nav-link:hover {
        background-color: #d1d5db;
      }

      .nav-pills .nav-link.active,
      .nav-pills .show > .nav-link {
        background-color: #2563eb;
        color: white;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.25);
      }

      .btn-category-filter {
        background-color: #fff;
        border: 1px solid #dee2e6;
        color: #212529;
        font-weight: 500;
        width: 200px;
        text-align: left;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .btn-category-filter:hover,
      .btn-category-filter:focus {
        background-color: #f8f9fa;
        border-color: #adb5bd;
        color: #212529;
      }
    </style>
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.html">
          <img
            src="assets/img/logo.png"
            alt="Logo Kota Tasikmalaya"
            class="me-2"
          />
          <div>
            <h5 class="mb-0">Kelurahan Sukaasih</h5>
            <small class="text-muted">Kota Tasikmalaya</small>
          </div>
        </a>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.html">Beranda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active fw-semibold" href="berita.html"
                >Berita</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profil.html">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="hubungi-kami.html">Hubungi Kami</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h1 class="page-title">
              Selamat Datang<br />di Kelurahan Sukaasih
            </h1>
            <p class="lead">
              Melayani masyarakat dengan sepenuh hati untuk menciptakan
              lingkungan yang nyaman dan sejahtera
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured Article Section -->
    <section class="py-5">
      <div class="container">
        <div class="featured-card" id="featured-card"></div>
      </div>
    </section>

    <!-- News Grid Section -->
    <section class.py-5 id="artikel" style="background-color: #f8fafc">
      <div class="container">
        <div class="text-center mb-5">
          <h2 class="h3 fw-bold mb-2">Semua Berita & Artikel</h2>
          <p class="text-muted">
            Temukan berita terbaru, artikel informatif, dan cerita menarik dari
            kelurahan kita.
          </p>
        </div>

        <div class="row mb-5 justify-content-between align-items-center">
          <div class="col-lg-4 col-md-5 mb-3 mb-md-0">
            <div class="input-group">
              <span class="input-group-text bg-white border-end-0"
                ><i class="bi bi-search"></i
              ></span>
              <input
                type="search"
                id="searchInput"
                class="form-control border-start-0 search-input"
                placeholder="Cari artikel berdasarkan judul..."
              />
            </div>
          </div>

          <div class="col-lg-auto col-md-5 text-md-end">
            <div class="dropdown">
              <button
                class="btn btn-category-filter dropdown-toggle"
                type="button"
                id="categoryDropdownButton"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Semua Kategori
              </button>
              <ul
                class="dropdown-menu dropdown-menu-end"
                id="categoryDropdownMenu"
                aria-labelledby="categoryDropdownButton"
              >
                <li>
                  <a class="dropdown-item active" href="#" data-filter="semua"
                    >Semua</a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div id="new-content" class="row g-4"></div>
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
    </section>

    <!-- Help Section -->
    <section class="help-section">
      <div class="container">
        <h2 class="mb-4">Butuh Bantuan ?</h2>
        <p class="mb-4">
          Jika Anda memiliki pertanyaan atau membutuhkan bantuan, jangan ragu
          untuk menghubungi kami.
        </p>
        <a href="hubungi-kami.html" class="btn btn-help">
          Hubungi Kami <i class="bi bi-arrow-right ms-2"></i>
        </a>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section" id="hubungi">
      <div class="container">
        <div class="row">
          <!-- Logo dan Deskripsi -->
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="d-flex align-items-center mb-3">
              <img
                src="assets/img/logo.png"
                alt="Logo Kota Tasikmalaya"
                width="50"
                height="50"
                class="me-3"
              />
              <div>
                <h5 class="mb-0 text-white">Kelurahan Sukaasih</h5>
                <small class="text-light opacity-75"
                  >Melayani dengan sepenuh hati</small
                >
              </div>
            </div>
            <p class="small text-light opacity-75 mb-0">
              Website resmi Kelurahan Sukaasih Kecamatan Purbaratu, Kota
              Tasikmalaya, Jawa Barat.
            </p>
          </div>

          <!-- Kontak -->
          <div class="col-lg-3 col-md-6 mb-4">
            <h6 class="fw-bold mb-3 text-white">Kontak</h6>
            <div class="small">
              <div class="d-flex align-items-center mb-2">
                <i class="bi bi-telephone-fill me-3 text-light"></i>
                <span class="text-light">(0262) 123456</span>
              </div>
              <div class="d-flex align-items-center mb-2">
                <i class="bi bi-envelope-fill me-3 text-light"></i>
                <span class="text-light">info@kelurahansukaasih.go.id</span>
              </div>
              <div class="d-flex align-items-start mb-2">
                <i class="bi bi-geo-alt-fill me-3 text-light mt-1"></i>
                <span class="text-light"
                  >Jl. KH. Tubagus Abdullah, Sukaasih, Kec. Purbaratu, Kota
                  Tasikmalaya, Jawa Barat 46196</span
                >
              </div>
              <div class="d-flex align-items-center mb-2">
                <i class="bi bi-clock-fill me-3 text-light"></i>
                <div class="text-light">
                  <div>Jam Operasional:</div>
                  <div>Senin - Jum'at: 08.00 - 16.00 WIB</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Tautan Cepat -->
          <div class="col-lg-2 col-md-6 mb-4">
            <h6 class="fw-bold mb-3 text-white">Tautan Cepat</h6>
            <ul class="list-unstyled small">
              <li class="mb-2">
                <a
                  href="index.html"
                  class="text-light text-decoration-none footer-link"
                  >Beranda</a
                >
              </li>
              <li class="mb-2">
                <a
                  href="profil.html"
                  class="text-light text-decoration-none footer-link"
                  >Profil Kelurahan</a
                >
              </li>
              <li class="mb-2">
                <a
                  href="berita.html"
                  class="text-light text-decoration-none footer-link"
                  >Berita</a
                >
              </li>
              <li class="mb-2">
                <a
                  href="hubungi-kami.html"
                  class="text-light text-decoration-none footer-link"
                  >Hubungi Kami</a
                >
              </li>
            </ul>
          </div>

          <!-- Ikuti Kami -->
          <div class="col-lg-2 col-md-6 mb-4">
            <h6 class="fw-bold mb-3 text-white">Ikuti Kami</h6>
            <div class="d-flex gap-3 mb-3">
              <a href="#" class="social-link" title="Facebook">
                <i class="bi bi-facebook"></i>
              </a>
              <a href="#" class="social-link" title="Instagram">
                <i class="bi bi-instagram"></i>
              </a>
              <a href="#" class="social-link" title="Twitter">
                <i class="bi bi-twitter"></i>
              </a>
            </div>
          </div>

          <!-- Peta Lokasi -->
          <div class="col-lg-2 col-md-6 mb-4">
            <h6 class="fw-bold mb-3 text-white">Peta Lokasi</h6>
            <div
              class="map-container rounded overflow-hidden"
              style="height: 220px; width: 220px"
            >
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d321.73914049798077!2d108.25067743035183!3d-7.322573831091367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f59f08f275609%3A0x4a7cc1e23035e8fa!2sKantor%20Kelurahan%20Sukaasih!5e0!3m2!1sid!2sid!4v1749433706313!5m2!1sid!2sid"
                width="100%"
                height="100%"
                style="border: 0; border-radius: 8px"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Peta Lokasi Kantor Kelurahan Sukaasih"
              >
              </iframe>
            </div>
          </div>
        </div>

        <hr class="my-4 opacity-25" />

        <div class="row align-items-center">
          <div class="col-md-6">
            <p id="copyright" class="small mb-0 text-light opacity-75"></p>
          </div>
          <div class="col-md-6 text-md-end">
            <div class="small">
              <a
                href="#"
                class="text-light text-decoration-none me-3 footer-link"
                >Syarat & Ketentuan</a
              >
              <a href="#" class="text-light text-decoration-none footer-link"
                >Kebijakan Privasi</a
              >
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/custom.js"></script>

    <!-- Filter functionality -->
    <script>
      function muatDataContent() {
        return $.ajax({
          url: `${API_URL}/contents?order=desc`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            // new-content
            const tbody = $("#new-content");
            response.data.forEach((data, i) => {
              let trimmedContent = trimWords(data.content, 15);
              const cleanData = trimmedContent.replace(/<\/?p>/g, "");

              tbody.append(`
                <div class="col-lg-3 col-md-6">
                    <div class="news-card" data-category="${data.category}">
                    <img
                        src="${API_URL}/assets/image/${data.image}"
                        class="news-image"
                    />
                    <div class="p-4">
                        <h5 class="mb-3">
                            ${toTitleCase(data.title)}
                        </h5>
                        <p class="text-muted small mb-3">
                            ${cleanData}
                            <a href="artikel-detail.html?id=${
                              data.id
                            }" class="text-decoration-none">lihat detail</a>
                        </p>
                        <div class="article-meta mb-3">
                        <div><i class="bi bi-calendar"></i>${formatDate(
                          data.created_at
                        )}</div>
                        <div><i class="bi bi-person"></i>${toTitleCase(
                          data.created_by
                        )}</div>
                        </div>
                    </div>
                    </div>
                </div>              
              `);
            });
          },
          error: function (xhr) {
            console.error("error muat data : ", xhr);
          },
        });
      }

      function muatDataCategory() {
        return $.ajax({
          url: `${API_URL}/categories`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            // new-content
            let categoryDropdownMenu = $("#categoryDropdownMenu");

            response.data.forEach((element) => {
              let content = `
              <li>
                <a class="dropdown-item" href="#" data-filter="${element.name.toLowerCase()}">
                  ${toTitleCase(element.name)}
                </a>
              </li>
              `;

              categoryDropdownMenu.append(content);
            });
          },
          error: function (xhr) {
            console.error("error muat data : ", xhr);
          },
        });
      }

      async function loadInitialData() {
        console.log("Mulai memuat semua data awal...");
        try {
          await Promise.all([muatDataContent(), muatDataCategory()]);

          initializeMainScript();
        } catch (error) {
          console.error("Terjadi kegagalan saat memuat data awal:", error);
        }
      }

      window.addEventListener("DOMContentLoaded", loadInitialData);
    </script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
