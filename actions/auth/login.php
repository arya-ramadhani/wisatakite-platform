<?php
// actions/auth/login.php
session_start();
require_once __DIR__ . '/../../config/database.php';

// Mendapatkan nilai inputan dari form login
$username = isset($_POST['username']) ? mysqli_real_escape_string($koneksi, $_POST['username']) : '';
$password = isset($_POST['password']) ? mysqli_real_escape_string($koneksi, $_POST['password']) : '';

// Mengecek apakah pengguna ada di database
$sql = "SELECT * FROM akun WHERE username='$username' AND password='$password'";
$query = mysqli_query($koneksi, $sql);

if ($query && mysqli_num_rows($query) == 1) {
    $row = mysqli_fetch_assoc($query);
    
    $_SESSION['username'] = $row['username'];
    $_SESSION['id_pemesan'] = isset($row['id_pemesan']) ? $row['id_pemesan'] : null;
    $_SESSION['logged_in'] = true;
    $_SESSION['id_user'] = $row['id_user'];
    $_SESSION['role'] = (string)$row['role'];

    // Jika pengguna adalah admin (role 1)
    if ($row['role'] == 1) {
        header("Location: ../../admin/admin.php");
        exit();
    } else {
        header("Location: ../../index.php");
        exit();
    }
} else {
    // Jika login gagal
    header("Location: ../../login.php?error=1");
    exit();
}
