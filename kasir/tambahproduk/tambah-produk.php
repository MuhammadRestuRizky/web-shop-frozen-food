<?php
include("../../konfig.php");
session_start();
$nama_kasir = $_SESSION['nama_kasir'];
$sql = "SELECT * FROM tb_adminkasir WHERE nama_kasir = '$nama_kasir'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
    $user = mysqli_fetch_assoc($query);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <!-- ini gw -->
    <title>Menu Maaaaaaaaaaaakanan</title>
    <style>
        html,
        body,
        * {

            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif; 
        }

        .container {
            padding: 16px;
        }

        .head-container {
            padding: 20px 40px 10px 20px;
            background-color: #7CAEDF;
        }

        .right-container {
            /* height: inherit; */
        }

        .container-product {
            background-color: white;
            padding: 20px 40px;
            height: 100%;
        }


        .h-vhfull {
            height: 100vh;
        }

        .link-product>a {
            font-weight: 400;
            color: #2a8df4;
            text-decoration: none;
        }

        .fw-medium {
            font-weight: 600;
        }

        .image-upload {
            width: 100%;
            height: 300px;
            border: 1px solid black;
            border-radius: 16px;
            margin-bottom: 10px;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            cursor: pointer;
            position: relative;
        }

        .image-upload.has-image svg {
            display: none;
        }

        .image-upload svg {
            width: 48px;
            height: 48px;
            fill: #666;
            cursor: pointer;
            z-index: 10;
        }

        .image-upload svg {
            width: 40px;
            height: 40px;
            fill: #78be91;
        }

        #fileInput {
            display: none;
        }

        .input-tambah {
            background: #ffffff;
            border: 1px solid black !important;

            padding: 10px;
            border-radius: 16px;
            border: none;
        }

        .btn-tambah {
            border-radius: 16px;
            padding: 14px 40px;
            border: none;
        }

        .btn-batal {
            border: 2px solid #C71515;
            margin-right: 20px;
            color: #C71515 ;
            padding: 10px 40px;
        }
        .btn-batal h2{
            
            color: #C71515 ;
        }

        .btn-simpan {
            background-color: #4FC965;
            margin-right: 20px;
        }
        .btn-simpan >a {
            color: white;
        }
        
        .pesanan-card-parent {}

        .pesanan-subcard>h3 {
            font-weight: 400;
        }

        .pesanan-subcard {
            margin: 0px 1px;
            padding: 10px 4px; 
            background-color: #E7E5E5;
        }

        .pesanan-card {
            background-color: #E7E5E5;
            border-radius: 16px;
            padding: 10px;
        }

        .head-pesanan-card {
            text-align: center;
        }

        .items-data-pesanan {
            padding: 10px 0px;
        }

        .notification-icon {
            position: relative;
            font-size: 30px;
            cursor: pointer;
        }

        .notification-icon .badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }

        /* Dialog notifikasi */
        .notification-dialog {
            display: none;
            position: absolute;
            top: 35px;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            width: 550px;
            z-index: 100;
            border-radius: 20px;
        }

        .notification-dialog.active {
            display: block;
        }

        .notification-dialog p {
            margin: 5px 0;
            font-size: 14px;
        }

        .notification-container {
            position: relative;
            display: inline-block;
        }

        .head-notifikasi {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            padding: 20px 10px;
            background-color: #7CAEDF;
        }

        .notifikasi-content {
            padding: 10px;
        }
          .base-line{
                border:8px solid white;
            }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../global.css">
</head>

<body>
    <div class="grid grid-cols-12 h-vhfull">
        <div class="col-span-12">
            <div class="head-container">
                <div class="grid grid-cols-12">

                    <div class="col-span-2 profil-parent align-items-center">
                        <a href="../profil-kasir/profil-kasir.php" class="link-sidebar align-items-center flex fw-semibold">
                            <?php if ($user['foto']): ?>
                                <span class="profile-user-icon">
                                    <img src="../../img/profiluploadtoko/<?= htmlspecialchars($user['foto'] ?? 'default.jpeg') ?>" alt="" srcset="">
                                </span>
                            <?php else: ?>
                                <i class=" fas fa-user" style="font-size:20px;"></i>
                            <?php endif; ?>
                            &nbsp;
                            <span class="username-ellipsis"><?= htmlspecialchars($user['nama_kasir']) ?? '-' ?></span>
                        </a>
                    </div>
                    <div class="col-span-10 flex justify-between items-center">
                        <div>

                            <h1>Tambah Produk</h1>
                            <?php if ($current_page === 'kelola-produk.php'): ?>
                                <div class="input-with-icon" style="display: flex; justify-content: space-between; align-items: center;">
                                    <form method="GET" action="../kelolaproduk/kelola-produk.php?cari" class="flex items-center gap-2">
                                        <i class="fas fa-search"></i>
                                        <input type="text" name="cari" class="radius-input input-search" placeholder="Cari Produk.">
                                    </form>
                                    &nbsp;
                                    <?php if ($_GET['cari'] ?? ''): ?>
                                        <form method="GET" action="../kelolaproduk/kelola-produk.php" class="flex items-center gap-2">
                                            <button type="submit" style="background:none; border:none; cursor:pointer; padding: 6px; display: inline-block;">
                                                <i class="fas fa-times" style="font-size:20px;"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>

                            <?php elseif ($current_page === 'kelola-pesanan.php'): ?>
                                <div class="input-with-icon" style="display: flex; justify-content: space-between; align-items: center;">
                                    <form method="GET" action="../kelolapesanan/kelola-pesanan.php?cari" class="flex items-center gap-2">
                                        <i class="fas fa-search"></i>
                                        <input type="text" name="cari" class="radius-input input-search" placeholder="Cari NO Pesanan.">
                                    </form>
                                    <?php if ($_GET['cari'] ?? ''): ?>
                                        <form method="GET" action="../kelolapesanan/kelola-pesanan.php" class="flex items-center gap-2">
                                            <button type="submit" style="background:none; border:none; cursor:pointer; padding: 6px; display: inline-block;">
                                                <i class="fas fa-times" style="font-size:20px;"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="input-with-icon" style="visibility: hidden;">
                                    <i class="fas fa-search"></i>
                                    <input type="text" class="radius-input input-search" type="hidden" disabled placeholder="">
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php

                        $sql = "SELECT * FROM tb_notifikasi 
                                WHERE jenis_pengguna = 'adminkasir'
                                ORDER BY tgl_notifikasi DESC 
                                LIMIT 10";
                        $result = mysqli_query($db, $sql);

                        // Hitung jumlah notifikasi
                        $jumlahNotif = mysqli_num_rows($result);
                        ?>
                        <div class="notification-container">
                            <i class="fas fa-bell notification-icon" id="notifIcon">
                                <span class="badge"><?= $jumlahNotif ?></span>
                            </i>

                            <div class="notification-dialog" id="notifDialog">
                                <div class="head-notifikasi">
                                    <h2>Notifikasi</h2>
                                </div>
                                <div class="notifikasi-content">

                                    <?php if ($jumlahNotif > 0): ?>
                                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                            <small>
                                                <p class="flex">
                                                    📩 <?= htmlspecialchars($row['deskripsi']) ?>
                                                    🕒 <?= date("d-m-Y H:i", strtotime($row['tgl_notifikasi'])) ?>
                                                </p>
                                            </small>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <p>Tidak ada notifikasi.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-span-12">
                <div class="base-line"></div>
            </div>
        <?php include '../../component/sidebar-admin.php'; ?>
        <div class="col-span-10">
            <div class="right-container"> 
                <div class="container-product">
                    <div class="card-product">
                        <form action="prosestambahproduk.php" method="POST" enctype="multipart/form-data">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-2">
                                    <h3 class="fw-medium">Foto Produk: </h3>
                                </div>
                                <div class="col-span-10">
                                    <div class="image-upload" id="imageUpload" onclick="document.getElementById('fileInput').click()">
                                        <!-- Ikon tambah -->
                                        <i class="fa fa-plus" style="font-size:180px;color:#79AEE0;"></i>
                                    </div>
                                    <!-- Input file disembunyikan -->
                                    <input type="file" name="image_produk" id="fileInput" accept="image/*" onchange="previewImage(event)">
                                    <!-- </div> -->
                                    <img id="imgpreview" src="#" alt="Preview" style="display: none;" />
                                </div>
                                <div class="col-span-2">
                                    <h3 class="fw-medium">Nama Produk: </h3>
                                </div>
                                <div class="col-span-10">
                                    <h3 class="fw-medium">
                                        <input type="text" class="input-tambah" style="width:40%;" name="nama_produk" placeholder="Masukkan nama produk">
                                    </h3>
                                </div>
                                <div class="col-span-2">
                                    <h3 class="fw-medium">Harga: </h3>
                                </div>
                                <div class="col-span-10">
                                    <h3 class="fw-medium">
                                        <input type="number" style="width:36%;" class="input-tambah" name="harga_produk" placeholder="Masukkan harga produk">
                                    </h3>
                                </div>
                                <div class="col-span-2">
                                    <h3 class="fw-medium">Stok: </h3>
                                </div>
                                <div class="col-span-10">
                                    <h3 class="fw-medium">
                                        <input type="number" style="width:10%;" class="input-tambah" name="stok" placeholder="Masukkan stok produk">
                                    </h3>
                                </div>
                                <div class="col-span-2">
                                    <h3 class="fw-medium">Deskripsi: </h3>
                                </div>
                                <div class="col-span-10">
                                    <h3 class="fw-medium">
                                        <input type="text" style="width:100%;" class="input-tambah" name="deskripsi_produk" placeholder="Masukkan deskripsi produk">
                                    </h3>
                                </div>
                                <br>
                                <div class="col-span-12 flex justify-end">
                                    <button class="btn-tambah btn-batal">
                                        <a href="../pembeli/tambahproduk/tambah-produk.php" class="">
                                            <h2>Batal</h2>
                                        </a>
                                    </button>
                                    <button class="btn-tambah btn-simpan">
                                        <a href="../pembeli/tambahproduk/tambah-produk.php" class="flex items-center">
                                            <h2>Simpan</h2>
                                            &nbsp;
                                            <i class="fa fa-arrow-up" style="font-size: 20px;"></i>
                                        </a>
                                    </button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageUploadDiv = document.getElementById('imageUpload');
                    imageUploadDiv.style.backgroundImage = `url('${e.target.result}')`;
                    imageUploadDiv.classList.add('has-image');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>