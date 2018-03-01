<?php
/**
 * Product XML Feeds for WooCommerce - General Shortcodes
 *
 * The Product XML Feeds for WooCommerce General Shortcodes class.
 *
 * @version 1.1.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Alg_Products_Shortcodes' ) ) :

class Alg_General_Shortcodes extends Alg_Shortcodes {

	/**
	 * Constructor.
	 *
	 * @version 1.1.0
	 * @since   1.0.0
	 */
	function __construct() {

		$this->the_shortcodes = array(
			'alg_shop_currency',
			'alg_current_datetime',
		);

		$this->the_atts = array(
			'datetime_format' => get_option( 'date_format' ) . ' ' . get_option( 'time_format' ),
		);

		parent::__construct();
	}

	/**
	 * Inits shortcode atts and properties.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function init_atts( $atts ) {
		return $atts;
	}

	/**
	 * alg_shop_currency.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function alg_shop_currency( $atts ) {
		return get_woocommerce_currency();
	}

	/**
	 * alg_current_datetime.
	 *
	 * @version 1.1.0
	 * @since   1.1.0
	 */
	function alg_current_datetime( $atts ) {
		return date_i18n( $atts['datetime_format'], current_time( 'timestamp' ) );
	}

}

endif;

return new Alg_General_Shortcodes();
