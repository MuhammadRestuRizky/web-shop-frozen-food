<?php
// Konfigurasi database
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "frozenfood"; // Nama database kamu

$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan'])) {
    // Ambil dan sanitasi data dari form
    $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $harga_produk = mysqli_real_escape_string($conn, $_POST['harga_produk']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    $deskripsi_produk = mysqli_real_escape_string($conn, $_POST['deskripsi_produk']);

    // Handle upload gambar
    $target_dir = "img/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Pastikan file diunggah
    if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) {
        $image_produk = time() . '_' . basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $image_produk;

        // Pindahkan file ke folder tujuan
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (in_array($imageFileType, allowed_types)) {  
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Simpan ke database
            $stmt = $conn->prepare("INSERT INTO tb_produk (nama_produk, harga_produk, stok, deskripsi_produk, image_produk) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("siiss", $nama_produk, $harga_produk, $stok, $deskripsi_produk, $image_produk);

            if ($stmt->execute()) {
                echo "Produk berhasil ditambahkan.";
                echo "<br><a href='tambah-produk.php'>Tambah lagi</a>";
            } else {
                echo "Gagal menyimpan ke database: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Gagal mengunggah gambar.";
        }
    } else {
        echo "Tidak ada file gambar yang diunggah.";
    }

    $conn->close();
}
?>

