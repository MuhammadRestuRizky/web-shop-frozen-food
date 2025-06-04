<?php
include("../../konfig.php");
session_start();
$nama_kasir = $_SESSION['nama_kasir'];
// Ambil data admin kasir
$sql = "SELECT * FROM tb_adminkasir WHERE nama_kasir = '$nama_kasir'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
    $user = mysqli_fetch_assoc($query);
} else {
    // redirect atau logout jika tidak valid
    header("Location: ../pembeli/dashboard/keranjang.php");
    exit;
}
$sql_pesanan = "SELECT p.*, pb.username, pb.no_telpon 
                FROM tb_pesanan p 
                LEFT JOIN tb_pembeli pb ON p.id_pembeli = pb.id_pembeli
                WHERE p.status = 'Dicetak'
                ORDER BY p.tanggal_pesanan DESC";
$result_pesanan = mysqli_query($db, $sql_pesanan);
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

        p {
            margin-bottom: 4px;
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

        .container-pesaanan {
            background: white;
            padding: 20px 40px;
        }

        .h-vhfull {
            height: 100vh;
        }

        .pesanan-card-parent {}

        .pesanan-subcard>h3 {
            font-weight: 400;
        }

        .pesanan-subcard {
            margin: 0px 1px;
            padding: 10px 4px;
            display: inline-block;
            /* border-top-left-radius: 16px;
            border-top-right-radius: 16px; */
            /* width: 100%; */
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
    <div class="grid grid-cols-12 " style="background-color: #7CAEDF;">
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

                            <h1>Histori Penjualan</h1>
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
                <div class="container-pesaanan">
                    <div class="grid grid-cols-12 gap-4">
                        <?php if ($result_pesanan && mysqli_num_rows($result_pesanan) > 0): ?> 
                            <?php
                            $no = 1;
                            while ($pesanan = mysqli_fetch_assoc($result_pesanan)) :

                                $id_pesanan = $pesanan['id_pesanan'];
                                $sqlDetail = "SELECT produk.nama_produk, detail.jumlah_item, produk.harga_produk FROM tb_detailpesanan detail
                                              JOIN tb_produk produk ON detail.id_produk = produk.id_produk
                                              WHERE detail.id_pesanan = '$id_pesanan'";
                                $queryDetail = mysqli_query($db, $sqlDetail);
                                // var_dump($queryDetail); 
                              



                                $subtotalHitung = 0;
                            ?>
                                <div class="col-span-4 pesanan-card-parent">
                                    <div class="flex justify-between " style="padding: 0px 10px;">
                                        <div class="pesanan-subcard">
                                            <h3>No pesanan
                                                <strong><?= htmlspecialchars($pesanan['id_pesanan']) ?></strong></h3>
                                            </div>
                                             <div class="pesanan-subcard">
                                             <form method="post" action="../kelolapesanan/prosesbatal.php" onsubmit="return confirm('Yakin batalkan pesanan ini?');">
                                                <input type="hidden" name="id_pesanan" value="<?= $pesanan['id_pesanan'] ?>">
                                                <button type="submit" style=" border:none;cursor:pointer;">
                                                   <h3>
                                                <strong>
                                                    Hapus
                                                </strong>
                                                </h3>
                                                </button>
                                            </form>
                                          
                                        </div>
                                            <!-- <strong><?= htmlspecialchars($pesanan['status']==='Dicetak'?'Berhasil':'gagal') ?></strong></h3> -->
                                    </div>
                                    <div class="pesanan-card">
                                        <div class="head-pesanan-card ">
                                            <p class="">
                                                Jl. Es Batu No.45 Indramayu
                                            </p>
                                            <p>No Telpon: <?= htmlspecialchars($pesanan['no_telpon']) ?></p>
                                            <p>Tanggal Pesanan: <?= date('d-m-Y', strtotime($pesanan['tanggal_pesanan'])) ?></p>
                                            <hr style="margin: 10px 0px;">
                                        </div>
                                        <div class="pembeli-pesanan-card">
                                             <p>Pembeli: <?= htmlspecialchars($pesanan['username']) ?></p>
                                            <p>Jumlah Produk: <?= $pesanan['jumlah_produk'] ?></p>
                                            <p>Jumlah Item: <?= $pesanan['jumlah_item'] ?></p>
                                            <p>Ambil Pesanan di : Jln LOHBENER No. 45 indramayu</p>
                                        </div>
                                        <hr style="margin: 10px 0px;">
                                        <div class="item-pesanan-card">
                                            <div class=" items-data-judul flex justify-between items-center gap-4">
                                                <p>Nama produk:</p>
                                                <p>Harga:</p>
                                                <p>Jumlah:</p>
                                                <p>Total:</p>
                                            </div>
                                            <hr style="margin: 10px 0px; ">
                                             <?php
                                            if ($queryDetail && mysqli_num_rows($queryDetail) > 0) :
                                                while ($detail = mysqli_fetch_assoc($queryDetail)) :
                                                    $totalItem = $detail['harga_produk'] * $detail['jumlah_item'];
                                                    $subtotalHitung += $totalItem;
                                            ?>
                                                    <div class="items-data-pesanan flex justify-between items-center gap-4">
                                                        <p><?php echo htmlspecialchars($detail['nama_produk']); ?></p>
                                                        <p>Rp.<?php echo number_format($detail['harga_produk'], 0, ',', '.'); ?></p>
                                                        <p><?php echo $detail['jumlah_item']; ?></p>
                                                        <p>Rp.<?php echo number_format($totalItem, 0, ',', '.'); ?></p>
                                                    </div>
                                            <?php
                                                endwhile;
                                            endif;
                                            ?>
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="footer-card-pesanan">
                                            <hr style="margin: 10px 0; border: 1px solid #999999;">
                                            <br>
                                            <br>
                                            <br>
                                            <div class="flex justify-between items-center">
                                                <p>Subtotal: </p>
                                             <p>Rp.<?php echo number_format($pesanan['subtotal'], 0, ',', '.'); ?></p>
                                            </div>
                                            <br>
                                            <hr style="margin: 10px 0px;height:4px; ">
                                            <p class="text-center">Terima Kasih & Sampai Jumpa!</p>
                                        </div>

                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="col-span-12 text-center">Belum ada pesanan.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
    </script>
</body>

</html>