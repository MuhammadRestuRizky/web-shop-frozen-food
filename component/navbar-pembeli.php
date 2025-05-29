<?php
$username = $_SESSION['username'];
$sql = "SELECT * FROM tb_pembeli WHERE username = '$username'";
$query = mysqli_query($db, $sql);
if ($query && mysqli_num_rows($query) > 0) {
    $user = mysqli_fetch_assoc($query);
}
$nama_user = $user['username'] ?? '';
$id_pembeli = $user['id_pembeli'] ?? '';
$current_page = basename($_SERVER['PHP_SELF']);
$aksi = $_GET['aksi'] ?? '';
?>

<style>
    .navbar-parent {
        background-color: #7CAEDF;
        padding: 0px 20px;
        padding-top: 20px;
    }

    .input-with-icon {
        /* margin-top: 20px; */
        /* margin-bottom: 10px; */
        position: relative;
        width: 100%;
        /* max-width: 300px; */
    }

    .input-with-icon .form-search {
        width: 100%;
    }

    .form-search {
        width: 100% !important;
    }

    .input-with-icon .i-search {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        pointer-events: none;
    }

    .input-with-icon input {
        width: 100% !important;
        padding: 10px 10px 10px 35px;
        background: white;
        border: none;

        border-radius: 20px;
        font-size: 16px;
    }

    .is-active {
        background-color:
            white;
    }

    .parent-icon {
        border-top-right-radius: 6px;
        border-top-left-radius: 6px;
        padding: 10px 6px 0px 6px;
        height: 100%;
    }

    .custompadtom {
        padding-bottom: 20px;
    }

    .custompadtop {
        padding-top: 20px;
    }

    .profile-modal {
        display: none;
        position: absolute;
        right: 0;
        top: 60px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        z-index: 999;
        min-width: 150px;
    }

    .profile-modal ul {
        list-style: none;
        margin: 0;
        padding: 10px;
    }

    .profile-modal ul li {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .profile-modal ul li:last-child {
        border-bottom: none;
    }

    .profile-modal ul li a {
        text-decoration: none;
        color: #333;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .profile-modal ul li:hover {
        background-color: #f0f0f0;
    }

    .radius-input {
        /* border-bottom-right-radius: 20px !important;
        border-top-right-radius: 20px !important; */
    }

    .notification-icon {
        position: relative;
        font-size: 30px;
        cursor: pointer;
    }

    .notification-icon .badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: red;
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
    }

    /* Dialog notifikasi */
    .notification-dialog {
        display: none;
        position: absolute;
        top: 60px;
        right: 0;
        background: white;
        border: 1px solid #ccc;
        width: 550px;
        z-index: 100;
        border-radius: 20px;
    }

    .notification-dialog.active {
        display: block;
    }

    .notification-dialog p {
        margin: 5px 0;
        font-size: 14px;
        font-weight: 400 !important;
    }

    .notification-container {
        position: relative;
        display: inline-block;
    }

    .head-notifikasi {
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        padding: 20px 10px;
        background-color: #7CAEDF;
    }

    .notifikasi-content {
        padding: 10px;
    }
    
        .btn-hapus-semua { 
            padding: 10px 20px;
            border-radius: 10px;
            background-color: #FF0000; 
            color: white;
        }
</style>
<navbar>
    <div class="navbar-parent">
        <div class="grid grid-cols-12 items-center">
            <div style="height: 100%;" class="col-span-4 flex items-center ">

                <span onclick="window.location.href='../dashboard/dashboard-pembeli.php';" class="parent-icon <?= ($current_page == 'dashboard-pembeli.php') ? 'is-active' : '' ?>" style="padding-bottom: 20px;">
                    <i class="fa fa-home" style="font-size: 40px;"></i>
                </span>
                &nbsp;&nbsp;&nbsp;
                <h1 class="custompadtom custompadtop">
                    Warung Frozen
                </h1>
            </div>
            <div style="height: 100%;" class="col-span-5 flex items-center ">
                <div class=" input-with-icon w-full ">
                    <?php if ($current_page === 'dashboard-pembeli.php'): ?>
                        <div class="input-with-icon custompadtom custompadtop" style="display: flex; justify-content: space-between; align-items: center;">
                            <form method="GET" action="../dashboard/dashboard-pembeli.php?cari" class="form-search flex items-center gap-2">
                                <i class="fas fa-search i-search"></i>
                                <input type="text" name="cari" class="radius-input input-search" placeholder="Cari Produk.">
                            </form>
                            &nbsp;
                            <?php if ($_GET['cari'] ?? ''): ?>
                                <form method="GET" action="../dashboard/dashboard-pembeli.php" class="flex items-center justify-end gap-2 ">
                                    <button type="submit" style="background:none; border:none; cursor:pointer; padding: 6px; display: inline-block;">
                                        <i class="fas fa-times" style="font-size:20px;"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                    <?php elseif ($current_page === 'pesanan.php'): ?>
                        <div class="input-with-icon" style="display: flex; justify-content: space-between; align-items: center;">
                            <form method="GET" action="../lihat-pesanan/pesanan.php?cari" class="form-search">
                                <i class="fas fa-search i-search"></i>
                                <input type="text" name="cari" class="radius-input input-search" placeholder="Cari NO Pesanan.">
                            </form>
                            <?php if ($_GET['cari'] ?? ''): ?>
                                <form method="GET" action="../lihat-pesanan/pesanan.php" class=" ">
                                    <button type="submit" style="background:none; border:none; cursor:pointer; padding: 6px; display: inline-block;">
                                        <i class="fas fa-times" style="font-size:20px;"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="input-with-icon" style="visibility: hidden;">
                            <i class="fas fa-search i-search"></i>
                            <input type="text" class="radius-input input-search" type="hidden" disabled placeholder="">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div style="height: 100%;" class="col-span-3 gap-4 flex items-center justify-end">
                <?php
                $id_pembeli = $user['id_pembeli'];
                $sql = "SELECT * FROM tb_notifikasi 
                WHERE jenis_pengguna = 'pembeli' 
                AND id_pengguna = '$id_pembeli' 
                ORDER BY tgl_notifikasi DESC 
                LIMIT 10";
                $result = mysqli_query($db, $sql);

                // Hitung jumlah notifikasi
                $jumlahNotif = mysqli_num_rows($result);
                ?>
                <div class="notification-container parent-icon custompadtom  flex items-center custompadtop ">
                    <div class="flex items-center">
                        <i class="fa fa-bell notification-icon" id="notifIcon" style="font-size: 30px;">
                            <span class="badge"><?= $jumlahNotif ?></span>
                        </i>
                    </div>

                    <div class="notification-dialog" id="notifDialog">
                        <div class="head-notifikasi">
                            <div class="flex items-center justify-between">
                                <h2>Notifikasi</h2>
                                <!-- <form method="POST" action="../../component/prosesnotifikasi.php" style="display:inline">
                                      <input type="hidden" name="redirect_to" value="<?= $_SERVER['PHP_SELF'] ?>">
                                    <button type="submit" name="aksi" value="hapussemuanotif" class="btn-hapus-semua flex items-center" style="border: none;" onclick="return confirm('Yakin ingin menghapus semua pesanan?')">
                                        <h2>Hapus</h2>
                                        &nbsp;
                                        &nbsp;
                                        <i class=" fa fa-trash" style="font-size: 20px;"></i>
                                    </button>
                                </form> -->
                            </div>
                        </div>
                        <div class="notifikasi-content">
                            <?php if ($jumlahNotif > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <small>
                                        <p class="flex">
                                            📩 <?= htmlspecialchars($row['deskripsi']) ?>
                                            🕒 <?= date("d-m-Y H:i", strtotime($row['tgl_notifikasi'])) ?>
                                        </p>
                                    </small>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p>Tidak ada notifikasi.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <span onclick="window.location.href='../keranjang/keranjang.php';" class="parent-icon  flex items-center  custompadtom custompadtop <?= ($current_page == 'keranjang.php') ? 'is-active' : '' ?>">
                    <i class="fa fa-cart-shopping" style="font-size: 30px;"></i>
                </span>

                <span onclick="window.location.href='../lihat-pesanan/pesanan.php';" class="parent-icon  flex items-center  custompadtom custompadtop <?= ($current_page == 'pesanan.php') ? 'is-active' : '' ?>">
                    <i class="fa fa-clock-rotate-left" style="font-size: 30px;"></i>
                </span>
                <!-- <span onclick="window.location.href='../maps/maps.php';" class="parent-icon  flex items-center  custompadtom custompadtop <?= ($current_page == 'maps.php') ? 'is-active' : '' ?>">
                    <i class="fa fa-map" style="font-size: 30px;"></i>
                </span> -->
                <div class="profil-parent items-center padding-sidebar" style="position: relative;">
                    <div class="profile-icon" id="profileIcon" style="cursor: pointer;">
                        <?php if ($user['foto']): ?>
                            <span class="  flex items-center profile-user-icon">
                                <img width="50px" height="50px" style="object-fit: cover; border-radius:100px;" src="../../img/profilupload/<?= htmlspecialchars($user['foto'] ?? 'default.jpeg') ?>" alt="" srcset="">
                            </span>
                        <?php else: ?>
                            <i class="fas fa-user" style="font-size:20px;"></i>
                        <?php endif; ?>
                    </div>

                    <div class="profile-modal" id="profileModal">
                        <ul>
                            <li><a href="../profil-pembeli/profil_pembeli.php"><i class="fas fa-user"></i> Profil</a></li>
                            <li>
                                <form action="../../proseslogoutpembeli.php" method="POST" style="display: inline;">
                                    <button type="submit" name="logout" class="flex items-center fw-semibold" style="background: none; border: none; color: inherit; cursor: pointer;font-size:16px;" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                                        Logout&nbsp;
                                        <span>
                                            <i class="fas fa-sign-out-alt" style="font-size:20px;"></i>
                                        </span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</navbar>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileIcon = document.getElementById('profileIcon');
        const profileModal = document.getElementById('profileModal');

        profileIcon.addEventListener('click', function(e) {
            e.stopPropagation();
            profileModal.style.display = profileModal.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function(e) {
            if (!profileIcon.contains(e.target) && !profileModal.contains(e.target)) {
                profileModal.style.display = 'none';
            }
        });
    });
    const icon = document.getElementById('notifIcon');
    const dialog = document.getElementById('notifDialog');

    icon.addEventListener('click', function() {
        dialog.classList.toggle('active');
    });

    // Optional: Klik di luar akan menutup dialog
    document.addEventListener('click', function(e) {
        if (!icon.contains(e.target) && !dialog.contains(e.target)) {
            dialog.classList.remove('active');
        }
    });
</script>