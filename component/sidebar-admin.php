<?php
$current_page = basename($_SERVER['PHP_SELF']);
$nama_kasir = $_SESSION['nama_kasir'];
$sql = "SELECT * FROM tb_adminkasir WHERE nama_kasir = '$nama_kasir'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
    $user = mysqli_fetch_assoc($query);
}
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

    .profile-user-icon img {
        background-color: white !important;
        border-radius: 50px;
        /* margin-right: 8px; */
        width: 40px;
        height: 40px;
        display: block;
        object-fit: cover;
    }

    .username-ellipsis {
        display: inline-block;
        max-width: 1000px;
        /* Atur sesuai kebutuhan */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: middle;
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

    .input-with-icon .fa-search {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        pointer-events: none;
    }

    .input-with-icon .fa-search {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        pointer-events: none;
    }

    .input-with-icon .fa-close {
        position: absolute;
        right: 0px;
        top: 50%;
        transform: translateY(-50%);
        color: black;
        pointer-events: none;
    }

    .input-with-icon input {
        width: 100% !important;
        padding: 10px 10px 10px 35px;
        border: none;

        border-radius: 4px;
        font-size: 16px;
    }

    .radius-input {
        border-bottom-right-radius: 20px !important;
        border-top-right-radius: 20px !important;
    }
</style>
<div class="col-span-2 sidebar-parent">
    <div class="profil-parent align-items-center padding-sidebar">
        <a href="../profil-kasir/profil-kasir.php" class="link-sidebar align-items-center flex fw-semibold">
            <?php if ($user['foto']): ?>
                <span class="profile-user-icon">
                    <img src="../../img/profiluploadtoko/<?= htmlspecialchars($user['foto'] ?? 'default.jpeg') ?>" alt="" srcset="">
                </span>
            <?php else: ?>
                <i class=" fas fa-user" style="font-size:20px;"></i>
            <?php endif; ?>
            &nbsp;
            <span class="username-ellipsis"><?= htmlspecialchars($user['nama_kasir']) ?? '-' ?></span>
        </a>

    </div>

    <?php if ($current_page === 'kelola-produk.php'): ?>
        <div class="input-with-icon" style="display: flex; justify-content: space-between; align-items: center;">
            <form method="GET" action="../kelolaproduk/kelola-produk.php?cari" class="flex items-center gap-2">
                <i class="fas fa-search"></i>
                <input type="text" name="cari" class="radius-input input-search" placeholder="Cari Produk.">
            </form>
            <form method="GET" action="../kelolaproduk/kelola-produk.php" class="flex items-center gap-2">
                <button type="submit" style="background:none; border:none; cursor:pointer; padding: 6px; display: inline-block;">
                    <i class="fas fa-times" style="font-size:20px;"></i>
                </button>
            </form>
        </div>

    <?php elseif ($current_page === 'kelola-pesanan.php'): ?>
        <div class="input-with-icon" style="display: flex; justify-content: space-between; align-items: center;">
            <form method="GET" action="../kelolapesanan/kelola-pesanan.php?cari" class="flex items-center gap-2">
                <i class="fas fa-search"></i>
                <input type="text" name="cari" class="radius-input input-search" placeholder="Cari NO Pesanan.">
            </form>
            <form method="GET" action="../kelolapesanan/kelola-pesanan.php" class="flex items-center gap-2">
                <button type="submit" style="background:none; border:none; cursor:pointer; padding: 6px; display: inline-block;">
                    <i class="fas fa-times" style="font-size:20px;"></i>
                </button>
            </form>
        </div>
    <?php else: ?>
        <div class="input-with-icon" style="visibility: hidden;">
            <i class="fas fa-search"></i>
            <input type="text" class="radius-input input-search" type="hidden" disabled placeholder="">
        </div>
    <?php endif; ?>

    <ul class=" padding-sidebar">
        <li class="link-dashboard">
            <a href="../kelolaproduk/kelola-produk.php" class="link-sidebar align-items-center flex fw-regular">

                <span class="sidebar-icon">
                    <i class=" fas fa-home" style="font-size:16px;"></i>
                </span>
                Kelola Produk
            </a>
        </li>
        <li class="link-dashboard">
            <a href="../tambahproduk/tambah-produk.php" class="link-sidebar align-items-center flex fw-regular">

                <span class="sidebar-icon">
                    <i class=" fas fa-shopping-cart" style="font-size:16px;"></i>
                </span>
                Tambah Produk
            </a>
        </li>
        <li class="link-dashboard">
            <a href="../kelolapesanan/kelola-pesanan.php" class="link-sidebar align-items-center flex fw-regular">

                <span class="sidebar-icon">
                    <i class=" fas fa-box" style="font-size:16px;"></i>
                </span>
                Kelola Pesanan
            </a>
        </li>
        <li class="link-dashboard">
            <a href="../histori-penjualan/histori-penjualan.php" class="link-sidebar align-items-center flex fw-regular">

                <span class="sidebar-icon">
                    <i class=" fas fa-box" style="font-size:16px;"></i>
                </span>
                Histori Penjualan
            </a>
        </li>
        <li class="link-dashboard"> 
             <form action="../../proseslogoutadminkasir.php" method="POST" style="display: inline;">
                <button type="submit" name="logout" class="link-sidebar align-items-center flex fw-regular" style="background: none; border: none; color: inherit; cursor: pointer;" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                     <span class="sidebar-icon">
                    <i class=" fas fa-sign-out-alt" style="font-size:16px;"></i>
                </span>
                  Logout 
                </button>
              </form>

        </li>
    </ul>
</div>