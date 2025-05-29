<?php
include("../../konfig.php");
session_start();
// require_once __DIR__ . '/libs/mpdf/vendor/autoload.php';
require_once __DIR__ . '/../../vendor/autoload.php'; // sesuaikan path ke folder vendor
$id_pesanan = $_POST['id_pesanan'];

$sql_detail = "SELECT * FROM tb_pesanan WHERE id_pesanan = '$id_pesanan'";
$query_detail = mysqli_query($db, $sql_detail);
$row = mysqli_fetch_assoc($query_detail);
$id_pengguna = $row['id_pembeli'];
// Ambil data admin kasir
$sql = "SELECT * FROM tb_pembeli WHERE id_pembeli= '$id_pengguna'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
    $user = mysqli_fetch_assoc($query);
} else {
}
$nama_kasir = $_SESSION['nama_kasir'];
$sqlKasir = "SELECT * FROM tb_adminkasir WHERE nama_kasir= '$nama_kasir'";
$queryKasir = mysqli_query($db, $sqlKasir);
if ($query && mysqli_num_rows($queryKasir) > 0) {
    $userAdmin = mysqli_fetch_assoc($queryKasir);
} else {
}

$pesananQuery = "SELECT * FROM tb_pesanan WHERE id_pesanan = '$id_pesanan'";
$pesananResult = mysqli_query($db, $pesananQuery);
$pesanan = mysqli_fetch_assoc($pesananResult);
// var_dump($pesanan);
// exit;
$mpdf = new \Mpdf\Mpdf([
    'format' => [100, 200],
    'margin_left' => 5,
    'margin_right' => 5,
    'margin_top' => 5,
    'margin_bottom' => 5,
]);
$html = '<div class="pesanan-list">';

$id_pesanan = $pesanan['id_pesanan'];
$sqlDetail = "SELECT produk.nama_produk, detail.jumlah_item, produk.harga_produk FROM tb_detailpesanan detail
                      JOIN tb_produk produk ON detail.id_produk = produk.id_produk
                      WHERE detail.id_pesanan = '$id_pesanan'";
$queryDetail = mysqli_query($db, $sqlDetail);

$subtotalHitung = 0;
$html .= '<div class="pesanan-card-parent">';
$html .= '<div class="pesanan-card">';

// Header Pesanan (Alamat, No Telpon, Tanggal)
$html .= '<div class="head-pesanan-card" style="text-align:center;">';
$html .= '<div style="font-size:14px;">' . htmlspecialchars($userAdmin['alamat']) . '</div>';
$html .= '<div style="font-size:14px;">No Telpon : ' . htmlspecialchars($user['no_telpon']) . '</div>';
$html .= '<div style="font-size:14px;">Tanggal Pesanan : ' . date('d-m-Y', strtotime($pesanan['tanggal_pesanan'])) . '</div>';
$html .= '<hr>';
$html .= '</div>';

// Info Pembeli
$html .= '<div class="pembeli-pesanan-card">';
$html .= '<div style="font-size:14px;">Pembeli : ' . htmlspecialchars($user['username']) . '</div>';
$html .= '<div style="font-size:14px;">No Pesanan : ' . $pesanan['id_pesanan'] . '</div>';
$html .= '<div style="font-size:14px;">Tanggal Pesanan : ' . date('d M Y', strtotime($pesanan['tanggal_pesanan'])) . '</div>';
$html .= '<div style="font-size:14px;">Ambil Pesanan di : ' . htmlspecialchars($userAdmin['alamat']) . '</div>';
$html .= '</div>';

$html .= '<hr>';

// Daftar Produk
$html .= '<div class="item-pesanan-card">';
$html .= '<table width="100%" style="border-collapse: collapse; font-size:14px;">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<td style="text-align:left; padding:5px;">Nama produk</td>';
$html .= '<td style="text-align:right; padding:5px;">Harga</td>';
$html .= '<td style="text-align:center; padding:5px;">Jumlah</td>';
$html .= '<td style="text-align:right; padding:5px;">Total</td>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tr>';
$html .= '<td colspan="4" style="text-align:center; padding:5px;">';
$html .= '<hr>';
$html .= '</td>';
$html .= '<tr>';

$html .= '<tbody>';

if ($queryDetail && mysqli_num_rows($queryDetail) > 0) {
    while ($detail = mysqli_fetch_assoc($queryDetail)) {
        $totalItem = $detail['harga_produk'] * $detail['jumlah_item'];
        $subtotalHitung += $totalItem;

        $html .= '<tr>';
        $html .= '<td style="padding:5px;">' . htmlspecialchars($detail['nama_produk']) . '</td>';
        $html .= '<td style="text-align:right; padding:5px;">Rp.' . number_format($detail['harga_produk'], 2, ',', '.') . '</td>';
        $html .= '<td style="text-align:center; padding:5px;">' . $detail['jumlah_item'] . '</td>';
        $html .= '<td style="text-align:right; padding:5px;">Rp.' . number_format($totalItem, 2, ',', '.') . '</td>';
        $html .= '</tr>';
    }
}

$html .= '</tbody>';
$html .= '</table>';
$html .= '</div>'; // item-pesanan-card

$html .= '<br><br><br><br><br>';

// Footer subtotal dan status
$html .= '<div class="footer-card-pesanan" style="font-size:14px;">';
$html .= '<hr style="margin: 10px 0; border: 1px solid #999999;">';

$html .= '<table width="100%" style="border-collapse: collapse;">';
$html .= '<tr>';
$html .= '<td style="text-align: left; padding:5px;">Subtotal:</td>';
$html .= '<td style="text-align: right; padding:5px;">Rp.' . number_format($pesanan['subtotal'], 0, ',', '.') . '</td>';
$html .= '</tr>';
$html .= '</table>';

$html .= '<hr style="height:4px;">';

$html .= '<div>Status Pesanan: ' . htmlspecialchars($pesanan['status']) . '</div>';
$html .= '<p style="text-align:center;">Terima Kasih & Sampai Jumpa!</p>';
$html .= '</div>'; // footer-card-pesanan

$html .= '</div>'; // pesanan-card
$html .= '</div>'; // pesanan-card-parent


$mpdf->WriteHTML($html);

// Simpan PDF ke folder
$nama_file = "nota_pesanan_$id_pesanan.pdf";
$path = "../../nota_pdf/" . $nama_file;

$mpdf->Output($path, 'D'); 
// mysqli_query($db, "UPDATE tb_pesanan SET file_nota = '$nama_file' WHERE id_pesanan = '$id_pesanan'");

// Redirect




// var_dump($id_pengguna);
$nama_kasir = $user['nama_kasir'];
$updateStatus = "UPDATE tb_pesanan SET status = 'Dicetak' WHERE id_pesanan = '$id_pesanan'";
mysqli_query($db, $updateStatus);

$notfikasiQuery = "INSERT INTO tb_notifikasi (id_pesanan, id_pengguna, jenis_pengguna, tgl_notifikasi, deskripsi) values ('$id_pesanan', '$id_pengguna', 'adminkasir', NOW(), 'Pesanan dengan ID $id_pesanan telah dicetak')";
mysqli_query($db, $notfikasiQuery);
$notfikasiQueryPembeli = "INSERT INTO tb_notifikasi (id_pesanan, id_pengguna, jenis_pengguna, tgl_notifikasi, deskripsi) values ('$id_pesanan', '$id_pengguna', 'pembeli', NOW(), 'Pesanan dengan ID $id_pesanan telah dicetak oleh kasir $nama_kasir')";
mysqli_query($db, $notfikasiQueryPembeli);

header("Location: kelola-pesanan.php");
