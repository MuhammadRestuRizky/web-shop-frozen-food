<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="./global.css">
  <style>
    h2 {
      margin: 5px 0px;
    }

    p {
      margin: 5px 0px;
    }

    .tebal1 {
      font-weight: 600;
    }

    .text-center {
      text-align: center;
    }

    body {
      margin: 0;
      /* padding:0px 200px; */
      font-family: Arial, sans-serif;
      background: linear-gradient(to bottom, #b3ccf2, #ffffff);
      padding: 10px 0px 80px 0px;
    }

    .flex-column-end {
      display: flex;
      flex-direction: column;
    }

    .card-product {
      padding: 8px;
      display: flex;
      background-color: #ccc;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .img-parent-card-product {
      display: flex;
      align-items: center;
      margin-right: 4px;
    }

    .card-content {
      width: 100%;
      display: flex;
      justify-content: space-between;
    }

    .img-card {
      width: 60px;
      height: 60px;
    }

    .stok-button-parent {
      display: flex;
      align-items: center;
      gap: 10px;
      justify-content: center;
      margin: 10px 0;
    }

    .stok-button-parent button {
      width: 30px;
      height: 30px;
      font-size: 25px;
      font-weight: bold;
      color: #7CAEDF;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .stok-button-parent span {
      font-size: 20px;
      min-width: 20px;
      text-align: center;
      display: inline-block;
    }

    .topbar {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      padding: 10px 15px;
      position: fixed;
      top: 0;
      width: 100%;
      height: 50px;
      box-sizing: border-box;
      z-index: 100;
    }

    .kasir-info {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: bold;
    }

    .profile-icon {
      background-color: white;
      border-radius: 50%;
      width: 30px;x
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

    .buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .buttons button {
      width: 45%;
      padding: 10px;
      border: none;
      border-radius: 20px;
      font-size: 16px;
      font-weight: bold;
      color: white;
      background-color: #9ab7f0;
      cursor: pointer;
    }

    .buttons button:first-child {
      background-color: #aabfff;
    }

    .navbar {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: #ffffff;
      display: flex;
      justify-content: space-between;
      padding: 10px 20px;
      align-items: center;
    }

    .icon {
      flex: 1;
      display: flex;
      align-items: center;
    }

    .icon svg {
      width: 28px;
      height: 28px;
    }

    .center-button {
      background-color: #78be91;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
    }

    .center-button svg {
      width: 24px;
      height: 24px;
      fill: white;
    }

    .header {
      margin-top: 20px;
      margin-bottom: 2px;
    }

    @media (max-width: 768px) {
      body {
        padding: 0px 0px 80px 0px;
      }
    }
  </style>
</head>
<body>
  <div class="header"></div>

  <div class="topbar">
    <div class="spacer"></div>
    <div class="kasir-info">
      <span>Kasir</span>
      <div class="profile-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24">
          <circle cx="12" cy="8" r="4" />
          <path d="M4 20c0-4 4-6 8-6s8 2 8 6v1H4v-1z" />
        </svg>
      </div>
    </div>
  </div>

  <div class="container">
    <h2 class="text-center">Kelola Produk</h2>
    <div class="grid  grid-cols-12 gap-4">
      <div class="col-span-12 lg:col-span-4 md:col-span-4 sm:col-span-12">
        <div class="card-product">
          <div class="img-parent-card-product">
            <img src="./img/rolade.jpeg" class="img-card" alt="" />
          </div>
          <div class="card-content">
            <div class="flex-column-end">
              <div>
                <p>Id</p>
                <p class="tebal1">makanan</p>
              </div>
              <p>Rp. 17000</p>
            </div>
            <div>
              <p class="text-center">stok</p>
              <div class="stok-button-parent">
                <button class="btn-decrease">-</button>
                <span class="stok-value">2</span>
                <button class="btn-increase">+</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-span-12 lg:col-span-4 md:col-span-4 sm:col-span-12">
        <div class="card-product">
          <div class="img-parent-card-product">
            <img src="./img/rolade.jpeg" class="img-card" alt="" />
          </div>
          <div class="card-content">
            <div class="flex-column-end">
              <div>
                <p>Id</p>
                <p class="tebal1">makanan</p>
              </div>
              <p>Rp. 17000</p>
            </div>
            <div>
              <p class="text-center">stok</p>
              <div class="stok-button-parent">
                <button class="btn-decrease">-</button>
                <span class="stok-value">2</span>
                <button class="btn-increase">+</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-span-12 lg:col-span-4 md:col-span-4 sm:col-span-12">
        <div class="card-product">
          <div class="img-parent-card-product">
            <img src="./img/rolade.jpeg" class="img-card" alt="" />
          </div>
          <div class="card-content">
            <div class="flex-column-end">
              <div>
                <p>Id</p>
                <p class="tebal1">makanan</p>
              </div>
              <p>Rp. 17000</p>
            </div>
            <div>
              <p class="text-center">stok</p>
              <div class="stok-button-parent">
                <button class="btn-decrease">-</button>
                <span class="stok-value">2</span>
                <button class="btn-increase">+</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-span-12 lg:col-span-4 md:col-span-4 sm:col-span-12">
        <div class="card-product">
          <div class="img-parent-card-product">
            <img src="./img/rolade.jpeg" class="img-card" alt="" />
          </div>
          <div class="card-content">
            <div class="flex-column-end">
              <div>
                <p>Id</p>
                <p class="tebal1">makanan</p>
              </div>
              <p>Rp. 17000</p>
            </div>
            <div>
              <p class="text-center">stok</p>
              <div class="stok-button-parent">
                <button class="btn-decrease">-</button>
                <span class="stok-value">2</span>
                <button class="btn-increase">+</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-span-12 lg:col-span-4 md:col-span-4 sm:col-span-12">
        <div class="card-product">
          <div class="img-parent-card-product">
            <img src="./img/rolade.jpeg" class="img-card" alt="" />
          </div>
          <div class="card-content">
            <div class="flex-column-end">
              <div>
                <p>Id</p>
                <p class="tebal1">makanan</p>
              </div>
              <p>Rp. 17000</p>
            </div>
            <div>
              <p class="text-center">stok</p>
              <div class="stok-button-parent">
                <button class="btn-decrease">-</button>
                <span class="stok-value">2</span>
                <button class="btn-increase">+</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-span-12 lg:col-span-4 md:col-span-4 sm:col-span-12">
        <div class="card-product">
          <div class="img-parent-card-product">
            <img src="./img/rolade.jpeg" class="img-card" alt="" />
          </div>
          <div class="card-content">
            <div class="flex-column-end">
              <div>
                <p>Id</p>
                <p class="tebal1">makanan</p>
              </div>
              <p>Rp. 17000</p>
            </div>
            <div>
              <p class="text-center">stok</p>
              <div class="stok-button-parent">
                <button class="btn-decrease">-</button>
                <span class="stok-value">2</span>
                <button class="btn-increase">+</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigasi bawah -->
  <nav class="navbar">
    <div class="icon" style="justify-content: flex-start;">
      <svg xmlns="http://www.w3.org/2000/svg" fill="black" viewBox="0 0 24 24">
        <path d="M3 3v18h18V3H3zm2 2h14v4H5V5zm0 6h6v2H5v-2zm0 4h6v2H5v-2zm8 0h6v2h-6v-2zm0-4h6v2h-6v-2z" />
      </svg>
    </div>

    <div class="center-button">
      <a href="profil-kasir.php">
        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24">
          <path d="M15 18l-6-6 6-6" />
        </svg>
      </a>
    </div>

    <div class="icon" style="justify-content: flex-end;">
      <svg xmlns="http://www.w3.org/2000/svg" fill="black" viewBox="0 0 24 24">
        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
      </svg>
    </div>
  </nav>
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

</body>
</html>
