<?php
include("../../konfig.php");

$nama_produk = $_POST['nama_produk'];
$harga_produk = $_POST['harga_produk'];
$stok = $_POST['stok'];
$deskripsi_produk = $_POST['deskripsi_produk'];
$image_produk = "";

if (isset($_FILES['image_produk']) && $_FILES['image_produk']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image_produk']['name'];
    $tmp = $_FILES['image_produk']['tmp_name'];
    $type = mime_content_type($tmp);

    if (!in_array($type, ['image/jpeg', 'image/png', 'image/gif'])) {
        echo "Format gambar tidak didukung.";
        exit;
    }

    $folder = "../../img/produkImg/";
    move_uploaded_file($tmp, $folder . $image);
    $image_produk = $image;
}

$sql = "INSERT INTO tb_produk (nama_produk, harga_produk, stok, deskripsi_produk, image_produk)
        VALUES ('$nama_produk', '$harga_produk', '$stok', '$deskripsi_produk', '$image_produk')";
mysqli_query($db, $sql);
header("Location: ../kelolaproduk/kelola-produk.php");
exit;
?>
