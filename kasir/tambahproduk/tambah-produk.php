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

        .head-container {
            padding: 20px 40px;
        }
        .right-container{
            /* height: inherit; */
        }

        .container-product {
            background-color: #C7C7C7;
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
            border: 2px dashed black;
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
        .input-tambah{
            background: #ffffff;
         
            padding: 10px;
            border-radius: 16px;
            border: none;
        }
        .btn-tambah{
            border-radius: 16px;
            padding:14px 40px;
            border:none;
        }
        .btn-batal{
            background-color: #C71515;
            margin-right: 20px;
        }
        .btn-simpan{
            background-color: #4FC965;
            margin-right: 20px;
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
                    <h1 style="font-size: 50px;">Tambah Produk</h1> 
                </div>
                <div class="container-product">
                    <div class="card-product">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-2">
                                <h2 class="fw-medium">Foto Produk: </h2>
                            </div>
                            <div class="col-span-10">
                                <div class="image-upload" id="imageUpload" onclick="document.getElementById('fileInput').click()">
                                    <!-- Ikon tambah -->
                                    <i class="fa fa-plus" style="font-size:180px;color:#79AEE0;"></i>
                                </div>
                                <!-- Input file disembunyikan -->
                                <input type="file" id="fileInput" accept="image/*" onchange="previewImage(event)">
                                <!-- </div> -->
                                <img id="imgpreview" src="#" alt="Preview" style="display: none;" />
                                <!-- Input file disembunyikan -->
                                <input type="file" id="fileInput" accept="image/*" onchange="previewImage(event)">
                            </div>
                            <div class="col-span-2">
                                <h2 class="fw-medium">Nama Produk: </h2>
                            </div>
                            <div class="col-span-10">
                                <h2 class="fw-medium">
                                    <input type="text" class="input-tambah"  style="width:40%;" name="nama_produk" >
                                </h2>
                            </div>
                            <div class="col-span-2">
                                <h2 class="fw-medium">Harga: </h2>
                            </div>
                            <div class="col-span-10">
                                <h2 class="fw-medium">
                                    <input type="number" style="width:36%;"  class="input-tambah" name="harga_produk" >
                                </h2>
                            </div>
                            <div class="col-span-2">
                                <h2 class="fw-medium">Stok: </h2>
                            </div>
                            <div class="col-span-10">
                                <h2 class="fw-medium">
                                    <input type="number" style="width:10%;"  class="input-tambah" name="stok" >
                                </h2>
                            </div>
                            <div class="col-span-2">
                                <h2 class="fw-medium">Deskripsi: </h2>
                            </div>
                            <div class="col-span-10">
                                <h2 class="fw-medium">
                                    <input type="text" style="width:100%;" class="input-tambah" name="deskripsi_produk" >
                                </h2>
                            </div>
                            <br>
                            <div class="col-span-12 flex justify-end">
                                <button class="btn-tambah btn-batal"> 
                                    <a href="../pembeli/kelolaproduk/kelola-produk.php" class="">
                                        <h2>Batal</h2>
                                    </a>
                                </button>
                                <button class="btn-tambah btn-simpan"> 
                                    <a href="../pembeli/kelolaproduk/kelola-produk.php" class="flex items-center">
                                        <h2>Simpan</h2>
                                        &nbsp;
                                        <i class="fa fa-arrow-up" style="font-size: 20px;"></i>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
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