<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Generates the HTML for options
 */
class TcsOptionsGenerator
{
	public function select($config)
	{
		extract(wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'options' => array()
		)));

		$classes = array('tcas-option-select');
		if (!empty($class)) {
			$classes[] = $class;
		}

		echo '<select id="' . esc_attr($name) . '" name="' . esc_attr($name) . '" class="' . esc_attr(tcs_sanitize_class($classes)) . '">';
		if (is_array($options)) {
			foreach ($options as $key => $option) {
				if (is_array($option)) {
					echo '<optgroup label="' . esc_attr($option['label']) . '">';
					foreach ($option['options'] as $skey => $soption) {
						echo '<option value="' . esc_attr($skey) . '" ' . selected($value, $skey, false) . '>' . esc_html($soption) . '</option>';
					}
					echo '</optgroup>';
				} else {
					echo '<option value="' . esc_attr($key) . '" ' . selected($value, $key, false) . '>' . esc_html($option) . '</option>';
				}
			}
		}
		echo '</select>';
	}

	public function multiselect($config)
	{
		extract(wp_parse_args($config, array(
			'name' => '',
			'value' => array(),
			'class' => '',
			'options' => array()
		)));

		$classes = array('tcas-option-select');
		if (!empty($class)) {
			$classes[] = $class;
		}

		echo '<select id="' . esc_attr($name) . '" name="' . esc_attr($name) . '" class="' . esc_attr(tcs_sanitize_class($classes)) . '" multiple="multiple">';
		if (is_array($options)) {
			foreach ($options as $key => $label) {
				echo '<option value="' . esc_attr($key) . '" ' . selected($value, $key, false) . '>' . esc_html($label) . '</option>';
			}
		}
		echo '</select>';
	}

	public function text($config)
	{
		extract(wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'placeholder' => ''
		)));

		$classes = array('tcas-option-text');
		if (!empty($class)) {
			$classes[] = $class;
		}

		echo '<input type="text" name="' . esc_attr($name) . '" id="' . esc_attr($name) . '" value="' . esc_attr($value) . '"  class="' . esc_attr(tcs_sanitize_class($classes)) . '" ' . ($placeholder ? ' placeholder="' . esc_attr($placeholder) . '" ' : '') . '>';
	}

	public function number($config)
	{
		extract(wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'unit' => '',
			'placeholder' => ''
		)));

		$classes = array('tcas-option-text');
		if (!empty($class)) {
			$classes[] = $class;
		}

		echo '<input type="text" name="' . esc_attr($name) . '" id="' . esc_attr($name) . '" value="' . esc_attr($value) . '"  class="' . esc_attr(tcs_sanitize_class($classes)) . '" ' . ($placeholder ? ' placeholder="' . esc_attr($placeholder) . '" ' : '') . '>';

		if (!empty($unit)) {
			echo '<span class="tcas-range-unit">' . esc_html($unit) . '</span>';
		}
	}

	public function text_upload($config)
	{
		extract(wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'placeholder' => '',
			'id' => ''
		)));

		$classes = array('tcas-option-text');
		if (!empty($class)) {
			$classes[] = $class;
		}

		echo '<input type="text" name="' . esc_attr($name) . '" id="' . esc_attr($name) . '" value="' . esc_attr($value) . '"  class="' . esc_attr(tcs_sanitize_class($classes)) . '" ' . ($placeholder ? ' placeholder="' . esc_attr($placeholder) . '" ' : '') . '>';
		echo '<div class="tcas-upload-logo-button-wrap tcas-clearfix"><div id="' . esc_attr($id) . '" class="tcas-media-button">' . esc_html__('Browse', 'react-shortcodes') . '</div></div>';
	}

	public function hidden($config)
	{
		extract(wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => ''
		)));

		$classes = array();
		if (!empty($class)) {
			$classes[] = $class;
		}

		echo '<input type="hidden" name="' . esc_attr($name) . '" id="' . esc_attr($name) . '" value="' . esc_attr($value) . '"  class="' . esc_attr(tcs_sanitize_class($classes)) . '">';
	}

	public function slider($config)
	{
		extract(wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'slider' => array()
		)));

		$classes = array('tcas-option-text tcas-range-slider tcas-width-50');
		if (!empty($class)) {
			$classes[] = $class;
		}

		echo '<input type="text"
					 name="' . esc_attr($name) . '"
					 id="' . esc_attr($name) . '"
					 value="' . esc_attr($value) . '"
					 class="' . esc_attr(tcs_sanitize_class($classes)) . '"
					 data-from="' . esc_attr($slider['from']) . '"
					 data-to="' . esc_attr($slider['to']) . '"
					 data-step="' . esc_attr($slider['step']) . '"
					 data-dimension="' . esc_attr($slider['dimension']) . '"
			 ><span class="tcas-range-unit">' . esc_html($slider['dimension']) . '</span>';
	}

	public function textarea($config)
	{
		extract(wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'rows' => '8',
			'cols' => '50'
		)));

		$classes = array('tcas-option-textarea');
		if (!empty($class)) {
			$classes[] = $class;
		}

		echo '<textarea name="' . esc_attr($name) . '" id="' . esc_attr($name) . '" class="' . esc_attr(tcs_sanitize_class($classes)) . '" rows="' . esc_attr($rows) . '" cols="' . esc_attr($cols) . '">' . esc_textarea($value) . '</textarea>';
	}

	public function toggle($config)
	{
		extract(wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'toggle' => ''
		)));

		if ($toggle == 'yn') {
			$classes = array('tcas-option-toggle-yn');
		} else {
			$classes = array('tcas-option-toggle');
		}

		if (!empty($class)) {
			$classes[] = $class;
		}

		echo '<input type="checkbox" class="' . esc_attr(tcs_sanitize_class($classes)) . '" name="' . esc_attr($name) . '" id="' . esc_attr($name) . '" value="1" ' . checked($value, 1, false) . '>';
	}

	public function icon($config)
	{
		extract(wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'subset' => ''
		)));

		echo tcs_icon_selector_field($value, $name, $name, $subset);
	}

	public function unavailable($config)
	{
		echo '<p class="tcas-unavailable"><span><i class="fa fa-wrench"></i></span>' . esc_html__('This option is only available with the React theme active.', 'react-shortcodes') . '</p>';
		$this->hidden($config);
	}
}