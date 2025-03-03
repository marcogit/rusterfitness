<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Product_Tag_Filter_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'product_tag_filter_widget',
            __( 'Product Tag Filter', 'bootscore-child' ),
            array( 'description' => __( 'A widget to filter products by tags', 'bootscore-child' ) )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        $tags = get_terms( array(
            'taxonomy' => 'product_tag',
            'hide_empty' => false,
        ) );

        if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {
            echo '<form id="product-tag-filter-form">';
            echo '<div class="form-group">';
            foreach ( $tags as $tag ) {
                // Get the custom field values for the term
                $color = get_field('color_de_texto', 'product_tag_' . $tag->term_id);
                $background_color = get_field('fondo', 'product_tag_' . $tag->term_id);

                // Set default values if custom fields are empty
                $color = $color ? $color : '#ffffff';
                $background_color = $background_color ? $background_color : '#000000';

                echo '<div class="form-check">';
                echo '<input class="form-check-input" type="checkbox" name="product_tag[]" value="' . esc_attr( $tag->slug ) . '" id="tag-' . esc_attr( $tag->term_id ) . '">';
                echo '<label class="form-check-label" for="tag-' . esc_attr( $tag->term_id ) . '">';
                echo '<span class="badge badge-tag" style="color:' . esc_attr( $color ) . '; background-color:' . esc_attr( $background_color ) . ';">' . esc_html( $tag->name ) . '</span>';
                if ( ! empty( $tag->description ) ) {
                    echo '<p class="tag-description">' . esc_html( $tag->description ) . '</p>';
                }
                echo '</label>';
                echo '</div>';
            }
            echo '</div>';
            echo '</form>';
        }

        echo $args['after_widget'];
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Filter by Tags', 'bootscore-child' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'bootscore-child' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }
}