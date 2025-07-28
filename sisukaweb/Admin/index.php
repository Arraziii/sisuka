<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin Panel - Kelurahan Sukaasih</title>

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
        height: 100vh;
        overflow: hidden;
      }

      .login-container {
        display: flex;
        height: 100vh;
      }

      .login-left {
        flex: 1;
        /* background: url("../assets/img/logo.png") center/cover; */
        background: linear-gradient(135deg, #7066e0 300%, #1e3a8a 50%);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
      }

      .login-left::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
      }

      .welcome-text {
        position: relative;
        z-index: 2;
        text-align: center;
        padding: 2rem;
      }

      .welcome-text h1 {
        font-size: 4rem;
        font-weight: 700;
        margin-bottom: 1rem;
        /* text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); */
      }

      .welcome-text h2 {
        font-size: 2rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        /* text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); */
      }

      .welcome-text h3 {
        font-size: 1.8rem;
        font-weight: 400;
        /* text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); */
      }

      .login-right {
        width: 500px;
        /* background: linear-gradient(135deg, #4f8ff7 0%, #1e3a8a 100%); */
        background: #f1f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        position: relative;
      }

      .login-card {
        background: white;
        border-radius: 20px;
        padding: 3rem 2.5rem;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        position: relative;
      }

      .login-header {
        text-align: center;
        margin-bottom: 2rem;
      }

      .login-header h4 {
        color: #1f2937;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
      }

      .login-header p {
        color: #6b7280;
        font-size: 0.875rem;
        line-height: 1.5;
      }

      .form-group {
        margin-bottom: 1.5rem;
      }

      .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: #374151;
        font-weight: 500;
        font-size: 0.875rem;
      }

      .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: #f9fafb;
      }

      .form-control:focus {
        outline: none;
        border-color: #3b82f6;
        background: white;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
      }

      .password-input-container {
        position: relative;
      }

      .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6b7280;
        cursor: pointer;
        padding: 0;
        font-size: 1rem;
      }

      .password-toggle:hover {
        color: #374151;
      }

      .checkbox-container {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
      }

      .checkbox-container input[type="checkbox"] {
        width: 16px;
        height: 16px;
        margin-right: 0.75rem;
        accent-color: #3b82f6;
      }

      .checkbox-container label {
        color: #6b7280;
        font-size: 0.875rem;
        cursor: pointer;
      }

      .login-btn {
        width: 100%;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        border: none;
        padding: 0.875rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
      }

      .login-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
      }

      .login-btn:active {
        transform: translateY(0);
      }

      .security-note {
        text-align: center;
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.8rem;
        margin-top: 1rem;
        line-height: 1.4;
      }

      /* Responsive Design */
      @media (max-width: 768px) {
        .login-container {
          flex-direction: column;
        }

        .login-left {
          height: 40vh;
          min-height: 300px;
        }

        .welcome-text h1 {
          font-size: 2.5rem;
        }

        .welcome-text h2 {
          font-size: 1.5rem;
        }

        .welcome-text h3 {
          font-size: 1.3rem;
        }

        .login-right {
          width: 100%;
          height: 60vh;
          padding: 1rem;
        }

        .login-card {
          padding: 2rem 1.5rem;
        }
      }

      /* Loading Animation */
      .loading {
        position: relative;
        pointer-events: none;
      }

      .loading::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
      }

      @keyframes spin {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      }
    </style>
  </head>
  <body>
    <div class="login-container">
      <!-- Left Side - Welcome Section -->
      <div class="login-left">
        <div class="welcome-text">
          <h1>Selamat Datang</h1>
          <h2>Admin Panel</h2>
          <h3>Kelurahan Sukaasih</h3>
        </div>
      </div>

      <!-- Right Side - Login Form -->
      <div class="login-right">
        <div class="login-card">
          <div class="login-header">
            <h4>Masuk ke Admin Panel</h4>
            <p>
              Masukkan Username dan Password Anda untuk mengakses Admin Panel
            </p>
          </div>

          <form id="loginForm" action="#" method="POST">
            <div class="form-group">
              <label for="username" class="form-label">Username</label>
              <input
                type="text"
                id="username"
                name="username"
                class="form-control"
                placeholder="Masukkan username"
                required
              />
            </div>

            <div class="form-group">
              <label for="password" class="form-label">Password</label>
              <div class="password-input-container">
                <input
                  type="password"
                  id="password"
                  name="password"
                  class="form-control"
                  placeholder="Masukkan password"
                  required
                />
                <button
                  type="button"
                  class="password-toggle"
                  onclick="togglePassword()"
                >
                  <i class="bi bi-eye" id="passwordIcon"></i>
                </button>
              </div>
            </div>

            <!-- <div class="checkbox-container">
              <input type="checkbox" id="remember" name="remember" />
              <label for="remember">Ingat Saya</label>
            </div> -->

            <button type="submit" class="login-btn" id="loginButton">
              Login
            </button>
          </form>

          <div class="security-note">
            Untuk keamanan, jangan bagikan kredensial login Anda kepada siapa
            pun
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/custom.js"></script>

    <script>
      // Toggle Password Visibility
      function togglePassword() {
        const passwordInput = document.getElementById("password");
        const passwordIcon = document.getElementById("passwordIcon");

        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          passwordIcon.className = "bi bi-eye-slash";
        } else {
          passwordInput.type = "password";
          passwordIcon.className = "bi bi-eye";
        }
      }

      // Login Form Handler
      document
        .getElementById("loginForm")
        .addEventListener("submit", function (e) {
          e.preventDefault();

          const loginButton = document.getElementById("loginButton");
          const username = document.getElementById("username").value;
          const password = document.getElementById("password").value;

          // Validation
          if (!username.trim() || !password.trim()) {
            alert("Username dan Password harus diisi!");
            return;
          }

          // Show loading state
          loginButton.textContent = "Sedang Login...";
          loginButton.classList.add("loading");
          loginButton.disabled = true;

          login()
            .then(() => {
              loginButton.textContent = "Login";
              loginButton.classList.remove("loading");
              loginButton.disabled = false;
            })
            .catch((err) => {
              console.error(err);

              loginButton.textContent = "Login";
              loginButton.classList.remove("loading");
              loginButton.disabled = false;
            });
        });

      // Enhanced form interactions
      document.addEventListener("DOMContentLoaded", function () {
        const inputs = document.querySelectorAll(".form-control");

        inputs.forEach((input) => {
          input.addEventListener("focus", function () {
            this.parentElement.style.transform = "scale(1.02)";
          });

          input.addEventListener("blur", function () {
            this.parentElement.style.transform = "scale(1)";
          });
        });
      });

      // Keyboard shortcuts
      document.addEventListener("keydown", function (e) {
        if (e.ctrlKey && e.key === "Enter") {
          document
            .getElementById("loginForm")
            .dispatchEvent(new Event("submit"));
        }
      });
    </script>
  </body>
</html>
