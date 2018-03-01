<?php
/**
 * Product XML Feeds for WooCommerce - Feed Section Settings
 *
 * @version 1.2.0
 * @since   1.1.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Product_XML_Feeds_Settings_Feed' ) ) :

class Alg_WC_Product_XML_Feeds_Settings_Feed extends Alg_WC_Product_XML_Feeds_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 1.1.0
	 * @since   1.1.0
	 */
	function __construct( $feed_num ) {
		$this->id       = 'feed_' . $feed_num;
		$this->desc     = sprintf( __( 'XML Feed #%d', 'product-xml-feeds-for-woocommerce' ), $feed_num );
		$this->feed_num = $feed_num;
		parent::__construct();
	}

	/**
	 * get_products.
	 *
	 * @version 1.2.0
	 * @since   1.0.0
	 */
	function get_products() {
		$products_options = array();
		$offset     = 0;
		$block_size = 512;
		while( true ) {
			$args = array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'posts_per_page' => $block_size,
				'offset'         => $offset,
				'orderby'        => 'title',
				'order'          => 'ASC',
				'fields'         => 'ids',
			);
			$loop = new WP_Query( $args );
			if ( ! $loop->have_posts() ) {
				break;
			}
			foreach ( $loop->posts as $post_id ) {
				$products_options[ $post_id ] = get_the_title( $post_id );
			}
			$offset += $block_size;
		}
		return $products_options;
	}

	/**
	 * get_settings.
	 *
	 * @version 1.2.0
	 * @since   1.1.0
	 * @todo    add more (all) shortcodes to default item template
	 * @todo    (Booster) variations only, variable only, both
	 */
	function get_settings() {

		// Prepare Products Options
		$products_options = $this->get_products();

		// Prepare Categories Options
		$product_cats_options = array();
		$product_cats = get_terms( 'product_cat', 'orderby=name&hide_empty=0' );
		if ( ! empty( $product_cats ) && ! is_wp_error( $product_cats ) ){
			foreach ( $product_cats as $product_cat ) {
				$product_cats_options[ $product_cat->term_id ] = $product_cat->name;
			}
		}

		// Prepare Tags Options
		$product_tags_options = array();
		$product_tags = get_terms( 'product_tag', 'orderby=name&hide_empty=0' );
		if ( ! empty( $product_tags ) && ! is_wp_error( $product_tags ) ){
			foreach ( $product_tags as $product_tag ) {
				$product_tags_options[ $product_tag->term_id ] = $product_tag->name;
			}
		}

		// Settings
		$products_xml_cron_desc = '';
		if ( 'yes' === get_option( 'alg_wc_product_xml_feeds_enabled', 'yes' ) ) {
			if ( '' != get_option( 'alg_create_products_xml_cron_time_' . $this->feed_num, '' ) ) {
				$scheduled_time_diff = get_option( 'alg_create_products_xml_cron_time_' . $this->feed_num, '' ) - time();
				if ( $scheduled_time_diff > 60 ) {
					$products_xml_cron_desc = '<em>' . sprintf( __( '%s till next update.', 'product-xml-feeds-for-woocommerce' ), human_time_diff( 0, $scheduled_time_diff ) ) . '</em>';
				} elseif ( $scheduled_time_diff > 0 ) {
					$products_xml_cron_desc = '<em>' . sprintf( __( '%s seconds till next update.', 'product-xml-feeds-for-woocommerce' ), $scheduled_time_diff ) . '</em>';
				}
			}
			$products_xml_cron_desc .= '<p><a class="button" href="' . add_query_arg( 'alg_create_products_xml', $this->feed_num ) . '">' . __( 'Create Now', 'product-xml-feeds-for-woocommerce' ) . '</a></p>';
		}
		$products_time_file_created_desc = '';
		if ( '' != get_option( 'alg_products_time_file_created_' . $this->feed_num, '' ) ) {
			$products_time_file_created_desc = sprintf(
				'<em>' . __( 'Recent file was created on %s', 'product-xml-feeds-for-woocommerce' ) . '</em>',
				date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), get_option( 'alg_products_time_file_created_' . $this->feed_num, '' ) )
			);
		}
		$default_file_name = ( ( 1 == $this->feed_num ) ? 'products.xml' : 'products_' . $this->feed_num . '.xml' );
		$settings = array(
			array(
				'title'    => __( 'XML File', 'product-xml-feeds-for-woocommerce' ) . ' #' . $this->feed_num,
				'type'     => 'title',
				'desc'     => $products_time_file_created_desc,
				'id'       => 'alg_products_xml_options_' . $this->feed_num,
			),
			array(
				'title'    => __( 'Enabled', 'product-xml-feeds-for-woocommerce' ),
				'desc'     => __( 'Enable', 'product-xml-feeds-for-woocommerce' ),
				'id'       => 'alg_products_xml_enabled_' . $this->feed_num,
				'default'  => 'yes',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'XML Header', 'product-xml-feeds-for-woocommerce' ),
				'desc'     => sprintf( __( 'Please visit <a href="%s" target="_blank">Product XML Feeds for WooCommerce page</a> to check all available shortcodes.', 'product-xml-feeds-for-woocommerce' ), 'https://wpcodefactory.com/item/product-xml-feeds-woocommerce/' ),
				'id'       => 'alg_products_xml_header_' . $this->feed_num,
				'default'  => '<?xml version = "1.0" encoding = "utf-8" ?>' . PHP_EOL .
					'<root>' . PHP_EOL .
					'<time>[alg_current_datetime]</time>' . PHP_EOL,
				'type'     => 'alg_wc_product_xml_custom_textarea',
				'css'      => 'width:66%;min-width:300px;min-height:150px;',
			),
			array(
				'title'    => __( 'XML Item', 'product-xml-feeds-for-woocommerce' ),
				'desc'     => sprintf( __( 'Please visit <a href="%s" target="_blank">Product XML Feeds for WooCommerce page</a> to check all available shortcodes.', 'product-xml-feeds-for-woocommerce' ), 'https://wpcodefactory.com/item/product-xml-feeds-woocommerce/' ),
				'id'       => 'alg_products_xml_item_' . $this->feed_num,
				'default'  =>
					'<item>' . PHP_EOL .
						"\t" . '<name>[alg_product_title]</name>' . PHP_EOL .
						"\t" . '<formatted_name>[alg_product_formatted_name]</formatted_name>' . PHP_EOL .
						"\t" . '<link>[alg_product_url]</link>' . PHP_EOL .
						"\t" . '<type>[alg_product_type]</type>' . PHP_EOL .
						"\t" . '<price>[alg_product_price]</price>' . PHP_EOL .
						"\t" . '<currency>[alg_shop_currency]</currency>' . PHP_EOL .
						"\t" . '<image_url>[alg_product_image_url]</image_url>' . PHP_EOL .
						"\t" . '<product_url>[alg_product_url]</product_url>' . PHP_EOL .
						"\t" . '<sku>[alg_product_sku]</sku>' . PHP_EOL .
						"\t" . '<weight>[alg_product_weight]</weight>' . PHP_EOL .
						"\t" . '<dimensions>[alg_product_dimensions]</dimensions>' . PHP_EOL .
						"\t" . '<length>[alg_product_length]</length>' . PHP_EOL .
						"\t" . '<width>[alg_product_width]</width>' . PHP_EOL .
						"\t" . '<height>[alg_product_height]</height>' . PHP_EOL .
						"\t" . '<stock_availability>[alg_product_stock_availability]</stock_availability>' . PHP_EOL .
						"\t" . '<tax_class>[alg_product_tax_class]</tax_class>' . PHP_EOL .
						"\t" . '<tax_status>[alg_product_meta name="_tax_status"]</tax_status>' . PHP_EOL .
						"\t" . '<you_save>[alg_product_you_save]</you_save>' . PHP_EOL .
						"\t" . '<you_save_percent>[alg_product_you_save_percent]</you_save_percent>' . PHP_EOL .
						"\t" . '<price_including_tax>[alg_product_price_including_tax]</price_including_tax>' . PHP_EOL .
						"\t" . '<price_excluding_tax>[alg_product_price_excluding_tax]</price_excluding_tax>' . PHP_EOL .
						"\t" . '<average_rating>[alg_product_average_rating]</average_rating>' . PHP_EOL .
						"\t" . '<stock_quantity>[alg_product_stock_quantity]</stock_quantity>' . PHP_EOL .
						"\t" . '<sale_price>[alg_product_sale_price]</sale_price>' . PHP_EOL .
						"\t" . '<regular_price>[alg_product_regular_price]</regular_price>' . PHP_EOL .
						"\t" . '<excerpt>[alg_product_excerpt]</excerpt>' . PHP_EOL .
						"\t" . '<short_description>[alg_product_short_description]</short_description>' . PHP_EOL .
						"\t" . '<custom_field>[alg_product_custom_field]</custom_field>' . PHP_EOL .
						"\t" . '<tags>[alg_product_tags]</tags>' . PHP_EOL .
						"\t" . '<total_sales>[alg_product_total_sales]</total_sales>' . PHP_EOL .
						"\t" . '<shipping_class>[alg_product_shipping_class]</shipping_class>' . PHP_EOL .
						"\t" . '<categories>[alg_product_categories]</categories>' . PHP_EOL .
						"\t" . '<categories_names>[alg_product_categories_names]</categories_names>' . PHP_EOL .
						"\t" . '<categories_urls>[alg_product_categories_urls]</categories_urls>' . PHP_EOL .
						"\t" . '<list_attributes>[alg_product_list_attributes]</list_attributes>' . PHP_EOL .
						"\t" . '<list_attribute>[alg_product_list_attribute]</list_attribute>' . PHP_EOL .
						"\t" . '<time_since_last_sale>[alg_product_time_since_last_sale]</time_since_last_sale>' . PHP_EOL .
						"\t" . '<available_variations>[alg_product_available_variations]</available_variations>' . PHP_EOL .
					'</item>' . PHP_EOL,
				'type'     => 'alg_wc_product_xml_custom_textarea',
				'css'      => 'width:66%;min-width:300px;min-height:300px;',
			),
			array(
				'title'    => __( 'XML Footer', 'product-xml-feeds-for-woocommerce' ),
				'desc'     => sprintf( __( 'Please visit <a href="%s" target="_blank">Product XML Feeds for WooCommerce page</a> to check all available shortcodes.', 'product-xml-feeds-for-woocommerce' ), 'https://wpcodefactory.com/item/product-xml-feeds-woocommerce/' ),
				'id'       => 'alg_products_xml_footer_' . $this->feed_num,
				'default'  => '</root>',
				'type'     => 'alg_wc_product_xml_custom_textarea',
				'css'      => 'width:66%;min-width:300px;min-height:150px;',
			),
			array(
				'title'    => __( 'XML File Path and Name', 'product-xml-feeds-for-woocommerce' ),
				'desc_tip' => __( 'Path on server:', 'product-xml-feeds-for-woocommerce' ) . ' ' . ABSPATH . get_option( 'alg_products_xml_file_path_' . $this->feed_num, $default_file_name ),
				'desc'     => __( 'URL:', 'product-xml-feeds-for-woocommerce' ) . ' ' . '<a target="_blank" href="' . site_url() . '/' . get_option( 'alg_products_xml_file_path_' . $this->feed_num, $default_file_name ) . '">' . site_url() . '/' . get_option( 'alg_products_xml_file_path_' . $this->feed_num, $default_file_name ) . '</a>',
				'id'       => 'alg_products_xml_file_path_' . $this->feed_num,
				'default'  => $default_file_name,
				'type'     => 'text',
				'css'      => 'width:66%;min-width:300px;',
			),
			array(
				'title'    => __( 'Update Period', 'product-xml-feeds-for-woocommerce' ),
				'desc'     => $products_xml_cron_desc,
				'id'       => 'alg_create_products_xml_period_' . $this->feed_num,
				'default'  => 'weekly',
				'type'     => 'select',
				'options'  => array(
					'minutely'   => __( 'Update Every Minute', 'product-xml-feeds-for-woocommerce' ),
					'hourly'     => __( 'Update Hourly', 'product-xml-feeds-for-woocommerce' ),
					'twicedaily' => __( 'Update Twice Daily', 'product-xml-feeds-for-woocommerce' ),
					'daily'      => __( 'Update Daily', 'product-xml-feeds-for-woocommerce' ),
					'weekly'     => __( 'Update Weekly', 'product-xml-feeds-for-woocommerce' ),
				),
				'desc_tip' => __( 'Possible update periods are: every minute, hourly, twice daily, daily and weekly.', 'product-xml-feeds-for-woocommerce' ) . ' ' . apply_filters( 'alg_wc_product_xml_feeds', __( 'Get Product XML Feeds for WooCommerce Pro to change update period.', 'product-xml-feeds-for-woocommerce' ), 'settings' ),
				'custom_attributes' => apply_filters( 'alg_wc_product_xml_feeds', array( 'disabled' => 'disabled' ), 'settings' ),
			),
			array(
				'title'    => __( 'Variable Products', 'product-xml-feeds-for-woocommerce' ),
				'id'       => 'alg_products_xml_variable_' . $this->feed_num,
				'default'  => 'variable_only',
				'type'     => 'select',
				'options'  => array(
					'variable_only'   => __( 'Variable product only', 'product-xml-feeds-for-woocommerce' ),
					'variations_only' => __( 'Variation products only', 'product-xml-feeds-for-woocommerce' ),
					'both'            => __( 'Both variable and variations products', 'product-xml-feeds-for-woocommerce' ),
				),
			),
			array(
				'title'    => __( 'Products to Include', 'product-xml-feeds-for-woocommerce' ),
				'desc_tip' => __( 'To include selected products only, enter products here. Leave blank to include all products.', 'product-xml-feeds-for-woocommerce' ),
				'id'       => 'alg_products_xml_products_incl_' . $this->feed_num,
				'default'  => '',
				'class'    => 'chosen_select',
				'type'     => 'multiselect',
				'options'  => $products_options,
			),
			array(
				'title'    => __( 'Products to Exclude', 'product-xml-feeds-for-woocommerce' ),
				'desc_tip' => __( 'To exclude selected products, enter products here. Leave blank to include all products.', 'product-xml-feeds-for-woocommerce' ),
				'id'       => 'alg_products_xml_products_excl_' . $this->feed_num,
				'default'  => '',
				'class'    => 'chosen_select',
				'type'     => 'multiselect',
				'options'  => $products_options,
			),
			array(
				'title'    => __( 'Categories to Include', 'product-xml-feeds-for-woocommerce' ),
				'desc_tip' => __( 'To include products from selected categories only, enter categories here. Leave blank to include all products.', 'product-xml-feeds-for-woocommerce' ),
				'id'       => 'alg_products_xml_cats_incl_' . $this->feed_num,
				'default'  => '',
				'class'    => 'chosen_select',
				'type'     => 'multiselect',
				'options'  => $product_cats_options,
			),
			array(
				'title'    => __( 'Categories to Exclude', 'product-xml-feeds-for-woocommerce' ),
				'desc_tip' => __( 'To exclude products from selected categories, enter categories here. Leave blank to include all products.', 'product-xml-feeds-for-woocommerce' ),
				'id'       => 'alg_products_xml_cats_excl_' . $this->feed_num,
				'default'  => '',
				'class'    => 'chosen_select',
				'type'     => 'multiselect',
				'options'  => $product_cats_options,
			),
			array(
				'title'    => __( 'Tags to Include', 'product-xml-feeds-for-woocommerce' ),
				'desc_tip' => __( 'To include products from selected tags only, enter tags here. Leave blank to include all products.', 'product-xml-feeds-for-woocommerce' ),
				'id'       => 'alg_products_xml_tags_incl_' . $this->feed_num,
				'default'  => '',
				'class'    => 'chosen_select',
				'type'     => 'multiselect',
				'options'  => $product_tags_options,
			),
			array(
				'title'    => __( 'Tags to Exclude', 'product-xml-feeds-for-woocommerce' ),
				'desc_tip' => __( 'To exclude products from selected tags, enter tags here. Leave blank to include all products.', 'product-xml-feeds-for-woocommerce' ),
				'id'       => 'alg_products_xml_tags_excl_' . $this->feed_num,
				'default'  => '',
				'class'    => 'chosen_select',
				'type'     => 'multiselect',
				'options'  => $product_tags_options,
			),
			array(
				'title'    => __( 'Products Scope', 'product-xml-feeds-for-woocommerce' ),
				'id'       => 'alg_products_xml_scope_' . $this->feed_num,
				'default'  => 'all',
				'type'     => 'select',
				'options'  => array(
					'all'               => __( 'All products', 'product-xml-feeds-for-woocommerce' ),
					'sale_only'         => __( 'Only products that are on sale', 'product-xml-feeds-for-woocommerce' ),
					'not_sale_only'     => __( 'Only products that are not on sale', 'product-xml-feeds-for-woocommerce' ),
					'featured_only'     => __( 'Only products that are featured', 'product-xml-feeds-for-woocommerce' ),
					'not_featured_only' => __( 'Only products that are not featured', 'product-xml-feeds-for-woocommerce' ),
				),
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_products_xml_options_' . $this->feed_num,
			),
		);

		return $settings;
	}

}

endif;
