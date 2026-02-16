<script>
    // Vanilla JS for Mobile Menu
    const btn = document.getElementById('mobile-menu-btn');
    const overlay = document.getElementById('mobile-menu-overlay');
    const panel = document.getElementById('mobile-menu-panel');
    const iconHamburger = document.getElementById('icon-hamburger');
    const iconClose = document.getElementById('icon-close');
    let isMenuOpen = false;

    function toggleMobileMenu() {
        isMenuOpen = !isMenuOpen;

        if (isMenuOpen) {
            // Open Menu
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            panel.classList.remove('opacity-0', 'translate-y-[-20px]', 'pointer-events-none', '-translate-y-10');
            panel.classList.add('translate-y-0', 'opacity-100');

            // Icon Animation
            iconHamburger.classList.add('opacity-0', 'rotate-90');
            iconClose.classList.remove('opacity-0', '-rotate-90');
            iconClose.classList.add('opacity-100', 'rotate-0');

            btn.setAttribute('aria-expanded', 'true');
        } else {
            // Close Menu
            overlay.classList.add('opacity-0', 'pointer-events-none');
            panel.classList.remove('translate-y-0', 'opacity-100');
            panel.classList.add('opacity-0', '-translate-y-10', 'pointer-events-none');

            // Icon Animation
            iconHamburger.classList.remove('opacity-0', 'rotate-90');
            iconClose.classList.remove('opacity-100', 'rotate-0');
            iconClose.classList.add('opacity-0', '-rotate-90');

            btn.setAttribute('aria-expanded', 'false');
        }
    }

    btn.addEventListener('click', toggleMobileMenu);
</script>