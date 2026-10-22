<?php
// actions/admin/edit_destinasi.php
require_once __DIR__ . '/../../config/database.php';

$id_destinasi = isset($_POST['id_destinasi']) ? $_POST['id_destinasi'] : '';
$nama_destinasi = isset($_POST['nama_destinasi']) ? mysqli_real_escape_string($koneksi, $_POST['nama_destinasi']) : '';
$nomor_destinasi = isset($_POST['nomor_destinasi']) ? mysqli_real_escape_string($koneksi, $_POST['nomor_destinasi']) : '';
$alamat_destinasi = isset($_POST['alamat_destinasi']) ? mysqli_real_escape_string($koneksi, $_POST['alamat_destinasi']) : '';
$deskripsi_destinasi = isset($_POST['deskripsi_destinasi']) ? mysqli_real_escape_string($koneksi, $_POST['deskripsi_destinasi']) : '';
$keterangan_destinasi = isset($_POST['keterangan_destinasi']) ? mysqli_real_escape_string($koneksi, $_POST['keterangan_destinasi']) : '';

$foto_destinasi = isset($_FILES['foto_destinasi']['name']) ? $_FILES['foto_destinasi']['name'] : '';
$izin_destinasi = isset($_FILES['izin_destinasi']['name']) ? $_FILES['izin_destinasi']['name'] : '';

$ekstensi = array('png', 'jpg', 'jpeg', 'gif', 'pdf', 'JPG');
$target_dir_destinasi = __DIR__ . '/../../assets/img/destinasi/';
$target_dir_izin = __DIR__ . '/../../assets/img/izin_destinasi/';

// Periksa apakah ada file foto baru diunggah
if (!empty($foto_destinasi)) {
    $rand = rand();
    $ukuran = $_FILES['foto_destinasi']['size'];
    $ext = pathinfo($foto_destinasi, PATHINFO_EXTENSION);

    if (!in_array($ext, $ekstensi)) {
        header("Location: ../../admin/admin.php?alert=gagal_ekstensi#destinasi");
        exit();
    } elseif ($ukuran >= 1044070) {
        header("Location: ../../admin/admin.php?alert=gagal_ukuran#destinasi");
        exit();
    } else {
        $xx = $rand . '_' . $foto_destinasi;
        move_uploaded_file($_FILES['foto_destinasi']['tmp_name'], $target_dir_destinasi . $xx);
    }
} else {
    $xx = isset($_POST['existing_foto']) ? $_POST['existing_foto'] : '';
}

// Periksa apakah ada file izin baru diunggah
if (!empty($izin_destinasi)) {
    $rand_izin = rand();
    $ukuran_izin = $_FILES['izin_destinasi']['size'];
    $ext_izin = pathinfo($izin_destinasi, PATHINFO_EXTENSION);

    if (!in_array($ext_izin, $ekstensi)) {
        header("Location: ../../admin/admin.php?alert=gagal_ekstensi_izin#destinasi");
        exit();
    } elseif ($ukuran_izin >= 1044070) {
        header("Location: ../../admin/admin.php?alert=gagal_ukuran_izin#destinasi");
        exit();
    } else {
        $yy = $rand_izin . '_' . $izin_destinasi;
        move_uploaded_file($_FILES['izin_destinasi']['tmp_name'], $target_dir_izin . $yy);
    }
} else {
    $yy = isset($_POST['existing_izin']) ? $_POST['existing_izin'] : '';
}

$sql = "UPDATE destinasi 
        SET nama_destinasi='$nama_destinasi', nomor_destinasi='$nomor_destinasi', 
            alamat_destinasi='$alamat_destinasi', deskripsi_destinasi='$deskripsi_destinasi', 
            keterangan_destinasi='$keterangan_destinasi', foto_destinasi='$xx', izin_destinasi='$yy'
        WHERE id_destinasi='$id_destinasi'";

$query = mysqli_query($koneksi, $sql);

if ($query) {
    header("Location: ../../admin/admin.php#destinasi");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
