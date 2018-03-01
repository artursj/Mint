/*
 * ThemeCatcher Shortcodes JavaScript
 *
 * Copyright www.themecatcher.net
 * All rights reserved.
 */
;(function ($) {
	"use strict";

	$(document).ready(function () {
		var $body = $('body'),
			$outer = $('<div id="tcas-shortcode-outer"/>').appendTo($body);

		var loadShortcodePopup = function () {
			var $overlay = $('<div class="tcas-shortcode-overlay"/>'),
			$wrap = $('<div class="tcas-shortcode-wrap"/>').appendTo($overlay),
			$loading = $('<div class="tcas-shortcode-loading"/>').appendTo($wrap),
			$content = $('<div class="tcas-shortcode-content"/>').appendTo($wrap),
			$buttonWrap = $('<div class="tcas-overlay-buttons"/>').appendTo($wrap),
			fieldWrap = '.tcas-shortcode-field-outer',
			innerFieldWrap = '.tcas-shortcode-inner-outer',
			closeShortcodePopup = function () {
				$(document).unbind('click.tcas-shortcode');
				$(window).unbind('resize.tcas-shortcode');
				$overlay.remove();
				$body.removeClass('tcas-popup-open');
			},
			insertShortcode = function () {
				var sc = ShortcodeGenerator.render();

				if (sc) {
					ShortcodeGenerator.sendToEditor(sc);
				}
			},
			insertCloseShortcode = function () {
				insertShortcode();
				closeShortcodePopup();
			};

			$body.addClass('tcas-popup-open');

			$('<div class="tcas-overlay-button tcas-overlay-button-close"/>').click(function () {
				closeShortcodePopup();
			}).appendTo($buttonWrap).attr('title', tcasL10n.close);

			$('<div class="tcas-overlay-button tcas-overlay-button-insert"/>').click(function () {
				insertShortcode();
			}).appendTo($buttonWrap).attr('title', tcasL10n.insert);

			$('<div class="tcas-overlay-button tcas-overlay-button-insert-close"/>').click(function () {
				insertCloseShortcode();
			}).appendTo($buttonWrap).attr('title', tcasL10n.insertClose);

			// Stop popup buttons scrolling the popup
			$buttonWrap.bind('mousedown', function () { return false; });

			var url = tcasL10n.shortcodeGeneratorUrl;

			if ($(this).data('widget')) {
				url += '&widget=' + $(this).data('widget');
			}

			$content.load(url, function () {
				$loading.remove();

				if ($.isFunction($.fn.toggleSwitch)) {
					$('input.tcas-option-toggle, select.tcas-option-tritoggle').toggleSwitch({
						prefix: 'tcas-toggleswitch',
						onText: tcasL10n.on,
						offText: tcasL10n.off,
						defaultText: tcasL10n._default
					});

					$('input.tcas-option-toggle-yn, select.tcas-option-tritoggle-yn').toggleSwitch({
						prefix: 'tcas-toggleswitch',
						defaultText: tcasL10n._default,
						onText: tcasL10n.yes,
						offText: tcasL10n.no
					});
				}

				$('#tcas-type-select').change(function (e) {
					var type = $(this).val();
					$('.tcas-options, #tcas-preview').hide();

					if (type) {
						$('#tcas-popular').hide();
						$('#tcas-preview, #tcas-options-' + type).show();
					} else {
						$('#tcas-popular').show();
					}

					$('#tcas-edit-wrap').hide();
				});

				$('#tcas-insert-shortcode').click(function (e) {
					insertShortcode();
				});

				$('#tcas-insert-close-shortcode').click(function (e) {
					insertCloseShortcode();
				});

				$('#tcas-close-shortcode').click(function (e) {
					closeShortcodePopup();
				});

				$('#tcas-edit-button').click(function (e) {
					e.preventDefault();

					$('#tcas-type-select').val('').change();
					$('#tcas-popular').hide();
					$('#tcas-edit-wrap').slideDown();
				});

				$('#tcas-edit-load-button').click(function (e) {
					e.preventDefault();
					var val = $('#tcas-edit-sc').val();

					if (val.length === 0) {
						alert('Please enter an existing shortcode to edit');
						return;
					}

					ShortcodeGenerator.loadExistingShortcodeSettings(val);
				});

				// Popular shortcode images
				$('.tcas-options-icon').click(function () {
					$('#tcas-type-select').val($(this).data('sc')).change();
				});

				// Layout variation select
				$('#tcas-select-layout').change(function (e) {
					var val = $(this).val(),
						show = val.split('-').length;

					// Hide previously shown content boxes
					$('.tcas-layout-content-wrap', '#tcas-options-row').hide();

					if (show > 0) {
						for (var i = 0; i < show; i++) {
							$('#tcas-layout-content-wrap-' + (i+1)).show();
						}
					}
				}).change();

				// Tabs
				$('#tcas-add-tab').click(function (e) {
					e.preventDefault();
					$('#tcas-sc-tabs-wrap').append(tcasL10n.tabPaneHtml);
				});

				// Toggles
				$('#tcas-add-toggle').click(function (e) {
					e.preventDefault();
					$('#tcas-sc-toggles-wrap').append(tcasL10n.accordionPaneHtml);
				});

				// Accordion
				$('#tcas-add-accordion').click(function (e) {
					e.preventDefault();
					$('#tcas-sc-accordions-wrap').append(tcasL10n.accordionPaneHtml);
				});

				var contentPaneHTML = '<div class="tcas-sc-pane">' +
					'<div class="tcas-sc-pane-remove" title="' + tcasL10n.removeSlide + '">X</div>' +
					'<div class="tcas-sc-pane-outer tcas-clearfix">' +
						'<div class="tcas-sc-pane-label">' +
							'<h4>' + tcasL10n.content + '</h4>' +
						'</div>' +
						'<div class="tcas-sc-pane-inner">' +
							'<textarea></textarea>' +
						'</div>' +
					'</div>' +
				'</div>';

				// Cycle
				$('#tcas-add-cycle').click(function (e) {
					e.preventDefault();
					$('#tcas-sc-cycle-slides-wrap').append(contentPaneHTML);
				});

				$outer.on('click', '.tcas-sc-pane-remove', function (e) {
					e.preventDefault();
					$(this).parent().remove();
				});

				$('#tcas-sc-cycle-autoplay').change(function () {
					if ($(this).is(':checked')) {
						$('#tcas-sc-cycle-autoplay_timeout, #tcas-sc-cycle-autoplay_hover_pause').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-cycle-autoplay_timeout, #tcas-sc-cycle-autoplay_hover_pause').closest(fieldWrap).slideUp();
					}
				}).change();

				$('#tcas-sc-cycle-controls').change(function () {
					if ($(this).is(':checked')) {
						$('#tcas-sc-cycle-controls_pos').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-cycle-controls_pos').closest(fieldWrap).slideUp();
					}
				}).change();

				// Preview
				$('.tcas-preview-outer').each(function () {
					var $previewOuter = $(this),
					$root = $previewOuter.parent(),
					$iframe = $previewOuter.find('.tcas-preview-content-frame'),
					refreshPreview = function () {
						var sc = ShortcodeGenerator.render();

						if (sc) {
							$previewOuter.show();
							$iframe.attr('src', tcasL10n.shortcodePreviewUrl + '&s=' + encodeURIComponent(sc));
						}
					};

					$('input[type="text"], textarea', $root).blur(refreshPreview);
					$('select', $root).change(refreshPreview);
					$('input[type="checkbox"]', $root).change(refreshPreview); // ToggleSwitch plugin triggers change event on checkboxes
					$('.tcas-icon-selector-hidden', $root).change(refreshPreview); // IconSelector triggers change event
					$('.tcas-preview-refresh', $previewOuter).click(refreshPreview);
				});

				// Prevent the form submitting
				$('#tcas-shortcode-form').submit(function (e) {
					e.preventDefault();
				});

				// Menu settings visibility
				$('#tcas-sc-menu-type').change(function () {
					if (!$(this).val()) {
						$('#tcas-sc-menu-enclosed_content').closest(fieldWrap).slideDown();
						$('#tcas-sc-menu-menu').closest(fieldWrap).slideUp();
					} else {
						$('#tcas-sc-menu-enclosed_content').closest(fieldWrap).slideUp();
						$('#tcas-sc-menu-menu').closest(fieldWrap).slideDown();
					}
				}).change();

				// Hide for grid style
				$('#tcas-sc-tabs-layout').change(function (e) {
					if ($(this).val() != 'vertical') {
						$('#tcas-sc-tabs-fill').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-tabs-fill').closest(fieldWrap).slideUp();
					}
				}).change();

				$('#tcas-sc-image_carousel-autoplay').change(function () {
					if ($(this).is(':checked')) {
						$('#tcas-sc-image_carousel-autoplay_timeout, #tcas-sc-image_carousel-autoplay_hover_pause').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-image_carousel-autoplay_timeout, #tcas-sc-image_carousel-autoplay_hover_pause').closest(fieldWrap).slideUp();
					}
				}).change();

				$('#tcas-sc-block-width').change(function () {
					if ($(this).val() == 'custom') {
						$('#tcas-sc-block-custom_width').closest(fieldWrap).slideDown();
						$('#tcas-sc-block-inside_max_width').closest(fieldWrap).slideUp();
					} else {
						$('#tcas-sc-block-custom_width').closest(fieldWrap).slideUp();
						$('#tcas-sc-block-inside_max_width').closest(fieldWrap).slideDown();
					}
				}).change();

				$('#tcas-sc-button-custom_margin').change(function () {
					if ($(this).is(':checked')) {
						$('#tcas-sc-button-margin_top').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-button-margin_top').closest(fieldWrap).slideUp();
					}
				}).change();

				$('#tcas-sc-image-custom_margin').change(function () {
					if ($(this).is(':checked')) {
						$('#tcas-sc-image-margin_top').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-image-margin_top').closest(fieldWrap).slideUp();
					}
				}).change();

				$('#tcas-sc-image-use_caption').change(function () {
					if ($(this).is(':checked')) {
						$('#tcas-sc-image-caption_title, #tcas-sc-image-caption_subtitle, #tcas-sc-image-icon, #tcas-sc-image-caption_overlay, #tcas-sc-image-caption_type').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-image-caption_title, #tcas-sc-image-caption_subtitle, #tcas-sc-image-icon, #tcas-sc-image-caption_overlay, #tcas-sc-image-caption_type').closest(fieldWrap).slideUp();
					}
				}).change();


				$('#tcas-sc-button-color').change(function () {
					if ($(this).val() == 'hollow-prime holw-btn' || $(this).val() == 'hollow-dark holw-btn' || $(this).val() == 'hollow-light holw-btn') {
						$('#tcas-sc-button-background_animation').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-button-background_animation').closest(fieldWrap).slideUp();
					}
				}).change();

				$('#tcas-sc-button-icon').change(function () {
					if ($(this).val() !== '') {
						$('#tcas-sc-button-icon_reveal').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-button-icon_reveal').closest(fieldWrap).slideUp();
					}
				}).change();


				$('#tcas-sc-icon-boxed').change(function () {
					if ($(this).is(':checked')) {
						$('#tcas-sc-icon-round').closest(fieldWrap).slideDown();
						$('#tcas-sc-icon-hollow').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-icon-round').closest(fieldWrap).slideUp();
						$('#tcas-sc-icon-hollow').closest(fieldWrap).slideUp();
					}
				}).change();

				$('#tcas-sc-icon-hollow').change(function () {
					if ($(this).is(':checked')) {
						$('#tcas-sc-icon-background_animation').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-icon-background_animation').closest(fieldWrap).slideUp();
					}
				}).change();

				$('#tcas-sc-fancy_header-letter_in_animation').change(function () {
					if ($(this).is(':checked')) {
						$('#tcas-sc-fancy_header-letter_animation').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-fancy_header-letter_animation').closest(fieldWrap).slideUp();
					}
				}).change();

				$('#tcas-sc-row-padding').change(function () {
					if ($(this).is(':checked')) {
						$('#tcas-sc-row-padding_top').closest(fieldWrap).slideDown();
						$('#tcas-sc-row-padding_bottom').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-row-padding_top').closest(fieldWrap).slideUp();
						$('#tcas-sc-row-padding_bottom').closest(fieldWrap).slideUp();
					}
				}).change();

				$('#tcas-sc-section_break-width').change(function () {
					if ($(this).val() !== '') {
						$('#tcas-sc-section_break-position').closest(fieldWrap).slideDown();
						$('#tcas-sc-section_break-stretched').closest(fieldWrap).slideUp();
					} else {
						$('#tcas-sc-section_break-position').closest(fieldWrap).slideUp();
						$('#tcas-sc-section_break-stretched').closest(fieldWrap).slideDown();
					}
				}).change();

				$('#tcas-sc-section_break-type').change(function () {
					if ($(this).val() == 'line') {
						$('#tcas-sc-section_break-type_css_size').closest(innerFieldWrap).slideDown();
						$('#tcas-sc-section_break-type_css_color').closest(innerFieldWrap).slideDown();
						$('#tcas-sc-section_break-type_css_style').closest(innerFieldWrap).slideDown();
						$('#tcas-sc-section_break-type_css_design').closest(innerFieldWrap).slideDown();
						$('#tcas-sc-section_break-type_image').closest(innerFieldWrap).slideUp();
					}
					else if ($(this).val() == 'graphics') {
						$('#tcas-sc-section_break-type_image').closest(innerFieldWrap).slideDown();
						$('#tcas-sc-section_break-type_css_size').closest(innerFieldWrap).slideUp();
						$('#tcas-sc-section_break-type_css_color').closest(innerFieldWrap).slideUp();
						$('#tcas-sc-section_break-type_css_style').closest(innerFieldWrap).slideUp();
						$('#tcas-sc-section_break-type_css_design').closest(innerFieldWrap).slideUp();
					} else {
						$('#tcas-sc-section_break-type_css_size').closest(innerFieldWrap).slideUp();
						$('#tcas-sc-section_break-type_css_color').closest(innerFieldWrap).slideUp();
						$('#tcas-sc-section_break-type_css_style').closest(innerFieldWrap).slideUp();
						$('#tcas-sc-section_break-type_css_design').closest(innerFieldWrap).slideUp();
						$('#tcas-sc-section_break-type_image').closest(innerFieldWrap).slideUp();
					}
				}).change();



				$('#tcas-sc-impact_header-type').change(function () {
					var val = $(this).val();

					switch (val) {
						default:
						case 'only-heading':
							$('#tcas-sc-impact_header-subheading').closest(fieldWrap).slideUp();
							$('#tcas-sc-impact_header-button_text').closest(fieldWrap).slideUp();
							$('#tcas-sc-impact_header-button_link').closest(fieldWrap).slideUp();
							$('#tcas-sc-impact_header-button_external').closest(fieldWrap).slideUp();
							$('#tcas-sc-impact_header-quform_id').closest(fieldWrap).slideUp();
							break;
						case 'heading-button':
							$('#tcas-sc-impact_header-subheading').closest(fieldWrap).slideUp();
							$('#tcas-sc-impact_header-button_text').closest(fieldWrap).slideDown();
							$('#tcas-sc-impact_header-button_link').closest(fieldWrap).slideDown();
							$('#tcas-sc-impact_header-button_external').closest(fieldWrap).slideDown();
							$('#tcas-sc-impact_header-quform_id').closest(fieldWrap).slideDown();
							break;
						case 'heading-subheading':
							$('#tcas-sc-impact_header-subheading').closest(fieldWrap).slideDown();
							$('#tcas-sc-impact_header-button_text').closest(fieldWrap).slideUp();
							$('#tcas-sc-impact_header-button_link').closest(fieldWrap).slideUp();
							$('#tcas-sc-impact_header-button_external').closest(fieldWrap).slideUp();
							$('#tcas-sc-impact_header-quform_id').closest(fieldWrap).slideUp();
							break;
						case 'heading-subheading-button':
							$('#tcas-sc-impact_header-subheading').closest(fieldWrap).slideDown();
							$('#tcas-sc-impact_header-button_text').closest(fieldWrap).slideDown();
							$('#tcas-sc-impact_header-button_link').closest(fieldWrap).slideDown();
							$('#tcas-sc-impact_header-button_external').closest(fieldWrap).slideDown();
							$('#tcas-sc-impact_header-quform_id').closest(fieldWrap).slideDown();
							break;
					}
				}).change();

				$('#tcas-sc-impact_header-button_link').bind('keyup blur', function () {
					$('#tcas-sc-impact_header-quform_id').closest(fieldWrap)[$(this).val() === '' ? 'slideDown' : 'slideUp']();
				});

				// Texture/detail selectors
				tcas.textureSelectors($content);

				// Icon selector
				tcas.iconSelectors($content);

				// Background position
				tcas.backgroundPositionSelectors($content);

				// Background repeat
				tcas.backgroundRepeatSelectors($content);

				// Range sliders
				tcas.rangeSliders($content);

				// Tooltips
				tcas.tooltips();

				// Show the correct size option for both icon types
				$('.tcas-options .tcas-icon-selector-hidden').change(function () {
					var val = $(this).val(),
						$wrap = $(this).closest('.tcas-options'),
						$sizeImageWrap = $wrap.find('.tcas-icon-size_image').closest(fieldWrap).hide(),
						$sizeFontWrap = $wrap.find('.tcas-icon-font_size').closest(fieldWrap).hide(),
						$styleImageWrap = $wrap.find('.tcas-icon-style_image').closest(fieldWrap).hide(),
						$styleFontWrap = $wrap.find('.tcas-icon-style').closest(fieldWrap).hide(),
						$colorWrap = $wrap.find('.tcas-icon-color').closest(fieldWrap).hide();

					if (val) {
						if (tcas.isFontAwesome(val) || tcas.isMixedIcon(val)) {
							$sizeFontWrap.show();
							$styleFontWrap.show();
							$colorWrap.show();
						} else {
							$sizeImageWrap.show();
							$styleImageWrap.show();
							$colorWrap.hide();
						}
					}
				}).change();

				$('#tcas-sc-icon-boxed, #tcas-sc-icon-icon').change(function () {
					var icon = $('#tcas-sc-icon-icon').val();

					if (!icon.length || (!tcas.isFontAwesome(icon) && !tcas.isMixedIcon(icon) && !$('#tcas-sc-icon-boxed').is(':checked'))) {
						$('#tcas-sc-icon-color').closest(fieldWrap).slideUp();
					} else {
						$('#tcas-sc-icon-color').closest(fieldWrap).slideDown();
					}

				}).change();
				$('#tcas-sc-icon-character').change(function () {
					if ($(this).val() !== '') {
						$('#tcas-sc-icon-font_size').closest(fieldWrap).slideDown();
						$('#tcas-sc-icon-icon').closest(fieldWrap).slideUp();
					} else {
						$('#tcas-sc-icon-font_size').closest(fieldWrap).slideUp();
						$('#tcas-sc-icon-icon').closest(fieldWrap).slideDown();
					}
				}).change();
				$('#tcas-sc-icon-icon').change(function () {
					var icon = $('#tcas-sc-icon-icon').val();

					if (!icon.length || (!tcas.isFontAwesome(icon) && !tcas.isMixedIcon(icon))) {
						$('#tcas-sc-icon-character').closest(fieldWrap).slideDown();
					} else {
						$('#tcas-sc-icon-character').closest(fieldWrap).slideUp();
					}
				}).change();

				// Block image upload
				$.each(['', '_retina'], function (j, retina) {
					tcas.mediaBrowser($('#tcas-block-sc-image' + retina + '_browse'), {
						mediaOptions: tcas.imageMediaOptions,
						callback: function (selection) {
							try {
								var image = selection.first().toJSON(),
									shortUrl = tcas.makeUploadUrlRelative(image.url);

								$('#tcas-sc-block-image' + retina).val(shortUrl).blur();
								$('#tcas-sc-block-image' + retina + '_width').val(image.width);
								$('#tcas-sc-block-image' + retina + '_height').val(image.height);
							} catch (ex) {
								tcas.log(selection);
								throw ex;
							}
						},
						onOpen: function () {
							$(document).unbind('click.tcas-shortcode');
						},
						onClose: function () {
							setTimeout(bindPopupClose, 500); // Delay or the media browser closes the popup
						}
					});
				});

				// Block retina image
				$('#tcas-sc-block-image_retina_use_main_img').change(function () {
					var $this = $(this),
						val = $(this).val();

					if (val == 'use-new-img') {
						$this.closest(fieldWrap).find('.image_retina_use_main_img_is_yes').slideDown();
					} else {
						$this.closest(fieldWrap).find('.image_retina_use_main_img_is_yes').slideUp();
					}


					if (val != 'never') {
						$this.closest(fieldWrap).find('.image_retina_use_main_img_is_yes_or').slideDown();
						$this.closest(fieldWrap).find('.tcas-background-image-retina-settings').slideDown();
					} else {
						$this.closest(fieldWrap).find('.image_retina_use_main_img_is_yes_or').slideUp();
						$this.closest(fieldWrap).find('.tcas-background-image-retina-settings').slideUp();
					}
				});

				$('#tcas-sc-block-image_convert').change(function () {
					$('#tcas-sc-block-image_convert_custom').closest(innerFieldWrap)[$(this).val() === 'custom' ? 'fadeIn' : 'fadeOut']();
				});

				var setBlockHeightOptionsVisiblity = function () {
					if ($('#tcas-sc-block-use_screen_as_min_height').is(':checked')) {
						$('#tcas-sc-block-min_height, #tcas-sc-block-scroll, #tcas-sc-block-fixed_height, #tcas-sc-block-vertical_align_middle').closest(fieldWrap).slideUp();
					} else {
						$('#tcas-sc-block-min_height, #tcas-sc-block-scroll').closest(fieldWrap).slideDown();

						if ($('#tcas-sc-block-scroll').is(':checked')) {
							$('#tcas-sc-block-fixed_height, #tcas-sc-block-vertical_align_middle, #tcas-sc-block-use_screen_as_fixed_height').closest(fieldWrap).slideDown();
								if ($('#tcas-sc-block-use_screen_as_fixed_height').is(':checked')) {
									$('#tcas-sc-block-fixed_height').closest(fieldWrap).slideUp();
								} else {
									$('#tcas-sc-block-fixed_height').closest(fieldWrap).slideDown();
								}
						} else {
							$('#tcas-sc-block-fixed_height, #tcas-sc-block-vertical_align_middle, #tcas-sc-block-use_screen_as_fixed_height').closest(fieldWrap).slideUp();
						}
					}
				};
				setBlockHeightOptionsVisiblity();
				$('#tcas-sc-block-use_screen_as_min_height, #tcas-sc-block-min_height, #tcas-sc-block-scroll, #tcas-sc-block-use_screen_as_fixed_height').change(setBlockHeightOptionsVisiblity);

				$('#tcas-sc-block-image_parallax').bind('keyup blur', function () {
					if ($(this).val() != '1') {
						$('#tcas-sc-block-image_parallax_offset').closest(innerFieldWrap).fadeIn();
					} else {
						$('#tcas-sc-block-image_parallax_offset').closest(innerFieldWrap).fadeOut();
					}
				}).blur();

				$('#tcas-toggle-sc-textures-background').click(function () {
					var $this = $(this);

					if (!$this.hasClass('active')) {
						$('.tcas-sc-texture-wrap-background').slideDown();
						$this.addClass('active');
					} else {
						$('.tcas-sc-texture-wrap-background').slideUp();
						$this.removeClass('active');
					}
				});
				$('#tcas-toggle-sc-details-background').click(function () {
					var $this = $(this);

					if (!$this.hasClass('active')) {
						$('.tcas-sc-detail-wrap-background').slideDown();
						$this.addClass('active');
					} else {
						$('.tcas-sc-detail-wrap-background').slideUp();
						$this.removeClass('active');
					}
				});

				$('#tcas-toggle-sc-custom-background').click(function () {
					var $this = $(this);

					if (!$this.hasClass('active')) {
						$('.tcas-sc-image-wrap-background').slideDown();
						$this.addClass('active');
					} else {
						$('.tcas-sc-image-wrap-background').slideUp();
						$this.removeClass('active');
					}
				});

				$('#tcas-toggle-sc-dimensions').click(function () {
					var $this = $(this);

					if (!$this.hasClass('active')) {
						$('.tcas-sc-wrap-dimensions').slideDown();
						$this.addClass('active');
					} else {
						$('.tcas-sc-wrap-dimensions').slideUp();
						$this.removeClass('active');
					}
				});

				$('#tcas-toggle-sc-styles-color').click(function () {
					var $this = $(this);

					if (!$this.hasClass('active')) {
						$('.tcas-sc-wrap-styles-color').slideDown();
						$this.addClass('active');
					} else {
						$('.tcas-sc-wrap-styles-color').slideUp();
						$this.removeClass('active');
					}
				});

				$('#tcas-toggle-sc-animations').click(function () {
					var $this = $(this);

					if (!$this.hasClass('active')) {
						$('.tcas-sc-wrap-animations').slideDown();
						$this.addClass('active');
					} else {
						$('.tcas-sc-wrap-animations').slideUp();
						$this.removeClass('active');
					}
				});

				$('#tcas-toggle-sc-manage-display').click(function () {
					var $this = $(this);

					if (!$this.hasClass('active')) {
						$('.tcas-sc-wrap-manage-display').slideDown();
						$this.addClass('active');
					} else {
						$('.tcas-sc-wrap-manage-display').slideUp();
						$this.removeClass('active');
					}
				});

				// Image shortcode uploader
				tcas.mediaBrowser($('#tcas-image-sc-image_browse'), {
					mediaOptions: tcas.imageMediaOptions,
					callback: function (selection) {
						try {
							var image = selection.first().toJSON(),
								shortUrl = tcas.makeUploadUrlRelative(image.url);

							$('#tcas-sc-image-src').val(shortUrl).blur(); // Blur triggers preview refresh
							$('#tcas-sc-image-width').val(image.width);
						} catch (ex) {
							tcas.log(selection);
							throw ex;
						}
					},
					onOpen: function () {
						$(document).unbind('click.tcas-shortcode');
					},
					onClose: function () {
						setTimeout(bindPopupClose, 500); // Delay or the media browser closes the popup
					}
				});

				// Image SC: show margin fields when custom margin On
				$('#tcas-sc-image-custom_margin').change(function () {
					if ($(this).is(':checked')) {
						$('#tcas-sc-image-top_margin').closest('.tcas-shortcode-field-outer').slideDown();
					} else {
						$('#tcas-sc-image-top_margin').closest('.tcas-shortcode-field-outer').slideUp();
					}
				}).change();
			}); // End .load() content

			$outer.append($overlay).bind('click', function (e) {
				if (e.target.className !== 'tcas-shortcode-overlay') {
					// Stop click events bubbling
					e.stopPropagation();
				}
			});

			function bindPopupClose()
			{
				$(document).bind('click.tcas-shortcode', function (e) {
					if (e.which == 3 || e.target.className !== 'tcas-shortcode-overlay') { // Prevent a rightclick closing the popup, or non-overlay click
						return;
					}

					closeShortcodePopup();
				});
			}
			bindPopupClose();

			$(window).bind('resize.tcas-shortcode', function () {
				var $shortcodeWrap = $('.tcas-shortcode-wrap'),
				height = $(window).height(),
				adminBarHeight = 0;

				if ($body.hasClass('admin-bar')) {
					adminBarHeight = 32;
				}

				if ($shortcodeWrap.length) {
					$shortcodeWrap.height(height - 85 - adminBarHeight);
					$shortcodeWrap.css({'top': 40 + adminBarHeight + 'px',marginTop: 0});
				}
			}).resize();
		};

		// Load the shortcode overlay when button is clicked
		$(document).on('click', '.tcas-insert-trigger', function (e) {
			e.stopPropagation();
			e.preventDefault();
			loadShortcodePopup.call(this);
		});

		var ShortcodeGenerator = {
			/**
			 * Render the selected shortcode
			 *
			 * @returns string
			 */
			render: function () {
				var type = $('#tcas-type-select').val(),
				o = '',
				code = type,
				enclosing = 'self-closing',
				content = '',
				atts = '',
				nl = ((typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden()) ? '<br />' : '\n',
				$panes;

				switch (type) {
					case 'row':
						var layout = $('#tcas-select-layout').val(),
							cols = layout.split('-');

						if (layout) {
							atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-row');

							o = '[row' + (atts ? ' ' + atts : '') + ']' + nl;

							for (var i = 0; i < cols.length; i++) {
								o += '[col width="' + cols[i] +'"]' + $('#tcas-sc-layout-content-' + (i + 1)).val() + '[/col]' + nl;
							}

							o += '[/row]' + nl;
						}

						break;
					case 'blockquote':
					case 'pullquote':
						enclosing = 'enclosing';
						content = $('#tcas-sc-' + type + '-enclosed_content').val();
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'box':
						enclosing = 'enclosing';
						content = $('#tcas-sc-box-enclosed_content').val();
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'section_break':
						enclosing = 'both';
						content = $('#tcas-sc-section_break-enclosed_content').val();
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'button':
						enclosing = 'enclosing';
						content = $('#tcas-sc-button-enclosed_content').val();
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type, 'button_drop');
						if ($('#tcas-sc-button-button_drop').val()) {
							content += '[button_drop]' + $('#tcas-sc-button-button_drop').val() + '[/button_drop]';
						}
						break;
					case 'list':
						enclosing = 'enclosing';
						content = $('#tcas-sc-list-enclosed_content').val();
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'menu':
						enclosing = 'both';
						content = $('#tcas-sc-menu-enclosed_content').val();
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'fancy_table':
						enclosing = 'enclosing';
						content = $('#tcas-sc-fancy_table-enclosed_content').val();
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'dropcap':
						enclosing = 'enclosing';
						content = $('#tcas-sc-dropcap-enclosed_content').val();
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'opening_times':
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'animated_number':
						enclosing = 'enclosing';
						content = $('#tcas-sc-animated_number-enclosed_content').val();
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;

					case 'animated_progress':
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;

					case 'tabs':
						var $tabs = $('.tcas-sc-pane', '#tcas-options-tabs');
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-tabs');

						o = '[tabs' + (atts ? ' ' + atts : '') + ']' + nl;

						$.each($tabs, function () {
							var $this = $(this),
							title = $this.find('input[type="text"]').val(),
							content = $this.find('textarea').val(),
							icon = $this.find('input[type="hidden"]').val();

							o += '[tab title="' + title + '"' + (icon && icon.length ? ' icon="' + icon + '"' : '') + ']' + content + '[/tab]' + nl;
						});

						o += '[/tabs]' + nl;
						break;
					case 'toggle':
						var $toggles = $('.tcas-sc-pane', '#tcas-options-toggle');
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-toggle');

						o = '[toggle' + (atts ? ' ' + atts : '') + ']' + nl;

						$.each($toggles, function () {
							var $this = $(this),
							title = $this.find('.tcas-sc-pane-title').val(),
							content = $this.find('textarea').val(),
							open = $this.find('input[type="checkbox"]').is(':checked'),
							classes = $this.find('.tcas-sc-pane-classes').val();

							o += '[toggle_content title="' + title + '"' + (open ? ' open="1"' : '') + (classes ? ' class="' + classes + '"' : '') + ']' + content + '[/toggle_content]' + nl;
						});

						o += '[/toggle]' + nl;
						break;
					case 'accordion':
						$panes = $('.tcas-sc-pane', '#tcas-options-accordion');
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-accordion');

						o = '[accordion' + (atts ? ' ' + atts : '') + ']' + nl;

						$.each($panes, function () {
							var $this = $(this),
							title = $this.find('.tcas-sc-pane-title').val(),
							content = $this.find('textarea').val(),
							open = $this.find('input[type="checkbox"]').is(':checked'),
							classes = $this.find('.tcas-sc-pane-classes').val();

							o += '[accordion_toggle title="' + title + '"' + (open ? ' open="1"' : '') + (classes ? ' class="' + classes + '"' : '') + ']' + content + '[/accordion_toggle]' + nl;
						});

						o += '[/accordion]' + nl;
						break;
					case 'cycle':
						$panes = $('.tcas-sc-pane', '#tcas-options-cycle');
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-cycle');

						o = '[cycle' + (atts ? ' ' + atts : '') + ']' + nl;

						$.each($panes, function () {
							var $this = $(this),
							content = $this.find('textarea').val();

							o += '[cycle_slide]' + content + '[/cycle_slide]' + nl;
						});

						o += '[/cycle]' + nl;
						break;
					case 'image':
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'image_carousel':
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						o = '[image_carousel' + (atts ? ' ' + atts : '') + ']' + nl;
						o += $('#tcas-sc-image_carousel-enclosed_content').val() + nl;
						o += '[/image_carousel]' + nl;
						break;
					case 'fancy_header':
						enclosing = 'enclosing';
						content = $('#tcas-sc-fancy_header-enclosed_content').val();
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'impact_header':
						enclosing = 'enclosing';
						content = $('#tcas-sc-impact_header-enclosed_content').val();
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'block':
						enclosing = 'enclosing';
						content = $('#tcas-sc-block-enclosed_content').val();
						// Ignore parallax offset if ratio is 1
						var ignore = $('#tcas-sc-block-image_parallax').val() == '1' ? 'image_parallax_offset' : null;
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type, ignore);
						break;
					case 'fixed':
						enclosing = 'enclosing';
						content = $('#tcas-sc-fixed-enclosed_content').val();
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'lightbox':
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type, 'trigger_html');
						o = '[lightbox' + (atts ? ' ' + atts : '') + ']' + nl;
						o += '[lightbox_trigger]' + nl;
						o += $('#tcas-sc-lightbox-trigger_html').val() + nl;
						o += '[/lightbox_trigger]' + nl;
						o += '[lightbox_content]' + nl;
						o += $('#tcas-sc-lightbox-enclosed_content').val() + nl;
						o += '[/lightbox_content]' + nl;
						o += '[/lightbox]' + nl;
						break;
					case 'icon':
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					case 'flag':
						atts = ShortcodeGenerator.fieldsToAtts('#tcas-options-' + type);
						break;
					default:
					case '':
						return;
				}

				// If we've created output already, return it
				if (o) return o;

				if (!code) return;

				o = '[' + code + (atts ? ' ' + atts : '') + (enclosing == 'both' && !content.length ? ' /' : '') + ']';

				switch (enclosing) {
					case 'enclosing':
						o += (content || ' ') + '[/' + code + ']';
						break;
					case 'both':
						o += content.length ? content + '[/' + code + ']' : '';
						break;
				}

				return o;
			},

			/**
			 * Generates an attributes array from a group of generated shortcode
			 * options fields.
			 *
			 * @param   string  wrapperSelector  The jQuery selector for the fields wrapper
			 * @param   string  ignore           Ignore fields matching this selector
			 * @return  array
			 */
			fieldsToAtts: function (wrapperSelector, ignore) {
				var atts = [];

				$.each($(wrapperSelector).find('.tcas-shortcode-field-outer'), function (i, field) {
					var $field = $(field),
						config = $field.data('config');

					if (config.name) {
						var value = ShortcodeGenerator.getAttributeValue(config, $field);
						if (value != config['default'] && config.name != 'enclosed_content' && config.name != ignore) {
							atts.push(config.name + '="' + value + '"');
						}
					}

					if (config.type === 'multiple') {
						$.each($field.find('.tcas-shortcode-inner-outer'), function (j, child) {
							var $child = $(child),
								childConfig = $child.data('config'),
								childValue = ShortcodeGenerator.getAttributeValue(childConfig, $child);

							if (childValue != childConfig['default'] && childConfig.name != 'enclosed_content' && childConfig.name != ignore) {
								atts.push(childConfig.name + '="' + childValue + '"');
							}
						});
					}
				});

				return atts.join(' ');
			},

			/**
			 * Get the value of an attribute
			 *
			 * @param array config The field config
			 * @param jQuery $field The field wrapper
			 * @returns string
			 */
			getAttributeValue: function (config, $field) {
				var value = '';

				switch (config.type) {
					default:
					case 'text':
					case 'textarea':
					case 'select':
						value = $('#' + config.selector).val();
						break;
					case 'toggle':
						value = $('#' + config.selector).is(':checked') ? '1' : '0';
						break;
					case 'multiselect':
						var val = $('#' + config.selector).val();
						if ($.isArray(val)) {
							value = val.toString();
						}
						break;
				}

				return value;
			},

			/**
			 * Send the content to the editor
			 *
			 * @param string shortcode
			 */
			sendToEditor: function (shortcode) {
				var widgetTarget = $('#tcas-widget-target').val();

				if (widgetTarget) {
					var sel, startPos, endPos, scrollTop, text, canvas = document.getElementById(widgetTarget);

					if ( !canvas )
						return false;

					if ( document.selection ) { //IE
						canvas.focus();
						sel = document.selection.createRange();
						sel.text = shortcode;
						canvas.focus();
					} else if ( canvas.selectionStart || canvas.selectionStart == '0' ) { // FF, WebKit, Opera
						text = canvas.value;
						startPos = canvas.selectionStart;
						endPos = canvas.selectionEnd;
						scrollTop = canvas.scrollTop;

						canvas.value = text.substring(0, startPos) + shortcode + text.substring(endPos, text.length);

						canvas.focus();
						canvas.selectionStart = startPos + shortcode.length;
						canvas.selectionEnd = startPos + shortcode.length;
						canvas.scrollTop = scrollTop;
					} else {
						canvas.value += shortcode;
						canvas.focus();
					}
				} else {
					window.send_to_editor(shortcode);
				}
			},

			loadExistingShortcodeSettings: function (shortcode) {
				if (!shortcode || typeof shortcode !== 'string') {
					return;
				}

				if (!(typeof wp === 'object' && typeof wp.shortcode === 'function' && typeof wp.shortcode.regexp === 'function' && typeof wp.shortcode.attrs === 'function')) {
					alert('WordPress shortcode helper functions not found, check if the theme is compatible with this version of WP or contact the theme author.');
					return;
				}

				// Due to the way the shortcode is checked by the regex, any shortcode that can contain other shortcodes should be
				// near the top of this list, otherwise inner shortcodes could be matched first.
				var types = [
					'row',
					'block',
					'fixed',
					'box',
					'accordion',
					'toggle',
					'tabs',
					'cycle',
					'image_carousel',
					'fancy_table',
					'lightbox',
					'blockquote',
					'pullquote',
					'button',
					'button_drop',
					'dropcap',
					'fancy_header',
					'flag',
					'animated_number',
					'animated_progress',
					'icon',
					'image',
					'impact_header',
					'list',
					'menu',
					'opening_times',
					'section_break'
				];

				var matches = null,
					type, regex;

				for (var i = 0; i < types.length; i++) {
					type = types[i];
					regex = wp.shortcode.regexp(type);

					matches = regex.exec(shortcode);
					regex.lastIndex = 0; // To reset the pattern, otherwise consecutive match fails

					if (matches !== null) {
						break;
					}
				}

				if (matches === null) {
					alert('Could not edit shortcode: No match found');
					return;
				}

				var loadIcon = function ($field, icon) {
					var $current = $field.siblings('.tcas-icon-selector-current'),
						newClass = icon;

					if (tcas.isFontAwesome(icon)) {
						newClass = 'fa ' + icon;
					} else if (tcas.isMixedIcon(icon)) {
						newClass = 'mix-ico ' + icon;
					} else {
						newClass = 'drk sml iconsprite ' + icon;
					}

					if (icon) {
						$current.find('.tcas-choose-no-icon').show();
					}

					$field.val(icon).change();
					$current.find('.tcas-chosen-icon').text('').attr('class', 'tcas-chosen-icon ' + newClass);
				};

				var sc = matches[2],
					atts = wp.shortcode.attrs(matches[3]),
					content = matches[5];

				for (var j in atts.named) {
					if (atts.named.hasOwnProperty(j)) {
						var value = atts.named[j],
							$field = $('#tcas-sc-' + sc + '-' + j);

						if ($field.length) {
							if ($field.is('input[type="text"]') || $field.is('textarea')) {
								$field.val(value).trigger('blur');
							} else if ($field.is('input[type="checkbox"]')) {
								if ((value == '1' && !$field.is(':checked')) || (value == '0' && $field.is(':checked'))) {
									$field.click();
								}
							} else if ($field.is('select')) {
								if ($field.hasClass('tcas-texture-select')) {
									$field.siblings('.tcas-texture-selector').find('.tcas-texture-option').filter(function () {
										return $(this).data('texture') === value;
									}).click();
								} else if ($field.hasClass('tcas-detail-select')) {
									$field.siblings('.tcas-detail-selector').find('.tcas-detail-option').filter(function () {
										return $(this).data('detail') === value;
									}).click();
								} else if ($field.hasClass('tcas-bg-position-select')) {
									$field.siblings('.tcas-bg-position-selector').find('.tcas-bg-position-option').filter(function () {
										return $(this).data('position') === value;
									}).click();
								} else if ($field.hasClass('tcas-bg-repeat-select')) {
									$field.siblings('.tcas-bg-repeat-selector').find('.tcas-bg-repeat-option').filter(function () {
										return $(this).data('repeat') === value;
									}).click();
								} else if ($field.is('select[multiple]')) {
									var values = value.split(',');
									$field.find('option').each(function () {
										$(this).prop('selected', false);
										if ($.inArray($(this).val(), values) !== -1) {
											$(this).prop('selected', true);
										}
									});
								} else {
									$field.val(value).change();
								}
							} else if ($field.hasClass('tcas-icon-selector-hidden')) {
								loadIcon($field, value);
							} else if ($field.is('input[type="hidden"]')) {
								// Support editing unavailable options when React is not active so the value is not lost
								$field.val(value);
							}
						}
					}
				}

				// Column Layouts specific code
				if (type === 'row') {
					var rowTmpContent = content,
						columnRegex = wp.shortcode.regexp('col'),
						columnMatches = columnRegex.exec(rowTmpContent),
						layout = [],
						columns = [];

					columnRegex.lastIndex = 0;

					while (columnMatches !== null) {
						columns.push(columnMatches[5]);
						var colAttrs = wp.shortcode.attrs(columnMatches[3]);
						if (typeof colAttrs.named.width === 'string') {
							layout.push(colAttrs.named.width);
						}

						rowTmpContent = rowTmpContent.replace(columnMatches[0], '');
						columnMatches = columnRegex.exec(rowTmpContent);
						columnRegex.lastIndex = 0;
					}

					$('#tcas-select-layout').val(layout.join('-')).change();

					for (var m = 0, columnsLength = columns.length; m < columnsLength; m++) {
						$('#tcas-layout-content-wrap-' + (m+1)).show().find('textarea').val(columns[m]);
					}
				}

				var getPanesInContent = function (content, paneShortcode) {
					var tmpContent = content,
						paneRegex = wp.shortcode.regexp(paneShortcode),
						paneMatches = paneRegex.exec(tmpContent),
						panes = [];

					paneRegex.lastIndex = 0;

					while (paneMatches !== null) {
						panes.push(paneMatches);
						tmpContent = tmpContent.replace(paneMatches[0], '');
						paneMatches = paneRegex.exec(tmpContent);
						paneRegex.lastIndex = 0;
					}

					return panes;
				};

				var loadPanes = function (panes, $addButton, $panesWrap) {
					if (panes.length) {
						for (var k = 0, panesLength = panes.length; k < panesLength; k++) {
							$addButton.click();
							var $pane = $panesWrap.find('.tcas-sc-pane').last();
							var paneAtts = wp.shortcode.attrs(panes[k][3]);
							var title = typeof paneAtts.named.title === 'string' ? paneAtts.named.title : '';
							var open = typeof paneAtts.named.open === 'string' && paneAtts.named.open === '1' ? true : false;
							var classes = typeof paneAtts.named['class'] === 'string' ? paneAtts.named['class'] : '';

							$pane.find('.tcas-sc-pane-title').val(title);
							$pane.find('textarea').val(panes[k][5]);
							$pane.find('input[type="checkbox"]').prop('checked', open);
							$pane.find('.tcas-sc-pane-classes').val(classes);
						}
					}
				};

				var panes;

				// Accordion shortcode panes
				if (type === 'accordion') {
					panes = getPanesInContent(content, 'accordion_toggle');

					// Remove all existing panes
					$('#tcas-sc-accordions-wrap .tcas-sc-pane-remove').click();

					loadPanes(panes, $('#tcas-add-accordion'), $('#tcas-sc-accordions-wrap'));
				}

				// Toggle shortcode panes
				if (type === 'toggle') {
					panes = getPanesInContent(content, 'toggle_content');

					// Remove all panes
					$('#tcas-sc-toggles-wrap .tcas-sc-pane-remove').click();

					loadPanes(panes, $('#tcas-add-toggle'), $('#tcas-sc-toggles-wrap'));
				}


				// Cycle slides
				if (type === 'cycle') {
					var cycleTmpContent = content,
						slideRegex = wp.shortcode.regexp('cycle_slide'),
						slideMatches = slideRegex.exec(cycleTmpContent),
						slides = [];

					slideRegex.lastIndex = 0;

					while (slideMatches !== null) {
						slides.push(slideMatches[5]);
						cycleTmpContent = cycleTmpContent.replace(slideMatches[0], '');
						slideMatches = slideRegex.exec(cycleTmpContent);
						slideRegex.lastIndex = 0;
					}

					$('#tcas-sc-cycle-slides-wrap .tcas-sc-pane-remove').click();

					if (slides.length) {
						var $slidesWrap = $('#tcas-sc-cycle-slides-wrap');
						for (var n = 0, slidesLength = slides.length; n < slidesLength; n++) {
							$('#tcas-add-cycle').click();
							$slidesWrap.find('.tcas-sc-pane').last().find('textarea').val(slides[n]);
						}
					}
				}

				// Tabs
				if (type === 'tabs') {
					var tabsTmpContent = content,
						tabRegex = wp.shortcode.regexp('tab'),
						tabMatches = tabRegex.exec(tabsTmpContent),
						tabs = [];

					tabRegex.lastIndex = 0;

					while (tabMatches !== null) {
						tabs.push(tabMatches);
						tabsTmpContent = tabsTmpContent.replace(tabMatches[0], '');
						tabMatches = tabRegex.exec(tabsTmpContent);
						tabRegex.lastIndex = 0;
					}

					$('#tcas-sc-tabs-wrap .tcas-sc-pane-remove').click();

					if (tabs.length) {
						var $tabsWrap = $('#tcas-sc-tabs-wrap'), $addTabButton = $('#tcas-add-tab');
						for (var l = 0, tabsLength = tabs.length; l < tabsLength; l++) {
							$addTabButton.click();

							var $tab = $tabsWrap.find('.tcas-sc-pane').last();
							var tabAtts = wp.shortcode.attrs(tabs[l][3]);
							var title = typeof tabAtts.named.title === 'string' ? tabAtts.named.title : '';
							var tabIcon = typeof tabAtts.named.icon === 'string' ? tabAtts.named.icon : '';

							$tab.find('input[type="text"]').val(title);
							$tab.find('textarea').val(tabs[l][5]);
							loadIcon($tab.find('input[type="hidden"]'), tabIcon);
						}
					}
				}

				if (type == 'lightbox') {
					var triggerRegex = wp.shortcode.regexp('lightbox_trigger'),
						triggerMatches = triggerRegex.exec(content),
						contentRegex = wp.shortcode.regexp('lightbox_content'),
						contentMatches = contentRegex.exec(content);

					triggerRegex.lastIndex = 0;
					contentRegex.lastIndex = 0;

					if (triggerMatches !== null) {
						$('#tcas-sc-lightbox-trigger_html').val(triggerMatches[5].replace(/^\n|\n$/g, ''));
					}

					if (contentMatches !== null) {
						content = contentMatches[5];
					}
				}

				if (type == 'button') {
					var dropRegex = wp.shortcode.regexp('button_drop'),
						dropMatches = dropRegex.exec(content);

					dropRegex.lastIndex = 0;

					if (dropMatches !== null) {
						$('#tcas-sc-button-button_drop').val(dropMatches[5]);
						content = content.replace(dropMatches[0], '');
					}
				}

				// Strip newline from start and end of content for some shortcodes
				if (type == 'image_carousel' || type == 'lightbox') {
					content = content.replace(/^\n|\n$/g, '');
				}

				$('#tcas-type-select').val(sc).change();

				if ($('#tcas-sc-' + sc + '-enclosed_content').length) {
					$('#tcas-sc-' + sc + '-enclosed_content').val(content).trigger('blur');
				}
			}
		}; // End ShortcodeGenerator object
	}); // End document.ready
})(jQuery);
