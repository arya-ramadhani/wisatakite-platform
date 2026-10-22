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

<main class="container-detail">
    <?php
    $data = mysqli_query($koneksi, "SELECT * FROM destinasi WHERE keterangan_destinasi = 'Di Terima'");
    while ($d = mysqli_fetch_assoc($data)):
    ?>
    <article class="dest-entry">
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