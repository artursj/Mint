<?php

/**
 * admin.php
 *
 * Admin only functions
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

require_once REACT_ADMIN_INCLUDES_DIR . '/class-tgm-plugin-activation.php';
require_once REACT_ADMIN_INCLUDES_DIR . '/class-react-options-generator.php';

// Save the custom CSS files when previewing the theme
add_action('after_switch_theme', 'react_activation');

/**
 * Theme activation function
 */
function react_activation()
{
	// Get any existing options merged with the defaults
	$options = react_get_options();

	// Save these options and generate any custom files
	react_save_options($options);

	// Hide RevSlider admin notice
	update_option('revslider-valid-notice', 'false');
}

/**
 * Register the required plugins for this theme
 */
function react_register_required_plugins()
{
	$plugins = array(
		array(
			'name'               => 'React Portfolio',
			'slug'               => 'react-portfolio',
			'source'             => get_template_directory() . '/includes/plugins/react-portfolio.zip',
			'required'           => false,
			'version'            => '1.0.6',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => ''
		),
		array(
			'name'               => 'React Shortcodes',
			'slug'               => 'react-shortcodes',
			'source'             => get_template_directory() . '/includes/plugins/react-shortcodes.zip',
			'required'           => false,
			'version'            => '1.0.7',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => ''
		),
		array(
			'name'               => 'React Widgets',
			'slug'               => 'react-widgets',
			'source'             => get_template_directory() . '/includes/plugins/react-widgets.zip',
			'required'           => false,
			'version'            => '1.0.5',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => ''
		),
		array(
			'name'               => 'Quform',
			'slug'               => 'iphorm-form-builder',
			'source'             => get_template_directory() . '/includes/plugins/iphorm-form-builder.zip',
			'required'           => false,
			'version'            => '1.10.0', // Changelog: http://www.quform.com/changelog
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => 'http://www.quform.com/',
			'is_callable'        => ''
		),
		array(
			'name'               => 'Slider Revolution',
			'slug'               => 'revslider',
			'source'             => get_template_directory() . '/includes/plugins/revslider.zip',
			'required'           => false,
			'version'            => '5.4.3', // Changelog: http://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380#item-description__update-history
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => 'https://revolution.themepunch.com/',
			'is_callable'        => ''
		),
		array(
			'name'               => 'Visual Composer',
			'slug'               => 'js_composer',
			'source'             => get_template_directory() . '/includes/plugins/js_composer.zip',
			'required'           => false,
			'version'            => '5.2.1', // Changelog: http://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431#item-description__updates
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => 'https://vc.wpbakery.com/',
			'is_callable'        => ''
		),
		array(
			'name'               => 'Go Portfolio',
			'slug'               => 'go_portfolio',
			'source'             => get_template_directory() . '/includes/plugins/go_portfolio.zip',
			'required'           => false,
			'version'            => '1.7.1', // Changelog: http://codecanyon.net/item/go-portfolio-wordpress-responsive-portfolio/5741904#item-description__-changelog
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => 'http://go-portfolio.com/',
			'is_callable'        => ''
		),
		array(
			'name'      => 'WordPress Importer',
			'slug'      => 'wordpress-importer',
			'required'  => false
		),
		array(
			'name'      => 'Widget Importer & Exporter',
			'slug'      => 'widget-importer-exporter',
			'required'  => false
		),
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false
		)
	);

	$config = array(
		'id'           => 'react',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true
	);

	tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'react_register_required_plugins');

/**
 * Set up the meta boxes
 */
function react_add_meta_boxes()
{
	require_once REACT_ADMIN_INCLUDES_DIR . '/class-react-metabox-generator.php';
	require_once REACT_ADMIN_INCLUDES_DIR . '/metabox.php';
}
add_action('admin_init', 'react_add_meta_boxes');

/**
 * Add the Theme Options link to the WP menu
 */
function react_admin_menu()
{
	add_theme_page(
		esc_html__('React Options', 'react'),
		esc_html__('Theme Options', 'react'),
		'edit_theme_options',
		'react',
		'react_options_panel'
	);
}
add_action('admin_menu', 'react_admin_menu');

/**
 * Displays the options panel page
 */
function react_options_panel()
{
	global $react;

	if (!react_is_wp_version_supported()) {
		wp_die('<p class="react-warning">' . esc_html__('The theme requires WordPress 4.3 or later, please update WordPress to access the theme options.', 'react') . '</p>');
	}

	$googleFontsUrl = 'https://www.google.com/fonts';
	$hideWelcomeTab = get_user_meta(get_current_user_id(), REACT_OPTIONS_PREFIX . '_hide_welcome_tab', true);
	$imOrder = array_unique(array_merge($react['options']['im_order'], react_get_default_im_order()));

	require_once REACT_ADMIN_INCLUDES_DIR . '/panel.php';
}

/**
 * Is the plugin with the given path installed?
 *
 * @param   string  $path  The plugin path
 * @return  bool
 */
function react_is_plugin_installed($path)
{
	$plugins = get_plugins();

	return !empty($plugins[$path]);
}

/**
 * Is the current version of WordPress supported by this theme?
 *
 * @return  boolean
 */
function react_is_wp_version_supported()
{
	return version_compare(get_bloginfo('version'), '4.3', '>=');
}

/**
 * Handle saving the theme options panel via Ajax
 */
function react_save_options_ajax()
{
	if (!isset($_POST['options'])) {
		wp_send_json(array('type' => 'error', 'message' => 'Bad request'));
	}

	if (!current_user_can('edit_theme_options')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('react_save_options', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	$options = json_decode(stripslashes($_POST['options']), true);

	if (!is_array($options)) {
		wp_send_json(array('type' => 'error', 'message' => 'The options are invalid or malformed'));
	}

	react_save_options($options);

	wp_send_json(array(
		'type' => 'success'
	));
}
add_action('wp_ajax_react_save_options_ajax', 'react_save_options_ajax');

/**
 * Save the given theme options
 *
 * @param array $options
 */
function react_save_options($options)
{
	global $react;

	// Sanitize options & add extras
	$options = react_sanitize_options($options);
	$options = apply_filters('react_pre_save_options', $options);
	$options['last_saved'] = time();

	update_option(REACT_OPTIONS_NAME, $options);

	// Set the current options to the new options
	$react['options'] = $options;

	$filesystem = react_get_filesystem();
	if ( ! $filesystem instanceof WP_Filesystem_Base) {
		// We have no write access, nothing to do
		return;
	}

	react_generate_animate_css_file($options, $filesystem);
	react_generate_custom_css_file($options, $filesystem);
	react_generate_palette_css_file($options, $filesystem);
	react_generate_woocommerce_css_file($options, $filesystem);

	if ($options['advanced_combine_css']) {
		react_generate_combined_css_file($options, $filesystem);
	}

	if ($options['advanced_combine_js']) {
		react_generate_combined_js_file($options, $filesystem);
	}
}

/**
 * Sanitize the theme options
 *
 * @param   array  $options
 * @return  array
 */
function react_sanitize_options($options)
{
	// Design
	$options['contrast_lighter'] = react_clamp(intval($options['contrast_lighter']), 0, 4);
	$options['contrast_darker'] = react_clamp(intval($options['contrast_darker']), 0, 4);
	$options['contrast_reverse'] = !empty($options['contrast_reverse']);
	$options['show_popdown_desktop'] = !empty($options['show_popdown_desktop']);
	$options['show_popdown_phone'] = !empty($options['show_popdown_phone']);
	$options['show_popdown_tablet'] = !empty($options['show_popdown_tablet']);
	$options['show_popdown_large'] = !empty($options['show_popdown_large']);
	$options['show_tophead_desktop'] = !empty($options['show_tophead_desktop']);
	$options['show_tophead_phone'] = !empty($options['show_tophead_phone']);
	$options['show_tophead_tablet'] = !empty($options['show_tophead_tablet']);
	$options['show_tophead_large'] = !empty($options['show_tophead_large']);
	$options['show_infomenu_desktop'] = !empty($options['show_infomenu_desktop']);
	$options['show_infomenu_phone'] = !empty($options['show_infomenu_phone']);
	$options['show_infomenu_tablet'] = !empty($options['show_infomenu_tablet']);
	$options['show_infomenu_large'] = !empty($options['show_infomenu_large']);
	$options['show_solonav_desktop'] = !empty($options['show_solonav_desktop']);
	$options['show_solonav_phone'] = !empty($options['show_solonav_phone']);
	$options['show_solonav_tablet'] = !empty($options['show_solonav_tablet']);
	$options['show_solonav_large'] = !empty($options['show_solonav_large']);
	$options['show_intro_desktop'] = !empty($options['show_intro_desktop']);
	$options['show_intro_phone'] = !empty($options['show_intro_phone']);
	$options['show_intro_tablet'] = !empty($options['show_intro_tablet']);
	$options['show_intro_large'] = !empty($options['show_intro_large']);
	$options['show_subfooter_desktop'] = !empty($options['show_subfooter_desktop']);
	$options['show_subfooter_phone'] = !empty($options['show_subfooter_phone']);
	$options['show_subfooter_tablet'] = !empty($options['show_subfooter_tablet']);
	$options['show_subfooter_large'] = !empty($options['show_subfooter_large']);
	$options['element_rounded_corners'] = react_clamp(intval($options['element_rounded_corners']), 0, 10);
	$options['page_rounded_corners'] = react_clamp(intval($options['page_rounded_corners']), 0, 20);
	$options['page_animated'] = sanitize_text_field($options['page_animated']);
	$options['page_animated_delay'] = react_clamp(intval($options['page_animated_delay']), 0, 3000);
	$options['page_layout'] = sanitize_text_field($options['page_layout']);
	$options['page_layout_max_width'] = react_clamp(intval($options['page_layout_max_width']), 600, 2500);
	$options['page_layout_max_width_large'] = react_clamp(intval($options['page_layout_max_width_large']), 600, 2500);
	$options['page_layout_left_margin_box_only'] = !empty($options['page_layout_left_margin_box_only']);
	$options['page_layout_left_margin'] = react_clamp(intval($options['page_layout_left_margin']), -1, 201);
	$options['page_layout_left_margin_phones'] = react_clamp(intval($options['page_layout_left_margin_phones']), -1, 201);
	$options['page_layout_left_margin_tablets'] = react_clamp(intval($options['page_layout_left_margin_tablets']), -1, 201);
	$options['page_layout_right_margin_box_only'] = !empty($options['page_layout_right_margin_box_only']);
	$options['page_layout_right_margin'] = react_clamp(intval($options['page_layout_right_margin']), -1, 201);
	$options['page_layout_right_margin_phones'] = react_clamp(intval($options['page_layout_right_margin_phones']), -1, 201);
	$options['page_layout_right_margin_tablets'] = react_clamp(intval($options['page_layout_right_margin_tablets']), -1, 201);
	$options['page_layout_sections_margin'] = react_clamp(intval($options['page_layout_sections_margin']), 0, 1000);
	$options['page_layout_sections_margin_phones'] = react_clamp(intval($options['page_layout_sections_margin_phones']), 0, 1000);
	$options['page_layout_sections_margin_tablets'] = react_clamp(intval($options['page_layout_sections_margin_tablets']), 0, 1000);
	$options['page_layout_sections_margin_tv'] = react_clamp(intval($options['page_layout_sections_margin_tv']), 0, 1500);
	$options['page_layout_top_margin_choose'] = sanitize_text_field($options['page_layout_top_margin_choose']);
	$options['page_layout_top_margin'] = react_clamp(intval($options['page_layout_top_margin']), 0, 1000);
	$options['page_layout_top_margin_phones_choose'] = sanitize_text_field($options['page_layout_top_margin_phones_choose']);
	$options['page_layout_top_margin_phones'] = react_clamp(intval($options['page_layout_top_margin_phones']), 0, 1000);
	$options['page_layout_top_margin_tablets_choose'] = sanitize_text_field($options['page_layout_top_margin_tablets_choose']);
	$options['page_layout_top_margin_tablets'] = react_clamp(intval($options['page_layout_top_margin_tablets']), 0, 1000);
	$options['page_layout_top_margin_tv_choose'] = sanitize_text_field($options['page_layout_top_margin_tv_choose']);
	$options['page_layout_top_margin_tv'] = react_clamp(intval($options['page_layout_top_margin_tv']), 0, 1500);
	$options['page_layout_bottom_margin_choose'] = sanitize_text_field($options['page_layout_bottom_margin_choose']);
	$options['page_layout_bottom_margin'] = react_clamp(intval($options['page_layout_bottom_margin']), 0, 500);
	$options['page_layout_bottom_margin_phones_choose'] = sanitize_text_field($options['page_layout_bottom_margin_phones_choose']);
	$options['page_layout_bottom_margin_phones'] = react_clamp(intval($options['page_layout_bottom_margin_phones']), 0, 500);
	$options['page_layout_bottom_margin_tablets_choose'] = sanitize_text_field($options['page_layout_bottom_margin_tablets_choose']);
	$options['page_layout_bottom_margin_tablets'] = react_clamp(intval($options['page_layout_bottom_margin_tablets']), 0, 500);
	$options['page_layout_bottom_margin_tv_choose'] = sanitize_text_field($options['page_layout_bottom_margin_tv_choose']);
	$options['page_layout_bottom_margin_tv'] = react_clamp(intval($options['page_layout_bottom_margin_tv']), 0, 500);
	$options['page_layout_stretched_allheader'] = !empty($options['page_layout_stretched_allheader']);
	$options['page_layout_stretched_content'] = !empty($options['page_layout_stretched_content']);
	$options['page_layout_stretched_top'] = !empty($options['page_layout_stretched_top']);
	$options['page_layout_stretched_subfoot'] = !empty($options['page_layout_stretched_subfoot']);
	$options['page_layout_stretched_allfoot'] = !empty($options['page_layout_stretched_allfoot']);
	$options['page_layout_stretched_subfoot_boxed_content'] = !empty($options['page_layout_stretched_subfoot_boxed_content']);
	$options['page_layout_stretched_allfoot_boxed_content'] = !empty($options['page_layout_stretched_allfoot_boxed_content']);
	$options['page_layout_stretched_top_boxed_content'] = !empty($options['page_layout_stretched_top_boxed_content']);
	$options['page_layout_stretched_allheader_boxed_content'] = !empty($options['page_layout_stretched_allheader_boxed_content']);
	$options['page_layout_stretched_content_boxed_content'] = !empty($options['page_layout_stretched_content_boxed_content']);
	$options['page_layout_stretched_content_boxed_intro'] = !empty($options['page_layout_stretched_content_boxed_intro']);
	$options['page_layout_subfoot_right_padding'] = react_clamp(intval($options['page_layout_subfoot_right_padding']), 0, 500);
	$options['page_layout_subfoot_right_padding_phones'] = react_clamp(intval($options['page_layout_subfoot_right_padding_phones']), 0, 500);
	$options['page_layout_subfoot_right_padding_tablets'] = react_clamp(intval($options['page_layout_subfoot_right_padding_tablets']), 0, 500);
	$options['page_layout_subfoot_right_padding_tv'] = react_clamp(intval($options['page_layout_subfoot_right_padding_tv']), 0, 500);
	$options['page_layout_tophead_right_padding'] = react_clamp(intval($options['page_layout_tophead_right_padding']), 0, 500);
	$options['page_layout_tophead_right_padding_phones'] = react_clamp(intval($options['page_layout_tophead_right_padding_phones']), 0, 500);
	$options['page_layout_tophead_right_padding_tablets'] = react_clamp(intval($options['page_layout_tophead_right_padding_tablets']), 0, 500);
	$options['page_layout_tophead_right_padding_tv'] = react_clamp(intval($options['page_layout_tophead_right_padding_tv']), 0, 500);
	$options['page_layout_header_right_padding'] = react_clamp(intval($options['page_layout_header_right_padding']), 0, 500);
	$options['page_layout_header_right_padding_phones'] = react_clamp(intval($options['page_layout_header_right_padding_phones']), 0, 500);
	$options['page_layout_header_right_padding_tablets'] = react_clamp(intval($options['page_layout_header_right_padding_tablets']), 0, 500);
	$options['page_layout_header_right_padding_tv'] = react_clamp(intval($options['page_layout_header_right_padding_tv']), 0, 500);

	// General
	$options['general_logo'] = sanitize_text_field($options['general_logo']);
	$options['general_logo_image_width'] = is_numeric($options['general_logo_image_width']) ? absint($options['general_logo_image_width']) : '';
	$options['general_logo_image_height'] = is_numeric($options['general_logo_image_height']) ? absint($options['general_logo_image_height']) : '';
	$options['general_logo_double'] = sanitize_text_field($options['general_logo_double']);
	$options['general_logo_url'] = sanitize_text_field($options['general_logo_url']);
	$options['general_logo_top'] = react_clamp(intval($options['general_logo_top']), -200, 200);
	$options['general_logo_left'] = react_clamp(intval($options['general_logo_left']), -200, 200);
	$options['general_logo_on_right'] = !empty($options['general_logo_on_right']);
	$options['general_logo_above'] = !empty($options['general_logo_above']);
	$options['general_logo_width'] = react_clamp(intval($options['general_logo_width']), 0, 800);
	$options['general_logo_title'] = sanitize_text_field($options['general_logo_title']);
	$options['general_logo_alt'] = sanitize_text_field($options['general_logo_alt']);
	$options['general_logo_strapline'] = sanitize_text_field($options['general_logo_strapline']);
	$options['general_logo_strapline_left'] = sanitize_text_field($options['general_logo_strapline_left']);
	$options['general_logo_strapline_bottom'] = sanitize_text_field($options['general_logo_strapline_bottom']);
	$options['general_logo_strapline_highlighted'] = !empty($options['general_logo_strapline_highlighted']);
	$options['general_logo_alternative'] = sanitize_text_field($options['general_logo_alternative']);
	$options['general_logo_alternative_image_width'] = is_numeric($options['general_logo_alternative_image_width']) ? absint($options['general_logo_alternative_image_width']) : '';
	$options['general_logo_alternative_image_height'] = is_numeric($options['general_logo_alternative_image_height']) ? absint($options['general_logo_alternative_image_height']) : '';
	$options['general_logo_alternative_double'] = sanitize_text_field($options['general_logo_alternative_double']);
	$options['general_logo_convert_absolute'] = !empty($options['general_logo_convert_absolute']);
	$options['general_favicon'] = sanitize_text_field($options['general_favicon']);
	$options['general_favicon_generate'] = !empty($options['general_favicon_generate']);
	$options['general_sticky_header'] = !empty($options['general_sticky_header']);
	$options['general_sticky_header_fullwidth'] = !empty($options['general_sticky_header_fullwidth']);
	$options['search_tag_cloud'] = !empty($options['search_tag_cloud']);
	$options['general_layout'] = sanitize_text_field($options['general_layout']);
	$options['general_read_more_text'] = sanitize_text_field($options['general_read_more_text']);
	$options['general_breadcrumbs'] = !empty($options['general_breadcrumbs']);
	$options['general_breadcrumbs_home_icon'] = !empty($options['general_breadcrumbs_home_icon']);
	$options['general_breadcrumbs_home_icon_style'] = sanitize_text_field($options['general_breadcrumbs_home_icon_style']);
	$options['general_font'] = sanitize_text_field($options['general_font']);
	$options['general_font_google_link'] = wp_kses($options['general_font_google_link'], array('link' => array('href' => array(), 'rel' => array(), 'type' => array())));
	$options['general_font_google_family'] = sanitize_text_field($options['general_font_google_family']);
	$options['general_font_selector'] = sanitize_text_field($options['general_font_selector']);
	$options['general_font_fullscreen'] = !empty($options['general_font_fullscreen']);
	$options['general_font_portfolio'] = !empty($options['general_font_portfolio']);
	$options['general_font_serene'] = !empty($options['general_font_serene']);
	$options['general_font_fancybox'] = !empty($options['general_font_fancybox']);
	$options['general_heading_size'] = sanitize_text_field($options['general_heading_size']);
	$options['general_font_text'] = sanitize_text_field($options['general_font_text']);
	$options['general_font_text_google_link'] = wp_kses($options['general_font_text_google_link'], array('link' => array('href' => array(), 'rel' => array(), 'type' => array())));
	$options['general_font_text_google_family'] = sanitize_text_field($options['general_font_text_google_family']);
	$options['general_font_text_selector'] = sanitize_text_field($options['general_font_text_selector']);
	$options['general_font_size'] = react_clamp(intval($options['general_font_size']), 10, 17);
	$options['general_heading_spacing'] = react_clamp(intval($options['general_heading_spacing']), -5, 9);
	$options['sidebar_boxed_style'] = !empty($options['sidebar_boxed_style']);
	$options['popdown_boxed_style'] = !empty($options['popdown_boxed_style']);
	$options['footer_boxed_style'] = !empty($options['footer_boxed_style']);
	$options['general_font_h1_up'] = !empty($options['general_font_h1_up']);
	$options['general_font_h1_fw'] = is_numeric($options['general_font_h1_fw']) ? intval($options['general_font_h1_fw']) : '';
	$options['general_font_h1_space'] = react_clamp(intval($options['general_font_h1_space']), -5, 15);
	$options['general_font_h1_size'] = react_clamp(intval($options['general_font_h1_size']), 0, 150);
	$options['general_font_h1_mobile_friendly_size'] = react_clamp(intval($options['general_font_h1_mobile_friendly_size']), 0, 40);
	$options['general_font_h2_up'] = !empty($options['general_font_h2_up']);
	$options['general_font_h2_fw'] = is_numeric($options['general_font_h2_fw']) ? intval($options['general_font_h2_fw']) : '';
	$options['general_font_h2_space'] = react_clamp(intval($options['general_font_h2_space']), -5, 15);
	$options['general_font_h2_size'] = react_clamp(intval($options['general_font_h2_size']), 0, 150);
	$options['general_font_h2_mobile_friendly_size'] = react_clamp(intval($options['general_font_h2_mobile_friendly_size']), 0, 40);
	$options['general_font_h3_up'] = !empty($options['general_font_h3_up']);
	$options['general_font_h3_fw'] = is_numeric($options['general_font_h3_fw']) ? intval($options['general_font_h3_fw']) : '';
	$options['general_font_h3_space'] = react_clamp(intval($options['general_font_h3_space']), -5, 15);
	$options['general_font_h3_size'] = react_clamp(intval($options['general_font_h3_size']), 0, 150);
	$options['general_font_h3_mobile_friendly_size'] = react_clamp(intval($options['general_font_h3_mobile_friendly_size']), 0, 40);
	$options['general_font_h4_up'] = !empty($options['general_font_h4_up']);
	$options['general_font_h4_fw'] = is_numeric($options['general_font_h4_fw']) ? intval($options['general_font_h4_fw']) : '';
	$options['general_font_h4_space'] = react_clamp(intval($options['general_font_h4_space']), -5, 15);
	$options['general_font_h4_size'] = react_clamp(intval($options['general_font_h4_size']), 0, 150);
	$options['general_font_h4_mobile_friendly_size'] = react_clamp(intval($options['general_font_h4_mobile_friendly_size']), 0, 40);
	$options['general_font_h5_up'] = !empty($options['general_font_h5_up']);
	$options['general_font_h5_fw'] = is_numeric($options['general_font_h5_fw']) ? intval($options['general_font_h5_fw']) : '';
	$options['general_font_h5_space'] = react_clamp(intval($options['general_font_h5_space']), -5, 15);
	$options['general_font_h5_size'] = react_clamp(intval($options['general_font_h5_size']), 0, 150);
	$options['general_font_h5_mobile_friendly_size'] = react_clamp(intval($options['general_font_h5_mobile_friendly_size']), 0, 40);
	$options['general_font_intro_up'] = !empty($options['general_font_intro_up']);
	$options['general_font_intro_fw'] = is_numeric($options['general_font_intro_fw']) ? intval($options['general_font_intro_fw']) : '';
	$options['general_font_intro_space'] = react_clamp(intval($options['general_font_intro_space']), -5, 15);
	$options['general_font_intro_size'] = react_clamp(intval($options['general_font_intro_size']), 0, 150);
	$options['general_font_intro_mobile_friendly_size'] = react_clamp(intval($options['general_font_intro_mobile_friendly_size']), 0, 40);
	$options['general_font_intro_sub_up'] = !empty($options['general_font_intro_sub_up']);
	$options['general_font_intro_sub_fw'] = is_numeric($options['general_font_intro_sub_fw']) ? intval($options['general_font_intro_sub_fw']) : '';
	$options['general_font_intro_sub_space'] = react_clamp(intval($options['general_font_intro_sub_space']), -5, 15);
	$options['general_font_intro_sub_size'] = react_clamp(intval($options['general_font_intro_sub_size']), 0, 150);
	$options['general_font_intro_sub_mobile_friendly_size'] = react_clamp(intval($options['general_font_intro_sub_mobile_friendly_size']), 0, 40);
	$options['general_font_general_buttons_up'] = !empty($options['general_font_general_buttons_up']);
	$options['general_font_general_buttons_fw'] = is_numeric($options['general_font_general_buttons_fw']) ? intval($options['general_font_general_buttons_fw']) : '';
	$options['general_font_general_buttons_space'] = react_clamp(intval($options['general_font_general_buttons_space']), -5, 15);
	$options['general_font_general_buttons_size'] = react_clamp(intval($options['general_font_general_buttons_size']), 0, 22);

	// Default colors
	$options['general_color_text'] = react_sanitize_color($options['general_color_text']);
	$options['general_color_text_alt'] = react_sanitize_color($options['general_color_text_alt']);
	$options['general_color_links'] = react_sanitize_color($options['general_color_links']);
	$options['general_color_links_lighter'] = react_sanitize_color($options['general_color_links_lighter']);
	$options['general_color_links_darker'] = react_sanitize_color($options['general_color_links_darker']);
	$options['general_color_links_hover'] = react_sanitize_color($options['general_color_links_hover']);
	$options['general_color_links_hover_lighter'] = react_sanitize_color($options['general_color_links_hover_lighter']);
	$options['general_color_links_hover_darker'] = react_sanitize_color($options['general_color_links_hover_darker']);
	$options['general_color_blog_icon_default_bg'] = react_sanitize_color($options['general_color_blog_icon_default_bg']);
	$options['general_color_blog_icon_default_fg'] = react_sanitize_color($options['general_color_blog_icon_default_fg']);
	$options['general_color_blog_icon_aside_bg'] = react_sanitize_color($options['general_color_blog_icon_aside_bg']);
	$options['general_color_blog_icon_aside_fg'] = react_sanitize_color($options['general_color_blog_icon_aside_fg']);
	$options['general_color_blog_icon_audio_bg'] = react_sanitize_color($options['general_color_blog_icon_audio_bg']);
	$options['general_color_blog_icon_audio_fg'] = react_sanitize_color($options['general_color_blog_icon_audio_fg']);
	$options['general_color_blog_icon_link_bg'] = react_sanitize_color($options['general_color_blog_icon_link_bg']);
	$options['general_color_blog_icon_link_fg'] = react_sanitize_color($options['general_color_blog_icon_link_fg']);
	$options['general_color_blog_icon_gallery_bg'] = react_sanitize_color($options['general_color_blog_icon_gallery_bg']);
	$options['general_color_blog_icon_gallery_fg'] = react_sanitize_color($options['general_color_blog_icon_gallery_fg']);
	$options['general_color_blog_icon_quote_bg'] = react_sanitize_color($options['general_color_blog_icon_quote_bg']);
	$options['general_color_blog_icon_quote_fg'] = react_sanitize_color($options['general_color_blog_icon_quote_fg']);
	$options['general_color_blog_icon_status_bg'] = react_sanitize_color($options['general_color_blog_icon_status_bg']);
	$options['general_color_blog_icon_status_fg'] = react_sanitize_color($options['general_color_blog_icon_status_fg']);
	$options['general_color_blog_icon_image_bg'] = react_sanitize_color($options['general_color_blog_icon_image_bg']);
	$options['general_color_blog_icon_image_fg'] = react_sanitize_color($options['general_color_blog_icon_image_fg']);
	$options['general_color_blog_icon_video_bg'] = react_sanitize_color($options['general_color_blog_icon_video_bg']);
	$options['general_color_blog_icon_video_fg'] = react_sanitize_color($options['general_color_blog_icon_video_fg']);
	$options['general_color_blog_icon_chat_bg'] = react_sanitize_color($options['general_color_blog_icon_chat_bg']);
	$options['general_color_blog_icon_chat_fg'] = react_sanitize_color($options['general_color_blog_icon_chat_fg']);
	$options['general_color_page_loader'] = react_sanitize_color($options['general_color_page_loader']);
	$options['general_color_page_loader_bg'] = react_sanitize_color($options['general_color_page_loader_bg']);
	$options['general_color_red_bg'] = react_sanitize_color($options['general_color_red_bg']);
	$options['general_color_red_fg'] = react_sanitize_color($options['general_color_red_fg']);
	$options['general_color_h1'] = react_sanitize_color($options['general_color_h1']);
	$options['general_color_h2'] = react_sanitize_color($options['general_color_h2']);
	$options['general_color_h3'] = react_sanitize_color($options['general_color_h3']);
	$options['general_color_h4'] = react_sanitize_color($options['general_color_h4']);
	$options['general_color_h5'] = react_sanitize_color($options['general_color_h5']);
	$options['general_color_global_primary_bg'] = react_sanitize_color($options['general_color_global_primary_bg']);
	$options['general_color_global_primary_bg_lighter'] = react_sanitize_color($options['general_color_global_primary_bg_lighter']);
	$options['general_color_global_primary_bg_even_darker'] = react_sanitize_color($options['general_color_global_primary_bg_even_darker']);
	$options['general_color_global_primary_bg_much_darker'] = react_sanitize_color($options['general_color_global_primary_bg_much_darker']);
	$options['general_color_global_primary_bg_darker'] = react_sanitize_color($options['general_color_global_primary_bg_darker']);
	$options['general_color_global_primary_fg'] = react_sanitize_color($options['general_color_global_primary_fg']);
	$options['general_color_global_primary_icon'] = react_sanitize_color($options['general_color_global_primary_icon']);
	$options['general_color_global_dark_bg'] = react_sanitize_color($options['general_color_global_dark_bg']);
	$options['general_color_global_dark_bg_lighter'] = react_sanitize_color($options['general_color_global_dark_bg_lighter']);
	$options['general_color_global_dark_bg_even_lighter'] = react_sanitize_color($options['general_color_global_dark_bg_even_lighter']);
	$options['general_color_global_dark_bg_even_darker'] = react_sanitize_color($options['general_color_global_dark_bg_even_darker']);
	$options['general_color_global_dark_bg_much_darker'] = react_sanitize_color($options['general_color_global_dark_bg_much_darker']);
	$options['general_color_global_dark_bg_darker'] = react_sanitize_color($options['general_color_global_dark_bg_darker']);
	$options['general_color_global_dark_fg'] = react_sanitize_color($options['general_color_global_dark_fg']);
	$options['general_color_global_dark_icon'] = react_sanitize_color($options['general_color_global_dark_icon']);
	$options['general_color_global_light_bg'] = react_sanitize_color($options['general_color_global_light_bg']);
	$options['general_color_global_light_bg_lighter'] = react_sanitize_color($options['general_color_global_light_bg_lighter']);
	$options['general_color_global_light_bg_even_lighter'] = react_sanitize_color($options['general_color_global_light_bg_even_lighter']);
	$options['general_color_global_light_bg_even_darker'] = react_sanitize_color($options['general_color_global_light_bg_even_darker']);
	$options['general_color_global_light_bg_much_darker'] = react_sanitize_color($options['general_color_global_light_bg_much_darker']);
	$options['general_color_global_light_bg_darker'] = react_sanitize_color($options['general_color_global_light_bg_darker']);
	$options['general_color_global_light_fg'] = react_sanitize_color($options['general_color_global_light_fg']);
	$options['general_color_global_light_fg_even_darker'] = react_sanitize_color($options['general_color_global_light_fg_even_darker']);
	$options['general_color_global_light_fg_even_lighter'] = react_sanitize_color($options['general_color_global_light_fg_even_lighter']);
	$options['general_color_global_light_icon'] = react_sanitize_color($options['general_color_global_light_icon']);
	$options['general_color_topheader_background'] = react_sanitize_color($options['general_color_topheader_background']);
	$options['general_color_topheader_background_lighter'] = react_sanitize_color($options['general_color_topheader_background_lighter']);
	$options['general_color_topheader_background_darker'] = react_sanitize_color($options['general_color_topheader_background_darker']);
	$options['general_color_topheader_background_much_darker'] = react_sanitize_color($options['general_color_topheader_background_much_darker']);
	$options['general_color_topheader_border'] = react_sanitize_color($options['general_color_topheader_border']);
	$options['general_color_topheader_border_lr'] = react_sanitize_color($options['general_color_topheader_border_lr']);
	$options['general_color_topheader_text'] = react_sanitize_color($options['general_color_topheader_text']);
	$options['general_color_topheader_icon'] = react_sanitize_color($options['general_color_topheader_icon']);
	$options['general_color_topheader_icon_hover'] = react_sanitize_color($options['general_color_topheader_icon_hover']);
	$options['general_color_topheader_nav_text'] = react_sanitize_color($options['general_color_topheader_nav_text']);
	$options['general_color_topheader_nav_text_hover'] = react_sanitize_color($options['general_color_topheader_nav_text_hover']);
	$options['general_color_topheader_buttonnav_text'] = react_sanitize_color($options['general_color_topheader_buttonnav_text']);
	$options['general_color_topheader_buttonnav_text_hover'] = react_sanitize_color($options['general_color_topheader_buttonnav_text_hover']);
	$options['general_color_topheader_buttonnav_background'] = react_sanitize_color($options['general_color_topheader_buttonnav_background']);
	$options['general_color_topheader_buttonnav_background_darken'] = react_sanitize_color($options['general_color_topheader_buttonnav_background_darken']);
	$options['general_color_topheader_buttonnav_background_hover'] = react_sanitize_color($options['general_color_topheader_buttonnav_background_hover']);
	$options['general_color_topheader_buttonnav_border'] = react_sanitize_color($options['general_color_topheader_buttonnav_border']);
	$options['general_color_topheader_buttonnav_border_hover'] = react_sanitize_color($options['general_color_topheader_buttonnav_border_hover']);
	$options['general_color_mainheader_background'] = react_sanitize_color($options['general_color_mainheader_background']);
	$options['general_color_mainheader_background_lighter'] = react_sanitize_color($options['general_color_mainheader_background_lighter']);
	$options['general_color_mainheader_background_darker'] = react_sanitize_color($options['general_color_mainheader_background_darker']);
	$options['general_color_mainheader_background_much_darker'] = react_sanitize_color($options['general_color_mainheader_background_much_darker']);
	$options['general_color_mainheader_border'] = react_sanitize_color($options['general_color_mainheader_border']);
	$options['general_color_mainheader_border_lr'] = react_sanitize_color($options['general_color_mainheader_border_lr']);
	$options['general_color_mainheader_strapline'] = react_sanitize_color($options['general_color_mainheader_strapline']);
	$options['general_color_stickyhead_border'] = react_sanitize_color($options['general_color_stickyhead_border']);
	$options['general_color_stickyhead_background'] = react_sanitize_color($options['general_color_stickyhead_background']);
	$options['general_color_infomenu_background'] = react_sanitize_color($options['general_color_infomenu_background']);
	$options['general_color_infomenu_background_even_darker'] = react_sanitize_color($options['general_color_infomenu_background_even_darker']);
	$options['general_color_infomenu_background_hover'] = react_sanitize_color($options['general_color_infomenu_background_hover']);
	$options['general_color_infomenu_border'] = react_sanitize_color($options['general_color_infomenu_border']);
	$options['general_color_infomenu_popout_choose_scheme'] = is_numeric($options['general_color_infomenu_popout_choose_scheme']) ? absint($options['general_color_infomenu_popout_choose_scheme']) : '';
	$options['general_color_infomenu_slideout_choose_scheme'] = is_numeric($options['general_color_infomenu_slideout_choose_scheme']) ? absint($options['general_color_infomenu_slideout_choose_scheme']) : '';
	$options['general_color_infomenu_background_active'] = react_sanitize_color($options['general_color_infomenu_background_active']);
	$options['general_color_default_buttonnav_text'] = react_sanitize_color($options['general_color_default_buttonnav_text']);
	$options['general_color_default_buttonnav_text_hover'] = react_sanitize_color($options['general_color_default_buttonnav_text_hover']);
	$options['general_color_default_buttonnav_desc'] = react_sanitize_color($options['general_color_default_buttonnav_desc']);
	$options['general_color_default_buttonnav_desc_hover'] = react_sanitize_color($options['general_color_default_buttonnav_desc_hover']);
	$options['general_color_default_buttonnav_background'] = react_sanitize_color($options['general_color_default_buttonnav_background']);
	$options['general_color_default_buttonnav_background_darken'] = react_sanitize_color($options['general_color_default_buttonnav_background_darken']);
	$options['general_color_default_buttonnav_background_much_darker'] = react_sanitize_color($options['general_color_default_buttonnav_background_much_darker']);
	$options['general_color_default_buttonnav_background_hover'] = react_sanitize_color($options['general_color_default_buttonnav_background_hover']);
	$options['general_color_default_buttonnav_background_lighter'] = react_sanitize_color($options['general_color_default_buttonnav_background_lighter']);
	$options['general_color_default_buttonnav_background_hover_darken'] = react_sanitize_color($options['general_color_default_buttonnav_background_hover_darken']);
	$options['general_color_default_buttonnav_background_hover_lighter'] = react_sanitize_color($options['general_color_default_buttonnav_background_hover_lighter']);
	$options['general_color_default_buttonnav_border'] = react_sanitize_color($options['general_color_default_buttonnav_border']);
	$options['general_color_default_buttonnav_border_lighter'] = react_sanitize_color($options['general_color_default_buttonnav_border_lighter']);
	$options['general_color_default_buttonnav_border_hover'] = react_sanitize_color($options['general_color_default_buttonnav_border_hover']);
	$options['general_color_default_textnav_text'] = react_sanitize_color($options['general_color_default_textnav_text']);
	$options['general_color_default_textnav_text_hover'] = react_sanitize_color($options['general_color_default_textnav_text_hover']);
	$options['general_color_default_textnav_desc'] = react_sanitize_color($options['general_color_default_textnav_desc']);
	$options['general_color_default_textnav_desc_hover'] = react_sanitize_color($options['general_color_default_textnav_desc_hover']);
	$options['general_color_solonav_background'] = react_sanitize_color($options['general_color_solonav_background']);
	$options['general_color_solonav_background_darker'] = react_sanitize_color($options['general_color_solonav_background_darker']);
	$options['general_color_solonav_background_much_darker'] = react_sanitize_color($options['general_color_solonav_background_much_darker']);
	$options['general_color_solonav_background_lighter'] = react_sanitize_color($options['general_color_solonav_background_lighter']);
	$options['general_color_solonav_border'] = react_sanitize_color($options['general_color_solonav_border']);
	$options['general_color_solonav_border_lr'] = react_sanitize_color($options['general_color_solonav_border_lr']);
	$options['general_color_solonav_buttonnav_text'] = react_sanitize_color($options['general_color_solonav_buttonnav_text']);
	$options['general_color_solonav_buttonnav_text_hover'] = react_sanitize_color($options['general_color_solonav_buttonnav_text_hover']);
	$options['general_color_solonav_buttonnav_desc'] = react_sanitize_color($options['general_color_solonav_buttonnav_desc']);
	$options['general_color_solonav_buttonnav_desc_hover'] = react_sanitize_color($options['general_color_solonav_buttonnav_desc_hover']);
	$options['general_color_solonav_buttonnav_background'] = react_sanitize_color($options['general_color_solonav_buttonnav_background']);
	$options['general_color_solonav_buttonnav_background_darken'] = react_sanitize_color($options['general_color_solonav_buttonnav_background_darken']);
	$options['general_color_solonav_buttonnav_background_hover'] = react_sanitize_color($options['general_color_solonav_buttonnav_background_hover']);
	$options['general_color_solonav_buttonnav_border'] = react_sanitize_color($options['general_color_solonav_buttonnav_border']);
	$options['general_color_solonav_buttonnav_border_lighter'] = react_sanitize_color($options['general_color_solonav_buttonnav_border_lighter']);
	$options['general_color_solonav_buttonnav_border_hover'] = react_sanitize_color($options['general_color_solonav_buttonnav_border_hover']);
	$options['general_color_solonav_textnav_text'] = react_sanitize_color($options['general_color_solonav_textnav_text']);
	$options['general_color_solonav_textnav_text_hover'] = react_sanitize_color($options['general_color_solonav_textnav_text_hover']);
	$options['general_color_solonav_textnav_desc'] = react_sanitize_color($options['general_color_solonav_textnav_desc']);
	$options['general_color_solonav_textnav_desc_hover'] = react_sanitize_color($options['general_color_solonav_textnav_desc_hover']);
	$options['general_color_device_menu_background'] = react_sanitize_color($options['general_color_device_menu_background']);
	$options['general_color_device_menu_background_lighter'] = react_sanitize_color($options['general_color_device_menu_background_lighter']);
	$options['general_color_device_menu_background_darker'] = react_sanitize_color($options['general_color_device_menu_background_darker']);
	$options['general_color_device_menu_border'] = react_sanitize_color($options['general_color_device_menu_border']);
	$options['general_color_device_menu_icons'] = react_sanitize_color($options['general_color_device_menu_icons']);
	$options['general_color_device_menu_text'] = react_sanitize_color($options['general_color_device_menu_text']);
	$options['general_color_device_menu_text_even_lighter'] = react_sanitize_color($options['general_color_device_menu_text_even_lighter']);
	$options['general_color_device_menu_link'] = react_sanitize_color($options['general_color_device_menu_link']);
	$options['general_color_device_menu_link_hover'] = react_sanitize_color($options['general_color_device_menu_link_hover']);
	$options['general_color_device_menu_main_link'] = react_sanitize_color($options['general_color_device_menu_main_link']);
	$options['general_color_device_menu_main_link_hover'] = react_sanitize_color($options['general_color_device_menu_main_link_hover']);
	$options['general_color_device_menu_main_desc'] = react_sanitize_color($options['general_color_device_menu_main_desc']);
	$options['general_color_device_menu_main_desc_hover'] = react_sanitize_color($options['general_color_device_menu_main_desc_hover']);
	$options['general_color_device_menu_main_background'] = react_sanitize_color($options['general_color_device_menu_main_background']);
	$options['general_color_device_menu_main_background_lighter'] = react_sanitize_color($options['general_color_device_menu_main_background_lighter']);
	$options['general_color_device_menu_main_background_darker'] = react_sanitize_color($options['general_color_device_menu_main_background_darker']);
	$options['general_color_device_menu_sub_link'] = react_sanitize_color($options['general_color_device_menu_sub_link']);
	$options['general_color_device_menu_sub_link_hover'] = react_sanitize_color($options['general_color_device_menu_sub_link_hover']);
	$options['general_color_device_menu_sub_desc'] = react_sanitize_color($options['general_color_device_menu_sub_desc']);
	$options['general_color_device_menu_sub_desc_hover'] = react_sanitize_color($options['general_color_device_menu_sub_desc_hover']);
	$options['general_color_device_menu_sub_background'] = react_sanitize_color($options['general_color_device_menu_sub_background']);
	$options['general_color_device_menu_sub_background_lighter'] = react_sanitize_color($options['general_color_device_menu_sub_background_lighter']);
	$options['general_color_device_menu_sub_background_darker'] = react_sanitize_color($options['general_color_device_menu_sub_background_darker']);
	$options['general_color_intro_background'] = react_sanitize_color($options['general_color_intro_background']);
	$options['general_color_intro_background_even_darker'] = react_sanitize_color($options['general_color_intro_background_even_darker']);
	$options['general_color_intro_background_darker'] = react_sanitize_color($options['general_color_intro_background_darker']);
	$options['general_color_intro_border'] = react_sanitize_color($options['general_color_intro_border']);
	$options['general_color_intro_border_lr'] = react_sanitize_color($options['general_color_intro_border_lr']);
	$options['general_color_intro_h1'] = react_sanitize_color($options['general_color_intro_h1']);
	$options['general_color_intro_h2'] = react_sanitize_color($options['general_color_intro_h2']);
	$options['general_color_intro_links'] = react_sanitize_color($options['general_color_intro_links']);
	$options['general_color_intro_links_hover'] = react_sanitize_color($options['general_color_intro_links_hover']);
	$options['general_color_intro_text'] = react_sanitize_color($options['general_color_intro_text']);
	$options['general_color_intro_h2_icon'] = react_sanitize_color($options['general_color_intro_h2_icon']);
	$options['general_color_content_background'] = react_sanitize_color($options['general_color_content_background']);
	$options['general_color_content_background_much_lighter'] = react_sanitize_color($options['general_color_content_background_much_lighter']);
	$options['general_color_content_background_even_lighter'] = react_sanitize_color($options['general_color_content_background_even_lighter']);
	$options['general_color_content_background_lighter'] = react_sanitize_color($options['general_color_content_background_lighter']);
	$options['general_color_content_background_even_darker'] = react_sanitize_color($options['general_color_content_background_even_darker']);
	$options['general_color_content_background_darker'] = react_sanitize_color($options['general_color_content_background_darker']);
	$options['general_color_content_background_touch_darker'] = react_sanitize_color($options['general_color_content_background_touch_darker']);
	$options['general_color_content_background_much_darker'] = react_sanitize_color($options['general_color_content_background_much_darker']);
	$options['general_color_content_border'] = react_sanitize_color($options['general_color_content_border']);
	$options['general_color_content_border_lr'] = react_sanitize_color($options['general_color_content_border_lr']);
	$options['general_color_content_text'] = react_sanitize_color($options['general_color_content_text']);
	$options['general_color_content_text_even_darker'] = react_sanitize_color($options['general_color_content_text_even_darker']);
	$options['general_color_content_text_even_lighter'] = react_sanitize_color($options['general_color_content_text_even_lighter']);
	$options['general_color_content_text_alt'] = react_sanitize_color($options['general_color_content_text_alt']);
	$options['general_color_popdown_choose_scheme'] = is_numeric($options['general_color_popdown_choose_scheme']) ? absint($options['general_color_popdown_choose_scheme']) : '';
	$options['general_color_footer_choose_scheme'] = is_numeric($options['general_color_footer_choose_scheme']) ? absint($options['general_color_footer_choose_scheme']) : '';
	$options['general_color_subfooter_background'] = react_sanitize_color($options['general_color_subfooter_background']);
	$options['general_color_subfooter_text'] = react_sanitize_color($options['general_color_subfooter_text']);
	$options['general_color_subfooter_link'] = react_sanitize_color($options['general_color_subfooter_link']);
	$options['general_color_subfooter_link_hover'] = react_sanitize_color($options['general_color_subfooter_link_hover']);
	$options['general_color_content_icon_image'] = sanitize_text_field($options['general_color_content_icon_image']);
	$options['general_color_mainhead_submenu_choose_scheme'] = is_numeric($options['general_color_mainhead_submenu_choose_scheme']) ? absint($options['general_color_mainhead_submenu_choose_scheme']) : '';
	$options['general_color_tophead_submenu_choose_scheme'] = is_numeric($options['general_color_tophead_submenu_choose_scheme']) ? absint($options['general_color_tophead_submenu_choose_scheme']) : '';
	$options['general_color_solonav_submenu_choose_scheme'] = is_numeric($options['general_color_solonav_submenu_choose_scheme']) ? absint($options['general_color_solonav_submenu_choose_scheme']) : '';
	$options['general_color_slider_background'] = react_sanitize_color($options['general_color_slider_background']);
	$options['general_color_slider_background_much_darker'] = react_sanitize_color($options['general_color_slider_background_much_darker']);
	$options['general_color_slider_background_lighter'] = react_sanitize_color($options['general_color_slider_background_lighter']);
	$options['general_color_slider_controls_background'] = react_sanitize_color($options['general_color_slider_controls_background']);
	$options['general_color_slider_controls_background_much_darker'] = react_sanitize_color($options['general_color_slider_controls_background_much_darker']);
	$options['general_color_slider_controls_background_lighter'] = react_sanitize_color($options['general_color_slider_controls_background_lighter']);
	$options['general_color_slider_text'] = react_sanitize_color($options['general_color_slider_text']);
	$options['general_color_slider_border_lr'] = react_sanitize_color($options['general_color_slider_border_lr']);
	$options['general_color_slider_border'] = react_sanitize_color($options['general_color_slider_border']);
	$options['general_color_slider_dark_bg'] = react_sanitize_color($options['general_color_slider_dark_bg']);
	$options['general_color_slider_primary_bg'] = react_sanitize_color($options['general_color_slider_primary_bg']);
	$options['general_color_site_background'] = react_sanitize_color($options['general_color_site_background']);
	$options['general_color_site_background_even_lighter'] = react_sanitize_color($options['general_color_site_background_even_lighter']);
	$options['general_color_site_background_much_darker'] = react_sanitize_color($options['general_color_site_background_much_darker']);
	$options['general_color_site_background'] = react_sanitize_color($options['general_color_site_background']);
	$options['general_color_content_choose_scheme'] = is_numeric($options['general_color_content_choose_scheme']) ? absint($options['general_color_content_choose_scheme']) : '';
	$options['general_color_subfoot_choose_scheme'] = is_numeric($options['general_color_subfoot_choose_scheme']) ? absint($options['general_color_subfoot_choose_scheme']) : '';
	$options['footer_end_page_popout_choose_scheme'] = is_numeric($options['footer_end_page_popout_choose_scheme']) ? absint($options['footer_end_page_popout_choose_scheme']) : '';
	$options['sidebar_choose_scheme'] = is_numeric($options['sidebar_choose_scheme']) ? absint($options['sidebar_choose_scheme']) : '';

	$options['general_color_global_primary_icon_image'] = sanitize_text_field($options['general_color_global_primary_icon_image']);
	$options['general_color_topheader_nav_text_icon_image'] = sanitize_text_field($options['general_color_topheader_nav_text_icon_image']);
	$options['general_color_topheader_nav_buttonnav_icon_image'] = sanitize_text_field($options['general_color_topheader_nav_buttonnav_icon_image']);
	$options['general_color_infomenu_icon_image'] = sanitize_text_field($options['general_color_infomenu_icon_image']);
	$options['general_color_default_buttonnav_icon_image'] = sanitize_text_field($options['general_color_default_buttonnav_icon_image']);
	$options['general_color_default_textnav_icon_image'] = sanitize_text_field($options['general_color_default_textnav_icon_image']);
	$options['general_color_solonav_buttonnav_icon_image'] = sanitize_text_field($options['general_color_solonav_buttonnav_icon_image']);
	$options['general_color_solonav_textnav_icon_image'] = sanitize_text_field($options['general_color_solonav_textnav_icon_image']);
	$options['general_color_slider_icon_image'] = sanitize_text_field($options['general_color_slider_icon_image']);
	$options['general_color_slider_prime_icon_image'] = sanitize_text_field($options['general_color_slider_prime_icon_image']);
	$options['general_color_slider_dark_icon_image'] = sanitize_text_field($options['general_color_slider_dark_icon_image']);

	$options['general_color_site_background_gradient'] = !empty($options['general_color_site_background_gradient']);
	$options['general_color_global_primary_gradient'] = !empty($options['general_color_global_primary_gradient']);
	$options['general_color_global_light_gradient'] = !empty($options['general_color_global_light_gradient']);
	$options['general_color_global_dark_gradient'] = !empty($options['general_color_global_dark_gradient']);
	$options['general_color_topheader_background_gradient'] = !empty($options['general_color_topheader_background_gradient']);
	$options['general_color_topheader_buttonnav_gradient'] = !empty($options['general_color_topheader_buttonnav_gradient']);
	$options['general_color_mainheader_background_gradient'] = !empty($options['general_color_mainheader_background_gradient']);
	$options['general_color_default_buttonnav_gradient'] = !empty($options['general_color_default_buttonnav_gradient']);
	$options['general_color_solonav_background_gradient'] = !empty($options['general_color_solonav_background_gradient']);
	$options['general_color_solonav_buttonnav_gradient'] = !empty($options['general_color_solonav_buttonnav_gradient']);
	$options['general_color_slider_background_gradient'] = !empty($options['general_color_slider_background_gradient']);
	$options['general_color_slider_controls_background_gradient'] = !empty($options['general_color_slider_controls_background_gradient']);

	// Palette sanitization
	if (!is_array($options['custom_palettes'])) {
		$options['custom_palettes'] = array();
	}

	foreach ($options['custom_palettes'] as $key => $palette) {
		// Merge the saved options with default ones
		$palette = array_merge(react_get_default_palette_options(), $palette);

		$palette['id'] = absint($palette['id']);
		$palette['name'] = sanitize_text_field($palette['name']);
		$palette['background'] = react_sanitize_color($palette['background']);
		$palette['background_gradient'] = !empty($palette['background_gradient']);
		$palette['gradient_background_color'] = react_sanitize_color($palette['gradient_background_color']);
		$palette['gradient_orientation'] = react_sanitize_color($palette['gradient_orientation']);
		$palette['background_lighter'] = react_sanitize_color($palette['background_lighter']);
		$palette['background_darker'] = react_sanitize_color($palette['background_darker']);
		$palette['background_much_lighter'] = react_sanitize_color($palette['background_much_lighter']);
		$palette['background_even_lighter'] = react_sanitize_color($palette['background_even_lighter']);
		$palette['background_even_darker'] = react_sanitize_color($palette['background_even_darker']);
		$palette['background_touch_darker'] = react_sanitize_color($palette['background_touch_darker']);
		$palette['background_much_darker'] = react_sanitize_color($palette['background_much_darker']);
		$palette['background_icon_image'] = sanitize_text_field($palette['background_icon_image']);
		$palette['border'] = react_sanitize_color($palette['border']);
		$palette['border_lr'] = react_sanitize_color($palette['border_lr']);
		$palette['h1'] = react_sanitize_color($palette['h1']);
		$palette['h2'] = react_sanitize_color($palette['h2']);
		$palette['h3'] = react_sanitize_color($palette['h3']);
		$palette['h4'] = react_sanitize_color($palette['h4']);
		$palette['h5'] = react_sanitize_color($palette['h5']);
		$palette['text'] = react_sanitize_color($palette['text']);
		$palette['text_alt'] = react_sanitize_color($palette['text_alt']);
		$palette['link'] = react_sanitize_color($palette['link']);
		$palette['link_hover'] = react_sanitize_color($palette['link_hover']);
		$palette['primary_bg'] = react_sanitize_color($palette['primary_bg']);
		$palette['primary_bg_lighter'] = react_sanitize_color($palette['primary_bg_lighter']);
		$palette['primary_bg_darker'] = react_sanitize_color($palette['primary_bg_darker']);
		$palette['primary_bg_even_lighter'] = react_sanitize_color($palette['primary_bg_even_lighter']);
		$palette['primary_bg_even_darker'] = react_sanitize_color($palette['primary_bg_even_darker']);
		$palette['primary_bg_much_darker'] = react_sanitize_color($palette['primary_bg_much_darker']);
		$palette['primary_bg_gradient'] = !empty($palette['primary_bg_gradient']);
		$palette['primary_fg'] = react_sanitize_color($palette['primary_fg']);
		$palette['primary_icon'] = react_sanitize_color($palette['primary_icon']);
		$palette['primary_icon_image'] = sanitize_text_field($palette['primary_icon_image']);
		$palette['dark_bg'] = react_sanitize_color($palette['dark_bg']);
		$palette['dark_bg_lighter'] = react_sanitize_color($palette['dark_bg_lighter']);
		$palette['dark_bg_darker'] = react_sanitize_color($palette['dark_bg_darker']);
		$palette['dark_bg_even_lighter'] = react_sanitize_color($palette['dark_bg_even_lighter']);
		$palette['dark_bg_even_darker'] = react_sanitize_color($palette['dark_bg_even_darker']);
		$palette['dark_bg_much_darker'] = react_sanitize_color($palette['dark_bg_much_darker']);
		$palette['dark_bg_gradient'] = !empty($palette['dark_bg_gradient']);
		$palette['dark_fg'] = react_sanitize_color($palette['dark_fg']);
		$palette['dark_icon'] = react_sanitize_color($palette['dark_icon']);
		$palette['dark_icon_image'] = sanitize_text_field($palette['dark_icon_image']);
		$palette['light_bg'] = react_sanitize_color($palette['light_bg']);
		$palette['light_bg_lighter'] = react_sanitize_color($palette['light_bg_lighter']);
		$palette['light_bg_darker'] = react_sanitize_color($palette['light_bg_darker']);
		$palette['light_bg_even_lighter'] = react_sanitize_color($palette['light_bg_even_lighter']);
		$palette['light_bg_even_darker'] = react_sanitize_color($palette['light_bg_even_darker']);
		$palette['light_bg_much_darker'] = react_sanitize_color($palette['light_bg_much_darker']);
		$palette['light_bg_gradient'] = !empty($palette['light_bg_gradient']);
		$palette['light_fg'] = react_sanitize_color($palette['light_fg']);
		$palette['light_fg_even_lighter'] = react_sanitize_color($palette['light_fg_even_lighter']);
		$palette['light_fg_even_darker'] = react_sanitize_color($palette['light_fg_even_darker']);
		$palette['light_icon'] = react_sanitize_color($palette['light_icon']);
		$palette['light_icon_image'] = sanitize_text_field($palette['light_icon_image']);
	}

	// Backgrounds
	if (!is_array($options['background_groups'])) {
		$options['background_groups'] = array();
	}

	foreach ($options['background_groups'] as $groupId => $group) {
		$options['background_groups'][$groupId]['name'] = sanitize_text_field($options['background_groups'][$groupId]['name']);

		if (!is_array($options['background_groups'][$groupId]['backgrounds'])) {
			$options['background_groups'][$groupId]['backgrounds'] = array();
		}

		foreach ($options['background_groups'][$groupId]['backgrounds'] as $key => $background) {
			$options['background_groups'][$groupId]['backgrounds'][$key]['image'] = sanitize_text_field($options['background_groups'][$groupId]['backgrounds'][$key]['image']);
			$options['background_groups'][$groupId]['backgrounds'][$key]['width'] = absint($options['background_groups'][$groupId]['backgrounds'][$key]['width']);
			$options['background_groups'][$groupId]['backgrounds'][$key]['height'] = absint($options['background_groups'][$groupId]['backgrounds'][$key]['height']);
			$options['background_groups'][$groupId]['backgrounds'][$key]['orientation'] = sanitize_text_field($options['background_groups'][$groupId]['backgrounds'][$key]['orientation']);
			$options['background_groups'][$groupId]['backgrounds'][$key]['title'] = sanitize_text_field($options['background_groups'][$groupId]['backgrounds'][$key]['title']);
			$options['background_groups'][$groupId]['backgrounds'][$key]['caption'] = wp_kses_post($options['background_groups'][$groupId]['backgrounds'][$key]['caption']);
			$options['background_groups'][$groupId]['backgrounds'][$key]['captionPosition'] = sanitize_text_field($options['background_groups'][$groupId]['backgrounds'][$key]['captionPosition']);
		}
	}

	$options['background_phones'] = sanitize_text_field($options['background_phones']);
	$options['background_tablets'] = sanitize_text_field($options['background_tablets']);
	$options['background_desktops'] = sanitize_text_field($options['background_desktops']);
	$options['background_large'] = sanitize_text_field($options['background_large']);

	$options['background_video'] = sanitize_text_field($options['background_video']);
	$options['background_video_width'] = is_numeric($options['background_video_width']) ? intval($options['background_video_width']) : '';
	$options['background_video_height'] = is_numeric($options['background_video_height']) ? intval($options['background_video_height']) : '';
	$options['background_video_start'] = absint($options['background_video_start']);
	$options['background_video_autostart'] = !empty($options['background_video_autostart']);
	$options['background_video_mute'] = !empty($options['background_video_mute']);
	$options['background_video_complete'] = sanitize_text_field($options['background_video_complete']);
	$options['background_video_redirect'] = sanitize_text_field($options['background_video_redirect']);
	$options['background_video_full_screen'] = !empty($options['background_video_full_screen']);
	$options['background_video_full_screen_overlay'] = !empty($options['background_video_full_screen_overlay']);
	$options['background_video_tablet'] = !empty($options['background_video_tablet']);
	$options['background_video_mobile'] = !empty($options['background_video_mobile']);

	if (!is_array($options['background_audio'])) {
		$options['background_audio'] = array();
	}

	foreach ($options['background_audio'] as $key => $audio) {
		$options['background_audio'][$key]['id'] = absint($options['background_audio'][$key]['id']);
		$options['background_audio'][$key]['name'] = sanitize_text_field($options['background_audio'][$key]['name']);
		$options['background_audio'][$key]['m4a'] = sanitize_text_field($options['background_audio'][$key]['m4a']);
		$options['background_audio'][$key]['mp3'] = sanitize_text_field($options['background_audio'][$key]['mp3']);
		$options['background_audio'][$key]['oga'] = sanitize_text_field($options['background_audio'][$key]['oga']);
	}

	$options['background_audio_random'] = !empty($options['background_audio_random']);
	$options['background_audio_autostart'] = !empty($options['background_audio_autostart']);
	$options['background_audio_complete'] = sanitize_text_field($options['background_audio_complete']);

	$options['background_speed'] = react_clamp(intval($options['background_speed']), 500, 5000);
	$options['background_transition'] = sanitize_text_field($options['background_transition']);
	$options['background_position'] = sanitize_text_field($options['background_position']);
	$options['background_fit_landscape'] = !empty($options['background_fit_landscape']);
	$options['background_fit_portrait'] = !empty($options['background_fit_portrait']);
	$options['background_fit_always'] = !empty($options['background_fit_always']);
	$options['background_position_x'] = sanitize_text_field($options['background_position_x']);
	$options['background_position_y'] = sanitize_text_field($options['background_position_y']);
	$options['background_easing'] = sanitize_text_field($options['background_easing']);
	$options['background_hide_speed'] = react_clamp(intval($options['background_hide_speed']), 0, 5000);
	$options['background_show_speed'] = react_clamp(intval($options['background_show_speed']), 0, 5000);
	$options['background_control_speed'] = react_clamp(intval($options['background_control_speed']), 0, 5000);
	$options['background_save'] = !empty($options['background_save']);
	$options['background_slideshow'] = !empty($options['background_slideshow']);
	$options['background_slideshow_auto'] = !empty($options['background_slideshow_auto']);
	$options['background_slideshow_speed'] = react_clamp(intval($options['background_slideshow_speed']), 100, 30000);
	$options['background_random'] = !empty($options['background_random']);
	$options['background_keyboard'] = !empty($options['background_keyboard']);
	$options['background_caption_position'] = sanitize_text_field($options['background_caption_position']);
	$options['background_caption_speed'] = react_clamp(intval($options['background_caption_speed']), 0, 5000);
	$options['background_caption_overlay'] = sanitize_text_field($options['background_caption_overlay']);
	$options['background_caption_overlay_opacity'] = is_numeric($options['background_caption_overlay_opacity']) && in_array($options['background_caption_overlay_opacity'], array(0, 10, 20, 30, 40, 50, 60, 70, 80, 90)) ? $options['background_caption_overlay_opacity'] : 50;
	$options['background_caption_color'] = react_sanitize_color($options['background_caption_color']);
	$options['background_spinner_type'] = sanitize_text_field($options['background_spinner_type']);
	$options['background_spinner_color'] = react_sanitize_color($options['background_spinner_color']);
	$options['background_bullets'] = !empty($options['background_bullets']);
	$options['background_bullets_convert'] = sanitize_text_field($options['background_bullets_convert']);
	$options['background_bullets_convert_custom'] = react_clamp(intval($options['background_bullets_convert_custom']), 0, 5000);
	$options['background_low_quality'] = !empty($options['background_low_quality']);
	$options['background_breaker'] = !empty($options['background_breaker']);
	$options['background_breaker_on_max'] = !empty($options['background_breaker_on_max']);
	$options['background_always_show_captions'] = !empty($options['background_always_show_captions']);
	$options['background_always_show_captions_display'] = sanitize_text_field($options['background_always_show_captions_display']);

	// Background controls
	$options['controls_location_fs'] = sanitize_text_field($options['controls_location_fs']);
	$options['controls_location_video'] = sanitize_text_field($options['controls_location_video']);
	$options['controls_location_audio'] = sanitize_text_field($options['controls_location_audio']);
	$options['controls_location_fs_label'] = !empty($options['controls_location_fs_label']);
	$options['controls_location_video_label'] = !empty($options['controls_location_video_label']);
	$options['controls_location_audio_label'] = !empty($options['controls_location_audio_label']);

	// Pages
	$options['page_show_share'] = !empty($options['page_show_share']);
	$options['general_page_layout'] = sanitize_text_field($options['general_page_layout']);
	$options['page_single_featured_image'] = !empty($options['page_single_featured_image']);
	$options['page_single_featured_image_type'] = sanitize_text_field($options['page_single_featured_image_type']);
	$options['page_single_featured_height'] = react_clamp(intval($options['page_single_featured_height']), 0, 1500);
	$options['page_single_featured_height_tablet'] = react_clamp(intval($options['page_single_featured_height_tablet']), 0, 1500);
	$options['page_single_featured_height_phone'] = react_clamp(intval($options['page_single_featured_height_phone']), 0, 1500);
	$options['page_single_featured_float_width'] = react_clamp(intval($options['page_single_featured_float_width']), 10, 500);
	$options['page_single_featured_float_height'] = react_clamp(intval($options['page_single_featured_float_height']), 0, 500);
	$options['page_single_featured_link_image'] = !empty($options['page_single_featured_link_image']);
	$options['page_single_featured_like_image'] = !empty($options['page_single_featured_like_image']);
	$options['page_single_featured_like_image_icon'] = sanitize_text_field($options['page_single_featured_like_image_icon']);
	$options['page_featured_image'] = !empty($options['page_featured_image']);
	$options['page_featured_image_type'] = sanitize_text_field($options['page_featured_image_type']);
	$options['page_featured_height'] = react_clamp(intval($options['page_featured_height']), 0, 1500);
	$options['page_featured_height_tablet'] = react_clamp(intval($options['page_featured_height_tablet']), 0, 1500);
	$options['page_featured_height_phone'] = react_clamp(intval($options['page_featured_height_phone']), 0, 1500);
	$options['page_featured_float_width'] = react_clamp(intval($options['page_featured_float_width']), 10, 500);
	$options['page_featured_float_height'] = react_clamp(intval($options['page_featured_float_height']), 0, 500);
	$options['page_featured_like_image'] = !empty($options['page_featured_like_image']);
	$options['page_featured_like_image_icon'] = sanitize_text_field($options['page_featured_like_image_icon']);

	// Blog
	$options['blog_layout'] = sanitize_text_field($options['blog_layout']);
	$options['blog_single_layout'] = sanitize_text_field($options['blog_single_layout']);
	$options['blog_animation'] = sanitize_text_field($options['blog_animation']);
	$options['blog_show_date_circle'] = !empty($options['blog_show_date_circle']);
	$options['blog_show_like_count'] = !empty($options['blog_show_like_count']);
	$options['blog_show_comment_count'] = !empty($options['blog_show_comment_count']);
	$options['blog_show_cats'] = !empty($options['blog_show_cats']);
	$options['blog_show_tags'] = !empty($options['blog_show_tags']);
	$options['blog_show_cats_single'] = !empty($options['blog_show_cats_single']);
	$options['blog_show_tags_single'] = !empty($options['blog_show_tags_single']);
	$options['blog_show_author_bio_single'] = !empty($options['blog_show_author_bio_single']);
	$options['blog_comments_layout'] = sanitize_text_field($options['blog_comments_layout']);
	$options['blog_title'] = sanitize_text_field($options['blog_title']);
	$options['blog_subtitle'] = sanitize_text_field($options['blog_subtitle']);
	$options['blog_show_title_single'] = !empty($options['blog_show_title_single']);
	$options['blog_show_meta_above_content'] = !empty($options['blog_show_meta_above_content']);
	$options['blog_show_meta_intro_single'] = !empty($options['blog_show_meta_intro_single']);
	$options['blog_single_featured_image'] = !empty($options['blog_single_featured_image']);
	$options['blog_single_featured_image_type'] = sanitize_text_field($options['blog_single_featured_image_type']);
	$options['blog_single_featured_height'] = react_clamp(intval($options['blog_single_featured_height']), 0, 1500);
	$options['blog_single_featured_height_tablet'] = react_clamp(intval($options['blog_single_featured_height_tablet']), 0, 1500);
	$options['blog_single_featured_height_phone'] = react_clamp(intval($options['blog_single_featured_height_phone']), 0, 1500);
	$options['blog_single_featured_float_width'] = react_clamp(intval($options['blog_single_featured_float_width']), 10, 500);
	$options['blog_single_featured_float_height'] = react_clamp(intval($options['blog_single_featured_float_height']), 0, 500);
	$options['blog_single_featured_link_image'] = !empty($options['blog_single_featured_link_image']);
	$options['blog_single_featured_like_image'] = !empty($options['blog_single_featured_like_image']);
	$options['blog_single_featured_like_image_icon'] = sanitize_text_field($options['blog_single_featured_like_image_icon']);
	$options['blog_show_author_bio'] = !empty($options['blog_show_author_bio']);
	$options['blog_show_single_nav'] = !empty($options['blog_show_single_nav']);
	$options['blog_show_reply'] = !empty($options['blog_show_reply']);
	$options['blog_featured_image'] = !empty($options['blog_featured_image']);
	$options['blog_featured_image_type'] = sanitize_text_field($options['blog_featured_image_type']);
	$options['blog_featured_height'] = react_clamp(intval($options['blog_featured_height']), 0, 1500);
	$options['blog_featured_height_tablet'] = react_clamp(intval($options['blog_featured_height_tablet']), 0, 1500);
	$options['blog_featured_height_phone'] = react_clamp(intval($options['blog_featured_height_phone']), 0, 1500);
	$options['blog_featured_float_width'] = react_clamp(intval($options['blog_featured_float_width']), 10, 500);
	$options['blog_featured_float_height'] = react_clamp(intval($options['blog_featured_float_height']), 0, 500);
	$options['blog_featured_like_image'] = !empty($options['blog_featured_like_image']);
	$options['blog_featured_like_image_icon'] = sanitize_text_field($options['blog_featured_like_image_icon']);
	$options['blog_show_post_like'] = !empty($options['blog_show_post_like']);
	$options['blog_post_like_icon'] = sanitize_text_field($options['blog_post_like_icon']);
	$options['blog_boxed_style'] = !empty($options['blog_boxed_style']);
	$options['social_count_convert'] = sanitize_text_field($options['social_count_convert']);
	$options['social_count_convert_custom'] = react_clamp(intval($options['social_count_convert_custom']), 0, 5000);
	$options['blog_show_share'] = !empty($options['blog_show_share']);

	// Portfolio
	$options['portfolio_single_layout'] = sanitize_text_field($options['portfolio_single_layout']);
	$options['portfolio_layout'] = sanitize_text_field($options['portfolio_layout']);
	$options['portfolio_show_single_nav'] = !empty($options['portfolio_show_single_nav']);
	$options['portfolio_show_tags'] = !empty($options['portfolio_show_tags']);
	$options['portfolio_show_tags_single'] = !empty($options['portfolio_show_tags_single']);
	$options['portfolio_show_cats'] = !empty($options['portfolio_show_cats']);
	$options['portfolio_show_cats_single'] = !empty($options['portfolio_show_cats_single']);
	$options['portfolio_show_share'] = !empty($options['portfolio_show_share']);
	$options['portfolio_show_author_bio_single'] = !empty($options['portfolio_show_author_bio_single']);
	$options['portfolio_show_title_single'] = !empty($options['portfolio_show_title_single']);
	$options['portfolio_single_featured_image'] = !empty($options['portfolio_single_featured_image']);
	$options['portfolio_single_featured_image_type'] = sanitize_text_field($options['portfolio_single_featured_image_type']);
	$options['portfolio_single_featured_height'] = react_clamp(intval($options['portfolio_single_featured_height']), 0, 1500);
	$options['portfolio_single_featured_height_tablet'] = react_clamp(intval($options['portfolio_single_featured_height_tablet']), 0, 1500);
	$options['portfolio_single_featured_height_phone'] = react_clamp(intval($options['portfolio_single_featured_height_phone']), 0, 1500);
	$options['portfolio_single_featured_float_width'] = react_clamp(intval($options['portfolio_single_featured_float_width']), 10, 500);
	$options['portfolio_single_featured_float_height'] = react_clamp(intval($options['portfolio_single_featured_float_height']), 0, 500);
	$options['portfolio_single_featured_link_image'] = !empty($options['portfolio_single_featured_link_image']);
	$options['portfolio_single_featured_like_image'] = !empty($options['portfolio_single_featured_like_image']);
	$options['portfolio_single_featured_like_image_icon'] = sanitize_text_field($options['portfolio_single_featured_like_image_icon']);
	$options['portfolio_featured_image'] = !empty($options['portfolio_featured_image']);
	$options['portfolio_featured_image_type'] = sanitize_text_field($options['portfolio_featured_image_type']);
	$options['portfolio_featured_height'] = react_clamp(intval($options['portfolio_featured_height']), 0, 1500);
	$options['portfolio_featured_height_tablet'] = react_clamp(intval($options['portfolio_featured_height_tablet']), 0, 1500);
	$options['portfolio_featured_height_phone'] = react_clamp(intval($options['portfolio_featured_height_phone']), 0, 1500);
	$options['portfolio_featured_float_width'] = react_clamp(intval($options['portfolio_featured_float_width']), 10, 500);
	$options['portfolio_featured_float_height'] = react_clamp(intval($options['portfolio_featured_float_height']), 0, 500);
	$options['portfolio_featured_like_image'] = !empty($options['portfolio_featured_like_image']);
	$options['portfolio_featured_like_image_icon'] = sanitize_text_field($options['portfolio_featured_like_image_icon']);

	// Footer
	$options['footer_top_widget_area_layout'] = sanitize_text_field($options['footer_top_widget_area_layout']);
	$options['footer_top_columns_convert'] = sanitize_text_field($options['footer_top_columns_convert']);
	$options['footer_border'] = react_clamp(intval($options['footer_border']), 0, 20);
	$options['footer_padding'] = react_clamp(intval($options['footer_padding']), 0, 150);
	$options['above_footer_padding'] = react_clamp(intval($options['above_footer_padding']), 0, 150);
	$options['subfooter_padding'] = react_clamp(intval($options['subfooter_padding']), 5, 150);
	$options['footer_left_content'] = wp_kses_post($options['footer_left_content']);
	$options['footer_top_link'] = !empty($options['footer_top_link']);
	$options['footer_position'] = sanitize_text_field($options['footer_position']);
	$options['footer_convert'] = sanitize_text_field($options['footer_convert']);
	$options['footer_convert_custom'] = react_clamp(intval($options['footer_convert_custom']), 0, 5000);
	$options['footer_widget_area_layout'] = sanitize_text_field($options['footer_widget_area_layout']);
	$options['footer_columns_convert'] = sanitize_text_field($options['footer_columns_convert']);
	$options['footer_logo'] = sanitize_text_field($options['footer_logo']);
	$options['footer_logo_image_width'] = is_numeric($options['footer_logo_image_width']) ? intval($options['footer_logo_image_width']) : '';
	$options['footer_logo_image_height'] = is_numeric($options['footer_logo_image_height']) ? intval($options['footer_logo_image_height']) : '';
	$options['footer_logo_double'] = sanitize_text_field($options['footer_logo_double']);
	$options['show_footer_social_icon'] = !empty($options['show_footer_social_icon']);
	$options['footer_social_icon_type'] = sanitize_text_field($options['footer_social_icon_type']);
	$options['footer_social_icon_animation'] = sanitize_text_field($options['footer_social_icon_animation']);
	$options['footer_end_page_popout'] = wp_kses_post($options['footer_end_page_popout']);
	$options['footer_end_page_popout_cookie_expires'] = absint($options['footer_end_page_popout_cookie_expires']);
	$options['sub_footer_rtl'] = !empty($options['sub_footer_rtl']);
	$options['footer_reveal'] = !empty($options['footer_reveal']);
	$options['footer_reveal_help'] = !empty($options['footer_reveal_help']);
	$options['footer_reveal_height'] = react_clamp(intval($options['footer_reveal_height']), 0, 1000);
	$options['footer_reveal_minheight'] = react_clamp(intval($options['footer_reveal_minheight']), 0, 1000);

	// Header
	$options['go_down_link'] = !empty($options['go_down_link']);
	$options['go_down_link_location'] = sanitize_text_field($options['go_down_link_location']);
	$options['header_contact_phone'] = sanitize_text_field($options['header_contact_phone']);
	$options['header_contact_phone_icon'] = sanitize_text_field($options['header_contact_phone_icon']);
	$options['header_contact_phone_sales'] = sanitize_text_field($options['header_contact_phone_sales']);
	$options['header_contact_phone_sales_icon'] = sanitize_text_field($options['header_contact_phone_sales_icon']);
	$options['header_contact_phone_support'] = sanitize_text_field($options['header_contact_phone_support']);
	$options['header_contact_phone_support_icon'] = sanitize_text_field($options['header_contact_phone_support_icon']);
	$options['head_contact_quform_id'] = is_numeric($options['head_contact_quform_id']) ? absint($options['head_contact_quform_id']) : 'none';
	$options['head_contact_quform_id_trigger'] = sanitize_text_field($options['head_contact_quform_id_trigger']);
	$options['head_contact_quform_id_icon'] = sanitize_text_field($options['head_contact_quform_id_icon']);
	$options['head_contact_quform_id_sales'] = is_numeric($options['head_contact_quform_id_sales']) ? absint($options['head_contact_quform_id_sales']) : 'none';
	$options['head_contact_quform_id_sales_trigger'] = sanitize_text_field($options['head_contact_quform_id_sales_trigger']);
	$options['head_contact_quform_id_sales_icon'] = sanitize_text_field($options['head_contact_quform_id_sales_icon']);
	$options['head_contact_quform_id_support'] = is_numeric($options['head_contact_quform_id_support']) ? absint($options['head_contact_quform_id_support']) : 'none';
	$options['head_contact_quform_id_support_trigger'] = sanitize_text_field($options['head_contact_quform_id_support_trigger']);
	$options['head_contact_quform_id_support_icon'] = sanitize_text_field($options['head_contact_quform_id_support_icon']);
	$options['show_header_social_icon'] = !empty($options['show_header_social_icon']);
	$options['header_social_icon_type'] = sanitize_text_field($options['header_social_icon_type']);
	$options['header_social_icon_animation'] = sanitize_text_field($options['header_social_icon_animation']);
	$options['head_contact_style'] = sanitize_text_field($options['head_contact_style']);
	$options['top_header_info_box'] = wp_kses_post($options['top_header_info_box']);
	$options['top_header_info_box_icon'] = sanitize_text_field($options['top_header_info_box_icon']);
	$options['top_nav_convert'] = sanitize_text_field($options['top_nav_convert']);
	$options['top_nav_convert_custom'] = react_clamp(intval($options['top_nav_convert_custom']), 0, 5000);
	$options['sidr_displace'] = !empty($options['sidr_displace']);
	$options['sidr_speed'] = absint($options['sidr_speed']);
	$options['sidr_trigger_style'] = sanitize_text_field($options['sidr_trigger_style']);
	$options['logo_convert'] = sanitize_text_field($options['logo_convert']);
	$options['logo_convert_custom'] = react_clamp(intval($options['logo_convert_custom']), 0, 5000);
	$options['header_tophead_type'] = sanitize_text_field($options['header_tophead_type']);
	$options['header_mainheader_padding'] = react_clamp(intval($options['header_mainheader_padding']), 0, 80);
	$options['header_sticky_padding'] = react_clamp(intval($options['header_sticky_padding']), 0, 80);
	$options['header_sticky_logo_top'] = react_clamp(intval($options['header_sticky_logo_top']), -1, 100);
	$options['header_mainheader_padding_convert'] = react_clamp(intval($options['header_mainheader_padding_convert']), 0, 80);
	$options['main_header_fixed'] = !empty($options['main_header_fixed']);
	$options['main_header_no_margin'] = !empty($options['main_header_no_margin']);
	$options['main_header_top_fix'] = react_clamp(intval($options['main_header_top_fix']), -1, 600);
	$options['main_header_fixed_convert'] = sanitize_text_field($options['main_header_fixed_convert']);

	// Nav
	$options['nav_prime_nav_location'] = sanitize_text_field($options['nav_prime_nav_location']);
	$options['head_nav_desc_location'] = sanitize_text_field($options['head_nav_desc_location']);
	$options['solo_nav_desc_location'] = sanitize_text_field($options['solo_nav_desc_location']);
	$options['tophead_nav_desc_location'] = sanitize_text_field($options['tophead_nav_desc_location']);
	$options['head_nav_style'] = sanitize_text_field($options['head_nav_style']);
	$options['solo_nav_style'] = sanitize_text_field($options['solo_nav_style']);
	$options['tophead_nav_style'] = sanitize_text_field($options['tophead_nav_style']);
	$options['nav_show_home_icon'] = !empty($options['nav_show_home_icon']);
	$options['nav_home_icon_style'] = sanitize_text_field($options['nav_home_icon_style']);
	$options['nav_convert'] = sanitize_text_field($options['nav_convert']);
	$options['nav_convert_custom'] = react_clamp(intval($options['nav_convert_custom']), 0, 5000);
	$options['general_nav_align'] = sanitize_text_field($options['general_nav_align']);
	$options['solonav_general_search'] = !empty($options['solonav_general_search']);
	$options['solonav_general_search_position'] = sanitize_text_field($options['solonav_general_search_position']);
	$options['nav_home_text'] = sanitize_text_field($options['nav_home_text']);

	// InfoMenu
	$options['infomenu_dropdown_convert'] = sanitize_text_field($options['infomenu_dropdown_convert']);
	$options['infomenu_dropdown_convert_custom'] = react_clamp(intval($options['infomenu_dropdown_convert_custom']), 0, 5000);
	$options['im_search_on'] = !empty($options['im_search_on']);
	$options['im_location_on'] = !empty($options['im_location_on']);
	$options['im_video_on'] = !empty($options['im_video_on']);
	$options['im_contact_on'] = !empty($options['im_contact_on']);
	$options['im_tag_cloud'] = !empty($options['im_tag_cloud']);
	$options['im_fscontrols_on'] = !empty($options['im_fscontrols_on']);
	$options['im_videocontrols_on'] = !empty($options['im_videocontrols_on']);
	$options['im_audiocontrols_on'] = !empty($options['im_audiocontrols_on']);
	$options['im_woocart_on'] = !empty($options['im_woocart_on']);
	$options['infomenu_nav_style'] = sanitize_text_field($options['infomenu_nav_style']);
	$options['infomenu_nav_description'] = sanitize_text_field($options['infomenu_nav_description']);

	if (!is_array($options['im_order'])) {
		$options['im_order'] = array();
	}

	$options['im_order'] = array_map('sanitize_text_field', $options['im_order']);
	$options['contact_quform_id_infomenu'] = is_numeric($options['contact_quform_id_infomenu']) ? absint($options['contact_quform_id_infomenu']) : 'none';
	$options['infomenu_dropdown_width_large'] = react_clamp(intval($options['infomenu_dropdown_width_large']), 100, 800);
	$options['infomenu_dropdown_width'] = react_clamp(intval($options['infomenu_dropdown_width']), 100, 800);
	$options['im_contact_map'] = react_kses_html_iframe($options['im_contact_map']);
	$options['im_contact_map_ratio_first'] = is_numeric($options['im_contact_map_ratio_first']) ? absint($options['im_contact_map_ratio_first']) : '';
	$options['im_contact_map_ratio_last'] = is_numeric($options['im_contact_map_ratio_last']) ? absint($options['im_contact_map_ratio_last']) : '';
	$options['im_video'] = react_kses_html_iframe($options['im_video']);
	$options['im_contact_video_ratio_first'] = is_numeric($options['im_contact_video_ratio_first']) ? absint($options['im_contact_video_ratio_first']) : '';
	$options['im_contact_video_ratio_last'] = is_numeric($options['im_contact_video_ratio_last']) ? absint($options['im_contact_video_ratio_last']) : '';
	$options['im_display_icon_search'] = sanitize_text_field($options['im_display_icon_search']);
	$options['im_display_text_search'] = sanitize_text_field($options['im_display_text_search']);
	$options['im_display_type_search'] = sanitize_text_field($options['im_display_type_search']);

	$options['im_display_icon_contact'] = sanitize_text_field($options['im_display_icon_contact']);
	$options['im_display_text_contact'] = sanitize_text_field($options['im_display_text_contact']);
	$options['im_display_type_contact'] = sanitize_text_field($options['im_display_type_contact']);
	$options['im_scroll_type_contact'] = !empty($options['im_scroll_type_contact']);
	$options['im_scroll_height_type_contact'] = react_clamp(intval($options['im_scroll_height_type_contact']), 50, 900);

	$options['im_display_icon_location'] = sanitize_text_field($options['im_display_icon_location']);
	$options['im_display_text_location'] = sanitize_text_field($options['im_display_text_location']);
	$options['im_display_type_location'] = sanitize_text_field($options['im_display_type_location']);

	$options['im_display_icon_video'] = sanitize_text_field($options['im_display_icon_video']);
	$options['im_display_text_video'] = sanitize_text_field($options['im_display_text_video']);
	$options['im_display_type_video'] = sanitize_text_field($options['im_display_type_video']);

	$options['im_display_icon_fscontrols'] = sanitize_text_field($options['im_display_icon_fscontrols']);
	$options['im_display_text_fscontrols'] = sanitize_text_field($options['im_display_text_fscontrols']);
	$options['im_display_type_fscontrols'] = sanitize_text_field($options['im_display_type_fscontrols']);

	$options['im_display_icon_audiocontrols'] = sanitize_text_field($options['im_display_icon_audiocontrols']);
	$options['im_display_text_audiocontrols'] = sanitize_text_field($options['im_display_text_audiocontrols']);
	$options['im_display_type_audiocontrols'] = sanitize_text_field($options['im_display_type_audiocontrols']);

	$options['im_display_icon_videocontrols'] = sanitize_text_field($options['im_display_icon_videocontrols']);
	$options['im_display_text_videocontrols'] = sanitize_text_field($options['im_display_text_videocontrols']);
	$options['im_display_type_videocontrols'] = sanitize_text_field($options['im_display_type_videocontrols']);

	$options['im_display_type_woocart'] = sanitize_text_field($options['im_display_type_woocart']);
	$options['im_display_text_woocart'] = sanitize_text_field($options['im_display_text_woocart']);
	$options['im_display_icon_woocart'] = sanitize_text_field($options['im_display_icon_woocart']);

	if (!is_array($options['im_custom_widget_areas'])) {
		$options['im_custom_widget_areas'] = array();
	}

	foreach ($options['im_custom_widget_areas'] as $key => $area) {
		$options['im_custom_widget_areas'][$key]['id'] = absint($options['im_custom_widget_areas'][$key]['id']);
		$options['im_custom_widget_areas'][$key]['name'] = sanitize_text_field($options['im_custom_widget_areas'][$key]['name']);
		$options['im_custom_widget_areas'][$key]['box_type'] = sanitize_text_field($options['im_custom_widget_areas'][$key]['box_type']);
		$options['im_custom_widget_areas'][$key]['scroll'] = !empty($options['im_custom_widget_areas'][$key]['scroll']);
		$options['im_custom_widget_areas'][$key]['scroll_height'] = react_clamp(intval($options['im_custom_widget_areas'][$key]['scroll_height']), 0, 1000);
		$options['im_custom_widget_areas'][$key]['title'] = sanitize_text_field($options['im_custom_widget_areas'][$key]['title']);
		$options['im_custom_widget_areas'][$key]['icon'] = sanitize_text_field($options['im_custom_widget_areas'][$key]['icon']);
	}

	// Others
	$options['quform_convert'] = sanitize_text_field($options['quform_convert']);
	$options['quform_convert_custom'] = react_clamp(intval($options['quform_convert_custom']), 0, 5000);
	$options['sidebar_convert'] = sanitize_text_field($options['sidebar_convert']);
	$options['sidebar_convert_custom'] = react_clamp(intval($options['sidebar_convert_custom']), 0, 5000);
	$options['sidebar_masonry'] = !empty($options['sidebar_masonry']);
	$options['show_tooltips_social'] = !empty($options['show_tooltips_social']);
	$options['show_tooltips_all'] = !empty($options['show_tooltips_all']);
	$options['show_tooltips_footer'] = !empty($options['show_tooltips_footer']);
	$options['show_tooltips_popdown'] = !empty($options['show_tooltips_popdown']);
	$options['show_tooltips_images'] = !empty($options['show_tooltips_images']);
	$options['show_tooltips_nav'] = !empty($options['show_tooltips_nav']);
	$options['page_loader'] = sanitize_text_field($options['page_loader']);
	$options['page_loader_style'] = sanitize_text_field($options['page_loader_style']);
	$options['widget_title_style'] = sanitize_text_field($options['widget_title_style']);
	$options['style_share'] = sanitize_text_field($options['style_share']);
	$options['share_title'] = sanitize_text_field($options['share_title']);
	$options['show_share_facebook'] = !empty($options['show_share_facebook']);
	$options['show_share_twitter'] = !empty($options['show_share_twitter']);
	$options['show_share_googleplus'] = !empty($options['show_share_googleplus']);
	$options['show_share_pinterest'] = !empty($options['show_share_pinterest']);
	$options['share_hover_text_facebook'] = sanitize_text_field($options['share_hover_text_facebook']);
	$options['share_hover_text_twitter'] = sanitize_text_field($options['share_hover_text_twitter']);
	$options['share_hover_text_googleplus'] = sanitize_text_field($options['share_hover_text_googleplus']);
	$options['share_hover_text_pinterest'] = sanitize_text_field($options['share_hover_text_pinterest']);
	$options['smooth_scroll_links'] = !empty($options['smooth_scroll_links']);
	$options['smooth_scroll_on_load'] = !empty($options['smooth_scroll_on_load']);
	$options['smooth_scroll_offset'] = intval($options['smooth_scroll_offset']);

	// Contact
	$options['contact_quform_id'] = is_numeric($options['contact_quform_id']) ? absint($options['contact_quform_id']) : 'none';
	$options['contact_phone_number'] = sanitize_text_field($options['contact_phone_number']);
	$options['contact_fax_number'] = sanitize_text_field($options['contact_fax_number']);
	$options['contact_email'] = sanitize_email($options['contact_email']);
	$options['contact_address'] = wp_filter_nohtml_kses($options['contact_address']);
	$options['contact_map'] = react_kses_html_iframe($options['contact_map']);

	$options['component_slider_homepage'] = sanitize_text_field($options['component_slider_homepage']);
	$options['component_slider_id'] = sanitize_text_field($options['component_slider_id']);
	$options['component_slider_convert_id'] = sanitize_text_field($options['component_slider_convert_id']);
	$options['component_slider_convert_point'] = sanitize_text_field($options['component_slider_convert_point']);
	$options['component_slider_position'] = sanitize_text_field($options['component_slider_position']);
	$options['component_slider_convert_point_custom'] = react_clamp(intval($options['component_slider_convert_point_custom']), 0, 5000);
	$options['component_slider_stretched'] = !empty($options['component_slider_stretched']);

	// Advanced
	$options['advanced_custom_css'] = wp_strip_all_tags($options['advanced_custom_css']);
	$options['advanced_custom_css_phone'] = wp_strip_all_tags($options['advanced_custom_css_phone']);
	$options['advanced_custom_css_tablet'] = wp_strip_all_tags($options['advanced_custom_css_tablet']);
	$options['advanced_custom_css_desktop'] = wp_strip_all_tags($options['advanced_custom_css_desktop']);
	$options['advanced_custom_css_large'] = wp_strip_all_tags($options['advanced_custom_css_large']);
	$options['advanced_minify_custom_css'] = !empty($options['advanced_minify_custom_css']);
	$options['advanced_combine_css'] = !empty($options['advanced_combine_css']);
	$options['advanced_minify_css'] = !empty($options['advanced_minify_css']);
	$options['advanced_combine_js'] = !empty($options['advanced_combine_js']);
	$options['advanced_minify_js'] = !empty($options['advanced_minify_js']);

	if (!is_array($options['advanced_disable_css'])) {
		$options['advanced_disable_css'] = array();
	}

	$options['advanced_disable_css'] = array_map('sanitize_key', $options['advanced_disable_css']);

	if (!is_array($options['advanced_disable_js'])) {
		$options['advanced_disable_js'] = array();
	}

	$options['advanced_disable_js'] = array_map('sanitize_key', $options['advanced_disable_js']);
	$options['advanced_enable_animations_tablet'] = !empty($options['advanced_enable_animations_tablet']);
	$options['advanced_enable_animations_phone'] = !empty($options['advanced_enable_animations_phone']);
	$options['break_point_phone_ptr'] = react_clamp(intval($options['break_point_phone_ptr']), 0, 3000);
	$options['break_point_phone_ldsp'] = react_clamp(intval($options['break_point_phone_ldsp']), 0, 3000);
	$options['break_point_tablet_ptr'] = react_clamp(intval($options['break_point_tablet_ptr']), 0, 3000);
	$options['break_point_desktop'] = react_clamp(intval($options['break_point_desktop']), 0, 3000);
	$options['break_point_tv'] = react_clamp(intval($options['break_point_tv']), 0, 3000);

	// Popdown
	$options['pop_down_trigger_absolute'] = !empty($options['pop_down_trigger_absolute']);
	$options['pop_down_trigger_convert'] = sanitize_text_field($options['pop_down_trigger_convert']);
	$options['pop_down_trigger_convert_custom'] = react_clamp(intval($options['pop_down_trigger_convert_custom']), 0, 5000);
	$options['pop_down_trigger_dismiss'] = !empty($options['pop_down_trigger_dismiss']);
	$options['popdown_content_type'] = sanitize_text_field($options['popdown_content_type']);
	$options['popdown_widget_area_layout'] = sanitize_text_field($options['popdown_widget_area_layout']);
	$options['popdown_columns_convert'] = sanitize_text_field($options['popdown_columns_convert']);
	$options['popdown_plain_content'] = wp_kses_post($options['popdown_plain_content']);
	$options['popdown_trigger_heading'] = sanitize_text_field($options['popdown_trigger_heading']);
	$options['popdown_trigger_icon'] = sanitize_text_field($options['popdown_trigger_icon']);
	$options['popdown_trigger_description'] = sanitize_text_field($options['popdown_trigger_description']);
	$options['popdown_start_point'] = sanitize_text_field($options['popdown_start_point']);
	$options['popdown_cookie_expires'] = absint($options['popdown_cookie_expires']);

	// Social icons
	$options['facebook_url'] = esc_url_raw($options['facebook_url']);
	$options['twitter_url'] = esc_url_raw($options['twitter_url']);
	$options['skype_url'] = esc_url_raw($options['skype_url']);
	$options['flickr_url'] = esc_url_raw($options['flickr_url']);
	$options['youtube_url'] = esc_url_raw($options['youtube_url']);
	$options['googleplus_url'] = esc_url_raw($options['googleplus_url']);
	$options['rss_url'] = esc_url_raw($options['rss_url']);
	$options['googleplay_url'] = esc_url_raw($options['googleplay_url']);
	$options['vimeo_url'] = esc_url_raw($options['vimeo_url']);
	$options['spotify_url'] = esc_url_raw($options['spotify_url']);
	$options['wordpress_url'] = esc_url_raw($options['wordpress_url']);
	$options['blogger_url'] = esc_url_raw($options['blogger_url']);
	$options['evernote_url'] = esc_url_raw($options['evernote_url']);
	$options['soundcloud_url'] = esc_url_raw($options['soundcloud_url']);
	$options['tripadvisor_url'] = esc_url_raw($options['tripadvisor_url']);
	$options['xing_url'] = esc_url_raw($options['xing_url']);
	$options['stackoverflow_url'] = esc_url_raw($options['stackoverflow_url']);
	$options['lastfm_url'] = esc_url_raw($options['lastfm_url']);
	$options['dribbble_url'] = esc_url_raw($options['dribbble_url']);
	$options['tumblr_url'] = esc_url_raw($options['tumblr_url']);
	$options['github_url'] = esc_url_raw($options['github_url']);
	$options['android_url'] = esc_url_raw($options['android_url']);
	$options['instagram_url'] = esc_url_raw($options['instagram_url']);
	$options['bitcoin_url'] = esc_url_raw($options['bitcoin_url']);
	$options['linux_url'] = esc_url_raw($options['linux_url']);
	$options['windows_url'] = esc_url_raw($options['windows_url']);
	$options['pinterest_url'] = esc_url_raw($options['pinterest_url']);
	$options['linkedin_url'] = esc_url_raw($options['linkedin_url']);
	$options['dropbox_url'] = esc_url_raw($options['dropbox_url']);
	$options['foursquare_url'] = esc_url_raw($options['foursquare_url']);
	$options['apple_url'] = esc_url_raw($options['apple_url']);
	$options['steam_url'] = esc_url_raw($options['steam_url']);
	$options['deviantart_url'] = esc_url_raw($options['deviantart_url']);

	// Background texture/detail
	$options['style_background_texture'] = sanitize_key($options['style_background_texture']);
	$options['style_background_texture_opacity'] = is_numeric($options['style_background_texture_opacity']) && in_array($options['style_background_texture_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_background_texture_opacity'] : 20;
	$options['style_background_texture_large'] = !empty($options['style_background_texture_large']);
	$options['style_background_texture_fixed'] = !empty($options['style_background_texture_fixed']);
	$options['style_background_detail'] = sanitize_key($options['style_background_detail']);
	$options['style_background_detail_opacity'] = is_numeric($options['style_background_detail_opacity']) && in_array($options['style_background_detail_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_background_detail_opacity'] : 20;
	$options['style_background_image'] = sanitize_text_field($options['style_background_image']);
	$options['style_background_image_use_feat'] = !empty($options['style_background_image_use_feat']);
	$options['style_background_image_width'] = is_numeric($options['style_background_image_width']) ? intval($options['style_background_image_width']) : '';
	$options['style_background_image_height'] = is_numeric($options['style_background_image_height']) ? intval($options['style_background_image_height']) : '';
	$options['style_background_image_retina'] = sanitize_text_field($options['style_background_image_retina']);
	$options['style_background_image_retina_width'] = is_numeric($options['style_background_image_retina_width']) ? intval($options['style_background_image_retina_width']) : '';
	$options['style_background_image_retina_height'] = is_numeric($options['style_background_image_retina_height']) ? intval($options['style_background_image_retina_height']) : '';
	$options['style_background_image_is_retina'] = !empty($options['style_background_image_is_retina']);
	$options['style_background_image_retina_use_main_img'] = sanitize_text_field($options['style_background_image_retina_use_main_img']);
	$options['style_background_image_fixed'] = !empty($options['style_background_image_fixed']);
	$options['style_background_image_repeat'] = in_array($options['style_background_image_repeat'], react_get_background_repeat_options()) ? $options['style_background_image_repeat'] : 'no-repeat';
	$options['style_background_image_position'] = in_array($options['style_background_image_position'], react_get_background_position_options()) ? $options['style_background_image_position'] : 'center top';
	$options['style_background_image_position_custom'] = sanitize_text_field($options['style_background_image_position_custom']);
	$options['style_background_image_fixed_retina'] = !empty($options['style_background_image_fixed_retina']);
	$options['style_background_image_repeat_retina'] = in_array($options['style_background_image_repeat_retina'], react_get_background_repeat_options()) ? $options['style_background_image_repeat_retina'] : 'no-repeat';
	$options['style_background_image_position_retina'] = in_array($options['style_background_image_position_retina'], react_get_background_position_options()) ? $options['style_background_image_position_retina'] : 'center top';
	$options['style_background_image_position_custom_retina'] = sanitize_text_field($options['style_background_image_position_custom_retina']);
	$options['style_background_image_convert'] = sanitize_text_field($options['style_background_image_convert']);
	$options['style_background_image_convert_custom'] = react_clamp(intval($options['style_background_image_convert_custom']), 0, 5000);
	$options['style_background_image_parallax'] = react_clamp(floatval($options['style_background_image_parallax']), 0, 5);
	$options['style_background_image_parallax_offset'] = intval($options['style_background_image_parallax_offset']);
	$options['style_background_image_background_size'] = sanitize_text_field($options['style_background_image_background_size']);
	$options['style_background_image_background_size_retina'] = sanitize_text_field($options['style_background_image_background_size_retina']);

	// Body texture/detail/custom image
	$options['style_body_texture'] = sanitize_key($options['style_body_texture']);
	$options['style_body_texture_opacity'] = is_numeric($options['style_body_texture_opacity']) && in_array($options['style_body_texture_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_body_texture_opacity'] : 20;
	$options['style_body_texture_large'] = !empty($options['style_body_texture_large']);
	$options['style_body_texture_fixed'] = !empty($options['style_body_texture_fixed']);
	$options['style_body_detail'] = sanitize_key($options['style_body_detail']);
	$options['style_body_detail_opacity'] = is_numeric($options['style_body_detail_opacity']) && in_array($options['style_body_detail_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_body_detail_opacity'] : 20;
	$options['style_body_image'] = sanitize_text_field($options['style_body_image']);
	$options['style_body_image_use_feat'] = !empty($options['style_body_image_use_feat']);
	$options['style_body_image_width'] = is_numeric($options['style_body_image_width']) ? intval($options['style_body_image_width']) : '';
	$options['style_body_image_height'] = is_numeric($options['style_body_image_height']) ? intval($options['style_body_image_height']) : '';
	$options['style_body_image_retina'] = sanitize_text_field($options['style_body_image_retina']);
	$options['style_body_image_retina_width'] = is_numeric($options['style_body_image_retina_width']) ? intval($options['style_body_image_retina_width']) : '';
	$options['style_body_image_retina_height'] = is_numeric($options['style_body_image_retina_height']) ? intval($options['style_body_image_retina_height']) : '';
	$options['style_body_image_is_retina'] = !empty($options['style_body_image_is_retina']);
	$options['style_body_image_retina_use_main_img'] = sanitize_text_field($options['style_body_image_retina_use_main_img']);
	$options['style_body_image_fixed'] = !empty($options['style_body_image_fixed']);
	$options['style_body_image_repeat'] = in_array($options['style_body_image_repeat'], react_get_background_repeat_options()) ? $options['style_body_image_repeat'] : 'no-repeat';
	$options['style_body_image_position'] = in_array($options['style_body_image_position'], react_get_background_position_options()) ? $options['style_body_image_position'] : 'center top';
	$options['style_body_image_position_custom'] = sanitize_text_field($options['style_body_image_position_custom']);
	$options['style_body_image_fixed_retina'] = !empty($options['style_body_image_fixed_retina']);
	$options['style_body_image_repeat_retina'] = in_array($options['style_body_image_repeat_retina'], react_get_background_repeat_options()) ? $options['style_body_image_repeat_retina'] : 'no-repeat';
	$options['style_body_image_position_retina'] = in_array($options['style_body_image_position_retina'], react_get_background_position_options()) ? $options['style_body_image_position_retina'] : 'center top';
	$options['style_body_image_position_custom_retina'] = sanitize_text_field($options['style_body_image_position_custom_retina']);
	$options['style_body_image_convert'] = sanitize_text_field($options['style_body_image_convert']);
	$options['style_body_image_convert_custom'] = react_clamp(intval($options['style_body_image_convert_custom']), 0, 5000);
	$options['style_body_image_parallax'] = react_clamp(floatval($options['style_body_image_parallax']), 0, 5);
	$options['style_body_image_parallax_offset'] = intval($options['style_body_image_parallax_offset']);
	$options['style_body_image_background_size'] = sanitize_text_field($options['style_body_image_background_size']);
	$options['style_body_image_background_size_retina'] = sanitize_text_field($options['style_body_image_background_size_retina']);

	// Popdown texture/detail/custom image
	$options['style_popdown_texture'] = sanitize_key($options['style_popdown_texture']);
	$options['style_popdown_texture_opacity'] = is_numeric($options['style_popdown_texture_opacity']) && in_array($options['style_popdown_texture_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_popdown_texture_opacity'] : 20;
	$options['style_popdown_texture_large'] = !empty($options['style_popdown_texture_large']);
	$options['style_popdown_texture_fixed'] = !empty($options['style_popdown_texture_fixed']);
	$options['style_popdown_detail'] = sanitize_key($options['style_popdown_detail']);
	$options['style_popdown_detail_opacity'] = is_numeric($options['style_popdown_detail_opacity']) && in_array($options['style_popdown_detail_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_popdown_detail_opacity'] : 20;
	$options['style_popdown_image'] = sanitize_text_field($options['style_popdown_image']);
	$options['style_popdown_image_use_feat'] = !empty($options['style_popdown_image_use_feat']);
	$options['style_popdown_image_width'] = is_numeric($options['style_popdown_image_width']) ? intval($options['style_popdown_image_width']) : '';
	$options['style_popdown_image_height'] = is_numeric($options['style_popdown_image_height']) ? intval($options['style_popdown_image_height']) : '';
	$options['style_popdown_image_retina'] = sanitize_text_field($options['style_popdown_image_retina']);
	$options['style_popdown_image_retina_width'] = is_numeric($options['style_popdown_image_retina_width']) ? intval($options['style_popdown_image_retina_width']) : '';
	$options['style_popdown_image_retina_height'] = is_numeric($options['style_popdown_image_retina_height']) ? intval($options['style_popdown_image_retina_height']) : '';
	$options['style_popdown_image_is_retina'] = !empty($options['style_popdown_image_is_retina']);
	$options['style_popdown_image_retina_use_main_img'] = sanitize_text_field($options['style_popdown_image_retina_use_main_img']);
	$options['style_popdown_image_fixed'] = !empty($options['style_popdown_image_fixed']);
	$options['style_popdown_image_repeat'] = in_array($options['style_popdown_image_repeat'], react_get_background_repeat_options()) ? $options['style_popdown_image_repeat'] : 'no-repeat';
	$options['style_popdown_image_position'] = in_array($options['style_popdown_image_position'], react_get_background_position_options()) ? $options['style_popdown_image_position'] : 'center top';
	$options['style_popdown_image_position_custom'] = sanitize_text_field($options['style_popdown_image_position_custom']);
	$options['style_popdown_image_fixed_retina'] = !empty($options['style_popdown_image_fixed_retina']);
	$options['style_popdown_image_repeat_retina'] = in_array($options['style_popdown_image_repeat_retina'], react_get_background_repeat_options()) ? $options['style_popdown_image_repeat_retina'] : 'no-repeat';
	$options['style_popdown_image_position_retina'] = in_array($options['style_popdown_image_position_retina'], react_get_background_position_options()) ? $options['style_popdown_image_position_retina'] : 'center top';
	$options['style_popdown_image_position_custom_retina'] = sanitize_text_field($options['style_popdown_image_position_custom_retina']);
	$options['style_popdown_image_convert'] = sanitize_text_field($options['style_popdown_image_convert']);
	$options['style_popdown_image_convert_custom'] = react_clamp(intval($options['style_popdown_image_convert_custom']), 0, 5000);
	$options['style_popdown_image_parallax'] = react_clamp(floatval($options['style_popdown_image_parallax']), 0, 5);
	$options['style_popdown_image_parallax_offset'] = intval($options['style_popdown_image_parallax_offset']);
	$options['style_popdown_image_background_size'] = sanitize_text_field($options['style_popdown_image_background_size']);
	$options['style_popdown_image_background_size_retina'] = sanitize_text_field($options['style_popdown_image_background_size_retina']);

	// Top header texture/detail/custom image
	$options['style_tophead_texture'] = sanitize_key($options['style_tophead_texture']);
	$options['style_tophead_texture_opacity'] = is_numeric($options['style_tophead_texture_opacity']) && in_array($options['style_tophead_texture_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_tophead_texture_opacity'] : 20;
	$options['style_tophead_texture_large'] = !empty($options['style_tophead_texture_large']);
	$options['style_tophead_texture_fixed'] = !empty($options['style_tophead_texture_fixed']);
	$options['style_tophead_detail'] = sanitize_key($options['style_tophead_detail']);
	$options['style_tophead_detail_opacity'] = is_numeric($options['style_tophead_detail_opacity']) && in_array($options['style_tophead_detail_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_tophead_detail_opacity'] : 20;
	$options['style_tophead_image'] = sanitize_text_field($options['style_tophead_image']);
	$options['style_tophead_image_use_feat'] = !empty($options['style_tophead_image_use_feat']);
	$options['style_tophead_image_width'] = is_numeric($options['style_tophead_image_width']) ? intval($options['style_tophead_image_width']) : '';
	$options['style_tophead_image_height'] = is_numeric($options['style_tophead_image_height']) ? intval($options['style_tophead_image_height']) : '';
	$options['style_tophead_image_retina'] = sanitize_text_field($options['style_tophead_image_retina']);
	$options['style_tophead_image_retina_width'] = is_numeric($options['style_tophead_image_retina_width']) ? intval($options['style_tophead_image_retina_width']) : '';
	$options['style_tophead_image_retina_height'] = is_numeric($options['style_tophead_image_retina_height']) ? intval($options['style_tophead_image_retina_height']) : '';
	$options['style_tophead_image_is_retina'] = !empty($options['style_tophead_image_is_retina']);
	$options['style_tophead_image_retina_use_main_img'] = sanitize_text_field($options['style_tophead_image_retina_use_main_img']);
	$options['style_tophead_image_fixed'] = !empty($options['style_tophead_image_fixed']);
	$options['style_tophead_image_repeat'] = in_array($options['style_tophead_image_repeat'], react_get_background_repeat_options()) ? $options['style_tophead_image_repeat'] : 'no-repeat';
	$options['style_tophead_image_position'] = in_array($options['style_tophead_image_position'], react_get_background_position_options()) ? $options['style_tophead_image_position'] : 'center top';
	$options['style_tophead_image_position_custom'] = sanitize_text_field($options['style_tophead_image_position_custom']);
	$options['style_tophead_image_fixed_retina'] = !empty($options['style_tophead_image_fixed_retina']);
	$options['style_tophead_image_repeat_retina'] = in_array($options['style_tophead_image_repeat_retina'], react_get_background_repeat_options()) ? $options['style_tophead_image_repeat_retina'] : 'no-repeat';
	$options['style_tophead_image_position_retina'] = in_array($options['style_tophead_image_position_retina'], react_get_background_position_options()) ? $options['style_tophead_image_position_retina'] : 'center top';
	$options['style_tophead_image_position_custom_retina'] = sanitize_text_field($options['style_tophead_image_position_custom_retina']);
	$options['style_tophead_image_convert'] = sanitize_text_field($options['style_tophead_image_convert']);
	$options['style_tophead_image_convert_custom'] = react_clamp(intval($options['style_tophead_image_convert_custom']), 0, 5000);
	$options['style_tophead_image_parallax'] = react_clamp(floatval($options['style_tophead_image_parallax']), 0, 5);
	$options['style_tophead_image_parallax_offset'] = intval($options['style_tophead_image_parallax_offset']);
	$options['style_tophead_image_background_size'] = sanitize_text_field($options['style_tophead_image_background_size']);
	$options['style_tophead_image_background_size_retina'] = sanitize_text_field($options['style_tophead_image_background_size_retina']);

	// Main header texture/detail/custom image
	$options['style_mainhead_texture'] = sanitize_key($options['style_mainhead_texture']);
	$options['style_mainhead_texture_opacity'] = is_numeric($options['style_mainhead_texture_opacity']) && in_array($options['style_mainhead_texture_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_mainhead_texture_opacity'] : 20;
	$options['style_mainhead_texture_large'] = !empty($options['style_mainhead_texture_large']);
	$options['style_mainhead_texture_fixed'] = !empty($options['style_mainhead_texture_fixed']);
	$options['style_mainhead_detail'] = sanitize_key($options['style_mainhead_detail']);
	$options['style_mainhead_detail_opacity'] = is_numeric($options['style_mainhead_detail_opacity']) && in_array($options['style_mainhead_detail_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_mainhead_detail_opacity'] : 20;
	$options['style_mainhead_image'] = sanitize_text_field($options['style_mainhead_image']);
	$options['style_mainhead_image_use_feat'] = !empty($options['style_mainhead_image_use_feat']);
	$options['style_mainhead_image_width'] = is_numeric($options['style_mainhead_image_width']) ? intval($options['style_mainhead_image_width']) : '';
	$options['style_mainhead_image_height'] = is_numeric($options['style_mainhead_image_height']) ? intval($options['style_mainhead_image_height']) : '';
	$options['style_mainhead_image_retina'] = sanitize_text_field($options['style_mainhead_image_retina']);
	$options['style_mainhead_image_retina_width'] = is_numeric($options['style_mainhead_image_retina_width']) ? intval($options['style_mainhead_image_retina_width']) : '';
	$options['style_mainhead_image_retina_height'] = is_numeric($options['style_mainhead_image_retina_height']) ? intval($options['style_mainhead_image_retina_height']) : '';
	$options['style_mainhead_image_is_retina'] = !empty($options['style_mainhead_image_is_retina']);
	$options['style_mainhead_image_retina_use_main_img'] = sanitize_text_field($options['style_mainhead_image_retina_use_main_img']);
	$options['style_mainhead_image_fixed'] = !empty($options['style_mainhead_image_fixed']);
	$options['style_mainhead_image_repeat'] = in_array($options['style_mainhead_image_repeat'], react_get_background_repeat_options()) ? $options['style_mainhead_image_repeat'] : 'no-repeat';
	$options['style_mainhead_image_position'] = in_array($options['style_mainhead_image_position'], react_get_background_position_options()) ? $options['style_mainhead_image_position'] : 'center top';
	$options['style_mainhead_image_position_custom'] = sanitize_text_field($options['style_mainhead_image_position_custom']);
	$options['style_mainhead_image_fixed_retina'] = !empty($options['style_mainhead_image_fixed_retina']);
	$options['style_mainhead_image_repeat_retina'] = in_array($options['style_mainhead_image_repeat_retina'], react_get_background_repeat_options()) ? $options['style_mainhead_image_repeat_retina'] : 'no-repeat';
	$options['style_mainhead_image_position_retina'] = in_array($options['style_mainhead_image_position_retina'], react_get_background_position_options()) ? $options['style_mainhead_image_position_retina'] : 'center top';
	$options['style_mainhead_image_position_custom_retina'] = sanitize_text_field($options['style_mainhead_image_position_custom_retina']);
	$options['style_mainhead_image_convert'] = sanitize_text_field($options['style_mainhead_image_convert']);
	$options['style_mainhead_image_convert_custom'] = react_clamp(intval($options['style_mainhead_image_convert_custom']), 0, 5000);
	$options['style_mainhead_image_parallax'] = react_clamp(floatval($options['style_mainhead_image_parallax']), 0, 5);
	$options['style_mainhead_image_parallax_offset'] = intval($options['style_mainhead_image_parallax_offset']);
	$options['style_mainhead_image_background_size'] = sanitize_text_field($options['style_mainhead_image_background_size']);
	$options['style_mainhead_image_background_size_retina'] = sanitize_text_field($options['style_mainhead_image_background_size_retina']);

	// Solo nav texture/detail/custom image
	$options['style_solonav_texture'] = sanitize_key($options['style_solonav_texture']);
	$options['style_solonav_texture_opacity'] = is_numeric($options['style_solonav_texture_opacity']) && in_array($options['style_solonav_texture_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_solonav_texture_opacity'] : 20;
	$options['style_solonav_texture_large'] = !empty($options['style_solonav_texture_large']);
	$options['style_solonav_texture_fixed'] = !empty($options['style_solonav_texture_fixed']);
	$options['style_solonav_detail'] = sanitize_key($options['style_solonav_detail']);
	$options['style_solonav_detail_opacity'] = is_numeric($options['style_solonav_detail_opacity']) && in_array($options['style_solonav_detail_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_solonav_detail_opacity'] : 20;
	$options['style_solonav_image'] = sanitize_text_field($options['style_solonav_image']);
	$options['style_solonav_image_use_feat'] = !empty($options['style_solonav_image_use_feat']);
	$options['style_solonav_image_width'] = is_numeric($options['style_solonav_image_width']) ? intval($options['style_solonav_image_width']) : '';
	$options['style_solonav_image_height'] = is_numeric($options['style_solonav_image_height']) ? intval($options['style_solonav_image_height']) : '';
	$options['style_solonav_image_retina'] = sanitize_text_field($options['style_solonav_image_retina']);
	$options['style_solonav_image_retina_width'] = is_numeric($options['style_solonav_image_retina_width']) ? intval($options['style_solonav_image_retina_width']) : '';
	$options['style_solonav_image_retina_height'] = is_numeric($options['style_solonav_image_retina_height']) ? intval($options['style_solonav_image_retina_height']) : '';
	$options['style_solonav_image_is_retina'] = !empty($options['style_solonav_image_is_retina']);
	$options['style_solonav_image_retina_use_main_img'] = sanitize_text_field($options['style_solonav_image_retina_use_main_img']);
	$options['style_solonav_image_fixed'] = !empty($options['style_solonav_image_fixed']);
	$options['style_solonav_image_repeat'] = in_array($options['style_solonav_image_repeat'], react_get_background_repeat_options()) ? $options['style_solonav_image_repeat'] : 'no-repeat';
	$options['style_solonav_image_position'] = in_array($options['style_solonav_image_position'], react_get_background_position_options()) ? $options['style_solonav_image_position'] : 'center top';
	$options['style_solonav_image_position_custom'] = sanitize_text_field($options['style_solonav_image_position_custom']);
	$options['style_solonav_image_fixed_retina'] = !empty($options['style_solonav_image_fixed_retina']);
	$options['style_solonav_image_repeat_retina'] = in_array($options['style_solonav_image_repeat_retina'], react_get_background_repeat_options()) ? $options['style_solonav_image_repeat_retina'] : 'no-repeat';
	$options['style_solonav_image_position_retina'] = in_array($options['style_solonav_image_position_retina'], react_get_background_position_options()) ? $options['style_solonav_image_position_retina'] : 'center top';
	$options['style_solonav_image_position_custom_retina'] = sanitize_text_field($options['style_solonav_image_position_custom_retina']);
	$options['style_solonav_image_convert'] = sanitize_text_field($options['style_solonav_image_convert']);
	$options['style_solonav_image_convert_custom'] = react_clamp(intval($options['style_solonav_image_convert_custom']), 0, 5000);
	$options['style_solonav_image_parallax'] = react_clamp(floatval($options['style_solonav_image_parallax']), 0, 5);
	$options['style_solonav_image_parallax_offset'] = intval($options['style_solonav_image_parallax_offset']);
	$options['style_solonav_image_background_size'] = sanitize_text_field($options['style_solonav_image_background_size']);
	$options['style_solonav_image_background_size_retina'] = sanitize_text_field($options['style_solonav_image_background_size_retina']);

	// Intro texture/detail/custom image
	$options['style_intro_texture'] = sanitize_key($options['style_intro_texture']);
	$options['style_intro_texture_opacity'] = is_numeric($options['style_intro_texture_opacity']) && in_array($options['style_intro_texture_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_intro_texture_opacity'] : 20;
	$options['style_intro_texture_large'] = !empty($options['style_intro_texture_large']);
	$options['style_intro_texture_fixed'] = !empty($options['style_intro_texture_fixed']);
	$options['style_intro_detail'] = sanitize_key($options['style_intro_detail']);
	$options['style_intro_detail_opacity'] = is_numeric($options['style_intro_detail_opacity']) && in_array($options['style_intro_detail_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_intro_detail_opacity'] : 20;
	$options['style_intro_image'] = sanitize_text_field($options['style_intro_image']);
	$options['style_intro_image_use_feat'] = !empty($options['style_intro_image_use_feat']);
	$options['style_intro_image_width'] = is_numeric($options['style_intro_image_width']) ? intval($options['style_intro_image_width']) : '';
	$options['style_intro_image_height'] = is_numeric($options['style_intro_image_height']) ? intval($options['style_intro_image_height']) : '';
	$options['style_intro_image_retina'] = sanitize_text_field($options['style_intro_image_retina']);
	$options['style_intro_image_retina_width'] = is_numeric($options['style_intro_image_retina_width']) ? intval($options['style_intro_image_retina_width']) : '';
	$options['style_intro_image_retina_height'] = is_numeric($options['style_intro_image_retina_height']) ? intval($options['style_intro_image_retina_height']) : '';
	$options['style_intro_image_is_retina'] = !empty($options['style_intro_image_is_retina']);
	$options['style_intro_image_retina_use_main_img'] = sanitize_text_field($options['style_intro_image_retina_use_main_img']);
	$options['style_intro_image_fixed'] = !empty($options['style_intro_image_fixed']);
	$options['style_intro_image_repeat'] = in_array($options['style_intro_image_repeat'], react_get_background_repeat_options()) ? $options['style_intro_image_repeat'] : 'no-repeat';
	$options['style_intro_image_position'] = in_array($options['style_intro_image_position'], react_get_background_position_options()) ? $options['style_intro_image_position'] : 'center top';
	$options['style_intro_image_position_custom'] = sanitize_text_field($options['style_intro_image_position_custom']);
	$options['style_intro_image_fixed_retina'] = !empty($options['style_intro_image_fixed_retina']);
	$options['style_intro_image_repeat_retina'] = in_array($options['style_intro_image_repeat_retina'], react_get_background_repeat_options()) ? $options['style_intro_image_repeat_retina'] : 'no-repeat';
	$options['style_intro_image_position_retina'] = in_array($options['style_intro_image_position_retina'], react_get_background_position_options()) ? $options['style_intro_image_position_retina'] : 'center top';
	$options['style_intro_image_position_custom_retina'] = sanitize_text_field($options['style_intro_image_position_custom_retina']);
	$options['style_intro_image_convert'] = sanitize_text_field($options['style_intro_image_convert']);
	$options['style_intro_image_convert_custom'] = react_clamp(intval($options['style_intro_image_convert_custom']), 0, 5000);
	$options['style_intro_image_parallax'] = react_clamp(floatval($options['style_intro_image_parallax']), 0, 5);
	$options['style_intro_image_parallax_offset'] = intval($options['style_intro_image_parallax_offset']);
	$options['style_intro_image_background_size'] = sanitize_text_field($options['style_intro_image_background_size']);
	$options['style_intro_image_background_size_retina'] = sanitize_text_field($options['style_intro_image_background_size_retina']);

	// Content texture/detail/custom image
	$options['style_content_texture'] = sanitize_key($options['style_content_texture']);
	$options['style_content_texture_opacity'] = is_numeric($options['style_content_texture_opacity']) && in_array($options['style_content_texture_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_content_texture_opacity'] : 20;
	$options['style_content_texture_large'] = !empty($options['style_content_texture_large']);
	$options['style_content_texture_fixed'] = !empty($options['style_content_texture_fixed']);
	$options['style_content_detail'] = sanitize_key($options['style_content_detail']);
	$options['style_content_detail_opacity'] = is_numeric($options['style_content_detail_opacity']) && in_array($options['style_content_detail_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_content_detail_opacity'] : 20;
	$options['style_content_image'] = sanitize_text_field($options['style_content_image']);
	$options['style_content_image_use_feat'] = !empty($options['style_content_image_use_feat']);
	$options['style_content_image_width'] = is_numeric($options['style_content_image_width']) ? intval($options['style_content_image_width']) : '';
	$options['style_content_image_height'] = is_numeric($options['style_content_image_height']) ? intval($options['style_content_image_height']) : '';
	$options['style_content_image_retina'] = sanitize_text_field($options['style_content_image_retina']);
	$options['style_content_image_retina_width'] = is_numeric($options['style_content_image_retina_width']) ? intval($options['style_content_image_retina_width']) : '';
	$options['style_content_image_retina_height'] = is_numeric($options['style_content_image_retina_height']) ? intval($options['style_content_image_retina_height']) : '';
	$options['style_content_image_is_retina'] = !empty($options['style_content_image_is_retina']);
	$options['style_content_image_retina_use_main_img'] = sanitize_text_field($options['style_content_image_retina_use_main_img']);
	$options['style_content_image_fixed'] = !empty($options['style_content_image_fixed']);
	$options['style_content_image_repeat'] = in_array($options['style_content_image_repeat'], react_get_background_repeat_options()) ? $options['style_content_image_repeat'] : 'no-repeat';
	$options['style_content_image_position'] = in_array($options['style_content_image_position'], react_get_background_position_options()) ? $options['style_content_image_position'] : 'center top';
	$options['style_content_image_position_custom'] = sanitize_text_field($options['style_content_image_position_custom']);
	$options['style_content_image_fixed_retina'] = !empty($options['style_content_image_fixed_retina']);
	$options['style_content_image_repeat_retina'] = in_array($options['style_content_image_repeat_retina'], react_get_background_repeat_options()) ? $options['style_content_image_repeat_retina'] : 'no-repeat';
	$options['style_content_image_position_retina'] = in_array($options['style_content_image_position_retina'], react_get_background_position_options()) ? $options['style_content_image_position_retina'] : 'center top';
	$options['style_content_image_position_custom_retina'] = sanitize_text_field($options['style_content_image_position_custom_retina']);
	$options['style_content_image_convert'] = sanitize_text_field($options['style_content_image_convert']);
	$options['style_content_image_convert_custom'] = react_clamp(intval($options['style_content_image_convert_custom']), 0, 5000);
	$options['style_content_image_parallax'] = react_clamp(floatval($options['style_content_image_parallax']), 0, 5);
	$options['style_content_image_parallax_offset'] = intval($options['style_content_image_parallax_offset']);
	$options['style_content_image_background_size'] = sanitize_text_field($options['style_content_image_background_size']);
	$options['style_content_image_background_size_retina'] = sanitize_text_field($options['style_content_image_background_size_retina']);

	// Main footer texture/detail/custom image
	$options['style_mainfoot_texture'] = sanitize_key($options['style_mainfoot_texture']);
	$options['style_mainfoot_texture_opacity'] = is_numeric($options['style_mainfoot_texture_opacity']) && in_array($options['style_mainfoot_texture_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_mainfoot_texture_opacity'] : 20;
	$options['style_mainfoot_texture_large'] = !empty($options['style_mainfoot_texture_large']);
	$options['style_mainfoot_texture_fixed'] = !empty($options['style_mainfoot_texture_fixed']);
	$options['style_mainfoot_detail'] = sanitize_key($options['style_mainfoot_detail']);
	$options['style_mainfoot_detail_opacity'] = is_numeric($options['style_mainfoot_detail_opacity']) && in_array($options['style_mainfoot_detail_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_mainfoot_detail_opacity'] : 20;
	$options['style_mainfoot_image'] = sanitize_text_field($options['style_mainfoot_image']);
	$options['style_mainfoot_image_use_feat'] = !empty($options['style_mainfoot_image_use_feat']);
	$options['style_mainfoot_image_width'] = is_numeric($options['style_mainfoot_image_width']) ? intval($options['style_mainfoot_image_width']) : '';
	$options['style_mainfoot_image_height'] = is_numeric($options['style_mainfoot_image_height']) ? intval($options['style_mainfoot_image_height']) : '';
	$options['style_mainfoot_image_retina'] = sanitize_text_field($options['style_mainfoot_image_retina']);
	$options['style_mainfoot_image_retina_width'] = is_numeric($options['style_mainfoot_image_retina_width']) ? intval($options['style_mainfoot_image_retina_width']) : '';
	$options['style_mainfoot_image_retina_height'] = is_numeric($options['style_mainfoot_image_retina_height']) ? intval($options['style_mainfoot_image_retina_height']) : '';
	$options['style_mainfoot_image_is_retina'] = !empty($options['style_mainfoot_image_is_retina']);
	$options['style_mainfoot_image_retina_use_main_img'] = sanitize_text_field($options['style_mainfoot_image_retina_use_main_img']);
	$options['style_mainfoot_image_fixed'] = !empty($options['style_mainfoot_image_fixed']);
	$options['style_mainfoot_image_repeat'] = in_array($options['style_mainfoot_image_repeat'], react_get_background_repeat_options()) ? $options['style_mainfoot_image_repeat'] : 'no-repeat';
	$options['style_mainfoot_image_position'] = in_array($options['style_mainfoot_image_position'], react_get_background_position_options()) ? $options['style_mainfoot_image_position'] : 'center top';
	$options['style_mainfoot_image_position_custom'] = sanitize_text_field($options['style_mainfoot_image_position_custom']);
	$options['style_mainfoot_image_fixed_retina'] = !empty($options['style_mainfoot_image_fixed_retina']);
	$options['style_mainfoot_image_repeat_retina'] = in_array($options['style_mainfoot_image_repeat_retina'], react_get_background_repeat_options()) ? $options['style_mainfoot_image_repeat_retina'] : 'no-repeat';
	$options['style_mainfoot_image_position_retina'] = in_array($options['style_mainfoot_image_position_retina'], react_get_background_position_options()) ? $options['style_mainfoot_image_position_retina'] : 'center top';
	$options['style_mainfoot_image_position_custom_retina'] = sanitize_text_field($options['style_mainfoot_image_position_custom_retina']);
	$options['style_mainfoot_image_convert'] = sanitize_text_field($options['style_mainfoot_image_convert']);
	$options['style_mainfoot_image_convert_custom'] = react_clamp(intval($options['style_mainfoot_image_convert_custom']), 0, 5000);
	$options['style_mainfoot_image_parallax'] = react_clamp(floatval($options['style_mainfoot_image_parallax']), 0, 5);
	$options['style_mainfoot_image_parallax_offset'] = intval($options['style_mainfoot_image_parallax_offset']);
	$options['style_mainfoot_image_background_size'] = sanitize_text_field($options['style_mainfoot_image_background_size']);
	$options['style_mainfoot_image_background_size_retina'] = sanitize_text_field($options['style_mainfoot_image_background_size_retina']);

	// Sub footer texture/detail/custom image
	$options['style_subfoot_texture'] = sanitize_key($options['style_subfoot_texture']);
	$options['style_subfoot_texture_opacity'] = is_numeric($options['style_subfoot_texture_opacity']) && in_array($options['style_subfoot_texture_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_subfoot_texture_opacity'] : 20;
	$options['style_subfoot_texture_large'] = !empty($options['style_subfoot_texture_large']);
	$options['style_subfoot_texture_fixed'] = !empty($options['style_subfoot_texture_fixed']);
	$options['style_subfoot_detail'] = sanitize_key($options['style_subfoot_detail']);
	$options['style_subfoot_detail_opacity'] = is_numeric($options['style_subfoot_detail_opacity']) && in_array($options['style_subfoot_detail_opacity'], array(10, 20, 30, 40, 50)) ? $options['style_subfoot_detail_opacity'] : 20;
	$options['style_subfoot_image'] = sanitize_text_field($options['style_subfoot_image']);
	$options['style_subfoot_image_use_feat'] = !empty($options['style_subfoot_image_use_feat']);
	$options['style_subfoot_image_width'] = is_numeric($options['style_subfoot_image_width']) ? intval($options['style_subfoot_image_width']) : '';
	$options['style_subfoot_image_height'] = is_numeric($options['style_subfoot_image_height']) ? intval($options['style_subfoot_image_height']) : '';
	$options['style_subfoot_image_retina'] = sanitize_text_field($options['style_subfoot_image_retina']);
	$options['style_subfoot_image_retina_width'] = is_numeric($options['style_subfoot_image_retina_width']) ? intval($options['style_subfoot_image_retina_width']) : '';
	$options['style_subfoot_image_retina_height'] = is_numeric($options['style_subfoot_image_retina_height']) ? intval($options['style_subfoot_image_retina_height']) : '';
	$options['style_subfoot_image_is_retina'] = !empty($options['style_subfoot_image_is_retina']);
	$options['style_subfoot_image_retina_use_main_img'] = sanitize_text_field($options['style_subfoot_image_retina_use_main_img']);
	$options['style_subfoot_image_fixed'] = !empty($options['style_subfoot_image_fixed']);
	$options['style_subfoot_image_repeat'] = in_array($options['style_subfoot_image_repeat'], react_get_background_repeat_options()) ? $options['style_subfoot_image_repeat'] : 'no-repeat';
	$options['style_subfoot_image_position'] = in_array($options['style_subfoot_image_position'], react_get_background_position_options()) ? $options['style_subfoot_image_position'] : 'center top';
	$options['style_subfoot_image_position_custom'] = sanitize_text_field($options['style_subfoot_image_position_custom']);
	$options['style_subfoot_image_fixed_retina'] = !empty($options['style_subfoot_image_fixed_retina']);
	$options['style_subfoot_image_repeat_retina'] = in_array($options['style_subfoot_image_repeat_retina'], react_get_background_repeat_options()) ? $options['style_subfoot_image_repeat_retina'] : 'no-repeat';
	$options['style_subfoot_image_position_retina'] = in_array($options['style_subfoot_image_position_retina'], react_get_background_position_options()) ? $options['style_subfoot_image_position_retina'] : 'center top';
	$options['style_subfoot_image_position_custom_retina'] = sanitize_text_field($options['style_subfoot_image_position_custom_retina']);
	$options['style_subfoot_image_convert'] = sanitize_text_field($options['style_subfoot_image_convert']);
	$options['style_subfoot_image_convert_custom'] = react_clamp(intval($options['style_subfoot_image_convert_custom']), 0, 5000);
	$options['style_subfoot_image_parallax'] = react_clamp(floatval($options['style_subfoot_image_parallax']), 0, 5);
	$options['style_subfoot_image_parallax_offset'] = intval($options['style_subfoot_image_parallax_offset']);
	$options['style_subfoot_image_background_size'] = sanitize_text_field($options['style_subfoot_image_background_size']);
	$options['style_subfoot_image_background_size_retina'] = sanitize_text_field($options['style_subfoot_image_background_size_retina']);

	// Page outer shadows
	$options['style_outside_shadow'] = !empty($options['style_outside_shadow']);
	$options['style_outside_shadow_opacity'] = react_clamp(intval($options['style_outside_shadow_opacity']), 1, 9);
	$options['style_full_shadow'] = sanitize_text_field($options['style_full_shadow']);
	$options['style_full_shadow_opacity'] = react_clamp(intval($options['style_full_shadow_opacity']), 1, 9);

	$options['page_borders_lr'] = !empty($options['page_borders_lr']);
	$options['page_borders_tb'] = !empty($options['page_borders_tb']);

	$options['sidebar_width'] = react_clamp(intval($options['sidebar_width']), 10, 50);
	$options['sidebar_style'] = sanitize_text_field($options['sidebar_style']);

	$options['head_nav_style_bold'] = is_numeric($options['head_nav_style_bold']) ? intval($options['head_nav_style_bold']) : '';
	$options['head_nav_style_size'] = is_numeric($options['head_nav_style_size']) ? intval($options['head_nav_style_size']) : '';
	$options['head_nav_style_upper'] = !empty($options['head_nav_style_upper']);
	$options['head_nav_style_space'] = react_clamp(intval($options['head_nav_style_space']), -5, 15);

	$options['solo_nav_style_bold'] = is_numeric($options['solo_nav_style_bold']) ? intval($options['solo_nav_style_bold']) : '';
	$options['solo_nav_style_size'] = is_numeric($options['solo_nav_style_size']) ? intval($options['solo_nav_style_size']) : '';
	$options['solo_nav_style_upper'] = !empty($options['solo_nav_style_upper']);
	$options['solo_nav_style_space'] = react_clamp(intval($options['solo_nav_style_space']), -5, 15);

	$options['tophead_nav_style_bold'] = is_numeric($options['tophead_nav_style_bold']) ? intval($options['tophead_nav_style_bold']) : '';
	$options['tophead_nav_style_upper'] = !empty($options['tophead_nav_style_upper']);
	$options['tophead_nav_style_space'] = react_clamp(intval($options['tophead_nav_style_space']), -5, 15);

	$options['pop_down_fixed'] = !empty($options['pop_down_fixed']);
	$options['pop_down_fixed_full_height'] = !empty($options['pop_down_fixed_full_height']);
	$options['sidebar_convert_columns'] = sanitize_text_field($options['sidebar_convert_columns']);

	$options['fancybox_overlay'] = sanitize_text_field($options['fancybox_overlay']);
	$options['fancybox_overlay_opacity'] = is_numeric($options['fancybox_overlay_opacity']) && in_array($options['fancybox_overlay_opacity'], array(0, 10, 20, 30, 40, 50, 60, 70, 80, 90)) ? $options['fancybox_overlay_opacity'] : 30;
	$options['fancybox_overlay_color'] = react_sanitize_color($options['fancybox_overlay_color']);
	$options['fancybox_choose_scheme'] = is_numeric($options['fancybox_choose_scheme']) ? absint($options['fancybox_choose_scheme']) : '';

	$options['intro_title_style'] = sanitize_text_field($options['intro_title_style']);
	$options['intro_title_position'] = sanitize_text_field($options['intro_title_position']);
	$options['intro_title_position_mobiles'] = sanitize_text_field($options['intro_title_position_mobiles']);
	$options['intro_animation'] = sanitize_text_field($options['intro_animation']);
	$options['intro_animation_delay'] = is_numeric($options['intro_animation_delay']) ? intval($options['intro_animation_delay']) : '';
	$options['intro_animation_offset'] = is_numeric($options['intro_animation_offset']) ? intval($options['intro_animation_offset']) : '';
	$options['intro_padding'] = react_clamp(intval($options['intro_padding']), 0, 150);
	$options['footer_position_height'] = react_clamp(intval($options['footer_position_height']), 0, 300);

	// Woocommerce
	$options['woocommerce_boxed_style'] = !empty($options['woocommerce_boxed_style']);
	$options['woocommerce_show_share'] = !empty($options['woocommerce_show_share']);
	$options['woocommerce_convert'] = sanitize_text_field($options['woocommerce_convert']);
	$options['woocommerce_convert_custom'] = react_clamp(intval($options['woocommerce_convert_custom']), 0, 5000);
	$options['shop_layout'] = sanitize_text_field($options['shop_layout']);
	$options['shop_single_layout'] = sanitize_text_field($options['shop_single_layout']);
	$options['woocommerce_product_columns'] = is_numeric($options['woocommerce_product_columns']) ? absint($options['woocommerce_product_columns']) : '';
	$options['woocommerce_related_products'] = is_numeric($options['woocommerce_related_products']) ? absint($options['woocommerce_related_products']) : '';
	$options['woocommerce_related_product_columns'] = is_numeric($options['woocommerce_related_product_columns']) ? absint($options['woocommerce_related_product_columns']) : '';
	$options['woocommerce_onsale_animation'] = sanitize_text_field($options['woocommerce_onsale_animation']);

	$options['subfoot_convert'] = sanitize_text_field($options['subfoot_convert']);
	$options['subfoot_convert_custom'] = react_clamp(intval($options['subfoot_convert_custom']), 0, 5000);

	// Translate
	foreach (react_get_default_translations() as $key => $value) {
		$options[$key] = sanitize_text_field($options[$key]);
	}

	return $options;
}

/**
 * Handle theme options export via Ajax
 */
function react_export_options_ajax()
{
	if (!isset($_POST['options'])) {
		wp_send_json(array('type' => 'error', 'message' => 'Bad request'));
	}

	if (!current_user_can('edit_theme_options')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('react_export_options', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	$options = json_decode(stripslashes($_POST['options']), true);

	if (!is_array($options)) {
		wp_send_json(array('type' => 'error', 'message' => 'The options are invalid or malformed'));
	}

	$options = react_sanitize_options($options);
	$options = apply_filters('react_pre_save_options', $options);

	$response = array(
		'type' => 'success',
		'data' => wp_json_encode($options)
	);

	wp_send_json($response);
}
add_action('wp_ajax_react_export_options_ajax', 'react_export_options_ajax');

/**
 * Handle theme options import via Ajax
 */
function react_import_options_ajax()
{
	if (!isset($_POST['options'])) {
		wp_send_json(array('type' => 'error', 'message' => 'Bad request'));
	}

	if (!current_user_can('edit_theme_options')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('react_import_options', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	$options = json_decode(stripslashes($_POST['options']), true);

	if (!is_array($options)) {
		wp_send_json(array('type' => 'error', 'message' => 'The options are invalid or malformed'));
	}

	react_import_options($options);

	wp_send_json(array('type' => 'success'));
}
add_action('wp_ajax_react_import_options_ajax', 'react_import_options_ajax');

/**
 * Import the given theme options
 *
 * @param  array  $options
 */
function react_import_options($options)
{
	global $react;

	$options = array_merge($react['options'], $options);

	react_save_options($options);
}

/**
 * Handle resetting the theme options via Ajax
 */
function react_reset_options_ajax()
{
	if (!current_user_can('edit_theme_options')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('react_reset_options', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	react_save_options(react_get_default_options());

	wp_send_json(array('type' => 'success'));
}
add_action('wp_ajax_react_reset_options_ajax', 'react_reset_options_ajax');

/**
 * Try to get a working $wp_filesystem instance
 *
 * @return WP_Filesystem_Base|false Returns the instance or false if no write access
 */
function react_get_filesystem()
{
	// On theme activation this function does not exist
	if (!function_exists('WP_Filesystem')) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
	}

	/* @var WP_Filesystem_Base $wp_filesystem */
	global $wp_filesystem;
	$credentials = false;

	// Attempt to get credentials from the FTP_* constants
	if (function_exists('request_filesystem_credentials')) {
		ob_start();
		$credentials = request_filesystem_credentials('');
		ob_end_clean();
	}

	if ( ! WP_Filesystem($credentials)) {
		return false;
	}

	return $wp_filesystem;
}

/**
 * Minify the given CSS and return it
 *
 * @param   string  $css  Unminified CSS
 * @return  string        Minified CSS
 */
function react_minify_css($css)
{
	if (!class_exists('Minify_CSS_Compressor')) {
		require_once REACT_ADMIN_INCLUDES_DIR . '/class-minify-css-compressor.php';
	}

	return Minify_CSS_Compressor::process($css);
}

/**
 * Generate the animate.css file
 *
 * @param  array   			   $options    The theme options
 * @param  WP_Filesystem_Base  $filesystem
 */
function react_generate_animate_css_file($options, $filesystem)
{
	$animateCssFile = REACT_CACHE_DIR . '/' . react_get_animate_css_filename();

	if ($filesystem->is_writable(REACT_CACHE_DIR)) {
		$animateDisabled = in_array('animate', $options['advanced_disable_css']);
		$hoverDisabled = in_array('hover', $options['advanced_disable_css']);
		$magicDisabled = in_array('magic', $options['advanced_disable_css']);

		if ($animateDisabled && $hoverDisabled && $magicDisabled) {
			if ($filesystem->exists($animateCssFile)) {
				$filesystem->delete($animateCssFile);
			}
			return;
		}

		$keyframes = '@charset "UTF-8";' . "\r\n";
		$css = '';

		if (!$animateDisabled) {
			$keyframes .= $filesystem->get_contents(REACT_DIR . '/css/animate.keyframes.min.css');
			$css .= $filesystem->get_contents(REACT_DIR . '/css/animate.min.css');
		}
		if (!$hoverDisabled) {
			$keyframes .= $filesystem->get_contents(REACT_DIR . '/css/hover.keyframes.min.css');
			$css .= $filesystem->get_contents(REACT_DIR . '/css/hover.min.css');
		}
		if (!$magicDisabled) {
			$keyframes .= $filesystem->get_contents(REACT_DIR . '/css/magic.keyframes.min.css');
			$css .= $filesystem->get_contents(REACT_DIR . '/css/magic.min.css');
		}

		if ($options['advanced_enable_animations_tablet'] && !$options['advanced_enable_animations_phone']) {
			// Animations are enabled on tablets but not on phones
			$css = "@media only screen and (min-width:" . (absint($options['break_point_phone_ldsp']) + 1) . "px) {\r\n" . $css . "\r\n}";
		} elseif (!$options['advanced_enable_animations_tablet'] && $options['advanced_enable_animations_phone']) {
			// Animations are enabled on phones but not on tablets
			$css = "@media only screen and (max-width:" . absint($options['break_point_phone_ldsp']) . "px), only screen and (min-width:" . absint($options['break_point_desktop']) . "px) {\r\n" . $css . "\r\n}";
		} elseif (!$options['advanced_enable_animations_tablet'] && !$options['advanced_enable_animations_phone']) {
			// Animations are disabled on phones and tablets
			$css = "@media only screen and (min-width:" . absint($options['break_point_desktop']) . "px) {\r\n" . $css . "\r\n}";
		}

		$css = $keyframes . "\r\n" . $css;

		$result = $filesystem->put_contents($animateCssFile, $css);

		if ($result === false) {
			react_debug('Failed to save animate.css file');
		}
	}
}

/**
 * Generate the custom.css file
 *
 * @param   array   			$options    The theme options
 * @param   WP_Filesystem_Base  $filesystem
 */
function react_generate_custom_css_file($options, $filesystem)
{
	$customCssFile = REACT_CACHE_DIR . '/' . react_get_custom_css_filename();

	if ($filesystem->is_writable(REACT_CACHE_DIR)) {
		ob_start();
		include REACT_ADMIN_INCLUDES_DIR . '/custom-css.php';
		$customCss = ob_get_clean();

		if ($options['advanced_minify_custom_css']) {
			$customCss = react_minify_css($customCss);
		}

		$result = $filesystem->put_contents($customCssFile, $customCss);

		if ($result === false) {
			react_debug('Failed to save custom.css file');
		}
	}
}

/**
 * Generate the palettes.css file
 *
 * @param   array   			$options    The theme options
 * @param   WP_Filesystem_Base  $filesystem
 */
function react_generate_palette_css_file($options, $filesystem)
{
	if ($filesystem->is_writable(REACT_CACHE_DIR) && count($options['custom_palettes'])) {
		$chunkedPalettes = array_chunk($options['custom_palettes'], 10); // Limit to 10 palettes per stylesheet for IE limit

		foreach ($chunkedPalettes as $index => $palettes) {
			ob_start();
			include REACT_ADMIN_INCLUDES_DIR . '/palette-css.php';
			$paletteCss = ob_get_clean();

			if ($options['advanced_minify_custom_css']) {
				$paletteCss = react_minify_css($paletteCss);
			}

			$result = $filesystem->put_contents(REACT_CACHE_DIR . '/' . react_get_palette_css_filename($index), $paletteCss);

			if ($result === false) {
				react_debug('Failed to save palettes.css file');
			}
		}
	}
}

/**
 * Generate the custom.css file
 *
 * @param  array               $options     The theme options
 * @param  WP_Filesystem_Base  $filesystem
 */
function react_generate_woocommerce_css_file($options, $filesystem)
{
	$woocommerceCssFile = REACT_CACHE_DIR . '/' . react_get_woocommerce_css_filename();

	if ($filesystem->is_writable(REACT_CACHE_DIR)) {
		ob_start();
		include REACT_ADMIN_INCLUDES_DIR . '/woocommerce-css.php';
		$woocommerceCss = ob_get_clean();

		if ($options['advanced_minify_custom_css']) {
			$woocommerceCss = react_minify_css($woocommerceCss);
		}

		$result = $filesystem->put_contents($woocommerceCssFile, $woocommerceCss);

		if ($result === false) {
			react_debug('Failed to save woocommerce.css file');
		}
	}
}

/**
 * Generate the combined CSS styles file
 *
 * @param  array               $options     The theme options
 * @param  WP_Filesystem_Base  $filesystem
 */
function react_generate_combined_css_file($options, $filesystem)
{
	$styles = react_get_styles();
	$styleFile = REACT_CACHE_DIR . '/styles.css';

	if ($filesystem->is_writable(REACT_CACHE_DIR)) {
		$minify = $options['advanced_minify_css'];
		$css = '';

		$animateCssFilename = react_get_animate_css_filename();
		if ($filesystem->exists(REACT_CACHE_DIR . '/' . $animateCssFilename)) {
			$css .= $filesystem->get_contents(REACT_CACHE_DIR . '/' . $animateCssFilename);
		}

		$css .= $filesystem->get_contents(REACT_DIR . '/css/styles.min.css');

		if (is_rtl()) {
			$css .= $filesystem->get_contents(REACT_DIR . '/css/rtl.min.css');
		}

		foreach ($styles as $key => $style) {
			if (!in_array($key, $options['advanced_disable_css'])) {
				if ($minify && (isset($style['minify']) && $style['minify'])) {
					$css .= $filesystem->get_contents(react_minify_css($style['path']));
				} else {
					$css .= $filesystem->get_contents($style['path']);
				}
			}
		}

		$customCssFilename = react_get_custom_css_filename();
		if ($filesystem->exists(REACT_CACHE_DIR . '/' . $customCssFilename)) {
			if ($minify && !$options['advanced_minify_custom_css']) {
				$css .= $filesystem->get_contents(react_minify_css(REACT_CACHE_DIR . '/' . $customCssFilename));
			} else {
				$css .= $filesystem->get_contents(REACT_CACHE_DIR . '/' . $customCssFilename);
			}
		}

		$chunkedPalettes = array_chunk($options['custom_palettes'], 10); // Limit to 10 palettes per stylesheet for IE limit
		foreach ($chunkedPalettes as $index => $palettes) {
			$paletteCssFilename = react_get_palette_css_filename($index);
			if ($filesystem->exists(REACT_CACHE_DIR . '/' . $paletteCssFilename)) {
				if ($minify && !$options['advanced_minify_custom_css']) {
					$css .= $filesystem->get_contents(react_minify_css(REACT_CACHE_DIR . '/' . $paletteCssFilename));
				} else {
					$css .= $filesystem->get_contents(REACT_CACHE_DIR . '/' . $paletteCssFilename);
				}
			}
		}

		$woocommerceCssFilename = react_get_woocommerce_css_filename();
		if ($filesystem->exists(REACT_CACHE_DIR . '/' . $woocommerceCssFilename)) {
			if ($minify && !$options['advanced_minify_custom_css']) {
				$css .= $filesystem->get_contents(react_minify_css(REACT_CACHE_DIR . '/' . $woocommerceCssFilename));
			} else {
				$css .= $filesystem->get_contents(REACT_CACHE_DIR . '/' . $woocommerceCssFilename);
			}
		}

		if (is_child_theme()) {
			if ($minify) {
				$css .= $filesystem->get_contents(react_minify_css(REACT_CHILD_DIR . '/style.css'));
			} else {
				$css .= $filesystem->get_contents(REACT_CHILD_DIR . '/style.css');
			}
		}

		$filesystem->put_contents($styleFile, $css);
	}
}

/**
 * Generate the combined JavaScript file
 *
 * @param  array  			   $options     The theme options
 * @param  WP_Filesystem_Base  $filesystem
 */
function react_generate_combined_js_file($options, $filesystem)
{
	$scripts = react_get_scripts();
	$scriptFile = REACT_CACHE_DIR . '/scripts.js';

	if ($filesystem->is_writable(REACT_CACHE_DIR)) {
		$minify = $options['advanced_minify_js'];
		$js = '';

		if (!class_exists('JSqueeze')) {
			require_once REACT_ADMIN_INCLUDES_DIR . '/class-jsqueeze.php';
		}

		$parser = new JSqueeze;

		foreach ($scripts as $key => $script) {
			if (!in_array($key, $options['advanced_disable_js']) && $script['footer']) {
				if (isset($script['reqs']) && $options[key($script['reqs'])] != current($script['reqs'])) {
					continue;
				}

				if ($minify && (isset($script['minify']) && $script['minify'])) {
					$js .= $parser->squeeze($filesystem->get_contents($script['path']));
				} else {
					$js .= $filesystem->get_contents($script['path']);
				}
			}
		}

		$js .= $filesystem->get_contents(REACT_DIR . '/js/scripts.min.js');

		$filesystem->put_contents($scriptFile, $js);
	}
}

/**
 * Enqueue the CSS stylesheets
 *
 * @param   string  $hook  The current page
 */
function react_enqueue_admin_styles($hook)
{
	if (in_array($hook, array('appearance_page_react', 'post.php', 'post-new.php'))) {
		if ($hook == 'appearance_page_react') {
			wp_enqueue_style('thickbox');
			wp_enqueue_style('spectrum', react_admin_url('js/spectrum/spectrum.css'), array(), '1.7.1');
		}

		wp_enqueue_style('qtip2', react_url('js/qtip2/jquery.qtip.min.css'), array(), '2.2.1');
		wp_enqueue_style('icomoon', react_url('css/icomoon.min.css'), array(), '1.1.1');
		wp_enqueue_style('fontawesome', react_url('css/font-awesome.min.css'), array(), '4.6.3');
		wp_enqueue_style('react-admin', react_admin_url('css/styles.min.css'), array(), REACT_VERSION);

		if (is_rtl()) {
			wp_enqueue_style('react-admin-rtl', react_admin_url('css/rtl.min.css'), array(), REACT_VERSION);
		}
	}
}
add_action('admin_enqueue_scripts', 'react_enqueue_admin_styles', 10, 1);

/**
 * Enqueue the admin JavaScript
 *
 * @param   string  $hook  The current page
 */
function react_enqueue_admin_scripts($hook)
{
	if (in_array($hook, array('appearance_page_react', 'post.php', 'post-new.php'))) {
		wp_enqueue_script('jquery-toggleswitch', react_admin_url('js/jquery.toggleswitch.js'), array('jquery'), '1.2.1', true);
		wp_enqueue_script('jslider', react_admin_url('js/jslider/jquery.slider.min.js'), array('jquery'), '1.2.0', true);
		wp_enqueue_script('jquery-tools-tabs', react_url('js/jquery.tools.tabs.min.js'), array('jquery'), '1.2.7', true);
		wp_enqueue_script('qtip2', react_url('js/qtip2/jquery.qtip.min.js'), array('jquery'), '2.2.1', true);
		wp_enqueue_script('react-admin', react_admin_url('js/admin.min.js'), array('jquery', 'json2'), REACT_VERSION, true);

		if ($hook === 'appearance_page_react') {
			wp_enqueue_media();

			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('spectrum', react_admin_url('js/spectrum/spectrum.min.js'), array('jquery'), '1.7.1', true);

			if (wp_is_mobile()) {
				wp_enqueue_script('jquery-touch-punch');
			}

			wp_enqueue_script('react-color-schemes', react_admin_url('js/color-schemes.min.js'), array('react-admin'), REACT_VERSION, true);
			wp_enqueue_script('react-color-palette-schemes', react_admin_url('js/palette-color-schemes.min.js'), array('react-admin'), REACT_VERSION, true);
			wp_enqueue_script('react-panel', react_admin_url('js/panel.min.js'), array('jquery', 'react-admin', 'thickbox'), REACT_VERSION, true);
		} elseif (in_array($hook, array('post.php', 'post-new.php'))) {
			wp_enqueue_media();
			wp_enqueue_script('react-metabox', react_admin_url('js/metabox.min.js'), array('jquery', 'jquery-ui-sortable'), REACT_VERSION, true);
		}

		wp_localize_script('react-admin', 'reactAdminL10n', react_admin_l10n());
	}
}
add_action('admin_enqueue_scripts', 'react_enqueue_admin_scripts', 10, 1);

function react_admin_l10n()
{
	$data = array(
		'siteUrl' => site_url(),
		'homeUrl' => home_url(),
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'uploadsUrl' => react_uploads_url(),
		'themeUrl' => react_url(),
		'themeAdminUrl' => react_admin_url(),
		'uploadThumbnailHtml' => react_get_upload_thumbnail_html(),
		'backgroundGroupHtml' => react_get_background_group_html(),
		'backgroundThumbnailHtml' => react_get_background_thumbnail_html(),
		'backgroundAudioHtml' => react_get_background_audio_html(),
		'confirmDeleteBackgroundGroup' => esc_html__('Are you sure you want to delete this image group?', 'react'),
		'untitled' => esc_html__('Untitled', 'react'),
		'on' => esc_html__('On', 'react'),
		'off' => esc_html__('Off', 'react'),
		'_default' => esc_html__('Default', 'react'),
		'yes' => esc_html__('Yes', 'react'),
		'no' => esc_html__('No', 'react'),
		'none' => esc_html__('None', 'react'),
		'light' => esc_html__('Light', 'react'),
		'dark' => esc_html__('Dark', 'react'),
		'enabled' => esc_html__('Enabled', 'react'),
		'disabled' => esc_html__('Disabled', 'react'),
		'name' => esc_html__('Name', 'react'),
		'saveNonce' => wp_create_nonce('react_save_options'),
		'resetNonce' => wp_create_nonce('react_reset_options'),
		'importNonce' => wp_create_nonce('react_import_options'),
		'exportNonce' => wp_create_nonce('react_export_options'),
		'confirmResetTranslations' => esc_html__('Are you sure you want to reset all translations?', 'react'),
		'close' => esc_html__('Close', 'react'),
		'save' => esc_html__('Save', 'react'),
		'cancel' => esc_html__('Cancel', 'react'),
		'reloadingPage' => esc_html__('Reloading page', 'react'),
		'startingImport' => esc_html__('Starting import', 'react'),
		'confirmResetOptions' => esc_html__('Are you sure you want to reset all options?' , 'react'),
		'confirmHideWelcome' => esc_html__('Are you sure you want to permanently hide the Welcome tab?', 'react'),
		'imCustomWidgetAreaHtml' => react_im_custom_widget_area_html(),
		'confirmDeleteImCwa' => esc_html__('Are you sure you want to delete this widget area?', 'react'),
		'customPaletteHtml' => react_custom_palette_html(),
		'confirmDeleteCustomPalette' => esc_html__('Are you sure you want to delete this custom palette?', 'react'),
		'confirmDeleteAudioTrack' => esc_html__('Are you sure you want to delete this track?', 'react'),
		'select_background_images' => esc_html__('Select Background Image(s)', 'react'),
		'browse' => esc_html__('Browse', 'react'),
		'select_audio_track' => esc_html__('Select Audio Track', 'react'),
		'select' => esc_html__('Select', 'react'),
		'select_image' => esc_html__('Select Image', 'react'),
		'unsaved_changes' => esc_html__('You have unsaved changes.', 'react'),
		'change_colors' => esc_html__('This will change all colors.', 'react'),
		'change_palette' => esc_html__('This will change all colors for this Palette.', 'react'),
		'no_icon_selected' => esc_html__('No icon selected', 'react'),
		'pleaseEnterColor' => esc_html__('Please enter a color to find', 'react'),
		'noMatchingColors' => esc_html__('No matching colors found', 'react'),
		'areYouSureReplaceColors' => esc_html__('Are you sure you want to replace %d color(s)?', 'react'),
		'noBackground' => esc_html__('No background', 'react'),
		'showCaseStudiesNonce' => wp_create_nonce('react_show_case_studies'),
		'caseStudyHtml' => react_get_case_study_html(),
		'installCaseStudyNonce' => wp_create_nonce('react_install_case_study'),
		'informationHtml' => React_Options_Generator::getInformationHtml()
	);

	return array(
		'l10n_print_after' => 'reactAdminL10n = ' . wp_json_encode($data) . ';'
	);
}

function react_background_settings_form()
{
	?><div id="react-background-settings-overlay" class="react-lightbox-overlay">
	<div id="react-background-settings" class="react-lightbox">
		<table>
			<tr>
				<th scope="row"><label for="react-background-caption"><?php esc_html_e('Caption HTML', 'react'); ?></label></th>
				<td>
					<textarea id="react-background-caption" name="react-background-caption"></textarea>
					<p class="react-description"><?php esc_html_e('Enter the caption HTML, below is an example.', 'react'); ?></p>
					<pre>&lt;h3&gt;<?php esc_html_e('Sample Title', 'react'); ?>&lt;/h3&gt;
&lt;p&gt;<?php esc_html_e('Sample description.', 'react'); ?>&lt;/p&gt;</pre>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="react-background-caption-position"><?php esc_html_e('Caption position', 'react'); ?></label>
				</th>
				<td>
					<select id="react-background-caption-position" name="react-background-caption-position">
						<option value=""><?php esc_html_e('Default', 'react'); ?></option>
						<option value="random"><?php esc_html_e('Random', 'react'); ?></option>
						<option value="left top"><?php esc_html_e('left top', 'react'); ?></option>
						<option value="left center"><?php esc_html_e('left center', 'react'); ?></option>
						<option value="left bottom"><?php esc_html_e('left bottom', 'react'); ?></option>
						<option value="center top"><?php esc_html_e('center top', 'react'); ?></option>
						<option value="center center"><?php esc_html_e('center center', 'react'); ?></option>
						<option value="center bottom"><?php esc_html_e('center bottom', 'react'); ?></option>
						<option value="right top"><?php esc_html_e('right top', 'react'); ?></option>
						<option value="right center"><?php esc_html_e('right center', 'react'); ?></option>
						<option value="right bottom"><?php esc_html_e('right bottom', 'react'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="react-background-title"><?php esc_html_e('Title', 'react'); ?></label>
				</th>
				<td>
					<input type="text" id="react-background-title" name="react-background-title" />
					<p class="react-description"><?php esc_html_e('This is shown when hovering the bullet navigation in full screen mode', 'react'); ?></p>
				</td>
			</tr>
		</table>
		<div class="react-background-caption-buttons react-clearfix">
			<a id="react-background-caption-save" class="react-button react-blue"><?php esc_html_e('Save', 'react'); ?></a>
			<a id="react-background-caption-cancel" class="react-button react-light"><?php esc_html_e('Cancel', 'react'); ?></a>
		</div>
	</div>
</div><?php
}

/**
 * Handle the ajax request to hide the welcome tab
 */
function react_hide_welcome_tab_ajax()
{
	if (current_user_can('edit_theme_options')) {
		update_user_meta(get_current_user_id(), REACT_OPTIONS_PREFIX . '_hide_welcome_tab', true);
	}
	wp_die();
}
add_action('wp_ajax_react_hide_welcome_tab_ajax', 'react_hide_welcome_tab_ajax');

/**
 * Get the page layout options, for use in a <select>
 *
 * @param  boolean  $showDefaultOption  If true, show a default option
 * @return array
 */
function react_get_page_layout_options($showDefaultOption = false)
{
	$options = array(
		'pge-fld' => esc_html__('Full width fluid', 'react'),
		'pge-bxd-cnt' => esc_html__('Full width content boxed', 'react'),
		'pge-bxd' => esc_html__('Boxed', 'react'),
		'pge-mxd' => esc_html__('Mixed', 'react')
	);

	if ($showDefaultOption) {
		$options = array('' => esc_html__('Default', 'react')) + $options;
	}

	return $options;
}

/**
 * Get the convert options, for use in a <select>
 *
 * @param  boolean  $showDefaultOption  If true, show a default option
 * @return array
 */
function react_get_convert_options($showDefaultOption = false)
{
	$options = array(
		'phone-ptr' => esc_html__('Phone Portrait', 'react'),
		'phone-ldsp' => esc_html__('Phone Landscape', 'react'),
		'tablet-ptr' => esc_html__('Tablet Portrait', 'react'),
		'tablet-ldsp' => esc_html__('Tablet Landscape', 'react'),
		'box-width' => esc_html__('Site box width (if set)', 'react'),
		'only-retina-devices' => esc_html__('Only on Retina devices', 'react'),
		'custom' => esc_html__('Custom', 'react')
	);

	if ($showDefaultOption) {
		$options = array('' => esc_html__('Default', 'react')) + $options;
	}

	return $options;
}

/**
 * Gets the array of all available icons
 *
 * @return  array  The array of icons
 */
function react_get_icons()
{
	return array(
		'iconsprite' => array(
			'home', 'home2', 'office', 'newspaper', 'pen', 'image', 'images', 'camera', 'music', 'play', 'film', 'camera2', 'bullhorn', 'book', 'profile', 'file', 'file2', 'file3', 'mic', 'tag', 'credit', 'support', 'phone', 'address-book', 'pushpin', 'location', 'location2', 'clock', 'clock2', 'alarm', 'calendar', 'calendar2',
			'laptop', 'mobile', 'mobile2', 'box-add', 'box-remove', 'bubble', 'bubbles', 'user', 'users', 'cart', 'user3', 'busy', 'quotes-left', 'search', 'lock', 'unlocked', 'settings', 'equalizer', 'cog', 'bug', 'pie', 'stats', 'bars', 'gift', 'mug', 'food', 'fire', 'lab', 'airplane', 'truck', 'lightning', 'switch',
			'menu', 'earth', 'link', 'flag', 'attachment', 'eye', 'bookmark', 'star', 'heart', 'heart-broken', 'info', 'cancel-circle', 'checkmark-circle', 'checkmark', 'thumbsup', 'minus', 'plus', 'play2', 'pause', 'stop', 'backward', 'forward', 'first', 'last', 'previous', 'next', 'volume-high', 'volume-medium', 'volume-low', 'volume-mute', 'volume-mute2', 'volume-increase',
			'loop', 'radio-checked', 'radio-unchecked', 'paragraph-justify', 'new-tab', 'wifi', 'basket', 'google-plus', 'facebook', 'twitter', 'feed', 'youtube', 'vimeo', 'flickr', 'flickr2', 'skype', 'pinterest', 'paypal', 'directions', 'envelope', 'calendar3', 'coffee', 'globe',
		),
		'fontawesome' => array(
			 'fa-glass', 'fa-music', 'fa-search', 'fa-envelope-o', 'fa-heart', 'fa-star', 'fa-star-o', 'fa-user', 'fa-film', 'fa-th-large', 'fa-th', 'fa-th-list', 'fa-check', 'fa-remove', 'fa-close', 'fa-times', 'fa-search-plus', 'fa-search-minus', 'fa-power-off', 'fa-signal', 'fa-gear', 'fa-cog', 'fa-trash-o', 'fa-home', 'fa-file-o', 'fa-clock-o', 'fa-road', 'fa-download', 'fa-arrow-circle-o-down', 'fa-arrow-circle-o-up', 'fa-inbox', 'fa-play-circle-o', 'fa-rotate-right', 'fa-repeat', 'fa-refresh', 'fa-list-alt', 'fa-lock', 'fa-flag', 'fa-headphones', 'fa-volume-off', 'fa-volume-down', 'fa-volume-up', 'fa-qrcode', 'fa-barcode', 'fa-tag', 'fa-tags', 'fa-book', 'fa-bookmark', 'fa-print', 'fa-camera', 'fa-font', 'fa-bold', 'fa-italic', 'fa-text-height', 'fa-text-width', 'fa-align-left', 'fa-align-center', 'fa-align-right', 'fa-align-justify', 'fa-list', 'fa-dedent', 'fa-outdent', 'fa-indent', 'fa-video-camera', 'fa-photo', 'fa-image', 'fa-picture-o', 'fa-pencil', 'fa-map-marker', 'fa-adjust', 'fa-tint', 'fa-edit', 'fa-pencil-square-o', 'fa-share-square-o', 'fa-check-square-o', 'fa-arrows', 'fa-step-backward', 'fa-fast-backward', 'fa-backward', 'fa-play', 'fa-pause', 'fa-stop', 'fa-forward', 'fa-fast-forward', 'fa-step-forward', 'fa-eject', 'fa-chevron-left', 'fa-chevron-right', 'fa-plus-circle', 'fa-minus-circle', 'fa-times-circle', 'fa-check-circle', 'fa-question-circle', 'fa-info-circle', 'fa-crosshairs', 'fa-times-circle-o', 'fa-check-circle-o', 'fa-ban', 'fa-arrow-left', 'fa-arrow-right', 'fa-arrow-up', 'fa-arrow-down', 'fa-mail-forward', 'fa-share', 'fa-expand', 'fa-compress', 'fa-plus', 'fa-minus', 'fa-asterisk', 'fa-exclamation-circle', 'fa-gift', 'fa-leaf', 'fa-fire', 'fa-eye', 'fa-eye-slash', 'fa-warning', 'fa-exclamation-triangle', 'fa-plane', 'fa-calendar', 'fa-random', 'fa-comment', 'fa-magnet', 'fa-chevron-up', 'fa-chevron-down', 'fa-retweet', 'fa-shopping-cart', 'fa-folder', 'fa-folder-open', 'fa-arrows-v', 'fa-arrows-h', 'fa-bar-chart-o', 'fa-bar-chart', 'fa-twitter-square', 'fa-facebook-square', 'fa-camera-retro', 'fa-key', 'fa-gears', 'fa-cogs', 'fa-comments', 'fa-thumbs-o-up', 'fa-thumbs-o-down', 'fa-star-half', 'fa-heart-o', 'fa-sign-out', 'fa-linkedin-square', 'fa-thumb-tack', 'fa-external-link', 'fa-sign-in', 'fa-trophy', 'fa-github-square', 'fa-upload', 'fa-lemon-o', 'fa-phone', 'fa-square-o', 'fa-bookmark-o', 'fa-phone-square', 'fa-twitter', 'fa-facebook-f', 'fa-facebook', 'fa-github', 'fa-unlock', 'fa-credit-card', 'fa-feed', 'fa-rss', 'fa-hdd-o', 'fa-bullhorn', 'fa-bell', 'fa-certificate', 'fa-hand-o-right', 'fa-hand-o-left', 'fa-hand-o-up', 'fa-hand-o-down', 'fa-arrow-circle-left', 'fa-arrow-circle-right', 'fa-arrow-circle-up', 'fa-arrow-circle-down', 'fa-globe', 'fa-wrench', 'fa-tasks', 'fa-filter', 'fa-briefcase', 'fa-arrows-alt', 'fa-group', 'fa-users', 'fa-chain', 'fa-link', 'fa-cloud', 'fa-flask', 'fa-cut', 'fa-scissors', 'fa-copy', 'fa-files-o', 'fa-paperclip', 'fa-save', 'fa-floppy-o', 'fa-square', 'fa-navicon', 'fa-reorder', 'fa-bars', 'fa-list-ul', 'fa-list-ol', 'fa-strikethrough', 'fa-underline', 'fa-table', 'fa-magic', 'fa-truck', 'fa-pinterest', 'fa-pinterest-square', 'fa-google-plus-square', 'fa-google-plus', 'fa-money', 'fa-caret-down', 'fa-caret-up', 'fa-caret-left', 'fa-caret-right', 'fa-columns', 'fa-unsorted', 'fa-sort', 'fa-sort-down', 'fa-sort-desc', 'fa-sort-up', 'fa-sort-asc', 'fa-envelope', 'fa-linkedin', 'fa-rotate-left', 'fa-undo', 'fa-legal', 'fa-gavel', 'fa-dashboard', 'fa-tachometer', 'fa-comment-o', 'fa-comments-o', 'fa-flash', 'fa-bolt', 'fa-sitemap', 'fa-umbrella', 'fa-paste', 'fa-clipboard', 'fa-lightbulb-o', 'fa-exchange', 'fa-cloud-download', 'fa-cloud-upload', 'fa-user-md', 'fa-stethoscope', 'fa-suitcase', 'fa-bell-o', 'fa-coffee', 'fa-cutlery', 'fa-file-text-o', 'fa-building-o', 'fa-hospital-o', 'fa-ambulance', 'fa-medkit', 'fa-fighter-jet', 'fa-beer', 'fa-h-square', 'fa-plus-square', 'fa-angle-double-left', 'fa-angle-double-right', 'fa-angle-double-up', 'fa-angle-double-down', 'fa-angle-left', 'fa-angle-right', 'fa-angle-up', 'fa-angle-down', 'fa-desktop', 'fa-laptop', 'fa-tablet', 'fa-mobile-phone', 'fa-mobile', 'fa-circle-o', 'fa-quote-left', 'fa-quote-right', 'fa-spinner', 'fa-circle', 'fa-mail-reply', 'fa-reply', 'fa-github-alt', 'fa-folder-o', 'fa-folder-open-o', 'fa-smile-o', 'fa-frown-o', 'fa-meh-o', 'fa-gamepad', 'fa-keyboard-o', 'fa-flag-o', 'fa-flag-checkered', 'fa-terminal', 'fa-code', 'fa-mail-reply-all', 'fa-reply-all', 'fa-star-half-empty', 'fa-star-half-full', 'fa-star-half-o', 'fa-location-arrow', 'fa-crop', 'fa-code-fork', 'fa-unlink', 'fa-chain-broken', 'fa-question', 'fa-info', 'fa-exclamation', 'fa-superscript', 'fa-subscript', 'fa-eraser', 'fa-puzzle-piece', 'fa-microphone', 'fa-microphone-slash', 'fa-shield', 'fa-calendar-o', 'fa-fire-extinguisher', 'fa-rocket', 'fa-maxcdn', 'fa-chevron-circle-left', 'fa-chevron-circle-right', 'fa-chevron-circle-up', 'fa-chevron-circle-down', 'fa-html5', 'fa-css3', 'fa-anchor', 'fa-unlock-alt', 'fa-bullseye', 'fa-ellipsis-h', 'fa-ellipsis-v', 'fa-rss-square', 'fa-play-circle', 'fa-ticket', 'fa-minus-square', 'fa-minus-square-o', 'fa-level-up', 'fa-level-down', 'fa-check-square', 'fa-pencil-square', 'fa-external-link-square', 'fa-share-square', 'fa-compass', 'fa-toggle-down', 'fa-caret-square-o-down', 'fa-toggle-up', 'fa-caret-square-o-up', 'fa-toggle-right', 'fa-caret-square-o-right', 'fa-euro', 'fa-eur', 'fa-gbp', 'fa-dollar', 'fa-usd', 'fa-rupee', 'fa-inr', 'fa-cny', 'fa-rmb', 'fa-yen', 'fa-jpy', 'fa-ruble', 'fa-rouble', 'fa-rub', 'fa-won', 'fa-krw', 'fa-bitcoin', 'fa-btc', 'fa-file', 'fa-file-text', 'fa-sort-alpha-asc', 'fa-sort-alpha-desc', 'fa-sort-amount-asc', 'fa-sort-amount-desc', 'fa-sort-numeric-asc', 'fa-sort-numeric-desc', 'fa-thumbs-up', 'fa-thumbs-down', 'fa-youtube-square', 'fa-youtube', 'fa-xing', 'fa-xing-square', 'fa-youtube-play', 'fa-dropbox', 'fa-stack-overflow', 'fa-instagram', 'fa-flickr', 'fa-adn', 'fa-bitbucket', 'fa-bitbucket-square', 'fa-tumblr', 'fa-tumblr-square', 'fa-long-arrow-down', 'fa-long-arrow-up', 'fa-long-arrow-left', 'fa-long-arrow-right', 'fa-apple', 'fa-windows', 'fa-android', 'fa-linux', 'fa-dribbble', 'fa-skype', 'fa-foursquare', 'fa-trello', 'fa-female', 'fa-male', 'fa-gittip', 'fa-gratipay', 'fa-sun-o', 'fa-moon-o', 'fa-archive', 'fa-bug', 'fa-vk', 'fa-weibo', 'fa-renren', 'fa-pagelines', 'fa-stack-exchange', 'fa-arrow-circle-o-right', 'fa-arrow-circle-o-left', 'fa-toggle-left', 'fa-caret-square-o-left', 'fa-dot-circle-o', 'fa-wheelchair', 'fa-vimeo-square', 'fa-turkish-lira', 'fa-try', 'fa-plus-square-o', 'fa-space-shuttle', 'fa-slack', 'fa-envelope-square', 'fa-wordpress', 'fa-openid', 'fa-institution', 'fa-bank', 'fa-university', 'fa-mortar-board', 'fa-graduation-cap', 'fa-yahoo', 'fa-google', 'fa-reddit', 'fa-reddit-square', 'fa-stumbleupon-circle', 'fa-stumbleupon', 'fa-delicious', 'fa-digg', 'fa-pied-piper-pp', 'fa-pied-piper-alt', 'fa-drupal', 'fa-joomla', 'fa-language', 'fa-fax', 'fa-building', 'fa-child', 'fa-paw', 'fa-spoon', 'fa-cube', 'fa-cubes', 'fa-behance', 'fa-behance-square', 'fa-steam', 'fa-steam-square', 'fa-recycle', 'fa-automobile', 'fa-car', 'fa-cab', 'fa-taxi', 'fa-tree', 'fa-spotify', 'fa-deviantart', 'fa-soundcloud', 'fa-database', 'fa-file-pdf-o', 'fa-file-word-o', 'fa-file-excel-o', 'fa-file-powerpoint-o', 'fa-file-photo-o', 'fa-file-picture-o', 'fa-file-image-o', 'fa-file-zip-o', 'fa-file-archive-o', 'fa-file-sound-o', 'fa-file-audio-o', 'fa-file-movie-o', 'fa-file-video-o', 'fa-file-code-o', 'fa-vine', 'fa-codepen', 'fa-jsfiddle', 'fa-life-bouy', 'fa-life-buoy', 'fa-life-saver', 'fa-support', 'fa-life-ring', 'fa-circle-o-notch', 'fa-ra', 'fa-resistance', 'fa-rebel', 'fa-ge', 'fa-empire', 'fa-git-square', 'fa-git', 'fa-y-combinator-square', 'fa-yc-square', 'fa-hacker-news', 'fa-tencent-weibo', 'fa-qq', 'fa-wechat', 'fa-weixin', 'fa-send', 'fa-paper-plane', 'fa-send-o', 'fa-paper-plane-o', 'fa-history', 'fa-circle-thin', 'fa-header', 'fa-paragraph', 'fa-sliders', 'fa-share-alt', 'fa-share-alt-square', 'fa-bomb', 'fa-soccer-ball-o', 'fa-futbol-o', 'fa-tty', 'fa-binoculars', 'fa-plug', 'fa-slideshare', 'fa-twitch', 'fa-yelp', 'fa-newspaper-o', 'fa-wifi', 'fa-calculator', 'fa-paypal', 'fa-google-wallet', 'fa-cc-visa', 'fa-cc-mastercard', 'fa-cc-discover', 'fa-cc-amex', 'fa-cc-paypal', 'fa-cc-stripe', 'fa-bell-slash', 'fa-bell-slash-o', 'fa-trash', 'fa-copyright', 'fa-at', 'fa-eyedropper', 'fa-paint-brush', 'fa-birthday-cake', 'fa-area-chart', 'fa-pie-chart', 'fa-line-chart', 'fa-lastfm', 'fa-lastfm-square', 'fa-toggle-off', 'fa-toggle-on', 'fa-bicycle', 'fa-bus', 'fa-ioxhost', 'fa-angellist', 'fa-cc', 'fa-shekel', 'fa-sheqel', 'fa-ils', 'fa-meanpath', 'fa-buysellads', 'fa-connectdevelop', 'fa-dashcube', 'fa-forumbee', 'fa-leanpub', 'fa-sellsy', 'fa-shirtsinbulk', 'fa-simplybuilt', 'fa-skyatlas', 'fa-cart-plus', 'fa-cart-arrow-down', 'fa-diamond', 'fa-ship', 'fa-user-secret', 'fa-motorcycle', 'fa-street-view', 'fa-heartbeat', 'fa-venus', 'fa-mars', 'fa-mercury', 'fa-intersex', 'fa-transgender', 'fa-transgender-alt', 'fa-venus-double', 'fa-mars-double', 'fa-venus-mars', 'fa-mars-stroke', 'fa-mars-stroke-v', 'fa-mars-stroke-h', 'fa-neuter', 'fa-genderless', 'fa-facebook-official', 'fa-pinterest-p', 'fa-whatsapp', 'fa-server', 'fa-user-plus', 'fa-user-times', 'fa-hotel', 'fa-bed', 'fa-viacoin', 'fa-train', 'fa-subway', 'fa-medium', 'fa-yc', 'fa-y-combinator', 'fa-optin-monster', 'fa-opencart', 'fa-expeditedssl', 'fa-battery-4', 'fa-battery-full', 'fa-battery-3', 'fa-battery-three-quarters', 'fa-battery-2', 'fa-battery-half', 'fa-battery-1', 'fa-battery-quarter', 'fa-battery-0', 'fa-battery-empty', 'fa-mouse-pointer', 'fa-i-cursor', 'fa-object-group', 'fa-object-ungroup', 'fa-sticky-note', 'fa-sticky-note-o', 'fa-cc-jcb', 'fa-cc-diners-club', 'fa-clone', 'fa-balance-scale', 'fa-hourglass-o', 'fa-hourglass-1', 'fa-hourglass-start', 'fa-hourglass-2', 'fa-hourglass-half', 'fa-hourglass-3', 'fa-hourglass-end', 'fa-hourglass', 'fa-hand-grab-o', 'fa-hand-rock-o', 'fa-hand-stop-o', 'fa-hand-paper-o', 'fa-hand-scissors-o', 'fa-hand-lizard-o', 'fa-hand-spock-o', 'fa-hand-pointer-o', 'fa-hand-peace-o', 'fa-trademark', 'fa-registered', 'fa-creative-commons', 'fa-gg', 'fa-gg-circle', 'fa-tripadvisor', 'fa-odnoklassniki', 'fa-odnoklassniki-square', 'fa-get-pocket', 'fa-wikipedia-w', 'fa-safari', 'fa-chrome', 'fa-firefox', 'fa-opera', 'fa-internet-explorer', 'fa-tv', 'fa-television', 'fa-contao', 'fa-500px', 'fa-amazon', 'fa-calendar-plus-o', 'fa-calendar-minus-o', 'fa-calendar-times-o', 'fa-calendar-check-o', 'fa-industry', 'fa-map-pin', 'fa-map-signs', 'fa-map-o', 'fa-map', 'fa-commenting', 'fa-commenting-o', 'fa-houzz', 'fa-vimeo', 'fa-black-tie', 'fa-fonticons', 'fa-reddit-alien', 'fa-edge', 'fa-credit-card-alt', 'fa-codiepie', 'fa-modx', 'fa-fort-awesome', 'fa-usb', 'fa-product-hunt', 'fa-mixcloud', 'fa-scribd', 'fa-pause-circle', 'fa-pause-circle-o', 'fa-stop-circle', 'fa-stop-circle-o', 'fa-shopping-bag', 'fa-shopping-basket', 'fa-hashtag', 'fa-bluetooth', 'fa-bluetooth-b', 'fa-percent', 'fa-gitlab', 'fa-wpbeginner', 'fa-wpforms', 'fa-envira', 'fa-universal-access', 'fa-wheelchair-alt', 'fa-question-circle-o', 'fa-blind', 'fa-audio-description', 'fa-volume-control-phone', 'fa-braille', 'fa-assistive-listening-systems', 'fa-asl-interpreting', 'fa-american-sign-language-interpreting', 'fa-deafness', 'fa-hard-of-hearing', 'fa-deaf', 'fa-glide', 'fa-glide-g', 'fa-signing', 'fa-sign-language', 'fa-low-vision', 'fa-viadeo', 'fa-viadeo-square', 'fa-snapchat', 'fa-snapchat-ghost', 'fa-snapchat-square', 'fa-pied-piper', 'fa-first-order', 'fa-yoast', 'fa-themeisle', 'fa-google-plus-circle', 'fa-google-plus-official', 'fa-font-awesome'
		),

		'icomoon' => array(
			'icon-mobile', 'icon-laptop', 'icon-desktop', 'icon-tablet', 'icon-phone', 'icon-document', 'icon-documents', 'icon-search', 'icon-clipboard', 'icon-newspaper','icon-notebook', 'icon-book-open', 'icon-browser', 'icon-tablet', 'icon-calendar', 'icon-presentation', 'icon-picture', 'icon-pictures', 'icon-video', 'icon-camera','icon-printer', 'icon-toolbox', 'icon-briefcase', 'icon-wallet', 'icon-gift', 'icon-bargraph', 'icon-grid', 'icon-expand', 'icon-focus', 'icon-edit','icon-adjustments', 'icon-ribbon', 'icon-hourglass', 'icon-lock', 'icon-megaphone', 'icon-shield', 'icon-trophy', 'icon-flag', 'icon-map', 'icon-puzzle','icon-basket', 'icon-envelope', 'icon-streetsign', 'icon-telescope', 'icon-gears', 'icon-key', 'icon-paperclip', 'icon-attachment', 'icon-pricetags', 'icon-lightbulb','icon-layers', 'icon-pencil', 'icon-tools', 'icon-tools-2', 'icon-scissors', 'icon-paintbrush', 'icon-magnifying-glass', 'icon-circle-compass', 'icon-linegraph', 'icon-mic','icon-strategy', 'icon-beaker', 'icon-caution', 'icon-recycle', 'icon-anchor', 'icon-profile-male', 'icon-profile-female', 'icon-bike', 'icon-wine', 'icon-hotairballoon','icon-piechart', 'icon-genius', 'icon-map-pin', 'icon-dial', 'icon-chat', 'icon-heart', 'icon-cloud', 'icon-upload', 'icon-download', 'icon-target', 'icon-hazardous','icon-globe', 'icon-speedometer', 'icon-global', 'icon-compass', 'icon-lifesaver', 'icon-clock', 'icon-aperture', 'icon-quote', 'icon-scope', 'icon-alarmclock', 'icon-refresh','icon-happy', 'icon-sad', 'icon-map-pin', 'icon-dial', 'icon-chat', 'icon-heart', 'icon-cloud','icon-globe', 'icon-genius', 'icon-facebook', 'icon-twitter', 'icon-googleplus', 'icon-rss', 'icon-tumblr', 'icon-linkedin', 'icon-dribbble', 'icon-times', 'icon-tick','icon-plus', 'icon-minus', 'icon-divide', 'icon-chevron-right', 'icon-chevron-left', 'icon-arrow-right-thick', 'icon-arrow-left-thick','icon-th-small', 'icon-arrow-forward', 'icon-arrow-back', 'icon-rss2','icon-location', 'icon-link', 'icon-image', 'icon-arrow-up-thick', 'icon-arrow-down-thick', 'icon-starburst', 'icon-starburst-outline','icon-star', 'icon-flow-children', 'icon-export', 'icon-delete','icon-delete-outline', 'icon-cloud-storage', 'icon-wi-fi', 'icon-heart2', 'icon-flash', 'icon-cancel', 'icon-backspace','icon-attachment2', 'icon-arrow-move', 'icon-warning', 'icon-user','icon-radar', 'icon-lock-open', 'icon-lock-closed', 'icon-location-arrow', 'icon-user-delete', 'icon-user-add', 'icon-media-pause','icon-group', 'icon-chart-pie', 'icon-chart-line', 'icon-chart-bar', 'icon-chart-area', 'icon-video2', 'icon-point-of-interest', 'icon-infinity', 'icon-globe2', 'icon-eye', 'icon-cog','icon-camera2', 'icon-upload2', 'icon-scissors2', 'icon-refresh2', 'icon-pin', 'icon-key2', 'icon-info-large','icon-eject', 'icon-download2', 'icon-zoom', 'icon-zoom-out','icon-zoom-in', 'icon-sort-numerically', 'icon-sort-alphabetically', 'icon-input-checked', 'icon-calender', 'icon-world', 'icon-notes','icon-code', 'icon-arrow-sync', 'icon-arrow-shuffle', 'icon-arrow-minimise','icon-arrow-maximise','icon-arrow-loop','icon-anchor2','icon-spanner','icon-puzzle2','icon-power','icon-plane','icon-pi','icon-phone2', 'icon-microphone','icon-media-rewind','icon-flag2','icon-adjust-brightness','icon-waves','icon-social-twitter','icon-social-facebook','icon-social-dribbble','icon-media-stop','icon-media-record','icon-media-play','icon-media-fast-forward','icon- icon-media-eject', 'icon-social-vimeo','icon-social-tumbler','icon-social-skype','icon-social-pinterest','icon-social-linkedin','icon-social-last-fm','icon-social-github','icon-social-flickr','icon-at','icon-times-outline','icon-minus-outline','icon-tick-outline','icon-th-large-outline','icon-equals-outline','icon-divide-outline','icon-chevron-right-outline', 'icon-chevron-left-outline','icon-arrow-right-outline','icon-arrow-left-outline','icon-th-small-outline','icon-th-menu-outline','icon-th-list-outline','icon-news','icon-home-outline','icon-arrow-up-outline','icon-arrow-forward-outline','icon-arrow-down-outline','icon-arrow-back-outline','icon-trash','icon-rss-outline','icon-message','icon-location-outline','icon-link-outline','icon-image-outline','icon-export-outline','icon-cross','icon-wi-fi-outline','icon-star-outline','icon-media-pause-outline','icon-mail','icon-heart-outline','icon-flash-outline','icon-cancel-outline','icon-beaker2', 'icon-arrow-move-outline','icon-watch','icon-warning-outline','icon-time','icon-radar-outline','icon-lock-open-outline','icon-location-arrow-outline','icon-info-outline','icon-backspace-outline','icon-attachment-outline','icon-user-outline','icon-user-delete-outline','icon-user-add-outline','icon-lock-closed-outline','icon-group-outline','icon-chart-pie-outline','icon-chart-line-outline','icon-chart-bar-outline','icon-chart-area-outline','icon-video-outline','icon-point-of-interest-outline','icon-map2','icon-key-outline','icon-infinity-outline','icon-globe-outline','icon-eye-outline','icon-cog-outline','icon-camera-outline','icon-upload-outline','icon-support','icon-scissors-outline','icon-refresh-outline','icon-info-large-outline','icon-eject-outline','icon-download-outline','icon-battery-mid','icon-battery-low','icon-battery-high','icon-zoom-outline','icon-zoom-out-outline','icon-zoom-in-outline','icon-tag','icon-tabs-outline','icon-pin-outline','icon-message-typing','icon-directions','icon-battery-full','icon-battery-charge','icon-pipette','icon-pencil2','icon-folder','icon-folder-delete','icon-folder-add','icon-edit2','icon-document-delete','icon-document-add','icon-brush','icon-thumbs-up','icon-thumbs-down','icon-pen','icon-sort-numerically-outline','icon-sort-alphabetically-outline','icon-social-last-fm-circular','icon-social-github-circular','icon-compass2','icon-bookmark','icon-input-checked-outline','icon-code-outline','icon-calender-outline','icon-business-card','icon-arrow-up','icon-arrow-sync-outline','icon-arrow-right','icon-arrow-repeat-outline','icon-arrow-loop-outline','icon-arrow-left','icon-flow-switch','icon-flow-parallel','icon-flow-merge','icon-document-text','icon-clipboard2','icon-calculator','icon-arrow-minimise-outline','icon-arrow-maximise-outline','icon-arrow-down','icon-gift2','icon-film','icon-database','icon-bell','icon-anchor-outline','icon-adjust-contrast','icon-world-outline','icon-shopping-bag','icon-power-outline','icon-notes-outline','icon-device-tablet','icon-device-phone','icon-device-laptop','icon-device-desktop','icon-briefcase2','icon-spanner-outline','icon-puzzle-outline','icon-printer2','icon-pi-outline','icon-lightbulb2','icon-flag-outline','icon-contacts','icon-archive','icon-weather-stormy','icon-weather-shower','icon-weather-partly-sunny','icon-weather-downpour','icon-weather-cloudy','icon-plane-outline','icon-phone-outline','icon-microphone-outline', 'icon-weather-windy','icon-weather-windy-cloudy','icon-weather-sunny','icon-weather-snow','icon-weather-night','icon-media-stop-outline','icon-media-rewind-outline','icon-media-record-outline','icon-media-play-outline','icon-media-fast-forward-outline','icon-media-eject-outline','icon-wine2','icon-waves-outline','icon-ticket','icon-tags','icon-plug','icon-headphones','icon-credit-card','icon-coffee','icon-book','icon-beer','icon-volume','icon-volume-up','icon-volume-mute', 'icon-volume-down','icon-social-vimeo-circular','icon-social-twitter-circular','icon-social-pinterest-circular','icon-social-linkedin-circular','icon-social-facebook-circular','icon-social-dribbble-circular','icon-tree','icon-thermometer','icon-social-tumbler-circular','icon-social-skype-outline','icon-social-flickr-circular','icon-social-at-circular','icon-shopping-cart','icon-messages','icon-leaf','icon-feather'
		)

	);
}

/**
 * Returns the HTML for the icon selector
 *
 * @return  string
 */
function react_render_icon_selector()
{
	$icons = react_get_icons();
	$output = '<div class="react-icon-selector">';

	$output .= '<div class="react-icon-selector-search"><input placeholder="' . esc_attr__('Search', 'react') . '"><span>&times;</span></div>';

	$output .= '<div class="react-icon-selector-title react-icon-subset-fa">' . esc_html__('FontAwesome Icons', 'react') . '</div>';

	foreach ($icons['fontawesome'] as $icon) {
		$output .= '<div class="react-icon-option react-icon-subset-fa">';
		$output .= '<span title="' . esc_attr(ucfirst(str_replace('-', ' ', preg_replace('/^fa\-/', '', $icon)))) . '" data-icon="' . esc_attr($icon) . '" class="' . esc_attr(react_sanitize_class('fa ' . $icon)) . '"></span>';
		$output .= '</div>';
	}

	$output .= '<div class="react-icon-selector-title react-icon-subset-mix">' . esc_html__('Mixed Icons', 'react') . '</div>';

	foreach ($icons['icomoon'] as $icon) {
		$output .= '<div class="react-icon-option react-icon-subset-mix">';
		$output .= '<span title="' . esc_attr(ucfirst(str_replace('-', ' ', preg_replace('/^icon\-/', '', $icon)))) . '" data-icon="' . esc_attr($icon) . '" class="' . esc_attr(react_sanitize_class('mix-ico ' . $icon)) . '"></span>';
		$output .= '</div>';
	}

	$output .= '<div class="react-icon-selector-title react-icon-subset-is">' . esc_html__('Image Icons', 'react') . '</div>';

	foreach ($icons['iconsprite'] as $icon) {
		$output .= '<div class="react-icon-option react-icon-subset-is">';
		$output .= '<span title="' . esc_attr(ucfirst(str_replace('-', ' ', $icon))) . '" data-icon="' . esc_attr($icon) . '" class="' . esc_attr(react_sanitize_class('sml iconsprite ' . $icon)) . '"></span>';
		$output .= '</div>';
	}

	$output .= '</div>';

	return $output;
}

/**
 * Returns the HTML for the icon selector field
 *
 * @param  string  $selectedIcon  The selected icon
 * @param  string  $key           The name of the field
 * @param  string  $id            The ID of the field
 * @param  string  $subset        Subset of icons to show ('is' or 'fa')
 * @return string                 The field HTML
 */
function react_icon_selector_field($selectedIcon, $key = '', $id = '', $subset = '')
{
	$output = '<input' . ($id ? ' id="' . esc_attr($id) . '"' : '') . ' class="react-icon-selector-hidden" type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($selectedIcon) . '" />
		<div class="react-icon-selector-current react-clearfix">';
	if ($selectedIcon) {
		$output .= '<span class="' . esc_attr(react_sanitize_class('react-chosen-icon ' . react_get_icon_classes($selectedIcon))) . '"></span>';
	} else {
		$output .= '<span class="react-chosen-icon react-no-icon">' . esc_html__('No icon selected', 'react') . '</span>';
	}

	if ($subset) {
		$subset = 'react-only-subset-' . $subset;
	}

	$output .= '<a class="' . esc_attr(react_sanitize_class('react-button react-orange react-icon-select-trigger ' . $subset)) . '">' . esc_html__('Choose Icon', 'react') . '</a>';
	$output .= '<span class="' . esc_attr(react_sanitize_class('react-choose-no-icon' . ($selectedIcon ? '' : ' react-hidden'))) . '">' . esc_html__('Clear', 'react') . '</span>';
	$output .= '</div>';
	return $output;
}

/**
 * Get the top header type options to use in a select
 *
 * @return  array  The top header types
 */
function react_get_header_tophead_type_options()
{
	$options = array(
		'th-thin' => esc_html__('Thin', 'react'),
		'th-med' => esc_html__('Medium', 'react'),
		'th-bold' => esc_html__('Big', 'react')
	);

	return $options;
}

/**
 * Get the social icon types options to use in a select
 *
 * @return  array  The social icon types
 */
function react_get_social_icon_type_options()
{
	$options = array(
		'type-1' => esc_html__('SVG retina ready, IE image fallback', 'react'),
		'type-2' => esc_html__('FontAwesome text colored', 'react'),
		'type-3' => esc_html__('FontAwesome brand colored', 'react'),
		'type-4' => esc_html__('FontAwesome brand colored on hover', 'react'),
		'type-3 rounded' => esc_html__('FontAwesome brand colored (round)', 'react'),
		'type-4 rounded' => esc_html__('FontAwesome brand colored on hover (round)', 'react')
	);

	return $options;
}

/**
 * Get the texture options
 *
 * @param   boolean  $showDefaultOption  Include the Default empty option
 * @return  array                        The texture options array
 */
function react_get_texture_options($showDefaultOption = false)
{
	$options = array(
		'none' => esc_html__('None', 'react'),
		'vert-thin-dk' => esc_html__('Vertical thin lines dark', 'react'),
		'vert-thick-dk' => esc_html__('Vertical thick lines dark', 'react'),
		'diagonal-dk' => esc_html__('Diagonal lines dark', 'react'),
		'diagonal-rev-dk' => esc_html__('Diagonal reversed dark', 'react'),
		'square-dk' => esc_html__('Squares dark', 'react'),
		'dot-dk' => esc_html__('Dots dark', 'react'),
		'cross-dk' => esc_html__('Crosses dark 2', 'react'),
		'cross-two-dk' => esc_html__('Crosses dark', 'react'),

		'vert-thin-lt' => esc_html__('Vertical thin lines light', 'react'),
		'vert-thick-lt' => esc_html__('Vertical thick lines light', 'react'),
		'diagonal-lt' => esc_html__('Diagonal lines light', 'react'),
		'diagonal-rev-lt' => esc_html__('Diagonal reversed light', 'react'),
		'square-lt' => esc_html__('Squares light', 'react'),
		'dot-lt' => esc_html__('Dots light', 'react'),
		'cross-lt' => esc_html__('Crosses light 2', 'react'),
		'cross-two-lt' => esc_html__('Crosses light', 'react'),

		'congruent_pentagon' => esc_html__('Congruent pentagon light', 'react'),
		'congruent_pentagon_dark' => esc_html__('Congruent pentagon dark', 'react'),
		'dark_wood' => esc_html__('Dark wood', 'react'),
		'diagonal_striped_brick' => esc_html__('Diagonal striped bricks', 'react'),
		'diamond_upholstery' => esc_html__('Diamond upholstery', 'react'),
		'escheresque' => esc_html__('Escheresque', 'react'),
		'fake_brick' => esc_html__('Fake brick', 'react'),
		'pinstriped_suit' => esc_html__('Pinstriped suit', 'react'),
		'ps_neutral' => esc_html__('PhotoShop Neutral', 'react'),
		'retina_wood' => esc_html__('Light wood', 'react'),
		'shattered' => esc_html__('Shattered dark', 'react'),
		'shattered-lgt' => esc_html__('Shattered light', 'react'),
		'skulls' => esc_html__('Fantasy', 'react'),
		'noise' => esc_html__('Noise', 'react'),
		'use_your_illusion' => esc_html__('Use your illusion', 'react'),

		'white_wave' => esc_html__('White wave', 'react'),
		'pixel_weave' => esc_html__('Pixel weave', 'react'),
		'alt_tri' => esc_html__('Alternate triangles', 'react'),
		'hex' => esc_html__('Hexagon', 'react'),
		'squared_metal' => esc_html__('Squared metal', 'react'),
		'multi_dots' => esc_html__('Multiple dots', 'react'),
		'bigstrips' => esc_html__('Thin stripes', 'react'),
		'hugestripes' => esc_html__('Fat stripes', 'react')
	);

	if ($showDefaultOption) {
		$options = array('' => esc_html__('Default (inherited from Theme Options)', 'react')) + $options;
	}

	return $options;
}

/**
 * Get the background detail options
 *
 * @param   boolean  $showDefaultOption  Include the Default empty option
 * @return  array                        The background detail options
 */
function react_get_detail_options($showDefaultOption = false)
{
	$options = array(
		'none' => esc_html__('None', 'react'),

		'break-lines-light' => esc_html__('Diagonal lines', 'react'),
		'break-lines-light-bottom' => esc_html__('Bottom diagonal lines', 'react'),

		'one-light' => esc_html__('Top 1px Highlight', 'react'),
		'one-light-bottom' => esc_html__('Bottom 1px Highlight', 'react'),

		'six-light' => esc_html__('Top 6px Highlight', 'react'),
		'six-light-bottom' => esc_html__('Bottom 6px Highlight', 'react'),

		'med-gradient-light-top' => esc_html__('Medium gradient, light, top', 'react'),
		'med-gradient-light-bottom' => esc_html__('Medium gradient, light, bottom', 'react'),

		'large-gradient-light-top' => esc_html__('Large gradient, light, top', 'react'),
		'large-gradient-light-bottom' => esc_html__('Large gradient, light, bottom', 'react'),

		'solid-edge-light' => esc_html__('Solid outline light', 'react'),
		'small-edge-light' => esc_html__('Lighter to edges small', 'react'),
		'large-edge-light' => esc_html__('Lighter to edges large', 'react'),

		'break-lines-dark' => esc_html__('Diagonal lines', 'react'),
		'break-lines-dark-bottom' => esc_html__('Bottom diagonal lines', 'react'),

		'one-dark' => esc_html__('Top 1px shadow', 'react'),
		'one-dark-bottom' => esc_html__('Bottom 1px shadow', 'react'),

		'six-dark' => esc_html__('Top 3px shadow', 'react'),
		'six-dark-bottom' => esc_html__('Bottom 3px shadow', 'react'),

		'med-gradient-dark-top' => esc_html__('Medium gradient, dark, top', 'react'),
		'med-gradient-dark-bottom' => esc_html__('Medium gradient, dark, bottom', 'react'),

		'large-gradient-dark-top' => esc_html__('Large gradient, dark, top', 'react'),
		'large-gradient-dark-bottom' => esc_html__('Large gradient, dark, bottom', 'react'),

		'solid-edge-dark' => esc_html__('Solid outline dark', 'react'),
		'small-edge-dark' => esc_html__('Darker to edges small', 'react'),
		'large-edge-dark' => esc_html__('Darker to edges large', 'react'),

		'shadow-left' => esc_html__('Shadow left', 'react'),
		'shadow-center' => esc_html__('Shadow center', 'react'),
		'shadow-center-split' => esc_html__('Shadow center split', 'react'),
		'shadow-sides' => esc_html__('Shadow sides', 'react')
	);

	if ($showDefaultOption) {
		$options = array('' => esc_html__('Default (inherited from Theme Options)', 'react')) + $options;
	}

	return $options;
}

/**
 * Get the intro title style options
 *
 * @param   boolean  $showDefaultOption  Include the Default empty option
 * @return  array                        The intro title style options
 */
function react_get_intro_title_style_options($showDefaultOption = false)
{
	$options = array(
		'none' => esc_html__('Plain text', 'react'),
		'light-box' => esc_html__('Light transparent box', 'react'),
		'dark-box' => esc_html__('Dark transparent box', 'react'),
		'alternate-box' => esc_html__('Alternate light/dark', 'react')
	);

	if ($showDefaultOption) {
		$options = array('' => esc_html__('Default', 'react')) + $options;
	}

	return $options;
}
function react_get_intro_title_position_options($showDefaultOption = false)
{
	$options = array(
		'none' => esc_html__('None', 'react'),
		'textleft' => esc_html__('Left', 'react'),
		'textcenter' => esc_html__('Center', 'react'),
		'textright' => esc_html__('Right', 'react'),
		'textleft inline' => esc_html__('Side by side left', 'react'),
		'textcenter inline' => esc_html__('Side by side center', 'react')
	);

	if ($showDefaultOption) {
		$options = array('' => esc_html__('Default', 'react')) + $options;
	}

	return $options;
}

function react_get_intro_title_position_mobiles_options($showDefaultOption = false)
{
	$options = array(
		'' => esc_html__('None', 'react'),
		'phone-text-left' => esc_html__('Phone Left', 'react'),
		'phone-text-right' => esc_html__('Phone Right', 'react'),
		'phone-text-center' => esc_html__('Phone Center', 'react'),
		'tablet-text-left' => esc_html__('Tablet Left', 'react'),
		'tablet-text-right' => esc_html__('Tablet Right', 'react'),
		'tablet-text-center' => esc_html__('Tablet Center', 'react'),
		'moblies-text-left' => esc_html__('Moblies Left', 'react'),
		'moblies-text-right' => esc_html__('Moblies Right', 'react'),
		'moblies-text-center' => esc_html__('Moblies Center', 'react')
	);

	if ($showDefaultOption) {
		$options = array('' => esc_html__('Default', 'react')) + $options;
	}

	return $options;
}

/**
 * Get the array of Quform forms to use in a <select>
 *
 * @param   boolean  $showDefaultOption  Include the "Default" option
 * @param   string   $emptyOptionValue   For shortcodes we want the none/empty option to be the same so that no attribute is added when generating the SC.
 *                                       For metabox options we want none to be different from empty so that none forces no form wheres empty forces default inherit.
 * @return  array                        The array of forms
 */
function react_get_quform_forms_options($showDefaultOption = false, $emptyOptionValue = '')
{
	if (function_exists('iphorm_get_all_forms')) {
		$forms = iphorm_get_all_forms();

		if (count($forms)) {
			$options = array('none' => esc_html__('None', 'react'));
			foreach ($forms as $form) {
				$options[$form['id']] = $form['name'] . ($form['active'] == 0 ? ' (' . esc_html__('inactive', 'react') . ')' : '');
			}
		} else {
			$options = array($emptyOptionValue => esc_html__('No forms found', 'react'));
		}

		if ($showDefaultOption) {
			$options = array('' => esc_html__('Default', 'react')) + $options;
		}
	} else {
		$options = array($emptyOptionValue => esc_html__('Quform is not installed', 'react'));
	}

	return $options;
}

/**
 * Return the HTML for Quform form select
 *
 * @param   string  $key       The option name
 * @param   string  $selected  The selected option
 * @return  string
 */
function react_render_quform_form_select($key, $selected = '')
{
	$output = '';

	if (function_exists('iphorm')) {
		$forms = iphorm_get_all_forms();

		if (count($forms)) {
			$options = react_get_quform_forms_options();
			$output .= '<select id="' . esc_attr($key) . '" name="' . esc_attr($key) . '">';
			foreach ($options as $key => $option) {
				$output .= '<option value="' . esc_attr($key) . '" ' . selected($selected, $key, false) . '>' . esc_html($option) . '</option>';
			}
			$output .= '</select>';
		} else {
			$output .= '<input type="hidden" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($selected) . '">';
			$output .= '<p class="react-warning">' . esc_html__('No forms found, you must create or import one first', 'react') . '</p>';
		}

	} else {
		$output .= '<input type="text" class="react-hidden" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($selected) . '">';
		$output .= '<p class="react-warning">' . esc_html__('You must install and activate the Quform plugin first.', 'react') . '</p>';
	}

	return $output;
}

/**
 * Return the HTML for the animation select field
 *
 * @param   string  $key       The option name
 * @param   string  $selected  The selected option
 * @return  string
 */
function react_render_animation_select($key, $selected = '')
{
	$options = react_get_animation_options();
	$output = '';

	$output .= '<select id="' . esc_attr($key) . '" name="' . esc_attr($key) . '">';
	foreach ($options as $key => $option) {
		if (is_array($option)) {
			$output .= '<optgroup label="' . esc_attr($option['label']) . '">';
				foreach ($option['options'] as $subKey => $subOption) {
					$output .= '<option value="' . esc_attr($subKey) . '" ' . selected($selected, $subKey, false) . '>' . esc_html($subOption) . '</option>';
				}
			$output .= '</optgroup>';
		} else {
			$output .= '<option value="' . esc_attr($key) . '" ' . selected($selected, $key, false) . '>' . esc_html($option) . '</option>';
		}
	}
	$output .= '</select>';

	return $output;
}


/**
 * Return the HTML for the animation hover select field
 *
 * @param   string  $key       The option name
 * @param   string  $selected  The selected option
 * @return  string
 */
function react_render_hover_animation_select($key, $selected = '')
{
	$options = react_get_hover_animation_options();
	$output = '';

	$output .= '<select id="' . esc_attr($key) . '" name="' . esc_attr($key) . '">';
	foreach ($options as $key => $option) {
		if (is_array($option)) {
			$output .= '<optgroup label="' . esc_attr($option['label']) . '">';
				foreach ($option['options'] as $subKey => $subOption) {
					$output .= '<option value="' . esc_attr($subKey) . '" ' . selected($selected, $subKey, false) . '>' . esc_html($subOption) . '</option>';
				}
			$output .= '</optgroup>';
		} else {
			$output .= '<option value="' . esc_attr($key) . '" ' . selected($selected, $key, false) . '>' . esc_html($option) . '</option>';
		}
	}
	$output .= '</select>';

	return $output;
}

/**
 * Get the background position options
 *
 * @param   bool   $showCustom   Show the custom option
 * @param   bool   $showDefault  Show the default option
 * @return  array
 */
function react_get_background_position_options($showCustom = true, $showDefault = false)
{
	$options = array(
		'left top' => 'left top',
		'center top' => 'center top',
		'right top' => 'right top',
		'left center' => 'left center',
		'center center' => 'center center',
		'right center' => 'right center',
		'left bottom' => 'left bottom',
		'center bottom' => 'center bottom',
		'right bottom' => 'right bottom'
	);

	if ($showCustom) {
		$options['custom'] = esc_html__('Custom', 'react');
	}

	if ($showDefault) {
		$options[''] = esc_html__('Default', 'react');
	}

	return $options;
}

/**
 * Get the background repeat options
 *
 * @param   bool   $showDefault  Show the default option
 * @return  array
 */
function react_get_background_repeat_options($showDefault = false)
{
	$options = array(
		'no-repeat' => 'no-repeat',
		'repeat' => 'repeat',
		'repeat-x' => 'repeat-x',
		'repeat-y' => 'repeat-y'
	);

	if ($showDefault) {
		$options[''] = esc_html__('Default', 'react');
	}

	return $options;
}

/**
 * Returns an HTML select of all background groups choices
 *
 * @param   $key    The option name for this select
 * @return  string
 */
function react_get_background_group_select($key)
{
	global $react;
	$options = react_get_background_group_options();

	$output = '<select class="react-background-group-select" name="' . esc_attr($key) . '">';

	foreach ($options as $groupId => $groupName) {
		$output .= '<option value="' . esc_attr($groupId) . '"' . selected($react['options'][$key], $groupId, false) . '>' . esc_html($groupName) . '</option>';
	}

	$output .= '</select>';

	return $output;
}

/**
 * Returns an array of background group choices
 *
 * @return  array
 */
function react_get_background_group_options($showDefaultOption = false)
{
	global $react;

	if ($showDefaultOption) {
		$options[''] = esc_html__('Default', 'react');
	}

	$options['none'] = esc_html__('No background', 'react');

	foreach ($react['options']['background_groups'] as $groupId => $group) {
		$options[$groupId] = $group['name'];
	}

	return $options;
}

/**
 * Get the options for the SpitKit spinners
 *
 * @return array
 */
function react_get_spinkit_options()
{
	return array(
		'sk-rotating-plane' => 'Rotating plane',
		'sk-double-bounce' => 'Double bounce',
		'sk-wave' => 'Wave',
		'sk-wandering-cubes' => 'Wandering cubes',
		'sk-spinner-pulse' => 'Pulse',
		'sk-chasing-dots' => 'Chasing dots',
		'sk-three-bounce' => 'Three bounce',
		'sk-circle' => 'Circle',
		'sk-cube-grid' => 'Cube grid',
		'sk-fading-circle' => 'Fading circle',
		'sk-folding-cube' => 'Folding cube'
	);
}

/**
 * Returns the HTML for a custom widget array
 *
 * @param   array|null  $widget  Existing widget data (optional)
 * @return  string
 */
function react_im_custom_widget_area_html($widget = null)
{
	if ($widget === null) {
		$widget = array();
	}

	// Merge the saved options with default ones
	$widget = array_merge(array(
		'id' => 0,
		'name' => esc_html__('Untitled', 'react'),
		'box_type' => 'drop-down',
		'scroll' => false,
		'scroll_height' => 400,
		'title' => esc_html__('Untitled', 'react'),
		'icon' => 'home'
	), $widget);

	$output = '<div class="react-im-custom-widget-area" data-id="' . absint($widget['id']) . '">

		<div class="react-cwa-wrap react-clearfix">
			<div class="react-cwa-name-wrap react-clearfix">
				<label>' . esc_html__('Name', 'react') . '</label>
				<input type="text" class="react-im-cwa-name" value="' . esc_attr($widget['name']) . '" />
				<div class="react-im-delete-cwa"></div>
			</div>

			<div class="react-table-tabs-wrap">
				<ul class="react-table-tabs-nav">
					<li><span>' . esc_html__('Box type', 'react') . '<span class="react-icon react-colors"></span></span></li>
					<li><span>' . esc_html__('Title', 'react') . '<span class="react-icon react-fonts"></span></span></li>
					<li><span>' . esc_html__('Icon', 'react') . '<span class="react-icon react-fonts"></span></span></li>
				</ul>
			</div>

			<div class="react-table-tabs">

				<div class="react-table-tab">
					<table class="react-form-table react-tab-5-form-table">
						<tr class="react-settings-sub-head">
							<th colspan="2">
								<label>' . esc_html__('Box type', 'react') . '</label>
								<span class="react-tip-icon"><span class="react-tooltip-text">' . esc_html__('Choose a method for displaying the content', 'react') . '</span></span>
							</th>
						</tr>
						<tr class="react-content-row">
							<td class="react-form-table-input-area-td">
								<select class="react-im-cwa-box_type">
									<option value="drop-down" ' . selected($widget['box_type'], 'drop-down', false) . '>' . esc_html__('Pop Out', 'react') . '</option>
									<option value="slide-out" ' . selected($widget['box_type'], 'slide-out', false) . '>' . esc_html__('Slide Down', 'react') . '</option>
								</select>
								<div class="react-break"></div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Fixed height', 'react') . ' <span class="react-tip-icon">[?]<span class="react-tooltip-text">' . esc_html__('The area will be set to a fixed height of your choice and overflowing content will be scrollable.', 'react') . '</span></span></label>
									<input type="checkbox" class="react-toggle react-im-cwa-scroll" ' . checked(true, $widget['scroll'], false) . ' value="1" />
								</div>
								<div class="react-multi-input-wrap im_scroll_hide">
									<label class="react-mini-label">' . esc_html__('Height', 'react') . '</label>
									<input type="text" value="' . esc_attr($widget['scroll_height']) . '" class="react-im-cwa-scroll_height react-width-50" /><span class="react-range-unit">px</span>
								</div>
							</td>
							<td class="react-form-table-desc-td">
								<p class="react-description">' . esc_html__('How would you like the information displayed for this item in the infomenu? This will convert for devices, see settings above.', 'react') . '</p>
							</td>
						</tr>
					</table>
				</div>
				<div class="react-table-tab">
					<table class="react-form-table react-tab-5-form-table">
						<tr class="react-settings-sub-head">
							<th colspan="2">
								<label>' . esc_html__('Text', 'react') . '</label>
								<span class="react-tip-icon"><span class="react-tooltip-text">' . esc_html__('Choose a method for displaying the content', 'react') . '</span></span>
							</th>
						</tr>
						<tr class="react-content-row">
							<td class="react-form-table-input-area-td">
								<input type="text" class="react-im-cwa-title" value="' . esc_attr($widget['title']) . '" />
							</td>
							<td class="react-form-table-desc-td">
								<p class="react-description">' . esc_html__('Give this section a title. This will show on hovering the icon.', 'react') . '</p>
							</td>
						</tr>
					</table>
				</div>
				<div class="react-table-tab">
					<table class="react-form-table react-tab-5-form-table">
						<tr class="react-settings-sub-head">
							<th colspan="2">
								<label>' . esc_html__('Icon', 'react') . '</label>
								<span class="react-tip-icon"><span class="react-tooltip-text">' . esc_html__('Use the icon selector to choose an icon', 'react') . '</span></span>
							</th>
						</tr>
						<tr class="react-content-row">
							<td class="react-form-table-input-area-td">' . react_icon_selector_field($widget['icon']) . '</td>
							<td class="react-form-table-desc-td">
								<p class="react-description">' . esc_html__('Choose an icon to be displayed for this item in the Info Menu.', 'react') . '</p>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>';

	return $output;
}

/**
 * Returns the array of all possible column layout options
 *
 * @return array
 */
function react_get_column_layout_options()
{
	return array(
		1 => array(
			'label' => esc_html__('1 column', 'react'),
			'options' => array(
				'100' => esc_html__('100%', 'react')
			)
		),
		2 => array(
			'label' => esc_html__('2 columns', 'react'),
			'options' => array(
				'50-50' => esc_html__('50% - 50%', 'react'),
				'60-40' => esc_html__('60% - 40%', 'react'),
				'40-60' => esc_html__('40% - 60%', 'react'),
				'66-33' => esc_html__('66% - 33%', 'react'),
				'33-66' => esc_html__('33% - 66%', 'react'),
				'70-30' => esc_html__('70% - 30%', 'react'),
				'30-70' => esc_html__('30% - 70%', 'react'),
				'75-25' => esc_html__('75% - 25%', 'react'),
				'25-75' => esc_html__('25% - 75%', 'react'),
				'80-20' => esc_html__('80% - 20%', 'react'),
				'20-80' => esc_html__('20% - 80%', 'react')
			)
		),
		3 => array(
			'label' => esc_html__('3 columns', 'react'),
			'options' => array(
				'33-33-33' => esc_html__('33% - 33% - 33%', 'react'),
				'50-25-25' => esc_html__('50% - 40% - 33%', 'react'),
				'25-50-25' => esc_html__('25% - 50% - 25%', 'react'),
				'25-25-50' => esc_html__('25% - 25% - 50%', 'react'),
				'50-30-20' => esc_html__('50% - 30% - 20%', 'react'),
				'50-20-30' => esc_html__('50% - 20% - 30%', 'react'),
				'20-50-30' => esc_html__('20% - 50% - 30%', 'react'),
				'30-50-20' => esc_html__('30% - 50% - 20%', 'react'),
				'30-20-50' => esc_html__('30% - 20% - 50%', 'react'),
				'20-30-50' => esc_html__('20% - 30% - 50%', 'react'),
				'60-20-20' => esc_html__('60% - 20% - 20%', 'react'),
				'20-60-20' => esc_html__('20% - 60% - 20%', 'react'),
				'20-20-60' => esc_html__('20% - 20% - 60%', 'react'),
				'30-30-40' => esc_html__('30% - 30% - 40%', 'react'),
				'30-40-30' => esc_html__('30% - 40% - 30%', 'react'),
				'40-30-30' => esc_html__('40% - 30% - 30%', 'react')
			)
		),
		4 => array(
			'label' => esc_html__('4 columns', 'react'),
			'options' => array(
				'25-25-25-25' => esc_html__('25% - 25% - 25% - 25%', 'react'),
				'20-20-20-40' => esc_html__('20% - 20% - 20% - 40%', 'react'),
				'20-20-40-20' => esc_html__('20% - 20% - 40% - 20%', 'react'),
				'20-40-20-20' => esc_html__('20% - 40% - 20% - 20%', 'react'),
				'40-20-20-20' => esc_html__('40% - 20% - 20% - 20%', 'react'),
				'30-30-20-20' => esc_html__('30% - 30% - 20% - 20%', 'react'),
				'30-20-30-20' => esc_html__('30% - 20% - 30% - 20%', 'react'),
				'30-20-20-30' => esc_html__('30% - 20% - 20% - 30%', 'react'),
				'20-30-20-30' => esc_html__('20% - 30% - 20% - 30%', 'react'),
				'20-20-30-30' => esc_html__('20% - 20% - 30% - 30%', 'react')
			)
		),
		5 => array(
			'label' => esc_html__('5 columns', 'react'),
			'options' => array(
				'20-20-20-20-20' => esc_html__('20% - 20% - 20% - 20% - 20%', 'react')
			)
		),
	);
}

/**
 * Returns the HTML for the options for the column layout select
 *
 * @param   string  $selected  The selected option
 * @return  string             The HTML
 */
function react_render_column_layout_options($selected = '')
{
	$options = react_get_column_layout_options();
	$output = '';

	foreach ($options as $option) {
		$output .= '<optgroup label="' . esc_attr($option['label']) . '">';

		foreach($option['options'] as $key => $value) {
			$s = $key == $selected ? ' selected="selected"' : '';
			$output .= '<option value="' . esc_attr($key) . '"' . $s . '>' . esc_html($value) . '</option>';
		}

		$output .= '</optgroup>';
	}

	return $output;
}

/**
 * Returns a human-readable label for the infomenu section with the given key
 *
 * @param  string|int  $key  The key or custom widget area ID
 * @return string            The label
 */
function react_lookup_im_label($key)
{
	switch ($key) {
		case 'search':
			return esc_html__('Search', 'react');
		case 'location':
			return esc_html__('Location', 'react');
		case 'video':
			return esc_html__('Video', 'react');
		case 'contact':
			return esc_html__('Contact', 'react');
		case 'fscontrols':
			return esc_html__('Image background controls', 'react');
		case 'audiocontrols':
			return esc_html__('Audio background controls', 'react');
		case 'videocontrols':
			return esc_html__('Video background controls', 'react');
		case 'woocart':
			return esc_html__('Cart (WooCommerce)', 'react');
	}

	$widgetArea = react_get_cwa_by_id($key);
	if (isset($widgetArea['name'])) {
		return $widgetArea['name'];
	}

	return 'Undefined';
}

/**
 * Get the default palette options
 *
 * @return array
 */
function react_get_default_palette_options()
{
	// If adding or removing options also update "Palette sanitization"
	return array(
		'id' => 0,
		'name' => esc_html__('Untitled', 'react'),
		'background' => '',
		'background_gradient' => '',
		'gradient_background_color' => '',
		'gradient_orientation' => 'vertical',
		'background_lighter' => '',
		'background_darker' => '',
		'background_much_lighter' => '',
		'background_even_lighter' => '',
		'background_even_darker' => '',
		'background_touch_darker' => '',
		'background_much_darker' => '',
		'background_icon_image' => 'dark',
		'border' => '',
		'border_lr' => '',
		'h1' => '',
		'h2' => '',
		'h3' => '',
		'h4' => '',
		'h5' => '',
		'text' => '',
		'text_alt' => '',
		'link' => '',
		'link_hover' => '',
		'primary_bg' => '',
		'primary_bg_lighter' => '',
		'primary_bg_darker' => '',
		'primary_bg_even_lighter' => '',
		'primary_bg_even_darker' => '',
		'primary_bg_much_darker' => '',
		'primary_bg_gradient' => false,
		'primary_fg' => '',
		'primary_icon' => '',
		'primary_icon_image' => 'light',
		'dark_bg' => '',
		'dark_bg_lighter' => '',
		'dark_bg_darker' => '',
		'dark_bg_even_lighter' => '',
		'dark_bg_even_darker' => '',
		'dark_bg_much_darker' => '',
		'dark_bg_gradient' => false,
		'dark_fg' => '',
		'dark_icon' => '',
		'dark_icon_image' => 'light',
		'light_bg' => '',
		'light_bg_lighter' => '',
		'light_bg_darker' => '',
		'light_bg_even_lighter' => '',
		'light_bg_even_darker' => '',
		'light_bg_much_darker' => '',
		'light_bg_gradient' => false,
		'light_fg' => '',
		'light_fg_even_lighter' => '',
		'light_fg_even_darker' => '',
		'light_icon' => '',
		'light_icon_image' => 'dark'
	);
}

/**
 * Returns the HTML with fields for a custom palette
 *
 * @param   array  $palette  The existing palette options (optional)
 * @return  string
 */
function react_custom_palette_html($palette = null)
{
	if ($palette === null) {
		$palette = array();
	}

	// Merge the saved options with defaults
	$palette = array_merge(react_get_default_palette_options(), $palette);

	$output = '<div class="react-custom-palette" data-id="' . absint($palette['id']) . '">

	<div class="react-react-custom-palette-wrap react-clearfix">
		<div class="react-react-custom-palette-name-wrap react-clearfix">
			<label>' . esc_html__('Name', 'react') . '</label>
			<input type="text" class="react-custom-palette-name" value="' . esc_attr($palette['name']) . '">
			<div class="react-custom-palette-id">' . esc_html__('ID:', 'react') . '<span class="react-custom-palette-id-num">' . absint($palette['id']) . '</span></div>
			<div class="react-sort-custom-palette"></div>
			<div class="react-delete-custom-palette"></div>
		</div>

		<div class="react-table-tabs-wrap">
				<ul class="react-table-tabs-nav">
					<li><span>' . esc_html__('Background', 'react') . '<span class="react-icon react-colors"></span></span></li>
					<li><span>' . esc_html__('Text', 'react') . '<span class="react-icon react-fonts"></span></span></li>
					<li><span>' . esc_html__('Links', 'react') . '<span class="react-icon react-fonts"></span></span></li>
					<li><span>' . esc_html__('Primary', 'react') . '<span class="react-icon react-fonts"></span></span></li>
					<li><span>' . esc_html__('Dark', 'react') . '<span class="react-icon react-fonts"></span></span></li>
					<li><span>' . esc_html__('Light', 'react') . '<span class="react-icon react-fonts"></span></span></li>
				</ul>
			</div>

			<div class="react-table-tabs">

				<div class="react-table-tab">

					<table class="react-form-table react-tab-1-form-table">
						<tr class="react-settings-sub-head">
							<th colspan="2">
								<label>' . esc_html__('Background color', 'react') . '</label>
								<span class="react-tip-icon"><span class="react-tooltip-text">' . esc_html__('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react') . '</span></span>
							</th>
						</tr>
						<tr class="react-content-row react-content-input-small-desc">
							<td class="react-form-table-input-area-td">
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Background', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['background']) . '" class="react-colorpicker react-shades react-custom-palette-background" />
									<div class="react-filter-output">
										<div class="lighten"><input type="text" value="' . esc_attr($palette['background_lighter']) . '" class="react-light-color-input react-custom-palette-background-lighter" /></div>
										<div class="much-lighter"><input type="text" value="' . esc_attr($palette['background_much_lighter']) . '" class="react-light-color-input react-custom-palette-background-much-lighter" /></div>
										<div class="even-lighter"><input type="text" value="' . esc_attr($palette['background_even_lighter']) . '" class="react-light-color-input react-custom-palette-background-even-lighter" /></div>
										<div class="darken"><input type="text" value="' . esc_attr($palette['background_darker']) . '" class="react-dark-color-input react-custom-palette-background-darker" /></div>
										<div class="even-darker"><input type="text" value="' . esc_attr($palette['background_even_darker']) . '" class="react-dark-color-input react-custom-palette-background-even-darker" /></div>
										<div class="touch-darker"><input type="text" value="' . esc_attr($palette['background_touch_darker']) . '" class="react-dark-color-input react-custom-palette-background-touch-darker" /></div>
										<div class="much-darker"><input type="text" value="' . esc_attr($palette['background_much_darker']) . '" class="react-dark-color-input react-custom-palette-background-much-darker" /></div>
									</div>
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Background gradient', 'react') . '</label>
									<input type="checkbox" class="react-toggle react-custom-palette-background-gradient"' . checked(true, $palette['background_gradient'], false) . ' value="1" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Gradient blend color', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['gradient_background_color']) . '" class="react-colorpicker react-custom-palette-gradient-background-color" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Gradient orientation', 'react') . '</label>
									<select class="react-custom-palette-gradient-orientation">
										<option value="vertical" ' . selected($palette['gradient_orientation'], 'vertical', false) . '>' .  esc_html__('vertical', 'react') . '</option>
										<option value="horizontal" ' . selected($palette['gradient_orientation'], 'horizontal', false) . '>' .  esc_html__('horizontal', 'react') . '</option>
										<option value="diagonal-up" ' . selected($palette['gradient_orientation'], 'diagonal-up', false) . '>' .  esc_html__('diagonal-up', 'react') . '</option>
										<option value="diagonal-down" ' . selected($palette['gradient_orientation'], 'diagonal-down', false) . '>' .  esc_html__('diagonal-down', 'react') . '</option>
									</select>
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Border', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['border']) . '" class="react-colorpicker react-custom-palette-border" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Border left/right', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['border_lr']) . '" class="react-colorpicker react-custom-palette-border-lr" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Image Icons', 'react') . '</label>
									<select class="react-custom-palette-background-icon-image">
										<option value="light" ' . selected($palette['background_icon_image'], 'light', false) . '>' .  esc_html__('Light Icons', 'react') . '</option>
										<option value="dark" ' . selected($palette['background_icon_image'], 'dark', false) . '>' .  esc_html__('Dark Icons', 'react') . '</option>
									</select>
								</div>
							</td>
							<td class="react-form-table-desc-td">
								<p class="react-description">' . esc_html__('All colors related to the background of the assigned area', 'react') . '</p>
							</td>
						</tr>
					</table>
				</div>


				<div class="react-table-tab">

					<table class="react-form-table react-tab-1-form-table">
						<tr class="react-settings-sub-head">
							<th colspan="2">
								<label>' . esc_html__('Text colors', 'react') . '</label>
								<span class="react-tip-icon"><span class="react-tooltip-text">' . esc_html__('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react') . '</span></span>
							</th>
						</tr>
						<tr class="react-content-row react-content-input-small-desc">
							<td class="react-form-table-input-area-td">
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('H1', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['h1']) . '" class="react-colorpicker react-custom-palette-h1" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('H2', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['h2']) . '" class="react-colorpicker react-custom-palette-h2" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('H3', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['h3']) . '" class="react-colorpicker react-custom-palette-h3" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('H4', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['h4']) . '" class="react-colorpicker react-custom-palette-h4" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('H5', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['h5']) . '" class="react-colorpicker react-custom-palette-h5" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Text', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['text']) . '" class="react-colorpicker react-custom-palette-text" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Alternative text', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['text_alt']) . '" class="react-colorpicker react-custom-palette-text-alt" />
								</div>
							 </td>
							<td class="react-form-table-desc-td">
								<p class="react-description">' . esc_html__('All colors related to the text of the assigned area', 'react') . '</p>
							</td>
						</tr>
					</table>

				</div>
				<div class="react-table-tab">
					<table class="react-form-table react-tab-1-form-table">
						<tr class="react-settings-sub-head">
							<th colspan="2">
								<label>' . esc_html__('Link colors', 'react') . '</label>
								<span class="react-tip-icon"><span class="react-tooltip-text">' . esc_html__('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react') . '</span></span>
							</th>
						</tr>
						<tr class="react-content-row react-content-input-small-desc">
							<td class="react-form-table-input-area-td">
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Links', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['link']) . '" class="react-colorpicker react-custom-palette-link" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Link hover', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['link_hover']) . '" class="react-colorpicker react-custom-palette-link-hover" />
								</div>
							</td>
							<td class="react-form-table-desc-td">
								<p class="react-description">' . esc_html__('All colors for text and icon links', 'react') . '</p>
							</td>
						</tr>
					</table>
				</div>
				<div class="react-table-tab">
					<table class="react-form-table react-tab-1-form-table">
						<tr class="react-settings-sub-head">
							<th colspan="2">
								<label>' . esc_html__('Primary color', 'react') . '</label>
								<span class="react-tip-icon"><span class="react-tooltip-text">' . esc_html__('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react') . '</span></span>
							</th>
						</tr>
						<tr class="react-content-row react-content-input-small-desc">
							<td class="react-form-table-input-area-td">
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Background', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['primary_bg']) . '" class="react-colorpicker react-shades react-custom-palette-primary-bg" />
									<div class="react-filter-output">
										<div class="lighten"><input type="text" value="' . esc_attr($palette['primary_bg_lighter']) . '" class="react-light-color-input react-custom-palette-primary-bg-lighter" /></div>
										<div class="even-lighter"><input type="text" value="' . esc_attr($palette['primary_bg_even_lighter']) . '" class="react-light-color-input react-custom-palette-primary-bg-even-lighter" /></div>
										<div class="darken"><input type="text" value="' . esc_attr($palette['primary_bg_darker']) . '" class="react-dark-color-input react-custom-palette-primary-bg-darker" /></div>
										<div class="even-darker"><input type="text" value="' . esc_attr($palette['primary_bg_even_darker']) . '" class="react-dark-color-input react-custom-palette-primary-bg-even-darker" /></div>
										<div class="much-darker"><input type="text" value="' . esc_attr($palette['primary_bg_much_darker']) . '" class="react-dark-color-input react-custom-palette-primary-bg-much-darker" /></div>
									</div>
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Background gradient', 'react') . '</label>
									<input type="checkbox" class="react-toggle react-custom-palette-primary-bg-gradient"' . checked(true, $palette['primary_bg_gradient'], false) . ' value="1" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Foreground', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['primary_fg']) . '" class="react-colorpicker react-custom-palette-primary-fg" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Text Icons', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['primary_icon']) . '" class="react-colorpicker react-custom-palette-primary-icon" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Image Icons', 'react') . '</label>
									<select class="react-custom-palette-primary-icon-image">
										<option value="light" ' . selected($palette['primary_icon_image'], 'light', false) . '>' .  esc_html__('Light Icons', 'react') . '</option>
										<option value="dark" ' . selected($palette['primary_icon_image'], 'dark', false) . '>' .  esc_html__('Dark Icons', 'react') . '</option>
									</select>
								</div>
							</td>
							<td class="react-form-table-desc-td">
								<p class="react-description">' . esc_html__('The Primary colors of the assigned area', 'react') . '</p>
							</td>
						</tr>
					</table>
				</div>

				<div class="react-table-tab">
					<table class="react-form-table react-tab-1-form-table">
						<tr class="react-settings-sub-head">
							<th colspan="2">
								<label>' . esc_html__('Dark color', 'react') . '</label>
								<span class="react-tip-icon"><span class="react-tooltip-text">' . esc_html__('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react') . '</span></span>
							</th>
						</tr>
						<tr class="react-content-row react-content-input-small-desc">
							<td class="react-form-table-input-area-td">
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Background', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['dark_bg']) . '" class="react-colorpicker react-shades react-custom-palette-dark-bg" />
									<div class="react-filter-output">
										<div class="lighten"><input type="text" value="' . esc_attr($palette['dark_bg_lighter']) . '" class="react-light-color-input react-custom-palette-dark-bg-lighter" /></div>
										<div class="even-lighter"><input type="text" value="' . esc_attr($palette['dark_bg_even_lighter']) . '" class="react-light-color-input react-custom-palette-dark-bg-even-lighter" /></div>
										<div class="darken"><input type="text" value="' . esc_attr($palette['dark_bg_darker']) . '" class="react-dark-color-input react-custom-palette-dark-bg-darker" /></div>
										<div class="even-darker"><input type="text" value="' . esc_attr($palette['dark_bg_even_darker']) . '" class="react-dark-color-input react-custom-palette-dark-bg-even-darker" /></div>
										<div class="much-darker"><input type="text" value="' . esc_attr($palette['dark_bg_much_darker']) . '" class="react-dark-color-input react-custom-palette-dark-bg-much-darker" /></div>
									</div>
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Background gradient', 'react') . '</label>
									<input type="checkbox" class="react-toggle react-custom-palette-dark-bg-gradient"' . checked(true, $palette['dark_bg_gradient'], false) . ' value="1" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Foreground', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['dark_fg']) . '" class="react-colorpicker react-custom-palette-dark-fg" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Text Icons', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['dark_icon']) . '" class="react-colorpicker react-custom-palette-dark-icon" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Image Icons', 'react') . '</label>
									<select class="react-custom-palette-dark-icon-image">
										<option value="light" ' . selected($palette['dark_icon_image'], 'light', false) . '>' .  esc_html__('Light Icons', 'react') . '</option>
										<option value="dark" ' . selected($palette['dark_icon_image'], 'dark', false) . '>' .  esc_html__('Dark Icons', 'react') . '</option>
									</select>
								</div>
							</td>
							<td class="react-form-table-desc-td">
								<p class="react-description">' . esc_html__('The Dark colors of the assigned area', 'react') . '</p>
							</td>
						</tr>
					</table>
				</div>

				<div class="react-table-tab">
					<table class="react-form-table react-tab-1-form-table">
						<tr class="react-settings-sub-head">
							<th colspan="2">
								<label>' . esc_html__('Light color', 'react') . '</label>
								<span class="react-tip-icon"><span class="react-tooltip-text">' . esc_html__('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react') . '</span></span>
							</th>
						</tr>
						<tr class="react-content-row react-content-input-small-desc">
							<td class="react-form-table-input-area-td">
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Background', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['light_bg']) . '" class="react-colorpicker react-shades react-custom-palette-light-bg" />
									<div class="react-filter-output">
										<div class="lighten"><input type="text" value="' . esc_attr($palette['light_bg_lighter']) . '" class="react-light-color-input react-custom-palette-light-bg-lighter" /></div>
										<div class="even-lighter"><input type="text" value="' . esc_attr($palette['light_bg_even_lighter']) . '" class="react-light-color-input react-custom-palette-light-bg-even-lighter" /></div>
										<div class="darken"><input type="text" value="' . esc_attr($palette['light_bg_darker']) . '" class="react-dark-color-input react-custom-palette-light-bg-darker" /></div>
										<div class="even-darker"><input type="text" value="' . esc_attr($palette['light_bg_even_darker']) . '" class="react-dark-color-input react-custom-palette-light-bg-even-darker" /></div>
										<div class="much-darker"><input type="text" value="' . esc_attr($palette['light_bg_much_darker']) . '" class="react-dark-color-input react-custom-palette-light-bg-much-darker" /></div>
									</div>
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Background gradient', 'react') . '</label>
									<input type="checkbox" class="react-toggle react-custom-palette-light-bg-gradient"' . checked(true, $palette['light_bg_gradient'], false) . ' value="1" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Foreground', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['light_fg']) . '" class="react-colorpicker react-custom-palette-light-fg react-shades" />
									<div class="react-filter-output">
										<div class="even-lighter"><input type="text" value="' . esc_attr($palette['light_fg_even_lighter']) . '" class="react-light-color-input react-custom-palette-light-fg-even-lighter" /></div>
										<div class="even-darker"><input type="text" value="' . esc_attr($palette['light_fg_even_darker']) . '" class="react-dark-color-input react-custom-palette-light-fg-even-darker" /></div>
									</div>
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Text Icons', 'react') . '</label>
									<input type="text" value="' . esc_attr($palette['light_icon']) . '" class="react-colorpicker react-custom-palette-light-icon" />
								</div>
								<div class="react-multi-input-wrap">
									<label class="react-mini-label">' . esc_html__('Image Icons', 'react') . '</label>
									<select class="react-custom-palette-light-icon-image">
										<option value="light" ' . selected($palette['light_icon_image'], 'light', false) . '>' .  esc_html__('Light Icons', 'react') . '</option>
										<option value="dark" ' . selected($palette['light_icon_image'], 'dark', false) . '>' .  esc_html__('Dark Icons', 'react') . '</option>
									</select>
								</div>
							</td>
							<td class="react-form-table-desc-td">
								<p class="react-description">' . esc_html__('The Light colors of the assigned area', 'react') . '</p>
							</td>
						</tr>
					</table>
				</div>
				<table class="react-form-table react-palette-schemes-table">
					<tr class="react-content-row react-no-desc react-palette-schemes">
						<td class="react-form-table-input-area-td" colspan="2">
							<div class="react-accordion react-toggle">
								<div class="react-accordion-trigger">' . esc_html__('Choose a Color Scheme for this palette', 'react') . '</div>
								<div class="react-accordion-content">
									<div class="react-clearfix react-element-spacer">


										<a class="react-palette-color-scheme react-scheme palette-scheme-one" data-scheme="one"> color 1</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-two" data-scheme="two"> color 2</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-three" data-scheme="three"> color 3</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-four" data-scheme="four"> color 4</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-five" data-scheme="five"> color 5</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-six" data-scheme="six"> color 6</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-seven" data-scheme="seven"> color 7</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-eight" data-scheme="eight"> color 8</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-nine" data-scheme="nine"> color 9</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-ten" data-scheme="ten"> color 10</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-eleven" data-scheme="eleven"> color 11</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-twelve" data-scheme="twelve"> color 12</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-thirteen" data-scheme="thirteen"> color 13</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-fourteen" data-scheme="fourteen"> color 14</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-fifteen" data-scheme="fifteen"> color 15</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-sixteen" data-scheme="sixteen"> color 16</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-seventeen" data-scheme="seventeen"> color 17</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-eighteen" data-scheme="eighteen"> color 18</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-nineteen" data-scheme="nineteen"> color 19</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-twenty" data-scheme="twenty"> color 20</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-twentyone" data-scheme="twentyone"> color 21</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-twentytwo" data-scheme="twentytwo"> color 22</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-twentythree" data-scheme=" twentythree"> color 23</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-twentyfour" data-scheme="twentyfour"> color 24</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-twentyfive" data-scheme="twentyfive"> color 25</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-twentysix" data-scheme="twentysix"> color 26</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-twentyseven" data-scheme="twentyseven"> color 27</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-twentyeight" data-scheme="twentyeight"> color 28</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-twentynine" data-scheme="twentynine"> color 29</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-thirty" data-scheme="thirty"> color 30</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-thirtyone" data-scheme="thirtyone"> color 31</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-thirtytwo" data-scheme="thirtytwo"> color 32</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-thirtythree" data-scheme="thirtythree"> color 33</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-thirtyfour" data-scheme="thirtyfour"> color 34</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-thirtyfive" data-scheme="thirtyfive"> color 35</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-thirtysix" data-scheme="thirtysix"> color 36</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-thirtyseven" data-scheme="thirtyseven"> color 37</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-thirtyeight" data-scheme="thirtyeight"> color 38</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-thirtynine" data-scheme="thirtynine"> color 39</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-fourty" data-scheme="fourty"> color 40</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-fourtyone" data-scheme="fourtyone"> color 41</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-fourtytwo" data-scheme="fourtytwo"> color 42</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-fourtythree" data-scheme="fourtythree"> color 43</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-fourtyfour" data-scheme="fourtyfour"> color 44</a>
										<a class="react-palette-color-scheme react-scheme palette-scheme-fourtyfive" data-scheme="fourtyfive"> color 45</a>

										<div class="react-break"></div>
										<div class="react-flt-right">
										<a class="react-palette-color-scheme react-color-reset react-tooltip react-button react-light" data-scheme="reset">' . esc_html__('Reset colors', 'react') . '<span class="react-tooltip-text">' . esc_html__('This will reset colors for Palettes only', 'react') . '</span></a>
										<a href="#TB_inline?width=600&amp;height=550&amp;inlineId=colorScheme-explanation" class="thickbox react-button react-light react-tooltip">' . esc_html__('What do the diagrams represent?', 'react') . '<span class="react-tooltip-text">' . esc_html__('See what each color in the diagram represents', 'react') . '</span></a>
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>';

	return $output;
}

/**
 * Get the custom palettes options
 *
 * @return  array  Each palette in array format (id => name)
 */
function react_get_custom_palette_options()
{
	$options = array();

	foreach (react_get_option('custom_palettes') as $palette) {
		$options[$palette['id']] = $palette['name'];
	}

	return $options;
}

/**
 * Return the HTML for custom palette options
 *
 * @param   string  $selected  The selected option
 * @return  string
 */
function react_render_custom_palette_options($selected = '')
{
	$options = react_get_custom_palette_options();
	$output = '';

	foreach ($options as $key => $option) {
		$output .= '<option value="' . esc_attr($key) . '" ' . selected($selected, $key, false) . '>' . esc_html($option) . '</option>';
	}

	return $output;
}

/**
 * Handle the Ajax request to get the YouTube video width/height
 */
function react_get_youtube_video_dimensions()
{
	if (!isset($_GET['id']) || !$_GET['id']) {
		wp_send_json(array('type' => 'error', 'message' => 'Video ID is missing or empty'));
	}

	$response = wp_remote_get('https://www.youtube.com/oembed?url=http%3A//www.youtube.com/watch?v%3D' . urlencode($_GET['id']) . '&format=json');

	if (wp_remote_retrieve_response_code($response) != 200 || !strlen($json = wp_remote_retrieve_body($response))) {
		wp_send_json(array('type' => 'error', 'message' => 'The request to the YouTube server failed'));
	}

	$video = json_decode($json, true);

	if (!is_array($video) || !isset($video['width'], $video['height'])) {
		wp_send_json(array('type' => 'error', 'message' => 'The response from the YouTube server was not in the expected format'));
	}

	wp_send_json(array(
		'type' => 'success',
		'width' => $video['width'],
		'height' => $video['height']
	));
}
add_action('wp_ajax_react_get_youtube_video_dimensions', 'react_get_youtube_video_dimensions');

/**
 * Sanitize a CSS color
 *
 * @param   string  $color
 * @return  string
 */
function react_sanitize_color($color)
{
	// Bail early with an empty string if the color is not a string or is empty
	if (!is_string($color) || $color === '') {
		return '';
	}

	// Strip bad stuff and trim
	$sanitized = sanitize_text_field($color);

	// Strip anything but allowed characters
	$sanitized = preg_replace('/[^a-zA-Z0-9 #:\(\),\.]/', '', $sanitized);

	$hexPattern = '/^#([a-f0-9]{3}){1,2}$/i'; // #ab3 or #ab3456
	$rgbPattern = '/^rgb\s*\(\s*\d+\s*,\s*\d+\s*,\s*\d+\s*\)$/i'; // rbg(1, 2, 3);
	$rgbaPattern = '/^rgba\s*\(\s*\d+\s*,\s*\d+\s*,\s*\d+\s*,\s*\d+(?:\.\d+)?\s*\)$/i'; // rbga(1, 2, 3, 0.5);
	$namedPattern = '/^[a-zA-Z]+$/'; // Named colors, including transparent

	// Check if the color matches an accepted pattern
	if (!preg_match($hexPattern, $sanitized) &&
		!preg_match($rgbPattern, $sanitized) &&
		!preg_match($rgbaPattern, $sanitized) &&
		!preg_match($namedPattern, $sanitized)
	) {
		// No match, so return an empty string
		return '';
	}

	// The color matches an accepted pattern, if so return it
	return $sanitized;
}

/**
 * Sanitizes and returns a CSS color style
 *
 * If an rgba is detected then a style with rgb is output before it to support
 * older browsers
 *
 * @param  string   $color      The color of the style
 * @param  string   $prefix     The prefix of the style
 * @param  boolean  $important  Whether to add !important to the style
 * @return string
 */
function react_css_color($color, $prefix = 'background-color', $important = false)
{
	$output = '';

	$color = react_sanitize_color($color);

	if ($color !== '') {
		if (preg_match('/^rgba\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+(?:\.\d+)?\s*)\)$/i', $color, $matches)) {
			if ($prefix == 'color') {
				if ($matches[4] !== "0") {
					$output .= $prefix . ': rgb(' . $matches[1] . ', ' . $matches[2] . ', ' . $matches[3] . ') !important;';
				} else {
					$output .= $prefix . ': transparent !important;';
				}
			} else {
				if ($matches[4] !== "0") {
					$output .= $prefix . ': rgb(' . $matches[1] . ', ' . $matches[2] . ', ' . $matches[3] . ')' . ($important ? ' !important' : '') . ';';
				} else {
					$output .= $prefix . ': transparent' . ($important ? ' !important' : '') . ';';
				}
			}
		}

		$output .= $prefix . ':' . $color . ($important ? ' !important' : '') . ';';
	}

	return $output;
}

/**
 * Update the favicons
 *
 * If a new favion was given, regenerate the device icons if it is large enough.
 * This only works if the image was uploaded through the WP media library thus has an attachment
 *
 * @param   array  $options  Current theme options
 * @return  array            Modified theme options
 */
function react_update_favicons($options)
{
	global $react;
	$faviconSizes = react_get_favicon_sizes();

	if ($options['general_favicon'] == $react['options']['general_favicon'] && $options['general_favicon_generate'] == $react['options']['general_favicon_generate']) {
		// Nothing changed so copy existing favicons to new array
		foreach ($faviconSizes as $target) {
			$options['general_favicon_touch_' . $target] = $react['options']['general_favicon_touch_' . $target];
		}

		return $options;
	}

	// Icon has changed or generate option was changed
	if ($options['general_favicon'] && $options['general_favicon_generate']) {
		// Generate new favicons
		$sourceAttachmentId = attachment_url_to_postid($options['general_favicon']);

		if ($sourceAttachmentId > 0) {
			$file = get_attached_file($sourceAttachmentId);

			$image = wp_get_image_editor($file);

			if ($image instanceof WP_Image_Editor) {
				$size = $image->get_size();

				$resizes = array();

				foreach ($faviconSizes as $target) {
					if ($size['width'] >= $target) {
						$resizes[] = array('width' => $target, 'height' => $target, 'crop' => true);
					} else {
						$options['general_favicon_touch_' . $target] = '';
					}
				}

				$resized = $image->multi_resize($resizes);
				$dir = dirname($file);
				require_once ABSPATH . 'wp-admin/includes/image.php';

				// Create attachments
				foreach ($resizes as $k => $resize) {
					$title = sanitize_title(preg_replace('/\.[^.]+$/', '', $resized[$k]['file']));

					$attachment = array(
						'post_mime_type' => $resized[$k]['mime-type'],
						'post_title' => $title,
						'post_content' => '',
						'post_status' => 'inherit'
					);

					$path = $dir . '/' . $resized[$k]['file'];

					$attachId = wp_insert_attachment($attachment, $path);

					$attachData = wp_generate_attachment_metadata($attachId, $path);
					wp_update_attachment_metadata($attachId, $attachData);

					$options['general_favicon_touch_' . $resize['width']] = _wp_relative_upload_path(get_attached_file($attachId));
				}

				return $options;
			}
		}
	}

	// If we get here we should remove any existing touch icons
	foreach ($faviconSizes as $target) {
		$options['general_favicon_touch_' . $target] = '';
	}

	return $options;
}
add_filter('react_pre_save_options', 'react_update_favicons');

/**
 * Returns the array of options to use in the use_main_img option in custom image
 *
 * @return  array
 */
function react_get_retina_use_main_img_options()
{
	return array(
		'never' => esc_html__('Nothing (keep full size image above always)', 'react'),
		'use-main-img' => esc_html__('Use the above image at 50%', 'react'),
		'use-new-img' => esc_html__('Select a new image to use', 'react'),
		'change-position' => esc_html__('Use this image but change position', 'react'),
		'no-image' => esc_html__('Show no image at break point', 'react')
	);
}

/**
 * Get the HTML for an uploaded image thumbnail
 *
 * Wrapper around react_get_upload_thumbnail_html() that will return no HTML if
 * there is no image URL.
 *
 * @param  	string  $url  The image URL
 * @return  string
 */
function react_get_upload_thumbnail($url = '')
{
	$output = '';

	if (!empty($url)) {
		$output = react_get_upload_thumbnail_html($url);
	}

	return $output;
}

/**
 * Get the HTML for an uploaded image thumbnail
 *
 * @param   string   $url  The URL of the image
 * @return  string         The HTML of the thumbnail
 */
function react_get_upload_thumbnail_html($url = '')
{
	$output = '<div class="react-uploaded-image">';

	if (!empty($url)) {
		$output .= '<img src="' . esc_url(react_get_upload_thumbnail_url($url)) . '" alt="">';
	}

	$output .= '<div class="react-uploaded-image-hover">
		<div class="react-uploaded-image-hover-inner">
			<div class="react-delete-uploaded-image react-tooltip"><span class="react-tooltip-text">' . esc_html__('Remove image', 'react') . '</span></div>
		</div>
	</div>
</div>';

	return $output;
}

/**
 * Get the thumbnail image URL for an image file
 *
 * @param   string  $url  The URL of the image
 * @return  string        The URL of the thumbnail
 */
function react_get_upload_thumbnail_url($url)
{
	if (!is_string($url) || $url === '') {
		return '';
	}

	if (react_is_absolute_url($url)) {
		return $url;
	}

	if (react_is_absolute_path($url)) {
		return site_url($url);
	}

	$postId = attachment_url_to_postid($url);

	if ($postId > 0) {
		$image = wp_get_attachment_image_src($postId, 'medium');

		if (isset($image[0])) {
			$url = $image[0];
		}
	} else {
		$url = react_uploads_url($url);
	}

	return $url;
}

/**
 * Handle the Ajax call to get an image thumbnail URL
 */
function react_ajax_get_upload_thumbnail_url()
{
	if (!isset($_POST['url'])) {
		wp_send_json(array('type' => 'error'));
	}

	$url = stripslashes($_POST['url']);
	$url = react_get_upload_thumbnail_url($url);

	wp_send_json(array(
		'type' => 'success',
		'url' => $url
	));
}
add_action('wp_ajax_react_ajax_get_upload_thumbnail_url', 'react_ajax_get_upload_thumbnail_url');

/**
 * Get the HTML for the background image group
 *
 * @param   int     $id     The group ID
 * @param   array   $group  Existing group configuration
 * @return  string          The HTML of the group
 */
function react_get_background_group_html($id = 0, $group = array())
{
	// Merge the saved options with default ones
	$group = array_merge(array(
		'name' => esc_html__('Untitled', 'react'),
		'backgrounds' => array()
	), $group);

	$output = '<div class="react-background-group react-upload-holder react-clearfix" data-id="' . absint(esc_attr($id)) . '">
	<div class="react-background-group-inner react-clearfix">
		<div class="react-delete-background-group react-tooltip"><span class="react-tooltip-text">' . esc_html__('Delete group', 'react') . '</span></div>
		<div class="react-edit-background-group react-tooltip"><span class="react-tooltip-text">' . esc_html__('Edit group', 'react') . '</span></div>
		<div class="react-background-group-id">' . esc_html__('ID:', 'react') . '<span class="react-background-group-id-num">' . absint($id) . '</span></div>
		<div class="react-background-group-name">
			<span class="react-background-group-name-inner">' . esc_html($group['name']) . '</span>
			<input type="text" class="react-background-group-name-input react-width-300" value="' . esc_attr($group['name']) . '" />
		</div>
		<div class="react-background-group-settings">
			<div class="react-background-group-upload-wrap react-clearfix">
				<div class="react-media-button react-background-group-upload">' . esc_html__('Add Image(s)', 'react') . '</div>
			</div>
			<div class="react-background-group-images react-clearfix">';

		foreach ($group['backgrounds'] as $background) {
			$output .= react_get_background_thumbnail_html($background);
		}

	$output .= '</div>
		</div>
	</div>
</div>';

	return $output;
}

/**
 * Get the HTML for an uploaded background image thumbnail
 *
 * @param   array   $background  Background data attributes to add to the wrapper
 * @return  string               The HTML of the thumbnail
 */
function react_get_background_thumbnail_html($background = array())
{
	$output = '<div class="react-uploaded-image" data-image="' . esc_attr(wp_json_encode($background)) . '">
	<div class="react-uploaded-image-thumbnail">
		<div class="react-uploaded-image-centered">';

	if (!empty($background['image'])) {
		$url = react_get_upload_thumbnail_url($background['image']);
		$postId = attachment_url_to_postid($url);
		$orientation = 'landscape';

		if ($postId > 0) {
			$image = wp_get_attachment_image_src($postId, 'medium');

			if (isset($image[0])) {
				$url = $image[0];
				$orientation = $image[2] > $image[1] ? 'portrait' : 'landscape';
			}
		}

		$output .= '<img class="' . esc_attr(react_sanitize_class('react-' . $orientation)) . '" src="' . esc_url($url) . '" alt="">';
	}


	$output .= '</div>
	</div>
	<div class="react-uploaded-image-hover">
		<div class="react-uploaded-image-hover-inner">
			<div class="react-edit-background-image react-tooltip"><span class="react-tooltip-text">' . esc_html__('Edit caption', 'react') . '</span></div>
			<div class="react-delete-uploaded-image react-tooltip"><span class="react-tooltip-text">' . esc_html__('Remove image', 'react') . '</span></div>
		</div>
	</div>
</div>';

	return $output;
}

/**
 * Get the HTML for background audio track
 *
 * @param  array    $track
 * @return string
 */
function react_get_background_audio_html($track = array())
{
	// Merge the saved options with default ones
	$track = array_merge(array(
		'id' => 0,
		'name' => esc_html__('Untitled', 'react'),
		'm4a' => '',
		'mp3' => '',
		'oga' => '',
	), $track);

	$output = '<div class="react-audio-track react-clearfix" data-id="' . absint($track['id']) . '">
	<div class="react-audio-track-inner">
		<div class="react-delete-audio-track react-tooltip"><span class="react-tooltip-text">' . esc_html__('Delete track', 'react') . '</span></div>
		<div class="react-edit-audio-track react-tooltip"><span class="react-tooltip-text">' . esc_html__('Edit track', 'react') . '</span></div>
		<div class="react-drag-audio-track react-tooltip"><span class="react-tooltip-text">' . esc_html__('Move track', 'react') . '</span></div>
		<div class="react-audio-track-name">
			<span class="react-audio-track-name-inner">' . esc_html($track['name']) . '</span>
			<input type="text" class="react-audio-track-name-input react-width-300" value="' . esc_attr($track['name']) . '" />
		</div>
		<div class="react-audio-track-settings">
			<table class="react-audio-track-settings">
				<tr class="react-audio-format-title">
					<th colspan="2">' . esc_html__('M4A file URL', 'react') . '</th>
				</tr>
				<tr class="react-audio-format">
					<td class="react-audio-format-url-td"><input type="text" class="react-audio-format-input react-audio-format-m4a" value="' . esc_attr($track['m4a']) . '" /></td>
					<td class="react-audio-format-upload-td">
						<div class="react-upload-audio-track-button-wrap react-clearfix">
							<div class="react-upload-audio-format-button react-media-button">' . esc_html__('Browse', 'react') . '</div>
						</div>
					</td>
				</tr>

				<tr class="react-audio-format-title">
					<th colspan="2">' . esc_html__('MP3 file URL', 'react') . '</th>
				</tr>
				<tr class="react-audio-format">
					<td class="react-audio-format-url-td"><input type="text" class="react-audio-format-input react-audio-format-mp3" value="' . esc_attr($track['mp3']) . '" /></td>
					<td class="react-audio-format-upload-td">
						<div class="react-upload-audio-track-button-wrap react-clearfix">
							<div class="react-upload-audio-format-button react-media-button">' . esc_html__('Browse', 'react') . '</div>
						</div>
					</td>
				</tr>

				<tr class="react-audio-format-title">
					<th colspan="2">' . esc_html__('OGG file URL (optional)', 'react') . '</th>
				</tr>
				<tr class="react-audio-format">
					<td class="react-audio-format-url-td"><input type="text" class="react-audio-format-input react-audio-format-ogg" value="' . esc_attr($track['oga']) . '" /></td>
					<td class="react-audio-format-upload-td">
						<div class="react-upload-audio-track-button-wrap react-clearfix">
							<div class="react-upload-audio-format-button react-media-button">' . esc_html__('Browse', 'react') . '</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>';

	return $output;
}

if (function_exists('icl_register_string')) :
/**
 * Register theme options strings for WPML translation
 *
 * @param   array  $options  The theme options
 * @return  array            The theme options
 */
function react_wpml_register_strings($options)
{
	icl_register_string('React', 'Logo Title', $options['general_logo_title']);
	icl_register_string('React', 'Logo Alt', $options['general_logo_alt']);
	icl_register_string('React', 'Logo Strapline', $options['general_logo_strapline']);
	icl_register_string('React', 'Read More Text', $options['general_read_more_text']);
	icl_register_string('React', 'Blog Page Title', $options['blog_title']);
	icl_register_string('React', 'Blog Page Subtitle', $options['blog_subtitle']);
	icl_register_string('React', 'Top Header Info Box', $options['top_header_info_box']);
	icl_register_string('React', 'Top Header Phone', $options['header_contact_phone']);
	icl_register_string('React', 'Top Header Phone Sales', $options['header_contact_phone_sales']);
	icl_register_string('React', 'Top Header Phone Support', $options['header_contact_phone_support']);
	icl_register_string('React', 'Top Header Contact Form Trigger', $options['head_contact_quform_id_trigger']);
	icl_register_string('React', 'Top Header Sales Form Trigger', $options['head_contact_quform_id_sales_trigger']);
	icl_register_string('React', 'Top Header Support Form Trigger', $options['head_contact_quform_id_support_trigger']);
	icl_register_string('React', 'Nav Home Text', $options['nav_home_text']);
	icl_register_string('React', 'Footer Content', $options['footer_left_content']);
	icl_register_string('React', 'Footer End Page Popout', $options['footer_end_page_popout']);
	icl_register_string('React', 'Contact Phone Number', $options['contact_phone_number']);
	icl_register_string('React', 'Contact Fax Number', $options['contact_fax_number']);
	icl_register_string('React', 'Contact Email', $options['contact_email']);
	icl_register_string('React', 'Contact Address', $options['contact_address']);
	icl_register_string('React', 'Contact Map', $options['contact_map']);
	icl_register_string('React', 'Info Menu Search Title', $options['im_display_text_search']);
	icl_register_string('React', 'Info Menu Location Title', $options['im_display_text_location']);
	icl_register_string('React', 'Info Menu Video Title', $options['im_display_text_video']);
	icl_register_string('React', 'Info Menu Contact Title', $options['im_display_text_contact']);
	icl_register_string('React', 'Info Menu Background Controls Title', $options['im_display_text_fscontrols']);
	icl_register_string('React', 'Info Menu Audio Controls Title', $options['im_display_text_audiocontrols']);
	icl_register_string('React', 'Info Menu Video Controls Title', $options['im_display_text_videocontrols']);
	icl_register_string('React', 'Info Menu Cart Title', $options['im_display_text_woocart']);
	icl_register_string('React', 'Popdown Content', $options['popdown_plain_content']);
	icl_register_string('React', 'Popdown Trigger Heading', $options['popdown_trigger_heading']);
	icl_register_string('React', 'Popdown Trigger Description', $options['popdown_trigger_description']);
	icl_register_string('React', 'Share Title', $options['share_title']);
	icl_register_string('React', 'Share Hover Text Facebook', $options['share_hover_text_facebook']);
	icl_register_string('React', 'Share Hover Text Twitter', $options['share_hover_text_twitter']);
	icl_register_string('React', 'Share Hover Text Google+', $options['share_hover_text_googleplus']);
	icl_register_string('React', 'Share Hover Text Pinterest', $options['share_hover_text_pinterest']);

	foreach ($options['im_custom_widget_areas'] as $widgetArea) {
		icl_register_string('React', "Info Menu Custom Widget Area '{$widgetArea['name']}' Title", $widgetArea['title']);
	}

	foreach($options['background_groups'] as $backgroundGroup) {
		foreach ($backgroundGroup['backgrounds'] as $background) {
			$name = $backgroundGroup['name'] . ':' . basename($background['image']);
			icl_register_string('React', "Background Image '{$name}' Caption", $background['caption']);
			icl_register_string('React', "Background Image '{$name}' Title", $background['title']);
		}
	}

	return $options;
}
add_filter('react_pre_save_options', 'react_wpml_register_strings');
endif;

/**
 * Get the array of animations for use in a <select> field
 *
 * @return  array
 */
function react_get_animation_options($defaultText = '')
{
	if ($defaultText == '') {
		$defaultText = esc_html__('None', 'react');
	}

	return array(
		'' => $defaultText,
		array(
			'label' => esc_html__('Attention Seekers', 'react'),
			'options' => array(
				'bounce' => 'bounce',
				'flash' => 'flash',
				'pulse' => 'pulse',
				'rubberBand' => 'rubberBand',
				'shake' => 'shake',
				'swing' => 'swing',
				'tada' => 'tada',
				'wobble' => 'wobble'
			)
		),
		array(
			'label' => esc_html__('Bouncing Entrances', 'react'),
			'options' => array(
				'bounceIn' => 'bounceIn',
				'bounceInDown' => 'bounceInDown',
				'bounceInLeft' => 'bounceInLeft',
				'bounceInRight' => 'bounceInRight',
				'bounceInUp' => 'bounceInUp'
			)
		),
		array(
			'label' => esc_html__('Bouncing Exits', 'react'),
			'options' => array(
				'bounceOut' => 'bounceOut',
				'bounceOutDown' => 'bounceOutDown',
				'bounceOutLeft' => 'bounceOutLeft',
				'bounceOutRight' => 'bounceOutRight',
				'bounceOutUp' => 'bounceOutUp'
			)
		),
		array(
			'label' => esc_html__('Fading Entrances', 'react'),
			'options' => array(
				'fadeIn' => 'fadeIn',
				'fadeInDown' => 'fadeInDown',
				'fadeInDownBig' => 'fadeInDownBig',
				'fadeInLeft' => 'fadeInLeft',
				'fadeInLeftBig' => 'fadeInLeftBig',
				'fadeInRight' => 'fadeInRight',
				'fadeInRightBig' => 'fadeInRightBig',
				'fadeInUp' => 'fadeInUp',
				'fadeInUpBig' => 'fadeInUpBig'
			)
		),
		array(
			'label' => esc_html__('Fading Exits', 'react'),
			'options' => array(
				'fadeOut' => 'fadeOut',
				'fadeOutDown' => 'fadeOutDown',
				'fadeOutDownBig' => 'fadeOutDownBig',
				'fadeOutLeft' => 'fadeOutLeft',
				'fadeOutLeftBig' => 'fadeOutLeftBig',
				'fadeOutRight' => 'fadeOutRight',
				'fadeOutRightBig' => 'fadeOutRightBig',
				'fadeOutUp' => 'fadeOutUp',
				'fadeOutUpBig' => 'fadeOutUpBig'
			)
		),
		array(
			'label' => esc_html__('Flippers', 'react'),
			'options' => array(
				'flip' => 'flip',
				'flipInX' => 'flipInX',
				'flipInY' => 'flipInY',
				'flipOutX' => 'flipOutX',
				'flipOutY' => 'flipOutY'
			)
		),
		array(
			'label' => esc_html__('Lightspeed', 'react'),
			'options' => array(
				'lightSpeedIn' => 'lightSpeedIn',
				'lightSpeedOut' => 'lightSpeedOut'
			)
		),
		array(
			'label' => esc_html__('Rotating Entrances', 'react'),
			'options' => array(
				'rotateIn' => 'rotateIn',
				'rotateInDownLeft' => 'rotateInDownLeft',
				'rotateInDownRight' => 'rotateInDownRight',
				'rotateInUpLeft' => 'rotateInUpLeft',
				'rotateInUpRight' => 'rotateInUpRight'
			)
		),
		array(
			'label' => esc_html__('Rotating Exits', 'react'),
			'options' => array(
				'rotateOut' => 'rotateOut',
				'rotateOutDownLeft' => 'rotateOutDownLeft',
				'rotateOutDownRight' => 'rotateOutDownRight',
				'rotateOutUpLeft' => 'rotateOutUpLeft',
				'rotateOutUpRight' => 'rotateOutUpRight'
			)
		),
		array(
			'label' => esc_html__('Specials', 'react'),
			'options' => array(
				'hinge' => 'hinge',
				'rollIn' => 'rollIn',
				'rollOut' => 'rollOut'
			)
		),
		array(
			'label' => esc_html__('Zoom Entrances', 'react'),
			'options' => array(
				'zoomIn' => 'zoomIn',
				'zoomInDown' => 'zoomInDown',
				'zoomInLeft' => 'zoomInLeft',
				'zoomInRight' => 'zoomInRight',
				'zoomInUp' => 'zoomInUp'
			)
		),
		array(
			'label' => esc_html__('Zoom Exits', 'react'),
			'options' => array(
				'zoomOut' => 'zoomOut',
				'zoomOutDown' => 'zoomOutDown',
				'zoomOutLeft' => 'zoomOutLeft',
				'zoomOutRight' => 'zoomOutRight',
				'zoomOutUp' => 'zoomOutUp'
			)
		),
		array(
			'label' => esc_html__('Magic effects', 'react'),
			'options' => array(
				'magic' => 'Magic',
				'twisterInDown' => 'zoomOutDown',
				'twisterInUp' => 'twisterInUp',
				'swap' => 'swap'
			)
		),
		array(
			'label' => esc_html__('Magic Bling', 'react'),
			'options' => array(

				'puffIn' => 'puffIn',
				'puffOut' => 'puffOut',
				'vanishIn' => 'vanishIn',
				'vanishOut' => 'vanishOut',
			)
		),
		array(
			'label' => esc_html__('Magic Static Effects', 'react'),
			'options' => array(

				'openDownLeft' => 'openDownLeft',
				'openDownRight' => 'openDownRight',
				'openUpLeft' => 'openUpLeft',
				'openUpRight' => 'openUpRight',
				'openDownLeftRetourn' => 'openDownLeftRetourn',
				'openDownRightRetourn' => 'openDownRightRetourn',
				'openUpLeftRetourn' => 'openUpLeftRetourn',
				'openUpRightRetourn' => 'openUpRightRetourn'
			)
		),
		array(
			'label' => esc_html__('Magic Static Effects Out', 'react'),
			'options' => array(


				'openDownLeftOut' => 'openDownLeftOut',
				'openDownRightOut' => 'openDownRightOut',
				'openUpLeftOut' => 'openUpLeftOut',
				'openUpRightOut' => 'openUpRightOut'
			)
		),
		array(
			'label' => esc_html__('Magic Perspective', 'react'),
			'options' => array(

				'perspectiveDown' => 'perspectiveDown',
				'perspectiveUp' => 'perspectiveUp',
				'perspectiveLeft' => 'perspectiveLeft',
				'perspectiveRight' => 'perspectiveRight',
				'perspectiveDownRetourn' => 'perspectiveDownRetourn',
				'perspectiveUpRetourn' => 'perspectiveUpRetourn',
				'perspectiveLeftRetourn' => 'perspectiveLeftRetourn',
				'perspectiveRightRetourn' => 'perspectiveRightRetourn'
			)
		),
		array(
			'label' => esc_html__('Magic Rotate', 'react'),
			'options' => array(

				'rotateDown' => 'rotateDown',
				'rotateUp' => 'rotateUp',
				'rotateLeft' => 'rotateLeft',
				'rotateRight' => 'rotateRight'
			)
		),
		array(
			'label' => esc_html__('Magic Slide', 'react'),
			'options' => array(

				'slideDown' => 'slideDown',
				'slideUp' => 'slideUp',
				'slideLeft' => 'slideLeft',
				'slideRight' => 'slideRight',
				'slideDownRetourn' => 'slideDownRetourn',
				'slideUpRetourn' => 'slideUpRetourn',
				'slideLeftRetourn' => 'slideLeftRetourn',
				'slideRightRetourn' => 'slideRightRetourn'
			)
		),
		array(
			'label' => esc_html__('Magic Math', 'react'),
			'options' => array(

				'swashOut' => 'swashOut',
				'swashIn' => 'swashIn',
				'foolishOut' => 'foolishOut',
				'foolishIn' => 'foolishIn',
				'holeOut' => 'holeOut'
			)
		),
		array(
			'label' => esc_html__('Magic Tin', 'react'),
			'options' => array(

				'tinRightOut' => 'tinRightOut',
				'tinLeftOut' => 'tinLeftOut',
				'tinUpOut' => 'tinUpOut',
				'tinDownOut' => 'tinDownOut',
				'tinRightIn' => 'tinRightIn',
				'tinLeftIn' => 'tinLeftIn',
				'tinUpIn' => 'tinUpIn',
				'tinDownIn' => 'tinDownIn'
			)
		),
		array(
			'label' => esc_html__('Magic Bomb', 'react'),
			'options' => array(

				'bombRightOut' => 'bombRightOut',
				'bombLeftOut' => 'bombLeftOut'
			)
		),
		array(
			'label' => esc_html__('Magic Boing', 'react'),
			'options' => array(

				'boingInUp' => 'boingInUp',
				'boingOutDown' => 'boingOutDown'
			)
		),
		array(
			'label' => esc_html__('Magic On the Space', 'react'),
			'options' => array(

				'spaceOutUp' => 'spaceOutUp',
				'spaceOutRight' => 'spaceOutRight',
				'spaceOutDown' => 'spaceOutDown',
				'spaceOutLeft' => 'spaceOutLeft',
				'spaceInUp' => 'spaceInUp',
				'spaceInRight' => 'spaceInRight',
				'spaceInDown' => 'spaceInDown',
				'spaceInLeft' => 'spaceInLeft'


			)
		)
	);
}

/**
 * Get the array of HOVER animations for use in a <select> field
 *
 * @return  array
 */
function react_get_hover_animation_options()
{
	return array(
		'' => esc_html__('None', 'react'),
		array(
			'label' => esc_html__('2D Transitions', 'react'),
			'options' => array(
				'hvr-grow' => 'Grow',
				'hvr-shrink' => 'Shrink',
				'hvr-pulse' => 'Pulse',
				'hvr-pulse-grow' => 'Pulse Grow',
				'hvr-pulse-shrink' => 'Pulse Shrink',
				'hvr-push' => 'Push',
				'hvr-pop' => 'Pop',
				'hvr-bounce-in' => 'Bounce In',
				'hvr-bounce-out' => 'Bounce Out',
				'hvr-rotate-grow' => 'Rotate Grow',
				'hvr-rotate' => 'Rotate',
				'hvr-float' => 'Float',
				'hvr-sink' => 'Sink',
				'hvr-bob' => 'Bob',
				'hvr-hang' => 'Hang',
				'hvr-skew' => 'Skew',
				'hvr-skew-forward' => 'Skew Forward',
				'hvr-skew-backward' => 'Skew Backward',
				'hvr-wobble-horizontal' => 'Wobble Horizontal',
				'hvr-wobble-vertical' => 'Wobble Vertical',
				'hvr-wobble-to-bottom-right' => 'Wobble To Bottom Right',
				'hvr-wobble-to-top-right' => 'Wobble To Top Right',
				'hvr-wobble-top' => 'Wobble Top',
				'hvr-wobble-bottom' => 'Wobble Bottom',
				'hvr-wobble-skew' => 'Wobble Skew',
				'hvr-buzz' => 'Buzz',
				'hvr-buzz-out' => 'Buzz Out'
			)
		),
		array(
			'label' => esc_html__('Icons - you must add an icon', 'react'),
			'options' => array(
				'hvr-icon-back' => 'Icon Back',
				'hvr-icon-forward' => 'Icon Forward',
				'hvr-icon-down' => 'Icon Down',
				'hvr-icon-up' => 'Icon Up',
				'hvr-icon-spin' => 'Icon Spin',
				'hvr-icon-drop' => 'Icon Drop',
				'hvr-icon-grow' => 'Icon Grow',
				'hvr-icon-shrink' => 'Icon Shrink',
				'hvr-icon-pulse' => 'Icon Pulse',
				'hvr-icon-pulse-grow' => 'Icon Pulse Grow',
				'hvr-icon-pulse-shrink' => 'Icon Pulse Shrink',
				'hvr-icon-push' => 'Icon Push',
				'hvr-icon-pop' => 'Icon Pop',
				'hvr-icon-bounce' => 'Icon Bounce',
				'hvr-icon-rotate' => 'Icon Rotate',
				'hvr-icon-grow-rotate' => 'Icon Grow Rotate',
				'hvr-icon-float' => 'Icon Float',
				'hvr-icon-sink' => 'Icon Sink',
				'hvr-icon-bob' => 'Icon Bob',
				'hvr-icon-hang' => 'Icon Hang',
				'hvr-icon-wobble-horizontal' => 'Icon Wobble Horizontal',
				'hvr-icon-wobble-vertical' => 'Icon Wobble Vertical',
				'hvr-icon-buzz' => 'Icon Buzz',
				'hvr-icon-buzz-out' => 'Icon Buzz Out'
			)
		),
		array(
			'label' => esc_html__('Shadow and Glow Transitions', 'react'),
			'options' => array(
				'hvr-shadow' => 'Shadow',
				'hvr-grow-shadow' => 'Grow Shadow',
				'hvr-float-shadow' => 'Float Shadow',
				'hvr-glow' => 'Glow',
				'hvr-shadow-radial' => 'Shadow Radial'
			)
		)
	);
}

/**
 * Get the array of HOVER BORDER animations for use in a <select> field
 *
 * @return  array
 */
function react_get_hover_border_animation_options()
{
	return array(
		'' => esc_html__('None', 'react'),
		'hvr-border-fade' => 'Border Fade',
		'hvr-hollow' => 'Hollow',
		'hvr-trim' => 'Trim',
		'hvr-ripple-out' => 'Ripple Out',
		'hvr-ripple-in' => 'Ripple In',
		'hvr-outline-out' => 'Outline Out',
		'hvr-outline-in' => 'Outline In',
		'hvr-round-corners' => 'Round Corners',
		'hvr-underline-from-left' => 'Underline From Left',
		'hvr-underline-from-center' => 'Underline From Center',
		'hvr-underline-from-right' => 'Underline From Right',
		'hvr-reveal' => 'Reveal',
		'hvr-underline-reveal' => 'Underline Reveal',
		'hvr-overline-reveal' => 'Overline Reveal',
		'hvr-overline-from-left' => 'Overline From Left',
		'hvr-overline-from-center' => 'Overline From Center',
		'hvr-overline-from-right' => 'Overline From Right'
	);
}


/**
 * Get the array of HOVER BACKGROUND animations for use in a <select> field
 *
 * @return  array
 */
function react_get_hover_background_animation_options()
{
	return array(
		'' => esc_html__('Fade', 'react'),
		'hvr-sweep-to-right' => 'Sweep To Right',
		'hvr-sweep-to-left' => 'Sweep To Left',
		'hvr-sweep-to-bottom' => 'Sweep To Bottom',
		'hvr-sweep-to-top' => 'Sweep To Top',
		'hvr-bounce-to-right' => 'Bounce To Right',
		'hvr-bounce-to-left' => 'Bounce To Left',
		'hvr-bounce-to-bottom' => 'Bounce To Bottom',
		'hvr-bounce-to-top' => 'Bounce To Top',
		'hvr-radial-out' => 'Radial Out',
		'hvr-rectangle-out' => 'Rectangle Out',
		'hvr-shutter-out-horizontal' => 'Shutter Out Horizontal',
		'hvr-shutter-out-vertical' => 'Shutter Out Vertical'
	);
}

/**
 * Get the array of "go down" link locations
 *
 * @param   boolean  $showDefaultOption  If true include an empty default option first
 * @return  array
 */
function react_get_go_down_link_locations($showDefaultOption = false)
{
	$options = array(
		'header' => esc_html__('Go to Header', 'react'),
		'content' => esc_html__('Go to Content', 'react'),
		'intro' => esc_html__('Go to Intro', 'react'),
		'first_block' => esc_html__('Go custom element with ID first_block', 'react'),
	);

	if ($showDefaultOption) {
		$options = array('' => esc_html__('Default', 'react')) + $options;
	}

	return $options;
}

/**
 * Get the HTML for a single case study
 *
 * @return  string
 */
function react_get_case_study_html()
{
	$html = '<div class="react-case-study react-clearfix">
	<h3 class="react-case-study-name"></h3>
	<div class="react-case-study-left">
		<div class="react-case-study-thumbnail-wrap"><a class="react-external-link"><img class="react-case-study-thumbnail"></a></div>
	</div>
	<div class="react-case-study-middle">
		<p class="react-case-study-description"></p>
		<div class="react-case-study-buttons react-clearfix">
			<a class="react-case-study-preview react-button react-grey" target="_blank">' . esc_html__('Preview', 'react') . '</a>
			<a class="react-case-study-install react-button react-blue">' . esc_html__('Install', 'react') . '</a>
		</div>
	</div>
	<div class="react-case-study-right"></div>
</div>';

	return $html;
}

/**
 * Handle the Ajax request to show the Case Studies
 */
function react_show_case_studies_ajax()
{
	if (!current_user_can('edit_theme_options')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('react_show_case_studies', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	$response = wp_remote_get('http://react.themecatcher.net/?react-get-case-studies');

	if (wp_remote_retrieve_response_code($response) != 200 || !strlen($json = wp_remote_retrieve_body($response))) {
		wp_send_json(array('type' => 'error', 'message' => 'The request to get the Case Studies information failed'));
	}

	$data = json_decode($json, true);

	if (!is_array($data) || !isset($data['type'], $data['caseStudies']) || $data['type'] !== 'success' || !is_array($data['caseStudies'])) {
		wp_send_json(array('type' => 'error', 'message' => 'The Case Studies information was not in the expected format'));
	}

	// Check for missing requirements per Case Study
	foreach ($data['caseStudies'] as $key => $caseStudy) {
		$data['caseStudies'][$key]['missingRequirements'] = array();

		if (isset($caseStudy['requirements']) && is_array($caseStudy['requirements'])) {
			foreach ($caseStudy['requirements'] as $requirement) {
				switch ($requirement) {
					case 'revslider':
						if (!class_exists('RevSlider')) {
							$data['caseStudies'][$key]['missingRequirements'][] = sprintf(
								esc_html__('This Case Study uses the %1$sSlider Revolution%2$s plugin. Sliders will not be imported if you do not %3$sinstall and activate this plugin%4$s.', 'react'),
								'<a href="http://support.themecatcher.net/react-wordpress/getting-started/essentials/installing-the-slider-revolution-plugin" target="_blank">',
								'</a>',
								'<a href="' . esc_url(admin_url('themes.php?page=tgmpa-install-plugins')) . '">',
								'</a>'
							);
						}
						break;
					case 'quform':
						if (!function_exists('iphorm')) {
							$data['caseStudies'][$key]['missingRequirements'][] = sprintf(
								esc_html__('This Case Study uses the %1$sQuform%2$s plugin. Forms will not be imported if you do not %3$sinstall and activate this plugin%4$s.', 'react'),
								'<a href="http://support.themecatcher.net/react-wordpress/getting-started/essentials/installing-the-quform-plugin" target="_blank">',
								'</a>',
								'<a href="' . esc_url(admin_url('themes.php?page=tgmpa-install-plugins')) . '">',
								'</a>'
							);
						}
						break;
					case 'visualcomposer':
						if (!class_exists('Vc_Manager')) {
							$data['caseStudies'][$key]['missingRequirements'][] = sprintf(
								esc_html__('This Case Study uses the %1$sVisual Composer%2$s plugin. Page content may be malformed if you do not %3$sinstall and activate this plugin%4$s.', 'react'),
								'<a href="http://support.themecatcher.net/react-wordpress/getting-started/essentials/installing-the-visual-composer-plugin" target="_blank">',
								'</a>',
								'<a href="' . esc_url(admin_url('themes.php?page=tgmpa-install-plugins')) . '">',
								'</a>'
							);
						}
						break;
					case 'woocommerce':
						if (!function_exists('is_woocommerce')) {
							$data['caseStudies'][$key]['missingRequirements'][] = sprintf(
								esc_html__('This Case Study uses the %1$sWooCommerce%2$s plugin. Products will not be imported if you do not %3$sinstall and activate this plugin%4$s.', 'react'),
								'<a href="http://support.themecatcher.net/react-wordpress/getting-started/essentials/installing-the-woocommerce-plugin" target="_blank">',
								'</a>',
								'<a href="' . esc_url(admin_url('themes.php?page=tgmpa-install-plugins')) . '">',
								'</a>'
							);
						}
						break;
					case 'react-portfolio':
						if (!function_exists('tcp_get_option')) {
							$data['caseStudies'][$key]['missingRequirements'][] = sprintf(
								esc_html__('This Case Study uses the %1$sReact Portfolio%2$s plugin. The portfolio will not work if you do not %3$sinstall and activate this plugin%4$s.', 'react'),
								'<a href="http://support.themecatcher.net/react-wordpress/getting-started/essentials/installing-the-portfolio-plugin" target="_blank">',
								'</a>',
								'<a href="' . esc_url(admin_url('themes.php?page=tgmpa-install-plugins')) . '">',
								'</a>'
							);
						}
						break;
					case 'react-shortcodes':
						if (!function_exists('tcs_get_option')) {
							$data['caseStudies'][$key]['missingRequirements'][] = sprintf(
								esc_html__('This Case Study uses the %1$sReact Shortcodes%2$s plugin. The shortcodes will not work if you do not %3$sinstall and activate this plugin%4$s.', 'react'),
								'<a href="http://support.themecatcher.net/react-wordpress/getting-started/essentials/installing-the-shortcodes-plugin" target="_blank">',
								'</a>',
								'<a href="' . esc_url(admin_url('themes.php?page=tgmpa-install-plugins')) . '">',
								'</a>'
							);
						}
						break;
					case 'react-widgets':
						if (!function_exists('tcw_get_option')) {
							$data['caseStudies'][$key]['missingRequirements'][] = sprintf(
								esc_html__('This Case Study uses the %1$sReact Widgets%2$s plugin. The widgets will not work if you do not %3$sinstall and activate this plugin%4$s.', 'react'),
								'<a href="http://support.themecatcher.net/react-wordpress/getting-started/essentials/installing-the-widgets-plugin" target="_blank">',
								'</a>',
								'<a href="' . esc_url(admin_url('themes.php?page=tgmpa-install-plugins')) . '">',
								'</a>'
							);
						}
						break;
				}
			}
		}
	}

	wp_send_json($data);
}
add_action('wp_ajax_react_show_case_studies_ajax', 'react_show_case_studies_ajax');

/**
 * Handle the Ajax request to install a Case Study
 */
function react_install_case_study_ajax()
{
	if (!isset($_POST['key']) || !strlen($_POST['key'])) {
		wp_send_json(array('type' => 'error', 'message' => 'Bad request'));
	}

	if (!current_user_can('edit_theme_options')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('react_install_case_study', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	$response = wp_remote_get('http://react.themecatcher.net/?react-install-case-study&cs=' . urlencode($_POST['key']) . '&variation=' . urlencode($_POST['variation']));

	if (wp_remote_retrieve_response_code($response) != 200 || !strlen($json = wp_remote_retrieve_body($response))) {
		wp_send_json(array('type' => 'error', 'message' => 'The request to get the Case Study installation data failed'));
	}

	$data = json_decode($json, true);

	if (!is_array($data) || !isset($data['type'], $data['config']) || $data['type'] !== 'success' || !is_array($data['config'])) {
		wp_send_json(array('type' => 'error', 'message' => 'The Case Study installation data was not in the expected format'));
	}

	$config = $data['config'];
	$notices = array();

	ob_start();
	set_time_limit(0);

	// Download the WXR file
	$wxrFile = download_url($config['wxr']);

	if (!is_wp_error($wxrFile)) {
		if (!class_exists('WP_Import')) {
			if (!defined('WP_LOAD_IMPORTERS')) {
				define('WP_LOAD_IMPORTERS', true);
			}

			if (file_exists(WP_PLUGIN_DIR . '/wordpress-importer/wordpress-importer.php')) {
				require_once WP_PLUGIN_DIR . '/wordpress-importer/wordpress-importer.php';
			}

			// Check again to see if the class loaded
			if (!class_exists('WP_Import')) {
				wp_send_json(array('type' => 'error', 'message' => 'Import stopped: The WP_Import class does not exist'));
			}
		}

		$importer = new WP_Import;
		$importer->fetch_attachments = true;
		$importer->import($wxrFile);
		unlink($wxrFile);
	} else {
		ob_end_clean();
		wp_send_json(array('type' => 'error', 'message' => 'Import stopped: There was an error downloading the WXR file: ' . $wxrFile->get_error_message()));
	}


	$options = $config['themeOptions'];

	if (is_array($options)) {
		react_import_options($options);
	} else {
		$notices[] = array('type' => 'error', 'message' => 'Failed to import theme options: The theme options are invalid or malformed');
	}

	if (isset($config['forms']) && is_array($config['forms'])) {
		if (function_exists('iphorm_add_form')) {
			foreach ($config['forms'] as $form) {
				if (is_array($form)) {
					iphorm_add_form($form);
				} else {
					$notices[] = array('type' => 'error', 'message' => 'Failed to import the form: The form data is invalid or malformed');
				}
			}
		} else {
			$notices[] = array('type' => 'info', 'message' => 'Skipped form import: Quform not found');
		}
	}

	if (isset($config['revslider'])) {
		if (class_exists('RevSlider')) {
			$revSliders = (array) $config['revslider'];
			foreach ($revSliders as $revSliderUrl) {
				// Import slider
				$revSliderFile = download_url($revSliderUrl);

				if (!is_wp_error($revSliderFile)) {
					$_FILES['import_file'] = array(
						'name' => basename($revSliderUrl),
						'type' => 'application/x-zip-compressed',
						'tmp_name' => $revSliderFile,
						'error' => UPLOAD_ERR_OK,
						'size' => filesize($revSliderFile)
					);

					$revSlider = new RevSlider;
					$result = $revSlider->importSliderFromPost();

					if ( ! $result['success']) {
						$notices[] = array('type' => 'error', 'message' => 'Failed to import the Slider Revolution: ' . $result['error']);
					}

					unlink($revSliderFile);
				} else {
					$notices[] = array('type' => 'error', 'message' => 'Failed to import the Slider Revolution: ' . $revSliderFile->get_error_message());
				}
			}
		} else {
			$notices[] = array('type' => 'info', 'message' => 'Skipped slider import: Slider Revolution not found');
		}
	}

	if (isset($config['widgets'])) {
		if (!class_exists('Widget_Importer_Exporter')) {
			if (file_exists(WP_PLUGIN_DIR . '/widget-importer-exporter/widget-importer-exporter.php')) {
				require_once WP_PLUGIN_DIR . '/widget-importer-exporter/widget-importer-exporter.php';
			}
		}

		if (class_exists('Widget_Importer_Exporter')) {
			$widgetImporter = new Widget_Importer_Exporter;
			$widgetImporter->set_plugin_data();
			$widgetImporter->define_constants();
			$widgetImporter->load_textdomain();
			$widgetImporter->set_includes();
			$widgetImporter->load_includes();

			$response = wp_remote_get($config['widgets']);

			if (wp_remote_retrieve_response_code($response) != 200 || !strlen($json = wp_remote_retrieve_body($response))) {
				$notices[] = array('type' => 'error', 'message' => 'Failed to import the widgets: The request to get the widget data failed');
			} else {
				$data = json_decode($json); // Decode as object, as that is what the plugin expects

				if (!empty($data) && is_object($data)) {
					react_widgets_init(); // Register the variable number of widget areas before importing the widgets
					wie_import_data($data);
				} else {
					$notices[] = array('type' => 'error', 'message' => 'Failed to import the widgets: The widget data was not in the expected format');
				}
			}
		} else {
			$notices[] = array('type' => 'error', 'message' => 'Failed to import the widgets: The Widget_Importer_Exporter class does not exist');
		}
	}

	if (isset($config['staticFrontPage']) && $config['staticFrontPage'] && isset($config['frontPage'])) {
		update_option('show_on_front', 'page');
		update_option('page_on_front', $config['frontPage']);

		if (isset($config['postsPage'])) {
			update_option('page_for_posts', $config['postsPage']);
		}
	}

	if (isset($config['menus']) && is_array($config['menus'])) {
		$locations = get_theme_mod('nav_menu_locations');

		foreach ($config['menus'] as $menuLocationSlug => $menuSlug) {
			$term = get_term_by('slug', $menuSlug, 'nav_menu');
			if (is_object($term) && isset($term->term_id)) {
				$locations[$menuLocationSlug] = $term->term_id;
			}
		}

		set_theme_mod('nav_menu_locations', $locations);
	}

	ob_end_clean();

	wp_send_json(array(
		'type' => 'success',
		'message' => esc_html__('All done!', 'react'),
		'notices' => $notices
	));
}
add_action('wp_ajax_react_install_case_study_ajax', 'react_install_case_study_ajax');

if (function_exists('vc_set_as_theme')) :
/**
 * Set Visual Composer in theme mode to hide admin notice
 */
function react_vc_set_as_theme()
{
	vc_set_as_theme(true);
}
add_action('vc_before_init', 'react_vc_set_as_theme');
endif;
