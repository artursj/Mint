/*
 * jQuery ToggleSwitch plugin
 *
 * Version 1.2.1
 *
 * Turns HTML 3-state select or checkboxes into clickable buttons
 *
 * Copyright 2016 ThemeCatcher
 * http://www.themecatcher.net
 */
(function($) {
	$.fn.toggleSwitch = function(options) {
		options = $.extend({}, {
			onText: 'On',
			offText: 'Off',
			defaultText: 'Default',
			prefix: 'ts',
			selectOnValue: '1',
			selectOffValue: '0',
			selectDefaultValue: ''
		}, options);

		var prefix = options.prefix,
			onClass = prefix + '-state-on',
			offClass = prefix + '-state-off',
			defaultClass = prefix + '-state-default';

		return this.each(function() {
			var $field = $(this);

			if (!$field.data(prefix + '-processed')) {
				var type;

				if ($field.is(':checkbox')) {
					type = 'checkbox';
				} else if ($field.is('select')) {
					type = 'select';
				} else {
					return;
				}

				var $wrap = $('<div class="' + prefix + '-wrap">'),
					$buttonWrap = $('<div class="' + prefix + '-button-wrap">'),
					$button = $('<div class="' + prefix + '-button">');

				switch (type) {
					case 'checkbox':
						$field.data(prefix + '-processed', true).hide();

						if ($field.is(':checked')) {
							$buttonWrap.addClass(onClass);
							$button.text(options.onText);
						} else {
							$buttonWrap.addClass(offClass);
							$button.text(options.offText);
						}

						$field.on('click toggleswitch:update', function () {
							update();
						});

						var update = function() {
							if ($field.is(':checked')) {
								$buttonWrap.addClass(onClass).removeClass(offClass);
								$button.text(options.onText);
							} else {
								$buttonWrap.removeClass(onClass).addClass(offClass);
								$button.text(options.offText);
							}
						};

						$buttonWrap.append($button).appendTo($wrap).click(function () {
							$field.prop('checked', !$field.is(':checked')).trigger('change');
							update();
							return false;
						});
						break;
					case 'select':
						$field.data(prefix + '-processed', true).hide();

						var value = $field.find('option').filter(':selected').val();

						switch (value) {
							case options.selectOnValue:
								$buttonWrap.addClass(onClass);
								$button.text(options.onText);
								break;
							case options.selectOffValue:
								$buttonWrap.addClass(offClass);
								$button.text(options.offText);
								break;
							default:
								$buttonWrap.addClass(defaultClass);
								$button.text(options.defaultText);
								break;
						}

						$buttonWrap.append($button).appendTo($wrap).click(function() {
							switch (value) {
								case options.selectOnValue:
									$buttonWrap.removeClass(onClass + " " + defaultClass).addClass(offClass);
									$button.text(options.offText);
									value = options.selectOffValue;
									break;
								case options.selectOffValue:
									$buttonWrap.removeClass(offClass + " " + onClass).addClass(defaultClass);
									$button.text(options.defaultText);
									value = options.selectDefaultValue;
									break;
								case options.selectDefaultValue:
									$buttonWrap.removeClass(offClass + " " + defaultClass).addClass(onClass);
									$button.text(options.onText);
									value = options.selectOnValue;
									break;
							}

							$field.val(value).trigger('change');
						});
				}

				$field.after($wrap);
			}
		});
	};
})(jQuery);
