<?php
// ACF fields
$name = get_field('name');
$description = get_field('description');
$image = get_field('image');
$link = get_field('link');
$background_color = get_field('background_color'); // Nuevo campo de selección

// Determinar la clase de color de fondo
$background_class = '';
if ($background_color == 'Negro') {
    $background_class = 'background-black';
} elseif ($background_color == 'Azul') {
    $background_class = 'background-blue';
}
?>


<div class="directlinkbig-block <?php echo esc_attr($background_class); ?>">
    <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>">
    <div class="directlink-block__inner" style="background-image: url('<?php echo esc_url($image['url']); ?>');">
        <div class="directlink-block__content">
            <span class="h2 block-title"><?php echo esc_html($name); ?></span>
            <p class="block-description h4"><?php echo esc_html($description); ?></p>
        </div>
    </div>
    </a>
</div>