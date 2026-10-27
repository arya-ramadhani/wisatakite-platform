// assets/js/admin.js - WisataKite Admin Panel Interactions & Navigation
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        const wrapper = document.querySelector('.admin-wrapper');
        const sidebar = document.getElementById('admin-sidebar');
        const toggleBtn = document.getElementById('admin-sidebar-toggle');
        const closeBtn = document.getElementById('sidebar-close-btn');
        const overlay = document.getElementById('admin-sidebar-overlay');
        const menuLinks = document.querySelectorAll('.menu li a');
        const sectionNameEl = document.getElementById('current-section-name');
        const tabSections = document.querySelectorAll('.admin-tab-section');

        const sectionTitles = {
            'home': 'Beranda',
            'akun': 'Kelola Akun',
            'informasi': 'Informasi Pribadi',
            'destinasi': 'Destinasi Wisata',
            'pemesanan': 'Pemesanan',
            'semua': 'Semua Bagian'
        };

        const isMobile = () => window.innerWidth <= 768;

        /* -------------------------------------------------------------
           1. RESTORE DESKTOP SIDEBAR STATE
           ------------------------------------------------------------- */
        if (!isMobile()) {
            const savedState = localStorage.getItem('wisatakite_sidebar_collapsed');
            if (savedState === '1' && wrapper) {
                wrapper.classList.add('sidebar-collapsed');
            }
        }

        /* -------------------------------------------------------------
           2. SIDEBAR TOGGLE (OPEN / CLOSE)
           ------------------------------------------------------------- */
        function toggleSidebar() {
            if (!wrapper) return;

            if (isMobile()) {
                // Mobile: Drawer off-canvas toggle
                const isOpen = wrapper.classList.toggle('sidebar-open');
                if (overlay) {
                    if (isOpen) {
                        overlay.classList.add('active');
                        document.body.style.overflow = 'hidden';
                    } else {
                        closeMobileSidebar();
                    }
                }
            } else {
                // Desktop: Mini-sidebar / Collapsed toggle
                const isCollapsed = wrapper.classList.toggle('sidebar-collapsed');
                localStorage.setItem('wisatakite_sidebar_collapsed', isCollapsed ? '1' : '0');
            }
        }

        function closeMobileSidebar() {
            if (!wrapper) return;
            wrapper.classList.remove('sidebar-open');
            if (overlay) {
                overlay.classList.remove('active');
            }
            document.body.style.overflow = '';
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function (e) {
                e.preventDefault();
                toggleSidebar();
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', function (e) {
                e.preventDefault();
                closeMobileSidebar();
            });
        }

        if (overlay) {
            overlay.addEventListener('click', function () {
                closeMobileSidebar();
            });
        }

        // Close mobile drawer on ESC key
        window.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && isMobile() && wrapper && wrapper.classList.contains('sidebar-open')) {
                closeMobileSidebar();
            }
            // Keyboard shortcut Ctrl+B or Cmd+B to toggle sidebar
            if ((e.ctrlKey || e.metaKey) && (e.key === 'b' || e.key === 'B')) {
                e.preventDefault();
                toggleSidebar();
            }
        });

        // Close mobile drawer when window resized to desktop
        window.addEventListener('resize', function () {
            if (!isMobile() && wrapper && wrapper.classList.contains('sidebar-open')) {
                closeMobileSidebar();
            }
        });

        /* -------------------------------------------------------------
           3. TAB / SECTION SWITCHING ("PINDAH MENU")
           ------------------------------------------------------------- */
        function switchTab(targetId, updateHash) {
            if (!targetId) targetId = 'home';
            targetId = targetId.replace(/^#/, '');

            const validTabs = ['home', 'akun', 'informasi', 'destinasi', 'pemesanan', 'semua'];
            if (!validTabs.includes(targetId)) {
                targetId = 'home';
            }

            // A. Update Active State in Sidebar Menu
            menuLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href === '#' + targetId || (targetId === 'home' && href === '#home')) {
                    link.classList.add('active-menu');
                } else if (href && href.startsWith('#')) {
                    link.classList.remove('active-menu');
                }
            });

            // B. Update Breadcrumb Title in Topbar
            if (sectionNameEl && sectionTitles[targetId]) {
                sectionNameEl.textContent = sectionTitles[targetId];
            }

            // C. Switch Visible Sections
            if (targetId === 'semua') {
                if (wrapper) wrapper.classList.add('show-all-tabs');
                tabSections.forEach(sec => {
                    sec.classList.add('active');
                    sec.style.display = 'block';
                });
            } else {
                if (wrapper) wrapper.classList.remove('show-all-tabs');
                tabSections.forEach(sec => {
                    const secId = sec.getAttribute('id');
                    if (secId === targetId) {
                        sec.classList.add('active');
                        sec.style.display = 'block';
                    } else {
                        sec.classList.remove('active');
                        sec.style.display = 'none';
                    }
                });
            }

            // D. Scroll to top of content smoothly
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

            // E. Update URL hash without reload
            if (updateHash !== false) {
                if (history.pushState) {
                    history.pushState(null, null, '#' + targetId);
                } else {
                    window.location.hash = '#' + targetId;
                }
            }

            // F. Close mobile sidebar after navigation
            if (isMobile()) {
                closeMobileSidebar();
            }
        }

        // Click handler for Sidebar Menu Links
        menuLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && href.startsWith('#')) {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = href.substring(1);
                    switchTab(targetId, true);
                });
            }
        });

        // Click handler for in-page quick links (e.g. buttons on Beranda overview cards)
        document.addEventListener('click', function (e) {
            const tabBtn = e.target.closest('[data-tab-switch]');
            if (tabBtn) {
                e.preventDefault();
                const targetId = tabBtn.getAttribute('data-tab-switch');
                switchTab(targetId, true);
            }
        });

        // Listen for browser back / forward navigation
        window.addEventListener('hashchange', function () {
            const hash = window.location.hash ? window.location.hash.substring(1) : 'home';
            switchTab(hash, false);
        });

        /* -------------------------------------------------------------
           4. INITIALIZE ON PAGE LOAD
           ------------------------------------------------------------- */
        let initialTab = 'home';
        if (window.location.hash) {
            const cleanHash = window.location.hash.substring(1);
            if (sectionTitles[cleanHash]) {
                initialTab = cleanHash;
            }
        }
        switchTab(initialTab, false);
    });
})();
