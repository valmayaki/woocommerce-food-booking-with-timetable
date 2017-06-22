<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://technecastrol.com
 * @since      1.0.0
 *
 * @package    Woocommerce_Food_Booking
 * @subpackage Woocommerce_Food_Booking/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woocommerce_Food_Booking
 * @subpackage Woocommerce_Food_Booking/includes
 * @author     Valentine Ubani Mayaki <mxvmayaki@gmail.com>
 */
class Woocommerce_Food_Booking_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woocommerce-food-booking',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
