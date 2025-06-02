document.addEventListener('DOMContentLoaded', function () {
    // Gestion du menu burger
    const burger = document.getElementById('burger-menu');
    const mobileNav = document.getElementById('mobile-nav');
    const body = document.body;

    if (burger && mobileNav) {
        const links = mobileNav.querySelectorAll('a');

        burger.addEventListener('click', () => {
            console.log('Burger menu cliqué');
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
                console.log(`Lien du menu mobile cliqué : ${link.getAttribute('href')}`);
                const target = link.getAttribute('href');

                if (target === '#contact' || link.classList.contains('open-contact-modal')) {
                    e.preventDefault();
                    console.log('Ouverture de la modale depuis un lien du menu mobile');
                    openContactModal();
                }

                mobileNav.classList.remove('visible');
                mobileNav.classList.add('hidden');
                burger.classList.remove('open');
                body.classList.remove('menu-open');
            });
        });
    }

    // Fonction pour ouvrir la modale
    function openContactModal() {
        console.log('Fonction openContactModal() appelée');
        const modal = document.getElementById('contact-modal');
        if (modal) {
            modal.classList.add('visible');
        }
    }

    // Fonction pour fermer la modale
    function closeContactModal() {
        console.log('Fonction closeContactModal() appelée');
        const modal = document.getElementById('contact-modal');
        if (modal) {
            modal.classList.remove('visible');
        }
    }

    document.addEventListener('click', function (e) {
        const target = e.target;

        if (target.closest('.open-contact-modal')) {
            e.preventDefault();
            console.log('Clique sur élément .open-contact-modal');
            openContactModal();
        }

        const modal = document.getElementById('contact-modal');
        if (modal && modal.classList.contains('visible')) {
            const modalContent = modal.querySelector('.modal-content');
            if (target === modal && !modalContent.contains(e.target)) {
                console.log('Clic en dehors de la modale, fermeture');
                closeContactModal();
            }
        }
    });

    
});
