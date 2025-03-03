<?php
$title = get_field('title');
$image = get_field('image');
$number = get_field('number');
$block_id = 'counter-' . uniqid(); // Generar un identificador único
?>

<div class="info-number-counter">
    <?php if ($image): ?>
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
    <?php endif; ?>
    <span class="h3 info-number-counter--numer" id="<?php echo esc_attr($block_id); ?>" data-target-number="<?php echo esc_attr($number); ?>">+0</span>
    <span class="h5"><?php echo esc_html($title); ?></span>
</div>