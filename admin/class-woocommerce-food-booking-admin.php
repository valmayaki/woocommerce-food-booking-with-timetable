<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://technecastrol.com
 * @since      1.0.0
 *
 * @package    Woocommerce_Food_Booking
 * @subpackage Woocommerce_Food_Booking/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocommerce_Food_Booking
 * @subpackage Woocommerce_Food_Booking/admin
 * @author     Valentine Ubani Mayaki <mxvmayaki@gmail.com>
 */
class Woocommerce_Food_Booking_Admin {

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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Food_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Food_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-food-booking-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Food_Booking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Food_Booking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocommerce-food-booking-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register methods for init hook
	 * 
	 * @return void
	 */
	public function init()
	{
		$this->register_vendor_taxonomy();
	}

	/**
	 * Registers Taxaonomy
	 * 
	 * @return  void
	 */
	public function register_vendor_taxonomy()
	{
		 $labels = array(
	        'name'                  =>  _x( 'Vendors', 'taxonomy general name' ),
	        'singular_name'         =>  _x( 'Vendor', 'taxonomy singular name' ),
	        'search_items'          =>  __( 'Search Vendors' ),
	        'all_items'             =>  __( 'All Vendors' ),
	        'parent_item'           =>  __( 'Parent Vendor' ),
	        'parent_item_colon'     =>  __( 'Parent Vendor:' ),
	        'edit_item'             =>  __( 'Edit Vendor' ),
	        'update_item'           =>  __( 'Update Vendor' ),
	        'add_new_item'          =>  __( 'Add New Vendor' ),
	        'new_item_name'         =>  __( 'New Vendor Name' ),
	        'menu_name'             =>  __( 'Vendors' ),
    		'choose_from_most_used' =>  __( 'Choose from the most used Vendors' ),
	    );
	 
	    $args = array(
	        'hierarchical'      => true,
	        'labels'            => $labels,
	        'show_ui'           => true,
	        'show_admin_column' => true,
	        'query_var'         => true,
	        'rewrite'           => array( 'slug' => 'vendor' ),
	        'show_in_nav_menus' => true,
	        'show_tag_cloud'    => true,
	        'public'    		=> true,
	    );
	 
	    register_taxonomy( 'vendor', array( 'product' ), $args );
		register_taxonomy_for_object_type( 'vendor', 'product' );
	}

}
