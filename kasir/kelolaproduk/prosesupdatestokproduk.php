<?php
include '../../konfig.php';
session_start();

  $usernamePembeli = $_SESSION['username'];
    $sqlPembeli = "SELECT * FROM tb_pembeli WHERE username = '$usernamePembeli'";
    $query = mysqli_query($db, $sqlPembeli);
    if ($query && mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
    }
    $id_pembeli = $user['id_pembeli'];
$id_produk = $_POST['id_produk'];
$id_keranjang = $_POST['id_keranjang'];
$aksi = $_POST['aksi'];
$jumlah_max_produk = $_POST['jumlah_max_produk'];
 
$query = "SELECT * FROM tb_keranjang 
          WHERE id_pembeli = '$id_pembeli' 
            AND id_produk = '$id_produk' ";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $jumlah = $data['jumlah_item'];

}  
  
if ($aksi == 'tambah') {
    $sqlUpdateStok = "UPDATE tb_produk 
                    SET stok = stok + 1 
                    WHERE id_produk = '$id_produk'";
}
if ($aksi == 'kurang') {
    $sqlUpdateStok = "UPDATE tb_produk 
                    SET stok = stok - 1 
                    WHERE id_produk = '$id_produk'";
}

    mysqli_query($db, $sqlUpdateStok);

header("Location: kelola-produk.php");
exit;
