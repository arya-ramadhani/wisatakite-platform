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

<main class="daftarkan-container">
    <h2>Buat Akun Baru</h2>

    <form action="actions/auth/daftar.php" method="POST" class="daftarkan-form">
        <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="email@contoh.com" required>
        </div>

        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" id="tgl_lahir" name="tgl_lahir" required>
        </div>

        <div class="form-group">
            <label for="agama">Agama</label>
            <input type="text" id="agama" name="agama" placeholder="Agama" required>
        </div>

        <div class="form-group">
            <label for="nomor_wa">Nomor WhatsApp</label>
            <input type="tel" id="nomor_wa" name="nomor_wa" placeholder="08xxxxxxxxxx" required>
        </div>

        <div class="form-group full">
            <label for="alamat">Alamat Lengkap</label>
            <textarea id="alamat" name="alamat" rows="2" placeholder="Jl. Contoh No. 1, Kota" required></textarea>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="username_unik" required autocomplete="username">
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="new-password">
        </div>

        <input type="hidden" id="id_user" name="id_user" value="">
        <input type="hidden" id="role" name="role" value="0">

        <button type="submit">Daftar Sekarang</button>
    </form>

    <p style="text-align:center;margin-top:20px;font-size:.875rem;color:var(--clr-muted);">
        Sudah punya akun? <a href="login.php" style="color:var(--clr-green);font-weight:600;">Masuk di sini</a>
    </p>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>