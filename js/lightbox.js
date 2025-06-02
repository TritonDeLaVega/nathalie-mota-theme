// JS pour Lightbox 
document.addEventListener('DOMContentLoaded', function () {
    const lightbox = document.getElementById('custom-lightbox');
    const lightboxImg = lightbox.querySelector('.lightbox-img');
    const fullscreenIcons = document.querySelectorAll('.icon-fullscreen');
    const closeBtn = lightbox.querySelector('.lightbox-close');

    // fullscreenIcons.forEach(icon => {
    //     icon.addEventListener('click', function (e) {
    //         console.log('Icône fullscreen cliquée');
    //         const imageUrl = icon.getAttribute('data-full');
    //         lightboxImg.setAttribute('src', imageUrl);
    //         lightbox.classList.remove('hidden');
    //         lightbox.setAttribute('aria-hidden', 'false');
    //     });
    // });

    closeBtn.addEventListener('click', function () {
        console.log('Bouton de fermeture de la lightbox cliqué');
        lightbox.style.display = 'none'; // Ajouté : masque la lightbox
        lightbox.setAttribute('aria-hidden', 'true');
        lightboxImg.setAttribute('src', '');
    });

    fullscreenIcons.forEach(icon => {
        icon.addEventListener('click', function (e) {
            console.log('Icône fullscreen cliquée');
            const imageUrl = icon.getAttribute('data-full');
            lightboxImg.setAttribute('src', imageUrl);
            lightbox.style.display = 'block'; // Ajouté : affiche la lightbox
            lightbox.setAttribute('aria-hidden', 'false');
        });
    });
});