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
    
    .container-product {
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
    .stok-value{
      font-weight: 600;
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
        <div class="container-product">
          <div class="grid grid-cols-12 gap-4">
            <div class="col-span-2">
              <div class="card-product">
                <img src="../../img/sosis.jpeg" alt="" srcset="" max-width="200px">
                <p style="margin-bottom:8px;">Sosis</p>
                <p>Rp. 18.000</p>
                <div class="flex" style="justify-content: end;">
                  <div class="stok-button-parent">
                    <button class="btn-decrease">-</button>
                    <span class="stok-value">2
                      
                    </span>
                    <button class="btn-increase">+</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-span-2">
              <div class="card-product">
                <img src="../../img/rolade.jpeg" alt="" srcset="" max-width="180px">
                <p style="margin-bottom:8px;">Rolade</p>
                <p>Rp. 18.000</p>
                <div class="flex" style="justify-content: end;">
                  <div class="stok-button-parent">
                    <button class="btn-decrease">-</button>
                    <span class="stok-value">2
                      
                    </span>
                    <button class="btn-increase">+</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-span-2">
              <div class="card-product">
                <img src="../../img/smokedbeef.jpg" alt="" srcset="" max-width="200px">
                <p style="margin-bottom:8px;">Smoked Beef</p>
                <p>Rp. 18.000</p>
                <div class="flex" style="justify-content: end;">
                  <div class="stok-button-parent">
                    <button class="btn-decrease">-</button>
                    <span class="stok-value">2
                      
                    </span>
                    <button class="btn-increase">+</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-span-2">
              <div class="card-product">
                <img src="../../img/dumplingkeju.jpeg" alt="" srcset="" max-width="200px">
                <p style="margin-bottom:8px;">Dumpling Keju</p>
                <p>Rp. 18.000</p>
                <div class="flex" style="justify-content: end;">
                  <div class="stok-button-parent">
                    <button class="btn-decrease">-</button>
                    <span class="stok-value">2
                      
                    </span>
                    <button class="btn-increase">+</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-span-2">
              <div class="card-product">
                <img src="../../img/nugget.jpeg" alt="" srcset="" max-width="200px">
                <p style="margin-bottom:8px;">Nugget</p>
                <p>Rp. 18.000</p>
                <div class="flex" style="justify-content: end;">
                  <div class="stok-button-parent">
                    <button class="btn-decrease">-</button>
                    <span class="stok-value">2
                      
                    </span>
                    <button class="btn-increase">+</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-span-2">
              <div class="card-product">
                <img src="../../img/kentanggoreng.jpeg" alt="" srcset="" max-width="200px">
                <p style="margin-bottom:8px;">Kentang Goreng</p>
                <p>Rp. 18.000</p>
                <div class="flex" style="justify-content: end;">
                  <div class="stok-button-parent">
                    <button class="btn-decrease">-</button>
                    <span class="stok-value">2
                      
                    </span>
                    <button class="btn-increase">+</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-span-2">
              <div class="card-product">
                <img src="../../img/sosis.jpeg" alt="" srcset="" max-width="200px">
                <p style="margin-bottom:8px;">Fish Rol</p>
                <p>Rp. 18.000</p>
                <div class="flex" style="justify-content: end;">
                  <div class="stok-button-parent">
                    <button class="btn-decrease">-</button>
                    <span class="stok-value">2
                      
                    </span>
                    <button class="btn-increase">+</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-span-2">
              <div class="card-product">
                <img src="../../img/sosis.jpeg" alt="" srcset="" max-width="200px">
                <p style="margin-bottom:8px;">Fish Rol</p>
                <p>Rp. 18.000</p>
                <div class="flex" style="justify-content: end;">
                  <div class="stok-button-parent">
                    <button class="btn-decrease">-</button>
                    <span class="stok-value">2
                      
                    </span>
                    <button class="btn-increase">+</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-span-2">
              <div class="card-product">
                <img src="../../img/sosis.jpeg" alt="" srcset="" max-width="200px">
                <p style="margin-bottom:8px;">Fish Rol</p>
                <p>Rp. 18.000</p>
                <div class="flex" style="justify-content: end;">
                  <div class="stok-button-parent">
                    <button class="btn-decrease">-</button>
                    <span class="stok-value">2
                      
                    </span>
                    <button class="btn-increase">+</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
</script>

</html>