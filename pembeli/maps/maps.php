<?php
include("../../konfig.php");
session_start();
$username = $_SESSION['username'];
$sql = "SELECT * FROM tb_pembeli WHERE username = '$username'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
  $user = mysqli_fetch_assoc($query);
}
$sql_toko =  "SELECT nama_toko, alamat, iframe_map, map_link FROM tb_adminkasir ORDER BY id_adminkasir ASC LIMIT 1";
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

    .maps-teks>h3,
    h2 {
      font-weight: 400;
    }

    .link-maps>a {
      /* font-size: 20px; */
      font-weight: 400;
      color: #2a8df4;
      text-decoration: none;
    }

    .fw-regular {
      font-weight: 400;
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
        <h1 style="font-size: 50px;">Peta Toko</h1>
      </div>
        <div class="container-maps">
          <div class="card-maps">
            <div class="grid grid-cols-12 gap-4">
             <div class="col-span-5" style="width: 100%; height: 400px;">
    <div style="width: 100%; height: 400px;overflow:scroll;">
        <?=$toko['iframe_map']?>
    </div>
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
            <h3 class="fw-regular">Link Maps: </h3>
            <h2 class="link-maps">
              <a href="https://maps.app.goo.gl/NxsoCznPUG16k6pb6" target="_blank">https://maps.app.goo.gl/NxsoCznPUG16k6pb6</a>
            </h2> 
        </div>
      </div>
    </div>
  </div>
  <script>
  </script>
</body>

</html>