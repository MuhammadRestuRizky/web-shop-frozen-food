<?php
$current_page = basename($_SERVER['PHP_SELF']);
$username = $_SESSION['username'];
$sql = "SELECT * FROM tb_pembeli WHERE username = '$username'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
    $user = mysqli_fetch_assoc($query);
}
$nama_user = $user['username'] ?? '';
?>
<style>
  .sidebar-parent {

    background: #7CAEDF;
  }

  ul {
    list-style: none;
  }

  a {
    text-decoration: none;
    color: black;
  }

  .fw-regular {
    font-weight: 400;
  }

  .fw-semibold {
    font-weight: 600;
  }

  .profil-parent {
    padding: 2px 0px;
  }

  .padding-sidebar {
    padding: 20px 20px 0px 20px;
  }

  .align-items-center {
    align-items: center;
  }

  .sidebar {
    position: sticky;
    top: 80px;
  }

  .link-sidebar {
    font-size: 20px;
    margin: 20px 5px;
    text-decoration: none;
  }

  .sidebar-icon {
    background-color: white !important;
    border-radius: 50%;
    margin-right: 8px;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .profile-user-icon img{
    background-color: white !important;
    border-radius: 50px;
    /* margin-right: 8px; */
    width: 40px;
    height: 40px;
    display: block;
    object-fit: cover;
  }

  .sidebar-icon svg {
    width: 20px;
    height: 20px;
    fill: #000;
  }

  .input-with-icon {
    /* margin-top: 20px; */
    /* margin-bottom: 10px; */
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
    width: 90% !important;
    padding: 10px 10px 10px 35px;
    border: none;

    border-radius: 4px;
    font-size: 16px;
  }

  .radius-input {
    border-bottom-right-radius: 20px !important;
    border-top-right-radius: 20px !important;
  }
  .username-ellipsis {
  display: inline-block;
  max-width:1000px; /* Atur sesuai kebutuhan */
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  vertical-align: middle;
}

</style>
<div class="col-span-2 sidebar-parent">
  <div class="profil-parent align-items-center padding-sidebar">
    <a href="../profil-pembeli/profil_pembeli.php" class="link-sidebar align-items-center flex fw-semibold">
      <?php if ($user['foto']): ?>
      <span class="profile-user-icon">
        <img  src="../../img/profilupload/<?= htmlspecialchars($user['foto'] ?? 'default.jpeg') ?>" alt="" srcset="">
        </span>
        <?php else: ?>
          <i class=" fas fa-user" style="font-size:20px;"></i>
        <?php endif; ?>
        &nbsp;
       <span class="username-ellipsis"><?= htmlspecialchars($user['username']) ?? '-' ?></span>
    </a>

  </div>
  <div class="input-with-icon">
    <i class="fas fa-search"></i>
    <input type="text" class="radius-input input-search" placeholder="Cari...">
  </div>
  <ul class=" padding-sidebar">
    <li class="link-dashboard">
      <a href="../dashboard/dashboard-pembeli.php" class="link-sidebar align-items-center flex fw-regular">

        <span class="sidebar-icon">
          <i class=" fas fa-home" style="font-size:16px;"></i>
        </span>
        Dashboard
      </a>
    </li>
    <li class="link-dashboard">
      <a href="../keranjang/keranjang.php" class="link-sidebar align-items-center flex fw-regular">

        <span class="sidebar-icon">
          <i class=" fas fa-shopping-cart" style="font-size:16px;"></i>
        </span>
        Keranjang
      </a>
    </li>
    <li class="link-dashboard">
      <a href="../lihat-pesanan/pesanan.php" class="link-sidebar align-items-center flex fw-regular">

        <span class="sidebar-icon">
          <i class=" fas fa-box" style="font-size:16px;"></i>
        </span>
        Pesanan
      </a>
    </li>
    <?php
    $sql_pesanan_user = "SELECT COUNT(*) as jumlah FROM tb_pesanan p
                     JOIN tb_pembeli ak ON p.id_pembeli = ak.id_pembeli
                     WHERE ak.username = '$nama_user'  ";
$query_pesanan_user = mysqli_query($db, $sql_pesanan_user);
$data_pesanan = mysqli_fetch_assoc($query_pesanan_user);
    ?>
       <?php if ($data_pesanan['jumlah'] > 0): ?>
    <li class="link-dashboard">
      <a href="../maps/maps.php" class="link-sidebar align-items-center flex fw-regular">
        <span class="sidebar-icon">
          <i class=" fas fa-box" style="font-size:16px;"></i>
        </span>
        Maps
      </a>
    </li>
    <?php endif; ?>
  </ul>
</div>