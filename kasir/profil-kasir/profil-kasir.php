<?php
include("../../konfig.php");
session_start();
$nama_kasir = $_SESSION['nama_kasir'];
$sql = "SELECT * FROM tb_adminkasir WHERE nama_kasir = '$nama_kasir'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
  $user = mysqli_fetch_assoc($query);
}
$editMode = isset($_GET['edit']) && $_GET['edit'] == '1';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <title>Profil Kasir</title>
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

    .container-profil {
      background: white;
      padding: 20px 40px;
    }

    .h-vhfull {
      height: 100vh;
    }

    .img-profil img {
      width: 200px;
      height: 200px;
      border-radius: 16px;
      object-fit: cover;
    }

    .judul-teks {
      color: gray;
    }

    .grup-text {
      margin-top: 10px;
    }

    .data-profil-teks {
      font-weight: 400;
    }

    .btn-edit {
      background-color: #2a8df4;
      color: white;
      border: none;
      padding: 10px 16px;
      border-radius: 8px;
      cursor: pointer;
    }

    .btn-batal-edit {
      background-color: rgb(210, 210, 210);
      color: white;
      border: none;
      padding: 10px 16px;
      border-radius: 8px;
      margin-right: 10px;
      cursor: pointer;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"], textarea{
      background: rgb(223, 223, 223);
      font-size: 24px;
      padding: 5px 10px;
      border-radius: 16px;
      border: none;
    }

    .img-profil {
      position: relative;
    }

    .img-profil img {
      width: 200px;
      height: 200px;
      border-radius: 16px;
      object-fit: cover;
      display: block;
    }

    .overlay-icon {
      position: absolute;
      top: 0;
      left: 0;
      width: 200px;
      height: 200px;
      background: rgba(0, 0, 0, 0.4);
      color: white;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: 0.3s ease;
      font-size: 32px;
    }
  .img-profil label:hover .overlay-icon {
      opacity: 1;
    }
    .btn-profil {
      border-radius: 16px;
      padding: 10px 15px;
      border: none;
    }

    .btn-batal-edit {
      background-color: #C71515;
      margin-right: 20px;
    }

    .btn-edit {
      background-color: #4FC965;
      margin-right: 20px;
      color: black;
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
    <?php include '../../component/sidebar-admin.php'; ?>
    <div class="col-span-10">
      <div class="right-container">
        <div class="head-container flex justify-between items-center">
          <h1 style="font-size: 50px;">Profil Kasir</h1>
           <?php

                        $sql = "SELECT * FROM tb_notifikasi 
        WHERE jenis_pengguna = 'adminkasir'
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
        </div>
        <div class="container-profil">
          <form action="proseseditkasir.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_adminkasir" value="<?= htmlspecialchars($user['id_adminkasir']) ?? '' ?>">

            <div class="flex justify-between items-center">
              <h2 style="font-weight: 900;">Nama Toko : <?= htmlspecialchars($user['nama_toko']) ?? '-' ?></h2>
              <div class="button-grup flex items-center justify-end">
                 <?php if ($editMode): ?>
                <br>
                  <a href="profil-kasir.php" class="btn-profil btn-batal-edit">
                    <h2>Batal</h2>
                  </a>
                <button type="submit" class="btn-profil btn-edit flex items-center">
                  <h2>Simpan</h2>
                  &nbsp;
                  <span class="ml-2">
                    <i class="fa fa-arrow-up" style="font-size: 24px;"></i>
                  </span>
                </button>
              <?php else: ?>
                <br>
                <a href="?edit=1" class="btn-profil btn-edit flex items-center">
                  <h2>Edit</h2>
                  &nbsp;
                  <span class="ml-2">
                    <i class="fas fa-edit" style="font-size:20px;"></i>
                  </span>
                </a>
              <?php endif; ?>
                <?php if ($editMode): ?>
                
                <?php endif; ?>
              </div>
            </div>
             <div class="flex items-start">
              <div class="img-profil" style="position: relative;">
                <?php if ($editMode): ?>
                  <label for="foto-upload" style="cursor: pointer; display: block; position: relative;">
                    <img src="../../img/profiluploadtoko/<?= htmlspecialchars($user['foto'] ?? 'default.jpeg') ?>" alt="Foto Profil">
                    <div class="overlay-icon">
                      <i class="fas fa-camera"></i>
                    </div>
                  </label>
                  <input type="file" name="foto" id="foto-upload" style="display: none;">
                <?php else: ?>
                  <img src="../../img/profiluploadtoko/<?= htmlspecialchars($user['foto'] ?? 'sosis.jpeg') ?>" alt="Foto Profil">
                <?php endif; ?>
              </div>
              &nbsp;&nbsp;
              <div>
                <div>
                  <h3 class="judul-teks">Nama Kasir</h3>
                  <h1 style="font-weight: 900;"><?= htmlspecialchars($user['nama_kasir']) ?? 'Restu' ?></h1>
                </div>
                <br>
                <div>
                  <h3 class="judul-teks" style="margin-bottom: 5px;">No Telepon</h3>
                  <h2><?= htmlspecialchars($user['no_telpon']) ?? '+62 341234' ?></h2>
                </div>
              </div>
            </div>

            <br>

            <div class="grid grid-cols-12 gap-4">
              <div class="col-span-6 grup-text">
                <p class="judul-teks">Nama Kasir</p>
                <?php if ($editMode): ?>
                  <input type="text" name="nama_kasir" value="<?= htmlspecialchars($user['nama_kasir']) ?? '' ?>">
                <?php else: ?>
                  <h2 class="data-profil-teks"><?= htmlspecialchars($user['nama_kasir']) ?? '-' ?></h2>
                <?php endif; ?>
              </div>

              <div class="col-span-6 grup-text">
                <p class="judul-teks">Email</p>
                <?php if ($editMode): ?>
                  <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?? '' ?>">
                <?php else: ?>
                  <h2 class="data-profil-teks"><?= htmlspecialchars($user['email']) ?? '-' ?></h2>
                <?php endif; ?>
              </div>
                   <div class="col-span-6 grup-text">
                <p class="judul-teks">No Telepon</p>
                <?php if ($editMode): ?>
                  <input type="text" name="no_telpon" value="<?= htmlspecialchars($user['no_telpon']) ?? '' ?>">
                <?php else: ?>
                  <h2 class="data-profil-teks"><?= htmlspecialchars($user['no_telpon']) ?? '-' ?></h2>
                <?php endif; ?>
              </div>
              

              <div class="col-span-6 grup-text">
                <p class="judul-teks">Nama Toko</p>
                <?php if ($editMode): ?>
                  <input type="text" name="nama_toko" value="<?= htmlspecialchars($user['nama_toko']) ?? '' ?>">
                <?php else: ?>
                  <h2 class="data-profil-teks"><?= htmlspecialchars($user['nama_toko']) ?? '-' ?></h2>
                <?php endif; ?>
              </div>
              
              <?php if ($editMode): ?>
                   <input type="hidden" name="password" value="<?= htmlspecialchars($user['password']) ?? '' ?>">
                <?php else: ?>
                  <div class="col-span-6 grup-text">
                    <p class="judul-teks">Password</p>
                  <h2 class="data-profil-teks">********</h2>
                </div>
                <?php endif; ?>
              <div class="col-span-8 grup-text">
                <p class="judul-teks">Alamat</p>
                <?php if ($editMode): ?>
                  <textarea name="alamat" rows="6" style="width: 100%;"><?= htmlspecialchars($user['alamat']) ?? '' ?></textarea>
                <?php else: ?>
                  <h2 class="data-profil-teks"><?= nl2br(htmlspecialchars($user['alamat'])) ?? '-' ?></h2>
                <?php endif; ?>
              </div>

             
            </div>

          </form>
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
