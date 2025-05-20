<?php get_header(); ?>

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
        <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-0.jpeg" alt="photo 0">
        <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-1.jpeg" alt="photo 1">
        <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-2.jpeg" alt="photo 2">
        <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-3.jpeg" alt="photo 3">
        <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-4.jpeg" alt="photo 4">
        <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-5.jpeg" alt="photo 5">
        <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-6.jpeg" alt="photo 6">
        <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-7.jpeg" alt="photo 7">
    </div>

    <div class="load-more">
        <button>Charger plus</button>
    </div>
</main>

<?php get_footer(); ?>