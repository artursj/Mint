<?php
/**
 * Product XML Feeds for WooCommerce - Core Class
 *
 * @version 1.2.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Product_XML_Feeds_Core' ) ) :

class Alg_WC_Product_XML_Feeds_Core {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function __construct() {
		if ( 'yes' === get_option( 'alg_wc_product_xml_feeds_enabled', 'yes' ) ) {
			add_action( 'init',           array( $this, 'schedule_the_events' ) );
			add_action( 'admin_init',     array( $this, 'schedule_the_events' ) );
			add_action( 'admin_init',     array( $this, 'alg_create_products_xml' ) );
			add_filter( 'cron_schedules', array( $this, 'cron_add_custom_intervals' ) );
			$total_number = apply_filters( 'alg_wc_product_xml_feeds', 1, 'value_total_number' );
			for ( $i = 1; $i <= $total_number; $i++ ) {
				add_action( 'alg_create_products_xml_hook_' . $i, array( $this, 'create_products_xml_cron' ), PHP_INT_MAX, 2 );
			}
		}
	}

	/**
	 * On an early action hook, check if the hook is scheduled - if not, schedule it.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function schedule_the_events() {
		$update_intervals  = array(
			'minutely',
			'hourly',
			'twicedaily',
			'daily',
			'weekly',
		);
		$total_number = apply_filters( 'alg_wc_product_xml_feeds', 1, 'value_total_number' );
		for ( $i = 1; $i <= $total_number; $i++ ) {
			$event_hook = 'alg_create_products_xml_hook_' . $i;
			if ( 'yes' === get_option( 'alg_products_xml_enabled_' . $i, 'yes' ) ) {
				$selected_interval = apply_filters( 'alg_wc_product_xml_feeds', 'weekly', 'value_update_interval', $i );
				foreach ( $update_intervals as $interval ) {
					$event_timestamp = wp_next_scheduled( $event_hook, array( $interval, $i ) );
					if ( $selected_interval === $interval ) {
						update_option( 'alg_create_products_xml_cron_time_' . $i, $event_timestamp );
					}
					if ( ! $event_timestamp && $selected_interval === $interval ) {
						wp_schedule_event( time(), $selected_interval, $event_hook, array( $selected_interval, $i ) );
					} elseif ( $event_timestamp && $selected_interval !== $interval ) {
						wp_unschedule_event( $event_timestamp, $event_hook, array( $interval, $i ) );
					}
				}
			} else { // unschedule all events
				update_option( 'alg_create_products_xml_cron_time_' . $i, '' );
				foreach ( $update_intervals as $interval ) {
					$event_timestamp = wp_next_scheduled( $event_hook, array( $interval, $i ) );
					if ( $event_timestamp ) {
						wp_unschedule_event( $event_timestamp, $event_hook, array( $interval, $i ) );
					}
				}
			}
		}
	}

	/**
	 * cron_add_custom_intervals.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function cron_add_custom_intervals( $schedules ) {
		$schedules['weekly'] = array(
			'interval' => 604800,
			'display' => __( 'Once Weekly', 'product-xml-feeds-for-woocommerce' )
		);
		$schedules['minutely'] = array(
			'interval' => 60,
			'display' => __( 'Once a Minute', 'product-xml-feeds-for-woocommerce' )
		);
		return $schedules;
	}

	/**
	 * admin_notice__success.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function admin_notice__success() {
		echo '<div class="notice notice-success is-dismissible"><p>' . __( 'Products XML file created successfully.', 'product-xml-feeds-for-woocommerce' ) . '</p></div>';
	}

	/**
	 * admin_notice__error.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function admin_notice__error() {
		echo '<div class="notice notice-error"><p>' . __( 'An error has occurred while creating products XML file.', 'product-xml-feeds-for-woocommerce' ) . '</p></div>';
	}

	/**
	 * alg_create_products_xml.
	 *
	 * @version 1.2.0
	 * @since   1.0.0
	 * @todo    with wp_safe_redirect there is no notice displayed
	 */
	function alg_create_products_xml() {
		if ( isset( $_GET['alg_create_products_xml'] ) ) {
			$file_num = $_GET['alg_create_products_xml'];
			$result = $this->create_products_xml( $file_num );
			add_action( 'admin_notices', array( $this, ( ( false !== $result ) ? 'admin_notice__success' : 'admin_notice__error' ) ) );
			if ( false !== $result ) {
				update_option( 'alg_products_time_file_created_' . $file_num, current_time( 'timestamp' ) );
			}
			wp_safe_redirect( remove_query_arg( 'alg_create_products_xml' ) );
			exit;
		}
	}

	/**
	 * create_products_xml_cron.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function create_products_xml_cron( $interval, $file_num ) {
		$result = $this->create_products_xml( $file_num );
		if ( false !== $result ) {
			update_option( 'alg_products_time_file_created_' . $file_num, current_time( 'timestamp' ) );
		}
		die();
	}

	/**
	 * create_products_xml.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    str_replace( '&', '&amp;', html_entity_decode( ... ) )
	 */
	function create_products_xml( $file_num ) {
		$xml_items = '';
		$xml_header_template  = get_option( 'alg_products_xml_header_' . $file_num, '' );
		$xml_footer_template  = get_option( 'alg_products_xml_footer_' . $file_num, '' );
		$xml_item_template    = get_option( 'alg_products_xml_item_'   . $file_num, '' );
		$products_in_ids      = get_option( 'alg_products_xml_products_incl_' . $file_num, '' );
		$products_ex_ids      = get_option( 'alg_products_xml_products_excl_' . $file_num, '' );
		$products_cats_in_ids = get_option( 'alg_products_xml_cats_incl_' . $file_num, '' );
		$products_cats_ex_ids = get_option( 'alg_products_xml_cats_excl_' . $file_num, '' );
		$products_tags_in_ids = get_option( 'alg_products_xml_tags_incl_' . $file_num, '' );
		$products_tags_ex_ids = get_option( 'alg_products_xml_tags_excl_' . $file_num, '' );
		$products_scope       = get_option( 'alg_products_xml_scope_' . $file_num, 'all' );
		$products_variable    = get_option( 'alg_products_xml_variable_' . $file_num, 'variable_only' );
		$offset = 0;
		$block_size = 256;
		while( true ) {
			$args = array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'posts_per_page' => $block_size,
				'orderby'        => 'date',
				'order'          => 'DESC',
				'offset'         => $offset,
			);
			if ( 'all' != $products_scope ) {
				$args['meta_query'] = WC()->query->get_meta_query();
				switch ( $products_scope ) {
					case 'sale_only':
						$args['post__in']     = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
						break;
					case 'not_sale_only':
						$args['post__not_in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
						break;
					case 'featured_only':
						$args['post__in']     = array_merge( array( 0 ), wc_get_featured_product_ids() );
						break;
					case 'not_featured_only':
						$args['post__not_in'] = array_merge( array( 0 ), wc_get_featured_product_ids() );
						break;
				}
			}
			if ( ! empty( $products_in_ids ) ) {
				$args['post__in'] = $products_in_ids;
			}
			if ( ! empty( $products_ex_ids ) ) {
				$args['post__not_in'] = $products_ex_ids;
			}
			if ( ! empty( $products_cats_in_ids ) ) {
				if ( ! isset( $args['tax_query'] ) ) {
					$args['tax_query'] = array();
				}
				$args['tax_query'][] = array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $products_cats_in_ids,
					'operator' => 'IN',
				);
			}
			if ( ! empty( $products_cats_ex_ids ) ) {
				if ( ! isset( $args['tax_query'] ) ) {
					$args['tax_query'] = array();
				}
				$args['tax_query'][] = array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $products_cats_ex_ids,
					'operator' => 'NOT IN',
				);
			}
			if ( ! empty( $products_tags_in_ids ) ) {
				if ( ! isset( $args['tax_query'] ) ) {
					$args['tax_query'] = array();
				}
				$args['tax_query'][] = array(
					'taxonomy' => 'product_tag',
					'field'    => 'term_id',
					'terms'    => $products_tags_in_ids,
					'operator' => 'IN',
				);
			}
			if ( ! empty( $products_tags_ex_ids ) ) {
				if ( ! isset( $args['tax_query'] ) ) {
					$args['tax_query'] = array();
				}
				$args['tax_query'][] = array(
					'taxonomy' => 'product_tag',
					'field'    => 'term_id',
					'terms'    => $products_tags_ex_ids,
					'operator' => 'NOT IN',
				);
			}
			$loop = new WP_Query( $args );
			if ( ! $loop->have_posts() ) {
				break;
			}
			while ( $loop->have_posts() ) {
				$loop->the_post();
				if ( 'variable_only' === $products_variable || 'both' === $products_variable ) {
					$xml_items .= str_replace( '&', '&amp;', html_entity_decode( do_shortcode( $xml_item_template ) ) );
				}
				if ( 'variations_only' === $products_variable || 'both' === $products_variable ) {
					$_product = wc_get_product();
					if ( $_product->is_type( 'variable' ) ) {
						foreach ( $_product->get_available_variations() as $variation ) {
							global $post;
							$post = get_post( $variation['variation_id'] );
							setup_postdata( $post );
							$xml_items .= str_replace( '&', '&amp;', html_entity_decode( do_shortcode( $xml_item_template ) ) );
						}
					}
				}
			}
			$offset += $block_size;
		}
		wp_reset_postdata();
		return file_put_contents(
			ABSPATH . get_option( 'alg_products_xml_file_path_' . $file_num, ( ( 1 == $file_num ) ? 'products.xml' : 'products_' . $file_num . '.xml' ) ),
			do_shortcode( $xml_header_template ) . $xml_items . do_shortcode( $xml_footer_template )
		);
	}

}

endif;

return new Alg_WC_Product_XML_Feeds_Core();
