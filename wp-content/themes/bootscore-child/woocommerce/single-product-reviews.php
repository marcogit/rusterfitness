<?php

/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 9.7.0
 */

defined('ABSPATH') || exit;

global $product;

if (!comments_open()) {
  return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
  <div id="woo-comments">
    <span class="woocommerce-Reviews-title h4">
      <?php esc_html_e('Reviews', 'woocommerce'); ?>
    </span>

    <?php
    // Obtener el producto actual correctamente
    global $product;
    if (!$product) {
      $product = wc_get_product(get_the_ID());
    }

    // Obtener la media de valoración y el número total de valoraciones
    $average = $product ? $product->get_average_rating() : 0;
    $count   = $product ? $product->get_review_count() : 0;
    ?>

    <?php if ($count > 0) : // Solo mostrar si hay valoraciones 
    ?>
      <div class="woocommerce-product-rating woocommerce-product-rating--average">

        <!-- Mostrar la media de la valoración numérica -->
        <div class="average-rating">
          <strong class="h3 average-rating--number"><?php echo esc_html(number_format($average, 1)); ?></strong> / 5
        </div>
        <!-- Mostrar las estrellas -->
        <div class="star-rating" title="<?php echo esc_attr($average . ' de 5'); ?>">
          <span style="width:<?php echo ((float) $average / 5) * 100; ?>%"></span>
        </div>

        <!-- Mostrar el número de valoraciones -->
        <span class="woocommerce-review-link">
          <?php printf(esc_html(_n('%s valoración', '%s valoraciones', $count, 'woocommerce')), esc_html($count)); ?>
        </span>
      </div>
    <?php endif; ?>


    <?php if (have_comments()) : ?>
      <ol class="comment-list">
        <?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments'))); ?>
      </ol>

      <?php
      if (get_comment_pages_count() > 1 && get_option('page_comments')) :
        echo '<nav class="woocommerce-pagination">';
        paginate_comments_links(
          apply_filters(
            'woocommerce_comment_pagination_args',
            array(
              'prev_text' => '&larr;',
              'next_text' => '&rarr;',
              'type'      => 'list',
            )
          )
        );
        echo '</nav>';
      endif;
      ?>
    <?php else : ?>
      <p class="woocommerce-noreviews"><?php esc_html_e('There are no reviews yet.', 'woocommerce'); ?></p>
    <?php endif; ?>
  </div>

  <?php if (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) : ?>
    <div id="review_form_wrapper">
      <div id="review_form">
        <?php
        $commenter    = wp_get_current_commenter();
        $comment_form = array(
          /* translators: %s is product title */
          'title_reply'         => have_comments() ? esc_html__('Add a review', 'woocommerce') : sprintf(esc_html__('Be the first to review &ldquo;%s&rdquo;', 'woocommerce'), get_the_title()),
          /* translators: %s is product title */
          'title_reply_to'      => esc_html__('Leave a Reply to %s', 'woocommerce'),
          'title_reply_before'  => '<span id="reply-title" class="comment-reply-title h4 text-primary mb-3" role="heading" aria-level="3">',
          'title_reply_after'   => '</span>',
          'comment_notes_after' => '',
          'label_submit'        => esc_html__('Submit', 'woocommerce'),
          'logged_in_as'        => '',
          'comment_field'       => '',
        );

        $name_email_required = (bool) get_option('require_name_email', 1);
        $fields              = array(
          'author' => array(
            'label'        => __('Name', 'woocommerce'),
            'type'         => 'text',
            'value'        => $commenter['comment_author'],
            'required'     => $name_email_required,
            'autocomplete' => 'name',
          ),
          'email'  => array(
            'label'        => __('Email', 'woocommerce'),
            'type'         => 'email',
            'value'        => $commenter['comment_author_email'],
            'required'     => $name_email_required,
            'autocomplete' => 'email',
          ),
        );

        $comment_form['fields'] = array();

        foreach ($fields as $key => $field) {
          $field_html  = '<p class="comment-form-' . esc_attr($key) . '">';
          /*$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

					if ( $field['required'] ) {
						$field_html .= '&nbsp;<span class="required">*</span>';
					}*/

          $field_html .= '</label><input id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" type="' . esc_attr($field['type']) . '" autocomplete="' . esc_attr($field['autocomplete']) . '" value="' . esc_attr($field['value']) . '" size="30" ' . ($field['required'] ? 'required' : '') . ' /></p>';

          $comment_form['fields'][$key] = $field_html;
        }

        $account_page_url = wc_get_page_permalink('myaccount');
        if ($account_page_url) {
          /* translators: %s opening and closing link tags respectively */
          $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a review.', 'woocommerce'), '<a href="' . esc_url($account_page_url) . '">', '</a>') . '</p>';
        }

        if (wc_review_ratings_enabled()) {
          $comment_form['comment_field'] = '
          <div class="comment-form-rating">
              <label for="rating" id="comment-form-rating-label">' . esc_html__('Your rating', 'woocommerce') . (wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '') . '</label>
      
              <p class="stars">
                  <span>
                      <a class="star-1" href="#" data-value="1">★</a>
                      <a class="star-2" href="#" data-value="2">★</a>
                      <a class="star-3" href="#" data-value="3">★</a>
                      <a class="star-4" href="#" data-value="4">★</a>
                      <a class="star-5" href="#" data-value="5">★</a>
                  </span>
              </p>
      
              <select name="rating" id="rating" required style="display: none;">
                  <option value="">' . esc_html__('Rate&hellip;', 'woocommerce') . '</option>
                  <option value="5">' . esc_html__('Perfect', 'woocommerce') . '</option>
                  <option value="4">' . esc_html__('Good', 'woocommerce') . '</option>
                  <option value="3">' . esc_html__('Average', 'woocommerce') . '</option>
                  <option value="2">' . esc_html__('Not that bad', 'woocommerce') . '</option>
                  <option value="1">' . esc_html__('Very poor', 'woocommerce') . '</option>
              </select>
          </div>';
        }


        $comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" class="form-control" placeholder="' . __('Your review...*', 'bootscore') . '" name="comment" cols="45" rows="8" required></textarea></p>';

        comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
        ?>
      </div>
    </div>
  <?php else : ?>
    <p class="woocommerce-verification-required woocommerce-info"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'woocommerce'); ?></p>
  <?php endif; ?>

  <div class="clear"></div>
</div>