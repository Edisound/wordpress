<?php
/**
 * Plugin Name:     Edisound Player
 * Description:     This plug-in add block and widget to easily embed your Edisound Player
 * Author:          Edisound
 * Author URI:      https://www.edisound.com
 * Text Domain:     edisound
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Edisound
 */

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/widget.php';
require_once plugin_dir_path(__FILE__) . 'blocks/player.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';

// Funcion used by Block/Shortcode/Widget
function edisound_init_js()
{
	echo wp_unslash('<script type="text/javascript" src="https://publishers.edisound.com/player/javascript/init.js" async></script>');
}
