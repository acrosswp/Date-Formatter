<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/WPBoilerplate/date-formatter
 * @since             1.0.0
 * @package           Date_Formatter
 *
 * @wordpress-plugin
 * Plugin Name:       Date Formatter
 * Plugin URI:        https://github.com/WPBoilerplate/date-formatter
 * Description:       Enhance the user experience on your BuddyBoss (or BuddyPress) platform by displaying actual dates instead of relative timestamps like "2 weeks ago" or "3 days ago." 
 * Version:           1.0.0
 * Author:            WPBoilerplate
 * Author URI:        https://github.com/WPBoilerplate/date-formatter
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       date-formatter
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
define( 'DATE_FORMATTER_FILES', __FILE__ );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-date-formatter-activator.php
 */
function date_formatter_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-date-formatter-activator.php';
	Date_Formatter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-date-formatter-deactivator.php
 */
function date_formatter_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-date-formatter-deactivator.php';
	Date_Formatter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'date_formatter_activate' );
register_deactivation_hook( __FILE__, 'date_formatter_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-date-formatter.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function date_formatter_run() {

	$plugin = Date_Formatter::instance();

	/**
	 * Run this plugin on the plugins_loaded functions
	 */
	add_action( 'plugins_loaded', array( $plugin, 'run' ), 0 );

}
date_formatter_run();