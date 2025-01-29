<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
<div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container', 'index'); ?> <?= apply_filters('bootscore/class/content/spacer', 'pt-4 pb-5', 'index'); ?>">
  <div id="primary" class="content-area">

    <main id="main" class="site-main">

      <!-- Header -->
      <div class="wp-block-group page-header">
        <div class="wp-block-columns">
          <div class="wp-block-column">
            <h1><?php bloginfo('name'); ?></h1>
            <p class="lead mb-0"><?php bloginfo('description'); ?></p>
          </div>
        </div>
      </div>
      <aside class="wp-block-group aside-categories-full">
        <div class="wp-block-columns mb-0">
          <div class="wp-block-column">
            <ul class="nav nav-categories-full">
                <li class="nav-item <?php if (is_home() || is_category()) echo 'active'; ?>">
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

      <!-- Sticky Post -->
      <?php if (is_sticky() && is_home() && !is_paged()) : ?>
        <div class="row">
          <div class="col">
            <?php
            $args      = array(
              'posts_per_page'      => 2,
              'post__in'            => get_option('sticky_posts'),
              'ignore_sticky_posts' => 2
            );
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()) :
              while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                  <div class="card horizontal mb-4">
                    <div class="row g-0">

                      <?php if (has_post_thumbnail()) : ?>
                        <div class="col-lg-6 col-xl-5 col-xxl-4">
                          <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium', array('class' => 'card-img-lg-start')); ?>
                          </a>
                        </div>
                      <?php endif; ?>

                      <div class="col">
                        <div class="card-body">

                          <div class="row">
                            <div class="col-10">
                              <?php bootscore_category_badge(); ?>
                            </div>
                            <div class="col-2 text-end">
                              <span class="badge text-bg-danger"><i class="fa-solid fa-star"></i></span>
                            </div>
                          </div>

                          <a class="text-body text-decoration-none" href="<?php the_permalink(); ?>">
                            <?php the_title('<h2 class="blog-post-title h5">', '</h2>'); ?>
                          </a>

                          <?php if ('post' === get_post_type()) : ?>
                            <p class="meta small mb-2 text-body-secondary">
                              <?php
                              bootscore_date();
                              bootscore_author();
                              bootscore_comments();
                              bootscore_edit();
                              ?>
                            </p>
                          <?php endif; ?>

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

                          <?php bootscore_tags(); ?>

                        </div>
                      </div>
                    </div>
                  </div>

                </article>
            <?php
              endwhile;
            endif;
            wp_reset_postdata();
            ?>
          </div>

          <!-- col -->
        </div>
        <!-- row -->
      <?php endif; ?>
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
              <!-- Grid Layout -->
              <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                  <?php if (is_sticky()) continue; //ignore sticky posts
                  ?>
                  <div class="col">
                    <!-- Post -->
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
    </main><!-- #main -->

  </div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();
