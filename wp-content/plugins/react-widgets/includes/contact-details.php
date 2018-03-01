<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Contact details widget
 */
class TCW_Widget_Contact extends WP_Widget
{
	/**
	 * The default widget options
	 * @var array
	 */
	protected $defaults;

	public function __construct()
	{
		$this->defaults = array(
			'title' => sanitize_text_field(esc_html__('Contact Details', 'react-widgets')),
			'before' => '',
			'phone' => '',
			'fax' => '',
			'email' => '',
			'address' => '',
			'after' => ''
		);

		if (function_exists('react_get_option')) {
			$this->defaults['phone'] = react_get_option('contact_phone_number');
			$this->defaults['fax'] = react_get_option('contact_fax_number');
			$this->defaults['email'] = react_get_option('contact_email');
			$this->defaults['address'] = react_get_option('contact_address');
		}

		$widget_ops = array('classname' => 'tcw-widget-contact', 'description' => esc_html__('Contact details for a business or person.', 'react-widgets'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('tcw-widget-contact', 'React - ' . esc_html__('Contact Details', 'react-widgets'), $widget_ops, $control_ops);
	}

	public function widget($args, $instance)
	{
		$instance = wp_parse_args((array) $instance, $this->defaults);

		// WPML integration
		if (function_exists('icl_t')) {
			$instance['title'] = icl_t('React Widgets', 'Contact Details Title - ' . $this->id, $instance['title']);
			$instance['before'] = icl_t('React Widgets', 'Contact Details Before - ' . $this->id, $instance['before']);
			$instance['phone'] = icl_t('React Widgets', 'Contact Details Phone - ' . $this->id, $instance['phone']);
			$instance['fax'] = icl_t('React Widgets', 'Contact Details Fax - ' . $this->id, $instance['fax']);
			$instance['email'] = icl_t('React Widgets', 'Contact Details Email - ' . $this->id, $instance['email']);
			$instance['address'] = icl_t('React Widgets', 'Contact Details Address - ' . $this->id, $instance['address']);
			$instance['after'] = icl_t('React Widgets', 'Contact Details After - ' . $this->id, $instance['after']);
		}

		$instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $args['before_widget'];

		if (!empty($instance['title'])) {
			echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
		}
		?>
		<div class="tcw-widget-contact-innner tcw-clearfix">
			<?php echo do_shortcode($instance['before']); ?>
			<div class="tcw-contact-details-wrap tcw-clearfix">
				<?php if ($instance['phone']) : ?>
					<div class="tcw-contact-details tcw-clearfix">
						<div class="tcw-contact-method tcw-contact-method-phone">
							<i class="fa fa-phone"></i> <?php esc_html_e('Phone', 'react-widgets'); ?>
						</div>
						<div class="tcw-contact-detail"><?php echo esc_html($instance['phone']); ?></div>
					</div>
				<?php endif; ?>
				<?php if ($instance['fax']) : ?>
					<div class="tcw-contact-details tcw-clearfix">
						<div class="tcw-contact-method tcw-contact-method-fax">
							<i class="fa fa-file-o"></i> <?php esc_html_e('Fax', 'react-widgets'); ?>
						</div>
						<div class="tcw-contact-detail"><?php echo esc_html($instance['fax']); ?></div>
					</div>
				<?php endif; ?>
				<?php if ($instance['email']) : ?>
					<div class="tcw-contact-details tcw-clearfix">
						<div class="tcw-contact-method tcw-contact-method-email">
							<i class="fa fa-envelope"></i> <?php esc_html_e('Email', 'react-widgets'); ?>
						</div>
						<div class="tcw-contact-detail"><a href="mailto:<?php echo esc_attr($instance['email']); ?>"><?php echo esc_html($instance['email']); ?></a></div>
					</div>
				<?php endif; ?>
				<?php if ($instance['address']) : ?>
					<div class="tcw-contact-details tcw-clearfix">
						<div class="tcw-contact-method tcw-contact-method-address">
							<i class="fa fa-home"></i> <?php esc_html_e('Address', 'react-widgets'); ?>
						</div>
						<div class="tcw-contact-detail"><?php echo nl2br(esc_html($instance['address'])); ?></div>
					</div>
				<?php endif; ?>
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
		$instance['phone'] = sanitize_text_field($new_instance['phone']);
		$instance['fax'] = sanitize_text_field($new_instance['fax']);
		$instance['email'] = sanitize_email($new_instance['email']);
		$instance['address'] = wp_filter_nohtml_kses($new_instance['address']);
		$instance['after'] = wp_kses_post($new_instance['after']);

		// WPML integration
		if (function_exists('icl_register_string')) {
			icl_register_string('React Widgets', 'Contact Details Title - ' . $this->id, $instance['title']);
			icl_register_string('React Widgets', 'Contact Details Before - ' . $this->id, $instance['before']);
			icl_register_string('React Widgets', 'Contact Details Phone - ' . $this->id, $instance['phone']);
			icl_register_string('React Widgets', 'Contact Details Fax - ' . $this->id, $instance['fax']);
			icl_register_string('React Widgets', 'Contact Details Email - ' . $this->id, $instance['email']);
			icl_register_string('React Widgets', 'Contact Details Address - ' . $this->id, $instance['address']);
			icl_register_string('React Widgets', 'Contact Details After - ' . $this->id, $instance['after']);
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
				<label for="<?php echo esc_attr($this->get_field_id('before')); ?>"><?php esc_html_e('Text/HTML before contact details', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('before')); ?>" name="<?php echo esc_attr($this->get_field_name('before')); ?>"><?php echo esc_textarea($instance['before']); ?></textarea>
				<p class="tcw-widgetfield-description"><?php esc_html_e('Custom HTML to be displayed before the contact details, shortcodes can be used here.', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-200" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($instance['phone']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('fax')); ?>"><?php esc_html_e('Fax', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-200" id="<?php echo esc_attr($this->get_field_id('fax')); ?>" name="<?php echo esc_attr($this->get_field_name('fax')); ?>" type="text" value="<?php echo esc_attr($instance['fax']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('Email', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-300" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($instance['email']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>"><?php echo esc_textarea($instance['address']); ?></textarea>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('after')); ?>"><?php esc_html_e('Text/HTML after contact details', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('after')); ?>" name="<?php echo esc_attr($this->get_field_name('after')); ?>"><?php echo esc_textarea($instance['after']); ?></textarea>
				<p class="tcw-widgetfield-description"><?php esc_html_e('Custom HTML to be displayed after the contact details, shortcodes can be used here.', 'react-widgets'); ?></p>
			</div>
		</div>
		<?php
	}

}