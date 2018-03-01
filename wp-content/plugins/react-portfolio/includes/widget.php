<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Text widget with portfolio shortcode generator
 */
class TCP_Widget_Portfolio extends WP_Widget
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

		$widget_ops = array('classname' => 'tcap-widget-portfolio', 'description' => esc_html__('Add portfolio items to your site.', 'tc-shortcodes'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('tcap-widget-portfolio', 'React - ' . esc_html__('Portfolio', 'tc-shortcodes'), $widget_ops, $control_ops);
	}

	public function widget($args, $instance)
	{
		$instance = wp_parse_args((array) $instance, $this->defaults);

		// WPML integration
		if (function_exists('icl_t')) {
			$instance['title'] = icl_t('React Portfolio', 'Widget Title - ' . $this->id, $instance['title']);
			$instance['text'] = icl_t('React Portfolio', 'Widget Content - ' . $this->id, $instance['text']);
		}

		$instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $args['before_widget'];

		if (!empty($instance['title'])) {
			echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
		}
		?>
			<div class="tcp-widget-portfolio-inner tcp-clearfix"><?php echo do_shortcode($instance['text']); ?></div>
		<?php
		echo $args['after_widget'];
	}

	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['text'] = wp_kses_post($new_instance['text']);

		// WPML integration
		if (function_exists('icl_register_string')) {
			icl_register_string('React Portfolio', 'Widget Title - ' . $this->id, $instance['title']);
			icl_register_string('React Portfolio', 'Widget Content - ' . $this->id, $instance['text']);
		}

		return $instance;
	}

	public function form($instance)
	{
		$instance = wp_parse_args((array) $instance, $this->defaults);
		?>
		<div class="tcap-widgetfield-wrap">
			<div class="tcap-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'tc-shortcodes'); ?></label>
			</div>
			<div class="tcap-widgetfield-input">
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</div>
		</div>
		<div class="tcap-widgetfield-wrap tcap-widgetfield-wrap-content">
			<div class="tcap-widget-insert-shortcode"><?php tcp_insert_shortcode_button($this->get_field_id('text')); ?></div>
			<div class="tcap-widgetfield-label tcap-clearfix">
				<label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_html_e('Content', 'tc-shortcodes'); ?></label>
			</div>
			<div class="tcap-widgetfield-input">
				<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_textarea($instance['text']); ?></textarea>
				<p class="tcap-widgetfield-description"><?php esc_html_e('Enter the widget content HTML and/or shortcodes.', 'tc-shortcodes'); ?></p>
			</div>
		</div>
		<?php
	}
}
