<?php

/**
 * Template Post Type: post
 *
 * @package Bootscore
 * @version 6.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header();
?>

<div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container', 'single'); ?> <?= apply_filters('bootscore/class/content/spacer', 'pt-3 pb-5', 'single'); ?>">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <section class="wp-block-group">
        <div class="wp-block-columns">
          <div class="wp-block-column">
            <div class="row justify-content-center">
              <div class="col-xl-10">
                <div class="row justify-content-between">
                  <div class="<?= apply_filters('bootscore/class/main/col', 'col'); ?>">
                    <article class="entry-post">
                      <!-- * entry-header -->
                      <header class="entry-header">
                        <?php the_post(); ?>
                        <?php
                        if (function_exists('yoast_breadcrumb')) {
                          yoast_breadcrumb('<div id="breadcrumbs" class="mb-4">', '</div>');
                        }
                        ?>
                        <?php bootscore_category_badge(); ?>
                        <h1 class="h3 mt-1"><?php the_title(); ?></h1>
                        <div class="row share-date--box">
                          <div class="col">
                            <div class="date-box">
                              <?php echo get_avatar(get_the_author_meta('ID'), 48); ?>
                              <div class="date-box--text">
                                <span class="byline"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a></span>
                                <?php bootscore_date(); ?>
                              </div>
                            </div>
                          </div>
                          <div class="col-auto">
                            <div class="dropdown">
                              <button class="btn btn-share btn-outline-dark" type="button" id="dropdownShare" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-share-white.svg" alt="Share Icon">
                                <span><?php _e('Compartir', 'bootscore'); ?></span>
                              </button>
                              <div class="dropdown-menu dropdown-menu-dark dropdown-share" aria-labelledby="dropdownShare">
                                <a class="dropdown-item" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank">Facebook</a>
                                <a class="dropdown-item" rel="nofollow" href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" target="_blank">WhatsApp</a>
                                <a class="dropdown-item" rel="nofollow" href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" target="_blank">Email</a>
                                <a class="dropdown-item" rel="nofollow" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank">Twitter</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php bootscore_post_thumbnail(); ?>
                      </header>
                      <!-- * entry-content -->
                      <div class="entry-content">
                        <?php the_content(); ?>
                      </div>
                      <!-- * entry-footer -->
                      <footer class="entry-footer clear-both">
                        <div class="row justify-content-center">
                          <div class="col-auto">
                            <div class="dropdown">
                              <button class="btn btn-outline-dark" type="button" id="dropdownShare" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-share-white.svg" alt="Share Icon">
                                <?php _e('Compartir', 'bootscore'); ?>
                              </button>
                              <div class="dropdown-menu dropdown-menu-dark dropdown-full" aria-labelledby="dropdownShare">
                                <a class="dropdown-item" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank">Facebook</a>
                                <a class="dropdown-item" rel="nofollow" href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" target="_blank">WhatsApp</a>
                                <a class="dropdown-item" rel="nofollow" href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" target="_blank">Email</a>
                                <a class="dropdown-item" rel="nofollow" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank">Twitter</a>
                              </div>
                            </div>
                          </div>
                        </div>

                        <?php bootscore_tags(); ?>

                        <!-- Related posts using bS Swiper plugin -->
                        <?php if (function_exists('bootscore_related_posts')) bootscore_related_posts(); ?>

                        <nav aria-label="bs page navigation">
                          <ul class="post-pagination">
                            <li class="page-item">
                              <?php previous_post_link('%link'); ?>
                            </li>
                            <li class="page-item">
                              <?php next_post_link('%link'); ?>
                            </li>
                          </ul>
                        </nav>


                        <?php comments_template(); ?>
                      </footer>
                    </article>
                  </div>
                  <?php get_sidebar(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php
      if (is_active_sidebar('post-bottom')) {
        dynamic_sidebar('post-bottom');
      }
      ?>
    </main>
  </div>
</div>

</div>
</div>

<?php
get_footer();
