<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Metabox options generator
 */
class TcpMetaboxGenerator extends TcpOptionsGenerator
{
	protected $config;
	protected $options;
	protected $prefix;

	public function __construct($config, $options)
	{
		$this->config = $config;
		$this->options = $options;
		$this->prefix = '_tcp_';

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
					default:
						$value = sanitize_text_field($_POST[$option['name']]);
						break;
				}
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
			} else if ($value !== $oldValue) {
				update_post_meta($postId, $option['name'], $value);
			}
		}
	}

	public function render($post)
	{
		echo '<div class="tcap-meta-box-fields">';

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
					$option['value'] = tcp_get_post_meta($post->ID, $option['name'], $default);
					$option['name'] = $this->prefix . $option['name'];
				}

				$wrapClasses = array('tcap-meta-box-field-outer', 'tcap-clearfix');
				if (!empty($option['wrap_class'])) {
					$wrapClasses[] = $option['wrap_class'];
				}

				echo '<div class="' . esc_attr(tcp_sanitize_class($wrapClasses)) . '">';
				echo '<div class="tcap-meta-box-field-label"><h4>' . esc_html($option['title']) . '</h4>';

				if (!empty($option['tooltip'])) {
					echo '<span class="tcap-tooltip-wrap"><span class="tcap-tooltip-text">' . esc_html($option['tooltip']) . '</span></span>';
				}

				echo '</div>';
				echo '<div class="tcap-meta-box-field-inner tcap-clearfix">';
				$this->{$renderMethod}($option, $post);
				echo '</div>';
				if (!empty($option['description'])) {
					echo '<p class="tcap-meta-box-field-description">' . esc_html($option['description']) . '</p>';
				}
				if (!empty($option['example'])) {
					echo '<pre class="tcap-meta-box-field-example">' . esc_html($option['example']) . '</pre>';
				}
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
					$element['value'] = tcp_get_post_meta($post->ID, $element['name'], $default);
					$element['name'] = $this->prefix . $element['name'];
				}

				$wrapClasses = array('tcap-meta-multi-outer', 'tcap-clearfix');
				if ($inline) {
					$wrapClasses[] = 'tcap-meta-multi-inline';
				}
				if (!empty($element['wrap_class'])) {
					$wrapClasses[] = $element['wrap_class'];
				}

				echo '<div class="' . esc_attr(tcp_sanitize_class($wrapClasses)) . '">';
				if (!empty($element['title'])) {
					echo '<div class="tcap-meta-multi-label"><div class="tcap-meta-multi-title">' . esc_html($element['title']);

					if (!empty($element['tooltip'])) {
						echo '<span class="tcap-tip-icon">[?]<span class="tcap-tooltip-text">' . esc_html($element['tooltip']) . '</span></span>';
					}

					echo '</div></div>';
				}
				echo '<div class="tcap-meta-multi-inner tcap-clearfix">';
				$this->{$element['type']}($element, $post);
				echo '</div>';
				if (!empty($element['description'])) {
					echo '<p class="tcap-meta-multi-description">' . esc_html($element['description']) . '</p>';
				}
				echo '</div>';
			}
		}
	}
}