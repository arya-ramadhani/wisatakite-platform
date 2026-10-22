<?php
// actions/admin/hapus_akun.php
require_once __DIR__ . '/../../config/database.php';

if (isset($_GET['id_user'])) {
    $id_user = mysqli_real_escape_string($koneksi, $_GET['id_user']);
    $sql = "DELETE FROM akun WHERE id_user='$id_user'";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: ../../admin/admin.php#akun");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("Location: ../../admin/admin.php#akun");
    exit();
}
