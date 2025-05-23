<?php
// Sementara kita pakai data dummy (tanpa database)
session_start();

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [
        ['kode' => '001', 'nama' => 'Crabstick', 'harga' => 17000, 'jumlah' => 2, 'gambar' => 'crabstick.jpg'],
        ['kode' => '002', 'nama' => 'Scallop', 'harga' => 25000, 'jumlah' => 3, 'gambar' => 'scallop.jpg'],
        ['kode' => '003', 'nama' => 'Nugget', 'harga' => 21000, 'jumlah' => 2, 'gambar' => 'nugget.jpg'],
        ['kode' => '004', 'nama' => 'Fishroll', 'harga' => 13000, 'jumlah' => 2, 'gambar' => 'fishroll.jpg'],
        ['kode' => '005', 'nama' => 'otak-otak', 'harga' => 12000, 'jumlah' => 2, 'gambar' => 'otakotak.jpg'],
        ['kode' => '006', 'nama' => 'Smoked Beef', 'harga' => 35000, 'jumlah' => 2, 'gambar' => 'smokedbeef.jpg'],
        ['kode' => '007', 'nama' => 'Chikuwa Mini', 'harga' => 26000, 'jumlah' => 2, 'gambar' => 'chikuwa.jpg'],
    ];
}
?>
