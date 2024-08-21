<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/WPBoilerplate/date-formatter
 * @since      1.0.0
 *
 * @package    Date_Formatter
 * @subpackage Date_Formatter/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Date_Formatter
 * @subpackage Date_Formatter/admin
 * @author     WPBoilerplate <contact@wpboilerplate.com>
 */
class Date_Formatter_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The js_asset_file of the backend
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $js_asset_file;

	/**
	 * The css_asset_file of the backend
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $css_asset_file;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->js_asset_file = include( DATE_FORMATTER_PLUGIN_PATH . 'build/js/backend.asset.php' );
		$this->css_asset_file = include( DATE_FORMATTER_PLUGIN_PATH . 'build/css/backend.asset.php' );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {

		// Ensure we're only loading our scripts on our custom admin page
		if ( 'toplevel_page_date-formatter' !== $hook ) {
			return;
		}

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Date_Formatter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Date_Formatter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, DATE_FORMATTER_PLUGIN_URL . 'build/css/backend.css', $this->css_asset_file['dependencies'], $this->css_asset_file['version'], 'all' );

		// wp_enqueue_style( $this->plugin_name . '-backend-app', DATE_FORMATTER_PLUGIN_URL . 'build/js/style-backend.css', $this->css_asset_file['dependencies'], $this->css_asset_file['version'], 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {

		// Ensure we're only loading our scripts on our custom admin page
		if ( 'toplevel_page_date-formatter' !== $hook ) {
			return;
		}

		// Enqueue React and ReactDOM
		wp_enqueue_script( 'wp-element' );


		// Enqueue WordPress' wp-api-fetch
		wp_enqueue_script( 'wp-api-fetch' );

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Date_Formatter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Date_Formatter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, DATE_FORMATTER_PLUGIN_URL . 'build/js/backend.js', $this->js_asset_file['dependencies'], $this->js_asset_file['version'], false );


		// Localize the script with necessary data (e.g., nonce)
		wp_localize_script(
			$this->plugin_name,
			'wpApiSettings',
			array(
				'nonce' => wp_create_nonce( 'wp_rest' ),
			)
		);
	}

	/**
	 * Register fields.
	 */
	public function register_custom_option() {

		register_setting(
			DATE_FORMATTER_PLUGIN_BASENAME,
			'date_formatter_show_formats',
			array(
				'type' 				=> 'boolean',
				'description'		=> __( 'Show Formats', 'date-formatter' ),
				'sanitize_callback'	=> 'sanitize_text_field',
				'show_in_rest'      => true,
				'default'      		=> false,
			)
		);

		register_setting(
			DATE_FORMATTER_PLUGIN_BASENAME,
			'date_formatter_date_format',
			array(
				'type' 				=> 'string',
				'description'		=> __( 'Date Format', 'date-formatter' ),
				'sanitize_callback'	=> 'sanitize_text_field',
				'show_in_rest'      => true,
				'default'      		=> get_option( 'date_format' ),
			)
		);

		register_setting(
			DATE_FORMATTER_PLUGIN_BASENAME,
			'date_formatter_time_format',
			array(
				'type' 				=> 'string',
				'description' 		=> __( 'Time Format', 'date-formatter' ),
				'sanitize_callback'	=> 'sanitize_text_field',
				'show_in_rest'      => true,
				'default'      		=> get_option( 'time_format' ),
			)
		);
	}

	/**
	 * Add Settings link to plugins area.
	 *
	 * @since    1.0.0
	 *
	 * @param array  $links Links array in which we would prepend our link.
	 * @param string $file  Current plugin basename.
	 * @return array Processed links.
	 */
	public function plugin_action_links( $links, $file ) {

		// Return normal links if not BuddyPress.
		if ( DATE_FORMATTER_PLUGIN_BASENAME !== $file ) {
			return $links;
		}

		// Add a few links to the existing links array.
		return array_merge(
			$links,
			array(
				'about'	=> sprintf( '<a href="%sadmin.php?page=%s">%s</a>', admin_url(), 'date-formatter', esc_html__( 'About', 'date-formatter' ) ),
			)
		);
	}
}
