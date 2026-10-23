<?php
// detail.php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';

$page_title   = 'WisataKite - Detail Destinasi';
$css_file     = 'detail.css';
$current_page = 'detail';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';
?>

<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$q_search = isset($_GET['q']) ? trim($_GET['q']) : (isset($_GET['search']) ? trim($_GET['search']) : '');

if ($id > 0) {
    $data = mysqli_query($koneksi, "SELECT * FROM destinasi WHERE keterangan_destinasi = 'Di Terima' AND id_destinasi = $id");
} elseif (!empty($q_search)) {
    $safe_q = mysqli_real_escape_string($koneksi, $q_search);
    $data = mysqli_query($koneksi, "SELECT * FROM destinasi WHERE keterangan_destinasi = 'Di Terima' AND (nama_destinasi LIKE '%$safe_q%' OR alamat_destinasi LIKE '%$safe_q%' OR deskripsi_destinasi LIKE '%$safe_q%')");
} else {
    $data = mysqli_query($koneksi, "SELECT * FROM destinasi WHERE keterangan_destinasi = 'Di Terima'");
}

$found_count = ($data) ? mysqli_num_rows($data) : 0;
?>

<main class="container-detail">
    <?php if ($id > 0 || !empty($q_search)): ?>
        <div style="margin-bottom: 24px; padding: 12px 18px; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
            <p style="margin: 0; color: #334155; font-size: 0.95rem;">
                <?php if ($found_count > 0): ?>
                    Menampilkan hasil: <strong><?php echo htmlspecialchars(!empty($q_search) ? $q_search : 'Destinasi Terpilih'); ?></strong> (<?php echo $found_count; ?> ditemukan)
                <?php else: ?>
                    Destinasi khusus "<strong><?php echo htmlspecialchars(!empty($q_search) ? $q_search : '#'.$id); ?></strong>" belum ada di database. Menampilkan seluruh destinasi tersedia:
                <?php endif; ?>
            </p>
            <a href="detail.php" class="go-button" style="padding: 7px 16px; font-size: 0.85rem;">&larr; Lihat Semua Destinasi</a>
        </div>
    <?php endif; ?>

    <?php
    // Jika filter spesifik tidak menghasilkan baris di database, tampilkan semua destinasi
    if ($found_count === 0 && ($id > 0 || !empty($q_search))) {
        $data = mysqli_query($koneksi, "SELECT * FROM destinasi WHERE keterangan_destinasi = 'Di Terima'");
    }

    while ($d = mysqli_fetch_assoc($data)):
    ?>
    <article class="dest-entry" id="dest-<?php echo $d['id_destinasi']; ?>">
        <!-- Image -->
        <div class="dest-img-wrap">
            <img
                src="assets/img/destinasi/<?php echo htmlspecialchars($d['foto_destinasi']); ?>"
                alt="<?php echo htmlspecialchars($d['nama_destinasi']); ?>"
            >
        </div>

        <!-- Info -->
        <div class="dest-info">
            <h2><?php echo htmlspecialchars($d['nama_destinasi']); ?></h2>

            <p class="dest-location"><?php echo htmlspecialchars($d['alamat_destinasi']); ?></p>

            <p class="dest-desc"><?php echo nl2br(htmlspecialchars($d['deskripsi_destinasi'])); ?></p>

            <a
                href="https://wa.me/<?php echo htmlspecialchars($d['nomor_destinasi']); ?>/"
                class="dest-contact"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Hubungi via WhatsApp"
            >
                <img src="assets/img/wa.ico" alt="WhatsApp" style="width:20px;height:20px;">
                +62<?php echo htmlspecialchars($d['nomor_destinasi']); ?>
            </a>

            <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                echo '<a class="go-button" href="pemesanan.php">Pesan Sekarang 🗓️</a>';
            } else {
                echo '<a class="go-button" href="login.php" onclick="return confirm(\'Silahkan masuk terlebih dahulu\')">Pesan Sekarang 🗓️</a>';
            }
            ?>
        </div>
    </article>
    <?php endwhile; ?>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>