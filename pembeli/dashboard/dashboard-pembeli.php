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
    }

    .container {
      padding: 16px;
    }

    .head-container {
      padding: 10px 40px; 

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
      font-size: 46px;
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

    .modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 999;
}

.modal-box {
  background-color: white;
  border-radius: 10px;
  padding: 20px;
  width: 600px;
  max-width: 90%;
  position: relative;
}

.modal-image {
  width: 100%;
  height: 200px;
  object-fit: contain;
  margin-bottom: 15px;
}

.close-button {
  position: absolute;
  top: 10px;
  right: 15px;
  color: red;
  font-size: 24px;
  text-decoration: none;
}

  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../../global.css">
</head>

<body>
  <div class="grid grid-cols-12 h-vhfull">

    <div class="col-span-12">
      <?php include '../../component/navbar-pembeli.php'; ?>
      <div class="head-container flex justify-between items-center">
        <h1 style="font-size: 50px;">Beranda</h1> 
      </div>
      <div class="container-product">
        <?php
        $keyword = isset($_GET['cari']) ? mysqli_real_escape_string($db, $_GET['cari']) : '';
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
          <?php
$produk_detail = null;
if (isset($_GET['detail'])) {
  $id_detail_produk = (int)$_GET['detail'];
  $sqlDetailProduk = "SELECT * FROM tb_produk WHERE id_produk = $id_detail_produk";
  $queryDetail = mysqli_query($db, $sqlDetailProduk);
  if ($queryDetail && mysqli_num_rows($queryDetail) > 0) {
    $produk_detail = mysqli_fetch_assoc($queryDetail);
  }
}

?>

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
  <?php if ($produk_detail): ?>
  <div class="modal-overlay "  onclick="closeModal(event)">
    <div class="modal-box">
      <br>
      <h2>Detail produk</h2>
      <br>
      <a href="dashboard-pembeli.php" class="close-button">
        <i class="fa fa-times" style="font-size: 30px;color:black;"></i>
      </a>
      <img src="../../img/produkImg/<?= htmlspecialchars($produk_detail['image_produk']) ?>" class="modal-image">
      <h2><?= htmlspecialchars($produk_detail['nama_produk']) ?></h2>
      <p><?= htmlspecialchars($produk_detail['deskripsi_produk']) ?></p>
      <p style="font-weight: bold;">Rp. <?= number_format($produk_detail['harga_produk'], 0, ',', '.') ?></p>
    </div>
  </div>
<?php endif; ?>


              <div class="card-product" onclick="window.location.href='?detail=<?= $produk['id_produk'] ?>'" >
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
      <?php if ($qty??0 >= 1): ?>
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
      function closeModal(event) {
      // Cek apakah yang diklik adalah overlay (bukan isi modal)
      if (event.target.classList.contains('modal-overlay')) {
        window.location.href = 'dashboard-pembeli.php';
      }
    }

</script>

</html>