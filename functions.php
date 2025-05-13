<?php
function mota_enqueue_assets() {
    wp_enqueue_style('mota-style', get_stylesheet_uri());
    wp_enqueue_script('mota-script', get_template_directory_uri() . '/js/scripts.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'mota_enqueue_assets');

function mota_register_menus() {
    register_nav_menus(array(
        'main-menu' => __('Menu principal'),
    ));
}
add_action('after_setup_theme', 'mota_register_menus');
