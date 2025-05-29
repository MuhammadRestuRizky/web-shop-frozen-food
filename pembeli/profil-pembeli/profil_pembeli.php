<?php
include("../../konfig.php");
session_start();
$username = $_SESSION['username'];
$sql = "SELECT * FROM tb_pembeli WHERE username = '$username'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
  $user = mysqli_fetch_assoc($query);
}
$editMode = isset($_GET['edit']) && $_GET['edit'] == '1';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <title>Profil Pembeli</title>
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
    input[type="password"] {
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

    .img-profil label:hover .overlay-icon {
      opacity: 1;
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
                <h1 style="font-size: 50px;">Profil Pembeli</h1>
            </div> 
        <div class="container-profil">

          
          <form action="prosesedit.php" method="POST" enctype="multipart/form-data">
            <div class="flex justify-between items-center">
              <h3>Id Pembeli : <?= htmlspecialchars($user['id_pembeli']) ?></h3>
              <div class="button-grup flex items-center justify-end">
                 <?php if ($editMode): ?>
                <br>
                  <a href="profil_pembeli.php" class="btn-profil btn-batal-edit">
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
                    <img src="../../img/profilupload/<?= htmlspecialchars($user['foto'] ?? 'sosis.jpeg') ?>" alt="Foto Profil">
                    <div class="overlay-icon">
                      <i class="fas fa-camera"></i>
                    </div>
                  </label>
                  <input type="file" name="foto" id="foto-upload" style="display: none;">
                <?php else: ?>
                  <img src="../../img/profilupload/<?= htmlspecialchars($user['foto'] ?? 'sosis.jpeg') ?>" alt="Foto Profil">
                <?php endif; ?>
              </div>
              &nbsp;&nbsp;
              <div>
                <div>
                  <h2 class="judul-teks">Nama</h2>
                  <h1 style="font-weight: 900;"><?= htmlspecialchars($user['username']) ?? 'Restu' ?></h1>
                </div>
                <br>
                <div>
                  <h3 class="judul-teks" style="margin-bottom: 5px;">No Telepon</h3>
                  <h2><?= htmlspecialchars($user['no_telpon']) ?? '+62 341234' ?></h2>
                </div>
              </div>
            </div>

            <br><br>
            <h2>Informasi Profil</h2>
            <br>

            <div class="grid grid-cols-12 gap-4"> 
              <input type="hidden" name="id_pembeli" value="<?= htmlspecialchars($user['id_pembeli']) ?>" readonly>

              <div class="col-span-6 grup-text">
                <p class="judul-teks">Username</p><br>
                <?php if ($editMode): ?>
                  <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>">
                <?php else: ?>
                  <h2 class="data-profil-teks"><?= htmlspecialchars($user['username']) ?></h2>
                <?php endif; ?>
              </div>

              <div class="col-span-6 grup-text">
                <p class="judul-teks">No Telepon</p><br>
                <?php if ($editMode): ?>
                  <input type="number" name="no_telpon" value="<?= htmlspecialchars($user['no_telpon']) ?>">
                <?php else: ?>
                  <h2 class="data-profil-teks"><?= htmlspecialchars($user['no_telpon']) ?></h2>
                <?php endif; ?>
              </div>

              <div class="col-span-6 grup-text">
                <p class="judul-teks">Password</p><br>
                <?php if ($editMode): ?>
                  <input type="password" name="password" value="<?= htmlspecialchars($user['password']) ?>">
                <?php else: ?>
                  <h2 class="data-profil-teks">********</h2>
                <?php endif; ?>
              </div>
            </div>

           
          </form>
        </div> 
    </div>
  </div>
  <script>  
  </script>
</body>
</html>
