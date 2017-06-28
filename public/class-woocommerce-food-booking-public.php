<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://technecastrol.com
 * @since      1.0.0
 *
 * @package    Woocommerce_Food_Booking
 * @subpackage Woocommerce_Food_Booking/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocommerce_Food_Booking
 * @subpackage Woocommerce_Food_Booking/public
 * @author     Valentine Ubani Mayaki <mxvmayaki@gmail.com>
 */
class Woocommerce_Food_Booking_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		if( is_product() || is_page() ) {

			//$calendar_theme_sel = 'smoothness';
	        //wp_enqueue_style( 'prdd-jquery-ui', "//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/$calendar_theme_sel/jquery-ui.css" , '', '1.8', false );
	        // wp_enqueue_style( 'prdd-jquery-ui', "https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" , '', '1.8', false );


	        wp_enqueue_style( 'picker-default-css', "https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/themes/default.css" , '', '3.5.6', false );
	        wp_enqueue_style( 'picker-default-date-css', "https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/themes/default.date.css" , array('picker-default-css'), '3.5.6', false );
	        wp_enqueue_style( 'picker-default-time-css', "https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/themes/default.time.css" , array('picker-default-css'), '3.5.6', false );
		}
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-food-booking-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		if( is_product() || is_page() ) {
			wp_enqueue_script( 'jquery' );
            //wp_deregister_script( 'jqueryui' );
           // wp_enqueue_script( 'jqueryui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', '', '', false );
            wp_enqueue_script( 'picker', 'https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/picker.js', array('jquery') , '3.5.6');
            wp_enqueue_script( 'picker-date', 'https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/picker.date.js', array('jquery', 'picker') , '3.5.6');
            wp_enqueue_script( 'picker-time', 'https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/compressed/picker.time.js', array('jquery', 'picker') , '3.5.6');
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocommerce-food-booking-public.js', array( 'jquery' ), $this->version, false );
		}

	}

	public function before_add_to_cart()
	{
		//@note if( has_term( array('term1', 'term2', 'term3'), 'product_cat' ) )
		//for consideration of adding field based on term
		global $post, $wpdb, $woocommerce, $product;
		$dateOption = json_encode(array(
			'showButtonPanel' => true
		));
		?>
			<div>
				<label class="delivery_date_label"><?=  __( "Delivery Date", "woocommerce-prdd-lite" ) ?>: </label>
			    <input 
			    	type="text" 
			    	id="delivery_date_for_product" 
			    	name="delivery_date_for_product" 
			    	class="delivery_date_for_product" 
			    	style="cursor: text!important;margin-bottom:10px;"
			    	required 
			    />

			    <label class="delivery_time_label"><?=  __( "Delivery Time", "woocommerce-prdd-lite" ) ?>: </label>
			    <input 
			    	type="text" 
			    	id="delivery_time_for_product" 
			    	name="delivery_time_for_product" 
			    	class="delivery_time_for_product" 
			    	style="cursor: text!important;margin-bottom:10px;"
			    	required
			    />
			</div>
			<script type="text/javascript">
				// jQuery('#delivery_date_for_product').datepicker(
				// 	<?= $dateOption; ?>
				// );
				jQuery('#delivery_date_for_product').pickadate({
					formatSubmit: 'yyyy-mm-dd',
					hiddenName: true,
					min: +1
					//later add disable days of the week|date [1,7] | [[yyyy,m,d]]
				});
				jQuery('#delivery_time_for_product').pickatime({
					formatSubmit: 'h:i A',
					hiddenName: true
					//later add disable times [3,5](24 hrs) | [{from: [hour, minute], to: [hour,minute]}]
				});
			</script>
		<?php
	}
	function delivery_date_time_validation($true, $product_id, $quantity) { 
		//@todo add check to know if delivery date or time is enabled for product
		// probably use term to check its is enabled for term
	    if ( empty( $_REQUEST['delivery_date_for_product'] ) ) {
	        wc_add_notice( __( 'Please select your Delivery date;', 'woocommerce' ), 'error' );
	        return false;
	    }
	    if ( empty( $_REQUEST['delivery_time_for_product'] ) ) {
	        wc_add_notice( __( 'Please select your Delivery time', 'woocommerce' ), 'error' );
	        return false;
	    }
	    return true;
	}

	public function add_date_time_to_cart_item($cart_item_meta, $product_id)
	{
		//@todo add check to know if delivery date or time is enabled for product
		if ( isset( $_POST[ 'delivery_date_for_product' ] ) ) {
            $delivery_date = $_POST[ 'delivery_date_for_product' ];
        }
        if ( isset( $_POST[ 'delivery_time_for_product' ] ) ) {
            $delivery_time = $_POST[ 'delivery_time_for_product' ];
        }
        
        $cart_arr = array();
        if ( isset( $delivery_date ) ) {
            $cart_arr[ 'delivery_date' ] = $delivery_date;
        }
        if ( isset( $delivery_time) ) {
            $cart_arr[ 'delivery_time' ] = $delivery_time;
        }
        $cart_item_meta[ 'wc_delivery_date_time' ][] = $cart_arr;
        return $cart_item_meta;
	}

	/**
    * This function displays the Delivery details on cart page, checkout page.
    */
	public function display_delivery_date_time($other_data, $cart_item)
	{
		if ( isset( $cart_item[ 'wc_delivery_date_time' ] ) ) {
                foreach( $cart_item[ 'wc_delivery_date_time' ] as $delivery ) {
                    $date_name = __( "Delivery Date", "woocommerce-prdd-lite" );
                    if ( isset( $delivery[ 'delivery_date' ] ) && $delivery[ 'delivery_date' ] != "") {
                        $other_data[] = array(
                            'name'    => $date_name,
                            'display' => $delivery[ 'delivery_date' ]
                        );
                    }
                    $time_name = __( "Delivery time", "woocommerce-prdd-lite" );
                    if ( isset( $delivery[ 'delivery_time' ] ) && $delivery[ 'delivery_time' ] != "") {
                        $other_data[] = array(
                            'name'    => $time_name,
                            'display' => $delivery[ 'delivery_time' ]
                        );
                    }

                    $other_data = apply_filters( 'wc_delivery_get_item_data', $other_data, $cart_item );
                }
            }
            return $other_data;
	}

	/**
    * This function updates the database for the delivery details and adds delivery fields on the Order Received page,
    * WooCommerce->Orders when an order is placed for WooCommerce version greater than 2.0.
    */
	public function checkout_update_order_meta_with_delivery_datetime($item, $cart_item_key, $values, $order)
	{
		if (!isset($values['wc_delivery_date_time']) || empty($values['wc_delivery_date_time'])){
			return;
		}
		$delivery = $values['wc_delivery_date_time'];
		if(isset($delivery[0]['delivery_date']) && !empty($delivery[0]['delivery_date'])){
			$item->add_meta_data('_delivery_date', sanitize_text_field($delivery[0]['delivery_date']));
			// wc_add_order_item_meta( $item_id, 'delivery_date', sanitize_text_field($delivery[0]['delivery_date']) );
		}

		if(isset($delivery[0]['delivery_time']) && !empty($delivery[0]['delivery_time'])){
			$item->add_meta_data('_delivery_time', sanitize_text_field($delivery[0]['delivery_time']));
			// wc_add_order_item_meta( $item_id, 'delivery_time', sanitize_text_field($delivery[0]['delivery_time']) );
		}
	}

	public function hidden_order_itemmeta($array)
	{
		$array[] = '_delivery_date';	
		$array[] = '_delivery_time';
		return $array;	
	}

	public function display_item_meta($html, $item, $args)
	{
		$product = is_callable( array( $item, 'get_product' ) ) ? $item->get_product() : $item->product;

        $delivery_date_text = esc_html( apply_filters( 'delivery_date_text', __( 'Delivery Date', 'wc_delivery_date_time' ), $product ) );
        $delivery_time_text   = esc_html( apply_filters( 'delivery_time_text', __( 'Delivery Time', 'wc_delivery_date_time' ), $product ) );
		$delivery_date = $item->get_meta( '_delivery_date' );
        if ( isset( $delivery_date ) && ! empty( $delivery_date ) ) {
            $strings[] = '<strong class="wc-item-meta-label">' . wp_kses_post( $delivery_date_text ) . ':</strong> ' . wp_kses_post($delivery_date);;
        }

        $delivery_time = $item->get_meta( '_delivery_time' );
        if ( isset( $delivery_time ) && ! empty( $delivery_time ) ) {
            $strings[] = '<strong class="wc-item-meta-label">' . wp_kses_post( $delivery_time_text ) . ':</strong> ' . wp_kses_post($delivery_time);
        }
        if ($strings){

        	$html = $args['before'] . implode( $args['separator'], $strings ) . $args['after'];
        }

        return $html;	
	}
	public function order_item_formatted_meta_data($formatted_meta, $item)
	{
		foreach ($formatted_meta as $value) {
			
			if($value->key == '_delivery_date' && !empty($value->value)){
				$value->display_key = __('Delivery Date');
			}
			if($value->key == '_delivery_time' && !empty($value->value)){
				$value->display_key = __('Delivery time');
			}
		}
		return $formatted_meta;
	}

}
