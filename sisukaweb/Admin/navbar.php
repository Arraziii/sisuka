<nav
  class="navbar navbar-expand-lg navbar-dark admin-navbar-custom shadow-sm sticky-top"
>
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="dashboard.html">
      <i class="bi bi-speedometer2 me-2"></i>
      Admin Sukaasih
    </a>

    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#adminNavbarContent"
      aria-controls="adminNavbarContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="adminNavbarContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- <li class="nav-item">
          <a class="nav-link" href="dashboard.html">
            <i class="bi bi-house-door-fill me-1"></i> Dashboard
          </a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="artikel.html">
            <i class="bi bi-file-earmark-text-fill me-1"></i> Artikel
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kategori.html">
            <i class="bi bi-tags-fill me-1"></i> Kategori
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="staf.html">
            <i class="bi bi-people-fill me-1"></i> Staf
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="rtRw.html">
            <i class="bi bi-people-fill me-1"></i> Jumlah Rt/Rw
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle d-flex align-items-center"
            href="#"
            id="userDropdown"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <i class="bi bi-person-circle me-2 fs-5"></i>
            <span id="adminUsername"></span>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="userDropdown"
          >
            <li>
              <a class="dropdown-item text-danger" href="#" onclick="logout()">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
