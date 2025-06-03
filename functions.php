<?php
// Enqueue Google Fonts and custom styles/scripts
function mota_enqueue_assets()
{
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&family=Space+Mono:wght@400&display=swap', false);
    wp_enqueue_style('mota-style', get_stylesheet_uri());
    wp_enqueue_style('modal-style', get_template_directory_uri() . '/css/modal.css');

    // $script_path = get_template_directory() . '/js/scripts.js';
    // $script_version = file_exists($script_path) ? filemtime($script_path) : false;
    wp_enqueue_script('mota-lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0', true);
    // wp_enqueue_script('mota-script', get_template_directory_uri() . '/js/scripts.js', array(), $script_version, true);
    wp_enqueue_script('mota-script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);
}



add_action('wp_enqueue_scripts', 'mota_enqueue_assets');

// Déclarer le menu principal
function mota_register_menus()
{
    register_nav_menu('main-menu', 'Menu principal');
}
add_action('after_setup_theme', 'mota_register_menus');

add_filter('wpcf7_autop_or_not', '__return_false');
add_theme_support('post-thumbnails');

add_action('rest_api_init', function () {
    register_rest_route('nathalie-mota/v1', '/photos/', [
        'methods' => 'GET',
        'callback' => function ($request) {
            $paged = $request->get_param('paged') ?: 1;
            $args = [
                'post_type'      => 'photo',
                'posts_per_page' => 8,
                'paged'          => $paged,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'post_status'    => 'publish',
            ];
            $query = new WP_Query($args);
            $photos = [];
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                    $reference = get_post_meta(get_the_ID(), 'reference', true);
                    $categories = get_the_terms(get_the_ID(), 'categorie');
                    $category = ($categories && !is_wp_error($categories)) ? $categories[0]->name : '';
                    $photos[] = [
                        'title'     => get_the_title(),
                        'permalink' => get_permalink(),
                        'img_url'   => $img_url,
                        'img_alt'   => $img_alt,
                        'category'  => $category,
                        'reference' => $reference, // Ajoute la référence ici
                    ];
                }
                wp_reset_postdata();
            }
            return rest_ensure_response($photos);
        },
        'permission_callback' => '__return_true',
    ]);
});
function mota_enqueue_load_more_script()
{
    if (is_front_page() || is_home() || is_post_type_archive('photo')) {
        wp_enqueue_script(
            'mota-load-more',
            get_template_directory_uri() . '/js/load-more.js',
            array(),
            filemtime(get_template_directory() . '/js/load-more.js'),
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'mota_enqueue_load_more_script');
