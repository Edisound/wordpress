<?php
/**
 * @package     Edisound
 *
 * Plugin Name:         Edisound Player
 * Description:         This plug-in add block and widget to easily embed your Edisound Player
 * Author:              Edisound
 * Author URI:          https://www.edisound.com
 * Text Domain:         edisound
 * Domain Path:         /languages
 * Version:             0.1.0
 * Requires at least:   5.1
 * Tested up to:        5.9
 * Requires PHP:        7.3
 */

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/widget.php';
require_once plugin_dir_path(__FILE__) . 'blocks/player.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';

define('ETUP_INIT_JS_URL', 'https://publishers.edisound.com/player/javascript/init.js');

if(is_admin()) {
	wp_enqueue_script('edisound-player-init', ETUP_INIT_JS_URL, array(), null, true);
}
