<?php
session_start();
include '../../konfig.php'; // pastikan path-nya benar

// if (!isset($_SESSION['user'])) {
//   header('Location: ../login.php');
//   exit();
// }

$usernamePembeli = $_SESSION['username'];
$sqlPembeli = "SELECT * FROM tb_pembeli WHERE username = '$usernamePembeli'";
$query = mysqli_query($db, $sqlPembeli);
if ($query && mysqli_num_rows($query) > 0) {
  $user = mysqli_fetch_assoc($query);
}
$id_pembeli=$user['id_pembeli'];
$id_produk = isset($_POST['id_produk']) ? (int)$_POST['id_produk'] : 0;
$aksi = isset($_POST['aksi']) ? $_POST['aksi'] : '';

if ($id_produk <= 0 || ($aksi !== 'tambah' && $aksi !== 'kurang')) {
  header('Location: ../dashboard/dashboard-pembeli.php');
  exit();
}

// Cek apakah produk sudah ada di keranjang (id_pesanan masih NULL)
$sql_cek = "SELECT * FROM tb_keranjang 
            WHERE id_pembeli = $id_pembeli 
            AND id_produk = $id_produk ";
$result_cek = mysqli_query($db, $sql_cek);
$data = mysqli_fetch_assoc($result_cek);

if ($aksi === 'tambah') {
  if ($data) {
    // Sudah ada, tambahkan jumlah
    $jumlah_baru = $data['jumlah_item'] + 1;
    $sql_update = "UPDATE tb_keranjang 
                   SET jumlah_item = $jumlah_baru 
                   WHERE id_keranjang = " . $data['id_keranjang'];
    mysqli_query($db, $sql_update);
  } else {
    // Belum ada, tambahkan baris baru
    $sql_insert = "INSERT INTO tb_keranjang (id_pembeli, id_produk, jumlah_item) 
                   VALUES ($id_pembeli, $id_produk, 1)";
    mysqli_query($db, $sql_insert);
  }
} elseif ($aksi === 'kurang') {
  if ($data) {
    $jumlah_baru = $data['jumlah_item'] - 1;
    if ($jumlah_baru <= 0) {
      // Hapus jika jumlah jadi 0
      $sql_delete = "DELETE FROM tb_keranjang WHERE id_keranjang = " . $data['id_keranjang'];
      mysqli_query($db, $sql_delete);
    } else {
      // Update jumlah
      $sql_update = "UPDATE tb_keranjang 
                     SET jumlah_item = $jumlah_baru 
                     WHERE id_keranjang = " . $data['id_keranjang'];
      mysqli_query($db, $sql_update);
    }
  }
}

// Redirect kembali ke halaman sebelumnya
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
