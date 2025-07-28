<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hubungi Kami - Kelurahan Sukaasih</title>

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

      .contact-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        height: 100%;
        transition: all 0.3s ease;
      }

      .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      }

      .contact-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 1.5rem;
      }

      .contact-card h5 {
        color: #1f2937;
        font-weight: 600;
        margin-bottom: 1rem;
      }

      .contact-card p {
        color: #6b7280;
        margin-bottom: 0;
        line-height: 1.6;
      }

      .form-section {
        background: #f8fafc;
        padding: 4rem 0;
      }

      .form-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
        margin: 0 auto;
      }

      .form-control {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.875rem 1rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: #f9fafb;
      }

      .form-control:focus {
        border-color: #3b82f6;
        background: white;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
      }

      .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
      }

      .btn-send {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border: none;
        padding: 0.875rem 2rem;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        min-width: 200px;
      }

      .btn-send:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        color: white;
      }

      /* Mobile Responsive */
      @media (max-width: 768px) {
        .form-card {
          padding: 2rem 1.5rem;
          border-radius: 15px;
          margin: 0 1rem;
        }

        .form-control {
          padding: 1rem;
          font-size: 1rem;
        }

        .btn-send {
          width: 100%;
          padding: 1rem 2rem;
          font-size: 1rem;
        }

        .contact-card {
          margin-bottom: 1.5rem;
        }

        .contact-card h5 {
          font-size: 1.1rem;
        }

        .contact-card p {
          font-size: 0.9rem;
        }
      }

      @media (max-width: 480px) {
        .hero-section {
          min-height: 300px;
          padding: 2rem 0;
        }

        .hero-section h1 {
          font-size: 2rem;
        }

        .hero-section .lead {
          font-size: 1rem;
        }

        .form-card {
          padding: 1.5rem 1rem;
          margin: 0 0.5rem;
        }

        .contact-card {
          padding: 1.5rem;
        }

        .contact-icon {
          width: 50px;
          height: 50px;
          font-size: 1.25rem;
        }
      }

      .location-section {
        padding: 4rem 0;
      }

      /* Character counter */
      .char-counter {
        font-size: 0.75rem;
        color: #6b7280;
        text-align: right;
        margin-top: 0.25rem;
      }

      .char-counter.warning {
        color: #f59e0b;
      }

      .char-counter.danger {
        color: #ef4444;
      }
    </style>
  </head>
  <body>
    <!-- Navbar -->
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
              <a class="nav-link" href="profil.html">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active fw-semibold" href="hubungi-kami.html"
                >Hubungi Kami</a
              >
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
            <h1 class="display-4 fw-bold mb-3">Hubungi Kami</h1>
            <p class="lead">
              Kami siap membantu Anda. Jangan ragu untuk menghubungi kami
              melalui berbagai cara di bawah ini.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Cards Section -->
    <section class="py-5">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-3 col-md-6">
            <div class="contact-card">
              <div class="contact-icon">
                <i class="bi bi-geo-alt"></i>
              </div>
              <h5>Alamat</h5>
              <p>
                Jl. KH. Tubagus Abdullah Sukaasih, Kec. Purbaratu, Kota
                Tasikmalaya, Jawa Barat 46116
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="contact-card">
              <div class="contact-icon">
                <i class="bi bi-telephone"></i>
              </div>
              <h5>Telepon</h5>
              <p>(0265) 325-6789</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="contact-card">
              <div class="contact-icon">
                <i class="bi bi-envelope"></i>
              </div>
              <h5>Email</h5>
              <p>info@sukaasih.go.id</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="contact-card">
              <div class="contact-icon">
                <i class="bi bi-clock"></i>
              </div>
              <h5>Jam Operasional</h5>
              <p>
                Senin - Jumat<br />08:00 - 16:00 WIB<br />Tutup pada Hari Libur
                Nasional
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Form Section -->
    <!-- <section class="form-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="form-card">
              <div class="text-center mb-5">
                <h3 class="mb-3">Kirim Pesan</h3>
                <p class="text-muted">
                  Isi formulir di bawah ini untuk mengirim pesan kepada kami.
                  Kami akan merespons dalam 1-2 hari kerja.
                </p>
              </div>

              <form id="contactForm">
                <div class="row mb-3">
                  <div class="col-lg-6 col-md-6 mb-3 mb-md-0">
                    <label for="nama" class="form-label">Nama Lengkap *</label>
                    <input
                      type="text"
                      class="form-control"
                      id="nama"
                      name="nama"
                      placeholder="Masukkan nama lengkap Anda"
                      required
                    />
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <label for="email" class="form-label">Email *</label>
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      name="email"
                      placeholder="nama@email.com"
                      required
                    />
                  </div>
                </div>

                <div class="mb-3">
                  <label for="telepon" class="form-label">Nomor Telepon</label>
                  <input
                    type="tel"
                    class="form-control"
                    id="telepon"
                    name="telepon"
                    placeholder="0812-3456-7890"
                  />
                </div>

                <div class="mb-4">
                  <label for="pesan" class="form-label">Pesan</label>
                  <textarea
                    class="form-control"
                    id="pesan"
                    name="pesan"
                    rows="6"
                    placeholder="Tulis pesan Anda di sini..."
                    maxlength="500"
                  ></textarea>
                  <div class="char-counter" id="charCounter">
                    0/500 karakter
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-send">
                    <i class="bi bi-send me-2"></i>
                    Kirim Pesan
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section> -->

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
    <script>
      // Character counter for textarea
      document.getElementById("pesan").addEventListener("input", function () {
        const maxLength = 500;
        const currentLength = this.value.length;
        const counter = document.getElementById("charCounter");

        counter.textContent = `${currentLength}/${maxLength} karakter`;

        if (currentLength > maxLength * 0.9) {
          counter.className = "char-counter danger";
        } else if (currentLength > maxLength * 0.8) {
          counter.className = "char-counter warning";
        } else {
          counter.className = "char-counter";
        }
      });

      // Form submission handler
      document
        .getElementById("contactForm")
        .addEventListener("submit", function (e) {
          e.preventDefault();

          const formData = new FormData(this);
          const data = Object.fromEntries(formData);

          // Validation
          if (!data.nama.trim() || !data.email.trim()) {
            alert("Nama dan Email harus diisi!");
            return;
          }

          // Email validation
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(data.email)) {
            alert("Format email tidak valid!");
            return;
          }

          // Show loading state
          const submitBtn = this.querySelector('button[type="submit"]');
          const originalText = submitBtn.innerHTML;
          submitBtn.innerHTML =
            '<span class="spinner-border spinner-border-sm me-2"></span>Mengirim...';
          submitBtn.disabled = true;

          // Simulate form submission
          setTimeout(() => {
            alert("Pesan berhasil dikirim! Kami akan segera menghubungi Anda.");
            this.reset();
            document.getElementById("charCounter").textContent =
              "0/500 karakter";
            document.getElementById("charCounter").className = "char-counter";

            // Reset button
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
          }, 2000);
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

      // Contact card hover effects
      document.querySelectorAll(".contact-card").forEach((card) => {
        card.addEventListener("mouseenter", function () {
          this.style.transform = "translateY(-5px) scale(1.02)";
        });

        card.addEventListener("mouseleave", function () {
          this.style.transform = "translateY(0) scale(1)";
        });
      });

      // Form input focus effects
      document.querySelectorAll(".form-control").forEach((input) => {
        input.addEventListener("focus", function () {
          this.parentElement.style.transform = "scale(1.02)";
        });

        input.addEventListener("blur", function () {
          this.parentElement.style.transform = "scale(1)";
        });
      });

      // Phone number formatting
      document
        .getElementById("telepon")
        .addEventListener("input", function (e) {
          let value = e.target.value.replace(/\D/g, "");
          let formattedValue = "";

          if (value.length > 0) {
            if (value.length <= 4) {
              formattedValue = value;
            } else if (value.length <= 8) {
              formattedValue = value.slice(0, 4) + "-" + value.slice(4);
            } else {
              formattedValue =
                value.slice(0, 4) +
                "-" +
                value.slice(4, 8) +
                "-" +
                value.slice(8, 12);
            }
          }

          e.target.value = formattedValue;
        });
    </script>
  </body>
</html>
