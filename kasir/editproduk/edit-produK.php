<?php
include("../../konfig.php");
session_start();
$nama_kasir = $_SESSION['nama_kasir'];
$sql = "SELECT * FROM tb_adminkasir WHERE nama_kasir = '$nama_kasir'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
    $user = mysqli_fetch_assoc($query);
}

// Ambil data produk dari database
$id_produk = $_GET['id'];
$sql_produk = "SELECT * FROM tb_produk WHERE id_produk = '$id_produk'";
$query_produk = mysqli_query($db, $sql_produk);
$produk = mysqli_fetch_assoc($query_produk);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../global.css">
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

        .right-container {
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

        .input-tambah {
            background: #ffffff;

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
            background-color: #C71515;
            margin-right: 20px;
        }

        .btn-simpan {
            background-color: #4FC965;
            margin-right: 20px;
        }
    </style>
</head>

<body>
    <div class="grid grid-cols-12 h-vhfull">
        <?php include '../../component/sidebar-admin.php'; ?>
        <div class="col-span-10">
            <div class="right-container">
                <div class="head-container">
                    <h1 style="font-size: 50px;">Edit Produk</h1>
                </div>
                <div class="container-product">
                    <div class="card-product">
                        <form action="proseseditproduk.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_produk" value="<?= $produk['id_produk']; ?>">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-2">
                                    <h2 class="fw-medium">Foto Produk: </h2>
                                </div>
                                <div class="col-span-10">
                                    <div class="image-upload has-image"
                                        id="imageUpload"
                                        data-oldimage="../../img/produk/<?= $produk['image_produk']; ?>"
                                        onclick="document.getElementById('fileInput').click()"
                                        style="background-image: url('../../img/produkimg/<?= $produk['image_produk']; ?>');">
                                        <i class="fa fa-plus" style="font-size:180px;color:#79AEE0;"></i>
                                    </div>

                                    <input type="file" name="image_produk" id="fileInput" accept="image/*" onchange="previewImage(event)">
                                </div>
                                <div class="col-span-2">
                                    <h2 class="fw-medium">Nama Produk: </h2>
                                </div>
                                <div class="col-span-10">
                                    <input type="text" class="input-tambah" style="width:40%;" name="nama_produk" value="<?= $produk['nama_produk']; ?>">
                                </div>
                                <div class="col-span-2">
                                    <h2 class="fw-medium">Harga: </h2>
                                </div>
                                <div class="col-span-10">
                                    <input type="number" class="input-tambah" style="width:36%;" name="harga_produk" value="<?= $produk['harga_produk']; ?>">
                                </div>
                                <div class="col-span-2">
                                    <h2 class="fw-medium">Stok: </h2>
                                </div>
                                <div class="col-span-10">
                                    <input type="number" class="input-tambah" style="width:10%;" name="stok" value="<?= $produk['stok']; ?>">
                                </div>
                                <div class="col-span-2">
                                    <h2 class="fw-medium">Deskripsi: </h2>
                                </div>
                                <div class="col-span-10">
                                    <input type="text" class="input-tambah" style="width:100%;" name="deskripsi_produk" value="<?= $produk['deskripsi_produk']; ?>">
                                </div>
                                <div class="col-span-12 flex justify-end mt-4">
                                    <button type="button" onclick="history.back()" class="btn-tambah btn-batal">
                                        <h2>Batal</h2>
                                    </button>
                                    <button type="submit" class="btn-tambah btn-simpan">
                                        <h2>Update</h2>
                                        &nbsp;<i class="fa fa-save" style="font-size: 20px;"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const imageUploadDiv = document.getElementById('imageUpload');

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imageUploadDiv.style.backgroundImage = `url('${e.target.result}')`;
                    imageUploadDiv.classList.add('has-image');
                };
                reader.readAsDataURL(file);
            } else {
                // fallback: tampilkan gambar lama
                const oldImage = imageUploadDiv.getAttribute('data-oldimage');
                imageUploadDiv.style.backgroundImage = `url('${oldImage}')`;
            }
        }
    </script>
</body>

</html>