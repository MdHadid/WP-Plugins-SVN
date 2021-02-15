<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://mhrthemes.com
 * @since      1.0.0
 *
 * @package    Mhr_Post_Ticker
 * @subpackage Mhr_Post_Ticker/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mhr_Post_Ticker
 * @subpackage Mhr_Post_Ticker/includes
 * @author     MhrThemes <md.hadidrahman@gmail.com>
 */
class Mhr_Post_Ticker_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mhr-post-ticker',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
