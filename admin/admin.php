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
    <!-- Mobile Backdrop Overlay -->
    <div id="admin-sidebar-overlay" class="admin-sidebar-overlay" title="Klik untuk menutup sidebar"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="admin-sidebar">
        <!-- Sidebar Brand Bar -->
        <div class="sidebar-brand-bar">
            <div class="brand-info">
                <span class="brand-icon">🌴</span>
                <span class="brand-title">WisataKite</span>
            </div>
            <button type="button" id="sidebar-close-btn" class="sidebar-close-btn" aria-label="Tutup Sidebar" title="Tutup Menu">
                ✕
            </button>
        </div>

        <!-- Profile Widget -->
        <div class="profile">
            <img src="../assets/img/admin.png" alt="Admin Avatar">
            <div class="profile-info">
                <h2><?php echo htmlspecialchars($_SESSION['username']); ?></h2>
                <p>Administrator</p>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="menu" aria-label="Menu Admin">
            <ul>
                <li>
                    <a href="#home" class="active-menu" title="Beranda">
                        <span class="menu-main">
                            <span class="menu-icon">🏠</span>
                            <span class="menu-text">Beranda</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#akun" title="Kelola Akun">
                        <span class="menu-main">
                            <span class="menu-icon">👥</span>
                            <span class="menu-text">Kelola Akun</span>
                        </span>
                        <span class="menu-badge"><?php echo (int)$total_akun; ?></span>
                    </a>
                </li>
                <li>
                    <a href="#informasi" title="Informasi Pribadi">
                        <span class="menu-main">
                            <span class="menu-icon">📋</span>
                            <span class="menu-text">Informasi Pribadi</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#destinasi" title="Destinasi Wisata">
                        <span class="menu-main">
                            <span class="menu-icon">🗺️</span>
                            <span class="menu-text">Destinasi Wisata</span>
                        </span>
                        <span class="menu-badge"><?php echo (int)$total_destinasi; ?></span>
                    </a>
                </li>
                <li>
                    <a href="#pemesanan" title="Pemesanan & Reservasi">
                        <span class="menu-main">
                            <span class="menu-icon">🎫</span>
                            <span class="menu-text">Pemesanan</span>
                        </span>
                        <span class="menu-badge"><?php echo (int)$total_pemesanan; ?></span>
                    </a>
                </li>
                <li>
                    <a href="#semua" title="Tampilkan Semua Bagian">
                        <span class="menu-main">
                            <span class="menu-icon">📑</span>
                            <span class="menu-text">Semua Bagian</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="../index.php" target="_blank" title="Lihat Website Publik">
                        <span class="menu-main">
                            <span class="menu-icon">🌐</span>
                            <span class="menu-text">Lihat Website</span>
                        </span>
                    </a>
                </li>
            </ul>
        </nav>

        <a href="../actions/auth/logout.php" class="logout1" onclick="return confirm('Apakah Anda yakin ingin keluar dari panel admin?')" title="Keluar">
            <span class="menu-icon">🚪</span>
            <span class="logout-text">Keluar</span>
        </a>
    </aside>

    <!-- Content Container -->
    <main class="content-container">
        <!-- Top Bar Header -->
        <header class="admin-topbar">
            <div class="topbar-left">
                <button type="button" id="admin-sidebar-toggle" class="sidebar-toggle-btn" aria-label="Buka/Tutup Menu Sidebar" title="Buka/Tutup Sidebar (Ctrl+B)">
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                    <span class="hamburger-bar"></span>
                </button>
                <div class="topbar-breadcrumb">
                    <span class="breadcrumb-root">WisataKite Admin</span>
                    <span class="breadcrumb-sep">/</span>
                    <span id="current-section-name" class="breadcrumb-active">Beranda</span>
                </div>
            </div>

            <div class="topbar-right">
                <a href="../index.php" target="_blank" class="topbar-link-web" title="Kunjungi Website Publik">
                    <span>🌐</span>
                    <span class="hide-mobile">Lihat Website</span>
                </a>
                <div class="topbar-profile-chip">
                    <img src="../assets/img/admin.png" alt="Avatar" class="topbar-avatar">
                    <div class="topbar-profile-text hide-mobile">
                        <span class="topbar-name"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <span class="topbar-role">Admin</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="content">

            <?php if (isset($_GET['alert'])): ?>
                <?php if ($_GET['alert'] === 'gagal_ekstensi' || $_GET['alert'] === 'gagal_ekstensi_izin'): ?>
                    <div class="alert alert-error">⚠️ Format berkas tidak didukung! Format yang diizinkan: PNG, JPG, JPEG, GIF, PDF.</div>
                <?php elseif ($_GET['alert'] === 'gagal_ukuran' || $_GET['alert'] === 'gagal_ukuran_izin'): ?>
                    <div class="alert alert-error">⚠️ Ukuran berkas melebihi batas maksimal 1 MB!</div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- ========================================================
                 TAB 1: HOME (BERANDA DASHBOARD)
                 ======================================================== -->
            <section class="admin-tab-section active" id="home">
                <div class="welcome-banner">
                    <div class="welcome-text">
                        <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>! 👋</h1>
                        <p>Kelola seluruh data destinasi, akun pengguna, dan reservasi wisata Bangka Belitung dengan mudah dari panel kendali ini.</p>
                        <div class="welcome-quick-links">
                            <a href="#destinasi" class="welcome-btn btn-primary" data-tab-switch="destinasi">🗺️ Kelola Destinasi</a>
                            <a href="#pemesanan" class="welcome-btn btn-secondary" data-tab-switch="pemesanan">🎫 Cek Pemesanan</a>
                        </div>
                    </div>
                    <div class="welcome-img">
                        <img src="../assets/img/admin.png" alt="WisataKite Admin">
                    </div>
                </div>

                <!-- Pemberitahuan Pengajuan Baru -->
                <?php if ((int)$total_destinasi_masuk > 0): ?>
                    <div class="dashboard-notice-banner">
                        <div class="notice-content">
                            <strong>🔔 Ada <?php echo (int)$total_destinasi_masuk; ?> pengajuan destinasi baru!</strong>
                            <p>Segera tinjau status dan kelengkapan dokumen izin destinasi yang diajukan mitra.</p>
                        </div>
                        <a href="#destinasi" class="notice-btn" data-tab-switch="destinasi">Tinjau Sekarang &rarr;</a>
                    </div>
                <?php endif; ?>

                <!-- Ringkasan Statistik Utama -->
                <div class="dashboard-stats-grid">
                    <div class="dash-stat-card">
                        <div class="dash-stat-header">
                            <span class="dash-stat-icon">👥</span>
                            <span class="dash-stat-badge"><?php echo (int)$total_admin; ?> Admin, <?php echo (int)$total_user; ?> User</span>
                        </div>
                        <div class="dash-stat-value"><?php echo (int)$total_akun; ?></div>
                        <div class="dash-stat-label">Total Akun Terdaftar</div>
                        <a href="#akun" class="dash-stat-link" data-tab-switch="akun">Buka Manajemen Akun &rarr;</a>
                    </div>

                    <div class="dash-stat-card">
                        <div class="dash-stat-header">
                            <span class="dash-stat-icon">🗺️</span>
                            <span class="dash-stat-badge badge-green"><?php echo (int)$total_destinasi_diterima; ?> Aktif</span>
                        </div>
                        <div class="dash-stat-value"><?php echo (int)$total_destinasi; ?></div>
                        <div class="dash-stat-label">Destinasi Wisata</div>
                        <a href="#destinasi" class="dash-stat-link" data-tab-switch="destinasi">Buka Destinasi Wisata &rarr;</a>
                    </div>

                    <div class="dash-stat-card">
                        <div class="dash-stat-header">
                            <span class="dash-stat-icon">🎫</span>
                            <span class="dash-stat-badge badge-purple"><?php echo (int)$total_pemesanan; ?> Reservasi</span>
                        </div>
                        <div class="dash-stat-value"><?php echo (int)$total_pemesanan; ?></div>
                        <div class="dash-stat-label">Total Pemesanan Masuk</div>
                        <a href="#pemesanan" class="dash-stat-link" data-tab-switch="pemesanan">Buka Data Pemesanan &rarr;</a>
                    </div>

                    <div class="dash-stat-card">
                        <div class="dash-stat-header">
                            <span class="dash-stat-icon">📋</span>
                            <span class="dash-stat-badge badge-blue"><?php echo (int)$total_informasi; ?> Akun</span>
                        </div>
                        <div class="dash-stat-value"><?php echo (int)$total_informasi; ?></div>
                        <div class="dash-stat-label">Informasi Lengkap Akun</div>
                        <a href="#informasi" class="dash-stat-link" data-tab-switch="informasi">Buka Informasi Lengkap &rarr;</a>
                    </div>
                </div>

                <!-- Aksi Cepat -->
                <div class="dashboard-actions-card">
                    <h3 class="dash-card-title">⚡ Aksi Cepat</h3>
                    <div class="dash-actions-list">
                        <a href="tambah_destinasi.php" class="dash-action-btn">
                            <span class="action-icon">➕</span>
                            <div class="action-text">
                                <strong>Tambah Destinasi</strong>
                                <small>Unggah destinasi wisata baru</small>
                            </div>
                        </a>
                        <a href="tambah_akun.php" class="dash-action-btn">
                            <span class="action-icon">👤</span>
                            <div class="action-text">
                                <strong>Buat Akun Baru</strong>
                                <small>Tambah admin atau akun user</small>
                            </div>
                        </a>
                        <a href="tambah_pemesanan.php" class="dash-action-btn">
                            <span class="action-icon">🎫</span>
                            <div class="action-text">
                                <strong>Tambah Pemesanan</strong>
                                <small>Input reservasi manual</small>
                            </div>
                        </a>
                        <a href="../index.php" target="_blank" class="dash-action-btn">
                            <span class="action-icon">🌐</span>
                            <div class="action-text">
                                <strong>Pratinjau Website</strong>
                                <small>Buka tampilan publik WisataKite</small>
                            </div>
                        </a>
                    </div>
                </div>
            </section>

            <!-- ========================================================
                 TAB 2: KELOLA AKUN
                 ======================================================== -->
            <section class="admin-tab-section admin-section" id="akun">
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

            <!-- ========================================================
                 TAB 3: INFORMASI PRIBADI
                 ======================================================== -->
            <section class="admin-tab-section admin-section" id="informasi">
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

            <!-- ========================================================
                 TAB 4: DESTINASI WISATA
                 ======================================================== -->
            <section class="admin-tab-section admin-section" id="destinasi">
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

            <!-- ========================================================
                 TAB 5: PEMESANAN & RESERVASI
                 ======================================================== -->
            <section class="admin-tab-section admin-section" id="pemesanan">
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

<!-- Admin Scripts -->
<script src="../assets/js/admin.js"></script>
</body>
</html>