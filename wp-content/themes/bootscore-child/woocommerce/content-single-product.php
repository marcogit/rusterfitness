<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action('woocommerce_before_single_product_summary');
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_single_product_summary - 25
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action('woocommerce_single_product_summary');
		?>

		<!-- Custom code -->
		<?php if (have_rows('box', 'option')) : ?>
			<div class="product-claimns">
				<div class="row">
					<?php while (have_rows('box', 'option')) : the_row();
						$title = get_sub_field('title');
						$subtitle = get_sub_field('subtitle');
						$image = get_sub_field('image'); ?>
						<div class="col-12 col-md-6">
							<div class="product-claimns__item">
								<div class="product-claimns__item__icon">
									<img src="<?php echo esc_url($image); ?>" alt="">
								</div>
								<div class="product-claimns__item__text">
									<p><?php echo esc_html($title); ?></p>
									<p><small><?php echo esc_html($subtitle); ?></small></p>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>


	</div>


	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action('woocommerce_after_single_product_summary');
	?>

	<!-- VIDEO 01-->
	<?php
	$video_embed = get_field('product_video_01');

	if ($video_embed) : ?>
		<div class="box-product">
			<div class="video-pro-box">
				<div class="ratio ratio-16x9">
					<?php echo $video_embed; // ACF ya devuelve el iframe embebido correctamente 
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<!-- E+B+R -->
	<?php
	$description_e = get_field('description_e');
	$description_b = get_field('description_b');
	$description_r = get_field('description_r');

	$sections = [
		'e' => [
			'description' => $description_e,
			'options' => get_field('options_e', 'option'),
			'default_title' => 'Ejercicios',
			'default_image' => get_template_directory_uri() . '/img/icon-e.svg'
		],
		'b' => [
			'description' => $description_b,
			'options' => get_field('options_b', 'option'),
			'default_title' => 'Beneficios',
			'default_image' => get_template_directory_uri() . '/img/icon-e.svg'
		],
		'r' => [
			'description' => $description_r,
			'options' => get_field('options_r', 'option'),
			'default_title' => 'Recomendaciones',
			'default_image' => get_template_directory_uri() . '/img/icon-e.svg'
		]
	];

	// Verificar si hay al menos una descripción disponible
	$has_content = array_filter($sections, fn($section) => !empty($section['description']));

	if ($has_content) :
	?>

		<!-- Vista en Grid -->
		<div class="box-product only-desktop">
			<div class="row row-ebr">
				<?php foreach ($sections as $key => $section) :
					if (!$section['description']) continue;

					$title = $section['options']['title'] ?? $section['default_title'];
					$image = $section['options']['image'] ?? $section['default_image'];
				?>
					<div class="col-md product-description-<?php echo $key; ?>">
						<div class="col-product-description-box">
							<div class="product-description-icon">
								<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
							</div>
							<span class="h4"><?php echo esc_html($title); ?></span>
							<?php echo $section['description']; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<!-- Vista en Acordeón -->
		<div class="box-product only-mobile">
			<div class="accordion accordion-ebr" id="ebsAccordion">
				<?php $index = 1; ?>
				<?php foreach ($sections as $key => $section) :
					if (!$section['description']) continue;

					$title = $section['options']['title'] ?? $section['default_title'];
					$image = $section['options']['image'] ?? $section['default_image'];
				?>
					<div class="accordion-item">
						<span class="accordion-header" id="heading-ebr-<?php echo $index; ?>">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-ebs-<?php echo $index; ?>" aria-expanded="false">
								<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
								<span class="h4 accordion-button--title"><?php echo esc_html($title); ?></span>
							</button>
						</span>
						<div id="collapse-ebs-<?php echo $index; ?>" class="accordion-collapse collapse" data-bs-parent="#ebsAccordion">
							<div class="accordion-body">
								<?php echo $section['description']; ?>
							</div>
						</div>
					</div>
					<?php $index++; ?>
				<?php endforeach; ?>
			</div>
		</div>

	<?php endif; ?>

	<!-- Related products -->
	<div class="box-product">
		<span class="h4 d-block mb-3"><?php _e('Productos relacionados', 'text-domain'); ?></span>
		<?php echo do_shortcode('[bs-swiper-card-product category="' . esc_attr($category_slugs) . '" posts="6" orderby="rand" outofstock="false"]'); ?>
	</div>

	<!-- VIDEO 02-->
	<?php
	$video_embed = get_field('product_video_02');
	$title_video = get_field('title_video_02');
	$description_video = get_field('description_video_02');

	if ($video_embed) : ?>
		<div class="box-product">
			<div class="video-pro-box">
				<div class="video-wrapper--intro">
					<span class="h4"><?php echo $title_video; ?></span>
					<p><?php echo $description_video; ?></p>
				</div>
				<div class="ratio ratio-16x9">
					<?php echo $video_embed; // ACF ya devuelve el iframe embebido correctamente 
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<!-- FAQs -->
	<?php
	$title = get_field('title');
	$description = get_field('description');
	?>

	<?php
	if (have_rows('items_faqs_pro')) : ?>

		<div class="box-product">
			<div class="row">
				<div class="col-md-4">
					<span class="h4"><?php _e('Preguntas frecuentes', 'text-domain'); ?></span>
				</div>
				<div class="col">
					<div class="accordion accordion-faqs--pro" id="faqAccordionPro">
						<?php $i = 1;
						while (have_rows('items_faqs_pro')) : the_row(); ?>
							<div class="accordion-item">
								<span class="accordion-header" id="heading-<?php echo $i; ?>">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $i; ?>" aria-expanded="false">
										<?php echo esc_html(get_sub_field('title')); ?>
									</button>
								</span>
								<div id="collapse-<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordionPro">
									<div class="accordion-body">
										<?php the_sub_field('description'); ?>
									</div>
								</div>
							</div>
						<?php $i++;
						endwhile; ?>
					</div>
				</div>
			</div>

		</div>
	<?php endif; ?>

</div>

<?php do_action('woocommerce_after_single_product'); ?>