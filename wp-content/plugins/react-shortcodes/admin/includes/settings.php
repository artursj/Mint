<?php
// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>
<div class="wrap">
	<h2><?php esc_html_e('Shortcode Settings', 'react-shortcodes'); ?></h2>
	<noscript><p class="tcas-no-script"><span><?php esc_html_e('Please enable JavaScript to use the settings page.', 'react-shortcodes'); ?></span></p></noscript>
	<div id="tcas-settings-saved" class="tcas-settings-saved"><span><span class="tcas-save-icon"></span><?php esc_html_e('Settings saved', 'react-shortcodes'); ?></span></div>

	<div class="tcas-settings">

		<form id="tcas-settings-form">

			<div class="tcas-settings-heading"><?php esc_html_e('Performance settings', 'react-shortcodes'); ?></div>

			<div class="tcas-setting tcas-clearfix">
				<div class="tcas-setting-label">
					<label for="tcas_load_scripts"><?php esc_html_e('When to load scripts and styles', 'react-shortcodes'); ?></label>
				</div>
				<div class="tcas-setting-inner">
					<select id="tcas_load_scripts" name="tcas_load_scripts">
						<option value="always" <?php selected(tcs_get_option('load_scripts'), 'always'); ?>><?php esc_html_e('Always', 'react-shortcodes'); ?></option>
						<option value="custom" <?php selected(tcs_get_option('load_scripts'), 'custom'); ?>><?php esc_html_e('Only on specific pages', 'react-shortcodes'); ?></option>
					</select>
					<p class="tcas-description"><?php esc_html_e('Choose which pages to load the plugin scripts and styles, these are required for the shortcodes to work properly, so you can choose only the pages containing the shortcodes to speed up the other pages on your site.', 'react-shortcodes'); ?></p>
				</div>
			</div>

			<div class="tcas-setting tcas-clearfix tcas-hidden">
				<div class="tcas-setting-label"><label for="tcas_load_scripts_custom"><?php esc_html_e('Choose pages', 'react-shortcodes'); ?></label></div>
				<div class="tcas-setting-inner">
					<select id="tcas_load_scripts_custom" data-placeholder="<?php esc_attr_e('Choose pages', 'react-shortcodes'); ?>" multiple>
						<?php foreach (get_pages() as $page) : ?>
							<option value="<?php echo esc_attr($page->ID); ?>" <?php selected(true, in_array($page->ID, tcs_get_option('load_scripts_custom'))); ?>><?php echo esc_html($page->post_title); ?></option>
						<?php endforeach; ?>
						<?php foreach (get_posts(array('numberposts' => -1)) as $post) : ?>
							<option value="<?php echo esc_attr($post->ID); ?>" <?php selected(true, in_array($post->ID, tcs_get_option('load_scripts_custom'))); ?>><?php echo esc_html($post->post_title); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="tcas-settings-buttons tcas-clearfix">
				<div class="tcas-settings-save tcas-button tcas-blue"><?php esc_html_e('Save all settings', 'react-shortcodes'); ?></div>
			</div>

			<div class="tcas-settings-heading"><?php esc_html_e('Disable script output', 'react-shortcodes'); ?></div>

			<div class="tcas-setting tcas-clearfix">
				<div class="tcas-setting-label">
					<label><?php esc_html_e('CSS', 'react-shortcodes'); ?></label>
				</div>
				<div class="tcas-setting-inner">
					<?php foreach (tcs_get_styles() as $key => $style) : ?>
						<div class="tcas-script">
							<label><input type="checkbox" class="tcas-disabled-styles" <?php checked(true, in_array($key, tcs_get_option('disabled_styles'))); ?> value="<?php echo esc_attr($key); ?>"><span class="tcas-script-name"><?php echo esc_html($style['name']); ?></span><span class="tcas-script-version">v<?php echo esc_html($style['version']); ?></span><span class="tcas-tip-icon"><span class="tcas-tooltip-text"><?php echo esc_html($style['tooltip']); ?></span></span></label>
						</div>
					<?php endforeach; ?>
					<p class="tcas-description"><?php esc_html_e('You can disable the plugin CSS output using the boxes above.', 'react-shortcodes'); ?></p>
				</div>
			</div>

			<div class="tcas-setting tcas-clearfix">
				<div class="tcas-setting-label">
					<label><?php esc_html_e('JavaScript', 'react-portfolio'); ?></label>
				</div>
				<div class="tcas-setting-inner">
					<?php foreach (tcs_get_scripts() as $key => $script) : ?>
						<div class="tcas-script">
							<label><input type="checkbox" class="tcas-disabled-scripts" <?php checked(true, in_array($key, tcs_get_option('disabled_scripts'))); ?> value="<?php echo esc_attr($key); ?>"><span class="tcas-script-name"><?php echo esc_html($script['name']); ?></span><span class="tcas-script-version">v<?php echo esc_html($script['version']); ?></span><span class="tcas-tip-icon"><span class="tcas-tooltip-text"><?php echo esc_html($script['tooltip']); ?></span></span></label>
						</div>
					<?php endforeach; ?>
					<p class="tcas-description"><?php esc_html_e('You can disable the plugin JS output using the boxes above.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcas-settings-buttons tcas-clearfix">
				<div class="tcas-settings-save tcas-button tcas-blue"><?php esc_html_e('Save all settings', 'react-shortcodes'); ?></div>
				<div class="tcas-settings-reset tcas-button tcas-light"><span></span><?php esc_html_e('Reset settings', 'react-shortcodes'); ?></div>
			</div>

		</form>

	</div>

</div>