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
      <div class="wp-block-group page-header page-header--nav">
        <div class="wp-block-columns">
          <div class="wp-block-column">
            <?php
            // Display product categories menu
            $categories = get_terms(array(
              'taxonomy' => 'product_cat',
              'hide_empty' => false,
            ));

            if (!empty($categories) && !is_wp_error($categories)) {
              echo '<nav class="product-categories-menu">';
              echo '<ul>';

              foreach ($categories as $category) {
                if ($category->parent == 0) {
                  echo '<li class="category-item"><div class="dropdown dropdown-cat-menu">';
                  $active_class = (is_tax('product_cat', $category->term_id)) ? ' active' : '';
                  echo '<a role="button" data-bs-toggle="dropdown" aria-expanded="false" class="category-item--link dropdown-toggle' . $active_class . '" href="' . get_term_link($category) . '">' . $category->name . '</a>';

                  // Check for subcategories
                  $subcategories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                    'parent' => $category->term_id,
                  ));

                  if (!empty($subcategories) && !is_wp_error($subcategories)) {
                    echo '<div class="dropdown-menu"><ul class="dropdown-list">';
                    foreach ($subcategories as $subcategory) {
                      echo '<li class="subcategory-item">';
                        $thumbnail_id = get_term_meta($subcategory->term_id, 'thumbnail_id', true);
                        $image_url = wp_get_attachment_url($thumbnail_id);
                        if ($image_url) {
                          echo '<a class="dropdown-link" href="' . get_term_link($subcategory) . '">';
                          echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($subcategory->name) . '" class="subcategory-image" />';
                          echo $subcategory->name;
                          echo '</a>';
                        } else {
                          echo '<a class="dropdown-link" href="' . get_term_link($subcategory) . '">' . $subcategory->name . '</a>';
                        }
                      echo '</li>';
                    }
                    echo '</ul></div>';
                  }

                  echo '</div></li>';
                }
              }

              echo '</ul>';
              echo '</nav>';
            }
            ?>
          </div>
        </div>
      </div>

      <div class="wp-block-group section-smaller">
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
            <div class="row">
              <?php if (is_shop() || is_product_category()) : ?>
                <div class="col"><?php get_sidebar('woocommerce'); ?></div>
              <?php endif; ?>
              <div class="<?= apply_filters('bootscore/class/main/col', 'col'); ?>">
                <?php woocommerce_content(); ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main><!-- #main -->
  </div><!-- #primary -->
</div><!-- #content -->
<?php
get_footer();
