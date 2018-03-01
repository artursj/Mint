<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Generates the HTML for the shortcode dialog
 */
class TcsShortcodeOptionsGenerator extends TcsOptionsGenerator
{
	protected $config;
	protected $options;

	public function __construct($config, $options)
	{
		$this->config = $config;
		$this->options = $options;
	}

	public function render()
	{
		if (!empty($this->config['title'])) {
			echo '<h3>' . esc_html($this->config['title']) . '</h3>';
		}

		foreach ($this->options as $option) {
			if (method_exists($this, $option['type'])) {
				$option['default'] = array_key_exists('default', $option) ? $option['default'] : '';
				$option['value'] = $option['default'];

				$data = array('type' => $option['type']);

				if (isset($option['name'])) {
					$data['name'] = $option['name'];
					$data['selector'] = 'tcas-sc-' . $this->config['shortcode'] . '-' . $option['name'];
					$option['name'] = $data['selector'];
				}

				if (isset($option['default'])) {
					$data['default'] = $option['default'];
				}

				$classes = array('tcas-shortcode-field-outer', 'tcas-clearfix');
				if (!empty($option['wrap_class'])) {
					$classes[] = $option['wrap_class'];
				}

				echo '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '" data-config="' . esc_attr(wp_json_encode($data)) . '">';

				if (!empty($option['label'])) {
					echo '<div class="tcas-shortcode-field-label"><h4>' . esc_html($option['label']);

					if (!empty($option['optional'])) {
						echo ' <span class="tcas-optional">' . esc_html__('(optional)', 'react-shortcodes') . '</span>';
					}

					echo '</h4>';

					if (!empty($option['tooltip'])) {
						echo '<span class="tcas-tooltip-wrap"><span class="tcas-tooltip-text">' . esc_html($option['tooltip']) . '</span></span>';
					}

					echo '</div>';
				}

				echo '<div class="tcas-shortcode-field-inner tcas-clearfix">';
				$this->{$option['type']}($option);

				if (!empty($option['description'])) {
					echo '<p class="tcas-shortcode-field-description">' . esc_html($option['description']) . '</p>';
				}

				if (!empty($option['example'])) {
					echo '<pre class="tcas-sc-example">' . esc_html($option['example']) . '</pre>';
				}

				if (isset($option['unavailable']) && !tcs_is_react_active()) {
					if (is_string($option['unavailable'])) {
						$message = $option['unavailable'];
					} else {
						$message = esc_html__('This option is only available with the React theme active.', 'react-shortcodes');
					}

					echo '<p class="tcas-unavailable"><span><i class="fa fa-wrench"></i></span>' . esc_html($message) . '</p>';
				}

				echo '</div>';
				echo '</div>';
			}

			if ($option['type'] == 'custom_toggle') {
				echo '<div id="' . esc_attr($option['id']) . '" class="tcas-custom-toggle"><span></span>' . esc_html($option['content']) . '</div>';
			} else if ($option['type'] == 'div') {
				echo '<div class="' . esc_attr(tcs_sanitize_class($option['class'])) . '">' . esc_html($option['content']) . '</div>';
			} else if ($option['type'] == 'div_open') {
				echo '<div class="' . esc_attr(tcs_sanitize_class($option['class'])) . '">';
			} else if ($option['type'] == 'div_close') {
				echo '</div>';
			} else if ($option['type'] == 'clear') {
				echo '<div class="tcas-clear"></div>';
			}
		}
	}

	public function multiple($config)
	{
		extract(wp_parse_args($config, array(
			'elements' => array()
		)));

		foreach ($elements as $element) {
			if (method_exists($this, $element['type'])) {
				$element['default'] = array_key_exists('default', $element) ? $element['default'] : '';
				$element['value'] = $element['default'];
				$inline = isset($element['inline']) && $element['inline'];

				$data = array('type' => $element['type']);

				$classes = array('tcas-shortcode-inner-outer', 'tcas-clearfix');

				if (isset($element['name'])) {
					$data['name'] = $element['name'];
					$data['selector'] = 'tcas-sc-' . $this->config['shortcode'] . '-' . $element['name'];
					$classes[] = $data['selector'];
					$element['name'] = $data['selector'];
				}

				if (isset($element['default'])) {
					$data['default'] = $element['default'];
				}

				if ($inline) {
					$classes[] = 'tcas-shortcode-inner-inline';
				}
				if (!empty($element['wrap_class'])) {
					$classes[] = $element['wrap_class'];
				}

				echo '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '" data-config="' . esc_attr(wp_json_encode($data)) . '">';

				if (!empty($element['label'])) {
					echo '<div class="tcas-shortcode-inner-label"><div class="tcas-mini-label">' . esc_html($element['label']);

					if (!empty($element['optional'])) {
						echo '<span class="tcas-optional">' . esc_html__('(optional)', 'react-shortcodes') . '</span>';
					}

					if (!empty($element['tooltip'])) {
						echo '<span class="tcas-tip-icon">[?]<span class="tcas-tooltip-text">' . esc_html($element['tooltip']) . '</span></span>';
					}

					echo '</div></div>';
				}

				echo '<div class="tcas-shortcode-inner-inner tcas-clearfix">';

				$this->{$element['type']}($element);

				if (!empty($element['description'])) {
					echo '<p class="tcas-shortcode-inner-description">' . esc_html($element['description']) . '</p>';
				}

				if (isset($option['unavailable']) && !tcs_is_react_active()) {
					if (is_string($option['unavailable'])) {
						$message = $option['unavailable'];
					} else {
						$message = esc_html__('This option is only available with the React theme active.', 'react-shortcodes');
					}

					echo '<p class="tcas-unavailable"><span><i class="fa fa-wrench"></i></span>' . esc_html($message) . '</p>';
				}

				echo '</div>';
				echo '</div>';
			}

			if ($element['type'] == 'custom_toggle') {
				echo '<div id="' . esc_attr($element['id']) . '" class="tcas-custom-toggle"><span></span>' . esc_html($element['content']) . '</div>';
			} else if ($element['type'] == 'div') {
				echo '<div class="' . esc_attr(tcs_sanitize_class($element['class'])) . '">' . esc_html($element['content']) . '</div>';
			} else if ($element['type'] == 'div_open') {
				echo '<div class="' . esc_attr(tcs_sanitize_class($element['class'])) . '">';
			} else if ($element['type'] == 'div_close') {
				echo '</div>';
			} else if ($element['type'] == 'clear') {
				echo '<div class="tcas-clear"></div>';
			} else if ($element['type'] == 'label') {
				echo '<div class="tcas-shortcode-inner-label">' . esc_html($element['content']) . '</div>';
			}
		}
	}
}