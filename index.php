<?php get_header(); ?>

<!-- ✅ Image juste après le header -->
<?php if (!is_page('Single Photo')) : ?>
    <?php
    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 1,
        'orderby'        => 'rand',
        'post_status'    => 'publish',
        'fields'         => 'ids',
        'tax_query'      => array(
            array(
                'taxonomy' => 'format',
                'field'    => 'slug',
                'terms'    => 'paysage',
            ),
        ),
    );
    $random_photo = new WP_Query($args);
    $ids = $random_photo->posts;

    if (!empty($ids)) {
        $id = $ids[0];
        $hero_img_url = get_the_post_thumbnail_url($id, 'full');
        $hero_img_alt = get_post_meta(get_post_thumbnail_id($id), '_wp_attachment_image_alt', true);
    }
    ?>

    <div class="header-banner">
        <img src="<?php echo esc_url($hero_img_url); ?>" alt="<?php echo esc_attr($hero_img_alt); ?>" class="header-banner-image">
        <div class="hero-text">PHOTOGRAPHE EVENT</div>
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
        $args = array(
            'post_type'      => 'photo',
            'posts_per_page' => 8,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        );
        $photos_query = new WP_Query($args);

        $i = 0; // Compteur pour data-index

        if ($photos_query->have_posts()) :
            while ($photos_query->have_posts()) : $photos_query->the_post();
                $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                $categories = get_the_terms(get_the_ID(), 'categorie');
                $reference = get_post_meta(get_the_ID(), 'reference', true);
                $cat_name = ($categories && !is_wp_error($categories)) ? $categories[0]->name : '';
        ?>
                <div class="gallery-item">
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" />
                    <div class="overlay"></div>
                    <a href="<?php the_permalink(); ?>">
                        <div class="icon-eye"></div>
                    </a>
                    <div
                        class="icon-fullscreen"
                        data-full="<?php echo esc_url($img_url); ?>"
                        data-ref="<?php echo esc_attr($reference); ?>"
                        data-cat="<?php echo esc_attr($cat_name); ?>"
                        data-index="<?php echo $i; ?>"></div>
                    <div class="text-bottom-left">
                        <?php the_title(); ?>
                    </div>
                    <div class="text-bottom-right">
                        <?php echo esc_html($cat_name); ?>
                    </div>
                </div>
        <?php
                $i++;
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