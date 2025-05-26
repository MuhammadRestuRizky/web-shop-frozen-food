<?php
include("../../konfig.php");
session_start();
$username = $_SESSION['username'];
$sql = "SELECT * FROM tb_pembeli WHERE username = '$username'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
  $user = mysqli_fetch_assoc($query);

}
$sql_toko = "SELECT nama_toko, alamat FROM tb_adminkasir WHERE id_adminkasir = 1 LIMIT 1";
$result_toko = mysqli_query($db, $sql_toko);
$toko = mysqli_fetch_assoc($result_toko);
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
    }
    
    .container-maps {
      background: white;
      padding: 20px 40px;
    }
  

    .h-vhfull {
      height: 100vh;
    }
    .maps-teks> h3,h2{
        font-weight: 400;
    }
    .link-maps > a{
        /* font-size: 20px; */
        font-weight: 400;
        color: #2a8df4;
        text-decoration: none;
    }
    .fw-regular{
        font-weight: 400;
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

    <?php include '../../component/sidebar-pembeli.php';?>
    <div class="col-span-10">
      <div class="right-container">
           <div class="head-container flex justify-between items-center">
          <h1 style="font-size: 50px;">Maps</h1>
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
        <div class="container-maps">
        <div class="card-maps">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-5">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.80746596270092!2d108.28196041490119!3d-6.404378023913158!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6eb9003cad8eb7%3A0x510a49f3cb668dda!2sBC%20ngeteh%20anget!5e0!3m2!1sid!2sid!4v1748057823807!5m2!1sid!2sid" width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-span-7 flex items-center justify-start">
                    <div class="maps-teks">
                       <h3>Nama toko: </h3>
<h2><?= htmlspecialchars($toko['nama_toko'] ?? 'Nama toko tidak tersedia') ?></h2>
<br>
<br>
<br>
<br>
<br>
<br>
<h3>Alamat: </h3>
<h2><?= htmlspecialchars($toko['alamat'] ?? 'Alamat tidak tersedia') ?></h2>

                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <h3 class="fw-regular">Link Maps: </h3>
            <h2 class="link-maps">
                <a  href="https://maps.app.goo.gl/BBTVm6PQB7AHgTE49" target="_blank">https://maps.app.goo.gl/BBTVm6PQB7AHgTE49</a>
            </h2>
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