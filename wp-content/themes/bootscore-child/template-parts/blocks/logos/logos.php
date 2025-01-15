<?php
// ACF fields
$title = get_field('title');
$logos = get_field('logos');
?>
<section class="wp-block-group section-logos">
    <div class="container">
        <h3 class="wp-block-heading has-text-align-center"><?php echo esc_html($title); ?></h3>
    </div>
    <div class="container p-0">
        <div class="swiper logoSwiper">
            <div class="swiper-wrapper">
                <?php if ($logos): ?>
                    <?php foreach ($logos as $logo): ?>
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url($logo['image']['url']); ?>" alt="<?php echo esc_attr($logo['image']['alt']); ?>" />
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>