<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Opening times widget
 */
class TCW_Widget_Opening extends WP_Widget
{
	/**
	 * The default widget options
	 * @var array
	 */
	protected $defaults;

	/**
	 * The days of the week
	 * @var array
	 */
	protected $days = array(
		'monday' => 'Monday',
		'tuesday' => 'Tuesday',
		'wednesday' => 'Wednesday',
		'thursday' => 'Thursday',
		'friday' => 'Friday',
		'saturday' => 'Saturday',
		'sunday' => 'Sunday'
	);

	public function __construct()
	{
		$this->defaults = array(
			'title' => sanitize_text_field(esc_html__('Opening Times', 'react-widgets')),
			'before' => '',
			'after' => ''
		);

		foreach ($this->days as $key => $day) {
			$this->defaults[$key] = '';
			$this->defaults["label_$key"] = $day;
			$this->defaults["hide_$key"] = false;
		}

		$widget_ops = array('classname' => 'tcw-widget-opening', 'description' => esc_html__('Business opening times.', 'react-widgets'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('tcw-widget-opening', 'React - ' . esc_html__('Opening Times', 'react-widgets'), $widget_ops, $control_ops);
	}

	public function widget($args, $instance)
	{
		$instance = wp_parse_args((array) $instance, $this->defaults);

		// WPML integration
		if (function_exists('icl_t')) {
			$instance['title'] = icl_t('React Widgets', 'Opening Times Title - '  . $this->id, $instance['title']);
			$instance['before'] = icl_t('React Widgets', 'Opening Times Before - '  . $this->id, $instance['before']);
			$instance['after'] = icl_t('React Widgets', 'Opening Times After - '  . $this->id, $instance['after']);

			foreach ($this->days as $key => $day) {
				$instance["label_$key"] = icl_t('Opening Times ' . $day . ' Label - ' . $this->id, $instance["label_$key"]);
				$instance[$key] = icl_t('Opening Times ' . $day . ' - ' . $this->id, $instance[$key]);
			}
		}

		$instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $args['before_widget'];

		if (!empty($instance['title'])) {
			echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
		}
		?>
		<div class="tcw-widget-opening-inner tcw-clearfix">
			<?php echo do_shortcode($instance['before']); ?>
			<div class="tcw-opening-times-wrap tcw-clearfix">
				<?php foreach ($this->days as $key => $day) : ?>
					<?php if (!$instance["hide_$key"]) : ?>
						<div class="tcw-opening-times tcw-clearfix">
							<div class="tcw-one-day">
								<?php echo esc_html($instance["label_$key"]); ?>
							</div>
							<div class="tcw-open-time">
								<?php echo esc_html($instance[$key]); ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<?php echo do_shortcode($instance['after']); ?>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['before'] = wp_kses_post($new_instance['before']);
		$instance['after'] = wp_kses_post($new_instance['after']);

		foreach ($this->days as $key => $day) {
			$instance[$key] = sanitize_text_field($new_instance[$key]);
			$instance["label_$key"] = sanitize_text_field($new_instance["label_$key"]);
			$instance["hide_$key"] = isset($new_instance["hide_$key"]);
		}

		// WPML integration
		if (function_exists('icl_register_string')) {
			icl_register_string('React Widgets', 'Opening Times Title - ' . $this->id, $instance['title']);
			icl_register_string('React Widgets', 'Opening Times Before - ' . $this->id, $instance['before']);
			icl_register_string('React Widgets', 'Opening Times After - ' . $this->id, $instance['after']);

			foreach ($this->days as $key => $day) {
				icl_register_string('React Widgets', 'Opening Times ' . $day . ' - ' . $this->id, $instance[$key]);
				icl_register_string('React Widgets', 'Opening Times ' . $day . ' Label - ' . $this->id, $instance["label_$key"]);
			}
		}

		return $instance;
	}

	public function form($instance)
	{
		$instance = wp_parse_args((array) $instance, $this->defaults);
		?>
		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-300" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('before')); ?>"><?php esc_html_e('Text/HTML before opening times', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('before')); ?>" name="<?php echo esc_attr($this->get_field_name('before')); ?>"><?php echo esc_textarea($instance['before']); ?></textarea>
				<p class="tcw-widgetfield-description"><?php esc_html_e('Custom HTML to be displayed before the opening times. Shortcodes can be used here.', 'react-widgets'); ?></p>
			</div>
		</div>

		<table class="tcw-widgetfield-table widefat">
			<tr>
				<th><?php esc_html_e('Day', 'react-widgets'); ?></th>
				<th><?php esc_html_e('Opening times', 'react-widgets'); ?></th>
				<th class="tcw-width-25"><?php esc_html_e('Hide?', 'react-widgets'); ?></th>
			</tr>
			<?php foreach ($this->days as $key => $day) : ?>
				<tr>
					<td><input class="tcw-width-100p" id="<?php echo esc_attr($this->get_field_id("label_$key")); ?>" name="<?php echo esc_attr($this->get_field_name("label_$key")); ?>" type="text" value="<?php echo esc_attr($instance["label_$key"]); ?>" />
					<td><input class="tcw-width-100p" id="<?php echo esc_attr($this->get_field_id($key)); ?>" name="<?php echo esc_attr($this->get_field_name($key)); ?>" type="text" value="<?php echo esc_attr($instance[$key]); ?>" /></td>
					<td><input id="<?php echo esc_attr($this->get_field_id("hide_$key")); ?>" name="<?php echo esc_attr($this->get_field_name("hide_$key")); ?>" type="checkbox" value="1" <?php checked($instance["hide_$key"], true); ?> /></td>
				</tr>
			<?php endforeach; ?>
		</table>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('after')); ?>"><?php esc_html_e('Text/HTML after opening times', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('after')); ?>" name="<?php echo esc_attr($this->get_field_name('after')); ?>"><?php echo esc_textarea($instance['after']); ?></textarea>
				<p class="tcw-widgetfield-description"><?php esc_html_e('Custom HTML to be displayed after the opening times. Shortcodes can be used here.', 'react-widgets'); ?></p>
			</div>
		</div>
		<?php
	}
}