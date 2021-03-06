<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.lorainccc.edu/
 * @since             1.0.0
 * @package           Lccc_Academic_Calendar_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       LCCC Academic Calendar Plugin
 * Plugin URI:        http://www.lorainccc.edu/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            David Brattoli
 * Author URI:        http://www.lorainccc.edu/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lccc-academic-calendar-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lccc-academic-calendar-plugin-activator.php
 */
function activate_lccc_academic_calendar_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lccc-academic-calendar-plugin-activator.php';
	Lccc_Academic_Calendar_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lccc-academic-calendar-plugin-deactivator.php
 */
function deactivate_lccc_academic_calendar_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lccc-academic-calendar-plugin-deactivator.php';
	Lccc_Academic_Calendar_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lccc_academic_calendar_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_lccc_academic_calendar_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lccc-academic-calendar-plugin.php';

require_once( plugin_dir_path( __FILE__ ).'/php/lccc-academiceventCPT.php' );

require_once( plugin_dir_path( __FILE__ ).'/php/lccc-academicevent-metabox.php' );

require_once( plugin_dir_path( __FILE__ ).'/php/lccc-academic-site-options.php' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lccc_academic_calendar_plugin() {

	$plugin = new Lccc_Academic_Calendar_Plugin();
	$plugin->run();

}
run_lccc_academic_calendar_plugin();

// Add various fields to the JSON output
function academic_eventapi_register_fields() {
		// Display in the Event Feed
	register_api_field( 'lccc_academicevent',
		'display_in_event_feed',
		array(
			'get_callback'		=> 'lcccacademic_display_in_event_feed',
			'update_callback'	=> null,
			'schema'			=> null
		)
	);
}
function lcccacademic_display_in_event_feed ( $object, $field_name, $request ) {
	$displayinfeed = academic_event_metabox_get_meta('academic_event_metabox_display_in_event_feed');
	return $displayinfeed;
}

add_action( 'rest_api_init', 'academic_eventapi_register_fields');