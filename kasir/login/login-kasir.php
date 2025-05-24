<!DOCTYPE html>
<html lang="id">
  <head>
    <title>Masuk - ADMIN KASIR</title>
    <style>
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: "Arial", sans-serif;
      }

      body {
        background: linear-gradient(to bottom, #76b5f8, #d3ecff);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .container {
        width: 320px;
        padding: 30px 20px;
        text-align: center;
      }

      h2 {
        color: white;
        margin-bottom: 2px;
        font-size: 35px;
        font-weight: bold;
        text-align: center;
      }

      .form-input {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0;
        border: none;
        border-radius: 20px;
        background-color: white;
        font-size: 14px;
        color: #333;
        outline: none;
      }

      .form-input::placeholder {
        color: #bbb;
      }

      .btn-masuk {
        display: block;
        width: 100%;
        text-align: center;
        background-color: white;
        color: #2a8df4;
        font-weight: bold;
        padding: 12px;
        border-radius: 25px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-decoration: underline;
        margin-top: 16px;
      }

      .btn:hover {
        background-color: #f0f8ff;
      }

      form {
        margin-bottom: 20px;
      }

      a {
        text-decoration: none;
      }

      .btn-primary {
        background-color: white;
        color: #337ab7;
        font-weight: bold;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
      }
    </style>
  </head>
  <body>
    <div class="container">
    <h2>Login Admin Kasir</h2>
   <form action="prosesloginkasir.php" method="POST" class="container">
  <input required class="form-input" type="text" name="nama_kasir" placeholder="Nama Kasir"><br>
  <input required class="form-input" type="text" name="email" placeholder="Email"><br>
  <input required class="form-input" type="password" name="password" placeholder="Password"><br>
  <button type="submit" class="btn-masuk" style="width: 100%" name="submit">Masuk</button>
</form>

    </div>
      <?php
  if (isset($_GET['status'])) {
      if ($_GET['status'] == 'user_tidak_ditemukan') {
          echo "Username tidak ditemukan.";
      } elseif ($_GET['status'] == 'password_salah') {
          echo "Password salah.";
      } elseif ($_GET['status'] == 'gagal') {
          echo "Login gagal.";
      }
  }
  ?>

  </body>
</html>