<?php
session_start();
include '../../konfig.php';

if (isset($_POST['submit_order'])) {

    $usernamePembeli = $_SESSION['username'];
    $sqlPembeli = "SELECT * FROM tb_pembeli WHERE username = '$usernamePembeli'";
    $query = mysqli_query($db, $sqlPembeli);
    if ($query && mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
    } else {
        die("Pembeli tidak ditemukan.");
    }

    $id_pembeli = $user['id_pembeli'];
    $tanggal = date('Y-m-d');

    // Ambil ringkasan keranjang
    $sql = "SELECT 
                COUNT(DISTINCT k.id_produk) AS jumlah_produk,
                SUM(k.jumlah_item) AS jumlah_item,
                SUM(k.jumlah_item * p.harga_produk) AS subtotal
            FROM tb_keranjang k
            JOIN tb_produk p ON k.id_produk = p.id_produk
            WHERE k.id_pembeli = '$id_pembeli'";

    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);

    $jumlah_produk = $row['jumlah_produk'];
    $jumlah_item = $row['jumlah_item'];
    $subtotal = $row['subtotal'];

    // Buat pesanan baru
    $insert = "INSERT INTO tb_pesanan (id_pembeli, jumlah_produk, jumlah_item, tanggal_pesanan, subtotal, status)
               VALUES ('$id_pembeli', '$jumlah_produk', '$jumlah_item', '$tanggal', '$subtotal', 'menunggu')";

    if (mysqli_query($db, $insert)) {
        $id_pesanan_baru = mysqli_insert_id($db);

        // Ambil semua item keranjang pembeli
        $sql_keranjang = "SELECT * FROM tb_keranjang WHERE id_pembeli = '$id_pembeli'";
        $result_keranjang = mysqli_query($db, $sql_keranjang);

        $sukses_detail = true;

        while ($keranjang = mysqli_fetch_assoc($result_keranjang)) {
            $id_produk = $keranjang['id_produk'];
            $jumlah_item = $keranjang['jumlah_item'];

            $insert_detail = "INSERT INTO tb_detailpesanan (id_pesanan, id_pembeli, id_produk, jumlah_item)
                              VALUES ('$id_pesanan_baru', '$id_pembeli', '$id_produk', '$jumlah_item')";
            $updateProduk="UPDATE tb_produk 
                           SET stok = stok - $jumlah_item 
                           WHERE id_produk = '$id_produk'";
            mysqli_query($db, $updateProduk);
            if (!mysqli_query($db, $insert_detail)) {
                $sukses_detail = false;
                break;
            }
        }

        if ($sukses_detail) {
            $id_pengguna = $user['id_pembeli'];
            $nama_pembeli= htmlspecialchars($user['username']);
            $notfikasiQuery = "INSERT INTO tb_notifikasi (id_pesanan, id_pengguna, jenis_pengguna, tgl_notifikasi, deskripsi) values ($id_pesanan_baru, '$id_pengguna', 'adminkasir', NOW(), 'Pembeli bernama $nama_pembeli mengajukan pesanan')";
mysqli_query($db, $notfikasiQuery);
            $notfikasiQueryPembeli = "INSERT INTO tb_notifikasi (id_pesanan, id_pengguna, jenis_pengguna, tgl_notifikasi, deskripsi) values ($id_pesanan_baru, '$id_pengguna', 'pembeli', NOW(), 'Pesanan anda sudah terkirim mohon menunggu')";
mysqli_query($db, $notfikasiQueryPembeli);
            $hapus_keranjang = "DELETE FROM tb_keranjang WHERE id_pembeli = '$id_pembeli'";
            mysqli_query($db, $hapus_keranjang);

            header("Location: keranjang.php?pesan=pesanan_berhasil");
            exit;
        } else {
            echo "Gagal menyimpan detail pesanan.";
        }

    } else {
        echo "Gagal menyimpan pesanan: " . mysqli_error($db);
    }
}
?>
