<footer class="site-footer">
    <ul class="footer-links">
        <li><a href="#">MENTIONS LÉGALES</a></li>
        <li><a href="#">VIE PRIVÉE</a></li>
        <li><a href="#">TOUS DROITS RÉSERVÉS</a></li>
    </ul>
</footer>

<?php
// On insère la modale en dehors du <footer>, mais toujours dans le <body>
get_template_part('template_parts/contact-modal');
wp_footer();
?>
</body>
</html>
