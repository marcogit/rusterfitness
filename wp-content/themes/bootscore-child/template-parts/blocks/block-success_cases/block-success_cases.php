<?php
// Obtener los valores de los campos ACF
$title = get_field('title');
$description = get_field('description');
$space_id = get_field('space_filter');

// Validar si se ha seleccionado un espacio
if (!$space_id) {
    echo '<p>No se ha seleccionado ningún espacio.</p>';
    return;
}

// Obtener los Casos de Éxito relacionados con el espacio seleccionado en ACF
$args = array(
    'post_type'      => 'casos_exito',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'     => 'espacio_relacionado', // Este es el campo relacional en ACF
            'value'   => $space_id, // Usamos el ID del espacio seleccionado
            'compare' => 'LIKE'
        )
    )
);

$query = new WP_Query($args);

// Si no hay casos de éxito, mostrar mensaje
if (!$query->have_posts()) {
    echo '<p>No hay casos de éxito disponibles para este espacio.</p>';
    return;
}
?>

<section class="wp-block-group section-success-cases-slider">
    <div class="section-success-cases-slider--intro wp-block-columns is-layout-flex wp-container-core-columns-is-layout-1 wp-block-columns-is-layout-flex">
        <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow"></div>

        <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:40%">
            <?php if ($title) : ?>
                <p class="wp-block-heading has-text-align-center h3"><?php echo esc_html($title); ?></p>
            <?php endif; ?>
            <?php if ($description) : ?>
                <p class="has-text-align-center"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
        </div>

        <div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow"></div>
    </div>
    <div class="wp-block-columns">
        <div class="wp-block-column">
            <!-- Slider -->
            <div class="swiper gridSwiper">
                <div class="swiper-wrapper">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(); ?>" class="card card-item">
                                <div class="card-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'big'); ?>'); background-size: cover; background-position: center;">
                                </div>

                                <div class="card-body">
                                    <?php
                                    $date = get_post_meta(get_the_ID(), 'date', true); // Obtener la fecha desde la base de datos

                                    if ($date) {
                                        $formatted_date = date_i18n('d.m.Y', strtotime($date)); // Formatear como 21.09.2024
                                        echo '<span class="card-date"><small>' . esc_html($formatted_date) . '</small></span>';
                                    }
                                    ?>
                                    <span class="card-slogan h6"><?php esc_html_e('Caso de éxito', 'text-domain'); ?></span>
                                    <span class="card-title h4"><?php the_title(); ?></span>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
                <!-- Botones de navegación -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>