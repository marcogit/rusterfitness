<?php
// Obtener los valores de los campos ACF del bloque
$title = get_field('title');
$posts_per_page = get_field('posts_per_page') ?: 6; // Valor por defecto
$order = get_field('order') ?: 'DESC';

// Obtener las competiciones
$args = array(
    'post_type'      => 'competiciones',
    'posts_per_page' => $posts_per_page,
    'orderby'        => 'date',
    'order'          => $order,
);

$query = new WP_Query($args);

// Si no hay competiciones, mostrar mensaje
if (!$query->have_posts()) {
    echo '<p>No hay competiciones disponibles.</p>';
    return;
}
?>

<section class="wp-block-group competiciones-grid">
    <div class="wp-block-columns is-layout-flex">
        <div class="wp-block-column" style="flex-basis:100%">
            <?php if ($title) : ?>
                <span class="wp-block-heading has-text-align-center h4"><?php echo esc_html($title); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="wp-block-columns mt-5">
        <div class="wp-block-column">
            <div class="row row-cols-1 row-cols-md-3">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php
                    global $post;
                    setup_postdata($post); // Asegurar que los campos ACF se carguen correctamente

                    // Obtener los valores de ACF dentro del loop
                    $logo = get_field('logo');
                    $ubicacion = get_field('ubicacion');
                    $fecha = get_field('fecha_competicion');
                    ?>
                    <div class="col">
                        <a class="card card-comp" href="<?php the_permalink(); ?>">
                            <div class="card-header">
                                <?php if ($logo): ?>
                                    <img src="<?php echo esc_url($logo['url']); ?>" class="card-img" alt="<?php echo esc_attr(get_the_title()); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <span class="card-title"><?php the_title(); ?></span>
                            </div>
                            <div class="card-footer">
                                <?php if ($ubicacion): ?>
                                    <span>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-map.svg" alt="Ubicación">
                                        <?php echo esc_html($ubicacion); ?>
                                    </span>
                                <?php endif; ?>

                                <?php if ($fecha): ?>
                                    <span>
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icon-calendar.svg" alt="Fecha">
                                        <?php echo esc_html(date_i18n('d.m.Y', strtotime($fecha))); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>
