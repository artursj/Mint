<?php
// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>
<div class="tcas-shortcode-outer">
	<form id="tcas-shortcode-form">
		<input type="submit" class="tcas-hidden" />
		<h3 class="tcas-main-head"><?php esc_html_e('Shortcode generator', 'react-shortcodes'); ?></h3>
		<div class="tcas-shortcode-inner">
			<div class="tcas-type-select-wrap tcas-clearfix">
				<select id="tcas-type-select" name="tcas-type-select">
					<option value=""><?php esc_html_e('Insert a new shortcode', 'react-shortcodes'); ?></option>
					<option value="accordion"><?php esc_html_e('Accordion', 'react-shortcodes'); ?></option>
					<option value="animated_number"><?php esc_html_e('Animated Number', 'react-shortcodes'); ?></option>
					<option value="animated_progress"><?php esc_html_e('Animated Progress Bar', 'react-shortcodes'); ?></option>
					<option value="block"><?php esc_html_e('Block', 'react-shortcodes'); ?></option>
					<option value="blockquote"><?php esc_html_e('Blockquote', 'react-shortcodes'); ?></option>
					<option value="box"><?php esc_html_e('Box', 'react-shortcodes'); ?></option>
					<option value="button"><?php esc_html_e('Button', 'react-shortcodes'); ?></option>
					<option value="row"><?php esc_html_e('Column Layout', 'react-shortcodes'); ?></option>
					<option value="cycle"><?php esc_html_e('Cycle', 'react-shortcodes'); ?></option>
					<option value="dropcap"><?php esc_html_e('Dropcap', 'react-shortcodes'); ?></option>
					<option value="fancy_header"><?php esc_html_e('Fancy Header', 'react-shortcodes'); ?></option>
					<option value="fixed"><?php esc_html_e('Fixed', 'react-shortcodes'); ?></option>
					<option value="flag"><?php esc_html_e('Flag', 'react-shortcodes'); ?></option>
					<option value="icon"><?php esc_html_e('Icon', 'react-shortcodes'); ?></option>
					<option value="image"><?php esc_html_e('Image', 'react-shortcodes'); ?></option>
					<option value="image_carousel"><?php esc_html_e('Image Carousel', 'react-shortcodes'); ?></option>
					<option value="impact_header"><?php esc_html_e('Impact Header', 'react-shortcodes'); ?></option>
					<option value="lightbox"><?php esc_html_e('Lightbox Popup', 'react-shortcodes'); ?></option>
					<option value="list"><?php esc_html_e('List', 'react-shortcodes'); ?></option>
					<option value="menu"><?php esc_html_e('Menu', 'react-shortcodes'); ?></option>
					<option value="opening_times"><?php esc_html_e('Opening Times', 'react-shortcodes'); ?></option>
					<option value="pullquote"><?php esc_html_e('Pullquote', 'react-shortcodes'); ?></option>
					<option value="section_break"><?php esc_html_e('Section Break', 'react-shortcodes'); ?></option>
					<option value="fancy_table"><?php esc_html_e('Table', 'react-shortcodes'); ?></option>
					<option value="tabs"><?php esc_html_e('Tabs', 'react-shortcodes'); ?></option>
					<option value="toggle"><?php esc_html_e('Toggle', 'react-shortcodes'); ?></option>
				</select>
				<div class="tcas-edit-button-wrap"><button id="tcas-edit-button" class="tcas-button tcas-grey" type="button"><i class="fa fa-pencil"></i> <?php esc_html_e('Edit existing shortcode', 'react-shortcodes'); ?></button></div>
			</div>

			<div id="tcas-popular">
				<div class="tcas-options-icons-heading">
				<h3><?php esc_html_e('Popular', 'react-shortcodes'); ?></h3>
				<div class="tcas-options-icons-wrap tcas-clearfix">
					<a data-sc="button" class="tcas-options-icon button-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Button', 'react-shortcodes'); ?></span></a>
					<a data-sc="image" class="tcas-options-icon image-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Image', 'react-shortcodes'); ?></span></a>
					<a data-sc="block" class="tcas-options-icon block-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Block', 'react-shortcodes'); ?></span></a>
					<a data-sc="fancy_header" class="tcas-options-icon heading-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Fancy Header', 'react-shortcodes'); ?></span></a>
					<a data-sc="menu" class="tcas-options-icon menus-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Menu', 'react-shortcodes'); ?></span></a>
					<a data-sc="impact_header" class="tcas-options-icon impact-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Impact Header', 'react-shortcodes'); ?></span></a>
					<a data-sc="accordion" class="tcas-options-icon accordion-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Toggle', 'react-shortcodes'); ?></span></a>
					<a data-sc="tabs" class="tcas-options-icon tabs-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Tabs', 'react-shortcodes'); ?></span></a>
					<a data-sc="opening_times" class="tcas-options-icon opening-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Opening Times', 'react-shortcodes'); ?></span></a>
					<a data-sc="image_carousel" class="tcas-options-icon carousel-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Image Carousel', 'react-shortcodes'); ?></span></a>
					<a data-sc="box" class="tcas-options-icon boxes-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Box', 'react-shortcodes'); ?></span></a>
					<a data-sc="lightbox" class="tcas-options-icon popup-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Lightbox Popup', 'react-shortcodes'); ?></span></a>
					<a data-sc="icon" class="tcas-options-icon icon-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Icon', 'react-shortcodes'); ?></span></a>
					<a data-sc="section_break" class="tcas-options-icon section-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Section Break', 'react-shortcodes'); ?></span></a>
					<a data-sc="animated_number" class="tcas-options-icon number-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Animated Number', 'react-shortcodes'); ?></span></a>
					<a data-sc="blockquote" class="tcas-options-icon quote-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Blockquote', 'react-shortcodes'); ?></span></a>
					<a data-sc="row" class="tcas-options-icon columns-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Column Layout', 'react-shortcodes'); ?></span></a>
					<a data-sc="cycle" class="tcas-options-icon cycle-sc tcas-tooltip"><span class="tcas-tooltip-text"><?php esc_html_e('Cycle', 'react-shortcodes'); ?></span></a>
				</div>
				</div>
			</div>

			<div id="tcas-edit-wrap">
				<p><?php esc_html_e('Paste a shortcode in the box below and click Edit.', 'react-shortcodes'); ?></p>

				<textarea id="tcas-edit-sc"></textarea>
				<button id="tcas-edit-load-button" class="tcas-button tcas-blue"><?php esc_html_e('Edit', 'react-shortcodes'); ?></button>
				<div class="tcas-edit-help">
					<h4><?php esc_html_e('Please note:', 'react-shortcodes'); ?></h4>
					<ul class="tcas-list">
					<li><?php esc_html_e('After adding the edited Shortcode ensure the closing tag has not been added twice.', 'react-shortcodes'); ?></li>
					<li><?php esc_html_e('You must remove the number on nested items before editing.', 'react-shortcodes'); ?></li>
					<li><?php esc_html_e('You may need to remove Shortcode content prior to editing.', 'react-shortcodes'); ?></li>
					</ul>

				</div>
			</div>
			<div id="tcas-options-row" class="tcas-options">
				<div class="tcas-sc-var-select-wrap">
					<label><?php esc_html_e('Variation', 'react-shortcodes'); ?>
						<select id="tcas-select-layout">
							<?php echo tcs_render_column_layout_options('33-33-33'); ?>
						</select>
					</label>
				</div>
				<?php tcs_render_shortcode_row_options(); ?>
				<div class="tcas-sc-option">
					<?php for ($i = 1; $i <= 5; $i++) : ?>
						<div id="tcas-layout-content-wrap-<?php echo esc_attr($i); ?>" class="tcas-layout-content-wrap">
							<label id="tcas-sc-layout-content-label-<?php echo esc_attr($i); ?>" for="tcas-sc-layout-content-<?php echo esc_attr($i); ?>"><?php printf(esc_html__('Column %d content', 'react-shortcodes'), $i); ?></label>
							<textarea rows="8" cols="50" id="tcas-sc-layout-content-<?php echo esc_attr($i); ?>"></textarea>
						</div>
					<?php endfor; ?>
				</div>
			</div>
			<div id="tcas-options-blockquote" class="tcas-options">
				<?php tcs_render_shortcode_blockquote_options(); ?>
				<?php tcs_shortcode_preview_html(); ?>
			</div>
			<div id="tcas-options-pullquote" class="tcas-options">
				<?php tcs_render_shortcode_pullquote_options(); ?>
				<?php tcs_shortcode_preview_html(); ?>
			</div>
			<div id="tcas-options-box" class="tcas-options">
				<?php tcs_render_shortcode_box_options(); ?>
				<?php tcs_shortcode_preview_html(); ?>
			</div>
			<div id="tcas-options-section_break" class="tcas-options">
				<?php tcs_render_shortcode_section_break_options(); ?>
				<?php tcs_shortcode_preview_html(); ?>
			</div>
			<div id="tcas-options-button" class="tcas-options">
				<?php tcs_render_shortcode_button_options(); ?>
				<?php tcs_shortcode_preview_html(); ?>
			</div>
			<div id="tcas-options-list" class="tcas-options">
				<?php tcs_render_shortcode_list_options(); ?>
				<?php tcs_shortcode_preview_html(); ?>
			</div>
			<div id="tcas-options-menu" class="tcas-options">
				<?php tcs_render_shortcode_menu_options(); ?>
				<?php tcs_shortcode_preview_html(); ?>
			</div>
			<div id="tcas-options-fancy_table" class="tcas-options">
				<?php tcs_render_shortcode_fancy_table_options(); ?>
				<?php tcs_shortcode_preview_html(); ?>
			</div>
			<div id="tcas-options-dropcap" class="tcas-options">
				<?php tcs_render_shortcode_dropcap_options(); ?>
			</div>
			<div id="tcas-options-animated_number" class="tcas-options">
				<?php tcs_render_shortcode_animated_number_options(); ?>
			</div>
			<div id="tcas-options-animated_progress" class="tcas-options">
				<?php tcs_render_shortcode_animated_progress_options(); ?>
			</div>
			<div id="tcas-options-tabs" class="tcas-options">
				<?php tcs_render_shortcode_tabs_options(); ?>
				<div class="tcas-clearfix">
					<div id="tcas-add-tab" class="tcas-button tcas-orange tcas-add"><span></span><?php esc_html_e('Add a new tab', 'react-shortcodes'); ?></div>
				</div>
				<div id="tcas-sc-tabs-wrap">
					<?php echo tcs_get_tab_sc_pane_html(); ?>
				</div>
			</div>
			<div id="tcas-options-toggle" class="tcas-options">
				<?php tcs_render_shortcode_toggle_options(); ?>
				<div class="tcas-clearfix">
					<div id="tcas-add-toggle" class="tcas-button tcas-orange tcas-add"><span></span><?php esc_html_e('Add a new toggle', 'react-shortcodes'); ?></div>
				</div>
				<div id="tcas-sc-toggles-wrap">
					<?php echo tcs_get_accordion_pane_html(); ?>
				</div>
			</div>
			<div id="tcas-options-accordion" class="tcas-options">
				<?php tcs_render_shortcode_accordion_options(); ?>
				<div class="tcas-clearfix">
					<div id="tcas-add-accordion" class="tcas-button tcas-orange tcas-add"><span></span><?php esc_html_e('Add a new accordion toggle', 'react-shortcodes'); ?></div>
				</div>
				<div id="tcas-sc-accordions-wrap">
					<?php echo tcs_get_accordion_pane_html(); ?>
				</div>
			</div>
			<div id="tcas-options-cycle" class="tcas-options">
				<div class="tcas-clearfix">
					<div id="tcas-add-cycle" class="tcas-button tcas-orange tcas-add"><span></span><?php esc_html_e('Add a new slide', 'react-shortcodes'); ?></div>
				</div>
				<div id="tcas-sc-cycle-slides-wrap">
					<!-- If anything changes below, shortcodes.js must also be changed -->
					<div class="tcas-sc-pane">
						<div class="tcas-sc-pane-remove" title="<?php esc_attr_e('Remove slide', 'react-shortcodes'); ?>">X</div>
						<div class="tcas-sc-pane-outer tcas-clearfix">
							<div class="tcas-sc-pane-label">
								<h4><?php esc_html_e('Content', 'react-shortcodes'); ?></h4>
							</div>
							<div class="tcas-sc-pane-inner">
								<textarea></textarea>
							</div>
						</div>
					</div>
				</div>
				<?php tcs_render_shortcode_cycle_options(); ?>
			</div>
			<div id="tcas-options-image" class="tcas-options">
				<?php tcs_render_shortcode_image_options(); ?>
				<?php tcs_shortcode_preview_html(); ?>
			</div>
			<div id="tcas-options-image_carousel" class="tcas-options">
				<?php tcs_render_shortcode_image_carousel_options(); ?>
			</div>
			<div id="tcas-options-fancy_header" class="tcas-options">
				<?php tcs_render_shortcode_fancy_header_options(); ?>
				<?php tcs_shortcode_preview_html(); ?>
			</div>
			<div id="tcas-options-impact_header" class="tcas-options">
				<?php tcs_render_shortcode_impact_header_options(); ?>
				<?php tcs_shortcode_preview_html(); ?>
			</div>
			<div id="tcas-options-block" class="tcas-options">
				<?php tcs_render_shortcode_block_options(); ?>
			</div>
			<div id="tcas-options-fixed" class="tcas-options">
				<?php tcs_render_shortcode_fixed_options(); ?>
			</div>
			<div id="tcas-options-lightbox" class="tcas-options">
				<?php tcs_render_shortcode_lightbox_options(); ?>
			</div>
			<div id="tcas-options-icon" class="tcas-options">
				<?php tcs_render_shortcode_icon_options(); ?>
			</div>
			<div id="tcas-options-flag" class="tcas-options">
				<?php tcs_render_shortcode_flag_options(); ?>
			</div>
			<div id="tcas-options-opening_times" class="tcas-options">
				<?php tcs_render_shortcode_opening_times_options(); ?>
			</div>
			<div id="tcas-icon-selector-container" class="tcas-clearfix">
				<?php echo tcs_render_icon_selector(); ?>
			</div>
		</div>
		<div class="tcas-sc-insert-button-wrap tcas-clearfix">
			<a id="tcas-insert-close-shortcode" class="tcas-button tcas-blue"><?php esc_html_e('Insert & Close', 'react-shortcodes'); ?></a>
			<a id="tcas-insert-shortcode" class="tcas-button tcas-blue"><?php esc_html_e('Insert', 'react-shortcodes'); ?></a>
			<a id="tcas-close-shortcode" class="tcas-button tcas-light"><?php esc_html_e('Close', 'react-shortcodes'); ?></a>
		</div>
		<input type="hidden" name="tcas-widget-target" id="tcas-widget-target" value="<?php if (isset($_GET['widget'])) echo esc_attr($_GET['widget']); ?>" />
	</form>
</div>