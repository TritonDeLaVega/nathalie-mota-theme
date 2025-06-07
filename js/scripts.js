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

    // Fonction pour détecter une image paysage
    const photoImage = document.querySelector('.photo-image img');
    if (!photoImage) return;

    photoImage.addEventListener('load', function () {
        const ratio = photoImage.naturalWidth / photoImage.naturalHeight;
        const wrapper = photoImage.closest('.photo-image');
        if (ratio > 1.1) { // Paysage (ajuste le seuil si besoin)
            wrapper.classList.add('landscape');
        } else {
            wrapper.classList.remove('landscape');
        }
    });

    // Si l'image est déjà chargée (cache)
    if (photoImage.complete) {
        photoImage.dispatchEvent(new Event('load'));
    }

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

        // Détection paysage/portrait après chargement de la nouvelle image
        mainImg.addEventListener('load', function detectOrientation() {
            const ratio = mainImg.naturalWidth / mainImg.naturalHeight;
            const wrapper = mainImg.closest('.photo-image');
            if (ratio > 1.1) {
                wrapper.classList.add('landscape');
            } else {
                wrapper.classList.remove('landscape');
            }
            mainImg.removeEventListener('load', detectOrientation);
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

    // Optionnel : clic sur la miniature = revenir à la photo courante initiale
    thumbImg?.addEventListener('click', function () {
        index = currentIndex;
        updateImages();
    });
});