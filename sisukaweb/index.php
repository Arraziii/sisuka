<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Desa Sukamanah - Kabupaten Tasikmalaya</title>

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
        min-height: 500px;
        display: flex;
        align-items: center;
        color: white;
      }

      .navbar-brand img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: contain;
      }

      .stat-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #e9ecef;
      }

      .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: #2563eb;
      }

      .news-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
      }

      .news-card:hover {
        transform: translateY(-5px);
      }

      .news-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
      }

      /* Fix for equal height cards */
      .news-card .p-3,
      .news-card .p-4 {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
      }

      .news-card .flex-grow-1 {
        flex-grow: 1 !important;
      }

      .news-card .mt-auto {
        margin-top: auto !important;
      }

      /* Featured news image fix */
      .news-card .w-100 {
        object-fit: cover;
      }

      .section-title {
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 1rem;
      }

      .section-subtitle {
        color: #6b7280;
        margin-bottom: 3rem;
      }

      .btn-primary-custom {
        background: #2563eb;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 500;
      }

      .btn-outline-custom {
        border: 2px solid white;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 500;
      }

      .footer-section {
        background: #1e40af;
        color: white;
        padding: 4rem 0 2rem;
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

      .map-container {
        height: 300px;
        background: #e5e7eb;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
      }

      .btn-hubungi-kami {
        cursor: pointer;
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
            <h5 class="mb-0">Desa Sukamanah</h5>
            <small class="text-muted">Kabupaten Tasikmalaya</small>
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
              <a class="nav-link active fw-semibold" href="index.html"
                >Beranda</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="berita.html">Berita</a>
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
    <section class="hero-section" id="beranda">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-4">
              Selamat Datang<br />
              di Desa Sukamanah
            </h1>
            <p class="lead mb-4">
              Melayani masyarakat dengan sepenuh hati untuk menciptakan
              lingkungan yang nyaman dan sejahtera.
            </p>
            <div class="d-flex gap-3">
              <a
                href="berita.html"
                class="btn-primary-custom text-decoration-none"
                style="color: white"
                >Lihat Berita</a
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section class="py-5" id="about">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h2 class="section-title">
              Selamat Datang di website Desa Sukamanah
            </h2>
            <div class="section-divider"></div>

            <p class="mb-4">
              Desa Sukamanah merupakan salah satu desa di Kecamatan Cigalontang,
              Kabupaten Tasikmalaya, Jawa Barat.
            </p>

            <p class="mb-0">
              Kami berkomitmen untuk memberikan pelayanan terbaik bagi seluruh
              warga. Website ini hadir sebagai sarana komunikasi terkini dan
              kegiatan di Desa Sukamanah.
            </p>
          </div>
          <div class="col-lg-6">
            <img
              src="assets/img/logo.png"
              alt="Desa Sukamanah"
              class="img-fluid rounded shadow-lg"
              style="width: 100%; height: 300px; object-fit: contain"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-5" id="statistics">
      <div class="container">
        <div class="row g-4">
          <div class="col-md-4">
            <div class="stat-card">
              <i class="bi bi-building fs-1 text-primary mb-3"></i>
              <div class="stat-number" id="jumlahRw"></div>
              <div class="text-muted">RW</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <i class="bi bi-people fs-1 text-primary mb-3"></i>
              <div class="stat-number" id="jumlahRT"></div>
              <div class="text-muted">RT</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <i class="bi bi-calendar fs-1 text-primary mb-3"></i>
              <div class="stat-number">1900</div>
              <div class="text-muted">Tahun Berdiri</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- News Section -->
    <section class="py-5" id="berita">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
            <h2 class="section-title">Berita & Kegiatan Terbaru</h2>
            <div class="section-divider mb-3"></div>
            <p class="section-subtitle mb-0">
              Dapatkan informasi terbaru seputar kegiatan dan berita di Desa
              Sukamanah
            </p>
          </div>
          <a
            href="berita.html"
            class="text-primary text-decoration-none fw-semibold"
            >Lihat Semua Berita <i class="bi bi-arrow-right"></i
          ></a>
        </div>

        <!-- Featured News -->
        <div class="row mb-4">
          <div
            id="newsCarousel"
            class="col-12 carousel slide"
            data-bs-ride="carousel"
          >
            <div class="carousel-inner"></div>

            <!-- Tombol Navigasi -->
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#newsCarousel"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#newsCarousel"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
            </button>
          </div>
        </div>

        <!-- News Grid -->
        <div class="row g-4" id="new-content"></div>
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
                <h5 class="mb-0 text-white">Desa Sukamanah</h5>
                <small class="text-light opacity-75"
                  >Melayani dengan sepenuh hati</small
                >
              </div>
            </div>
            <p class="small text-light opacity-75 mb-0">
              Website resmi Desa Sukamanah Kecamatan Cigalontang, Kabupaten
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
                <span class="text-light">Sukamanah1900@gmail.com</span>
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
                title="Peta Lokasi Kantor Desa Sukamanah"
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
    <script>
      function muatDataContent() {
        return $.ajax({
          url: `${API_URL}/contents/limit?order=desc`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            // new-content
            const tbody = $("#new-content");
            response.data.forEach((data, i) => {
              let trimmedContent = trimWords(data.content, 7);
              const cleanData = trimmedContent.replace(/<\/?p>/g, "");

              tbody.append(`
                <div class="col-lg-3 col-md-6">
                    <div class="news-card news-card-modern h-100" data-category="${
                      data.category
                    }">
                    <div class="news-image-container">
                        <img
                        src="${API_URL}/assets/image/${data.image}"
                        class="news-image-modern"
                        />
                    </div>
                    <div class="news-content-modern">
                        <h5 class="news-title-modern">
                        ${toTitleCase(data.title)}
                        </h5>
                        <p class="news-description-modern">
                        ${cleanData} <a href="artikel-detail.html?id=${
                data.id
              }" class="text-decoration-none">lihat detail</a>
                        
                        </p>
                        <div class="news-meta-modern">
                        <div class="meta-item">
                            <i class="bi bi-calendar"></i>
                            <span>${formatDate(data.created_at)}</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-person"></i>
                            <span>${toTitleCase(data.created_by)}</span>
                        </div>
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

      function muatDataRtRw() {
        const req1 = $.ajax({
          url: `${API_URL}/data-dynamic?type=Rw`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            // new-content
            let jumlahRw = $("#jumlahRw");
            jumlahRw.append(response.data.value);
          },
          error: function (xhr) {
            console.error("error muat data : ", xhr);
          },
        });

        const req2 = $.ajax({
          url: `${API_URL}/data-dynamic?type=Rt`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            // new-content
            let jumlahRt = $("#jumlahRT");
            jumlahRt.append(response.data.value);
          },
          error: function (xhr) {
            console.error("error muat data : ", xhr);
          },
        });

        return Promise.all([req1, req2]);
      }

      async function loadInitialData() {
        console.log("Mulai memuat semua data awal...");
        try {
          await Promise.all([muatDataRtRw(), muatDataContent()]);
        } catch (error) {
          console.error("Terjadi kegagalan saat memuat data awal:", error);
        }
      }
      window.addEventListener("DOMContentLoaded", loadInitialData);
    </script>
  </body>
</html>
