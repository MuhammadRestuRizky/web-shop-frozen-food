<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Login - Froz Supply</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
    }

    body {
      background: #9dbef5;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background: white;
      width: 320px;
      padding: 30px 25px;
      border-radius: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
      font-size: 22px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    .form-group label {
      display: block;
      font-size: 14px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: none;
      border-bottom: 2px solid #ccc;
      outline: none;
    }

    .form-group input:focus {
      border-bottom-color: #2a8df4;
    }

    .form-group .toggle-password {
      position: absolute;
      right: 10px;
      top: 36px;
      cursor: pointer;
      font-size: 16px;
      color: #888;
    }

    .btn-submit {
      width: 100%;
      padding: 12px;
      background-color: #a5c7ff;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 10px;
      font-size: 14px;
      cursor: pointer;
    }

    .btn-submit:hover {
      background-color: #8db8ff;
    }

    .password-wrapper {
      position: relative;
    }

    .error-message {
      margin-top: 10px;
      text-align: center;
      color: red;
      font-size: 13px;
    }
       .login-link {
      text-align: center;
      margin-top: 20px;
      font-size: 13px;
    }

    .login-link a {
      color: #2a8df4;
      text-decoration: none;
      font-weight: bold;
    }

    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <form action="proses_login.php" method="POST">
      <h2>Login</h2>

      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan UserName" required>
      </div>

      <div class="form-group password-wrapper">
        <label>Password</label>
        <input type="password" name="password" id="password" placeholder="Masukkan Password Baru" required>
        <span class="toggle-password" onclick="togglePassword()">👁️</span>
      </div>

      <button type="submit" class="btn-submit" name="submit">MASUK</button>
        <div class="login-link">
        Belum Punya Akun? <a href="../register/registrasi_pembeli.php">Register</a>
      </div>
    </form>

    <?php
    if (isset($_GET['status'])) {
        echo '<div class="error-message">';
        if ($_GET['status'] == 'user_tidak_ditemukan') {
            echo "Username tidak ditemukan.";
        } elseif ($_GET['status'] == 'password_salah') {
            echo "Password salah.";
        } elseif ($_GET['status'] == 'gagal') {
            echo "Login gagal.";
        }
        echo '</div>';
    }
    ?>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById("password");
      const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);
    }
  </script>
</body>
</html>
