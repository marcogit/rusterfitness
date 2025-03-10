<?php get_header('transparent'); ?>
<div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container', 'page-sidebar-none'); ?> <?= apply_filters('bootscore/class/content/spacer', 'pt-4 pb-5', 'page-sidebar-none'); ?>">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <?php
      $image_url = get_the_post_thumbnail_url();
      if ($image_url) {
        echo '<style>
            .page-header--bg {
              background-image: url(' . esc_url($image_url) . ');
            }
          </style>';
      }
      ?>
      <div class="wp-block-group page-header page-header--center page-header--bg">
        <div class="wp-block-columns">
          <div class="wp-block-column">

            <h1 class="page-header--title"><?php the_title(); ?></h1>
            <div class="page-header--subtitle is-small">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-map.svg" alt="Ubicación"> <?php the_field('ubicacion'); ?> - <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-calendar.svg" alt="Ubicación"> <?php the_field('fecha_competicion'); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="entry-content">
        <section class="wp-block-group section-smaller">
          <div class="wp-block-columns">
            <div class="wp-block-column">
              <?php
              if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
              }
              ?>
            </div>
          </div>
        </section>
        <?php the_content(); ?>
        <section class="wp-block-group">
          <div class="wp-block-columns">
            <div class="wp-block-column">
              <span class="h4 wp-block-heading has-text-align-center d-block"><?php _e('Otras Competiciones', 'text-domain'); ?></span>
              <div class="row row-cols-1 row-cols-md-3">
                <?php
                $related_competiciones = new WP_Query(array(
                  'post_type'      => 'competiciones',
                  'posts_per_page' => 3,
                  'orderby'        => 'date',
                  'order'          => 'DESC',
                  'post__not_in'   => array(get_the_ID()),
                ));

                if ($related_competitions->have_posts()) :
                  while ($related_competitions->have_posts()) : $related_competitions->the_post();
                ?>
                    <div class="col">
                      <a class="card card-comp" href="<?php the_permalink(); ?>">
                        <?php if (get_field('logo')) : ?>
                          <div class="card-header">
                          <img src="<?php echo esc_url(get_field('logo')['url']); ?>" class="card-img" alt="Logo de <?php the_title(); ?>">
                          </div>
                        <?php endif; ?>
                        <div class="card-body">
                          <span class="card-title"><?php the_title(); ?></span>
                        </div>
                        <div class="card-footer">
                          <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-map.svg" alt="Ubicación"> <?php the_field('ubicacion'); ?></span>
                          <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-calendar.svg" alt="Ubicación"> <?php the_field('fecha_competicion'); ?></span>
                        </div>
                      </a>
                    </div>
                <?php
                  endwhile;
                  wp_reset_postdata();
                endif;
                ?>
              </div>
              <div class="wp-block-buttons is-content-justification-center is-layout-flex wp-container-core-buttons-is-layout-2 wp-block-buttons-is-layout-flex mt-5">
                <div class="wp-block-button is-style-outline is-style-outline--3">
                  <a class="wp-block-button__link has-text-align-center wp-element-button">Ver competiciones</a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
  </div>
</div>

<?php get_footer(); ?>