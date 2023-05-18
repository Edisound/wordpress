=== Edisound Player ===
Contributors: ErnadoO
Tags: edisound, player
Requires at least: 5.8
Tested up to: 6.2
Requires PHP: 7.4
Stable tag: 0.1.2
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

This plugin allows you to easily integrate the Edisound player in your WordPress Site.

== Description ==

Edisound is the audio partner of the French and international media. With the edisound player, you can host your podcasts and manage your playlists.

Even if the Edisound player easily integrates into most websites with just a javascript file to include in your code, it could be more difficult in a wordPress integration.

In fact, the edisound player tag looks like this :

`<div class="rwm-podcast-player" data-pid="1ed95abc-59e1-6754-b34e-bf9a3e3be867"></div>
<script type="text/javascript" src="https://publishers.edisound.com/player/javascript/init.js" async></script>`

But in somes circonstances, when this code is pasted into an article, the script tag (init.js) is wrongly registered in database, so the player is not displayed.
This plugin does that integration work for you, so you don't have to worry about it. This plug-in provides a Widget, Shortcode (for TinyMCE) and Gutenberg block to easily embed your edisound Player.

All that's left to do is fill the player ID (1ed95abc-59e1-6754-b34e-bf9a3e3be867 in the exemple above) in the gutemberg block/shortcode/widget, and this plugin automatically includes the script file for you if/when needed !

[Privacy policy and cookies](https://www.edisound.com/wp-content/uploads/2021/02/Politique-donne%CC%81es-personnelles-et-cookies-EDISOUND_v2-1.pdf)

== Installation ==

1. Upload `edisound-player` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Enjoy!

== Frequently Asked Questions ==

== Screenshots ==

1. Gutemberg block
2. Gutemberg block preview
3. Widget preview
4. Shortcode for TinyMCE editor(1/2)
5. Shortcode for TinyMCE editor(2/2)

== Changelog ==
