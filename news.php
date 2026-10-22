<?php
// news.php
require_once __DIR__ . '/config/app.php';

$page_title   = 'WisataKite - Berita';
$css_file     = 'news.css';
$current_page = 'news';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';
?>

<main class="container" aria-label="Berita wisata">
    <h1 class="news-heading">📰 Berita Wisata</h1>

    <article class="article">
        <img src="assets/img/berita/berita1.jpg" alt="Tanjung Kelayang - Bangka Belitung" loading="lazy">
        <div class="content">
            <h3>KOMPAS.com</h3>
            <h2>Dongkrak Pariwisata, Tanjung Kelayang Butuh Lebih Banyak Penerbangan</h2>
            <p>Pantai Tanjung Kelayang memiliki pantai pasir putih halus dengan air laut jernih dan biru kehijauan yang memukau. Meski dinilai memiliki potensi wisata alam dan bahari yang besar, tetapi konektivitas yang belum memadai masih menjadi kendala.</p>
            <a
                href="https://travel.kompas.com/read/2023/12/15/060500827/dongkrak-pariwisata-tanjung-kelayang-butuh-lebih-banyak-penerbangan"
                target="_blank"
                rel="noopener noreferrer"
            >Baca Selengkapnya &rarr;</a>
        </div>
    </article>

    <article class="article reverse">
        <img src="assets/img/berita/berita2.jpg" alt="Wisata Bekas Tambang Bangka Belitung" loading="lazy">
        <div class="content">
            <h3>KOMPAS.com</h3>
            <h2>Wisata sambil Belajar, Ini 5 Wisata Bekas Tambang di Bangka Belitung</h2>
            <p>Lahan kritis di Kepulauan Bangka Belitung tercatat mencapai 167.104 hektar. Lahan tersebut termasuk dalam kategori kritis dan sangat kritis. Akan tetapi, sebagian besar lahan kritis yang merupakan bekas tambang timah tersebut mulai direhabilitasi atau direklamasi.</p>
            <a
                href="https://travel.kompas.com/read/2023/07/02/080800927/wisata-sambil-belajar-ini-5-wisata-bekas-tambang-di-bangka-belitung?page=all"
                target="_blank"
                rel="noopener noreferrer"
            >Baca Selengkapnya &rarr;</a>
        </div>
    </article>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
