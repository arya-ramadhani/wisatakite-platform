<?php
// actions/admin/data_aksi.php
require_once __DIR__ . '/../../config/database.php';

// INFORMASI PRIBADI
$sql_informasi = "SELECT COUNT(*) AS total_informasi FROM akun";
$result_informasi = mysqli_query($koneksi, $sql_informasi);
$total_informasi = 0;
if ($result_informasi) {
    $row_informasi = mysqli_fetch_assoc($result_informasi);
    $total_informasi = $row_informasi["total_informasi"];
}

// AKUN
$sql_admin = "SELECT COUNT(*) AS total_admin FROM akun WHERE role = '1'";
$result_admin = mysqli_query($koneksi, $sql_admin);
$total_admin = 0;
if ($result_admin) {
    $row_admin = mysqli_fetch_assoc($result_admin);
    $total_admin = $row_admin["total_admin"];
}

$sql_user = "SELECT COUNT(*) AS total_user FROM akun WHERE role = '0'";
$result_user = mysqli_query($koneksi, $sql_user);
$total_user = 0;
if ($result_user) {
    $row_user = mysqli_fetch_assoc($result_user);
    $total_user = $row_user["total_user"];
}
$total_akun = $total_admin + $total_user;

// DESTINASI WISATA
$sql_destinasi_masuk = "SELECT COUNT(*) AS total_destinasi_masuk FROM destinasi WHERE keterangan_destinasi = 'Masuk'";
$result_destinasi_masuk = mysqli_query($koneksi, $sql_destinasi_masuk);
$total_destinasi_masuk = 0;
if ($result_destinasi_masuk) {
    $row_destinasi_masuk = mysqli_fetch_assoc($result_destinasi_masuk);
    $total_destinasi_masuk = $row_destinasi_masuk["total_destinasi_masuk"];
}

$sql_destinasi_diterima = "SELECT COUNT(*) AS total_destinasi_diterima FROM destinasi WHERE keterangan_destinasi = 'Di Terima'";
$result_destinasi_diterima = mysqli_query($koneksi, $sql_destinasi_diterima);
$total_destinasi_diterima = 0;
if ($result_destinasi_diterima) {
    $row_destinasi_diterima = mysqli_fetch_assoc($result_destinasi_diterima);
    $total_destinasi_diterima = $row_destinasi_diterima["total_destinasi_diterima"];
}
$total_destinasi = $total_destinasi_masuk + $total_destinasi_diterima;

// PEMESANAN
$sql_pemesanan_pantai = "SELECT COUNT(*) AS total_pemesanan_pantai FROM pemesanan WHERE keterangan_pemesanan = 'Pantai'";
$result_pemesanan_pantai = mysqli_query($koneksi, $sql_pemesanan_pantai);
$total_pemesanan_pantai = 0;
if ($result_pemesanan_pantai) {
    $row_pemesanan_pantai = mysqli_fetch_assoc($result_pemesanan_pantai);
    $total_pemesanan_pantai = $row_pemesanan_pantai["total_pemesanan_pantai"];
}

$sql_pemesanan_pulau = "SELECT COUNT(*) AS total_pemesanan_pulau FROM pemesanan WHERE keterangan_pemesanan = 'Pulau'";
$result_pemesanan_pulau = mysqli_query($koneksi, $sql_pemesanan_pulau);
$total_pemesanan_pulau = 0;
if ($result_pemesanan_pulau) {
    $row_pemesanan_pulau = mysqli_fetch_assoc($result_pemesanan_pulau);
    $total_pemesanan_pulau = $row_pemesanan_pulau["total_pemesanan_pulau"];
}

$sql_pemesanan_sejarah = "SELECT COUNT(*) AS total_pemesanan_sejarah FROM pemesanan WHERE keterangan_pemesanan = 'Sejarah'";
$result_pemesanan_sejarah = mysqli_query($koneksi, $sql_pemesanan_sejarah);
$total_pemesanan_sejarah = 0;
if ($result_pemesanan_sejarah) {
    $row_pemesanan_sejarah = mysqli_fetch_assoc($result_pemesanan_sejarah);
    $total_pemesanan_sejarah = $row_pemesanan_sejarah["total_pemesanan_sejarah"];
}
$total_pemesanan = $total_pemesanan_pantai + $total_pemesanan_pulau + $total_pemesanan_sejarah;
