<?php
// ACF fields
$cta = get_field('cta');
$name = get_field('name');
$variant = get_field('variant'); // Nuevo campo de selección

// Determinar la clase de color de fondo
$variant_class = '';
if ($variant == 'Opción 01') {
    $variant_class = 'option-01';
} elseif ($variant == 'Opción 02') {
    $variant_class = 'option-02';
}
?>


<div class="auto-carrousel-bar <?php echo esc_attr($variant_class); ?>">
    <div class="auto-carrousel-bar__inner">
        <ul>
            <li class="auto-carrousel-bar__cta"><strong><?php echo esc_html($cta); ?></strong></li>
            <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow-bar.svg"></li>
            <li class="auto-carrousel-bar__name"><?php echo esc_html($name); ?></li>
            <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/point-bar.svg"></li>
        </ul>
    </div>
</div>