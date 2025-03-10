<?php get_header('transparent'); ?>

<div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container', 'page-sidebar-none'); ?> <?= apply_filters('bootscore/class/content/spacer', 'pt-4 pb-5', 'page-sidebar-none'); ?>">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <?php
      $image = get_field('imagen_destacada_competiciones', 'option');
      $image_url = $image ? $image['url'] : '';
      if ($image_url) {
        echo '<style>
            .page-header--bg {
              background-image: url(' . esc_url($image_url) . ');
            }
          </style>';
      }
      ?>

      <div class="wp-block-group page-header page-header--bg">
        <div class="wp-block-columns">
          <div class="wp-block-column">
            <h1 class="page-header--title"><?php post_type_archive_title(); ?></h1>
            <div class="page-header--subtitle">
              <?php echo esc_html(get_field('subtitulo_competiciones', 'option')); ?>
            </div>
          </div>
          <span class="page-header--sticker"><?php post_type_archive_title(); ?></span>
        </div>
      </div>

      <div class="entry-content">
        <section class="wp-block-group">
          <div class="wp-block-columns">
            <div class="wp-block-column">
              <div class="row row-cols-1 row-cols-md-3">
                <?php
                // Configurar el número de competiciones por página
                $posts_per_page = 3;
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                  'post_type' => 'competiciones',
                  'posts_per_page' => $posts_per_page,
                  'paged' => $paged
                );
                $query = new WP_Query($args);

                if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
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
                          <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-map.svg" alt="Ubicación"> <?php the_field('ubication'); ?></span>
                          <?php wp_reset_postdata(); ?>
                          <?php wp_reset_query(); ?>
                        </div>
                      </a>
                    </div>
                  <?php endwhile; ?>
              </div>

              <?php wp_reset_postdata(); ?>

            <?php else : ?>
              <p><?php _e('No hay competiciones disponibles.', 'text-domain'); ?></p>
            <?php endif; ?>

            <!-- Paginación corregida -->
            <div class="entry-footer">
              <div class="pagination justify-content-center">
                <?php
                echo paginate_links(array(
                  'total' => $query->max_num_pages,
                  'current' => max(1, get_query_var('paged')),
                  'format' => 'page/%#%/',
                  'prev_text' => __('« Anterior'),
                  'next_text' => __('Siguiente »'),
                ));
                ?>
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