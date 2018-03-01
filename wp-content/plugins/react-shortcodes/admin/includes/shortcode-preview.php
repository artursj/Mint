<?php
// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?><!DOCTYPE html>
<html>
<head>
<!-- Deliberately not using wp_enqueue_script here to load only the styles we need for the shortcode preview -->
<link rel="stylesheet" type="text/css" href="<?php echo esc_url(tcs_url('css/font-awesome/css/font-awesome.min.css?ver=4.6.1')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo esc_url(tcs_url('css/icomoon/css/icomoon.min.css?ver=' . TCS_PLUGIN_VERSION)); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo esc_url(tcs_url('css/iconsprite.css?ver=' . TCS_PLUGIN_VERSION)); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo esc_url(tcs_url('css/styles.css?ver=' . TCS_PLUGIN_VERSION)); ?>">
</head>
<body>
<div class="tcs-clearfix" style="padding: 20px;">
<?php
	if (is_user_logged_in()) {
		if (current_user_can('edit_posts') || current_user_can('edit_pages') || current_user_can('edit_theme_options')) {
			if (!empty($_GET['s'])) {
				// Allow only a few safe HTML tags
				$allowedTags = array(
					'ul' => array(),
					'li' => array(),
					'table' => array(),
					'tr' => array(),
					'th' => array(),
					'td' => array(),
					'img' => array()
				);

				$allowedTags = array_merge(wp_kses_allowed_html(), $allowedTags);

				$shortcode = stripslashes($_GET['s']);
				$shortcode = wp_kses($shortcode, $allowedTags);
				echo do_shortcode($shortcode);
			} else {
				echo '<p>' . esc_html__('The shortcode string could not be found.', 'react-shortcodes') . '</p>';
			}
		} else {
			echo '<p>' . esc_html__('You do not have permission to do this.', 'react-shortcodes') . '</p>';
		}
	} else {
		echo '<p>' . esc_html__('You are not logged in.', 'react-shortcodes') . '</p>';
	}
?>
</div>
</body>
</html>