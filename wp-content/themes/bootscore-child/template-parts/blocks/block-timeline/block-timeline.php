<?php if (have_rows('item')): ?>
    <div class="timeline timelineSwiper">
        <div class="swiper-wrapper">
            <?php while (have_rows('item')): the_row();
                // ACF fields dentro del repetidor
                $year = get_sub_field('year');

            ?>
                <div class="timeline-item swiper-slide">
                    <div class="timeline-date"><?php echo esc_html($year); ?></div>
                    <div class="timeline-content">

                        <?php if (have_rows('date')): ?>

                            <?php while (have_rows('date')): the_row();
                                $title = get_sub_field('title');
                                $description = get_sub_field('description');
                            ?>
                                <div class="date-repeater">
                                    <span class="date-repeater--content--title h6"><strong><?php echo esc_html($title); ?></strong></span>
                                    <div class="date-repeater--content"><?php echo wp_kses_post($description); ?></div>
                                </div>
                            <?php endwhile; ?>

                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif; ?>