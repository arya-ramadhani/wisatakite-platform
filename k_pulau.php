<?php
// k_pulau.php
require_once __DIR__ . '/config/app.php';

$page_title   = 'WisataKite - Wisata Pulau';
$css_file     = 'style.css';
$current_page = 'home';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';
?>

<section class="search-section" aria-label="Kategori Pulau">
    <div class="slider" aria-hidden="true">
        <div class="slides">
            <div class="slide"><img src="assets/img/index3.png" alt="Keindahan Pulau Bangka Belitung"></div>
            <div class="slide"><img src="assets/img/index2.png" alt="Panorama Pulau Gelasa"></div>
            <div class="slide"><img src="assets/img/index1.png" alt="Eksotisme Kepulauan"></div>
        </div>
    </div>
    <div class="content">
        <h2>🏝️ Wisata <span>Pulau</span></h2>
        <p class="hero-tagline">Gugusan Pulau Tropis Menawan di Tengah Birunya Laut Bangka Belitung</p>
        <div class="search-wrapper">
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Cari pulau eksotis..." aria-label="Cari pulau" autocomplete="off">
                <button type="button" id="search-btn" aria-label="Cari">🔍</button>
            </div>
            <div id="search-dropdown" class="search-dropdown" role="listbox" aria-label="Rekomendasi Destinasi"></div>
        </div>
    </div>
</section>

<main class="categories-container" id="main-content">
    <div class="section-header-row">
        <div class="section-header-title">
            <h2>Koleksi Wisata Pulau</h2>
            <p>Jelajahi pulau-pulau eksotis dengan terumbu karang dan kejernihan air laut</p>
        </div>
        <a href="detail.php" class="btn-all-destinations">Lihat Semua Destinasi &rarr;</a>
    </div>

    <div class="main-layout-row">
        <aside class="categories" aria-label="Kategori wisata">
            <p>Kategori</p>
            <a href="index.php">🌐 Semua</a>
            <a href="k_pantai.php">🏖️ Pantai</a>
            <a href="k_pulau.php" class="active-cat">🏝️ Pulau</a>
            <a href="k_sejarah.php">🏛️ Sejarah</a>
        </aside>

        <div class="destination-cards" id="cards-grid">
            <article class="destination-card">
                <div class="destination-card-img-wrap">
                    <img src="assets/img/pulau_gelasa.png" alt="Pulau Gelasa">
                </div>
                <div class="destination-card-body">
                    <p>Pulau Gelasa</p>
                    <span>📍 Bangka Tengah</span>
                </div>
                <div class="destination-card-footer">
                    <a href="detail.php" class="go-button">Lihat Detail &rarr;</a>
                </div>
            </article>

            <article class="destination-card">
                <div class="destination-card-img-wrap">
                    <img src="assets/img/pulau_lepar.png" alt="Pulau Lepar">
                </div>
                <div class="destination-card-body">
                    <p>Pulau Lepar</p>
                    <span>📍 Bangka Selatan</span>
                </div>
                <div class="destination-card-footer">
                    <a href="detail.php" class="go-button">Lihat Detail &rarr;</a>
                </div>
            </article>

            <article class="destination-card">
                <div class="destination-card-img-wrap">
                    <img src="assets/img/index3.png" alt="Pulau Lengkuas">
                </div>
                <div class="destination-card-body">
                    <p>Pulau Ketawai</p>
                    <span>📍 Bangka Tengah</span>
                </div>
                <div class="destination-card-footer">
                    <a href="detail.php" class="go-button">Lihat Detail &rarr;</a>
                </div>
            </article>

            <article class="destination-card">
                <div class="destination-card-img-wrap">
                    <img src="assets/img/pulau_gelasa.png" alt="Pulau Celagen">
                </div>
                <div class="destination-card-body">
                    <p>Pulau Celagen</p>
                    <span>📍 Bangka Selatan</span>
                </div>
                <div class="destination-card-footer">
                    <a href="detail.php" class="go-button">Lihat Detail &rarr;</a>
                </div>
            </article>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>