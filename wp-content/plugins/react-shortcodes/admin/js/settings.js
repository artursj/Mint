/*
 * ThemeCatcher Shortcodes Settings JavaScript
 *
 * Copyright www.themecatcher.net
 * All rights reserved.
 */
;(function ($) {
	"use strict";

	$(document).ready(function () {

		var saving = false,
			$message = $('#tcas-settings-saved');

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

		$('.tcas-settings-save').click(function () {
			if (saving) {
				return;
			}

			saving = true;

			var settings = tcas.serializeObject($('#tcas-settings-form'));

			settings.tcas_load_scripts_custom = [];
			$('#tcas_load_scripts_custom :selected').each(function () {
				settings.tcas_load_scripts_custom.push($(this).val());
			});

			settings.tcas_disabled_styles = [];
			$('.tcas-disabled-styles').each(function () {
				var $this = $(this);
				if ($this.is(':checked')) {
					settings.tcas_disabled_styles.push($this.val());
				}
			});

			settings.tcas_disabled_scripts = [];
			$('.tcas-disabled-scripts').each(function () {
				var $this = $(this);
				if ($this.is(':checked')) {
					settings.tcas_disabled_scripts.push($this.val());
				}
			});

			$.ajax({
				type: 'POST',
				url: tcasL10n.ajaxUrl,
				data: {
				   action: 'tcs_save_settings_ajax',
				   _ajax_nonce: tcasL10n.saveSettingsNonce,
				   options: settings
				},
				dataType: 'json'
			})
			.done(function (response) {
				response = tcas.sanitizeResponse(response);

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

		$('.tcas-settings-reset').click(function () {
			if (resetting || !confirm(tcasL10n.confirmResetSettings)) {
				return;
			}

			resetting = true;

			$.ajax({
				type: 'POST',
				url: tcasL10n.ajaxUrl,
				data: {
				   action: 'tcs_reset_settings_ajax',
				   _ajax_nonce: tcasL10n.resetSettingsNonce
				},
				dataType: 'json'
			})
			.done(function (response) {
				response = tcas.sanitizeResponse(response);

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

		$('#tcas_load_scripts').change(function () {
			$('#tcas_load_scripts_custom').closest('.tcas-setting')[$(this).val() == 'custom' ? 'slideDown' : 'slideUp']();
		});

		if ($('#tcas_load_scripts').val() == 'custom') {
			$('#tcas_load_scripts_custom').closest('.tcas-setting').show();
		}

		if ($.isFunction($.fn.chosen)) {
			$('#tcas_load_scripts_custom').chosen({ width: '410px' });
		}

		tcas.tooltips();

	}); // End document.ready()

})(jQuery);
