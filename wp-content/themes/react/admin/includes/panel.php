<?php
// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?><div class="wrap">
	<?php if (isset($_GET['message'])) : ?>
		<?php if ($_GET['message'] == 'reset') : ?>
			<div id="react-sucess-message" class="react-sucess-message"><p><?php esc_html_e('All options have been reset.', 'react'); ?></p></div>
		<?php elseif ($_GET['message'] == 'import') : ?>
			<div class="react-sucess-message"><p><?php esc_html_e('Import successful', 'react'); ?></p></div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( ! is_writable(REACT_CACHE_DIR)) : ?>
		<div class="react-warning-message"><p class="react-warning"><?php printf(esc_html__('The cache directory %1$s is not writable. Please make this directory writable for the theme to work properly. You may need to set the permissions of this directory to 777. %2$sFind out how%3$s.', 'react'), '<code>' . REACT_CACHE_DIR . '</code>', '<a class="react-external-link" href="http://codex.wordpress.org/Changing_File_Permissions">', '</a>'); ?></p></div>
	<?php endif; ?>
	<noscript><p class="react-no-script"><span><?php esc_html_e('Please enable JavaScript to use the theme options panel.', 'react'); ?></span></p></noscript>
	<form id="react-options-form">
		<div class="react-wrap react-clearfix">
			<input type="submit" class="react-hidden" />

			<div class="react-panel-header">
				<div class="react-logo-wrap">
					<div class="react-panel-logo"></div>
					<div class="react-header-right-top-bar">
						<div class="react-themecatcher-menu">
							<ul class="react-tc-menu">
								<li><a class="react-facebook react-tooltip react-external-link" href="http://www.facebook.com/ThemeCatcher"><span></span><span class="react-tooltip-text"><?php esc_html_e('Like us on Facebook', 'react'); ?></span></a></li>
								<li><a class="react-twitter react-tooltip react-external-link" href="http://www.twitter.com/ThemeCatcher"><span></span><span class="react-tooltip-text"><?php esc_html_e('Follow us on Twitter', 'react'); ?></span></a></li>
								<li><a class="react-tc-visit react-tooltip react-external-link" href="http://www.themecatcher.net"><span></span><span class="react-tooltip-text"><?php esc_html_e('Visit our website', 'react'); ?></span></a></li>
								<li><a class="react-support react-tooltip react-external-link" href="http://support.themecatcher.net"><span></span><span class="react-tooltip-text"><?php esc_html_e('Get support', 'react'); ?></span></a></li>
								<li><a class="react-youtube react-tooltip react-external-link" href="https://www.youtube.com/playlist?list=PLoXh1YOEJyfO4FStxGZ-FVaFMqHgCu-oz"><span></span><span class="react-tooltip-text"><?php esc_html_e('Video tutorials', 'react'); ?></span></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="react-header-right">
					<div class="react-header-right-bottom-bar">
						<div class="react-op-head">
							<a class="react-site-link react-tooltip react-external-link" href="<?php echo esc_url(home_url()); ?>"><span></span><span class="react-tooltip-text"><?php esc_html_e('View your website (in new tab)', 'react'); ?></span></a>
							<a data-width="400" data-height="600" class="react-preview-link react-preview-link-phone react-tooltip"><span></span><span class="react-tooltip-text"><?php esc_html_e('Quick preview in Phone (width - 400px)', 'react'); ?></span></a>
							<a data-width="700" data-height="450" class="react-preview-link react-preview-link-tablet react-tooltip"><span></span><span class="react-tooltip-text"><?php esc_html_e('Quick preview in Tablet (width - 700px)', 'react'); ?></span></a>
							<a data-width="1200" data-height="600" class="react-preview-link react-preview-link-desk react-tooltip"><span></span><span class="react-tooltip-text"><?php esc_html_e('Quick preview in Laptops / Desktops (width - 1200px)', 'react'); ?></span></a>
							<div id="my-content-id" style="display:none;">
								<?php include REACT_ADMIN_INCLUDES_DIR . '/theme-directions.php'; ?>
							</div>
							<a href="#TB_inline?width=600&amp;height=550&amp;inlineId=my-content-id" class="thickbox react-directions-link react-tooltip last-child"><span></span><span class="react-tooltip-text"><?php esc_html_e('Theme Directions - Learn what&#39;s what', 'react'); ?></span></a>
						</div>
						<div class="react-top-save-button-wrap">
							 <a class="react-save react-button react-blue react-save-save"><span><?php esc_html_e('Save', 'react'); ?></span></a>
						</div>
					</div>
				</div>
			</div>

			<div class="react-panel-left">
				<ul id="react-tabs-nav">
					<li id="react-design-tab" class="react-current"><span><?php esc_html_e('Design', 'react'); ?><span class="react-icon react-design"></span></span></li>
					<li><span><?php esc_html_e('Global', 'react'); ?><span class="react-icon react-global"></span></span></li>
					<li><span><?php esc_html_e('Backgrounds', 'react'); ?><span class="react-icon react-backgrounds"></span></span></li>
					<li><span><?php esc_html_e('Pages', 'react'); ?><span class="react-icon react-pages"></span></span></li>
					<li><span><?php esc_html_e('Blog', 'react'); ?><span class="react-icon react-blog"></span></span></li>
					<li><span><?php esc_html_e('Portfolio', 'react'); ?><span class="react-icon react-portfolio"></span></span></li>
					<li><span><?php esc_html_e('Components', 'react'); ?><span class="react-icon react-components"></span></span></li>
					<li><span><?php esc_html_e('Contact', 'react'); ?><span class="react-icon react-contact"></span></span></li>
					<li><span><?php esc_html_e('Advanced', 'react'); ?><span class="react-icon react-advanced"></span></span></li>
					<li><span><?php esc_html_e('Translate', 'react'); ?><span class="react-icon react-translate"></span></span></li>
				</ul>
			</div>

			<div class="react-panel-right">

				<div id="react-tabs">
					<!-- Design -->
					<div class="react-tab-0">
						<div class="react-sub-tabs-wrap">
							<ul class="react-sub-tabs-nav">
								<?php if (!$hideWelcomeTab) : ?>
									<li class="react-current" id="react-welcome-trigger"><span><?php esc_html_e('Welcome', 'react'); ?><span class="react-icon react-directions"></span></span></li>
								<?php endif; ?>
								<li<?php if ($hideWelcomeTab) echo ' class="react-current"'; ?>><span><?php esc_html_e('On / Off', 'react'); ?><span class="react-icon react-general"></span></span></li>
								<li><span><?php esc_html_e('Colors', 'react'); ?><span class="react-icon react-color"></span></span></li>
								<li><span><?php esc_html_e('Fonts', 'react'); ?><span class="react-icon react-fonts"></span></span></li>
								<li><span><?php esc_html_e('Style', 'react'); ?><span class="react-icon react-style"></span></span></li>
								<li><span><?php esc_html_e('Layout', 'react'); ?><span class="react-icon react-layout"></span></span></li>
								<li id="react-import-cs-tab"><span><?php esc_html_e('Import', 'react'); ?><span class="react-icon react-import"></span></span></li>
							</ul>
						</div>
						<div class="react-sub-tabs">

							<?php if (!$hideWelcomeTab) : ?>
								<div id="react-welcome-tab" class="react-sub-tab">
									<div class="react-welcome-hide">
										<a class="react-button react-light react-tooltip">Hide<span class="react-tooltip-text"><?php esc_html_e('Permanently Hide Welcome Page', 'react'); ?></span></a>
										<p><?php echo sprintf(esc_html__('You can access this section again by clicking the %s icon at the top of the options panel.', 'react'), ''); ?></p>
									</div>
									<div class="react-clearfix react-welcome-note">
										<div class="react-welcome-heading react-clearfix">
											<h2><?php esc_html_e('Welcome to the React options!', 'react'); ?></h2>
											<p class="react-panel-welcome-desc"><?php esc_html_e("You've made a great decision to purchase React and you've found your way here too &mdash; give yourself a pat on the back. Now the fun begins!", 'react'); ?></p>
											<div class="react-clearfix"><a class="react-button react-green react-external-link" href="http://support.themecatcher.net/react-wordpress/getting-started/using-the-theme"><?php esc_html_e('Using the theme', 'react'); ?></a> <a id="react-download-cs" class="react-button react-green"><?php esc_html_e('Install a design', 'react'); ?></a></div>
										</div>
									</div>
									<div class="react-clearfix react-direction-wrap">
										<?php include REACT_ADMIN_INCLUDES_DIR . '/theme-directions.php'; ?>
									</div>
								</div>

							<?php endif; ?>

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Choose which elements to show on your site', 'react'); ?></h2>

								<!-- ON / OFF Pop Down-->
								<table class="react-form-table react-tab-0-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Pop Down', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Switch Pop Down section on or off', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row react-on-off react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="show_popdown_desktop" class="react-mini-label"><?php esc_html_e('Laptops / Desktops', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_popdown_desktop" id="show_popdown_desktop" <?php checked(true, $react['options']['show_popdown_desktop']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_popdown_phone" class="react-mini-label"><?php esc_html_e('Phones', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_popdown_phone" id="show_popdown_phone" <?php checked(true, $react['options']['show_popdown_phone']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_popdown_tablet" class="react-mini-label"><?php esc_html_e('Tablets', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_popdown_tablet" id="show_popdown_tablet" <?php checked(true, $react['options']['show_popdown_tablet']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_popdown_large" class="react-mini-label"><?php esc_html_e('Large screens', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_popdown_large" id="show_popdown_large" <?php checked(true, $react['options']['show_popdown_large']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Would you like to display the Pop Down and for which devices should it be visible?', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<!-- Show if Pop Down off -->
								<div class="only_for_popdown"><p class="react-warning"><?php esc_html_e('Pop Down is Off', 'react'); ?></p></div>

								<!-- ON / OFF TopHead-->
								<table class="react-form-table react-tab-0-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Top Header', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Switch Top Header section on or off', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row react-on-off react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="show_tophead_desktop" class="react-mini-label"><?php esc_html_e('Laptops / Desktops', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_tophead_desktop" id="show_tophead_desktop" <?php checked(true, $react['options']['show_tophead_desktop']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_tophead_phone" class="react-mini-label"><?php esc_html_e('Phones', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_tophead_phone" id="show_tophead_phone" <?php checked(true, $react['options']['show_tophead_phone']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_tophead_tablet" class="react-mini-label"><?php esc_html_e('Tablets', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_tophead_tablet" id="show_tophead_tablet" <?php checked(true, $react['options']['show_tophead_tablet']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_tophead_large" class="react-mini-label"><?php esc_html_e('Large screens', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_tophead_large" id="show_tophead_large" <?php checked(true, $react['options']['show_tophead_large']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Would you like to display the Top Header and for which devices should it be visible?', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<!-- Show if TopHead off -->
								<div class="only_for_tophead"><p class="react-warning"><?php esc_html_e('Top Header is Off', 'react'); ?></p></div>

								<!-- ON / OFF InfoMenu-->
								<table class="react-form-table react-tab-0-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Info Menu', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Switch Info Menu section on or off', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row react-on-off react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="show_infomenu_desktop" class="react-mini-label"><?php esc_html_e('Laptops / Desktops', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_infomenu_desktop" id="show_infomenu_desktop" <?php checked(true, $react['options']['show_infomenu_desktop']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_infomenu_phone" class="react-mini-label"><?php esc_html_e('Phones', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_infomenu_phone" id="show_infomenu_phone" <?php checked(true, $react['options']['show_infomenu_phone']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_infomenu_tablet" class="react-mini-label"><?php esc_html_e('Tablets', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_infomenu_tablet" id="show_infomenu_tablet" <?php checked(true, $react['options']['show_infomenu_tablet']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_infomenu_large" class="react-mini-label"><?php esc_html_e('Large screens', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_infomenu_large" id="show_infomenu_large" <?php checked(true, $react['options']['show_infomenu_large']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Would you like to display the Info Menu and for which devices should it be visible?', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<!-- Show if InfoMenu off -->
								<div class="only_for_infomenu"><p class="react-warning"><?php esc_html_e('Info Menu is Off', 'react'); ?></p></div>

							   <!-- ON / OFF SoloNav-->
								<table class="react-form-table react-tab-0-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Solo Nav', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Switch Solo Navigation section on or off', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row react-on-off react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="show_solonav_desktop" class="react-mini-label"><?php esc_html_e('Laptops / Desktops', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_solonav_desktop" id="show_solonav_desktop" <?php checked(true, $react['options']['show_solonav_desktop']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_solonav_phone" class="react-mini-label"><?php esc_html_e('Phones', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_solonav_phone" id="show_solonav_phone" <?php checked(true, $react['options']['show_solonav_phone']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_solonav_tablet" class="react-mini-label"><?php esc_html_e('Tablets', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_solonav_tablet" id="show_solonav_tablet" <?php checked(true, $react['options']['show_solonav_tablet']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_solonav_large" class="react-mini-label"><?php esc_html_e('Large screens', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_solonav_large" id="show_solonav_large" <?php checked(true, $react['options']['show_solonav_large']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Would you like to display the Solo Navigation and for which devices should it be visible?', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<!-- Show if solonav off -->
								<div class="only_for_solonav"><p class="react-warning"><?php esc_html_e('Solo Nav is Off', 'react'); ?></p></div>

								<!-- ON / OFF Intro-->
								<table class="react-form-table react-tab-0-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Intro', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Switch Intro Section on or off', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row react-on-off react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="show_intro_desktop" class="react-mini-label"><?php esc_html_e('Laptops / Desktops', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_intro_desktop" id="show_intro_desktop" <?php checked(true, $react['options']['show_intro_desktop']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_intro_phone" class="react-mini-label"><?php esc_html_e('Phones', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_intro_phone" id="show_intro_phone" <?php checked(true, $react['options']['show_intro_phone']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_intro_tablet" class="react-mini-label"><?php esc_html_e('Tablets', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_intro_tablet" id="show_intro_tablet" <?php checked(true, $react['options']['show_intro_tablet']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_intro_large" class="react-mini-label"><?php esc_html_e('Large screens', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_intro_large" id="show_intro_large" <?php checked(true, $react['options']['show_intro_large']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Would you like to display the Intro and for which devices should it be visible?', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<!-- Show if Intro off -->
								<div class="only_for_intro"><p class="react-warning"><?php esc_html_e('Intro is Off', 'react'); ?></p></div>

								<!-- ON / OFF Sub Footer-->
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Sub Footer', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Switch Sub Footer Section on or off', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row react-on-off react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="show_subfooter_desktop" class="react-mini-label"><?php esc_html_e('Laptops / Desktops', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_subfooter_desktop" id="show_subfooter_desktop" <?php checked(true, $react['options']['show_subfooter_desktop']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_subfooter_phone" class="react-mini-label"><?php esc_html_e('Phones', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_subfooter_phone" id="show_subfooter_phone" <?php checked(true, $react['options']['show_subfooter_phone']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_subfooter_tablet" class="react-mini-label"><?php esc_html_e('Tablets', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_subfooter_tablet" id="show_subfooter_tablet" <?php checked(true, $react['options']['show_subfooter_tablet']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_subfooter_large" class="react-mini-label"><?php esc_html_e('Large screens', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_subfooter_large" id="show_subfooter_large" <?php checked(true, $react['options']['show_subfooter_large']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Would you like to display the Sub Footer and for which devices should it be visible?', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<!-- Show if Sub Footer off -->
								<div class="only_for_subfooter"><p class="react-warning"><?php esc_html_e('Sub Footer is Off', 'react'); ?></p></div>

							</div>

							<!-- Colors -->
							<div class="react-sub-tab react-colors-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Choose / Create a Global Color Scheme', 'react'); ?></h2>

								<table class="react-form-table react-tab-0-form-table react-color-schemes-table">
									<tr class="react-settings-sub-head">
										<th>
											<label><?php esc_html_e('Choose a Color Scheme', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Start your design with one of React&#39;s Color Schemes', 'react'); ?></span></span>
											<p class="react-description"><?php esc_html_e('There are a range of color schemes available. Here you can apply a full site color scheme.', 'react'); ?></p>
										</th>
									</tr>
									<tr class="react-content-row react-no-desc">
										<td class="react-form-table-input-area-td">
											<div class="react-accordion react-toggle">
												<div class="react-accordion-trigger"><?php esc_html_e('View Global Color Schemes', 'react'); ?></div>
												<div class="react-accordion-content">
													<div class="react-clearfix react-element-spacer">
														<div class="react-clearfix">
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_one" data-scheme="one"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 1', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_two" data-scheme="two"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 2', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_three" data-scheme="three"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 3', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_four" data-scheme="four"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 4', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_five" data-scheme="five"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 5', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_six" data-scheme="six"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 6', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_seven" data-scheme="seven"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 7', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_eight" data-scheme="eight"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 8', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_nine" data-scheme="nine"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 9', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_ten" data-scheme="ten"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 10', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_eleven" data-scheme="eleven"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 11', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_twelve" data-scheme="twelve"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 12', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_thirteen" data-scheme="thirteen"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 13', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_fourteen" data-scheme="fourteen"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 14', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_fifteen" data-scheme="fifteen"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 15', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_sixteen" data-scheme="sixteen"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 16', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_seventeen" data-scheme="seventeen"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 17', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_eighteen" data-scheme="eighteen"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 18', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_nineteen" data-scheme="nineteen"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 19', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_twenty" data-scheme="twenty"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 20', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_twentyone" data-scheme="twentyone"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 21', 'react'); ?></span></a>
														<a class="react-color-scheme react-scheme react-button react-tooltip react_scheme_twentytwo" data-scheme="twentytwo"><span class="react-tooltip-text"><?php esc_html_e('Color Scheme 22', 'react'); ?></span></a>
														</div>
														<div class="react-break"></div>
														<div class="react-clearfix">
															<a class="react-color-scheme react-color-reset react-tooltip react-button react-light" data-scheme="reset"><?php esc_html_e('Reset all colors', 'react'); ?><span class="react-tooltip-text"><?php esc_html_e('This will reset all colors, if you have added colors schemes to individual elements they will also be removed', 'react'); ?></span></a>
															<div id="colorScheme-explanation" style="display:none;">
																  <p class="react-txt-center"><img src="<?php echo esc_url(react_admin_url('images/color-scheme-diagram-explanation.png')); ?>" width="400" height="200" alt="Colour scheme diagram explanation" /></p>
															</div>
															<a href="#TB_inline?width=400&amp;height=260&amp;inlineId=colorScheme-explanation" class="thickbox react-button react-grey react-tooltip"><?php esc_html_e('What do the diagrams represent?', 'react'); ?><span class="react-tooltip-text"><?php esc_html_e('See what each color in the diagram represents', 'react'); ?></span></a>
														</div>

														<div class="react-break"></div>
														<table class="react-form-table react-tab-1-form-table">
															<tr class="react-settings-sub-head">
																<th>
																	<label for="contrast_lighter"><?php esc_html_e('Adjustments', 'react'); ?></label>
																	<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose the strength of the light contrast calculation', 'react'); ?></span></span>
																</th>
															</tr>
															<tr class="react-content-row">
																<td class="react-form-table-input-area-td">
																	<div class="react-multi-input-wrap">
																		<label for="contrast_lighter" class="react-mini-label"><?php esc_html_e('Contrast Lighter', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose the strength of the light contrast calculation', 'react'); ?></span></span></label>
																		<input type="text" name="contrast_lighter" id="contrast_lighter" value="<?php echo esc_attr($react['options']['contrast_lighter']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="4" data-step="1" data-dimension="" />
																	</div>
																	<div class="react-multi-input-wrap">
																		<label for="contrast_darker" class="react-mini-label"><?php esc_html_e('Contrast Darker', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose the strength of the dark contrast calculation', 'react'); ?></span></span></label>
																		<input type="text" name="contrast_darker" id="contrast_darker" value="<?php echo esc_attr($react['options']['contrast_darker']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="4" data-step="1" data-dimension="" />
																	</div>
																	<div class="react-multi-input-wrap">
																		<label for="contrast_reverse" class="react-mini-label"><?php esc_html_e('Contrast Reverse', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Invert the contrast settings, light blends become dark and vice versa', 'react'); ?></span></span></label>
																		<input type="checkbox" class="react-toggle" name="contrast_reverse" id="contrast_reverse" <?php checked(true, $react['options']['contrast_reverse']); ?> value="1" />
																	</div>
																	<p class="react-warning"><?php esc_html_e('After modifying this section; Add a Color scheme from above OR Save options panel, refresh the page then resave options panel.', 'react'); ?></p>
																</td>
															</tr>
														</table>


													</div>
												</div>
											</div>

											<div class="react-accordion react-toggle">
												<div class="react-accordion-trigger"><?php esc_html_e('Find and replace colors', 'react'); ?></div>
												<div class="react-accordion-content">
													<div class="react-clearfix react-element-spacer">

														<table class="react-form-table react-tab-0-form-table">
															<tr class="react-settings-sub-head">
																<th>
																	<label><?php esc_html_e('Find and replace a color', 'react'); ?></label>
																	<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('This will replace colors within the colors section only, including custom palettes.', 'react'); ?></span></span>
																</th>
															</tr>
															<tr class="react-content-row react-content-input-has-many">
																<td class="react-form-table-input-area-td">
																	<div class="react-multi-input-wrap">
																		<label for="react-find-color" class="react-mini-label"><?php esc_html_e('Find this color', 'react'); ?></label>
																		<input class="react-colorpicker" type="text" id="react-find-color" placeholder="<?php esc_attr_e('RGB(A) or #', 'react'); ?>">
																	</div>
																	<div class="react-multi-input-wrap">
																		<label for="react-replace-color" class="react-mini-label"><?php esc_html_e('Replace with this color', 'react'); ?></label>
																		<input class="react-colorpicker" type="text" id="react-replace-color" placeholder="<?php esc_attr_e('RGB(A) or #', 'react'); ?>">
																	</div>
																	<div class="react-multi-input-wrap">
																		<button class="react-button react-green" id="react-do-find-replace-color"><?php esc_html_e('Replace', 'react'); ?></button>
																	</div>
																</td>
															</tr>
														</table>

													</div>
												</div>
											</div>


										</td>
									</tr>
								</table>

								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Global colors', 'react'); ?></div>
									<div class="react-accordion-content">
										<div class="react-table-tabs-wrap">
											<ul class="react-table-tabs-nav">
												<li><span><?php esc_html_e('Text', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Headings', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Sub headings', 'react'); ?></span></li>
											</ul>
										</div>
										<div class="react-table-tabs">
											<div class="react-table-tab">
												<table class="react-form-table react-tab-0-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Body text', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_text" class="react-mini-label"><?php esc_html_e('Body text', 'react'); ?></label>
																<input type="text" name="general_color_text" id="general_color_text" value="<?php echo esc_attr($react['options']['general_color_text']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_text_alt" class="react-mini-label"><?php esc_html_e('Alternative text', 'react'); ?></label>
																<input type="text" name="general_color_text_alt" id="general_color_text_alt" value="<?php echo esc_attr($react['options']['general_color_text_alt']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap has-light-dark">
																<label for="general_color_links" class="react-mini-label"><?php esc_html_e('Links', 'react'); ?></label>
																<input type="text" name="general_color_links" id="general_color_links" value="<?php echo esc_attr($react['options']['general_color_links']); ?>" class="react-colorpicker react-shades" />
																  <div class='react-filter-output'>
																	<div class='lighten'><input type="text" name="general_color_links_lighter" id="general_color_links_lighter" value="<?php echo esc_attr($react['options']['general_color_links_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='darken'><input type="text" name="general_color_links_darker" id="general_color_links_darker" value="<?php echo esc_attr($react['options']['general_color_links_darker']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_links_hover" class="react-mini-label"><?php esc_html_e('Links:hover', 'react'); ?></label>
																<input type="text" name="general_color_links_hover" id="general_color_links_hover" value="<?php echo esc_attr($react['options']['general_color_links_hover']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='lighten'><input type="text" name="general_color_links_hover_lighter" id="general_color_links_hover_lighter" value="<?php echo esc_attr($react['options']['general_color_links_hover_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='darken'><input type="text" name="general_color_links_hover_darker" id="general_color_links_hover_darker" value="<?php echo esc_attr($react['options']['general_color_links_hover_darker']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The colors applied to text elements.', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
											<div class="react-table-tab">

												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Heading colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_h1" class="react-mini-label"><?php esc_html_e('H1', 'react'); ?></label>
																<input type="text" name="general_color_h1" id="general_color_h1" value="<?php echo esc_attr($react['options']['general_color_h1']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_h2" class="react-mini-label"><?php esc_html_e('H2', 'react'); ?></label>
																<input type="text" name="general_color_h2" id="general_color_h2" value="<?php echo esc_attr($react['options']['general_color_h2']); ?>" class="react-colorpicker" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The colors applied to Main headers H1 and H2.', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>

											<div class="react-table-tab">

												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Sub heading colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_h3" class="react-mini-label"><?php esc_html_e('H3', 'react'); ?></label>
																<input type="text" name="general_color_h3" id="general_color_h3" value="<?php echo esc_attr($react['options']['general_color_h3']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_h4" class="react-mini-label"><?php esc_html_e('H4', 'react'); ?></label>
																<input type="text" name="general_color_h4" id="general_color_h4" value="<?php echo esc_attr($react['options']['general_color_h4']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_h5" class="react-mini-label"><?php esc_html_e('H5', 'react'); ?></label>
																<input type="text" name="general_color_h5" id="general_color_h5" value="<?php echo esc_attr($react['options']['general_color_h5']); ?>" class="react-colorpicker" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The colors applied to Sub headers H3, H4 and H5.', 'react'); ?></p>
														</td>
													</tr>
												</table>

											</div>
										</div>

										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head react-content-input-has-many">
												<th colspan="2">
													<label><?php esc_html_e('Site Background', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_color_site_background" class="react-mini-label"><?php esc_html_e('Color', 'react'); ?></label>
														<input type="text" name="general_color_site_background" id="general_color_site_background" value="<?php echo esc_attr($react['options']['general_color_site_background']); ?>" class="react-colorpicker react-shades" />
														<div class='react-filter-output'>
															<div class='even-lighter'><input type="text" name="general_color_site_background_even_lighter" id="general_color_site_background_even_lighter" value="<?php echo esc_attr($react['options']['general_color_site_background_even_lighter']); ?>" class="react-light-color-input" /></div>
															<div class='much-darker'><input type="text" name="general_color_site_background_much_darker" id="general_color_site_background_much_darker" value="<?php echo esc_attr($react['options']['general_color_site_background_much_darker']); ?>" class="react-dark-color-input" /></div>
														</div>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_site_background_gradient" class="react-mini-label"><?php esc_html_e('Gradient', 'react'); ?></label>
														<input type="checkbox" class="react-toggle" name="general_color_site_background_gradient" id="general_color_site_background_gradient" <?php checked(true, $react['options']['general_color_site_background_gradient']); ?> value="1" />
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The color of the site background (may not be visible depending on Background Settings)', 'react'); ?></p>
												</td>
											</tr>
										</table>


										<div class="react-table-tabs-wrap">
											<ul class="react-table-tabs-nav">
												<li><span><?php esc_html_e('Primary', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Dark', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Light', 'react'); ?></span></li>
											</ul>
										</div>

										<div class="react-table-tabs">
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Primary color', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_global_primary_bg" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_global_primary_bg" id="general_color_global_primary_bg" value="<?php echo esc_attr($react['options']['general_color_global_primary_bg']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='lighten'><input type="text" name="general_color_global_primary_bg_lighter" id="general_color_global_primary_bg_lighter" value="<?php echo esc_attr($react['options']['general_color_global_primary_bg_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='even-darker'><input type="text" name="general_color_global_primary_bg_even_darker" id="general_color_global_primary_bg_even_darker" value="<?php echo esc_attr($react['options']['general_color_global_primary_bg_even_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class='darken'><input type="text" name="general_color_global_primary_bg_darker" id="general_color_global_primary_bg_darker" value="<?php echo esc_attr($react['options']['general_color_global_primary_bg_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class='much-darker'><input type="text" name="general_color_global_primary_bg_much_darker" id="general_color_global_primary_bg_much_darker" value="<?php echo esc_attr($react['options']['general_color_global_primary_bg_much_darker']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_global_primary_fg" class="react-mini-label"><?php esc_html_e('Foreground', 'react'); ?></label>
																<input type="text" name="general_color_global_primary_fg" id="general_color_global_primary_fg" value="<?php echo esc_attr($react['options']['general_color_global_primary_fg']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_global_primary_icon" class="react-mini-label"><?php esc_html_e('Text Icons', 'react'); ?></label>
																<input type="text" name="general_color_global_primary_icon" id="general_color_global_primary_icon" value="<?php echo esc_attr($react['options']['general_color_global_primary_icon']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_global_primary_icon_image" class="react-mini-label"><?php esc_html_e('Image Icon', 'react'); ?></label>
																<select id="general_color_global_primary_icon_image" name="general_color_global_primary_icon_image">
																	<option value="lgt" <?php selected($react['options']['general_color_global_primary_icon_image'], 'lgt'); ?>><?php esc_html_e('Light', 'react'); ?></option>
																	<option value="drk" <?php selected($react['options']['general_color_global_primary_icon_image'], 'drk'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
																</select>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_global_primary_gradient" class="react-mini-label"><?php esc_html_e('Gradient', 'react'); ?></label>
																<input type="checkbox" class="react-toggle" name="general_color_global_primary_gradient" id="general_color_global_primary_gradient" <?php checked(true, $react['options']['general_color_global_primary_gradient']); ?> value="1" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The Primary color is applied to many different elements within the theme. In the default settings it is the light blue color seen on buttons, boxes and more.', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Dark color', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_global_dark_bg" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_global_dark_bg" id="general_color_global_dark_bg" value="<?php echo esc_attr($react['options']['general_color_global_dark_bg']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='lighten'><input type="text" name="general_color_global_dark_bg_lighter" id="general_color_global_dark_bg_lighter" value="<?php echo esc_attr($react['options']['general_color_global_dark_bg_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='even-lighter'><input type="text" name="general_color_global_dark_bg_even_lighter" id="general_color_global_dark_bg_even_lighter" value="<?php echo esc_attr($react['options']['general_color_global_dark_bg_even_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='even-darker'><input type="text" name="general_color_global_dark_bg_even_darker" id="general_color_global_dark_bg_even_darker" value="<?php echo esc_attr($react['options']['general_color_global_dark_bg_even_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class='much-darker'><input type="text" name="general_color_global_dark_bg_much_darker" id="general_color_global_dark_bg_much_darker" value="<?php echo esc_attr($react['options']['general_color_global_dark_bg_much_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class='darken'><input type="text" name="general_color_global_dark_bg_darker" id="general_color_global_dark_bg_darker" value="<?php echo esc_attr($react['options']['general_color_global_dark_bg_darker']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_global_dark_fg" class="react-mini-label"><?php esc_html_e('Foreground', 'react'); ?></label>
																<input type="text" name="general_color_global_dark_fg" id="general_color_global_dark_fg" value="<?php echo esc_attr($react['options']['general_color_global_dark_fg']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_global_dark_icon" class="react-mini-label"><?php esc_html_e('Text Icons', 'react'); ?></label>
																<input type="text" name="general_color_global_dark_icon" id="general_color_global_dark_icon" value="<?php echo esc_attr($react['options']['general_color_global_dark_icon']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_global_dark_gradient" class="react-mini-label"><?php esc_html_e('Gradient', 'react'); ?></label>
																<input type="checkbox" class="react-toggle" name="general_color_global_dark_gradient" id="general_color_global_dark_gradient" <?php checked(true, $react['options']['general_color_global_dark_gradient']); ?> value="1" />
															</div>

														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The Dark color is applied to many different elements within the theme.', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Light color', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_global_light_bg" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_global_light_bg" id="general_color_global_light_bg" value="<?php echo esc_attr($react['options']['general_color_global_light_bg']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='lighten'><input type="text" name="general_color_global_light_bg_lighter" id="general_color_global_light_bg_lighter" value="<?php echo esc_attr($react['options']['general_color_global_light_bg_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='even-lighter'><input type="text" name="general_color_global_light_bg_even_lighter" id="general_color_global_light_bg_even_lighter" value="<?php echo esc_attr($react['options']['general_color_global_light_bg_even_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='even-darker'><input type="text" name="general_color_global_light_bg_even_darker" id="general_color_global_light_bg_even_darker" value="<?php echo esc_attr($react['options']['general_color_global_light_bg_even_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class='darken'><input type="text" name="general_color_global_light_bg_darker" id="general_color_global_light_bg_darker" value="<?php echo esc_attr($react['options']['general_color_global_light_bg_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class='much-darker'><input type="text" name="general_color_global_light_bg_much_darker" id="general_color_global_light_bg_much_darker" value="<?php echo esc_attr($react['options']['general_color_global_light_bg_much_darker']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_global_light_fg" class="react-mini-label"><?php esc_html_e('Foreground', 'react'); ?></label>
																<input type="text" name="general_color_global_light_fg" id="general_color_global_light_fg" value="<?php echo esc_attr($react['options']['general_color_global_light_fg']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='even-lighter'><input type="text" name="general_color_global_light_fg_even_lighter" id="general_color_global_light_fg_even_lighter" value="<?php echo esc_attr($react['options']['general_color_global_light_fg_even_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='even-darker'><input type="text" name="general_color_global_light_fg_even_darker" id="general_color_global_light_fg_even_darker" value="<?php echo esc_attr($react['options']['general_color_global_light_fg_even_darker']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_global_light_icon" class="react-mini-label"><?php esc_html_e('Text Icons', 'react'); ?></label>
																<input type="text" name="general_color_global_light_icon" id="general_color_global_light_icon" value="<?php echo esc_attr($react['options']['general_color_global_light_icon']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_global_light_gradient" class="react-mini-label"><?php esc_html_e('Gradient', 'react'); ?></label>
																<input type="checkbox" class="react-toggle" name="general_color_global_light_gradient" id="general_color_global_light_gradient" <?php checked(true, $react['options']['general_color_global_light_gradient']); ?> value="1" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The Light color is applied to many different elements within the theme.', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
										</div>

										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Navigation drop down', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_color_mainhead_submenu_choose_scheme" class="react-mini-label"><?php esc_html_e('Main header', 'react'); ?></label>
														<select id="general_color_mainhead_submenu_choose_scheme" name="general_color_mainhead_submenu_choose_scheme" class="react-custom-palette-selector">
															<option value="" <?php selected($react['options']['general_color_mainhead_submenu_choose_scheme'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
															<?php echo react_render_custom_palette_options($react['options']['general_color_mainhead_submenu_choose_scheme']); ?>
														</select>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_tophead_submenu_choose_scheme" class="react-mini-label"><?php esc_html_e('Top header', 'react'); ?></label>
														<select id="general_color_tophead_submenu_choose_scheme" name="general_color_tophead_submenu_choose_scheme" class="react-custom-palette-selector">
															<option value="" <?php selected($react['options']['general_color_tophead_submenu_choose_scheme'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
															<?php echo react_render_custom_palette_options($react['options']['general_color_tophead_submenu_choose_scheme']); ?>
														</select>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_solonav_submenu_choose_scheme" class="react-mini-label"><?php esc_html_e('Solo nav', 'react'); ?></label>
														<select id="general_color_solonav_submenu_choose_scheme" name="general_color_solonav_submenu_choose_scheme" class="react-custom-palette-selector">
															<option value="" <?php selected($react['options']['general_color_solonav_submenu_choose_scheme'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
															<?php echo react_render_custom_palette_options($react['options']['general_color_solonav_submenu_choose_scheme']); ?>
														</select>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Choose a palette for the navigation menus. This is optional, the dropdown will automatically take the Button hover colors. You can use this section for alternative colors. Background, border, icon color, link, link hover, primary and dark colors are used.', 'react'); ?></p>
												</td>
											</tr>
										</table>






										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Blog post icons', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<!-- move this -->
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_default_bg" class="react-mini-label"><?php esc_html_e('Standard background', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_default_bg" id="general_color_blog_icon_default_bg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_default_bg']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_default_fg" class="react-mini-label"><?php esc_html_e('Standard icon', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_default_fg" id="general_color_blog_icon_default_fg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_default_fg']); ?>" class="react-colorpicker" />
													</div>
													<div class="clear"></div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_aside_bg" class="react-mini-label"><?php esc_html_e('Aside background', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_aside_bg" id="general_color_blog_icon_aside_bg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_aside_bg']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_aside_fg" class="react-mini-label"><?php esc_html_e('Aside icon', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_aside_fg" id="general_color_blog_icon_aside_fg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_aside_fg']); ?>" class="react-colorpicker" />
													</div>
													<div class="clear"></div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_audio_bg" class="react-mini-label"><?php esc_html_e('Audio background', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_audio_bg" id="general_color_blog_icon_audio_bg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_audio_bg']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_audio_fg" class="react-mini-label"><?php esc_html_e('Audio icon', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_audio_fg" id="general_color_blog_icon_audio_fg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_audio_fg']); ?>" class="react-colorpicker" />
													</div>
													<div class="clear"></div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_link_bg" class="react-mini-label"><?php esc_html_e('Link background', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_link_bg" id="general_color_blog_icon_link_bg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_link_bg']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_link_fg" class="react-mini-label"><?php esc_html_e('Link icon', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_link_fg" id="general_color_blog_icon_link_fg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_link_fg']); ?>" class="react-colorpicker" />
													</div>
													<div class="clear"></div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_gallery_bg" class="react-mini-label"><?php esc_html_e('Gallery background', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_gallery_bg" id="general_color_blog_icon_gallery_bg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_gallery_bg']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_gallery_fg" class="react-mini-label"><?php esc_html_e('Gallery icon', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_gallery_fg" id="general_color_blog_icon_gallery_fg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_gallery_fg']); ?>" class="react-colorpicker" />
													</div>
													<div class="clear"></div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_quote_bg" class="react-mini-label"><?php esc_html_e('Quote background', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_quote_bg" id="general_color_blog_icon_quote_bg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_quote_bg']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_quote_fg" class="react-mini-label"><?php esc_html_e('Quote icon', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_quote_fg" id="general_color_blog_icon_quote_fg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_quote_fg']); ?>" class="react-colorpicker" />
													</div>
													<div class="clear"></div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_status_bg" class="react-mini-label"><?php esc_html_e('Status background', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_status_bg" id="general_color_blog_icon_status_bg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_status_bg']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_status_fg" class="react-mini-label"><?php esc_html_e('Status icon', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_status_fg" id="general_color_blog_icon_status_fg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_status_fg']); ?>" class="react-colorpicker" />
													</div>
													<div class="clear"></div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_image_bg" class="react-mini-label"><?php esc_html_e('Image background', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_image_bg" id="general_color_blog_icon_image_bg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_image_bg']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_image_fg" class="react-mini-label"><?php esc_html_e('Image icon', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_image_fg" id="general_color_blog_icon_image_fg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_image_fg']); ?>" class="react-colorpicker" />
													</div>
													<div class="clear"></div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_video_bg" class="react-mini-label"><?php esc_html_e('Video background', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_video_bg" id="general_color_blog_icon_video_bg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_video_bg']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_video_fg" class="react-mini-label"><?php esc_html_e('Video icon', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_video_fg" id="general_color_blog_icon_video_fg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_video_fg']); ?>" class="react-colorpicker" />
													</div>
													<div class="clear"></div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_chat_bg" class="react-mini-label"><?php esc_html_e('Chat background', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_chat_bg" id="general_color_blog_icon_chat_bg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_chat_bg']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_blog_icon_chat_fg" class="react-mini-label"><?php esc_html_e('Chat icon', 'react'); ?></label>
														<input type="text" name="general_color_blog_icon_chat_fg" id="general_color_blog_icon_chat_fg" value="<?php echo esc_attr($react['options']['general_color_blog_icon_chat_fg']); ?>" class="react-colorpicker" />
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Pace progress is the red bar that is shown when page is loading. The red color is used to show number of post likes, comment replies and form required text', 'react'); ?></p>
												</td>
											</tr>
										</table>







										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Other', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_color_page_loader" class="react-mini-label"><?php esc_html_e('Page loader bar / spinner', 'react'); ?></label>
														<input type="text" name="general_color_page_loader" id="general_color_page_loader" value="<?php echo esc_attr($react['options']['general_color_page_loader']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_page_loader_bg" class="react-mini-label"><?php esc_html_e('Page loader background (if used)', 'react'); ?></label>
														<input type="text" name="general_color_page_loader_bg" id="general_color_page_loader_bg" value="<?php echo esc_attr($react['options']['general_color_page_loader_bg']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_red_bg" class="react-mini-label"><?php esc_html_e('Red color background', 'react'); ?></label>
														<input type="text" name="general_color_red_bg" id="general_color_red_bg" value="<?php echo esc_attr($react['options']['general_color_red_bg']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_red_fg" class="react-mini-label"><?php esc_html_e('Red color foreground', 'react'); ?></label>
														<input type="text" name="general_color_red_fg" id="general_color_red_fg" value="<?php echo esc_attr($react['options']['general_color_red_fg']); ?>" class="react-colorpicker" />
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Pace progress is the red bar that is shown when page is loading. The red color is used to show number of post likes, comment replies and form required text', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div><!-- Accordion end -->
								</div>


								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Top Header', 'react'); ?></div>
									<div class="react-accordion-content">
										<!-- Show if TopHead off -->
										<div class="only_for_tophead"><p class="react-warning"><?php esc_html_e('Top Header section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
										<!-- Top Header colors -->
										<div class="react-table-tabs-wrap">
											<ul class="react-table-tabs-nav">
												<li><span><?php esc_html_e('Top Header', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Text', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Text style nav', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Button style nav', 'react'); ?></span></li>
											</ul>
										</div>

										<div class="react-table-tabs">

											<div class="react-table-tab">

												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Top Header background colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_topheader_background" id="general_color_topheader_background" value="<?php echo esc_attr($react['options']['general_color_topheader_background']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='lighten'><input type="text" name="general_color_topheader_background_lighter" id="general_color_topheader_background_lighter" value="<?php echo esc_attr($react['options']['general_color_topheader_background_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='darken'><input type="text" name="general_color_topheader_background_darker" id="general_color_topheader_background_darker" value="<?php echo esc_attr($react['options']['general_color_topheader_background_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class='much-darker'><input type="text" name="general_color_topheader_background_much_darker" id="general_color_topheader_background_much_darker" value="<?php echo esc_attr($react['options']['general_color_topheader_background_much_darker']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_background_gradient" class="react-mini-label"><?php esc_html_e('Gradient', 'react'); ?></label>
																<input type="checkbox" class="react-toggle" name="general_color_topheader_background_gradient" id="general_color_topheader_background_gradient" <?php checked(true, $react['options']['general_color_topheader_background_gradient']); ?> value="1" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_border" class="react-mini-label"><?php esc_html_e('Border', 'react'); ?></label>
																<input type="text" name="general_color_topheader_border" id="general_color_topheader_border" value="<?php echo esc_attr($react['options']['general_color_topheader_border']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_border_lr" class="react-mini-label"><?php esc_html_e('Border left/right', 'react'); ?></label>
																<input type="text" name="general_color_topheader_border_lr" id="general_color_topheader_border_lr" value="<?php echo esc_attr($react['options']['general_color_topheader_border_lr']); ?>" class="react-colorpicker" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Create a color scheme to be applied to the Top Header area of the theme.', 'react'); ?></p>
														</td>
													</tr>
												</table>

											</div>
											<div class="react-table-tab">

												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Top Header text colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_text" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
																<input type="text" name="general_color_topheader_text" id="general_color_topheader_text" value="<?php echo esc_attr($react['options']['general_color_topheader_text']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_icon" class="react-mini-label"><?php esc_html_e('Icons', 'react'); ?></label>
																<input type="text" name="general_color_topheader_icon" id="general_color_topheader_icon" value="<?php echo esc_attr($react['options']['general_color_topheader_icon']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_icon_hover" class="react-mini-label"><?php esc_html_e('Icons:hover', 'react'); ?></label>
																<input type="text" name="general_color_topheader_icon_hover" id="general_color_topheader_icon_hover" value="<?php echo esc_attr($react['options']['general_color_topheader_icon_hover']); ?>" class="react-colorpicker" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The colors applied to the text elements inside the Top Header', 'react'); ?></p>
														</td>
													</tr>
												</table>

											</div>
											<div class="react-table-tab">

												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Top Header Text style navigation colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_nav_text" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
																<input type="text" name="general_color_topheader_nav_text" id="general_color_topheader_nav_text" value="<?php echo esc_attr($react['options']['general_color_topheader_nav_text']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_nav_text_hover" class="react-mini-label"><?php esc_html_e('Text:hover', 'react'); ?></label>
																<input type="text" name="general_color_topheader_nav_text_hover" id="general_color_topheader_nav_text_hover" value="<?php echo esc_attr($react['options']['general_color_topheader_nav_text_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_nav_text_icon_image" class="react-mini-label"><?php esc_html_e('Image icon', 'react'); ?></label>
																 <select id="general_color_topheader_nav_text_icon_image" name="general_color_topheader_nav_text_icon_image">
																	<option value="lgt" <?php selected($react['options']['general_color_topheader_nav_text_icon_image'], 'lgt'); ?>><?php esc_html_e('Light', 'react'); ?></option>
																	<option value="drk" <?php selected($react['options']['general_color_topheader_nav_text_icon_image'], 'drk'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
																</select>
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The colors applied to the Text style navigation inside the Top Header. To change the Navigation style go to: Global &rarr; Navigation &rarr; Navigation Styles', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Top Header Button style navigation colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_buttonnav_text" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
																<input type="text" name="general_color_topheader_buttonnav_text" id="general_color_topheader_buttonnav_text" value="<?php echo esc_attr($react['options']['general_color_topheader_buttonnav_text']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_buttonnav_text_hover" class="react-mini-label"><?php esc_html_e('Text:hover', 'react'); ?></label>
																<input type="text" name="general_color_topheader_buttonnav_text_hover" id="general_color_topheader_buttonnav_text_hover" value="<?php echo esc_attr($react['options']['general_color_topheader_buttonnav_text_hover']); ?>" class="react-colorpicker" />
															</div>

															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_buttonnav_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_topheader_buttonnav_background" id="general_color_topheader_buttonnav_background" value="<?php echo esc_attr($react['options']['general_color_topheader_buttonnav_background']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='darken'><input type="text" name="general_color_topheader_buttonnav_background_darken" id="general_color_topheader_buttonnav_background_darken" value="<?php echo esc_attr($react['options']['general_color_topheader_buttonnav_background_darken']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_buttonnav_background_hover" class="react-mini-label"><?php esc_html_e('Background:hover', 'react'); ?></label>
																<input type="text" name="general_color_topheader_buttonnav_background_hover" id="general_color_topheader_buttonnav_background_hover" value="<?php echo esc_attr($react['options']['general_color_topheader_buttonnav_background_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_buttonnav_border" class="react-mini-label"><?php esc_html_e('Border', 'react'); ?></label>
																<input type="text" name="general_color_topheader_buttonnav_border" id="general_color_topheader_buttonnav_border" value="<?php echo esc_attr($react['options']['general_color_topheader_buttonnav_border']); ?>" class="react-colorpicker" />
															</div>

															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_buttonnav_border_hover" class="react-mini-label"><?php esc_html_e('Border:hover', 'react'); ?></label>
																<input type="text" name="general_color_topheader_buttonnav_border_hover" id="general_color_topheader_buttonnav_border_hover" value="<?php echo esc_attr($react['options']['general_color_topheader_buttonnav_border_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_nav_buttonnav_icon_image" class="react-mini-label"><?php esc_html_e('Image icon', 'react'); ?></label>
																 <select id="general_color_topheader_nav_buttonnav_icon_image" name="general_color_topheader_nav_buttonnav_icon_image">
																	<option value="lgt" <?php selected($react['options']['general_color_topheader_nav_buttonnav_icon_image'], 'lgt'); ?>><?php esc_html_e('Light', 'react'); ?></option>
																	<option value="drk" <?php selected($react['options']['general_color_topheader_nav_buttonnav_icon_image'], 'drk'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
																</select>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_topheader_buttonnav_gradient" class="react-mini-label"><?php esc_html_e('Gradient', 'react'); ?></label>
																<input type="checkbox" class="react-toggle" name="general_color_topheader_buttonnav_gradient" id="general_color_topheader_buttonnav_gradient" <?php checked(true, $react['options']['general_color_topheader_buttonnav_gradient']); ?> value="1" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The colors applied to the Button style navigation inside the Top Header. To change the Navigation style goto: Global &rarr; Navigation &rarr; Navigation Styles', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div><!-- Accordion end -->
								</div>


								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Main Header', 'react'); ?></div>
									<div class="react-accordion-content">

										<!-- Main header colors -->
										<div class="react-table-tabs-wrap">
											<ul class="react-table-tabs-nav">
												<li><span><?php esc_html_e('Main Header', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Strapline', 'react'); ?></span></li>
											</ul>
										</div>
										<div class="react-table-tabs">
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Main Header background colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_mainheader_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_mainheader_background" id="general_color_mainheader_background" value="<?php echo esc_attr($react['options']['general_color_mainheader_background']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='lighten'><input type="text" name="general_color_mainheader_background_lighter" id="general_color_mainheader_background_lighter" value="<?php echo esc_attr($react['options']['general_color_mainheader_background_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='darken'><input type="text" name="general_color_mainheader_background_darker" id="general_color_mainheader_background_darker" value="<?php echo esc_attr($react['options']['general_color_mainheader_background_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class='much-darker'><input type="text" name="general_color_mainheader_background_much_darker" id="general_color_mainheader_background_much_darker" value="<?php echo esc_attr($react['options']['general_color_mainheader_background_much_darker']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_mainheader_background_gradient" class="react-mini-label"><?php esc_html_e('Gradient', 'react'); ?></label>
																<input type="checkbox" class="react-toggle" name="general_color_mainheader_background_gradient" id="general_color_mainheader_background_gradient" <?php checked(true, $react['options']['general_color_mainheader_background_gradient']); ?> value="1" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_mainheader_border" class="react-mini-label"><?php esc_html_e('Border', 'react'); ?></label>
																<input type="text" name="general_color_mainheader_border" id="general_color_mainheader_border" value="<?php echo esc_attr($react['options']['general_color_mainheader_border']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_mainheader_border_lr" class="react-mini-label"><?php esc_html_e('Border left/right', 'react'); ?></label>
																<input type="text" name="general_color_mainheader_border_lr" id="general_color_mainheader_border_lr" value="<?php echo esc_attr($react['options']['general_color_mainheader_border_lr']); ?>" class="react-colorpicker" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Create a color scheme to be applied to the Main Header area of the theme.', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label for="general_color_mainheader_strapline"><?php esc_html_e('Logo strapline text color', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row">
														<td class="react-form-table-input-area-td">
															<input type="text" name="general_color_mainheader_strapline" id="general_color_mainheader_strapline" value="<?php echo esc_attr($react['options']['general_color_mainheader_strapline']); ?>" class="react-colorpicker" />
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The text color of the strapline (Global &rarr; Logo &rarr; Strapline)', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
										</div>

										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Alternative sticky header background', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_color_stickyhead_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
														<input type="text" name="general_color_stickyhead_background" id="general_color_stickyhead_background" value="<?php echo esc_attr($react['options']['general_color_stickyhead_background']); ?>" class="react-colorpicker" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_color_stickyhead_border" class="react-mini-label"><?php esc_html_e('Border', 'react'); ?></label>
														<input type="text" name="general_color_stickyhead_border" id="general_color_stickyhead_border" value="<?php echo esc_attr($react['options']['general_color_stickyhead_border']); ?>" class="react-colorpicker" />
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('If you are using Navigation Sticky option these colors will be applied to the Header or Solonav once scrolled.', 'react'); ?></p>
												</td>
											</tr>
										</table>

										<!-- Info menu colors -->
										<div class="react-table-tabs-wrap">
											<ul class="react-table-tabs-nav">
												<li><span><?php esc_html_e('Info Menu navigation', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Content display', 'react'); ?></span></li>
											</ul>
										</div>

										<div class="react-table-tabs">
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Info Menu navigation', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_infomenu_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_infomenu_background" id="general_color_infomenu_background" value="<?php echo esc_attr($react['options']['general_color_infomenu_background']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='even-darker'><input type="text" name="general_color_infomenu_background_even_darker" id="general_color_infomenu_background_even_darker" value="<?php echo esc_attr($react['options']['general_color_infomenu_background_even_darker']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_infomenu_background_hover" class="react-mini-label"><?php esc_html_e('Background hover', 'react'); ?></label>
																<input type="text" name="general_color_infomenu_background_hover" id="general_color_infomenu_background_hover" value="<?php echo esc_attr($react['options']['general_color_infomenu_background_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_infomenu_border" class="react-mini-label"><?php esc_html_e('Border', 'react'); ?></label>
																<input type="text" name="general_color_infomenu_border" id="general_color_infomenu_border" value="<?php echo esc_attr($react['options']['general_color_infomenu_border']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_infomenu_icon_image" class="react-mini-label"><?php esc_html_e('Image icons', 'react'); ?></label>
																 <select id="general_color_infomenu_icon_image" name="general_color_infomenu_icon_image">
																	<option value="drk-ico" <?php selected($react['options']['general_color_infomenu_icon_image'], 'drk-ico'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
																	<option value="lgt-ico" <?php selected($react['options']['general_color_infomenu_icon_image'], 'lgt-ico'); ?>><?php esc_html_e('Light', 'react'); ?></option>
																</select>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_infomenu_background_active" class="react-mini-label"><?php esc_html_e('Background active overlay', 'react'); ?></label>
																<input type="text" name="general_color_infomenu_background_active" id="general_color_infomenu_background_active" value="<?php echo esc_attr($react['options']['general_color_infomenu_background_active']); ?>" class="react-colorpicker" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<!-- Show if InfoMenu off -->
															<div class="only_for_infomenu"><p class="react-warning"><?php esc_html_e('Info Menu section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
															<p class="react-description"><?php esc_html_e('The colors applied to the Info Menu navigation bar inside the Main Header. (Components &rarr; Info Menu)', 'react'); ?></p>
														</td>
													</tr>
												</table>

											</div>
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label for="general_color_infomenu_popout_choose_scheme"><?php esc_html_e('Info Menu content display', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_infomenu_popout_choose_scheme" class="react-mini-label"><?php esc_html_e('Pop Out', 'react'); ?></label>
																<select id="general_color_infomenu_popout_choose_scheme" name="general_color_infomenu_popout_choose_scheme" class="react-custom-palette-selector">
																	<option value="" <?php selected($react['options']['general_color_infomenu_popout_choose_scheme'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
																	<?php echo react_render_custom_palette_options($react['options']['general_color_infomenu_popout_choose_scheme']); ?>
																</select>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_infomenu_slideout_choose_scheme" class="react-mini-label"><?php esc_html_e('Slide Out', 'react'); ?></label>
																<select id="general_color_infomenu_slideout_choose_scheme" name="general_color_infomenu_slideout_choose_scheme" class="react-custom-palette-selector">
																	<option value="" <?php selected($react['options']['general_color_infomenu_slideout_choose_scheme'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
																	<?php echo react_render_custom_palette_options($react['options']['general_color_infomenu_slideout_choose_scheme']); ?>
																</select>
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The colors applied to the content area of the Info Menu items', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
										</div>

										<!-- Default nav colors -->
										<div class="react-table-tabs-wrap">
											<ul class="react-table-tabs-nav">
												<li><span><?php esc_html_e('Button style navigation', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Text style navigation', 'react'); ?></span></li>
											</ul>
										</div>
										<div class="react-table-tabs">
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Main Header Button style navigation colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_default_buttonnav_text" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
																<input type="text" name="general_color_default_buttonnav_text" id="general_color_default_buttonnav_text" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_text']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_default_buttonnav_text_hover" class="react-mini-label"><?php esc_html_e('Text:hover', 'react'); ?></label>
																<input type="text" name="general_color_default_buttonnav_text_hover" id="general_color_default_buttonnav_text_hover" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_text_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_default_buttonnav_desc" class="react-mini-label"><?php esc_html_e('Description', 'react'); ?></label>
																<input type="text" name="general_color_default_buttonnav_desc" id="general_color_default_buttonnav_desc" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_desc']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_default_buttonnav_desc_hover" class="react-mini-label"><?php esc_html_e('Description:hover', 'react'); ?></label>
																<input type="text" name="general_color_default_buttonnav_desc_hover" id="general_color_default_buttonnav_desc_hover" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_desc_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_default_buttonnav_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_default_buttonnav_background" id="general_color_default_buttonnav_background" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_background']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='darken'><input type="text" name="general_color_default_buttonnav_background_darken" id="general_color_default_buttonnav_background_darken" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_background_darken']); ?>" class="react-dark-color-input" /></div>
																	<div class='much-darker'><input type="text" name="general_color_default_buttonnav_background_much_darker" id="general_color_default_buttonnav_background_much_darker" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_background_much_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class='lighten'><input type="text" name="general_color_default_buttonnav_background_lighter" id="general_color_default_buttonnav_background_lighter" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_background_lighter']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_default_buttonnav_background_hover" class="react-mini-label"><?php esc_html_e('Background:hover', 'react'); ?></label>
																<input type="text" name="general_color_default_buttonnav_background_hover" id="general_color_default_buttonnav_background_hover" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_background_hover']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='darken'><input type="text" name="general_color_default_buttonnav_background_hover_darken" id="general_color_default_buttonnav_background_hover_darken" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_background_hover_darken']); ?>" class="react-dark-color-input" /></div>
																	<div class='lighten'><input type="text" name="general_color_default_buttonnav_background_hover_lighter" id="general_color_default_buttonnav_background_hover_lighter" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_background_hover_lighter']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_default_buttonnav_border" class="react-mini-label"><?php esc_html_e('Border', 'react'); ?></label>
																<input type="text" name="general_color_default_buttonnav_border" id="general_color_default_buttonnav_border" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_border']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='a-touch-lighter'><input type="text" name="general_color_default_buttonnav_border_lighter" id="general_color_default_buttonnav_border_lighter" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_border_lighter']); ?>" class="react-light-color-input" /></div>
																</div>
															</div>

															<div class="react-multi-input-wrap">
																<label for="general_color_default_buttonnav_border_hover" class="react-mini-label"><?php esc_html_e('Border:hover', 'react'); ?></label>
																<input type="text" name="general_color_default_buttonnav_border_hover" id="general_color_default_buttonnav_border_hover" value="<?php echo esc_attr($react['options']['general_color_default_buttonnav_border_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_default_buttonnav_icon_image" class="react-mini-label"><?php esc_html_e('Image icon', 'react'); ?></label>
																 <select id="general_color_default_buttonnav_icon_image" name="general_color_default_buttonnav_icon_image">
																	<option value="lgt" <?php selected($react['options']['general_color_default_buttonnav_icon_image'], 'lgt'); ?>><?php esc_html_e('Light', 'react'); ?></option>
																	<option value="drk" <?php selected($react['options']['general_color_default_buttonnav_icon_image'], 'drk'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
																</select>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_default_buttonnav_gradient" class="react-mini-label"><?php esc_html_e('Gradient', 'react'); ?></label>
																<input type="checkbox" class="react-toggle" name="general_color_default_buttonnav_gradient" id="general_color_default_buttonnav_gradient" <?php checked(true, $react['options']['general_color_default_buttonnav_gradient']); ?> value="1" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The colors applied to the Button style navigation inside the Main Header. To change the Navigation style goto: Global &rarr; Navigation &rarr; Navigation Styles', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Main header Text style navigation colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_default_textnav_text" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
																<input type="text" name="general_color_default_textnav_text" id="general_color_default_textnav_text" value="<?php echo esc_attr($react['options']['general_color_default_textnav_text']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_default_textnav_text_hover" class="react-mini-label"><?php esc_html_e('Text:hover', 'react'); ?></label>
																<input type="text" name="general_color_default_textnav_text_hover" id="general_color_default_textnav_text_hover" value="<?php echo esc_attr($react['options']['general_color_default_textnav_text_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_default_textnav_desc" class="react-mini-label"><?php esc_html_e('Description', 'react'); ?></label>
																<input type="text" name="general_color_default_textnav_desc" id="general_color_default_textnav_desc" value="<?php echo esc_attr($react['options']['general_color_default_textnav_desc']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_default_textnav_desc_hover" class="react-mini-label"><?php esc_html_e('Description:hover', 'react'); ?></label>
																<input type="text" name="general_color_default_textnav_desc_hover" id="general_color_default_textnav_desc_hover" value="<?php echo esc_attr($react['options']['general_color_default_textnav_desc_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_default_textnav_icon_image" class="react-mini-label"><?php esc_html_e('Image icon', 'react'); ?></label>
																 <select id="general_color_default_textnav_icon_image" name="general_color_default_textnav_icon_image">
																	<option value="lgt" <?php selected($react['options']['general_color_default_textnav_icon_image'], 'lgt'); ?>><?php esc_html_e('Light', 'react'); ?></option>
																	<option value="drk" <?php selected($react['options']['general_color_default_textnav_icon_image'], 'drk'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
																</select>
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The colors applied to the Text style navigation inside the Top Header. To change the Navigation style goto: Global &rarr; Navigation &rarr; Navigation Styles', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div><!-- Accordion end -->
								</div>

									<div class="react-accordion react-toggle">
										<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Solo Nav', 'react'); ?></div>
										<div class="react-accordion-content">
											<!-- Show if solonav off -->
											<div class="only_for_solonav"><p class="react-warning"><?php esc_html_e('Solo Nav section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
											<!-- Solo navigation colors -->
											<div class="react-table-tabs-wrap">
												<ul class="react-table-tabs-nav">
													<li><span><?php esc_html_e('Solo Nav', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Button Style', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Text Style', 'react'); ?></span></li>
												</ul>
											</div>
											<div class="react-table-tabs">
												<div class="react-table-tab">
													<table class="react-form-table react-tab-1-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label><?php esc_html_e('Solo Nav background colors', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row react-content-input-has-many">
															<td class="react-form-table-input-area-td">
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																	<input type="text" name="general_color_solonav_background" id="general_color_solonav_background" value="<?php echo esc_attr($react['options']['general_color_solonav_background']); ?>" class="react-colorpicker react-shades" />
																	<div class='react-filter-output'>
																		<div class='darken'><input type="text" name="general_color_solonav_background_darker" id="general_color_solonav_background_darker" value="<?php echo esc_attr($react['options']['general_color_solonav_background_darker']); ?>" class="react-dark-color-input" /></div>
																		<div class='much-darker'><input type="text" name="general_color_solonav_background_much_darker" id="general_color_solonav_background_much_darker" value="<?php echo esc_attr($react['options']['general_color_solonav_background_much_darker']); ?>" class="react-dark-color-input" /></div>
																		<div class='lighten'><input type="text" name="general_color_solonav_background_lighter" id="general_color_solonav_background_lighter" value="<?php echo esc_attr($react['options']['general_color_solonav_background_lighter']); ?>" class="react-light-color-input" /></div>
																	</div>
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_background_gradient" class="react-mini-label"><?php esc_html_e('Gradient', 'react'); ?></label>
																	<input type="checkbox" class="react-toggle" name="general_color_solonav_background_gradient" id="general_color_solonav_background_gradient" <?php checked(true, $react['options']['general_color_solonav_background_gradient']); ?> value="1" />
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_border" class="react-mini-label"><?php esc_html_e('Border', 'react'); ?></label>
																	<input type="text" name="general_color_solonav_border" id="general_color_solonav_border" value="<?php echo esc_attr($react['options']['general_color_solonav_border']); ?>" class="react-colorpicker" />
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_border_lr" class="react-mini-label"><?php esc_html_e('Border left/right', 'react'); ?></label>
																	<input type="text" name="general_color_solonav_border_lr" id="general_color_solonav_border_lr" value="<?php echo esc_attr($react['options']['general_color_solonav_border_lr']); ?>" class="react-colorpicker" />
																</div>
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('Create a color scheme to be applied to the Solo Nav area of the theme.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-1-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label><?php esc_html_e('Solo Nav Button style navigaiton colors', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row react-content-input-has-many">
															<td class="react-form-table-input-area-td">
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_buttonnav_text" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
																	<input type="text" name="general_color_solonav_buttonnav_text" id="general_color_solonav_buttonnav_text" value="<?php echo esc_attr($react['options']['general_color_solonav_buttonnav_text']); ?>" class="react-colorpicker" />
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_buttonnav_text_hover" class="react-mini-label"><?php esc_html_e('Text:hover', 'react'); ?></label>
																	<input type="text" name="general_color_solonav_buttonnav_text_hover" id="general_color_solonav_buttonnav_text_hover" value="<?php echo esc_attr($react['options']['general_color_solonav_buttonnav_text_hover']); ?>" class="react-colorpicker" />
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_buttonnav_desc" class="react-mini-label"><?php esc_html_e('Description', 'react'); ?></label>
																	<input type="text" name="general_color_solonav_buttonnav_desc" id="general_color_solonav_buttonnav_desc" value="<?php echo esc_attr($react['options']['general_color_solonav_buttonnav_desc']); ?>" class="react-colorpicker" />
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_buttonnav_desc_hover" class="react-mini-label"><?php esc_html_e('Description:hover', 'react'); ?></label>
																	<input type="text" name="general_color_solonav_buttonnav_desc_hover" id="general_color_solonav_buttonnav_desc_hover" value="<?php echo esc_attr($react['options']['general_color_solonav_buttonnav_desc_hover']); ?>" class="react-colorpicker" />
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_buttonnav_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																	<input type="text" name="general_color_solonav_buttonnav_background" id="general_color_solonav_buttonnav_background" value="<?php echo esc_attr($react['options']['general_color_solonav_buttonnav_background']); ?>" class="react-colorpicker react-shades" />
																	<div class='react-filter-output'>
																		<div class='darken'><input type="text" name="general_color_solonav_buttonnav_background_darken" id="general_color_solonav_buttonnav_background_darken" value="<?php echo esc_attr($react['options']['general_color_solonav_buttonnav_background_darken']); ?>" class="react-dark-color-input" /></div>
																	</div>
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_buttonnav_background_hover" class="react-mini-label"><?php esc_html_e('Background:hover', 'react'); ?></label>
																	<input type="text" name="general_color_solonav_buttonnav_background_hover" id="general_color_solonav_buttonnav_background_hover" value="<?php echo esc_attr($react['options']['general_color_solonav_buttonnav_background_hover']); ?>" class="react-colorpicker" />
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_buttonnav_border" class="react-mini-label"><?php esc_html_e('Border', 'react'); ?></label>
																	<input type="text" name="general_color_solonav_buttonnav_border" id="general_color_solonav_buttonnav_border" value="<?php echo esc_attr($react['options']['general_color_solonav_buttonnav_border']); ?>" class="react-colorpicker react-shades" />
																	<div class='react-filter-output'>
																		<div class='a-touch-lighter'><input type="text" name="general_color_solonav_buttonnav_border_lighter" id="general_color_solonav_buttonnav_border_lighter" value="<?php echo esc_attr($react['options']['general_color_solonav_buttonnav_border_lighter']); ?>" class="react-light-color-input" /></div>
																	</div>
																</div>

																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_buttonnav_border_hover" class="react-mini-label"><?php esc_html_e('Border:hover', 'react'); ?></label>
																	<input type="text" name="general_color_solonav_buttonnav_border_hover" id="general_color_solonav_buttonnav_border_hover" value="<?php echo esc_attr($react['options']['general_color_solonav_buttonnav_border_hover']); ?>" class="react-colorpicker" />
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_buttonnav_icon_image" class="react-mini-label"><?php esc_html_e('Image icon', 'react'); ?></label>
																	 <select id="general_color_solonav_buttonnav_icon_image" name="general_color_solonav_buttonnav_icon_image">
																		<option value="lgt" <?php selected($react['options']['general_color_solonav_buttonnav_icon_image'], 'lgt'); ?>><?php esc_html_e('Light', 'react'); ?></option>
																		<option value="drk" <?php selected($react['options']['general_color_solonav_buttonnav_icon_image'], 'drk'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
																	</select>
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_solonav_buttonnav_gradient" class="react-mini-label"><?php esc_html_e('Gradient', 'react'); ?></label>
																	<input type="checkbox" class="react-toggle" name="general_color_solonav_buttonnav_gradient" id="general_color_solonav_buttonnav_gradient" <?php checked(true, $react['options']['general_color_solonav_buttonnav_gradient']); ?> value="1" />
																</div>
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('The colors applied to the Button style navigation inside the Solo Nav. To change the Navigation style goto: Global &rarr; Navigation &rarr; Navigation Styles', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Solo Nav Text style navigation colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_solonav_textnav_text" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
																<input type="text" name="general_color_solonav_textnav_text" id="general_color_solonav_textnav_text" value="<?php echo esc_attr($react['options']['general_color_solonav_textnav_text']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_solonav_textnav_text_hover" class="react-mini-label"><?php esc_html_e('Text:hover', 'react'); ?></label>
																<input type="text" name="general_color_solonav_textnav_text_hover" id="general_color_solonav_textnav_text_hover" value="<?php echo esc_attr($react['options']['general_color_solonav_textnav_text_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_solonav_textnav_desc" class="react-mini-label"><?php esc_html_e('Description', 'react'); ?></label>
																<input type="text" name="general_color_solonav_textnav_desc" id="general_color_solonav_textnav_desc" value="<?php echo esc_attr($react['options']['general_color_solonav_textnav_desc']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_solonav_textnav_desc_hover" class="react-mini-label"><?php esc_html_e('Description:hover', 'react'); ?></label>
																<input type="text" name="general_color_solonav_textnav_desc_hover" id="general_color_solonav_textnav_desc_hover" value="<?php echo esc_attr($react['options']['general_color_solonav_textnav_desc_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_solonav_textnav_icon_image" class="react-mini-label"><?php esc_html_e('Image icon', 'react'); ?></label>
																 <select id="general_color_solonav_textnav_icon_image" name="general_color_solonav_textnav_icon_image">
																	<option value="lgt" <?php selected($react['options']['general_color_solonav_textnav_icon_image'], 'lgt'); ?>><?php esc_html_e('Light', 'react'); ?></option>
																	<option value="drk" <?php selected($react['options']['general_color_solonav_textnav_icon_image'], 'drk'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
																</select>
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('The colors applied to the Text style navigation inside the Solo Nav. To change the Navigation style goto: Global &rarr; Navigation &rarr; Navigation Styles', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div><!-- Accordion end -->
								</div>

								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Device Menu', 'react'); ?></div>
									<div class="react-accordion-content">
										<!-- Device navigation -->
										<div class="react-table-tabs-wrap">
											<ul class="react-table-tabs-nav">
												<li><span><?php esc_html_e('Device Menu', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Top level links', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Sub level links', 'react'); ?></span></li>
											</ul>
										</div>

										<div class="react-table-tabs">
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Device Menu background colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_background" id="general_color_device_menu_background" value="<?php echo esc_attr($react['options']['general_color_device_menu_background']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='lighten'><input type="text" name="general_color_device_menu_background_lighter" id="general_color_device_menu_background_lighter" value="<?php echo esc_attr($react['options']['general_color_device_menu_background_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='darken'><input type="text" name="general_color_device_menu_background_darker" id="general_color_device_menu_background_darker" value="<?php echo esc_attr($react['options']['general_color_device_menu_background_darker']); ?>" class="react-light-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_border" class="react-mini-label"><?php esc_html_e('Border', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_border" id="general_color_device_menu_border" value="<?php echo esc_attr($react['options']['general_color_device_menu_border']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_icons" class="react-mini-label"><?php esc_html_e('Icons', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_icons" id="general_color_device_menu_icons" value="<?php echo esc_attr($react['options']['general_color_device_menu_icons']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_text" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_text" id="general_color_device_menu_text" value="<?php echo esc_attr($react['options']['general_color_device_menu_text']); ?>" class="react-colorpicker" />
																<div class='react-filter-output'>
																	<div class='even-lighter'><input type="text" name="general_color_device_menu_text_even_lighter" id="general_color_device_menu_text_even_lighter" value="<?php echo esc_attr($react['options']['general_color_device_menu_text_even_lighter']); ?>" class="react-light-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_link" class="react-mini-label"><?php esc_html_e('Links', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_link" id="general_color_device_menu_link" value="<?php echo esc_attr($react['options']['general_color_device_menu_link']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_link_hover" class="react-mini-label"><?php esc_html_e('Links:hover', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_link_hover" id="general_color_device_menu_link_hover" value="<?php echo esc_attr($react['options']['general_color_device_menu_link_hover']); ?>" class="react-colorpicker" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Create a color scheme to be applied to the Device Menu (Menu for phones and tablets) area of the theme.', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Top level links', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_main_link" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_main_link" id="general_color_device_menu_main_link" value="<?php echo esc_attr($react['options']['general_color_device_menu_main_link']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_main_link_hover" class="react-mini-label"><?php esc_html_e('Text:hover', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_main_link_hover" id="general_color_device_menu_main_link_hover" value="<?php echo esc_attr($react['options']['general_color_device_menu_main_link_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_main_desc" class="react-mini-label"><?php esc_html_e('Description', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_main_desc" id="general_color_device_menu_main_desc" value="<?php echo esc_attr($react['options']['general_color_device_menu_main_desc']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_main_desc_hover" class="react-mini-label"><?php esc_html_e('Description:hover', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_main_desc_hover" id="general_color_device_menu_main_desc_hover" value="<?php echo esc_attr($react['options']['general_color_device_menu_main_desc_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_main_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_main_background" id="general_color_device_menu_main_background" value="<?php echo esc_attr($react['options']['general_color_device_menu_main_background']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='lighten'><input type="text" name="general_color_device_menu_main_background_lighter" id="general_color_device_menu_main_background_lighter" value="<?php echo esc_attr($react['options']['general_color_device_menu_main_background_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='darken'><input type="text" name="general_color_device_menu_main_background_darker" id="general_color_device_menu_main_background_darker" value="<?php echo esc_attr($react['options']['general_color_device_menu_main_background_darker']); ?>" class="react-light-color-input" /></div>
																</div>
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Colors applied to the top level links within the Device Menu', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Sub level links', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_sub_link" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_sub_link" id="general_color_device_menu_sub_link" value="<?php echo esc_attr($react['options']['general_color_device_menu_sub_link']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_sub_link_hover" class="react-mini-label"><?php esc_html_e('Text:hover', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_sub_link_hover" id="general_color_device_menu_sub_link_hover" value="<?php echo esc_attr($react['options']['general_color_device_menu_sub_link_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_sub_desc" class="react-mini-label"><?php esc_html_e('Description', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_sub_desc" id="general_color_device_menu_sub_desc" value="<?php echo esc_attr($react['options']['general_color_device_menu_sub_desc']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_sub_desc_hover" class="react-mini-label"><?php esc_html_e('Description:hover', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_sub_desc_hover" id="general_color_device_menu_sub_desc_hover" value="<?php echo esc_attr($react['options']['general_color_device_menu_sub_desc_hover']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_device_menu_sub_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_device_menu_sub_background" id="general_color_device_menu_sub_background" value="<?php echo esc_attr($react['options']['general_color_device_menu_sub_background']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='lighten'><input type="text" name="general_color_device_menu_sub_background_lighter" id="general_color_device_menu_sub_background_lighter" value="<?php echo esc_attr($react['options']['general_color_device_menu_sub_background_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class='darken'><input type="text" name="general_color_device_menu_sub_background_darker" id="general_color_device_menu_sub_background_darker" value="<?php echo esc_attr($react['options']['general_color_device_menu_sub_background_darker']); ?>" class="react-light-color-input" /></div>
																</div>
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Colors applied to the sub level links within the Device Menu', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div><!-- Accordion end -->
								</div>

								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Slider', 'react'); ?></div>
									<div class="react-accordion-content">

										<!-- Slider colors -->
										<div class="react-table-tabs-wrap">
											<ul class="react-table-tabs-nav">
												<li><span><?php esc_html_e('Slider', 'react'); ?></span></li>
												<li><span><?php esc_html_e('More', 'react'); ?></span></li>
											</ul>
										</div>
										<div class="react-table-tabs">
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Slider main section', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_slider_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_slider_background" id="general_color_slider_background" value="<?php echo esc_attr($react['options']['general_color_slider_background']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='even-darker'><input type="text" name="general_color_slider_background_much_darker" id="general_color_slider_background_much_darker" value="<?php echo esc_attr($react['options']['general_color_slider_background_much_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class='lighten'><input type="text" name="general_color_slider_background_lighter" id="general_color_slider_background_lighter" value="<?php echo esc_attr($react['options']['general_color_slider_background_lighter']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_slider_background_gradient" class="react-mini-label"><?php esc_html_e('Gradient', 'react'); ?></label>
																<input type="checkbox" class="react-toggle" name="general_color_slider_background_gradient" id="general_color_slider_background_gradient" <?php checked(true, $react['options']['general_color_slider_background_gradient']); ?> value="1" />
															</div>
															<div class="clear"></div>
															<div class="react-multi-input-wrap">
																<label for="general_color_slider_controls_background" class="react-mini-label"><?php esc_html_e('Controls background', 'react'); ?></label>
																<input type="text" name="general_color_slider_controls_background" id="general_color_slider_controls_background" value="<?php echo esc_attr($react['options']['general_color_slider_controls_background']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='even-darker'><input type="text" name="general_color_slider_controls_background_much_darker" id="general_color_slider_controls_background_much_darker" value="<?php echo esc_attr($react['options']['general_color_slider_controls_background_much_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class='lighten'><input type="text" name="general_color_slider_controls_background_lighter" id="general_color_slider_controls_background_lighter" value="<?php echo esc_attr($react['options']['general_color_slider_controls_background_lighter']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_slider_controls_background_gradient" class="react-mini-label"><?php esc_html_e('Gradient', 'react'); ?></label>
																<input type="checkbox" class="react-toggle" name="general_color_slider_controls_background_gradient" id="general_color_slider_controls_background_gradient" <?php checked(true, $react['options']['general_color_slider_controls_background_gradient']); ?> value="1" />
															</div>
															<div class="clear"></div>
															<div class="react-multi-input-wrap">
																<label for="general_color_slider_border_lr" class="react-mini-label"><?php esc_html_e('Border left/right', 'react'); ?></label>
																<input type="text" name="general_color_slider_border_lr" id="general_color_slider_border_lr" value="<?php echo esc_attr($react['options']['general_color_slider_border_lr']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_slider_border" class="react-mini-label"><?php esc_html_e('Border', 'react'); ?></label>
																<input type="text" name="general_color_slider_border" id="general_color_slider_border" value="<?php echo esc_attr($react['options']['general_color_slider_border']); ?>" class="react-colorpicker" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Create a color scheme to be applied to the Main slider area (not for slider widget or shortcode). You must be using the React Skin for colors to take effect.', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Slider controls section', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_slider_primary_bg" class="react-mini-label"><?php esc_html_e('Primary color', 'react'); ?></label>
																<input type="text" name="general_color_slider_primary_bg" id="general_color_slider_primary_bg" value="<?php echo esc_attr($react['options']['general_color_slider_primary_bg']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_slider_dark_bg" class="react-mini-label"><?php esc_html_e('Dark color', 'react'); ?></label>
																<input type="text" name="general_color_slider_dark_bg" id="general_color_slider_dark_bg" value="<?php echo esc_attr($react['options']['general_color_slider_dark_bg']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_slider_text" class="react-mini-label"><?php esc_html_e('Text color', 'react'); ?></label>
																<input type="text" name="general_color_slider_text" id="general_color_slider_text" value="<?php echo esc_attr($react['options']['general_color_slider_text']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_slider_prime_icon_image" class="react-mini-label"><?php esc_html_e('Primary color icons', 'react'); ?></label>
																 <select id="general_color_slider_prime_icon_image" name="general_color_slider_prime_icon_image">
																	<option value="drk" <?php selected($react['options']['general_color_slider_prime_icon_image'], 'drk'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
																	<option value="lgt" <?php selected($react['options']['general_color_slider_prime_icon_image'], 'lgt'); ?>><?php esc_html_e('Light', 'react'); ?></option>
																</select>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_slider_icon_image" class="react-mini-label"><?php esc_html_e('Bullet icons', 'react'); ?></label>
																 <select id="general_color_slider_icon_image" name="general_color_slider_icon_image">
																	<option value="drk" <?php selected($react['options']['general_color_slider_icon_image'], 'drk'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
																	<option value="lgt" <?php selected($react['options']['general_color_slider_icon_image'], 'lgt'); ?>><?php esc_html_e('Light', 'react'); ?></option>
																</select>
															</div>

															<div class="react-multi-input-wrap">
																<label for="general_color_slider_dark_icon_image" class="react-mini-label"><?php esc_html_e('Dark color icons', 'react'); ?></label>
																 <select id="general_color_slider_dark_icon_image" name="general_color_slider_dark_icon_image">
																	<option value="drk" <?php selected($react['options']['general_color_slider_dark_icon_image'], 'drk'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
																	<option value="lgt" <?php selected($react['options']['general_color_slider_dark_icon_image'], 'lgt'); ?>><?php esc_html_e('Light', 'react'); ?></option>
																</select>
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Other elements within the slider area.', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div><!-- Accordion end -->
								</div>


								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Intro', 'react'); ?></div>
									<div class="react-accordion-content">
										<!-- Show if Intro off -->
										<div class="only_for_intro"><p class="react-warning"><?php esc_html_e('Intro section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
										<!-- Intro colors -->
										<div class="react-table-tabs-wrap">
											<ul class="react-table-tabs-nav">
												<li><span><?php esc_html_e('Intro', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Text', 'react'); ?></span></li>
											</ul>
										</div>
										<div class="react-table-tabs">
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Intro background colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_intro_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_intro_background" id="general_color_intro_background" value="<?php echo esc_attr($react['options']['general_color_intro_background']); ?>" class="react-colorpicker react-shades" />
																<div class="react-filter-output">
																	<div class="even-darker"><input type="text" name="general_color_intro_background_even_darker" id="general_color_intro_background_even_darker" value="<?php echo esc_attr($react['options']['general_color_intro_background_even_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class="darken"><input type="text" name="general_color_intro_background_darker" id="general_color_intro_background_darker" value="<?php echo esc_attr($react['options']['general_color_intro_background_darker']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_intro_border" class="react-mini-label"><?php esc_html_e('Border', 'react'); ?></label>
																<input type="text" name="general_color_intro_border" id="general_color_intro_border" value="<?php echo esc_attr($react['options']['general_color_intro_border']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_intro_border_lr" class="react-mini-label"><?php esc_html_e('Border left/right', 'react'); ?></label>
																<input type="text" name="general_color_intro_border_lr" id="general_color_intro_border_lr" value="<?php echo esc_attr($react['options']['general_color_intro_border_lr']); ?>" class="react-colorpicker" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Create a color scheme to be applied to the Intro section of the theme.', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
											<div class="react-table-tab">

												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Intro text colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap">
																<label for="general_color_intro_h1" class="react-mini-label"><?php esc_html_e('Heading', 'react'); ?></label>
																<input type="text" name="general_color_intro_h1" id="general_color_intro_h1" value="<?php echo esc_attr($react['options']['general_color_intro_h1']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_intro_h2" class="react-mini-label"><?php esc_html_e('Sub heading', 'react'); ?></label>
																<input type="text" name="general_color_intro_h2" id="general_color_intro_h2" value="<?php echo esc_attr($react['options']['general_color_intro_h2']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_intro_h2_icon" class="react-mini-label"><?php esc_html_e('Icons', 'react'); ?></label>
																<input type="text" name="general_color_intro_h2_icon" id="general_color_intro_h2_icon" value="<?php echo esc_attr($react['options']['general_color_intro_h2_icon']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_intro_links" class="react-mini-label"><?php esc_html_e('Links', 'react'); ?></label>
																<input type="text" name="general_color_intro_links" id="general_color_intro_links" value="<?php echo esc_attr($react['options']['general_color_intro_links']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_intro_links_hover" class="react-mini-label"><?php esc_html_e('Link:hover', 'react'); ?></label>
																<input type="text" name="general_color_intro_links_hover" id="general_color_intro_links_hover" value="<?php echo esc_attr($react['options']['general_color_intro_links_hover']); ?>" class="react-colorpicker" />
															</div>

															<div class="react-multi-input-wrap">
																<label for="general_color_intro_text" class="react-mini-label"><?php esc_html_e('Other text', 'react'); ?></label>
																<input type="text" name="general_color_intro_text" id="general_color_intro_text" value="<?php echo esc_attr($react['options']['general_color_intro_text']); ?>" class="react-colorpicker" />
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Colors applied to the headings and links within the Intro section', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div><!-- Accordion end -->
								</div>


								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Content Area (Select a Palette optional)', 'react'); ?></div>
									<div class="react-accordion-content">

										<!-- content area colors -->
										<div class="react-table-tabs-wrap">
											<ul class="react-table-tabs-nav">
												<li><span><?php esc_html_e('Content', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Text', 'react'); ?></span></li>
											</ul>
										</div>
										<div class="react-table-tabs">
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Content background colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field or choose a Color Palette', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap hide-if-scheme-selected">
																<label for="general_color_content_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_content_background" id="general_color_content_background" value="<?php echo esc_attr($react['options']['general_color_content_background']); ?>" class="react-colorpicker react-shades" />
																<div class="react-filter-output">
																	<div class="much-lighter"><input type="text" name="general_color_content_background_much_lighter" id="general_color_content_background_much_lighter" value="<?php echo esc_attr($react['options']['general_color_content_background_much_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class="even-lighter"><input type="text" name="general_color_content_background_even_lighter" id="general_color_content_background_even_lighter" value="<?php echo esc_attr($react['options']['general_color_content_background_even_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class="lighten"><input type="text" name="general_color_content_background_lighter" id="general_color_content_background_lighter" value="<?php echo esc_attr($react['options']['general_color_content_background_lighter']); ?>" class="react-light-color-input" /></div>
																	<div class="even-darker"><input type="text" name="general_color_content_background_even_darker" id="general_color_content_background_even_darker" value="<?php echo esc_attr($react['options']['general_color_content_background_even_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class="darken"><input type="text" name="general_color_content_background_darker" id="general_color_content_background_darker" value="<?php echo esc_attr($react['options']['general_color_content_background_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class="touch-darker"><input type="text" name="general_color_content_background_touch_darker" id="general_color_content_background_touch_darker" value="<?php echo esc_attr($react['options']['general_color_content_background_touch_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class="much-darker"><input type="text" name="general_color_content_background_much_darker" id="general_color_content_background_much_darker" value="<?php echo esc_attr($react['options']['general_color_content_background_much_darker']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap hide-if-scheme-selected">
																<label for="general_color_content_border" class="react-mini-label"><?php esc_html_e('Border', 'react'); ?></label>
																<input type="text" name="general_color_content_border" id="general_color_content_border" value="<?php echo esc_attr($react['options']['general_color_content_border']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap hide-if-scheme-selected">
																<label for="general_color_content_border_lr" class="react-mini-label"><?php esc_html_e('Border left/right', 'react'); ?></label>
																<input type="text" name="general_color_content_border_lr" id="general_color_content_border_lr" value="<?php echo esc_attr($react['options']['general_color_content_border_lr']); ?>" class="react-colorpicker" />
															</div>
															<div class="show-if-scheme-selected"><p class="react-warning"><?php esc_html_e('Your Color Palette is now overriding the default colors. Select "None" to convert to defaults.', 'react'); ?></p></div>
															<div class="clear"></div>
															<div class="react-multi-input-wrap">
															<label for="general_color_content_choose_scheme" class="react-mini-label"><b><?php esc_html_e('OR, Choose a Color Palette', 'react'); ?></b></label>
																<select id="general_color_content_choose_scheme" name="general_color_content_choose_scheme" class="react-custom-palette-selector">
																	<option value="" <?php selected($react['options']['general_color_content_choose_scheme'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
																	<?php echo react_render_custom_palette_options($react['options']['general_color_content_choose_scheme']); ?>
																</select>
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Create a color scheme to be applied to the Main Content area of the theme. These colors are for basic adjustments, for more advanced colors select a Color Palette. Color Palettes can be created at the bottom of this page.', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Content area text colors', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a Color Palette', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															 <div class="react-multi-input-wrap hide-if-scheme-selected">
																<label for="general_color_content_text" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
																<input type="text" name="general_color_content_text" id="general_color_content_text" value="<?php echo esc_attr($react['options']['general_color_content_text']); ?>" class="react-colorpicker react-shades" />
																<div class='react-filter-output'>
																	<div class='even-darker'><input type="text" name="general_color_content_text_even_darker" id="general_color_content_text_even_darker" value="<?php echo esc_attr($react['options']['general_color_content_text_even_darker']); ?>" class="react-dark-color-input" /></div>
																	<div class='even-lighter'><input type="text" name="general_color_content_text_even_lighter" id="general_color_content_text_even_lighter" value="<?php echo esc_attr($react['options']['general_color_content_text_even_lighter']); ?>" class="react-dark-color-input" /></div>
																</div>
															</div>
															<div class="react-multi-input-wrap hide-if-scheme-selected">
																<label for="general_color_content_text_alt" class="react-mini-label"><?php esc_html_e('Alternative text', 'react'); ?></label>
																<input type="text" name="general_color_content_text_alt" id="general_color_content_text_alt" value="<?php echo esc_attr($react['options']['general_color_content_text_alt']); ?>" class="react-colorpicker" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="general_color_content_icon_image" class="react-mini-label"><?php esc_html_e('Image icons', 'react'); ?></label>
																<select id="general_color_content_icon_image" name="general_color_content_icon_image">
																	<option value="drk" <?php selected($react['options']['general_color_content_icon_image'], 'drk'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
																	<option value="lgt" <?php selected($react['options']['general_color_content_icon_image'], 'lgt'); ?>><?php esc_html_e('Light', 'react'); ?></option>
																</select>
															</div>

															 <div class="show-if-scheme-selected"><p class="react-warning"><?php esc_html_e('Your Color Palette is now overriding the default colors. Select "None" to convert to defaults.', 'react'); ?></p></div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Colors applied to the Text within the Content area', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div><!-- Accordion end -->
								</div>

								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Pop Down (Select a Palette)', 'react'); ?></div>
									<div class="react-accordion-content">
										<!-- Show if Pop Down off -->
										<div class="only_for_popdown"><p class="react-warning"><?php esc_html_e('Pop Down section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
										<!-- Pop Down colors -->
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Pop Down background color', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a Color Palette', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row ">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
													<label for="general_color_popdown_choose_scheme" class="react-mini-label"><?php esc_html_e('Choose a Color Palette', 'react'); ?></label>
														<select id="general_color_popdown_choose_scheme" name="general_color_popdown_choose_scheme" class="react-custom-palette-selector">
															<option value="" <?php selected($react['options']['general_color_popdown_choose_scheme'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
															<?php echo react_render_custom_palette_options($react['options']['general_color_popdown_choose_scheme']); ?>
														</select>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Color Palettes can be applied here. This adds color to elements (widgets and shortcodes) used inside the Pop Down. Color Palettes can be created at the bottom of this page.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div><!-- Accordion end -->
								</div>

								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Main Footer (Select a Palette)', 'react'); ?></div>
									<div class="react-accordion-content">
										<!-- Main Footer -->
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Footer background colors', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field or choose a Color Palette', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
													<label for="general_color_footer_choose_scheme" class="react-mini-label"><?php esc_html_e('Choose a Color Palette', 'react'); ?></label>
													   <select id="general_color_footer_choose_scheme" name="general_color_footer_choose_scheme" class="react-custom-palette-selector">
															<option value="" <?php selected($react['options']['general_color_footer_choose_scheme'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
															<?php echo react_render_custom_palette_options($react['options']['general_color_footer_choose_scheme']); ?>
														</select>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Color Palettes can be applied here. This adds color to elements (widgets and shortcodes) used inside the Main Footer. Color Palettes can be created at the bottom of this page.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div><!-- Accordion end -->
								</div>

								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Sub Footer (Select a Palette optional)', 'react'); ?></div>
									<div class="react-accordion-content">
										<!-- Show if Sub Footer off -->
										<div class="only_for_subfooter"><p class="react-warning"><?php esc_html_e('Sub Footer section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
										<!-- Sub Footer -->
										<div class="react-table-tabs-wrap">
											<ul class="react-table-tabs-nav">
												<li><span><?php esc_html_e('Sub Footer', 'react'); ?></span></li>
												<li><span><?php esc_html_e('Text', 'react'); ?></span></li>
											</ul>
										</div>
										<div class="react-table-tabs">
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Sub Footer background color', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row">
														<td class="react-form-table-input-area-td">
															<div class="react-multi-input-wrap hide-if-scheme-selected-subfoot">
																<label for="general_color_subfooter_background" class="react-mini-label"><?php esc_html_e('Background', 'react'); ?></label>
																<input type="text" name="general_color_subfooter_background" id="general_color_subfooter_background" value="<?php echo esc_attr($react['options']['general_color_subfooter_background']); ?>" class="react-colorpicker" />
															</div>
															<div class="show-if-scheme-selected-subfoot"><p class="react-warning"><?php esc_html_e('Your Color Palette is now overriding the default colors. Select "None" to convert to defaults.', 'react'); ?></p></div>
															<div class="clear"></div>
															<div class="react-multi-input-wrap">
																<label for="general_color_subfoot_choose_scheme" class="react-mini-label"><b><?php esc_html_e('OR, Choose a Color Palette', 'react'); ?></b></label>
																<select id="general_color_subfoot_choose_scheme" name="general_color_subfoot_choose_scheme" class="react-custom-palette-selector">
																	<option value="" <?php selected($react['options']['general_color_subfoot_choose_scheme'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
																	<?php echo react_render_custom_palette_options($react['options']['general_color_subfoot_choose_scheme']); ?>
																 </select>
															</div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Create a color scheme to be applied to the Sub Footer area of the theme. These colors are for basic adjustments, for more advanced colors select a Color Palette. Color Palettes can be created at the bottom of this page.', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
											<div class="react-table-tab">
												<table class="react-form-table react-tab-1-form-table">
													<tr class="react-settings-sub-head">
														<th colspan="2">
															<label><?php esc_html_e('Sub Footer area text color', 'react'); ?></label>
															<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a color using the color picker or add the hex or RGB(A) code in the field', 'react'); ?></span></span>
														</th>
													</tr>
													<tr class="react-content-row react-content-input-has-many">
														<td class="react-form-table-input-area-td">
															<div class="hide-if-scheme-selected-subfoot">
																<div class="react-multi-input-wrap">
																	<label for="general_color_subfooter_text" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
																	<input type="text" name="general_color_subfooter_text" id="general_color_subfooter_text" value="<?php echo esc_attr($react['options']['general_color_subfooter_text']); ?>" class="react-colorpicker" />
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_subfooter_link" class="react-mini-label"><?php esc_html_e('Links', 'react'); ?></label>
																	<input type="text" name="general_color_subfooter_link" id="general_color_subfooter_link" value="<?php echo esc_attr($react['options']['general_color_subfooter_link']); ?>" class="react-colorpicker" />
																</div>
																<div class="react-multi-input-wrap">
																	<label for="general_color_subfooter_link_hover" class="react-mini-label"><?php esc_html_e('Links:hover', 'react'); ?></label>
																	<input type="text" name="general_color_subfooter_link_hover" id="general_color_subfooter_link_hover" value="<?php echo esc_attr($react['options']['general_color_subfooter_link_hover']); ?>" class="react-colorpicker" />
																</div>
															</div>
															<div class="show-if-scheme-selected-subfoot"><p class="react-warning"><?php esc_html_e('Your Color Palette is now overriding the default colors. Select "None" to convert to defaults.', 'react'); ?></p></div>
														</td>
														<td class="react-form-table-desc-td">
															<p class="react-description"><?php esc_html_e('Colors applied to the text and links within the Sub Footer area', 'react'); ?></p>
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div><!-- Accordion end -->
								</div>

								<div class="react-break"></div>

								<h2 class="react-panel-section-header"><?php esc_html_e('Custom Color Palettes', 'react'); ?></h2>
								<!-- palettes  -->
								<div class="react-clearfix react-add-custom-palette-wrap">
									<div id="react-add-custom-palette" class="react-button react-orange react-add"><span></span><?php esc_html_e('Add a color palette', 'react'); ?></div>
									<div class="react-add-custom-palette-description"><?php esc_html_e('Add a Custom Color Palette that can be applied to many areas of the theme and to the Block shortcode.', 'react'); ?></div>
								</div>
								<div id="react-custom-palettes">
									<?php
										foreach ($react['options']['custom_palettes'] as $palette) {
											echo react_custom_palette_html($palette);
										}
									?>
								</div>

							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Choose Fonts', 'react'); ?></h2>


								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Font sizes', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
											<label for="general_heading_size" class="react-mini-label"><?php esc_html_e('Heading font size', 'react'); ?></label>
												<select name="general_heading_size" id="general_heading_size">
													<option value="" <?php selected($react['options']['general_heading_size'], ''); ?>><?php esc_html_e('Default', 'react'); ?></option>
													<option value="med" <?php selected($react['options']['general_heading_size'], 'med'); ?>><?php esc_html_e('Medium', 'react'); ?></option>
													<option value="lrg" <?php selected($react['options']['general_heading_size'], 'lrg'); ?>><?php esc_html_e('Large', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="general_font_size" class="react-mini-label"><?php esc_html_e('Global font size', 'react'); ?></label>
												<input type="text" name="general_font_size" id="general_font_size" value="<?php echo esc_attr($react['options']['general_font_size']); ?>" class="react-range-slider react-width-50" data-from="10" data-to="17" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
											<div class="react-break"></div>
											<div class="react-multi-input-wrap">
												<label for="general_heading_spacing" class="react-mini-label"><?php esc_html_e('Global letter spacing', 'react'); ?></label>
												<input type="text" name="general_heading_spacing" id="general_heading_spacing" value="<?php echo esc_attr($react['options']['general_heading_spacing']); ?>" class="react-range-slider react-width-50" data-from="-5" data-to="9" data-step="1" data-dimension="" /><span class="react-range-unit">x 0.01em</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Adjust global default font sizes for headings and the global font size for all content.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<!-- Font face -->
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Headings', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Content', 'react'); ?></span></li>
									</ul>
								</div>

								<div class="react-table-tabs react-font-tab">

									<div class="react-table-tab">

										<table class="react-form-table react-multi-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th>
													<label for="general_font"><?php esc_html_e('Choose a Header font type', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a heading font for your site', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td id="react-heading-font-wrap" class="react-form-table-input-area-td">
													<select id="general_font" name="general_font">
														<option value="" <?php selected($react['options']['general_font'], ''); ?>><?php esc_html_e('No font replacement', 'react'); ?></option>
														<option value="google" <?php selected($react['options']['general_font'], 'google'); ?>><?php esc_html_e('Google font', 'react'); ?></option>
													</select>
												</td>
											</tr>
										</table>

										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="general_font_google_link"><?php esc_html_e('Google font stylesheet', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('The stylesheet link tag can be found when you click the plus icon on your selected font', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<textarea name="general_font_google_link" id="general_font_google_link"><?php echo esc_textarea($react['options']['general_font_google_link']); ?></textarea>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php printf(esc_html__('Enter the complete stylesheet link tag from the %s.', 'react'), sprintf('<a href="' . esc_url($googleFontsUrl) . '" class="react-external-link">%s</a>', esc_html__('Google font preview site', 'react'))); ?><br />
													<?php printf(esc_html__('For example: %s', 'react'), '<code>' . esc_html("<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>") . '</code>'); ?></p>
												</td>
											</tr>
										</table>

										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="general_font_google_family"><?php esc_html_e('Google font family', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('The font family example can be found in Step 4 of the Quick-use page on the Google Fonts website', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="general_font_google_family" id="general_font_google_family" value="<?php echo esc_attr($react['options']['general_font_google_family']); ?>" class="react-width-400" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php printf(esc_html__('Enter the complete font-family example from the %s.', 'react'), sprintf('<a href="' . esc_url($googleFontsUrl) . '" class="react-external-link">%s</a>', esc_html__('Google font preview site', 'react'))); ?><br />
													<?php printf(esc_html__('For example: %s', 'react'), "<code>font-family: 'Open Sans', sans-serif;</code>"); ?></p>
												</td>
											</tr>
										</table>

										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="general_font_selector"><?php esc_html_e('CSS selectors for heading font', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Find the CSS class / selector of the text you want to apply the font to and add it below', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<textarea name="general_font_selector" id="general_font_selector"><?php echo esc_textarea($react['options']['general_font_selector']); ?></textarea>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Enter the CSS selectors you want to apply your chosen font to.', 'react'); ?></p>
												</td>
											</tr>
										</table>

										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="general_font_fullscreen"><?php esc_html_e('Apply Heading font to background image captions', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle-yn" name="general_font_fullscreen" id="general_font_fullscreen" <?php checked(true, $react['options']['general_font_fullscreen']); ?> value="1" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The font will be applied to the full screen background caption titles.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="general_font_portfolio"><?php esc_html_e('Apply Heading font to portfolio item titles', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle-yn" name="general_font_portfolio" id="general_font_portfolio" <?php checked(true, $react['options']['general_font_portfolio']); ?> value="1" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The font will be applied to titles in the portfolio shortcode.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="general_font_serene"><?php esc_html_e('Apply Heading font to Serene caption titles', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle-yn" name="general_font_serene" id="general_font_serene" <?php checked(true, $react['options']['general_font_serene']); ?> value="1" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The font will be applied to titles in the Serene (full screen gallery) captions.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="general_font_fancybox"><?php esc_html_e('Apply Heading font to FancyBox caption titles', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle-yn" name="general_font_fancybox" id="general_font_fancybox" <?php checked(true, $react['options']['general_font_fancybox']); ?> value="1" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The font will be applied to titles in the FancyBox captions.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<!-- Style Htags -->
										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head ">
												<th colspan="2">
													<label for="general_font_h1_up"><?php esc_html_e('Style H1', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_font_h1_up" class="react-mini-label"><?php esc_html_e('Uppercase', 'react'); ?></label>
														<input type="checkbox" class="react-toggle-yn" name="general_font_h1_up" id="general_font_h1_up" <?php checked(true, $react['options']['general_font_h1_up']); ?> value="1" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h1_fw" class="react-mini-label"><?php esc_html_e('Weight', 'react'); ?></label>
														<select id="general_font_h1_fw" name="general_font_h1_fw">
															<option value="" <?php selected($react['options']['general_font_h1_fw'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
															<option value="100" <?php selected($react['options']['general_font_h1_fw'], '100'); ?>>100</option>
															<option value="200" <?php selected($react['options']['general_font_h1_fw'], '200'); ?>>200</option>
															<option value="300" <?php selected($react['options']['general_font_h1_fw'], '300'); ?>>300</option>
															<option value="400" <?php selected($react['options']['general_font_h1_fw'], '400'); ?>>400</option>
															<option value="500" <?php selected($react['options']['general_font_h1_fw'], '500'); ?>>500</option>
															<option value="600" <?php selected($react['options']['general_font_h1_fw'], '600'); ?>>600</option>
															<option value="700" <?php selected($react['options']['general_font_h1_fw'], '700'); ?>>700</option>
															<option value="800" <?php selected($react['options']['general_font_h1_fw'], '800'); ?>>800</option>
														</select>
													</div>
													<div class="react-break"></div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h1_space" class="react-mini-label"><?php esc_html_e('Spacing', 'react'); ?></label>
														<input type="text" name="general_font_h1_space" id="general_font_h1_space" value="<?php echo esc_attr($react['options']['general_font_h1_space']); ?>" class="react-range-slider react-width-50" data-from="-5" data-to="15" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h1_size" class="react-mini-label"><?php esc_html_e('Font size', 'react'); ?></label>
														<input type="text" name="general_font_h1_size" id="general_font_h1_size" value="<?php echo esc_attr($react['options']['general_font_h1_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="150" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h1_mobile_friendly_size" class="react-mini-label"><?php esc_html_e('Mobile font size', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose a new font size for small mobile devices. Select 0 for no change.', 'react'); ?></span></span></label>
														<input type="text" name="general_font_h1_mobile_friendly_size" id="general_font_h1_mobile_friendly_size" value="<?php echo esc_attr($react['options']['general_font_h1_mobile_friendly_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="40" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('This will be the new global default values for this heading tag. Fancy heading shortcode can be adjusted individually.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head ">
												<th colspan="2">
													<label for="general_font_h2_up"><?php esc_html_e('Style H2', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_font_h2_up" class="react-mini-label"><?php esc_html_e('Uppercase', 'react'); ?></label>
														<input type="checkbox" class="react-toggle-yn" name="general_font_h2_up" id="general_font_h2_up" <?php checked(true, $react['options']['general_font_h2_up']); ?> value="1" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h2_fw" class="react-mini-label"><?php esc_html_e('Weight', 'react'); ?></label>
														<select id="general_font_h2_fw" name="general_font_h2_fw">
															<option value="" <?php selected($react['options']['general_font_h2_fw'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
															<option value="100" <?php selected($react['options']['general_font_h2_fw'], '100'); ?>>100</option>
															<option value="200" <?php selected($react['options']['general_font_h2_fw'], '200'); ?>>200</option>
															<option value="300" <?php selected($react['options']['general_font_h2_fw'], '300'); ?>>300</option>
															<option value="400" <?php selected($react['options']['general_font_h2_fw'], '400'); ?>>400</option>
															<option value="500" <?php selected($react['options']['general_font_h2_fw'], '500'); ?>>500</option>
															<option value="600" <?php selected($react['options']['general_font_h2_fw'], '600'); ?>>600</option>
															<option value="700" <?php selected($react['options']['general_font_h2_fw'], '700'); ?>>700</option>
															<option value="800" <?php selected($react['options']['general_font_h2_fw'], '800'); ?>>800</option>
														</select>
													</div>
													<div class="react-break"></div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h2_space" class="react-mini-label"><?php esc_html_e('Spacing', 'react'); ?></label>
														<input type="text" name="general_font_h2_space" id="general_font_h2_space" value="<?php echo esc_attr($react['options']['general_font_h2_space']); ?>" class="react-range-slider react-width-50" data-from="-5" data-to="15" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h2_size" class="react-mini-label"><?php esc_html_e('Font size', 'react'); ?></label>
														<input type="text" name="general_font_h2_size" id="general_font_h2_size" value="<?php echo esc_attr($react['options']['general_font_h2_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="150" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h2_mobile_friendly_size" class="react-mini-label"><?php esc_html_e('Mobile font size', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose a new font size for small mobile devices. Select 0 for no change.', 'react'); ?></span></span></label>
														<input type="text" name="general_font_h2_mobile_friendly_size" id="general_font_h2_mobile_friendly_size" value="<?php echo esc_attr($react['options']['general_font_h2_mobile_friendly_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="40" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('This will be the new global default values for this heading tag. Fancy heading shortcode can be adjusted individually.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head ">
												<th colspan="2">
													<label for="general_font_h3_up"><?php esc_html_e('Style H3', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_font_h3_up" class="react-mini-label"><?php esc_html_e('Uppercase', 'react'); ?></label>
														<input type="checkbox" class="react-toggle-yn" name="general_font_h3_up" id="general_font_h3_up" <?php checked(true, $react['options']['general_font_h3_up']); ?> value="1" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h3_fw" class="react-mini-label"><?php esc_html_e('Weight', 'react'); ?></label>
														<select id="general_font_h3_fw" name="general_font_h3_fw">
															<option value="" <?php selected($react['options']['general_font_h3_fw'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
															<option value="100" <?php selected($react['options']['general_font_h3_fw'], '100'); ?>>100</option>
															<option value="200" <?php selected($react['options']['general_font_h3_fw'], '200'); ?>>200</option>
															<option value="300" <?php selected($react['options']['general_font_h3_fw'], '300'); ?>>300</option>
															<option value="400" <?php selected($react['options']['general_font_h3_fw'], '400'); ?>>400</option>
															<option value="500" <?php selected($react['options']['general_font_h3_fw'], '500'); ?>>500</option>
															<option value="600" <?php selected($react['options']['general_font_h3_fw'], '600'); ?>>600</option>
															<option value="700" <?php selected($react['options']['general_font_h3_fw'], '700'); ?>>700</option>
															<option value="800" <?php selected($react['options']['general_font_h3_fw'], '800'); ?>>800</option>
														</select>
													</div>
													<div class="react-break"></div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h3_space" class="react-mini-label"><?php esc_html_e('Spacing', 'react'); ?></label>
														<input type="text" name="general_font_h3_space" id="general_font_h3_space" value="<?php echo esc_attr($react['options']['general_font_h3_space']); ?>" class="react-range-slider react-width-50" data-from="-5" data-to="15" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h3_size" class="react-mini-label"><?php esc_html_e('Font size', 'react'); ?></label>
														<input type="text" name="general_font_h3_size" id="general_font_h3_size" value="<?php echo esc_attr($react['options']['general_font_h3_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="150" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h3_mobile_friendly_size" class="react-mini-label"><?php esc_html_e('Mobile font size', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose a new font size for small mobile devices. Select 0 for no change.', 'react'); ?></span></span></label>
														<input type="text" name="general_font_h3_mobile_friendly_size" id="general_font_h3_mobile_friendly_size" value="<?php echo esc_attr($react['options']['general_font_h3_mobile_friendly_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="40" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('This will be the new global default values for this heading tag. Fancy heading shortcode can be adjusted individually.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head ">
												<th colspan="2">
													<label for="general_font_h4_up"><?php esc_html_e('Style H4', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_font_h4_up" class="react-mini-label"><?php esc_html_e('Uppercase', 'react'); ?></label>
														<input type="checkbox" class="react-toggle-yn" name="general_font_h4_up" id="general_font_h4_up" <?php checked(true, $react['options']['general_font_h4_up']); ?> value="1" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h4_fw" class="react-mini-label"><?php esc_html_e('Weight', 'react'); ?></label>
														<select id="general_font_h4_fw" name="general_font_h4_fw">
															<option value="" <?php selected($react['options']['general_font_h4_fw'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
															<option value="100" <?php selected($react['options']['general_font_h4_fw'], '100'); ?>>100</option>
															<option value="200" <?php selected($react['options']['general_font_h4_fw'], '200'); ?>>200</option>
															<option value="300" <?php selected($react['options']['general_font_h4_fw'], '300'); ?>>300</option>
															<option value="400" <?php selected($react['options']['general_font_h4_fw'], '400'); ?>>400</option>
															<option value="500" <?php selected($react['options']['general_font_h4_fw'], '500'); ?>>500</option>
															<option value="600" <?php selected($react['options']['general_font_h4_fw'], '600'); ?>>600</option>
															<option value="700" <?php selected($react['options']['general_font_h4_fw'], '700'); ?>>700</option>
															<option value="800" <?php selected($react['options']['general_font_h4_fw'], '800'); ?>>800</option>
														</select>
													</div>
													<div class="react-break"></div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h4_space" class="react-mini-label"><?php esc_html_e('Spacing', 'react'); ?></label>
														<input type="text" name="general_font_h4_space" id="general_font_h4_space" value="<?php echo esc_attr($react['options']['general_font_h4_space']); ?>" class="react-range-slider react-width-50" data-from="-5" data-to="15" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h4_size" class="react-mini-label"><?php esc_html_e('Font size', 'react'); ?></label>
														<input type="text" name="general_font_h4_size" id="general_font_h4_size" value="<?php echo esc_attr($react['options']['general_font_h4_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="150" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h4_mobile_friendly_size" class="react-mini-label"><?php esc_html_e('Mobile font size', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose a new font size for small mobile devices. Select 0 for no change.', 'react'); ?></span></span></label>
														<input type="text" name="general_font_h4_mobile_friendly_size" id="general_font_h4_mobile_friendly_size" value="<?php echo esc_attr($react['options']['general_font_h4_mobile_friendly_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="40" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('This will be the new global default values for this heading tag. Fancy heading shortcode can be adjusted individually.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head ">
												<th colspan="2">
													<label for="general_font_h5_up"><?php esc_html_e('Style H5', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_font_h5_up" class="react-mini-label"><?php esc_html_e('Uppercase', 'react'); ?></label>
														<input type="checkbox" class="react-toggle-yn" name="general_font_h5_up" id="general_font_h5_up" <?php checked(true, $react['options']['general_font_h5_up']); ?> value="1" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h5_fw" class="react-mini-label"><?php esc_html_e('Weight', 'react'); ?></label>
														<select id="general_font_h5_fw" name="general_font_h5_fw">
															<option value="" <?php selected($react['options']['general_font_h5_fw'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
															<option value="100" <?php selected($react['options']['general_font_h5_fw'], '100'); ?>>100</option>
															<option value="200" <?php selected($react['options']['general_font_h5_fw'], '200'); ?>>200</option>
															<option value="300" <?php selected($react['options']['general_font_h5_fw'], '300'); ?>>300</option>
															<option value="400" <?php selected($react['options']['general_font_h5_fw'], '400'); ?>>400</option>
															<option value="500" <?php selected($react['options']['general_font_h5_fw'], '500'); ?>>500</option>
															<option value="600" <?php selected($react['options']['general_font_h5_fw'], '600'); ?>>600</option>
															<option value="700" <?php selected($react['options']['general_font_h5_fw'], '700'); ?>>700</option>
															<option value="800" <?php selected($react['options']['general_font_h5_fw'], '800'); ?>>800</option>
														</select>
													</div>
													<div class="react-break"></div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h5_space" class="react-mini-label"><?php esc_html_e('Spacing', 'react'); ?></label>
														<input type="text" name="general_font_h5_space" id="general_font_h5_space" value="<?php echo esc_attr($react['options']['general_font_h5_space']); ?>" class="react-range-slider react-width-50" data-from="-5" data-to="15" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h5_size" class="react-mini-label"><?php esc_html_e('Font size', 'react'); ?></label>
														<input type="text" name="general_font_h5_size" id="general_font_h5_size" value="<?php echo esc_attr($react['options']['general_font_h5_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="150" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_h5_mobile_friendly_size" class="react-mini-label"><?php esc_html_e('Mobile font size', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose a new font size for small mobile devices. Select 0 for no change.', 'react'); ?></span></span></label>
														<input type="text" name="general_font_h5_mobile_friendly_size" id="general_font_h5_mobile_friendly_size" value="<?php echo esc_attr($react['options']['general_font_h5_mobile_friendly_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="40" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('This will be the new global default values for this heading tag. Fancy heading shortcode can be adjusted individually.', 'react'); ?></p>
												</td>
											</tr>
										</table>

										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head ">
												<th colspan="2">
													<label for="general_font_intro_up"><?php esc_html_e('Style Intro H1', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_font_intro_up" class="react-mini-label"><?php esc_html_e('Uppercase', 'react'); ?></label>
														<input type="checkbox" class="react-toggle-yn" name="general_font_intro_up" id="general_font_intro_up" <?php checked(true, $react['options']['general_font_intro_up']); ?> value="1" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_intro_fw" class="react-mini-label"><?php esc_html_e('Weight', 'react'); ?></label>
														<select id="general_font_intro_fw" name="general_font_intro_fw">
															<option value="" <?php selected($react['options']['general_font_intro_fw'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
															<option value="100" <?php selected($react['options']['general_font_intro_fw'], '100'); ?>>100</option>
															<option value="200" <?php selected($react['options']['general_font_intro_fw'], '200'); ?>>200</option>
															<option value="300" <?php selected($react['options']['general_font_intro_fw'], '300'); ?>>300</option>
															<option value="400" <?php selected($react['options']['general_font_intro_fw'], '400'); ?>>400</option>
															<option value="500" <?php selected($react['options']['general_font_intro_fw'], '500'); ?>>500</option>
															<option value="600" <?php selected($react['options']['general_font_intro_fw'], '600'); ?>>600</option>
															<option value="700" <?php selected($react['options']['general_font_intro_fw'], '700'); ?>>700</option>
															<option value="800" <?php selected($react['options']['general_font_intro_fw'], '800'); ?>>800</option>
														</select>
													</div>
													<div class="react-break"></div>
													<div class="react-multi-input-wrap">
														<label for="general_font_intro_space" class="react-mini-label"><?php esc_html_e('Spacing', 'react'); ?></label>
														<input type="text" name="general_font_intro_space" id="general_font_intro_space" value="<?php echo esc_attr($react['options']['general_font_intro_space']); ?>" class="react-range-slider react-width-50" data-from="-5" data-to="15" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_intro_size" class="react-mini-label"><?php esc_html_e('Font size', 'react'); ?></label>
														<input type="text" name="general_font_intro_size" id="general_font_intro_size" value="<?php echo esc_attr($react['options']['general_font_intro_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="150" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_intro_mobile_friendly_size" class="react-mini-label"><?php esc_html_e('Mobile font size', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose a new font size for small mobile devices. Select 0 for no change.', 'react'); ?></span></span></label>
														<input type="text" name="general_font_intro_mobile_friendly_size" id="general_font_intro_mobile_friendly_size" value="<?php echo esc_attr($react['options']['general_font_intro_mobile_friendly_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="40" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('This will be the new global default values for this heading tag. Fancy heading shortcode can be adjusted individually.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head ">
												<th colspan="2">
													<label for="general_font_intro_sub_up"><?php esc_html_e('Style Intro H2', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_font_intro_sub_up" class="react-mini-label"><?php esc_html_e('Uppercase', 'react'); ?></label>
														<input type="checkbox" class="react-toggle-yn" name="general_font_intro_sub_up" id="general_font_intro_sub_up" <?php checked(true, $react['options']['general_font_intro_sub_up']); ?> value="1" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_intro_sub_fw" class="react-mini-label"><?php esc_html_e('Weight', 'react'); ?></label>
														<select id="general_font_intro_sub_fw" name="general_font_intro_sub_fw">
															<option value="" <?php selected($react['options']['general_font_intro_sub_fw'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
															<option value="100" <?php selected($react['options']['general_font_intro_sub_fw'], '100'); ?>>100</option>
															<option value="200" <?php selected($react['options']['general_font_intro_sub_fw'], '200'); ?>>200</option>
															<option value="300" <?php selected($react['options']['general_font_intro_sub_fw'], '300'); ?>>300</option>
															<option value="400" <?php selected($react['options']['general_font_intro_sub_fw'], '400'); ?>>400</option>
															<option value="500" <?php selected($react['options']['general_font_intro_sub_fw'], '500'); ?>>500</option>
															<option value="600" <?php selected($react['options']['general_font_intro_sub_fw'], '600'); ?>>600</option>
															<option value="700" <?php selected($react['options']['general_font_intro_sub_fw'], '700'); ?>>700</option>
															<option value="800" <?php selected($react['options']['general_font_intro_sub_fw'], '800'); ?>>800</option>
														</select>
													</div>
													<div class="react-break"></div>
													<div class="react-multi-input-wrap">
														<label for="general_font_intro_sub_space" class="react-mini-label"><?php esc_html_e('Spacing', 'react'); ?></label>
														<input type="text" name="general_font_intro_sub_space" id="general_font_intro_sub_space" value="<?php echo esc_attr($react['options']['general_font_intro_sub_space']); ?>" class="react-range-slider react-width-50" data-from="-5" data-to="15" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_intro_sub_size" class="react-mini-label"><?php esc_html_e('Font size', 'react'); ?></label>
														<input type="text" name="general_font_intro_sub_size" id="general_font_intro_sub_size" value="<?php echo esc_attr($react['options']['general_font_intro_sub_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="150" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_intro_sub_mobile_friendly_size" class="react-mini-label"><?php esc_html_e('Mobile font size', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose a new font size for small mobile devices. Select 0 for no change.', 'react'); ?></span></span></label>
														<input type="text" name="general_font_intro_sub_mobile_friendly_size" id="general_font_intro_sub_mobile_friendly_size" value="<?php echo esc_attr($react['options']['general_font_intro_sub_mobile_friendly_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="40" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>

												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('This will be the new global default values for this heading tag. Fancy heading shortcode can be adjusted individually.', 'react'); ?></p>
												</td>
											</tr>
										</table>

										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-heading-font-google">
											<tr class="react-settings-sub-head ">
												<th colspan="2">
													<label for="general_font_general_buttons_up"><?php esc_html_e('General Buttons', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_font_general_buttons_up" class="react-mini-label"><?php esc_html_e('Uppercase', 'react'); ?></label>
														<input type="checkbox" class="react-toggle-yn" name="general_font_general_buttons_up" id="general_font_general_buttons_up" <?php checked(true, $react['options']['general_font_general_buttons_up']); ?> value="1" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_general_buttons_fw" class="react-mini-label"><?php esc_html_e('Weight', 'react'); ?></label>
														<select id="general_font_general_buttons_fw" name="general_font_general_buttons_fw">
															<option value="" <?php selected($react['options']['general_font_general_buttons_fw'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
															<option value="100" <?php selected($react['options']['general_font_general_buttons_fw'], '100'); ?>>100</option>
															<option value="200" <?php selected($react['options']['general_font_general_buttons_fw'], '200'); ?>>200</option>
															<option value="300" <?php selected($react['options']['general_font_general_buttons_fw'], '300'); ?>>300</option>
															<option value="400" <?php selected($react['options']['general_font_general_buttons_fw'], '400'); ?>>400</option>
															<option value="500" <?php selected($react['options']['general_font_general_buttons_fw'], '500'); ?>>500</option>
															<option value="600" <?php selected($react['options']['general_font_general_buttons_fw'], '600'); ?>>600</option>
															<option value="700" <?php selected($react['options']['general_font_general_buttons_fw'], '700'); ?>>700</option>
															<option value="800" <?php selected($react['options']['general_font_general_buttons_fw'], '800'); ?>>800</option>
														</select>
													</div>
													<div class="react-break"></div>
													<div class="react-multi-input-wrap">
														<label for="general_font_general_buttons_space" class="react-mini-label"><?php esc_html_e('Spacing', 'react'); ?></label>
														<input type="text" name="general_font_general_buttons_space" id="general_font_general_buttons_space" value="<?php echo esc_attr($react['options']['general_font_general_buttons_space']); ?>" class="react-range-slider react-width-50" data-from="-5" data-to="15" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_font_general_buttons_size" class="react-mini-label"><?php esc_html_e('Size', 'react'); ?></label>
														<input type="text" name="general_font_general_buttons_size" id="general_font_general_buttons_size" value="<?php echo esc_attr($react['options']['general_font_general_buttons_size']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="22" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('This will be the new global default values for buttons. Fancy button shortcode can be adjusted individually.', 'react'); ?></p>
												</td>
											</tr>
										</table>

									</div>
									<div class="react-table-tab">

										<table class="react-form-table react-multi-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th>
													<label for="general_font_text"><?php esc_html_e('Choose a content text font', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a content text font for your site', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<select id="general_font_text" name="general_font_text">
														<option value="" <?php selected($react['options']['general_font_text'], ''); ?>><?php esc_html_e('No font replacement', 'react'); ?></option>
														<option value="google" <?php selected($react['options']['general_font_text'], 'google'); ?>><?php esc_html_e('Google font', 'react'); ?></option>
													</select>
												</td>
											</tr>
										</table>

										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-text-font-google">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="general_font_text_google_link"><?php esc_html_e('Google font stylesheet', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('The stylesheet link tag can be found when you click the plus icon on your selected font', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<textarea name="general_font_text_google_link" id="general_font_text_google_link"><?php echo esc_textarea($react['options']['general_font_text_google_link']); ?></textarea>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php printf(esc_html__('Enter the complete stylesheet link tag from the %s.', 'react'), sprintf('<a href="' . esc_url($googleFontsUrl) . '" class="react-external-link">%s</a>', esc_html__('Google font preview site', 'react'))); ?><br />
													<?php printf(esc_html__('For example: %s', 'react'), '<code>' . esc_html("<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>") . '</code>'); ?></p>
												</td>
											</tr>
										</table>

										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-text-font-google">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="general_font_text_google_family"><?php esc_html_e('Google font family', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('The font family example can be found in Step 4 of the Quick-use page on the Google Fonts website', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="general_font_text_google_family" id="general_font_text_google_family" value="<?php echo esc_attr($react['options']['general_font_text_google_family']); ?>" class="react-width-400" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php printf(esc_html__('Enter the complete font-family example from the %s.', 'react'), sprintf('<a href="' . esc_url($googleFontsUrl) . '" class="react-external-link">%s</a>', esc_html__('Google font preview site', 'react'))); ?><br />
													<?php printf(esc_html__('For example: %s', 'react'), "<code>font-family: 'Open Sans', sans-serif;</code>"); ?></p>
												</td>
											</tr>
										</table>

										<table class="react-form-table react-multi-table react-tab-1-form-table react-show-if-text-font-google">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="general_font_text_selector"><?php esc_html_e('CSS selectors for content text font', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Find the CSS class / selector of the text you want to apply the font to and add it below', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<textarea name="general_font_text_selector" id="general_font_text_selector"><?php echo esc_textarea($react['options']['general_font_text_selector']); ?></textarea>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Enter the CSS selectors you want to apply your chosen font to.', 'react'); ?></p>
												</td>
											</tr>
										</table>

									</div>
								</div>




							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Theme styles', 'react'); ?></h2>

								<!-- Round corners -->
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Page radius', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Elements radius', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Page animate', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Page shadows', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Page border', 'react'); ?></span></li>
									</ul>
								</div>

								<div class="react-table-tabs">

									<div class="react-table-tab">
									   <table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_rounded_corners"><?php esc_html_e('Page corner radius', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value for the CSS3 round corners', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_rounded_corners" id="page_rounded_corners" value="<?php echo esc_attr($react['options']['page_rounded_corners']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="20" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('How round would you like the page in the theme? May not be visible depending on your Layout Settings (see Layout tab).', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="element_rounded_corners"><?php esc_html_e("Elements' rounded radius", 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value for the CSS3 radius curves', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="element_rounded_corners" id="element_rounded_corners" value="<?php echo esc_attr($react['options']['element_rounded_corners']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="10" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('How round would you like elements in the theme?', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>


									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_animated"><?php esc_html_e('Animate page on load', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Animates the whole page when it loads', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="page_animated" class="react-mini-label"><?php esc_html_e('Animation', 'react'); ?></label>
														<select id="page_animated" name="page_animated">
															<option value="" <?php selected($react['options']['page_animated'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
															<option value="fadeIn" <?php selected($react['options']['page_animated'], 'fadeIn'); ?>><?php esc_html_e('Fade In', 'react'); ?></option>
															<option value="fadeInUp" <?php selected($react['options']['page_animated'], 'fadeInDown'); ?>><?php esc_html_e('Fade In Down', 'react'); ?></option>
															<option value="bounce" <?php selected($react['options']['page_animated'], 'bounce'); ?>><?php esc_html_e('Bounce In', 'react'); ?></option>
															<option value="bounceInUp" <?php selected($react['options']['page_animated'], 'bounceInDown'); ?>><?php esc_html_e('Bounce In Down', 'react'); ?></option>
															<option value="flipInY" <?php selected($react['options']['page_animated'], 'flipInY'); ?>><?php esc_html_e('Flip In Y', 'react'); ?></option>
															<option value="fadeInRight" <?php selected($react['options']['page_animated'], 'fadeInRight'); ?>><?php esc_html_e('Fade In Right', 'react'); ?></option>
															<option value="fadeInLeft" <?php selected($react['options']['page_animated'], 'fadeInLeft'); ?>><?php esc_html_e('Fade In Left', 'react'); ?></option>
														</select>
													</div>
													<div class="react-multi-input-wrap">
														<label for="page_animated_delay" class="react-mini-label"><?php esc_html_e('Delay', 'react'); ?></label>
														<input type="text" name="page_animated_delay" id="page_animated_delay" value="<?php echo esc_attr($react['options']['page_animated_delay']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="3000" data-step="100" data-dimension="ms" /><span class="react-range-unit">ms</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Choose an animation to use on the full page content.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>


									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="style_outside_shadow"><?php esc_html_e("Page left/right shadow", 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle" name="style_outside_shadow" id="style_outside_shadow" <?php checked(true, $react['options']['style_outside_shadow']); ?> value="1" />
													<div class="trc-clearfix" id="style_outside_shadow_hide">
														<label for="style_outside_shadow_opacity" class="react-mini-label"><?php esc_html_e('Opacity level', 'react'); ?></label>
														<input type="text" name="style_outside_shadow_opacity" id="style_outside_shadow_opacity" value="<?php echo esc_attr($react['options']['style_outside_shadow_opacity']); ?>" class="react-width-50 react-range-slider" data-dimension="%" data-from="1" data-to="9" data-step="1" /><span class="react-range-unit"></span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Show a drop shadow effect on the page sections. We would recomend this for a Boxed or Mixed site layout.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="style_outside_shadow"><?php esc_html_e("Full shadow", 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<select id="style_full_shadow" name="style_full_shadow">
														<option value="" <?php selected($react['options']['style_full_shadow'], ''); ?>><?php esc_html_e('No shadow', 'react'); ?></option>
														<option value="style-one" <?php selected($react['options']['style_full_shadow'], 'style-one'); ?>><?php esc_html_e('Shadow spread', 'react'); ?></option>
														<option value="style-two" <?php selected($react['options']['style_full_shadow'], 'style-two'); ?>><?php esc_html_e('Shadow spread large', 'react'); ?></option>
														<option value="style-three" <?php selected($react['options']['style_full_shadow'], 'fadeIn'); ?>><?php esc_html_e('Shadow solid', 'react'); ?></option>
													</select>
													<div class="trc-clearfix" id="style_full_shadow_hide">
														<label for="style_full_shadow_opacity" class="react-mini-label"><?php esc_html_e('Opacity level', 'react'); ?></label>
														<input type="text" name="style_full_shadow_opacity" id="style_full_shadow_opacity" value="<?php echo esc_attr($react['options']['style_full_shadow_opacity']); ?>" class="react-width-50 react-range-slider" data-dimension="%" data-from="1" data-to="9" data-step="1" /><span class="react-range-unit"></span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Show a full shadow effect on the page sections. We would recomend this option when using Verticlal spacing in Layouts. Otherwise the shadows will overlap.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>

									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_borders_lr"><?php esc_html_e("Page left and right borders.", 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show or hide the page sections borders', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="page_borders_lr" class="react-mini-label"><?php esc_html_e('Left / right', 'react'); ?></label>
														<input type="checkbox" class="react-toggle" name="page_borders_lr" id="page_borders_lr" <?php checked(true, $react['options']['page_borders_lr']); ?> value="1" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="page_borders_tb" class="react-mini-label"><?php esc_html_e('Top / bottom', 'react'); ?></label>
														<input type="checkbox" class="react-toggle" name="page_borders_tb" id="page_borders_tb" <?php checked(true, $react['options']['page_borders_tb']); ?> value="1" />
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Some layouts you will not see the CSS borders anyway. However, you can make sure they are never visable here.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>


								</div>
								<div class="only_for_bxd_cnt"><p class="react-warning"><?php esc_html_e('Backgrounds may be hidden in Boxed Content and Fluid mode. To show it, either add Page margins, Vertical margins or change the Page Layout mode to Mixed or Boxed. Go to Design &rarr; Layout.', 'react'); ?></p></div>

								<?php
									/**
									 * This part loops to generate the texture/detail/image fields for each section
									 */
									$sections = array(
										'background' => array(esc_html__('Background Overlay', 'react'), esc_html__('Background texture', 'react'), esc_html__('Background detail', 'react')),
										'body' => array(esc_html__('Page Body', 'react'), esc_html__('Body texture', 'react'), esc_html__('Body detail', 'react')),
										'popdown' => array(esc_html__('Pop Down', 'react'), esc_html__('Pop Down texture', 'react'), esc_html__('Pop Down detail', 'react')),
										'tophead' => array(esc_html__('Top Header', 'react'), esc_html__('Top Header texture', 'react'), esc_html__('Top Header detail', 'react')),
										'mainhead' => array(esc_html__('Main Header', 'react'), esc_html__('Main Header texture', 'react'), esc_html__('Main Header detail', 'react')),
										'solonav' => array(esc_html__('Solo Nav', 'react'), esc_html__('Solo Nav texture', 'react'), esc_html__('Solo Nav detail', 'react')),
										'intro' => array(esc_html__('Intro', 'react'), esc_html__('Intro texture', 'react'), esc_html__('Intro detail', 'react')),
										'content' => array(esc_html__('Content Area', 'react'), esc_html__('Content Area texture', 'react'), esc_html__('Content Area detail', 'react')),
										'mainfoot' => array(esc_html__('Main Footer', 'react'), esc_html__('Main Footer texture', 'react'), esc_html__('Main Footer detail', 'react')),
										'subfoot' => array(esc_html__('Sub Footer', 'react'), esc_html__('Sub Footer texture', 'react'), esc_html__('Sub Footer detail', 'react'))
									);
								?>

								<?php foreach ($sections as $key => $labels) : ?>

									<div class="react-accordion react-toggle">
										<div class="react-accordion-trigger react-panel-section-header"><?php echo esc_html($labels[0]); ?></div>
										<div class="react-accordion-content">

											<div class="react-table-tabs-wrap">
												<ul class="react-table-tabs-nav">
													<li><span><?php esc_html_e('Texture', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Detail', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Custom image', 'react'); ?></span></li>
												</ul>
											</div>
											<div class="react-table-tabs">

												<div class="react-table-tab">

													<table class="react-form-table react-tab-2-form-table">
														<tr class="react-settings-sub-head">
															<th>
																<label><?php echo esc_html($labels[1]); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a style to be applied to the background overlay', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td react-form-table-one-td">
																<div class="react-multi-input-wrap">
																<select id="style_<?php echo esc_attr($key); ?>_texture" name="style_<?php echo esc_attr($key); ?>_texture" class="react-texture-select trc-image-select">
																	<?php foreach (react_get_texture_options() as $value => $label) : ?>
																		<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['style_' . $key . '_texture'], $value); ?>><?php echo esc_html($label); ?></option>
																	<?php endforeach; ?>
																</select>
																</div>
																<div class="react-multi-input-wrap">
																	<label for="style_<?php echo esc_attr($key); ?>_texture_opacity" class="react-mini-label"><?php esc_html_e('Opacity level', 'react'); ?></label>
																	<input type="text" name="style_<?php echo esc_attr($key); ?>_texture_opacity" id="style_<?php echo esc_attr($key); ?>_texture_opacity" value="<?php echo esc_attr($react['options']['style_' . $key . '_texture_opacity']); ?>" class="react-width-50 react-range-slider" data-dimension="%" data-from="10" data-to="50" data-step="10" /><span class="react-range-unit"></span>
																</div>
																<div class="react-multi-input-wrap">
																	<label for="style_<?php echo esc_attr($key); ?>_texture_fixed" class="react-mini-label"><?php esc_html_e('Fixed', 'react'); ?></label>
																	<input type="checkbox" class="react-toggle-yn" name="style_<?php echo esc_attr($key); ?>_texture_fixed" id="style_<?php echo esc_attr($key); ?>_texture_fixed" <?php checked(true, $react['options']['style_' . $key . '_texture_fixed']); ?> value="1" />
																</div>
																<div class="react-multi-input-wrap">
																	<label for="style_<?php echo esc_attr($key); ?>_texture_large" class="react-mini-label"><?php esc_html_e('Use double size for non retina displays', 'react'); ?>
																		<span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('By default the background image will be the same size for both hand held devices and for laptops / desktops. By selecting Yes here the background image will be double the size for screens larger than tablets.', 'react'); ?></span></span>
																	</label>
																	<input type="checkbox" class="react-toggle-yn" name="style_<?php echo esc_attr($key); ?>_texture_large" id="style_<?php echo esc_attr($key); ?>_texture_large" <?php checked(true, $react['options']['style_' . $key . '_texture_large']); ?> value="1" />
																</div>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-1-form-table">
														<tr class="react-settings-sub-head">
															<th>
																<label><?php echo esc_html($labels[2]); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a style to be applied to the background overlay', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td react-form-table-one-td">
																<div class="react-multi-input-wrap">
																	<select id="style_<?php echo esc_attr($key); ?>_detail" name="style_<?php echo esc_attr($key); ?>_detail" class="react-detail-select">
																		<?php foreach (react_get_detail_options() as $value => $label) : ?>
																			<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['style_' . $key . '_detail'], $value); ?>><?php echo esc_html($label); ?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
																<div class="react-multi-input-wrap">
																	<label for="style_<?php echo esc_attr($key); ?>_detail_opacity" class="react-mini-label"><?php esc_html_e('Opacity level', 'react'); ?></label>
																	<input type="text" name="style_<?php echo esc_attr($key); ?>_detail_opacity" id="style_<?php echo esc_attr($key); ?>_detail_opacity" value="<?php echo esc_attr($react['options']['style_' . $key . '_detail_opacity']); ?>" class="react-width-50 react-range-slider" data-dimension="%" data-from="10" data-to="50" data-step="10" /><span class="react-range-unit"></span>
																</div>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-1-form-table">
														<tr class="react-settings-sub-head">
															<th>
																<label for="style_<?php echo esc_attr($key); ?>_image"><?php esc_html_e('Select a custom background image', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Add your own image background for this section. By adding a background image here you can now only use either the Texture or the Detail. Texture has priority if both are selected.', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td react-form-table-one-td">
																<div class="react-clearfix">
																	<div class="react-multi-input-float">
																		<label for="style_<?php echo esc_attr($key); ?>_image" class="react-mini-label"><?php esc_html_e('Image URL', 'react'); ?></label>
																		<input type="text" name="style_<?php echo esc_attr($key); ?>_image" id="style_<?php echo esc_attr($key); ?>_image" value="<?php echo esc_attr($react['options']['style_' . $key . '_image']); ?>" class="react-width-400">
																		<div class="react-upload-logo-button-wrap react-clearfix">
																			<div id="style_<?php echo esc_attr($key); ?>_image_upload" class="react-media-button"><?php esc_html_e('Browse', 'react'); ?></div>
																		</div>
																	</div>
																	<div class="react-multi-input-float">
																		<label for="style_<?php echo esc_attr($key); ?>_image_width" class="react-mini-label"><?php esc_html_e('Width', 'react'); ?></label>
																		<input type="text" name="style_<?php echo esc_attr($key); ?>_image_width" id="style_<?php echo esc_attr($key); ?>_image_width" value="<?php echo esc_attr($react['options']['style_' . $key . '_image_width']); ?>" class="react-width-50" /><span class="react-range-unit">px</span>
																	</div>
																	<div class="react-multi-input-float">
																		<label for="style_<?php echo esc_attr($key); ?>_image_height" class="react-mini-label"><?php esc_html_e('Height', 'react'); ?></label>
																		<input type="text" name="style_<?php echo esc_attr($key); ?>_image_height" id="style_<?php echo esc_attr($key); ?>_image_height" value="<?php echo esc_attr($react['options']['style_' . $key . '_image_height']); ?>" class="react-width-50" /><span class="react-range-unit">px</span>
																	</div>
																	<div class="react-multi-input-float">
																		<div id="style_<?php echo esc_attr($key); ?>_image_upload_holder" class="react-upload-holder react-clearfix">
																			<?php echo react_get_upload_thumbnail($react['options']['style_' . $key . '_image']); ?>
																		</div>
																	</div>
																	<?php if (in_array($key, array('intro', 'body', 'background'))) : ?>
																		<div class="react-multi-input-float">
																			<label for="style_<?php echo esc_attr($key); ?>_image_use_feat" class="react-mini-label"><?php esc_html_e('Use featured image', 'react'); ?></label>
																			<input type="checkbox" class="react-toggle-yn" name="style_<?php echo esc_attr($key); ?>_image_use_feat" id="style_<?php echo esc_attr($key); ?>_image_use_feat" <?php checked(true, $react['options']['style_' . $key . '_image_use_feat']); ?> value="1" />
																		</div>
																	<?php endif; ?>
																</div>
																<div class="react-clearfix react-element-spacer">
																	<label for="style_<?php echo esc_attr($key); ?>_image_retina_use_main_img" class="react-mini-label"><?php esc_html_e('What would you like to do for smaller screens and/or retina devices?', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose an option for smaller screens and/or retina devices', 'react'); ?></span></span></label>
																	<select name="style_<?php echo esc_attr($key); ?>_image_retina_use_main_img" id="style_<?php echo esc_attr($key); ?>_image_retina_use_main_img">
																		<?php foreach (react_get_retina_use_main_img_options() as $value => $label) : ?>
																			<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['style_' . $key . '_image_retina_use_main_img'], $value); ?>><?php echo esc_html($label); ?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
																<div class="image_retina_use_main_img_is_yes">
																	<div class="react-clearfix">
																		<div class="react-multi-input-float">
																			<label for="style_<?php echo esc_attr($key); ?>_image_retina" class="react-mini-label"><?php esc_html_e('Alternative or Retina image URL', 'react'); ?></label>
																			<input type="text" name="style_<?php echo esc_attr($key); ?>_image_retina" id="style_<?php echo esc_attr($key); ?>_image_retina" value="<?php echo esc_attr($react['options']['style_' . $key . '_image_retina']); ?>" class="react-width-400">
																			<div class="react-upload-logo-button-wrap react-clearfix">
																				<div id="style_<?php echo esc_attr($key); ?>_image_retina_upload" class="react-media-button"><?php esc_html_e('Browse', 'react'); ?></div>
																			</div>
																		</div>
																		<div class="react-multi-input-float">
																			<label for="style_<?php echo esc_attr($key); ?>_image_retina_width" class="react-mini-label"><?php esc_html_e('Width', 'react'); ?></label>
																			<input type="text" name="style_<?php echo esc_attr($key); ?>_image_retina_width" id="style_<?php echo esc_attr($key); ?>_image_retina_width" value="<?php echo esc_attr($react['options']['style_' . $key . '_image_retina_width']); ?>" class="react-width-50" /><span class="react-range-unit">px</span>
																		</div>
																		<div class="react-multi-input-float">
																			<label for="style_<?php echo esc_attr($key); ?>_image_retina_height" class="react-mini-label"><?php esc_html_e('Height', 'react'); ?></label>
																			<input type="text" name="style_<?php echo esc_attr($key); ?>_image_retina_height" id="style_<?php echo esc_attr($key); ?>_image_retina_height" value="<?php echo esc_attr($react['options']['style_' . $key . '_image_retina_height']); ?>" class="react-width-50" /><span class="react-range-unit">px</span>
																		</div>
																		<div class="react-multi-input-float">
																			<div id="style_<?php echo esc_attr($key); ?>_image_retina_upload_holder" class="react-upload-holder react-bg-custom-retina-holder react-clearfix">
																				<?php echo react_get_upload_thumbnail($react['options']['style_' . $key . '_image_retina']); ?>
																			</div>
																		</div>
																	</div>
																	<label for="style_<?php echo esc_attr($key); ?>_image_is_retina" class="react-mini-label"><?php esc_html_e('This is a retina ready image?', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('The Retina ready image will be used at 50% size, so the image you upload must be double the actual size required. If you do not require a Retina ready image and are using this as an alternative device image, select NO.', 'react'); ?></span></span></label>
																	<input type="checkbox" class="react-toggle-yn" name="style_<?php echo esc_attr($key); ?>_image_is_retina" id="style_<?php echo esc_attr($key); ?>_image_is_retina" <?php checked(true, $react['options']['style_' . $key . '_image_is_retina']); ?> value="1" />
																</div>
																<div class="image_retina_use_main_img_is_yes_or">
																	<div class="react-multi-input-float">
																		<label for="style_<?php echo esc_attr($key); ?>_image_convert" class="react-mini-label"><?php esc_html_e('When would you like to start using this image?', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose which viewport size to start showing the new image', 'react'); ?></span></span></label>
																		<select name="style_<?php echo esc_attr($key); ?>_image_convert" id="style_<?php echo esc_attr($key); ?>_image_convert">
																			<?php foreach (react_get_convert_options() as $value => $label) : ?>
																				<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['style_' . $key . '_image_convert'], $value); ?>><?php echo esc_html($label); ?></option>
																			<?php endforeach; ?>
																		</select>
																	</div>
																	<div class="react-multi-input-float react-custom-convert-wrap">
																		<input type="text" name="style_<?php echo esc_attr($key); ?>_image_convert_custom" id="style_<?php echo esc_attr($key); ?>_image_convert_custom" value="<?php echo esc_attr($react['options']['style_' . $key . '_image_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
																	</div>
																</div>
															</td>
														</tr>

														<tr class="react-content-row react-no-desc">
															<td class="react-form-table-input-area-td">
																<div class="react-accordion react-toggle">
																	<div class="react-accordion-trigger"><?php esc_html_e('Manage the display settings for this background image', 'react'); ?></div>
																	<div class="react-accordion-content">
																		<div class="react-clearfix react-element-spacer">
																			<div class="react-background-image-settings">
																				<label class="react-mini-label"><?php esc_html_e('Main image', 'react'); ?></label>
																				<div class="react-multi-input-wrap">
																					<select id="style_<?php echo esc_attr($key); ?>_image_position" name="style_<?php echo esc_attr($key); ?>_image_position" class="react-bg-position-select">
																						<?php foreach (react_get_background_position_options() as $value => $label) : ?>
																							<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['style_' . $key . '_image_position'], $value); ?>><?php echo esc_html($label); ?></option>
																						<?php endforeach; ?>
																					</select>
																					<div class="react-multi-input-wrap">
																						<label for="style_<?php echo esc_attr($key); ?>_image_position_custom" class="react-mini-label"><?php esc_html_e('Custom value', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('The background-position property specifies the position of the background image. Examples: "95% 95%" or "300px 500px"', 'react'); ?></span></span></label>
																						<input id="style_<?php echo esc_attr($key); ?>_image_position_custom" name="style_<?php echo esc_attr($key); ?>_image_position_custom" value="<?php echo esc_attr($react['options']['style_' . $key . '_image_position_custom']); ?>" class="react-image-position-custom react-width-100">
																					</div>
																				</div>
																				<div class="react-multi-input-wrap">
																					<select id="style_<?php echo esc_attr($key); ?>_image_repeat" name="style_<?php echo esc_attr($key); ?>_image_repeat" class="react-bg-repeat-select">
																						<?php foreach (react_get_background_repeat_options() as $value => $label) : ?>
																							<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['style_' . $key . '_image_repeat'], $value); ?>><?php echo esc_html($label); ?></option>
																						<?php endforeach; ?>
																					</select>
																				</div>
																				<div class="react-clearfix">
																					<div class="react-multi-input-wrap">
																						<label for="style_<?php echo esc_attr($key); ?>_image_fixed" class="react-mini-label"><?php esc_html_e('Fixed', 'react'); ?></label>
																						<input type="checkbox" class="react-toggle-yn" name="style_<?php echo esc_attr($key); ?>_image_fixed" id="style_<?php echo esc_attr($key); ?>_image_fixed" <?php checked(true, $react['options']['style_' . $key . '_image_fixed']); ?> value="1" />
																					</div>
																					<div class="react-multi-input-wrap">
																						<label for="style_<?php echo esc_attr($key); ?>_image_background_size" class="react-mini-label"><?php esc_html_e('Background size', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('The background-size property specifies the size of the background image. Examples: "100% auto" or "300px 500px"', 'react'); ?></span></span></label>
																						<input placeholder="auto auto" type="text" name="style_<?php echo esc_attr($key); ?>_image_background_size" id="style_<?php echo esc_attr($key); ?>_image_background_size" value="<?php echo esc_attr($react['options']['style_' . $key . '_image_background_size']); ?>" class="react-width-100" />
																					</div>
																				</div>
																			</div>
																			<div class="react-background-image-retina-settings" id="<?php echo esc_attr($key); ?>_background_image_retina_settings">
																				<label class="react-mini-label"><?php esc_html_e('Device image', 'react'); ?></label>
																				<div class="react-multi-input-wrap">
																					<select id="style_<?php echo esc_attr($key); ?>_image_position_retina" name="style_<?php echo esc_attr($key); ?>_image_position_retina" class="react-bg-position-select">
																						<?php foreach (react_get_background_position_options() as $value => $label) : ?>
																							<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['style_' . $key . '_image_position_retina'], $value); ?>><?php echo esc_html($label); ?></option>
																						<?php endforeach; ?>
																					</select>
																					<div class="react-multi-input-wrap">
																						<label for="style_<?php echo esc_attr($key); ?>_image_position_custom_retina" class="react-mini-label"><?php esc_html_e('Custom value', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('The background-position property specifies the position of the background image. Examples: "95% 95%" or "300px 500px"', 'react'); ?></span></span></label>
																						<input id="style_<?php echo esc_attr($key); ?>_image_position_custom_retina" name="style_<?php echo esc_attr($key); ?>_image_position_custom_retina" value="<?php echo esc_attr($react['options']['style_' . $key . '_image_position_custom_retina']); ?>" class="react-image-position-custom react-width-100">
																					</div>
																				</div>
																				<div class="react-multi-input-wrap">
																					<select id="style_<?php echo esc_attr($key); ?>_image_repeat_retina" name="style_<?php echo esc_attr($key); ?>_image_repeat_retina" class="react-bg-repeat-select">
																						<?php foreach (react_get_background_repeat_options() as $value => $label) : ?>
																							<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['style_' . $key . '_image_repeat_retina'], $value); ?>><?php echo esc_html($label); ?></option>
																						<?php endforeach; ?>
																					</select>
																				</div>
																				<div class="react-clearfix">
																					<div class="react-multi-input-wrap">
																						<label for="style_<?php echo esc_attr($key); ?>_image_fixed_retina" class="react-mini-label"><?php esc_html_e('Fixed', 'react'); ?></label>
																						<input type="checkbox" class="react-toggle-yn" name="style_<?php echo esc_attr($key); ?>_image_fixed_retina" id="style_<?php echo esc_attr($key); ?>_image_fixed_retina" <?php checked(true, $react['options']['style_' . $key . '_image_fixed_retina']); ?> value="1" />
																					</div>
																					<div class="react-multi-input-wrap">
																						<label for="style_<?php echo esc_attr($key); ?>_image_background_size_retina" class="react-mini-label"><?php esc_html_e('Background size', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('The background-size property specifies the size of the background image. Examples: "100% auto" or "300px 500px"', 'react'); ?></span></span></label>
																						<input placeholder="auto auto" type="text" name="style_<?php echo esc_attr($key); ?>_image_background_size_retina" id="style_<?php echo esc_attr($key); ?>_image_background_size_retina" value="<?php echo esc_attr($react['options']['style_' . $key . '_image_background_size_retina']); ?>" class="react-width-100" />
																					</div>
																				</div>

																			</div>
																			<div class="react-background-image-parallax-settings">
																				<div class="react-multi-input-wrap">
																					<label for="style_<?php echo esc_attr($key); ?>_image_parallax" class="react-mini-label"><?php esc_html_e('Parallax ratio', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('If you set this to anything other than 1, the background image will scroll at a different speed than the page, creating a parallax effect. Setting it to 0.5 will make it scroll at half the speed, setting it to 2 will make it scroll at twice the speed.', 'react'); ?></span></span></label>
																					<input type="text" name="style_<?php echo esc_attr($key); ?>_image_parallax" id="style_<?php echo esc_attr($key); ?>_image_parallax" value="<?php echo esc_attr($react['options']['style_' . $key . '_image_parallax']); ?>" class="react-width-50" />
																				</div>
																				<div class="react-multi-input-wrap">
																					<label for="style_<?php echo esc_attr($key); ?>_image_parallax_offset" class="react-mini-label"><?php esc_html_e('Parallax offset', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('This number determines when the background image will be visible, it is the number of pixels from the top of the viewport that the top of background image should be at the top of this section. Experiment with different numbers.', 'react'); ?></span></span></label>
																					<input type="text" name="style_<?php echo esc_attr($key); ?>_image_parallax_offset" id="style_<?php echo esc_attr($key); ?>_image_parallax_offset" value="<?php echo esc_attr($react['options']['style_' . $key . '_image_parallax_offset']); ?>" class="react-width-50" /><span class="react-range-unit">px</span>
																				</div>
																			</div>
																		</div>

																	</div>
																</div>
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div>

								<?php endforeach; ?>

							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Layout Options', 'react'); ?></h2>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="page_layout"><?php esc_html_e('Page layout type', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a base layout', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<select id="page_layout" name="page_layout" class="react-page-layout-selector">
												<?php foreach (react_get_page_layout_options() as $value => $label) : ?>
													<option value="<?php echo esc_attr($value); ?>" <?php selected($react['options']['page_layout'], $value); ?>><?php echo esc_html($label); ?></option>
												<?php endforeach; ?>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Select from one of the base layout options. Fluid: All content areas span 100%. Boxed-Inner: Outer area spans 100% and inner content area set at Site Width. Boxed: All areas set at Site Width. Mixed: Choose to make Header and/or Footer areas full width.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<div id="only_for_mixed">
									<!-- IF mixed mode selected show... -->
									<div class="react-table-tabs-wrap">
										<ul class="react-table-tabs-nav">
											<li><span><?php esc_html_e('All Header', 'react'); ?></span></li>
											<li><span><?php esc_html_e('Above Header', 'react'); ?></span></li>
											<li><span><?php esc_html_e('All Footer', 'react'); ?></span></li>
											<li><span><?php esc_html_e('Sub Footer', 'react'); ?></span></li>
											<li><span><?php esc_html_e('Content', 'react'); ?></span></li>
										</ul>
									</div>

									<div class="react-table-tabs">

										<div class="react-table-tab">
											<table class="react-form-table react-tab-1-form-table">
												<tr class="react-settings-sub-head">
													<th colspan="2">
														<label><?php esc_html_e('All Header stretched', 'react'); ?></label>
														<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose to stretch the whole Header area to full width of the page', 'react'); ?></span></span>
													</th>
												</tr>
												<tr class="react-content-row">
													<td class="react-form-table-input-area-td">
														<div class="react-multi-input-wrap">
															<label for="page_layout_stretched_allheader" class="react-mini-label"><?php esc_html_e('All stretched', 'react'); ?></label>
															<input type="checkbox" class="react-toggle" name="page_layout_stretched_allheader" id="page_layout_stretched_allheader" <?php checked(true, $react['options']['page_layout_stretched_allheader']); ?> value="1" />
														</div>
														<div id="page_layout_stretched_allheader_boxed_content_hide" class="react-multi-input-wrap">
															<label for="page_layout_stretched_allheader_boxed_content" class="react-mini-label"><?php esc_html_e('Fluid content', 'react'); ?></label>
															<input type="checkbox" class="react-toggle" name="page_layout_stretched_allheader_boxed_content" id="page_layout_stretched_allheader_boxed_content" <?php checked(true, $react['options']['page_layout_stretched_allheader_boxed_content']); ?> value="1" />
														</div>
													</td>
													<td class="react-form-table-desc-td">
														<p class="react-description"><?php esc_html_e('Stretching all the Header sections will make the Pop Down, Top Header, Main Header and Solo Nav stretch to 100% of the screen width. You can also choose whether the content within these sections are also stretched or if they remain at the Page Width.', 'react'); ?></p>
													</td>
												</tr>
											</table>
										</div>
										<div class="react-table-tab">
											<table class="react-form-table react-tab-1-form-table">
												<tr class="react-settings-sub-head">
													<th colspan="2">
														<label><?php esc_html_e('Above Main Header stretched', 'react'); ?></label>
														<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose to stretch the elements above Main Header to fullwidth of the page', 'react'); ?></span></span>
													</th>
												</tr>
												<tr class="react-content-row">
													<td class="react-form-table-input-area-td">
														<div class="react-multi-input-wrap">
															<label for="page_layout_stretched_top" class="react-mini-label"><?php esc_html_e('All stretched', 'react'); ?></label>
															<input type="checkbox" class="react-toggle" name="page_layout_stretched_top" id="page_layout_stretched_top" <?php checked(true, $react['options']['page_layout_stretched_top']); ?> value="1" />
														</div>
														<div id="page_layout_stretched_top_boxed_content_hide" class="react-multi-input-wrap">
															<label for="page_layout_stretched_top_boxed_content" class="react-mini-label"><?php esc_html_e('Fluid content', 'react'); ?></label>
															<input type="checkbox" class="react-toggle" name="page_layout_stretched_top_boxed_content" id="page_layout_stretched_top_boxed_content" <?php checked(true, $react['options']['page_layout_stretched_top_boxed_content']); ?> value="1" />
														</div>
													</td>
													<td class="react-form-table-desc-td">
														<p class="react-description"><?php esc_html_e('Stretching above Main Header sections will make the Pop Down and Top Header stretch to 100% of the screen width. You can also choose whether the content within these sections are also stretched or if they remain at the Page Width.', 'react'); ?></p>
													</td>
												</tr>
											</table>
										</div>

										<div class="react-table-tab">
											<table class="react-form-table react-tab-1-form-table">
												<tr class="react-settings-sub-head">
													<th colspan="2">
														<label><?php esc_html_e('All Footer stretched', 'react'); ?></label>
														<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose to stretch the whole Footer area to fullwidth of the page', 'react'); ?></span></span>
													</th>
												</tr>
												<tr class="react-content-row">
													<td class="react-form-table-input-area-td">
														<div class="react-multi-input-wrap">
															<label for="page_layout_stretched_allfoot" class="react-mini-label"><?php esc_html_e('All stretched', 'react'); ?></label>
															<input type="checkbox" class="react-toggle" name="page_layout_stretched_allfoot" id="page_layout_stretched_allfoot" <?php checked(true, $react['options']['page_layout_stretched_allfoot']); ?> value="1" />
														</div>
														<div id="page_layout_stretched_allfoot_boxed_content_hide" class="react-multi-input-wrap">
															<label for="page_layout_stretched_allfoot_boxed_content" class="react-mini-label"><?php esc_html_e('Fluid content', 'react'); ?></label>
															<input type="checkbox" class="react-toggle" name="page_layout_stretched_allfoot_boxed_content" id="page_layout_stretched_allfoot_boxed_content" <?php checked(true, $react['options']['page_layout_stretched_allfoot_boxed_content']); ?> value="1" />
														</div>
													</td>
													<td class="react-form-table-desc-td">
														<p class="react-description"><?php esc_html_e('Stretching all the Footer sections will make the Main Footer and Sub Footer stretch to 100% of the screen width. You can also choose whether the content within these sections are also stretched or if they remain at the Page Width.', 'react'); ?></p>
													</td>
												</tr>
											</table>
										</div>

										<div class="react-table-tab">
											<table class="react-form-table react-tab-1-form-table">
												<tr class="react-settings-sub-head">
													<th colspan="2">
														<label><?php esc_html_e('Sub Footer stretched', 'react'); ?></label>
														<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose to stretch the Sub Footer to fullwidth of the page', 'react'); ?></span></span>
													</th>
												</tr>
												<tr class="react-content-row">
													<td class="react-form-table-input-area-td">
														<div class="react-multi-input-wrap">
															<label for="page_layout_stretched_subfoot" class="react-mini-label"><?php esc_html_e('All stretched', 'react'); ?></label>
															<input type="checkbox" class="react-toggle" name="page_layout_stretched_subfoot" id="page_layout_stretched_subfoot" <?php checked(true, $react['options']['page_layout_stretched_subfoot']); ?> value="1" />
														</div>
														<div id="page_layout_stretched_subfoot_boxed_content_hide" class="react-multi-input-wrap">
															<label for="page_layout_stretched_subfoot_boxed_content" class="react-mini-label"><?php esc_html_e('Fluid content', 'react'); ?></label>
															<input type="checkbox" class="react-toggle" name="page_layout_stretched_subfoot_boxed_content" id="page_layout_stretched_subfoot_boxed_content" <?php checked(true, $react['options']['page_layout_stretched_subfoot_boxed_content']); ?> value="1" />
														</div>
													</td>
													<td class="react-form-table-desc-td">
														<!-- Show if Sub Footer off -->
														<div class="only_for_subfooter"><p class="react-warning"><?php esc_html_e('Sub Footer section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
														<p class="react-description"><?php esc_html_e('Stretching the Sub Footer section will make it stretch to 100% of the screen width. You can also choose whether the content within this section is also stretched or if it remains at the Page Width.', 'react'); ?></p>
													</td>
												</tr>
											</table>
										</div>



										<div class="react-table-tab">
											<table class="react-form-table react-tab-1-form-table">
												<tr class="react-settings-sub-head">
													<th colspan="2">
														<label><?php esc_html_e('Content stretched', 'react'); ?></label>
														<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose to stretch the content area to full width of the page', 'react'); ?></span></span>
													</th>
												</tr>
												<tr class="react-content-row">
													<td class="react-form-table-input-area-td">
														<div class="react-multi-input-wrap">
															<label for="page_layout_stretched_content" class="react-mini-label"><?php esc_html_e('All stretched', 'react'); ?></label>
															<input type="checkbox" class="react-toggle" name="page_layout_stretched_content" id="page_layout_stretched_content" <?php checked(true, $react['options']['page_layout_stretched_content']); ?> value="1" />
														</div>
														<div id="page_layout_stretched_content_boxed_content_hide" >
															<div class="react-multi-input-wrap">
																<label for="page_layout_stretched_content_boxed_content" class="react-mini-label"><?php esc_html_e('Fluid main content', 'react'); ?></label>
																<input type="checkbox" class="react-toggle" name="page_layout_stretched_content_boxed_content" id="page_layout_stretched_content_boxed_content" <?php checked(true, $react['options']['page_layout_stretched_content_boxed_content']); ?> value="1" />
															</div>
															<div class="react-multi-input-wrap">
																<label for="page_layout_stretched_content_boxed_intro" class="react-mini-label"><?php esc_html_e('Fluid intro', 'react'); ?></label>
																<input type="checkbox" class="react-toggle" name="page_layout_stretched_content_boxed_intro" id="page_layout_stretched_content_boxed_intro" <?php checked(true, $react['options']['page_layout_stretched_content_boxed_intro']); ?> value="1" />
															</div>
														</div>
													</td>
													<td class="react-form-table-desc-td"></td>
												</tr>
											</table>
										</div>
									</div>
								</div>

								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Laptops / Desktops', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Large screens', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_max_width"><?php esc_html_e('Maximum page width', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the max page width', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_max_width" id="page_layout_max_width" value="<?php echo esc_attr($react['options']['page_layout_max_width']); ?>" class="react-range-slider react-width-50" data-from="600" data-to="2500" data-step="10" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Choose the max page width; this will define the box width for Boxed and Boxed-Inner layouts. For the Fluid layout it will define the maximum width of featured images and the default video embed width.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_max_width_large"><?php esc_html_e('Maximum page width for Large screens', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the max page width for Large screens', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_max_width_large" id="page_layout_max_width_large" value="<?php echo esc_attr($react['options']['page_layout_max_width_large']); ?>" class="react-range-slider react-width-50" data-from="600" data-to="2500" data-step="10" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Choose the max page width; this will define the box width for Boxed and Boxed-Inner layouts on large screens.', 'react'); ?></p>
												</td>
											</tr>
										</table>

									</div>
								</div>

								<h2 class="react-panel-section-header"><?php esc_html_e('Page margins', 'react'); ?></h2>
								<!-- Left page margin -->
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Left (Default / Desktop)', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_left_margin"><?php esc_html_e('Left margin', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the left margin. -1 = auto', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_left_margin" id="page_layout_left_margin" value="<?php echo esc_attr($react['options']['page_layout_left_margin']); ?>" class="react-range-slider react-width-50" data-from="-1" data-to="201" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													<div class="react-break"></div>
													<div class="react-clearfix">
														<label for="page_layout_left_margin_box_only" class="react-mini-label"><?php esc_html_e('Use at Page width', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('This will allow the page to be centered for screens larger than the page width. When the screen size meets the page width the margin will be added.', 'react'); ?></span></span></label>
														<input type="checkbox" class="react-toggle" name="page_layout_left_margin_box_only" id="page_layout_left_margin_box_only" <?php checked(true, $react['options']['page_layout_left_margin_box_only']); ?> value="1" />
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Add a left margin to your page. If you are using Boxed or Mixed layouts, this will move the whole page to the left.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_left_margin_tablets"><?php esc_html_e('Left margin for tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the left margin. -1 will inherit the default (desktop) value.', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_left_margin_tablets" id="page_layout_left_margin_tablets" value="<?php echo esc_attr($react['options']['page_layout_left_margin_tablets']); ?>" class="react-range-slider react-width-50" data-from="-1" data-to="201" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Add a left margin to your page on tablets. -1 will inherit the default (desktop) value.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_left_margin_phones"><?php esc_html_e('Left margin for phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the left margin. -1 will inherit the default (desktop) value.', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_left_margin_phones" id="page_layout_left_margin_phones" value="<?php echo esc_attr($react['options']['page_layout_left_margin_phones']); ?>" class="react-range-slider react-width-50" data-from="-1" data-to="201" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Add a left margin to your page on phones. -1 will inherit the default (desktop) value.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>


								</div>
								<!-- Right page margin -->
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Right (Default / Desktop)', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_right_margin"><?php esc_html_e('Right margin', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the right margin. -1 = auto', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_right_margin" id="page_layout_right_margin" value="<?php echo esc_attr($react['options']['page_layout_right_margin']); ?>" class="react-range-slider react-width-50" data-from="-1" data-to="201" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													<div class="react-break"></div>
													<div class="react-clearfix">
														<label for="page_layout_right_margin_box_only" class="react-mini-label"><?php esc_html_e('Use at Page width', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('This will allow the page to be centered for screens larger than the page width. When the screen size meets the page width the margin will be added.', 'react'); ?></span></span></label>
														<input type="checkbox" class="react-toggle" name="page_layout_right_margin_box_only" id="page_layout_right_margin_box_only" <?php checked(true, $react['options']['page_layout_right_margin_box_only']); ?> value="1" />
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Add a right margin to your page. If you are using Boxed or Mixed layouts, this will move the whole page to the right, unless a left margin is already set, as it has priority.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_right_margin_tablets"><?php esc_html_e('Right margin for tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the right margin. -1 will inherit the default (desktop) value.', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_right_margin_tablets" id="page_layout_right_margin_tablets" value="<?php echo esc_attr($react['options']['page_layout_right_margin_tablets']); ?>" class="react-range-slider react-width-50" data-from="-1" data-to="201" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Add a right margin to your page on tablets. -1 will inherit the default (desktop) value.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_right_margin_phones"><?php esc_html_e('Right margin for phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the right margin. -1 will inherit the default (desktop) value.', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_right_margin_phones" id="page_layout_right_margin_phones" value="<?php echo esc_attr($react['options']['page_layout_right_margin_phones']); ?>" class="react-range-slider react-width-50" data-from="-1" data-to="201" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Add a right margin to your page on phones. -1 will inherit the default (desktop) value.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>

								</div>
								<h2 class="react-panel-section-header"><?php esc_html_e('Vertical margins', 'react'); ?></h2>
								<!-- Section space -->
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Section space (Default / Desktop)', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Large screens', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_sections_margin"><?php esc_html_e('Vertical sections space', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the vertical sections space', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_sections_margin" id="page_layout_sections_margin" value="<?php echo esc_attr($react['options']['page_layout_sections_margin']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Vertical space between the Header, Content area and Footer. Useful if you want to show the background.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_sections_margin_phones"><?php esc_html_e('Vertical sections space for phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the vertical sections space', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_sections_margin_phones" id="page_layout_sections_margin_phones" value="<?php echo esc_attr($react['options']['page_layout_sections_margin_phones']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Vertical space between the Header, Content area and Footer. Useful if you want to show the background.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_sections_margin_tablets"><?php esc_html_e('Vertical sections space for tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the vertical sections space', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_sections_margin_tablets" id="page_layout_sections_margin_tablets" value="<?php echo esc_attr($react['options']['page_layout_sections_margin_tablets']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Vertical space between the Header, Content area and Footer. Useful if you want to show the background.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_sections_margin_tv"><?php esc_html_e('Vertical sections space for large screens', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the vertical sections space', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_sections_margin_tv" id="page_layout_sections_margin_tv" value="<?php echo esc_attr($react['options']['page_layout_sections_margin_tv']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Vertical space between the Header, Content area and Footer. Useful if you want to show the background.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<!-- Top margin... -->
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Top (Default / Desktop)', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Large screens', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_top_margin"><?php esc_html_e('Top vertical space', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the top vertical space', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<select id="page_layout_top_margin_choose" name="page_layout_top_margin_choose">
															<option value=""><?php esc_html_e('Custom', 'react'); ?></option>
															<option value="screen"><?php esc_html_e('Set to viewport height', 'react'); ?></option>
														</select>
													</div>
													<div class="react-multi-input-wrap">
														<input type="text" name="page_layout_top_margin" id="page_layout_top_margin" value="<?php echo esc_attr($react['options']['page_layout_top_margin']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Vertical space between the Top Header (or top of page) and Main header. Useful if you want to show the background.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_top_margin_phones"><?php esc_html_e('Top vertical space for phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the top vertical space', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<select id="page_layout_top_margin_phones_choose" name="page_layout_top_margin_phones_choose">
															<option value=""><?php esc_html_e('Custom', 'react'); ?></option>
															<option value="screen"><?php esc_html_e('Set to viewport height', 'react'); ?></option>
														</select>
													</div>
													<div class="react-multi-input-wrap">
														<input type="text" name="page_layout_top_margin_phones" id="page_layout_top_margin_phones" value="<?php echo esc_attr($react['options']['page_layout_top_margin_phones']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Vertical space between the Top Header (or top of page) and Main header on phones. Useful if you want to show the background.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_top_margin_tablets"><?php esc_html_e('Top vertical space for tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the top vertical space', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<select id="page_layout_top_margin_tablets_choose" name="page_layout_top_margin_tablets_choose">
															<option value=""><?php esc_html_e('Custom', 'react'); ?></option>
															<option value="screen"><?php esc_html_e('Set to viewport height', 'react'); ?></option>
														</select>
													</div>
													<div class="react-multi-input-wrap">
														<input type="text" name="page_layout_top_margin_tablets" id="page_layout_top_margin_tablets" value="<?php echo esc_attr($react['options']['page_layout_top_margin_tablets']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Vertical space between the Top Header (or top of page) and Main header on tablets. Useful if you want to show the background.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_top_margin_tv"><?php esc_html_e('Top vertical page space for large screens', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the top vertical space', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<select id="page_layout_top_margin_tv_choose" name="page_layout_top_margin_tv_choose">
															<option value=""><?php esc_html_e('Custom', 'react'); ?></option>
															<option value="screen"><?php esc_html_e('Set to viewport height', 'react'); ?></option>
														</select>
													</div>
													<div class="react-multi-input-wrap">
														<input type="text" name="page_layout_top_margin_tv" id="page_layout_top_margin_tv" value="<?php echo esc_attr($react['options']['page_layout_top_margin_tv']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Vertical space between the Top Header (or top of page) and Main header on large screens. Useful if you want to show the background.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>

								<!-- Bottom margin... -->
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Bottom (Default / Desktop)', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Large screens', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_bottom_margin"><?php esc_html_e('Bottom vertical page space', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the bottom vertical space', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<select id="page_layout_bottom_margin_choose" name="page_layout_bottom_margin_choose">
															<option value=""><?php esc_html_e('Custom', 'react'); ?></option>
															<option value="screen"><?php esc_html_e('Set to viewport height', 'react'); ?></option>
														</select>
													</div>
													<div class="react-multi-input-wrap">
														<input type="text" name="page_layout_bottom_margin" id="page_layout_bottom_margin" value="<?php echo esc_attr($react['options']['page_layout_bottom_margin']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Vertical space between the Main (and Sub Footer) and bottom of page. Useful if you want to show the background.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_bottom_margin_phones"><?php esc_html_e('Bottom vertical page space for phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the bottom vertical space', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<select id="page_layout_bottom_margin_phones_choose" name="page_layout_bottom_margin_phones_choose">
															<option value=""><?php esc_html_e('Custom', 'react'); ?></option>
															<option value="screen"><?php esc_html_e('Set to viewport height', 'react'); ?></option>
														</select>
													</div>
													<div class="react-multi-input-wrap">
														<input type="text" name="page_layout_bottom_margin_phones" id="page_layout_bottom_margin_phones" value="<?php echo esc_attr($react['options']['page_layout_bottom_margin_phones']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Vertical space between the Main (and Sub Footer) and bottom of page on phones. Useful if you want to show the background.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_bottom_margin_tablets"><?php esc_html_e('Bottom vertical page space for tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the bottom vertical space', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<select id="page_layout_bottom_margin_tablets_choose" name="page_layout_bottom_margin_tablets_choose">
															<option value=""><?php esc_html_e('Custom', 'react'); ?></option>
															<option value="screen"><?php esc_html_e('Set to viewport height', 'react'); ?></option>
														</select>
													</div>
													<div class="react-multi-input-wrap">
														<input type="text" name="page_layout_bottom_margin_tablets" id="page_layout_bottom_margin_tablets" value="<?php echo esc_attr($react['options']['page_layout_bottom_margin_tablets']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Vertical space between the Main (and Sub Footer) and bottom of page on tablets. Useful if you want to show the background.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_bottom_margin_tv"><?php esc_html_e('Bottom vertical page space for large screens', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for the bottom vertical space', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<select id="page_layout_bottom_margin_tv_choose" name="page_layout_bottom_margin_tv_choose">
															<option value=""><?php esc_html_e('Custom', 'react'); ?></option>
															<option value="screen"><?php esc_html_e('Set to viewport height', 'react'); ?></option>
														</select>
													</div>
													<div class="react-multi-input-wrap">
														<input type="text" name="page_layout_bottom_margin_tv" id="page_layout_bottom_margin_tv" value="<?php echo esc_attr($react['options']['page_layout_bottom_margin_tv']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Vertical space between the Main (and Sub Footer) and bottom of page on large screens. Useful if you want to show the background.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<h2 class="react-panel-section-header"><?php esc_html_e('Padding fixes', 'react'); ?></h2>
								<!-- Top head padding ... -->
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Default / Desktop', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Large screens', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_tophead_right_padding"><?php esc_html_e('Top Header right padding', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for extra right padding', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_tophead_right_padding" id="page_layout_tophead_right_padding" value="<?php echo esc_attr($react['options']['page_layout_tophead_right_padding']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<!-- Show if TopHead off -->
													<div class="only_for_tophead"><p class="react-warning"><?php esc_html_e('Top Header section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
													<p class="react-description"><?php esc_html_e('Give the Top Header more right padding to accommodate the Pop Down trigger in absolute mode.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_tophead_right_padding_phones"><?php esc_html_e('Top Header right padding phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for extra right padding', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_tophead_right_padding_phones" id="page_layout_tophead_right_padding_phones" value="<?php echo esc_attr($react['options']['page_layout_tophead_right_padding_phones']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Give the Top Header more right padding to accommodate the Pop Down trigger in absolute mode on phones.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_tophead_right_padding_tablets"><?php esc_html_e('Top Header right padding tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for extra right padding', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_tophead_right_padding_tablets" id="page_layout_tophead_right_padding_tablets" value="<?php echo esc_attr($react['options']['page_layout_tophead_right_padding_tablets']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Give the Top Header more right padding to accommodate the Pop Down trigger in absolute mode on tablets.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_tophead_right_padding_tv"><?php esc_html_e('Top Header right padding large screens', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for extra right padding', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_tophead_right_padding_tv" id="page_layout_tophead_right_padding_tv" value="<?php echo esc_attr($react['options']['page_layout_tophead_right_padding_tv']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Give the Top Header more right padding to accommodate the Pop Down trigger in absolute mode on large screens.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<!-- Main head padding ... -->
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Default / Desktop', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Large screens', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_header_right_padding"><?php esc_html_e('Main Header right padding', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for extra right padding', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_header_right_padding" id="page_layout_header_right_padding" value="<?php echo esc_attr($react['options']['page_layout_header_right_padding']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Give the Main Header more right padding to accommodate the Pop Down trigger in absolute mode if Top Header is not in use.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_header_right_padding_phones"><?php esc_html_e('Main Header right padding phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for extra right padding', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_header_right_padding_phones" id="page_layout_header_right_padding_phones" value="<?php echo esc_attr($react['options']['page_layout_header_right_padding_phones']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Give the Main Header more right padding to accommodate the Pop Down trigger in absolute mode if Top Header is not in use on phones.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_header_right_padding_tablets"><?php esc_html_e('Main Header right padding tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for extra right padding', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_header_right_padding_tablets" id="page_layout_header_right_padding_tablets" value="<?php echo esc_attr($react['options']['page_layout_header_right_padding_tablets']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Give the Main Header more right padding to accommodate the Pop Down trigger in absolute mode if Top Header is not in use on tablets.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_header_right_padding_tv"><?php esc_html_e('Main Header right padding large screens', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for extra right padding', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_header_right_padding_tv" id="page_layout_header_right_padding_tv" value="<?php echo esc_attr($react['options']['page_layout_header_right_padding_tv']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Give the Main Header more right padding to accommodate the Pop Down trigger in absolute mode if Top Header is not in use on large screens.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<!-- Sub Footer padding ... -->
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Default / Desktop', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Large screens', 'react'); ?></span></li>
									</ul>
								</div>

								<div class="react-table-tabs">

									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_subfoot_right_padding"><?php esc_html_e('Sub Footer right padding', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for extra right padding', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_subfoot_right_padding" id="page_layout_subfoot_right_padding" value="<?php echo esc_attr($react['options']['page_layout_subfoot_right_padding']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<!-- Show if Sub Footer off -->
													<div class="only_for_subfooter"><p class="react-warning"><?php esc_html_e('Sub Footer section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
													<p class="react-description"><?php esc_html_e('Give the Sub Footer more right padding to accommodate the Go to top button. (60px avoid overlapping).', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_subfoot_right_padding_phones"><?php esc_html_e('Sub Footer right padding phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for extra right padding', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_subfoot_right_padding_phones" id="page_layout_subfoot_right_padding_phones" value="<?php echo esc_attr($react['options']['page_layout_subfoot_right_padding_phones']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Give the Sub Footer more right padding to accommodate the Go to top button on phones.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_subfoot_right_padding_tablets"><?php esc_html_e('Sub Footer right padding tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for extra right padding', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_subfoot_right_padding_tablets" id="page_layout_subfoot_right_padding_tablets" value="<?php echo esc_attr($react['options']['page_layout_subfoot_right_padding_tablets']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Give the Sub Footer more right padding to accommodate the Go to top button on tablets.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_layout_subfoot_right_padding_tv"><?php esc_html_e('Sub Footer right padding large screens', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a value for extra right padding', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_layout_subfoot_right_padding_tv" id="page_layout_subfoot_right_padding_tv" value="<?php echo esc_attr($react['options']['page_layout_subfoot_right_padding_tv']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Give the Sub Footer more right padding to accommodate the Go to top button on large screens.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Import a Case Study', 'react'); ?></h2>
								<?php if (!react_is_plugin_installed('wordpress-importer/wordpress-importer.php') ||
										  !react_is_plugin_installed('widget-importer-exporter/widget-importer-exporter.php') ||
										  function_exists('wordpress_importer_init') ||
										  class_exists('Widget_Importer_Exporter')
								  ) : ?>
									<?php if (!react_is_plugin_installed('wordpress-importer/wordpress-importer.php')) : ?>
										<p class="react-warning"><?php printf(esc_html__('The plugin "WordPress Importer" must be installed (but not activated) before you can import a Case Study. %sVisit the Install Plugins page%s to install it.', 'react'), '<a href="' . esc_url(admin_url('themes.php?page=tgmpa-install-plugins')) . '">', '</a>'); ?></p>
									<?php endif; ?>
									<?php if (!react_is_plugin_installed('widget-importer-exporter/widget-importer-exporter.php')) : ?>
										<p class="react-warning"><?php printf(esc_html__('The plugin "Widget Importer & Exporter" must be installed (but not activated) before you can import a Case Study. %sVisit the Install Plugins page%s to install it.', 'react'), '<a href="' . esc_url(admin_url('themes.php?page=tgmpa-install-plugins')) . '">', '</a>'); ?></p>
									<?php endif; ?>
									<?php if (function_exists('wordpress_importer_init')) : ?>
										<p class="react-warning"><?php esc_html_e('You must deactivate the plugin "WordPress Importer" before you can import a Case Study.', 'react'); ?></p>
									<?php endif; ?>
									<?php if (class_exists('Widget_Importer_Exporter')) : ?>
										<p class="react-warning"><?php esc_html_e('You must deactivate the plugin "Widget Importer & Exporter" before you can import a Case Study.', 'react'); ?></p>
									<?php endif; ?>
								<?php else : ?>
									<p><?php esc_html_e('On this page you can quickly install one of the Case Studies from the React demo.', 'react'); ?></p>
									<div class="react-case-study-import-wrap">
										<div class="react-clearfix"><div id="react-show-case-studies" class="react-button react-blue"><?php esc_html_e('Show Case Studies', 'react'); ?></div></div>
										<div id="react-case-studies" class="react-clearfix"></div>
									</div>
								<?php endif; ?>
							</div><!-- .react-sub-tab -->

						</div><!-- .react-sub-tabs -->
					</div>

					<!-- Global -->
					<div class="react-tab-1">
						<div class="react-sub-tabs-wrap">
							<ul class="react-sub-tabs-nav">
								<li><span><?php esc_html_e('Logo', 'react'); ?><span class="react-icon react-brand"></span></span></li>
								<li><span><?php esc_html_e('Header', 'react'); ?><span class="react-icon react-head"></span></span></li>
								<li><span><?php esc_html_e('Navigation', 'react'); ?><span class="react-icon react-nav"></span></span></li>
								<li><span><?php esc_html_e('Content', 'react'); ?><span class="react-icon react-content"></span></span></li>
								<li><span><?php esc_html_e('Footer', 'react'); ?><span class="react-icon react-foot"></span></span></li>
								<li><span><?php esc_html_e('Social', 'react'); ?><span class="react-icon react-social"></span></span></li>
							</ul>
						</div>
						<div class="react-sub-tabs">
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Upload a Logo', 'react'); ?></h2>
								<!-- Logo -->
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Logo', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Retina ready', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Alt Logo', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Alt Retina ready', 'react'); ?></span></li>
										<li><span><?php esc_html_e('SEO', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Logo image', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Your site logo is displayed in the Header', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-clearfix">
														<div class="react-multi-input-wrap">
															<label for="general_logo" class="react-mini-label"><?php esc_html_e('Image URL', 'react'); ?></label>
															<input type="text" name="general_logo" id="general_logo" value="<?php echo esc_attr($react['options']['general_logo']); ?>" class="react-width-400">
														</div>
														<div class="react-multi-input-wrap">
															<label for="general_logo_image_width" class="react-mini-label"><?php esc_html_e('Width', 'react'); ?></label>
															<input type="text" name="general_logo_image_width" id="general_logo_image_width" value="<?php echo esc_attr($react['options']['general_logo_image_width']); ?>" class="react-width-50">
														</div>
														<div class="react-multi-input-wrap">
															<label for="general_logo_image_height" class="react-mini-label"><?php esc_html_e('Height', 'react'); ?></label>
															<input type="text" name="general_logo_image_height" id="general_logo_image_height" value="<?php echo esc_attr($react['options']['general_logo_image_height']); ?>" class="react-width-50">
														</div>
													</div>
													<div class="react-upload-logo-button-wrap react-clearfix">
														<div id="general_logo_upload" class="react-media-button"><?php esc_html_e('Browse', 'react'); ?></div>
													</div>
												</td>
												<td class="react-form-table-logo-image-td">
													<div id="general_logo_upload_holder" class="react-clearfix react-upload-holder">
														<?php echo react_get_upload_thumbnail($react['options']['general_logo']); ?>
													</div>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										 <table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Double size logo', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('This will ensure the best quality on retina displays', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<label for="general_logo_double" class="react-mini-label"><?php esc_html_e('Image URL', 'react'); ?></label>
													<input type="text" name="general_logo_double" id="general_logo_double" value="<?php echo esc_attr($react['options']['general_logo_double']); ?>" class="react-width-400">
													<div class="react-upload-logo-double-button-wrap react-clearfix">
														<div id="general_logo_double_upload" class="react-media-button"><?php esc_html_e('Browse', 'react'); ?></div>
													</div>
												</td>
												<td class="react-form-table-logo-image-td">
													<div id="general_logo_double_upload_holder" class="react-clearfix react-upload-holder">
														<?php echo react_get_upload_thumbnail($react['options']['general_logo_double']); ?>
													</div>
												</td>
											</tr>
										</table>
									</div>

									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Logo image', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose an alternative logo for smaller devices. This will change at the Logo above convert point.', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-clearfix">
														<div class="react-multi-input-wrap">
															<label for="general_logo_alternative" class="react-mini-label"><?php esc_html_e('Image URL', 'react'); ?></label>
															<input type="text" name="general_logo_alternative" id="general_logo_alternative" value="<?php echo esc_attr($react['options']['general_logo_alternative']); ?>" class="react-width-400">
														</div>
														<div class="react-multi-input-wrap">
															<label for="general_logo_alternative_image_width" class="react-mini-label"><?php esc_html_e('Width', 'react'); ?></label>
															<input type="text" name="general_logo_alternative_image_width" id="general_logo_alternative_image_width" value="<?php echo esc_attr($react['options']['general_logo_alternative_image_width']); ?>" class="react-width-50">
														</div>
														<div class="react-multi-input-wrap">
															<label for="general_logo_alternative_image_height" class="react-mini-label"><?php esc_html_e('Height', 'react'); ?></label>
															<input type="text" name="general_logo_alternative_image_height" id="general_logo_alternative_image_height" value="<?php echo esc_attr($react['options']['general_logo_alternative_image_height']); ?>" class="react-width-50">
														</div>
													</div>
													<div class="react-upload-logo-button-wrap react-clearfix">
														<div id="general_logo_alternative_upload" class="react-media-button"><?php esc_html_e('Browse', 'react'); ?></div>
													</div>
												</td>
												<td class="react-form-table-logo-image-td">
													<div id="general_logo_alternative_upload_holder" class="react-clearfix react-upload-holder">
														<?php echo react_get_upload_thumbnail($react['options']['general_logo_alternative']); ?>
													</div>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										 <table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Double size logo', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('This will ensure the best quality on retina displays', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<label for="general_logo_alternative_double" class="react-mini-label"><?php esc_html_e('Image URL', 'react'); ?></label>
													<input type="text" name="general_logo_alternative_double" id="general_logo_alternative_double" value="<?php echo esc_attr($react['options']['general_logo_alternative_double']); ?>" class="react-width-400">
													<div class="react-upload-logo-double-button-wrap react-clearfix">
														<div id="general_logo_alternative_double_upload" class="react-media-button"><?php esc_html_e('Browse', 'react'); ?></div>
													</div>
												</td>
												<td class="react-form-table-logo-image-td">
													<div id="general_logo_alternative_double_upload_holder" class="react-clearfix react-upload-holder">
														<?php echo react_get_upload_thumbnail($react['options']['general_logo_alternative_double']); ?>
													</div>
												</td>
											</tr>
										</table>
									</div>

									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Title and Alt attribute text for SEO', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_logo_title" class="react-mini-label"><?php esc_html_e('Title', 'react'); ?></label>
														<input type="text" name="general_logo_title" id="general_logo_title" value="<?php echo esc_attr($react['options']['general_logo_title']); ?>" class="react-width-200" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="general_logo_alt" class="react-mini-label"><?php esc_html_e('Alt', 'react'); ?></label>
														<input type="text" name="general_logo_alt" id="general_logo_alt" value="<?php echo esc_attr($react['options']['general_logo_alt']); ?>" class="react-width-200" />
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Title text is shown when the user hovers the logo. The Alt text is shown in situations where images are not displayed. These attributes may also be read by search engines.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="general_logo_url"><?php esc_html_e('Logo link URL', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Where to go when user clicks your logo', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="general_logo_url" id="general_logo_url" value="<?php echo esc_attr($react['options']['general_logo_url']); ?>" class="react-width-400" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The page that the logo should link to; if left blank it will link to the home page.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="general_logo_strapline"><?php esc_html_e('Strapline Text', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enter some text to appear next to your logo', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<input type="text" name="general_logo_strapline" id="general_logo_strapline" value="<?php echo esc_attr($react['options']['general_logo_strapline']); ?>" class="react-width-400" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="general_logo_strapline_highlighted" class="react-mini-label"><?php esc_html_e('Highlighted text', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="general_logo_strapline_highlighted" id="general_logo_strapline_highlighted" <?php checked(true, $react['options']['general_logo_strapline_highlighted']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="general_logo_strapline_left" class="react-mini-label"><?php esc_html_e('Positioning left', 'react'); ?></label>
												<input type="text" class="react-width-50" name="general_logo_strapline_left" id="general_logo_strapline_left" value="<?php echo esc_attr($react['options']['general_logo_strapline_left']); ?>"> px
											</div>
											<div class="react-multi-input-wrap">
												<label for="general_logo_strapline_bottom" class="react-mini-label"><?php esc_html_e('Positioning top', 'react'); ?></label>
												<input type="text" class="react-width-50" name="general_logo_strapline_bottom" id="general_logo_strapline_bottom" value="<?php echo esc_attr($react['options']['general_logo_strapline_bottom']); ?>"> px
											</div>

										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Your company or website strapline. A small line of text that will be displayed under your logo.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<h2 class="react-panel-section-header"><?php esc_html_e('Logo positioning', 'react'); ?></h2>
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Top', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Left / Right', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="general_logo_top"><?php esc_html_e('Logo "top" position', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('The number of pixels the logo will be positioned at from the top of the Header', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="general_logo_top" id="general_logo_top" value="<?php echo esc_attr($react['options']['general_logo_top']); ?>" class="react-width-50 react-range-slider"  data-from="-200" data-to="200" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Set the CSS "top" position of the logo.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="general_logo_left"><?php esc_html_e('Logo "left" position', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('The number of pixels the logo will be positioned at from the left of the Header', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="general_logo_left" id="general_logo_left" value="<?php echo esc_attr($react['options']['general_logo_left']); ?>" class="react-width-50 react-range-slider" data-from="-200" data-to="200" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Set the CSS "left" position of the logo.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label id="general_logo_width_label" for="general_logo_width"><?php esc_html_e('Logo area width', 'react'); ?></label>
											<label id="general_logo_height_label" for="general_logo_width"><?php esc_html_e('Logo area height', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show the logo on the right', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="general_logo_width" id="general_logo_width" value="<?php echo esc_attr($react['options']['general_logo_width']); ?>" class="react-width-50 react-range-slider" data-from="0" data-to="800" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Modify the size of area your logo sits in. Choose a width if your logo is in the left or right position otherwise if you select Logo Above option this will be the height. ', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="general_logo_on_right"><?php esc_html_e('Logo positioning', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show the logo on the right', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="general_logo_on_right" class="react-mini-label"><?php esc_html_e('Switch main header direction (logo on right)', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="general_logo_on_right" id="general_logo_on_right" <?php checked(true, $react['options']['general_logo_on_right']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="general_logo_above" class="react-mini-label"><?php esc_html_e('Logo above', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="general_logo_above" id="general_logo_above" <?php checked(true, $react['options']['general_logo_above']); ?> value="1" />
											</div>

										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show logo on the right instead of on the left.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="logo_convert"><?php esc_html_e('Convert Logo for devices', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="general_logo_convert_absolute" class="react-mini-label"><?php esc_html_e('Choose convert point', 'react'); ?></label>
												<select name="logo_convert" id="logo_convert">
													<option value="phone-ptr" <?php selected($react['options']['logo_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
													<option value="phone-ldsp" <?php selected($react['options']['logo_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
													<option value="tablet-ptr" <?php selected($react['options']['logo_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
													<option value="tablet-ldsp" <?php selected($react['options']['logo_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
													<option value="box-width" <?php selected($react['options']['logo_convert'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
													<option value="never" <?php selected($react['options']['logo_convert'], 'never'); ?>><?php esc_html_e('Never', 'react'); ?></option>
													<option value="custom" <?php selected($react['options']['logo_convert'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap" id="logo_convert_custom_hide">
												<input type="text" name="logo_convert_custom" id="logo_convert_custom" value="<?php echo esc_attr($react['options']['logo_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
											<div class="react-multi-input-wrap">
												<label for="general_logo_convert_absolute" class="react-mini-label"><?php esc_html_e('Convet to absolute center', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="general_logo_convert_absolute" id="general_logo_convert_absolute" <?php checked(true, $react['options']['general_logo_convert_absolute']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose when you would like move the logo above the navigation items in the header. This will also swap to the Alternative Logo if added.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<h2 class="react-panel-section-header"><?php esc_html_e('Favicon', 'react'); ?></h2>

								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="general_favicon"><?php esc_html_e('Favicon', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enter the URL to your favicon or upload a file', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="general_favicon" id="general_favicon" value="<?php echo esc_attr($react['options']['general_favicon']); ?>" class="react-width-400" />
											<div class="react-upload-favicon-button-wrap react-clearfix">
												<div id="general_favicon_upload" class="react-media-button"><?php esc_html_e('Browse', 'react'); ?></div>
											</div>
											<label for="general_favicon_generate" class="react-mini-label"><?php esc_html_e('Generate touch icons from this image', 'react'); ?></label>
											<input type="checkbox" class="react-toggle-yn" name="general_favicon_generate" id="general_favicon_generate" <?php checked(true, $react['options']['general_favicon_generate']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The favicon image is shown in the browser tab next to the page title. If you choose an image file from the media library and the option below is enabled, the device icons will be created automatically. We recommend uploading a png file sized at 180 x 180 so that all possible device icons can be created from this one image.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->
							<!-- Header -->
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Header Options', 'react'); ?></h2>
								<!-- Show if TopHead off -->
								<div class="only_for_tophead"><p class="react-warning"><?php esc_html_e('Top Header section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="header_tophead_type"><?php esc_html_e('Top Header type', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a size of Top Header', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="header_tophead_type" name="header_tophead_type" class="react-header-tophead-type-selector">
												<?php foreach (react_get_header_tophead_type_options() as $value => $label) : ?>
													<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['header_tophead_type'], $value); ?>><?php echo esc_html($label); ?></option>
												<?php endforeach; ?>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Three sizes of Top Header to choose from depending on its relevance.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="header_mainheader_padding"><?php esc_html_e('Main header thickness', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value for the top and bottom padding', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="header_mainheader_padding" class="react-mini-label"><?php esc_html_e('Default', 'react'); ?></label>
												<input type="text" name="header_mainheader_padding" id="header_mainheader_padding" value="<?php echo esc_attr($react['options']['header_mainheader_padding']); ?>" class="react-width-50 react-range-slider" data-from="0" data-to="80" /><span class="react-range-unit">px</span>
											</div>
											<div class="react-multi-input-wrap">
												<label for="header_mainheader_padding_convert" class="react-mini-label"><?php esc_html_e('After logo convert', 'react'); ?></label>
												<input type="text" name="header_mainheader_padding_convert" id="header_mainheader_padding_convert" value="<?php echo esc_attr($react['options']['header_mainheader_padding_convert']); ?>" class="react-width-50 react-range-slider" data-from="0" data-to="80" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('This will increase or decrease the thickness of the main header area. You may need to adjust the Top value for your logo to match. Go to Logo - Logo Positioning to adjust your logo.', 'react'); ?></p>
										</td>
									</tr>
								</table>


								<h2 class="react-panel-section-header"><?php esc_html_e('Fixed Main Header', 'react'); ?></h2>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="show_header_social_icon"><?php esc_html_e('Fixed', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Fixed position header', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="main_header_fixed" class="react-mini-label"><?php esc_html_e('Fixed', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="main_header_fixed" id="main_header_fixed" <?php checked(true, $react['options']['main_header_fixed']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="main_header_no_margin" class="react-mini-label"><?php esc_html_e('Ignore margins', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="main_header_no_margin" id="main_header_no_margin" <?php checked(true, $react['options']['main_header_no_margin']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="main_header_top_fix" class="react-mini-label"><?php esc_html_e('Top space fix', 'react'); ?></label>
												<input type="text" name="main_header_top_fix" id="main_header_top_fix" value="<?php echo esc_attr($react['options']['main_header_top_fix']); ?>" class="react-width-50 react-range-slider" data-from="-1" data-to="600" /><span class="react-range-unit">px</span>
											</div>
											<div class="react-multi-input-wrap">
												<label for="main_header_fixed_convert" class="react-mini-label"><?php esc_html_e('Choose convert point', 'react'); ?></label>
												<select name="main_header_fixed_convert" id="main_header_fixed_convert">
													<option value="phone-ptr" <?php selected($react['options']['main_header_fixed_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
													<option value="phone-ldsp" <?php selected($react['options']['main_header_fixed_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
													<option value="tablet-ptr" <?php selected($react['options']['main_header_fixed_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
													<option value="tablet-ldsp" <?php selected($react['options']['main_header_fixed_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
													<option value="box-width" <?php selected($react['options']['main_header_fixed_convert'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
													<option value="never" <?php selected($react['options']['main_header_fixed_convert'], 'never'); ?>><?php esc_html_e('Never', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The header will be fixed to the top of the screen until the header Logo convert point. Adjust the margin to ensure your content is not hidden under the Header. This is not the Sticky header method, for this see Navigation tab.', 'react'); ?></p>
										</td>
									</tr>
								</table>



								<h2 class="react-panel-section-header"><?php esc_html_e('Contact menu', 'react'); ?></h2>
								<!-- Contact details -->
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Contact forms', 'react'); ?></span></li>
										<li><span><?php esc_html_e('More info', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-5-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Header phone numbers', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enter a phone number', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="header_contact_phone" class="react-mini-label"><?php esc_html_e('Phone 1', 'react'); ?></label>
														<input type="text" name="header_contact_phone" id="header_contact_phone" value="<?php echo esc_attr($react['options']['header_contact_phone']); ?>" />
													</div>
													<div class="react-multi-input-wrap">
														<label for="header_contact_phone" class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
														<?php echo react_icon_selector_field($react['options']['header_contact_phone_icon'], 'header_contact_phone_icon'); ?>
													</div>
													<div class="react-break"></div>
													<div class="react-multi-input-wrap">
														<label for="header_contact_phone_sales" class="react-mini-label"><?php esc_html_e('Phone 2 (e.g: Sales)', 'react'); ?></label>
														<input type="text" name="header_contact_phone_sales" id="header_contact_phone_sales" value="<?php echo esc_attr($react['options']['header_contact_phone_sales']); ?>" />
													</div>
													<div class="react-multi-input-wrap">
														<label class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
														<?php echo react_icon_selector_field($react['options']['header_contact_phone_sales_icon'], 'header_contact_phone_sales_icon'); ?>
													</div>
													<div class="react-break"></div>
													<div class="react-multi-input-wrap">
														<label for="header_contact_phone_support" class="react-mini-label"><?php esc_html_e('Phone 3 (e.g: Support)', 'react'); ?></label>
														<input type="text" name="header_contact_phone_support" id="header_contact_phone_support" value="<?php echo esc_attr($react['options']['header_contact_phone_support']); ?>" />
													</div>
													<div class="react-multi-input-wrap">
														<label class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
														<?php echo react_icon_selector_field($react['options']['header_contact_phone_support_icon'], 'header_contact_phone_support_icon'); ?>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('A method of displaying your company / website&#39;s contact details.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-5-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Header contact forms', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a form to show. Use Quform to build forms.', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row react-content-input-has-many">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap react-width-200">
														<label for="head_contact_quform_id" class="react-mini-label"><?php esc_html_e('Contact form 1', 'react'); ?></label>
														<?php echo react_render_quform_form_select('head_contact_quform_id', $react['options']['head_contact_quform_id']); ?>
													</div>
													<div class="react-multi-input-wrap react-width-200">
														<label class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
														<?php echo react_icon_selector_field($react['options']['head_contact_quform_id_icon'], 'head_contact_quform_id_icon'); ?>
													</div>
													<div class="react-multi-input-wrap react-width-200">
														<label for="head_contact_quform_id_trigger" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
														<input type="text" name="head_contact_quform_id_trigger" id="head_contact_quform_id_trigger" value="<?php echo esc_attr($react['options']['head_contact_quform_id_trigger']); ?>" />
													</div>
													<div class="react-break"></div>
													<div class="react-multi-input-wrap react-width-200">
														<label for="head_contact_quform_id_sales" class="react-mini-label"><?php esc_html_e('Contact form 2 (e.g: Sales)', 'react'); ?></label>
														<?php echo react_render_quform_form_select('head_contact_quform_id_sales', $react['options']['head_contact_quform_id_sales']); ?>
													</div>
													<div class="react-multi-input-wrap react-width-200">
														<label class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
														<?php echo react_icon_selector_field($react['options']['head_contact_quform_id_sales_icon'], 'head_contact_quform_id_sales_icon'); ?>
													</div>
													<div class="react-multi-input-wrap react-width-200">
														<label for="head_contact_quform_id_sales_trigger" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
														<input type="text" name="head_contact_quform_id_sales_trigger" id="head_contact_quform_id_sales_trigger" value="<?php echo esc_attr($react['options']['head_contact_quform_id_sales_trigger']); ?>" />
													</div>
													<div class="react-break"></div>
													<div class="react-multi-input-wrap react-width-200">
														<label for="head_contact_quform_id_support" class="react-mini-label"><?php esc_html_e('Contact form 3 (e.g: Support)', 'react'); ?></label>
														<?php echo react_render_quform_form_select('head_contact_quform_id_support', $react['options']['head_contact_quform_id_support']); ?>
													</div>
													<div class="react-multi-input-wrap react-width-200">
														<label class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
														<?php echo react_icon_selector_field($react['options']['head_contact_quform_id_support_icon'], 'head_contact_quform_id_support_icon'); ?>
													</div>
													<div class="react-multi-input-wrap react-width-200">
														<label for="head_contact_quform_id_support_trigger" class="react-mini-label"><?php esc_html_e('Text', 'react'); ?></label>
														<input type="text" name="head_contact_quform_id_support_trigger" id="head_contact_quform_id_support_trigger" value="<?php echo esc_attr($react['options']['head_contact_quform_id_support_trigger']); ?>" />
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Choose a contact form. Forms will be shown in a lightbox style pop-up. Use Quform to build your forms.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<!-- Top head info -->
									<div class="react-table-tab">
										<table class="react-form-table react-tab-5-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="top_header_info_box"><?php esc_html_e('Top Header contact information', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('For example: opening times, contact staff, etc', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<textarea name="top_header_info_box" id="top_header_info_box"><?php echo esc_textarea($react['options']['top_header_info_box']); ?></textarea>
													<?php echo react_icon_selector_field($react['options']['top_header_info_box_icon'], 'top_header_info_box_icon'); ?>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Enter useful information to be shown alongside your contact details in the Top Header.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="head_contact_style"><?php esc_html_e('Contact menu style', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a style for the contact links', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<select id="head_contact_style" name="head_contact_style">
												<option value="button-nav" <?php selected($react['options']['head_contact_style'], 'button-nav'); ?>><?php esc_html_e('Button', 'react'); ?></option>
												<option value="split-nav" <?php selected($react['options']['head_contact_style'], 'split-nav'); ?>><?php esc_html_e('Vertical break', 'react'); ?></option>
												<option value="plain-nav" <?php selected($react['options']['head_contact_style'], 'plain-nav'); ?>><?php esc_html_e('Plain text', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose a style for the contact links in the Top Header.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<h2 class="react-panel-section-header"><?php esc_html_e('Social icons', 'react'); ?></h2>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="show_header_social_icon"><?php esc_html_e('Show social icons', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Facebook, Twitter and much more', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="show_header_social_icon" id="show_header_social_icon" <?php checked(true, $react['options']['show_header_social_icon']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Social icons like Facebook, Twitter and Google+ can be shown in the Top Header. To add your social icon links go to Global &rarr; Social.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<div id="header_social_icon_type_hide">
									<!-- Social -->
									<table class="react-form-table react-tab-1-form-table">
										<tr class="react-settings-sub-head">
											<th colspan="2">
												<label for="header_social_icon_type"><?php esc_html_e('Social icon style', 'react'); ?></label>
												<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a style of icon', 'react'); ?></span></span>
											</th>
										</tr>
										<tr class="react-content-row">
											<td class="react-form-table-input-area-td">
												<div class="react-multi-input-wrap">
													<select id="header_social_icon_type" name="header_social_icon_type" class="react-social_icon_type-selector">
														<?php foreach (react_get_social_icon_type_options() as $value => $label) : ?>
															<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['header_social_icon_type'], $value); ?>><?php echo esc_html($label); ?></option>
														<?php endforeach; ?>
													</select>
												</div>
												<div class="react-multi-input-wrap">
													<label for="header_social_icon_animation" class="react-mini-label"><?php esc_html_e('Animation', 'react'); ?></label>
													<?php echo react_render_hover_animation_select('header_social_icon_animation', $react['options']['header_social_icon_animation']); ?>
												</div>
											</td>
											<td class="react-form-table-desc-td">
												<p class="react-description"><?php esc_html_e('Style of social icons used in the Top Header.', 'react'); ?></p>
											</td>
										</tr>
									</table>
								</div>
							</div><!-- .react-sub-tab -->
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Navigation options', 'react'); ?></h2>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="nav_prime_nav_location"><?php esc_html_e('Location of Primary nav', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Location of your primary navigation', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="nav_prime_nav_location" name="nav_prime_nav_location">
												<option value="prime_nav_in_head" <?php selected($react['options']['nav_prime_nav_location'], 'prime_nav_in_head'); ?>><?php esc_html_e('Main Header', 'react'); ?></option>
												<option value="prime_nav_in_solo" <?php selected($react['options']['nav_prime_nav_location'], 'prime_nav_in_solo'); ?>><?php esc_html_e('Solo Nav', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('There are two main navigation areas&#58; choose one for the primary menu and the other will automatically be the secondary area. Menus are created in WordPress Menu &rarr; Appearance &rarr; Menus.', 'react'); ?></p>
											<!-- Show if solonav off -->
											<div class="only_for_solonav"><p class="react-warning"><?php esc_html_e('Solo Nav section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="general_sticky_header"><?php esc_html_e('Sticky Navigation (always primary)', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('This will make the main navigation accessible all the time', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="general_sticky_header" class="react-mini-label"><?php esc_html_e('On / off', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="general_sticky_header" id="general_sticky_header" <?php checked(true, $react['options']['general_sticky_header']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="general_sticky_header_fullwidth" class="react-mini-label"><?php esc_html_e('Full width', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="general_sticky_header_fullwidth" id="general_sticky_header_fullwidth" <?php checked(true, $react['options']['general_sticky_header_fullwidth']); ?> value="1" />
											</div>
											<div class="react-break"></div>
											<div class="react-multi-input-wrap">
												<label for="header_sticky_padding" class="react-mini-label"><?php esc_html_e('Sticky header padding top/bottom', 'react'); ?></label>
												<input type="text" name="header_sticky_padding" id="header_sticky_padding" value="<?php echo esc_attr($react['options']['header_sticky_padding']); ?>" class="react-width-50 react-range-slider" data-from="0" data-to="80" /><span class="react-range-unit">px</span>
											</div>
											<div class="react-multi-input-wrap">
												<label for="header_sticky_logo_top" class="react-mini-label"><?php esc_html_e('Logo top position', 'react'); ?></label>
												<input type="text" name="header_sticky_logo_top" id="header_sticky_logo_top" value="<?php echo esc_attr($react['options']['header_sticky_logo_top']); ?>" class="react-width-50 react-range-slider" data-from="-1" data-to="100" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The header stays visible when scrolling down the page.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="general_nav_align"><?php esc_html_e('Main header nav alignment', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="general_nav_align" name="general_nav_align">
												<option value="" <?php selected($react['options']['general_nav_align'], ''); ?>><?php esc_html_e('Default', 'react'); ?></option>
												<option value="nav-align-left" <?php selected($react['options']['general_nav_align'], 'nav-align-left'); ?>><?php esc_html_e('Left', 'react'); ?></option>
												<option value="nav-align-right" <?php selected($react['options']['general_nav_align'], 'nav-align-right'); ?>><?php esc_html_e('Right', 'react'); ?></option>
												<option value="nav-align-center" <?php selected($react['options']['general_nav_align'], 'nav-align-center'); ?>><?php esc_html_e('Center', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Position the navigation items to the left or right.', 'react'); ?></p>
										</td>
									</tr>
								</table>


								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="sidr_trigger_style"><?php esc_html_e('Device menu style', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="sidr_trigger_style" name="sidr_trigger_style">
												<option value="plain-nav" <?php selected($react['options']['sidr_trigger_style'], 'plain-nav'); ?>><?php esc_html_e('Plain text', 'react'); ?></option>
												<option value="button-nav" <?php selected($react['options']['sidr_trigger_style'], 'button-nav'); ?>><?php esc_html_e('Button style', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Change the style of the navigation trigger. Colors will inherit from the Main Header nav colors.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Show home icon?', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('A small icon / button that links to your home page', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="nav_show_home_icon" class="react-mini-label"><?php esc_html_e('On / off', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="nav_show_home_icon" id="nav_show_home_icon" <?php checked(true, $react['options']['nav_show_home_icon']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
											<label for="nav_home_icon_style" class="react-mini-label"><?php esc_html_e('Style', 'react'); ?></label>
												<select id="nav_home_icon_style" name="nav_home_icon_style">
													<option value="button" <?php selected($react['options']['nav_home_icon_style'], 'button'); ?>><?php esc_html_e('Button', 'react'); ?></option>
													<option value="plain-dark" <?php selected($react['options']['nav_home_icon_style'], 'plain-dark'); ?>><?php esc_html_e('Plain dark', 'react'); ?></option>
													<option value="plain-light" <?php selected($react['options']['nav_home_icon_style'], 'plain-light'); ?>><?php esc_html_e('Plain light', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('A useful addition to your menu to link to site home page using an icon.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="nav_home_text"><?php esc_html_e('Nav Home text', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="nav_home_text" id="nav_home_text" value="<?php echo esc_attr($react['options']['nav_home_text']); ?>" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The text shown for the Home link on the device menu.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="solonav_general_search"><?php esc_html_e('Solo Nav search field', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Shows a search field in the Solo Nav', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="solonav_general_search" class="react-mini-label"><?php esc_html_e('Show search field', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="solonav_general_search" id="solonav_general_search" <?php checked(true, $react['options']['solonav_general_search']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="solonav_general_search_position" class="react-mini-label"><?php esc_html_e('Search bar location', 'react'); ?></label>
												<select id="solonav_general_search_position" name="solonav_general_search_position">
													<option value="" <?php selected($react['options']['solonav_general_search_position'], ''); ?>><?php esc_html_e('Default', 'react'); ?></option>
													<option value="right" <?php selected($react['options']['solonav_general_search_position'], 'right'); ?>><?php esc_html_e('On the right', 'react'); ?></option>
													<option value="left" <?php selected($react['options']['solonav_general_search_position'], 'left'); ?>><?php esc_html_e('On the left', 'react'); ?></option>
													<option value="fullwidth" <?php selected($react['options']['solonav_general_search_position'], 'fullwidth'); ?>><?php esc_html_e('Fullwidth', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<!-- Show if solonav off -->
											<div class="only_for_solonav"><p class="react-warning"><?php esc_html_e('Solo Nav section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
											<p class="react-description"><?php esc_html_e('Show the site search field in Solo Nav. For an alternative search position, see: Components &rarr; Info Menu &rarr; Search.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<h2 class="react-panel-section-header"><?php esc_html_e('Navigation styles', 'react'); ?></h2>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Navigation style', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<h3><?php esc_html_e('Main header Menu', 'react'); ?></h3>
											<div class="react-multi-input-wrap">
												<label for="head_nav_style" class="react-mini-label"><?php esc_html_e('Main Header style', 'react'); ?></label>
												<select id="head_nav_style" name="head_nav_style">
													<option value="button-nav" <?php selected($react['options']['head_nav_style'], 'button-nav'); ?>><?php esc_html_e('Button', 'react'); ?></option>
													<option value="button-nav hover" <?php selected($react['options']['head_nav_style'], 'button-nav hover'); ?>><?php esc_html_e('Button on hover', 'react'); ?></option>
													<option value="button-nav btm-brdr" <?php selected($react['options']['head_nav_style'], 'button-nav btm-brdr'); ?>><?php esc_html_e('Bottom border', 'react'); ?></option>
													<option value="split-nav" <?php selected($react['options']['head_nav_style'], 'split-nav'); ?>><?php esc_html_e('Vertical break', 'react'); ?></option>
													<option value="plain-nav" <?php selected($react['options']['head_nav_style'], 'plain-nav'); ?>><?php esc_html_e('Plain text', 'react'); ?></option>
													<option value="plain-nav subtle-link" <?php selected($react['options']['head_nav_style'], 'plain-nav subtle-link'); ?>><?php esc_html_e('Underline', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="head_nav_style_bold" class="react-mini-label"><?php esc_html_e('Main Header bold', 'react'); ?></label>
												<select id="head_nav_style_bold" name="head_nav_style_bold">
													<option value="" <?php selected($react['options']['head_nav_style_bold'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
													<option value="100" <?php selected($react['options']['head_nav_style_bold'], '100'); ?>>100</option>
													<option value="200" <?php selected($react['options']['head_nav_style_bold'], '200'); ?>>200</option>
													<option value="300" <?php selected($react['options']['head_nav_style_bold'], '300'); ?>>300</option>
													<option value="400" <?php selected($react['options']['head_nav_style_bold'], '400'); ?>>400</option>
													<option value="500" <?php selected($react['options']['head_nav_style_bold'], '500'); ?>>500</option>
													<option value="600" <?php selected($react['options']['head_nav_style_bold'], '600'); ?>>600</option>
													<option value="700" <?php selected($react['options']['head_nav_style_bold'], '700'); ?>>700</option>
													<option value="800" <?php selected($react['options']['head_nav_style_bold'], '800'); ?>>800</option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="head_nav_style_size" class="react-mini-label"><?php esc_html_e('Main Header size', 'react'); ?></label>
												<select id="head_nav_style_size" name="head_nav_style_size">
													<option value="" <?php selected($react['options']['head_nav_style_size'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
													<option value="11" <?php selected($react['options']['head_nav_style_size'], '11'); ?>>11px</option>
													<option value="12" <?php selected($react['options']['head_nav_style_size'], '12'); ?>>12px</option>
													<option value="13" <?php selected($react['options']['head_nav_style_size'], '13'); ?>>13px</option>
													<option value="14" <?php selected($react['options']['head_nav_style_size'], '14'); ?>>14px</option>
													<option value="15" <?php selected($react['options']['head_nav_style_size'], '15'); ?>>15px</option>
													<option value="16" <?php selected($react['options']['head_nav_style_size'], '16'); ?>>16px</option>
													<option value="17" <?php selected($react['options']['head_nav_style_size'], '17'); ?>>17px</option>
													<option value="18" <?php selected($react['options']['head_nav_style_size'], '18'); ?>>18px</option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="head_nav_style_upper" class="react-mini-label"><?php esc_html_e('Main Header uppercase', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="head_nav_style_upper" id="head_nav_style_upper" <?php checked(true, $react['options']['head_nav_style_upper']); ?> value="1" />
											</div>
											<div class="clear"></div>
											<div class="react-multi-input-wrap">
												<label for="head_nav_style_space" class="react-mini-label"><?php esc_html_e('Spacing', 'react'); ?></label>
												<input type="text" name="head_nav_style_space" id="head_nav_style_space" value="<?php echo esc_attr($react['options']['head_nav_style_space']); ?>" class="react-range-slider react-width-50" data-from="-5" data-to="15" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
											<div class="react-break"></div>
											<h3><?php esc_html_e('Solo Nav Menu', 'react'); ?></h3>
											<div class="react-multi-input-wrap">
												<label for="solo_nav_style" class="react-mini-label"><?php esc_html_e('Solo Nav style', 'react'); ?></label>
												<select id="solo_nav_style" name="solo_nav_style">
													<option value="button-nav" <?php selected($react['options']['solo_nav_style'], 'button-nav'); ?>><?php esc_html_e('Button', 'react'); ?></option>
													<option value="button-nav hover" <?php selected($react['options']['solo_nav_style'], 'button-nav hover'); ?>><?php esc_html_e('Button on hover', 'react'); ?></option>
													<option value="button-nav btm-brdr" <?php selected($react['options']['solo_nav_style'], 'button-nav btm-brdr'); ?>><?php esc_html_e('Bottom border', 'react'); ?></option>
													<option value="split-nav" <?php selected($react['options']['solo_nav_style'], 'split-nav'); ?>><?php esc_html_e('Vertical break', 'react'); ?></option>
													<option value="plain-nav" <?php selected($react['options']['solo_nav_style'], 'plain-nav'); ?>><?php esc_html_e('Plain text', 'react'); ?></option>
													<option value="plain-nav subtle-link" <?php selected($react['options']['solo_nav_style'], 'plain-nav subtle-link'); ?>><?php esc_html_e('Underline', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="solo_nav_style_bold" class="react-mini-label"><?php esc_html_e('Solo Nav bold', 'react'); ?></label>
												<select id="solo_nav_style_bold" name="solo_nav_style_bold">
													<option value="" <?php selected($react['options']['solo_nav_style_bold'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
													<option value="100" <?php selected($react['options']['solo_nav_style_bold'], '100'); ?>>100</option>
													<option value="200" <?php selected($react['options']['solo_nav_style_bold'], '200'); ?>>200</option>
													<option value="300" <?php selected($react['options']['solo_nav_style_bold'], '300'); ?>>300</option>
													<option value="400" <?php selected($react['options']['solo_nav_style_bold'], '400'); ?>>400</option>
													<option value="500" <?php selected($react['options']['solo_nav_style_bold'], '500'); ?>>500</option>
													<option value="600" <?php selected($react['options']['solo_nav_style_bold'], '600'); ?>>600</option>
													<option value="700" <?php selected($react['options']['solo_nav_style_bold'], '700'); ?>>700</option>
													<option value="800" <?php selected($react['options']['solo_nav_style_bold'], '800'); ?>>800</option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="solo_nav_style_size" class="react-mini-label"><?php esc_html_e('Main Header size', 'react'); ?></label>
												<select id="solo_nav_style_size" name="solo_nav_style_size">
													<option value="" <?php selected($react['options']['solo_nav_style_size'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
													<option value="11" <?php selected($react['options']['solo_nav_style_size'], '11'); ?>>11px</option>
													<option value="12" <?php selected($react['options']['solo_nav_style_size'], '12'); ?>>12px</option>
													<option value="13" <?php selected($react['options']['solo_nav_style_size'], '13'); ?>>13px</option>
													<option value="14" <?php selected($react['options']['solo_nav_style_size'], '14'); ?>>14px</option>
													<option value="15" <?php selected($react['options']['solo_nav_style_size'], '15'); ?>>15px</option>
													<option value="16" <?php selected($react['options']['solo_nav_style_size'], '16'); ?>>16px</option>
													<option value="17" <?php selected($react['options']['solo_nav_style_size'], '17'); ?>>17px</option>
													<option value="18" <?php selected($react['options']['solo_nav_style_size'], '18'); ?>>18px</option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="solo_nav_style_upper" class="react-mini-label"><?php esc_html_e('Solo Nav uppercase', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="solo_nav_style_upper" id="solo_nav_style_upper" <?php checked(true, $react['options']['solo_nav_style_upper']); ?> value="1" />
											</div>
											<div class="clear"></div>
											<div class="react-multi-input-wrap">
												<label for="solo_nav_style_space" class="react-mini-label"><?php esc_html_e('Spacing', 'react'); ?></label>
												<input type="text" name="solo_nav_style_space" id="solo_nav_style_space" value="<?php echo esc_attr($react['options']['solo_nav_style_space']); ?>" class="react-range-slider react-width-50" data-from="-5" data-to="15" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
											<div class="react-break"></div>
											<h3><?php esc_html_e('Top head Menu', 'react'); ?></h3>
											<div class="react-multi-input-wrap">
												<label for="tophead_nav_style" class="react-mini-label"><?php esc_html_e('Top Header style', 'react'); ?></label>
												<select id="tophead_nav_style" name="tophead_nav_style">
													<option value="button-nav" <?php selected($react['options']['tophead_nav_style'], 'button-nav'); ?>><?php esc_html_e('Button', 'react'); ?></option>
													<option value="button-nav hover" <?php selected($react['options']['tophead_nav_style'], 'button-nav hover'); ?>><?php esc_html_e('Button on hover', 'react'); ?></option>
													<option value="button-nav btm-brdr" <?php selected($react['options']['tophead_nav_style'], 'button-nav btm-brdr'); ?>><?php esc_html_e('Bottom border', 'react'); ?></option>
													<option value="split-nav" <?php selected($react['options']['tophead_nav_style'], 'split-nav'); ?>><?php esc_html_e('Vertical break', 'react'); ?></option>
													<option value="plain-nav" <?php selected($react['options']['tophead_nav_style'], 'plain-nav'); ?>><?php esc_html_e('Plain text', 'react'); ?></option>
													<option value="plain-nav subtle-link" <?php selected($react['options']['tophead_nav_style'], 'plain-nav subtle-link'); ?>><?php esc_html_e('Underline', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="tophead_nav_style_bold" class="react-mini-label"><?php esc_html_e('Top Header bold', 'react'); ?></label>
												<select id="tophead_nav_style_bold" name="tophead_nav_style_bold">
													<option value="" <?php selected($react['options']['tophead_nav_style_bold'], ''); ?>><?php esc_html_e('Inherit', 'react'); ?></option>
													<option value="100" <?php selected($react['options']['tophead_nav_style_bold'], '100'); ?>>100</option>
													<option value="200" <?php selected($react['options']['tophead_nav_style_bold'], '200'); ?>>200</option>
													<option value="300" <?php selected($react['options']['tophead_nav_style_bold'], '300'); ?>>300</option>
													<option value="400" <?php selected($react['options']['tophead_nav_style_bold'], '400'); ?>>400</option>
													<option value="500" <?php selected($react['options']['tophead_nav_style_bold'], '500'); ?>>500</option>
													<option value="600" <?php selected($react['options']['tophead_nav_style_bold'], '600'); ?>>600</option>
													<option value="700" <?php selected($react['options']['tophead_nav_style_bold'], '700'); ?>>700</option>
													<option value="800" <?php selected($react['options']['tophead_nav_style_bold'], '800'); ?>>800</option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="tophead_nav_style_upper" class="react-mini-label"><?php esc_html_e('Top Header uppercase', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="tophead_nav_style_upper" id="tophead_nav_style_upper" <?php checked(true, $react['options']['tophead_nav_style_upper']); ?> value="1" />
											</div>
											<div class="clear"></div>
											<div class="react-multi-input-wrap">
												<label for="tophead_nav_style_space" class="react-mini-label"><?php esc_html_e('Spacing', 'react'); ?></label>
												<input type="text" name="tophead_nav_style_space" id="tophead_nav_style_space" value="<?php echo esc_attr($react['options']['tophead_nav_style_space']); ?>" class="react-range-slider react-width-50" data-from="-5" data-to="15" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
										</td>

										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Style the menu navigation links using the options. The styling applies to the areas in which the menus are located, not to the menus themselves.', 'react'); ?></p>
											<!-- Show if TopHead off -->
											<div class="only_for_tophead"><p class="react-warning"><?php esc_html_e('Top Header section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
											<!-- Show if solonav off -->
											<div class="only_for_solonav"><p class="react-warning"><?php esc_html_e('Solo Nav section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Description type', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('A Menu Description is an additional line of text for the menu links', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="head_nav_desc_location" class="react-mini-label"><?php esc_html_e('Main Header', 'react'); ?></label>
												<select id="head_nav_desc_location" name="head_nav_desc_location">
													<option value="desc-on" <?php selected($react['options']['head_nav_desc_location'], 'desc-on'); ?>><?php esc_html_e('Always show', 'react'); ?></option>
													<option value="desc-hover" <?php selected($react['options']['head_nav_desc_location'], 'desc-hover'); ?>><?php esc_html_e('Show on hover', 'react'); ?></option>
													<option value="desc-never" <?php selected($react['options']['head_nav_desc_location'], 'desc-never'); ?>><?php esc_html_e('Never show', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="solo_nav_desc_location" class="react-mini-label"><?php esc_html_e('Solo Nav', 'react'); ?></label>
												<select id="solo_nav_desc_location" name="solo_nav_desc_location">
													<option value="desc-on" <?php selected($react['options']['solo_nav_desc_location'], 'desc-on'); ?>><?php esc_html_e('Always show', 'react'); ?></option>
													<option value="desc-hover" <?php selected($react['options']['solo_nav_desc_location'], 'desc-hover'); ?>><?php esc_html_e('Show on hover', 'react'); ?></option>
													<option value="desc-never" <?php selected($react['options']['solo_nav_desc_location'], 'desc-never'); ?>><?php esc_html_e('Never show', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="tophead_nav_desc_location" class="react-mini-label"><?php esc_html_e('Top Header', 'react'); ?></label>
												<select id="tophead_nav_desc_location" name="tophead_nav_desc_location">
													<option value="desc-hover" <?php selected($react['options']['tophead_nav_desc_location'], 'desc-hover'); ?>><?php esc_html_e('Show on hover', 'react'); ?></option>
													<option value="desc-never" <?php selected($react['options']['tophead_nav_desc_location'], 'desc-never'); ?>><?php esc_html_e('Never show', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose how to display the menu items description. You can set a description in WordPress &rarr; Appearance &rarr; Menus &rarr; Item (expand it) - Description. If you can not see the Description field, go to the Screen Options on the top right of the page and enable Descriptions.', 'react'); ?></p>
											<!-- Show if TopHead off -->
											<div class="only_for_tophead"><p class="react-warning"><?php esc_html_e('Top Header section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
											<!-- Show if solonav off -->
											<div class="only_for_solonav"><p class="react-warning"><?php esc_html_e('Solo Nav section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
										</td>
									</tr>
								</table>
								<h2 class="react-panel-section-header"><?php esc_html_e('Navigation convert points', 'react'); ?></h2>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="nav_convert"><?php esc_html_e('When to swap Main Header and Solo Nav to the Device Menu', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<select name="nav_convert" id="nav_convert">
													<option value="phone-ptr" <?php selected($react['options']['nav_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
													<option value="phone-ldsp" <?php selected($react['options']['nav_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
													<option value="tablet-ptr" <?php selected($react['options']['nav_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
													<option value="tablet-ldsp" <?php selected($react['options']['nav_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
													<option value="box-width" <?php selected($react['options']['nav_convert'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
													<option value="never" <?php selected($react['options']['nav_convert'], 'never'); ?>><?php esc_html_e('Never', 'react'); ?></option>
													<option value="custom" <?php selected($react['options']['nav_convert'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
													<option value="always" <?php selected($react['options']['nav_convert'], 'always'); ?>><?php esc_html_e('Always', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap" id="nav_convert_custom_hide">
												<input type="text" name="nav_convert_custom" id="nav_convert_custom" value="<?php echo esc_attr($react['options']['nav_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('A menu can take up too much space on smaller devices. Choose when you would like to convert it.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="top_nav_convert"><?php esc_html_e('When to swap Top Header nav to Device Menu', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<select name="top_nav_convert" id="top_nav_convert">
													<option value="phone-ptr" <?php selected($react['options']['top_nav_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
													<option value="phone-ldsp" <?php selected($react['options']['top_nav_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
													<option value="tablet-ptr" <?php selected($react['options']['top_nav_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
													<option value="tablet-ldsp" <?php selected($react['options']['top_nav_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
													<option value="box-width" <?php selected($react['options']['top_nav_convert'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
													<option value="never" <?php selected($react['options']['top_nav_convert'], 'never'); ?>><?php esc_html_e('Never', 'react'); ?></option>
													<option value="custom" <?php selected($react['options']['top_nav_convert'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
													<option value="always" <?php selected($react['options']['top_nav_convert'], 'always'); ?>><?php esc_html_e('Always', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap" id="top_nav_convert_custom_hide">
												<input type="text" name="top_nav_convert_custom" id="top_nav_convert_custom" value="<?php echo esc_attr($react['options']['top_nav_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<!-- Show if TopHead off -->
											<div class="only_for_tophead"><p class="react-warning"><?php esc_html_e('Top Header section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
											<p class="react-description"><?php esc_html_e('A menu can take up too much space on smaller devices. Choose when you would like to convert it.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="sidr_displace"><?php esc_html_e('Device menu options', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="sidr_displace" class="react-mini-label"><?php esc_html_e('Displace content', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Should the page content move with the menu or stay where it is?', 'react'); ?></span></span></label>
												<input type="checkbox" class="react-toggle" name="sidr_displace" id="sidr_displace" <?php checked(true, $react['options']['sidr_displace']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="sidr_speed" class="react-mini-label"><?php esc_html_e('Slide animation speed', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('The speed of the slide animation when opening and closing the device menu', 'react'); ?></span></span></label>
												<input type="text" name="sidr_speed" id="sidr_speed" value="<?php echo esc_attr($react['options']['sidr_speed']); ?>" class="react-width-60" /><span class="react-range-unit">ms</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Displays a link to scroll to the top of the page.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<h2 class="react-panel-section-header"><?php esc_html_e('Go to top / Go down', 'react'); ?></h2>

								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="footer_top_link"><?php esc_html_e('"Top" link', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show / hide a button to return to the top of the page', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="footer_top_link" id="footer_top_link" <?php checked(true, $react['options']['footer_top_link']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Displays a link to scroll to the top of the page.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="go_down_link"><?php esc_html_e('Go down arrow', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="show_popdown_desktop" class="react-mini-label"><?php esc_html_e('On / off', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="go_down_link" id="go_down_link" <?php checked(true, $react['options']['go_down_link']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="go_down_link_location" class="react-mini-label"><?php esc_html_e('Where to link to?', 'react'); ?></label>
												<select name="go_down_link_location" id="go_down_link_location">
													<?php foreach (react_get_go_down_link_locations() as $value => $label) : ?>
														<option value="<?php echo esc_attr($value); ?>" <?php selected($react['options']['go_down_link_location'], $value); ?>><?php echo esc_html($label); ?></option>
													<?php endforeach; ?>
												</select>
											</div>


										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Indicate to the user that there is more content on the page. This will add a button to scroll to the start of the content.', 'react'); ?></p>
										</td>
									</tr>
								</table>

							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Content Options', 'react'); ?></h2>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="general_layout"><?php esc_html_e('Layout', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose the default position of the content area and sidebar', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="general_layout" name="general_layout" class="react-layout-selector">
												<option value="left-sidebar" <?php selected($react['options']['general_layout'], 'left-sidebar'); ?>><?php esc_html_e('Left sidebar', 'react'); ?></option>
												<option value="full-width" <?php selected($react['options']['general_layout'], 'full-width'); ?>><?php esc_html_e('Full width', 'react'); ?></option>
												<option value="right-sidebar"<?php selected($react['options']['general_layout'], 'right-sidebar'); ?>><?php esc_html_e('Right sidebar', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the default layout.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="general_read_more_text"><?php esc_html_e('"Read More" text', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Examples&#58; Read more, Continue, See more, More, Continue reading, etc', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="general_read_more_text" id="general_read_more_text" value="<?php echo esc_attr($react['options']['general_read_more_text']); ?>" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The text of the "Read More" button for posts.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<h2 class="react-panel-section-header"><?php esc_html_e('Sidebar (and widgets)', 'react'); ?></h2>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="sidebar_boxed_style"><?php esc_html_e('Boxed style widgets', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="sidebar_boxed_style" class="react-mini-label"><?php esc_html_e('Sidebar', 'react'); ?></label>
												<input type="checkbox" class="react-toggle bc-toggle-yn" name="sidebar_boxed_style" id="sidebar_boxed_style" <?php checked(true, $react['options']['sidebar_boxed_style']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="popdown_boxed_style" class="react-mini-label"><?php esc_html_e('Popdown', 'react'); ?></label>
												<input type="checkbox" class="react-toggle bc-toggle-yn" name="popdown_boxed_style" id="popdown_boxed_style" <?php checked(true, $react['options']['popdown_boxed_style']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="footer_boxed_style" class="react-mini-label"><?php esc_html_e('Footer', 'react'); ?></label>
												<input type="checkbox" class="react-toggle bc-toggle-yn" name="footer_boxed_style" id="footer_boxed_style" <?php checked(true, $react['options']['footer_boxed_style']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Display the widgets with a boxed style.', 'react'); ?></p>
										</td>
									</tr>
								</table>




								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="sidebar_style"><?php esc_html_e('Style of sidebar', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="sidebar_choose_scheme" class="react-mini-label"><?php esc_html_e('Choose a style', 'react'); ?></label>
												<select name="sidebar_style" id="sidebar_style">
													<option value="" <?php selected($react['options']['sidebar_style'], ''); ?>><?php esc_html_e('Plain', 'react'); ?></option>
													<option value="sdbr-line" <?php selected($react['options']['sidebar_style'], 'sdbr-line'); ?>><?php esc_html_e('Seperated', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
											<label for="sidebar_choose_scheme" class="react-mini-label"><?php esc_html_e('Choose a Color Palette', 'react'); ?></label>
												<select id="sidebar_choose_scheme" name="sidebar_choose_scheme" class="react-custom-palette-selector">
													<option value="" <?php selected($react['options']['sidebar_choose_scheme'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
													<?php echo react_render_custom_palette_options($react['options']['sidebar_choose_scheme']); ?>
												 </select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose a width for the page sidebar&#59; the content area will automatically fit to accommodate the sidebar width.', 'react'); ?></p>
										</td>
									</tr>
								</table>





								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="sidebar_width"><?php esc_html_e('Width of sidebar', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a width in percentage', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="sidebar_width" id="sidebar_width" value="<?php echo esc_attr($react['options']['sidebar_width']); ?>" class="react-range-slider react-width-50" data-from="10" data-to="50" data-step="1" data-dimension="%" /><span class="react-range-unit">%</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose a width for the page sidebar&#59; the content area will automatically fit to accommodate the sidebar width.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="widget_title_style"><?php esc_html_e('Style of H3 widget title', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="widget_title_style" id="widget_title_style">
												<option value="" <?php selected($react['options']['widget_title_style'], ''); ?>><?php esc_html_e('Plain', 'react'); ?></option>
												<option value="underline" <?php selected($react['options']['widget_title_style'], 'underline'); ?>><?php esc_html_e('Underline', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose to add an underline to the widget titles.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Convert the sidebar', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="sidebar_convert" class="react-mini-label"><?php esc_html_e('When to make the first break', 'react'); ?></label>
												<select name="sidebar_convert" id="sidebar_convert">
													<option value="phone-ptr" <?php selected($react['options']['sidebar_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
													<option value="phone-ldsp" <?php selected($react['options']['sidebar_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
													<option value="tablet-ptr" <?php selected($react['options']['sidebar_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
													<option value="tablet-ldsp" <?php selected($react['options']['sidebar_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
													<option value="box-width" <?php selected($react['options']['sidebar_convert'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
													<option value="never" <?php selected($react['options']['sidebar_convert'], 'never'); ?>><?php esc_html_e('Never', 'react'); ?></option>
													<option value="custom" <?php selected($react['options']['sidebar_convert'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap" id="sidebar_convert_custom_hide">
												<input type="text" name="sidebar_convert_custom" id="sidebar_convert_custom" value="<?php echo esc_attr($react['options']['sidebar_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
											<div class="react-multi-input-wrap">
												<label for="sidebar_convert_columns" class="react-mini-label"><?php esc_html_e('Number of columns to convert', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('The first breakpoint can be set above, the second breakpoint will happen for phone landscape size.', 'react'); ?></span></span></label>
												<select name="sidebar_convert_columns" id="sidebar_convert_columns">
													<option value="revcol-1-1" <?php selected($react['options']['sidebar_convert_columns'], 'revcol-1-1'); ?>><?php esc_html_e('1st break 1 column, Phone 1 column', 'react'); ?></option>
													<option value="revcol-1-2" <?php selected($react['options']['sidebar_convert_columns'], 'revcol-1-2'); ?>><?php esc_html_e('1st break 2 columns, Phone 1 column', 'react'); ?></option>
													<option value="revcol-1-3" <?php selected($react['options']['sidebar_convert_columns'], 'revcol-1-3'); ?>><?php esc_html_e('1st break 3 columns, Phone 1 column', 'react'); ?></option>
													<option value="revcol-2-2" <?php selected($react['options']['sidebar_convert_columns'], 'revcol-2-2'); ?>><?php esc_html_e('1st break 2 columns, Phone 2 columns', 'react'); ?></option>
													<option value="revcol-2-3" <?php selected($react['options']['sidebar_convert_columns'], 'revcol-2-3'); ?>><?php esc_html_e('1st break 3 columns, Phone 2 columns', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="sidebar_masonry" class="react-mini-label"><?php esc_html_e('Sidebar masonry', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="sidebar_masonry" id="sidebar_masonry" <?php checked(true, $react['options']['sidebar_masonry']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Select when the sidebar should be moved under the content area. This will give content displayed in these area more space on smaller screens.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<h2 class="react-panel-section-header"><?php esc_html_e('Breadcrumbs', 'react'); ?></h2>
								<?php if (function_exists('bcn_display') || function_exists('yoast_breadcrumb')) : ?>
									<table class="react-form-table react-tab-1-form-table">
										<tr class="react-settings-sub-head">
											<th colspan="2">
												<label for="general_breadcrumbs"><?php esc_html_e('Breadcrumbs', 'react'); ?></label>
												<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Breadcrumbs are links at the top of the content area that show the location of the current page', 'react'); ?></span></span>
											</th>
										</tr>
										<tr class="react-content-row">
											<td class="react-form-table-input-area-td">
												<input type="checkbox" class="react-toggle" name="general_breadcrumbs" id="general_breadcrumbs" <?php checked(true, $react['options']['general_breadcrumbs']); ?> value="1" />
											</td>
											<td class="react-form-table-desc-td">
												<p class="react-description"><?php esc_html_e('Enable breadcrumbs navigation.', 'react'); ?></p>
											</td>
										</tr>
									</table>
									<div id="general_breadcrumbs_home_icon_hide">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Breadcrumbs home icon', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('A small icon / button that links to your home page', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-multi-input-wrap">
														<label for="general_breadcrumbs_home_icon" class="react-mini-label"><?php esc_html_e('Show home icon', 'react'); ?></label>
														<input type="checkbox" class="react-toggle" name="general_breadcrumbs_home_icon" id="general_breadcrumbs_home_icon" <?php checked(true, $react['options']['general_breadcrumbs_home_icon']); ?> value="1" />
													</div>
													<div class="react-multi-input-wrap">
													<label for="general_breadcrumbs_home_icon_style" class="react-mini-label"><?php esc_html_e('Icon style', 'react'); ?></label>
														<select id="general_breadcrumbs_home_icon_style" name="general_breadcrumbs_home_icon_style">
															<option value="button" <?php selected($react['options']['general_breadcrumbs_home_icon_style'], 'button'); ?>><?php esc_html_e('Button', 'react'); ?></option>
															<option value="plain-dark" <?php selected($react['options']['general_breadcrumbs_home_icon_style'], 'plain-dark'); ?>><?php esc_html_e('Plain dark', 'react'); ?></option>
															<option value="plain-light" <?php selected($react['options']['general_breadcrumbs_home_icon_style'], 'plain-light'); ?>><?php esc_html_e('Plain light', 'react'); ?></option>
														</select>
													</div>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('A useful addition to the Breadcrumbs to link to site home page using an icon.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								<?php else : ?>
									<input type="checkbox" class="react-hidden" name="general_breadcrumbs" id="general_breadcrumbs" <?php checked(true, $react['options']['general_breadcrumbs']); ?> value="1" />
									<input type="checkbox" class="react-hidden" name="general_breadcrumbs_home_icon" id="general_breadcrumbs_home_icon" <?php checked(true, $react['options']['general_breadcrumbs_home_icon']); ?> value="1" />
									<input type="hidden" name="general_breadcrumbs_home_icon_style" id="general_breadcrumbs_home_icon_style" value="<?php echo esc_attr($react['options']['general_breadcrumbs_home_icon_style']); ?>">
									<p class="react-warning"><?php esc_html_e('You must install and activate the Breadcrumb NavXT or Yoast SEO plugin first.', 'react'); ?></p>
								<?php endif; ?>

								<h2 class="react-panel-section-header"><?php esc_html_e('Intro', 'react'); ?></h2>
								<!-- Show if Intro off -->
								<div class="only_for_intro"><p class="react-warning"><?php esc_html_e('Intro section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="intro_title_style"><?php esc_html_e('Style of Intro title', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="intro_title_style" class="react-mini-label"><?php esc_html_e('Style', 'react'); ?></label>
												<select name="intro_title_style" id="intro_title_style">
													<?php foreach (react_get_intro_title_style_options() as $value => $label) : ?>
														<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['intro_title_style'], $value); ?>><?php echo esc_html($label); ?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="intro_title_position" class="react-mini-label"><?php esc_html_e('Position', 'react'); ?></label>
												<select name="intro_title_position" id="intro_title_position">
													<?php foreach (react_get_intro_title_position_options() as $value => $label) : ?>
														<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['intro_title_position'], $value); ?>><?php echo esc_html($label); ?></option>
													<?php endforeach; ?>
												</select>
											</div>

											<div class="react-multi-input-wrap">
												<label for="intro_title_position_mobiles" class="react-mini-label"><?php esc_html_e('Responsive position', 'react'); ?></label>
												<select name="intro_title_position_mobiles" id="intro_title_position_mobiles">
													<?php foreach (react_get_intro_title_position_mobiles_options() as $value => $label) : ?>
														<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['intro_title_position_mobiles'], $value); ?>><?php echo esc_html($label); ?></option>
													<?php endforeach; ?>
												</select>
											</div>

										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Some extra style options for the text within the Intro section. Useful for when a background image is used on the Intro. Giving the text a background will help make it more legible.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="intro_padding"><?php esc_html_e('Intro padding', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="intro_padding" id="intro_padding" value="<?php echo esc_attr($react['options']['intro_padding']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="150" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Increase or decrease the vertical space inside the intro.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="intro_animation"><?php esc_html_e('Animation', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="intro_animation" class="react-mini-label"><?php esc_html_e('Animation', 'react'); ?></label>
												<?php echo react_render_animation_select('intro_animation', $react['options']['intro_animation']); ?>
											</div>

											<div class="react-multi-input-wrap">
												<label for="intro_animation_delay" class="react-mini-label"><?php esc_html_e('Delay', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Delay the start of the animation by this number of milliseconds.', 'react'); ?></span></span></label>
												<input type="text" name="intro_animation_delay" id="intro_animation_delay" value="<?php echo esc_attr($react['options']['intro_animation_delay']); ?>" class="react-width-60" /><span class="react-range-unit">ms</span>
											</div>

											<div class="react-multi-input-wrap">
												<label for="intro_animation_offset" class="react-mini-label"><?php esc_html_e('Offset', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('If the number is positive, the animation will start when the element is this number of pixels below the viewport. If the number is negative, the animation will not start until the element is this number of pixels inside the viewport.', 'react'); ?></span></span></label>
												<input type="text" name="intro_animation_offset" id="intro_animation_offset" value="<?php echo esc_attr($react['options']['intro_animation_offset']); ?>" class="react-width-60" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('A subtle animation that is triggered when the Intro comes into view.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<h2 class="react-panel-section-header"><?php esc_html_e('Search options', 'react'); ?></h2>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="search_tag_cloud"><?php esc_html_e('Add tag cloud to empty search results page', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="search_tag_cloud" id="search_tag_cloud" <?php checked(true, $react['options']['search_tag_cloud']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Adds a tag cloud to the search results page when there are no results, to help the user find the content they are looking for.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<h2 class="react-panel-section-header"><?php esc_html_e('Smooth scroll options', 'react'); ?></h2>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="smooth_scroll_links"><?php esc_html_e('Smooth scroll to anchor links on the same page', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="smooth_scroll_links" id="smooth_scroll_links" <?php checked(true, $react['options']['smooth_scroll_links']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Enables animated scrolling to anchor links on the same page as the link.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="smooth_scroll_on_load"><?php esc_html_e('Smooth scroll to anchor links on page load', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="smooth_scroll_on_load" id="smooth_scroll_on_load" <?php checked(true, $react['options']['smooth_scroll_on_load']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Enables animated scrolling to anchor links on page load, if the URL contains a matching hash.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="smooth_scroll_offset"><?php esc_html_e('Smooth scroll offset', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="smooth_scroll_offset" id="smooth_scroll_offset" class="react-width-60" value="<?php echo esc_attr($react['options']['smooth_scroll_offset']); ?>" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('End the scroll animation with the target this number of pixels below the top of the viewport. Useful if you have a fixed header, set it to the pixel height of the header and a bit extra.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Footer Options', 'react'); ?></h2>
								<!-- Show if Sub Footer off -->
								<div class="only_for_subfooter"><p class="react-warning"><?php esc_html_e('Sub Footer section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="footer_left_content"><?php esc_html_e('Copyright information', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Let users know if your website is copyrighted', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<textarea name="footer_left_content" id="footer_left_content"><?php echo esc_textarea($react['options']['footer_left_content']); ?></textarea>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Copyright information. You are free to change this text to anything you like. The HTML symbol for copyright is &#38;copy&#59;', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="footer_end_page_popout"><?php esc_html_e('Bottom of page pop out', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Add HTML or shortcodes, e.g. add useful or interesting links to keep users moving through your site', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<textarea name="footer_end_page_popout" id="footer_end_page_popout"><?php echo esc_textarea($react['options']['footer_end_page_popout']); ?></textarea>

											<div class="react-multi-input-wrap">
											<label for="footer_end_page_popout_choose_scheme" class="react-mini-label"><b><?php esc_html_e('OR, Choose a Color Palette', 'react'); ?></b></label>
												<select id="footer_end_page_popout_choose_scheme" name="footer_end_page_popout_choose_scheme" class="react-custom-palette-selector">
													<option value="" <?php selected($react['options']['footer_end_page_popout_choose_scheme'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
													<?php echo react_render_custom_palette_options($react['options']['footer_end_page_popout_choose_scheme']); ?>
												 </select>
											</div>


										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('A small box that is visible when the user reaches the bottom of the page. You can add HTML or shortcodes in the field.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="footer_end_page_popout_cookie_expires"><?php esc_html_e('Bottom of page pop out dismissed cookie expiration', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('How many days should we remember that they closed the bottom of page pop out?', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="footer_end_page_popout_cookie_expires" id="footer_end_page_popout_cookie_expires" value="<?php echo esc_attr($react['options']['footer_end_page_popout_cookie_expires']); ?>" class="react-width-60" /><span class="react-range-unit"><?php esc_html_e('days', 'react'); ?></span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When the user closes the bottom of page pop out, a cookie will be set so that it stays closed when they visit the site again, this option sets how many days this cookie should last for.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Logo', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Retina ready', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Footer logo image', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Your footer logo is displayed in the Subfooter', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<div class="react-clearfix">
														<div class="react-multi-input-wrap">
															<label for="footer_logo" class="react-mini-label"><?php esc_html_e('Image URL', 'react'); ?></label>
															<input type="text" name="footer_logo" id="footer_logo" value="<?php echo esc_attr($react['options']['footer_logo']); ?>" class="react-width-400">
														</div>
														<div class="react-multi-input-wrap">
															<label for="footer_logo_image_width" class="react-mini-label"><?php esc_html_e('Width', 'react'); ?></label>
															<input type="text" name="footer_logo_image_width" id="footer_logo_image_width" value="<?php echo esc_attr($react['options']['footer_logo_image_width']); ?>" class="react-width-50">
														</div>
														<div class="react-multi-input-wrap">
															<label for="footer_logo_image_height" class="react-mini-label"><?php esc_html_e('Height', 'react'); ?></label>
															<input type="text" name="footer_logo_image_height" id="footer_logo_image_height" value="<?php echo esc_attr($react['options']['footer_logo_image_height']); ?>" class="react-width-50">
														</div>
													</div>
													<div class="react-upload-logo-button-wrap react-clearfix">
														<div id="footer_logo_upload" class="react-media-button"><?php esc_html_e('Browse', 'react'); ?></div>
													</div>
												</td>
												<td class="react-form-table-logo-image-td">
													<div id="footer_logo_upload_holder" class="react-clearfix react-upload-holder">
														<?php echo react_get_upload_thumbnail($react['options']['footer_logo']); ?>
													</div>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Double size logo', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('This will ensure best quality on retina displays', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<label for="footer_logo_double" class="react-mini-label"><?php esc_html_e('Image URL', 'react'); ?></label>
													<input type="text" name="footer_logo_double" id="footer_logo_double" value="<?php echo esc_attr($react['options']['footer_logo_double']); ?>" class="react-width-400">
													<div class="react-upload-logo-button-wrap react-clearfix">
														<div id="footer_logo_double_upload" class="react-media-button"><?php esc_html_e('Browse', 'react'); ?></div>
													</div>
												</td>
												<td class="react-form-table-logo-image-td">
													<div id="footer_logo_double_upload_holder" class="react-clearfix react-upload-holder">
														<?php echo react_get_upload_thumbnail($react['options']['footer_logo_double']); ?>
													</div>
												</td>
											</tr>
										</table>
									</div>
								</div>

								<h2 class="react-panel-section-header"><?php esc_html_e('Layout', 'react'); ?></h2>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="footer_position"><?php esc_html_e('Sub Footer position', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<select name="footer_position" id="footer_position">
													<option value="hide-after-top" <?php selected($react['options']['footer_position'], 'hide-after-top'); ?>><?php esc_html_e('Fixed at first', 'react'); ?></option>
													<option value="fixed" <?php selected($react['options']['footer_position'], 'fixed'); ?>><?php esc_html_e('Bottom of screen (fixed)', 'react'); ?></option>
													<option value="absolute" <?php selected($react['options']['footer_position'], 'absolute'); ?>><?php esc_html_e('Bottom of page (relative)', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap" id="footer_position_height_hide">
												<label for="footer_position_height" class="react-mini-label"><?php esc_html_e('Height adjustment', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('If for some reason your Sub Footer height is changed from the default height, it may overlap the content above it. To fix this, you can increase (or decrease) height here.', 'react'); ?></span></span></label>
												<input type="text" name="footer_position_height" id="footer_position_height" value="<?php echo esc_attr($react['options']['footer_position_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="300" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Fixed footer will always be at the bottom of the screen. Relative will be shown at the bottom of (after) all the page content.', 'react'); ?></p>
										</td>
									</tr>
								</table>





								<table class="react-form-table react-tab-5-form-table" id="footer_reveal_height_hide">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="footer_reveal"><?php esc_html_e('Footer reveal', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="footer_reveal_height" class="react-mini-label"><?php esc_html_e('Switch on Footer Reveal', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="footer_reveal" id="footer_reveal" <?php checked(true, $react['options']['footer_reveal']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="footer_reveal_height" class="react-mini-label"><?php esc_html_e('Hide at top of page', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('If you are using margins in your layout this will make sure the footer will not show at the top of the page.', 'react'); ?></span></span></label>
												<input type="checkbox" class="react-toggle" name="footer_reveal_help" id="footer_reveal_help" <?php checked(true, $react['options']['footer_reveal_help']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="footer_reveal_height" class="react-mini-label"><?php esc_html_e('Height', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('What is the height of the area to reveal?', 'react'); ?></span></span></label>
												<input type="text" name="footer_reveal_height" id="footer_reveal_height" value="<?php echo esc_attr($react['options']['footer_reveal_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
											<div class="react-multi-input-wrap">
												<label for="footer_reveal_minheight" class="react-mini-label"><?php esc_html_e('Min Height', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Add a minimum height to ensure there are no gaps or hidden content.', 'react'); ?></span></span></label>
												<input type="text" name="footer_reveal_minheight" id="footer_reveal_minheight" value="<?php echo esc_attr($react['options']['footer_reveal_minheight']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Add a reveal effect on the full footer section. Use Height and Min Height to customize the effect for your content. Use the Footer Convert point to choose when to swap the layout for a more mobile friendly layout.', 'react'); ?></p>
										</td>
									</tr>
								</table>







								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="top_nav_convert"><?php esc_html_e('When to convert Sub Footer to centered position?', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<select name="subfoot_convert" id="subfoot_convert">
													<option value="phone-ptr" <?php selected($react['options']['subfoot_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
													<option value="phone-ldsp" <?php selected($react['options']['subfoot_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
													<option value="tablet-ptr" <?php selected($react['options']['subfoot_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
													<option value="tablet-ldsp" <?php selected($react['options']['subfoot_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
													<option value="box-width" <?php selected($react['options']['subfoot_convert'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
													<option value="never" <?php selected($react['options']['subfoot_convert'], 'never'); ?>><?php esc_html_e('Never', 'react'); ?></option>
													<option value="custom" <?php selected($react['options']['subfoot_convert'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
													<option value="always" <?php selected($react['options']['subfoot_convert'], 'always'); ?>><?php esc_html_e('Always', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap" id="subfoot_convert_custom_hide">
												<input type="text" name="subfoot_convert_custom" id="subfoot_convert_custom" value="<?php echo esc_attr($react['options']['subfoot_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Center all elements in the Sub Footer. Better for mobile devices.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<!-- Show if Fixed is selected above -->
								<div id="only_for_fixed_subfooter">
									<table class="react-form-table react-tab-5-form-table">
										<tr class="react-settings-sub-head">
											<th colspan="2">
												<label for="footer_convert"><?php esc_html_e('When to convert Footer', 'react'); ?></label>
											</th>
										</tr>
										<tr class="react-content-row">
											<td class="react-form-table-input-area-td">
												<div class="react-multi-input-wrap">
													<select name="footer_convert" id="footer_convert">
														<option value="phone-ptr" <?php selected($react['options']['footer_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
														<option value="phone-ldsp" <?php selected($react['options']['footer_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
														<option value="tablet-ptr" <?php selected($react['options']['footer_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
														<option value="tablet-ldsp" <?php selected($react['options']['footer_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
														<option value="box-width" <?php selected($react['options']['footer_convert'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
														<option value="never" <?php selected($react['options']['footer_convert'], 'never'); ?>><?php esc_html_e('Never', 'react'); ?></option>
														<option value="custom" <?php selected($react['options']['footer_convert'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
													</select>
												</div>
												<div class="react-multi-input-wrap" id="footer_convert_custom_hide">
													<input type="text" name="footer_convert_custom" id="footer_convert_custom" value="<?php echo esc_attr($react['options']['footer_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</div>
											</td>
											<td class="react-form-table-desc-td">
												<p class="react-description"><?php esc_html_e('A fixed footer can take up too much space on smaller devices. Choose when you would like to swap it to be relative to solve this.', 'react'); ?></p>
											</td>
										</tr>
									</table>
								</div>

								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="sub_footer_rtl"><?php esc_html_e('Switch Sub Footer direction', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="sub_footer_rtl" id="sub_footer_rtl" <?php checked(true, $react['options']['sub_footer_rtl']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('All items previously on the right of the Sub Footer will now be on the left, and all left items will be on the right.', 'react'); ?></p>
										</td>
									</tr>
								</table>



								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="subfooter_padding"><?php esc_html_e('Subfooter padding', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="subfooter_padding" id="subfooter_padding" value="<?php echo esc_attr($react['options']['subfooter_padding']); ?>" class="react-range-slider react-width-50" data-from="5" data-to="150" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Increase or decrease the vertical space inside the Subfooter section.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<h2 class="react-panel-section-header"><?php esc_html_e('Main Footer', 'react'); ?></h2>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="footer_border"><?php esc_html_e('Primary color border on Main Footer', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="footer_border" id="footer_border" value="<?php echo esc_attr($react['options']['footer_border']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="20" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show a border above the Main Footer widget area. A Primary colored border will be shown. ', 'react'); ?></p>
										</td>
									</tr>
								</table>


								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="footer_widget_area_layout"><?php esc_html_e('Footer widget area', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="footer_widget_area_layout" class="react-mini-label"><?php esc_html_e('Layout', 'react'); ?></label>
												<select name="footer_widget_area_layout" id="footer_widget_area_layout">
													<option value="" <?php selected($react['options']['footer_widget_area_layout'], ''); ?>><?php esc_html_e('Disabled', 'react'); ?></option>
													<?php echo react_render_column_layout_options($react['options']['footer_widget_area_layout']); ?>
												</select>
											</div>
											<div id="footer_columns_convert_hide" class="react-multi-input-wrap">
												<label for="footer_columns_convert" class="react-mini-label"><?php esc_html_e('Columns convert', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose when to swap to a new column layout.', 'react'); ?></span></span></label>
												<select name="footer_columns_convert" id="footer_columns_convert">
													<option value="" <?php selected($react['options']['footer_columns_convert'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
													<option value="phone-width-100" <?php selected($react['options']['footer_columns_convert'], 'phone-width-100'); ?>><?php esc_html_e('Phone 1 column', 'react'); ?></option>
													<option value="units-phone-50" <?php selected($react['options']['footer_columns_convert'], 'units-phone-50'); ?>><?php esc_html_e('Phone 2 columns', 'react'); ?></option>
													<option value="mobile-width-100" <?php selected($react['options']['footer_columns_convert'], 'mobile-width-100'); ?>><?php esc_html_e('Tablet and phone 1 column', 'react'); ?></option>
													<option value="units-mobile-50" <?php selected($react['options']['footer_columns_convert'], 'units-mobile-50'); ?>><?php esc_html_e('Tablet and phone 2 columns', 'react'); ?></option>
													<option value="units-tablet-50 phone-width-100" <?php selected($react['options']['footer_columns_convert'], 'units-tablet-50 phone-width-100'); ?>><?php esc_html_e('Tablet 2 columns, phone 1 column', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the layout for the footer widget area. You can add widgets at Appearance &rarr; Widgets.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="footer_top_widget_area_layout"><?php esc_html_e('Above footer widget area', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="footer_top_widget_area_layout" class="react-mini-label"><?php esc_html_e('Layout', 'react'); ?></label>
												<select name="footer_top_widget_area_layout" id="footer_top_widget_area_layout">
													<option value="" <?php selected($react['options']['footer_top_widget_area_layout'], ''); ?>><?php esc_html_e('Disabled', 'react'); ?></option>
													<?php echo react_render_column_layout_options($react['options']['footer_top_widget_area_layout']); ?>
												</select>
											</div>
											<div id="footer_top_columns_convert_hide" class="react-multi-input-wrap">
												<label for="footer_top_columns_convert" class="react-mini-label"><?php esc_html_e('Columns convert', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose when to swap to a new column layout.', 'react'); ?></span></span></label>
												<select name="footer_top_columns_convert" id="footer_top_columns_convert">
													<option value="" <?php selected($react['options']['footer_top_columns_convert'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
													<option value="phone-width-100" <?php selected($react['options']['footer_top_columns_convert'], 'phone-width-100'); ?>><?php esc_html_e('Phone 1 column', 'react'); ?></option>
													<option value="units-phone-50" <?php selected($react['options']['footer_top_columns_convert'], 'units-phone-50'); ?>><?php esc_html_e('Phone 2 columns', 'react'); ?></option>
													<option value="mobile-width-100" <?php selected($react['options']['footer_top_columns_convert'], 'mobile-width-100'); ?>><?php esc_html_e('Tablet and phone 1 column', 'react'); ?></option>
													<option value="units-mobile-50" <?php selected($react['options']['footer_top_columns_convert'], 'units-mobile-50'); ?>><?php esc_html_e('Tablet and phone 2 columns', 'react'); ?></option>
													<option value="units-tablet-50 phone-width-100" <?php selected($react['options']['footer_top_columns_convert'], 'units-tablet-50 phone-width-100'); ?>><?php esc_html_e('Tablet 2 columns, phone 1 column', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the layout for the widget area above the footer. You can add widgets at Appearance &rarr; Widgets.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="footer_padding"><?php esc_html_e('Main Footer padding', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="footer_padding" id="footer_padding" value="<?php echo esc_attr($react['options']['footer_padding']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="150" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Increase or decrease the vertical space inside the Main Footer section.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="above_footer_padding"><?php esc_html_e('Above footer padding', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="above_footer_padding" id="above_footer_padding" value="<?php echo esc_attr($react['options']['above_footer_padding']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="150" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Increase or decrease the vertical space inside the Above Footer section widget area.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<h2 class="react-panel-section-header"><?php esc_html_e('Social icons', 'react'); ?></h2>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="show_footer_social_icon"><?php esc_html_e('Show social icons', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Facebook, Twitter and much more', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="show_footer_social_icon" id="show_footer_social_icon" <?php checked(true, $react['options']['show_footer_social_icon']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Social icons like Facebook, Twitter and Google+ can be shown in the Sub Footer. To add your social icon links go to Global &rarr; Social.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<div id="footer_social_icon_type_hide">
									<table class="react-form-table react-tab-1-form-table">
										<tr class="react-settings-sub-head">
											<th colspan="2">
												<label for="footer_social_icon_type"><?php esc_html_e('Social icon style', 'react'); ?></label>
												<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a style of icon', 'react'); ?></span></span>
											</th>
										</tr>
										<tr class="react-content-row">
											<td class="react-form-table-input-area-td">
												<div class="react-multi-input-wrap">
													<select id="footer_social_icon_type" name="footer_social_icon_type" class="react-social_icon_type-selector">
														<?php foreach (react_get_social_icon_type_options() as $value => $label) : ?>
															<option value="<?php echo esc_attr($value);?>" <?php selected($react['options']['footer_social_icon_type'], $value); ?>><?php echo esc_html($label); ?></option>
														<?php endforeach; ?>
													</select>
												</div>
												<div class="react-multi-input-wrap">
													<label for="footer_social_icon_animation" class="react-mini-label"><?php esc_html_e('Animation', 'react'); ?></label>
													<?php echo react_render_hover_animation_select('footer_social_icon_animation', $react['options']['footer_social_icon_animation']); ?>
												</div>
											</td>
											<td class="react-form-table-desc-td">
												<p class="react-description"><?php esc_html_e('Style of social icons used in the Sub Footer.', 'react'); ?></p>
											</td>
										</tr>
									</table>
								</div>

							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Social links', 'react'); ?></h2>
								<table class="react-form-table react-tab-8-form-table">
									<tr class="react-settings-sub-head">
										<th>
											<label><?php esc_html_e('Add Social network icons', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Add the profile page URL and the icon will be shown, e.g. https://www.facebook.com/ThemeCatcher', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td react-translation-table-area-td">
											<table class="react-translations-table">
												<tr>
													<th class="react-translations-translation-th">
														<label><?php esc_html_e('Profile URL', 'react'); ?></label>
														<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('E.g. https://www.facebook.com/ThemeCatcher', 'react'); ?></span></span>
													</th>
													<th class="react-translations-default-th">
														<label><?php esc_html_e('Social network', 'react'); ?></label>
													</th>
												</tr>
												<?php
													$socials = react_get_socials();
													$socials1 = array_slice($socials, 0, 9); // First 9
													$socials2 = array_slice($socials, 9); // The rest
												?>
												<?php foreach ($socials1 as $key => $social) : ?>
												<tr>
													<td class="react-translations-translation-td">
														<input type="text" class="react-width-300" name="<?php echo esc_attr($key); ?>_url" id="<?php echo esc_attr($key); ?>_url" value="<?php echo esc_attr($react['options'][$key . '_url']); ?>" />
													</td>
													<td class="react-translations-default-td">
														<?php
															echo esc_html($social['name']);
															if (!$social['fa']) {
																esc_html_e('(available only with SVG icons)', 'react');
															}
															if (!$social['fc']) {
																esc_html_e('(available only with FontAwesome icons)', 'react');
															}
														?>
													</td>
												</tr>
												<?php endforeach; ?>
											</table>

											<div class="react-accordion react-toggle" id="expand_social_warp">
												<div class="react-accordion-trigger"><?php esc_html_e('More...', 'react'); ?></div>
												<div class="react-accordion-content">
													<table class="react-translations-table">
													<?php foreach ($socials2 as $key => $social) : ?>
													<tr>
														<td class="react-translations-translation-td">
															<input type="text" class="react-width-300" name="<?php echo esc_attr($key); ?>_url" id="<?php echo esc_attr($key); ?>_url" value="<?php echo esc_attr($react['options'][$key . '_url']); ?>" />
														</td>
														<td class="react-translations-default-td">
															<?php
																echo esc_html($social['name']);
																if (!$social['fa']) {
																	echo ' ' . esc_html__('(available only with SVG icons)', 'react');
																}
																if (!$social['fc']) {
																	echo ' ' . esc_html__('(available only with FontAwesome icons)', 'react');
																}
															?>
														</td>
													</tr>
													<?php endforeach; ?>
													</table>
												</div>
											</div>
										</td>
									</tr>
								</table>

								<h2 class="react-panel-section-header"><?php esc_html_e('Social Shares', 'react'); ?></h2>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="style_share"><?php esc_html_e('Share button styles', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="style_share" id="style_share">
												<option value="" <?php selected($react['options']['style_share'], ''); ?>><?php esc_html_e('Grouped stretched buttons', 'react'); ?></option>
												<option value="no-text" <?php selected($react['options']['style_share'], 'no-text'); ?>><?php esc_html_e('Grouped buttons without main text', 'react'); ?></option>
												<option value="ungrpd" <?php selected($react['options']['style_share'], 'ungrpd'); ?>><?php esc_html_e('Ungrouped buttons', 'react'); ?></option>
												<option value="ungrpd no-text" <?php selected($react['options']['style_share'], 'ungrpd no-text'); ?>><?php esc_html_e('Ungrouped buttons without main text', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Style of the social Share buttons found on pages, posts or portfolios.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="share_title"><?php esc_html_e('Title', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="share_title" id="share_title" value="<?php echo esc_attr($react['options']['share_title']); ?>" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The heading shown above the share buttons.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="style_share"><?php esc_html_e('Show/hide share buttons', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="show_share_facebook" class="react-mini-label"><?php esc_html_e('Facebook', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_share_facebook" id="show_share_facebook" <?php checked(true, $react['options']['show_share_facebook']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_share_twitter" class="react-mini-label"><?php esc_html_e('Twitter', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_share_twitter" id="show_share_twitter" <?php checked(true, $react['options']['show_share_twitter']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_share_googleplus" class="react-mini-label"><?php esc_html_e('Google+', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_share_googleplus" id="show_share_googleplus" <?php checked(true, $react['options']['show_share_googleplus']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_share_pinterest" class="react-mini-label"><?php esc_html_e('Pinterest', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_share_pinterest" id="show_share_pinterest" <?php checked(true, $react['options']['show_share_pinterest']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose which social share buttons to show or hide.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="style_share"><?php esc_html_e('Share button hover text', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="share_hover_text_facebook" class="react-mini-label"><?php esc_html_e('Facebook', 'react'); ?></label>
												<input type="text" name="share_hover_text_facebook" id="share_hover_text_facebook" value="<?php echo esc_attr($react['options']['share_hover_text_facebook']); ?>" />
												<label for="share_hover_text_twitter" class="react-mini-label"><?php esc_html_e('Twitter', 'react'); ?></label>
												<input type="text" name="share_hover_text_twitter" id="share_hover_text_twitter" value="<?php echo esc_attr($react['options']['share_hover_text_twitter']); ?>" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="share_hover_text_googleplus" class="react-mini-label"><?php esc_html_e('Google+', 'react'); ?></label>
												<input type="text" name="share_hover_text_googleplus" id="share_hover_text_googleplus" value="<?php echo esc_attr($react['options']['share_hover_text_googleplus']); ?>" />
												<label for="share_hover_text_pinterest" class="react-mini-label"><?php esc_html_e('Pinterest', 'react'); ?></label>
												<input type="text" name="share_hover_text_pinterest" id="share_hover_text_pinterest" value="<?php echo esc_attr($react['options']['share_hover_text_pinterest']); ?>" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Set the text that shows when hovering the social share buttons.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="social_count_convert"><?php esc_html_e('When to convert the social Share buttons', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
										   <div class="react-multi-input-wrap">
												<select name="social_count_convert" id="social_count_convert">
													<option value="phone-ptr" <?php selected($react['options']['social_count_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
													<option value="phone-ldsp" <?php selected($react['options']['social_count_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
													<option value="tablet-ptr" <?php selected($react['options']['social_count_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
													<option value="tablet-ldsp" <?php selected($react['options']['social_count_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
													<option value="box-width" <?php selected($react['options']['social_count_convert'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
													<option value="never" <?php selected($react['options']['social_count_convert'], 'never'); ?>><?php esc_html_e('Never', 'react'); ?></option>
													<option value="custom" <?php selected($react['options']['social_count_convert'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap" id="social_count_convert_custom_hide">
												<input type="text" name="social_count_convert_custom" id="social_count_convert_custom" value="<?php echo esc_attr($react['options']['social_count_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('We have made a more optimal layout for social Share buttons on smaller screens. Choose when you would like the layout to be swapped to this.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->

						</div><!-- .react-sub-tabs -->
					</div><!-- .react-tab-1 -->

					<!-- Backgrounds -->
					<div class="react-tab-2">
						<div class="react-sub-tabs-wrap">
							<ul class="react-sub-tabs-nav">
								<li><span><?php esc_html_e('Images', 'react'); ?><span class="react-icon react-image"></span></span></li>
								<li><span><?php esc_html_e('Video', 'react'); ?><span class="react-icon react-video"></span></span></li>
								<li><span><?php esc_html_e('Audio', 'react'); ?><span class="react-icon react-audio"></span></span></li>
							</ul>
						</div>

						<div class="react-sub-tabs">
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Images', 'react'); ?></h2>
								<!-- Cant see background image -->
								<div class="only_for_bxd_cnt"><p class="react-warning"><?php esc_html_e('Backgrounds may be hidden in Boxed Content and Fluid mode. To show it, either add Page margins, Vertical margins or change the Page Layout mode to Mixed or Boxed. Go to Design &rarr; Layout.', 'react'); ?></p></div>
								<table class="react-form-table react-upload-image-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Background images', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select image files from your computer', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div id="react-add-background-group-button" class="react-button react-orange react-add"><span></span><?php esc_html_e('Add Image Group', 'react'); ?></div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description">
												<?php esc_html_e('Add a group of images, then choose which devices they should be shown on. We recommended images do not exceed 1920px wide by 1080px high, with a file size under 500kB.', 'react'); ?>
												<br /><br />
												<?php esc_html_e('Groups of images can be set for a specific page. Choose a group in the metabox settings when adding/editing a post or page.', 'react'); ?>
											</p>
										</td>
									</tr>
								</table>
								<table class="react-uploaded-images-table">
									<tr>
										<td>
											<div id="react-background-groups" class="react-clearfix">
												<?php
													foreach ($react['options']['background_groups'] as $groupId => $group) {
														echo react_get_background_group_html($groupId, $group);
													}
												?>
											</div>
										</td>
									</tr>
								</table>
								<?php echo react_background_settings_form(); ?>

								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Desktops', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phones', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablets', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Large screens', 'react'); ?></span></li>
									</ul>
								</div>

								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-2-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Desktops / Laptops', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('You can use these options to display different backgrounds on different devices', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<?php echo react_get_background_group_select('background_desktops'); ?>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Choose which images to show on desktop and laptop computers. If you select a resize option, the images will be resized to fit the Desktops / Laptops breakpoint set in Advanced &rarr; Breakpoints.', 'react'); ?></p>
												</td>
											</tr>
										</table>

									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-2-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('You can use these options to display different backgrounds on different devices', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<?php echo react_get_background_group_select('background_phones'); ?>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Choose which images to show on phones. If you select a resize option, the images will be resized to fit the Phone Landscape breakpoint set in Advanced &rarr; Breakpoints.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-2-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('You can use these options to display different backgrounds on different devices', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<?php echo react_get_background_group_select('background_tablets'); ?>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Choose which images to show on tablets.  If you select a resize option, the images will be resized to fit the Tablet Landscape breakpoint set in Advanced &rarr; Breakpoints.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-2-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Large screens', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('You can use these options to display different backgrounds on different devices', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<?php echo react_get_background_group_select('background_large'); ?>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Choose which images to show on high resolution screens. If you select a resize option, the images will be resized to fit the Large Screen breakpoint set in Advanced &rarr; Breakpoints.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_speed"><?php esc_html_e('Transition speed', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="background_speed" id="background_speed" value="<?php echo esc_attr($react['options']['background_speed']); ?>" class="react-range-slider react-width-50" data-from="500" data-to="5000" data-step="100" data-dimension="ms" /><span class="react-range-unit">ms</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Speed of the transition between background images, in milliseconds (1000 = 1 second).', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_transition"><?php esc_html_e('Transition', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Type of animation between background images', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="background_transition" name="background_transition">
												<option value="none" <?php selected($react['options']['background_transition'], 'none'); ?>><?php esc_html_e('None', 'react'); ?></option>
												<option value="fade" <?php selected($react['options']['background_transition'], 'fade'); ?>><?php esc_html_e('Fade', 'react'); ?></option>
												<option value="fadeOutFadeIn" <?php selected($react['options']['background_transition'], 'fadeOutFadeIn'); ?>><?php esc_html_e('Fade Out / Fade In', 'react'); ?></option>
												<option value="slideDown"<?php selected($react['options']['background_transition'], 'slideDown'); ?> ><?php esc_html_e('Slide Down', 'react'); ?></option>
												<option value="slideRight"<?php selected($react['options']['background_transition'], 'slideRight'); ?> ><?php esc_html_e('Slide Right', 'react'); ?></option>
												<option value="slideUp"<?php selected($react['options']['background_transition'], 'slideUp'); ?> ><?php esc_html_e('Slide Up', 'react'); ?></option>
												<option value="slideLeft"<?php selected($react['options']['background_transition'], 'slideLeft'); ?> ><?php esc_html_e('Slide Left', 'react'); ?></option>
												<option value="carouselRight"<?php selected($react['options']['background_transition'], 'carouselRight'); ?> ><?php esc_html_e('Carousel Right', 'react'); ?></option>
												<option value="carouselLeft"<?php selected($react['options']['background_transition'], 'carouselLeft'); ?> ><?php esc_html_e('Carousel Left', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the transition animation.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_position"><?php esc_html_e('Position', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('This option will be noticeable when scrolling down a page', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="background_position" name="background_position">
												<option value="fixed" <?php selected($react['options']['background_position'], 'fixed'); ?>><?php esc_html_e('Fixed', 'react'); ?></option>
												<option value="absolute" <?php selected($react['options']['background_position'], 'absolute'); ?>><?php esc_html_e('Absolute', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The image will always be showing (Fixed), or positioned at the top of the page (Absolute).', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Fit landscape', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Fit portrait', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Fit always', 'react'); ?></span></li>
									</ul>
								</div>

								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-2-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="background_fit_landscape"><?php esc_html_e('Fit landscape', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle" name="background_fit_landscape" id="background_fit_landscape" <?php checked(true, $react['options']['background_fit_landscape']); ?> value="1" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Prevent landscape images from being cropped by locking them at 100% width.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-2-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="background_fit_portrait"><?php esc_html_e('Fit portrait', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle" name="background_fit_portrait" id="background_fit_portrait" <?php checked(true, $react['options']['background_fit_portrait']); ?> value="1" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Prevent portrait images from being cropped by locking them at 100% height.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-2-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="background_fit_always"><?php esc_html_e('Fit always', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle" name="background_fit_always" id="background_fit_always" <?php checked(true, $react['options']['background_fit_always']); ?> value="1" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Prevent images from ever being cropped.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>

								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Horizontal', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Vertical', 'react'); ?></span></li>
									</ul>
								</div>

								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-2-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="background_position_x"><?php esc_html_e('Horizontal position', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Useful when showing a focal point of the images', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<select id="background_position_x" name="background_position_x">
														<option value="left" <?php selected($react['options']['background_position_x'], 'left'); ?>><?php esc_html_e('Left', 'react'); ?></option>
														<option value="center" <?php selected($react['options']['background_position_x'], 'center'); ?>><?php esc_html_e('Center', 'react'); ?></option>
														<option value="right" <?php selected($react['options']['background_position_x'], 'right'); ?>><?php esc_html_e('Right', 'react'); ?></option>
													</select>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('How the image is aligned horizontally in the browser if it is not a perfect fit.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-2-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="background_position_y"><?php esc_html_e('Vertical position', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Useful when showing a focal point of the images', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<select id="background_position_y" name="background_position_y">
														<option value="top" <?php selected($react['options']['background_position_y'], 'top'); ?>><?php esc_html_e('Top', 'react'); ?></option>
														<option value="center" <?php selected($react['options']['background_position_y'], 'center'); ?>><?php esc_html_e('Center', 'react'); ?></option>
														<option value="bottom" <?php selected($react['options']['background_position_y'], 'bottom'); ?>><?php esc_html_e('Bottom', 'react'); ?></option>
													</select>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('How the image is aligned vertically in the browser if it is not a perfect fit.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>


								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_easing"><?php esc_html_e('Transition easing', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enhances the animation', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="background_easing" name="background_easing">
												<option value="swing" <?php selected($react['options']['background_easing'], 'swing'); ?>>swing</option>
												<option value="easeInQuad" <?php selected($react['options']['background_easing'], 'easeInQuad'); ?>>easeInQuad</option>
												<option value="easeOutQuad" <?php selected($react['options']['background_easing'], 'easeOutQuad'); ?>>easeOutQuad</option>
												<option value="easeInOutQuad" <?php selected($react['options']['background_easing'], 'easeInOutQuad'); ?>>easeInOutQuad</option>
												<option value="easeInCubic" <?php selected($react['options']['background_easing'], 'easeInCubic'); ?>>easeInCubic</option>
												<option value="easeOutCubic" <?php selected($react['options']['background_easing'], 'easeOutCubic'); ?>>easeOutCubic</option>
												<option value="easeInOutCubic" <?php selected($react['options']['background_easing'], 'easeInOutCubic'); ?>>easeInOutCubic</option>
												<option value="easeInQuart" <?php selected($react['options']['background_easing'], 'easeInQuart'); ?>>easeInQuart</option>
												<option value="easeOutQuart" <?php selected($react['options']['background_easing'], 'easeOutQuart'); ?>>easeOutQuart</option>
												<option value="easeInOutQuart" <?php selected($react['options']['background_easing'], 'easeInOutQuart'); ?>>easeInOutQuart</option>
												<option value="easeInQuint" <?php selected($react['options']['background_easing'], 'easeInQuint'); ?>>easeInQuint</option>
												<option value="easeOutQuint" <?php selected($react['options']['background_easing'], 'easeOutQuint'); ?>>easeOutQuint</option>
												<option value="easeInOutQuint" <?php selected($react['options']['background_easing'], 'easeInOutQuint'); ?>>easeInOutQuint</option>
												<option value="easeInSine" <?php selected($react['options']['background_easing'], 'easeInSine'); ?>>easeInSine</option>
												<option value="easeOutSine" <?php selected($react['options']['background_easing'], 'easeOutSine'); ?>>easeOutSine</option>
												<option value="easeInOutSine" <?php selected($react['options']['background_easing'], 'easeInOutSine'); ?>>easeInOutSine</option>
												<option value="easeInExpo" <?php selected($react['options']['background_easing'], 'easeInExpo'); ?>>easeInExpo</option>
												<option value="easeOutExpo" <?php selected($react['options']['background_easing'], 'easeOutExpo'); ?>>easeOutExpo</option>
												<option value="easeInOutExpo" <?php selected($react['options']['background_easing'], 'easeInOutExpo'); ?>>easeInOutExpo</option>
												<option value="easeInCirc" <?php selected($react['options']['background_easing'], 'easeInCirc'); ?>>easeInCirc</option>
												<option value="easeOutCirc" <?php selected($react['options']['background_easing'], 'easeOutCirc'); ?>>easeOutCirc</option>
												<option value="easeInOutCirc" <?php selected($react['options']['background_easing'], 'easeInOutCirc'); ?>>easeInOutCirc</option>
												<option value="easeInElastic" <?php selected($react['options']['background_easing'], 'easeInElastic'); ?>>easeInElastic</option>
												<option value="easeOutElastic" <?php selected($react['options']['background_easing'], 'easeOutElastic'); ?>>easeOutElastic</option>
												<option value="easeInOutElastic" <?php selected($react['options']['background_easing'], 'easeInOutElastic'); ?>>easeInOutElastic</option>
												<option value="easeInBack" <?php selected($react['options']['background_easing'], 'easeInBack'); ?>>easeInBack</option>
												<option value="easeOutBack" <?php selected($react['options']['background_easing'], 'easeOutBack'); ?>>easeOutBack</option>
												<option value="easeInOutBack" <?php selected($react['options']['background_easing'], 'easeInOutBack'); ?>>easeInOutBack</option>
												<option value="easeInBounce" <?php selected($react['options']['background_easing'], 'easeInBounce'); ?>>easeInBounce</option>
												<option value="easeOutBounce" <?php selected($react['options']['background_easing'], 'easeOutBounce'); ?>>easeOutBounce</option>
												<option value="easeInOutBounce" <?php selected($react['options']['background_easing'], 'easeInOutBounce'); ?>>easeInOutBounce</option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The easing function to use for the transition.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Hide speed', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Show speed', 'react'); ?></span></li>
									</ul>
								</div>

								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-2-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="background_hide_speed"><?php esc_html_e('Content hide speed', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="background_hide_speed" id="background_hide_speed" value="<?php echo esc_attr($react['options']['background_hide_speed']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="100" data-dimension="ms" /><span class="react-range-unit">ms</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Speed that the page content is hidden at, when activating full screen mode.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-2-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="background_show_speed"><?php esc_html_e('Content show speed', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="background_show_speed" id="background_show_speed" value="<?php echo esc_attr($react['options']['background_show_speed']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="100" data-dimension="ms" /><span class="react-range-unit">ms</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Speed that the page content is shown at, when closing full screen mode.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_control_speed"><?php esc_html_e('Control fade in speed', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="background_control_speed" id="background_control_speed" value="<?php echo esc_attr($react['options']['background_control_speed']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="100" data-dimension="ms" /><span class="react-range-unit">ms</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The speed that the controls fade in when going to full screen mode, in milliseconds (1000 = 1 second).', 'react'); ?></p>
										</td>
									</tr>
								</table>



								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_save"><?php esc_html_e('Save last background', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Never miss an image when navigating pages', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="background_save" id="background_save" <?php checked(true, $react['options']['background_save']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When turned on, the background that was last active will be the starting point for the slideshow when going to another page.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_slideshow"><?php esc_html_e('Slideshow', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Auto rotation of the images', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="background_slideshow" id="background_slideshow" <?php checked(true, $react['options']['background_slideshow']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When active, the images will be rotated through in a slideshow.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_slideshow_auto"><?php esc_html_e('Start slideshow automatically', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="background_slideshow_auto" id="background_slideshow_auto" <?php checked(true, $react['options']['background_slideshow_auto']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When active, the slideshow will start automatically.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_slideshow_speed"><?php esc_html_e('Slideshow pause time', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="background_slideshow_speed" id="background_slideshow_speed" value="<?php echo esc_attr($react['options']['background_slideshow_speed']); ?>" class="react-range-slider react-width-75" data-from="100" data-to="30000" data-step="100" data-dimension="ms" /><span class="react-range-unit">ms</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The time that each image in the slideshow is shown for, in milliseconds (1000 = 1 second).', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_random"><?php esc_html_e('Randomize', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Mix them up', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="background_random" id="background_random" <?php checked(true, $react['options']['background_random']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When active, the backgrounds will appear in random order.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_keyboard"><?php esc_html_e('Keyboard controls', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Gives user keyboard control', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="background_keyboard" id="background_keyboard" <?php checked(true, $react['options']['background_keyboard']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When turned on, in maximize mode the Right and Left arrow keys can be used to move through the images and the Esc key will return to normal mode.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_caption_position"><?php esc_html_e('Caption position', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="background_caption_position" name="background_caption_position">
												<option value="random" <?php selected($react['options']['background_caption_position'], 'random'); ?>><?php esc_html_e('Random', 'react'); ?></option>
												<option value="left top" <?php selected($react['options']['background_caption_position'], 'left top'); ?>><?php esc_html_e('left top', 'react'); ?></option>
												<option value="left center" <?php selected($react['options']['background_caption_position'], 'left center'); ?>><?php esc_html_e('left center', 'react'); ?></option>
												<option value="left bottom" <?php selected($react['options']['background_caption_position'], 'left bottom'); ?>><?php esc_html_e('left bottom', 'react'); ?></option>
												<option value="center top" <?php selected($react['options']['background_caption_position'], 'center top'); ?>><?php esc_html_e('center top', 'react'); ?></option>
												<option value="center center" <?php selected($react['options']['background_caption_position'], 'center center'); ?>><?php esc_html_e('center center', 'react'); ?></option>
												<option value="center bottom" <?php selected($react['options']['background_caption_position'], 'center bottom'); ?>><?php esc_html_e('center bottom', 'react'); ?></option>
												<option value="right top" <?php selected($react['options']['background_caption_position'], 'right top'); ?>><?php esc_html_e('right top', 'react'); ?></option>
												<option value="right center" <?php selected($react['options']['background_caption_position'], 'right center'); ?>><?php esc_html_e('right center', 'react'); ?></option>
												<option value="right bottom" <?php selected($react['options']['background_caption_position'], 'right bottom'); ?>><?php esc_html_e('right bottom', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The default caption position.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_caption_speed"><?php esc_html_e('Caption fade speed', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="background_caption_speed" id="background_caption_speed" value="<?php echo esc_attr($react['options']['background_caption_speed']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="100" data-dimension="ms" /><span class="react-range-unit">ms</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The speed of the caption fade animation, in milliseconds (1000 = 1 second).', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_bullets"><?php esc_html_e('Bullet navigation', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('A navigation method to switch to any image on full screen mode', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="background_bullets" id="background_bullets" <?php checked(true, $react['options']['background_bullets']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When active, in full screen mode you can change images using bullet navigation.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_bullets_convert"><?php esc_html_e('Hide bullets', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<select name="background_bullets_convert" id="background_bullets_convert">
													<option value="phone-ptr" <?php selected($react['options']['background_bullets_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
													<option value="phone-ldsp" <?php selected($react['options']['background_bullets_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
													<option value="tablet-ptr" <?php selected($react['options']['background_bullets_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
													<option value="tablet-ldsp" <?php selected($react['options']['background_bullets_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
													<option value="box-width" <?php selected($react['options']['background_bullets_convert'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
													<option value="never" <?php selected($react['options']['background_bullets_convert'], 'never'); ?>><?php esc_html_e('Never', 'react'); ?></option>
													<option value="custom" <?php selected($react['options']['background_bullets_convert'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap" id="background_bullets_convert_custom_hide">
												<input type="text" name="background_bullets_convert_custom" id="background_bullets_convert_custom" value="<?php echo esc_attr($react['options']['background_bullets_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose a point when to hide the bullet navigation, as they may not be practical on smaller screens.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_low_quality"><?php esc_html_e('Low quality transitions', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('A performance enhancer, if required', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="background_low_quality" id="background_low_quality" <?php checked(true, $react['options']['background_low_quality']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When active, the transitions will be lower quality which improves performance.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Show Breaker', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('A breaker borders the bottom of the image', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="background_breaker" class="react-mini-label"><?php esc_html_e('Show Breaker', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="background_breaker" id="background_breaker" <?php checked(true, $react['options']['background_breaker']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="background_breaker_on_max" class="react-mini-label"><?php esc_html_e('Show Breaker in full screen mode', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="background_breaker_on_max" id="background_breaker_on_max" <?php checked(true, $react['options']['background_breaker_on_max']); ?> value="1" />
										</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When active, a breaker image is used between the background image and the rest of the page. Works well with "Absolute" position.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="controls_location_fs"><?php esc_html_e('Image controls location', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Controls are the buttons with which the user controls the movement of images', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="controls_location_fs" id="controls_location_fs">
												<option value="" <?php selected($react['options']['controls_location_fs'], ''); ?>><?php esc_html_e('Disabled', 'react'); ?></option>
												<option value="infomenu" <?php selected($react['options']['controls_location_fs'], 'infomenu'); ?>><?php esc_html_e('Info Menu', 'react'); ?></option>
												<option value="top-header" <?php selected($react['options']['controls_location_fs'], 'top-header'); ?>><?php esc_html_e('Top Header', 'react'); ?></option>
												<option value="sub-footer" <?php selected($react['options']['controls_location_fs'], 'sub-footer'); ?>><?php esc_html_e('Sub Footer', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose a location to show the background image controls.', 'react'); ?></p>
											<!-- Show if TopHead off -->
											<div class="only_for_tophead"><p class="react-warning"><?php esc_html_e('Top Header section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
											<!-- Show if InfoMenu off -->
											<div class="only_for_infomenu"><p class="react-warning"><?php esc_html_e('Info Menu section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
											<!-- Show if Subfooter off -->
											<div class="only_for_subfooter"><p class="react-warning"><?php esc_html_e('Sub Footer section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="controls_location_fs_label"><?php esc_html_e('Show controls label', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="controls_location_fs_label" id="controls_location_fs_label" <?php checked(true, $react['options']['controls_location_fs_label']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show a label that will appear when hovering over the controls. Label text can be changed on the Translate tab.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_always_show_captions"><?php esc_html_e('Always show captions', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<input type="checkbox" class="react-toggle-yn" name="background_always_show_captions" id="background_always_show_captions" <?php checked(true, $react['options']['background_always_show_captions']); ?> value="1" />
												<label for="background_always_show_captions_display" class="react-mini-label"><?php esc_html_e('Display', 'react'); ?></label>
												<select name="background_always_show_captions_display" id="background_always_show_captions_display">
													<option value="" <?php selected($react['options']['background_always_show_captions_display'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
													<option value="top" <?php selected($react['options']['background_always_show_captions_display'], 'top'); ?>><?php esc_html_e('Show only at top', 'react'); ?></option>
													<option value="bottom" <?php selected($react['options']['background_always_show_captions_display'], 'bottom'); ?>><?php esc_html_e('Show only at bottom', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Always show the background image captions, otherwise they will only be shown in full screen mode.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Background caption overlay', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="background_caption_overlay" class="react-mini-label"><?php esc_html_e('Light or dark', 'react'); ?></label>
												<select name="background_caption_overlay" id="background_caption_overlay">
													<option value="light" <?php selected($react['options']['background_caption_overlay'], 'light'); ?>><?php esc_html_e('Light', 'react'); ?></option>
													<option value="dark" <?php selected($react['options']['background_caption_overlay'], 'dark'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="background_caption_overlay_opacity" class="react-mini-label"><?php esc_html_e('Level of opacity', 'react'); ?></label>
												<input type="text" name="background_caption_overlay_opacity" id="background_caption_overlay_opacity" value="<?php echo esc_attr($react['options']['background_caption_overlay_opacity']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="90" data-step="10" data-dimension="%" /><span class="react-range-unit">%</span>
											</div>
											<div class="react-multi-input-wrap">
												<label for="background_caption_color" class="react-mini-label"><?php esc_html_e('Or choose a color', 'react'); ?></label>
												<input type="text" name="background_caption_color" id="background_caption_color" value="<?php echo esc_attr($react['options']['background_caption_color']); ?>" class="react-colorpicker" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Change the color or switch off the background behind the caption text.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Loading spinner', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="background_spinner_type" class="react-mini-label"><?php esc_html_e('Type', 'react'); ?></label>
												<select name="background_spinner_type" id="background_spinner_type">
													<option value="" <?php selected($react['options']['background_spinner_type'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
													<?php foreach (react_get_spinkit_options() as $key => $value) : ?>
														<option value="<?php echo esc_attr($key); ?>" <?php selected($react['options']['background_spinner_type'], $key); ?>><?php echo esc_html($value); ?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="background_spinner_color" class="react-mini-label"><?php esc_html_e('Color', 'react'); ?></label>
												<input type="text" name="background_spinner_color" id="background_spinner_color" value="<?php echo esc_attr($react['options']['background_spinner_color']); ?>" class="react-colorpicker" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php printf(esc_html__('Choose the type and color of the animation shown while the first background image is loading (%1$sdemos%2$s).', 'react'), '<a href="http://tobiasahlin.com/spinkit/" target="_blank">', '</a>'); ?></p>
										</td>
									</tr>
								</table>


							</div><!-- .react-sub-tab -->
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Video', 'react'); ?></h2>
								<div class="only_for_bxd_cnt"><p class="react-warning"><?php esc_html_e('Backgrounds may be hidden in Boxed Content and Fluid mode. To show it, either add Page margins, Vertical margins or change the Page Layout mode to Mixed or Boxed. Go to Design &rarr; Layout.', 'react'); ?></p></div>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_video"><?php esc_html_e('Video URL', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enter the URL, including http://', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="background_video" id="background_video" value="<?php echo esc_attr($react['options']['background_video']); ?>" class="react-width-400" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Enter the URL of a YouTube or Vimeo video. The background video will show instead of the background images.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Video dimensions', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Ensures best scaling', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-background-video-width">
												<label for="background_video_width"><?php esc_html_e('Width', 'react'); ?> <input type="text" name="background_video_width" id="background_video_width" value="<?php echo esc_attr($react['options']['background_video_width']); ?>" class="react-width-50" /> px</label>
											</div>
											<div class="react-background-video-height">
												<label for="background_video_height"><?php esc_html_e('Height', 'react'); ?> <input type="text" name="background_video_height" id="background_video_height" value="<?php echo esc_attr($react['options']['background_video_height']); ?>" class="react-width-50" /> px</label>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Please enter the dimensions of the original video for accurate scaling. This information will be fetched automatically after entering the video URL.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Video on devices', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose which devices to enable the video on', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="background_video_tablet" class="react-mini-label"><?php esc_html_e('Tablet', 'react'); ?></label>
												<input type="checkbox" class="react-toggle bc-toggle-yn" name="background_video_tablet" id="background_video_tablet" <?php checked(true, $react['options']['background_video_tablet']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="background_video_mobile" class="react-mini-label"><?php esc_html_e('Mobile', 'react'); ?></label>
												<input type="checkbox" class="react-toggle bc-toggle-yn" name="background_video_mobile" id="background_video_mobile" <?php checked(true, $react['options']['background_video_mobile']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Videos can use a lot of bandwidth, you might want to consider that users accessing your site from a mobile network may incur charges. If these options are set to Off then users will be shown background images instead if you have set them up.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_video_autostart"><?php esc_html_e('Auto-start video', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="background_video_autostart" id="background_video_autostart" <?php checked(true, $react['options']['background_video_autostart']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Start the video automatically.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_video_mute"><?php esc_html_e('Mute video', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="background_video_mute" id="background_video_mute" <?php checked(true, $react['options']['background_video_mute']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Mute the video by default, the user can unmute it using the video controls.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_video_complete"><?php esc_html_e('When video finishes', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="background_video_complete" name="background_video_complete">
												<option value="none" <?php selected($react['options']['background_video_complete'], 'none'); ?>><?php esc_html_e('Do nothing', 'react'); ?></option>
												<option value="restart" <?php selected($react['options']['background_video_complete'], 'restart'); ?>><?php esc_html_e('Restart video', 'react'); ?></option>
												<option value="hide" <?php selected($react['options']['background_video_complete'], 'hide'); ?>><?php esc_html_e('Hide video', 'react'); ?></option>
												<option value="redirect" <?php selected($react['options']['background_video_complete'], 'redirect'); ?>><?php esc_html_e('Redirect to another page', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose an action to take when the video has finished playing.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table id="background_video_redirect_wrap" class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_video_redirect"><?php esc_html_e('Redirect URL', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="background_video_redirect" id="background_video_redirect" value="<?php echo esc_attr($react['options']['background_video_redirect']); ?>" class="react-width-400" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Enter the URL to redirect to when the video has finished playing.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_video_full_screen"><?php esc_html_e('Full screen mode', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="background_video_full_screen" id="background_video_full_screen" <?php checked(true, $react['options']['background_video_full_screen']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Enables the button to toggle full screen mode.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table id="background_video_full_screen_overlay_wrap" class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_video_full_screen_overlay"><?php esc_html_e('Full screen overlay', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="background_video_full_screen_overlay" id="background_video_full_screen_overlay" <?php checked(true, $react['options']['background_video_full_screen_overlay']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('If activated, the video full screen mode will keep the texture overlay.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_video_start"><?php esc_html_e('Video start position', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('The video will begin at this number of seconds after the start', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="background_video_start" id="background_video_start" value="<?php echo esc_attr($react['options']['background_video_start']); ?>" class="react-width-50" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Playback to the specified number of seconds into the video.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="controls_location_video"><?php esc_html_e('Video controls location', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Controls are the buttons with which the user controls the video', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="controls_location_video" id="controls_location_video">
												<option value="" <?php selected($react['options']['controls_location_video'], ''); ?>><?php esc_html_e('Disabled', 'react'); ?></option>
												<option value="infomenu" <?php selected($react['options']['controls_location_video'], 'infomenu'); ?>><?php esc_html_e('Info Menu', 'react'); ?></option>
												<option value="top-header" <?php selected($react['options']['controls_location_video'], 'top-header'); ?>><?php esc_html_e('Top Header', 'react'); ?></option>
												<option value="sub-footer" <?php selected($react['options']['controls_location_video'], 'sub-footer'); ?>><?php esc_html_e('Sub Footer', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose a location to show the background video controls.', 'react'); ?></p>
											<!-- Show if TopHead off -->
											<div class="only_for_tophead"><p class="react-warning"><?php esc_html_e('Top Header section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
											<!-- Show if InfoMenu off -->
											<div class="only_for_infomenu"><p class="react-warning"><?php esc_html_e('Info Menu section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
											<!-- Show if Subfooter off -->
											<div class="only_for_subfooter"><p class="react-warning"><?php esc_html_e('Sub Footer section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="controls_location_video_label"><?php esc_html_e('Show controls label', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="controls_location_video_label" id="controls_location_video_label" <?php checked(true, $react['options']['controls_location_video_label']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show a label that will appear when hovering over the controls. Label text can be changed on the Translate tab.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Audio', 'react'); ?></h2>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Background music', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Upload audio files from your computer', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-add-audio-track-button-wrap react-clearfix">
												<div id="react-add-audio-track-button" class="react-button react-orange react-add"><span></span><?php esc_html_e('Add Music Track', 'react'); ?></div>
											</div>
											<div id="react-audio-tracks" class="react-clearfix">
												<?php
													foreach ($react['options']['background_audio'] as $track) {
														echo react_get_background_audio_html($track);
													}
												?>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Either a .mp3 or .m4a file is required, and uploading a .ogg version will increase browser support. You need to use the same chosen formats for every track you add. For example, if you choose .m4a and .ogg for your first track, every other track should have both a .m4a and .ogg version.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_audio_random"><?php esc_html_e('Randomize music', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Mix them up', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="background_audio_random" id="background_audio_random" <?php checked(true, $react['options']['background_audio_random']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Randomize the order of the tracks.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_audio_autostart"><?php esc_html_e('Auto-start music', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Start playing on page loading', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="background_audio_autostart" id="background_audio_autostart" <?php checked(true, $react['options']['background_audio_autostart']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Start the music track automatically.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="background_audio_complete"><?php esc_html_e('When music finishes', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="background_audio_complete" name="background_audio_complete">
												<option value="none" <?php selected($react['options']['background_audio_complete'], 'none'); ?>><?php esc_html_e('Do nothing', 'react'); ?></option>
												<option value="restart" <?php selected($react['options']['background_audio_complete'], 'restart'); ?>><?php esc_html_e('Restart music', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose an action to take when the music has finished playing.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="controls_location_audio"><?php esc_html_e('Audio controls location', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Controls are the buttons with which the user controls the audio', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="controls_location_audio" id="controls_location_audio">
												<option value="" <?php selected($react['options']['controls_location_audio'], ''); ?>><?php esc_html_e('Disabled', 'react'); ?></option>
												<option value="infomenu" <?php selected($react['options']['controls_location_audio'], 'infomenu'); ?>><?php esc_html_e('Info Menu', 'react'); ?></option>
												<option value="top-header" <?php selected($react['options']['controls_location_audio'], 'top-header'); ?>><?php esc_html_e('Top Header', 'react'); ?></option>
												<option value="sub-footer" <?php selected($react['options']['controls_location_audio'], 'sub-footer'); ?>><?php esc_html_e('Sub Footer', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose a location to show the audio controls.', 'react'); ?></p>
											<!-- Show if TopHead off -->
											<div class="only_for_tophead"><p class="react-warning"><?php esc_html_e('Top Header section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
											<!-- Show if InfoMenu off -->
											<div class="only_for_infomenu"><p class="react-warning"><?php esc_html_e('Info Menu section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
											<!-- Show if Subfooter off -->
											<div class="only_for_subfooter"><p class="react-warning"><?php esc_html_e('Sub Footer section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-2-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="controls_location_audio_label"><?php esc_html_e('Show controls label', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="controls_location_audio_label" id="controls_location_audio_label" <?php checked(true, $react['options']['controls_location_audio_label']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show a label that will appear when hovering over the controls. Label text can be changed on the Translate tab.', 'react'); ?></p>
										</td>
									</tr>
								</table>

							</div><!-- .react-sub-tab -->
						</div><!-- .react-sub-tabs -->
					</div><!-- .react-tab-2 -->


					<!-- Pages -->
					<div class="react-tab-3">
						<div class="react-sub-tabs-wrap">
							<ul class="react-sub-tabs-nav">
								<li><span><?php esc_html_e('General', 'react'); ?><span class="react-icon react-general"></span></span></li>
								<li><span><?php esc_html_e('Images', 'react'); ?><span class="react-icon react-image"></span></span></li>
							</ul>
						</div>

						<div class="react-sub-tabs">
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Page settings', 'react'); ?></h2>

								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="general_page_layout"><?php esc_html_e('Page layout', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose the default position of the content area and sidebar for a page', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="general_page_layout" id="general_page_layout" class="react-layout-selector">
												<option value="left-sidebar" <?php selected($react['options']['general_page_layout'], 'left-sidebar'); ?>><?php esc_html_e('Left sidebar', 'react'); ?></option>
												<option value="full-width" <?php selected($react['options']['general_page_layout'], 'full-width'); ?>><?php esc_html_e('Full width', 'react'); ?></option>
												<option value="right-sidebar" <?php selected($react['options']['general_page_layout'], 'right-sidebar'); ?>><?php esc_html_e('Right sidebar', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The default layout for pages.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="page_show_share"><?php esc_html_e('Show social Share links', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle bc-toggle-yn" name="page_show_share" id="page_show_share" <?php checked(true, $react['options']['page_show_share']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show Google+, Twitter, Facebook and Pinterest share buttons at the bottom of the page.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Single Page Images', 'react'); ?></h2>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="page_single_featured_image"><?php esc_html_e('Featured image', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show or not featured images, which can be set when editing the page', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="page_single_featured_image" id="page_single_featured_image" <?php checked(true, $react['options']['page_single_featured_image']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Display the featured image when viewing a single page. You can override this per page in the post metabox settings.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="page_single_featured_image_type"><?php esc_html_e('Featured image type', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose how the featured image is displayed', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="page_single_featured_image_type" id="page_single_featured_image_type">
												<option value="full" <?php selected($react['options']['page_single_featured_image_type'], 'full'); ?>><?php esc_html_e('Full width', 'react'); ?></option>
												<option value="left" <?php selected($react['options']['page_single_featured_image_type'], 'left'); ?>><?php esc_html_e('Float left', 'react'); ?></option>
												<option value="right" <?php selected($react['options']['page_single_featured_image_type'], 'right'); ?>><?php esc_html_e('Float right', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The featured image type when viewing single pages.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Default / Desktop', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_single_featured_height"><?php esc_html_e('Featured image height', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_single_featured_height" id="page_single_featured_height" value="<?php echo esc_attr($react['options']['page_single_featured_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for single pages. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_single_featured_height_tablet"><?php esc_html_e('Featured image height on tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_single_featured_height_tablet" id="page_single_featured_height_tablet" value="<?php echo esc_attr($react['options']['page_single_featured_height_tablet']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for single pages. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_single_featured_height_phone"><?php esc_html_e('Featured image height on phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_single_featured_height_phone" id="page_single_featured_height_phone" value="<?php echo esc_attr($react['options']['page_single_featured_height_phone']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for single pages. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="page_single_featured_float_width"><?php esc_html_e('Float featured image width', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="page_single_featured_float_width" id="page_single_featured_float_width" value="<?php echo esc_attr($react['options']['page_single_featured_float_width']); ?>" class="react-range-slider react-width-50" data-from="10" data-to="500" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The width of floating featured image for single pages.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="page_single_featured_float_height"><?php esc_html_e('Float featured image height', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="page_single_featured_float_height" id="page_single_featured_float_height" value="<?php echo esc_attr($react['options']['page_single_featured_float_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The height of floating featured image for single pages. If set to 0, it will be scaled automatically from the image dimensions.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="page_single_featured_link_image"><?php esc_html_e('Link featured image to full size image', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="page_single_featured_link_image" id="page_single_featured_link_image" <?php checked(true, $react['options']['page_single_featured_link_image']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When this is enabled, the featured image will link to the full size image.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Show like button on featured image', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="page_single_featured_like_image" class="react-mini-label"><?php esc_html_e('Show / hide', 'react'); ?></label>
												<input type="checkbox" class="react-toggle bc-toggle-yn" name="page_single_featured_like_image" id="page_single_featured_like_image" <?php checked(true, $react['options']['page_single_featured_like_image']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="page_single_featured_like_image_icon" class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
												<select name="page_single_featured_like_image_icon" id="page_single_featured_like_image_icon">
													<option value="fa-thumbs-up" <?php selected($react['options']['page_single_featured_like_image_icon'], 'fa-thumbs-up'); ?>><?php esc_html_e('Thumbs up', 'react'); ?></option>
													<option value="fa-heart" <?php selected($react['options']['page_single_featured_like_image_icon'], 'fa-heart'); ?>><?php esc_html_e('Heart', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Shows a like button and the number of likes when hovering the featured image on single pages, enables visitors to like posts.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<h2 class="react-panel-section-header"><?php esc_html_e('Page Archive Images', 'react'); ?></h2>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="page_featured_image"><?php esc_html_e('Featured image', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show or not featured images, which can be set in your post', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="page_featured_image" id="page_featured_image" <?php checked(true, $react['options']['page_featured_image']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Display the featured image on pages when they are in search results or archives.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="page_featured_image_type"><?php esc_html_e('Featured image type', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose how the featured image is displayed', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="page_featured_image_type" id="page_featured_image_type">
												<option value="below" <?php selected($react['options']['page_featured_image_type'], 'below'); ?>><?php esc_html_e('Below title (full width)', 'react'); ?></option>
												<option value="above" <?php selected($react['options']['page_featured_image_type'], 'above'); ?>><?php esc_html_e('Above title (full width)', 'react'); ?></option>
												<option value="left" <?php selected($react['options']['page_featured_image_type'], 'left'); ?>><?php esc_html_e('Float left', 'react'); ?></option>
												<option value="right" <?php selected($react['options']['page_featured_image_type'], 'right'); ?>><?php esc_html_e('Float right', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The featured image type for pages when they are in search results or archives.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Default / Desktop', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_featured_height"><?php esc_html_e('Featured image height', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_featured_height" id="page_featured_height" value="<?php echo esc_attr($react['options']['page_featured_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for pages when they are in search results or archives. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_featured_height_tablet"><?php esc_html_e('Featured image height on tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_featured_height_tablet" id="page_featured_height_tablet" value="<?php echo esc_attr($react['options']['page_featured_height_tablet']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for pages when they are in search results or archives. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="page_featured_height_phone"><?php esc_html_e('Featured image height on phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="page_featured_height_phone" id="page_featured_height_phone" value="<?php echo esc_attr($react['options']['page_featured_height_phone']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for pages when they are in search results or archives. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="page_featured_float_width"><?php esc_html_e('Float featured image width', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="page_featured_float_width" id="page_featured_float_width" value="<?php echo esc_attr($react['options']['page_featured_float_width']); ?>" class="react-range-slider react-width-50" data-from="10" data-to="500" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The width of floating featured image for pages when they are in search results or archives.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="page_featured_float_height"><?php esc_html_e('Float featured image height', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="page_featured_float_height" id="page_featured_float_height" value="<?php echo esc_attr($react['options']['page_featured_float_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The height of floating featured image for pages when they are in search results or archives.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Show like button on featured image', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="page_featured_like_image" class="react-mini-label"><?php esc_html_e('Show / hide', 'react'); ?></label>
												<input type="checkbox" class="react-toggle bc-toggle-yn" name="page_featured_like_image" id="page_featured_like_image" <?php checked(true, $react['options']['page_featured_like_image']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="page_featured_like_image_icon" class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
												<select name="page_featured_like_image_icon" id="page_featured_like_image_icon">
													<option value="fa-thumbs-up" <?php selected($react['options']['page_featured_like_image_icon'], 'fa-thumbs-up'); ?>><?php esc_html_e('Thumbs up', 'react'); ?></option>
													<option value="fa-heart" <?php selected($react['options']['page_featured_like_image_icon'], 'fa-heart'); ?>><?php esc_html_e('Heart', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Shows a like button and the number of likes when hovering the featured image on search results and archives, enables visitors to like posts.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->
						</div><!-- .react-sub-tabs -->
					</div><!-- .react-tab-3 -->

					<!-- Blog -->
					<div class="react-tab-3">
						<div class="react-sub-tabs-wrap">
							<ul class="react-sub-tabs-nav">
								<li><span><?php esc_html_e('General', 'react'); ?><span class="react-icon react-general"></span></span></li>
								<li><span><?php esc_html_e('Images', 'react'); ?><span class="react-icon react-image"></span></span></li>
							</ul>
						</div>

						<div class="react-sub-tabs">
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Blog settings', 'react'); ?></h2>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_layout"><?php esc_html_e('Layout', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="blog_layout" id="blog_layout" class="react-layout-selector">
												<option value="left-sidebar" <?php selected($react['options']['blog_layout'], 'left-sidebar'); ?>><?php esc_html_e('Left sidebar', 'react'); ?></option>
												<option value="full-width" <?php selected($react['options']['blog_layout'], 'full-width'); ?>><?php esc_html_e('Full width', 'react'); ?></option>
												<option value="right-sidebar" <?php selected($react['options']['blog_layout'], 'right-sidebar'); ?>><?php esc_html_e('Right sidebar', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the layout for the main Blog page.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_single_layout"><?php esc_html_e('Single layout', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="blog_single_layout" id="blog_single_layout" class="react-layout-selector">
												<option value="left-sidebar" <?php selected($react['options']['blog_single_layout'], 'left-sidebar'); ?>><?php esc_html_e('Left sidebar', 'react'); ?></option>
												<option value="full-width" <?php selected($react['options']['blog_single_layout'], 'full-width'); ?>><?php esc_html_e('Full width', 'react'); ?></option>
												<option value="right-sidebar" <?php selected($react['options']['blog_single_layout'], 'right-sidebar'); ?>><?php esc_html_e('Right sidebar', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the page layout of a single blog post.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_animation"><?php esc_html_e('Blog post animation', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<?php echo react_render_animation_select('blog_animation', $react['options']['blog_animation']); ?>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose an animation when a blog post comes into view.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_boxed_style"><?php esc_html_e('Blog style boxed', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle bc-toggle-yn" name="blog_boxed_style" id="blog_boxed_style" <?php checked(true, $react['options']['blog_boxed_style']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Display the blog articles with a boxed style.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_show_date_circle"><?php esc_html_e('Show date box', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle bc-toggle-yn" name="blog_show_date_circle" id="blog_show_date_circle" <?php checked(true, $react['options']['blog_show_date_circle']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show the post date box next to the post title.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Show like button', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="blog_show_post_like" class="react-mini-label"><?php esc_html_e('Show / hide', 'react'); ?></label>
												<input type="checkbox" class="react-toggle bc-toggle-yn" name="blog_show_post_like" id="blog_show_post_like" <?php checked(true, $react['options']['blog_show_post_like']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="blog_post_like_icon" class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
												<select name="blog_post_like_icon" id="blog_post_like_icon">
													<option value="fa-thumbs-up" <?php selected($react['options']['blog_post_like_icon'], 'fa-thumbs-up'); ?>><?php esc_html_e('Thumbs up', 'react'); ?></option>
													<option value="fa-heart" <?php selected($react['options']['blog_post_like_icon'], 'fa-heart'); ?>><?php esc_html_e('Heart', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Enables visitors to like posts and shows the number of likes.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_show_cats"><?php esc_html_e('Show likes / comments for blog posts', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="blog_show_like_count" class="react-mini-label"><?php esc_html_e('Likes', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="blog_show_like_count" id="blog_show_like_count" <?php checked(true, $react['options']['blog_show_like_count']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="blog_show_comment_count" class="react-mini-label"><?php esc_html_e('Comments', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="blog_show_comment_count" id="blog_show_comment_count" <?php checked(true, $react['options']['blog_show_comment_count']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show the number of likes and comments on the blog page, archive and search results.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_show_title_single"><?php esc_html_e('Show title above content', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="blog_show_title_single" id="blog_show_title_single" <?php checked(true, $react['options']['blog_show_title_single']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The title is already shown in the intro section, enable this option to also show the title above the content.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_show_meta_intro_single"><?php esc_html_e('Show post meta in intro', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="blog_show_meta_intro_single" id="blog_show_meta_intro_single" <?php checked(true, $react['options']['blog_show_meta_intro_single']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show the post author and the post date in the intro section.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_show_meta_above_content"><?php esc_html_e('Show post meta above content', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="blog_show_meta_above_content" id="blog_show_meta_above_content" <?php checked(true, $react['options']['blog_show_meta_above_content']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show the post meta information above the post content.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_show_cats"><?php esc_html_e('Show categories for blog posts', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="blog_show_cats" class="react-mini-label"><?php esc_html_e('Archive / search', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="blog_show_cats" id="blog_show_cats" <?php checked(true, $react['options']['blog_show_cats']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="blog_show_cats_single" class="react-mini-label"><?php esc_html_e('Single item page', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="blog_show_cats_single" id="blog_show_cats_single" <?php checked(true, $react['options']['blog_show_cats_single']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show a list of categories if the item belongs to any.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_show_tags"><?php esc_html_e('Show tags for blog posts', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="blog_show_tags" class="react-mini-label"><?php esc_html_e('Archive / search', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="blog_show_tags" id="blog_show_tags" <?php checked(true, $react['options']['blog_show_tags']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="blog_show_tags_single" class="react-mini-label"><?php esc_html_e('Single item page', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="blog_show_tags_single" id="blog_show_tags_single" <?php checked(true, $react['options']['blog_show_tags_single']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show a list of tags if the item belongs to any.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Show social Share links', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<label for="blog_show_share" class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
											<input type="checkbox" class="react-toggle bc-toggle-yn" name="blog_show_share" id="blog_show_share" <?php checked(true, $react['options']['blog_show_share']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show Google+, Twitter, Facebook and Pinterest share buttons at the bottom of the post.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_show_author_bio"><?php esc_html_e('Show author bio', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="blog_show_author_bio" class="react-mini-label"><?php esc_html_e('Archive', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="blog_show_author_bio" id="blog_show_author_bio" <?php checked(true, $react['options']['blog_show_author_bio']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="blog_show_author_bio_single" class="react-mini-label"><?php esc_html_e('Single item page', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="blog_show_author_bio_single" id="blog_show_author_bio_single" <?php checked(true, $react['options']['blog_show_author_bio_single']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show the author biography if the user has set one.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_show_single_nav"><?php esc_html_e('Single post navigation', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="blog_show_single_nav" id="blog_show_single_nav" <?php checked(true, $react['options']['blog_show_single_nav']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show previous / next post navigation on single posts.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_show_reply"><?php esc_html_e('Show Reply button', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="blog_show_reply" id="blog_show_reply" <?php checked(true, $react['options']['blog_show_reply']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show the Reply button in the blog archive and search results.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Comments layout', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('How you would like to show comments and trackbacks', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<label><input type="radio" name="blog_comments_layout" <?php checked('tabs', $react['options']['blog_comments_layout']); ?> value="tabs" /> <?php esc_html_e('Comments and trackbacks in separate tabs', 'react'); ?></label><br />
											<label><input type="radio" name="blog_comments_layout" <?php checked('mixed', $react['options']['blog_comments_layout']); ?> value="mixed" /> <?php esc_html_e('Comments and trackbacks mixed', 'react'); ?></label>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose a method of displaying comments and trackbacks.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Title', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Subtitle', 'react'); ?></span></li>
									</ul>
								</div>

								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="blog_title"><?php esc_html_e('Blog page title', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Give your blog a name', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="blog_title" id="blog_title" class="react-width-300" value="<?php echo esc_attr($react['options']['blog_title']); ?>" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The title of the main Blog page.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="blog_subtitle"><?php esc_html_e('Blog page subtitle', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="blog_subtitle" id="blog_subtitle" class="react-width-300" value="<?php echo esc_attr($react['options']['blog_subtitle']); ?>" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The subtitle of the main Blog page.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>

							</div><!-- .react-sub-tab -->
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Single Post Images', 'react'); ?></h2>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_single_featured_image"><?php esc_html_e('Featured image', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show or not featured images, which can be set when editing the post', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="blog_single_featured_image" id="blog_single_featured_image" <?php checked(true, $react['options']['blog_single_featured_image']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Display the featured image when viewing a single blog post. You can override this per post in the post metabox settings.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_single_featured_image_type"><?php esc_html_e('Featured image type', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose how the featured image is displayed', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="blog_single_featured_image_type" id="blog_single_featured_image_type">
												<option value="full" <?php selected($react['options']['blog_single_featured_image_type'], 'full'); ?>><?php esc_html_e('Full width', 'react'); ?></option>
												<option value="left" <?php selected($react['options']['blog_single_featured_image_type'], 'left'); ?>><?php esc_html_e('Float left', 'react'); ?></option>
												<option value="right" <?php selected($react['options']['blog_single_featured_image_type'], 'right'); ?>><?php esc_html_e('Float right', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The featured image type when viewing single posts.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Default / Desktop', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="blog_single_featured_height"><?php esc_html_e('Featured image height', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="blog_single_featured_height" id="blog_single_featured_height" value="<?php echo esc_attr($react['options']['blog_single_featured_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for single posts. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="blog_single_featured_height_tablet"><?php esc_html_e('Featured image height on tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="blog_single_featured_height_tablet" id="blog_single_featured_height_tablet" value="<?php echo esc_attr($react['options']['blog_single_featured_height_tablet']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for single posts. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="blog_single_featured_height_phone"><?php esc_html_e('Featured image height on phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="blog_single_featured_height_phone" id="blog_single_featured_height_phone" value="<?php echo esc_attr($react['options']['blog_single_featured_height_phone']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for single posts. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_single_featured_float_width"><?php esc_html_e('Float featured image width', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="blog_single_featured_float_width" id="blog_single_featured_float_width" value="<?php echo esc_attr($react['options']['blog_single_featured_float_width']); ?>" class="react-range-slider react-width-50" data-from="10" data-to="500" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The width of floating featured image for single posts.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_single_featured_float_height"><?php esc_html_e('Float featured image height', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="blog_single_featured_float_height" id="blog_single_featured_float_height" value="<?php echo esc_attr($react['options']['blog_single_featured_float_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The height of floating featured image for single posts. If set to 0, it will be scaled automatically from the image dimensions.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_single_featured_link_image"><?php esc_html_e('Link featured image to full size image', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="blog_single_featured_link_image" id="blog_single_featured_link_image" <?php checked(true, $react['options']['blog_single_featured_link_image']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When this is enabled, the featured image will link to the full size image.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Show like button on featured image', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="blog_single_featured_like_image" class="react-mini-label"><?php esc_html_e('Show / hide', 'react'); ?></label>
												<input type="checkbox" class="react-toggle bc-toggle-yn" name="blog_single_featured_like_image" id="blog_single_featured_like_image" <?php checked(true, $react['options']['blog_single_featured_like_image']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="blog_single_featured_like_image_icon" class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
												<select name="blog_single_featured_like_image_icon" id="blog_single_featured_like_image_icon">
													<option value="fa-thumbs-up" <?php selected($react['options']['blog_single_featured_like_image_icon'], 'fa-thumbs-up'); ?>><?php esc_html_e('Thumbs up', 'react'); ?></option>
													<option value="fa-heart" <?php selected($react['options']['blog_single_featured_like_image_icon'], 'fa-heart'); ?>><?php esc_html_e('Heart', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Shows a like button and the number of likes when hovering the featured image on single posts, enables visitors to like posts.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<h2 class="react-panel-section-header"><?php esc_html_e('Blog Archive Images', 'react'); ?></h2>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_featured_image"><?php esc_html_e('Featured image', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show or not featured images, which can be set in your post', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="blog_featured_image" id="blog_featured_image" <?php checked(true, $react['options']['blog_featured_image']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Display the featured image when viewing the blog archive pages.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_featured_image_type"><?php esc_html_e('Featured image type', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose how the featured image is displayed', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="blog_featured_image_type" id="blog_featured_image_type">
												<option value="below" <?php selected($react['options']['blog_featured_image_type'], 'below'); ?>><?php esc_html_e('Below title (full width)', 'react'); ?></option>
												<option value="above" <?php selected($react['options']['blog_featured_image_type'], 'above'); ?>><?php esc_html_e('Above title (full width)', 'react'); ?></option>
												<option value="left" <?php selected($react['options']['blog_featured_image_type'], 'left'); ?>><?php esc_html_e('Float left', 'react'); ?></option>
												<option value="right" <?php selected($react['options']['blog_featured_image_type'], 'right'); ?>><?php esc_html_e('Float right', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The featured image type when viewing the blog archives and search results.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Default / Desktop', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="blog_featured_height"><?php esc_html_e('Featured image height', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="blog_featured_height" id="blog_featured_height" value="<?php echo esc_attr($react['options']['blog_featured_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image when viewing the blog archives and search results. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="blog_featured_height_tablet"><?php esc_html_e('Featured image height on tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="blog_featured_height_tablet" id="blog_featured_height_tablet" value="<?php echo esc_attr($react['options']['blog_featured_height_tablet']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image when viewing the blog archives and search results. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="blog_featured_height_phone"><?php esc_html_e('Featured image height on phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="blog_featured_height_phone" id="blog_featured_height_phone" value="<?php echo esc_attr($react['options']['blog_featured_height_phone']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image when viewing the blog archives and search results. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_featured_float_width"><?php esc_html_e('Float featured image width', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="blog_featured_float_width" id="blog_featured_float_width" value="<?php echo esc_attr($react['options']['blog_featured_float_width']); ?>" class="react-range-slider react-width-50" data-from="10" data-to="500" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The width of floating featured image for the blog archives and search results.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="blog_featured_float_height"><?php esc_html_e('Float featured image height', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="blog_featured_float_height" id="blog_featured_float_height" value="<?php echo esc_attr($react['options']['blog_featured_float_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The height of floating featured image for the blog archives and search results. If set to 0, it will be scaled automatically from the image dimensions.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Show like button on featured image', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="blog_featured_like_image" class="react-mini-label"><?php esc_html_e('Show / hide', 'react'); ?></label>
												<input type="checkbox" class="react-toggle bc-toggle-yn" name="blog_featured_like_image" id="blog_featured_like_image" <?php checked(true, $react['options']['blog_featured_like_image']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="blog_featured_like_image_icon" class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
												<select name="blog_featured_like_image_icon" id="blog_featured_like_image_icon">
													<option value="fa-thumbs-up" <?php selected($react['options']['blog_featured_like_image_icon'], 'fa-thumbs-up'); ?>><?php esc_html_e('Thumbs up', 'react'); ?></option>
													<option value="fa-heart" <?php selected($react['options']['blog_featured_like_image_icon'], 'fa-heart'); ?>><?php esc_html_e('Heart', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Shows a like button and the number of likes when hovering the featured image on the blog archives and search results, enables visitors to like posts.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->
						</div><!-- .react-sub-tabs -->
					</div><!-- .react-tab-3 -->

					<!-- Portfolios -->
					<div class="react-tab-4">
						<div class="react-sub-tabs-wrap">
							<ul class="react-sub-tabs-nav">
								<li><span><?php esc_html_e('General', 'react'); ?><span class="react-icon react-general"></span></span></li>
								<li><span><?php esc_html_e('Images', 'react'); ?><span class="react-icon react-image"></span></span></li>
							</ul>
						</div>

						<div class="react-sub-tabs">
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Portfolio settings', 'react'); ?></h2>
								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_single_layout"><?php esc_html_e('Single layout', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a layout', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="portfolio_single_layout" id="portfolio_single_layout" class="react-layout-selector">
												<option value="left-sidebar" <?php selected($react['options']['portfolio_single_layout'], 'left-sidebar'); ?>><?php esc_html_e('Left sidebar', 'react'); ?></option>
												<option value="full-width" <?php selected($react['options']['portfolio_single_layout'], 'full-width'); ?>><?php esc_html_e('Full width', 'react'); ?></option>
												<option value="right-sidebar" <?php selected($react['options']['portfolio_single_layout'], 'right-sidebar'); ?>><?php esc_html_e('Right sidebar', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the page layout when viewing a single portfolio item.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_layout"><?php esc_html_e('Archive layout', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a layout', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="portfolio_layout" id="portfolio_layout" class="react-layout-selector">
												<option value="left-sidebar" <?php selected($react['options']['portfolio_layout'], 'left-sidebar'); ?>><?php esc_html_e('Left sidebar', 'react'); ?></option>
												<option value="full-width" <?php selected($react['options']['portfolio_layout'], 'full-width'); ?>><?php esc_html_e('Full width', 'react'); ?></option>
												<option value="right-sidebar" <?php selected($react['options']['portfolio_layout'], 'right-sidebar'); ?>><?php esc_html_e('Right sidebar', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the page layout when viewing portfolio categories, tags or other archives.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_show_single_nav"><?php esc_html_e('Single navigation', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show or hide navigation on single item', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="portfolio_show_single_nav" id="portfolio_show_single_nav" <?php checked(true, $react['options']['portfolio_show_single_nav']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show previous / next post navigation on single portfolio items.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_show_title_single"><?php esc_html_e('Show title above content', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="portfolio_show_title_single" id="portfolio_show_title_single" <?php checked(true, $react['options']['portfolio_show_title_single']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The title is already shown in the intro section, enable this option to also show the title above the content.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_show_cats"><?php esc_html_e('Show categories for portfolio items', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="portfolio_show_cats" class="react-mini-label"><?php esc_html_e('Archive / search', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="portfolio_show_cats" id="portfolio_show_cats" <?php checked(true, $react['options']['portfolio_show_cats']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="portfolio_show_cats_single" class="react-mini-label"><?php esc_html_e('Single item page', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="portfolio_show_cats_single" id="portfolio_show_cats_single" <?php checked(true, $react['options']['portfolio_show_cats_single']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show a list of categories if the item belongs to any.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_show_tags"><?php esc_html_e('Show tags for portfolio items', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="portfolio_show_tags" class="react-mini-label"><?php esc_html_e('Archive / search', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="portfolio_show_tags" id="portfolio_show_tags" <?php checked(true, $react['options']['portfolio_show_tags']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="portfolio_show_tags_single" class="react-mini-label"><?php esc_html_e('Single item page', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-yn" name="portfolio_show_tags_single" id="portfolio_show_tags_single" <?php checked(true, $react['options']['portfolio_show_tags_single']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show a list of tags if the item belongs to any.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_show_share"><?php esc_html_e('Show social Share links', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle bc-toggle-yn" name="portfolio_show_share" id="portfolio_show_share" <?php checked(true, $react['options']['portfolio_show_share']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show Google+, Twitter, Facebook and Pinterest share buttons at the bottom of the post.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_show_author_bio_single"><?php esc_html_e('Show author bio', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="portfolio_show_author_bio_single" id="portfolio_show_author_bio_single" <?php checked(true, $react['options']['portfolio_show_author_bio_single']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show the author biography if the user has set one.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Single Portfolio Images', 'react'); ?></h2>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_single_featured_image"><?php esc_html_e('Featured image', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show or not featured images, which can be set when editing the portfolio item', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="portfolio_single_featured_image" id="portfolio_single_featured_image" <?php checked(true, $react['options']['portfolio_single_featured_image']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Display the featured image when viewing a single portfolio item. You can override this per item in the portfolio item metabox settings.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_single_featured_image_type"><?php esc_html_e('Featured image type', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose how the featured image is displayed', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="portfolio_single_featured_image_type" id="portfolio_single_featured_image_type">
												<option value="full" <?php selected($react['options']['portfolio_single_featured_image_type'], 'full'); ?>><?php esc_html_e('Full width', 'react'); ?></option>
												<option value="left" <?php selected($react['options']['portfolio_single_featured_image_type'], 'left'); ?>><?php esc_html_e('Float left', 'react'); ?></option>
												<option value="right" <?php selected($react['options']['portfolio_single_featured_image_type'], 'right'); ?>><?php esc_html_e('Float right', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The featured image type when viewing single portfolio items.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Default / Desktop', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="portfolio_single_featured_height"><?php esc_html_e('Featured image height', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="portfolio_single_featured_height" id="portfolio_single_featured_height" value="<?php echo esc_attr($react['options']['portfolio_single_featured_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for single portfolio items. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="portfolio_single_featured_height_tablet"><?php esc_html_e('Featured image height on tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="portfolio_single_featured_height_tablet" id="portfolio_single_featured_height_tablet" value="<?php echo esc_attr($react['options']['portfolio_single_featured_height_tablet']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for single portfolio items. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="portfolio_single_featured_height_phone"><?php esc_html_e('Featured image height on phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="portfolio_single_featured_height_phone" id="portfolio_single_featured_height_phone" value="<?php echo esc_attr($react['options']['portfolio_single_featured_height_phone']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for single portfolio items. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_single_featured_float_width"><?php esc_html_e('Float featured image width', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="portfolio_single_featured_float_width" id="portfolio_single_featured_float_width" value="<?php echo esc_attr($react['options']['portfolio_single_featured_float_width']); ?>" class="react-range-slider react-width-50" data-from="10" data-to="500" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The width of floating featured image for single portfolio items.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_single_featured_float_height"><?php esc_html_e('Float featured image height', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="portfolio_single_featured_float_height" id="portfolio_single_featured_float_height" value="<?php echo esc_attr($react['options']['portfolio_single_featured_float_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The height of floating featured image for single portfolio items. If set to 0, it will be scaled automatically from the image dimensions.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-4-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_single_featured_link_image"><?php esc_html_e('Link featured image to full size image', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="portfolio_single_featured_link_image" id="portfolio_single_featured_link_image" <?php checked(true, $react['options']['portfolio_single_featured_link_image']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When this is enabled, the featured image will link to the full size image.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Show like button on featured image', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="portfolio_single_featured_like_image" class="react-mini-label"><?php esc_html_e('Show / hide', 'react'); ?></label>
												<input type="checkbox" class="react-toggle bc-toggle-yn" name="portfolio_single_featured_like_image" id="portfolio_single_featured_like_image" <?php checked(true, $react['options']['portfolio_single_featured_like_image']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="portfolio_single_featured_like_image_icon" class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
												<select name="portfolio_single_featured_like_image_icon" id="portfolio_single_featured_like_image_icon">
													<option value="fa-thumbs-up" <?php selected($react['options']['portfolio_single_featured_like_image_icon'], 'fa-thumbs-up'); ?>><?php esc_html_e('Thumbs up', 'react'); ?></option>
													<option value="fa-heart" <?php selected($react['options']['portfolio_single_featured_like_image_icon'], 'fa-heart'); ?>><?php esc_html_e('Heart', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Shows a like button and the number of likes when hovering the featured image on single portfolio items, enables visitors to like the portfolio item.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<h2 class="react-panel-section-header"><?php esc_html_e('Portfolio Archive Images', 'react'); ?></h2>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_featured_image"><?php esc_html_e('Featured image', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show or not featured images, which can be set in your post', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="portfolio_featured_image" id="portfolio_featured_image" <?php checked(true, $react['options']['portfolio_featured_image']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Display the featured image for portfolio items when viewing the blog archive pages and search results.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_featured_image_type"><?php esc_html_e('Featured image type', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose how the featured image is displayed', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="portfolio_featured_image_type" id="portfolio_featured_image_type">
												<option value="below" <?php selected($react['options']['portfolio_featured_image_type'], 'below'); ?>><?php esc_html_e('Below title (full width)', 'react'); ?></option>
												<option value="above" <?php selected($react['options']['portfolio_featured_image_type'], 'above'); ?>><?php esc_html_e('Above title (full width)', 'react'); ?></option>
												<option value="left" <?php selected($react['options']['portfolio_featured_image_type'], 'left'); ?>><?php esc_html_e('Float left', 'react'); ?></option>
												<option value="right" <?php selected($react['options']['portfolio_featured_image_type'], 'right'); ?>><?php esc_html_e('Float right', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The featured image type for portfolio items when viewing the blog archives and search results.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Default / Desktop', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="portfolio_featured_height"><?php esc_html_e('Featured image height', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="portfolio_featured_height" id="portfolio_featured_height" value="<?php echo esc_attr($react['options']['portfolio_featured_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for portfolio items when viewing the blog archives and search results. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="portfolio_featured_height_tablet"><?php esc_html_e('Featured image height on tablets', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="portfolio_featured_height_tablet" id="portfolio_featured_height_tablet" value="<?php echo esc_attr($react['options']['portfolio_featured_height_tablet']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for portfolio items when viewing the blog archives and search results. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-3-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="portfolio_featured_height_phone"><?php esc_html_e('Featured image height on phones', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="portfolio_featured_height_phone" id="portfolio_featured_height_phone" value="<?php echo esc_attr($react['options']['portfolio_featured_height_phone']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="1500" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Sets the height of the full width featured image for portfolio items when viewing the blog archives and search results. If set to 0, the height will be scaled automatically.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_featured_float_width"><?php esc_html_e('Float featured image width', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="portfolio_featured_float_width" id="portfolio_featured_float_width" value="<?php echo esc_attr($react['options']['portfolio_featured_float_width']); ?>" class="react-range-slider react-width-50" data-from="10" data-to="500" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The width of floating featured image for portfolio items in the blog archives and search results.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="portfolio_featured_float_height"><?php esc_html_e('Float featured image height', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a value using the slider or enter it manually in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="portfolio_featured_float_height" id="portfolio_featured_float_height" value="<?php echo esc_attr($react['options']['portfolio_featured_float_height']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="500" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The height of floating featured image for portfolio items in the blog archives and search results. If set to 0, it will be scaled automatically from the image dimensions.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Show like button on featured image', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="portfolio_featured_like_image" class="react-mini-label"><?php esc_html_e('Show / hide', 'react'); ?></label>
												<input type="checkbox" class="react-toggle bc-toggle-yn" name="portfolio_featured_like_image" id="portfolio_featured_like_image" <?php checked(true, $react['options']['portfolio_featured_like_image']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="portfolio_featured_like_image_icon" class="react-mini-label"><?php esc_html_e('Icon', 'react'); ?></label>
												<select name="portfolio_featured_like_image_icon" id="portfolio_featured_like_image_icon">
													<option value="fa-thumbs-up" <?php selected($react['options']['portfolio_featured_like_image_icon'], 'fa-thumbs-up'); ?>><?php esc_html_e('Thumbs up', 'react'); ?></option>
													<option value="fa-heart" <?php selected($react['options']['portfolio_featured_like_image_icon'], 'fa-heart'); ?>><?php esc_html_e('Heart', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Shows a like button and the number of likes when hovering the featured image on portfolio items in search results and archives, enables visitors to like the portfolio item.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div>

						</div><!-- .react-sub-tabs -->
					</div><!-- .react-tab-4 -->



					<!-- Components -->
					<div class="react-tab-5">
						<div class="react-sub-tabs-wrap">
							<ul class="react-sub-tabs-nav">
								<li><span><?php esc_html_e('Pop Down', 'react'); ?><span class="react-icon react-down"></span></span></li>
								<li><span><?php esc_html_e('Info Menu', 'react'); ?><span class="react-icon react-info"></span></span></li>
								<li><span><?php esc_html_e('Sliders', 'react'); ?><span class="react-icon react-cycle"></span></span></li>
								<li><span><?php esc_html_e('WooCommerce', 'react'); ?><span class="react-icon react-ecom"></span></span></li>
								<li><span><?php esc_html_e('More', 'react'); ?><span class="react-icon react-more"></span></span></li>
							</ul>
						</div>

						<div class="react-sub-tabs">
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Pop Down trigger', 'react'); ?></h2>
								<!-- Show if Pop Down off -->
								<div class="only_for_popdown"><p class="react-warning"><?php esc_html_e('Pop Down section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>

								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Heading', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Description', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Icon', 'react'); ?></span></li>
									</ul>
								</div>

								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="popdown_trigger_heading"><?php esc_html_e('Trigger heading', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('The Pop Down trigger is a small box with text that shows the Pop Down content when clicked', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input class="react-width-300" type="text" name="popdown_trigger_heading" id="popdown_trigger_heading" value="<?php echo esc_attr($react['options']['popdown_trigger_heading']); ?>" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Add some relevant text to be displayed inside the Pop Down trigger.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="popdown_trigger_description"><?php esc_html_e('Trigger description', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input class="react-width-300" type="text" name="popdown_trigger_description" id="popdown_trigger_description" value="<?php echo esc_attr($react['options']['popdown_trigger_description']); ?>" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Add some text to be displayed under the Pop Down trigger title.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>

									<div class="react-table-tab">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label><?php esc_html_e('Trigger icon', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<?php echo react_icon_selector_field($react['options']['popdown_trigger_icon'], 'popdown_trigger_icon'); ?>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Add an icon to be displayed.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>

								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="pop_down_trigger_absolute"><?php esc_html_e('Absolute positioning?', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('If turned on, the trigger will show at the top right of page', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="pop_down_trigger_absolute" id="pop_down_trigger_absolute" <?php checked(true, $react['options']['pop_down_trigger_absolute']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('If turned on, the trigger will show at the top right of page&#59; if off, the trigger will show as a banner above the Headers.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<div id="only_for_absolute_popdown">
									<table class="react-form-table react-tab-5-form-table">
										<tr class="react-settings-sub-head">
											<th colspan="2">
												<label for="pop_down_trigger_convert"><?php esc_html_e('Convert to relative mode', 'react'); ?></label>
												<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose when to swap to relative mode', 'react'); ?></span></span>
											</th>
										</tr>
										<tr class="react-content-row react-content-input-has-many">
											<td class="react-form-table-input-area-td">
												<div class="react-multi-input-wrap">
													<!-- Show if absolute is Off -->
													<select name="pop_down_trigger_convert" id="pop_down_trigger_convert">
														<option value="phone-ptr" <?php selected($react['options']['pop_down_trigger_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
														<option value="phone-ldsp" <?php selected($react['options']['pop_down_trigger_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
														<option value="tablet-ptr" <?php selected($react['options']['pop_down_trigger_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
														<option value="tablet-ldsp" <?php selected($react['options']['pop_down_trigger_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
														<option value="box-width" <?php selected($react['options']['pop_down_trigger_convert'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
														<option value="never" <?php selected($react['options']['pop_down_trigger_convert'], 'never'); ?>><?php esc_html_e('Never', 'react'); ?></option>
														<option value="custom" <?php selected($react['options']['pop_down_trigger_convert'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
													</select>
												</div>
												<div class="react-multi-input-wrap" id="pop_down_trigger_convert_custom_hide">
													<input type="text" name="pop_down_trigger_convert_custom" id="pop_down_trigger_convert_custom" value="<?php echo esc_attr($react['options']['pop_down_trigger_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
												</div>
											</td>
											<td class="react-form-table-desc-td">
												<p class="react-description"><?php esc_html_e('Choose when to swap the trigger to relative mode. On smaller screens, the absolutely positioned trigger may overlap other page content.', 'react'); ?></p>
											</td>
										</tr>
									</table>
								</div>

								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="pop_down_trigger_dismiss"><?php esc_html_e('Use trigger dismiss button', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('The dismiss button is a small X icon that hides the trigger', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="pop_down_trigger_dismiss" id="pop_down_trigger_dismiss" <?php checked(true, $react['options']['pop_down_trigger_dismiss']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose whether to allow trigger to be hidden or not.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<h2 class="react-panel-section-header"><?php esc_html_e('Pop Down content', 'react'); ?></h2>

								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Content type', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="popdown_content_type" name="popdown_content_type">
												<option value="html" <?php selected($react['options']['popdown_content_type'], 'html'); ?>><?php esc_html_e('Text, HTML and shortcodes', 'react'); ?></option>
												<option value="widget" <?php selected($react['options']['popdown_content_type'], 'widget'); ?>><?php esc_html_e('Widget area', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose a method of displaying content in the Pop Down.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table id="popdown_plain_content_wrap" class="react-form-table react-tab-6-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="popdown_plain_content"><?php esc_html_e('HTML and shortcodes', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enter the content for the Pop Down', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<textarea name="popdown_plain_content" id="popdown_plain_content"><?php echo esc_textarea($react['options']['popdown_plain_content']); ?></textarea>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Add text, HTML, and/or shortcodes.', 'react'); ?></p>
										</td>
									</tr>

								</table>

								<table id="popdown_widget_area_layout_wrap" class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Pop Down widget area', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="popdown_widget_area_layout" class="react-mini-label"><?php esc_html_e('Layout', 'react'); ?></label>
												<select id="popdown_widget_area_layout" name="popdown_widget_area_layout">
													<?php echo react_render_column_layout_options($react['options']['popdown_widget_area_layout']); ?>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="popdown_columns_convert" class="react-mini-label"><?php esc_html_e('Columns convert', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('Choose when to swap to a new column layout.', 'react'); ?></span></span></label>
												<select name="popdown_columns_convert" id="popdown_columns_convert">
													<option value="" <?php selected($react['options']['popdown_columns_convert'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
													<option value="phone-width-100" <?php selected($react['options']['popdown_columns_convert'], 'phone-width-100'); ?>><?php esc_html_e('Phone 1 column', 'react'); ?></option>
													<option value="units-phone-50" <?php selected($react['options']['popdown_columns_convert'], 'units-phone-50'); ?>><?php esc_html_e('Phone 2 columns', 'react'); ?></option>
													<option value="mobile-width-100" <?php selected($react['options']['popdown_columns_convert'], 'mobile-width-100'); ?>><?php esc_html_e('Tablet and phone 1 column', 'react'); ?></option>
													<option value="units-mobile-50" <?php selected($react['options']['popdown_columns_convert'], 'units-mobile-50'); ?>><?php esc_html_e('Tablet and phone 2 columns', 'react'); ?></option>
													<option value="units-tablet-50 phone-width-100" <?php selected($react['options']['popdown_columns_convert'], 'units-tablet-50 phone-width-100'); ?>><?php esc_html_e('Tablet 2 columns, phone 1 column', 'react'); ?></option>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the layout for the Pop Down widget area. You can add widgets by going to Appearance &rarr; Widgets.', 'react'); ?></p>
										</td>
									</tr>
								</table>

							<table class="react-form-table react-tab-5-form-table">
								<tr class="react-settings-sub-head">
									<th colspan="2">
										<label><?php esc_html_e('Pop Down fixed position', 'react'); ?></label>
										<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('If fixed, goes over the other page content', 'react'); ?></span></span>
									</th>
								</tr>
								<tr class="react-content-row react-content-input-has-many">
									<td class="react-form-table-input-area-td">
										<div class="react-multi-input-wrap">
											<label for="pop_down_fixed" class="react-mini-label"><?php esc_html_e('Fixed', 'react'); ?></label>
											<input type="checkbox" class="react-toggle" name="pop_down_fixed" id="pop_down_fixed" <?php checked(true, $react['options']['pop_down_fixed']); ?> value="1" />
										</div>
										<div class="react-multi-input-wrap">
											<label for="pop_down_fixed_full_height" class="react-mini-label"><?php esc_html_e('Use screen height', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('No matter what amount of content is in the Pop Down area, if turned on it will always be a minimum of the screen height, thus covering all other page content.', 'react'); ?></span></span></label>
											<input type="checkbox" class="react-toggle" name="pop_down_fixed_full_height" id="pop_down_fixed_full_height" <?php checked(true, $react['options']['pop_down_fixed_full_height']); ?> value="1" />
										</div>
									</td>
									<td class="react-form-table-desc-td">
										<p class="react-description"><?php esc_html_e('Decide whether you would like the Pop Down to displace the other page content (not fixed) or to slide directly over the page content (fixed).', 'react'); ?></p>
									</td>
								</tr>
							</table>

							<table class="react-form-table react-tab-5-form-table">
								<tr class="react-settings-sub-head">
									<th colspan="2">
										<label for="popdown_start_point"><?php esc_html_e('Starting position', 'react'); ?></label>
										<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose if Pop Down is open or closed at first', 'react'); ?></span></span>
									</th>
								</tr>
								<tr class="react-content-row">
									<td class="react-form-table-input-area-td">
										<select id="popdown_start_point" name="popdown_start_point">
											<option value="start-down" <?php selected($react['options']['popdown_start_point'], 'start-down'); ?>><?php esc_html_e('Visible', 'react'); ?></option>
											<option value="start-up" <?php selected($react['options']['popdown_start_point'], 'start-up'); ?>><?php esc_html_e('Hidden', 'react'); ?></option>
										</select>
									</td>
									<td class="react-form-table-desc-td">
										<p class="react-description"><?php esc_html_e('On first visiting the site, should the Pop Down content be visible or hidden with the trigger visible.', 'react'); ?></p>
									</td>
								</tr>
							</table>

							<table class="react-form-table react-tab-5-form-table">
								<tr class="react-settings-sub-head">
									<th colspan="2">
										<label for="popdown_cookie_expires"><?php esc_html_e('Dismissed cookie expiration', 'react'); ?></label>
										<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('How many days should we remember that they closed the Pop Down?', 'react'); ?></span></span>
									</th>
								</tr>
								<tr class="react-content-row">
									<td class="react-form-table-input-area-td">
										<input type="text" name="popdown_cookie_expires" id="popdown_cookie_expires" value="<?php echo esc_attr($react['options']['popdown_cookie_expires']); ?>" class="react-width-60" /><span class="react-range-unit"><?php esc_html_e('days', 'react'); ?></span>
									</td>
									<td class="react-form-table-desc-td">
										<p class="react-description"><?php esc_html_e('When the user closes the Pop Down a cookie will be set so that it stays closed when they visit the site again, this option sets how many days this cookie should last for.', 'react'); ?></p>
									</td>
								</tr>
							</table>
						</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Info Menu options', 'react'); ?></h2>
								<!-- Show if InfoMenu off -->
								<div class="only_for_infomenu"><p class="react-warning"><?php esc_html_e('Info Menu section is not visible on any device. To switch it on, go to: Design &rarr; On / Off.', 'react'); ?></p></div>
								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('Width (Default)', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Large screens', 'react'); ?></span></li>
									</ul>
								</div>
								<div class="react-table-tabs">
									<div class="react-table-tab">
										<table class="react-form-table react-tab-6-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="infomenu_dropdown_width"><?php esc_html_e('Pop Out width', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a width in pixels', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="infomenu_dropdown_width" id="infomenu_dropdown_width" value="<?php echo esc_attr($react['options']['infomenu_dropdown_width']); ?>" class="react-range-slider react-width-50" data-from="100" data-to="800" data-step="10" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('The Pop Out box is the small content area which is shown when the user clicks the menu item.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-6-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="infomenu_dropdown_width_large"><?php esc_html_e('Pop Out width for Large screens', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a width in pixels', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="text" name="infomenu_dropdown_width_large" id="infomenu_dropdown_width_large" value="<?php echo esc_attr($react['options']['infomenu_dropdown_width_large']); ?>" class="react-range-slider react-width-50" data-from="100" data-to="800" data-step="10" data-dimension="px" /><span class="react-range-unit">px</span>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Change the width for large screens.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>

								<!-- genenral -->
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="infomenu_nav_style"><?php esc_html_e('Buttons Style', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="infomenu_nav_style" name="infomenu_nav_style">
												<option value="im-button" <?php selected($react['options']['infomenu_nav_style'], 'im-button'); ?>><?php esc_html_e('Button', 'react'); ?></option>
												<option value="im-split" <?php selected($react['options']['infomenu_nav_style'], 'im-split'); ?>><?php esc_html_e('Vertical line break', 'react'); ?></option>
												<option value="im-plain" <?php selected($react['options']['infomenu_nav_style'], 'im-plain'); ?>><?php esc_html_e('Plain icons', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose a style for the icon menu used to open and close the Info Menu content area.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="infomenu_nav_description"><?php esc_html_e('Show description', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="infomenu_nav_description" name="infomenu_nav_description">
												<option value="im-hover-dec" <?php selected($react['options']['infomenu_nav_description'], 'im-hover-dec'); ?>><?php esc_html_e('Show title on hover', 'react'); ?></option>
												<option value="im-no-dec" <?php selected($react['options']['infomenu_nav_description'], 'im-no-dec'); ?>><?php esc_html_e('Hide title', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose a style for the icon menu used to open and close the Info Menu content area.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="infomenu_dropdown_convert"><?php esc_html_e('When to convert Pop Out to Slide Down', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<select name="infomenu_dropdown_convert" id="infomenu_dropdown_convert">
													<option value="phone-ptr" <?php selected($react['options']['infomenu_dropdown_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
													<option value="phone-ldsp" <?php selected($react['options']['infomenu_dropdown_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
													<option value="tablet-ptr" <?php selected($react['options']['infomenu_dropdown_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
													<option value="tablet-ldsp" <?php selected($react['options']['infomenu_dropdown_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
													<option value="box-width" <?php selected($react['options']['infomenu_dropdown_convert'], 'box-width'); ?>><?php esc_html_e('Box width (if set)', 'react'); ?></option>
													<option value="custom" <?php selected($react['options']['infomenu_dropdown_convert'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap" id="infomenu_dropdown_convert_custom_hide">
												<input type="text" name="infomenu_dropdown_convert_custom" id="infomenu_dropdown_convert_custom" value="<?php echo esc_attr($react['options']['infomenu_dropdown_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The Slide Down method is more optimal for displaying the Info Menu content on smaller screens. Choose when to swap elements set to Pop Out to instead show as Slide Down.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<h2 class="react-panel-section-header"><?php esc_html_e('Sort display order', 'react'); ?></h2>
								<div id="react-im-sort">
									<?php foreach ($imOrder as $id) : ?>
										<div class="react-im-sort-one react-tooltip" data-id="<?php echo esc_attr($id); ?>"><?php echo esc_html(react_lookup_im_label($id)); ?><span class="react-tooltip-text"><?php echo esc_html(react_lookup_im_label($id)); ?></span></div>
									<?php endforeach; ?>
								</div>

								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Contact', 'react'); ?></div>
									<div class="react-accordion-content">
										<!-- Contact panel -->
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="im_contact_on"><?php esc_html_e('Contact form', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Use Quform to create your forms', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle" name="im_contact_on" id="im_contact_on" <?php checked(true, $react['options']['im_contact_on']); ?> value="1" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Displays a form inside the Info Menu content area.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<div id="im_contact_on_hide">
											<table class="react-form-table react-tab-6-form-table">
												<tr class="react-settings-sub-head">
													<th colspan="2">
														<label><?php esc_html_e('Pick a form', 'react'); ?></label>
													</th>
												</tr>
												<tr class="react-content-row">
													<td class="react-form-table-input-area-td">
														<?php echo react_render_quform_form_select('contact_quform_id_infomenu', $react['options']['contact_quform_id_infomenu']); ?>
													</td>
													<td class="react-form-table-desc-td">
														<p class="react-description"><?php esc_html_e('Choose which form to use.', 'react'); ?></p>
													</td>
												</tr>
											</table>
											<div class="react-table-tabs-wrap">
												<ul class="react-table-tabs-nav">
													<li><span><?php esc_html_e('Box type', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Title', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Icon', 'react'); ?></span></li>
												</ul>
											</div>
											<div class="react-table-tabs">
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label><?php esc_html_e('Box type', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a method for displaying the content', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<div class="react-multi-input-wrap">
																	<select id="im_display_type_contact" name="im_display_type_contact">
																		<option value="drop-down" <?php selected($react['options']['im_display_type_contact'], 'drop-down'); ?>><?php esc_html_e('Pop Out', 'react'); ?></option>
																		<option value="slide-out" <?php selected($react['options']['im_display_type_contact'], 'slide-out'); ?>><?php esc_html_e('Slide Down', 'react'); ?></option>
																	</select>
																</div>
																<div class="react-break"></div>
																<div class="react-multi-input-wrap">
																	<label for="im_scroll_type_contact" class="react-mini-label"><?php esc_html_e('Fixed height', 'react'); ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('The area will be set to a fixed height of your choice and overflowing content will be scrollable.', 'react'); ?></span></span></label>
																	<input type="checkbox" class="react-toggle" name="im_scroll_type_contact" id="im_scroll_type_contact" <?php checked(true, $react['options']['im_scroll_type_contact']); ?> value="1" />
																</div>
																<div id="im_scroll_type_contact_hide" class="react-multi-input-wrap">
																	<label for="im_scroll_height_type_contact" class="react-mini-label"><?php esc_html_e('Height', 'react'); ?></label>

																	<input type="text" name="im_scroll_height_type_contact" id="im_scroll_height_type_contact" value="<?php echo esc_attr($react['options']['im_scroll_height_type_contact']); ?>" class="react-range-slider react-width-50" data-from="50" data-to="900" data-step="5" data-dimension="px" /><span class="react-range-unit">px</span>
																</div>
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('How would you like the content displayed for this item in the Info Menu? If you choose Pop Out, you can swap to (the more practical) Slide Down option for smaller screens using the convert option above.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label for="im_display_text_contact"><?php esc_html_e('Text', 'react'); ?></label>
														   </th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<input type="text" name="im_display_text_contact" id="im_display_text_contact" value="<?php echo esc_attr($react['options']['im_display_text_contact']); ?>" />
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('Give this section a title. This will show on hovering over the icon.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label><?php esc_html_e('Icon', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Use the icon selector to choose an icon', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<?php echo react_icon_selector_field($react['options']['im_display_icon_contact'], 'im_display_icon_contact'); ?>
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('Choose a relevant icon to be displayed for this item in the Info Menu.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
											</div>
										 </div>
									</div><!-- Accordion end -->
								</div>

								<!-- Location panel -->
								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Location', 'react'); ?></div>
									<div class="react-accordion-content">
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="im_location_on"><?php esc_html_e('Location Map', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Add a map to display a location', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle" name="im_location_on" id="im_location_on" <?php checked(true, $react['options']['im_location_on']); ?> value="1" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Show the search button in the Header.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<div id="im_location_on_hide">
											<table class="react-form-table react-tab-6-form-table">
												<tr class="react-settings-sub-head">
													<th colspan="2">
														<label for="im_contact_map"><?php esc_html_e('Map HTML', 'react'); ?></label>
														<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Add a map image or link', 'react'); ?></span></span>
													</th>
												</tr>
												<tr class="react-content-row">
													<td class="react-form-table-input-area-td">
														<textarea name="im_contact_map" id="im_contact_map"><?php echo esc_textarea($react['options']['im_contact_map']); ?></textarea>
														<div class="react-multi-input-wrap">
														<label for="im_contact_map_ratio_first" class="react-mini-label"><?php esc_html_e('Aspect ratio', 'react'); ?></label>
															<label for="im_contact_map_ratio_first" class="react-align-text-to-input"><?php esc_html_e('Width', 'react'); ?></label>
															<input class="react-width-50" type="text" name="im_contact_map_ratio_first" id="im_contact_map_ratio_first" value="<?php echo esc_attr($react['options']['im_contact_map_ratio_first']); ?>" />
															<label class="react-align-text-to-input">:</label>
															<input class="react-width-50" type="text" name="im_contact_map_ratio_last" id="im_contact_map_ratio_last" value="<?php echo esc_attr($react['options']['im_contact_map_ratio_last']); ?>" />
															<label for="im_contact_map_ratio_last" class="react-align-text-to-input"><?php esc_html_e('Height', 'react'); ?></label>
														</div>
													</td>
													<td class="react-form-table-desc-td">
														<p class="react-description"><?php esc_html_e('The HTML for the map, e.g. Google maps embed code.', 'react'); ?></p>
													</td>
												</tr>
											</table>
											<div class="react-table-tabs-wrap">
												<ul class="react-table-tabs-nav">
													<li><span><?php esc_html_e('Box type', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Title', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Icon', 'react'); ?></span></li>
												</ul>
											</div>
											<div class="react-table-tabs">
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label for="im_display_type_location"><?php esc_html_e('Box type', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a method for displaying the content', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<select id="im_display_type_location" name="im_display_type_location">
																	<option value="drop-down" <?php selected($react['options']['im_display_type_location'], 'drop-down'); ?>><?php esc_html_e('Pop Out', 'react'); ?></option>
																	<option value="slide-out" <?php selected($react['options']['im_display_type_location'], 'slide-out'); ?>><?php esc_html_e('Slide Down', 'react'); ?></option>
																</select>
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('How would you like the content displayed for this item in the Info Menu? If you choose pop out, you can swap to (the more practical) slide out option for smaller screens using the convert option above.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label for="im_display_text_location"><?php esc_html_e('Text', 'react'); ?></label>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<input type="text" name="im_display_text_location" id="im_display_text_location" value="<?php echo esc_attr($react['options']['im_display_text_location']); ?>" />
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('Give this section a title. This will show on hovering over the icon.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label><?php esc_html_e('Icon', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Use the icon selector to choose an icon', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<?php echo react_icon_selector_field($react['options']['im_display_icon_location'], 'im_display_icon_location'); ?>
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('Choose a relevant icon to be displayed for this item in the Info Menu.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div><!-- Accordion end -->
								</div>

								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Video', 'react'); ?></div>
									<div class="react-accordion-content">

										<!-- Video panel -->
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="im_video_on"><?php esc_html_e('Video', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show a video', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle" name="im_video_on" id="im_video_on" <?php checked(true, $react['options']['im_video_on']); ?> value="1" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Embed a video from YouTube, Vimeo or a similar site to show in the Info Menu.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<div id="im_video_on_hide">
											<table class="react-form-table react-tab-2-form-table">
												<tr class="react-settings-sub-head">
													<th colspan="2">
														<label for="im_video"><?php esc_html_e('Video Embed', 'react'); ?></label>
														<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enter the Embed code. Usually an iframe.', 'react'); ?></span></span>
													</th>
												</tr>
												<tr class="react-content-row">
													<td class="react-form-table-input-area-td">
														<textarea name="im_video" id="im_video"><?php echo esc_textarea($react['options']['im_video']); ?></textarea>
														<div class="react-multi-input-wrap">
														<label for="im_contact_video_ratio_first" class="react-mini-label"><?php esc_html_e('Aspect ratio', 'react'); ?></label>
															<label for="im_contact_video_ratio_first" class="react-align-text-to-input"><?php esc_html_e('Width', 'react'); ?></label>
															<input class="react-width-50" type="text" name="im_contact_video_ratio_first" id="im_contact_video_ratio_first" value="<?php echo esc_attr($react['options']['im_contact_video_ratio_first']); ?>" />
															<label class="react-align-text-to-input">:</label>
															<input class="react-width-50" type="text" name="im_contact_video_ratio_last" id="im_contact_video_ratio_last" value="<?php echo esc_attr($react['options']['im_contact_video_ratio_last']); ?>" />
															<label for="im_contact_video_ratio_last" class="react-align-text-to-input"><?php esc_html_e('Height', 'react'); ?></label>
														</div>
													</td>
													<td class="react-form-table-desc-td">
														<p class="react-description"><?php esc_html_e('Enter the Embed code for a YouTube or Vimeo video. The default ratio is 16:9, if your video is not this ratio then add the new width and height.', 'react'); ?></p>
													</td>
												</tr>
											</table>
											<div class="react-table-tabs-wrap">
												<ul class="react-table-tabs-nav">
													<li><span><?php esc_html_e('Box type', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Title', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Icon', 'react'); ?></span></li>
												</ul>
											</div>
											<div class="react-table-tabs">
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label for="im_display_type_video"><?php esc_html_e('Box type', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a method for displaying the content', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<select id="im_display_type_video" name="im_display_type_video">
																	<option value="drop-down" <?php selected($react['options']['im_display_type_video'], 'drop-down'); ?>><?php esc_html_e('Pop Out', 'react'); ?></option>
																	<option value="slide-out" <?php selected($react['options']['im_display_type_video'], 'slide-out'); ?>><?php esc_html_e('Slide Down', 'react'); ?></option>
																</select>
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('How would you like the content displayed for this item in the Info Menu? If you choose Pop Out, you can swap to (the more practical) Slide Down option for smaller screens using the convert option above.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label for="im_display_text_video"><?php esc_html_e('Text', 'react'); ?></label>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<input type="text" name="im_display_text_video" id="im_display_text_video" value="<?php echo esc_attr($react['options']['im_display_text_video']); ?>" />
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('Give this section a title. This will show on hovering over the icon.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label><?php esc_html_e('Icon', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Use the icon selector to choose an icon', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<?php echo react_icon_selector_field($react['options']['im_display_icon_video'], 'im_display_icon_video'); ?>
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('Choose a relevant icon to be displayed for this item in the Info Menu.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div><!-- Accordion end -->
								</div>


								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Search', 'react'); ?></div>
									<div class="react-accordion-content">
										<!-- Search panel -->
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="im_search_on"><?php esc_html_e('Search field', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show a search field', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle" name="im_search_on" id="im_search_on" <?php checked(true, $react['options']['im_search_on']); ?> value="1" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Use the WordPress site search field in the Info Menu.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<div id="im_search_on_hide">
											<table class="react-form-table react-tab-1-form-table">
												<tr class="react-settings-sub-head">
													<th colspan="2">
														<label for="im_tag_cloud"><?php esc_html_e('Show tag cloud', 'react'); ?></label>
														<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Tags are added to posts in WordPress', 'react'); ?></span></span>
													</th>
												</tr>
												<tr class="react-content-row">
													<td class="react-form-table-input-area-td">
														<input type="checkbox" class="react-toggle" name="im_tag_cloud" id="im_tag_cloud" <?php checked(true, $react['options']['im_tag_cloud']); ?> value="1" />
													</td>
													<td class="react-form-table-desc-td">
														<p class="react-description"><?php esc_html_e('Choose to show all the tags you have added to posts and pages to help users find what they are looking for.', 'react'); ?></p>
													</td>
												</tr>
											</table>
											<div class="react-table-tabs-wrap">
												<ul class="react-table-tabs-nav">
													<li><span><?php esc_html_e('Box type', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Title', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Icon', 'react'); ?></span></li>
												</ul>
											</div>
											<div class="react-table-tabs">
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label for="im_display_type_search"><?php esc_html_e('Box type', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a method for displaying the content', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<select id="im_display_type_search" name="im_display_type_search">
																	<option value="drop-down" <?php selected($react['options']['im_display_type_search'], 'drop-down'); ?>><?php esc_html_e('Pop Out', 'react'); ?></option>
																	<option value="slide-out" <?php selected($react['options']['im_display_type_search'], 'slide-out'); ?>><?php esc_html_e('Slide Down', 'react'); ?></option>
																</select>
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('How would you like the content displayed for this item in the Info Menu? If you choose Pop Out, you can swap to (the more practical) Slide Down option for smaller screens using the convert option above.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label for="im_display_text_search"><?php esc_html_e('Text', 'react'); ?></label>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<input type="text" name="im_display_text_search" id="im_display_text_search" value="<?php echo esc_attr($react['options']['im_display_text_search']); ?>" />
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('Give this section a title. This will show on hovering over the icon.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label><?php esc_html_e('Icon', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Use the icon selector to choose an icon', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<?php echo react_icon_selector_field($react['options']['im_display_icon_search'], 'im_display_icon_search'); ?>
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('Choose a relevant icon to be displayed for this item in the Info Menu.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
											</div>
										</div>
									</div><!-- Accordion end -->
								</div>

								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Image background controls', 'react'); ?></div>
									<div class="react-accordion-content">
										<div id="controls_location_fs_off"><p class="react-warning"><?php esc_html_e('Please enable background image controls for the Info Menu. Backgrounds &rarr; Images &rarr; Image controls location.', 'react'); ?></p></div>
										<!-- FS controls panel -->
										<div id="controls_location_fs_on">
											<table class="react-form-table react-tab-1-form-table">
												<tr class="react-settings-sub-head">
													<th colspan="2">
														<label for="im_fscontrols_on"><?php esc_html_e('Full screen image controls', 'react'); ?></label>
													</th>
												</tr>
												<tr class="react-content-row">
													<td class="react-form-table-input-area-td">
														<input type="checkbox" class="react-toggle" name="im_fscontrols_on" id="im_fscontrols_on" <?php checked(true, $react['options']['im_fscontrols_on']); ?> value="1" />
													</td>
													<td class="react-form-table-desc-td">
														<p class="react-description"><?php esc_html_e('This lets the user navigate through the full screen background images. You can set up your background images in Backgrounds &rarr; Images.', 'react'); ?></p>
													</td>
												</tr>
											</table>
											<div id="im_fscontrols_on_hide">
												<div class="react-table-tabs-wrap">
													<ul class="react-table-tabs-nav">
														<li><span><?php esc_html_e('Box type', 'react'); ?></span></li>
														<li><span><?php esc_html_e('Title', 'react'); ?></span></li>
														<li><span><?php esc_html_e('Icon', 'react'); ?></span></li>
													</ul>
												</div>
												<div class="react-table-tabs">
													<div class="react-table-tab">
														<table class="react-form-table react-tab-5-form-table">
															<tr class="react-settings-sub-head">
																<th colspan="2">
																	<label for="im_display_type_fscontrols"><?php esc_html_e('Box type', 'react'); ?></label>
																	<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a method for displaying the content', 'react'); ?></span></span>
																</th>
															</tr>
															<tr class="react-content-row">
																<td class="react-form-table-input-area-td">
																	<select id="im_display_type_fscontrols" name="im_display_type_fscontrols">
																		<option value="drop-down" <?php selected($react['options']['im_display_type_fscontrols'], 'drop-down'); ?>><?php esc_html_e('Pop Out', 'react'); ?></option>
																		<option value="slide-out" <?php selected($react['options']['im_display_type_fscontrols'], 'slide-out'); ?>><?php esc_html_e('Slide Down', 'react'); ?></option>
																	</select>
																</td>
																<td class="react-form-table-desc-td">
																	<p class="react-description"><?php esc_html_e('How would you like the content displayed for this item in the Info Menu? If you choose Pop Out, you can swap to (the more practical) Slide Down option for smaller screens using the convert option above.', 'react'); ?></p>
																</td>
															</tr>
														</table>
													</div>
													<div class="react-table-tab">
														<table class="react-form-table react-tab-5-form-table">
															<tr class="react-settings-sub-head">
																<th colspan="2">
																	<label for="im_display_text_fscontrols"><?php esc_html_e('Text', 'react'); ?></label>
																</th>
															</tr>
															<tr class="react-content-row">
																<td class="react-form-table-input-area-td">
																	<input type="text" name="im_display_text_fscontrols" id="im_display_text_fscontrols" value="<?php echo esc_attr($react['options']['im_display_text_fscontrols']); ?>" />
																</td>
																<td class="react-form-table-desc-td">
																	<p class="react-description"><?php esc_html_e('Give this section a title. This will show on hovering over the icon.', 'react'); ?></p>
																</td>
															</tr>
														</table>
													</div>
													<div class="react-table-tab">
														<table class="react-form-table react-tab-5-form-table">
															<tr class="react-settings-sub-head">
																<th colspan="2">
																	<label><?php esc_html_e('Icon', 'react'); ?></label>
																	<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Use the icon selector to choose an icon', 'react'); ?></span></span>
																</th>
															</tr>
															<tr class="react-content-row">
																<td class="react-form-table-input-area-td">
																	<?php echo react_icon_selector_field($react['options']['im_display_icon_fscontrols'], 'im_display_icon_fscontrols'); ?>
																</td>
																<td class="react-form-table-desc-td">
																	<p class="react-description"><?php esc_html_e('Choose a relevant icon to be displayed for this item in the Info Menu.', 'react'); ?></p>
																</td>
															</tr>
														</table>
													</div>
												</div>
											</div>
										</div><!-- show / hide wrap -->
									</div><!-- Accordion end -->
								</div>
								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Audio controls', 'react'); ?></div>
									<div class="react-accordion-content">
										<div id="controls_location_audio_off"><p class="react-warning"><?php esc_html_e('Please enable audio controls for the Info Menu. Backgrounds &rarr; Audio &rarr; Audio controls location.', 'react'); ?></p></div>
										<!-- Audio controls panel -->
										<div id="controls_location_audio_on">
											<table class="react-form-table react-tab-1-form-table">
												<tr class="react-settings-sub-head">
													<th colspan="2">
														<label for="im_audiocontrols_on"><?php esc_html_e('Audio background controls', 'react'); ?></label>
													</th>
												</tr>
												<tr class="react-content-row">
													<td class="react-form-table-input-area-td">
														<input type="checkbox" class="react-toggle" name="im_audiocontrols_on" id="im_audiocontrols_on" <?php checked(true, $react['options']['im_audiocontrols_on']); ?> value="1" />
													</td>
													<td class="react-form-table-desc-td">
														<p class="react-description"><?php esc_html_e("This lets the user control the audio. You can set up your website's audio in Backgrounds &rarr; Audio.", 'react'); ?></p>
													</td>
												</tr>
											</table>
											<div id="im_audiocontrols_on_hide">

												<div class="react-table-tabs-wrap">
													<ul class="react-table-tabs-nav">
														<li><span><?php esc_html_e('Box type', 'react'); ?></span></li>
														<li><span><?php esc_html_e('Title', 'react'); ?></span></li>
														<li><span><?php esc_html_e('Icon', 'react'); ?></span></li>
													</ul>
												</div>
												<div class="react-table-tabs">
													<div class="react-table-tab">
														<table class="react-form-table react-tab-5-form-table">
															<tr class="react-settings-sub-head">
																<th colspan="2">
																	<label for="im_display_type_audiocontrols"><?php esc_html_e('Box type', 'react'); ?></label>
																	<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a method for displaying the content', 'react'); ?></span></span>
																</th>
															</tr>
															<tr class="react-content-row">
																<td class="react-form-table-input-area-td">
																	<select id="im_display_type_audiocontrols" name="im_display_type_audiocontrols">
																		<option value="drop-down" <?php selected($react['options']['im_display_type_audiocontrols'], 'drop-down'); ?>><?php esc_html_e('Pop Out', 'react'); ?></option>
																		<option value="slide-out" <?php selected($react['options']['im_display_type_audiocontrols'], 'slide-out'); ?>><?php esc_html_e('Slide Down', 'react'); ?></option>
																	</select>
																</td>
																<td class="react-form-table-desc-td">
																	<p class="react-description"><?php esc_html_e('How would you like the content displayed for this item in the Info Menu? If you choose Pop Out, you can swap to (the more practical) Slide Down option for smaller screens using the convert option above.', 'react'); ?></p>
																</td>
															</tr>
														</table>
													</div>
													<div class="react-table-tab">
														<table class="react-form-table react-tab-5-form-table">
															<tr class="react-settings-sub-head">
																<th colspan="2">
																	<label for="im_display_text_audiocontrols"><?php esc_html_e('Text', 'react'); ?></label>
																</th>
															</tr>
															<tr class="react-content-row">
																<td class="react-form-table-input-area-td">
																	<input type="text" name="im_display_text_audiocontrols" id="im_display_text_audiocontrols" value="<?php echo esc_attr($react['options']['im_display_text_audiocontrols']); ?>" />
																</td>
																<td class="react-form-table-desc-td">
																	<p class="react-description"><?php esc_html_e('Give this section a title. This will show on hovering over the icon.', 'react'); ?></p>
																</td>
															</tr>
														</table>
													</div>
													<div class="react-table-tab">
														<table class="react-form-table react-tab-5-form-table">
															<tr class="react-settings-sub-head">
																<th colspan="2">
																	<label><?php esc_html_e('Icon', 'react'); ?></label>
																	<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Use the icon selector to choose an icon', 'react'); ?></span></span>
																</th>
															</tr>
															<tr class="react-content-row">
																<td class="react-form-table-input-area-td">
																	<?php echo react_icon_selector_field($react['options']['im_display_icon_audiocontrols'], 'im_display_icon_audiocontrols'); ?>
																</td>
																<td class="react-form-table-desc-td">
																	<p class="react-description"><?php esc_html_e('Choose a relevant icon to be displayed for this item in the Info Menu.', 'react'); ?></p>
																</td>
															</tr>
														</table>
													</div>
												</div>
											</div>
										</div><!-- Show / hide wrap -->
									</div><!-- Accordion end -->
								</div>

								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Video controls', 'react'); ?></div>
									<div class="react-accordion-content">
										<div id="controls_location_video_off"><p class="react-warning"><?php esc_html_e('Please enable video controls for the Info Menu. Backgrounds &rarr; Video &rarr; Video controls location.', 'react'); ?></p></div>
										<!-- Video controls panel -->
										<div id="controls_location_video_on">
											<table class="react-form-table react-tab-1-form-table">
												<tr class="react-settings-sub-head">
													<th colspan="2">
														<label for="im_videocontrols_on"><?php esc_html_e('Video background controls', 'react'); ?></label>
													</th>
												</tr>
												<tr class="react-content-row">
													<td class="react-form-table-input-area-td">
														<input type="checkbox" class="react-toggle" name="im_videocontrols_on" id="im_videocontrols_on" <?php checked(true, $react['options']['im_videocontrols_on']); ?> value="1" />
													</td>
													<td class="react-form-table-desc-td">
														<p class="react-description"><?php esc_html_e('This lets the user control the background video. You can set up a background video in Backgrounds &rarr; Video.', 'react'); ?></p>
													</td>
												</tr>
											</table>
											<div id="im_videocontrols_on_hide">
												<div class="react-table-tabs-wrap">
													<ul class="react-table-tabs-nav">
														<li><span><?php esc_html_e('Box type', 'react'); ?></span></li>
														<li><span><?php esc_html_e('Title', 'react'); ?></span></li>
														<li><span><?php esc_html_e('Icon', 'react'); ?></span></li>
													</ul>
												</div>
												<div class="react-table-tabs">
													<div class="react-table-tab">
														<table class="react-form-table react-tab-5-form-table">
															<tr class="react-settings-sub-head">
																<th colspan="2">
																	<label for="im_display_type_videocontrols"><?php esc_html_e('Box type', 'react'); ?></label>
																	<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a method for displaying the content', 'react'); ?></span></span>
																</th>
															</tr>
															<tr class="react-content-row">
																<td class="react-form-table-input-area-td">
																	<select id="im_display_type_videocontrols" name="im_display_type_videocontrols">
																		<option value="drop-down" <?php selected($react['options']['im_display_type_videocontrols'], 'drop-down'); ?>><?php esc_html_e('Pop out', 'react'); ?></option>
																		<option value="slide-out" <?php selected($react['options']['im_display_type_videocontrols'], 'slide-out'); ?>><?php esc_html_e('Slide down', 'react'); ?></option>
																	</select>
																</td>
																<td class="react-form-table-desc-td">
																	<p class="react-description"><?php esc_html_e('How would you like the content displayed for this item in the Info Menu? If you choose pop out, you can swap to (the more practical) Slide Down option for smaller screens using the convert option above.', 'react'); ?></p>
																</td>
															</tr>
														</table>
													</div>
													<div class="react-table-tab">
														<table class="react-form-table react-tab-5-form-table">
															<tr class="react-settings-sub-head">
																<th colspan="2">
																	<label for="im_display_text_videocontrols"><?php esc_html_e('Text', 'react'); ?></label>
																</th>
															</tr>
															<tr class="react-content-row">
																<td class="react-form-table-input-area-td">
																	<input type="text" name="im_display_text_videocontrols" id="im_display_text_videocontrols" value="<?php echo esc_attr($react['options']['im_display_text_videocontrols']); ?>" />
																</td>
																<td class="react-form-table-desc-td">
																	<p class="react-description"><?php esc_html_e('Give this section a title. This will show on hovering over the icon.', 'react'); ?></p>
																</td>
															</tr>
														</table>
													</div>
													<div class="react-table-tab">
														<table class="react-form-table react-tab-5-form-table">
															<tr class="react-settings-sub-head">
																<th colspan="2">
																	<label><?php esc_html_e('Icon', 'react'); ?></label>
																	<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Use the icon selector to choose an icon', 'react'); ?></span></span>
																</th>
															</tr>
															<tr class="react-content-row">
																<td class="react-form-table-input-area-td">
																	<?php echo react_icon_selector_field($react['options']['im_display_icon_videocontrols'], 'im_display_icon_videocontrols'); ?>
																</td>
																<td class="react-form-table-desc-td">
																	<p class="react-description"><?php esc_html_e('Choose a relevant icon to be displayed for this item in the Info Menu.', 'react'); ?></p>
																</td>
															</tr>
														</table>
													</div>
												</div>
											</div>
										</div><!-- Show / hide wrap -->
									</div><!-- Accordion end -->
								</div>

								<div class="react-accordion react-toggle">
									<div class="react-accordion-trigger react-panel-section-header"><?php esc_html_e('Cart (WooCommerce)', 'react'); ?></div>
									<div class="react-accordion-content">
										<!-- Contact panel -->
										<table class="react-form-table react-tab-1-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="im_woocart_on"><?php esc_html_e('Cart (WooCommerce)', 'react'); ?></label>
													<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Show the WooCommerce cart', 'react'); ?></span></span>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<input type="checkbox" class="react-toggle" name="im_woocart_on" id="im_woocart_on" <?php checked(true, $react['options']['im_woocart_on']); ?> value="1" />
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Displays the WooCommerce cart inside the Info Menu content area.', 'react'); ?></p>
												</td>
											</tr>
										</table>
										<div id="im_woocart_on_hide">
											<div class="react-table-tabs-wrap">
												<ul class="react-table-tabs-nav">
													<li><span><?php esc_html_e('Box type', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Title', 'react'); ?></span></li>
													<li><span><?php esc_html_e('Icon', 'react'); ?></span></li>
												</ul>
											</div>
											<div class="react-table-tabs">
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label><?php esc_html_e('Box type', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a method for displaying the content', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<div class="react-multi-input-wrap">
																	<select id="im_display_type_woocart" name="im_display_type_woocart">
																		<option value="drop-down" <?php selected($react['options']['im_display_type_woocart'], 'drop-down'); ?>><?php esc_html_e('Pop Out', 'react'); ?></option>
																		<option value="slide-out" <?php selected($react['options']['im_display_type_woocart'], 'slide-out'); ?>><?php esc_html_e('Slide Down', 'react'); ?></option>
																	</select>
																</div>
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('How would you like the content displayed for this item in the Info Menu? If you choose Pop Out, you can swap to (the more practical) Slide Down option for smaller screens using the convert option above.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label for="im_display_text_woocart"><?php esc_html_e('Text', 'react'); ?></label>
														   </th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<input type="text" name="im_display_text_woocart" id="im_display_text_woocart" value="<?php echo esc_attr($react['options']['im_display_text_woocart']); ?>" />
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('Give this section a title. This will show on hovering over the icon.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
												<div class="react-table-tab">
													<table class="react-form-table react-tab-5-form-table">
														<tr class="react-settings-sub-head">
															<th colspan="2">
																<label><?php esc_html_e('Icon', 'react'); ?></label>
																<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Use the icon selector to choose an icon', 'react'); ?></span></span>
															</th>
														</tr>
														<tr class="react-content-row">
															<td class="react-form-table-input-area-td">
																<?php echo react_icon_selector_field($react['options']['im_display_icon_woocart'], 'im_display_icon_woocart'); ?>
															</td>
															<td class="react-form-table-desc-td">
																<p class="react-description"><?php esc_html_e('Choose a relevant icon to be displayed for this item in the Info Menu.', 'react'); ?></p>
															</td>
														</tr>
													</table>
												</div>
											</div>
										 </div>
									</div><!-- Accordion end -->
								</div>

								<div class="react-break"></div>

								<!-- Custom area -->
								<h2 class="react-panel-section-header"><?php esc_html_e('Custom widget areas', 'react'); ?></h2>

								<div class="react-clearfix react-add-cwa-wrap">
									<div id="react-im-add-widget-area" class="react-button react-orange react-add"><span></span><?php esc_html_e('Add widget area', 'react'); ?></div>
									<div class="react-add-cwa-description"><?php esc_html_e('Add a custom widget area to be shown in the Info Menu. Once created you can add widgets in WordPress &rarr; Appearance &rarr; Widgets', 'react'); ?></div>
								</div>



								<div id="react-im-custom-widget-areas">
									<?php
										foreach ($react['options']['im_custom_widget_areas'] as $widget) {
											echo react_im_custom_widget_area_html($widget);
										}
									?>
								</div>
							</div><!-- .react-sub-tab -->
							<div class="react-sub-tab">
								<!-- Slider -->
								<h2 class="react-panel-section-header"><?php esc_html_e('Slider settings', 'react'); ?></h2>

								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="component_slider_homepage"><?php esc_html_e('Home page slider', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose which slider to show on the home page', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="component_slider_homepage" id="component_slider_homepage" <?php checked(true, $react['options']['component_slider_homepage']); ?>>
												<option value=""><?php esc_html_e('No slider', 'react'); ?></option>
												<option value="revslider" <?php selected($react['options']['component_slider_homepage'], 'revslider'); ?>><?php esc_html_e('Slider Revolution', 'react'); ?></option>
												<option value="layerslider" <?php selected($react['options']['component_slider_homepage'], 'layerslider'); ?>><?php esc_html_e('LayerSlider', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Install the LayerSlider or Slider Revolution plugin to use this option.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table id="component_slider_id-wrap" class="react-form-table react-tab-6-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="component_slider_id"><?php esc_html_e('Home page slider ID (or alias)', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="component_slider_id" id="component_slider_id" value="<?php echo esc_attr($react['options']['component_slider_id']); ?>" class="react-width-300" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Enter the ID of the slider you want to display (consult the slider documentation to find this). For Slider Revolution, you can enter the slider alias.', 'react'); ?></p>
										</td>
									</tr>
								</table>


								<table id="component_slider_convert_id-wrap" class="react-form-table react-tab-6-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="component_slider_convert_id"><?php esc_html_e('Choose when to convert or hide slider', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
										<div class="react-multi-input-wrap">
											<label for="component_slider_convert_point" class="react-mini-label"><?php esc_html_e('Convert to another slider', 'react'); ?></label>
											<select name="component_slider_convert_point" id="component_slider_convert_point">
												<option value="phone-ptr" <?php selected($react['options']['component_slider_convert_point'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
												<option value="phone-ldsp" <?php selected($react['options']['component_slider_convert_point'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
												<option value="tablet-ptr" <?php selected($react['options']['component_slider_convert_point'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
												<option value="tablet-ldsp" <?php selected($react['options']['component_slider_convert_point'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
												<option value="box-width" <?php selected($react['options']['component_slider_convert_point'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
												<option value="never" <?php selected($react['options']['component_slider_convert_point'], 'never'); ?>><?php esc_html_e('Never', 'react'); ?></option>
												<option value="custom" <?php selected($react['options']['component_slider_convert_point'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
											</select>
										</div>
										<div class="react-multi-input-wrap" id="component_slider_convert_point_custom_hide">
											<input type="text" name="component_slider_convert_point_custom" id="component_slider_convert_point_custom" value="<?php echo esc_attr($react['options']['component_slider_convert_point_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
										</div>
										<div class="react-multi-input-wrap">
											<label for="component_slider_convert_id" class="react-mini-label"><?php esc_html_e('Enter a new slider ID (or alias) for smaller screens', 'react'); ?></label>
											<input type="text" name="component_slider_convert_id" id="component_slider_convert_id" placeholder="<?php esc_html_e('Leave blank to hide', 'react'); ?>" value="<?php echo esc_attr($react['options']['component_slider_convert_id']); ?>" class="react-width-300" />
										</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Swap the homepage slider to another slider or hide it at a break point of your choice. If you choose to swap to a new slider it must be using the same plugin. Note: Two sliders will be loaded on the page, please keep this in mind as it may slow the page down.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="component_slider_stretched"><?php esc_html_e('Slider full width', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('This is referring to the main slider area', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle" name="component_slider_stretched" id="component_slider_stretched" <?php checked(true, $react['options']['component_slider_stretched']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose whether to force the slider area to full width of the page. If turned off, it will inherit other page layout settings.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-1-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="component_slider_position"><?php esc_html_e('Slider location', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Select a position for the slider', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="component_slider_position" id="component_slider_position">
												<option value="abovehead" <?php selected($react['options']['component_slider_position'], 'abovehead'); ?>><?php esc_html_e('Above Main Header', 'react'); ?></option>
												<option value="belowhead" <?php selected($react['options']['component_slider_position'], 'belowhead'); ?>><?php esc_html_e('Below Main Header', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose where to show your slider on the page.', 'react'); ?></p>
										</td>
									</tr>
								</table>

							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<!-- WooCommerce -->
								<h2 class="react-panel-section-header"><?php esc_html_e('WooCommerce', 'react'); ?></h2>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="shop_layout"><?php esc_html_e('Shop layout', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a layout', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="shop_layout" id="shop_layout" class="react-layout-selector">
												<option value="left-sidebar" <?php selected($react['options']['shop_layout'], 'left-sidebar'); ?>><?php esc_html_e('Left sidebar', 'react'); ?></option>
												<option value="full-width" <?php selected($react['options']['shop_layout'], 'full-width'); ?>><?php esc_html_e('Full width', 'react'); ?></option>
												<option value="right-sidebar" <?php selected($react['options']['shop_layout'], 'right-sidebar'); ?>><?php esc_html_e('Right sidebar', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the layout for the main Shop page.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="shop_single_layout"><?php esc_html_e('Product layout', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Choose a layout', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="shop_single_layout" id="shop_single_layout" class="react-layout-selector">
												<option value="left-sidebar" <?php selected($react['options']['shop_single_layout'], 'left-sidebar'); ?>><?php esc_html_e('Left sidebar', 'react'); ?></option>
												<option value="full-width" <?php selected($react['options']['shop_single_layout'], 'full-width'); ?>><?php esc_html_e('Full width', 'react'); ?></option>
												<option value="right-sidebar" <?php selected($react['options']['shop_single_layout'], 'right-sidebar'); ?>><?php esc_html_e('Right sidebar', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the layout for single Product pages.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="woocommerce_boxed_style"><?php esc_html_e('Product list boxed', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											 <input type="checkbox" class="react-toggle bc-toggle-yn" name="woocommerce_boxed_style" id="woocommerce_boxed_style" <?php checked(true, $react['options']['woocommerce_boxed_style']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show a box around products in lists.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="woocommerce_product_columns"><?php esc_html_e('Number of products per row', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="woocommerce_product_columns" id="woocommerce_product_columns">
												<option value="2" <?php selected($react['options']['woocommerce_product_columns'], 2); ?>><?php esc_html_e('Two', 'react'); ?></option>
												<option value="3" <?php selected($react['options']['woocommerce_product_columns'], 3); ?>><?php esc_html_e('Three', 'react'); ?></option>
												<option value="" <?php selected($react['options']['woocommerce_product_columns'], ''); ?>><?php esc_html_e('Four (Default)', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the number of columns to use for the products list', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="woocommerce_show_share"><?php esc_html_e('Show social Share links', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle bc-toggle-yn" name="woocommerce_show_share" id="woocommerce_show_share" <?php checked(true, $react['options']['woocommerce_show_share']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Show Google+, Twitter, Facebook and Pinterest share buttons at the bottom of the page.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-3-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="woocommerce_related_products"><?php esc_html_e('Number of related products', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="woocommerce_related_products" id="woocommerce_related_products" value="<?php echo esc_attr($react['options']['woocommerce_related_products']); ?>" class="react-width-50" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Enter the number of related products you want to show on the product page. Leave blank for the default (2) or set to 0 to disable.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="woocommerce_related_product_columns"><?php esc_html_e('Number of related products per row', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select name="woocommerce_related_product_columns" id="woocommerce_related_product_columns">
												<option value="" <?php selected($react['options']['woocommerce_related_product_columns'], ''); ?>><?php esc_html_e('Two (Default)', 'react'); ?></option>
												<option value="3" <?php selected($react['options']['woocommerce_related_product_columns'], 3); ?>><?php esc_html_e('Three', 'react'); ?></option>
												<option value="4" <?php selected($react['options']['woocommerce_related_product_columns'], 4); ?>><?php esc_html_e('Four', 'react'); ?></option>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the number of columns to use for the related products list', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="woocommerce_convert"><?php esc_html_e('When to convert WooCommerce', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<select name="woocommerce_convert" id="woocommerce_convert">
													<option value="phone-ptr" <?php selected($react['options']['woocommerce_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
													<option value="phone-ldsp" <?php selected($react['options']['woocommerce_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
													<option value="tablet-ptr" <?php selected($react['options']['woocommerce_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
													<option value="tablet-ldsp" <?php selected($react['options']['woocommerce_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
													<option value="box-width" <?php selected($react['options']['woocommerce_convert'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
													<option value="custom" <?php selected($react['options']['woocommerce_convert'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap" id="woocommerce_convert_custom_hide">
												<input type="text" name="woocommerce_convert_custom" id="woocommerce_convert_custom" value="<?php echo esc_attr($react['options']['woocommerce_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Make sure all WooCommerce elements are changed to a more optimum layout', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="woocommerce_onsale_animation"><?php esc_html_e('On Sale animation', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<?php echo react_render_animation_select('woocommerce_onsale_animation', $react['options']['woocommerce_onsale_animation']); ?>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose an animation for the On Sale badge.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div>

							<div class="react-sub-tab">
								<!-- Quform -->
								<h2 class="react-panel-section-header"><?php esc_html_e('Quform', 'react'); ?></h2>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="quform_convert"><?php esc_html_e('When to convert forms', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<select name="quform_convert" id="quform_convert">
													<option value="phone-ptr" <?php selected($react['options']['quform_convert'], 'phone-ptr'); ?>><?php esc_html_e('Phone Portrait', 'react'); ?></option>
													<option value="phone-ldsp" <?php selected($react['options']['quform_convert'], 'phone-ldsp'); ?>><?php esc_html_e('Phone Landscape', 'react'); ?></option>
													<option value="tablet-ptr" <?php selected($react['options']['quform_convert'], 'tablet-ptr'); ?>><?php esc_html_e('Tablet Portrait', 'react'); ?></option>
													<option value="tablet-ldsp" <?php selected($react['options']['quform_convert'], 'tablet-ldsp'); ?>><?php esc_html_e('Tablet Landscape', 'react'); ?></option>
													<option value="box-width" <?php selected($react['options']['quform_convert'], 'box-width'); ?>><?php esc_html_e('Site box width (if set)', 'react'); ?></option>
													<option value="never" <?php selected($react['options']['quform_convert'], 'never'); ?>><?php esc_html_e('Never', 'react'); ?></option>
													<option value="custom" <?php selected($react['options']['quform_convert'], 'custom'); ?>><?php esc_html_e('Custom', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap" id="quform_convert_custom_hide">
												<input type="text" name="quform_convert_custom" id="quform_convert_custom" value="<?php echo esc_attr($react['options']['quform_convert_custom']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="5000" data-step="1" data-dimension="px" /><span class="react-range-unit">px</span>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose when Quform forms will convert to a more optimal layout for smaller screens.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<!-- Tooltips -->
								<h2 class="react-panel-section-header"><?php esc_html_e('Tooltips', 'react'); ?></h2>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Where to use tooltips?', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('A tooltip is a line of text shown when hovering over an element', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="show_tooltips_social" class="react-mini-label"><?php esc_html_e('Social icons', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_tooltips_social" id="show_tooltips_social" <?php checked(true, $react['options']['show_tooltips_social']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_tooltips_all" class="react-mini-label"><?php esc_html_e('All links with title', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_tooltips_all" id="show_tooltips_all" <?php checked(true, $react['options']['show_tooltips_all']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_tooltips_footer" class="react-mini-label"><?php esc_html_e('Inside Footer', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_tooltips_footer" id="show_tooltips_footer" <?php checked(true, $react['options']['show_tooltips_footer']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_tooltips_popdown" class="react-mini-label"><?php esc_html_e('Inside Pop Down', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_tooltips_popdown" id="show_tooltips_popdown" <?php checked(true, $react['options']['show_tooltips_popdown']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_tooltips_images" class="react-mini-label"><?php esc_html_e('Images with title', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_tooltips_images" id="show_tooltips_images" <?php checked(true, $react['options']['show_tooltips_images']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="show_tooltips_nav" class="react-mini-label"><?php esc_html_e('Navigation menu items', 'react'); ?></label>
												<input type="checkbox" class="react-toggle" name="show_tooltips_nav" id="show_tooltips_nav" <?php checked(true, $react['options']['show_tooltips_nav']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The theme allows tooltips to be added on many elements&#59; choose where to switch the tooltips on or off.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<!-- Pace Progress -->
								<h2 class="react-panel-section-header"><?php esc_html_e('Page loader', 'react'); ?></h2>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="page_loader"><?php esc_html_e('Page loader', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="page_loader" class="react-mini-label"><?php esc_html_e('Page loader type', 'react'); ?></label>
												<select name="page_loader" id="page_loader">
													<option value="" <?php selected($react['options']['page_loader'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
													<option value="pace" <?php selected($react['options']['page_loader'], 'pace'); ?>><?php esc_html_e('Progress bar', 'react'); ?></option>
													<option value="full" <?php selected($react['options']['page_loader'], 'full'); ?>><?php esc_html_e('Full screen', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="page_loader_style" class="react-mini-label"><?php esc_html_e('Spinner style', 'react'); ?></label>
												<select name="page_loader_style" id="page_loader_style">
													<option value="" <?php selected($react['options']['page_loader_style'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
													<option value="spinner" <?php selected($react['options']['page_loader_style'], 'spinner'); ?>><?php esc_html_e('Spinner', 'react'); ?></option>
													<option value="spinning-balls" <?php selected($react['options']['page_loader_style'], 'spinning-balls'); ?>><?php esc_html_e('Rotating balls', 'react'); ?></option>
													<?php foreach (react_get_spinkit_options() as $key => $value) : ?>
														<option value="<?php echo esc_attr($key); ?>" <?php selected($react['options']['page_loader_style'], $key); ?>><?php echo esc_html($value); ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The Progress bar shows the progress of page loading on the page. The Full screen loader will completely hide the site until page is fully loaded.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<!-- Fancy Box -->
								<h2 class="react-panel-section-header"><?php esc_html_e('Fancybox', 'react'); ?></h2>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Fancybox overlay', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row react-content-input-has-many">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="fancybox_overlay" class="react-mini-label"><?php esc_html_e('Light or dark', 'react'); ?></label>
												<select name="fancybox_overlay" id="fancybox_overlay">
													<option value="light" <?php selected($react['options']['fancybox_overlay'], 'light'); ?>><?php esc_html_e('Light', 'react'); ?></option>
													<option value="dark" <?php selected($react['options']['fancybox_overlay'], 'dark'); ?>><?php esc_html_e('Dark', 'react'); ?></option>
												</select>
											</div>
											<div class="react-multi-input-wrap">
												<label for="fancybox_overlay_opacity" class="react-mini-label"><?php esc_html_e('Level of opacity', 'react'); ?></label>
												<input type="text" name="fancybox_overlay_opacity" id="fancybox_overlay_opacity" value="<?php echo esc_attr($react['options']['fancybox_overlay_opacity']); ?>" class="react-range-slider react-width-50" data-from="0" data-to="90" data-step="10" data-dimension="%" /><span class="react-range-unit">%</span>
											</div>
											<div class="react-multi-input-wrap">
												<label for="fancybox_overlay_color" class="react-mini-label"><?php esc_html_e('Or choose a color', 'react'); ?></label>
												<input type="text" name="fancybox_overlay_color" id="fancybox_overlay_color" value="<?php echo esc_attr($react['options']['fancybox_overlay_color']); ?>" class="react-colorpicker" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Fancybox is a light box style pop-up used for portfolio images, Quform pop-ups and light box shortcode.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-5-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Fancybox color palette', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<select id="fancybox_choose_scheme" name="fancybox_choose_scheme" class="react-custom-palette-selector">
												<option value="" <?php selected($react['options']['fancybox_choose_scheme'], ''); ?>><?php esc_html_e('None', 'react'); ?></option>
												<?php echo react_render_custom_palette_options($react['options']['fancybox_choose_scheme']); ?>
											</select>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose a color palette to apply to the Fancybox content.', 'react'); ?></p>
										</td>
									</tr>
								</table>

								<!-- Price Table -->


							</div><!-- .react-sub-tab -->


						</div><!-- .react-sub-tabs -->
					</div><!-- .react-tab-5 -->


					<!-- Contact us -->


					<div class="react-tab-6">
						<div class="react-sub-tabs-wrap">
							<ul class="react-sub-tabs-nav">
								<li><span><?php esc_html_e('General', 'react'); ?><span class="react-icon react-general"></span></span></li>
								<li><span><?php esc_html_e('Forms', 'react'); ?><span class="react-icon react-quform"></span></span></li>
							</ul>
						</div>

						<div class="react-sub-tabs">
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Contact settings', 'react'); ?></h2>
								<table class="react-form-table react-tab-6-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="contact_phone_number"><?php esc_html_e('Phone', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="contact_phone_number" id="contact_phone_number" value="<?php echo esc_attr($react['options']['contact_phone_number']); ?>" class="react-width-300" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The business phone number.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-6-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="contact_fax_number"><?php esc_html_e('Fax', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="contact_fax_number" id="contact_fax_number" value="<?php echo esc_attr($react['options']['contact_fax_number']); ?>" class="react-width-300" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The business fax number.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-6-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="contact_email"><?php esc_html_e('Email', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="text" name="contact_email" id="contact_email" value="<?php echo esc_attr($react['options']['contact_email']); ?>" class="react-width-300" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The business email address.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-6-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="contact_address"><?php esc_html_e('Address', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<textarea name="contact_address" id="contact_address"><?php echo esc_textarea($react['options']['contact_address']); ?></textarea>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The business postal address.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-6-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="contact_map"><?php esc_html_e('Map HTML', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Add a map image or link. Make sure the size is correct', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<textarea name="contact_map" id="contact_map"><?php echo esc_textarea($react['options']['contact_map']); ?></textarea>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The HTML for the map, e.g. Google maps embed code.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-6-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('"Contact Page" template form', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<?php echo react_render_quform_form_select('contact_quform_id', $react['options']['contact_quform_id']); ?>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Choose the Quform form to use on the "Contact Page" page template.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->
							<div class="react-sub-tab">

								<h2 class="react-panel-section-header"><?php esc_html_e('Form settings', 'react'); ?></h2>
								<?php if (function_exists('iphorm')) : ?>
									<div class="react-manage-forms"><?php esc_html_e('The theme forms are controlled by the Quform plugin&#59; you can add or edit forms using the buttons below.', 'react'); ?></div>
									<div class="react-manage-forms-buttons react-clearfix">
										<a href="<?php echo esc_url(admin_url('admin.php?page=iphorm_forms')); ?>" class="react-button react-blue react-external-link"><?php esc_html_e('View forms', 'react'); ?></a>
										<a href="<?php echo esc_url(admin_url('admin.php?page=iphorm_form_builder')); ?>" class="react-button react-blue react-external-link"><?php esc_html_e('Create a new form', 'react'); ?></a>
									</div>
								<?php else : ?>
									<p class="react-warning"><?php esc_html_e('The theme forms are controlled by Quform, please install and activate this plugin.', 'react'); ?></p>
								<?php endif; ?>
							</div><!-- .react-sub-tab -->
						</div><!-- .react-sub-tabs -->
					</div><!-- .react-tab-6 -->


					<!-- Advanced -->


					<div class="react-tab-7">
						<div class="react-sub-tabs-wrap">
							<ul class="react-sub-tabs-nav">
								<li><span><?php esc_html_e('Custom CSS', 'react'); ?><span class="react-icon react-edit"></span></span></li>
								<li><span><?php esc_html_e('Import', 'react'); ?><span class="react-icon react-import"></span></span></li>
								<li><span><?php esc_html_e('Export', 'react'); ?><span class="react-icon react-export"></span></span></li>
								<li><span><?php esc_html_e('Breakpoints', 'react'); ?><span class="react-icon react-breakpoint"></span></span></li>
								<li><span><?php esc_html_e('Performance', 'react'); ?><span class="react-icon react-general"></span></span></li>
								<li><span><?php esc_html_e('Reset', 'react'); ?><span class="react-icon react-reset"></span></span></li>
							</ul>
						</div>

						<div class="react-sub-tabs">
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Custom CSS', 'react'); ?></h2>

								<div class="react-table-tabs-wrap">
									<ul class="react-table-tabs-nav">
										<li><span><?php esc_html_e('All', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Phone', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Tablet', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Desktop', 'react'); ?></span></li>
										<li><span><?php esc_html_e('Large screens', 'react'); ?></span></li>
									</ul>
								</div>

								<div class="react-table-tabs">

									<div class="react-table-tab">
										<table class="react-form-table react-tab-7-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="advanced_custom_css"><?php esc_html_e('CSS', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<textarea class="react-big-textarea" name="advanced_custom_css" id="advanced_custom_css"><?php echo esc_textarea($react['options']['advanced_custom_css']); ?></textarea>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Enter any custom CSS to apply to your website.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-7-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="advanced_custom_css_phone"><?php esc_html_e('CSS', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<textarea class="react-big-textarea" name="advanced_custom_css_phone" id="advanced_custom_css_phone"><?php echo esc_textarea($react['options']['advanced_custom_css_phone']); ?></textarea>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Enter any custom CSS to apply to phone devices.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-7-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="advanced_custom_css_tablet"><?php esc_html_e('CSS', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<textarea class="react-big-textarea" name="advanced_custom_css_tablet" id="advanced_custom_css_tablet"><?php echo esc_textarea($react['options']['advanced_custom_css_tablet']); ?></textarea>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Enter any custom CSS to apply to tablet devices.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-7-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="advanced_custom_css_desktop"><?php esc_html_e('CSS', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<textarea class="react-big-textarea" name="advanced_custom_css_desktop" id="advanced_custom_css_desktop"><?php echo esc_textarea($react['options']['advanced_custom_css_desktop']); ?></textarea>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Enter any custom CSS to apply to desktops and laptops.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
									<div class="react-table-tab">
										<table class="react-form-table react-tab-7-form-table">
											<tr class="react-settings-sub-head">
												<th colspan="2">
													<label for="advanced_custom_css_large"><?php esc_html_e('CSS', 'react'); ?></label>
												</th>
											</tr>
											<tr class="react-content-row">
												<td class="react-form-table-input-area-td">
													<textarea class="react-big-textarea" name="advanced_custom_css_large" id="advanced_custom_css_large"><?php echo esc_textarea($react['options']['advanced_custom_css_large']); ?></textarea>
												</td>
												<td class="react-form-table-desc-td">
													<p class="react-description"><?php esc_html_e('Enter any custom CSS to apply to large desktop screens.', 'react'); ?></p>
												</td>
											</tr>
										</table>
									</div>
								</div>

							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Import', 'react'); ?></h2>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="advanced_import"><?php esc_html_e('Import options', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Paste exported options in the field', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<textarea class="react-big-textarea" id="advanced_import"></textarea>
											<div id="react-import-status"></div>
											<div class="react-clearfix"><a id="react-start-import" class="react-button react-blue"><?php esc_html_e('Import', 'react'); ?></a></div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('To Import your theme options, paste exported data into the box and click Import.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Export', 'react'); ?></h2>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="advanced_export"><?php esc_html_e('Export options', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Useful for backing up your settings or if you are moving site', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-clearfix"><a id="react-start-export" class="react-button react-blue"><?php esc_html_e('Export', 'react'); ?></a><span class="react-export-loading"></span></div>
											<div id="react-export-textarea-wrap" class="react-hidden">
												<textarea class="react-big-textarea" id="advanced_export"></textarea>
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('You can backup or transfer your theme options by exporting&#59; click Export to get started. Highlight the text in the box and do a copy/paste into a blank .txt file to save your options.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Responsive Breakpoints', 'react'); ?></h2>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="break_point_phone_ptr"><?php esc_html_e('Phone Portrait', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enter a new breakpoint value for this device size', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<span class="react-text-b4-input"><?php esc_html_e('Max width', 'react'); ?></span><input type="text" name="break_point_phone_ptr" id="break_point_phone_ptr" value="<?php echo esc_attr($react['options']['break_point_phone_ptr']); ?>" class="react-width-50" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Mobile devices in portrait orientation.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="break_point_phone_ldsp"><?php esc_html_e('Phone Landscape', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enter a new breakpoint value for this device size', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<span class="react-text-b4-input"><?php esc_html_e('Max width', 'react'); ?></span><input type="text" name="break_point_phone_ldsp" id="break_point_phone_ldsp" value="<?php echo esc_attr($react['options']['break_point_phone_ldsp']); ?>" class="react-width-50" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Mobile devices in landscape orientation.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="break_point_tablet_ptr"><?php esc_html_e('Tablet Portrait', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enter a new breakpoint value for this device size', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<span class="react-text-b4-input"><?php esc_html_e('Max width', 'react'); ?></span><input type="text" name="break_point_tablet_ptr" id="break_point_tablet_ptr" value="<?php echo esc_attr($react['options']['break_point_tablet_ptr']); ?>" class="react-width-50" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Tablets in portrait orientation.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="break_point_tablet_ldsp"><?php esc_html_e('Tablet Landscape', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enter a new breakpoint value for this device size', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<span class="react-text-b4-input"><?php esc_html_e('Max width', 'react'); ?></span><input type="text" name="break_point_tablet_ldsp" id="break_point_tablet_ldsp" value="<?php echo esc_attr($react['options']['break_point_tablet_ldsp']); ?>" class="react-width-50" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Tablets in landscape orientation.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="break_point_desktop"><?php esc_html_e('Desktops / Laptops', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enter a new breakpoint value for this device size', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<span class="react-text-b4-input"><?php esc_html_e('Min width', 'react'); ?></span><input type="text" name="break_point_desktop" id="break_point_desktop" value="<?php echo esc_attr($react['options']['break_point_desktop']); ?>" class="react-width-50" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('The majority of desktop and laptop monitor resolutions.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="break_point_tv"><?php esc_html_e('Large screens', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Enter a new breakpoint value for this device size', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<span class="react-text-b4-input"><?php esc_html_e('Min width', 'react'); ?></span><input type="text" name="break_point_tv" id="break_point_tv" value="<?php echo esc_attr($react['options']['break_point_tv']); ?>" class="react-width-50" /><span class="react-range-unit">px</span>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('High resolution screens, e.g. the iMac 27" and some modern TVs.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Performance', 'react'); ?></h2>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="advanced_minify_custom_css"><?php esc_html_e('Minify the custom CSS files', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Improves page loading speed', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="advanced_minify_custom_css" id="advanced_minify_custom_css" <?php checked(true, $react['options']['advanced_minify_custom_css']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('When saving the options a couple of custom CSS files are generated. Enabling this option will minify the CSS in these files. Unless you are having problems it is best to have this enabled.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="advanced_combine_css"><?php esc_html_e('Combine CSS', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Improves page loading speed', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="advanced_combine_css" id="advanced_combine_css" <?php checked(true, $react['options']['advanced_combine_css']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Combine the theme CSS files into a single file to speed up page loads. WARNING: Internet Explorer 9 and below has a limit of 4095 rules in a single CSS file, so this option may cause the styling problems in those browsers.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="advanced_minify_css"><?php esc_html_e('Minify CSS', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Improves page loading speed', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="advanced_minify_css" id="advanced_minify_css" <?php checked(true, $react['options']['advanced_minify_css']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Minifies all theme CSS to make the file size smaller.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="advanced_combine_js"><?php esc_html_e('Combine JavaScript', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Improves page loading speed', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="advanced_combine_js" id="advanced_combine_js" <?php checked(true, $react['options']['advanced_combine_js']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Combine the theme JavaScript files into a single file to speed up page loads.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label for="advanced_minify_js"><?php esc_html_e('Minify JavaScript', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Improves page loading speed', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<input type="checkbox" class="react-toggle-yn" name="advanced_minify_js" id="advanced_minify_js" <?php checked(true, $react['options']['advanced_minify_js']); ?> value="1" />
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Minifies all theme JavaScript to make the file size smaller.', 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Disable CSS output', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Helps solve conflicts with plugins', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<table class="react-plain-subtable react-disable-scripts">
												<?php
													foreach (react_get_styles() as $key => $style) : ?>
														<tr>
															<td style="width: 50%;"><?php echo esc_html($style['name']); ?><?php if (isset($style['tooltip'])) : ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php echo esc_html($style['tooltip']); ?></span></span><?php endif; ?></td>
															<td style="width: 50%;"><input type="checkbox" class="react-toggle-ed advanced_disable_css" <?php checked(true, !in_array($key, $react['options']['advanced_disable_css'])) ?> value="<?php echo esc_attr($key); ?>" /></td>
														</tr>
													<?php endforeach;
												?>
												<tr>
													<td style="width: 50%;">Animate.css<span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('An animation library that can be used by many different theme features', 'react'); ?></span></span></td>
													<td style="width: 50%;"><input type="checkbox" class="react-toggle-ed advanced_disable_css" <?php checked(true, !in_array('animate', $react['options']['advanced_disable_css'])) ?> value="animate" /></td>
												</tr>
												<tr>
													<td style="width: 50%;">Hover.css<span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('An animation library that can be used by many different theme features', 'react'); ?></span></span></td>
													<td style="width: 50%;"><input type="checkbox" class="react-toggle-ed advanced_disable_css" <?php checked(true, !in_array('hover', $react['options']['advanced_disable_css'])) ?> value="hover" /></td>
												</tr>
												<tr>
													<td style="width: 50%;">Magic.css<span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php esc_html_e('An animation library that can be used by many different theme features', 'react'); ?></span></span></td>
													<td style="width: 50%;"><input type="checkbox" class="react-toggle-ed advanced_disable_css" <?php checked(true, !in_array('magic', $react['options']['advanced_disable_css'])) ?> value="magic" /></td>
												</tr>
											</table>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e("You can stop a stylesheet from being loaded onto your site here. This is helpful if one of the styles is conflicting with one of your plugins, or you want to disable a stylesheet you know you don't need for performance reasons. WARNING: Use with care! Any functionality relying on these styles may break.", 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Disable JavaScript output', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Helps solve conflicts with plugins', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<table class="react-plain-subtable react-disable-scripts">
											<?php
												foreach (react_get_scripts() as $key => $script) :
													if (!(isset($script['core']) && $script['core'] === true)) : ?>
													<tr>
														<td style="width: 50%;"><?php echo esc_html($script['name']); ?><?php if (isset($script['tooltip'])) : ?><span class="react-tip-icon">[?]<span class="react-tooltip-text"><?php echo esc_html($script['tooltip']); ?></span></span><?php endif; ?></td>
														<td style="width: 50%;"><input type="checkbox" class="react-toggle-ed advanced_disable_js" <?php checked(true, !in_array($key, $react['options']['advanced_disable_js'])) ?> value="<?php echo esc_attr($key); ?>" /></td>
													</tr>
												<?php endif;
												endforeach; ?>
											</table>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e("You can stop a JavaScript file from being loaded onto your site here. This is helpful if one of the scripts is conflicting with one of your plugins, or you want to disable a script you know you don't need for performance reasons. WARNING: Use with care! Any functionality relying on these scripts may break.", 'react'); ?></p>
										</td>
									</tr>
								</table>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Disable animations', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Improves site performance and usability on devices', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<div class="react-multi-input-wrap">
												<label for="advanced_enable_animations_tablet" class="react-mini-label"><?php esc_html_e('Tablets', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-ed" name="advanced_enable_animations_tablet" id="advanced_enable_animations_tablet" <?php checked(true, $react['options']['advanced_enable_animations_tablet']); ?> value="1" />
											</div>
											<div class="react-multi-input-wrap">
												<label for="advanced_enable_animations_phone" class="react-mini-label"><?php esc_html_e('Phones', 'react'); ?></label>
												<input type="checkbox" class="react-toggle-ed" name="advanced_enable_animations_phone" id="advanced_enable_animations_phone" <?php checked(true, $react['options']['advanced_enable_animations_phone']); ?> value="1" />
											</div>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('On some older devices the animations can cause performance issues, so they are disabled on devices by default.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->

							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Reset all options', 'react'); ?></h2>
								<p class="react-warning"><?php esc_html_e('WARNING: This cannot be undone! Make a backup first if you are not sure, by going to Advanced &rarr; Export.', 'react'); ?></p>
								<table class="react-form-table react-tab-7-form-table">
									<tr class="react-settings-sub-head">
										<th colspan="2">
											<label><?php esc_html_e('Reset all options', 'react'); ?></label>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td">
											<a id="react-reset-options" class="react-reset-options react-button react-light"><span><?php esc_html_e('RESET ALL OPTIONS', 'react'); ?></span></a>
										</td>
										<td class="react-form-table-desc-td">
											<p class="react-description"><?php esc_html_e('Click this button to reset all options to defaults.', 'react'); ?></p>
										</td>
									</tr>
								</table>
							</div><!-- .react-sub-tab -->

						</div><!-- .react-sub-tabs -->
					</div><!-- .react-tab-7 -->


					<!-- Translate -->


					<div class="react-tab-8">
						<div class="react-sub-tabs-wrap">
							<ul class="react-sub-tabs-nav">
								<li><span><?php esc_html_e('Translations', 'react'); ?><span class="react-icon react-translate"></span></span></li>
							</ul>
						</div>

						<div class="react-sub-tabs">
							<div class="react-sub-tab">
								<h2 class="react-panel-section-header"><?php esc_html_e('Translations', 'react'); ?></h2>
								<table class="react-form-table react-tab-8-form-table">
									<tr class="react-settings-sub-head">
										<th>
											<label><?php esc_html_e('Add translations', 'react'); ?></label>
											<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Use the fields (left) to translate the text (right)', 'react'); ?></span></span>
										</th>
									</tr>
									<tr class="react-content-row">
										<td class="react-form-table-input-area-td react-translation-table-area-td">
											<table class="react-translations-table">
												<tr>
													<th class="react-translations-translation-th">
														<label><?php esc_html_e('Translation', 'react'); ?></label>
														<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Add new translation', 'react'); ?></span></span>
													</th>
													<th class="react-translations-default-th">
														<label><?php esc_html_e('Default', 'react'); ?></label>
														<span class="react-tip-icon"><span class="react-tooltip-text"><?php esc_html_e('Original text', 'react'); ?></span></span>
													</th>
												</tr>
												<?php
													foreach (react_get_default_translations() as $key => $translation) : ?>
													<tr>
														<td class="react-translations-translation-td">
															<input type="text" class="react-width-300" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($react['options'][$key]); ?>" />
														</td>
														<td class="react-translations-default-td">
															<?php echo esc_html($translation); ?>
														</td>
													</tr>
												<?php endforeach; ?>
												<tr >
													<td class="react-translations-reset-td" colspan="2"><a id="react-reset-translations" class="react-button react-light"><span><?php esc_html_e('Reset all translations', 'react'); ?></span></a></td>
												</tr>
											</table>
										</td>

									</tr>
								</table>
							</div><!-- .react-sub-tab -->
						</div><!-- .react-sub-tabs -->
					</div><!-- .react-tab-8 -->

				</div><!-- #react-tabs -->

				<div class="react-buttons react-clearfix">
					<a class="react-save react-button react-blue react-save-save"><span><?php esc_html_e('Save', 'react'); ?></span></a>
				</div>
			</div><!-- .react-panel-right -->
			<div id="react-options-saved"><span><span class="react-save-icon"></span><?php esc_html_e('Options saved', 'react'); ?></span></div>
			<div id="react-icon-selector-container" class="react-clearfix">
				<?php echo react_render_icon_selector(); ?>
			</div>
			<div id="react-website-preview-overlay" class="react-lightbox-overlay">
				<div id="react-website-preview" class="react-lightbox"></div>
			</div>
			<div class="react-case-study-overlay">
				<div class="react-case-study-fixed">
					<div class="react-case-study-hide-on-success">
						<div class="react-case-study-fixed-header"><?php printf(esc_html__('Ready to import %s', 'react'), '<span class="react-case-study-confirm-name"></span>'); ?></div>
						<p class="react-description"><?php esc_html_e('Case Studies should only be imported on fresh WordPress installs. Importing a Case Study on a site with existing content may have unexpected consequences.', 'react'); ?></p>
						<p class="react-description"><?php esc_html_e('Confirm that you want the content from the demo added to your site. This may take a few minutes and cannot be undone!', 'react'); ?></p>
						<div id="react-case-study-variation-wrap"><label class="react-bold" for="react-case-study-variation"><?php esc_html_e('Select a variation', 'react'); ?></label><select id="react-case-study-variation"></select></div>
						<div class="react-case-study-confirm-buttons react-clearfix">
							<a id="react-case-study-confirm-cancel" class="react-button react-light"><?php esc_html_e('Cancel', 'react'); ?></a>
							<a id="react-case-study-confirm-start" class="react-button react-blue"><?php esc_html_e('I confirm, start the import!', 'react'); ?></a>
							<span id="react-case-study-installing"></span>
						</div>
					</div>
					<div class="react-case-study-show-on-success react-hidden">
						<div class="react-case-study-fixed-header"><?php esc_html_e('Import complete', 'react'); ?></div>
						<div class="react-case-study-fixed-subheader"><?php esc_html_e('What next?', 'react'); ?></div>
						<div class="react-cs-what-next react-clearfix"><a href="<?php echo esc_url(home_url()); ?>" class="react-cs-visit-website react-button react-blue"><?php esc_html_e('Visit Website', 'react'); ?></a><div><?php esc_html_e('See how your website looks', 'react'); ?></div></div>
						<div class="react-cs-what-next react-clearfix"><a href="<?php echo esc_url(admin_url('themes.php?page=react')); ?>" class="react-button react-blue"><?php esc_html_e('Edit Theme Options', 'react'); ?></a><div><?php esc_html_e('Change the theme options', 'react'); ?></div></div>
						<div class="react-cs-what-next react-clearfix"><a href="<?php echo esc_url(admin_url('options-permalink.php')); ?>" class="react-button react-blue"><?php esc_html_e('Permalink Settings', 'react'); ?></a><div><?php esc_html_e('Configure pretty permalinks', 'react'); ?></div></div>
						<div class="react-cs-what-next react-clearfix"><a href="<?php echo esc_url(admin_url('options-general.php')); ?>" class="react-button react-blue"><?php esc_html_e('General Settings', 'react'); ?></a><div><?php esc_html_e('Configure the site Tagline, Timezone and Language', 'react'); ?></div></div>
					</div>
					<div id="react-case-study-install-log"></div>
				</div>
			</div>
			<div class="react-fixed react-fixed-buttons react-clearfix">
				<a class="react-save react-button react-blue react-save-save"><span></span></a>
			</div>
		</div><!-- .react-wrap -->
		<div class="react-panel-loading"></div>
	</form>
	<script>
	//<![CDATA[
		jQuery(document).ready(function ($) {
			reactOptions.init(<?php echo wp_json_encode($react['options']); ?>);
		});
	//]]>
	</script>
</div>