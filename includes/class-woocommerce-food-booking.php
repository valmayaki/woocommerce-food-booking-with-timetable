<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://technecastrol.com
 * @since      1.0.0
 *
 * @package    Woocommerce_Food_Booking
 * @subpackage Woocommerce_Food_Booking/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Woocommerce_Food_Booking
 * @subpackage Woocommerce_Food_Booking/includes
 * @author     Valentine Ubani Mayaki <mxvmayaki@gmail.com>
 */
class Woocommerce_Food_Booking {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Woocommerce_Food_Booking_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'woocommerce-food-booking';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Woocommerce_Food_Booking_Loader. Orchestrates the hooks of the plugin.
	 * - Woocommerce_Food_Booking_i18n. Defines internationalization functionality.
	 * - Woocommerce_Food_Booking_Admin. Defines all hooks for the admin area.
	 * - Woocommerce_Food_Booking_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woocommerce-food-booking-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woocommerce-food-booking-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woocommerce-food-booking-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-woocommerce-food-booking-public.php';

		$this->loader = new Woocommerce_Food_Booking_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Woocommerce_Food_Booking_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Woocommerce_Food_Booking_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Woocommerce_Food_Booking_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_admin, 'init' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'register_menus' );
		$this->loader->add_action( 'wp_ajax_order_items_with_delivery_date', $plugin_admin, 'get_order_with_delivery_date' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Woocommerce_Food_Booking_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'woocommerce_before_add_to_cart_button', $plugin_public, 'before_add_to_cart' );
		
		$this->loader->add_filter( 'woocommerce_add_cart_item_data', $plugin_public, 'add_date_time_to_cart_item', 25, 2 );
		$this->loader->add_filter( 'woocommerce_get_item_data', $plugin_public, 'display_delivery_date_time', 25, 2 );

		$this->loader->add_action( 'woocommerce_checkout_create_order_line_item', $plugin_public, 'checkout_update_order_meta_with_delivery_datetime', 10, 4 );
		$this->loader->add_filter( 'woocommerce_display_item_meta', $plugin_public, 'display_item_meta', 10, 3 );
		// $this->loader->add_filter( 'woocommerce_hidden_order_itemmeta', $plugin_public, 'hidden_order_itemmeta' );
		$this->loader->add_filter( 'woocommerce_order_item_get_formatted_meta_data', $plugin_public, 'order_item_formatted_meta_data', 10, 2 );
		// $this->loader->add_filter( 'woocommerce_order_item_display_meta_value', $plugin_public, 'order_item_display_meta_key' );
		$this->loader->add_filter( 'woocommerce_add_to_cart_validation', $plugin_public, 'delivery_date_time_validation', 10, 3 );
		// $this->loader->add_filter( 'woocommerce_loop_add_to_cart_link', $plugin_public, 'add_to_car_button_in_loop'	);
		$this->loader->add_filter( 'woocommerce_product_add_to_cart_text', $plugin_public, 'change_add_to_cart_text', 10, 2);
		$this->loader->add_filter( 'woocommerce_product_add_to_cart_url', $plugin_public, 'change_add_to_cart_url', 10, 2);
		$this->loader->add_action( 'woocommerce_cart_actions', $plugin_public, 'view_cart_delivery_calendar');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Woocommerce_Food_Booking_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
