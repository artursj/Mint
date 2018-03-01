<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Generates the HTML for options
 */
class React_Options_Generator
{
	public function select($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'options' => array()
		));

		$classes = array('react-option-select');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<select id="' . esc_attr($config['name']) . '" name="' . esc_attr($config['name']) . '" class="' . esc_attr(react_sanitize_class($classes)) . '">';
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

		$classes = array('react-option-select');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<select id="' . esc_attr($config['name']) . '" name="' . esc_attr($config['name']) . '" class="' . esc_attr(react_sanitize_class($classes)) . '" multiple="multiple">';
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

		$classes = array('react-option-text');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<input type="text" name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '" value="' . esc_attr($config['value']) . '"  class="' . esc_attr(react_sanitize_class($classes)) . '" ' . ($config['placeholder'] ? ' placeholder="' . esc_attr($config['placeholder']) . '" ' : '') . '>';
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

		$classes = array('react-option-text');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<input type="text" name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '" value="' . esc_attr($config['value']) . '"  class="' . esc_attr(react_sanitize_class($classes)) . '" ' . ($config['placeholder'] ? ' placeholder="' . esc_attr($config['placeholder']) . '" ' : '') . '>';

		if (!empty($config['unit'])) {
			echo '<span class="tcap-range-unit">' . esc_html($config['unit']) . '</span>';
		}
	}

	public function text_upload($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'placeholder' => '',
			'id' => ''
		));

		$classes = array('react-option-text');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<input type="text" name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '" value="' . esc_attr($config['value']) . '"  class="' . esc_attr(react_sanitize_class($classes)) . '" ' . ($config['placeholder'] ? ' placeholder="' . esc_attr($config['placeholder']) . '" ' : '') . '>';
		echo '<div class="react-upload-logo-button-wrap react-clearfix"><div id="' . esc_attr($config['id']) . '" class="react-media-button">' . esc_html__('Browse', 'react') . '</div></div>';
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

		echo '<input type="hidden" name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '" value="' . esc_attr($config['value']) . '"  class="' . esc_attr(react_sanitize_class($classes)) . '">';
	}

	public function slider($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'class' => '',
			'slider' => array()
		));

		$classes = array('react-option-text react-range-slider react-width-50');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<input type="text"
					 name="' . esc_attr($config['name']) . '"
					 id="' . esc_attr($config['name']) . '"
					 value="' . esc_attr($config['value']) . '"
					 class="' . esc_attr(react_sanitize_class($classes)) . '"
					 data-from="' . esc_attr($config['slider']['from']) . '"
					 data-to="' . esc_attr($config['slider']['to']) . '"
					 data-step="' . esc_attr($config['slider']['step']) . '"
					 data-dimension="' . esc_attr($config['slider']['dimension']) . '"
		   ><span class="react-range-unit">' . esc_html($config['slider']['dimension']) . '</span>' ;
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

		$classes = array('react-option-textarea');
		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<textarea name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '" class="' . esc_attr(react_sanitize_class($classes)) . '" rows="' . esc_attr($config['rows']) . '" cols="' . esc_attr($config['cols']) . '">' . esc_textarea($config['value']) . '</textarea>';
	}

	public function audioupload($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => array(),
			'class' => ''
		));
		?>
		<div class="react-add-audio-track-button-wrap react-clearfix">
			<div id="react-add-audio-track-button" class="react-button react-orange react-add"><span></span><?php esc_html_e('Add Music Track', 'react'); ?></div>
		</div>
		<div id="react-audio-tracks" class="react-clearfix">
			<?php
				foreach ($config['value'] as $track) {
					echo react_get_background_audio_html($track);
				}
			?>
		</div>
		<div class="react-hidden"><textarea name="<?php echo esc_attr($config['name']); ?>" id="<?php echo esc_attr($config['name']); ?>"><?php echo esc_textarea(wp_json_encode($config['value'])); ?></textarea></div>
		<?php
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
			$classes = array('react-option-toggle-yn');
		} else {
			$classes = array('react-option-toggle');
		}

		if (!empty($config['class'])) {
			$classes[] = $config['class'];
		}

		echo '<input type="checkbox" class="' . esc_attr(react_sanitize_class($classes)) . '" name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '" value="1" ' . checked($config['value'], 1, false) . '>';
	}

	public function tritoggle($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'toggle' => ''
		));

		if ($config['toggle'] == 'yn') {
			$classes = array('react-option-tritoggle-yn');
		} else {
			$classes = array('react-option-tritoggle');
		}

		$config['class'] = join(' ', $classes);

		$config['options'] = array(
			'1' => esc_html__('On', 'react'),
			'' => esc_html__('Default', 'react'),
			'0' => esc_html__('Off', 'react')
		);

		$this->select($config);
	}

	public function icon($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => '',
			'subset' => ''
		));

		echo react_icon_selector_field($config['value'], $config['name'], $config['name'], $config['subset']);
	}

	/**
	 * Portfolio item information
	 */
	public function information($config)
	{
		$config = wp_parse_args($config, array(
			'name' => '',
			'value' => array()
		));

		echo '<div class="react-information-wrap react-clearfix">';
		echo '<div class="react-clearfix"><div class="react-button react-orange react-add"><span></span>' . esc_html__('Add', 'react') . '</div></div>';
		echo '<div class="react-clearfix react-information-holder">';

		if (is_array($config['value'])) {
			foreach ($config['value'] as $information) {
				echo self::getInformationHtml($information);
			}
		}

		echo '</div>';
		echo '<div class="react-hidden"><textarea name="' . esc_attr($config['name']) . '" id="' . esc_attr($config['name']) . '">' . esc_textarea(wp_json_encode($config['value'])) . '</textarea></div>';
		echo '</div>';
	}

	public static function getInformationHtml($information = array())
	{
		if ( ! isset($information['title'])) {
			$information['title'] = '';
		}

		if ( ! isset($information['value'])) {
			$information['value'] = '';
		}

		$output = '<div class="react-information react-clearfix">';
		$output .= '<input class="react-information-title" type="text" placeholder="' . esc_attr__('Title', 'quform') . '" value="' . esc_attr($information['title']) . '">';
		$output .= '<textarea class="react-information-value" placeholder="' . esc_attr__('Value', 'quform') . '">' . esc_textarea($information['value']) . '</textarea>';
		$output .= '<span class="react-information-remove"></span>';
		$output .= '</div>';

		return $output;
	}
}