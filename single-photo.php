<?php

/**
 * Template pour une photo individuelle
 * Template Name: Single Photo
 */

get_header(); ?>

<main id="main-content" class="single-photo">

  <section class="photo-detail">
    <div class="photo-info">
      <h1><em>Team</em><br>Mariée</h1>
      <p><strong>Référence :</strong> BF2400</p>
      <p><strong>Catégorie :</strong> Mariage</p>
      <p><strong>Format :</strong> Portrait</p>
      <p><strong>Type :</strong> Numérique</p>
      <p><strong>Année :</strong> 2022</p>

      <div class="contact-section">
        <p>Cette photo vous intéresse ?</p>
        <button class="open-contact-modal">Contact</button>
      </div>
    </div>

    <div class="photo-image">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/nathalie-15.jpeg" alt="Team Mariée">
      <div class="lightbox-thumbnail">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/nathalie-0.jpeg" alt="Miniature">

        <div class="thumbnail-arrows">
          <button class="arrow-left" aria-label="Précédent">←</button>
          <button class="arrow-right" aria-label="Suivant">→</button>
        </div>
      </div>


    </div>
  </section>

  <section class="photo-suggestions">
    <h2>Vous aimerez aussi</h2>
    <div class="suggestions-grid">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/nathalie-4.jpeg" alt="Suggestion 1">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/nathalie-5.jpeg" alt="Suggestion 2">
    </div>
  </section>

</main>

<?php get_footer(); ?>