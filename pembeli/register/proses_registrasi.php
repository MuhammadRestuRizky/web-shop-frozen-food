<?php
include("../../konfig.php"); 
session_start();

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($db, trim($_POST['username']));
    $no_telpon = mysqli_real_escape_string($db, trim($_POST['no_telpon']));
    $password = $_POST['password']; 
    $cek_user = mysqli_query($db, "SELECT * FROM tb_pembeli WHERE username = '$username'");
    if (mysqli_num_rows($cek_user) > 0) { 
        header("Location: registrasi.php?pesan=gagal");
        exit;
    } 
  
    $query = "INSERT INTO tb_pembeli (username, no_telpon, password, foto) 
              VALUES ('$username', '$no_telpon', '$password', NULL)";

    if (mysqli_query($db, $query)) {
       
        header("Location: ../login/login_pembeli.php?pesan=berhasil");
        exit;
    } else { 
        header("Location: registrasi.php?pesan=gagal");
        exit;
    }
} else { 
    header("Location: registrasi.php");
    exit;
}
