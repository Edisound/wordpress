<?php

namespace Edisound\PlayerPlugin\Widget;

use WP_Widget;
use const Edisound\PlayerPlugin\ETUP_INIT_JS_URL;

class ETUP_Widget extends WP_Widget
{
	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'edisoud_widget',
			// Widget name will appear in UI
			esc_html__('edisound Player', 'edisound'),
			// Widget description
			array( 'description' => esc_html__( 'This plug-in add a widget to easily embed your edisound Player', 'edisound' ), )
		);
	}

	// Creating widget front-end
	public function widget($args, $instance)
	{
		wp_enqueue_script('edisound-player-init', ETUP_INIT_JS_URL, [], null, true);

		$playerId = apply_filters('widget_title', $instance['player_id'] );
		$output = '';

		if (!empty($playerId)) {
			$output = '<div class="rwm-podcast-player" data-pid="'.esc_attr($playerId).'">'.__('Loading...', 'edisound' ).'</div>';
		}

		echo $args['before_widget'] . wp_kses_post($output) . $args['after_widget'];
	}

	// Widget Backend
	public function form($instance)
	{
		$playerId = $instance['player_id'] ?? '';

		// Widget admin form
		$output = '<label for="' . $this->get_field_id('player_id') . '">' . __('Player code:', 'edisound') . '</label>';
		$output .= '<input class="widefat" id="' . $this->get_field_id('player_id') . '" name="' . $this->get_field_name('player_id') .'" type="text" value="'  . esc_attr($playerId) .'" />';

		echo '<p>' . wp_kses($output, allowed_html_tags()) . '</p>';
	}

	// Updating widget replacing old instances with new
	public function update($new_instance, $old_instance): array
	{
		$instance = [];
		$instance['player_id'] = (!empty($new_instance['player_id'])) ? sanitize_text_field($new_instance['player_id']) : '';

		return $instance;
	}
}

/**
 * Allowed html tags for wp_kses() function
 *
 * @return array Array of allowed html tags.
 */
function allowed_html_tags(): array {
	return [
		'input' => [
			'class' => [],
			'id'    => [],
			'name'  => [],
			'type'  => [],
			'value' => [],
		],
	];
}

function register_widgets()
{
	register_widget(new ETUP_Widget());
}

add_action('widgets_init', __NAMESPACE__.'\register_widgets' );

load_plugin_textdomain('edisound', false, dirname(plugin_basename( __DIR__ )) . '/languages/');
