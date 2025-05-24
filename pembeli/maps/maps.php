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
    }
    
    .container-maps {
      background: white;
      padding: 20px 40px;
    }
  

    .h-vhfull {
      height: 100vh;
    }
    .maps-teks> h2,h1{
        font-weight: 400;
    }
    .link-maps > a{
        /* font-size: 20px; */
        font-weight: 400;
        color: #2a8df4;
        text-decoration: none;
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
          <h1 style="font-size: 50px;">Beranda</h1>
          <h2>
           <a href="../pembeli/dashboard/keranjang.php" class="items-center flex fw-semibold">
             Logout
             <!-- buat spasi; -- -->
              &nbsp;
            <span class="">
              <i class=" fas fa-sign-out-alt" style="font-size:30px;"></i>
            </span>
            </a>
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
                        <h2>Nama toko: </h3>
                        <h1>    Wijaaya Frozen Food</h1>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <p>Alamat </p>
                        <h1>Desa Legok, Kec. Lohbener, Kab.Indramayu, Jawa Barat 45252</h1>

                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <h1 class="link-maps">
                <a  href="https://maps.app.goo.gl/BBTVm6PQB7AHgTE49" target="_blank">https://maps.app.goo.gl/BBTVm6PQB7AHgTE49</a>
            </h1>
        </div>
        </div>
      </div>
    </div>
  </div>
</body> 

</html>