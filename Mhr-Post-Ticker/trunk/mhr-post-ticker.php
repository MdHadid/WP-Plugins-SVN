<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mhrthemes.com
 * @since             1.0.0
 * @package           Mhr_Post_Ticker
 *
 * @wordpress-plugin
 * Plugin Name:       Mhr Post Ticker
 * Plugin URI:        https://ourshoppings.com/mhrplugins
 * Description:       This plugin will enable news ticker in your wordpress theme. You can use news ticker via shortcode in everywhere you want, even in theme files. 
 * Version:           1.0.0
 * Author:            MhrThemes
 * Author URI:        https://mhrthemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mhr-post-ticker
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
define( 'MHR_POST_TICKER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mhr-post-ticker-activator.php
 */
function activate_mhr_post_ticker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mhr-post-ticker-activator.php';
	Mhr_Post_Ticker_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mhr-post-ticker-deactivator.php
 */
function deactivate_mhr_post_ticker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mhr-post-ticker-deactivator.php';
	Mhr_Post_Ticker_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mhr_post_ticker' );
register_deactivation_hook( __FILE__, 'deactivate_mhr_post_ticker' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mhr-post-ticker.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mhr_post_ticker() {

	$plugin = new Mhr_Post_Ticker();
	$plugin->run();

}
run_mhr_post_ticker();
