<?php
include("../../konfig.php");
session_start();
$username = $_SESSION['username'];
$sql = "SELECT * FROM tb_pembeli WHERE username = '$username'";
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
            background: linear-gradient(to bottom, #96c5f7, white);
        }

        .container {
            padding: 16px;
        }

        .right-container {
            /* height: 100%; */
        }

        .head-container {
            padding: 20px 40px;
        }

        .container-cart {
            padding-bottom: 100px;

        }

        .cart-parent {
            background-color: #EFEEEE;
            padding: 20px 40px;
            position: relative;
            height: 100%;
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

        .product-img-cart {
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

        .cart-button-parent {
            display: flex;
            align-items: center;
            gap: 5px;
            justify-content: center;
            margin-top: 10px;
        }

        .cart-button-parent button {
            width: 25px;
            height: 25px;
            font-size: 20px;
            font-weight: bold;

            background-color: #1677FF;
            color: #f1f1f1;
            border: none;
            border-radius: 100px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cart-button-parent span {
            font-size: 20px;
            /* min-width: 1px; */
            text-align: center;
            display: inline-block;
        }

        .cart-value {
            font-weight: 600;
        }

        .data-tables {
            margin: 20px 0px;
        }

        .icon-hapus {
            padding: 8px;
            background-color: #FF0000;
            color: white;
            border-radius: 8px;
        }

        .card-cart-total {
            background-color: #EFEEEE;
            padding: 30px 40px 20px 40px;
            width: 100%;
            position: fixed;
            bottom: 0;
            /* margin-top: 60px; */
        }

        .text-total-semua {
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
            font-weight: 400 !important;
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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../global.css">
</head>

<body>
    <div class="grid grid-cols-12 h-vhfull">

        <?php include '../../component/sidebar-pembeli.php'; ?>
        <div class="col-span-10">
            <div class="right-container">
                 <div class="head-container flex justify-between items-center">
          <h1 style="font-size: 50px;">Keranjang</h1>
          <h2>
            <div class="flex items-center">
              <?php
              $id_pembeli = $user['id_pembeli'];
              $sql = "SELECT * FROM tb_notifikasi 
                WHERE jenis_pengguna = 'pembeli' 
                AND id_pengguna = '$id_pembeli' 
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

              &nbsp;
              &nbsp;
             <form action="../../proseslogoutpembeli.php" method="POST" style="display: inline;">
                <button type="submit" name="logout" class="items-center flex fw-semibold" style="background: none; border: none; color: inherit; cursor: pointer;font-size:28px;" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                  Logout&nbsp;
                  <span>
                    <i class="fas fa-sign-out-alt" style="font-size:30px;"></i>
                  </span>
                </button>
              </form>

            </div>
          </h2>
        </div>
                <div class="cart-parent">
                    <div class="grid grid-cols-12 gap-4">
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
                            <h3>Total</h3>
                        </div>
                    </div>
                    <div class="container-cart">
                        <?php

                        $usernamePembeli = $_SESSION['username'];
                        $sqlPembeli = "SELECT * FROM tb_pembeli WHERE username = '$usernamePembeli'";
                        $query = mysqli_query($db, $sqlPembeli);
                        if ($query && mysqli_num_rows($query) > 0) {
                            $user = mysqli_fetch_assoc($query);
                        }
                        $id_pembeli = $user['id_pembeli'];
                        $sql_keranjang = "SELECT krj.*, p.nama_produk, p.harga_produk, p.image_produk, p.stok
                  FROM tb_keranjang krj
                  JOIN tb_produk p ON krj.id_produk = p.id_produk
                  WHERE krj.id_pembeli = $id_pembeli";
                        $result_keranjang = mysqli_query($db, $sql_keranjang);
                        // exit;
                        // $disabled = false;
                        if (mysqli_num_rows($result_keranjang) > 0) {
                            $disabled = '';
                        } else {
                            $disabled = 'disabled';
                        }
                        // var_dump( $disabled);
                        $total_barang = 0;
                        $total_produk = 0;
                        $total_harga = 0;

                        while ($item = mysqli_fetch_assoc($result_keranjang)):
                            $total_produk++;
                            $sub_total = $item['harga_produk'] * $item['jumlah_item'];
                            $total_harga += $sub_total;
                            $total_barang += $item['jumlah_item'];
                        ?>
                            <div class="data-row-tables grid grid-cols-12 gap-4">
                                <div class="col-span-3 flex items-center justify-start">
                                    <div class="flex justify-start items-center">
                                        <img class="product-img-cart" src="../../img/produkImg/<?= $item['image_produk'] ?>" alt="<?= $item['nama_produk'] ?>">
                                        <div style="margin-left: 16px;">
                                            <p><?= $item['id_produk'] ?></p>
                                            <p><?= $item['nama_produk'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-2  flex items-center">
                                    <p class="harga-satuan" data-harga="<?= $item['harga_produk'] ?>">Rp. <?= number_format($item['harga_produk'], 0, ',', '.') ?></p>
                                </div>
                                <div class="col-span-2  flex items-center">
                                    <div class="cart-button-parent">
                                        <form action="prosesUpdateKeranjang.php" method="post" style="display: inline;">
                                            <input type="hidden" name="id_produk" value="<?= $item['id_produk'] ?>">
                                            <input type="hidden" name="id_keranjang" value="<?= $item['id_keranjang'] ?>">
                                            <input type="hidden" name="aksi" value="kurang">
                                            <button type="submit" class="btn-decrease">-</button>
                                        </form>

                                        <span class="cart-value"><?= $item['jumlah_item'] ?></span>

                                        <form action="prosesUpdateKeranjang.php" method="post" style="display: inline;">
                                            <input type="hidden" name="id_produk" value="<?= $item['id_produk'] ?>">
                                            <input type="hidden" name="id_keranjang" value="<?= $item['id_keranjang'] ?>">
                                            <input type="hidden" name="jumlah_max_produk" value="<?= $item['stok'] ?>">
                                            <input type="hidden" name="aksi" value="tambah">
                                            <button type="submit" class="btn-increase" <?php if ($item['jumlah_item'] >= $item['stok']): ?>disabled<?php endif; ?>>+</button>
                                        </form>
                                    </div>

                                </div>
                                <div class="col-span-2  flex items-center">
                                    <p class="total-per-produk">Rp. <?= number_format($sub_total, 2, ',', '.') ?></p>
                                </div>
                                <div class="col-span-2  flex items-center">
                                    <form method="POST" action="prosesupdatekeranjang.php" style="display:inline">
                                        <input type="hidden" name="id_produk" value="<?= $item['id_produk'] ?>">
                                        <input type="hidden" name="id_keranjang" value="<?= $item['id_keranjang'] ?>">
                                        <input type="hidden" name="aksi" value="hapus">
                                        <button class="btn-hapus" style="border: none;" onclick="return confirm('Yakin ingin menghapus detail pesanan ini?')"><i class="icon-hapus fa fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        <?php endwhile; ?>

                    </div>
                    <form action="proseskeranjang.php" method="POST">
                        <div class="card-cart-total">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-4">
                                    <button type="submit" class="button-Custom" name="submit_order" <?= $disabled ?>>
                                        <h2 class="text-total-semua">Pesan</h2>
                                    </button>
                                </div>
                                <div class="col-span-4">
                                    <h2 class="text-total-semua">Jumlah Produk:</h2>
                                    <h2 class="text-total-semua">Jumlah Barang:</h2>
                                    <h2 class="text-total-semua">Total:</h2>
                                </div>
                                <div class="col-span-4">
                                    <h2 class="text-total-semua"><?= $total_produk ?> Produk</h2>
                                    <h2 class="text-total-semua"><?= $total_barang ?> Item</h2>
                                    <h2 id="total-semua" class="text-total-semua">Rp. <?= number_format($total_harga, 0, ',', '.') ?></h2>
                                </div>
                            </div>
                        </div>
                    </form>

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
    function updateTotal() {
        let totalKeseluruhan = 0;
        document.querySelectorAll('.data-row-tables').forEach(row => {
            const harga = parseInt(row.querySelector('.harga-satuan').dataset.harga);
            const qtyEl = row.querySelector('.cart-value');
            const qty = parseInt(qtyEl.textContent);
            const total = harga * qty;

            row.querySelector('.total-per-produk').textContent = formatRupiah(total);
            totalKeseluruhan += total;
        });

        document.getElementById('total-semua').textContent = formatRupiah(totalKeseluruhan);
    }

    document.querySelectorAll('.data-row-tables').forEach(row => {
        const btnIncrease = row.querySelector('.btn-increase');
        const btnDecrease = row.querySelector('.btn-decrease');
        const qtyEl = row.querySelector('.cart-value');

        btnIncrease.addEventListener('click', () => {
            let current = parseInt(qtyEl.textContent);
            qtyEl.textContent = current + 1;
            updateTotal();
        });

        btnDecrease.addEventListener('click', () => {
            let current = parseInt(qtyEl.textContent);
            if (current > 1) {
                qtyEl.textContent = current - 1;
                updateTotal();
            } else {

                alert('Pesanan minimal 1');
            }
        });
    });

    // Panggil pertama kali untuk inisialisasi
    updateTotal();
</script>

</html>