<?php
/**
 * Product XML Feeds for WooCommerce - General Section Settings
 *
 * @version 1.2.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Product_XML_Feeds_Settings_General' ) ) :

class Alg_WC_Product_XML_Feeds_Settings_General extends Alg_WC_Product_XML_Feeds_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 1.1.0
	 * @since   1.0.0
	 */
	function __construct() {
		$this->id   = '';
		$this->desc = __( 'General', 'product-xml-feeds-for-woocommerce' );
		parent::__construct();
	}

	/**
	 * get_settings.
	 *
	 * @version 1.2.0
	 * @since   1.0.0
	 * @todo    (maybe) create all files at once (manually and synchronize update)
	 */
	function get_settings() {
		$settings = array(
			array(
				'title'    => __( 'Product XML Feeds Options', 'product-xml-feeds-for-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_product_xml_feeds_options',
			),
			array(
				'title'    => __( 'WooCommerce Product XML Feeds', 'product-xml-feeds-for-woocommerce' ),
				'desc'     => '<strong>' . __( 'Enable', 'product-xml-feeds-for-woocommerce' ) . '</strong>',
				'desc_tip' => __( 'Product XML Feeds for WooCommerce.', 'product-xml-feeds-for-woocommerce' ),
				'id'       => 'alg_wc_product_xml_feeds_enabled',
				'default'  => 'yes',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Total XML Files (Feeds)', 'product-xml-feeds-for-woocommerce' ),
				'id'       => 'alg_products_xml_total_files',
				'default'  => 1,
				'type'     => 'number',
				'desc'     => apply_filters( 'alg_wc_product_xml_feeds', sprintf( __( 'Get <a href="%s" target="_blank">Product XML Feeds for WooCommerce Pro</a> to add more than one XML feed', 'product-xml-feeds-for-woocommerce' ), 'https://wpcodefactory.com/item/product-xml-feeds-woocommerce/' ), 'settings' ),
				'custom_attributes' => apply_filters( 'alg_wc_product_xml_feeds', array( 'step' => '1', 'min' => '1', 'max' => '1' ), 'settings_custom_attributes' ),
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_product_xml_feeds_options',
			),
		);
		return $settings;
	}

}

endif;

return new Alg_WC_Product_XML_Feeds_Settings_General();
