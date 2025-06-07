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
                if (target === '#contact' || link.classList.contains('open-contact-modal')) {
                    e.preventDefault();
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

    // Fonction pour remplir le champ RÉF. PHOTO dans la modale
    function setContactModalRef(ref) {
        setTimeout(() => {
            const refInput = document.getElementById('ref-photo');
            if (refInput) {
                refInput.value = ref || '';
            }
        }, 100);
    }

    // Fonction pour mettre à jour dynamiquement la référence sur le bouton contact
    function updateContactButtonRef(newRef) {
        const contactBtn = document.querySelector('.open-contact-modal');
        if (contactBtn) {
            contactBtn.setAttribute('data-ref', newRef || '');
        }
    }

    document.addEventListener('click', function (e) {
        const target = e.target;

        // Clic sur le bouton de la section contact de la page single-photo.php
        if (target.closest('.open-contact-modal')) {
            e.preventDefault();
            // Récupère la référence de la photo courante dans le tableau JS
            let ref = '';
            if (window.photoGallery && window.photoGallery.photos && typeof index !== 'undefined') {
                ref = window.photoGallery.photos[index]?.reference || '';
            }
            setContactModalRef(ref);
            openContactModal();
        }

        // Fermer la modale si clic en dehors du contenu
        const modal = document.getElementById('contact-modal');
        if (modal && modal.classList.contains('visible')) {
            const modalContent = modal.querySelector('.modal-content');
            if (target === modal && !modalContent.contains(e.target)) {
                closeContactModal();
            }
        }
    });

    // Navigation de la miniature de la page single-photo.
    if (!window.photoGallery) return;

    let { photos, currentIndex } = window.photoGallery;
    let index = currentIndex;

    const mainImg = document.querySelector('.photo-image img');
    const thumbImg = document.querySelector('.lightbox-thumbnail img');
    const leftBtn = document.querySelector('.arrow-left');
    const rightBtn = document.querySelector('.arrow-right');

    // Sélectionne les éléments d'infos
    const titleElem = document.querySelector('.photo-info h1 em');
    const refElem = document.querySelector('.photo-meta p:nth-child(2)');
    const catElem = document.querySelector('.photo-meta p:nth-child(3)');
    const formatElem = document.querySelector('.photo-meta p:nth-child(4)');
    const typeElem = document.querySelector('.photo-meta p:nth-child(5)');
    const anneeElem = document.querySelector('.photo-meta p:nth-child(6)');

    function updateSuggestions() {
        const suggestionsGrid = document.querySelector('.suggestions-grid');
        if (!suggestionsGrid) return;

        const currentCat = photos[index].categorie;
        const currentId = photos[index].id;

        // Filtrer les photos de la même catégorie, hors photo courante
        const suggestions = photos.filter(
            photo => photo.categorie === currentCat && photo.id !== currentId
        ).slice(0, 2); // Limite à 2 suggestions

        // Générer le HTML
        suggestionsGrid.innerHTML = suggestions.map(photo => `
            <div class="suggestion-item">
                <img src="${photo.img}" alt="${photo.title}">
                <div class="overlay"></div>
                <a href="/photo/${photo.id}" aria-label="Voir la photo en détail">
                    <div class="icon-eye"></div>
                </a>
                <div class="icon-fullscreen"
                    data-full="${photo.img}"
                    data-ref="${photo.reference}"
                    data-cat="${photo.categorie}">
                </div>
                <div class="text-bottom-left">${photo.title}</div>
                <div class="text-bottom-right">${photo.categorie}</div>
            </div>
        `).join('');
    }

    function updateImages() {
        if (!photos[index]) return;
        mainImg.src = photos[index].img;
        mainImg.alt = photos[index].title;
        if (thumbImg) {
            thumbImg.src = photos[index].thumb;
            thumbImg.alt = 'Miniature de ' + photos[index].title;
        }

        // Met à jour les infos
        if (titleElem) titleElem.textContent = photos[index].title || '';
        if (refElem) refElem.innerHTML = '<strong>Référence :</strong> ' + (photos[index].reference || '');
        if (catElem) catElem.innerHTML = '<strong>Catégorie :</strong> ' + (photos[index].categorie || '');
        if (formatElem) formatElem.innerHTML = '<strong>Format :</strong> ' + (photos[index].format || '');
        if (typeElem) typeElem.innerHTML = '<strong>Type :</strong> ' + (photos[index].type || '');
        if (anneeElem) anneeElem.innerHTML = '<strong>Année :</strong> ' + (photos[index].annee || '');

        // Met à jour dynamiquement la référence sur le bouton contact
        updateContactButtonRef(photos[index].reference);
        // Met à jour les suggestions
        updateSuggestions();
    }

    // Survol flèche gauche : aperçu miniature précédente
    if (thumbImg && leftBtn) {
        leftBtn.addEventListener('mouseenter', function () {
            const prevIndex = (index - 1 + photos.length) % photos.length;
            thumbImg.src = photos[prevIndex].thumb;
            thumbImg.alt = 'Miniature de ' + photos[prevIndex].title;
        });
        leftBtn.addEventListener('mouseleave', function () {
            thumbImg.src = photos[index].thumb;
            thumbImg.alt = 'Miniature de ' + photos[index].title;
        });
    }
    // Survol flèche droite : aperçu miniature suivante
    if (thumbImg && rightBtn) {
        rightBtn.addEventListener('mouseenter', function () {
            const nextIndex = (index + 1) % photos.length;
            thumbImg.src = photos[nextIndex].thumb;
            thumbImg.alt = 'Miniature de ' + photos[nextIndex].title;
        });
        rightBtn.addEventListener('mouseleave', function () {
            thumbImg.src = photos[index].thumb;
            thumbImg.alt = 'Miniature de ' + photos[index].title;
        });
    }

    leftBtn?.addEventListener('click', function () {
        index = (index - 1 + photos.length) % photos.length;
        updateImages();
    });

    rightBtn?.addEventListener('click', function () {
        index = (index + 1) % photos.length;
        updateImages();
    });

});