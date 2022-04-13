<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package edisound
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function etup_player_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	$dir = dirname( __FILE__);

	$index_js = 'player/index.js';
	wp_register_script(
		'edisound-player-block-editor',
		plugins_url( $index_js, __FILE__ ),
		[
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-editor'
		],
		filemtime( "$dir/player/index.js" )
	);

	register_block_type( 'edisound/player', [
		//'api_version'   => 2,
		'editor_script' => 'edisound-player-block-editor',
		'attributes'    => [
			'title'     => ['type' => 'string'],
			'content'   => ['type' => 'string', 'selector' => '.content', 'html' => false]
		],
		'render_callback'   => 'etup_block_render'
	] );
}

function etup_block_render(array $attributes)
{
	if (isset($attributes['content'])) {
		$pId = trim($attributes['content']);

		wp_enqueue_script('edisound-player-init', ETUP_INIT_JS_URL, array(), null, true);

		return '<div class="rwm-podcast-player" data-pid="'.esc_attr($pId).'"></div>';
	}
}

add_action( 'init', 'etup_player_block_init' );
