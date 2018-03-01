<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * PORTFOLIO METABOX
 */
$config = array(
	'id' => 'tcp_portfolio',
	'title' => esc_html__('Portfolio Options', 'react-portfolio'),
	'types' => array('post', 'portfolio'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);

$options = array(
	array(
		'name' => 'type',
		'title' => esc_html__('Type', 'react-portfolio'),
		'description' => esc_html__('Choose a type of content that you want to display in the portfolio for this item.', 'react-portfolio'),
		'type' => 'select',
		'types' => array('portfolio'), // for portfolio
		'default' => 'image',
		'options' => array(
			'' => esc_html__('Featured image linking to image in lightbox', 'react-portfolio'),
			'video' => esc_html__('Featured image linking to video in lightbox', 'react-portfolio'),
			'video_embed' => esc_html__('Embedded video', 'react-portfolio'),
			'post' => esc_html__('Featured image linking to the post', 'react-portfolio'),
			'link' => esc_html__('Featured image linking to another URL', 'react-portfolio'),
			'plain' => esc_html__('Featured image with no link', 'react-portfolio')
		)
	),
	array(
		'name' => 'type',
		'title' => esc_html__('Type', 'react-portfolio'),
		'description' => esc_html__('Choose a type of content that you want to display in the portfolio for this item.', 'react-portfolio'),
		'type' => 'select',
		'types' => array('post'), // for post
		'default' => 'post',
		'options' => array(
			'' => esc_html__('Featured image linking to image in lightbox', 'react-portfolio'),
			'video' => esc_html__('Featured image linking to video in lightbox', 'react-portfolio'),
			'video_embed' => esc_html__('Embedded video', 'react-portfolio'),
			'post' => esc_html__('Featured image linking to the post', 'react-portfolio'),
			'link' => esc_html__('Featured image linking to another URL', 'react-portfolio'),
			'plain' => esc_html__('Featured image with no link', 'react-portfolio')
		)
	),
	array(
		'name' => 'image',
		'title' => esc_html__('Alternative lightbox image', 'react-portfolio'),
		'description' => esc_html__('Choose an image to display in the lightbox. If not set, the Featured Image will be used.', 'react-portfolio'),
		'tooltip' => esc_html__('You can choose another image to show in the lightbox, instead of the post Featured Image.', 'react-portfolio'),
		'type' => 'upload',
		'default' => ''
	),
	array(
		'name' => 'title',
		'title' => esc_html__('Image title', 'react-portfolio'),
		'description' => esc_html__('The title is shown when hovering the bullet navigation in Serene (Full Screen) gallery and also sets the "alt" attribute for the FancyBox gallery images.', 'react-portfolio'),
		'type' => 'text'
	),
	array(
		'name' => 'caption_position',
		'title' => esc_html__('Caption position', 'react-portfolio'),
		'type' => 'select',
		'options' => array(
			'' => esc_html__('Default', 'react-portfolio'),
			'random' => esc_html__('Random', 'react-portfolio'),
			'left top' => esc_html__('left top', 'react-portfolio'),
			'left center' => esc_html__('left center', 'react-portfolio'),
			'left bottom' => esc_html__('left bottom', 'react-portfolio'),
			'center top' => esc_html__('center top', 'react-portfolio'),
			'center center' => esc_html__('center center', 'react-portfolio'),
			'center bottom' => esc_html__('center bottom', 'react-portfolio'),
			'right top' => esc_html__('right top', 'react-portfolio'),
			'right center' => esc_html__('right center', 'react-portfolio'),
			'right bottom' => esc_html__('right bottom', 'react-portfolio')
		),
		'description' => esc_html__('Only applies to Serene (Full Screen) gallery', 'react-portfolio'),
		'tooltip' => esc_html__('Choosing Default will inherit the setting from the Portfolio &rarr; Settings page.', 'react-portfolio')
	),
	array(
		'name' => 'caption',
		'title' => esc_html__('Caption HTML', 'react-portfolio'),
		'type' => 'textarea',
		'description' => esc_html__('Enter the caption HTML, here is an example:', 'react-portfolio'),
		'example' => '<h3>Sample Title</h3>
<p>Sample description.</p>',
	),
	array(
		'type' => 'multiple',
		'title' => esc_html__('Video URL', 'react-portfolio'),
		'tooltip' => esc_html__('Enter the full URL including http://', 'react-portfolio'),
		'description' => esc_html__('Enter the URL for the video. The specified width and height will set the size of the lightbox popup, otherwise the default dimensions will be used from the Portfolio &rarr; Settings page.', 'react-portfolio'),
		'elements' => array(
			array(
				'name' => 'video',
				'title' => esc_html__('Video URL', 'react-portfolio'),
				'tooltip' => esc_html__('Enter the full URL including http://', 'react-portfolio'),
				'type' => 'text',
				'class' => 'tcap-width-400',
				'inline' => true
			),
			array(
				'name' => 'video_width',
				'title' => esc_html__('Width', 'react-portfolio'),
				'type' => 'number',
				'default' => '',
				'class' => 'tcap-width-50',
				'unit' => 'px',
				'inline' => true
			),
			array(
				'name' => 'video_height',
				'title' => esc_html__('Height', 'react-portfolio'),
				'type' => 'number',
				'default' => '',
				'class' => 'tcap-width-50',
				'unit' => 'px',
				'inline' => true
			)
		)
	),
	array(
		'type' => 'multiple',
		'title' => esc_html__('YouTube / Vimeo video URL', 'react-portfolio'),
		'tooltip' => esc_html__('Enter the full URL including http://', 'react-portfolio'),
		'description' => esc_html__('Enter the URL for the YouTube or Vimeo video. The width and height will be fetched automatically and determines the aspect ratio of the embedded video.', 'react-portfolio'),
		'elements' => array(
			array(
				'name' => 'video_embed',
				'title' => esc_html__('Video URL', 'react-portfolio'),
				'tooltip' => esc_html__('Enter the full URL including http://', 'react-portfolio'),
				'type' => 'text',
				'class' => 'tcap-width-400',
				'inline' => true
			),
			array(
				'name' => 'video_embed_width',
				'title' => esc_html__('Width', 'react-portfolio'),
				'type' => 'number',
				'default' => '',
				'class' => 'tcap-width-50',
				'unit' => 'px',
				'inline' => true
			),
			array(
				'name' => 'video_embed_height',
				'title' => esc_html__('Height', 'react-portfolio'),
				'type' => 'number',
				'default' => '',
				'class' => 'tcap-width-50',
				'unit' => 'px',
				'inline' => true
			)
		)
	),
	array(
		'name' => 'link',
		'title' => esc_html__('Link URL', 'react-portfolio'),
		'description' => esc_html__('Enter the URL to link to. Include http://', 'react-portfolio'),
		'type' => 'text',
		'class' => 'tcap-width-400'
	),
	array(
		'name' => 'link_target',
		'title' => esc_html__('Link target', 'react-portfolio'),
		'tooltip' => esc_html__('Specify how the link will be opened by the browser', 'react-portfolio'),
		'type' => 'select',
		'options' => array(
			'' => esc_html__('Open the link in the current window', 'react-portfolio'),
			'_blank' => esc_html__('Open the link in a new window or tab', 'react-portfolio')
		)
	),
	array(
		'type' => 'multiple',
		'title' => esc_html__('Masonry layout options', 'react-portfolio'),
		'description' => sprintf(esc_html__('Choose how many columns and rows this item should cover when displayed in the portfolio shortcode. Note: the Rows option requires the shortcode to have a fixed height and the attribute %s', 'react-portfolio'), 'masonry_use_layout_options="1"'),
		'elements' => array(
			array(
				'name' => 'masonry_columns',
				'title' => esc_html__('Columns', 'react-portfolio'),
				'type' => 'number',
				'default' => '',
				'class' => 'tcap-width-50',
				'inline' => true
			),
			array(
				'name' => 'masonry_rows',
				'title' => esc_html__('Rows', 'react-portfolio'),
				'tooltip' => esc_html__('The height of the post image will be multiplied by this number', 'react-portfolio'),
				'type' => 'number',
				'default' => '',
				'class' => 'tcap-width-50',
				'inline' => true
			)
		)
	)
);

new TcpMetaboxGenerator($config, $options);
