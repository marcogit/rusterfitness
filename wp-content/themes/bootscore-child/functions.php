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
 * BLOG widget area
 */
function bootscore_child_widgets_init()
{
  register_sidebar(array(
    'name'          => __('Post Bottom', 'bootscore-child'),
    'id'            => 'post-bottom',
    'description'   => __('Widget area for the single.php template', 'bootscore-child'),
    'before_widget' => '<div class="widget post-bottom-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ));
}
add_action('widgets_init', 'bootscore_child_widgets_init');

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
 * Registra bloques ACF (Enlaces directos, carruseles, etc.)
 */
function my_acf_init_blocks()
{
  // Verificar si la función existe
  if (! function_exists('acf_register_block_type')) {
    return;
  }

  // Bloque: Enlaces Directos
  acf_register_block_type(array(
    'name'              => 'direct-link',
    'title'             => __('Acceso Directo', 'bootscore-child'),
    'description'       => __('Bloque de acceso directo', 'bootscore-child'),
    'render_template'   => 'template-parts/blocks/direct-link/direct-link.php',
    'category'          => 'ruster-blocks',
    'icon'              => 'admin-links',
    'keywords'          => array('link'),
  ));

  // Bloque: Enlace Directo Grande con fondo
  acf_register_block_type(array(
    'name'              => 'max-direct-link',
    'title'             => __('Acceso Directo Grande con fondo', 'bootscore-child'),
    'description'       => __('Bloque de acceso directo', 'bootscore-child'),
    'render_template'   => 'template-parts/blocks/direct-link-big/direct-link-big.php',
    'category'          => 'ruster-blocks',
    'icon'              => 'admin-links',
    'keywords'          => array('link'),
  ));

  // Bloque: Carrusel Automático
  acf_register_block_type(array(
    'name'              => 'auto-carrusel-bar',
    'title'             => __('Carrusel Automático', 'bootscore-child'),
    'description'       => __('', 'bootscore-child'),
    'render_template'   => 'template-parts/blocks/auto-carrusel-bar/auto-carrusel-bar.php',
    'category'          => 'ruster-blocks',
    'icon'              => 'text',
    'keywords'          => array('carrusel'),
  ));

  // Bloque: Logos Slider
  acf_register_block_type(array(
    'name'              => 'logos-slider',
    'title'             => __('Carrusel de Logotipos', 'bootscore-child'),
    'description'       => __('', 'bootscore-child'),
    'render_template'   => 'template-parts/blocks/logos/logos.php',
    'category'          => 'ruster-blocks',
    'icon'              => 'slides',
    'keywords'          => array('logos'),
  ));

  // Bloque: Hero Banner
  acf_register_block_type(array(
    'name'              => 'hero-banner',
    'title'             => __('Hero Banner', 'bootscore-child'),
    'description'       => __('Bloque de Hero Banner', 'bootscore-child'),
    'render_template'   => 'template-parts/blocks/hero-banner/hero-banner.php',
    'category'          => 'ruster-blocks',
    'icon'              => 'slides',
    'keywords'          => array('hero', 'banner'),
));
}
add_action('acf/init', 'my_acf_init_blocks', 10);

/**
 * Color de la categoría
 */
// Registrar el campo de color para las categorías


// Función para obtener el color de la categoría
function get_category_color($term_id)
{
  $color = get_field('color_de_texto', 'category_' . $term_id);
  return $color ? $color : '#000000'; // Valor por defecto si no se ha seleccionado un color
}

// Función para obtener el fondo de la categoría
function get_category_background($term_id)
{
  $background = get_field('fondo', 'category_' . $term_id);
  return $background ? $background : '#FFFFFF'; // Valor por defecto si no se ha seleccionado un fondo
}

if (!function_exists('bootscore_category_badge')) :
  function bootscore_category_badge()
  {
    // Hide category and tag text for pages.
    if ('post' === get_post_type()) {
      echo '<p class="category-badge">';
      $thelist = '';
      $i       = 0;
      foreach (get_the_category() as $category) {
        if (0 < $i) $thelist .= ' ';
        // Usar las funciones para obtener el color y fondo de la categoría
        $category_color = get_category_color($category->term_id);
        $category_background = get_category_background($category->term_id);
        $class = apply_filters('bootscore/class/badge/category', 'badge');
        $thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="' . esc_attr($class) . '" style="color: ' . esc_attr($category_color) . '; background-color: ' . esc_attr($category_background) . ';">' . $category->name . '</a>';
        $i++;
      }
      echo $thelist;
      echo '</p>';
    }
  }
endif;

add_action('acf/init', 'my_acf_init');
