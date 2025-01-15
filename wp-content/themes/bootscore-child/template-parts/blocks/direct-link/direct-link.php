<?php
// ACF fields
$name = get_field('name');
$description = get_field('description');
$image = get_field('image');
$link = get_field('link');
?>

<div class="directlink-block">
    <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>">
    <div class="directlink-block__inner">
        <?php if ($image): ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
        <div class="directlink-block__content">
            <span class="h4 block-title"><?php echo esc_html($name); ?></span>
            <p class="block-description"><?php echo esc_html($description); ?></p>
        </div>
    </div>
    </a>
</div>