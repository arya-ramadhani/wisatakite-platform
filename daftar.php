<?php
// daftar.php
require_once __DIR__ . '/config/app.php';

$page_title   = 'WisataKite - Daftar Akun';
$css_file     = 'profil.css';
$current_page = 'daftar';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';
?>

<main class="auth-page-wrapper" aria-label="Halaman Pendaftaran Akun">
    <div class="auth-bg-blob auth-bg-blob-1" aria-hidden="true"></div>
    <div class="auth-bg-blob auth-bg-blob-2" aria-hidden="true"></div>

    <div class="auth-split-card auth-register-card">
        <!-- Visual Showcase Left Side -->
        <div class="auth-visual-side">
            <div class="auth-visual-overlay"></div>
            <img src="assets/img/index3.png" alt="Keindahan Wisata Bangka Belitung" class="auth-visual-img" loading="eager">

            <div class="auth-visual-top">
                <div class="auth-brand-badge">
                    <span class="badge-icon">🪁</span>
                    <span>Wisata<strong>Kite</strong></span>
                </div>
            </div>

            <div class="auth-visual-bottom">
                <h2>Mulai Petualangan Wisata Terbaik</h2>
                <p>Daftarkan akun Anda untuk kemudahan memesan paket destinasi, menyimpan riwayat wisata, dan menikmati pesona Bangka Belitung.</p>

                <div class="auth-feature-tags">
                    <span class="feat-tag">⚡ Reservasi Cepat</span>
                    <span class="feat-tag">📍 Info Terpercaya</span>
                    <span class="feat-tag">💳 Bebas Biaya Admin</span>
                </div>

                <div class="auth-quote-card">
                    <span class="quote-stars">★★★★★</span>
                    <p>"Bergabunglah bersama ribuan wisatawan yang menjelajahi Bangka Belitung bersama kami."</p>
                </div>
            </div>
        </div>

        <!-- Form Right Side -->
        <div class="auth-form-side">
            <div class="auth-form-header">
                <span class="auth-header-pill">🚀 Registrasi Cepat</span>
                <h1>Buat Akun Baru</h1>
                <p>Lengkapi formulir di bawah ini untuk memulai.</p>
            </div>

            <form action="actions/auth/daftar.php" method="POST" class="auth-form" autocomplete="on">
                <div class="auth-grid-form">
                    <div class="auth-input-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <div class="input-with-icon">
                            <span class="input-icon">👤</span>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap Anda" required autocomplete="name">
                        </div>
                    </div>

                    <div class="auth-input-group">
                        <label for="email">Alamat Email</label>
                        <div class="input-with-icon">
                            <span class="input-icon">✉️</span>
                            <input type="email" id="email" name="email" placeholder="nama@email.com" required autocomplete="email">
                        </div>
                    </div>

                    <div class="auth-input-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <div class="input-with-icon">
                            <span class="input-icon">📅</span>
                            <input type="date" id="tgl_lahir" name="tgl_lahir" required>
                        </div>
                    </div>

                    <div class="auth-input-group">
                        <label for="agama">Agama</label>
                        <div class="input-with-icon">
                            <span class="input-icon">🕌</span>
                            <select id="agama" name="agama" required>
                                <option value="" disabled selected>Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="auth-input-group">
                        <label for="nomor_wa">Nomor WhatsApp</label>
                        <div class="input-with-icon">
                            <span class="input-icon">📱</span>
                            <input type="tel" id="nomor_wa" name="nomor_wa" placeholder="08xxxxxxxxxx" required autocomplete="tel">
                        </div>
                    </div>

                    <div class="auth-input-group">
                        <label for="username">Username</label>
                        <div class="input-with-icon">
                            <span class="input-icon">🪪</span>
                            <input type="text" id="username" name="username" placeholder="username_unik" required autocomplete="username">
                        </div>
                    </div>

                    <div class="auth-input-group full">
                        <label for="password">Kata Sandi</label>
                        <div class="input-with-icon">
                            <span class="input-icon">🔒</span>
                            <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required autocomplete="new-password">
                            <button type="button" class="btn-toggle-pwd" id="toggle-pwd-btn" aria-label="Lihat kata sandi" tabindex="-1">👁️</button>
                        </div>
                    </div>

                    <div class="auth-input-group full">
                        <label for="alamat">Alamat Tempat Tinggal</label>
                        <div class="input-with-icon">
                            <span class="input-icon" style="top:12px;">📍</span>
                            <textarea id="alamat" name="alamat" rows="2" placeholder="Jl. Contoh No. 1, Kota / Kabupaten..." required></textarea>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="id_user" name="id_user" value="">
                <input type="hidden" id="role" name="role" value="0">

                <button type="submit" class="btn-auth-submit">
                    <span>Daftar Sekarang</span>
                    <span class="btn-arrow">&rarr;</span>
                </button>
            </form>

            <div class="auth-footer-prompt">
                <p>Sudah memiliki akun? <a href="login.php">Masuk di sini &rarr;</a></p>
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