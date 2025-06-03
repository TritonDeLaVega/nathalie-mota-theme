document.addEventListener('DOMContentLoaded', function () {
    let currentPage = 1;
    const loadMoreBtn = document.querySelector('.load-more button');
    const galleryGrid = document.querySelector('.gallery-grid');

    if (!loadMoreBtn || !galleryGrid) return;

    loadMoreBtn.addEventListener('click', function () {
        currentPage++;
        loadMoreBtn.disabled = true;
        loadMoreBtn.textContent = "Chargement...";

        fetch(`/wp-json/nathalie-mota/v1/photos/?paged=${currentPage}`)
            .then(res => res.json())
            .then(photos => {
                if (!photos.length) {
                    loadMoreBtn.textContent = "Plus de photos";
                    return;
                }

                photos.forEach(photo => {
                    const item = document.createElement('div');
                    item.className = 'gallery-item';
                    item.innerHTML = `
        <img src="${photo.img_url}" alt="${photo.img_alt}" />
        <div class="overlay"></div>
        <a href="${photo.permalink}">
            <div class="icon-eye"></div>
        </a>
        <div class="icon-fullscreen" 
            data-full="${photo.img_url}" 
            data-ref="${photo.reference || ''}" 
            data-cat="${photo.category || ''}">
        </div>
        <div class="text-bottom-left">${photo.title}</div>
        <div class="text-bottom-right">${photo.category}</div>
    `;
                    galleryGrid.appendChild(item);

                    // Ajoute l'écouteur pour la lightbox sur les nouveaux éléments
                    const icon = item.querySelector('.icon-fullscreen');
                    if (icon) {
                        icon.addEventListener('click', function () {
                            const lightbox = document.getElementById('custom-lightbox');
                            const lightboxImg = lightbox.querySelector('.lightbox-img');
                            const refSpan = lightbox.querySelector('.lightbox-ref');
                            const catSpan = lightbox.querySelector('.lightbox-cat');
                            lightboxImg.setAttribute('src', icon.getAttribute('data-full'));
                            if (refSpan) refSpan.textContent = icon.getAttribute('data-ref') || '';
                            if (catSpan) catSpan.textContent = icon.getAttribute('data-cat') || '';
                            lightbox.style.display = 'flex';
                            lightbox.setAttribute('aria-hidden', 'false');
                            document.body.classList.add('lightbox-open');
                        });
                    }

                });

                loadMoreBtn.disabled = false;
                loadMoreBtn.textContent = "Charger plus";
                if (photos.length < 8) {
                    loadMoreBtn.disabled = true;
                    loadMoreBtn.textContent = "Plus de photos";
                }
            })
            .catch(() => {
                loadMoreBtn.disabled = false;
                loadMoreBtn.textContent = "Charger plus";
                alert("Erreur lors du chargement des photos.");
            });
    });
});