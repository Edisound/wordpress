<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package edisound
 *
 * Text Domain: edisound
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
namespace Edisound\PlayerPlugin\Block;
use const Edisound\PlayerPlugin\ETUP_INIT_JS_URL;

add_action( 'init', function() {
    register_block_type( __DIR__ . '/../block/build', [
        'render_callback'   => __NAMESPACE__.'\edisound_player_block_render'
    ]);
} );

function edisound_player_block_render(array $attributes): string
{
    if (!empty($attributes['content'])) {
        $pId = trim($attributes['content']);

        wp_enqueue_script('edisound-player-init', ETUP_INIT_JS_URL, array(), null, true);

        return '<div class="rwm-podcast-player" data-pid="'.esc_attr($pId).'"></div>';
    }

    return '';
}
