<?php
// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>
<div class="tcap-shortcode-outer">
	<form id="tcap-shortcode-form">
		<input type="submit" class="tcap-hidden" />
		<h3 class="tcap-main-head"><?php esc_html_e('Portfolio generator', 'react-portfolio'); ?></h3>
		<div class="tcap-shortcode-inner">
			<div class="tcap-type-select-wrap tcap-clearfix">
				<div class="tcap-edit-button-wrap"><button id="tcap-edit-button" class="tcap-button tcap-grey" type="button"><i class="fa fa-pencil"></i> <?php esc_html_e('Edit existing shortcode', 'react-portfolio'); ?></button></div>
			</div>

			<div id="tcap-edit-wrap">
				<p><?php esc_html_e('Paste a shortcode in the box below and click Edit.', 'react-portfolio'); ?></p>
				<textarea id="tcap-edit-sc"></textarea>
				<button id="tcap-edit-load-button" class="tcap-button tcap-blue"><?php esc_html_e('Edit', 'react-portfolio'); ?></button>
				<button id="tcap-edit-cancel-button" class="tcap-button tcap-light"><?php esc_html_e('Cancel', 'react-portfolio'); ?></button>
			</div>

			<div id="tcap-options-portfolio" class="tcap-options">
				<?php tcp_render_shortcode_portfolio_options(); ?>
			</div>
		</div>
		<div class="tcap-sc-insert-button-wrap tcap-clearfix">
			<a id="tcap-insert-close-shortcode" class="tcap-button tcap-blue"><?php esc_html_e('Insert & Close', 'react-portfolio'); ?></a>
			<a id="tcap-insert-shortcode" class="tcap-button tcap-blue"><?php esc_html_e('Insert', 'react-portfolio'); ?></a>
			<a id="tcap-close-shortcode" class="tcap-button tcap-light"><?php esc_html_e('Close', 'react-portfolio'); ?></a>
		</div>
		<input type="hidden" name="tcap-widget-target" id="tcap-widget-target" value="<?php if (isset($_GET['widget'])) echo esc_attr($_GET['widget']); ?>" />
	</form>
</div>