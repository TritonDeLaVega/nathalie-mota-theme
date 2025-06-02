<footer class="site-footer">
    <ul class="footer-links">
        <li><a href="#">MENTIONS LÉGALES</a></li>
        <li><a href="#">VIE PRIVÉE</a></li>
        <li><a href="#">TOUS DROITS RÉSERVÉS</a></li>
    </ul>
</footer>

<?php
// Inclusion de la modale de contact
get_template_part('template_parts/contact-modal');
?>

<!-- Lightbox personnalisée (invisible au départ) -->
<!-- <div id="custom-lightbox" class="lightbox hidden" aria-hidden="true" role="dialog" aria-modal="true"> -->
<div id="custom-lightbox" class="lightbox" style="display:none;">
    <div class="lightbox-overlay"></div>
    <div class="lightbox-content" tabindex="-1">
        <button class="lightbox-close" aria-label="Fermer">×</button>
        <div class="lightbox-center">
            <button class="lightbox-prev" aria-label="Photo précédente">← Précédente</button>
            <div class="lightbox-img-wrapper">
                <img src="" alt="" class="lightbox-img">
                <div class="lightbox-meta">
                    <span class="lightbox-ref">RÉFÉRENCE DE LA PHOTO</span>
                    <span class="lightbox-cat">CATÉGORIE</span>
                </div>
            </div>
            <button class="lightbox-next" aria-label="Photo suivante">Suivante →</button>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>

</html>