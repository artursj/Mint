<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Generates the HTML for the shortcode dialog
 */
class TcpShortcodeOptionsGenerator extends TcpOptionsGenerator
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
					$data['selector'] = 'tcap-sc-' . $this->config['shortcode'] . '-' . $option['name'];
					$option['name'] = $data['selector'];
				}

				if (isset($option['default'])) {
					$data['default'] = $option['default'];
				}

				$wrapClasses = array();
				if (!empty($option['wrap_class'])) {
					$wrapClasses = explode(' ', $option['wrap_class']);
				}

				echo '<div class="tcap-shortcode-field-outer tcap-clearfix ' . esc_attr(tcp_sanitize_class($wrapClasses)) . '" data-config="' . esc_attr(wp_json_encode($data)) . '">';
				if (!empty($option['label'])) {
					echo '<div class="tcap-shortcode-field-label"><h4>' . esc_html($option['label']) . '</h4>';

					if (!empty($option['tooltip'])) {
						echo '<span class="tcap-tooltip-wrap"><span class="tcap-tooltip-text">' . esc_html($option['tooltip']) . '</span></span>';
					}

					echo '</div>';
				}
				echo '<div class="tcap-shortcode-field-inner tcap-clearfix">';

				$this->{$option['type']}($option);

				if (!empty($option['description'])) {
					echo '<p class="tcap-shortcode-field-description">' . esc_html($option['description']) . '</p>';
				}
				echo '</div>';
				echo '</div>';
			}
		}
	}

	public function multiple($config)
	{
		$config = wp_parse_args($config, array(
			'elements' => array()
		));

		foreach ($config['elements'] as $element) {
			if (method_exists($this, $element['type'])) {
				$element['default'] = array_key_exists('default', $element) ? $element['default'] : '';
				$element['value'] = $element['default'];

				$data = array('type' => $element['type']);

				if (isset($element['name'])) {
					$data['name'] = $element['name'];
					$data['selector'] = 'tcap-sc-' . $this->config['shortcode'] . '-' . $element['name'];
					$element['name'] = $data['selector'];
				}

				if (isset($element['default'])) {
					$data['default'] = $element['default'];
				}

				$wrapClasses = array('tcap-shortcode-inner-outer', 'tcap-clearfix');
				if (!empty($element['inline'])) {
					$wrapClasses[] = 'tcap-shortcode-inner-inline';
				}
				if (!empty($element['wrap_class'])) {
					$wrapClasses[] = $element['wrap_class'];
				}

				echo '<div class="' . esc_attr(tcp_sanitize_class($wrapClasses)) . '" data-config="' . esc_attr(wp_json_encode($data)) . '">';

				if (!empty($element['label'])) {
					echo '<div class="tcap-shortcode-inner-label"><div class="tcap-mini-label">' . esc_html($element['label']);

					if (!empty($element['tooltip'])) {
						echo '<span class="tcap-tip-icon">[?]<span class="tcap-tooltip-text">' . esc_html($element['tooltip']) . '</span></span>';
					}

					echo '</div></div>';
				}

				echo '<div class="tcap-shortcode-inner-inner tcap-clearfix">';

				$this->{$element['type']}($element);

				if (!empty($element['description'])) {
					echo '<p class="tcap-shortcode-inner-description">' . esc_html($element['description']) . '</p>';
				}

				echo '</div></div>';
			}
		}
	}
}