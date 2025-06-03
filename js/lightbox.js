document.addEventListener('DOMContentLoaded', function () {
    const lightbox = document.getElementById('custom-lightbox');
    const lightboxImg = lightbox.querySelector('.lightbox-img');
    const closeBtn = lightbox.querySelector('.lightbox-close');
    const refSpan = lightbox.querySelector('.lightbox-ref');
    const catSpan = lightbox.querySelector('.lightbox-cat');
    const prevBtn = lightbox.querySelector('.lightbox-prev');
    const nextBtn = lightbox.querySelector('.lightbox-next');
    const overlay = lightbox.querySelector('.lightbox-overlay');

    let imagesArray = [];
    let currentIndex = 0;

    // Fonction pour récupérer toutes les icônes fullscreen visibles sur la page
    function getAllFullscreenIcons() {
        return Array.from(document.querySelectorAll('.icon-fullscreen'));
    }

    // Construit un tableau d'images à partir des icônes fullscreen
    function buildImagesArray() {
        return getAllFullscreenIcons().map(icon => ({
            img: icon.getAttribute('data-full'),
            ref: icon.getAttribute('data-ref') || '',
            cat: icon.getAttribute('data-cat') || ''
        }));
    }

    // Ouvre la lightbox à l'index donné
    function openLightbox(index) {
        imagesArray = buildImagesArray(); // Toujours à jour si AJAX ou navigation
        currentIndex = index;
        showImage(currentIndex);
        lightbox.style.display = 'flex';
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.classList.add('lightbox-open');
    }

    // Affiche l'image à l'index donné
    function showImage(index) {
        const imgData = imagesArray[index];
        if (!imgData) return;
        lightboxImg.setAttribute('src', imgData.img);
        if (refSpan) refSpan.textContent = imgData.ref;
        if (catSpan) catSpan.textContent = imgData.cat;
    }

    // Ajoute l'écouteur sur chaque icône fullscreen
    function setFullscreenListeners() {
        getAllFullscreenIcons().forEach((icon, idx) => {
            icon.onclick = function (e) {
                e.preventDefault();
                openLightbox(idx);
            };
        });
    }

    setFullscreenListeners();

    // Navigation précédente
    prevBtn.addEventListener('click', function () {
        if (imagesArray.length === 0) return;
        currentIndex = (currentIndex - 1 + imagesArray.length) % imagesArray.length;
        showImage(currentIndex);
    });

    // Navigation suivante
    nextBtn.addEventListener('click', function () {
        if (imagesArray.length === 0) return;
        currentIndex = (currentIndex + 1) % imagesArray.length;
        showImage(currentIndex);
    });

    // Ferme la lightbox
    closeBtn.addEventListener('click', function () {
        lightbox.style.display = 'none';
        lightbox.setAttribute('aria-hidden', 'true');
        lightboxImg.setAttribute('src', '');
        document.body.classList.remove('lightbox-open');
    });

    // Ferme la lightbox si on clique sur l'overlay
    if (overlay) {
        overlay.addEventListener('click', function () {
            lightbox.style.display = 'none';
            lightbox.setAttribute('aria-hidden', 'true');
            lightboxImg.setAttribute('src', '');
            document.body.classList.remove('lightbox-open');
        });
    }

    // Ferme la lightbox avec la touche Echap et navigation clavier
    document.addEventListener('keydown', function (e) {
        if (lightbox.style.display !== 'none') {
            if (e.key === 'Escape' || e.key === 'Esc') {
                lightbox.style.display = 'none';
                lightbox.setAttribute('aria-hidden', 'true');
                lightboxImg.setAttribute('src', '');
                document.body.classList.remove('lightbox-open');
            }
            if (imagesArray.length > 0) {
                if (e.key === 'ArrowLeft') prevBtn.click();
                if (e.key === 'ArrowRight') nextBtn.click();
            }
        }
    });

    // Si des images sont ajoutées dynamiquement (ex: load-more), il faut réinitialiser les écouteurs
    document.addEventListener('galleryUpdated', function () {
        setFullscreenListeners();
        imagesArray = buildImagesArray();
    });
});