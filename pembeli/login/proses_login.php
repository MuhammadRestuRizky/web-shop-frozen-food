<?php
include("../../konfig.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $sql = "SELECT * FROM tb_pembeli WHERE username = '$username' AND password = '$password'";
    $query = mysqli_query($db, $sql);

    if ($query && mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        // print_r($user);
        $_SESSION['username'] = $user['username'];
        header("Location: ../dashboard/dashboard-pembeli.php?status=login_berhasil");
        exit;
    } else {
        header("Location: login_pembeli.php?status=gagal_login");
        exit;
    }
} else {
    die("Akses tidak sah.");
}
?>
