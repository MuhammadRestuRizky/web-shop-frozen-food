<?php
include("../../konfig.php");
session_start();
$username = $_SESSION['username'];
$sqlUser = "SELECT * FROM tb_pembeli WHERE username = '$username'";
$queryUser = mysqli_query($db, $sqlUser);
if ($queryUser && mysqli_num_rows($queryUser) > 0) {
  $user = mysqli_fetch_assoc($queryUser);
  $id_pembeli = $user['id_pembeli'];

  // Ambil semua pesanan pembeli ini
  $cari = isset($_GET['cari']) ? mysqli_real_escape_string($db, $_GET['cari']) : '';

  if (!empty($cari)) {

    $sqlPesanan = "SELECT * FROM tb_pesanan WHERE id_pembeli = '$id_pembeli' AND status='Menunggu' AND id_pesanan LIKE '%$cari%' ORDER BY tanggal_pesanan DESC";
  } else {

    $sqlPesanan = "SELECT * FROM tb_pesanan WHERE id_pembeli = '$id_pembeli' AND status='Menunggu' ORDER BY tanggal_pesanan DESC";
  }
  $queryPesanan = mysqli_query($db, $sqlPesanan);
} else {
  $queryPesanan = false;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <title>Menu Makanan</title>

  <style>
    html,
    body,
    * {

      margin: 0px;
      padding: 0px;
      box-sizing: border-box;
    }

    p {
      margin-bottom: 4px;
    }

    body {
      font-family: Arial, sans-serif;
    }

    .container {
      padding: 16px;
    }

    .head-container {
      padding: 20px 40px;
    }

    .container-pesaanan {
      background: white;
      padding: 20px 40px;
    }

    .h-vhfull {
      height: 100vh;
    }

    .pesanan-card-parent {}

    .pesanan-number>h1 {
      font-weight: 400;
      padding: 10px;
      display: inline;
      border-top-left-radius: 16px;
      border-top-right-radius: 16px;
      width: 100%;
      background-color: #E7E5E5;
    }

    .pesanan-card {
      background-color: #E7E5E5;
      border-radius: 16px;
      padding: 10px;
    }

    .head-pesanan-card {
      text-align: center;
    }

    .items-data-pesanan {
      padding: 10px 0px;
    }
     .sticky-maps {
      position: fixed;
      bottom: 20px;
      right: 20px;
      font-size: 46px;
      padding: 15px 15px;
      border-radius: 50%;
      background-color: transparent;
      color: black;
      z-index: 1000;
      transition: transform 0.3s;
    }

    .sticky-maps:hover {
      transform: scale(1.1);
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../../global.css">
</head>

<body>
  <div class="grid grid-cols-12 h-vhfull">
    <div class="col-span-12">
      <?php include '../../component/navbar-pembeli.php'; ?>
      <div class="head-container flex justify-start items-center">
        <i onclick="window.history.back()" class="fa-solid fa-chevron-left" style="font-size: 40px;"></i>
        &nbsp;
        &nbsp;
        <h1 style="font-size: 50px;">Pesanan</h1>
      </div>

      <div class="container-pesaanan">
        <div class="grid grid-cols-12 gap-4">

          <?php if ($queryPesanan && mysqli_num_rows($queryPesanan) > 0) : ?>
            <?php
            $no = 1;
            while ($pesanan = mysqli_fetch_assoc($queryPesanan)) :

              // Misal: ambil produk pesanan dari tabel detail pesanan
              $id_pesanan = $pesanan['id_pesanan'];
              $sqlDetail = "SELECT produk.nama_produk, detail.jumlah_item, produk.harga_produk FROM tb_detailpesanan detail
                                              JOIN tb_produk produk ON detail.id_produk = produk.id_produk
                                              WHERE detail.id_pesanan = '$id_pesanan'";
              $queryDetail = mysqli_query($db, $sqlDetail);


              $subtotalHitung = 0;
            ?>
              <div class="col-span-4 pesanan-card-parent">
                <div class="pesanan-number">
                  <h1>No <?= $id_pesanan; ?></h1>
                </div>
                <div class="pesanan-card">
                  <div class="head-pesanan-card ">
                    <p>Jl. Es Batu No.45 Indramayu</p>
                    <p>No Telpon : <?php echo $user['no_telpon']; ?></p>
                    <p>Tanggal Pesanan : <?php echo date('d-m-Y', strtotime($pesanan['tanggal_pesanan'])); ?></p>
                    <hr style="margin: 10px 0px;">
                  </div>
                  <div class="pembeli-pesanan-card">
                    <p>Pembeli : <?php echo htmlspecialchars($user['username']); ?></p>
                    <p>No Pesanan : <?php echo $pesanan['id_pesanan']; ?></p>
                    <p>Tanggal Pesanan : <?php echo date('d M Y', strtotime($pesanan['tanggal_pesanan'])); ?></p>
                    <p>Ambil Pesanan di : <?php echo htmlspecialchars($user['alamat'] ?? 'asdadas'); ?></p>
                  </div>
                  <hr style="margin: 10px 0px;">
                  <div class="item-pesanan-card">
                    <div class="items-data-judul flex justify-between items-center gap-4">
                      <p>Nama produk:</p>
                      <p>Harga:</p>
                      <p>Jumlah:</p>
                      <p>Total:</p>
                    </div>
                    <hr style="margin: 10px 0px; ">

                    <?php
                    if ($queryDetail && mysqli_num_rows($queryDetail) > 0) :
                      while ($detail = mysqli_fetch_assoc($queryDetail)) :
                        $totalItem = $detail['harga_produk'] * $detail['jumlah_item'];
                        $subtotalHitung += $totalItem;
                    ?>
                        <div class="items-data-pesanan flex justify-between items-center gap-4">
                          <p><?php echo htmlspecialchars($detail['nama_produk']); ?></p>
                          <p>Rp.<?php echo number_format($detail['harga_produk'], 0, ',', '.'); ?></p>
                          <p><?php echo $detail['jumlah_item']; ?></p>
                          <p>Rp.<?php echo number_format($totalItem, 0, ',', '.'); ?></p>
                        </div>
                    <?php
                      endwhile;
                    endif;
                    ?>

                  </div>
                  <br><br><br><br><br>
                  <div class="footer-card-pesanan">
                    <hr style="margin: 10px 0; border: 1px solid #999999;">
                    <div class="flex justify-between items-center">
                      <p>Subtotal: </p>
                      <p>Rp.<?php echo number_format($pesanan['subtotal'], 0, ',', '.'); ?></p>
                    </div>
                    <hr style="margin: 10px 0px;height:4px; ">
                    <p>Status Pesanan: <?php echo htmlspecialchars($pesanan['status']); ?></p>
                    <p>Terima Kasih & Sampai Jumpa!</p>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
          <?php else : ?>
            <p>Belum ada pesanan.</p>
          <?php endif; ?>

        </div>
      </div>
       <?php if ($queryPesanan && mysqli_num_rows($queryPesanan) > 0): ?>
        <a href="../maps/maps.php" class="sticky-maps" title="Lihat Keranjang">
          <i class="fa fa-map"></i>
        </a>
      <?php else: ?>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>