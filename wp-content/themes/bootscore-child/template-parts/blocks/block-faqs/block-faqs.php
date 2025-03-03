<?php
// Verificar si hay datos en el repeater
$title = get_field('title');
$description = get_field('description');
?>

<?php
// Verificar si hay datos en el repeater
if (have_rows('items')) : ?>

    <section class="wp-block-group section-faqs">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 accordion accordion-faqs" id="faqAccordion">
                <?php $i = 1;
                while (have_rows('items')) : the_row(); ?>
                    <div class="col">
                        <div class="accordion-item">
                            <span class="accordion-header" id="heading-<?php echo $i; ?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $i; ?>" aria-expanded="false">
                                    <?php echo esc_html(get_sub_field('title')); ?>
                                </button>
                            </span>
                            <div id="collapse-<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <?php the_sub_field('description'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $i++;
                endwhile; ?>
            </div>
        </div>
    </section>

<?php endif; ?>