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
  $sqlPesanan = "SELECT * FROM tb_pesanan WHERE id_pembeli = '$id_pembeli' ORDER BY tanggal_pesanan DESC";
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
      background: linear-gradient(to bottom, #96c5f7, white);
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

    .notification-icon {
      position: relative;
      font-size: 30px;
      cursor: pointer;
    }

    .notification-icon .badge {
      position: absolute;
      top: -8px;
      right: -8px;
      background: red;
      color: white;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 12px;
    }

    /* Dialog notifikasi */
    .notification-dialog {
      display: none;
      position: absolute;
      top: 35px;
      right: 0;
      background: white;
      border: 1px solid #ccc;
      width: 550px;
      z-index: 100;
      border-radius: 20px;
    }

    .notification-dialog.active {
      display: block;
    }

    .notification-dialog p {
      margin: 5px 0;
      font-size: 14px;
      font-weight: 400 !important;
    }

    .notification-container {
      position: relative;
      display: inline-block;
    }

    .head-notifikasi {
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
      padding: 20px 10px;
      background-color: #7CAEDF;
    }

    .notifikasi-content {
      padding: 10px;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../../global.css">
</head>

<body>
  <div class="grid grid-cols-12 h-vhfull">
    <?php include '../../component/sidebar-pembeli.php'; ?>
    <div class="col-span-10">
      <div class="right-container">
        <div class="head-container flex justify-between items-center">
          <h1 style="font-size: 50px;">Pesannan</h1>
          <h2>
            <div class="flex items-center">
              <?php
              $id_pembeli = $user['id_pembeli'];
              $sql = "SELECT * FROM tb_notifikasi 
                WHERE jenis_pengguna = 'pembeli' 
                AND id_pengguna = '$id_pembeli' 
                ORDER BY tgl_notifikasi DESC 
                LIMIT 10";
              $result = mysqli_query($db, $sql);

              // Hitung jumlah notifikasi
              $jumlahNotif = mysqli_num_rows($result);
              ?>
              <div class="notification-container">
                <i class="fas fa-bell notification-icon" id="notifIcon">
                  <span class="badge"><?= $jumlahNotif ?></span>
                </i>

                <div class="notification-dialog" id="notifDialog">
                  <div class="head-notifikasi">
                    <h2>Notifikasi</h2>
                  </div>
                  <div class="notifikasi-content">
                    <?php if ($jumlahNotif > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <small>
                          <p class="flex">
                            📩 <?= htmlspecialchars($row['deskripsi']) ?>
                            🕒 <?= date("d-m-Y H:i", strtotime($row['tgl_notifikasi'])) ?>
                          </p>
                        </small>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <p>Tidak ada notifikasi.</p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              &nbsp;
              &nbsp;
              &nbsp;
              &nbsp;
              <form action="../../proseslogoutpembeli.php" method="POST" style="display: inline;">
                <button type="submit" name="logout" class="flex items-center fw-semibold" style="background: none; border: none; color: inherit; cursor: pointer;font-size:16px;" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                  Logout&nbsp;
                  <span>
                    <i class="fas fa-sign-out-alt" style="font-size:20px;"></i>
                  </span>
                </button>
              </form>

            </div>
          </h2>
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
                    <h1>No <?php echo $no++; ?></h1>
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
      </div>
    </div>
  </div>
  <script>
    const icon = document.getElementById('notifIcon');
    const dialog = document.getElementById('notifDialog');

    icon.addEventListener('click', function() {
      dialog.classList.toggle('active');
    });

    // Optional: Klik di luar akan menutup dialog
    document.addEventListener('click', function(e) {
      if (!icon.contains(e.target) && !dialog.contains(e.target)) {
        dialog.classList.remove('active');
      }
    });
  </script>
</body>

</html>