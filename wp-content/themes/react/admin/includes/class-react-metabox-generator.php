<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Metabox options generator
 */
class React_Metabox_Generator extends React_Options_Generator
{
	protected $config;
	protected $options;
	protected $prefix;

	public function __construct($config, $options)
	{
		$this->config = $config;
		$this->options = $options;
		$this->prefix = REACT_META_PREFIX;

		add_action('add_meta_boxes', array($this, 'add'));
		add_action('save_post', array($this, 'save'));
	}

	public function add()
	{
		if (is_callable($this->config['callback'])) {
			$callback = $this->config['callback'];
		} else {
			$callback = array($this, 'render');
		}

		foreach ((array) $this->config['types'] as $type) {
			add_meta_box($this->config['id'], $this->config['title'], $callback, $type, $this->config['context'], $this->config['priority']);
		}
	}

	public function save($postId)
	{
		// Bail if we're doing an auto save
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		// If our nonce isn't there, or we can't verify it, bail
		if (!isset($_POST["{$this->config['id']}_mb_nonce"]) || !wp_verify_nonce($_POST["{$this->config['id']}_mb_nonce"], "{$this->config['id']}_mb_save")) {
			return;
		}

		// If our current user can't edit this post, bail
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $postId)) {
				return;
			}
		} else {
			if (!current_user_can('edit_post', $postId)) {
				return;
			}
		}

		// Only save if the current post type applies to our options
		if (!in_array($_POST['post_type'], (array) $this->config['types'])) {
			return;
		}

		foreach ($this->options as $option) {
			$this->updateOption($option, $postId);
		}
	}

	private function updateOption($option, $postId)
	{
		// Skip saving the option if it doesn't apply to this post type
		if (isset($option['types']) && !in_array($_POST['post_type'], $option['types'])) {
			return;
		}

		if ($option['type'] == 'multiple') {
			foreach ($option['elements'] as $element) {
				$this->updateOption($element, $postId);
			}
			return;
		}

		if (!empty($option['name'])) {
			$option['name'] = $this->prefix . $option['name'];
			if (isset($_POST[$option['name']])) {
				$_POST[$option['name']] = stripslashes($_POST[$option['name']]);

				switch ($option['type']) {
					case 'number':
						$value = is_numeric($_POST[$option['name']]) ? absint($_POST[$option['name']]) : '';
						break;
					case 'textarea':
						$value = wp_kses_post($_POST[$option['name']]);
						break;
					case 'slider':
						$value = react_clamp(intval($_POST[$option['name']]), $option['slider']['from'], $option['slider']['to']);
						break;
					case 'toggle':
						$value = $option['default'] == true ? '' : 1;
						break;
					case 'audioupload':
						$unsafeTracks = json_decode($_POST[$option['name']], true);
						$safeTracks = array();
						$value = '';

						if (is_array($unsafeTracks)) {
							foreach ($unsafeTracks as $unsafeTrack) {
								$safeTracks[] = array(
									'id' => isset($unsafeTrack['id']) ? absint($unsafeTrack['id']) : 0,
									'name' => isset($unsafeTrack['name']) ? sanitize_text_field($unsafeTrack['name']) : '',
									'm4a' => isset($unsafeTrack['m4a']) ? sanitize_text_field($unsafeTrack['m4a']) : '',
									'mp3' => isset($unsafeTrack['mp3']) ? sanitize_text_field($unsafeTrack['mp3']) : '',
									'oga' => isset($unsafeTrack['oga']) ? sanitize_text_field($unsafeTrack['oga']) : '',
								);
							}

							if (count($safeTracks)) {
								$value = $safeTracks;
							}
						}
						break;
					case 'information':
						$unsafeInformations = json_decode($_POST[$option['name']], true);
						$safeInformations = array();
						$value = '';

						if (is_array($unsafeInformations)) {
							foreach ($unsafeInformations as $unsafeInformation) {
								$safeInformations[] = array(
									'title' => isset($unsafeInformation['title']) ? sanitize_text_field($unsafeInformation['title']) : '',
									'value' => isset($unsafeInformation['value']) ? wp_kses_post($unsafeInformation['value']) : ''
								);
							}

							if (count($safeInformations)) {
								$value = $safeInformations;
							}
						}
						break;
					default:
						$value = sanitize_text_field($_POST[$option['name']]);
						break;
				}
			} elseif ($option['type'] == 'toggle') {
				$value = $option['default'] == false ? '' : 0;
			} else {
				$value = '';
			}

			// Conditional saving to prevent saving uncessary things
			if (isset($option['dontSaveIf']) && is_array($option['dontSaveIf'])) {
				$operator = isset($option['dontSaveIfOperator']) && $option['dontSaveIfOperator'] == 'and' ? 'and' : 'or';
				$matches = 0;

				foreach ($option['dontSaveIf'] as $k => $v) {
					if (isset($_POST[$this->prefix . $k]) && in_array($_POST[$this->prefix . $k], (array) $v, true)) {
						$matches++;
					}
				}

				if (($operator == 'or' && $matches > 0) || $operator == 'and' && $matches == count($option['dontSaveIf'])) {
					$value = '';
				}
			}

			$oldValue = get_post_meta($postId, $option['name'], true);
			if ($value === '') {
				delete_post_meta($postId, $option['name'], $oldValue);
			} elseif ($value !== $oldValue) {
				update_post_meta($postId, $option['name'], $value);
			}
		}
	}

	public function render($post)
	{
		echo '<div class="react-meta-box-fields">';

		wp_nonce_field("{$this->config['id']}_mb_save", "{$this->config['id']}_mb_nonce");

		foreach ($this->options as $option) {
			$renderMethod = array_key_exists('render', $option) && method_exists($this, $option['render']) ? $option['render'] : $option['type'];

			if (isset($option['types']) && is_array($option['types']) && !in_array($post->post_type, $option['types'])) {
				// Skip this option if it doesn't apply to this post type
				continue;
			}

			if (method_exists($this, $renderMethod)) {
				if (isset($option['name'])) {
					$default = isset($option['default']) ? $option['default'] : '';
					$option['value'] = react_get_post_meta($post->ID, $option['name'], $default);
					$option['name'] = $this->prefix . $option['name'];
				}

				$wrapClasses = array('react-meta-box-field-outer', 'react-clearfix');
				if (isset($option['wrap_class'])) {
					$wrapClasses[] = $option['wrap_class'];
				}

				echo '<div class="' . esc_attr(react_sanitize_class($wrapClasses)) . '">';
				echo '<div class="react-meta-box-field-label"><h4>' . esc_html($option['title']) . '</h4>';

				if (!empty($option['tooltip'])) {
					echo '<span class="react-tooltip-wrap"><span class="react-tooltip-text">' . esc_html($option['tooltip']) . '</span></span>';
				}

				echo '</div>';
				echo '<div class="react-meta-box-field-inner react-clearfix">';
				$this->{$renderMethod}($option, $post);
				echo '</div>';
				if (!empty($option['description'])) {
					echo '<p class="react-meta-box-field-description">' . esc_html($option['description']) . '</p>';
				}
				echo '</div>';
			}

			if ($option['type'] == 'subtitle') {
				$classes = array('react-meta-box-subtitle');
				if (isset($option['class'])) {
					$classes = array_merge($classes, explode(' ', $option['class']));
				}

				echo '<div class="' . esc_attr(react_sanitize_class($classes)) . '">' . esc_html($option['title']);

				if (!empty($option['tooltip'])) {
					echo '<span class="react-tooltip-wrap"><span class="react-tooltip-text">' . esc_html($option['tooltip']) . '</span></span>';
				}

				echo '</div>';

				 if (!empty($option['description'])) {
					echo '<p class="react-meta-box-subtitle-desc">' . esc_html($option['description']) . '</p>';
				}
			}

			if ($option['type'] == 'clear') {
				echo '<div class="react-clear"></div>';
			} elseif ($option['type'] == 'custom_toggle') {
				echo '<div id="' . esc_attr($option['id']) . '" class="react-custom-toggle"><span></span>' . esc_html($option['content']) . '</div>';
			} elseif ($option['type'] == 'div') {
				echo '<div class="' . esc_attr(react_sanitize_class($option['class'])) . '">' . esc_html($option['content']) . '</div>';
			} elseif ($option['type'] == 'div_open') {
				echo '<div class="' . esc_attr(react_sanitize_class($option['class'])) . '">';
			} elseif ($option['type'] == 'div_close') {
				echo '</div>';
			}
		}

		echo '</div>';
	}

	public function multiple($config, $post)
	{
		$config = wp_parse_args($config, array(
			'elements' => array()
		));

		foreach ($config['elements'] as $element) {
			$inline = isset($element['inline']) && $element['inline'];

			if (isset($element['type']) && method_exists($this, $element['type'])) {
				if (isset($element['name'])) {
					$default = isset($element['default']) ? $element['default'] : '';
					$element['value'] = react_get_post_meta($post->ID, $element['name'], $default);
					$element['name'] = $this->prefix . $element['name'];
				}

				$wrapClasses = array('react-meta-multi-outer', 'react-clearfix');
				if ($inline) {
					$wrapClasses[] = 'react-meta-multi-inline';
				}
				if (isset($element['wrap_class'])) {
					$wrapClasses[] = $element['wrap_class'];
				}

				echo '<div class="' . esc_attr(react_sanitize_class($wrapClasses)) . '">';
				if (isset($element['title']) && $element['title']) {
					echo '<div class="react-meta-multi-label"><div class="react-meta-multi-title">' . esc_html($element['title']);

					if (!empty($element['tooltip'])) {
						echo '<span class="react-tip-icon">[?]<span class="react-tooltip-text">' . esc_html($element['tooltip']) . '</span></span>';
					}

					echo '</div></div>';
				}
				echo '<div class="react-meta-multi-inner react-clearfix">';
				$this->{$element['type']}($element, $post);
				echo '</div>';
				if (!empty($element['description'])) {
					echo '<p class="react-meta-multi-description">' . esc_html($element['description']) . '</p>';
				}
				echo '</div>';
			}

			if ($element['type'] == 'subtitle') {
				$classes = array('react-meta-multi-subtitle');
				if (isset($element['class'])) {
					$classes = explode(' ', $element['class']);
				}

				echo '<div class="' . esc_attr(react_sanitize_class($classes)) . '">' . esc_html($element['title']) . '</div>';
				if (!empty($element['description'])) {
					echo '<p class="react-meta-multi-subtitle-desc">' . esc_html($element['description']) . '</p>';
				}
			}

			if ($element['type'] == 'clear') {
				echo '<div class="react-clear"></div>';
			} elseif ($element['type'] == 'div') {
				echo '<div class="' . esc_attr(react_sanitize_class($element['class'])) . '">' . esc_html($element['content']) . '</div>';
			} elseif ($element['type'] == 'div_open') {
				echo '<div class="' . esc_attr(react_sanitize_class($element['class'])) . '">';
			} elseif ($element['type'] == 'div_close') {
				echo '</div>';
			} elseif ($element['type'] == 'accordion_open') {
				echo '<div class="react-accordion react-toggle">';
				echo '<div class="react-accordion-trigger">' . esc_html($element['content']) . '</div>';
				echo '<div class="react-accordion-content">';
			} elseif ($element['type'] == 'accordion_close') {
				echo '</div></div>';
			}
		}
	}

	public function holder($config, $post)
	{
		$config = wp_parse_args($config, array(
			'key' => '',
			'inline' => false
		));

		echo '<div id="react-' . esc_attr($config['key']) . '-holder"' . ' class="react-upload-holder' . ($config['inline'] ? ' react-meta-multi-inline' : '') . '">' . react_get_upload_thumbnail(react_get_post_meta($post->ID, $config['key'])) . '</div>';
	}
}