<?php

/**
 * Template Name: Sin imagen destacada
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

<div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container', 'page-sidebar-none'); ?> <?= apply_filters('bootscore/class/content/spacer', 'pt-4 pb-5', 'page-sidebar-none'); ?>">
  <div id="primary" class="content-area">

    <main id="main" class="site-main">
      <div class="wp-block-group page-header page-header--small">
        <div class="wp-block-columns">
          <div class="wp-block-column">
            <?php the_post(); ?>
            <h1 class="page-header--title"><?php the_title(); ?></h1>
            <div class="page-header--subtitle text-primary">
              <?php echo esc_html(get_field('subtitle')); ?>
            </div>
          </div>
        </div>
      </div>

      <div class="entry-content">
        <section class="wp-block-group section-smaller custom-order-2">
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
