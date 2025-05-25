<?php
include("../../konfig.php");
session_start();
$id_pesanan = $_POST['id_pesanan'];

$sql_detail = "SELECT * FROM tb_pesanan WHERE id_pesanan = '$id_pesanan'";
$query_detail = mysqli_query($db, $sql_detail);
$row = mysqli_fetch_assoc($query_detail);
$id_pengguna = $row['id_pembeli']; 
// Ambil data admin kasir
$nama_kasir = $_SESSION['nama_kasir'];
$sql = "SELECT * FROM tb_adminkasir WHERE nama_kasir = '$nama_kasir'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
    $user = mysqli_fetch_assoc($query);
} else {
}
// var_dump($id_pengguna);
$nama_kasir = $user['nama_kasir'];
$updateStatus = "UPDATE tb_pesanan SET status = 'Menunggu' WHERE id_pesanan = '$id_pesanan'";
mysqli_query($db, $updateStatus);

$notfikasiQuery = "INSERT INTO tb_notifikasi (id_pesanan, id_pengguna, jenis_pengguna, tgl_notifikasi, deskripsi) values ('$id_pesanan', '$id_pengguna', 'adminkasir', NOW(), 'Pesanan dengan ID $id_pesanan telah dicetak')";
mysqli_query($db, $notfikasiQuery);
$notfikasiQueryPembeli = "INSERT INTO tb_notifikasi (id_pesanan, id_pengguna, jenis_pengguna, tgl_notifikasi, deskripsi) values ('$id_pesanan', '$id_pengguna', 'pembeli', NOW(), 'Pesanan dengan ID $id_pesanan telah dicetak oleh kasir $nama_kasir')";
mysqli_query($db, $notfikasiQueryPembeli); 

header("Location: kelola-pesanan.php");
