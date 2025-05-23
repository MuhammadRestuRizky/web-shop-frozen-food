<?php
$server = "localhost";
$username = "root";
$password = "";
$nama_database = "frozenfood";
$port = 3306; // <- integer, bukan string


// koneksi ke database
$db = mysqli_connect($server, $username, $password, $nama_database, $port);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}
?>
