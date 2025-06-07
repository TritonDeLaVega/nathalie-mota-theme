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
        <select id="filter-categorie">
            <option value="">CATÉGORIES</option>
            <?php
            $categories = get_terms([
                'taxonomy' => 'categorie',
                'hide_empty' => true,
            ]);
            foreach ($categories as $cat) {
                echo '<option value="' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</option>';
            }
            ?>
        </select>
        <select id="filter-format">
            <option value="">FORMATS</option>
            <?php
            $formats = get_terms([
                'taxonomy' => 'format',
                'hide_empty' => true,
            ]);
            foreach ($formats as $format) {
                echo '<option value="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</option>';
            }
            ?>
        </select>
        <select id="filter-order">
            <option value="DESC">TRIER PAR</option>
            <option value="DESC">Plus récentes</option>
            <option value="ASC">Plus anciennes</option>
        </select>
    </div>

    <div class="gallery-grid">
        <!-- Les photos seront injectées ici par JS -->
    </div>

    <div class="load-more">
        <button>Charger plus</button>
    </div>

</main>

<?php get_footer(); ?>