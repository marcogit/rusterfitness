<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bootscore
 * @version 6.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php wp_body_open(); ?>

  <div id="page" class="site">

    <a class="skip-link visually-hidden-focusable" href="#primary"><?php esc_html_e('Skip to content', 'bootscore'); ?></a>

    <!-- Top Bar Widget -->
    <?php if (is_active_sidebar('top-bar')) : ?>
      <?php dynamic_sidebar('top-bar'); ?>
    <?php endif; ?>

    <header id="masthead" class="<?= apply_filters('bootscore/class/header', 'fixed-top'); ?> site-header site-header--transparent">
      <div class="header-top">
        <div class="container">
          <?php
          if (has_nav_menu('header-top')) {
            wp_nav_menu(array(
              'theme_location' => 'header-top',
              'menu_class'     => 'header-top-menu', // Clase CSS personalizada para el menú
              'container'      => 'nav', // Contenedor HTML (puedes usar 'div', 'nav', etc.)
              'container_class' => 'header-top-container', // Clase CSS del contenedor
            ));
          } else {
            echo '<p>No se ha asignado ningún menú a "Header Top".</p>';
          }
          ?>
        </div>
      </div>
      <nav id="nav-main" class="navbar <?= apply_filters('bootscore/class/header/navbar/breakpoint', 'navbar-expand-lg'); ?>">

        <div class="<?= apply_filters('bootscore/class/container', 'container', 'header'); ?>">
          <div class="navbar-left">
            <!-- Navbar Toggler -->
            <button class="<?= apply_filters('bootscore/class/header/button', 'btn', 'nav-toggler'); ?> <?= apply_filters('bootscore/class/header/navbar/toggler/breakpoint', 'd-lg-none'); ?> btn-icon nav-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-navbar" aria-controls="offcanvas-navbar">
              <i class="fa-solid fa-bars"></i><span class="visually-hidden-focusable">Menu</span>
            </button>
            <!-- Navbar Brand -->
            <a class="navbar-brand" href="<?= esc_url(home_url()); ?>">
              <img src="<?= esc_url(apply_filters('bootscore/logo', get_stylesheet_directory_uri() . '/assets/img/logo/ruster_logo_header_white.svg', 'default')); ?>" alt="<?php bloginfo('name'); ?> Logo" class="d-td-none me-2">
              <img src="<?= esc_url(apply_filters('bootscore/logo', get_stylesheet_directory_uri() . '/assets/img/logo/logo-theme-dark.svg', 'theme-dark')); ?>" alt="<?php bloginfo('name'); ?> Logo" class="d-tl-none me-2">
            </a>
          </div>

          <!-- Offcanvas Navbar -->
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-navbar">
            <div class="offcanvas-header">
              <span class="h5 offcanvas-title"><?= apply_filters('bootscore/offcanvas/navbar/title', __('Menu', 'bootscore')); ?></span>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">

              <!-- Bootstrap 5 Nav Walker Main Menu -->
              <?php get_template_part('template-parts/header/main-menu'); ?>

              <!-- Top Nav 2 Widget -->
              <?php if (is_active_sidebar('top-nav-2')) : ?>
                <?php dynamic_sidebar('top-nav-2'); ?>
              <?php endif; ?>

            </div>
          </div>

          <div class="header-actions">

            <!-- Top Nav Widget -->
            <?php if (is_active_sidebar('top-nav')) : ?>
              <?php dynamic_sidebar('top-nav'); ?>
            <?php endif; ?>

            <?php
            if (class_exists('WooCommerce')) :
              get_template_part('template-parts/header/actions', 'woocommerce');
            else :
              get_template_part('template-parts/header/actions');
            endif;
            ?>

          </div><!-- .header-actions -->

        </div><!-- .container -->

      </nav><!-- .navbar -->

      <?php
      if (class_exists('WooCommerce')) :
        get_template_part('template-parts/header/collapse-search', 'woocommerce');
      else :
        get_template_part('template-parts/header/collapse-search');
      endif;
      ?>

      <!-- Offcanvas User and Cart -->
      <?php
      if (class_exists('WooCommerce')) :
        get_template_part('template-parts/header/offcanvas', 'woocommerce');
      endif;
      ?>

    </header><!-- #masthead -->