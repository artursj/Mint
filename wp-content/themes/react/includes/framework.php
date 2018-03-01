<?php

/**
 * framework.php
 *
 * - Theme setup
 * - Front-end and admin shared functions
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

// Define constants
defined('REACT_VERSION')
	|| define('REACT_VERSION', '1.1.3');

defined('REACT_DIR')
	|| define('REACT_DIR', get_template_directory());

defined('REACT_CHILD_DIR')
	|| define('REACT_CHILD_DIR', get_stylesheet_directory());

defined('REACT_INCLUDES_DIR')
	|| define('REACT_INCLUDES_DIR', REACT_DIR . '/includes');

defined('REACT_CACHE_DIR')
	|| define('REACT_CACHE_DIR', REACT_CHILD_DIR . '/cache');

defined('REACT_ADMIN_DIR')
	|| define('REACT_ADMIN_DIR', REACT_DIR . '/admin');

defined('REACT_ADMIN_INCLUDES_DIR')
	|| define('REACT_ADMIN_INCLUDES_DIR', REACT_ADMIN_DIR . '/includes');

defined('REACT_OPTIONS_PREFIX')
	|| define('REACT_OPTIONS_PREFIX', get_stylesheet());

defined('REACT_OPTIONS_NAME')
	|| define('REACT_OPTIONS_NAME', REACT_OPTIONS_PREFIX . '_options');

defined('REACT_META_PREFIX')
	|| define ('REACT_META_PREFIX', '_react_');

defined('REACT_TESTING')
	|| define ('REACT_TESTING', false);

// Load the theme options
react_load_theme_options();

// Load the theme widgets
require_once REACT_INCLUDES_DIR . '/widgets.php';

/**
 * Get the URL to the (parent) theme directory
 *
 * @param   string  $path  Extra path to append to the URL
 * @return  string
 */
function react_url($path = '')
{
	$url = get_template_directory_uri();

	if ($path && is_string($path)) {
		$url .= '/' . ltrim($path, '/');
	}

	return $url;
}

/**
 * Get the URL to the theme admin directory
 *
 * @param   string  $path  Extra path to append to the URL
 * @return  string
 */
function react_admin_url($path = '')
{
	$url = react_url('admin');

	if ($path && is_string($path)) {
		$url .= '/' . ltrim($path, '/');
	}

	return $url;
}

/**
 * Get the URL to the child theme directory
 *
 * @param   string  $path  Extra path to append to the URL
 * @return  string
 */
function react_child_url($path = '')
{
	$url = get_stylesheet_directory_uri();

	if ($path && is_string($path)) {
		$url .= '/' . ltrim($path, '/');
	}

	return $url;
}

/**
 * Get the URL to the theme cache directory
 *
 * @param   string  $path  Extra path to append to the URL
 * @return  string
 */
function react_cache_url($path = '')
{
	$url = react_child_url('cache');

	if ($path && is_string($path)) {
		$url .= '/' . ltrim($path, '/');
	}

	return $url;
}

/**
 * Load the current theme options
 */
function react_load_theme_options()
{
	global $react;
	$react['options'] = react_get_options();
}

/**
 * Get the theme options
 *
 * @return array
 */
function react_get_options()
{
	$savedOptions = get_option(REACT_OPTIONS_NAME);
	$savedOptions = is_array($savedOptions) ? $savedOptions : array();

	return array_merge(react_get_default_options(), $savedOptions);
}

/**
 * If we are live previewing the theme, generate the custom CSS files
 */
function react_generate_preview_css()
{
	if ( ! is_array(get_option(REACT_OPTIONS_NAME))) {
		if ( ! function_exists('react_activation')) {
			require_once REACT_ADMIN_DIR . '/admin.php';
		}

		react_activation();
	}
}
add_action('customize_controls_init', 'react_generate_preview_css');

/**
 * Get a theme option
 *
 * @param   string  $key      The key within the options array
 * @param   mixed   $default  The default value if the key is not found
 * @return  mixed
 */
function react_get_option($key, $default = null)
{
	global $react;

	if (array_key_exists($key, $react['options'])) {
		return $react['options'][$key];
	}

	return $default;
}

/**
 * Get the default options for the theme
 *
 * @return array
 */
function react_get_default_options()
{
	$translations = react_get_default_translations();

	foreach ($translations as $key => $value) {
		$translations[$key] = '';
	}

	return (include REACT_INCLUDES_DIR . '/default-options.php') + $translations;
}

/**
 * Get the list of translatable strings
 */
function react_get_default_translations()
{
	return include REACT_INCLUDES_DIR . '/default-translations.php';
}

if (!function_exists('react_get_layout')) :
/**
 * Get the current page layout
 *
 * @return string One of 'full-width' 'right-sidebar' 'left-sidebar'
 */
function react_get_layout()
{
	global $react;
	$layout = null;

	if (is_page()) {
		$layout = react_get_current_post_meta('layout', $react['options']['general_page_layout']);
	} elseif (is_singular()) {
		if (get_post_type() == 'portfolio') {
			$layout = react_get_current_post_meta('layout', $react['options']['portfolio_single_layout']);
		} elseif (get_post_type() == 'product') {
			$layout = react_get_current_post_meta('layout', $react['options']['shop_single_layout']);
		} else {
			$layout = react_get_current_post_meta('layout', $react['options']['blog_single_layout']);
		}
	} elseif (react_is_blog()) {
		$layout = react_get_current_post_meta('layout', $react['options']['blog_layout']);
	} elseif (is_tax('portfolio_category') || is_tax('portfolio_tag')) {
		$layout = react_get_current_post_meta('layout', $react['options']['portfolio_layout']);
	}

	// WooCommerce support
	if (function_exists('is_shop') && function_exists('wc_get_page_id') && is_shop()) {
		$layout = react_get_post_meta(wc_get_page_id('shop'), 'layout', $react['options']['shop_layout']);
	}

	if (!$layout) {
		$layout = $react['options']['general_layout'];
	}

	return apply_filters('react_layout', $layout);
}
endif;

if (!function_exists('react_get_content_width')) :
/**
 * Get the width of the page content
 *
 * @return int
 */
function react_get_content_width()
{
	global $react;

	$layout = react_get_layout();
	$pageMaxWidth = $react['options']['page_layout_max_width'] - 2 - 80; // 2px for border / 80px padding

	if ($layout == 'left-sidebar' ||  $layout == 'right-sidebar') {
		$width = $pageMaxWidth * ((100 - $react['options']['sidebar_width']) / 100);
	} elseif ($layout == 'full-width') {
		$width = $pageMaxWidth;
	}

	return absint($width);
}
endif;

if (!function_exists('react_set_content_width')) :
 /*
 * Set the $content_width global to the calculated content width
 */
function react_set_content_width()
{
	global $content_width;
	$content_width = react_get_content_width();
}
endif;
add_action('template_redirect', 'react_set_content_width');

if (!function_exists('react_theme_setup')) :
/**
 * Theme setup
 */
function react_theme_setup()
{
	// Set up child theme translations to take precedence
	if (is_child_theme()) {
		load_child_theme_textdomain('react', REACT_CHILD_DIR . '/languages');
	}

	// Set up translations
	load_theme_textdomain('react', REACT_DIR . '/languages');

	// Add automatic feed link support
	add_theme_support('automatic-feed-links');

	// Add Woocommerce support
	add_theme_support('woocommerce');

	// Add thumbnail support
	add_theme_support('post-thumbnails');

	// Add support for title tag
	add_theme_support('title-tag');

	// Set the image sizes
	$sizes = react_get_image_sizes();

	foreach ($sizes as $key => $data) {
		add_image_size($key, $data['width'], $data['height'], $data['crop']);
	}

	// Add post format support
	add_theme_support('post-formats', array('aside', 'audio', 'link', 'gallery', 'status', 'quote', 'image', 'video', 'chat'));
}
endif;
add_action('after_setup_theme', 'react_theme_setup');

if (!function_exists('react_image_size_names_choose')) :
/**
 * Add the theme image sizes to the media size menu
 *
 * @param   $currentSizes
 * @return  array
 */
function react_image_size_names_choose($currentSizes)
{
	$mergeSizes = array();
	$sizes = react_get_image_sizes();

	foreach ($sizes as $key => $size) {
		$mergeSizes[$key] = $size['name'];
	}

	return array_merge($currentSizes, $mergeSizes);
}
endif;
add_filter('image_size_names_choose', 'react_image_size_names_choose');

if (!function_exists('react_get_image_sizes')) :
/**
 * Get the theme image sizes
 *
 * @return  array
 */
function react_get_image_sizes()
{
	$sizes = array(
		'react-512' => array('name' => 'React 512', 'width' => 512, 'height' => 0, 'crop' => false),
		'react-768' => array('name' => 'React 768', 'width' => 768, 'height' => 0, 'crop' => false)
	);

	return apply_filters('react_image_sizes', $sizes);
}
endif;

if (!function_exists('react_register_nav_menus')) :
/**
 * Register the navigation menus
 */
function react_register_nav_menus() {
	register_nav_menus(array(
		'primary-menu' => esc_html__('Primary Menu', 'react'),
		'top-menu' => esc_html__('Top Header Menu', 'react'),
		'secondary-menu' => esc_html__('Secondary Menu', 'react')
	));
}
endif;
add_action('init', 'react_register_nav_menus');

if (!function_exists('react_get_post_meta')) :
/**
 * Get the post meta value with the given key or the default
 * if the value is empty or is equal to the last parameter
 *
 * @param   int     $postId                The ID of the post
 * @param   string  $key                   The meta key
 * @param   mixed   $default               Default value to return
 * @param   mixed   $returnDefaultIfValue  Return the default if value is this value, can be array
 * @return  mixed
 */
function react_get_post_meta($postId, $key, $default = '', $returnDefaultIfValue = null)
{
	$value = get_post_meta($postId, REACT_META_PREFIX . $key, true);

	if ($value === '' || $value === false || ($returnDefaultIfValue !== null && in_array($value, (array) $returnDefaultIfValue, true))) {
		return $default;
	}

	return $value;
}
endif;

if (!function_exists('react_update_post_meta')) :
/**
 * Update the post meta value with the given key
 *
 * @param   int     $postId                The ID of the post
 * @param   string  $key                   The meta key
 */
function react_update_post_meta($postId, $key, $value)
{
	update_post_meta($postId, REACT_META_PREFIX . $key, $value);
}
endif;

if (!function_exists('react_get_current_post_meta')) :
/**
 * Get the post meta value with the given key, returns the default if
 * we aren't on a post page, otherwise passes to react_get_post_meta
 *
 * @param   string  $key                   The meta key
 * @param   string  $default               Default value to return
 * @param   mixed   $returnDefaultIfValue  Return the default if value is this value, can be array
 * @return  mixed
 */
function react_get_current_post_meta($key, $default = '', $returnDefaultIfValue = null)
{
	$post = react_get_current_post();

	if (isset($post->ID, $post->post_type)) {
		return react_get_post_meta($post->ID, $key, $default, $returnDefaultIfValue);
	}

	return $default;
}
endif;

if (!function_exists('react_get_current_post')) :
/**
 * Get the current post
 *
 * @return  WP_Post
 */
function react_get_current_post()
{
	$post = apply_filters('react_current_post', get_queried_object());

	return $post;
}
endif;

/**
 * Logging function
 *
 * Logs each argument as an entry in the error log
 *
 * Will write strings as-is, and var_dump other data types
 */
function react_log()
{
	foreach (func_get_args() as $arg) {
		if (is_string($arg)) {
			error_log($arg);
		} else {
			ob_start();
			var_dump($arg);
			error_log(ob_get_clean());
		}
	}
}

/**
 * Logging function
 *
 * Logs each argument as an entry in the error log
 */
function react_dump()
{
	foreach (func_get_args() as $arg) {
		ob_start();
		var_dump($arg);
		error_log(ob_get_clean());
	}
}

/**
 * Log arguments to the error log only if WP debugging is enabled
 */
function react_debug()
{
	if (defined('WP_DEBUG') && WP_DEBUG) {
		call_user_func_array('react_log', func_get_args());
	}
}

/**
 * Sanitize multiple classes
 *
 * @param   string|array  $classes  Classes to sanitize
 * @return  string                  The sanitized classes
 */
function react_sanitize_class($classes)
{
	if (is_array($classes)) {
		$classes = join(' ', $classes);
	}

	$classes = preg_split('/\s+/', trim($classes));

	$sanitizedClasses = array();

	foreach($classes as $class) {
		$sanitizedClass = sanitize_html_class($class);

		if (!empty($sanitizedClass)) {
			$sanitizedClasses[] = $sanitizedClass;
		}
	}

	return join(' ', $sanitizedClasses);
}

/**
 * Ensure the given number is between min and max
 *
 * @param   int  $number
 * @param   int  $min
 * @param   int  $max
 * @return  int
 */
function react_clamp($number, $min, $max)
{
	return min(max($number, $min), $max);
}

/**
 * Sanitize the given data for allowed HTML tags, the allowed 'post' tags plus iframe
 *
 * @param   string  $data  Data to filter
 * @return  string         The filtered data
 */
function react_kses_html_iframe($data)
{
	$tags = wp_kses_allowed_html('post');

	$tags['iframe'] = array(
		'src' => array(),
		'width' => array(),
		'height' => array(),
		'style' => array(),
		'frameborder' => array(),
		'webkitallowfullscreen' => array(),
		'mozallowfullscreen' => array(),
		'allowfullscreen' => array()
	);

	return wp_kses($data, $tags);
}

if (!function_exists('react_get_translation')) :
/**
 * Return the translation for the given key or use $default if
 * there is no translation
 *
 * @param  string  $key      The translation key
 * @param  string  $default  Default translation
 */
function react_get_translation($key, $default = '')
{
	global $react;
	$key = 'translate_' . $key;
	if (isset($react['options'][$key]) && $react['options'][$key] !== '') {
		return $react['options'][$key];
	}

	return $default;
}
endif;

if (!function_exists('react_t')) :
/**
 * Translates the given theme option using WPML icl_t
 *
 * If WPML is not installed the $string will be returned
 *
 * @param   string  $name    The WPML translation name
 * @param   string  $string  The text to be translated
 * @return  string           The translated string
 */
function react_t($name, $string)
{
	if (function_exists('icl_t')) {
		return icl_t('React', $name, $string);
	}

	return $string;
}
endif;

if (!function_exists('react_get_cwa_by_id')) :
/**
 * Get the infomenu custom widget area with the given ID
 *
 * @param   int $id
 * @return  array|null
 */
function react_get_cwa_by_id($id)
{
	global $react;

	foreach ($react['options']['im_custom_widget_areas'] as $widgetArea) {
		if ($id == $widgetArea['id']) {
			return $widgetArea;
		}
	}
	return null;
}
endif;

/**
 * Get the default ordering for the infomenu items
 *
 * @return  array
 */
function react_get_default_im_order()
{
	return array('search', 'location', 'video', 'contact', 'fscontrols', 'audiocontrols', 'videocontrols', 'woocart');
}

if (!function_exists('react_get_icon_classes')) :
/**
 * Get all the classes for the given icon
 *
 * @param   string  $icon        The icon to add additional classes to
 * @param   string  $sizeImage   The image size for image icons
 * @param   string  $styleImage  The image style for image icons
 * @return  string               The complete classes
 */
function react_get_icon_classes($icon, $sizeImage = 'sml', $styleImage = 'drk')
{
	$classes = array($icon);

	if (preg_match('/^fa\-/', $icon)) {
		$classes[] = 'fa';
	} elseif (preg_match('/^icon\-/', $icon)) {
		$classes[] = 'mix-ico';
	} else {
		$classes[] = $sizeImage . ' iconsprite ' . $styleImage;
	}

	return join(' ', $classes);
}
endif;

if (!function_exists('react_get_post_like_html')) :
/**
 * Get the HTML for the post like button
 *
 * @param   int     $postId  The ID of the post
 * @param   string  $icon    The icon class to use
 * @return  string           THe like HTML
 */
function react_get_post_like_html($postId, $icon = '')
{
	global $react;

	$voteCount = react_get_post_meta($postId, 'votes_count');

	if (!$icon) {
		$icon = $react['options']['blog_post_like_icon'];
	}

	$altIcon = $icon == 'fa-heart' ? 'fa-heart-o' : 'fa-thumbs-o-up';

	$output = '<span class="react-vote"><span class="post-like">';
	if (react_has_already_voted($postId)) {
		$output .= ' <span title="' . esc_attr(react_get_translation('you_like_this', esc_attr__('You like this', 'react'))) . '" class="like alreadyvoted"><i class="' . esc_attr(react_sanitize_class('fa ' . $icon)) . '"></i></span>';
	} else {
		$output .= '<a href="#" data-post_id="' . absint($postId) . '"><span title="' . esc_attr(react_get_translation('click_to_like_this_post', esc_attr__('Click to like this post', 'react'))) . '" class="like"><i class="' . esc_attr(react_sanitize_class('fa ' . $altIcon)) . '"></i></span></a>';
	}
	$output .= '<span class="count">' . absint($voteCount) . '</span></span></span>';

	return $output;
}
endif;

if (!function_exists('react_has_already_voted')) :
/**
 * Has the user already liked this post ID?
 *
 * @param   int      $postId  The ID of the post
 * @return  boolean           True if user has already liked, false otherwise
 */
function react_has_already_voted($postId)
{
	$votedIps = react_get_post_meta($postId, 'voted_ips');

	if(!is_array($votedIps)) {
		$votedIps = array();
	}

	$ip = $_SERVER['REMOTE_ADDR'];

	if(in_array($ip, array_keys($votedIps))) {
		$time = $votedIps[$ip];
		$now = time();

		if(round(($now - $time) / 60) > 1440) { // 1440 = 24 hours before revote
			return false;
		}

		return true;
	}

	return false;
}
endif;

if (!function_exists('react_post_like_ajax')) :
/**
 * Ajax handler for the post like functionality
 */
function react_post_like_ajax()
{
	if (!isset($_POST['post_id']) || !isset($_SERVER['REMOTE_ADDR']) || !$_SERVER['REMOTE_ADDR']) {
		wp_send_json(array('type' => 'error', 'message' => 'Bad request'));
	}

	if (!check_ajax_referer('react_post_like', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	$postId = absint($_POST['post_id']);

	if(react_has_already_voted($postId)) {
		wp_send_json(array('type' => 'error', 'message' => 'Already voted'));
	}

	$ip = $_SERVER['REMOTE_ADDR'];
	$votedIps = react_get_post_meta($postId, 'voted_ips');

	if(!is_array($votedIps)) {
		$votedIps = array();
	}

	$votedIps[$ip] = time();
	$metaCount = react_get_post_meta($postId, 'votes_count');

	react_update_post_meta($postId, 'voted_ips', $votedIps);
	react_update_post_meta($postId, 'votes_count', ++$metaCount);

	$response = array('type' => 'success', 'count' => $metaCount);

	wp_send_json($response);
}
endif;
add_action('wp_ajax_nopriv_react_post_like_ajax', 'react_post_like_ajax');
add_action('wp_ajax_react_post_like_ajax', 'react_post_like_ajax');

if (!function_exists('react_get_styles')) :
/**
 * Get the array of theme stylesheets
 *
 * @return  array
 */
function react_get_styles()
{
	// reserved keys: animate, hover, magic
	$styles = array(
		'font-awesome' => array( // http://fortawesome.github.io/Font-Awesome/
			'name' => 'Font Awesome',
			'tooltip' => esc_html__('Used by several theme features to display icons', 'react'),
			'url' => react_url('css/font-awesome.min.css'),
			'path' => REACT_DIR . '/css/font-awesome.min.css',
			'deps' => array(),
			'version' => '4.6.3'
		),
		'icomoon' => array( // https://icomoon.io/
			'name' => 'Mixed icons',
			'tooltip' => esc_html__('Used by several theme features to display icons', 'react'),
			'url' => react_url('css/icomoon.min.css'),
			'path' => REACT_DIR . '/css/icomoon.min.css',
			'deps' => array(),
			'version' => '1.1.1'
		),
		'fancybox2' => array( // http://fancyapps.com/fancybox/
			'name' => 'Fancybox 2',
			'tooltip' => esc_html__('Used by several theme features to create a lightbox popup', 'react'),
			'url' => react_url('css/jquery.fancybox.min.css'),
			'path' => REACT_DIR . '/css/jquery.fancybox.min.css',
			'deps' => array(),
			'version' => '2.1.5'
		),
		'qtip2' => array( // http://qtip2.com/
			'name' => 'qTip2',
			'tooltip' => esc_html__('Used for displaying tooltips, you are looking at one :)', 'react'),
			'url' => react_url('js/qtip2/jquery.qtip.min.css'),
			'path' => REACT_DIR . '/js/qtip2/jquery.qtip.min.css',
			'deps' => array(),
			'version' => '2.2.1'
		),
		'spinkit' => array( // https://github.com/tobiasahlin/SpinKit/
			'name' => 'SpinKit',
			'tooltip' => esc_html__('Adds a CSS3 loading spinner to the full screen background script and Pace full screen loading', 'react'),
			'url' => react_url('css/spinkit.min.css'),
			'path' => REACT_DIR . '/css/spinkit.min.css',
			'deps' => array(),
			'version' => '1.2.1'
		),
	);

	return apply_filters('react_styles', $styles);
}
endif;

if (!function_exists('react_get_scripts')) :
/**
 * Get the array of theme JavaScript files
 *
 * @return  array
 */
function react_get_scripts()
{
	$scripts = array(
		'sharrre' => array( // https://github.com/Julienh/Sharrre
			'name' => 'Sharrre',
			'tooltip' => esc_html__('Used by the social sharing links', 'react'),
			'url' => react_url('js/jquery.sharrre.min.js'),
			'path' => REACT_DIR . '/js/jquery.sharrre.min.js',
			'deps' => array('jquery'),
			'version' => '1.3.5',
			'footer' => true
		),
		'jquery-actual' => array( // https://github.com/dreamerslab/jquery.actual
			'name' => 'jQuery Actual',
			'url' => react_url('js/jquery.actual.min.js'),
			'path' => REACT_DIR . '/js/jquery.actual.min.js',
			'deps' => array('jquery'),
			'version' => '1.0.16',
			'footer' => true,
			'core' => true // Core script (used by scripts.js) - can't be disabled
		),
		'jquery-cookie' => array( // https://github.com/carhartl/jquery-cookie
			'name' => 'jQuery Cookie',
			'url' => react_url('js/jquery.cookie.min.js'),
			'path' => REACT_DIR . '/js/jquery.cookie.min.js',
			'deps' => array('jquery'),
			'version' => '1.4.1',
			'footer' => true,
			'core' => true // Core script (used by scripts.js) - can't be disabled
		),
		'jquery-hoverIntent' => array( // https://github.com/briancherne/jquery-hoverIntent
			'name' => 'jQuery Hover Intent',
			'tooltip' => esc_html__('Used by site navigation dropdown menus to improve usability', 'react'),
			'url' => react_url('js/jquery.hoverIntent.min.js'),
			'path' => REACT_DIR . '/js/jquery.hoverIntent.min.js',
			'deps' => array('jquery'),
			'version' => '1.8.1',
			'footer' => true
		),
		'superfish' => array( // https://github.com/joeldbirch/superfish/
			'name' => 'Superfish',
			'tooltip' => esc_html__('Used to add dropdown menus to site navigation', 'react'),
			'url' => react_url('js/superfish.min.js'),
			'path' => REACT_DIR . '/js/superfish.min.js',
			'deps' => array('jquery'),
			'version' => '1.7.4',
			'footer' => true
		),
		'fullscreen' => array(
			'name' => 'Full Screen Background',
			'tooltip' => esc_html__('Used to add full screen background images to the page', 'react'),
			'url' => react_url('js/jquery.fullscreen.min.js'),
			'path' => REACT_DIR . '/js/jquery.fullscreen.min.js',
			'deps' => array('jquery', 'jquery-cookie', 'jquery-easing'),
			'version' => '2.0.6',
			'footer' => true
		),
		'jquery-smooth-scroll' => array( // https://github.com/kswedberg/jquery-smooth-scroll
			'name' => 'jQuery Smooth Scroll',
			'tooltip' => esc_html__('Used to smooth scroll to points within the page', 'react'),
			'url' => react_url('js/jquery.smooth-scroll.min.js'),
			'path' => REACT_DIR . '/js/jquery.smooth-scroll.min.js',
			'deps' => array('jquery'),
			'version' => '1.5.5',
			'footer' => true
		),
		'jquery-tools-tabs' => array( // https://github.com/jquerytools/jquerytools/
			'name' => 'jQuery Tools Tabs',
			'tooltip' => esc_html__('Used in the comments if the layout is tabbed', 'react'),
			'url' => react_url('js/jquery.tools.tabs.min.js'),
			'path' => REACT_DIR . '/js/jquery.tools.tabs.min.js',
			'deps' => array('jquery'),
			'version' => '1.2.7',
			'footer' => true
		),
		'jquery-easing' => array( // http://gsgd.co.uk/sandbox/jquery/easing/
			'name' => 'jQuery Easing',
			'tooltip' => esc_html__('Used by several scripts to add easing to jQuery animations', 'react'),
			'url' => react_url('js/jquery.easing.min.js'),
			'path' => REACT_DIR . '/js/jquery.easing.min.js',
			'deps' => array('jquery'),
			'version' => '1.3',
			'footer' => true
		),
		'fancybox2' => array( // http://fancyapps.com/fancybox/
			'name' => 'Fancybox 2',
			'tooltip' => esc_html__('Used by several theme features to create a lightbox popup', 'react'),
			'url' => react_url('js/fancybox2/jquery.fancybox.pack.js'),
			'path' => REACT_DIR . '/js/fancybox2/jquery.fancybox.pack.js',
			'deps' => array('jquery'),
			'version' => '2.1.5',
			'footer' => true
		),
		'jquery-throttle-debounce' => array( // https://github.com/cowboy/jquery-throttle-debounce
			'name' => 'jQuery Throttle Debounce',
			'tooltip' => esc_html__('Used to reduce the browser workload by throttling function calls', 'react'),
			'url' => react_url('js/jquery.ba-throttle-debounce.min.js'),
			'path' => REACT_DIR . '/js/jquery.ba-throttle-debounce.min.js',
			'deps' => array('jquery'),
			'version' => '1.1',
			'footer' => true
		),
		'qtip2' => array( // http://qtip2.com/
			'name' => 'qTip2',
			'tooltip' => esc_html__('Used for displaying tooltips, you are looking at one :)', 'react'),
			'url' => react_url('js/qtip2/jquery.qtip.min.js'),
			'path' => REACT_DIR . '/js/qtip2/jquery.qtip.min.js',
			'deps' => array('jquery'),
			'version' => '2.2.1',
			'footer' => true
		),
		'sidr' => array( // https://github.com/artberri/sidr/
			'name' => 'Sidr',
			'tooltip' => esc_html__('Used for the side menus on devices', 'react'),
			'url' => react_url('js/jquery.sidr.min.js'),
			'path' => REACT_DIR . '/js/jquery.sidr.min.js',
			'deps' => array('jquery'),
			'version' => '1.2.1',
			'footer' => true
		),
		'verge' => array( // https://github.com/ryanve/verge
			'name' => 'Verge',
			'tooltip' => esc_html__('Used for triggering code when elements move into the viewport, e.g. animations', 'react'),
			'url' => react_url('js/verge.min.js'),
			'path' => REACT_DIR . '/js/verge.min.js',
			'deps' => array('jquery'),
			'version' => '1.9.1',
			'footer' => true
		),
		'pace' => array( // https://github.com/HubSpot/pace
			'name' => 'Pace Page Progress',
			'tooltip' => esc_html__('Adds a progress bar to indicate page loading progress', 'react'),
			'url' => react_url('js/pace.min.js'),
			'path' => REACT_DIR . '/js/pace.min.js',
			'deps' => array(),
			'version' => '1.0.2',
			'footer' => true,
			'reqs' => array(
				'page_loader' => 'pace'
			)
		),
		'stellar' => array( // https://github.com/markdalgleish/stellar.js/
			'name' => 'Stellar',
			'tooltip' => esc_html__('Used for parallax effects', 'react'),
			'url' => react_url('js/jquery.stellar.min.js'),
			'path' => REACT_DIR . '/js/jquery.stellar.min.js',
			'deps' => array(),
			'version' => '0.6.2',
			'footer' => true
		),
		'modernizr' => array( // http://modernizr.com/
			'name' => 'Modernizr',
			'tooltip' => esc_html__('Used to detect if modern features are available in the browser', 'react'),
			'url' => react_url('js/modernizr.min.js'),
			'path' => REACT_DIR . '/js/modernizr.min.js',
			'deps' => array(),
			'version' => '3.3.1',
			'footer' => false
		),
		'react-isotope' => array( // https://github.com/metafizzy/isotope/
			'name' => 'Isotope',
			'tooltip' => esc_html__('Used to position widgets on devices', 'react'),
			'url' => react_url('js/isotope.pkgd.min.js'),
			'path' => REACT_DIR . '/js/isotope.pkgd.min.js',
			'deps' => array('jquery'),
			'version' => '2.2.2',
			'footer' => true
		),
		'velocity' => array( // https://github.com/julianshapiro/velocity
			'name' => 'Velocity',
			'tooltip' => esc_html__('A high performance replacement of the jQuery animate() function', 'react'),
			'url' => react_url('js/velocity.min.js'),
			'path' => REACT_DIR . '/js/velocity.min.js',
			'deps' => array(),
			'version' => '1.2.3',
			'footer' => true
		),
		'isinview' => array( // https://github.com/hashchange/jquery.isinview/
			'name' => 'isInView',
			'tooltip' => esc_html__('Used to accurately set the width of viewport-width blocks', 'react'),
			'url' => react_url('js/jquery.isinview.min.js'),
			'path' => REACT_DIR . '/js/jquery.isinview.min.js',
			'deps' => array(),
			'version' => '1.0.1',
			'footer' => true
		),
		'textillate' => array( // https://github.com/jschr/textillate
			'name' => 'Textillate',
			'tooltip' => esc_html__('Animate individual letters in headings', 'react'),
			'url' => react_url('js/jquery.textillate.min.js'),
			'path' => REACT_DIR . '/js/jquery.textillate.min.js',
			'deps' => array('jquery'),
			'version' => '0.4.0',
			'footer' => true
		)
	);

	return apply_filters('react_scripts', $scripts);
}
endif;

if (!function_exists('react_get_palette_by_id')) :
/**
 * Get a custom color palette by ID
 *
 * @param   int         $id  The ID of the palette
 * @return  array|null       The palette config array or null if not found
 */
function react_get_palette_by_id($id)
{
	global $react;
	foreach ($react['options']['custom_palettes'] as $palette) {
		if (is_numeric($id) && $palette['id'] == $id) {
			return $palette;
		}
	}
	return null;
}
endif;

if (!class_exists('React_Description_Walker')) :
/**
 * Navigation menu descriptions
 */
class React_Description_Walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$classes[] = 'menu-item-'. $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="'. esc_attr(react_sanitize_class($class_names)) . '"';

		$output .= $indent . '<li ' . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$prepend = '<span class="main">';
		$append = '</span>';
		$description  = ! empty( $item->description ) ? '<span class="desc"><span>'.esc_attr( $item->description ).'</span></span>' : '';

		if($depth != 0) {
			$description = $append = $prepend = "";
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
		$item_output .= $description.$args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
endif;

if (!function_exists('react_get_texture_detail_size')) :
/**
 * Get the size of the given detail/texture
 *
 * @param  string  $detail  The name of the detail/texture
 * @return array            The array of width/height
 */
function react_get_texture_detail_size($detail)
{
	switch ($detail) {
		// details
		case 'break-lines-light':
		case 'break-lines-light-bottom':
		case 'break-lines-dark':
		case 'break-lines-dark-bottom':
			$w = 32;
			$h = 8;
			break;
		case 'one-light':
		case 'one-light-bottom':
		case 'one-dark':
		case 'one-dark-bottom':
			$w = 12;
			$h = 1;
			break;
		case 'six-light':
		case 'six-light-bottom':
		case 'six-dark':
		case 'six-dark-bottom':
			$w = 12;
			$h = 6;
			break;
		case 'med-gradient-light-top':
		case 'med-gradient-light-bottom':
		case 'med-gradient-dark-top':
		case 'med-gradient-dark-bottom':
			$w = 12;
			$h = 14;
			break;
		case 'large-gradient-light-top':
		case 'large-gradient-light-bottom':
		case 'large-gradient-dark-top':
		case 'large-gradient-dark-bottom':
			$w = 12;
			$h = 25;
			break;
		case 'shadow-center':
		case 'shadow-center-split':
		case 'shadow-left':
		case 'shadow-sides':
			$w = 1920;
			$h = 86;
			break;
		// textures
		case 'vert-thin-dk':
		case 'vert-thin-lt':
			$w = 3;
			$h = 12;
			break;
		case 'vert-thick-dk':
		case 'vert-thick-lt':
			$w = 8;
			$h = 12;
			break;
		case 'diagonal-dk':
		case 'diagonal-lt':
			$w = 5;
			$h = 5;
			break;
		case 'diagonal-rev-dk':
		case 'diagonal-rev-lt':
			$w = 5;
			$h = 5;
			break;
		case 'square-dk':
		case 'square-lt':
			$w = 4;
			$h = 4;
			break;
		case 'dot-dk':
		case 'dot-lt':
			$w = 8;
			$h = 8;
			break;
		case 'cross-dk':
		case 'cross-lt':
			$w = 8;
			$h = 8;
			break;
		case 'cross-two-dk':
		case 'cross-two-lt':
			$w = 8;
			$h = 8;
			break;
		case 'congruent_pentagon':
		case 'congruent_pentagon_dark':
			$w = 300;
			$h = 300;
			break;
		case 'dark_wood':
			$w = 512;
			$h = 512;
			break;
		case 'diagonal_striped_brick':
			$w = 150;
			$h = 150;
			break;
		case 'diamond_upholstery':
			$w = 200;
			$h = 200;
			break;
		case 'escheresque':
			$w = 46;
			$h = 29;
			break;
		case 'fake_brick':
			$w = 76;
			$h = 76;
			break;
		case 'pinstriped_suit':
			$w = 400;
			$h = 333;
			break;
		case 'ps_neutral':
			$w = 16;
			$h = 16;
			break;
		case 'retina_wood':
			$w = 512;
			$h = 512;
			break;
		case 'shattered':
			$w = 250;
			$h = 250;
			break;
		case 'shattered-lgt':
			$w = 250;
			$h = 250;
			break;
		case 'skulls':
			$w = 200;
			$h = 200;
			break;
		case 'noise':
			$w = 128;
			$h = 128;
			break;
		case 'use_your_illusion':
			$w = 54;
			$h = 58;
			break;
		case 'pixel_weave':
			$w = 64;
			$h = 64;
			break;
		case 'alt_tri':
			$w = 177;
			$h = 177;
			break;
		case 'hex':
			$w = 136;
			$h = 78;
			break;
		case 'squared_metal':
			$w = 176;
			$h = 176;
			break;
		case 'multi_dots':
			$w = 51;
			$h = 25;
			break;
		case 'white_wave':
			$w = 23;
			$h = 12;
			break;
		case 'bigstrips':
			$w = 25;
			$h = 25;
			break;
		case 'hugestripes':
			$w = 150;
			$h = 150;
			break;
	}

	return array('w' => $w, 'h' => $h);
}
endif;

if (!function_exists('react_get_favicon_sizes')) :
/**
 * Get the array of touch favicon sizes (http://mathiasbynens.be/notes/touch-icons)
 *
 * @return  array  The array of sizes
 */
function react_get_favicon_sizes()
{
	return apply_filters('react_favicon_sizes', array(57,72,76,114,120,144,152,180));
}
endif;

if (!function_exists('react_get_socials')) :
/**
 * Get the array of social networks used in the social links
 *
 * @return  array
 */
function react_get_socials()
{
	$socials = array(
		'facebook' => array('name' => 'Facebook', 'fc' => true, 'fa' => true),
		'twitter' => array('name' => 'Twitter', 'fc' => true, 'fa' => true),
		'skype' => array('name' => 'Skype', 'fc' => true, 'fa' => true),
		'flickr' => array('name' => 'Flickr', 'fc' => true, 'fa' => true),
		'youtube' => array('name' => 'YouTube', 'fc' => true, 'fa' => true),
		'pinterest' => array('name' => 'Pinterest', 'fc' => true, 'fa' => true),
		'googleplus' => array('name' => 'Google+', 'fc' => true, 'fa' => true, 'fa_class' => 'google-plus'),
		'linkedin' => array('name' => 'LinkedIn', 'fc' => true, 'fa' => true),
		'rss' => array('name' => 'RSS', 'fc' => true, 'fa' => true),
		'vimeo' => array('name' => 'Vimeo', 'fc' => true, 'fa' => true, 'fa_class' => 'vimeo-square'),
		'spotify' => array('name' => 'Spotify', 'fc' => true, 'fa' => true),
		'wordpress' => array('name' => 'WordPress', 'fc' => true, 'fa' => true),
		'soundcloud' => array('name' => 'SoundCloud', 'fc' => true, 'fa' => true),
		'googleplay' => array('name' => 'Google Play', 'fc' => true, 'fa' => false),
		'blogger' => array('name' => 'Blogger', 'fc' => true, 'fa' => false),
		'evernote' => array('name' => 'Evernote', 'fc' => true, 'fa' => false),
		'tripadvisor' => array('name' => 'TripAdvisor', 'fc' => true, 'fa' => false),
		'lastfm' => array('name' => 'Last.fm', 'fc' => true, 'fa' => true),
		'xing' => array('name' => 'Xing', 'fc' => true, 'fa' => true),
		'stackoverflow' => array('name' => 'StackOverflow', 'fc' => true, 'fa' => true, 'fa_class' => 'stack-overflow'),
		'dropbox' => array('name' => 'Dropbox', 'fc' => true, 'fa' => true),
		'dribbble' => array('name' => 'Dribbble', 'fc' => true, 'fa' => true),
		'tumblr' => array('name' => 'Tumblr', 'fc' => true, 'fa' => true),
		'foursquare' => array('name' => 'FourSquare', 'fc' => true, 'fa' => true),
		'github' => array('name' => 'GitHub', 'fc' => true, 'fa' => true, 'fa_class' => 'github-alt'),
		'apple' => array('name' => 'Apple', 'fc' => true, 'fa' => true),
		'android' => array('name' => 'Android', 'fc' => true, 'fa' => true),
		'instagram' => array('name' => 'Instagram', 'fc' => true, 'fa' => true),
		'linux' => array('name' => 'Linux', 'fc' => false, 'fa' => true),
		'windows' => array('name' => 'Windows', 'fc' => true, 'fa' => true),
		'bitcoin' => array('name' => 'BitCoin', 'fc' => false, 'fa' => true),
		'steam' => array('name' => 'Steam', 'fc' => false, 'fa' => true),
		'deviantart' => array('name' => 'DeviantArt', 'fc' => false, 'fa' => true)
	);

	return $socials;
}
endif;

if (!function_exists('react_get_texture_detail_css')) :
/**
 * Returns the CSS for the texture, detail and custom image
 *
 * This is used by per-page CSS, custom-css.php and the Block shortcode
 *
 * @param   array         $options        The array of options
 * @param   array|string  $selectors      The array of selectors (string will be casted to array):
 *                                        [0]: selector of the element to apply the texture to (required)
 *                                        [1]: selector of the child element to apply the detail to
 *                                        [2]: selector after $selector but before $childSelector (if any)
 * @return  string                        The CSS
 */
function react_get_texture_detail_css($options, $selectors)
{
	global $react;

	if (!is_array($selectors)) {
		$selectors = array($selectors);
	}

	$selector = isset($selectors[0]) ? $selectors[0] : 'body';
	$childSelector = isset($selectors[1]) ? $selectors[1] : '> div';
	$subSelector = isset($selectors[2]) ? $selectors[2] : '';
	$url = react_url();
	$output = '';
	$options['texture'] = isset($options['texture']) && $options['texture'] ? $options['texture'] : 'none';
	$options['detail'] = isset($options['detail']) && $options['detail'] ? $options['detail'] : 'none';
	$options['image'] = isset($options['image']) ? $options['image'] : '';
	$options['texture_fixed'] = isset($options['texture_fixed']) ? $options['texture_fixed'] : false;
	$nl = "\n";

	if ($options['texture'] != 'none') {
		$textureSize = react_get_texture_detail_size($options['texture']);
		$output .= $selector . '.' . sanitize_key($options['texture']) . ($subSelector ? ' ' . $subSelector : '') . ($options['image'] ? ' ' . $childSelector : '') . ' {
	background-image: url(' . esc_url($url . '/images/backgrounds/overlays/' .  absint($options['texture_opacity']) . '/' . sanitize_key($options['texture']) . ($options['texture_large'] ? '@2x' : '') . '.png') . ');
	background-repeat: repeat;' . ($options['texture_fixed'] ? $nl . '    background-attachment: fixed; position: static; ' : '') . '
}' . $nl;
		if (!$options['texture_large']) {
			$output .= '@media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi), (min-resolution: 1.5dppx) {
	' . $selector . '.' . sanitize_key($options['texture']) . ($subSelector ? ' ' . $subSelector : '') . ($options['image'] ? ' ' . $childSelector : '') . ' {
		background-image: url(' . esc_url($url . '/images/backgrounds/overlays/' . absint($options['texture_opacity']) . '/' . sanitize_key($options['texture']) . '@2x.png') . ');
		background-size: ' . absint($textureSize['w']) . 'px ' . absint($textureSize['h']) . 'px;
	}
}' . $nl;
		}
	}

	if ($options['detail'] != 'none' && strpos($options['detail'], 'edge') === false && !($options['image'] && $options['texture'] != 'none')) {
		$detailSize = react_get_texture_detail_size($options['detail']);
		$output .= $selector . '.' . sanitize_key($options['detail']) . '-' . absint($options['detail_opacity']) . ' ' . $childSelector . ' {
	background-image: url(' . $url . '/images/backgrounds/detail/' .  absint($options['detail_opacity']) . '/' . sanitize_key($options['detail']) . '.png);';

		if (strpos($options['detail'], 'bottom') !== false) {
			$output .= $nl . '    background-position: bottom center;';
		} else {
			$output .= $nl . '    background-position: top center;';
		}

		if (strpos($options['detail'], 'shadow') !== false) {
			$output .= $nl . '    background-size: 100% auto;';
		}

		$output .= $nl . '    background-repeat: repeat-x;
}
@media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi), (min-resolution: 1.5dppx) {
	' . $selector . '.' . sanitize_key($options['detail']) . '-' . absint($options['detail_opacity']) . ' ' . $childSelector . ' { ';

		if (strpos($options['detail'], 'shadow') !== false) {
			$output .= $nl . '    background-image: url(' . esc_url($url . '/images/backgrounds/detail/' .  absint($options['detail_opacity']) . '/' . sanitize_key($options['detail']) . '.png') . ');';
			$output .= $nl . '    background-size: 100% auto;';
		} else {
			$output .= $nl . '    background-image: url(' . esc_url($url . '/images/backgrounds/detail/' .  absint($options['detail_opacity']) . '/' . sanitize_key($options['detail']) . '@2x.png') . ');';
			$output .= $nl . '    background-size: ' . absint($detailSize['w']) . 'px ' . absint($detailSize['h']) . 'px;';
		}
	$output .= '
	}
}' . $nl;
	}

	if ($options['image']) {
		$output .= $selector . ' {' . $nl;
		$output .= '    background-image: url(' . esc_url($options['image']) . ');' . $nl;
		$output .= '    background-repeat: ' . sanitize_key($options['image_repeat']) . ';' . $nl;
		$output .= '    background-position: ' . ($options['image_position'] === 'custom' ? sanitize_text_field($options['image_position_custom']) : sanitize_text_field($options['image_position'])) . ';' . $nl;
		if ($options['image_fixed']) {
			$output .= '    background-attachment: fixed; position: static;' . $nl;
		}
		if ($options['image_background_size'] !='') {
			$output .= '    background-size: ' . sanitize_text_field($options['image_background_size']) . ';' . $nl;
		}
		$output .= '}' . $nl;

		if ($options['image_retina_use_main_img'] == 'use-main-img' || $options['image_retina_use_main_img'] == 'change-position' || $options['image_retina_use_main_img'] == 'no-image' || ($options['image_retina_use_main_img'] == 'use-new-img' && $options['image_retina'])) {
			if ($options['image_convert'] == 'box-width') {
				$boxWidth = max(($react['options']['page_layout_max_width'] + $react['options']['page_layout_left_margin_tablets'] + $react['options']['page_layout_right_margin_tablets']), ($react['options']['break_point_tablet_ldsp'] + $react['options']['page_layout_left_margin_tablets'] + $react['options']['page_layout_right_margin_tablets']));

				$output .= '@media only screen and (max-width: ' . absint($boxWidth) . 'px) {';
			}
			elseif ($options['image_convert'] == 'phone-ptr') {
				$output .= '@media only screen and (max-width:' . absint($react['options']['break_point_phone_ptr']) . 'px) {';
			}
			elseif ($options['image_convert'] == 'phone-ldsp') {
				$output .= '@media only screen and (max-width:' . absint($react['options']['break_point_phone_ldsp']) . 'px) {';
			}
			elseif ($options['image_convert'] == 'tablet-ptr') {
				$output .= '@media only screen and (max-width: ' . absint($react['options']['break_point_tablet_ptr']) . 'px) {';
			}
			elseif ($options['image_convert'] == 'tablet-ldsp') {
				$output .= '@media only screen and (max-width: ' . absint($react['options']['break_point_tablet_ldsp']) . 'px) {';
			}
			elseif ($options['image_convert'] == 'custom') {
				$output .= '@media only screen and (max-width: ' . absint($options['image_convert_custom']) . 'px) {';
			}
			elseif ($options['image_convert'] == 'only-retina-devices') {
				$output .= '@media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi), (min-resolution: 1.5dppx) {';
			}

			$retinaImageUrl = react_get_upload_url($options['image_retina']);
			$output .= $nl . '    ' . $selector . ' {' . $nl;

			if ($options['image_retina_use_main_img'] == 'use-main-img') {
				$output .= '        background-image: url(' . esc_url($options['image']) . ');' . $nl;
				if ($options['image_repeat_retina'] !== $options['image_repeat']) {
					$output .= '    background-repeat: ' . sanitize_key($options['image_repeat_retina']) . ';' . $nl;
				}
				if ($options['image_position_retina'] !== $options['image_position'] || $options['image_position_retina'] === 'custom') {
					$output .= '    background-position: ' . ($options['image_position_retina'] === 'custom' ? sanitize_text_field($options['image_position_custom_retina']) : sanitize_text_field($options['image_position_retina'])) . ';' . $nl;
				}
				if ($options['image_fixed_retina']) {
					$output .= '    background-attachment: fixed; position: static; ' . $nl;
				}
				if ($options['image_background_size_retina'] != '') {
					$output .= '    background-size: ' . sanitize_text_field($options['image_background_size_retina']) . ';' . $nl;
				} else {
					$output .= '        background-size: ' . (absint($options['image_width']) / 2) . 'px ' . (absint($options['image_height']) / 2) . 'px;' . $nl;
				}
			}
			elseif (($options['image_retina_use_main_img'] == 'use-new-img') && $options['image_retina'] && $options['image_is_retina']) {
				$output .= '        background-image: url(' . esc_url($retinaImageUrl) . ');' . $nl;
				$output .= '        background-size: ' . (absint($options['image_retina_width']) / 2) . 'px ' . (absint($options['image_retina_height']) / 2) . 'px;' . $nl;
				if ($options['image_repeat_retina'] !== $options['image_repeat']) {
					$output .= '        background-repeat: ' . sanitize_key($options['image_repeat_retina']) . ';' . $nl;
				}
				if ($options['image_position_retina'] !== $options['image_position'] || $options['image_position_retina'] === 'custom') {
					$output .= '        background-position: ' . ($options['image_position_retina'] === 'custom' ? sanitize_text_field($options['image_position_custom_retina']) : sanitize_text_field($options['image_position_retina'])) . ';' . $nl;
				}
				if ($options['image_fixed_retina']) {
					$output .= '        background-attachment: fixed; position: static; ' . $nl;
				} else {
					$output .= '        background-attachment: scroll;' . $nl;
				}
				if ($options['image_background_size_retina'] !='') {
					$output .= '    background-size: ' . sanitize_text_field($options['image_background_size_retina']) . ';' . $nl;
				}
			}
			elseif (($options['image_retina_use_main_img'] == 'use-new-img') && $options['image_retina'] && !$options['image_is_retina']) {
				$output .= '        background-image: url(' . esc_url($retinaImageUrl) . ');' . $nl;
				$output .= '        background-size: ' . absint($options['image_retina_width']) . 'px ' . absint($options['image_retina_height']) . 'px;' . $nl;
				if ($options['image_repeat_retina'] !== $options['image_repeat']) {
					$output .= '        background-repeat: ' . sanitize_key($options['image_repeat_retina']) . ';' . $nl;
				}
				if ($options['image_position_retina'] !== $options['image_position'] || $options['image_position_retina'] === 'custom') {
					$output .= '        background-position: ' . ($options['image_position_retina'] === 'custom' ? sanitize_text_field($options['image_position_custom_retina']) : sanitize_text_field($options['image_position_retina'])) . ';' . $nl;
				}
				if ($options['image_fixed_retina']) {
					$output .= '        background-attachment: fixed; position: static; ' . $nl;
				} else {
					$output .= '        background-attachment: scroll;' . $nl;
				}
				if ($options['image_background_size_retina'] !='') {
					$output .= '    background-size: ' . sanitize_text_field($options['image_background_size_retina']) . ';' . $nl;
				}
			}
			elseif ($options['image_retina_use_main_img'] == 'change-position') {
				if ($options['image_repeat_retina'] !== $options['image_repeat']) {
					$output .= '        background-repeat: ' . sanitize_key($options['image_repeat_retina']) . ';' . $nl;
				}
				if ($options['image_position_retina'] !== $options['image_position'] || $options['image_position_retina'] === 'custom') {
					$output .= '        background-position: ' . ($options['image_position_retina'] === 'custom' ? sanitize_text_field($options['image_position_custom_retina']) : sanitize_text_field($options['image_position_retina'])) . ';' . $nl;
				}
				if ($options['image_fixed_retina']) {
					$output .= '        background-attachment: fixed; position: static; ' . $nl;
				} else {
					$output .= '        background-attachment: scroll;' . $nl;
				}
				if ($options['image_background_size_retina'] !='') {
					$output .= '    background-size: ' . sanitize_text_field($options['image_background_size_retina']) . ';' . $nl;
				}
			}
			elseif ($options['image_retina_use_main_img'] == 'no-image') {
				$output .= '        background-image: none;' . $nl;
			}

			$output .= '    }' . $nl . '}' . $nl;
		}
	}

	return $output;
}
endif;

if (!function_exists('react_get_custom_css_filename')) :
/**
 * Get the file name of the custom CSS file
 *
 * @return  string
 */
function react_get_custom_css_filename()
{
	return is_multisite() ? 'custom.' . get_current_blog_id() . '.css' : 'custom.css';
}
endif;

if (!function_exists('react_get_animate_css_filename')) :
/**
 * Get the file name of the custom CSS file
 *
 * @return  string
 */
function react_get_animate_css_filename()
{
	return is_multisite() ? 'animate.' . get_current_blog_id() . '.css' : 'animate.css';
}
endif;

if (!function_exists('react_get_palette_css_filename')) :
/**
 * Get the file name of the palette CSS file
 *
 * @param   int     $index  The chunk index, increments every 10 palettes
 * @return  string
 */
function react_get_palette_css_filename($index)
{
	return is_multisite() ? 'palettes.' . get_current_blog_id() . '.' . $index . '.css' : 'palettes.' . $index . '.css';
}
endif;

if (!function_exists('react_get_woocommerce_css_filename')) :
/**
 * Get the file name of the custom CSS file
 *
 * @return  string
 */
function react_get_woocommerce_css_filename()
{
	return is_multisite() ? 'woocommerce.' . get_current_blog_id() . '.css' : 'woocommerce.css';
}
endif;

if (!function_exists('react_admin_bar_render')) :
/**
 * Add Theme Options link to admin bar
 */
function react_admin_bar_render()
{
	if (!current_user_can('edit_theme_options')) {
		return;
	}

	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
		'parent' => false,
		'id' => 'react',
		'title' => esc_html__('Theme Options', 'react'),
		'href' => admin_url('themes.php?page=react')
	));
}
endif;
add_action('wp_before_admin_bar_render', 'react_admin_bar_render');

if (!function_exists('react_get_animation_class')) :
/**
 * Get the class using the given animation
 *
 * @param   string  $animation  The name of the animation
 * @return  string              The classes
 */
function react_get_animation_class($animation)
{
	$classes = array('has-animation');

	if (stripos($animation, 'out') !== false) {
		$classes[] = 'has-out-animation';
	}

	return join(' ', $classes);
}
endif;

if (!function_exists('react_get_animation_data')) :
/**
 * Get the data attributes for using the given animation
 *
 * @param   string  $animation        The name of the animation
 * @param   int     $animationDelay   The animation delay in ms
 * @param   int     $animationOffset  The animation offset in px
 * @return  string                    The data attributes
 */
function react_get_animation_data($animation, $animationDelay = 0, $animationOffset = 0)
{
	$data = array('data-animation="' . esc_attr($animation) . '"');

	if (is_numeric($animationDelay) && $animationDelay > 0) {
		$data[] = 'data-animation-delay="' . intval($animationDelay). '"';
	}

	if (is_numeric($animationOffset) && $animationOffset <> 0) {
		$data[] = 'data-animation-offset="' . intval($animationOffset ). '"';
	}

	return join(' ', $data);
}
endif;

if (!function_exists('react_get_vertical_space_css')) :
/**
 * Get the CSS for the top/bottom vertical space
 *
 * @param   string  $key       The part of the key within the options key
 * @param   string  $property  The CSS property to set
 * @param   string  $selector  The selector to apply to
 * @param   int     $extra     Extra amount to add to the property value
 * @return  string             The CSS
 */
function react_get_vertical_space_css($key, $property, $selector, $extra = -1)
{
	global $react;
	$output = '';
	$nl = "\n";

	// Default/desktop
	$choose = react_get_current_post_meta('page_layout_' . $key . '_margin_choose');
	if ($choose == 'custom') {
		$value = react_get_current_post_meta('page_layout_' . $key . '_margin');
	} elseif ($choose == 'screen' || $react['options']['page_layout_' . $key . '_margin_choose'] == 'screen') {
		$value = 1200; // Place it off the screen, the JS will set it to the correct position
	} else {
		$value = $react['options']['page_layout_' . $key . '_margin'];
	}
	if (isset($value) && is_numeric($value) && $value > 0) {
		$value = $extra > 0 ? $value + $extra : $value;
		//add fix for fixed header
		if ($react['options']['main_header_fixed'] == '1') {
			$output .= '@media only screen and (min-width: ' . absint($react['options']['break_point_desktop']) . 'px) {' . $nl;
			$output .= '    ' . $selector . ' { ' . $property . ': ' . absint($value) . 'px; }' . $nl;
			$output .= '}' . $nl;
		} else {
			$output .= $selector . ' { ' . $property . ': ' . absint($value) . 'px; }' . $nl;
		}

	}

	// Phone
	$phoneChoose = react_get_current_post_meta('page_layout_' . $key . '_margin_phones_choose');
	if ($phoneChoose == 'custom') {
		$phoneValue = react_get_current_post_meta('page_layout_' . $key . '_margin_phones');
	} elseif ($phoneChoose == 'screen' || $react['options']['page_layout_' . $key . '_margin_phones_choose'] == 'screen') {
		$phoneValue = 1200; // Place it off the screen, the JS will set it to the correct position
	} else {
		$phoneValue = $react['options']['page_layout_' . $key . '_margin_phones'];
	}
	if (isset($phoneValue) && is_numeric($phoneValue) && $phoneValue > 0) {
		$phoneValue = $extra > 0 ? $phoneValue + $extra : $phoneValue;
		$output .= '@media only screen and (max-width: ' . absint($react['options']['break_point_phone_ldsp']) . 'px) {' . $nl;
		$output .= '    ' . $selector . ' { ' . $property . ': ' . absint($phoneValue) . 'px; }' . $nl;
		$output .= '}' . $nl;
	}

	// Tablet
	$tabletChoose = react_get_current_post_meta('page_layout_' . $key . '_margin_tablets_choose');
	if ($tabletChoose == 'custom') {
		$tabletValue = react_get_current_post_meta('page_layout_' . $key . '_margin_tablets');
	} elseif ($tabletChoose == 'screen' || $react['options']['page_layout_' . $key . '_margin_tablets_choose'] == 'screen') {
		$tabletValue = 1200; // Place it off the screen, the JS will set it to the correct position
	} else {
		$tabletValue = $react['options']['page_layout_' . $key . '_margin_tablets'];
	}
	if (isset($tabletValue) && is_numeric($tabletValue) && $tabletValue > 0) {
		$tabletValue = $extra > 0 ? $tabletValue + $extra : $tabletValue;
		$output .= '@media only screen and (max-width: ' . absint($react['options']['break_point_tablet_ldsp']) . 'px) {' . $nl;
		$output .= '    ' . $selector . ' { ' . $property . ': ' . absint($tabletValue) . 'px; }' . $nl;
		$output .= '}' . $nl;
	}

	// Large screen
	$tvChoose = react_get_current_post_meta('page_layout_' . $key . '_margin_tv_choose');
	if ($tvChoose == 'custom') {
		$tvValue = react_get_current_post_meta('page_layout_' . $key . '_margin_tv');
	} elseif ($tvChoose == 'screen' || $react['options']['page_layout_' . $key . '_margin_tv_choose'] == 'screen') {
		$tvValue = 1200; // Place it off the screen, the JS will set it to the correct position
	} else {
		$tvValue = $react['options']['page_layout_' . $key . '_margin_tv'];
	}
	if (isset($tvValue) && is_numeric($tvValue) && $tvValue > 0) {
		$tvValue = $extra > 0 ? $tvValue + $extra : $tvValue;
		$output .= '@media only screen and (min-width: ' . absint($react['options']['break_point_tv']) . 'px) {' . $nl;
		$output .= '    ' . $selector . ' { ' . $property . ': ' . absint($tvValue) . 'px; }' . $nl;
		$output .= '}' . $nl;
	}

	return $output;
}
endif;

/**
 * Get the URL to the WP uploads directory
 *
 * @param   string  $path  Optional path to be joined after the URL
 * @return  string
 */
function react_uploads_url($path = '')
{
	$uploads = wp_upload_dir();
	$url = $uploads['baseurl'];

	if ($path && is_string($path)) {
		$url .= '/' . ltrim($path, '/');
	}

	return $url;
}

/**
 * Get the full URL of an uploaded file
 *
 * If the path starts with http(s):// or //, it will be returned
 * If the path starts with / the site URL will be prepended
 * If the path is relative, the WP uploads URL will be prepended
 *
 * @param   string  The current URL
 * @return  string  The absolute URL
 */
function react_get_upload_url($url)
{
	if (!is_string($url)) {
		return '';
	}

	$url = trim($url);

	if ($url === '') {
		return '';
	}

	if (react_is_absolute_url($url)) {
		return $url;
	}

	if (react_is_absolute_path($url)) {
		return site_url($url);
	}

	return react_uploads_url($url);
}

/**
 * Returns true if the given URL is an absolute URL including scheme and domain, false otherwise
 *
 * @param   string   $url
 * @return  boolean
 */
function react_is_absolute_url($url)
{
	return preg_match('#^(http(s)?://|//)#i', $url);
}

/**
 * Returns true if the given URL is an absolute path excluding scheme and domain, false otherwise
 *
 * @param   string   $url
 * @return  boolean
 */
function react_is_absolute_path($url)
{
	return !react_is_absolute_url($url) && substr($url, 0, 1) === '/';
}

/**
 * Get the @media for the given convert options
 *
 * @param   string  $convert  The chosen convert option
 * @param   string  $custom  The "custom" value
 * @return  string           The @media query
 */
function react_get_convert_media_query($convert, $custom, $width = 'min-width')
{
	global $react;

	$boxWidth = max(($react['options']['page_layout_max_width'] + $react['options']['page_layout_left_margin_tablets'] + $react['options']['page_layout_right_margin_tablets']), ($react['options']['break_point_tablet_ldsp'] + $react['options']['page_layout_left_margin_tablets'] + $react['options']['page_layout_right_margin_tablets']));

	if ($convert == 'box-width') {
		$query = '@media only screen and (' . sanitize_key($width) . ': ' . absint($boxWidth) . 'px) {';
	}
	elseif ($convert == 'phone-ptr') {
		$query = '@media only screen and (' . sanitize_key($width) . ':' . absint($react['options']['break_point_phone_ptr']) . 'px) {';
	}
	elseif ($convert == 'phone-ldsp') {
		$query = '@media only screen and (' . sanitize_key($width) . ':' . absint($react['options']['break_point_phone_ldsp']) . 'px) {';
	}
	elseif ($convert == 'tablet-ptr') {
		$query = '@media only screen and (' . sanitize_key($width) . ': ' . absint($react['options']['break_point_tablet_ptr']) . 'px) {';
	}
	elseif ($convert == 'tablet-ldsp') {
		$query = '@media only screen and (' . sanitize_key($width) . ': ' . absint($react['options']['break_point_tablet_ldsp']) . 'px) {';
	}
	elseif ($convert == 'custom') {
		$query = '@media only screen and (' . sanitize_key($width) . ': ' . absint($custom) . 'px) {';
	}
	else {
		// This is just a fallback to make sure brackets aren't mismatched
		$query = '@media only screen {';
	}

	return $query;
}

// Load the WooCommerce functions only if it's active
if (function_exists('is_woocommerce')) {
	require_once REACT_INCLUDES_DIR . '/woocommerce.php';
}

if (is_admin() || REACT_TESTING) {
	// Load the admin (backend) functions
	require_once REACT_ADMIN_DIR . '/admin.php';
} else {
	// Load the theme (frontend) functions
	require_once REACT_INCLUDES_DIR . '/theme.php';
}
