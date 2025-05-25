<?php
$current_page = basename($_SERVER['PHP_SELF']);

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

    .profile-user-icon {
        background-color: white !important;
        border-radius: 50%;
        margin-right: 8px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
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
</style>
<div class="col-span-2 sidebar-parent">
    <div class="profil-parent align-items-center padding-sidebar">
        <a href="../profil/profil_kasir.php" class="link-sidebar align-items-center flex fw-semibold">
            <span class="profile-user-icon">
                <i class=" fas fa-user" style="font-size:20px;"></i>
            </span>
            Profil
        </a>

    </div>

    <?php if ($current_page === 'kelola-produk.php'): ?>
        <div class="input-with-icon">
            <i class="fas fa-search"></i>
            <input type="text" class="radius-input input-search" placeholder="Cari Produk">
        </div>

    <?php elseif ($current_page === 'kelola-pesanan.php'): ?>
        <div class="input-with-icon">
            <i class="fas fa-search"></i>
            <input type="text" class="radius-input input-search" placeholder="Cari NO Pesanan.">
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
            <a href="../logout.php" class="link-sidebar align-items-center flex fw-regular">

                <span class="sidebar-icon">
                    <i class=" fas fa-sign-out-alt" style="font-size:16px;"></i>
                </span>
                Logout
            </a>
        </li>
    </ul>
</div>