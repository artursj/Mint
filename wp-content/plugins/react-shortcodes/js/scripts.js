/**
 * ThemeCatcher Shortcodes
 * http://www.themecatcher.net
 */
;(function($) {
	"use strict";

	// Refresh iframes and portfolios inside the given root element
	var refreshIframes = function ($root) {
		$root.find('iframe').each(function () {
			var $frame = $(this);
			if (!$frame.data('tcs-iframe-refreshed') && $frame.is(':visible')) {
				$frame.css({ opacity: 0 }).attr('src', $frame.attr('src')).data('tcs-iframe-refreshed', true).on('load', function () {
					$(this).animate({ opacity: 1 });
				});
			}
		});

		if ($.isFunction($.fn.isotope)) {
			$root.find('.tcp-portfolio-items').each(function () {
				$(this).isotope('layout');
			});
		}
	};

	$(document).ready(function () {
		$('.tcs-accordion-content-wrap:last-child').addClass('last-child');

		// Drop content (buttons)
		$('.tcs-has-drop .tcs-open-drop-trigger').click(function() {
			var $parent = $(this).closest('.tcs-has-drop').toggleClass('active');
			$parent.find('.tcs-drop-content').toggleClass('active');
			$parent.find('.tcs-drop-close').fadeToggle(300);
			return false;
		});

		$('.tcs-has-drop .tcs-drop-close').click(function() {
			var $this = $(this),
				$parent = $this.closest('.tcs-has-drop').removeClass('active');
			$parent.find('.tcs-drop-content').removeClass('active');
			$this.fadeOut(300).removeClass('active');
			return false;
		});

		if ($.isFunction($.fn.fptabs)) {
			// Slide up / slide down effect
			$.tools.tabs.addEffect('slide-slide',function(tabIndex, done) {
				this.getPanes().slideUp(400).eq(tabIndex).delay(400).slideDown(400, done);
			});

			// Tabs
			$('.tcs-tabs').each(function () {
				var $root = $(this);

				$root.fptabs('.tcs-tab-content', {
					tabs: '> .tcs-tabs-nav > li',
					current: 'tcs-active',
					effect: $root.hasClass('tcs-sliding') ? 'slide-slide' : 'default'
				});

				// Refresh iframes inside hidden tabs (just for Google maps really)
				$root.data('tabs').onClick(function () {
					refreshIframes(this.getCurrentPane());
				});
			});
		}

		// Accordion & toggles
		$('.tcs-accordion').each(function () {
			var $root = $(this),

			$triggers = $root.find('> h3').prepend('<span class="tcs-acc-icon"><i class="fa fa-angle-down"></i></span>');

			if ($root.hasClass('tcs-toggle')) {
				$triggers.click(function () {
					var $trigger = $(this),
						$content = $trigger.next();

					if ($trigger.hasClass('tcs-active')) {
						$content.slideUp(400, function () {
							$trigger.removeClass('tcs-active');
						});
					} else {
						$trigger.addClass('tcs-active');
						$content.slideDown(400, function () {
							refreshIframes($content);
						});
					}
				});
			} else {
				$triggers.click(function (e) {
					var $trigger = $(this),
						$content = $trigger.next();

					if ($content.is(':hidden')) {
						$triggers.removeClass('tcs-active').next().slideUp();

						$trigger.toggleClass('tcs-active');
						$content.slideDown(400, function () {
							refreshIframes($content);
						});
					} else {
						$trigger.removeClass('tcs-active');
						$content.slideUp();
					}
				});
			}

			$root.find('.tcs-acc-open').prev().click();
		});

		if ($.isFunction($.fn.fancybox)) {
			// Impact header button to lightbox
			$('.tcs-impact-header a[href="#lightbox"]').click(function () {
				$(this).closest('.tcs-impact-header').find('.tcs-lightbox-trigger').click();
				return false;
			});

			$('.tcs-lightbox-trigger').each(function () {
				var $trigger = $(this),
					options = $trigger.data('options') || {},
					openOnLoad = options.openOnLoad;

				delete options.openOnLoad;

				$trigger.fancybox(options);

				if (openOnLoad) {
					$(window).load(function () {
						$trigger.click();
					});
				}
			});
		}
	});

	$(window).load(function () {
		if ($.isFunction($.fn.owlCarousel)) {
			$('.tcs-cycle').each(function () {
				var $root = $(this),
					$slidesWrap = $root.find('.tcs-cycle-slides'),
					$next = $root.find('.tcs-cycle-forward'),
					$prev = $root.find('.tcs-cycle-backward'),
					options = $root.data('options') || {};

				if ($slidesWrap.children().length) {
					var $owl = $slidesWrap.owlCarousel($.extend({}, {
						items: 1
					}, options));

					if ($next.length) {
						$next.click(function (e) {
							e.preventDefault();
							$owl.trigger('next.owl.carousel');
						})[0].onselectstart = function () { return false; }; // Prevent double click selection
					}

					if ($prev.length) {
						$prev.click(function (e) {
							e.preventDefault();
							$owl.trigger('prev.owl.carousel');
						})[0].onselectstart = function () { return false; }; // Prevent double click selection
					}
				}
			});

			var $carousels = $('.tcs-image-carousel');
			if ($carousels.length) {
				$carousels.each(function () {
					var $root = $(this),
						$parent = $root.parent(),
						$next = $parent.find('.tcs-carousel-next'),
						$prev = $parent.find('.tcs-carousel-prev'),
						options = $root.data('options') || {};

					var $owl = $root.owlCarousel(options);

					if ($next.length) {
						$next.click(function (e) {
							e.preventDefault();
							$owl.trigger('next.owl.carousel');
						})[0].onselectstart = function () { return false; }; // Prevent double click selection
					}

					if ($prev.length) {
						$prev.click(function (e) {
							e.preventDefault();
							$owl.trigger('prev.owl.carousel');
						})[0].onselectstart = function () { return false; }; // Prevent double click selection
					}
				});
			}
		}
	});

})(jQuery, window);