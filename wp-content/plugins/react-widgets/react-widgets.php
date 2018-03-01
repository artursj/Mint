<?php
/*
 * Plugin Name: React Widgets
 * Plugin URI: http://www.themecatcher.net
 * Description: A stylish collection of useful widgets.
 * Version: 1.0.5
 * Author: ThemeCatcher
 * Author URI: http://www.themecatcher.net
 * Text Domain: react-widgets
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

define('TCW_PLUGIN_VERSION', '1.0.5');
define('TCW_PLUGIN_FILE', __FILE__);
define('TCW_PLUGIN_DIR', dirname(TCW_PLUGIN_FILE));
define('TCW_INCLUDES_DIR', TCW_PLUGIN_DIR . '/includes');
define('TCW_ADMIN_DIR', TCW_PLUGIN_DIR . '/admin');
define('TCW_ADMIN_INCLUDES_DIR', TCW_ADMIN_DIR . '/includes');
define('TCW_OPTIONS_KEY', 'react-widgets');

tcw_set_options();

/**
 * Set the current plugin options into a global
 */
function tcw_set_options()
{
	global $tcw;
	$tcw['options'] = tcw_get_options();
}

/**
 * Get the plugin options
 *
 * @return array
 */
function tcw_get_options()
{
	$options = get_option(TCW_OPTIONS_KEY);
	$options = is_array($options) ? $options : array();

	return array_merge(tcw_get_default_options(), $options);
}

/**
 * Get the default plugin options
 *
 * @return array
 */
function tcw_get_default_options()
{
	return array(
		// Performance options
		'load_scripts' => 'always',
		'load_scripts_custom' => array(),

		// Disable script output
		'disabled_styles' => array()
	);
}

/**
 * Get a plugin option
 *
 * @param   string  $key      The key within the options array
 * @param   mixed   $default  The default value if the key is not found
 * @return  mixed
 */
function tcw_get_option($key, $default = null)
{
	global $tcw;

	if (array_key_exists($key, $tcw['options'])) {
		return $tcw['options'][$key];
	}

	return $default;
}

/**
 * Get the URL of the plugin directory
 *
 * @param   string  $path  Extra path to append to the URL
 * @return  string
 */
function tcw_url($path = '')
{
	return plugins_url($path, TCW_PLUGIN_FILE);
}

/**
 * Sanitize multiple classes
 *
 * @param   string|array  $classes  Classes to sanitize
 * @return  string                  The sanitized classes
 */
function tcw_sanitize_class($classes)
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
function tcw_log()
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
function tcw_load_textdomain()
{
	load_plugin_textdomain('react-widgets', false, plugin_basename(dirname(TCW_PLUGIN_FILE)) . '/languages');
}
add_action('plugins_loaded', 'tcw_load_textdomain');

function tcw_widgets_init()
{
	require_once TCW_INCLUDES_DIR . '/twitter.php';
	require_once TCW_INCLUDES_DIR . '/social.php';
	require_once TCW_INCLUDES_DIR . '/facebook.php';
	require_once TCW_INCLUDES_DIR . '/opening-times.php';
	require_once TCW_INCLUDES_DIR . '/contact-details.php';
	require_once TCW_INCLUDES_DIR . '/related.php';
	require_once TCW_INCLUDES_DIR . '/recent.php';
	require_once TCW_INCLUDES_DIR . '/popular.php';

	// Initialise widgets
	register_widget('TCW_Widget_Twitter');
	register_widget('TCW_Widget_Social');
	register_widget('TCW_Widget_Facebook');
	register_widget('TCW_Widget_Opening');
	register_widget('TCW_Widget_Contact');
	register_widget('TCW_Widget_Related');
	register_widget('TCW_Widget_Recent');
	register_widget('TCW_Widget_Popular');
}
add_action('widgets_init', 'tcw_widgets_init');

/**
 * Get the array of social networks used in the social links
 *
 * @return  array
 */
function tcw_get_socials()
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

/**
 * Returns an array of all categories in the format:
 *
 * id => name
 *
 * @return array
 */
function tcw_get_all_category_options()
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
function tcw_get_all_author_options()
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
 * Determine whether the JS/CSS should be enqueued based on the performance options
 */
function tcw_enqueue()
{
	$loadScripts = true;

	if (tcw_get_option('load_scripts') == 'autodetect') {
		if ( ! tcw_detect_widget()) {
			$loadScripts = false;
		}
	} else if (tcw_get_option('load_scripts') == 'custom') {
		if (count(tcw_get_option('load_scripts_custom')) && ! in_array(get_queried_object_id(), tcw_get_option('load_scripts_custom'))) {
			$loadScripts = false;
		}
	}

	if ($loadScripts) {
		tcw_enqueue_styles();
		tcw_enqueue_scripts();
	}
}
add_action('wp_enqueue_scripts', 'tcw_enqueue');

/**
* Check if there is an active widget on the page
*
* @return bool
*/
function tcw_detect_widget()
{
	return is_active_widget(false, false, 'tcw-widget-contact')
		|| is_active_widget(false, false, 'tcw-widget-facebook')
		|| is_active_widget(false, false, 'tcw-widget-opening')
		|| is_active_widget(false, false, 'tcw-widget-popular')
		|| is_active_widget(false, false, 'tcw-widget-recent')
		|| is_active_widget(false, false, 'tcw-widget-related')
		|| is_active_widget(false, false, 'tcw-widget-social')
		|| is_active_widget(false, false, 'tcw-widget-twitter');
}

/**
 * Get the stylesheets used by the plugin
 *
 * Used to enqueue stylesheets and disable them in the settings
 *
 * @return array
 */
function tcw_get_styles()
{
	return array(
		'font-awesome' => array( // http://fortawesome.github.io/Font-Awesome/
			'name' => 'Font Awesome',
			'tooltip' => esc_html__('Used to display icons in the Contact Details, Social Icons and Twitter widget', 'react-widgets'),
			'url' => tcw_url('css/font-awesome/css/font-awesome.min.css'),
			'deps' => array(),
			'version' => '4.6.1'
		),
		'webicons' => array( // https://github.com/adamfairhead/webicons
			'name' => 'Webicons',
			'tooltip' => esc_html__('Used to display social network icons in the Social Icons widget', 'react-widgets'),
			'url' => tcw_url('css/webicons.css'),
			'deps' => array(),
			'version' => '4c14b73'
		)
	);
}

/**
 * Enqueue the CSS
 */
function tcw_enqueue_styles()
{
	foreach (tcw_get_styles() as $key => $style) {
		if (in_array($key, tcw_get_option('disabled_styles'))) {
			continue;
		}

		wp_enqueue_style($key, $style['url'], $style['deps'], $style['version']);
	}

	wp_enqueue_style('tcw-styles', tcw_url('css/styles.css'), array(), TCW_PLUGIN_VERSION);
}

/**
 * Enqueue the JavaScript
 */
function tcw_enqueue_scripts()
{
	wp_enqueue_script('tcw-scripts', tcw_url('js/scripts.js'), array('jquery'), TCW_PLUGIN_VERSION, true);
}

if (is_admin()) {
	require_once TCW_ADMIN_DIR . '/admin.php';
}
