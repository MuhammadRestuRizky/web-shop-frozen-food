<?php
include("../../konfig.php");
session_start();
$id_pesanan = $_POST['id_pesanan'];
$nama_kasir = $_SESSION['nama_kasir'];
$sql = "SELECT * FROM tb_adminkasir WHERE nama_kasir = '$nama_kasir'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
    $user = mysqli_fetch_assoc($query);
} 

$sql_detail = "SELECT * FROM tb_pesanan WHERE id_pesanan = '$id_pesanan'";
$query_detail = mysqli_query($db, $sql_detail);
$row = mysqli_fetch_assoc($query_detail);
// var_dump($id_pesanan);
$id_pengguna = $row['id_pembeli'];
// var_dump($id_pengguna);
$sql_detail = "SELECT * FROM tb_detailpesanan WHERE id_pesanan = '$id_pesanan'";
$query_detail = mysqli_query($db, $sql_detail);
while ($row = mysqli_fetch_assoc($query_detail)) {
    $id_produk = $row['id_produk'];
    $jumlah = $row['jumlah_item'];
    // Kembalikan stok
    mysqli_query($db, "UPDATE tb_produk SET stok = stok + $jumlah WHERE id_produk = '$id_produk'");
}

// var_dump($nama_kasir);
$nama_kasirUser = $user['nama_kasir'];
$notfikasiQuery = "INSERT INTO tb_notifikasi (id_pesanan, id_pengguna, jenis_pengguna, tgl_notifikasi, deskripsi) values (NULL, '$id_pengguna', 'adminkasir', NOW(), 'Pesanan dengan ID $id_pesanan telah dibatalkan')";
mysqli_query($db, $notfikasiQuery);
$notfikasiQueryPembeli = "INSERT INTO tb_notifikasi (id_pesanan, id_pengguna, jenis_pengguna, tgl_notifikasi, deskripsi) values (NULL, '$id_pengguna', 'pembeli', NOW(), 'Pesanan dengan ID $id_pesanan telah dibatalkan oleh kasir $nama_kasirUser')";
mysqli_query($db, $notfikasiQueryPembeli);
mysqli_query($db, "DELETE FROM tb_detailpesanan WHERE id_pesanan = '$id_pesanan'");
mysqli_query($db, "DELETE FROM tb_pesanan WHERE id_pesanan = '$id_pesanan'");

header("Location: kelola-pesanan.php");
