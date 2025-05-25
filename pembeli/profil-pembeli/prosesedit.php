<?php
include("../../konfig.php");
session_start();

$id_pembeli = $_POST['id_pembeli'];
$username = $_POST['username'];
$no_telpon = $_POST['no_telpon'];
$password = $_POST['password']; 
$foto_update = "";

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    $type = mime_content_type($file_tmp); 
    if ($type != 'image/jpeg' && $type != 'image/jpg' && $type != 'image/png' && $type != 'image/gif') {
        echo "Tipe file tidak diperbolehkan. Hanya jpg, jpeg, png, dan gif.";
        exit;
    } 
    $sql_foto = "SELECT foto FROM tb_pembeli WHERE id_pembeli='$id_pembeli'";
    $res_foto = mysqli_query($db, $sql_foto);
    $data = mysqli_fetch_assoc($res_foto);
    $foto_lama = $data['foto'] ?? '';

    $target_dir = "../../img/profilupload/";
    $target_file = $target_dir . basename($foto);

    if (move_uploaded_file($file_tmp, $target_file)) { 
        if ($foto_lama && file_exists($target_dir . $foto_lama)) {
            unlink($target_dir . $foto_lama);
        }
        $foto_update = ", foto = '$foto'";
    } else {
        echo "Gagal mengupload foto.";
        exit;
    }
}

$sql = "UPDATE tb_pembeli SET username='$username', no_telpon='$no_telpon', password='$password' $foto_update WHERE id_pembeli='$id_pembeli'";
$query = mysqli_query($db, $sql);

if ($query) {
    $_SESSION['username'] = $username;
    header("Location: profil_pembeli.php");
    exit;
} else {
    echo "Gagal memperbarui profil!";
}
?>
