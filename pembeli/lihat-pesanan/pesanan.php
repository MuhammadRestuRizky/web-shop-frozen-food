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

        p {
            margin-bottom: 4px;
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

        .container-pesaanan {
            background: white;
            padding: 20px 40px;
        }

        .h-vhfull {
            height: 100vh;
        }

        .pesanan-card-parent {}

        .pesanan-number>h1 {
            font-weight: 400;
            padding: 10px;
            display: inline;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            width: 100%;
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
                    <h1 style="font-size: 50px;">Beranda</h1>
                    <h2>
                        <a href="../pembeli/dashboard/keranjang.php" class="items-center flex fw-semibold">
                            Logout
                            <!-- buat spasi; -- -->
                            &nbsp;
                            <span class="">
                                <i class=" fas fa-sign-out-alt" style="font-size:30px;"></i>
                            </span>
                        </a>
                    </h2>
                </div>
                <div class="container-pesaanan">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-4 pesanan-card-parent">
                            <div class="pesanan-number">
                                <h1>No 1</h1>
                            </div>
                            <div class="pesanan-card">
                                <div class="head-pesanan-card ">
                                    <p class="">
                                        Jl. Es Batu No.45 Indramayu
                                    </p>
                                    <p class="">
                                        No_Telpon : (022) 9876-5432
                                    </p>
                                    <p class="">
                                        Tanggal_pesanan : 23-03-2032
                                    </p>
                                    <hr style="margin: 10px 0px;">
                                </div>
                                <div class="pembeli-pesanan-card">
                                    <p>Pembeli : Subroto</p>
                                    <p>No_pesanan : 00001</p>
                                    <p>Tanggal_pesanan : 23 maret 2032</p>
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
                                    <div class=" items-data-pesanan flex justify-between items-center gap-4">
                                        <p>Dumpling Keju</p>
                                        <p>Rp.20.000</p>
                                        <p>900</p>
                                        <p>Rp.900.000</p>
                                    </div>
                                    <div class=" items-data-pesanan flex justify-between items-center gap-4">
                                        <p>Dumpling Keju</p>
                                        <p>Rp.20.000</p>
                                        <p>900</p>
                                        <p>Rp.900.000</p>
                                    </div>
                                    <div class=" items-data-pesanan flex justify-between items-center gap-4">
                                        <p>Dumpling Keju</p>
                                        <p>Rp.20.000</p>
                                        <p>900</p>
                                        <p>Rp.900.000</p>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="footer-card-pesanan">
                                    <hr style="margin: 10px 0; border: 1px solid #999999;">
                                    <div class="flex justify-between items-center">
                                        <p>Subtotal: </p>
                                        <p>Rp.500.000</p>
                                    </div>
                                       <hr style="margin: 10px 0px;height:4px; ">
                                       <p>Terima Kasih & Sampai Jumpa!</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-span-4 pesanan-card-parent">
                            <div class="pesanan-number">
                                <h1>No 1</h1>
                            </div>
                            <div class="pesanan-card">
                                <div class="head-pesanan-card ">
                                    <p class="">
                                        Jl. Es Batu No.45 Indramayu
                                    </p>
                                    <p class="">
                                        No_Telpon : (022) 9876-5432
                                    </p>
                                    <p class="">
                                        Tanggal_pesanan : 23-03-2032
                                    </p>
                                    <hr style="margin: 10px 0px;">
                                </div>
                                <div class="pembeli-pesanan-card">
                                    <p>Pembeli : Subroto</p>
                                    <p>No_pesanan : 00001</p>
                                    <p>Tanggal_pesanan : 23 maret 2032</p>
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
                                    <div class=" items-data-pesanan flex justify-between items-center gap-4">
                                        <p>Dumpling Keju</p>
                                        <p>Rp.20.000</p>
                                        <p>900</p>
                                        <p>Rp.900.000</p>
                                    </div>
                                    <div class=" items-data-pesanan flex justify-between items-center gap-4">
                                        <p>Dumpling Keju</p>
                                        <p>Rp.20.000</p>
                                        <p>900</p>
                                        <p>Rp.900.000</p>
                                    </div>
                                    <div class=" items-data-pesanan flex justify-between items-center gap-4">
                                        <p>Dumpling Keju</p>
                                        <p>Rp.20.000</p>
                                        <p>900</p>
                                        <p>Rp.900.000</p>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="footer-card-pesanan">
                                    <hr style="margin: 10px 0; border: 1px solid #999999;">
                                    <div class="flex justify-between items-center">
                                        <p>Subtotal: </p>
                                        <p>Rp.500.000</p>
                                    </div>
                                       <hr style="margin: 10px 0px;height:4px; ">
                                       <p>Terima Kasih & Sampai Jumpa!</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-span-4 pesanan-card-parent">
                            <div class="pesanan-number">
                                <h1>No 1</h1>
                            </div>
                            <div class="pesanan-card">
                                <div class="head-pesanan-card ">
                                    <p class="">
                                        Jl. Es Batu No.45 Indramayu
                                    </p>
                                    <p class="">
                                        No_Telpon : (022) 9876-5432
                                    </p>
                                    <p class="">
                                        Tanggal_pesanan : 23-03-2032
                                    </p>
                                    <hr style="margin: 10px 0px;">
                                </div>
                                <div class="pembeli-pesanan-card">
                                    <p>Pembeli : Subroto</p>
                                    <p>No_pesanan : 00001</p>
                                    <p>Tanggal_pesanan : 23 maret 2032</p>
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
                                    <div class=" items-data-pesanan flex justify-between items-center gap-4">
                                        <p>Dumpling Keju</p>
                                        <p>Rp.20.000</p>
                                        <p>900</p>
                                        <p>Rp.900.000</p>
                                    </div>
                                    <div class=" items-data-pesanan flex justify-between items-center gap-4">
                                        <p>Dumpling Keju</p>
                                        <p>Rp.20.000</p>
                                        <p>900</p>
                                        <p>Rp.900.000</p>
                                    </div>
                                    <div class=" items-data-pesanan flex justify-between items-center gap-4">
                                        <p>Dumpling Keju</p>
                                        <p>Rp.20.000</p>
                                        <p>900</p>
                                        <p>Rp.900.000</p>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="footer-card-pesanan">
                                    <hr style="margin: 10px 0; border: 1px solid #999999;">
                                    <div class="flex justify-between items-center">
                                        <p>Subtotal: </p>
                                        <p>Rp.500.000</p>
                                    </div>
                                       <hr style="margin: 10px 0px;height:4px; ">
                                       <p>Terima Kasih & Sampai Jumpa!</p>
                                </div>

                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body> 

</html>