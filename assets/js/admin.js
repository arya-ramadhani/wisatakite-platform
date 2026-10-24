// assets/js/admin.js - WisataKite Admin Panel Interactions
document.addEventListener('DOMContentLoaded', function () {
    'use strict';

    const wrapper = document.querySelector('.admin-wrapper');
    const toggleBtn = document.getElementById('admin-sidebar-toggle');
    const closeBtn = document.getElementById('sidebar-close-btn');
    const overlay = document.getElementById('admin-sidebar-overlay');
    const menuLinks = document.querySelectorAll('.menu li a');
    const sectionNameEl = document.getElementById('current-section-name');

    // Section Titles Map
    const sectionTitles = {
        '#home': 'Beranda',
        '#akun': 'Kelola Akun',
        '#informasi': 'Informasi Lengkap Akun',
        '#destinasi': 'Destinasi Wisata',
        '#pemesanan': 'Pemesanan'
    };

    /* -------------------------------------------------------------
       1. SIDEBAR TOGGLE (OPEN / CLOSE)
       ------------------------------------------------------------- */
    const isMobile = () => window.innerWidth <= 768;

    // Restore desktop preference from localStorage
    if (!isMobile() && localStorage.getItem('admin_sidebar_collapsed') === '1') {
        if (wrapper) wrapper.classList.add('sidebar-collapsed');
    }

    function toggleSidebar() {
        if (!wrapper) return;
        if (isMobile()) {
            const isOpen = wrapper.classList.toggle('sidebar-open');
            if (overlay) {
                if (isOpen) {
                    overlay.style.display = 'block';
                    requestAnimationFrame(() => overlay.classList.add('active'));
                    document.body.style.overflow = 'hidden';
                } else {
                    closeMobileSidebar();
                }
            }
        } else {
            const isCollapsed = wrapper.classList.toggle('sidebar-collapsed');
            localStorage.setItem('admin_sidebar_collapsed', isCollapsed ? '1' : '0');
        }
    }

    function closeMobileSidebar() {
        if (!wrapper) return;
        wrapper.classList.remove('sidebar-open');
        if (overlay) {
            overlay.classList.remove('active');
            setTimeout(() => { overlay.style.display = 'none'; }, 300);
        }
        document.body.style.overflow = '';
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', toggleSidebar);
    }
    if (closeBtn) {
        closeBtn.addEventListener('click', closeMobileSidebar);
    }
    if (overlay) {
        overlay.addEventListener('click', closeMobileSidebar);
    }

    window.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && isMobile() && wrapper && wrapper.classList.contains('sidebar-open')) {
            closeMobileSidebar();
        }
    });

    window.addEventListener('resize', function () {
        if (!isMobile() && wrapper && wrapper.classList.contains('sidebar-open')) {
            closeMobileSidebar();
        }
    });

    /* -------------------------------------------------------------
       2. ACTIVE MENU INDICATOR & SCROLLSPY
       ------------------------------------------------------------- */
    function setActiveMenu(targetHash) {
        if (!targetHash) return;
        let matched = false;

        menuLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href === targetHash) {
                link.classList.add('active-menu');
                matched = true;
            } else if (href && href.startsWith('#')) {
                link.classList.remove('active-menu');
            }
        });

        if (matched && sectionNameEl && sectionTitles[targetHash]) {
            sectionNameEl.textContent = sectionTitles[targetHash];
        }
    }

    // Click handler for menu items
    menuLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href && href.startsWith('#')) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = href.substring(1);
                const targetElem = document.getElementById(targetId);

                // Update active indicator immediately
                setActiveMenu(href);

                // Smooth scroll to section with topbar offset
                if (targetElem) {
                    const topbarHeight = 70;
                    const elemPosition = targetElem.getBoundingClientRect().top + window.pageYOffset;
                    window.scrollTo({
                        top: elemPosition - topbarHeight,
                        behavior: 'smooth'
                    });
                }

                // Update URL hash without jumping
                if (history.pushState) {
                    history.pushState(null, null, href);
                } else {
                    window.location.hash = href;
                }

                // If on mobile, close the sidebar drawer after clicking
                if (isMobile()) {
                    closeMobileSidebar();
                }
            });
        }
    });

    // ScrollSpy: Update active menu as user scrolls
    const trackedSections = document.querySelectorAll('section[id]');

    function handleScrollSpy() {
        const scrollPosition = window.scrollY + 120; // offset for topbar

        let currentSectionId = '';
        trackedSections.forEach(section => {
            const top = section.offsetTop;
            const height = section.offsetHeight;
            if (scrollPosition >= top && scrollPosition < top + height) {
                currentSectionId = section.getAttribute('id');
            }
        });

        // Fallback for top of page
        if (window.scrollY < 100) {
            currentSectionId = 'home';
        }

        if (currentSectionId) {
            setActiveMenu('#' + currentSectionId);
        }
    }

    let scrollTimeout;
    window.addEventListener('scroll', function () {
        if (scrollTimeout) cancelAnimationFrame(scrollTimeout);
        scrollTimeout = requestAnimationFrame(handleScrollSpy);
    }, { passive: true });

    // Initial check on page load (e.g. if loaded with #destinasi or #akun)
    if (window.location.hash) {
        setActiveMenu(window.location.hash);
        const initialElem = document.querySelector(window.location.hash);
        if (initialElem) {
            setTimeout(() => {
                const topbarHeight = 70;
                const elemPos = initialElem.getBoundingClientRect().top + window.pageYOffset;
                window.scrollTo({
                    top: elemPos - topbarHeight,
                    behavior: 'smooth'
                });
            }, 100);
        }
    } else {
        setActiveMenu('#home');
    }
});
