<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Dequeue WooCommerce styles
 */
function react_dequeue_woo_styles($enqueue_styles) {
	unset($enqueue_styles['woocommerce-general']); // Remove the gloss
	unset($enqueue_styles['woocommerce-smallscreen']); // Remove the smallscreen optimisation

	return $enqueue_styles;
}
add_filter('woocommerce_enqueue_styles', 'react_dequeue_woo_styles');

/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
function react_manage_woocommerce_styles() {
	//remove generator meta tag
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

	//first check that woo exists to prevent fatal errors
	if ( function_exists( 'is_woocommerce' ) ) {
		//dequeue scripts and styles
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			//wp_dequeue_style( 'woocommerce_frontend_styles' );
				//wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'jquery-placeholder' );
			//wp_dequeue_script( 'fancybox' );
			wp_dequeue_script( 'jqueryui' );
		} else {
			wp_enqueue_script('select2buttons', react_url('js/select2buttons.js'), array('jquery'), '1.0.1', true);
		}

		// Styles
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

		// Scripts
		wp_dequeue_script( 'prettyPhoto' );
		wp_dequeue_script( 'prettyPhoto-init' );
	}
}
add_action( 'wp_enqueue_scripts', 'react_manage_woocommerce_styles', 99 );

// Woocommerce - Change number of products per row
function react_loop_columns($columns)
{
	$cols = react_get_option('woocommerce_product_columns');

	if (is_numeric($cols) && $cols > 0) {
		$columns = $cols;
	}

	return $columns;
}
add_filter('loop_shop_columns', 'react_loop_columns');

/**
 * Fix the intro title on WooCommerce pages
 *
 * @param   string  $title
 * @return  string
 */
function react_woocommerce_intro_title($title)
{
	$post = react_get_current_post();
	if (function_exists('is_shop') && is_shop()) {
		$meta = react_get_post_meta(wc_get_page_id('shop'), 'intro_title');
		if ($meta) {
			$title = $meta;
		} else {
			$title = woocommerce_page_title(false);
		}
	} elseif (function_exists('is_product_taxonomy') && is_product_taxonomy()) {
		$title = woocommerce_page_title(false);
	}

	return $title;
}
add_filter('react_intro_title', 'react_woocommerce_intro_title');

/**
 * Fix the intro subtitle on WooCommerce pages
 *
 * @param   string  $subtitle
 * @return  string
 */
function react_woocommerce_intro_subtitle($subtitle)
{
	if (function_exists('is_product_taxonomy') && is_product_taxonomy()) {
		$subtitle = '';
	}

	if (function_exists('is_shop') && is_shop()) {
		$meta = react_get_post_meta(wc_get_page_id('shop'), 'intro_subtitle');
		if ($meta) {
			$subtitle = $meta;
		}
	}

	return $subtitle;
}
add_filter('react_intro_subtitle', 'react_woocommerce_intro_subtitle');

// Remove page titles
add_filter('woocommerce_show_page_title', '__return_false');

// Remove single product titles

if (function_exists('wc_get_page_id')) {
	/**
	 * Return the page object corresponding to the WC page
	 *
	 * @param   WP_Post  $post
	 * @return  WP_Post
	 */
	function react_woocommerce_pages($post)
	{
		if (function_exists('is_shop') && is_shop()) {
			$post = get_post(wc_get_page_id('shop'));
		} elseif (function_exists('is_cart') && is_cart()) {
			$post = get_post(wc_get_page_id('cart'));
		} elseif (function_exists('is_checkout') && is_checkout()) {
			$post = get_post(wc_get_page_id('checkout'));
		} elseif (function_exists('is_account_page') && is_account_page()) {
			$post = get_post(wc_get_page_id('myaccount'));
		}

		return $post;
	}
	add_filter('react_current_post', 'react_woocommerce_pages');
}

/**
 * Register the Shop/Product sidebars with the theme
 *
 * @param   array  $sidebars  The current array of sidebars
 * @return  array             The sidebars including WooCommerce ones
 */
function react_get_woocommerce_sidebars($sidebars)
{
	$sidebars['shop'] = array(
		'id' => 'react-sidebar-shop',
		'name' => esc_html__('Shop Sidebar', 'react'),
		'description' => esc_html__('The sidebar widget area on the main WooCommerce Shop page.', 'react')
	);

	$sidebars['product'] = array(
		'id' => 'react-sidebar-product',
		'name' => esc_html__('Product Sidebar', 'react'),
		'description' => esc_html__('The sidebar widget area on single WooCommerce Product pages.', 'react')
	);

	return $sidebars;
}
add_filter('react_get_sidebars', 'react_get_woocommerce_sidebars');

/**
 * Sets the shop sidebar for any WC page
 */
function react_shop_sidebar($sidebar)
{
	if (function_exists('is_shop') && is_shop() ||
		function_exists('is_cart') && is_cart() ||
		function_exists('is_checkout') && is_checkout() ||
		function_exists('is_account_page') && is_account_page() ||
		function_exists('is_product_taxonomy') && is_product_taxonomy() ||
		function_exists('is_product_tag') && is_product_tag()
	) {
		$sidebar = 'shop';
	} elseif (function_exists('is_product') && is_product()) {
		$sidebar = 'product';
	}

	return $sidebar;
}
add_filter('react_sidebar', 'react_shop_sidebar');

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function react_woocommerce_infomenu_cart_count($fragments)
{
	$count = WC()->cart->cart_contents_count;

	$fragments['#im-woocart-count-outer'] = '<span id="im-woocart-count-outer" class="im-woocart-count-outer' . ($count ? '' : ' im-woocart-empty') . '"><span class="im-woocart-count">' . absint($count) . '</span></span>';

	return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'react_woocommerce_infomenu_cart_count');

function react_woocommerce_related_products_args($args)
{
	$related = react_get_option('woocommerce_related_products');
	$columns = react_get_option('woocommerce_related_product_columns');

	if (is_numeric($related)) {
		$args['posts_per_page'] = absint($related);
	}

	if (is_numeric($columns)) {
		$args['columns'] = absint($columns);
	}

	return $args;
}
add_filter('woocommerce_output_related_products_args', 'react_woocommerce_related_products_args');
