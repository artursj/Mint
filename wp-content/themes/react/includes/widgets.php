<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

function react_get_sidebars()
{
	$sidebars = array(
		'page' => array(
			'id' => 'react-sidebar-page',
			'name' => esc_html__('Page Sidebar', 'react'),
			'description' => esc_html__('The sidebar widget area on pages', 'react')
		),
		'blog' => array(
			'id' => 'react-sidebar-blog',
			'name' => esc_html__('Blog Sidebar', 'react'),
			'description' => esc_html__('The sidebar widget area on blog articles', 'react')
		),
		'portfolio' => array(
			'id' => 'react-sidebar-portfolio',
			'name' => esc_html__('Portfolio Sidebar', 'react'),
			'description' => esc_html__('The sidebar widget area on portfolio pages', 'react')
		)
	);

	return apply_filters('react_get_sidebars', $sidebars);
}

function react_widgets_init()
{
	// Initialise sidebars
	$sidebars = react_get_sidebars();
	global $react;

	foreach ($sidebars as $key => $sidebar) {
		register_sidebar(array(
			'id' => $sidebar['id'],
			'name' => $sidebar['name'],
			'description' => $sidebar['description'],
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	}

	if ($react['options']['popdown_content_type'] == 'widget') {
		$count = count(explode('-', $react['options']['popdown_widget_area_layout']));

		for ($i = 1; $i <= $count; $i++) {
			register_sidebar(array(
				'id' => 'popdown-widget-' . $i,
				'name' => sprintf(esc_html__('Popdown Column %d', 'react'), $i),
				'description' => sprintf(esc_html__('The popdown widget area, column %d.', 'react'), $i),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
		}
	}

	foreach ($react['options']['im_custom_widget_areas'] as $widgetArea) {
		register_sidebar(array(
			'id' => 'im-cwa-' . $widgetArea['id'],
			'name' => sprintf(esc_html__("Info Menu: '%s'", 'react'), $widgetArea['name']),
			'description' => sprintf(esc_html__("The custom Info Menu widget area '%s'.", 'react'), $widgetArea['name']),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	}

	if ($react['options']['footer_top_widget_area_layout']) {
		$count = count(explode('-', $react['options']['footer_top_widget_area_layout']));

		for ($i = 1; $i <= $count; $i++) {
			register_sidebar(array(
				'id' => 'footer-top-widget-' . $i,
				'name' => sprintf(esc_html__('Above Footer Column %d', 'react'), $i),
				'description' => sprintf(esc_html__('The widget area above the footer, column %d.', 'react'), $i),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
		}
	}

	if ($react['options']['footer_widget_area_layout']) {
		$count = count(explode('-', $react['options']['footer_widget_area_layout']));

		for ($i = 1; $i <= $count; $i++) {
			register_sidebar(array(
				'id' => 'footer-widget-' . $i,
				'name' => sprintf(esc_html__('Footer Column %d', 'react'), $i),
				'description' => sprintf(esc_html__('The footer widget area, column %d.', 'react'), $i),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
		}
	}

	// Enable shortcodes in the default text widget
	add_filter('widget_text', 'do_shortcode');
}
add_action('widgets_init', 'react_widgets_init');

/**
 * Displays the sidebar
 */
function react_dynamic_sidebar()
{
	$sidebars = react_get_sidebars();

	if (is_page()) {
		$sidebar = 'page';
	} elseif (is_singular()) {
		$sidebar = get_post_type() == 'portfolio' ? 'portfolio' : 'blog';
	} elseif (is_tax('portfolio_category') || is_tax('portfolio_tag')) {
		$sidebar = 'portfolio';
	} else {
		$sidebar = 'blog';
	}

	$sidebar = apply_filters('react_sidebar', $sidebar);

	if (isset($sidebar, $sidebars[$sidebar]) && is_active_sidebar($sidebars[$sidebar]['id'])) {
		dynamic_sidebar($sidebars[$sidebar]['id']);
	}
}

/**
 * This function determines whether we should show the sidebar on the current
 * page
 */
function react_get_sidebar()
{
	global $react;
	$sidebar = true;

	if (is_404()) {
		return;
	}

	if ($react['layout'] == 'full-width') {
		$sidebar = false;
	}

	if ($sidebar) {
		get_sidebar();
	}
}
add_action('react_after_content', 'react_get_sidebar');