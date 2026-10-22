<?php
// login.php
require_once __DIR__ . '/config/app.php';

$page_title   = 'WisataKite - Masuk';
$css_file     = 'profil.css';
$current_page = 'login';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';
?>

<main class="login-container" style="margin-top: calc(var(--nav-h, 60px) + 40px);">
    <form action="actions/auth/login.php" method="POST" class="login-form">
        <div style="text-align:center;font-size:2.5rem;margin-bottom:8px;">🪁</div>
        <h2>Masuk</h2>
        <h3>Silahkan masuk untuk melanjutkan</h3>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">Username atau password salah!</div>
        <?php elseif (isset($_GET['status']) && $_GET['status'] === 'registered'): ?>
            <div class="alert alert-success">Pendaftaran berhasil! Silakan masuk.</div>
        <?php endif; ?>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="wisatakite" required autocomplete="username">
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
        </div>

        <button type="submit">Masuk</button>
    </form>

    <p>Belum memiliki akun? <a href="daftar.php">Daftar di sini!</a></p>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>