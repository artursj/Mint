/*
 * ThemeCatcher Portfolio Shortcode JavaScript
 *
 * Copyright www.themecatcher.net
 * All rights reserved.
 */
;(function ($) {
	"use strict";

	$(document).ready(function () {
		var $body = $('body'),
			$outer = $('<div id="tcap-shortcode-outer"/>').appendTo($body);

		var updatePosts = function () {
			var type = $('#tcap-sc-portfolio-post_type').val(),
				$posts = $('#tcap-sc-portfolio-posts').empty(),
				$categories = $('#tcap-sc-portfolio-categories').empty(),
				$allCategories = $('#tcap-sc-portfolio-category__and').empty(),
				$excludeCategories = $('#tcap-sc-portfolio-category__not_in').empty(),
				$authors = $('#tcap-sc-portfolio-author').empty(),
				posts, categories, authors;

			if (type == 'post') {
				posts = tcapL10n.postPosts;
				categories = tcapL10n.postCategories;
				authors = tcapL10n.postAuthors;
			} else {
				posts = tcapL10n.portfolioPosts;
				categories = tcapL10n.portfolioCategories;
				authors = tcapL10n.portfolioAuthors;
			}

			// Populate posts
			for (var i in posts) {
				if (posts.hasOwnProperty(i)) {
					$posts.append($('<option>', { text: posts[i], value: i }));
				}
			}

			// Populate categories
			for (var j in categories) {
				if (categories.hasOwnProperty(j)) {
					$categories.append($('<option>', { text: categories[j], value: j }));
					$allCategories.append($('<option>', { text: categories[j], value: j }));
					$excludeCategories.append($('<option>', { text: categories[j], value: j }));
				}
			}

			// Populate authors
			for (var k in authors) {
				if (authors.hasOwnProperty(k)) {
					$authors.append($('<option>', { text: authors[k], value: k }));
				}
			}

			$posts.add($categories).add($allCategories).add($excludeCategories).add($authors).trigger('chosen:updated');
		};

		var loadShortcodePopup = function () {
			var $overlay = $('<div class="tcap-shortcode-overlay"/>'),
			$wrap = $('<div class="tcap-shortcode-wrap"/>').appendTo($overlay),
			$loading = $('<div class="tcap-shortcode-loading"/>').appendTo($wrap),
			$content = $('<div class="tcap-shortcode-content"/>').appendTo($wrap),
			$buttonWrap = $('<div class="tcap-overlay-buttons"/>').appendTo($wrap),
			fieldWrap = '.tcap-shortcode-field-outer',
			innerFieldWrap = '.tcap-shortcode-inner-outer',
			closeShortcodePopup = function () {
				$(document).unbind('click.tcap-shortcode');
				$(window).unbind('resize.tcap-shortcode');
				$overlay.remove();
				$body.removeClass('tcap-popup-open');
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

			$body.addClass('tcap-popup-open');

			$('<div class="tcap-overlay-button tcap-overlay-button-close"/>').click(function () {
				closeShortcodePopup();
			}).appendTo($buttonWrap).attr('title', tcapL10n.close);

			$('<div class="tcap-overlay-button tcap-overlay-button-insert"/>').click(function () {
				insertShortcode();
			}).appendTo($buttonWrap).attr('title', tcapL10n.insert);

			$('<div class="tcap-overlay-button tcap-overlay-button-insert-close"/>').click(function () {
				insertCloseShortcode();
			}).appendTo($buttonWrap).attr('title', tcapL10n.insertClose);

			// Stop popup buttons scrolling the popup
			$buttonWrap.bind('mousedown', function () { return false; });

			var url = tcapL10n.shortcodeGeneratorUrl;

			if ($(this).data('widget')) {
				url += '&widget=' + $(this).data('widget');
			}

			$content.load(url, function () {
				$loading.remove();

				if ($.isFunction($.fn.chosen)) {
					$('#tcap-sc-portfolio-posts', $content).chosen({
						placeholder_text_multiple: tcapL10n.selectPosts,
						width: '410px'
					});

					$('#tcap-sc-portfolio-categories, #tcap-sc-portfolio-category__and, #tcap-sc-portfolio-category__not_in', $content).chosen({
						placeholder_text_multiple: tcapL10n.selectCategories,
						width: '410px'
					});

					$('#tcap-sc-portfolio-author', $content).chosen({
						placeholder_text_multiple: tcapL10n.selectAuthors,
						width: '410px'
					});
				}

				if ($.isFunction($.fn.toggleSwitch)) {
					$('input.tcap-option-toggle, select.tcap-option-tritoggle').toggleSwitch({
						prefix: 'tcap-toggleswitch',
						onText: tcapL10n.on,
						offText: tcapL10n.off,
						defaultText: tcapL10n._default
					});

					$('input.tcap-option-toggle-yn, select.tcap-option-tritoggle-yn').toggleSwitch({
						prefix: 'tcap-toggleswitch',
						defaultText: tcapL10n._default,
						onText: tcapL10n.yes,
						offText: tcapL10n.no
					});
				}

				$('#tcap-insert-shortcode').click(function (e) {
					insertShortcode();
				});

				$('#tcap-insert-close-shortcode').click(function (e) {
					insertCloseShortcode();
				});

				$('#tcap-close-shortcode').click(function (e) {
					closeShortcodePopup();
				});

				$('#tcap-edit-button').click(function (e) {
					e.preventDefault();
					$('#tcap-edit-wrap').slideDown();
				});

				$('#tcap-edit-load-button').click(function (e) {
					e.preventDefault();
					var val = $('#tcap-edit-sc').val();

					if (val.length === 0) {
						alert('Please enter an existing shortcode to edit');
						return;
					}

					ShortcodeGenerator.loadExistingShortcodeSettings(val);
					$('#tcap-edit-wrap').slideUp();
				});

				$('#tcap-edit-cancel-button').click(function (e) {
					e.preventDefault();
					$('#tcap-edit-wrap').slideUp();
				});

				// Prevent the form submitting
				$('#tcap-shortcode-form').submit(function (e) {
					e.preventDefault();
				});

				// The post_type option was changed
				$('#tcap-sc-portfolio-post_type').change(function () {
					updatePosts();

					var type = $(this).val();

					if (type == 'post') {
						// Default options for Blog type
						$('#tcap-sc-portfolio-image_type').val('above').change();
						$('#tcap-sc-portfolio-orderby').val('date').change();
						$('#tcap-sc-portfolio-order').val('DESC').change();
						$('#tcap-sc-portfolio-sortable').prop('checked', false).trigger('toggleswitch:update').change();
						$('#tcap-sc-portfolio-show_meta').prop('checked', true).trigger('toggleswitch:update').change();
						$('#tcap-sc-portfolio-show_date').prop('checked', true).trigger('toggleswitch:update').change();
					} else {
						// Default options for Portfolio type
						$('#tcap-sc-portfolio-image_type').val('below').change();
						$('#tcap-sc-portfolio-orderby').val('menu_order').change();
						$('#tcap-sc-portfolio-order').val('ASC').change();
						$('#tcap-sc-portfolio-sortable').prop('checked', true).trigger('toggleswitch:update').change();
						$('#tcap-sc-portfolio-show_meta').prop('checked', false).trigger('toggleswitch:update').change();
						$('#tcap-sc-portfolio-show_date').prop('checked', false).trigger('toggleswitch:update').change();
					}
				});

				var setPortfolioMasonryOptionsVisiblity = function () {
					$('#tcap-sc-portfolio-masonry_layout, #tcap-sc-portfolio-masonry_use_layout_options, #tcap-sc-portfolio-sortable').closest(fieldWrap).slideDown();
					if ($('#tcap-sc-portfolio-sortable').is(':checked')) {
						$('#tcap-sc-portfolio-sortable_show_all').closest(fieldWrap).slideDown();
						$('#tcap-sc-portfolio-sortable_position').closest(fieldWrap).slideDown();
						if ($('#tcap-sc-portfolio-sortable_show_all').is(':checked')) {
							$('#tcap-sc-portfolio-sortable_all_text').closest(fieldWrap).slideDown();
						} else {
							$('#tcap-sc-portfolio-sortable_all_text').closest(fieldWrap).slideUp();
						}
					} else {
						$('#tcap-sc-portfolio-sortable_show_all, #tcap-sc-portfolio-sortable_all_text, #tcap-sc-portfolio-sortable_position').closest(fieldWrap).slideUp();
					}
				};

				// Show the masonry options for the portfolio shortcode
				$('#tcap-sc-portfolio-sortable, #tcap-sc-portfolio-sortable_show_all').change(setPortfolioMasonryOptionsVisiblity);
				setPortfolioMasonryOptionsVisiblity();

				// Show the Read More button options for the portfolio shortcode
				$('#tcap-sc-portfolio-show_read_more').change(function (e) {
					if ($(this).is(':checked')) {
						$('#tcap-sc-portfolio-read_more_button_style, #tcap-sc-portfolio-read_more').closest(fieldWrap).slideDown();
					} else {
						$('#tcap-sc-portfolio-read_more_button_style, #tcap-sc-portfolio-read_more').closest(fieldWrap).slideUp();
					}
				}).change();

				// Show the Title options for the portfolio shortcode
				$('#tcap-sc-portfolio-show_title').change(function (e) {
					if ($(this).is(':checked')) {
						$('#tcap-sc-portfolio-link_title, #tcap-sc-portfolio-title_min_height, #tcap-sc-portfolio-title_tag').closest(fieldWrap).slideDown();
					} else {
						$('#tcap-sc-portfolio-link_title, #tcap-sc-portfolio-title_min_height, #tcap-sc-portfolio-title_tag').closest(fieldWrap).slideUp();
					}
				}).change();

				var setPortfolioFeaturedImageOptionsVisiblity = function () {
					if ($('#tcap-sc-portfolio-show_image').is(':checked')) {
						$('#tcap-sc-portfolio-height, #tcap-sc-portfolio-image_type, #tcap-sc-portfolio-like_image').closest(fieldWrap).slideDown();
						var imageType = $('#tcap-sc-portfolio-image_type').val();
						if (imageType == 'left' || imageType == 'right') {
							$('#tcap-sc-portfolio-float_width, #tcap-sc-portfolio-float_height').closest(fieldWrap).slideDown();
						} else {
							$('#tcap-sc-portfolio-float_width, #tcap-sc-portfolio-float_height').closest(fieldWrap).slideUp();
						}

						$('#tcap-sc-portfolio-hover_type_height').closest(fieldWrap)[imageType == 'on-hover' ? 'slideDown' : 'slideUp']();

						if (imageType == 'on-hover') {
							$('#tcap-sc-portfolio-content_on_hover').closest(fieldWrap).slideDown();
						} else {
							$('#tcap-sc-portfolio-content_on_hover').closest(fieldWrap).slideUp();
						}
					} else {
						$('#tcap-sc-portfolio-height, #tcap-sc-portfolio-image_type, #tcap-sc-portfolio-float_width, #tcap-sc-portfolio-float_height, #tcap-sc-portfolio-like_image').closest(fieldWrap).slideUp();
					}
				};

				$('#tcap-sc-portfolio-show_image, #tcap-sc-portfolio-height, #tcap-sc-portfolio-image_type').change(setPortfolioFeaturedImageOptionsVisiblity);
				setPortfolioFeaturedImageOptionsVisiblity();

				$('#tcap-sc-portfolio-like_image').change(function () {
					if ($(this).is(':checked')) {
						$('#tcap-sc-portfolio-like_image_icon').closest(innerFieldWrap).slideDown();
					} else {
						$('#tcap-sc-portfolio-like_image_icon').closest(innerFieldWrap).slideUp();
					}
				}).change();

				$('#tcap-sc-portfolio-like').change(function () {
					if ($(this).is(':checked')) {
						$('#tcap-sc-portfolio-like_icon').closest(innerFieldWrap).slideDown();
					} else {
						$('#tcap-sc-portfolio-like_icon').closest(innerFieldWrap).slideUp();
					}
				}).change();

				// Show excerpt length field
				$('#tcap-sc-portfolio-show_description').change(function (e) {
					if ($(this).is(':checked')) {
						$('#tcap-sc-portfolio-description_length, #tcap-sc-portfolio-description_min_height, #tcap-sc-portfolio-full_description').closest(fieldWrap).slideDown();
					} else {
						$('#tcap-sc-portfolio-description_length, #tcap-sc-portfolio-description_min_height, #tcap-sc-portfolio-full_description').closest(fieldWrap).slideUp();
					}
				}).change();

				$('#tcap-sc-portfolio-height').bind('keyup blur', function () {
					if ($(this).val() > 0) {
						$('#tcap-sc-portfolio-grid').closest(fieldWrap).slideDown();
					} else {
						$('#tcap-sc-portfolio-grid').closest(fieldWrap).slideUp();
					}
				}).blur();

				$('#tcap-sc-portfolio-grid').change(function (e) {
					if (!$(this).is(':checked')) {
						$('#tcap-sc-portfolio-gap, #tcap-sc-portfolio-margin_bottom, #tcap-sc-portfolio-show_title, #tcap-sc-portfolio-title_min_height, #tcap-sc-portfolio-title_tag, #tcap-sc-portfolio-show_read_more, #tcap-sc-portfolio-show_description, #tcap-sc-portfolio-description_min_height, #tcap-sc-portfolio-description_length, #tcap-sc-portfolio-read_more, #tcap-sc-portfolio-read_more_button_style, #tcap-sc-portfolio-like_title, #tcap-sc-portfolio-like_title_icon, #tcap-sc-portfolio-link_title, #tcap-sc-portfolio-show_border, #tcap-sc-portfolio-boxed').closest(fieldWrap).slideDown();
					} else {
						$('#tcap-sc-portfolio-gap, #tcap-sc-portfolio-margin_bottom, #tcap-sc-portfolio-show_title, #tcap-sc-portfolio-title_min_height, #tcap-sc-portfolio-title_tag,  #tcap-sc-portfolio-show_read_more, #tcap-sc-portfolio-show_description, #tcap-sc-portfolio-description_min_height, #tcap-sc-portfolio-description_length, #tcap-sc-portfolio-read_more, #tcap-sc-portfolio-read_more_button_style, #tcap-sc-portfolio-like_title, #tcap-sc-portfolio-like_title_icon, #tcap-sc-portfolio-link_title, #tcap-sc-portfolio-show_border, #tcap-sc-portfolio-boxed').closest(fieldWrap).slideUp();
					}
				}).change();

				// Range sliders
				tcap.rangeSliders($content);

				// Tooltips
				tcap.tooltips();

			}); // End .load() content

			$outer.append($overlay).bind('click', function (e) {
				if (e.target.className !== 'tcap-shortcode-overlay') {
					// Stop click events bubbling
					e.stopPropagation();
				}
			});

			function bindPopupClose()
			{
				$(document).bind('click.tcap-shortcode', function (e) {
					if (e.which == 3 || e.target.className !== 'tcap-shortcode-overlay') { // Prevent a rightclick closing the popup, or non-overlay click
						return;
					}

					closeShortcodePopup();
				});
			}
			bindPopupClose();

			$(window).bind('resize.tcap-shortcode', function () {
				var $shortcodeWrap = $('.tcap-shortcode-wrap'),
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
		$(document).on('click', '.tcap-insert-trigger', function (e) {
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
				var atts = ShortcodeGenerator.fieldsToAtts('#tcap-options-portfolio');

				return '[portfolio' + (atts ? ' ' + atts : '') + ']';
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

				$.each($(wrapperSelector).find('.tcap-shortcode-field-outer'), function (i, field) {
					var $field = $(field),
						config = $field.data('config');

					if (config.name) {
						var value = ShortcodeGenerator.getAttributeValue(config, $field);
						if (value != config['default'] && config.name != 'enclosed_content' && config.name != ignore) {
							atts.push(config.name + '="' + value + '"');
						}
					}

					if (config.type === 'multiple') {
						$.each($field.find('.tcap-shortcode-inner-outer'), function (j, child) {
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
				var widgetTarget = $('#tcap-widget-target').val();

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
					'portfolio'
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

				var sc = matches[2],
					atts = wp.shortcode.attrs(matches[3]),
					content = matches[5];

				for (var j in atts.named) {
					if (atts.named.hasOwnProperty(j)) {
						var value = atts.named[j],
							$field = $('#tcap-sc-' + sc + '-' + j);

						if ($field.length) {
							if ($field.is('input[type="text"]') || $field.is('textarea')) {
								$field.val(value).trigger('blur');
							} else if ($field.is('input[type="checkbox"]')) {
								if ((value == '1' && !$field.is(':checked')) || (value == '0' && $field.is(':checked'))) {
									$field.click();
								}
							} else if ($field.is('select')) {
								if (j == 'post_type') {
									$field.val(value); // Not triggering change deliberately
									updatePosts();
								} else if ($field.is('select[multiple]')) {
									var values = value.split(',');
									$field.find('option').each(function () {
										$(this).prop('selected', false);
										if ($.inArray($(this).val(), values) !== -1) {
											$(this).prop('selected', true);
										}
									});

									if ($field.is('.tcap-chosen-multi')) {
										$field.trigger('chosen:updated');
									}
								} else {
									$field.val(value).change();
								}
							} else if ($field.is('input[type="hidden"]')) {
								// Support editing unavailable options when React is not active so the value is not lost
								$field.val(value);
							}
						}
					}
				}
			}
		}; // End ShortcodeGenerator object
	}); // End document.ready
})(jQuery);
