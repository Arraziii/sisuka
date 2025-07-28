// JavaScript for Kelurahan Sukaasih Website
function initializeMainScript() {
  const tahun = new Date().getFullYear();
  copyright = document.getElementById("copyright");
  copyright.innerHTML = `&copy; ${tahun} Kelurahan Sukaasih. Hak Cipta Dilindungi.`;

  // Navbar scroll effect
  const navbar = document.querySelector(".navbar");

  window.addEventListener("scroll", function () {
    if (window.scrollY > 50) {
      navbar.classList.add("navbar-scrolled");
    } else {
      navbar.classList.remove("navbar-scrolled");
    }
  });

  // Smooth scrolling for navigation links
  const navLinks = document.querySelectorAll('.nav-link[href^="#"]');

  navLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();

      const targetId = this.getAttribute("href");
      const targetSection = document.querySelector(targetId);

      if (targetSection) {
        const offsetTop = targetSection.offsetTop - 80;

        window.scrollTo({
          top: offsetTop,
          behavior: "smooth",
        });
      }
    });
  });

  // Active navigation highlighting
  const sections = document.querySelectorAll("section[id]");

  window.addEventListener("scroll", function () {
    let current = "";

    sections.forEach((section) => {
      const sectionTop = section.offsetTop - 100;
      const sectionHeight = section.clientHeight;

      if (
        window.scrollY >= sectionTop &&
        window.scrollY < sectionTop + sectionHeight
      ) {
        current = section.getAttribute("id");
      }
    });

    navLinks.forEach((link) => {
      link.classList.remove("active");
      if (link.getAttribute("href") === "#" + current) {
        link.classList.add("active");
      }
    });
  });

  // Image error handling
  const images = document.querySelectorAll("img");

  images.forEach((img) => {
    img.addEventListener("error", function () {
      console.log("Failed to load image:", this.src);

      // Add error styling
      this.classList.add("image-error");
      this.style.display = "none";

      // Create fallback element
      const fallback = document.createElement("div");
      fallback.className =
        "image-fallback d-flex align-items-center justify-content-center";
      fallback.innerHTML = '<i class="bi bi-image fs-1 text-muted"></i>';
      fallback.style.cssText = `
                width: ${this.width || "100"}px;
                height: ${this.height || "100"}px;
                background: #f8f9fa;
                border: 1px solid #dee2e6;
                border-radius: 8px;
            `;

      // Insert fallback after the failed image
      this.parentNode.insertBefore(fallback, this.nextSibling);
    });

    img.addEventListener("load", function () {
      this.classList.add("image-loaded");
    });
  });

  // News filter functionality
  const filterButtons = document.querySelectorAll(".filter-btn");

  filterButtons.forEach((button) => {
    button.addEventListener("click", function () {
      // Remove active class from all buttons
      filterButtons.forEach((btn) => {
        btn.classList.remove("active");
        btn.classList.remove("btn-primary");
        btn.classList.add("btn-outline-secondary");
      });

      // Add active class to clicked button
      this.classList.add("active");
      this.classList.remove("btn-outline-secondary");
      this.classList.add("btn-primary");

      // Get filter value
      const filterValue = this.getAttribute("data-filter");

      // Filter news cards
      filterNewsCards(filterValue);
    });
  });

  // Statistics counter animation
  const stats = document.querySelectorAll(".stat-number");

  const animateStats = () => {
    stats.forEach((stat) => {
      const target = parseInt(stat.textContent);
      const increment = target / 100;
      let current = 0;

      const updateStat = () => {
        if (current < target) {
          current += increment;
          stat.textContent = Math.ceil(current);
          setTimeout(updateStat, 20);
        } else {
          stat.textContent = target;
        }
      };

      updateStat();
    });
  };

  // Trigger stats animation when section is visible
  const statsSection = document.querySelector(".py-5.bg-light");
  if (statsSection) {
    const statsObserver = new IntersectionObserver(
      function (entries) {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            animateStats();
            statsObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.5 }
    );

    statsObserver.observe(statsSection);
  }

  // Console welcome message
  console.log(
    "%c🏛️ Website Kelurahan Sukaasih",
    "color: #2563eb; font-size: 16px; font-weight: bold;"
  );
  console.log(
    "%cDeveloped with ❤️ using Bootstrap 5",
    "color: #6b7280; font-size: 12px;"
  );

  // Function to filter news cards
  function filterNewsCards(filter) {
    const newsCards = document.querySelectorAll(".news-card");

    newsCards.forEach((card) => {
      if (filter === "semua") {
        card.parentElement.style.display = "block";
      } else {
        const cardCategory = card.getAttribute("data-category");
        if (cardCategory === filter) {
          card.parentElement.style.display = "block";
        } else {
          card.parentElement.style.display = "none";
        }
      }
    });
  }

  // const searchInput = document.getElementById("searchInput");
  // const filterButtonsContainer = document.getElementById("filterButtons");
  // const newsContainer = document.getElementById("new-content");
  // const noResultsMessage = document.getElementById("no-results");
  // let activeCategory = "semua";
  // let searchTerm = "";

  // // Fungsi utama untuk melakukan filter dan pencarian
  // function filterAndSearchArticles() {
  //   const articles = newsContainer.querySelectorAll(".col-lg-3"); // Ambil parent kolomnya
  //   let itemsVisible = 0;

  //   articles.forEach((article) => {
  //     const card = article.querySelector(".news-card");

  //     if (card) {
  //       const category = card.getAttribute("data-category").toLowerCase();

  //       const titleElement = card.querySelector("h5");
  //       const title = titleElement
  //         ? titleElement.textContent.toLowerCase()
  //         : "";

  //       const categoryMatch =
  //         activeCategory === "semua" || category === activeCategory;
  //       const searchMatch = title.includes(searchTerm);

  //       if (categoryMatch && searchMatch) {
  //         article.style.display = "block";
  //         itemsVisible++;
  //       } else {
  //         article.style.display = "none";
  //       }
  //     }
  //   });

  //   if (itemsVisible === 0 && articles.length > 0) {
  //     noResultsMessage.style.display = "block";
  //   } else {
  //     noResultsMessage.style.display = "none";
  //   }
  // }

  // // Event listener untuk filter kategori
  // if (filterButtonsContainer) {
  //   filterButtonsContainer.addEventListener("click", function (e) {
  //     e.preventDefault();
  //     const target = e.target;

  //     // Pastikan yang diklik adalah link filter
  //     if (target.tagName === "A" && target.hasAttribute("data-filter")) {
  //       // Update tampilan tombol active
  //       filterButtonsContainer
  //         .querySelector(".active")
  //         .classList.remove("active");
  //       target.classList.add("active");

  //       // Update state dan jalankan filter
  //       activeCategory = target.getAttribute("data-filter");
  //       filterAndSearchArticles();
  //     }
  //   });
  // }

  // // Event listener untuk kolom pencarian
  // if (searchInput) {
  //   searchInput.addEventListener("input", function (e) {
  //     searchTerm = e.target.value.toLowerCase().trim();
  //     filterAndSearchArticles();
  //   });
  // }

  // 1. MANAJEMEN STATE APLIKASI
  // ==============================
  // Variabel untuk menyimpan kondisi saat ini
  let currentPage = 1;
  let activeCategory = "semua";
  let searchTerm = "";

  // 2. ELEMEN-ELEMEN DOM
  // ==============================
  const newsContainer = $("#new-content");
  const noResultsMessage = $("#no-results");
  const paginationContainer = $("#pagination-container");
  const categoryDropdownButton = $("#categoryDropdownButton");
  const categoryDropdownMenu = $("#categoryDropdownMenu");
  const searchInput = $("#searchInput");

  // 3. FUNGSI UTAMA PENGAMBILAN DATA
  // ===================================
  // Fungsi ini sekarang menjadi pusat dari segalanya.
  function fetchAndDisplayArticles(page) {
    currentPage = page;

    // Membangun URL API dengan parameter dinamis
    // contents?order=asc&category=kuliner
    let apiUrl = `${API_URL}/contents?page=${currentPage}`;
    if (activeCategory !== "semua") {
      apiUrl += `&category=${activeCategory}`;
    }
    if (searchTerm.trim() !== "") {
      apiUrl += `&search=${searchTerm.trim()}`;
    }

    // Tampilkan loading spinner (opsional)
    newsContainer.html(
      '<div class="text-center p-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>'
    );
    paginationContainer.empty();

    $.ajax({
      url: apiUrl,
      type: "GET",
      xhrFields: { withCredentials: true },
      success: function (response) {
        newsContainer.empty();

        const articles = response.data;
        const paginationInfo = {
          currentPage: response.current_page,
          totalRecord: response.total_records,
          totalPages: response.total_pages,
        };

        if (articles && articles.length > 0) {
          noResultsMessage.hide();
          articles.forEach((data) => {
            let trimmedContent = trimWords(data.content, 15);
            const cleanData = trimmedContent.replace(/<\/?p>/g, "");

            const articleHtml = `
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
              </div>`;
            newsContainer.append(articleHtml);
          });
          // Panggil fungsi untuk membuat tombol-tombol halaman
          renderPagination(paginationInfo);
        } else {
          noResultsMessage.show();
        }
      },
      error: function (xhr) {
        newsContainer.html(
          '<div class="alert alert-danger">Gagal memuat artikel. Silakan coba lagi nanti.</div>'
        );
      },
    });
  }

  // 4. FUNGSI UNTUK MEMBUAT TOMBOL-TOMBOL HALAMAN (PAGINATION)
  // ==============================================================
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

  // 5. EVENT LISTENERS
  // ===================================
  // Listener untuk klik pada tombol pagination
  paginationContainer.on("click", "a.page-link", function (e) {
    e.preventDefault();
    const page = $(this).data("page");
    if (page) {
      fetchAndDisplayArticles(page);
    }
  });

  // Listener untuk dropdown kategori
  categoryDropdownMenu.on("click", "a.dropdown-item", function (e) {
    e.preventDefault();
    categoryDropdownButton.text($(this).text());

    const currentActive = categoryDropdownMenu.find(".active");
    currentActive.removeClass("active");

    $(this).addClass("active");

    activeCategory = $(this).data("filter");
    fetchAndDisplayArticles(1);
  });

  // Listener untuk input pencarian (dengan debounce)
  let searchTimeout;
  searchInput.on("input", function () {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
      searchTerm = $(this).val();
      fetchAndDisplayArticles(1);
    }, 500);
  });

  // 6. PEMUATAN AWAL
  // ==============================
  // Panggil fungsi untuk memuat data pertama kali saat halaman dibuka
  fetchAndDisplayArticles(1);
}
