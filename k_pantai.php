<?php
// k_pantai.php
require_once __DIR__ . '/config/app.php';

$page_title   = 'WisataKite - Wisata Pantai';
$css_file     = 'style.css';
$current_page = 'home';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';
?>

<section class="search-section" aria-label="Kategori Pantai">
    <div class="slider" aria-hidden="true">
        <div class="slides">
            <div class="slide"><img src="assets/img/index2.png" alt="Wisata Pantai Bangka Belitung"></div>
            <div class="slide"><img src="assets/img/index3.png" alt="Pesona Pantai Pesisir"></div>
            <div class="slide"><img src="assets/img/index1.png" alt="Pantai Romodong & Teluk"></div>
        </div>
    </div>
    <div class="content">
        <h2>🏖️ Wisata <span>Pantai</span></h2>
        <p class="hero-tagline">Pesona Hamparan Pasir Putih dan Bebatuan Granit Eksotis</p>
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Cari pantai di Bangka Belitung..." aria-label="Cari pantai">
            <button type="button" aria-label="Cari">🔍</button>
        </div>
    </div>
</section>

<main class="categories-container" id="main-content">
    <div class="section-header-row">
        <div class="section-header-title">
            <h2>Koleksi Wisata Pantai</h2>
            <p>Jelajahi pantai-pantai memukau dengan panorama ombak yang menenangkan</p>
        </div>
        <a href="detail.php" class="btn-all-destinations">Lihat Semua Destinasi &rarr;</a>
    </div>

    <div class="main-layout-row">
        <aside class="categories" aria-label="Kategori wisata">
            <p>Kategori</p>
            <a href="index.php">🌐 Semua</a>
            <a href="k_pantai.php" class="active-cat">🏖️ Pantai</a>
            <a href="k_pulau.php">🏝️ Pulau</a>
            <a href="k_sejarah.php">🏛️ Sejarah</a>
        </aside>

        <div class="destination-cards" id="cards-grid">
            <article class="destination-card">
                <div class="destination-card-img-wrap">
                    <img src="assets/img/pantai_remodong.png" alt="Pantai Romodong">
                </div>
                <div class="destination-card-body">
                    <p>Pantai Romodong</p>
                    <span>📍 Belinyu</span>
                </div>
                <div class="destination-card-footer">
                    <a href="detail.php" class="go-button">Lihat Detail &rarr;</a>
                </div>
            </article>

            <article class="destination-card">
                <div class="destination-card-img-wrap">
                    <img src="assets/img/pulau_lepar.png" alt="Pantai Lepar">
                </div>
                <div class="destination-card-body">
                    <p>Pantai Lepar</p>
                    <span>📍 Belinyu</span>
                </div>
                <div class="destination-card-footer">
                    <a href="detail.php" class="go-button">Lihat Detail &rarr;</a>
                </div>
            </article>

            <article class="destination-card">
                <div class="destination-card-img-wrap">
                    <img src="assets/img/pantai_remodong.png" alt="Pantai Teluk Uber">
                </div>
                <div class="destination-card-body">
                    <p>Pantai Teluk Uber</p>
                    <span>📍 Sungailiat</span>
                </div>
                <div class="destination-card-footer">
                    <a href="detail.php" class="go-button">Lihat Detail &rarr;</a>
                </div>
            </article>

            <article class="destination-card">
                <div class="destination-card-img-wrap">
                    <img src="assets/img/pantai_remodong.png" alt="Pantai Matras">
                </div>
                <div class="destination-card-body">
                    <p>Pantai Matras</p>
                    <span>📍 Sungailiat</span>
                </div>
                <div class="destination-card-footer">
                    <a href="detail.php" class="go-button">Lihat Detail &rarr;</a>
                </div>
            </article>
        </div>
    </div>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
<script>
(function () {
    const searchInput = document.getElementById('search-input');
    const grid = document.getElementById('cards-grid');
    if (searchInput && grid) {
        searchInput.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            grid.querySelectorAll('.destination-card').forEach(c => {
                c.style.display = c.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });
    }
})();
</script>