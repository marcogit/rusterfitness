<?php

/**
 * Category Template: Equal Height
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 * @version 6.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header();
?>

<div id="content" class="site-content container pt-4 pb-5">
  <div id="primary" class="content-area">

    <main id="main" class="site-main">
      <!-- Header -->
      <?php
      $background_image = get_field('imagen_de_fondo', 'category_' . get_queried_object_id());
      if ($background_image) :
      ?>
      <?php endif; ?>
      <div class="wp-block-group page-header page-header--bg" style="background-image: url('<?php echo esc_url($background_image); ?>');">
        <div class="wp-block-columns">
          <div class="wp-block-column">
            <h1 class="page-header--title"><?php single_cat_title(); ?></h1>
            <div class="page-header--subtitle">
              <?php the_archive_description(); ?>
            </div>
          </div>
        </div>
      </div>
      <aside class="wp-block-group aside-categories-full">
        <div class="wp-block-columns mb-0">
          <div class="wp-block-column">
            <ul class="nav nav-categories-full">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo get_permalink(get_option('page_for_posts')); ?>"><?php _e('Todos', 'bootscore'); ?></a>
              </li>
              <?php
              $categories = get_categories();
              foreach ($categories as $category) {
                echo '<li class="nav-item ' . (is_category($category->term_id) ? 'active' : '') . '">';
                echo '<a class="nav-link" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>';
                echo '</li>';
              }
              ?>
            </ul>
          </div>
        </div>
      </aside>
      <section class="wp-block-group">
        <div class="wp-block-columns">
          <div class="wp-block-column">
            <div class="row justify-content-between">
              <div class="col">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                  yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
                }
                ?>
              </div>
              <div class="col-auto d-none d-md-block">
                <?php
                global $wp_query;
                $total_posts = $wp_query->found_posts;
                $posts_per_page = get_option('posts_per_page');
                ?>
                <p class="mb-0"><?php printf(__('Mostrando %d de <strong>%d entradas</strong>', 'bootscore'), $posts_per_page, $total_posts); ?></p>
              </div>

            </div>
          </div>
        </div>
        <div class="wp-block-columns">
          <div class="wp-block-column">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
              <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>

                  <div class="col">

                    <div class="card card-post">

                      <!-- Post HEADER-->
                      <div class="card-header">
                        <div class="category-badge">
                          <?php bootscore_category_badge(); ?>
                        </div>
                        <?php if (has_post_thumbnail()) : ?>
                          <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium', array('class' => 'card-img-lg-start')); ?>
                          </a>
                        <?php endif; ?>
                      </div>
                      <!-- Post BODY-->
                      <div class="card-body">
                        <?php if ('post' === get_post_type()) : ?>
                          <p class="meta mb-2">
                            <?php
                            bootscore_date();
                            ?>
                          </p>
                        <?php endif; ?>
                        <a class="blog-post-title--link" href="<?php the_permalink(); ?>">
                          <?php the_title('<h2 class="blog-post-title h4">', '</h2>'); ?>
                        </a>
                        <p class="card-text">
                          <a class="text-body text-decoration-none" href="<?php the_permalink(); ?>">
                            <?= strip_tags(get_the_excerpt()); ?>
                          </a>
                        </p>
                        <p class="card-text">
                          <a class="read-more" href="<?php the_permalink(); ?>">
                            <?php _e('Read more »', 'bootscore'); ?>
                          </a>
                        </p>
                      </div>
                      <!-- Post FOOTER-->
                      <div class="card-footer">
                        <?php if ('post' === get_post_type()) : ?>
                          <p class="meta">
                            <?php
                            bootscore_author();
                            ?>
                          </p>
                        <?php endif; ?>
                      </div>
                    </div>
                    <!-- END Post -->
                  </div>

                <?php endwhile; ?>
              <?php endif; ?>

            </div>
            <div class="entry-footer">
              <?php bootscore_pagination(); ?>
            </div>
          </div>
        </div>
      </section>
    </main>

  </div>
</div>
<?php
get_footer();
