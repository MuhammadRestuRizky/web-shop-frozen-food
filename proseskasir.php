<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "frozenfood"; // Ganti dengan nama database Anda

$koneksi = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Fungsi: Ambil semua produk
function getProduk() {
    global $koneksi;
    $result = $koneksi->query("SELECT * FROM tb_produk ORDER BY id_produk ASC");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fungsi: Hapus produk
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    
    // Hapus file gambar jika perlu
    $gambar = $koneksi->query("SELECT tb_produk FROM produk WHERE image_produk = $id")->fetch_assoc();
    if ($gambar && file_exists("uploads/" . $gambar['image_produk'])) {
        unlink("uploads/" . $gambar['image_produk']);
    }

    $koneksi->query("DELETE FROM produk WHERE id_produk = $id");
    header("Location: menukasir.php");
    exit;
}

// Fungsi: Tambah produk
if (isset($_POST['tambah'])) {
    $nama     = $_POST['nama_produk'];
    $harga    = $_POST['harga_produk'];
    $stok     = $_POST['stok'];
    $deskripsi= $_POST['deskripsi_produk'];

    // Upload gambar
    $gambar = $_FILES['image_produk']['name'];
    $tmp    = $_FILES['image_produk']['tmp_name'];
    move_uploaded_file($tmp, "uploads/" . $gambar);

    $stmt = $koneksi->prepare("INSERT INTO produk (nama_produk, harga_produk, stok, deskripsi_produk, image_produk) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siiss", $nama, $harga, $stok, $deskripsi, $gambar);
    $stmt->execute();

    header("Location: menukasir.php");
    exit;
}

// Fungsi: Edit produk
if (isset($_POST['edit'])) {
    $id       = $_POST['id_produk'];
    $nama     = $_POST['nama_produk'];
    $harga    = $_POST['harga_produk'];
    $stok     = $_POST['stok'];
    $deskripsi= $_POST['deskripsi_produk'];

    // Cek apakah gambar diubah
    if (!empty($_FILES['image_produk']['name'])) {
        $gambar = $_FILES['image_produk']['name'];
        $tmp    = $_FILES['image_produk']['tmp_name'];
        move_uploaded_file($tmp, "uploads/" . $gambar);

        $stmt = $koneksi->prepare("UPDATE produk SET nama_produk=?, harga_produk=?, stok=?, deskripsi_produk=?, image_produk=? WHERE id_produk=?");
        $stmt->bind_param("siissi", $nama, $harga, $stok, $deskripsi, $gambar, $id);
    } else {
        $stmt = $koneksi->prepare("UPDATE produk SET nama_produk=?, harga_produk=?, stok=?, deskripsi_produk=? WHERE id_produk=?");
        $stmt->bind_param("siisi", $nama, $harga, $stok, $deskripsi, $id);
    }

    $stmt->execute();
    header("Location: menukasir.php");
    exit;
}
?>
