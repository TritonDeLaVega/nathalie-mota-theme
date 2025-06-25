<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- Mobile menu OUTSIDE the header -->
    <nav class="mobile-nav hidden" id="mobile-nav">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'main-menu',
            'container' => false,
            'menu_class' => 'mobile-menu',
        ));
        ?>
    </nav>

    <header class="site-header">
        <div class="header-container">
            <!-- Logo -->
            <div class="site-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/nathalie_mota_logo.png" alt="Logo Nathalie Mota">
                </a>
            </div>

            <!-- Menu desktop -->
            <nav class="main-nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'container' => false,
                    'menu_class' => 'menu',
                ));
                ?>
            </nav>

            <!-- Burger icon for mobile -->
            <div class="burger-menu" id="burger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>