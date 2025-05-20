document.addEventListener('DOMContentLoaded', function () {
    // Gestion du menu burger
    const burger = document.getElementById('burger-menu');
    const mobileNav = document.getElementById('mobile-nav');
    const body = document.body;

    if (burger && mobileNav) {
        const links = mobileNav.querySelectorAll('a');

        burger.addEventListener('click', () => {
            const isVisible = mobileNav.classList.contains('visible');
            if (isVisible) {
                mobileNav.classList.remove('visible');
                mobileNav.classList.add('hidden');
                burger.classList.remove('open');
                body.classList.remove('menu-open');
            } else {
                mobileNav.classList.add('visible');
                mobileNav.classList.remove('hidden');
                burger.classList.add('open');
                body.classList.add('menu-open');
            }
        });

        links.forEach(link => {
            link.addEventListener('click', (e) => {
                const target = link.getAttribute('href');

                // Si c'est #contact ou a la classe .open-contact-modal, ouvrir la modale
                if (target === '#contact' || link.classList.contains('open-contact-modal')) {
                    e.preventDefault();
                    openContactModal();
                }

                // Fermer le menu mobile quoi qu'il arrive
                mobileNav.classList.remove('visible');
                mobileNav.classList.add('hidden');
                burger.classList.remove('open');
                body.classList.remove('menu-open');
            });
        });
    }

    // Fonctions de gestion de la modale contact
    function openContactModal() {
        const modal = document.getElementById('contact-modal');
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    function closeContactModal() {
        const modal = document.getElementById('contact-modal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    // Délégation d'événement (utile si la modale est ajoutée dynamiquement)
    document.addEventListener('click', function (e) {
        const target = e.target;

        // Ouverture via lien ou bouton
        if (target.matches('a[href="#contact"], .open-contact-modal')) {
            e.preventDefault();
            openContactModal();
        }

        // Fermeture via croix
        if (target.matches('#close-modal')) {
            e.preventDefault();
            closeContactModal();
        }
    });
});
