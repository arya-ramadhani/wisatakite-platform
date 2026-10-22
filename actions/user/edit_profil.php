<?php
// actions/user/edit_profil.php
session_start();
require_once __DIR__ . '/../../config/database.php';

$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : '';
$username = isset($_POST['username']) ? mysqli_real_escape_string($koneksi, $_POST['username']) : '';
$password = isset($_POST['password']) ? mysqli_real_escape_string($koneksi, $_POST['password']) : '';
$role = isset($_POST['role']) ? $_POST['role'] : '0';
$nama_lengkap = isset($_POST['nama_lengkap']) ? mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($koneksi, $_POST['email']) : '';
$tgl_lahir = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : '';
$agama = isset($_POST['agama']) ? mysqli_real_escape_string($koneksi, $_POST['agama']) : '';
$nomor_wa = isset($_POST['nomor_wa']) ? mysqli_real_escape_string($koneksi, $_POST['nomor_wa']) : '';
$alamat = isset($_POST['alamat']) ? mysqli_real_escape_string($koneksi, $_POST['alamat']) : '';

$sql = "UPDATE akun 
        SET username='$username', password='$password', role='$role', 
            nama_lengkap='$nama_lengkap', email='$email', tgl_lahir='$tgl_lahir', 
            agama='$agama', nomor_wa='$nomor_wa', alamat='$alamat'
        WHERE id_user='$id_user'";

$query = mysqli_query($koneksi, $sql);

if ($query) {
    if (isset($_SESSION['username'])) {
        $_SESSION['username'] = $username;
    }
    header("Location: ../../informasi.php?status=updated");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
