<?php
// Préparation du lien dynamique pour "Mentions légales"
$ml_page = get_page_by_path('mentions-legales');
$ml_url = $ml_page ? get_permalink($ml_page->ID) : '#';

// Préparation du lien dynamique pour "Vie privée"
$privacy_url = get_permalink( get_option('wp_page_for_privacy_policy') );
?>

<footer class="site-footer">
    <ul class="footer-links">
        <li><a href="<?php echo esc_url($ml_url); ?>">MENTIONS LÉGALES</a></li>
        <li><a href="<?php echo esc_url($privacy_url); ?>">VIE PRIVÉE</a></li>
        <li><span>TOUS DROITS RÉSERVÉS</span></li>
    </ul>
</footer>

<?php
// Inclusion de la modale de contact
get_template_part('template_parts/contact-modal');
?>

<!-- Lightbox personnalisée (invisible au départ) -->
<div id="custom-lightbox" class="lightbox" style="display:none;">
    <div class="lightbox-overlay"></div>
    <div class="lightbox-content" tabindex="-1">
        <button class="lightbox-close" aria-label="Fermer">×</button>
        <div class="lightbox-center">
            <button class="lightbox-prev" aria-label="Photo précédente">← Précédente</button>
            <div class="lightbox-img-wrapper">
                <img src="" alt="" class="lightbox-img">
                <div class="lightbox-meta">
                    <span class="lightbox-ref"></span>
                    <span class="lightbox-cat"></span>
                </div>
            </div>
            <button class="lightbox-next" aria-label="Photo suivante">Suivante →</button>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
