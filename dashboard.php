<?php
include("konfig.php");
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


    .sidebar-parent {
      padding: 20px;
      background: #7CAEDF;
    }

    .sidebar {
      position: sticky;
      top: 80px;
    }

    .h-vhfull {
      height: 100vh;
    }

    ul {
      list-style: none;
    }

    a {
      text-decoration: none;
      color: black;
    }

    .fw-semibold {
      font-weight: 400;
    }

    .profil-parent {
      padding: 30px 0px;
    }

    .align-items-center {
      align-items: center;
    }

    /* .link-dashboard {
      padding: 20px 0px;
      ;
      color: ;
    } */

    .profile-icon {
      background-color: white;
      border-radius: 50%;
      margin-right: 8px;
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .profile-icon svg {
      width: 20px;
      height: 20px;
      fill: #000;
    }

    /* .link-sidebar {
      font-size: 20px;
      text
    } */

    .input-with-icon {
      margin-top: 20px;
      position: relative;
      width: 100%;
      /* max-width: 300px; */
    }

    .input-with-icon i {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #888;
      pointer-events: none;
    }

    .input-with-icon input {
      width: 100%;
      padding: 10px 10px 10px 35px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }

    .radius-input {
      border-radius: 20px !important;
    }

    .input-search {
      width: 100% !important;
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
  <link rel="stylesheet" href="global.css">
</head>

<body>
  <div class="grid grid-cols-12 h-vhfull">

    <?php include './component/sidebar.php';?>
    <div class="col-span-10">
      <div class="right-container">
        <div class="head-container">
          <h1>Beranda</h1>
          
          <div class="input-with-icon">
            <i class="fas fa-search"></i>
            <input type="text" class="radius-input input-search" placeholder="Cari...">
          </div>
        </div>
        <div class="container-product">
          <div class="grid grid-cols-12 gap-4">
            <div class="col-span-2">
              <div class="card-product">
                <img src="./img/sosis.jpeg" alt="" srcset="" max-width="200px">
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
                <img src="./img/rolade.jpeg" alt="" srcset="" max-width="180px">
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
                <img src="./img/smokedbeef.jpg" alt="" srcset="" max-width="200px">
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
                <img src="./img/dumplingkeju.jpeg" alt="" srcset="" max-width="200px">
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
                <img src="./img/nugget.jpeg" alt="" srcset="" max-width="200px">
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
                <img src="./img/kentanggoreng.jpeg" alt="" srcset="" max-width="200px">
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
                <img src="./img/sosis.jpeg" alt="" srcset="" max-width="200px">
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
                <img src="./img/sosis.jpeg" alt="" srcset="" max-width="200px">
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
                <img src="./img/sosis.jpeg" alt="" srcset="" max-width="200px">
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