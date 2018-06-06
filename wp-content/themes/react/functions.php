<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

// Load the theme

require_once get_template_directory() . '/includes/framework.php';
