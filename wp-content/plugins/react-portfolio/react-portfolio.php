<?php
/*
 * Plugin Name: React Portfolio
 * Plugin URI: http://www.themecatcher.net
 * Description: Easily create portfolio items and display them on your site.
 * Version: 1.0.6
 * Author: ThemeCatcher
 * Author URI: http://www.themecatcher.net
 * Text Domain: react-portfolio
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

define('TCP_PLUGIN_VERSION', '1.0.6');
define('TCP_PLUGIN_FILE', __FILE__);
define('TCP_PLUGIN_DIR', dirname(TCP_PLUGIN_FILE));
define('TCP_INCLUDES_DIR', TCP_PLUGIN_DIR . '/includes');
define('TCP_ADMIN_DIR', TCP_PLUGIN_DIR . '/admin');
define('TCP_ADMIN_INCLUDES_DIR', TCP_ADMIN_DIR . '/includes');
define('TCP_OPTIONS_KEY', 'react-portfolio');

tcp_load_options();

/**
 * Load the current plugin options
 */
function tcp_load_options()
{
	global $tcp;
	$tcp['options'] = tcp_get_options();
}

/**
 * Get the plugin options
 *
 * @return array
 */
function tcp_get_options()
{
	$options = get_option(TCP_OPTIONS_KEY);
	$options = is_array($options) ? $options : array();

	return array_merge(tcp_get_default_options(), $options);
}

/**
 * Get the default plugin options
 *
 * @return array
 */
function tcp_get_default_options()
{
	return array(
		// General settings
		'search' => true,
		'comments' => false,
		'rewrite_slug' => 'portfolio',
		'category_rewrite_slug' => 'portfolio-category',
		'tag_rewrite_slug' => 'portfolio-tag',

		// Fancybox settings
		'video_width' => 640,
		'video_height' => 360,

		// Serene settings
		'speed' => 2000,
		'transition' => 'fade',
		'fit_landscape' => false,
		'fit_portrait' => true,
		'fit_always' => false,
		'position_x' => 'center',
		'position_y' => 'center',
		'easing' => 'swing',
		'control_speed' => 500,
		'slideshow' => true,
		'slideshow_auto' => true,
		'slideshow_speed' => 7000,
		'keyboard' => true,
		'caption_position' => 'center bottom',
		'caption_speed' => 600,
		'bullets' => true,
		'low_quality' => false,

		// Performance options
		'load_scripts' => 'always',
		'load_scripts_custom' => array(),

		// Disable script output
		'disabled_styles' => array(),
		'disabled_scripts' => array()
	);
}

/**
 * Get a plugin option
 *
 * @param   string  $key      The key within the options array
 * @param   mixed   $default  The default value if the key is not found
 * @return  mixed
 */
function tcp_get_option($key, $default = null)
{
	global $tcp;

	if (array_key_exists($key, $tcp['options'])) {
		return $tcp['options'][$key];
	}

	return $default;
}

/**
 * Get the URL of the plugin directory
 *
 * @param   string  $path  Extra path to append to the URL
 * @return  string
 */
function tcp_url($path = '')
{
	return plugins_url($path, TCP_PLUGIN_FILE);
}

/**
 * Sanitize multiple classes
 *
 * @param   string|array  $classes  Classes to sanitize
 * @return  string                  The sanitized classes
 */
function tcp_sanitize_class($classes)
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
 * Logging function
 *
 * Logs each argument as an entry in the error log
 */
function tcp_log()
{
	foreach (func_get_args() as $arg) {
		ob_start();
		var_dump($arg);
		error_log(ob_get_clean());
	}
}

/**
 * Load the plugin translations
 */
function tcp_load_textdomain()
{
	load_plugin_textdomain('react-portfolio', false, plugin_basename(dirname(TCP_PLUGIN_FILE)) . '/languages');
}
add_action('plugins_loaded', 'tcp_load_textdomain');

/**
 * Get the URL to the WP uploads directory
 *
 * @param   string  $path  Optional path to be joined after the URL
 * @return  string
 */
function tcp_uploads_url($path = '')
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
function tcp_get_upload_url($url)
{
	if (!is_string($url)) {
		return '';
	}

	$url = trim($url);

	if ($url === '') {
		return '';
	}

	if (tcp_is_absolute_url($url)) {
		return $url;
	}

	if (tcp_is_absolute_path($url)) {
		return site_url($url);
	}

	return tcp_uploads_url($url);
}

/**
 * Returns true if the given URL is an absolute URL including scheme and domain, false otherwise
 *
 * @param   string   $url
 * @return  boolean
 */
function tcp_is_absolute_url($url)
{
	return preg_match('#^(http(s)?://|//)#i', $url);
}

/**
 * Returns true if the given URL is an absolute path excluding scheme and domain, false otherwise
 *
 * @param   string   $url
 * @return  boolean
 */
function tcp_is_absolute_path($url)
{
	return !tcp_is_absolute_url($url) && substr($url, 0, 1) === '/';
}

/**
 * Helper function for CSS unit values
 *
 * If the give value is numeric and not zero, "px" will be appended
 *
 * @param   string  $value  Any valid CSS unit value
 * @return  string
 */
function tcp_get_css_value($value)
{
	if (is_numeric($value) && $value !== '0') {
		$value .= 'px';
	}

	return $value;
}

/**
 * Get the prefixed hide classes
 *
 * @param   string  $hide  The hide classes comma separated
 * @return  string
 */
function tcp_get_hide_class($hide)
{
	return tcp_prefix_classes(str_replace(',', ' ', $hide));
}

/**
 * Add the tcp- prefix to every class in the given class string
 *
 * @param   string  $classes  A space separated list of classes
 * @return  string            The space separated list of classes with the tcp- prefix
 */
function tcp_prefix_classes($classes)
{
	$classes = preg_split('/\s+/', trim($classes));

	foreach($classes as $k => $class) {
		$classes[$k] = 'tcp-' . $class;
	}

	return join(' ', $classes);
}

/**
 * Determine whether the JS/CSS should be enqueued based on the performance options
 */
function tcp_enqueue()
{
	$loadScripts = true;

	if (tcp_get_option('load_scripts') == 'autodetect') {
		if ( ! tcp_detect_shortcode() && ! tcp_detect_widget()) {
			$loadScripts = false;
		}
	} else if (tcp_get_option('load_scripts') == 'custom') {
		if (count(tcp_get_option('load_scripts_custom')) && ! in_array(get_queried_object_id(), tcp_get_option('load_scripts_custom'))) {
			$loadScripts = false;
		}
	}

	if ($loadScripts) {
		tcp_enqueue_styles();
		tcp_enqueue_scripts();
	}
}
add_action('wp_enqueue_scripts', 'tcp_enqueue');

/**
* Check if the page content has the shortcode
*
* @return bool
*/
function tcp_detect_shortcode()
{
	global $post;

	if ($post instanceof WP_Post && has_shortcode($post->post_content, 'portfolio')) {
		return true;
	}

	return false;
}

/**
* Check if there is an active porfolio widget on the page
*
* @return bool
*/
function tcp_detect_widget()
{
	return is_active_widget(false, false, 'tcap-widget-portfolio') !== false;
}

/**
 * Get the stylesheets used by the plugin
 *
 * Used to enqueue stylesheets and disable them in the settings
 *
 * @return array
 */
function tcp_get_styles()
{
	return array(
		'fancybox2' => array( // http://fancyapps.com/fancybox/
			'name' => 'Fancybox',
			'tooltip' => sprintf(esc_html__('Used by the %s option to show the image in a lightbox popup', 'react-portfolio'), 'type="lightbox"'),
			'url' => tcp_url('js/fancybox2/jquery.fancybox.min.css'),
			'deps' => array(),
			'version' => '2.1.5'
		),
		'serene' => array( // http://www.themecatcher.net
			'name' => 'Serene',
			'tooltip' => sprintf(esc_html__('Used by the %s option to show the image in a full screen lightbox', 'react-portfolio'), 'type="serene"'),
			'url' => tcp_url('js/serene/css/serene.css'),
			'deps' => array(),
			'version' => '2.0.6'
		)
	);
}

/**
 * Enqueue the CSS
 */
function tcp_enqueue_styles()
{
	foreach (tcp_get_styles() as $key => $style) {
		if (in_array($key, tcp_get_option('disabled_styles'))) {
			continue;
		}

		wp_enqueue_style($key, $style['url'], $style['deps'], $style['version']);
	}

	wp_enqueue_style('tcp-styles', tcp_url('css/styles.css'), array(), TCP_PLUGIN_VERSION);
}

/**
 * Get the scripts used by the plugin
 *
 * Used to enqueue scripts and disable them in the settings
 *
 * @return array
 */
function tcp_get_scripts()
{
	return array(
		'isotope' => array( // https://github.com/metafizzy/isotope/
			'name' => 'Isotope',
			'tooltip' => esc_html__('Used to create a masonry layout', 'react-portfolio'),
			'url' => tcp_url('js/isotope.pkgd.min.js'),
			'deps' => array('jquery'),
			'version' => '2.2.0',
			'footer' => true
		),
		'fancybox2' => array( // http://fancyapps.com/fancybox/
			'name' => 'Fancybox',
			'tooltip' => sprintf(esc_html__('Used by the %s option to show the image in a lightbox popup', 'react-portfolio'), 'type="lightbox"'),
			'url' => tcp_url('js/fancybox2/jquery.fancybox.pack.js'),
			'deps' => array('jquery'),
			'version' => '2.1.5',
			'footer' => true
		),
		'jquery-easing' => array( // http://gsgd.co.uk/sandbox/jquery/easing/
			'name' => 'jQuery Easing',
			'tooltip' => esc_html__('Used by the Serene script to add easing to jQuery animations', 'react-portfolio'),
			'url' => tcp_url('js/jquery.easing.min.js'),
			'deps' => array('jquery'),
			'version' => '1.3',
			'footer' => true
		),
		'serene' => array( // http://www.themecatcher.net
			'name' => 'Serene',
			'tooltip' => sprintf(esc_html__('Used by the %s option to show the image in a full screen lightbox', 'react-portfolio'), 'type="serene"'),
			'url' => tcp_url('js/serene/jquery.serene.js'),
			'deps' => array('jquery'),
			'version' => '2.0.6',
			'footer' => true
		)
	);
}

/**
 * Enqueue the JavaScript
 */
function tcp_enqueue_scripts()
{
	foreach (tcp_get_scripts() as $key => $script) {
		if (in_array($key, tcp_get_option('disabled_scripts'))) {
			continue;
		}

		wp_enqueue_script($key, $script['url'], $script['deps'], $script['version'], $script['footer']);
	}

	wp_enqueue_script('tcp-scripts', tcp_url('js/scripts.js'), array('jquery'), TCP_PLUGIN_VERSION, true);

	wp_localize_script('tcp-scripts', 'tcpL10n', array(
		'sereneOptions' => array(
			'speed' => tcp_get_option('speed'),
			'transition' => tcp_get_option('transition'),
			'fitLandscape' => tcp_get_option('fit_landscape'),
			'fitPortrait' => tcp_get_option('fit_portrait'),
			'fitAlways' => tcp_get_option('fit_always'),
			'positionX' => tcp_get_option('position_x'),
			'positionY' => tcp_get_option('position_y'),
			'easing' => tcp_get_option('easing'),
			'controlSpeed' => tcp_get_option('control_speed'),
			'slideshow' => tcp_get_option('slideshow'),
			'slideshowAuto' => tcp_get_option('slideshow_auto'),
			'slideshowSpeed' => tcp_get_option('slideshow_speed'),
			'keyboard' => tcp_get_option('keyboard'),
			'captionPosition' => tcp_get_option('caption_position'),
			'captionSpeed' => tcp_get_option('caption_speed'),
			'bullets' => tcp_get_option('bullets'),
			'lowQuality' => tcp_get_option('low_quality'),
			'errorBackground' => tcp_url('images/backgrounds/error.jpg')
		)
	));
}

/**
 * Get the gap for the given number of columns
 *
 * @param   int  $columns  The number of columns 1-10
 * @return  int            The gap amount
 */
function tcp_gap_from_columns($columns)
{
	if ($columns < 3) {
		$amount = 10;
	} elseif ($columns < 7) {
		$amount = 8;
	} elseif ($columns < 9) {
		$amount = 6;
	} else {
		$amount = 5;
	}

	return $amount;
}

/**
 * Get the margin-bottom for portfolio/blog SC for the given number of columns
 *
 * @param   int  $columns  The number of columns 1-10
 * @return  int            The margin-bottom amount
 */
function tcp_margin_bottom_from_columns($columns)
{
	if ($columns < 3) {
		$amount = 20;
	} elseif ($columns < 7) {
		$amount = 16;
	} elseif ($columns < 9) {
		$amount = 12;
	} else {
		$amount = 10;
	}

	return $amount;
}

/**
 * Get hover icon size for the given number of columns
 *
 * @param   int  $columns  The number of columns 1-10
 * @return  int            The gap amount
 */
function tcp_hover_from_columns($columns)
{
	if ($columns < 3) {
		$hover = 'med-hvr';
	} elseif ($columns < 7) {
		$hover = 'sml-hvr';
	} else {
		$hover = 'tiny-hvr';
	}

	return $hover;
}

/**
 * Get the image size array for portfolio/blog shortcode
 *
 * @param   int     $columns  The number of columns
 * @return  array
 */
function tcp_get_image_size_for_columns($columns)
{
	global $content_width;
	$contentWidth = $content_width;

	// Ensure the content width is a sane value but don't mess with the global
	if (!is_numeric($contentWidth) || $contentWidth < 1024) {
		$contentWidth = 1024;
	}

	// Sanitise columns
	if ($columns < 1) {
		$columns = 1;
	} else if ($columns > 10) {
		$columns = 10;
	}

	$size = round($contentWidth / $columns);

	// For responsive portfolio columns we need each image to be at least 1024px wide
	$size = max($size, 1024);

	return $size;
}

/**
 * Get the post meta value with the given key or the default if the value is empty or is equal to the last parameter
 *
 * @param   int     $postId                The ID of the post
 * @param   string  $key                   The meta key
 * @param   mixed   $default               Default value to return
 * @param   mixed   $returnDefaultIfValue  Return the default if value is this value, can be array
 * @return  mixed
 */
function tcp_get_post_meta($postId, $key, $default = '', $returnDefaultIfValue = null)
{
	$value = get_post_meta($postId, '_tcp_' . $key, true);

	if ($value === '' || $value === false || ($returnDefaultIfValue !== null && in_array($value, (array) $returnDefaultIfValue, true))) {
		return $default;
	}

	return $value;
}

/**
 * Get the URL for an attachment image
 *
 * @param   int     $attachmentId
 * @param   string  $size
 * @return  string
 */
function tcp_get_attachment_image_src($attachmentId, $size = 'full')
{
	$src = wp_get_attachment_image_src($attachmentId, $size);

	return $src[0];
}

/**
 * Get the HTML for the featured image
 *
 * @param   string      $type     The image position, one of: left,above,below,right
 * @param   int|string  $width    Current page layout or the image width
 * @param   int         $height   The image height
 * @param   array       $options  Array of options
 * @return  string
 */
function tcp_get_featured_image($type = '', $width = '', $height = 0, $options = array())
{
	if (!has_post_thumbnail()) {
		return;
	}

	$options['like_image'] = isset($options['like_image']) ? $options['like_image'] : false;
	$options['like_image_icon'] = isset($options['like_image_icon']) ? $options['like_image_icon'] : '';

	if ($type == 'left' || $type == 'right') {
		$width = $options['float_width'];
		$height = $options['float_height'];
	}

	$imageId = get_post_thumbnail_id();
	$imageSize = tcp_get_image_size_name_from_width($width);
	$imageData = wp_get_attachment_image_src($imageId, $imageSize);

	// Check if the image is wide enough, if not just get the original
	if ($width > $imageData[1]) {
		$imageSize = 'full';
	}

	$style = 'width:' . absint($type == 'above' ? $width + 70 : $width) . 'px;';
	if ($height > 0) {
		$style .= 'max-height:' . absint($height) . 'px;';
	}

	$output = '<div class="' . esc_attr(tcp_sanitize_class('tcp-featured-image-helper tcp-featured-image-' . $type)) . '"><div class="tcp-featured-image-wrap" style="' . esc_attr($style) . '">';

	if ($options['like_image'] && function_exists('react_get_post_like_html')) {
		$output .= react_get_post_like_html(get_the_ID(), $options['like_image_icon']);
	}

	if (isset($options['a'])) {
		$aAttrs = array();
		if (!isset($options['a']['class'])) {
			$options['a']['class'] = array();
		}
		$options['a']['class'] = (array) $options['a']['class'];
		array_unshift($options['a']['class'], 'tcp-featured-image-link');

		if ($height > 0) {
			$options['a']['style'] = 'max-height:' . absint($height) . 'px;';
		}

		if ($caption = tcp_get_attachment_caption($imageId)) {
			$options['a']['data']['caption'] = $caption;
		}

		foreach ($options['a'] as $attr => $value) {
			if ($attr == 'data') {
				foreach ($value as $dataKey => $dataValue) {
					$aAttrs[] = 'data-' . sanitize_key($dataKey) . '="' . esc_attr($dataValue) . '"';
				}
			} else {
				$aAttrs[] = $attr . '="' . esc_attr((is_array($value) ? join(' ', $value) : $value)) . '"';
			}
		}
		$output .= '<a ' . (count($aAttrs) ? join(' ', $aAttrs) : '') . '>';
	}

	$output .= wp_get_attachment_image($imageId, $imageSize);

	if (isset($options['a'])) {
		$output .= '</a>';
	}

	$output .= '</div></div>';

	return $output;
}

/**
 * Get the embed code for portfolio item video type
 *
 * @return  string  The embed HTML
 */
function tcp_get_featured_video($url, $type, $width, $height = 0, $options = array())
{
	$output = '';
	$video = tcp_get_video_info($url);

	if ($video) {
		if ($type != 'left' && $type != 'right') {
			// This part deals with full width featured videos
			$styles = array('width:' . absint($width) . 'px;');
			if ($height) {
				$styles[] = 'height:' . absint($height) . 'px;';
				$styles[] = 'padding-bottom: 0;';
			} else {
				$originalVideoWidth = tcp_get_post_meta(get_the_ID(), 'video_embed_width');
				$originalVideoHeight = tcp_get_post_meta(get_the_ID(), 'video_embed_height');

				if ($originalVideoWidth && $originalVideoHeight) {
					$styles[] = 'padding-bottom:' . (($originalVideoHeight / $originalVideoWidth) * 100) . '%;';
				}
			}
		} else {
			// This part deals with float left/right featured videos
			$styles = array('width:' . absint($options['float_width']) . 'px;');
			if ($options['float_height']) {
				$styles[] = 'height:' . absint($options['float_height']) . 'px;';
				$styles[] = 'padding-bottom: 0;';
			} else {
				$originalVideoWidth = tcp_get_post_meta(get_the_ID(), 'video_embed_width');
				$originalVideoHeight = tcp_get_post_meta(get_the_ID(), 'video_embed_height');

				if ($originalVideoWidth && $originalVideoHeight) {
					$styles[] = 'padding-bottom:' . (($originalVideoHeight / $originalVideoWidth) * 100) . '%;';
				}
			}
		}

		$output .= '<div class="' . esc_attr(tcp_sanitize_class('tcp-featured-video-helper tcp-featured-video-' . $type)) . '"><div class="tcp-featured-video"' . (count($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') . '><iframe src="' . esc_url($video['src']) . '" allowfullscreen style="border: 0;"></iframe></div></div>';
	}

	return $output;
}

/**
 * Get the video type and ID from a YouTube / Vimeo URL
 *
 * @param   string  $url  The video URL
 * @return  array         The video info
 */
function tcp_get_video_info($url)
{
	$info = false;

	if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
		$info = array(
			'type' => 'youtube',
			'src' => '//www.youtube.com/embed/' . $match[1]
		);
	} elseif (preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/', $url, $match)) {
		$info = array(
			'type' => 'vimeo',
			'src' => '//player.vimeo.com/video/' . $match[5]
		);
	}

	return $info;
}

/**
 * Get the image size name that best suits the given width
 *
 * @param   int    $width  The width of the space
 * @return  string         The name of the WP image size
 */
function tcp_get_image_size_name_from_width($width)
{
	if ($width <= 300) {
		$name = 'medium';
	} elseif ($width <= 512) {
		$name = 'react-512';
	} elseif ($width <= 768) {
		$name = 'react-768';
	} elseif ($width <= 1024) {
		$name = 'large';
	} else {
		$name = 'full';
	}

	return $name;
}

/**
 * Get the attachment caption
 *
 * @param   int     $attachId
 * @return  string
 */
function tcp_get_attachment_caption($attachId)
{
	$post = get_post($attachId);
	$caption = '';

	if ($post instanceof WP_Post && isset($post->post_excerpt) && !empty($post->post_excerpt)) {
		$caption = $post->post_excerpt;
	}

	return $caption;
}

/**
 * Register custom post types
 */
function tcp_register_custom_post_types()
{
	// Register Portfolio post type
	register_post_type('portfolio', array(
		'labels' => array(
			'name' => esc_html__('Portfolio', 'react-portfolio'),
			'singular_name' => esc_html__('Portfolio Item', 'react-portfolio'),
			'add_new' => esc_html_x('Add New', 'add portfolio item', 'react-portfolio'),
			'add_new_item' => esc_html_x('Add New Item', 'add new portfolio item', 'react-portfolio'),
			'all_items' => esc_html_x('All Items', 'all portfolio items', 'react-portfolio'),
			'edit_item' => esc_html_x('Edit Item', 'edit portfolio item', 'react-portfolio'),
			'new_item' => esc_html__('New Portfolio Item', 'react-portfolio'),
			'view_item' => esc_html_x('View Item', 'view portfolio item', 'react-portfolio'),
			'search_items' => esc_html__('Search Portfolio Items', 'react-portfolio'),
			'not_found' =>  esc_html__('No portfolio Items found.', 'react-portfolio'),
			'not_found_in_trash' => esc_html__('No portfolio items found in Trash.', 'react-portfolio'),
			'parent_item_colon' => '',
		),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => !tcp_get_option('search'),
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'custom-fields', 'revisions', 'author'),
		'has_archive' => false,
		'query_var' => false,
		'rewrite' => array('slug' => tcp_get_option('rewrite_slug')),
		'can_export' => true,
		'show_in_nav_menus' => true,
		'menu_icon' => 'dashicons-images-alt2'
	));

	if (tcp_get_option('comments')) {
		add_post_type_support('portfolio', 'comments');
	}

	// Register Portfolio Category taxonomy
	register_taxonomy('portfolio_category', 'portfolio', array(
		'labels' => array(
			'name' => esc_html__('Portfolio Categories', 'react-portfolio'),
			'singular_name' => esc_html__('Portfolio Category', 'react-portfolio'),
			'search_items' =>  esc_html__('Search Categories', 'react-portfolio'),
			'popular_items' => esc_html__('Popular Categories', 'react-portfolio'),
			'all_items' => esc_html__('All Categories', 'react-portfolio'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => esc_html__('Edit Category', 'react-portfolio'),
			'update_item' => esc_html__('Update Category', 'react-portfolio'),
			'add_new_item' => esc_html__('Add New Category', 'react-portfolio'),
			'new_item_name' => esc_html__('New Category Name', 'react-portfolio'),
			'menu_name' => esc_html__('Categories', 'react-portfolio')
		),
		'public' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'hierarchical' => true,
		'query_var' => false,
		'rewrite' => array('slug' => tcp_get_option('category_rewrite_slug'))
	));

	// Register Portfolio Tags taxonomy
	register_taxonomy('portfolio_tag', 'portfolio', array(
		'labels' => array(
			'name' => esc_html__('Portfolio Tags', 'react-portfolio'),
			'singular_name' => esc_html__('Portfolio Tag', 'react-portfolio'),
			'search_items' =>  esc_html__('Search Tags', 'react-portfolio'),
			'popular_items' => esc_html__('Popular Tags', 'react-portfolio'),
			'all_items' => esc_html__('All Tags', 'react-portfolio'),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => esc_html__('Edit Tag', 'react-portfolio'),
			'update_item' => esc_html__('Update Tag', 'react-portfolio'),
			'add_new_item' => esc_html__('Add New Tag', 'react-portfolio'),
			'new_item_name' => esc_html__('New Tag Name', 'react-portfolio'),
			'separate_items_with_commas' => esc_html__('Separate tags with commas', 'react-portfolio'),
			'add_or_remove_items' => esc_html__('Add or remove tags', 'react-portfolio'),
			'choose_from_most_used' => esc_html__('Choose from the most used tags', 'react-portfolio'),
			'not_found' => esc_html__('No tags found.', 'react-portfolio'),
			'menu_name' => esc_html__('Tags', 'react-portfolio')
		),
		'public' =>  true,
		'show_ui' => true,
		'show_admin_column' => true,
		'hierarchical' => false,
		'query_var' => false,
		'rewrite' => array('slug' => tcp_get_option('tag_rewrite_slug'))
	));
}
add_action('init', 'tcp_register_custom_post_types');

/**
 * Whether the post has a featured image or video
 *
 * @return  boolean
 */
function tcp_has_featured_media()
{
	if (has_post_thumbnail()) {
		return true;
	}

	$itemType = tcp_get_post_meta(get_the_ID(), 'type');
	if ($itemType == 'video_embed' && strlen(tcp_get_post_meta(get_the_ID(), 'video_embed'))) {
		return true;
	}

	return false;
}

/**
 * Returns the line that says when the entry was posted
 *
 * @return  stirng
 */
function tcp_posted_on()
{
	global $post;
	$author = !empty($post->post_author) ? get_userdata($post->post_author) : false;

	if ($author instanceof WP_User) {
		$output = sprintf('%1$s <span class="vcard"><i class="fa fa-user"></i> <a class="url fn" href="%2$s" title="%3$s">%4$s</a></span>',
			'<span class="updated"><i class="fa fa-clock-o"></i> <a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_time(get_option('date_format'), $post)) . '</a></span>',
			esc_url(get_author_posts_url($author->ID)),
			esc_attr(sprintf(esc_attr__('View all posts by %s', 'react-portfolio'), $author->display_name)),
			esc_html($author->display_name)
		);
	} else {
		$output = '<span class="updated"><i class="fa fa-clock-o"></i> <a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_time(get_option('date_format'), $post)) . '</a></span>';
	}

	return $output;
}

/**
 * Get the current page number
 *
 * @return int The page we are on
 */
function tcp_get_paged_var()
{
	$paged = 1;

	if (is_front_page()) {
		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif (get_query_var('page')) {
			$paged = get_query_var('page');
		}
	} else {
		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		}
	}

	return (int) $paged;
}

/**
 * Fix for pagination when using portfolio shortcode on a single portfolio item page
 *
 * @param   mixed  $redirect_url
 * @return  mixed                 false if on single portfolio
 */
function tcp_disable_redirect_canonical($redirect_url) {

	if (is_singular('portfolio')) {
		$redirect_url = false;
	}

	return $redirect_url;
}
add_filter('redirect_canonical', 'tcp_disable_redirect_canonical');

/**
 * Temporary excerpt more for portfolio items
 *
 * Stops themes adding a custom HTML that might interfere with the portfolio item layout
 *
 * @return string
 */
function tcp_excerpt_more()
{
	return '...';
}

// Helper class to hold a temporary custom excerpt length
class Tcp_Excerpt_Length {
	private $length;

	public function __construct($length)
	{
		$this->length = $length;
	}

	public function getLength()
	{
		return $this->length;
	}
}

/**
 * Register the shortcode widget
 */
function tcp_widgets_init()
{
	require_once TCP_INCLUDES_DIR . '/widget.php';

	register_widget('TCP_Widget_Portfolio');
}
add_action('widgets_init', 'tcp_widgets_init');

// Load the shortcodes
require_once TCP_INCLUDES_DIR . '/shortcode.php';

if (is_admin()) {
	require_once TCP_ADMIN_DIR . '/admin.php';
}
