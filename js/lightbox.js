// JS pour Lightbox 
document.addEventListener('DOMContentLoaded', function () {
    const lightbox = document.getElementById('custom-lightbox');
    const lightboxImg = lightbox.querySelector('.lightbox-img');
    const fullscreenIcons = document.querySelectorAll('.icon-fullscreen');
    const closeBtn = lightbox.querySelector('.lightbox-close');

    // Ouvre la lightbox
    fullscreenIcons.forEach(icon => {
        icon.addEventListener('click', function (e) {
            const imageUrl = icon.getAttribute('data-full');
            lightboxImg.setAttribute('src', imageUrl);
            lightbox.style.display = 'flex'; // Utilise flex pour le centrage
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.classList.add('lightbox-open'); // Empêche le scroll du body
        });
    });

    // Ferme la lightbox
    closeBtn.addEventListener('click', function () {
        lightbox.style.display = 'none';
        lightbox.setAttribute('aria-hidden', 'true');
        lightboxImg.setAttribute('src', '');
        document.body.classList.remove('lightbox-open'); // Rétablit le scroll du body
    });

    // Ferme la lightbox si on clique sur l'overlay (optionnel)
    const overlay = lightbox.querySelector('.lightbox-overlay');
    if (overlay) {
        overlay.addEventListener('click', function () {
            lightbox.style.display = 'none';
            lightbox.setAttribute('aria-hidden', 'true');
            lightboxImg.setAttribute('src', '');
            document.body.classList.remove('lightbox-open');
        });
    }

    // Ferme la lightbox avec la touche Echap
    document.addEventListener('keydown', function (e) {
        if (lightbox.style.display !== 'none' && (e.key === 'Escape' || e.key === 'Esc')) {
            lightbox.style.display = 'none';
            lightbox.setAttribute('aria-hidden', 'true');
            lightboxImg.setAttribute('src', '');
            document.body.classList.remove('lightbox-open');
        }
    });
});