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
            background-color: white;
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
            /* padding: 0px 80px; */
            width: 100%;
            /* left: 50%; */
            position: fixed;
            bottom: 0;
            /* margin-top: 60px; */
        }

        .cart-container {

            background-color: #EFEEEE;
            border-radius: 20px;
            padding: 10px 40px;
        }

        .text-total-semua {
            font-weight: 400;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../global.css">
</head>

<body>
    <div class="grid grid-cols-12 h-vhfull">

        <div class="col-span-12">
            <?php include '../../component/navbar-pembeli.php'; ?>
         <div class="head-container flex justify-start items-center">
              <i onclick="window.history.back()" class="fa-solid fa-chevron-left" style="font-size: 40px;"></i>
              &nbsp;
              &nbsp;
                <h1 style="font-size: 50px;">Keranjang</h1>
            </div>
            <div class="cart-parent">
                <div class="grid grid-cols-12">

                    <div class=" col-span-10 col-start-2">
                        <div class="">

                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-3  flex items-center">
                                    <h3>Produk</h3>
                                </div>
                                <div class="col-span-2  flex items-center">
                                    <h3>Harga</h3>
                                </div>
                                <div class="col-span-3  flex items-center">
                                    <h3>Jumlah</h3>
                                </div>
                                <div class="col-span-3  flex items-center">
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
                                        <div class="col-span-3  flex items-center">
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
                                        <div class="col-span-2  flex items-center justify-end">
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
                        </div>
                    </div>

                </div>
            </div>
            <form action="proseskeranjang.php" method="POST">
                <div class="card-cart-total">
                    <div class="grid grid-cols-12 ">

                       <div class="col-span-10 col-start-2">
                         <div class="cart-container">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-4" style="height:100%;">
                                    <div class="flex items-center" style="height:100%;">
                                        <div>
                                            <button style="background-color: #7CAEDF;" type="submit" class="button-Custom" name="submit_order" <?= $disabled ?>>
                                                <h2 class="">Checkout</h2>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-4" style="height:100%;">
                                    <div class="flex items-center" style="height:100%;">
                                        <div>

                                            <h2 class="text-total-semua">Jumlah Produk:</h2>
                                            <h2 class="text-total-semua">Jumlah Barang:</h2>
                                            <h2 class="text-total-semua">Total:</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-4" style="height:100%;">
                                    <div class="flex items-center" style="height:100%;">
                                        <div>

                                            <h2 class="text-total-semua"><?= $total_produk ?> Produk</h2>
                                            <h2 class="text-total-semua"><?= $total_barang ?> Item</h2>
                                            <h2 id="total-semua" class="text-total-semua">Rp. <?= number_format($total_harga, 0, ',', '.') ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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