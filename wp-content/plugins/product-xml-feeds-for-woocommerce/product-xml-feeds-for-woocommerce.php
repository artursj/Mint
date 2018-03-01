<?php
/*
Plugin Name: Product XML Feeds for WooCommerce
Plugin URI: https://wpcodefactory.com/item/product-xml-feeds-woocommerce/
Description: Product XML feeds for WooCommerce.
Version: 1.2.1
Author: Algoritmika Ltd
Author URI: http://www.algoritmika.com
Text Domain: product-xml-feeds-for-woocommerce
Domain Path: /langs
Copyright: © 2017 Algoritmika Ltd.
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Check if WooCommerce is active
$plugin = 'woocommerce/woocommerce.php';
if (
	! in_array( $plugin, apply_filters( 'active_plugins', get_option( 'active_plugins', array() ) ) ) &&
	! ( is_multisite() && array_key_exists( $plugin, get_site_option( 'active_sitewide_plugins', array() ) ) )
) {
	return;
}

if ( 'product-xml-feeds-for-woocommerce.php' === basename( __FILE__ ) ) {
	// Check if Pro is active, if so then return
	$plugin = 'product-xml-feeds-for-woocommerce-pro/product-xml-feeds-for-woocommerce-pro.php';
	if (
		in_array( $plugin, apply_filters( 'active_plugins', get_option( 'active_plugins', array() ) ) ) ||
		( is_multisite() && array_key_exists( $plugin, get_site_option( 'active_sitewide_plugins', array() ) ) )
	) {
		return;
	}
}

if ( ! class_exists( 'Alg_WC_Product_XML_Feeds' ) ) :

/**
 * Main Alg_WC_Product_XML_Feeds Class
 *
 * @class   Alg_WC_Product_XML_Feeds
 * @version 1.2.0
 * @since   1.0.0
 */
final class Alg_WC_Product_XML_Feeds {

	/**
	 * Plugin version.
	 *
	 * @var   string
	 * @since 1.0.0
	 */
	public $version = '1.2.1';

	/**
	 * @var   Alg_WC_Product_XML_Feeds The single instance of the class
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	/**
	 * Main Alg_WC_Product_XML_Feeds Instance
	 *
	 * Ensures only one instance of Alg_WC_Product_XML_Feeds is loaded or can be loaded.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @static
	 * @return  Alg_WC_Product_XML_Feeds - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Alg_WC_Product_XML_Feeds Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @access  public
	 */
	function __construct() {

		// Set up localisation
		load_plugin_textdomain( 'product-xml-feeds-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );

		// Include required files
		$this->includes();

		// Settings & Scripts
		if ( is_admin() ) {
			add_filter( 'woocommerce_get_settings_pages', array( $this, 'add_woocommerce_settings_tab' ) );
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'action_links' ) );
		}
	}

	/**
	 * Show action links on the plugin screen
	 *
	 * @version 1.2.0
	 * @since   1.0.0
	 * @param   mixed $links
	 * @return  array
	 */
	function action_links( $links ) {
		$custom_links = array();
		$custom_links[] = '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=alg_wc_product_xml_feeds' ) . '">' . __( 'Settings', 'woocommerce' ) . '</a>';
		if ( 'product-xml-feeds-for-woocommerce.php' === basename( __FILE__ ) ) {
			$custom_links[] = '<a href="https://wpcodefactory.com/item/product-xml-feeds-woocommerce/">' . __( 'Unlock All', 'product-xml-feeds-for-woocommerce' ) . '</a>';
		}
		return array_merge( $custom_links, $links );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 *
	 * @version 1.1.0
	 * @since   1.0.0
	 */
	function includes() {
		// Shortcodes
		require_once( 'includes/class-alg-shortcodes.php' );
		require_once( 'includes/class-alg-general-shortcodes.php' );
		require_once( 'includes/class-alg-products-shortcodes.php' );
		// Settings
		require_once( 'includes/admin/class-alg-wc-product-xml-feeds-settings-section.php' );
		$settings = array();
		$settings[] = require_once( 'includes/admin/class-alg-wc-product-xml-feeds-settings-general.php' );
		require_once( 'includes/admin/class-alg-wc-product-xml-feeds-settings-feed.php' );
		$total_number = apply_filters( 'alg_wc_product_xml_feeds', 1, 'value_total_number' );
		for ( $i = 1; $i <= $total_number; $i++ ) {
			$settings[] = new Alg_WC_Product_XML_Feeds_Settings_Feed( $i );
		}
		if ( is_admin() && get_option( 'alg_product_xml_feeds_version', '' ) !== $this->version ) {
			foreach ( $settings as $section ) {
				foreach ( $section->get_settings() as $value ) {
					if ( isset( $value['default'] ) && isset( $value['id'] ) ) {
						$autoload = isset( $value['autoload'] ) ? ( bool ) $value['autoload'] : true;
						add_option( $value['id'], $value['default'], '', ( $autoload ? 'yes' : 'no' ) );
					}
				}
			}
			update_option( 'alg_product_xml_feeds_version', $this->version );
		}
		// Core
		require_once( 'includes/class-alg-wc-product-xml-feeds-core.php' );
	}

	/**
	 * Add Product XML Feeds settings tab to WooCommerce settings.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function add_woocommerce_settings_tab( $settings ) {
		$settings[] = include( 'includes/admin/class-alg-wc-settings-product-xml-feeds.php' );
		return $settings;
	}

	/**
	 * Get the plugin url.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  string
	 */
	function plugin_url() {
		return untrailingslashit( plugin_dir_url( __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  string
	 */
	function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

}

endif;

if ( ! function_exists( 'alg_wc_product_xml_feeds' ) ) {
	/**
	 * Returns the main instance of Alg_WC_Product_XML_Feeds to prevent the need to use globals.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  Alg_WC_Product_XML_Feeds
	 */
	function alg_wc_product_xml_feeds() {
		return Alg_WC_Product_XML_Feeds::instance();
	}
}

alg_wc_product_xml_feeds();
