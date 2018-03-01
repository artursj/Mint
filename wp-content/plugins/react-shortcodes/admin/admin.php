<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Enqueue the admin CSS stylesheet
 *
 * @param string $hook The current page
 */
function tcs_admin_enqueue_styles($hook)
{
	if (in_array($hook, array('post.php', 'post-new.php', 'widgets.php', 'settings_page_tcs_settings'))) {
		wp_enqueue_style('qtip2', tcs_url('admin/js/qtip2/jquery.qtip.min.css'), array(), '2.2.1');

		if (in_array($hook, array('post.php', 'post-new.php', 'widgets.php'))) {
			wp_enqueue_style('font-awesome', tcs_url('css/font-awesome/css/font-awesome.min.css'), array(), '4.6.1');
			wp_enqueue_style('icomoon', tcs_url('css/icomoon/css/icomoon.min.css'), array(), TCS_PLUGIN_VERSION);
			wp_enqueue_style('iconsprite', tcs_url('css/iconsprite.css'), array(), TCS_PLUGIN_VERSION);
			wp_enqueue_style('jslider', tcs_url('admin/js/jslider/css/jquery.slider.css'), array(), '1.2.0');
		} elseif ($hook == 'settings_page_tcs_settings') {
			wp_enqueue_style('chosen', tcs_url('admin/js/chosen/chosen.min.css'), array(), '1.4.2');
		}

		wp_enqueue_style('tcas-styles', tcs_url('admin/css/styles.css'), array(), TCS_PLUGIN_VERSION);

		if (is_rtl()) {
			wp_enqueue_style('tcas-rtl', tcs_url('admin/css/rtl.css'), array(), TCS_PLUGIN_VERSION);
		}
	}
}
add_action('admin_enqueue_scripts', 'tcs_admin_enqueue_styles');

/**
 * Enqueue the admin JavaScript
 *
 * @param string $hook The current page
 */
function tcs_admin_enqueue_scripts($hook)
{
	if (in_array($hook, array('post.php', 'post-new.php', 'widgets.php', 'settings_page_tcs_settings'))) {
		if ($hook == 'widgets.php') {
			wp_enqueue_media();
		}

		wp_enqueue_script('qtip2', tcs_url('admin/js/qtip2/jquery.qtip.min.js'), array('jquery'), '2.2.1', true);

		if (in_array($hook, array('post.php', 'post-new.php', 'widgets.php'))) {
			wp_enqueue_script('jslider', tcs_url('admin/js/jslider/jquery.slider.min.js'), array('jquery'), '1.2.0', true);
			wp_enqueue_script('jquery-toggleswitch', tcs_url('admin/js/jquery.toggleswitch.js'), array('jquery'), '1.2.1', true);
			wp_enqueue_script('tcas-shortcodes', tcs_url('admin/js/shortcodes.js'), array('jquery', 'shortcode'), TCS_PLUGIN_VERSION, true);
		} elseif ($hook == 'settings_page_tcs_settings'){
			wp_enqueue_script('chosen', tcs_url('admin/js/chosen/jquery.chosen.min.js'), array('jquery'), '1.4.2', true);
			wp_enqueue_script('tcas-settings', tcs_url('admin/js/settings.js'), array('jquery'), TCS_PLUGIN_VERSION, true);
		}

		wp_enqueue_script('tcas-scripts', tcs_url('admin/js/admin.js'), array('jquery'), TCS_PLUGIN_VERSION, true);

		wp_localize_script('tcas-scripts', 'tcasL10n', tcs_admin_l10n());
	}
}
add_action('admin_enqueue_scripts', 'tcs_admin_enqueue_scripts');

/**
 * Admin script localization
 *
 * @return array
 */
function tcs_admin_l10n()
{
	$data = array(
		'siteUrl' => site_url(),
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'themeAdminUrl' => tcs_url('admin'),
		'uploadsUrl' => tcs_uploads_url(),
		'close' => esc_html__('Close', 'react-shortcodes'),
		'insert' => esc_html__('Insert', 'react-shortcodes'),
		'insertClose' => esc_html__('Insert & Close', 'react-shortcodes'),
		'shortcodeGeneratorUrl' => admin_url('admin-ajax.php?action=tcs_insert_shortcode'),
		'on' => esc_html__('On', 'react-shortcodes'),
		'off' => esc_html__('Off', 'react-shortcodes'),
		'_default' => esc_html__('Default', 'react-shortcodes'),
		'yes' => esc_html__('Yes', 'react-shortcodes'),
		'no' => esc_html__('No', 'react-shortcodes'),
		'accordionPaneHtml' => tcs_get_accordion_pane_html(),
		'tabPaneHtml' => tcs_get_tab_sc_pane_html(),
		'content' => esc_html__('Content', 'react-shortcodes'),
		'removeTab' => esc_html__('Remove tab', 'react-shortcodes'),
		'removeSlide' => esc_html__('Remove slide', 'react-shortcodes'),
		'shortcodePreviewUrl' => admin_url('?tcs_shortcode_preview=1'),
		'select' => esc_html__('Select', 'react-shortcodes'),
		'selectImage' => esc_html__('Select Image', 'react-shortcodes'),
		'noIconSelected' => esc_html__('No icon selected', 'react-shortcodes'),
		'deleteImage' => esc_html__('Delete image', 'react-shortcodes'),
		'saveSettingsNonce' => wp_create_nonce('tcs_save_settings'),
		'resetSettingsNonce' => wp_create_nonce('tcs_reset_settings'),
		'confirmResetSettings' => esc_html__('Are you sure you want to reset the settings?', 'react-shortcodes') . "\n\n" . esc_html__('The page will reload and the current settings will be replaced with the defaults.', 'react-shortcodes'),
	);

	return array(
		'l10n_print_after' => 'tcasL10n = ' . wp_json_encode($data) . ';'
	);
}

/**
 * Add the "Insert shortcode" button to the end of the media buttons above a post/page
 *
 * @param  string  $widgetId  The ID of the text widget textarea
 */
function tcs_insert_shortcode_button($widgetId = '')
{
	printf('<button type="button" class="button tcas-insert-trigger" data-widget="%s"><span></span>%s</button>',
		esc_attr($widgetId),
		esc_attr__('Add / Edit Shortcode', 'react-shortcodes')
	);
}
add_action('media_buttons', 'tcs_insert_shortcode_button', 20, 0);

/**
 * The "Insert shortcode" dialog
 */
function tcs_insert_shortcode()
{
	require_once TCS_ADMIN_INCLUDES_DIR . '/OptionsGenerator.php';
	require_once TCS_ADMIN_INCLUDES_DIR . '/ShortcodeOptionsGenerator.php';
	require_once TCS_ADMIN_INCLUDES_DIR . '/shortcodes.php';
	wp_die();
}
add_action('wp_ajax_tcs_insert_shortcode', 'tcs_insert_shortcode');

function tcs_insert_shortcode_nopriv()
{
	wp_die(esc_html__('You do not have permission to perform this action. Are you logged in?', 'react-shortcodes'));
}
add_action('wp_ajax_nopriv_tcs_insert_shortcode', 'tcs_insert_shortcode_nopriv');

/**
 * Hook into auth_redirect to show shortcode preview
 */
function tcs_shortcode_preview()
{
	if (isset($_GET['tcs_shortcode_preview']) && $_GET['tcs_shortcode_preview'] == '1') {
		require_once TCS_ADMIN_INCLUDES_DIR . '/shortcode-preview.php';
		exit;
	}
}
add_action('auth_redirect', 'tcs_shortcode_preview');

/**
 * Displays the shortcode preview area
 */
function tcs_shortcode_preview_html()
{
	?>
	<div class="tcas-preview-outer">
		<div class="tcas-preview-label"><h4><?php esc_html_e('Preview', 'react-shortcodes'); ?></h4><span class="tcas-preview-refresh" title="<?php esc_attr_e('Refresh preview', 'react-shortcodes'); ?>"></span></div>
		<div class="tcas-preview-inner"><iframe class="tcas-preview-content-frame"></iframe></div>
	</div>
	<?php
}

/**
 * Get the HTML for the accordion pane for the SC generator
 *
 * @return  string
 */
function tcs_get_accordion_pane_html()
{
	return '<div class="tcas-sc-pane">
	<div class="tcas-sc-pane-remove" title="' . esc_attr__('Remove toggle', 'react-shortcodes') . '">X</div>
	<div class="tcas-sc-pane-outer tcas-clearfix">
		<div class="tcas-sc-pane-label">
			<h4>' . esc_html__('Title', 'react-shortcodes') . '</h4>
		</div>
		<div class="tcas-sc-pane-inner">
			<input class="tcas-sc-pane-title" type="text" />
		</div>
	</div>
	<div class="tcas-sc-pane-outer tcas-clearfix">
		<div class="tcas-sc-pane-label">
			<h4>' . esc_html__('Content', 'react-shortcodes') . '</h4>
		</div>
		<div class="tcas-sc-pane-inner">
			<textarea></textarea>
		</div>
	</div>
	<div class="tcas-sc-pane-outer tcas-clearfix">
		<div class="tcas-sc-pane-label">
			<h4>' . esc_html__('Open by default', 'react-shortcodes') . '</h4>
		</div>
		<div class="tcas-sc-pane-inner">
			<input type="checkbox">
		</div>
	</div>
	<div class="tcas-sc-pane-outer tcas-clearfix">
		<div class="tcas-sc-pane-label">
			<h4>' . esc_html__('Custom classes', 'react-shortcodes') . '</h4>
		</div>
		<div class="tcas-sc-pane-inner">
			<input class="tcas-sc-pane-classes" type="text" />
		</div>
	</div>
</div>';
}

/**
 * The HTML for a single tab pane options in the SC generator
 *
 * @return string
 */
function tcs_get_tab_sc_pane_html()
{
	ob_start(); ?>
	<div class="tcas-sc-pane">
		<div class="tcas-sc-pane-remove" title="<?php esc_attr_e('Remove tab', 'react-shortcodes'); ?>">X</div>
		<div class="tcas-sc-pane-outer tcas-clearfix">
			<div class="tcas-sc-pane-label">
				<h4><?php esc_html_e('Title', 'react-shortcodes'); ?></h4>
			</div>
			<div class="tcas-sc-pane-inner">
				<input type="text" />
			</div>
		</div>
		<div class="tcas-sc-pane-outer tcas-clearfix">
			<div class="tcas-sc-pane-label">
				<h4><?php esc_html_e('Content', 'react-shortcodes'); ?></h4>
			</div>
			<div class="tcas-sc-pane-inner">
				<textarea></textarea>
			</div>
		</div>
		<div class="tcas-sc-pane-outer tcas-clearfix">
			<div class="tcas-sc-pane-label">
				<h4><?php esc_html_e('Icon', 'react-shortcodes'); ?></h4>
			</div>
			<div class="tcas-sc-pane-inner">
				<?php echo tcs_icon_selector_field('', 'tcas-sc-pane-icon'); ?>
			</div>
		</div>
	</div>
	<?php

	return ob_get_clean();
}

/**
 * Returns the HTML for the options for the column layout select
 *
 * @param   string  $selected  The selected option
 * @return  string             The HTML
 */
function tcs_render_column_layout_options($selected = '')
{
	$options = tcs_get_column_layout_options();
	$output = '';

	foreach ($options as $option) {
		$output .= '<optgroup label="' . esc_attr($option['label']) . '">';

		foreach($option['options'] as $key => $value) {
			$s = $key == $selected ? ' selected="selected"' : '';
			$output .= '<option value="' . esc_attr($key) . '"' . $s . '>' . esc_html($value) . '</option>';
		}

		$output .= '</optgroup>';
	}

	return $output;
}

/**
 * Returns the array of all possible column layout options
 *
 * @return array
 */
function tcs_get_column_layout_options()
{
	return array(
		1 => array(
			'label' => esc_html__('1 column', 'react-shortcodes'),
			'options' => array(
				'100' => esc_html__('100%', 'react-shortcodes')
			)
		),
		2 => array(
			'label' => esc_html__('2 columns', 'react-shortcodes'),
			'options' => array(
				'50-50' => esc_html__('50% - 50%', 'react-shortcodes'),
				'60-40' => esc_html__('60% - 40%', 'react-shortcodes'),
				'40-60' => esc_html__('40% - 60%', 'react-shortcodes'),
				'66-33' => esc_html__('66% - 33%', 'react-shortcodes'),
				'33-66' => esc_html__('33% - 66%', 'react-shortcodes'),
				'70-30' => esc_html__('70% - 30%', 'react-shortcodes'),
				'30-70' => esc_html__('30% - 70%', 'react-shortcodes'),
				'75-25' => esc_html__('75% - 25%', 'react-shortcodes'),
				'25-75' => esc_html__('25% - 75%', 'react-shortcodes'),
				'80-20' => esc_html__('80% - 20%', 'react-shortcodes'),
				'20-80' => esc_html__('20% - 80%', 'react-shortcodes')
			)
		),
		3 => array(
			'label' => esc_html__('3 columns', 'react-shortcodes'),
			'options' => array(
				'33-33-33' => esc_html__('33% - 33% - 33%', 'react-shortcodes'),
				'50-25-25' => esc_html__('50% - 40% - 33%', 'react-shortcodes'),
				'25-50-25' => esc_html__('25% - 50% - 25%', 'react-shortcodes'),
				'25-25-50' => esc_html__('25% - 25% - 50%', 'react-shortcodes'),
				'50-30-20' => esc_html__('50% - 30% - 20%', 'react-shortcodes'),
				'50-20-30' => esc_html__('50% - 20% - 30%', 'react-shortcodes'),
				'20-50-30' => esc_html__('20% - 50% - 30%', 'react-shortcodes'),
				'30-50-20' => esc_html__('30% - 50% - 20%', 'react-shortcodes'),
				'30-20-50' => esc_html__('30% - 20% - 50%', 'react-shortcodes'),
				'20-30-50' => esc_html__('20% - 30% - 50%', 'react-shortcodes'),
				'60-20-20' => esc_html__('60% - 20% - 20%', 'react-shortcodes'),
				'20-60-20' => esc_html__('20% - 60% - 20%', 'react-shortcodes'),
				'20-20-60' => esc_html__('20% - 20% - 60%', 'react-shortcodes'),
				'30-30-40' => esc_html__('30% - 30% - 40%', 'react-shortcodes'),
				'30-40-30' => esc_html__('30% - 40% - 30%', 'react-shortcodes'),
				'40-30-30' => esc_html__('40% - 30% - 30%', 'react-shortcodes')
			)
		),
		4 => array(
			'label' => esc_html__('4 columns', 'react-shortcodes'),
			'options' => array(
				'25-25-25-25' => esc_html__('25% - 25% - 25% - 25%', 'react-shortcodes'),
				'20-20-20-40' => esc_html__('20% - 20% - 20% - 40%', 'react-shortcodes'),
				'20-20-40-20' => esc_html__('20% - 20% - 40% - 20%', 'react-shortcodes'),
				'20-40-20-20' => esc_html__('20% - 40% - 20% - 20%', 'react-shortcodes'),
				'40-20-20-20' => esc_html__('40% - 20% - 20% - 20%', 'react-shortcodes'),
				'30-30-20-20' => esc_html__('30% - 30% - 20% - 20%', 'react-shortcodes'),
				'30-20-30-20' => esc_html__('30% - 20% - 30% - 20%', 'react-shortcodes'),
				'30-20-20-30' => esc_html__('30% - 20% - 20% - 30%', 'react-shortcodes'),
				'20-30-20-30' => esc_html__('20% - 30% - 20% - 30%', 'react-shortcodes'),
				'20-20-30-30' => esc_html__('20% - 20% - 30% - 30%', 'react-shortcodes')
			)
		),
		5 => array(
			'label' => esc_html__('5 columns', 'react-shortcodes'),
			'options' => array(
				'20-20-20-20-20' => esc_html__('20% - 20% - 20% - 20% - 20%', 'react-shortcodes')
			)
		),
	);
}

/**
 * Get the array of WP nav menus for use in a <select> field
 *
 * @return  array
 */
function tcs_get_nav_menu_options()
{
	$options = array();
	$menus = wp_get_nav_menus(array('orderby' => 'name'));

	if (count($menus)) {
		$options = array('' => esc_html__('Select a menu', 'react-shortcodes'));
		foreach ($menus as $menu) {
			$options[$menu->term_id] = $menu->name;
		}
	} else {
		$options = array('' => esc_html__('No nav menus found', 'react-shortcodes'));
	}

	return $options;
}

/**
 * Get the array of Quform forms to use in a <select>
 *
 * @param   boolean  $showDefaultOption  Include the "Default" option
 * @param   string   $emptyOptionValue   For shortcodes we want the none/empty option to be the same so that no attribute is added when generating the SC.
 *                                       For metaboxes we want none to be different from empty so that none forces no form wheres empty forces default inherit.
 * @return  array                        The array of forms
 */
function tcs_get_quform_forms_options($showDefaultOption = false, $emptyOptionValue = '')
{
	if (function_exists('iphorm_get_all_forms')) {
		$forms = iphorm_get_all_forms();

		if (count($forms)) {
			$options = array('none' => esc_html__('None', 'react-shortcodes'));
			foreach ($forms as $form) {
				$options[$form['id']] = $form['name'] . ($form['active'] == 0 ? ' (' . esc_html__('inactive', 'react-shortcodes') . ')' : '');
			}
		} else {
			$options = array($emptyOptionValue => esc_html__('No forms found', 'react-shortcodes'));
		}

		if ($showDefaultOption) {
			$options = array('' => esc_html__('Default', 'react-shortcodes')) + $options;
		}
	} else {
		$options = array($emptyOptionValue => esc_html__('Quform is not installed', 'react-shortcodes'));
	}

	return $options;
}

/**
 * Get the texture options
 *
 * @param   boolean  $showDefaultOption  Include the Default empty option
 * @return  array                        The texture options array
 */
function tcs_get_texture_options($showDefaultOption = false)
{
	$options = array(
		'none' => esc_html__('None', 'react-shortcodes'),
		'vert-thin-dk' => esc_html__('Vertical thin lines dark', 'react-shortcodes'),
		'vert-thick-dk' => esc_html__('Vertical thick lines dark', 'react-shortcodes'),
		'diagonal-dk' => esc_html__('Diagonal lines dark', 'react-shortcodes'),
		'diagonal-rev-dk' => esc_html__('Diagonal reversed dark', 'react-shortcodes'),
		'square-dk' => esc_html__('Squares dark', 'react-shortcodes'),
		'dot-dk' => esc_html__('Dots dark', 'react-shortcodes'),
		'cross-dk' => esc_html__('Crosses dark 2', 'react-shortcodes'),
		'cross-two-dk' => esc_html__('Crosses dark', 'react-shortcodes'),

		'vert-thin-lt' => esc_html__('Vertical thin lines light', 'react-shortcodes'),
		'vert-thick-lt' => esc_html__('Vertical thick lines light', 'react-shortcodes'),
		'diagonal-lt' => esc_html__('Diagonal lines light', 'react-shortcodes'),
		'diagonal-rev-lt' => esc_html__('Diagonal reversed light', 'react-shortcodes'),
		'square-lt' => esc_html__('Squares light', 'react-shortcodes'),
		'dot-lt' => esc_html__('Dots light', 'react-shortcodes'),
		'cross-lt' => esc_html__('Crosses light 2', 'react-shortcodes'),
		'cross-two-lt' => esc_html__('Crosses light', 'react-shortcodes'),

		'congruent_pentagon' => esc_html__('Congruent pentagon light', 'react-shortcodes'),
		'congruent_pentagon_dark' => esc_html__('Congruent pentagon dark', 'react-shortcodes'),
		'dark_wood' => esc_html__('Dark wood', 'react-shortcodes'),
		'diagonal_striped_brick' => esc_html__('Diagonal striped bricks', 'react-shortcodes'),
		'diamond_upholstery' => esc_html__('Diamond upholstery', 'react-shortcodes'),
		'escheresque' => esc_html__('Escheresque', 'react-shortcodes'),
		'fake_brick' => esc_html__('Fake brick', 'react-shortcodes'),
		'pinstriped_suit' => esc_html__('Pinstriped suit', 'react-shortcodes'),
		'ps_neutral' => esc_html__('PhotoShop Neutral', 'react-shortcodes'),
		'retina_wood' => esc_html__('Light wood', 'react-shortcodes'),
		'shattered' => esc_html__('Shattered dark', 'react-shortcodes'),
		'shattered-lgt' => esc_html__('Shattered light', 'react-shortcodes'),
		'skulls' => esc_html__('Fantasy', 'react-shortcodes'),
		'noise' => esc_html__('Noise', 'react-shortcodes'),
		'use_your_illusion' => esc_html__('Use your illusion', 'react-shortcodes'),

		'white_wave' => esc_html__('White wave', 'react-shortcodes'),
		'pixel_weave' => esc_html__('Pixel weave', 'react-shortcodes'),
		'alt_tri' => esc_html__('Alternate triangles', 'react-shortcodes'),
		'hex' => esc_html__('Hexagon', 'react-shortcodes'),
		'squared_metal' => esc_html__('Squared metal', 'react-shortcodes'),
		'multi_dots' => esc_html__('Multiple dots', 'react-shortcodes'),
		'bigstrips' => esc_html__('Thin stripes', 'react-shortcodes'),
		'hugestripes' => esc_html__('Fat stripes', 'react-shortcodes')
	);

	if ($showDefaultOption) {
		$options = array('' => esc_html__('Default (inherited from Theme Options)', 'react-shortcodes')) + $options;
	}

	return $options;
}

/**
 * Get the background detail options
 *
 * @param   boolean  $showDefaultOption  Include the Default empty option
 * @return  array                        The background detail options
 */
function tcs_get_detail_options($showDefaultOption = false)
{
	$options = array(
		'none' => esc_html__('None', 'react-shortcodes'),

		'break-lines-light' => esc_html__('Diagonal lines', 'react-shortcodes'),
		'break-lines-light-bottom' => esc_html__('Bottom diagonal lines', 'react-shortcodes'),

		'one-light' => esc_html__('Top 1px Highlight', 'react-shortcodes'),
		'one-light-bottom' => esc_html__('Bottom 1px Highlight', 'react-shortcodes'),

		'six-light' => esc_html__('Top 6px Highlight', 'react-shortcodes'),
		'six-light-bottom' => esc_html__('Bottom 6px Highlight', 'react-shortcodes'),

		'med-gradient-light-top' => esc_html__('Medium gradient, light, top', 'react-shortcodes'),
		'med-gradient-light-bottom' => esc_html__('Medium gradient, light, bottom', 'react-shortcodes'),

		'large-gradient-light-top' => esc_html__('Large gradient, light, top', 'react-shortcodes'),
		'large-gradient-light-bottom' => esc_html__('Large gradient, light, bottom', 'react-shortcodes'),

		'solid-edge-light' => esc_html__('Solid outline light', 'react-shortcodes'),
		'small-edge-light' => esc_html__('Lighter to edges small', 'react-shortcodes'),
		'large-edge-light' => esc_html__('Lighter to edges large', 'react-shortcodes'),

		'break-lines-dark' => esc_html__('Diagonal lines', 'react-shortcodes'),
		'break-lines-dark-bottom' => esc_html__('Bottom diagonal lines', 'react-shortcodes'),

		'one-dark' => esc_html__('Top 1px shadow', 'react-shortcodes'),
		'one-dark-bottom' => esc_html__('Bottom 1px shadow', 'react-shortcodes'),

		'six-dark' => esc_html__('Top 3px shadow', 'react-shortcodes'),
		'six-dark-bottom' => esc_html__('Bottom 3px shadow', 'react-shortcodes'),

		'med-gradient-dark-top' => esc_html__('Medium gradient, dark, top', 'react-shortcodes'),
		'med-gradient-dark-bottom' => esc_html__('Medium gradient, dark, bottom', 'react-shortcodes'),

		'large-gradient-dark-top' => esc_html__('Large gradient, dark, top', 'react-shortcodes'),
		'large-gradient-dark-bottom' => esc_html__('Large gradient, dark, bottom', 'react-shortcodes'),

		'solid-edge-dark' => esc_html__('Solid outline dark', 'react-shortcodes'),
		'small-edge-dark' => esc_html__('Darker to edges small', 'react-shortcodes'),
		'large-edge-dark' => esc_html__('Darker to edges large', 'react-shortcodes'),

		'shadow-left' => esc_html__('Shadow left', 'react-shortcodes'),
		'shadow-center' => esc_html__('Shadow center', 'react-shortcodes'),
		'shadow-center-split' => esc_html__('Shadow center split', 'react-shortcodes'),
		'shadow-sides' => esc_html__('Shadow sides', 'react-shortcodes')
	);

	if ($showDefaultOption) {
		$options = array('' => esc_html__('Default (inherited from Theme Options)', 'react-shortcodes')) + $options;
	}

	return $options;
}

/**
 * Returns the array of options to use in the use_main_img option in custom image
 *
 * @return  array
 */
function tcs_get_retina_use_main_img_options()
{
	return array(
		'never' => esc_html__('Nothing (keep full size image above always)', 'react-shortcodes'),
		'use-main-img' => esc_html__('Use the above image at 50%', 'react-shortcodes'),
		'use-new-img' => esc_html__('Select a new image to use', 'react-shortcodes'),
		'change-position' => esc_html__('Use this image but change position', 'react-shortcodes'),
		'no-image' => esc_html__('Show no image at break point', 'react-shortcodes')
	);
}

/**
 * Get the background position options
 *
 * @param   bool   $showCustom   Show the custom option
 * @param   bool   $showDefault  Show the default option
 * @return  array
 */
function tcs_get_background_position_options($showCustom = true, $showDefault = false)
{
	$options = array(
		'left top' => 'left top',
		'center top' => 'center top',
		'right top' => 'right top',
		'left center' => 'left center',
		'center center' => 'center center',
		'right center' => 'right center',
		'left bottom' => 'left bottom',
		'center bottom' => 'center bottom',
		'right bottom' => 'right bottom'
	);

	if ($showCustom) {
		$options['custom'] = esc_html__('Custom', 'react-shortcodes');
	}

	if ($showDefault) {
		$options[''] = esc_html__('Default', 'react-shortcodes');
	}

	return $options;
}

/**
 * Get the background repeat options
 *
 * @param   bool   $showDefault  Show the default option
 * @return  array
 */
function tcs_get_background_repeat_options($showDefault = false)
{
	$options = array(
		'no-repeat' => 'no-repeat',
		'repeat' => 'repeat',
		'repeat-x' => 'repeat-x',
		'repeat-y' => 'repeat-y'
	);

	if ($showDefault) {
		$options[''] = esc_html__('Default', 'react-shortcodes');
	}

	return $options;
}

/**
 * Get the convert options, for use in a <select>
 *
 * @param  boolean  $showDefaultOption  If true, show a default option
 * @return array
 */
function tcs_get_convert_options($showDefaultOption = false)
{
	$options = array(
		'phone-ptr' => esc_html__('Phone Portrait', 'react-shortcodes'),
		'phone-ldsp' => esc_html__('Phone Landscape', 'react-shortcodes'),
		'tablet-ptr' => esc_html__('Tablet Portrait', 'react-shortcodes'),
		'tablet-ldsp' => esc_html__('Tablet Landscape', 'react-shortcodes'),
		'box-width' => esc_html__('Site box width (if set)', 'react-shortcodes'),
		'only-retina-devices' => esc_html__('Only on Retina devices', 'react-shortcodes'),
		'custom' => esc_html__('Custom', 'react-shortcodes')
	);

	if ($showDefaultOption) {
		$options = array('' => esc_html__('Default', 'react-shortcodes')) + $options;
	}

	return $options;
}

/**
 * Get the list of available flags
 *
 * @return  array
 */
function tcs_get_flag_options()
{
	return (include TCS_ADMIN_INCLUDES_DIR . '/flag-options.php');
}

/**
 * Gets the array of all available icons
 *
 * @return  array  The array of icons
 */
function tcs_get_icons()
{
	return array(
		'iconsprite' => array(
			'home', 'home2', 'office', 'newspaper', 'pen', 'image', 'images', 'camera', 'music', 'play', 'film', 'camera2', 'bullhorn', 'book', 'profile', 'file', 'file2', 'file3', 'mic', 'tag', 'credit', 'support', 'phone', 'address-book', 'pushpin', 'location', 'location2', 'clock', 'clock2', 'alarm', 'calendar', 'calendar2',
			'laptop', 'mobile', 'mobile2', 'box-add', 'box-remove', 'bubble', 'bubbles', 'user', 'users', 'cart', 'user3', 'busy', 'quotes-left', 'search', 'lock', 'unlocked', 'settings', 'equalizer', 'cog', 'bug', 'pie', 'stats', 'bars', 'gift', 'mug', 'food', 'fire', 'lab', 'airplane', 'truck', 'lightning', 'switch',
			'menu', 'earth', 'link', 'flag', 'attachment', 'eye', 'bookmark', 'star', 'heart', 'heart-broken', 'info', 'cancel-circle', 'checkmark-circle', 'checkmark', 'thumbsup', 'minus', 'plus', 'play2', 'pause', 'stop', 'backward', 'forward', 'first', 'last', 'previous', 'next', 'volume-high', 'volume-medium', 'volume-low', 'volume-mute', 'volume-mute2', 'volume-increase',
			'loop', 'radio-checked', 'radio-unchecked', 'paragraph-justify', 'new-tab', 'wifi', 'basket', 'google-plus', 'facebook', 'twitter', 'feed', 'youtube', 'vimeo', 'flickr', 'flickr2', 'skype', 'pinterest', 'paypal', 'directions', 'envelope', 'calendar3', 'coffee', 'globe',
		),
		'fontawesome' => array(
			'fa-glass', 'fa-music', 'fa-search', 'fa-envelope-o', 'fa-heart', 'fa-star', 'fa-star-o', 'fa-user', 'fa-film', 'fa-th-large', 'fa-th', 'fa-th-list', 'fa-check', 'fa-remove',
			'fa-close', 'fa-times', 'fa-search-plus', 'fa-search-minus', 'fa-power-off', 'fa-signal', 'fa-gear', 'fa-cog', 'fa-trash-o', 'fa-home', 'fa-file-o', 'fa-clock-o', 'fa-road',
			'fa-download', 'fa-arrow-circle-o-down', 'fa-arrow-circle-o-up', 'fa-inbox', 'fa-play-circle-o', 'fa-rotate-right', 'fa-repeat', 'fa-refresh', 'fa-list-alt', 'fa-lock',
			'fa-flag', 'fa-headphones', 'fa-volume-off', 'fa-volume-down', 'fa-volume-up', 'fa-qrcode', 'fa-barcode', 'fa-tag', 'fa-tags', 'fa-book', 'fa-bookmark', 'fa-print',
			'fa-camera', 'fa-font', 'fa-bold', 'fa-italic', 'fa-text-height', 'fa-text-width', 'fa-align-left', 'fa-align-center', 'fa-align-right', 'fa-align-justify', 'fa-list',
			'fa-dedent', 'fa-outdent', 'fa-indent', 'fa-video-camera', 'fa-photo', 'fa-image', 'fa-picture-o', 'fa-pencil', 'fa-map-marker', 'fa-adjust', 'fa-tint', 'fa-edit',
			'fa-pencil-square-o', 'fa-share-square-o', 'fa-check-square-o', 'fa-arrows', 'fa-step-backward', 'fa-fast-backward', 'fa-backward', 'fa-play', 'fa-pause', 'fa-stop',
			'fa-forward', 'fa-fast-forward', 'fa-step-forward', 'fa-eject', 'fa-chevron-left', 'fa-chevron-right', 'fa-plus-circle', 'fa-minus-circle', 'fa-times-circle',
			'fa-check-circle', 'fa-question-circle', 'fa-info-circle', 'fa-crosshairs', 'fa-times-circle-o', 'fa-check-circle-o', 'fa-ban', 'fa-arrow-left', 'fa-arrow-right',
			'fa-arrow-up', 'fa-arrow-down', 'fa-mail-forward', 'fa-share', 'fa-expand', 'fa-compress', 'fa-plus', 'fa-minus', 'fa-asterisk', 'fa-exclamation-circle', 'fa-gift',
			'fa-leaf', 'fa-fire', 'fa-eye', 'fa-eye-slash', 'fa-warning', 'fa-exclamation-triangle', 'fa-plane', 'fa-calendar', 'fa-random', 'fa-comment', 'fa-magnet', 'fa-chevron-up',
			'fa-chevron-down', 'fa-retweet', 'fa-shopping-cart', 'fa-folder', 'fa-folder-open', 'fa-arrows-v', 'fa-arrows-h', 'fa-bar-chart-o', 'fa-bar-chart', 'fa-twitter-square',
			'fa-facebook-square', 'fa-camera-retro', 'fa-key', 'fa-gears', 'fa-cogs', 'fa-comments', 'fa-thumbs-o-up', 'fa-thumbs-o-down', 'fa-star-half', 'fa-heart-o', 'fa-sign-out',
			'fa-linkedin-square', 'fa-thumb-tack', 'fa-external-link', 'fa-sign-in', 'fa-trophy', 'fa-github-square', 'fa-upload', 'fa-lemon-o', 'fa-phone', 'fa-square-o', 'fa-bookmark-o',
			'fa-phone-square', 'fa-twitter', 'fa-facebook-f', 'fa-facebook', 'fa-github', 'fa-unlock', 'fa-credit-card', 'fa-feed', 'fa-rss', 'fa-hdd-o', 'fa-bullhorn', 'fa-bell',
			'fa-certificate', 'fa-hand-o-right', 'fa-hand-o-left', 'fa-hand-o-up', 'fa-hand-o-down', 'fa-arrow-circle-left', 'fa-arrow-circle-right', 'fa-arrow-circle-up', 'fa-arrow-circle-down',
			'fa-globe', 'fa-wrench', 'fa-tasks', 'fa-filter', 'fa-briefcase', 'fa-arrows-alt', 'fa-group', 'fa-users', 'fa-chain', 'fa-link', 'fa-cloud', 'fa-flask', 'fa-cut', 'fa-scissors',
			'fa-copy', 'fa-files-o', 'fa-paperclip', 'fa-save', 'fa-floppy-o', 'fa-square', 'fa-navicon', 'fa-reorder', 'fa-bars', 'fa-list-ul', 'fa-list-ol', 'fa-strikethrough', 'fa-underline',
			'fa-table', 'fa-magic', 'fa-truck', 'fa-pinterest', 'fa-pinterest-square', 'fa-google-plus-square', 'fa-google-plus', 'fa-money', 'fa-caret-down', 'fa-caret-up', 'fa-caret-left',
			'fa-caret-right', 'fa-columns', 'fa-unsorted', 'fa-sort', 'fa-sort-down', 'fa-sort-desc', 'fa-sort-up', 'fa-sort-asc', 'fa-envelope', 'fa-linkedin', 'fa-rotate-left', 'fa-undo',
			'fa-legal', 'fa-gavel', 'fa-dashboard', 'fa-tachometer', 'fa-comment-o', 'fa-comments-o', 'fa-flash', 'fa-bolt', 'fa-sitemap', 'fa-umbrella', 'fa-paste', 'fa-clipboard',
			'fa-lightbulb-o', 'fa-exchange', 'fa-cloud-download', 'fa-cloud-upload', 'fa-user-md', 'fa-stethoscope', 'fa-suitcase', 'fa-bell-o', 'fa-coffee', 'fa-cutlery', 'fa-file-text-o',
			'fa-building-o', 'fa-hospital-o', 'fa-ambulance', 'fa-medkit', 'fa-fighter-jet', 'fa-beer', 'fa-h-square', 'fa-plus-square', 'fa-angle-double-left', 'fa-angle-double-right',
			'fa-angle-double-up', 'fa-angle-double-down', 'fa-angle-left', 'fa-angle-right', 'fa-angle-up', 'fa-angle-down', 'fa-desktop', 'fa-laptop', 'fa-tablet', 'fa-mobile-phone',
			'fa-mobile', 'fa-circle-o', 'fa-quote-left', 'fa-quote-right', 'fa-spinner', 'fa-circle', 'fa-mail-reply', 'fa-reply', 'fa-github-alt', 'fa-folder-o', 'fa-folder-open-o',
			'fa-smile-o', 'fa-frown-o', 'fa-meh-o', 'fa-gamepad', 'fa-keyboard-o', 'fa-flag-o', 'fa-flag-checkered', 'fa-terminal', 'fa-code', 'fa-mail-reply-all', 'fa-reply-all',
			'fa-star-half-empty', 'fa-star-half-full', 'fa-star-half-o', 'fa-location-arrow', 'fa-crop', 'fa-code-fork', 'fa-unlink', 'fa-chain-broken', 'fa-question', 'fa-info',
			'fa-exclamation', 'fa-superscript', 'fa-subscript', 'fa-eraser', 'fa-puzzle-piece', 'fa-microphone', 'fa-microphone-slash', 'fa-shield', 'fa-calendar-o', 'fa-fire-extinguisher',
			'fa-rocket', 'fa-maxcdn', 'fa-chevron-circle-left', 'fa-chevron-circle-right', 'fa-chevron-circle-up', 'fa-chevron-circle-down', 'fa-html5', 'fa-css3', 'fa-anchor',
			'fa-unlock-alt', 'fa-bullseye', 'fa-ellipsis-h', 'fa-ellipsis-v', 'fa-rss-square', 'fa-play-circle', 'fa-ticket', 'fa-minus-square', 'fa-minus-square-o', 'fa-level-up',
			'fa-level-down', 'fa-check-square', 'fa-pencil-square', 'fa-external-link-square', 'fa-share-square', 'fa-compass', 'fa-toggle-down', 'fa-caret-square-o-down', 'fa-toggle-up',
			'fa-caret-square-o-up', 'fa-toggle-right', 'fa-caret-square-o-right', 'fa-euro', 'fa-eur', 'fa-gbp', 'fa-dollar', 'fa-usd', 'fa-rupee', 'fa-inr', 'fa-cny', 'fa-rmb',
			'fa-yen', 'fa-jpy', 'fa-ruble', 'fa-rouble', 'fa-rub', 'fa-won', 'fa-krw', 'fa-bitcoin', 'fa-btc', 'fa-file', 'fa-file-text', 'fa-sort-alpha-asc', 'fa-sort-alpha-desc',
			'fa-sort-amount-asc', 'fa-sort-amount-desc', 'fa-sort-numeric-asc', 'fa-sort-numeric-desc', 'fa-thumbs-up', 'fa-thumbs-down', 'fa-youtube-square', 'fa-youtube', 'fa-xing',
			'fa-xing-square', 'fa-youtube-play', 'fa-dropbox', 'fa-stack-overflow', 'fa-instagram', 'fa-flickr', 'fa-adn', 'fa-bitbucket', 'fa-bitbucket-square', 'fa-tumblr',
			'fa-tumblr-square', 'fa-long-arrow-down', 'fa-long-arrow-up', 'fa-long-arrow-left', 'fa-long-arrow-right', 'fa-apple', 'fa-windows', 'fa-android', 'fa-linux',
			'fa-dribbble', 'fa-skype', 'fa-foursquare', 'fa-trello', 'fa-female', 'fa-male', 'fa-gittip', 'fa-gratipay', 'fa-sun-o', 'fa-moon-o', 'fa-archive', 'fa-bug',
			'fa-vk', 'fa-weibo', 'fa-renren', 'fa-pagelines', 'fa-stack-exchange', 'fa-arrow-circle-o-right', 'fa-arrow-circle-o-left', 'fa-toggle-left', 'fa-caret-square-o-left',
			'fa-dot-circle-o', 'fa-wheelchair', 'fa-vimeo-square', 'fa-turkish-lira', 'fa-try', 'fa-plus-square-o', 'fa-space-shuttle', 'fa-slack', 'fa-envelope-square',
			'fa-wordpress', 'fa-openid', 'fa-institution', 'fa-bank', 'fa-university', 'fa-mortar-board', 'fa-graduation-cap', 'fa-yahoo', 'fa-google', 'fa-reddit', 'fa-reddit-square',
			'fa-stumbleupon-circle', 'fa-stumbleupon', 'fa-delicious', 'fa-digg', 'fa-pied-piper', 'fa-pied-piper-alt', 'fa-drupal', 'fa-joomla', 'fa-language', 'fa-fax',
			'fa-building', 'fa-child', 'fa-paw', 'fa-spoon', 'fa-cube', 'fa-cubes', 'fa-behance', 'fa-behance-square', 'fa-steam', 'fa-steam-square', 'fa-recycle', 'fa-automobile',
			'fa-car', 'fa-cab', 'fa-taxi', 'fa-tree', 'fa-spotify', 'fa-deviantart', 'fa-soundcloud', 'fa-database', 'fa-file-pdf-o', 'fa-file-word-o', 'fa-file-excel-o',
			'fa-file-powerpoint-o', 'fa-file-photo-o', 'fa-file-picture-o', 'fa-file-image-o', 'fa-file-zip-o', 'fa-file-archive-o', 'fa-file-sound-o', 'fa-file-audio-o',
			'fa-file-movie-o', 'fa-file-video-o', 'fa-file-code-o', 'fa-vine', 'fa-codepen', 'fa-jsfiddle', 'fa-life-bouy', 'fa-life-buoy', 'fa-life-saver', 'fa-support',
			'fa-life-ring', 'fa-circle-o-notch', 'fa-ra', 'fa-rebel', 'fa-ge', 'fa-empire', 'fa-git-square', 'fa-git', 'fa-y-combinator-square', 'fa-yc-square', 'fa-hacker-news',
			'fa-tencent-weibo', 'fa-qq', 'fa-wechat', 'fa-weixin', 'fa-send', 'fa-paper-plane', 'fa-send-o', 'fa-paper-plane-o', 'fa-history', 'fa-circle-thin', 'fa-header',
			'fa-paragraph', 'fa-sliders', 'fa-share-alt', 'fa-share-alt-square', 'fa-bomb', 'fa-soccer-ball-o', 'fa-futbol-o', 'fa-tty', 'fa-binoculars', 'fa-plug', 'fa-slideshare',
			'fa-twitch', 'fa-yelp', 'fa-newspaper-o', 'fa-wifi', 'fa-calculator', 'fa-paypal', 'fa-google-wallet', 'fa-cc-visa', 'fa-cc-mastercard', 'fa-cc-discover', 'fa-cc-amex',
			'fa-cc-paypal', 'fa-cc-stripe', 'fa-bell-slash', 'fa-bell-slash-o', 'fa-trash', 'fa-copyright', 'fa-at', 'fa-eyedropper', 'fa-paint-brush', 'fa-birthday-cake', 'fa-area-chart',
			'fa-pie-chart', 'fa-line-chart', 'fa-lastfm', 'fa-lastfm-square', 'fa-toggle-off', 'fa-toggle-on', 'fa-bicycle', 'fa-bus', 'fa-ioxhost', 'fa-angellist', 'fa-cc', 'fa-shekel',
			'fa-sheqel', 'fa-ils', 'fa-meanpath', 'fa-buysellads', 'fa-connectdevelop', 'fa-dashcube', 'fa-forumbee', 'fa-leanpub', 'fa-sellsy', 'fa-shirtsinbulk', 'fa-simplybuilt',
			'fa-skyatlas', 'fa-cart-plus', 'fa-cart-arrow-down', 'fa-diamond', 'fa-ship', 'fa-user-secret', 'fa-motorcycle', 'fa-street-view', 'fa-heartbeat', 'fa-venus', 'fa-mars',
			'fa-mercury', 'fa-intersex', 'fa-transgender', 'fa-transgender-alt', 'fa-venus-double', 'fa-mars-double', 'fa-venus-mars', 'fa-mars-stroke', 'fa-mars-stroke-v', 'fa-mars-stroke-h',
			'fa-neuter', 'fa-genderless', 'fa-facebook-official', 'fa-pinterest-p', 'fa-whatsapp', 'fa-server', 'fa-user-plus', 'fa-user-times', 'fa-hotel', 'fa-bed', 'fa-viacoin', 'fa-train',
			'fa-subway', 'fa-medium', 'fa-yc', 'fa-y-combinator', 'fa-optin-monster', 'fa-opencart', 'fa-expeditedssl', 'fa-battery-4', 'fa-battery-full', 'fa-battery-3',
			'fa-battery-three-quarters', 'fa-battery-2', 'fa-battery-half', 'fa-battery-1', 'fa-battery-quarter', 'fa-battery-0', 'fa-battery-empty', 'fa-mouse-pointer', 'fa-i-cursor',
			'fa-object-group', 'fa-object-ungroup', 'fa-sticky-note', 'fa-sticky-note-o', 'fa-cc-jcb', 'fa-cc-diners-club', 'fa-clone', 'fa-balance-scale', 'fa-hourglass-o', 'fa-hourglass-1',
			'fa-hourglass-start', 'fa-hourglass-2', 'fa-hourglass-half', 'fa-hourglass-3', 'fa-hourglass-end', 'fa-hourglass', 'fa-hand-grab-o', 'fa-hand-rock-o', 'fa-hand-stop-o',
			'fa-hand-paper-o', 'fa-hand-scissors-o', 'fa-hand-lizard-o', 'fa-hand-spock-o', 'fa-hand-pointer-o', 'fa-hand-peace-o', 'fa-trademark', 'fa-registered', 'fa-creative-commons',
			'fa-gg', 'fa-gg-circle', 'fa-tripadvisor', 'fa-odnoklassniki', 'fa-odnoklassniki-square', 'fa-get-pocket', 'fa-wikipedia-w', 'fa-safari', 'fa-chrome', 'fa-firefox',
			'fa-opera', 'fa-internet-explorer', 'fa-tv', 'fa-television', 'fa-contao', 'fa-500px', 'fa-amazon', 'fa-calendar-plus-o', 'fa-calendar-minus-o', 'fa-calendar-times-o',
			'fa-calendar-check-o', 'fa-industry', 'fa-map-pin', 'fa-map-signs', 'fa-map-o', 'fa-map', 'fa-commenting', 'fa-commenting-o', 'fa-houzz', 'fa-vimeo', 'fa-black-tie',
			'fa-fonticons', 'fa-reddit-alien', 'fa-edge', 'fa-credit-card-alt', 'fa-codiepie', 'fa-modx', 'fa-fort-awesome', 'fa-usb', 'fa-product-hunt', 'fa-mixcloud', 'fa-scribd',
			'fa-pause-circle', 'fa-pause-circle-o', 'fa-stop-circle', 'fa-stop-circle-o', 'fa-shopping-bag', 'fa-shopping-basket', 'fa-hashtag', 'fa-bluetooth', 'fa-bluetooth-b',
			'fa-percent', 'fa-gitlab', 'fa-wpbeginner', 'fa-wpforms', 'fa-envira', 'fa-universal-access', 'fa-wheelchair-alt', 'fa-question-circle-o', 'fa-blind', 'fa-audio-description',
			'fa-volume-control-phone', 'fa-braille', 'fa-assistive-listening-systems', 'fa-asl-interpreting', 'fa-american-sign-language-interpreting', 'fa-deafness', 'fa-hard-of-hearing',
			'fa-deaf', 'fa-glide', 'fa-glide-g', 'fa-signing', 'fa-sign-language', 'fa-low-vision', 'fa-viadeo', 'fa-viadeo-square', 'fa-snapchat', 'fa-snapchat-ghost', 'fa-snapchat-square'
		),

		'icomoon' => array(
			'icon-mobile', 'icon-laptop', 'icon-desktop', 'icon-tablet', 'icon-phone', 'icon-document', 'icon-documents', 'icon-search', 'icon-clipboard', 'icon-newspaper','icon-notebook', 'icon-book-open', 'icon-browser', 'icon-tablet', 'icon-calendar', 'icon-presentation', 'icon-picture', 'icon-pictures', 'icon-video', 'icon-camera','icon-printer', 'icon-toolbox', 'icon-briefcase', 'icon-wallet', 'icon-gift', 'icon-bargraph', 'icon-grid', 'icon-expand', 'icon-focus', 'icon-edit','icon-adjustments', 'icon-ribbon', 'icon-hourglass', 'icon-lock', 'icon-megaphone', 'icon-shield', 'icon-trophy', 'icon-flag', 'icon-map', 'icon-puzzle','icon-basket', 'icon-envelope', 'icon-streetsign', 'icon-telescope', 'icon-gears', 'icon-key', 'icon-paperclip', 'icon-attachment', 'icon-pricetags', 'icon-lightbulb','icon-layers', 'icon-pencil', 'icon-tools', 'icon-tools-2', 'icon-scissors', 'icon-paintbrush', 'icon-magnifying-glass', 'icon-circle-compass', 'icon-linegraph', 'icon-mic','icon-strategy', 'icon-beaker', 'icon-caution', 'icon-recycle', 'icon-anchor', 'icon-profile-male', 'icon-profile-female', 'icon-bike', 'icon-wine', 'icon-hotairballoon','icon-piechart', 'icon-genius', 'icon-map-pin', 'icon-dial', 'icon-chat', 'icon-heart', 'icon-cloud', 'icon-upload', 'icon-download', 'icon-target', 'icon-hazardous','icon-globe', 'icon-speedometer', 'icon-global', 'icon-compass', 'icon-lifesaver', 'icon-clock', 'icon-aperture', 'icon-quote', 'icon-scope', 'icon-alarmclock', 'icon-refresh','icon-happy', 'icon-sad', 'icon-map-pin', 'icon-dial', 'icon-chat', 'icon-heart', 'icon-cloud','icon-globe', 'icon-genius', 'icon-facebook', 'icon-twitter', 'icon-googleplus', 'icon-rss', 'icon-tumblr', 'icon-linkedin', 'icon-dribbble', 'icon-times', 'icon-tick','icon-plus', 'icon-minus', 'icon-divide', 'icon-chevron-right', 'icon-chevron-left', 'icon-arrow-right-thick', 'icon-arrow-left-thick','icon-th-small', 'icon-arrow-forward', 'icon-arrow-back', 'icon-rss2','icon-location', 'icon-link', 'icon-image', 'icon-arrow-up-thick', 'icon-arrow-down-thick', 'icon-starburst', 'icon-starburst-outline','icon-star', 'icon-flow-children', 'icon-export', 'icon-delete','icon-delete-outline', 'icon-cloud-storage', 'icon-wi-fi', 'icon-heart2', 'icon-flash', 'icon-cancel', 'icon-backspace','icon-attachment2', 'icon-arrow-move', 'icon-warning', 'icon-user','icon-radar', 'icon-lock-open', 'icon-lock-closed', 'icon-location-arrow', 'icon-user-delete', 'icon-user-add', 'icon-media-pause','icon-group', 'icon-chart-pie', 'icon-chart-line', 'icon-chart-bar', 'icon-chart-area', 'icon-video2', 'icon-point-of-interest', 'icon-infinity', 'icon-globe2', 'icon-eye', 'icon-cog','icon-camera2', 'icon-upload2', 'icon-scissors2', 'icon-refresh2', 'icon-pin', 'icon-key2', 'icon-info-large','icon-eject', 'icon-download2', 'icon-zoom', 'icon-zoom-out','icon-zoom-in', 'icon-sort-numerically', 'icon-sort-alphabetically', 'icon-input-checked', 'icon-calender', 'icon-world', 'icon-notes','icon-code', 'icon-arrow-sync', 'icon-arrow-shuffle', 'icon-arrow-minimise','icon-arrow-maximise','icon-arrow-loop','icon-anchor2','icon-spanner','icon-puzzle2','icon-power','icon-plane','icon-pi','icon-phone2', 'icon-microphone','icon-media-rewind','icon-flag2','icon-adjust-brightness','icon-waves','icon-social-twitter','icon-social-facebook','icon-social-dribbble','icon-media-stop','icon-media-record','icon-media-play','icon-media-fast-forward','icon- icon-media-eject', 'icon-social-vimeo','icon-social-tumbler','icon-social-skype','icon-social-pinterest','icon-social-linkedin','icon-social-last-fm','icon-social-github','icon-social-flickr','icon-at','icon-times-outline','icon-minus-outline','icon-tick-outline','icon-th-large-outline','icon-equals-outline','icon-divide-outline','icon-chevron-right-outline', 'icon-chevron-left-outline','icon-arrow-right-outline','icon-arrow-left-outline','icon-th-small-outline','icon-th-menu-outline','icon-th-list-outline','icon-news','icon-home-outline','icon-arrow-up-outline','icon-arrow-forward-outline','icon-arrow-down-outline','icon-arrow-back-outline','icon-trash','icon-rss-outline','icon-message','icon-location-outline','icon-link-outline','icon-image-outline','icon-export-outline','icon-cross','icon-wi-fi-outline','icon-star-outline','icon-media-pause-outline','icon-mail','icon-heart-outline','icon-flash-outline','icon-cancel-outline','icon-beaker2', 'icon-arrow-move-outline','icon-watch','icon-warning-outline','icon-time','icon-radar-outline','icon-lock-open-outline','icon-location-arrow-outline','icon-info-outline','icon-backspace-outline','icon-attachment-outline','icon-user-outline','icon-user-delete-outline','icon-user-add-outline','icon-lock-closed-outline','icon-group-outline','icon-chart-pie-outline','icon-chart-line-outline','icon-chart-bar-outline','icon-chart-area-outline','icon-video-outline','icon-point-of-interest-outline','icon-map2','icon-key-outline','icon-infinity-outline','icon-globe-outline','icon-eye-outline','icon-cog-outline','icon-camera-outline','icon-upload-outline','icon-support','icon-scissors-outline','icon-refresh-outline','icon-info-large-outline','icon-eject-outline','icon-download-outline','icon-battery-mid','icon-battery-low','icon-battery-high','icon-zoom-outline','icon-zoom-out-outline','icon-zoom-in-outline','icon-tag','icon-tabs-outline','icon-pin-outline','icon-message-typing','icon-directions','icon-battery-full','icon-battery-charge','icon-pipette','icon-pencil2','icon-folder','icon-folder-delete','icon-folder-add','icon-edit2','icon-document-delete','icon-document-add','icon-brush','icon-thumbs-up','icon-thumbs-down','icon-pen','icon-sort-numerically-outline','icon-sort-alphabetically-outline','icon-social-last-fm-circular','icon-social-github-circular','icon-compass2','icon-bookmark','icon-input-checked-outline','icon-code-outline','icon-calender-outline','icon-business-card','icon-arrow-up','icon-arrow-sync-outline','icon-arrow-right','icon-arrow-repeat-outline','icon-arrow-loop-outline','icon-arrow-left','icon-flow-switch','icon-flow-parallel','icon-flow-merge','icon-document-text','icon-clipboard2','icon-calculator','icon-arrow-minimise-outline','icon-arrow-maximise-outline','icon-arrow-down','icon-gift2','icon-film','icon-database','icon-bell','icon-anchor-outline','icon-adjust-contrast','icon-world-outline','icon-shopping-bag','icon-power-outline','icon-notes-outline','icon-device-tablet','icon-device-phone','icon-device-laptop','icon-device-desktop','icon-briefcase2','icon-spanner-outline','icon-puzzle-outline','icon-printer2','icon-pi-outline','icon-lightbulb2','icon-flag-outline','icon-contacts','icon-archive','icon-weather-stormy','icon-weather-shower','icon-weather-partly-sunny','icon-weather-downpour','icon-weather-cloudy','icon-plane-outline','icon-phone-outline','icon-microphone-outline', 'icon-weather-windy','icon-weather-windy-cloudy','icon-weather-sunny','icon-weather-snow','icon-weather-night','icon-media-stop-outline','icon-media-rewind-outline','icon-media-record-outline','icon-media-play-outline','icon-media-fast-forward-outline','icon-media-eject-outline','icon-wine2','icon-waves-outline','icon-ticket','icon-tags','icon-plug','icon-headphones','icon-credit-card','icon-coffee','icon-book','icon-beer','icon-volume','icon-volume-up','icon-volume-mute', 'icon-volume-down','icon-social-vimeo-circular','icon-social-twitter-circular','icon-social-pinterest-circular','icon-social-linkedin-circular','icon-social-facebook-circular','icon-social-dribbble-circular','icon-tree','icon-thermometer','icon-social-tumbler-circular','icon-social-skype-outline','icon-social-flickr-circular','icon-social-at-circular','icon-shopping-cart','icon-messages','icon-leaf','icon-feather'
		)

	);
}

/**
 * Returns the HTML for the icon selector
 *
 * @return  string
 */
function tcs_render_icon_selector()
{
	$icons = tcs_get_icons();
	$output = '<div class="tcas-icon-selector">';

	$output .= '<div class="tcas-icon-selector-search"><input placeholder="' . esc_attr__('Search', 'react-shortcodes') . '"><span>&times;</span></div>';

	$output .= '<div class="tcas-icon-selector-title tcas-icon-subset-fa">' . esc_html__('FontAwesome Icons', 'react-shortcodes') . '</div>';

	foreach ($icons['fontawesome'] as $icon) {
		$output .= '<div class="tcas-icon-option tcas-icon-subset-fa">';
		$output .= '<span title="' . esc_attr(ucfirst(str_replace('-', ' ', preg_replace('/^fa\-/', '', $icon)))) . '" data-icon="' . esc_attr($icon) . '" class="' . esc_attr(tcs_sanitize_class('fa ' . $icon)) . '"></span>';
		$output .= '</div>';
	}

	$output .= '<div class="tcas-icon-selector-title tcas-icon-subset-mix">' . esc_html__('Mixed Icons', 'react-shortcodes') . '</div>';

	foreach ($icons['icomoon'] as $icon) {
		$output .= '<div class="tcas-icon-option tcas-icon-subset-mix">';
		$output .= '<span title="' . esc_attr(ucfirst(str_replace('-', ' ', preg_replace('/^icon\-/', '', $icon)))) . '" data-icon="' . esc_attr($icon) . '" class="' . esc_attr(tcs_sanitize_class('mix-ico ' . $icon)) . '"></span>';
		$output .= '</div>';
	}

	$output .= '<div class="tcas-icon-selector-title tcas-icon-subset-is">' . esc_html__('Image Icons', 'react-shortcodes') . '</div>';

	foreach ($icons['iconsprite'] as $icon) {
		$output .= '<div class="tcas-icon-option tcas-icon-subset-is">';
		$output .= '<span title="' . esc_attr(ucfirst(str_replace('-', ' ', $icon))) . '" data-icon="' . esc_attr($icon) . '" class="' . esc_attr(tcs_sanitize_class('sml iconsprite ' . $icon)) . '"></span>';
		$output .= '</div>';
	}

	$output .= '</div>';

	return $output;
}

/**
 * Returns the HTML for the icon selector field
 *
 * @param  string  $selectedIcon  The selected icon
 * @param  string  $key           The name of the field
 * @param  string  $id            The ID of the field
 * @param  string  $subset        Subset of icons to show ('is' or 'fa')
 * @return string                 The field HTML
 */
function tcs_icon_selector_field($selectedIcon, $key = '', $id = '', $subset = '')
{
	$output = '<input ' . ($id ? 'id="' . esc_attr($id) . '"' : '') .  'class="tcas-icon-selector-hidden" type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($selectedIcon) . '" />
		<div class="tcas-icon-selector-current tcas-clearfix">';
	if ($selectedIcon) {
		$output .= '<span class="' . esc_attr(tcs_sanitize_class('tcas-chosen-icon ' . tcs_get_icon_classes($selectedIcon))) . '"></span>';
	} else {
		$output .= '<span class="tcas-chosen-icon tcas-no-icon">' . esc_html__('No icon selected', 'react-shortcodes') . '</span>';
	}

	if ($subset) {
		$subset = ' tcas-only-subset-' . $subset;
	}

	$output .= '<a class="' . esc_attr(tcs_sanitize_class('tcas-button tcas-orange tcas-icon-select-trigger ' . $subset)) . '">' . esc_html__('Choose Icon', 'react-shortcodes') . '</a>';
	$output .= '<span class="' . esc_attr(tcs_sanitize_class('tcas-choose-no-icon' . ($selectedIcon ? '' : ' tcas-hidden'))) . '">' . esc_html__('Clear', 'react-shortcodes') . '</span>';
	$output .= '</div>';
	return $output;
}

/**
 * Add the Settings link to the WP menu
 */
function tcs_admin_menu()
{
	add_options_page(
		__('Shortcode Settings', 'react-shortcodes'),
		esc_html__('React Shortcodes', 'react-shortcodes'),
		'edit_theme_options',
		'tcs_settings',
		'tcs_settings'
	);
}
add_action('admin_menu', 'tcs_admin_menu');


/**
 * Display the Settings page
 */
function tcs_settings()
{
	require_once TCS_ADMIN_INCLUDES_DIR . '/settings.php';
}

/**
 * Handle the Ajax call to save the settings
 */
function tcs_save_settings_ajax()
{
	if (!isset($_POST['options']) || !is_array($_POST['options'])) {
		wp_send_json(array('type' => 'error', 'message' => 'Bad request'));
	}

	if (!current_user_can('edit_theme_options')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('tcs_save_settings', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	$new = stripslashes_deep($_POST['options']);
	$defaults = tcs_get_default_options();

	$options = array(
		// Performance settings
		'load_scripts' => isset($new['tcas_load_scripts']) ? sanitize_text_field($new['tcas_load_scripts']) : $defaults['load_scripts'],
		'load_scripts_custom' => isset($new['tcas_load_scripts_custom']) && is_array($new['tcas_load_scripts_custom']) ? array_map('absint', $new['tcas_load_scripts_custom']) : $defaults['load_scripts_custom'],

		// Disable script output
		'disabled_styles' => isset($new['tcas_disabled_styles']) && is_array($new['tcas_disabled_styles']) ? array_map('sanitize_text_field', $new['tcas_disabled_styles']) : $defaults['disabled_styles'],
		'disabled_scripts' => isset($new['tcas_disabled_scripts']) && is_array($new['tcas_disabled_scripts']) ? array_map('sanitize_text_field', $new['tcas_disabled_scripts']) : $defaults['disabled_scripts']
	);

	update_option(TCS_OPTIONS_KEY, $options);

	wp_send_json(array(
		'type' => 'success'
	));
}
add_action('wp_ajax_tcs_save_settings_ajax', 'tcs_save_settings_ajax');

/**
 * Handle the Ajax call to reset the settings
 */
function tcs_reset_settings_ajax()
{
	if (!current_user_can('edit_theme_options')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('tcs_reset_settings', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	update_option(TCS_OPTIONS_KEY, tcs_get_default_options());

	wp_send_json(array(
		'type' => 'success'
	));
}
add_action('wp_ajax_tcs_reset_settings_ajax', 'tcs_reset_settings_ajax');