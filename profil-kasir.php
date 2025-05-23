<?php
include("konfig.php");
session_start();
$nama_kasir=$_SESSION['nama_kasir'];
 $sql = "SELECT * FROM tb_adminkasir WHERE nama_kasir = '$nama_kasir'";
    $query = mysqli_query($db, $sql);
    if ($query && mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Pembeli</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #fdfdfd;
    }

    .header {
      display: flex;
      align-items: center;
      padding: 16px;
      font-weight: bold;
      font-size: 18px;
      position: relative;
    }

    .header i {
      margin-right: 12px;
      cursor: pointer;
    }

    .profile-cover {
      background-image: url('https://via.placeholder.com/300x120/ffffff/000000?text=+'); /* ganti sesuai background kamu */
      background-size: cover;
      background-position: center;
      border-radius: 20px;
      margin: 16px;
      height: 100px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .profile-pic {
      width: 100px;
      height: 100px;
      background-color: #cbe0f7;
      border-radius: 90%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #333;
      position: relative;
      z-index: 1;
    }

    .info {
      padding: 24px 16px;
      font-size: 16px;
    }

    .info p {
      margin: 8px 0;
    }

    .info span {
      font-weight: bold;
      margin-right: 8px;
    }

    .add-address {
      color: #2a8df4;
      cursor: pointer;
      text-decoration: none;
    }

    .btn-masuk {
        display: block;
        width: 100%;
        text-align: center;
        background-color: white;
        color: #2a8df4;
        font-weight: bold;
        padding: 10px;
        border-radius: 16px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 16px;
      }

    .bottom-nav {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background: #cbe0f7;
      display: flex;
      justify-content: space-around;
      padding: 10px 0;
      box-shadow: 0 -1px 6px rgba(0, 0, 0, 0.1);
    }

    .bottom-nav i {
      font-size: 22px;
      color: #2a8df4;
    }
  </style>
</head>
<body>

  <div class="header">
    <i class="fas fa-arrow-left"></i> Profil TOKO
  </div>

  <div class="profile-cover">
    <div class="profile-pic">LOGO</div>
  </div>

  <div class="INFORMASI TOKO">
    <p><span>NAMA TOKO:</span> </p>
    <p><span>NAMA ADMIN KASIR:</span> </p>
    <p><span>No. HP :</span> </p>
    <p><span>ALAMAT TOKO  make gps:</span> </p>
  </div>

  <a href="tambah-produk.php" class="btn-masuk"> TAMBAH PRODUK</a>
  <a href="stokproduk.php" class="btn-masuk"> KELOLA PRODUK</a>
  <a href=".html" class="btn-masuk"> KELOLA PESANAN</a>
  <a href=".html" class="btn-masuk"> KELOLA PESANAN</a>

</body>
</html>
