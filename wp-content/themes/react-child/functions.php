<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
require_once 'vafpress/bootstrap.php';	
// Below you can add PHP functions to override any theme or plugin functionality
add_action( 'woocommerce_before_shop_loop_item_title_options', 'product_options' );
add_action( 'woocommerce_before_shop_loop_item_title_options_rating', 'woocommerce_template_loop_rating' );
function product_options() {

	$return = do_action('woocommerce_before_shop_loop_item_title_options_rating');
	echo $return;
	
	
}

function mint_adding_scripts() {
	wp_register_style('swipercss', "https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.0/css/swiper.min.css");
	wp_register_script('mintmainjs', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);
	wp_register_script('swiperjs', "https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.0/js/swiper.min.js", array('jquery'), true);
	wp_register_script('bootstrapjs', "https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js", array('jquery'), true);
	wp_register_style('bootstrap', "https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");
	
	
	
	wp_enqueue_script('mintmainjs');
	wp_enqueue_script('swiperjs');
	wp_enqueue_script('bootstrapjs');
	wp_enqueue_style('swipercss');
	wp_enqueue_style('bootstrap');
}
  
add_action( 'wp_enqueue_scripts', 'mint_adding_scripts' );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

function woocommerce_template_product_description() {
  woocommerce_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_after_single_product_summary_description', 'woocommerce_template_product_description', 20 );