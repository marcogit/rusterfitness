<?php
// ACF fields
$title = get_field('title');
$subtitle = get_field('subtitle');
$sticker = get_field('sticker');
$background_image = get_field('background_image');
$background_video = get_field('background_video');
$cta = get_field('cta');
?>
<section class="wp-block-group hero-banner" style="background-image: url('<?php echo esc_url($background_image['url']); ?>');">
    <?php if ($background_video): ?>
        <video autoplay muted loop class="hero-banner__video">
            <source src="<?php echo esc_url($background_video['url']); ?>" type="video/mp4">
        </video>
    <?php endif; ?>
    <div class="container">
        <div class="hero-banner__content">
            <div class="hero-banner__title">
                <?php echo wp_kses_post($title); ?>
            </div>
            <p class="h4 hero-banner__subtitle">
                <?php echo esc_html($subtitle); ?>
            </p>
            <span class="hero-banner__sticker">
                <?php echo esc_html($sticker); ?>
            </span>
            <?php if ($cta): ?>
                <div class="hero-banner__cta">
                    <a href="<?php echo esc_url($cta['url']); ?>" class="btn btn-primary"><?php echo esc_html($cta['title']); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>