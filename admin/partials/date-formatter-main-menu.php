<?php
/**
 * Date_Formatter_Main_Menu Main Menu Class.
 *
 * @since Date_Formatter_Main_Menu 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Fired during plugin licences.
 *
 * This class defines all code necessary to run during the plugin's licences and update.
 *
 * @since      1.0.0
 * @package    Date_Formatter_Main_Menu
 * @subpackage Date_Formatter_Main_Menu/includes
 */
class Date_Formatter_Main_Menu {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Adds the plugin license page to the admin menu.
	 *
	 * @return void
	 */
	public function main_menu() {
		add_menu_page(
			__( 'Date Formatter', 'date-formatter' ),
			__( 'Date Formatter', 'date-formatter' ),
			'manage_options',
			'date-formatter',
			array( $this, 'about' )
		);
	}

	/**
	 * About us for the plugins
	 */
	public function about() {
		?>
		<div id="date-formatter-container" class="date-formatter-container"></div>
		<?php
	}
}