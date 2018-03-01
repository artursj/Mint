<?php
// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

foreach ($palettes as $palette) : ?>
	<?php
		// Merge the saved options with default ones
		$palette = array_merge(react_get_default_palette_options(), $palette);

		// Sanitize and build selector
		$paletteClass = sanitize_html_class('custom-palette-' .  $palette['id']);
		$paletteSelector = '.' . $paletteClass;

		$shadowValue = $options['contrast_reverse'] ? '-1px' : '-3px';
	?>
	<?php /* BACKGROUND colors */ ?>
	<?php if ($palette['background'] || $palette['text']) { echo '
		' . $paletteSelector . ', ' . $paletteSelector . ' .tcs-section-break-help,
		.tcs-has-drop .tcs-drop-content' . $paletteSelector . ',
		#footer-logo-info-wrap' . $paletteSelector . ',
		' . $paletteSelector . ' .fancybox-skin {
			' . react_css_color($palette['background']) . '
			' . react_css_color($palette['text'], 'color') . '
		}

		' . $paletteSelector . '.tcs-arrow:after {
			' . react_css_color($palette['background'], 'border-bottom-color') . '
		}
		' . $paletteSelector . '.tcs-arrow.tcs-bottom:after {
			border-bottom-color: rgba(238, 238, 238, 0);
			' . react_css_color($palette['background'], 'border-top-color') . '
		}
		' . $paletteSelector . '.tcs-arrow.tcs-on-left:after {
			border-bottom-color: rgba(238, 238, 238, 0);
			' . react_css_color($palette['background'], 'border-right-color') . '
		}
		' . $paletteSelector . '.tcs-arrow.tcs-on-right:after {
			border-bottom-color: rgba(238, 238, 238, 0);
			' . react_css_color($palette['background'], 'border-left-color') . '
		}


		' . $paletteSelector . ' ul#recentcomments li:before,
		' . $paletteSelector . ' ul li.cat-item a:before,
		' . $paletteSelector . ' .widget_archive ul li a:before,
		' . $paletteSelector . ' .widget_pages ul li a:before {
			' . react_css_color($palette['text'], 'color') . '
		}

		' . $paletteSelector . ' .tcs-button.tcs-holw-btn > a, ' . $paletteSelector . ' .tcs-button.tcs-holw-btn > span.tcs-r-button,
		' . $paletteSelector . ' .tcs-button.tcs-holw-btn > a > i, ' . $paletteSelector . ' .tcs-button.tcs-holw-btn > span.tcs-r-button > i {
			' . react_css_color($palette['text'], 'color') . '
		}
		#footer-logo-info-wrap' . $paletteSelector . ':after {
			' . react_css_color($palette['background'], 'border-top-color') . '
		}
	'; } ?>
	<?php if ($palette['border']) { echo '
	.right-sidebar.sdbr-line #sidebar' . $paletteSelector . ',
	.left-sidebar.sdbr-line #sidebar' . $paletteSelector . ',
	' . $paletteSelector . '.tcs-border {
		' . react_css_color($palette['border'], 'border-color') . '
	}'; } ?>
	<?php if ($palette['border'] || $palette['background']) { echo '
	.right-sidebar.sdbr-line .content-outer.match-' .  $paletteClass . ' #content:before,
	.left-sidebar.sdbr-line .content-outer.match-' .  $paletteClass . ' #content:before {
		' . react_css_color($palette['border'], 'border-color') . '
		' . react_css_color($palette['background']) . '
	}
	'; } ?>
	<?php if ($palette['background_gradient']) { echo '
		' . $paletteSelector . ', .tcs-has-drop .tcs-drop-content' . $paletteSelector . ',
		.right-sidebar.sdbr-line .content-outer.match-' . $paletteClass . ' #content:before,
		.left-sidebar.sdbr-line .content-outer.match-' . $paletteClass . ' #content:before {
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
				} if ($palette['gradient_orientation'] =='horizontal') {
					echo '
					background: -moz-linear-gradient(left, ' . react_sanitize_color($palette['background_lighter']) . ' 0%, ' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -webkit-gradient(linear, left top, right top, color-stop(0%,' . react_sanitize_color($palette['background_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['gradient_background_color']) . '));
					background: -webkit-linear-gradient(left, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -o-linear-gradient(left, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -ms-linear-gradient(left, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: linear-gradient(to right, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					';
				} if ($palette['gradient_orientation'] =='diagonal-down') {
					echo '
					background: -moz-linear-gradient(-45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%, ' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,' . react_sanitize_color($palette['background_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['gradient_background_color']) . '));
					background: -webkit-linear-gradient(-45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -o-linear-gradient(-45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: -ms-linear-gradient(-45deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					background: linear-gradient( 135deg, ' . react_sanitize_color($palette['background_lighter']) . ' 0%,' . react_sanitize_color($palette['gradient_background_color']) . ' 100%);
					';
				} if ($palette['gradient_orientation'] =='diagonal-up') {
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
		echo '
		}
		' . $paletteSelector . '.tcs-arrow:after {
			' . react_css_color($palette['background_lighter'], 'border-bottom-color') . '
		}
		' . $paletteSelector . '.tcs-arrow.tcs-bottom:after {
			border-bottom-color: rgba(238, 238, 238, 0);
			' . react_css_color($palette['background_touch_darker'], 'border-top-color') . '
		}

		';
		}
	?>
	<?php if ($palette['border']) echo '
	body.pge-bxd .after-header-wrap ' . $paletteSelector . ', body.pge-mxd .after-header-wrap ' . $paletteSelector . ' {
	   ' . react_css_color($palette['border'], 'border-color') . '
	}

	' . $paletteSelector . '.tcs-border.tcs-arrow:after {
		' . react_css_color($palette['border'], 'border-bottom-color') . '
	}
	' . $paletteSelector . '.tcs-border.tcs-arrow.tcs-bottom:after {
		border-bottom-color: rgba(238, 238, 238, 0);
		' . react_css_color($palette['border'], 'border-top-color') . '
	}

	'; ?>
	<?php
	if ($palette['border_lr']) {
		echo '
		body.pge-bxd .after-header-wrap ' . $paletteSelector . ', body.pge-mxd .after-header-wrap ' . $paletteSelector . ', ' . $paletteSelector . ' {
			' . react_css_color($palette['border_lr'], 'border-left-color') . '
			' . react_css_color($palette['border_lr'], 'border-right-color') . '
		}
		' . $paletteSelector . '.tcs-border.tcs-arrow.tcs-on-left:after {
			border-bottom-color: rgba(238, 238, 238, 0);
			' . react_css_color($palette['border_lr'], 'border-right-color') . '
		}
		' . $paletteSelector . '.tcs-border.tcs-arrow.tcs-on-right:after {
			border-bottom-color: rgba(238, 238, 238, 0);
			' . react_css_color($palette['border_lr'], 'border-left-color') . '
		}

		';
	}?>
	<?php if ($palette['text_alt']) echo '
	' . $paletteSelector . ' .widget_nav_menu ul.menu li ul a,
	' . $paletteSelector . ' .widget_pages ul.children li a,
	' . $paletteSelector . ' .widget_product_categories  ul.children li a,
	' . $paletteSelector . ' .widget_recent_entries ul.children li a,
	' . $paletteSelector . ' .widget_meta ul.children li a,
	' . $paletteSelector . ' .widget_archive ul.children li a,
	' . $paletteSelector . ' .widget_categories ul.children li a,
	' . $paletteSelector . '  ul.blogroll ul.children a,
	' . $paletteSelector . ' .widget_nav_menu ul.menu ul.children a,
	' . $paletteSelector . ' .breadcrumbs,
	' . $paletteSelector . ' .entry-meta,
	' . $paletteSelector . ' .tcw-opening-times .tcw-open-time,
	' . $paletteSelector . ' .tcs-opening-times .tcs-open-time,
	' . $paletteSelector . ' .tcw-contact-details .tcw-contact-detail,
	' . $paletteSelector . ' .tcw-widget-post-info .tcw-widget-post-date,
	' . $paletteSelector . ' .widget_recent_entries .post-date,
	' . $paletteSelector . ' .tcs-pullquote,
	' . $paletteSelector . ' #wp-calendar td,
	' . $paletteSelector . ' table caption,
	' . $paletteSelector . ' .tcs-fancy-table table td,
	' . $paletteSelector . ' table td,
	' . $paletteSelector . ' .iphorm-theme-react-default p.iphorm-description,
	' . $paletteSelector . ' .wp-pagenavi span.pages,
	' . $paletteSelector . ' .tcp-portfolio .wp-pagenavi span.pages,
	' . $paletteSelector . ' .wp-pagenavi span.extend,
	' . $paletteSelector . ' .tcp-portfolio .wp-pagenavi span.extend,
	' . $paletteSelector . ' .tcp-portfolio-item-title .tcp-portfolio-title-inner > a,
	' . $paletteSelector . ' .tcp-portfolio-item-title .post-like a .like,
	' . $paletteSelector . ' a.subtle-link,
	' . $paletteSelector . ' a.tcp-subtle-link,
	' . $paletteSelector . ' .tcs-accordion.tcs-plain > h3 > a,
	' . $paletteSelector . ' span.subtle-link,
	' . $paletteSelector . ' .tcs-blockquote .tcs-qmark,
	' . $paletteSelector . ' .text-alt,
	' . $paletteSelector . ' .widget_rss .rssSummary,
	' . $paletteSelector . ' .tcs-pullquote .tcs-qmark,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow > i,
	' . $paletteSelector . ' .tcp-portfolio-items .tcp-entry-meta {
		' . react_css_color($palette['text_alt'], 'color') . '
	}'; ?>
	<?php if ($palette['h1']) echo '' . $paletteSelector . ' h1, ' . $paletteSelector . ' h1.entry-title a {' . react_css_color($palette['h1'], 'color') . '}'; ?>
	<?php if ($palette['h2']) echo '' . $paletteSelector . ' h2, ' . $paletteSelector . ' h2.entry-title a {' . react_css_color($palette['h2'], 'color') . '}'; ?>
	<?php if ($palette['h3']) echo '' . $paletteSelector . ' h3, ' . $paletteSelector . ' h3.entry-title a {' . react_css_color($palette['h3'], 'color') . '}'; ?>
	<?php if ($palette['h4']) echo '' . $paletteSelector . ' h4, ' . $paletteSelector . ' h4.entry-title a {' . react_css_color($palette['h4'], 'color') . '}'; ?>
	<?php if ($palette['h5']) echo '' . $paletteSelector . ' h5, ' . $paletteSelector . ' h6, ' . $paletteSelector . ' h5.entry-title a {' . react_css_color($palette['h5'], 'color') . '}'; ?>
	<?php if ($palette['link']) echo '' . $paletteSelector . ' a, ' . $paletteSelector . ' ul.menu li ul a {' . react_css_color($palette['link'], 'color') . '}'; ?>
	<?php if ($palette['link_hover']) echo '
	' . $paletteSelector . ' .widget_nav_menu ul.menu li ul a:hover,
	' . $paletteSelector . ' .widget_pages ul.children li a:hover,
	' . $paletteSelector . ' .widget_product_categories  ul.children li a:hover,
	' . $paletteSelector . ' .widget_recent_entries ul.children li a:hover,
	' . $paletteSelector . ' .widget_meta ul.children li a:hover,
	' . $paletteSelector . ' .widget_archive ul.children li a:hover,
	' . $paletteSelector . ' .widget_categories ul.children li a:hover,
	' . $paletteSelector . ' ul.blogroll ul.children a:hover,
	' . $paletteSelector . ' .widget_nav_menu ul.menu ul.children a:hover,
	' . $paletteSelector . ' a:hover,
	' . $paletteSelector . ' .entry-title a:hover,
	' . $paletteSelector . ' a:active,
	' . $paletteSelector . ' ul.menu li ul a:hover,
	' . $paletteSelector . ' a.subtle-link:hover,
	' . $paletteSelector . ' a.tcp-subtle-link:hover,
	' . $paletteSelector . ' .tcs-accordion.tcs-plain > h3 > a:hover,
	' . $paletteSelector . ' span.subtle-link:hover,
	' . $paletteSelector . ' .tcp-portfolio-item-title .tcp-portfolio-title-inner > a:hover,
	' . $paletteSelector . ' .tcp-portfolio-item-title .post-like a:hover .like { ' . react_css_color($palette['link_hover'], 'color') . '}

	'; ?>
	<?php if ($palette['background_darker']) echo '
	' . $paletteSelector . ' #nav-single .nav-single-inner div:first-child,
	' . $paletteSelector . ' #nav-single .nav-single-inner div:last-child {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}
	' . $paletteSelector . ' #nav-single .nav-single-inner div.first-child,
	' . $paletteSelector . ' #nav-single .nav-single-inner div.last-child,
	' . $paletteSelector . ' .widget_archive select,
	' . $paletteSelector . ' .widget_categories select,
	' . $paletteSelector . ' div.post,

	' . $paletteSelector . ' div.comment,
	' . $paletteSelector . ' #comments,
	' . $paletteSelector . ' .comment-reply-wrap,
	' . $paletteSelector . ' .nocomments,
	' . $paletteSelector . ' #nav-single,
	' . $paletteSelector . ' .comments-pagination-wrap,
	' . $paletteSelector . ' .content-nav,
	' . $paletteSelector . ' .page-link,
	' . $paletteSelector . ' .wp-pagenavi,
	' . $paletteSelector . ' .tcp-portfolio .wp-pagenavi,
	' . $paletteSelector . ' .tcp-portfolio-details,
	' . $paletteSelector . ' .tcp-portfolio-item-title,
	' . $paletteSelector . ' .tcs-section-break.tcs-line,
	' . $paletteSelector . ' .vc_separator.react .vc_sep_holder .vc_sep_line,
	' . $paletteSelector . ' .tcs-section-break.tcs-line-lrg,
	' . $paletteSelector . ' .tcs-image.tcs-style1 img,
	' . $paletteSelector . ' .tcs-image.tcs-style2 img {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}
	' . $paletteSelector . ' .tcs-animated-number-label:before,
	' . $paletteSelector . ' .tcs-section-break:after,
	' . $paletteSelector . ' .tcs-section-break:before,
	' . $paletteSelector . ' .tcs-fancy-header.tcs-text-line .tcs-fancy-header-text:before,
	' . $paletteSelector . ' .tcs-fancy-header.tcs-style1:after,
	' . $paletteSelector . ' .tcs-fancy-header.tcs-style1:before,
	.archive ' . $paletteSelector . ' .entry-content:before,
	.search ' . $paletteSelector . ' .entry-content:before,
	.blog ' . $paletteSelector . ' .entry-content:before {
		' . react_css_color($palette['background']) . '
		' . react_css_color($palette['background_much_darker'], 'border-color') . '
	}
	' . $paletteSelector . ' .tcs-section-break.tcs-line-lrg:after,
	' . $paletteSelector . ' .tcs-section-break.tcs-line-lrg:before,
	' . $paletteSelector . ' .owl-theme .owl-dots .owl-dot span,
	' . $paletteSelector . ' .tcs-fancy-header.tcs-text-line .tcs-fancy-header-text:before {
		' . react_css_color($palette['background_much_darker']) . '
	}
	' . $paletteSelector . ' ul.vert-nav-ul > li,
	' . $paletteSelector . ' .widget_nav_menu ul.menu li a,
	' . $paletteSelector . ' .widget_pages ul li a,
	' . $paletteSelector . ' .widget_product_categories ul li a,
	' . $paletteSelector . ' .widget_recent_entries ul > li,
	' . $paletteSelector . ' .widget_meta ul > li,
	' . $paletteSelector . ' .widget_archive ul > li,
	' . $paletteSelector . ' .widget_categories ul > li,
	' . $paletteSelector . ' ul.blogroll > li,
	' . $paletteSelector . ' ul.menu li a,
	' . $paletteSelector . ' ul.menu li ul li a,
	' . $paletteSelector . ' ul#recentcomments li,
	' . $paletteSelector . ' .tcs-fancy-header.tcs-style1,
	' . $paletteSelector . ' .tcs-impact-header.tcs-light,
	' . $paletteSelector . ' .tcs-pullquote,
	' . $paletteSelector . ' .tcs-fancy-table table,
	' . $paletteSelector . ' .tcs-fancy-table table th,
	' . $paletteSelector . ' .tcs-fancy-table table td,
	' . $paletteSelector . ' table,
	' . $paletteSelector . ' table th,
	' . $paletteSelector . ' table td,
	' . $paletteSelector . ' .comments ul.children div.comment,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-separator.tcs-inline ul li a,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-separator.tcs-stacked ul li a,
	' . $paletteSelector . ' .tcw-contact-details,
	' . $paletteSelector . ' .tcw-opening-times,
	' . $paletteSelector . ' .tcs-opening-times,
	' . $paletteSelector . ' .tcw-tweet-list li,
	' . $paletteSelector . ' .widget_rss ul li,
	' . $paletteSelector . ' .breadcrumbs,
	' . $paletteSelector . ' .breadcrumbs .back-home-icon,
	' . $paletteSelector . ' .tcw-widget-post,
	' . $paletteSelector . ' ul.socialcount,
	.single ' . $paletteSelector . ' .entry-meta,
	' . $paletteSelector . ' #sidebar,
	' . $paletteSelector . ' .units-row > div,
	' . $paletteSelector . ' .tcs-units-row > div,
	' . $paletteSelector . ' .featured-image-wrap,
	' . $paletteSelector . ' .tcp-featured-image-wrap {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}
	' . $paletteSelector . ' .breadcrumbs a:after,
	' . $paletteSelector . ' .breadcrumbs .breadcrumbs-inner > span a:after,
	' . $paletteSelector . ' .widget_breadcrumb_navxt a:after {
		' . react_css_color($palette['background_even_darker'], 'color') . '
	}
	'; ?>
	<?php if ($palette['background_lighter']) echo '
	' . $paletteSelector . ' #wp-calendar tbody .pad,
	' . $paletteSelector . ' #wp-calendar tbody td,
	' . $paletteSelector . ' #comments .comment-respond,
	' . $paletteSelector . ' .iphorm-theme-react-default .ifb-captcha-image-inner {
		' . react_css_color($palette['background_even_lighter']) . '
	}'; ?>
	<?php if ($palette['background_much_darker']) echo '
	' . $paletteSelector . ' #wp-calendar tbody tr:first-child .pad {
		-webkit-box-shadow: 0 2px 0 0px ' . react_sanitize_color($palette['background_much_darker']) . ' inset;
		box-shadow: 0 2px 0 0px ' . react_sanitize_color($palette['background_much_darker']) . ' inset;
	}'; ?>
	<?php if ($palette['background_much_darker']) echo '
	' . $paletteSelector . ' #wp-calendar tbody tr:last-child .pad {
		-webkit-box-shadow: 1px 2px 0 0px ' . react_sanitize_color($palette['background_even_darker']) . ' inset;
		box-shadow:  1px 2px 0 0px ' . react_sanitize_color($palette['background_even_darker']) . ' inset;
	}'; ?>
	<?php if ($palette['background_darker'] || $palette['text']) { echo '
	' . $paletteSelector . ' .wp-pagenavi span.current,
	' . $paletteSelector . ' .tcp-portfolio .wp-pagenavi span.current,
	' . $paletteSelector . ' .wp-pagenavi a,
	' . $paletteSelector . ' .tcp-portfolio .wp-pagenavi a,
	' . $paletteSelector . ' .comments-pagination-wrap a, ' . $paletteSelector . ' .comments-pagination-wrap span.page-numbers.current {
		' . react_css_color($palette['background_darker'], 'border-color', '!important') . '
		' . react_css_color($palette['text'], 'color') . '
	}'; } ?>
	<?php if ($palette['background_lighter']) echo '
	' . $paletteSelector . ' .wp-pagenavi a:hover,
	' . $paletteSelector . ' .tcp-portfolio .wp-pagenavi a:hover,
	' . $paletteSelector . ' .comments-pagination-wrap a:hover {
		' . react_css_color($palette['background_lighter'], 'background-color', '!important;') . '
	}'; ?>
	<?php if ($palette['primary_bg_darker'] || $palette['primary_bg'] || $palette['primary_fg']) { echo '
	' . $paletteSelector . ' .wp-pagenavi span.current,
	' . $paletteSelector . ' .tcp-portfolio .wp-pagenavi span.current,
	' . $paletteSelector . ' .comments-pagination-wrap span.page-numbers.current {
		' . react_css_color($palette['primary_bg_darker'], 'border-color', '!important') . '
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; } ?>
	<?php if ($palette['primary_fg']) echo '
	' . $paletteSelector . ' .tcs-impact-header.tcs-color .tcs-impact-heading, ' . $paletteSelector . ' .tcs-impact-header.tcs-color .tcs-impact-subheading,
	' . $paletteSelector . ' .wpb_content_element.react .wpb_tabs_nav li.ui-tabs-active a,
	' . $paletteSelector . ' .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details,
	' . $paletteSelector . ' .tcp-portfolio.tcp-boxed .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details,
	' . $paletteSelector . ' .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-portfolio-item-title,
	' . $paletteSelector . ' .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-portfolio-item-title a,
	' . $paletteSelector . ' .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-portfolio-item-title a:hover,
	' . $paletteSelector . ' .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-entry-meta,
	' . $paletteSelector . ' .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-entry-meta a,
	' . $paletteSelector . ' .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-details .tcp-entry-meta a:hover {
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; ?>
	<?php if ($palette['primary_bg']) echo '
	' . $paletteSelector . ' .tcs-section-break.tcs-line-prime,
	' . $paletteSelector . ' .tcs-section-break.tcs-line-lrg-prime,
	' . $paletteSelector . ' a.subtle-link,
	' . $paletteSelector . ' a.tcp-subtle-link,
	' . $paletteSelector . ' .tcs-accordion.tcs-plain > h3 > a,
	' . $paletteSelector . ' span.subtle-link {border-bottom-color: ' . react_sanitize_color($palette['primary_bg']) . ';}
	' . $paletteSelector . ' .tcs-accordion.tcs-plain > h3 > a:after,
	' . $paletteSelector . ' a.subtle-link:after,
	' . $paletteSelector . ' a.tcp-subtle-link:after,
	' . $paletteSelector . ' span.subtle-link:after,
	' . $paletteSelector . ' .tcs-section-break.tcs-line-lrg-prime:before,
	' . $paletteSelector . ' .tcs-section-break.tcs-line-lrg-prime:after {' . react_css_color($palette['primary_bg_much_darker']) . '}
	' . $paletteSelector . ' .tcs-section-break.tcs-line-prime:before,
	' . $paletteSelector . ' .tcs-section-break.tcs-line-prime:after {
		' . react_css_color($palette['background']) . '
		' . react_css_color($palette['primary_bg'], 'border-color') . '
	}
	' . $paletteSelector . ' .tcs-section-break.tcs-line-lrg-prime.tcs-double, ' . $paletteSelector . ' code, ' . $paletteSelector . ' pre, ' . $paletteSelector . ' kbd, ' . $paletteSelector . ' tt {' . react_css_color($palette['primary_bg'], 'border-color') . '}

	'; ?>
	<?php if ($palette['background_darker']) echo '
	' . $paletteSelector . ' #wp-calendar thead th,
	' . $paletteSelector . ' #wp-calendar #today,
	' . $paletteSelector . ' .tcs-fancy-table table th,
	' . $paletteSelector . ' table th,
	' . $paletteSelector . ' .commentlist > .comment > ul.children,
	' . $paletteSelector . ' .comments ul.children li,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements > .iphorm-element-wrap > .iphorm-element-spacer > label,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-plain > .iphorm-group-elements > .iphorm-group-row > .iphorm-element-wrap > .iphorm-element-spacer > label {
		' . react_css_color($palette['background_darker']) . '
	}'; ?>
	<?php if ($palette['background_lighter']) echo '' . $paletteSelector . ' .tcs-fancy-table table td, ' . $paletteSelector . ' table td {' . react_css_color($palette['background_lighter']) . '}'; ?>
	<?php if ($palette['background_much_darker']) echo '' . $paletteSelector . ' .commentlist > .comment > ul.children:after {' . react_css_color($palette['background_much_darker'], 'border-bottom-color') . '}'; ?>
	<?php if ($palette['background_lighter'] || $palette['background_much_darker']) { echo '
	' . $paletteSelector . ' .commentlist > .comment > ul.children li div.comment,
	' . $paletteSelector . ' div.comment,
	' . $paletteSelector . ' .tcp-boxed .tcp-portfolio-details,
	' . $paletteSelector . ' .custom-boxed-item,
	' . $paletteSelector . ' .tcs-box.tcs-box-custom-boxed-item,
	' . $paletteSelector . ' .tcs-tabs.tcs-boxed .tcs-tab-content,
	.sdbr-bxd #sidebar' . $paletteSelector . ' .widget,
	.pop-bxd .popdown' . $paletteSelector . ' .widget,
	.foot-bxd .footer' . $paletteSelector . ' .widget {
		 ' . react_css_color($palette['background_touch_darker']) . '
		 ' . react_css_color($palette['background_even_darker'], 'border-color') . '
		 -webkit-box-shadow:0 2px 8px rgba(0, 0, 0, 0.03), 0 0 20px rgba(0, 0, 0, 0.01) inset, 0 -3px 0 0 ' . react_sanitize_color($palette['background_even_darker']) . ' inset;
			box-shadow:0 2px 8px rgba(0, 0, 0, 0.03), 0 0 20px rgba(0, 0, 0, 0.01) inset, 0 -3px 0 0 ' . react_sanitize_color($palette['background_even_darker']) . ' inset;
	 }
	.sdbr-bxd.wgt-undrln #sidebar' . $paletteSelector . ' .widget h3.widget-title,
	.pop-bxd.wgt-undrln .popdown' . $paletteSelector . ' .widget h3.widget-title,
	.foot-bxd.wgt-undrln .footer' . $paletteSelector . ' .widget h3.widget-title {
		' . react_css_color($palette['background_lighter']) . '
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}


	'; } ?>

	 <?php if ($palette['text']) echo '
	' . $paletteSelector . ' .tcw-contact-details,
	' . $paletteSelector . ' #wp-calendar #today,
	' . $paletteSelector . ' .tcw-opening-times,
	' . $paletteSelector . ' .tcs-opening-times,
	' . $paletteSelector . ' #wp-calendar caption,
	' . $paletteSelector . ' .tcs-pullquote p,
	' . $paletteSelector . ' .tcp-portfolio-item-title .react-vote .count {
		' . react_css_color($palette['text'], 'color') . '
	}'; ?>
	<?php if ($palette['background_even_darker']) echo '
	' . $paletteSelector . ' #wp-calendar thead th,
	' . $paletteSelector . ' #wp-calendar tbody td,
	' . $paletteSelector . ' #wp-calendar th,
	' . $paletteSelector . ' #wp-calendar td,
	' . $paletteSelector . ' ul.menu li ul li ul a,
	' . $paletteSelector . ' .widget_nav_menu ul.menu > li ul li ul,
	' . $paletteSelector . ' .tcs-fancy-table table th,
	' . $paletteSelector . ' table th,
	' . $paletteSelector . ' #comments .comment-respond,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-group-style-plain > .iphorm-group-elements .iphorm-group-title-description-wrap {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}'; ?>

	<?php if ($palette['background_even_darker']) echo '
	.wgt-undrln ' . $paletteSelector . ' .widget h3.widget-title, ' . $paletteSelector . ' .tcp-portfolio-items .tcp-entry-meta,
	' . $paletteSelector . ' .ls-reactskin .ls-bottom-nav-wrapper {
		' . react_css_color($palette['background_even_darker'], 'border-color') . '
	}
	.wgt-undrln ' . $paletteSelector . ' .widget h3.widget-title:after,
	.archive ' . $paletteSelector . ' .entry-content:after, .author ' . $paletteSelector . ' .entry-content:after, .blog ' . $paletteSelector . ' .entry-content:after, .search ' . $paletteSelector . ' .entry-content:after {
		' . react_css_color($palette['background']) . '
		' . react_css_color($palette['background_much_darker'], 'border-color') . '
	}'; ?>
	<?php if ($palette['background_icon_image'] == 'light') echo '
		' . $paletteSelector . ' .widget_nav_menu ul.menu li ul li ul a,
		' . $paletteSelector . ' .widget_nav_menu ul.menu li ul li ul a:hover,
		' . $paletteSelector . ' .widget_nav_menu ul.menu li > a,
		' . $paletteSelector . ' .widget_nav_menu ul.menu li > a:hover,
		' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > div > ul > li > a,
		' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > ul > li > a,
		' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > div > ul > li:hover > a,
		' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > ul > li:hover > a {
			background-image: url(../../react/images/sml-right-arrow-light.png);
		}
		' . $paletteSelector . ' .react .theme-default .nivo-controlNav a,
		' . $paletteSelector . ' .react .vc-carousel-indicators li {
			background-image: url(../../react/images/icons/sprites-16-light.png);
		}
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a:after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

		' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a:after,
		' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
		' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,
		' . $paletteSelector . ' .tcw-contact-details .sml.drk.iconsprite,
		' . $paletteSelector . ' .tcw-contact-details .drk-ico .sml.iconsprite {
			background-image: url(../../react/images/icons/sprites-16-light.png) !important;
		}

		' . $paletteSelector . ' .tcs-list.tcs-list-bullet li:after,
		' . $paletteSelector . ' .tcs-list.tcs-list-tick li:after,
		' . $paletteSelector . ' .tcs-list.tcs-list-question li:after,
		' . $paletteSelector . ' .tcs-list.tcs-list-arrow li:after,
		' . $paletteSelector . ' .tcs-list.tcs-list-tick-plain li:after,
		' . $paletteSelector . ' .tcs-list.tcs-list-arrow-drawn li:after,


		' . $paletteSelector . ' .tcs-list.tcs-list-tick-plain li .after,
		' . $paletteSelector . ' .tcs-list.tcs-list-arrow-drawn li .after,
		' . $paletteSelector . ' .tcs-list.tcs-list-bullet li .after,
		' . $paletteSelector . ' .tcs-list.tcs-list-tick li .after,
		' . $paletteSelector . ' .tcs-list.tcs-list-question li .after,
		' . $paletteSelector . ' .tcs-list.tcs-list-arrow li .after {
			background-position: bottom left;
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			' . $paletteSelector . ' .widget_nav_menu ul.menu li ul li ul a,
			' . $paletteSelector . ' .widget_nav_menu ul.menu li ul li ul a:hover,
			' . $paletteSelector . ' .widget_nav_menu ul.menu li > a,
			' . $paletteSelector . ' .widget_nav_menu ul.menu li > a:hover,
			' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > div > ul > li > a,
			' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > ul > li > a,
			' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > div > ul > li:hover > a,
			' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > ul > li:hover > a {
				background-image: url(../../react/images/sml-right-arrow-light@2x.png);
				background-size: 6px 9px;
			}
			' . $paletteSelector . ' .react .theme-default .nivo-controlNav a,
			' . $paletteSelector . ' .react .vc-carousel-indicators li {
				background-image: url(../../react/images/icons/sprites-32-light.png);
				background-size: 496px 240px;
			}
			' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a:after,
			' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
			' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

			' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a:after,
			' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
			' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,
			' . $paletteSelector . ' .tcw-contact-details .sml.drk.iconsprite,
			' . $paletteSelector . ' .tcw-contact-details .drk-ico .sml.iconsprite {
				background-image: url(../../react/images/icons/sprites-32-light.png) !important;
				background-size: 496px 240px;
			}
		}

	';
	elseif ($palette['background_icon_image'] == 'dark') echo '
		' . $paletteSelector . ' .widget_nav_menu ul.menu li ul li ul a,
		' . $paletteSelector . ' .widget_nav_menu ul.menu li ul li ul a:hover,
		' . $paletteSelector . ' .widget_nav_menu ul.menu li > a,
		' . $paletteSelector . ' .widget_nav_menu ul.menu li > a:hover,
		' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > div > ul > li > a,
		' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > ul > li > a,
		' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > div > ul > li:hover > a,
		' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > ul > li:hover > a {
			background-image: url(../../react/images/sml-right-arrow-dark.png);
		}
		' . $paletteSelector . ' .react .theme-default .nivo-controlNav a,
		' . $paletteSelector . ' .react .vc-carousel-indicators li {
			background-image: url(../../react/images/icons/sprites-16-dark.png);
		}
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a:after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

		' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a:after,
		' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
		' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,
		' . $paletteSelector . ' .tcw-contact-details .sml.drk.iconsprite,
		' . $paletteSelector . ' .tcw-contact-details .drk-ico .sml.iconsprite {
			background-image: url(../../react/images/icons/sprites-16-dark.png) !important;
		}
		' . $paletteSelector . ' .tcs-list.tcs-list-bullet li:after,
		' . $paletteSelector . ' .tcs-list.tcs-list-tick li:after,
		' . $paletteSelector . ' .tcs-list.tcs-list-question li:after,
		' . $paletteSelector . ' .tcs-list.tcs-list-arrow li:after,
		' . $paletteSelector . ' .tcs-list.tcs-list-tick-plain li:after,
		' . $paletteSelector . ' .tcs-list.tcs-list-arrow-drawn li:after,

		' . $paletteSelector . ' .tcs-list.tcs-list-tick-plain li .after,
		' . $paletteSelector . ' .tcs-list.tcs-list-arrow-drawn li .after,
		' . $paletteSelector . ' .tcs-list.tcs-list-bullet li .after,
		' . $paletteSelector . ' .tcs-list.tcs-list-tick li .after,
		' . $paletteSelector . ' .tcs-list.tcs-list-question li .after,
		' . $paletteSelector . ' .tcs-list.tcs-list-arrow li .after {
			background-position: left top;
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			' . $paletteSelector . ' .widget_nav_menu ul.menu li ul li ul a,
			' . $paletteSelector . ' .widget_nav_menu ul.menu li ul li ul a:hover,
			' . $paletteSelector . ' .widget_nav_menu ul.menu li > a,
			' . $paletteSelector . ' .widget_nav_menu ul.menu li > a:hover,
			' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > div > ul > li > a,
			' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > ul > li > a,
			' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > div > ul > li:hover > a,
			' . $paletteSelector . ' .tcs-menu.tcs-menu-separator > ul > li:hover > a {
				background-image: url(../../react/images/sml-right-arrow-dark@2x.png);
				background-size: 6px 9px;
			}
			' . $paletteSelector . ' .react .theme-default .nivo-controlNav a,
			' . $paletteSelector . ' .react .vc-carousel-indicators li {
				background-image: url(../../react/images/icons/sprites-32-dark.png);
				background-size: 496px 240px;
			}
			' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a:after,
			' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
			' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,

			' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a:after,
			' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a:hover:after,
			' . $paletteSelector . ' .widget-area .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:hover:after,
			' . $paletteSelector . ' .tcw-contact-details .sml.drk.iconsprite,
			' . $paletteSelector . ' .tcw-contact-details .drk-ico .sml.iconsprite {
				background-image: url(../../react/images/icons/sprites-32-dark.png) !important;
				background-size: 496px 240px;
			}
		}
	'; ?>
	 <?php /* LIGHT colors */ ?>
	 <?php if ($palette['light_bg']) echo '
	' . $paletteSelector . ' span.tcs-icon.tcs-style-light {
		' . react_css_color($palette['light_bg'], 'color') . '
	}'; ?>

	<?php if ($palette['light_bg'] || $palette['light_bg_darker'] || $palette['light_fg']) { echo '
	' . $paletteSelector . ' .tcs-box.tcs-box-basic-light,
	' . $paletteSelector . ' .tcw-tweet-light li,
	' . $paletteSelector . ' .react.vc_call_to_action.light,
	' . $paletteSelector . ' .react.vc_call_to_action {
		' . react_css_color($palette['light_bg'], 'background') . '
		' . react_css_color($palette['light_fg'], 'color') . '
		' . react_css_color($palette['light_bg_darker'], 'border-color') . '
		-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.3), inset 0px 0px 60px 0px rgba(0, 0, 0, 0.02), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
		 box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.3), inset 0px 0px 60px 0px rgba(0, 0, 0, 0.02), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
	}'; } ?>
	<?php if ($palette['light_bg'] || $palette['light_fg']) { echo '
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > a,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > span.tcs-r-button,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-light {
		background: transparent;
		' . react_css_color($palette['text'], 'color') . '
		' . react_css_color($palette['light_bg'], 'border-color') . '
	}
	' . $paletteSelector . ' .tcs-progress-bar-outer,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > a.tcs-has-back-animation:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > span.tcs-r-button.tcs-has-back-animation:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > a.tcs-has-back-animation:hover:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > span.tcs-r-button.tcs-has-back-animation:hover:before,
	' . $paletteSelector . ' .tagcloud > a,
	' . $paletteSelector . ' .woocommerce .widget_layered_nav ul li,
	' . $paletteSelector . ' .tcp-portfolio-filter .tcp-filter-button,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two ul li a,
	' . $paletteSelector . ' .tcs-button.tcs-style-light > a,
	' . $paletteSelector . ' .tcs-button.tcs-style-light > span.tcs-r-button,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > a:hover,
	' . $paletteSelector . ' .tcs-image-hover.tcs-hover-light,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > span.tcs-r-button:hover,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-light:hover,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-light:before,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-light:hover:before,
	' . $paletteSelector . ' .tcs-tabs ul.tcs-tabs-nav li a,
	' . $paletteSelector . ' ul#comment-tabs-nav li a,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3,
	' . $paletteSelector . ' code,
	' . $paletteSelector . ' pre,
	' . $paletteSelector . ' kbd,
	' . $paletteSelector . ' tt,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-upload-queue-file,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphom-upload-progress-wrap,
	' . $paletteSelector . ' .tcs-impact-header.tcs-light,
	' . $paletteSelector . ' blockquote,
	' . $paletteSelector . ' .tcs-blockquote .tcs-blockquote-inner,
	' . $paletteSelector . ' .tcs-fancy-header.tcs-style3,
	' . $paletteSelector . ' .searchform label,
	' . $paletteSelector . ' .woocommerce.widget_product_search label,
	' . $paletteSelector . ' span.tcs-icon.tcs-boxed.tcs-style-light,
	' . $paletteSelector . ' .wpb_content_element.react.light .wpb_tabs_nav li.ui-tabs-active,
	' . $paletteSelector . ' .wpb_content_element.react .wpb_accordion_wrapper .wpb_accordion_header,
	' . $paletteSelector . ' .vc_progress_bar.react .vc_single_bar,
	' . $paletteSelector . ' .wpb_content_element.wpb_tabs.react.light .wpb_tour_tabs_wrapper .wpb_tab {
		' . react_css_color($palette['light_bg'], 'background') . '
		' . react_css_color($palette['light_fg'], 'color') . '
	}'; } ?>
	<?php if ($palette['light_bg']) echo '
	' . $paletteSelector . ' .tcs-blockquote .tcs-blockquote-inner:after, ' . $paletteSelector . ' .tcs-fancy-header.tcs-style3:after,
	' . $paletteSelector . ' .searchform label:after,
	' . $paletteSelector . ' .woocommerce.widget_product_search label:after {
		' . react_css_color($palette['light_bg'], 'border-top-color') . '
	}'; ?>
	<?php if ($palette['light_bg_gradient']) echo '
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > a.tcs-has-back-animation:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > span.tcs-r-button.tcs-has-back-animation:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > a.tcs-has-back-animation:hover:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > span.tcs-r-button.tcs-has-back-animation:hover:before,
	' . $paletteSelector . ' .tcs-box.tcs-box-basic-light,
	' . $paletteSelector . ' .tcw-tweet-light li,
	' . $paletteSelector . ' .react.vc_call_to_action.light,
	' . $paletteSelector . ' .react.vc_call_to_action,
	' . $paletteSelector . ' .tagcloud > a,
	' . $paletteSelector . ' .woocommerce .widget_layered_nav ul li,
	' . $paletteSelector . ' .tcp-portfolio-filter .tcp-filter-button,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two ul li a,
	' . $paletteSelector . ' .tcs-button.tcs-style-light > a,
	' . $paletteSelector . ' .tcs-button.tcs-style-light > span.tcs-r-button,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > a:hover,
	' . $paletteSelector . ' .tcs-image-hover.tcs-hover-light,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > span.tcs-r-button:hover,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-light:hover,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-light:before,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-light:hover:before,
	' . $paletteSelector . ' .tcs-tabs ul.tcs-tabs-nav li a,
	' . $paletteSelector . ' ul#comment-tabs-nav li a,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3,
	' . $paletteSelector . ' code,
	' . $paletteSelector . ' pre,
	' . $paletteSelector . ' kbd,
	' . $paletteSelector . ' tt,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-upload-queue-file,
	' . $paletteSelector . ' .iphom-upload-progress-wrap,
	' . $paletteSelector . ' .tcs-impact-header.tcs-light,
	' . $paletteSelector . ' blockquote,
	' . $paletteSelector . ' .tcs-blockquote .tcs-blockquote-inner,
	' . $paletteSelector . ' .tcs-fancy-header.tcs-style3,
	.search ' . $paletteSelector . ' .searchform label,
	' . $paletteSelector . ' .woocommerce.widget_product_search label,
	' . $paletteSelector . ' .wpb_content_element.react .wpb_accordion_wrapper .wpb_accordion_header,
	' . $paletteSelector . ' .vc_progress_bar.react .vc_single_bar {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['light_bg_lighter']) . ' 0%, ' . react_sanitize_color($palette['light_bg_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['light_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['light_bg_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['light_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['light_bg_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['light_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['light_bg_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['light_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['light_bg_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['light_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['light_bg_darker']) . ' 100%);
	}
	' . $paletteSelector . ' .tcs-blockquote .tcs-blockquote-inner:after, ' . $paletteSelector . ' .tcs-fancy-header.tcs-style3:after,
	' . $paletteSelector . ' .searchform label:after,
	' . $paletteSelector . ' .woocommerce.widget_product_search label:after {
		' . react_css_color($palette['light_bg_darker'], 'border-top-color') . '
	}'; ?>

	<?php if ($palette['light_bg_gradient']) echo '
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two ul li a:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-light > a:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-light > span.tcs-r-button:hover {
		' . react_css_color($palette['light_bg_darker'], 'background') . '
	}'; ?>
	<?php if ($palette['light_bg_darker']) echo '
	' . $paletteSelector . ' .tcs-tabs ul.tcs-tabs-nav li a:hover,
	' . $paletteSelector . ' ul#comment-tabs-nav li a:hover,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3:hover,
	' . $paletteSelector . ' .tcp-portfolio-filter .tcp-filter-button:hover,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-group-style-bordered .iphorm-element-wrap > .iphorm-element-spacer > label,
	' . $paletteSelector . ' .wpb_content_element.react .wpb_tabs_nav li {
		' . react_css_color($palette['light_bg_darker']) . '
		' . react_css_color($palette['light_fg_even_darker'], 'color') . '
	}
	' . $paletteSelector . ' .tcs-tabs ul.tcs-tabs-nav li a:hover:after,
	' . $paletteSelector . ' ul#comment-tabs-nav li a:hover:after {
		' . react_css_color($palette['light_bg_darker'], 'border-top-color') . '
	}'; ?>
	<?php if ($palette['light_bg_lighter'] || $palette['light_bg_much_darker'] || $palette['light_fg']) { echo '
	' . $paletteSelector . ' #commentform input[type="text"],
	' . $paletteSelector . ' .searchform input[type="text"],
	' . $paletteSelector . ' .woocommerce.widget_product_search input[type="search"],
	' . $paletteSelector . ' #commentform select,
	' . $paletteSelector . ' #commentform textarea,
	' . $paletteSelector . ' .widget_archive select,
	' . $paletteSelector . ' .widget_categories select,
	' . $paletteSelector . ' .textwidget select,
	' . $paletteSelector . ' .textwidget input,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-text input,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-captcha input,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-email input,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-password input,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap select,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap textarea {
		' . react_css_color($palette['light_bg']) . '
		' . react_css_color($palette['light_bg_much_darker'], 'border-color') . '
		' . react_css_color($palette['light_fg'], 'color') . '
	}

	.sdbr-bxd #sidebar' . $paletteSelector . ' #commentform input[type="text"],
	.sdbr-bxd #sidebar' . $paletteSelector . ' #commentform select,
	.sdbr-bxd #sidebar' . $paletteSelector . ' .searchform input[type="text"],
	.sdbr-bxd #sidebar' . $paletteSelector . ' .widget_archive select,
	.sdbr-bxd #sidebar' . $paletteSelector . ' .widget_categories select,
	.sdbr-bxd #sidebar' . $paletteSelector . ' .woocommerce.widget_product_search input[type="search"],
	.sdbr-bxd #sidebar' . $paletteSelector . ' .textwidget select,
	.sdbr-bxd #sidebar' . $paletteSelector . ' .textwidget input,

	.foot-bxd .popdown' . $paletteSelector . ' #commentform input[type="text"],
	.foot-bxd .popdown' . $paletteSelector . ' #commentform select,
	.foot-bxd .popdown' . $paletteSelector . ' .searchform input[type="text"],
	.foot-bxd .popdown' . $paletteSelector . ' .widget_archive select,
	.foot-bxd .popdown' . $paletteSelector . ' .widget_categories select,
	.foot-bxd .popdown' . $paletteSelector . ' .woocommerce.widget_product_search input[type="search"],
	.foot-bxd .popdown' . $paletteSelector . ' .textwidget select,
	.foot-bxd .popdown' . $paletteSelector . ' .textwidget input,


	.pop-bxd .footer' . $paletteSelector . ' #commentform input[type="text"],
	.pop-bxd .footer' . $paletteSelector . ' #commentform select,
	.pop-bxd .footer' . $paletteSelector . ' .searchform input[type="text"],
	.pop-bxd .footer' . $paletteSelector . ' .widget_archive select,
	.pop-bxd .footer' . $paletteSelector . ' .widget_categories select,
	.pop-bxd .footer' . $paletteSelector . ' .woocommerce.widget_product_search input[type="search"],
	.pop-bxd .footer' . $paletteSelector . ' .textwidget select,
	.pop-bxd .footer' . $paletteSelector . ' .textwidget input {
		' . react_css_color($palette['light_bg']) . '
		' . react_css_color($palette['light_bg_much_darker'], 'border-color') . '
		' . react_css_color($palette['light_fg'], 'color') . '
	}


	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-text input,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-captcha input,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-email input,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-password input,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap select,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap textarea {
		' . react_css_color($palette['light_bg_even_lighter']) . '
		' . react_css_color($palette['light_bg_much_darker'], 'border-color') . '
	}
	'; } ?>
	<?php if ($palette['light_bg_even_darker'] || $palette['light_fg_even_darker'] || $palette['primary_bg']) { echo '
	' . $paletteSelector . ' #commentform input[type="text"]:focus,
	' . $paletteSelector . ' .searchform input[type="text"]:focus,
	' . $paletteSelector . ' .woocommerce.widget_product_search input[type="search"]:focus,
	' . $paletteSelector . ' #commentform select:focus,
	' . $paletteSelector . ' #commentform textarea:focus,
	' . $paletteSelector . ' .widget_archive select:focus,
	' . $paletteSelector . ' .textwidget select:focus,
	' . $paletteSelector . ' .textwidget input:focus,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-text input:focus,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-captcha input:focus,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-email input:focus,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap-password input:focus,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap select:focus,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-element-wrap textarea:focus {
		' . react_css_color($palette['light_bg_darker']) . '
		' . react_css_color($palette['light_fg_even_darker'], 'color') . '
		' . react_css_color($palette['primary_bg'], 'border-color') . '
	}
	' . $paletteSelector . ' .flexible-frame.map .map-cover,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-text input:focus,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-captcha input:focus,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-email input:focus,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap-password input:focus,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap select:focus,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-elements .iphorm-group-style-bordered .iphorm-element-wrap textarea:focus {
		' . react_css_color($palette['light_bg_lighter']) . '
	}
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements .iphorm-group-title-description-wrap {
		' . react_css_color($palette['light_bg_even_lighter']) . '
		' . react_css_color($palette['light_bg_much_darker'], 'border-color') . '
	}
	'; } ?>
	<?php if ($palette['light_bg_even_darker']) echo '
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two.tcs-grouped ul li:last-child a,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two.tcs-grouped ul.menu li:last-child a,
	' . $paletteSelector . ' .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-two ul.menu li a {
		' . react_css_color($palette['light_bg_even_darker'], 'border-color') . '
	}
	' . $paletteSelector . ' .tcs-impact-header.tcs-light,
	' . $paletteSelector . ' .tcs-button.tcs-style-light > a,
	' . $paletteSelector . ' .tcs-button.tcs-style-light > span.tcs-r-button,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-group-style-bordered > .iphorm-group-elements,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-upload-queue-file,
	' . $paletteSelector . ' .iphom-upload-progress-wrap,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two ul li a,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two.tcs-grouped.tcs-inline ul li a,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two.tcs-grouped.tcs-stacked ul li a,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two.tcs-grouped ul li.last-child a,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two.tcs-grouped.tcs-inline ul.menu li a,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two.tcs-grouped.tcs-stacked ul.menu li a,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two.tcs-grouped ul.menu li.last-child a,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-upload-progress-bar-wrap {
		' . react_css_color($palette['light_bg_much_darker'], 'border-color') . '
	}'; ?>
	<?php if ($palette['light_fg']) echo '
	' . $paletteSelector . ' .tcs-impact-header.tcs-light .tcs-impact-heading,
	' . $paletteSelector . ' .tcs-impact-header.tcs-light .tcs-impact-subheading,
	' . $paletteSelector . ' .wpb_content_element.react.light .wpb_tabs_nav li.ui-tabs-active a,
	' . $paletteSelector . ' .iphorm-group-style-bordered > .iphorm-group-elements,
	' . $paletteSelector . ' .iphorm-upload-queue-file,
	' . $paletteSelector . ' .iphom-upload-progress-wrap,
	' . $paletteSelector . ' .js .iphorm-theme-react-default .element-wrapper.inside-label > label,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-group-style-bordered .iphorm-element-wrap > .iphorm-element-spacer > label,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-group-style-bordered .iphorm-element-wrap > .iphorm-element-spacer > label,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-element-wrap-text.iphorm-labels-inside > .iphorm-element-spacer > label,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-element-wrap-textarea.iphorm-labels-inside > .iphorm-element-spacer > label,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-element-wrap-email.iphorm-labels-inside > .iphorm-element-spacer > label,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-element-wrap-password.iphorm-labels-inside > .iphorm-element-spacer > label,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-element-wrap-captcha.iphorm-labels-inside > .iphorm-element-spacer > label,
	' . $paletteSelector . ' .wpb_content_element.react .wpb_tabs_nav li a,
	' . $paletteSelector . ' .tcs-box.tcs-box-basic-light > a,
	' . $paletteSelector . ' .tcs-box.tcs-box-basic-light > a:hover,
	' . $paletteSelector . ' .tcw-tweet-light li a:hover,
	' . $paletteSelector . ' .tcw-tweet-light li a:hover,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3 a,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3:hover,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3.tcs-active,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3 a:hover {
		' . react_css_color($palette['light_fg'], 'color') . '
	}'; ?>
	<?php if ($palette['light_bg_lighter']) echo '
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-two ul li a:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-light > a:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-light > span.tcs-r-button:hover {
		' . react_css_color($palette['light_bg_lighter']) . '
	}'; ?>
	<?php if ($palette['light_icon']) echo '
	' . $paletteSelector . ' .tcs-button.tcs-has-drop.tcs-style-light .tcs-open-drop-trigger,
	' . $paletteSelector . ' .tcs-button.tcs-style-light > a > i,
	' . $paletteSelector . ' .tcs-button.tcs-style-light > span.tcs-r-button > i,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > a:hover > i,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-light > span.tcs-r-button:hover > i,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-light:hover > i,
	' . $paletteSelector . ' .tcs-impact-header.tcs-light > i,
	' . $paletteSelector . ' .tcs-fancy-header.tcs-style3 > i {
		' . react_css_color($palette['light_icon'], 'color') . '
	}'; ?>



















	<?php if ($palette['light_icon_image'] == 'dark') echo '
		' . $paletteSelector . ' .tcs-button.tcs-style-light i.iconsprite.drk {
			background-image: url(../../react/images/icons/sprites-16-dark.png) !important;
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
				' . $paletteSelector . ' .tcs-button.tcs-style-light i.iconsprite.drk {
				background-image: url(../../react/images/icons/sprites-32-dark.png) !important;
				background-size: 496px 240px;
			}
		}
		';
		elseif ($palette['light_icon_image'] == 'light') echo '

		' . $paletteSelector . ' .tcs-button.tcs-style-light i.iconsprite.drk {
			background-image: url(../../react/images/icons/sprites-16-light.png) !important;
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			' . $paletteSelector . ' .tcs-button.tcs-style-light i.iconsprite.drk {
				background-image: url(../../react/images/icons/sprites-32-light.png) !important;
				background-size: 496px 240px;
			}
		}
		';
	?>


	<?php /* DARK colors */ ?>
	<?php if ($palette['dark_bg']) echo '
	' . $paletteSelector . ' span.tcs-icon.tcs-style-dark {
		' . react_css_color($palette['dark_bg'], 'color') . '
	}'; ?>
	<?php if ($palette['dark_bg'] || $palette['dark_fg']) { echo '
	' . $paletteSelector . ' .tcs-progress-bar-outer.tcs-dark .tcs-progress-bar,
	' . $paletteSelector . ' .tcs-progress-label,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-datepicker-icon,
	' . $paletteSelector . ' .x-close,
	' . $paletteSelector . ' .tcs-cycle-controls-wrap a,
	' . $paletteSelector . ' .woocommerce ul.cart_list li a.remove,
	' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-prev,
	' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-next,
	' . $paletteSelector . ' .ls-reactskin .ls-nav-start,
	' . $paletteSelector . ' .ls-reactskin .ls-nav-start.ls-nav-start-active,
	' . $paletteSelector . ' .ls-reactskin .ls-nav-stop,
	' . $paletteSelector . ' .ls-reactskin .ls-nav-stop.ls-nav-active,
	' . $paletteSelector . ' .ls-reactskin a.ls-nav-next,
	' . $paletteSelector . ' .ls-reactskin a.ls-nav-prev {
		' . react_css_color($palette['dark_bg']) . '
		' . react_css_color($palette['dark_fg'], 'color') . '
	}
	' . $paletteSelector . ' .tcs-progress-label:after {
		' . react_css_color($palette['dark_bg'], 'border-top-color') . '
	}
	'; } ?>
	<?php if ($palette['dark_bg'] || $palette['primary_fg']) { echo '
	' . $paletteSelector . ' a.fancybox-close,
	' . $paletteSelector . ' a.fancybox-nav.fancybox-next > span,
	' . $paletteSelector . ' a.fancybox-nav.fancybox-prev > span,
	' . $paletteSelector . ' .rev_slider_wrapper .tp-rightarrow.custom,
	' . $paletteSelector . ' .rev_slider_wrapper .tp-leftarrow.custom {
		' . react_css_color($palette['dark_bg'], 'background-color', '!important') . '
		' . react_css_color($palette['dark_fg'], 'color', '!important') . '
	}'; } ?>
	<?php if ($palette['dark_bg'] || $palette['dark_fg']) { echo '
	' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > a, ' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > span.tcs-r-button,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark {
		background: transparent;
		' . react_css_color($palette['text'], 'color') . '
		' . react_css_color($palette['dark_bg'], 'border-color') . '

	}
	' . $paletteSelector . ' .flexible-frame.map .map-cover.hide:after,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > a.tcs-has-back-animation:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > span.tcs-r-button.tcs-has-back-animation:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > a.tcs-has-back-animation:hover:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > span.tcs-r-button.tcs-has-back-animation:hover:before,
	' . $paletteSelector . ' .tcs-image-hover.tcs-hover-dark,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > a:hover,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > span.tcs-r-button:hover,
	' . $paletteSelector . ' .tcs-button.tcs-has-drop.tcs-holw-btn .tcs-open-drop-trigger i,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark:hover,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-dark:before,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-dark:hover:before {
		' . react_css_color($palette['dark_bg']) . '
		' . react_css_color($palette['dark_fg'], 'color') . '
	}
	' . $paletteSelector . ' .tcs-impact-header.tcs-dark,
	' . $paletteSelector . ' #fs-controls,
	' . $paletteSelector . ' #video-controls,
	' . $paletteSelector . ' #audio-controls,
	' . $paletteSelector . ' .entry-info .post-icon,
	' . $paletteSelector . ' .entry-info .date,
	' . $paletteSelector . ' .entry-info .react-vote,
	' . $paletteSelector . ' .tcp-entry-info .tcp-date,
	' . $paletteSelector . ' .tcp-entry-info .react-vote,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3 span.tcs-acc-icon,
	' . $paletteSelector . ' .react .wpb_tour_next_prev_nav a,
	' . $paletteSelector . ' #nav-single .nav-previous .meta-nav,
	' . $paletteSelector . ' #nav-single .nav-next .meta-nav,
	' . $paletteSelector . ' .content-nav .nav-previous .meta-nav,
	' . $paletteSelector . ' .content-nav .nav-next .meta-nav,
	' . $paletteSelector . ' .comments div.comment .reply a,
	' . $paletteSelector . ' .comments ul.children div.comment .reply a,
	' . $paletteSelector . ' .tcs-has-drop.tcs-no-palette .tcs-drop-content,
	' . $paletteSelector . ' #comments .comment-respond h3#reply-title,
	' . $paletteSelector . ' span.tcs-icon.tcs-boxed.tcs-style-dark,
	' . $paletteSelector . ' .vc_progress_bar.react .vc_single_bar .vc_label,
	' . $paletteSelector . ' .react .vc-carousel-control .icon-prev,
	' . $paletteSelector . ' .react .vc-carousel-control .icon-next,
	' . $paletteSelector . ' .react .flex-direction-nav a.flex-next,
	' . $paletteSelector . ' .react .flex-direction-nav a.flex-prev,
	' . $paletteSelector . ' .react .theme-default .nivo-directionNav a,
	' . $paletteSelector . ' .wpb_content_element.react.dark .wpb_tabs_nav li.ui-tabs-active,
	' . $paletteSelector . ' .vc_separator.react h4,
	' . $paletteSelector . ' .wpb_content_element.wpb_tabs.react.dark .wpb_tour_tabs_wrapper .wpb_tab,
	' . $paletteSelector . ' .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-read-more a.tcp-basic-button.tcp-dark-button {
		' . react_css_color($palette['dark_bg'], 'background') . '
		' . react_css_color($palette['dark_fg'], 'color') . '
	}
	' . $paletteSelector . ' .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-portfolio-read-more a.tcp-basic-button.tcp-dark-button:hover {
		' . react_css_color($palette['dark_bg_darker'], 'background') . '
	}'; } ?>
	<?php if ($palette['dark_bg']) echo '
	' . $paletteSelector . ' #fs-controls:hover:after,
	' . $paletteSelector . ' #video-controls:hover:after,
	' . $paletteSelector . ' #audio-controls:hover:after {
		' . react_css_color($palette['dark_bg'], 'border-left-color') . '
	}'; ?>
	<?php if ($palette['dark_bg_lighter'] || $palette['dark_bg_even_darker']) { echo '
	' . $paletteSelector . ' .tcs-impact-header-link-wrap a.tcs-impact-link,
	' . $paletteSelector . ' .tcs-impact-header-link-wrap span.tcs-impact-link {
		' . react_css_color($palette['dark_bg_lighter'], 'background') . '
		' . react_css_color($palette['dark_bg_even_darker'], 'border-color') . '

	}'; } ?>
	<?php if ($palette['dark_bg_even_lighter']) echo '
	' . $paletteSelector . ' .tcs-impact-header-link-wrap a.tcs-impact-link:hover,
	' . $paletteSelector . ' .tcs-impact-header-link-wrap span.tcs-impact-link:hover {
		' . react_css_color($palette['dark_bg_even_lighter']) . '
	}'; ?>
	<?php if ($palette['dark_bg_even_lighter']) echo '
	' . $paletteSelector . ' .tcs-impact-header.tcs-dark {
		' . react_css_color($palette['dark_bg_darker'], 'border-color') . '
	}'; ?>
	<?php if ($palette['dark_fg']) echo '
	' . $paletteSelector . ' .tcs-cycle-controls-wrap a,
	' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-prev,
	' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-next,
	' . $paletteSelector . ' .x-close,
	' . $paletteSelector . ' .date .day,
	' . $paletteSelector . ' .entry-info .react-vote .count,
	' . $paletteSelector . ' .react-vote .like,
	' . $paletteSelector . ' .tcp-date .tcp-day,
	' . $paletteSelector . ' .tcp-entry-info .react-vote .count,
	' . $paletteSelector . ' .tcs-drop-close,
	' . $paletteSelector . ' .tcs-box.tcs-box-basic-dark a,
	' . $paletteSelector . ' .tcs-box.tcs-box-basic-dark a:hover,
	' . $paletteSelector . ' .tcw-tweet-dark li a,
	' . $paletteSelector . ' .tcw-tweet-dark li a:hover {
		' . react_css_color($palette['dark_fg'], 'color') . '
	}
	' . $paletteSelector . ' .tcs-impact-header.tcs-dark .tcs-impact-heading,
	' . $paletteSelector . ' .tcs-impact-header.tcs-dark .tcs-impact-subheading,
	' . $paletteSelector . ' .wpb_content_element.react.dark .wpb_tabs_nav li.ui-tabs-active a,
	' . $paletteSelector . ' .tcs-impact-header-link-wrap a.tcs-impact-link,
	' . $paletteSelector . ' .tcs-impact-header-link-wrap span.tcs-impact-link,
	' . $paletteSelector . ' .entry-info .react-vote .like:hover,
	' . $paletteSelector . ' .tcp-entry-info .react-vote .like:hover,
	' . $paletteSelector . ' .date .month,
	' . $paletteSelector . ' .tcp-date .tcp-month,
	' . $paletteSelector . ' #open-close-close  {
		' . react_css_color($palette['dark_fg'], 'color') . '
	}'; ?>
	<?php if ($palette['dark_bg_lighter']) echo '
   ' . $paletteSelector . ' #open-close-close, ' . $paletteSelector . ' .tcs-drop-close {
		' . react_css_color($palette['dark_bg_lighter']) . '
	}
	' . $paletteSelector . ' .tcp-portfolio.tcp-date-like-above .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-entry-info > div,
	' . $paletteSelector . ' .tcp-portfolio.tcp-date-like-above .tcp-portfolio-item.tcp-portfolio-item-image-on-hover .tcp-entry-info > span,
	' . $paletteSelector . ' .tcp-portfolio.tcp-boxed .tcp-portfolio-item .tcp-entry-info > span,
	' . $paletteSelector . ' .tcp-portfolio.tcp-boxed .tcp-portfolio-item .tcp-entry-info > div,
	' . $paletteSelector . ' .tcp-portfolio.tcp-date-like-above .tcp-entry-info .tcp-date {
		' . react_css_color($palette['dark_bg_even_lighter'], 'border-color') . '
	}'; ?>
	<?php if ($palette['dark_bg']) echo '
	' . $paletteSelector . ' .color .tcs-impact-header-link-wrap a.tcs-impact-link:hover,
	' . $paletteSelector . ' .color .tcs-impact-header-link-wrap span.tcs-impact-link:hover {
		' . react_css_color($palette['dark_bg'], 'background', '!important') . '
	}'; ?>
	<?php
		if ($palette['dark_bg']) {
			echo '
				' . $paletteSelector . ' .tcs-box.tcs-box-basic-dark,
				' . $paletteSelector . ' .tcw-tweet-dark li,
				' . $paletteSelector . ' .react.vc_call_to_action.dark {
					text-shadow: -1px -1px 0 ' . react_sanitize_color($palette['dark_bg_even_darker']) . ';
					' . react_css_color($palette['dark_bg_lighter'], 'background') . '
					' . react_css_color($palette['dark_fg'], 'color') . '
					' . react_css_color($palette['dark_bg_much_darker'], 'border-color') . '
					-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1), inset 0px 0px 60px 0px ' . react_sanitize_color($palette['dark_bg_much_darker']). ', 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
					box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1), inset 0px 0px 60px 0px ' . react_sanitize_color($palette['dark_bg_much_darker']) . ',  0 0 0 1px rgba(255, 255, 255, 0.1) inset;
				}

				' . $paletteSelector . ' .tcs-button.tcs-style-dark > a, ' . $paletteSelector . ' .tcs-button.tcs-style-dark > span.tcs-r-button {
					' . react_css_color($palette['dark_bg'], 'background') . '
					' . react_css_color($palette['dark_fg'], 'color') . '
					-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
					box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);

				}
				' . $paletteSelector . ' .tcs-button.tcs-style-dark > a:hover, ' . $paletteSelector . ' .tcs-button.tcs-style-dark > span.tcs-r-button:hover {
					' . react_css_color($palette['dark_bg_lighter'], 'background') . '
					-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
					box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
				}
				' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > a, ' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > span.tcs-r-button,
				' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark {
					' . react_css_color($palette['dark_bg'], 'border-color') . '
				}
			';
		}
	?>
	<?php if ($palette['dark_bg_gradient']) echo '
		' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > a.tcs-has-back-animation:before,
		' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > span.tcs-r-button.tcs-has-back-animation:before,
		' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > a.tcs-has-back-animation:hover:before,
		' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > span.tcs-r-button.tcs-has-back-animation:hover:before,
		' . $paletteSelector . ' .tcs-impact-header.tcs-dark,
		' . $paletteSelector . ' .tcs-cycle-controls-wrap a,
		' . $paletteSelector . ' #fs-controls,
		' . $paletteSelector . ' #video-controls,
		' . $paletteSelector . ' #audio-controls,
		' . $paletteSelector . ' .entry-info .post-icon,
		' . $paletteSelector . ' .entry-info .date,
		' . $paletteSelector . ' .entry-info .react-vote,
		' . $paletteSelector . ' .tcp-entry-info .tcp-date,
		' . $paletteSelector . ' .tcp-entry-info .react-vote,
		' . $paletteSelector . ' .tcs-accordion.tcs-box > h3 span.tcs-acc-icon,
		' . $paletteSelector . ' .react .wpb_tour_next_prev_nav a,
		' . $paletteSelector . ' #nav-single .nav-previous .meta-nav,
		' . $paletteSelector . ' #nav-single .nav-next .meta-nav,
		' . $paletteSelector . ' .content-nav .nav-previous .meta-nav,
		' . $paletteSelector . ' .tcs-has-drop.tcs-no-palette .tcs-drop-content,
		' . $paletteSelector . ' .content-nav .nav-next .meta-nav,
		' . $paletteSelector . ' .comments div.comment .reply a,
		' . $paletteSelector . ' .comments ul.children div.comment .reply a,
		' . $paletteSelector . ' .vc_progress_bar.react .vc_single_bar .vc_label,
		' . $paletteSelector . ' .vc_separator.react h4,
		' . $paletteSelector . ' .desc-hover ul.react-menu li a span.desc,
		' . $paletteSelector . ' .im-trigger span.im-desc,
		' . $paletteSelector . ' .tcs-box.tcs-box-basic-dark,
		' . $paletteSelector . ' .tcw-tweet-dark li,
		' . $paletteSelector . ' .react.vc_call_to_action.dark,
		' . $paletteSelector . ' .tcs-button.tcs-style-dark > a,
		' . $paletteSelector . ' .tcs-button.tcs-style-dark > span.tcs-r-button,
		' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > a:hover,
		' . $paletteSelector . ' .tcs-image-hover.tcs-hover-dark,
		' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > span.tcs-r-button:hover,
		' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark:hover,
		' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-dark:before,
		' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-dark:hover:before {
			background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%, ' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['dark_bg']) . '), color-stop(100%,' . react_sanitize_color($palette['dark_bg_even_darker']) . '));
			background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -o-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
			background: linear-gradient(to bottom, ' . react_sanitize_color($palette['dark_bg']) . ' 0%,' . react_sanitize_color($palette['dark_bg_even_darker']) . ' 100%);
	}'; ?>
	<?php if ($palette['dark_icon']) echo '
	' . $paletteSelector . ' .tcs-button.tcs-has-drop.tcs-style-dark .tcs-open-drop-trigger,
	' . $paletteSelector . ' .tcs-button.tcs-style-dark > a > i,
	' . $paletteSelector . ' .tcs-button.tcs-style-dark span.tcs-r-button > i,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > a:hover > i,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-dark > span.tcs-r-button:hover > i,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-dark:hover > i,
	' . $paletteSelector . ' .tcs-impact-header.tcs-dark > i,

	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3 span.tcs-acc-icon i,
	' . $paletteSelector . ' .tcs-cycle-controls-wrap a > i,
	' . $paletteSelector . ' open-close-close,
	' . $paletteSelector . ' #nav-single .nav-previous .meta-nav i,
	' . $paletteSelector . ' #nav-single .nav-next .meta-nav i,
	' . $paletteSelector . ' .content-nav .nav-previous .meta-nav i,
	' . $paletteSelector . ' .content-nav .nav-next .meta-nav i {
		' . react_css_color($palette['dark_icon'], 'color') . '
	}'; ?>


	<?php if ($palette['dark_icon_image'] == 'dark') echo '
		' . $paletteSelector . ' .ls-reactskin .ls-nav-start:after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-start.ls-nav-start-active:after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a:after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-stop:after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-stop.ls-nav-active:after,

		' . $paletteSelector . ' .ls-reactskin .ls-nav-start .after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-start.ls-nav-start-active .after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a .after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active .after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-stop .after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-stop.ls-nav-active .after,
		' . $paletteSelector . ' .tcs-button.tcs-style-dark i.iconsprite.drk {
			background-image: url(../../react/images/icons/sprites-16-dark.png) !important;
		}
		' . $paletteSelector . ' .x-close,
		' . $paletteSelector . ' #comments .comment-respond h3#reply-title {
			background-image: url(../../react/images/x-close-dark.png);
		}
		' . $paletteSelector . ' a.fancybox-close {
			background-image: url(../../react/images/x-close-dark.png)!important;
		}
		' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-prev,
		' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-next,
		' . $paletteSelector . ' .ls-reactskin a.ls-nav-next,
		' . $paletteSelector . ' .ls-reactskin a.ls-nav-prev,
		' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-prevNav,
		' . $paletteSelector . ' .react .flex-direction-nav a.flex-prev,
		' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-nextNav,
		' . $paletteSelector . ' .react .flex-direction-nav a.flex-next {
			background-image: url(../../react/images/slider-arrows-dark.png);
		}
		' . $paletteSelector . ' .react.wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon {
			background-image: url(../../react/images/sml-down-arrow-dark.png);
		}
		' . $paletteSelector . ' a.fancybox-nav.fancybox-next > span,
		' . $paletteSelector . ' a.fancybox-nav.fancybox-prev > span,
		' . $paletteSelector . ' .rev_slider_wrapper .tp-rightarrow.custom,
		' . $paletteSelector . ' .rev_slider_wrapper .tp-leftarrow.custom {
			background-image: url(../../react/images/slider-arrows-dark.png) !important;
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			' . $paletteSelector . ' .ls-reactskin .ls-nav-start:after,
			' . $paletteSelector . ' .ls-reactskin .ls-nav-start.ls-nav-start-active:after,
			' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a:after,
			' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			' . $paletteSelector . ' .ls-reactskin .ls-nav-stop:after,
			' . $paletteSelector . ' .ls-reactskin .ls-nav-stop.ls-nav-active:after {
				background-image: url(../../react/images/icons/sprites-32-dark.png) !important;
				background-size: 496px 240px;
			}
			' . $paletteSelector . ' .react.wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon {
				background-image: url(../../react/images/sml-down-arrow-dark@2x.png);
				background-size: 9px 6px;
			}
			' . $paletteSelector . ' .x-close,
			' . $paletteSelector . ' #comments .comment-respond h3#reply-title {
				background-image: url(../../react/images/x-close-dark@2x.png);
				background-size: 16px 16px;
			}
			' . $paletteSelector . ' a.fancybox-close {
				background-image: url(../../react/images/x-close-dark@2x.png)!important;
				background-size: 16px 16px!important;
			}
			' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-prev,
			' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-next,
			' . $paletteSelector . ' .ls-reactskin a.ls-nav-next,
			' . $paletteSelector . ' .ls-reactskin a.ls-nav-prev,
			' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-prevNav,
			' . $paletteSelector . ' .react .flex-direction-nav a.flex-prev,
			' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-nextNav,
			' . $paletteSelector . ' .react .flex-direction-nav a.flex-next,
			' . $paletteSelector . ' .tcs-button.tcs-style-dark i.iconsprite.drk {
				background-image: url(../../react/images/slider-arrows-dark@2x.png);
				background-size: 64px 32px;
			}
			' . $paletteSelector . ' a.fancybox-nav.fancybox-next > span,
			' . $paletteSelector . ' a.fancybox-nav.fancybox-prev > span,
			' . $paletteSelector . ' .rev_slider_wrapper .tp-rightarrow.custom,
			' . $paletteSelector . ' .rev_slider_wrapper .tp-leftarrow.custom {
				background-image: url(../../react/images/slider-arrows-dark@2x.png) !important;
				background-size: 64px 32px !important;
			}
		}
		';
		elseif ($palette['dark_icon_image'] == 'light') echo '

		' . $paletteSelector . ' .ls-reactskin .ls-nav-start:after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-start.ls-nav-start-active:after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a:after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-stop:after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-stop.ls-nav-active:after,

		' . $paletteSelector . ' .ls-reactskin .ls-nav-start .after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-start.ls-nav-start-active .after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a .after,
		' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active .after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-stop .after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-stop.ls-nav-active .after,
		' . $paletteSelector . ' .tcs-button.tcs-style-dark i.iconsprite.drk {
			background-image: url(../../react/images/icons/sprites-16-light.png) !important;
		}
		' . $paletteSelector . ' .react.wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon {
			background-image: url(../../react/images/sml-down-arrow-light.png);
		}
		' . $paletteSelector . ' .x-close,
		' . $paletteSelector . ' #comments .comment-respond h3#reply-title {
			background-image: url(../../react/images/x-close-light.png);
		}
		' . $paletteSelector . ' a.fancybox-close {
			background-image: url(../../react/images/x-close-light.png)!important;
		}
		' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-prev,
		' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-next,
		' . $paletteSelector . ' .ls-reactskin a.ls-nav-next,
		' . $paletteSelector . ' .ls-reactskin a.ls-nav-prev,
		' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-prevNav,
		' . $paletteSelector . ' .react .flex-direction-nav a.flex-prev,
		' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-nextNav,
		' . $paletteSelector . ' .react .flex-direction-nav a.flex-next {
			background-image: url(../../react/images/slider-arrows-light.png);
		}
		' . $paletteSelector . ' a.fancybox-nav.fancybox-next > span,
		' . $paletteSelector . ' a.fancybox-nav.fancybox-prev > span,
		' . $paletteSelector . ' .rev_slider_wrapper .tp-rightarrow.custom,
		' . $paletteSelector . ' .rev_slider_wrapper .tp-leftarrow.custom {
			background-image: url(../../react/images/slider-arrows-light.png) !important;
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {
			' . $paletteSelector . ' .ls-reactskin .ls-nav-start:after,
			' . $paletteSelector . ' .ls-reactskin .ls-nav-start.ls-nav-start-active:after,
			' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a:after,
			' . $paletteSelector . ' .ls-reactskin .ls-bottom-slidebuttons a.ls-nav-active:after,
			' . $paletteSelector . ' .ls-reactskin .ls-nav-stop:after,
			' . $paletteSelector . ' .ls-reactskin .ls-nav-stop.ls-nav-active:after,
			' . $paletteSelector . ' .tcs-button.tcs-style-dark i.iconsprite.drk {
				background-image: url(../../react/images/icons/sprites-32-light.png) !important;
				background-size: 496px 240px;
			}
			' . $paletteSelector . ' .x-close,
			' . $paletteSelector . ' #comments .comment-respond h3#reply-title {
				background-image: url(../../react/images/x-close-light@2x.png);
				background-size: 16px 16px;
			}
			' . $paletteSelector . ' a.fancybox-close {
				background-image: url(../../react/images/x-close-light@2x.png) !important;
				background-size: 16px 16px !important;
			}
			' . $paletteSelector . ' .react.wpb_accordion .wpb_accordion_wrapper .ui-state-default .ui-icon {
				background-image: url(../../react/images/sml-down-arrow-light@2x.png);
				background-size: 9px 6px;
			}
			' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-prev,
			' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-next,
			' . $paletteSelector . ' .ls-reactskin a.ls-nav-next,
			' . $paletteSelector . ' .ls-reactskin a.ls-nav-prev,
			' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-prevNav,
			' . $paletteSelector . ' .react .flex-direction-nav a.flex-prev,
			' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-nextNav,
			' . $paletteSelector . ' .react .flex-direction-nav a.flex-next {
				background-image: url(../../react/images/slider-arrows-light@2x.png);
				background-size: 64px 32px;
			}
			' . $paletteSelector . ' a.fancybox-nav.fancybox-next > span,
			' . $paletteSelector . ' a.fancybox-nav.fancybox-prev > span,
			' . $paletteSelector . ' .rev_slider_wrapper .tp-rightarrow.custom,
			' . $paletteSelector . ' .rev_slider_wrapper .tp-leftarrow.custom {
				background-image: url(../../react/images/slider-arrows-light@2x.png) !important;
				background-size: 64px 32px !important;
			}
		}
		';
	?>

	<?php /* With box shadows Color buttons - PRIME color */ ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > a,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > span.tcs-r-button,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-prime {
		background: transparent;
		' . react_css_color($palette['text'], 'color') . '
		' . react_css_color($palette['primary_bg'], 'border-color') . '
	}
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-loading-wrap .iphorm-loading,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-loading-wrap .iphorm-loading:before
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-loading-wrap .iphorm-loading:after {
		' . react_css_color($palette['primary_bg'], 'border-top-color') . '
	}
	' . $paletteSelector . ' .tcs-image-hover.tcs-hover-prime,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-one ul li a,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > a:hover,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > span.tcs-r-button:hover,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-prime:hover,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-prime:before,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-prime:hover:before {
		' . react_css_color($palette['primary_bg'], 'background') . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}
	' . $paletteSelector . ' .read-more-link a.more-link,
	' . $paletteSelector . ' .comments-link a,

	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-submit-wrap button span,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-swfupload-browse,
	' . $paletteSelector . ' .form-submit input,
	' . $paletteSelector . ' .back-home-icon.button a.back-home,
	' . $paletteSelector . ' .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap a.tcs-impact-link,
	' . $paletteSelector . ' .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap span.tcs-impact-link,
	' . $paletteSelector . ' .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap a.tcs-impact-link,
	' . $paletteSelector . ' .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap span.tcs-impact-link,
	' . $paletteSelector . ' .tcs-button.tcs-style-prime > a,
	' . $paletteSelector . ' .tcs-button.tcs-style-prime > span.tcs-r-button,
	' . $paletteSelector . ' .tcs-button.tcs-style-dark.tcs-hover-prime-btn > a:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-dark.tcs-hover-prime-btn > span.tcs-r-button:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-light.tcs-hover-prime-btn > a:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-light.tcs-hover-prime-btn > span.tcs-r-button:hover,
	' . $paletteSelector . ' .tcw-follow-me-button a,
	' . $paletteSelector . ' a.basic-button,
	' . $paletteSelector . ' a.tcp-basic-button {
		' . react_css_color($palette['primary_bg'], 'background') . '
		' . react_css_color($palette['primary_fg'], 'color') . '
		-webkit-box-shadow: inset 0 -3px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
		 box-shadow: inset 0 -3px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
	}
	' . $paletteSelector . ' .searchform input.searchsubmit,
	' . $paletteSelector . ' .woocommerce.widget_product_search input[type="submit"] {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
		-webkit-box-shadow: inset 0 -2px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ';
		 box-shadow: inset 0 -2px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ';
	}
	'; } ?>

	<?php if ($palette['primary_bg'] || $palette['primary_fg']) echo '
	' . $paletteSelector . ' .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul li a,
	' . $paletteSelector . ' .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul.menu li a,
	' . $paletteSelector . ' .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul.menu li.menu-item-has-children > a {
	-webkit-box-shadow: inset 0px -1px 0px 0px rgba(255, 255, 255, 0.05);
	box-shadow: inset 0px -1px 0px 0px rgba(255, 255, 255, 0.05);
	}'; ?>

	<?php if ($palette['primary_bg']) echo '
	' . $paletteSelector . ' .tcs-impact-header.tcs-light {
		-webkit-box-shadow: inset 0 -2px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 2px 0 0 rgba(0, 0, 0, 0.1), inset 0px -3px 0px 0px rgba(255, 255, 255, 0.2);
		 box-shadow: inset 0 -2px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 2px 0 0 rgba(0, 0, 0, 0.1), inset 0px -3px 0px 0px rgba(255, 255, 255, 0.2);
	}'; ?>

	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	' . $paletteSelector . ' ::-moz-selection {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}
	' . $paletteSelector . ' ::selection {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}
	' . $paletteSelector . ' .featured-image-link:before,
	' . $paletteSelector . ' .tcp-featured-image-link:before {' . react_css_color($palette['primary_bg']) . ' ' . react_css_color($palette['primary_fg'], 'color') . '}
	' . $paletteSelector . ' .tcs-progress-bar-outer.tcs-prime .tcs-progress-bar,
	' . $paletteSelector . ' .highlighted-text, ' . $paletteSelector . ' .tcs-highlighted-text, ' . $paletteSelector . ' mark, body.react-wp ' . $paletteSelector . ' .mejs-time-rail .mejs-time-current {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; } ?>
	<?php
		if ($palette['primary_bg']) {
			echo '' . $paletteSelector . '
			' . $paletteSelector . ' .read-more-link a.more-link:hover,
			' . $paletteSelector . ' .comments-link a:hover,

			' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-submit-wrap button:hover span,
			' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button:hover,
			' . $paletteSelector . ' .form-submit input:hover,
			' . $paletteSelector . ' .back-home-icon.button a.back-home:hover,

			' . $paletteSelector . ' .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap a.tcs-impact-link:hover,
			' . $paletteSelector . ' .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap span.tcs-impact-link:hover,
			' . $paletteSelector . ' .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap a.tcs-impact-link:hover,
			' . $paletteSelector . ' .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap span.tcs-impact-link:hover,
			' . $paletteSelector . ' .tcs-button.tcs-style-prime > a:hover,
			' . $paletteSelector . ' .tcs-button.tcs-style-prime > span.tcs-r-button:hover,
			' . $paletteSelector . ' .tcw-follow-me-button a:hover,
			' . $paletteSelector . ' a.basic-button:hover,
			' . $paletteSelector . ' a.tcp-basic-button:hover {
				-webkit-box-shadow: inset 0 -3px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']). ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
				 box-shadow: inset 0 -3px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']). ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
				 ' . react_css_color($palette['primary_fg'], 'color') . '
				 ' . react_css_color($palette['primary_bg_lighter'], 'background') . '
			}
			' . $paletteSelector . ' .searchform input.searchsubmit:hover,
			' . $paletteSelector . ' .woocommerce.widget_product_search input[type="submit"]:hover {
				-webkit-box-shadow: inset 0 -2px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']). ';
				 box-shadow: inset 0 -2px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']). ';
				 ' . react_css_color($palette['primary_fg'], 'color') . '
				 ' . react_css_color($palette['primary_bg_lighter']) . '
			}
			' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-one ul li a:hover {
				' . react_css_color($palette['primary_fg'], 'color') . '
				 ' . react_css_color($palette['primary_bg_lighter']) . '
			}
			';
		}
	?>
	<?php /* Flat Color buttons - PRIME color */ ?>
	<?php if ($palette['primary_bg_even_darker']) echo '
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-one.tcs-grouped ul li a, ' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-one.tcs-grouped ul.menu li a {' . react_css_color($palette['primary_bg_even_darker'], 'border-color') . '}
	'; ?>
	<?php if ($palette['primary_bg']) echo '
	' . $paletteSelector . ' #audio-controls, ' . $paletteSelector . ' #video-controls, ' . $paletteSelector . ' #fs-controls {' . react_css_color($palette['primary_bg'], 'border-right-color') . '}
	'; ?>
	<?php if ($palette['primary_bg']) echo '
	' . $paletteSelector . ' span.tcs-icon.tcs-style-prime,
	' . $paletteSelector . ' .text-prime {
		' . react_css_color($palette['primary_bg'], 'color') . '
	}'; ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	' . $paletteSelector . ' .comments div.comment .reply a:hover,
	' . $paletteSelector . ' .comments ul.children div.comment .reply a:hover,
	' . $paletteSelector . ' .form-submit input,
	' . $paletteSelector . ' #comments ul#comment-tabs-nav li a.current,
	' . $paletteSelector . ' ul.wp-tag-cloud li a:hover,
	' . $paletteSelector . ' .tagcloud > a:hover,
	' . $paletteSelector . ' .react-woo-image-hover,
	' . $paletteSelector . ' .tcp-portfolio-hover,
	' . $paletteSelector . ' .tcp-portfolio-filter .tcp-active-filter.tcp-filter-button,
	' . $paletteSelector . ' .tcp-portfolio-filter .tcp-active-filter.tcp-filter-button:hover,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3.tcs-active span.tcs-acc-icon,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3:hover span.tcs-acc-icon,
	' . $paletteSelector . ' .vc_progress_bar.react .vc_single_bar .vc_bar,
	' . $paletteSelector . ' .react .wpb_tour_next_prev_nav a:hover,
	' . $paletteSelector . ' .tcs-tabs ul.tcs-tabs-nav li.tcs-active a,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > a.tcs-has-back-animation:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > span.tcs-r-button.tcs-has-back-animation:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > a.tcs-has-back-animation:hover:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > span.tcs-r-button.tcs-has-back-animation:hover:before,
	' . $paletteSelector . ' .tcs-tabs ul.tcs-tabs-nav li.tcs-active a:hover,
	' . $paletteSelector . ' .product-carousel .tcs-carousel-next:hover,
	' . $paletteSelector . ' .product-carousel .tcs-carousel-prev:hover,
	' . $paletteSelector . ' #nav-single .nav-previous:hover .meta-nav,
	' . $paletteSelector . ' #nav-single .nav-next:hover .meta-nav,
	' . $paletteSelector . ' .content-nav .nav-previous:hover .meta-nav,
	' . $paletteSelector . ' .content-nav .nav-next:hover .meta-nav,
	' . $paletteSelector . ' #comments .comment-respond h3#reply-title:hover,
	' . $paletteSelector . ' span.tcs-icon.tcs-boxed.tcs-style-prime,
	' . $paletteSelector . ' .wpb_content_element.react .wpb_tabs_nav li.ui-tabs-active,
	' . $paletteSelector . ' .react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,
	' . $paletteSelector . ' .react.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab,
	' . $paletteSelector . ' .react.prime.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab {
		' . react_css_color($palette['primary_bg'], 'background') . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}
	' . $paletteSelector . ' .searchform input.searchsubmit,
	' . $paletteSelector . ' .woocommerce.widget_product_search input[type="submit"] {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}

	'; } ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	' . $paletteSelector . ' .search-button-wrap input,
	' . $paletteSelector . ' .widget_search input.searchsubmit,
	' . $paletteSelector . ' .tcs-cycle-controls-wrap a:hover,
	' . $paletteSelector . ' .woocommerce ul.cart_list li a.remove:hover,
	' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-next:hover,
	' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-prev:hover,
	' . $paletteSelector . ' .react .vc-carousel-control .icon-prev:hover,
	' . $paletteSelector . ' .react .vc-carousel-control .icon-next:hover,
	' . $paletteSelector . ' .react .flex-control-paging li a.flex-active,
	' . $paletteSelector . ' .react .flex-direction-nav a.flex-next:hover,
	' . $paletteSelector . ' .react .flex-direction-nav a.flex-prev:hover,
	' . $paletteSelector . ' .react .theme-default .nivo-directionNav a:hover,
	' . $paletteSelector . ' a:hover .x-close,
	' . $paletteSelector . ' .x-close:hover,
	' . $paletteSelector . ' .tcs-drop-close:hover,
	' . $paletteSelector . ' .tcs-drop-close:hover,
	' . $paletteSelector . ' a.fancybox-nav.fancybox-prev:hover > span,
	' . $paletteSelector . ' a.fancybox-nav.fancybox-next:hover > span,
	' . $paletteSelector . ' .ls-reactskin a.ls-nav-next:hover,
	' . $paletteSelector . ' .ls-reactskin a.ls-nav-prev:hover,
	' . $paletteSelector . ' .ls-reactskin .ls-nav-start:hover,
	' . $paletteSelector . ' .ls-reactskin .ls-nav-start.ls-nav-start-active:hover,
	' . $paletteSelector . ' .ls-reactskin .ls-nav-stop:hover,
	' . $paletteSelector . ' .ls-reactskin .ls-nav-stop.ls-nav-active:hover  {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; } ?>
	<?php if ($palette['primary_bg'] || $palette['primary_fg']) { echo '
	' . $paletteSelector . ' a.fancybox-close,
	' . $paletteSelector . ' a.fancybox-nav.fancybox-next:hover > span,
	' . $paletteSelector . ' a.fancybox-nav.fancybox-prev:hover > span,
	' . $paletteSelector . ' .rev_slider_wrapper .tp-rightarrow.custom:hover,
	' . $paletteSelector . ' .rev_slider_wrapper .tp-leftarrow.custom:hover {
		' . react_css_color($palette['primary_bg'], 'background-color', '!important') . '
		' . react_css_color($palette['primary_fg'], 'color', '!important') . '
	}'; } ?>
	<?php if ($palette['primary_bg']) echo '
	' . $paletteSelector . ' div.post.entry .featured-image-wrap a:after,
	' . $paletteSelector . ' #open-close-close:hover,
	' . $paletteSelector . ' .tcs-fancy-header.tcs-prime-line .tcs-fancy-header-text:before,
	' . $paletteSelector . ' .owl-theme .owl-dots .owl-dot.active span,
	' . $paletteSelector . ' .owl-theme .owl-dots .owl-dot:hover span {
		' . react_css_color($palette['primary_bg']) . '
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; ?>
	<?php if ($palette['primary_bg_lighter']) echo '
	' . $paletteSelector . ' .search-button-wrap input:hover,
	' . $paletteSelector . ' widget_search input.searchsubmit:hover {
		' . react_css_color($palette['primary_bg_lighter']) . '
	}'; ?>

	<?php if ($palette['primary_bg']) echo '
	' . $paletteSelector . ' .featured-image-wrap:hover,
	' . $paletteSelector . ' .tcp-featured-image-wrap:hover {
		' . react_css_color($palette['primary_bg'], 'border-bottom-color') . '
	}'; ?>
	<?php if ($palette['primary_bg_darker']) echo '
	' . $paletteSelector . ' .search-button-wrap input:active,
	' . $paletteSelector . ' .widget_search input.searchsubmit:active,
	' . $paletteSelector . ' .search-button-wrap input:hover, ' . $paletteSelector . ' .widget_search input.searchsubmit:hover,
	' . $paletteSelector . ' .search-button-wrap input:active, ' . $paletteSelector . ' .widget_search input.searchsubmit:active {
		' . react_css_color($palette['primary_bg_lighter']) . '
	}'; ?>
	<?php /* After with arrows at bottom - prime color - ANYTHING ADDED HERE ALSO ADD TO CUSTOM SECTION*/ ?>
	<?php if ($palette['primary_bg']) echo '
	' . $paletteSelector . ' #comments ul#comment-tabs-nav li a.current:after,
	' . $paletteSelector . ' .tcp-portfolio-filter .tcp-active-filter.tcp-filter-button:after,
	' . $paletteSelector . ' .tcs-tabs ul.tcs-tabs-nav li.tcs-active a:after {
		' . react_css_color($palette['primary_bg'], 'border-top-color', '!important') . '
	}'; ?>
	<?php if ($palette['primary_bg_gradient']) echo '
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > a.tcs-has-back-animation:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > span.tcs-r-button.tcs-has-back-animation:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > a.tcs-has-back-animation:hover:before,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > span.tcs-r-button.tcs-has-back-animation:hover:before,
	' . $paletteSelector . ' .comments div.comment .reply a:hover,
	' . $paletteSelector . ' .comments ul.children div.comment .reply a:hover,
	' . $paletteSelector . ' .form-submit input,
	' . $paletteSelector . ' #comments ul#comment-tabs-nav li a.current,
	' . $paletteSelector . ' ul.wp-tag-cloud li a:hover,
	' . $paletteSelector . ' .tagcloud > a:hover,
	' . $paletteSelector . ' .react-woo-image-hover,
	' . $paletteSelector . ' .tcp-portfolio-hover,
	' . $paletteSelector . ' .tcp-portfolio-filter .tcp-active-filter.tcp-filter-button,
	' . $paletteSelector . ' .tcp-portfolio-filter .tcp-active-filter.tcp-filter-button:hover,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3.tcs-active span.tcs-acc-icon,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3:hover span.tcs-acc-icon,
	' . $paletteSelector . ' .react .wpb_tour_next_prev_nav a:hover,
	' . $paletteSelector . ' .tcs-tabs ul.tcs-tabs-nav li.tcs-active a,
	' . $paletteSelector . ' .tcs-tabs ul.tcs-tabs-nav li.tcs-active a:hover,
	' . $paletteSelector . ' .tcs-cycle-controls-wrap a:hover,
	' . $paletteSelector . ' .woocommerce ul.cart_list li a.remove:hover,
	' . $paletteSelector . ' .product-carousel .tcs-carousel-next:hover,
	' . $paletteSelector . ' .product-carousel .tcs-carousel-prev:hover,
	' . $paletteSelector . ' #nav-single .nav-previous:hover .meta-nav,
	' . $paletteSelector . ' #nav-single .nav-next:hover .meta-nav,
	' . $paletteSelector . ' .content-nav .nav-previous:hover .meta-nav,
	' . $paletteSelector . ' .content-nav .nav-next:hover .meta-nav,
	' . $paletteSelector . ' #comments .comment-respond h3#reply-title:hover {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%, ' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['primary_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['primary_bg_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
	}
	' . $paletteSelector . ' #comments ul#comment-tabs-nav li a.current:after,
	' . $paletteSelector . ' .tcp-portfolio-filter .tcp-active-filter.tcp-filter-button:after,
	' . $paletteSelector . ' .tcs-tabs ul.tcs-tabs-nav li.tcs-active a:after {
		' . react_css_color($palette['primary_bg_darker'], 'border-top-color', '!important') . '
	}'; ?>
	<?php if ($palette['primary_bg_gradient']) echo '
	' . $paletteSelector . ' .read-more-link a.more-link,
	' . $paletteSelector . ' .comments-link a,
	' . $paletteSelector . ' .comments-link a:hover,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-submit-wrap button span,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-submit-wrap button:hover span,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-add-another-upload span.iphorm-add-another-upload-button:hover,
	' . $paletteSelector . ' .iphorm-theme-react-default .iphorm-swfupload-browse,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-one ul li a,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-one ul li a:hover,
	' . $paletteSelector . ' .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul li a,
	' . $paletteSelector . ' .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul li a:hover,
	' . $paletteSelector . ' .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul.menu li a,
	' . $paletteSelector . ' .tcs-menu.tcs-stacked.tcs-grouped.tcs-menu-button-style-one ul.menu li a:hover,
	' . $paletteSelector . ' .form-submit input,
	' . $paletteSelector . ' .form-submit input:hover,
	' . $paletteSelector . ' .back-home-icon.button a.back-home,
	' . $paletteSelector . ' .back-home-icon.button a.back-home:hover,
	' . $paletteSelector . ' .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap a.tcs-impact-link,
	' . $paletteSelector . ' .tcs-impact-header.tcs-light .tcs-impact-header-link-wrap span.tcs-impact-link,
	' . $paletteSelector . ' .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap a.tcs-impact-link,
	' . $paletteSelector . ' .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap span.tcs-impact-link,
	' . $paletteSelector . ' .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap a.tcs-impact-link:hover,
	' . $paletteSelector . ' .tcs-impact-header.tcs-dark .tcs-impact-header-link-wrap span.tcs-impact-link:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-prime > a,
	' . $paletteSelector . ' .tcs-button.tcs-style-prime > a:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-prime > span.tcs-r-button,
	' . $paletteSelector . ' .tcs-button.tcs-style-prime > span.tcs-r-button:hover,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > a:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-dark.tcs-hover-prime-btn > a:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-dark.tcs-hover-prime-btn > span.tcs-r-button:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-light.tcs-hover-prime-btn > a:hover,
	' . $paletteSelector . ' .tcs-button.tcs-style-light.tcs-hover-prime-btn > span.tcs-r-button:hover,
	' . $paletteSelector . ' .tcs-image-hover.tcs-hover-prime,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > span.tcs-r-button:hover,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-prime:hover,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-prime:before,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-has-back-animation.tcs-style-prime:hover:before,
	' . $paletteSelector . ' .tcw-follow-me-button a,
	' . $paletteSelector . ' .tcw-follow-me-button a:hover,
	' . $paletteSelector . ' a.basic-button,
	' . $paletteSelector . ' a.basic-button:hover,
	' . $paletteSelector . ' a.tcp-basic-button,
	' . $paletteSelector . ' a.tcp-basic-button:hover {
		background: -moz-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%, ' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,' . react_sanitize_color($palette['primary_bg_lighter']) . '), color-stop(100%,' . react_sanitize_color($palette['primary_bg_darker']) . '));
		background: -webkit-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -o-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: -ms-linear-gradient(top, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
		background: linear-gradient(to bottom, ' . react_sanitize_color($palette['primary_bg_lighter']) . ' 0%,' . react_sanitize_color($palette['primary_bg_darker']) . ' 100%);
	}
	'; ?>
	<?php if ($palette['primary_bg']) echo '
	' . $paletteSelector . ' .tcs-impact-header.tcs-color,
	' . $paletteSelector . ' .tcs-fancy-header.tcs-style2,
	' . $paletteSelector . ' .tcs-box.tcs-box-basic,
	' . $paletteSelector . ' .react.vc_call_to_action.prime {
		' . react_css_color($palette['primary_bg'], 'background') . '
		' . react_css_color($palette['primary_fg'], 'color') . '

		-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 3px 0 0 rgba(0, 0, 0, 0.1), inset 0 0 60px 0 rgba(0, 0, 0, 0.07);
			box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', 0 3px 0 0 rgba(0, 0, 0, 0.1), inset 0 0px 60px 0 rgba(0, 0, 0, 0.07);
	}';
	?>
	<?php if ($palette['primary_fg']) echo '
	' . $paletteSelector . ' .tcs-impact-header .tcs-impact-heading,
	' . $paletteSelector . ' .tcs-impact-header .tcs-impact-subheading,
	' . $paletteSelector . ' .tcs-menu.tcs-menu-button-style-one ul li {
		' . react_css_color($palette['primary_fg'], 'color') . '
	}'; ?>
	<?php if ($palette['primary_bg']) echo '
	' . $paletteSelector . ' #wp-calendar thead th {
		' . react_css_color($palette['primary_bg'], 'color') . '
	}'; ?>
	<?php if ($palette['primary_icon']) echo '
	' . $paletteSelector . ' .tcs-button.tcs-has-drop.tcs-style-prime .tcs-open-drop-trigger,
	' . $paletteSelector . ' .tcs-button.tcs-style-prime > a > i,
	' . $paletteSelector . ' .tcs-button.tcs-style-prime > span.tcs-r-button > i,
	' . $paletteSelector . ' .tcs-button.tcs-style-dark.tcs-hover-prime-btn > a:hover > i,
	' . $paletteSelector . ' .tcs-button.tcs-style-dark.tcs-hover-prime-btn > span.tcs-r-button:hover > i,
	' . $paletteSelector . ' .tcs-button.tcs-style-light.tcs-hover-prime-btn > a:hover > i,
	' . $paletteSelector . ' .tcs-button.tcs-style-light.tcs-hover-prime-btn > span.tcs-r-button:hover > i,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > a:hover > i,
	' . $paletteSelector . ' .tcs-button.tcs-hollow-prime > span.tcs-r-button:hover > i,
	' . $paletteSelector . ' span.tcs-icon.tcs-icon-hollow.tcs-boxed.tcs-style-prime:hover > i,
	' . $paletteSelector . ' .tcs-fancy-header.tcs-style2 i,
	' . $paletteSelector . ' .tcs-impact-header.tcs-color > i,

	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3.tcs-active span.tcs-acc-icon i,
	' . $paletteSelector . ' .tcs-accordion.tcs-box > h3:hover span.tcs-acc-icon i,
	' . $paletteSelector . ' .tcs-cycle-controls-wrap a:hover > i,
	' . $paletteSelector . ' open-close-close:hover,
	' . $paletteSelector . ' #nav-single .nav-previous:hover .meta-nav i,
	' . $paletteSelector . ' #nav-single .nav-next:hover .meta-nav i,
	' . $paletteSelector . ' .content-nav .nav-previous:hover .meta-nav i,
	' . $paletteSelector . ' .content-nav .nav-next:hover .meta-nav i {
		' . react_css_color($palette['primary_icon'], 'color') . '
	}'; ?>
	<?php if ($palette['primary_icon_image'] == 'dark') echo '
		' . $paletteSelector . ' .ls-reactskin .ls-nav-start:hover:after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-stop:hover:after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-stop.ls-nav-active:hover:after,
		' . $paletteSelector . ' .breadcrumbs .back-home-icon span,
		' . $paletteSelector . ' .tcs-button.tcs-style-prime i.iconsprite {
			background-image: url(../../react/images/icons/sprites-16-dark.png) !important;
		}

		' . $paletteSelector . ' .x-close:hover,
		' . $paletteSelector . ' #comments .comment-respond h3#reply-title:hover {
			background-image: url(../../react/images/x-close-dark.png);
		}
		' . $paletteSelector . ' a.fancybox-close {
			background-image: url(../../react/images/x-close-dark.png)!important;
		}
		' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-prev:hover,
		' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-next:hover,
		' . $paletteSelector . ' .ls-reactskin a.ls-nav-next:hover,
		' . $paletteSelector . ' .ls-reactskin a.ls-nav-prev:hover,
		' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-prevNav:hover,
		' . $paletteSelector . ' .react .flex-direction-nav a.flex-prev:hover,
		' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-nextNav:hover,
		' . $paletteSelector . ' .react .flex-direction-nav a.flex-next:hover {
			background-image: url(../../react/images/slider-arrows-dark.png);
		}
		' . $paletteSelector . ' .react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon {
			background-image: url(../../react/images/sml-down-arrow-dark.png);
		}
		' . $paletteSelector . ' a.fancybox-nav.fancybox-next:hover > span,
		' . $paletteSelector . ' a.fancybox-nav.fancybox-prev:hover > span,
		' . $paletteSelector . ' .rev_slider_wrapper .tp-rightarrow.custom:hover,
		' . $paletteSelector . ' .rev_slider_wrapper .tp-leftarrow.custom:hover {
			background-image: url(../../react/images/slider-arrows-dark.png) !important;
		}

		' . $paletteSelector . ' .woocommerce.widget_product_search input[type="submit"],
		' . $paletteSelector . ' .widget_search .searchform input.searchsubmit,
		' . $paletteSelector . ' .search-button-wrap input, .widget_search input.searchsubmit {
			background-image: url(../../react/images/search-icon-dark.png);
		}
		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {

			' . $paletteSelector . ' .ls-reactskin .ls-nav-start:hover:after,
			' . $paletteSelector . ' .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
			' . $paletteSelector . ' .ls-reactskin .ls-nav-stop:hover:after,
			' . $paletteSelector . ' .ls-reactskin .ls-nav-stop.ls-nav-active:hover:after,
			' . $paletteSelector . ' .breadcrumbs .back-home-icon span,
			' . $paletteSelector . ' .tcs-button.tcs-style-prime i.iconsprite {
				background-image: url(../../react/images/icons/sprites-32-dark.png) !important;
				background-size: 496px 240px;
			}
			' . $paletteSelector . ' .react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon {
				background-image: url(../../react/images/sml-down-arrow-dark@2x.png);
				background-size: 9px 6px;
			}
			' . $paletteSelector . ' .x-close:hover,
			' . $paletteSelector . ' #comments .comment-respond h3#reply-title:hover {
				background-image: url(../../react/images/x-close-dark@2x.png);
				background-size: 16px 16px;
			}
			' . $paletteSelector . ' a.fancybox-close {
				background-image: url(../../react/images/x-close-dark@2x.png)!important;
				background-size: 16px 16px!important;
			}
			' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-prev:hover,
			' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-next:hover,
			' . $paletteSelector . ' .ls-reactskin a.ls-nav-next:hover,
			' . $paletteSelector . ' .ls-reactskin a.ls-nav-prev:hover,
			' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-prevNav:hover,
			' . $paletteSelector . ' .react .flex-direction-nav a.flex-prev:hover,
			' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-nextNav:hover,
			' . $paletteSelector . ' .react .flex-direction-nav a.flex-next:hover {
				background-image: url(../../react/images/slider-arrows-dark@2x.png);
				background-size: 64px 32px;
			}
			' . $paletteSelector . ' a.fancybox-nav.fancybox-next:hover > span,
			' . $paletteSelector . ' a.fancybox-nav.fancybox-prev:hover > span,
			' . $paletteSelector . ' .rev_slider_wrapper .tp-rightarrow.custom:hover,
			' . $paletteSelector . ' .rev_slider_wrapper .tp-leftarrow.custom:hover {
				background-image: url(../../react/images/slider-arrows-dark@2x.png) !important;
				background-size: 64px 32px !important;
			}

			' . $paletteSelector . ' .woocommerce.widget_product_search input[type="submit"],
			' . $paletteSelector . ' .widget_search .searchform input.searchsubmit,
			' . $paletteSelector . ' .search-button-wrap input, .widget_search input.searchsubmit {
				background-image: url(../../react/images/search-icon-dark@2x.png);
				background-size: 16px 16px;
			}

		}

		';
		elseif ($palette['primary_icon_image'] == 'light') echo '
		' . $paletteSelector . ' .ls-reactskin .ls-nav-start:hover:after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-stop:hover:after,
		' . $paletteSelector . ' .ls-reactskin .ls-nav-stop.ls-nav-active:hover:after,
		' . $paletteSelector . ' .breadcrumbs .back-home-icon span,
		' . $paletteSelector . ' .tcs-button.tcs-style-prime i.iconsprite {
			background-image: url(../../react/images/icons/sprites-16-light.png) !important;
		}
		' . $paletteSelector . ' .react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon {
			background-image: url(../../react/images/sml-down-arrow-light.png);
		}
		' . $paletteSelector . ' .x-close:hover,
		' . $paletteSelector . ' #comments .comment-respond h3#reply-title:hover {
			background-image: url(../../react/images/x-close-light.png);
		}
		' . $paletteSelector . ' a.fancybox-close {
			background-image: url(../../react/images/x-close-light.png)!important;
		}
		' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-prev:hover,
		' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-next:hover,
		' . $paletteSelector . ' .ls-reactskin a.ls-nav-next:hover,
		' . $paletteSelector . ' .ls-reactskin a.ls-nav-prev:hover,
		' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-prevNav:hover,
		' . $paletteSelector . ' .react .flex-direction-nav a.flex-prev:hover,
		' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-nextNav:hover,
		' . $paletteSelector . ' .react .flex-direction-nav a.flex-next:hover {
			background-image: url(../../react/images/slider-arrows-light.png);
		}
		' . $paletteSelector . ' a.fancybox-nav.fancybox-next:hover > span,
		' . $paletteSelector . ' a.fancybox-nav.fancybox-prev:hover > span,
		' . $paletteSelector . ' .rev_slider_wrapper .tp-rightarrow.custom:hover,
		' . $paletteSelector . ' .rev_slider_wrapper .tp-leftarrow.custom:hover {
			background-image: url(../../react/images/slider-arrows-light.png) !important;
		}

		' . $paletteSelector . ' .woocommerce.widget_product_search input[type="submit"],
		' . $paletteSelector . ' .widget_search .searchform input.searchsubmit,
		' . $paletteSelector . ' .search-button-wrap input, .widget_search input.searchsubmit {
			background-image: url(../../react/images/search-icon-light.png);
		}

		@media
		(-webkit-min-device-pixel-ratio: 1.5),
		(min-resolution: 144dpi),
		(min-resolution: 1.5dppx) {

			' . $paletteSelector . ' .ls-reactskin .ls-nav-start:hover:after,
			' . $paletteSelector . ' .ls-reactskin .ls-nav-start.ls-nav-start-active:hover:after,
			' . $paletteSelector . ' .ls-reactskin .ls-nav-stop:hover:after,
			' . $paletteSelector . ' .ls-reactskin .ls-nav-stop.ls-nav-active:hover:after,
			' . $paletteSelector . ' .breadcrumbs .back-home-icon span,
			' . $paletteSelector . ' .tcs-button.tcs-style-prime i.iconsprite {

				background-image: url(../../react/images/icons/sprites-32-light.png) !important;
				background-size: 496px 240px;
			}
			' . $paletteSelector . ' .x-close:hover,
			' . $paletteSelector . ' #comments .comment-respond h3#reply-title:hover {
				background-image: url(../../react/images/x-close-light@2x.png);
				background-size: 16px 16px;
			}
			' . $paletteSelector . ' a.fancybox-close {
				background-image: url(../../react/images/x-close-light@2x.png)!important;
				background-size: 16px 16px!important;
			}
			' . $paletteSelector . ' .react.wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon {
				background-image: url(../../react/images/sml-down-arrow-light@2x.png);
				background-size: 9px 6px;
			}
			' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-prev:hover,
			' . $paletteSelector . ' .tcs-image-carousel-wrap .tcs-carousel-next:hover,
			' . $paletteSelector . ' .ls-reactskin a.ls-nav-next:hover,
			' . $paletteSelector . ' .ls-reactskin a.ls-nav-prev:hover,
			' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-prevNav:hover,
			' . $paletteSelector . ' .react .flex-direction-nav a.flex-prev:hover,
			' . $paletteSelector . ' .react .theme-default .nivo-directionNav a.nivo-nextNav:hover,
			' . $paletteSelector . ' .react .flex-direction-nav a.flex-next:hover {
				background-image: url(../../react/images/slider-arrows-light@2x.png);
				background-size: 64px 32px;
			}
			' . $paletteSelector . ' a.fancybox-nav.fancybox-next:hover > span,
			' . $paletteSelector . ' a.fancybox-nav.fancybox-prev:hover > span,
			' . $paletteSelector . ' .rev_slider_wrapper .tp-rightarrow.custom:hover,
			' . $paletteSelector . ' .rev_slider_wrapper .tp-leftarrow.custom:hover {
				background-image: url(../../react/images/slider-arrows-light@2x.png) !important;
				background-size: 64px 32px !important;
			}

			' . $paletteSelector . ' .woocommerce.widget_product_search input[type="submit"],
			' . $paletteSelector . ' .widget_search .searchform input.searchsubmit,
			' . $paletteSelector . ' .search-button-wrap input, .widget_search input.searchsubmit {
				background-image: url(../../react/images/search-icon-light@2x.png);
				background-size: 16px 16px;
			}
		}
	';
?>



	<?php if ($palette['dark_bg'] || $palette['dark_fg']) { echo '
	' . $paletteSelector . ' .woocommerce a.button,
	.woocommerce-page ' . $paletteSelector . ' a.button {
	' . react_css_color($palette['dark_bg']) . '
	' . react_css_color($palette['dark_fg'], 'color', '!important') . '
	-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
	 box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);

	}';} ?>


	<?php if ($palette['dark_bg'] || $palette['dark_fg']) { echo '
	' . $paletteSelector . ' .woocommerce a.button:hover,
	.woocommerce-page ' . $paletteSelector . ' a.button:hover {
		' . react_css_color($palette['dark_fg'], 'color', '!important') . '
		' . react_css_color($palette['dark_bg_lighter'], 'background-color', '!important') . '
	-webkit-box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);
	 box-shadow: inset 0 ' . $shadowValue . ' 0 0 ' . react_sanitize_color($palette['dark_bg_much_darker']) . ', 0 2px 3px 0 rgba(0, 0, 0, 0.1);

	}';} ?>


	<?php if ($palette['text_alt']) { echo '
	' . $paletteSelector . ' .woocommerce .star-rating:before,
	.woocommerce-page ' . $paletteSelector . ' .star-rating:before {
	' . react_css_color($palette['text_alt'], 'color') . '
	}';} ?>

	<?php if ($palette['primary_bg']) { echo '
	' . $paletteSelector . ' .woocommerce .star-rating span,
	.woocommerce-page ' . $paletteSelector . ' .star-rating span {
	' . react_css_color($palette['primary_bg'], 'color') . '
	}';} ?>

	<?php if ($palette['background_darker']) { echo '
	' . $paletteSelector . ' .woocommerce ul.cart_list li,
	' . $paletteSelector . ' .woocommerce ul.product_list_widget li,
	.woocommerce-page ' . $paletteSelector . ' ul.cart_list li,
	.woocommerce-page ' . $paletteSelector . ' ul.product_list_widget li {
	' . react_css_color($palette['background_darker'], 'border-color') . '
	}';} ?>

	<?php if ($palette['text_alt']) { echo '
	' . $paletteSelector . ' .woocommerce ul.cart_list li span.reviewer,
	' . $paletteSelector . ' .woocommerce ul.product_list_widget li span.reviewer,
	.woocommerce-page ' . $paletteSelector . ' ul.cart_list li span.reviewer,
	.woocommerce-page ' . $paletteSelector . ' ul.product_list_widget li span.reviewer,
	' . $paletteSelector . ' .woocommerce ul.cart_list li > span.amount,
	' . $paletteSelector . ' .woocommerce ul.product_list_widget li > span.amount,
	.woocommerce-page ' . $paletteSelector . ' ul.cart_list li > span.amount,
	.woocommerce-page ' . $paletteSelector . ' ul.product_list_widget li > span.amount,
	' . $paletteSelector . ' .woocommerce ul.cart_list li del span.amount,
	' . $paletteSelector . ' .woocommerce ul.product_list_widget li del span.amount,
	.woocommerce-page ' . $paletteSelector . ' ul.cart_list li del span.amount,
	.woocommerce-page ' . $paletteSelector . ' ul.product_list_widget li del span.amount,

	' . $paletteSelector . ' .woocommerce ul.cart_list li .star-rating,
	' . $paletteSelector . ' .woocommerce ul.product_list_widget li .star-rating,
	.woocommerce-page ' . $paletteSelector . ' ul.cart_list li del .star-rating,
	.woocommerce-page ' . $paletteSelector . ' ul.product_list_widget li .star-rating {
	' . react_css_color($palette['text_alt'], 'color') . '
	}';} ?>

	<?php if ($palette['background_darker']) { echo '
	' . $paletteSelector . ' .woocommerce ul.cart_list li dl,
	' . $paletteSelector . ' .woocommerce ul.product_list_widget li dl,
	.woocommerce-page ' . $paletteSelector . ' ul.cart_list li dl,
	.woocommerce-page ' . $paletteSelector . ' ul.product_list_widget li dl {
	' . react_css_color($palette['background_darker'], 'border-color') . '
	}';} ?>


	<?php if ($palette['primary_bg']) { echo '
		' . $paletteSelector . ' .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce-page ' . $paletteSelector . ' .widget_price_filter .ui-slider .ui-slider-handle,
		' . $paletteSelector . ' .woocommerce .widget_price_filter .ui-slider .ui-state-hover.ui-slider-handle,
		.woocommerce-page ' . $paletteSelector . ' .widget_price_filter .ui-slider .ui-state-hover.ui-slider-handle {
		' . react_css_color($palette['primary_fg'], 'color') . '
		' . react_css_color($palette['primary_bg']) . '
	-webkit-box-shadow: inset 0 -1px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', inset 0px -2px 0px 0px rgba(255, 255, 255, 0.1);
	 box-shadow: inset 0 -1px 0 0 ' . react_sanitize_color($palette['primary_bg_much_darker']) . ', inset 0px -2px 0px 0px rgba(255, 255, 255, 0.1);
	}';} ?>


	<?php if ($palette['light_bg']) { echo '
	' . $paletteSelector . ' .woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
	.woocommerce-page ' . $paletteSelector . ' .widget_price_filter .price_slider_wrapper .ui-widget-content {
		' . react_css_color($palette['light_bg']) . '
	}';} ?>


	<?php endforeach; ?>
