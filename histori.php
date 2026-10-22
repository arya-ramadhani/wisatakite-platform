<?php
// histori.php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';

$page_title   = 'WisataKite - Histori Pemesanan';
$css_file     = 'profil.css';
$current_page = 'histori';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';
?>

<main class="daftarkan-container" role="main">
    <h2>Histori Pemesanan</h2>
    <p class="page-subtitle">Daftar reservasi wisata yang telah Anda lakukan</p>

    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] === 'deleted'): ?>
            <div class="alert alert-success" role="alert">
                ✓ Riwayat pemesanan berhasil dihapus!
            </div>
        <?php elseif ($_GET['status'] === 'success'): ?>
            <div class="alert alert-success" role="alert">
                ✓ Pemesanan wisata berhasil dikirim! Silakan periksa detail reservasi Anda di bawah ini.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    if (isset($_SESSION['username'])) {
        $username = mysqli_real_escape_string($koneksi, $_SESSION['username']);

        $query = "SELECT p.id_pemesan, p.nama_pemesan, p.nomor_pemesan, p.checkin, p.checkout, p.dewasa, p.anak, p.permintaan, p.keterangan_pemesanan
                  FROM pemesanan AS p
                  INNER JOIN akun AS a ON p.id_user = a.id_user
                  WHERE a.username = '$username'
                  ORDER BY p.id_pemesan DESC";

        $result = mysqli_query($koneksi, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo '<div class="booking-list">';
            while ($d = mysqli_fetch_assoc($result)) {
                $kat = strtolower($d['keterangan_pemesanan']);
                $badge_class = 'badge-pantai';
                if ($kat === 'pulau') {
                    $badge_class = 'badge-pulau';
                } elseif ($kat === 'sejarah') {
                    $badge_class = 'badge-sejarah';
                }
    ?>
                <article class="booking-card">
                    <div class="booking-card-header">
                        <div class="booking-id">
                            🎫 Reservasi #<?php echo htmlspecialchars($d['id_pemesan']); ?>
                        </div>
                        <span class="booking-badge <?php echo $badge_class; ?>">
                            <?php echo htmlspecialchars($d['keterangan_pemesanan'] ?: 'Wisata'); ?>
                        </span>
                    </div>

                    <div class="booking-card-body">
                        <div class="booking-item">
                            <span class="booking-item-label">Nama Pemesan</span>
                            <span class="booking-item-value"><?php echo htmlspecialchars($d['nama_pemesan']); ?></span>
                        </div>

                        <div class="booking-item">
                            <span class="booking-item-label">Kontak WhatsApp</span>
                            <span class="booking-item-value"><?php echo htmlspecialchars($d['nomor_pemesan']); ?></span>
                        </div>

                        <div class="booking-item">
                            <span class="booking-item-label">Tanggal Check-In</span>
                            <span class="booking-item-value">📅 <?php echo htmlspecialchars($d['checkin']); ?></span>
                        </div>

                        <div class="booking-item">
                            <span class="booking-item-label">Tanggal Check-Out</span>
                            <span class="booking-item-value">📅 <?php echo htmlspecialchars($d['checkout']); ?></span>
                        </div>

                        <div class="booking-item">
                            <span class="booking-item-label">Jumlah Tamu</span>
                            <span class="booking-item-value">
                                👥 <?php echo (int)$d['dewasa']; ?> Dewasa<?php if ((int)$d['anak'] > 0) echo ', ' . (int)$d['anak'] . ' Anak'; ?>
                            </span>
                        </div>

                        <div class="booking-item">
                            <span class="booking-item-label">Permintaan Khusus</span>
                            <span class="booking-item-value"><?php echo htmlspecialchars($d['permintaan'] ?: '-'); ?></span>
                        </div>
                    </div>

                    <div class="booking-card-footer">
                        <a href="actions/user/hapus_pemesanan.php?id_pemesan=<?php echo urlencode($d['id_pemesan']); ?>" 
                           class="btn-danger-outline"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus data pemesanan #<?php echo htmlspecialchars($d['id_pemesan']); ?>?')">
                            🗑️ Hapus Pemesanan
                        </a>
                    </div>
                </article>
    <?php
            }
            echo '</div>';
        } else {
    ?>
            <div class="empty-state">
                <div class="empty-state-icon">🏖️</div>
                <h3>Belum Ada Riwayat Pemesanan</h3>
                <p>Anda belum memiliki pemesanan aktif. Jelajahi berbagai destinasi menarik dan lakukan reservasi sekarang!</p>
                <a href="pemesanan.php" class="btn btn-primary">Pesan Destinasi Sekarang</a>
            </div>
    <?php
        }
    } else {
    ?>
        <div class="empty-state">
            <div class="empty-state-icon">🔒</div>
            <h3>Masuk Terlebih Dahulu</h3>
            <p>Silakan masuk ke akun Anda untuk melihat riwayat pemesanan yang pernah Anda lakukan.</p>
            <a href="login.php" class="btn btn-primary">Masuk ke Akun</a>
        </div>
    <?php
    }
    ?>
</main>

<?php
include __DIR__ . '/includes/footer.php';
?>