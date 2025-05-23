<?php
include("konfig.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $nama_kasir = mysqli_real_escape_string($db, $_POST['nama_kasir']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

   $sql = "SELECT * FROM tb_adminkasir WHERE nama_kasir = '$nama_kasir' AND email = '$email' AND password = '$password'";
 $query = mysqli_query($db, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        // print_r($user);
        $_SESSION['nama_kasir'] = $user['nama_kasir'];
        header("Location: menukasir.php?status=login_berhasil");
        exit;
    } else {
        header("Location: login-kasir.php?status=gagal_login");
        exit;
    }
} else {
    die("Akses tidak sah.");
}
?>
