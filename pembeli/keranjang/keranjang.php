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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../global.css">
</head>

<body>
    <div class="grid grid-cols-12 h-vhfull">

        <?php include '../../component/sidebar-pembeli.php'; ?>
        <div class="col-span-10">
            <div class="right-container">
                <div class="head-container">
                    <h1>Keranjang</h1>


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
                        <div class="data-row-tables grid grid-cols-12 gap-4">
                            <div class="col-span-3 flex items-center justify-start">
                                <div class="flex justify-start items-center">

                                    <img class="product-img-cart" src="../../img/smokedbeef.jpg" alt="" srcset="" max-width="200px">
                                    <div class="" style="margin-left: 16px;">
                                        <p> 001</p>
                                        <p> Stick kentang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="harga-satuan" data-harga="17000">Rp. 17.000</p>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <div class="flex">
                                    <div class="cart-button-parent">
                                        <button class="btn-decrease">-</button>
                                        <span class="cart-value" data-qty="2">2</span>
                                        <button class="btn-increase">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="total-per-produk">Rp. 34.000</p>
                            </div>


                            <div class="col-span-2  flex items-center">
                                <p><i class="icon-hapus fa fa-trash "></i></p>
                            </div>
                        </div>
                        <div class="data-row-tables grid grid-cols-12 gap-4">
                            <div class="col-span-3 flex items-center justify-start">
                                <div class="flex justify-start items-center">

                                    <img class="product-img-cart" src="../../img/smokedbeef.jpg" alt="" srcset="" max-width="200px">
                                    <div class="" style="margin-left: 16px;">
                                        <p> 001</p>
                                        <p> Stick kentang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="harga-satuan" data-harga="17000">Rp. 17.000</p>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <div class="flex">
                                    <div class="cart-button-parent">
                                        <button class="btn-decrease">-</button>
                                        <span class="cart-value" data-qty="2">2</span>
                                        <button class="btn-increase">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="total-per-produk">Rp. 34.000</p>
                            </div>


                            <div class="col-span-2  flex items-center">
                                <p><i class="icon-hapus fa fa-trash "></i></p>
                            </div>
                        </div>
                        <div class="data-row-tables grid grid-cols-12 gap-4">
                            <div class="col-span-3 flex items-center justify-start">
                                <div class="flex justify-start items-center">

                                    <img class="product-img-cart" src="../../img/smokedbeef.jpg" alt="" srcset="" max-width="200px">
                                    <div class="" style="margin-left: 16px;">
                                        <p> 001</p>
                                        <p> Stick kentang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="harga-satuan" data-harga="17000">Rp. 17.000</p>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <div class="flex">
                                    <div class="cart-button-parent">
                                        <button class="btn-decrease">-</button>
                                        <span class="cart-value" data-qty="2">2</span>
                                        <button class="btn-increase">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="total-per-produk">Rp. 34.000</p>
                            </div>


                            <div class="col-span-2  flex items-center">
                                <p><i class="icon-hapus fa fa-trash "></i></p>
                            </div>
                        </div>
                        <div class="data-row-tables grid grid-cols-12 gap-4">
                            <div class="col-span-3 flex items-center justify-start">
                                <div class="flex justify-start items-center">

                                    <img class="product-img-cart" src="../../img/smokedbeef.jpg" alt="" srcset="" max-width="200px">
                                    <div class="" style="margin-left: 16px;">
                                        <p> 001</p>
                                        <p> Stick kentang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="harga-satuan" data-harga="17000">Rp. 17.000</p>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <div class="flex">
                                    <div class="cart-button-parent">
                                        <button class="btn-decrease">-</button>
                                        <span class="cart-value" data-qty="2">2</span>
                                        <button class="btn-increase">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="total-per-produk">Rp. 34.000</p>
                            </div>


                            <div class="col-span-2  flex items-center">
                                <p><i class="icon-hapus fa fa-trash "></i></p>
                            </div>
                        </div>
                        <div class="data-row-tables grid grid-cols-12 gap-4">
                            <div class="col-span-3 flex items-center justify-start">
                                <div class="flex justify-start items-center">

                                    <img class="product-img-cart" src="../../img/smokedbeef.jpg" alt="" srcset="" max-width="200px">
                                    <div class="" style="margin-left: 16px;">
                                        <p> 001</p>
                                        <p> Stick kentang</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="harga-satuan" data-harga="17000">Rp. 17.000</p>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <div class="flex">
                                    <div class="cart-button-parent">
                                        <button class="btn-decrease">-</button>
                                        <span class="cart-value" data-qty="2">2</span>
                                        <button class="btn-increase">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="total-per-produk">Rp. 34.000</p>
                            </div>


                            <div class="col-span-2  flex items-center">
                                <p><i class="icon-hapus fa fa-trash "></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-cart-total">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-4">
                                <button class="button-Custom">
                                    <h2 class="text-total-semua">
                                        Pesan
                                    </h2>
                                </button>
                            </div>
                            <div class="col-span-4">
                                <h2 class="text-total-semua">Jumlah Barang:</h1>
                                    <h2 class="text-total-semua">Total:</h2>
                            </div>
                            <div class="col-span-4">
                                <h2 class="text-total-semua">34 Pcs</h2>
                                <h2 id="total-semua" class="text-total-semua">Rp. 0</h2>
                            </div>
                        </div>
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