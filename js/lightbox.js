// JS pour Lightbox 
document.addEventListener('DOMContentLoaded', function () {
    const lightbox = document.getElementById('custom-lightbox');
    const lightboxImg = lightbox.querySelector('.lightbox-img');
    const fullscreenIcons = document.querySelectorAll('.icon-fullscreen');
    const closeBtn = lightbox.querySelector('.lightbox-close');
    const refSpan = lightbox.querySelector('.lightbox-ref');
    const catSpan = lightbox.querySelector('.lightbox-cat');

    // Ouvre la lightbox
    fullscreenIcons.forEach(icon => {
        icon.addEventListener('click', function (e) {
            const imageUrl = icon.getAttribute('data-full');
            const ref = icon.getAttribute('data-ref') || '';
            const cat = icon.getAttribute('data-cat') || '';
            lightboxImg.setAttribute('src', imageUrl);
            if (refSpan) refSpan.textContent = ref;
            if (catSpan) catSpan.textContent = cat;
            lightbox.style.display = 'flex';
            lightbox.setAttribute('aria-hidden', 'false');
            document.body.classList.add('lightbox-open');
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