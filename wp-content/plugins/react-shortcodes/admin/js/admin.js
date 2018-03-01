/*
 * ThemeCatcher Shortcodes Admin JavaScript
 *
 * Copyright www.themecatcher.net
 * All rights reserved.
 */
;(function ($) {
	"use strict";

	var MediaBrowser = function ($button, options) {
		var frame;

		$button.click(function() {
			if (!frame) {
				frame = wp.media(options.mediaOptions);

				// When an item is selected, run a callback.
				frame.on('select', function () {
					options.callback.apply(this, [frame.state().get('selection')]);
				});

				frame.on('close', function () {
					options.onClose.apply(this);
				});
			}

			options.onOpen.apply(this);

			frame.open();
			return false;
		});
	};

	window.tcas = {
		// Default options for the media library browser
		imageMediaOptions: {
			title: tcasL10n.selectImage,
			button: {
				text: tcasL10n.select
			},
			multiple: false,
			library: {
				type: 'image'
			}
		},

		/**
		 * Implementation of WordPress 3.5 Media uploader
		 */
		mediaBrowser: function ($button, options) {
			var defaults = {
				mediaOptions: {
					title: 'Add Media',
					button: {
						text: 'Add'
					},
					multiple: false
				},
				callback: $.noop,
				onOpen: $.noop,
				onClose: $.noop
			},
			settings = $.extend(true, {}, defaults, options);

			if (!$button.data('tcMediaBrowser')) {
				$button.data('tcMediaBrowser', new MediaBrowser($button, settings));
			}
		},

		textureSelectors: function ($context) {
			$context = $context || $(document);

			// Texture selector
			$('.tcas-texture-select', $context).each(function () {
				var $select = $(this),
				$options = $select.find('option'),
				activeClass = 'tcas-select-active',
				$wrap = $('<div class="tcas-texture-selector tcas-selector"/>');

				$options.each(function () {
					var $this = $(this);

					var $layout = $('<div class="tcas-texture-option tcas-tooltip"/>').appendTo($wrap).click(function () {
						$wrap.find('> div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val($this.val()).change();
					})
					.append('<img src="' + tcasL10n.themeAdminUrl + '/images/textures/' + ($this.val() || 'default') + '.png" alt="" />')
					.data('texture', $this.val());

					var $tooltip = $('<span class="tcas-tooltip-text">').html($this.html());
					$layout.append($tooltip);

					if ($this.is(':selected')) {
						$layout.addClass(activeClass);
					}
				});

				$select.hide().after($wrap);
			});

			// Detail selector
			$('.tcas-detail-select', $context).each(function () {
				var $select = $(this),
				$options = $select.find('option'),
				activeClass = 'tcas-select-active',
				$wrap = $('<div class="tcas-detail-selector tcas-selector"/>');

				$options.each(function () {
					var $this = $(this);

					var $layout = $('<div class="tcas-detail-option tcas-tooltip"/>').appendTo($wrap).click(function () {
						$wrap.find('> div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val($this.val()).change();
					})
					.append('<img src="' + tcasL10n.themeAdminUrl + '/images/textures/' + ($this.val() || 'default') + '.png" alt="" />')
					.data('detail', $this.val());

					var $tooltip = $('<span class="tcas-tooltip-text">').html($this.html());
					$layout.append($tooltip);

					if ($this.is(':selected')) {
						$layout.addClass(activeClass);
					}
				});

				$select.hide().after($wrap);
			});
		},

		iconSelectors: function ($context) {
			$context = $context || $(document);

			var $iconSelector = $('#tcas-icon-selector-container'),
				$searchField = $('.tcas-icon-selector-search > input'),
				$searchClear = $('.tcas-icon-selector-search > span'),
				$icons = $('.tcas-icon-option');

			$iconSelector.on('click', '.tcas-icon-option', function () {
				var icon = $(this).find('> span').data('icon') || '',
					newClass = icon;

				if (tcas.isFontAwesome(icon)) {
					newClass = 'fa ' + icon;
				} else if (tcas.isMixedIcon(icon)) {
					newClass = 'mix-ico ' + icon;
				} else {
					newClass = 'drk sml iconsprite ' + icon;
				}

				if (icon) {
					$iconSelector.siblings('.tcas-icon-selector-current').find('.tcas-choose-no-icon').show();
				}

				$iconSelector.siblings('input[type="hidden"]').val(icon).change();
				$iconSelector.siblings('.tcas-icon-selector-current').find('.tcas-chosen-icon').text('').attr('class', 'tcas-chosen-icon ' + newClass);

				$iconSelector.slideUp(function () {
					$searchClear.click();
					$iconSelector.removeClass('tcas-active');
					$iconSelector.appendTo($context);
				});
			});

			$context.on('click', '.tcas-icon-select-trigger', function () {
				var $trigger = $(this),
					$tp = $trigger.parent(),
					selectedIcon = $tp.siblings('input[type="hidden"]').val(),
					activeClass = 'tcas-icon-select-active';

				if (!$iconSelector.hasClass('tcas-active')) {
					$iconSelector.find('.' + activeClass).removeClass(activeClass);
					if (selectedIcon) {
						$iconSelector.find('.' + selectedIcon).parent().addClass(activeClass);
					}

					$tp.after($iconSelector.slideDown());
					$iconSelector.addClass('tcas-active');

					// Make sure all icons are visible
					$('.tcas-icon-subset-is, .tcas-icon-subset-fa, .tcas-icon-subset-mix').show();

					// Filter by subset (if any)
					if ($trigger.hasClass('tcas-only-subset-is')) {
						$('.tcas-icon-subset-fa').hide();
					}
					if ($trigger.hasClass('tcas-only-subset-fa')) {
						$('.tcas-icon-subset-is').hide();
					}
					if ($trigger.hasClass('tcas-only-subset-fonts')) {
						$('.tcas-icon-subset-is').hide();
					}
				} else {
					$iconSelector.slideUp(function () {
						$searchClear.click();
						$iconSelector.removeClass('tcas-active');
						$iconSelector.appendTo($context);
					});
				}
			});

			$context.on('click', '.tcas-choose-no-icon', function () {
				var $this = $(this).hide();
				$this.siblings('.tcas-chosen-icon').text(tcasL10n.noIconSelected).attr('class', 'tcas-chosen-icon tcas-no-icon');
				$this.parent().siblings('input[type="hidden"]').val('').change();

				if ($iconSelector.hasClass('tcas-active')) {
					$iconSelector.slideUp(function () {
						$searchClear.click();
						$iconSelector.removeClass('tcas-active');
						$iconSelector.appendTo($context);
					});
				}
			});

			$searchField.bind('keyup blur', function () {
				var search = $(this).val().toLowerCase();

				if (search) {
					$context.find('.tcas-icon-selector-search > span').fadeIn(200);
					$icons.each(function () {
						var $icon = $(this),
							icon = $icon.find('> span').data('icon'),
							iconSpaced = icon.replace(/-/g, ' ');

						if (icon.indexOf(search) > -1 || iconSpaced.indexOf(search) > -1) {
							$icon.show();
						} else {
							$icon.hide();
						}
					});
				} else {
					$icons.show();
					$context.find('.tcas-icon-selector-search > span').fadeOut(200);
				}
			});

			$searchClear.click(function () {
				$searchField.val('').blur();
			});
		},

		isFontAwesome: function (icon) {
			return /^fa-/.test(icon);
		},

		isMixedIcon: function (icon) {
			return /^icon-/.test(icon);
		},

		backgroundPositionSelectors: function ($context) {
			$context = $context || $(document);

			$('.tcas-bg-position-select', $context).each(function () {
				var $select = $(this),
					$options = $select.find('option'),
					activeClass = 'tcas-select-active',
					$wrap = $('<div class="tcas-bg-position-selector tcas-selector"/>'),
					$customWrap = $select.closest('.tcas-background-image-settings, .tcas-background-image-retina-settings').find('.tcas-image-position-custom').closest('.tcas-shortcode-inner-outer');

				$options.each(function () {
					var $this = $(this),
						value = $this.val(),
						imageLink = value.replace(' ', '-');

					var $layout = $('<div class="tcas-bg-position-option tcas-tooltip"/>').appendTo($wrap).click(function () {
						$wrap.find('> div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val(value).change();

						if (value === 'custom') {
							$customWrap.fadeIn();
						} else {
							$customWrap.hide();
						}
					})
					.append('<img src="' + tcasL10n.themeAdminUrl + '/images/' + (imageLink || 'default') + '.png" alt="" />')
					.data('position', value);

					var $tooltip = $('<span class="tcas-tooltip-text">').html($this.html());
					$layout.append($tooltip);

					if ($this.is(':selected')) {
						$layout.addClass(activeClass);
					}
				});

				if ($select.val() === 'custom') {
					$customWrap.show();
				} else {
					$customWrap.hide();
				}

				$select.hide().after($wrap);
			});
		},

		backgroundRepeatSelectors: function ($context) {
			$context = $context || $(document);

			$('.tcas-bg-repeat-select', $context).each(function () {
				var $select = $(this),
				$options = $select.find('option'),
				activeClass = 'tcas-select-active',
				$wrap = $('<div class="tcas-bg-repeat-selector tcas-selector"/>');

				$options.each(function () {
					var $this = $(this);

					var $layout = $('<div class="tcas-bg-repeat-option tcas-tooltip"/>').appendTo($wrap).click(function () {
						$wrap.find('> div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val($this.val()).change();
					})
					.append('<img src="' + tcasL10n.themeAdminUrl + '/images/' + ($this.val() || 'default') + '.png" alt="" />')
					.data('repeat', $this.val());

					var $tooltip = $('<span class="tcas-tooltip-text">').html($this.html());
					$layout.append($tooltip);

					if ($this.is(':selected')) {
						$layout.addClass(activeClass);
					}
				});

				$select.hide().after($wrap);
			});
		},

		rangeSliders: function ($context) {
			if (!$.isFunction($.fn.jslider)) {
				return;
			}

			$context = $context || $(document);

			$('.tcas-range-slider', $context).each(function () {
				var $this = $(this),
				defaults = {
					limits: false,
					skin: 'round_plastic',
					step: 1,
					dimension: 'px'
				},
				options = {
					from: $this.data('from'),
					to: $this.data('to'),
					step: $this.data('step'),
					dimension: $this.data('dimension')
				};

				$this.jslider($.extend({}, defaults, options));

				$this.bind('blur', function () {
					$this.jslider('value', $this.val());
				});
			});
		},

		tooltips: function () {
			if (!$.isFunction($.fn.qtip)) {
				return;
			}

			$(document).on('mouseover', '.tcas-tip-icon, .tcas-tooltip, .tcas-tooltip-wrap', function (event) {
				  var position = {
						my: 'bottom center',
						at: 'top center'
					},

					hide = {};

				if ($(this).is('.tcas-tip-html')) {
					hide = { event: 'unfocus' };
				}

				$(this).qtip({
					overwrite: false,
					content: {
						text: function (api) {
							return $(this).find('.tcas-tooltip-text').html();
						}
					},
					show: {
						event: event.type,
						ready: true
					},
					style: {
						classes: 'qtip-dark qtip-tcas',
						border: { color: '#000000' },
						tip: {
							color: 'false'
						}
					},
					position: position,
					hide: hide
				}, event);
			});
		},

		log: function () {
			if (window.console && console.log) {
				for (var i = 0; i < arguments.length; i++) {
					console.log(arguments[i]);
				}
			}
		},

		/**
		 * Make the given upload URL relative
		 *
		 * Strips the WP uploads URL from the start
		 *
		 * @param   {string}  url
		 * @return  {string}
		 */
		makeUploadUrlRelative: function (url)
		{
			return url.replace(new RegExp('^' + tcasL10n.uploadsUrl + '/', 'i'), '');
		},

		/**
		 * Ensures a JSON response from the server is in the expected format
		 *
		 * @param   {object}  response  The original response
		 * @return  {object}            The sanitised response
		 */
		sanitizeResponse: function (response) {
			if (response === null || typeof response !== 'object' || typeof response.type !== 'string' || response.type.length === 0) {
				response = {
					type: 'error',
					message: 'The response from the server was invalid or malformed'
				};
			}

			return response;
		},

		// Convert a form to a serialized object
		serializeObject: function ($form) {
			var o = {};
			var a = $form.serializeArray();

			$.each(a, function() {
				if (o[this.name]) {
					if (!o[this.name].push) {
						o[this.name] = [o[this.name]];
					}
					o[this.name].push(this.value || '');
				} else {
					o[this.name] = this.value || '';
				}
			});
			return o;
		}

	};
})(jQuery);
