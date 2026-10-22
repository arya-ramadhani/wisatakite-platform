<?php
// admin/edit_destinasi.php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== '1') {
    header('Location: ../login.php');
    exit();
}

require_once __DIR__ . '/../config/database.php';

$id_destinasi = isset($_GET['id_destinasi']) ? mysqli_real_escape_string($koneksi, $_GET['id_destinasi']) : '';
$data         = mysqli_query($koneksi, "SELECT * FROM destinasi WHERE id_destinasi='$id_destinasi'");
$d            = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Destinasi - WisataKite Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="admin-subpage-wrapper">
    <div class="admin-form-card">
        <div class="admin-form-header">
            <h2>✏️ Edit Destinasi Wisata</h2>
            <a href="admin.php#destinasi" class="admin-back-btn">← Kembali</a>
        </div>

        <?php if ($d): ?>
            <form action="../actions/admin/edit_destinasi.php" method="POST" class="daftarkan-form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_destinasi">Nama Destinasi</label>
                    <input type="text" id="nama_destinasi" name="nama_destinasi" value="<?php echo htmlspecialchars($d['nama_destinasi']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="nomor_destinasi">Nomor WhatsApp Pengelola</label>
                    <input type="tel" id="nomor_destinasi" name="nomor_destinasi" value="<?php echo htmlspecialchars($d['nomor_destinasi']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="foto_destinasi">Foto Destinasi (Unggah jika ingin ganti)</label>
                    <input type="file" id="foto_destinasi" name="foto_destinasi" accept=".jpg,.jpeg,.png,.gif">
                    <?php if (!empty($d['foto_destinasi'])): ?>
                        <div style="margin-top:6px; display:flex; align-items:center; gap:8px;">
                            <img src="../assets/img/destinasi/<?php echo htmlspecialchars($d['foto_destinasi']); ?>" alt="Foto saat ini" style="width:50px;height:38px;object-fit:cover;border-radius:4px;">
                            <span style="font-size:0.75rem;color:var(--clr-muted);">Foto saat ini: <?php echo htmlspecialchars($d['foto_destinasi']); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="izin_destinasi">Dokumen Izin (Unggah jika ingin ganti)</label>
                    <input type="file" id="izin_destinasi" name="izin_destinasi" accept=".jpg,.jpeg,.png,.pdf">
                    <?php if (!empty($d['izin_destinasi'])): ?>
                        <div style="margin-top:6px;">
                            <a href="../assets/img/izin_destinasi/<?php echo htmlspecialchars($d['izin_destinasi']); ?>" target="_blank" style="font-size:0.75rem;color:var(--clr-blue);text-decoration:underline;">
                                📄 Lihat berkas saat ini
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="keterangan_destinasi">Status Pengajuan / Verifikasi</label>
                    <select id="keterangan_destinasi" name="keterangan_destinasi" required>
                        <option value="Masuk" <?php echo $d['keterangan_destinasi'] === 'Masuk' ? 'selected' : ''; ?>>Masuk (Menunggu Verifikasi)</option>
                        <option value="Di Terima" <?php echo $d['keterangan_destinasi'] === 'Di Terima' ? 'selected' : ''; ?>>Di Terima (Aktif / Disetujui)</option>
                    </select>
                </div>

                <div class="form-group full">
                    <label for="alamat_destinasi">Alamat Lengkap</label>
                    <textarea id="alamat_destinasi" name="alamat_destinasi" rows="3" required><?php echo htmlspecialchars($d['alamat_destinasi']); ?></textarea>
                </div>

                <div class="form-group full">
                    <label for="deskripsi_destinasi">Deskripsi Destinasi</label>
                    <textarea id="deskripsi_destinasi" name="deskripsi_destinasi" rows="4" required><?php echo htmlspecialchars($d['deskripsi_destinasi']); ?></textarea>
                </div>

                <input type="hidden" name="id_destinasi" value="<?php echo htmlspecialchars($d['id_destinasi']); ?>">
                <input type="hidden" name="existing_foto" value="<?php echo htmlspecialchars($d['foto_destinasi']); ?>">
                <input type="hidden" name="existing_izin" value="<?php echo htmlspecialchars($d['izin_destinasi']); ?>">

                <div class="form-actions full" style="display:flex; gap:12px; width:100%; margin-top:12px;">
                    <button type="submit" class="btn btn-primary" style="flex:2;">💾 Simpan Perubahan</button>
                    <a href="admin.php#destinasi" class="btn btn-secondary" style="flex:1;">Batal</a>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-error">Data destinasi tidak ditemukan. <a href="admin.php#destinasi">Kembali</a></div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>