<?php
// config/database.php
// Konfigurasi koneksi database MySQL

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "wisata_kite";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
