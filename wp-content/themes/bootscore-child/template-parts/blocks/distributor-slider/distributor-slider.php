<?php if (have_rows('distributor')): ?>
    <div class="swiper distributorsSwiper">
        <div class="swiper-wrapper">
            <?php while (have_rows('distributor')): the_row();
                // ACF fields dentro del repetidor
                $company = get_sub_field('company');
                $name = get_sub_field('name');
                $position = get_sub_field('position');
                $description = get_sub_field('description');
            ?>
                <div class="swiper-slide">
                    <div class="row">
                        <div class="col-md-3">
                            <span class="h5 distributorsSwiper-title"><?php echo esc_html($company); ?></span>
                        </div>
                        <div class="col">
                            <div class="lead"><?php echo wp_kses_post($description); ?></div>
                            <p>
                                <small><?php echo esc_html($name); ?></small> <br />
                                <small><?php echo esc_html($position); ?></small>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
<?php endif; ?>