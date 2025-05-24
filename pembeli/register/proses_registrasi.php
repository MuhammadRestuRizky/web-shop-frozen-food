<?php
include("konfig.php"); // koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape input dengan koneksi database
    $username   = mysqli_real_escape_string($db, $_POST['username']);
    $no_telpon  = mysqli_real_escape_string($db, $_POST['no_telpon']);
    $password   = mysqli_real_escape_string($db, $_POST['password']); // Tanpa hash

    // Cek apakah username sudah ada
    $cek_user = mysqli_query($db, "SELECT * FROM tb_pembeli WHERE username = '$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        echo "<script>alert('Username sudah digunakan'); window.location='registrasi_pembeli.php';</script>";
    } else {
        // Simpan ke database
        $query = "INSERT INTO tb_pembeli (username, no_telpon, password) 
                  VALUES ('$username', '$no_telpon', '$password')";

        if (mysqli_query($db, $query)) {
            echo "<script>alert('Registrasi berhasil! Silakan login'); window.location='login_pembeli.php';</script>";
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($db);
        }
    }
}?>
