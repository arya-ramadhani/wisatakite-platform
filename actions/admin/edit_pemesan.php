<?php
// actions/admin/edit_pemesan.php
require_once __DIR__ . '/../../config/database.php';

$id_pemesan = isset($_POST['id_pemesan']) ? $_POST['id_pemesan'] : '';
$nama_pemesan = isset($_POST['nama_pemesan']) ? mysqli_real_escape_string($koneksi, $_POST['nama_pemesan']) : '';
$nomor_pemesan = isset($_POST['nomor_pemesan']) ? mysqli_real_escape_string($koneksi, $_POST['nomor_pemesan']) : '';
$checkin = isset($_POST['checkin']) ? $_POST['checkin'] : '';
$checkout = isset($_POST['checkout']) ? $_POST['checkout'] : '';
$dewasa = isset($_POST['dewasa']) ? (int)$_POST['dewasa'] : 0;
$anak = isset($_POST['anak']) ? (int)$_POST['anak'] : 0;
$permintaan = isset($_POST['permintaan']) ? mysqli_real_escape_string($koneksi, $_POST['permintaan']) : '';
$keterangan_pemesanan = isset($_POST['keterangan_pemesanan']) ? mysqli_real_escape_string($koneksi, $_POST['keterangan_pemesanan']) : '';
$id_user = isset($_POST['id_user']) ? $_POST['id_user'] : '';

$sql = "UPDATE pemesanan 
        SET nama_pemesan='$nama_pemesan', nomor_pemesan='$nomor_pemesan', 
            checkin='$checkin', checkout='$checkout', dewasa='$dewasa', 
            anak='$anak', permintaan='$permintaan', 
            keterangan_pemesanan='$keterangan_pemesanan', id_user='$id_user'
        WHERE id_pemesan='$id_pemesan'";

$query = mysqli_query($koneksi, $sql);

if ($query) {
    header("Location: ../../admin/admin.php#pemesanan");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
