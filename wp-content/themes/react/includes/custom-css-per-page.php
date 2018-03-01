<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

$textureDetails = array(
	'intro' => '#intro',
	'body' => array('body', '#page', '#outside'),
	'background' => '.background-overlay'
);

/**
 * This loop will go through the array above, grab the options from $options
 * and send them to react_get_texture_detail_css to generate the CSS.
 */
foreach ($textureDetails as $key => $textureDetail) {
	$textureDetailData = array(
		'texture' => react_get_current_post_meta($key . '_texture', $react['options']['style_' . $key . '_texture']),
		'texture_opacity' => react_get_current_post_meta($key . '_texture_opacity', $react['options']['style_' . $key . '_texture_opacity'], '0'),
		'texture_fixed' => react_get_current_post_meta($key . '_texture_fixed', $react['options']['style_' . $key . '_texture_fixed']),
		'texture_large' => react_get_current_post_meta($key . '_texture_large', $react['options']['style_' . $key . '_texture_large']),
		'detail' => react_get_current_post_meta($key . '_detail', $react['options']['style_' . $key . '_detail']),
		'detail_opacity' => react_get_current_post_meta($key . '_detail_opacity', $react['options']['style_' . $key . '_detail_opacity'], '0'),
		'image' => react_get_upload_url($react['options']['style_' . $key . '_image']),
		'image_width' => $react['options']['style_' . $key . '_image_width'],
		'image_height' => $react['options']['style_' . $key . '_image_height'],
		'image_retina_use_main_img' => $react['options']['style_' . $key . '_image_retina_use_main_img'],
		'image_retina' => react_get_upload_url($react['options']['style_' . $key . '_image_retina']),
		'image_retina_width' => $react['options']['style_' . $key . '_image_retina_width'],
		'image_retina_height' => $react['options']['style_' . $key . '_image_retina_height'],
		'image_is_retina' => $react['options']['style_' . $key . '_image_is_retina'],
		'image_convert' => $react['options']['style_' . $key . '_image_convert'],
		'image_convert_custom' => $react['options']['style_' . $key . '_image_convert_custom'],
		'image_repeat' => $react['options']['style_' . $key . '_image_repeat'],
		'image_position' => $react['options']['style_' . $key . '_image_position'],
		'image_position_custom' => $react['options']['style_' . $key . '_image_position_custom'],
		'image_fixed' => $react['options']['style_' . $key . '_image_fixed'],
		'image_background_size' => $react['options']['style_' . $key . '_image_background_size'],
		'image_repeat_retina' => $react['options']['style_' . $key . '_image_repeat_retina'],
		'image_position_retina' => $react['options']['style_' . $key . '_image_position_retina'],
		'image_position_custom_retina' => $react['options']['style_' . $key . '_image_position_custom_retina'],
		'image_fixed_retina' => $react['options']['style_' . $key . '_image_fixed_retina'],
		'image_background_size_retina' => $react['options']['style_' . $key . '_image_background_size_retina'],
		'image_parallax' => $react['options']['style_' . $key . '_image_parallax'],
		'image_parallax_offset' => $react['options']['style_' . $key . '_image_parallax_offset']
	);

	if ($react['options']['style_' . $key . '_image_use_feat'] && has_post_thumbnail()) {
		$imageData = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		$textureDetailData['image'] = $imageData[0];
		$textureDetailData['image_width'] = $imageData[1];
		$textureDetailData['image_height'] = $imageData[2];
	}

	// Only use page-specific image options if an image is chosen for the page
	if (react_get_current_post_meta($key . '_image') || react_get_current_post_meta($key . '_image_use_feat')) {
		$textureDetailData['image'] = react_get_upload_url(react_get_current_post_meta($key . '_image'));
		$textureDetailData['image_width'] = react_get_current_post_meta($key . '_image_width');
		$textureDetailData['image_height'] = react_get_current_post_meta($key . '_image_height');
		$textureDetailData['image_retina_use_main_img'] = react_get_current_post_meta($key . '_image_retina_use_main_img');
		$textureDetailData['image_retina'] = react_get_upload_url(react_get_current_post_meta($key . '_image_retina'));
		$textureDetailData['image_retina_width'] = react_get_current_post_meta($key . '_image_retina_width');
		$textureDetailData['image_retina_height'] = react_get_current_post_meta($key . '_image_retina_height');
		$textureDetailData['image_is_retina'] = react_get_current_post_meta($key . '_image_is_retina');
		$textureDetailData['image_convert'] = react_get_current_post_meta($key . '_image_convert');
		$textureDetailData['image_convert_custom'] = react_get_current_post_meta($key . '_image_convert_custom');
		$textureDetailData['image_repeat'] = react_get_current_post_meta($key . '_image_repeat');
		$textureDetailData['image_position'] = react_get_current_post_meta($key . '_image_position');
		$textureDetailData['image_position_custom'] = react_get_current_post_meta($key . '_image_position_custom');
		$textureDetailData['image_fixed'] = react_get_current_post_meta($key . '_image_fixed');
		$textureDetailData['image_background_size'] = react_get_current_post_meta($key . '_image_background_size');
		$textureDetailData['image_repeat_retina'] = react_get_current_post_meta($key . '_image_repeat_retina');
		$textureDetailData['image_position_retina'] = react_get_current_post_meta($key . '_image_position_retina');
		$textureDetailData['image_position_custom_retina'] = react_get_current_post_meta($key . '_image_position_custom_retina');
		$textureDetailData['image_fixed_retina'] = react_get_current_post_meta($key . '_image_fixed_retina');
		$textureDetailData['image_background_size_retina'] = react_get_current_post_meta($key . '_image_background_size_retina');
		$textureDetailData['image_parallax'] = react_get_current_post_meta($key . '_image_parallax');
		$textureDetailData['image_parallax_offset'] = react_get_current_post_meta($key . '_image_parallax_offset');

		if (react_get_current_post_meta($key . '_image_use_feat') && has_post_thumbnail()) {
			$imageData = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
			$textureDetailData['image'] = $imageData[0];
			$textureDetailData['image_width'] = $imageData[1];
			$textureDetailData['image_height'] = $imageData[2];
		}
	}

	echo react_get_texture_detail_css($textureDetailData, $textureDetail);
}

$sidebarWidth = react_get_current_post_meta('sidebar_width', $react['options']['sidebar_width'], '0');
if ($sidebarWidth != 30) {
	echo '.right-sidebar #content, .left-sidebar #content {
		width: ' . (100 - absint($sidebarWidth)) . '%;
	}
	.right-sidebar #sidebar, .left-sidebar #sidebar,
	.right-sidebar.sdbr-line #content:before, .left-sidebar.sdbr-line #content:before {
		width: ' . absint($sidebarWidth) . '%;
	}
';
}

if (is_page_template('template-contact.php')) {
	/* Contact page - no form */
	$quformId = react_get_current_post_meta('quform_id', $react['options']['contact_quform_id']);
	if ($quformId == 'none') {
		echo '.contact-right-col {
					width: auto;
					margin-left: 0;
					padding-left: 0;
					float: none;
					display: block;
				}
				.contact-left-col {
					display: none;
				}
				.contact-type-wrap, .hidden-map {
					margin-left: 0;
					margin-right: 0;
				}
		';
	}
}

// Top/bottom vertical space
if ($react['options']['main_header_fixed']) {
	echo react_get_vertical_space_css('top', 'margin-top', '#outside .after-header-wrap', $react['options']['main_header_top_fix']);
} else {
	echo react_get_vertical_space_css('top', 'margin-top', '#outside .header-all');
}
echo react_get_vertical_space_css('bottom', 'margin-bottom', '.footer-all');

// Footer reveal
if ($react['options']['footer_position'] != 'fixed' && react_get_current_post_meta('footer_reveal', $react['options']['footer_reveal'])) {
	echo '
		@media (min-height: ' . absint(react_get_current_post_meta('footer_reveal_height', $react['options']['footer_reveal_height'], '-1')) . 'px) {
			.ft-reveal .footer-all {
				position: fixed;
				bottom: 0;
				left: 0;
				right: 0;
				z-index: 0;
			}
			.ft-reveal .footer-wrap {
				min-height: ' . absint(react_get_current_post_meta('footer_reveal_minheight', $react['options']['footer_reveal_minheight'], '-1')) . 'px;
			}
			.ft-reveal.ft-reveal-help .footer-all {
				opacity: 0;
				max-height: 0;
			}
			.ft-reveal .after-header-wrap {
				z-index: 1;
				position: relative;
			}
			.ft-reveal #page {
				padding-bottom: ' . absint(react_get_current_post_meta('footer_reveal_height', $react['options']['footer_reveal_height'], '-1')) . 'px;
			}
			body.page-template-template-note-block-php.ft-reveal #page,
			body.page-template-template-fullscreen-media-php.ft-reveal #page,
			body.page-template-template-no-content-style-php.ft-reveal #page {
				padding-bottom: 0;
			}
		}
	';

	$convert = react_get_current_post_meta('footer_convert');

	if ($convert === '') {
		$convert = $react['options']['footer_convert'];
		$custom = $react['options']['footer_convert_custom'];
	} else {
		$custom = react_get_current_post_meta('footer_convert_custom', '1000');
	}

	if ($convert != 'never') {
		echo react_get_convert_media_query($convert, $custom, 'max-width');
		echo '
				.ft-reveal .footer-all {
					position: relative !important;
					bottom: auto !important;
					left: auto !important;
					right: auto !important;
					z-index: auto !important;
				}
				.ft-reveal .footer-wrap {
					min-height: 0 !important;
				}
				.ft-reveal.ft-reveal-help .footer-all {
					opacity: 1 !important;
					max-height: 1500px !important;
				}
				.ft-reveal .after-header-wrap {
					z-index: auto !important;
				}
				.ft-reveal #page {
					padding-bottom: 0 !important;
				}
			}
		';
	}
}
