<?php
// admin/edit_pemesanan.php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== '1') {
    header('Location: ../login.php');
    exit();
}

require_once __DIR__ . '/../config/database.php';

$id_pemesan = isset($_GET['id_pemesan']) ? mysqli_real_escape_string($koneksi, $_GET['id_pemesan']) : '';
$data       = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_pemesan='$id_pemesan'");
$d          = mysqli_fetch_assoc($data);

$users = mysqli_query($koneksi, "SELECT id_user, username, nama_lengkap FROM akun ORDER BY nama_lengkap ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemesanan - WisataKite Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="admin-subpage-wrapper">
    <div class="admin-form-card">
        <div class="admin-form-header">
            <h2>✏️ Edit Data Reservasi #<?php echo htmlspecialchars($id_pemesan); ?></h2>
            <a href="admin.php#pemesanan" class="admin-back-btn">← Kembali</a>
        </div>

        <?php if ($d): ?>
            <form action="../actions/admin/edit_pemesan.php" method="POST" class="daftarkan-form">
                <div class="form-group">
                    <label for="nama_pemesan">Nama Pemesan</label>
                    <input type="text" id="nama_pemesan" name="nama_pemesan" value="<?php echo htmlspecialchars($d['nama_pemesan']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="nomor_pemesan">Nomor WhatsApp</label>
                    <input type="tel" id="nomor_pemesan" name="nomor_pemesan" value="<?php echo htmlspecialchars($d['nomor_pemesan']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="id_user">Tautkan ke Akun</label>
                    <select id="id_user" name="id_user" required>
                        <?php while ($u = mysqli_fetch_assoc($users)): ?>
                            <option value="<?php echo htmlspecialchars($u['id_user']); ?>" <?php echo $u['id_user'] == $d['id_user'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($u['nama_lengkap'] ?: $u['username']); ?> (@<?php echo htmlspecialchars($u['username']); ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="keterangan_pemesanan">Kategori Wisata</label>
                    <select id="keterangan_pemesanan" name="keterangan_pemesanan" required>
                        <option value="Pantai" <?php echo $d['keterangan_pemesanan'] === 'Pantai' ? 'selected' : ''; ?>>Wisata Pantai</option>
                        <option value="Pulau" <?php echo $d['keterangan_pemesanan'] === 'Pulau' ? 'selected' : ''; ?>>Wisata Pulau</option>
                        <option value="Sejarah" <?php echo $d['keterangan_pemesanan'] === 'Sejarah' ? 'selected' : ''; ?>>Wisata Sejarah</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="checkin">Tanggal Check-In</label>
                    <input type="date" id="checkin" name="checkin" value="<?php echo htmlspecialchars($d['checkin']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="checkout">Tanggal Check-Out</label>
                    <input type="date" id="checkout" name="checkout" value="<?php echo htmlspecialchars($d['checkout']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="dewasa">Jumlah Dewasa</label>
                    <input type="number" id="dewasa" name="dewasa" min="1" value="<?php echo (int)$d['dewasa']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="anak">Jumlah Anak-Anak (< 12 Thn)</label>
                    <input type="number" id="anak" name="anak" min="0" value="<?php echo (int)$d['anak']; ?>" required>
                </div>

                <div class="form-group full">
                    <label for="permintaan">Permintaan Khusus</label>
                    <textarea id="permintaan" name="permintaan" rows="3"><?php echo htmlspecialchars($d['permintaan']); ?></textarea>
                </div>

                <input type="hidden" name="id_pemesan" value="<?php echo htmlspecialchars($d['id_pemesan']); ?>">

                <div class="form-actions full" style="display:flex; gap:12px; width:100%; margin-top:12px;">
                    <button type="submit" class="btn btn-primary" style="flex:2;">💾 Simpan Perubahan</button>
                    <a href="admin.php#pemesanan" class="btn btn-secondary" style="flex:1;">Batal</a>
                </div>
            </form>
        <?php else: ?>
            <div class="alert alert-error">Data pemesanan tidak ditemukan. <a href="admin.php#pemesanan">Kembali</a></div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
