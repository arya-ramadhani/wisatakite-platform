# 🌴 WisataKite

Website platform informasi wisata dan pemesanan tiket destinasi wisata di Bangka Belitung.

---

## 📁 Struktur Direktori Proyek

Proyek ini menggunakan arsitektur **Clean Modular Procedural (Native PHP)** dengan pemisahan tugas (*Separation of Concerns*) dan komponen modular (*DRY - Don't Repeat Yourself*):

```text
WisataKite/
├── actions/                  # Handler backend / pemrosesan data form & redirect
│   ├── admin/                # Proses CRUD khusus admin (destinasi, akun, pemesanan)
│   ├── auth/                 # Proses login, register, dan logout
│   └── user/                 # Proses form pemesanan, pengajuan destinasi, edit profil
│
├── admin/                    # Halaman antarmuka (UI) dashboard admin
│   ├── index.php             # Entry point admin
│   ├── admin.php             # Dashboard utama admin
│   ├── edit_akun.php         # Form edit akun user/admin
│   ├── edit_destinasi.php    # Form edit destinasi
│   ├── edit_pemesanan.php    # Form edit pemesanan
│   ├── tambah_akun.php       # Form tambah akun
│   ├── tambah_destinasi.php  # Form tambah destinasi
│   └── tambah_pemesanan.php  # Form tambah pemesanan
│
├── assets/                   # Static assets publik (frontend only)
│   ├── css/                  # File CSS styling
│   ├── img/                  # Gambar UI & ikon
│   └── js/                   # File script JavaScript
│
├── config/                   # Konfigurasi sistem
│   ├── app.php               # Konfigurasi aplikasi, base path, dan helper
│   └── database.php          # Koneksi MySQLi database
│
├── includes/                 # Komponen modular yang dipakai berulang (partials)
│   ├── header.php            # HTML <head>, meta, & link CSS
│   ├── navbar.php            # Navigasi utama
│   ├── sidebar.php           # Sidebar menu profil pengguna
│   └── footer.php            # Script JS dan penutup tag HTML
│
├── index.php                 # Halaman utama (Landing Page)
├── login.php                 # Halaman masuk
├── daftar.php                # Halaman pendaftaran akun
├── detail.php                # Halaman detail destinasi
├── news.php                  # Halaman berita wisata
├── pemesanan.php             # Halaman form pemesanan destinasi
├── histori.php               # Halaman riwayat pemesanan pengguna
├── informasi.php             # Halaman profil informasi akun
└── edit_profil.php           # Halaman ubah profil pengguna
```

---

## ⚙️ Persyaratan Sistem & Instalasi
1. **Web Server**: Laragon / XAMPP (Apache + PHP 7.4+ / PHP 8.x)
2. **Database**: MySQL / MariaDB
3. **Database Name**: `wisata_kite`
4. Jalankan Laragon dan buka: `http://localhost/WisataKite`
