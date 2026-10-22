<?php
// actions/user/hapus_pemesanan.php
session_start();
require_once __DIR__ . '/../../config/database.php';

if (isset($_GET['id_pemesan'])) {
    $id_pemesan = mysqli_real_escape_string($koneksi, $_GET['id_pemesan']);
    $query = "DELETE FROM pemesanan WHERE id_pemesan = '$id_pemesan'";
    mysqli_query($koneksi, $query);

    header("Location: ../../histori.php?status=deleted");
    exit();
} else {
    header("Location: ../../histori.php");
    exit();
}
