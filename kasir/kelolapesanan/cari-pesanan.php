<?php
include("../../konfig.php");

if (isset($_GET['cari'])) {
    $id_pesanan = mysqli_real_escape_string($db, $_GET['cari']);

    $sql = "SELECT p.*, pb.username, pb.no_telpon 
            FROM tb_pesanan p 
            LEFT JOIN tb_pembeli pb ON p.id_pembeli = pb.id_pembeli
            WHERE p.id_pesanan = '$id_pesanan' AND p.status = 'Menunggu'";
    $result = mysqli_query($db, $sql);

    // tampilkan hasil seperti di kelola_pesanan.php
} else {
    echo "Masukkan ID Pesanan untuk mencari.";
}
