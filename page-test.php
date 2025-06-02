<?php
// Étape 1 : définir les critères de recherche
$args = array(
    'post_type'      => 'photo',       // CPT "photo"
    'posts_per_page' => 1,             // Une seule photo
    'orderby'        => 'rand',        // Tirée au hasard
    'post_status'    => 'publish',     // Seulement les publiées
    'fields'         => 'ids',         // On ne récupère que les IDs
    'tax_query'      => array(         // Filtrage par taxonomie
        array(
            'taxonomy' => 'format',    // Nom de la taxonomie
            'field'    => 'slug',      // On utilise le slug
            'terms'    => 'paysage',   // Le terme recherché
        ),
    ),
);


// Étape 2 : exécuter la requête
$random_photo = new WP_Query($args);

// echo '<pre>';
// print_r($random_photo);
// echo '</pre>';

$ids = $random_photo->posts; // Contient juste un tableau avec des IDs

if (!empty($ids)) {
    $id = $ids[0];
    // echo get_the_title($id); // 
    $hero_img_url = get_the_post_thumbnail_url($id, 'full'); // Ok
    $hero_img_alt = get_post_meta( get_post_thumbnail_id($id), '_wp_attachment_image_alt', true);
}
