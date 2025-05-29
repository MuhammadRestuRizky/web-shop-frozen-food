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
        if ($jumlah < $jumlah_max_produk) {
            $jumlah += 1;
        }else{
            
            echo "<script>alert('Jumlah item tidak boleh lebih dari 10.');</script>";
            // mysqli_query($db, "DELETE FROM tb_keranjang WHERE id_keranjang = " . $data['id_keranjang']);
            header("Location: keranjang.php");
            exit;
        }
    } elseif ($aksi == 'kurang') {
        $jumlah -= 1;
        if ($jumlah < 1) {
            echo "<script>alert('Jumlah item tidak boleh kurang dari 1.');</script>";
            // mysqli_query($db, "DELETE FROM tb_keranjang WHERE id_keranjang = " . $data['id_keranjang']);
            header("Location: keranjang.php");
            exit;
        }
    }elseif($aksi == 'hapus') {
        mysqli_query($db, "DELETE FROM tb_keranjang WHERE id_keranjang = " . $id_keranjang);
        header("Location: keranjang.php");
        exit;
    }elseif($aksi=='hapussemua'){
        mysqli_query($db, "DELETE FROM tb_keranjang WHERE id_pembeli = " . $id_pembeli);
        header("Location: keranjang.php");
         
    }

    mysqli_query($db, "UPDATE tb_keranjang 
                         SET jumlah_item = '$jumlah' 
                         WHERE id_keranjang = " . $data['id_keranjang']);

header("Location: keranjang.php");
exit;
