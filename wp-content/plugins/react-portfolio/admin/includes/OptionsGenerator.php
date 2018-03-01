<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Generates the HTML for options
 */
class TcpOptionsGenerator
{
	public function select($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'options' => array()
		));

		$classes = array('tcap-option-select');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<select id="' . esc_attr($config['name']) . '" name="' . esc_attr($config['name']) . '" class="' . esc_attr(tcp_sanitize_class($classes)) . '">';
		if (is_array($config['options'])) {
			foreach ($config['options'] as $key => $option) {
				if (is_array($option)) {
					echo '<optgroup label="' . esc_attr($option['label']) . '">';
					foreach ($option['options'] as $skey => $soption) {
						echo '<option value="' . esc_attr($skey) . '" ' . selected($config['value'], $skey, false) . '>' . esc_html($soption) . '</option>';
					}
					echo '</optgroup>';
				} else {
					echo '<option value="' . esc_attr($key) . '" ' . selected($config['value'], $key, false) . '>' . esc_html($option) . '</option>';
				}
			}
		}
		echo '</select>';
	}

	public function multiselect($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => array(),
			'class' => '',
			'options' => array()
		));

		$classes = array('tcap-option-select');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<select id="' . esc_attr($config['name']) . '" name="' . esc_attr($config['name']) . '" class="' . esc_attr(tcp_sanitize_class($classes)) . '" multiple="multiple">';
		if (is_array($config['options'])) {
			foreach ($config['options'] as $key => $label) {
				echo '<option value="' . esc_attr($key) . '" ' . selected($config['value'], $key, false) . '>' . esc_html($label) . '</option>';
			}
		}
		echo '</select>';
	}

	public function text($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'placeholder' => ''
		));

		$classes = array('tcap-option-text');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<input type="text" name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '" value="' . esc_attr($config['value']) . '"  class="' . esc_attr(tcp_sanitize_class($classes)) . '" ' . ($config['placeholder'] ? ' placeholder="' . esc_attr($config['placeholder']) . '" ' : '') . '>';
	}

	public function number($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'unit' => '',
			'placeholder' => ''
		));

		$classes = array('tcap-option-text');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<input type="text" name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '" value="' . esc_attr($config['value']) . '"  class="' . esc_attr(tcp_sanitize_class($classes)) . '" ' . ($config['placeholder'] ? ' placeholder="' . esc_attr($config['placeholder']) . '" ' : '') . '>';

		if (!empty($config['unit'])) {
			echo '<span class="tcap-range-unit">' . esc_html($config['unit']) . '</span>';
		}
	}

	public function hidden($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => ''
		));

		$classes = array();
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<input type="hidden" name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '" value="' . esc_attr($config['value']) . '"  class="' . esc_attr(tcp_sanitize_class($classes)) . '">';
	}

	public function slider($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'slider' => array()
		));

		$classes = array('tcap-option-text tcap-range-slider tcap-width-50');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<input type="text"
				 name="' . esc_attr($config['name']) . '"
				 id="' . esc_attr($config['name']) . '"
				 value="' . esc_attr($config['value']) . '"
				 class="' . esc_attr(tcp_sanitize_class($classes)) . '"
				 data-from="' . esc_attr($config['slider']['from']) . '"
				 data-to="' . esc_attr($config['slider']['to']) . '"
				 data-step="' . esc_attr($config['slider']['step']) . '"
				 data-dimension="' . esc_attr($config['slider']['dimension']) . '"
			 ><span class="tcap-range-unit">' . esc_html($config['slider']['dimension']) . '</span>';
	}

	public function textarea($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'rows' => '8',
			'cols' => '50'
		));

		$classes = array('tcap-option-textarea');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<textarea name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '" class="' . esc_attr(tcp_sanitize_class($classes)) . '" rows="' . esc_attr($config['rows']) . '" cols="' . esc_attr($config['cols']) . '">' . esc_textarea($config['value']) . '</textarea>';
	}

	public function toggle($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'toggle' => ''
		));

		if ($config['toggle'] == 'yn') {
			$classes = array('tcap-option-toggle-yn');
		} else {
			$classes = array('tcap-option-toggle');
		}

		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<input type="checkbox" class="' . esc_attr(tcp_sanitize_class($classes)) . '" name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '" value="1" ' . checked($config['value'], 1, false) . '>';
	}

	public function upload($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => ''
		));

		echo '<div class="tcap-clearfix">';
		echo '<div id="' . esc_attr($config['name']) . '_upload_button" class="tcap-media-button">' . esc_html__('Browse', 'react-portfolio') . '</div>';
		echo '</div>';
		echo '<div id="' . esc_attr($config['name']) . '_uploaded" class="tcap-clearfix tcap-upload-holder">';
		echo tcp_get_upload_thumbnail($config['value']);
		echo '</div>';
		echo '<div class="tcap-hidden"><textarea name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '">' . esc_textarea($config['value']) . '</textarea></div>';
	}

	public function unavailable($config)
	{
		echo '<p class="tcap-unavailable"><span><i class="fa fa-wrench"></i></span>' . esc_html__('This option is only available with the React theme active.', 'react-portfolio') . '</p>';

		$this->hidden($config);
	}
}