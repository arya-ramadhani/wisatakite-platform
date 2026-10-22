<?php
// actions/admin/tambah_akun.php
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

$query = "INSERT INTO akun (id_user, username, password, role, nama_lengkap, email, tgl_lahir, agama, nomor_wa, alamat) 
          VALUES ('$id_user', '$username', '$password', '$role', '$nama_lengkap', '$email', '$tgl_lahir', '$agama', '$nomor_wa', '$alamat')";

mysqli_query($koneksi, $query);

header("Location: ../../admin/admin.php#akun");
exit();
