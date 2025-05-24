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
            background: linear-gradient(to bottom, #96c5f7, white);
        }

        .container {
            padding: 16px;
        } 
        .head-container {
            padding: 20px 40px;
        }

        .container-produxt {
            padding-bottom: 100px;

        }

        .product-parent {
            background-color: #C7C7C7;
            position: relative;
            height: 100%;
        }

        .padding-product-table{
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

            background-color: #1677FF;
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
            padding: 8px;
            background-color: #FF0000;
            color: white;
            border-radius: 8px;
        }
        .icon-edit {
            padding: 8px;
            background-color: #2955F5;
            color: white;
            border-radius: 8px;
            margin-left: 20px;
        }
        .card-head{
            background-color: #C7C7C7 ;
        }
        .card-total-products{
            background-color: #C7C7C7;
            padding: 10px 40px;
            /* width: 100%; */
            border-radius: 10px;
            position: fixed;
            bottom: 0; 
            right: 0;
        }
        .card-total-products >h3{
            font-weight: 400;
        }

        .text-deskripsi-semua {
            font-weight: 400;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../global.css">
</head>

<body>
    <div class="grid grid-cols-12 h-vhfull">

        <?php include '../../component/sidebar-admin.php'; ?>
        <div class="col-span-10">
            <div class="right-container">
                <div class="head-container">
                    <h1>Kelola Produk</h1>
                </div>
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
                        <div class="data-row-tables grid grid-cols-12 gap-4">
                            <div class="col-span-3 flex items-center justify-start">
                                <div class="flex justify-start items-center">

                                    <img class="product-img-produxt" src="../../img/smokedbeef.jpg" alt="" srcset="" max-width="200px">
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
                                    <div class="produxt-button-parent">
                                        <button class="btn-decrease">-</button>
                                        <span class="produxt-value" data-qty="2">2</span>
                                        <button class="btn-increase">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="deskripsi-per-produk">Lorem ipsum dolor sit.</p>
                            </div>
                            <div class="col-span-3  flex items-center justify-end">
                                <p><i class="icon-hapus fa fa-trash "></i></p>
                                <p><i class="icon-edit fa fa-edit "></i></p>

                            </div>
                        </div>
                        <div class="data-row-tables grid grid-cols-12 gap-4">
                            <div class="col-span-3 flex items-center justify-start">
                                <div class="flex justify-start items-center">

                                    <img class="product-img-produxt" src="../../img/smokedbeef.jpg" alt="" srcset="" max-width="200px">
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
                                    <div class="produxt-button-parent">
                                        <button class="btn-decrease">-</button>
                                        <span class="produxt-value" data-qty="2">2</span>
                                        <button class="btn-increase">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="deskripsi-per-produk">Lorem ipsum dolor sit.</p>
                            </div>
                            <div class="col-span-3  flex items-center justify-end">
                                <p><i class="icon-hapus fa fa-trash "></i></p>
                                <p><i class="icon-edit fa fa-edit "></i></p>

                            </div>
                        </div>
                        <div class="data-row-tables grid grid-cols-12 gap-4">
                            <div class="col-span-3 flex items-center justify-start">
                                <div class="flex justify-start items-center">

                                    <img class="product-img-produxt" src="../../img/smokedbeef.jpg" alt="" srcset="" max-width="200px">
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
                                    <div class="produxt-button-parent">
                                        <button class="btn-decrease">-</button>
                                        <span class="produxt-value" data-qty="2">2</span>
                                        <button class="btn-increase">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2  flex items-center">
                                <p class="deskripsi-per-produk">Lorem ipsum dolor sit.</p>
                            </div>
                            <div class="col-span-3  flex items-center justify-end">
                                <p><i class="icon-hapus fa fa-trash "></i></p>
                                <p><i class="icon-edit fa fa-edit "></i></p>

                            </div>
                        </div>
                    </div>
                    <div class="card-total-products">
                        <h3>

                            Total Produk : <span class="total-produk">2</span> Produk
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