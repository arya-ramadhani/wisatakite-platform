<?php
// k_sejarah.php
require_once __DIR__ . '/config/app.php';

$page_title   = 'WisataKite - Wisata Sejarah';
$css_file     = 'style.css';
$current_page = 'home';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';
?>

<section class="search-section" aria-label="Kategori Sejarah">
    <div class="slider" aria-hidden="true">
        <div class="slides">
            <div class="slide"><img src="assets/img/index1.png" alt="Situs Sejarah Bangka Belitung"></div>
            <div class="slide"><img src="assets/img/index2.png" alt="Pagoda Nusantara Budaya"></div>
            <div class="slide"><img src="assets/img/index3.png" alt="Warisan Sejarah Nusantara"></div>
        </div>
    </div>
    <div class="content">
        <h2>🏛️ Wisata <span>Sejarah</span></h2>
        <p class="hero-tagline">Napak Tilas Jejak Peninggalan Bersejarah dan Akulturasi Budaya</p>
        <div class="search-wrapper">
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Cari situs sejarah..." aria-label="Cari sejarah" autocomplete="off">
                <button type="button" id="search-btn" aria-label="Cari">🔍</button>
            </div>
            <div id="search-dropdown" class="search-dropdown" role="listbox" aria-label="Rekomendasi Destinasi"></div>
        </div>
    </div>
</section>

<main class="categories-container" id="main-content">
    <div class="section-header-row">
        <div class="section-header-title">
            <h2>Koleksi Wisata Sejarah</h2>
            <p>Jelajahi situs-situs bersejarah, cagar budaya, dan warisan kearifan lokal</p>
        </div>
        <a href="detail.php" class="btn-all-destinations">Lihat Semua Destinasi &rarr;</a>
    </div>

    <div class="main-layout-row">
        <aside class="categories" aria-label="Kategori wisata">
            <p>Kategori</p>
            <a href="index.php">🌐 Semua</a>
            <a href="k_pantai.php">🏖️ Pantai</a>
            <a href="k_pulau.php">🏝️ Pulau</a>
            <a href="k_sejarah.php" class="active-cat">🏛️ Sejarah</a>
        </aside>

        <div class="destination-cards" id="cards-grid">
            <article class="destination-card">
                <div class="destination-card-img-wrap">
                    <img src="assets/img/pagoda_nusantara.png" alt="Pagoda Nusantara">
                </div>
                <div class="destination-card-body">
                    <p>Pagoda Nusantara</p>
                    <span>📍 Sungailiat</span>
                </div>
                <div class="destination-card-footer">
                    <a href="detail.php" class="go-button">Lihat Detail &rarr;</a>
                </div>
            </article>

            <article class="destination-card">
                <div class="destination-card-img-wrap">
                    <img src="assets/img/pagoda_nusantara.png" alt="Klenteng Dewi Laut">
                </div>
                <div class="destination-card-body">
                    <p>Klenteng Dewi Laut</p>
                    <span>📍 Pangkalpinang</span>
                </div>
                <div class="destination-card-footer">
                    <a href="detail.php" class="go-button">Lihat Detail &rarr;</a>
                </div>
            </article>

            <article class="destination-card">
                <div class="destination-card-img-wrap">
                    <img src="assets/img/index1.png" alt="Museum Timah Indonesia">
                </div>
                <div class="destination-card-body">
                    <p>Museum Timah Indonesia</p>
                    <span>📍 Pangkalpinang</span>
                </div>
                <div class="destination-card-footer">
                    <a href="detail.php" class="go-button">Lihat Detail &rarr;</a>
                </div>
            </article>

            <article class="destination-card">
                <div class="destination-card-img-wrap">
                    <img src="assets/img/pagoda_nusantara.png" alt="Pesanggrahan Menumbing">
                </div>
                <div class="destination-card-body">
                    <p>Pesanggrahan Menumbing</p>
                    <span>📍 Mentok, Bangka Barat</span>
                </div>
                <div class="destination-card-footer">
                    <a href="detail.php" class="go-button">Lihat Detail &rarr;</a>
                </div>
            </article>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>