<?php
// Enqueue Google Fonts and custom styles/scripts
function mota_enqueue_assets() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&family=Space+Mono:wght@400&display=swap', false);
    wp_enqueue_style('mota-style', get_stylesheet_uri());
    wp_enqueue_style('modal-style', get_template_directory_uri() . '/css/modal.css');
    wp_enqueue_script('mota-script', get_template_directory_uri() . '/js/scripts.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'mota_enqueue_assets');

// Déclarer le menu principal
function mota_register_menus() {
    register_nav_menu('main-menu', 'Menu principal');
}
add_action('after_setup_theme', 'mota_register_menus');
add_filter('wpcf7_autop_or_not', '__return_false');
add_theme_support('post-thumbnails');