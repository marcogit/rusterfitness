<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 * @version 6.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

?>


<footer class="bootscore-footer">



  <div class="<?= apply_filters('bootscore/class/footer/columns', ''); ?> bootscore-footer-columns">
    <div class="<?= apply_filters('bootscore/class/container', 'container', 'footer-columns'); ?>">

      <div class="row row-primary">
        <div class="col">
          <?php if (is_active_sidebar('footer-top')) : ?>
            <?php dynamic_sidebar('footer-top'); ?>
          <?php endif; ?>
        </div>

        <div class="<?= apply_filters('bootscore/class/footer/col', 'col-6 col-lg-2', 'footer-1'); ?>">
          <?php if (is_active_sidebar('footer-1')) : ?>
            <?php dynamic_sidebar('footer-1'); ?>
          <?php endif; ?>
        </div>

        <div class="<?= apply_filters('bootscore/class/footer/col', 'col-6 col-lg-2', 'footer-2'); ?>">
          <?php if (is_active_sidebar('footer-2')) : ?>
            <?php dynamic_sidebar('footer-2'); ?>
          <?php endif; ?>
        </div>

        <div class="<?= apply_filters('bootscore/class/footer/col', 'col-6 col-lg-2', 'footer-3'); ?>">
          <?php if (is_active_sidebar('footer-3')) : ?>
            <?php dynamic_sidebar('footer-3'); ?>
          <?php endif; ?>
        </div>

        <div class="<?= apply_filters('bootscore/class/footer/col', 'col-6 col-lg-2', 'footer-4'); ?>">
          <?php if (is_active_sidebar('footer-4')) : ?>
            <?php dynamic_sidebar('footer-4'); ?>
          <?php endif; ?>
        </div>
        <div class="col-auto">

        </div>

      </div>
      <div class="row row-secondary">
        <div class="col-lg-4">
        <div class="bootscore-copyright">
          <p><span class="cr-symbol">&copy;</span>&nbsp;<?= date('Y'); ?> Ruster Fitness</div></p>
        </div>
        <div class="col justify-content-center d-flex align-items-center justify-content-center">
          <?php if (is_active_sidebar('footer-info')) : ?>
            <?php dynamic_sidebar('footer-info'); ?>
          <?php endif; ?>
          <?php get_template_part('template-parts/footer/footer-menu'); ?>
        </div>
        <div class="col-lg-4"></div>
      </div>

      <!-- Bootstrap 5 Nav Walker Footer Menu -->


    </div>
  </div>

</footer>

<!-- To top button -->
<a href="#" class="<?= apply_filters('bootscore/class/footer/to_top_button', 'btn btn-primary shadow'); ?> position-fixed zi-1000 top-button"><i class="fa-solid fa-chevron-up"></i><span class="visually-hidden-focusable">To top</span></a>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>