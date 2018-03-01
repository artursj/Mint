/*
 * ThemeCatcher Portfolio Admin JavaScript
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

	window.tcap = {
		// Default options for the media library browser
		imageMediaOptions: {
			title: tcapL10n.selectImage,
			button: {
				text: tcapL10n.select
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

		rangeSliders: function ($context) {
			if (!$.isFunction($.fn.jslider)) {
				return;
			}

			$context = $context || $(document);

			$('.tcap-range-slider', $context).each(function () {
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

			$(document).on('mouseover', '.tcap-tip-icon, .tcap-tooltip, .tcap-tooltip-wrap', function (event) {
				  var position = {
						my: 'bottom center',
						at: 'top center'
					},

					hide = {};

				if ($(this).is('.tcap-tip-html')) {
					hide = { event: 'unfocus' };
				}

				$(this).qtip({
					overwrite: false,
					content: {
						text: function (api) {
							return $(this).find('.tcap-tooltip-text').html();
						}
					},
					show: {
						event: event.type,
						ready: true
					},
					style: {
						classes: 'qtip-dark qtip-tcap',
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
			return url.replace(new RegExp('^' + tcapL10n.uploadsUrl + '/', 'i'), '');
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
