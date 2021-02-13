<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Seo Assistant
 * Plugin URI:        https://github.com/cs_army/seo-assistant
 * Description:       Add tracking and verification script on your WordPress site with ease. Place your ids and content tags in *Easy Tags and Tracking Id Inserter* to get verified.
 * Version:           1.0.
 * Author:            cs_army
 * Author URI:        https://cs_army.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       seo-assistant
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SEO_ASSISTANT', '1.0' );

define('SEO_ASSISTANT_NAME', 'Seo Assistant');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-seo-assistant-activator.php
 */
function activate_seo_assistant_inserter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-seo-assistant-activator.php';
	Seo_Assistant_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-seo-assistant-deactivator.php
 */
function deactivate_seo_assistant_inserter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-seo-assistant-deactivator.php';
	Seo_Assistant_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_seo_assistant_inserter' );
register_deactivation_hook( __FILE__, 'deactivate_seo_assistant_inserter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-seo-assistant.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_seo_assistant() {

	$plugin = new Seo_Assistant();
	$plugin->run();

}
run_seo_assistant();

