<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/WPBoilerplate/date-formatter
 * @since      1.0.0
 *
 * @package    Date_Formatter
 * @subpackage Date_Formatter/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Date_Formatter
 * @subpackage Date_Formatter/public
 * @author     WPBoilerplate <contact@wpboilerplate.com>
 */
class Date_Formatter_Public {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct() {
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function load_code() {

		if ( ! Date_Formatter::instance()->get_date_formatter_enable() ) {
			return;
		}

		$date_format = Date_Formatter::instance()->get_date_format();
		if ( empty( $date_format ) ) {
			return;
		}

		$time_format = Date_Formatter::instance()->get_time_format();
		if ( empty( $time_format ) ) {
			return;
		}

		wp_deregister_script( 'bp-livestamp' );
	}
}
