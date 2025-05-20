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
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-0.jpeg" alt="photo 0" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-1.jpeg" alt="photo 1" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-2.jpeg" alt="photo 2" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-3.jpeg" alt="photo 3" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-4.jpeg" alt="photo 4" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-5.jpeg" alt="photo 5" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-6.jpeg" alt="photo 6" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
        <div class="gallery-item">
            <a href="<?php echo get_permalink(get_page_by_title('Single Photo')->ID); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/image/nathalie-7.jpeg" alt="photo 7" />
            </a>
            <div class="overlay"></div>
            <div class="icon-eye"></div>
            <div class="icon-fullscreen"></div>
            <div class="text-bottom-left">LE MENU</div>
            <div class="text-bottom-right">CATÉGORIE</div>
        </div>
    </div>

    <div class="load-more">
        <button>Charger plus</button>
    </div>
</main>

<?php get_footer(); ?>