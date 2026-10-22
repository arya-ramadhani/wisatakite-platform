<?php
// index.php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';

$page_title   = 'WisataKite - Jelajahi Wisata Bangka Belitung';
$css_file     = 'style.css';
$current_page = 'home';
$body_class   = 'page-home';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
include __DIR__ . '/includes/sidebar.php';
?>

<!-- Hero Slider & Search Section -->
<section class="search-section" aria-label="Pencarian destinasi wisata">
    <div class="slider" aria-hidden="true">
        <div class="slides">
            <div class="slide"><img src="assets/img/index2.png" alt="Pesona Wisata Bangka Belitung"></div>
            <div class="slide"><img src="assets/img/index3.png" alt="Keindahan Pulau Bangka Belitung"></div>
            <div class="slide"><img src="assets/img/index1.png" alt="Warisan Budaya Bangka Belitung"></div>
        </div>
    </div>
    <div class="content">
        <h2>Wisata<span>Kite</span></h2>
        <p class="hero-tagline">Temukan &amp; Jelajahi Keindahan Wisata Terbaik di Bangka Belitung</p>
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Cari destinasi wisata..." aria-label="Cari destinasi">
            <button type="button" aria-label="Cari">🔍</button>
        </div>
    </div>
</section>

<!-- Main Container: Section Header + Layout -->
<main class="categories-container" id="main-content">

    <div class="section-header-row">
        <div class="section-header-title">
            <h2 id="section-title">Destinasi Pilihan</h2>
            <p id="section-subtitle">Rekomendasi objek wisata pantai, gugusan pulau eksotis, dan situs bersejarah</p>
        </div>
        <a href="detail.php" class="btn-all-destinations">Lihat Semua Destinasi &rarr;</a>
    </div>

    <div class="main-layout-row">
        <!-- Sidebar Kategori -->
        <aside class="categories" aria-label="Kategori wisata">
            <p>Kategori</p>
            <a href="#" class="cat-link active-cat" data-category="all"   id="cat-all">🌐 Semua</a>
            <a href="#" class="cat-link"             data-category="pantai"  id="cat-pantai">🏖️ Pantai</a>
            <a href="#" class="cat-link"             data-category="pulau"   id="cat-pulau">🏝️ Pulau</a>
            <a href="#" class="cat-link"             data-category="sejarah" id="cat-sejarah">🏛️ Sejarah</a>
        </aside>

        <!-- Cards Grid — diisi oleh JS -->
        <div class="destination-cards" id="cards-grid" aria-live="polite" aria-label="Daftar destinasi wisata">
            <!-- Loading skeleton tampil saat JS belum jalan -->
            <div class="card-skeleton"></div>
            <div class="card-skeleton"></div>
            <div class="card-skeleton"></div>
        </div>
    </div>

</main>

<!-- Inline script: category AJAX (dipisah dari script.js agar tidak konflik) -->
<script>
(function () {
    'use strict';

    const grid        = document.getElementById('cards-grid');
    const catLinks    = document.querySelectorAll('.cat-link');
    const sectionTitle    = document.getElementById('section-title');
    const sectionSubtitle = document.getElementById('section-subtitle');
    const searchInput = document.getElementById('search-input');

    const TITLES = {
        all:     ['Destinasi Pilihan',    'Rekomendasi objek wisata pantai, gugusan pulau eksotis, dan situs bersejarah'],
        pantai:  ['Wisata Pantai',        'Pesona hamparan pasir putih dan bebatuan granit eksotis'],
        pulau:   ['Wisata Pulau',         'Jelajahi gugusan pulau tropis yang memukau'],
        sejarah: ['Wisata Sejarah',       'Warisan budaya dan situs bersejarah Bangka Belitung'],
    };

    // Jumlah kartu yang ditampilkan di home: hanya 3
    const HOME_LIMIT = 3;

    function buildCard(d) {
        return `<article class="destination-card" data-name="${d.name.toLowerCase()}" data-location="${d.location.toLowerCase()}">
            <div class="destination-card-img-wrap">
                <img src="${d.img}" alt="${d.name}" loading="lazy">
            </div>
            <div class="destination-card-body">
                <p>${d.name}</p>
                <span>📍 ${d.location}</span>
            </div>
            <div class="destination-card-footer">
                <a href="detail.php?id=${d.id}" class="go-button">Lihat Detail &rarr;</a>
            </div>
        </article>`;
    }

    function showSkeleton() {
        grid.innerHTML = '<div class="card-skeleton"></div><div class="card-skeleton"></div><div class="card-skeleton"></div>';
    }

    function showEmpty(category) {
        grid.innerHTML = `<div class="empty-state">
            <span>🗺️</span>
            <p>Belum ada destinasi untuk kategori <strong>${category}</strong>.</p>
        </div>`;
    }

    function loadCategory(category) {
        showSkeleton();

        // Update judul seksi
        const [title, sub] = TITLES[category] || TITLES.all;
        sectionTitle.textContent    = title;
        sectionSubtitle.textContent = sub;

        // Update active state kategori
        catLinks.forEach(l => l.classList.toggle('active-cat', l.dataset.category === category));

        // Fetch JSON
        const url = `api/destinations.php?category=${encodeURIComponent(category)}&limit=${HOME_LIMIT}`;
        fetch(url)
            .then(r => r.json())
            .then(json => {
                if (!json.data || json.data.length === 0) {
                    showEmpty(category);
                    syncHeights();
                    return;
                }
                grid.innerHTML = json.data.map(buildCard).join('');

                // Re-apply search filter if user typed something
                if (searchInput && searchInput.value.trim()) {
                    filterCards(searchInput.value.toLowerCase().trim());
                }
                // Equalise grid height with categories sidebar
                syncHeights();
            })
            .catch(() => {
                grid.innerHTML = '<div class="empty-state"><span>⚠️</span><p>Gagal memuat destinasi. Silakan coba lagi.</p></div>';
                syncHeights();
            });
    }

    function filterCards(query) {
        grid.querySelectorAll('.destination-card').forEach(card => {
            const text = card.dataset.name + ' ' + card.dataset.location;
            card.style.display = text.includes(query) ? '' : 'none';
        });
    }

    // Category link click (no page refresh)
    catLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            loadCategory(this.dataset.category);
        });
    });

    // Real-time search
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            filterCards(this.value.toLowerCase().trim());
        });
    }

    // ── Sync card grid height = categories sidebar height ──────────────
    function syncHeights() {
        const cats = document.querySelector('.categories');
        if (!cats || !grid) return;
        // Reset first so natural height can be measured
        grid.style.height = '';
        grid.style.minHeight = '';
        // Set grid height to match categories sidebar
        const h = cats.offsetHeight;
        if (h > 0) {
            grid.style.height    = h + 'px';
            grid.style.minHeight = h + 'px';
        }
    }

    // Also sync on window resize
    window.addEventListener('resize', syncHeights);

    // Load default on page ready (3 destinasi semua kategori)
    loadCategory('all');

})();
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>