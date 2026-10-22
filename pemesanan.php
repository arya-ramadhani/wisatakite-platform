<?php
// pemesanan.php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';

$page_title   = 'WisataKite - Pemesanan';
$css_file     = 'pemesanan.css';
$current_page = 'pemesanan';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';
?>

<main class="main-content" aria-label="Form pemesanan">

    <!-- Left: destination preview -->
    <section class="left-section">
        <img src="assets/img/pagoda_nusantara.png" alt="Pagoda Nusantara">
        <div class="description">
            <p>Pagoda Nusantara memiliki arsitektur khas Tionghoa yang mencerminkan warisan budaya dan keagamaan komunitas Tionghoa di Indonesia. Pagoda ini berdiri megah dengan beberapa tingkat yang semakin mengecil ke atas, menciptakan bentuk yang anggun dan menarik perhatian.</p>
        </div>
    </section>

    <!-- Right: booking form -->
    <section class="right-section">
        <h2>🗓️ Lakukan Pemesanan</h2>

        <form class="daftarkan-form" action="actions/user/pemesanan.php" method="post">
            <?php
            if (isset($_SESSION['username'])) {
                $username = mysqli_real_escape_string($koneksi, $_SESSION['username']);
                $data     = mysqli_query($koneksi, "SELECT * FROM akun WHERE username = '$username'");

                if ($d = mysqli_fetch_assoc($data)):
            ?>
                <div class="form-group">
                    <label for="nama_pemesan">Nama Pemesan</label>
                    <input class="kolom" type="text" id="nama_pemesan" name="nama_pemesan"
                           value="<?php echo htmlspecialchars($d['nama_lengkap']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="nomor_pemesan">Nomor WhatsApp</label>
                    <input class="kolom" type="tel" id="nomor_pemesan" name="nomor_pemesan"
                           value="<?php echo htmlspecialchars($d['nomor_wa']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="checkin">Tanggal Check-in</label>
                    <input class="kolom" type="date" id="checkin" name="checkin" required>
                </div>

                <div class="form-group">
                    <label for="checkout">Tanggal Check-out</label>
                    <input class="kolom" type="date" id="checkout" name="checkout" required>
                </div>

                <div class="form-group">
                    <label for="dewasa">Jumlah Dewasa</label>
                    <input class="kolom" type="number" id="dewasa" name="dewasa" min="1" required>
                </div>

                <div class="form-group">
                    <label for="anak">Jumlah Anak-anak (&lt;12 Thn)</label>
                    <input class="kolom" type="number" id="anak" name="anak" min="0" value="0" required>
                </div>

                <div class="form-group" style="grid-column:1/-1;">
                    <label for="permintaan">Permintaan Khusus</label>
                    <textarea class="kolom" id="permintaan" name="permintaan" rows="3"></textarea>
                </div>

                <div class="form-group" style="grid-column:1/-1;">
                    <label for="keterangan_pemesanan">Kategori Destinasi</label>
                    <select id="keterangan_pemesanan" name="keterangan_pemesanan">
                        <option value="Pantai">🏖️ Pantai</option>
                        <option value="Pulau">🏝️ Pulau</option>
                        <option value="Sejarah">🏛️ Sejarah</option>
                    </select>
                </div>

                <input type="hidden" id="id_pemesan" name="id_pemesan">
                <input type="hidden" id="id_user" name="id_user"
                       value="<?php echo htmlspecialchars($d['id_user']); ?>">

                <button type="submit" style="grid-column:1/-1;">Kirim Pemesanan 🚀</button>

            <?php
                else:
                    echo '<p style="grid-column:1/-1;">Data akun tidak ditemukan.</p>';
                endif;
            } else {
                echo '<div class="alert alert-error" style="grid-column:1/-1;">Silakan <a href="login.php" style="color:inherit;text-decoration:underline;font-weight:700;">masuk ke akun Anda</a> terlebih dahulu untuk melakukan reservasi tiket wisata.</div>';
            }
            ?>
        </form>
    </section>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>