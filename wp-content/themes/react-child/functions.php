<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

// Below you can add PHP functions to override any theme or plugin functionality
add_action( 'woocommerce_before_shop_loop_item_title_options', 'product_options' );
add_action( 'woocommerce_before_shop_loop_item_title_options_rating', 'woocommerce_template_loop_rating' );
function product_options() {

	$return = do_action('woocommerce_before_shop_loop_item_title_options_rating');
	echo $return;
	
	
}