<?php
include '../konfig.php';
session_start();
$current_page = basename($_SERVER['PHP_SELF']);
$redirect = $_POST['redirect_to'] ?? 'kelola-produk.php'; 
$aksi = $_POST['aksi'] ?? '';
if ($aksi == 'hapussemuanotif') {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM tb_pembeli WHERE username = '$username'";
    $query = mysqli_query($db, $sql);
    if ($query && mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
    }
    $nama_user = $user['username'] ?? '';
    $id_pembeli = $user['id_pembeli'] ?? ''; 
    mysqli_query($db, "DELETE FROM tb_notifikasi WHERE jenis_pengguna='pembeli' AND id_pengguna = " . $id_pembeli);  
}
if ($aksi == 'hapussemuanotifadmin') {
    $nama_kasir = $_SESSION['nama_kasir'];
    $sql = "SELECT * FROM tb_adminkasir WHERE nama_kasir = '$nama_kasir'";
    $query = mysqli_query($db, $sql);
    if ($query && mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
    }
    $nama_user = $user['nama_kasir'] ?? '';
    $id_adminkasir = $user['id_adminkasir'] ?? ''; 
    mysqli_query($db, "DELETE FROM tb_notifikasi  WHERE jenis_pengguna='adminkasir' AND id_pengguna = " . $id_adminkasir); 
}
// var_dump($aksi);
header("Location: $redirect");
