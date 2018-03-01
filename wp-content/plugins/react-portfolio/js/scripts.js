;(function($) {
	"use strict";

	$(document).ready(function () {
		var $doc = $(document);

		$('.tcp-portfolio-item .tcp-featured-image-link').not('.tcp-portfolio-item-type-portfolio .tcp-featured-image-link').each(function () {
			var $link = $(this),
				$hover = $('<span class="tcp-portfolio-hover"><span class="tcp-zoom"><i class="tcp-lgt tcp-iconsprite"></i></span></span>').css({ opacity: 0, display: 'block' });

			$link.find('.tcp-portfolio-hover').remove();
			$link.append($hover);
		});

		var portfolioZoomMouseEnter = function ($hover) {
			$hover.stop().fadeTo(1000, 0.6);
		},
		portfolioZoomMouseLeave = function ($hover) {
			$hover.stop().fadeTo(800, 0.0);
		};

		$doc.on('mouseenter', '.tcp-portfolio-hover', function () {
			portfolioZoomMouseEnter($(this));
		});

		$doc.on('mouseleave', '.tcp-portfolio-hover', function () {
			portfolioZoomMouseLeave($(this));
		});

		$doc.on('mouseenter', '.tcp-portfolio-item-image-on-hover .tcp-portfolio-details', function () {
			portfolioZoomMouseEnter($(this).closest('.tcp-portfolio-item').find('.tcp-portfolio-hover'));
		});

		$doc.on('mouseleave', '.tcp-portfolio-item-image-on-hover .tcp-portfolio-details', function () {
			portfolioZoomMouseLeave($(this).closest('.tcp-portfolio-item').find('.tcp-portfolio-hover'));
		});

		$doc.on('mouseenter', '.tcp-portfolio-item-image-on-hover .tcp-portfolio-hover, .tcp-portfolio-item-image-on-hover .tcp-portfolio-details', function () {
			var $item = $(this).closest('.tcp-portfolio-item'),
				$image = $item.find('.tcp-featured-image-wrap'),
				$details = $item.find('.tcp-portfolio-details'),
				$zoom = $image.find('.tcp-portfolio-hover .tcp-zoom'),
				heightOfZoomArea = $image.outerHeight(true) - $details.outerHeight(true),
				zoomTop = heightOfZoomArea / 2;

			$zoom.css({ top: zoomTop + 'px' });
		});

		$('.tcp-lightbox').each(function () {
			var href = $(this).attr('href');

			if (href.match(/vimeo\.com/i)) {
				if (href.match(/http(s)?:\/\/(www\.)?vimeo\.com/i)) {
					$(this).attr('href', href.replace(/(www\.)?vimeo.com/, 'player.vimeo.com/video'));
				}
				$(this).removeClass('tcp-lightbox')
					   .addClass('tcp-lightbox-video');
			} else if (href.match(/youtu/i)) {
				if (href.match(/youtu.be\//i)) {
					href = href.replace(/youtu.be\//i, 'www.youtube.com/watch?v=');
				}

				if (href.match(/youtube\.com\/watch/i)) {
					href = href.replace(/watch\?v=/i, 'embed/');
					var params = [];

					// Set to autoplay
					if (!href.match(/autoplay=/)) {
						params.push('autoplay=1');
					}

					// Set fullscreen active
					if (!href.match(/fs=/)) {
						params.push('fs=1');
					}

					if (href.match(/&/)) {
						href = href.replace(/&/, '?');
						href += '&';
					} else {
						href += '?';
					}

					params.push('wmode=transparent');

					href += params.join('&');

					$(this).attr('href', href);
				}
				$(this).removeClass('tcp-lightbox').addClass('tcp-lightbox-video');
			} else if (href.match(/\b.swf\b/i)) {
				$(this).removeClass('tcp-lightbox').addClass('tcp-lightbox-swf');
			}
		});

		if ($.isFunction($.fn.fancybox)) {
			// Normal lightbox
			$('.tcp-lightbox').fancybox({
				openEffect: 'elastic',
				closeEffect: 'elastic',
				prevEffect: 'fade',
				nextEffect: 'fade',
				padding: 0,
				beforeShow: function () {
					var captionId = $(this.group[this.index].element).data('portfolio-caption'),
					caption = $(captionId).html() || '',
					output = '';

					if (caption.length && this.helpers.title.type == 'over') {
						output += '<div class="fancybox-title-over">' + caption + '</div>';
					}

					this.title = output;
				},
				helpers : {
					title: {
						type: 'over'
					}
				}
			});

			// Swf lightbox
			$('.tcp-lightbox-swf').fancybox({
				openEffect: 'elastic',
				closeEffect: 'fade',  // elastic is not good here
				prevEffect: 'fade',
				nextEffect: 'fade',
				padding: 0,
				type: 'swf',
				width: 640,
				height: 385,
				beforeLoad: function () {
					var dataWidth = parseInt(this.element.data('fancybox-width'), 10),
						dataHeight = parseInt(this.element.data('fancybox-height'), 10);

					if (dataWidth) {
						this.width = dataWidth;
					}

					if (dataHeight) {
						this.height = dataHeight;
					}
				}
			});

			// Video lightbox (iframe - Vimeo, YouTube etc)
			$('.tcp-lightbox-video').fancybox({
				openEffect: 'elastic',
				closeEffect: 'fade',  // elastic is not good here
				prevEffect: 'fade',
				nextEffect: 'fade',
				padding: 0,
				type: 'iframe',
				width: 640,
				height: 360,
				wrapCSS: 'tcp-fancybox-video',
				beforeLoad: function () {
					var dataWidth = parseInt(this.element.data('fancybox-width'), 10),
						dataHeight = parseInt(this.element.data('fancybox-height'), 10);

					if (dataWidth) {
						this.width = dataWidth;
					}

					if (dataHeight) {
						this.height = dataHeight;
					}
				}
			});
		}

		if ($.isFunction($.fn.serene)) {
			$('.tcp-serene').each(function () {
				var $this = $(this),
				options = $this.data('options') || {};

				$this.serene($.extend({}, tcpL10n.sereneOptions, options));
			});
		}

		// Simple - but not perfect - detection for touch devices
		var hasTouchEvents = (('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0));

		if (hasTouchEvents) {
			$('.tcp-portfolio').addClass('tcp-touchevents');
		}
	});

	$(window).load(function () {
		if ($.isFunction($.fn.isotope)) {
			$('.tcp-portfolio').each(function () {
				// Portfolio Isotope
				var $portfolio = $(this),
					$portfolioItems = $portfolio.find('.tcp-portfolio-items'),
					$portfolioFilter = $portfolio.find('.tcp-portfolio-filter'),
					portfolioOptions = $portfolio.data('options') || {};

				$portfolioItems.isotope({
					itemSelector: '.tcp-portfolio-item',
					layoutMode: portfolioOptions.masonry_layout || 'masonry',
					transitionDuration: '0.8s'
				}).isotope('on', 'layoutComplete', function () {
					$(document).trigger('react-check-animations');
				});

				if (portfolioOptions.sortable == '1' && $portfolioFilter.length) {
					var $portfolioFilterButtons = $portfolioFilter.find('.tcp-filter-button');

					$portfolioFilterButtons.click(function () {
						var $clicked = $(this),
							filter = '' + $clicked.data('filter'),
							$filteredData;

						$portfolioFilterButtons.removeClass('tcp-active-filter');

						if (filter == 'all') {
							$portfolioItems.isotope({ filter: '*' });
						} else {
							$portfolioItems.isotope({ filter: function () {
								var types = '' + $(this).data('types');
								types = types.split(',');
								return $.inArray(filter, types) > -1;
							}});
						}

						$clicked.addClass('tcp-active-filter');
						return false;
					});

					// Set the default active filter
					$portfolioFilter.find('.tcp-active-filter').not('[data-filter="all"]').click();
				}
			});
		}
	});
})(jQuery);