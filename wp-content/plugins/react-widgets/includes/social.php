<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Social icons widget
 */
class TCW_Widget_Social extends WP_Widget
{
	/**
	 * The default widget options
	 * @var array
	 */
	protected $defaults;

	/**
	 * The social networks used by the theme
	 * @var array
	 */
	protected $socials;

	public function __construct()
	{
		$this->defaults = array(
			'title' => sanitize_text_field(esc_html__('Social Links', 'react-widgets')),
			'type' => 'tcw-type-2',
			'popup' => true
		);

		$this->socials = tcw_get_socials();
		$isReact = function_exists('react_get_option');

		foreach ($this->socials as $key => $social) {
			$this->defaults[$key] = $isReact ? react_get_option($key . '_url', '') : '';
		}

		$widget_ops = array('classname' => 'tcw-widget-social', 'description' => esc_html__('Social icons and links.', 'react-widgets'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('tcw-widget-social', 'React - ' . esc_html__('Social Icons', 'react-widgets'), $widget_ops, $control_ops);
	}

	public function widget($args, $instance)
	{
		$instance = wp_parse_args((array) $instance, $this->defaults);

		// WPML integration
		if (function_exists('icl_t')) {
			$instance['title'] = icl_t('React Widgets', 'Social Icons Title - '  . $this->id, $instance['title']);
		}

		$instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		$type = $instance['type'];
		$isType1 = $type == 'tcw-type-1';

		echo $args['before_widget'];

		if (!empty($instance['title'])) {
			echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
		}
		?>
		<div class="<?php echo esc_attr(tcw_sanitize_class('tcw-widget-social-inner tcw-clearfix ' . $type)); ?>">
			<?php
				foreach ($this->socials as $key => $social) {
					$url = $instance[$key];
					if ($url) {
						if ($social['fc'] && $isType1) {
							echo '<div class="' . esc_attr(tcw_sanitize_class('tcw-social-icon ' . $key)) . '"><a title="' . esc_attr($social['name']) . '" class="' . esc_attr(tcw_sanitize_class('webicon ' . $key)) . '" href="' . esc_url($url) . '"' . ($instance['popup'] ? ' target="_blank"' : '') . '></a></div>';
						} elseif ($social['fa'] && !$isType1) {
							$iconClass = 'fa fa-' . (isset($social['fa_class']) ? $social['fa_class'] : $key);

							echo '<div class="' . esc_attr(tcw_sanitize_class('tcw-social-icon ' . $key)) . '"><a title="' . esc_attr($social['name']) . '" class="' . esc_attr(tcw_sanitize_class($key)) . '" href="' . esc_url($url) . '"' .  ($instance['popup'] ? ' target="_blank"' : '') . '><i class="' . esc_attr(tcw_sanitize_class($iconClass)) . '"></i></a></div>';
						}
					}
				}
			?>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['type'] = sanitize_text_field($new_instance['type']);
		$instance['popup'] = isset($new_instance['popup']);

		foreach ($this->socials as $key => $social) {
			$instance[$key] = esc_url_raw($new_instance[$key]);
		}

		// WPML integration
		if (function_exists('icl_register_string')) {
			icl_register_string('React Widgets', 'Social Icons Title - ' . $this->id, $instance['title']);
		}

		return $instance;
	}

	public function form($instance)
	{
		$instance = wp_parse_args((array) $instance, $this->defaults);

		$types = array(
			'tcw-type-1' => esc_html__('SVG retina ready, IE image fallback', 'react-widgets'),
			'tcw-type-2' => esc_html__('FontAwesome text colored', 'react-widgets'),
			'tcw-type-3' => esc_html__('FontAwesome brand colored', 'react-widgets'),
			'tcw-type-4' => esc_html__('FontAwesome brand colored on hover', 'react-widgets'),
			'tcw-type-3 tcw-rounded' => esc_html__('FontAwesome brand colored (round)', 'react-widgets'),
			'tcw-type-4 tcw-rounded' => esc_html__('FontAwesome brand colored on hover (round)', 'react-widgets')
		);

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
				<label for="<?php echo esc_attr($this->get_field_id('type')); ?>"><?php esc_html_e('Icon style', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<select id="<?php echo esc_attr($this->get_field_id('type')); ?>" name="<?php echo esc_attr($this->get_field_name('type')); ?>">
					<?php foreach ($types as $value => $label) : ?>
						<option value="<?php echo esc_attr($value);?>" <?php selected($instance['type'], $value); ?>><?php echo esc_html($label, 'react-widgets'); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-input">
				<label for="<?php echo esc_attr($this->get_field_id('popup')); ?>">
					<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('popup')); ?>" name="<?php echo esc_attr($this->get_field_name('popup')); ?>" value="1" <?php checked($instance['popup'], true); ?>>
					<?php esc_html_e('Open links in new tab', 'react-widgets'); ?>
				</label>
			</div>
		</div>

		<table class="tcw-widget-social-networks tcw-widgetfield-table widefat">
			<tr>
				<th><?php esc_html_e('Network', 'react-widgets'); ?></th>
				<th><?php esc_html_e('URL', 'react-widgets'); ?></th>
			</tr>
			<?php foreach ($this->socials as $key => $social) : ?>
				<tr>
					<td>
						<label for="<?php echo esc_attr($this->get_field_id($key)); ?>">
							<?php
								echo esc_html($social['name']);

								if (!$social['fa']) {
									echo '<span class="tcw-widget-social-extra" title="' . esc_attr__('Available only with SVG icons', 'react-widgets') . '">[SVG]</span>';
								}
								if (!$social['fc']) {
									echo '<span class="tcw-widget-social-extra" title="' . esc_attr__('Available only with FontAwesome icons', 'react-widgets') . '">[FA]</span>';
								}
							?>
						</label>
					</td>
					<td>
						<input class="widefat" id="<?php echo esc_attr($this->get_field_id($key)); ?>" name="<?php echo esc_attr($this->get_field_name($key)); ?>" type="text" value="<?php echo esc_attr($instance[$key]); ?>" />
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
		<?php
	}
}