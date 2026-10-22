<?php
// admin/tambah_destinasi.php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== '1') {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Destinasi - WisataKite Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="admin-subpage-wrapper">
    <div class="admin-form-card">
        <div class="admin-form-header">
            <h2>➕ Tambah Destinasi Wisata</h2>
            <a href="admin.php#destinasi" class="admin-back-btn">← Kembali</a>
        </div>

        <form action="../actions/admin/tambah_destinasi.php" method="POST" class="daftarkan-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_destinasi">Nama Destinasi</label>
                <input type="text" id="nama_destinasi" name="nama_destinasi" placeholder="Contoh: Pantai Tanjung Tinggi" required>
            </div>

            <div class="form-group">
                <label for="nomor_destinasi">Nomor WhatsApp Pengelola</label>
                <input type="tel" id="nomor_destinasi" name="nomor_destinasi" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="form-group">
                <label for="foto_destinasi">Foto Destinasi</label>
                <input type="file" id="foto_destinasi" name="foto_destinasi" accept=".jpg,.jpeg,.png,.gif" required>
                <small style="color:var(--clr-muted); font-size:0.75rem;">Maks 1MB, format JPG/PNG</small>
            </div>

            <div class="form-group">
                <label for="izin_destinasi">Surat Izin / Berkas Pendukung</label>
                <input type="file" id="izin_destinasi" name="izin_destinasi" accept=".jpg,.jpeg,.png,.pdf" required>
                <small style="color:var(--clr-muted); font-size:0.75rem;">Maks 1MB, format PDF/JPG/PNG</small>
            </div>

            <div class="form-group full">
                <label for="alamat_destinasi">Alamat Lengkap Destinasi</label>
                <textarea id="alamat_destinasi" name="alamat_destinasi" rows="3" placeholder="Alamat lengkap..." required></textarea>
            </div>

            <div class="form-group full">
                <label for="deskripsi_destinasi">Deskripsi Destinasi</label>
                <textarea id="deskripsi_destinasi" name="deskripsi_destinasi" rows="4" placeholder="Deskripsi daya tarik wisata..." required></textarea>
            </div>

            <input type="hidden" name="id_destinasi" value="">
            <input type="hidden" name="keterangan_destinasi" value="Di Terima">

            <div class="form-actions full" style="display:flex; gap:12px; width:100%; margin-top:12px;">
                <button type="submit" class="btn btn-primary" style="flex:2;">💾 Simpan Destinasi</button>
                <a href="admin.php#destinasi" class="btn btn-secondary" style="flex:1;">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>