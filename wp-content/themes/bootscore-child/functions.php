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
    'supports'          => array('align' => true),
    'mode'              => 'edit',
  ));

  // Bloque: Preguntas frecuentes
  acf_register_block_type(array(
    'name'              => 'faqs',
    'title'             => __('Preguntas Frecuentes', 'bootscore-child'),
    'description'       => __('Bloque con preguntas frecuentes en formato acordeón.'),
    'render_template'   => '/template-parts/blocks/block-faqs/block-faqs.php',
    'category'          => 'ruster-blocks',
    'icon'              => 'editor-help',
    'keywords'          => array('faq', 'preguntas', 'acordeón'),
  ));

  // Bloque: Distribuidor Slider
  acf_register_block_type(array(
    'name'              => 'distributor-slider',
    'title'             => __('Distribuidor Slider', 'bootscore-child'),
    'description'       => __('Bloque de slider para distribuidores', 'bootscore-child'),
    'render_template'   => 'template-parts/blocks/distributor-slider/distributor-slider.php',
    'category'          => 'ruster-blocks',
    'icon'              => 'slides',
    'keywords'          => array('distributor', 'slider'),
  ));

  // Bloque: Contador
  acf_register_block_type(array(
    'name'              => 'block-counter',
    'title'             => __('Contador numérico', 'bootscore-child'),
    'description'       => __('', 'bootscore-child'),
    'render_template'   => 'template-parts/blocks/block-counter/block-counter.php',
    'category'          => 'ruster-blocks',
    'icon'              => 'editor-ol',
    'keywords'          => array('counter', 'numbers'),
  ));

  // Bloque: Timeline
  acf_register_block_type(array(
    'name'              => 'block-timeline',
    'title'             => __('Timeline', 'bootscore-child'),
    'description'       => __('', 'bootscore-child'),
    'render_template'   => 'template-parts/blocks/block-timeline/block-timeline.php',
    'category'          => 'ruster-blocks',
    'icon'              => 'calendar-alt',
    'keywords'          => array('counter', 'numbers'),
  ));

  // Bloque: Steps
  acf_register_block_type(array(
    'name'              => 'steps',
    'title'             => __('Pasos', 'bootscore-child'),
    'description'       => __('Bloque para mostrar pasos', 'bootscore-child'),
    'render_template'   => 'template-parts/blocks/steps/steps.php',
    'category'          => 'ruster-blocks',
    'icon'              => 'list-view',
    'keywords'          => array('steps', 'pasos'),
  ));

  // Bloque: Casos de éxito
  acf_register_block_type(array(
    'name'              => 'success_cases_slider',
    'title'             => __('Casos de Éxito - Grid', 'bootscore-child'),
    'description'       => __('Muestra un slider de Casos de Éxito filtrado por Espacio', 'bootscore-child'),
    'render_template'   => 'template-parts/blocks/block-success_cases/block-success_cases.php',
    'category'          => 'ruster-blocks',
    'icon'              => 'awards',
    'keywords'          => array('casos de éxito', 'slider', 'espacios'),
    'supports'          => array('align' => true),
    'mode'              => 'edit',
  ));
  // Bloque: Competiciones
  acf_register_block_type(array(
    'name'              => 'competitions',
    'title'             => __('Competiciones', 'bootscore-child'),
    'description'       => __('Bloque para mostrar competiciones', 'bootscore-child'),
    'render_template'   => 'template-parts/blocks/competitions/competitions.php',
    'category'          => 'ruster-blocks',
    'icon'              => 'awards',
    'keywords'          => array('competitions', 'competiciones'),
  ));
}
add_action('acf/init', 'my_acf_init_blocks', 10);

function agregar_campos_acf_a_productos($field_groups)
{
  foreach ($field_groups as &$group) {
    if ($group['key'] === 'group_product_info') { // Asegúrate de usar el "key" correcto de ACF
      $group['location'] = array(
        array(
          array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'product', // Fuerza la asignación al post type "product"
          ),
        ),
      );
    }
  }
  return $field_groups;
}
add_filter('acf/get_field_groups', 'agregar_campos_acf_a_productos');


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

function custom_product_attributes_display()
{
  global $product;

  if (!$product) return;

  echo '<div class="product-attributes">';

  // Obtener atributos del producto
  $attributes = $product->get_attributes();

  // Mostrar medidas
  if (isset($attributes['pa_medida'])) :
    $medidas = wc_get_product_terms($product->get_id(), 'pa_medida', array('fields' => 'all'));
    if (!empty($medidas)) :
?>
      <div class="atri-box">
        <p><?php _e('Medidas disponibles', 'bootscore-child'); ?></p>
        <ul class="atri-box--list">
          <?php foreach ($medidas as $medida) : ?>
            <li class="product-medidas__item" data-attribute="pa_medida" data-value="<?php echo esc_attr($medida->slug); ?>">
              <span class="badge"><?php echo esc_html($medida->name); ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php
    endif;
  endif;

  // Mostrar colores
  if (isset($attributes['pa_color'])) :
    $colors = wc_get_product_terms($product->get_id(), 'pa_color', array('fields' => 'all'));
    if (!empty($colors)) :
    ?>
      <div class="atri-box">
        <p><?php _e('Colores disponibles', 'bootscore-child'); ?></p>
        <ul class="atri-box--list">
          <?php foreach ($colors as $color) : ?>
            <li class="product-colors__item" data-attribute="pa_color" data-value="<?php echo esc_attr($color->slug); ?>">
              <div title="<?php echo esc_html($color->name); ?>" class="color-swatch" style="background-color: <?php echo esc_attr(get_term_meta($color->term_id, 'color', true)); ?>;"></div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
<?php
    endif;
  endif;

  echo '</div>';
}

function bootscore_register_woocommerce_sidebar()
{
  register_sidebar(array(
    'name'          => __('WooCommerce Sidebar', 'bootscore-child'),
    'id'            => 'sidebar-woocommerce',
    'description'   => __('Widgets in this area will be shown on WooCommerce pages.', 'bootscore-child'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<div class="widget-title">',
    'after_title'   => '</div>',
  ));
}
add_action('widgets_init', 'bootscore_register_woocommerce_sidebar');

require_once get_stylesheet_directory() . '/woocommerce/class-product-tag-filter-widget.php';

function register_product_tag_filter_widget()
{
  register_widget('Product_Tag_Filter_Widget');
}
add_action('widgets_init', 'register_product_tag_filter_widget');

function filter_products_by_tags()
{
  // Verificar si se han pasado etiquetas
  if (isset($_GET['tags']) && ! empty($_GET['tags'])) {
    $tags = $_GET['tags'];

    $args = array(
      'post_type' => 'product',
      'posts_per_page' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'product_tag',
          'field' => 'slug',
          'terms' => $tags,
        ),
      ),
    );
  } else {
    // Si no se selecciona ninguna etiqueta, mostrar todos los productos
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => -1,
    );
  }

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      wc_get_template_part('content', 'product');
    }
  } else {
    echo '<p>' . __('No products found', 'bootscore-child') . '</p>';
  }

  wp_reset_postdata();
  wp_die();
}
add_action('wp_ajax_filter_products_by_tags', 'filter_products_by_tags');
add_action('wp_ajax_nopriv_filter_products_by_tags', 'filter_products_by_tags');

// Borra el hook de los productos relacionados
function remove_woocommerce_related_products()
{
  remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
}
add_action('init', 'remove_woocommerce_related_products');


// Agregar el contenido en la posición 25 dentro del hook woocommerce_single_product_summary
add_action('woocommerce_single_product_summary', 'custom_product_attributes_display', 25);

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

function registrar_cpt_competiciones()
{
  $labels = array(
    'name'               => 'Competiciones',
    'singular_name'      => 'Competición',
    'menu_name'          => 'Competiciones',
    'add_new'            => 'Añadir Nueva',
    'add_new_item'       => 'Añadir Nueva Competición',
    'edit_item'          => 'Editar Competición',
    'new_item'           => 'Nueva Competición',
    'view_item'          => 'Ver Competición',
    'search_items'       => 'Buscar Competiciones',
    'not_found'          => 'No se encontraron competiciones',
    'not_found_in_trash' => 'No se encontraron competiciones en la papelera'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'menu_icon'          => 'dashicons-awards',
    'supports'           => array('title', 'editor', 'thumbnail'),
    'hierarchical'       => false,
    'has_archive'        => true, // Activar la vista de archivo
    'rewrite'            => array('slug' => 'competiciones', 'with_front' => false),
    'show_in_rest'       => true,
    'query_var'          => true, // Permite el uso de 'paged' en la query
  );

  register_post_type('competiciones', $args);
  flush_rewrite_rules();
}
add_action('init', 'registrar_cpt_competiciones');

function cpt_espacios()
{
  $args = array(
    'labels'             => array(
      'name'          => 'Espacios',
      'singular_name' => 'Espacio',
      'menu_name'     => 'Espacios',
    ),
    'public'             => true,
    'has_archive'        => true,
    'menu_icon'          => 'dashicons-location',
    'supports'           => array('title', 'editor', 'thumbnail'),
    'show_in_rest'       => true,
  );
  register_post_type('espacios', $args);
}
add_action('init', 'cpt_espacios');

function cpt_casos_exito()
{
  $args = array(
    'labels'             => array(
      'name'          => 'Casos de Éxito',
      'singular_name' => 'Caso de Éxito',
      'menu_name'     => 'Casos de Éxito',
    ),
    'public'             => true,
    'has_archive'        => true,
    'menu_icon'          => 'dashicons-awards',
    'supports'           => array('title', 'editor', 'thumbnail'),
    'show_in_rest'       => true,
  );
  register_post_type('casos_exito', $args);
}
add_action('init', 'cpt_casos_exito');

function enqueue_custom_scripts()
{
  wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), null, true);
  wp_localize_script('custom-js', 'woocommerce_params', array(
    'ajax_url' => admin_url('admin-ajax.php')
  ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

add_action('acf/init', 'my_acf_init');
