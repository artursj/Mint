<?php
// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>
<div class="wrap">
	<h2><?php esc_html_e('Portfolio Bulk Upload', 'react-portfolio'); ?></h2>
	<noscript><p class="tcap-no-script"><span><?php esc_html_e('Please enable JavaScript to use the portfolio bulk uploader.', 'react-portfolio'); ?></span></p></noscript>
	<div id="tcap-pbu-message-wrap">
		<span>
			<span class="tcap-save-icon"></span>
			<span id="tcap-pbu-message"></span>
		</span>
	</div>
	<div class="tcap-pbu-description">
		<p><?php esc_html_e('Using this tool you can upload multiple portfolio images at once. First select if you want the portfolio items to be a Draft or Published. Click the Choose Files buttons to add files from your computer, use Ctrl+Click or Shift+Click to select multiple files. When the images have been uploaded you can set the title, content and categories. Click the Save Items button at the bottom of the page to save the data. You can edit individual items by going to Portfolio &rarr; All Items on the WordPress menu.', 'react-portfolio'); ?></p>
		<p><strong><?php esc_html_e('We recommend that uploaded portfolio images are at least 1024px wide, so that the images will fit neatly into most column layouts and on devices. Images will not be scaled up, so the larger the original image the better it will look when fit into the theme. If the original image is larger than 1920px x 1080px we recommend resizing it to this size or smaller before uploading.', 'react-portfolio'); ?></strong></p>
	</div>
	<form id="tcap-pbu-form" method="POST" enctype="multipart/form-data">
		<div class="tcap-pbu-status-wrap">
			<label class="tcap-pbu-status-label">
				<?php esc_html_e('Upload as', 'react-portfolio'); ?>
				<select id="tcap-pbu-status">
					<option value="publish"><?php esc_html_e('Published', 'react-portfolio'); ?></option>
					<option value="draft"><?php esc_html_e('Draft', 'react-portfolio'); ?></option>
				</select>
			</label>
			<span class="tcap-tip-icon"><span class="tcap-tooltip-text"><?php esc_html_e('Posts in WordPress have a status of "Published" (which are shown on the site) or "Draft" (work in progress) and some others.  Uploading images in the portfolio bulk uploader creates a portfolio item for each image, a portfolio item is also a post so it also has a status. This option lets you choose the status before you upload the image, so the created portfolio items will have the status that you choose in this field.', 'react-portfolio'); ?></span></span>
		</div>
		<div class="tcap-pbu-upload-wrap tcap-clearfix">
			<div class="tcap-button tcap-orange tcap-add tcap-pbu-upload-button"><span></span><?php esc_html_e('Choose Files', 'react-portfolio'); ?></div>
			<input id="tcap-pbu-upload" type="file" multiple name="files">
		</div>

		<div id="tcap-pbu-items"></div>

		<div id="tcap-pbu-buttons-wrap">
			<div id="tcap-pbu-clear" class="tcap-button tcap-light tcap-tooltip"><?php esc_html_e('Clear Items', 'react-portfolio'); ?><span class="tcap-tooltip-text"><?php esc_html_e('Clears the list of items, but does not delete them.', 'react-portfolio'); ?></span></div>
			<div id="tcap-pbu-save" class="tcap-button tcap-blue"><?php esc_html_e('Save Items', 'react-portfolio'); ?></div>
		</div>
	</form>
</div>