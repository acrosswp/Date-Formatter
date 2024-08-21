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
	public function enqueue_scripts() {
		wp_deregister_script( 'bp-livestamp' );
	}

	public function before_activity_entry() {
		add_filter( 'bp_core_time_since_pre', array( $this, 'time_since_pre' ), 100, 2 );
	}

	public function after_activity_entry() {
		remove_filter( 'bp_core_time_since_pre', array( $this, 'time_since_pre' ), 100 );
	}

	/**
	 * Return the date and time to show
	 */
	public function time_since_pre( $return, $older_date ) {

		// var_dump( "test 3" );
		$format = sprintf( '%s %s', Date_Formatter::instance()->get_date_format(), Date_Formatter::instance()->get_time_format() );

		return date_i18n( $format, strtotime( $older_date ) );
	}

}
