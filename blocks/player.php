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
function player_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__);
	//$dir = dirname( __DIR__).'/blocks/';

	$index_js = 'player/index.js';
	wp_register_script(
		'player-block-editor',
		plugins_url( $index_js, __FILE__ ),
		[
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-editor'
		],
		filemtime( "{$dir}/{$index_js}" )
	);

	$editor_css = 'player/editor.css';
	wp_register_style(
		'player-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		[],
		filemtime( "{$dir}/{$editor_css}" )
	);

	$style_css = 'player/style.css';
	wp_register_style(
		'player-block',
		plugins_url( $style_css, __FILE__ ),
		[],
		filemtime( "{$dir}/{$style_css}" )
	);

	register_block_type( 'edisound/player', [
		//'api_version'   => 2,
		'editor_script' => 'player-block-editor',
		'editor_style'  => 'player-block-editor',
		'style'         => 'player-block',
		'attributes'    => [
			'title'     => ['type' => 'string'],
			'content'   => ['type' => 'string', 'selector' => '.content', 'html' => false]
		],
		'render_callback'   => 'edisound_player_block_render'
	] );
}

function edisound_player_block_render(array $attributes)
{
	if (isset($attributes['content'])) {
		$pId = trim($attributes['content']);

        add_action('wp_footer', 'edisound_init_js');

		return <<<HTML
			<div class="rwm-podcast-player" data-pid="{$pId}"></div>
HTML;
	}
}

add_action( 'init', 'player_block_init' );
