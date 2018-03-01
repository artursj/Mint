/*
 * React Widget Settings JavaScript
 *
 * Copyright www.themecatcher.net
 * All rights reserved.
 */
;(function ($) {
	"use strict";

	window.tcaw = {

		tooltips: function () {
			if (!$.isFunction($.fn.qtip)) {
				return;
			}

			$(document).on('mouseover', '.tcaw-tip-icon, .tcaw-tooltip', function (event) {
				  var position = {
						my: 'bottom center',
						at: 'top center'
					},

					hide = {};

				if ($(this).is('.tcaw-tip-html')) {
					hide = { event: 'unfocus' };
				}

				$(this).qtip({
					overwrite: false,
					content: {
						text: function (api) {
							return $(this).find('.tcaw-tooltip-text').html();
						}
					},
					show: {
						event: event.type,
						ready: true
					},
					style: {
						classes: 'qtip-dark qtip-tcaw',
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

	$(document).ready(function () {

		var saving = false,
			$message = $('#tcaw-settings-saved');

		var onSaveSuccess = function () {
			$message.fadeIn(200).show(0, function () {
				setTimeout(function () {
					$message.fadeOut(350);
				}, 800);
			});
		};

		var onSaveError = function (message) {
			alert('An error occurred saving the settings:\n\n' + message);
			saving = false;
		};

		$('.tcaw-settings-save').click(function () {
			if (saving) {
				return;
			}

			saving = true;

			var settings = tcaw.serializeObject($('#tcaw-settings-form'));

			settings.tcaw_load_scripts_custom = [];
			$('#tcaw_load_scripts_custom :selected').each(function () {
				settings.tcaw_load_scripts_custom.push($(this).val());
			});

			settings.tcaw_disabled_styles = [];
			$('.tcaw-disabled-styles').each(function () {
				var $this = $(this);
				if ($this.is(':checked')) {
					settings.tcaw_disabled_styles.push($this.val());
				}
			});

			$.ajax({
				type: 'POST',
				url: tcawL10n.ajaxUrl,
				data: {
				   action: 'tcw_save_settings_ajax',
				   _ajax_nonce: tcawL10n.saveSettingsNonce,
				   options: settings
				},
				dataType: 'json'
			})
			.done(function (response) {
				response = tcaw.sanitizeResponse(response);

				if (response.type == 'success') {
					onSaveSuccess();
				} else {
					onSaveError(response.message);
				}
			})
			.fail(function () {
				onSaveError('Ajax error');
			})
			.always(function () {
				saving = false;
			});
		});

		var resetting = false;

		var onResetSuccess = function () {
			window.location.reload();
		};

		var onResetError = function (message) {
			alert('An error occurred resetting the settings:\n\n' + message);
		};

		$('.tcaw-settings-reset').click(function () {
			if (resetting || !confirm(tcawL10n.confirmResetSettings)) {
				return;
			}

			resetting = true;

			$.ajax({
				type: 'POST',
				url: tcawL10n.ajaxUrl,
				data: {
				   action: 'tcw_reset_settings_ajax',
				   _ajax_nonce: tcawL10n.resetSettingsNonce
				},
				dataType: 'json'
			})
			.done(function (response) {
				response = tcaw.sanitizeResponse(response);

				if (response.type == 'success') {
					onResetSuccess();
				} else {
					onResetError(response.message);
				}
			})
			.fail(function () {
				onResetError('Ajax error');
			})
			.always(function () {
				resetting = false;
			});
		});

		$('#tcaw_load_scripts').change(function () {
			$('#tcaw_load_scripts_custom').closest('.tcaw-setting')[$(this).val() == 'custom' ? 'slideDown' : 'slideUp']();
		});

		if ($('#tcaw_load_scripts').val() == 'custom') {
			$('#tcaw_load_scripts_custom').closest('.tcaw-setting').show();
		}

		if ($.isFunction($.fn.chosen)) {
			$('#tcaw_load_scripts_custom').chosen({ width: '410px' });
		}

		tcaw.tooltips();

	}); // End document.ready()

})(jQuery);
