<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Frozen Food</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      height: 100vh;
      background: linear-gradient(to bottom, #a4c5e2, #6ca2d1);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      text-align: center;
      width: 90%;
      max-width: 360px;
    }

    .logo-container {
      margin-bottom: 40px;
    }

    .logo {
      width: 100%;
      border: 2px solid #ccc;
      border-radius: 5px;
    }

    .button-container {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .btn {
      padding: 15px 0;
      border: none;
      border-radius: 15px;
      font-size: 18px;
      cursor: pointer;
      background-color: white;
      color:rgb(3, 131, 243);
      font-weight: bold;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn.admin {
      font-size: 14px;
      color:rgb(1, 119, 254);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo-container">
      <img src="./img/logo.png" alt="Frozen Food Logo" class="logo" />
    </div>
    <div class="button-container">
      <a href="registrasi_pembeli.php" class="btn masuk">MASUK</a>
      <a href="login-kasir.php" class="btn admin">khusus ADMIN</a>
    </div>
  </div>
</body>
</html>
