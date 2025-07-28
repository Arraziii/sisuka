<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Kelurahan - Kelurahan Sukaasih</title>

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

      .profile-tabs {
        background: #f8fafc;
        padding: 2rem 0;
        border-bottom: 1px solid #e5e7eb;
      }

      .tab-button {
        background: #e2e8f0;
        border: none;
        padding: 0.75rem 1.5rem;
        color: #64748b;
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 25px;
        margin: 0 0.25rem;
        font-size: 0.9rem;
        min-width: 100px;
      }

      .tab-button:hover {
        color: #475569;
        background: #cbd5e1;
        transform: translateY(-1px);
      }

      .tab-button.active {
        color: #1e293b;
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        font-weight: 600;
      }

      .tab-content-section {
        padding: 4rem 0;
        min-height: 60vh;
      }

      .info-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
      }

      .stat-box {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        height: 100%;
      }

      .stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.5rem;
      }

      .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
      }

      .stat-label {
        color: #6b7280;
        font-weight: 500;
      }

      .visi-misi-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        border-left: 5px solid #3b82f6;
      }

      .visi-misi-card h4 {
        color: #1f2937;
        font-weight: 600;
        margin-bottom: 1.5rem;
      }

      .visi-misi-card p {
        color: #4b5563;
        line-height: 1.8;
        font-size: 1.1rem;
      }

      .struktur-container {
        text-align: center;
        padding: 2rem 0;
      }

      .org-chart {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3rem;
      }

      .org-level {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
      }

      .org-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        text-align: center;
        min-width: 200px;
        transition: all 0.3s ease;
      }

      .org-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
      }

      .org-photo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin: 0 auto 1rem;
        object-fit: cover;
        border: 4px solid #e5e7eb;
      }

      .org-photo.placeholder {
        background: #d1d5db;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-size: 2rem;
      }

      .org-name {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.5rem;
      }

      .org-position {
        color: #6b7280;
        font-size: 0.875rem;
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

      .breadcrumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 0.5rem 1rem;
      }

      .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
      }

      .breadcrumb-item.active {
        color: white;
      }

      .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.6);
      }

      .section-divider {
        width: 60px;
        height: 3px;
        background: white;
        border-radius: 2px;
        margin-bottom: 1.5rem;
      }

      /* Responsive adjustments */
      @media (max-width: 768px) {
        .hero-section {
          min-height: 400px;
          text-align: center;
        }

        .tab-button {
          padding: 0.75rem 1rem;
          font-size: 0.875rem;
        }

        .org-level {
          flex-direction: column;
          gap: 1rem;
        }

        .org-card {
          min-width: 250px;
        }
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
              <a class="nav-link" href="berita.html">Berita</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active fw-semibold" href="profil.html"
                >Profil</a
              >
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
            <h1 class="display-4 fw-bold mb-4">Profil Kelurahan Sukaasih</h1>
            <p class="lead mb-4">
              Mengenal lebih dekat Kelurahan Sukaasih, sejarah, visi & misi,
              struktur organisasi dan lain-lain.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Profile Tabs -->
    <section class="profile-tabs">
      <div class="container">
        <div class="d-flex justify-content-center">
          <button class="tab-button active" data-tab="tentang">Tentang</button>
          <button class="tab-button" data-tab="visi-misi">Visi & Misi</button>
          <button class="tab-button" data-tab="struktur">Struktur</button>
        </div>
      </div>
    </section>

    <!-- Tab Content -->
    <section class="tab-content-section">
      <div class="container">
        <!-- Tentang Tab -->
        <div id="tentang-content" class="tab-content active">
          <div class="row">
            <div class="col-lg-8">
              <h2 class="mb-4">Tentang Kelurahan Sukaasih</h2>
              <div class="info-card">
                <p class="mb-4">
                  Kelurahan Sukaasih merupakan salah satu kelurahan di Kecamatan
                  Tawang Kidul, Kabupaten Garut, Jawa Barat. Kelurahan Sukaasih
                  memiliki luas wilayah sekitar 2,5 km² dengan jumlah penduduk
                  mencapai 5.240 jiwa.
                </p>

                <p class="mb-4">
                  Kelurahan Sukaasih terdiri dari 12 RW dan 48 RT. Mayoritas
                  penduduk Kelurahan Sukaasih bekerja sebagai petani, pedagang,
                  dan pegawai swasta.
                </p>

                <p class="mb-0">
                  Kelurahan Sukaasih memiliki berbagai fasilitas umum seperti
                  sekolah, puskesmas, masjid, dan pasar. Kelurahan ini juga
                  memiliki potensi ekonomi yang cukup baik, terutama di sektor
                  pertanian dan perdagangan.
                </p>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="info-card">
                <h5 class="mb-4">Informasi Umum</h5>

                <div class="d-flex align-items-center mb-3">
                  <i class="bi bi-geo-alt text-primary me-3 fs-5"></i>
                  <div>
                    <strong>Alamat Kantor</strong><br />
                    <small class="text-muted"
                      >Jl. KH. Tubagus Abdullah Sukaasih, Kota Tasikmalaya, Jawa
                      Barat</small
                    >
                  </div>
                </div>

                <div class="d-flex align-items-center mb-3">
                  <i class="bi bi-geo text-primary me-3 fs-5"></i>
                  <div>
                    <strong>Batas Wilayah</strong><br />
                    <small class="text-muted"
                      >Utara: Berbatasan dengan Kelurahan Sukajaya<br />
                      Selatan: Berbatasan dengan Kelurahan Purbaratu<br />
                      Timur: Berbatasan dengan wilayah Kabupaten Tasikmalaya<br />
                      Barat: Berbatasan dengan Kelurahan Singkup</small
                    >
                  </div>
                </div>
              </div>

              <!-- <div class="row g-3 mt-3">
                            <div class="col-6">
                                <div class="stat-box">
                                    <div class="stat-icon">
                                        <i class="bi bi-calendar"></i>
                                    </div>
                                    <div class="stat-number"></div>
                                    <div class="stat-label">Tahun Berdiri</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-box">
                                    <div class="stat-icon">
                                        <i class="bi bi-pin-map"></i>
                                    </div>
                                    <div class="stat-number">2,5 km²</div>
                                    <div class="stat-label">Luas Wilayah</div>
                                </div>
                            </div>
                        </div> -->
            </div>
          </div>
        </div>

        <!-- Visi & Misi Tab -->
        <div id="visi-misi-content" class="tab-content">
          <div class="text-center mb-5">
            <h2>Visi & Misi</h2>
            <p class="text-muted">
              Visi dan misi Kelurahan Sukaasih dalam melayani masyarakat
            </p>
          </div>

          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="visi-misi-card">
                <h4>Visi</h4>
                <p class="mb-0">
                  "Bekerja melayani Masyarakat di landasi niat ibadah demi
                  mewujudkan desa mandiri tumbuh sejahtera dan religius"
                </p>
              </div>

              <div class="visi-misi-card">
                <h4>Misi</h4>
                <ol>
                  <li>Menciptakan pemerintah Desa berjiwa pengabdi</li>
                  <li>
                    Menciptakan tata kelola Pemdes yang partisipatif,
                    transparan, dan tidak nepotis
                  </li>
                  <li>Menciptakan kerukunan, kerjasama antar lembaga Desa</li>
                  <li>
                    Menciptakan / Menggali potensi prestasi pemuda se wilayah
                    desa
                  </li>
                  <li>Meningkatkan pendidikan baik formal maupun non formal</li>
                  <li>Meningkatkan pelayanan kesehatan Desa yang maksimal</li>
                  <li>
                    Meningkatkan Kualitas dan produktivitas pertanian,
                    perikanan, dan peternakan
                  </li>
                  <li>
                    Meningkatkan dan mengembangkan perekonomian Desa melalui
                    BUMDES
                  </li>
                  <li>
                    Meningkatkan / menertibkan aset desa dan memanfaatkannya
                    demi kepentingan masyarakat
                  </li>
                  <li>Meningkatkan sistem keamanan</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <!-- Struktur Tab -->
        <div id="struktur-content" class="tab-content">
          <div class="struktur-container">
            <div class="text-center mb-5">
              <h2>Struktur Organisasi</h2>
              <p class="text-muted">Struktur organisasi Kelurahan Sukaasih</p>
            </div>

            <div class="org-chart">
              <!-- Level 1 - Kepala Kelurahan -->
              <div class="org-level">
                <div class="org-card">
                  <img
                    src="assets/img/default.png"
                    alt="Kepala Kelurahan"
                    class="org-photo"
                    id="kepalaGambar"
                  />
                  <div class="org-name" id="kepala"></div>
                  <div class="org-position">Kepala Kelurahan</div>
                </div>
              </div>

              <!-- Level 2 - Sekretaris dan Kasi -->
              <div class="org-level">
                <div class="org-card">
                  <img
                    src="assets/img/default.png"
                    alt="Sekretaris"
                    class="org-photo"
                    id="sekretarisGambar"
                  />
                  <div class="org-name" id="sekretaris"></div>
                  <div class="org-position">Sekretaris Kelurahan</div>
                </div>

                <div class="org-card">
                  <img
                    src="assets/img/default.png"
                    alt="Kasi Pemerintahan"
                    class="org-photo"
                    id="trantibGambar"
                  />
                  <div class="org-name" id="trantib"></div>
                  <div class="org-position">Kasi Pemerintahan / Trantib</div>
                </div>

                <div class="org-card">
                  <img
                    src="assets/img/default.png"
                    alt="Kasi Pemerintahan"
                    class="org-photo"
                    id="kasiKesraGambar"
                  />
                  <div class="org-name" id="kasiKesra">-</div>
                  <div class="org-position">Kasi Kesra</div>
                </div>
              </div>

              <!-- Level 3 - Staff -->
              <div class="org-level">
                <div class="org-card">
                  <img
                    src="assets/img/default.png"
                    alt="Pengelola Data"
                    class="org-photo"
                    id="pengelolaDataGambar"
                  />
                  <div class="org-name" id="pengelolaData"></div>
                  <div class="org-position">Pengelola Data</div>
                </div>

                <div class="org-card">
                  <img
                    src="assets/img/default.png"
                    alt="Petugas Kebersihan"
                    class="org-photo"
                    id="petugasKebersihanGambar"
                  />
                  <div
                    class="org-name"
                    id="petugasKebersihanPemerintahan"
                  ></div>
                  <div class="org-position">
                    Petugas Kebersihan Pemerintahan
                  </div>
                </div>
              </div>
            </div>
          </div>
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
    <script>
      function muatDataStruktur() {
        // lurah
        $.ajax({
          url: `${API_URL}/data-staff?type=kepala kelurahan`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            console.log(response);

            // new-content
            let kepala = $("#kepala");
            kepala.append(response.data.name);

            let kepalaGambar = $("#kepalaGambar");
            kepalaGambar.attr(
              "src",
              `${API_URL}/assets/image/user/${response.data.image}`
            );
          },
          error: function (xhr) {
            console.error("error muat data : ", xhr);
          },
        });

        // sekretaris
        $.ajax({
          url: `${API_URL}/data-staff?type=sekretaris kelurahan`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            console.log("ada");

            console.log(response);

            // new-content
            let sekretaris = $("#sekretaris");
            sekretaris.append(response.data.name);

            let sekretarisGambar = $("#sekretarisGambar");
            sekretarisGambar.attr(
              "src",
              `${API_URL}/assets/image/user/${response.data.image}`
            );
          },
          error: function (xhr) {
            console.error("error muat data : ", xhr);
          },
        });

        // trantib
        $.ajax({
          url: `${API_URL}/data-staff?type=trantib`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            console.log(response);

            // new-content
            let trantib = $("#trantib");
            trantib.append(response.data.name);

            let trantibGambar = $("#trantibGambar");
            trantibGambar.attr(
              "src",
              `${API_URL}/assets/image/user/${response.data.image}`
            );
          },
          error: function (xhr) {
            console.error("error muat data : ", xhr);
          },
        });

        // kasikesra
        $.ajax({
          url: `${API_URL}/data-staff?type=kasikesra`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            console.log(response);

            // new-content
            let kasiKesra = $("#kasiKesra");
            kasiKesra.append(response.data.name);

            let kasiKesraGambar = $("#kasiKesraGambar");
            kasiKesraGambar.attr(
              "src",
              `${API_URL}/assets/image/user/${response.data.image}`
            );
          },
          error: function (xhr) {
            console.error("error muat data : ", xhr);
          },
        });

        // pengelola data
        $.ajax({
          url: `${API_URL}/data-staff?type=pengelola data`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            console.log(response);

            // new-content
            let pengelolaData = $("#pengelolaData");
            pengelolaData.append(response.data.name);

            let pengelolaDataGambar = $("#pengelolaDataGambar");
            pengelolaDataGambar.attr(
              "src",
              `${API_URL}/assets/image/user/${response.data.image}`
            );
          },
          error: function (xhr) {
            console.error("error muat data : ", xhr);
          },
        });

        // petugas kebersihan pemerintahan
        $.ajax({
          url: `${API_URL}/data-staff?type=petugas kebersihan pemerintahan`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            console.log(response);

            // new-content
            let petugasKebersihanPemerintahan = $(
              "#petugasKebersihanPemerintahan"
            );
            petugasKebersihanPemerintahan.append(response.data.name);

            let petugasKebersihanGambar = $("#petugasKebersihanGambar");
            petugasKebersihanGambar.attr(
              "src",
              `${API_URL}/assets/image/user/${response.data.image}`
            );
          },
          error: function (xhr) {
            console.error("error muat data : ", xhr);
          },
        });
      }

      // Tab functionality
      document.addEventListener("DOMContentLoaded", function () {
        const tabButtons = document.querySelectorAll(".tab-button");
        const tabContents = document.querySelectorAll(".tab-content");

        tabButtons.forEach((button) => {
          button.addEventListener("click", function () {
            const targetTab = this.getAttribute("data-tab");

            if (targetTab === "struktur") {
              muatDataStruktur();
            }

            // Remove active class from all buttons and contents
            tabButtons.forEach((btn) => btn.classList.remove("active"));
            tabContents.forEach((content) => {
              content.classList.remove("active");
              content.style.display = "none";
            });

            // Add active class to clicked button and corresponding content
            this.classList.add("active");
            const targetContent = document.getElementById(
              targetTab + "-content"
            );
            if (targetContent) {
              targetContent.classList.add("active");
              targetContent.style.display = "block";
            }
          });
        });

        // Initialize first tab as active
        const firstTab = document.querySelector(".tab-button.active");
        if (firstTab) {
          const targetTab = firstTab.getAttribute("data-tab");
          const targetContent = document.getElementById(targetTab + "-content");
          if (targetContent) {
            targetContent.style.display = "block";
          }
        }

        // Hide non-active tabs initially
        tabContents.forEach((content, index) => {
          if (!content.classList.contains("active")) {
            content.style.display = "none";
          }
        });
      });

      // Smooth scrolling for internal links
      document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute("href"));
          if (target) {
            target.scrollIntoView({
              behavior: "smooth",
              block: "start",
            });
          }
        });
      });

      // Organization card hover effects
      document.querySelectorAll(".org-card").forEach((card) => {
        card.addEventListener("mouseenter", function () {
          this.style.transform = "translateY(-10px) scale(1.05)";
        });

        card.addEventListener("mouseleave", function () {
          this.style.transform = "translateY(0) scale(1)";
        });
      });

      // Animate elements on scroll
      const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
      };

      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
          }
        });
      }, observerOptions);

      // Observe elements for animation
      document
        .querySelectorAll(".org-card, .info-card, .stat-box, .visi-misi-card")
        .forEach((el) => {
          el.style.opacity = "0";
          el.style.transform = "translateY(20px)";
          el.style.transition = "all 0.6s ease";
          observer.observe(el);
        });
    </script>
  </body>
</html>
