<?php
// admin/tambah_pemesanan.php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== '1') {
    header('Location: ../login.php');
    exit();
}

require_once __DIR__ . '/../config/database.php';

// Ambil daftar akun untuk dipilihkan pemesan
$users = mysqli_query($koneksi, "SELECT id_user, username, nama_lengkap FROM akun ORDER BY nama_lengkap ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pemesanan - WisataKite Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="admin-subpage-wrapper">
    <div class="admin-form-card">
        <div class="admin-form-header">
            <h2>➕ Tambah Reservasi Wisata</h2>
            <a href="admin.php#pemesanan" class="admin-back-btn">← Kembali</a>
        </div>

        <form action="../actions/admin/tambah_pemesanan.php" method="POST" class="daftarkan-form">
            <div class="form-group">
                <label for="nama_pemesan">Nama Pemesan</label>
                <input type="text" id="nama_pemesan" name="nama_pemesan" placeholder="Nama lengkap pemesan" required>
            </div>

            <div class="form-group">
                <label for="nomor_pemesan">Nomor WhatsApp</label>
                <input type="tel" id="nomor_pemesan" name="nomor_pemesan" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="form-group">
                <label for="id_user">Tautkan ke Akun</label>
                <select id="id_user" name="id_user" required>
                    <option value="">-- Pilih Akun --</option>
                    <?php while ($u = mysqli_fetch_assoc($users)): ?>
                        <option value="<?php echo htmlspecialchars($u['id_user']); ?>">
                            <?php echo htmlspecialchars($u['nama_lengkap'] ?: $u['username']); ?> (@<?php echo htmlspecialchars($u['username']); ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="keterangan_pemesanan">Kategori Wisata</label>
                <select id="keterangan_pemesanan" name="keterangan_pemesanan" required>
                    <option value="Pantai">Wisata Pantai</option>
                    <option value="Pulau">Wisata Pulau</option>
                    <option value="Sejarah">Wisata Sejarah</option>
                </select>
            </div>

            <div class="form-group">
                <label for="checkin">Tanggal Check-In</label>
                <input type="date" id="checkin" name="checkin" required>
            </div>

            <div class="form-group">
                <label for="checkout">Tanggal Check-Out</label>
                <input type="date" id="checkout" name="checkout" required>
            </div>

            <div class="form-group">
                <label for="dewasa">Jumlah Dewasa</label>
                <input type="number" id="dewasa" name="dewasa" min="1" value="1" required>
            </div>

            <div class="form-group">
                <label for="anak">Jumlah Anak-Anak (< 12 Thn)</label>
                <input type="number" id="anak" name="anak" min="0" value="0" required>
            </div>

            <div class="form-group full">
                <label for="permintaan">Permintaan Khusus</label>
                <textarea id="permintaan" name="permintaan" rows="3" placeholder="Contoh: Permintaan kamar view pantai, penjemputan bandara..."></textarea>
            </div>

            <div class="form-actions full" style="display:flex; gap:12px; width:100%; margin-top:12px;">
                <button type="submit" class="btn btn-primary" style="flex:2;">💾 Simpan Pemesanan</button>
                <a href="admin.php#pemesanan" class="btn btn-secondary" style="flex:1;">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
