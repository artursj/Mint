<?php
// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>
<div class="wrap">
	<h2><?php esc_html_e('Portfolio Settings', 'react-portfolio'); ?></h2>
	<noscript><p class="tcap-no-script"><span><?php esc_html_e('Please enable JavaScript to use the settings page.', 'react-portfolio'); ?></span></p></noscript>
	<div id="tcap-settings-saved" class="tcap-settings-saved"><span><span class="tcap-save-icon"></span><?php esc_html_e('Settings saved', 'react-portfolio'); ?></span></div>

	<div class="tcap-settings">

		<form id="tcap-settings-form">

			<div class="tcap-settings-heading"><?php esc_html_e('General settings', 'react-portfolio'); ?></div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_rewrite_slug"><?php esc_html_e('Rewrite slug', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="text" id="tcap_rewrite_slug" name="tcap_rewrite_slug" value="<?php echo esc_attr(tcp_get_option('rewrite_slug')); ?>">
					<p class="tcap-description"><?php printf(esc_html__("The slug is the highlighted part of this example URL: %s.", 'react-portfolio'), 'http://www.example.com/<span style="color:#0F83CA;">portfolio</span>/my-portfolio-item'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_category_rewrite_slug"><?php esc_html_e('Category rewrite slug', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="text" id="tcap_category_rewrite_slug" name="tcap_category_rewrite_slug" value="<?php echo esc_attr(tcp_get_option('category_rewrite_slug')); ?>">
					<p class="tcap-description"><?php printf(esc_html__("The slug is the highlighted part of this example URL: %s.", 'react-portfolio'), 'http://www.example.com/<span style="color:#0F83CA;">portfolio-category</span>/my-portfolio-category'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_tag_rewrite_slug"><?php esc_html_e('Tag rewrite slug', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="text" id="tcap_tag_rewrite_slug" name="tcap_tag_rewrite_slug" value="<?php echo esc_attr(tcp_get_option('tag_rewrite_slug')); ?>">
					<p class="tcap-description"><?php printf(esc_html__("The slug is the highlighted part of this example URL: %s.", 'react-portfolio'), 'http://www.example.com/<span style="color:#0F83CA;">portfolio-tag</span>/my-portfolio-tag'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_search"><?php esc_html_e('Show in search results', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="checkbox" class="tcap-option-toggle-yn" id="tcap_search" name="tcap_search" <?php checked(tcp_get_option('search'), true); ?> value="1">
					<p class="tcap-description"><?php esc_html_e('Allow visitors to find portfolio items by searching.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_comments"><?php esc_html_e('Allow comments', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="checkbox" class="tcap-option-toggle-yn" id="tcap_comments" name="tcap_comments" <?php checked(tcp_get_option('comments'), true); ?> value="1">
					<p class="tcap-description"><?php esc_html_e('Allow visitors to comment on portfolio items.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-settings-buttons tcap-clearfix">
				<div class="tcap-settings-save tcap-button tcap-blue"><?php esc_html_e('Save all settings', 'react-portfolio'); ?></div>
			</div>

			<div class="tcap-settings-heading"><?php esc_html_e('Fancybox settings', 'react-portfolio'); ?></div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_video_width"><?php esc_html_e('Video width', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="text" id="tcap_video_width" name="tcap_video_width" value="<?php echo esc_attr(tcp_get_option('video_width')); ?>" class="tcap-range-slider tcap-width-50" data-from="100" data-to="1000" data-dimension="px" /><span class="tcap-range-unit">px</span>
					<p class="tcap-description"><?php esc_html_e('The width of the video lightbox for Video portfolio items.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_video_height"><?php esc_html_e('Video height', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="text" id="tcap_video_height" name="tcap_video_height" value="<?php echo esc_attr(tcp_get_option('video_height')); ?>" class="tcap-range-slider tcap-width-50" data-from="100" data-to="1000" data-dimension="px" /><span class="tcap-range-unit">px</span>
					<p class="tcap-description"><?php esc_html_e('The height of the video lightbox for Video portfolio items.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-settings-buttons tcap-clearfix">
				<div class="tcap-settings-save tcap-button tcap-blue"><?php esc_html_e('Save all settings', 'react-portfolio'); ?></div>
			</div>

			<div class="tcap-settings-heading"><?php esc_html_e('Serene (full screen gallery) settings', 'react-portfolio'); ?></div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_speed"><?php esc_html_e('Transition speed', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="text" id="tcap_speed" name="tcap_speed" value="<?php echo esc_attr(tcp_get_option('speed')); ?>" class="tcap-range-slider tcap-width-50" data-from="500" data-to="5000" data-step="100" data-dimension="ms" /><span class="tcap-range-unit">ms</span>
					<p class="tcap-description"><?php esc_html_e('Speed of the transition between images, in milliseconds (1000 = 1 second).', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_transition"><?php esc_html_e('Transition animation', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<select id="tcap_transition" name="tcap_transition">
						<option value="none" <?php selected(tcp_get_option('transition'), 'none'); ?>><?php esc_html_e('None', 'react-portfolio'); ?></option>
						<option value="fade" <?php selected(tcp_get_option('transition'), 'fade'); ?>><?php esc_html_e('Fade', 'react-portfolio'); ?></option>
						<option value="fadeOutFadeIn" <?php selected(tcp_get_option('transition'), 'fadeOutFadeIn'); ?>><?php esc_html_e('Fade Out / Fade In', 'react-portfolio'); ?></option>
						<option value="slideDown" <?php selected(tcp_get_option('transition'), 'slideDown'); ?>><?php esc_html_e('Slide Down', 'react-portfolio'); ?></option>
						<option value="slideRight" <?php selected(tcp_get_option('transition'), 'slideRight'); ?>><?php esc_html_e('Slide Right', 'react-portfolio'); ?></option>
						<option value="slideUp" <?php selected(tcp_get_option('transition'), 'slideUp'); ?>><?php esc_html_e('Slide Up', 'react-portfolio'); ?></option>
						<option value="slideLeft" <?php selected(tcp_get_option('transition'), 'slideLeft'); ?>><?php esc_html_e('Slide Left', 'react-portfolio'); ?></option>
						<option value="carouselRight" <?php selected(tcp_get_option('transition'), 'carouselRight'); ?>><?php esc_html_e('Carousel Right', 'react-portfolio'); ?></option>
						<option value="carouselLeft" <?php selected(tcp_get_option('transition'), 'carouselLeft'); ?>><?php esc_html_e('Carousel Left', 'react-portfolio'); ?></option>
					</select>
					<p class="tcap-description"><?php esc_html_e('Choose the type of animation between images.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_fit_landscape"><?php esc_html_e('Fit landscape', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="checkbox" class="tcap-option-toggle-yn" id="tcap_fit_landscape" name="tcap_fit_landscape" <?php checked(tcp_get_option('fit_landscape'), true); ?> value="1">
					<p class="tcap-description"><?php esc_html_e('Prevent landscape images from being cropped by locking them at 100% width.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_fit_portrait"><?php esc_html_e('Fit portrait', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="checkbox" class="tcap-option-toggle-yn" id="tcap_fit_portrait" name="tcap_fit_portrait" <?php checked(tcp_get_option('fit_portrait'), true); ?> value="1">
					<p class="tcap-description"><?php esc_html_e('Prevent portrait images from being cropped by locking them at 100% height.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_fit_always"><?php esc_html_e('Fit always', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="checkbox" class="tcap-option-toggle-yn" id="tcap_fit_always" name="tcap_fit_always" <?php checked(tcp_get_option('fit_always'), true); ?> value="1">
					<p class="tcap-description"><?php esc_html_e('Prevent images from ever being cropped.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_position_x"><?php esc_html_e('Horizontal position', 'react-portfolio'); ?></label>
					<span class="tcap-tip-icon"><span class="tcap-tooltip-text"><?php esc_html_e('Useful when showing a focal point of the images', 'react-portfolio'); ?></span></span>
				</div>
				<div class="tcap-setting-inner">
					<select id="tcap_position_x" name="tcap_position_x">
						<option value="left" <?php selected(tcp_get_option('position_x'), 'left'); ?>><?php esc_html_e('Left', 'react-portfolio'); ?></option>
						<option value="center" <?php selected(tcp_get_option('position_x'), 'center'); ?>><?php esc_html_e('Center', 'react-portfolio'); ?></option>
						<option value="right" <?php selected(tcp_get_option('position_x'), 'right'); ?>><?php esc_html_e('Right', 'react-portfolio'); ?></option>
					</select>
					<p class="tcap-description"><?php esc_html_e('How the image is aligned horizontally in the browser if it is not a perfect fit.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_position_y"><?php esc_html_e('Vertical position', 'react-portfolio'); ?></label>
					<span class="tcap-tip-icon"><span class="tcap-tooltip-text"><?php esc_html_e('Useful when showing a focal point of the images', 'react-portfolio'); ?></span></span>
				</div>
				<div class="tcap-setting-inner">
					<select id="tcap_position_y" name="tcap_position_y">
						<option value="top" <?php selected(tcp_get_option('position_y'), 'top'); ?>><?php esc_html_e('Top', 'react-portfolio'); ?></option>
						<option value="center" <?php selected(tcp_get_option('position_y'), 'center'); ?>><?php esc_html_e('Center', 'react-portfolio'); ?></option>
						<option value="bottom" <?php selected(tcp_get_option('position_y'), 'bottom'); ?>><?php esc_html_e('Bottom', 'react-portfolio'); ?></option>
					</select>
					<p class="tcap-description"><?php esc_html_e('How the image is aligned horizontally in the browser if it is not a perfect fit.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_easing"><?php esc_html_e('Transition easing', 'react-portfolio'); ?></label>
					<span class="tcap-tip-icon"><span class="tcap-tooltip-text"><?php esc_html_e('Enhances the animation', 'react-portfolio'); ?></span></span>
				</div>
				<div class="tcap-setting-inner">
					<select id="tcap_easing" name="tcap_easing">
						<option value="swing" <?php selected(tcp_get_option('easing'), 'swing'); ?>>swing</option>
						<option value="easeInQuad" <?php selected(tcp_get_option('easing'), 'easeInQuad'); ?>>easeInQuad</option>
						<option value="easeOutQuad" <?php selected(tcp_get_option('easing'), 'easeOutQuad'); ?>>easeOutQuad</option>
						<option value="easeInOutQuad" <?php selected(tcp_get_option('easing'), 'easeInOutQuad'); ?>>easeInOutQuad</option>
						<option value="easeInCubic" <?php selected(tcp_get_option('easing'), 'easeInCubic'); ?>>easeInCubic</option>
						<option value="easeOutCubic" <?php selected(tcp_get_option('easing'), 'easeOutCubic'); ?>>easeOutCubic</option>
						<option value="easeInOutCubic" <?php selected(tcp_get_option('easing'), 'easeInOutCubic'); ?>>easeInOutCubic</option>
						<option value="easeInQuart" <?php selected(tcp_get_option('easing'), 'easeInQuart'); ?>>easeInQuart</option>
						<option value="easeOutQuart" <?php selected(tcp_get_option('easing'), 'easeOutQuart'); ?>>easeOutQuart</option>
						<option value="easeInOutQuart" <?php selected(tcp_get_option('easing'), 'easeInOutQuart'); ?>>easeInOutQuart</option>
						<option value="easeInQuint" <?php selected(tcp_get_option('easing'), 'easeInQuint'); ?>>easeInQuint</option>
						<option value="easeOutQuint" <?php selected(tcp_get_option('easing'), 'easeOutQuint'); ?>>easeOutQuint</option>
						<option value="easeInOutQuint" <?php selected(tcp_get_option('easing'), 'easeInOutQuint'); ?>>easeInOutQuint</option>
						<option value="easeInSine" <?php selected(tcp_get_option('easing'), 'easeInSine'); ?>>easeInSine</option>
						<option value="easeOutSine" <?php selected(tcp_get_option('easing'), 'easeOutSine'); ?>>easeOutSine</option>
						<option value="easeInOutSine" <?php selected(tcp_get_option('easing'), 'easeInOutSine'); ?>>easeInOutSine</option>
						<option value="easeInExpo" <?php selected(tcp_get_option('easing'), 'easeInExpo'); ?>>easeInExpo</option>
						<option value="easeOutExpo" <?php selected(tcp_get_option('easing'), 'easeOutExpo'); ?>>easeOutExpo</option>
						<option value="easeInOutExpo" <?php selected(tcp_get_option('easing'), 'easeInOutExpo'); ?>>easeInOutExpo</option>
						<option value="easeInCirc" <?php selected(tcp_get_option('easing'), 'easeInCirc'); ?>>easeInCirc</option>
						<option value="easeOutCirc" <?php selected(tcp_get_option('easing'), 'easeOutCirc'); ?>>easeOutCirc</option>
						<option value="easeInOutCirc" <?php selected(tcp_get_option('easing'), 'easeInOutCirc'); ?>>easeInOutCirc</option>
						<option value="easeInElastic" <?php selected(tcp_get_option('easing'), 'easeInElastic'); ?>>easeInElastic</option>
						<option value="easeOutElastic" <?php selected(tcp_get_option('easing'), 'easeOutElastic'); ?>>easeOutElastic</option>
						<option value="easeInOutElastic" <?php selected(tcp_get_option('easing'), 'easeInOutElastic'); ?>>easeInOutElastic</option>
						<option value="easeInBack" <?php selected(tcp_get_option('easing'), 'easeInBack'); ?>>easeInBack</option>
						<option value="easeOutBack" <?php selected(tcp_get_option('easing'), 'easeOutBack'); ?>>easeOutBack</option>
						<option value="easeInOutBack" <?php selected(tcp_get_option('easing'), 'easeInOutBack'); ?>>easeInOutBack</option>
						<option value="easeInBounce" <?php selected(tcp_get_option('easing'), 'easeInBounce'); ?>>easeInBounce</option>
						<option value="easeOutBounce" <?php selected(tcp_get_option('easing'), 'easeOutBounce'); ?>>easeOutBounce</option>
						<option value="easeInOutBounce" <?php selected(tcp_get_option('easing'), 'easeInOutBounce'); ?>>easeInOutBounce</option>
					</select>
					<p class="tcap-description"><?php esc_html_e('The easing function to use for the transition.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_control_speed"><?php esc_html_e('Control fade speed', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="text" id="tcap_control_speed" name="tcap_control_speed" value="<?php echo esc_attr(tcp_get_option('control_speed')); ?>" class="tcap-range-slider tcap-width-50" data-from="0" data-to="5000" data-step="100" data-dimension="ms" /><span class="tcap-range-unit">ms</span>
					<p class="tcap-description"><?php esc_html_e('The speed that the controls fade at when going to full screen mode, in milliseconds (1000 = 1 second).', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_slideshow"><?php esc_html_e('Slideshow', 'react-portfolio'); ?></label>
					<span class="tcap-tip-icon"><span class="tcap-tooltip-text"><?php esc_html_e('Auto rotation of the image', 'react-portfolio'); ?></span></span>
				</div>
				<div class="tcap-setting-inner">
					<input type="checkbox" class="tcap-option-toggle-yn" id="tcap_slideshow" name="tcap_slideshow" <?php checked(tcp_get_option('slideshow'), true); ?> value="1">
					<p class="tcap-description"><?php esc_html_e('When active, the images will be rotated through in a slideshow.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_slideshow_auto"><?php esc_html_e('Start slideshow automatically', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="checkbox" class="tcap-option-toggle-yn" id="tcap_slideshow_auto" name="tcap_slideshow_auto" <?php checked(tcp_get_option('slideshow_auto'), true); ?> value="1">
					<p class="tcap-description"><?php esc_html_e('When active, the slideshow will start automatically.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_slideshow_speed"><?php esc_html_e('Slideshow pause time', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="text" id="tcap_slideshow_speed" name="tcap_slideshow_speed" value="<?php echo esc_attr(tcp_get_option('slideshow_speed')); ?>" class="tcap-range-slider tcap-width-50" data-from="100" data-to="30000" data-step="100" data-dimension="ms" /><span class="tcap-range-unit">ms</span>
					<p class="tcap-description"><?php esc_html_e('The time that each image in the slideshow is shown for, in milliseconds (1000 = 1 second).', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_keyboard"><?php esc_html_e('Keyboard controls', 'react-portfolio'); ?></label>
					<span class="tcap-tip-icon"><span class="tcap-tooltip-text"><?php esc_html_e('User can control with the keyboard', 'react-portfolio'); ?></span></span>
				</div>
				<div class="tcap-setting-inner">
					<input type="checkbox" class="tcap-option-toggle-yn" id="tcap_keyboard" name="tcap_keyboard" <?php checked(tcp_get_option('keyboard'), true); ?> value="1">
					<p class="tcap-description"><?php esc_html_e('When active, the Right and Left arrow keys can be used to move through the images and the Esc key will close the gallery.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_caption_position"><?php esc_html_e('Caption position', 'react-portfolio'); ?></label>
					<span class="tcap-tip-icon"><span class="tcap-tooltip-text"><?php esc_html_e('Where to display the image caption', 'react-portfolio'); ?></span></span>
				</div>
				<div class="tcap-setting-inner">
					<select id="tcap_caption_position" name="tcap_caption_position">
						<option value="random" <?php selected(tcp_get_option('caption_position'), 'random'); ?>><?php esc_html_e('Random', 'react-portfolio'); ?></option>
						<option value="left top" <?php selected(tcp_get_option('caption_position'), 'left top'); ?>><?php esc_html_e('left top', 'react-portfolio'); ?></option>
						<option value="left center" <?php selected(tcp_get_option('caption_position'), 'left center'); ?>><?php esc_html_e('left center', 'react-portfolio'); ?></option>
						<option value="left bottom" <?php selected(tcp_get_option('caption_position'), 'left bottom'); ?>><?php esc_html_e('left bottom', 'react-portfolio'); ?></option>
						<option value="center top" <?php selected(tcp_get_option('caption_position'), 'center top'); ?>><?php esc_html_e('center top', 'react-portfolio'); ?></option>
						<option value="center center" <?php selected(tcp_get_option('caption_position'), 'center center'); ?>><?php esc_html_e('center center', 'react-portfolio'); ?></option>
						<option value="center bottom" <?php selected(tcp_get_option('caption_position'), 'center bottom'); ?>><?php esc_html_e('center bottom', 'react-portfolio'); ?></option>
						<option value="right top" <?php selected(tcp_get_option('caption_position'), 'right top'); ?>><?php esc_html_e('right top', 'react-portfolio'); ?></option>
						<option value="right center" <?php selected(tcp_get_option('caption_position'), 'right center'); ?>><?php esc_html_e('right center', 'react-portfolio'); ?></option>
						<option value="right bottom" <?php selected(tcp_get_option('caption_position'), 'right bottom'); ?>><?php esc_html_e('right bottom', 'react-portfolio'); ?></option>
					</select>
					<p class="tcap-description"><?php esc_html_e('The default caption position.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_caption_speed"><?php esc_html_e('Caption fade speed', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<input type="text" id="tcap_caption_speed" name="tcap_caption_speed" value="<?php echo esc_attr(tcp_get_option('caption_speed')); ?>" class="tcap-range-slider tcap-width-50" data-from="100" data-to="5000" data-step="100" data-dimension="ms" /><span class="tcap-range-unit">ms</span>
					<p class="tcap-description"><?php esc_html_e('The speed of the caption fade animation, in milliseconds (1000 = 1 second).', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_bullets"><?php esc_html_e('Bullet navigation', 'react-portfolio'); ?></label>
					<span class="tcap-tip-icon"><span class="tcap-tooltip-text"><?php esc_html_e('A navigation method to switch to any image on full screen mode', 'react-portfolio'); ?></span></span>
				</div>
				<div class="tcap-setting-inner">
					<input type="checkbox" class="tcap-option-toggle-yn" id="tcap_bullets" name="tcap_bullets" <?php checked(tcp_get_option('bullets')); ?> value="1">
					<p class="tcap-description"><?php esc_html_e('When active, you can change images using bullet navigation.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_low_quality"><?php esc_html_e('Low quality transitions', 'react-portfolio'); ?></label>
					<span class="tcap-tip-icon"><span class="tcap-tooltip-text"><?php esc_html_e('A performance enhancer, if required', 'react-portfolio'); ?></span></span>
				</div>
				<div class="tcap-setting-inner">
					<input type="checkbox" class="tcap-option-toggle-yn" id="tcap_low_quality" name="tcap_low_quality" <?php checked(tcp_get_option('low_quality')); ?> value="1">
					<p class="tcap-description"><?php esc_html_e('When active, the transitions will be lower quality which improves performance.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-settings-buttons tcap-clearfix">
				<div class="tcap-settings-save tcap-button tcap-blue"><?php esc_html_e('Save all settings', 'react-portfolio'); ?></div>
			</div>

			<div class="tcap-settings-heading"><?php esc_html_e('Performance settings', 'react-portfolio'); ?></div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label for="tcap_load_scripts"><?php esc_html_e('When to load scripts and styles', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<select id="tcap_load_scripts" name="tcap_load_scripts">
						<option value="always" <?php selected(tcp_get_option('load_scripts'), 'always'); ?>><?php esc_html_e('Always', 'react-portfolio'); ?></option>
						<option value="autodetect" <?php selected(tcp_get_option('load_scripts'), 'autodetect'); ?>><?php esc_html_e('Autodetect', 'react-portfolio'); ?></option>
						<option value="custom" <?php selected(tcp_get_option('load_scripts'), 'custom'); ?>><?php esc_html_e('Only on specific pages', 'react-portfolio'); ?></option>
					</select>
					<p class="tcap-description"><?php esc_html_e('Choose which pages to load the plugin scripts and styles, these are required for the portfolio to work properly, so you can choose only the pages containing a portfolio to speed up the other pages on your site. Autodetect will only load the scripts and styles if a portfolio shortcode is found in the page content or you are using the portfolio widget.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix tcap-hidden">
				<div class="tcap-setting-label"><label for="tcap_load_scripts_custom"><?php esc_html_e('Choose pages', 'react-portfolio'); ?></label></div>
				<div class="tcap-setting-inner">
					<select id="tcap_load_scripts_custom" data-placeholder="<?php esc_attr_e('Choose pages', 'react-portfolio'); ?>" multiple>
						<?php foreach (get_pages() as $page) : ?>
							<option value="<?php echo esc_attr($page->ID); ?>" <?php selected(true, in_array($page->ID, tcp_get_option('load_scripts_custom'))); ?>><?php echo esc_html($page->post_title); ?></option>
						<?php endforeach; ?>
						<?php foreach (get_posts(array('numberposts' => -1)) as $post) : ?>
							<option value="<?php echo esc_attr($post->ID); ?>" <?php selected(true, in_array($post->ID, tcp_get_option('load_scripts_custom'))); ?>><?php echo esc_html($post->post_title); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="tcap-settings-buttons tcap-clearfix">
				<div class="tcap-settings-save tcap-button tcap-blue"><?php esc_html_e('Save all settings', 'react-portfolio'); ?></div>
			</div>

			<div class="tcap-settings-heading"><?php esc_html_e('Disable script output', 'react-portfolio'); ?></div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label><?php esc_html_e('CSS', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<?php foreach (tcp_get_styles() as $key => $style) : ?>
						<div class="tcap-script">
							<label><input type="checkbox" class="tcap-disabled-styles" <?php checked(true, in_array($key, tcp_get_option('disabled_styles'))); ?> value="<?php echo esc_attr($key); ?>"><span class="tcap-script-name"><?php echo esc_html($style['name']); ?></span><span class="tcap-script-version">v<?php echo esc_html($style['version']); ?></span><span class="tcap-tip-icon"><span class="tcap-tooltip-text"><?php echo esc_html($style['tooltip']); ?></span></span></label>
						</div>
					<?php endforeach; ?>
					<p class="tcap-description"><?php esc_html_e('You can disable the plugin CSS output using the boxes above.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-setting tcap-clearfix">
				<div class="tcap-setting-label">
					<label><?php esc_html_e('JavaScript', 'react-portfolio'); ?></label>
				</div>
				<div class="tcap-setting-inner">
					<?php foreach (tcp_get_scripts() as $key => $script) : ?>
						<div class="tcap-script">
							<label><input type="checkbox" class="tcap-disabled-scripts" <?php checked(true, in_array($key, tcp_get_option('disabled_scripts'))); ?> value="<?php echo esc_attr($key); ?>"><span class="tcap-script-name"><?php echo esc_html($script['name']); ?></span><span class="tcap-script-version">v<?php echo esc_html($script['version']); ?></span><span class="tcap-tip-icon"><span class="tcap-tooltip-text"><?php echo esc_html($script['tooltip']); ?></span></span></label>
						</div>
					<?php endforeach; ?>
					<p class="tcap-description"><?php esc_html_e('You can disable the plugin JS output using the boxes above.', 'react-portfolio'); ?></p>
				</div>
			</div>

			<div class="tcap-settings-buttons tcap-clearfix">
				<div class="tcap-settings-save tcap-button tcap-blue"><?php esc_html_e('Save all settings', 'react-portfolio'); ?></div>
				<div class="tcap-settings-reset tcap-button tcap-light"><span></span><?php esc_html_e('Reset settings', 'react-portfolio'); ?></div>
			</div>

		</form>

	</div>

</div>