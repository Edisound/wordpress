<?php

define( 'MSB_PLUGIN_FILE', dirname(__FILE__) );
define( 'MSB_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

add_shortcode('edisound_player', function($atts) {
	add_action('wp_footer', 'edisound_init_js');

	extract(shortcode_atts(
		array(
			'tag'   => null,
		), $atts));

	if($tag) {
		$tag = '<div class="rwm-podcast-player" data-pid="'.$tag.'"></div>';
	}

	return $tag;
});

function tiny_mce_register_buttons( $buttons ) {
	$newBtns = array(
		'edisound_button'
	);

	return array_merge( $buttons, $newBtns );
}

function tiny_mce_add_buttons( $plugin_array ) {
	$plugin_array['edisound_button'] = plugin_dir_url( MSB_PLUGIN_FILE ) . 'assets/js/embed_button.js';
	return $plugin_array;
}

add_action( 'init', 'tiny_mce_new_buttons' );

function tiny_mce_new_buttons() {
	add_filter( 'mce_external_plugins', 'tiny_mce_add_buttons' );
	add_filter( 'mce_buttons', 'tiny_mce_register_buttons' );
}