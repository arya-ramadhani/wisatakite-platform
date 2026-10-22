<?php
// edit_profil.php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';

$page_title   = 'WisataKite - Ubah Profil';
$css_file     = 'profil.css';
$current_page = 'informasi';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';

$id_user = isset($_GET['id_user']) ? mysqli_real_escape_string($koneksi, $_GET['id_user']) : '';
$data    = mysqli_query($koneksi, "SELECT * FROM akun WHERE id_user = '$id_user'");
$d       = mysqli_fetch_assoc($data);
?>

<main class="daftarkan-container" role="main">
    <h2>Ubah Informasi Pribadi</h2>
    <p class="page-subtitle">Perbarui data profil akun Anda di bawah ini</p>

    <?php if ($d): ?>
        <form action="actions/user/edit_profil.php" method="POST" class="daftarkan-form">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars($d['nama_lengkap']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($d['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?php echo htmlspecialchars($d['tgl_lahir']); ?>" required>
            </div>

            <div class="form-group">
                <label for="agama">Agama</label>
                <input type="text" id="agama" name="agama" value="<?php echo htmlspecialchars($d['agama']); ?>" required>
            </div>

            <div class="form-group">
                <label for="nomor_wa">Nomor WhatsApp</label>
                <input type="tel" id="nomor_wa" name="nomor_wa" value="<?php echo htmlspecialchars($d['nomor_wa']); ?>" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="form-group">
                <label for="username">Username (Tidak dapat diubah)</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($d['username']); ?>" readonly style="background:#f1f5f9; cursor:not-allowed;">
            </div>

            <div class="form-group full">
                <label for="alamat">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($d['alamat']); ?></textarea>
            </div>

            <div class="form-group full">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($d['password']); ?>" required>
            </div>

            <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($d['id_user']); ?>">
            <input type="hidden" name="role" value="<?php echo htmlspecialchars($d['role']); ?>">

            <div class="form-actions">
                <button type="submit" class="btn btn-primary" style="flex: 2;">💾 Simpan Perubahan</button>
                <a href="informasi.php" class="btn btn-secondary" style="flex: 1;">Batal</a>
            </div>
        </form>
    <?php else: ?>
        <div class="alert alert-error">
            Data pengguna tidak ditemukan. <a href="informasi.php" style="text-decoration: underline; font-weight: 700;">Kembali ke Informasi Pribadi</a>
        </div>
    <?php endif; ?>
</main>

<?php
include __DIR__ . '/includes/footer.php';
?>