<?php

/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     3.6.1
 */

if (!defined('ABSPATH')) {
  exit;
}

?>

  <div class="col col-buttons">
    <ul class="list-group list-group-horizontal">
      <li>
        <button id="toggle-sidebar" class="btn btn-outline-dark btn-small">
            <?php esc_html_e('Filtros', 'bootscore'); ?>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-filter.svg" alt="Filter Icon">
        </button>
      </li>
      <li>
        <form class="woocommerce-ordering" method="get">
          <select name="orderby" class="orderby custom-select" aria-label="<?php esc_attr_e('Shop order', 'bootscore'); ?>">
            <?php foreach ($catalog_orderby_options as $id => $name) : ?>
              <option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?php echo esc_html($name); ?></option>
            <?php endforeach; ?>
          </select>
          <input type="hidden" name="paged" value="1" />
          <?php wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page')); ?>
        </form>
      </li>
    </ul>
  </div>
</div><!-- row in result-count-php -->