<?php

/**
 * @package Bootscore Child
 *
 * @version 6.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Enqueue scripts and styles
 */
add_action('wp_enqueue_scripts', 'bootscore_child_enqueue_styles');
function bootscore_child_enqueue_styles()
{

  // Compiled main.css
  $modified_bootscoreChildCss = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/css/main.css'));
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/assets/css/main.css', array('parent-style'), $modified_bootscoreChildCss);

  // style.css
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

  // custom.js
  // Get modification time. Enqueue file with modification date to prevent browser from loading cached scripts when file content changes. 
  $modificated_CustomJS = date('YmdHi', filemtime(get_stylesheet_directory() . '/assets/js/custom.js'));
  wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), $modificated_CustomJS, false, true);
}

/**
 * Register custom menus
 */
add_action('init', 'register_custom_menus');
function register_custom_menus()
{
  // Register Header Top Menu
  register_nav_menu('header-top', __('Header Top Menu', 'bootscore-child'));
}
/**
 * Custom Block Category
 */
function ruster_blocks_category($categories, $post)
{
  return array_merge(
    array(
      array(
        'slug'  => 'ruster-blocks',
        'title' => __('Ruster Blocks', 'bootscore-child'),
      ),
    ),
    $categories
  );
}
add_filter('block_categories_all', 'ruster_blocks_category', 10, 2);

/**
 * Blocks Enlaces Directos
 */
function my_acf_init()
{
  // Check function exists.
  if (function_exists('acf_register_block_type')) {
    // Block - Enlaces Directos
    acf_register_block_type(array(
      'name'              => 'direct-link',
      'title'             => __('Acceso Directo'),
      'description'       => __('Bloque de acceso directo'),
      'render_template'   => 'template-parts/blocks/direct-link/direct-link.php',
      'category'          => 'ruster-blocks',
      'icon'              => 'admin-links',
      'keywords'          => array('link'),
    ));
    // Block - Enlace Directo Grande con fondo
    acf_register_block_type(array(
      'name'              => 'max-direct-link',
      'title'             => __('Acceso Directo Grande con fondo'),
      'description'       => __('Bloque de acceso directo'),
      'render_template'   => 'template-parts/blocks/direct-link-big/direct-link-big.php',
      'category'          => 'ruster-blocks',
      'icon'              => 'admin-links',
      'keywords'          => array('link'),
    ));
    // Block - Carrusel Automático
    acf_register_block_type(array(
      'name'              => 'auto-carrusel-bar',
      'title'             => __('Carrusel Automático'),
      'description'       => __(''),
      'render_template'   => 'template-parts/blocks/auto-carrusel-bar/auto-carrusel-bar.php',
      'category'          => 'ruster-blocks',
      'icon'              => 'text',
      'keywords'          => array('carrusel'),
    ));
    // Block - Logos Slider
    acf_register_block_type(array(
      'name'              => 'logos-slider',
      'title'             => __('Carrusel de Logotipos'),
      'description'       => __(''),
      'render_template'   => 'template-parts/blocks/logos/logos.php',
      'category'          => 'ruster-blocks',
      'icon'              => 'slides',
      'keywords'          => array('logos'),
    ));
  }
}
add_action('acf/init', 'my_acf_init');
