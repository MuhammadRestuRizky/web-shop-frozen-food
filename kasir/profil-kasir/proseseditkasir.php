<?php
include("../../konfig.php");
session_start();
 
$nama_kasir = $_POST['nama_kasir'];
$id_adminkasir = $_POST['id_adminkasir'];
$email = $_POST['email'];
$password = $_POST['password'];
$nama_toko = $_POST['nama_toko'];
$alamat = $_POST['alamat'];
$no_telpon = $_POST['no_telpon'];
$foto_update = "";
$alamat_baru = $_POST['alamat'];
$toko_baru = $_POST['nama_toko'];

$sql_lama = "SELECT alamat FROM tb_adminkasir WHERE id_adminkasir='$id_adminkasir'";
$res_lama = mysqli_query($db, $sql_lama);
$data_lama = mysqli_fetch_assoc($res_lama);
$toko_lama = $data_lama['nama_toko'] ?? '';
$alamat_lama = $data_lama['alamat'] ?? '';
$toko_baru = $_POST['nama_toko'];
//nama_toko baru


if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $foto = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    $type = mime_content_type($file_tmp); 

    if ($type != 'image/jpeg' && $type != 'image/jpg' && $type != 'image/png' && $type != 'image/gif') {
        echo "Tipe file tidak diperbolehkan. Hanya jpg, jpeg, png, dan gif.";
        exit;
    }

    $sql_foto = "SELECT foto FROM tb_adminkasir WHERE id_adminkasir='$id_adminkasir'";
    $res_foto = mysqli_query($db, $sql_foto);
    $data = mysqli_fetch_assoc($res_foto);
    $foto_lama = $data['foto'] ?? '';

    $target_dir = "../../img/profiluploadtoko/";
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

$sql = "UPDATE tb_adminkasir 
        SET nama_kasir='$nama_kasir', email='$email', password='$password', 
            nama_toko='$nama_toko', alamat='$alamat', no_telpon='$no_telpon' 
            $foto_update 
        WHERE id_adminkasir='$id_adminkasir'";
$query = mysqli_query($db, $sql);  
if ($query) { 
    if ($alamat_baru !== $alamat_lama) { 
        $sql_update_alamat_lain = "UPDATE tb_adminkasir 
                                  SET alamat = '$alamat_baru' 
                                  WHERE alamat = '$alamat_lama' AND id_adminkasir != '$id_adminkasir'";
        mysqli_query($db, $sql_update_alamat_lain);
    }
    if ($toko_baru !== $toko_lama) { 
        $sql_update_toko_lain = "UPDATE tb_adminkasir 
                                  SET nama_toko = '$toko_baru' 
                                  WHERE nama_toko = '$toko_lama' AND id_adminkasir != '$id_adminkasir'";
        mysqli_query($db, $sql_update_toko_lain);
    }

    $_SESSION['nama_kasir'] = $nama_kasir;
    header("Location: profil-kasir.php");
    exit;
} else {
    echo "Gagal memperbarui profil!";
}