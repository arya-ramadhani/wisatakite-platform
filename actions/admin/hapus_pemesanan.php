<?php
// actions/admin/hapus_pemesanan.php
require_once __DIR__ . '/../../config/database.php';

if (isset($_GET['id_pemesan'])) {
    $id_pemesan = mysqli_real_escape_string($koneksi, $_GET['id_pemesan']);
    $sql = "DELETE FROM pemesanan WHERE id_pemesan='$id_pemesan'";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: ../../admin/admin.php#pemesanan");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("Location: ../../admin/admin.php#pemesanan");
    exit();
}
