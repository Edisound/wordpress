<?php

add_shortcode('edisound_player', function($atts) {
	wp_enqueue_script('edisound-player-init', ETUP_INIT_JS_URL, array(), null, true);

	extract(shortcode_atts(
		array(
			'tag'   => null,
		), $atts));

	if($tag) {
		$tag = '<div class="rwm-podcast-player" data-pid="'.$tag.'"></div>';
	}

	return $tag;
});

function etup_tiny_mce_register_buttons( $buttons ): array
{
	$newBtns = array(
		'edisound_button'
	);

	return array_merge( $buttons, $newBtns );
}

function etup_tiny_mce_add_buttons( $plugin_array ) {
	$plugin_array['edisound_button'] = plugin_dir_url(dirname(__FILE__)) . 'assets/js/embed_button.js';
	return $plugin_array;
}

function etup_tiny_mce_new_buttons() {
	add_filter( 'mce_external_plugins', 'etup_tiny_mce_add_buttons' );
	add_filter( 'mce_buttons', 'etup_tiny_mce_register_buttons' );
}

add_action( 'init', 'etup_tiny_mce_new_buttons' );
