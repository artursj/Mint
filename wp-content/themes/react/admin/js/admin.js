/*
 * Theme Admin JavaScript
 *
 * Copyright www.themecatcher.net
 * All rights reserved.
 */
;(function ($, window) {
	// Fix for JSON.stringify if prototype.js is loaded
	if (typeof Array.prototype.toJSON == 'function') {
		delete Array.prototype.toJSON;
	}

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

	window.reactAdmin = {

		preloadedImages: [],

		/*
		 * Image preloader
		 *
		 * Usage: $.preloadImages([array of paths], 'common path prefix');
		 */
		preloadImages: function (images, prefix) {
			prefix = prefix ? prefix : '';

			for(var i = 0; i < images.length; i++){
				var image = new Image();
				image.src = prefix + images[i];
				reactAdmin.preloadedImages.push(image);
			}
		},

		// Default options for the media library browser
		imageMediaOptions: {
			title: reactAdminL10n.select_image,
			button: {
				text: reactAdminL10n.select
			},
			multiple: false,
			library: {
				type: 'image'
			}
		},

		audioMediaOptions: {
			title: reactAdminL10n.select_audio_track,
			button: {
				text: reactAdminL10n.select
			},
			multiple: false,
			library: {
				type: 'audio'
			}
		},

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
			$('.react-texture-select', $context).each(function () {
				var $select = $(this),
				$options = $select.find('option'),
				activeClass = 'react-select-active',
				$wrap = $('<div class="react-texture-selector react-selector"/>');

				$options.each(function () {
					var $this = $(this);

					var $layout = $('<div class="react-texture-option react-tooltip"/>').appendTo($wrap).click(function () {
						$wrap.find('> div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val($this.val()).change();
					})
					.append('<img src="' + reactAdminL10n.themeAdminUrl + '/images/textures/' + ($this.val() || 'default') + '.png" alt="" />')
					.data('texture', $this.val());

					var $tooltip = $('<span class="react-tooltip-text">').html($this.html());
					$layout.append($tooltip);

					if ($this.is(':selected')) {
						$layout.addClass(activeClass);
					}
				});

				$select.hide().after($wrap);
			});

			// Detail selector
			$('.react-detail-select', $context).each(function () {
				var $select = $(this),
				$options = $select.find('option'),
				activeClass = 'react-select-active',
				$wrap = $('<div class="react-detail-selector react-selector"/>');

				$options.each(function () {
					var $this = $(this);

					var $layout = $('<div class="react-detail-option react-tooltip"/>').appendTo($wrap).click(function () {
						$wrap.find('> div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val($this.val()).change();
					})
					.append('<img src="' + reactAdminL10n.themeAdminUrl + '/images/textures/' + ($this.val() || 'default') + '.png" alt="" />')
					.data('detail', $this.val());

					var $tooltip = $('<span class="react-tooltip-text">').html($this.html());
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

			var $iconSelector = $('#react-icon-selector-container'),
				$searchField = $('.react-icon-selector-search > input'),
				$searchClear = $('.react-icon-selector-search > span'),
				$icons = $('.react-icon-option');

			$iconSelector.on('click', '.react-icon-option', function () {
				var icon = $(this).find('> span').data('icon') || '',
					newClass = icon;

				if (reactAdmin.isFontAwesome(icon)) {
					newClass = 'fa ' + icon;
				} else if (reactAdmin.isMixedIcon(icon)) {
					newClass = 'mix-ico ' + icon;
				} else {
					newClass = 'drk sml iconsprite ' + icon;
				}

				if (icon) {
					$iconSelector.siblings('.react-icon-selector-current').find('.react-choose-no-icon').show();
				}

				$iconSelector.siblings('input[type="hidden"]').val(icon).change();
				$iconSelector.siblings('.react-icon-selector-current').find('.react-chosen-icon').text('').attr('class', 'react-chosen-icon ' + newClass);

				$iconSelector.slideUp(function () {
					$searchClear.click();
					$iconSelector.removeClass('react-active');
					$iconSelector.appendTo($context);
				});
			});

			$context.on('click', '.react-icon-select-trigger', function () {
				var $trigger = $(this),
					$tp = $trigger.parent(),
					selectedIcon = $tp.siblings('input[type="hidden"]').val(),
					activeClass = 'react-icon-select-active';

				if (!$iconSelector.hasClass('react-active')) {
					$iconSelector.find('.' + activeClass).removeClass(activeClass);
					if (selectedIcon) {
						$iconSelector.find('.' + selectedIcon).parent().addClass(activeClass);
					}

					$tp.after($iconSelector.slideDown());
					$iconSelector.addClass('react-active');

					// Make sure all icons are visible
					$('.react-icon-subset-is, .react-icon-subset-fa, .react-icon-subset-mix').show();

					// Filter by subset (if any)
					if ($trigger.hasClass('react-only-subset-is')) {
						$('.react-icon-subset-fa').hide();
					}
					if ($trigger.hasClass('react-only-subset-fa')) {
						$('.react-icon-subset-is').hide();
					}
					if ($trigger.hasClass('react-only-subset-fonts')) {
						$('.react-icon-subset-is').hide();
					}
				} else {
					$iconSelector.slideUp(function () {
						$searchClear.click();
						$iconSelector.removeClass('react-active');
						$iconSelector.appendTo($context);
					});
				}
			});

			$context.on('click', '.react-choose-no-icon', function () {
				var $this = $(this).hide();
				$this.siblings('.react-chosen-icon').text(reactAdminL10n.no_icon_selected).attr('class', 'react-chosen-icon react-no-icon');
				$this.parent().siblings('input[type="hidden"]').val('').change();

				if ($iconSelector.hasClass('react-active')) {
					$iconSelector.slideUp(function () {
						$searchClear.click();
						$iconSelector.removeClass('react-active');
						$iconSelector.appendTo($context);
					});
				}
			});

			$searchField.bind('keyup blur', function () {
				var search = $(this).val().toLowerCase();

				if (search) {
					$context.find('.react-icon-selector-search > span').fadeIn(200);
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
					$context.find('.react-icon-selector-search > span').fadeOut(200);
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

		accordion: function ($context) {
			$context = $context || $(document);

			$('.react-accordion', $context).each(function () {
				var $root = $(this),
				$trigger = $root.find('> .react-accordion-trigger');
				$trigger.prepend('<span class="react-acc-icon"/>');

				if ($root.hasClass('react-toggle')) {
					$trigger.click(function () {
						var $this = $(this);

						if ($this.hasClass('active')) {
							$this.next().slideUp(400, function () {
								$this.removeClass('active');
							});
						} else {
							$this.addClass('active');
							$this.next().slideDown(400);
						}
					});
				} else {
					$trigger.click(function (e) {
						var $this = $(this);
						if ($this.next().is(':hidden')) {
							$trigger.removeClass('active').next().slideUp();
							$this.toggleClass('active').next().slideDown();
						}
					});
				}
			});
		},

		backgroundPositionSelectors: function ($context) {
			$context = $context || $(document);

			$('.react-bg-position-select', $context).each(function () {
				var $select = $(this),
					$options = $select.find('option'),
					activeClass = 'react-select-active',
					$wrap = $('<div class="react-bg-position-selector react-selector"/>'),
					$customWrap = $select.closest('.react-background-image-settings, .react-background-image-retina-settings').find('.react-image-position-custom').closest('.react-multi-input-wrap, .react-meta-multi-outer');

				$options.each(function () {
					var $this = $(this),
						value = $this.val(),
						imageLink = value.replace(' ', '-');

					var $layout = $('<div class="react-bg-position-option react-tooltip"/>').appendTo($wrap).click(function () {
						$wrap.find('> div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val(value).change();

						if (value === 'custom') {
							$customWrap.fadeIn();
						} else {
							$customWrap.hide();
						}
					})
					.append('<img src="' + reactAdminL10n.themeAdminUrl + '/images/' + (imageLink || 'default') + '.png" alt="" />')
					.data('position', value);

					var $tooltip = $('<span class="react-tooltip-text">').html($this.html());
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

			$('.react-bg-repeat-select', $context).each(function () {
				var $select = $(this),
				$options = $select.find('option'),
				activeClass = 'react-select-active',
				$wrap = $('<div class="react-bg-repeat-selector react-selector"/>');

				$options.each(function () {
					var $this = $(this);

					var $layout = $('<div class="react-bg-repeat-option"/>').appendTo($wrap).click(function () {
						$wrap.find('> div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val($this.val()).change();
					})
					.append('<img src="' + reactAdminL10n.themeAdminUrl + '/images/' + ($this.val() || 'default') + '.png" alt="" />')
					.data('repeat', $this.val());

					var $tooltip = $('<span class="react-tooltip-text">').html($this.html());
					$layout.append($tooltip);

					if ($this.is(':selected')) {
						$layout.addClass(activeClass);
					}
				});

				$select.hide().after($wrap);
			});
		},

		rangeSliders: function ($context) {
			$context = $context || $(document);

			$('.react-range-slider', $context).each(function () {
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

		log: function () {
			if (window.console && console.log) {
				for (var i = 0; i < arguments.length; i++) {
					console.log(arguments[i]);
				}
			}
		},

		/**
		 * Handle the change of image URL on an upload field
		 *
		 * @param   {jQuery}  $sourceField       The source field
		 * @param   {jQuery}  $thumbnailWrapper  The thumbnail wrapper
		 * @param   {jQuery}  $imageWidthField   The width field (optional)
		 * @param   {jQuery}  $imageHeightField  The height field (optional)
		 */
		handleImageUploadSourceChange: function($sourceField, $thumbnailWrapper, $imageWidthField, $imageHeightField)
		{
			var url = $sourceField.val();

			if ($sourceField.data('url') === url) {
				return;
			}

			$sourceField.data('url', url);
			$thumbnailWrapper.empty();

			if (url.length === 0) {
				if (typeof $imageWidthField !== 'undefined') {
					$imageWidthField.val('');
				}
				if (typeof $imageHeightField !== 'undefined') {
					$imageHeightField.val('');
				}
				return;
			}

			var $img = $('<img/>'),
				$div = $(reactAdminL10n.uploadThumbnailHtml).hide().prepend($img);

			reactAdmin.getUploadThumbnailUrl(url).done(function (newUrl) {
				$img.load(function () {
					$img.unbind('load');
					$thumbnailWrapper.html($div);
					$div.fadeIn('slow');
				})
				.attr('src', newUrl);
			});
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
			return url.replace(new RegExp('^' + reactAdminL10n.uploadsUrl + '/', 'i'), '');
		},

		/**
		 * Get the thumbnail URL of an uploaded image
		 *
		 * If the path starts with http(s):// or //, it will be returned
		 * If the path starts with / the site URL will be prepended
		 * If the path is relative, the WP uploads URL will be prepended
		 *
		 * @param   {string}  url
		 * @return  {string}
		 */
		getUploadThumbnailUrl: function (url) {
			var d = $.Deferred();

			var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
			url = url.replace(rtrim, '');

			if (/^(http(s)?:\/\/|\/\/)/i.test(url)) { // Matches http(s):// and //
				d.resolve(url);
			} else if (url.charAt(0) === '/') {
				d.resolve(reactAdminL10n.siteUrl + url);
			} else {
				$.ajax({
					url: reactAdminL10n.ajaxUrl,
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'react_ajax_get_upload_thumbnail_url',
						url: url
					}
				})
				.done(function (response) {
					if (typeof response === 'object' && typeof response.type === 'string' && response.type === 'success') {
						d.resolve(response.url);
					} else {
						d.reject();
					}
				})
				.fail(d.reject);
			}

			return d.promise();
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
		}
	};

	$(document).ready(function () {
		$(document).on('click', '.react-external-link', function () {
			var href = $(this).attr('href');
			if (href) {
				window.open(href);
				return false;
			}
		});


		if ($('#react-sucess-message, .react-sucess-message').is(':visible')) {
			$('body').addClass('react-success-on');
		}

		if ($('.update-nag').is(':visible')) {
			$('body').addClass('react-ud-on');
		}

		// Tooltips
		$(document).on('mouseover', '.react-tooltip-wrap, .react-tip-icon, .react-tooltip', function (event) {
			  var position = {
					my: 'bottom center',
					at: 'top center'
				},

				hide = {};

			if ($(this).is('.react-tip-html')) {
				hide = { event: 'unfocus' };
			}

			if ($(this).is('.react-facebook, .react-twitter, .react-support, .react-youtube, .react-tc-visit')) {
				position = {
					  my: 'bottom left',
					  at: 'top right'
				};
			}

			$(this).qtip({
				overwrite: false,
				content: {
					text: function () {
						return $(this).find('.react-tooltip-text').html();
					}
				},
				show: {
					event: event.type,
					ready: true
				},
				style: {
					classes: 'qtip-dark qtip-op',
					border: { color: '#000000' },
					tip: {
						color: 'false'
					}
				},
				position: position,
				hide: hide
			}, event);
		});
	});

	$(window).load(function () {
		// Image preloading
		reactAdmin.preloadImages([
			 '/images/default-loading.gif',
			 '/images/button-grey.png',
			 '/images/button-grey-hover.png',
			 '/images/button-blue-hover.png',
			 '/images/button-orange.png',
			 '/images/button-orange-hover.png',
			 '/images/add-icon-for-orange-button.png',
			 '/images/button-light-hover.png',
			 '/images/icons/book1.png',
			 '/images/warning-icon.png',
			 '/images/icons/list1.png',
			 '/images/icons/globe1.png',
			 '/images/icons/screen1.png',
			 '/images/icons/megaphone1.png',
			 '/images/icons/feet1.png',
			 '/images/icons/settings1.png',
			 '/images/icons/phone1.png',
			 '/images/icons/images1.png',
			 '/images/icons/speach1.png',
			 '/images/icons/layout1.png',
			 '/images/icons/signsub1.png',
			 '/images/icons/page1.png',
			 '/images/icons/brush1.png',
			 '/images/icons/pie-chart1.png',
			 '/images/icons/image1.png',
			 '/images/icons/sound1.png',
			 '/images/icons/movie1.png',
			 '/images/icons/fancy-brush1.png',
			 '/images/icons/cog1.png',
			 '/images/icons/fullscreen1.png',
			 '/images/icons/export1.png',
			 '/images/icons/import1.png',
			 '/images/icons/phonesub1.png',
			 '/images/icons/translation1.png',
			 '/images/icons/plug1.png',
			 '/images/icons/font1.png',
			 '/images/small-delete-round.png',
			 '/images/20-light-transp.png',
			 '/images/plain-light-50.png',
			 '/images/delete-bg.png',
			 '/images/delete-bg-hover.png',
			 '/images/settings-bg.png',
			 '/images/settings-bg-hover.png',
			 '/images/transparent-bg.png',
			 '/images/20-dark-transp.png',
			 '/images/success.png',
			 '/images/icons/headphones.png',
			 '/images/icons/music-move.png',
			 '/images/icons/music-move1.png',
			 '/images/icons/music-delete.png',
			 '/images/icons/music-delete1.png',
			 '/images/icons/music-edit.png',
			 '/images/icons/music-edit1.png',
			 '/images/pop-up-close.png',
			 '/images/pop-up-add.png',
			 '/images/pop-up-add-close.png',
			 '/images/pop-up-save.png',
			 '/images/color-wheel.png',
			 '/images/right-on.png',
			 '/images/left-on.png',
			 '/images/right-on1.png',
			 '/images/left-on1.png',
			 '/images/left-off.png',
			 '/images/right-off.png',
			 '/images/left-off1.png',
			 '/images/right-off1.png',
			 '/images/right-default.png',
			 '/images/left-default1.png',
			 '/images/right-default1.png',
			 '/images/jslider.round.plastic.png'
		 ], reactAdminL10n.themeAdminUrl);
	}); // End window.load
})(jQuery, window);