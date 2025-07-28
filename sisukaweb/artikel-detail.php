<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      Pembagian Bantuan Sosial untuk Warga Terdampak - Desa Sukamanah
    </title>

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
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        background: #f8f9fa;
        line-height: 1.6;
      }

      /* Navbar brand styling */
      .navbar-brand h5 {
        color: #000000;
        margin: 0;
        font-weight: 600;
      }

      .navbar-brand small {
        color: #6b7280;
      }

      /* Hero Section */
      .hero-section {
        background: linear-gradient(135deg, #4f87d1, #3662a0);
        color: white;
        padding: 2rem 0;
      }

      .back-button {
        color: white;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
      }

      .back-button:hover {
        color: #e2e8f0;
        transform: translateX(-5px);
      }

      .article-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.2;
      }

      .article-meta {
        display: flex;
        gap: 2rem;
        align-items: center;
        opacity: 0.9;
        color: white;
      }

      .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: white;
      }

      .meta-item i {
        font-size: 1rem;
        color: white;
      }

      /* Main Content */
      .main-content {
        padding: 3rem 0;
      }

      .article-container {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
      }

      .featured-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 2rem;
      }

      .article-content {
        color: #374151;
        font-size: 1.05rem;
        line-height: 1.8;
      }

      .article-content p {
        margin-bottom: 1.5rem;
      }

      .article-content p:last-child {
        margin-bottom: 0;
      }

      /* Sidebar */
      .sidebar-container {
        position: sticky;
        top: 2rem;
      }

      .sidebar-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
      }

      .sidebar-title {
        color: #1e293b;
        font-weight: 600;
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
      }

      .related-article {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        align-items: flex-start;
      }

      .related-article:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
      }

      .related-thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
      }

      .related-content {
        flex: 1;
        min-width: 0;
      }

      .related-content h6 {
        color: #1e293b;
        font-weight: 500;
        margin-bottom: 0.5rem;
        line-height: 1.3;
        font-size: 0.9rem;
        word-wrap: break-word;
      }

      .related-content small {
        color: #6b7280;
        font-size: 0.8rem;
      }

      .related-article a {
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
      }

      .related-article:hover {
        transform: translateY(-2px);
      }

      .related-article:hover h6 {
        color: #1e40af;
      }

      /* Categories */
      .category-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
      }

      .category-tag {
        background: #f3f4f6;
        color: #374151;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
      }

      .category-tag:hover {
        background: #1e40af;
        color: white;
      }

      .category-tag.active {
        background: #1e40af;
        color: white;
      }

      /* Footer */
      .footer-section {
        background: #1e40af;
        color: white;
        padding: 4rem 0 2rem;
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
        .article-title {
          font-size: 2rem;
        }

        .article-meta {
          flex-direction: column;
          gap: 1rem;
          align-items: flex-start;
        }

        .main-content {
          padding: 2rem 0;
        }

        .article-container,
        .sidebar-section {
          padding: 1.5rem;
          margin-bottom: 1.5rem;
        }

        .featured-image {
          height: 250px;
        }

        .related-article {
          flex-direction: row !important;
          gap: 0.75rem;
          align-items: flex-start;
        }

        .related-thumbnail {
          width: 80px !important;
          height: 80px !important;
          flex-shrink: 0;
          object-fit: cover;
        }

        .related-content {
          flex: 1;
          min-width: 0;
        }

        .related-content h6 {
          font-size: 0.85rem;
          line-height: 1.3;
          margin-bottom: 0.25rem;
          overflow: hidden;
          text-overflow: ellipsis;
          display: -webkit-box;
          -webkit-line-clamp: 2;
          line-clamp: 2;
          -webkit-box-orient: vertical;
        }

        .related-content small {
          font-size: 0.75rem;
          color: #6b7280;
        }
      }

      /* Extra small mobile devices */
      @media (max-width: 480px) {
        .sidebar-section {
          padding: 1rem;
        }

        .related-article {
          gap: 0.5rem;
          margin-bottom: 1rem;
          padding-bottom: 1rem;
        }

        .related-thumbnail {
          width: 70px !important;
          height: 70px !important;
        }

        .related-content h6 {
          font-size: 0.8rem;
          line-height: 1.25;
        }

        .related-content small {
          font-size: 0.7rem;
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
        <a href="berita.html" class="back-button">
          <i class="bi bi-arrow-left me-2"></i>
          Kembali
        </a>

        <h1 class="article-title"></h1>

        <div class="article-meta"></div>
      </div>
    </section>

    <!-- Main Content -->
    <div class="main-content">
      <div class="container">
        <div class="row">
          <!-- Article Content -->
          <div class="col-lg-8">
            <div class="article-container">
              <!-- Featured Image -->
              <img src="#" class="featured-image" id="featured-image" />

              <!-- Article Content -->
              <div class="article-content" id="article-content"></div>
            </div>
          </div>

          <!-- Sidebar -->
          <div class="col-lg-4">
            <!-- Related Articles -->
            <div class="sidebar-section">
              <h4 class="sidebar-title">Artikel Terkait</h4>
              <div id="related-content"></div>
            </div>

            <!-- Categories -->
            <div class="sidebar-section">
              <h4 class="sidebar-title">Kategori</h4>

              <div class="category-tags" id="categoryTags"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="footer-section">
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
                6
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
    <script src="assets/js/custom.js"></script>

    <!-- Custom JavaScript -->
    <script>
      function muatDataContent(id, article, category) {
        $.ajax({
          url: `${API_URL}/contents/${id}`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            console.log(response);

            setActiveCategory(response.data.category);

            if (response.data.related_article !== null) {
              response.data.related_article.forEach((element) => {
                document.getElementById("related-content").innerHTML += `
                <div class="related-article">
                  <a href="/artikel-detail.html?id=${
                    element.id
                  }" class="d-flex gap-3">
                    <img
                      src="${API_URL}/assets/image/${element.image}"
                      class="related-thumbnail"
                    />
                    <div class="related-content">
                      <h6>${toTitleCase(element.title)}</h6>
                      <small>${formatDate(element.created_at)}</small>
                    </div>
                  </a>
                </div>
            `;
              });
            }

            document.getElementById(
              "featured-image"
            ).src = `${API_URL}/assets/image/${response.data.image}`;

            document.querySelector(".article-meta").innerHTML = `
              <div class="meta-item">
                <i class="bi bi-calendar3"></i>
                <span>${formatDate(response.data.created_at)}</span>
              </div>
              <div class="meta-item">
                <i class="bi bi-person"></i>
                <span>${toTitleCase(response.data.created_by)}</span>
              </div>
            `;

            document.querySelector(".article-title").innerHTML = toTitleCase(
              response.data.title
            );

            article.innerHTML = `${response.data.content}`;
          },
          error: function (xhr) {
            if (xhr.status === 400 || xhr.status === 404) {
              alert("artikel tidak ada");
              window.location = "/index.html";
            }

            console.error("error muat data : ", xhr);
          },
        });
      }

      function muatDataAnnouncement(id, article) {
        $.ajax({
          url: `${API_URL}/announcements/${id}`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            setActiveCategory("pengumuman");

            response.data.related_article.forEach((element) => {
              document.getElementById("related-content").innerHTML += `
                <div class="related-article">
                  <a href="/artikel-detail.html?type=announcement&id=${
                    element.id
                  }" class="d-flex gap-3">
                    <img
                      src="${API_URL}/assets/image/${element.image}"
                      class="related-thumbnail"
                    />
                    <div class="related-content">
                      <h6>${toTitleCase(element.title)}</h6>
                      <small>${formatDate(element.created_at)}</small>
                    </div>
                  </a>
                </div>
            `;
            });

            document.getElementById(
              "featured-image"
            ).src = `${API_URL}/assets/image/${response.data.image}`;

            document.querySelector(".article-meta").innerHTML = `
              <div class="meta-item">
                <i class="bi bi-calendar3"></i>
                <span>${formatDate(response.data.created_at)}</span>
              </div>
              <div class="meta-item">
                <i class="bi bi-person"></i>
                <span>${toTitleCase(response.data.published_by)}</span>
              </div>
            `;

            document.querySelector(".article-title").innerHTML = toTitleCase(
              response.data.title
            );

            article.innerHTML = `${response.data.content}`;
          },
          error: function (xhr) {
            if (xhr.status === 400 || xhr.status === 404) {
              alert("artikel tidak ada");
              window.location = "/index.html";
            }

            console.error("error muat data : ", xhr);
          },
        });
      }

      function muatDataCategory() {
        $.ajax({
          url: `${API_URL}/categories`,
          type: "GET",
          xhrFields: {
            withCredentials: true,
          },
          success: function (response) {
            // new-content
            let categoryTags = $("#categoryTags");

            response.data.forEach((element) => {
              content = `<a href="#" class="category-tag">${toTitleCase(
                element.name
              )}</a>`;

              categoryTags.append(content);
            });
          },
          error: function (xhr) {
            console.error("error muat data : ", xhr);
          },
        });
      }

      function setActiveCategory(category) {
        document.querySelectorAll(".category-tag").forEach((tag) => {
          tag.classList.remove("active");
          if (tag.textContent.trim().toLowerCase() === category.toLowerCase()) {
            tag.classList.add("active");
          }
        });
      }

      // Smooth scroll for anchor links
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

      window.addEventListener("DOMContentLoaded", function () {
        const params = new URLSearchParams(window.location.search);
        const id = params.get("id");
        const type = params.get("type");

        const article = document.querySelector(".article-content");
        if (type === "announcement") {
          muatDataAnnouncement(id, article);
          return;
        }

        muatDataCategory();

        muatDataContent(id, article);
      });

      // Add reading progress indicator
      window.addEventListener("scroll", function () {
        const article = document.querySelector(".article-content");
        if (!article) return;

        const articleTop = article.offsetTop;
        const articleHeight = article.offsetHeight;
        const windowHeight = window.innerHeight;
        const scrollTop = window.pageYOffset;

        const progress = Math.min(
          Math.max((scrollTop - articleTop + windowHeight) / articleHeight, 0),
          1
        );
      });

      // Add hover effects for related articles
      document.querySelectorAll(".related-article").forEach((article) => {
        article.addEventListener("mouseenter", function () {
          this.style.transform = "translateY(-2px)";
        });

        article.addEventListener("mouseleave", function () {
          this.style.transform = "translateY(0)";
        });
      });
    </script>
  </body>
</html>
