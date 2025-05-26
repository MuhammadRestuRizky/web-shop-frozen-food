<?php
include("../../konfig.php");
session_start();
$username = $_SESSION['username'];
$sql = "SELECT * FROM tb_pembeli WHERE username = '$username'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
  $user = mysqli_fetch_assoc($query);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <!-- ini gw -->
  <title>Menu Maaaaaaaaaaaakanan</title>
  <style>
    html,
    body,
    * {

      margin: 0px;
      padding: 0px;
      box-sizing: border-box;
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
      /* background: linear-gradient(to bottom, #96c5f7, white); */
      /* background-color: #7CAEDF; */
      
    }

    
        .right-container {
          /* background-color: white; */
        }
    .container-product {
      /* height: ; */
      background: white;
      padding: 20px 40px;
    }

    .card-product {
      padding: 8px 8px 0px 8px;
      border-radius: 20px;
      /* height: 250px; */
      background-color: #d4d4d4;
    }

    .card-product img {
      height: 150px !important;
      width: 100%;
      height: auto;
      display: block;
      object-fit: contain;
    }

    .h-vhfull {
      height: 100vh;
    }


    .stok-button-parent {
      display: flex;
      align-items: center;
      gap: 5px;
      justify-content: center;
      margin-top: 10px;
    }

    .stok-button-parent button {
      width: 25px;
      height: 25px;
      font-size: 20px;
      font-weight: bold;

      background-color: #1677FF;
      color: #f1f1f1;
      border: none;
      border-radius: 100px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .stok-button-parent span {
      font-size: 20px;
      /* min-width: 1px; */
      text-align: center;
      display: inline-block;
    }

    .stok-value {
      font-weight: 600;
    }

    /* Icon notifikasi */
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

    .sticky-cart {
      position: fixed;
      bottom: 20px;
      right: 20px;
      font-size: 28px;
      padding: 15px 15px;
      border-radius: 50%;
      background-color: transparent;
      color: black;
      z-index: 1000;
      transition: transform 0.3s;
    }

    .sticky-cart:hover {
      transform: scale(1.1);
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
          <h1 style="font-size: 50px;">Beranda</h1>
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
        <div class="container-product">
          <?php
          $keyword = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';
          if ($keyword != '') {
            $sql_produk = "SELECT * FROM tb_produk WHERE 
                   nama_produk LIKE '%$keyword%' OR 
                   deskripsi_produk LIKE '%$keyword%'";
          } else {
            $sql_produk = "SELECT * FROM tb_produk";
          }
          $query_produk = mysqli_query($db, $sql_produk);
          ?>

          <div class="grid grid-cols-12 gap-4">
            <?php while ($produk = mysqli_fetch_assoc($query_produk)) : ?>
              <?php
              $id_pembeli = $user['id_pembeli'];
              $id_produk = $produk['id_produk'];

              // Cek apakah sudah di keranjang
              $sql_cek = "SELECT jumlah_item FROM tb_keranjang
                  WHERE id_pembeli = $id_pembeli 
                  AND id_produk = $id_produk";
              $cek_result = mysqli_query($db, $sql_cek);
              $row_qty = mysqli_fetch_assoc($cek_result);
              $qty = $row_qty['jumlah_item'] ?? 0;
              ?>

              <div class="col-span-2">
                <div class="card-product">
                  <img src="../../img/produkImg/<?= htmlspecialchars($produk['image_produk']) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>">
                  <p style="margin-bottom:8px;"><?= htmlspecialchars($produk['nama_produk']) ?></p>
                  <p>Rp. <?= number_format($produk['harga_produk'], 0, ',', '.') ?></p>
                  <div class="flex" style="justify-content: end;">
                    <div class="stok-button-parent">
                      <form method="POST" action="prosesdetailpesanan.php" style="display:inline">
                        <input type="hidden" name="id_produk" value="<?= $id_produk ?>">
                        <input type="hidden" name="aksi" value="kurang">
                        <button class="btn-decrease" <?= $qty <= 0 ? 'disabled' : '' ?>>-</button>
                      </form>

                      <span class="stok-value"><?= $qty ?></span>

                      <?php if ($qty < $produk['stok']): ?>
                        <form method="POST" action="prosesdetailpesanan.php" style="display:inline">
                          <input type="hidden" name="id_produk" value="<?= $id_produk ?>">
                          <input type="hidden" name="aksi" value="tambah">
                          <button class="btn-increase">+</button>
                        </form>
                        <?php else: ?>
                          <button class="btn-increase" disabled>+</button>
                          <?php endif; ?>
                        </div>
                      </div>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
        <?php if ($qty >=1 ): ?>
        <a href="../keranjang/keranjang.php" class="sticky-cart" title="Lihat Keranjang">
          <i class="fa fa-shopping-cart"></i>
        </a> 
        <?php else: ?>
          <?php endif; ?>
      </div>
    </div>
  </div>
</body>
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
  document.querySelectorAll('.card-product').forEach(card => {
    const btnIncrease = card.querySelector('.btn-increase');
    const btnDecrease = card.querySelector('.btn-decrease');
    const stokValue = card.querySelector('.stok-value');

    btnIncrease.addEventListener('click', () => {
      let current = parseInt(stokValue.textContent);
      stokValue.textContent = current + 1;
    });

    btnDecrease.addEventListener('click', () => {
      let current = parseInt(stokValue.textContent);
      if (current > 0) {
        stokValue.textContent = current - 1;
      }
    });
  });
</script>

</html>