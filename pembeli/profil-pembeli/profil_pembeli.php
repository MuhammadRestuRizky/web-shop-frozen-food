<?php
include("konfig.php");
session_start();
$username=$_SESSION['username'];
 $sql = "SELECT * FROM tb_pembeli WHERE username = '$username'";
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
      border-radius: 80px;
      margin: 16px;
      height: 140px;
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
        background-color: rgb(135, 179, 218);
        color: black;
        font-weight: bold;
        padding: 12px;
        border-radius: 25px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-decoration: underline;
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
    <i class="fas fa-arrow-left"></i> Profil User
  </div>

  <div class="profile-cover">
    <div class="profile-pic">Tambah Foto</div>
  </div>

  <div class="INFORMASI AKUN">
    <p><span>ID Pembeli :<?=$user['id_pembeli']?></span> </p>
    <p><span>Nama : <?=$user['username']?></span> </p>
    <p><span>No. HP : <?=$user['no_telpon']?></span> </p>
  </div>

  <a href="./dashboard.php" class="btn-masuk"> PESAN PRODUK</a>
  <a href="./keranjang.php" class="btn-masuk"> LIHAT PESANAN</a>

  <div class="bottom-nav">
    <i class="fas fa-home"></i>
    <a href="dashboard.php" class="fas fa-search"></a>
    <i class="fas fa-shopping-cart"></i>
    <a href="profil_pembeli.php" class="fas fa-user"></a>
  </div>

</body>
</html>
