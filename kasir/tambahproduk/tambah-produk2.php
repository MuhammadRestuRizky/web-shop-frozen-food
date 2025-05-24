<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Produk</title>
  <style>
    h2{
      margin:5px 0px;
    }
    body {
      text-align :center;
      margin: 0;
      /* padding-top: 80px; */
      font-family: Arial, sans-serif;
      background: linear-gradient(to bottom, #b3ccf2, #ffffff);
      
      padding: 10px 0px 80px 0px;
    }

    .container {
      max-width: 400px;
      margin: 0px auto;
      padding: 20px;
      background-color: #ccc;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      text-align: center;
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

    .form-group {
      margin: 15px 0;
      text-align: left;
    }

    .form-group label {
      font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
      width: 95%;
      padding: 10px;
      border-radius: 8px;
      border: none;
      margin-top: 5px;
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
    padding:0px 0px;
  }
}

  </style>
</head>
<body>
 <div class="header">
  </div>
   <div class="topbar">
    <div class="spacer"></div>
    <div class="kasir-info">
      <span>Kasir</span>
      <div class="profile-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24">
          <circle cx="12" cy="8" r="4"/>
          <path d="M4 20c0-4 4-6 8-6s8 2 8 6v1H4v-1z"/>
        </svg>
      </div>
    </div>
  </div>

  <form method="post" enctype="multipart/form-data" action="prosestambahproduk.php">
  <div class="container">
    
  <h2>Tambah Produk baru</h2>

<!-- Tempat preview gambar -->
    <!-- Tombol submit -->
      <div class="form-group">
        <label>Nama Produk:</label>
        <input type="text" name="nama_produk" required />
      </div>
      <div class="form-group">
        <label>Harga (Rp):</label>
        <input type="number" name="harga" required />
      </div>
      <div class="form-group">
        <label>Stok:</label>
        <input type="number" name="stok" required />
      </div>
      <div class="form-group">
        <label>Deskripsi Produk:</label>
        <input type="text" name="deskripsi" rows="3"></input>
      </div>

      <div class="buttons">
        <button type="reset">Batal</button>
        <button type="submit">Simpan</button>
      </div>
    </form>
  </div>

  <!-- Navigasi bawah -->
  <nav class="navbar">
    <div class="icon" style="justify-content: flex-start;">
      <!-- Ikon kasir SVG -->
      <svg xmlns="http://www.w3.org/2000/svg" fill="black" viewBox="0 0 24 24">
        <path d="M3 3v18h18V3H3zm2 2h14v4H5V5zm0 6h6v2H5v-2zm0 4h6v2H5v-2zm8 0h6v2h-6v-2zm0-4h6v2h-6v-2z"/>
      </svg>
    </div>

    <div class="center-button">
      <!-- Tombol kembali -->
      <a href="index.php">
        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24">
          <path d="M15 18l-6-6 6-6"/>
        </svg>
      </a>
    </div>

    <div class="icon" style="justify-content: flex-end;">
      <!-- Ikon profil SVG -->
      <svg xmlns="http://www.w3.org/2000/svg" fill="black" viewBox="0 0 24 24">
        <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
      </svg>
    </div>
  </nav>

</body>
</html>
