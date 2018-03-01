<?php
// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>
<div class="wrap">
	<h2><?php esc_html_e('Widget Settings', 'react-widgets'); ?></h2>
	<noscript><p class="tcaw-no-script"><span><?php esc_html_e('Please enable JavaScript to use the settings page.', 'react-widgets'); ?></span></p></noscript>
	<div id="tcaw-settings-saved" class="tcaw-settings-saved"><span><span class="tcaw-save-icon"></span><?php esc_html_e('Settings saved', 'react-widgets'); ?></span></div>

	<div class="tcaw-settings">

		<form id="tcaw-settings-form">

			<div class="tcaw-settings-heading"><?php esc_html_e('Performance settings', 'react-widgets'); ?></div>

			<div class="tcaw-setting tcaw-clearfix">
				<div class="tcaw-setting-label">
					<label for="tcaw_load_scripts"><?php esc_html_e('When to load scripts and styles', 'react-widgets'); ?></label>
				</div>
				<div class="tcaw-setting-inner">
					<select id="tcaw_load_scripts" name="tcaw_load_scripts">
						<option value="always" <?php selected(tcw_get_option('load_scripts'), 'always'); ?>><?php esc_html_e('Always', 'react-widgets'); ?></option>
						<option value="autodetect" <?php selected(tcw_get_option('load_scripts'), 'autodetect'); ?>><?php esc_html_e('Autodetect', 'react-widgets'); ?></option>
						<option value="custom" <?php selected(tcw_get_option('load_scripts'), 'custom'); ?>><?php esc_html_e('Only on specific pages', 'react-widgets'); ?></option>
					</select>
					<p class="tcaw-description"><?php esc_html_e('Choose which pages to load the plugin scripts and styles, these are required for the widgets to work properly, so you can choose only the pages containing the widgets to speed up the other pages on your site. Autodetect will only load the scripts and styles if an active widget is found on the current page.', 'react-widgets'); ?></p>
				</div>
			</div>

			<div class="tcaw-setting tcaw-clearfix tcaw-hidden">
				<div class="tcaw-setting-label"><label for="tcaw_load_scripts_custom"><?php esc_html_e('Choose pages', 'react-widgets'); ?></label></div>
				<div class="tcaw-setting-inner">
					<select id="tcaw_load_scripts_custom" data-placeholder="<?php esc_attr_e('Choose pages', 'react-widgets'); ?>" multiple>
						<?php foreach (get_pages() as $page) : ?>
							<option value="<?php echo esc_attr($page->ID); ?>" <?php selected(true, in_array($page->ID, tcw_get_option('load_scripts_custom'))); ?>><?php echo esc_html($page->post_title); ?></option>
						<?php endforeach; ?>
						<?php foreach (get_posts(array('numberposts' => -1)) as $post) : ?>
							<option value="<?php echo esc_attr($post->ID); ?>" <?php selected(true, in_array($post->ID, tcw_get_option('load_scripts_custom'))); ?>><?php echo esc_html($post->post_title); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="tcaw-settings-buttons tcaw-clearfix">
				<div class="tcaw-settings-save tcaw-button tcaw-blue"><?php esc_html_e('Save all settings', 'react-widgets'); ?></div>
			</div>

			<div class="tcaw-settings-heading"><?php esc_html_e('Disable script output', 'react-widgets'); ?></div>

			<div class="tcaw-setting tcaw-clearfix">
				<div class="tcaw-setting-label">
					<label><?php esc_html_e('CSS', 'react-widgets'); ?></label>
				</div>
				<div class="tcaw-setting-inner">
					<?php foreach (tcw_get_styles() as $key => $style) : ?>
						<div class="tcaw-script">
							<label><input type="checkbox" class="tcaw-disabled-styles" <?php checked(true, in_array($key, tcw_get_option('disabled_styles'))); ?> value="<?php echo esc_attr($key); ?>"><span class="tcaw-script-name"><?php echo esc_html($style['name']); ?></span><span class="tcaw-script-version">v<?php echo esc_html($style['version']); ?></span><span class="tcaw-tip-icon"><span class="tcaw-tooltip-text"><?php echo esc_html($style['tooltip']); ?></span></span></label>
						</div>
					<?php endforeach; ?>
					<p class="tcaw-description"><?php esc_html_e('You can disable the plugin CSS output using the boxes above.', 'react-widgets'); ?></p>
				</div>
			</div>

			<div class="tcaw-settings-buttons tcaw-clearfix">
				<div class="tcaw-settings-save tcaw-button tcaw-blue"><?php esc_html_e('Save all settings', 'react-widgets'); ?></div>
				<div class="tcaw-settings-reset tcaw-button tcaw-light"><span></span><?php esc_html_e('Reset settings', 'react-widgets'); ?></div>
			</div>

		</form>

	</div>

</div>