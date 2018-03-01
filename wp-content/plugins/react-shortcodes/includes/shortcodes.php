<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 *  COLUMN LAYOUTS
 */
function tcs_shortcode_row($atts, $content = '')
{
	extract(shortcode_atts(array(
		'padding' => '1',
		'padding_top' => '-1',
		'padding_bottom' => '-1',
		'gaps' => '0',
		'borderl' => '0',
		'borderb' => '0',
		'class' => '',
		'min_height' => '',
		'vertical_gap' => '0',
		'convert' => 'mobile-width-100',
		'hide' => ''
	), $atts));

	$classes[] = 'tcs-units-row';

	if ($hide) {
		$classes[] = tcs_get_hide_class($hide);
	}

	if ($padding == '1') {
		$classes[] = 'tcs-units-padding';

		if ($padding_top != '-1') {
			if (!isset($GLOBALS['tcs_col_padding_top'])) {
				$GLOBALS['tcs_col_padding_top'] = array();
			}
			$GLOBALS['tcs_col_padding_top'][] = 'padding-top:' . tcs_get_css_value($padding_top) . ';';
		}

		if ($padding_bottom != '-1') {
			if (!isset($GLOBALS['tcs_col_padding_bottom'])) {
				$GLOBALS['tcs_col_padding_bottom'] = array();
			}
			$GLOBALS['tcs_col_padding_bottom'][] = 'padding-bottom:' . tcs_get_css_value($padding_bottom) . ';';
		}
	}

	if ($gaps == '0') {
		$classes[] = 'tcs-units-split';
	}

	if ($borderl == '1') {
		$classes[] = 'tcs-border-left';
	}

	if ($borderb == '1') {
		$classes[] = 'tcs-border-bottom';
	}

	if ($vertical_gap == '1') {
		$classes[] = 'tcs-no-bottom-margin';
	}

	if ($convert) {
		$classes[] = tcs_prefix_classes($convert);
	}

	if ($min_height) {
		if (!isset($GLOBALS['tcs_col_minheight'])) {
			$GLOBALS['tcs_col_minheight'] = array();
		}
		$GLOBALS['tcs_col_minheight'][] = 'min-height:' . tcs_get_css_value($min_height) . ';';
	}

	if ($class) {
		$classes[] = $class;
	}

	$output = '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '">' . do_shortcode($content) . '</div>';

	if ($min_height) {
		array_pop($GLOBALS['tcs_col_minheight']);
	}

	if ($padding == '1') {
		if ($padding_bottom != '-1') {
			array_pop($GLOBALS['tcs_col_padding_bottom']);
		}
		if ($padding_top != '-1') {
			array_pop($GLOBALS['tcs_col_padding_top']);
		}
	}

	return $output;
}
add_shortcode('row', 'tcs_shortcode_row');
// Nested row support
foreach (range(1, 5) as $n) {
	add_shortcode('row' . $n, 'tcs_shortcode_row');
}

function tcs_render_shortcode_row_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Layout options', 'react-shortcodes'),
			'shortcode' => 'row'
		),
		'options' => array(
			array(
				'name' => 'padding',
				'label' => esc_html__('Padding', 'react-shortcodes'),
				'tooltip' => esc_html__('Adds a small amount of padding inside each column', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '1'
			),
			array(
				'name' => 'padding_top',
				'label' => esc_html__('Top padding', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '-1',
				'slider' => array('from' => -1, 'to' => 500, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'padding_bottom',
				'label' => esc_html__('Bottom padding', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '-1',
				'slider' => array('from' => -1, 'to' => 500, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'gaps',
				'label' => esc_html__('Gaps', 'react-shortcodes'),
				'tooltip' => esc_html__('Adds a gap between each column', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'borderl',
				'label' => esc_html__('Border left', 'react-shortcodes'),
				'tooltip' => esc_html__('Adds a border between each column', 'react-shortcodes'),
				'description' => esc_html__('Not recommended when Gaps is On', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'borderb',
				'label' => esc_html__('Border bottom', 'react-shortcodes'),
				'tooltip' => esc_html__('Adds a border between each column', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'vertical_gap',
				'label' => esc_html__('Remove bottom margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Remove bottom margin', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'min_height',
				'label' => esc_html__('Minimum height', 'react-shortcodes'),
				'tooltip' => esc_html__('Makes all columns starting height equal', 'react-shortcodes'),
				'description' => esc_html__('The CSS min-height of the columns, e.g. 200px or 25%.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-75',
				'optional' => true
			),
			array(
				'name' => 'class',
				'label' => esc_html__('Additional class(es)', 'react-shortcodes'),
				'tooltip' => esc_html__('Adds a custom class to the layout wrapper', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-150',
				'optional' => true
			),
			array(
				'name' => 'convert',
				'label' => esc_html__('Convert to full width', 'react-shortcodes'),
				'tooltip' => esc_html__('At which screen size should the column layout adjust to full width', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'mobile-width-100',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'phone-width-100' => esc_html__('Phone 1 column', 'react-shortcodes'),
					'units-phone-50' => esc_html__('Phone 2 columns', 'react-shortcodes'),
					'mobile-width-100' => esc_html__('Tablet and phone 1 column', 'react-shortcodes'),
					'units-mobile-50' => esc_html__('Tablet and phone 2 columns', 'react-shortcodes'),
					'units-tablet-50 phone-width-100' => esc_html__('Tablet 2 columns, phone 1 column', 'react-shortcodes')
				)
			),
			array(
				'name' => 'hide',
				'label' => esc_html__('Hide on device(s)', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose to hide this shortcode on device(s)', 'react-shortcodes'),
				'type' => 'multiselect',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'hide-phone-ptr' => esc_html__('Phone portrait', 'react-shortcodes'),
					'hide-phone' => esc_html__('Phone landscape', 'react-shortcodes'),
					'hide-tablet-ptr' => esc_html__('Tablet portrait', 'react-shortcodes'),
					'hide-tablet' => esc_html__('Tablet landscape', 'react-shortcodes'),
					'hide-desktop' => esc_html__('Desktop', 'react-shortcodes'),
					'hide-large' => esc_html__('Large', 'react-shortcodes')
				)
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

function tcs_shortcode_col($atts, $content = '')
{
	extract(shortcode_atts(array(
		'width' => '25',
		'class' => ''
	), $atts));

	$classes = array(tcs_prefix_classes('unit-' . $width));

	if ($class) {
		$classes[] = $class;
	}

	$styles = array();

	if (isset($GLOBALS['tcs_col_minheight'])) {
		$styles[] = end($GLOBALS['tcs_col_minheight']);
	}
	if (isset($GLOBALS['tcs_col_padding_bottom'])) {
		$styles[] = end($GLOBALS['tcs_col_padding_bottom']);
	}
	if (isset($GLOBALS['tcs_col_padding_top'])) {
		$styles[] = end($GLOBALS['tcs_col_padding_top']);
	}

	return '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '"' . (count($styles) ? ' style="' . esc_attr(join(' ', $styles)) . '"' : '') . '>' . do_shortcode($content) . '</div>';
}
add_shortcode('col', 'tcs_shortcode_col');
// Nested column support
foreach (range(1, 5) as $n) {
	add_shortcode('col' . $n, 'tcs_shortcode_col');
}

/**
 *  BLOCKQUOTE
 */
function tcs_shortcode_blockquote($atts, $content = '')
{
	extract(shortcode_atts(array(
		'cite' => '',
		'citelink' => '',
		'margin_top' => '',
		'margin_bottom' => ''
	), $atts));

	$styles = array();

	if ($margin_top !== '') {
		$styles[] = 'margin-top:' . tcs_get_css_value($margin_top) . ';';
	}

	if ($margin_bottom !== '') {
		$styles[] = 'margin-bottom:' . tcs_get_css_value($margin_bottom) . ';';
	}

	if ($cite) {
		$cite = $citelink ? '<a href="' . esc_url($citelink) . '" target="_blank">' . esc_html($cite) . '</a>' : esc_html($cite);
		$cite = '<div class="tcs-cite">&ndash; ' . $cite . '</div>';
	}

	return '<blockquote class="tcs-blockquote"' . (count($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') . '><div class="tcs-blockquote-inner"><i class="tcs-qmark fa fa-quote-left"></i> ' . do_shortcode($content) . '</div>' . $cite . '</blockquote>';
}
add_shortcode('blockquote', 'tcs_shortcode_blockquote');

function tcs_render_shortcode_blockquote_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Blockquote options', 'react-shortcodes'),
			'shortcode' => 'blockquote'
		),
		'options' => array(
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Quote', 'react-shortcodes'),
				'type' => 'textarea',
				'default' => ''
			),
			array(
				'name' => 'cite',
				'label' => esc_html__('Cite', 'react-shortcodes'),
				'tooltip' => esc_html__('Cite is the reference to the source', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-150',
				'optional' => true
			),
			array(
				'name' => 'citelink',
				'label' => esc_html__('Cite URL', 'react-shortcodes'),
				'tooltip' => esc_html__('Add a link to the source, including http://', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-150',
				'optional' => true
			),
			array(
				'name' => 'margin_top',
				'label' => esc_html__('Top margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => -100, 'to' => 800, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'margin_bottom',
				'label' => esc_html__('Bottom margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => -100, 'to' => 800, 'step' => 1, 'dimension' => 'px')
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  PULLQUOTE
 */
function tcs_shortcode_pullquote($atts, $content = '')
{
	extract(shortcode_atts(array(
		'align' => 'left',
		'width' => '',
		'convert' => 'cvt-phone-ldsp',
		'cite' => '',
		'citelink' => ''
	), $atts));

	if ($cite) {
		$cite = $citelink ? '<a href="' . esc_url($citelink) . '" target="_blank">' . esc_html($cite) . '</a>' : esc_html($cite);
		$cite = '<div class="tcs-cite">&ndash; ' . $cite . '</div>';
	}

	$classes = array('tcs-pullquote');

	if ($convert) {
		$classes[] = tcs_prefix_classes($convert);
	}

	if ($align) {
		$classes[] = tcs_prefix_classes('align-' . $align);
	}

	return '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '"' . ($width !== '' ? ' style="width:' . esc_attr(tcs_get_css_value($width)) . ';"' : '') . '><i class="tcs-qmark fa fa-quote-left"></i>' . do_shortcode($content) . $cite . '</div>';
}
add_shortcode('pullquote', 'tcs_shortcode_pullquote');

function tcs_render_shortcode_pullquote_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Pullquote options', 'react-shortcodes'),
			'shortcode' => 'pullquote'
		),
		'options' => array(
			array(
				'name' => 'align',
				'label' => esc_html__('Alignment', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose how the quote is aligned within the content.', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'left',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'left' => esc_html__('Left', 'react-shortcodes'),
					'center' => esc_html__('Center', 'react-shortcodes'),
					'right' => esc_html__('Right', 'react-shortcodes')
				)
			),
			array(
				'name' => 'width',
				'label' => esc_html__('Width', 'react-shortcodes'),
				'description' => esc_html__('The CSS width of the pullquote, e.g. 200px or 25%.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-50'
			),
			array(
				'name' => 'convert',
				'label' => esc_html__('Convert to fullwidth', 'react-shortcodes'),
				'tooltip' => esc_html__('At which screen size to swap layout to fullwidth', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'cvt-phone-ldsp',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'cvt-phone-ptr' => esc_html__('Phone Portrait', 'react-shortcodes'),
					'cvt-phone-ldsp' => esc_html__('Phone Landscape', 'react-shortcodes'),
					'cvt-tablet-ptr' => esc_html__('Tablet Portrait', 'react-shortcodes'),
					'cvt-tablet-ldsp' => esc_html__('Tablet Landscape', 'react-shortcodes')
				)
			),
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Quote', 'react-shortcodes'),
				'type' => 'textarea',
				'default' => ''
			),
			array(
				'name' => 'cite',
				'label' => esc_html__('Cite', 'react-shortcodes'),
				'tooltip' => esc_html__('Cite is the reference to the source', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-150',
				'optional' => true
			),
			array(
				'name' => 'citelink',
				'label' => esc_html__('Cite URL', 'react-shortcodes'),
				'tooltip' => esc_html__('Add a link to the source, including http://', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-150',
				'optional' => true
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  BOX
 */
function tcs_shortcode_box($atts, $content = '')
{
	extract(shortcode_atts(array(
		'type' => 'basic',
		'animation' => '',
		'animation_delay' => '',
		'animation_offset' => '',
		'align' => '',
		'text_align' => '',
		'width' => '',
		'convert' => 'cvt-phone-ldsp',
		'hide' => ''
	), $atts));

	$classes = array('tcs-box');

	if ($text_align) {
		$classes[] = tcs_prefix_classes($text_align);
	}

	if ($align) {
		$classes[] = tcs_prefix_classes('align-' . $align);
	}

	if ($type) {
		$classes[] = tcs_prefix_classes('box-' . $type);
	}

	if ($convert) {
		$classes[] = tcs_prefix_classes($convert);
	}

	if ($animation && function_exists('react_get_animation_data')) {
		$classes[] = react_get_animation_class($animation);
		$animationData = react_get_animation_data($animation, $animation_delay, $animation_offset);
	}

	if ($hide) {
		$classes[] = tcs_get_hide_class($hide);
	}

	return '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '"' . ($width !== '' ? ' style="width:' . esc_attr(tcs_get_css_value($width)) . ';"' : '') . (isset($animationData) ? ' ' . $animationData : '') . '><div class="tcs-box-inner">' . do_shortcode($content) . '</div></div>';
}
add_shortcode('box', 'tcs_shortcode_box');

function tcs_render_shortcode_box_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Box options', 'react-shortcodes'),
			'shortcode' => 'box'
		),
		'options' => array(
			array(
				'name' => 'type',
				'label' => esc_html__('Type', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a style', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'basic',
				'options' => array(
					'blank' => esc_html__('Blank', 'react-shortcodes'),
					'custom-boxed-item' => esc_html__('Background blend', 'react-shortcodes'),
					'basic' => esc_html__('Primary color', 'react-shortcodes'),
					'basic-light' => esc_html__('Light color', 'react-shortcodes'),
					'basic-dark' => esc_html__('Dark color', 'react-shortcodes'),
					'info' => esc_html__('Information', 'react-shortcodes'),
					'warning' => esc_html__('Warning', 'react-shortcodes'),
					'error' => esc_html__('Error', 'react-shortcodes'),
					'success' => esc_html__('Success', 'react-shortcodes')
				)
			),
			tcs_get_extended_animation_options(),
			array(
				'name' => 'align',
				'label' => esc_html__('Alignment', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'left' => esc_html__('Left', 'react-shortcodes'),
					'center' => esc_html__('Center', 'react-shortcodes'),
					'right' => esc_html__('Right', 'react-shortcodes')
				)
			),
			array(
				'name' => 'text_align',
				'label' => esc_html__('Text align', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Inherit', 'react-shortcodes'),
					'textleft' => esc_html__('Left', 'react-shortcodes'),
					'textcenter' => esc_html__('Center', 'react-shortcodes'),
					'textright' => esc_html__('Right', 'react-shortcodes')
				)
			),
			array(
				'name' => 'width',
				'label' => esc_html__('Width', 'react-shortcodes'),
				'description' => esc_html__('The CSS width of the box, e.g. 200px or 25%.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-50'
			),
			array(
				'name' => 'convert',
				'label' => esc_html__('Convert to fullwidth', 'react-shortcodes'),
				'tooltip' => esc_html__('At which screen size to swap layout to fullwidth', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'cvt-phone-ldsp',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'cvt-phone-ptr' => esc_html__('Phone Portrait', 'react-shortcodes'),
					'cvt-phone-ldsp' => esc_html__('Phone Landscape', 'react-shortcodes'),
					'cvt-tablet-ptr' => esc_html__('Tablet Portrait', 'react-shortcodes'),
					'cvt-tablet-ldsp' => esc_html__('Tablet Landscape', 'react-shortcodes')
				)
			),
			array(
				'name' => 'hide',
				'label' => esc_html__('Hide on device(s)', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose to hide this shortcode on device(s)', 'react-shortcodes'),
				'type' => 'multiselect',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'hide-phone-ptr' => esc_html__('Phone portrait', 'react-shortcodes'),
					'hide-phone' => esc_html__('Phone landscape', 'react-shortcodes'),
					'hide-tablet-ptr' => esc_html__('Tablet portrait', 'react-shortcodes'),
					'hide-tablet' => esc_html__('Tablet landscape', 'react-shortcodes'),
					'hide-desktop' => esc_html__('Desktop', 'react-shortcodes'),
					'hide-large' => esc_html__('Large', 'react-shortcodes')
				)
			),
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Message', 'react-shortcodes'),
				'type' => 'textarea',
				'default' => ''
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  BUTTON
 */
function tcs_shortcode_button($atts, $content = '')
{
	extract(shortcode_atts(array(
		'id' => '',
		'color' => 'style-prime blank-btn',
		'gradient' => '0',
		'size' => 'small',
		'radius' => '',
		'text_align' => 'textcenter',
		'palette' => '',
		'animation' => '',
		'animation_delay' => '',
		'animation_offset' => '',
		'hover_animation' => '',
		'background_animation' => '',
		'position' => '',
		'custom_margin' => '0',
		'margin_top' => '0',
		'margin_bottom' => '0',
		'margin_left' => '0',
		'margin_right' => '0',
		'convert' => 'cvt-phone-ptr',
		'hide' => '',
		'popup' => '0',
		'href' => '',
		'class' => '',
		'icon' => '',
		'icon_location' => 'ico-abso i-left',
		'icon_reveal' => '0',
		'icon_style' => 'lgt'
	), $atts));

	$outerClasses = array('tcs-button');
	$classes = array(
		tcs_prefix_classes($text_align),
		'tcs-r-button'
	);

	if ($custom_margin == '1') {
		if (!is_numeric($margin_top)) {
			$margin_top = 0;
		}
		if (!is_numeric($margin_right)) {
			$margin_right = 0;
		}
		if (!is_numeric($margin_bottom)) {
			$margin_bottom = 0;
		}
		if (!is_numeric($margin_left)) {
			$margin_left = 0;
		}

		$styles[] = 'margin:' . $margin_top .'px ' . $margin_right .'px ' . $margin_bottom .'px ' . $margin_left .'px;';
	}

	if ($class) {
		$classes[] = $class;
	}

	if ($radius) {
		$outerClasses[] = tcs_prefix_classes($radius);
	}

	if ($icon_location) {
		$outerClasses[] = tcs_prefix_classes($icon_location);
	}

	if ($position) {
		$outerClasses[] = tcs_prefix_classes($position);
	}

	if ($convert) {
		$outerClasses[] = tcs_prefix_classes($convert);;
	}

	if ($size) {
		$outerClasses[] = tcs_prefix_classes($size);
	}

	if ($gradient == '1') {
		$outerClasses[] = 'tcs-gradient';
	}

	if ($color) {
		$outerClasses[] = tcs_prefix_classes($color);
	}

	if ($animation && function_exists('react_get_animation_data')) {
		$outerClasses[] = react_get_animation_class($animation);
		$animationData = ' ' . react_get_animation_data($animation, $animation_delay, $animation_offset);
	}

	if ($hover_animation) {
		$classes[] = $hover_animation;
	}

	if ($background_animation) {
		if ($color == 'hollow-prime holw-btn' || $color == 'hollow-light holw-btn' || $color == 'hollow-dark holw-btn') {
			$classes[] = 'tcs-has-back-animation';
			$classes[] = $background_animation;
		}
	}

	if ($href === '') {
		$tag = 'span';
	} else {
		$tag = 'a';
	}

	if ($hide) {
		$outerClasses[] = tcs_get_hide_class($hide);
	}

	if ($icon) {
		$icon = '<i class="' . esc_attr(tcs_sanitize_class(tcs_get_icon_classes($icon, 'sml', $icon_style))) . '"> </i>';
		$outerClasses[] = 'tcs-has-icon';
		if ($icon_reveal) {
			$outerClasses[] = 'tcs-icon-reveal';
		}
	}

	$content = do_shortcode($content);

	global $tcsButtonDrop;
	if (isset($tcsButtonDrop)) {
		$buttonDrop = $tcsButtonDrop;
		unset($GLOBALS['tcsButtonDrop']);
	} else {
		$buttonDrop = '';
	}

	$outerClasses[] = $buttonDrop != '' ? 'tcs-has-drop' : 'tcs-no-drop';

	if ($palette !== '' && $buttonDrop != '') {
		$dropPalette = "custom-palette-$palette";
	} else {
		$dropPalette = 'tcs-no-palette';
	}

	if ($icon) {
		if ($icon_location == 'ico-inline i-after') {
			$output = $content . $icon;
		} else {
			$output = $icon . $content;
		}
	} else {
		$output = $content;
	}

	$output = '<div' .
				(!empty($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') .
				(count($outerClasses) ? ' class="' . esc_attr(tcs_sanitize_class($outerClasses)) . '"' : '') .
				(isset($animationData) ? ' ' . $animationData : '') .
			  '>' .
			  '<' . esc_attr($tag) .
				(!empty($href) ? ' href="' . esc_url($href) . '"' . ($popup == '1' ? ' target="_blank"' : '') : '') .
				(count($classes) ? ' class="' . esc_attr(tcs_sanitize_class($classes)) . '"' : '') .
				($id ? ' id="' . esc_attr($id) . '"' : '') .
			  '>' . $output;

	if ($buttonDrop) {
		 $output .= '<span class="tcs-open-drop-trigger"><i class="fa fa-angle-down"></i></span></' . esc_attr($tag) . '><div class="tcs-drop-content ' . $dropPalette . '"><span class="tcs-drop-close">x</span>' . $buttonDrop . '</div>';
	} else {
		 $output .= '</' . esc_attr($tag) . '>';
	}

	$output .= '</div>';

	if ($position == 'center') {
		$output = '<div class="tcs-button-center-wrap">' . $output . '</div>';
	}

	return $output;
}
add_shortcode('button', 'tcs_shortcode_button');

/**
 * Handle the separate [button_drop] shortcode
 */
function tcs_shortcode_button_drop($atts, $content = '')
{
	global $tcsButtonDrop;

	$tcsButtonDrop = do_shortcode($content);
}
add_shortcode('button_drop', 'tcs_shortcode_button_drop');

function tcs_render_shortcode_button_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Button options', 'react-shortcodes'),
			'shortcode' => 'button',
		),
		'options' => array(
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Button text', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			),
			array(
				'name' => 'button_drop',
				'label' => esc_html__('Button dropbox content', 'react-shortcodes'),
				'tooltip' => esc_html__('Add a dropdown box with extra content related to your button', 'react-shortcodes'),
				'type' => 'textarea',
				'default' => ''
			),
			tcs_get_custom_palette_options('palette', esc_html__('Drop down color palette', 'react-shortcodes'), esc_html__('Choose a color palette. You can create these at Theme Options &rarr; Design &rarr; Colors', 'react-shortcodes')),
			tcs_get_hover_animation_options(),
			tcs_get_extended_animation_options(),
			array(
				'name' => 'size',
				'label' => esc_html__('Size', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a size', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'small',
				'options' => array(
					'tiny' => esc_html__('Tiny', 'react-shortcodes'),
					'small' => esc_html__('Small', 'react-shortcodes'),
					'med' => esc_html__('Medium', 'react-shortcodes'),
					'large' => esc_html__('Large', 'react-shortcodes'),
					'full' => esc_html__('Full small (use all width)', 'react-shortcodes'),
					'full med' => esc_html__('Full medium (use all width)', 'react-shortcodes'),
					'full large' => esc_html__('Full large (use all width)', 'react-shortcodes')
				)
			),
			array(
				'name' => 'radius',
				'label' => esc_html__('Corner radius', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Default', 'react-shortcodes'),
					'big-corners' => esc_html__('Rounded', 'react-shortcodes'),
					'no-corners' => esc_html__('Square', 'react-shortcodes')
				)
			),
			array(
				'name' => 'text_align',
				'label' => esc_html__('Text align', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'textcenter',
				'options' => array(
					'textleft' => esc_html__('Left', 'react-shortcodes'),
					'textcenter' => esc_html__('Center', 'react-shortcodes'),
					'textright' => esc_html__('Right', 'react-shortcodes')
				)
			),
			array(
				'name' => 'position',
				'label' => esc_html__('Position', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose the position of the button within the container', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'left' => esc_html__('Left', 'react-shortcodes'),
					'center' => esc_html__('Center', 'react-shortcodes'),
					'right' => esc_html__('Right', 'react-shortcodes')
				)
			),
			array(
				'name' => 'custom_margin',
				'label' => esc_html__('Custom margin', 'react-shortcodes'),
				'description' => esc_html__('You can override the default margins with your own values.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Margin', 'react-shortcodes'),
				'description' => esc_html__('The CSS margin values of the button in pixels.', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'margin_top',
						'label' => esc_html__('Top', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'margin_right',
						'label' => esc_html__('Right', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'margin_bottom',
						'label' => esc_html__('Bottom', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'margin_left',
						'label' => esc_html__('Left', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-60',
						'inline' => true
					)
				)
			),
			array(
				'name' => 'gradient',
				'label' => esc_html__('Gradient', 'react-shortcodes'),
				'tooltip' => esc_html__('Add gradient style (CSS3)', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'convert',
				'label' => esc_html__('Convert point', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a style', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'cvt-phone-ptr',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'cvt-phone-ptr' => esc_html__('Phone Portrait', 'react-shortcodes'),
					'cvt-phone-ldsp' => esc_html__('Phone Landscape', 'react-shortcodes'),
					'cvt-tablet-ptr' => esc_html__('Tablet Portrait', 'react-shortcodes'),
					'cvt-tablet-ldsp' => esc_html__('Tablet Landscape', 'react-shortcodes')
				)
			),
			array(
				'name' => 'hide',
				'label' => esc_html__('Hide on device(s)', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose to hide this shortcode on device(s)', 'react-shortcodes'),
				'type' => 'multiselect',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'hide-phone-ptr' => esc_html__('Phone portrait', 'react-shortcodes'),
					'hide-phone' => esc_html__('Phone landscape', 'react-shortcodes'),
					'hide-tablet-ptr' => esc_html__('Tablet portrait', 'react-shortcodes'),
					'hide-tablet' => esc_html__('Tablet landscape', 'react-shortcodes'),
					'hide-desktop' => esc_html__('Desktop', 'react-shortcodes'),
					'hide-large' => esc_html__('Large', 'react-shortcodes')
				)
			),
			array(
				'name' => 'href',
				'label' => esc_html__('Link URL', 'react-shortcodes'),
				'type' => 'text'
			),
			array(
				'name' => 'class',
				'label' => esc_html__('Additional classes', 'react-shortcodes'),
				'tooltip' => esc_html__('Add any additional class names to the button', 'react-shortcodes'),
				'type' => 'text',
				'optional' => true
			),
			array(
				'name' => 'popup',
				'label' => esc_html__('Open link in new tab/window', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'icon',
				'label' => esc_html__('Icon', 'react-shortcodes'),
				'type' => 'icon',
				'default' => ''
			),
			array(
				'name' => 'icon_location',
				'label' => esc_html__('Icon location', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a location for the icon', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'ico-abso i-left',
				'options' => array(
					'ico-abso i-left' => esc_html__('Fixed left', 'react-shortcodes'),
					'ico-abso i-right' => esc_html__('Fixed right', 'react-shortcodes'),
					'ico-inline i-after' => esc_html__('After text', 'react-shortcodes'),
					'ico-inline i-before' => esc_html__('Before text', 'react-shortcodes'),
					'ico-above' => esc_html__('Above text', 'react-shortcodes')
				)
			),
			array(
				'name' => 'icon_style',
				'label' => esc_html__('Icon style', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a light or dark style for the image icon', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'lgt',
				'options' => array(
					'lgt' => esc_html__('Light', 'react-shortcodes'),
					'drk' => esc_html__('Dark', 'react-shortcodes')
				),
				'class' => 'tcas-icon-style_image'
			),
			array(
				'name' => 'icon_reveal',
				'label' => esc_html__('Reveal icon on hover', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'color',
				'label' => esc_html__('Color / style', 'react-shortcodes'),
				'tooltip' => esc_html__('3 styles with 3 theme colors and 4 generic colors', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'style-prime blank-btn',
				'options' => array(
					array(
						'label' => esc_html__('Plain buttons', 'react-shortcodes'),
						'options' => array(
							'style-prime blank-btn' => esc_html__('Primary Plain', 'react-shortcodes'),
							'style-light blank-btn' => esc_html__('Light Plain', 'react-shortcodes'),
							'style-dark blank-btn' => esc_html__('Dark Plain', 'react-shortcodes'),
							'style-red blank-btn' => esc_html__('Red Plain', 'react-shortcodes'),
							'style-orange blank-btn' => esc_html__('Orange Plain', 'react-shortcodes'),
							'style-blue blank-btn' => esc_html__('Blue Plain', 'react-shortcodes'),
							'style-green blank-btn' => esc_html__('Green Plain', 'react-shortcodes')
						)
					),
					array(
						'label' => esc_html__('Shadow buttons', 'react-shortcodes'),
						'options' => array(
							'style-prime shadow-btn' => esc_html__('Primary Shadow', 'react-shortcodes'),
							'style-light shadow-btn' => esc_html__('Light Shadow', 'react-shortcodes'),
							'style-dark shadow-btn' => esc_html__('Dark Shadow', 'react-shortcodes'),
							'style-red' => esc_html__('Red', 'react-shortcodes'),
							'style-orange' => esc_html__('Orange', 'react-shortcodes'),
							'style-blue' => esc_html__('Blue', 'react-shortcodes'),
							'style-green' => esc_html__('Green', 'react-shortcodes')
						)
					),
					array(
						'label' => esc_html__('Hollow buttons', 'react-shortcodes'),
						'options' => array(
							'hollow-prime holw-btn' => esc_html__('Primary Hollow', 'react-shortcodes'),
							'hollow-dark holw-btn' => esc_html__('Dark Hollow', 'react-shortcodes'),
							'hollow-light holw-btn' => esc_html__('Light Hollow', 'react-shortcodes')
						)
					),
					array(
						'label' => esc_html__('Primary on hover buttons', 'react-shortcodes'),
						'options' => array(
							'style-light blank-btn hover-prime-btn' => esc_html__('Light plain', 'react-shortcodes'),
							'style-dark blank-btn hover-prime-btn' => esc_html__('Dark plain', 'react-shortcodes'),
							'style-light shadow-btn hover-prime-btn' => esc_html__('Light shadow', 'react-shortcodes'),
							'style-dark shadow-btn hover-prime-btn' => esc_html__('Dark shadow', 'react-shortcodes')
						)
					)
				)
			),
			tcs_get_hover_background_animation_options()
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  LIST
 */
function tcs_shortcode_list($atts, $content = '')
{
	extract(shortcode_atts(array(
		'style' => 'bullet',
		'layout' => 'stacked'
	), $atts));

	$classes = array('tcs-list', 'tcs-clearfix');

	if ($style) {
		$classes[] = tcs_prefix_classes('list-' . $style);
	}

	if ($layout) {
		$classes[] = tcs_prefix_classes($layout);
	}

	return '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '"><ul>' . do_shortcode($content) . '</ul></div>';
}
add_shortcode('list', 'tcs_shortcode_list');

function tcs_render_shortcode_list_options()
{
	$example = "\n[li]Example[/li]\n[li]Example[/li]";

	$config = array(
		'config' => array(
			'title' => esc_html__('List options', 'react-shortcodes'),
			'shortcode' => 'list',
		),
		'options' => array(
			array(
				'name' => 'style',
				'label' => esc_html__('Style', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a style', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'bullet',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'bullet' => esc_html__('Bullet', 'react-shortcodes'),
					'tick' => esc_html__('Tick', 'react-shortcodes'),
					'tick-plain' => esc_html__('Plain tick', 'react-shortcodes'),
					'arrow' => esc_html__('Arrow', 'react-shortcodes'),
					'arrow-drawn' => esc_html__('Hand written arrow', 'react-shortcodes'),
					'question' => esc_html__('Question', 'react-shortcodes')
				)
			),
			array(
				'name' => 'layout',
				'label' => esc_html__('Layout', 'react-shortcodes'),
				'tooltip' => esc_html__('Side by side (inline) or new line for each (stacked)', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'stacked',
				'options' => array(
					'stacked' => esc_html__('Stacked', 'react-shortcodes'),
					'inline' => esc_html__('Inline', 'react-shortcodes')
				)
			),
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('List HTML', 'react-shortcodes'),
				'description' => sprintf(esc_html__('Enter the content for your list, using the %s tags. Example below.', 'react-shortcodes'), '&#91;li&#93;'),
				'example' => $example,
				'type' => 'textarea',
				'default' => ''
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  MENU
 */
function tcs_shortcode_menu($atts, $content = '')
{
	extract(shortcode_atts(array(
		'type' => '',
		'menu' => '',
		'style' => 'button-style-two',
		'levels' => '',
		'grouped' => '0',
		'layout' => 'stacked'
	), $atts));

	$classes = array('tcs-menu', 'tcs-clearfix');

	if ($style) {
		$classes[] = tcs_prefix_classes('menu-' . $style);
	}

	if ($layout) {
		$classes[] = tcs_prefix_classes($layout);
	}

	if ($grouped) {
		$classes[] = 'tcs-grouped tcs-one-level';
	}

	if ($levels) {
		$classes[] = tcs_prefix_classes($levels);
	}

	$output = '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '">';

	if ($type == 'menu' && $menu) {
		$output .= wp_nav_menu(array('menu' => $menu, 'echo' => false));
	} else {
		$output .= do_shortcode($content);
	}

	$output .= '</div>';

	return $output;
}
add_shortcode('menu', 'tcs_shortcode_menu');

function tcs_render_shortcode_menu_options()
{
	$example = "\n[ul]\n[li][a href=\"http://www.example.com\"]Example[/a][/li]\n[li][a href=\"http://www.example.com\"]Example[/a][/li]\n[/ul]";

	$config = array(
		'config' => array(
			'title' => esc_html__('Menu options', 'react-shortcodes'),
			'shortcode' => 'menu',
			'style' => 'separator'
		),
		'options' => array(
			array(
				'name' => 'type',
				'label' => esc_html__('Type', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose to show a created WP menu or custom menu HTML.', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Custom menu HTML', 'react-shortcodes'),
					'menu' => esc_html__('Created WP menu', 'react-shortcodes')
				)
			),
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Menu HTML', 'react-shortcodes'),
				'description' => sprintf(esc_html__('Enter the content for your menu, using the %1$s and %2$s tags. Example below.', 'react-shortcodes'), '&#91;ul&#93;', '&#91;li&#93;'),
				'example' => $example,
				'type' => 'textarea',
				'default' => ''
			),
			array(
				'name' => 'menu',
				'label' => esc_html__('Menu', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => tcs_get_nav_menu_options()
			),
			array(
				'name' => 'style',
				'label' => esc_html__('Style', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a style', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'button-style-two',
				'options' => array(
					'button-style-one' => esc_html__('Button primary color', 'react-shortcodes'),
					'button-style-two' => esc_html__('Button light color', 'react-shortcodes'),
					'separator' => esc_html__('Vertical separator', 'react-shortcodes')
				)
			),
			array(
				'name' => 'layout',
				'label' => esc_html__('Layout', 'react-shortcodes'),
				'tooltip' => esc_html__('Side by side (inline) or new line for each (stacked)', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'stacked',
				'options' => array(
					'stacked' => esc_html__('Stacked', 'react-shortcodes'),
					'inline' => esc_html__('Inline', 'react-shortcodes')
				)
			),
			array(
				'name' => 'levels',
				'label' => esc_html__('Number of levels', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose to show or hide submenus', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Show all', 'react-shortcodes'),
					'one-level' => esc_html__('Show top level only', 'react-shortcodes'),
					'two-levels' => esc_html__('Show top and second', 'react-shortcodes'),
					'three-levels' => esc_html__('Show top, second and third', 'react-shortcodes')
				)
			),
			array(
				'name' => 'grouped',
				'label' => esc_html__('Grouped', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose to group buttons so there is no spacing between each', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  TABLE
 */
add_shortcode('fancy_table', 'tcs_shortcode_fancy_table');

function tcs_shortcode_fancy_table($atts, $content = '')
{
	extract(shortcode_atts(array(
		'id' => '',
		'width' => ''
	), $atts));

	return '<div' . ($id ? 'id="' . esc_attr($id) . '"' : '') . ' class="tcs-fancy-table"' . ($width !== '' ? ' style="width:' . esc_attr(tcs_get_css_value($width)) . ';"' : '') . '>' . do_shortcode($content) . '</div>';
}

function tcs_render_shortcode_fancy_table_options()
{
	$example = "[table]\n    [tr]\n        [th]Column 1 heading[/th]\n        [th]Column 2 heading[/th]\n    [/tr]\n    [tr]\n        [td]Cell 1-1[/td]\n        [td]Cell 1-2[/td]\n    [/tr]\n    [tr]\n        [td]Cell 2-1[/td]\n        [td]Cell 2-2[/td]\n    [/tr]\n[/table]";

	$config = array(
		'config' => array(
			'title' => esc_html__('Table options', 'react-shortcodes'),
			'shortcode' => 'fancy_table',
		),
		'options' => array(
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Table HTML', 'react-shortcodes'),
				'description' => sprintf(esc_html__('Enter the full content for your table, using the %s tags. Example below.', 'react-shortcodes'), '&#91;table&#93;'),
				'example' => $example,
				'type' => 'textarea',
				'default' => ''
			),
			array(
				'name' => 'id',
				'label' => esc_html__('ID', 'react-shortcodes'),
				'description' => esc_html__('Set the table wrapper ID for CSS/JavaScript purposes', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-150'
			),
			array(
				'name' => 'width',
				'label' => esc_html__('Width', 'react-shortcodes'),
				'description' => esc_html__('Enter a CSS width for your table e.g. 300px or 25%.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-60'
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  DROPCAP
 */
add_shortcode('dropcap', 'tcs_shortcode_dropcap');

function tcs_shortcode_dropcap($atts, $content = '')
{
	extract(shortcode_atts(array(
		'class' => '',
		'highlight' => '0'
	), $atts));

	$classes = array('tcs-dropcap');

	if ($highlight == '1') {
		$classes[] = 'tcs-highlighted-text';
	}

	if ($class) {
		$classes[] = $class;
	}

	return '<span class="' . esc_attr(tcs_sanitize_class($classes)) . '">' . do_shortcode($content) . '</span>';
}

function tcs_render_shortcode_dropcap_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Dropcap options', 'react-shortcodes'),
			'shortcode' => 'dropcap',
		),
		'options' => array(
			array(
				'name' => 'highlight',
				'label' => esc_html__('Highlight', 'react-shortcodes'),
				'description' => esc_html__('Highlight the letter with a background color.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'class',
				'label' => esc_html__('Classes', 'react-shortcodes'),
				'description' => esc_html__('Enter extra classes', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			),
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Dropcap character', 'react-shortcodes'),
				'description' => esc_html__('Enter the character you want to have as the dropcap', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-25'
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  ANIMATED PROGRESS
 */
function tcs_shortcode_animated_progress($atts, $content = '')
{
	extract(shortcode_atts(array(
		'end_number' => '100',
		'color' => 'prime',
		'margin_top' => '-1',
		'margin_bottom' => '-1',
		'animated' => '1'
	), $atts));

	$styles = array();
	$classes = array(
		'tcs-progress-bar-outer',
		tcs_prefix_classes($color),
		'tcs-clearfix'
	);

	if ($margin_top !== '' && $margin_top != '-1') {
		$styles[] = 'margin-top:' . tcs_get_css_value($margin_top) . ';';
	}

	if ($margin_bottom !== '' && $margin_bottom != '-1') {
		$styles[] = 'margin-bottom:' . tcs_get_css_value($margin_bottom) . ';';
	}

	if ($animated == '1' && function_exists('react_get_animation_data')) {
		$classes[] = 'tcs-force';
	}

	$end_number = absint($end_number);

	$output = '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '"' . (count($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') . '><div class="tcs-progress-bar" style="width: ' . $end_number . '%;"><span class="tcs-progress-label">' . $end_number . '%</span></div></div>';

	return $output;
}
add_shortcode('animated_progress', 'tcs_shortcode_animated_progress');

function tcs_render_shortcode_animated_progress_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Animated Progress', 'react-shortcodes'),
			'shortcode' => 'animated_progress',
		),
		'options' => array(
			array(
				'name' => 'color',
				'label' => esc_html__('Color', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'prime',
				'options' => array(
					'prime' => esc_html__('Primary', 'react-shortcodes'),
					'dark' => esc_html__('Dark', 'react-shortcodes')
				)
			),
			array(
				'name' => 'end_number',
				'label' => esc_html__('End number', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose the final percentage of the bar', 'react-shortcodes'),
				'type' => 'slider',
				'default' => 100,
				'slider' => array('from' => 5, 'to' => 100, 'step' => 1, 'dimension' => '%')
			),
			array(
				'name' => 'margin_top',
				'label' => esc_html__('Top margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '-1',
				'slider' => array('from' => -1, 'to' => 100, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'margin_bottom',
				'label' => esc_html__('Bottom margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '-1',
				'slider' => array('from' => -1, 'to' => 100, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'animated',
				'label' => esc_html__('Animate bar', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '1',
				'toggle' => 'yn'
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  ANIMATED NUMBER
 */
function tcs_shortcode_animated_number($atts, $content = '')
{
	extract(shortcode_atts(array(
		'end_number' => '5',
		'font_size' => 0,
		'label' => '',
		'tag' => 'span',
		'bold' => '',
		'text_align' => '',
		'margin_top' => '',
		'margin_bottom' => '',
		'animated' => '1'
	), $atts));

	$styles = array();
	$classes = array('tcs-animated-number');

	if ($font_size != 0) {
		$styles[] = 'font-size:' . $font_size . 'px;line-height:' . ($font_size * 1.1) . 'px;';
	}

	if ($margin_top !== '') {
		$styles[] = 'margin-top:' . tcs_get_css_value($margin_top) . ';';
	}

	if ($margin_bottom !== '') {
		$styles[] = 'margin-bottom:' . tcs_get_css_value($margin_bottom) . ';';
	}

	if ($bold == '1') {
		$classes[] = 'tcs-bold';
	}

	if ($text_align) {
		$classes[] = tcs_prefix_classes($text_align);
	}

	// Ensure the start/end values are numbers
	$content = absint($content);
	$end_number = absint($end_number);
	if ($content > $end_number) {
		$content = 0;
	}

	if (function_exists('react_get_animation_data')) {
		if ($animated == '1') {
			$classes[] = 'has-animation';
			$animationData = ' data-animation="fadeIn"';
		}
	} else {
		// We can't animate the number without react so just set the content to the end number
		$content = $end_number;
	}

	$output = '<span class="' . esc_attr(tcs_sanitize_class($classes)) . '"' . (count($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') . ' data-end-number="' . esc_attr($end_number) . '"' . (isset($animationData) ? $animationData : '') . '>' . esc_html($content) . '</span>';

	if ($label) {
		$wrapClasses = array('tcs-animated-number-wrap', 'tcs-clearfix');

		if ($text_align) {
			$wrapClasses[] = tcs_prefix_classes($text_align);
		}

		$output = '<div class="' . esc_attr(tcs_sanitize_class($wrapClasses)) . '"><' . esc_attr($tag) . ' class="tcs-animated-number-label">' . esc_html($label) . '</' . esc_attr($tag) . '><br>' . $output . '</div>';
	}

	return $output;
}
add_shortcode('animated_number', 'tcs_shortcode_animated_number');

function tcs_render_shortcode_animated_number_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Animated Number', 'react-shortcodes'),
			'shortcode' => 'animated_number',
		),
		'options' => array(
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Start number', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-100'
			),
			array(
				'name' => 'end_number',
				'label' => esc_html__('End number', 'react-shortcodes'),
				'type' => 'text',
				'default' => '5',
				'class' => 'tcas-width-100'
			),
			array(
				'label' => esc_html__('Label', 'react-shortcodes'),
				'type' => 'multiple',
				'elements' => array(
					array(
						'label' => esc_html__('Text', 'react-shortcodes'),
						'name' => 'label',
						'type' => 'text',
						'class' => 'tcas-width-300',
						'inline' => true
					),
					array(
						'name' => 'tag',
						'label' => esc_html__('Tag', 'react-shortcodes'),
						'tooltip' => esc_html__('Choose which HTML tag to use for the label', 'react-shortcodes'),
						'type' => 'select',
						'default' => 'span',
						'options' => tcs_get_header_tag_options(),
						'inline' => true
					)
				)
			),
			array(
				'name' => 'font_size',
				'label' => esc_html__('Font Size', 'react-shortcodes'),
				'tooltip' => esc_html__('Use the value slider to enter a pixel value for the font size.', 'react-shortcodes'),
				'description' => esc_html__('Choose 0 to inherit value from CSS.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => 0,
				'slider' => array('from' => 0, 'to' => 300, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'text_align',
				'label' => esc_html__('Alignment', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Inline', 'react-shortcodes'),
					'textleft' => esc_html__('Left', 'react-shortcodes'),
					'textcenter' => esc_html__('Center', 'react-shortcodes'),
					'textright' => esc_html__('Right', 'react-shortcodes')
				)
			),
			array(
				'name' => 'bold',
				'label' => esc_html__('Bold text', 'react-shortcodes'),
				'tooltip' => esc_html__('Use bold text', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'margin_top',
				'label' => esc_html__('Top margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => -100, 'to' => 800, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'margin_bottom',
				'label' => esc_html__('Bottom margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => -100, 'to' => 800, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'animated',
				'label' => esc_html__('Fade in', 'react-shortcodes'),
				'tooltip' => esc_html__('Add a subtle animation when the item comes into view', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  TABS
 */
function tcs_shortcode_tabs($atts, $content = '')
{
	extract(shortcode_atts(array(
		'size' => '',
		'fill' => '',
		'layout' => '',
		'boxed' => '0',
		'convert' => 'cvt-phone-ldsp',
		'animation' => '',
		'width' => ''
	), $atts));

	global $tcsTabs;
	$tcsTabs = array();

	do_shortcode($content);

	$classes = array('tcs-tabs', 'tcs-clearfix');

	if ($layout) {
		$classes[] = tcs_prefix_classes($layout);
	}

	if ($convert) {
		$classes[] = tcs_prefix_classes($convert);
	}

	if ($size) {
		$classes[] = tcs_prefix_classes($size);
	}

	if ($boxed) {
		$classes[] = 'tcs-boxed';
	}

	if ($animation) {
		$classes[] = tcs_prefix_classes($animation);
	}

	$out = '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '"' . ($width !== '' ? ' style="width:' . esc_attr(tcs_get_css_value($width)) . ';"' : '') . '>';
	$out .= '<ul class="tcs-tabs-nav tcs-clearfix' . ($layout != 'vertical' && $fill ? ' ' . esc_attr(tcs_prefix_classes($fill)) : '') . '">';

	for ($i = 0, $c = count($tcsTabs); $i < $c; $i++) {
		$icon = $tcsTabs[$i]['icon'] ? '<i class="' . esc_attr(tcs_sanitize_class(tcs_get_icon_classes($tcsTabs[$i]['icon']))) . '"></i>' : '';

		$out .= '<li><a>' . $icon . esc_html($tcsTabs[$i]['title']) . '</a></li>';
	}

	$out .= '</ul>';

	for ($i = 0; $i < $c; $i++) {
		$out .= '<div class="tcs-tab-content"><div class="tcs-tab-content-inner">' . do_shortcode($tcsTabs[$i]['content']) . '</div></div>';
	}

	$out .= '</div>'; // .tcs-tabs

	unset($GLOBALS['tcsTabs']);

	return $out;
}
add_shortcode('tabs', 'tcs_shortcode_tabs');

function tcs_shortcode_tab($atts, $content = '')
{
	extract(shortcode_atts(array(
		'title' => '',
		'icon' => ''
	), $atts));

	global $tcsTabs;
	$tcsTabs[] = compact('title', 'icon', 'content');
}
add_shortcode('tab', 'tcs_shortcode_tab');

function tcs_render_shortcode_tabs_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Tabs options', 'react-shortcodes'),
			'shortcode' => 'tabs',
		),
		'options' => array(
			array(
				'name' => 'animation',
				'label' => esc_html__('Animation', 'react-shortcodes'),
				'description' => esc_html__('Choose the animation of the tab transition', 'react-shortcodes'),
				'type' => 'select',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'sliding' => esc_html__('Sliding', 'react-shortcodes')
				)
			),
			array(
				'name' => 'size',
				'label' => esc_html__('Size', 'react-shortcodes'),
				'type' => 'select',
				'options' => array(
					'' => esc_html__('Small', 'react-shortcodes'),
					'med' => esc_html__('Medium', 'react-shortcodes'),
					'lrg' => esc_html__('Large', 'react-shortcodes')
				)
			),
			array(
				'name' => 'layout',
				'label' => esc_html__('Layout', 'react-shortcodes'),
				'type' => 'select',
				'options' => array(
					'' => esc_html__('Horizontal', 'react-shortcodes'),
					'vertical' => esc_html__('Vertical', 'react-shortcodes')
				)
			),
			array(
				'name' => 'boxed',
				'label' => esc_html__('Boxed style', 'react-shortcodes'),
				'tooltip' => esc_html__('Display a box around tab content', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'fill',
				'label' => esc_html__('Fill to full width', 'react-shortcodes'),
				'description' => esc_html__('Tabs will now use 100% of the area they are in. Select the number of tabs you have if you wish to use this feature.', 'react-shortcodes'),
				'type' => 'select',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'blocks-2' => esc_html__('2', 'react-shortcodes'),
					'blocks-3' => esc_html__('3', 'react-shortcodes'),
					'blocks-4' => esc_html__('4', 'react-shortcodes'),
					'blocks-5' => esc_html__('5', 'react-shortcodes'),
					'blocks-6' => esc_html__('6', 'react-shortcodes')
				)
			),
			array(
				'name' => 'convert',
				'label' => esc_html__('Convert point', 'react-shortcodes'),
				'tooltip' => esc_html__('When to swap the tabs to a stacked layout for better usability on smaller screens', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'cvt-phone-ldsp',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'cvt-phone-ptr' => esc_html__('Phone Portrait', 'react-shortcodes'),
					'cvt-phone-ldsp' => esc_html__('Phone Landscape', 'react-shortcodes'),
					'cvt-tablet-ptr' => esc_html__('Tablet Portrait', 'react-shortcodes'),
					'cvt-tablet-ldsp' => esc_html__('Tablet Landscape', 'react-shortcodes')
				)
			),
			array(
				'name' => 'width',
				'label' => esc_html__('Width', 'react-shortcodes'),
				'description' => esc_html__('Enter a CSS width for your tabs e.g. 300px or 25%. Leave blank for full width.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-50'
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  TOGGLE
 *
 *  The additional shortcodes add support for nested toggles
 */
add_shortcode('toggle', 'tcs_shortcode_toggle');
add_shortcode('toggle1', 'tcs_shortcode_toggle');
add_shortcode('toggle2', 'tcs_shortcode_toggle');
add_shortcode('toggle3', 'tcs_shortcode_toggle');
add_shortcode('toggle4', 'tcs_shortcode_toggle');

function tcs_shortcode_toggle($atts, $content = '')
{
	extract(shortcode_atts(array(
		'width' => '',
		'style' => 'box',
		'destroy' => 0,
		'size' => ''
	), $atts));

	$classes = array('tcs-accordion', 'tcs-toggle');

	if ($size) {
		$classes[] = tcs_prefix_classes($size);
	}

	if ($style) {
		$classes[] = tcs_prefix_classes($style);
	}

	if ($destroy == '1') {
		$classes[] = ' tcs-destroy-trigger';
	}

	return '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '"' . ($width !== '' ? ' style="width:' . esc_attr(tcs_get_css_value($width)) . ';"' : '') . '>' . do_shortcode($content) . '</div>';
}

add_shortcode('toggle_content', 'tcs_shortcode_toggle_content');
add_shortcode('toggle_content1', 'tcs_shortcode_toggle_content');
add_shortcode('toggle_content2', 'tcs_shortcode_toggle_content');
add_shortcode('toggle_content3', 'tcs_shortcode_toggle_content');
add_shortcode('toggle_content4', 'tcs_shortcode_toggle_content');

function tcs_shortcode_toggle_content($atts, $content = '')
{
	extract(shortcode_atts(array(
		'title' => '',
		'open' => '0',
		'class' => ''
	), $atts));

	$out = '<h3' . ($class ? ' class="' . esc_attr(tcs_sanitize_class($class)) . '"' : '') . '><a>' . esc_html($title) . '</a></h3>';
	$out .= '<div class="tcs-accordion-content-wrap' . ($open == '1' ? ' tcs-acc-open' : '') . '"><div class="tcs-accordion-content tcs-clearfix">' . do_shortcode($content) . '</div></div>';
	return $out;
}

function tcs_render_shortcode_toggle_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Toggle options', 'react-shortcodes'),
			'shortcode' => 'toggle',
		),
		'options' => array(
			array(
				'name' => 'width',
				'label' => esc_html__('Width', 'react-shortcodes'),
				'description' => esc_html__('Enter a CSS width for your toggles e.g. 300px or 25%. Leave blank for full width.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-50'
			),
			array(
				'name' => 'style',
				'label' => esc_html__('Style', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'box',
				'options' => array(
					'box' => esc_html__('Boxed', 'react-shortcodes'),
					'text-line' => esc_html__('Underlined (text width)', 'react-shortcodes'),
					'text-line full' => esc_html__('Underlined (full width)', 'react-shortcodes')
				)
			),
			array(
				'name' => 'destroy',
				'label' => esc_html__('Hide the trigger when clicked', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'size',
				'label' => esc_html__('Size', 'react-shortcodes'),
				'type' => 'select',
				'options' => array(
					'' => esc_html__('Small', 'react-shortcodes'),
					'med' => esc_html__('Medium', 'react-shortcodes'),
					'lrg' => esc_html__('Large', 'react-shortcodes')
				)
			)
		),

	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  ACCORDION
 *
 *  The additional shortcodes add support for nested accordions
 */
add_shortcode('accordion', 'tcs_shortcode_accordion');
add_shortcode('accordion1', 'tcs_shortcode_accordion');
add_shortcode('accordion2', 'tcs_shortcode_accordion');
add_shortcode('accordion3', 'tcs_shortcode_accordion');
add_shortcode('accordion4', 'tcs_shortcode_accordion');

function tcs_shortcode_accordion($atts, $content = '')
{
	extract(shortcode_atts(array(
		'width' => '',
		'style' => 'box',
		'destroy' => '0',
		'size' => ''
	), $atts));

	$classes = array('tcs-accordion');

	if ($size) {
		$classes[] = tcs_prefix_classes($size);
	}

	if ($style) {
		$classes[] = tcs_prefix_classes($style);
	}

	if ($destroy == '1') {
		$classes[] = 'tcs-destroy-trigger';
	}

	return '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '"' . ($width !== '' ? ' style="width:' . esc_attr(tcs_get_css_value($width)) . ';"' : '') . '>' . do_shortcode($content) . '</div>';
}

add_shortcode('accordion_toggle', 'tcs_shortcode_accordion_toggle');
add_shortcode('accordion_toggle1', 'tcs_shortcode_accordion_toggle');
add_shortcode('accordion_toggle2', 'tcs_shortcode_accordion_toggle');
add_shortcode('accordion_toggle3', 'tcs_shortcode_accordion_toggle');
add_shortcode('accordion_toggle4', 'tcs_shortcode_accordion_toggle');

function tcs_shortcode_accordion_toggle($atts, $content = '')
{
	extract(shortcode_atts(array(
		'title' => '',
		'open' => '0',
		'class' => ''
	), $atts));

	$output = '<h3' . ($class ? ' class="' . esc_attr(tcs_sanitize_class($class)) . '"' : '') . '><a>' . esc_html($title) . '</a></h3>';
	$output .= '<div class="tcs-accordion-content-wrap' . ($open == '1' ? ' tcs-acc-open' : '') . '"><div class="tcs-accordion-content tcs-clearfix">' . do_shortcode($content) . '</div></div>';

	return $output;
}

function tcs_render_shortcode_accordion_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Accordion options', 'react-shortcodes'),
			'shortcode' => 'accordion',
		),
		'options' => array(
			array(
				'name' => 'width',
				'label' => esc_html__('Width', 'react-shortcodes'),
				'description' => esc_html__('Enter a CSS width for your accordion e.g. 300px or 25%. Leave blank for full width', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-50'
			),
			array(
				'name' => 'style',
				'label' => esc_html__('Style', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'box',
				'options' => array(
					'box' => esc_html__('Boxed', 'react-shortcodes'),
					'plain inline' => esc_html__('Underlined (text width)', 'react-shortcodes'),
					'plain full' => esc_html__('Underlined (full width)', 'react-shortcodes')
				)
			),
			array(
				'name' => 'destroy',
				'label' => esc_html__('Hide the trigger when clicked', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'size',
				'label' => esc_html__('Size', 'react-shortcodes'),
				'type' => 'select',
				'options' => array(
					'' => esc_html__('Small', 'react-shortcodes'),
					'med' => esc_html__('Medium', 'react-shortcodes'),
					'lrg' => esc_html__('Large', 'react-shortcodes')
				)
			)
		),

	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  IMAGE
 */
function tcs_shortcode_image($atts, $content = '')
{
	extract(shortcode_atts(array(
		'src' => '',
		'width' => '',
		'height' => '',
		'hover_animation' => '',
		'animation' => '',
		'animation_delay' => '',
		'animation_offset' => '',
		'alt' => '',
		'title' => '',
		'custom_margin' => '0',
		'icon' => '',
		'use_caption' => '0',
		'caption_title' => '',
		'caption_subtitle' => '',
		'caption_overlay' => 'hover-prime',
		'caption_type' => 'cap-slide-out',
		'margin_top' => '0',
		'margin_bottom' => '0',
		'margin_left' => '0',
		'margin_right' => '0',
		'id' => '',
		'class' => '',
		'frame' => 'none',
		'align' => '',
		'href' => '',
		'a_icon' => '',
		'image_hover' => '',
		'link_popup' => '0'
	), $atts));

	if ($src === '') {
		return $src;
	}

	$classes = array('tcs-image');
	$styles = array();

	if ($align) {
		$classes[] = tcs_prefix_classes($align);
	}

	if ($frame) {
		$classes[] = tcs_prefix_classes($frame);
	}

	if ($image_hover) {
		$classes[] = tcs_prefix_classes($image_hover);
	}

	if ($width && $frame == 'round-img') {
		$styles[] = 'max-width:' . absint($width) .'px;';
	}
	if ($height && $frame == 'round-img') {
		$styles[] = 'max-height:' . absint($height) .'px;';
	}

	if ($custom_margin == '1') {
		if (!is_numeric($margin_top)) {
			$margin_top = 0;
		}
		if (!is_numeric($margin_right)) {
			$margin_right = 0;
		}
		if (!is_numeric($margin_bottom)) {
			$margin_bottom = 0;
		}
		if (!is_numeric($margin_left)) {
			$margin_left = 0;
		}

		$styles[] = 'margin:' . intval($margin_top) .'px ' . intval($margin_right) .'px ' . intval($margin_bottom) .'px ' . intval($margin_left) .'px;';
	}

	if ($animation && function_exists('react_get_animation_data')) {
		$classes[] = react_get_animation_class($animation);
		$animationData = react_get_animation_data($animation, $animation_delay, $animation_offset);
	}

	if ($hover_animation) {
		$classes[] = $hover_animation;
	}

	$src = tcs_get_upload_url($src);

	$output = '<img src="' . esc_url($src) . '" alt="' . (!empty($alt) ? esc_attr($alt) : '') . '"';

	if ($title) {
		$output .= ' title="' . esc_attr($title) . '"';
	}

	if ($id) {
		$output .= ' id="' . esc_attr($id) . '"';
	}

	if ($class) {
		$output .= ' class="' . esc_attr(tcs_sanitize_class($class)) . '"';
	}

	if ($width) {
		$output .= ' width="' . absint($width) . '"';
	}

	if ($height) {
		$output .= ' height="' . absint($height) . '"';
	}

	if ($width || $height) {
		$output .= ' style="';

		if ($width) {
			$output .= 'width:' . absint($width) . 'px;';
		}
		if ($height) {
			$output .= 'height:' . absint($height) . 'px;';
		}

		$output .= '"';
	}

	$output .= '>';

	if ($use_caption == '1') {
		$classes[] = 'tcs-image-caption-on';
		if ($caption_title && !$caption_subtitle) {
			$caption = '<span class="tcs-image-caption-title">' . esc_html($caption_title) . '</span>';
		}
		if ($caption_subtitle && !$caption_title) {
			$caption = '<span class="tcs-image-caption-subtitle">' . esc_html($caption_subtitle) . '</span>';
		}
		if ($caption_subtitle && $caption_title) {
			$caption = '<span class="tcs-image-caption-title">' . esc_html($caption_title) . '</span><br /><span class="tcs-image-caption-subtitle">' . esc_html($caption_subtitle) . '</span>';
		}

		$captionClasses = array('tcs-image-hover');

		if ($caption_overlay) {
			$captionClasses[] = tcs_prefix_classes($caption_overlay);
		}

		if ($caption_type) {
			$captionClasses[] = tcs_prefix_classes($caption_type);
		}

		$hover = '<span class="' . esc_attr(tcs_sanitize_class($captionClasses)) . '"><span class="tcs-image-caption">' . ($icon ? '<i class="' . esc_attr(tcs_sanitize_class(tcs_get_icon_classes($icon))) . '"></i>' : '');

		if ($caption) {
			$hover .= '<span class="tcs-image-caption-text">' . $caption . '</span>';
		}

		$hover .= '</span></span>';

		$output = $hover . $output;
	}

	if ($href) {
		$output = '<a href="' . esc_url($href) . '" class="hvr-icon-wobble-horizontal"' . ($link_popup == '1' ? ' target="_blank"' : '') . '>'
				. ($a_icon ? '<i class="fa ' . esc_attr($a_icon) . '"></i>' : '') . $output . '</a>';
	}

	if ($frame) {
		$output = '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '"' . (isset($animationData) ? ' ' . $animationData : '') . (count($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') . '><div class="tcs-image-inner">' . $output . '</div></div>';
	}

	global $tcsInCarousel;
	if (isset($tcsInCarousel)) {
		global $tcsCarouselImages;
		$tcsCarouselImages[] = $output;
		return;
	}

	if ($align == 'center') {
		$output = '<div class="tcs-image-center">' . $output . '</div>';
	}

	return $output;
}
add_shortcode('image', 'tcs_shortcode_image');

function tcs_render_shortcode_image_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Image options', 'react-shortcodes'),
			'shortcode' => 'image'
		),
		'options' => array(
			array(
				'name' => 'src',
				'label' => esc_html__('Image URL', 'react-shortcodes'),
				'type' => 'text_upload',
				'default' => '',
				'class' => 'tcas-width-350',
				'inline' => true,
				'id' => 'tcas-image-sc-image_browse'
			),
			array(
				'name' => 'width',
				'label' => esc_html__('Image width', 'react-shortcodes'),
				'type' => 'number',
				'class' => 'tcas-width-50',
				'default' => '',
				'optional' => true,
				'unit' => 'px'
			),
			array(
				'name' => 'height',
				'label' => esc_html__('Image height', 'react-shortcodes'),
				'type' => 'number',
				'class' => 'tcas-width-50',
				'default' => '',
				'optional' => true,
				'unit' => 'px'
			),
			array(
				'name' => 'align',
				'label' => esc_html__('Alignment', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'center' => esc_html__('Center', 'react-shortcodes'),
					'left' => esc_html__('Left', 'react-shortcodes'),
					'right' => esc_html__('Right', 'react-shortcodes')
				)
			),
			tcs_get_hover_animation_options(),
			tcs_get_extended_animation_options(),
			array(
				'name' => 'custom_margin',
				'label' => esc_html__('Custom margin', 'react-shortcodes'),
				'description' => esc_html__('You can override the default margins with your own values.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Margin', 'react-shortcodes'),
				'description' => esc_html__('The CSS margin values of the image in pixels.', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'margin_top',
						'label' => esc_html__('Top', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'margin_right',
						'label' => esc_html__('Right', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'margin_bottom',
						'label' => esc_html__('Bottom', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'margin_left',
						'label' => esc_html__('Left', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-60',
						'inline' => true
					)
				)
			),
			array(
				'name' => 'alt',
				'label' => esc_html__('Alt', 'react-shortcodes'),
				'description' => esc_html__('The alt attribute of the img tag', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-150',
				'optional' => true
			),
			array(
				'name' => 'title',
				'label' => esc_html__('Title', 'react-shortcodes'),
				'description' => esc_html__('The title attribute of the img tag', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-150',
				'optional' => true
			),
			array(
				'name' => 'id',
				'label' => esc_html__('ID', 'react-shortcodes'),
				'description' => esc_html__('The id attribute of the img tag', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-150',
				'optional' => true
			),
			array(
				'name' => 'class',
				'label' => esc_html__('Class', 'react-shortcodes'),
				'description' => esc_html__('The class attribute of the img tag', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-150',
				'optional' => true
			),
			array(
				'name' => 'href',
				'label' => esc_html__('Link URL', 'react-shortcodes'),
				'description' => esc_html__('Link the image to this URL', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-400',
				'optional' => true
			),
			array(
				'name' => 'link_popup',
				'label' => esc_html__('Open link in new tab', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'image_hover',
				'label' => esc_html__('Image hover effect', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'slide-effect' => esc_html__('Slide up', 'react-shortcodes'),
					'zoom-effect' => esc_html__('Zoom', 'react-shortcodes')
				)
			),
			array(
				'name' => 'a_icon',
				'label' => esc_html__('Link icon', 'react-shortcodes'),
				'description' => esc_html__('Icon shown if image has an link', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'fa-arrow-circle-o-right' => esc_html__('Arrow right', 'react-shortcodes'),
					'fa-link' => esc_html__('Link', 'react-shortcodes'),
					'fa-envelope-o' => esc_html__('Mail', 'react-shortcodes'),
					'fa-info-circle' => esc_html__('Information', 'react-shortcodes'),
					'fa-play-circle-o' => esc_html__('Play', 'react-shortcodes'),
					'fa-map-marker' => esc_html__('Map', 'react-shortcodes')
				)
			),
			array(
				'name' => 'use_caption',
				'label' => esc_html__('Use caption overlay', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'icon',
				'label' => esc_html__('Caption icon', 'react-shortcodes'),
				'type' => 'icon',
				'default' => '',
				'subset' => 'fonts'
			),
			array(
				'name' => 'caption_title',
				'label' => esc_html__('Caption title', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			),
			array(
				'name' => 'caption_subtitle',
				'label' => esc_html__('Caption subtitle', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			),
			array(
				'name' => 'caption_overlay',
				'label' => esc_html__('Caption overlay', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'hover-prime',
				'options' => array(
					'hover-prime' => esc_html__('Primary color', 'react-shortcodes'),
					'hover-dark' => esc_html__('Dark color', 'react-shortcodes'),
					'hover-light' => esc_html__('Light color', 'react-shortcodes')
				)
			),
			array(
				'name' => 'caption_type',
				'label' => esc_html__('Caption type', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'cap-slide-out',
				'options' => array(
					'cap-slide-out' => esc_html__('Slide out on hover', 'react-shortcodes'),
					'cap-slide-in' => esc_html__('Slide in on hover', 'react-shortcodes'),
					'cap-fade-out' => esc_html__('Fade out on hover', 'react-shortcodes'),
					'cap-fade-in' => esc_html__('Fade in on hover', 'react-shortcodes')
				)
			),
			array(
				'name' => 'frame',
				'label' => esc_html__('Image frame style', 'react-shortcodes'),
				'description' => esc_html__('The image will be displayed in a frame', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'none',
				'options' => array(
					'none' => esc_html__('None', 'react-shortcodes'),
					'style1' => esc_html__('Frame', 'react-shortcodes'),
					'style2' => esc_html__('Shadow style one', 'react-shortcodes'),
					'style3' => esc_html__('Shadow style two', 'react-shortcodes'),
					'style4' => esc_html__('Shadow style three', 'react-shortcodes'),
					'round-img' => esc_html__('Circle', 'react-shortcodes'),
					'grid' => esc_html__('No gaps', 'react-shortcodes')
				)
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  SECTION BREAK
 */
function tcs_shortcode_section_break($atts, $content = '')
{
	extract(shortcode_atts(array(
		'type' => 'line',
		'type_css_size' => '',
		'type_css_color' => '',
		'type_css_style' => '',
		'type_css_design' => '',
		'type_image' => 'diagonal',
		'margin_top' => '20',
		'margin_bottom' => '20',
		'width' => '',
		'position' => '',
		'hide' => '',
		'stretched' => '0'
	), $atts));

	$classes = array('tcs-section-break');
	$styles = array();

	if ($margin_top != '20') {
		$styles[] = 'margin-top:' . tcs_get_css_value($margin_top) . ';';
	}

	if ($margin_bottom != '20') {
		$styles[] = 'margin-bottom:' . tcs_get_css_value($margin_bottom) . ';';
	}

	if ($width !== '') {
		$styles[] = 'width:' . tcs_get_css_value($width) . ';';

		if ($position) {
			$classes[] = tcs_prefix_classes($position);
		}
	} elseif ($stretched == '1') {
		$classes[] = 'tcs-fullwidth';
	}

	if ($type == 'graphics') {
		$classes[] = tcs_prefix_classes($type_image);
	} else {
		$classes[] = tcs_prefix_classes($type . $type_css_size . $type_css_color);

		if ($type_css_style) {
			$classes[] = tcs_prefix_classes($type_css_style);
		}

		if ($type_css_design) {
			$classes[] = tcs_prefix_classes($type_css_design);
		}
	}

	if ($hide) {
		$classes[] = tcs_get_hide_class($hide);
	}

	$output = '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '"' . (count($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') . '>';

	if ($content) {
		$output .= '<div class="tcs-section-break-content"><div class="tcs-section-break-help">' . do_shortcode($content) . '</div></div>';
	}

	$output .= '</div>';

	return $output;
}
add_shortcode('section_break', 'tcs_shortcode_section_break');

function tcs_render_shortcode_section_break_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Section break options', 'react-shortcodes'),
			'shortcode' => 'section_break'
		),
		'options' => array(
			array(
				'type' => 'multiple',
				'label' => esc_html__('Choose a style', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a style', 'react-shortcodes'),
				'wrap_class' => 'section_break_type',
				'elements' => array(
					array(
						'name' => 'type',
						'label' => esc_html__('Type', 'react-shortcodes'),
						'type' => 'select',
						'default' => 'line',
						'inline' => true,
						'options' => array(
							'blank' => esc_html__('Blank', 'react-shortcodes'),
							'line' => esc_html__('CSS line', 'react-shortcodes'),
							'graphics' => esc_html__('Image lines', 'react-shortcodes')
						)
					),
					array(
						'name' => 'type_css_size',
						'label' => esc_html__('Size', 'react-shortcodes'),
						'type' => 'select',
						'default' => '',
						'inline' => true,
						'options' => array(
							'' => esc_html__('Small', 'react-shortcodes'),
							'-lrg' => esc_html__('Thick', 'react-shortcodes')
						)
					),
					array(
						'name' => 'type_css_color',
						'label' => esc_html__('Color', 'react-shortcodes'),
						'type' => 'select',
						'default' => '',
						'inline' => true,
						'options' => array(
							'' => esc_html__('Background blend', 'react-shortcodes'),
							'-prime' => esc_html__('Primary', 'react-shortcodes')
						)
					),
					array(
						'name' => 'type_css_style',
						'label' => esc_html__('Style', 'react-shortcodes'),
						'type' => 'select',
						'default' => '',
						'inline' => true,
						'options' => array(
							'' => esc_html__('Solid', 'react-shortcodes'),
							'dashed' => esc_html__('Dashed', 'react-shortcodes'),
							'dotted' => esc_html__('Dotted', 'react-shortcodes'),
							'double' => esc_html__('Double', 'react-shortcodes')
						)
					),
					array(
						'name' => 'type_css_design',
						'label' => esc_html__('Details', 'react-shortcodes'),
						'type' => 'select',
						'default' => '',
						'inline' => true,
						'options' => array(
							'' => esc_html__('Both', 'react-shortcodes'),
							'left-detail' => esc_html__('Left', 'react-shortcodes'),
							'right-detail' => esc_html__('Right', 'react-shortcodes'),
							'no-detail' => esc_html__('None', 'react-shortcodes')
						)
					),
					array(
						'name' => 'type_image',
						'label' => esc_html__('Choose a style', 'react-shortcodes'),
						'type' => 'select',
						'default' => 'diagonal',
						'inline' => true,
						'options' => array(
							'diagonal' => esc_html__('Diagonal lines', 'react-shortcodes'),
							'diagonal-dark' => esc_html__('Diagonal lines dark', 'react-shortcodes'),
							'diagonal-transp' => esc_html__('Diagonal lines more opacity', 'react-shortcodes'),
							'diagonal-dark-transp' => esc_html__('Diagonal lines dark more opacity', 'react-shortcodes'),
							'indent-light' => esc_html__('Indent light', 'react-shortcodes'),
							'indent-dark' => esc_html__('Indent dark', 'react-shortcodes')
						)
					)
				)
			),
			array(
				'name' => 'margin_top',
				'label' => esc_html__('Top margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '20',
				'slider' => array('from' => -100, 'to' => 800, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'margin_bottom',
				'label' => esc_html__('Bottom margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '20',
				'slider' => array('from' => -100, 'to' => 800, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'width',
				'label' => esc_html__('Width', 'react-shortcodes'),
				'type' => 'number',
				'class' => 'tcas-width-50',
				'default' => '',
				'optional' => true,
				'unit' => 'px'
			),
			array(
				'name' => 'position',
				'label' => esc_html__('Position', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Center', 'react-shortcodes'),
					'pos-left' => esc_html__('Left', 'react-shortcodes'),
					'pos-right' => esc_html__('Right', 'react-shortcodes')
				)
			),
			array(
				'name' => 'stretched',
				'label' => esc_html__('Stretched', 'react-shortcodes'),
				'description' => esc_html__('Element width stretched to the edges of the page content area', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'hide',
				'label' => esc_html__('Hide on device(s)', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose to hide this shortcode on device(s)', 'react-shortcodes'),
				'type' => 'multiselect',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'hide-phone-ptr' => esc_html__('Phone portrait', 'react-shortcodes'),
					'hide-phone' => esc_html__('Phone landscape', 'react-shortcodes'),
					'hide-tablet-ptr' => esc_html__('Tablet portrait', 'react-shortcodes'),
					'hide-tablet' => esc_html__('Tablet landscape', 'react-shortcodes'),
					'hide-desktop' => esc_html__('Desktop', 'react-shortcodes'),
					'hide-large' => esc_html__('Large', 'react-shortcodes')
				)
			),
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Content', 'react-shortcodes'),
				'type' => 'textarea',
				'default' => ''
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  FANCY HEADER
 */
function tcs_shortcode_fancy_header($atts, $content = '')
{
	extract(shortcode_atts(array(
		'tag' => 'h2',
		'type' => '',
		'animation' => '',
		'animation_delay' => '',
		'animation_offset' => '',
		'letter_in_animation' => '0',
		'letter_animation_type' => '',
		'letter_animation' => 'fadeIn',
		'icon' => '',
		'icon_position' => '',
		'size' => '',
		'text_align' => '',
		'max_width' => '',
		'margin_bottom' => '-1',
		'margin_top' => '-1',
		'padding_bottom' => '-1',
		'padding_top' => '-1',
		'font_size' => '-1',
		'letter_spacing' => '0',
		'unit' => '',
		'font_weight' => '0',
		'uppercase' => '0',
		'bold' => '0',
		'stretched' => '0',
		'text_align_convert_device' => '',
		'text_align_convert_align' => '',
		'id' => '',
		'class' => ''
	), $atts));

	$classes = array('tcs-fancy-header');
	$styles = array();
	$wordAnimationData = array();

	if ($text_align_convert_device && $text_align_convert_align) {
		$classes[] = tcs_prefix_classes($text_align_convert_device . '-text-' . $text_align_convert_align);
	}

	// React-only options
	if (function_exists('react_get_animation_data')) {
		if ($animation) {
			$classes[] = react_get_animation_class($animation);
			$animationData = react_get_animation_data($animation, $animation_delay, $animation_offset);
		}

		if ($letter_in_animation) {
			$classes[] = 'tcs-word-animation';

			if ($letter_animation) {
				$wordAnimationData[] = ' data-in-effect="' . esc_attr($letter_animation) . '"';
			}

			if ($letter_animation_type) {
				$wordAnimationData[] = ' data-in-' . sanitize_key($letter_animation_type) . '="true"';
			}
		}
	}

	if ($size) {
		$classes[] = tcs_prefix_classes($size);
	}

	if ($type) {
		$classes[] = tcs_prefix_classes($type);
	}

	if ($text_align) {
		$classes[] = tcs_prefix_classes($text_align);
	}

	if ($class) {
		$classes[] = $class;
	}

	if ($icon_position) {
		$classes[] = tcs_prefix_classes($icon_position);
	}

	if ($stretched == '1') {
		$classes[] = 'tcs-fullwidth';
	}

	if ($bold == '1') {
		$classes[] = 'tcs-bold';
	}

	if ($uppercase == '1') {
		$classes[] = 'tcs-uppercase';
	}

	if ($font_size != '-1' && is_numeric($font_size)) {
		if ($font_size >= '22' ) {
			$styles[] = 'font-size: ' . $font_size .'px; line-height: ' . ($font_size * 1.1) .'px;';
		} else {
			$styles[] = 'font-size: ' . $font_size .'px; line-height: ' . ($font_size * 1.7) .'px;';
		}
	}

	if ($font_weight != '0' && is_numeric($font_weight)) {
		$styles[] = 'font-weight:' . $font_weight .';';
	}

	if ($letter_spacing != '0' && is_numeric($letter_spacing)) {
		if ($unit == 'px') {
			$styles[] = 'letter-spacing: ' . intval($letter_spacing) . 'px;';
		} else {
			$styles[] = 'letter-spacing: ' . (intval($letter_spacing) * 0.01) . 'em;';
		}
	}

	if ($max_width !== '') {
		$styles[] = 'max-width:' . tcs_get_css_value($max_width) .';';
	}

	if ($margin_top != '-1') {
		$styles[] = 'margin-top:' . tcs_get_css_value($margin_top) . ';';
	}

	if ($margin_bottom != '-1') {
		$styles[] = 'margin-bottom:' . tcs_get_css_value($margin_bottom) . ';';
	}

	if ($padding_top != '-1') {
		$styles[] = 'padding-top:' . tcs_get_css_value($padding_top) . ';';
	}

	if ($padding_bottom != '-1') {
		$styles[] = 'padding-bottom:' . tcs_get_css_value($padding_bottom) . ';';
	}

	$output = '<' . esc_attr($tag) .
				($id !== '' ? ' id="' . esc_attr($id) . '"' : '') .
				(count($classes) ? ' class="' . esc_attr(tcs_sanitize_class($classes)) . '"' : '') .
				(count($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') .
				(isset($animationData) ? ' ' . $animationData : '') .
			  '><span class="tcs-fancy-header-text"' . (count($wordAnimationData) ? ' ' . join('', $wordAnimationData) : '') . '>' .
				($icon ? '<i class="' . esc_attr(tcs_sanitize_class(tcs_get_icon_classes($icon))) . '"></i>' : '') .
				do_shortcode($content) .
			  '</span></' . esc_attr($tag) . '>';

	return $output;
}
add_shortcode('fancy_header', 'tcs_shortcode_fancy_header');

function tcs_render_shortcode_fancy_header_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Fancy header options', 'react-shortcodes'),
			'shortcode' => 'fancy_header'
		),
		'options' => array(
			array(
				'label' => esc_html__('Heading', 'react-shortcodes'),
				'type' => 'multiple',
				'elements' => array(
					array(
						'label' => esc_html__('Heading text', 'react-shortcodes'),
						'name' => 'enclosed_content',
						'type' => 'text',
						'class' => 'tcas-width-300',
						'inline' => true
					),
					array(
						'name' => 'tag',
						'label' => esc_html__('Tag', 'react-shortcodes'),
						'tooltip' => esc_html__('Choose which HTML tag to use for the heading', 'react-shortcodes'),
						'type' => 'select',
						'default' => 'h2',
						'options' => tcs_get_header_tag_options(),
						'inline' => true
					)
				)
			),
			array(
				'name' => 'type',
				'label' => esc_html__('Type', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a style', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Blank', 'react-shortcodes'),
					'style1' => esc_html__('Underline full width.', 'react-shortcodes'),
					'text-line' => esc_html__('Underline text width.', 'react-shortcodes'),
					'text-line fixed-width' => esc_html__('Underline fixed width.', 'react-shortcodes'),
					'style1 prime-line' => esc_html__('Underline full width, primary line text width.', 'react-shortcodes'),
					'prime-line' => esc_html__('Primary line text width.', 'react-shortcodes'),
					'prime-line fixed-width' => esc_html__('Primary line fixed width.', 'react-shortcodes'),
					'style1 prime-line animate-line' => esc_html__('Animated, underline full width and primary line text width.', 'react-shortcodes'),
					'style1 prime-line animate-line fixed-width' => esc_html__('Animated, underline full width and primary line fixed width.', 'react-shortcodes'),
					'prime-line animate-line' => esc_html__('Animated, primary line text width.', 'react-shortcodes'),
					'prime-line animate-line fixed-width' => esc_html__('Animated, primary line fixed width.', 'react-shortcodes'),
					'style2' => esc_html__('Color box', 'react-shortcodes'),
					'style3' => esc_html__('Bubble', 'react-shortcodes')
				)
			),
			tcs_get_extended_animation_options(),
			array(
				'name' => 'icon',
				'label' => esc_html__('Icon', 'react-shortcodes'),
				'type' => 'icon',
				'default' => '',
				'subset' => 'fonts' // FontAwesome only
			),
			array(
				'name' => 'letter_in_animation',
				'label' => esc_html__('Letter animation', 'react-shortcodes'),
				'tooltip' => esc_html__('Animation for text entrance', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			tcs_get_letter_animation_options(),
			array(
				'name' => 'icon_position',
				'label' => esc_html__('Icon location', 'react-shortcodes'),
				'tooltip' => esc_html__('Where to show the icon in relation to the header text', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Left', 'react-shortcodes'),
					'icon-above' => esc_html__('Above', 'react-shortcodes')
				)
			),
			array(
				'name' => 'size',
				'label' => esc_html__('Size', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a size', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Inherit from tag', 'react-shortcodes'),
					'small' => esc_html__('Small', 'react-shortcodes'),
					'medium' => esc_html__('Medium', 'react-shortcodes'),
					'large' => esc_html__('Large', 'react-shortcodes'),
					'huge' => esc_html__('Huge', 'react-shortcodes')
				)
			),
			array(
				'name' => 'font_size',
				'label' => esc_html__('Font size', 'react-shortcodes'),
				'tooltip' => esc_html__('Set a custom font size in px', 'react-shortcodes'),
				'description' => esc_html__('Using this method to set font sizes may be time consuming. You can increase global header sizes in the Options Panel.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '-1',
				'slider' => array('from' => -1, 'to' => 150, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'text_align',
				'label' => esc_html__('Text align', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Inherit', 'react-shortcodes'),
					'textleft' => esc_html__('Left', 'react-shortcodes'),
					'textcenter' => esc_html__('Center', 'react-shortcodes'),
					'textright' => esc_html__('Right', 'react-shortcodes')
				)
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Mobile text align', 'react-shortcodes'),
				'description' => esc_html__('Change the text alignment for smaller devices.', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'text_align_convert_device',
						'label' => esc_html__('Device', 'react-shortcodes'),
						'type' => 'select',
						'default' => '',
						'inline' => true,
						'options' => array(
							'' => esc_html__('None', 'react-shortcodes'),
							'phone' => esc_html__('Phone', 'react-shortcodes'),
							'tablet' => esc_html__('Tablet', 'react-shortcodes'),
							'mobile' => esc_html__('All mobile devices', 'react-shortcodes')
						)
					),
					array(
						'name' => 'text_align_convert_align',
						'label' => esc_html__('Align', 'react-shortcodes'),
						'type' => 'select',
						'default' => '',
						'inline' => true,
						'options' => array(
							'' => esc_html__('None', 'react-shortcodes'),
							'left' => esc_html__('Left', 'react-shortcodes'),
							'center' => esc_html__('Center', 'react-shortcodes'),
							'right' => esc_html__('Right', 'react-shortcodes')
						)
					)
				)
			),
			array(
				'name' => 'stretched',
				'label' => esc_html__('Stretched', 'react-shortcodes'),
				'tooltip' => esc_html__('Element width stretched to the edges of the page content area', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'max_width',
				'label' => esc_html__('Max width', 'react-shortcodes'),
				'type' => 'number',
				'default' => '',
				'class' => 'tcas-width-60',
				'unit' => 'px',
				'inline' => true
			),
			array(
				'name' => 'margin_top',
				'label' => esc_html__('Top margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'description' => esc_html__('For default margins based on Size, use -1.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '-1',
				'slider' => array('from' => -100, 'to' => 800, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'margin_bottom',
				'label' => esc_html__('Bottom margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'description' => esc_html__('For default margins based on Size, use -1.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '-1',
				'slider' => array('from' => -100, 'to' => 800, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'padding_top',
				'label' => esc_html__('Top padding', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'description' => esc_html__('For default padding based on Size, use -1.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '-1',
				'slider' => array('from' => -100, 'to' => 800, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'padding_bottom',
				'label' => esc_html__('Bottom padding', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'description' => esc_html__('For default padding based on Size, use -1.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '-1',
				'slider' => array('from' => -100, 'to' => 800, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'label' => esc_html__('Letter spacing', 'react-shortcodes'),
				'type' => 'multiple',
				'description' => esc_html__('For better accuracy, em are used to set the letter spacing. If you need a larger space use px. The value 0 will inherit from the theme styles.', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'letter_spacing',
						'label' => esc_html__('Value', 'react-shortcodes'),
						'tooltip' => esc_html__('Enter a value in a hundredth of an em or px', 'react-shortcodes'),
						'type' => 'slider',
						'default' => '0',
						'inline' => true,
						'slider' => array('from' => -10, 'to' => 20, 'step' => 1, 'dimension' => '')
					),
					array(
						'name' => 'unit',
						'label' => esc_html__('Unit', 'react-shortcodes'),
						'tooltip' => esc_html__('Switch between pixels and em', 'react-shortcodes'),
						'type' => 'select',
						'default' => '',
						'inline' => true,
						'options' => array(
							'' => 'em',
							'px' => 'px'
						)
					)
				)
			),
			array(
				'name' => 'font_weight',
				'label' => esc_html__('Font weight', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a font weight, the lower the number the thinner the text.', 'react-shortcodes'),
				'description' => esc_html__('You must make sure you link to the Google font files required for each weight you use in your site. The value 0 will inherit from the theme styles.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => 0, 'to' => 900, 'step' => 100, 'dimension' => '')
			),
			array(
				'name' => 'uppercase',
				'label' => esc_html__('Uppercase', 'react-shortcodes'),
				'tooltip' => esc_html__('Use uppercase text', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'bold',
				'label' => esc_html__('Bold text', 'react-shortcodes'),
				'tooltip' => esc_html__('Use bold text', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'id',
				'label' => esc_html__('Header ID', 'react-shortcodes'),
				'description' => esc_html__('This will set the id attribute to allow you to make anchor links to this header.', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			),
			array(
				'name' => 'class',
				'label' => esc_html__('Custom classes', 'react-shortcodes'),
				'description' => esc_html__('Add additional classes to the header', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  CYCLE
 */
function tcs_shortcode_cycle($atts, $content = '')
{
	extract(shortcode_atts(array(
		'animate_in' => '',
		'animate_out' => '',
		'speed' => '500',
		'autoplay' => '0',
		'autoplay_timeout' => '2500',
		'autoplay_hover_pause' => '0',
		'dots' => '0',
		'loop' => '0',
		'width' => '0',
		'height' => '0',
		'position' => '',
		'controls' => '1',
		'controls_pos' => '',
		'mouse_drag' => '1',
		'touch_drag' => '1',
		'auto_height' => '0'
	), $atts));

	$data = array(
		'animateIn' => strlen($animate_in) ? $animate_in : false,
		'animateOut' => strlen($animate_out) ? $animate_out : false,
		'smartSpeed' => absint($speed),
		'autoplay' => $autoplay === '1',
		'autoplayTimeout' => absint($autoplay_timeout),
		'autoplayHoverPause' => $autoplay_hover_pause === '1',
		'dots' => $dots === '1',
		'loop' => $loop === '1',
		'mouseDrag' => $mouse_drag === '1',
		'touchDrag' => $touch_drag === '1',
		'autoHeight' => $auto_height === '1'
	);

	$classes = array('tcs-cycle');
	$styles = array();

	if ($position) {
		$classes[] = tcs_prefix_classes($position);
	}

	if ($controls_pos != '' && $controls == '1') {
		$classes[] = tcs_prefix_classes($controls_pos);
	}

	if ($width == '0') {
		$width = '';
	}

	if ($height == '0') {
		$height = '';
	}

	if (strlen($width)) {
		$styles[] = 'width:' . tcs_get_css_value($width) . ';';
	}

	if (strlen($height)) {
		$styles[] = 'height:' . tcs_get_css_value($height) . ';';
	}

	$output = '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '" data-options="' . esc_attr(wp_json_encode($data)) . '"' . (count($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') .'>';

	if ($controls == '1') {
		$output .= '<div class="tcs-cycle-controls-wrap">';
		$output .= '    <div class="tcs-cycle-controls">';
		$output .= '        <a class="tcs-cycle-backward"><i class="fa fa-angle-left"></i></a>';
		$output .= '        <a class="tcs-cycle-forward"><i class="fa fa-angle-right"></i></a>';
		$output .= '    </div>';
		$output .= '</div>';
	}

	$output .= '<div class="tcs-cycle-slides owl-carousel owl-theme">' . do_shortcode($content) . '</div>';

	$output .= '</div>';

	return $output;
}
add_shortcode('cycle', 'tcs_shortcode_cycle');

function tcs_shortcode_cycle_slide($atts, $content = '')
{
	return '<div class="cycle-slide">' . do_shortcode($content) . '</div>';
}
add_shortcode('cycle_slide', 'tcs_shortcode_cycle_slide');

function tcs_render_shortcode_cycle_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Cycle options', 'react-shortcodes'),
			'shortcode' => 'cycle'
		),
		'options' => array(
			tcs_get_animation_options('animate_in', esc_html__('"In" animation', 'react-shortcodes'), esc_html__('The animation to use when a slide becomes visible.', 'react-shortcodes')),
			tcs_get_animation_options('animate_out', esc_html__('"Out" animation', 'react-shortcodes'), esc_html__('The animation to use when a slide hides.', 'react-shortcodes')),
			array(
				'name' => 'speed',
				'label' => esc_html__('Speed', 'react-shortcodes'),
				'description' => esc_html__('The speed of the animation in milliseconds, 1000 = 1 second. Note: this only affects the Default animation.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '500',
				'slider' => array('from' => 0, 'to' => 10000, 'step' => 100, 'dimension' => 'ms')
			),
			array(
				'name' => 'autoplay',
				'label' => esc_html__('Autoplay', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'autoplay_timeout',
				'label' => esc_html__('Autoplay timeout', 'react-shortcodes'),
				'description' => esc_html__('How long in milliseconds to display each slide when Autoplay is active.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '2500',
				'slider' => array('from' => 0, 'to' => 10000, 'step' => 100, 'dimension' => 'ms')
			),
			array(
				'name' => 'autoplay_hover_pause',
				'label' => esc_html__('Autoplay hover pause', 'react-shortcodes'),
				'description' => esc_html__('Pause autoplay on mouse hover.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'dots',
				'label' => esc_html__('Dots', 'react-shortcodes'),
				'description' => esc_html__('Dots navigation below slides.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'loop',
				'label' => esc_html__('Loop', 'react-shortcodes'),
				'description' => esc_html__('Infinity loop.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'width',
				'label' => esc_html__('Width', 'react-shortcodes'),
				'description' => esc_html__('Container width, set to 0 for full width', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => 0, 'to' => 900, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'height',
				'label' => esc_html__('Height', 'react-shortcodes'),
				'description' => esc_html__('Container height', 'react-shortcodes'),
				'type' => 'slider',
				'slider' => array('from' => 0, 'to' => 500, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'position',
				'label' => esc_html__('Position', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Center', 'react-shortcodes'),
					'float-left' => esc_html__('Left', 'react-shortcodes'),
					'float-right' => esc_html__('Right', 'react-shortcodes'),
				)
			),
			array(
				'name' => 'controls',
				'label' => esc_html__('Controls', 'react-shortcodes'),
				'description' => esc_html__('Prev/Next navigation controls.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '1'
			),
			array(
				'name' => 'controls_pos',
				'label' => esc_html__('Controls position', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Right', 'react-shortcodes'),
					'ctrls-center' => esc_html__('Center', 'react-shortcodes'),
					'ctrls-left' => esc_html__('Left', 'react-shortcodes'),
				)
			),
			array(
				'name' => 'mouse_drag',
				'label' => esc_html__('Mouse drag', 'react-shortcodes'),
				'description' => esc_html__('Mouse drag enabled.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '1'
			),
			array(
				'name' => 'touch_drag',
				'label' => esc_html__('Touch drag', 'react-shortcodes'),
				'description' => esc_html__('Touch drag enabled.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '1'
			),
			array(
				'name' => 'auto_height',
				'label' => esc_html__('Auto height', 'react-shortcodes'),
				'description' => esc_html__('Animate the height of the container if the slide height changes.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  IMAGE CAROUSEL
 */
function tcs_shortcode_image_carousel($atts, $content = '')
{
	extract(shortcode_atts(array(
		'width' => '100%',
		'space' => '0',
		'items' => '1',
		'responsive' => '',
		'speed' => '500',
		'autoplay' => '0',
		'autoplay_timeout' => '2500',
		'autoplay_hover_pause' => '0',
		'dots' => '0',
		'loop' => '0',
		'mouse_drag' => '1',
		'touch_drag' => '1',
		'hide' => ''
	), $atts));

	global $tcsCarouselImages, $tcsInCarousel;
	$tcsCarouselImages = array();
	$tcsInCarousel = true;

	// Gather carousel items
	do_shortcode($content);
	$count = count($tcsCarouselImages);

	if (!$count) {
		// Bail if no [image] shortcodes found inside
		return;
	}
	$options = array(
		'items' => absint($items),
		'smartSpeed' => absint($speed),
		'autoplay' => $autoplay === '1',
		'autoplayTimeout' => absint($autoplay_timeout),
		'autoplayHoverPause' => $autoplay_hover_pause === '1',
		'dots' => $dots === '1',
		'loop' => $loop === '1',
		'mouseDrag' => $mouse_drag === '1',
		'touchDrag' => $touch_drag === '1'
	);

	if ($responsive) {
		$parts = explode(',', $responsive);
		$respArr = array();

		foreach ($parts as $part) {
			$respParts = explode(':', $part);
			$respArr[$respParts[0]] = array('items' => absint($respParts[1]));
		}

		$options['responsive'] = $respArr;
	}

	$classes = array('tcs-image-carousel-wrap');

	if ($hide) {
		$classes[] = tcs_get_hide_class($hide);
	}

	$output = '<div' . (count($classes) ? ' class="' . esc_attr(tcs_sanitize_class($classes)) . '"' : '') . ($width !== '' ? ' style="width: ' . esc_attr(tcs_get_css_value($width)) . ';"' : '') . '>';
	$output .= '<div class="tcs-image-carousel owl-carousel owl-theme" data-options="' . esc_attr(wp_json_encode($options)) . '">';

	for ($i = 0, $count; $i < $count; $i++) {
		$output .= '<div' . ($space ? ' style="margin-left: ' . esc_attr($space) . '%; margin-right: ' . esc_attr($space) . '%;"' : '') . '>' . $tcsCarouselImages[$i] . '</div>';
	}

	$output .= '</div>';

	$output .= '<div class="tcs-carousel-prev"></div><div class="tcs-carousel-next"></div>';

	$output .= '</div>'; // .tcs-image-carousel-wrap

	unset($GLOBALS['tcsCarouselImages'], $GLOBALS['tcsInCarousel']);

	return $output;
}
add_shortcode('image_carousel', 'tcs_shortcode_image_carousel');

function tcs_render_shortcode_image_carousel_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Image carousel options', 'react-shortcodes'),
			'shortcode' => 'image_carousel'
		),
		'options' => array(
			array(
				'name' => 'width',
				'label' => esc_html__('Width', 'react-shortcodes'),
				'description' => esc_html__('The CSS width of the carousel, e.g. 200px or 50%.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '100%',
				'class' => 'tcas-width-50'
			),
			array(
				'name' => 'space',
				'label' => esc_html__('Space', 'react-shortcodes'),
				'description' => esc_html__('The amount of space between each image in percent.', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in percent', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => 0, 'to' => 50, 'step' => 1, 'dimension' => '%')
			),
			array(
				'name' => 'items',
				'label' => esc_html__('Visible items', 'react-shortcodes'),
				'description' => esc_html__('The number of items that are visible at once.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '1',
				'class' => 'tcas-width-50'
			),
			array(
				'name' => 'responsive',
				'label' => esc_html__('Responsive item settings', 'react-shortcodes'),
				'description' => esc_html__('See the online documentation for more information.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-350'
			),
			array(
				'name' => 'speed',
				'label' => esc_html__('Speed', 'react-shortcodes'),
				'description' => esc_html__('The speed of the animation in milliseconds, 1000 = 1 second.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '500',
				'slider' => array('from' => 0, 'to' => 10000, 'step' => 100, 'dimension' => 'ms')
			),
			array(
				'name' => 'autoplay',
				'label' => esc_html__('Autoplay', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'autoplay_timeout',
				'label' => esc_html__('Autoplay timeout', 'react-shortcodes'),
				'description' => esc_html__('How long the carousel should pause before scrolling again in milliseconds, 1000 = 1 second.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '2500',
				'slider' => array('from' => 0, 'to' => 10000, 'step' => 100, 'dimension' => 'ms')
			),
			array(
				'name' => 'autoplay_hover_pause',
				'label' => esc_html__('Autoplay hover pause', 'react-shortcodes'),
				'description' => esc_html__('Pause autoplay on mouse hover.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'dots',
				'label' => esc_html__('Dots', 'react-shortcodes'),
				'description' => esc_html__('Dots navigation below slides.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'loop',
				'label' => esc_html__('Loop', 'react-shortcodes'),
				'description' => esc_html__('Infinity loop.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'mouse_drag',
				'label' => esc_html__('Mouse drag', 'react-shortcodes'),
				'description' => esc_html__('Mouse drag enabled.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '1'
			),
			array(
				'name' => 'touch_drag',
				'label' => esc_html__('Touch drag', 'react-shortcodes'),
				'description' => esc_html__('Touch drag enabled.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '1'
			),
			array(
				'name' => 'hide',
				'label' => esc_html__('Hide on device(s)', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose to hide this shortcode on device(s)', 'react-shortcodes'),
				'type' => 'multiselect',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'hide-phone-ptr' => esc_html__('Phone portrait', 'react-shortcodes'),
					'hide-phone' => esc_html__('Phone landscape', 'react-shortcodes'),
					'hide-tablet-ptr' => esc_html__('Tablet portrait', 'react-shortcodes'),
					'hide-tablet' => esc_html__('Tablet landscape', 'react-shortcodes'),
					'hide-desktop' => esc_html__('Desktop', 'react-shortcodes'),
					'hide-large' => esc_html__('Large', 'react-shortcodes')
				)
			),
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Images', 'react-shortcodes'),
				'type' => 'textarea',
				'default' => '',
				'description' => 'Add [image] shortcodes to this box for each image. Example below.',
				'example' => "[image link=\"http://example.com\"]http://example.com/image1.png[/image]\n[image link=\"http://example.com\"]http://example.com/image12.png[/image]\n[image link=\"http://example.com\"]http://example.com/image3.png[/image]"
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  IMPACT HEADER
 */
function tcs_shortcode_impact_header($atts, $content = '')
{
	extract(shortcode_atts(array(
		'tag' => 'h2',
		'sub_tag' => 'h4',
		'type' => 'only-heading',
		'style' => 'color',
		'stretched' => '0',
		'margin_top' => '10',
		'margin_bottom' => '10',
		'convert' => 'cvt-tablet-ptr',
		'hide' => '',
		'subheading' => '',
		'icon' => '',
		'icon_animation' => 'fadeInUp',
		'icon_animation_delay' => '',
		'icon_animation_offset' => '',
		'button_text' => '',
		'button_link' => '',
		'button_external' => '0',
		'button_animation' => 'flipInX',
		'button_animation_delay' => '',
		'button_animation_offset' => '',
		'quform_id' => 'none',
		'id' => ''
	), $atts));

	$outerClasses = array('tcs-impact-header-outer');
	$classes = array('tcs-impact-header', 'tcs-clearfix');
	$styles = array();

	if ($icon) {
		$iconClasses = array(tcs_sanitize_class(tcs_get_icon_classes($icon)));
		$iconData = '';

		if ($icon_animation && function_exists('react_get_animation_data')) {
			$iconClasses[] = react_get_animation_class($icon_animation);
			$iconData = ' ' . react_get_animation_data($icon_animation, $icon_animation_delay, $icon_animation_offset);
		}

		$icon = '<i class="' . esc_attr(tcs_sanitize_class($iconClasses)) . '"' . $iconData . '></i>';
	}

	if ($margin_top !== '') {
		$styles[] = 'margin-top:' . tcs_get_css_value($margin_top) . ';';
	}

	if ($margin_bottom !== '') {
		$styles[] = 'margin-bottom:' . tcs_get_css_value($margin_bottom) . ';';
	}

	if ($button_text != '') {
		$buttonClasses = array('tcs-impact-link');
		$buttonData = '';

		if ($button_animation && function_exists('react_get_animation_data')) {
			$buttonClasses[] = react_get_animation_class($button_animation);
			$buttonData = ' ' . react_get_animation_data($button_animation, $button_animation_delay, $button_animation_offset);
		}

		if ($button_link == '') {
			$button = '<span class="' . esc_attr(tcs_sanitize_class($buttonClasses)) . '"' . $buttonData . '><span>' . $button_text . '</span></span>';
			if (is_numeric($quform_id) && function_exists('iphorm_popup')) {
				$button = iphorm_popup($quform_id, $button);
			}
		} else {
			$button = '<a href="' . esc_url($button_link) . '" class="' . esc_attr(tcs_sanitize_class($buttonClasses)) . '"' . $buttonData . ($button_external == '1' ? ' target="_blank"' : '') . '><span>' . $button_text . '</span></a>';
		}
	}

	if ($stretched == '1') {
		$outerClasses[] = 'tcs-fullwidth';
	}

	if ($convert) {
		$outerClasses[] = tcs_prefix_classes($convert);
	}

	if ($hide) {
		$outerClasses[] = tcs_get_hide_class($hide);
	}

	if ($type) {
		$classes[] = tcs_prefix_classes($type);
	}

	if ($style) {
		$classes[] = tcs_prefix_classes($style);
	}

	$output = '<div' . ($id !== '' ? ' id="' . esc_attr($id) . '"' : '') . ' class="' . esc_attr(tcs_sanitize_class($outerClasses)) . '"' . (count($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') . '>';
	$output .= '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '">';

	switch ($type) {
		case 'only-heading':
		default:
			$output .= $icon . '<div class="tcs-impact-text-wrap"><' . esc_attr($tag) . ' class="tcs-impact-heading">' . do_shortcode($content) . '</' . esc_attr($tag) . '></div>';
			break;
		case 'heading-button':
		case 'heading-subheading-button':
			$output .= $icon . '<div class="tcs-impact-text-wrap"><' . esc_attr($tag) . ' class="tcs-impact-heading">' . do_shortcode($content) . '</' . esc_attr($tag) . '>' . ($type === 'heading-subheading-button' ? '<' . esc_attr($sub_tag) . ' class="tcs-impact-subheading">' . do_shortcode($subheading) . '</' . esc_attr($sub_tag) . '>' : '') . '</div>';
			$output .= '<div class="tcs-impact-header-link-wrap">';
			$output .= isset($button) ? $button : '';
			$output .= '</div>';
			break;
		case 'heading-subheading':
			$output .= $icon . '<div class="tcs-impact-text-wrap"><' . esc_attr($tag) . ' class="tcs-impact-heading">' . do_shortcode($content) . '</' . esc_attr($tag) . '><' . esc_attr($sub_tag) . ' class="tcs-impact-subheading">' . do_shortcode($subheading) . '</' . esc_attr($sub_tag) . '></div>';
			break;
	}

	$output .= '</div>'; // .tcs-impact-header-outer
	$output .= '</div>'; // .tcs-impact-header

	return $output;
}
add_shortcode('impact_header', 'tcs_shortcode_impact_header');

function tcs_render_shortcode_impact_header_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Impact header options', 'react-shortcodes'),
			'shortcode' => 'impact_header'
		),
		'options' => array(
			array(
				'name' => 'type',
				'label' => esc_html__('Type', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a layout', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'only-heading',
				'options' => array(
					'only-heading' => esc_html__('Only Heading', 'react-shortcodes'),
					'heading-button' => esc_html__('Heading & Button', 'react-shortcodes'),
					'heading-subheading' => esc_html__('Heading & Sub-heading', 'react-shortcodes'),
					'heading-subheading-button' => esc_html__('Heading, Sub-heading & Button', 'react-shortcodes')
				)
			),
			array(
				'label' => esc_html__('Heading', 'react-shortcodes'),
				'type' => 'multiple',
				'elements' => array(
					array(
						'label' => esc_html__('Heading text', 'react-shortcodes'),
						'name' => 'enclosed_content',
						'type' => 'text',
						'class' => 'tcas-width-300',
						'inline' => true
					),
					array(
						'name' => 'tag',
						'label' => esc_html__('Tag', 'react-shortcodes'),
						'tooltip' => esc_html__('Choose which HTML tag to use for the heading', 'react-shortcodes'),
						'type' => 'select',
						'default' => 'h2',
						'options' => tcs_get_header_tag_options(),
						'inline' => true
					)
				)
			),
			array(
				'label' => esc_html__('Sub-heading', 'react-shortcodes'),
				'type' => 'multiple',
				'elements' => array(
					array(
						'label' => esc_html__('Sub-heading text', 'react-shortcodes'),
						'name' => 'subheading',
						'type' => 'text',
						'class' => 'tcas-width-300',
						'inline' => true
					),
					array(
						'name' => 'sub_tag',
						'label' => esc_html__('Tag', 'react-shortcodes'),
						'tooltip' => esc_html__('Choose which HTML tag to use for the sub-heading', 'react-shortcodes'),
						'type' => 'select',
						'default' => 'h4',
						'options' => tcs_get_header_tag_options(),
						'inline' => true
					)
				)
			),
			array(
				'name' => 'button_text',
				'label' => esc_html__('Button text', 'react-shortcodes'),
				'type' => 'text',
				'class' => 'tcas-width-200'
			),
			array(
				'name' => 'button_link',
				'label' => esc_html__('Button link', 'react-shortcodes'),
				'tooltip' => esc_html__('Add the link URL including http://', 'react-shortcodes'),
				'description' => esc_html__('The URL that the button should link to', 'react-shortcodes'),
				'type' => 'text',
				'class' => 'tcas-width-300'
			),
			array(
				'name' => 'button_external',
				'label' => esc_html__('Button link opens new tab/window', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			tcs_get_extended_animation_options('button_animation', 'flipInX'),
			array(
				'name' => 'quform_id',
				'label' => esc_html__('Link button to Quform popup form', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'none',
				'options' => tcs_get_quform_forms_options(false, 'none')
			),
			array(
				'name' => 'style',
				'label' => esc_html__('Color / style', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a color', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'color',
				'options' => array(
					'color' => esc_html__('Primary', 'react-shortcodes'),
					'light' => esc_html__('Light', 'react-shortcodes'),
					'dark' => esc_html__('Dark', 'react-shortcodes'),
					'color no-shadow' => esc_html__('Primary with no 3D effect', 'react-shortcodes'),
					'light no-shadow' => esc_html__('Light with no 3D effect', 'react-shortcodes'),
					'dark no-shadow' => esc_html__('Dark with no 3D effect', 'react-shortcodes')
				)
			),
			array(
				'name' => 'margin_top',
				'label' => esc_html__('Top margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '10',
				'slider' => array('from' => -100, 'to' => 800, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'margin_bottom',
				'label' => esc_html__('Bottom margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '10',
				'slider' => array('from' => -100, 'to' => 800, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'convert',
				'label' => esc_html__('Convert point', 'react-shortcodes'),
				'tooltip' => esc_html__('When to swap to a more optimum layout for smaller screens', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'cvt-tablet-ptr',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'cvt-phone-ptr' => esc_html__('Phone Portrait', 'react-shortcodes'),
					'cvt-phone-ldsp' => esc_html__('Phone Landscape', 'react-shortcodes'),
					'cvt-tablet-ptr' => esc_html__('Tablet Portrait', 'react-shortcodes'),
					'cvt-tablet-ldsp' => esc_html__('Tablet Landscape', 'react-shortcodes'),
					'cvt-always' => esc_html__('Always', 'react-shortcodes')
				)
			),
			array(
				'name' => 'hide',
				'label' => esc_html__('Hide on device(s)', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose to hide this shortcode on device(s)', 'react-shortcodes'),
				'type' => 'multiselect',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'hide-phone-ptr' => esc_html__('Phone portrait', 'react-shortcodes'),
					'hide-phone' => esc_html__('Phone landscape', 'react-shortcodes'),
					'hide-tablet-ptr' => esc_html__('Tablet portrait', 'react-shortcodes'),
					'hide-tablet' => esc_html__('Tablet landscape', 'react-shortcodes'),
					'hide-desktop' => esc_html__('Desktop', 'react-shortcodes'),
					'hide-large' => esc_html__('Large', 'react-shortcodes')
				)
			),
			array(
				'name' => 'stretched',
				'label' => esc_html__('Stretched', 'react-shortcodes'),
				'tooltip' => esc_html__('Element width stretched to the edges of the page content area', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'icon',
				'label' => esc_html__('Icon', 'react-shortcodes'),
				'type' => 'icon',
				'default' => '',
				'subset' => 'fonts' // FontAwesome only
			),
			tcs_get_extended_animation_options('icon_animation', 'fadeInUp'),
			array(
				'name' => 'id',
				'label' => esc_html__('Header ID', 'react-shortcodes'),
				'description' => esc_html__('This will set the id attribute to allow you to make anchor links to this header.', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  BLOCK
 */
function tcs_shortcode_block($atts, $content = '')
{
	$options = shortcode_atts(array(
		'id' => '',
		'class' => '',
		'align' => '',
		'text_align' => '',
		'text_align_convert_device' => '',
		'text_align_convert_align' => '',
		'rounded' => '',
		'shadow' => '',
		'child_hover' => '',
		'convert' => '',
		'arrow' => '',
		'border' => '',
		'inside_max_width' => '0',
		'width' => '',
		'custom_width' => '',
		'margin_top' => '',
		'margin_bottom' => '',
		'padding_top' => '40',
		'padding_bottom' => '40',
		'padding_right' => '40',
		'padding_left' => '40',
		'padding_top_tablet' => '',
		'padding_bottom_tablet' => '',
		'padding_right_tablet' => '',
		'padding_left_tablet' => '',
		'padding_top_phone' => '',
		'padding_bottom_phone' => '',
		'padding_right_phone' => '20',
		'padding_left_phone' => '20',
		'palette' => '',
		'texture' => 'none',
		'texture_opacity' => '20',
		'texture_large' => '0',
		'texture_fixed' => '0',
		'detail' => 'none',
		'detail_opacity' => '20',
		'image' => '',
		'image_use_feat' => false,
		'image_width' => '',
		'image_height' => '',
		'image_retina_use_main_img' => 'never',
		'image_retina' => '',
		'image_retina_width' => '',
		'image_retina_height' => '',
		'image_is_retina' => '0',
		'image_convert' => 'box-width',
		'image_convert_custom' => '1000',
		'image_position' => 'center top',
		'image_position_custom' => '',
		'image_repeat' => 'no-repeat',
		'image_fixed' => '0',
		'image_background_size' => '',
		'image_position_retina' => 'center top',
		'image_position_custom_retina' => '',
		'image_repeat_retina' => 'no-repeat',
		'image_fixed_retina' => '0',
		'image_background_size_retina' => '',
		'image_parallax' => '1',
		'image_parallax_offset' => '0',
		'hide' => '',
		'use_screen_as_min_height' => '0',
		'min_height' => '',
		'scroll' => 0,
		'use_screen_as_fixed_height' => '0',
		'vertical_align_middle' => 0,
		'fixed_height' => '400',
		'fixed_height_tablet' => '',
		'fixed_height_phone' => '',
		'hover_animation' => '',
		'animation' => '',
		'animation_delay' => '',
		'animation_offset' => ''
	), $atts);

	extract($options);

	static $internalBlockId = 0;
	$internalBlockId++;
	$internalBlockClass = 'tcs-block-' .  $internalBlockId;

	$classes = array('tcs-block-outer', $internalBlockClass, 'tcs-clearfix');
	$styles = array();

	if ($align) {
		$classes[] = tcs_prefix_classes("block-align-$align");
	}

	if ($text_align_convert_device && $text_align_convert_align) {
		$classes[] = tcs_prefix_classes($text_align_convert_device . '-text-' . $text_align_convert_align);
	}

	if ($hover_animation) {
		$classes[] = $hover_animation;
	}

	if ($rounded) {
		$classes[] = tcs_prefix_classes($rounded);
	}

	if ($shadow) {
		$classes[] = tcs_prefix_classes($shadow);
	}

	if ($child_hover) {
		$classes[] = tcs_prefix_classes($child_hover);
	}

	if ($convert) {
		$classes[] = tcs_prefix_classes($convert);
	}

	if ($arrow) {
		$classes[] = tcs_prefix_classes($arrow);
	}

	if ($border) {
		$classes[] = tcs_prefix_classes($border);
	}

	if ($class) {
		$classes[] = $class;
	}

	if ($width != '') {
		if ($width == 'custom') {
			if ($custom_width != '') {
				$styles[] = 'width: ' . tcs_get_css_value($custom_width) . '; max-width: 100%;';
			}
		} else {
			if ($width == 'stretched') {
				$classes[] = 'tcs-fullwidth';
			} else if ($width == 'viewport') {
				$classes[] = 'tcs-viewport-width';
			} else if ($width == 'outer') {
				$classes[] = 'tcs-outer-width';
			}

			if ($inside_max_width == '1') {
				$classes[] = 'tcs-max-width';
			}
		}
	}

	$margin = array();
	if ($margin_top !== '') {
		$margin[] = 'margin-top:' . tcs_get_css_value($margin_top) . ';';
	}

	if ($margin_bottom !== '') {
		$margin[] = 'margin-bottom:' . tcs_get_css_value($margin_bottom) . ';';
	}

	if ($palette !== '') {
		$classes[] = "custom-palette-$palette";
	}

	$padding = array();
	if ($padding_top != '40' && $padding_top !== '') {
		$padding[] = 'padding-top:' . tcs_get_css_value($padding_top) . ';';
	}

	if ($padding_right != '40' && $padding_right !== '') {
		$padding[] = 'padding-right:' . tcs_get_css_value($padding_right) . ';';
	}

	if ($padding_bottom != '40' && $padding_bottom !== '') {
		$padding[] = 'padding-bottom:' . tcs_get_css_value($padding_bottom) . ';';
	}

	if ($padding_left != '40' && $padding_left !== '') {
		$padding[] = 'padding-left:' . tcs_get_css_value($padding_left) . ';';
	}

	$paddingTablet = array();
	if ($padding_top_tablet !== '') {
		$paddingTablet[] = 'padding-top:' . tcs_get_css_value($padding_top_tablet) . ';';
	}

	if ($padding_right_tablet !== '') {
		$paddingTablet[] = 'padding-right:' . tcs_get_css_value($padding_right_tablet) . ';';
	}

	if ($padding_bottom_tablet !== '') {
		$paddingTablet[] = 'padding-bottom:' . tcs_get_css_value($padding_bottom_tablet) . ';';
	}

	if ($padding_left_tablet !== '') {
		$paddingTablet[] = 'padding-left:' . tcs_get_css_value($padding_left_tablet) . ';';
	}

	$paddingPhone = array();
	if ($padding_top_phone !== '') {
		$paddingPhone[] = 'padding-top:' . tcs_get_css_value($padding_top_phone) . ';';
	}

	if ($padding_right_phone !== '') {
		$paddingPhone[] = 'padding-right:' . tcs_get_css_value($padding_right_phone) . ';';
	}

	if ($padding_bottom_phone !== '') {
		$paddingPhone[] = 'padding-bottom:' . tcs_get_css_value($padding_bottom_phone) . ';';
	}

	if ($padding_left_phone !== '') {
		$paddingPhone[] = 'padding-left:' . tcs_get_css_value($padding_left_phone) . ';';
	}

	if ($texture && $texture != 'none') {
		$classes[] = tcs_prefix_classes($texture);
	}

	if ($detail && $detail != 'none') {
		$classes[] = tcs_prefix_classes($detail . '-' . $detail_opacity);
	}

	if ($hide) {
		$classes[] = tcs_get_hide_class($hide);
	}

	if ($use_screen_as_min_height == '1') {
		$classes[] = 'tcs-device-min-height';
	}

	if ($image_parallax != '1') {
		$options['image_fixed'] = '1';
	}

	if ($text_align) {
		$classes[] = tcs_prefix_classes($text_align);
	}

	if ($animation && function_exists('react_get_animation_data')) {
		$classes[] = react_get_animation_class($animation);
		$animationData = react_get_animation_data($animation, $animation_delay, $animation_offset);
	}

	$css = '';

	if ($scroll == '1') {
		$classes[] = 'tcs-scroll';
		if ($use_screen_as_fixed_height == '1') {
			$classes[] = 'tcs-device-fixed-height';
		} else {
			if (is_numeric($fixed_height)) {
				$css .= '.' . $internalBlockClass . ' > .tcs-block-inner { height: ' . $fixed_height . 'px; }' . "\n";
			}

			if (is_numeric($fixed_height_tablet)) {
				$css .= '@media only screen and (max-width: 1024px) { .' . $internalBlockClass . ' > .tcs-block-inner { height: ' . $fixed_height_tablet . 'px; }}' . "\n";
			}

			if (is_numeric($fixed_height_phone)) {
				$css .= '@media only screen and (max-width: 568px) { .' . $internalBlockClass . ' > .tcs-block-inner { height: ' . $fixed_height_phone . 'px; }}' . "\n";
			}
		}

		if ($vertical_align_middle == '1') {
			$innerStyles[] = 'display: table; width: 100%;';
			$wrapStyles[] = 'display: table-cell; vertical-align: middle;';
		}
	}

	$wrapStyles[] = ($use_screen_as_min_height == '0' && $min_height) ? ' min-height: ' . $min_height . 'px;' : '';

	$styles = !empty($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '';
	$wrapStyles = !empty($wrapStyles) ? ' style="' . esc_attr(join('', $wrapStyles)) . '"' : '';
	$innerStyles = !empty($innerStyles) ? ' style="' . esc_attr(join('', $innerStyles)) . '"' : '';

	if (count($margin)) {
		$css .= '.' . $internalBlockClass . ' { ' . esc_attr(join('', $margin)) . ' }' . "\n";
	}

	if (count($padding)) {
		$css .= '.' . $internalBlockClass . ' > .tcs-block-inner > .tcs-block-wrap { ' . esc_attr(join('', $padding)) . ' }' . "\n";
	}

	if (count($paddingTablet)) {
		$css .= '@media only screen and (max-width: 1024px) { .' . $internalBlockClass . ' > .tcs-block-inner > .tcs-block-wrap { ' . esc_attr(join('', $paddingTablet)) . ' }}' . "\n";
	}

	if (count($paddingPhone)) {
		$css .= '@media only screen and (max-width: 568px) { .' . $internalBlockClass . ' > .tcs-block-inner > .tcs-block-wrap { ' . esc_attr(join('', $paddingPhone)) . ' }}' . "\n";
	}

	$options['image'] = tcs_get_upload_url($options['image']);
	$options['image_retina'] = tcs_get_upload_url($options['image_retina']);

	$css .= tcs_get_texture_detail_css($options, '.' . $internalBlockClass);

	if ($css) {
		$css = '<style type="text/css" scoped>' . $css . '</style>';
	}

	return '<div' . ($id ? ' id="' . esc_attr($id) . '"' : '') . ' class="' . esc_attr(tcs_sanitize_class($classes)) . '"' . $styles . ($image_parallax != '1' ? ' data-stellar-background-ratio="' . esc_attr($image_parallax) . '" data-stellar-vertical-offset="' . esc_attr($image_parallax_offset) . '"' : '') . (isset($animationData) ? ' ' . $animationData : '') . '>' . $css . '<div class="tcs-block-inner tcs-clearfix"' . $innerStyles . '><div' . $wrapStyles . ' class="tcs-block-wrap tcs-clearfix">' . do_shortcode($content) . '</div></div></div>';
}
add_shortcode('block', 'tcs_shortcode_block');

// Nested block support
foreach (range(1, 5) as $n) {
	add_shortcode('block' . $n, 'tcs_shortcode_block');
}

function tcs_render_shortcode_block_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Block options', 'react-shortcodes'),
			'shortcode' => 'block'
		),
		'options' => array(
			array(
				'name' => 'id',
				'label' => esc_html__('Block ID', 'react-shortcodes'),
				'description' => esc_html__('This will set the id attribute to allow you to make anchor links to this block.', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			),
			array(
				'name' => 'class',
				'label' => esc_html__('Custom classes', 'react-shortcodes'),
				'description' => esc_html__('Add additional classes to the Block outer wrapper', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			),
			array(
				'type' => 'custom_toggle',
				'id' => 'tcas-toggle-sc-styles-color',
				'content' => esc_html__('Styles and color', 'react-shortcodes')
			),
			array(
				'type' => 'div_open',
				'class' => 'tcas-sc-wrap-styles-color'
			),
			array(
				'name' => 'align',
				'label' => esc_html__('Align', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'none',
				'options' => array(
					'none' => esc_html__('None', 'react-shortcodes'),
					'left' => esc_html__('Left', 'react-shortcodes'),
					'center' => esc_html__('Center', 'react-shortcodes'),
					'right' => esc_html__('Right', 'react-shortcodes')
				)
			),
			array(
				'name' => 'text_align',
				'label' => esc_html__('Text align', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Default', 'react-shortcodes'),
					'textleft' => esc_html__('Left', 'react-shortcodes'),
					'textcenter' => esc_html__('Center', 'react-shortcodes'),
					'textright' => esc_html__('Right', 'react-shortcodes')
				)
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Mobile text align', 'react-shortcodes'),
				'description' => esc_html__('Change the text alignment for smaller devices.', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'text_align_convert_device',
						'label' => esc_html__('Device', 'react-shortcodes'),
						'type' => 'select',
						'default' => '',
						'inline' => true,
						'options' => array(
							'' => esc_html__('None', 'react-shortcodes'),
							'phone' => esc_html__('Phone', 'react-shortcodes'),
							'tablet' => esc_html__('Tablet', 'react-shortcodes'),
							'mobile' => esc_html__('All mobile devices', 'react-shortcodes')
						)
					),
					array(
						'name' => 'text_align_convert_align',
						'label' => esc_html__('Align', 'react-shortcodes'),
						'type' => 'select',
						'default' => '',
						'inline' => true,
						'options' => array(
							'' => esc_html__('None', 'react-shortcodes'),
							'left' => esc_html__('Left', 'react-shortcodes'),
							'center' => esc_html__('Center', 'react-shortcodes'),
							'right' => esc_html__('Right', 'react-shortcodes')
						)
					)
				)
			),
			array(
				'name' => 'rounded',
				'label' => esc_html__('Rounded', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'page-rounded' => esc_html__('Page Rounded (page radius)', 'react-shortcodes'),
					'rounded' => esc_html__('Rounded (element radius)', 'react-shortcodes')
				)
			),
			array(
				'name' => 'shadow',
				'label' => esc_html__('Shadow', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'dropshadow' => esc_html__('Drop shadow', 'react-shortcodes'),
					'dropshadow-hover-off' => esc_html__('Drop shadow off on hover', 'react-shortcodes'),
					'dropshadow-hover' => esc_html__('Drop shadow on hover', 'react-shortcodes'),
					'dropshadow-bottom' => esc_html__('Bottom drop shadow', 'react-shortcodes'),
					'dropshadow-bottom-hover-off' => esc_html__('Bottom drop shadow off on hover', 'react-shortcodes'),
					'dropshadow-bottom-hover' => esc_html__('Bottom drop shadow on hover', 'react-shortcodes'),
					'dropshadow-spread' => esc_html__('Spread drop shadow', 'react-shortcodes'),
					'dropshadow-spread-hover-off' => esc_html__('Spread drop shadow off on hover', 'react-shortcodes'),
					'dropshadow-spread-hover' => esc_html__('Spread drop shadow on hover', 'react-shortcodes')
				)
			),
			array(
				'name' => 'arrow',
				'label' => esc_html__('Arrow', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'arrow' => esc_html__('Top Center', 'react-shortcodes'),
					'arrow left' => esc_html__('Top Left', 'react-shortcodes'),
					'arrow right' => esc_html__('Top Right', 'react-shortcodes'),
					'arrow bottom' => esc_html__('Bottom Center', 'react-shortcodes'),
					'arrow bottom left' => esc_html__('Bottom Left', 'react-shortcodes'),
					'arrow bottom right' => esc_html__('Bottom Right', 'react-shortcodes'),
					'arrow on-left' => esc_html__('Left Center', 'react-shortcodes'),
					'arrow on-left side-top' => esc_html__('Left Top', 'react-shortcodes'),
					'arrow on-left side-bottom' => esc_html__('Left Bottom', 'react-shortcodes'),
					'arrow on-right' => esc_html__('Right Center', 'react-shortcodes'),
					'arrow on-right side-top' => esc_html__('Right Top', 'react-shortcodes'),
					'arrow on-right side-bottom' => esc_html__('Right Bottom', 'react-shortcodes')
				)
			),
			array(
				'name' => 'border',
				'label' => esc_html__('Border', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'border' => esc_html__('Full', 'react-shortcodes'),
					'border b-lr' => esc_html__('Left / right only', 'react-shortcodes'),
					'border b-tb' => esc_html__('Top / bottom only', 'react-shortcodes')
				)
			),
			tcs_get_custom_palette_options('palette', esc_html__('Color palette', 'react-shortcodes'), esc_html__('Choose a color palette. You can create these at Theme Options &rarr; Design &rarr; Colors', 'react-shortcodes')),
			array(
				'type' => 'div_close' // .tcas-sc-wrap-styles-color
			),
			array(
				'type' => 'custom_toggle',
				'id' => 'tcas-toggle-sc-animations',
				'content' => esc_html__('Animations', 'react-shortcodes')
			),
			array(
				'type' => 'div_open',
				'class' => 'tcas-sc-wrap-animations'
			),
			tcs_get_hover_animation_options(),
			tcs_get_extended_animation_options(),
			array(
				'name' => 'child_hover',
				'label' => esc_html__('Show nested block on hover', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'child-overlay' => esc_html__('I am the parent Block', 'react-shortcodes'),
					'child-fixed' => esc_html__('Fade me in', 'react-shortcodes'),
					'child-fixed fade-in-down-child' => esc_html__('Fade me in down', 'react-shortcodes'),
					'child-fixed fade-in-up-child' => esc_html__('Fade me in up', 'react-shortcodes')
				)
			),
			array(
				'name' => 'convert',
				'label' => esc_html__('Convert nested block on hover', 'react-shortcodes'),
				'tooltip' => esc_html__('Touch devices can not hover', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'cvt-phone-ptr' => esc_html__('Phone Portrait', 'react-shortcodes'),
					'cvt-phone-ldsp' => esc_html__('Phone Landscape', 'react-shortcodes'),
					'cvt-tablet-ptr' => esc_html__('Tablet Portrait', 'react-shortcodes'),
					'cvt-tablet-ldsp' => esc_html__('Tablet Landscape', 'react-shortcodes')
				)
			),
			array(
				'type' => 'div_close' // tcas-sc-wrap-animations
			),
			array(
				'type' => 'custom_toggle',
				'id' => 'tcas-toggle-sc-dimensions',
				'content' => esc_html__('Dimensions', 'react-shortcodes')
			),
			array(
				'type' => 'div_open',
				'class' => 'tcas-sc-wrap-dimensions'
			),
			array(
				'name' => 'width',
				'type' => 'select',
				'label' => esc_html__('Width', 'react-shortcodes'),
				'default' => '',
				'options' => array(
					'' => esc_html__('Default (fills the content area)', 'react-shortcodes'),
					'stretched' => esc_html__('Stretched to the edges of the content area', 'react-shortcodes'),
					'viewport' => esc_html__('Stretched to the edges of the viewport', 'react-shortcodes'),
					'outer' => esc_html__('Stretched to the outer edges of the content on Fluid and Box Inner layouts', 'react-shortcodes'),
					'custom' => esc_html__('Custom width', 'react-shortcodes')
				),
				'unavailable' => esc_html__('The stretched options require the React theme.', 'react-shortcodes')
			),
			array(
				'name' => 'custom_width',
				'label' => esc_html__('Custom width', 'react-shortcodes'),
				'description' => esc_html__('The CSS width of the block, e.g. 200px or 25%.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-60'
			),
			array(
				'name' => 'inside_max_width',
				'label' => esc_html__('Use page max width', 'react-shortcodes'),
				'description' => esc_html__('Adds the page max width to the content of the block. This will allow the Block to be fluid but with a fixed width content area.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn',
				'unavailable' => true
			),
			array(
				'name' => 'margin_top',
				'label' => esc_html__('Top margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => -500, 'to' => 1200, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'margin_bottom',
				'label' => esc_html__('Bottom margin', 'react-shortcodes'),
				'tooltip' => esc_html__('Enter a value in pixels', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => -500, 'to' => 1200, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Padding', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'padding_top',
						'label' => esc_html__('Top', 'react-shortcodes'),
						'type' => 'number',
						'default' => '40',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'padding_right',
						'label' => esc_html__('Right', 'react-shortcodes'),
						'type' => 'number',
						'default' => '40',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'padding_bottom',
						'label' => esc_html__('Bottom', 'react-shortcodes'),
						'type' => 'number',
						'default' => '40',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'padding_left',
						'label' => esc_html__('Left', 'react-shortcodes'),
						'type' => 'number',
						'default' => '40',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					)
				)
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Padding on tablets', 'react-shortcodes'),
				'tooltip' => esc_html__('An empty value will inherit the padding from the value above.', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'padding_top_tablet',
						'label' => esc_html__('Top', 'react-shortcodes'),
						'type' => 'number',
						'default' => '',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'padding_right_tablet',
						'label' => esc_html__('Right', 'react-shortcodes'),
						'type' => 'number',
						'default' => '',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'padding_bottom_tablet',
						'label' => esc_html__('Bottom', 'react-shortcodes'),
						'type' => 'number',
						'default' => '',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'padding_left_tablet',
						'label' => esc_html__('Left', 'react-shortcodes'),
						'type' => 'number',
						'default' => '',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					)
				)
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Padding on phones', 'react-shortcodes'),
				'tooltip' => esc_html__('An empty value will inherit the padding from the value above.', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'padding_top_phone',
						'label' => esc_html__('Top', 'react-shortcodes'),
						'type' => 'number',
						'default' => '',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'padding_right_phone',
						'label' => esc_html__('Right', 'react-shortcodes'),
						'type' => 'number',
						'default' => '20',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'padding_bottom_phone',
						'label' => esc_html__('Bottom', 'react-shortcodes'),
						'type' => 'number',
						'default' => '',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'padding_left_phone',
						'label' => esc_html__('Left', 'react-shortcodes'),
						'type' => 'number',
						'default' => '20',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					)
				)
			),
			array(
				'name' => 'use_screen_as_min_height',
				'label' => esc_html__('Use screen height as min height', 'react-shortcodes'),
				'tooltip' => esc_html__('The minimum height of the block will be set to the screen height', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn',
				'unavailable' => true
			),
			array(
				'name' => 'min_height',
				'label' => esc_html__('Custom min height', 'react-shortcodes'),
				'description' => esc_html__('Add a min-height attribute to a value of your choice, e.g. 200px.', 'react-shortcodes'),
				'type' => 'number',
				'class' => 'tcas-width-60',
				'default' => '',
				'unit' => 'px'
			),

			array(
				'name' => 'scroll',
				'label' => esc_html__('Fixed height', 'react-shortcodes'),
				'tooltip' => esc_html__('Set a fixed height and content inside will be scrollable', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'use_screen_as_fixed_height',
				'label' => esc_html__('Use screen height as height', 'react-shortcodes'),
				'tooltip' => esc_html__('The height of the block will be set to the screen height', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn',
				'unavailable' => true
			),
			array(
				'label' => esc_html__('Height', 'react-shortcodes'),
				'type' => 'multiple',
				'elements' => array(
					array(
						'name' => 'fixed_height',
						'label' => esc_html__('Desktop', 'react-shortcodes'),
						'type' => 'number',
						'default' => '400',
						'class' => 'tcas-width-50',
						'inline' => true,
						'unit' => 'px'
					),
					array(
						'name' => 'fixed_height_tablet',
						'label' => esc_html__('Tablet', 'react-shortcodes'),
						'tooltip' => esc_html__('If left blank the value will be inherited from the value on the left.', 'react-shortcodes'),
						'type' => 'number',
						'default' => '',
						'class' => 'tcas-width-50',
						'inline' => true,
						'unit' => 'px'
					),
					array(
						'name' => 'fixed_height_phone',
						'label' => esc_html__('Phone', 'react-shortcodes'),
						'tooltip' => esc_html__('If left blank the value will be inherited from the value on the left.', 'react-shortcodes'),
						'type' => 'number',
						'default' => '',
						'class' => 'tcas-width-50',
						'inline' => true,
						'unit' => 'px'
					),
				)
			),
			array(
				'name' => 'vertical_align_middle',
				'label' => esc_html__('Vertically align middle', 'react-shortcodes'),
				'tooltip' => esc_html__('This will make the content align in the middle of the fixed height block', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'type' => 'div_close' // tcas-sc-wrap-dimensions
			),
			array(
				'type' => 'custom_toggle',
				'id' => 'tcas-toggle-sc-textures-background',
				'content' => esc_html__('Background textures', 'react-shortcodes')
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Background texture', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a style to be applied to this section or add your own in the options further down', 'react-shortcodes'),
				'wrap_class' => 'tcas-sc-texture-wrap-background',
				'elements' => array(
					array(
						'name' => 'texture',
						'type' => 'select',
						'default' => 'none',
						'options' => tcs_get_texture_options(),
						'class' => 'tcas-texture-select'
					),
					array(
						'name' => 'texture_opacity',
						'label' => esc_html__('Opacity level', 'react-shortcodes'),
						'type' => 'slider',
						'default' => '20',
						'slider' => array('from' => 10, 'to' => 50, 'step' => 10, 'dimension' => '%')
					),
					array(
						'name' => 'texture_fixed',
						'label' => esc_html__('Fixed', 'react-shortcodes'),
						'type' => 'toggle',
						'default' => '0',
						'toggle' => 'yn'
					),
					array(
						'name' => 'texture_large',
						'label' => esc_html__('Use double size for non retina displays', 'react-shortcodes'),
						'tooltip' => esc_html__('By default the background image will be the same size for both hand held devices and for laptops / desktops. By selecting Yes here the background image will be double the size for screens larger than tablets.', 'react-shortcodes'),
						'type' => 'toggle',
						'default' => '0',
						'toggle' => 'yn'
					)
				)
			),
			array(
				'type' => 'custom_toggle',
				'id' => 'tcas-toggle-sc-details-background',
				'content' => esc_html__('Background details', 'react-shortcodes')
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Background detail', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a style to be applied to this section or add your own in the options further down', 'react-shortcodes'),
				'wrap_class' => 'tcas-sc-detail-wrap-background',
				'elements' => array(
					array(
						'name' => 'detail',
						'type' => 'select',
						'default' => 'none',
						'options' => tcs_get_detail_options(),
						'class' => 'tcas-detail-select'
					),
					array(
						'name' => 'detail_opacity',
						'label' => esc_html__('Opacity level', 'react-shortcodes'),
						'type' => 'slider',
						'default' => '20',
						'slider' => array('from' => 10, 'to' => 50, 'step' => 10, 'dimension' => '%')
					)
				)
			),
			array(
				'type' => 'custom_toggle',
				'id' => 'tcas-toggle-sc-custom-background',
				'content' => esc_html__('Custom background', 'react-shortcodes')
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Background image', 'react-shortcodes'),
				'tooltip' => esc_html__('Add your own image background for this block. By adding a background image here you can now only use either the Texture or the Detail. Texture has priority if both are selected.', 'react-shortcodes'),
				'wrap_class' => 'tcas-sc-image-wrap-background',
				'elements' => array(
					array(
						'type' => 'clear'
					),
					array(
						'name' => 'image',
						'label' => esc_html__('Image URL', 'react-shortcodes'),
						'type' => 'text_upload',
						'default' => '',
						'class' => 'tcas-width-350',
						'inline' => true,
						'id' => 'tcas-block-sc-image_browse'
					),
					array(
						'name' => 'image_width',
						'label' => esc_html__('Width', 'react-shortcodes'),
						'type' => 'number',
						'default' => '',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'image_height',
						'label' => esc_html__('Height', 'react-shortcodes'),
						'type' => 'number',
						'default' => '',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'type' => 'clear'
					),
					array(
						'name' => 'image_retina_use_main_img',
						'label' => esc_html__('What would you like to do for smaller screens and/or Retina devices?', 'react-shortcodes'),
						'tooltip' => esc_html__('Choose an option for smaller screens and/or Retina devices', 'react-shortcodes'),
						'type' => 'select',
						'default' => 'never',
						'options' => tcs_get_retina_use_main_img_options()
					),
					array(
						'type' => 'div_open',
						'class' => 'image_retina_use_main_img_is_yes'
					),
					array(
						'name' => 'image_retina',
						'label' => esc_html__('Alternative or Retina image URL', 'react-shortcodes'),
						'type' => 'text_upload',
						'default' => '',
						'class' => 'tcas-width-400',
						'inline' => true,
						'id' => 'tcas-block-sc-image_retina_browse'
					),
					array(
						'name' => 'image_retina_width',
						'label' => esc_html__('Width', 'react-shortcodes'),
						'type' => 'number',
						'default' => '',
						'class' => 'tcas-width-50',
						'inline' => true,
						'unit' => 'px'
					),
					array(
						'name' => 'image_retina_height',
						'label' => esc_html__('Height', 'react-shortcodes'),
						'type' => 'number',
						'default' => '',
						'class' => 'tcas-width-50',
						'inline' => true,
						'unit' => 'px'
					),
					array(
						'type' => 'holder',
						'key' => 'image_retina',
						'id' => 'image_retina_holder',
						'inline' => true
					),
					array(
						'type' => 'clear'
					),
					array(
						'name' => 'image_is_retina',
						'label' => esc_html__('Is this a retina ready image?', 'react-shortcodes'),
						'tooltip' => esc_html__('The Retina ready image will be used at 50% size, so the image you upload must be double the actual size required. If you do not require a Retina ready image and are using this as an alternative device image, select NO.', 'react-shortcodes'),
						'type' => 'toggle',
						'default' => '0',
						'toggle' => 'yn'
					),
					array(
						'type' => 'div_close' // .image_retina_use_main_img_is_yes
					),
					array(
						'type' => 'div_open',
						'class' => 'image_retina_use_main_img_is_yes_or tcas-clearfix'
					),
					array(
						'name' => 'image_convert',
						'label' => esc_html__('When would you like to start using this image?', 'react-shortcodes'),
						'tooltip' => esc_html__('Choose which viewport size to start showing the new image', 'react-shortcodes'),
						'type' => 'select',
						'default' => 'box-width',
						'options' => tcs_get_convert_options(),
						'inline' => true
					),
					array(
						'name' => 'image_convert_custom',
						'type' => 'slider',
						'default' => 1000,
						'slider' => array('from' => 0, 'to' => 5000, 'step' => 1, 'dimension' => 'px'),
						'inline' => true,
						'wrap_class' => 'tcas-custom-convert-wrap'
					),
					array(
						'type' => 'clear'
					),
					array(
						'type' => 'div_close' // .image_retina_use_main_img_is_yes_or
					),
					array(
						'type' => 'custom_toggle',
						'id' => 'tcas-toggle-sc-manage-display',
						'content' => esc_html__('Manage the display settings for this background image', 'react-shortcodes')
					),
					array(
						'type' => 'div_open',
						'class' => 'tcas-sc-wrap-manage-display'
					),
					array(
						'type' => 'div_open',
						'class' => 'tcas-background-image-settings'
					),
					array(
						'type' => 'label',
						'content' => esc_html__('Main image', 'react-shortcodes')
					),
					array(
						'name' => 'image_position',
						'type' => 'select',
						'default' => 'center top',
						'options' => tcs_get_background_position_options(),
						'class' => 'tcas-bg-position-select',
						'inline' => true
					),
					array(
						'name' => 'image_repeat',
						'type' => 'select',
						'default' => 'no-repeat',
						'options' => tcs_get_background_repeat_options(),
						'class' => 'tcas-bg-repeat-select',
						'inline' => true
					),
					array(
						'type' => 'clear'
					),
					array(
						'name' => 'image_position_custom',
						'label' => esc_html__('Custom value', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'tooltip' => esc_html__('The background-position property specifies the position of the background image. Examples: "95% 95%" or "300px 500px"', 'react-shortcodes'),
						'class' => 'tcas-image-position-custom tcas-width-100'
					),
					array(
						'name' => 'image_fixed',
						'label' => esc_html__('Fixed', 'react-shortcodes'),
						'type' => 'toggle',
						'default' => '0',
						'toggle' => 'yn'
					),
					array(
						'name' => 'image_background_size',
						'label' => esc_html__('Background size', 'react-shortcodes'),
						'tooltip' => esc_html__('The background-size property specifies the size of the background image. Examples: "100% auto" or "300px 500px"', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'class' => 'tcas-width-100',
						'inline' => true,
						'placeholder' => 'auto auto'
					),
					array(
						'type' => 'div_close' // .tcas-background-image-settings
					),
					array(
						'type' => 'div_open',
						'class' => 'tcas-background-image-retina-settings'
					),
					array(
						'type' => 'label',
						'content' => esc_html__('Device image', 'react-shortcodes')
					),
					array(
						'name' => 'image_position_retina',
						'type' => 'select',
						'default' => 'center top',
						'options' => tcs_get_background_position_options(),
						'class' => 'tcas-bg-position-select',
						'inline' => true
					),
					array(
						'name' => 'image_repeat_retina',
						'type' => 'select',
						'default' => 'no-repeat',
						'options' => tcs_get_background_repeat_options(),
						'class' => 'tcas-bg-repeat-select',
						'inline' => true
					),
					array(
						'type' => 'clear'
					),
					array(
						'name' => 'image_position_custom_retina',
						'label' => esc_html__('Custom value', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'tooltip' => esc_html__('The background-position property specifies the position of the background image. Examples: "95% 95%" or "300px 500px"', 'react-shortcodes'),
						'class' => 'tcas-image-position-custom tcas-width-100'
					),
					array(
						'name' => 'image_fixed_retina',
						'label' => esc_html__('Fixed', 'react-shortcodes'),
						'type' => 'toggle',
						'default' => '0',
						'toggle' => 'yn'
					),
					array(
						'name' => 'image_background_size_retina',
						'label' => esc_html__('Background size', 'react-shortcodes'),
						'tooltip' => esc_html__('The background-size property specifies the size of the background image. Examples: "100% auto" or "300px 500px"', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'class' => 'tcas-width-100',
						'inline' => true,
						'placeholder' => 'auto auto'
					),
					array(
						'type' => 'div_close' // .tcas-background-image-retina-settings
					),
					array(
						'type' => 'clear'
					),
					array(
						'name' => 'image_parallax',
						'label' => esc_html__('Parallax ratio', 'react-shortcodes'),
						'tooltip' => esc_html__('If you set this to anything other than 1, the background image will scroll at a different speed than the page, creating a parallax effect. Setting it to 0.5 will make it scroll at half the speed, setting it to 2 will make it scroll at twice the speed.', 'react-shortcodes'),
						'type' => 'text',
						'default' => '1',
						'class' => 'tcas-width-50',
						'inline' => true
					),
					array(
						'name' => 'image_parallax_offset',
						'label' => esc_html__('Parallax offset', 'react-shortcodes'),
						'tooltip' => esc_html__('This number determines when the background image will be visible, it is the number of pixels from the top of the viewport that the top of background image should be at the top of the block. Experiment with different numbers.', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-50',
						'inline' => true
					),
					array(
						'type' => 'div_close' // .tcas-sc-wrap-manage-display
					)
				)
			),

			array(
				'name' => 'hide',
				'label' => esc_html__('Hide on device(s)', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose to hide this shortcode on device(s)', 'react-shortcodes'),
				'type' => 'multiselect',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'hide-phone-ptr' => esc_html__('Phone portrait', 'react-shortcodes'),
					'hide-phone' => esc_html__('Phone landscape', 'react-shortcodes'),
					'hide-tablet-ptr' => esc_html__('Tablet portrait', 'react-shortcodes'),
					'hide-tablet' => esc_html__('Tablet landscape', 'react-shortcodes'),
					'hide-desktop' => esc_html__('Desktop', 'react-shortcodes'),
					'hide-large' => esc_html__('Large', 'react-shortcodes')
				)
			),
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Content', 'react-shortcodes'),
				'type' => 'textarea'
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 * FIXED
 */
function tcs_shortcode_fixed($atts, $content = '')
{
	extract(shortcode_atts(array(
		'top' => '',
		'right' => '',
		'bottom' => '',
		'left' => '',
		'width' => '',
		'height' => '',
		'margin_top' => '',
		'margin_right' => '',
		'margin_bottom' => '',
		'margin_left' => '',
		'hide' => ''
	), $atts));

	$classes = array('tcs-block-fixed');
	$styles = array();

	if ($top !== '') {
		$styles[] = 'top:' . tcs_get_css_value($top) . ';';
	}

	if ($right !== '') {
		$styles[] = 'right:' . tcs_get_css_value($right) . ';';
	}

	if ($bottom !== '') {
		$styles[] = 'bottom:' . tcs_get_css_value($bottom) . ';';
	}

	if ($left !== '') {
		$styles[] = 'left:' . tcs_get_css_value($left) . ';';
	}

	if ($width !== '') {
		$styles[] = 'width:' . tcs_get_css_value($width) . ';';
	}

	if ($height !== '') {
		$styles[] = 'height:' . tcs_get_css_value($height) . ';';
	}

	if ($margin_top !== '') {
		$styles[] = 'margin-top:' . tcs_get_css_value($margin_top) . ';';
	}

	if ($margin_right !== '') {
		$styles[] = 'margin-right:' . tcs_get_css_value($margin_right) . ';';
	}

	if ($margin_bottom !== '') {
		$styles[] = 'margin-bottom:' . tcs_get_css_value($margin_bottom) . ';';
	}

	if ($margin_left !== '') {
		$styles[] = 'margin-left:' . tcs_get_css_value($margin_left) . ';';
	}

	if ($hide) {
		$classes[] = tcs_get_hide_class($hide);
	}

	return '<div class="' . esc_attr(tcs_sanitize_class($classes)) . '"'. (count($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') . '>' . do_shortcode($content) . '</div>';
}
add_shortcode('fixed', 'tcs_shortcode_fixed');

function tcs_render_shortcode_fixed_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Fixed options', 'react-shortcodes'),
			'shortcode' => 'fixed'
		),
		'options' => array(

			array(
				'type' => 'multiple',
				'label' => esc_html__('Position', 'react-shortcodes'),
				'wrap_class' => 'tcas-position-wrap',
				'description' => esc_html__('The CSS position values of the fixed block, e.g. 10px or auto.', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'top',
						'label' => esc_html__('Top', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'right',
						'label' => esc_html__('Right', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'bottom',
						'label' => esc_html__('Bottom', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'left',
						'label' => esc_html__('Left', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'class' => 'tcas-width-60',
						'inline' => true
					)
				)
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Margin', 'react-shortcodes'),
				'description' => esc_html__('The CSS margin values of the fixed block, e.g. 10px or auto.', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'margin_top',
						'label' => esc_html__('Top', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'margin_right',
						'label' => esc_html__('Right', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'margin_bottom',
						'label' => esc_html__('Bottom', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'margin_left',
						'label' => esc_html__('Left', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'class' => 'tcas-width-60',
						'inline' => true
					)
				)
			),
			array(
				'name' => 'width',
				'label' => esc_html__('Width', 'react-shortcodes'),
				'description' => esc_html__('The CSS width of the fixed block, e.g. 200px or 25%.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-60'
			),
			array(
				'name' => 'height',
				'label' => esc_html__('Height', 'react-shortcodes'),
				'description' => esc_html__('The CSS height of the fixed block, e.g. 200px or 25%.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-60'
			),
			array(
				'name' => 'hide',
				'label' => esc_html__('Hide on device(s)', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose to hide this shortcode on device(s)', 'react-shortcodes'),
				'type' => 'multiselect',
				'default' => '',
				'options' => array(
					'' => esc_html__('None', 'react-shortcodes'),
					'hide-phone-ptr' => esc_html__('Phone portrait', 'react-shortcodes'),
					'hide-phone' => esc_html__('Phone landscape', 'react-shortcodes'),
					'hide-tablet-ptr' => esc_html__('Tablet portrait', 'react-shortcodes'),
					'hide-tablet' => esc_html__('Tablet landscape', 'react-shortcodes'),
					'hide-desktop' => esc_html__('Desktop', 'react-shortcodes'),
					'hide-large' => esc_html__('Large', 'react-shortcodes')
				)
			),
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Content', 'react-shortcodes'),
				'type' => 'textarea',
				'description' => esc_html__('Text, HTML and shortcodes can be used here.', 'react-shortcodes')
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  LIGHTBOX POPUP
 */
function tcs_shortcode_lightbox($atts, $content = '')
{
	extract(shortcode_atts(array(
		'width' => '',
		'height' => '',
		'open_effect' => 'fade',
		'close_effect' => 'fade',
		'open_speed' => '',
		'close_speed' => '',
		'padding_top' => '25',
		'padding_right' => '25',
		'padding_bottom' => '25',
		'padding_left' => '25',
		'close_on_overlay_click' => '1',
		'close_button' => '1',
		'extra_trigger_classes' => '',
		'extra_content_classes' => '',
		'trigger_on_page_load' => '0'
	), $atts));

	global $tcsLightboxTrigger, $tcsLightboxContent;

	do_shortcode($content); // Grab the trigger and content into the globals

	static $lightboxId = 0;
	$lightboxId++;

	$classes = array('tcs-lightbox tcs-hidden');
	$triggerClasses = array('tcs-lightbox-trigger');

	if ($extra_trigger_classes) {
		$triggerClasses[] = $extra_trigger_classes;
	}

	if ($extra_content_classes) {
		$classes[] = $extra_content_classes;
	}

	$margin = array(20, 20, 20, 20);
	$padding = array($padding_top, $padding_right, $padding_bottom, $padding_left);

	if ($close_button == '1') {
		$margin[1] = 56; // 36px extra right for close button
	}

	$options = array(
		'href' => "#tcs-lightbox-{$lightboxId}",
		'closeBtn' => $close_button == '1',
		'autoSize' => false,
		'autoWidth' => !$width,
		'autoHeight' => !$height,
		'margin' => $margin,
		'openOnLoad' => $trigger_on_page_load == '1'
	);

	if ($width) {
		$options['width'] = (int) $width;
	}

	if ($height) {
		$options['height'] = (int) $height;
	}

	if ($open_effect) {
		$options['openEffect'] = $open_effect;
	}

	if ($close_effect) {
		$options['closeEffect'] = $close_effect;
	}

	if ($open_speed) {
		$options['openSpeed'] = $open_speed;
	}

	if ($padding) {
		$options['padding'] = $padding;
	}

	if ($close_speed) {
		$options['closeSpeed'] = $close_speed;
	}

	if ($close_on_overlay_click == '0') {
		$options['helpers']['overlay'] = array('closeClick' => false);
	}

	$output = '<div id="tcs-lightbox-trigger-' . $lightboxId . '" class="' . esc_attr(tcs_sanitize_class($triggerClasses)) . '" data-options="' . esc_attr(wp_json_encode($options)) . '">' . do_shortcode($tcsLightboxTrigger) . '</div>';

	$output .= '<div id="tcs-lightbox-' . $lightboxId . '" class="' . esc_attr(tcs_sanitize_class($classes)) . '">' . do_shortcode($tcsLightboxContent) . '</div>';

	unset($GLOBALS['tcsLightboxTrigger'], $GLOBALS['tcsLightboxContent']);

	return $output;
}
add_shortcode('lightbox', 'tcs_shortcode_lightbox');

function tcs_shortcode_lightbox_trigger($atts, $content = '')
{
	global $tcsLightboxTrigger;
	$tcsLightboxTrigger = $content;
}
add_shortcode('lightbox_trigger', 'tcs_shortcode_lightbox_trigger');

function tcs_shortcode_lightbox_content($atts, $content = '')
{
	global $tcsLightboxContent;
	$tcsLightboxContent = $content;
}
add_shortcode('lightbox_content', 'tcs_shortcode_lightbox_content');

function tcs_render_shortcode_lightbox_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Lightbox options', 'react-shortcodes'),
			'shortcode' => 'lightbox'
		),
		'options' => array(
			array(
				'name' => 'width',
				'label' => esc_html__('Width', 'react-shortcodes'),
				'description' => esc_html__('The numeric width of the lightbox in pixels, for example 400. If empty the lightbox will automatically fit the content.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-50'
			),
			array(
				'name' => 'height',
				'label' => esc_html__('Height', 'react-shortcodes'),
				'description' => esc_html__('The numeric height of the lightbox in pixels, for example 300. If empty the lightbox will automatically fit the content.', 'react-shortcodes'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcas-width-50'
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Padding', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'padding_top',
						'label' => esc_html__('Top', 'react-shortcodes'),
						'type' => 'number',
						'default' => '25',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'padding_right',
						'label' => esc_html__('Right', 'react-shortcodes'),
						'type' => 'number',
						'default' => '25',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'padding_bottom',
						'label' => esc_html__('Bottom', 'react-shortcodes'),
						'type' => 'number',
						'default' => '25',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					),
					array(
						'name' => 'padding_left',
						'label' => esc_html__('Left', 'react-shortcodes'),
						'type' => 'number',
						'default' => '25',
						'class' => 'tcas-width-60',
						'unit' => 'px',
						'inline' => true
					)
				)
			),
			array(
				'name' => 'open_effect',
				'label' => esc_html__('Open animation', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'fade',
				'options' => array(
					'fade' => esc_html__('Fade', 'react-shortcodes'),
					'elastic' => esc_html__('Elastic', 'react-shortcodes'),
					'none' => esc_html__('None', 'react-shortcodes')
				)
			),
			array(
				'name' => 'close_effect',
				'label' => esc_html__('Close animation', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'fade',
				'options' => array(
					'fade' => esc_html__('Fade', 'react-shortcodes'),
					'elastic' => esc_html__('Elastic', 'react-shortcodes'),
					'none' => esc_html__('None', 'react-shortcodes')
				)
			),
			array(
				'name' => 'open_speed',
				'label' => esc_html__('Open animation speed', 'react-shortcodes'),
				'description' => esc_html__('The speed of the animation in milliseconds, 1000 = 1 second.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '250',
				'slider' => array('from' => 0, 'to' => 5000, 'step' => 50, 'dimension' => 'ms')
			),
			array(
				'name' => 'close_speed',
				'label' => esc_html__('Close animation speed', 'react-shortcodes'),
				'description' => esc_html__('The speed of the animation in milliseconds, 1000 = 1 second.', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '250',
				'slider' => array('from' => 0, 'to' => 5000, 'step' => 50, 'dimension' => 'ms')
			),
			array(
				'name' => 'close_on_overlay_click',
				'label' => esc_html__('Close on overlay click', 'react-shortcodes'),
				'description' => esc_html__('The lightbox will close when the user clicks on the overlay.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '1',
				'toggle' => 'yn'
			),
			array(
				'name' => 'close_button',
				'label' => esc_html__('Close button', 'react-shortcodes'),
				'description' => esc_html__('Adds a close button to the lightbox.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '1'
			),
			array(
				'name' => 'trigger_on_page_load',
				'label' => esc_html__('Trigger on page load', 'react-shortcodes'),
				'description' => esc_html__('Triggers the popup when the user enters the page.', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'trigger_html',
				'label' => esc_html__('Trigger text', 'react-shortcodes'),
				'description' => esc_html__('Text, HTML and shortcodes can be used here.', 'react-shortcodes'),
				'type' => 'textarea',
				'default' => ''
			),
			array(
				'name' => 'extra_trigger_classes',
				'label' => esc_html__('Extra trigger classes', 'react-shortcodes'),
				'description' => esc_html__('Add any extra classes to the trigger.', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			),
			array(
				'name' => 'extra_content_classes',
				'label' => esc_html__('Extra content classes', 'react-shortcodes'),
				'description' => esc_html__('Add any extra classes to the lightbox content. EG: subtle-link', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			),
			array(
				'name' => 'enclosed_content',
				'label' => esc_html__('Content', 'react-shortcodes'),
				'description' => esc_html__('Text, HTML and shortcodes can be used here.', 'react-shortcodes'),
				'type' => 'textarea'
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  ICON
 */
function tcs_shortcode_icon($atts, $content = '')
{
	extract(shortcode_atts(array(
		'icon' => '',
		'character' => '',
		'size_image' => 'sml',
		'font_size' => '13',
		'color' => 'style-prime',
		'style_image' => 'drk',
		'boxed' => '0',
		'round' => '0',
		'hollow' => '0',
		'gradient' => '0',
		'description' => '',
		'position' => '',
		'margin_top' => '0',
		'margin_right' => '0',
		'margin_bottom' => '0',
		'margin_left' => '0',
		'hover_animation' => '',
		'background_animation' => '',
		'animation' => '',
		'animation_delay' => '',
		'animation_offset' => '',
		'link' => '',
		'class' => '',
		'button_external' => ''
	), $atts));

	$styles = array();
	$isFontAwesome = preg_match('/^fa\-/', $icon);
	$isMixedIcon = preg_match('/^icon\-/', $icon);

	$iconClasses = array();
	if ($icon) {
		$iconClasses[] = tcs_sanitize_class(tcs_get_icon_classes($icon, $size_image, $style_image));
	}

	if ($class) {
		$classes[] = $class;
	}

	if ($icon == '' && $character != '') {//todo
		$iconClasses[] = 'tcs-character-icon';
		$showCharacter = $character;
	} else {
		$showCharacter = ' ';
	}

	if ($color) {
		$classes[] = tcs_prefix_classes($color);
	}

	if ($gradient == '1') {
		$outerClasses[] = 'tcs-gradient';
	}

	if ($position) {
		$classes[] = tcs_prefix_classes('icon-' . $position);
	}

	if ($animation && function_exists('react_get_animation_data')) {
		$classes[] = react_get_animation_class($animation);
		$animationData = react_get_animation_data($animation, $animation_delay, $animation_offset);
	}

	if ($hover_animation) {
		$classes[] = $hover_animation;
	}

	if ($margin_top !== '' && $margin_top !== '0') {
		$styles[] = 'margin-top:' .  tcs_get_css_value($margin_top) . ';';
	}

	if ($margin_right !== '' && $margin_right !== '0') {
		$styles[] = 'margin-right:' .  tcs_get_css_value($margin_right) . ';';
	}

	if ($margin_bottom !== '' && $margin_bottom !== '0') {
		$styles[] = 'margin-bottom:' .  tcs_get_css_value($margin_bottom) . ';';
	}

	if ($margin_left !== '' && $margin_left !== '0') {
		$styles[] = 'margin-left:' .  tcs_get_css_value($margin_left) . ';';
	}

	if ($background_animation) {
		$classes[] = 'tcs-has-back-animation';
		$classes[] = $background_animation;
	}

	if ($font_size <= 19) {
		$sizeGen = (1.3 * $font_size);
	} else {
		$sizeGen = (2 * $font_size);
	}

	if ($boxed == '1') {
		$classes[] = 'tcs-boxed';

		if ($round == '1') {
			$classes[] = 'tcs-rounded';
			$maxSize = ($sizeGen + 16);
			$styles[] = 'max-height: ' . $maxSize . 'px; max-width: ' . $maxSize . 'px;';
		}

		if ($hollow == '1') {
			$classes[] = 'tcs-icon-hollow';
		}
	}

	if ($boxed == '1') {
		$fontSize = $isFontAwesome || $isMixedIcon || $character != '' ? ' style="font-size:' . $font_size . 'px; line-height:' . $sizeGen . 'px; height:' . $sizeGen . 'px; width:' . $sizeGen . 'px;"' : '';
	} else {
		$fontSize = $isFontAwesome || $isMixedIcon || $character != '' ? ' style="font-size:' . $font_size . 'px;"' : '';
	}

	$output = '<span class="tcs-icon ' . esc_attr(tcs_sanitize_class($classes)) . '"' . ($description ? ' title="' . esc_attr($description) . '"' : '') . (isset($animationData) ? ' ' . $animationData : '') . (count($styles) ? ' style="' . esc_attr(join(' ', $styles)) . '"' : '') .'><i' . $fontSize . (count($iconClasses) ? ' class="' . esc_attr(tcs_sanitize_class($iconClasses)) . '"' : '') . '>' . $showCharacter . '</i></span>';

	if ($link) {
		$output = '<a class="tcs-icon-a" href="' . esc_url($link) . '"' . ($button_external == '1' ? ' target="_blank"' : '') . '>' . $output . '</a>';
	}

	if ($position == 'center') {
		$output = '<div class="tcs-icon-center-wrap">' . $output . '</div>';
	}

	return $output;
}
add_shortcode('icon', 'tcs_shortcode_icon');

function tcs_render_shortcode_icon_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Icon options', 'react-shortcodes'),
			'shortcode' => 'icon'
		),
		'options' => array(
			array(
				'name' => 'icon',
				'label' => esc_html__('Icon', 'react-shortcodes'),
				'type' => 'icon',
				'default' => ''
			),
			array(
				'name' => 'character',
				'label' => esc_html__('Character', 'react-shortcodes'),
				'description' => esc_html__('Add text to show instead of an icon', 'react-shortcodes'),
				'class' => 'tcas-width-50',
				'type' => 'text',
				'default' => ''
			),
			array(
				'name' => 'size_image',
				'label' => esc_html__('Size', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'sml',
				'options' => array(
					'sml' => esc_html__('Small', 'react-shortcodes'),
					'med' => esc_html__('Medium', 'react-shortcodes'),
					'lrg' => esc_html__('Large', 'react-shortcodes')
				),
				'class' => 'tcas-icon-size_image'
			),
			array(
				'name' => 'font_size',
				'label' => esc_html__('Size', 'react-shortcodes'),
				'type' => 'slider',
				'default' => '13',
				'slider' => array('from' => 6, 'to' => 300, 'step' => 1, 'dimension' => 'px'),
				'class' => 'tcas-icon-font_size'
			),
			array(
				'name' => 'color',
				'label' => esc_html__('Color / Style', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a style and color', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'style-prime',
				'options' => array(
					'style-prime' => esc_html__('Primary', 'react-shortcodes'),
					'style-red' => esc_html__('Red', 'react-shortcodes'),
					'style-orange' => esc_html__('Orange', 'react-shortcodes'),
					'style-blue' => esc_html__('Blue', 'react-shortcodes'),
					'style-green' => esc_html__('Green', 'react-shortcodes'),
					'style-light' => esc_html__('Light', 'react-shortcodes'),
					'style-dark' => esc_html__('Dark', 'react-shortcodes'),
					'style-inherit' => esc_html__('Color Inherited', 'react-shortcodes')
				),
				'class' => 'tcas-icon-style'
			),
			array(
				'name' => 'style_image',
				'label' => esc_html__('Style', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose a light or dark style for the image icon', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'drk',
				'options' => array(
					'lgt' => esc_html__('Light', 'react-shortcodes'),
					'drk' => esc_html__('Dark', 'react-shortcodes')
				),
				'class' => 'tcas-icon-style_image'
			),
			array(
				'name' => 'boxed',
				'label' => esc_html__('Box style', 'react-shortcodes'),
				'tooltip' => esc_html__('Display a box around the icon', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'round',
				'label' => esc_html__('Round style', 'react-shortcodes'),
				'tooltip' => esc_html__('This will create a circular icon background', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'hollow',
				'label' => esc_html__('Hollow style', 'react-shortcodes'),
				'tooltip' => esc_html__('Background will be transparent until hovered', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			tcs_get_hover_background_animation_options(),
			array(
				'name' => 'gradient',
				'label' => esc_html__('Gradient', 'react-shortcodes'),
				'tooltip' => esc_html__('Add gradient style (CSS3)', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0'
			),
			tcs_get_hover_animation_options(),
			tcs_get_extended_animation_options(),
			array(
				'name' => 'description',
				'label' => esc_html__('Description', 'react-shortcodes'),
				'description' => esc_html__('Add text to show when user hovers the icon.', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			),
			array(
				'name' => 'position',
				'label' => esc_html__('Position', 'react-shortcodes'),
				'tooltip' => esc_html__('Choose the position of the icon', 'react-shortcodes'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Inline', 'react-shortcodes'),
					'left' => esc_html__('Left', 'react-shortcodes'),
					'center' => esc_html__('Center', 'react-shortcodes'),
					'right' => esc_html__('Right', 'react-shortcodes')
				)
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Margin', 'react-shortcodes'),
				'description' => esc_html__('The CSS margin values, e.g. 10px or auto.', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'margin_top',
						'label' => esc_html__('Top', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'margin_right',
						'label' => esc_html__('Right', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'margin_bottom',
						'label' => esc_html__('Bottom', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-60',
						'inline' => true
					),
					array(
						'name' => 'margin_left',
						'label' => esc_html__('Left', 'react-shortcodes'),
						'type' => 'text',
						'default' => '0',
						'class' => 'tcas-width-60',
						'inline' => true
					)
				)
			),
			array(
				'name' => 'link',
				'label' => esc_html__('Link URL', 'react-shortcodes'),
				'tooltip' => esc_html__('Links the icon to a page or website', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			),
			array(
				'name' => 'button_external',
				'label' => esc_html__('Link opens in a new tab/window', 'react-shortcodes'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'class',
				'label' => esc_html__('Additional classes', 'react-shortcodes'),
				'tooltip' => esc_html__('Add additional classes to the icon', 'react-shortcodes'),
				'type' => 'text',
				'optional' => true
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  FLAG
 */
function tcs_shortcode_flag($atts, $content = '')
{
	extract(shortcode_atts(array(
		'flag' => 'United-States',
		'size' => '24',
		'description' => '',
		'animation' => '',
		'animation_delay' => '',
		'animation_offset' => '',
		'link' => ''
	), $atts));

	$classes = array();

	if (!in_array($size, array('12', '24', '48'))) {
		$size = '24';
	}

	if ($size == '12') {
		$folder = '24';
	} else {
		$folder = '48';
	}

	if ($animation && function_exists('react_get_animation_data')) {
		$classes[] = react_get_animation_class($animation);
		$animationData = react_get_animation_data($animation, $animation_delay, $animation_offset);
	}

	if ($description) {
		$classes[] = 'tooltip';
	}

	$styles = array(
		'background:url(' . esc_url(tcs_url('images/flags/shiny/' . $folder . '/' . $flag . '.png')) . ') no-repeat center center;',
		'background-size:' . $size . 'px ' . $size . 'px;',
		'width:' . $size . 'px;',
		'height:' . $size . 'px;'
	);

	if ($link) {
		$classes[] = 'tcs-flag-a';
		$startTag = '<a class="' . esc_attr(tcs_sanitize_class($classes)) . '" href="' . esc_url($link) . '"';
		$endTag = '</a>';
	} else {
		$classes[] = 'tcs-flag';
		$startTag = '<span class="' . esc_attr(tcs_sanitize_class($classes)) . '"';
		$endTag = '</span>';
	}

	$output = $startTag . (count($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') . ' ' . ($description ? ' title="' . esc_attr($description) . '"' : '') . (isset($animationData) ? ' ' . $animationData : '') . '>' . $endTag;

	return $output;
}
add_shortcode('flag', 'tcs_shortcode_flag');

function tcs_render_shortcode_flag_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Flag options', 'react-shortcodes'),
			'shortcode' => 'flag'
		),
		'options' => array(
			array(
				'name' => 'flag',
				'label' => esc_html__('Flag', 'react-shortcodes'),
				'type' => 'select',
				'default' => 'United-States',
				'options' => tcs_get_flag_options()
			),
			array(
				'name' => 'size',
				'label' => esc_html__('Size', 'react-shortcodes'),
				'type' => 'select',
				'default' => '24',
				'options' => array(
					'12' => '12px',
					'24' => '24px',
					'48' => '48px'
				)
			),
			array(
				'name' => 'description',
				'label' => esc_html__('Description', 'react-shortcodes'),
				'description' => esc_html__('Add text to show when user hovers the flag.', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			),
			tcs_get_extended_animation_options(),
			array(
				'name' => 'link',
				'label' => esc_html__('Link URL', 'react-shortcodes'),
				'tooltip' => esc_html__('Links the flag to a page or website', 'react-shortcodes'),
				'type' => 'text',
				'default' => ''
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 *  OPENING TIMES
 */
function tcs_shortcode_opening_times($atts, $content = '')
{
	$options = shortcode_atts(array(
		'mon' => esc_html__('Monday', 'react-shortcodes'),
		'tue' => esc_html__('Tuesday', 'react-shortcodes'),
		'wed' => esc_html__('Wednesday', 'react-shortcodes'),
		'thu' => esc_html__('Thursday', 'react-shortcodes'),
		'fri' => esc_html__('Friday', 'react-shortcodes'),
		'sat' => esc_html__('Saturday', 'react-shortcodes'),
		'sun' => esc_html__('Sunday', 'react-shortcodes'),
		'mon_time' => '',
		'tue_time' => '',
		'wed_time' => '',
		'thu_time' => '',
		'fri_time' => '',
		'sat_time' => '',
		'sun_time' => ''
	), $atts);

	$classes = array();
	$output = '<div class="tcs-opening-times-wrap tcs-clearfix">';

	foreach(array('mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun') as $day) {
		$output .= '<div class="tcs-opening-times tcs-clearfix"><div class="tcs-one-day">' . esc_html($options[$day]) . '</div><div class="tcs-open-time">' . esc_html($options[$day . '_time']) . '</div></div>';
	}

	$output .= '</div>';

	return $output;
}
add_shortcode('opening_times', 'tcs_shortcode_opening_times');
add_shortcode('openingtimes', 'tcs_shortcode_opening_times'); // Backwards compatibility

function tcs_render_shortcode_opening_times_options()
{
	$config = array(
		'config' => array(
			'title' => esc_html__('Opening times', 'react-shortcodes'),
			'shortcode' => 'opening_times'
		),
		'options' => array(
			array(
				'type' => 'multiple',
				'label' => esc_html__('Monday', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'mon',
						'label' => esc_html__('Name', 'react-shortcodes'),
						'type' => 'text',
						'default' => esc_html__('Monday', 'react-shortcodes'),
						'inline' => true
					),
					array(
						'name' => 'mon_time',
						'label' => esc_html__('Time', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'inline' => true
					)
				)
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Tuesday', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'tue',
						'label' => esc_html__('Name', 'react-shortcodes'),
						'type' => 'text',
						'default' => esc_html__('Tuesday', 'react-shortcodes'),
						'inline' => true
					),
					array(
						'name' => 'tue_time',
						'label' => esc_html__('Time', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'inline' => true
					)
				)
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Wednesday', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'wed',
						'label' => esc_html__('Name', 'react-shortcodes'),
						'type' => 'text',
						'default' => esc_html__('Wednesday', 'react-shortcodes'),
						'inline' => true
					),
					array(
						'name' => 'wed_time',
						'label' => esc_html__('Time', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'inline' => true
					)
				)
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Thursday', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'thu',
						'label' => esc_html__('Name', 'react-shortcodes'),
						'type' => 'text',
						'default' => esc_html__('Thursday', 'react-shortcodes'),
						'inline' => true
					),
					array(
						'name' => 'thu_time',
						'label' => esc_html__('Time', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'inline' => true
					)
				)
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Friday', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'fri',
						'label' => esc_html__('Name', 'react-shortcodes'),
						'type' => 'text',
						'default' => esc_html__('Friday', 'react-shortcodes'),
						'inline' => true
					),
					array(
						'name' => 'fri_time',
						'label' => esc_html__('Time', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'inline' => true
					)
				)
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Saturday', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'sat',
						'label' => esc_html__('Name', 'react-shortcodes'),
						'type' => 'text',
						'default' => esc_html__('Saturday', 'react-shortcodes'),
						'inline' => true
					),
					array(
						'name' => 'sat_time',
						'label' => esc_html__('Time', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'inline' => true
					)
				)
			),
			array(
				'type' => 'multiple',
				'label' => esc_html__('Sunday', 'react-shortcodes'),
				'elements' => array(
					array(
						'name' => 'sun',
						'label' => esc_html__('Name', 'react-shortcodes'),
						'type' => 'text',
						'default' => esc_html__('Sunday', 'react-shortcodes'),
						'inline' => true
					),
					array(
						'name' => 'sun_time',
						'label' => esc_html__('Time', 'react-shortcodes'),
						'type' => 'text',
						'default' => '',
						'inline' => true
					)
				)
			)
		)
	);

	$generator = new TcsShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 * Get the config for a <select> with available animation options
 *
 * @param   string  $key          The option key
 * @param   string  $label        The option label
 * @param   string  $description  The option description
 * @return  array
 */
function tcs_get_animation_options($key, $label = '', $description = '')
{
	if (function_exists('react_get_animation_options')) {
		$options = array(
			'name' => $key,
			'label' => $label,
			'description' => $description,
			'type' => 'select',
			'default' => '',
			'options' => react_get_animation_options(esc_html__('Default', 'react-shortcodes'))
		);
	} else {
		$options = array(
			'name' => $key,
			'label' => $label,
			'description' => $description,
			'type' => 'unavailable',
			'default' => ''
		);
	}

	return $options;
}

/**
 * Get the config for the extended animation options
 *
 * @param   string  $key               The name of the animation option
 * @param   string  $defaultAnimation  The default animation
 * @return  array
 */
function tcs_get_extended_animation_options($key = 'animation', $defaultAnimation = '')
{
	if (function_exists('react_get_animation_options')) {
		$options = array(
			'type' => 'multiple',
			'label' => esc_html__('Animation', 'react-shortcodes'),
			'tooltip' => esc_html__('Add a subtle animation when the item comes into view', 'react-shortcodes'),
			'elements' => array(
				array(
					'name' => $key,
					'label' => esc_html__('Animation', 'react-shortcodes'),
					'type' => 'select',
					'default' => $defaultAnimation,
					'options' => react_get_animation_options(),
					'inline' => true
				),
				array(
					'name' => $key . '_delay',
					'label' => esc_html__('Delay', 'react-shortcodes'),
					'tooltip' => esc_html__('The animation will not start until this number of milliseconds after the element comes into view (1000 milliseconds = 1 second)', 'react-shortcodes'),
					'type' => 'number',
					'default' => '',
					'unit' => 'ms',
					'class' => 'tcas-width-50',
					'inline' => true
				),
				array(
					'name' => $key . '_offset',
					'label' => esc_html__('Offset', 'react-shortcodes'),
					'tooltip' => esc_html__('If the number is positive, the animation will start when the element is this number of pixels below the viewport.', 'react-shortcodes') . '<br><br>' . esc_html__('If the number is negative, the animation will not start until the element is this number of pixels inside the viewport.', 'react-shortcodes'),
					'type' => 'number',
					'default' => '',
					'unit' => 'px',
					'class' => 'tcas-width-50',
					'inline' => true
				)
			)
		);
	} else {
		$options = array(
			'type' => 'multiple',
			'label' => esc_html__('Animation', 'react-shortcodes'),
			'tooltip' => esc_html__('Add a subtle animation when the item comes into view', 'react-shortcodes'),
			'elements' => array(
				array(
					'name' => $key,
					'type' => 'unavailable',
					'default' => $defaultAnimation,
					'inline' => true
				),
				array(
					'name' => $key . '_delay',
					'type' => 'hidden',
					'inline' => true
				),
				array(
					'name' => $key . '_offset',
					'type' => 'hidden',
					'inline' => true
				)
			)
		);
	}

	return $options;
}

/**
 * Get the config for the letter animation options
 *
 * @param   string  $key                     The name of the animation option
 * @param   string  $defaultLetterAnimation  The default animation
 * @return  array
 */
function tcs_get_letter_animation_options($key = 'letter_animation', $defaultLetterAnimation = 'fadeIn')
{
	if (function_exists('react_get_animation_options')) {
		$options = array(
			'type' => 'multiple',
			'label' => esc_html__('Letter animation', 'react-shortcodes'),
			'tooltip' => esc_html__('Add a subtle letter animation when the item comes into view', 'react-shortcodes'),
			'elements' => array(
				array(
					'name' => $key,
					'label' => esc_html__('Animation', 'react-shortcodes'),
					'type' => 'select',
					'default' => $defaultLetterAnimation,
					'options' => react_get_animation_options(),
					'inline' => true
				),
				array(
					'name' => $key . '_type',
					'label' => esc_html__('Animation type', 'react-shortcodes'),
					'type' => 'select',
					'default' => '',
					'options' => array(
						'' => 'Default',
						'reverse' => 'Reverse',
						'shuffle' => 'Shuffle'
					),
					'inline' => true
				)
			)
		);
	} else {
		$options = array(
			'type' => 'multiple',
			'label' => esc_html__('Letter animation', 'react-shortcodes'),
			'tooltip' => esc_html__('Add a subtle letter animation when the item comes into view', 'react-shortcodes'),
			'elements' => array(
				array(
					'name' => $key,
					'type' => 'unavailable',
					'default' => $defaultLetterAnimation,
					'inline' => true
				),
				array(
					'name' => $key . '_type',
					'type' => 'hidden',
					'inline' => true
				)
			)
		);
	}

	return $options;
}

/**
 * Get the hover animation options
 *
 * @return array
 */
function tcs_get_hover_animation_options()
{
	if (function_exists('react_get_hover_animation_options')) {
		$options = array(
			'name' => 'hover_animation',
			'label' => esc_html__('Hover animation', 'react-shortcodes'),
			'tooltip' => esc_html__('Add a subtle animation when the item is hovered', 'react-shortcodes'),
			'type' => 'select',
			'default' => '',
			'options' => react_get_hover_animation_options(),
		);
	} else {
		$options = array(
			'name' => 'hover_animation',
			'label' => esc_html__('Hover animation', 'react-shortcodes'),
			'tooltip' => esc_html__('Add a subtle animation when the item is hovered', 'react-shortcodes'),
			'type' => 'unavailable',
			'default' => ''
		);
	}

	return $options;
}

/**
 * Get the hover background animation options
 *
 * @return array
 */
function tcs_get_hover_background_animation_options()
{
	if (function_exists('react_get_hover_background_animation_options')) {
		$options = array(
			'name' => 'background_animation',
			'label' => esc_html__('Background animation', 'react-shortcodes'),
			'tooltip' => esc_html__('Add a subtle animation when the item is hovered', 'react-shortcodes'),
			'type' => 'select',
			'default' => '',
			'options' => react_get_hover_background_animation_options()
		);
	} else {
		$options = array(
			'name' => 'background_animation',
			'label' => esc_html__('Background animation', 'react-shortcodes'),
			'tooltip' => esc_html__('Add a subtle animation when the item is hovered', 'react-shortcodes'),
			'type' => 'unavailable',
			'default' => ''
		);
	}

	return $options;
}

/**
 * Get the options for the palette select field
 *
 * @param   string  $key      The option key
 * @param   string  $label    The option label
 * @param   string  $tooltip  The option tooltip
 * @return  array
 */
function tcs_get_custom_palette_options($key, $label = '', $tooltip = '')
{
	if (function_exists('react_get_custom_palette_options')) {
		return array(
			'name' => $key,
			'label' => $label,
			'tooltip' => $tooltip,
			'type' => 'select',
			'default' => '',
			'options' => array('' => esc_html__('None', 'react-shortcodes')) + react_get_custom_palette_options()
		);
	}

	return array(
		'name' => $key,
		'label' => $label,
		'tooltip' => $tooltip,
		'type' => 'unavailable',
		'default' => ''
	);
}

/**
 * Get the HTML tag options for the fancy/impact header
 *
 * @return  array
 */
function tcs_get_header_tag_options()
{
	return array(
		'h1' => 'h1',
		'h2' => 'h2',
		'h3' => 'h3',
		'h4' => 'h4',
		'h5' => 'h5',
		'div' => 'div',
		'span' => 'span'
	);
}

function tcs_h1($atts, $content = '')
{
	return tcs_tag('h1', $atts, $content);
}
function tcs_h2($atts, $content = '')
{
	return tcs_tag('h2', $atts, $content);
}
function tcs_h3($atts, $content = '')
{
	return tcs_tag('h3', $atts, $content);
}
function tcs_h4($atts, $content = '')
{
	return tcs_tag('h4', $atts, $content);
}
function tcs_h5($atts, $content = '')
{
	return tcs_tag('h5', $atts, $content);
}
function tcs_h6($atts, $content = '')
{
	return tcs_tag('h6', $atts, $content);
}
function tcs_span($atts, $content = '')
{
	return tcs_tag('span', $atts, $content);
}
function tcs_b($atts, $content = '')
{
	return tcs_tag('b', $atts, $content);
}
function tcs_i($atts, $content = '')
{
	return tcs_tag('i', $atts, $content);
}
function tcs_code($atts, $content = '')
{
	return tcs_tag('code', $atts, $content);
}
function tcs_pre($atts, $content = '')
{
	return tcs_tag('pre', $atts, $content);
}
function tcs_li($atts, $content = '')
{
	return tcs_tag('li', $atts, $content);
}
function tcs_ul($atts, $content = '')
{
	return tcs_tag('ul', $atts, $content);
}
function tcs_ol($atts, $content = '')
{
	return tcs_tag('ol', $atts, $content);
}
function tcs_p($atts, $content = '')
{
	return tcs_tag('p', $atts, $content);
}
function tcs_div($atts, $content = '')
{
	return tcs_tag('div', $atts, $content);
}
function tcs_table($atts, $content = '')
{
	return tcs_tag('table', $atts, $content);
}
function tcs_tr($atts, $content = '')
{
	return tcs_tag('tr', $atts, $content);
}
function tcs_th($atts, $content = '')
{
	return tcs_tag('th', $atts, $content);
}
function tcs_td($atts, $content = '')
{
	return tcs_tag('td', $atts, $content);
}
function tcs_highlight($atts, $content = '')
{
	if (isset($atts['class'])) {
		$atts['class'] .= ' tcs-highlighted-text';
	} else {
		$atts['class'] = 'tcs-highlighted-text';
	}
	return tcs_tag('span', $atts, $content);
}
function tcs_tag($tag, $atts, $content = '') {

	extract(shortcode_atts(array(
		'class' => '',
		'style' => ''
	), $atts));

	$output = '<' . esc_attr($tag) .
				($class ? ' class="' . esc_attr(tcs_sanitize_class($class)) . '"' : '') .
				($style ? ' style="' . esc_attr($style) . '"' : '') .
			  '>' . do_shortcode($content) . '</' . esc_attr($tag) . '>';

	return $output;
}
add_shortcode('h1', 'tcs_h1');
add_shortcode('h2', 'tcs_h2');
add_shortcode('h3', 'tcs_h3');
add_shortcode('h4', 'tcs_h4');
add_shortcode('h5', 'tcs_h5');
add_shortcode('h6', 'tcs_h6');
add_shortcode('span', 'tcs_span');
add_shortcode('b', 'tcs_b');
add_shortcode('br', 'tcs_br');
add_shortcode('i', 'tcs_i');
add_shortcode('code', 'tcs_code');
add_shortcode('pre', 'tcs_pre');
add_shortcode('li', 'tcs_li');
add_shortcode('ul', 'tcs_ul');
add_shortcode('ol', 'tcs_ol');
add_shortcode('div', 'tcs_div');
add_shortcode('p', 'tcs_p');
add_shortcode('table', 'tcs_table');
add_shortcode('tr', 'tcs_tr');
add_shortcode('th', 'tcs_th');
add_shortcode('td', 'tcs_td');
add_shortcode('highlight', 'tcs_highlight');

function tcs_dummytext($atts, $content = '')
{
	extract(shortcode_atts(array(
		'class' => '',
		'style' => '',
		'val' => '1',
		'length' => 'short'
	), $atts));

	if ($length == 'long') {
		$output = 'Nunc fermentum luctus tellus nec hendrerit. Quisque pretium justo vitae lectus mollis aliquet sagittis erat imperdiet. Phasellus velit leo, tempus nec malesuada sed, rhoncus non mi. Nunc enim augue, facilisis vitae viverra in, mattis ut dui. Proin posuere, dui vel porttitor blandit, tortor ipsum hendrerit ante, nec condimentum ligula massa vehicula orci. In porta purus aliquet lectus tempor auctor sit amet a ligula. Nam bibendum, velit ac semper euismod, elit tortor convallis ipsum, posuere tempor felis sem ut nulla. Donec velit metus, vulputate nec pellentesque nec, blandit vel massa. In hac habitasse platea dictumst. Curabitur aliquet nunc eu tortor tempor eu consequat libero auctor.';
	} else {
		$output = 'Proin posuere, dui vel porttitor blandit, tortor ipsum hendrerit ante, nec condimentum ligula massa vehicula orci. In porta purus aliquet lectus tempor auctor sit amet a ligula. Nam bibendum, velit ac semper euismod, elit tortor convallis ipsum, posuere tempor felis sem ut nulla.';
	}

	if ($val == '2') {
		$output = do_shortcode($content) . '<p>' . $output . '</p><p>' . $output . '</p>';
	} elseif ($val == '3') {
		$output = do_shortcode($content) . '<p>' . $output . '</p><p>' . $output . '</p><p>' . $output . '</p>';
	} elseif ($val == '4') {
		$output = do_shortcode($content) . '<p>' . $output . '</p><p>' . $output . '</p><p>' . $output . '</p><p>' . $output . '</p>';
	} elseif ($val == '5') {
		$output = do_shortcode($content) . '<p>' . $output . '</p><p>' . $output . '</p><p>' . $output . '</p><p>' . $output . '</p><p>' . $output . '</p>';
	} else {
		$output = do_shortcode($content) . '<p>' . $output . '</p>';
	}

	return $output;
}
add_shortcode('dummytext', 'tcs_dummytext');

function tcs_a($atts, $content = '')
{
	extract(shortcode_atts(array(
		'class' => '',
		'style' => '',
		'href' => ''
	), $atts));

	if ($href == '') {
		$tag = 'span';
	} else {
		$tag = 'a';
	}

	$output = '<' . esc_attr($tag) .
				($href ? ' href="' . esc_url($href) . '"' : '') .
				($class ? ' class="' . esc_attr(tcs_sanitize_class($class)) . '"' : '') .
				($style ? ' style="' . esc_attr($style) . '"' : '') .
			  '>' . do_shortcode($content) . '</' . esc_attr($tag) . '>';

	return $output;
}
add_shortcode('a', 'tcs_a');
