<?php
/**
 * The template for displaying WooCommerce shop/products
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

get_header(); ?>

<?php woocommerce_content(); ?>

<?php get_footer(); ?>