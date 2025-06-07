<?php

/**
 *Template pour une photo individuelle
 */
get_header(); ?>

<main id="main-content" class="single-photo">

  <div class="main-inner-container">

    <div class="photo-detail-wrapper">
      <div class="photo-info">
        <div class="photo-meta">
          <?php
          // Récupération des champs personnalisés et taxonomies
          $reference = get_post_meta(get_the_ID(), 'reference', true);
          $categorie = get_the_terms(get_the_ID(), 'categorie');
          $format = get_the_terms(get_the_ID(), 'format');
          $type = get_post_meta(get_the_ID(), 'type', true);
          $annee = get_post_meta(get_the_ID(), 'annee', true);
          ?>
          <h1>
            <em><?php the_title(); ?></em>
          </h1>
          <p><strong>Référence :</strong> <?php echo esc_html($reference); ?></p>
          <p><strong>Catégorie :</strong> <?php echo esc_html($categorie && !is_wp_error($categorie) ? $categorie[0]->name : ''); ?></p>
          <p><strong>Format :</strong> <?php echo esc_html($format && !is_wp_error($format) ? $format[0]->name : ''); ?></p>
          <p><strong>Type :</strong> <?php echo esc_html($type); ?></p>
          <p><strong>Année :</strong> <?php echo esc_html($annee); ?></p>
        </div>
        <div class="info-separator"></div>
      </div>

      <section class="photo-detail">
        <div class="photo-image">
          <?php
          if (has_post_thumbnail()) {
            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
            echo '<img src="' . esc_url($img_url) . '" alt="' . esc_attr($img_alt) . '">';
          }
          ?>
        </div>
      </section>
    </div>

    <div class="contact-section-container">
      <div class="contact-section">
        <div class="contact-section-content">
          <p>Cette photo vous intéresse ?</p>
          <button class="open-contact-modal" data-ref="<?php echo esc_attr($reference); ?>">Contact</button>
        </div>
        <div class="lightbox-thumbnail">
            <?php
            // Affiche la miniature (par exemple la même image ou une autre taille)
            if (has_post_thumbnail()) {
              $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
              echo '<img src="' . esc_url($thumb_url) . '" alt="Miniature">';
            }
            ?>
            <div class="thumbnail-arrows">
              <button class="arrow-left" aria-label="Précédent">←</button>
              <button class="arrow-right" aria-label="Suivant">→</button>
            </div>
          </div>
      </div>
    </div>

    <section class="photo-suggestions">
      <h2>Vous aimerez aussi</h2>
      <div class="suggestions-grid">
        <?php
        $current_cats = get_the_terms(get_the_ID(), 'categorie');
        $current_cat_id = ($current_cats && !is_wp_error($current_cats)) ? $current_cats[0]->term_id : 0;

        $suggest_args = array(
          'post_type'      => 'photo',
          'posts_per_page' => 2,
          'post__not_in'   => array(get_the_ID()),
          'orderby'        => 'rand',
          'post_status'    => 'publish',
          'tax_query'      => $current_cat_id ? array(
            array(
              'taxonomy' => 'categorie',
              'field'    => 'term_id',
              'terms'    => $current_cat_id,
            ),
          ) : array(),
        );
        $suggest_query = new WP_Query($suggest_args);

        $j = 0; // Compteur pour data-index

        if ($suggest_query->have_posts()) :
          while ($suggest_query->have_posts()) : $suggest_query->the_post();
            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
            $categorie = get_the_terms(get_the_ID(), 'categorie');
            $reference = get_post_meta(get_the_ID(), 'reference', true);
            $cat_name = ($categorie && !is_wp_error($categorie)) ? $categorie[0]->name : '';
        ?>
            <div class="suggestion-item">
              <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>">
              <div class="overlay"></div>
              <a href="<?php the_permalink(); ?>" aria-label="Voir la photo en détail">
                <div class="icon-eye"></div>
              </a>
              <div class="icon-fullscreen"
                data-full="<?php echo esc_url($img_url); ?>"
                data-ref="<?php echo esc_attr($reference); ?>"
                data-cat="<?php echo esc_attr($cat_name); ?>"
                data-index="<?php echo $j; ?>">
              </div>
              <div class="text-bottom-left"><?php the_title(); ?></div>
              <div class="text-bottom-right"><?php echo esc_html($cat_name); ?></div>
            </div>
        <?php
            $j++;
          endwhile;
          wp_reset_postdata();
        endif;
        ?>
      </div>
    </section>

  </div><!-- /.main-inner-container -->

  <?php
  // Récupérer toutes les photos du CPT
  $all_photos = get_posts([
    'post_type' => 'photo',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
  ]);

  $photos_data = [];
  $current_id = get_the_ID();
  $current_index = 0;

  foreach ($all_photos as $i => $photo) {
    $categorie = get_the_terms($photo->ID, 'categorie');
    $format = get_the_terms($photo->ID, 'format');
    $photos_data[] = [
      'id' => $photo->ID,
      'title' => get_the_title($photo->ID),
      'img' => get_the_post_thumbnail_url($photo->ID, 'large'),
      'thumb' => get_the_post_thumbnail_url($photo->ID, 'thumbnail'),
      'reference' => get_post_meta($photo->ID, 'reference', true),
      'categorie' => ($categorie && !is_wp_error($categorie)) ? $categorie[0]->name : '',
      'format' => ($format && !is_wp_error($format)) ? $format[0]->name : '',
      'type' => get_post_meta($photo->ID, 'type', true),
      'annee' => get_post_meta($photo->ID, 'annee', true),
    ];
    if ($photo->ID == $current_id) {
      $current_index = $i;
    }
  }
  ?>
  <script>
    window.photoGallery = <?php echo json_encode([
                            'photos' => $photos_data,
                            'currentIndex' => $current_index
                          ]); ?>;
  </script>

</main>

<?php get_footer(); ?>