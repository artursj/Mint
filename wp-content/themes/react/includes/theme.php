<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * theme.php
 *
 * Front-end only functions
 */

if (!function_exists('react_body_classes')) :
/**
 * Add body classes
 *
 * @param array $classes
 * @return array
 */
function react_body_classes($classes)
{
	global $react;

	$classes[] = $react['layout'];

	if ($react['options']['page_loader'] == 'full') {
		$classes[] = 'page-loader-full';
	}

	if ($react['options']['footer_position'] == 'fixed') {
		$classes[] = 'ft-fix';
	}
	if ($react['options']['footer_position'] == 'hide-after-top') {
		$classes[] = 'hide-ft-after-top ft-fix';
	}

	if ($react['options']['pop_down_fixed']) {
		$classes[] = 'fix-pop';
		if ($react['options']['pop_down_fixed_full_height']) {
			$classes[] = 'full-pop';
		}
	} elseif ($react['options']['pop_down_fixed_full_height']) {
		$classes[] = 'full-pop-rel';
	}

	if ($react['options']['page_layout_stretched_content']) {
		if ($react['options']['page_layout_stretched_content_boxed_content']) {
			$classes[] = 'strch-cnt cnt-fld';
		} else {
			$classes[] = 'strch-cnt';
		}
	}

	if ($react['options']['page_layout_stretched_allheader']) {
		if ($react['options']['page_layout_stretched_allheader_boxed_content']) {
			$classes[] = 'strch-allhd allhd-fld';
		} else {
			$classes[] = 'strch-allhd';
		}
	}
	if ($react['options']['page_layout_stretched_allfoot']) {
		if ($react['options']['page_layout_stretched_allfoot_boxed_content']) {
			$classes[] = 'strch-allft allft-fld';
		} else {
			$classes[] = 'strch-allft';
		}
	}
	if ($react['options']['page_layout_stretched_top'] || $react['options']['page_layout_stretched_allheader']) {
		if ($react['options']['page_layout_stretched_top_boxed_content']) {
			$classes[] = 'strch-top top-fld';
		} else {
			$classes[] = 'strch-top';
		}
	}
	if ($react['options']['page_layout_stretched_subfoot'] || $react['options']['page_layout_stretched_allfoot']) {
		if ($react['options']['page_layout_stretched_subfoot_boxed_content']) {
			$classes[] = 'strch-sf sf-fld';
		} else {
			$classes[] = 'strch-sf';
		}
	}
	if ($react['options']['pop_down_trigger_absolute']) {
		$classes[] = 'pop-trig-abso';
	}
	if ($react['options']['page_layout_right_margin'] > -1 || $react['options']['page_layout_right_margin_phones'] > -1 || $react['options']['page_layout_right_margin_tablets'] > -1 ) {
		$classes[] = 'rgt-mrg';
	}
	if ($react['options']['page_layout_left_margin'] > -1 || $react['options']['page_layout_left_margin_phones'] > -1 || $react['options']['page_layout_left_margin_tablets'] > -1 ) {
		$classes[] = 'lft-mrg';
	}

	$topChoose = react_get_current_post_meta('page_layout_top_margin_choose');
	if ($topChoose == 'custom') {
		$topMargin = react_get_current_post_meta('page_layout_top_margin');
	} elseif ($topChoose != 'screen') {
		if ($react['options']['page_layout_top_margin'] > 0 || $react['options']['page_layout_top_margin_choose'] == 'screen') {
			$topMargin = 1;
		}
	} else {
		/* Screen height chosen for top margin in metabox options */
		$topMargin = 1;
	}
	if (isset($topMargin) && is_numeric($topMargin) && $topMargin > 0) {
		$classes[] = 't-mrg';
	}

	$bottomChoose = react_get_current_post_meta('page_layout_bottom_margin_choose');
	if ($bottomChoose == 'custom') {
		$bottomMargin = react_get_current_post_meta('page_layout_bottom_margin');
	} elseif ($bottomChoose != 'screen') {
		if ($react['options']['page_layout_bottom_margin'] > 0 || $react['options']['page_layout_bottom_margin_choose'] == 'screen') {
			$bottomMargin = 1;
		}
	} else {
		/* Screen height chosen for bottom margin in metabox options */
		$bottomMargin = 1;
	}
	if (isset($bottomMargin) && is_numeric($bottomMargin) && $bottomMargin > 0) {
		$classes[] = 'b-mrg';
	}

	if ($react['options']['page_layout_sections_margin'] > 0) {
		$classes[] = 'v-space';
	}

	if ($react['options']['general_logo_on_right']) {
		$classes[] = 'logo-r';
	} else {
		$classes[] = 'logo-df';
	}

	if ($react['options']['general_logo_above']) {
		$classes[] = 'logo-abv';
	}

	if ($react['options']['sub_footer_rtl']) {
		$classes[] = 'ft-rtl';
	}

	if ($react['options']['blog_boxed_style']) {
		$classes[] = 'blg-bxd';
	}

	if ($react['options']['woocommerce_boxed_style']) {
		$classes[] = 'woocom-bxd';
	}

	if ($react['options']['sidebar_boxed_style']) {
		$classes[] = 'sdbr-bxd';
	}

	if ($react['options']['sidebar_style']) {
		$classes[] = 'sdbr-line';
	}

	if ($react['options']['popdown_boxed_style']) {
		$classes[] = 'pop-bxd';
	}

	if ($react['options']['footer_boxed_style']) {
		$classes[] = 'foot-bxd';
	}

	if (react_get_current_post_meta('footer_reveal', $react['options']['footer_reveal'])) {
		$classes[] = 'ft-reveal';
		if (react_get_current_post_meta('footer_reveal_help', $react['options']['footer_reveal_help'])) {
			$classes[] = 'ft-reveal-help';
		}
	}

	if ($react['options']['widget_title_style'] == 'underline') {
		$classes[] = 'wgt-undrln';
	}
	if (($react['options']['show_tophead_desktop'] || $react['options']['show_tophead_phone'] || $react['options']['show_tophead_tablet'] || $react['options']['show_tophead_large']) && $react['options']['top_nav_convert'] != 'never') {
		$classes[] = 'device-right-nav';
	}
	if ($react['options']['nav_convert'] != 'never') {
		$classes[] = 'device-left-nav';
	}


	if ($react['options']['background_always_show_captions']) {
		if ($react['options']['background_always_show_captions_display'] == 'top') {
			$classes[] = 'fs-caption-only-top';
		}
		elseif ($react['options']['background_always_show_captions_display'] == 'bottom') {
			$classes[] = 'fs-caption-only-bottom';
		}
	}

	$classes[] = 'react-wp';

	// Page Layout
	$classes[] = react_sanitize_class(apply_filters('react_page_layout', $react['options']['page_layout']));

	$classes[] = react_sanitize_class($react['options']['header_tophead_type']);

	$bodyTexture = react_sanitize_class(react_get_current_post_meta('body_texture', $react['options']['style_body_texture']));
	$bodyDetail = react_sanitize_class(react_get_current_post_meta('body_detail', $react['options']['style_body_detail']));
	$bodyDetailOpacity = react_sanitize_class(react_get_current_post_meta('body_detail_opacity', $react['options']['style_body_detail_opacity'], '0'));

	if ($bodyTexture != 'none') {
		$classes[] = react_sanitize_class($bodyTexture);
	}
	if ($bodyDetail != 'none') {
		$classes[] = react_sanitize_class($bodyDetail . '-' . $bodyDetailOpacity);
	}

	if (is_page_template('template-note-block.php')) {
		$classes[] = react_sanitize_class(react_get_current_post_meta('note_block_align', 'left') . '-note-block-page');

		if (react_get_current_post_meta('note_block_header', false)) {
			$classes[] = 'note-block-header';
		}
	}

	if (function_exists('icl_object_id')) {
		$classes[] = 'react-wpml';
	}

	return $classes;
}
endif;
add_filter('body_class', 'react_body_classes');

if (!function_exists('react_page_loader')) :
/**
 * Display the full screen page loader HTML
 *
 * @return string
 */
function react_page_loader()
{
	if (react_get_option('page_loader') != 'full') {
		return;
	}

	echo '<div id="page-loader" class="page-loader">';

	$spinner = react_get_option('page_loader_style');

	if (substr($spinner, 0, 3) == 'sk-') {
		echo '<div class="page-loader-inner page-loader-spinkit">';
		echo '<div class="' . esc_attr(react_sanitize_class($spinner)) . '">';

		switch ($spinner) {
			case 'sk-double-bounce':
				echo '<div class="sk-child sk-double-bounce1"></div><div class="sk-child sk-double-bounce2"></div>';
				break;
			case 'sk-wave':
				echo '<div class="sk-rect sk-rect1"></div><div class="sk-rect sk-rect2"></div><div class="sk-rect sk-rect3"></div><div class="sk-rect sk-rect4"></div><div class="sk-rect sk-rect5"></div>';
				break;
			case 'sk-wandering-cubes':
				echo '<div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div>';
				break;
			case 'sk-chasing-dots':
				echo '<div class="sk-child sk-dot1"></div><div class="sk-child sk-dot2"></div>';
				break;
			case 'sk-three-bounce':
				echo '<div class="sk-child sk-bounce1"></div><div class="sk-child sk-bounce2"></div><div class="sk-child sk-bounce3"></div>';
				break;
			case 'sk-circle':
				echo '<div class="sk-child sk-circle1"></div><div class="sk-child sk-circle2"></div><div class="sk-child sk-circle3"></div><div class="sk-child sk-circle4"></div><div class="sk-child sk-circle5"></div><div class="sk-child sk-circle6"></div><div class="sk-child sk-circle7"></div><div class="sk-child sk-circle8"></div><div class="sk-child sk-circle9"></div><div class="sk-child sk-circle10"></div><div class="sk-child sk-circle11"></div><div class="sk-child sk-circle12"></div>';
				break;
			case 'sk-cube-grid':
				echo '<div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div>';
				break;
			case 'sk-fading-circle':
				echo '<div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div>';
				break;
			case 'sk-folding-cube':
				echo '<div class="sk-cube1 sk-cube"></div><div class="sk-cube2 sk-cube"></div><div class="sk-cube4 sk-cube"></div><div class="sk-cube3 sk-cube"></div>';
				break;
		}

		echo '</div></div>';
	} else {
		echo '<div class="' . esc_attr(react_sanitize_class('page-loader-inner ' . $spinner)) . '"></div>';
	}

	echo '</div>';
}
endif;
add_action('react_body_start', 'react_page_loader');

if (!function_exists('react_background_video')) :
/**
 * Print the background video HTML
 */
function react_background_video()
{
	global $react;
	if (isset($react['video'])) {
		if ($react['video']['type'] == 'vimeo') {
			$src = 'https://player.vimeo.com/video/' . $react['video']['id'] . '?title=0&byline=0&portrait=0&controls=0&api=1&player_id=video-background';
			echo '<div id="video-background-wrap"><iframe id="video-background" src="' . esc_url($src) . '" width="1920" height="1080" allowfullscreen style="border: 0;"></iframe></div>';
		} else {
			// YouTube
			echo '<div id="video-background-wrap"><div id="video-background"></div></div>';
		}
	}
}
endif;
add_action('react_body_start', 'react_background_video');

if (!function_exists('react_background_overlay')) :
/**
 * Print the background overlay texture div
 */
function react_background_overlay()
{
	global $react;
	$classes = array('background-overlay');

	$overlay = react_get_current_post_meta('background_texture', $react['options']['style_background_texture']);
	$detail = react_get_current_post_meta('background_detail', $react['options']['style_background_detail']);
	$detailOpacity = react_get_current_post_meta('background_detail_opacity', $react['options']['style_background_detail_opacity'], '0');

	if ($overlay == 'none' && $detail == 'none' && react_get_current_post_meta('background_image', $react['options']['style_background_image']) == '') {
		return;
	}

	if ($overlay != 'none') {
		$classes[] = $overlay;
	}
	if ($detail != 'none') {
		$classes[] = $detail . '-' . $detailOpacity;
	}

	echo '<div class="' . esc_attr(react_sanitize_class($classes)) . '"' . react_get_parallax_data('background') . '><div></div></div>';
}
endif;
add_action('react_body_start', 'react_background_overlay');

/**
 * JavaScript Detection
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function react_javascript_detection()
{
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'react_javascript_detection', 0);

if (!function_exists('react_enqueue_styles')) :
/**
 * Enqueue the theme styles
 */
function react_enqueue_styles()
{
	global $react;

	wp_enqueue_style('react-fonts', react_fonts_url(), array(), REACT_VERSION);

	// Get per-page CSS
	ob_start();
	include REACT_INCLUDES_DIR . '/custom-css-per-page.php';
	$css = ob_get_clean();
	$css = wp_strip_all_tags($css);

	if ($react['options']['advanced_combine_css'] && file_exists(REACT_CACHE_DIR . '/styles.css')) {
		wp_enqueue_style('react-styles-combined', react_cache_url('styles.css'), array(), $react['options']['last_saved']);

		if ($css) {
			wp_add_inline_style('react-styles-combined', $css);
		}
	} else {
		$styles = react_get_styles();
		foreach ($styles as $key => $style) {
			if (!in_array($key, $react['options']['advanced_disable_css'])) {
				wp_enqueue_style($key, $style['url'], $style['deps'], $style['version']);
			}
		}

		$animateCssFilename = react_get_animate_css_filename();
		if (file_exists(REACT_CACHE_DIR . '/' . $animateCssFilename)) {
			wp_enqueue_style('react-animate', react_cache_url($animateCssFilename), array(), $react['options']['last_saved']);
		}

		wp_enqueue_style('react-styles', react_url('css/styles.min.css'), array(), REACT_VERSION);

		if (is_rtl()) {
			wp_enqueue_style('react-styles-rtl', react_url('css/rtl.min.css'), array('react-styles'), REACT_VERSION);
		}

		$customCssFilename = react_get_custom_css_filename();
		if (file_exists(REACT_CACHE_DIR . '/' . $customCssFilename)) {
			wp_enqueue_style('react-custom', react_cache_url($customCssFilename), array(), $react['options']['last_saved']);
		}

		if (count($react['options']['custom_palettes'])) {
			$paletteChunksCount = ceil(count($react['options']['custom_palettes']) / 10);
			for ($i = 0; $i < $paletteChunksCount; $i++) {
				$paletteCssFilename = react_get_palette_css_filename($i);
				if (file_exists(REACT_CACHE_DIR . '/' . $paletteCssFilename)) {
					wp_enqueue_style('react-palette-' . $i, react_cache_url($paletteCssFilename), array(), $react['options']['last_saved']);
				}
			}
		}

		$wooCommerceCssFilename = react_get_woocommerce_css_filename();
		if (function_exists('is_woocommerce') && file_exists(REACT_CACHE_DIR . '/' . $wooCommerceCssFilename)) {
			wp_enqueue_style('react-woocommerce', react_cache_url($wooCommerceCssFilename), array(), $react['options']['last_saved']);
		}

		if (is_child_theme()) {
			wp_enqueue_style('react-child', react_child_url('style.css'), array(), REACT_VERSION);
		}

		if ($css) {
			wp_add_inline_style('react-styles', $css);
		}
	}
}
endif;
add_action('wp_enqueue_scripts', 'react_enqueue_styles');

if (!function_exists('react_fonts_url')) :
/**
 * Get the URL for Google fonts
 *
 * @return string
 */
function react_fonts_url()
{
	global $react;
	$fontsUrl = '';
	$families = array();
	$subsets = array();

	if ($react['options']['general_font'] == 'google'
		&& $react['options']['general_font_google_link']
		&& $react['options']['general_font_google_family']
	) {
		if (preg_match("/<link href=(\"|')(.+?)(\"|')/", $react['options']['general_font_google_link'], $headingMatches)) {
			parse_str(parse_url($headingMatches[2], PHP_URL_QUERY), $headingParams);

			if (isset($headingParams['family'])) {
				$families[] = $headingParams['family'];
			}

			if (isset($headingParams['subset'])) {
				foreach (explode(',', $headingParams['subset']) as $subset) {
					$subsets[] = trim($subset);
				}
			}
		}
	}

	if ($react['options']['general_font_text'] == 'google'
		&& $react['options']['general_font_text_selector']
		&& $react['options']['general_font_text_google_link']
		&& $react['options']['general_font_text_google_family']
	) {
		if (preg_match("/<link href=(\"|')(.+?)(\"|')/", $react['options']['general_font_text_google_link'], $contentMatches)) {
			parse_str(parse_url($contentMatches[2], PHP_URL_QUERY), $contentParams);

			if (isset($contentParams['family'])) {
				$families[] = $contentParams['family'];
			}

			if (isset($contentParams['subset'])) {
				foreach (explode(',', $contentParams['subset']) as $subset) {
					$subsets[] = trim($subset);
				}
			}
		}
	}

	$families = array_unique($families);
	$subsets = array_unique($subsets);

	if (count($families)) {
		$args = array(
			'family' => urlencode(join('|', $families)),
			'subset' => urlencode(join(',', $subsets))
		);

		$fontsUrl = add_query_arg($args, 'https://fonts.googleapis.com/css');
	}

	return $fontsUrl;
}
endif;

if (!function_exists('react_enqueue_scripts')) :
/**
 * Enqueue the theme scripts
 */
function react_enqueue_scripts()
{
	global $react;
	$scripts = react_get_scripts();

	if ($react['options']['advanced_combine_js'] && file_exists(REACT_CACHE_DIR . '/scripts.js')) {
		// Enqueue scripts that couldn't be combined because they need to be in <head>
		foreach ($scripts as $key => $script) {
			if (!$script['footer'] && !in_array($key, $react['options']['advanced_disable_js'])) {
				if (isset($script['reqs']) && $react['options'][key($script['reqs'])] != current($script['reqs'])) {
					continue;
				}
				wp_enqueue_script($key, $script['url'], $script['deps'], $script['version'], $script['footer']);
			}
		}

		wp_enqueue_script('react-scripts', react_cache_url('scripts.js'), array('jquery'), $react['options']['last_saved'], true);
	} else {
		foreach ($scripts as $key => $script) {
			if (!in_array($key, $react['options']['advanced_disable_js'])) {
				if (isset($script['reqs']) && $react['options'][key($script['reqs'])] != current($script['reqs'])) {
					continue;
				}
				wp_enqueue_script($key, $script['url'], $script['deps'], $script['version'], $script['footer']);
			}
		}

		// Theme scripts
		wp_enqueue_script('react-scripts', react_url('js/scripts.min.js'), array('jquery'), REACT_VERSION, true);
	}

	$post = get_queried_object();
	$postType = isset($post->post_type) ? $post->post_type : '';

	if (is_singular()
		&& get_option('thread_comments')
		&& comments_open()
		&& post_type_supports($postType, 'comments')
	) {
		wp_enqueue_script('comment-reply');
	}

	if (!empty($react['video']) && $react['video']['type'] == 'vimeo') {
		wp_enqueue_script('froogaloop');
	}

	if (!empty($react['audio'])){
		wp_enqueue_script('jplayer', react_url('js/jquery.jplayer.min.js'), array('jquery'),  '2.9.2', true);
	}

	wp_localize_script('react-scripts', 'reactL10n', react_script_l10n());
}
endif;
add_action('wp_enqueue_scripts', 'react_enqueue_scripts');

if (!function_exists('react_script_l10n')) :
/**
 * JavaScript localization and variable passing
 */
function react_script_l10n()
{
	global $react;

	list($cookieDomain, $cookiePath) = react_get_cookie_domain_path();

	$data = array(
		'themeUrl' => react_url(),
		'siteUrl' => site_url(),
		'homeUrl' => home_url(),
		'homeText' => react_t('Nav Home Text', $react['options']['nav_home_text']),
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'cookieDomain' => $cookieDomain,
		'cookiePath' => $cookiePath,
		'backgroundOptions' => react_background_options(),
		'hideMap' => esc_html(react_get_translation('hide_map', esc_html__('Hide map', 'react'))),
		'clickToUseMap' => esc_html(react_get_translation('click_to_use_map', esc_html__('Click to use map', 'react'))),
		'infomenu_dropdown_convert' => $react['options']['infomenu_dropdown_convert'],
		'infomenu_dropdown_convert_custom' => $react['options']['infomenu_dropdown_convert_custom'],
		'break_point_phone_ptr' => $react['options']['break_point_phone_ptr'],
		'break_point_phone_ldsp' => $react['options']['break_point_phone_ldsp'],
		'break_point_tablet_ptr' => $react['options']['break_point_tablet_ptr'],
		'break_point_tablet_ldsp' => $react['options']['break_point_tablet_ldsp'],
		'break_point_desktop' => $react['options']['break_point_desktop'],
		'break_point_tv' => $react['options']['break_point_tv'],
		'infomenu_dropdown_width' => $react['options']['infomenu_dropdown_width'],
		'general_sticky_header' => $react['options']['general_sticky_header'],
		'general_sticky_header_fullwidth' => $react['options']['general_sticky_header_fullwidth'],
		'postLikeNonce' => wp_create_nonce('react_post_like'),
		'popdown_start_point' => $react['options']['popdown_start_point'],
		'popdown_cookie_expires' => absint($react['options']['popdown_cookie_expires']),
		'footer_end_page_popout_cookie_expires' => absint($react['options']['footer_end_page_popout_cookie_expires']),
		'show_tooltips_social' => $react['options']['show_tooltips_social'],
		'show_tooltips_all' => $react['options']['show_tooltips_all'],
		'show_tooltips_footer' => $react['options']['show_tooltips_footer'],
		'show_tooltips_popdown' => $react['options']['show_tooltips_popdown'],
		'show_tooltips_images' => $react['options']['show_tooltips_images'],
		'show_tooltips_nav' => $react['options']['show_tooltips_nav'],
		'nav_show_home_icon' => $react['options']['nav_show_home_icon'],
		'smooth_scroll_links' => $react['options']['smooth_scroll_links'],
		'smooth_scroll_on_load' => $react['options']['smooth_scroll_on_load'],
		'smooth_scroll_offset' => $react['options']['smooth_scroll_offset'],
		'contrast_reverse' => $react['options']['contrast_reverse'],
		'rtl' => is_rtl(),
		'vertical_margins' => react_get_vertical_margin_config(),
		'page_loader' => $react['options']['page_loader'],
		'animateTablet' => $react['options']['advanced_enable_animations_tablet'],
		'animatePhone' => $react['options']['advanced_enable_animations_phone'],
		'sidr_displace' => $react['options']['sidr_displace'],
		'sidr_speed' => absint($react['options']['sidr_speed']),
		'fancybox_palette' => is_numeric($react['options']['fancybox_choose_scheme']) ? 'custom-palette-' . $react['options']['fancybox_choose_scheme'] : '',
		'blog_animation' => $react['options']['blog_animation'],
		'woocommerce_onsale_animation' => $react['options']['woocommerce_onsale_animation']
	);

	if (isset($react['video'])) {
		$data['video'] = $react['video'];
	}

	if (isset($react['audio'])) {
		$data['audio'] = $react['audio'];
	}

	if (isset($react['font'])) {
		$data['font'] = $react['font'];
	}

	if ($react['options']['sidebar_convert'] !== 'never') {
		$data['sidebar_convert'] = react_get_breakpoint_convert_option('sidebar_convert');
		$data['sidebar_masonry'] = $react['options']['sidebar_masonry'];
	}

	return array('l10n_print_after' => 'reactL10n = ' . wp_json_encode($data));
}
endif;

if (!function_exists('react_set_features')) :
/**
 * Set up the theme features
 */
function react_set_features()
{
	global $react;
	$react['layout'] = react_get_layout();
	react_set_background();
	react_set_video_background();
	react_set_audio_background();
}
endif;
add_action('template_redirect', 'react_set_features');

if (!function_exists('react_set_background')) :
/**
 * Set the background images
 */
function react_set_background()
{
	global $react;
	$specific = false;

	$sizes = array(
		'large' => array(
			'min' => $react['options']['break_point_tv'],
			'max' => 1000000
		),
		'desktops' => array(
			'min' => $react['options']['break_point_desktop'],
			'max' => $react['options']['break_point_tv'] - 1
		),
		'tablets' => array(
			'min' => $react['options']['break_point_phone_ldsp'] + 1,
			'max' => $react['options']['break_point_tablet_ldsp']
		),
		'phones' => array(
			'min' => 0,
			'max' => $react['options']['break_point_phone_ldsp']
		)
	);

	$groupIds = array(
		$react['options']['background_large'],
		$react['options']['background_desktops'],
		$react['options']['background_tablets'],
		$react['options']['background_phones']
	);

	$groupIds = apply_filters('react_background_groups', $groupIds);

	// Check for page specific background groups
	$i = 0;
	foreach ($sizes as $size => $data) {
		$groupId = react_get_current_post_meta('background_' . $size);
		if (is_string($groupId) && strlen($groupId)) {
			$groupIds[$i] = $groupId;
			$specific = true;
		}
		$i++;
	}

	$i = 0;
	foreach ($sizes as $size => $data) {
		$groupId = $groupIds[$i];

		if (is_numeric($groupId) && isset($react['options']['background_groups'][$groupId])) {
			$groupName = $react['options']['background_groups'][$groupId]['name'];
			$data['backgrounds'] = $react['options']['background_groups'][$groupId]['backgrounds'];

			foreach ($data['backgrounds'] as $key => $background) {
				$data['backgrounds'][$key] = react_wpml_translate_background_caption($background, $groupName);
			}
		} else {
			$data['backgrounds'] = array();
		}

		$backgrounds[] = $data;
		$i++;
	}

	$react['backgrounds'] = $backgrounds;
	$react['backgrounds_specific'] = $specific;
}
endif;

if (!function_exists('react_background_options')) :
/**
 * Set the background image options
 */
function react_background_options()
{
	global $react, $post;

	// Add the uploads URL to the image URL
	if (is_array($react['backgrounds'])) {
		foreach ($react['backgrounds'] as $key => $group) {
			foreach ($group['backgrounds'] as $subkey => $image) {
				$react['backgrounds'][$key]['backgrounds'][$subkey]['image'] = apply_filters('react_background_image_url', react_get_upload_url($image['image']));
			}
		}
	}

	return apply_filters('react_background_options', array(
		'backgrounds' => $react['backgrounds'],
		'speed' => (int) $react['options']['background_speed'],
		'transition' => $react['options']['background_transition'],
		'position' => $react['options']['background_position'],
		'fitLandscape' => $react['options']['background_fit_landscape'],
		'fitPortrait' => $react['options']['background_fit_portrait'],
		'fitAlways' => $react['options']['background_fit_always'],
		'positionX' => $react['options']['background_position_x'],
		'positionY' => $react['options']['background_position_y'],
		'easing' => $react['options']['background_easing'],
		'hideSpeed' => (int) $react['options']['background_hide_speed'],
		'showSpeed' => (int) $react['options']['background_show_speed'],
		'controlSpeed' => (int) $react['options']['background_control_speed'],
		'save' => $react['backgrounds_specific'] ? false : $react['options']['background_save'],
		'slideshow' => $react['options']['background_slideshow'],
		'slideshowAuto' => $react['options']['background_slideshow_auto'],
		'slideshowSpeed' => (int) $react['options']['background_slideshow_speed'],
		'random' => $react['options']['background_random'],
		'keyboard' => $react['options']['background_keyboard'],
		'captionPosition' => $react['options']['background_caption_position'],
		'alwaysShowCaptions' => (bool) react_get_current_post_meta('always_show_captions', $react['options']['background_always_show_captions']),
		'captionSpeed' => $react['options']['background_caption_speed'],
		'bullets' => $react['options']['background_bullets'],
		'lowQuality' => $react['options']['background_low_quality'],
		'breaker' => $react['options']['background_breaker'],
		'breakerOnMax' => $react['options']['background_breaker_on_max'],
		'errorBackground' => react_url('images/backgrounds/error.jpg'),
		'spinnerClass' => $react['options']['background_spinner_type']
	));
}
endif;

if (!function_exists('react_wpml_translate_background_caption')) :
/**
 * Translate the background title and caption using WPML, and parse shortcodes
 *
 * @param   array   $background  The background data
 * @param   string  $groupName   The name of the group
 * @return  array                The translated background data
 */
function react_wpml_translate_background_caption($background, $groupName)
{
	if ($groupName)  {
		$name = $groupName . ':' . basename($background['image']);
		$background['caption'] = do_shortcode(react_t("Background Image '{$name}' Caption", $background['caption']));
		$background['title'] = do_shortcode(react_t("Background Image '{$name}' Title", $background['title']));
	}

	return $background;
}
endif;

if (!function_exists('react_comment_list')) :
/**
 * Comments list
 */
function react_comment_list($comment, $args, $depth)
{
	switch ($comment->comment_type) {
		case 'pingback':
		case 'trackback':
			react_ping($comment, $args, $depth);
			break;
		default:
			react_comment($comment, $args, $depth);
			break;
	}
}
endif;

if (!function_exists('react_comment')) :
/**
 * Template for comments
 */
function react_comment($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<?php edit_comment_link('<i class="fa fa-pencil"></i> ' . esc_html__('Edit', 'react'), '<span class="edit-link">', '</span>'); ?>

			<div class="comment-author vcard">
				<?php
					$url = get_comment_author_url();

					if (!empty($url)) {
						echo '<a class="comment-avatar-link" rel="external nofollow" href="' . esc_url($url) . '" title="' . esc_attr(get_comment_author()) . '">' . get_avatar($comment, 40) . '</a>';
					} else {
						echo get_avatar($comment, 40);
					}
				 ?>
				<h2><?php printf(esc_html(react_get_translation('author_says', esc_html__('%1$s %2$ssays:%3$s', 'react'))), get_comment_author_link(), '<span class="says">', '</span>'); ?></h2>
			</div>

			<div class="comment-meta">
				<a href="<?php echo esc_url(get_comment_link()); ?>"><?php echo esc_html(sprintf(react_get_translation('date_at_time', esc_html__('%1$s at %2$s', 'react')), get_comment_date(), get_comment_time())); ?></a>
			</div>

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<div class="comment-awaiting-moderation"><?php echo esc_html(react_get_translation('comment_moderation', esc_html__('Your comment is awaiting moderation.', 'react'))); ?></div>
			<?php endif; ?>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link(array_merge($args, array('reply_text' => esc_html(react_get_translation('reply', esc_html__('Reply', 'react'))), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div>
		</div>
	<?php
}
endif;

if (!function_exists('react_ping')) :
/**
 * Template for pings
 */
function react_ping($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment; ?>
	<li class="post pingback">
		<p><?php echo esc_html(react_get_translation('pingback', esc_html__('Pingback:', 'react'))); ?> <?php comment_author_link(); ?><?php edit_comment_link('<i class="fa fa-pencil"></i> ' . esc_html__('Edit', 'react'), '<span class="edit-link">', '</span>'); ?></p>
	<?php
}
endif;

if (!function_exists('react_comments_link')) :
/**
 * Get the HTML for the Comment Reply button
 *
 * @return string
 */
function react_comments_link()
{
	if ( ! comments_open() || ! react_get_option('blog_show_reply')) {
		return;
	}

	$output = '<span class="comments-link">';
	ob_start();

	$number = get_comments_number(get_the_ID());

	$zero = '<span class="leave-reply">' . esc_html(react_get_translation('leave_reply', esc_html__('Leave a Reply', 'react'))) . '</span>';
	$one = wp_kses(__('<b>1</b> Reply', 'react'), array('b' => array()));
	$more = wp_kses(_n('<b>%s</b> Reply', '<b>%s</b> Replies', $number, 'react'), array('b' => array()));
	$more = sprintf($more, number_format_i18n($number));

	comments_popup_link($zero, $one, $more);

	$output .= ob_get_clean();
	$output .= '</span>';

	return $output;
}
endif;

if (!function_exists('react_entry_meta')) :
/**
 * The post meta section HTML
 *
 * @param   string  $extraClass  An extra class to add to the wrapper
 * @return  string
 */
function react_entry_meta($extraClass = '')
{
	global $post, $react;

	$output = '<div class="' . esc_attr(react_sanitize_class('entry-meta ' . $extraClass)) . '">';

	$output .= react_posted_on();

	$output .= react_cats_tags_list();

	if ($react['options']['blog_show_comment_count'] && ($commentCount = get_comments_number()) > 0) {
		$output .= '<span class="entry-meta-comments-wrap"><i class="fa fa-comment"></i> ' . absint($commentCount) . '</span>';
	}

	if ($react['options']['blog_show_like_count'] && ($likeCount = react_get_post_meta($post->ID, 'votes_count')) > 0) {
		$output .= '<span class="entry-meta-likes-wrap"><i class="fa ' . esc_attr(react_sanitize_class($react['options']['blog_post_like_icon'])) . '"></i> ' . absint($likeCount) . '</span>';
	}

	$output .= '</div>';

	return $output;
}
endif;

if (!function_exists('react_posted_on')) :
/**
 * Returns the line that says when the entry was posted
 */
function react_posted_on()
{
	global $post;
	$author = !empty($post->post_author) ? get_userdata($post->post_author) : false;

	if ($author instanceof WP_User) {
		$output = sprintf('%1$s <span class="vcard"><i class="fa fa-user"></i> <a class="url fn" href="%2$s" title="%3$s">%4$s</a></span>',
			'<span class="updated"><i class="fa fa-clock-o"></i> <a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_time(get_option('date_format'), $post)) . '</a></span>',
			esc_url(get_author_posts_url($author->ID)),
			esc_attr(sprintf(react_get_translation('view_all_posts_by', esc_attr__('View all posts by %s', 'react')), $author->display_name)),
			esc_html($author->display_name)
		);
	} else {
		$output = '<span class="updated"><i class="fa fa-clock-o"></i> <a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_time(get_option('date_format'), $post)) . '</a></span>';
	}

	return $output;
}
endif;

if (!function_exists('react_cats_tags_list')) :
/**
 * Returns the HTML for the tags and categories list for a post
 */
function react_cats_tags_list()
{
	global $react;
	$output = '';
	$postType = get_post_type();
	$showCats = $showTags = false;

	if ($postType == 'post') {
		if (is_singular()) {
			$showCats = $react['options']['blog_show_cats_single'];
			$showTags = $react['options']['blog_show_tags_single'];
		} else {
			$showCats = $react['options']['blog_show_cats'];
			$showTags = $react['options']['blog_show_tags'];
		}

		$catsTax = 'category';
		$tagsTax = 'post_tag';
	} elseif ($postType == 'portfolio') {
		if (is_singular()) {
			$showCats = $react['options']['portfolio_show_cats_single'];
			$showTags = $react['options']['portfolio_show_tags_single'];
		} else {
			$showCats = $react['options']['portfolio_show_cats'];
			$showTags = $react['options']['portfolio_show_tags'];
		}

		$catsTax = 'portfolio_category';
		$tagsTax = 'portfolio_tag';
	}

	if ($showCats) {
		$categoriesList = get_the_term_list(null, $catsTax, '', ' / ');
		if (strlen($categoriesList)) {
			$output .= sprintf('<span class="entry-meta-cats-wrap"><i class="fa fa-folder-open"></i> %s</span>',
				$categoriesList
			);
		}
	}

	if ($showTags) {
		$tagList = get_the_term_list(null, $tagsTax, '', ' / ');
		if (strlen($tagList)) {
			$output .= sprintf('<span class="entry-meta-tags-wrap"><i class="fa fa-tags"></i> %s</span>',
				$tagList
			);
		}
	}

	return $output;
}
endif;

if (!function_exists('react_author_bio_single')) :
/**
 * Display the author information below the single post content
 *
 * @param    string  $content  The current post content
 * @return   string            The new post content
 */
function react_author_bio_single($content)
{
	global $react;

	if ( ! is_single()) {
		return $content;
	}

	$postType = get_post_type();

	if (
		($postType === 'post' && $react['options']['blog_show_author_bio_single']) ||
		($postType === 'portfolio' && $react['options']['portfolio_show_author_bio_single'])
	) {
		$content .= react_get_author_bio();
	}

	return $content;
}
endif;
add_filter('the_content', 'react_author_bio_single');

if (!function_exists('react_get_author_bio')) :
/**
 * Get the author bio section HTML
 *
 * @return string
 */
function react_get_author_bio()
{
	$description = get_the_author_meta('user_description');

	// Don't show bio if the author has no Biographical Info
	if ( ! strlen($description)) {
		return;
	}

	$output = '<div class="author_bio_section custom-boxed-item clearfix">';
	$output .= get_avatar(get_the_author_meta('user_email'), 120) . '<h3 class="author_name"><i class="fa fa-user"></i> ' . esc_html(sprintf(react_get_translation('about_author', esc_html__('About %s', 'react')), get_the_author())) . '</h3>';
	$output .= '<div class="author_details">' . nl2br($description). '</div>';
	$output .= '</div>';

	return $output;
}
endif;

if (!function_exists('react_infomenu_slide_out_box')) :
/**
 * Get the HTML for the Infomenu slide out box
 *
 * @return string
 */
function react_infomenu_slide_out_box()
{
	$output = '<div id="slide-out-box" class="' . esc_attr(react_sanitize_class('im-box slide-out-box ' . react_get_option_palette_class('general_color_infomenu_slideout_choose_scheme'))) . '">
		<div class="im-box-wrap clearfix"></div>
	</div>';

	return $output;
}
endif;

if (!function_exists('react_get_option_palette_class')) :
/**
 * Get the palette class for the given theme option key
 *
 * @param   string  $key  The option key
 * @return  string        The palette class
 */
function react_get_option_palette_class($key)
{
	global $react;
	$class = '';

	if (isset($react['options'][$key]) && is_numeric($react['options'][$key])) {
		$class = 'custom-palette-' . $react['options'][$key];
	}

	return $class;
}
endif;

if (!function_exists('react_head_class')) :
/**
 * Get the classes for the header
 *
 * @param  string $class Additional class
 * @return array
 */
function react_head_class($class = '')
{
	global $react;
	$classes = array($class);

	if ($react['options']['style_mainhead_texture'] != 'none') {
		$classes[] = $react['options']['style_mainhead_texture'];
	}

	if ($react['options']['style_mainhead_detail'] != 'none') {
		$classes[] = $react['options']['style_mainhead_detail'] . '-' . $react['options']['style_mainhead_detail_opacity'];
	}

	return $classes;
}
endif;

if (!function_exists('react_content_class')) :
/**
 * Get the classes for the content-outer
 *
 * @param  string $class Additional class
 * @return array
 */
function react_content_class($class = '')
{
	global $react;
	$classes = array($class, $react['options']['sidebar_convert_columns']);

	if ($react['options']['style_content_texture'] != 'none') {
		$classes[] = $react['options']['style_content_texture'];
	}

	if ($react['options']['style_content_detail'] != 'none') {
		$classes[] = $react['options']['style_content_detail'] . '-' . $react['options']['style_content_detail_opacity'];
	}
	if (react_get_option_palette_class('sidebar_choose_scheme') != '') {
		$classes[] = 'match-' . react_get_option_palette_class('sidebar_choose_scheme');
	}

	if (is_page_template('template-note-block.php') && react_get_current_post_meta('note_block_palette') != '' ) {
		$classes[] = 'custom-palette-' . react_get_current_post_meta('note_block_palette', '');

	}

	return $classes;
}
endif;

if (!function_exists('react_subfooter_class')) :
/**
 * Get the classes for the sub footer
 *
 * @param  string $class An additional class
 * @return string
 */
function react_subfooter_class($class = '')
{
	global $react;
	$classes = array($class, $react['options']['footer_position']);

	if ($react['options']['style_subfoot_texture'] != 'none') {
		$classes[] = $react['options']['style_subfoot_texture'];
	}

	if ($react['options']['style_subfoot_detail'] != 'none') {
		$classes[] = $react['options']['style_subfoot_detail'] . '-' . $react['options']['style_subfoot_detail_opacity'];
	}

	$paletteClass = react_get_option_palette_class('general_color_subfoot_choose_scheme');
	if ($paletteClass) {
		$classes[] = $paletteClass;
	}

	return $classes;
}
endif;

if (!function_exists('react_popdown')) :
/**
 * Display the popdown
 */
function react_popdown()
{
	global $react;

	if (!$react['options']['show_popdown_desktop'] && !$react['options']['show_popdown_phone'] && !$react['options']['show_popdown_tablet'] && !$react['options']['show_popdown_large']) {
		return;
	}

	$popdownClasses = array('popdown', 'clearfix');
	if ($react['options']['style_popdown_texture'] != 'none') {
		$popdownClasses[] = $react['options']['style_popdown_texture'];
	}
	if ($react['options']['style_popdown_detail'] != 'none') {
		$popdownClasses[] = $react['options']['style_popdown_detail'] . '-' . $react['options']['style_popdown_detail_opacity'];
	}
	$paletteClass = react_get_option_palette_class('general_color_popdown_choose_scheme');
	if ($paletteClass) {
		$popdownClasses[] = $paletteClass;
	}
	?>
	<div id="popdown-trigger" class="<?php echo esc_attr(react_sanitize_class('animated ' . ($react['options']['pop_down_trigger_absolute'] ? ' abso-on' : ''))); ?>">
		<div class="<?php echo esc_attr(react_sanitize_class('trigger-inner ' . ($react['options']['pop_down_trigger_dismiss'] ? 'dismiss-on' : ''))); ?>">
			<i class="fa fa-angle-down"></i>
			<div class="trigger-wrap clearfix">
				<?php if ($react['options']['pop_down_trigger_dismiss']) : ?>
					<a title="<?php echo esc_attr(react_get_translation('dismiss', esc_attr__('Dismiss', 'react'))); ?>" class="popdown-close" href="#"><span class="x-close"></span></a>
				<?php endif; ?>
				<h3>
				<?php
					if ($popdownTriggerIcon = react_t('Popdown Trigger Icon', $react['options']['popdown_trigger_icon'])) : ?>
					<span class="popdown-icon"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($popdownTriggerIcon))); ?>"></i></span>
				<?php endif; ?>
				<?php echo esc_html(react_t('Popdown Trigger Heading', $react['options']['popdown_trigger_heading'])); ?>
				</h3>
				<?php
					if ($popdownTriggerDescription = react_t('Popdown Trigger Description', $react['options']['popdown_trigger_description'])) : ?>
					<p><?php echo esc_html($popdownTriggerDescription); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div id="popdown" class="<?php echo esc_attr(react_sanitize_class($popdownClasses)); ?>"<?php echo react_get_parallax_data('popdown'); ?>>
		<div class="popdown-inner-helper"><div class="popdown-inner clearfix">
			<div class="popdown-wrap clearfix">
				<div id="popdown-hide"><span class="x-close"></span><i class="fa fa-angle-up"></i></div>
				<div class="clearfix popdown-content">
					<?php
						if ($react['options']['popdown_content_type'] == 'html') {
							echo do_shortcode(react_t('Popdown Content', $react['options']['popdown_plain_content']));
						} else {
							react_popdown_widget_area();
						}
					?>
				</div>
			</div>
		</div></div>
	</div>
	<?php
}
endif;

if (!function_exists('react_tophead')) :
/**
 * Display the top header
 */
function react_tophead()
{
	global $react;
	$topheadClasses = array('clearfix');
	if ($react['options']['style_tophead_texture'] != 'none') {
		$topheadClasses[] = $react['options']['style_tophead_texture'];
	}
	if ($react['options']['style_tophead_detail'] != 'none') {
		$topheadClasses[] = $react['options']['style_tophead_detail'] . '-' . $react['options']['style_tophead_detail_opacity'];
	}
	?>
		<?php if ($react['options']['show_tophead_desktop'] || $react['options']['show_tophead_phone'] || $react['options']['show_tophead_tablet'] || $react['options']['show_tophead_large']) : ?>
			<div id="tophead" class="<?php echo esc_attr(react_sanitize_class($topheadClasses)); ?>"<?php echo react_get_parallax_data('tophead'); ?>>
				<div class="tophead-inner-helper"><div class="tophead-inner clearfix">
					<div class="tophead-wrap clearfix">
						<div class="<?php echo esc_attr(react_sanitize_class('contact-details-top-head ' . $react['options']['head_contact_style'])); ?>">
							<?php if ($headerContactPhone = react_t('Top Header Phone', $react['options']['header_contact_phone'])) : ?>
								<div class="phone-wrap method">
									<div class="phone"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['header_contact_phone_icon']))); ?>"></i>
									<?php echo esc_html($headerContactPhone); ?></div>
								</div>
							<?php endif; ?>
							<?php if ($headerContactPhoneSales = react_t('Top Header Phone Sales', $react['options']['header_contact_phone_sales'])) : ?>
								<div class="phone-wrap method">
									<div class="phone"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['header_contact_phone_sales_icon']))); ?>"></i>
									<?php echo esc_html($headerContactPhoneSales); ?></div>
								</div>
							<?php endif; ?>
							<?php if ($headerContactPhoneSupport = react_t('Top Header Phone Support', $react['options']['header_contact_phone_support'])) : ?>
								<div class="phone-wrap method">
									<div class="phone"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['header_contact_phone_support_icon']))); ?>"></i>
									<?php echo esc_html($headerContactPhoneSupport); ?></div>
								</div>
							<?php endif; ?>
							<?php if (($contactQuformId = apply_filters('react_head_contact_quform_id', $react['options']['head_contact_quform_id'])) !== 'none') : ?>
								<div class="email-wrap method">
									<div class="email"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['head_contact_quform_id_icon']))); ?>"></i>
									<?php if (function_exists('iphorm_popup')) echo iphorm_popup($contactQuformId, react_t('Top Header Contact Form Trigger', $react['options']['head_contact_quform_id_trigger'])); ?></div>
								</div>
							<?php endif; ?>
							<?php if (($contactQuformIdSales = apply_filters('react_head_contact_quform_id_sales', $react['options']['head_contact_quform_id_sales'])) !== 'none') : ?>
								<div class="email-wrap method">
									<div class="email"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['head_contact_quform_id_sales_icon']))); ?>"></i>
									<?php if (function_exists('iphorm_popup')) echo iphorm_popup($contactQuformIdSales, react_t('Top Header Sales Form Trigger', $react['options']['head_contact_quform_id_sales_trigger'])); ?></div>
								</div>
							<?php endif; ?>
							<?php if (($contactQuformIdSupport = apply_filters('react_head_contact_quform_id_support', $react['options']['head_contact_quform_id_support'])) !== 'none') : ?>
								<div class="email-wrap method">
									<div class="email"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['head_contact_quform_id_support_icon']))); ?>"></i>
									<?php if (function_exists('iphorm_popup')) echo iphorm_popup($contactQuformIdSupport, react_t('Top Header Support Form Trigger', $react['options']['head_contact_quform_id_support_trigger'])); ?></div>
								</div>
							<?php endif; ?>

							<?php if ($topHeaderInfoBox = react_t('Top Header Info Box', $react['options']['top_header_info_box'])) : ?>
								<div class="contact-info-drop-wrap open-close-wrap">
									<span><a class="contact-info-drop-trigger" id="open-close-trigger" href="#"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['top_header_info_box_icon']))); ?>"></i></a></span>
									<div class="contact-info-drop open-close-content">
										<?php echo do_shortcode($topHeaderInfoBox); ?>
										<span id="open-close-close">x</span>
									</div>
								</div>
							<?php endif; ?>


						   <?php
							if (has_nav_menu('top-menu') && ($react['options']['head_contact_style']) != 'split-nav' || ($react['options']['top_header_info_box']) != '') {
								echo ' <span class="divide"></span>' ;
								}
							?>

						</div>

						<!-- Nav on top -->
						<?php
							$navClasses = array('top-head-menu', 'clearfix', $react['options']['tophead_nav_desc_location'], $react['options']['tophead_nav_style']);
							if ($react['options']['tophead_nav_style_upper']) {
								$navClasses[] = 'upperc-nav';
							}
						?>

						<nav class="<?php echo esc_attr(react_sanitize_class($navClasses)); ?>">
						<?php
							if (has_nav_menu('top-menu')) {
								echo wp_nav_menu(array(
									'theme_location' => 'top-menu',
									'menu_class' => 'top-menu react-menu',
									'echo' => false,
									'container' => false,
									'walker' => new React_Description_Walker()
								));
							}
						?>

						</nav>

						<?php if ($react['options']['controls_location_fs'] == 'top-header') : ?>
							<div id="fs-controls"><i class="<?php echo esc_attr(react_sanitize_class('sml iconsprite images ' . $react['options']['general_color_global_primary_icon_image'])); ?>"></i><?php if ($react['options']['controls_location_fs_label']) : ?><span class="label"><?php echo esc_html(react_get_translation('background', esc_html__('Background', 'react'))); ?></span><?php endif; ?></div>
						<?php endif; ?>
						<?php if ($react['options']['controls_location_video'] == 'top-header') : ?>
							<?php if (isset($react['video'])) : ?>
								<div id="video-controls"><i class="<?php echo esc_attr(react_sanitize_class('sml iconsprite film ' . $react['options']['general_color_global_primary_icon_image'])); ?>"></i><?php if ($react['options']['controls_location_video_label']) : ?><span class="label"><?php echo esc_html(react_get_translation('video', esc_html__('Video', 'react'))); ?></span><?php endif; ?></div>
							<?php endif; ?>
						<?php endif; ?>
						<?php if ($react['options']['controls_location_audio'] == 'top-header') : ?>
							<?php if (isset($react['audio'])) : ?>
								<div id="audio-controls"><i class="<?php echo esc_attr(react_sanitize_class('sml iconsprite music ' . $react['options']['general_color_global_primary_icon_image'])); ?>"></i><?php if ($react['options']['controls_location_audio_label']) : ?><span class="label"><?php echo esc_html(react_get_translation('audio', esc_html__('Audio', 'react'))); ?></span><?php endif; ?></div>
							<?php endif; ?>
						<?php endif; ?>

						<?php react_social_icons($react['options']['show_header_social_icon'], $react['options']['header_social_icon_type'], $react['options']['header_social_icon_animation']); ?>

					</div><!-- wrap -->
				</div></div><!-- inner -->
			</div><!-- #tophead -->
		<?php else : ?>
		<?php endif;
}
endif;

if (!function_exists('react_social_icons')) :
/**
 * Display the social icons
 *
 * @param  boolean  $show       Whether or not to show the social icons
 * @param  string   $type       The type of icon
 * @param  string   $animation  The hover animation class
 */
function react_social_icons($show, $type, $animation = '')
{
	global $react;
	if ($show) {
		$isType1 = $type == 'type-1';
		$socials = react_get_socials();

		echo '<div class="' . esc_attr(react_sanitize_class(array('social-icon-outer', $type, 'clearfix'))) . '">';

		foreach ($socials as $key => $social) {
			if ($react['options'][$key . '_url']) {
				$class = $key . ' ' . $animation;
				if ($social['fc'] && $isType1) {
					echo '<div class="' . esc_attr(react_sanitize_class(array('social-icon-wrap', $key))) . '"><a title="' . esc_attr($social['name']) . '" class="' . esc_attr(react_sanitize_class('fc-webicon ' . $class)) . '" href="' . esc_url($react['options'][$key . '_url']) . '"></a></div>';
				} elseif ($social['fa'] && !$isType1) {
					$iconClass = 'fa fa-' . (isset($social['fa_class']) ? $social['fa_class'] : $key);
					echo '<div class="' . esc_attr(react_sanitize_class(array('social-icon-wrap', $key))) . '"><a title="' . esc_attr($social['name']) . '" class="' . esc_attr(react_sanitize_class($class)) . '" href="' . esc_url($react['options'][$key . '_url']) . '"><i class="' . esc_attr(react_sanitize_class($iconClass)) . '"></i></a></div>';
				}
			}
		}

		echo '</div>';
	}
}
endif;

if (!function_exists('react_page_animated')) :
/**
 * Is the page animated
 *
 * @return  string
 */
function react_page_animated()
{
	global $react;
	$classes = array('clearfix');
	$output = '';

	if ($react['options']['page_animated']) {
		$classes[] = react_get_animation_class($react['options']['page_animated']);
		$output .= ' data-animation="' . esc_attr($react['options']['page_animated']) . '"';

		if ($react['options']['page_animated_delay']) {
			$output .= ' data-animation-delay="' . esc_attr($react['options']['page_animated_delay']) . '"';
		}
	}

	$output .= ' class="' . esc_attr(react_sanitize_class($classes)) . '"' ;

	return $output;
}
endif;

if (!function_exists('react_logo')) :
/**
 * Display the logo
 */
function react_logo()
{
	global $react;
	$title = react_t('Logo Title', $react['options']['general_logo_title']);
	$alt = react_t('Logo Alt', $react['options']['general_logo_alt']);
	$strapline = react_t('Logo Strapline', $react['options']['general_logo_strapline']);
	$strapline_highlight = react_t('Highlighted text', $react['options']['general_logo_strapline_highlighted']);
	$src = react_get_upload_url($react['options']['general_logo']);

	if ($strapline === '' && $src === '') {
		return '';
	}

	echo '<div class="logo">';

	if ($src !== '') {
		$linkUrl = apply_filters('react_logo_link_url', home_url());

		echo '<a href="' . esc_url($linkUrl) . '">';
		echo '<img src="' . esc_url($src) . '"' . ($title !== '' ? ' title="' . esc_attr($title) . '"' : '') . ' alt="' . esc_attr($alt) . '">';
		echo '</a>';
	}

	if ($strapline !== '') {
		if (!$strapline_highlight) {
			echo '<span class="strap-line">' . do_shortcode($strapline) . '</span>';
		} else {
			echo '<span class="strap-line"><span class="highlighted-text">' . do_shortcode($strapline) . '</span></span>';
		}
	}

	echo '</div>';
}
endif;
add_action('react_header', 'react_logo');

if (!function_exists('react_logo_link_url')) :
/**
 * Filter the logo link URL
 *
 * If a URL has been set in the theme options, use it
 *
 * @param   string
 * @return  string
 */
function react_logo_link_url($url)
{
	global $react;

	return $react['options']['general_logo_url'] ? $react['options']['general_logo_url'] : $url;
}
endif;
add_filter('react_logo_link_url', 'react_logo_link_url');

if (!function_exists('react_primary_menu')) :
/**
 * Display the primary menu
 */
function react_primary_menu()
{
	global $react;
	$classes = array(
		$react['options']['head_nav_desc_location'],
		$react['options']['general_nav_align'],
		$react['options']['head_nav_style']
	);

	if ($react['options']['head_nav_style_upper']) {
		$classes[] = 'upperc-nav';
	}

	?><nav id="nav-wrap" class="<?php echo esc_attr(react_sanitize_class($classes)) ?>">
		<div id="nav-wrap-inner" class="clearfix">
			<?php if ($react['options']['show_tophead_desktop'] || $react['options']['show_tophead_phone'] || $react['options']['show_tophead_tablet'] || $react['options']['show_tophead_large']) : ?>
				<div class="<?php echo esc_attr(react_sanitize_class('device-top-menu-trigger-wrap ' . $react['options']['sidr_trigger_style'])); ?>">
					<div class="device-top-menu-trigger"><i class="fa fa-reorder"></i></div>
				</div>
			<?php endif; ?>
			<?php react_infomenu(); ?>
			<div class="react-menu-inline">
				<?php if ($react['options']['nav_prime_nav_location'] == 'prime_nav_in_head') : ?>
					<?php if ($react['options']['nav_show_home_icon']) : ?>
						<!--Back home icon-->
						<div class="<?php echo esc_attr(react_sanitize_class('back-home-icon ' . $react['options']['nav_home_icon_style'])); ?>">
							<a href="<?php echo esc_url(home_url()); ?>" class="back-home">

							<?php if ($react['options']['nav_home_icon_style'] == 'button') : ?>
								<span class="<?php echo esc_attr(react_sanitize_class('sml iconsprite home ' . $react['options']['general_color_global_primary_icon_image'])); ?> "></span>
							<?php elseif ($react['options']['nav_home_icon_style'] == 'plain-dark') : ?>
								<span class="drk sml iconsprite home"></span>
							<?php elseif ($react['options']['nav_home_icon_style'] == 'plain-light') : ?>
								<span class="lgt sml iconsprite home"></span>
							<?php endif; ?>

							</a>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<div class="<?php echo esc_attr(react_sanitize_class('device-menu-trigger-wrap ' . $react['options']['sidr_trigger_style'])); ?>">
					<div class="device-menu-trigger"><i class="fa fa-reorder"></i></div>
				</div>


				<?php if ($react['options']['nav_prime_nav_location'] == 'prime_nav_in_head') : ?>
					<?php
						if (has_nav_menu('primary-menu')) {
							echo wp_nav_menu(array(
								'theme_location' => 'primary-menu',
								'menu_class' => 'primary-menu react-menu',
								'echo' => false,
								'container' => false,
								'walker' => new React_Description_Walker()
							));
						} else {
							echo '<ul class="primary-menu react-menu">' . wp_list_pages(array(
								'title_li' => '',
								'echo' => false
							)) . '</ul>';
						}
					?>
				<?php endif; ?>

				<?php if ($react['options']['nav_prime_nav_location'] == 'prime_nav_in_solo') : ?>
					<?php
						if (has_nav_menu('secondary-menu')) {
							echo wp_nav_menu(array(
								'theme_location' => 'secondary-menu',
								'menu_class' => 'secondary-menu react-menu',
								'echo' => false,
								'container' => false,
								'walker' => new React_Description_Walker()
							));
						}
					?>
				<?php endif; ?>

			</div>
		</div><!-- #nav-wrap-inner -->
	</nav><!-- #nav-wrap --><?php
}
endif;
add_action('react_header', 'react_primary_menu');

if (!function_exists('react_infomenu')) :
/**
 * Get the infomenu HTML
 */
function react_infomenu()
{
	global $react;

	if (!$react['options']['im_videocontrols_on'] &&
		!$react['options']['im_audiocontrols_on'] &&
		!$react['options']['im_fscontrols_on'] &&
		!$react['options']['im_search_on'] &&
		!$react['options']['im_location_on'] &&
		!$react['options']['im_video_on'] &&
		!$react['options']['im_contact_on'] &&
		!$react['options']['im_woocart_on'] &&
		$react['options']['controls_location_fs'] != 'infomenu' &&
		$react['options']['controls_location_audio'] != 'infomenu' &&
		$react['options']['controls_location_video'] != 'infomenu' &&
		!count($react['options']['im_custom_widget_areas'])
	) {
		return;
	}

	$classes = array(
		'info-menu-ul',
		$react['options']['infomenu_nav_style'],
		$react['options']['infomenu_nav_description'],
		$react['options']['general_color_infomenu_icon_image']
	);

	?>
	<div class="info-menu clearfix">
		<ul class="<?php echo esc_attr(react_sanitize_class($classes)); ?>">

			<?php foreach ($react['options']['im_order'] as $id) :
					$paletteClass = react_get_option_palette_class('general_color_infomenu_popout_choose_scheme');
					switch ($id) {
						case 'search':
							if ($react['options']['im_search_on']) : ?>
							<li>
								<a class="im-trigger" data-type="<?php echo esc_attr($react['options']['im_display_type_search']); ?>"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['im_display_icon_search']))); ?>"></i><span class="im-desc"><?php echo esc_html(react_t('Info Menu Search Title', $react['options']['im_display_text_search'])); ?></span></a>
								<div id="im-box-search" class="<?php echo esc_attr(react_sanitize_class('im-box im-drop im-search clearfix ' . $paletteClass)); ?>">
									<div class="im-box-inner clearfix">
										<!--Search-->
										<div class="search-container clearfix">
											<form action="<?php echo esc_url(home_url()); ?>" method="get">
												<div class="search-input-wrap">
													<input placeholder="<?php echo esc_attr(react_get_translation('type_here_to_search', esc_attr__('Type here to search', 'react'))); ?>" class="search-input" name="s" />
												</div>
												<div class="search-button-wrap">
													<input type="submit" value="<?php echo esc_attr(react_get_translation('go', esc_attr__('Go', 'react'))); ?>" />
												</div>
											</form>
										</div>
										<?php if ($react['options']['im_tag_cloud']) : ?>
										<div class="tag-cloud clearfix">
											<div class="tag-cloud-toggle react-accordion react-toggle">
												<h3><?php echo esc_html(react_get_translation('or_select_a_tag', esc_html__('Or select a tag', 'react'))); ?></h3>
												<div class="tag-cloud-toggle-content react-accordion-content-wrap">
													<?php wp_tag_cloud(array(
														'largest' => 13,
														'smallest' => 13,
														'unit' => 'px',
														'format' => 'list'
													)); ?>
												</div>
											</div>
										</div>
										<?php endif; ?>
										<a class="im-close close2"><span class="x-close"></span><i class="fa fa-angle-up"></i></a>
									</div>
								</div>
							</li>
							<?php endif;
							break;
						case 'location':
							if ($react['options']['im_location_on']) : ?>
							<li>
								<a class="im-trigger" data-type="<?php echo esc_attr($react['options']['im_display_type_location']); ?>"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['im_display_icon_location']))); ?>"></i><span class="im-desc"><?php echo esc_html(react_t('Info Menu Location Title', $react['options']['im_display_text_location'])); ?></span></a>
								<div id="im-box-location" class="<?php echo esc_attr(react_sanitize_class('im-box im-drop im-location clearfix ' . $paletteClass)); ?>">
									<div class="im-box-inner clearfix">
										<div class="flexible-frame im-map">
											<?php echo do_shortcode($react['options']['im_contact_map']) ?>
										</div>

										<a class="im-close close2 animated"><span class="x-close"></span><i class="fa fa-angle-up"></i></a>
									</div>
								</div>
							</li>
							<?php endif;
							break;
						case 'video':
							if ($react['options']['im_video_on']) : ?>
							<li>
								<a class="im-trigger" data-type="<?php echo esc_attr($react['options']['im_display_type_video']); ?>"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['im_display_icon_video']))); ?>"></i><span class="im-desc"><?php echo esc_html(react_t('Info Menu Video Title', $react['options']['im_display_text_video'])); ?></span></a>
								<div id="im-box-video" class="<?php echo esc_attr(react_sanitize_class('im-box im-drop im-video clearfix ' . $paletteClass)); ?>">
									<div class="im-box-inner clearfix">
										<div class="flexible-frame im-video">
											<?php echo do_shortcode($react['options']['im_video']) ?>
										</div>

										<a class="im-close close2"><span class="x-close"></span><i class="fa fa-angle-up"></i></a>
									</div>
								</div>
							</li>
							<?php endif;
							break;
						case 'contact':
							if ($react['options']['im_contact_on']) : ?>
							<li>
								<a class="im-trigger" data-type="<?php echo esc_attr($react['options']['im_display_type_contact']); ?>"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['im_display_icon_contact']))); ?>"></i><span class="im-desc"><?php echo esc_html(react_t('Info Menu Contact Title', $react['options']['im_display_text_contact'])); ?></span></a>
								<div id="im-box-contact" class="<?php echo esc_attr(react_sanitize_class('im-box im-drop im-contact clearfix ' . $paletteClass . ($react['options']['im_scroll_type_contact'] ? ' scroll' : ''))); ?>">
									<div class="im-box-inner clearfix">
										<?php
											if (($contactQuformIdInfomenu = apply_filters('react_contact_quform_id_infomenu', $react['options']['contact_quform_id_infomenu'])) != 'none') {
												if (function_exists('iphorm')) echo iphorm($react['options']['contact_quform_id_infomenu']);
											}
										?>
										<a class="im-close close2"><span class="x-close"></span><i class="fa fa-angle-up"></i></a>
									</div>
								</div>
							</li>
							<?php endif;
							break;
						case 'fscontrols':
							if ($react['options']['im_fscontrols_on'] && $react['options']['controls_location_fs'] == 'infomenu') : ?>
							<li>
								<a class="im-trigger" data-type="<?php echo esc_attr($react['options']['im_display_type_fscontrols']); ?>"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['im_display_icon_fscontrols']))); ?>"></i><span class="im-desc"><?php echo esc_html(react_t('Info Menu Background Controls Title', $react['options']['im_display_text_fscontrols'])); ?></span></a>
								<div id="im-box-fscontrols" class="<?php echo esc_attr(react_sanitize_class('im-box im-drop im-fscontrols clearfix ' . $paletteClass)); ?>">
									<div class="im-box-inner clearfix">

											<div id="fs-controls"><i class="<?php echo esc_attr(react_sanitize_class('sml iconsprite images ' . $react['options']['general_color_global_primary_icon_image'])); ?>"></i><?php if ($react['options']['controls_location_fs_label']) : ?><span class="label"><?php echo esc_html(react_get_translation('background', esc_html__('Background', 'react'))); ?></span><?php endif; ?></div>

										<a class="im-close close2"><span class="x-close"></span><i class="fa fa-angle-up"></i></a>
									</div>
								</div>
							</li>
							<?php endif;
							break;
						case 'audiocontrols':
							if ($react['options']['im_audiocontrols_on'] && $react['options']['controls_location_audio'] == 'infomenu') : ?>
							<li>
								<a class="im-trigger" data-type="<?php echo esc_attr($react['options']['im_display_type_audiocontrols']); ?>"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['im_display_icon_audiocontrols']))); ?>"></i><span class="im-desc"><?php echo esc_html(react_t('Info Menu Audio Controls Title', $react['options']['im_display_text_audiocontrols'])); ?></span></a>
								<div id="im-box-audiocontrols" class="<?php echo esc_attr(react_sanitize_class('im-box im-drop im-audiocontrols clearfix ' . $paletteClass)); ?>">
									<div class="im-box-inner clearfix">

										<?php if (isset($react['audio'])) : ?>
											<div id="audio-controls"><i class="<?php echo esc_attr(react_sanitize_class('sml iconsprite music ' . $react['options']['general_color_global_primary_icon_image'])); ?>"></i><?php if ($react['options']['controls_location_audio_label']) : ?><span class="label"><?php echo esc_html(react_get_translation('audio', esc_html__('Audio', 'react'))); ?></span><?php endif; ?></div>
										<?php endif; ?>

										<a class="im-close close2"><span class="x-close"></span><i class="fa fa-angle-up"></i></a>
									</div>
								</div>
							</li>
							<?php endif;
							break;
						case 'videocontrols':
							if ($react['options']['im_videocontrols_on'] && $react['options']['controls_location_video'] == 'infomenu') : ?>
							<li>
								<a class="im-trigger" data-type="<?php echo esc_attr($react['options']['im_display_type_videocontrols']); ?>"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['im_display_icon_videocontrols']))); ?>"></i><span class="im-desc"><?php echo esc_html(react_t('Info Menu Video Controls Title', $react['options']['im_display_text_videocontrols'])); ?></span></a>
								<div id="im-box-videocontrols" class="<?php echo esc_attr(react_sanitize_class('im-box im-drop im-videocontrols clearfix ' . $paletteClass)); ?>">
									<div class="im-box-inner clearfix">

									<?php if (isset($react['video'])) : ?>
										<div id="video-controls"><i class="<?php echo esc_attr(react_sanitize_class('sml iconsprite film ' . $react['options']['general_color_global_primary_icon_image'])); ?>"></i><?php if ($react['options']['controls_location_video_label']) : ?><span class="label"><?php echo esc_html(react_get_translation('video', esc_html__('Video', 'react'))); ?></span><?php endif; ?></div>
									<?php endif; ?>

										<a class="im-close close2"><span class="x-close"></span><i class="fa fa-angle-up"></i></a>
									</div>
								</div>
							</li>
							<?php endif;
							break;
						case 'woocart':
							if ($react['options']['im_woocart_on'] && function_exists('is_woocommerce') && function_exists('is_cart') && function_exists('is_checkout') && !is_cart() && !is_checkout()) :
								$count = WC()->cart->cart_contents_count;
								?><li>
									<a class="im-trigger" data-type="<?php echo esc_attr($react['options']['im_display_type_woocart']); ?>"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($react['options']['im_display_icon_woocart']))); ?>"></i><span class="im-desc"><?php echo esc_html(react_t('Info Menu Cart Title', $react['options']['im_display_text_woocart'])); ?></span><span id="im-woocart-count-outer" class="im-woocart-count-outer"><span class="im-woocart-count"><?php echo absint($count); ?></span></span></a>
									<div id="im-box-woocart" class="<?php echo esc_attr(react_sanitize_class('im-box im-drop im-woocart clearfix ' . $paletteClass)); ?>">
										<div class="im-box-inner clearfix">
											<h3 class="im-basket-title"><?php echo esc_html(react_t('Info Menu Cart Title', $react['options']['im_display_text_woocart'])); ?></h3>
											<?php the_widget('WC_Widget_Cart'); ?>
											<a class="im-close close2"><span class="x-close"></span><i class="fa fa-angle-up"></i></a>
										</div>
									</div>
								</li>
							<?php endif;
							break;

						default:
							if (preg_match('/^im-cwa-(\d+)$/', $id, $matches)) :
								$widgetArea = react_get_cwa_by_id($matches[1]);
								$classes = array('im-box', 'im-drop', 'clearfix', $paletteClass);
								$style = '';

								if ($widgetArea['scroll']) {
									$classes[] = 'scroll';

									if (is_numeric($widgetArea['scroll_height'])) {
										$style = 'height: ' . absint($widgetArea['scroll_height']) . 'px';
									}
								}
								?>
								<li>
									<a class="im-trigger" data-type="<?php echo esc_attr($widgetArea['box_type']); ?>"><i class="<?php echo esc_attr(react_sanitize_class(react_get_icon_classes($widgetArea['icon']))); ?>"></i><span class="im-desc"><?php echo esc_html(react_t("Info Menu Custom Widget Area '" . $widgetArea['name'] . "' Title", $widgetArea['title'])); ?></span></a>
									<div id="im-cwa-<?php echo esc_attr($matches[1]); ?>" class="<?php echo esc_attr(react_sanitize_class($classes)); ?>" style="<?php echo esc_attr($style); ?>">
										<div class="im-box-inner clearfix">
											<?php
												if (is_active_sidebar($id)) {
													dynamic_sidebar($id);
												}
											?>
											<a class="im-close close2"><span class="x-close"></span><i class="fa fa-angle-up"></i></a>
										</div>
									</div>
								</li>
							<?php endif;
							break;
					}
			endforeach; ?>

		  </ul>

	</div>
	<?php
}
endif;

if (!function_exists('react_solonav')) :
/**
 * Display the solo nav
 */
function react_solonav()
{
	global $react;

	if (!$react['options']['show_solonav_desktop']
		&& $react['options']['show_solonav_phone']
		&& $react['options']['show_solonav_tablet']
		&& $react['options']['show_solonav_large']
	) {
		return;
	}

	$solonavClasses = array(
		'clearfix',
		$react['options']['style_solonav_texture'],
		$react['options']['style_solonav_detail'] . '-' . $react['options']['style_solonav_detail_opacity']
	);

	$navClasses = array(
		$react['options']['solo_nav_desc_location'],
		$react['options']['solo_nav_style']
	);

	if ($react['options']['solo_nav_style_upper']) {
		$navClasses[] = 'upperc-nav';
	}

	?>
	<div id="solonav" class="<?php echo esc_attr(react_sanitize_class($solonavClasses)) ?>"<?php echo react_get_parallax_data('solonav'); ?>>
		<div class="solonav-inner-helper"><div class="solonav-inner clearfix">
			<div class="solonav-wrap clearfix">
				<?php if ($react['options']['solonav_general_search']) : ?>
					<!--Search-->
					<div class="<?php echo esc_attr(react_sanitize_class('search-container ' . $react['options']['solonav_general_search_position'])); ?>">
						<form action="<?php echo esc_url(home_url()); ?>" method="get">
							<div class="search-input-wrap">
								<input placeholder="<?php echo esc_attr(react_get_translation('type_here_to_search', esc_attr__('Type here to search', 'react'))); ?>" value="" class="search-input" name="s" />
							</div>
							<div class="search-button-wrap">
								<input type="submit" value="<?php echo esc_attr(react_get_translation('go', esc_attr__('Go', 'react'))); ?>" />
							</div>
						</form>
					</div>
				<?php endif; ?>
				<?php if ($react['options']['nav_prime_nav_location'] == 'prime_nav_in_solo') : ?>
					<?php if ($react['options']['nav_show_home_icon']) : ?>
						<div class="<?php echo esc_attr(react_sanitize_class('back-home-icon ' . $react['options']['nav_home_icon_style'])); ?>">
							<a href="<?php echo esc_url(home_url()); ?>" class="back-home">

							<?php if ($react['options']['nav_home_icon_style'] == 'button') : ?>
								<span class="<?php echo esc_attr(react_sanitize_class('sml iconsprite home ' . $react['options']['general_color_global_primary_icon_image'])); ?> "></span>
							<?php elseif ($react['options']['nav_home_icon_style'] == 'plain-dark') : ?>
								<span class="drk sml iconsprite home"></span>
							<?php elseif ($react['options']['nav_home_icon_style'] == 'plain-light') : ?>
								<span class="lgt sml iconsprite home"></span>
							<?php endif; ?>

							</a>
						</div>
					<?php endif; ?>
					<nav class="<?php echo esc_attr(react_sanitize_class($navClasses)); ?>">
						<?php
							if (has_nav_menu('primary-menu')) {
								echo wp_nav_menu(array(
									'theme_location' => 'primary-menu',
									'menu_class' => 'primary-menu react-menu',
									'echo' => false,
									'container' => false,
									'walker' => new React_Description_Walker()
								));
							} else {
								echo '<ul class="primary-menu react-menu">' . wp_list_pages(array(
									'title_li' => '',
									'echo' => false
								)) . '</ul>';
							}
						?>
					</nav>
				<?php elseif ($react['options']['nav_prime_nav_location'] == 'prime_nav_in_head') : ?>
					<nav class="<?php echo esc_attr(react_sanitize_class($navClasses)); ?>">
					<?php
						if (has_nav_menu('secondary-menu')) {
							echo wp_nav_menu(array(
								'theme_location' => 'secondary-menu',
								'menu_class' => 'secondary-menu react-menu',
								'echo' => false,
								'container' => false,
								'walker' => new React_Description_Walker()
							));
						}
					?>
					</nav>
				<?php endif; ?>
			</div><!-- .solonav-wrap -->
		</div></div><!-- .solonav-inner .solonav-inner-helper -->
	</div><!-- #solonav -->
<?php
}
endif;

if (!function_exists('react_display_footer')) :
/**
 * Display the footer
 */
function react_display_footer()
{
	global $react;
	$footerLeftContent = react_t('Footer Content', $react['options']['footer_left_content']);
	$footerRightHasContent = $react['options']['controls_location_fs'] == 'sub-footer' ||
							($react['options']['controls_location_video'] == 'sub-footer' && isset($react['video'])) ||
							($react['options']['controls_location_audio'] == 'sub-footer' && isset($react['audio'])) ||
							$react['options']['show_footer_social_icon'];

	$src = react_get_upload_url($react['options']['footer_logo']);

	if ($src !== '') {
		$link = apply_filters('react_logo_link_url', home_url());
		echo '<div class="footer_logo"><a href="'. esc_url($link) .'"><img src="' . esc_url($src) . '" alt=""></a></div>';
	}

	if ($footerLeftContent) : ?>
		<div class="foot-left-col">
			<?php echo do_shortcode($footerLeftContent); ?>
		</div>
	<?php endif; ?>
	<?php if ($footerRightHasContent) : ?>
		<div class="foot-right-col">
			<?php if ($react['options']['controls_location_fs'] == 'sub-footer') : ?>
				<div id="fs-controls"><i class="<?php echo esc_attr(react_sanitize_class('sml iconsprite images ' . $react['options']['general_color_global_primary_icon_image'])); ?>"></i><?php if ($react['options']['controls_location_fs_label']) : ?><span class="label"><?php echo esc_html(react_get_translation('background', esc_html__('Background', 'react'))); ?></span><?php endif; ?></div>
			<?php endif; ?>
			<?php if ($react['options']['controls_location_video'] == 'sub-footer' && isset($react['video'])) : ?>
				<div id="video-controls"><i class="<?php echo esc_attr(react_sanitize_class('sml iconsprite film ' . $react['options']['general_color_global_primary_icon_image'])); ?>"></i><?php if ($react['options']['controls_location_video_label']) : ?><span class="label"><?php echo esc_html(react_get_translation('video', esc_html__('Video', 'react'))); ?></span><?php endif; ?></div>
			<?php endif; ?>
			<?php if ($react['options']['controls_location_audio'] == 'sub-footer' && isset($react['audio'])) : ?>
					<div id="audio-controls"><i class="<?php echo esc_attr(react_sanitize_class('sml iconsprite music ' . $react['options']['general_color_global_primary_icon_image'])); ?>"></i><?php if ($react['options']['controls_location_audio_label']) : ?><span class="label"><?php echo esc_html(react_get_translation('audio', esc_html__('Audio', 'react'))); ?></span><?php endif; ?></div>
			<?php endif; ?>

			<?php react_social_icons($react['options']['show_footer_social_icon'], $react['options']['footer_social_icon_type'], $react['options']['footer_social_icon_animation']); ?>

		</div>
	<?php endif; ?>

	<?php react_footer_end_page_popout();
}
endif;
add_action('react_footer', 'react_display_footer');

if (!function_exists('react_footer_end_page_popout')):
/**
 * The popup box in the footer
 */
function react_footer_end_page_popout()
{
	global $react;

	$content = react_t('Footer End Page Popout', $react['options']['footer_end_page_popout']);

	if ($metaContent = react_get_current_post_meta('footer_end_page_popout')) {
		$content = $metaContent;
		$postId = get_queried_object_id();
	}

	$content = apply_filters('react_footer_end_page_popout', $content);

	if ($content != '') {
		$scheme = $react['options']['footer_end_page_popout_choose_scheme'];
		echo '<div' . (is_numeric($scheme) ? ' class="' . esc_attr(react_sanitize_class('custom-palette-' . $scheme)) . '"' : '') . ' id="footer-logo-info-wrap"' . (isset($postId) ? ' data-post-id="' . esc_attr($postId) . '"' : '') . '>';
		echo do_shortcode($content);
		echo'<a id="close-footer-logo-info-wrap"><span class="x-close"></span></a>
		</div>';
	}
}
endif;

if (!function_exists('react_404')) :
/**
 * Display 404 message
 */
function react_404()
{
	?>
	<div class="search-info"><div class="search-info-inner"><?php echo esc_html(react_get_translation('page_not_found', esc_html__('Sorry, nothing was found here. Perhaps searching will help.', 'react'))); ?></div></div>
	<?php get_search_form();
}
endif;

if (!function_exists('react_display_back_to_top')) :
/**
 * Display back to top
 */
function react_display_back_to_top()
{
	global $react;
	if ($react['options']['footer_top_link']) : ?>
		<div id="back-to-top" class="back-to-top"><a href="#top" class="scroll-top" title="<?php echo esc_attr(react_get_translation('scroll_to_top', esc_attr__('Scroll to top', 'react'))); ?>"><i class="fa fa-angle-up"></i></a></div>
	<?php endif;
}
endif;
add_action('react_after_footer', 'react_display_back_to_top');

if (!function_exists('react_display_go_down')) :
/**
 * Display go down
 */
function react_display_go_down()
{
	global $react;
	if ($react['options']['go_down_link']) :
		$location = react_get_current_post_meta('go_down_link_location', $react['options']['go_down_link_location']); ?>
		<div id="go-down" class="go-down infinite animated bounce"><a href="<?php echo esc_url('#' . $location); ?>" class="scroll-down"><i class="fa fa-angle-down"></i></a></div>
	<?php endif;
}
endif;
add_action('react_outside_start', 'react_display_go_down');

if (!function_exists('react_intro')) :
/**
 * Display intro
 */
function react_intro()
{
	global $react;
	$post = react_get_current_post();
	$title = '';
	$intro = '';
	$subtitle = '';

	if (is_archive()) {
		$title = esc_html(react_get_translation('archives', esc_html__('Archives', 'react')));

		if (is_category()) {
			$subtitle = sprintf(esc_html(react_get_translation('category_archive_for', esc_html__('Category Archive for %s', 'react'))), '&lsquo;' . esc_html(single_cat_title('', false)) . '&rsquo;');
		} elseif (is_tag()) {
			$subtitle = sprintf(esc_html(react_get_translation('posts_tagged', esc_html__('Posts Tagged %s', 'react'))), '&lsquo;' . esc_html(single_tag_title('', false)) . '&rsquo;');
		} elseif (is_day()) {
			$subtitle = esc_html(sprintf(react_get_translation('daily_archive_for', esc_html__('Daily Archive for %s', 'react')), get_the_time('F jS, Y')));
		} elseif (is_month()) {
			$subtitle = esc_html(sprintf(react_get_translation('monthly_archive_for', esc_html__('Monthly Archive for %s', 'react')), get_the_time('F, Y')));
		} elseif (is_year()) {
			$subtitle = esc_html(sprintf(react_get_translation('yearly_archive_for', esc_html__('Yearly Archive for %s', 'react')), get_the_time('Y')));
		} elseif (is_author()) {
			global $author;
			$authorData = get_userdata(intval($author));
			$subtitle = esc_html(sprintf(react_get_translation('author_archive_for', esc_html__('Author Archive for %s', 'react')), $authorData->nickname));
		} elseif (is_tax()) {
			$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			$subtitle = sprintf(esc_html(react_get_translation('archives_for', esc_html__('Archives for %s', 'react'))), '&lsquo;' . esc_html($term->name) . '&rsquo;');
		}
	}

	if (is_home()) {
		$title = react_t('Blog Page Title', $react['options']['blog_title']);
		$subtitle = react_t('Blog Page Subtitle', $react['options']['blog_subtitle']);
	}

	if (is_singular()) {
		$title = get_the_title($post->ID);

		if ('post' == get_post_type($post) && $react['options']['blog_show_meta_intro_single']) {
			$subtitle = react_posted_on();
		}

		if (react_get_current_post_meta('intro_title')) {
			$title = esc_html(react_get_current_post_meta('intro_title'));
		}

		if (react_get_current_post_meta('intro_subtitle')) {
			$subtitle = esc_html(react_get_current_post_meta('intro_subtitle'));
		}
	}

	if (is_search()) {
		$title = esc_html(react_get_translation('search', esc_html__('Search', 'react')));
		$subtitle = sprintf(esc_html(react_get_translation('search_results_for', esc_html__('Search results for &#8220;%s&#8221;', 'react'))), '<span>' . get_search_query() . '</span>');
	}

	if (is_404()) {
		$title = esc_html(react_get_translation('uh_oh', esc_html__('Uh oh...', 'react')));
		$subtitle = esc_html(react_get_translation('404', esc_html__('404 Not Found', 'react')));
	}

	$title = apply_filters('react_intro_title', $title);
	if (strlen($title)) {
		$intro .= '<div class="intro-text clearfix"><h1 class="intro-title entry-title">' . $title . '</h1></div>';
	}

	$subtitle = apply_filters('react_intro_subtitle', $subtitle);
	if (strlen($subtitle)) {
		$intro .= '<div class="intro-text-subtitle clearfix"><h2 class="intro-subtitle">' . $subtitle . '</h2></div>';
	}

	if (strlen($intro) && apply_filters('react_show_intro', true)) {
		$show = array(
			'desktop' => react_get_current_post_meta('show_intro_desktop', $react['options']['show_intro_desktop']),
			'phone' => react_get_current_post_meta('show_intro_phone', $react['options']['show_intro_phone']),
			'tablet' => react_get_current_post_meta('show_intro_tablet', $react['options']['show_intro_tablet']),
			'large' => react_get_current_post_meta('show_intro_large', $react['options']['show_intro_large'])
		);

		$show = apply_filters('react_show_intro_devices', $show);
		$classes = array('clearfix');

		$showAny = false;
		foreach ($show as $k => $s) {
			if ($s) {
				$showAny = true;
			} else {
				$classes[] = 'hide-' . $k;
			}
		}

		if ($showAny) {
			$introTitleStyle = react_get_current_post_meta('intro_title_style', $react['options']['intro_title_style']);
			if ($introTitleStyle && $introTitleStyle != 'none') {
				$classes[] = $introTitleStyle;
			}
			$introTitlePosition = react_get_current_post_meta('intro_title_position', $react['options']['intro_title_position']);
			if ($introTitlePosition && $introTitlePosition != 'textleft') {
				$classes[] = $introTitlePosition;
			}
			$introTitlePositionMobiles = react_get_current_post_meta('intro_title_position_mobiles', $react['options']['intro_title_position_mobiles']);
			if ($introTitlePositionMobiles && $introTitlePositionMobiles != '') {
				$classes[] = $introTitlePositionMobiles;
			}

			$introTexture = react_get_current_post_meta('intro_texture', $react['options']['style_intro_texture']);
			$introDetail = react_get_current_post_meta('intro_detail', $react['options']['style_intro_detail']);
			$introDetailOpacity = react_get_current_post_meta('intro_detail_opacity', $react['options']['style_intro_detail_opacity'], '0');

			if ($introTexture != 'none') {
				$classes[] = $introTexture;
			}
			if ($introDetail != 'none') {
				$classes[] = $introDetail . '-' . $introDetailOpacity;
			}

			$output = '<div id="intro" class="' . esc_attr(react_sanitize_class($classes)) . '"' . react_get_parallax_data('intro') . '><div class="intro-inner-helper clearfix"><div class="intro-inner clearfix"><div class="intro-wrap clearfix">';
			$output .= '<div class="intro-inner-helper clearfix' . ($react['options']['intro_animation'] ? ' has-animation' : '') . '"' . ($react['options']['intro_animation'] ? ' data-animation="' . esc_attr($react['options']['intro_animation']) . '"' : '') . ($react['options']['intro_animation_delay'] ? ' data-animation-delay="' . esc_attr($react['options']['intro_animation_delay']) . '"' : '') . ($react['options']['intro_animation_offset'] ? ' data-animation-offset="' . esc_attr($react['options']['intro_animation_offset']) . '"' : '') . '>';
			$output .= $intro;
			$output .= react_breadcrumbs();
			$output .= '</div>';
			$output .= '</div></div></div></div>';
			echo do_shortcode(apply_filters('react_intro', $output));
		}
	}
}
endif;
add_action('react_after_header', 'react_intro');

if (!function_exists('react_skip_intro')):
/**
 * Get the HTML for the Skip intro button for page templates that support it
 *
 * @return  string
 */
function react_skip_intro()
{
	$skipUrl = react_get_current_post_meta('skip_url', home_url());
	$skipText = react_get_current_post_meta('skip_text', react_get_translation('skip_intro', esc_html__('Skip intro', 'react')));

	$output = '';

	if (react_get_current_post_meta('show_skip', true)) {
		$output .= '<div class="has-animation" id="intro-page-skip" data-animation="flipInX"><a class="basic-button" href="' . esc_url($skipUrl) . '">' . esc_html($skipText) . '<i class="fa fa-sign-in"></i></a></div>';
	}

	return $output;
}
endif;

if (!function_exists('react_set_video_background')) :
/**
 * Set the video background
 */
function react_set_video_background()
{
	global $react;

	// If we have page specific background images, don't set a video
	if ($react['backgrounds_specific']) {
		return;
	}

	$video['url'] = $react['options']['background_video'];
	$video['width'] = $react['options']['background_video_width'];
	$video['height'] = $react['options']['background_video_height'];
	$video['complete'] = react_get_current_post_meta('background_video_complete', $react['options']['background_video_complete']);
	$video['redirect'] = react_get_current_post_meta('background_video_redirect', $react['options']['background_video_redirect']);
	$video['autostart'] = react_get_current_post_meta('background_video_autostart', $react['options']['background_video_autostart']);
	$video['mute'] = react_get_current_post_meta('background_video_mute', $react['options']['background_video_mute']);
	$video['start'] = $react['options']['background_video_start'];
	$video['fullScreen'] = $react['options']['background_video_full_screen'];
	$video['fullScreenOverlay'] = $react['options']['background_video_full_screen_overlay'];
	$video['tablet'] = react_get_current_post_meta('background_video_tablet', $react['options']['background_video_tablet']);
	$video['mobile'] = react_get_current_post_meta('background_video_mobile', $react['options']['background_video_mobile']);

	// If we have a post specific background video, do not inherit these settings
	if (react_get_current_post_meta('background_video')) {
		$video['url'] = react_get_current_post_meta('background_video');
		$video['width'] = react_get_current_post_meta('background_video_width');
		$video['height'] = react_get_current_post_meta('background_video_height');
		$video['start'] = react_get_current_post_meta('background_video_start');
	}

	$video = apply_filters('react_video', $video);

	if ($video['url']) {
		if ((stripos($video['url'], 'vimeo.com') !== false)) {
			// Vimeo URL
			sscanf(parse_url($video['url'], PHP_URL_PATH), '/%d', $videoId);

			if ($videoId) {
				$react['video'] = apply_filters('react_video_vimeo', array(
					'type' => 'vimeo',
					'url' => $video['url'],
					'id' => $videoId,
					'autostart' => isset($video['autostart']) ? (bool) $video['autostart'] : true,
					'mute' => isset($video['mute']) ? (bool) $video['mute'] : true,
					'complete' => isset($video['complete']) ? $video['complete'] : 'restart',
					'width' => isset($video['width']) ? $video['width'] : '',
					'height' => isset($video['height']) ? $video['height'] : '',
					'start' => isset($video['start']) ? absint($video['start']) : 0,
					'redirect' => isset($video['redirect']) ? $video['redirect'] : '',
					'fullScreen' => isset($video['fullScreen']) ? (bool) $video['fullScreen'] : true,
					'fullScreenOverlay' => isset($video['fullScreenOverlay']) ? (bool) $video['fullScreenOverlay'] : true,
					'tablet' => $video['tablet'],
					'mobile' => $video['mobile']
				));
			}
		} else {
			if ((stripos($video['url'], 'youtu.be') !== false)) {
				// youtu.be URL
				$videoId = substr(parse_url($video['url'], PHP_URL_PATH), 1);
			} else {
				// Standard YouTube URL
				parse_str(parse_url($video['url'], PHP_URL_QUERY), $videoUrlParts);
				$videoId = isset($videoUrlParts['v']) ? $videoUrlParts['v'] : '';
			 }

			 if ($videoId) {
				$react['video'] = apply_filters('react_video_youtube', array(
					'type' => 'youtube',
					'url' => $video['url'],
					'id' => $videoId,
					'autostart' => isset($video['autostart']) ? (bool) $video['autostart'] : true,
					'mute' => isset($video['mute']) ? (bool) $video['mute'] : true,
					'complete' => isset($video['complete']) ? $video['complete'] : 'restart',
					'width' => isset($video['width']) ? $video['width'] : '',
					'height' => isset($video['height']) ? $video['height'] : '',
					'start' => isset($video['start']) ? absint($video['start']) : 0,
					'redirect' => isset($video['redirect']) ? $video['redirect'] : '',
					'fullScreen' => isset($video['fullScreen']) ? (bool) $video['fullScreen'] : true,
					'fullScreenOverlay' => isset($video['fullScreenOverlay']) ? (bool) $video['fullScreenOverlay'] : true,
					'tablet' => $video['tablet'],
					'mobile' => $video['mobile']
				));
			}
		}
	}
}
endif;

if (!function_exists('react_set_audio_background')) :
/**
 * Set the audio background
 */
function react_set_audio_background()
{
	global $react;

	$audio = $react['options']['background_audio'];
	$random = react_get_current_post_meta('audio_random', $react['options']['background_audio_random']);
	$autostart = react_get_current_post_meta('audio_autostart', $react['options']['background_audio_autostart']);
	$complete = react_get_current_post_meta('audio_complete', $react['options']['background_audio_complete']);
	$specific = false;

	$metaAudio = react_get_current_post_meta('audio');
	if (!empty($metaAudio)) {
		$audio = $metaAudio;
		$specific = true;
	}

	if (is_array($audio) && count($audio)) {
		$supplied = array();
		$formats = array('m4a', 'mp3', 'oga');

		foreach ($formats as $format) {
			if ($audio[0][$format]) {
				$supplied[] = $format;
			}
		}

		if ($random) {
			shuffle($audio);
		}

		// Add the WP uploads URL to any track imported from the media library
		foreach ($audio as $key => $track) {
			foreach ($formats as $format) {
				if (isset($track[$format]) && $track[$format] != '') {
					$audio[$key][$format] = react_get_upload_url($audio[$key][$format]);
				}
			}
		}

		$react['audio'] = apply_filters('react_audio', array(
			'supplied' => join(',', $supplied),
			'autostart' => (bool) $autostart,
			'files' => $audio,
			'complete' => $complete,
			'specific' => $specific,
			'random' => (bool) $random
		));

		add_action('wp_footer', 'react_add_jplayer_container');
	}
}
endif;

if (!function_exists('react_add_jplayer_container')) :
/**
 * Add Jplayer container
 */
function react_add_jplayer_container()
{
	echo '<div id="jplayer-container"></div>';
}
endif;

if (!function_exists('react_excerpt_more')) :
/**
 * Get the excerpt more text
 */
function react_excerpt_more($more)
{
	return '...';
}
endif;
add_filter('excerpt_more', 'react_excerpt_more');

if (!function_exists('react_content_more_link')) :
/**
 * Get the content more link
 */
function react_content_more_link($link)
{
	return '<div class="read-more-link">' . $link . '</div>';
}
endif;
add_filter('the_content_more_link', 'react_content_more_link');

if (!function_exists('react_content_nav')) :
/**
 * Display the content navigation
 */
function react_content_nav($navId)
{
	global $wp_query;

	if (!function_exists('wp_pagenavi')) {
		if ($wp_query->max_num_pages > 1) : ?>
			<div class="content-nav clearfix" id="<?php echo esc_attr($navId); ?>">
				<div class="nav-previous"><?php next_posts_link('<span class="meta-nav"><i class="fa fa-angle-left"></i></span>' . esc_html(react_get_translation('older_posts', esc_html__('Older posts', 'react')))); ?></div>
				<div class="nav-next"><?php previous_posts_link(esc_html(react_get_translation('newer_posts', esc_html__('Newer posts', 'react'))) . '<span class="meta-nav"><i class="fa fa-angle-right"></i></span>'); ?></div>
			</div>
		<?php endif;
	} else {
		wp_pagenavi();
	}
}
endif;

if (!function_exists('react_link_pages')) :
/**
 * Display page links
 */
function react_link_pages()
{
	if (!function_exists('wp_pagenavi')) {
		wp_link_pages(array('before' => '<div class="page-link"><span>' . esc_html(react_get_translation('pages', esc_html__('Pages', 'react'))) . '</span>', 'after' => '</div>'));
	} else {
		wp_pagenavi(array('type' => 'multipart'));
	}
}
endif;

if (!function_exists('react_is_blog')) :
/**
 * Are we on a blog page?
 *
 * @return boolean
 */
function react_is_blog()
{
	global $post;
	return (((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ('post' == get_post_type($post)));
}
endif;

if (!function_exists('react_get_post_featured_image_type')) :
/**
 * Gets the featured image type for the current post
 *
 * @return  string  The featured image type
 */
function react_get_post_featured_image_type($postId = null)
{
	$post = get_post($postId);

	if ( ! $post) {
		return;
	}

	global $react;
	$postType = get_post_type($post);
	$isSingle = is_singular();

	if ( ! in_array($postType, array('post', 'portfolio', 'page'))) {
		$postType = 'post';
	}

	$keyPrefix = ($postType === 'post' ? 'blog' : $postType) . '_' . ($isSingle ? 'single_' : '');

	$featuredImageType = isset($react['options'][$keyPrefix . 'featured_image_type']) ? $react['options'][$keyPrefix . 'featured_image_type'] : null;

	return apply_filters('react_' . $keyPrefix . 'featured_image_type', react_get_post_meta($post->ID, 'featured_image_type', $featuredImageType));
}
endif;

if (!function_exists('react_post_class')) :
/**
 * Sets extra post classes
 *
 * @param   array   $classes  The array of existing post classes
 * @param   string  $class    The string of classes to add
 * @param   int     $postId   The post ID
 * @return  array             The array of modified post classes
 */
function react_post_class($classes, $class, $postId)
{
	$classes[] = 'entry';
	$post = get_post($postId);

	if ( ! $post) {
		return $classes;
	}

	$itemType = react_get_post_meta($post->ID, 'type', 'image');

	if ($itemType == 'video_embed') {
		if ($url = react_get_post_meta($post->ID, 'video_embed')) {
			$classes[] = 'has-post-video';
		}
	} elseif ($itemType == 'video') {
		if ($url = react_get_post_meta($post->ID, 'video')) {
			$classes[] = 'has-post-video';
		}
	}

	if ($featuredImageType = react_get_post_featured_image_type($post->ID)) {
		$classes[] = react_sanitize_class('post-image-type-' . $featuredImageType);
	}

	if (is_home() && react_get_option('blog_animation')) {
		$classes[] = react_sanitize_class(react_get_animation_class(react_get_option('blog_animation')));
	}

	return $classes;
}
endif;
add_filter('post_class', 'react_post_class', 10, 3);

if (!function_exists('react_get_post_featured_image')) :
/**
 * Get the featured image/video for any post type
 *
 * @param   string  $type  The image position, one of: left,above,below,right
 * @return  string         The featured image HTML
 */
function react_get_post_featured_image($type = '')
{
	global $react;
	$output = '';
	$postType = get_post_type();
	$isSingle = is_singular();

	if ( ! in_array($postType, array('post', 'portfolio', 'page'))) {
		$postType = 'post';
	}

	$keyPrefix = ($postType === 'post' ? 'blog' : $postType) . '_' . ($isSingle ? 'single_' : '');

	$show = isset($react['options'][$keyPrefix . 'featured_image']) ? $react['options'][$keyPrefix . 'featured_image'] : true;
	$showFeaturedImage = apply_filters('react_' . $keyPrefix . 'featured_image', react_get_post_meta(get_the_ID(), 'featured_image', $show));
	if (!$showFeaturedImage) {
		return;
	}

	$options = array(
		'float_width' => isset($react['options'][$keyPrefix . 'featured_float_width']) ? $react['options'][$keyPrefix . 'featured_float_width'] : 150,
		'float_height' =>  isset($react['options'][$keyPrefix . 'featured_float_height']) ? $react['options'][$keyPrefix . 'featured_float_height'] : 0,
		'like_image' => isset($react['options'][$keyPrefix . 'featured_like_image']) ? $react['options'][$keyPrefix . 'featured_like_image'] : false,
		'like_image_icon' => isset($react['options'][$keyPrefix . 'featured_like_image_icon']) ? $react['options'][$keyPrefix . 'featured_like_image_icon'] : 'fa-thumbs-up'
	);

	$height = isset($react['options'][$keyPrefix . 'featured_height']) ? $react['options'][$keyPrefix . 'featured_height'] : 0;

	if (!$type) {
		$type = react_get_post_featured_image_type();
	}

	$itemType = react_get_post_meta(get_the_ID(), 'type', 'image');

	if ($itemType == 'video_embed') {
		if ($url = react_get_post_meta(get_the_ID(), 'video_embed')) {
			$output = react_get_featured_video($url, $type, react_get_content_width(), $height, $options);
		}
	} elseif ($itemType == 'video') {
		if ($url = react_get_post_meta(get_the_ID(), 'video')) {
			$output = react_get_featured_video($url, $type, react_get_content_width(), $height, $options);
		}
	} else {
		if (has_post_thumbnail()) {
			if ($isSingle) {
				$linkImage = isset($react['options'][$keyPrefix . 'featured_link_image']) ? $react['options'][$keyPrefix . 'featured_link_image'] : false;
				if ($linkImage) {
					$imageData = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
					$options['a']['href'] = $imageData[0];
					$options['a']['class'] = 'lightbox';
				}
			} else {
				$options['a']['href'] = get_permalink();
			}

			$output = react_get_featured_image($type, react_get_content_width(), $height, $options);
		}
	}

	return $output;
}
endif;

if (!function_exists('react_get_featured_image')) :
/**
 * Get the HTML for the featured image
 *
 * @param   string      $type     The image position, one of: left,above,below,right
 * @param   int|string  $width    Current page layout or the image width
 * @param   int         $height   The image height
 * @param   array       $options  Array of options
 * @return  string
 */
function react_get_featured_image($type = '', $width = '', $height = 0, $options = array())
{
	if (!has_post_thumbnail()) {
		return;
	}

	$options['like_image'] = isset($options['like_image']) ? $options['like_image'] : false;
	$options['like_image_icon'] = isset($options['like_image_icon']) ? $options['like_image_icon'] : '';

	if ($type == 'left' || $type == 'right') {
		$width = $options['float_width'];
		$height = $options['float_height'];
	}

	$imageId = get_post_thumbnail_id();
	$imageSize = react_get_image_size_name_from_width($width);
	$imageData = wp_get_attachment_image_src($imageId, $imageSize);

	// Check if the image is wide enough, if not just get the original
	if ($width > $imageData[1]) {
		$imageSize = 'full';
	}

	$style = 'width:' . absint($type == 'above' ? $width + 70 : $width) . 'px;';
	if ($height > 0) {
		$style .= 'max-height:' . absint($height) . 'px;';
	}

	$output = '<div class="' . esc_attr(react_sanitize_class('featured-image-helper featured-image-' . $type)) . '"><div class="featured-image-wrap" style="' . esc_attr($style) . '">';

	if ($options['like_image']) {
		$output .= react_get_post_like_html(get_the_ID(), $options['like_image_icon']);
	}

	if (isset($options['a'])) {
		$aAttrs = array();
		if (!isset($options['a']['class'])) {
			$options['a']['class'] = array();
		}
		$options['a']['class'] = (array) $options['a']['class'];
		array_unshift($options['a']['class'], 'featured-image-link');

		if ($height > 0) {
			$options['a']['style'] = 'max-height:' . absint($height) . 'px;';
		}

		if ($caption = react_get_attachment_caption($imageId)) {
			$options['a']['data']['caption'] = $caption;
		}

		foreach ($options['a'] as $attr => $value) {
			if ($attr == 'data') {
				foreach ($value as $dataKey => $dataValue) {
					$aAttrs[] = 'data-' . $dataKey . '="' . esc_attr($dataValue) . '"';
				}
			} else {
				$aAttrs[] = $attr . '="' . esc_attr((is_array($value) ? join(' ', $value) : $value)) . '"';
			}
		}
		$output .= '<a ' . (count($aAttrs) ? join(' ', $aAttrs) : '') . '>';
	}

	$output .= wp_get_attachment_image($imageId, $imageSize);

	if (isset($options['a'])) {
		$output .= '</a>';
	}

	$output .= '</div></div>';

	return $output;
}
endif;

if (!function_exists('react_breadcrumbs')) :
/**
 * Return the breadcrumbs HTML
 *
 * @return string
 */
function react_breadcrumbs()
{
	global $react;

	$breadcrumbs = react_get_current_post_meta('breadcrumbs', $react['options']['general_breadcrumbs']);

	if ($breadcrumbs && (function_exists('bcn_display') || function_exists('yoast_breadcrumb'))) {
		$output = '';

		if ($react['options']['general_breadcrumbs_home_icon']) {
			$output .= '<div class="breadcrumbs clearfix"><div class="' . esc_attr(react_sanitize_class('back-home-icon ' . $react['options']['general_breadcrumbs_home_icon_style'])) . '"><a href="' . esc_url(home_url()) . '" class="back-home">';
			if ($react['options']['general_breadcrumbs_home_icon_style'] == 'button') {
				$output .= '<span class="' . esc_attr(react_sanitize_class('sml iconsprite home ' . $react['options']['general_color_global_primary_icon_image'])) . '"></span>';
			} elseif ($react['options']['general_breadcrumbs_home_icon_style'] == 'plain-light') {
				$output .= '<span class="lgt sml iconsprite home"></span>';
			} else {
				$output .= '<span class="drk sml iconsprite home"></span>';
			}
			$output .= '</a></div><div class="breadcrumbs-inner clearfix">';
		} else {
			$output .= '<div class="breadcrumbs clearfix"><div class="breadcrumbs-inner clearfix">';
		}

		if (function_exists('bcn_display')) {
			$output .= bcn_display(true);
		} elseif (function_exists('yoast_breadcrumb')) {
			$output .= yoast_breadcrumb('', '', false);
		}

		$output .= '</div></div>';

		return $output;
	}
}
endif;

if (!function_exists('react_share')) :
/**
 * Display Sharrre
 */
function react_share()
{
	global $react, $wp;
	$shareUrl = home_url(add_query_arg(array(), $wp->request));
	$shareTitle = react_t('Share Title', $react['options']['share_title']);

	if ($react['options']['show_share_facebook'] || $react['options']['show_share_twitter'] || $react['options']['show_share_googleplus'] || $react['options']['show_share_pinterest']) :
	?>
	<div class="<?php echo esc_attr(react_sanitize_class('socialcount-wrap clearfix ' . $react['options']['style_share'])); ?>">
		<?php if ($shareTitle) : ?>
			<h3 class="socialcount-title"><i class="fa-share-alt fa"></i><?php echo esc_html($shareTitle); ?></h3>
		<?php endif; ?>
		<ul class="socialcount clearfix">
			<?php if ($react['options']['show_share_facebook']) : ?>
				<li title="<?php echo esc_attr(react_t('Share Hover Text Facebook', $react['options']['share_hover_text_facebook'])); ?>" id="facebook" data-url="<?php echo esc_attr($shareUrl); ?>" class="facebook"></li>
			<?php endif; ?>
			<?php if ($react['options']['show_share_twitter']) : ?>
				<li title="<?php echo esc_attr(react_t('Share Hover Text Twitter', $react['options']['share_hover_text_twitter'])); ?>" id="twitter" data-url="<?php echo esc_attr($shareUrl); ?>" class="twitter"></li>
			<?php endif; ?>
			<?php if ($react['options']['show_share_googleplus']) : ?>
				<li title="<?php echo esc_attr(react_t('Share Hover Text Google+', $react['options']['share_hover_text_googleplus'])); ?>" id="googleplus" data-url="<?php echo esc_attr($shareUrl); ?>" class="googleplus"></li>
			<?php endif; ?>
			<?php if ($react['options']['show_share_pinterest']) : ?>
				<li title="<?php echo esc_attr(react_t('Share Hover Text Pinterest', $react['options']['share_hover_text_pinterest'])); ?>" id="pinterest" data-url="<?php echo esc_attr($shareUrl); ?>" class="pinterest"></li>
			<?php endif; ?>
		</ul>
	</div>
	<?php
	endif;
}
endif;

if (!function_exists('react_favicon')) :
/**
 * Display favicons
 */
function react_favicon()
{
	global $react;
	$href = react_get_upload_url($react['options']['general_favicon']);

	if ($href !== '') {
		echo '<link rel="shortcut icon" href="' . esc_url($href) . '">';

		$sizes = array_reverse(react_get_favicon_sizes()); // Reverse for pre-4.2 iOS (http://mathiasbynens.be/notes/touch-icons)
		foreach ($sizes as $size) {
			$href = react_get_upload_url($react['options']['general_favicon_touch_' . $size]);
			if ($href !== '') {
				echo '<link rel="apple-touch-icon" sizes="' . absint($size) . 'x' . absint($size) . '" href="' . esc_url($href) . '">';
			}
		}

		$href = react_get_upload_url($react['options']['general_favicon_touch_57']);
		if ($href !== '') {
			echo '<link rel="apple-touch-icon" href="' . esc_url($href) . '">';
		}
	}
}
endif;
add_action('wp_head', 'react_favicon');

if (!function_exists('react_footer_top_widget_area')) :
/**
 * Display the footer top widget area
 */
function react_footer_top_widget_area()
{
	global $react;

	if (!$react['options']['footer_top_widget_area_layout']) {
		// Popdown widget area disabled
		return;
	}

	$layout = explode('-', $react['options']['footer_top_widget_area_layout']);
	?>
	<div id="footer-top-widget-area" class="clearfix">
		<div class="<?php echo esc_attr(react_sanitize_class('units-row ' . $react['options']['footer_top_columns_convert'])); ?>">
			<?php
				$i = 1;
				foreach ($layout as $column) {
					echo '<div class="' . esc_attr(react_sanitize_class('unit-' . $column)) . '">';
					if (is_active_sidebar('footer-top-widget-' . $i)) {
						dynamic_sidebar('footer-top-widget-' . $i);
					}
					echo '</div>';
					$i++;
				}
			?>
		</div>
	</div>
	<?php
}
endif;
add_action('react_after_content_style', 'react_footer_top_widget_area');

if (!function_exists('react_footer_widget_area')) :
/**
 * Display the footer widget area
 */
function react_footer_widget_area()
{
	global $react;

	if (!$react['options']['footer_widget_area_layout']) {
		// Footer widget area disabled
		return;
	}

	$layout = explode('-', $react['options']['footer_widget_area_layout']);
	$classes = array('footer', 'clearfix');
	if ($react['options']['style_mainfoot_texture'] != 'none') {
		$classes[] = $react['options']['style_mainfoot_texture'];
	}
	if ($react['options']['style_mainfoot_detail'] != 'none') {
		$classes[] = $react['options']['style_mainfoot_detail'] . '-' . $react['options']['style_mainfoot_detail_opacity'];
	}

	$paletteClass = react_get_option_palette_class('general_color_footer_choose_scheme');
	if ($paletteClass) {
		$classes[] = $paletteClass;
	}
	?>
	<div id="footer" class="<?php echo esc_attr(react_sanitize_class($classes)); ?>"<?php echo react_get_parallax_data('mainfoot'); ?>>
		<div class="footer-inner-helper"><div class="footer-inner clearfix">
			<div class="footer-wrap clearfix">
				<div class="<?php echo esc_attr(react_sanitize_class('units-row ' . $react['options']['footer_columns_convert'])); ?>">
					<?php
					$i = 1;
					foreach ($layout as $column) {
						echo '<div class="' . esc_attr(react_sanitize_class('unit-' . $column)) . '">';
						if (is_active_sidebar('footer-widget-' . $i)) {
							dynamic_sidebar('footer-widget-' . $i);
						}

						echo '</div>';
						$i++;
					}
					?>
				</div>
			</div>
		</div></div>
	</div>
	<?php
}
endif;

if (!function_exists('react_popdown_widget_area')) :
/**
 * Display the footer widget area
 */
function react_popdown_widget_area()
{
	global $react;

	if ($react['options']['popdown_content_type'] == 'html' || !$react['options']['popdown_widget_area_layout']) {
		// Popdown widget area disabled
		return;
	}

	$layout = explode('-', $react['options']['popdown_widget_area_layout']);
	?>
	<div class="<?php echo esc_attr(react_sanitize_class('units-row ' . $react['options']['popdown_columns_convert'])); ?>">
		<?php
			$i = 1;
			foreach ($layout as $column) {
				echo '<div class="' . esc_attr(react_sanitize_class('unit-' . $column)) . '">';
				if (is_active_sidebar('popdown-widget-' . $i)) {
					dynamic_sidebar('popdown-widget-' . $i);
				}
				echo '</div>';
				$i++;
			}
		?>
	</div>
	<?php
}
endif;

if (!function_exists('react_get_breakpoint_convert_option')) :
/**
 * Return the numerical breakbox for the given option key
 */
function react_get_breakpoint_convert_option($key)
{
	global $react;
	$breakpoint = null;
	if (isset($react['options'][$key])) {
		if ($react['options'][$key] === 'custom') {
			$breakpoint = $react['options'][$key . '_custom'];
		} elseif ($react['options'][$key] === 'box-width') {
			$breakpoint = max(($react['options']['page_layout_max_width'] + $react['options']['page_layout_left_margin_tablets'] + $react['options']['page_layout_right_margin_tablets']), ($react['options']['break_point_tablet_ldsp'] + $react['options']['page_layout_left_margin_tablets'] + $react['options']['page_layout_right_margin_tablets']));
		} elseif ($react['options'][$key] === 'phone-ptr') {
			$breakpoint = $react['options']['break_point_phone_ptr'];
		} elseif ($react['options'][$key] === 'phone-ldsp') {
			$breakpoint = $react['options']['break_point_phone_ldsp'];
		} elseif ($react['options'][$key] === 'tablet-ptr') {
			$breakpoint = $react['options']['break_point_tablet_ptr'];
		} elseif ($react['options'][$key] === 'tablet-ldsp') {
			$breakpoint = $react['options']['break_point_tablet_ldsp'];
		}
	}
	return $breakpoint;
}
endif;

if (!function_exists('react_slider')) :
/**
 * Display a slider
 */
function react_slider($position = 'belowhead')
{
	global $react;

	if ($react['options']['component_slider_position'] != $position) {
		return;
	}

	$sliderType = '';
	$sliderId = '';
	$sliderIdMobile = '';
	$sliderConvertPoint = '';
	$pageSpecificSlider = react_get_current_post_meta('slider');
	$pageSpecificSliderId = react_get_current_post_meta('slider_id');
	$pageSpecificSliderConvertId = react_get_current_post_meta('slider_convert_id');

	if ((is_front_page() || $pageSpecificSlider === 'home') && $react['options']['component_slider_homepage'] != '' && $react['options']['component_slider_id'] != '') {
		$sliderType = $react['options']['component_slider_homepage'];
		$sliderId = $react['options']['component_slider_id'];
		$sliderIdMobile = $react['options']['component_slider_convert_id'];
		$sliderConvertPoint = $react['options']['component_slider_convert_point'];
	} elseif ($pageSpecificSlider != 'home' && $pageSpecificSlider != '') {
		$sliderType = $pageSpecificSlider;
		$sliderConvertPoint = $react['options']['component_slider_convert_point'];
		if ($pageSpecificSliderId != '') {
			$sliderId = $pageSpecificSliderId;
		}
		if ($pageSpecificSliderConvertId != '') {
			$sliderIdMobile = $pageSpecificSliderConvertId;
		}
	}

	if ($sliderType != '' && $sliderId != '') {
		if ($sliderType == 'layerslider' && shortcode_exists('layerslider')) {
			echo '<div class="slider-wrap slider-default clearfix"><div class="slider-inner clearfix">' . do_shortcode('[layerslider id="' . $sliderId . '"]') . '</div></div>';
		} elseif ($sliderType == 'revslider' && function_exists('putRevSlider')) {
			echo '<div class="slider-wrap slider-default clearfix"><div class="slider-inner clearfix">';
			putRevSlider($sliderId);
			echo '</div></div>';
		}
	}

	if ($sliderType != '' && $sliderIdMobile != '' && $sliderConvertPoint != 'never') {
		if ($sliderType == 'layerslider' && shortcode_exists('layerslider')) {
			echo '<div class="slider-wrap slider-mobile clearfix"><div class="slider-inner clearfix">' . do_shortcode('[layerslider id="' . $sliderIdMobile . '"]') . '</div></div>';
		} elseif ($sliderType == 'revslider' && function_exists('putRevSlider')) {
			echo '<div class="slider-wrap slider-mobile clearfix"><div class="slider-inner clearfix">';
			putRevSlider($sliderIdMobile);
			echo '</div></div>';
		}
	}
}
endif;

//if (!function_exists('react_dequeue_quform_fancybox')) :
///**
// * Dequeue fancybox style from the Quform plugin and use the built-in Fancybox2 instead
// */
//function react_dequeue_quform_fancybox()
//{
//	if (function_exists('iphorm')) {
//		wp_dequeue_style('iphorm-fancybox');
//		wp_dequeue_script('fancybox');
//	}
//}
//endif;
//add_action('wp_enqueue_scripts', 'react_dequeue_quform_fancybox');

if (!function_exists('react_get_attachment_caption')) :
/**
 * Get the attachment caption
 *
 * @param   int     $attachId
 * @return  string
 */
function react_get_attachment_caption($attachId)
{
	$post = get_post($attachId);
	$caption = '';

	if ($post instanceof WP_Post && isset($post->post_excerpt) && !empty($post->post_excerpt)) {
		$caption = $post->post_excerpt;
	}

	return $caption;
}
endif;

if (!function_exists('react_get_image_size_name_from_width')) :
/**
 * Get the image size name that best suits the given width
 *
 * @param   int    $width  The width of the space
 * @return  string         The name of the WP image size
 */
function react_get_image_size_name_from_width($width)
{
	if ($width <= 300) {
		$name = 'medium';
	} elseif ($width <= 512) {
		$name = 'react-512';
	} elseif ($width <= 768) {
		$name = 'react-768';
	} elseif ($width <= 1024) {
		$name = 'large';
	} else {
		$name = 'full';
	}

	return $name;
}
endif;

if (!function_exists('react_get_blog_date_circle')) :
/**
 * Displays the date in a small box
 *
 * @return  string  The HTML for the box
 */
function react_get_blog_date_circle()
{
	global $react;
	$output = '';

	if (get_post_type() == 'post' && $react['options']['blog_show_date_circle']) {
		$output .= '<div class="date" title="' . esc_attr(get_the_date()) . '"><a href="' . esc_url(get_permalink()) . '">
	<div class="day">' . esc_html(get_the_date('j')) . '</div>
	<div class="month">' . esc_html(get_the_date('M')) . '</div>
</a></div>';
	}

	return $output;
}
endif;

if (!function_exists('react_get_parallax_data')) :
/**
 * Get the data attributes for the parallax
 *
 * @return  string
 */
function react_get_parallax_data($key)
{
	global $react;
	$data = '';
	$image = $react['options']['style_' . $key . '_image'];
	$imageParallax = $react['options']['style_' . $key . '_image_parallax'];
	$imageParallaxOffset = $react['options']['style_' . $key . '_image_parallax_offset'];

	if (react_get_current_post_meta($key . '_image')) {
		$image = react_get_current_post_meta($key . '_image');
		$imageParallax = react_get_current_post_meta($key . '_image_parallax');
		$imageParallaxOffset = react_get_current_post_meta($key . '_image_parallax_offset');
	}

	if ($image && $imageParallax != '1') {
		$data = ' data-stellar-background-ratio="' . esc_attr($imageParallax) . '" data-stellar-vertical-offset="' . esc_attr($imageParallaxOffset) . '"';
	}

	return $data;
}
endif;

if (!function_exists('react_get_post_info')) :
/**
 * Get the post info section - icon/date/like
 *
 * @return  string  The HTML for the post info
 */
function react_get_post_info()
{
	global $react;

	$output = '<div class="entry-info">';

	$output .= react_get_post_icon();

	$output .= react_get_blog_date_circle();

	if ($react['options']['blog_show_post_like']) {
		$output .= react_get_post_like_html(get_the_ID());
	}

	$output .= '</div>';
	return $output;
}
endif;

if (!function_exists('react_get_post_icon')) :
/**
 * Get the HTML for the blog post icon
 *
 * @return
 */
function react_get_post_icon()
{
	global $post;
	$output = '';

	if (isset($post->post_type)) {
		$icon = '';

		if ($post->post_type == 'post') {
			switch (get_post_format()) {
				case 'standard':
				default:
					$icon = 'fa-align-left';
					break;
				case 'aside':
					$icon = 'fa-comment';
					break;
				case 'link':
					$icon = 'fa-link';
					break;
				case 'gallery':
					$icon = 'fa-picture-o';
					break;
				case 'status':
					$icon = 'fa-comment';
					break;
				case 'quote':
					$icon = 'fa-quote-left';
					break;
				case 'image':
					$icon = 'fa-camera';
					break;
				case 'video':
					$icon = 'fa-film';
					break;
				case 'chat':
					$icon = 'fa-comments';
					break;
				case 'audio':
					$icon = 'fa-microphone';
					break;
			}
		} elseif ($post->post_type == 'page') {
			$icon = 'fa-align-left';
		} elseif ($post->post_type == 'portfolio') {
			$icon = 'fa-picture-o';
		}

		$icon = apply_filters('react_post_icon', $icon, $post);

		if ($icon) {
			$output .= '<div class="post-icon"><i class="' . esc_attr(react_sanitize_class('fa ' . $icon)) . '"></i></div>';
		}
	}

	return $output;
}
endif;

if (!function_exists('react_get_featured_video')) :
/**
 * Get the embed code for portfolio item video type
 *
 * @return  string  The embed HTML
 */
function react_get_featured_video($url, $type, $width, $height = 0, $options = array())
{
	global $react;
	$output = '';
	$video = react_get_video_info($url);

	if ($video) {
		if ($type != 'left' && $type != 'right') {
			// This part deals with full width featured videos
			$styles = array('width: ' . absint($width) . 'px;');
			if ($height) {
				$styles[] = 'height: ' . absint($height) . 'px;';
				$styles[] = 'padding-bottom: 0;';
			} else {
				$originalVideoWidth = react_get_post_meta(get_the_ID(), 'video_embed_width');
				$originalVideoHeight = react_get_post_meta(get_the_ID(), 'video_embed_height');

				if ($originalVideoWidth && $originalVideoHeight) {
					$styles[] = 'padding-bottom:' . (($originalVideoHeight / $originalVideoWidth) * 100) . '%;';
				}
			}
		} else {
			// This part deals with float left/right featured videos
			$styles = array('width: ' . absint($options['float_width']) . 'px;');
			if ($options['float_height']) {
				$styles[] = 'height: ' . absint($options['float_height']) . 'px;';
				$styles[] = 'padding-bottom: 0;';
			} else {
				$originalVideoWidth = react_get_post_meta(get_the_ID(), 'video_embed_width');
				$originalVideoHeight = react_get_post_meta(get_the_ID(), 'video_embed_height');

				if ($originalVideoWidth && $originalVideoHeight) {
					$styles[] = 'padding-bottom:' . (($originalVideoHeight / $originalVideoWidth) * 100) . '%;';
				}
			}
		}

		$output .= '<div class="' . esc_attr(react_sanitize_class('featured-video-helper featured-video-' . $type)) . '"><div class="featured-video flexible-frame"' . (count($styles) ? ' style="' . esc_attr(join('', $styles)) . '"' : '') . '><iframe src="' . esc_url($video['src']) . '" allowfullscreen style="border: 0;"></iframe></div></div>';
	}

	return $output;
}
endif;

if (!function_exists('react_get_video_info')) :
/**
 * Get the video type and ID from a YouTube / Vimeo URL
 *
 * @param   string  $url  The video URL
 * @return  array         The video info
 */
function react_get_video_info($url)
{
	$info = false;
	global $react;

	if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
		$info = array(
			'type' => 'youtube',
			'src' => '//www.youtube.com/embed/' . $match[1]
		);
	} elseif (preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/', $url, $match)) {
		$info = array(
			'type' => 'vimeo',
			'src' => '//player.vimeo.com/video/' . $match[5]
		);
	}

	$info = apply_filters('react_video_info', $info, $url);

	return $info;
}
endif;


if (!function_exists('react_get_vertical_margin_config')) :
/**
 * Get the configuration array of which vertical space margins should be set to screen height for the JS
 *
 * @return  array
 */
function react_get_vertical_margin_config()
{
	global $react;

	$topChoose = react_get_current_post_meta('page_layout_top_margin_choose');
	$top = $topChoose === 'screen' || ($topChoose !== 'custom' && $react['options']['page_layout_top_margin_choose'] === 'screen');

	$topPhonesChoose = react_get_current_post_meta('page_layout_top_margin_phones_choose');
	$topPhones = $topPhonesChoose === 'screen' || ($topPhonesChoose !== 'custom' && $react['options']['page_layout_top_margin_phones_choose'] === 'screen');

	$topTabletsChoose = react_get_current_post_meta('page_layout_top_margin_tablets_choose');
	$topTablets = $topTabletsChoose === 'screen' || ($topTabletsChoose !== 'custom' && $react['options']['page_layout_top_margin_tablets_choose'] === 'screen');

	$topTvChoose = react_get_current_post_meta('page_layout_top_margin_tv_choose');
	$topTv = $topTvChoose === 'screen' || ($topTvChoose !== 'custom' && $react['options']['page_layout_top_margin_tv_choose'] === 'screen');

	$bottomChoose = react_get_current_post_meta('page_layout_bottom_margin_choose');
	$bottom = $bottomChoose === 'screen' || ($bottomChoose !== 'custom' && $react['options']['page_layout_bottom_margin_choose'] === 'screen');

	$bottomPhonesChoose = react_get_current_post_meta('page_layout_bottom_margin_phones_choose');
	$bottomPhones = $bottomPhonesChoose === 'screen' || ($bottomPhonesChoose !== 'custom' && $react['options']['page_layout_bottom_margin_phones_choose'] === 'screen');

	$bottomTabletsChoose = react_get_current_post_meta('page_layout_bottom_margin_tablets_choose');
	$bottomTablets = $bottomTabletsChoose === 'screen' || ($bottomTabletsChoose !== 'custom' && $react['options']['page_layout_bottom_margin_tablets_choose'] === 'screen');

	$bottomTvChoose = react_get_current_post_meta('page_layout_bottom_margin_tv_choose');
	$bottomTv = $bottomTvChoose === 'screen' || ($bottomTvChoose !== 'custom' && $react['options']['page_layout_bottom_margin_tv_choose'] === 'screen');

	return array(
		'enabled' => ($top || $topPhones || $topTablets || $topTv || $bottom || $bottomPhones || $bottomTablets || $bottomTv),
		'top' => $top,
		'topPhones' => $topPhones,
		'topTablets' => $topTablets,
		'topTv' => $topTv,
		'bottom' => $bottom,
		'bottomPhones' => $bottomPhones,
		'bottomTablets' => $bottomTablets,
		'bottomTv' => $bottomTv,
	);
}
endif;

if (!function_exists('react_get_cookie_domain_path')) :
/**
 * Get the domain and path to use for setting cookies
 *
 * @return  array
 */
function react_get_cookie_domain_path()
{
	if (is_multisite() && function_exists('get_blog_details')) {
		$blog = get_blog_details();
		return array($blog->domain, $blog->path);
	}

	// Return an empty string for the domain to use the current domain
	return array('', '/');
}
endif;

if (function_exists('w3_instance')) :
/**
 * Convert the background image URL to the CDN URL
 *
 * @param   string  $url
 * @return  string
 */
function react_background_image_url_cdn($url)
{
	$w3cdn = w3_instance('W3_Plugin_CdnCommon');

	if ($w3cdn instanceof W3_Plugin_CdnCommon) {
		$cdn = $w3cdn->get_cdn();
		$parsed = parse_url($url);
		$path = $parsed['path'];
		$remotePath = $w3cdn->uri_to_cdn_uri($path);
		$url = $cdn->format_url($remotePath);
	}

	return $url;
}

/**
 * If W3 Total Cache is installed and CDN is enabled, register filters
 */
function react_check_w3_cdn_enabled()
{
	$config = w3_instance('W3_Config');

	if ($config instanceof W3_Config && $config->get_boolean('cdn.enabled')) {
		add_filter('react_background_image_url', 'react_background_image_url_cdn');
	}
}
add_action('init', 'react_check_w3_cdn_enabled');
endif;
