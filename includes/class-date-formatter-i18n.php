<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/WPBoilerplate/date-formatter
 * @since      1.0.0
 *
 * @package    Date_Formatter
 * @subpackage Date_Formatter/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Date_Formatter
 * @subpackage Date_Formatter/includes
 * @author     WPBoilerplate <contact@wpboilerplate.com>
 */
class Date_Formatter_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'date-formatter',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
