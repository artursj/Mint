<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

// Load the theme

require_once get_template_directory() . '/includes/framework.php';

add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'footer', __( 'Footer', 'mint' ) );
}