// assets/js/script.js

document.addEventListener('DOMContentLoaded', function () {

    /* ----------------------------------------------------------------
       1. Hero Slider (auto-play with CSS transform)
    ---------------------------------------------------------------- */
    const slidesWrapper = document.querySelector('.slides');
    const slideItems = document.querySelectorAll('.slide');

    if (slidesWrapper && slideItems.length > 0) {
        let current = 0;
        const total = slideItems.length;

        function goToSlide(index) {
            current = (index + total) % total;
            slidesWrapper.style.transform = `translateX(-${current * 100}%)`;
        }

        // Auto-advance every 4 seconds
        setInterval(function () {
            goToSlide(current + 1);
        }, 4000);
    }

    /* ----------------------------------------------------------------
       2. Profile Sidebar (guest/user button)
    ---------------------------------------------------------------- */
    const guestBtn = document.getElementById('guest-btn');
    const profileSidebar = document.getElementById('profile-sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    function openSidebar() {
        if (!profileSidebar) return;
        profileSidebar.classList.add('active');
        if (sidebarOverlay) {
            sidebarOverlay.style.display = 'block';
            requestAnimationFrame(() => sidebarOverlay.classList.add('active'));
        }
        if (guestBtn) guestBtn.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        if (!profileSidebar) return;
        profileSidebar.classList.remove('active');
        if (sidebarOverlay) {
            sidebarOverlay.classList.remove('active');
            setTimeout(() => { sidebarOverlay.style.display = ''; }, 300);
        }
        if (guestBtn) guestBtn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    if (guestBtn && profileSidebar) {
        guestBtn.addEventListener('click', function (e) {
            e.preventDefault();
            profileSidebar.classList.contains('active') ? closeSidebar() : openSidebar();
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    // Mobile sidebar button (inside mobile nav)
    const mobileSidebarBtn = document.querySelector('.mobile-guest-btn');
    if (mobileSidebarBtn && profileSidebar) {
        mobileSidebarBtn.addEventListener('click', function (e) {
            e.preventDefault();
            closeNav();
            setTimeout(openSidebar, 300);
        });
    }

    /* ----------------------------------------------------------------
       3. Mobile Nav (hamburger drawer)
    ---------------------------------------------------------------- */
    const hamburger = document.getElementById('hamburger-btn');
    const mobileNav = document.getElementById('mobile-nav');
    const navOverlay = document.getElementById('nav-overlay');

    function openNav() {
        if (!mobileNav) return;
        hamburger && hamburger.classList.add('open');
        mobileNav.classList.add('active');
        if (navOverlay) {
            navOverlay.style.display = 'block';
            requestAnimationFrame(() => navOverlay.classList.add('active'));
        }
        document.body.style.overflow = 'hidden';
    }

    function closeNav() {
        if (!mobileNav) return;
        hamburger && hamburger.classList.remove('open');
        mobileNav.classList.remove('active');
        if (navOverlay) {
            navOverlay.classList.remove('active');
            setTimeout(() => { navOverlay.style.display = ''; }, 300);
        }
        document.body.style.overflow = '';
    }

    if (hamburger) {
        hamburger.addEventListener('click', function () {
            mobileNav && mobileNav.classList.contains('active') ? closeNav() : openNav();
        });
    }

    if (navOverlay) {
        navOverlay.addEventListener('click', closeNav);
    }

    /* ----------------------------------------------------------------
       4. Close overlays on Escape key
    ---------------------------------------------------------------- */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeSidebar();
            closeNav();
        }
    });

    /* ----------------------------------------------------------------
       5. Active nav link highlight based on current URL
    ---------------------------------------------------------------- */
    const currentPath = window.location.pathname.split('/').pop();
    document.querySelectorAll('.nav a, .mobile-nav a').forEach(link => {
        const href = link.getAttribute('href');
        if (href && href !== '#' && currentPath === href) {
            link.classList.add('active');
        }
    });

    /* ----------------------------------------------------------------
       6. Search Bar Recommendation Dropdown (Realtime Autocomplete)
    ---------------------------------------------------------------- */
    const searchInput = document.getElementById('search-input');
    const searchBtn = document.querySelector('.search-bar button') || document.getElementById('search-btn');

    if (searchInput) {
        // Pastikan dropdown container ada
        let searchDropdown = document.getElementById('search-dropdown');
        if (!searchDropdown) {
            searchDropdown = document.createElement('div');
            searchDropdown.id = 'search-dropdown';
            searchDropdown.className = 'search-dropdown';
            searchDropdown.setAttribute('role', 'listbox');
            searchDropdown.setAttribute('aria-label', 'Rekomendasi Destinasi');

            const searchBar = searchInput.closest('.search-bar');
            if (searchBar) {
                if (!searchBar.parentElement.classList.contains('search-wrapper')) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'search-wrapper';
                    searchBar.parentNode.insertBefore(wrapper, searchBar);
                    wrapper.appendChild(searchBar);
                    wrapper.appendChild(searchDropdown);
                } else {
                    searchBar.parentElement.appendChild(searchDropdown);
                }
            }
        }

        let debounceTimer = null;
        let activeIndex = -1;
        let currentResults = [];

        function escapeHtml(str) {
            if (!str) return '';
            return String(str)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function highlightMatch(text, query) {
            if (!text) return '';
            if (!query || !query.trim()) return escapeHtml(text);
            const safeText = escapeHtml(text);
            const safeQ = query.trim().replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            const regex = new RegExp(`(${safeQ})`, 'gi');
            return safeText.replace(regex, '<mark>$1</mark>');
        }

        function closeDropdown() {
            if (searchDropdown) {
                searchDropdown.classList.remove('show');
            }
            activeIndex = -1;
        }

        function updateHighlight(items) {
            items.forEach((item, idx) => {
                const isSelected = idx === activeIndex;
                item.classList.toggle('highlighted', isSelected);
                item.setAttribute('aria-selected', isSelected ? 'true' : 'false');
                if (isSelected) {
                    item.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
                }
            });
        }

        function renderDropdown(items, query) {
            activeIndex = -1;
            currentResults = items || [];

            if (!query || query.trim() === '') {
                searchDropdown.innerHTML = '';
                searchDropdown.classList.remove('show');
                return;
            }

            if (currentResults.length === 0) {
                searchDropdown.innerHTML = `
                    <div class="search-empty">
                        <span class="search-empty-icon">🏖️</span>
                        <p class="search-empty-text">Tidak ada rekomendasi untuk "<strong>${escapeHtml(query)}</strong>"</p>
                        <small style="color:#64748b; font-size: 0.8rem;">Coba cari nama pantai, pulau, atau situs bersejarah lainnya.</small>
                    </div>
                `;
                searchDropdown.classList.add('show');
                return;
            }

            const badgeClasses = {
                pantai: 'badge-pantai',
                pulau: 'badge-pulau',
                sejarah: 'badge-sejarah'
            };

            const badgeIcons = {
                pantai: '🏖️',
                pulau: '🏝️',
                sejarah: '🏛️'
            };

            let html = `
                <div class="search-dropdown-header">
                    <span>Rekomendasi Destinasi</span>
                    <span>${currentResults.length} Ditemukan</span>
                </div>
            `;

            currentResults.forEach((item, idx) => {
                const catKey = (item.category || '').toLowerCase();
                const badgeClass = badgeClasses[catKey] || '';
                const badgeIcon = badgeIcons[catKey] || '📍';
                const catLabel = item.category_label || item.category || 'Wisata';
                const targetUrl = item.url || `detail.php?id=${encodeURIComponent(item.id)}`;

                html += `
                    <a href="${escapeHtml(targetUrl)}" class="search-item" data-index="${idx}" role="option" aria-selected="false">
                        <img src="${escapeHtml(item.img)}" alt="${escapeHtml(item.name)}" class="search-item-img" onerror="this.onerror=null;this.src='assets/img/index2.png';">
                        <div class="search-item-info">
                            <span class="search-item-name">${highlightMatch(item.name, query)}</span>
                            <div class="search-item-meta">
                                <span>📍 ${highlightMatch(item.location, query)}</span>
                                <span class="search-item-badge ${badgeClass}">${badgeIcon} ${escapeHtml(catLabel)}</span>
                            </div>
                        </div>
                        <span class="search-item-arrow" aria-hidden="true">&rarr;</span>
                    </a>
                `;
            });

            searchDropdown.innerHTML = html;
            searchDropdown.classList.add('show');
        }

        function fetchRecommendations(query) {
            const trimmed = query.trim();
            if (trimmed.length === 0) {
                closeDropdown();
                return;
            }

            if (!searchDropdown.classList.contains('show')) {
                searchDropdown.innerHTML = `
                    <div class="search-loading">
                        <span class="search-spinner"></span>
                        <span>Mencari rekomendasi destinasi...</span>
                    </div>
                `;
                searchDropdown.classList.add('show');
            }

            fetch(`api/destinations.php?q=${encodeURIComponent(trimmed)}&limit=7`)
                .then(res => res.json())
                .then(json => {
                    if (searchInput.value.trim().toLowerCase() === trimmed.toLowerCase()) {
                        renderDropdown(json.data || [], trimmed);
                    }
                })
                .catch(() => {
                    searchDropdown.innerHTML = `
                        <div class="search-empty">
                            <span class="search-empty-icon">⚠️</span>
                            <p class="search-empty-text">Gagal memuat rekomendasi</p>
                        </div>
                    `;
                    searchDropdown.classList.add('show');
                });
        }

        // Event: input (dengan debounce)
        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            const query = this.value;
            if (!query.trim()) {
                closeDropdown();
                return;
            }
            debounceTimer = setTimeout(() => {
                fetchRecommendations(query);
            }, 180);
        });

        // Event: focus
        searchInput.addEventListener('focus', function () {
            if (this.value.trim()) {
                fetchRecommendations(this.value);
            }
        });

        // Event: keyboard navigation (Arrow Up, Arrow Down, Enter, Escape)
        searchInput.addEventListener('keydown', function (e) {
            const items = searchDropdown.querySelectorAll('.search-item');

            if (e.key === 'ArrowDown') {
                if (items.length && searchDropdown.classList.contains('show')) {
                    e.preventDefault();
                    activeIndex = (activeIndex + 1) % items.length;
                    updateHighlight(items);
                }
            } else if (e.key === 'ArrowUp') {
                if (items.length && searchDropdown.classList.contains('show')) {
                    e.preventDefault();
                    activeIndex = (activeIndex - 1 + items.length) % items.length;
                    updateHighlight(items);
                }
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (items.length && activeIndex >= 0 && items[activeIndex]) {
                    items[activeIndex].click();
                } else if (items.length && searchDropdown.classList.contains('show')) {
                    items[0].click();
                } else {
                    const q = this.value.trim();
                    if (q) {
                        window.location.href = `detail.php?q=${encodeURIComponent(q)}`;
                    }
                }
            } else if (e.key === 'Escape') {
                closeDropdown();
            }
        });

        // Event: Tombol cari (🔍)
        if (searchBtn) {
            searchBtn.addEventListener('click', function () {
                const items = searchDropdown.querySelectorAll('.search-item');
                if (items.length && activeIndex >= 0 && items[activeIndex]) {
                    items[activeIndex].click();
                } else if (items.length && searchDropdown.classList.contains('show')) {
                    items[0].click();
                } else {
                    const q = searchInput.value.trim();
                    if (q) {
                        window.location.href = `detail.php?q=${encodeURIComponent(q)}`;
                    }
                }
            });
        }

        // Event: Klik di luar untuk menutup dropdown
        document.addEventListener('click', function (e) {
            if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
                closeDropdown();
            }
        });
    }

});
