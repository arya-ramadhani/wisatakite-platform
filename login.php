<?php
// login.php
require_once __DIR__ . '/config/app.php';

$page_title   = 'WisataKite - Masuk';
$css_file     = 'profil.css';
$body_class   = 'page-login';

include __DIR__ . '/includes/header.php';
// Navbar & Sidebar dihilangkan khusus halaman login
?>

<main class="auth-page-wrapper" aria-label="Halaman Masuk">
    <div class="auth-top-nav">
        <a href="index.php" class="btn-back-home">&larr; Kembali ke Beranda</a>
    </div>

    <div class="auth-bg-blob auth-bg-blob-1" aria-hidden="true"></div>
    <div class="auth-bg-blob auth-bg-blob-2" aria-hidden="true"></div>

    <div class="auth-split-card">
        <!-- Visual Showcase Left Side -->
        <div class="auth-visual-side">
            <div class="auth-visual-overlay"></div>
            <img src="assets/img/index2.png" alt="Pesona Wisata Bangka Belitung" class="auth-visual-img" loading="eager">
            
            <div class="auth-visual-top">
                <a href="index.php" class="auth-brand-badge" title="WisataKite - Beranda">
                    <span class="badge-icon">🪁</span>
                    <span>Wisata<strong>Kite</strong></span>
                </a>
            </div>

            <div class="auth-visual-bottom">
                <h2>Jelajahi Surga Wisata Bangka Belitung</h2>
                <p>Temukan pesona hamparan pasir putih halus, gugusan pulau tropis eksotis, dan warisan budaya bersejarah.</p>

                <div class="auth-feature-tags">
                    <span class="feat-tag">🏖️ Pantai Granit</span>
                    <span class="feat-tag">🏝️ Pulau Eksotis</span>
                    <span class="feat-tag">🏛️ Warisan Budaya</span>
                </div>

                <div class="auth-quote-card">
                    <span class="quote-stars">★★★★★</span>
                    <p>"Platform panduan &amp; pemesanan wisata Bangka Belitung terfavorit."</p>
                </div>
            </div>
        </div>

        <!-- Form Right Side -->
        <div class="auth-form-side">
            <div class="auth-form-header">
                <span class="auth-header-pill">✨ Akun Pengguna</span>
                <h1>Selamat Datang!</h1>
                <p>Silakan masuk untuk mengakses fitur &amp; pemesanan Anda.</p>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-error" role="alert">
                    <span class="alert-icon">⚠️</span>
                    <span>Username atau kata sandi tidak cocok. Silakan coba lagi!</span>
                </div>
            <?php elseif (isset($_GET['status']) && $_GET['status'] === 'registered'): ?>
                <div class="alert alert-success" role="alert">
                    <span class="alert-icon">✓</span>
                    <span>Pendaftaran berhasil! Silakan masuk dengan akun baru Anda.</span>
                </div>
            <?php endif; ?>

            <form action="actions/auth/login.php" method="POST" class="auth-form" autocomplete="on">
                <div class="auth-input-group">
                    <label for="username">Username</label>
                    <div class="input-with-icon">
                        <span class="input-icon">👤</span>
                        <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required autocomplete="username" autofocus>
                    </div>
                </div>

                <div class="auth-input-group">
                    <label for="password">Kata Sandi</label>
                    <div class="input-with-icon">
                        <span class="input-icon">🔒</span>
                        <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required autocomplete="current-password">
                        <button type="button" class="btn-toggle-pwd" id="toggle-pwd-btn" aria-label="Lihat kata sandi" tabindex="-1">👁️</button>
                    </div>
                </div>

                <button type="submit" class="btn-auth-submit">
                    <span>Masuk ke Akun</span>
                    <span class="btn-arrow">&rarr;</span>
                </button>
            </form>

            <div class="auth-footer-prompt">
                <p>Belum memiliki akun? <a href="daftar.php">Daftar sekarang &rarr;</a></p>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('toggle-pwd-btn');
    const pwdInput  = document.getElementById('password');
    if (toggleBtn && pwdInput) {
        toggleBtn.addEventListener('click', function () {
            const isPassword = pwdInput.type === 'password';
            pwdInput.type = isPassword ? 'text' : 'password';
            toggleBtn.textContent = isPassword ? '🙈' : '👁️';
        });
    }
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>