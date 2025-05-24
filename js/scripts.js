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

                // Ouvre la modale si le lien cible #contact ou a la classe spéciale
                if (target === '#contact' || link.classList.contains('open-contact-modal')) {
                    e.preventDefault();
                    openContactModal();
                }

                // Fermer le menu mobile quoi qu’il arrive
                mobileNav.classList.remove('visible');
                mobileNav.classList.add('hidden');
                burger.classList.remove('open');
                body.classList.remove('menu-open');
            });
        });
    }

    // Fonction pour ouvrir la modale
    function openContactModal() {
        const modal = document.getElementById('contact-modal');
        if (modal) {
            modal.classList.add('visible');
        }
    }

    // Fonction pour fermer la modale
    function closeContactModal() {
        const modal = document.getElementById('contact-modal');
        if (modal) {
            modal.classList.remove('visible');
        }
    }

    // Ouverture depuis n’importe quel élément avec la classe
    document.addEventListener('click', function (e) {
        const target = e.target;

        // Ouvrir si clic sur un élément de la classe .open-contact-modal
        if (target.closest('.open-contact-modal')) {
            e.preventDefault();
            openContactModal();
        }

        // Fermer si clic en dehors du contenu de la modale
        const modal = document.getElementById('contact-modal');
        if (modal && modal.classList.contains('visible')) {
            const modalContent = modal.querySelector('.modal-content');
            if (target === modal && !modalContent.contains(e.target)) {
                closeContactModal();
            }
        }
    });
});
