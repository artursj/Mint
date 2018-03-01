<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Text widget with shortcodes generator
 */
class TCS_Widget_Shortcode extends WP_Widget
{
	/**
	 * The default widget options
	 * @var array
	 */
	protected $defaults;

	public function __construct()
	{
		$this->defaults = array(
			'title' => '',
			'text' => ''
		);

		$widget_ops = array('classname' => 'tcas-widget-shortcode', 'description' => esc_html__('Arbitrary text, HTML or shortcodes.', 'react-shortcodes'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('tcas-widget-shortcode', 'React - ' . esc_html__('Shortcode', 'react-shortcodes'), $widget_ops, $control_ops);
	}

	public function widget($args, $instance)
	{
		extract($args);
		$instance = wp_parse_args((array) $instance, $this->defaults);

		// WPML integration
		if (function_exists('icl_t')) {
			$instance['title'] = icl_t('React Shortcodes', 'Widget Title - ' . $this->id, $instance['title']);
			$instance['text'] = icl_t('React Shortcodes', 'Widget Content - ' . $this->id, $instance['text']);
		}

		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $before_widget;

		if (!empty($title)) {
			echo $before_title . esc_html($title) . $after_title;
		}
		?>
			<div class="tcs-widget-shortcode-inner tcs-clearfix"><?php echo do_shortcode($instance['text']); ?></div>
		<?php
		echo $after_widget;
	}

	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['text'] = wp_kses_post($new_instance['text']);

		// WPML integration
		if (function_exists('icl_register_string')) {
			icl_register_string('React Shortcodes', 'Widget Title - ' . $this->id, $instance['title']);
			icl_register_string('React Shortcodes', 'Widget Content - ' . $this->id, $instance['text']);
		}

		return $instance;
	}

	public function form($instance)
	{
		$instance = wp_parse_args((array) $instance, $this->defaults);
		?>
		<div class="tcas-widgetfield-wrap">
			<div class="tcas-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'react-shortcodes'); ?></label>
			</div>
			<div class="tcas-widgetfield-input">
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</div>
		</div>
		<div class="tcas-widgetfield-wrap tcas-widgetfield-wrap-content">
			<div class="tcas-widget-insert-shortcode"><?php tcs_insert_shortcode_button($this->get_field_id('text')); ?></div>
			<div class="tcas-widgetfield-label tcas-clearfix">
				<label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_html_e('Content', 'react-shortcodes'); ?></label>
			</div>
			<div class="tcas-widgetfield-input">
				<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_textarea($instance['text']); ?></textarea>
				<p class="tcas-widgetfield-description"><?php esc_html_e('Enter the widget content HTML and/or shortcodes', 'react-shortcodes'); ?></p>
			</div>
		</div>
		<?php
	}
}
