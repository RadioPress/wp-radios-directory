<?php

/**
 * WP radio directory start file
 *
 * @link              http://dezodev.tk/
 * @since             0.1.0
 * @package           DezoTools
 *
 * @wordpress-plugin
 * Plugin Name:       WP radio directory
 * Plugin URI:        http://dezodev.tk/wp-radios-directory
 * Description:       This plugin let you create a radios directory with link and description.
 * Version:           0.1.0
 * Author:            Dezodev
 * Author URI:        http://dezodev.tk/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       wp-radios-directory
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

if (!class_exists('WPRadioDir_Main')) {
	class WPRadioDir_Main {
		/** Constructor **/

		public function __construct() {
            $this->add_action('plugins_loaded', 'plugin_loaded', 1);
			$this->add_action('init', 'plugin_init');

			// On activation of the plugin
			register_activation_hook(__FILE__, array(&$this, 'plugin_activate'));

			// On desactivation of the plugin
			register_deactivation_hook(__FILE__, array(&$this, 'plugin_desactivate'));

			// On uninstallation of the plugin
			// register_uninstall_hook(__FILE__, array(&$this, 'plugin_uninstall'));
		}

		/** Plugin actions **/

		public function plugin_init() {
		}

		public function plugin_loaded() {
            $this->set_constants(); // Set Constants
            $this->includes(); // Load Functions
		}

		public static function plugin_activate() {
            $base_dir = trailingslashit(plugin_dir_path(__FILE__));

			// require_once $base_dir.'admin/wp-radios-directory-admin.php';
            // WPRadioDir_Admin::set_default_options();
		}

        public static function plugin_desactivate() {
        }

        /** Plugin methods **/

		public function set_constants() {
            define('WPRADIODIR_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) ); // Plugin Directory
			define('WPRADIODIR_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) ); // Plugin URL
			define('WPRADIODIR_INCLUDES', WPRADIODIR_DIR . trailingslashit( 'includes' ) ); // Path to include dir
            define('WPRADIODIR_VER', '0.1.0' ); // Plugin version
		}

        public function includes() {
			require_once WPRADIODIR_DIR.'admin/wp-radios-directory-admin.php';
            new WPRadioDir_Admin();
		}

		/** Plugin helpers **/

		private function add_action($action, $fn, $priority = 10, $accepted_args = 1) {
            add_action($action, array(&$this, $fn), $priority, $accepted_args);
        }
	}
}

$GLOBALS['WPRadioDir_Main'] = new WPRadioDir_Main();
