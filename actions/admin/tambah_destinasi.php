<?php
// actions/admin/tambah_destinasi.php
require_once __DIR__ . '/../../config/database.php';

$id_destinasi = isset($_POST['id_destinasi']) ? $_POST['id_destinasi'] : '';
$nama_destinasi = isset($_POST['nama_destinasi']) ? mysqli_real_escape_string($koneksi, $_POST['nama_destinasi']) : '';
$nomor_destinasi = isset($_POST['nomor_destinasi']) ? mysqli_real_escape_string($koneksi, $_POST['nomor_destinasi']) : '';
$alamat_destinasi = isset($_POST['alamat_destinasi']) ? mysqli_real_escape_string($koneksi, $_POST['alamat_destinasi']) : '';
$deskripsi_destinasi = isset($_POST['deskripsi_destinasi']) ? mysqli_real_escape_string($koneksi, $_POST['deskripsi_destinasi']) : '';
$keterangan_destinasi = "Masuk";

$rand = rand();
$ekstensi = array('png', 'jpg', 'jpeg', 'gif', 'pdf', 'JPG');

$target_dir_destinasi = __DIR__ . '/../../assets/img/destinasi/';
$target_dir_izin = __DIR__ . '/../../assets/img/izin_destinasi/';

if (!is_dir($target_dir_destinasi)) {
    mkdir($target_dir_destinasi, 0777, true);
}
if (!is_dir($target_dir_izin)) {
    mkdir($target_dir_izin, 0777, true);
}

// Proses Foto
$filename_foto = $_FILES['foto_destinasi']['name'];
$ukuran_foto = $_FILES['foto_destinasi']['size'];
$ext_foto = pathinfo($filename_foto, PATHINFO_EXTENSION);

if (!in_array($ext_foto, $ekstensi)) {
    header("Location: ../../admin/admin.php?alert=gagal_ekstensi#destinasi");
    exit();
}
if ($ukuran_foto >= 1044070) {
    header("Location: ../../admin/admin.php?alert=gagal_ukuran#destinasi");
    exit();
}
$xx = $rand . '_' . $filename_foto;
move_uploaded_file($_FILES['foto_destinasi']['tmp_name'], $target_dir_destinasi . $xx);

// Proses Izin
$filename_izin = $_FILES['izin_destinasi']['name'];
$ukuran_izin = $_FILES['izin_destinasi']['size'];
$ext_izin = pathinfo($filename_izin, PATHINFO_EXTENSION);

if (!in_array($ext_izin, $ekstensi)) {
    header("Location: ../../admin/admin.php?alert=gagal_ekstensi#destinasi");
    exit();
}
if ($ukuran_izin >= 1044070) {
    header("Location: ../../admin/admin.php?alert=gagal_ukuran#destinasi");
    exit();
}
$yy = $rand . '_' . $filename_izin;
move_uploaded_file($_FILES['izin_destinasi']['tmp_name'], $target_dir_izin . $yy);

$query = "INSERT INTO destinasi (id_destinasi, nama_destinasi, nomor_destinasi, alamat_destinasi, deskripsi_destinasi, keterangan_destinasi, foto_destinasi, izin_destinasi) 
          VALUES ('$id_destinasi', '$nama_destinasi', '$nomor_destinasi', '$alamat_destinasi', '$deskripsi_destinasi', '$keterangan_destinasi', '$xx', '$yy')";

mysqli_query($koneksi, $query);

header("Location: ../../admin/admin.php#destinasi");
exit();
