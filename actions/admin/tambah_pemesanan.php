<?php
// actions/admin/tambah_pemesanan.php
require_once __DIR__ . '/../../config/database.php';

$nama_pemesan = isset($_POST['nama_pemesan']) ? mysqli_real_escape_string($koneksi, $_POST['nama_pemesan']) : '';
$nomor_pemesan = isset($_POST['nomor_pemesan']) ? mysqli_real_escape_string($koneksi, $_POST['nomor_pemesan']) : '';
$checkin = isset($_POST['checkin']) ? $_POST['checkin'] : '';
$checkout = isset($_POST['checkout']) ? $_POST['checkout'] : '';
$dewasa = isset($_POST['dewasa']) ? (int)$_POST['dewasa'] : 0;
$anak = isset($_POST['anak']) ? (int)$_POST['anak'] : 0;
$permintaan = isset($_POST['permintaan']) ? mysqli_real_escape_string($koneksi, $_POST['permintaan']) : '';
$keterangan_pemesanan = isset($_POST['keterangan_pemesanan']) ? mysqli_real_escape_string($koneksi, $_POST['keterangan_pemesanan']) : '';
$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : '';

$query = "INSERT INTO pemesanan (nama_pemesan, nomor_pemesan, checkin, checkout, dewasa, anak, permintaan, keterangan_pemesanan, id_user) 
          VALUES ('$nama_pemesan', '$nomor_pemesan', '$checkin', '$checkout', '$dewasa', '$anak', '$permintaan', '$keterangan_pemesanan', '$id_user')";

mysqli_query($koneksi, $query);

header("Location: ../../admin/admin.php#pemesanan");
exit();
