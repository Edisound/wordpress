<?php

namespace Edisound\PlayerPlugin;

/**
 * @package     Edisound
 *
 * Plugin Name:         edisound Player
 * Description:         This plug-in add block, shortcode and widget to easily embed your edisound Player
 * Author:              edisound
 * Author URI:          https://www.edisound.com
 * Text Domain:         edisound
 * Domain Path:         /languages
 * Version:             0.1.2
 * Requires at least:   5.8
 * Tested up to:        6.2
 * Requires PHP:        7.4
 * License:             GPLv3
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.html
 */

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

// Main js script.
// Outside Wordpress context, this script is part of the edisoud player tag
// This wordpress plugin include automatically this file
const ETUP_INIT_JS_URL = 'https://publishers.edisound.com/player/javascript/init.js';

require_once plugin_dir_path(__FILE__) . 'includes/widget.php';
require_once plugin_dir_path(__FILE__) . 'includes/block.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';

add_filter('script_loader_tag', function($tag, $handle) {
    if ( 'edisound-player-init' !== $handle ) {
        return $tag;
    }

    return str_replace( ' src', ' async="async" src', $tag );
}, 10, 2);

if(is_admin()) {
	wp_enqueue_script('edisound-player-init', ETUP_INIT_JS_URL, [], null, true);
}
