/*
 * ThemeCatcher Portfolio Settings JavaScript
 *
 * Copyright www.themecatcher.net
 * All rights reserved.
 */
;(function ($) {
	"use strict";

	$(document).ready(function () {

		var saving = false,
			$message = $('#tcap-settings-saved');

		var onSaveSuccess = function (flush) {
			$message.fadeIn(200).show(0, function () {
				setTimeout(function () {
					$message.fadeOut(350);
				}, 800);
			});

			if (flush) {
				$.ajax({
					type: 'POST',
					url: tcapL10n.ajaxUrl,
					data: {
						action: 'tcp_flush_rewrite_rules_ajax'
					}
				});
			}
		};

		var onSaveError = function (message) {
			alert('An error occurred saving the settings:\n\n' + message);
		};

		$('.tcap-settings-save').click(function () {
			if (saving) {
				return;
			}

			saving = true;

			var settings = tcap.serializeObject($('#tcap-settings-form'));

			settings.tcap_load_scripts_custom = [];
			$('#tcap_load_scripts_custom :selected').each(function () {
				settings.tcap_load_scripts_custom.push($(this).val());
			});

			settings.tcap_disabled_styles = [];
			$('.tcap-disabled-styles').each(function () {
				var $this = $(this);
				if ($this.is(':checked')) {
					settings.tcap_disabled_styles.push($this.val());
				}
			});

			settings.tcap_disabled_scripts = [];
			$('.tcap-disabled-scripts').each(function () {
				var $this = $(this);
				if ($this.is(':checked')) {
					settings.tcap_disabled_scripts.push($this.val());
				}
			});

			$.ajax({
				type: 'POST',
				url: tcapL10n.ajaxUrl,
				data: {
				   action: 'tcp_save_settings_ajax',
				   _ajax_nonce: tcapL10n.saveSettingsNonce,
				   options: settings
				},
				dataType: 'json'
			})
			.done(function (response) {
				response = tcap.sanitizeResponse(response);

				if (response.type == 'success') {
					onSaveSuccess(response.flush);
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

		var onResetSuccess = function (flush) {
			if (flush) {
				$.ajax({
					type: 'POST',
					url: tcapL10n.ajaxUrl,
					data: {
						action: 'tcp_flush_rewrite_rules_ajax'
					}
				})
				.always(function () {
					window.location.reload();
				});
			} else {
				window.location.reload();
			}
		};

		var onResetError = function (message) {
			alert('An error occurred resetting the settings:\n\n' + message);
		};

		$('.tcap-settings-reset').click(function () {
			if (resetting || !confirm(tcapL10n.confirmResetSettings)) {
				return;
			}

			resetting = true;

			$.ajax({
				type: 'POST',
				url: tcapL10n.ajaxUrl,
				data: {
				   action: 'tcp_reset_settings_ajax',
				   _ajax_nonce: tcapL10n.resetSettingsNonce
				},
				dataType: 'json'
			})
			.done(function (response) {
				response = tcap.sanitizeResponse(response);

				if (response.type == 'success') {
					onResetSuccess(response.flush);
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

		$('#tcap_load_scripts').change(function () {
			$('#tcap_load_scripts_custom').closest('.tcap-setting')[$(this).val() == 'custom' ? 'slideDown' : 'slideUp']();
		});

		if ($('#tcap_load_scripts').val() == 'custom') {
			$('#tcap_load_scripts_custom').closest('.tcap-setting').show();
		}

		if ($.isFunction($.fn.chosen)) {
			$('#tcap_load_scripts_custom').chosen({ width: '410px' });
		}

		tcap.tooltips();

	}); // End document.ready()

})(jQuery);
