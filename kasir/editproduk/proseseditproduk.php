<?php
include("../../konfig.php");

$id = $_POST['id_produk'];
$nama = $_POST['nama_produk'];
$harga = $_POST['harga_produk'];
$stok = $_POST['stok'];
$deskripsi = $_POST['deskripsi_produk'];

$image_update = "";
$old_image_query = mysqli_query($db, "SELECT image_produk FROM tb_produk WHERE id_produk=$id");
$old_image = "";
if ($old_image_query && mysqli_num_rows($old_image_query) > 0) {
    $old_image = mysqli_fetch_assoc($old_image_query)['image_produk'];
}

if (isset($_FILES['image_produk']) && $_FILES['image_produk']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image_produk']['name'];
    $tmp = $_FILES['image_produk']['tmp_name'];
    move_uploaded_file($tmp, "../../img/produkImg/" . $image);


    if ($old_image && file_exists("../../img/produkImg/" . $old_image)) {
        unlink("../../img/produkImg/" . $old_image);
        var_dump($old_image);
    }

    $image_update = ", image_produk='$image'";
}

$sql = "UPDATE tb_produk SET nama_produk='$nama', harga_produk='$harga', stok='$stok',
        deskripsi_produk='$deskripsi' $image_update WHERE id_produk=$id";
mysqli_query($db, $sql);
header("Location: ../kelolaproduk/kelola-produk.php");
