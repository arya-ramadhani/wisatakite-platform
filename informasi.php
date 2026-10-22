<?php
// informasi.php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';

$page_title   = 'WisataKite - Informasi Pribadi';
$css_file     = 'profil.css';
$current_page = 'informasi';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';
?>

<main class="daftarkan-container" role="main">
    <h2>Informasi Pribadi</h2>
    <p class="page-subtitle">Kelola dan tinjau data profil akun Anda</p>

    <?php if (isset($_GET['status']) && $_GET['status'] === 'updated'): ?>
        <div class="alert alert-success" role="alert">
            ✓ Data profil Anda berhasil diperbarui!
        </div>
    <?php endif; ?>

    <?php
    if (isset($_SESSION['username'])) {
        $username = mysqli_real_escape_string($koneksi, $_SESSION['username']);
        $data = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '$username'");
        if ($d = mysqli_fetch_assoc($data)) {
            $initial = strtoupper(substr($d['nama_lengkap'] ?: $d['username'], 0, 1));
    ?>
            <div class="info-user-card">
                <div class="info-user-avatar" aria-hidden="true"><?php echo htmlspecialchars($initial); ?></div>
                <div class="info-user-meta">
                    <h3><?php echo htmlspecialchars($d['nama_lengkap'] ?: $d['username']); ?></h3>
                    <p>@<?php echo htmlspecialchars($d['username']); ?> &bull; <?php echo $d['role'] === '1' ? 'Administrator' : 'Pengguna WisataKite'; ?></p>
                </div>
            </div>

            <div class="daftarkan-form">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="kolom"><?php echo htmlspecialchars($d['nama_lengkap'] ?: '-'); ?></div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <div class="kolom"><?php echo htmlspecialchars($d['email'] ?: '-'); ?></div>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <div class="kolom"><?php echo htmlspecialchars($d['tgl_lahir'] ?: '-'); ?></div>
                </div>

                <div class="form-group">
                    <label>Agama</label>
                    <div class="kolom"><?php echo htmlspecialchars($d['agama'] ?: '-'); ?></div>
                </div>

                <div class="form-group">
                    <label>Nomor WhatsApp</label>
                    <div class="kolom"><?php echo htmlspecialchars($d['nomor_wa'] ?: '-'); ?></div>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <div class="kolom"><?php echo htmlspecialchars($d['username']); ?></div>
                </div>

                <div class="form-group full">
                    <label>Alamat Lengkap</label>
                    <div class="kolom"><?php echo htmlspecialchars($d['alamat'] ?: '-'); ?></div>
                </div>

                <div class="form-group full">
                    <label>Kata Sandi</label>
                    <div class="kolom">••••••••••••</div>
                </div>

                <div class="form-actions">
                    <a href="edit_profil.php?id_user=<?php echo urlencode($d['id_user']); ?>" class="btn btn-primary" style="width: 100%;">
                        ✏️ Ubah Informasi Pribadi
                    </a>
                </div>
            </div>
    <?php
        } else {
            echo '<div class="alert alert-error">Data profil tidak ditemukan dalam sistem.</div>';
        }
    } else {
    ?>
        <div class="empty-state">
            <div class="empty-state-icon">🔒</div>
            <h3>Akses Terbatas</h3>
            <p>Silakan masuk ke akun Anda terlebih dahulu untuk melihat dan mengelola informasi pribadi.</p>
            <a href="login.php" class="btn btn-primary">Masuk Sekarang</a>
        </div>
    <?php
    }
    ?>
</main>

<?php
include __DIR__ . '/includes/footer.php';
?>