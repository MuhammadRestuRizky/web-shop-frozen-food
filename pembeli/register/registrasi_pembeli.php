<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Buat Akun Froz Supply</title>
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

    .form-group .password-toggle {
      position: relative;
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
    <?php if (isset($_GET['pesan'])): ?>
      <div class="message">
        <?php
          $pesan = $_GET['pesan'];
          if ($pesan == "gagal") echo "Registrasi gagal. Silakan coba lagi.";
          elseif ($pesan == "berhasil") echo "Registrasi berhasil. Silakan login.";
        ?>
      </div>
    <?php endif; ?>
    <form action="proses_registrasi.php" method="POST">
      <h2>Registrasi</h2>

      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan Username" required>
      </div>

      <div class="form-group">
        <label>No Telpon</label>
        <input type="number" name="no_telpon" placeholder="Masukkan No Telpon" required>
      </div>

      <div class="form-group">
        <label>Buat Password</label>
        <input type="password" name="password" placeholder="Buat Password Baru" required>
      </div>

      <button type="submit" class="btn-submit" name="submit">REGISTRASI</button>

      <div class="login-link">
        Sudah Punya Akun? <a href="../login/login_pembeli.php">Log-in</a>
      </div>
    </form>
  </div>

</body>
</html>
