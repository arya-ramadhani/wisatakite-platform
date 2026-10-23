<?php
// admin/admin.php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== '1') {
    header('Location: ../login.php');
    exit();
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../actions/admin/data_aksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - WisataKite</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="admin-wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="profile">
            <img src="../assets/img/admin.png" alt="Admin Avatar">
            <div>
                <h2><?php echo htmlspecialchars($_SESSION['username']); ?></h2>
                <p>Administrator</p>
            </div>
        </div>

        <nav class="menu" aria-label="Menu Admin">
            <ul>
                <li><a href="#home" class="active-menu">🏠 Beranda</a></li>
                <li><a href="#akun">👥 Kelola Akun</a></li>
                <li><a href="#informasi">📋 Informasi Pribadi</a></li>
                <li><a href="#destinasi">🗺️ Destinasi Wisata</a></li>
                <li><a href="#pemesanan">🎫 Pemesanan</a></li>
                <li><a href="../index.php" target="_blank">🌐 Lihat Website</a></li>
            </ul>
        </nav>

        <a href="../actions/auth/logout.php" class="logout1" onclick="return confirm('Apakah Anda yakin ingin keluar dari panel admin?')">
            🚪 Keluar
        </a>
    </aside>

    <!-- Content Container -->
    <main class="content-container">
        <div class="content">

            <?php if (isset($_GET['alert'])): ?>
                <?php if ($_GET['alert'] === 'gagal_ekstensi' || $_GET['alert'] === 'gagal_ekstensi_izin'): ?>
                    <div class="alert alert-error">Format berkas tidak didukung! Format yang diizinkan: PNG, JPG, JPEG, GIF, PDF.</div>
                <?php elseif ($_GET['alert'] === 'gagal_ukuran' || $_GET['alert'] === 'gagal_ukuran_izin'): ?>
                    <div class="alert alert-error">Ukuran berkas melebihi batas maksimal 1 MB!</div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- HOME -->
            <section class="welcome-banner" id="home">
                <div class="welcome-text">
                    <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>! 👋</h1>
                    <p>Kelola seluruh data destinasi, akun pengguna, dan reservasi wisata Bangka Belitung dengan mudah.</p>
                </div>
                <div class="welcome-img">
                    <img src="../assets/img/admin.png" alt="WisataKite Admin">
                </div>
            </section>

            <!-- AKUN -->
            <section class="admin-section" id="akun">
                <div class="section-header">
                    <h2>👥 Manajemen Akun</h2>
                    <a href="tambah_akun.php" class="btn-tambah">+ Buat Akun Baru</a>
                </div>

                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-number"><?php echo (int)$total_akun; ?></div>
                        <div class="stat-label">Total Akun</div>
                    </div>
                    <div class="stat-card stat-purple">
                        <div class="stat-number"><?php echo (int)$total_admin; ?></div>
                        <div class="stat-label">Admin</div>
                    </div>
                    <div class="stat-card stat-green">
                        <div class="stat-number"><?php echo (int)$total_user; ?></div>
                        <div class="stat-label">User Terdaftar</div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="tambah">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>ID Akun</th>
                                <th>Username</th>
                                <th>Kata Sandi</th>
                                <th>Role</th>
                                <th style="width: 140px;">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = mysqli_query($koneksi, "SELECT * FROM akun ORDER BY id_user DESC");
                            while ($d = mysqli_fetch_assoc($data)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><strong>#<?php echo htmlspecialchars($d['id_user']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($d['username']); ?></td>
                                    <td>••••••••</td>
                                    <td>
                                        <span class="badge <?php echo $d['role'] === '1' ? 'badge-admin' : 'badge-user'; ?>">
                                            <?php echo $d['role'] === '1' ? 'Admin' : 'User'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-action-group">
                                            <a class="btn-edit" href="edit_akun.php?id_user=<?php echo urlencode($d['id_user']); ?>">Edit</a>
                                            <a class="btn-hapus" href="../actions/admin/hapus_akun.php?id_user=<?php echo urlencode($d['id_user']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- INFORMASI PRIBADI -->
            <section class="admin-section" id="informasi">
                <div class="section-header">
                    <h2>📋 Informasi Lengkap Akun</h2>
                    <a href="tambah_akun.php" class="btn-tambah">+ Tambah Akun</a>
                </div>

                <div class="stats-row">
                    <div class="stat-card stat-green">
                        <div class="stat-number"><?php echo (int)$total_informasi; ?></div>
                        <div class="stat-label">Total Data Akun</div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="tambah">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Tgl Lahir</th>
                                <th>Agama</th>
                                <th>WhatsApp</th>
                                <th>Alamat</th>
                                <th style="width: 140px;">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = mysqli_query($koneksi, "SELECT * FROM akun ORDER BY id_user DESC");
                            while ($d = mysqli_fetch_assoc($data)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><strong><?php echo htmlspecialchars($d['nama_lengkap'] ?: '-'); ?></strong></td>
                                    <td><?php echo htmlspecialchars($d['email'] ?: '-'); ?></td>
                                    <td><?php echo htmlspecialchars($d['tgl_lahir'] ?: '-'); ?></td>
                                    <td><?php echo htmlspecialchars($d['agama'] ?: '-'); ?></td>
                                    <td><?php echo htmlspecialchars($d['nomor_wa'] ?: '-'); ?></td>
                                    <td><?php echo htmlspecialchars($d['alamat'] ?: '-'); ?></td>
                                    <td>
                                        <div class="btn-action-group">
                                            <a class="btn-edit" href="edit_akun.php?id_user=<?php echo urlencode($d['id_user']); ?>">Edit</a>
                                            <a class="btn-hapus" href="../actions/admin/hapus_akun.php?id_user=<?php echo urlencode($d['id_user']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- DESTINASI -->
            <section class="admin-section" id="destinasi">
                <div class="section-header">
                    <h2>🗺️ Destinasi Wisata</h2>
                    <a href="tambah_destinasi.php" class="btn-tambah">+ Tambah Destinasi</a>
                </div>

                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-number"><?php echo (int)$total_destinasi; ?></div>
                        <div class="stat-label">Total Destinasi</div>
                    </div>
                    <div class="stat-card stat-amber">
                        <div class="stat-number"><?php echo (int)$total_destinasi_masuk; ?></div>
                        <div class="stat-label">Pengajuan Masuk</div>
                    </div>
                    <div class="stat-card stat-green">
                        <div class="stat-number"><?php echo (int)$total_destinasi_diterima; ?></div>
                        <div class="stat-label">Diterima / Aktif</div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="tambah">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Foto</th>
                                <th>Nama Destinasi</th>
                                <th>Kontak WhatsApp</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Dokumen Izin</th>
                                <th style="width: 140px;">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = mysqli_query($koneksi, "SELECT * FROM destinasi ORDER BY id_destinasi DESC");
                            while ($d = mysqli_fetch_assoc($data)) {
                                $is_diterima = strtolower(trim($d['keterangan_destinasi'])) === 'di terima';
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>
                                        <?php if (!empty($d['foto_destinasi']) && file_exists(__DIR__ . '/../assets/img/destinasi/' . $d['foto_destinasi'])): ?>
                                            <img src="../assets/img/destinasi/<?php echo htmlspecialchars($d['foto_destinasi']); ?>" alt="Foto" class="table-img">
                                        <?php else: ?>
                                            <div style="width:64px;height:48px;background:#e2e8f0;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:.7rem;color:#64748b;">No foto</div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?php echo htmlspecialchars($d['nama_destinasi']); ?></strong>
                                        <div style="font-size:0.75rem;color:var(--clr-muted);"><?php echo htmlspecialchars(substr($d['deskripsi_destinasi'], 0, 60)) . '...'; ?></div>
                                    </td>
                                    <td><?php echo htmlspecialchars($d['nomor_destinasi']); ?></td>
                                    <td><?php echo htmlspecialchars($d['alamat_destinasi']); ?></td>
                                    <td>
                                        <span class="badge <?php echo $is_diterima ? 'badge-diterima' : 'badge-masuk'; ?>">
                                            <?php echo htmlspecialchars($d['keterangan_destinasi']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!empty($d['izin_destinasi'])): ?>
                                            <a href="../assets/img/izin_destinasi/<?php echo htmlspecialchars($d['izin_destinasi']); ?>" target="_blank" style="color:var(--clr-green); font-weight:600; font-size:0.8rem; text-decoration:underline;">
                                                Lihat Berkas
                                            </a>
                                        <?php else: ?>
                                            <span style="color:var(--clr-muted);">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-action-group">
                                            <a class="btn-edit" href="edit_destinasi.php?id_destinasi=<?php echo urlencode($d['id_destinasi']); ?>">Edit</a>
                                            <a class="btn-hapus" href="../actions/admin/hapus_destinasi.php?id_destinasi=<?php echo urlencode($d['id_destinasi']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- PEMESANAN -->
            <section class="admin-section" id="pemesanan">
                <div class="section-header">
                    <h2>🎫 Data Reservasi & Pemesanan</h2>
                    <a href="tambah_pemesanan.php" class="btn-tambah">+ Tambah Pemesanan</a>
                </div>

                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-number"><?php echo (int)$total_pemesanan; ?></div>
                        <div class="stat-label">Total Pemesanan</div>
                    </div>
                    <div class="stat-card stat-green">
                        <div class="stat-number"><?php echo (int)$total_pemesanan_pantai; ?></div>
                        <div class="stat-label">Wisata Pantai</div>
                    </div>
                    <div class="stat-card stat-purple">
                        <div class="stat-number"><?php echo (int)$total_pemesanan_pulau; ?></div>
                        <div class="stat-label">Wisata Pulau</div>
                    </div>
                    <div class="stat-card stat-amber">
                        <div class="stat-number"><?php echo (int)$total_pemesanan_sejarah; ?></div>
                        <div class="stat-label">Wisata Sejarah</div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="tambah">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Nama Pemesan</th>
                                <th>WhatsApp</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Tamu</th>
                                <th>Kategori</th>
                                <th>Permintaan</th>
                                <th style="width: 140px;">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = mysqli_query($koneksi, "SELECT * FROM pemesanan ORDER BY id_pemesan DESC");
                            while ($d = mysqli_fetch_assoc($data)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><strong><?php echo htmlspecialchars($d['nama_pemesan']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($d['nomor_pemesan']); ?></td>
                                    <td>📅 <?php echo htmlspecialchars($d['checkin']); ?></td>
                                    <td>📅 <?php echo htmlspecialchars($d['checkout']); ?></td>
                                    <td>
                                        <?php echo (int)$d['dewasa']; ?> D<?php if ((int)$d['anak'] > 0) echo ', ' . (int)$d['anak'] . ' A'; ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-user">
                                            <?php echo htmlspecialchars($d['keterangan_pemesanan']); ?>
                                        </span>
                                    </td>
                                    <td><small><?php echo htmlspecialchars($d['permintaan'] ?: '-'); ?></small></td>
                                    <td>
                                        <div class="btn-action-group">
                                            <a class="btn-edit" href="edit_pemesanan.php?id_pemesan=<?php echo urlencode($d['id_pemesan']); ?>">Edit</a>
                                            <a class="btn-hapus" href="../actions/admin/hapus_pemesanan.php?id_pemesan=<?php echo urlencode($d['id_pemesan']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data pemesanan ini?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>
    </main>
</div>

</body>
</html>