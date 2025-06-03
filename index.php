<?php get_header(); ?>

<!-- ✅ Image juste après le header -->
<?php if (!is_page('Single Photo')) : ?>
    <?php
    // Étape 1 : définir les critères de recherche
    $args = array(
        'post_type'      => 'photo',       // CPT "photo"
        'posts_per_page' => 1,             // Une seule photo
        'orderby'        => 'rand',        // Tirée au hasard
        'post_status'    => 'publish',     // Seulement les publiées
        'fields'         => 'ids',         // On ne récupère que les IDs
        'tax_query'      => array(
            array(
                'taxonomy' => 'format',
                'field'    => 'slug',
                'terms'    => 'paysage',
            ),
        ),
    );

    // Étape 2 : exécuter la requête
    $random_photo = new WP_Query($args);
    $ids = $random_photo->posts;

    if (!empty($ids)) {
        $id = $ids[0];
        $hero_img_url = get_the_post_thumbnail_url($id, 'full');
        $hero_img_alt = get_post_meta(get_post_thumbnail_id($id), '_wp_attachment_image_alt', true);
    }
    ?>

    <!-- ✅ Hero image + texte centré -->
    <div class="header-banner">
        <img src="<?php echo esc_url($hero_img_url); ?>" alt="<?php echo esc_attr($hero_img_alt); ?>" class="header-banner-image">
        <div class="hero-text">PHOTOGRAPHE EVENT</div> <!-- ✅ Texte déplacé ici -->
    </div>
<?php endif; ?>

<main class="gallery-page">
    <div class="filters">
        <select>
            <option>CATÉGORIES</option>
        </select>
        <select>
            <option>FORMATS</option>
        </select>
        <select>
            <option>TRIER PAR</option>
        </select>
    </div>

    <div class="gallery-grid">
        <?php
        // Requête pour récupérer les photos du CPT "photo"
        $args = array(
            'post_type'      => 'photo',
            'posts_per_page' => 8, // nombre d’images à afficher (ajuste si besoin)
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        );
        $photos_query = new WP_Query($args);

        if ($photos_query->have_posts()) :
            while ($photos_query->have_posts()) : $photos_query->the_post();
                $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                $categories = get_the_terms(get_the_ID(), 'categorie');
        ?>
                <div class="gallery-item">
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" />
                    <div class="overlay"></div>
                    <!-- Lien cliquable uniquement sur l'icône œil -->
                    <a href="<?php the_permalink(); ?>">
                        <div class="icon-eye"></div>
                    </a>
                    <div class="icon-fullscreen" data-full="<?php echo esc_url($img_url); ?>"></div>
                    <div class="text-bottom-left">
                        <?php
                        // Affiche le titre de l'image
                        the_title();
                        ?>
                    </div>
                    <div class="text-bottom-right">
                        <?php
                        // Affiche la première catégorie s’il existe
                        if ($categories && !is_wp_error($categories)) {
                            echo esc_html($categories[0]->name);
                        }
                        ?>
                    </div>
                </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Aucune photo trouvée.</p>';
        endif;
        ?>
    </div>

    <div class="load-more">
        <button>Charger plus</button>
    </div>
</main>

<?php get_footer(); ?>