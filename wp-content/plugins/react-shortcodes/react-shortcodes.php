<?php
/*
 * Plugin Name: React Shortcodes
 * Plugin URI: http://www.themecatcher.net
 * Description: A lot of shortcodes with a lot of options.
 * Version: 1.0.7
 * Author: ThemeCatcher
 * Author URI: http://www.themecatcher.net
 * Text Domain: react-shortcodes
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

define('TCS_PLUGIN_VERSION', '1.0.7');
define('TCS_PLUGIN_FILE', __FILE__);
define('TCS_PLUGIN_DIR', dirname(TCS_PLUGIN_FILE));
define('TCS_INCLUDES_DIR', TCS_PLUGIN_DIR . '/includes');
define('TCS_ADMIN_DIR', TCS_PLUGIN_DIR . '/admin');
define('TCS_ADMIN_INCLUDES_DIR', TCS_ADMIN_DIR . '/includes');
define('TCS_OPTIONS_KEY', 'react-shortcodes');

tcs_load_options();

/**
 * Load the current plugin options
 */
function tcs_load_options()
{
	global $tcs;
	$tcs['options'] = tcs_get_options();
}

/**
 * Get the plugin options
 *
 * @return array
 */
function tcs_get_options()
{
	$options = get_option(TCS_OPTIONS_KEY);
	$options = is_array($options) ? $options : array();

	return array_merge(tcs_get_default_options(), $options);
}

/**
 * Get the default plugin options
 *
 * @return array
 */
function tcs_get_default_options()
{
	return array(
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
function tcs_get_option($key, $default = null)
{
	global $tcs;

	if (array_key_exists($key, $tcs['options'])) {
		return $tcs['options'][$key];
	}

	return $default;
}

/**
 * Get the URL of the plugin directory
 *
 * @param   string  $path  Extra path to append to the URL
 * @return  string
 */
function tcs_url($path = '')
{
	return plugins_url($path, TCS_PLUGIN_FILE);
}

/**
 * Sanitize multiple classes
 *
 * @param   string|array  $classes  Classes to sanitize
 * @return  string                  The sanitized classes
 */
function tcs_sanitize_class($classes)
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
function tcs_log()
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
function tcs_load_textdomain()
{
	load_plugin_textdomain('react-shortcodes', false, plugin_basename(dirname(TCS_PLUGIN_FILE)) . '/languages');
}
add_action('plugins_loaded', 'tcs_load_textdomain');

/**
 * Removes <p> and <br> tags around shortcodes caused by wpautop.
 *
 * @param   string  $content  The post content
 * @return  string            The fixed post content
 */
function tcs_fix_shortcodes($content)
{
	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br>' => ']',
		']<br />' => ']'
	);

	$content = strtr($content, $array);
	return $content;
}
add_filter('the_content', 'tcs_fix_shortcodes');

/**
 * Returns an array of all categories in the format:
 *
 * id => name
 *
 * @return array
 */
function tcs_get_all_category_options()
{
	$categories = get_terms('category', array('hide_empty' => false));
	$options = array();

	foreach($categories as $category) {
		$options[$category->term_id] = $category->name;
	}

	return $options;
}

/**
 * Returns an array of all authors in the format:
 *
 * id => display_name
 *
 * @return array
 */
function tcs_get_all_author_options()
{
	global $wpdb;
	$options = array();
	$authors = $wpdb->get_results("SELECT ID, display_name FROM $wpdb->users WHERE ID IN (SELECT post_author FROM $wpdb->posts) ORDER BY display_name");

	foreach ($authors as $author) {
		$options[$author->ID] = $author->display_name;
	}

	return $options;
}

/**
 * Get all the classes for the given icon
 *
 * @param   string  $icon        The icon to add additional classes to
 * @param   string  $sizeImage   The image size for image icons
 * @param   string  $styleImage  The image style for image icons
 * @return  string               The complete classes
 */
function tcs_get_icon_classes($icon, $sizeImage = 'sml', $styleImage = 'drk')
{
	$classes = array($icon);

	if (preg_match('/^fa\-/', $icon)) {
		$classes[] = 'fa';
	} else if (preg_match('/^icon\-/', $icon)) {
		$classes[] = 'mix-ico';
	} else {
		$classes[] = $sizeImage . ' iconsprite ' . $styleImage;
	}

	return join(' ', $classes);
}

/**
 * Get the URL to the WP uploads directory
 *
 * @param   string  $path  Optional path to be joined after the URL
 * @return  string
 */
function tcs_uploads_url($path = '')
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
function tcs_get_upload_url($url)
{
	if (!is_string($url)) {
		return '';
	}

	$url = trim($url);

	if ($url === '') {
		return '';
	}

	if (tcs_is_absolute_url($url)) {
		return $url;
	}

	if (tcs_is_absolute_path($url)) {
		return site_url($url);
	}

	return tcs_uploads_url($url);
}

/**
 * Returns true if the given URL is an absolute URL including scheme and domain, false otherwise
 *
 * @param   string   $url
 * @return  boolean
 */
function tcs_is_absolute_url($url)
{
	return preg_match('#^(http(s)?://|//)#i', $url);
}

/**
 * Returns true if the given URL is an absolute path excluding scheme and domain, false otherwise
 *
 * @param   string   $url
 * @return  boolean
 */
function tcs_is_absolute_path($url)
{
	return !tcs_is_absolute_url($url) && substr($url, 0, 1) === '/';
}

/**
 * Returns the CSS for the texture, detail and custom image for the Block shortcode
 *
 * @param   array   $options   The array of options
 * @param   string  $selector  The block unique class
 * @return  string             The CSS
 */
function tcs_get_texture_detail_css($options, $selector)
{
	$url = tcs_url();
	$output = '';
	$options['texture'] = isset($options['texture']) && $options['texture'] ? $options['texture'] : 'none';
	$options['detail'] = isset($options['detail']) && $options['detail'] ? $options['detail'] : 'none';
	$options['image'] = isset($options['image']) ? $options['image'] : '';
	$options['texture_fixed'] = isset($options['texture_fixed']) ? $options['texture_fixed'] : false;
	$nl = "\n";

	if ($options['texture'] != 'none') {
		$textureSize = tcs_get_texture_detail_size($options['texture']);
		$output .= $selector . '.tcs-' . $options['texture'] . ($options['image'] ? ' > div' : '') . ' {
	background-image: url(' . $url . '/images/backgrounds/overlays/' .  $options['texture_opacity'] . '/' .  $options['texture'] . ($options['texture_large'] ? '@2x' : '') . '.png);
	background-repeat: repeat;' . ($options['texture_fixed'] ? $nl . '    background-attachment: fixed; position: static; ' : '') . '
}' . $nl;
		if (!$options['texture_large']) {
			$output .= '@media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi), (min-resolution: 1.5dppx) {
	' . $selector . '.' . $options['texture'] . ($options['image'] ? ' > div' : '') . ' {
		background-image: url(' . $url . '/images/backgrounds/overlays/' .  $options['texture_opacity'] . '/' . $options['texture'] . '@2x.png);
		background-size: ' . $textureSize['w'] . 'px ' . $textureSize['h'] . 'px;
	}
}' . $nl;
		}
	}

	if ($options['detail'] != 'none' && strpos($options['detail'], 'edge') === false && !($options['image'] && $options['texture'] != 'none')) {
		$detailSize = tcs_get_texture_detail_size($options['detail']);
		$output .= $selector . '.tcs-' . $options['detail'] . '-' . $options['detail_opacity'] . ' > div {
	background-image: url(' . $url . '/images/backgrounds/detail/' .  $options['detail_opacity'] . '/' . $options['detail'] . '.png);';

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
	' . $selector . '.' . $options['detail'] . '-' . $options['detail_opacity'] . ' > div { ';

		if (strpos($options['detail'], 'shadow') !== false) {
			$output .= $nl . '    background-image: url(' . $url . '/images/backgrounds/detail/' .  $options['detail_opacity'] . '/' . $options['detail'] . '.png);';
			$output .= $nl . '    background-size: 100% auto;';
		} else {
			$output .= $nl . '    background-image: url(' . $url . '/images/backgrounds/detail/' .  $options['detail_opacity'] . '/' . $options['detail'] . '@2x.png);';
			$output .= $nl . '    background-size: ' . $detailSize['w'] . 'px ' . $detailSize['h'] . 'px;';
		}
	$output .= '
	}
}' . $nl;
	}

	if ($options['image']) {
		$output .= $selector . ' {' . $nl;
		$output .= '    background-image: url(' . esc_url($options['image']) . ');' . $nl;
		$output .= '    background-repeat: ' . $options['image_repeat'] . ';' . $nl;
		$output .= '    background-position: ' . ($options['image_position'] === 'custom' ? $options['image_position_custom'] : $options['image_position']) . ';' . $nl;
		if ($options['image_fixed']) {
			$output .= '    background-attachment: fixed; position: static;' . $nl;
		}
		if ($options['image_background_size'] !='') {
			$output .= '    background-size: ' . $options['image_background_size'] . ';' . $nl;
		}
		$output .= '}' . $nl;

		if ($options['image_retina_use_main_img'] == 'use-main-img' || $options['image_retina_use_main_img'] == 'change-position' || $options['image_retina_use_main_img'] == 'no-image' || ($options['image_retina_use_main_img'] == 'use-new-img' && $options['image_retina'])) {
			if ($options['image_convert'] == 'phone-ptr') {
				$output .= '@media only screen and (max-width: 320px) {';
			}
			elseif ($options['image_convert'] == 'phone-ldsp') {
				$output .= '@media only screen and (max-width: 568px) {';
			}
			elseif ($options['image_convert'] == 'tablet-ptr') {
				$output .= '@media only screen and (max-width: 600px) {';
			}
			elseif ($options['image_convert'] == 'tablet-ldsp') {
				$output .= '@media only screen and (max-width: 1024px) {';
			}
			elseif ($options['image_convert'] == 'custom') {
				$output .= '@media only screen and (max-width: ' . $options['image_convert_custom'] . 'px) {';
			}
			elseif ($options['image_convert'] == 'only-retina-devices') {
				$output .= '@media (-webkit-min-device-pixel-ratio: 1.5), (min-resolution: 144dpi), (min-resolution: 1.5dppx) {';
			}

			$retinaImageUrl = tcs_get_upload_url($options['image_retina']);
			$output .= $nl . '    ' . $selector . ' {' . $nl;

			if ($options['image_retina_use_main_img'] == 'use-main-img') {
				$output .= '        background-image: url(' . esc_url($options['image']) . ');' . $nl;
				if ($options['image_repeat_retina'] !== $options['image_repeat']) {
					$output .= '    background-repeat: ' . $options['image_repeat_retina'] . ';' . $nl;
				}
				if ($options['image_position_retina'] !== $options['image_position'] || $options['image_position_retina'] === 'custom') {
					$output .= '    background-position: ' . ($options['image_position_retina'] === 'custom' ? $options['image_position_custom_retina'] : $options['image_position_retina']) . ';' . $nl;
				}
				if ($options['image_fixed_retina']) {
					$output .= '    background-attachment: fixed; position: static; ' . $nl;
				}
				if ($options['image_background_size_retina'] !='') {
					$output .= '    background-size: ' . $options['image_background_size_retina'] . ';' . $nl;
				} else {
					$output .= '        background-size: ' . ($options['image_width'] / 2) . 'px ' . ($options['image_height'] / 2) . 'px;' . $nl;
				}
			}
			elseif (($options['image_retina_use_main_img'] == 'use-new-img') && $options['image_retina'] && $options['image_is_retina']) {
				$output .= '        background-image: url(' . esc_url($retinaImageUrl) . ');' . $nl;
				$output .= '        background-size: ' . ($options['image_retina_width'] / 2) . 'px ' . ($options['image_retina_height'] / 2) . 'px;' . $nl;
				if ($options['image_repeat_retina'] !== $options['image_repeat']) {
					$output .= '        background-repeat: ' . $options['image_repeat_retina'] . ';' . $nl;
				}
				if ($options['image_position_retina'] !== $options['image_position'] || $options['image_position_retina'] === 'custom') {
					$output .= '        background-position: ' . ($options['image_position_retina'] === 'custom' ? $options['image_position_custom_retina'] : $options['image_position_retina']) . ';' . $nl;
				}
				if ($options['image_fixed_retina']) {
					$output .= '        background-attachment: fixed; position: static; ' . $nl;
				} else {
					$output .= '        background-attachment: scroll;' . $nl;
				}
				if ($options['image_background_size_retina'] !='') {
					$output .= '    background-size: ' . $options['image_background_size_retina'] . ';' . $nl;
				}
			}
			elseif (($options['image_retina_use_main_img'] == 'use-new-img') && $options['image_retina'] && !$options['image_is_retina']) {
				$output .= '        background-image: url(' . esc_url($retinaImageUrl) . ');' . $nl;
				$output .= '        background-size: ' . $options['image_retina_width'] . 'px ' . $options['image_retina_height'] . 'px;' . $nl;
				if ($options['image_repeat_retina'] !== $options['image_repeat']) {
					$output .= '        background-repeat: ' . $options['image_repeat_retina'] . ';' . $nl;
				}
				if ($options['image_position_retina'] !== $options['image_position'] || $options['image_position_retina'] === 'custom') {
					$output .= '        background-position: ' . ($options['image_position_retina'] === 'custom' ? $options['image_position_custom_retina'] : $options['image_position_retina']) . ';' . $nl;
				}
				if ($options['image_fixed_retina']) {
					$output .= '        background-attachment: fixed; position: static; ' . $nl;
				} else {
					$output .= '        background-attachment: scroll;' . $nl;
				}
				if ($options['image_background_size_retina'] !='') {
					$output .= '    background-size: ' . $options['image_background_size_retina'] . ';' . $nl;
				}
			}
			elseif ($options['image_retina_use_main_img'] == 'change-position') {
				if ($options['image_repeat_retina'] !== $options['image_repeat']) {
					$output .= '        background-repeat: ' . $options['image_repeat_retina'] . ';' . $nl;
				}
				if ($options['image_position_retina'] !== $options['image_position'] || $options['image_position_retina'] === 'custom') {
					$output .= '        background-position: ' . ($options['image_position_retina'] === 'custom' ? $options['image_position_custom_retina'] : $options['image_position_retina']) . ';' . $nl;
				}
				if ($options['image_fixed_retina']) {
					$output .= '        background-attachment: fixed; position: static; ' . $nl;
				} else {
					$output .= '        background-attachment: scroll;' . $nl;
				}
				if ($options['image_background_size_retina'] !='') {
					$output .= '    background-size: ' . $options['image_background_size_retina'] . ';' . $nl;
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

/**
 * Get the size of the given detail/texture
 *
 * @param  string  $detail  The name of the detail/texture
 * @return array            The array of width/height
 */
function tcs_get_texture_detail_size($detail)
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

/**
 * Helper function for CSS unit values
 *
 * If the give value is numeric and not zero, "px" will be appended
 *
 * @param   string  $value  Any valid CSS unit value
 * @return  string
 */
function tcs_get_css_value($value)
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
function tcs_get_hide_class($hide)
{
	return tcs_prefix_classes(str_replace(',', ' ', $hide));
}

/**
 * Add the tcs- prefix and sanitize every class in the given class string
 *
 * @param   string  $classes  Whitespace separated class string
 * @return  string            Sanitized space separated class list with the tcs- prefix
 */
function tcs_prefix_classes($classes)
{
	$classes = preg_split('/\s+/', trim($classes));

	foreach($classes as $k => $class) {
		$classes[$k] = sanitize_html_class('tcs-' . $class);
	}

	return join(' ', $classes);
}

/**
 * Sanitize every class in the given class string
 *
 * Runs sanitize_html_class on multiple classes separated by whitespace
 *
 * @param   string  $classes  Whitespace separated class string
 * @return  string            Sanitized space separated class list
 */
function tcs_sanitize_classes($classes)
{
	$classes = preg_split('/\s+/', trim($classes));
	$sanitized = array();

	foreach($classes as $class) {
		$sanitized[] = sanitize_html_class($class);
	}

	return join(' ', $sanitized);
}

/**
 * Register the shortcode widget
 */
function tcs_widgets_init()
{
	require_once TCS_INCLUDES_DIR . '/widget.php';

	register_widget('TCS_Widget_Shortcode');
}
add_action('widgets_init', 'tcs_widgets_init');

/**
 * Determine whether the JS/CSS should be enqueued based on the performance options
 */
function tcs_enqueue()
{
	$loadScripts = true;

	if (tcs_get_option('load_scripts') == 'custom') {
		if (count(tcs_get_option('load_scripts_custom')) && ! in_array(get_queried_object_id(), tcs_get_option('load_scripts_custom'))) {
			$loadScripts = false;
		}
	}

	if ($loadScripts) {
		tcs_enqueue_styles();
		tcs_enqueue_scripts();
	}
}
add_action('wp_enqueue_scripts', 'tcs_enqueue');

/**
 * Get the stylesheets used by the plugin
 *
 * Used to enqueue stylesheets and disable them in the settings
 *
 * @return array
 */
function tcs_get_styles()
{
	return array(
		'font-awesome' => array( // http://fortawesome.github.io/Font-Awesome/
			'name' => 'Font Awesome',
			'tooltip' => esc_html__('Used by several shortcodes to display icons', 'react-shortcodes'),
			'url' => tcs_url('css/font-awesome/css/font-awesome.min.css'),
			'deps' => array(),
			'version' => '4.6.1'
		),
		'icomoon' => array( // https://icomoon.io/
			'name' => 'Icomoon',
			'tooltip' => esc_html__('Used by several shortcodes to display icons', 'react-shortcodes'),
			'url' => tcs_url('css/icomoon/css/icomoon.min.css'),
			'deps' => array(),
			'version' => '1.1.1'
		),
		'iconsprite' => array(
			'name' => 'Iconsprite',
			'tooltip' => esc_html__('Used by several shortcodes to display icons', 'react-shortcodes'),
			'url' => tcs_url('css/iconsprite.css'),
			'deps' => array(),
			'version' => TCS_PLUGIN_VERSION
		),
		'fancybox2' => array( // http://fancyapps.com/fancybox/
			'name' => 'Fancybox',
			'tooltip' => sprintf(esc_html__('Used by the %s shortcode to show content in a popup', 'react-shortcodes'), '[lightbox]'),
			'url' => tcs_url('js/fancybox2/jquery.fancybox.min.css'),
			'deps' => array(),
			'version' => '2.1.5'
		),
		'owl-carousel-2' => array( // http://fancyapps.com/fancybox/
			'name' => 'Owl Carousel',
			'tooltip' => sprintf(esc_html__('Used by the %s and %s shortcodes', 'react-shortcodes'), '[image_carousel]', '[cycle]'),
			'url' => tcs_url('js/owl-carousel-2/owl.carousel.min.css'),
			'deps' => array(),
			'version' => '2.0.0-beta.3'
		)
	);
}

/**
 * Enqueue the CSS
 */
function tcs_enqueue_styles()
{
	foreach (tcs_get_styles() as $key => $style) {
		if (in_array($key, tcs_get_option('disabled_styles'))) {
			continue;
		}

		wp_enqueue_style($key, $style['url'], $style['deps'], $style['version']);
	}

	wp_enqueue_style('tcs-styles', tcs_url('css/styles.css'), array(), TCS_PLUGIN_VERSION);
}

/**
 * Get the scripts used by the plugin
 *
 * Used to enqueue scripts and disable them in the settings
 *
 * @return array
 */
function tcs_get_scripts()
{
	return array(
		'owl-carousel-2' => array( // http://www.owlcarousel.owlgraphic.com/
			'name' => 'Owl Carousel',
			'tooltip' => sprintf(esc_html__('Used by the %s[image_carousel] and %s[cycle] shortcodes', 'react-shortcodes'), '[image_carousel]', '[cycle]'),
			'url' => tcs_url('js/owl-carousel-2/owl.carousel.min.js'),
			'deps' => array('jquery'),
			'version' => '2.0.0-beta.3',
			'footer' => true
		),
		'fancybox2' => array( // http://fancyapps.com/fancybox/
			'name' => 'Fancybox',
			'tooltip' => sprintf(esc_html__('Used by the %s shortcode to show content in a popup', 'react-shortcodes'), '[lightbox]'),
			'url' => tcs_url('js/fancybox2/jquery.fancybox.pack.js'),
			'deps' => array('jquery'),
			'version' => '2.1.5',
			'footer' => true
		),
		'jquery-tools-tabs' => array( // https://github.com/jquerytools/jquerytools/
			'name' => 'jQuery Tools Tabs',
			'tooltip' => sprintf(esc_html__('Used by the %s shortcode to display tabbed content', 'react-shortcodes'), '[tabs]'),
			'url' => tcs_url('js/jquery.tools.tabs.min.js'),
			'deps' => array('jquery'),
			'version' => '1.2.7',
			'footer' => true
		)
	);
}

/**
 * Enqueue the JavaScript
 */
function tcs_enqueue_scripts()
{
	foreach (tcs_get_scripts() as $key => $script) {
		if (in_array($key, tcs_get_option('disabled_scripts'))) {
			continue;
		}

		wp_enqueue_script($key, $script['url'], $script['deps'], $script['version'], $script['footer']);
	}

	wp_enqueue_script('tcs-scripts', tcs_url('js/scripts.js'), array('jquery'), TCS_PLUGIN_VERSION, true);
}

/**
 * Is the React theme active?
 *
 * @return bool
 */
function tcs_is_react_active()
{
	return function_exists('react_get_option');
}

// Load the shortcodes
require_once TCS_INCLUDES_DIR . '/shortcodes.php';

if (is_admin()) {
	require_once TCS_ADMIN_DIR . '/admin.php';
}
