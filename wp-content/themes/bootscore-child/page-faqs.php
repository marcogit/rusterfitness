<?php

/**
 * Template Name: FAQs
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 * @version 6.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header('transparent');
?>

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
      <div class="wp-block-group page-header page-header--bg">
        <div class="wp-block-columns">
          <div class="wp-block-column">
            <?php the_post(); ?>
            <h1 class="page-header--title"><?php the_title(); ?></h1>
            <div class="page-header--subtitle">
              <?php echo esc_html(get_field('subtitle')); ?>
            </div>
          </div>
          <span class="page-header--sticker"><?php the_title(); ?></span>
        </div>
      </div>
      <?php
      $parent_id = 31160; // ID de la página FAQs
      $child_pages = new WP_Query(array(
        'post_type' => 'page',
        'post_parent' => $parent_id,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'posts_per_page' => -1
      ));

      if ($child_pages->have_posts()) : ?>
        <aside class="wp-block-group aside-categories-full">
          <div class="wp-block-columns mb-0">
            <div class="wp-block-column">
              <ul class="nav nav-categories-full">
                <li class="nav-item"><a class="nav-link" href="<?php echo get_permalink($parent_id); ?>"><?php _e('Todos', 'text-domain'); ?></a></li>
                <?php while ($child_pages->have_posts()) : $child_pages->the_post(); ?>
                  <li class="nav-item <?php if (is_page(get_the_ID())) echo 'active'; ?>">
                  <a class="nav-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </li>
                <?php endwhile; ?>
              </ul>
            </div>
          </div>
        </aside>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>

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
      </div>

      <div class="entry-footer">
        <?php comments_template(); ?>
      </div>

    </main>

  </div>
</div>

<?php
get_footer();
