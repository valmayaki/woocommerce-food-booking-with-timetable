<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://technecastrol.com
 * @since             1.0.0
 * @package           Woocommerce_Food_Booking
 *
 * @wordpress-plugin
 * Plugin Name:       Woocommerce food booking
 * Plugin URI:        http://technecastrol.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Valentine Ubani Mayaki
 * Author URI:        http://technecastrol.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-food-booking
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-food-booking-activator.php
 */
function activate_woocommerce_food_booking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-food-booking-activator.php';
	Woocommerce_Food_Booking_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-food-booking-deactivator.php
 */
function deactivate_woocommerce_food_booking() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-food-booking-deactivator.php';
	Woocommerce_Food_Booking_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_food_booking' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_food_booking' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-food-booking.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_food_booking() {

	$plugin = new Woocommerce_Food_Booking();
	$plugin->run();

}
run_woocommerce_food_booking();
