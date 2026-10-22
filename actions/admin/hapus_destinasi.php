<?php
// actions/admin/hapus_destinasi.php
require_once __DIR__ . '/../../config/database.php';

if (isset($_GET['id_destinasi'])) {
    $id_destinasi = mysqli_real_escape_string($koneksi, $_GET['id_destinasi']);
    $sql = "DELETE FROM destinasi WHERE id_destinasi='$id_destinasi'";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: ../../admin/admin.php#destinasi");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    header("Location: ../../admin/admin.php#destinasi");
    exit();
}
