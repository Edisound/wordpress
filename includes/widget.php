<?php

class Edisound_Widget extends WP_Widget
{
    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'edisoud_widget',
            // Widget name will appear in UI
            __('Edisound Player', 'edisound'),
            // Widget description
            array( 'description' => __( 'This plug-in add block and widget to easily embed your Edisound Player', 'edisound' ), )
        );

        if(is_admin()) {
		    add_action('admin_print_footer_scripts', 'edisound_init_js');
	    }
        elseif (is_active_widget(false, false, $this->id_base)) {
            add_action('wp_footer', 'edisound_init_js');
        }
    }

    // Creating widget front-end
    public function widget( $args, $instance )
    {
        $playerId = apply_filters('widget_title', $instance['player_id'] );

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        if (!empty($playerId)) {
            echo '<div class="rwm-podcast-player" data-pid="'.$playerId.'">'.__('Loading...', 'edisound' ).'</div>';
        }

        echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance )
    {
        $playerId = $instance['player_id'] ?? '';
        $placeHolder =  '1ec13851-c891-647a-a341-853a971cybde';

        // Widget admin form
        $output = '<label for="' . $this->get_field_id('player_id') . '">' . _e('Player code:', 'edisound') . '</label>';
        $output .= '<input placeholder="'.$placeHolder.'" class="widefat" id="' . $this->get_field_id('player_id') . '" name="' . $this->get_field_name('player_id') .'" type="text" value="'  . esc_attr($playerId) .'" />';

        echo '<p>' . $output . '</p>';
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ): array
    {
        $instance = array();
        $instance['player_id'] = ( ! empty( $new_instance['player_id'] ) ) ? strip_tags( $new_instance['player_id'] ) : '';

        return $instance;
    }
}

function edisound_register_widgets()
{
    register_widget(new Edisound_Widget());
}

add_action('widgets_init', 'edisound_register_widgets' );

load_plugin_textdomain('edisound', false, dirname( plugin_basename( __DIR__ ) ) . '/languages/');
