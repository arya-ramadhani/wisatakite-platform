<?php
// admin/tambah_akun.php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== '1') {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun - WisataKite Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="admin-subpage-wrapper">
    <div class="admin-form-card">
        <div class="admin-form-header">
            <h2>➕ Tambah Akun Baru</h2>
            <a href="admin.php#akun" class="admin-back-btn">← Kembali</a>
        </div>

        <form action="../actions/admin/tambah_akun.php" method="POST" class="daftarkan-form">
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" placeholder="nama@email.com" required>
            </div>

            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir" required>
            </div>

            <div class="form-group">
                <label for="agama">Agama</label>
                <input type="text" id="agama" name="agama" placeholder="Islam, Kristen, dll" required>
            </div>

            <div class="form-group">
                <label for="nomor_wa">Nomor WhatsApp</label>
                <input type="tel" id="nomor_wa" name="nomor_wa" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="form-group">
                <label for="role">Hak Akses (Role)</label>
                <select id="role" name="role" required>
                    <option value="0" selected>Pengguna Biasa (User)</option>
                    <option value="1">Administrator</option>
                </select>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="username unik" required>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="minimal 6 karakter" required>
            </div>

            <div class="form-group full">
                <label for="alamat">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat domisili lengkap..." required></textarea>
            </div>

            <input type="hidden" id="id_user" name="id_user">

            <div class="form-actions full" style="display:flex; gap:12px; width:100%; margin-top:12px;">
                <button type="submit" class="btn btn-primary" style="flex:2;">💾 Simpan Akun Baru</button>
                <a href="admin.php#akun" class="btn btn-secondary" style="flex:1;">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>