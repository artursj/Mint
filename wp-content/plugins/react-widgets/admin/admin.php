<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Enqueue the admin CSS stylesheet
 *
 * @param string $hook The current page
 */
function tcw_admin_enqueue_styles($hook)
{
	if ($hook == 'widgets.php' || $hook == 'settings_page_tcw_settings') {
		if ($hook == 'settings_page_tcw_settings') {
			wp_enqueue_style('qtip2', tcw_url('admin/js/qtip2/jquery.qtip.min.css'), array(), '2.2.1');
			wp_enqueue_style('chosen', tcw_url('admin/js/chosen/chosen.min.css'), array(), '1.4.2');
		}

		wp_enqueue_style('tcaw-styles', tcw_url('admin/css/styles.css'), array(), TCW_PLUGIN_VERSION);
	}
}
add_action('admin_enqueue_scripts', 'tcw_admin_enqueue_styles');

/**
 * Enqueue the admin JavaScript
 *
 * @param string $hook The current page
 */
function tcw_admin_enqueue_scripts($hook)
{
	if ($hook == 'settings_page_tcw_settings') {
		wp_enqueue_script('qtip2', tcw_url('admin/js/qtip2/jquery.qtip.min.js'), array('jquery'), '2.2.1', true);
		wp_enqueue_script('chosen', tcw_url('admin/js/chosen/jquery.chosen.min.js'), array(), '1.4.2', true);
		wp_enqueue_script('tcaw-settings', tcw_url('admin/js/settings.js'), array(), TCW_PLUGIN_VERSION, true);

		wp_localize_script('tcaw-settings', 'tcawL10n', tcw_admin_l10n());
	}
}
add_action('admin_enqueue_scripts', 'tcw_admin_enqueue_scripts');

/**
 * Admin script localization
 *
 * @return array
 */
function tcw_admin_l10n()
{
	$data = array(
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'saveSettingsNonce' => wp_create_nonce('tcw_save_settings'),
		'resetSettingsNonce' => wp_create_nonce('tcw_reset_settings'),
		'confirmResetSettings' => esc_html__('Are you sure you want to reset the settings?', 'react-widgets') . "\n\n" . esc_html__('The page will reload and the current settings will be replaced with the defaults.', 'react-widgets'),
	);

	return array(
		'l10n_print_after' => 'tcawL10n = ' . wp_json_encode($data) . ';'
	);
}

/**
 * Add the Settings link to the WP menu
 */
function tcw_admin_menu()
{
	add_options_page(
		esc_html__('Widget Settings', 'react-widgets'),
		esc_html__('React Widgets', 'react-widgets'),
		'edit_theme_options',
		'tcw_settings',
		'tcw_settings'
	);
}
add_action('admin_menu', 'tcw_admin_menu');

/**
 * Display the Settings page
 */
function tcw_settings()
{
	require_once TCW_ADMIN_INCLUDES_DIR . '/settings.php';
}

/**
 * Handle the Ajax call to save the settings
 */
function tcw_save_settings_ajax()
{
	if (!isset($_POST['options']) || !is_array($_POST['options'])) {
		wp_send_json(array('type' => 'error', 'message' => 'Bad request'));
	}

	if (!current_user_can('edit_theme_options')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('tcw_save_settings', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	$new = stripslashes_deep($_POST['options']);
	$defaults = tcw_get_default_options();

	$options = array(
		// Performance settings
		'load_scripts' => isset($new['tcaw_load_scripts']) ? sanitize_text_field($new['tcaw_load_scripts']) : $defaults['load_scripts'],
		'load_scripts_custom' => isset($new['tcaw_load_scripts_custom']) && is_array($new['tcaw_load_scripts_custom']) ? array_map('absint', $new['tcaw_load_scripts_custom']) : $defaults['load_scripts_custom'],

		// Disable script output
		'disabled_styles' => isset($new['tcaw_disabled_styles']) && is_array($new['tcaw_disabled_styles']) ? array_map('sanitize_text_field', $new['tcaw_disabled_styles']) : $defaults['disabled_styles']
	);

	update_option(TCW_OPTIONS_KEY, $options);

	wp_send_json(array(
		'type' => 'success'
	));
}
add_action('wp_ajax_tcw_save_settings_ajax', 'tcw_save_settings_ajax');

/**
 * Handle the Ajax call to reset the settings
 */
function tcw_reset_settings_ajax()
{
	if (!current_user_can('edit_theme_options')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('tcw_reset_settings', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	update_option(TCW_OPTIONS_KEY, tcw_get_default_options());

	wp_send_json(array(
		'type' => 'success'
	));
}
add_action('wp_ajax_tcw_reset_settings_ajax', 'tcw_reset_settings_ajax');