<?php

/**
 *Template pour une photo individuelle
*/
get_header(); ?>

<main id="main-content" class="single-photo">

  <div class="photo-detail-wrapper">
    <div class="photo-info">
      <div class="photo-meta">
        <h1><em>Team</em><br>Mariée</h1>
        <p><strong>Référence :</strong> BF2400</p>
        <p><strong>Catégorie :</strong> Mariage</p>
        <p><strong>Format :</strong> Portrait</p>
        <p><strong>Type :</strong> Numérique</p>
        <p><strong>Année :</strong> 2022</p>
      </div>

      <div class="contact-section">
        <p>Cette photo vous intéresse ?</p>
        <button class="open-contact-modal">Contact</button>
      </div>
    </div>

    <section class="photo-detail">
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
  </div>

  <section class="photo-suggestions">
    <h2>Vous aimerez aussi</h2>
    <div class="suggestions-grid">

      <div class="suggestion-item">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/nathalie-4.jpeg" alt="Suggestion 1">
        <div class="overlay"></div>

        <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>" aria-label="Voir la photo en détail">
          <div class="icon-eye"></div>
        </a>

        <div class="icon-fullscreen" data-full="<?php echo get_stylesheet_directory_uri(); ?>/image/nathalie-4.jpeg"></div>
        <div class="text-bottom-left">LE MENU</div>
        <div class="text-bottom-right">CATÉGORIE</div>
      </div>


      <div class="suggestion-item">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/image/nathalie-5.jpeg" alt="Suggestion 2">
        <div class="overlay"></div>

        <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>" aria-label="Voir la photo en détail">
          <div class="icon-eye"></div>
        </a>

        <div class="icon-fullscreen" data-full="<?php echo get_stylesheet_directory_uri(); ?>/image/nathalie-5.jpeg"></div>
        <div class="text-bottom-left">LE MENU</div>
        <div class="text-bottom-right">CATÉGORIE</div>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>