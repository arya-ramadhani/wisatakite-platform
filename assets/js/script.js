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

});
