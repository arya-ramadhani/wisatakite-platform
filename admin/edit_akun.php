<?php
// admin/edit_akun.php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== '1') {
    header('Location: ../login.php');
    exit();
}

require_once __DIR__ . '/../config/database.php';

$id_user = isset($_GET['id_user']) ? mysqli_real_escape_string($koneksi, $_GET['id_user']) : '';
$data    = mysqli_query($koneksi, "SELECT * FROM akun WHERE id_user='$id_user'");
$d       = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun - WisataKite Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="admin-subpage-wrapper">
    <div class="admin-form-card">
        <div class="admin-form-header">
            <h2>✏️ Edit Data Akun</h2>
            <a href="admin.php#akun" class="admin-back-btn">← Kembali</a>
        </div>

        <?php if ($d): ?>
            <form action="../actions/admin/edit_akun.php" method="POST" class="daftarkan-form">
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars($d['nama_lengkap']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($d['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?php echo htmlspecialchars($d['tgl_lahir']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="agama">Agama</label>
                    <input type="text" id="agama" name="agama" value="<?php echo htmlspecialchars($d['agama']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="nomor_wa">Nomor WhatsApp</label>
                    <input type="tel" id="nomor_wa" name="nomor_wa" value="<?php echo htmlspecialchars($d['nomor_wa']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="role">Hak Akses (Role)</label>
                    <select id="role" name="role" required>
                        <option value="0" <?php echo $d['role'] === '0' ? 'selected' : ''; ?>>Pengguna Biasa (User)</option>
                        <option value="1" <?php echo $d['role'] === '1' ? 'selected' : ''; ?>>Administrator</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($d['username']); ?>" readonly style="background:#f1f5f9; cursor:not-allowed;">
                </div>

                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($d['password']); ?>" required>
                </div>

                <div class="form-group full">
                    <label for="alamat">Alamat Lengkap</label>
                    <textarea id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($d['alamat']); ?></textarea>
                </div>

                <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($d['id_user']); ?>">

                <div class="form-actions full" style="display:flex; gap:12px; width:100%; margin-top:12px;">
                    <button type="submit" class="btn btn-primary" style="flex:2;">💾 Simpan Perubahan</button>
                    <a href="admin.php#akun" class="btn btn-secondary" style="flex:1;">Batal</a>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-error">Data akun tidak ditemukan. <a href="admin.php#akun">Kembali</a></div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>