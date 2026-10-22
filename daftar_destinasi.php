<?php
// daftar_destinasi.php
require_once __DIR__ . '/config/app.php';

$page_title   = 'WisataKite - Daftarkan Destinasi';
$css_file     = 'profil.css';
$current_page = 'daftar_destinasi';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';
?>

<main class="daftarkan-container" role="main">
    <h2>Daftarkan Destinasi</h2>
    <p class="page-subtitle">Ajukan objek wisata baru untuk ditampilkan di platform WisataKite</p>

    <?php if (isset($_GET['alert'])): ?>
        <?php if ($_GET['alert'] === 'berhasil'): ?>
            <div class="alert alert-success" role="alert">
                ✓ Destinasi berhasil diajukan dan sedang menunggu verifikasi oleh tim admin!
            </div>
        <?php elseif ($_GET['alert'] === 'gagal_ekstensi'): ?>
            <div class="alert alert-error" role="alert">
                Format berkas tidak didukung! Harap gunakan format PNG, JPG, JPEG, atau PDF.
            </div>
        <?php elseif ($_GET['alert'] === 'gagal_ukuran'): ?>
            <div class="alert alert-error" role="alert">
                Ukuran berkas terlalu besar! Maksimal ukuran file adalah 1 MB.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <form action="actions/user/daftar_destinasi.php" method="POST" class="daftarkan-form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama_destinasi">Nama Destinasi</label>
            <input type="text" id="nama_destinasi" name="nama_destinasi" placeholder="Contoh: Pantai Punggur Tuing" required>
        </div>

        <div class="form-group">
            <label for="nomor_destinasi">Nomor WhatsApp Pengelola</label>
            <input type="tel" id="nomor_destinasi" name="nomor_destinasi" placeholder="08xxxxxxxxxx" required>
        </div>

        <div class="form-group">
            <label for="foto_destinasi">Foto Destinasi Utama</label>
            <input type="file" id="foto_destinasi" name="foto_destinasi" accept=".jpg,.jpeg,.png" required>
            <small style="color:var(--clr-muted); font-size:0.75rem;">Format JPG/PNG, maks 1MB</small>
        </div>

        <div class="form-group">
            <label for="izin_destinasi">Surat Izin / Dokumen Pendukung</label>
            <input type="file" id="izin_destinasi" name="izin_destinasi" accept=".jpg,.jpeg,.png,.pdf" required>
            <small style="color:var(--clr-muted); font-size:0.75rem;">Format PDF/JPG/PNG, maks 1MB</small>
        </div>

        <div class="form-group full">
            <label for="alamat_destinasi">Alamat Lengkap Destinasi</label>
            <textarea id="alamat_destinasi" name="alamat_destinasi" rows="3" placeholder="Masukkan alamat lengkap destinasi..." required></textarea>
        </div>

        <div class="form-group full">
            <label for="deskripsi_destinasi">Deskripsi Destinasi</label>
            <textarea id="deskripsi_destinasi" name="deskripsi_destinasi" rows="4" placeholder="Ceritakan daya tarik, fasilitas, dan keunikan destinasi ini..." required></textarea>
        </div>

        <input type="hidden" id="id_destinasi" name="id_destinasi" value="">
        <input type="hidden" id="keterangan_destinasi" name="keterangan_destinasi" value="Masuk">

        <button type="submit" class="btn btn-primary btn-full">
            📤 Ajukan Destinasi Wisata
        </button>
    </form>
</main>

<?php
include __DIR__ . '/includes/footer.php';
?>