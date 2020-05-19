<?php

function plugin_your_face() {
	// Plugins you want to have run on live/production only
	$production_plugins = array(
		'wp-optimize/wp-optimize.php',
		'ssl-insecure-content-fixer/ssl-insecure-content-fixer.php'
	);

	foreach ($production_plugins as $plugin) {
		if(WP_ENV != 'production'){
			if(is_plugin_active($plugin)) {
				deactivate_plugins($plugin);
			}
		} else {
			if(is_plugin_inactive($plugin)) {
				activate_plugin($plugin);
			}
		}
	}
}

add_action('admin_init', 'plugin_your_face');