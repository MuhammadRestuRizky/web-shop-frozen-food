<?php
include("../../konfig.php");
$id = $_POST['id_produk'];
$nama = $_POST['nama_produk'];
$harga = $_POST['harga_produk'];
$stok = $_POST['stok'];
$deskripsi = $_POST['deskripsi_produk'];

$image_update = "";
if (isset($_FILES['image_produk']) && $_FILES['image_produk']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image_produk']['name'];
    $tmp = $_FILES['image_produk']['tmp_name'];
    move_uploaded_file($tmp, "../../img/produk/" . $image);
    $image_update = ", image_produk='$image'";
}

$sql = "UPDATE tb_produk SET nama_produk='$nama', harga_produk='$harga', stok='$stok',
        deskripsi_produk='$deskripsi' $image_update WHERE id_produk=$id";
mysqli_query($db, $sql);
header("Location: ../kelolaproduk/kelola-produk.php");
exit;
?>
