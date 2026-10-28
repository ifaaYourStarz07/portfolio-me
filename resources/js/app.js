document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Navigation Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

    function toggleMobileMenu(isOpen) {
        if (!mobileMenu || !mobileMenuBtn) return;
        const expanded = isOpen !== undefined ? isOpen : mobileMenuBtn.getAttribute('aria-expanded') !== 'true';
        mobileMenuBtn.setAttribute('aria-expanded', expanded);
        if (expanded) {
            mobileMenu.classList.remove('hidden');
            if (mobileMenuBackdrop) mobileMenuBackdrop.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            mobileMenu.classList.add('hidden');
            if (mobileMenuBackdrop) mobileMenuBackdrop.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', () => toggleMobileMenu());
    }

    if (mobileMenuBackdrop) {
        mobileMenuBackdrop.addEventListener('click', () => toggleMobileMenu(false));
    }

    mobileNavLinks.forEach(link => {
        link.addEventListener('click', () => toggleMobileMenu(false));
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && mobileMenu && !mobileMenu.classList.contains('hidden')) {
            toggleMobileMenu(false);
            mobileMenuBtn?.focus();
        }
    });

    // 2. Scroll Reveal Animations with IntersectionObserver
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!prefersReducedMotion && 'IntersectionObserver' in window) {
        const revealElements = document.querySelectorAll('.reveal-on-scroll');
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));
    } else {
        document.querySelectorAll('.reveal-on-scroll').forEach(el => el.classList.add('is-visible'));
    }

    // 3. Project Filter Functionality
    const filterButtons = document.querySelectorAll('.project-filter-btn');
    const projectCards = document.querySelectorAll('.project-card');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.getAttribute('data-filter');

            // Active button state
            filterButtons.forEach(b => {
                b.classList.remove('bg-periwinkle', 'text-midnight', 'font-semibold');
                b.classList.add('bg-transparent', 'text-dusty-lavender', 'border-muted-indigo/40');
                b.setAttribute('aria-pressed', 'false');
            });
            btn.classList.add('bg-periwinkle', 'text-midnight', 'font-semibold');
            btn.classList.remove('bg-transparent', 'text-dusty-lavender', 'border-muted-indigo/40');
            btn.setAttribute('aria-pressed', 'true');

            // Filter cards
            projectCards.forEach(card => {
                const category = card.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // 4. Navbar Background Blur on Scroll
    const navbar = document.getElementById('main-navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 40) {
                navbar.classList.add('bg-midnight/90', 'backdrop-blur-md', 'shadow-lg', 'border-b', 'border-muted-indigo/20');
            } else {
                navbar.classList.remove('bg-midnight/90', 'backdrop-blur-md', 'shadow-lg', 'border-b', 'border-muted-indigo/20');
            }
        }, { passive: true });
    }
});
