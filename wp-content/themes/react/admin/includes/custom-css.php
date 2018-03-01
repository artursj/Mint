<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

$rtl = is_rtl();

$phonePtr = absint($options['break_point_phone_ptr']);
$phoneLdsp = absint($options['break_point_phone_ldsp']);
$tabletPtr = absint($options['break_point_tablet_ptr']);
$tabletLdsp = absint($options['break_point_tablet_ldsp']);
$desktop = absint($options['break_point_desktop']);
$tv = absint($options['break_point_tv']);

$convertBoxWidth = max(($options['page_layout_max_width'] + $options['page_layout_left_margin_tablets'] + $options['page_layout_right_margin_tablets']), ($tabletLdsp + $options['page_layout_left_margin_tablets'] + $options['page_layout_right_margin_tablets']));

$convertBoxWidthPlusMargin = max(($options['page_layout_max_width'] + $options['page_layout_left_margin'] + $options['page_layout_right_margin']), ($tabletLdsp + $options['page_layout_left_margin_tablets'] + $options['page_layout_right_margin_tablets']));

$shadowValue = $options['contrast_reverse'] ? '-1px' : '-3px';
?>

<?php
	if ($options['general_font'] == 'google' && $options['general_font_google_link'] && $options['general_font_google_family']) {
		// Heading font selector
		if ($options['general_font_selector']) {
			echo wp_strip_all_tags($options['general_font_selector']) . ' { ' . wp_strip_all_tags($options['general_font_google_family']) . '
			}';
		}

		// Built in selectors for options
		$selectors = array();
		if ($options['general_font_portfolio']) {
			$selectors[] = '.tcp-portfolio-item-title';
		}

		if ($options['general_font_serene']) {
			$selectors[] = '.serene-caption h1, .serene-caption h2, .serene-caption h3';
		}

		if ($options['general_font_fancybox']) {
			$selectors[] = '.fancybox-title h1, .fancybox-title h2, .fancybox-title h3';
		}

		if (count($selectors)) {
			echo wp_strip_all_tags(join(', ', $selectors)) . ' { ' . wp_strip_all_tags($options['general_font_google_family']) . '
			}';
		}
	}

	// Text font replacement
	if ($options['general_font_text'] == 'google' && $options['general_font_text_google_link'] && $options['general_font_text_google_family']) {
		// User font selector
		if ($options['general_font_text_selector']) {
			echo wp_strip_all_tags($options['general_font_text_selector']) . ' { ' . wp_strip_all_tags($options['general_font_text_google_family']) . '
			}';
		}
	}
?>


<?php /* Set page borders */ ?>

<?php
	if ($options['page_borders_lr']) {
		echo '
		/*Set borders for all styles*/
			body.t-mrg .header-all #header {border-top-style: solid; border-top-width: 1px;}
			body.t-mrg .top-and-pop > div.last-child, body.strch-top .top-and-pop #tophead {border-bottom-style: solid; border-bottom-width: 1px;}
			body.v-space .header-all > div.last-child {border-bottom-style: solid; border-bottom-width: 1px;}

			body.v-space .after-header-wrap > div:last-child {border-bottom-style: solid; border-bottom-width: 1px;}
			body.v-space .after-header-wrap > div.last-child {border-bottom-style: solid; border-bottom-width: 1px;}

			body.v-space .after-header-wrap > div.first-child,
			body.v-space .after-header-wrap > div:first-child,
			body.v-space .slider-wrap {border-top-style: solid; border-top-width: 1px;}

			body.pge-mxd .after-header-wrap > div, body.pge-bxd .after-header-wrap > div,
			body.pge-bxd .header-all > div, body.pge-mxd .header-all > div,
			body.pge-bxd .top-and-pop #tophead, body.pge-mxd .top-and-pop #tophead,
			body.pge-bxd .slider-wrap, body.pge-mxd .slider-wrap {
				border-left-style: solid; border-left-width: 1px;
				border-right-style: solid; border-right-width: 1px;}

			body.pge-fld .after-header-wrap > div, body.pge-fld .after-header-wrap > div,
			body.pge-fld .header-all > div, body.pge-fld .top-and-pop #tophead,
			body.pge-fld .slider-wrap {
				border-left-style: none; border-left-width: 0;
				border-right-style: none; border-right-width: 0;}

			/*Mixed style layout - streched elements*/
			body.lft-mrg .after-header-wrap > div,
			body.lft-mrg .header-all > div,
			body.lft-mrg .top-and-pop #tophead,
			body.lft-mrg .slider-wrap {
				border-left-style: solid; border-left-width: 1px;
			}
			body.rgt-mrg .after-header-wrap > div,
			body.rgt-mrg .header-all > div,
			body.rgt-mrg .top-and-pop #tophead,
			body.rgt-mrg .slider-wrap {
				border-right-style: solid; border-right-width: 1px;
			}
			body.pge-mxd.strch-allhd .header-all > div,
			body.pge-mxd.strch-allft .footer-all > div,
			body.pge-mxd.strch-top .top-and-pop #tophead,
			body.pge-mxd.strch-sf #subfooter {
				border-left: none 0;
				border-right: none 0;
			}


		';
	}
	if (!$options['page_borders_tb']) {
		echo '

			#tophead, #solonav, #header, .slider-wrap {
				border-bottom: none 0 !important;
			}
			.content-outer, .slider-wrap, #intro {
				border-top: none 0 !important;
			}

		';
	}
?>

<?php /* Logo Position */ ?>

.logo {width: <?php echo absint($options['general_logo_width']); ?>px; height: <?php echo (absint($options['general_logo_image_height']) + intval($options['general_logo_top'])); ?>px;}
<?php
	if ($options['general_logo_on_right']) {
		echo 'body.logo-r .logo a { margin-right: ' . intval($options['general_logo_left']) . 'px; margin-top: ' . intval($options['general_logo_top']) . 'px;}';
		echo 'body.logo-r .header-wrap-inner { padding-left: 0; padding-right: ' . absint($options['general_logo_width']) . 'px;}';
	} else {
		echo '.logo a { margin-left: ' . intval($options['general_logo_left']) . 'px; margin-top: ' . intval($options['general_logo_top']) . 'px;}';
		echo '.header-wrap-inner {padding-left: ' . absint($options['general_logo_width']) . 'px;}';
	}
	if ($options['general_logo_above']) {
		echo 'body.logo-abv .logo {left:50%;} body.logo-abv .logo a {margin: ' . intval($options['general_logo_top']) . 'px 0 0 ' . intval($options['general_logo_left']) . 'px;}';
		echo 'body.logo-abv .header-wrap-inner { padding-left: 0; padding-right: 0; padding-top: ' . absint($options['general_logo_width']) . 'px;}';
	}

		if (intval($options['general_logo_strapline_bottom'])) {
				echo '.logo span.strap-line { top: ' . intval($options['general_logo_strapline_bottom']) . 'px;}';
		}
		if ($options['general_logo_on_right']) {
			if (intval($options['general_logo_strapline_left'])) {
				echo 'body.logo-r .logo span.strap-line { right: ' . intval($options['general_logo_strapline_left']) . 'px; left: auto;}';
			}
		} else {
			echo '.logo span.strap-line { left: ' . intval($options['general_logo_strapline_left']) . 'px;}';
		}
?>

<?php /* Retina Ready */ ?>
<?php if ($options['general_logo_double'] || $options['footer_logo_double']) {
	echo '
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {';

			if ($options['general_logo_double']) {
				echo '
				.logo img {zoom: 1; filter: alpha(opacity=0); opacity: 0;}
				.logo a {
					background-image: url(' . esc_url(react_get_upload_url($options['general_logo_double'])) . ');
					background-size: ' . absint($options['general_logo_image_width']) . 'px ' . absint($options['general_logo_image_height']) . 'px;
					background-repeat: no-repeat;
					width: ' . absint($options['general_logo_image_width']) . 'px;
					height: ' . absint($options['general_logo_image_height']) . 'px;
					display: inline-block;
				}';
			}
			if ($options['footer_logo_double']) {
			echo '
				.footer_logo img {zoom: 1; filter: alpha(opacity=0); opacity: 0;}
				.footer_logo a {
					background-image: url(' . esc_url(react_get_upload_url($options['footer_logo_double'])) . ');
					background-size: ' . absint($options['footer_logo_image_width']) . 'px ' . absint($options['footer_logo_image_height']) . 'px;
					background-repeat: no-repeat;
					width: ' . absint($options['footer_logo_image_width']) . 'px;
					height: ' . absint($options['footer_logo_image_height']) . 'px;
					display: inline-block;
				}';
			}
	echo '}';
	}
?>

<?php
	if (absint($options['footer_border'])) {
		echo '.footer { border-top-width: ' . absint($options['footer_border']) . 'px;}';
	} else {
		echo '.footer { border-top: none 0 transparent}';
	}
?>

<?php
	if (absint($options['header_mainheader_padding']) != 25) {
		echo '.header-wrap-inner { padding-top: ' . absint($options['header_mainheader_padding']) . 'px; padding-bottom: ' . absint($options['header_mainheader_padding']) . 'px;}';
	}
?>
<?php
	if (absint($options['header_sticky_padding']) != 20) {
		echo '.stickied .header-wrap-inner { padding-top: ' . absint($options['header_sticky_padding']) . 'px; padding-bottom: ' . absint($options['header_sticky_padding']) . 'px;}
		';

		if (intval($options['header_sticky_logo_top']) != -1) {
			echo '.stickied .header-wrap-inner .logo a { margin-top: ' . intval($options['header_sticky_logo_top']) . 'px;}';
		}
	}
?>
<?php
	if (absint($options['intro_padding']) != 45) {
		echo '.intro-wrap, .js .intro-wrap { padding-top: ' . absint($options['intro_padding']) . 'px; padding-bottom: ' . absint($options['intro_padding']) . 'px;}';
	}
?>
<?php
	if (absint($options['footer_padding']) != 0) {
		echo '.footer-wrap { padding-top: ' . absint($options['footer_padding']) . 'px; padding-bottom: ' . absint($options['footer_padding']) . 'px;}';
	}
?>
<?php
	if (absint($options['above_footer_padding']) != 0) {
		echo '#footer-top-widget-area { padding-top: ' . absint($options['above_footer_padding']) . 'px; padding-bottom: ' . absint($options['above_footer_padding']) . 'px;}';
	}
?>
<?php
	if (absint($options['subfooter_padding']) != 25) {
		echo '.subfooter-wrap { padding-top: ' . absint($options['subfooter_padding']) . 'px; padding-bottom: ' . (absint($options['subfooter_padding']) - 5) . 'px;}';
	}
?>
<?php
if ($options['main_header_fixed']) {
	if ($options['main_header_fixed_convert'] != 'never') {
		if ($options['main_header_fixed_convert'] == 'box-width') {
			echo '@media only screen and (min-height: 300px) and (min-width: ' . absint($convertBoxWidthPlusMargin) . 'px) {';
		}
		elseif ($options['main_header_fixed_convert'] == 'phone-ptr') {
			echo '@media only screen and (min-height: 300px) and (min-width:' . (absint($phonePtr) + 1) . 'px) {';
		}
		elseif ($options['main_header_fixed_convert'] == 'phone-ldsp') {
			echo '@media only screen and (min-height: 300px) and (min-width:' . (absint($phoneLdsp) + 1) . 'px) {';
		}
		elseif ($options['main_header_fixed_convert'] == 'tablet-ptr') {
			echo '@media only screen and (min-height: 300px) and (min-width: ' . (absint($tabletPtr) + 1) . 'px) {';
		}
		elseif ($options['main_header_fixed_convert'] == 'tablet-ldsp') {
			echo '@media only screen and (min-height: 300px) and (min-width: ' . (absint($tabletLdsp) + 1) . 'px) {';
		}
	}

		echo '
			.header-all {
				position: fixed;
				width: 100%;
				left: 0;
				right: 0;
				top: 0;
				z-index: 205;
				margin-top: 0 !important;
				background-attachment:fixed;
				border-radius: 0!important;
			}
			.admin-bar .header-all {top: 32px;}
			.header-all > div.first-child,
			.header-all > div.first-child,
			.header-all	{
				border-top-right-radius:0!important;
				border-top-left-radius:0!important;
				border-top-style: none!important;
				border-top-width: 0!important;
			}
			.dismissed #popdown-trigger, body.pop-trig-abso #popdown-trigger {z-index: 206;}
			.after-header-wrap > div.first-child,
			.after-header-wrap > div.first-child {border-top-width: 1px; border-top-style: solid;}
			';
			if ($options['page_layout'] == 'pge-bxd' || $options['page_layout'] == 'pge-mxd') {
				echo '
				.after-header-wrap > div.first-child,
				.after-header-wrap > div.first-child,
				.after-header-wrap {border-top-right-radius:' . absint($options['page_rounded_corners']) . 'px; border-top-left-radius:' . absint($options['page_rounded_corners']) . 'px;}
				.header-all > div.last-child,
				.header-all > div:last-child,
				.header-all {border-bottom-right-radius:' . absint($options['page_rounded_corners']) . 'px; border-bottom-left-radius:' . absint($options['page_rounded_corners']) . 'px;}
			';
			}

		if ($options['main_header_no_margin']) {
				echo '
				.header-all {
					margin-left: 0 !important;
					margin-right: 0 !important;
				}
				.header-all > div {
					border-left: none 0!important;
					border-right: none 0!important;
					border-radius: 0 !important;
					margin-left: 0 !important;
					margin-right: 0 !important;
				}
			';
		}
		if (intval($options['main_header_top_fix']) != -1) {
				echo '
				#page {
					padding-top: ' . intval($options['main_header_top_fix']) . 'px;
				}
				body.page-template-template-fullscreen-media-php #page,
				body.page-template-template-note-block-php #page {padding-top: 0;}
			';
		}
		if ($options['main_header_fixed_convert'] != 'never') {
			echo '}';
		}
	}

?>

<?php if ($options['general_color_content_icon_image'] == 'lgt' && !$options['general_color_content_choose_scheme']) echo '
		.content-outer .widget_nav_menu ul.menu li ul li ul a,
		.content-outer .widget_nav_menu ul.menu li ul li ul a:hover,
		.content-outer .widget_nav_menu ul.menu li > a,
		.content-outer .widget_nav_menu ul.menu li > a:hover,
		.content-outer .tcs-menu.tcs-menu-separator > div > ul > li > a,
		.content-outer .tcs-menu.tcs-menu-separator > ul > li > a,
		.content-outer .tcs-menu.tcs-menu-separator > div > ul > li:hover > a,
		.content-outer .tcs-menu.tcs-menu-separator > ul > li:hover > a {
			background-image: url(../../react/images/sml-right-arrow-light.png);
		}

		.content-outer .ls-reactskin .ls-bottom-slidebuttons a:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

		.content-outer .ls-reactskin .ls-bottom-slidebuttons a .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a:hover .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover .after,

		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a .after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active .after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover .after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover .after,

		.content-outer .tcw-contact-details .sml.drk.iconsprite,
		.content-outer .tcw-contact-details .drk-ico .sml.iconsprite {
			background-image: url(../../react/images/icons/sprites-16-light.png) !important;
		}
		.content-outer .react .theme-default .nivo-controlNav a,
		.content-outer .react .vc-carousel-indicators li {
			background-image: url(../../react/images/icons/sprites-16-light.png);
		}
		.content-outer .tcs-list.tcs-list-bullet li:after,
		.content-outer .tcs-list.tcs-list-tick li:after,
		.content-outer .tcs-list.tcs-list-question li:after,
		.content-outer .tcs-list.tcs-list-arrow li:after,
		.content-outer .tcs-list.tcs-list-tick-plain li:after,
		.content-outer .tcs-list.tcs-list-arrow-drawn li:after,

		.content-outer .tcs-list.tcs-list-tick-plain li .after,
		.content-outer .tcs-list.tcs-list-arrow-drawn li .after,
		.content-outer .tcs-list.tcs-list-bullet li .after,
		.content-outer .tcs-list.tcs-list-tick li .after,
		.content-outer .tcs-list.tcs-list-question li .after,
		.content-outer .tcs-list.tcs-list-arrow li .after {
			background-position: bottom left;
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			.content-outer .widget_nav_menu ul.menu li ul li ul a,
			.content-outer .widget_nav_menu ul.menu li ul li ul a:hover,
			.content-outer .widget_nav_menu ul.menu li > a,
			.content-outer .widget_nav_menu ul.menu li > a:hover,
			.content-outer .tcs-menu.tcs-menu-separator > div > ul > li > a,
			.content-outer .tcs-menu.tcs-menu-separator > ul > li > a,
			.content-outer .tcs-menu.tcs-menu-separator > div > ul > li:hover > a,
			.content-outer .tcs-menu.tcs-menu-separator > ul > li:hover > a {
				background-image: url(../../react/images/sml-right-arrow-light@2x.png);
				background-size: 6px 9px;
			}

			.content-outer .ls-reactskin .ls-bottom-slidebuttons a:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

			.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:after,
			.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
			.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,
			.content-outer .tcw-contact-details .sml.drk.iconsprite,
			.content-outer .tcw-contact-details .drk-ico .sml.iconsprite {
				background-image: url(../../react/images/icons/sprites-32-light.png) !important;
				background-size: 496px 240px;
			}
			.content-outer .react .theme-default .nivo-controlNav a,
			.content-outer .react .vc-carousel-indicators li {
				background-image: url(../../react/images/icons/sprites-32-light.png);
				background-size: 496px 240px;
			}

		}

	';
?>



<?php /* Icons in prime color */ ?>
<?php
if ($options['general_color_global_primary_icon_image'] == 'drk') {
	echo '

		.fullscreen-pause:hover:after, .serene-pause:hover:after,
		.fullscreen-pause:hover .after, .serene-pause:hover .after,
		.video-fs-pause:hover:after, .video-fs-pause:hover .after {
			background-image: url(../../react/images/pause.png);
		}
		.fullscreen-play:hover:after, .serene-play:hover:after,
		.fullscreen-play:hover .after, .serene-play:hover .after,
		.video-fs-play:hover:after, .video-fs-play:hover .after {
			background-image: url(../../react/images/play.png);
		}
		.fullscreen-next:hover:after, .serene-next:hover:after,
		.fullscreen-next:hover .after, .serene-next:hover .after,
		.video-fs-next:hover:after, .video-fs-next:hover .after {
			background-image: url(../../react/images/forward.png);
		}
		.fullscreen-prev:hover:after, .serene-prev:hover:after,
		.fullscreen-prev:hover .after, .serene-prev:hover .after,
		.video-fs-prev:hover:after, .video-fs-prev:hover .after {
			background-image: url(../../react/images/backward.png);
		}
		.video-fs-unmute:hover:after, .video-fs-unmute:hover .after {
			background-image: url(../../react/images/sound.png);
		}
		.video-fs-mute:hover:after, .video-fs-mute:hover .after {
			background-image: url(../../react/images/no-sound.png);
		}
		.react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon {
			background-image: url(../../react/images/sml-down-arrow-dark.png);
		}
		.rev_slider_wrapper .tp-rightarrow.custom:hover, .rev_slider_wrapper .tp-leftarrow.custom:hover {
			background-image: url(../../react/images/slider-arrows-dark.png) !important;
		}
		.slider-wrap .ls-reactskin a.ls-nav-prev:hover,
		.slider-wrap .ls-reactskin a.ls-nav-next:hover,
		.tcs-image-carousel-wrap .tcs-carousel-prev:hover, .tcs-image-carousel-wrap .tcs-carousel-next:hover,
		a.fancybox-nav.fancybox-next:hover > span, a.fancybox-nav.fancybox-prev:hover > span,
		.react .theme-default .nivo-directionNav a.nivo-prevNav:hover,
		.react .flex-direction-nav a.flex-prev:hover,
		.react .theme-default .nivo-directionNav a.nivo-nextNav:hover,
		.react .flex-direction-nav a.flex-next:hover {
			background-image: url(../../react/images/slider-arrows-dark.png);
		}
		.slider-wrap .ls-reactskin .ls-nav-start:hover:after,
		.slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
		.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
		.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a:hover.ls-nav-active:after,
		.slider-wrap .ls-reactskin .ls-nav-stop:hover:after,
		.slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-active:hover:after,

		.slider-wrap .ls-reactskin .ls-nav-start:hover .after,
		.slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:hover.after,
		.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a:hover .after,
		.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a:hover.ls-nav-active .after,
		.slider-wrap .ls-reactskin .ls-nav-stop:hover .after,
		.slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-active:hover .after {
			background-image: url(../../react/images/icons/sprites-16-dark.png) !important;
		}
		.breadcrumbs .back-home-icon span {
			background-image: url(../../react/images/icons/sprites-16-dark.png);
		}

		.woocommerce.widget_product_search input#searchsubmit,
		.widget_search .searchform input.searchsubmit,
		.search-button-wrap input, .widget_search input.searchsubmit {
			background-image: url(../../react/images/search-icon-dark.png);
		}

		.fullscreen-close:hover, .serene-close:hover, .x-close:hover, .popdown-close .x-close,  .video-fs-close:hover,
		#comments .comment-respond h3#reply-title:hover {
			background-image: url(../../react/images/x-close-dark.png);
		}
		a.fancybox-close:hover {
			background-image: url(../../react/images/x-close-dark.png)!important;
		}


		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			.rev_slider_wrapper .tp-rightarrow.custom:hover, .rev_slider_wrapper .tp-leftarrow.custom:hover {
				background-image: url(../../react/images/slider-arrows-dark@2x.png) !important;
				background-size: 64px 32px !important;
			}
			.slider-wrap .ls-reactskin a.ls-nav-prev:hover,
			.slider-wrap .ls-reactskin a.ls-nav-next:hover,
			.tcs-image-carousel-wrap .tcs-carousel-prev:hover, .tcs-image-carousel-wrap .tcs-carousel-next:hover,
			a.fancybox-nav.fancybox-next:hover > span, a.fancybox-nav.fancybox-prev:hover > span,
			.react .theme-default .nivo-directionNav a.nivo-prevNav:hover,
			.react .flex-direction-nav a.flex-prev:hover,
			.react .theme-default .nivo-directionNav a.nivo-nextNav:hover,
			.react .flex-direction-nav a.flex-next:hover {
				background-image: url(../../react/images/slider-arrows-dark@2x.png);
				background-size: 64px 32px;
			}
			.slider-wrap .ls-reactskin .ls-nav-start:hover:after,
			.slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
			.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
			.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a:hover.ls-nav-active:after,
			.slider-wrap .ls-reactskin .ls-nav-stop:hover:after,
			.slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-active:hover:after {
				background-image: url(../../react/images/icons/sprites-32-dark.png) !important;
				background-size: 496px 240px;
			}
			.breadcrumbs .back-home-icon span {
				background-image: url(../../react/images/icons/sprites-32-dark.png);
				background-size: 496px 240px;
			}

			.woocommerce.widget_product_search input#searchsubmit,
			.widget_search .searchform input.searchsubmit,
			.search-button-wrap input, .widget_search input.searchsubmit {
				background-image: url(../../react/images/search-icon-dark@2x.png);
				background-size: 16px 16px;
			}

			.fullscreen-close:hover, .serene-close:hover, .x-close:hover, .popdown-close .x-close,  .video-fs-close:hover,
			#comments .comment-respond h3#reply-title:hover {
				background-image: url(../../react/images/x-close-dark@2x.png);
				background-size: 16px 16px;
			}
			a.fancybox-close:hover {
				background-image: url(../../react/images/x-close-dark@2x.png)!important;
				background-size: 16px 16px;
			}
			.react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon {
				background-image: url(../../react/images/sml-down-arrow-dark@2x.png);
				background-size: 9px 6px;
			}

			.fullscreen-pause:hover:after, .serene-pause:hover:after,
			.fullscreen-pause:hover .after, .serene-pause:hover .after,
			.video-fs-pause:hover:after, .video-fs-pause:hover .after {
				background-image: url(../../react/images/pause@2x.png);
				background-size: 16px 16px;
			}
			.fullscreen-play:hover:after, .serene-play:hover:after,
			.fullscreen-play:hover .after, .serene-play:hover .after,
			.video-fs-play:hover:after, .video-fs-play:hover .after {
				background-image: url(../../react/images/play@2x.png);
				background-size: 16px 16px;
			}
			.fullscreen-next:hover:after, .serene-next:hover:after,
			.fullscreen-next:hover .after, .serene-next:hover .after,
			.video-fs-next:hover:after, .video-fs-next:hover .after {
				background-image: url(../../react/images/forward@2x.png);
				background-size: 16px 16px;
			}
			.fullscreen-prev:hover:after, .serene-prev:hover:after,
			.fullscreen-prev:hover .after, .serene-prev:hover .after,
			.video-fs-prev:hover:after, .video-fs-prev:hover .after {
				background-image: url(../../react/images/backward@2x.png);
				background-size: 16px 16px;
			}
			.video-fs-unmute:hover:after, .video-fs-unmute:hover .after {
				background-image: url(../../react/images/sound@2x.png);
				background-size: 16px 16px;
			}
			.video-fs-mute:hover:after, .video-fs-mute:hover .after {
				background-image: url(../../react/images/no-sound@2x.png);
				background-size: 16px 16px;
			}

		}
	';
} else { echo '
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {

			.rev_slider_wrapper .tp-rightarrow.custom:hover, .rev_slider_wrapper .tp-leftarrow.custom:hover {
				background-image: url(../../react/images/slider-arrows-light@2x.png) !important;
				background-size: 64px 32px !important;
			}
			.slider-wrap .ls-reactskin a.ls-nav-prev:hover,
			.slider-wrap .ls-reactskin a.ls-nav-next:hover,
			.tcs-image-carousel-wrap .tcs-carousel-prev:hover, .tcs-image-carousel-wrap .tcs-carousel-next:hover,
			a.fancybox-nav.fancybox-next:hover > span, a.fancybox-nav.fancybox-prev:hover > span,
			.react .theme-default .nivo-directionNav a.nivo-prevNav:hover,
			.react .flex-direction-nav a.flex-prev:hover,
			.react .theme-default .nivo-directionNav a.nivo-nextNav:hover,
			.react .flex-direction-nav a.flex-next:hover {
				background-image: url(../../react/images/slider-arrows-light@2x.png);
				background-size: 64px 32px;
			}
			.slider-wrap .ls-reactskin .ls-nav-start:hover:after,
			.slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
			.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
			.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a:hover.ls-nav-active:after,
			.slider-wrap .ls-reactskin .ls-nav-stop:hover:after,
			.slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-active:hover:after {
				background-image: url(../../react/images/icons/sprites-32-light.png) !important;
				background-size: 496px 240px;
			}
			.breadcrumbs .back-home-icon span {
				background-image: url(../../react/images/icons/sprites-32-light.png);
				background-size: 496px 240px;
			}

			.woocommerce.widget_product_search input#searchsubmit,
			.widget_search .searchform input.searchsubmit,
			.search-button-wrap input, .widget_search input.searchsubmit {
				background-image: url(../../react/images/search-icon-light@2x.png);
				background-size: 16px 16px;
			}

			.fullscreen-close:hover, .serene-close:hover, .x-close:hover, .popdown-close .x-close,
			#comments .comment-respond h3#reply-title:hover {
				background-image: url(../../react/images/x-close-light@2x.png);
				background-size: 16px 16px;
			}
			a.fancybox-close:hover {
				background-image: url(../../react/images/x-close-light@2x.png)!important;
				background-size: 16px 16px;
			}

			.react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon {
				background-image: url(../../react/images/sml-down-arrow-light@2x.png);
				background-size: 9px 6px;
			}

		}';
	}
?>

<?php /* Icons in Topheader */ ?>
<?php
if ($options['general_color_topheader_nav_text_icon_image'] == 'lgt') {
	echo '
		#tophead .sf-arrows > li > .sf-with-ul:after,
		#tophead .sf-arrows > li > .sf-with-ul .after {
			background-image: url(../../react/images/sml-down-arrow-light.png);
		}
		#tophead .contact-info-drop-wrap a i.iconsprite.drk,
		#tophead .contact-details-top-head i.iconsprite.drk {
				background-image: url(../../react/images/icons/sprites-16-light.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {

			#tophead .sf-arrows > li > .sf-with-ul:after {
				background-image: url(../../react/images/sml-down-arrow-light@2x.png);
				background-size: 9px 6px;
			}

		   #tophead .contact-info-drop-wrap a i.iconsprite.drk,
		   #tophead .contact-details-top-head i.iconsprite.drk {
				background-image: url(../../react/images/icons/sprites-32-light.png);
				background-size: 496px 240px;
			}

		}
	';
} else { echo '
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {

			#tophead .sf-arrows > li > .sf-with-ul:after {
				background-image: url(../../react/images/sml-down-arrow-dark@2x.png);
				background-size: 9px 6px;
			}

			#tophead .contact-info-drop-wrap a i.iconsprite.drk,
			#tophead .contact-details-top-head i.iconsprite.drk {
				background-image: url(../../react/images/icons/sprites-32-dark.png);
				background-size: 496px 240px;
			}

		}';
	}
?>
<?php
if ($options['general_color_topheader_nav_buttonnav_icon_image'] == 'lgt') {
	echo '
		#tophead .button-nav .sf-arrows > li > .sf-with-ul:after,
		#tophead .button-nav .sf-arrows > li > .sf-with-ul .after {
			background-image: url(../../react/images/sml-down-arrow-light.png);
		}
		#tophead .sf-arrows ul .sf-with-ul:after,
		#tophead .sf-arrows ul .sf-with-ul .after {
			background-image: url(../../react/images/sml-right-arrow-light.png);
		}
		#tophead .contact-info-drop-wrap a i.iconsprite.drk,
		#tophead .contact-details-top-head i.iconsprite.drk {
			background-image: url(../../react/images/icons/sprites-16-light.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {

			#tophead .button-nav .sf-arrows > li > .sf-with-ul:after {
				background-image: url(../../react/images/sml-down-arrow-light@2x.png);
				background-size: 9px 6px;
			}
			#tophead .sf-arrows ul .sf-with-ul:after {
				background-image: url(../../react/images/sml-right-arrow-light@2x.png);
				background-size: 6px 9px;
			}
			#tophead .contact-info-drop-wrap a i.iconsprite.drk,
			#tophead .contact-details-top-head i.iconsprite.drk {
				background-image: url(../../react/images/icons/sprites-32-light.png);
				background-size: 496px 240px;
			}

		}
	';
} else { echo '
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {

			#tophead .button-nav .sf-arrows > li > .sf-with-ul:after {
				background-image: url(../../react/images/sml-down-arrow-dark@2x.png);
				background-size: 9px 6px;
			}
			#tophead .sf-arrows ul .sf-with-ul:after {
				background-image: url(../../react/images/sml-right-arrow-dark@2x.png);
				background-size: 6px 9px;
			}
			#tophead .contact-info-drop-wrap a i.iconsprite.drk,
			#tophead .contact-details-top-head i.iconsprite.drk {
				background-image: url(../../react/images/icons/sprites-32-dark.png);
				background-size: 496px 240px;
			}

		}';
	}
?>
<?php /* Icons in Mainheader */ ?>
<?php
if ($options['general_color_default_textnav_icon_image'] == 'lgt') {
	if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
		echo '
			#header.stickied .sf-arrows > li > .sf-with-ul:after,
			#header.stickied .sf-arrows > li > .sf-with-ul .after,';
		}
		echo '
			#header #nav-wrap .sf-arrows > li > .sf-with-ul:after,
			#header #nav-wrap .sf-arrows > li > .sf-with-ul .after {
				background-image: url(../../react/images/sml-down-arrow-light.png);
			}
			@media
			(-webkit-min-device-pixel-ratio: 1.5),
			(min-resolution: 144dpi),
			(min-resolution: 1.5dppx) {
			';
			if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
				echo '#header.stickied .sf-arrows > li > .sf-with-ul:after,';
			}
			echo '
			#header #nav-wrap .sf-arrows > li > .sf-with-ul:after {
				background-image: url(../../react/images/sml-down-arrow-light@2x.png);
				background-size: 9px 6px;
			}
		}
	';
} else {
	if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
		echo '
			#header.stickied.sf-arrows > li > .sf-with-ul:after,
			#header.stickied .sf-arrows > li > .sf-with-ul .after,';
		}
		echo '
			#header #nav-wrap .sf-arrows > li > .sf-with-ul:after,
			#header #nav-wrap .sf-arrows > li > .sf-with-ul .after {
				background-image: url(../../react/images/sml-down-arrow-dark.png);
			}
			@media
			(-webkit-min-device-pixel-ratio: 1.5),
			(min-resolution: 144dpi),
			(min-resolution: 1.5dppx) {
			';
			if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
				echo '#header.stickied .sf-arrows > li > .sf-with-ul:after,';
			}
			echo '
				#header #nav-wrap .sf-arrows > li > .sf-with-ul:after {
					background-image: url(../../react/images/sml-down-arrow-dark@2x.png);
					background-size: 9px 6px;
				}
			}
		';
	}
?>
<?php
if ($options['general_color_default_buttonnav_icon_image'] == 'lgt') {
	if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
		echo '
			#header.stickied.button-nav .sf-arrows > li > .sf-with-ul:after,
			#header.stickied.button-nav .sf-arrows > li > .sf-with-ul .after,';
		}
		echo '
		#header #nav-wrap.button-nav .sf-arrows > li > .sf-with-ul:after,
		#header #nav-wrap.button-nav .sf-arrows > li > .sf-with-ul .after {
			background-image: url(../../react/images/sml-down-arrow-light.png);
		}
	';
	if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
		echo '
			#header.stickied .sf-arrows ul .sf-with-ul:after,
			#header.stickied .sf-arrows ul .sf-with-ul .after,';
		}
	echo '
		#header #nav-wrap .sf-arrows ul .sf-with-ul:after,
		#header #nav-wrap .sf-arrows ul .sf-with-ul .after {
			background-image: url(../../react/images/sml-right-arrow-light.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			';
			if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
				echo '#header.stickied.button-nav .sf-arrows > li > .sf-with-ul:after,';
			}
			echo '
			#header #nav-wrap.button-nav .sf-arrows > li > .sf-with-ul:after {
				background-image: url(../../react/images/sml-down-arrow-light@2x.png);
				background-size: 9px 6px;
			}
			';
			if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
				echo '#header.stickied .sf-arrows ul .sf-with-ul:after,';
			}
			echo '
			#header #nav-wrap .sf-arrows ul .sf-with-ul:after {
				background-image: url(../../react/images/sml-right-arrow-light@2x.png);
				background-size: 6px 9px;
			}
		}
	';
} else {
	if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
			echo '
				#header.stickied.button-nav .sf-arrows > li > .sf-with-ul:after,
				#header.stickied.button-nav .sf-arrows > li > .sf-with-ul .after,';
			}
			echo '
				#header #nav-wrap.button-nav .sf-arrows > li > .sf-with-ul:after,
				#header #nav-wrap.button-nav .sf-arrows > li > .sf-with-ul .after {
					background-image: url(../../react/images/sml-down-arrow-dark.png);
				}
			';
			if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
				echo '
					#header.stickied .sf-arrows ul .sf-with-ul:after,
					#header.stickied .sf-arrows ul .sf-with-ul .after,';
				}
			echo '
			#header #nav-wrap .sf-arrows ul .sf-with-ul:after,
			#header #nav-wrap .sf-arrows ul .sf-with-ul .after {
				background-image: url(../../react/images/sml-right-arrow-dark.png);
			}
			@media
			(-webkit-min-device-pixel-ratio: 1.5),
			(min-resolution: 144dpi),
			(min-resolution: 1.5dppx) {
				';
				if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
					echo '#header.stickied #nav-wrap.button-nav .sf-arrows > li > .sf-with-ul:after,';
				}
				echo '
				#header #nav-wrap.button-nav .sf-arrows > li > .sf-with-ul:after {
					background-image: url(../../react/images/sml-down-arrow-dark@2x.png);
					background-size: 9px 6px;
				}';
				if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
					echo '#header.stickied .sf-arrows ul .sf-with-ul:after,';
				}
				echo '
				#header #nav-wrap .sf-arrows ul .sf-with-ul:after
				 {
					background-image: url(../../react/images/sml-right-arrow-dark@2x.png);
					background-size: 6px 9px;
				}
			}
		';
	}
?>
<?php /* Icons in SoloNav color */ ?>
<?php
if ($options['general_color_solonav_textnav_icon_image'] == 'lgt') {
	if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
		echo '
		#header.stickied .sf-arrows > li > .sf-with-ul:after,
		#header.stickied .sf-arrows > li > .sf-with-ul .after,';
		}
		echo '
		#solonav .sf-arrows > li > .sf-with-ul:after,
		#solonav .sf-arrows > li > .sf-with-ul .after {
			background-image: url(../../react/images/sml-down-arrow-light.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			';
			if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
			echo '#header.stickied .sf-arrows > li > .sf-with-ul:after,';
			}
			echo '
			#solonav .sf-arrows > li > .sf-with-ul:after {
				background-image: url(../../react/images/sml-down-arrow-light@2x.png);
				background-size: 9px 6px;
			}
		}
	';
} else {
		if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
			echo '
			#header.stickied .sf-arrows > li > .sf-with-ul:after,
			#header.stickied .sf-arrows > li > .sf-with-ul .after,';
			}
			echo '
			#solonav .sf-arrows > li > .sf-with-ul:after,
			#solonav .sf-arrows > li > .sf-with-ul .after {
				background-image: url(../../react/images/sml-down-arrow-dark.png);
			}
			@media
			(-webkit-min-device-pixel-ratio: 1.5),
			(min-resolution: 144dpi),
			(min-resolution: 1.5dppx) {
				';
				if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
				echo '#header.stickied .sf-arrows > li > .sf-with-ul:after,';
				}
				echo '
				#solonav .sf-arrows > li > .sf-with-ul:after {
					background-image: url(../../react/images/sml-down-arrow-dark@2x.png);
					background-size: 9px 6px;
				}
			}
		';
	}
?>
<?php
if ($options['general_color_solonav_buttonnav_icon_image'] == 'lgt') {
	if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
		echo '
		#header.stickied.button-nav .sf-arrows > li > .sf-with-ul:after,
		#header.stickied.button-nav .sf-arrows > li > .sf-with-ul .after,
		';
		}
		echo '
		#solonav .button-nav .sf-arrows > li > .sf-with-ul:after,
		#solonav .button-nav .sf-arrows > li > .sf-with-ul .after {
			background-image: url(../../react/images/sml-down-arrow-light.png);
		}
		';
		if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
		echo '
			#header.stickied .sf-arrows ul .sf-with-ul:after,
			#header.stickied .sf-arrows ul .sf-with-ul .after,';
		}
		echo '
		#solonav .sf-arrows ul .sf-with-ul:after,
		#solonav .sf-arrows ul .sf-with-ul .after {
			background-image: url(../../react/images/sml-right-arrow-light.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			';
			if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
			echo '#header.stickied.button-nav .sf-arrows > li > .sf-with-ul:after,';
			}
			echo '
			#solonav .button-nav .sf-arrows > li > .sf-with-ul:after {
				background-image: url(../../react/images/sml-down-arrow-light@2x.png);
				background-size: 9px 6px;
			}
			';
			if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
			echo '#header.stickied .sf-arrows ul .sf-with-ul:after,';
			}
			echo '
			#solonav .sf-arrows ul .sf-with-ul:after {
				background-image: url(../../react/images/sml-right-arrow-light@2x.png);
				background-size: 6px 9px;
			}
		}
	';
} else {
		if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
			echo '
				#header.stickied.button-nav .sf-arrows > li > .sf-with-ul:after,
				#header.stickied.button-nav .sf-arrows > li > .sf-with-ul .after,
			';
		}
		echo '
		#solonav .button-nav .sf-arrows > li > .sf-with-ul:after,
		#solonav .button-nav .sf-arrows > li > .sf-with-ul .after {
			background-image: url(../../react/images/sml-down-arrow-dark.png);
		}
		';
		if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
		echo '
			#header.stickied .sf-arrows ul .sf-with-ul:after,
			#header.stickied .sf-arrows ul .sf-with-ul .after,';
		}
		echo '
		#solonav .sf-arrows ul .sf-with-ul:after,
		#solonav .sf-arrows ul .sf-with-ul .after {
			background-image: url(../../react/images/sml-right-arrow-dark.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			';
			if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
			echo '#header.stickied.button-nav .sf-arrows > li > .sf-with-ul:after,';
			}
			echo '
			#solonav .button-nav .sf-arrows > li > .sf-with-ul:after {
				background-image: url(../../react/images/sml-down-arrow-dark@2x.png);
				background-size: 9px 6px;
			}
			';
			if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
			echo '#header.stickied .sf-arrows ul .sf-with-ul:after,';
			}
			echo '
			#solonav .sf-arrows ul .sf-with-ul:after {
				background-image: url(../../react/images/sml-right-arrow-dark@2x.png);
				background-size: 6px 9px;
			}
		}';
	}
?>

<?php /* Icons in Slider color */ ?>
<?php
if ($options['general_color_slider_icon_image'] == 'lgt') {
	echo '
		.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a:after,
		.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,

		.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a .after,
		.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active .after {
			 background-image: url(../../react/images/icons/sprites-16-light.png) !important;
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a:after,
			.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after {
				 background-image: url(../../react/images/icons/sprites-32-light.png) !important;
				 background-size: 496px 240px;
			}

		}
	';
} else { echo '
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a:after,
			.slider-wrap .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after {
				 background-image: url(../../react/images/icons/sprites-32-dark.png) !important;
				 background-size: 496px 240px;
			}

		}';
	}
?>
<?php
if ($options['general_color_slider_prime_icon_image'] == 'drk') {
	echo '
		.rev_slider_wrapper .tp-rightarrow.custom:hover, .rev_slider_wrapper .tp-leftarrow.custom:hover {
			background-image: url(../../react/images/slider-arrows-dark.png) !important;
		}
		.slider-wrap .ls-reactskin a.ls-nav-next:hover,
		.slider-wrap .ls-reactskin a.ls-nav-prev:hover {
			background-image: url(../../react/images/slider-arrows-dark.png);
		}
		body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
		body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop-active:hover:after,
		body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start:hover:after,
		body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop:hover:after,

		body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:hover .after,
		body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop-active:hover .after,
		body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start:hover .after,
		body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop:hover .after {
			background-image: url(../../react/images/icons/sprites-16-dark.png) !important;
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			.rev_slider_wrapper .tp-rightarrow.custom:hover, .rev_slider_wrapper .tp-leftarrow.custom:hover {
				background-image: url(../../react/images/slider-arrows-dark@2x.png) !important;
				background-size: 64px 32px !important;
			}
			.slider-wrap .ls-reactskin a.ls-nav-next:hover,
			.slider-wrap .ls-reactskin a.ls-nav-prev:hover {
				background-image: url(../../react/images/slider-arrows-dark@2x.png);
				background-size: 64px 32px;
			}
			body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
			body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop-active:hover:after,
			body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start:hover:after,
			body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop:hover:after {
				background-image: url(../../react/images/icons/sprites-32-dark.png) !important;
				background-size: 496px 240px;
			}

		}
	';
} else { echo '
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			.rev_slider_wrapper .tp-rightarrow.custom:hover, .rev_slider_wrapper .tp-leftarrow.custom:hover {
				background-image: url(../../react/images/slider-arrows-light@2x.png) !important;
				background-size: 64px 32px !important;
			}
			.slider-wrap .ls-reactskin a.ls-nav-next:hover,
			.slider-wrap .ls-reactskin a.ls-nav-prev:hover {
				background-image: url(../../react/images/slider-arrows-light@2x.png);
				background-size: 64px 32px;
			}
			body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
			body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop-active:hover:after,
			body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start:hover:after,
			body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop:hover:after {
				background-image: url(../../react/images/icons/sprites-32-light.png) !important;
				background-size: 496px 240px;
			}

		}';
	}
?>


<?php
if ($options['general_color_slider_dark_icon_image'] == 'drk') {
	echo '
		.rev_slider_wrapper .tp-rightarrow.custom, .rev_slider_wrapper .tp-leftarrow.custom {
			background-image: url(../../react/images/slider-arrows-dark.png) !important;
		}
		.slider-wrap .ls-reactskin a.ls-nav-next,
		.slider-wrap .ls-reactskin a.ls-nav-prev {
			background-image: url(../../react/images/slider-arrows-dark.png);
		}
		body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:after,
		body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop-active:after,
		body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start:after,
		body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop:after,

		body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active .after,
		body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop-active .after,
		body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start .after,
		body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop .after {
			background-image: url(../../react/images/icons/sprites-16-dark.png) !important;
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			.rev_slider_wrapper .tp-rightarrow.custom, .rev_slider_wrapper .tp-leftarrow.custom {
				background-image: url(../../react/images/slider-arrows-dark@2x.png) !important;
				background-size: 64px 32px !important;
			}
			.slider-wrap .ls-reactskin a.ls-nav-next,
			.slider-wrap .ls-reactskin a.ls-nav-prev {
				background-image: url(../../react/images/slider-arrows-dark@2x.png);
				background-size: 64px 32px;
			}
			body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:after,
			body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop-active:after,
			body .slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start:after,
			body .slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-stop:after {
				background-image: url(../../react/images/icons/sprites-32-dark.png) !important;
				background-size: 496px 240px;
			}

		}
	';
}
?>


<?php /* Info Menu */ ?>
.im-box.im-drop {width: <?php echo absint($options['infomenu_dropdown_width']); ?>px;}
<?php
	if ($options['im_scroll_type_contact']) {
		echo '
			#im-box-contact.scroll {height: ' . absint($options['im_scroll_height_type_contact']) . 'px;}
		';
	}
?>
<?php
if (is_numeric($options['im_contact_map_ratio_first']) && $options['im_contact_map_ratio_first'] > 0  && is_numeric($options['im_contact_map_ratio_last']) && $options['im_contact_map_ratio_last'] > 0) {
	$IMMapAspectRatio = ($options['im_contact_map_ratio_last'] / $options['im_contact_map_ratio_first']) * 100;
	echo '
	   .im-box .flexible-frame.im-map {padding-bottom: ' . floatval($IMMapAspectRatio) . '%;}
	';
}
?>
<?php
if (is_numeric($options['im_contact_video_ratio_first']) && $options['im_contact_video_ratio_first'] > 0  && is_numeric($options['im_contact_video_ratio_last']) && $options['im_contact_video_ratio_last'] > 0) {
	$IMVideoAspectRatio = ($options['im_contact_video_ratio_last'] / $options['im_contact_video_ratio_first']) * 100;
	echo '
	   .im-box .flexible-frame.im-video {padding-bottom: ' . floatval($IMVideoAspectRatio) . '%;}
	';
}
?>
<?php /* Font size */ ?>
<?php
	if (absint($options['general_font_size']) != 13) {
		echo '
		body, .tcp-portfolio-items .tcp-portfolio-item, .tcs-lightbox {
			font-size: ' . absint($options['general_font_size']) . 'px;
		}
		';
	}
	if (intval($options['general_heading_spacing']) != 2) {
		echo '
		body, .tcp-portfolio-items .tcp-portfolio-item {
			letter-spacing: ' . (intval($options['general_heading_spacing']) * 0.01) . 'em;
		}
		';
	}



	if ($options['general_heading_size'] == 'med') {
		echo '

			h1, .tcs-impact-heading {
				font-size: 39px;
				line-height: 54px;
			}
			#intro h1.intro-title {
				font-size: 47px;
				line-height: 64px;
			}
			h2 {
				font-size: 26px;
				line-height: 38px;
			}
			#intro h2.intro-subtitle {
				font-size: 19px;
				line-height: 28px;
			}
			h3, span.contact-ico {
				font-size: 16px;
				line-height: 27px;
			}
			h4 {
				font-size: 14px;
				line-height: 23px;
			}
			h5, h6 {
				font-size: 14px;
				line-height: 23px;
			}
			.tcs-impact-header.tcs-heading-subheading .tcs-impact-heading, .tcs-impact-header.tcs-heading-subheading-button .tcs-impact-heading {
				font-size: 39px;
				line-height: 54px;
			}
			.tcs-impact-header .tcs-impact-subheading {
				font-size: 16px;
				line-height: 27px;
			}
			.tcs-fancy-header.tcs-small,
			.tcs-fancy-header.tcs-small i {
				font-size: 15px;
				line-height: 27px;
			}
			.tcs-fancy-header.tcs-medium {
				font-size: 20px;
				line-height: 31px;
			}
			.tcs-fancy-header.tcs-large {
				font-size: 36px;
				line-height: 50px;
			}
			.tcs-fancy-header.tcs-huge {
				font-size: 43px;
				line-height: 57px;
			}
		';
	}
	elseif ($options['general_heading_size'] == 'lrg') {
		echo '
			h1, .tcs-impact-heading {
				font-size: 45px;
				line-height: 61px;
			}
			#intro h1.intro-title {
				font-size: 55px;
				line-height: 72px;
			}
			h2 {
				font-size: 31px;
				line-height: 44px;
			}
			#intro h2.intro-subtitle {
				font-size: 22px;
				line-height: 33px;
			}
			h3, span.contact-ico {
				font-size: 18px;
				line-height: 29px;
			}
			h4 {
				font-size: 16px;
				line-height: 27px;
			}
			h5, h6 {
				font-size: 15px;
				line-height: 27px;
			}
			.tcs-impact-header.tcs-heading-subheading .tcs-impact-heading, .tcs-impact-header.tcs-heading-subheading-button .tcs-impact-heading {
				font-size: 45px;
				line-height: 61px;
			}
			.tcs-impact-header .tcs-impact-subheading {
				font-size: 22px;
				line-height: 33px;
			}
			.tcs-fancy-header.tcs-small,
			.tcs-fancy-header.tcs-small i {
				font-size: 18px;
				line-height: 29px;
			}
			.tcs-fancy-header.tcs-medium {
				font-size: 24px;
				line-height: 35px;
			}
			.tcs-fancy-header.tcs-large {
				font-size: 42px;
				line-height: 57px;
			}
			.tcs-fancy-header.tcs-huge {
				font-size: 52px;
				line-height: 70px;
			}

		';
	}



	if ($options['general_font_h1_fw'] != '' || $options['general_font_h1_up'] || $options['general_font_h1_space'] != 0 || $options['general_font_h1_size'] != 0) {
		echo '
			h1, .fullscreen-caption h1, .serene-caption h1 {';
				if ($options['general_font_h1_space'] != 0) {
					echo '
						letter-spacing: ' . intval($options['general_font_h1_space']) . 'px;
					';
				}
				if ($options['general_font_h1_fw'] != '') {
					echo '
						font-weight: ' . absint($options['general_font_h1_fw']) . ';
					';
				}
				if ($options['general_font_h1_up']) {
					echo '
						text-transform: uppercase;
					';
				}
				if ($options['general_font_h1_size'] != 0) {
					echo '
						font-size: ' . absint($options['general_font_h1_size']) . 'px;';
					if ($options['general_font_h1_size'] >= 22) {
						echo '
							line-height: ' . (absint($options['general_font_h1_size']) * 1.2) . 'px;
						';
					} else {
						echo '
							line-height: ' . (absint($options['general_font_h1_size']) * 1.7) . 'px;
						';
					}
				}
			echo '}
		';
	}

	if ($options['general_font_h2_fw'] != '' || $options['general_font_h2_up'] || $options['general_font_h2_space'] != 0 || $options['general_font_h2_size'] != 0) {
		echo '
			h2, .fullscreen-caption h2, .serene-caption h2 {';
				if ($options['general_font_h2_space'] != 0) {
					echo '
						letter-spacing: ' . intval($options['general_font_h2_space']) . 'px;
					';
				}
				if ($options['general_font_h2_fw'] != '') {
					echo '
						font-weight: ' . absint($options['general_font_h2_fw']) . ';
					';
				}
				if ($options['general_font_h2_up']) {
					echo '
						text-transform: uppercase;
					';
				}
				if ($options['general_font_h2_size'] != 0) {
					echo '
						font-size: ' . absint($options['general_font_h2_size']) . 'px;';
					if ($options['general_font_h2_size'] >='22') {
						echo '
							line-height: ' . (absint($options['general_font_h2_size'])) * 1.2 . 'px;
						';
					} else {
						echo '
							line-height: ' . (absint($options['general_font_h2_size'])) * 1.7 . 'px;
						';
					}
				}
			echo '}
		';
	}

	if ($options['general_font_h3_fw'] != '' || $options['general_font_h3_up'] || $options['general_font_h3_space'] != 0 || $options['general_font_h3_size'] != 0) {
		echo '
			h3, .fullscreen-caption h3, .serene-caption h3, span.contact-ico {';
				if ($options['general_font_h3_space'] != 0) {
					echo '
						letter-spacing: ' . intval($options['general_font_h3_space']) . 'px;
					';
				}
				if ($options['general_font_h3_fw'] != '') {
					echo '
						font-weight: ' . absint($options['general_font_h3_fw']) . ';
					';
				}
				if ($options['general_font_h3_up']) {
					echo '
						text-transform: uppercase;
					';
				}
				if ($options['general_font_h3_size'] != 0) {
					echo '
						font-size: ' . absint($options['general_font_h3_size']) . 'px;';
					if ($options['general_font_h3_size'] >='22') {
						echo '
							line-height: ' . (absint($options['general_font_h3_size']) * 1.2) . 'px;
						';
					} else {
						echo '
							line-height: ' . (absint($options['general_font_h3_size']) * 1.7) . 'px;
						';
					}
				}
			echo '}
		';
	}
	if ($options['general_font_h4_fw'] != '' || $options['general_font_h4_up'] || $options['general_font_h4_space'] != 0 || $options['general_font_h4_size'] != 0) {
		echo '
			h4, .fullscreen-caption h4, .serene-caption h4 {';
				if ($options['general_font_h4_space'] != 0) {
					echo '
						letter-spacing: ' . intval($options['general_font_h4_space']) . 'px;
					';
				}
				if ($options['general_font_h4_fw'] != '') {
					echo '
						font-weight: ' . absint($options['general_font_h4_fw']) . ';
					';
				}
				if ($options['general_font_h4_up']) {
					echo '
						text-transform: uppercase;
					';
				}
				if ($options['general_font_h4_size'] != 0) {
					echo '
						font-size: ' . absint($options['general_font_h4_size']) . 'px;';
					if ($options['general_font_h4_size'] >='22') {
						echo '
							line-height: ' . (absint($options['general_font_h4_size']) * 1.2) . 'px;
						';
					} else {
						echo '
							line-height: ' . (absint($options['general_font_h4_size']) * 1.7) . 'px;
						';
					}
				}
			echo '}
		';
	}
	if ($options['general_font_h5_fw'] != '' || $options['general_font_h5_up'] || $options['general_font_h5_space'] != 0 || $options['general_font_h5_size'] != 0) {
		echo '
			h5, h6, .fullscreen-caption h5, .serene-caption h5 {';
				if ($options['general_font_h5_space'] != 0) {
					echo '
						letter-spacing: ' . intval($options['general_font_h5_space']) . 'px;
					';
				}
				if ($options['general_font_h5_fw'] != '') {
					echo '
						font-weight: ' . absint($options['general_font_h5_fw']) . ';
					';
				}
				if ($options['general_font_h5_up']) {
					echo '
						text-transform: uppercase;
					';
				}
				if ($options['general_font_h5_size'] != 0) {
					echo '
						font-size: ' . absint($options['general_font_h5_size']) . 'px;';
					if ($options['general_font_h5_size'] >='22') {
						echo '
							line-height: ' . (absint($options['general_font_h5_size']) * 1.2) . 'px;
						';
					} else {
						echo '
							line-height: ' . (absint($options['general_font_h5_size']) * 1.7) . 'px;
						';
					}
				}
			echo '}
		';
	}
	if ($options['general_font_intro_fw'] != '' || $options['general_font_intro_space'] != 0 || $options['general_font_intro_size'] != 0 || $options['general_font_intro_up'] || $options['general_font_h1_up']) {
		echo '
			#intro h1.intro-title {';
				if ($options['general_font_intro_space'] != 0) {
					echo '
						letter-spacing: ' . intval($options['general_font_intro_space']) . 'px;
					';
				}
				if ($options['general_font_intro_fw'] != '') {
					echo '
						font-weight: ' . absint($options['general_font_intro_fw']) . ';
					';
				}
				if (!$options['general_font_intro_up']) {
					echo '
						text-transform: none;
					';
				} else {
					echo '
						text-transform: uppercase;
					';
				}
				if ($options['general_font_intro_size'] != 0) {
					echo '
						font-size: ' . absint($options['general_font_intro_size']) . 'px;';
					if ($options['general_font_intro_size'] >='22') {
						echo '
							line-height: ' . (absint($options['general_font_intro_size']) * 1.2) . 'px;
						';
					} else {
						echo '
							line-height: ' . (absint($options['general_font_intro_size']) * 1.7) . 'px;
						';
					}
				}
			echo '}
		';
	}
	if ($options['general_font_intro_sub_fw'] != '' || $options['general_font_intro_sub_space'] != 0 || $options['general_font_intro_sub_size'] != 0 || $options['general_font_intro_sub_up'] || $options['general_font_h2_up']) {
		echo '
			#intro h2.intro-subtitle {';
				if ($options['general_font_intro_sub_space'] != 0) {
					echo '
						letter-spacing: ' . intval($options['general_font_intro_sub_space']) . 'px;
					';
				}
				if ($options['general_font_intro_sub_fw'] != '') {
					echo '
						font-weight: ' . absint($options['general_font_intro_sub_fw']) . ';
					';
				}
				if (!$options['general_font_intro_sub_up']) {
					echo '
						text-transform: none;
					';
				} else {
					echo '
						text-transform: uppercase;
					';
				}
				if ($options['general_font_intro_sub_size'] != 0) {
					echo '
						font-size: ' . absint($options['general_font_intro_sub_size']) . 'px;';
					if ($options['general_font_intro_sub_size'] >='22') {
						echo '
							line-height: ' . (absint($options['general_font_intro_sub_size']) * 1.2) . 'px;
						';
					} else {
						echo '
							line-height: ' . (absint($options['general_font_intro_sub_size']) * 1.7) . 'px;
						';
					}
				}
			echo '}
		';
	}

	if ($options['general_font_general_buttons_fw'] != '' || $options['general_font_general_buttons_up'] || $options['general_font_general_buttons_space'] != 0 || $options['general_font_general_buttons_size'] != 0) {
		echo '
			#intro-page-skip a,
			.comments-link a, .read-more-link .more-link,
			.iphorm-theme-react-default .iphorm-submit-wrap button span,
			.tcs-tabs ul.tcs-tabs-nav li a,
			.tcs-button > a, .tcs-button > span.tcs-r-button,
			.tcp-portfolio-filter .tcp-filter-button,
			a.basic-button,
			a.tcp-basic-button,
			.tcw-follow-me-button a, .form-submit input,
			.searchform input.searchsubmit,

			.react-wp .woocommerce #content input.button,
			.react-wp .woocommerce #respond input#submit,
			.react-wp .woocommerce #respond input#submit,
			.react-wp .woocommerce a.button,
			.react-wp .woocommerce button.button,
			.react-wp .woocommerce input.button,
			.react-wp.woocommerce-page #content input.button,
			.react-wp.woocommerce-page #respond input#submit,
			.react-wp.woocommerce-page a.button,
			.react-wp.woocommerce-page button.button,
			.react-wp.woocommerce-page input.button,
			.react-wp.woocommerce ul.products li.product a.added_to_cart,
			.react-wp.woocommerce-page ul.products li.product a.added_to_cart,

			.react-wp .woocommerce #content input.button.alt,
			.react-wp .woocommerce #respond input#submit.alt,
			.react-wp .woocommerce a.button.alt,
			.react-wp .woocommerce button.button.alt,
			.react-wp .woocommerce input.button.alt,
			.react-wp.woocommerce-page #content input.button.alt,
			.react-wp.woocommerce-page #respond input#submit.alt,
			.react-wp.woocommerce-page a.button.alt,
			.react-wp.woocommerce-page button.button.alt,
			.react-wp.woocommerce-page input.button.alt,

			.react-wp .woocommerce.widget_product_search input[type="submit"],
			.react-wp .woocommerce #content div.product .woocommerce-tabs ul.tabs li a,
			.react-wp .woocommerce div.product .woocommerce-tabs ul.tabs li a,
			.react-wp.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a,
			.react-wp.woocommerce-page div.product .woocommerce-tabs ul.tabs li a {';
				if ($options['general_font_general_buttons_space'] !='0') {
					echo '
						letter-spacing: ' . intval($options['general_font_general_buttons_space']) . 'px;
						text-indent: ' . intval($options['general_font_general_buttons_space']) . 'px;
					';
				}
				if ($options['general_font_general_buttons_fw'] != '') {
					echo '
						font-weight: ' . absint($options['general_font_general_buttons_fw']) . ';
					';
				}
				if ($options['general_font_general_buttons_up']) {
					echo '
						text-transform: uppercase;
					';
				} else {
					echo '
						text-transform: none;
					';
				}
				if ($options['general_font_general_buttons_size'] != 0) {
					echo '
						font-size: ' . absint($options['general_font_general_buttons_size']) . 'px;';
					if ($options['general_font_general_buttons_size'] >='14') {
						echo '
							line-height: ' . (absint($options['general_font_general_buttons_size']) * 1.95) . 'px;
						';
					} else {
						echo '
							line-height: ' . (absint($options['general_font_general_buttons_size']) * 1.75) . 'px;
						';
					}
				}
			echo '}
		';
	}




	if ($options['general_font_h1_mobile_friendly_size'] != 0) {
		echo '
		@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
			h1, .fullscreen-caption h1, .serene-caption h1 {
				font-size: ' . absint($options['general_font_h1_mobile_friendly_size']) . 'px !important;
				line-height: ' . (absint($options['general_font_h1_mobile_friendly_size']) * 1.2) . 'px !important;
			}
		}';
	}
	if ($options['general_font_h2_mobile_friendly_size'] != 0) {
		echo '
		@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
			h2, .fullscreen-caption h2, .serene-caption h2 {
				font-size: ' . absint($options['general_font_h2_mobile_friendly_size']) . 'px !important;
				line-height: ' . (absint($options['general_font_h2_mobile_friendly_size']) * 1.2) . 'px !important;
			}
		}';
	}
	if ($options['general_font_h3_mobile_friendly_size'] != 0) {
		echo '
		@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
			h3, .fullscreen-caption h3, .serene-caption h3, span.contact-ico {
				font-size: ' . absint($options['general_font_h3_mobile_friendly_size']) . 'px !important;
				line-height: ' . (absint($options['general_font_h3_mobile_friendly_size']) * 1.4) . 'px !important;
			}
		}';
	}
	if ($options['general_font_h4_mobile_friendly_size'] != 0) {
		echo '
		@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
			h4, .fullscreen-caption h4, .serene-caption h4  {
				font-size: ' . absint($options['general_font_h4_mobile_friendly_size']) . 'px !important;
				line-height: ' . (absint($options['general_font_h4_mobile_friendly_size']) * 1.4) . 'px !important;
			}
		}';
	}
	if ($options['general_font_h5_mobile_friendly_size'] != 0) {
		echo '
		@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
			h5, h6, .fullscreen-caption h5, .serene-caption h5  {
				font-size: ' . absint($options['general_font_h5_mobile_friendly_size']) . 'px !important;
				line-height: ' . (absint($options['general_font_h5_mobile_friendly_size']) * 1.5) . 'px !important;
			}
		}';
	}
	if ($options['general_font_intro_mobile_friendly_size'] != 0) {
		echo '
		@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
			#intro h1.intro-title {
				font-size: ' . absint($options['general_font_intro_mobile_friendly_size']) . 'px !important;
				line-height: ' . (absint($options['general_font_intro_mobile_friendly_size']) * 1.2) . 'px !important;
			}
		}';
	}
	if ($options['general_font_intro_sub_mobile_friendly_size'] != 0) {
		echo '
		@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
			#intro h2.intro-subtitle {
				font-size: ' . absint($options['general_font_intro_sub_mobile_friendly_size']) . 'px !important;
				line-height: ' . (absint($options['general_font_intro_sub_mobile_friendly_size']) * 1.4) . 'px !important;
			}
		}';
	}



	if ($options['head_nav_style_space'] != 0 || $options['head_nav_style_bold'] != '' || $options['head_nav_style_size'] != '') {
		echo '
			 #header ul.react-menu li, #header ul.react-menu li a, #header ul.react-menu > li > a > span.main, .sidr.left ul li a {';
				if ($options['head_nav_style_space'] != 0) {
					echo '
						letter-spacing: ' . intval($options['head_nav_style_space']) . 'px;
						text-indent: ' . intval($options['head_nav_style_space']) . 'px;
					';
				}
				if ($options['head_nav_style_size'] != '') {
					echo '
						font-size: ' . absint($options['head_nav_style_size']) . 'px;
					';
				}
				if ($options['head_nav_style_bold'] != '') {
					echo '
						font-weight: ' . absint($options['head_nav_style_bold']) . ';
					';
				}
			echo '}
		';
		if ($options['head_nav_style_upper']) {
			echo '
				#header ul.react-menu > li > a, .sidr.left ul li a {text-transform: uppercase;}
			';
		}
	}
	if ($options['solo_nav_style_space'] != 0 || $options['solo_nav_style_bold'] != '' || $options['solo_nav_style_size'] != '') {
		echo '
			 #solonav ul.react-menu li, #solonav ul.react-menu li a, #solonav ul.react-menu > li > a > span.main {';
				if ($options['solo_nav_style_space'] != 0) {
					echo '
						letter-spacing: ' . intval($options['solo_nav_style_space']) . 'px;
						text-indent: ' . intval($options['solo_nav_style_space']) . 'px;
					';
				}
				if ($options['solo_nav_style_size'] !='') {
					echo '
						font-size: ' . absint($options['solo_nav_style_size']) . 'px;
					';
				}
				if ($options['solo_nav_style_bold'] != '') {
					echo '
						font-weight: ' . absint($options['solo_nav_style_bold']) . ';
					';
				}
			echo '}
		';
		if ($options['solo_nav_style_upper']) {
			echo '
				#solonav ul.react-menu > li > a {text-transform: uppercase;}
			';
		}
	}
	if ($options['tophead_nav_style_space'] != 0 || $options['tophead_nav_style_bold'] != '' ) {
		echo '
			 #tophead ul.react-menu li, #tophead ul.react-menu li a, #tophead ul.react-menu > li > a > span.main, .sidr.right ul li a, #tophead .contact-details-top-head > div > div > a{';
				if ($options['tophead_nav_style_space'] != 0) {
					echo '
						letter-spacing: ' . intval($options['tophead_nav_style_space']) . 'px;
						text-indent: ' . intval($options['tophead_nav_style_space']) . 'px;
					';
				}
				if ($options['tophead_nav_style_bold'] != '') {
					echo '
						font-weight: ' . absint($options['tophead_nav_style_bold']) . ';
					';
				}

			echo '}
		';
		if ($options['tophead_nav_style_upper']) {
			echo '
				#tophead ul.react-menu > li > a, .sidr.right ul li a, #tophead .contact-details-top-head > div > div > a {text-transform: uppercase;}
			';
		}
	}

?>
<?php /* Fixed footer padding */ ?>
<?php
	if ($options['show_subfooter_desktop'] || $options['show_subfooter_phone'] || $options['show_subfooter_tablet'] || $options['show_subfooter_large']) {
		if ($options['footer_position'] == 'fixed' && $options['footer_widget_area_layout'] == '' && $options['footer_position_height']) {
			echo '.content-inner {padding-bottom: ' . absint($options['footer_position_height']) . 'px;} .left-intro-box-page {padding-bottom: ' . (absint($options['footer_position_height']) + 30) . 'px;}';
		}
		elseif ($options['footer_position'] == 'fixed' && $options['footer_widget_area_layout'] != '' && $options['footer_position_height']) {
			echo '.content-inner {padding-bottom: 0;} .footer-wrap {padding-bottom: ' . absint($options['footer_position_height']) . 'px;} .left-intro-box-page {padding-bottom: ' . (absint($options['footer_position_height']) + 30) . 'px;}';
		}
	}
?>

<?php /* Change lightbox overlay */ ?>
<?php
	if ($options['fancybox_overlay_color'] == '') {
		if ($options['fancybox_overlay'] != 'light' || $options['fancybox_overlay_opacity'] != 30) {
			if ($options['fancybox_overlay'] == 'light' && $options['fancybox_overlay_opacity'] != 0) {
				echo '
					.fancybox-overlay {
						background-image: url(../../react/images/backgrounds/transparent/plain-light-' . absint($options['fancybox_overlay_opacity']) . '.png) !important;
					}
				';
			}
			elseif ($options['fancybox_overlay'] == 'dark' && $options['fancybox_overlay_opacity'] != 0) {
				echo '
				.fancybox-overlay {
					background-image: url(../../react/images/backgrounds/transparent/plain-dark-' . absint($options['fancybox_overlay_opacity']) . '.png) !important;
				}
				';
			}
			elseif ($options['fancybox_overlay_opacity'] == 0) {
				echo '
				.fancybox-overlay {
					background-image: none !important;
				}
				';
			}
		}
	} else {
		 echo '
			.fancybox-overlay {
				' . react_css_color($options['fancybox_overlay_color'], 'background') . '
			}
		';
	}
?>

<?php /* Change Background caption overlay */ ?>
<?php
	if ($options['background_caption_color'] == '') {
		if ($options['background_caption_overlay_opacity'] != 50) {
			if ($options['background_caption_overlay'] == 'dark' && $options['background_caption_overlay_opacity'] != 0) {
				echo '
					.fullscreen-caption h1, .serene-caption h1,
					.fullscreen-caption h2, .serene-caption h2,
					.fullscreen-caption h3, .serene-caption h3,
					.fullscreen-caption h4, .serene-caption h4,
					.fullscreen-caption h5, .serene-caption h5,
					.fullscreen-caption h6, .serene-caption h6,
					.fullscreen-caption p, .serene-caption p {
						background-image: url(../../react/images/backgrounds/transparent/plain-dark-' . absint($options['background_caption_overlay_opacity']) . '.png);
					}
				';
			}
			elseif ($options['background_caption_overlay'] == 'light' && $options['background_caption_overlay_opacity'] != 0) {
				echo '
				.fullscreen-caption h1, .serene-caption h1,
				.fullscreen-caption h2, .serene-caption h2,
				.fullscreen-caption h3, .serene-caption h3,
				.fullscreen-caption h4, .serene-caption h4,
				.fullscreen-caption h5, .serene-caption h5,
				.fullscreen-caption h6, .serene-caption h6,
				.fullscreen-caption p, .serene-caption p {
					background-image: url(../../react/images/backgrounds/transparent/plain-light-' . absint($options['background_caption_overlay_opacity']) . '.png);
					color: #000;
				}
				';
			}
			elseif ($options['background_caption_overlay_opacity'] == 0) {
				echo '
				.fullscreen-caption h1, .serene-caption h1,
				.fullscreen-caption h2, .serene-caption h2,
				.fullscreen-caption h3, .serene-caption h3,
				.fullscreen-caption h4, .serene-caption h4,
				.fullscreen-caption h5, .serene-caption h5,
				.fullscreen-caption h6, .serene-caption h6,
				.fullscreen-caption p, .serene-caption p {
					background-image: none;
				}
				';
			}
		}
	} else {
		 echo '
			.fullscreen-caption h1, .serene-caption h1,
			.fullscreen-caption h2, .serene-caption h2,
			.fullscreen-caption h3, .serene-caption h3,
			.fullscreen-caption h4, .serene-caption h4,
			.fullscreen-caption h5, .serene-caption h5,
			.fullscreen-caption h6, .serene-caption h6,
			.fullscreen-caption p, .serene-caption p {
				' . react_css_color($options['background_caption_color'], 'background') . '
			';
				if ($options['background_caption_overlay'] == 'light' ) {
					echo 'color: #000;';
				} else {
					echo 'color: #fff;';
				}
			echo '}';
	}
?>





<?php /* Page layouts - Mixed stretched elements */ ?>
<?php if ($options['component_slider_stretched']) {
		echo '
			body.pge-mxd .slider-wrap, body.pge-bxd .slider-wrap,
			body.pge-fld .slider-wrap, body.pge-bxd-cnt .slider-wrap {
				max-width: 100%;
			}';

	} else {
		if ($options['page_borders_lr']) {
			echo 'body.pge-mxd .slider-wrap, body.pge-bxd .slider-wrap {
				max-width: ' . (absint($options['page_layout_max_width']) - 2) . 'px;}
			';
		}
		else {
			echo 'body.pge-mxd .slider-wrap, body.pge-bxd .slider-wrap {
				max-width: ' . (absint($options['page_layout_max_width'])) . 'px;}
			';
		}

	}
?>

<?php /* Page layouts - Boxed widths */ ?>
<?php
if ($options['page_layout'] == 'pge-bxd') {

	echo '
	body.pge-bxd .header-all,
	body.pge-bxd .after-header-wrap,
	body.pge-bxd .top-and-pop,
	body.pge-bxd .footer-all {
		max-width: ' . absint($options['page_layout_max_width']) . 'px;
	}

	';
}
?>

<?php /* No footer widget and bottom space? */ ?>
<?php
if ($options['footer_widget_area_layout'] == '') {
	echo '
		.content-outer {
			border-bottom-width: 1px;
			border-bottom-style: solid;
		}
	';
}
?>


.tcs-block-outer.tcs-max-width .tcs-block-wrap, .sticky-header-pagewidth > div > div {width: <?php echo absint($options['page_layout_max_width']); ?>px; margin-left: auto; margin-right: auto;}
<?php
if ($options['page_layout'] == 'pge-bxd') {
		echo 'body.pge-bxd.ft-fix #subfooter {left: 50%; max-width: ' . absint($options['page_layout_max_width']) . 'px;}';
		echo 'body.pge-bxd.ft-fix #subfooter {margin-left: -' . (absint($options['page_layout_max_width']) / 2) . 'px;}';

		if ($options['page_layout_left_margin'] != -1) {
		echo 'body.pge-bxd.ft-fix.lft-mrg #subfooter {left: ' . absint($options['page_layout_left_margin']) . 'px; width: ' . absint($options['page_layout_max_width']) . 'px; max-width: 100%;}';
		echo 'body.pge-bxd.ft-fix.lft-mrg #subfooter {margin-left: 0;}';
		echo 'body.pge-bxd.ft-fix.lft-mrg .footer-all { max-width: ' . absint($options['page_layout_max_width']) . 'px;}';
		}
		if ($options['page_layout_right_margin'] != -1) {
		echo 'body.pge-bxd.ft-fix.rgt-mrg #subfooter {left: auto !important; width: ' . absint($options['page_layout_max_width']) . 'px; max-width: 100%;}';
		echo 'body.pge-bxd.ft-fix.rgt-mrg #subfooter {margin-right: ' . absint($options['page_layout_right_margin']) . 'px; margin-left: 0;}';
		echo 'body.pge-bxd.ft-fix.rgt-mrg .footer-all { max-width: ' . absint($options['page_layout_max_width']) . 'px;}';
		}
}
?>

<?php /*edited from here*/?>

<?php
if ($options['page_layout'] == 'pge-mxd' && !$options['page_layout_stretched_subfoot_boxed_content']) {
	   echo 'body.pge-mxd.strch-sf .footer-all .subfooter-inner { max-width: ' . absint($options['page_layout_max_width']) . 'px;
	   }';
	}
?>
<?php
if ($options['page_layout'] == 'pge-mxd' && !$options['page_layout_stretched_allfoot_boxed_content']) {
	   echo 'body.pge-mxd.strch-allft .footer-all .footer-inner { max-width: ' . absint($options['page_layout_max_width']) . 'px;}';
	}
?>
<?php
if ($options['page_layout'] == 'pge-mxd' && !$options['page_layout_stretched_top_boxed_content']) {
	   echo 'body.pge-mxd.strch-top .top-and-pop .tophead-inner, body.pge-mxd.strch-top .top-and-pop .popdown-inner, body.pge-mxd.strch-top .top-and-pop .trigger-inner { max-width: ' . absint($options['page_layout_max_width']) . 'px;
	   }';
	}
?>

<?php
if ($options['page_layout'] == 'pge-mxd' && !$options['page_layout_stretched_allheader_boxed_content']) {
	   echo 'body.pge-mxd.strch-allhd .header-all .header-inner, body.pge-mxd.strch-allhd .header-all .solonav-inner, body.pge-mxd.strch-allhd .top-and-pop .tophead-inner, body.pge-mxd.strch-allhd .top-and-pop .popdown-inner, body.pge-mxd.strch-allhd .top-and-pop .trigger-inner, body.pge-mxd.strch-allhd .header-all .im-box-inner { max-width: ' . absint($options['page_layout_max_width']) . 'px;
	   }';
	}
?>
<?php
	if ($options['page_layout'] == 'pge-mxd' && !$options['page_layout_stretched_allheader']) {
		echo 'body.pge-mxd .header-all { max-width: ' . absint($options['page_layout_max_width']) . 'px;}';
	};
?>
<?php
if ($options['page_layout'] == 'pge-mxd' && !$options['page_layout_stretched_allheader'] && !$options['page_layout_stretched_top']) {
		echo 'body.pge-mxd .header-all { max-width: ' . absint($options['page_layout_max_width']) . 'px;}';
		echo 'body.pge-mxd .top-and-pop  { max-width: ' . absint($options['page_layout_max_width']) . 'px;}';
	}
?>



<?php /*Adding content box in mixed*/?>
<?php
if ($options['page_layout'] == 'pge-mxd' && !$options['page_layout_stretched_content_boxed_content']) {
	   echo 'body.pge-mxd.strch-cnt .after-header-wrap .content-inner { max-width: ' . absint($options['page_layout_max_width']) . 'px;
	   }';
	}
?>
<?php
if ($options['page_layout'] == 'pge-mxd' && !$options['page_layout_stretched_content_boxed_intro']) {
	   echo 'body.pge-mxd.strch-cnt .after-header-wrap .intro-inner { max-width: ' . absint($options['page_layout_max_width']) . 'px;
	   }';
	}
?>
<?php
	if ($options['page_layout'] == 'pge-mxd' && !$options['page_layout_stretched_content']) {
		echo '
		body.pge-mxd .after-header-wrap {
			max-width: ' . absint($options['page_layout_max_width']) . 'px;
		}';
	};
?>



<?php /*edited to here*/?>



<?php
if ($options['page_layout'] == 'pge-mxd' && !$options['page_layout_stretched_allfoot']) {
	echo 'body.pge-mxd .footer-all .footer { max-width: ' . absint($options['page_layout_max_width']) . 'px;}';
	if ($options['page_layout_right_margin'] != -1) {
		echo 'body.pge-mxd.rgt-mrg .footer-all .footer, body.pge-mxd.rgt-mrg .footer-all #subfooter { margin-right: ' . absint($options['page_layout_right_margin']) . 'px;}';
	}
	if ($options['page_layout_left_margin'] != -1) {
		echo 'body.pge-mxd.lft-mrg .footer-all .footer, body.pge-mxd.lft-mrg .footer-all #subfooter { margin-left: ' . absint($options['page_layout_left_margin']) . 'px;}';
	}
}
?>
<?php
if ($options['page_layout'] == 'pge-mxd' && !$options['page_layout_stretched_subfoot'] && !$options['page_layout_stretched_allfoot']) {
		echo 'body.pge-mxd.ft-fix #subfooter {left: 50%; max-width: ' . absint($options['page_layout_max_width'] ) . 'px;}';
		echo 'body.pge-mxd.ft-fix #subfooter {margin-left: -' . (absint($options['page_layout_max_width']) / 2) . 'px;}';
		echo 'body.pge-mxd.rgt-mrg.strch-sf .footer-all #subfooter { margin-right: 0;}';

		echo 'body.pge-mxd .footer-all #subfooter { max-width: ' . absint($options['page_layout_max_width'] ) . 'px;}';

		echo 'body.pge-mxd.ft-fix.rgt-mrg #subfooter { margin-right: 0; left: auto;'; if ($options['page_layout_right_margin'] != -1) {  echo 'right: ' . absint($options['page_layout_right_margin']) . 'px; ';} echo ' width: ' . absint($options['page_layout_max_width']) . 'px; max-width: 100%;}';
		echo 'body.pge-mxd.ft-fix.rgt-mrg .footer-all { max-width: ' . absint($options['page_layout_max_width'] ) . 'px;}';

		echo 'body.pge-mxd.ft-fix.lft-mrg #subfooter {margin-left: 0;'; if ($options['page_layout_left_margin'] != -1) { echo ' left: ' . absint($options['page_layout_left_margin']) . 'px; ';} echo ' width: ' . absint($options['page_layout_max_width']) . 'px; max-width: 100%;}';
		echo 'body.pge-mxd.ft-fix.lft-mrg .footer-all { max-width: ' . absint($options['page_layout_max_width']) . 'px;}';

	}
?>
<?php
if ($options['page_layout'] == 'pge-mxd' && $options['page_layout_stretched_subfoot'] && !$options['page_layout_stretched_allfoot']) {
		echo 'body.pge-mxd.strch-sf .footer-all .footer { max-width: ' . absint($options['page_layout_max_width']) . 'px;}';
		echo 'body.pge-mxd.strch-sf .footer-all { max-width: auto; width: auto; margin-right: 0; margin-left: 0;}';
	}
?>
<?php /* Padding fixes default*/ ?>
<?php
	if ($options['page_layout_tophead_right_padding'] != 0) {
		echo '#tophead .tophead-wrap {padding-right: ' .  absint($options['page_layout_tophead_right_padding']) . 'px;}
				.dismissed #tophead .tophead-wrap {padding-right: 35px;}
		';

	}
?>
<?php
	if ($options['page_layout_header_right_padding'] != 0) {
		echo '#header .header-wrap {padding-right: ' .  absint($options['page_layout_header_right_padding']) . 'px;}
			.dismissed #header .header-wrap {padding-right: 0;}
		';
	}
?>
<?php
	if ($options['page_layout_subfoot_right_padding'] != 0) {
		echo '#subfooter .subfooter-wrap {padding-right: ' .  absint($options['page_layout_subfoot_right_padding']) . 'px;}';
	}
?>

<?php /* Featured image title margins */ ?>

div.post.post-image-type-right.has-post-video > h2.entry-title,
div.post.post-image-type-right.has-post-thumbnail > h2.entry-title {
	margin-right: <?php echo (absint($options['blog_featured_float_width']) + 20); ?>px;
}
div.post.post-image-type-left.has-post-video > h2.entry-title,
div.post.post-image-type-left.has-post-thumbnail > h2.entry-title {
	margin-left: <?php echo (absint($options['blog_featured_float_width']) + 20); ?>px;
}
div.portfolio.post-image-type-right.has-post-video > h2.entry-title,
div.portfolio.post-image-type-right.has-post-thumbnail > h2.entry-title {
	margin-right: <?php echo (absint($options['portfolio_featured_float_width']) + 20); ?>px;
}
div.portfolio.post-image-type-left.has-post-video > h2.entry-title,
div.portfolio.post-image-type-left.has-post-thumbnail > h2.entry-title {
	margin-left: <?php echo (absint($options['portfolio_featured_float_width']) + 20); ?>px;
}
div.page.post-image-type-right.has-post-video > h2.entry-title,
div.page.post-image-type-right.has-post-thumbnail > h2.entry-title {
	margin-right: <?php echo (absint($options['page_featured_float_width']) + 20); ?>px;
}
div.page.post-image-type-left.has-post-video > h2.entry-title,
div.page.post-image-type-left.has-post-thumbnail > h2.entry-title {
	margin-left: <?php echo (absint($options['page_featured_float_width']) + 20); ?>px;
}


@media only screen and (max-width: <?php echo (absint($options['blog_featured_float_width']) + 360); ?>px) {
	div.post.post-image-type-right.has-post-video > h2.entry-title,
	div.post.post-image-type-right.has-post-thumbnail > h2.entry-title,
	div.post.post-image-type-left.has-post-video > h2.entry-title,
	div.post.post-image-type-left.has-post-thumbnail > h2.entry-title {
		margin-right: 0;
		margin-left: 0;
	}
	div.post.post-image-type-right.has-post-video > .featured-image-right,
	div.post.post-image-type-right.has-post-thumbnail > .featured-image-right,
	div.post.post-image-type-left.has-post-video > .featured-image-left,
	div.post.post-image-type-left.has-post-thumbnail > .featured-image-left {
		float: none;
		margin: 0 0 10px 0;
		display: block;
	}

	div.post.post-image-type-right.has-post-video > .featured-image-right .featured-image-wrap,
	div.post.post-image-type-right.has-post-thumbnail > .featured-image-right .featured-image-wrap,
	div.post.post-image-type-left.has-post-video > .featured-image-left .featured-image-wrap,
	div.post.post-image-type-left.has-post-thumbnail > .featured-image-left .featured-image-wrap,

	div.post.post-image-type-right.has-post-video > .featured-image-right .featured-image-wrap img,
	div.post.post-image-type-right.has-post-thumbnail > .featured-image-right .featured-image-wrap img,
	div.post.post-image-type-left.has-post-video > .featured-image-left .featured-image-wrap img,
	div.post.post-image-type-left.has-post-thumbnail > .featured-image-left .featured-image-wrap img {
		width: 100% !important;
	}
}

@media only screen and (max-width: <?php echo (absint($options['blog_single_featured_float_width']) + 360); ?>px) {
	.single div.post.post-image-type-right.has-post-video #content > .featured-image-right,
	.single div.post.post-image-type-right.has-post-thumbnail #content > .featured-image-right,
	.single div.post.post-image-type-left.has-post-video #content > .featured-image-left,
	.single div.post.post-image-type-left.has-post-thumbnail #content > .featured-image-left {
		float: none;
		margin: 0 0 15px 0;
		display: block;
	}
	.single div.post.post-image-type-right.has-post-video #content > .featured-image-right .featured-image-wrap,
	.single div.post.post-image-type-right.has-post-thumbnail #content > .featured-image-right .featured-image-wrap,
	.single div.post.post-image-type-left.has-post-video #content > .featured-image-left .featured-image-wrap,
	.single div.post.post-image-type-left.has-post-thumbnail #content > .featured-image-left .featured-image-wrap,

	.single div.post.post-image-type-right.has-post-video #content > .featured-image-right .featured-image-wrap img,
	.single div.post.post-image-type-right.has-post-thumbnail #content > .featured-image-right .featured-image-wrap img,
	.single div.post.post-image-type-left.has-post-video #content > .featured-image-left .featured-image-wrap img,
	.single div.post.post-image-type-left.has-post-thumbnail #content > .featured-image-left .featured-image-wrap img {
		width: 100% !important;
	}
}


@media only screen and (max-width: <?php echo (absint($options['portfolio_featured_float_width']) + 360); ?>px) {
	div.portfolio.post-image-type-right.has-post-video > h2.entry-title,
	div.portfolio.post-image-type-right.has-post-thumbnail > h2.entry-title,
	div.portfolio.post-image-type-left.has-post-video > h2.entry-title,
	div.portfolio.post-image-type-left.has-post-thumbnail > h2.entry-title {
		margin-right: 0;
		margin-left: 0;
	}
	div.portfolio.post-image-type-right.has-post-video > .featured-image-right,
	div.portfolio.post-image-type-right.has-post-thumbnail > .featured-image-right,
	div.portfolio.post-image-type-left.has-post-video > .featured-image-left,
	div.portfolio.post-image-type-left.has-post-thumbnail > .featured-image-left {
		float: none;
		margin: 0 0 10px 0;
		display: block;
	}

	div.portfolio.post-image-type-right.has-post-video > .featured-image-right .featured-image-wrap,
	div.portfolio.post-image-type-right.has-post-thumbnail > .featured-image-right .featured-image-wrap,
	div.portfolio.post-image-type-left.has-post-video > .featured-image-left .featured-image-wrap,
	div.portfolio.post-image-type-left.has-post-thumbnail > .featured-image-left .featured-image-wrap,

	div.portfolio.post-image-type-right.has-post-video > .featured-image-right .featured-image-wrap img,
	div.portfolio.post-image-type-right.has-post-thumbnail > .featured-image-right .featured-image-wrap img,
	div.portfolio.post-image-type-left.has-post-video > .featured-image-left .featured-image-wrap img,
	div.portfolio.post-image-type-left.has-post-thumbnail > .featured-image-left .featured-image-wrap img {
		width: 100% !important;
	}
}

@media only screen and (max-width: <?php echo (absint($options['portfolio_single_featured_float_width'] + 360)); ?>px) {
	.single div.portfolio.post-image-type-right.has-post-video #content > .featured-image-right,
	.single div.portfolio.post-image-type-right.has-post-thumbnail #content > .featured-image-right,
	.single div.portfolio.post-image-type-left.has-post-video #content > .featured-image-left,
	.single div.portfolio.post-image-type-left.has-post-thumbnail #content > .featured-image-left {
		float: none;
		margin: 0 0 15px 0;
		display: block;
	}
	.single div.portfolio.post-image-type-right.has-post-video #content > .featured-image-right .featured-image-wrap,
	.single div.portfolio.post-image-type-right.has-post-thumbnail #content > .featured-image-right .featured-image-wrap,
	.single div.portfolio.post-image-type-left.has-post-video #content > .featured-image-left .featured-image-wrap,
	.single div.portfolio.post-image-type-left.has-post-thumbnail #content > .featured-image-left .featured-image-wrap,

	.single div.portfolio.post-image-type-right.has-post-video #content > .featured-image-right .featured-image-wrap img,
	.single div.portfolio.post-image-type-right.has-post-thumbnail #content > .featured-image-right .featured-image-wrap img,
	.single div.portfolio.post-image-type-left.has-post-video #content > .featured-image-left .featured-image-wrap img,
	.single div.portfolio.post-image-type-left.has-post-thumbnail #content > .featured-image-left .featured-image-wrap img {
		width: 100% !important;
	}
}

@media only screen and (max-width: <?php echo (absint($options['page_featured_float_width'] + 360)); ?>px) {
	div.page.post-image-type-right.has-post-video > h2.entry-title,
	div.page.post-image-type-right.has-post-thumbnail > h2.entry-title,
	div.page.post-image-type-left.has-post-video > h2.entry-title,
	div.page.post-image-type-left.has-post-thumbnail > h2.entry-title {
		margin-right: 0;
		margin-left: 0;
	}
	div.page.post-image-type-right.has-post-video > .featured-image-right,
	div.page.post-image-type-right.has-post-thumbnail > .featured-image-right,
	div.page.post-image-type-left.has-post-video > .featured-image-left,
	div.page.post-image-type-left.has-post-thumbnail > .featured-image-left {
		float: none;
		margin: 0 0 10px 0;
		display: block;
	}

	div.page.post-image-type-right.has-post-video > .featured-image-right .featured-image-wrap,
	div.page.post-image-type-right.has-post-thumbnail > .featured-image-right .featured-image-wrap,
	div.page.post-image-type-left.has-post-video > .featured-image-left .featured-image-wrap,
	div.page.post-image-type-left.has-post-thumbnail > .featured-image-left .featured-image-wrap,

	div.page.post-image-type-right.has-post-video > .featured-image-right .featured-image-wrap img,
	div.page.post-image-type-right.has-post-thumbnail > .featured-image-right .featured-image-wrap img,
	div.page.post-image-type-left.has-post-video > .featured-image-left .featured-image-wrap img,
	div.page.post-image-type-left.has-post-thumbnail > .featured-image-left .featured-image-wrap img {
		width: 100% !important;
	}
}

@media only screen and (max-width: <?php echo (absint($options['page_single_featured_float_width'] + 360)); ?>px) {
	.single div.page.post-image-type-right.has-post-video #content > .featured-image-right,
	.single div.page.post-image-type-right.has-post-thumbnail #content > .featured-image-right,
	.single div.page.post-image-type-left.has-post-video #content > .featured-image-left,
	.single div.page.post-image-type-left.has-post-thumbnail #content > .featured-image-left {
		float: none;
		margin: 0 0 15px 0;
		display: block;
	}
	.single div.page.post-image-type-right.has-post-video #content > .featured-image-right .featured-image-wrap,
	.single div.page.post-image-type-right.has-post-thumbnail #content > .featured-image-right .featured-image-wrap,
	.single div.page.post-image-type-left.has-post-video #content > .featured-image-left .featured-image-wrap,
	.single div.page.post-image-type-left.has-post-thumbnail #content > .featured-image-left .featured-image-wrap,

	.single div.page.post-image-type-right.has-post-video #content > .featured-image-right .featured-image-wrap img,
	.single div.page.post-image-type-right.has-post-thumbnail #content > .featured-image-right .featured-image-wrap img,
	.single div.page.post-image-type-left.has-post-video #content > .featured-image-left .featured-image-wrap img,
	.single div.page.post-image-type-left.has-post-thumbnail #content > .featured-image-left .featured-image-wrap img {
		width: 100% !important;
	}
}

<?php /* Featured image device sizes */ ?>
<?php
	/* Blog posts */
		if ($options['blog_single_featured_height_tablet'] > 0) {
			echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {
				.single-post .post-image-type-full #content > .featured-image-helper .featured-image-wrap {
					height: auto !important;
					max-height: ' . absint($options['blog_single_featured_height_tablet']) . 'px;
				}
			}';
		}

		if ($options['blog_single_featured_height_phone'] > 0) {
			echo '@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
				.single-post .post-image-type-full #content > .featured-image-helper .featured-image-wrap {
					height: auto !important;
					max-height: ' . absint($options['blog_single_featured_height_phone']) . 'px;
				}
			}';
		}

		if ($options['blog_featured_height_tablet'] > 0) {
			echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {
				.archive #content .type-post.post-image-type-below .featured-image-wrap,
				.archive #content .type-post.post-image-type-above .featured-image-wrap,
				.blog #content .type-post.post-image-type-below .featured-image-wrap,
				.blog #content .type-post.post-image-type-above .featured-image-wrap,
				.search-results #content .type-post.post-image-type-below .featured-image-wrap,
				.search-results #content .type-post.post-image-type-above .featured-image-wrap {
					height: auto !important;
					max-height: ' . absint($options['blog_featured_height_tablet']) . 'px;
				}
			}';
		}

		if ($options['blog_featured_height_phone'] > 0) {
			echo '@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
				.archive #content .type-post.post-image-type-below .featured-image-wrap,
				.archive #content .type-post.post-image-type-above .featured-image-wrap,
				.blog #content .type-post.post-image-type-below .featured-image-wrap,
				.blog #content .type-post.post-image-type-above .featured-image-wrap,
				.search-results #content .type-post.post-image-type-below .featured-image-wrap,
				.search-results #content .type-post.post-image-type-above .featured-image-wrap {
					height: auto !important;
					max-height: ' . absint($options['blog_featured_height_phone']) . 'px;
				}
			}';
		}

	/* Pages */
		if ($options['page_single_featured_height_tablet'] > 0) {
			echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {
				body.page .post-image-type-full #content > .featured-image-helper .featured-image-wrap {
					height: auto !important;
					max-height: ' . absint($options['page_single_featured_height_tablet']) . 'px;
				}
			}';
		}

		if ($options['page_single_featured_height_phone'] > 0) {
			echo '@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
				body.page .post-image-type-full #content > .featured-image-helper .featured-image-wrap {
					height: auto !important;
					max-height: ' . absint($options['page_single_featured_height_phone']) . 'px;
				}
			}';
		}

		if ($options['page_featured_height_tablet'] > 0) {
			echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {
				.archive #content .type-page.post-image-type-below .featured-image-wrap,
				.archive #content .type-page.post-image-type-above .featured-image-wrap,
				.blog #content .type-page.post-image-type-below .featured-image-wrap,
				.blog #content .type-page.post-image-type-above .featured-image-wrap,
				.search-results #content .type-page.post-image-type-below .featured-image-wrap,
				.search-results #content .type-page.post-image-type-above .featured-image-wrap {
					height: auto !important;
					max-height: ' . absint($options['page_featured_height_tablet']) . 'px;
				}
			}';
		}

		if ($options['page_featured_height_phone'] > 0) {
			echo '@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
				.archive #content .type-page.post-image-type-below .featured-image-wrap,
				.archive #content .type-page.post-image-type-above .featured-image-wrap,
				.blog #content .type-page.post-image-type-below .featured-image-wrap,
				.blog #content .type-page.post-image-type-above .featured-image-wrap,
				.search-results #content .type-page.post-image-type-below .featured-image-wrap,
				.search-results #content .type-page.post-image-type-above .featured-image-wrap {
					height: auto !important;
					max-height: ' . absint($options['page_featured_height_phone']) . 'px;
				}
			}';
		}

	/* Portfolio */
		if ($options['portfolio_single_featured_height_tablet'] > 0) {
			echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {
				.single-portfolio .post-image-type-full #content > .featured-image-helper .featured-image-wrap {
					height: auto !important;
					max-height: ' . absint($options['portfolio_single_featured_height_tablet']) . 'px;
				}
			}';
		}

		if ($options['portfolio_single_featured_height_phone'] > 0) {
			echo '@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
				.single-portfolio .post-image-type-full #content > .featured-image-helper .featured-image-wrap {
					height: auto !important;
					max-height: ' . absint($options['portfolio_single_featured_height_phone']) . 'px;
				}
			}';
		}
		if ($options['portfolio_featured_height_tablet'] > 0) {
			echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {
				.archive #content .type-portfolio.post-image-type-below .featured-image-wrap,
				.archive #content .type-portfolio.post-image-type-above .featured-image-wrap,
				.blog #content .type-portfolio.post-image-type-below .featured-image-wrap,
				.blog #content .type-portfolio.post-image-type-above .featured-image-wrap,
				.search-results #content .type-portfolio.post-image-type-below .featured-image-wrap,
				.search-results #content .type-portfolio.post-image-type-above .featured-image-wrap {
					height: auto !important;
					max-height: ' . absint($options['portfolio_featured_height_tablet']) . 'px;
				}
			}';
		}

		if ($options['portfolio_featured_height_phone'] > 0) {
			echo '@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) {
				.archive #content .type-portfolio.post-image-type-below .featured-image-wrap,
				.archive #content .type-portfolio.post-image-type-above .featured-image-wrap,
				.blog #content .type-portfolio.post-image-type-below .featured-image-wrap,
				.blog #content .type-portfolio.post-image-type-above .featured-image-wrap,
				.search-results #content .type-portfolio.post-image-type-below .featured-image-wrap,
				.search-results #content .type-portfolio.post-image-type-above .featured-image-wrap {
					height: auto !important;
					max-height: ' . absint($options['portfolio_featured_height_phone']) . 'px;
				}
			}';
		}
?>

<?php /* Page layouts - Boxed content*/ ?>

<?php
if ($options['page_layout'] == 'pge-bxd-cnt') {
	echo '
	body.pge-bxd-cnt .header-inner,
	body.pge-bxd-cnt .tophead-inner,
	body.pge-bxd-cnt .content-inner,
	body.pge-bxd-cnt .intro-inner,
	body.pge-bxd-cnt .subfooter-inner,
	body.pge-bxd-cnt .footer-inner,
	body.pge-bxd-cnt .solonav-inner,
	body.pge-bxd-cnt .popdown-inner,
	body.pge-bxd-cnt .trigger-inner {
		max-width: ' . absint($options['page_layout_max_width']) .'px;
		margin-left: auto;
		margin-right: auto;
	}
	';
}
?>
<?php /* Page layouts - Left / right margins */ ?>
<?php
	$boxWidth = $options['page_layout_max_width'];
		if ($options['page_layout_left_margin'] > 0) {
			$boxWidth += $options['page_layout_left_margin'];
		}
		if ($options['page_layout_right_margin'] > 0) {
			$boxWidth += $options['page_layout_right_margin'];
		}

	if ($boxWidth < absint($tabletLdsp)) {
			$boxWidthTab = $options['page_layout_max_width'];
		if ($options['page_layout_left_margin_tablets'] > 0) {
			$boxWidthTab += $options['page_layout_left_margin_tablets'];
		} elseif ($options['page_layout_left_margin_tablets'] == -1) {
			$boxWidthTab += $options['page_layout_left_margin'];
		}
		if ($options['page_layout_right_margin_tablets'] > 0) {
			$boxWidthTab += $options['page_layout_right_margin_tablets'];
		} elseif ($options['page_layout_right_margin_tablets'] == -1) {
			$boxWidthTab += $options['page_layout_right_margin'];
		}
	} else {
		$boxWidthTab = $boxWidth;
	}

?>

<?php
if ($options['page_layout_left_margin'] > -1) {
		if ($boxWidth >= absint($tabletLdsp) && $options['page_layout_left_margin_box_only'] == 1) {
			echo '@media only screen and (min-width: ' . (absint($tabletLdsp) + 1) . 'px) and (max-width:  ' . (absint($boxWidth) + 2) . 'px) {
			';
		}

		echo 'body.pge-bxd .slider-wrap, body.pge-mxd .slider-wrap, body.pge-bxd .after-header-wrap, body.pge-bxd .footer-all, body.pge-bxd .top-and-pop, body.pge-bxd .header-all,
		body.pge-fld .after-header-wrap, body.pge-fld .footer-all, body.pge-fld .top-and-pop, body.pge-fld .header-all, body.pge-fld .slider-wrap,
		body.pge-bxd-cnt .after-header-wrap, body.pge-bxd-cnt .footer-all, body.pge-bxd-cnt .top-and-pop, body.pge-bxd-cnt .header-all, body.pge-bxd-cnt .slider-wrap,
		body.pge-mxd .after-header-wrap, body.pge-mxd .top-and-pop, body.pge-mxd .header-all, body.pge-mxd .footer-all,
		body.pge-mxd.strch-top .popdown-inner, body.pge-mxd.strch-top .trigger-inner, body.pge-mxd.strch-top .tophead-inner,
		body.pge-mxd.strch-allhd .popdown-inner, body.pge-mxd.strch-allhd .trigger-inner, body.pge-mxd.strch-allhd .tophead-inner, body.pge-mxd.strch-allhd .header-inner, body.pge-mxd.strch-allhd .solonav-inner,
		body.pge-mxd.strch-sf .footer-all .subfooter-inner, body.pge-mxd.strch-sf .footer-all .footer, body.pge-mxd.strch-allft .footer-all .subfooter-inner, body.pge-mxd.strch-allft .footer-all .footer-inner,
		body.pge-mxd.strch-cnt .after-header-wrap .intro-inner, body.pge-mxd.strch-cnt .after-header-wrap .content-inner { margin-left: ' . absint($options['page_layout_left_margin']) . 'px;}
		body.pge-mxd.strch-cnt .after-header-wrap, body.pge-mxd.strch-top .top-and-pop, body.pge-mxd.strch-allhd .top-and-pop, body.pge-mxd.strch-allhd .header-all, body.pge-mxd.strch-allft .footer-all .footer, body.pge-mxd.strch-allft #subfooter, body.pge-mxd.strch-allft .footer-all, body.pge-mxd.strch-sf #subfooter, body.pge-mxd.strch-sf .footer-all, body.pge-mxd #popdown-trigger .trigger-inner, body.pge-mxd .footer-all .footer, body.pge-mxd .footer-all #subfooter { margin-left: 0;}';

		if ($boxWidth >= absint($tabletLdsp) && $options['page_layout_left_margin_box_only'] == 1) {
			echo '}';
		}

	}

?>
<?php
if ($options['page_layout_right_margin'] > -1) {
		if ($boxWidth >= absint($tabletLdsp) && $options['page_layout_right_margin_box_only'] == 1) {
			echo '@media only screen and (min-width: ' . (absint($tabletLdsp) + 1) . 'px) and (max-width:  ' . (absint($boxWidth) + 2) . 'px) {
			';
		}
		echo 'body.pge-bxd .slider-wrap, body.pge-mxd .slider-wrap, body.pge-bxd .after-header-wrap, body.pge-bxd .footer-all, body.pge-bxd .top-and-pop, body.pge-bxd .header-all,
		body.pge-fld .after-header-wrap, body.pge-fld .footer-all, body.pge-fld .top-and-pop, body.pge-fld .header-all, body.pge-fld .slider-wrap,
		body.pge-bxd-cnt .after-header-wrap, body.pge-bxd-cnt .footer-all, body.pge-bxd-cnt .top-and-pop, body.pge-bxd-cnt .header-all, body.pge-bxd-cnt .slider-wrap,
		body.pge-mxd .after-header-wrap, body.pge-mxd .top-and-pop, body.pge-mxd .header-all, body.pge-mxd .footer-all,
		body.pge-mxd.strch-top .popdown-inner, body.pge-mxd.strch-top .trigger-inner, body.pge-mxd.strch-top .tophead-inner,
		body.pge-mxd.strch-allhd .popdown-inner, body.pge-mxd.strch-allhd .trigger-inner, body.pge-mxd.strch-allhd .tophead-inner, body.pge-mxd.strch-allhd .header-inner, body.pge-mxd.strch-allhd .solonav-inner,
		body.pge-mxd.strch-sf .footer-all .subfooter-inner, body.pge-mxd.strch-sf .footer-all .footer, body.pge-mxd.strch-allft .footer-all .subfooter-inner, body.pge-mxd.strch-allft .footer-all .footer-inner,
		body.pge-mxd.strch-cnt .after-header-wrap .intro-inner, body.pge-mxd.strch-cnt .after-header-wrap .content-inner { margin-right: ' . absint($options['page_layout_right_margin']) . 'px;}
		body.pge-mxd.strch-cnt .after-header-wrap, body.pge-mxd.strch-top .top-and-pop, body.pge-mxd.strch-allhd .top-and-pop, body.pge-mxd.strch-allhd .header-all, body.pge-mxd.strch-allft .footer-all .footer, body.pge-mxd.strch-allft #subfooter, body.pge-mxd.strch-allft .footer-all, body.pge-mxd.strch-sf #subfooter, body.pge-mxd.strch-sf .footer-all, body.pge-mxd.strch-sf .footer-all, body.pge-mxd #popdown-trigger .trigger-inner, body.pge-mxd .footer-all .footer, body.pge-mxd .footer-all #subfooter { margin-right: 0;}';
	}

	if ($boxWidth >= absint($tabletLdsp) && $options['page_layout_right_margin_box_only'] == 1) {
		echo '}';
	}
?>
<?php
if ($options['page_layout_sections_margin'] > 0) {
		echo '.after-header-wrap { margin-bottom: ' . absint($options['page_layout_sections_margin']) . 'px; margin-top: ' . absint($options['page_layout_sections_margin']) . 'px;} .slider-wrap {margin-top: ' . absint($options['page_layout_sections_margin']) . 'px;} ' ;
	}
?>

<?php /* Converts Points - Social couters */ ?>
<?php
	if ($options['social_count_convert'] != 'never') {
		if ($options['social_count_convert'] == 'box-width') {
			echo '@media only screen and (max-width: ' . absint($convertBoxWidth) . 'px) {';
		}
		elseif ($options['social_count_convert'] == 'phone-ptr') {
			echo '@media only screen and (max-width:' . absint($phonePtr) . 'px) {';
		}
		elseif ($options['social_count_convert'] == 'phone-ldsp') {
			echo '@media only screen and (max-width:' . absint($phoneLdsp) . 'px) {';
		}
		elseif ($options['social_count_convert'] == 'tablet-ptr') {
			echo '@media only screen and (max-width: ' . absint($tabletPtr) . 'px) {';
		}
		elseif ($options['social_count_convert'] == 'tablet-ldsp') {
			echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {';
		}
		elseif ($options['social_count_convert'] == 'custom') {
			echo '@media only screen and (max-width: ' . absint($options['social_count_convert_custom']) . 'px) {';
		}

		echo '
		ul.socialcount {
			min-height: 90px;
		}
		ul.socialcount li a span.count,
		ul.socialcount li a span.count-value,
		ul.socialcount li a span.social-icon,
		ul.socialcount li a span.network {
			padding: 0 !important;
			display: block;
			text-align: center;
			float: none !important;
		}
		ul.socialcount li, .ungrpd ul.socialcount li {
			width: 48%;
			margin: 1%;
			float: left;
		}
		ul.socialcount li:nth-child(3), .ungrpd ul.socialcount li:nth-child(3) {
			clear: left;
		}
		ul.socialcount li a, .ungrpd ul.socialcount li a {
			padding: 15px 20px;
			display: block;
		}
		ul.socialcount li a span.count {
			line-height: 27px;
			font-size: 13px;
			width: 42px;
			margin: 7px auto 3px;
		}

		}';
	}
?>
<?php /* Convert Points - SubFooter */ ?>
<?php
	if ($options['footer_position'] == 'fixed' && $options['footer_convert'] != 'never') {
		echo react_get_convert_media_query($options['footer_convert'], $options['footer_convert_custom'], 'min-width');
		if ($options['footer_position'] == 'fixed') {
			echo '
			body.ft-fix .footer-all #subfooter,
			body.ft-fix .footer-all #subfooter > div,
			body.ft-fix .footer-all #subfooter > div > div {
				border-radius: 0 !important;
			}';
		 echo '}';
		}
	}
?>






<?php
	if ($options['footer_position'] == 'fixed' && $options['footer_convert'] != 'never') {
		echo react_get_convert_media_query($options['footer_convert'], $options['footer_convert_custom'], 'max-width');
		if ($options['show_subfooter_desktop'] == '1' || $options['show_subfooter_phone'] == '1' || $options['show_subfooter_tablet'] == '1' || $options['show_subfooter_large'] == '1') {
			if ($options['footer_position'] == 'fixed' && $options['footer_widget_area_layout'] == '') {
				echo '.content-inner {padding-bottom: 0;}';
			}
			elseif ($options['footer_position'] == 'fixed' && $options['footer_widget_area_layout'] != '') {
				echo '.content-inner {padding-bottom: 40px;} .footer-wrap {padding-bottom: 40px;}';
			}
		}

		echo '
			body.pge-mxd.strch-sf .footer-all #subfooter {
				border-radius: 0px!important;
			}

			body.ft-fix.pge-bxd #subfooter,
			body.ft-fix.pge-mxd #subfooter,
			body.ft-fix.pge-bxd-cnt #subfooter,
			body.ft-fix.pge-fld #subfooter,
			body.ft-fix #subfooter
			{position: relative !important; bottom: auto!important; left: auto!important; margin-left: auto; width: auto;}

			footer.footer-all {margin-bottom:0;}

			body.pge-bxd.ft-fix.b-mrg .footer-all #subfooter,
			body.pge-mxd.ft-fix.b-mrg .footer-all #subfooter {
				border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
				border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}

			body.pge-fld.ft-fix.b-mrg.lft-mrg .footer-all #subfooter,
			body.pge-bxd-cnt.ft-fix.b-mrg.lft-mrg  .footer-all #subfooter {
				border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}
			body.pge-fld.ft-fix.b-mrg.rgt-mrg .footer-all #subfooter,
			body.pge-bxd-cnt.ft-fix.b-mrg.rgt-mrg .footer-all #subfooter {
				border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}
		';
		if ($options['footer_widget_area_layout'] == '') {
			echo '
			body.pge-bxd.ft-fix.v-space .footer-all #subfooter,
			body.pge-mxd.ft-fix.v-space .footer-all #subfooter {
				border-top-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
				border-top-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}

			body.pge-fld.ft-fix.v-space.lft-mrg .footer-all #subfooter,
			body.pge-bxd-cnt.ft-fix.v-space.lft-mrg  .footer-all #subfooter {
				border-top-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}
			body.pge-fld.ft-fix.v-space.rgt-mrg .footer-all #subfooter,
			body.pge-bxd-cnt.ft-fix.v-space.rgt-mrg .footer-all #subfooter {
				border-top-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}
			';
		}
		elseif ($options['footer_widget_area_layout'] != '') {
			echo '
			body.pge-fld.ft-fix.b-mrg .footer-all .footer,
			body.pge-bxd-cnt.ft-fix.b-mrg .footer-all .footer {
				border-bottom-right-radius: 0px!important;
				border-bottom-left-radius: 0px!important;
			}
			';
		}
		echo '
			body.pge-mxd.ft-fix.b-mrg .footer-all .footer,
			body.pge-bxd.ft-fix.b-mrg .footer-all .footer,
			body.pge-mxd.ft-fix.b-mrg.strch-sf .footer-all #subfooter {
				border-bottom-right-radius: 0px!important;
				border-bottom-left-radius: 0px!important;
			}
		}';
	}
?>

<?php /* Converts Points - Popdown trigger */ ?>
<?php
	if ($options['pop_down_trigger_absolute'] && $options['pop_down_trigger_convert'] != 'never') {
		if ($options['pop_down_trigger_absolute'] && $options['pop_down_trigger_convert'] == 'box-width') {
			echo '@media only screen and (max-width: ' . absint($options['page_layout_max_width'] + $options['page_layout_left_margin_tablets'] + $options['page_layout_right_margin_tablets']) . 'px) {';
		}
		elseif ($options['pop_down_trigger_absolute'] && $options['pop_down_trigger_convert'] == 'phone-ptr') {
			echo '@media only screen and (max-width:' . absint($phonePtr) . 'px) {';
		}
		elseif ($options['pop_down_trigger_absolute'] && $options['pop_down_trigger_convert'] == 'phone-ldsp') {
			echo '@media only screen and (max-width:' . absint($phoneLdsp) . 'px) {';
		}
		elseif ($options['pop_down_trigger_absolute'] && $options['pop_down_trigger_convert'] == 'tablet-ptr') {
			echo '@media only screen and (max-width: ' . absint($tabletPtr) . 'px) {';
		}
		elseif ($options['pop_down_trigger_absolute'] && $options['pop_down_trigger_convert'] == 'tablet-ldsp') {
			echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {';
		}
		elseif ($options['pop_down_trigger_absolute'] && $options['pop_down_trigger_convert'] == 'custom') {
			echo '@media only screen and (max-width: ' . absint($options['pop_down_trigger_convert_custom']) . 'px) {';
		}
		echo '
			body.pop-trig-abso #popdown-trigger {
				position: relative;
				margin-top: 0 !important;
				top: 0;
				z-index: 10;
				';
				if ($rtl) {
					echo 'left: 0;';
				} else {
					echo 'right: 0;';
				}
				echo '
				width: 100%;
				min-width: 0;
				max-width: none;
				padding-left: 0;
				padding-right: 0;
				border-radius: 0 !important;
			}
			body.pop-trig-abso #popdown-trigger h3 {
				padding: 5px 0px;
			}
			body.pop-trig-abso #popdown-trigger a.popdown-close {right: 15px; top: 3px;}
			body.pop-trig-abso #popdown-trigger a.popdown-close > span.x-close {font-size: 15px;}
			body.pop-trig-abso #popdown-trigger .trigger-inner {padding-left: 20px; padding-right: 20px;}
			body.pop-trig-abso .top-and-pop {
				-webkit-transition: all 0.2s linear;
				-moz-transition: all 0.2s linear;
				-o-transition: all 0.2s linear;
				transition: all 0.2s linear;
			}
			body.pop-trig-abso .top-and-pop.dismissed {padding-top: 0;}
			body.pop-trig-abso .top-and-pop.dismissed .popdown {margin-top: 0;}
			body.pop-trig-abso .dismissed #popdown-trigger .trigger-inner {padding: 0;}
			body.pop-trig-abso .dismissed #popdown-trigger {
			position: absolute;
			top: 0;

			';
			if ($rtl) {
				echo 'left: 10px;';
			} else {
				echo 'right: 10px;';
			}
			echo '

			width: auto;
			height: 15px;
			padding: 0!important;
			border-bottom-left-radius: ' . absint($options['element_rounded_corners']) . 'px !important;
			border-bottom-right-radius: ' . absint($options['element_rounded_corners']) . 'px !important;
		}

		}';
	}
?>
<?php /* Converts Points - MainNav TODO - Don't hide solo nav if it's not being used? */ ?>
<?php
if ($options['nav_convert'] != 'never') {
	if ($options['nav_convert'] != 'always') {
		if ($options['nav_convert'] == 'box-width') {
			echo '@media only screen and (max-width: ' . absint($convertBoxWidth) . 'px) {';
		}
		elseif ($options['nav_convert'] == 'phone-ptr') {
			echo '@media only screen and (max-width:' . absint($phonePtr) . 'px) {';
		}
		elseif ($options['nav_convert'] == 'phone-ldsp') {
			echo '@media only screen and (max-width:' . absint($phoneLdsp) . 'px) {';
		}
		elseif ($options['nav_convert'] == 'tablet-ptr') {
			echo '@media only screen and (max-width: ' . absint($tabletPtr) . 'px) {';
		}
		elseif ($options['nav_convert'] == 'tablet-ldsp') {
			echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {';
		}
		elseif ($options['nav_convert'] == 'custom') {
			echo '@media only screen and (max-width: ' . absint($options['nav_convert_custom']) . 'px) {';
		}
	}

	echo '.device-menu-trigger-wrap {display: block;}
		#header .react-menu {display: none !important;}
		body.v-space.pge-bxd #header, body.v-space.pge-mxd #header {
			border-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}
		#nav-wrap {padding-left:0; padding-right:0;}
		#nav-wrap .back-home-icon {margin-top: 0;}
		#nav-wrap .back-home-icon a.back-home {
			height: 45px;
			line-height: 33px;
			padding: 10px;
			width: 45px;
		}
		#nav-wrap .back-home-icon a.back-home span {vertical-align: initial;}
		#solonav, #solonav .back-home-icon, #solonav .search-container, #solonav .react-menu { display: none !important; }
		';
		if ($options['nav_convert'] != 'always') {echo '}';}
}
?>





<?php /* Subfoot */ ?>
<?php
if ($options['subfoot_convert'] != 'never') {
	if ($options['subfoot_convert'] != 'always') {
		if ($options['subfoot_convert'] == 'box-width') {
			echo '@media only screen and (max-width: ' . absint($convertBoxWidth) . 'px) {';
		}
		elseif ($options['subfoot_convert'] == 'phone-ptr') {
			echo '@media only screen and (max-width:' . absint($phonePtr) . 'px) {';
		}
		elseif ($options['subfoot_convert'] == 'phone-ldsp') {
			echo '@media only screen and (max-width:' . absint($phoneLdsp) . 'px) {';
		}
		elseif ($options['subfoot_convert'] == 'tablet-ptr') {
			echo '@media only screen and (max-width: ' . absint($tabletPtr) . 'px) {';
		}
		elseif ($options['subfoot_convert'] == 'tablet-ldsp') {
			echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {';
		}
		elseif ($options['subfoot_convert'] == 'custom') {
			echo '@media only screen and (max-width: ' . absint($options['subfoot_convert_custom']) . 'px) {';
		}
	}

	echo '
	.subfooter-wrap {
		text-align: center;
	}
	.subfooter-wrap > div, .subfooter-wrap .social-icon-outer,
	.ft-rtl .subfooter-wrap > div, .ft-rtl .subfooter-wrap .social-icon-outer {
		float: none;
		display: block;
		padding-top: 10px;
		padding-bottom: 10px;
	}
	#footer-logo-info-wrap:after,
	.ft-rtl #footer-logo-info-wrap:after  {
		left: 50%;
		right: auto;
		margin-left: -7px;
	}
	.subfooter-wrap #audio-controls, .subfooter-wrap #video-controls, .subfooter-wrap #fs-controls {
		margin: 3px 15px;
		display: inline-block;
		float: none;
	}
	body.page-template-template-fullscreen-media-php .footer-all, body.page-template-template-note-block-php .footer-all {
		position: relative !important;
	}
	.left-intro-box-page {
		padding-bottom: 0;
	}
	#footer-logo-info-wrap {
		left: 50%;
		right: 0;
		margin-left: -230px;
		width: 100%;
		max-width: 460px;
	}

	';
		if ($options['subfoot_convert'] != 'always') {echo '}';}
}
?>




@media only screen and (max-width: 500px) {

	#footer-logo-info-wrap {
		margin-left: -110px;
		width: 100%;
		max-width: 220px;
	}

}






<?php /* Converts Points - TopNav */ ?>
<?php
if ($options['top_nav_convert'] != 'never') {
	if ($options['top_nav_convert'] != 'always') {
		if ($options['top_nav_convert'] == 'box-width') {
			echo '@media only screen and (max-width: ' . absint($convertBoxWidth) . 'px) {';
		}
		elseif ($options['top_nav_convert'] == 'phone-ptr') {
			echo '@media only screen and (max-width:' . absint($phonePtr) . 'px) {';
		}
		elseif ($options['top_nav_convert'] == 'phone-ldsp') {
			echo '@media only screen and (max-width:' . absint($phoneLdsp) . 'px) {';
		}
		elseif ($options['top_nav_convert'] == 'tablet-ptr') {
			echo '@media only screen and (max-width: ' . absint($tabletPtr) . 'px) {';
		}
		elseif ($options['top_nav_convert'] == 'tablet-ldsp') {
			echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {';
		}
		elseif ($options['top_nav_convert'] == 'custom') {
			echo '@media only screen and (max-width: ' . absint($options['top_nav_convert_custom']) . 'px) {';
		}
	}

	echo '.device-top-menu-trigger-wrap {display: block;float: right; margin-right: 0; margin-left: 5px;}
		#tophead .react-menu, #tophead {display: none !important;}
		body.pge-bxd.t-mrg .top-and-pop .popdown,
		body.pge-mxd.t-mrg .top-and-pop .popdown {
			border-bottom-right-radius:' . absint($options['page_rounded_corners']) . 'px;
			border-bottom-left-radius:' . absint($options['page_rounded_corners']) . 'px;
		}
		body.pge-mxd.t-mrg.strch-allhd .top-and-pop  .popdown,
		body.pge-mxd.t-mrg.strch-top .top-and-pop  .popdown {
			border-bottom-right-radius: 0 !important;
			border-bottom-left-radius: 0 !important;
		}
		body.pge-mxd.lft-mrg.t-mrg .top-and-pop .popdown,
		body.pge-fld.lft-mrg.t-mrg .top-and-pop .popdown,
		body.pge-bxd-cnt.lft-mrg.t-mrg .top-and-pop .popdown {
			border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}
		body.pge-fld.rgt-mrg.t-mrg .top-and-pop .popdown,
		body.pge-bxd-cnt.rgt-mrg.t-mrg .top-and-pop .popdown,
		body.pge-mxd.rgt-mrg.t-mrg .top-and-pop .popdown {
			border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}
		.device-right-nav .info-menu,
		.device-left-nav .info-menu {
			margin-top: 0;
		}
		.device-right-nav .info-menu .im-button,
		.device-left-nav .info-menu .im-button {
			margin-top: 0;
			margin-bottom: 0;
		}
		.device-right-nav .info-menu-ul > li,
		.device-left-nav .info-menu-ul > li {
			height: 44px;
			width: 44px;
		}
		.device-right-nav .info-menu .info-menu-ul.im-split > li,
		.device-left-nav .info-menu .info-menu-ul.im-split > li {
			height: 44px;
			margin-top: -1px;
			margin-bottom: -1px;
		}
		#nav-wrap.button-nav.desc-hover ul.react-menu, #nav-wrap.button-nav.desc-never ul.react-menu, #nav-wrap.plain-nav.desc-hover ul.react-menu, #nav-wrap.plain-nav.desc-never ul.react-menu {
			padding-top: 3px;
			padding-bottom: 3px;
		}
		.device-right-nav .info-menu .info-menu-ul > li > a,
		.device-left-nav .info-menu .info-menu-ul > li > a {
			padding: 14px 13px 14px 14px;
		}
		.device-right-nav .info-menu .info-menu-ul.im-split > li > a,
		.device-left-nav .info-menu .info-menu-ul.im-split > li > a {padding-bottom: 15px; padding-top: 15px;}
		.device-right-nav .info-menu .info-menu-ul > li > a:last-child,
		.device-left-nav .info-menu .info-menu-ul > li > a:last-child {
			padding: 14px;
		}
		.device-right-nav .info-menu .info-menu-ul.im-split > li > a,
		.device-left-nav .info-menu .info-menu-ul.im-split > li > a {
			padding-top: 15px;
			padding-bottom: 15px
		}
		.device-right-nav .info-menu,
		body.logo-r.device-right-nav .info-menu {
			float: right;
			right: 0;
			position: relative;
			margin: 0 0 0 5px!important;
		}

		.device-right-nav .info-menu > ul,
		body.logo-r.device-right-nav .info-menu > ul {
			float: right;
			right: 0;
			position: relative;
		}

		';
	if ($options['top_nav_convert'] != 'always') {echo '}';}

}
?>









<?php /* Converts Points - Logo */ ?>
<?php
if ($options['logo_convert'] != 'never') {
	if ($options['logo_convert'] == 'box-width') {
		echo '@media only screen and (max-width: ' . absint($convertBoxWidth) . 'px) {';
	}
	elseif ($options['logo_convert'] == 'phone-ptr') {
		echo '@media only screen and (max-width:' . absint($phonePtr) . 'px) {';
	}
	elseif ($options['logo_convert'] == 'phone-ldsp') {
		echo '@media only screen and (max-width:' . absint($phoneLdsp) . 'px) {';
	}
	elseif ($options['logo_convert'] == 'tablet-ptr') {
		echo '@media only screen and (max-width: ' . absint($tabletPtr) . 'px) {';
	}
	elseif ($options['logo_convert'] == 'tablet-ldsp') {
		echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {';
	}
	elseif ($options['logo_convert'] == 'custom') {
		echo '@media only screen and (max-width: ' . absint($options['logo_convert_custom']) . 'px) {';
	}

	echo '

		';

		echo '.header-wrap-inner, body.logo-abv .header-wrap-inner, body.logo-r .header-wrap-inner { padding: ' . absint($options['header_mainheader_padding_convert']) . 'px 0;}';


			echo '
				#nav-wrap .info-menu > ul,
				#nav-wrap .info-menu > ul.im-button {
					margin-top: 10px;
				}
				#nav-wrap .info-menu > ul.im-split {
					margin-top: 12px;
				}
				#nav-wrap.split-nav.desc-hover ul.react-menu, #nav-wrap.split-nav.desc-never ul.react-menu,
				#nav-wrap.plain-nav.desc-hover ul.react-menu, #nav-wrap.plain-nav.desc-never ul.react-menu {
					padding-top: 26px;
				}
				#nav-wrap.button-nav.desc-hover ul.react-menu, #nav-wrap.button-nav.desc-never ul.react-menu {
					padding-top: 15px;
				}
				.logo,
				body.logo-r .logo,
				body.logo-abv .logo {
					float: none;
					width: auto;
					margin: 0 auto;
					position: relative;
					top: auto;
					text-align: center;
					left: auto;
					height: auto;
					padding-bottom: 10px;
					padding-top: 10px;
				}
				.logo span.strap-line,
				body.logo-r .logo span.strap-line,
				body.logo-abv .logo span.strap-line {
					position: relative;
					top: auto;
					left: auto;
					right: auto;
					text-align: center;
				}
				.logo a, body.logo-r .logo a {margin: 5px !important; float: none; text-align: center; position: relative;}
				#nav-wrap, body.logo-r #nav-wrap {margin: 0; min-height: 40px; padding-left: 0; padding-right: 0;}
				.device-menu-trigger-wrap, .device-top-menu-trigger-wrap {
					position: absolute;
					top: 10px;
					margin: 0;
				}
				.device-right-nav .info-menu,
				body.logo-r.device-right-nav .info-menu {
					float: left;
					position: relative;
					margin: 0 5px 0 0!important;
				}
				.device-right-nav .info-menu > ul,
				body.logo-r.device-right-nav .info-menu > ul {
					float: left;
				}

				.device-right-nav.device-left-nav .info-menu,
				body.logo-r.device-right-nav.device-left-nav .info-menu {
					float: right;
					right: 50%;
					position: relative;
					margin: 0!important;
				}

				.device-right-nav.device-left-nav .info-menu > ul,
				body.logo-r.device-right-nav.device-left-nav .info-menu > ul {
					float: right;
					right: -50%;
					position: relative;
					margin-left: 40px;
					margin-right: 40px;
				}

				.device-menu-trigger-wrap {
					left: -2px;
				}
				.device-top-menu-trigger-wrap {
					right: -2px;
				}

			';


			if ($options['general_logo_convert_absolute']) {
			echo '
				.device-right-nav .info-menu,
				body.logo-r.device-right-nav .info-menu {
					min-width: -moz-max-content;
					min-width: -webkit-max-content;
					min-width: max-content;
					position: absolute;
					left: 0;
				}
				.logo,
				body.logo-r .logo,
				body.logo-abv .logo {
					width: 100%;
					right: auto;
					padding: 0;
					margin: 0 !important;
					position: absolute;
					top: ' . intval($options['header_mainheader_padding_convert']) . 'px;
				}
				.device-menu-trigger-wrap {
					left: -2px;
				}
				.device-top-menu-trigger-wrap {
					right: -2px;
				}
				#nav-wrap, body.logo-r #nav-wrap {margin: 0; min-height: 40px; padding-left: 0; padding-right: 0;}
				';
				if (!$options['general_logo_alternative']) {
					echo '
						.logo a, body.logo-r .logo a, body.logo-abv .logo {margin-left: -' . (absint($options['general_logo_image_width']) / 2) . 'px;}
					';
				} else {
					echo '
						.logo a, body.logo-r .logo a, body.logo-abv .logo {margin-left: -' . (absint($options['general_logo_alternative_image_width']) / 2 ) . 'px;}
					';
				}

			}

		echo '



		body.pop-trig-abso .dismissed #popdown-trigger {
		';
		if ($rtl) {
			echo 'left: 15px;';
		} else {
			echo 'right: 15px;';
		}
		echo '
		}

		#nav-wrap .back-home-icon {
			padding: 0;
			margin: 0;
			display: none;
		}

		';


		if ($options['general_logo_alternative']) {
			echo '
			.logo img {zoom: 1; filter: alpha(opacity=0); opacity: 0;}
			.logo a {
				background-image: url(' . esc_url(react_get_upload_url($options['general_logo_alternative'])) . ');
				background-size: ' . absint($options['general_logo_alternative_image_width']). 'px ' . absint($options['general_logo_alternative_image_height']) . 'px;
				background-repeat: no-repeat;
				width: ' . absint($options['general_logo_alternative_image_width']) . 'px;
				height: ' . absint($options['general_logo_alternative_image_height']) . 'px;
				display: inline-block;
			}';
			if ($options['general_logo_alternative_double']) {
				echo '
					@media
					(-webkit-min-device-pixel-ratio: 1.5),
					(min-resolution: 144dpi),
					(min-resolution: 1.5dppx) {

						.logo img {zoom: 1; filter: alpha(opacity=0); opacity: 0;}
						.logo a {
							background-image: url(' . esc_url(react_get_upload_url($options['general_logo_alternative_double'])) . ');
							background-size: ' . absint($options['general_logo_alternative_image_width']) . 'px ' . absint($options['general_logo_alternative_image_height']) . 'px;
							background-repeat: no-repeat;
							width: ' . absint($options['general_logo_alternative_image_width']) . 'px;
							height: ' . absint($options['general_logo_alternative_image_height']) . 'px;
							display: inline-block;
						}

					}

				';
			}
		}
		echo '
	}';
}
?>


<?php /* Hide FS bullets */ ?>
<?php
if ($options['background_bullets']) {
	if ($options['background_bullets_convert'] != 'never') {
		if ($options['background_bullets_convert'] == 'box-width') {
			echo '@media only screen and (max-width: ' . absint($convertBoxWidth) . 'px) {';
		}
		elseif ($options['background_bullets_convert'] == 'phone-ptr') {
			echo '@media only screen and (max-width:' . absint($phonePtr) . 'px) {';
		}
		elseif ($options['background_bullets_convert'] == 'phone-ldsp') {
			echo '@media only screen and (max-width:' . absint($phoneLdsp) . 'px) {';
		}
		elseif ($options['background_bullets_convert'] == 'tablet-ptr') {
			echo '@media only screen and (max-width: ' . absint($tabletPtr) . 'px) {';
		}
		elseif ($options['background_bullets_convert'] == 'tablet-ldsp') {
			echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {';
		}
		elseif ($options['background_bullets_convert'] == 'custom') {
			echo '@media only screen and (max-width: ' . absint($options['background_bullets_convert_custom']) . 'px) {';
		}

		echo '

			.fullscreen-bullets {display: none;}
		}';
	}
}
?>

<?php /* Converts Points - Slider */ ?>
<?php
if ($options['component_slider_convert_point'] != 'never') {
	if ($options['component_slider_convert_point'] == 'box-width') {
		echo '@media only screen and (max-width: ' . absint($convertBoxWidth) . 'px) {';
	}
	elseif ($options['component_slider_convert_point'] == 'phone-ptr') {
		echo '@media only screen and (max-width:' . absint($phonePtr) . 'px) {';
	}
	elseif ($options['component_slider_convert_point'] == 'phone-ldsp') {
		echo '@media only screen and (max-width:' . absint($phoneLdsp) . 'px) {';
	}
	elseif ($options['component_slider_convert_point'] == 'tablet-ptr') {
		echo '@media only screen and (max-width: ' . absint($tabletPtr) . 'px) {';
	}
	elseif ($options['component_slider_convert_point'] == 'tablet-ldsp') {
		echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {';
	}
	elseif ($options['component_slider_convert_point'] == 'custom') {
		echo '@media only screen and (max-width: ' . absint($options['component_slider_convert_point_custom']) . 'px) {';
	}

	echo '
		.slider-wrap.slider-mobile {display: block;}
		.slider-wrap.slider-default {display: none;}

	}';
}
?>


<?php /* Converts Points - Quform */ ?>
<?php
if ($options['quform_convert'] != 'never') {
	if ($options['quform_convert'] == 'box-width') {
		echo '@media only screen and (max-width: ' . absint($convertBoxWidth) . 'px) {';
	}
	elseif ($options['quform_convert'] == 'phone-ptr') {
		echo '@media only screen and (max-width:' . absint($phonePtr) . 'px) {';
	}
	elseif ($options['quform_convert'] == 'phone-ldsp') {
		echo '@media only screen and (max-width:' . absint($phoneLdsp) . 'px) {';
	}
	elseif ($options['quform_convert'] == 'tablet-ptr') {
		echo '@media only screen and (max-width: ' . absint($tabletPtr) . 'px) {';
	}
	elseif ($options['quform_convert'] == 'tablet-ldsp') {
		echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {';
	}
	elseif ($options['quform_convert'] == 'custom') {
		echo '@media only screen and (max-width: ' . absint($options['quform_convert_custom']) . 'px) {';
	}

	echo '
		.iphorm-group-row > .iphorm-element-wrap, .iphorm-group-row > .iphorm-group-wrap {
			float: none;
			width: 100% !important;
			display: block;
		}
		.iphorm-elements .iphorm-element-wrap-text input, .iphorm-elements .iphorm-element-wrap-captcha input, .iphorm-elements .iphorm-element-wrap-password input, .iphorm-elements .iphorm-element-wrap-select select, .iphorm-elements .iphorm-element-wrap textarea {
			width: 100% !important;
			min-width: 100px;
		}
		.iphorm-errors > .iphorm-error {
			float: none;
			display: block;
		}
		.iphorm-element-spacer {
			padding-right: 0 !important;
		}

		.iphorm-submit-input-wrap {
			width: 100%;
		}
		.iphorm-submit-wrap button {
			margin: 0;
			width: 100%;
		}
		.iphorm-labels-left > .iphorm-element-spacer > label {
			float: none;
			width: auto;
		}
		.iphorm-labels-left.iphorm-element-wrap .iphorm-input-outer-wrap, .iphorm-labels-left.iphorm-element-wrap .iphorm-input-wrap, .iphorm-labels-left.iphorm-element-wrap .iphorm-captcha-image-wrap {
			margin-left: 0;
			padding-left: 0;
		}
		.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-date .iphorm-input-wrap-date-select-wrap > select,
		.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-time .iphorm-input-wrap > select {
			width: 32.3333%;
			letter-spacing: 0;
			float: left;
			margin-right: 1%;
			max-width: 100%;
		}
		.iphorm-loading-wrap {
			width: 100%!important;
			margin-top: 10px;
		}
		.iphorm-loading-wrap .ihorm-loading {
			margin-left: 0;
			margin-right: 0;

		}
	}';
}
?>
<?php /* Converts Points - Sidebar */ ?>
<?php
if ($options['sidebar_convert'] != 'never') {
	if ($options['sidebar_convert'] == 'box-width') {
		echo '@media only screen and (max-width: ' . absint($convertBoxWidth) . 'px) {';
	}
	elseif ($options['sidebar_convert'] == 'phone-ptr') {
		echo '@media only screen and (max-width:' . absint($phonePtr) . 'px) {';
	}
	elseif ($options['sidebar_convert'] == 'phone-ldsp') {
		echo '@media only screen and (max-width:' . absint($phoneLdsp) . 'px) {';
	}
	elseif ($options['sidebar_convert'] == 'tablet-ptr') {
		echo '@media only screen and (max-width: ' . absint($tabletPtr) . 'px) {';
	}
	elseif ($options['sidebar_convert'] == 'tablet-ldsp') {
		echo '@media only screen and (max-width: ' . absint($tabletLdsp) . 'px) {';
	}
	elseif ($options['sidebar_convert'] == 'custom') {
		echo '@media only screen and (max-width: ' . absint($options['sidebar_convert_custom']) . 'px) {';
	}

	if ($options['sidebar_convert_columns'] == 'revcol-1-2' || $options['sidebar_convert_columns'] == 'revcol-2-2') {
		echo '
			.revcol-1-2 #sidebar .widget, .revcol-2-2 #sidebar .widget {
				display: inline-block;
				float: left;
				vertical-align: top;
				width: 47%;
				margin-left: 1.5%;
				margin-right: 1.5%;
			}
		' ;
	}
	if ($options['sidebar_convert_columns'] == 'revcol-2-3' || $options['sidebar_convert_columns'] == 'revcol-1-3') {
		echo '
			.revcol-1-3 #sidebar .widget, .revcol-2-3 #sidebar .widget {
				display: inline-block;
				float: left;
				vertical-align: top;
				width: 29.333%;
				margin-left: 2%;
				margin-right: 2%;
			}
			' ;
	}

	if ($options['sidebar_convert_columns'] == 'revcol-1-1') {
		echo '
			.revcol-1-1 #sidebar .widget {
				display: block;
				float: none;
				vertical-align: top;
				width: 100%;
				margin-left: 0;
				margin-right: 0;
			}
		' ;
	}

	echo '
		#sidebar, .right-sidebar #sidebar, .left-sidebar #sidebar,
		#content, .right-sidebar #content, .left-sidebar #content {
			width: 100% !important;
			float: none;
			padding-left: 0;
			padding-right: 0;
			margin: 40px 0 0;
		}
		#content, .right-sidebar #content, .left-sidebar #content {
			margin-top: 0;
		}
		.sdbr-line #sidebar, .sdbr-line.right-sidebar #sidebar, .sdbr-line.left-sidebar #sidebar {
			width: 100% !important;
			border-left-style: none;
			border-left-width: 0;
			border-right-style: none;
			border-right-width: 0;
			margin: 40px -40px -40px -40px;
			padding: 40px;
			position: relative;
			border-radius: 0!important;
			-webkit-box-sizing: content-box;
			-moz-box-sizing: content-box;
			box-sizing: content-box;
		}
		.sdbr-line #sidebar .sidebar-inner, .sdbr-line.right-sidebar #sidebar .sidebar-inner, .sdbr-line.left-sidebar #sidebar .sidebar-inner {
			position: relative;
			-webkit-box-sizing: content-box;
			-moz-box-sizing: content-box;
			box-sizing: content-box;
		}' ;
		if ($options['sidebar_masonry']) {
			echo '
				.sdbr-line #sidebar .sidebar-inner, .sdbr-line.right-sidebar #sidebar .sidebar-inner, .sdbr-line.left-sidebar #sidebar .sidebar-inner {
					margin: -40px 0 0 -40px;
				}
			' ;
		}
		echo '
		#sidebar * {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			max-width: 100%;
		}

		.right-sidebar .breadcrumbs {
			margin-right: -40px;
			padding-right: 40px;
		}
		.left-sidebar .breadcrumbs {
			margin-left: -40px;
			padding-left: 40px;
		}
		.sdbr-line #content:before {
			display: none;
		}
		#sidebar {
			border-radius: ' . absint($options['element_rounded_corners']) . 'px;
		}
		.right-sidebar #content .tcs-block-outer.tcs-fullwidth {
			margin-right: -40px;
		}
		.left-sidebar #content .tcs-block-outer.tcs-fullwidth {
			margin-left: -40px;
		}

		}';
	}
?>

<?php /* Page radius */ ?>
<?php
if ($options['page_layout'] == 'pge-bxd') {
	echo '
		body.pge-bxd.t-mrg.v-space .header-all,
		body.pge-bxd.v-space .after-header-wrap,
		body.pge-bxd.v-space .slider-wrap,
		body.pge-bxd.v-space .slider-wrap .slider-inner,
		body.pge-bxd.v-space .slider-wrap .rev_slider_wrapper {
			border-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}';
}
?>
<?php
if ($options['page_layout'] == 'pge-mxd') {
	echo '
		body.pge-mxd.v-space .after-header-wrap,
		body.pge-mxd.v-space .slider-wrap,
		body.pge-mxd.v-space .slider-wrap .slider-inner,
		body.pge-mxd.v-space .slider-wrap .rev_slider_wrapper {
			border-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}';
}
?>

<?php /* Specific corners */ ?>
<?php
if ($options['page_layout'] == 'pge-bxd') {
	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-mxd.rgt-mrg.ft-fix.v-space .footer-all #subfooter,
			body.pge-mxd.rgt-mrg.ft-fix.v-space .footer-all #subfooter > div,
			body.pge-mxd.rgt-mrg.ft-fix.v-space .footer-all #subfooter > div > div {
				border-top-right-radius: 0;
			}
			body.pge-bxd.v-space .footer-all .footer,
			body.pge-bxd.v-space .footer-all .footer > div,
			body.pge-bxd.v-space .footer-all .footer > div > div,
			';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-bxd.v-space .footer-all #subfooter,
			body.pge-bxd.v-space .footer-all #subfooter > div,
			body.pge-bxd.v-space .footer-all #subfooter > div > div,

			body.pge-mxd.ft-fix.v-space .footer-all #subfooter,
			body.pge-mxd.ft-fix.v-space .footer-all #subfooter > div,
			body.pge-mxd.ft-fix.v-space .footer-all #subfooter > div > div,
			';
	}
	echo '
		body.pge-bxd.t-mrg .header-all,
		body.pge-bxd.t-mrg .header-all > div.first-child,
		body.pge-bxd.t-mrg .header-all > div:first-child,
		body.pge-bxd.v-space .after-header-wrap > div.first-child,
		body.pge-bxd.v-space .after-header-wrap > div:first-child,

		body.pge-bxd.t-mrg .header-all > div.first-child > div,
		body.pge-bxd.t-mrg .header-all > div:first-child > div,
		body.pge-bxd.v-space .after-header-wrap > div.first-child > div,
		body.pge-bxd.v-space .after-header-wrap > div:first-child > div,

		body.pge-bxd.t-mrg .header-all > div.first-child > div > div,
		body.pge-bxd.t-mrg .header-all > div:first-child > div > div,
		body.pge-bxd.v-space .after-header-wrap > div.first-child > div > div,
		body.pge-bxd.v-space .after-header-wrap > div:first-child > div > div {
			border-top-right-radius: ' .  absint($options['page_rounded_corners']) . 'px;
			border-top-left-radius: ' .  absint($options['page_rounded_corners']) . 'px;
		}'; // top right, top left
}
?>
<?php
if ($options['page_layout'] == 'pge-mxd') {
	if ($options['footer_widget_area_layout'] != '') {
		echo '
		body.pge-mxd.v-space .footer-all .footer,
		body.pge-mxd.v-space .footer-all .footer > div,
		body.pge-mxd.v-space .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
		body.pge-mxd.v-space .footer-all #subfooter,
		body.pge-mxd.v-space .footer-all #subfooter > div,
		body.pge-mxd.v-space .footer-all #subfooter > div > div,
		';
	}
	echo '
		body.pge-mxd.t-mrg .header-all,
		body.pge-mxd.t-mrg .header-all > div.first-child,
		body.pge-mxd.t-mrg .header-all > div:first-child,
		body.pge-mxd.v-space .after-header-wrap > div.first-child,
		body.pge-mxd.v-space .after-header-wrap > div:first-child,

		body.pge-mxd.t-mrg .header-all > div.first-child > div,
		body.pge-mxd.t-mrg .header-all > div:first-child > div,
		body.pge-mxd.v-space .after-header-wrap > div.first-child > div,
		body.pge-mxd.v-space .after-header-wrap > div:first-child > div,
		body.pge-mxd.t-mrg .header-all > div.first-child > div > div,
		body.pge-mxd.t-mrg .header-all > div:first-child > div > div,
		body.pge-mxd.v-space .after-header-wrap > div.first-child > div > div,
		body.pge-mxd.v-space .after-header-wrap > div:first-child > div > div,
		body.pge-mxd.ft-fix.v-space .footer-all #subfooter,
		body.pge-mxd.ft-fix.v-space .footer-all #subfooter > div,
		body.pge-mxd.ft-fix.v-space .footer-all #subfooter > div > div {
			border-top-right-radius: ' .  absint($options['page_rounded_corners']) . 'px;
			border-top-left-radius: ' .  absint($options['page_rounded_corners']) . 'px;
		}'; // top right, top left
}
?>
<?php
if ($options['page_layout'] == 'pge-bxd') {
	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-bxd.b-mrg.ft-fix .footer-all .footer,

			body.pge-bxd.b-mrg.ft-fix .footer-all .footer > div,

			body.pge-bxd.b-mrg.ft-fix .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-bxd.b-mrg.ft-fix .content-outer,

			body.pge-bxd.b-mrg.ft-fix > div,

			body.pge-bxd.b-mrg.ft-fix > div > div,
		';
	}
	echo '
		body.pge-bxd.t-mrg .top-and-pop > div.last-child:not(.abso-on),
		body.pge-bxd.t-mrg .top-and-pop > div:last-child,
		body.pge-bxd.t-mrg .top-and-pop,
		body.pge-bxd.v-space .header-all > div.last-child,
		body.pge-bxd.v-space .header-all > div:last-child,
		body.pge-bxd.v-space .header-all,
		body.pge-bxd.b-mrg .footer-all #subfooter,
		body.pge-bxd.v-space .after-header-wrap > div.last-child,
		body.pge-bxd.v-space .after-header-wrap > div:last-child,


		body.pge-bxd.t-mrg .top-and-pop > div.last-child > div,
		body.pge-bxd.t-mrg .top-and-pop > div:last-child > div,
		body.pge-bxd.v-space .header-all > div.last-child > div,
		body.pge-bxd.v-space .header-all > div:last-child > div,
		body.pge-bxd.b-mrg .footer-all #subfooter > div,
		body.pge-bxd.v-space .after-header-wrap > div.last-child > div,
		body.pge-bxd.v-space .after-header-wrap > div:last-child > div,
		body.pge-bxd.t-mrg .top-and-pop > div.last-child > div > div,
		body.pge-bxd.t-mrg .top-and-pop > div:last-child > div > div,
		body.pge-bxd.v-space .header-all > div.last-child > div > div,
		body.pge-bxd.v-space .header-all > div:last-child > div > div,
		body.pge-bxd.b-mrg .footer-all #subfooter > div > div,
		body.pge-bxd.v-space .after-header-wrap > div.last-child > div > div,
		body.pge-bxd.v-space .after-header-wrap > div:last-child > div > div,
		body.pge-bxd.v-space .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper {
			border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
			border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}
	';//bottom right, bottom left

	}
?>
<?php
if ($options['page_layout'] == 'pge-mxd') {
	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-mxd.b-mrg.ft-fix .footer-all .footer,

			body.pge-mxd.b-mrg.ft-fix .footer-all .footer > div,

			body.pge-mxd.b-mrg.ft-fix .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-mxd.b-mrg.ft-fix .content-outer,

			body.pge-mxd.b-mrg.ft-fix > div,

			body.pge-mxd.b-mrg.ft-fix > div > div,
		';
	}

	echo '
		body.pge-mxd.t-mrg .top-and-pop > div.last-child:not(.abso-on),
		body.pge-mxd.t-mrg .top-and-pop > div:last-child,
		body.pge-mxd.t-mrg .top-and-pop,
		body.pge-mxd.v-space .header-all > div.last-child,
		body.pge-mxd.v-space .header-all > div:last-child,
		body.pge-mxd.v-space .header-all,
		body.pge-mxd.b-mrg .footer-all #subfooter,
		body.pge-mxd.v-space .after-header-wrap > div.last-child,
		body.pge-mxd.v-space .after-header-wrap > div:last-child,
		body.pge-mxd.v-space .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,

		body.pge-mxd.t-mrg .top-and-pop > div.last-child > div,
		body.pge-mxd.t-mrg .top-and-pop > div:last-child > div,
		body.pge-mxd.v-space .header-all > div.last-child > div,
		body.pge-mxd.v-space .header-all > div:last-child > div,
		body.pge-mxd.b-mrg .footer-all #subfooter > div,
		body.pge-mxd.v-space .after-header-wrap > div.last-child > div,
		body.pge-mxd.v-space .after-header-wrap > div:last-child > div,

		body.pge-mxd.t-mrg .top-and-pop > div.last-child > div > div,
		body.pge-mxd.t-mrg .top-and-pop > div:last-child > div > div,

		body.pge-mxd.v-space .header-all > div.last-child > div > div,
		body.pge-mxd.v-space .header-all > div:last-child > div > div,
		body.pge-mxd.b-mrg .footer-all #subfooter > div > div,
		body.pge-mxd.v-space .after-header-wrap > div.last-child > div > div,
		body.pge-mxd.v-space .after-header-wrap > div:last-child > div > div {
			border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
			border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}

		body.pge-mxd.b-mrg.ft-fix.strch-allft .footer-all .footer,
		body.pge-mxd.v-space.strch-allhd .header-all > div.last-child,
		body.pge-mxd.v-space.strch-allhd .header-all > div:last-child,
		body.pge-mxd.v-space.strch-allhd .header-all,
		body.pge-mxd.t-mrg.strch-allhd .top-and-pop > div.last-child:not(.abso-on),
		body.pge-mxd.t-mrg.strch-allhd .top-and-pop > div:last-child,
		body.pge-mxd.t-mrg.strch-allhd .top-and-pop,
		body.pge-mxd.t-mrg.strch-top .top-and-pop > div.last-child:not(.abso-on),
		body.pge-mxd.t-mrg.strch-top .top-and-pop > div:last-child,
		body.pge-mxd.t-mrg.strch-top .top-and-pop,

		body.pge-mxd.b-mrg.ft-fix.strch-allft .footer-all .footer > div,
		body.pge-mxd.v-space.strch-allhd .header-all > div.last-child > div,
		body.pge-mxd.v-space.strch-allhd .header-all > div:last-child > div,
		body.pge-mxd.t-mrg.strch-allhd .top-and-pop > div.last-child > div,
		body.pge-mxd.t-mrg.strch-allhd .top-and-pop > div:last-child > div,
		body.pge-mxd.t-mrg.strch-top .top-and-pop > div.last-child > div,
		body.pge-mxd.t-mrg.strch-top .top-and-pop > div:last-child > div,

		body.pge-mxd.b-mrg.ft-fix.strch-allft .footer-all .footer > div > div,
		body.pge-mxd.v-space.strch-allhd .header-all > div.last-child > div > div,
		body.pge-mxd.v-space.strch-allhd .header-all > div:last-child > div > div,
		body.pge-mxd.t-mrg.strch-allhd .top-and-pop > div.last-child > div > div,
		body.pge-mxd.t-mrg.strch-allhd .top-and-pop > div:last-child > div > div,
		body.pge-mxd.t-mrg.strch-top .top-and-pop > div.last-child > div > div,
		body.pge-mxd.t-mrg.strch-top .top-and-pop > div:last-child > div > div {
			border-bottom-right-radius: 0 !important;
			border-bottom-left-radius: 0 !important;
		}
	';
	if ($options['footer_widget_area_layout'] != '') {
		echo '

			body.pge-mxd.lft-mrg.ft-fix.v-space .footer-all #subfooter,
			body.pge-mxd.lft-mrg.ft-fix.v-space .footer-all #subfooter > div,
			body.pge-mxd.lft-mrg.ft-fix.v-space .footer-all #subfooter > div > div {
				border-top-left-radius: 0;
			}

			body.pge-mxd.lft-mrg.v-space .footer-all .footer,

			body.pge-mxd.lft-mrg.v-space .footer-all .footer > div,
			body.pge-mxd.lft-mrg.v-space .footer-all .footer > div > div,

		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '

			body.pge-mxd.lft-mrg.v-space .footer-all #subfooter,

			body.pge-mxd.lft-mrg.v-space .footer-all #subfooter > div,
			body.pge-mxd.lft-mrg.v-space .footer-all #subfooter > div > div,

		';
	}
	echo '
		body.pge-mxd.lft-mrg.t-mrg .header-all,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div.first-child,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div:first-child,
		body.pge-mxd.lft-mrg.v-space .footer-all .footer,
		body.pge-mxd.lft-mrg.t-mrg .header-all > div.first-child,
		body.pge-mxd.lft-mrg.t-mrg .header-all > div:first-child,

		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div.first-child > div,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div:first-child > div,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div.first-child > div,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div:first-child > div,
		body.pge-mxd.lft-mrg.v-space .footer-all .footer > div,
		body.pge-mxd.lft-mrg.t-mrg .header-all > div.first-child > div,
		body.pge-mxd.lft-mrg.t-mrg .header-all > div:first-child > div,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div.first-child > div > div,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div:first-child > div > div,
		body.pge-mxd.lft-mrg.v-space .footer-all .footer > div > div,
		body.pge-mxd.lft-mrg.t-mrg .header-all > div.first-child > div > div,
		body.pge-mxd.lft-mrg.t-mrg .header-all > div:first-child > div > div {
			border-top-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}
	'; // top left

	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-mxd.lft-mrg.b-mrg.ft-fix .footer-all .footer,

			body.pge-mxd.lft-mrg.b-mrg.ft-fix .footer-all .footer > div,
			body.pge-mxd.lft-mrg.b-mrg.ft-fix .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-mxd.lft-mrg.b-mrg.ft-fix .content-outer,

			body.pge-mxd.lft-mrg.b-mrg.ft-fix > div,
			body.pge-mxd.lft-mrg.b-mrg.ft-fix > div > div,
		';
	}

	echo '
		body.pge-mxd.lft-mrg.t-mrg .top-and-pop > div.last-child:not(.abso-on),
		body.pge-mxd.lft-mrg.t-mrg .top-and-pop > div:last-child,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div.last-child,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div:last-child,
		body.pge-mxd.lft-mrg.v-space .header-all,
		body.pge-mxd.lft-mrg.t-mrg .top-and-pop,
		body.pge-mxd.lft-mrg.v-space .header-all > div.last-child,
		body.pge-mxd.lft-mrg.v-space .header-all > div:last-child,

		body.pge-mxd.lft-mrg.t-mrg .top-and-pop > div.last-child > div,
		body.pge-mxd.lft-mrg.t-mrg .top-and-pop > div:last-child > div,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div.last-child > div,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div:last-child > div,
		body.pge-mxd.lft-mrg.v-space .header-all > div.last-child > div,
		body.pge-mxd.lft-mrg.v-space .header-all > div:last-child > div,
		body.pge-mxd.lft-mrg.t-mrg .top-and-pop > div.last-child > div > div,
		body.pge-mxd.lft-mrg.t-mrg .top-and-pop > div:last-child > div > div,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div.last-child > div > div,
		body.pge-mxd.lft-mrg.v-space .after-header-wrap > div:last-child > div > div,
		body.pge-mxd.lft-mrg.v-space .header-all > div.last-child > div > div,
		body.pge-mxd.lft-mrg.v-space .header-all > div:last-child > div > div {
			border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}';// bottom left


	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-mxd.rgt-mrg.ft-fix.v-space .footer-all #subfooter,
			body.pge-mxd.rgt-mrg.ft-fix.v-space .footer-all #subfooter > div,
			body.pge-mxd.rgt-mrg.ft-fix.v-space .footer-all #subfooter > div > div {
				border-top-right-radius: 0;
			}
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-mxd.rgt-mrg.ft-fix.v-space .footer-all #subfooter,
			body.pge-mxd.rgt-mrg.ft-fix.v-space .footer-all #subfooter > div,
			body.pge-mxd.rgt-mrg.ft-fix.v-space .footer-all #subfooter > div > div,
		';
	}
	echo '
		body.pge-mxd.rgt-mrg.t-mrg .header-all,
		body.pge-mxd.rgt-mrg.t-mrg .header-all > div.first-child,
		body.pge-mxd.rgt-mrg.t-mrg .header-all > div:first-child,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div.first-child,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div:first-child,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div.first-child,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div:first-child,
		body.pge-mxd.rgt-mrg.v-space .footer-all .footer,

		body.pge-mxd.rgt-mrg.t-mrg .header-all > div.first-child > div,
		body.pge-mxd.rgt-mrg.t-mrg .header-all > div:first-child > div,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div.first-child > div,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div:first-child > div,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div.first-child > div,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div:first-child > div,
		body.pge-mxd.rgt-mrg.v-space .footer-all .footer > div,
		body.pge-mxd.rgt-mrg.t-mrg .header-all > div.first-child > div > div,
		body.pge-mxd.rgt-mrg.t-mrg .header-all > div:first-child > div > div,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div.first-child > div > div,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div:first-child > div > div,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div.first-child > div > div,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div:first-child > div > div,
		body.pge-mxd.rgt-mrg.v-space .footer-all .footer > div > div {
			border-top-right-radius: ' .  absint($options['page_rounded_corners']) . 'px;
		}'; // top right

	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-mxd.rgt-mrg.b-mrg.ft-fix .footer-all .footer,

			body.pge-mxd.rgt-mrg.b-mrg.ft-fix .footer-all .footer > div,
			body.pge-mxd.rgt-mrg.b-mrg.ft-fix .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-mxd.rgt-mrg.b-mrg.ft-fix .content-outer,

			body.pge-mxd.rgt-mrg.b-mrg.ft-fix > div,
			body.pge-mxd.rgt-mrg.b-mrg.ft-fix > div > div,
		';
	}
	echo '
		body.pge-mxd.rgt-mrg.t-mrg .top-and-pop > div.last-child:not(.abso-on),
		body.pge-mxd.rgt-mrg.t-mrg .top-and-pop > div:last-child,
		body.pge-mxd.rgt-mrg.t-mrg .top-and-pop,
		body.pge-mxd.rgt-mrg.v-space .header-all > div.last-child,
		body.pge-mxd.rgt-mrg.v-space .header-all > div:last-child,
		body.pge-mxd.rgt-mrg.v-space .header-all,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div.last-child,

		body.pge-mxd.rgt-mrg.t-mrg .top-and-pop > div.last-child > div,
		body.pge-mxd.rgt-mrg.t-mrg .top-and-pop > div:last-child > div,
		body.pge-mxd.rgt-mrg.v-space .header-all > div.last-child > div,
		body.pge-mxd.rgt-mrg.v-space .header-all > div:last-child > div,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div.last-child > div,
		body.pge-mxd.rgt-mrg.t-mrg .top-and-pop > div.last-child > div > div,
		body.pge-mxd.rgt-mrg.t-mrg .top-and-pop > div:last-child > div > div,
		body.pge-mxd.rgt-mrg.v-space .header-all > div.last-child > div > div,
		body.pge-mxd.rgt-mrg.v-space .header-all > div:last-child > div > div,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div.last-child > div > div,

		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div:last-child,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div:last-child > div,
		body.pge-mxd.rgt-mrg.v-space .after-header-wrap > div:last-child > div > div {
			border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}'; // bottom right

	echo '
		body.pge-mxd.ft-fix.b-mrg.strch-allft .footer-all #subfooter,
		body.pge-mxd.b-mrg.strch-allft .footer-all #subfooter,
		body.pge-mxd.b-mrg.strch-sf .footer-all #subfooter,

		body.pge-mxd.ft-fix.b-mrg.strch-allft .footer-all #subfooter > div,
		body.pge-mxd.b-mrg.strch-allft .footer-all #subfooter > div,
		body.pge-mxd.b-mrg.strch-sf .footer-all #subfooter > div,
		body.pge-mxd.ft-fix.b-mrg.strch-allft .footer-all #subfooter > div > div,
		body.pge-mxd.b-mrg.strch-allft .footer-all #subfooter > div > div,
		body.pge-mxd.b-mrg.strch-sf .footer-all #subfooter > div > div {
			border-bottom-left-radius: 0!important;
			border-bottom-right-radius: 0!important;
		}
		body.pge-mxd.strch-sf.ft-fix .footer-all #subfooter,
		body.pge-mxd.ft-fix.b-mrg.strch-allft .footer-all #subfooter,
		body.pge-mxd.v-space.strch-allft .footer-all .footer,
		body.pge-mxd.strch-sf.ft-fix .footer-all #subfooter > div,
		body.pge-mxd.ft-fix.b-mrg.strch-allft .footer-all #subfooter > div,
		body.pge-mxd.v-space.strch-allft .footer-all .footer > div,
		body.pge-mxd.strch-sf.ft-fix .footer-all #subfooter > div > div,
		body.pge-mxd.ft-fix.b-mrg.strch-allft .footer-all #subfooter > div > div,
		body.pge-mxd.v-space.strch-allft .footer-all .footer > div > div {
			border-top-left-radius: 0!important;
			border-top-right-radius: 0!important;
		}
		body.pge-mxd.t-mrg.strch-allhd .header-all > div.last-child,
		body.pge-mxd.t-mrg.strch-allhd .header-all > div:last-child,
		body.pge-mxd.t-mrg.strch-allhd .header-all,
		body.pge-mxd.v-space.ft-fix.strch-allft .footer-all .footer,
		body.pge-mxd.t-mrg.strch-allhd .header-all > div.last-child > div,
		body.pge-mxd.t-mrg.strch-allhd .header-all > div:last-child > div,
		body.pge-mxd.v-space.ft-fix.strch-allft .footer-all .footer > div
		body.pge-mxd.t-mrg.strch-allhd .header-all > div.last-child > div > div,
		body.pge-mxd.t-mrg.strch-allhd .header-all > div:last-child > div > div,
		body.pge-mxd.v-space.ft-fix.strch-allft .footer-all .footer > div > div {
			border-top-right-radius: 0 !important;
			border-top-left-radius: 0 !important;
		}';

	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-mxd.v-space.strch-allft .footer-all .footer,
			body.pge-mxd.v-space.strch-allft .footer-all .footer > div,
			body.pge-mxd.v-space.strch-allft .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-mxd.v-space.strch-allft .footer-all #subfooter,
			body.pge-mxd.v-space.strch-allft .footer-all #subfooter > div,
			body.pge-mxd.v-space.strch-allft .footer-all #subfooter > div > div,
		';
	}
	echo '
		body.pge-mxd.t-mrg.strch-allhd .header-all > div.first-child,
		body.pge-mxd.t-mrg.strch-allhd .header-all > div:first-child,
		body.pge-mxd.t-mrg.strch-allhd .header-all,

		body.pge-mxd.t-mrg.strch-allhd .header-all > div.first-child > div,
		body.pge-mxd.t-mrg.strch-allhd .header-all > div:first-child > div
		body.pge-mxd.t-mrg.strch-allhd .header-all > div.first-child > div > div,
		body.pge-mxd.t-mrg.strch-allhd .header-all > div:first-child > div > div {
			border-top-right-radius: 0 !important;
			border-top-left-radius: 0 !important;
		}';
	}
?>

<?php /* TopLeft */ ?>
<?php
if ($options['page_layout'] == 'pge-bxd-cnt') {

	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-bxd-cnt.lft-mrg.v-space .footer-all .footer,

			body.pge-bxd-cnt.lft-mrg.v-space .footer-all .footer > div,
			body.pge-bxd-cnt.lft-mrg.v-space .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-bxd-cnt.lft-mrg.v-space .footer-all #subfooter,

			body.pge-bxd-cnt.lft-mrg.v-space .footer-all #subfooter > div,
			body.pge-bxd-cnt.lft-mrg.v-space .footer-all #subfooter > div > div,
		';
	}

	echo '
		body.pge-bxd-cnt.lft-mrg.t-mrg .header-all > div.first-child,
		body.pge-bxd-cnt.lft-mrg.t-mrg .header-all > div:first-child,
		body.pge-bxd-cnt.lft-mrg.t-mrg .header-all,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap > div.first-child,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap > div:first-child,
		body.pge-bxd-cnt.lft-mrg.v-space .slider-wrap,
		body.pge-bxd-cnt.lft-mrg.v-space .slider-wrap .slider-inner,
		body.pge-bxd-cnt.lft-mrg.v-space .slider-wrap .rev_slider_wrapper .rev_slider ul > li,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap,
		body.pge-bxd-cnt.lft-mrg.t-mrg .header-all > div.first-child > div,
		body.pge-bxd-cnt.lft-mrg.t-mrg .header-all > div:first-child > div,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap > div.first-child > div,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap > div:first-child > div,
		body.pge-bxd-cnt.lft-mrg.t-mrg .header-all > div.first-child > div > div,
		body.pge-bxd-cnt.lft-mrg.t-mrg .header-all > div:first-child > div > div,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap > div.first-child > div > div,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap > div:first-child > div > div,
		body.pge-bxd-cnt.lft-mrg.v-space .footer-all .footer,
		body.pge-bxd-cnt.lft-mrg.v-space .footer-all .footer > div,
		body.pge-bxd-cnt.lft-mrg.v-space .footer-all .footer > div > div {
			border-top-left-radius: ' .  absint($options['page_rounded_corners']) . 'px;
		}
	'; // top left

	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-bxd-cnt.lft-mrg.b-mrg.ft-fix .footer-all .footer,

			body.pge-bxd-cnt.lft-mrg.b-mrg.ft-fix .footer-all .footer > div,
			body.pge-bxd-cnt.lft-mrg.b-mrg.ft-fix .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-bxd-cnt.lft-mrg.b-mrg.ft-fix .content-outer,

			body.pge-bxd-cnt.lft-mrg.b-mrg.ft-fix > div,
			body.pge-bxd-cnt.lft-mrg.b-mrg.ft-fix > div > div,
		';
	}
	echo '
		body.pge-bxd-cnt.lft-mrg.t-mrg .top-and-pop > div.last-child:not(.abso-on),
		body.pge-bxd-cnt.lft-mrg.t-mrg .top-and-pop > div:last-child,
		body.pge-bxd-cnt.lft-mrg.t-mrg .top-and-pop,
		body.pge-bxd-cnt.lft-mrg.v-space .header-all > div.last-child,
		body.pge-bxd-cnt.lft-mrg.v-space .header-all > div:last-child,
		body.pge-bxd-cnt.lft-mrg.v-space .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
		body.pge-bxd-cnt.lft-mrg.v-space .slider-wrap,
		body.pge-bxd-cnt.lft-mrg.v-space .slider-wrap .slider-inner,
		body.pge-bxd-cnt.lft-mrg.v-space .slider-wrap .rev_slider_wrapper .rev_slider ul > li,
		body.pge-bxd-cnt.lft-mrg.v-space .header-all,
		body.pge-bxd-cnt.lft-mrg.b-mrg .footer-all #subfooter,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap > div.last-child,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap > div:last-child,

		body.pge-bxd-cnt.lft-mrg.t-mrg .top-and-pop > div.last-child > div,
		body.pge-bxd-cnt.lft-mrg.t-mrg .top-and-pop > div:last-child > div,
		body.pge-bxd-cnt.lft-mrg.v-space .header-all > div.last-child > div,
		body.pge-bxd-cnt.lft-mrg.v-space .header-all > div:last-child > div,
		body.pge-bxd-cnt.lft-mrg.b-mrg .footer-all #subfooter > div,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap > div.last-child > div,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap > div:last-child > div,
		body.pge-bxd-cnt.lft-mrg.t-mrg .top-and-pop > div.last-child > div > div,
		body.pge-bxd-cnt.lft-mrg.t-mrg .top-and-pop > div:last-child > div > div,
		body.pge-bxd-cnt.lft-mrg.v-space .header-all > div.last-child > div > div,
		body.pge-bxd-cnt.lft-mrg.v-space .header-all > div:last-child > div > div,
		body.pge-bxd-cnt.lft-mrg.b-mrg .footer-all #subfooter > div > div,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap > div.last-child > div > div,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap > div:last-child > div > div,
		body.pge-bxd-cnt.lft-mrg.v-space .after-header-wrap {
			border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}';// bottom left
	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-bxd-cnt.rgt-mrg.v-space .footer-all .footer,

			body.pge-bxd-cnt.rgt-mrg.v-space .footer-all .footer > div,
			body.pge-bxd-cnt.rgt-mrg.v-space .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-bxd-cnt.rgt-mrg.v-space .footer-all #subfooter,

			body.pge-bxd-cnt.rgt-mrg.v-space .footer-all #subfooter > div,
			body.pge-bxd-cnt.rgt-mrg.v-space .footer-all #subfooter > div > div,
		';
	}

	echo '
		body.pge-bxd-cnt.rgt-mrg.t-mrg .header-all,
		body.pge-bxd-cnt.rgt-mrg.t-mrg .header-all > div.first-child,
		body.pge-bxd-cnt.rgt-mrg.t-mrg .header-all > div:first-child,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap > div.first-child,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap > div:first-child,
		body.pge-bxd-cnt.rgt-mrg.v-space .slider-wrap,
		body.pge-bxd-cnt.rgt-mrg.v-space .slider-wrap .slider-inner,
		body.pge-bxd-cnt.rgt-mrg.v-space .slider-wrap .rev_slider_wrapper .rev_slider ul > li,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap,

		body.pge-bxd-cnt.rgt-mrg.t-mrg .header-all > div.first-child > div,
		body.pge-bxd-cnt.rgt-mrg.t-mrg .header-all > div:first-child > div,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap > div.first-child > div,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap > div:first-child > div,
		body.pge-bxd-cnt.rgt-mrg.t-mrg .header-all > div.first-child > div > div,
		body.pge-bxd-cnt.rgt-mrg.t-mrg .header-all > div:first-child > div > div,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap > div.first-child > div > div,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap > div:first-child > div > div {
			border-top-right-radius: ' .  absint($options['page_rounded_corners']) . 'px;
		}'; // top right

	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-bxd-cnt.rgt-mrg.b-mrg.ft-fix .footer-all .footer,

			body.pge-bxd-cnt.rgt-mrg.b-mrg.ft-fix .footer-all .footer > div,
			body.pge-bxd-cnt.rgt-mrg.b-mrg.ft-fix .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-bxd-cnt.rgt-mrg.b-mrg.ft-fix .content-outer,

			body.pge-bxd-cnt.rgt-mrg.b-mrg.ft-fix > div,
			body.pge-bxd-cnt.rgt-mrg.b-mrg.ft-fix > div > div,
		';
	}

	echo '
		body.pge-bxd-cnt.rgt-mrg.t-mrg .top-and-pop > div.last-child:not(.abso-on),
		body.pge-bxd-cnt.rgt-mrg.t-mrg .top-and-pop > div:last-child,
		body.pge-bxd-cnt.rgt-mrg.t-mrg .top-and-pop,
		body.pge-bxd-cnt.rgt-mrg.b-mrg .footer-all #subfooter,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap > div.last-child,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap > div:last-child,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap,
		body.pge-bxd-cnt.rgt-mrg.v-space .header-all > div.last-child,
		body.pge-bxd-cnt.rgt-mrg.v-space .header-all > div:last-child,
		body.pge-bxd-cnt.rgt-mrg.v-space .header-all,
		body.pge-bxd-cnt.rgt-mrg.v-space .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
		body.pge-bxd-cnt.rgt-mrg.v-space .slider-wrap,
		body.pge-bxd-cnt.rgt-mrg.v-space .slider-wrap .slider-inner,
		body.pge-bxd-cnt.rgt-mrg.v-space .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

		body.pge-bxd-cnt.rgt-mrg.t-mrg .top-and-pop > div.last-child > div,
		body.pge-bxd-cnt.rgt-mrg.t-mrg .top-and-pop > div:last-child > div,
		body.pge-bxd-cnt.rgt-mrg.b-mrg .footer-all #subfooter > div,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap > div.last-child > div,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap > div:last-child > div,
		body.pge-bxd-cnt.rgt-mrg.v-space .header-all > div.last-child > div,
		body.pge-bxd-cnt.rgt-mrg.v-space .header-all > div:last-child > div,
		body.pge-bxd-cnt.rgt-mrg.t-mrg .top-and-pop > div.last-child > div > div,
		body.pge-bxd-cnt.rgt-mrg.t-mrg .top-and-pop > div:last-child > div > div,
		body.pge-bxd-cnt.rgt-mrg.b-mrg .footer-all #subfooter > div > div,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap > div.last-child > div > div,
		body.pge-bxd-cnt.rgt-mrg.v-space .after-header-wrap > div:last-child > div > div,
		body.pge-bxd-cnt.rgt-mrg.v-space .header-all > div.last-child > div > div,
		body.pge-bxd-cnt.rgt-mrg.v-space .header-all > div:last-child > div > div {
			border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}'; // bottom right
	}
?>

<?php
if ($options['page_layout'] == 'pge-fld') {

	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-fld.lft-mrg.v-space .footer-all .footer,

			body.pge-fld.lft-mrg.v-space .footer-all .footer > div,
			body.pge-fld.lft-mrg.v-space .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-fld.lft-mrg.v-space .footer-all #subfooter,

			body.pge-fld.lft-mrg.v-space .footer-all #subfooter > div,
			body.pge-fld.lft-mrg.v-space .footer-all #subfooter > div > div,
		';
	}
	echo '
		body.pge-fld.lft-mrg.t-mrg .header-all,
		body.pge-fld.lft-mrg.t-mrg .header-all > div.first-child,
		body.pge-fld.lft-mrg.t-mrg .header-all > div:first-child,
		body.pge-fld.lft-mrg.v-space .after-header-wrap > div.first-child,
		body.pge-fld.lft-mrg.v-space .after-header-wrap > div:first-child,
		body.pge-fld.lft-mrg.v-space .slider-wrap,
		body.pge-fld.lft-mrg.v-space .slider-wrap .slider-inner,
		body.pge-fld.lft-mrg.v-space .slider-wrap .rev_slider_wrapper .rev_slider ul > li,
		body.pge-fld.lft-mrg.v-space .after-header-wrap,
		body.pge-fld.lft-mrg.v-space .footer-all .footer,

		body.pge-fld.lft-mrg.t-mrg .header-all > div.first-child > div,
		body.pge-fld.lft-mrg.t-mrg .header-all > div:first-child > div,
		body.pge-fld.lft-mrg.v-space .after-header-wrap > div.first-child > div,
		body.pge-fld.lft-mrg.v-space .after-header-wrap > div:first-child > div,
		body.pge-fld.lft-mrg.v-space .footer-all .footer > div,
		body.pge-fld.lft-mrg.t-mrg .header-all > div.first-child > div > div,
		body.pge-fld.lft-mrg.t-mrg .header-all > div:first-child > div > div,
		body.pge-fld.lft-mrg.v-space .after-header-wrap > div.first-child > div > div,
		body.pge-fld.lft-mrg.v-space .after-header-wrap > div:first-child > div > div,
		body.pge-fld.lft-mrg.v-space .footer-all .footer > div > div  {
			border-top-left-radius: ' .  absint($options['page_rounded_corners']) . 'px;
		}'; // top left

	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-fld.lft-mrg.b-mrg.ft-fix .footer-all .footer,

			body.pge-fld.lft-mrg.b-mrg.ft-fix .footer-all .footer > div,
			body.pge-fld.lft-mrg.b-mrg.ft-fix .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-fld.lft-mrg.b-mrg.ft-fix .content-outer,

			body.pge-fld.lft-mrg.b-mrg.ft-fix > div,
			body.pge-fld.lft-mrg.b-mrg.ft-fix > div > div,
		';
	}
	echo '
		body.pge-fld.lft-mrg.t-mrg .top-and-pop > div.last-child:not(.abso-on),
		body.pge-fld.lft-mrg.t-mrg .top-and-pop > div:last-child,
		body.pge-fld.lft-mrg.t-mrg .top-and-pop,
		body.pge-fld.lft-mrg.v-space .header-all > div.last-child,
		body.pge-fld.lft-mrg.v-space .header-all > div:last-child,
		body.pge-fld.lft-mrg.v-space .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
		body.pge-fld.lft-mrg.v-space .slider-wrap,
		body.pge-fld.lft-mrg.v-space .slider-wrap .slider-inner,
		body.pge-fld.lft-mrg.v-space .slider-wrap .rev_slider_wrapper .rev_slider ul > li,
		body.pge-fld.lft-mrg.v-space .header-all,
		body.pge-fld.lft-mrg.b-mrg .footer-all #subfooter,
		body.pge-fld.lft-mrg.v-space .after-header-wrap > div.last-child,
		body.pge-fld.lft-mrg.v-space .after-header-wrap > div:last-child,
		body.pge-fld.lft-mrg.v-space .after-header-wrap,

		body.pge-fld.lft-mrg.t-mrg .top-and-pop > div.last-child > div,
		body.pge-fld.lft-mrg.t-mrg .top-and-pop > div:last-child > div,
		body.pge-fld.lft-mrg.v-space .header-all > div.last-child > div,
		body.pge-fld.lft-mrg.v-space .header-all > div:last-child > div,
		body.pge-fld.lft-mrg.b-mrg .footer-all #subfooter > div,
		body.pge-fld.lft-mrg.v-space .after-header-wrap > div.last-child > div,
		body.pge-fld.lft-mrg.v-space .after-header-wrap > div:last-child > div,
		body.pge-fld.lft-mrg.t-mrg .top-and-pop > div.last-child > div > div,
		body.pge-fld.lft-mrg.t-mrg .top-and-pop > div:last-child > div > div,
		body.pge-fld.lft-mrg.v-space .header-all > div.last-child > div > div,
		body.pge-fld.lft-mrg.v-space .header-all > div:last-child > div > div,
		body.pge-fld.lft-mrg.b-mrg .footer-all #subfooter > div > div,
		body.pge-fld.lft-mrg.v-space .after-header-wrap > div.last-child > div > div,
		body.pge-fld.lft-mrg.v-space .after-header-wrap > div:last-child > div > div {
			border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}';// bottom left

	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-fld.rgt-mrg.v-space .footer-all .footer,

			body.pge-fld.rgt-mrg.v-space .footer-all .footer > div,
			body.pge-fld.rgt-mrg.v-space .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-fld.rgt-mrg.v-space .footer-all #subfooter,

			body.pge-fld.rgt-mrg.v-space .footer-all #subfooter > div,
			body.pge-fld.rgt-mrg.v-space .footer-all #subfooter > div > div,
		';
	}

	echo '
		body.pge-fld.rgt-mrg.t-mrg .header-all,
		body.pge-fld.rgt-mrg.t-mrg .header-all > div.first-child,
		body.pge-fld.rgt-mrg.t-mrg .header-all > div:first-child,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap > div.first-child,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap > div:first-child,
		body.pge-fld.rgt-mrg.v-space .slider-wrap,
		body.pge-fld.rgt-mrg.v-space .slider-wrap .slider-inner,
		body.pge-fld.rgt-mrg.v-space .slider-wrap .rev_slider_wrapper .rev_slider ul > li,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap,

		body.pge-fld.rgt-mrg.t-mrg .header-all > div.first-child > div,
		body.pge-fld.rgt-mrg.t-mrg .header-all > div:first-child > div,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap > div.first-child > div,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap > div:first-child > div,

		body.pge-fld.rgt-mrg.t-mrg .header-all > div.first-child > div > div,
		body.pge-fld.rgt-mrg.t-mrg .header-all > div:first-child > div > div,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap > div.first-child > div > div,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap > div:first-child > div > div {
			border-top-right-radius: ' .  absint($options['page_rounded_corners']) . 'px;
		}'; // top right

	if ($options['footer_widget_area_layout'] != '') {
		echo '
			body.pge-fld.rgt-mrg.b-mrg.ft-fix .footer-all .footer,

			body.pge-fld.rgt-mrg.b-mrg.ft-fix .footer-all .footer > div,
			body.pge-fld.rgt-mrg.b-mrg.ft-fix .footer-all .footer > div > div,
		';
	}
	elseif ($options['footer_widget_area_layout'] == '') {
		echo '
			body.pge-fld.rgt-mrg.b-mrg.ft-fix .content-outer,

			body.pge-fld.rgt-mrg.b-mrg.ft-fix > div,
			body.pge-fld.rgt-mrg.b-mrg.ft-fix > div > div,
		';
	}

	echo '
		body.pge-fld.rgt-mrg.t-mrg .top-and-pop > div.last-child:not(.abso-on),
		body.pge-fld.rgt-mrg.t-mrg .top-and-pop > div:last-child,
		body.pge-fld.rgt-mrg.t-mrg .top-and-pop,
		body.pge-fld.rgt-mrg.b-mrg .footer-all #subfooter,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap > div.last-child,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap > div:last-child,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap,
		body.pge-fld.rgt-mrg.v-space .header-all > div.last-child,
		body.pge-fld.rgt-mrg.v-space .header-all > div:last-child,
		body.pge-fld.rgt-mrg.v-space .header-all,
		body.pge-fld.rgt-mrg.v-space .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
		body.pge-fld.rgt-mrg.v-space .slider-wrap,
		body.pge-fld.rgt-mrg.v-space .slider-wrap .slider-inner,
		body.pge-fld.rgt-mrg.v-space .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

		body.pge-fld.rgt-mrg.t-mrg .top-and-pop > div.last-child > div,
		body.pge-fld.rgt-mrg.t-mrg .top-and-pop > div:last-child > div,
		body.pge-fld.rgt-mrg.b-mrg .footer-all #subfooter > div,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap > div.last-child > div,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap > div:last-child > div,
		body.pge-fld.rgt-mrg.v-space .header-all > div.last-child > div,
		body.pge-fld.rgt-mrg.v-space .header-all > div:last-child > div,
		body.pge-fld.rgt-mrg.t-mrg .top-and-pop > div.last-child > div > div,
		body.pge-fld.rgt-mrg.t-mrg .top-and-pop > div:last-child > div > div,
		body.pge-fld.rgt-mrg.b-mrg .footer-all #subfooter > div > div,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap > div.last-child > div > div,
		body.pge-fld.rgt-mrg.v-space .after-header-wrap > div:last-child > div > div,
		body.pge-fld.rgt-mrg.v-space .header-all > div.last-child > div > div,
		body.pge-fld.rgt-mrg.v-space .header-all > div:last-child > div > div  {
			border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}'; // bottom right
	}
?>
<?php
	if (absint($options['page_rounded_corners']) != 2) {
		echo '
		.page-template-template-note-block-php .content-outer.left-intro-box,
		.tcs-block-outer.tcs-page-rounded {
			border-radius: ' . absint($options['page_rounded_corners']) . 'px;
		}'; // bottom right
	}
?>
<?php
	if ($options['page_layout'] == 'pge-mxd' && $options['page_layout_stretched_content']) {
		echo '
		body.pge-mxd.strch-cnt .after-header-wrap #intro,
		body.pge-mxd.strch-cnt .after-header-wrap #intro > div,
		body.pge-mxd.strch-cnt .after-header-wrap .content-outer,
		body.pge-mxd.strch-cnt .after-header-wrap .content-outer > div {
			border-radius: 0 !important;
			border-left-width: 0;
			border-right-width: 0;
		}'; // Allan
	}
?>

<?php /* Elements Radius */ ?>
.qtip.qtip-react {
	border-radius: <?php echo absint($options['element_rounded_corners']); ?>px !important;
}
<?php
	if (absint($options['element_rounded_corners']) != 2) {
		echo '

			.react.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab {
				border-radius: 0 ' . absint($options['element_rounded_corners']) . 'px ' . absint($options['element_rounded_corners']) . 'px ' . absint($options['element_rounded_corners']) . 'px;
			}
			.tcs-image-inner,
			.tcs-image.tcs-style1 .tcs-image-inner > img,
			.tcs-image.tcs-style2 .tcs-image-inner > img,
			.tcs-image.tcs-style3 .tcs-image-inner > img,
			.tcs-image.tcs-style4 .tcs-image-inner > img,
			.tcs-progress-label,
			.highlighted-text,
			.tcs-highlighted-text,
			mark,
			.react-woo-image-hover,
			.tcp-portfolio-hover,
			img.attachment-shop_thumbnail,
			img.wp-post-image,
			.tcp-portfolio-filter .tcp-filter-button,
			#intro.dark-box h2.intro-subtitle,
			#intro.dark-box h1.intro-title,
			#intro.dark-box .breadcrumbs,
			#intro.light-box h2.intro-subtitle,
			#intro.light-box h1.intro-title,
			#intro.light-box .breadcrumbs,
			#intro.alternate-box h1.intro-title,
			#intro.alternate-box h2.intro-subtitle,
			#intro.alternate-box .breadcrumbs,
			.tcs-block-outer.tcs-rounded,
			span.tcs-icon.tcs-boxed,
			.fancybox-skin,.fancybox-wrap,
			.fancybox-opened .fancybox-skin,
			.fancybox-type-image img,
			a.fancybox-close,
			a.fancybox-nav > span,
			.info-menu .fm-drop-down,
			ul.flag-list li,
			.widget_search input.searchsubmit,
			.device-menu-trigger-wrap.button-nav,
			.device-top-menu-trigger-wrap.button-nav,
			.device-menu-trigger,
			.device-top-menu-trigger,
			.button-nav ul.react-menu > li > a,
			ul.react-menu > li.button-nav > a,
			.flexible-frame,
			.button-nav.contact-details-top-head .method,
			.contact-info-drop,
			.back-home-icon.button a.back-home,
			.button-nav.contact-details-top-head .contact-info-drop-wrap a,
			.im-box-inner .search-container,
			.im-box.im-drop,
			.back-to-top,
			.go-down,
			.tcs-fancy-header.tcs-style2,
			.tcs-fancy-header.tcs-style3,
			.searchform label,
			.woocommerce.widget_product_search label,
			.tcs-button > a,
			.tcs-button > span.tcs-r-button,
			.tcs-has-drop .tcs-drop-content,
			.tcs-drop-close,
			.tcs-impact-header-link-wrap a.tcs-impact-link,
			.tcs-impact-header-link-wrap span.tcs-impact-link,
			.tcs-impact-header,
			.tcs-impact-header.tcs-dark,
			.tcs-impact-header.tcs-light,
			.tcs-impact-header.tcs-light .tcs-impact-header-link-wrap a.tcs-impact-link,
			.tcs-impact-header.tcs-light .tcs-impact-header-link-wrap span.tcs-impact-link,
			.tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap a.tcs-impact-link,
			.tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap span.tcs-impact-link,
			a.basic-button, a.tcp-basic-button, .tcw-follow-me-button a,
			.custom-boxed-item,
			.tcs-box.tcs-box-custom-boxed-item,
			.tcs-tabs.tcs-boxed .tcs-tab-content,
			.tagcloud > a,
			.read-more-link .more-link,
			.comments-link a,
			.entry-info .post-icon,
			.entry-info .date,
			.tcp-entry-info .tcp-date,
			#fancybox-loading,
			.form-submit input,
			.tcs-tabs ul.tcs-tabs-nav li a,
			ul#comment-tabs-nav li a,
			#fancybox-content,
			.react-vote,
			.wp-pagenavi span,
			.tcp-portfolio .wp-pagenavi span,
			.wp-pagenavi a,
			.tcp-portfolio .wp-pagenavi a,
			.comments-pagination-wrap a.page-numbers,
			.comments-pagination-wrap span.page-numbers,
			.fancybox-image,
			.im-box-inner ul.wp-tag-cloud li a,
			.tagcloud > a,
			#footer-logo-info-wrap,
			.tcs-button.tcs-has-drop .tcs-open-drop-trigger,
			.tcs-cycle-controls-wrap a,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-text input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-captcha input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-email input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-password input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap select,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap textarea,
			.iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-theme-react-default .iphorm-group-elements,
			.iphorm-theme-react-default .iphorm-upload-queue-file,
			.iphorm-theme-react-default .iphom-upload-progress-wrap,
			.iphorm-theme-react-default .iphorm-submit-wrap button span,
			.iphorm-theme-react-default .iphorm-swfupload-browse,
			.iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button,
			div.comment,
			ol.commentlist > li > ul.children,
			.comments ul.children li,
			.comments ul.children div.comment .reply a,
			.comments div.comment .reply a,
			.logged-in-as,
			#commentform input[type="text"],
			.searchform input[type="text"],
			.woocommerce.widget_product_search input[type="search"],
			#commentform select,
			#commentform textarea,
			.widget_archive select,
			.widget_categories select,
			.textwidget select,
			.textwidget input,
			#open-close-close,
			.x-close,
			a:hover .x-close,
			body:not(.blg-bxd) #content > div.entry.sticky,
			.blg-bxd.search-results #content div.post.entry,
			.blg-bxd.search-results #content div.page.entry,
			.blg-bxd.search-results #content div.product.entry,
			.blg-bxd.search-results #content div.portfolio.entry,
			.blg-bxd.archive #content div.post.entry,
			.blg-bxd.blog #content div.post.entry,
			.sdbr-bxd #sidebar .widget,
			.pop-bxd .popdown .widget,
			.foot-bxd .footer .widget,
			#comments .comment-respond h3#reply-title,
			#comments .comment-respond,
			.comments ul.children,
			.ls-reactskin .ls-nav-start,
			.ls-reactskin .ls-nav-start.ls-nav-start-active,
			.ls-reactskin .ls-nav-stop,
			.ls-reactskin .ls-nav-stop.ls-nav-active,
			.tcs-blockquote .tcs-blockquote-inner,
			blockquote,

			.react.vc_call_to_action,
			.react.vc_separator h4,
			.react.wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header,
			.react.wpb_tour.wpb_content_element .wpb_tabs_nav li,
			.react .wpb_tour_next_prev_nav a,
			.react.vc_progress_bar .vc_single_bar,
			.react.vc_progress_bar .vc_single_bar .vc_bar,
			.react .vc-carousel-control .icon-prev,
			.react .vc-carousel-control .icon-next,
			.react .flex-direction-nav a.flex-next,
			.react .flex-direction-nav a.flex-prev,
			.react .theme-default .nivo-directionNav a,

			.tcs-box.tcs-box-basic,
			.tcs-box.tcs-box-basic-light,
			.tcs-box.tcs-box-basic-dark,
			.tcw-tweet-light li,
			.tcw-tweet-dark li,
			.info,
			.success,
			.warning,
			.error,
			body.pop-trig-abso #popdown-trigger,
			.dismissed #popdown-trigger,
			.tcs-box.tcs-box-warning,
			.comment-awaiting-moderation,
			.search-container,
			.slider-wrap .ls-reactskin .ls-nav-start,
			.slider-wrap .ls-reactskin .ls-nav-stop,
			.widget-area .ls-reactskin .ls-nav-start,
			.widget-area .ls-reactskin .ls-nav-stop,
			.ls-reactskin .ls-nav-start,
			.ls-reactskin .ls-nav-stop,

			.desc-hover ul.react-menu li a span.desc,
			.im-trigger span.im-desc,

			.sidr .menu-item-has-children .sidr-menu-toggle,

			.tcs-menu ul li a,
			.tcs-menu ul.menu li a,

			.ls-reactskin a.ls-nav-next,
			.ls-reactskin a.ls-nav-prev,
			.widget-area .ls-reactskin a.ls-nav-next,
			.widget-area .ls-reactskin a.ls-nav-prev,
			.slider-wrap .ls-reactskin a.ls-nav-next,
			.slider-wrap .ls-reactskin a.ls-nav-prev,
			.rev_slider_wrapper .tp-rightarrow.custom,
			.rev_slider_wrapper .tp-leftarrow.custom,
			.contact-type-wrap,
			.hidden-map,
			.tcw-widget-post-thumb-link img,

			.iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
			a.fancybox-nav > span, .featured-image-wrap, .tcp-featured-image-wrap, .tcs-image.tcs-style1 > img, .tcs-image.tcs-style2 > img, .tcs-image.tcs-style3 > img, .tcs-image.tcs-style4 > img {
				border-radius: ' . absint($options['element_rounded_corners']) . 'px;
			}
			';
			if ($rtl) {
			echo '
					.tcs-accordion.tcs-box > h3 {
						border-radius: ' . absint($options['element_rounded_corners']) . 'px 0 0 ' . absint($options['element_rounded_corners']) . 'px;
					}
					.tcs-accordion.tcs-box > h3 span.tcs-acc-icon {
						border-radius: 0 ' . absint($options['element_rounded_corners']) . 'px ' . absint($options['element_rounded_corners']) . 'px 0;
					}
					#content > .entry .entry-info > div:first-child {
						border-top-right-radius: ' . absint($options['element_rounded_corners']) . 'px !important;
					}
				';
			} else {
				echo '
					.tcs-accordion.tcs-box > h3 {
						border-radius: 0 ' . absint($options['element_rounded_corners']) . 'px ' . absint($options['element_rounded_corners']) . 'px 0;
					}
					.tcs-accordion.tcs-box > h3 span.tcs-acc-icon {
						border-radius: ' . absint($options['element_rounded_corners']) . 'px 0 0 ' . absint($options['element_rounded_corners']) . 'px;
					}
				';

			}
			echo '

			.react.wpb_content_element .wpb_tabs_nav li, #subfooter-toggle {
				border-radius: ' . absint($options['element_rounded_corners']) . 'px ' . absint($options['element_rounded_corners']) . 'px 0 0;
			}

			.tcp-boxed.tcp-portfolio .tcp-featured-image-above .tcp-featured-image,
			.tcp-boxed.tcp-portfolio .tcp-featured-image-above .tcp-portfolio-hover,
			.tcp-boxed.tcp-portfolio .tcp-featured-image-above .tcp-featured-image > img {
				border-top-right-radius: ' .  absint($options['element_rounded_corners']) . 'px;
				border-top-left-radius: ' . absint($options['element_rounded_corners']) . 'px;
			}

			.flexible-frame.map .map-cover.hide:after,
			ul.react-menu ul li:first-child,
			ul.react-menu ul li:first-child a,
			ul.react-menu ul,
			.sdbr-bxd.wgt-undrln #sidebar .widget h3.widget-title,
			.pop-bxd.wgt-undrln .popdown .widget h3.widget-title,
			.foot-bxd.wgt-undrln .footer .widget h3.widget-title,
			.iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements .iphorm-group-title-description-wrap {
				border-top-right-radius: ' . absint($options['element_rounded_corners']) . 'px;
				border-top-left-radius: ' . absint($options['element_rounded_corners']) . 'px;
			}
			ul.react-menu ul li:last-child,
			ul.react-menu ul li:last-child a,
			ul.react-menu ul,
			.tcp-boxed .tcp-portfolio-details {
				border-bottom-right-radius: ' . absint($options['element_rounded_corners']) . 'px;
				border-bottom-left-radius: ' . absint($options['element_rounded_corners']) . 'px;
			}
			.info-menu .im-button.info-menu-ul > li:first-child,
			.info-menu .im-button.info-menu-ul > li:first-child > a,
			.tcs-image-carousel-wrap .tcs-carousel-next,
			.im-box .search-input-wrap input,
			.socialcount > li:first-child a,
			.socialcount > li.first-child a,
			.search-container .search-input,
			.search-container .search-input-wrap input {
				border-top-left-radius: ' . absint($options['element_rounded_corners']) . 'px;
				border-bottom-left-radius: ' . absint($options['element_rounded_corners']) . 'px;
			}
			.search-button-wrap input, .widget_search input.searchsubmit,
			.widget_search .searchform input.searchsubmit, .woocommerce.widget_product_search input[type="submit"],
			.info-menu .im-button.info-menu-ul > li:last-child,
			.info-menu .im-button.info-menu-ul > li:last-child > a,
			.tcs-image-carousel-wrap .tcs-carousel-prev,
			.socialcount > li:last-child a,
			.socialcount > li.last-child a {
				border-top-right-radius: ' . absint($options['element_rounded_corners']) . 'px;
				border-bottom-right-radius: ' .  absint($options['element_rounded_corners']) . 'px;
			}




			.tcs-menu ul li a,
			.info-menu .im-button.info-menu-ul > li:first-child:last-child,
			.info-menu .im-button.info-menu-ul > li:first-child:last-child > a,
			.info-menu .im-button.info-menu-ul > li.first-child.last-child,
			.info-menu .im-button.info-menu-ul > li.first-child.last-child > a {
				border-radius: ' . absint($options['element_rounded_corners']) . 'px;
			}
			.tcs-menu.tcs-inline.tcs-grouped ul li a,
			.tcs-menu.tcs-stacked.tcs-grouped ul li a,
			.tcs-menu.tcs-inline.tcs-grouped ul.menu li a,
			.tcs-menu.tcs-stacked.tcs-grouped ul.menu li a,
			.tcs-menu.tcs-inline.tcs-grouped ul.menu ul.sub-menu li a,
			.tcs-menu.tcs-stacked.tcs-grouped ul.menu ul.sub-menu li a,
			body.full-width .tcs-block-outer.tcs-rounded.tcs-fullwidth,
			body.full-width .tcs-block-outer.tcs-page-rounded.tcs-fullwidth {
				border-radius: 0;
			}

			body.right-sidebar .tcs-block-outer.tcs-rounded.tcs-fullwidth,
			body.right-sidebar .tcs-block-outer.tcs-page-rounded.tcs-fullwidth {
				border-bottom-left-radius: 0;
				border-top-left-radius: 0;
			}
			body.left-sidebar .tcs-block-outer.tcs-rounded.tcs-fullwidth,
			body.left-sidebar .tcs-block-outer.tcs-page-rounded.tcs-fullwidth {
				border-bottom-right-radius: 0;
				border-top-right-radius: 0;
			}


			.tcs-menu.tcs-inline.tcs-grouped ul li a, .tcs-menu.tcs-stacked.tcs-grouped ul li a,
			.tcs-menu.tcs-inline.tcs-grouped ul.menu li a, .tcs-menu.tcs-stacked.tcs-grouped ul.menu li a,
			.tcs-menu.tcs-inline.tcs-grouped ul.menu ul.sub-menu li a, .tcs-menu.tcs-stacked.tcs-grouped ul.menu ul.sub-menu li a {
				border-radius: 0;
			}


			.tcs-menu.tcs-inline.tcs-grouped ul li:first-child a,
			.tcs-menu.tcs-inline.tcs-grouped ul.menu li:first-child a,
			.tcs-menu.tcs-inline.tcs-grouped ul.menu li.menu-item-has-children > a{
				border-radius: ' . absint($options['element_rounded_corners']) . 'px 0 0 ' . absint($options['element_rounded_corners']) . 'px;
			}
			.tcs-menu.tcs-inline.tcs-grouped ul.menu li.menu-item-has-children ul.sub-menu li:first-child a {
				border-radius: 0;
			}
			.tcs-menu.tcs-inline.tcs-grouped ul li:last-child > a,
			.tcs-menu.tcs-inline.tcs-grouped ul.menu li:last-child > a,
			.tcs-menu.tcs-inline.tcs-grouped ul.menu li.menu-item-has-children ul.sub-menu li:last-child a {
				border-radius: 0 ' . absint($options['element_rounded_corners']) . 'px ' . absint($options['element_rounded_corners']) . 'px 0;
			}



			.tcs-menu.tcs-stacked.tcs-grouped ul.menu > li.menu-item-has-children + li > a {
				border-top-left-radius: ' . absint($options['element_rounded_corners']) . 'px;
				border-top-right-radius: ' . absint($options['element_rounded_corners']) . 'px;
			}
			.tcs-menu.tcs-stacked.tcs-grouped ul li:first-child a,
			.tcs-menu.tcs-stacked.tcs-grouped ul.menu li:first-child a,
			.tcs-menu.tcs-stacked.tcs-grouped ul.menu li.menu-item-has-children > a {
				border-top-left-radius: ' . absint($options['element_rounded_corners']) . 'px;
				border-top-right-radius: ' . absint($options['element_rounded_corners']) . 'px;
			}
			.tcs-menu.tcs-stacked.tcs-grouped ul.menu li.menu-item-has-children ul.sub-menu li a  {
				border-radius: 0;
			}
			.tcs-menu.tcs-stacked.tcs-grouped ul li:last-child > a,
			.tcs-menu.tcs-stacked.tcs-grouped ul.menu li:last-child > a,
			.tcs-menu.tcs-stacked.tcs-grouped ul.menu li.menu-item-has-children ul.sub-menu li:last-child a {
				border-bottom-left-radius: ' . absint($options['element_rounded_corners']) . 'px;
				border-bottom-right-radius: ' . absint($options['element_rounded_corners']) . 'px;
			}



			.tcs-menu.tcs-menu-separator.tcs-inline.tcs-grouped ul li a,
			.tcs-menu.tcs-menu-separator.tcs-stacked.tcs-grouped ul li a,
			.tcs-menu.tcs-menu-separator.tcs-inline.tcs-grouped ul.menu li a,
			.tcs-menu.tcs-menu-separator.tcs-stacked.tcs-grouped ul.menu li a {
				border-radius: 0;
			}
			.tcs-fancy-header.tcs-fullwidth,
			.tcs-menu.tcs-menu-separator.tcs-stacked ul li a {
				border-radius: 0;
			}


			.tcp-portfolio.tcp-boxed .tcp-portfolio-item .tcp-entry-info > div:first-child, .tcp-portfolio.tcp-boxed .tcp-portfolio-item .tcp-entry-info > span:first-child {
				border-radius: 0 ' . absint($options['element_rounded_corners']) . 'px 0 0;
			}
			.tcp-portfolio.tcp-boxed.tcp-date-like-above .tcp-portfolio-item .tcp-entry-info > div:first-child, .tcp-portfolio.tcp-boxed.tcp-date-like-above .tcp-portfolio-item .tcp-entry-info > span:first-child {
				border-radius: ' . absint($options['element_rounded_corners']) . 'px 0 0 0;
			}
			.tcp-portfolio.tcp-boxed .tcp-portfolio-item .tcp-entry-info > div:last-child, .tcp-portfolio.tcp-boxed .tcp-portfolio-item .tcp-entry-info > span:last-child {
				border-bottom-left-radius: ' . absint($options['element_rounded_corners']) . 'px;
				margin-bottom: 0;
				border-bottom: none 0;
			}
			.tcp-portfolio.tcp-boxed.tcp-date-like-left .tcp-portfolio-item .tcp-entry-info > div:last-child, .tcp-portfolio.tcp-boxed.tcp-date-like-left .tcp-portfolio-item .tcp-entry-info > span:last-child {
				border-bottom-right-radius: ' . absint($options['element_rounded_corners']) . 'px;
				border-bottom-left-radius: 0;
			}
			.tcp-portfolio.tcp-boxed.tcp-date-like-above .tcp-portfolio-item .tcp-entry-info > div:last-child, .tcp-portfolio.tcp-boxed.tcp-date-like-above .tcp-portfolio-item .tcp-entry-info > span:last-child {
				border-radius: 0 ' . absint($options['element_rounded_corners']) . 'px ' . absint($options['element_rounded_corners']) . 'px 0;
			}
			.tcp-portfolio.tcp-date-like-above .tcp-portfolio-item .tcp-entry-info > div:only-child, .tcp-portfolio.tcp-date-like-above .tcp-portfolio-item .tcp-entry-info > span:only-child {
				border-top-left-radius: ' . absint($options['element_rounded_corners']) . 'px;
			}



		';
	}
?>




<?php /* THIS FIXES THE BORDER WHEN GOING LEFT MRG OVER RIDES RIGHT BUT THEN HITS SIDE WALL 101 */ ?>

<?php
	if ($options['page_layout'] == 'pge-bxd' || $options['page_layout'] == 'pge-mxd') {

		if ($options['page_layout_left_margin'] == 0) {
			echo '
				body.lft-mrg .after-header-wrap > div:last-child,
				body.lft-mrg .after-header-wrap > div:last-child,
				body.lft-mrg .header-all > div:last-child,
				body.lft-mrg .top-and-pop > div:last-child,
				body.lft-mrg .header-all > div:last-child > div,
				body.lft-mrg .after-header-wrap > div:last-child > div,
				body.lft-mrg .top-and-pop > div:last-child > div,
				body.lft-mrg .header-all > div:last-child > div > div,
				body.lft-mrg .top-and-pop > div:last-child > div > div {
					border-top-left-radius: 0 !important;
					border-bottom-left-radius: 0 !important;
					border-left: none 0 !important;
				}
				body.lft-mrg .footer-all,
				body.lft-mrg .footer-all .footer,
				body.lft-mrg .footer-all .footer,

				body.lft-mrg .footer-all #subfooter,
				body.lft-mrg .footer-all #subfooter,

				body.lft-mrg .header-all,
				body.lft-mrg .header-all > div.first-child,
				body.lft-mrg .header-all > div:first-child,

				body.lft-mrg .after-header-wrap,
				body.lft-mrg .after-header-wrap > div.first-child,
				body.lft-mrg .after-header-wrap > div:first-child,

				body.lft-mrg .after-header-wrap,
				body.lft-mrg .after-header-wrap > div.last-child,

				body.lft-mrg .after-header-wrap,
				body.lft-mrg .after-header-wrap > div.last-child,

				body.lft-mrg .header-all,
				body.lft-mrg .header-all > div.last-child,

				body.lft-mrg .top-and-pop,
				body.lft-mrg .top-and-pop .popdown,
				body.lft-mrg .top-and-pop > div.last-child:not(.abso-on),

				body.lft-mrg .footer-all .footer > div,
				body.lft-mrg .footer-all .footer > div,

				body.lft-mrg .footer-all #subfooter > div,
				body.lft-mrg .footer-all #subfooter > div,

				body.lft-mrg .header-all > div.first-child > div,
				body.lft-mrg .header-all > div:first-child > div,

				body.lft-mrg .header-all > div.last-child > div,

				body.lft-mrg .after-header-wrap > div.first-child > div,
				body.lft-mrg .after-header-wrap > div:first-child > div,

				body.lft-mrg .after-header-wrap > div.last-child > div,

				body.lft-mrg .top-and-pop > div.last-child:not(#popdown-trigger) > div,

				body.lft-mrg .footer-all .footer > div > div,
				body.lft-mrg .footer-all .footer > div > div,

				body.lft-mrg .footer-all #subfooter > div > div,
				body.lft-mrg .footer-all #subfooter > div > div,

				body.lft-mrg .header-all > div.first-child > div > div,
				body.lft-mrg .header-all > div:first-child > div > div,

				body.lft-mrg .header-all > div.last-child > div > div,

				body.lft-mrg .after-header-wrap > div.first-child > div > div,
				body.lft-mrg .after-header-wrap > div:first-child > div > div,

				body.lft-mrg .top-and-pop > div.last-child > div > div,

				body.lft-mrg .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
				body.lft-mrg .slider-wrap,
				body.lft-mrg .slider-wrap .slider-inner,
				body.lft-mrg .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

				body.pge-bxd.lft-mrg.ft-fix.b-mrg .footer-all #subfooter,
				body.pge-mxd.lft-mrg.ft-fix.b-mrg .footer-all #subfooter {
					border-top-left-radius: 0 !important;
					border-bottom-left-radius: 0 !important;
					border-left: none 0 !important;
				}'; // top left, bottom left - removes radius for no margin in tablets

			}
		}
	?>





	<?php
	if ($options['page_layout'] == 'pge-bxd' || $options['page_layout'] == 'pge-mxd') {

		if ($options['page_layout_right_margin'] == 0 && $options['page_layout_left_margin'] == -1) {

				if ($boxWidth <= absint($tabletLdsp)) {// this means border doens't get removed if the box is smaller than laptops. and left is overiding right

					if ($options['page_layout_left_margin_tablets'] == 0 || ($options['page_layout_left_margin_tablets'] == -1 && $options['page_layout_left_margin'] == 0)) {
						if ($options['page_layout_right_margin_tablets'] == 0 || ($options['page_layout_right_margin_tablets'] == -1 && $options['page_layout_right_margin'] == 0)) {
							echo '@media only screen and (min-width: ' . (absint($tabletLdsp) + 1) . 'px) {
							';
						}
					}
				}

			echo '
				body .after-header-wrap > div:last-child,
				body .after-header-wrap > div:last-child,
				body .header-all > div:last-child,
				body .top-and-pop > div:last-child,
				body .header-all > div:last-child > div,
				body .after-header-wrap > div:last-child > div,
				body .top-and-pop > div:last-child > div,
				body .header-all > div:last-child > div > div,
				body .after-header-wrap > div:last-child > div > div,
				body .top-and-pop > div:last-child > div > div {
						border-top-right-radius: 0 !important;
						border-bottom-right-radius: 0 !important;
						border-right: none 0 !important;
				}

				body .footer-all,
				body .footer-all .footer,
				body .footer-all .footer,

				body .header-all,
				body .header-all > div.first-child,
				body .header-all > div:first-child,

				body .after-header-wrap,
				body .after-header-wrap > div.first-child,
				body .after-header-wrap > div:first-child,

				body .after-header-wrap,
				body .after-header-wrap > div.last-child,

				body .after-header-wrap,
				body .after-header-wrap > div.last-child,

				body .header-all,
				body .header-all > div.last-child,

				body .top-and-pop,
				body .top-and-pop .popdown,
				body .top-and-pop > div.last-child:not(.abso-on),

				body .footer-all .footer > div,
				body .footer-all .footer > div,

				body .header-all > div.first-child > div,
				body .header-all > div:first-child > div,

				body .header-all > div.last-child > div,

				body .after-header-wrap > div.first-child > div,
				body .after-header-wrap > div:first-child > div,

				body .after-header-wrap > div.last-child > div,

				body .top-and-pop > div.last-child > div,

				body .footer-all .footer > div > div,
				body .footer-all .footer > div > div,

				body .header-all > div.first-child > div > div,
				body .header-all > div:first-child > div > div,

				body .header-all > div.last-child > div > div,

				body .after-header-wrap > div.first-child > div > div,
				body .after-header-wrap > div:first-child > div > div,

				body .after-header-wrap > div.last-child > div > div,

				body .top-and-pop > div.last-child > div > div,


				body.v-mrg .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
				body .slider-wrap,
				body .slider-wrap .slider-inner,
				body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

				body.pge-bxd.ft-fix.b-mrg .footer-all #subfooter,
				body.pge-mxd.ft-fix.b-mrg .footer-all #subfooter,
				body .footer-all #subfooter,
				body .footer-all #subfooter,
				body .footer-all #subfooter > div > div,
				body .footer-all #subfooter > div > div,
				body .footer-all #subfooter > div,
				body .footer-all #subfooter > div {
					border-top-right-radius: 0 !important;
					border-bottom-right-radius: 0 !important;
					border-right: none 0 !important;
				}'; // top rgt, bottom rgt - removes radius for no margin in tablets

			if ($boxWidth <= absint($tabletLdsp)) {

				if ($options['page_layout_left_margin_tablets'] == 0 || ($options['page_layout_left_margin_tablets'] == -1 && $options['page_layout_left_margin'] == 0)) {
					if ($options['page_layout_right_margin_tablets'] == 0 || ($options['page_layout_right_margin_tablets'] == -1 && $options['page_layout_right_margin'] == 0)) {
						echo '}
						';
					}
				}
			}
		}
	}
?>




<?php /* From the momenet the sides meet the box to break rounded corners and border. The merging fase. */ ?>
<?php
if ($options['page_layout'] == 'pge-bxd' || $options['page_layout'] == 'pge-mxd') {

	if ($boxWidth >= absint($tabletLdsp)) {

	echo '@media only screen and (min-width: ' . (absint($tabletLdsp) + 1) . 'px) and (max-width:  ' . (absint($boxWidth) + 2) . 'px) {
	';
		if ($options['page_layout_left_margin'] == -1) {

			echo '
			body .after-header-wrap > div:last-child,
			body .after-header-wrap > div:last-child,
			body .header-all > div:last-child,
			body .top-and-pop > div:last-child,
			body .header-all > div:last-child > div,
			body .after-header-wrap > div:last-child > div,
			body .top-and-pop > div:last-child > div,
			body .header-all > div:last-child > div > div,
			body .after-header-wrap > div:last-child > div > div,
			body .top-and-pop > div:last-child > div > div {
				border-top-left-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
				border-left: none 0 !important;
			}
			body .footer-all,
			body .footer-all .footer,
			body .footer-all .footer,

			body .footer-all #subfooter,
			body .footer-all #subfooter,

			body .header-all,
			body .header-all > div.first-child,
			body .header-all > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.first-child,
			body .after-header-wrap > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .header-all,
			body .header-all > div.last-child,

			body .top-and-pop,
			body .top-and-pop .popdown,
			body .top-and-pop > div.last-child:not(.abso-on),

			body .footer-all .footer > div,
			body .footer-all .footer > div,

			body .footer-all #subfooter > div,
			body .footer-all #subfooter > div,

			body .header-all > div.first-child > div,
			body .header-all > div:first-child > div,

			body .header-all > div.last-child > div,

			body .after-header-wrap > div.first-child > div,
			body .after-header-wrap > div:first-child > div,

			body .after-header-wrap > div.last-child > div,

			body .top-and-pop > div.last-child > div,

			body .footer-all .footer > div > div,
			body .footer-all .footer > div > div,

			body .footer-all #subfooter > div > div,
			body .footer-all #subfooter > div > div,

			body .header-all > div.first-child > div > div,
			body .header-all > div:first-child > div > div,

			body .header-all > div.last-child > div > div,

			body .after-header-wrap > div.first-child > div > div,
			body .after-header-wrap > div:first-child > div > div,

			body .after-header-wrap > div.last-child > div > div,

			body .top-and-pop > div.last-child > div > div,


			body .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
			body .slider-wrap,
			body .slider-wrap .slider-inner,
			body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

			body.pge-bxd.ft-fix.b-mrg .footer-all #subfooter,
			body.pge-mxd.ft-fix.b-mrg .footer-all #subfooter {
				border-top-left-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
				border-left: none 0 !important;
			}'; // top left, bottom left - removes radius for no margin in tablets

		}
		if ($options['page_layout_right_margin'] == -1 || ($options['page_layout_right_margin'] == 0 && $options['page_layout_left_margin'] > -1)) {

			echo '
			body .after-header-wrap > div:last-child,
			body .after-header-wrap > div:last-child,
			body .header-all > div:last-child,
			body .top-and-pop > div:last-child,
			body .header-all > div:last-child > div,
			body .after-header-wrap > div:last-child > div,
			body .top-and-pop > div:last-child > div,
			body .header-all > div:last-child > div > div,
			body .after-header-wrap > div:last-child > div > div,
			body .top-and-pop > div:last-child > div > div {
				border-top-right-radius: 0 !important;
				border-bottom-right-radius: 0 !important;
				border-right: none 0 !important;
			}
			body .footer-all,
			body .footer-all .footer,
			body .footer-all .footer,

			body .footer-all #subfooter,
			body .footer-all #subfooter,

			body .header-all,
			body .header-all > div.first-child,
			body .header-all > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.first-child,
			body .after-header-wrap > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .header-all,
			body .header-all > div.last-child,

			body .top-and-pop,
			body .top-and-pop .popdown,
			body .top-and-pop > div.last-child:not(.abso-on),

			body .footer-all .footer > div,
			body .footer-all .footer > div,

			body .footer-all #subfooter > div,
			body .footer-all #subfooter > div,

			body .header-all > div.first-child > div,
			body .header-all > div:first-child > div,

			body .header-all > div.last-child > div,

			body .after-header-wrap > div.first-child > div,
			body .after-header-wrap > div:first-child > div,

			body .after-header-wrap > div.last-child > div,

			body .top-and-pop > div.last-child > div,

			body .footer-all .footer > div > div,
			body .footer-all .footer > div > div,

			body .footer-all #subfooter > div > div,
			body .footer-all #subfooter > div > div,

			body .header-all > div.first-child > div > div,
			body .header-all > div:first-child > div > div,

			body .header-all > div.last-child > div > div,

			body .after-header-wrap > div.first-child > div > div,
			body .after-header-wrap > div:first-child > div > div,

			body .after-header-wrap > div.last-child > div > div,

			body .top-and-pop > div.last-child > div > div,


			body .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
			body .slider-wrap,
			body .slider-wrap .slider-inner,
			body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

			body.pge-bxd.b-mrg .footer-all #subfooter,
			body.pge-mxd.b-mrg .footer-all #subfooter {
				border-top-right-radius: 0 !important;
				border-bottom-right-radius: 0 !important;
				border-right: none 0 !important;
			}'; // top right, bottom right - removes radius for no margin in tablets
		}
		echo '}';

		echo '@media only screen and (min-width: ' . (absint($phoneLdsp) + 1) . 'px) and (max-width:  ' . (absint($tabletLdsp) - 1) . 'px) {
		';

			if ($options['page_layout_left_margin_tablets'] == 0 || ($options['page_layout_left_margin_tablets'] == -1 && $options['page_layout_left_margin'] < 1)) {

			echo '
			body .after-header-wrap > div:last-child,
			body .after-header-wrap > div:last-child,
			body .header-all > div:last-child,
			body .top-and-pop > div:last-child,
			body .header-all > div:last-child > div,
			body .after-header-wrap > div:last-child > div,
			body .top-and-pop > div:last-child > div,
			body .header-all > div:last-child > div > div,
			body .after-header-wrap > div:last-child > div > div,
			body .top-and-pop > div:last-child > div > div {
				border-top-left-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
				border-left: none 0 !important;
			}
			body .footer-all,
			body .footer-all .footer,
			body .footer-all .footer,

			body .footer-all #subfooter,
			body .footer-all #subfooter,

			body .header-all,
			body .header-all > div.first-child,
			body .header-all > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.first-child,
			body .after-header-wrap > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .header-all,
			body .header-all > div.last-child,

			body .top-and-pop,
			body .top-and-pop .popdown,
			body .top-and-pop > div.last-child:not(.abso-on),

			body .footer-all .footer > div,
			body .footer-all .footer > div,

			body .footer-all #subfooter > div,
			body .footer-all #subfooter > div,

			body .header-all > div.first-child > div,
			body .header-all > div:first-child > div,

			body .header-all > div.last-child > div,

			body .after-header-wrap > div.first-child > div,
			body .after-header-wrap > div:first-child > div,

			body .after-header-wrap > div.last-child > div,

			body .top-and-pop > div.last-child > div,

			body .footer-all .footer > div > div,
			body .footer-all .footer > div > div,

			body .footer-all #subfooter > div > div,
			body .footer-all #subfooter > div > div,

			body .header-all > div.first-child > div > div,
			body .header-all > div:first-child > div > div,

			body .header-all > div.last-child > div > div,

			body .after-header-wrap > div.first-child > div > div,
			body .after-header-wrap > div:first-child > div > div,

			body .after-header-wrap > div.last-child > div > div,

			body .top-and-pop > div.last-child > div > div,


			body .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
			body .slider-wrap,
			body .slider-wrap .slider-inner,
			body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

			body.pge-bxd.ft-fix.b-mrg .footer-all #subfooter,
			body.pge-mxd.ft-fix.b-mrg .footer-all #subfooter {
				border-top-left-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
				border-left: none 0 !important;
			}'; // top left, bottom left - removes radius for no margin in tablets

		}
		if ($options['page_layout_right_margin_tablets'] == 0 || ($options['page_layout_right_margin_tablets'] == -1 && $options['page_layout_right_margin'] < 1)) {

			echo '
			body .after-header-wrap > div:last-child,
			body .after-header-wrap > div:last-child,
			body .header-all > div:last-child,
			body .top-and-pop > div:last-child,
			body .header-all > div:last-child > div,
			body .after-header-wrap > div:last-child > div,
			body .top-and-pop > div:last-child > div,
			body .header-all > div:last-child > div > div,
			body .after-header-wrap > div:last-child > div > div,
			body .top-and-pop > div:last-child > div > div {
				border-top-right-radius: 0 !important;
				border-bottom-right-radius: 0 !important;
				border-right: none 0 !important;
			}

			body .footer-all,
			body .footer-all .footer,
			body .footer-all .footer,

			body .footer-all #subfooter,
			body .footer-all #subfooter,

			body .header-all,
			body .header-all > div.first-child,
			body .header-all > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.first-child,
			body .after-header-wrap > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .header-all,
			body .header-all > div.last-child,

			body .top-and-pop,
			body .top-and-pop .popdown,
			body .top-and-pop > div.last-child:not(.abso-on),

			body .footer-all .footer > div,
			body .footer-all .footer > div,

			body .footer-all #subfooter > div,
			body .footer-all #subfooter > div,

			body .header-all > div.first-child > div,
			body .header-all > div:first-child > div,

			body .header-all > div.last-child > div,

			body .after-header-wrap > div.first-child > div,
			body .after-header-wrap > div:first-child > div,

			body .after-header-wrap > div.last-child > div,

			body .top-and-pop > div.last-child > div,

			body .footer-all .footer > div > div,
			body .footer-all .footer > div > div,

			body .footer-all #subfooter > div > div,
			body .footer-all #subfooter > div > div,

			body .header-all > div.first-child > div > div,
			body .header-all > div:first-child > div > div,

			body .header-all > div.last-child > div > div,

			body .after-header-wrap > div.first-child > div > div,
			body .after-header-wrap > div:first-child > div > div,

			body .after-header-wrap > div.last-child > div > div,

			body .top-and-pop > div.last-child > div > div,


			body .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
			body .slider-wrap,
			body .slider-wrap .slider-inner,
			body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

			body.pge-bxd.b-mrg .footer-all #subfooter,
			body.pge-mxd.b-mrg .footer-all #subfooter {
				border-top-right-radius: 0 !important;
				border-bottom-right-radius: 0 !important;
				border-right: none 0 !important;
			}'; // top right, bottom right - removes radius for no margin in tablets
		}

		echo '}';
	}
	else {

	echo '@media only screen and (min-width: ' . (absint($phoneLdsp) + 1) . 'px) and (max-width: ' . (absint($boxWidthTab) + 2) . 'px) {
		';

		if ($options['page_layout_left_margin_tablets'] == -1 && $options['page_layout_left_margin'] < 1) {

			echo '
			body .after-header-wrap > div:last-child,
			body .after-header-wrap > div:last-child,
			body .header-all > div:last-child,
			body .top-and-pop > div:last-child
			body .header-all > div:last-child > div,
			body .after-header-wrap > div:last-child > div,
			body .top-and-pop > div:last-child > div,
			body .header-all > div:last-child > div > div,
			body .after-header-wrap > div:last-child > div > div,
			body .top-and-pop > div:last-child > div > div {
				border-top-left-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
				border-left: none 0 !important;
			}

			body .footer-all,
			body .footer-all .footer,
			body .footer-all .footer,

			body .footer-all #subfooter,
			body .footer-all #subfooter,

			body .header-all,
			body .header-all > div.first-child,
			body .header-all > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.first-child,
			body .after-header-wrap > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .header-all,
			body .header-all > div.last-child,

			body .top-and-pop,
			body .top-and-pop .popdown,
			body .top-and-pop > div.last-child:not(.abso-on),

			body .footer-all .footer > div,
			body .footer-all .footer > div,

			body .footer-all #subfooter > div,
			body .footer-all #subfooter > div,

			body .header-all > div.first-child > div,
			body .header-all > div:first-child > div,

			body .header-all > div.last-child > div,

			body .after-header-wrap > div.first-child > div,
			body .after-header-wrap > div:first-child > div,

			body .after-header-wrap > div.last-child > div,

			body .top-and-pop > div.last-child > div,

			body .footer-all .footer > div > div,
			body .footer-all .footer > div > div,

			body .footer-all #subfooter > div > div,
			body .footer-all #subfooter > div > div,

			body .header-all > div.first-child > div > div,
			body .header-all > div:first-child > div > div,

			body .header-all > div.last-child > div > div,

			body .after-header-wrap > div.first-child > div > div,
			body .after-header-wrap > div:first-child > div > div,

			body .after-header-wrap > div.last-child > div > div,

			body .top-and-pop > div.last-child > div > div,


			body .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
			body .slider-wrap,
			body .slider-wrap .slider-inner,
			body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

			body.pge-bxd.ft-fix.b-mrg .footer-all #subfooter,
			body.pge-mxd.ft-fix.b-mrg .footer-all #subfooter {
				border-top-left-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
				border-left: none 0 !important;
			}'; // top left, bottom left - removes radius for no margin in tablets

		}
		if ($options['page_layout_right_margin_tablets'] < 1 && $options['page_layout_right_margin'] < 1) {
			echo '
			body .after-header-wrap > div:last-child,
			body .after-header-wrap > div:last-child,
			body .header-all > div:last-child,
			body .top-and-pop > div:last-child,
			body .header-all > div:last-child > div,
			body .after-header-wrap > div:last-child > div,
			body .top-and-pop > div:last-child > div,
			body .header-all > div:last-child > div > div,
			body .after-header-wrap > div:last-child > div > div,
			body .top-and-pop > div:last-child > div > div {
				border-top-right-radius: 0 !important;
				border-bottom-right-radius: 0 !important;
				border-right: none 0 !important;
			}
			body .footer-all,
			body .footer-all .footer,
			body .footer-all .footer,

			body .footer-all #subfooter,
			body .footer-all #subfooter,

			body .header-all,
			body .header-all > div.first-child,
			body .header-all > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.first-child,
			body .after-header-wrap > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .header-all,
			body .header-all > div.last-child,

			body .top-and-pop,
			body .top-and-pop .popdown,
			body:not(.pop-trig-abso) .top-and-pop > div.last-child:not(.abso-on),

			body .footer-all .footer > div,
			body .footer-all .footer > div,

			body .footer-all #subfooter > div,
			body .footer-all #subfooter > div,

			body .header-all > div.first-child > div,
			body .header-all > div:first-child > div,

			body .header-all > div.last-child > div,

			body .after-header-wrap > div.first-child > div,
			body .after-header-wrap > div:first-child > div,

			body .after-header-wrap > div.last-child > div,

			body:not(.pop-trig-abso) .top-and-pop > div.last-child > div,

			body .footer-all .footer > div > div,
			body .footer-all .footer > div > div,

			body .footer-all #subfooter > div > div,
			body .footer-all #subfooter > div > div,

			body .header-all > div.first-child > div > div,
			body .header-all > div:first-child > div > div,

			body .header-all > div.last-child > div > div,

			body .after-header-wrap > div.first-child > div > div,
			body .after-header-wrap > div:first-child > div > div,

			body .after-header-wrap > div.last-child > div > div,

			body .top-and-pop > div.last-child > div > div,


			body .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
			body .slider-wrap,
			body .slider-wrap .slider-inner,
			body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

			body.pge-bxd.b-mrg .footer-all #subfooter,
			body.pge-mxd.b-mrg .footer-all #subfooter {
				border-top-right-radius: 0 !important;
				border-bottom-right-radius: 0 !important;
				border-right: none 0 !important;
			}'; // top right, bottom right - removes radius for no margin in tablets

		}

	}

	echo '}';
}
?>










<?php /* BREAK only at tablet*/ ?>
<?php
if ($options['page_layout']) {
	echo '
	@media only screen and (min-width: ' . (absint($phoneLdsp) + 1) . 'px) and (max-width: ' . absint($tabletLdsp) . 'px) {
	';
		if ($options['page_layout_left_margin_tablets'] == 0) {

			echo '
			body .after-header-wrap > div:last-child,
			body .after-header-wrap > div:last-child,
			body .header-all > div:last-child,
			body .top-and-pop > div:last-child,
			body .header-all > div:last-child > div,
			body .after-header-wrap > div:last-child > div,
			body .top-and-pop > div:last-child > div,
			body .header-all > div:last-child > div > div,
			body .after-header-wrap > div:last-child > div > div,
			body .top-and-pop > div:last-child > div > div {
				border-top-left-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
				border-left: none 0 !important;
			}

			body .footer-all,
			body .footer-all .footer,
			body .footer-all .footer,

			body .footer-all #subfooter,
			body .footer-all #subfooter,

			body .header-all,
			body .header-all > div.first-child,
			body .header-all > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.first-child,
			body .after-header-wrap > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .header-all,
			body .header-all > div.last-child,

			body .top-and-pop,
			body .top-and-pop .popdown,
			body:not(.pop-trig-abso) .top-and-pop > div.last-child:not(.abso-on),

			body .footer-all .footer > div,
			body .footer-all .footer > div,

			body .footer-all #subfooter > div,
			body .footer-all #subfooter > div,

			body .header-all > div.first-child > div,
			body .header-all > div:first-child > div,

			body .header-all > div.last-child > div,

			body .after-header-wrap > div.first-child > div,
			body .after-header-wrap > div:first-child > div,

			body .after-header-wrap > div.last-child > div,

			body:not(.pop-trig-abso) .top-and-pop > div.last-child > div,

			body .footer-all .footer > div > div,
			body .footer-all .footer > div > div,

			body .footer-all #subfooter > div > div,
			body .footer-all #subfooter > div > div,

			body .header-all > div.first-child > div > div,
			body .header-all > div:first-child > div > div,

			body .header-all > div.last-child > div > div,

			body .after-header-wrap > div.first-child > div > div,
			body .after-header-wrap > div:first-child > div > div,

			body .after-header-wrap > div.last-child > div > div,

			body .top-and-pop > div.last-child > div > div,


			body .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
			body .slider-wrap,
			body .slider-wrap .slider-inner,
			body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

			body.pge-bxd.ft-fix.b-mrg .footer-all #subfooter,
			body.pge-mxd.ft-fix.b-mrg .footer-all #subfooter {
				border-top-left-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
				border-left: none 0 !important;
			}'; // top left, bottom left - removes radius for no margin in tablets

		}
		if ($options['page_layout_right_margin_tablets'] == 0 && $options['page_layout_left_margin_tablets'] != 0 ||
		($options['page_layout_right_margin'] == 0 && $options['page_layout_right_margin_tablets'] == -1 && $options['page_layout_left_margin_tablets'] != 0) ||
		($options['page_layout_right_margin'] == 0 && $options['page_layout_right_margin_tablets'] == -1 && $options['page_layout_left_margin_tablets'] == -1 && $options['page_layout_left_margin'] == 0)) {
			echo '
			body .after-header-wrap > div:last-child,
			body .after-header-wrap > div:last-child,
			body .header-all > div:last-child,
			body .top-and-pop > div:last-child,
			body .header-all > div:last-child > div,
			body .after-header-wrap > div:last-child > div,
			body .top-and-pop > div:last-child > div,
			body .header-all > div:last-child > div > div,
			body .after-header-wrap > div:last-child > div > div,
			body .top-and-pop > div:last-child > div > div {
				border-top-right-radius: 0 !important;
				border-bottom-right-radius: 0 !important;
				border-right: none 0 !important;
			}
			body .footer-all,
			body .footer-all .footer,
			body .footer-all .footer,

			body .footer-all #subfooter,
			body .footer-all #subfooter,

			body .header-all,
			body .header-all > div.first-child,
			body .header-all > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.first-child,
			body .after-header-wrap > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .header-all,
			body .header-all > div.last-child,

			body .top-and-pop,
			body .top-and-pop .popdown,
			body .top-and-pop > div.last-child:not(.abso-on),

			body .footer-all .footer > div,
			body .footer-all .footer > div,

			body .footer-all #subfooter > div,
			body .footer-all #subfooter > div,

			body .header-all > div.first-child > div,
			body .header-all > div:first-child > div,

			body .header-all > div.last-child > div,

			body .after-header-wrap > div.first-child > div,
			body .after-header-wrap > div:first-child > div,

			body .after-header-wrap > div.last-child > div,

			body .top-and-pop > div.last-child > div,

			body .footer-all .footer > div > div,
			body .footer-all .footer > div > div,

			body .footer-all #subfooter > div > div,
			body .footer-all #subfooter > div > div,

			body .header-all > div.first-child > div > div,
			body .header-all > div:first-child > div > div,

			body .header-all > div.last-child > div > div,

			body .after-header-wrap > div.first-child > div > div,
			body .after-header-wrap > div:first-child > div > div,

			body .after-header-wrap > div.last-child > div > div,

			body .top-and-pop > div.last-child > div > div,


			body .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
			body .slider-wrap,
			body .slider-wrap .slider-inner,
			body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

			body.pge-bxd.b-mrg .footer-all #subfooter,
			body.pge-mxd.b-mrg .footer-all #subfooter {
				border-top-right-radius: 0 !important;
				border-bottom-right-radius: 0 !important;
				border-right: none 0 !important;
			}'; // top right, bottom right - removes radius for no margin in tablets

		}

	echo '}';

	}
?>

<?php /* BREAK AT TABLET LDSCP */ ?>
@media only screen and (max-width: <?php echo absint($tabletLdsp); ?>px) {
	<?php
	if ($options['page_layout_sections_margin_tablets'] > 0) {
			echo '.after-header-wrap { margin-bottom: ' . absint($options['page_layout_sections_margin_tablets']) . 'px; margin-top: ' . absint($options['page_layout_sections_margin_tablets']) . 'px;} .slider-wrap {margin-top: ' . absint($options['page_layout_sections_margin_tablets']) . 'px;}' ;
		}
	?>
	.mobile-text-center {text-align:center;}
	.mobile-text-left {text-align:left;}
	.mobile-text-right {text-align:right;}

	.mobile-box-center {float: none; margin-left: auto; margin-right: auto; text-align:center;}
	.mobile-box-left {float: left;}
	.mobile-box-right {float: right;}

	#intro.mobile-text-center .breadcrumbs .back-home-icon {
		border: 0 none;
		display: block;
		float: none;
		height: 30px;
		margin-left: auto;
		margin-right: auto;
		margin-top: 10px;
		padding: 0;
		width: 30px;
	}

	<?php /* Kube responsive phone tablet - phone */ ?>
	.mobile-width-100 {
		width: 100%;
	}
	.mobile-width-100.units-row > .unit-90,
	.mobile-width-100.units-row > .unit-80,
	.mobile-width-100.units-row > .unit-75,
	.mobile-width-100.units-row > .unit-70,
	.mobile-width-100.units-row > .unit-66,
	.mobile-width-100.units-row > .unit-65,
	.mobile-width-100.units-row > .unit-60,
	.mobile-width-100.units-row > .unit-50,
	.mobile-width-100.units-row > .unit-40,
	.mobile-width-100.units-row > .unit-35,
	.mobile-width-100.units-row > .unit-33,
	.mobile-width-100.units-row > .unit-30,
	.mobile-width-100.units-row > .unit-25,
	.mobile-width-100.units-row > .unit-20,
	.mobile-width-100.units-row > .unit-10 {
		width: 100%;
		float: none;
		margin-left: 0;
		margin-bottom: 1.6em;
		border-left: none 0;
		min-height: 0 !important;
	}
	.mobile-width-100.units-row.border-left > div {
		border-bottom-style: solid;
		border-bottom-width: 1px;
	}
	.mobile-width-100.units-row.border-left > div:last-child {
		border-bottom: none 0;
	}
	.mobile-width-100.units-row .unit-push-90,
	.mobile-width-100.units-row .unit-push-80,
	.mobile-width-100.units-row .unit-push-75,
	.mobile-width-100.units-row .unit-push-70,
	.mobile-width-100.units-row .unit-push-66,
	.mobile-width-100.units-row .unit-push-65,
	.mobile-width-100.units-row .unit-push-60,
	.mobile-width-100.units-row .unit-push-50,
	.mobile-width-100.units-row .unit-push-40,
	.mobile-width-100.units-row .unit-push-35,
	.mobile-width-100.units-row .unit-push-33,
	.mobile-width-100.units-row .unit-push-30,
	.mobile-width-100.units-row .unit-push-25,
	.mobile-width-100.units-row .unit-push-20,
	.mobile-width-100.units-row .unit-push-10 {
		left: 0;
	}
	.units-row .unit-push-right {
		float: none;
	}
	.units-mobile-50 > .unit-90,
	.units-mobile-50 > .unit-80,
	.units-mobile-50 > .unit-75,
	.units-mobile-50 > .unit-70,
	.units-mobile-50 > .unit-66,
	.units-mobile-50 > .unit-65,
	.units-mobile-50 > .unit-60,
	.units-mobile-50 > .unit-40,
	.units-mobile-50 > .unit-30,
	.units-mobile-50 > .unit-35,
	.units-mobile-50 > .unit-33,
	.units-mobile-50 > .unit-25,
	.units-mobile-50 > .unit-20,
	.units-mobile-50 > .unit-10 {
		float: left;
		margin-left: 3%;
		width: 48.5%;
		margin-bottom: 1.6em;
	}
	.units-mobile-50.units-split > .unit-90,
	.units-mobile-50.units-split > .unit-80,
	.units-mobile-50.units-split > .unit-75,
	.units-mobile-50.units-split > .unit-70,
	.units-mobile-50.units-split > .unit-66,
	.units-mobile-50.units-split > .unit-65,
	.units-mobile-50.units-split > .unit-60,
	.units-mobile-50.units-split > .unit-40,
	.units-mobile-50.units-split > .unit-30,
	.units-mobile-50.units-split > .unit-35,
	.units-mobile-50.units-split > .unit-33,
	.units-mobile-50.units-split > .unit-25,
	.units-mobile-50.units-split > .unit-20,
	.units-mobile-50.units-split > .unit-10 {
		float: left;
		margin-left: 0;
		width: 50%;
		margin-bottom: 1.6em;
	}
	.units-mobile-50 > .unit-90:first-child,
	.units-mobile-50 > .unit-80:first-child,
	.units-mobile-50 > .unit-75:first-child,
	.units-mobile-50 > .unit-70:first-child,
	.units-mobile-50 > .unit-66:first-child,
	.units-mobile-50 > .unit-65:first-child,
	.units-mobile-50 > .unit-60:first-child,
	.units-mobile-50 > .unit-40:first-child,
	.units-mobile-50 > .unit-35:first-child,
	.units-mobile-50 > .unit-30:first-child,
	.units-mobile-50 > .unit-33:first-child,
	.units-mobile-50 > .unit-25:first-child,
	.units-mobile-50 > .unit-20:first-child,
	.units-mobile-50 > .unit-10:first-child {
		margin-left: 0;
	}
	.units-mobile-50.units-row > div:nth-child(odd) {
		border-left: none 0;
		margin-left: 0;
		clear: left;
	}
	.units-mobile-50.units-row > div:nth-child(odd):last-child {
		width: 100%;
	}
	.units-mobile-50.units-padding > .unit-100,
	.units-mobile-50.units-padding > .unit-90,
	.units-mobile-50.units-padding > .unit-80,
	.units-mobile-50.units-padding > .unit-75,
	.units-mobile-50.units-padding > .unit-70,
	.units-mobile-50.units-padding > .unit-66,
	.units-mobile-50.units-padding > .unit-65,
	.units-mobile-50.units-padding > .unit-60,
	.units-mobile-50.units-padding > .unit-50,
	.units-mobile-50.units-padding > .unit-40,
	.units-mobile-50.units-padding > .unit-35,
	.units-mobile-50.units-padding > .unit-33,
	.units-mobile-50.units-padding > .unit-30,
	.units-mobile-50.units-padding > .unit-25,
	.units-mobile-50.units-padding > .unit-20,
	.units-mobile-50.units-padding > .unit-10,

	.mobile-width-100.units-padding > .unit-100,
	.mobile-width-100.units-padding > .unit-90,
	.mobile-width-100.units-padding > .unit-80,
	.mobile-width-100.units-padding > .unit-75,
	.mobile-width-100.units-padding > .unit-70,
	.mobile-width-100.units-padding > .unit-66,
	.mobile-width-100.units-padding > .unit-65,
	.mobile-width-100.units-padding > .unit-60,
	.mobile-width-100.units-padding > .unit-50,
	.mobile-width-100.units-padding > .unit-40,
	.mobile-width-100.units-padding > .unit-35,
	.mobile-width-100.units-padding > .unit-33,
	.mobile-width-100.units-padding > .unit-30,
	.mobile-width-100.units-padding > .unit-25,
	.mobile-width-100.units-padding > .unit-20,
	.mobile-width-100.units-padding > .unit-10 {
	  padding: 2.5em 1.5em;
	}

}
<?php /* ONLY AT TABLET */ ?>
@media only screen and (min-width: <?php echo (absint($phoneLdsp) + 1); ?>px) and (max-width: <?php echo absint($tabletLdsp); ?>px) {


	<?php /* Kube responsive phone tablet*/ ?>
	.units-tablet-50 .unit-push-90,
	.units-tablet-50 .unit-push-80,
	.units-tablet-50 .unit-push-75,
	.units-tablet-50 .unit-push-70,
	.units-tablet-50 .unit-push-66,
	.units-tablet-50 .unit-push-65,
	.units-tablet-50 .unit-push-60,
	.units-tablet-50 .unit-push-50,
	.units-tablet-50 .unit-push-40,
	.units-tablet-50 .unit-push-35,
	.units-tablet-50 .unit-push-33,
	.units-tablet-50 .unit-push-30,
	.units-tablet-50 .unit-push-25,
	.units-tablet-50 .unit-push-20,
	.units-tablet-50 .unit-push-10 {
		left: 0;
	}
	.units-row .unit-push-right {
		float: none;
	}
	.units-tablet-50 > .unit-90,
	.units-tablet-50 > .unit-80,
	.units-tablet-50 > .unit-75,
	.units-tablet-50 > .unit-70,
	.units-tablet-50 > .unit-66,
	.units-tablet-50 > .unit-65,
	.units-tablet-50 > .unit-60,
	.units-tablet-50 > .unit-40,
	.units-tablet-50 > .unit-30,
	.units-tablet-50 > .unit-35,
	.units-tablet-50 > .unit-33,
	.units-tablet-50 > .unit-25,
	.units-tablet-50 > .unit-20,
	.units-tablet-50 > .unit-10 {
		float: left;
		margin-left: 3%;
		width: 48.5%;
		margin-bottom: 1.6em;
	}
	.units-tablet-50.units-split > .unit-90,
	.units-tablet-50.units-split > .unit-80,
	.units-tablet-50.units-split > .unit-75,
	.units-tablet-50.units-split > .unit-70,
	.units-tablet-50.units-split > .unit-66,
	.units-tablet-50.units-split > .unit-65,
	.units-tablet-50.units-split > .unit-60,
	.units-tablet-50.units-split > .unit-40,
	.units-tablet-50.units-split > .unit-30,
	.units-tablet-50.units-split > .unit-35,
	.units-tablet-50.units-split > .unit-33,
	.units-tablet-50.units-split > .unit-25,
	.units-tablet-50.units-split > .unit-20,
	.units-tablet-50.units-split > .unit-10 {
		float: left;
		margin-left: 0;
		width: 50%;
		margin-bottom: 1.6em;
	}
	.units-tablet-50 > .unit-90:first-child,
	.units-tablet-50 > .unit-80:first-child,
	.units-tablet-50 > .unit-75:first-child,
	.units-tablet-50 > .unit-70:first-child,
	.units-tablet-50 > .unit-66:first-child,
	.units-tablet-50 > .unit-65:first-child,
	.units-tablet-50 > .unit-60:first-child,
	.units-tablet-50 > .unit-40:first-child,
	.units-tablet-50 > .unit-35:first-child,
	.units-tablet-50 > .unit-30:first-child,
	.units-tablet-50 > .unit-33:first-child,
	.units-tablet-50 > .unit-25:first-child,
	.units-tablet-50 > .unit-20:first-child,
	.units-tablet-50 > .unit-10:first-child {
		margin-left: 0;
	}
	.units-tablet-50.units-row > div:nth-child(odd) {
		border-left: none 0;
		margin-left: 0;
		clear: left;
	}
	.units-tablet-50.units-row > div:nth-child(odd):last-child {
		width: 100%;
	}

	.units-tablet-50.units-padding > .unit-100,
	.units-tablet-50.units-padding > .unit-90,
	.units-tablet-50.units-padding > .unit-80,
	.units-tablet-50.units-padding > .unit-75,
	.units-tablet-50.units-padding > .unit-70,
	.units-tablet-50.units-padding > .unit-66,
	.units-tablet-50.units-padding > .unit-65,
	.units-tablet-50.units-padding > .unit-60,
	.units-tablet-50.units-padding > .unit-50,
	.units-tablet-50.units-padding > .unit-40,
	.units-tablet-50.units-padding > .unit-35,
	.units-tablet-50.units-padding > .unit-33,
	.units-tablet-50.units-padding > .unit-30,
	.units-tablet-50.units-padding > .unit-25,
	.units-tablet-50.units-padding > .unit-20,
	.units-tablet-50.units-padding > .unit-10 {
	  padding: 2.5em 1.5em;
	}

	<?php
	if ($options['show_popdown_tablet'] != 1) {
			echo '.popdown, #popdown-trigger {display: none !important;}' ;
		}
	?>
	<?php
	if ($options['show_tophead_tablet'] != 1) {
			echo '#tophead {display: none;}' ;
		}
	?>

	<?php
		if ($options['show_infomenu_tablet'] != 1) {
			echo '.info-menu, .im-box  {display: none;}
			#nav-wrap, body.logo-r #nav-wrap {
				min-height:1px;
			}

			.device-menu-trigger-wrap, .device-top-menu-trigger-wrap {
				top: -60px;
			}

			' ; // TODO - add calculation to see if the nav convert is bigger than the tablet break point.
		}
	?>
	<?php
	if ($options['show_solonav_tablet'] != 1) {
			echo '#solonav {display: none;}' ;
		}
	?>
	<?php
	if ($options['show_subfooter_tablet'] != 1) {
			echo '

			#subfooter {display: none;}

			body.pge-bxd-cnt.rgt-mrg.b-mrg .footer-all #subfooter,
			body.pge-fld.rgt-mrg.b-mrg .footer-all #subfooter {
				border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
			}
			body.pge-bxd-cnt.lft-mrg.b-mrg .footer-all #subfooter,
			body.pge-fld.lft-mrg.b-mrg .footer-all #subfooter {
				border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
			}

			body.pge-mxd.ft-fix.b-mrg .footer-all .footer,
			body.pge-bxd.ft-fix.b-mrg .footer-all .footer,
			body.pge-mxd.b-mrg .footer-all .footer,
			body.pge-bxd.b-mrg .footer-all .footer {
				border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
				border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
			}

			' ;
		}
	?>

	<?php
		if ($options['page_layout_left_margin_tablets'] != -1) {
			echo 'body.pge-bxd .slider-wrap, body.pge-mxd .slider-wrap, body.pge-bxd .after-header-wrap, body.pge-bxd .footer-all, body.pge-bxd .top-and-pop, body.pge-bxd .header-all,
			body.pge-fld .after-header-wrap, body.pge-fld .footer-all, body.pge-fld .top-and-pop, body.pge-fld .header-all, body.pge-fld .slider-wrap,
			body.pge-bxd-cnt .after-header-wrap, body.pge-bxd-cnt .footer-all, body.pge-bxd-cnt .top-and-pop, body.pge-bxd-cnt .header-all, body.pge-bxd-cnt .slider-wrap,
			body.pge-mxd .after-header-wrap, body.pge-mxd .top-and-pop, body.pge-mxd .header-all, body.pge-mxd .footer-all,
			body.pge-mxd.strch-top .popdown-inner, body.pge-mxd.strch-top .trigger-inner, body.pge-mxd.strch-top .tophead-inner,
			body.pge-mxd.strch-allhd .popdown-inner, body.pge-mxd.strch-allhd .trigger-inner, body.pge-mxd.strch-allhd .tophead-inner, body.pge-mxd.strch-allhd .header-inner, body.pge-mxd.strch-allhd .solonav-inner,
			body.pge-mxd.strch-sf .footer-all .subfooter-inner, body.pge-mxd.strch-sf .footer-all .footer, body.pge-mxd.strch-allft .footer-all .subfooter-inner, body.pge-mxd.strch-allft .footer-all .footer-inner,
			body.pge-mxd.strch-cnt .after-header-wrap .intro-inner, body.pge-mxd.strch-cnt .after-header-wrap .content-inner { margin-left: ' . absint($options['page_layout_left_margin_tablets']) . 'px;}
			body.pge-mxd.strch-cnt .after-header-wrap, body.pge-mxd.strch-top .top-and-pop, body.pge-mxd.strch-allhd .top-and-pop, body.pge-mxd.strch-allhd .header-all, body.pge-mxd.strch-allft .footer-all .footer, body.pge-mxd.strch-allft #subfooter, body.pge-mxd.strch-allft .footer-all, body.pge-mxd.strch-sf #subfooter, body.pge-mxd.strch-sf .footer-all, body.pge-mxd #popdown-trigger .trigger-inner, body.pge-mxd .footer-all .footer, body.pge-mxd .footer-all #subfooter { margin-left: 0;}';
		}
	?>

	<?php
		if ($options['page_layout_right_margin_tablets'] != -1) {
			echo 'body.pge-bxd .slider-wrap, body.pge-mxd .slider-wrap, body.pge-bxd .after-header-wrap, body.pge-bxd .footer-all, body.pge-bxd .top-and-pop, body.pge-bxd .header-all,
			body.pge-fld .after-header-wrap, body.pge-fld .footer-all, body.pge-fld .top-and-pop, body.pge-fld .header-all, body.pge-fld .slider-wrap,
			body.pge-bxd-cnt .after-header-wrap, body.pge-bxd-cnt .footer-all, body.pge-bxd-cnt .top-and-pop, body.pge-bxd-cnt .header-all, body.pge-bxd-cnt .slider-wrap,
			body.pge-mxd .after-header-wrap, body.pge-mxd .top-and-pop, body.pge-mxd .header-all, body.pge-mxd .footer-all,
			body.pge-mxd.strch-top .popdown-inner, body.pge-mxd.strch-top .trigger-inner, body.pge-mxd.strch-top .tophead-inner,
			body.pge-mxd.strch-allhd .popdown-inner, body.pge-mxd.strch-allhd .trigger-inner, body.pge-mxd.strch-allhd .tophead-inner, body.pge-mxd.strch-allhd .header-inner, body.pge-mxd.strch-allhd .solonav-inner,
			body.pge-mxd.strch-sf .footer-all .subfooter-inner, body.pge-mxd.strch-sf .footer-all .footer, body.pge-mxd.strch-allft .footer-all .subfooter-inner, body.pge-mxd.strch-allft .footer-all .footer-inner,
			body.pge-mxd.strch-cnt .after-header-wrap .intro-inner, body.pge-mxd.strch-cnt .after-header-wrap .content-inner { margin-right: ' . absint($options['page_layout_right_margin_tablets']) . 'px;}
			body.pge-mxd.strch-cnt .after-header-wrap, body.pge-mxd.strch-top .top-and-pop, body.pge-mxd.strch-allhd .top-and-pop, body.pge-mxd.strch-allhd .header-all, body.pge-mxd.strch-allft .footer-all .footer, body.pge-mxd.strch-allft #subfooter, body.pge-mxd.strch-allft .footer-all, body.pge-mxd.strch-sf #subfooter, body.pge-mxd.strch-sf .footer-all, body.pge-mxd.strch-sf .footer-all, body.pge-mxd #popdown-trigger .trigger-inner, body.pge-mxd .footer-all .footer, body.pge-mxd .footer-all #subfooter { margin-right: 0;}';
		}
	?>

	<?php
	if ($options['show_tophead_tablet'] != 1) {
			echo '
			body.pge-bxd.t-mrg .top-and-pop .popdown,
			body.pge-mxd.t-mrg .top-and-pop .popdown {
				border-bottom-right-radius:' . absint($options['page_rounded_corners']) . 'px;
				border-bottom-left-radius:' . absint($options['page_rounded_corners']) . 'px;
			}
			body.pge-mxd.t-mrg.strch-allhd .top-and-pop  .popdown,
			body.pge-mxd.t-mrg.strch-top .top-and-pop  .popdown {
				border-bottom-right-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
			}
			body.pge-mxd.lft-mrg.t-mrg .top-and-pop .popdown,
			body.pge-fld.lft-mrg.t-mrg .top-and-pop .popdown {
				border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}
			body.pge-fld.rgt-mrg.t-mrg .top-and-pop .popdown,
			body.pge-mxd.rgt-mrg.t-mrg .top-and-pop .popdown {
				border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}';
		}
	?>
	<?php
		if ($options['page_layout_tophead_right_padding_tablets'] != 0) {
			echo '#tophead .tophead-wrap {padding-right: ' .  absint($options['page_layout_tophead_right_padding_tablets']) . 'px;}
				.dismissed #tophead .tophead-wrap {padding-right: 35px;}
			';
		}
	?>
	<?php
		if ($options['page_layout_header_right_padding_tablets'] != 0) {
			echo '#header .header-wrap {padding-right: ' .  absint($options['page_layout_header_right_padding_tablets']) . 'px;}
				.dismissed #header .header-wrap {padding-right: 0;}
			';
		}
	?>
	<?php
		if ($options['page_layout_subfoot_right_padding_tablets'] != 0) {
			echo '#subfooter .subfooter-wrap {padding-right: ' .  absint($options['page_layout_subfoot_right_padding_tablets']) . 'px;}';
		}
	?>

	<?php
	if ($options['page_layout'] == 'pge-bxd-cnt' || $options['page_layout'] == 'pge-fld') {

	if ($options['page_layout_left_margin_tablets'] == 0 || ($options['page_layout_left_margin_tablets'] == -1 && $options['page_layout_left_margin'] < 1)) {
			echo '
				body .after-header-wrap > div:last-child,
				body .after-header-wrap > div:last-child,
				body .header-all > div:last-child,
				body .top-and-pop > div:last-child,
				body .header-all > div:last-child > div,
				body .after-header-wrap > div:last-child > div,
				body .top-and-pop > div:last-child > div,
				body .header-all > div:last-child > div > div,
				body .after-header-wrap > div:last-child > div > div,
				body .top-and-pop > div:last-child > div > div {
					border-top-left-radius: 0 !important;
					border-bottom-left-radius: 0 !important;
					border-left: none 0 !important;
				}
				body .footer-all,
				body .footer-all .footer,
				body .footer-all .footer,

				body .footer-all #subfooter,
				body .footer-all #subfooter,

				body .header-all,
				body .header-all > div.first-child,
				body .header-all > div:first-child,

				body .after-header-wrap,
				body .after-header-wrap > div.first-child,
				body .after-header-wrap > div:first-child,

				body .after-header-wrap,
				body .after-header-wrap > div.last-child,

				body .after-header-wrap,
				body .after-header-wrap > div.last-child,

				body .header-all,
				body .header-all > div.last-child,

				body .top-and-pop,
				body .top-and-pop .popdown,
				body .top-and-pop > div.last-child:not(.abso-on),

				body .footer-all .footer > div,
				body .footer-all .footer > div,

				body .footer-all #subfooter > div,
				body .footer-all #subfooter > div,

				body .header-all > div.first-child > div,
				body .header-all > div:first-child > div,

				body .header-all > div.last-child > div,

				body .after-header-wrap > div.first-child > div,
				body .after-header-wrap > div:first-child > div,

				body .after-header-wrap > div.last-child > div,

				body .top-and-pop > div.last-child > div,

				body .footer-all .footer > div > div,
				body .footer-all .footer > div > div,

				body .footer-all #subfooter > div > div,
				body .footer-all #subfooter > div > div,

				body .header-all > div.first-child > div > div,
				body .header-all > div:first-child > div > div,

				body .header-all > div.last-child > div > div,

				body .after-header-wrap > div.first-child > div > div,
				body .after-header-wrap > div:first-child > div > div,

				body .after-header-wrap > div.last-child > div > div,

				body .top-and-pop > div.last-child > div > div,


				body.v-mrg .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
				body .slider-wrap,
				body .slider-wrap .slider-inner,
				body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

				body.pge-bxd.ft-fix.b-mrg .footer-all #subfooter,
				body.pge-mxd.ft-fix.b-mrg .footer-all #subfooter {
					border-top-left-radius: 0 !important;
					border-bottom-left-radius: 0 !important;
					border-left: none 0 !important;
				}
			';
		}
		if ($options['page_layout_right_margin_tablets'] == 0 || ($options['page_layout_right_margin_tablets'] == -1 && $options['page_layout_right_margin'] < 1)) {
			echo '
				body .after-header-wrap > div:last-child,
				body .after-header-wrap > div:last-child,
				body .header-all > div:last-child,
				body .top-and-pop > div:last-child,
				body .header-all > div:last-child > div,
				body .after-header-wrap > div:last-child > div,
				body .top-and-pop > div:last-child > div,
				body .header-all > div:last-child > div > div,
				body .after-header-wrap > div:last-child > div > div,
				body .top-and-pop > div:last-child > div > div {
					border-top-right-radius: 0 !important;
					border-bottom-right-radius: 0 !important;
					border-right: none 0 !important;
				}
				body .footer-all,
				body .footer-all .footer,
				body .footer-all .footer,

				body .footer-all #subfooter,
				body .footer-all #subfooter,

				body .header-all,
				body .header-all > div.first-child,
				body .header-all > div:first-child,

				body .after-header-wrap,
				body .after-header-wrap > div.first-child,
				body .after-header-wrap > div:first-child,

				body .after-header-wrap,
				body .after-header-wrap > div.last-child,

				body .after-header-wrap,
				body .after-header-wrap > div.last-child,

				body .header-all,
				body .header-all > div.last-child,

				body .top-and-pop,
				body .top-and-pop .popdown,
				body .top-and-pop > div.last-child:not(.abso-on),

				body .footer-all .footer > div,
				body .footer-all .footer > div,

				body .footer-all #subfooter > div,
				body .footer-all #subfooter > div,

				body .header-all > div.first-child > div,
				body .header-all > div:first-child > div,

				body .header-all > div.last-child > div,

				body .after-header-wrap > div.first-child > div,
				body .after-header-wrap > div:first-child > div,

				body .after-header-wrap > div.last-child > div,

				body .top-and-pop > div.last-child > div,

				body .footer-all .footer > div > div,
				body .footer-all .footer > div > div,

				body .footer-all #subfooter > div > div,
				body .footer-all #subfooter > div > div,

				body .header-all > div.first-child > div > div,
				body .header-all > div:first-child > div > div,

				body .header-all > div.last-child > div > div,

				body .after-header-wrap > div.first-child > div > div,
				body .after-header-wrap > div:first-child > div > div,

				body .after-header-wrap > div.last-child > div > div,

				body .top-and-pop > div.last-child > div > div,


				body.v-mrg .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
				body .slider-wrap,
				body .slider-wrap .slider-inner,
				body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

				body.pge-bxd.ft-fix.b-mrg .footer-all #subfooter,
				body.pge-mxd.ft-fix.b-mrg .footer-all #subfooter {
					border-top-right-radius: 0 !important;
					border-bottom-right-radius: 0 !important;
					border-right: none 0 !important;
				}
			';
		}

	}
	?>

.tablet-text-center {text-align:center;}
.tablet-text-left {text-align:left;}
.tablet-text-right {text-align:right;}

#intro.tablet-text-center .breadcrumbs .back-home-icon {
	border: 0 none;
	display: block;
	float: none;
	height: 30px;
	margin-left: auto;
	margin-right: auto;
	margin-top: 10px;
	padding: 0;
	width: 30px;
}

.tablet-box-center {float: none; margin-left: auto; margin-right: auto; text-align:center;}
.tablet-box-left {float: left;}
.tablet-box-right {float: right;}

}

<?php /* ONLY AT PHONE LDSCP */ ?>

@media only screen and (max-width: <?php echo absint($phoneLdsp); ?>px) {

	<?php
	if ($options['sidebar_convert_columns'] == 'revcol-2-2' || $options['sidebar_convert_columns'] == 'revcol-2-3') {
			echo '
				.revcol-2-3 #sidebar .widget, .revcol-2-2 #sidebar .widget {
					display: inline-block;
					float: left;
					vertical-align: top;
					width: 47%;
					margin-left: 1.5%;
					margin-right: 1.5%;
				}
			' ;
		}
	?>
	<?php
		if ($options['sidebar_convert_columns'] == 'revcol-1-3' || $options['sidebar_convert_columns'] == 'revcol-1-2') {
			echo '
				.revcol-1-3 #sidebar .widget, .revcol-1-2 #sidebar .widget {
					display: block;
					float: none;
					vertical-align: top;
					width: 100%;
					margin-left: 0;
					margin-right: 0;
				}
			' ;
		}
	?>
	<?php
		if ($options['sidebar_convert_columns'] == 'revcol-1-1') {
			echo '
				.revcol-1-1 #sidebar .widget {
					display: block;
					float: none;
					vertical-align: top;
					width: 100%;
					margin-left: 0;
					margin-right: 0;
				}
			' ;
		}
	?>
	<?php
	if ($options['page_layout_sections_margin_phones'] > 0) {
			echo '.after-header-wrap { margin-bottom: ' . absint($options['page_layout_sections_margin_phones']) . 'px; margin-top: ' . absint($options['page_layout_sections_margin_phones']) . 'px;} .slider-wrap {margin-top: ' . absint($options['page_layout_sections_margin_phones']) . 'px;}' ;
		}
	?>
	<?php
	if ($options['show_tophead_phone'] != 1) {
			echo 'body #tophead {display: none;}' ;
		}
	?>
	<?php
	if (!$options['show_solonav_phone']) {
			echo '#solonav {display: none;}' ;
		}
	?>
	<?php
	if (!$options['show_popdown_phone']) {
			echo '.popdown, #popdown-trigger {display: none !important;}' ;
		}
	?>
	<?php
	if ($options['show_infomenu_phone'] != 1) {
			echo '.info-menu, .im-box  {display: none;}
			#nav-wrap, body.logo-r #nav-wrap {
				min-height:1px;
			}

			.device-menu-trigger-wrap, .device-top-menu-trigger-wrap {
				top: -60px;
			}

			' ;
		}
	?>
	<?php
	if ($options['show_subfooter_phone'] != 1) {
			echo '#subfooter {display: none;}
			body.pge-bxd-cnt.rgt-mrg.b-mrg .footer-all #subfooter,
			body.pge-fld.rgt-mrg.b-mrg .footer-all #subfooter {
				border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
			}
			body.pge-bxd-cnt.lft-mrg.b-mrg .footer-all #subfooter,
			body.pge-fld.lft-mrg.b-mrg .footer-all #subfooter {
				border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
			}
			body.pge-mxd.ft-fix.b-mrg .footer-all .footer,
			body.pge-bxd.ft-fix.b-mrg .footer-all .footer,
			body.pge-mxd.b-mrg .footer-all .footer,
			body.pge-bxd.b-mrg .footer-all .footer {
				border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
				border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
			}
			' ;
		}
	?>
	<?php
		if ($options['page_layout_left_margin_phones'] != -1) {
			echo 'body.pge-bxd .slider-wrap, body.pge-mxd .slider-wrap, body.pge-bxd .after-header-wrap, body.pge-bxd .footer-all, body.pge-bxd .top-and-pop, body.pge-bxd .header-all,
			body.pge-fld .after-header-wrap, body.pge-fld .footer-all, body.pge-fld .top-and-pop, body.pge-fld .header-all, body.pge-fld .slider-wrap,
			body.pge-bxd-cnt .after-header-wrap, body.pge-bxd-cnt .footer-all, body.pge-bxd-cnt .top-and-pop, body.pge-bxd-cnt .header-all, body.pge-bxd-cnt .slider-wrap,
			body.pge-mxd .after-header-wrap, body.pge-mxd .top-and-pop, body.pge-mxd .header-all, body.pge-mxd .footer-all,
			body.pge-mxd.strch-top .popdown-inner, body.pge-mxd.strch-top .trigger-inner, body.pge-mxd.strch-top .tophead-inner,
			body.pge-mxd.strch-allhd .popdown-inner, body.pge-mxd.strch-allhd .trigger-inner, body.pge-mxd.strch-allhd .tophead-inner, body.pge-mxd.strch-allhd .header-inner, body.pge-mxd.strch-allhd .solonav-inner,
			body.pge-mxd.strch-sf .footer-all .subfooter-inner, body.pge-mxd.strch-sf .footer-all .footer, body.pge-mxd.strch-allft .footer-all .subfooter-inner, body.pge-mxd.strch-allft .footer-all .footer-inner,
			body.pge-mxd.strch-cnt .after-header-wrap .intro-inner, body.pge-mxd.strch-cnt .after-header-wrap .content-inner { margin-left: ' . absint($options['page_layout_left_margin_phones']) . 'px;}
			body.pge-mxd.strch-cnt .after-header-wrap, body.pge-mxd.strch-top .top-and-pop, body.pge-mxd.strch-allhd .top-and-pop, body.pge-mxd.strch-allhd .header-all, body.pge-mxd.strch-allft .footer-all .footer, body.pge-mxd.strch-allft #subfooter, body.pge-mxd.strch-allft .footer-all, body.pge-mxd.strch-sf #subfooter, body.pge-mxd.strch-sf .footer-all, body.pge-mxd #popdown-trigger .trigger-inner, body.pge-mxd .footer-all .footer, body.pge-mxd .footer-all #subfooter { margin-left: 0;}';
		}
	?>
	<?php
		if ($options['page_layout_right_margin_phones'] != -1) {
			echo 'body.pge-bxd .slider-wrap, body.pge-mxd .slider-wrap, body.pge-bxd .after-header-wrap, body.pge-bxd .footer-all, body.pge-bxd .top-and-pop, body.pge-bxd .header-all,
			body.pge-fld .after-header-wrap, body.pge-fld .footer-all, body.pge-fld .top-and-pop, body.pge-fld .header-all, body.pge-fld .slider-wrap,
			body.pge-bxd-cnt .after-header-wrap, body.pge-bxd-cnt .footer-all, body.pge-bxd-cnt .top-and-pop, body.pge-bxd-cnt .header-all, body.pge-bxd-cnt .slider-wrap,
			body.pge-mxd .after-header-wrap, body.pge-mxd .top-and-pop, body.pge-mxd .header-all, body.pge-mxd .footer-all,
			body.pge-mxd.strch-top .popdown-inner, body.pge-mxd.strch-top .trigger-inner, body.pge-mxd.strch-top .tophead-inner,
			body.pge-mxd.strch-allhd .popdown-inner, body.pge-mxd.strch-allhd .trigger-inner, body.pge-mxd.strch-allhd .tophead-inner, body.pge-mxd.strch-allhd .header-inner, body.pge-mxd.strch-allhd .solonav-inner,
			body.pge-mxd.strch-sf .footer-all .subfooter-inner, body.pge-mxd.strch-sf .footer-all .footer, body.pge-mxd.strch-allft .footer-all .subfooter-inner, body.pge-mxd.strch-allft .footer-all .footer-inner,
			body.pge-mxd.strch-cnt .after-header-wrap .intro-inner, body.pge-mxd.strch-cnt .after-header-wrap .content-inner { margin-right: ' . absint($options['page_layout_right_margin_phones']) . 'px;}
			body.pge-mxd.strch-cnt .after-header-wrap, body.pge-mxd.strch-top .top-and-pop, body.pge-mxd.strch-allhd .top-and-pop, body.pge-mxd.strch-allhd .header-all, body.pge-mxd.strch-allft .footer-all .footer, body.pge-mxd.strch-allft #subfooter, body.pge-mxd.strch-allft .footer-all, body.pge-mxd.strch-sf #subfooter, body.pge-mxd.strch-sf .footer-all, body.pge-mxd.strch-sf .footer-all, body.pge-mxd #popdown-trigger .trigger-inner, body.pge-mxd .footer-all .footer, body.pge-mxd .footer-all #subfooter { margin-right: 0;}';
		}
	?>

	<?php
		if ($options['page_layout'] == 'pge-mxd') {
			echo '
				body.pge-mxd.strch-top .top-and-pop,
				body.pge-mxd.strch-allhd .top-and-pop,
				body.pge-mxd.strch-allhd .header-all,
				body.pge-mxd.strch-allft .footer-all .footer,
				body.pge-mxd.strch-sf .footer-all #subfooter,
				body.pge-mxd.strch-allft .footer-all #subfooter,
				body.pge-mxd.strch-sf .footer-all {margin-left: 0; margin-right: 0; }
				body.pge-mxd.strch-sf.sf-fld .footer-all .subfooter-inner,
				body.pge-mxd.strch-sf.sf-fld .footer-all .footer-inner,
				body.pge-mxd.strch-allft.allft-fld .footer-all .subfooter-inner,
				body.pge-mxd.strch-allft.allft-fld .footer-all .footer-inner,
				body.pge-mxd.strch-top.top-fld .popdown-inner,
				body.pge-mxd.strch-top.top-fld .trigger-inner,
				body.pge-mxd.strch-top.top-fld .tophead-inner,
				body.pge-mxd.strch-allhd.allhd-fld .popdown-inner,
				body.pge-mxd.strch-allhd.allhd-fld .trigger-inner,
				body.pge-mxd.strch-allhd.allhd-fld .tophead-inner,
				body.pge-mxd.strch-allhd.allhd-fld .header-inner,
				body.pge-mxd.strch-allhd.allhd-fld .solonav-inner { margin-left:0; margin-right:0;}
			';
		}
	?>

	<?php
		if ($options['show_tophead_phone'] != 1) {
			echo '
			body.pge-bxd.t-mrg .top-and-pop .popdown,
			body.pge-mxd.t-mrg .top-and-pop .popdown {
				border-bottom-right-radius:' . absint($options['page_rounded_corners']) . 'px;
				border-bottom-left-radius:' . absint($options['page_rounded_corners']) . 'px;
			}
			body.pge-mxd.t-mrg.strch-allhd .top-and-pop  .popdown,
			body.pge-mxd.t-mrg.strch-top .top-and-pop  .popdown {
				border-bottom-right-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
			}
			body.pge-mxd.lft-mrg.t-mrg .top-and-pop .popdown,
			body.pge-fld.lft-mrg.t-mrg .top-and-pop .popdown {
				border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}
			body.pge-fld.rgt-mrg.t-mrg .top-and-pop .popdown,
			body.pge-mxd.rgt-mrg.t-mrg .top-and-pop .popdown {
				border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}';
		}
	?>

	.footer-inner,
	.content-inner,
	.intro-inner,
	.solonav-inner,
	.header-inner,
	.tophead-inner,
	.popdown-inner,
	.subfooter-inner {padding-left: 20px; padding-right: 20px;}
	.breadcrumbs {margin: 0 -20px 0; padding: 0 20px 0; }
	#slide-out-box.im-box {
		margin-left: -20px;
		margin-right: -20px;
		padding-left: 20px;
		padding-right: 20px;
	}
	.page-template-template-note-block-php .content-outer.left-intro-box .content-inner {padding: 20px !important;}
	#slide-out-box.im-box {padding-right: 60px;}

	.left-sidebar #content .tcs-block-outer.tcs-fullwidth,
	.right-sidebar #content .tcs-block-outer.tcs-fullwidth {
		margin-left: -20px;
		margin-right: -20px;
	}
	.left-sidebar #content .tcs-block-outer.tcs-fullwidth .tcs-block-wrap,
	.right-sidebar #content .tcs-block-outer.tcs-fullwidth .tcs-block-wrap  {
		padding-left: 20px;
		padding-right: 20px;
	}

	<?php
		if ($options['sidebar_convert'] != 'never') {
			echo '
				.right-sidebar .breadcrumbs, .left-sidebar .breadcrumbs {margin: 0 -9px 0; padding: 0 20px 0; }
			';
		}
	?>
	.slider-wrap .ls-reactskin a.ls-nav-start,
	.slider-wrap .ls-reactskin a.ls-nav-stop {
		left: -5px;
	}
	.ls-bottom-slidebuttons {
		padding-right: 20px;
	}
	.slider-wrap .ls-reactskin a.ls-nav-prev {
		left: 5px;
	}
	.slider-wrap .ls-reactskin a.ls-nav-next {
		right: 5px;
	}
	ul .im-trigger.im-active:hover span.im-desc,
	ul .im-trigger:hover span.im-desc,
	ul li:hover .im-trigger.im-active span.im-desc,
	.im-trigger span.im-desc:hover,
	ul:hover .im-trigger span.im-desc,
	.im-trigger span.im-desc {
		left: 0;
		right: 0;
		bottom: auto;
		top: 0;
		margin-left: 0;
		margin-right: 0;
		min-height: auto;
		height: auto;
		padding: 5px 0 5px 0;
		line-height: 26px;
		font-size: 100%;
		width: 100%;
		max-width: 100%;
		position: fixed;
		z-index: 100;
		border-radius: 0;
		opacity: 0;
	}
	ul .im-trigger.im-active:hover span.im-desc,
	ul li:hover .im-trigger.im-active span.im-desc {
		opacity: 1;
	}
	.im-trigger span.im-desc:after,
	.logo-r .im-trigger span.im-desc:after {
		border-width: 6px;
		left: 50%;
		right: auto;
		margin-left: -3px;
		margin-right: auto;
		border-radius: 0;
	}

	<?php
		if ($options['page_layout_tophead_right_padding_phones'] != 0) {
			echo '#tophead .tophead-wrap {padding-right: ' .  absint($options['page_layout_tophead_right_padding_phones']) . 'px;}
				.dismissed #tophead .tophead-wrap {padding-right: 35px;}
			';
		}
	?>
	<?php
		if ($options['page_layout_header_right_padding_phones'] != 0) {
			echo '#header .header-wrap {padding-right: ' .  absint($options['page_layout_header_right_padding_phones']) . 'px;}
				.dismissed #header .header-wrap {padding-right: 0;}
			';
		}
	?>
	<?php
		if ($options['page_layout_subfoot_right_padding_phones'] != 0) {
			echo '#subfooter .subfooter-wrap {padding-right: ' .  absint($options['page_layout_subfoot_right_padding_phones']) . 'px;}';
		}
	?>



	<?php /* Remove border radius if tablet margin is not 0 or greater */ ?>
	<?php
		if ($options['page_layout_left_margin_phones'] == 0 || ($options['page_layout_left_margin_phones'] == -1 && $options['page_layout_left_margin'] < 1)) {


			echo '
			body .after-header-wrap > div:last-child,
			body .after-header-wrap > div:last-child,
			body .header-all > div:last-child,
			body .top-and-pop > div:last-child,
			body .header-all > div:last-child > div,
			body .after-header-wrap > div:last-child > div,
			body .top-and-pop > div:last-child > div,
			body .header-all > div:last-child > div > div,
			body .after-header-wrap > div:last-child > div > div,
			body .top-and-pop > div:last-child > div > div {
				border-top-left-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
				border-left: none 0 !important;
			}

			body .footer-all,
			body .footer-all .footer,
			body .footer-all .footer,

			body .footer-all #subfooter,
			body .footer-all #subfooter,

			body .header-all,
			body .header-all > div.first-child,
			body .header-all > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.first-child,
			body .after-header-wrap > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .header-all,
			body .header-all > div.last-child,

			body .top-and-pop,
			body .top-and-pop .popdown,
			body .top-and-pop > div.last-child:not(.abso-on),

			body .footer-all .footer > div,
			body .footer-all .footer > div,

			body .footer-all #subfooter > div,
			body .footer-all #subfooter > div,

			body .header-all > div.first-child > div,
			body .header-all > div:first-child > div,

			body .header-all > div.last-child > div,

			body .after-header-wrap > div.first-child > div,
			body .after-header-wrap > div:first-child > div,

			body .after-header-wrap > div.last-child > div,

			body .top-and-pop > div.last-child:not(#popdown-trigger) > div,

			body .footer-all .footer > div > div,
			body .footer-all .footer > div > div,

			body .footer-all #subfooter > div > div,
			body .footer-all #subfooter > div > div,

			body .header-all > div.first-child > div > div,
			body .header-all > div:first-child > div > div,

			body .header-all > div.last-child > div > div,

			body .after-header-wrap > div.first-child > div > div,
			body .after-header-wrap > div:first-child > div > div,

			body .after-header-wrap > div.last-child > div > div,

			body .top-and-pop > div.last-child > div > div,


			body .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
			body .slider-wrap,
			body .slider-wrap .slider-inner,
			body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

			body.pge-bxd.b-mrg .footer-all #subfooter,
			body.pge-mxd.b-mrg .footer-all #subfooter {
				border-top-left-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
				border-left: none 0 !important;
			}'; // top left, bottom left - removes radius for no margin in tablets

		}
	?>
	<?php
		if ($options['page_layout_right_margin_phones'] == 0 || ($options['page_layout_right_margin_phones'] == -1 && $options['page_layout_right_margin'] < 1)) {
			echo '
			body .after-header-wrap > div:last-child,
			body .after-header-wrap > div:last-child,
			body .header-all > div:last-child,
			body .top-and-pop > div:last-child,
			body .header-all > div:last-child > div,
			body .after-header-wrap > div:last-child > div,
			body .top-and-pop > div:last-child > div,
			body .header-all > div:last-child > div > div,
			body .after-header-wrap > div:last-child > div > div,
			body .top-and-pop > div:last-child > div > div {
				border-top-right-radius: 0 !important;
				border-bottom-right-radius: 0 !important;
				border-right: none 0 !important;
			}
			body .footer-all,
			body .footer-all .footer,
			body .footer-all .footer,

			body .footer-all #subfooter,
			body .footer-all #subfooter,

			body .header-all,
			body .header-all > div.first-child,
			body .header-all > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.first-child,
			body .after-header-wrap > div:first-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .after-header-wrap,
			body .after-header-wrap > div.last-child,

			body .header-all,
			body .header-all > div.last-child,

			body .top-and-pop,
			body .top-and-pop .popdown,
			body .top-and-pop > div.last-child:not(.abso-on),

			body .footer-all .footer > div,
			body .footer-all .footer > div,

			body .footer-all #subfooter > div,
			body .footer-all #subfooter > div,

			body .header-all > div.first-child > div,
			body .header-all > div:first-child > div,

			body .header-all > div.last-child > div,

			body .after-header-wrap > div.first-child > div,
			body .after-header-wrap > div:first-child > div,

			body .after-header-wrap > div.last-child > div,

			body .top-and-pop > div.last-child > div,

			body .footer-all .footer > div > div,
			body .footer-all .footer > div > div,

			body .footer-all #subfooter > div > div,
			body .footer-all #subfooter > div > div,

			body .header-all > div.first-child > div > div,
			body .header-all > div:first-child > div > div,

			body .header-all > div.last-child > div > div,

			body .after-header-wrap > div.first-child > div > div,
			body .after-header-wrap > div:first-child > div > div,

			body .after-header-wrap > div.last-child > div > div,

			body .top-and-pop > div.last-child > div > div,


			body .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
			body .slider-wrap,
			body .slider-wrap .slider-inner,
			body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

			body.pge-bxd.b-mrg .footer-all #subfooter,
			body.pge-mxd.b-mrg .footer-all #subfooter {
				border-top-right-radius: 0 !important;
				border-bottom-right-radius: 0 !important;
				border-right: none 0 !important;
			}'; // top right, bottom right - removes radius for no margin in tablets

		}
	?>

	.im-over-5 .device-top-menu-trigger-wrap, .im-over-5 .device-menu-trigger-wrap {
		top: -60px;
	}
	body.pop-trig-abso .dismissed #popdown-trigger {
		right: 12px;
	}
	.im-over-5 .info-menu > ul {
		margin-left: -5px;
		margin-right: -5px;
	}
	#intro .breadcrumbs .back-home-icon {display: none!important;}
	.phone-text-center {text-align:center;}
	.phone-text-left {text-align:left;}
	.phone-text-right {text-align:right;}

	#intro.phone-text-center .breadcrumbs .back-home-icon {
		border: 0 none;
		display: block;
		float: none;
		height: 30px;
		margin-left: auto;
		margin-right: auto;
		margin-top: 10px;
		padding: 0;
		width: 30px;
	}
	#intro.phone-text-center .breadcrumbs .back-home-icon.plain-dark,
	#intro.phone-text-center .breadcrumbs .back-home-icon.plain-light {
		width: 20px;
		height: 22px;
	}
	#intro.phone-text-center .breadcrumbs .back-home-icon.plain-dark a.back-home,
	#intro.phone-text-center .breadcrumbs .back-home-icon.plain-light a.back-home {
		padding-bottom: 0;
	}

	#intro.phone-text-center .breadcrumbs-inner {
		padding-top: 3px;
		clear: both;
		display: block;
	}

	.phone-box-center {float: none; margin-left: auto; margin-right: auto; text-align:center;}
	.phone-box-left {float: left;}
	.phone-box-right {float: right;}


	<?php /* Kube responsive phone */ ?>

	.phone-width-100 {
		width: 100%;
	}

	.phone-width-100 {
		width: 100%;
	}
	.phone-width-100.units-row > .unit-90,
	.phone-width-100.units-row > .unit-80,
	.phone-width-100.units-row > .unit-75,
	.phone-width-100.units-row > .unit-70,
	.phone-width-100.units-row > .unit-66,
	.phone-width-100.units-row > .unit-65,
	.phone-width-100.units-row > .unit-60,
	.phone-width-100.units-row > .unit-50,
	.phone-width-100.units-row > .unit-40,
	.phone-width-100.units-row > .unit-35,
	.phone-width-100.units-row > .unit-33,
	.phone-width-100.units-row > .unit-30,
	.phone-width-100.units-row > .unit-25,
	.phone-width-100.units-row > .unit-20,
	.phone-width-100.units-row > .unit-10 {
		width: 100%;
		float: none;
		margin-left: 0;
		margin-bottom: 1.6em;
		border-left: none 0;
		min-height: 0 !important;
	}
	.phone-width-100.units-row.border-left > div {
		border-bottom-style: solid;
		border-bottom-width: 1px;
	}
	.phone-width-100.units-row.border-left > div:last-child {
		border-bottom: none 0;
	}

	.phone-width-100.units-row .unit-push-90,
	.phone-width-100.units-row .unit-push-80,
	.phone-width-100.units-row .unit-push-75,
	.phone-width-100.units-row .unit-push-70,
	.phone-width-100.units-row .unit-push-66,
	.phone-width-100.units-row .unit-push-65,
	.phone-width-100.units-row .unit-push-60,
	.phone-width-100.units-row .unit-push-50,
	.phone-width-100.units-row .unit-push-40,
	.phone-width-100.units-row .unit-push-35,
	.phone-width-100.units-row .unit-push-33,
	.phone-width-100.units-row .unit-push-30,
	.phone-width-100.units-row .unit-push-25,
	.phone-width-100.units-row .unit-push-20,
	.phone-width-100.units-row .unit-push-10 {
		left: 0;
	}
	.units-row .unit-push-right {
		float: none;
	}
	.units-phone-50 > .unit-90,
	.units-phone-50 > .unit-80,
	.units-phone-50 > .unit-75,
	.units-phone-50 > .unit-70,
	.units-phone-50 > .unit-66,
	.units-phone-50 > .unit-65,
	.units-phone-50 > .unit-60,
	.units-phone-50 > .unit-40,
	.units-phone-50 > .unit-30,
	.units-phone-50 > .unit-35,
	.units-phone-50 > .unit-33,
	.units-phone-50 > .unit-25,
	.units-phone-50 > .unit-20,
	.units-phone-50 > .unit-10 {
		float: left;
		margin-left: 3%;
		width: 48.5%;
		margin-bottom: 1.6em;
	}
	.units-phone-50.units-split > .unit-90,
	.units-phone-50.units-split > .unit-80,
	.units-phone-50.units-split > .unit-75,
	.units-phone-50.units-split > .unit-70,
	.units-phone-50.units-split > .unit-66,
	.units-phone-50.units-split > .unit-65,
	.units-phone-50.units-split > .unit-60,
	.units-phone-50.units-split > .unit-40,
	.units-phone-50.units-split > .unit-30,
	.units-phone-50.units-split > .unit-35,
	.units-phone-50.units-split > .unit-33,
	.units-phone-50.units-split > .unit-25,
	.units-phone-50.units-split > .unit-20,
	.units-phone-50.units-split > .unit-10 {
		float: left;
		margin-left: 0;
		width: 50%;
		margin-bottom: 1.6em;
	}
	.units-phone-50 > .unit-90:first-child,
	.units-phone-50 > .unit-80:first-child,
	.units-phone-50 > .unit-75:first-child,
	.units-phone-50 > .unit-70:first-child,
	.units-phone-50 > .unit-66:first-child,
	.units-phone-50 > .unit-65:first-child,
	.units-phone-50 > .unit-60:first-child,
	.units-phone-50 > .unit-40:first-child,
	.units-phone-50 > .unit-35:first-child,
	.units-phone-50 > .unit-30:first-child,
	.units-phone-50 > .unit-33:first-child,
	.units-phone-50 > .unit-25:first-child,
	.units-phone-50 > .unit-20:first-child,
	.units-phone-50 > .unit-10:first-child {
		margin-left: 0;
	}
	.units-phone-50.units-row > div:nth-child(odd) {
		border-left: none 0;
		margin-left: 0;
		clear: left;
	}
	.units-phone-50.units-row > div:nth-child(odd):last-child {
		width: 100%;
	}

	.units-phone-50.units-padding > .unit-100,
	.units-phone-50.units-padding > .unit-90,
	.units-phone-50.units-padding > .unit-80,
	.units-phone-50.units-padding > .unit-75,
	.units-phone-50.units-padding > .unit-70,
	.units-phone-50.units-padding > .unit-66,
	.units-phone-50.units-padding > .unit-65,
	.units-phone-50.units-padding > .unit-60,
	.units-phone-50.units-padding > .unit-50,
	.units-phone-50.units-padding > .unit-40,
	.units-phone-50.units-padding > .unit-35,
	.units-phone-50.units-padding > .unit-33,
	.units-phone-50.units-padding > .unit-30,
	.units-phone-50.units-padding > .unit-25,
	.units-phone-50.units-padding > .unit-20,
	.units-phone-50.units-padding > .unit-10,

	.phone-width-100.units-padding > .unit-100,
	.phone-width-100.units-padding > .unit-90,
	.phone-width-100.units-padding > .unit-80,
	.phone-width-100.units-padding > .unit-75,
	.phone-width-100.units-padding > .unit-70,
	.phone-width-100.units-padding > .unit-66,
	.phone-width-100.units-padding > .unit-65,
	.phone-width-100.units-padding > .unit-60,
	.phone-width-100.units-padding > .unit-50,
	.phone-width-100.units-padding > .unit-40,
	.phone-width-100.units-padding > .unit-35,
	.phone-width-100.units-padding > .unit-33,
	.phone-width-100.units-padding > .unit-30,
	.phone-width-100.units-padding > .unit-25,
	.phone-width-100.units-padding > .unit-20,
	.phone-width-100.units-padding > .unit-10 {
	  padding: 2.5em 1.5em;
	}

}

<?php /* ONLY AT large screens */ ?>
@media only screen and (min-width: <?php echo absint($tv); ?>px) {
	<?php
	if ($options['page_layout_sections_margin_tv'] > 0) {
			echo '.after-header-wrap { margin-bottom: ' . absint($options['page_layout_sections_margin_tv']) . 'px; margin-top: ' . absint($options['page_layout_sections_margin_tv']) . 'px;} .slider-wrap {margin-top: ' . absint($options['page_layout_sections_margin_tv']) . 'px;}' ;
		}
	?>

	<?php
	if ($options['show_tophead_large'] != 1) {
			echo 'body #tophead {display: none;}' ;
		}
	?>
	<?php
	if (!$options['show_solonav_large']) {
			echo '#solonav {display: none;}' ;
		}
	?>
	<?php
	if (!$options['show_popdown_large']) {
			echo '.popdown, #popdown-trigger {display: none !important;}' ;
		}
	?>
	<?php
	if ($options['show_infomenu_large'] != 1) {
			echo '.info-menu, .im-box  {display: none;}
			#nav-wrap, body.logo-r #nav-wrap {
				min-height:1px;
			}

			.device-menu-trigger-wrap, .device-top-menu-trigger-wrap {
				top: -60px;
			}

			' ;
		}
	?>

	<?php
	if ($options['show_subfooter_large'] != 1) {
			echo '#subfooter {display: none;}
				body.pge-bxd-cnt.rgt-mrg.b-mrg .footer-all #subfooter,
				body.pge-fld.rgt-mrg.b-mrg .footer-all #subfooter {
					border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
				}
				body.pge-bxd-cnt.lft-mrg.b-mrg .footer-all #subfooter,
				body.pge-fld.lft-mrg.b-mrg .footer-all #subfooter {
					border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
				}
				body.pge-mxd.ft-fix.b-mrg .footer-all .footer,
				body.pge-bxd.ft-fix.b-mrg .footer-all .footer,
				body.pge-mxd.b-mrg .footer-all .footer,
				body.pge-bxd.b-mrg .footer-all .footer {
					border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
					border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
				}
			' ;
		}
	?>
	<?php
		if ($options['page_layout'] == 'pge-mxd') {
			echo '
			body.pge-mxd.strch-top .top-and-pop,  body.pge-mxd.strch-allhd .top-and-pop, body.pge-mxd.strch-allhd .header-all, body.pge-mxd.strch-allft .footer-all .footer, body.pge-mxd.strch-sf .footer-all #subfooter,  body.pge-mxd.strch-allft .footer-all #subfooter, body.pge-mxd.strch-sf .footer-all {margin-left: 0; margin-right: 0; }
			body.pge-mxd.strch-sf.sf-fld .footer-all .subfooter-inner, body.pge-mxd.strch-sf.sf-fld .footer-all .footer-inner,
			body.pge-mxd.strch-allft.allft-fld .footer-all .subfooter-inner, body.pge-mxd.strch-allft.allft-fld .footer-all .footer-inner,
			body.pge-mxd.strch-top.top-fld .popdown-inner, body.pge-mxd.strch-top.top-fld .trigger-inner, body.pge-mxd.strch-top.top-fld .tophead-inner,
			body.pge-mxd.strch-allhd.allhd-fld .popdown-inner, body.pge-mxd.strch-allhd.allhd-fld .trigger-inner, body.pge-mxd.strch-allhd.allhd-fld .tophead-inner, body.pge-mxd.strch-allhd.allhd-fld .header-inner, body.pge-mxd.strch-allhd.allhd-fld .solonav-inner { margin-left:0; margin-right:0;}
			';
		}
	?>
	<?php
		if ($options['show_tophead_large']) {
			echo '
			body.pge-bxd.t-mrg .top-and-pop .popdown,
			body.pge-mxd.t-mrg .top-and-pop .popdown {
				border-bottom-right-radius:' . absint($options['page_rounded_corners']) . 'px;
				border-bottom-left-radius:' . absint($options['page_rounded_corners']) . 'px;
			}
			body.pge-mxd.t-mrg.strch-allhd .top-and-pop  .popdown,
			body.pge-mxd.t-mrg.strch-top .top-and-pop  .popdown {
				border-bottom-right-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
			}
			body.pge-mxd.lft-mrg.t-mrg .top-and-pop .popdown,
			body.pge-fld.lft-mrg.t-mrg .top-and-pop .popdown {
				border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}
			body.pge-fld.rgt-mrg.t-mrg .top-and-pop .popdown,
			body.pge-mxd.rgt-mrg.t-mrg .top-and-pop .popdown {
				border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}';
		}
	?>
	.im-box.im-drop {width: <?php echo absint($options['infomenu_dropdown_width_large']); ?>px;}

	<?php
		if ($options['page_layout_tophead_right_padding_tv'] != 0) {
			echo '#tophead .tophead-wrap {padding-right: ' .  absint($options['page_layout_tophead_right_padding_tv']) . 'px;}
				.dismissed #tophead .tophead-wrap {padding-right: 35px;}
			';
		}
	?>
	<?php
		if ($options['page_layout_header_right_padding_tv'] != 0) {
			echo '#header .header-wrap {padding-right: ' .  absint($options['page_layout_header_right_padding_tv']) . 'px;}
				.dismissed #header .header-wrap {padding-right: 0;}
			';
		}
	?>
	<?php
		if ($options['page_layout_subfoot_right_padding_tv'] != 0) {
			echo '#subfooter .subfooter-wrap {padding-right: ' .  absint($options['page_layout_subfoot_right_padding_tv']) . 'px;}';
		}
	?>

}
<?php /* ONLY AT DESKTOP / LAPTOP */ ?>

@media only screen and (min-width: <?php echo absint($desktop); ?>px) and (max-width: <?php echo (absint($tv) - 1); ?>px) {
	<?php
	if (!$options['show_popdown_desktop']) {
			echo '.popdown, #popdown-trigger {display: none !important;}' ;
		}
	?>
	<?php
	if (!$options['show_tophead_desktop']) {
			echo '#tophead {display: none;}' ;
		}
	?>
	<?php
	if ($options['show_infomenu_desktop'] != 1) {
			echo '.info-menu, .im-box  {display: none;}
			#nav-wrap, body.logo-r #nav-wrap {
				min-height: 1px;
			}

			.device-menu-trigger-wrap, .device-top-menu-trigger-wrap {
				top: -60px
			}

			' ;
		}
	?>
	<?php
	if (!$options['show_solonav_desktop']) {
			echo '#solonav {display: none;}' ;
		}
	?>
	<?php
	if (!$options['show_subfooter_desktop']) {
			echo '
				#subfooter {display: none;}
				body.pge-bxd-cnt.rgt-mrg.b-mrg .footer-all #subfooter,
				body.pge-fld.rgt-mrg.b-mrg .footer-all #subfooter {
					border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
				}
				body.pge-bxd-cnt.lft-mrg.b-mrg .footer-all #subfooter,
				body.pge-fld.lft-mrg.b-mrg .footer-all #subfooter {
					border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
				}

				body.pge-mxd.ft-fix.b-mrg .footer-all .footer,
				body.pge-bxd.ft-fix.b-mrg .footer-all .footer,
				body.pge-mxd.b-mrg .footer-all .footer,
				body.pge-bxd.b-mrg .footer-all .footer {
					border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
					border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px!important;
				}

			' ;
		}
	?>
	<?php /* IS THE NEEDED? */ ?>
	<?php
		if (!$options['show_tophead_desktop']) {
			echo '
			body.pge-bxd.t-mrg .top-and-pop .popdown,
			body.pge-mxd.t-mrg .top-and-pop .popdown {
				border-bottom-right-radius:' . absint($options['page_rounded_corners']) . 'px;
				border-bottom-left-radius:' . absint($options['page_rounded_corners']) . 'px;
			}
			body.pge-mxd.t-mrg.strch-allhd .top-and-pop  .popdown,
			body.pge-mxd.t-mrg.strch-top .top-and-pop  .popdown {
				border-bottom-right-radius: 0 !important;
				border-bottom-left-radius: 0 !important;
			}
			body.pge-mxd.lft-mrg.t-mrg .top-and-pop .popdown,
			body.pge-fld.lft-mrg.t-mrg .top-and-pop .popdown {
				border-bottom-left-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}
			body.pge-fld.rgt-mrg.t-mrg .top-and-pop .popdown,
			body.pge-mxd.rgt-mrg.t-mrg .top-and-pop .popdown {
				border-bottom-right-radius: ' . absint($options['page_rounded_corners']) . 'px;
			}';
		}
	?>


	<?php
		if ($options['page_layout'] == 'pge-bxd-cnt' || $options['page_layout'] == 'pge-fld') {

		if ($options['page_layout_left_margin'] < 1) {
				echo '
					body .after-header-wrap > div:last-child,
					body .after-header-wrap > div:last-child,
					body .header-all > div:last-child,
					body .top-and-pop > div:last-child,
					body .header-all > div:last-child > div,
					body .after-header-wrap > div:last-child > div,
					body .top-and-pop > div:last-child > div,
					body .header-all > div:last-child > div > div,
					body .after-header-wrap > div:last-child > div > div,
					body .top-and-pop > div:last-child > div > div {
						border-top-left-radius: 0 !important;
						border-bottom-left-radius: 0 !important;
						border-left: none 0 !important;
					}

					body .footer-all,
					body .footer-all .footer,
					body .footer-all .footer,

					body .footer-all #subfooter,
					body .footer-all #subfooter,

					body .header-all,
					body .header-all > div.first-child,
					body .header-all > div:first-child,

					body .after-header-wrap,
					body .after-header-wrap > div.first-child,
					body .after-header-wrap > div:first-child,

					body .after-header-wrap,
					body .after-header-wrap > div.last-child,


					body .after-header-wrap,
					body .after-header-wrap > div.last-child,


					body .header-all,
					body .header-all > div.last-child,


					body .top-and-pop,
					body .top-and-pop .popdown,
					body .top-and-pop > div.last-child:not(.abso-on),


					body .footer-all .footer > div,
					body .footer-all .footer > div,

					body .footer-all #subfooter > div,
					body .footer-all #subfooter > div,

					body .header-all > div.first-child > div,
					body .header-all > div:first-child > div,

					body .header-all > div.last-child > div,


					body .after-header-wrap > div.first-child > div,
					body .after-header-wrap > div:first-child > div,

					body .after-header-wrap > div.last-child > div,


					body .top-and-pop > div.last-child > div,

					body .footer-all .footer > div > div,
					body .footer-all .footer > div > div,

					body .footer-all #subfooter > div > div,
					body .footer-all #subfooter > div > div,

					body .header-all > div.first-child > div > div,
					body .header-all > div:first-child > div > div,

					body .header-all > div.last-child > div > div,


					body .after-header-wrap > div.first-child > div > div,
					body .after-header-wrap > div:first-child > div > div,

					body .after-header-wrap > div.last-child > div > div,

					body .top-and-pop > div.last-child > div > div,

					body.v-mrg .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
					body .slider-wrap,
					body .slider-wrap .slider-inner,
					body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

					body.pge-bxd.ft-fix.b-mrg .footer-all #subfooter,
					body.pge-mxd.ft-fix.b-mrg .footer-all #subfooter {
						border-top-left-radius: 0 !important;
						border-bottom-left-radius: 0 !important;
						border-left: none 0 !important;
					}
				';
			}
			if ($options['page_layout_right_margin'] < 1) {
				echo '
					body .after-header-wrap > div:last-child,
					body .after-header-wrap > div:last-child,
					body .after-header-wrap > div:last-child,
					body .header-all > div:last-child,
					body .top-and-pop > div:last-child,
					body .header-all > div:last-child > div,
					body .after-header-wrap > div:last-child > div,
					body .top-and-pop > div:last-child > div,
					body .header-all > div:last-child > div > div,
					body .after-header-wrap > div:last-child > div > div,
					body .top-and-pop > div:last-child > div > div {
						border-top-right-radius: 0 !important;
						border-bottom-right-radius: 0 !important;
						border-right: none 0 !important;
					}


					body .footer-all,
					body .footer-all .footer,
					body .footer-all .footer,

					body .footer-all #subfooter,
					body .footer-all #subfooter,

					body .header-all,
					body .header-all > div.first-child,
					body .header-all > div:first-child,

					body .after-header-wrap,
					body .after-header-wrap > div.first-child,
					body .after-header-wrap > div:first-child,

					body .after-header-wrap,
					body .after-header-wrap > div.last-child,


					body .after-header-wrap,
					body .after-header-wrap > div.last-child,


					body .header-all,
					body .header-all > div.last-child,


					body .top-and-pop,
					body .top-and-pop .popdown,
					body .top-and-pop > div.last-child:not(.abso-on),


					body .footer-all .footer > div,
					body .footer-all .footer > div,

					body .footer-all #subfooter > div,
					body .footer-all #subfooter > div,

					body .header-all > div.first-child > div,
					body .header-all > div:first-child > div,

					body .header-all > div.last-child > div,

					body .after-header-wrap > div.first-child > div,
					body .after-header-wrap > div:first-child > div,

					body .after-header-wrap > div.last-child > div,

					body .top-and-pop > div.last-child > div,

					body .footer-all .footer > div > div,
					body .footer-all .footer > div > div,

					body .footer-all #subfooter > div > div,
					body .footer-all #subfooter > div > div,

					body .header-all > div.first-child > div > div,
					body .header-all > div:first-child > div > div,

					body .header-all > div.last-child > div > div,

					body .after-header-wrap > div.first-child > div > div,
					body .after-header-wrap > div:first-child > div > div,

					body .after-header-wrap > div.last-child > div > div,

					body .top-and-pop > div.last-child > div > div,


					body.v-mrg .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper,
					body .slider-wrap,
					body .slider-wrap .slider-inner,
					body .slider-wrap .rev_slider_wrapper .rev_slider ul > li,

					body.pge-bxd.ft-fix.b-mrg .footer-all #subfooter,
					body.pge-mxd.ft-fix.b-mrg .footer-all #subfooter {
						border-top-right-radius: 0 !important;
						border-bottom-right-radius: 0 !important;
						border-right: none 0 !important;
					}
				';
			}
		}
	?>

}

<?php /* Slider options */ ?>

<?php
	if ($options['component_slider_stretched']) {
		echo '
			body.pge-mxd .slider-wrap, body.pge-bxd .slider-wrap,
			body.pge-fld .slider-wrap, body.pge-bxd-cnt .slider-wrap,
			body.pge-mxd .slider-wrap .slider-inner, body.pge-bxd .slider-wrap .slider-inner,
			body.pge-fld .slider-wrap .slider-inner, body.pge-bxd-cnt .slider-wrap .slider-inner,
			body.pge-mxd .slider-wrap .rev_slider_wrapper .rev_slider ul > li, body.pge-bxd .slider-wrap .rev_slider_wrapper .rev_slider ul > li,
			body.pge-fld .slider-wrap .rev_slider_wrapper .rev_slider ul > li, body.pge-bxd-cnt .slider-wrap .rev_slider_wrapper .rev_slider ul > li,
			body .slider-wrap .ls-reactskin .ls-bottom-nav-wrapper {
				margin-left: 0 !important;
				margin-right: 0 !important;
				border-radius: 0 !important;
				border-right: none 0 !important; border-left: none 0 !important;
			}';
	}
?>

<?php /* Smaller than phone portrait */ ?>

@media only screen and (max-width: <?php echo absint($phonePtr); ?>px) {

}

<?php /* Smaller than phone landscape */ ?>

@media only screen and (max-width: <?php echo absint($phoneLdsp); ?>px) {

	<?php /* because animations are off */ ?>
	<?php if (!$options['advanced_enable_animations_phone']) : ?>
		.hide-ft-after-top.ft-fix #subfooter {position: relative ;}
		.hide-ft-after-top.ft-fix #subfooter-toggle {bottom: 0; opacity: 1; max-height: 20px;}
	<?php endif; ?>

	.tcs-menu.tcs-inline ul li {
			float: none;
			display: block;
			margin-right: 0;
			margin-bottom: 5px;
		}
		.tcs-menu.tcs-inline.tcs-grouped ul li,
		.tcs-menu.tcs-inline.tcs-grouped ul.menu li {
			margin: 0;
		}
		.tcs-menu.tcs-inline ul li a {
			border-right-width: 0;
			border-right-style: none;
			border-radius: <?php echo absint($options['element_rounded_corners']); ?>px;
			float: none;
			display: block;
		}
		.tcs-menu.tcs-inline.tcs-menu-separator ul li a,
		.tcs-menu.tcs-inline.tcs-menu-separator ul li {
			border-right-width: 0;
			border-right-style: none;
			padding-right: 0 !important;
			padding-left: 0 !important;
		}
		.tcs-menu.tcs-inline.tcs-grouped ul li a,
		.tcs-menu.tcs-inline.tcs-grouped ul.menu li a {
			border-right-width: 0;
			border-right-style: none;
			border-radius: 0;
			float: none;
			display: block;
		}
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-two ul li:first-child a,
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-one ul li:first-child a,
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-two ul.menu li:first-child a,
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-one ul.menu li:first-child a {
			border-radius: <?php echo absint($options['element_rounded_corners']); ?>px <?php echo absint($options['element_rounded_corners']); ?>px 0 0;
		}
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-two ul li:last-child a,
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-one ul li:last-child a,
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-two ul.menu li:last-child a,
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-one ul.menu li:last-child a {
			border-radius: 0 0 <?php echo absint($options['element_rounded_corners']); ?>px <?php echo absint($options['element_rounded_corners']); ?>px;
		}
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-one ul li:not(:last-child) a,
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-two ul li:not(:last-child) a,
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-one ul.menu li:not(:last-child) a,
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-two ul.menu li:not(:last-child) a {
			 box-shadow: none;
		}
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-two ul li:not(:last-child) a,
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-two ul.menu li:not(:last-child) a {
			 border-bottom: 0 none;
		}
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-one ul li:not(:last-child) a,
		.tcs-menu.tcs-inline.tcs-grouped.tcs-menu-button-style-one ul.menu li:not(:last-child) a {
			 border-bottom-width: 1px;
			 border-bottom-style: solid;
		}
}

<?php /* Smaller than tablet portrait */ ?>

@media only screen and (max-width: <?php echo absint($tabletPtr); ?>px) {
	.hide-tablet-ptr {display:none !important;}
}

<?php /* Smaller than tablet landscape */ ?>

@media only screen and (max-width: <?php echo absint($tabletLdsp); ?>px) {
	<?php /* becuase animations are off */ ?>
	<?php
		if (!$options['advanced_enable_animations_tablet']){
			echo '
			.hide-ft-after-top.ft-fix #subfooter {position: relative ;}/* becuase animations are off */
			.hide-ft-after-top.ft-fix #subfooter-toggle {bottom: 0; opacity: 1; max-height: 20px;}';
		}
	?>
}

<?php /* page template fix */ ?>
body.page-template-template-fullscreen-media-php .footer-all #subfooter,
body.page-template-template-note-block-php .footer-all.left-intro-box-foot #subfooter {
	bottom: 0 !important;
	left: 0 !important;
	right: 0 !important;
	width: 100% !important;
	max-width: 100% !important;
	margin: 0 !important;
	border-radius:0 !important;
	position: fixed;
}
<?php /* Topheader Menu fix */ ?>
<?php
	if ($options['header_contact_phone'] == '' && $options['header_contact_phone_sales'] == '' && $options['header_contact_phone_support'] == '' && $options['head_contact_quform_id'] == 'none' && $options['head_contact_quform_id_sales'] == 'none' && $options['head_contact_quform_id_support'] == 'none' && $options['top_header_info_box'] == '' ){
		echo '.contact-details-top-head .divide, .sidr.right .sidr-sep, .contact-details-top-head {display: none;}';
	}
?>
<?php /* Nav button style gradients */ ?>
<?php
	if ($options['general_color_default_buttonnav_gradient']) {
		if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') {
		echo '#header.stickied.button-nav ul.react-menu > li > a, #header.stickied.button-nav.hover ul.react-menu > li.sfHover > a, #header.stickied.button-nav.hover ul.react-menu > li > a:hover,';
		}
		echo '
		#header #nav-wrap.button-nav ul.react-menu > li > a, #header #nav-wrap.button-nav.hover ul.react-menu > li.sfHover > a, #header #nav-wrap.button-nav.hover ul.react-menu > li > a:hover, .device-menu-trigger-wrap.button-nav, .device-top-menu-trigger-wrap.button-nav {
			background-image: -moz-linear-gradient(top, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
			background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.1)), color-stop(100%,rgba(0,0,0,0.1)));
			background-image: -webkit-linear-gradient(top, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
			background-image: -o-linear-gradient(top, rgba(255,255,255,0.1) 0%,rgba(0,0,0,0.1) 100%);
			background-image: -ms-linear-gradient(top, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
			background-image: linear-gradient(to bottom, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
		}';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_gradient']) {
		if ($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') {
		echo '#header.stickied.button-nav ul.react-menu > li > a, #header.stickied.button-nav.hover ul.react-menu > li.sfHover > a, #header.stickied.button-nav.hover ul.react-menu > li > a:hover,';
		}
		echo '
		#solonav .button-nav ul.react-menu > li > a, #solonav .button-nav.hover ul.react-menu > li.sfHover > a, #solonav .button-nav.hover ul.react-menu > li > a:hover {
			background-image: -moz-linear-gradient(top, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
			background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.1)), color-stop(100%,rgba(0,0,0,0.1)));
			background-image: -webkit-linear-gradient(top, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
			background-image: -o-linear-gradient(top, rgba(255,255,255,0.1) 0%,rgba(0,0,0,0.1) 100%);
			background-image: -ms-linear-gradient(top, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
			background-image: linear-gradient(to bottom, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
		}';
	}
?>
<?php
	if ($options['general_color_topheader_buttonnav_gradient']) {
		echo '
		#tophead .button-nav ul.react-menu > li > a, #tophead .button-nav.hover ul.react-menu > li.sfHover > a, #tophead .button-nav.hover ul.react-menu > li > a:hover {
			background-image: -moz-linear-gradient(top, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
			background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.1)), color-stop(100%,rgba(0,0,0,0.1)));
			background-image: -webkit-linear-gradient(top, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
			background-image: -o-linear-gradient(top, rgba(255,255,255,0.1) 0%,rgba(0,0,0,0.1) 100%);
			background-image: -ms-linear-gradient(top, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
			background-image: linear-gradient(to bottom, rgba(255,255,255,0.1) 0%, rgba(0,0,0,0.1) 100%);
		}';
	}
?>
<?php /* Global colors START */ ?>
<?php
	if ($options['general_color_site_background']) {
		echo '
			body, .serene-overlay, .fullscreen-slide {
				' . react_css_color($options['general_color_site_background']) . '
			}
		';
	}
?>
<?php
	if ($options['general_color_site_background_gradient']) {
		echo '
		body {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($options['general_color_site_background_much_darker']) . ' 0%, ' . react_sanitize_color($options['general_color_site_background_even_lighter']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($options['general_color_site_background_much_darker']) . '), color-stop(100%,' . react_sanitize_color($options['general_color_site_background_even_lighter']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($options['general_color_site_background_much_darker']) . ' 0%,' . react_sanitize_color($options['general_color_site_background_even_lighter']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($options['general_color_site_background_much_darker']) . ' 0%,' . react_sanitize_color($options['general_color_site_background_even_lighter']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($options['general_color_site_background_much_darker']) . ' 0%,' . react_sanitize_color($options['general_color_site_background_even_lighter']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($options['general_color_site_background_much_darker']) . ' 0%,' . react_sanitize_color($options['general_color_site_background_even_lighter']) . ' 100%);
		}
		body {
			background-repeat: no-repeat;
			background-attachment: fixed;
		}

		';
	}
?>
<?php
	if ($options['general_color_text']) {
		echo '
		body,
		ul#recentcomments li:before,
		ul li.cat-item a:before,
		.widget_archive ul li a:before, .widget_pages ul li a:before {' . react_css_color($options['general_color_text'], 'color') . '}
		.tcs-button.tcs-holw-btn > a, .tcs-button.tcs-holw-btn > span.tcs-r-button,
		.tcs-button.tcs-holw-btn > a > i, .tcs-button.tcs-holw-btn > span.tcs-r-button > i {' . react_css_color($options['general_color_text'], 'color') . '}
		';
	}
?>
<?php
	if ($options['general_color_text_alt']) {
		echo '
			.widget_nav_menu ul.menu li ul a,
			.widget_pages ul.children li a,
			.widget_product_categories  ul.children li a,
			.widget_recent_entries ul.children li a,
			.widget_meta ul.children li a,
			.widget_archive ul.children li a,
			.widget_categories ul.children li a,
			ul.blogroll ul.children a,
			.widget_nav_menu ul.menu ul.children a,
			h3.comments-title i, h3.socialcount-title i, .author_bio_section h3 > i,
			.breadcrumbs,
			.entry-meta,
			.tcw-opening-times .tcw-open-time,
			.tcs-opening-times .tcs-open-time,
			.tcw-contact-details .tcw-contact-detail,
			.tcw-widget-post-info .tcw-widget-post-date,
			.widget_recent_entries .post-date,
			.tcs-pullquote,
			#intro h2.intro-subtitle,
			#wp-calendar td,
			table caption,
			table td,
			.tcs-fancy-table table td,
			.iphorm-theme-react-default p.iphorm-description,
			.wp-pagenavi span.pages,
			.tcp-portfolio .wp-pagenavi span.pages,
			.wp-pagenavi span.extend,
			.tcp-portfolio .wp-pagenavi span.extend,
			.comments-pagination-wrap .page-numbers.dots,
			.tcp-portfolio-item-title .tcp-portfolio-title-inner > a,
			.tcp-portfolio-item-title .post-like a .like,
			a.subtle-link,
			a.tcp-subtle-link,
			.tcs-accordion.tcs-plain > h3 > a,
			.comment-reply-wrap > h3 > a,
			span.subtle-link,
			.tcs-blockquote .tcs-qmark,
			.tcs-pullquote .tcs-qmark,
			.widget_rss .rssSummary,
			.text-alt {
				' . react_css_color($options['general_color_text_alt'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_links']) {
		echo '
			a:link, a:visited {
				' . react_css_color($options['general_color_links'], 'color') . '
			}
		';
		if ($options['general_color_links_hover'] == '') {
			echo '
				a:hover, a:active, a.subtle-link:hover, a.tcp-subtle-link:hover, span.subtle-link:hover, .tcs-accordion.tcs-plain > h3 > a:hover {
					color: #10a9bb;
				}
			';
		}
	}
?>
<?php
	if ($options['general_color_h1']) {
		echo '
			h1, .tcs-impact-heading {
				' . react_css_color($options['general_color_h1'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_h2']) {
		echo '
			h2, h2.entry-title a {
				' . react_css_color($options['general_color_h2'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_h3']) {
		echo '
			h3 {
				' . react_css_color($options['general_color_h3'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_h4']) {
		echo '
			h4 {
				' . react_css_color($options['general_color_h4'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_h5']) {
		echo '
			h5, h6 {
				' . react_css_color($options['general_color_h5'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_links_hover']) {
		echo '
			.widget_nav_menu ul.menu li ul a:hover,
			.widget_pages ul.children li a:hover,
			.widget_product_categories  ul.children li a:hover,
			.widget_recent_entries ul.children li a:hover,
			.widget_meta ul.children li a:hover,
			.widget_archive ul.children li a:hover,
			.widget_categories ul.children li a:hover,
			ul.blogroll ul.children a:hover,
			.widget_nav_menu ul.menu ul.children a:hover,
			a:hover, a:active, a.subtle-link:hover,
			a.tcp-subtle-link:hover,
			span.subtle-link:hover,
			.tcs-accordion.tcs-plain > h3 > a:hover,
			.comment-reply-wrap > h3 > a:hover,
			.tcp-portfolio-item-title .tcp-portfolio-title-inner > a:hover,
			.tcp-portfolio-item-title .post-like a:hover .like,
			.entry-title a:hover {
				' . react_css_color($options['general_color_links_hover'], 'color') . '
			}
		';
	}
?>
<?php /* Global Light Color */ ?>
<?php
	if ($options['general_color_global_light_bg']) {
		echo '
			span.tcs-icon.tcs-style-light {
				' . react_css_color($options['general_color_global_light_bg'], 'color') . '
			}
		';
	}
?>

<?php
	if ($options['general_color_global_light_bg'] !='' || $options['general_color_global_light_fg'] !='') {
		echo '
			.tcs-button.tcs-hollow-light > a,
			.tcs-button.tcs-hollow-light > span.tcs-r-button,
			span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-light {
				' . react_css_color($options['general_color_global_light_bg'], 'border-color') . '
				background-color: transparent;
			}
			.tcs-progress-bar-outer,
			.tcs-button.tcs-hollow-light > a.tcs-has-back-animation:before,
			.tcs-button.tcs-hollow-light > span.tcs-r-button.tcs-has-back-animation:before,
			.tcs-button.tcs-hollow-light > a.tcs-has-back-animation:hover:before,
			.tcs-button.tcs-hollow-light > span.tcs-r-button.tcs-has-back-animation:hover:before,
			.im-box-inner ul.wp-tag-cloud li a,
			.tagcloud > a,
			.tcp-portfolio-filter .tcp-filter-button,
			.tcs-menu.tcs-menu-button-style-two ul li a,
			.tcs-button.tcs-style-light > a,
			.tcs-button.tcs-style-light > span.tcs-r-button,
			.tcs-button.tcs-hollow-light > a:hover,
			.tcs-image-hover.tcs-hover-light,
			.tcs-button.tcs-hollow-light > span.tcs-r-button:hover,
			span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-light:hover,
			span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-light:before,
			span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-light:hover:before,
			.tcs-tabs ul.tcs-tabs-nav li a,
			ul#comment-tabs-nav li a,
			.tcs-accordion.tcs-box > h3,
			code, pre, kbd, tt,
			.iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
			.iphorm-theme-react-default .iphorm-upload-queue-file,
			.iphorm-theme-react-default .iphom-upload-progress-wrap,
			.tcs-impact-header.tcs-light,
			blockquote,
			.tcs-blockquote .tcs-blockquote-inner,
			.tcs-fancy-header.tcs-style3,
			.searchform label,
			.woocommerce.widget_product_search label,
			span.tcs-icon.tcs-boxed.tcs-style-light,
			.wpb_content_element.react.light .wpb_tabs_nav li.ui-tabs-active,
			.wpb_content_element.react .wpb_accordion_wrapper .wpb_accordion_header,
			.vc_progress_bar.react .vc_single_bar,
			.wpb_content_element.wpb_tabs.react.light .wpb_tour_tabs_wrapper .wpb_tab {
				' . react_css_color($options['general_color_global_light_bg']) . '
				' . react_css_color($options['general_color_global_light_fg'], 'color') . '
			}

		';
	}
?>
<?php
	if ($options['general_color_global_light_bg']) {
		echo '
			.tcs-blockquote .tcs-blockquote-inner:after, .tcs-fancy-header.tcs-style3:after, .searchform label:after, .woocommerce.widget_product_search label:after {
				' . react_css_color($options['general_color_global_light_bg'], 'border-top-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_light_bg']) {
		echo '
			.tcs-tabs ul.tcs-tabs-nav li a:hover,
			ul#comment-tabs-nav li a:hover,
			.tcs-accordion.tcs-box > h3:hover,
			.tcp-portfolio-filter .tcp-filter-button:hover,
			.iphorm-theme-react-default .iphorm-group-style-bordered .iphorm-element-wrap > .iphorm-element-spacer > label,
			.wpb_content_element.react .wpb_tabs_nav li {
				' . react_css_color($options['general_color_global_light_bg_darker']) . '
				' . react_css_color($options['general_color_global_light_fg_even_darker'], 'color') . '
			}

		';
	}
?>
<?php
	if ($options['general_color_global_light_fg'] != '' || $options['general_color_global_light_bg'] != '') {
		echo '
			#commentform input[type="text"],
			.searchform input[type="text"],
			.woocommerce.widget_product_search input[type="search"],
			#commentform select,
			#commentform textarea,
			.widget_archive select,
			.widget_categories select,
			.textwidget select,
			.textwidget input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-text input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-captcha input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-email input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-password input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap select,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap textarea {
				' . react_css_color($options['general_color_global_light_bg']) . '
				' . react_css_color($options['general_color_global_light_bg_much_darker'], 'border-color') . '
				' . react_css_color($options['general_color_global_light_fg'], 'color') . '
			}
			.iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-text input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-captcha input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-email input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-password input,
			.iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap select,
			.iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap textarea {
				' . react_css_color($options['general_color_global_light_bg_even_lighter']) . '
				' . react_css_color($options['general_color_global_light_bg_much_darker'], 'border-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_light_fg'] != '' || $options['general_color_global_light_bg'] != '') {
		echo '
			#commentform input[type="text"]:focus,
			.searchform input[type="text"]:focus,
			.woocommerce.widget_product_search input[type="search"]:focus,
			#commentform select:focus,
			#commentform textarea:focus,
			.widget_archive select:focus,
			.widget_categories select:focus,
			.textwidget select:focus,
			.textwidget input:focus,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-text input:focus,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-captcha input:focus,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-email input:focus,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-password input:focus,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap select:focus,
			.iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap textarea:focus {
				' . react_css_color($options['general_color_global_light_bg_darker']) . '
				' . react_css_color($options['general_color_global_primary_bg'], 'border-color') . '
				' . react_css_color($options['general_color_global_light_fg_even_darker'], 'color') . '
			}
			.flexible-frame.map .map-cover,
			.iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-text input:focus,
			.iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-captcha input:focus,
			.iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-email input:focus,
			.iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-password input:focus,
			.iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap select:focus,
			.iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap textarea:focus {
				' . react_css_color($options['general_color_global_light_bg_lighter']) . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_light_bg']) {
		echo '
			.tcs-menu.tcs-menu-button-style-two.tcs-grouped ul li:last-child a,
			.tcs-menu.tcs-menu-button-style-two.tcs-grouped ul.menu li:last-child a,
			.tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-two ul.menu li a {
				' . react_css_color($options['general_color_global_light_bg_even_darker'], 'border-color') . '
			}
			.tcs-impact-header.tcs-light,
			.tcs-button.tcs-style-light > a,
			.tcs-button.tcs-style-light > span.tcs-r-button,
			.iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
			.iphorm-theme-react-default .iphorm-upload-queue-file,
			.iphorm-theme-react-default .iphom-upload-progress-wrap,
			.tcs-menu.tcs-menu-button-style-two ul li a,
			.tcs-menu.tcs-menu-button-style-two.tcs-grouped.tcs-inline ul li a,
			.tcs-menu.tcs-menu-button-style-two.tcs-grouped.tcs-stacked ul li a,
			.tcs-menu.tcs-menu-button-style-two.tcs-grouped ul li.last-child a,
			.tcs-menu.tcs-menu-button-style-two.tcs-grouped.tcs-inline ul.menu li a,
			.tcs-menu.tcs-menu-button-style-two.tcs-grouped.tcs-stacked ul.menu li a,
			.tcs-menu.tcs-menu-button-style-two.tcs-grouped ul.menu li.last-child a,
			.tcs-button.style3 a,
			.iphorm-theme-react-default .iphorm-upload-progress-bar-wrap {
				' . react_css_color($options['general_color_global_light_bg_much_darker'], 'border-color') . '
			}

			.iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements .iphorm-group-title-description-wrap {
				' . react_css_color($options['general_color_global_light_bg_even_lighter']) . '
				' . react_css_color($options['general_color_global_light_bg_much_darker'], 'border-color') . '
			}

		';
	}
?>
<?php
	if ($options['general_color_global_light_bg'] != '' || $options['general_color_global_light_fg'] != '') {
		echo '
			.search-container,
			.search-container .search-input-wrap input {
				' . react_css_color($options['general_color_global_light_fg'], 'color') . '
			}
			.search-container {
				' . react_css_color($options['general_color_global_light_bg']) . '
				' . react_css_color($options['general_color_content_background_much_darker'], 'border-color') . '
			}
			.search-container {
				box-shadow: 0 -3px 0 0 ' . react_sanitize_color($options['general_color_global_light_bg_even_darker']) . ' inset;
			}
		';
	}
?>

<?php
	if ($options['general_color_global_light_fg']) {
		echo '
			.tcs-accordion.tcs-box > h3:hover, .tcs-accordion.tcs-box > h3.tcs-active, .tcs-accordion.tcs-box > h3 a:hover,
			.tcs-impact-header.tcs-light .tcs-impact-heading,
			.tcs-impact-header.tcs-light .tcs-impact-subheading,

			.wpb_content_element.react.light .wpb_tabs_nav li.ui-tabs-active a,
			.iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements, .iphorm-theme-react-default .iphorm-upload-queue-file, .iphom-upload-progress-wrap, .js .iphorm-theme-react-default .element-wrapper.inside-label > label,
			.iphorm-theme-react-default .iphorm-group-style-bordered .iphorm-element-wrap > .iphorm-element-spacer > label,
			.iphorm-theme-react-default .iphorm-element-wrap-text.iphorm-labels-inside > .iphorm-element-spacer > label,
			.iphorm-theme-react-default .iphorm-element-wrap-textarea.iphorm-labels-inside > .iphorm-element-spacer > label,
			.iphorm-theme-react-default .iphorm-element-wrap-email.iphorm-labels-inside > .iphorm-element-spacer > label,
			.iphorm-theme-react-default .iphorm-element-wrap-password.iphorm-labels-inside > .iphorm-element-spacer > label,
			.iphorm-theme-react-default .iphorm-element-wrap-captcha.iphorm-labels-inside > .iphorm-element-spacer > label,
			.wpb_content_element.react .wpb_tabs_nav li a,
			.tcs-box.tcs-box-basic-light > a,
			.tcs-box.tcs-box-basic-light > a:hover,
			.tcw-tweet-light li a,
			.tcw-tweet-light li a:hover,
			.tcs-menu.tcs-menu-button-style-two ul li,
			.tcs-accordion.tcs-box > h3 a {
				' . react_css_color($options['general_color_global_light_fg'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_light_fg'] != '' || $options['general_color_global_light_bg'] != '') {
		echo '
			.tcs-box.tcs-box-basic-light, .tcw-tweet-light li, .react.vc_call_to_action.light, .react.vc_call_to_action {
				' . react_css_color($options['general_color_global_light_bg']) . '
				' . react_css_color($options['general_color_global_light_fg'], 'color') . '
				' . react_css_color($options['general_color_global_light_bg_darker'], 'border-color') . '

				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.3), inset 0px 0px 60px 0px rgba(0, 0, 0, 0.02), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
				 box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.3), inset 0px 0px 60px 0px rgba(0, 0, 0, 0.02), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
		}
		';
	}
?>
<?php
	if ($options['general_color_global_light_icon']) {
		echo '
			.tcs-button.tcs-has-drop.tcs-style-light .tcs-open-drop-trigger, .tcs-button.tcs-style-light > a > i, .tcs-button.tcs-hollow-light > a:hover > i, .tcs-button.tcs-style-light > span.tcs-r-button > i, .tcs-button.tcs-hollow-light > span.tcs-r-button:hover > i, .tcs-impact-header.tcs-light > i, .tcs-fancy-header.tcs-style3 > i,
			.span.contact-ico {
				' . react_css_color($options['general_color_global_light_icon'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_light_gradient']) {
		echo '
			.tcs-button.tcs-hollow-light > a.tcs-has-back-animation:before,
			.tcs-button.tcs-hollow-light > span.tcs-r-button.tcs-has-back-animation:before,
			.tcs-button.tcs-hollow-light > a.tcs-has-back-animation:hover:before,
			.tcs-button.tcs-hollow-light > span.tcs-r-button.tcs-has-back-animation:hover:before,
			.tcs-box.tcs-box-basic-light,
			.tcw-tweet-light li,
			.react.vc_call_to_action.light,
			.react.vc_call_to_action,
			.im-box-inner ul.wp-tag-cloud li a,
			.tagcloud > a,
			.tcp-portfolio-filter .tcp-filter-button,
			.tcs-menu.tcs-menu-button-style-two ul li a,
			.tcs-button.tcs-style-light > a,
			.tcs-button.tcs-style-light > span.tcs-r-button,
			.tcs-image-hover.tcs-hover-light,
			.tcs-button.tcs-hollow-light > a:hover,
			.tcs-button.tcs-hollow-light > span.tcs-r-button:hover,
			span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-light:hover,
			span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-light:before,
			span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-light:hover:before,
			.tcs-tabs ul.tcs-tabs-nav li a,
			ul#comment-tabs-nav li a,
			.tcs-accordion.tcs-box > h3,
			code, pre, kbd, tt,
			.iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
			.iphorm-theme-react-default .iphorm-upload-queue-file,
			.iphorm-theme-react-default .iphom-upload-progress-wrap,
			.tcs-impact-header.tcs-light,
			blockquote,
			.tcs-blockquote .tcs-blockquote-inner,
			.tcs-tabs ul.tcs-tabs-nav li a:hover,
			ul#comment-tabs-nav li a:hover,
			.tcs-accordion.tcs-box > h3:hover,
			.tcp-portfolio-filter .tcp-filter-button:hover,
			span.tcs-icon.tcs-boxed.tcs-style-light,
			.wpb_content_element.react .wpb_accordion_wrapper .wpb_accordion_header,
			.vc_progress_bar.react .vc_single_bar {
				background: -moz-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_light_bg_lighter']) . ' 0%, ' . react_sanitize_color($options['general_color_global_light_bg_darker']) . ' 100%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($options['general_color_global_light_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($options['general_color_global_light_bg_darker']) . '));
				background: -webkit-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_light_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_light_bg_darker']) . ' 100%);
				background: -o-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_light_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_light_bg_darker']) . ' 100%);
				background: -ms-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_light_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_light_bg_darker']) . ' 100%);
				background: linear-gradient(to bottom, ' . react_sanitize_color($options['general_color_global_light_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_light_bg_darker']) . ' 100%);
			}
			.tcs-blockquote .tcs-blockquote-inner:after {
				' . react_css_color($options['general_color_global_light_bg_darker'], 'border-top-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_light_bg']) {
		echo '
			.tcs-menu.tcs-menu-button-style-two ul li a:hover,
			.tcs-button.tcs-style-light > a:hover,
			.tcs-button.tcs-style-light > span.tcs-r-button:hover {
				' . react_css_color($options['general_color_global_light_bg_darker'], 'background') . '
				' . react_css_color($options['general_color_global_light_fg'], 'color') . '

			}
		';
	}
?>

<?php /* Global Dark Color */ ?>

<?php
	if ($options['general_color_global_dark_bg']) {
		echo '
			span.tcs-icon.tcs-style-dark {
				' . react_css_color($options['general_color_global_dark_bg_darker'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_dark_bg'] != '' || $options['general_color_global_dark_fg'] != '') {
		echo '
			.flexible-frame.map .map-cover.hide:after,
			.tcs-progress-bar-outer.tcs-dark .tcs-progress-bar,
			.tcs-progress-label,
			.iphorm-theme-react-default .iphorm-datepicker-icon,
			.tcs-impact-header.tcs-dark, .tcs-cycle-controls-wrap a,
			.tcs-image-carousel-wrap .tcs-carousel-prev,
			.tcs-image-carousel-wrap .tcs-carousel-next,
			.x-close,
			#fs-controls,
			#video-controls,
			#audio-controls,
			.entry-info .post-icon,
			.entry-info .date,
			.entry-info .react-vote,
			.tcp-entry-info .tcp-date,
			.tcp-entry-info .react-vote,
			.tcs-accordion.tcs-box > h3 span.tcs-acc-icon,
			.react .wpb_tour_next_prev_nav a,
			#nav-single .nav-previous .meta-nav,
			#nav-single .nav-next .meta-nav, .content-nav .nav-previous .meta-nav, .content-nav .nav-next .meta-nav, .comments div.comment .reply a, .comments ul.children div.comment .reply a,
			.tcs-has-drop .tcs-drop-content, #comments .comment-respond h3#reply-title,
			span.tcs-icon.tcs-boxed.tcs-style-dark,
			.vc_progress_bar.react .vc_single_bar .vc_label,
			.react .vc-carousel-control .icon-prev,
			.react .vc-carousel-control .icon-next,
			.react .flex-direction-nav a.flex-next,
			.react .flex-direction-nav a.flex-prev,
			.react .theme-default .nivo-directionNav a,
			.wpb_content_element.react.dark .wpb_tabs_nav li.ui-tabs-active,
			.react.wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon,
			.vc_separator.react h4,
			.wpb_content_element.wpb_tabs.react.dark .wpb_tour_tabs_wrapper .wpb_tab,
			.tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-read-more a.tcp-basic-button.tcp-dark-button,

			.slider-wrap .ls-reactskin a.ls-nav-prev,
			.slider-wrap .ls-reactskin a.ls-nav-next,
			.slider-wrap .ls-reactskin .ls-nav-start,
			.slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active,
			.slider-wrap .ls-reactskin .ls-nav-stop,
			.slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-active,
			.slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active,
			.slider-wrap .ls-reactskin .ls-nav-stop,
			.slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-active,

			.widget-area .ls-reactskin a.ls-nav-prev,
			.widget-area .ls-reactskin a.ls-nav-next,
			.widget-area .ls-reactskin .ls-nav-start,
			.widget-area .ls-reactskin .ls-nav-start.ls-nav-start-active,
			.widget-area .ls-reactskin .ls-nav-stop,
			.widget-area .ls-reactskin .ls-nav-stop.ls-nav-active,
			.widget-area .ls-reactskin .ls-nav-start.ls-nav-start-active,
			.widget-area .ls-reactskin .ls-nav-stop,
			.widget-area .ls-reactskin .ls-nav-stop.ls-nav-active,

			.ls-reactskin a.ls-nav-prev,
			.ls-reactskin a.ls-nav-next,
			.ls-reactskin .ls-nav-start,
			.ls-reactskin .ls-nav-start.ls-nav-start-active,
			.ls-reactskin .ls-nav-stop,
			.ls-reactskin .ls-nav-stop.ls-nav-active,
			.ls-reactskin .ls-nav-start.ls-nav-start-active,
			.ls-reactskin .ls-nav-stop,
			.ls-reactskin .ls-nav-stop.ls-nav-active {
				' . react_css_color($options['general_color_global_dark_bg']) . '
				' . react_css_color($options['general_color_global_dark_fg'], 'color') . '
			}

			.tcp-portfolio.tcp-boxed .tcp-portfolio-item .tcp-entry-info > div:after, .tcp-portfolio.tcp-boxed .tcp-portfolio-item .tcp-entry-info > span:after {
				border-color: transparent;
				' . react_css_color($options['general_color_global_dark_bg_much_darker'], 'border-top-color') . '
			}
			.tcp-portfolio.tcp-boxed.tcp-date-like-left .tcp-portfolio-item .tcp-entry-info > div:after, .tcp-portfolio.tcp-boxed.tcp-date-like-left .tcp-portfolio-item .tcp-entry-info > span:after,
			.tcp-portfolio.tcp-boxed.tcp-date-like-above .tcp-portfolio-item .tcp-entry-info > div:after, .tcp-portfolio.tcp-boxed.tcp-date-like-above .tcp-portfolio-item .tcp-entry-info > span:after {
				border-color: transparent;
				' . react_css_color($options['general_color_global_dark_bg_much_darker'], 'border-right-color') . '
			}

			.tcs-progress-label:after {
				' . react_css_color($options['general_color_global_dark_bg'], 'border-top-color') . '
			}
			.tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-read-more a.tcp-basic-button.tcp-dark-button:hover {
				' . react_css_color($options['general_color_global_dark_bg_darker']) . '
			}
			.rev_slider_wrapper .tp-rightarrow.custom,
			.rev_slider_wrapper .tp-leftarrow.custom {
				' . react_css_color($options['general_color_global_dark_bg'], 'background-color', '!important') . '
				' . react_css_color($options['general_color_global_dark_fg'], 'color', '!important') . '
			}
			#footer-logo-info-wrap,
			.desc-hover ul.react-menu li a span.desc,
			.desc-hover ul.react-menu li a:hover span.desc,
			.im-trigger span.im-desc,
			.back-to-top, .go-down, #subfooter-toggle,
			#audio-controls span.label,
			#video-controls span.label,
			#fs-controls span.label,
			.react-menu li.menu-icon.box:before {
				' . react_css_color($options['general_color_global_dark_bg_darker']) . '
				' . react_css_color($options['general_color_global_dark_fg'], 'color') . '
			}
			.react-vote .count {
				' . react_css_color($options['general_color_global_dark_fg'], 'color') . '
			}
		';
	}
?>

<?php
	if ($options['general_color_global_dark_bg']) {
		echo '
			.desc-hover ul.react-menu li a span.desc:after,
			.im-trigger span.im-desc:after, #footer-logo-info-wrap:after {
				' . react_css_color($options['general_color_global_dark_bg_darker'], 'border-top-color') . '
			}
			#fs-controls:hover:after, #video-controls:hover:after,
			#audio-controls:hover:after {
				' . react_css_color($options['general_color_global_dark_bg'], 'border-left-color') . '
			}

			.tcs-drop-content:after {
				' . react_css_color($options['general_color_global_dark_bg'], 'border-bottom-color') . '
			}
			.tcs-impact-header-link-wrap a.tcs-impact-link, .tcs-impact-header-link-wrap span.tcs-impact-link {
				' . react_css_color($options['general_color_global_dark_bg_lighter']) . '
				' . react_css_color($options['general_color_global_dark_bg_even_darker'], 'border-color') . '
			}
			.tcs-impact-header-link-wrap a.tcs-impact-link:hover, .tcs-impact-header-link-wrap span.tcs-impact-link:hover {
				' . react_css_color($options['general_color_global_dark_bg_even_lighter']) . '
			}
			.tcs-impact-header.tcs-dark {
				' . react_css_color($options['general_color_global_dark_bg_darker'], 'border-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_dark_fg']) {
		echo '
			.tcs-cycle-controls-wrap a,
			.tcs-image-carousel-wrap .tcs-carousel-prev,
			.tcs-image-carousel-wrap .tcs-carousel-next,
			.x-close,
			.date .day,
			.tcp-date .tcp-day,
			.entry-info .react-vote .count,
			.tcp-entry-info .react-vote .count,
			.react-vote .like,
			.tcs-drop-close {
				' . react_css_color($options['general_color_global_dark_fg'], 'color') . '
			}
			.tcs-impact-header.tcs-dark .tcs-impact-heading,
			.tcs-impact-header.tcs-dark .tcs-impact-subheading,
			.wpb_content_element.react.dark .wpb_tabs_nav li.ui-tabs-active a,
			.tcs-impact-header-link-wrap a.tcs-impact-link,
			.tcs-impact-header-link-wrap span.tcs-impact-link,
			.entry-info .react-vote .like:hover,
			.tcp-entry-info .react-vote .like:hover,
			.date .month,
			.tcp-date .tcp-month,
			#open-close-close  {
				' . react_css_color($options['general_color_global_dark_fg'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_dark_bg']) {
		echo '
			#open-close-close, .tcs-drop-close {
				' . react_css_color($options['general_color_global_dark_bg_lighter']) . '
			}
			.tcp-portfolio.tcp-date-like-above .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-entry-info > div,
			.tcp-portfolio.tcp-date-like-above .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-entry-info > span,
			.tcp-portfolio.tcp-boxed .tcp-portfolio-item .tcp-entry-info > span,
			.tcp-portfolio.tcp-boxed .tcp-portfolio-item .tcp-entry-info > div,
			.tcp-portfolio.tcp-date-like-above .tcp-entry-info .tcp-date {
				' . react_css_color($options['general_color_global_dark_bg_even_lighter'], 'border-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_dark_bg'] != '' || $options['general_color_global_dark_fg'] != '') {
		echo '
			.tcs-box.tcs-box-basic-dark, .tcw-tweet-dark li, .react.vc_call_to_action.dark {
				' . react_css_color($options['general_color_global_dark_bg']) . '
				' . react_css_color($options['general_color_global_dark_fg'], 'color') . '
				' . react_css_color($options['general_color_global_dark_bg_much_darker'], 'border-color') . '
				text-shadow: -1px -1px 0 ' . react_sanitize_color($options['general_color_global_dark_bg_even_darker']) . ';
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1), inset 0px 0px 60px 0px ' . react_sanitize_color($options['general_color_global_dark_bg_much_darker']). ', 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1), inset 0px 0px 60px 0px ' . react_sanitize_color($options['general_color_global_dark_bg_much_darker']) . ', 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
			}

			.tcs-button.tcs-style-dark > a, .tcs-button.tcs-style-dark > span.tcs-r-button {
				' . react_css_color($options['general_color_global_dark_bg']) . '
				' . react_css_color($options['general_color_global_dark_fg'], 'color') . '
					-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($options['general_color_global_dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
				box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($options['general_color_global_dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
			}
			.tcs-button.tcs-style-dark > a:hover, .tcs-button.tcs-style-dark > span.tcs-r-button:hover {
				' . react_css_color($options['general_color_global_dark_bg_lighter']) . '
				-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($options['general_color_global_dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
				box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($options['general_color_global_dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
			}
			.tcs-button.tcs-hollow-dark > a, .tcs-button.tcs-hollow-dark > span.tcs-r-button, span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark {background-color: transparent; ' . react_css_color($options['general_color_global_dark_bg'], 'border-color') . '}
			.tcs-button.tcs-hollow-dark > a.tcs-has-back-animation:before,
			.tcs-button.tcs-hollow-dark > span.tcs-r-button.tcs-has-back-animation:before,
			.tcs-button.tcs-hollow-dark > a.tcs-has-back-animation:hover:before,
			.tcs-button.tcs-hollow-dark > span.tcs-r-button.tcs-has-back-animation:hover:before,
			.tcs-button.tcs-hollow-dark > a:hover,
			.tcs-button.tcs-hollow-dark > span.tcs-r-button:hover,
			span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark:hover,
			span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-dark:before,
			span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-dark:hover:before,
			.tcs-image-hover.tcs-hover-dark,
			.tcs-button.tcs-has-drop.tcs-holw-btn .tcs-open-drop-trigger i {
				' . react_css_color($options['general_color_global_dark_bg']) . '
				' . react_css_color($options['general_color_global_dark_fg'], 'color') . '
			}

		';
	}
?>

<?php
	if ($options['general_color_global_dark_bg'] != '' || $options['general_color_global_dark_fg'] != '') {
		echo '
			.qtip.qtip-default.qtip-react {
				' . react_css_color($options['general_color_global_dark_bg_darker']) . '
				' . react_css_color($options['general_color_global_dark_fg'], 'color') . '
				' . react_css_color($options['general_color_global_dark_bg_even_darker'], 'border-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_dark_icon']) {
		echo '
			.tcs-accordion.tcs-box > h3 span.tcs-acc-icon i,
			.back-to-top a.scroll-top i, .go-down a.scroll-down i, #subfooter-toggle:before,
			.tcs-cycle-controls-wrap a > i,
			#open-close-close,
			#nav-single .nav-previous .meta-nav i,
			#nav-single .nav-next .meta-nav i,
			.content-nav .nav-previous .meta-nav i,
			.content-nav .nav-next .meta-nav i,

			.tcs-button.tcs-has-drop.tcs-style-dark .tcs-open-drop-trigger, .tcs-button.tcs-style-dark > a > i, .tcs-button.tcs-style-dark > span.tcs-r-button > i, .tcs-button.tcs-hollow-dark > a:hover > i, .tcs-button.tcs-hollow-dark > span.tcs-r-button:hover > i, .tcs-impact-header.tcs-dark > i, span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark:hover > i {
				' . react_css_color($options['general_color_global_dark_icon'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_dark_gradient']) {
		echo '
			.tcs-button.tcs-hollow-dark > a.tcs-has-back-animation:before,
			.tcs-button.tcs-hollow-dark > span.tcs-r-button.tcs-has-back-animation:before,
			.tcs-button.tcs-hollow-dark > a.tcs-has-back-animation:hover:before,
			.tcs-button.tcs-hollow-dark > span.tcs-r-button.tcs-has-back-animation:hover:before,
			.tcs-impact-header.tcs-dark,
			.tcs-cycle-controls-wrap a,
			#fs-controls,
			#video-controls,
			#audio-controls,
			.entry-info .post-icon,
			.entry-info .date,
			.entry-info .react-vote,
			.tcp-entry-info .tcp-date,
			.tcp-entry-info .react-vote,
			.tcs-accordion.tcs-box > h3 span.tcs-acc-icon,
			.react .wpb_tour_next_prev_nav a,
			#nav-single .nav-previous .meta-nav,
			#nav-single .nav-next .meta-nav,
			.content-nav .nav-previous .meta-nav,
			.content-nav .nav-next .meta-nav,
			.comments div.comment .reply a,
			.comments ul.children div.comment .reply a,
			.tcs-has-drop .tcs-drop-content,
			.vc_progress_bar.react .vc_single_bar .vc_label,
			.vc_separator.react h4,

			#footer-logo-info-wrap,
			.desc-hover ul.react-menu li a span.desc,
			.desc-hover ul.react-menu li a:hover span.desc,
			.im-trigger span.im-desc,
			.back-to-top, .go-down, #subfooter-toggle,

			.tcs-box.tcs-box-basic-dark,
			.tcw-tweet-dark li,
			.react.vc_call_to_action.dark,
			.tcs-button.tcs-style-dark > a,
			.tcs-button.tcs-style-dark > span.tcs-r-button,
			.tcs-button.tcs-hollow-dark > a:hover,
			.tcs-button.tcs-hollow-dark > span.tcs-r-button:hover,
			span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark:hover,
			span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-dark:before,
			span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-dark:hover:before,
			.tcs-image-hover.tcs-hover-dark {
				background: -moz-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_dark_bg']) . ' 0%, ' . react_sanitize_color($options['general_color_global_dark_bg_even_darker']) . ' 100%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($options['general_color_global_dark_bg']) . '), color-stop(100%,' . react_sanitize_color($options['general_color_global_dark_bg_even_darker']) . '));
				background: -webkit-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_dark_bg']) . ' 0%,' . react_sanitize_color($options['general_color_global_dark_bg_even_darker']) . ' 100%);
				background: -o-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_dark_bg']) . ' 0%,' . react_sanitize_color($options['general_color_global_dark_bg_even_darker']) . ' 100%);
				background: -ms-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_dark_bg']) . ' 0%,' . react_sanitize_color($options['general_color_global_dark_bg_even_darker']) . ' 100%);
				background: linear-gradient(to bottom, ' . react_sanitize_color($options['general_color_global_dark_bg']) . ' 0%,' . react_sanitize_color($options['general_color_global_dark_bg_even_darker']) . ' 100%);
			}
		';
	}
?>

<?php /* Global Prime Color */ ?>

<?php
	if ($options['general_color_global_primary_fg'] != '' || $options['general_color_global_primary_bg'] != '') {
		echo '
			.tcs-button.tcs-hollow-prime > a,
			.tcs-button.tcs-hollow-prime > span.tcs-r-button,
			span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-prime {
				' . react_css_color($options['general_color_global_primary_bg'], 'border-color') . '
				background-color: transparent;
			}
			.iphorm-theme-react-default .iphorm-loading-wrap .iphorm-loading,
			.iphorm-theme-react-default .iphorm-loading-wrap .iphorm-loading:before,
			.iphorm-theme-react-default .iphorm-loading-wrap .iphorm-loading:after {
				' . react_css_color($options['general_color_global_primary_bg'], 'border-top-color') . '
			}
			.tcs-image-hover.tcs-hover-prime,
			.tcs-menu.tcs-menu-button-style-one ul li a,
			.tcs-button.tcs-hollow-prime > a:hover,
			.tcs-image-hover.tcs-hover-prime,
			.tcs-button.tcs-hollow-prime > span.tcs-r-button:hover,
			span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-prime:hover,
			span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-prime:before,
			span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-prime:hover:before {
				' . react_css_color($options['general_color_global_primary_bg']) . '
				' . react_css_color($options['general_color_global_primary_fg'], 'color') . '
			}
			.read-more-link a.more-link,
			.comments-link a,
			.searchform input.searchsubmit,
			.woocommerce.widget_product_search input[type="submit"],
			.iphorm-theme-react-default .iphorm-submit-wrap button span,
			.iphorm-theme-react-default .iphorm-swfupload-browse,
			.iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button,
			.form-submit input,
			.back-home-icon.button a.back-home,
			.tcs-impact-header.tcs-light .tcs-impact-header-link-wrap a.tcs-impact-link,
			.tcs-impact-header.tcs-light .tcs-impact-header-link-wrap span.tcs-impact-link,
			.tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap a.tcs-impact-link,
			.tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap span.tcs-impact-link,
			#popdown-trigger,
			body.pop-trig-abso #popdown-trigger,
			.dismissed #popdown-trigger,
			.tcs-button.tcs-style-prime > a,
			.tcs-button.tcs-style-prime > span.tcs-r-button,
			a.basic-button, a.tcp-basic-button, .tcw-follow-me-button a,
			.tcs-button.tcs-style-dark.tcs-hover-prime-btn > a:hover,
			.tcs-button.tcs-style-dark.tcs-hover-prime-btn > span.tcs-r-button:hover,
			.tcs-button.tcs-style-light.tcs-hover-prime-btn > a:hover,
			.tcs-button.tcs-style-light.tcs-hover-prime-btn > span.tcs-r-button:hover {
				' . react_css_color($options['general_color_global_primary_bg']) . '
				' . react_css_color($options['general_color_global_primary_fg'], 'color') . '
		';
		if ($options['general_color_global_primary_bg']) {
			echo '
				-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($options['general_color_global_primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
				box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($options['general_color_global_primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
			 ';
		}
		echo '}';
	}

?>
<?php
	if ($options['general_color_global_primary_gradient']) {
		echo '
			.read-more-link a.more-link,
			.comments-link a,
			.iphorm-theme-react-default .iphorm-submit-wrap button span,
			.iphorm-theme-react-default .iphorm-swfupload-browse,
			.iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button,
			.tcs-menu.tcs-menu-button-style-one ul li a,
			.form-submit input,
			.back-home-icon.button a.back-home,
			.tcs-impact-header.tcs-light .tcs-impact-header-link-wrap a.tcs-impact-link,
			.tcs-impact-header.tcs-light .tcs-impact-header-link-wrap span.tcs-impact-link,
			.tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap a.tcs-impact-link,
			.tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap span.tcs-impact-link,
			#popdown-trigger,
			body.pop-trig-abso #popdown-trigger,
			.dismissed #popdown-trigger,
			.tcs-button.tcs-style-prime > a,
			.tcs-button.tcs-style-prime > span.tcs-r-button,
			.tcs-button.tcs-style-dark.tcs-hover-prime-btn > a:hover,
			.tcs-button.tcs-style-dark.tcs-hover-prime-btn > span.tcs-r-button:hover,
			.tcs-button.tcs-style-light.tcs-hover-prime-btn > a:hover,
			.tcs-button.tcs-style-light.tcs-hover-prime-btn > span.tcs-r-button:hover,
			.tcs-image-hover.tcs-hover-prime,
			.tcs-button.tcs-hollow-prime > a:hover,
			.tcs-image-hover.tcs-hover-prime,
			.tcs-button.tcs-hollow-prime > span.tcs-r-button:hover,
			span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-prime:hover,
			span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-prime:before,
			span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-prime:hover:before,
			a.basic-button, a.tcp-basic-button, .tcw-follow-me-button a {
				background: -moz-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%, ' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . '));
				background: -webkit-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
				background: -o-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
				background: -ms-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
				background: linear-gradient(to bottom, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
			}

		';
	}
?>
<?php
	if ($options['general_color_global_primary_bg']) {
		echo '
		.tcs-impact-header.tcs-light {
		-webkit-box-shadow: inset 0 -2px 0 0 ' . react_sanitize_color($options['general_color_global_primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1), inset 0px -3px 0px 0px rgba(255, 255, 255, 0.2);
		box-shadow: inset 0 -2px 0 0 ' . react_sanitize_color($options['general_color_global_primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1), inset 0px -3px 0px 0px rgba(255, 255, 255, 0.2);
	}
		';
	}
?>
.tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul li a,
.tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul.menu li a,
.tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul.menu li.menu-item-has-children > a {
	-webkit-box-shadow: inset 0px -1px 0px 0px rgba(255, 255, 255, 0.05);
	 box-shadow: inset 0px -1px 0px 0px rgba(255, 255, 255, 0.05);
}
<?php
	if ($options['general_color_global_primary_bg'] != '' || $options['general_color_global_primary_fg'] != '') {
		echo '
			::-moz-selection {
				background-color: ' . react_sanitize_color($options['general_color_global_primary_bg']) . ';
				color: ' . react_sanitize_color($options['general_color_global_primary_fg']) . ';
			}
			 ::selection {
				background-color: ' . react_sanitize_color($options['general_color_global_primary_bg']) . ';
				color: ' . react_sanitize_color($options['general_color_global_primary_fg']) . ';
			}
			.tcs-progress-bar-outer.tcs-prime .tcs-progress-bar, .highlighted-text, .tcs-highlighted-text, mark, body.react-wp .mejs-time-rail .mejs-time-current {
				background-color: ' . react_sanitize_color($options['general_color_global_primary_bg']) . ';
				color: ' . react_sanitize_color($options['general_color_global_primary_fg']) . ';
			}
			.featured-image-link:before, .featured-image-link:after,
			.tcp-featured-image-link:before, .tcp-featured-image-link:after {
				' . react_css_color($options['general_color_global_primary_bg']) . '
				' . react_css_color($options['general_color_global_primary_fg'], 'color') . '
			}
			#content > .entry .entry-info > div.post-icon {
				' . react_css_color($options['general_color_global_primary_bg']) . '
				' . react_css_color($options['general_color_global_primary_fg'], 'color') . '
			}
			#content > .entry .entry-info > div.post-icon:first-child:after {
				' . react_css_color($options['general_color_global_primary_bg'], 'border-top-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_primary_bg'] != '' || $options['general_color_global_primary_fg'] != '') {
		echo '.read-more-link a.more-link:hover, .comments-link a:hover, .searchform input.searchsubmit:hover, .woocommerce.widget_product_search input[type="submit"]:hover, .tcw-follow-me-button a:hover, .iphorm-theme-react-default .iphorm-submit-wrap button:hover span, .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button:hover, .form-submit input:hover, .back-home-icon.button a.back-home:hover, .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap a.tcs-impact-link:hover, .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap span.tcs-impact-link:hover,
		.tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap a.tcs-impact-link:hover, .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap span.tcs-impact-link:hover, #popdown-trigger:hover, body.pop-trig-abso #popdown-trigger:hover, .dismissed #popdown-trigger:hover, .tcs-button.tcs-style-prime > a:hover, .tcs-button.tcs-style-prime > span.tcs-r-button:hover, a.basic-button:hover, a.tcp-basic-button:hover {
			-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($options['general_color_global_primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
			 box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($options['general_color_global_primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
			 ' . react_css_color($options['general_color_global_primary_bg_lighter']) . '
			 ' . react_css_color($options['general_color_global_primary_fg'], 'color') . '
		}
		.tcs-menu.tcs-menu-button-style-one ul li a:hover {
			' . react_css_color($options['general_color_global_primary_bg_lighter']) . '
			' . react_css_color($options['general_color_global_primary_fg'], 'color') . '
		}
		';
	}
?>
<?php
	if ($options['general_color_global_primary_bg']) {
		echo '
			.tcs-menu.tcs-menu-button-style-one.tcs-grouped ul li a, .tcs-menu.tcs-menu-button-style-one.tcs-grouped ul.menu li a {' . react_css_color($options['general_color_global_primary_bg_even_darker'], 'border-color') . '}
			#audio-controls, #video-controls, #fs-controls {' . react_css_color($options['general_color_global_primary_bg'], 'border-right-color') . '}
			span.tcs-icon.tcs-style-prime, .text-prime {' . react_css_color($options['general_color_global_primary_bg'], 'color') . '}
		';
	}

?>
<?php /* Global Prime flat Color */ ?>
<?php
	if ($options['general_color_global_primary_bg'] != '' || $options['general_color_global_primary_fg'] != '') {
		echo '
			.search-button-wrap input,
			.widget_search input.searchsubmit,
			.comments div.comment .reply a:hover,
			.comments ul.children div.comment .reply a:hover,
			.searchform input.searchsubmit,
			.woocommerce.widget_product_search input[type="submit"],
			.tcs-image-carousel-wrap .tcs-carousel-next:hover,
			.tcs-image-carousel-wrap .tcs-carousel-prev:hover,
			.form-submit input,
			 #comments ul#comment-tabs-nav li a.current,
			ul.wp-tag-cloud li a:hover,
			.tagcloud > a:hover,
			.react-woo-image-hover,
			.tcp-portfolio-hover,
			.tcs-accordion.tcs-box > h3.tcs-active span.tcs-acc-icon,
			.tcs-accordion.tcs-box > h3:hover span.tcs-acc-icon,
			.tcs-tabs ul.tcs-tabs-nav li.tcs-active a,
			.tcs-tabs ul.tcs-tabs-nav li.tcs-active a:hover,
			.tcs-cycle-controls-wrap a:hover,

			.fullscreen-pause:hover, .serene-pause:hover,
			.fullscreen-play:hover, .serene-play:hover,
			.fullscreen-next:hover, .serene-next:hover,
			.fullscreen-prev:hover, .serene-prev:hover,
			.video-fs-play:hover,
			.video-fs-pause:hover,
			.video-fs-next:hover,
			.video-fs-prev:hover,
			.video-fs-unmute:hover,
			.video-fs-mute:hover,

			.slider-wrap .ls-reactskin a.ls-nav-prev:hover,
			.slider-wrap .ls-reactskin a.ls-nav-next:hover,
			.slider-wrap .ls-reactskin .ls-nav-start:hover,
			.slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:hover,
			.slider-wrap .ls-reactskin .ls-nav-stop:hover,
			.slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-active:hover,
			.slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:hover,
			.slider-wrap .ls-reactskin .ls-nav-stop:hover,
			.slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-active:hover,

			.widget-area .ls-reactskin a.ls-nav-prev:hover,
			.widget-area .ls-reactskin a.ls-nav-next:hover,
			.widget-area .ls-reactskin .ls-nav-start:hover,
			.widget-area .ls-reactskin .ls-nav-start.ls-nav-start-active:hover,
			.widget-area .ls-reactskin .ls-nav-stop:hover,
			.widget-area .ls-reactskin .ls-nav-stop.ls-nav-active:hover,
			.widget-area .ls-reactskin .ls-nav-start.ls-nav-start-active:hover,
			.widget-area .ls-reactskin .ls-nav-stop:hover,
			.widget-area .ls-reactskin .ls-nav-stop.ls-nav-active:hover,

			.ls-reactskin a.ls-nav-prev:hover,
			.ls-reactskin a.ls-nav-next:hover,
			.ls-reactskin .ls-nav-start:hover,
			.ls-reactskin .ls-nav-start.ls-nav-start-active:hover,
			.ls-reactskin .ls-nav-stop:hover,
			.ls-reactskin .ls-nav-stop.ls-nav-active:hover,
			.ls-reactskin .ls-nav-start.ls-nav-start-active:hover,
			.ls-reactskin .ls-nav-stop:hover,
			.ls-reactskin .ls-nav-stop.ls-nav-active:hover,

			.tcs-button.tcs-hollow-prime > a.tcs-has-back-animation:before,
			.tcs-button.tcs-hollow-prime > span.tcs-r-button.tcs-has-back-animation:before,
			.tcs-button.tcs-hollow-prime > a.tcs-has-back-animation:hover:before,
			.tcs-button.tcs-hollow-prime > span.tcs-r-button.tcs-has-back-animation:hover:before,

			a:hover .x-close,
			.x-close:hover,
			a.fancybox-nav.fancybox-prev:hover > span,
			a.fancybox-nav.fancybox-next:hover > span,
			.back-to-top:hover,
			.go-down:hover,
			#subfooter-toggle:hover,
			.roc-bottom .back-to-top,
			#nav-single .nav-previous:hover .meta-nav,
			#nav-single .nav-next:hover .meta-nav,
			.content-nav .nav-previous:hover .meta-nav,
			.content-nav .nav-next:hover .meta-nav,
			.im-box-inner ul.wp-tag-cloud li a:hover,
			.tcs-drop-close:hover,
			span.tcs-icon.tcs-boxed.tcs-style-prime,
			.vc_progress_bar.react .vc_single_bar .vc_bar,
			.react .vc-carousel-control .icon-prev:hover,
			.react .vc-carousel-control .icon-next:hover,
			.react .flex-control-paging li a.flex-active,
			.react .flex-direction-nav a.flex-next:hover,
			.react .flex-direction-nav a.flex-prev:hover,
			.react .theme-default .nivo-directionNav a:hover,
			.react .wpb_tour_next_prev_nav a:hover,
			.wpb_content_element.react .wpb_tabs_nav li.ui-tabs-active,
			.react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,
			.fullscreen-close-wrap:hover, .serene-close-wrap:hover, .video-fs-close-wrap:hover, .tcs-drop-close:hover, #comments .comment-respond h3#reply-title:hover,
			.wp-pagenavi span.current, .tcp-portfolio .wp-pagenavi span.current, .comments-pagination-wrap span.page-numbers.current,
			.react.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab,
			.react.prime.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab,
			.react-menu li.menu-icon.box:hover:before {
				' . react_css_color($options['general_color_global_primary_bg']) . '
				' . react_css_color($options['general_color_global_primary_fg'], 'color') . '
			}
			.rev_slider_wrapper .tp-rightarrow.custom:hover,
			.rev_slider_wrapper .tp-leftarrow.custom:hover {
				' . react_css_color($options['general_color_global_primary_bg'], 'background-color', '!important') . '
				' . react_css_color($options['general_color_global_primary_fg'], 'color', '!important') . '
			}
			.tcp-portfolio-filter .tcp-active-filter.tcp-filter-button,
			.tcp-portfolio-filter .tcp-active-filter.tcp-filter-button:hover {
				' . react_css_color($options['general_color_global_primary_bg'], 'background') . '
				' . react_css_color($options['general_color_global_primary_fg'], 'color') . '
			}
		';
	}

?>
<?php
	if ($options['general_color_global_primary_gradient']) {
		echo '
			.tcs-button.tcs-hollow-prime > a.tcs-has-back-animation:before,
			.tcs-button.tcs-hollow-prime > span.tcs-r-button.tcs-has-back-animation:before,
			.tcs-button.tcs-hollow-prime > a.tcs-has-back-animation:hover:before,
			.tcs-button.tcs-hollow-prime > span.tcs-r-button.tcs-has-back-animation:hover:before,
			.comments div.comment .reply a:hover,
			.comments ul.children div.comment .reply a:hover,
			.form-submit input,
			 #comments ul#comment-tabs-nav li a.current,
			ul.wp-tag-cloud li a:hover,
			.tagcloud > a:hover,
			.react-woo-image-hover,
			.tcp-portfolio-hover,
			.tcp-portfolio-filter .tcp-active-filter.tcp-filter-button,
			.tcp-portfolio-filter .tcp-active-filter.tcp-filter-button:hover,
			.tcs-accordion.tcs-box > h3.tcs-active span.tcs-acc-icon,
			.tcs-accordion.tcs-box > h3:hover span.tcs-acc-icon,
			.react .wpb_tour_next_prev_nav a:hover,
			.tcs-tabs ul.tcs-tabs-nav li.tcs-active a,
			.tcs-tabs ul.tcs-tabs-nav li.tcs-active a:hover,
			.back-to-top:hover,
			.roc-bottom .back-to-top,
			.go-down:hover,
			#subfooter-toggle:hover,
			#nav-single .nav-previous:hover .meta-nav,
			#nav-single .nav-next:hover .meta-nav,
			.content-nav .nav-previous:hover .meta-nav,
			.content-nav .nav-next:hover .meta-nav,
			.im-box-inner ul.wp-tag-cloud li a:hover {
				background: -moz-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%, ' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . '));
				background: -webkit-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
				background: -o-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
				background: -ms-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
				background: linear-gradient(to bottom, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
			}
			 #comments ul#comment-tabs-nav li a.current:after,
			.tcp-portfolio-filter .tcp-active-filter.tcp-filter-button:after,
			.tcs-tabs ul.tcs-tabs-nav li.tcs-active a:after {
				' . react_css_color($options['general_color_global_primary_bg_darker'], 'border-top-color', '!important') . '
			}

		';
	}
?>
<?php
	if ($options['general_color_global_primary_bg']) {
		echo '
			a.fancybox-close:hover {
				' . react_css_color($options['general_color_global_primary_bg'], 'background-color', '!important') . '
			}
			#open-close-close:hover,
			.tcs-fancy-header.tcs-prime-line .tcs-fancy-header-text:before, div.post.entry .featured-image-wrap a:after,
			.comments li.comment.bypostauthor div.comment:after,
			.comments ul.children li.comment.bypostauthor div.comment:after,
			body .after-header-wrap #content > div.entry.sticky:before,
			.owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span {
				' . react_css_color($options['general_color_global_primary_bg']) . '
				' . react_css_color($options['general_color_global_primary_fg'], 'color') . '
			}
			.search-button-wrap input:hover,
			.widget_search input.searchsubmit:hover {
				' . react_css_color($options['general_color_global_primary_bg_lighter']) . '
			}
			.search-button-wrap input:active,
			.widget_search input.searchsubmit:active,
			.search-button-wrap input:hover, .widget_search input.searchsubmit:hover,
			.search-button-wrap input:active, .widget_search input.searchsubmit:active {
				' . react_css_color($options['general_color_global_primary_bg_lighter']) . '
			}
			body.pop-trig-abso #popdown-trigger:hover:after {
				' . react_css_color($options['general_color_global_primary_bg_lighter'], 'border-bottom-color') . '
			}

			#comments ul#comment-tabs-nav li a.current:after,
			.tcp-portfolio-filter .tcp-active-filter.tcp-filter-button:after,
			.tcs-tabs ul.tcs-tabs-nav li.tcs-active a:after {
				' . react_css_color($options['general_color_global_primary_bg'], 'border-top-color') . '
			}
			.comments ul.children li.comment.bypostauthor div.comment,
			.comments li.comment.bypostauthor div.comment,
			body.pop-trig-abso #popdown-trigger:after, .tcs-section-break.tcs-line-prime, .tcs-section-break.tcs-line-lrg-prime, a.subtle-link, a.tcp-subtle-link, span.subtle-link, .tcs-accordion.tcs-plain > h3 > a, .tcs-box.tcs-box-basic-light > a:hover, .tcs-box.tcs-box-basic-dark a:hover, .tcw-tweet-light li a:hover, .tcw-tweet-dark li a:hover {
				' . react_css_color($options['general_color_global_primary_bg'], 'border-bottom-color') . '
			}
			.tcs-accordion.tcs-plain > h3 > a:after,
			a.subtle-link:after, a.tcp-subtle-link:after, span.subtle-link:after,
			.tcs-section-break.tcs-line-lrg-prime:before,
			.tcs-section-break.tcs-line-lrg-prime:after
			{' . react_css_color($options['general_color_global_primary_bg_much_darker']) . '}
			.tcs-section-break.tcs-line-prime:before,
			.tcs-section-break.tcs-line-prime:after {
				' . react_css_color($options['general_color_content_background']) . '
				 ' . react_css_color($options['general_color_global_primary_bg'], 'border-color') . '
			}
			.featured-image-wrap:hover,
			.tcp-featured-image-wrap:hover {
				' . react_css_color($options['general_color_global_primary_bg'], 'border-bottom-color') . '
			}
			.tcs-section-break.tcs-line-lrg-prime.tcs-double, code, pre, kbd, tt {' . react_css_color($options['general_color_global_primary_bg'], 'border-color') . '}
		';
	}

?>
<?php
	if ($options['general_color_global_primary_fg']) {
		echo '
			#popdown-trigger a.popdown-close, .tcs-impact-header.tcs-color .tcs-impact-heading, .tcs-impact-header.tcs-color .tcs-impact-subheading, .wpb_content_element.react .wpb_tabs_nav li.ui-tabs-active a,
			.tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details,
			.tcp-portfolio.tcp-boxed .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details,
			.tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-portfolio-item-title,
			.tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-portfolio-item-title a,
			.tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-portfolio-item-title a:hover,
			.tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-entry-meta,
			.tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-entry-meta a,
			.tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-entry-meta a:hover
			 {' . react_css_color($options['general_color_global_primary_fg'], 'color') . '}
		';
	}

?>
<?php
	if ($options['general_color_global_primary_fg'] != '' || $options['general_color_global_primary_bg'] != '') {
		echo '
			.tcs-impact-header.tcs-color,
			.tcs-fancy-header.tcs-style2,
			.tcs-box.tcs-box-basic,
			.react.vc_call_to_action.prime {
				' . react_css_color($options['general_color_global_primary_bg']) . '
				' . react_css_color($options['general_color_global_primary_fg'], 'color') . '

		';
		if ($options['general_color_global_primary_bg']) {
			echo '-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($options['general_color_global_primary_bg_much_darker']) . ', 0 3px 0 0 rgba(0, 0, 0, 0.1), inset 0px 0px 60px 0px rgba(0, 0, 0, 0.07);
			box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($options['general_color_global_primary_bg_much_darker']) . ', 0 3px 0 0 rgba(0, 0, 0, 0.1), inset 0px 0px 60px 0px rgba(0, 0, 0, 0.07);';
		}
		echo '}';
	}
?>
<?php
	if ($options['general_color_global_primary_gradient']) {
		echo '.tcs-impact-header.tcs-color,
		.tcs-fancy-header.tcs-style2,
		.tcs-box.tcs-box-basic,
		.react.vc_call_to_action.prime,
		.react-menu li.menu-icon.box:hover:before {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%, ' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($options['general_color_global_primary_bg_much_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($options['general_color_global_primary_bg_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_global_primary_bg_darker']) . ' 100%);
		}';
	}
?>
<?php
	if ($options['general_color_global_primary_bg']) {
		echo '
			.contact-details-top-head i, #wp-calendar thead th {
				' . react_css_color($options['general_color_global_primary_bg'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_global_primary_fg']) {
		echo '
			.tcs-impact-header .tcs-impact-heading, .tcs-impact-header .tcs-impact-subheading, #popdown-trigger h3, .tcs-menu.tcs-menu-button-style-one ul li {
				' . react_css_color($options['general_color_global_primary_fg'], 'color') . '
			}
		';
	}
?>

<?php
	if ($options['general_color_global_primary_icon']) {
		echo '
			.tcs-accordion.tcs-box > h3.tcs-active span.tcs-acc-icon i, .tcs-accordion.tcs-box > h3:hover span.tcs-acc-icon i, .back-to-top a.scroll-top:hover i, .roc-bottom .back-to-top a.scroll-top i, .go-down a.scroll-down:hover i, #subfooter-toggle:hover:before, #popdown-trigger i, .tcs-cycle-controls-wrap a:hover > i, #open-close-close:hover,
		#nav-single .nav-previous:hover .meta-nav i, #nav-single .nav-next:hover .meta-nav i, .content-nav .nav-previous:hover .meta-nav i, .content-nav .nav-next:hover .meta-nav i,

			.tcs-button.tcs-has-drop.tcs-style-prime .tcs-open-drop-trigger,
			.tcs-button.tcs-style-prime > a > i,
			.tcs-button.tcs-style-prime > span.tcs-r-button > i,
			.tcs-button.tcs-style-dark.tcs-hover-prime-btn > a:hover > i,
			.tcs-button.tcs-style-dark.tcs-hover-prime-btn > span.tcs-r-button:hover > i,
			.tcs-button.tcs-style-light.tcs-hover-prime-btn > a:hover > i,
			.tcs-button.tcs-style-light.tcs-hover-prime-btn > span.tcs-r-button:hover > i,
			.tcs-button.tcs-hollow-prime > a:hover > i,
			.tcs-button.tcs-hollow-prime > span.tcs-r-button:hover > i,
			span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-prime:hover > i,
			.tcs-fancy-header.tcs-style2 i,
			.tcs-impact-header.tcs-color > i {
				' . react_css_color($options['general_color_global_primary_icon'], 'color') . '
			}
		';
	}
?>
<?php /* Global Info Menu Color */ ?>
.info-menu .im-button.info-menu-ul > li {
	border-left: 1px none transparent;
}
<?php
	if ($options['general_color_infomenu_border']) {
		echo '
			.info-menu .im-button.info-menu-ul > li {
				' . react_css_color($options['general_color_infomenu_border'], 'border-top-color') . '
				' . react_css_color($options['general_color_infomenu_border'], 'border-bottom-color') . '
			}
			.info-menu .im-button.info-menu-ul > li:first-child, .info-menu .im-button.info-menu-ul > li.first-child {
				' . react_css_color($options['general_color_infomenu_border'], 'border-left-color') . '
			}
			.info-menu .im-button.info-menu-ul > li.last-child {
				' . react_css_color($options['general_color_infomenu_border'], 'border-right-color') . '
			}
			.info-menu .im-button.info-menu-ul > li:last-child {
				' . react_css_color($options['general_color_infomenu_border'], 'border-right-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_infomenu_background_active']) {
		echo '
			.im-trigger:after {
				' . react_css_color($options['general_color_infomenu_background_active']) . '
			}
		';
	}
?>
<?php
	if ($options['general_color_infomenu_background'] != '' || $options['general_color_infomenu_border'] != '') {
		echo '
			.info-menu .im-button.info-menu-ul > li {
				' . react_css_color($options['general_color_infomenu_background']) . '
			}
			.info-menu .im-button.info-menu-ul > li:first-child, .info-menu .im-button.info-menu-ul > li.first-child {
				' . react_css_color($options['general_color_infomenu_border'], 'border-left-color') . '
			}
			.info-menu .im-button.info-menu-ul > li > a {
				' . react_css_color($options['general_color_infomenu_background_even_darker'], 'border-right-color') . '
			}
			.info-menu .im-button.info-menu-ul > li:hover > a {
				' . react_css_color($options['general_color_infomenu_background_even_darker'], 'border-right-color') . '
			}
			.info-menu .im-button.info-menu-ul > li, .info-menu .im-button.info-menu-ul > li:last-child > a {
				border-right: 0 none;
			}
			.info-menu .im-button.info-menu-ul > li, .info-menu .im-button.info-menu-ul > li.last-child > a {
				border-right: 0 none;
			}
			.info-menu .im-button.info-menu-ul > li:last-child {
				' . react_css_color($options['general_color_infomenu_border'], 'border-right-color') . '
			}
			.info-menu .im-button.info-menu-ul > li.last-child {
				' . react_css_color($options['general_color_infomenu_border'], 'border-right-color') . '
			}
			.info-menu .im-button.info-menu-ul > li:hover > a, .info-menu .im-button.info-menu-ul > li > a.im-active {
				' . react_css_color($options['general_color_infomenu_background_hover']) . '
				' . react_css_color($options['general_color_infomenu_background_hover'], 'border-right-color') . '
			}
		';
	}
?>

<?php /* Global TopHeader Color */ ?>
<?php
	if ($options['general_color_topheader_background'] != '' || $options['general_color_topheader_border'] != '' || $options['general_color_topheader_text'] != '') {
		echo '
			.top-and-pop #tophead {
				' . react_css_color($options['general_color_topheader_background']) . '
				' . react_css_color($options['general_color_topheader_border'], 'border-color') . '
				' . react_css_color($options['general_color_topheader_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_text'] != '') {
		echo '
			#tophead h1, #tophead h2, #tophead h3, #tophead h4, #tophead h5, #tophead h6, #tophead .contact-info-drop  {
				' . react_css_color($options['general_color_topheader_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_nav_text'] != '') {
		echo '
			#tophead a:link, #tophead a:visited, #tophead a.subtle-link, #tophead span.subtle-link {
				' . react_css_color($options['general_color_topheader_nav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_nav_text_hover'] != '') {
		echo '
			#tophead a:hover, #tophead a:active, #tophead a.subtle-link:hover, #tophead a.subtle-link:hover {
				' . react_css_color($options['general_color_topheader_nav_text_hover'], 'color') . '
			}
		';
	}
?>



<?php
	if ($options['general_color_topheader_background_gradient']) {
		echo '
		#tophead {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($options['general_color_topheader_background_lighter']) . ' 0%, ' . react_sanitize_color($options['general_color_topheader_background_much_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($options['general_color_topheader_background_lighter']) . '), color-stop(100%,' . react_sanitize_color($options['general_color_topheader_background_much_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($options['general_color_topheader_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_topheader_background_much_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($options['general_color_topheader_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_topheader_background_much_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($options['general_color_topheader_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_topheader_background_much_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($options['general_color_topheader_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_topheader_background_much_darker']) . ' 100%);
		}';
	}
?>
<?php
	if ($options['general_color_topheader_border_lr']) {
		echo '
			.top-and-pop #tophead {
				' . react_css_color($options['general_color_topheader_border_lr'], 'border-left-color') . '
				' . react_css_color($options['general_color_topheader_border_lr'], 'border-right-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_nav_text']) {
		echo '
			#tophead .react-menu > li > a, #tophead .contact-details-top-head .method > a {
				' . react_css_color($options['general_color_topheader_nav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_nav_text_hover']) {
		echo '
			#tophead .react-menu > li > a:hover, #tophead .react-menu > li.sfHover > a, #tophead .react-menu > li > a:active,
			#tophead .contact-details-top-head .method:hover > a, #tophead .contact-details-top-head .method > a:active {
				' . react_css_color($options['general_color_topheader_nav_text_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_icon']) {
		echo '
			#tophead a.contact-info-drop-trigger i, #tophead .method i, #tophead .social-icon-wrap i {
				' . react_css_color($options['general_color_topheader_icon'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_icon_hover']) {
		echo '
			#tophead a.contact-info-drop-trigger:hover i, #tophead a.contact-info-drop-trigger.active, #tophead .method:hover i, #tophead .social-icon-wrap a:hover i {
				' . react_css_color($options['general_color_topheader_icon_hover'], 'color') . '
			}
		';
	}
?>


<?php
if ($options['general_color_topheader_buttonnav_background']) {
	echo '
			#tophead .button-nav.hover ul.react-menu > li > a {
				background: transparent;
				border-color: transparent;
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_buttonnav_background'] != '' || $options['general_color_topheader_buttonnav_border'] != '' || $options['general_color_topheader_buttonnav_text'] != '') {
		echo '

			#tophead .button-nav ul.react-menu > li > a, #tophead ul.react-menu > li.button-nav > a, #tophead .button-nav .method, #tophead .button-nav .contact-info-drop-wrap a {
				' . react_css_color($options['general_color_topheader_buttonnav_background']) . '
				' . react_css_color($options['general_color_topheader_buttonnav_border'], 'border-color') . '
				' . react_css_color($options['general_color_topheader_buttonnav_text'], 'color') . '
			}

		';
	}
?>
<?php
	if ($options['general_color_topheader_buttonnav_background_hover'] != '' || $options['general_color_topheader_buttonnav_border_hover'] != '' || $options['general_color_topheader_buttonnav_text_hover'] != '') {
		echo '
			#tophead ul.react-menu > li.button-nav > a:hover, #tophead ul.react-menu > li.button-nav > a:active, #tophead ul.react-menu > li.button-nav.sfHover > a,
			#tophead .button-nav ul.react-menu > li > a:hover, #tophead .button-nav.hover ul.react-menu > li > a:hover, #tophead .button-nav ul.react-menu > li.sfHover > a, #tophead .button-nav.hover ul.react-menu > li.sfHover > a,
			#tophead .button-nav ul.react-menu > li > a:active, #tophead .button-nav .method:hover, #tophead .button-nav .contact-info-drop-wrap a:hover, #tophead .button-nav .contact-info-drop-wrap a.active {
				' . react_css_color($options['general_color_topheader_buttonnav_background_hover']) . '
				' . react_css_color($options['general_color_topheader_buttonnav_border_hover'], 'border-color') . '
				' . react_css_color($options['general_color_topheader_buttonnav_text_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_buttonnav_text']) {
		echo '
			#tophead .button-nav .method a {
				' . react_css_color($options['general_color_topheader_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_buttonnav_text_hover']) {
		echo '
			#tophead .button-nav .method:hover a {
				' . react_css_color($options['general_color_topheader_buttonnav_text_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_background']) {
		echo '
			#tophead .split-nav ul.react-menu > li:not(.button-nav) > a, #tophead .split-nav .method, #tophead .contact-details-top-head .divide {
				' . react_css_color($options['general_color_topheader_background_darker'], 'border-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_background_darker']) {
		echo '
			#tophead .contact-info-drop {
				' . react_css_color($options['general_color_topheader_background_much_darker']) . '
			}
			#tophead .contact-info-drop:after {
				' . react_css_color($options['general_color_topheader_background_much_darker'], 'border-bottom-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_buttonnav_background'] != '' || $options['general_color_topheader_buttonnav_border'] != '' || $options['general_color_topheader_buttonnav_text'] != '') {
		echo '
			#tophead .button-nav ul.react-menu > li > a {
				' . react_css_color($options['general_color_topheader_buttonnav_background']) . '
				' . react_css_color($options['general_color_topheader_buttonnav_border'], 'border-color') . '
				' . react_css_color($options['general_color_topheader_buttonnav_text'], 'color') . '
			}
			#tophead ul.react-menu ul.sub-menu {
				' . react_css_color($options['general_color_topheader_buttonnav_background']) . '
				' . react_css_color($options['general_color_topheader_buttonnav_border'], 'border-color') . '
				' . react_css_color($options['general_color_topheader_buttonnav_text'], 'color') . '
			}
			#tophead .react-menu > li > ul.sub-menu:after {' . react_css_color($options['general_color_topheader_buttonnav_border'], 'border-left-color') . '}

		';
	}
?>
<?php
	if ($options['general_color_topheader_buttonnav_text']) {
		echo '
			#tophead ul.react-menu ul.sub-menu li {
				' . react_css_color($options['general_color_topheader_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_buttonnav_background'] != '' || $options['general_color_topheader_buttonnav_text'] != '') {
		echo '
			#tophead ul.react-menu ul.sub-menu li a {
				' . react_css_color($options['general_color_topheader_buttonnav_background_darken'], 'border-color') . '
				' . react_css_color($options['general_color_topheader_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_buttonnav_text']) {
		echo '
			#tophead .button-nav ul.react-menu ul.sub-menu li a span.main {
				' . react_css_color($options['general_color_topheader_buttonnav_text'], 'color') . '
			}
			#tophead .button-nav ul.react-menu ul.sub-menu li a:hover span.main, #tophead .button-nav ul.react-menu ul.sub-menu li.sfHover > a span.main, #tophead .button-nav ul.react-menu ul.sub-menu li a:active span.main  {
				' . react_css_color($options['general_color_topheader_buttonnav_text'], 'color') . '
			}
		';
	}
?>

<?php
	if ($options['general_color_topheader_buttonnav_background_hover']) {
		echo '
			#tophead ul.react-menu ul.sub-menu li:hover, #tophead #nav-wrap ul.react-menu ul.sub-menu li:hover,
			#tophead ul.react-menu ul.sub-menu li.sfHover, #tophead #nav-wrap ul.react-menu ul.sub-menu li.sfHover {
				' . react_css_color($options['general_color_topheader_buttonnav_background_hover']) . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_buttonnav_text_hover'] != '' || $options['general_color_topheader_buttonnav_border_hover'] != '' || $options['general_color_topheader_buttonnav_background_hover'] != '') {
		echo '
			#tophead ul.react-menu ul.sub-menu li a:hover, #tophead ul.react-menu ul.sub-menu li.sfHover > a, #tophead #nav-wrap ul.react-menu ul.sub-menu li a:active {
				' . react_css_color($options['general_color_topheader_buttonnav_text_hover'], 'color') . '
				' . react_css_color($options['general_color_topheader_buttonnav_border_hover'], 'border-color') . '
			}
			#tophead ul.react-menu > li.button-nav > a:hover, #tophead ul.react-menu > li.sfHover.button-nav > a, #tophead ul.react-menu > li.button-nav > a:active
			#tophead .button-nav ul.react-menu > li > a:hover, #tophead .button-nav ul.react-menu > li.sfHover > a, #tophead .button-nav ul.react-menu > li > a:active {
				' . react_css_color($options['general_color_topheader_buttonnav_background_hover']) . '
				' . react_css_color($options['general_color_topheader_buttonnav_border_hover'], 'border-color') . '
				' . react_css_color($options['general_color_topheader_buttonnav_text_hover'], 'color') . '
			}
		';
	}
?>

<?php
	if ($options['general_color_topheader_nav_text'] != '' || $options['general_color_topheader_buttonnav_border'] != '') {
		echo '
			#tophead nav.subtle-link a span.main {
				' . react_css_color($options['general_color_topheader_nav_text'], 'color') . '
			}
			#tophead nav.subtle-link a span.main:after, #tophead nav.subtle-link a span.main:before {
				' . react_css_color($options['general_color_topheader_buttonnav_border'], 'background') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_topheader_nav_text_hover'] != '' || $options['general_color_topheader_buttonnav_border_hover'] != '') {
		echo '
			#tophead nav.subtle-link a:hover span.main {
				' . react_css_color($options['general_color_topheader_nav_text_hover'], 'color') . '
			}
			#tophead nav.subtle-link a:hover span.main:after, #tophead nav.subtle-link a:hover span.main:before {
				' . react_css_color($options['general_color_topheader_buttonnav_border_hover'], 'background') . '
			}
		';
	}
?>

<?php
	if ($options['general_color_topheader_background_darker']) {
		echo '
			#tophead .contact-info-drop-wrap, #tophead .split-nav ul.react-menu > li:not(.button-nav) > a, #tophead .split-nav .method {
				' . react_css_color($options['general_color_topheader_background_darker'], 'border-color') . '
			}
		';
	}
?>

<?php /* Global MainHead Color */ ?>

<?php
	if ($options['general_color_mainheader_background'] != '' || $options['general_color_mainheader_border'] != '') {
		echo '
			#header {
				' . react_css_color($options['general_color_mainheader_background']) . '
				' . react_css_color($options['general_color_mainheader_border'], 'border-color') . '
			}
		   #slide-out-box.im-box {' . react_css_color($options['general_color_mainheader_background_much_darker'], 'border-color') . '}
		';
	}
?>
<?php
	if ($options['general_color_mainheader_background_gradient']) {
		echo '
		#header {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($options['general_color_mainheader_background_lighter']) . ' 0%, ' . react_sanitize_color($options['general_color_mainheader_background_much_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($options['general_color_mainheader_background_lighter']) . '), color-stop(100%,' . react_sanitize_color($options['general_color_mainheader_background_much_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($options['general_color_mainheader_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_mainheader_background_much_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($options['general_color_mainheader_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_mainheader_background_much_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($options['general_color_mainheader_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_mainheader_background_much_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($options['general_color_mainheader_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_mainheader_background_much_darker']) . ' 100%);
		}';
	}
?>
<?php
	if ($options['general_color_mainheader_border']) {
		echo '
			body.t-mrg .header-all #header {
				' . react_css_color($options['general_color_mainheader_border'], 'border-color') . '
			}
		';
	}
?>
<?php
if ($options['general_color_mainheader_border_lr']) {
	echo '
		body.t-mrg .header-all #header, #header {
			' . react_css_color($options['general_color_mainheader_border_lr'], 'border-left-color') . '
			' . react_css_color($options['general_color_mainheader_border_lr'], 'border-right-color') . '
		}';
	}
?>
<?php
	if ($options['general_color_mainheader_strapline']) {
		echo '
			.logo span.strap-line {
				' . react_css_color($options['general_color_mainheader_strapline'], 'color') . '
			}
		';
	}
?>

<?php
	if ($options['general_color_mainheader_background']) {
		echo '
			#header .back-home-icon, .logo-r #header .back-home-icon, #header .split-nav ul.react-menu > li:not(.button-nav) > a, #header .info-menu .im-split.info-menu-ul > li {
				' . react_css_color($options['general_color_mainheader_background_darker'], 'border-color') . '
			}
		';
	}
?>
<?php /* Global MainNav Color */ ?>

<?php
	if ($options['general_color_default_textnav_text']) {
		echo '
			#header #nav-wrap ul.react-menu li a span.main, #header #nav-wrap, #header .device-menu-trigger-wrap.plain-nav, .device-top-menu-trigger-wrap.plain-nav {
				' . react_css_color($options['general_color_default_textnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_textnav_text_hover']) {
		echo '
			#header #nav-wrap ul.react-menu li a:hover span.main, #header #nav-wrap ul.react-menu li.sfHover > a span.main, #header #nav-wrap ul.react-menu li a:hover span.main, #header .device-menu-trigger-wrap.plain-nav:hover, .device-top-menu-trigger-wrap.plain-nav:hover {
				' . react_css_color($options['general_color_default_textnav_text_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_text']) {
		echo '
			#header #nav-wrap ul.react-menu li.button-nav a span.main,
			#header #nav-wrap.button-nav ul.react-menu li a span.main, #header #nav-wrap.button-nav {
				' . react_css_color($options['general_color_default_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_text_hover'] ) {
		echo '
			#header #nav-wrap ul.react-menu li.button-nav a:hover span.main, #header #nav-wrap ul.react-menu li.button-nav.sfHover > a span.main, #header #nav-wrap ul.react-menu li.button-nav a:hover span.main,
			#header #nav-wrap.button-nav ul.react-menu li a:hover span.main, #header #nav-wrap.button-nav ul.react-menu li.sfHover > a span.main, #header #nav-wrap.button-nav ul.react-menu li a:hover span.main {
				' . react_css_color($options['general_color_default_buttonnav_text_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_textnav_desc']) {
		echo '
			#header #nav-wrap.desc-on ul.react-menu li a span.desc {
				' . react_css_color($options['general_color_default_textnav_desc'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_textnav_desc_hover']) {
		echo '
			#header #nav-wrap.desc-on ul.react-menu li a:hover span.desc, #header #nav-wrap.desc-on ul.react-menu li.sfHover > a span.desc, #header #nav-wrap.desc-on ul.react-menu li a:active span.desc {
				' . react_css_color($options['general_color_default_textnav_desc_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_desc'] ) {
		echo '
			#header #nav-wrap.desc-on ul.react-menu li.button-nav a span.desc,
			#header #nav-wrap.button-nav.desc-on ul.react-menu li a span.desc {
				' . react_css_color($options['general_color_default_buttonnav_desc'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_desc_hover'] ) {
		echo '
			#header #nav-wrap.desc-on ul.react-menu li.button-nav a:hover span.desc, #header #nav-wrap.desc-on ul.react-menu li.button-nav.sfHover > a span.desc, #header #nav-wrap.desc-on ul.react-menu li.button-nav a:active span.desc,
			#header #nav-wrap.button-nav.desc-on ul.react-menu li a:hover span.desc, #header #nav-wrap.button-nav.desc-on ul.react-menu li.sfHover > a span.desc, #header #nav-wrap.button-nav.desc-on ul.react-menu li a:active span.desc {
				' . react_css_color($options['general_color_default_buttonnav_desc_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_background'] != '' || $options['general_color_default_buttonnav_border'] != '' || $options['general_color_default_buttonnav_text'] != '') {
		echo '
			#header #nav-wrap.button-nav ul.react-menu > li > a, #header #nav-wrap ul.react-menu > li.button-nav > a, .device-menu-trigger-wrap.button-nav, .device-top-menu-trigger-wrap.button-nav {
				' . react_css_color($options['general_color_default_buttonnav_background']) . '
				' . react_css_color($options['general_color_default_buttonnav_border'], 'border-color') . '
				' . react_css_color($options['general_color_default_buttonnav_text'], 'color') . '
			}
		';
	}
?>

<?php
	if ($options['general_color_default_textnav_text'] != '' || $options['general_color_default_buttonnav_border'] != '') {
		echo '
			#header nav.subtle-link a span.main {
				' . react_css_color($options['general_color_default_textnav_text'], 'color') . '
			}
			#header nav.subtle-link a span.main:after, #header nav.subtle-link a span.main:before {
				' . react_css_color($options['general_color_default_buttonnav_border'], 'background') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_textnav_text_hover'] != '' || $options['general_color_default_buttonnav_border_hover'] != '') {
		echo '
			#header nav.subtle-link a:hover span.main {
				' . react_css_color($options['general_color_default_textnav_text_hover'], 'color') . '
			}
			#header nav.subtle-link a:hover span.main:after, #header nav.subtle-link a:hover span.main:before {
				' . react_css_color($options['general_color_default_buttonnav_border_hover'], 'background') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_background']) {
		echo '
			#header #nav-wrap.button-nav.hover ul.react-menu > li > a {
				background: transparent;
				border-color: transparent;
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_background'] != '' || $options['general_color_default_buttonnav_border'] != '' || $options['general_color_default_buttonnav_text'] != '') {
		echo '
			#header #nav-wrap ul.react-menu ul.sub-menu {
				' . react_css_color($options['general_color_default_buttonnav_background']) . '
				' . react_css_color($options['general_color_default_buttonnav_border'], 'border-color') . '
				' . react_css_color($options['general_color_default_buttonnav_text'], 'color') . '
			}
			#header #nav-wrap .react-menu > li > ul.sub-menu:after {' . react_css_color($options['general_color_default_buttonnav_border'], 'border-left-color') . '}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_text']) {
		echo '
			#header #nav-wrap ul.react-menu ul.sub-menu li {
				' . react_css_color($options['general_color_default_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_background'] != '' || $options['general_color_default_buttonnav_text'] != '') {
		echo '
			#header #nav-wrap ul.react-menu ul.sub-menu li a {
				' . react_css_color($options['general_color_default_buttonnav_background_darken'], 'border-color') . '
				' . react_css_color($options['general_color_default_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_text']) {
		echo '
			#header #nav-wrap.button-nav ul.react-menu ul.sub-menu li a span.main  {
				' . react_css_color($options['general_color_default_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_text']) {
		echo '
			#header #nav-wrap.button-nav ul.react-menu ul.sub-menu li a:hover span.main, #header #nav-wrap.button-nav ul.react-menu ul.sub-menu li.sfHover > a span.main, #header #nav-wrap.button-nav ul.react-menu ul.sub-menu li a:active span.main  {
				' . react_css_color($options['general_color_default_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_desc']) {
		echo '
			#header #nav-wrap.button-nav ul.react-menu ul.sub-menu li a span.desc  {
				' . react_css_color($options['general_color_default_buttonnav_desc'], 'color') . '
			}

			#header #nav-wrap.button-nav ul.react-menu ul.sub-menu li a:hover span.desc,
			#header #nav-wrap.button-nav ul.react-menu ul.sub-menu > li.sfHover > a span.desc {
				' . react_css_color($options['general_color_default_buttonnav_desc'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_background_hover']) {
		echo '
			#header #nav-wrap ul.react-menu ul.sub-menu li:hover, #header #nav-wrap ul.react-menu ul.sub-menu li:hover,
			#header #nav-wrap ul.react-menu ul.sub-menu li.sfHover, #header #nav-wrap ul.react-menu ul.sub-menu li.sfHover {
				' . react_css_color($options['general_color_default_buttonnav_background_hover']) . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_text_hover'] != '' || $options['general_color_default_buttonnav_border_hover'] != '') {
		echo '
			#header #nav-wrap ul.react-menu ul.sub-menu li a:hover, #header #nav-wrap ul.react-menu ul.sub-menu li.sfHover > a, #header #nav-wrap ul.react-menu ul.sub-menu li a:active {
				' . react_css_color($options['general_color_default_buttonnav_text_hover'], 'color') . '
				' . react_css_color($options['general_color_default_buttonnav_border_hover'], 'border-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_buttonnav_background_hover'] != '' || $options['general_color_default_buttonnav_border_hover'] != '' || $options['general_color_default_buttonnav_text_hover'] != '') {
		echo '
			#header #nav-wrap ul.react-menu > li.button-nav > a:hover, #header #nav-wrap ul.react-menu > li.button-nav > a:active, #header #nav-wrap ul.react-menu > li.button-nav.sfHover > a,
			#header #nav-wrap.button-nav ul.react-menu > li > a:hover, #header #nav-wrap.button-nav.hover ul.react-menu > li > a:hover, #header #nav-wrap.button-nav ul.react-menu > li.sfHover > a,  #header #nav-wrap.button-nav.hover ul.react-menu > li.sfHover > a,
			#header #nav-wrap.button-nav ul.react-menu > li > a:active, .device-menu-trigger-wrap.button-nav:hover, .device-top-menu-trigger-wrap.button-nav:hover {
				' . react_css_color($options['general_color_default_buttonnav_background_hover']) . '
				' . react_css_color($options['general_color_default_buttonnav_border_hover'], 'border-color') . '
				' . react_css_color($options['general_color_default_buttonnav_text_hover'], 'color') . '
			}
		';
	}
?>



<?php /* Global SoloNav Color */ ?>

<?php
	if ($options['general_color_solonav_background'] != '' || $options['general_color_solonav_border'] != '') {
		echo '
			#solonav {
				' . react_css_color($options['general_color_solonav_background']) . '
				' . react_css_color($options['general_color_solonav_border'], 'border-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_background_gradient']) {
		echo '
		#solonav {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($options['general_color_solonav_background_lighter']) . ' 0%, ' . react_sanitize_color($options['general_color_solonav_background_much_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($options['general_color_solonav_background_lighter']) . '), color-stop(100%,' . react_sanitize_color($options['general_color_solonav_background_much_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($options['general_color_solonav_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_solonav_background_much_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($options['general_color_solonav_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_solonav_background_much_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($options['general_color_solonav_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_solonav_background_much_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($options['general_color_solonav_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_solonav_background_much_darker']) . ' 100%);
		}';
	}
?>
<?php
if ($options['general_color_solonav_border_lr']) {
	echo '
	#solonav {
		' . react_css_color($options['general_color_solonav_border_lr'], 'border-left-color') . '
		' . react_css_color($options['general_color_solonav_border_lr'], 'border-right-color') . '
	}';
	}
?>
<?php
	if ($options['general_color_solonav_background']) {
		echo '
			#solonav .back-home-icon, #solonav .split-nav ul.react-menu > li:not(.button-nav) > a {
				' . react_css_color($options['general_color_solonav_background_darker'], 'border-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_text']) {
		echo '
			#solonav .solonav-wrap ul.react-menu li.button-nav a span.main,
			#solonav .solonav-wrap .button-nav ul.react-menu li a span.main, #solonav .solonav-wrap .button-nav {
				' . react_css_color($options['general_color_solonav_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_text_hover']) {
		echo '
			#solonav .solonav-wrap ul.react-menu li.button-nav a:hover span.main,
			#solonav .solonav-wrap ul.react-menu li.button-nav.sfHover > a span.main,
			#solonav .solonav-wrap .button-nav ul.react-menu li a:hover span.main,
			#solonav .solonav-wrap .button-nav ul.react-menu li.sfHover > a span.main {
				' . react_css_color($options['general_color_solonav_buttonnav_text_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_textnav_text']) {
		echo '
			#solonav .solonav-wrap ul.react-menu li a span.main, #solonav .solonav-wrap {
				' . react_css_color($options['general_color_solonav_textnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_textnav_text_hover']) {
		echo '
			#solonav .solonav-wrap ul.react-menu li a:hover span.main,
			#solonav .solonav-wrap ul.react-menu li.sfHover > a span.main {
				' . react_css_color($options['general_color_solonav_textnav_text_hover'], 'color') . '
			}
		';
	}
?>

<?php
	if ($options['general_color_solonav_buttonnav_text']) {
		echo '
			#solonav .solonav-wrap ul.react-menu li.button-nav a span.main,
			#solonav .solonav-wrap .button-nav ul.react-menu li a span.main {
				' . react_css_color($options['general_color_solonav_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_text_hover']) {
		echo '
			#solonav .solonav-wrap ul.react-menu li.button-nav a:hover span.main,
			#solonav .solonav-wrap ul.react-menu li.button-nav.sfHover > a span.main,
			#solonav .solonav-wrap .button-nav ul.react-menu li a:hover span.main,
			#solonav .solonav-wrap .button-nav ul.react-menu li.sfHover > a span.main {
				' . react_css_color($options['general_color_solonav_buttonnav_text_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_textnav_desc']) {
		echo '
			#solonav .solonav-wrap .desc-on ul.react-menu li a span.desc {
				' . react_css_color($options['general_color_solonav_textnav_desc'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_textnav_desc_hover']) {
		echo '
			#solonav .solonav-wrap .desc-on ul.react-menu li a:hover span.desc, #solonav .solonav-wrap .desc-on ul.react-menu li a:active span.desc,
			#solonav .solonav-wrap .desc-on ul.react-menu li.sfHover > a span.desc {
				' . react_css_color($options['general_color_solonav_textnav_desc_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_desc']) {
		echo '
			#solonav .solonav-wrap .desc-on ul.react-menu li.button-nav a span.desc,
			#solonav .solonav-wrap .button-nav.desc-on ul.react-menu li a span.desc {
				' . react_css_color($options['general_color_solonav_buttonnav_desc'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_desc_hover']) {
		echo '
			#solonav .solonav-wrap .desc-on ul.react-menu li.button-nav a:hover span.desc, #solonav .solonav-wrap .desc-on ul.react-menu li.button-nav a:active span.desc,
			#solonav .solonav-wrap .desc-on ul.react-menu li.button-nav.sfHover > a span.desc,
			#solonav .solonav-wrap .button-nav.desc-on ul.react-menu li a:hover span.desc, #solonav .solonav-wrap .button-nav.desc-on ul.react-menu li a:active span.desc,
			#solonav .solonav-wrap .button-nav.desc-on ul.react-menu li.sfHover > a span.desc {
				' . react_css_color($options['general_color_solonav_buttonnav_desc_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_background'] != '' || $options['general_color_solonav_buttonnav_border'] != '' || $options['general_color_solonav_buttonnav_text'] != '') {
		echo '
			#solonav .solonav-wrap .button-nav ul.react-menu > li > a {
				' . react_css_color($options['general_color_solonav_buttonnav_background']) . '
				' . react_css_color($options['general_color_solonav_buttonnav_border'], 'border-color') . '
				' . react_css_color($options['general_color_solonav_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_default_textnav_text'] != '' || $options['general_color_solonav_buttonnav_border'] != '') {
		echo '
			#solonav nav.subtle-link a span.main {
				' . react_css_color($options['general_color_solonav_buttonnav_border'], 'border-color') . '
				' . react_css_color($options['general_color_solonav_textnav_text'], 'color') . '
			}
			#solonav nav.subtle-link a span.main:after, #solonav nav.subtle-link a span.main:before {
				' . react_css_color($options['general_color_solonav_buttonnav_border'], 'background') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_textnav_text_hover'] != '' || $options['general_color_solonav_buttonnav_border_hover'] != '') {
		echo '
			#solonav nav.subtle-link a:hover span.main {
				' . react_css_color($options['general_color_solonav_buttonnav_border_hover'], 'border-color') . '
				' . react_css_color($options['general_color_solonav_textnav_text_hover'], 'color') . '
			}
			#solonav nav.subtle-link a:hover span.main:after, #solonav nav.subtle-link a:hover span.main:before {
				' . react_css_color($options['general_color_solonav_buttonnav_border_hover'], 'background') . '
			}
		';
	}
?>

<?php
	if ($options['general_color_solonav_buttonnav_background']) {
		echo '
			#solonav .solonav-wrap .button-nav.hover ul.react-menu > li > a {
				background: transparent;
				border-color: transparent;
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_background_hover'] != '' || $options['general_color_solonav_buttonnav_border_hover'] != '' || $options['general_color_solonav_buttonnav_text_hover'] != '') {
		echo '
			#solonav .solonav-wrap ul.react-menu > li.button-nav > a:hover, #solonav .solonav-wrap ul.react-menu > li.button-nav > a:active, #solonav .solonav-wrap ul.react-menu > li.button-nav.sfHover > a,
			#solonav .solonav-wrap .button-nav ul.react-menu > li > a:hover, #solonav .solonav-wrap .button-nav.hover ul.react-menu > li > a:hover, #solonav .solonav-wrap .button-nav ul.react-menu > li.sfHover > a, #solonav .solonav-wrap .button-nav.hover ul.react-menu > li.sfHover > a,
			#solonav .solonav-wrap .button-nav ul.react-menu > li > a:active, #solonav .solonav-wrap .button-nav ul.react-menu > li.sfHover > a {
				' . react_css_color($options['general_color_solonav_buttonnav_background_hover']) . '
				' . react_css_color($options['general_color_solonav_buttonnav_border_hover'], 'border-color') . '
				' . react_css_color($options['general_color_solonav_buttonnav_text_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_background'] != '' || $options['general_color_solonav_buttonnav_border'] != '' || $options['general_color_solonav_buttonnav_text'] != '') {
		echo '
			#solonav .solonav-wrap ul.react-menu ul.sub-menu {
				' . react_css_color($options['general_color_solonav_buttonnav_background']) . '
				' . react_css_color($options['general_color_solonav_buttonnav_border'], 'border-color') . '
				' . react_css_color($options['general_color_solonav_buttonnav_text'], 'color') . '
			}
			#solonav .solonav-wrap .react-menu > li > ul.sub-menu:after {' . react_css_color($options['general_color_solonav_buttonnav_border'], 'border-left-color') . '}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_text']) {
		echo '
			#solonav .solonav-wrap ul.react-menu ul.sub-menu li {
				' . react_css_color($options['general_color_solonav_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_background'] != '' || $options['general_color_solonav_buttonnav_text'] != '') {
		echo '
			#solonav .solonav-wrap ul.react-menu ul.sub-menu li a {
				' . react_css_color($options['general_color_solonav_buttonnav_background_darken']) . '
				' . react_css_color($options['general_color_solonav_buttonnav_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_background_hover'] != '' || $options['general_color_solonav_buttonnav_text_hover'] != '') {
		echo '
			#solonav .solonav-wrap ul.react-menu ul.sub-menu > li:hover > a {
				' . react_css_color($options['general_color_solonav_buttonnav_background_hover'], 'border-color') . '
				' . react_css_color($options['general_color_solonav_buttonnav_text_hover'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_background_hover']) {
		echo '
			#solonav .solonav-wrap ul.react-menu ul.sub-menu > li:hover, #solonav .solonav-wrap ul.react-menu ul.sub-menu > li:hover {
				' . react_css_color($options['general_color_solonav_buttonnav_background_hover']) . '
			}
		';
	}
?>
<?php
	if ($options['general_color_solonav_buttonnav_text_hover']) {
		echo '
			#solonav .solonav-wrap ul.react-menu ul.sub-menu > li > a:hover, #solonav .solonav-wrap ul.react-menu ul.sub-menu > li.sfHover > a, #solonav #nav-wrap ul.react-menu ul.sub-menu > li > a:active {
				' . react_css_color($options['general_color_solonav_buttonnav_text_hover'], 'color') . '
			}
		';
	}
?>

<?php /* Sticky header */ ?>

<?php
if (($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_head') || ($options['main_header_fixed'])) {
	if ($options['general_color_stickyhead_background'] != '' || $options['general_color_stickyhead_border'] != '') {
		echo '
			#header {
				-moz-transition: background 0.3s ease-in, border-color 0.3s ease-in;
				-webkit-transition: background 0.3s ease-in, border-color 0.3s ease-in;
				transition: background 0.3s ease-in, border-color 0.3s ease-in;
			}
			#header.stickied, .has-scrolled #header {
				' . react_css_color($options['general_color_stickyhead_background']) . '
				' . react_css_color($options['general_color_stickyhead_border'], 'border-color') . '
			}
		';
	}
} if (($options['general_sticky_header'] && $options['nav_prime_nav_location'] == 'prime_nav_in_solo') || ($options['main_header_fixed'])) {
	if ($options['general_color_stickyhead_background'] != '' || $options['general_color_stickyhead_border'] != '') {
		echo '
			#solonav {
				-moz-transition: background 0.3s ease-in, border-color 0.3s ease-in;
				-webkit-transition: background 0.3s ease-in, border-color 0.3s ease-in;
				transition: background 0.3s ease-in, border-color 0.3s ease-in;
			}
			#solonav.stickied, .has-scrolled #solonav {
				' . react_css_color($options['general_color_stickyhead_background']) . '
				' . react_css_color($options['general_color_stickyhead_border'], 'border-color') . '
			}
		';
	}
}
?>

<?php /* Global Intro Color */ ?>

<?php
	if ($options['general_color_intro_background'] != '' || $options['general_color_intro_border'] != '') {
		echo '
			#intro  {
				' . react_css_color($options['general_color_intro_background']) . '
				' . react_css_color($options['general_color_intro_border'], 'border-color') . '
			}
			#intro .breadcrumbs a,
			#intro .breadcrumbs .breadcrumbs-inner > span a,
			#intro .breadcrumbs .back-home-icon {
				' . react_css_color($options['general_color_intro_background_darker'], 'border-color') . '
			}
		';
	}
?>
<?php
if ($options['general_color_intro_border_lr']) {
	echo '
		#intro {
			' . react_css_color($options['general_color_intro_border_lr'], 'border-left-color') . '
			' . react_css_color($options['general_color_intro_border_lr'], 'border-right-color') . '
		}';
	}
?>
<?php
	if ($options['general_color_intro_h1']) {
		echo '
			#intro h1.intro-title {
				' . react_css_color($options['general_color_intro_h1'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_intro_h2']) {
		echo '
			#intro h2.intro-subtitle {
				' . react_css_color($options['general_color_intro_h2'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_intro_h2_icon']) {
		echo '
			#intro h2.intro-subtitle i.fa {
				' . react_css_color($options['general_color_intro_h2_icon'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_intro_h1'] != '' || $options['general_color_intro_background'] != '') {
		echo '
			#intro .react-vote .count {
				' . react_css_color($options['general_color_intro_h1'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_intro_background']) {
		echo '
			#intro .react-vote {
				' . react_css_color($options['general_color_intro_background_darker'], 'border-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_intro_h2']) {
		echo '
			#intro .react-vote .like {
				' . react_css_color($options['general_color_intro_h2'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_intro_text'] != '') {
		echo '
			#intro .breadcrumbs > span, #intro .breadcrumbs {
				' . react_css_color($options['general_color_intro_text'], 'color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_intro_links'] != '' || $options['general_color_intro_links_hover'] != '') {
		echo '
			#intro .intro-wrap a {
				' . react_css_color($options['general_color_intro_links'], 'color') . '
			}
			#intro .intro-wrap a:hover {
				' . react_css_color($options['general_color_intro_links_hover'], 'color') . '
			}
		';
	}
?>


<?php /* Global Slider Color */ ?>
<?php
	if ($options['general_color_slider_dark_bg']) {
		echo '
			.slider-wrap .ls-reactskin .ls-nav-start,
			.slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active,
			.slider-wrap .ls-reactskin .ls-nav-stop,
			.slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-active,

			.slider-wrap .ls-reactskin a.ls-nav-next,
			.slider-wrap .ls-reactskin a.ls-nav-prev {
				' . react_css_color($options['general_color_slider_dark_bg']) . '
			}
			.rev_slider_wrapper .tp-rightarrow.custom,
			.rev_slider_wrapper .tp-leftarrow.custom {
				' . react_css_color($options['general_color_slider_dark_bg'], 'background-color', '!important') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_slider_primary_bg']) {
		echo '

			.slider-wrap .ls-reactskin a.ls-nav-next:hover,
			.slider-wrap .ls-reactskin a.ls-nav-prev:hover,

			.slider-wrap .ls-reactskin .ls-nav-start:hover,
			.slider-wrap .ls-reactskin .ls-nav-start.ls-nav-start-active:hover,
			.slider-wrap .ls-reactskin .ls-nav-stop:hover,
			.slider-wrap .ls-reactskin .ls-nav-stop.ls-nav-active:hover {
				' . react_css_color($options['general_color_slider_primary_bg']) . '
			}
			.rev_slider_wrapper .tp-rightarrow.custom:hover,
			.rev_slider_wrapper .tp-leftarrow.custom:hover {
				' . react_css_color($options['general_color_slider_primary_bg'], 'background-color', '!important') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_slider_controls_background'] != '' || $options['general_color_slider_border'] != '') {
		echo '
			.slider-wrap .ls-reactskin .ls-bottom-nav-wrapper {
				' . react_css_color($options['general_color_slider_controls_background']) . '
				' . react_css_color($options['general_color_slider_border'], 'border-top-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_slider_controls_background_gradient']) {
		echo '
		.slider-wrap .ls-reactskin .ls-bottom-nav-wrapper {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($options['general_color_slider_controls_background_lighter']) . ' 0%, ' . react_sanitize_color($options['general_color_slider_controls_background_much_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($options['general_color_slider_controls_background_lighter']) . '), color-stop(100%,' . react_sanitize_color($options['general_color_slider_controls_background_much_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($options['general_color_slider_controls_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_slider_controls_background_much_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($options['general_color_slider_controls_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_slider_controls_background_much_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($options['general_color_slider_controls_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_slider_controls_background_much_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($options['general_color_slider_controls_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_slider_controls_background_much_darker']) . ' 100%);
		}';
	}
?>
<?php
	if ($options['general_color_slider_background'] != '' || $options['general_color_slider_border'] != '' || $options['general_color_slider_text'] != '') {
		echo '
			.slider-wrap {
				' . react_css_color($options['general_color_slider_background']) . '
				' . react_css_color($options['general_color_slider_text'], 'color', '!important') . '
				' . react_css_color($options['general_color_slider_border'], 'border-color') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_slider_text'] != '') {
		echo '
			.slider-wrap .tcs-button.tcs-holw-btn > a, .slider-wrap .tcs-button.tcs-holw-btn > span.tcs-r-button,
			.slider-wrap .tcs-button.tcs-holw-btn > a > i, .slider-wrap .tcs-button.tcs-holw-btn > span.tcs-r-button > i {
				' . react_css_color($options['general_color_slider_text'], 'color', '!important') . '
			}
		';
	}
?>
<?php
	if ($options['general_color_slider_background_gradient']) {
		echo '
		.slider-wrap {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($options['general_color_slider_background_lighter']) . ' 0%, ' . react_sanitize_color($options['general_color_slider_background_much_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($options['general_color_slider_background_lighter']) . '), color-stop(100%,' . react_sanitize_color($options['general_color_slider_background_much_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($options['general_color_slider_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_slider_background_much_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($options['general_color_slider_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_slider_background_much_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($options['general_color_slider_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_slider_background_much_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($options['general_color_slider_background_lighter']) . ' 0%,' . react_sanitize_color($options['general_color_slider_background_much_darker']) . ' 100%);
		}';
	}
?>
<?php
	if ($options['general_color_slider_border']) {
		echo '
			.slider-wrap {
				' . react_css_color($options['general_color_slider_border'], 'border-color') . '
			}
		';
	}
?>

<?php
	if ($options['general_color_slider_border_lr']) {
		echo '
			.slider-wrap {
				' . react_css_color($options['general_color_slider_border_lr'], 'border-left-color') . '
				' . react_css_color($options['general_color_slider_border_lr'], 'border-right-color') . '
			}
		';
	}
?>

<?php /* Global Content Color */ ?>
<?php
if ($options['general_color_content_choose_scheme'] === '') {
	if ($options['general_color_content_background'] || $options['general_color_content_border'] || $options['general_color_content_text']) {
		if ($options['fancybox_choose_scheme'] === '') {
			echo '.fancybox-skin,';
		}
		echo '
			.content-outer,
			.tcs-section-break-help {
				' . react_css_color($options['general_color_content_background']) . '
				' . react_css_color($options['general_color_content_border'], 'border-color') . '
				' . react_css_color($options['general_color_content_text'], 'color') . '
			}
			.after-header-wrap .content-outer, .after-header-wrap {
				' . react_css_color($options['general_color_content_border'], 'border-color') . '
			}
		';
	}

	if ($options['general_color_footer_choose_scheme'] === '') {
		if ($options['general_color_content_background_darker'] || $options['general_color_global_primary_bg'] || $options['general_color_content_text']) {
			echo '
				.footer {
					' . react_css_color($options['general_color_content_background_darker']) . '
					' . react_css_color($options['general_color_global_primary_bg'], 'border-color') . '
					' . react_css_color($options['general_color_content_text'], 'color') . '
				}
			';
		}
	}
	if ($options['general_color_popdown_choose_scheme'] === '') {
		if ($options['general_color_content_background_darker'] || $options['general_color_content_text']) {
		echo '
			.popdown {
				' . react_css_color($options['general_color_content_background_darker']) . '
				' . react_css_color($options['general_color_content_text'], 'color') . '
			}';
		}
	}

	if ($options['general_color_infomenu_popout_choose_scheme'] ==='') {
		if ($options['general_color_content_background'] || $options['general_color_content_text']) {
			echo '
				.im-box, .im-box.im-drop {
					' . react_css_color($options['general_color_content_background_lighter']) . '
					' . react_css_color($options['general_color_content_background_lighter'], 'border-color') . '
					' . react_css_color($options['general_color_content_text'], 'color') . '
				}
				.im-drop:after {
					' . react_css_color($options['general_color_content_background_lighter'], 'border-bottom-color') . '
				}

			';
		}
	}

	if ($options['general_color_content_border_lr']) {
		echo '
		body.pge-bxd .after-header-wrap .content-outer, body.pge-mxd .after-header-wrap .content-outer {
			' . react_css_color($options['general_color_content_border_lr'], 'border-left-color') . '
			' . react_css_color($options['general_color_content_border_lr'], 'border-right-color') . '
		}';
	}
	if ($options['footer_widget_area_layout'] == '') {
		echo '
		{
			border-bottom-style: solid;
			border-bottom-width: 1px;
			' . react_css_color($options['general_color_content_border'], 'border-bottom-color') . '
			margin-bottom: -1px;
		}';
	}

	if ($options['general_color_content_background']) {
		if ($rtl) {
			echo '
			#wp-calendar tbody tr:first-child .pad {
				-webkit-box-shadow: 0 2px 0 0px ' . react_sanitize_color($options['general_color_content_background_much_darker']) . ' inset;
				box-shadow: 0 2px 0 0px ' . react_sanitize_color($options['general_color_content_background_much_darker']) . ' inset;

			}
			#wp-calendar tbody tr:last-child .pad {
				-webkit-box-shadow: -1px 2px 0 0px ' . react_sanitize_color($options['general_color_content_background_even_darker']) . ' inset;
				box-shadow:  -1px 2px 0 0px ' . react_sanitize_color($options['general_color_content_background_even_darker']) . ' inset;

			}';
		} else {
			echo '
			#wp-calendar tbody tr:first-child .pad {
				-webkit-box-shadow: 0 2px 0 0px ' . react_sanitize_color($options['general_color_content_background_much_darker']) . ' inset;
				box-shadow: 0 2px 0 0px ' . react_sanitize_color($options['general_color_content_background_much_darker']) . ' inset;

			}
			#wp-calendar tbody tr:last-child .pad {
				-webkit-box-shadow: 1px 2px 0 0px ' . react_sanitize_color($options['general_color_content_background_even_darker']) . ' inset;
				box-shadow:  1px 2px 0 0px ' . react_sanitize_color($options['general_color_content_background_even_darker']) . ' inset;

			}';
		}
	}

	echo '
		#nav-single .nav-single-inner div:first-child,
		#nav-single .nav-single-inner div:last-child {
			' . react_css_color($options['general_color_content_background_even_darker'], 'border-color') . '
		}
		#nav-single .nav-single-inner div.first-child,
		#nav-single .nav-single-inner div.last-child,
		.search-results #content div.post.entry,
		.search-results #content div.page.entry,
		.search-results #content div.product.entry,
		.search-results #content div.portfolio.entry,
		.archive #content div.post.entry,
		.blog #content div.post.entry,

		div.comment,
		.nocomments,
		.comment-reply-wrap,
		.right-sidebar #sidebar,
		.left-sidebar #sidebar,
		.tcp-portfolio-details,
		.tcp-portfolio-item-title,
		.tcs-section-break.tcs-line,
		.vc_separator.react .vc_sep_holder .vc_sep_line,
		.tcs-section-break.tcs-line-lrg,
		.tcs-image.tcs-style1 img,
		.tcs-image.tcs-style2 img {
			' . react_css_color($options['general_color_content_background_even_darker'], 'border-color') . '
		}
		.sdbr-line #content:before {
			' . react_css_color($options['general_color_content_background_even_darker'], 'border-color') . '
		}

		.wgt-undrln .widget h3.widget-title:after,
		.archive .entry-content:after,
		.author .entry-content:after,
		.blog .entry-content:after,
		.search .entry-content:after {
			' . react_css_color($options['general_color_content_background_much_darker'], 'border-color') . '
			' . react_css_color($options['general_color_content_background']) . '
		}
		.tcs-animated-number-label:before,
		.tcs-section-break:after,
		.tcs-section-break:before,
		.tcs-fancy-header.tcs-style1:after,
		.tcs-fancy-header.tcs-style1:before,
		.archive .entry-content:before,
		.search .entry-content:before,
		.blog .entry-content:before {
			' . react_css_color($options['general_color_content_background']) . '
			' . react_css_color($options['general_color_content_background_much_darker'], 'border-color') . '
		}
		.owl-theme .owl-dots .owl-dot span {
			' . react_css_color($options['general_color_content_background_much_darker']) . '
		}
		.tcs-section-break.tcs-line-lrg:after,
		.tcs-section-break.tcs-line-lrg:before,
		.tcs-fancy-header.tcs-text-line .tcs-fancy-header-text:before {
			' . react_css_color($options['general_color_content_background_much_darker']) . '
		}

		ul.vert-nav-ul > li > a,
		.widget_nav_menu ul.menu li a,
		.widget_pages ul li a,
		.widget_product_categories ul li a,
		.widget_recent_entries ul > li,
		.widget_meta ul > li,
		.widget_archive ul > li,
		.widget_categories ul > li,
		ul.blogroll > li > a,
		ul.menu > li a,
		ul.menu li ul li a,
		ul#recentcomments li,
		.tcs-fancy-header.tcs-style1,
		.tcs-impact-header.tcs-light,
		#nav-single .nav-next a, #nav-single .nav-previous a,
		.tcs-pullquote,
		.tcs-fancy-table table,
		.tcs-fancy-table table th,
		.tcs-fancy-table table td,
		table,
		table th,
		table td,
		.comments ul.children div.comment,
		#comments,
		.tcs-menu.tcs-menu-separator.tcs-inline ul li a,
		.tcs-menu.tcs-menu-separator.tcs-stacked ul li a,
		.tcw-contact-details,
		.tcw-opening-times,
		.tcs-opening-times,
		.tcw-tweet-list li,
		.widget_rss ul li,
		.breadcrumbs .back-home-icon,
		.tcw-widget-post,
		ul.socialcount,
		.sdbr-line #sidebar,
		.units-row > div,
		.tcs-units-row > div,
		.vc_separator.react .vc_sep_holder .vc_sep_line,
		.featured-image-wrap,
		.tcp-featured-image-wrap {
			' . react_css_color($options['general_color_content_background_even_darker'], 'border-color') . '
		}
		.breadcrumbs a:after,
		.breadcrumbs .breadcrumbs-inner > span a:after,
		.widget_breadcrumb_navxt a:after {
			' . react_css_color($options['general_color_content_background_even_darker'], 'color') . '
		}
		#wp-calendar tbody .pad,
		#wp-calendar tbody td,
		 #comments .comment-respond,
		.iphorm-theme-react-default .ifb-captcha-image-inner {
			' . react_css_color($options['general_color_content_background_even_lighter']) . '
		}

		.wp-pagenavi span.current,
		.tcp-portfolio .wp-pagenavi span.current,
		.wp-pagenavi a,
		.tcp-portfolio .wp-pagenavi a,
		.comments-pagination-wrap a, .comments-pagination-wrap span.page-numbers.current {
			' . react_css_color($options['general_color_content_background_darker'], 'border-color', '!important') . '
			' . react_css_color($options['general_color_content_text'], 'color') . '
		}
		.wp-pagenavi a:hover,
		.tcp-portfolio .wp-pagenavi a:hover,
		.comments-pagination-wrap a:hover {
			' . react_css_color($options['general_color_content_background_lighter'], 'background-color', '!important') . '
		}
		.wp-pagenavi span.current,
		.tcp-portfolio .wp-pagenavi span.current,
		.comments-pagination-wrap span.page-numbers.current {
			' . react_css_color($options['general_color_global_primary_bg_darker'], 'border-color', '!important') . '
			' . react_css_color($options['general_color_global_primary_bg']) . '
			' . react_css_color($options['general_color_global_primary_fg'], 'color') . '
		}


		';
		if ($options['fancybox_choose_scheme'] === '') {
			echo '
				.fancybox-outer .iphorm-theme-react-default .iphorm-elements > .iphorm-element-wrap > .iphorm-element-spacer > label,
				.fancybox-outer .iphorm-theme-react-default .iphorm-elements > .iphorm-group-style-plain > .iphorm-group-elements > .iphorm-group-row > .iphorm-element-wrap > .iphorm-element-spacer > label,
			';
		}
		echo'
		#wp-calendar thead th,
		#wp-calendar #today,
		.tcs-fancy-table table th, table th, .commentlist > .comment > ul.children,
		.comments ul.children li,
		.iphorm-theme-react-default .iphorm-elements > .iphorm-element-wrap > .iphorm-element-spacer > label,
		.iphorm-theme-react-default .iphorm-elements > .iphorm-group-style-plain > .iphorm-group-elements > .iphorm-group-row > .iphorm-element-wrap > .iphorm-element-spacer > label {
			' . react_css_color($options['general_color_content_background_darker']) . '
		}
		.comments-pagination-wrap a, .comments-pagination-wrap span.page-numbers, .wp-pagenavi a, .wp-pagenavi span, .tcs-fancy-table table td, table td {' . react_css_color($options['general_color_content_background_lighter']) . '}
		.commentlist > .comment > ul.children:after {' . react_css_color($options['general_color_content_background_darker'], 'border-bottom-color') . '}
		.commentlist > .comment > ul.children li div.comment, div.comment,
		body:not(.blg-bxd) #content > div.entry.sticky,
		.blg-bxd.search-results #content div.post.entry,
		.blg-bxd.search-results #content div.page.entry,
		.blg-bxd.search-results #content div.product.entry,
		.blg-bxd.search-results #content div.portfolio.entry,
		.blg-bxd.archive #content div.post.entry,
		.blg-bxd.blog #content div.post.entry,
		.sdbr-bxd #sidebar .widget,
		.pop-bxd .popdown .widget,
		.foot-bxd .footer .widget,
		.tcp-boxed .tcp-portfolio-details,
		.tcs-tabs.tcs-boxed .tcs-tab-content,
		.custom-boxed-item,
		.tcs-box.tcs-box-custom-boxed-item,
		.contact-type-wrap, .hidden-map {
			 ' . react_css_color($options['general_color_content_background_touch_darker']) . '
			 ' . react_css_color($options['general_color_content_background_even_darker'], 'border-color') . '
		';
		if ($options['general_color_content_background']) {
			echo '
				 -webkit-box-shadow: 0 0 20px rgba(0, 0, 0, 0.01) inset, 0 -3px 0 0 ' . react_sanitize_color($options['general_color_content_background_even_darker']) . ' inset;
				box-shadow: 0 0 20px rgba(0, 0, 0, 0.01) inset, 0 -3px 0 0 ' . react_sanitize_color($options['general_color_content_background_even_darker']) . ' inset;
			';
			} echo '
		}
		.sdbr-bxd.wgt-undrln #sidebar .widget h3.widget-title,
		.sdbr-bxd #sidebar #commentform input[type="text"],
		.sdbr-bxd #sidebar #commentform select,
		.sdbr-bxd #sidebar .searchform input[type="text"],
		.sdbr-bxd #sidebar .widget_archive select,
		.sdbr-bxd #sidebar .widget_categories select,
		.sdbr-bxd #sidebar .textwidget select,
		.sdbr-bxd #sidebar .textwidget input,
		.sdbr-bxd #sidebar .woocommerce.widget_product_search input[type="search"] {
			' . react_css_color($options['general_color_content_background_even_darker'], 'border-color') . '
		}
		.sdbr-bxd.wgt-undrln #sidebar .widget h3.widget-title {
			' . react_css_color($options['general_color_content_background_even_darker'], 'border-color') . '
			' . react_css_color($options['general_color_content_background_even_lighter']) . '
		}
		.tcw-contact-details,
		#wp-calendar #today,
		.tcw-opening-times,
		.tcs-opening-times,
		#wp-calendar caption,
		.tcs-pullquote p,
		.tcp-portfolio-item-title .react-vote .count {
			' . react_css_color($options['general_color_content_text'], 'color') . '
		}

		body .after-header-wrap #content > div.entry.sticky {
			' . react_css_color($options['general_color_global_primary_bg'], 'border-bottom-color') . '
		}

		';
		if ($options['fancybox_choose_scheme'] === '') {
			echo '
				.fancybox-outer .iphorm-theme-react-default p.iphorm-description,
			';
		}
		echo'

		h3.comments-title i, h3.socialcount-title i, .author_bio_section h3 > i,
		.breadcrumbs,
		.entry-meta,
		.tcw-opening-times .tcw-open-time,
		.tcs-opening-times .tcs-open-time,
		.tcw-contact-details .tcw-contact-detail,
		.tcw-widget-post-info .tcw-widget-post-date,
		.widget_recent_entries .post-date,
		.tcs-pullquote,
		#wp-calendar td,
		table caption,
		.tcs-fancy-table table td,
		 table td,
		.iphorm-theme-react-default p.iphorm-description,
		.wp-pagenavi span.pages,
		.tcp-portfolio .wp-pagenavi span.pages,
		.wp-pagenavi span.extend,
		.tcp-portfolio .wp-pagenavi span.extend,
		.comments-pagination-wrap .page-numbers.dots,
		.tcp-portfolio-item-title .tcp-portfolio-title-inner > a,
		.tcp-portfolio-item-title .post-like a .like,
		a.subtle-link,
		a.tcp-subtle-link,
		.tcs-accordion.tcs-plain > h3 > a,
		.comment-reply-wrap > h3 > a,
		span.subtle-link,
		.tcs-blockquote .tcs-qmark,
		.text-alt,
		.widget_rss .rssSummary,
		.tcs-pullquote .tcs-qmark,
		span.tcs-icon.tcs-icon-hollow > i,
		.tcp-portfolio-items .tcp-entry-meta {
			' . react_css_color($options['general_color_content_text_alt'], 'color') . '
		}
		#wp-calendar thead th,
		#wp-calendar tbody td,
		#wp-calendar th,
		#wp-calendar td,
		ul.menu li ul li ul a,
		.widget_nav_menu ul.menu > li ul li ul,
		.tcs-fancy-table table th,
		table th,
		#comments .comment-respond,
		.breadcrumbs,
		.single .entry-meta,
		#nav-single,
		.comments-pagination-wrap,
		.content-nav,
		.page-link,
		.wp-pagenavi,
		.tcp-portfolio .wp-pagenavi,
		.comment-content,
		.iphorm-theme-react-default .iphorm-group-style-plain > .iphorm-group-elements .iphorm-group-title-description-wrap {
			' . react_css_color($options['general_color_content_background_even_darker'], 'border-color') . '
		}
		.wgt-undrln .widget h3.widget-title, .tcp-portfolio-items .tcp-entry-meta,
		.ls-reactskin .ls-bottom-nav-wrapper {
			' . react_css_color($options['general_color_content_background_even_darker'], 'border-color') . '
		}
		div.post.entry h2.entry-title {
			' . react_css_color($options['general_color_content_background_even_darker'], 'border-bottom-color') . '
		}
		.tcp-portfolio-item-title .tcp-portfolio-title-inner > a:hover, .tcp-portfolio-item-title .post-like a:hover .like {
			' . react_css_color($options['general_color_links_hover'], 'color') . '
		}
	';

}
?>


<?php /* BACKGROUND colors */ ?>

<?php /* CONTENT AREA - COLORS CUSTOM PALETTES */ ?>
<?php if ($palette = react_get_palette_by_id($options['general_color_content_choose_scheme'] )) : ?>
	<?php /* BACKGROUND colors */ ?>
	<?php if ($palette['background'] || $palette['border'] || $palette['text']) {

		if ($options['fancybox_choose_scheme'] === '') {
			echo '
				.fancybox-skin,
			';
		}
		echo '
		.content-outer {
			' . react_css_color($palette['background']) . '
			' . react_css_color($palette['border'], 'border-color') . '
			' . react_css_color($palette['text'], 'color') . '
		}
		';
		if ($options['fancybox_choose_scheme'] === '') {
			echo '
				.fancybox-skin .tcs-button.tcs-holw-btn > a, .fancybox-skin .tcs-button.tcs-holw-btn > span.tcs-r-button,
				.fancybox-skin .tcs-button.tcs-holw-btn > a > i, .fancybox-skin .tcs-button.tcs-holw-btn > span.tcs-r-button > i,
			';
		}
		echo '
		.content-outer ul#recentcomments li:before,
		.content-outer ul li.cat-item a:before,
		.content-outer .widget_archive ul li a:before,
		.content-outer .widget_pages ul li a:before {
			' . react_css_color($palette['text'], 'color') . '
		}
		.content-outer .tcs-button.tcs-holw-btn > a, .content-outer .tcs-button.tcs-holw-btn > span.tcs-r-button,
		.content-outer .tcs-button.tcs-holw-btn > a > i, .content-outer .tcs-button.tcs-holw-btn > span.tcs-r-button > i {
			' . react_css_color($palette['text'], 'color') . '
		}
	';} ?>



	<?php if ($palette['background_gradient']) { echo '
		.content-outer {
			';
			if ($palette['gradient_background_color']) {
				if ($palette['gradient_orientation'] =='vertical') {
				echo '
					background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['background_lighter']) . ' 0%, ' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['background_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['gradient_background_color']) . '));
					background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -o-linear-gradient(top, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: linear-gradient(to bottom, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
				';
				} if (react_sanitize_color($palette['gradient_orientation']) =='horizontal') {
					echo '
					background: -moz-linear-gradient(left, ' . react_sanitize_color($palette['background_lighter']) . ' 0%, ' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -webkit-gradient(linear, left top, right top, color-stop(0%,' . react_sanitize_color($palette['background_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['gradient_background_color']) . '));
					background: -webkit-linear-gradient(left, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -o-linear-gradient(left, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -ms-linear-gradient(left, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: linear-gradient(to right, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					';
				} if (react_sanitize_color($palette['gradient_orientation']) =='diagonal-down') {
					echo '
					background: -moz-linear-gradient(-45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%, ' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,' . react_sanitize_color($palette['background_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['gradient_background_color']) . '));
					background: -webkit-linear-gradient(-45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -o-linear-gradient(-45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -ms-linear-gradient(-45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: linear-gradient( 135deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					';
				} if (react_sanitize_color($palette['gradient_orientation']) =='diagonal-up') {
					echo '
					background: -moz-linear-gradient(45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%, ' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,' . react_sanitize_color($palette['background_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['gradient_background_color']) . '));
					background: -webkit-linear-gradient(45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -o-linear-gradient(45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -ms-linear-gradient(45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: linear-gradient( 45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					';
				}
			} else {
				echo '
					background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['background_lighter']) . ' 0%, ' . react_sanitize_color($palette['background_touch_darker']) . ' 100%);
					background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['background_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['background_touch_darker']) . '));
					background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['background_touch_darker']) . ' 100%);
					background: -o-linear-gradient(top, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['background_touch_darker']) . ' 100%);
					background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['background_touch_darker']) . ' 100%);
					background: linear-gradient(to bottom, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['background_touch_darker']) . ' 100%);
				';
			}

		}
	?>













	<?php if ($palette['border']) echo '
	body.pge-bxd .after-header-wrap .content-outer, body.pge-mxd .after-header-wrap .content-outer {
	   ' . react_css_color($palette['border'], 'border-color') . '
	}'; ?>
	<?php
	if ($palette['border_lr'])
		echo '
		body.pge-bxd .after-header-wrap .content-outer, body.pge-mxd .after-header-wrap .content-outer, .content-outer {
			' . react_css_color($palette['border_lr'], 'border-left-color') . '
			' . react_css_color($palette['border_lr'], 'border-right-color') . '
		}';
	?>
	<?php
	if ($options['footer_widget_area_layout'] === '') {
		echo '
		.content-outer { ';
			if ($palette['border']) { echo '' . react_css_color($palette['border'], 'border-bottom-color') . ''; }
		echo '
			margin-bottom: -1px;
		}';
	} ?>
	<?php if ($palette['text_alt'])
	if ($options['fancybox_choose_scheme'] === '') {
		echo '
			.fancybox-outer .iphorm-theme-react-default p.iphorm-description,
		';
	}
	echo '
	.content-outer .widget_nav_menu ul.menu li ul a,
	.content-outer .widget_pages ul.children li a,
	.content-outer .widget_product_categories  ul.children li a,
	.content-outer .widget_recent_entries ul.children li a,
	.content-outer .widget_meta ul.children li a,
	.content-outer .widget_archive ul.children li a,
	.content-outer .widget_categories ul.children li a,
	.content-outer ul.blogroll ul.children a,
	.content-outer .widget_nav_menu ul.menu ul.children a,
	.content-outer h3.comments-title i,
	.content-outer h3.socialcount-title i,
	.content-outer .author_bio_section h3 > i,
	.content-outer .breadcrumbs,
	.content-outer .entry-meta,
	.content-outer .tcw-opening-times .tcw-open-time,
	.content-outer .tcs-opening-times .tcs-open-time,
	.content-outer .tcw-contact-details .tcw-contact-detail,
	.content-outer .tcw-widget-post-info .tcw-widget-post-date,
	.content-outer .widget_recent_entries .post-date,
	.content-outer .tcs-pullquote,
	.content-outer #wp-calendar td,
	.content-outer table caption,
	.content-outer .tcs-fancy-table table td,
	.content-outer table td,
	.content-outer .iphorm-theme-react-default p.iphorm-description,
	.content-outer .wp-pagenavi span.pages,
	.content-outer .tcp-portfolio .wp-pagenavi span.pages,
	.content-outer .wp-pagenavi span.extend,
	.content-outer .tcp-portfolio .wp-pagenavi span.extend,
	.content-outer .comments-pagination-wrap .page-numbers.dots,
	.content-outer .tcp-portfolio-item-title .tcp-portfolio-title-inner > a,
	.content-outer .tcp-portfolio-item-title .post-like a .like,
	.content-outer a.subtle-link,
	.content-outer a.tcp-subtle-link,
	.content-outer .tcs-accordion.tcs-plain > h3 > a,
	.content-outer .comment-reply-wrap > h3 > a,
	.content-outer span.subtle-link,
	.content-outer blockquote,
	.content-outer .tcs-blockquote .tcs-qmark,
	.content-outer .text-alt,
	.content-outer .widget_rss .rssSummary,
	.content-outer .tcs-pullquote .tcs-qmark,
	.content-outer span.tcs-icon.tcs-icon-hollow > i,
	.content-outer .tcp-portfolio-items .tcp-entry-meta {
		' . react_css_color($palette['text_alt'], 'color') . '
	}'; ?>
	<?php if ($palette['h1']) echo '.content-outer h1, .content-outer .tcs-impact-heading {' . react_css_color($palette['h1'], 'color') . ' }'; ?>
	<?php if ($palette['h2']) echo '.content-outer h2, .content-outer h2.entry-title a {' . react_css_color($palette['h2'], 'color') . ' }'; ?>
	<?php if ($palette['h3']) echo '.content-outer h3 {' . react_css_color($palette['h3'], 'color') . ' }'; ?>
	<?php if ($palette['h4']) echo '.content-outer h4 {' . react_css_color($palette['h4'], 'color') . ' }'; ?>
	<?php if ($palette['h5']) echo '.content-outer h5, .content-outer h6 {' . react_css_color($palette['h5'], 'color') . ' }'; ?>
	<?php if ($palette['link']) echo '.content-outer a, .content-outer ul.menu li ul a {' . react_css_color($palette['link'], 'color') . ' }'; ?>
	<?php if ($palette['link_hover']) echo '
	.content-outer .widget_nav_menu ul.menu li ul a:hover,
	.content-outer .widget_pages ul.children li a:hover,
	.content-outer .widget_product_categories  ul.children li a:hover,
	.content-outer .widget_recent_entries ul.children li a:hover,
	.content-outer .widget_meta ul.children li a:hover,
	.content-outer .widget_archive ul.children li a:hover,
	.content-outer .widget_categories ul.children li a:hover,
	.content-outer ul.blogroll ul.children a:hover,
	.content-outer .widget_nav_menu ul.menu ul.children a:hover,
	.content-outer a:hover,
	.content-outer a:active,
	.content-outer ul.menu li ul a:hover,
	.content-outer a.subtle-link:hover,
	.content-outer a.tcp-subtle-link:hover,
	.content-outer .tcs-accordion.tcs-plain > h3 > a:hover,
	.content-outer .comment-reply-wrap > h3 > a,
	.content-outer span.subtle-link:hover,
	.content-outer .tcp-portfolio-item-title .tcp-portfolio-title-inner > a:hover,
	.content-outer .tcp-portfolio-item-title .post-like a:hover .like,
	.content-outer .entry-title a:hover {
		' . react_css_color($palette['link_hover'], 'color') . '
	}'; ?>
	<?php if ($palette['background_darker']) echo '
	.content-outer #nav-single .nav-single-inner div:first-child,
	.content-outer #nav-single .nav-single-inner div:last-child	{
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}
	.content-outer #nav-single .nav-single-inner div.first-child,
	.content-outer #nav-single .nav-single-inner div.last-child,
	.right-sidebar.sdbr-line .content-outer #sidebar,
	.left-sidebar.sdbr-line .content-outer #sidebar,
	.search-results #content div.post.entry,
	.search-results #content div.page.entry,
	.search-results #content div.product.entry,
	.search-results #content div.portfolio.entry,
	.archive #content div.post.entry,
	.blog #content div.post.entry,

	.content-outer #comments,
	.content-outer div.comment,
	.content-outer .nocomments,
	.content-outer .comment-reply-wrap,
	.content-outer .tcp-portfolio-details,
	.content-outer .tcp-portfolio-item-title,
	.content-outer .tcs-section-break.tcs-line,
	.content-outer .vc_separator.react .vc_sep_holder .vc_sep_line,
	.content-outer .tcs-section-break.tcs-line-lrg,
	.content-outer .tcs-image.tcs-style1 img,
	.content-outer .tcs-image.tcs-style2 img {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}

	.right-sidebar.sdbr-line .content-outer #content:before,
	.left-sidebar.sdbr-line .content-outer #content:before {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}
	.content-outer .tcs-section-break:after,
	.content-outer .tcs-section-break:before,
	.content-outer .tcs-animated-number-label:before,
	.content-outer .tcs-fancy-header.tcs-text-line .tcs-fancy-header-text:before,
	.content-outer .tcs-fancy-header.tcs-style1:after,
	.content-outer .tcs-fancy-header.tcs-style1:before,
	.archive .content-outer .entry-content:before,
	.search .content-outer .entry-content:before,
	.blog .content-outer .entry-content:before {
		' . react_css_color($palette['background']) . '
		' . react_css_color($palette['background_much_darker'], 'border-color') . '
	}

	.content-outer .owl-theme .owl-dots .owl-dot span,
	.content-outer .tcs-section-break.tcs-line-lrg:after,
	.content-outer .tcs-section-break.tcs-line-lrg:before,
	.content-outer .tcs-fancy-header.tcs-text-line .tcs-fancy-header-text:before {
		' . react_css_color($palette['background_much_darker']) . '
	}
	.content-outer ul.vert-nav-ul > li,
	.content-outer .widget_nav_menu ul.menu li a,
	.content-outer .widget_pages ul li a,
	.content-outer .widget_product_categories ul li a,
	.content-outer .widget_recent_entries ul > li,
	.content-outer .widget_meta ul > li,
	.content-outer .widget_archive ul > li,
	.content-outer .widget_categories ul > li,
	.content-outer ul.blogroll > li,
	.content-outer ul.menu li a,
	.content-outer ul.menu li ul li a,
	.content-outer ul#recentcomments li,
	.content-outer .tcs-fancy-header.tcs-style1,
	.content-outer .tcs-impact-header.tcs-light,
	.content-outer #nav-single .nav-next a,
	.content-outer #nav-single .nav-previous a,
	.content-outer .tcs-pullquote,
	.content-outer .tcs-fancy-table table,
	.content-outer .tcs-fancy-table table th,
	.content-outer .tcs-fancy-table table td,
	.content-outer table,
	.content-outer table th,
	.content-outer table td,
	.content-outer .comments ul.children div.comment,
	.content-outer .tcs-menu.tcs-menu-separator.tcs-inline ul li a,
	.content-outer .tcs-menu.tcs-menu-separator.tcs-stacked ul li a,
	.content-outer .tcw-contact-details,
	.content-outer .tcw-opening-times,
	.content-outer .tcs-opening-times,
	.content-outer .tcw-tweet-list li,
	.content-outer .widget_rss ul li,
	.content-outer .breadcrumbs .back-home-icon,
	.content-outer .tcw-widget-post,
	.content-outer ul.socialcount,
	.sdbr-line .content-outer #sidebar,
	.content-outer .units-row > div,
	.content-outer .tcs-units-row > div,
	.content-outer .featured-image-wrap,
	.content-outer .tcp-featured-image-wrap {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}
	.content-outer .breadcrumbs a:after,
	.content-outer .breadcrumbs .breadcrumbs-inner > span a:after,
	.content-outer .widget_breadcrumb_navxt a:after {
		' . react_css_color($palette['background_even_darker'], 'color') . '
	}
	'; ?>
	<?php if ($palette['background_lighter']) echo '
	.content-outer #wp-calendar tbody .pad,
	.content-outer #wp-calendar tbody td,
	.content-outer #comments .comment-respond,
	.content-outer .iphorm-theme-react-default .ifb-captcha-image-inner {
		' . react_css_color($palette['background_even_lighter']) . '
	}'; ?>
	<?php if ($palette['background_much_darker']) echo '
		.content-outer #wp-calendar tbody tr:first-child .pad {
			-webkit-box-shadow: 0 2px 0 0px ' . react_sanitize_color($palette['background_much_darker']) . ' inset;
			box-shadow: 0 2px 0 0px ' . react_sanitize_color($palette['background_much_darker']) . ' inset;
		}';
	?>
	<?php if ($palette['background_much_darker']) {
		if ($rtl) {
			echo '
			.content-outer #wp-calendar tbody tr:last-child .pad {
				-webkit-box-shadow: -1px 2px 0 0px ' . react_sanitize_color($palette['background_even_darker']) . ' inset;
				box-shadow:  -1px 2px 0 0px ' . react_sanitize_color($palette['background_even_darker']) . ' inset;
			}';
		} else {
			echo '
			.content-outer #wp-calendar tbody tr:last-child .pad {
				-webkit-box-shadow: 1px 2px 0 0px ' . react_sanitize_color($palette['background_even_darker']) . ' inset;
				box-shadow:  1px 2px 0 0px ' . react_sanitize_color($palette['background_even_darker']) . ' inset;
			}';
		}
	}
	 ?>
	<?php if ($palette['background_darker'] || $palette['text']) { echo '
	.content-outer .wp-pagenavi span.current,
	.content-outer .tcp-portfolio .wp-pagenavi span.current,
	.content-outer .wp-pagenavi a,
	.content-outer .tcp-portfolio .wp-pagenavi a,
	.comments-pagination-wrap a, .comments-pagination-wrap span.page-numbers.current {
		' . react_css_color($palette['background_darker'], 'border-color', '!important') . '
		' . react_css_color($palette['text'], 'color') . '
	}'; } ?>
	<?php if ($palette['background_lighter']) echo '
	.content-outer .wp-pagenavi a:hover,
	.content-outer .tcp-portfolio .wp-pagenavi a:hover,
	.comments-pagination-wrap a:hover {
		' . react_css_color($palette['background_lighter'], 'background-color', '!important') . '
	}'; ?>
	<?php if ($palette['primary_bg_darker'] || $palette['primary_bg'] || $palette['primary_fg']) { echo '
	.content-outer .wp-pagenavi span.current,
	.content-outer .tcp-portfolio .wp-pagenavi span.current,
	.comments-pagination-wrap span.page-numbers.current {
		' . react_css_color($palette['primary_bg_darker'], 'border-color', '!important') . '
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; } ?>
	<?php if ($palette['primary_fg']) echo '
	.content-outer .tcs-impact-header.tcs-color .tcs-impact-heading, .content-outer .tcs-impact-header.tcs-color .tcs-impact-subheading,
	.content-outer .wpb_content_element.react .wpb_tabs_nav li.ui-tabs-active a,
	.content-outer .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details,
	.content-outer .tcp-portfolio.tcp-boxed .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details,
	.content-outer .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-portfolio-item-title,
	.content-outer .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-portfolio-item-title a,
	.content-outer .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-portfolio-item-title a:hover,
	.content-outer .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-entry-meta,
	.content-outer .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-entry-meta a,
	.content-outer .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-entry-meta a:hover {
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; ?>
	<?php if ($palette['primary_bg']) echo '
	.content-outer .comments ul.children li.comment.bypostauthor div.comment,
	.content-outer .comments li.comment.bypostauthor div.comment,
	.content-outer .tcs-section-break.tcs-line-prime,
	.content-outer .tcs-section-break.tcs-line-lrg-prime,
	.content-outer a.subtle-link,
	.content-outer a.tcp-subtle-link,
	.content-outer .tcs-accordion.tcs-plain > h3 > a,
	.content-outer span.subtle-link,
	.content-outer .tcs-box.tcs-box-basic-light > a:hover,
	.content-outer .tcs-box.tcs-box-basic-dark a:hover,
	.content-outer .tcw-tweet-light li a:hover,
	.content-outer .tcw-tweet-dark li a:hover {' . react_css_color($palette['primary_bg'], 'border-bottom-color') . '}
	.content-outer .tcs-accordion.tcs-plain > h3 > a:after,
	.content-outer a.subtle-link:after, .content-outer a.tcp-subtle-link:after, .content-outer span.subtle-link:after,
	.content-outer .tcs-section-break.tcs-line-lrg-prime:before,
	.content-outer .tcs-section-break.tcs-line-lrg-prime:after {' . react_css_color($palette['primary_bg_much_darker']) . '}

	.content-outer .tcs-section-break.tcs-line-prime:before,
	.content-outer .tcs-section-break.tcs-line-prime:after {
		' . react_css_color($palette['background']) . '
		' . react_css_color($palette['primary_bg'], 'border-color') . '
	}
	.content-outer .tcs-section-break.tcs-line-lrg-prime.tcs-double, .content-outer code, .content-outer pre, .content-outer kbd, .content-outer tt {' . react_css_color($palette['primary_bg'], 'border-color') . '}
	 '; ?>
	<?php if ($palette['background_darker'])
	if ($options['fancybox_choose_scheme'] === '') {
		echo '
			.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap .iphorm-element-spacer > label,
			.fancybox-outer .iphorm-theme-react-default .iphorm-elements > .iphorm-group-style-plain > .iphorm-group-elements > .iphorm-group-row > .iphorm-element-wrap > .iphorm-element-spacer > label,
		';
	}
	echo '
	.content-outer #wp-calendar thead th,
	.content-outer #wp-calendar #today,
	.content-outer .tcs-fancy-table table th,
	.content-outer table th,
	.content-outer .commentlist > .comment > ul.children,
	.content-outer .comments ul.children li,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap .iphorm-element-spacer > label,
	.content-outer .iphorm-theme-react-default .iphorm-elements > .iphorm-group-style-plain > .iphorm-group-elements > .iphorm-group-row > .iphorm-element-wrap > .iphorm-element-spacer > label {
		' . react_css_color($palette['background_darker']) . '
	}'; ?>
	<?php if ($palette['background_lighter']) echo '.content-outer .comments-pagination-wrap a, .content-outer .comments-pagination-wrap span.page-numbers, .content-outer .wp-pagenavi a, .content-outer .wp-pagenavi span, .content-outer .tcs-fancy-table table td, .content-outer table td {' . react_css_color($palette['background_lighter']) . '}'; ?>
	<?php if ($palette['background_darker']) echo '.content-outer .commentlist > .comment > ul.children:after { ' . react_css_color($palette['background_darker'], 'border-bottom-color') . '}'; ?>
	<?php if ($palette['background_lighter'] || $palette['background_much_darker']) { echo '
	.content-outer .commentlist > .comment > ul.children li div.comment,
	.content-outer div.comment,
	body:not(.blg-bxd) #content > div.entry.sticky,
	.blg-bxd.search-results #content div.post.entry,
	.blg-bxd.search-results #content div.page.entry,
	.blg-bxd.search-results #content div.product.entry,
	.blg-bxd.search-results #content div.portfolio.entry,
	.blg-bxd.archive #content div.post.entry,
	.blg-bxd.blog #content div.post.entry,
	.content-outer .tcp-boxed .tcp-portfolio-details,
	.content-outer .custom-boxed-item,
	.content-outer .tcs-box.tcs-box-custom-boxed-item,
	.content-outer .tcs-tabs.tcs-boxed .tcs-tab-content,
	.content-outer .contact-type-wrap, .content-outer .hidden-map,
	.sdbr-bxd #sidebar .widget {
		 ' . react_css_color($palette['background_touch_darker']) . '
		 ' . react_css_color($palette['background_even_darker'], 'border-color') . '
		  -webkit-box-shadow: 0 0 20px rgba(0, 0, 0, 0.01) inset, 0 -3px 0 0 ' . react_sanitize_color($palette['background_even_darker']) . ' inset;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.01) inset, 0 -3px 0 0 ' . react_sanitize_color($palette['background_even_darker']) . ' inset;
	 }
	.sdbr-bxd #sidebar #commentform input[type="text"],
	.sdbr-bxd #sidebar #commentform select,
	.sdbr-bxd #sidebar .searchform input[type="text"],
	.sdbr-bxd #sidebar .widget_archive select,
	.sdbr-bxd #sidebar .widget_categories select,
	.sdbr-bxd #sidebar .textwidget select,
	.sdbr-bxd #sidebar .textwidget input,
	.sdbr-bxd #sidebar .woocommerce.widget_product_search input[type="search"] {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}
	.sdbr-bxd.wgt-undrln #sidebar .widget h3.widget-title {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
		' . react_css_color($palette['background_even_lighter']) . '
	}
	'; } ?>


	<?php if ($palette['primary_bg']) echo '
	body .after-header-wrap .content-outer #content > div.entry.sticky {
		' . react_css_color($palette['primary_bg'], 'border-bottom-color') . '
	}'; ?>

	 <?php if ($palette['text']) echo '
	.content-outer .tcw-contact-details,
	.content-outer #wp-calendar #today,
	.content-outer .tcw-opening-times,
	.content-outer .tcs-opening-times,
	.content-outer #wp-calendar caption,
	.content-outer .tcs-pullquote p,
	.content-outer .tcp-portfolio-item-title .react-vote .count {
		' . react_css_color($palette['text'], 'color') . '
	}'; ?>
	<?php if ($palette['background_even_darker']) echo '
	.content-outer #wp-calendar thead th,
	.content-outer #wp-calendar tbody td,
	.content-outer #wp-calendar th,
	.content-outer #wp-calendar td,
	.content-outer ul.menu li ul li ul a,
	.content-outer .widget_nav_menu ul.menu li ul li ul,
	.content-outer .tcs-fancy-table table th,
	.content-outer table th,
	.content-outer #comments .comment-respond,
	.content-outer .breadcrumbs,
	.single .content-outer .entry-meta,
	.content-outer #nav-single,
	.content-outer .comments-pagination-wrap,
	.content-outer .content-nav,
	.content-outer .page-link,
	.content-outer .wp-pagenavi,
	.content-outer .tcp-portfolio .wp-pagenavi,
	.content-outer .comment-content,
	.content-outer .iphorm-theme-react-default .iphorm-group-style-plain > .iphorm-group-elements .iphorm-group-title-description-wrap {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}'; ?>

	<?php if ($palette['background_even_darker']) echo '
	.wgt-undrln .content-outer .widget h3.widget-title, .content-outer .tcp-portfolio-items .tcp-entry-meta,
	.content-outer .ls-reactskin .ls-bottom-nav-wrapper {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}
	.wgt-undrln .content-outer .widget h3.widget-title:after,
	.archive .content-outer .entry-content:after, .author .content-outer .entry-content:after, .blog .content-outer .entry-content:after, .search .content-outer .entry-content:after {
		' . react_css_color($palette['background']) . '
		' . react_css_color($palette['background_much_darker'], 'border-color') . '
	}
	div.post.entry .content-outer  h2.entry-title {
			' . react_css_color($palette['background_even_darker'], 'border-bottom-color') . '
	}'; ?>
	<?php if ($palette['background_icon_image'] == 'light') echo '
		.content-outer .widget_nav_menu ul.menu li ul li ul a,
		.content-outer .widget_nav_menu ul.menu li ul li ul a:hover,
		.content-outer .widget_nav_menu ul.menu li > a,
		.content-outer .widget_nav_menu ul.menu li > a:hover,
		.content-outer .tcs-menu.tcs-menu-separator > div > ul > li > a,
		.content-outer .tcs-menu.tcs-menu-separator > ul > li > a,
		.content-outer .tcs-menu.tcs-menu-separator > div > ul > li:hover > a,
		.content-outer .tcs-menu.tcs-menu-separator > ul > li:hover > a {
			background-image: url(../../react/images/sml-right-arrow-light.png);
		}

		.content-outer .ls-reactskin .ls-bottom-slidebuttons a:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

		.content-outer .ls-reactskin .ls-bottom-slidebuttons a .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a:hover .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover .after,

		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a .after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active .after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover .after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover .after {
			background-image: url(../../react/images/icons/sprites-16-light.png) !important;
		}
		.content-outer .react .theme-default .nivo-controlNav a,
		.content-outer .react .vc-carousel-indicators li {
			background-image: url(../../react/images/icons/sprites-16-light.png);
		}

		.content-outer .tcs-list.tcs-list-bullet li:after,
		.content-outer .tcs-list.tcs-list-tick li:after,
		.content-outer .tcs-list.tcs-list-question li:after,
		.content-outer .tcs-list.tcs-list-arrow li:after,
		.content-outer .tcs-list.tcs-list-tick-plain li:after,
		.content-outer .tcs-list.tcs-list-arrow-drawn li:after,

		.content-outer .tcs-list.tcs-list-tick-plain li .after,
		.content-outer .tcs-list.tcs-list-arrow-drawn li .after,
		.content-outer .tcs-list.tcs-list-bullet li .after,
		.content-outer .tcs-list.tcs-list-tick li .after,
		.content-outer .tcs-list.tcs-list-question li .after,
		.content-outer .tcs-list.tcs-list-arrow li .after {
			background-position: bottom left;
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			.content-outer .widget_nav_menu ul.menu li ul li ul a,
			.content-outer .widget_nav_menu ul.menu li ul li ul a:hover,
			.content-outer .widget_nav_menu ul.menu li > a,
			.content-outer .widget_nav_menu ul.menu li > a:hover,
			.content-outer .tcs-menu.tcs-menu-separator > div > ul > li > a,
			.content-outer .tcs-menu.tcs-menu-separator > ul > li > a,
			.content-outer .tcs-menu.tcs-menu-separator > div > ul > li:hover > a,
			.content-outer .tcs-menu.tcs-menu-separator > ul > li:hover > a {
				background-image: url(../../react/images/sml-right-arrow-light@2x.png);
				background-size: 6px 9px;
			}
			.content-outer .react .theme-default .nivo-controlNav a,
			.content-outer .react .vc-carousel-indicators li {
				background-image: url(../../react/images/icons/sprites-32-light.png);
				background-size: 496px 240px;
			}
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

			.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:after,
			.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
			.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after {
				background-image: url(../../react/images/icons/sprites-32-light.png) !important;
				background-size: 496px 240px;
			}

		}

	';
	elseif ($palette['background_icon_image'] == 'dark') echo '
		.content-outer .widget_nav_menu ul.menu li ul li ul a,
		.content-outer .widget_nav_menu ul.menu li ul li ul a:hover,
		.content-outer .widget_nav_menu ul.menu li > a,
		.content-outer .widget_nav_menu ul.menu li > a:hover,
		.content-outer .tcs-menu.tcs-menu-separator > div > ul > li > a,
		.content-outer .tcs-menu.tcs-menu-separator > ul > li > a,
		.content-outer .tcs-menu.tcs-menu-separator > div > ul > li:hover > a,
		.content-outer .tcs-menu.tcs-menu-separator > ul > li:hover > a {
			background-image: url(../../react/images/sml-right-arrow-dark.png);
		}

		.content-outer .ls-reactskin .ls-bottom-slidebuttons a:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

		.content-outer .ls-reactskin .ls-bottom-slidebuttons a .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a:hover .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover .after,

		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a .after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active .after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover .after,
		.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover .after {
			background-image: url(../../react/images/icons/sprites-16-dark.png) !important;
		}
		.content-outer .react .theme-default .nivo-controlNav a,
		.content-outer .react .vc-carousel-indicators li {
			background-image: url(../../react/images/icons/sprites-16-dark.png);
		}
		.content-outer .tcs-list.tcs-list-bullet li:after,
		.content-outer .tcs-list.tcs-list-tick li:after,
		.content-outer .tcs-list.tcs-list-question li:after,
		.content-outer .tcs-list.tcs-list-arrow li:after,
		.content-outer .tcs-list.tcs-list-tick-plain li:after,
		.content-outer .tcs-list.tcs-list-arrow-drawn li:after,

		.content-outer .tcs-list.tcs-list-arrow-drawn li .after,
		.content-outer .tcs-list.tcs-list-tick-plain li .after
		.content-outer .tcs-list.tcs-list-bullet li .after,
		.content-outer .tcs-list.tcs-list-tick li .after,
		.content-outer .tcs-list.tcs-list-question li .after,
		.content-outer .tcs-list.tcs-list-arrow li .after {
			background-position: top left;
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			.content-outer .widget_nav_menu ul.menu li ul li ul a,
			.content-outer .widget_nav_menu ul.menu li ul li ul a:hover,
			.content-outer .widget_nav_menu ul.menu li > a,
			.content-outer .widget_nav_menu ul.menu li > a:hover,
			.content-outer .tcs-menu.tcs-menu-separator > div > ul > li > a,
			.content-outer .tcs-menu.tcs-menu-separator > ul > li > a,
			.content-outer .tcs-menu.tcs-menu-separator > div > ul > li:hover > a,
			.content-outer .tcs-menu.tcs-menu-separator > ul > li:hover > a {
				background-image: url(../../react/images/sml-right-arrow-dark@2x.png);
				background-size: 6px 9px;
			}
			.content-outer .react .theme-default .nivo-controlNav a,
			.content-outer .react .vc-carousel-indicators li {
				background-image: url(../../react/images/icons/sprites-32-light.png);
				background-size: 496px 240px;
			}
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

			.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:after,
			.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
			.content-outer .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after {
				background-image: url(../../react/images/icons/sprites-32-dark.png) !important;
				background-size: 496px 240px;
			}

		}
	'; ?>
	 <?php /* LIGHT colors */ ?>
	 <?php if ($palette['light_bg']) echo '
	.content-outer span.tcs-icon.tcs-style-light {
		' . react_css_color($palette['light_bg'], 'color') . '
	}'; ?>
	<?php if ($palette['light_bg'] || $palette['light_bg_darker'] || $palette['light_fg']) { echo '
	.content-outer .tcs-box.tcs-box-basic-light, .content-outer .tcw-tweet-light li, .content-outer .react.vc_call_to_action.light, .content-outer .react.vc_call_to_action {
		' . react_css_color($palette['light_bg'], 'background') . '
		' . react_css_color($palette['light_fg'], 'color') . '
		' . react_css_color($palette['light_bg_darker'], 'border-color') . '
		-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.3), inset 0px 0px 60px 0px rgba(0, 0, 0, 0.02), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
		 box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.3), inset 0px 0px 60px 0px rgba(0, 0, 0, 0.02), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
	}'; } ?>
	<?php if ($palette['light_bg'] || $palette['light_fg']) { echo '
	.content-outer .tcs-button.tcs-hollow-light > a,
	.content-outer .tcs-button.tcs-hollow-light > span.tcs-r-button,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-light {
		' . react_css_color($palette['light_bg'], 'border-color') . '
		background-color: transparent;
	}

	';
	if ($options['fancybox_choose_scheme'] === '') {
		echo '
			.fancybox-outer .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
			.fancybox-outer .iphorm-theme-react-default .iphorm-upload-queue-file,
			.fancybox-outer .iphorm-theme-react-default .iphom-upload-progress-wrap,
		';
	}
	echo '
	.content-outer .tcs-progress-bar-outer,
	.content-outer .tcs-button.tcs-hollow-light > a.tcs-has-back-animation:before,
	.content-outer .tcs-button.tcs-hollow-light > span.tcs-r-button.tcs-has-back-animation:before,
	.content-outer .tcs-button.tcs-hollow-light > a.tcs-has-back-animation:hover:before,
	.content-outer .tcs-button.tcs-hollow-light > span.tcs-r-button.tcs-has-back-animation:hover:before,
	.content-outer .tagcloud > a,
	.content-outer .tcp-portfolio-filter .tcp-filter-button,
	.content-outer .tcs-menu.tcs-menu-button-style-two ul li a,
	.content-outer .tcs-button.tcs-style-light > a,
	.content-outer .tcs-button.tcs-style-light > span.tcs-r-button,
	.content-outer .tcs-image-hover.tcs-hover-light,
	.content-outer .tcs-button.tcs-hollow-light > a:hover,
	.content-outer .tcs-button.tcs-hollow-light > span.tcs-r-button:hover,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-light:hover,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-light:before,
	.content-outer  span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-light:hover:before,
	.content-outer .tcs-tabs ul.tcs-tabs-nav li a,
	.content-outer ul#comment-tabs-nav li a,
	.content-outer .tcs-accordion.tcs-box > h3,
	.content-outer .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
	.content-outer .iphorm-theme-react-default .iphorm-upload-queue-file,
	.content-outer .iphorm-theme-react-default .iphom-upload-progress-wrap,
	.content-outer code,
	.content-outer pre,
	.content-outer kbd,
	.content-outer tt,
	.content-outer .tcs-impact-header.tcs-light,
	.content-outer blockquote,
	.content-outer .tcs-blockquote .tcs-blockquote-inner,
	.content-outer .tcs-fancy-header.tcs-style3,
	.search .content-outer .searchform label,
	.content-outer .woocommerce.widget_product_search label,
	.content-outer span.tcs-icon.tcs-boxed.tcs-style-light,
	.content-outer .wpb_content_element.react.light .wpb_tabs_nav li.ui-tabs-active,
	.content-outer .wpb_content_element.react .wpb_accordion_wrapper .wpb_accordion_header,
	.content-outer .vc_progress_bar.react .vc_single_bar,
	.content-outer .wpb_content_element.wpb_tabs.react.light .wpb_tour_tabs_wrapper .wpb_tab {
		' . react_css_color($palette['light_bg'], 'background') . '
		' . react_css_color($palette['light_fg'], 'color') . '
	}'; } ?>
	<?php if ($palette['light_bg']) echo '
	.content-outer .tcs-blockquote .tcs-blockquote-inner:after, .content-outer .tcs-fancy-header.tcs-style3:after,
	.search .content-outer .searchform label:after, .content-outer .woocommerce.widget_product_search label:after {
		' . react_css_color($palette['light_bg'], 'border-top-color') . '
	}'; ?>
	<?php if ($palette['light_bg_gradient']) {
	if ($options['fancybox_choose_scheme'] === '') {
		echo '
			.fancybox-outer .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
			.fancybox-outer .iphorm-theme-react-default .iphorm-upload-queue-file,
			.fancybox-outer .iphorm-theme-react-default .iphom-upload-progress-wrap,
		';
	}
	echo '
	.content-outer .tcs-button.tcs-hollow-light > a.tcs-has-back-animation:before,
	.content-outer .tcs-button.tcs-hollow-light > span.tcs-r-button.tcs-has-back-animation:before,
	.content-outer .tcs-button.tcs-hollow-light > a.tcs-has-back-animation:hover:before,
	.content-outer .tcs-button.tcs-hollow-light > span.tcs-r-button.tcs-has-back-animation:hover:before,
	.content-outer .tcs-box.tcs-box-basic-light,
	.content-outer .tcw-tweet-light li,
	.content-outer .react.vc_call_to_action.light,
	.content-outer .react.vc_call_to_action,
	.content-outer .tagcloud > a,
	.content-outer .tcp-portfolio-filter .tcp-filter-button,
	.content-outer .tcs-menu.tcs-menu-button-style-two ul li a,
	.content-outer .tcs-button.tcs-style-light > a,
	.content-outer .tcs-button.tcs-style-light > span.tcs-r-button,
	.content-outer .tcs-image-hover.tcs-hover-light,
	.content-outer .tcs-button.tcs-hollow-light > a:hover,
	.content-outer .tcs-button.tcs-hollow-light > span.tcs-r-button:hover,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-light:hover,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-light:before,
	.content-outer  span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-light:hover:before,
	.content-outer .tcs-tabs ul.tcs-tabs-nav li a,
	.content-outer ul#comment-tabs-nav li a,
	.content-outer .tcs-accordion.tcs-box > h3,
	.content-outer .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
	.content-outer .iphorm-theme-react-default .iphorm-upload-queue-file,
	.content-outer .iphorm-theme-react-default .iphom-upload-progress-wrap,
	.content-outer .tcs-impact-header.tcs-light,
	.content-outer blockquote,
	.content-outer .tcs-blockquote .tcs-blockquote-inner,
	.content-outer code,
	.content-outer pre,
	.content-outer kbd,
	.content-outer tt,
	.content-outer .tcs-fancy-header.tcs-style3,
	.content-outer .searchform label,
	.content-outer .woocommerce.widget_product_search label,
	.content-outer .wpb_content_element.react .wpb_accordion_wrapper .wpb_accordion_header,
	.content-outer .vc_progress_bar.react .vc_single_bar {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['light_bg_lighter']) . ' 0%, ' . react_sanitize_color($palette['light_bg_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['light_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['light_bg_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['light_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['light_bg_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['light_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['light_bg_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['light_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['light_bg_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['light_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['light_bg_darker']) . ' 100%);
	}
	.content-outer .tcs-blockquote .tcs-blockquote-inner:after, .content-outer .tcs-fancy-header.tcs-style3:after,
	.content-outer .searchform label:after, .content-outer .woocommerce.widget_product_search label:after {
		' . react_css_color($palette['light_bg_darker'], 'border-top-color') . '
	}'; } ?>

	<?php if ($palette['light_bg_gradient']) echo '
	.tcs-menu.tcs-menu-button-style-two ul li a:hover,
	.tcs-button.tcs-style-light > a:hover,
	.tcs-button.tcs-style-light > span.tcs-r-button:hover {
		' . react_css_color($palette['light_bg_darker'], 'background') . '
		' . react_css_color($palette['light_fg'], 'color') . '
	}'; ?>
	<?php if ($palette['light_bg_darker'])
	if ($options['fancybox_choose_scheme'] === '') {
		echo '
			.fancybox-outer .iphorm-theme-react-default .iphorm-group-style-bordered .iphorm-element-wrap > .iphorm-element-spacer > label,
		';
	}
	echo '
	.content-outer .tcs-tabs ul.tcs-tabs-nav li a:hover,
	.content-outer ul#comment-tabs-nav li a:hover,
	.content-outer .tcs-accordion.tcs-box > h3:hover,
	.content-outer .tcp-portfolio-filter .tcp-filter-button:hover,
	.content-outer .iphorm-theme-react-default .iphorm-group-style-bordered .iphorm-element-wrap > .iphorm-element-spacer > label,
	.content-outer .wpb_content_element.react .wpb_tabs_nav li {
		' . react_css_color($palette['light_bg_darker']) . '
		' . react_css_color($palette['light_fg_even_darker'], 'color') . '
	}
	.content-outer .tcs-tabs ul.tcs-tabs-nav li a:hover:after,
	.content-outer ul#comment-tabs-nav li a:hover:after {
		' . react_css_color($palette['light_bg_darker'], 'border-top-color') . '
	}'; ?>
	<?php if ($palette['light_bg_lighter'] || $palette['light_bg_much_darker'] || $palette['light_fg']) {

	if ($options['fancybox_choose_scheme'] === '') {
		echo '
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-text input,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-captcha input,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-email input,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-password input,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap select,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap textarea,
		';
	}

	echo '
	.content-outer #commentform input[type="text"],
	.content-outer .searchform input[type="text"],
	.content-outer .woocommerce.widget_product_search input[type="search"],
	.content-outer #commentform select,
	.content-outer #commentform textarea,
	.content-outer .widget_archive select,
	.content-outer .widget_categories select,
	.content-outer .textwidget select,
	.content-outer .textwidget input,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-text input,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-captcha input,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-email input,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-password input,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap select,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap textarea {
		' . react_css_color($palette['light_bg']) . '
		' . react_css_color($palette['light_bg_much_darker'], 'border-color') . '
		' . react_css_color($palette['light_fg'], 'color') . '
	}';
	if ($options['fancybox_choose_scheme'] === '') {
		echo '
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-text input,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-captcha input,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-email input,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-password input,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap select,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap textarea,
		';
	}
	echo'
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-text input,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-captcha input,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-email input,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-password input,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap select,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap textarea {
		' . react_css_color($palette['light_bg_even_lighter']) . '
		' . react_css_color($palette['light_bg_much_darker'], 'border-color') . '
	}';
	if ($options['fancybox_choose_scheme'] === '') {
		echo '
		.fancybox-outer .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements .iphorm-group-title-description-wrap,
		';
	}
	echo'
	.content-outer .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements .iphorm-group-title-description-wrap {
		' . react_css_color($palette['light_bg_even_lighter']) . '
		' . react_css_color($palette['light_bg_much_darker'], 'border-color') . '
	}

	'; } ?>
	<?php if ($palette['light_bg_even_darker'] || $palette['light_fg_even_darker']) {

	if ($options['fancybox_choose_scheme'] === '') {
		echo '
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-text input:focus,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-captcha input:focus,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-email input:focus,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-password input:focus,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap select:focus,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap textarea:focus,
		';
	}

	echo '
	.content-outer #commentform input[type="text"]:focus,
	.content-outer .searchform input[type="text"]:focus,
	.content-outer .woocommerce.widget_product_search input[type="search"]:focus,
	.content-outer #commentform select:focus,
	.content-outer #commentform textarea:focus,
	.content-outer .widget_archive select:focus,
	.content-outer .widget_categories select:focus,
	.content-outer .textwidget select:focus,
	.content-outer .textwidget input:focus,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-text input:focus,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-captcha input:focus,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-email input:focus,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-password input:focus,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap select:focus,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap textarea:focus {
		' . react_css_color($palette['light_bg_darker']) . '
		' . react_css_color($palette['light_fg_even_darker'], 'color') . '
		' . react_css_color($palette['primary_bg'], 'border-color') . '
	}';
	if ($options['fancybox_choose_scheme'] === '') {
		echo '
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-text input:focus,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-captcha input:focus,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-email input:focus,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-password input:focus,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap select:focus:focus,
		.fancybox-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap textarea:focus,
		';
	}
	echo '
	.content-outer .flexible-frame.map .map-cover,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-text input:focus,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-captcha input:focus,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-email input:focus,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-password input:focus,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap select:focus,
	.content-outer .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap textarea:focus {
		' . react_css_color($palette['light_bg_lighter']) . '
	}

	'; } ?>
	<?php if ($palette['light_bg_even_darker']) echo '
	.content-outer .tcs-menu.tcs-menu-button-style-two.tcs-grouped ul.menu li:last-child a,
	.content-outer .tcs-menu.tcs-menu-button-style-two.tcs-grouped ul li:last-child a,
	.content-outer .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-two ul.menu li a {
		' . react_css_color($palette['light_bg_even_darker'], 'border-color') . '
	}';
	if ($options['fancybox_choose_scheme'] === '') {
		echo '
		.fancybox-outer .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
		.fancybox-outer .iphorm-theme-react-default .iphorm-upload-queue-file,
		.fancybox-outer .iphorm-theme-react-default .iphom-upload-progress-wrap,
		.fancybox-outer .iphorm-theme-react-default .iphorm-upload-progress-bar-wrap,
		';
	}
	echo '
	.content-outer .tcs-impact-header.tcs-light,
	.content-outer .tcs-button.tcs-style-light > a,
	.content-outer .tcs-button.tcs-style-light > span.tcs-r-button,
	.content-outer .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
	.content-outer .iphorm-theme-react-default .iphorm-upload-queue-file,
	.content-outer .iphorm-theme-react-default .iphom-upload-progress-wrap,
	.content-outer .tcs-menu.tcs-menu-button-style-two ul li a,
	.content-outer .tcs-menu.tcs-menu-button-style-two.tcs-grouped.tcs-inline ul li a,
	.content-outer .tcs-menu.tcs-menu-button-style-two.tcs-grouped.tcs-stacked ul li a,
	.content-outer .tcs-menu.tcs-menu-button-style-two.tcs-grouped ul li.last-child a,
	.content-outer .tcs-menu.tcs-menu-button-style-two.tcs-grouped.tcs-inline ul.menu li a,
	.content-outer .tcs-menu.tcs-menu-button-style-two.tcs-grouped.tcs-stacked ul.menu li a,
	.content-outer .tcs-menu.tcs-menu-button-style-two.tcs-grouped ul.menu li.last-child a,
	.content-outer .iphorm-theme-react-default .iphorm-upload-progress-bar-wrap {
		' . react_css_color($palette['light_bg_much_darker'], 'border-color') . '
	}
	'; ?>
	<?php if ($palette['light_fg'])
		if ($options['fancybox_choose_scheme'] === '') {
			echo '
			.fancybox-outer .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
			.fancybox-outer .iphorm-theme-react-default .iphorm-upload-queue-file,
			.fancybox-outer .iphorm-theme-react-default .iphorm-group-style-bordered .iphorm-element-wrap > .iphorm-element-spacer > label,
			.fancybox-outer .iphorm-theme-react-default .iphorm-element-wrap-text.iphorm-labels-inside > .iphorm-element-spacer > label,
			.fancybox-outer .iphorm-theme-react-default .iphorm-element-wrap-textarea.iphorm-labels-inside > .iphorm-element-spacer > label,
			.fancybox-outer .iphorm-theme-react-default .iphorm-element-wrap-email.iphorm-labels-inside > .iphorm-element-spacer > label,
			.fancybox-outer .iphorm-theme-react-default .iphorm-element-wrap-password.iphorm-labels-inside > .iphorm-element-spacer > label,
			.fancybox-outer .iphorm-theme-react-default .iphorm-element-wrap-captcha.iphorm-labels-inside > .iphorm-element-spacer > label,
			';
		}
	echo '
	.content-outer .tcs-accordion.tcs-box > h3:hover, .content-outer .tcs-accordion.tcs-box > h3.tcs-active, .content-outer .tcs-accordion.tcs-box > h3 a:hover,
	.content-outer .tcs-impact-header.tcs-light .tcs-impact-heading,
	.content-outer .tcs-impact-header.tcs-light .tcs-impact-subheading,
	.content-outer .wpb_content_element.react.light .wpb_tabs_nav li.ui-tabs-active a,
	.content-outer .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
	.content-outer .iphorm-theme-react-default .iphorm-upload-queue-file,
	.content-outer .iphom-upload-progress-wrap,
	.content-outer .js .iphorm-theme-react-default .element-wrapper.inside-label > label,
	.content-outer .iphorm-theme-react-default .iphorm-group-style-bordered .iphorm-element-wrap > .iphorm-element-spacer > label,

	.content-outer .iphorm-theme-react-default .iphorm-element-wrap-text.iphorm-labels-inside > .iphorm-element-spacer > label,
	.content-outer .iphorm-theme-react-default .iphorm-element-wrap-textarea.iphorm-labels-inside > .iphorm-element-spacer > label,
	.content-outer .iphorm-theme-react-default .iphorm-element-wrap-email.iphorm-labels-inside > .iphorm-element-spacer > label,
	.content-outer.iphorm-theme-react-default .iphorm-element-wrap-password.iphorm-labels-inside > .iphorm-element-spacer > label,
	.content-outer .iphorm-theme-react-default .iphorm-element-wrap-captcha.iphorm-labels-inside > .iphorm-element-spacer > label,

	.content-outer .wpb_content_element.react .wpb_tabs_nav li a,
	.content-outer .tcs-box.tcs-box-basic-light > a,
	.content-outer .tcs-box.tcs-box-basic-light > a:hover,
	.content-outer .tcw-tweet-dark li a,
	.content-outer .tcw-tweet-dark li a:hover,
	.content-outer .tcs-menu.tcs-menu-button-style-two ul li,
	.content-outer .tcs-accordion.tcs-box > h3 a {
		' . react_css_color($palette['light_fg'], 'color') . '
	}'; ?>
	<?php if ($palette['light_bg_lighter']) echo '
	.content-outer .tcs-menu.tcs-menu-button-style-two ul li a:hover,
	.content-outer .tcs-button.tcs-style-light > a:hover,
	.content-outer .tcs-button.tcs-style-light > span.tcs-r-button:hover {
		' . react_css_color($palette['light_bg_darker']) . '
		' . react_css_color($palette['light_fg'], 'color') . '
	}'; ?>
	<?php if ($palette['light_icon']) echo '
	.content-outer .tcs-button.tcs-has-drop.tcs-style-light .tcs-open-drop-trigger,
	.content-outer .tcs-button.tcs-style-light > a > i,
	.content-outer .tcs-button.tcs-style-light > span.tcs-r-button > i,
	.content-outer .tcs-button.tcs-hollow-light > a:hover > i,
	.content-outer .tcs-button.tcs-hollow-light > span.tcs-r-button:hover > i,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-light:hover > i,
	.content-outer .tcs-impact-header.tcs-light > i,
	.content-outer .tcs-fancy-header.tcs-style3 > i,
	.content-outer span.contact-ico {
		' . react_css_color($palette['light_icon'], 'color') . '
	}'; ?>
	<?php /* DARK colors */ ?>
	<?php if ($palette['dark_bg']) echo '
	.content-outer span.tcs-icon.tcs-style-dark {
		' . react_css_color($palette['dark_bg'], 'color') . '
	}'; ?>
	<?php if ($palette['dark_bg'] || $palette['dark_fg']) { echo '
	.content-outer .x-close,
	.content-outer .tcs-cycle-controls-wrap a,
	.content-outer .tcs-image-carousel-wrap .tcs-carousel-prev,
	.content-outer .tcs-image-carousel-wrap .tcs-carousel-next,
	.content-outer .ls-reactskin .ls-nav-start,
	.content-outer .ls-reactskin .ls-nav-start.ls-nav-start-active,
	.content-outer .ls-reactskin .ls-nav-stop,
	.content-outer .ls-reactskin .ls-nav-stop.ls-nav-active,
	.content-outer .ls-reactskin a.ls-nav-next,
	.content-outer .ls-reactskin a.ls-nav-prev,
	.content-outer .react.wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon,
	.content-outer .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-read-more a.tcp-basic-button.tcp-dark-button {
		' . react_css_color($palette['dark_bg']) . '
		' . react_css_color($palette['dark_fg'], 'color') . '
	}
	.content-outer .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-read-more a.tcp-basic-button.tcp-dark-button:hover {
		' . react_css_color($palette['dark_bg_darker']) . '
	}'; } ?>
	<?php if ($palette['dark_bg'] || $palette['dark_fg']) { echo '
	.content-outer .rev_slider_wrapper .tp-rightarrow.custom,
	.content-outer .rev_slider_wrapper .tp-leftarrow.custom {
		' . react_css_color($palette['dark_bg'], 'background-color', '!important') . '
		' . react_css_color($palette['dark_fg'], 'color', '!important') . '
	}'; } ?>
	<?php if ($palette['dark_bg'] || $palette['dark_fg']) { echo '
	.content-outer .tcs-impact-header.tcs-dark,
	.content-outer #fs-controls,
	.content-outer #video-controls,
	.content-outer #audio-controls,
	.content-outer .entry-info .post-icon,
	.content-outer .entry-info .date,
	.content-outer .entry-info .react-vote,
	.content-outer .tcp-entry-info .tcp-date,
	.content-outer .tcp-entry-info .react-vote,
	.content-outer .tcs-accordion.tcs-box > h3 span.tcs-acc-icon,
	.content-outer .react .wpb_tour_next_prev_nav a,
	.content-outer #nav-single .nav-previous .meta-nav,
	.content-outer #nav-single .nav-next .meta-nav,
	.content-outer .content-nav .nav-previous .meta-nav,
	.content-outer .content-nav .nav-next .meta-nav,
	.content-outer .comments div.comment .reply a,
	.content-outer .comments ul.children div.comment .reply a,
	.content-outer .tcs-has-drop .tcs-drop-content,
	.content-outer  span.tcs-icon.tcs-boxed.tcs-style-dark,
	.content-outer .vc_progress_bar.react .vc_single_bar .vc_label,
	.content-outer .react .vc-carousel-control .icon-prev,
	.content-outer .react .vc-carousel-control .icon-next,
	.content-outer .react .flex-direction-nav a.flex-next,
	.content-outer .react .flex-direction-nav a.flex-prev,
	.content-outer .react .theme-default .nivo-directionNav a,
	.content-outer .wpb_content_element.react.dark .wpb_tabs_nav li.ui-tabs-active,
	.content-outer .vc_separator.react h4,
	.content-outer .wpb_content_element.wpb_tabs.react.dark .wpb_tour_tabs_wrapper .wpb_tab {
		' . react_css_color($palette['dark_bg'], 'background') . '
		' . react_css_color($palette['dark_fg'], 'color') . '
	}'; } ?>
	<?php if ($palette['dark_bg'] || $palette['dark_fg']) { echo '
	.content-outer .tcs-progress-bar-outer.tcs-dark .tcs-progress-bar,
	.content-outer .tcs-progress-label,
	.content-outer .flexible-frame.map .map-cover.hide:after,
	.content-outer #comments .comment-respond h3#reply-title,
	.content-outer .iphorm-theme-react-default .iphorm-datepicker-icon {
		' . react_css_color($palette['dark_bg']) . '
		' . react_css_color($palette['dark_fg'], 'color') . '
	}
	.content-outer .tcs-progress-label:after {
		' . react_css_color($palette['dark_bg'], 'border-top-color') . '
	}
	'; } ?>

	<?php if ($palette['dark_bg']) echo '
	.content-outer #fs-controls:hover:after,
	.content-outer #video-controls:hover:after,
	.content-outer #audio-controls:hover:after {
		' . react_css_color($palette['dark_bg'], 'border-left-color') . '
	}'; ?>
	<?php if ($palette['dark_bg_lighter'] || $palette['dark_bg_even_darker']) { echo '
	.content-outer .tcs-impact-header-link-wrap a.tcs-impact-link,
	.content-outer .tcs-impact-header-link-wrap span.tcs-impact-link {
		' . react_css_color($palette['dark_bg_lighter'], 'background') . '
		' . react_css_color($palette['dark_bg_even_darker'], 'border-color') . '
	}'; } ?>
	<?php if ($palette['dark_bg_even_lighter']) echo '
	.content-outer .tcs-impact-header-link-wrap a.tcs-impact-link:hover,
	.content-outer .tcs-impact-header-link-wrap span.tcs-impact-link:hover {
		' . react_css_color($palette['dark_bg_even_lighter']) . '
	}'; ?>
	<?php if ($palette['dark_bg_even_lighter']) echo '
	.content-outer .tcs-impact-header.tcs-dark {
		' . react_css_color($palette['dark_bg_darker'], 'border-color') . '
	}'; ?>
	<?php if ($palette['dark_fg']) echo '
	.content-outer .tcs-cycle-controls-wrap a,
	.content-outer .tcs-image-carousel-wrap .tcs-carousel-prev,
	.content-outer .tcs-image-carousel-wrap .tcs-carousel-next,
	.content-outer .x-close,
	.content-outer .date .day,
	.content-outer .entry-info .react-vote .count,
	.content-outer .tcp-entry-info .react-vote .count,
	.content-outer .react-vote .like,
	.content-outer .tcp-date .tcp-day,
	.content-outer .tcp-entry-info
	.content-outer .react-vote .count,
	.content-outer .tcs-drop-close,
	.content-outer .tcs-box.tcs-box-basic-dark a,
	.content-outer .tcs-box.tcs-box-basic-dark a:hover,
	.content-outer .tcw-tweet-dark li a,
	.content-outer .tcw-tweet-dark li a:hover {
		' . react_css_color($palette['dark_fg'], 'color') . '
	}
	.content-outer .tcs-impact-header.tcs-dark .tcs-impact-heading,
	.content-outer .tcs-impact-header.tcs-dark .tcs-impact-subheading,
	.content-outer .wpb_content_element.react.dark .wpb_tabs_nav li.ui-tabs-active a,
	.content-outer .tcs-impact-header-link-wrap a.tcs-impact-link,
	.content-outer .tcs-impact-header-link-wrap span.tcs-impact-link,
	.content-outer .entry-info .react-vote .like:hover,
	.content-outer .tcp-entry-info .react-vote .like:hover,
	.content-outer .date .month,
	.content-outer .tcp-date .tcp-month,
	.content-outer #open-close-close  {
		' . react_css_color($palette['dark_fg'], 'color') . '
	}'; ?>
	<?php if ($palette['dark_bg_lighter']) echo '
   .content-outer #open-close-close, .content-outer .tcs-drop-close {
		' . react_css_color($palette['dark_bg_lighter']) . '
	}
	.content-outer .tcp-portfolio.tcp-date-like-above .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-entry-info > div,
	.content-outer .tcp-portfolio.tcp-date-like-above .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-entry-info > span,
	.content-outer .tcp-portfolio.tcp-boxed .tcp-portfolio-item .tcp-entry-info > span,
	.content-outer .tcp-portfolio.tcp-boxed .tcp-portfolio-item .tcp-entry-info > div,
	.content-outer .tcp-portfolio.tcp-date-like-above .tcp-entry-info .tcp-date {
		' . react_css_color($palette['dark_bg_even_lighter'], 'border-color') . '
	}
	'; ?>
	<?php if ($palette['dark_bg']) echo '
	.content-outer .color .tcs-impact-header-link-wrap a.tcs-impact-link:hover,
	.content-outer .color .tcs-impact-header-link-wrap span.tcs-impact-link:hover {
		' . react_css_color($palette['dark_bg'], 'background', '!important') . '
	}'; ?>
	<?php
		if ($palette['dark_bg']) {
			echo '
				.content-outer .tcs-box.tcs-box-basic-dark, .content-outer .tcw-tweet-dark li, .content-outer .react.vc_call_to_action.dark {
					background: ' . react_sanitize_color($palette['dark_bg_lighter']) . ';
					color: ' . react_sanitize_color($palette['dark_fg']) .';
					text-shadow: -1px -1px 0 ' . react_sanitize_color($palette['dark_bg_even_darker']) . ';
					border-color: ' . react_sanitize_color($palette['dark_bg_much_darker']). ';
					-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1), inset 0px 0px 60px 0px ' . react_sanitize_color($palette['dark_bg_much_darker']). ', 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
					box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1), inset 0px 0px 60px 0px ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
				}

				.content-outer .tcs-button.tcs-style-dark > a, .content-outer .tcs-button.tcs-style-dark > span.tcs-r-button {
					background: ' . react_sanitize_color($palette['dark_bg']) . ';
					color: ' . react_sanitize_color($palette['dark_fg']). ';
					-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
					box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
				}
				.content-outer .tcs-button.tcs-style-dark > a:hover, .content-outer .tcs-button.tcs-style-dark > span.tcs-r-button:hover {
					background: ' . react_sanitize_color($palette['dark_bg_lighter']) . ';
					-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
					box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
				}
				.content-outer .tcs-button.tcs-hollow-dark > a, .content-outer .tcs-button.tcs-hollow-dark > span.tcs-r-button,
				.content-outer span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark {
					' . react_css_color($palette['dark_bg'], 'border-color') . '
					background-color: transparent;
				}
				.content-outer .tcs-button.tcs-hollow-dark > a.tcs-has-back-animation:before,
				.content-outer .tcs-button.tcs-hollow-dark > span.tcs-r-button.tcs-has-back-animation:before,
				.content-outer .tcs-button.tcs-hollow-dark > a.tcs-has-back-animation:hover:before,
				.content-outer .tcs-button.tcs-hollow-dark > span.tcs-r-button.tcs-has-back-animation:hover:before,
				.content-outer .tcs-button.tcs-hollow-dark > a:hover, .content-outer .tcs-button.tcs-hollow-dark > span.tcs-r-button:hover,
				.content-outer .tcs-button.tcs-has-drop.tcs-holw-btn .tcs-open-drop-trigger i, .content-outer span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark:hover,
				.content-outer span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-dark:before,
				.content-outer span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-dark:hover:before,
				.content-outer .tcs-image-hover.tcs-hover-dark {
					' . react_css_color($palette['dark_bg']) . '
					' . react_css_color($palette['dark_fg'], 'color') . '
				}

			';
		}
	?>
	<?php if ($palette['dark_bg_gradient']) echo '
		.content-outer .tcs-button.tcs-hollow-dark > a.tcs-has-back-animation:before,
		.content-outer .tcs-button.tcs-hollow-dark > span.tcs-r-button.tcs-has-back-animation:before,
		.content-outer .tcs-button.tcs-hollow-dark > a.tcs-has-back-animation:hover:before,
		.content-outer .tcs-button.tcs-hollow-dark > span.tcs-r-button.tcs-has-back-animation:hover:before,
		.content-outer .tcs-impact-header.tcs-dark,
		.content-outer .tcs-cycle-controls-wrap a,
		.content-outer #fs-controls,
		.content-outer #video-controls,
		.content-outer #audio-controls,
		.content-outer .entry-info .post-icon,
		.content-outer .entry-info .date,
		.content-outer .entry-info .react-vote,
		.content-outer .tcp-entry-info .tcp-date,
		.content-outer .tcp-entry-info .react-vote,
		.content-outer .tcs-accordion.tcs-box > h3 span.tcs-acc-icon,
		.content-outer .react .wpb_tour_next_prev_nav a,
		.content-outer #nav-single .nav-previous .meta-nav,
		.content-outer #nav-single .nav-next .meta-nav,
		.content-outer .content-nav .nav-previous .meta-nav,
		.content-outer .content-nav .nav-next .meta-nav,
		.content-outer .comments div.comment .reply a,
		.content-outer .comments ul.children div.comment .reply a,
		.content-outer .tcs-has-drop .tcs-drop-content,
		.content-outer .vc_progress_bar.react .vc_single_bar .vc_label,
		.content-outer .vc_separator.react h4,
		.content-outer .desc-hover ul.react-menu li a span.desc,
		.content-outer .im-trigger span.im-desc,
		.content-outer .tcs-box.tcs-box-basic-dark,
		.content-outer .tcw-tweet-dark li,
		.content-outer .react.vc_call_to_action.dark,
		.content-outer .tcs-button.tcs-style-dark > a,
		.content-outer .tcs-button.tcs-style-dark > span.tcs-r-button,
		.content-outer .tcs-button.tcs-hollow-dark > a:hover,
		.content-outer .tcs-image-hover.tcs-hover-dark,
		.content-outer .tcs-button.tcs-hollow-dark > span.tcs-r-button:hover,
		.content-outer span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark:hover,
		.content-outer span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-dark:before,
		.content-outer span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-dark:hover:before {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%, ' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['dark_bg']) . '), color-stop(100%,' . react_sanitize_color($palette['dark_bg_even_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
	}'; ?>

	.qtip.qtip-default.qtip-react.content-tip {
		<?php if ($palette['dark_bg_darker']) echo '' . react_css_color($palette['dark_bg_darker']) . ''; ?>
		<?php if ($palette['dark_fg']) echo '' . react_css_color($palette['dark_fg'], 'color') . ''; ?>
		<?php if ($palette['dark_bg_even_darker']) echo '' . react_css_color($palette['dark_bg_even_darker'], 'border-color') . ''; ?>
	}
	<?php if ($palette['dark_icon']) echo '
	.content-outer .tcs-button.tcs-has-drop.tcs-style-dark .tcs-open-drop-trigger,
	.content-outer .tcs-button.tcs-style-dark > a > i,
	.content-outer .tcs-button.tcs-style-dark > span.tcs-r-button > i,
	.content-outer .tcs-button.tcs-hollow-dark > a:hover > i,
	.content-outer .tcs-button.tcs-hollow-dark > span.tcs-r-button:hover > i,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark:hover > i,
	.content-outer .tcs-impact-header.tcs-dark > i,

	.content-outer .tcs-accordion.tcs-box > h3 span.tcs-acc-icon i,
	.content-outer .tcs-cycle-controls-wrap a > i,
	.content-outer #open-close-close,
	.content-outer #nav-single .nav-previous .meta-nav i,
	.content-outer #nav-single .nav-next .meta-nav i,
	.content-outer .content-nav .nav-previous .meta-nav i,
	.content-outer .content-nav .nav-next .meta-nav i {
		' . react_css_color($palette['dark_icon'], 'color') . '
	}'; ?>


	<?php if ($palette['dark_icon_image'] == 'dark') echo '
		.content-outer .ls-reactskin .ls-nav-start:after,
		.content-outer .ls-reactskin .ls-nav-start.ls-nav-start-active:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		.content-outer .ls-reactskin .ls-nav-stop:after,
		.content-outer .ls-reactskin .ls-nav-stop.ls-nav-active:after,

		.content-outer .ls-reactskin .ls-nav-start .after,
		.content-outer .ls-reactskin .ls-nav-start.ls-nav-start-active .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active .after,
		.content-outer .ls-reactskin .ls-nav-stop .after,
		.content-outer .ls-reactskin .ls-nav-stop.ls-nav-active .after {
			background-image: url(../../react/images/icons/sprites-16-dark.png) !important;
		}
		.content-outer .x-close, .content-outer #comments .comment-respond h3#reply-title {
			background-image: url(../../react/images/x-close-dark.png);
		}
		.content-outer .react.wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon {
			background-image: url(../../react/images/sml-down-arrow-dark.png);
		}
		.content-outer .tcs-image-carousel-wrap .tcs-carousel-prev,
		.content-outer .tcs-image-carousel-wrap .tcs-carousel-next,
		.content-outer .ls-reactskin a.ls-nav-next,
		.content-outer .ls-reactskin a.ls-nav-prev,
		.content-outer .react .theme-default .nivo-directionNav a.nivo-prevNav,
		.content-outer .react .flex-direction-nav a.flex-prev,
		.content-outer .react .theme-default .nivo-directionNav a.nivo-nextNav,
		.content-outer .react .flex-direction-nav a.flex-next {
			background-image: url(../../react/images/slider-arrows-dark.png);
		}
		.content-outer .rev_slider_wrapper .tp-rightarrow.custom, .content-outer .rev_slider_wrapper .tp-leftarrow.custom {
			background-image: url(../../react/images/slider-arrows-dark.png) !important;
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			.content-outer .ls-reactskin .ls-nav-start:after,
			.content-outer .ls-reactskin .ls-nav-start.ls-nav-start-active:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			.content-outer .ls-reactskin .ls-nav-stop:after,
			.content-outer .ls-reactskin .ls-nav-stop.ls-nav-active:after {
				background-image: url(../../react/images/icons/sprites-32-dark.png) !important;
				background-size: 496px 240px;
			}
			.content-outer .x-close, .content-outer #comments .comment-respond h3#reply-title {
				background-image: url(../../react/images/x-close-dark@2x.png);
				background-size: 16px 16px;
			}
			.content-outer .tcs-image-carousel-wrap .tcs-carousel-prev,
			.content-outer .tcs-image-carousel-wrap .tcs-carousel-next,
			.content-outer .ls-reactskin a.ls-nav-next,
			.content-outer .ls-reactskin a.ls-nav-prev,
			.content-outer .react .theme-default .nivo-directionNav a.nivo-prevNav,
			.content-outer .react .flex-direction-nav a.flex-prev,
			.content-outer .react .theme-default .nivo-directionNav a.nivo-nextNav,
			.content-outer .react .flex-direction-nav a.flex-next {
				background-image: url(../../react/images/slider-arrows-dark@2x.png);
				background-size: 64px 32px;
			}
			.content-outer .react.wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon {
				background-image: url(../../react/images/sml-down-arrow-dark@2x.png);
				background-size: 9px 6px;
			}
			.content-outer .rev_slider_wrapper .tp-rightarrow.custom, .content-outer .rev_slider_wrapper .tp-leftarrow.custom {
				background-image: url(../../react/images/slider-arrows-dark@2x.png) !important;
				background-size: 64px 32px !important;
			}
		}
		';
		elseif ($palette['dark_icon_image'] == 'light') echo '

		.content-outer .ls-reactskin .ls-nav-start:after,
		.content-outer .ls-reactskin .ls-nav-start.ls-nav-start-active:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a:after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		.content-outer .ls-reactskin .ls-nav-stop:after,
		.content-outer .ls-reactskin .ls-nav-stop.ls-nav-active:after,

		.content-outer .ls-reactskin .ls-nav-start .after,
		.content-outer .ls-reactskin .ls-nav-start.ls-nav-start-active .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a .after,
		.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active .after,
		.content-outer .ls-reactskin .ls-nav-stop .after,
		.content-outer .ls-reactskin .ls-nav-stop.ls-nav-active .after {
			background-image: url(../../react/images/icons/sprites-16-light.png) !important;
		}
		.content-outer .react.wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon {
			background-image: url(../../react/images/sml-down-arrow-light.png);
		}
		.content-outer .x-close, .content-outer #comments .comment-respond h3#reply-title {
			background-image: url(../../react/images/x-close-light.png);
		}
		.content-outer .tcs-image-carousel-wrap .tcs-carousel-prev,
		.content-outer .tcs-image-carousel-wrap .tcs-carousel-next,
		.content-outer .ls-reactskin a.ls-nav-next,
		.content-outer .ls-reactskin a.ls-nav-prev,
		.content-outer .react .theme-default .nivo-directionNav a.nivo-prevNav,
		.content-outer .react .flex-direction-nav a.flex-prev,
		.content-outer .react .theme-default .nivo-directionNav a.nivo-nextNav,
		.content-outer .react .flex-direction-nav a.flex-next  {
			background-image: url(../../react/images/slider-arrows-light.png);
		}
		.content-outer .rev_slider_wrapper .tp-rightarrow.custom, .content-outer .rev_slider_wrapper .tp-leftarrow.custom {
			background-image: url(../../react/images/slider-arrows-light.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			.content-outer .ls-reactskin .ls-nav-start:after,
			.content-outer .ls-reactskin .ls-nav-start.ls-nav-start-active:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a:after,
			.content-outer .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			.content-outer .ls-reactskin .ls-nav-stop:after,
			.content-outer .ls-reactskin .ls-nav-stop.ls-nav-active:after {
				background-image: url(../../react/images/icons/sprites-32-light.png) !important;
				background-size: 496px 240px;
			}
			.content-outer .x-close, .content-outer #comments .comment-respond h3#reply-title {
				background-image: url(../../react/images/x-close-light@2x.png);
				background-size: 16px 16px;
			}
			.content-outer .react.wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon {
				background-image: url(../../react/images/sml-down-arrow-light@2x.png);
				background-size: 9px 6px;
			}
			.content-outer .tcs-image-carousel-wrap .tcs-carousel-prev,
			.content-outer .tcs-image-carousel-wrap .tcs-carousel-next,
			.content-outer .ls-reactskin a.ls-nav-next,
			.content-outer .ls-reactskin a.ls-nav-prev,
			.content-outer .react .theme-default .nivo-directionNav a.nivo-prevNav,
			.content-outer .react .flex-direction-nav a.flex-prev,
			.content-outer .react .theme-default .nivo-directionNav a.nivo-nextNav,
			.content-outer .react .flex-direction-nav a.flex-next {
				background-image: url(../../react/images/slider-arrows-light@2x.png);
				background-size: 64px 32px;
			}
			.content-outer .rev_slider_wrapper .tp-rightarrow.custom, .content-outer .rev_slider_wrapper .tp-leftarrow.custom {
				background-image: url(../../react/images/slider-arrows-light@2x.png) !important;
				background-size: 64px 32px !important;
			}
		}
		';
	?>

	<?php /* With box shadows Color buttons - PRIME color */ ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	.content-outer .tcs-button.tcs-hollow-prime > a,
	.content-outer .tcs-button.tcs-hollow-prime > span.tcs-r-button,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-prime {
		' . react_css_color($palette['primary_bg'], 'border-color') . '
		background-color: transparent;
	}
	.content-outer .iphorm-theme-react-default .iphorm-loading-wrap .iphorm-loading,
	.content-outer .iphorm-theme-react-default .iphorm-loading-wrap .iphorm-loading:before,
	.content-outer .iphorm-theme-react-default .iphorm-loading-wrap .iphorm-loading:after {
		' . react_css_color($palette['primary_bg'], 'border-top-color') . '
	}
	.content-outer .tcs-image-hover.tcs-hover-prime,
	.content-outer .tcs-menu.tcs-menu-button-style-one ul li a,
	.content-outer .tcs-button.tcs-hollow-prime > a:hover,
	.content-outer .tcs-button.tcs-hollow-prime > span.tcs-r-button:hover,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-prime:hover,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-prime:before,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-prime:hover:before {
		' . react_css_color($palette['primary_bg'], 'background') . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}';

	if ($options['fancybox_choose_scheme'] === '') {
		echo '
		.fancybox-outer .iphorm-theme-react-default .iphorm-submit-wrap button span,
		.fancybox-outer .iphorm-theme-react-default .iphorm-swfupload-browse,
		.fancybox-outer .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button,
		';
	}
	echo '
	.content-outer .read-more-link a.more-link,
	.content-outer .comments-link a,
	.content-outer .searchform input.searchsubmit,
	.content-outer .woocommerce.widget_product_search input[type="submit"],
	.content-outer .iphorm-theme-react-default .iphorm-submit-wrap button span,
	.content-outer .iphorm-theme-react-default .iphorm-swfupload-browse,
	.content-outer .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button,
	.content-outer .form-submit input,
	.content-outer .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap a.tcs-impact-link,
	.content-outer .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap span.tcs-impact-link,
	.content-outer .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap a.tcs-impact-link,
	.content-outer .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap span.tcs-impact-link,
	.content-outer .tcs-button.tcs-style-prime > a,
	.content-outer .tcs-button.tcs-style-prime > span.tcs-r-button,
	.content-outer .tcw-follow-me-button a,
	.content-outer a.basic-button,
	.content-outer a.tcp-basic-button {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
		-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
		 box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
	}

	'; } ?>


	.content-outer .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul li a,
	.content-outer .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul.menu li a,
	.content-outer .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul.menu li.menu-item-has-children > a {
	-webkit-box-shadow: inset 0px -1px 0px 0px rgba(255, 255, 255, 0.05);
	box-shadow: inset 0px -1px 0px 0px rgba(255, 255, 255, 0.05);
	}

	<?php if ($palette['primary_bg']) echo '
	.content-outer .tcs-impact-header.tcs-light {
		-webkit-box-shadow: inset 0 -2px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1), inset 0px -3px 0px 0px rgba(255, 255, 255, 0.2);
		 box-shadow: inset 0 -2px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1), inset 0px -3px 0px 0px rgba(255, 255, 255, 0.2);
	}'; ?>

	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	.content-outer ::-moz-selection {
		background-color: ' . react_sanitize_color($palette['primary_bg']) . ';
		color: ' . react_sanitize_color($palette['primary_fg']) . ';
	}
	.content-outer ::selection {
		background-color: ' . react_sanitize_color($palette['primary_bg']) . ';
		color: ' . react_sanitize_color($palette['primary_fg']) . ';
	}
	.content-outer .featured-image-link:before, .content-outer .featured-image-link:after,
	.content-outer .tcp-featured-image-link:before, .content-outer .tcp-featured-image-link:after {
		' . react_css_color($palette['primary_fg'], 'color') . '
		' . react_css_color($palette['primary_bg']) . '
	}
	#content > .entry .entry-info > div.post-icon {
		' . react_css_color($palette['primary_fg'], 'color') . '
		' . react_css_color($palette['primary_bg']) . '
	}
	#content > .entry .entry-info > div.post-icon:first-child:after {
		' . react_css_color($palette['primary_bg'], 'border-top-color') . '
	}
	.content-outer .tcs-progress-bar-outer.tcs-prime .tcs-progress-bar,
	.content-outer .highlighted-text, .content-outer .tcs-highlighted-text, body.react-wp .content-outer mark, .content-outer .mejs-controls .mejs-time-rail .mejs-time-current {
		background-color: ' . react_sanitize_color($palette['primary_bg']) . ';
		color: ' . react_sanitize_color($palette['primary_fg']) . ';
	}'; } ?>
	<?php
		if ($palette['primary_bg']) {
			if ($options['fancybox_choose_scheme'] === '') {
				echo '
				.fancybox-outer .iphorm-theme-react-default .iphorm-submit-wrap button:hover span,
				.fancybox-outer .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button:hover,
				';
			}
			echo '
			.content-outer .read-more-link a.more-link:hover,
			.content-outer .comments-link a:hover,
			.content-outer .searchform input.searchsubmit:hover,
			.content-outer .woocommerce.widget_product_search input[type="submit"]:hover,
			.content-outer .iphorm-theme-react-default .iphorm-submit-wrap button:hover span,

			.content-outer .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button:hover,

			.content-outer .form-submit input:hover,
			.content-outer .back-home-icon.button a.back-home:hover,

			.content-outer .tcs-button.tcs-style-dark.tcs-hover-prime-btn > a:hover,
			.content-outer .tcs-button.tcs-style-dark.tcs-hover-prime-btn > span.tcs-r-button:hover,
			.content-outer .tcs-button.tcs-style-light.tcs-hover-prime-btn > a:hover,
			.content-outer .tcs-button.tcs-style-light.tcs-hover-prime-btn > span.tcs-r-button:hover,
			.content-outer .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap a.tcs-impact-link:hover,
			.content-outer .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap span.tcs-impact-link:hover,
			.content-outer .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap a.tcs-impact-link:hover,
			.content-outer .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap span.tcs-impact-link:hover,
			.content-outer .tcs-button.tcs-style-prime > a:hover,
			.content-outer .tcs-button.tcs-style-prime > span.tcs-r-button:hover,
			.content-outer a.basic-button:hover,
			.content-outer a.tcp-basic-button:hover,
			.content-outer .tcw-follow-me-button a:hover,
			.content-outer .back-home-icon.button a.back-home {
				-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']). ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
				box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']). ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
				' . react_css_color($palette['primary_fg'], 'color') . '
				' . react_css_color($palette['primary_bg_lighter']) . '
			}
			.content-outer .tcs-menu.tcs-menu-button-style-one ul li a:hover {
				' . react_css_color($palette['primary_fg'], 'color') . '
				' . react_css_color($palette['primary_bg_lighter']) . '
			}
			';
		}
	?>
	<?php /* Flat Color buttons - PRIME color */ ?>
	<?php if ($palette['primary_bg_even_darker']) echo '
	.content-outer .tcs-menu.tcs-menu-button-style-one.tcs-grouped ul li a,
	.content-outer .tcs-menu.tcs-menu-button-style-one.tcs-grouped ul.menu li a {
		' . react_css_color($palette['primary_bg_even_darker'], 'border-color') . '
	}
	'; ?>
	<?php if ($palette['primary_bg']) echo '
	.content-outer #audio-controls, .content-outer #video-controls, .content-outer #fs-controls {
		' . react_css_color($palette['primary_bg'], 'border-right-color') . '
	}
	'; ?>
	<?php if ($palette['primary_bg']) echo '
	.content-outer span.tcs-icon.tcs-style-prime, .content-outer .text-prime {
		' . react_css_color($palette['primary_bg'], 'color') . '
	}'; ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	.content-outer .tcs-button.tcs-hollow-prime > a.tcs-has-back-animation:before,
	.content-outer .tcs-button.tcs-hollow-prime > span.tcs-r-button.tcs-has-back-animation:before,
	.content-outer .tcs-button.tcs-hollow-prime > a.tcs-has-back-animation:hover:before,
	.content-outer .tcs-button.tcs-hollow-prime > span.tcs-r-button.tcs-has-back-animation:hover:before,
	.content-outer .comments div.comment .reply a:hover,
	.content-outer .comments ul.children div.comment .reply a:hover,
	.content-outer .form-submit input,
	.content-outer #comments ul#comment-tabs-nav li a.current,
	.content-outer ul.wp-tag-cloud li a:hover,
	.content-outer .tagcloud > a:hover,
	.content-outer .react-woo-image-hover,
	.content-outer .tcp-portfolio-hover,
	.content-outer .tcp-portfolio-filter .tcp-active-filter.tcp-filter-button,
	.content-outer .tcp-portfolio-filter .tcp-active-filter.tcp-filter-button:hover,
	.content-outer .tcs-accordion.tcs-box > h3.tcs-active span.tcs-acc-icon,
	.content-outer .tcs-accordion.tcs-box > h3:hover span.tcs-acc-icon,
	.content-outer .vc_progress_bar.react .vc_single_bar .vc_bar,
	.content-outer .react .wpb_tour_next_prev_nav a:hover,
	.content-outer .tcs-tabs ul.tcs-tabs-nav li.tcs-active a,
	.content-outer .tcs-tabs ul.tcs-tabs-nav li.tcs-active a:hover,
	.content-outer #nav-single .nav-previous:hover .meta-nav,
	.content-outer #nav-single .nav-next:hover .meta-nav,
	.content-outer .content-nav .nav-previous:hover .meta-nav,
	.content-outer .content-nav .nav-next:hover .meta-nav,
	.content-outer span.tcs-icon.tcs-boxed.tcs-style-prime,
	.content-outer .wpb_content_element.react .wpb_tabs_nav li.ui-tabs-active,
	.content-outer .react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,
	.content-outer .react.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab,
	.content-outer .react.prime.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab {
		' . react_css_color($palette['primary_bg'], 'background') . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; } ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	.content-outer .search-button-wrap input,
	.content-outer .widget_search input.searchsubmit,
	.content-outer .searchform input.searchsubmit,
	.content-outer .woocommerce.widget_product_search input[type="submit"] {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; } ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	.content-outer #comments .comment-respond h3#reply-title:hover {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; } ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	.content-outer .tcs-cycle-controls-wrap a:hover,
	.content-outer .tcs-image-carousel-wrap .tcs-carousel-next:hover,
	.content-outer .tcs-image-carousel-wrap .tcs-carousel-prev:hover,
	.content-outer a:hover .x-close,
	.content-outer .x-close:hover,
	.content-outer .tcs-drop-close:hover,
	.content-outer a.fancybox-nav.fancybox-prev:hover > span,
	.content-outer a.fancybox-nav.fancybox-next:hover > span,
	.content-outer .ls-reactskin a.ls-nav-next:hover,
	.content-outer .ls-reactskin a.ls-nav-prev:hover,
	.content-outer .ls-reactskin .ls-nav-start:hover,
	.content-outer .ls-reactskin .ls-nav-start.ls-nav-start-active:hover,
	.content-outer .ls-reactskin .ls-nav-stop:hover,
	.content-outer .ls-reactskin .ls-nav-stop.ls-nav-active:hover,
	.content-outer .react .vc-carousel-control .icon-prev:hover,
	.content-outer .react .vc-carousel-control .icon-next:hover,
	.content-outer .react .flex-control-paging li a.flex-active,
	.content-outer .react .flex-direction-nav a.flex-next:hover,
	.content-outer .react .flex-direction-nav a.flex-prev:hover,
	.content-outer .react .theme-default .nivo-directionNav a:hover {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; } ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	.content-outer .rev_slider_wrapper .tp-rightarrow.custom:hover,
	.content-outer .rev_slider_wrapper .tp-leftarrow.custom:hover {
		' . react_css_color($palette['primary_bg'], 'background-color', '!important') . '
		' . react_css_color($palette['primary_fg'], 'color', '!important') . '
	}'; } ?>
	<?php if ($palette['primary_bg']) echo '
	.content-outer #open-close-close:hover,
	.content-outer .tcs-fancy-header.tcs-prime-line .tcs-fancy-header-text:before,
	div.post.entry .content-outer .featured-image-wrap a:after,
	body .after-header-wrap #content > div.entry.sticky:before,
	.content-outer .comments li.comment.bypostauthor div.comment:after,
	.content-outer .comments ul.children li.comment.bypostauthor div.comment:after,
	.content-outer .owl-theme .owl-dots .owl-dot.active span,
	.content-outer .owl-theme .owl-dots .owl-dot:hover span {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; ?>
	<?php if ($palette['primary_bg_lighter']) echo '
	.content-outer .search-button-wrap input:hover,
	.content-outer widget_search input.searchsubmit:hover {
		' . react_css_color($palette['primary_bg_lighter']) . '
	}'; ?>

	<?php if ($palette['primary_bg']) echo '
	.content-outer .featured-image-wrap:hover,
	.content-outer .tcp-featured-image-wrap:hover {
		' . react_css_color($palette['primary_bg'], 'border-bottom-color') . '
	}'; ?>
	<?php if ($palette['primary_bg_darker']) echo '
	.content-outer .search-button-wrap input:active,
	.content-outer .widget_search input.searchsubmit:active,
	.content-outer .search-button-wrap input:hover, .content-outer .widget_search input.searchsubmit:hover,
	.content-outer .search-button-wrap input:active, .content-outer .widget_search input.searchsubmit:active {
		' . react_css_color($palette['primary_bg_lighter']) . '
	}'; ?>
	<?php /* After with arrows at bottom - prime color - ANYTHING ADDED HERE ALSO ADD TO CUSTOM SECTION*/ ?>
	<?php if ($palette['primary_bg']) echo '
	.content-outer #comments ul#comment-tabs-nav li a.current:after,
	.content-outer .tcp-portfolio-filter .tcp-active-filter.tcp-filter-button:after,
	.content-outer .tcs-tabs ul.tcs-tabs-nav li.tcs-active a:after {
		' . react_css_color($palette['primary_bg'], 'border-top-color', '!important') . '
	}'; ?>
	<?php if ($palette['primary_bg_gradient']) echo '
	.content-outer  .tcs-button.tcs-hollow-prime > a.tcs-has-back-animation:before,
	.content-outer  .tcs-button.tcs-hollow-prime > span.tcs-r-button.tcs-has-back-animation:before,
	.content-outer  .tcs-button.tcs-hollow-prime > a.tcs-has-back-animation:hover:before,
	.content-outer  .tcs-button.tcs-hollow-prime > span.tcs-r-button.tcs-has-back-animation:hover:before,
	.content-outer .comments div.comment .reply a:hover,
	.content-outer .comments ul.children div.comment .reply a:hover,
	.content-outer .form-submit input,
	.content-outer #comments ul#comment-tabs-nav li a.current,
	.content-outer ul.wp-tag-cloud li a:hover,
	.content-outer .tagcloud > a:hover,
	.content-outer .react-woo-image-hover,
	.content-outer .tcp-portfolio-hover,
	.content-outer .tcp-portfolio-filter .tcp-active-filter.tcp-filter-button,
	.content-outer .tcp-portfolio-filter .tcp-active-filter.tcp-filter-button:hover,
	.content-outer .tcs-accordion.tcs-box > h3.tcs-active span.tcs-acc-icon,
	.content-outer .tcs-accordion.tcs-box > h3:hover span.tcs-acc-icon,
	.content-outer .react .wpb_tour_next_prev_nav a:hover,
	.content-outer .tcs-tabs ul.tcs-tabs-nav li.tcs-active a,
	.content-outer .tcs-tabs ul.tcs-tabs-nav li.tcs-active a:hover,
	.content-outer .tcs-cycle-controls-wrap a:hover,
	.content-outer #nav-single .nav-previous:hover .meta-nav,
	.content-outer #nav-single .nav-next:hover .meta-nav,
	.content-outer .content-nav .nav-previous:hover .meta-nav,
	.content-outer .content-nav .nav-next:hover .meta-nav {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%, ' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['primary_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['primary_bg_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
	}
	.content-outer #comments ul#comment-tabs-nav li a.current:after,
	.content-outer .tcp-portfolio-filter .tcp-active-filter.tcp-filter-button:after,
	.content-outer .tcs-tabs ul.tcs-tabs-nav li.tcs-active a:after {
		' . react_css_color($palette['primary_bg_darker'], 'border-top-color', '!important') . '
	}'; ?>
	<?php if ($palette['primary_bg_gradient']) {
	if ($options['fancybox_choose_scheme'] === '') {
		echo '
		.fancybox-outer .iphorm-theme-react-default .iphorm-submit-wrap button span,
		.fancybox-outer .iphorm-theme-react-default .iphorm-submit-wrap button:hover span,
		.fancybox-outer .iphorm-theme-react-default .iphorm-swfupload-browse,
		.fancybox-outer .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button,
		.fancybox-outer .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button:hover,
		';
	}
	echo '
	.content-outer .read-more-link a.more-link,
	.content-outer .comments-link a,
	.content-outer .comments-link a:hover,
	.content-outer .iphorm-theme-react-default .iphorm-submit-wrap button span,
	.content-outer .iphorm-theme-react-default .iphorm-submit-wrap button:hover span,
	.content-outer .iphorm-theme-react-default .iphorm-swfupload-browse,
	.content-outer .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button,
	.content-outer .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button:hover,
	.content-outer .tcs-menu.tcs-menu-button-style-one ul li a,
	.content-outer .tcs-menu.tcs-menu-button-style-one ul li a:hover,
	.content-outer .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul li a,
	.content-outer .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul li a:hover,
	.content-outer .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul.menu li a,
	.content-outer .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul.menu li a:hover,
	.content-outer .form-submit input,
	.content-outer .form-submit input:hover,
	.content-outer .back-home-icon.button a.back-home,
	.content-outer .back-home-icon.button a.back-home:hover,
	.content-outer .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap a.tcs-impact-link,
	.content-outer .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap span.tcs-impact-link,
	.content-outer .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap a.tcs-impact-link,
	.content-outer .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap span.tcs-impact-link,
	.content-outer .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap a.tcs-impact-link:hover,
	.content-outer .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap span.tcs-impact-link:hover,
	.content-outer .tcs-button.tcs-style-prime > a,
	.content-outer .tcs-button.tcs-style-prime > a:hover,
	.content-outer .tcs-button.tcs-style-prime > span.tcs-r-button,
	.content-outer .tcs-button.tcs-style-prime > span.tcs-r-button:hover,
	.content-outer .tcs-button.tcs-hollow-prime > a.tcs-r-button,
	.content-outer .tcs-button.tcs-hollow-prime > span.tcs-r-button:hover,
	.content-outer .tcs-button.tcs-style-dark.tcs-hover-prime-btn > a:hover,
	.content-outer .tcs-button.tcs-style-dark.tcs-hover-prime-btn > span.tcs-r-button:hover,
	.content-outer .tcs-button.tcs-style-light.tcs-hover-prime-btn > a:hover,
	.content-outer .tcs-button.tcs-style-light.tcs-hover-prime-btn > span.tcs-r-button:hover,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-prime:hover,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-prime:before,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-prime:hover:before,
	.content-outer .tcw-follow-me-button a,
	.content-outer .tcw-follow-me-button a:hover,
	.content-outer a.basic-button,
	.content-outer a.basic-button:hover,
	.content-outer a.tcp-basic-button,
	.content-outer a.tcp-basic-button:hover {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%, ' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['primary_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['primary_bg_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
	}
	'; } ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) echo '
	.content-outer .tcs-impact-header.tcs-color,
	.content-outer .tcs-fancy-header.tcs-style2,
	.content-outer .tcs-box.tcs-box-basic,
	.content-outer .react.vc_call_to_action.prime {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
		';
		if ($palette['primary_bg']) {
			echo '
			-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 3px 0 0 rgba(0, 0, 0, 0.1), inset 0 0 60px 0 rgba(0, 0, 0, 0.07);
			box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 3px 0 0 rgba(0, 0, 0, 0.1), inset 0 0 60px 0 rgba(0, 0, 0, 0.07);
			';
		}
	echo '}'; ?>
	<?php if ($palette['primary_fg']) echo '
	.content-outer .tcs-impact-header .tcs-impact-heading,
	.content-outer .tcs-impact-header .tcs-impact-subheading,
	.content-outer .tcs-menu.tcs-menu-button-style-one ul li {
		' . react_css_color($palette['primary_fg'], 'color') .'
	}'; ?>
	<?php if ($palette['primary_bg']) echo '
	.content-outer #wp-calendar thead th {
		' . react_css_color($palette['primary_bg'], 'color') .'
	}'; ?>
	<?php if ($palette['primary_icon']) echo '
	.content-outer .tcs-button.tcs-has-drop.tcs-style-prime .tcs-open-drop-trigger,
	.content-outer .tcs-button.tcs-style-prime > a > i,
	.content-outer .tcs-button.tcs-style-prime > span.tcs-r-button > i,
	.content-outer .tcs-button.tcs-style-dark.tcs-hover-prime-btn > a:hover > i,
	.content-outer .tcs-button.tcs-style-dark.tcs-hover-prime-btn > span.tcs-r-button:hover > i,
	.content-outer .tcs-button.tcs-style-light.tcs-hover-prime-btn > a:hover > i,
	.content-outer .tcs-button.tcs-style-light.tcs-hover-prime-btn > span.tcs-r-button:hover > i,
	.content-outer .tcs-button.tcs-hollow-prime > a:hover > i,
	.content-outer .tcs-button.tcs-hollow-prime > span.tcs-r-button:hover > i,
	.content-outer span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-prime:hover > i,
	.content-outer .tcs-fancy-header.tcs-style2 i,
	.content-outer .tcs-impact-header.tcs-color > i,
	.content-outer .tcs-accordion.tcs-box > h3.tcs-active span.tcs-acc-icon i,

	.content-outer .tcs-accordion.tcs-box > h3:hover span.tcs-acc-icon i,
	.content-outer .tcs-cycle-controls-wrap a:hover > i,
	.content-outer #open-close-close:hover,
	.content-outer #nav-single .nav-previous:hover .meta-nav i,
	.content-outer #nav-single .nav-next:hover .meta-nav i,
	.content-outer .content-nav .nav-previous:hover .meta-nav i,
	.content-outer .content-nav .nav-next:hover .meta-nav i {
		' . react_css_color($palette['primary_icon'], 'color') .'
	}'; ?>


	<?php if ($palette['primary_icon_image'] == 'dark') echo '
		.content-outer .ls-reactskin .ls-nav-start:hover:after,
		.content-outer .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
		.content-outer .ls-reactskin .ls-nav-stop:hover:after,
		.content-outer .ls-reactskin .ls-nav-stop.ls-nav-active:hover:after {
			background-image: url(../../react/images/icons/sprites-16-dark.png) !important;
		}

		.content-outer .breadcrumbs .back-home-icon span {
			background-image: url(../../react/images/icons/sprites-16-dark.png);
		}
		.content-outer .woocommerce.widget_product_search input[type="submit"],
		.content-outer .widget_search .searchform input.searchsubmit,
		.content-outer .search-button-wrap input, .content-outer .widget_search input.searchsubmit {
			background-image: url(../../react/images/search-icon-dark.png);
		}

		.content-outer .x-close:hover, .content-outer #comments .comment-respond h3#reply-title:hover {
			background-image: url(../../react/images/x-close-dark.png);
		}
		.content-outer .tcs-image-carousel-wrap .tcs-carousel-prev:hover,
		.content-outer .tcs-image-carousel-wrap .tcs-carousel-next:hover,
		.content-outer .ls-reactskin a.ls-nav-next:hover,
		.content-outer .ls-reactskin a.ls-nav-prev:hover,
		.content-outer .react .theme-default .nivo-directionNav a.nivo-prevNav:hover,
		.content-outer .react .flex-direction-nav a.flex-prev:hover,
		.content-outer .react .theme-default .nivo-directionNav a.nivo-nextNav:hover,
		.content-outer .react .flex-direction-nav a.flex-next:hover {
			background-image: url(../../react/images/slider-arrows-dark.png);
		}
		.content-outer .react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon {
			background-image: url(../../react/images/sml-down-arrow-dark.png);
		}
		.content-outer .rev_slider_wrapper .tp-rightarrow.custom:hover, .content-outer .rev_slider_wrapper .tp-leftarrow.custom:hover {
			background-image: url(../../react/images/slider-arrows-dark.png) !important;
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {

			.content-outer .ls-reactskin .ls-nav-start:hover:after,
			.content-outer .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
			.content-outer .ls-reactskin .ls-nav-stop:hover:after,
			.content-outer .ls-reactskin .ls-nav-stop.ls-nav-active:hover:after {
				background-image: url(../../react/images/icons/sprites-32-dark.png) !important;
				background-size: 496px 240px;
			}
			.content-outer  .breadcrumbs .back-home-icon span {
				background-image: url(../../react/images/icons/sprites-32-dark.png);
				background-size: 496px 240px;
			}
			.content-outer .woocommerce.widget_product_search input[type="submit"],
			.content-outer .widget_search .searchform input.searchsubmit,
			.content-outer .search-button-wrap input, .content-outer .widget_search input.searchsubmit {
				background-image: url(../../react/images/search-icon-dark@2x.png);
				background-size: 16px 16px;
			}
			.content-outer .react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon {
				background-image: url(../../react/images/sml-down-arrow-dark@2x.png);
				background-size: 9px 6px;
			}
			.content-outer .x-close:hover, .content-outer #comments .comment-respond h3#reply-title:hover {
				background-image: url(../../react/images/x-close-dark@2x.png);
				background-size: 16px 16px;
			}
			.content-outer .tcs-image-carousel-wrap .tcs-carousel-prev:hover,
			.content-outer .tcs-image-carousel-wrap .tcs-carousel-next:hover,
			.content-outer .ls-reactskin a.ls-nav-next:hover,
			.content-outer .ls-reactskin a.ls-nav-prev:hover,
			.content-outer .react .theme-default .nivo-directionNav a.nivo-prevNav:hover,
			.content-outer .react .flex-direction-nav a.flex-prev:hover,
			.content-outer .react .theme-default .nivo-directionNav a.nivo-nextNav:hover,
			.content-outer .react .flex-direction-nav a.flex-next:hover {
				background-image: url(../../react/images/slider-arrows-dark@2x.png);
				background-size: 64px 32px;
			}
			.content-outer .rev_slider_wrapper .tp-rightarrow.custom:hover, .content-outer .rev_slider_wrapper .tp-leftarrow.custom:hover {
				background-image: url(../../react/images/slider-arrows-dark@2x.png) !important;
				background-size: 64px 32px !important;
			}

		}

		';
		elseif ($palette['primary_icon_image'] == 'light') echo '
		.content-outer .ls-reactskin .ls-nav-start:hover:after,
		.content-outer .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
		.content-outer .ls-reactskin .ls-nav-stop:hover:after,
		.content-outer .ls-reactskin .ls-nav-stop.ls-nav-active:hover:after {
			background-image: url(../../react/images/icons/sprites-16-light.png) !important;
		}
		.content-outer .breadcrumbs .back-home-icon span {
			background-image: url(../../react/images/icons/sprites-16-light.png);
		}
		.content-outer .woocommerce.widget_product_search input[type="submit"],
		.content-outer .widget_search .searchform input.searchsubmit,
		.content-outer .search-button-wrap input, .content-outer .widget_search input.searchsubmit {
			background-image: url(../../react/images/search-icon-light.png);
		}

		.content-outer .x-close:hover, .content-outer #comments .comment-respond h3#reply-title:hover {
			background-image: url(../../react/images/x-close-light.png);
		}
		.content-outer .tcs-image-carousel-wrap .tcs-carousel-prev:hover,
		.content-outer .tcs-image-carousel-wrap .tcs-carousel-next:hover,
		.content-outer .ls-reactskin a.ls-nav-next:hover,
		.content-outer .ls-reactskin a.ls-nav-prev:hover,
		.content-outer .react .theme-default .nivo-directionNav a.nivo-prevNav:hover,
		.content-outer .react .flex-direction-nav a.flex-prev:hover,
		.content-outer .react .theme-default .nivo-directionNav a.nivo-nextNav:hover,
		.content-outer .react .flex-direction-nav a.flex-next:hover {
			background-image: url(../../react/images/slider-arrows-light.png);
		}
		.content-outer .rev_slider_wrapper .tp-rightarrow.custom:hover, .content-outer .rev_slider_wrapper .tp-leftarrow.custom:hover {
			background-image: url(../../react/images/slider-arrows-light.png) !important;
		}
		.content-outer .react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon {
			background-image: url(../../react/images/sml-down-arrow-light.png);
		}


		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {

			.content-outer .ls-reactskin .ls-nav-start:hover:after,
			.content-outer .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
			.content-outer .ls-reactskin .ls-nav-stop:hover:after,
			.content-outer .ls-reactskin .ls-nav-stop.ls-nav-active:hover:after {
				background-image: url(../../react/images/icons/sprites-32-light.png) !important;
				background-size: 496px 240px;
			}
			.content-outer .breadcrumbs .back-home-icon span {
				background-image: url(../../react/images/icons/sprites-32-light.png);
				background-size: 496px 240px;
			}
			.content-outer .woocommerce.widget_product_search input[type="submit"],
			.content-outer .widget_search .searchform input.searchsubmit,
			.content-outer .search-button-wrap input, .content-outer .widget_search input.searchsubmit {
				background-image: url(../../react/images/search-icon-light@2x.png);
				background-size: 16px 16px;
			}
			.content-outer .x-close:hover, .content-outer #comments .comment-respond h3#reply-title:hover {
				background-image: url(../../react/images/x-close-light@2x.png);
				background-size: 16px 16px;
			}
			.content-outer .react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon {
				background-image: url(../../react/images/sml-down-arrow-light@2x.png);
				background-size: 9px 6px;
			}
			.content-outer .tcs-image-carousel-wrap .tcs-carousel-prev:hover,
			.content-outer .tcs-image-carousel-wrap .tcs-carousel-next:hover,
			.content-outer .ls-reactskin a.ls-nav-next:hover,
			.content-outer .ls-reactskin a.ls-nav-prev:hover,
			.content-outer .react .theme-default .nivo-directionNav a.nivo-prevNav:hover,
			.content-outer .react .flex-direction-nav a.flex-prev:hover,
			.content-outer .react .theme-default .nivo-directionNav a.nivo-nextNav:hover,
			.content-outer .react .flex-direction-nav a.flex-next:hover {
				background-image: url(../../react/images/slider-arrows-light@2x.png);
				background-size: 64px 32px;
			}
			.content-outer .rev_slider_wrapper .tp-rightarrow.custom:hover, .content-outer .rev_slider_wrapper .tp-leftarrow.custom:hover {
				background-image: url(../../react/images/slider-arrows-light@2x.png) !important;
				background-size: 64px 32px !important;
			}
		}
	';
?>

<?php endif; ?>




<?php if ($options['footer_widget_area_layout']) : ?>
<?php if ($palette = react_get_palette_by_id($options['general_color_footer_choose_scheme'] )) : ?>
	<?php if ($palette['background'] || $palette['primary_bg'] || $palette['text']) { echo '
		.footer {
			' . react_css_color($palette['background']) . '
			' . react_css_color($palette['primary_bg'], 'border-color') . '
			' . react_css_color($palette['text'], 'color') . '
		}
	'; } ?>
	<?php if ($palette['background_gradient']) echo '
		.footer {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['background_lighter']) . ' 0%, ' . react_sanitize_color($palette['background_touch_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['background_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['background_touch_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['background_touch_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['background_touch_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['background_touch_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['background_touch_darker']) . ' 100%);
		}';
	?>
<?php endif; ?>
<?php endif; ?>








<?php /* Global Subfooter Color */ ?>
<?php
if ($options['general_color_subfooter_background'] != '' || $options['general_color_subfooter_text'] != '') {
	echo '
		#subfooter {
			' . react_css_color($options['general_color_subfooter_background']) . '
			' . react_css_color($options['general_color_subfooter_text'], 'color') . '
		}
	';
}
?>
<?php
if ($options['general_color_subfooter_link']) {
	echo '
		.subfooter-wrap a, #subfooter .social-icon-wrap.type-2 .social-icon-wrap a i,
		#subfooter .social-icon-outer.type-4 .social-icon-wrap a i {
			' . react_css_color($options['general_color_subfooter_link'], 'color') . '
		}
	';
}
?>
<?php
if ($options['general_color_subfooter_link_hover']) {
	echo '
		.subfooter-wrap a:hover, .subfooter-wrap a:active, #subfooter .social-icon-wrap.type-2 .social-icon-wrap a:hover i {
			' . react_css_color($options['general_color_subfooter_link_hover'], 'color') . '
		}
	';
}
?>

<?php /* Global DeviceMenu Color */ ?>
<?php
if ($options['general_color_device_menu_background'] != '' || $options['general_color_device_menu_text'] != '') {
	echo '
		.sidr {
			' . react_css_color($options['general_color_device_menu_background'], 'background') . '
			' . react_css_color($options['general_color_device_menu_text'], 'color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_link']) {
	echo '
		.sidr a {' . react_css_color($options['general_color_device_menu_link'], 'color') . '}
	';
}
?>
<?php
if ($options['general_color_device_menu_link_hover']) {
	echo '
		.sidr a:hover {' . react_css_color($options['general_color_device_menu_link_hover'], 'color') . '}
	';
}
?>
<?php
if ($options['general_color_device_menu_border']) {
	echo '
		.sidr.left {
			' . react_css_color($options['general_color_device_menu_border'], 'border-color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_border']) {
	echo '
		.sidr.right {
			' . react_css_color($options['general_color_device_menu_border'], 'border-color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_main_background_darker'] != '' || $options['general_color_device_menu_main_background_lighter'] != '') {
	echo '
		.sidr > ul {
			' . react_css_color($options['general_color_device_menu_main_background_darker'], 'border-top-color') . '
			' . react_css_color($options['general_color_device_menu_main_background_lighter'], 'border-bottom-color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_sub_background_darker'] != '' || $options['general_color_device_menu_sub_background_lighter'] != '') {
	echo '
		.sidr > ul > li ul {
			' . react_css_color($options['general_color_device_menu_sub_background_darker'], 'border-top-color') . '
			' . react_css_color($options['general_color_device_menu_sub_background_lighter'], 'border-bottom-color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_main_background_lighter'] != '' || $options['general_color_device_menu_main_background_darker'] != '') {
	echo '
		.sidr > ul li {
			' . react_css_color($options['general_color_device_menu_main_background_lighter'], 'border-top-color') . '
			' . react_css_color($options['general_color_device_menu_main_background_darker'], 'border-bottom-color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_main_link'] != '' || $options['general_color_device_menu_main_background_darker'] != '') {
	echo '
		.sidr .menu-item-has-children .sidr-menu-toggle {
			' . react_css_color($options['general_color_device_menu_main_link'], 'color') . '
			' . react_css_color($options['general_color_device_menu_main_background_darker']) . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_sub_background_lighter'] != '' || $options['general_color_device_menu_sub_background_darker'] != '') {
	echo '
		.sidr > ul li ul li {
			' . react_css_color($options['general_color_device_menu_sub_background_lighter'], 'border-top-color') . '
			' . react_css_color($options['general_color_device_menu_sub_background_darker'], 'border-bottom-color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_main_background'] != '' || $options['general_color_device_menu_main_link'] != '') {
	echo '
		.sidr ul li > a {
			' . react_css_color($options['general_color_device_menu_main_background'], 'background') . '
			' . react_css_color($options['general_color_device_menu_main_link'], 'color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_sub_background'] != '' || $options['general_color_device_menu_sub_link'] != '') {
	echo '
		.sidr ul li ul li > a {
			' . react_css_color($options['general_color_device_menu_sub_background'], 'background') . '
			' . react_css_color($options['general_color_device_menu_sub_link'], 'color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_main_background_lighter'] != '' || $options['general_color_device_menu_main_link_hover'] != '') {
	echo '
		.sidr ul li:hover>a,.sidr ul li:hover>span,.sidr ul li.active>a,.sidr ul li.active>span,.sidr ul li.sidr-class-active>a,.sidr ul li.sidr-class-active>span{
			' . react_css_color($options['general_color_device_menu_main_background_lighter'], 'background') . '
			' . react_css_color($options['general_color_device_menu_main_link_hover'], 'color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_sub_background_lighter'] != '' || $options['general_color_device_menu_sub_link_hover'] != '') {
	echo '
		.sidr ul li ul li:hover>a,.sidr ul li ul li:hover>span,.sidr ul li ul li.active>a,.sidr ul li ul li.active>span,.sidr ul li ul li.sidr-class-active>a,.sidr ul li ul li.sidr-class-active>span{
			' . react_css_color($options['general_color_device_menu_sub_background_lighter'], 'background') . '
			' . react_css_color($options['general_color_device_menu_sub_link_hover'], 'color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_main_desc']) {
	echo '
		.sidr span.desc {
			' . react_css_color($options['general_color_device_menu_main_desc'], 'color') . '
		}
		.sidr ul li:hover > a span.desc {
			' . react_css_color($options['general_color_device_menu_main_desc_hover'], 'color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_sub_desc']) {
	echo '
		.sidr ul li ul li span.desc {
			' . react_css_color($options['general_color_device_menu_sub_desc'], 'color') . '
		}
		.sidr ul li ul li:hover span.desc {
			' . react_css_color($options['general_color_device_menu_sub_desc_hover'], 'color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_border']) {
	echo '
		.sidr-sep {
			' . react_css_color($options['general_color_device_menu_border'], 'border-top-color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_background']) {
	echo '
		.sidr .method {
			' . react_css_color($options['general_color_device_menu_background_lighter'], 'border-top-color') . '
			' . react_css_color($options['general_color_device_menu_background_darker'], 'border-bottom-color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_background']) {
	echo '
		.sidr .sidr-search {
			' . react_css_color($options['general_color_device_menu_background_lighter']) . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_text']) {
	echo '
		.sidr .sidr-search .search-input {
			' . react_css_color($options['general_color_device_menu_text_even_lighter'], 'color') . '
		}
		.sidr .sidr-search .search-input:focus {
			' . react_css_color($options['general_color_device_menu_text'], 'color') . '
		}
	';
}
?>

<?php
if ($options['general_color_device_menu_icons']) {
	echo '
		.sidr .method > span > i, .sidr .contact-info-drop-trigger a i, .sidr .contact-info-drop-trigger i,
		.sidr .social-icon-wrap i, .sidr .social-icon-outer.type-4 .social-icon-wrap a i {' . react_css_color($options['general_color_device_menu_icons'], 'color') . '}
		.sidr .social-icon-outer.type-4 .social-icon-wrap a:hover i {color: #fff;}
	';
}
?>
<?php
if ($options['general_color_device_menu_link']) {
	echo '
		.sidr .method > a {
			' . react_css_color($options['general_color_device_menu_link'], 'color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_link_hover']) {
	echo '
		.sidr .method > a:hover,
		.sidr .method:hover > span > i, .sidr .contact-info-drop-wrap:hover .contact-info-drop-trigger i, .sidr .social-icon-wrap:hover i {
			' . react_css_color($options['general_color_device_menu_link_hover'], 'color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_background'] != '' || $options['general_color_device_menu_text'] != '') {
	echo '
		.sidr .contact-info-drop.open-close-content {
			' . react_css_color($options['general_color_device_menu_background_darker']) . '
			' . react_css_color($options['general_color_device_menu_text'], 'color') . '
		}
	';
}
?>
<?php
if ($options['general_color_device_menu_background_darker']) {
	echo '
		.sidr .contact-info-drop:after {
			' . react_css_color($options['general_color_device_menu_background_darker'], 'border-bottom-color') . '
		}
	';
}
?>
<?php
if ($options['general_color_global_primary_bg'] || $options['general_color_global_primary_fg']) {
	echo '
		.sidr .menu-item-has-children .sidr-menu-toggle.active {
			' . react_css_color($options['general_color_global_primary_bg']) . '
			' . react_css_color($options['general_color_global_primary_fg'], 'color') . '
		}
	';
}
?>



<?php if ($palette = react_get_palette_by_id($options['general_color_subfoot_choose_scheme'] )) : ?>
<?php if ($palette['background'] || $palette['border'] || $palette['text']) { echo '
	#subfooter {
		' . react_css_color($palette['background']) . '
		' . react_css_color($palette['border'], 'border-color') . '
		' . react_css_color($palette['text'], 'color') . '
	}'; } ?>
	<?php if ($palette['background_gradient']) echo '
		#subfooter {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%, ' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['background_even_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['background_even_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%,' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%,' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%,' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%,' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
		}';
	?>
	<?php if ($palette['h1']) echo '#subfooter h1, #subfooter .tcs-fancy-header, #subfooter .tcs-impact-heading {' . react_css_color($palette['h1'], 'color') . ' }'; ?>
	<?php if ($palette['h2']) echo '#subfooter h2 {' . react_css_color($palette['h2'], 'color') . ' }'; ?>
	<?php if ($palette['h3']) echo '#subfooter h3 {' . react_css_color($palette['h3'], 'color') . ' }'; ?>
	<?php if ($palette['h4']) echo '#subfooter h4 {' . react_css_color($palette['h4'], 'color') . ' }'; ?>
	<?php if ($palette['h5']) echo '#subfooter h5, #subfooter h6 {' . react_css_color($palette['h5'], 'color') . ' }'; ?>
	<?php if ($palette['link']) echo '
	.subfooter-wrap a, #subfooter ul.menu li ul a,
	#subfooter .social-icon-outer.type-2 .social-icon-wrap a i,
	#subfooter .social-icon-outer.type-4 a i
	{' . react_css_color($palette['link'], 'color') . ' }'; ?>
	<?php if ($palette['link_hover']) echo '
	.subfooter-wrap a:hover, .subfooter-wrap a:active, #subfooter ul.menu li ul a:hover, .subfooter-wrap a.subtle-link:hover, #subfooter span.subtle-link:hover,
	#subfooter .social-icon-outer.type-2 .social-icon-wrap a:hover i
	{' . react_css_color($palette['link_hover'], 'color') . ' }'; ?>

	.qtip.qtip-default.qtip-react.subfoot-tip {
		<?php if ($palette['dark_bg_darker']) echo '' . react_css_color($palette['dark_bg_darker']) . ''; ?>
		<?php if ($palette['dark_fg']) echo '' . react_css_color($palette['dark_fg'], 'color') . ''; ?>
		<?php if ($palette['dark_bg_even_darker']) echo '' . react_css_color($palette['dark_bg_even_darker'], 'border-color') . ''; ?>
	}

	<?php if ($palette['dark_bg'] || $palette['dark_fg']) { echo '

	#subfooter #audio-controls span.label,
	#subfooter #video-controls span.label,
	#subfooter #fs-controls span.label,
	#footer-logo-info-wrap,
	.back-to-top, .go-down, #subfooter-toggle {
		' . react_css_color($palette['dark_bg_darker']) . '
		' . react_css_color($palette['dark_fg'], 'color') . '
	}
	#footer-logo-info-wrap:after {' . react_css_color($palette['dark_bg_darker'], 'border-top-color') . '}
	'; } ?>

	<?php if ($palette['dark_bg'] || $palette['dark_fg']) { echo '
	#subfooter #fs-controls,
	#subfooter #video-controls,
	#subfooter #audio-controls,
	#subfooter .x-close {
		' . react_css_color($palette['dark_bg']) . '
		' . react_css_color($palette['dark_fg'], 'color') . '
	}'; } ?>

	<?php if ($palette['dark_bg']) echo '
	#subfooter #fs-controls:hover:after,
	#subfooter #video-controls:hover:after,
	#subfooter #audio-controls:hover:after {
		' . react_css_color($palette['dark_bg'], 'border-left-color') . '
	}'; ?>

	<?php if ($palette['dark_bg_gradient']) echo '
		#subfooter #fs-controls,
		#subfooter #video-controls,
		#subfooter #audio-controls,
		.back-to-top, .go-down, #subfooter-toggle,
		#footer-logo-info-wrap {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%, ' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['dark_bg']) . '), color-stop(100%,' . react_sanitize_color($palette['dark_bg_even_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
	}'; ?>

	<?php if ($palette['primary_bg']) echo '
	#subfooter #audio-controls, #subfooter #video-controls, #subfooter #fs-controls {' . react_css_color($palette['primary_bg'], 'border-right-color') . '}
	'; ?>

	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	.back-to-top:hover, .go-down:hover, #subfooter-toggle:hover,
	.roc-bottom .back-to-top,
	#subfooter .x-close:hover {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; } ?>


	<?php if ($palette['primary_bg_gradient']) echo '
	.back-to-top:hover, .go-down:hover, #subfooter-toggle:hover, .roc-bottom .back-to-top {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%, ' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['primary_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['primary_bg_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
	}'; ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	#subfooter ::-moz-selection {
		background-color: ' . react_sanitize_color($palette['primary_bg']) . ';
		color: ' . react_sanitize_color($palette['primary_fg']) . ';
	}
	#subfooter ::selection {
		background-color: ' . react_sanitize_color($palette['primary_bg']) . ';
		color: ' . react_sanitize_color($palette['primary_fg']) . ';
	}
	#subfooter .highlighted-text, #subfooter .tcs-highlighted-text, #subfooter mark, body.react-wp #subfooter .mejs-controls .mejs-time-rail .mejs-time-current  {
		background-color: ' . react_sanitize_color($palette['primary_bg']) . ';
		color: ' . react_sanitize_color($palette['primary_fg']) . ';
	}'; } ?>

	<?php if ($palette['dark_icon']) echo '
		.back-to-top a.scroll-top i, .go-down a.scroll-down i, #subfooter-toggle:before {
			' . react_css_color($palette['dark_icon'], 'color') . '
		}
	';
	?>
	<?php if ($palette['dark_icon_image'] == 'dark') echo '


		.audio-play, .fs-play, .video-play {
			background-image: url(../../react/images/play.png);
		}
		.audio-pause, .fs-pause, .video-pause {
			background-image: url(../../react/images/pause.png);
		}
		.audio-mute, .video-mute {
			background-image: url(../../react/images/no-sound.png);
		}
		.audio-unmute, .video-unmute {
			background-image: url(../../react/images/sound.png);
		}
		.audio-prev, .fs-prev, .video-prev {
			background-image: url(../../react/images/backward.png);
		}
		.audio-next, .fs-next, .video-next {
			background-image: url(../../react/images/forward.png);
		}
		.fs-max, .video-full-screen {
			background-image: url(../../react/images/fs-max.png);
		}
		#subfooter .x-close {
			background-image: url(../../react/images/x-close-dark.png);
		}


		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {

			.audio-pause, .video-pause, .fs-pause {
				background-image: url(../../react/images/pause@2x.png);
				background-size: 21px 19px;
			}
			.audio-play, .video-play, .fs-play {
				background-image: url(../../react/images/play@2x.png);
				background-size: 21px 19px;
			}
			.audio-next, .video-next, .fs-next {
				background-image: url(../../react/images/forward@2x.png);
				background-size: 21px 19px;
			}
			.audio-prev, .video-prev, .fs-prev {
				background-image: url(../../react/images/backward@2x.png);
				background-size: 21px 19px;
			}
			.audio-mute, .video-mute {
				background-image: url(../../react/images/no-sound@2x.png);
				background-size: 21px 19px;
			}
			.audio-unmute, .video-unmute {
				background-image: url(../../react/images/sound@2x.png);
				background-size: 21px 19px;
			}
			.video-full-screen, .fs-max {
				background-image: url(../../react/images/fs-max@2x.png);
				background-size: 21px 19px;
			}
			#subfooter .x-close {
				background-image: url(../../react/images/x-close-dark@2x.png);
				background-size: 16px 16px;
			}
		} ';
	?>
	<?php if ($palette['primary_icon']) echo '
		.back-to-top a.scroll-top:hover i, .go-down a.scroll-down:hover i, .roc-bottom .back-to-top a i, #subfooter-toggle:hover:before {
			' . react_css_color($palette['primary_icon'], 'color') . '
		}
	';
	?>
	<?php if ($palette['primary_icon_image'] == 'dark') echo '
		#fs-controls i.iconsprite, #audio-controls i.iconsprite, #video-controls i.iconsprite {
			background-image: url(../../react/images/icons/sprites-16-dark.png);
		}
		#subfooter .x-close:hover {
			background-image: url(../../react/images/x-close-dark.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			#fs-controls i.iconsprite, #audio-controls i.iconsprite, #video-controls i.iconsprite {
				background-image: url(../../react/images/icons/sprites-32-dark.png);
				background-size: 496px 240px;
			}
			#subfooter .x-close:hover {
				background-image: url(../../react/images/x-close-dark@2x.png);
				background-size: 16px 16px;
			}
		}
		';
		elseif ($palette['primary_icon_image'] == 'light') echo '
		#fs-controls i.iconsprite, #audio-controls i.iconsprite, #video-controls i.iconsprite {
			background-image: url(../../react/images/icons/sprites-16-light.png);
		}
		#subfooter .x-close:hover {
			background-image: url(../../react/images/x-close-light.png);
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			#fs-controls i.iconsprite, #audio-controls i.iconsprite, #video-controls i.iconsprite {
				background-image: url(../../react/images/icons/sprites-32-light.png);
				background-size: 496px 240px;
			}
			#subfooter .x-close:hover {
				background-image: url(../../react/images/x-close-light@2x.png);
				background-size: 16px 16px;
			}
		}

		';
	?>


<?php endif; ?>


<?php /* New Popdown */ ?>
<?php if ($palette = react_get_palette_by_id($options['general_color_popdown_choose_scheme'] )) : ?>

	<?php /* With box shadows Color buttons - PRIME color */ ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	#popdown-trigger, body.pop-trig-abso #popdown-trigger, .dismissed #popdown-trigger {
		' . react_css_color($palette['primary_bg'], 'background') . '
		' . react_css_color($palette['primary_fg'], 'color') . '
		-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
		 box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
	}'; } ?>
	<?php
		if ($palette['primary_bg']) {
			echo '
			#popdown-trigger:hover, body.pop-trig-abso #popdown-trigger:hover, .dismissed #popdown-trigger:hover {
				-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']). ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
				 box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']). ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
				 ' . react_css_color($palette['primary_bg_lighter']) . '
				 ' . react_css_color($palette['primary_fg'], 'color') . '
			}';
		}
	?>

	<?php if ($palette['primary_bg']) echo 'body.pop-trig-abso #popdown-trigger:after {
		' . react_css_color($palette['primary_bg'], 'border-bottom-color') . '
	}'; ?>
	<?php if ($palette['primary_bg_lighter']) echo 'body.pop-trig-abso #popdown-trigger:hover:after {
		' . react_css_color($palette['primary_bg_lighter'], 'border-bottom-color') . '
	}'; ?>
	<?php if ($palette['primary_bg_gradient']) echo '
	#popdown-trigger, body.pop-trig-abso .popdown -trigger, .dismissed #popdown-trigger,
	#popdown-trigger:hover, body.pop-trig-abso #popdown-trigger:hover, .dismissed #popdown-trigger:hover {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%, ' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['primary_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['primary_bg_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
	}
	body.pop-trig-abso #popdown-trigger:after {
	' . react_css_color($palette['primary_bg_lighter'], 'border-bottom-color') . '
	}
	'; ?>

	<?php if ($palette['primary_fg']) echo '
	#popdown-trigger h3 {
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; ?>
	<?php if ($palette['primary_icon']) echo '
	#popdown-trigger i {
		' . react_css_color($palette['primary_icon'], 'color') . '
	}'; ?>

<?php endif; ?>




















<?php if ($palette = react_get_palette_by_id($options['general_color_infomenu_popout_choose_scheme'] )) : ?>
	<?php /* BACKGROUND colors */ ?>

	<?php if ($palette['background_darker']) echo '
	.im-drop .search-container:hover {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}'; ?>
	<?php if ($palette['light_bg'] || $palette['light_fg']) { echo '
	.im-drop .search-container,
	.im-drop .search-container .search-input-wrap input {
		' . react_css_color($palette['light_bg'], 'background') . '
		' . react_css_color($palette['light_fg'], 'color') . '
	}
	.im-drop .search-container {
				box-shadow: 0 -3px 0 0 ' . react_sanitize_color($palette['light_bg_even_darker']) . ' inset;
	}'; } ?>
	<?php if ($palette['background'] || $palette['border'] || $palette['text']) { echo '
	.im-drop.im-box {
		' . react_css_color($palette['background']) . '
		' . react_css_color($palette['border'], 'border-color') . '
		' . react_css_color($palette['text'], 'color') . '
	}
	.im-drop:after {
		' . react_css_color($palette['border'], 'border-bottom-color') . '
	}
	'; } ?>
	<?php if ($palette['background_gradient']) echo '
	.im-drop {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%, ' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['background_even_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['background_even_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%,' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%,' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%,' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%,' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
	}';
	?>
<?php endif; ?>
<?php if ($palette = react_get_palette_by_id($options['general_color_infomenu_slideout_choose_scheme'] )) : ?>
	<?php /* BACKGROUND colors */ ?>

	<?php if ($palette['background_darker']) echo '
	.slide-out-box .search-container:hover {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}'; ?>
	<?php if ($palette['light_bg'] || $palette['light_fg']) { echo '
	.slide-out-box .search-container,
	.slide-out-box .search-container .search-input-wrap input {
		' . react_css_color($palette['light_bg'], 'background') . '
		' . react_css_color($palette['light_fg'], 'color') . '
	}
	.slide-out-box .search-container {
				box-shadow: 0 -3px 0 0 ' . react_sanitize_color($palette['light_bg_even_darker']) . ' inset;
	}'; } ?>
	<?php if ($palette['background'] || $palette['border'] || $palette['text']) { echo '
	.slide-out-box {
		' . react_css_color($palette['background']) . '
		' . react_css_color($palette['border'], 'border-color') . '
		' . react_css_color($palette['text'], 'color') . '
	}
	'; } ?>
	<?php if ($palette['background_gradient']) echo '
	.slide-out-box {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%, ' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['background_even_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['background_even_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%,' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%,' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%,' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['background_even_lighter']) . ' 0%,' . react_sanitize_color($palette['background_even_darker']) . ' 100%);
	}';
	?>
<?php endif; ?>




<?php if ($palette = react_get_palette_by_id($options['general_color_mainhead_submenu_choose_scheme'] )) : ?>
	<?php if ($palette['background'] || $palette['primary_bg'] || $palette['text']) { echo '
		#header #nav-wrap ul.react-menu ul.sub-menu {
			' . react_css_color($palette['background']) . '
			' . react_css_color($palette['primary_bg'], 'border-color') . '
			' . react_css_color($palette['text'], 'color') . '
		}
		#header #nav-wrap .react-menu > li > ul.sub-menu:after {' . react_css_color($palette['primary_bg'], 'border-left-color') . '}
		#header #nav-wrap ul.react-menu ul.sub-menu li {
			' . react_css_color($palette['text'], 'color') . '
			' . react_css_color($palette['background']) . '
		}
		#header #nav-wrap ul.react-menu ul.sub-menu li:hover,
		#header #nav-wrap ul.react-menu ul.sub-menu li.sfHover {
			' . react_css_color($palette['text'], 'color') . '
			' . react_css_color($palette['background_darker']) . '
		}
		#header #nav-wrap ul.react-menu ul.sub-menu li a {
			' . react_css_color($palette['link'], 'color') . '
			' . react_css_color($palette['background']) . '
		}
		#header #nav-wrap ul.react-menu ul.sub-menu li a:hover, #header #nav-wrap ul.react-menu ul.sub-menu li a:hover,
		#header #nav-wrap ul.react-menu ul.sub-menu li.sfHover > a {
			' . react_css_color($palette['link_hover'], 'color') . '
			' . react_css_color($palette['background_darker']) . '
		}
	'; } ?>
	<?php if ($palette['dark_fg'] || $palette['dark_bg']) { echo '
		#header #nav-wrap ul.react-menu ul.sub-menu li.menu-icon.box:before {
			' . react_css_color($palette['dark_fg'], 'color') . '
			' . react_css_color($palette['dark_bg'], 'background') . '
		}
	'; } ?>
	<?php if ($palette['primary_bg_gradient']) echo '
		#header #nav-wrap ul.react-menu ul.sub-menu li.menu-icon.box:before {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%, ' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['primary_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['primary_bg_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
	}';
	?>
	<?php if ($palette['primary_fg'] || $palette['primary_bg']) { echo '
		#header #nav-wrap ul.react-menu ul.sub-menu li.menu-icon.box:hover:before {
			' . react_css_color($palette['primary_fg'], 'color') . '
			' . react_css_color($palette['primary_bg'], 'background') . '
		}
	'; } ?>
	<?php if ($palette['primary_bg_gradient']) echo '
		#header #nav-wrap ul.react-menu ul.sub-menu li.menu-icon.box:hover:before {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%, ' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['dark_bg']) . '), color-stop(100%,' . react_sanitize_color($palette['dark_bg_even_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
		}';
	?>
	<?php if ($palette['background_icon_image'] == 'light') echo '
		#header #nav-wrap ul.react-menu ul.sub-menu .sf-with-ul:after,
		#header #nav-wrap ul.react-menu ul.sub-menu .sf-with-ul .after {
			background-image: url(../../react/images/sml-right-arrow-light.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			#header #nav-wrap ul.react-menu ul.sub-menu .sf-with-ul:after,
			#header #nav-wrap ul.react-menu ul.sub-menu .sf-with-ul .after {
				background-image: url(../../react/images/sml-right-arrow-light@2x.png);
			}
		}
	';
	elseif ($palette['background_icon_image'] == 'dark') echo '
		#header #nav-wrap ul.react-menu ul.sub-menu .sf-with-ul:after,
		#header #nav-wrap ul.react-menu ul.sub-menu .sf-with-ul .after {
			background-image: url(../../react/images/sml-right-arrow-dark.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			#header #nav-wrap ul.react-menu ul.sub-menu .sf-with-ul:after,
			#header #nav-wrap ul.react-menu ul.sub-menu .sf-with-ul .after {
				background-image: url(../../react/images/sml-right-arrow-dark@2x.png);
			}
		}
	'; ?>

<?php endif; ?>



<?php if ($palette = react_get_palette_by_id($options['general_color_tophead_submenu_choose_scheme'] )) : ?>
	<?php if ($palette['background'] || $palette['primary_bg'] || $palette['text']) { echo '
		#tophead ul.react-menu ul.sub-menu {
			' . react_css_color($palette['background']) . '
			' . react_css_color($palette['primary_bg'], 'border-color') . '
			' . react_css_color($palette['text'], 'color') . '
		}
		#tophead .react-menu > li > ul.sub-menu:after {' . react_css_color($palette['primary_bg'], 'border-left-color') . '}
		#tophead ul.react-menu ul.sub-menu li {
			' . react_css_color($palette['text'], 'color') . '
			' . react_css_color($palette['background']) . '
		}
		#tophead ul.react-menu ul.sub-menu li:hover,
		#tophead ul.react-menu ul.sub-menu li.sfHover {
			' . react_css_color($palette['text'], 'color') . '
			' . react_css_color($palette['background_touch_darker']) . '
		}
		#tophead ul.react-menu ul.sub-menu li a {
			' . react_css_color($palette['link'], 'color') . '
			' . react_css_color($palette['background']) . '
		}
		#tophead ul.react-menu ul.sub-menu li a:hover, #tophead ul.react-menu ul.sub-menu li a:hover,
		#tophead ul.react-menu ul.sub-menu li.sfHover > a {
			' . react_css_color($palette['link_hover'], 'color') . '
			' . react_css_color($palette['background_touch_darker']) . '
		}
	'; } ?>
	<?php if ($palette['dark_fg'] || $palette['dark_bg']) { echo '
		#tophead ul.react-menu ul.sub-menu li.menu-icon.box:before {
			' . react_css_color($palette['dark_fg'], 'color') . '
			' . react_css_color($palette['dark_bg'], 'background') . '
		}
	'; } ?>
	<?php if ($palette['primary_bg_gradient']) echo '
		#tophead ul.react-menu ul.sub-menu li.menu-icon.box:before {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%, ' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['primary_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['primary_bg_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
	}';
	?>
	<?php if ($palette['primary_fg'] || $palette['primary_bg']) { echo '
		#tophead ul.react-menu ul.sub-menu li.menu-icon.box:hover:before {
			' . react_css_color($palette['primary_fg'], 'color') . '
			' . react_css_color($palette['primary_bg'], 'background') . '
		}
	'; } ?>
	<?php if ($palette['primary_bg_gradient']) echo '
		#tophead ul.react-menu ul.sub-menu li.menu-icon.box:hover:before {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%, ' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['dark_bg']) . '), color-stop(100%,' . react_sanitize_color($palette['dark_bg_even_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
		}';
	?>
	<?php if ($palette['background_icon_image'] == 'light') echo '
		#tophead ul.react-menu ul.sub-menu .sf-with-ul:after,
		#tophead ul.react-menu ul.sub-menu .sf-with-ul .after {
			background-image: url(../../react/images/sml-right-arrow-light.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			#tophead ul.react-menu ul.sub-menu .sf-with-ul:after,
			#tophead ul.react-menu ul.sub-menu .sf-with-ul .after {
				background-image: url(../../react/images/sml-right-arrow-light@2x.png);
			}
		}
	';
	elseif ($palette['background_icon_image'] == 'dark') echo '
		#tophead ul.react-menu ul.sub-menu .sf-with-ul:after,
		#tophead ul.react-menu ul.sub-menu .sf-with-ul .after {
			background-image: url(../../react/images/sml-right-arrow-dark.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			#tophead ul.react-menu ul.sub-menu .sf-with-ul:after,
			#tophead ul.react-menu ul.sub-menu .sf-with-ul .after {
				background-image: url(../../react/images/sml-right-arrow-dark@2x.png);
			}
		}
	'; ?>

<?php endif; ?>







<?php if ($palette = react_get_palette_by_id($options['general_color_solonav_submenu_choose_scheme'] )) : ?>
	<?php if ($palette['background'] || $palette['primary_bg'] || $palette['text']) { echo '
		#solonav .solonav-wrap ul.react-menu ul.sub-menu {
			' . react_css_color($palette['background']) . '
			' . react_css_color($palette['primary_bg'], 'border-color') . '
			' . react_css_color($palette['text'], 'color') . '
		}
		#solonav .solonav-wrap .react-menu > li > ul.sub-menu:after {' . react_css_color($palette['primary_bg'], 'border-left-color') . '}
		#solonav .solonav-wrap ul.react-menu ul.sub-menu li {
			' . react_css_color($palette['text'], 'color') . '
			' . react_css_color($palette['background']) . '
		}
		#solonav .solonav-wrap ul.react-menu ul.sub-menu li:hover,
		#solonav .solonav-wrap ul.react-menu ul.sub-menu li.sfHover {
			' . react_css_color($palette['text'], 'color') . '
			' . react_css_color($palette['background_touch_darker']) . '
		}
		#solonav .solonav-wrap ul.react-menu ul.sub-menu li a {
			' . react_css_color($palette['link'], 'color') . '
			' . react_css_color($palette['background']) . '
		}
		#solonav .solonav-wrap ul.react-menu ul.sub-menu li a:hover, #solonav .solonav-wrap ul.react-menu ul.sub-menu li a:hover,
		#solonav .solonav-wrap ul.react-menu ul.sub-menu li.sfHover > a {
			' . react_css_color($palette['link_hover'], 'color') . '
			' . react_css_color($palette['background_touch_darker']) . '
		}
	'; } ?>
	<?php if ($palette['dark_fg'] || $palette['dark_bg']) { echo '
		#solonav .solonav-wrap ul.react-menu ul.sub-menu li.menu-icon.box:before {
			' . react_css_color($palette['dark_fg'], 'color') . '
			' . react_css_color($palette['dark_bg'], 'background') . '
		}
	'; } ?>
	<?php if ($palette['primary_bg_gradient']) echo '
		#solonav .solonav-wrap ul.react-menu ul.sub-menu li.menu-icon.box:before {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%, ' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['primary_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['primary_bg_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
	}';
	?>
	<?php if ($palette['primary_fg'] || $palette['primary_bg']) { echo '
		#solonav .solonav-wrap ul.react-menu ul.sub-menu li.menu-icon.box:hover:before {
			' . react_css_color($palette['primary_fg'], 'color') . '
			' . react_css_color($palette['primary_bg'], 'background') . '
		}
	'; } ?>
	<?php if ($palette['primary_bg_gradient']) echo '
		#solonav .solonav-wrap ul.react-menu ul.sub-menu li.menu-icon.box:hover:before {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%, ' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['dark_bg']) . '), color-stop(100%,' . react_sanitize_color($palette['dark_bg_even_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
		}';
	?>
	<?php if ($palette['background_icon_image'] == 'light') echo '
		#solonav .solonav-wrap ul.react-menu ul.sub-menu .sf-with-ul:after,
		#solonav .solonav-wrap ul.react-menu ul.sub-menu .sf-with-ul .after {
			background-image: url(../../react/images/sml-right-arrow-light.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			#solonav .solonav-wrap ul.react-menu ul.sub-menu .sf-with-ul:after,
			#solonav .solonav-wrap ul.react-menu ul.sub-menu .sf-with-ul .after {
				background-image: url(../../react/images/sml-right-arrow-light@2x.png);
			}
		}
	';
	elseif ($palette['background_icon_image'] == 'dark') echo '
		#solonav .solonav-wrap ul.react-menu ul.sub-menu .sf-with-ul:after,
		#solonav .solonav-wrap ul.react-menu ul.sub-menu .sf-with-ul .after {
			background-image: url(../../react/images/sml-right-arrow-dark.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			#solonav .solonav-wrap ul.react-menu ul.sub-menu .sf-with-ul:after,
			#solonav .solonav-wrap ul.react-menu ul.sub-menu .sf-with-ul .after {
				background-image: url(../../react/images/sml-right-arrow-dark@2x.png);
			}
		}
	'; ?>

<?php endif; ?>








<?php /* Other colors */ ?>
<?php
	if ($options['general_color_page_loader']) {
		echo '
		.pace .pace-progress,
		.page-loader-inner.spinning-balls:after,
		.page-loader-inner.spinning-balls:before,
		.page-loader-spinkit .sk-rotating-plane,
		.page-loader-spinkit .sk-double-bounce .sk-child,
		.page-loader-spinkit .sk-wave .sk-rect,
		.page-loader-spinkit .sk-wandering-cubes .sk-cube,
		.page-loader-spinkit .sk-spinner-pulse,
		.page-loader-spinkit .sk-chasing-dots .sk-child,
		.page-loader-spinkit .sk-three-bounce .sk-child,
		.page-loader-spinkit .sk-circle .sk-child:before,
		.page-loader-spinkit .sk-cube-grid .sk-cube,
		.page-loader-spinkit .sk-fading-circle .sk-circle:before,
		.page-loader-spinkit .sk-folding-cube .sk-cube:before {' . react_css_color($options['general_color_page_loader']) . '}

		.page-loader-inner.spinner:after, .page-loader-inner.spinner:before, .page-loader-inner.spinner {' . react_css_color($options['general_color_page_loader'], 'border-top-color') . '}
		';
	}
	if ($options['general_color_page_loader_bg']) {
		echo '
		.js .page-loader {' . react_css_color($options['general_color_page_loader_bg'], 'background') . '}
		';
	} else {
		echo '
		.js .page-loader {' . react_css_color($options['general_color_site_background'], 'background') . '}
		';
	}
?>
<?php
	if ($options['general_color_red_bg'] !='' || $options['general_color_red_fg'] !='') {
		echo '
		.comments-link a b:after, .im-woocart-count:after {' . react_css_color($options['general_color_red_bg'], 'border-right-color') . '}
		.comments-link a b,
		.react-vote:hover .count,
		.react-vote .voted.count,
		.im-woocart-count,
		body.react-wp .iphorm-theme-react-default:hover .iphorm-element-wrap label span.iphorm-required,
		body.react-wp .iphorm-theme-react-default .iphorm-element-wrap.iphorm-element-error label span.iphorm-required {' . react_css_color($options['general_color_red_bg'], 'background', '!important') . ' ' . react_css_color($options['general_color_red_fg'], 'color', '!important') . '}
		';
	}
?>

<?php
	if ($options['general_color_blog_icon_default_bg'] !='' || $options['general_color_blog_icon_default_fg'] !='') {
		echo '
		#content > .entry.format-standard .entry-info > div.post-icon {
			' . react_css_color($options['general_color_blog_icon_default_bg']) . '
			' . react_css_color($options['general_color_blog_icon_default_fg'], 'color') . '
		}
		#content > .entry.format-standard > .featured-image-helper .featured-image-link:before,
		#content > .entry.format-standard > .featured-image-helper .featured-image-link:after {
			' . react_css_color($options['general_color_blog_icon_default_bg'], 'background') . '
			' . react_css_color($options['general_color_blog_icon_default_fg'], 'color') . '
		}
		#content > .entry.format-standard.format-standard:hover .featured-image-wrap {
			' . react_css_color($options['general_color_blog_icon_default_bg'], 'border-bottom-color') . '
		}
		#content > .entry.format-standard .entry-info > div.post-icon:first-child:after {
			' . react_css_color($options['general_color_blog_icon_default_bg'], 'border-top-color') . '
		}
		';
	}
	if ($options['general_color_blog_icon_aside_bg'] !='' || $options['general_color_blog_icon_aside_fg'] !='') {
		echo '
		#content > .entry.format-aside .entry-info > div.post-icon {
			' . react_css_color($options['general_color_blog_icon_aside_bg']) . '
			' . react_css_color($options['general_color_blog_icon_aside_fg'], 'color') . '
		}
		#content > .entry.format-aside > .featured-image-helper .featured-image-link:before,
		#content > .entry.format-aside > .featured-image-helper .featured-image-link:after {
			' . react_css_color($options['general_color_blog_icon_aside_bg'], 'background') . '
			' . react_css_color($options['general_color_blog_icon_aside_fg'], 'color') . '
		}
		#content > .entry.format-aside:hover .featured-image-wrap {
			' . react_css_color($options['general_color_blog_icon_aside_bg'], 'border-bottom-color') . '
		}
		#content > .entry.format-aside .entry-info > div.post-icon:first-child:after {
			' . react_css_color($options['general_color_blog_icon_aside_bg'], 'border-top-color') . '
		}
		';
	}
	if ($options['general_color_blog_icon_audio_bg'] !='' || $options['general_color_blog_icon_audio_fg'] !='') {
		echo '
		#content > .entry.format-audio .entry-info > div.post-icon {
			' . react_css_color($options['general_color_blog_icon_audio_bg']) . '
			' . react_css_color($options['general_color_blog_icon_audio_fg'], 'color') . '
		}
		#content > .entry.format-audio > .featured-image-helper .featured-image-link:before,
		#content > .entry.format-audio > .featured-image-helper .featured-image-link:after {
			' . react_css_color($options['general_color_blog_icon_audio_bg'], 'background') . '
			' . react_css_color($options['general_color_blog_icon_audio_fg'], 'color') . '
		}
		#content > .entry.format-audio:hover .featured-image-wrap {
			' . react_css_color($options['general_color_blog_icon_audio_bg'], 'border-bottom-color') . '
		}
		#content > .entry.format-audio .entry-info > div.post-icon:first-child:after {
			' . react_css_color($options['general_color_blog_icon_audio_bg'], 'border-top-color') . '
		}
		';
	}
	if ($options['general_color_blog_icon_link_bg'] !='' || $options['general_color_blog_icon_link_fg'] !='') {
		echo '
		#content > .entry.format-link .entry-info > div.post-icon {
			' . react_css_color($options['general_color_blog_icon_link_bg']) . '
			' . react_css_color($options['general_color_blog_icon_link_fg'], 'color') . '
		}
		#content > .entry.format-link > .featured-image-helper .featured-image-link:before,
		#content > .entry.format-link > .featured-image-helper .featured-image-link:after {
			' . react_css_color($options['general_color_blog_icon_link_bg'], 'background') . '
			' . react_css_color($options['general_color_blog_icon_link_fg'], 'color') . '
		}
		#content > .entry.format-link:hover .featured-image-wrap {
			' . react_css_color($options['general_color_blog_icon_link_bg'], 'border-bottom-color') . '
		}
		#content > .entry.format-link .entry-info > div.post-icon:first-child:after {
			' . react_css_color($options['general_color_blog_icon_link_bg'], 'border-top-color') . '
		}
		';
	}
	if ($options['general_color_blog_icon_gallery_bg'] !='' || $options['general_color_blog_icon_gallery_fg'] !='') {
		echo '
		#content > .entry.format-gallery .entry-info > div.post-icon {
			' . react_css_color($options['general_color_blog_icon_gallery_bg']) . '
			' . react_css_color($options['general_color_blog_icon_gallery_fg'], 'color') . '
		}
		#content > .entry.format-gallery > .featured-image-helper .featured-image-link:before,
		#content > .entry.format-gallery > .featured-image-helper .featured-image-link:after {
			' . react_css_color($options['general_color_blog_icon_gallery_bg'], 'background') . '
			' . react_css_color($options['general_color_blog_icon_gallery_fg'], 'color') . '
		}
		#content > .entry.format-gallery:hover .featured-image-wrap {
			' . react_css_color($options['general_color_blog_icon_gallery_bg'], 'border-bottom-color') . '
		}
		#content > .entry.format-gallery .entry-info > div.post-icon:first-child:after {
			' . react_css_color($options['general_color_blog_icon_gallery_bg'], 'border-top-color') . '
		}
		';
	}
	if ($options['general_color_blog_icon_quote_bg'] !='' || $options['general_color_blog_icon_quote_fg'] !='') {
		echo '
		#content > .entry.format-quote .entry-info > div.post-icon {
			' . react_css_color($options['general_color_blog_icon_quote_bg']) . '
			' . react_css_color($options['general_color_blog_icon_quote_fg'], 'color') . '
		}
		#content > .entry.format-quote > .featured-image-helper .featured-image-link:before,
		#content > .entry.format-quote > .featured-image-helper .featured-image-link:after {
			' . react_css_color($options['general_color_blog_icon_quote_bg'], 'background') . '
			' . react_css_color($options['general_color_blog_icon_quote_fg'], 'color') . '
		}
		#content > .entry.format-quote:hover .featured-image-wrap {
			' . react_css_color($options['general_color_blog_icon_quote_bg'], 'border-bottom-color') . '
		}
		#content > .entry.format-quote .entry-info > div.post-icon:first-child:after {
			' . react_css_color($options['general_color_blog_icon_quote_bg'], 'border-top-color') . '
		}
		';
	}
	if ($options['general_color_blog_icon_status_bg'] !='' || $options['general_color_blog_icon_status_fg'] !='') {
		echo '
		#content > .entry.format-status .entry-info > div.post-icon {
			' . react_css_color($options['general_color_blog_icon_status_bg']) . '
			' . react_css_color($options['general_color_blog_icon_status_fg'], 'color') . '
		}
		#content > .entry.format-status > .featured-image-helper .featured-image-link:before,
		#content > .entry.format-status > .featured-image-helper .featured-image-link:after {
			' . react_css_color($options['general_color_blog_icon_status_bg'], 'background') . '
			' . react_css_color($options['general_color_blog_icon_status_fg'], 'color') . '
		}
		#content > .entry.format-status:hover .featured-image-wrap {
			' . react_css_color($options['general_color_blog_icon_status_bg'], 'border-bottom-color') . '
		}
		#content > .entry.format-status .entry-info > div.post-icon:first-child:after {
			' . react_css_color($options['general_color_blog_icon_status_bg'], 'border-top-color') . '
		}
		';
	}
	if ($options['general_color_blog_icon_image_bg'] !='' || $options['general_color_blog_icon_image_fg'] !='') {
		echo '
		#content > .entry.format-image .entry-info > div.post-icon {
			' . react_css_color($options['general_color_blog_icon_image_bg']) . '
			' . react_css_color($options['general_color_blog_icon_image_fg'], 'color') . '
		}
		#content > .entry.format-image > .featured-image-helper .featured-image-link:before,
		#content > .entry.format-image > .featured-image-helper .featured-image-link:after {
			' . react_css_color($options['general_color_blog_icon_image_bg'], 'background') . '
			' . react_css_color($options['general_color_blog_icon_image_fg'], 'color') . '
		}
		#content > .entry.format-image:hover .featured-image-wrap {
			' . react_css_color($options['general_color_blog_icon_image_bg'], 'border-bottom-color') . '
		}
		#content > .entry.format-image .entry-info > div.post-icon:first-child:after {
			' . react_css_color($options['general_color_blog_icon_image_bg'], 'border-top-color') . '
		}
		';
	}
	if ($options['general_color_blog_icon_video_bg'] !='' || $options['general_color_blog_icon_video_fg'] !='') {
		echo '
		#content > .entry.format-video .entry-info > div.post-icon {
			' . react_css_color($options['general_color_blog_icon_video_bg']) . '
			' . react_css_color($options['general_color_blog_icon_video_fg'], 'color') . '
		}
		#content > .entry.format-video > .featured-image-helper .featured-image-link:before,
		#content > .entry.format-video > .featured-image-helper .featured-image-link:after {
			' . react_css_color($options['general_color_blog_icon_video_bg'], 'background') . '
			' . react_css_color($options['general_color_blog_icon_video_fg'], 'color') . '
		}
		#content > .entry.format-video:hover .featured-image-wrap {
			' . react_css_color($options['general_color_blog_icon_video_bg'], 'border-bottom-color') . '
		}
		#content > .entry.format-video .entry-info > div.post-icon:first-child:after {
			' . react_css_color($options['general_color_blog_icon_video_bg'], 'border-top-color') . '
		}
		';
	}
	if ($options['general_color_blog_icon_chat_bg'] !='' || $options['general_color_blog_icon_chat_fg'] !='') {
		echo '
		#content > .entry.format-chat .entry-info > div.post-icon {
			' . react_css_color($options['general_color_blog_icon_chat_bg']) . '
			' . react_css_color($options['general_color_blog_icon_chat_fg'], 'color') . '
		}
		#content > .entry.format-chat > .featured-image-helper .featured-image-link:before,
		#content > .entry.format-chat > .featured-image-helper .featured-image-link:after {
			' . react_css_color($options['general_color_blog_icon_chat_bg'], 'background') . '
			' . react_css_color($options['general_color_blog_icon_chat_fg'], 'color') . '
		}
		#content > .entry.format-chat:hover .featured-image-wrap {
			' . react_css_color($options['general_color_blog_icon_chat_bg'], 'border-bottom-color') . '
		}
		#content > .entry.format-chat .entry-info > div.post-icon:first-child:after {
			' . react_css_color($options['general_color_blog_icon_chat_bg'], 'border-top-color') . '
		}
		';
	}
?>
<?php /* Details */ ?>

<?php
/* Textures and details - what happens here: Details, texture and custom img. If custom img, texture takes priority over details (texture off details on). */
/**
 * This array contains the map of texture/detail/custom image data
 *
 * '$key' => array('$selector', '$childSelector', '$subSelector')
 *
 * $key = The dynamic part of the key within the $options array
 * $selector = The CSS selector of the tag that is styled with the texture (required)
 * $childSelector = The CSS selector the tag that is styled with the detail (default is '> div')
 * $subSelector = The CSS selector between $selector and $childSelector (if any)
 */
$textureDetails = array(
	'popdown' => '.popdown',
	'tophead' => '#tophead',
	'mainhead' => '#header',
	'solonav' => '#solonav',
	'content' => '.content-outer',
	'mainfoot' => '.footer',
	'subfoot' => '#subfooter'
);

/**
 * This loop will go through the array above, grab the options from $options
 * and send them to react_get_texture_detail_css to generate the CSS.
 */
foreach ($textureDetails as $key => $textureDetail) {
	$textureDetailData = array(
		'texture' => $options['style_' . $key . '_texture'],
		'texture_opacity' => $options['style_' . $key . '_texture_opacity'],
		'texture_large' => $options['style_' . $key . '_texture_large'],
		'texture_fixed' => $options['style_' . $key . '_texture_fixed'],
		'detail' => $options['style_' . $key . '_detail'],
		'detail_opacity' => $options['style_' . $key . '_detail_opacity'],
		'image' => react_get_upload_url($options['style_' . $key . '_image']),
		'image_width' => $options['style_' . $key . '_image_width'],
		'image_height' => $options['style_' . $key . '_image_height'],
		'image_retina_use_main_img' => $options['style_' . $key . '_image_retina_use_main_img'],
		'image_retina' => react_get_upload_url($options['style_' . $key . '_image_retina']),
		'image_retina_width' => $options['style_' . $key . '_image_retina_width'],
		'image_retina_height' => $options['style_' . $key . '_image_retina_height'],
		'image_is_retina' => $options['style_' . $key . '_image_is_retina'],
		'image_convert' => $options['style_' . $key . '_image_convert'],
		'image_convert_custom' => $options['style_' . $key . '_image_convert_custom'],
		'image_position' => $options['style_' . $key . '_image_position'],
		'image_position_custom' => $options['style_' . $key . '_image_position_custom'],
		'image_repeat' => $options['style_' . $key . '_image_repeat'],
		'image_position_retina' => $options['style_' . $key . '_image_position_retina'],
		'image_position_custom_retina' => $options['style_' . $key . '_image_position_custom_retina'],
		'image_repeat_retina' => $options['style_' . $key . '_image_repeat_retina'],
		'image_fixed' => $options['style_' . $key . '_image_fixed'],
		'image_background_size' => $options['style_' . $key . '_image_background_size'],
		'image_fixed_retina' => $options['style_' . $key . '_image_fixed_retina'],
		'image_background_size_retina' => $options['style_' . $key . '_image_background_size_retina'],
		'image_parallax' => $options['style_' . $key . '_image_parallax'],
		'image_parallax_offset' => $options['style_' . $key . '_image_parallax_offset'],
	);

	echo react_get_texture_detail_css($textureDetailData, $textureDetail);
}
?>


<?php
	if ($options['style_outside_shadow']) {
		echo '
		.top-and-pop:before,
		.slider-wrap:before,
		.popdown-inner-helper:before,
		.header-all:before,
		.after-header-wrap:before,
		.footer-all:before {
			box-shadow: inset -15px 0 15px -15px  rgba(0, 0, 0, 0.' . absint($options['style_outside_shadow_opacity']) . ');
			-webkit-box-shadow: inset -15px 0 15px -15px  rgba(0, 0, 0, 0.' . absint($options['style_outside_shadow_opacity']) . ');
			content: " ";
			left: -15px;
			position: absolute;
			top: 0;
			bottom: 0;
			height: 100%;
			width: 15px;
			z-index: 1;
		}
		.top-and-pop:after,
		.slider-wrap:after,
		.popdown-inner-helper:after,
		.header-all:after,
		.after-header-wrap:after,
		.footer-all:after  {
			box-shadow: inset 15px 0 15px -15px rgba(0, 0, 0, 0.' . absint($options['style_outside_shadow_opacity']) . ');
			-webkit-box-shadow: inset 15px 0 15px -15px rgba(0, 0, 0, 0.' . absint($options['style_outside_shadow_opacity']) . ');
			 content: " ";
			position: absolute;
			top: 0;
			bottom: 0;
			height: 100%;
			right: -15px;
			width: 15px;
			z-index: 1;
		}
		.top-and-pop,
		.slider-wrap,
		.popdown-inner-helper,
		';
		if (!$options['main_header_fixed']) {
			echo '.header-all,';
		}
		echo '
		.after-header-wrap,
		.footer-all {
			position: relative;
		}

		';
	}
?>
<?php
	if ($options['style_full_shadow'] !='') {
		if ($options['style_full_shadow'] == 'style-one') {
		echo '
			.top-and-pop,
			.header-all,
			.slider-wrap,
			.after-header-wrap,
			.footer,
			#subfooter {
				-webkit-box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.' . absint($options['style_full_shadow_opacity']) . ');
				box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.' . absint($options['style_full_shadow_opacity']) . ');
			}
			.top-and-pop {
				-webkit-box-shadow: 0 -7px 15px 0 rgba(0, 0, 0, 0.' . absint($options['style_full_shadow_opacity']) . ');
				box-shadow: 0 -7px 15px 0 rgba(0, 0, 0, 0.' . absint($options['style_full_shadow_opacity']) . ');
			}
			.page-template-template-no-content-style .after-header-wrap {
				-webkit-box-shadow: none;
				box-shadow: none;
			}
		';
		} elseif ($options['style_full_shadow'] == 'style-two') {
		echo '
			.top-and-pop,
			.header-all,
			.slider-wrap,
			.after-header-wrap,
			.footer,
			#subfooter {
				box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.' . absint($options['style_full_shadow_opacity']) . ');
				-webkit-box-shadow: 0 0 30px 0 rgba(0, 0, 0, 0.' . absint($options['style_full_shadow_opacity']) . ');
			}
			.top-and-pop {
				box-shadow: 0 -15px 30px 0 rgba(0, 0, 0, 0.' . absint($options['style_full_shadow_opacity']) . ');
				-webkit-box-shadow: 0 -15px 30px 0 rgba(0, 0, 0, 0.' . absint($options['style_full_shadow_opacity']) . ');
			}
			.page-template-template-no-content-style .after-header-wrap {
				-webkit-box-shadow: none;
				box-shadow: none;
			}
		';
		} elseif ($options['style_full_shadow'] == 'style-three') {
		echo '
			.top-and-pop,
			.header-all,
			.slider-wrap,
			.after-header-wrap,
			.footer,
			#subfooter {
				box-shadow: 0 0 0 10px rgba(0, 0, 0, 0.' . absint($options['style_full_shadow_opacity']) . ');
				-webkit-box-shadow: 0 0 0 10px rgba(0, 0, 0, 0.' . absint($options['style_full_shadow_opacity']) . ');
			}
			.top-and-pop {
				box-shadow: 0 -20px 0 10px rgba(0, 0, 0, 0.' . absint($options['style_full_shadow_opacity']) . ');
				-webkit-box-shadow: 0 -20px 0 10px rgba(0, 0, 0, 0.' . absint($options['style_full_shadow_opacity']) . ');
			}
			.page-template-template-no-content-style .after-header-wrap {
				-webkit-box-shadow: none;
				box-shadow: none;
			}
		';
		}
	}
?>

<?php
	if ($options['header_social_icon_type'] =='type-1' || $options['footer_social_icon_type'] =='type-1') {
		echo '
			/* ----------- FC Icons ----------- */
			/* 500px */
			.no-svg .fc-webicon.f500px { background: url("../../react/images/social/fc-webicons/fc-webicon-500px-m.png"); }
			.no-svg .fc-webicon.f500px.large { background: url("../../react/images/social/fc-webicons/fc-webicon-500px"); }
			.no-svg .fc-webicon.f500px.small { background: url("../../react/images/social/fc-webicons/fc-webicon-500px-s.png"); }
			.svg .fc-webicon.f500px { background: url("../../react/images/social/fc-webicons/fc-webicon-500px.svg"); }

			/* About.me */
			.no-svg .fc-webicon.aboutme { background: url("../../react/images/social/fc-webicons/fc-webicon-aboutme-m.png"); }
			.no-svg .fc-webicon.aboutme.large { background: url("../../react/images/social/fc-webicons/fc-webicon-aboutme.png"); }
			.no-svg .fc-webicon.aboutme.small { background: url("../../react/images/social/fc-webicons/fc-webicon-aboutme-s.png"); }
			.svg .fc-webicon.aboutme { background: url("../../react/images/social/fc-webicons/fc-webicon-aboutme.svg"); }

			/* ADN (App.net) */
			.no-svg .fc-webicon.adn { background: url("../../react/images/social/fc-webicons/fc-webicon-adn-m.png"); }
			.no-svg .fc-webicon.adn.large { background: url("../../react/images/social/fc-webicons/fc-webicon-adn.png"); }
			.no-svg .fc-webicon.adn.small { background: url("../../react/images/social/fc-webicons/fc-webicon-adn-s.png"); }
			.svg .fc-webicon.adn { background: url("../../react/images/social/fc-webicons/fc-webicon-adn.svg"); }

			/* Android */
			.no-svg .fc-webicon.android { background: url("../../react/images/social/fc-webicons/fc-webicon-android-m.png"); }
			.no-svg .fc-webicon.android.large { background: url("../../react/images/social/fc-webicons/fc-webicon-android.png"); }
			.no-svg .fc-webicon.android.small { background: url("../../react/images/social/fc-webicons/fc-webicon-android-s.png"); }
			.svg .fc-webicon.android { background: url("../../react/images/social/fc-webicons/fc-webicon-android.svg"); }

			/* Apple */
			.no-svg .fc-webicon.apple { background: url("../../react/images/social/fc-webicons/fc-webicon-apple-m.png"); }
			.no-svg .fc-webicon.apple.large { background: url("../../react/images/social/fc-webicons/fc-webicon-apple.png"); }
			.no-svg .fc-webicon.apple.small { background: url("../../react/images/social/fc-webicons/fc-webicon-apple-s.png"); }
			.svg .fc-webicon.apple { background: url("../../react/images/social/fc-webicons/fc-webicon-apple.svg"); }

			/* Behance */
			.no-svg .fc-webicon.behance { background: url("../../react/images/social/fc-webicons/fc-webicon-behance-m.png"); }
			.no-svg .fc-webicon.behance.large { background: url("../../react/images/social/fc-webicons/fc-webicon-behance.png"); }
			.no-svg .fc-webicon.behance.small { background: url("../../react/images/social/fc-webicons/fc-webicon-behance-s.png"); }
			.svg .fc-webicon.behance { background: url("../../react/images/social/fc-webicons/fc-webicon-behance.svg"); }

			/* Bitbucket */
			.no-svg .fc-webicon.bitbucket { background: url("../../react/images/social/fc-webicons/fc-webicon-bitbucket-m.png"); }
			.no-svg .fc-webicon.bitbucket.large { background: url("../../react/images/social/fc-webicons/fc-webicon-bitbucket.png"); }
			.no-svg .fc-webicon.bitbucket.small { background: url("../../react/images/social/fc-webicons/fc-webicon-bitbucket-s.png"); }
			.svg .fc-webicon.bitbucket { background: url("../../react/images/social/fc-webicons/fc-webicon-bitbucket.svg"); }

			/* Blogger */
			.no-svg .fc-webicon.blogger { background: url("../../react/images/social/fc-webicons/fc-webicon-blogger-m.png"); }
			.no-svg .fc-webicon.blogger.large { background: url("../../react/images/social/fc-webicons/fc-webicon-blogger.png"); }
			.no-svg .fc-webicon.blogger.small { background: url("../../react/images/social/fc-webicons/fc-webicon-blogger-s.png"); }
			.svg .fc-webicon.blogger { background: url("../../react/images/social/fc-webicons/fc-webicon-blogger.svg"); }

			/* Coderwall */
			.no-svg .fc-webicon.coderwall { background: url("../../react/images/social/fc-webicons/fc-webicon-coderwall-m.png"); }
			.no-svg .fc-webicon.coderwall.large { background: url("../../react/images/social/fc-webicons/fc-webicon-coderwall.png"); }
			.no-svg .fc-webicon.coderwall.small { background: url("../../react/images/social/fc-webicons/fc-webicon-coderwall-s.png"); }
			.svg .fc-webicon.coderwall { background: url("../../react/images/social/fc-webicons/fc-webicon-coderwall.svg"); }

			/* Creative Cloud */
			.no-svg .fc-webicon.creativecloud { background: url("../../react/images/social/fc-webicons/fc-webicon-creativecloud-m.png"); }
			.no-svg .fc-webicon.creativecloud.large { background: url("../../react/images/social/fc-webicons/fc-webicon-creativecloud.png"); }
			.no-svg .fc-webicon.creativecloud.small { background: url("../../react/images/social/fc-webicons/fc-webicon-creativecloud-s.png"); }
			.svg .fc-webicon.creativecloud { background: url("../../react/images/social/fc-webicons/fc-webicon-creativecloud.svg"); }

			/* Dribbble */
			.no-svg .fc-webicon.dribbble { background: url("../../react/images/social/fc-webicons/fc-webicon-dribbble-m.png"); }
			.no-svg .fc-webicon.dribbble.large { background: url("../../react/images/social/fc-webicons/fc-webicon-dribbble.png"); }
			.no-svg .fc-webicon.dribbble.small { background: url("../../react/images/social/fc-webicons/fc-webicon-dribbble-s.png"); }
			.svg .fc-webicon.dribbble { background: url("../../react/images/social/fc-webicons/fc-webicon-dribbble.svg"); }

			/* Dropbox */
			.no-svg .fc-webicon.dropbox { background: url("../../react/images/social/fc-webicons/fc-webicon-dropbox-m.png"); }
			.no-svg .fc-webicon.dropbox.large { background: url("../../react/images/social/fc-webicons/fc-webicon-dropbox.png"); }
			.no-svg .fc-webicon.dropbox.small { background: url("../../react/images/social/fc-webicons/fc-webicon-dropbox-s.png"); }
			.svg .fc-webicon.dropbox { background: url("../../react/images/social/fc-webicons/fc-webicon-dropbox.svg"); }

			/* Evernote */
			.no-svg .fc-webicon.evernote { background: url("../../react/images/social/fc-webicons/fc-webicon-evernote-m.png"); }
			.no-svg .fc-webicon.evernote.large { background: url("../../react/images/social/fc-webicons/fc-webicon-evernote.png"); }
			.no-svg .fc-webicon.evernote.small { background: url("../../react/images/social/fc-webicons/fc-webicon-evernote-s.png"); }
			.svg .fc-webicon.evernote { background: url("../../react/images/social/fc-webicons/fc-webicon-evernote.svg"); }

			/* Fairhead Creative */
			.no-svg .fc-webicon.fairheadcreative { background: url("../../react/images/social/fc-webicons/fc-webicon-fairheadcreative-m.png"); }
			.no-svg .fc-webicon.fairheadcreative.large { background: url("../../react/images/social/fc-webicons/fc-webicon-fairheadcreative"); }
			.no-svg .fc-webicon.fairheadcreative.small { background: url("../../react/images/social/fc-webicons/fc-webicon-fairheadcreative-s.png"); }
			.svg .fc-webicon.fairheadcreative { background: url("../../react/images/social/fc-webicons/fc-webicon-fairheadcreative.svg"); }

			/* Facebook */
			.no-svg .fc-webicon.facebook { background: url("../../react/images/social/fc-webicons/fc-webicon-facebook-m.png"); }
			.no-svg .fc-webicon.facebook.large { background: url("../../react/images/social/fc-webicons/fc-webicon-facebook.png"); }
			.no-svg .fc-webicon.facebook.small { background: url("../../react/images/social/fc-webicons/fc-webicon-facebook-s.png"); }
			.svg .fc-webicon.facebook { background: url("../../react/images/social/fc-webicons/fc-webicon-facebook.svg"); }

			/* Flickr */
			.no-svg .fc-webicon.flickr { background: url("../../react/images/social/fc-webicons/fc-webicon-flickr-m.png"); }
			.no-svg .fc-webicon.flickr.large { background: url("../../react/images/social/fc-webicons/fc-webicon-flickr.png"); }
			.no-svg .fc-webicon.flickr.small { background: url("../../react/images/social/fc-webicons/fc-webicon-flickr-s.png"); }
			.svg .fc-webicon.flickr { background: url("../../react/images/social/fc-webicons/fc-webicon-flickr.svg"); }

			/* Foursquare */
			.no-svg .fc-webicon.foursquare { background: url("../../react/images/social/fc-webicons/fc-webicon-foursquare-m.png"); }
			.no-svg .fc-webicon.foursquare.large { background: url("../../react/images/social/fc-webicons/fc-webicon-foursquare.png"); }
			.no-svg .fc-webicon.foursquare.small { background: url("../../react/images/social/fc-webicons/fc-webicon-foursquare-s.png"); }
			.svg .fc-webicon.foursquare { background: url("../../react/images/social/fc-webicons/fc-webicon-foursquare.svg"); }

			/* Git */
			.no-svg .fc-webicon.git { background: url("../../react/images/social/fc-webicons/fc-webicon-git-m.png"); }
			.no-svg .fc-webicon.git.large { background: url("../../react/images/social/fc-webicons/fc-webicon-git.png"); }
			.no-svg .fc-webicon.git.small { background: url("../../react/images/social/fc-webicons/fc-webicon-git-s.png"); }
			.svg .fc-webicon.git { background: url("../../react/images/social/fc-webicons/fc-webicon-git.svg"); }

			/* Github */
			.no-svg .fc-webicon.github { background: url("../../react/images/social/fc-webicons/fc-webicon-github-m.png"); }
			.no-svg .fc-webicon.github.large { background: url("../../react/images/social/fc-webicons/fc-webicon-github.png"); }
			.no-svg .fc-webicon.github.small { background: url("../../react/images/social/fc-webicons/fc-webicon-github-s.png"); }
			.svg .fc-webicon.github { background: url("../../react/images/social/fc-webicons/fc-webicon-github.svg"); }

			/* Goodreads */
			.no-svg .fc-webicon.goodreads { background: url("../../react/images/social/fc-webicons/fc-webicon-goodreads-m.png"); }
			.no-svg .fc-webicon.goodreads.large { background: url("../../react/images/social/fc-webicons/fc-webicon-goodreads"); }
			.no-svg .fc-webicon.goodreads.small { background: url("../../react/images/social/fc-webicons/fc-webicon-goodreads-s.png"); }
			.svg .fc-webicon.goodreads { background: url("../../react/images/social/fc-webicons/fc-webicon-goodreads.svg"); }

			/* Google Play */
			.no-svg .fc-webicon.googleplay { background: url("../../react/images/social/fc-webicons/fc-webicon-googleplay-m.png"); }
			.no-svg .fc-webicon.googleplay.large { background: url("../../react/images/social/fc-webicons/fc-webicon-googleplay.png"); }
			.no-svg .fc-webicon.googleplay.small { background: url("../../react/images/social/fc-webicons/fc-webicon-googleplay-s.png"); }
			.svg .fc-webicon.googleplay { background: url("../../react/images/social/fc-webicons/fc-webicon-googleplay.svg"); }

			/* Google+ */
			.no-svg .fc-webicon.googleplus { background: url("../../react/images/social/fc-webicons/fc-webicon-googleplus-m.png"); }
			.no-svg .fc-webicon.googleplus.large { background: url("../../react/images/social/fc-webicons/fc-webicon-googleplus.png"); }
			.no-svg .fc-webicon.googleplus.small { background: url("../../react/images/social/fc-webicons/fc-webicon-googleplus-s.png"); }
			.svg .fc-webicon.googleplus { background: url("../../react/images/social/fc-webicons/fc-webicon-googleplus.svg"); }

			/* HTML5 */
			.no-svg .fc-webicon.html5 { background: url("../../react/images/social/fc-webicons/fc-webicon-html5-m.png"); }
			.no-svg .fc-webicon.html5.large { background: url("../../react/images/social/fc-webicons/fc-webicon-html5.png"); }
			.no-svg .fc-webicon.html5.small { background: url("../../react/images/social/fc-webicons/fc-webicon-html5-s.png"); }
			.svg .fc-webicon.html5 { background: url("../../react/images/social/fc-webicons/fc-webicon-html5.svg"); }

			/* iCloud */
			.no-svg .fc-webicon.icloud { background: url("../../react/images/social/fc-webicons/fc-webicon-icloud-m.png"); }
			.no-svg .fc-webicon.icloud.large { background: url("../../react/images/social/fc-webicons/fc-webicon-icloud.png"); }
			.no-svg .fc-webicon.icloud.small { background: url("../../react/images/social/fc-webicons/fc-webicon-icloud-s.png"); }
			.svg .fc-webicon.icloud { background: url("../../react/images/social/fc-webicons/fc-webicon-icloud.svg"); }

			/* Instagram */
			.no-svg .fc-webicon.instagram { background: url("../../react/images/social/fc-webicons/fc-webicon-instagram-m.png"); }
			.no-svg .fc-webicon.instagram.large { background: url("../../react/images/social/fc-webicons/fc-webicon-instagram.png"); }
			.no-svg .fc-webicon.instagram.small { background: url("../../react/images/social/fc-webicons/fc-webicon-instagram-s.png"); }
			.svg .fc-webicon.instagram { background: url("../../react/images/social/fc-webicons/fc-webicon-instagram.svg"); }

			/* Last.fm */
			.no-svg .fc-webicon.lastfm { background: url("../../react/images/social/fc-webicons/fc-webicon-lastfm-m.png"); }
			.no-svg .fc-webicon.lastfm.large { background: url("../../react/images/social/fc-webicons/fc-webicon-lastfm.png"); }
			.no-svg .fc-webicon.lastfm.small { background: url("../../react/images/social/fc-webicons/fc-webicon-lastfm-s.png"); }
			.svg .fc-webicon.lastfm { background: url("../../react/images/social/fc-webicons/fc-webicon-lastfm.svg"); }

			/* LinkedIn */
			.no-svg .fc-webicon.linkedin { background: url("../../react/images/social/fc-webicons/fc-webicon-linkedin-m.png"); }
			.no-svg .fc-webicon.linkedin.large { background: url("../../react/images/social/fc-webicons/fc-webicon-linkedin.png"); }
			.no-svg .fc-webicon.linkedin.small { background: url("../../react/images/social/fc-webicons/fc-webicon-linkedin-s.png"); }
			.svg .fc-webicon.linkedin { background: url("../../react/images/social/fc-webicons/fc-webicon-linkedin.svg"); }

			/* Mail */
			.no-svg .fc-webicon.mail { background: url("../../react/images/social/fc-webicons/fc-webicon-mail-m.png"); }
			.no-svg .fc-webicon.mail.large { background: url("../../react/images/social/fc-webicons/fc-webicon-mail.png"); }
			.no-svg .fc-webicon.mail.small { background: url("../../react/images/social/fc-webicons/fc-webicon-mail-s.png"); }
			.svg .fc-webicon.mail { background: url("../../react/images/social/fc-webicons/fc-webicon-mail.svg"); }

			/* Mixi */
			.no-svg .fc-webicon.mixi { background: url("../../react/images/social/fc-webicons/fc-webicon-mixi-m.png"); }
			.no-svg .fc-webicon.mixi.large { background: url("../../react/images/social/fc-webicons/fc-webicon-mixi.png"); }
			.no-svg .fc-webicon.mixi.small { background: url("../../react/images/social/fc-webicons/fc-webicon-mixi-s.png"); }
			.svg .fc-webicon.mixi { background: url("../../react/images/social/fc-webicons/fc-webicon-mixi.svg"); }

			/* MSN */
			.no-svg .fc-webicon.msn { background: url("../../react/images/social/fc-webicons/fc-webicon-msn-m.png"); }
			.no-svg .fc-webicon.msn.large { background: url("../../react/images/social/fc-webicons/fc-webicon-msn.png"); }
			.no-svg .fc-webicon.msn.small { background: url("../../react/images/social/fc-webicons/fc-webicon-msn-s.png"); }
			.svg .fc-webicon.msn { background: url("../../react/images/social/fc-webicons/fc-webicon-msn.svg"); }

			/* Picasa */
			.no-svg .fc-webicon.picasa { background: url("../../react/images/social/fc-webicons/fc-webicon-picasa-m.png"); }
			.no-svg .fc-webicon.picasa.large { background: url("../../react/images/social/fc-webicons/fc-webicon-picasa"); }
			.no-svg .fc-webicon.picasa.small { background: url("../../react/images/social/fc-webicons/fc-webicon-picasa-s.png"); }
			.svg .fc-webicon.picasa { background: url("../../react/images/social/fc-webicons/fc-webicon-picasa.svg"); }

			/* Pinterest */
			.no-svg .fc-webicon.pinterest { background: url("../../react/images/social/fc-webicons/fc-webicon-pinterest-m.png"); }
			.no-svg .fc-webicon.pinterest.large { background: url("../../react/images/social/fc-webicons/fc-webicon-pinterest.png"); }
			.no-svg .fc-webicon.pinterest.small { background: url("../../react/images/social/fc-webicons/fc-webicon-pinterest-s.png"); }
			.svg .fc-webicon.pinterest { background: url("../../react/images/social/fc-webicons/fc-webicon-pinterest.svg"); }

			/* PocketApp */
			.no-svg .fc-webicon.pocket { background: url("../../react/images/social/fc-webicons/fc-webicon-pocketapp-m.png"); }
			.no-svg .fc-webicon.pocket.large { background: url("../../react/images/social/fc-webicons/fc-webicon-pocketapp.png"); }
			.no-svg .fc-webicon.pocket.small { background: url("../../react/images/social/fc-webicons/fc-webicon-pocketapp-s.png"); }
			.svg .fc-webicon.pocket { background: url("../../react/images/social/fc-webicons/fc-webicon-pocketapp.svg"); }

			/* Quora */
			.no-svg .fc-webicon.quora { background: url("../../react/images/social/fc-webicons/fc-webicon-quora-m.png"); }
			.no-svg .fc-webicon.quora.large { background: url("../../react/images/social/fc-webicons/fc-webicon-quora.png"); }
			.no-svg .fc-webicon.quora.small { background: url("../../react/images/social/fc-webicons/fc-webicon-quora-s.png"); }
			.svg .fc-webicon.quora { background: url("../../react/images/social/fc-webicons/fc-webicon-quora.svg"); }

			/* Orkut */
			.no-svg .fc-webicon.orkut { background: url("../../react/images/social/fc-webicons/fc-webicon-orkut-m.png"); }
			.no-svg .fc-webicon.orkut.large { background: url("../../react/images/social/fc-webicons/fc-webicon-orkut.png"); }
			.no-svg .fc-webicon.orkut.small { background: url("../../react/images/social/fc-webicons/fc-webicon-orkut-s.png"); }
			.svg .fc-webicon.orkut { background: url("../../react/images/social/fc-webicons/fc-webicon-orkut.svg"); }

			/* Mercurial */
			.no-svg .fc-webicon.mercurial { background: url("../../react/images/social/fc-webicons/fc-webicon-mercurial-m.png"); }
			.no-svg .fc-webicon.mercurial.large { background: url("../../react/images/social/fc-webicons/fc-webicon-mercurial.png"); }
			.no-svg .fc-webicon.mercurial.small { background: url("../../react/images/social/fc-webicons/fc-webicon-mercurial-s.png"); }
			.svg .fc-webicon.mercurial { background: url("../../react/images/social/fc-webicons/fc-webicon-mercurial.svg"); }

			/* Rdio */
			.no-svg .fc-webicon.rdio { background: url("../../react/images/social/fc-webicons/fc-webicon-rdio-m.png"); }
			.no-svg .fc-webicon.rdio.large { background: url("../../react/images/social/fc-webicons/fc-webicon-rdio.png"); }
			.no-svg .fc-webicon.rdio.small { background: url("../../react/images/social/fc-webicons/fc-webicon-rdio-s.png"); }
			.svg .fc-webicon.rdio { background: url("../../react/images/social/fc-webicons/fc-webicon-rdio.svg"); }

			/* Renren */
			.no-svg .fc-webicon.renren { background: url("../../react/images/social/fc-webicons/fc-webicon-renren-m.png"); }
			.no-svg .fc-webicon.renren.large { background: url("../../react/images/social/fc-webicons/fc-webicon-renren.png"); }
			.no-svg .fc-webicon.renren.small { background: url("../../react/images/social/fc-webicons/fc-webicon-renren-s.png"); }
			.svg .fc-webicon.renren { background: url("../../react/images/social/fc-webicons/fc-webicon-renren.svg"); }

			/* RSS */
			.no-svg .fc-webicon.rss { background: url("../../react/images/social/fc-webicons/fc-webicon-rss-m.png"); }
			.no-svg .fc-webicon.rss.large { background: url("../../react/images/social/fc-webicons/fc-webicon-rss.png"); }
			.no-svg .fc-webicon.rss.small { background: url("../../react/images/social/fc-webicons/fc-webicon-rss-s.png"); }
			.svg .fc-webicon.rss { background: url("../../react/images/social/fc-webicons/fc-webicon-rss.svg"); }

			/* Skitch */
			.no-svg .fc-webicon.skitch { background: url("../../react/images/social/fc-webicons/fc-webicon-skitch-m.png"); }
			.no-svg .fc-webicon.skitch.large { background: url("../../react/images/social/fc-webicons/fc-webicon-skitch.png"); }
			.no-svg .fc-webicon.skitch.small { background: url("../../react/images/social/fc-webicons/fc-webicon-skitch-s.png"); }
			.svg .fc-webicon.skitch { background: url("../../react/images/social/fc-webicons/fc-webicon-skitch.svg"); }

			/* Skype */
			.no-svg .fc-webicon.skype { background: url("../../react/images/social/fc-webicons/fc-webicon-skype-m.png"); }
			.no-svg .fc-webicon.skype.large { background: url("../../react/images/social/fc-webicons/fc-webicon-skype.png"); }
			.no-svg .fc-webicon.skype.small { background: url("../../react/images/social/fc-webicons/fc-webicon-skype-s.png"); }
			.svg .fc-webicon.skype { background: url("../../react/images/social/fc-webicons/fc-webicon-skype.svg"); }

			/* SoundCloud */
			.no-svg .fc-webicon.soundcloud { background: url("../../react/images/social/fc-webicons/fc-webicon-soundcloud-m.png"); }
			.no-svg .fc-webicon.soundcloud.large { background: url("../../react/images/social/fc-webicons/fc-webicon-soundcloud.png"); }
			.no-svg .fc-webicon.soundcloud.small { background: url("../../react/images/social/fc-webicons/fc-webicon-soundcloud-s.png"); }
			.svg .fc-webicon.soundcloud { background: url("../../react/images/social/fc-webicons/fc-webicon-soundcloud.svg"); }

			/* Spotify */
			.no-svg .fc-webicon.spotify { background: url("../../react/images/social/fc-webicons/fc-webicon-spotify-m.png"); }
			.no-svg .fc-webicon.spotify.large { background: url("../../react/images/social/fc-webicons/fc-webicon-spotify.png"); }
			.no-svg .fc-webicon.spotify.small { background: url("../../react/images/social/fc-webicons/fc-webicon-spotify-s.png"); }
			.svg .fc-webicon.spotify { background: url("../../react/images/social/fc-webicons/fc-webicon-spotify.svg"); }

			/* Stack Overflow */
			.no-svg .fc-webicon.stackoverflow { background: url("../../react/images/social/fc-webicons/fc-webicon-stackoverflow-m.png"); }
			.no-svg .fc-webicon.stackoverflow.large { background: url("../../react/images/social/fc-webicons/fc-webicon-stackoverflow.png"); }
			.no-svg .fc-webicon.stackoverflow.small { background: url("../../react/images/social/fc-webicons/fc-webicon-stackoverflow-s.png"); }
			.svg .fc-webicon.stackoverflow { background: url("../../react/images/social/fc-webicons/fc-webicon-stackoverflow.svg"); }

			/* StumbleUpon! */
			.no-svg .fc-webicon.stumbleupon { background: url("../../react/images/social/fc-webicons/fc-webicon-stumbleupon-m.png"); }
			.no-svg .fc-webicon.stumbleupon.large { background: url("../../react/images/social/fc-webicons/fc-webicon-stumbleupon.png"); }
			.no-svg .fc-webicon.stumbleupon.small { background: url("../../react/images/social/fc-webicons/fc-webicon-stumbleupon-s.png"); }
			.svg .fc-webicon.stumbleupon { background: url("../../react/images/social/fc-webicons/fc-webicon-stumbleupon.svg"); }

			/* SVN */
			.no-svg .fc-webicon.svn { background: url("../../react/images/social/fc-webicons/fc-webicon-svn-m.png"); }
			.no-svg .fc-webicon.svn.large { background: url("../../react/images/social/fc-webicons/fc-webicon-svn.png"); }
			.no-svg .fc-webicon.svn.small { background: url("../../react/images/social/fc-webicons/fc-webicon-svn-s.png"); }
			.svg .fc-webicon.svn { background: url("../../react/images/social/fc-webicons/fc-webicon-svn.svg"); }

			/* Tent */
			.no-svg .fc-webicon.tent { background: url("../../react/images/social/fc-webicons/fc-webicon-tent-m.png"); }
			.no-svg .fc-webicon.tent.large { background: url("../../react/images/social/fc-webicons/fc-webicon-tent.png"); }
			.no-svg .fc-webicon.tent.small { background: url("../../react/images/social/fc-webicons/fc-webicon-tent-s.png"); }
			.svg .fc-webicon.tent { background: url("../../react/images/social/fc-webicons/fc-webicon-tent.svg"); }

			/* Trip Advisor */
			.no-svg .fc-webicon.tripadvisor { background: url("../../react/images/social/fc-webicons/fc-webicon-tripadvisor-m.png"); }
			.no-svg .fc-webicon.tripadvisor.large { background: url("../../react/images/social/fc-webicons/fc-webicon-tripadvisor.png"); }
			.no-svg .fc-webicon.tripadvisor.small { background: url("../../react/images/social/fc-webicons/fc-webicon-tripadvisor-s.png"); }
			.svg .fc-webicon.tripadvisor { background: url("../../react/images/social/fc-webicons/fc-webicon-tripadvisor.svg"); }

			/* Tumblr */
			.no-svg .fc-webicon.tumblr { background: url("../../react/images/social/fc-webicons/fc-webicon-tumblr-m.png"); }
			.no-svg .fc-webicon.tumblr.large { background: url("../../react/images/social/fc-webicons/fc-webicon-tumblr.png"); }
			.no-svg .fc-webicon.tumblr.small { background: url("../../react/images/social/fc-webicons/fc-webicon-tumblr-s.png"); }
			.svg .fc-webicon.tumblr { background: url("../../react/images/social/fc-webicons/fc-webicon-tumblr.svg"); }

			/* Twitter */
			.no-svg .fc-webicon.twitter { background: url("../../react/images/social/fc-webicons/fc-webicon-twitter-m.png"); }
			.no-svg .fc-webicon.twitter.large { background: url("../../react/images/social/fc-webicons/fc-webicon-twitter.png"); }
			.no-svg .fc-webicon.twitter.small { background: url("../../react/images/social/fc-webicons/fc-webicon-twitter-s.png"); }
			.svg .fc-webicon.twitter { background: url("../../react/images/social/fc-webicons/fc-webicon-twitter.svg"); }

			/* Vimeo */
			.no-svg .fc-webicon.vimeo { background: url("../../react/images/social/fc-webicons/fc-webicon-vimeo-m.png"); }
			.no-svg .fc-webicon.vimeo.large { background: url("../../react/images/social/fc-webicons/fc-webicon-vimeo.png"); }
			.no-svg .fc-webicon.vimeo.small { background: url("../../react/images/social/fc-webicons/fc-webicon-vimeo-s.png"); }
			.svg .fc-webicon.vimeo { background: url("../../react/images/social/fc-webicons/fc-webicon-vimeo.svg"); }

			/* Sina Weibo */
			.no-svg .fc-webicon.weibo { background: url("../../react/images/social/fc-webicons/fc-webicon-weibo-m.png"); }
			.no-svg .fc-webicon.weibo.large { background: url("../../react/images/social/fc-webicons/fc-webicon-weibo.png"); }
			.no-svg .fc-webicon.weibo.small { background: url("../../react/images/social/fc-webicons/fc-webicon-weibo-s.png"); }
			.svg .fc-webicon.weibo { background: url("../../react/images/social/fc-webicons/fc-webicon-weibo.svg"); }

			/* Windows */
			.no-svg .fc-webicon.windows { background: url("../../react/images/social/fc-webicons/fc-webicon-windows-m.png"); }
			.no-svg .fc-webicon.windows.large { background: url("../../react/images/social/fc-webicons/fc-webicon-windows.png"); }
			.no-svg .fc-webicon.windows.small { background: url("../../react/images/social/fc-webicons/fc-webicon-windows-s.png"); }
			.svg .fc-webicon.windows { background: url("../../react/images/social/fc-webicons/fc-webicon-windows.svg"); }

			/* Wordpress */
			.no-svg .fc-webicon.wordpress { background: url("../../react/images/social/fc-webicons/fc-webicon-wordpress-m.png"); }
			.no-svg .fc-webicon.wordpress.large { background: url("../../react/images/social/fc-webicons/fc-webicon-wordpress.png"); }
			.no-svg .fc-webicon.wordpress.small { background: url("../../react/images/social/fc-webicons/fc-webicon-wordpress-s.png"); }
			.svg .fc-webicon.wordpress { background: url("../../react/images/social/fc-webicons/fc-webicon-wordpress.svg"); }

			/* Xing */
			.no-svg .fc-webicon.xing { background: url("../../react/images/social/fc-webicons/fc-webicon-xing-m.png"); }
			.no-svg .fc-webicon.xing.large { background: url("../../react/images/social/fc-webicons/fc-webicon-xing.png"); }
			.no-svg .fc-webicon.xing.small { background: url("../../react/images/social/fc-webicons/fc-webicon-xing-s.png"); }
			.svg .fc-webicon.xing { background: url("../../react/images/social/fc-webicons/fc-webicon-xing.svg"); }

			/* Yelp! */
			.no-svg .fc-webicon.yelp { background: url("../../react/images/social/fc-webicons/fc-webicon-yelp-m.png"); }
			.no-svg .fc-webicon.yelp.large { background: url("../../react/images/social/fc-webicons/fc-webicon-yelp.png"); }
			.no-svg .fc-webicon.yelp.small { background: url("../../react/images/social/fc-webicons/fc-webicon-yelp-s.png"); }
			.svg .fc-webicon.yelp { background: url("../../react/images/social/fc-webicons/fc-webicon-yelp.svg"); }

			/* YouTube */
			.no-svg .fc-webicon.youtube { background: url("../../react/images/social/fc-webicons/fc-webicon-youtube-m.png"); }
			.no-svg .fc-webicon.youtube.large { background: url("../../react/images/social/fc-webicons/fc-webicon-youtube.png"); }
			.no-svg .fc-webicon.youtube.small { background: url("../../react/images/social/fc-webicons/fc-webicon-youtube-s.png"); }
			.svg .fc-webicon.youtube { background: url("../../react/images/social/fc-webicons/fc-webicon-youtube.svg"); }

			/* YouVersion */
			.no-svg .fc-webicon.youversion { background: url("../../react/images/social/fc-webicons/fc-webicon-youversion-m.png"); }
			.no-svg .fc-webicon.youversion.large { background: url("../../react/images/social/fc-webicons/fc-webicon-youversion.png"); }
			.no-svg .fc-webicon.youversion.small { background: url("../../react/images/social/fc-webicons/fc-webicon-youversion-s.png"); }
			.svg .fc-webicon.youversion { background: url("../../react/images/social/fc-webicons/fc-webicon-youversion.svg"); }

			/* Zerply */
			.no-svg .fc-webicon.zerply { background: url("../../react/images/social/fc-webicons/fc-webicon-zerply-m.png"); }
			.no-svg .fc-webicon.zerply.large { background: url("../../react/images/social/fc-webicons/fc-webicon-zerply.png"); }
			.no-svg .fc-webicon.zerply.small { background: url("../../react/images/social/fc-webicons/fc-webicon-zerply-s.png"); }
			.svg .fc-webicon.zerply { background: url("../../react/images/social/fc-webicons/fc-webicon-zerply.svg"); }
		';
	}

	if ($options['background_spinner_type'] != '' && $options['background_spinner_color'] != '') {
		echo '.fullscreen-spinner .sk-rotating-plane,
		.fullscreen-spinner .sk-double-bounce .sk-child,
		.fullscreen-spinner .sk-wave .sk-rect,
		.fullscreen-spinner .sk-wandering-cubes .sk-cube,
		.fullscreen-spinner .sk-spinner-pulse,
		.fullscreen-spinner .sk-chasing-dots .sk-child,
		.fullscreen-spinner .sk-three-bounce .sk-child,
		.fullscreen-spinner .sk-circle .sk-child:before,
		.fullscreen-spinner .sk-cube-grid .sk-cube,
		.fullscreen-spinner .sk-fading-circle .sk-circle:before,
		.fullscreen-spinner .sk-folding-cube .sk-cube:before {
			' . react_css_color($options['background_spinner_color']) . '
		}';
	}


	if ($options['advanced_custom_css']) {
		echo wp_strip_all_tags($options['advanced_custom_css']);
	}
	if ($options['advanced_custom_css_phone']) {
		echo '@media only screen and (max-width: ' . absint($phoneLdsp) . 'px) { ' . wp_strip_all_tags($options['advanced_custom_css_phone']) . '
			}';
	}
	if ($options['advanced_custom_css_tablet']) {
		echo '@media only screen and (min-width: ' . (absint($phoneLdsp) + 1) . 'px) and (max-width: ' . absint($tabletLdsp) . 'px) { ' . wp_strip_all_tags($options['advanced_custom_css_tablet']) . '
			}';
	}
	if ($options['advanced_custom_css_desktop']) {
		echo '@media only screen and (min-width: ' . (absint($desktop)) . 'px) and (max-width: ' . (absint($tv) - 1) . 'px) { ' . wp_strip_all_tags($options['advanced_custom_css_desktop']) . '
			}';
	}
	if ($options['advanced_custom_css_large']) {
		echo '@media only screen and (min-width: ' . absint($tv) . 'px) { ' . wp_strip_all_tags($options['advanced_custom_css_large']) . '
			}';
	}

	/* ------------------------The end is nigh-------------------------- */
