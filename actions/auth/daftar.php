<?php
// actions/auth/daftar.php
require_once __DIR__ . '/../../config/database.php';

// Menangkap data dari form registrasi
$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$role = isset($_POST['role']) ? $_POST['role'] : '0';
$nama_lengkap = isset($_POST['nama_lengkap']) ? $_POST['nama_lengkap'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$tgl_lahir = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : '';
$agama = isset($_POST['agama']) ? $_POST['agama'] : '';
$nomor_wa = isset($_POST['nomor_wa']) ? $_POST['nomor_wa'] : '';
$alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';

// Insert data ke tabel akun
$query = "INSERT INTO akun (id_user, username, password, role, nama_lengkap, email, tgl_lahir, agama, nomor_wa, alamat) 
          VALUES ('$id_user', '$username', '$password', '$role', '$nama_lengkap', '$email', '$tgl_lahir', '$agama', '$nomor_wa', '$alamat')";

mysqli_query($koneksi, $query);

// Redirect kembali ke login
header("Location: ../../login.php?status=registered");
exit();
