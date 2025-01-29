<?php

/**
 * The template for displaying all WooCommerce pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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

<div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container', 'woocommerce'); ?> <?= apply_filters('bootscore/class/content/spacer', 'pt-4 pb-5', 'woocommerce'); ?>">
  <div id="primary" class="content-area">

    <main id="main" class="site-main">

      <div class="wp-block-group page-header page-header--small">
        <div class="wp-block-columns">
          <div class="wp-block-column">
            <?php
            if (function_exists('yoast_breadcrumb')) {
              yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
            }
            ?>
          </div>
        </div>
      </div>
      <section class="wp-block-group wp-block-group--shop">
        <div class="wp-block-columns">
          <div class="wp-block-column">
            <div class="<?= apply_filters('bootscore/class/main/col', 'col'); ?>">
              <?php woocommerce_content(); ?>
            </div>
          </div>
        </div>
      </section>
    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();
