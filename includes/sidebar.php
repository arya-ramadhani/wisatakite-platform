<?php
// includes/sidebar.php
?>
<aside id="profile-sidebar" class="profile-sidebar" role="complementary" aria-label="Panel profil">
    <div class="profile-header">
        <div class="profile-pic">
            <img src="assets/img/guest.png" alt="Foto Profil">
        </div>
        <h2>
            <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                echo htmlspecialchars($_SESSION['username'] ?? 'Pengguna');
            } else {
                echo 'Guest';
            }
            ?>
        </h2>
        <p style="font-size:.8rem;opacity:.8;margin-top:4px;">
            <?php echo isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'Pengguna Terdaftar' : 'Belum masuk'; ?>
        </p>
    </div>

    <ul class="profile-menu">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <li><a href="informasi.php">👤 Informasi Pribadi</a></li>
            <li><a href="daftar_destinasi.php">🗺️ Daftarkan Destinasi</a></li>
            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="histori.php">📋 Histori Pemesanan</a></li>
            <?php endif; ?>
            <li><a href="actions/auth/logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')">🚪 Keluar</a></li>
        <?php else: ?>
            <li><a href="informasi.php" onclick="return confirm('Silahkan masuk terlebih dahulu')">👤 Informasi Pribadi</a></li>
            <li><a href="daftar_destinasi.php" onclick="return confirm('Silahkan masuk terlebih dahulu')">🗺️ Daftarkan Destinasi</a></li>
            <li><a href="login.php">🔐 Masuk</a></li>
            <li><a href="daftar.php">📝 Daftar</a></li>
        <?php endif; ?>
    </ul>
</aside>
