<?php

/**
 * Template para mostrar un Espacio individual
 *
 * @package Bootscore
 * @version 6.0.0
 */

// Exit if accessed directly
defined('ABSPATH') || exit;

get_header('transparent');
global $post;

// Obtener los valores de ACF
$subtitle = get_field('subtitle');
$details = get_field('details');
$date = get_field('date');
$client = get_field('client');
?>

<div id="content" class="site-content <?= apply_filters('bootscore/class/container', 'container', 'page-sidebar-none'); ?> <?= apply_filters('bootscore/class/content/spacer', 'pt-4 pb-5', 'page-sidebar-none'); ?>">
    <div id="primary" class="content-area">

        <main id="main" class="site-main">

            <!-- 🔹 SECCIÓN HEADER / PORTADA -->
            <?php
            $image_url = get_the_post_thumbnail_url();
            if ($image_url) {
                echo '<style>
            .page-header--bg {
              background-image: url(' . esc_url($image_url) . ');
            }
          </style>';
            }
            ?>

            <div class="wp-block-group page-header page-header--bg page-header--centermobile">
                <div class="wp-block-columns">
                    <div class="wp-block-column">
                        <?php the_post(); ?>
                        <h1 class="page-header--title"><?php the_title(); ?></h1>
                        <div class="page-header--subtitle">
                            <?php echo esc_html(get_field('subtitle')); ?>
                        </div>
                    </div>
                    <span class="page-header--sticker"><?php _e('Espacios', 'bootscore'); ?></span>
                </div>
            </div>
            <div class="auto-carrousel-bar option-03">
                <div class="auto-carrousel-bar__inner">
                    <ul>
                        <li class="auto-carrousel-bar__cta"><strong><?php the_title(); ?></strong></li>
                        <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/point-bar.svg"></li>
                        <li class="auto-carrousel-bar__name"><?php echo esc_html(get_field('subtitle')); ?></li>
                        <li><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/point-bar.svg"></li>
                    </ul>
                </div>
            </div>

            <!-- 🔹 SECCIÓN MIGAS DE PAN -->
            <section class="wp-block-group section-smaller custom-order-2">
                <div class="wp-block-columns">
                    <div class="wp-block-column">
                        <?php
                        if (function_exists('yoast_breadcrumb')) {
                            yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
                        }
                        ?>
                    </div>
                </div>
            </section>
            <section class="wp-block-group section-small pb-0">
                <div class="wp-block-columns">
                    <div class="wp-block-column">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="row mb-3">
                                    <div class="col-md-3"><span class="h5"><strong><?php _e('Detalles', 'bootscore'); ?></strong></span></div>
                                    <div class="col">
                                        <p><?php echo esc_html($details); ?></p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3"><span class="h5"><strong><?php _e('Fecha', 'bootscore'); ?></strong></span></div>
                                    <div class="col">
                                        <p><?php echo esc_html($date); ?></p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3"><span class="h5"><strong><?php _e('Cliente', 'bootscore'); ?></strong></span></div>
                                    <div class="col">
                                        <p><?php echo esc_html($client); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- 🔹 SECCIÓN CONTENIDO PRINCIPAL -->
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </main>
    </div>
</div>

<?php get_footer(); ?>