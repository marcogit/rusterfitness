<?php if (have_rows('step')): ?>
    <div class="steps row justify-content-center">
        <?php while (have_rows('step')): the_row();
            $number = get_sub_field('number');
            $title = get_sub_field('title');
            $description = get_sub_field('description');
        ?>
            <div class="col-lg-4">
                <div class="step">
                    <div class="step-number">
                        <span class="h4"><?php echo esc_html($number); ?></span>
                    </div>
                    <div class="step-content">
                        <p class="h4 step-content--title"><?php echo esc_html($title); ?></p>
                        <?php echo esc_html($description); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>