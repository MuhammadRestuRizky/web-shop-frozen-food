    <?php
    include("../../konfig.php");
    session_start();

    $nama_kasir = $_SESSION['nama_kasir'];
    $sql = "SELECT * FROM tb_adminkasir WHERE nama_kasir = '$nama_kasir'";
    $query = mysqli_query($db, $sql);
    if ($query && mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
    }
    if (isset($_GET['hapus'])) {

        $id = $_GET['hapus'] ?? '';


        $sql = "SELECT image_produk FROM tb_produk WHERE id_produk=$id";
        $data = mysqli_fetch_assoc(mysqli_query($db, $sql));
        if ($data['image_produk']) {
            $path = "../../img/produkImg/" . $data['image_produk'];
            if (file_exists($path)) unlink($path);
        }
        $sql = "DELETE FROM tb_produk WHERE id_produk=$id";
        mysqli_query($db, $sql);
        header("Location: kelola-produk.php");
    }
    ?>

    <!-- buat hapus produk -->
    <?php

    ?>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <title>Menu Kelola Poduct</title>
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
                /* background: linear-gradient(to bottom, #96c5f7, white); */
            }

            .container {
                padding: 16px;
            }

            .head-container {
                padding: 20px 40px 10px 20px;
                background-color: #7CAEDF;
            }

            .container-produxt {
                padding-bottom: 100px;

            }

            .product-parent {
                background-color: #C7C7C7;
                position: relative;
                height: 100%;
            }

            .padding-product-table {
                padding: 20px 40px;

            }

            .card-product {
                padding: 8px 8px 0px 8px;
                border-radius: 20px;
                /* height: 250px; */
                background-color: #EFEEEE;
            }

            .button-Custom {
                border: none;
                background-color: #1677FF;
                color: #ffffff;
                padding: 10px 60px;
                font-weight: 600;
                /* font-size: 30px; */
                border-radius: 10px;
            }

            .product-img-produxt {
                height: 60px !important;
                width: 60px;
                display: block;
                object-fit: cover;
            }


            .h-vhfull {
                height: 100vh;
            }

            ul {
                list-style: none;
            }

            a {
                text-decoration: none;
                color: black;
            }

            .align-items-center {
                align-items: center;
            }

            .produxt-button-parent {
                display: flex;
                align-items: center;
                gap: 5px;
                justify-content: center;
                margin-top: 10px;
            }

            .produxt-button-parent button {
                width: 25px;
                height: 25px;
                font-size: 20px;
                font-weight: bold;
                background-color: #7CAEDF;
                color: #f1f1f1;
                border: none;
                border-radius: 100px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .produxt-button-parent span {
                font-size: 20px;
                /* min-width: 1px; */
                text-align: center;
                display: inline-block;
            }

            .produxt-value {
                font-weight: 600;
            }

            .data-tables {
                margin: 20px 0px;
            }

            .icon-hapus {
                padding: 12px;
                background-color: #FF0000;
                color: white;
                font-size: 20px;
                border-radius: 8px;
            }

            .icon-edit {
                padding: 12px;
                background-color: #2955F5;
                color: white;
                border-radius: 8px;
                font-size: 20px;
                margin-left: 20px;
            }

            .card-head {
                background-color: #C7C7C7;
            }

            .card-total-products {
                background-color: #C7C7C7;
                padding: 10px 40px;
                /* width: 100%; */
                border-radius: 10px;
                position: fixed;
                bottom: 0;
                right: 0;
            }

            .card-total-products>h3 {
                font-weight: 400;
            }

            .text-deskripsi-semua {
                font-weight: 400;
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

            .input-with-icon { 
                position: relative;
                width: 100%; 
            }

            .input-with-icon .fa-search {
                position: absolute;
                left: 10px;
                top: 50%;
                transform: translateY(-50%);
                color: #888;
                pointer-events: none;
            }

            .input-with-icon .fa-search {
                position: absolute;
                left: 10px;
                top: 50%;
                transform: translateY(-50%);
                color: #888;
                pointer-events: none;
            }

            .input-with-icon .fa-close {
                position: absolute;
                right: 0px;
                top: 50%;
                transform: translateY(-50%);
                color: black;
                pointer-events: none;
            }

            .input-with-icon input {
                width: 100% !important;
                padding: 10px 10px 10px 35px;
                border: none;

                border-radius: 4px;
                font-size: 16px;
            }
            /*  */

            .radius-input {
                border-radius: 20px !important;
            }
            .base-line{
                border:8px solid white;
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="../../global.css">
    </head>

    <body>
        <div class="grid grid-cols-12  " style="background-color: #7CAEDF;">
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

                                <h1>Kelola Produk</h1>
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
            <div class="col-span-10" style="background:white;">
                <div class="right-container">

                    <div class="product-parent">
                        <div class="padding-product-table card-head grid grid-cols-12 gap-4">
                            <div class="col-span-3  flex items-center">
                                <h3>Produk</h3>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <h3>Harga</h3>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <h3>Jumlah</h3>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <h3>Deskripsi</h3>
                            </div>
                        </div>
                        <div class=" padding-product-table container-produxt">
                            <?php
                            $cari = isset($_GET['cari']) ? mysqli_real_escape_string($db, $_GET['cari']) : '';

                            if (!empty($cari)) {
                                $cari = mysqli_real_escape_string($db, $cari);
                                $sqlProduk = "SELECT * FROM tb_produk WHERE nama_produk LIKE '%$cari%' OR id_produk LIKE '%$cari%'";
                            } else {
                                $sqlProduk = "SELECT * FROM tb_produk";
                            }
                            $resultProduk = mysqli_query($db, $sqlProduk);

                            while ($row = mysqli_fetch_assoc($resultProduk)) {
                            ?>
                                <div class="data-row-tables grid grid-cols-12 gap-4" style="margin-bottom: 10px;">
                                    <div class="col-span-3 flex items-center justify-start">
                                        <div class="flex justify-start items-center">
                                            <img class="product-img-produxt" src="../../img/produkImg/<?= htmlspecialchars($row['image_produk']) ?>" alt="image">
                                            <div style="margin-left: 16px;">
                                                <p><?= htmlspecialchars($row['id_produk']) ?></p>
                                                <p><?= htmlspecialchars($row['nama_produk']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2 flex items-center">
                                        <p class="harga-satuan" data-harga="<?= $row['harga_produk'] ?>">Rp. <?= number_format($row['harga_produk'], 0, ',', '.') ?></p>
                                    </div>
                                    <div class="col-span-2 flex items-center">
                                        <div class="produxt-button-parent">
                                            <form action="prosesupdatestokproduk.php" method="post" style="display: inline;">
                                                <input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>">
                                                <input type="hidden" name="aksi" value="kurang">
                                                <button class="btn-decrease">-</button>
                                            </form>
                                            <form action="prosesupdatestokproduk.php" method="post" style="display: inline;">
                                                <input type="hidden" name="id_produk" value="<?= $row['id_produk'] ?>">
                                                <input type="hidden" name="aksi" value="tambah">
                                                <span class="produxt-value" data-qty="<?= $row['stok'] ?>"><?= $row['stok'] ?></span>
                                                <button class="btn-increase">+</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-span-2 flex items-center">
                                        <p class="deskripsi-per-produk"><?= htmlspecialchars($row['deskripsi_produk']) ?></p>
                                    </div>
                                    <div class="col-span-3 flex items-center justify-end">
                                        <a href="../kelolaproduk/kelola-produk.php?hapus=<?= $row['id_produk'] ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="icon-hapus fa fa-trash "></i></a>
                                        <a href="../editproduk/edit-produk.php?id=<?= $row['id_produk'] ?>">
                                            <i class="icon-edit fa fa-edit"></i>
                                        </a>

                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                        <div class="card-total-products">
                            <h3>
<?php
$sqlProdukSum = "SELECT count(*) as jumlah_produk_keseluruhan FROM tb_produk";
$querysum = mysqli_query($db, $sqlProdukSum);

if ($querysum) {
    $row = mysqli_fetch_assoc($querysum);
    $jumlah_produk_keseluruhan = $row['jumlah_produk_keseluruhan'];
    
} else {
    echo "Query gagal: " . mysqli_error($db);
}

?>
                                Total Produk : <span class="total-produk"><?=$jumlah_produk_keseluruhan?></span> Produk
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(number);
        }
        const icon = document.getElementById('notifIcon');
        const dialog = document.getElementById('notifDialog');

        icon.addEventListener('click', function() {
            dialog.classList.toggle('active');
        });

        // Optional: Klik di luar akan menutup dialog
        document.addEventListener('click', function(e) {
            if (!icon.contains(e.target) && !dialog.contains(e.target)) {
                dialog.classList.remove('active');
            }
        });
        document.querySelectorAll('.data-row-tables').forEach(row => {
            const btnIncrease = row.querySelector('.btn-increase');
            const btnDecrease = row.querySelector('.btn-decrease');
            const qtyEl = row.querySelector('.produxt-value');

            btnIncrease.addEventListener('click', () => {
                let current = parseInt(qtyEl.textContent);
                qtyEl.textContent = current + 1;

            });

            btnDecrease.addEventListener('click', () => {
                let current = parseInt(qtyEl.textContent);
                if (current > 0) {
                    qtyEl.textContent = current - 1;

                } else {

                    alert('Stok produk telah mencapai 0');
                }
            });
        });

        // Panggil pertama kali untuk inisialisasi
    </script>

    </html>