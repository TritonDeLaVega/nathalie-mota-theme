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
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-0.jpeg" alt="photo 0" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-1.jpeg" alt="photo 1" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-2.jpeg" alt="photo 2" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-3.jpeg" alt="photo 3" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-4.jpeg" alt="photo 4" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-5.jpeg" alt="photo 5" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-6.jpeg" alt="photo 6" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-7.jpeg" alt="photo 7" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
    </div>

    <div class="load-more">
        <button>Charger plus</button>
    </div>
</main>

<?php get_footer(); ?>