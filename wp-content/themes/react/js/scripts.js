/*
 * Image preloader
 *
 * Usage: $.preloadImages([array of paths], 'common path prefix');
 */
(function(b){b.preloadImages=function(d,a){for(a=a?a:"",b=[],c=0;c<d.length;c++){var e=new Image();e.src=a+d[c];b.push(e);}};})(jQuery);

/**
 * Refresh iframes inside the given root element
 */
(function($){
	"use strict";
	$.refreshIframes = function ($root) {
		$root.find('iframe').each(function () {
			var $frame = $(this);
			if (!$frame.data('react-map-fixed') && $frame.is(':visible')) {
				$frame.css({ opacity: 0 }).attr('src', $frame.attr('src')).data('react-map-fixed', true).on('load', function () {
					$(this).animate({ opacity: 1 });
				});
			}
		});
	};
})(jQuery);

;(function($, window) {
	"use strict";

	// Shared vars/functions
	var animationsEnabled = true,
		viewport = {w: 0, h: 0},
		$animations,
		$body,
		$window,
		$header,
		$headerAll,
		animateFunc,
		adminBar;

	var rollovers = function (context) {
		// Create the gallery rollover effect
		if (!context) context = document;

		$('div.product div.images a.lightbox', context).each(function () {
			var $link = $(this),
				$hover = $('<span class="react-woo-image-hover"><span class="zoom"><i class="lgt iconsprite"></i></span></span>').css({ opacity: 0, display: 'block' });

			$link.find('.react-woo-image-hover').remove();
			$link.append($hover);
		});
	};

	// Fancybox palette class
	if ($.isFunction($.fancybox) && typeof $.fancybox.defaults === 'object') {
		$.fancybox.defaults.wrapCSS = reactL10n.fancybox_palette;
	}

	// Set up lightboxes
	var lightboxes = function (context) {
		if (!context) context = document;

		$('.lightbox', context).each(function () {
			var href = $(this).attr('href');

			if (href.match(/vimeo\.com/i)) {
				if (href.match(/http(s)?:\/\/(www\.)?vimeo\.com/i)) {
					$(this).attr('href', href.replace(/(www\.)?vimeo.com/, 'player.vimeo.com/video'));
				}
				$(this).removeClass('lightbox')
					   .addClass('lightbox-video');
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
				$(this).removeClass('lightbox').addClass('lightbox-video');
			} else if (href.match(/\b.swf\b/i)) {
				$(this).removeClass('lightbox').addClass('lightbox-swf');
			}
		});

		if ($.isFunction($.fn.fancybox)) {
			// Normal lightbox
			$('.lightbox', context).fancybox({
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
			$('.lightbox-swf', context).fancybox({
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

			// Featured images
			$('.content-style > main > .featured-image-helper a.featured-image-link', context).fancybox({
				openEffect: 'elastic',
				closeEffect: 'fade',  // elastic is not good here
				prevEffect: 'fade',
				nextEffect: 'fade',
				padding: 0,
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
			$('.lightbox-video', context).fancybox({
				openEffect: 'elastic',
				closeEffect: 'fade',  // elastic is not good here
				prevEffect: 'fade',
				nextEffect: 'fade',
				padding: 0,
				type: 'iframe',
				width: 640,
				height: 360,
				wrapCSS: 'react-fancybox-video',
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
	};

	var animEndEventNames = {
		'WebkitAnimation' : 'webkitAnimationEnd',
		'MozAnimation'    : 'animationend',
		'OAnimation'      : 'oAnimationEnd',
		'msAnimation'     : 'MSAnimationEnd',
		'animation'       : 'animationend'
	},
	animEndEventName = animEndEventNames[ Modernizr.prefixed('animation') ];

	var checkingAnimations = false;
	var checkAnimations = function () {
		if (checkingAnimations) {
			return;
		}
		checkingAnimations = true;

		$animations.each(function () {
			var $this = $(this),
				offset = $this.data('animation-offset') || 0;

			if ($.inY($this[0], offset)) {
				var animation = $this.data('animation'),
					isOutAnimation = $this.hasClass('has-out-animation'),
					isPage = $this.is('#page'),
					delay = $this.data('animation-delay') || 0;

				$animations = $animations.not($this);

				setTimeout(function () {
					if (animation) {
						if (!isPage) {
							$this.removeClass('has-animation');
						}

						$this.addClass('animated ' + animation).one(animEndEventName, function () {
							if (isOutAnimation) {
								$this.addClass('out-animation-ended');
							}

							if (isPage) {
								$this.removeClass('has-animation');
							}

							$this.removeClass('animated has-out-animation ' + animation);
						});
					}
				}, delay);
			}
		});

		checkingAnimations = false;
	};

	var getViewportDimensions = function () {
		var dims = { w: 0, h: 0 };

		// IE
		if (typeof( window.innerWidth ) != 'number') {
			if (document.documentElement.clientWidth !== 0) {
				// strict mode
				dims.w = document.documentElement.clientWidth;
			} else {
				// quirks mode
				dims.w = document.body.clientWidth;
			}
		} else {
			// w3c
			dims.w = window.innerWidth;
		}

		// IE
		if (typeof( window.innerHeight ) != 'number') {
			if (document.documentElement.clientHeight !== 0) {
				// strict mode
				dims.h = document.documentElement.clientHeight;
			} else {
				// quirks mode
				dims.h = document.body.clientHeight;
			}
		} else {
			// w3c
			dims.h = window.innerHeight;
		}

		return dims;
	};

	/**
	 * Is the element in or scrolled out of the current viewport
	 *
	 * @param   {DOMElement}  elem
	 * @return  {boolean}
	 */
	function isScrolledIntoView(elem) {
		var docViewTop = $window.scrollTop();
		var docViewBottom = docViewTop + $window.height();

		var elemTop = $(elem).offset().top;
		var elemBottom = elemTop + $(elem).height();

		return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom) && (elemBottom <= docViewBottom) && (elemTop >= docViewTop));
	}

	/**
	 * Is the current viewport width within the tablet breakpoints?
	 *
	 * @return  {boolean}
	 */
	function isTablet()
	{
		return viewport.w >= reactL10n.break_point_phone_ldsp && viewport.w <= reactL10n.break_point_tablet_ldsp;
	}

	/**
	 * Is the current viewport width within the phone breakpoints?
	 *
	 * @return  {boolean}
	 */
	function isMobile()
	{
		return viewport.w <= reactL10n.break_point_phone_ldsp;
	}

	/**
	 * Is the video background enabled?
	 *
	 * @return  {boolean}
	 */
	function videoBackgroundEnabled()
	{
		if (reactL10n.video) {
			if (isTablet()) {
				return reactL10n.video.tablet;
			} else if (isMobile()) {
				return reactL10n.video.mobile;
			}

			return true;
		}

		return false;
	}

	/**
	 * Checks if the given easing name exists, if it does the same string is returned,
	 * otherwise it defaults to 'swing'
	 *
	 * This prevents JavaScript errors when the jQuery Easing script is disabled in the Options Panel
	 *
	 * @param   {string}  name
	 * @return  {string}
	 */
	function getEasingFunction(name)
	{
		return $.isFunction($.easing[name]) ? name  : 'swing';
	}

	$(document).ready(function() {
		// Cache common vars
		var $doc = $(document),
			$html = $('html'),
			$page = $('#page'),
			isIE7 = $html.attr('id') === 'ie7',
			isIE8 = $html.attr('id') === 'ie8',
			$subfooter = $('#subfooter'),
			$bottom = $('#bottom'),
			$top = $('#top'),
			$footerLogoInfoWrap = $('#footer-logo-info-wrap'),
			$footerLogoInfoWrapInside = $('#footer-logo-info-wrap > div'),
			$footerAllFixed = $('.ft-reveal.ft-reveal-help #footer-all'),
			$backToTop = $('#back-to-top'),
			$goDown = $('#go-down'),
			$progress_volatile = $('.tcs-progress-bar-outer'),
			$animatedNumber_volatile = $('.tcs-animated-number'),
			$intro = $('#intro'),
			$fhStyle_volatile = $('.tcs-fancy-header.tcs-prime-line.tcs-animate-line, .tcs-fancy-header.tcs-word-animation'),
			$contentStyle = $('.content-style'),
			$afterHeaderWrap = $('.after-header-wrap');

		// Set these vars from the higher scope
		$window = $(window);
		$body = $('body');
		$header = $('#header');
		$headerAll = $('.header-all');
		animateFunc = typeof $.fn.velocity === 'function' ? 'velocity' : 'animate';
		adminBar = $body.hasClass('admin-bar');

		$goDown.hover(
		   function(){ $(this).removeClass('infinite'); }
		);

		var setViewportDimensions = function () {
			viewport = getViewportDimensions();
		};
		setViewportDimensions();
		$window.bind('orientationchange resize', $.isFunction($.throttle) ? $.throttle(50, setViewportDimensions) : setViewportDimensions);

		// Animations
		if (isIE7 || isIE8 || !Modernizr.csstransitions || !Modernizr.cssanimations) {
			animationsEnabled = false;
		} else if (isTablet()) {
			animationsEnabled = reactL10n.animateTablet;
		} else if (isMobile()) {
			animationsEnabled = reactL10n.animatePhone;
		}

		if (reactL10n.blog_animation) {
			$('.blog #content > .entry.post.has-animation').data('animation', reactL10n.blog_animation);
		}

		$animations = $('.has-animation');

		if (!animationsEnabled) {
			// Animations are not enabled so set everything to final animated state
			$animations.fadeIn().removeClass('has-animation has-out-animation');
			$animations = $();
			$progress_volatile.removeClass('tcs-force');
			$fhStyle_volatile.addClass('animating no-animate');
			$animatedNumber_volatile.each(function () {
				$(this).text($(this).data('end-number'));
			});
		}

		if (typeof reactL10n.vertical_margins === 'object' && reactL10n.vertical_margins.enabled) {
			// Set vertical space margins to viewport height
			var setVerticalSpaceMargins = function () {
				var d = getViewportDimensions(),
					h = d.h + 'px',
					vm = reactL10n.vertical_margins;

				// Top vertical space margin
				if (d.w <= reactL10n.break_point_phone_ldsp) {
					// Phone
					$headerAll.css('margin-top', vm.topPhones ? h : '');
				} else if (d.w <= reactL10n.break_point_tablet_ldsp) {
					// Tablet
					$headerAll.css('margin-top', vm.topTablets ? h : '');
				} else if (d.w >= reactL10n.break_point_tv) {
					// Large
					$headerAll.css('margin-top', vm.topLarge ? h : '');
				} else {
					// Default/desktop
					$headerAll.css('margin-top', vm.top ? h : '');
				}

				// Bottom vertical space margin
				if (d.w <= reactL10n.break_point_phone_ldsp) {
					// Phone
					$('.footer-all').css('margin-bottom', vm.bottomPhones ? h : '');
				} else if (d.w <= reactL10n.break_point_tablet_ldsp) {
					// Tablet
					$('.footer-all').css('margin-bottom', vm.bottomTablets ? h : '');
				} else if (d.w >= reactL10n.break_point_tv) {
					// Large
					$('.footer-all').css('margin-bottom', vm.bottomLarge ? h : '');
				} else {
					// Default/desktop
					$('.footer-all').css('margin-bottom', vm.bottom ? h : '');
				}
			};
			setVerticalSpaceMargins();
			$window.bind('orientationchange resize', $.isFunction($.throttle) ? $.throttle(100, setVerticalSpaceMargins) : setVerticalSpaceMargins);
		}

		// Woocommerce - order by.. select to buttons (must be before qTip setup)
		if ($.isFunction($.fn.select2Buttons)) {
			$('.woocommerce-ordering select[name=orderby]').select2Buttons({noDefault: false});
		}

		$('.menu-item-has-children > a').click(function () {
			if ($(this).attr('href') === '#') {
				return false;
			}
		});

		// Embeded video z-index fix
		$('iframe').each(function(){
			var url = $(this).attr("src");
			var char = "?";
			if(url.indexOf("?") != -1){
				char = "&";
			}

			$(this).attr("src",url+char+"wmode=transparent");
		});

		// Map cover
		var $mapCover = $('<span class="map-cover" title="' + reactL10n.clickToUseMap + '"></span>').on('click', function () {
			$(this).toggleClass('hide');
		});
		$('.map').append($mapCover);

		// Popdown message
		var $popdown = $('#popdown');
		if ($popdown.length) {
			var $popdownTrigger = $('#popdown-trigger'),
				$popdownHide = $('#popdown-hide'),
				popdownAnimating = false,
				popdownTriggerAnimating = false,
				getPopdownActualHeight = function () {
					return $popdown.actual('outerHeight', { includeMargin: false, clone: true });
				},
				togglePopdown = function (callback) {
					popdownAnimating = true;
					var closing = $popdown.hasClass('react-open'), targetHeight, targetOpacity;
					if (closing) {
						$popdown.removeClass('react-open');
						$popdownHide.animate({marginTop: '-200px', opacity: '0'}, 250);
						targetHeight = 0;
						targetOpacity = 0.5;
					} else {
						$popdown.addClass('react-open').css('height', '1px').show();
						$popdownHide.css({marginTop: '-200px', opacity: '0'}).animate({marginTop: adminBar ? '32px' : 0, opacity: '1'}, 650);
						targetHeight = getPopdownActualHeight();
						targetOpacity = 1;
						if ($body.hasClass('fix-pop') && $body.hasClass('full-pop')) {
							$popdown.add($popdown.find('.popdown-inner')).add($popdown.find('.popdown-inner-helper')).css('min-height', 0);
						}
					}
					$popdown[animateFunc]({
						height: targetHeight,
						opacity: targetOpacity
					}, {
						easing: getEasingFunction('easeInOutCubic'),
						duration: 750,
						complete: function () {
							if (closing) {
								$popdown.hide();
							} else {
								if ($body.hasClass('fix-pop') && $body.hasClass('full-pop')) {
									$popdown.add($popdown.find('.popdown-inner')).add($popdown.find('.popdown-inner-helper')).css('max-height', '');
								}
							}

							if (typeof callback === 'function') {
								callback();
							}
							popdownAnimating = false;
						}
					});

					if ($.isFunction($.fn.smoothScroll)) {
						$.smoothScroll({
							scrollTarget: $popdown,
							speed: 1000
						});
					}
				},
				getPopdownTriggerHeight = function () {
					return $popdownTrigger.actual('outerHeight', { includeMargin: false, clone: true });
				},
				showTrigger = function () {
					if (!popdownTriggerAnimating) {
						popdownTriggerAnimating = true;
						var animateToMarginTop;

						$popdownTrigger.removeClass('no-box-shadow');
						if ($body.is('.fix-pop.full-pop')) {
							$html.removeClass('pd-opn');
						}

						if (!$popdownTrigger.parent().hasClass('dismissed') && $body.hasClass('pop-trig-abso') && $popdownTrigger.css('position') === 'absolute') {
							animateToMarginTop = '15';
						} else {
							animateToMarginTop = 0;
						}

						if (adminBar) {
							animateToMarginTop += 32;
						}

						$popdownTrigger[animateFunc]({ marginTop: animateToMarginTop + 'px' }, { duration: 650, complete: function () { popdownTriggerAnimating = false; } });
					}
				},
				hideTrigger = function (callback) {
					if (!popdownTriggerAnimating) {
						popdownTriggerAnimating = true;
						$popdownTrigger[animateFunc]({
							marginTop: '-' + (getPopdownTriggerHeight() + 15) + 'px'
						}, {
							duration: 250,
							complete: function () {
								$popdownTrigger.addClass('no-box-shadow');
								if (typeof callback === 'function') {
									callback();
								}
								if ($body.is('.fix-pop.full-pop')) {
									$html.addClass('pd-opn');
								}
								popdownTriggerAnimating = false;
							}
						});
					}
				};

			// Position the trigger off the top of the page initially, hide the box-shadow and show the trigger
			$popdownTrigger.css('margin-top', '-' + (getPopdownTriggerHeight() + 15) + 'px').addClass('no-box-shadow').show();

			$('#popdown-hide').click(function () {
				if (!popdownAnimating) {
					$.cookie('hidePopdown', true, { expires: reactL10n.popdown_cookie_expires || 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
					togglePopdown(showTrigger);
				}
			});

			$popdownTrigger.click(function () {
				if (!popdownTriggerAnimating) {
					$.cookie('hidePopdown', false, { expires: reactL10n.popdown_cookie_expires || 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
					hideTrigger(togglePopdown);
				}
			});

			$popdownTrigger.find('.popdown-close').click(function () {
				if (!popdownTriggerAnimating) {
					popdownTriggerAnimating = true;
					$popdownTrigger[animateFunc]({
						marginTop: '-' + (getPopdownTriggerHeight() + 15) + 'px',
						opacity: 0
					}, {
						duration: 1000,
						complete: function () {
							$.cookie('hidePopdown', true, { expires: reactL10n.popdown_cookie_expires || 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
							$popdownTrigger.parent().addClass('dismissed');
							$body.addClass('dismiss-pt');
							$popdownTrigger[animateFunc]({ marginTop: adminBar ? '32px' : 0, opacity: 1 }, { duration: 1400, complete: function () { popdownTriggerAnimating = false; } });
						}
					});
				}
				return false;
			});

			setTimeout(function () {
				var hidePopdown = !$.cookie('hidePopdown') || $.cookie('hidePopdown') == 'false';

				if (hidePopdown) {
					if (reactL10n.popdown_start_point === 'start-down') {
						togglePopdown();
					} else {
						showTrigger();
					}
				} else {
					$popdownTrigger.parent().addClass('dismissed');
					$body.addClass('dismiss-pt');
					showTrigger();
				}
			}, 3000);
		}

		if ($('.info-menu-ul').children().length > 5) {
			$body.addClass('im-over-5');
		}

		function moveSlideOutContentToOrigin() {
			var $slideOutContent = $('#slide-out-box').find('.im-box-inner');
			if ($slideOutContent.length) {
				var $origin = $slideOutContent.data('origin');
				$slideOutContent.appendTo($origin);
				$('#slide-out-box').removeClass($origin.attr('id')).removeClass('scroll').css('height', 'auto');
			}
		}

		$('.im-trigger', '#page').click(function () {
			var $trigger = $(this),
				boxType = $trigger.data('type-override') || $trigger.data('type'),
				slideOut = boxType === 'slide-out',
				$thisBox = $trigger.next(),
				$targetBox = slideOut ? $('#slide-out-box') : $thisBox,
				$allBoxes = $('.im-box');

			if ($allBoxes.is(':animated')) {
				return false;
			}

			if ($targetBox.is(':visible') && $trigger.hasClass('im-active')) {
				$('.im-trigger').removeClass('im-active');
				$('.header-all').removeClass('im-open');

				// Animate 1 - The trigger for the active box is clicked, so hide it
				$targetBox[slideOut ? 'slideUp' : 'fadeOut'](400, function () {
					moveSlideOutContentToOrigin();
					$targetBox.find('.im-box-inner').css({ maxHeight: 30, opacity: 0 });
				});
			} else {
				if ($allBoxes.is(':visible')) {
					$('.im-trigger').removeClass('im-active');
					$('.header-all').removeClass('im-open');
					var $onlyVisible = $allBoxes.filter(':visible');

					// Animate 2 - The trigger for another box was clicked, so hide the currently open box
					$onlyVisible[slideOut ? 'slideUp' : 'fadeOut'](400, function() {
						$onlyVisible.find('.im-box-inner').css({ maxHeight: 30, opacity: 0 });

						moveSlideOutContentToOrigin();
						if (slideOut) {
							// Move the box content to the slideout area and save the origin trigger
							$('#slide-out-box .im-box-wrap').append($thisBox.find('.im-box-inner').animate({maxHeight: 1000, opacity: 1}, 200).data('origin', $thisBox));
							$('#slide-out-box').addClass($thisBox.attr('id'));
							if ($thisBox.hasClass('scroll')) {
								$('#slide-out-box').addClass('scroll').css('height', $thisBox.css('height'));
							}
						}

						$trigger.addClass('im-active');
						$('.header-all').addClass('im-open');

						// Animate 3 - Show the box for the newly clicked trigger, after the open box is hidden
						var animate3Callback = function () {
							$targetBox.find('.im-box-inner').animate({ maxHeight: 1000, opacity: 1 }, 200);
							$.refreshIframes($targetBox);
						};

						if (slideOut) {
							$targetBox.slideDown();
							animate3Callback();
						} else {
							$targetBox.css('display', 'block').animate({ opacity: 1 }, 10, animate3Callback);
						}
					});
				} else {
					if (slideOut) {
						// Move the box content to the slideout area and save the origin trigger
						$('#slide-out-box .im-box-wrap').append($thisBox.find('.im-box-inner').data('origin', $thisBox));
						$('#slide-out-box').addClass($thisBox.attr('id'));
						if ($thisBox.hasClass('scroll')) {
							$('#slide-out-box').addClass('scroll').css('height', $thisBox.css('height'));
						}
					}

					$trigger.addClass('im-active');
					$('.header-all').addClass('im-open');

					// Animate 4 - This shows the box when no other boxes were open when the trigger was clicked
					var animate4Callback = function () {
						$targetBox.find('.im-box-inner').animate({ maxHeight: 1000, opacity: 1 }, 200);
						$.refreshIframes($targetBox);
					};

					if (slideOut) {
						$targetBox.slideDown();
						animate4Callback();
					} else {
						$targetBox.css('display', 'block').animate({ opacity: 1 }, 10, animate4Callback);
					}
				}
			}
			return false;
		});

		var $infoMenu = $('.info-menu');

		$('#slide-out-box').on('click', '.im-close', function() {
			$('.im-trigger').removeClass('im-active');
			$('.header-all').removeClass('im-open');
			// Animate 5 - The close button for the slideout box was clicked, so hide the slideout box
			var $slideOutBoxInner = $('#slide-out-box').find('.im-box-inner');
			$('#slide-out-box').slideUp(function () {
				moveSlideOutContentToOrigin();
				$slideOutBoxInner.css({ maxHeight: 30, opacity: 0 });
				// Scroll to infoMenu if out of view
				if (!isScrolledIntoView($infoMenu[0]) && $.isFunction($.smoothScroll)) {
					$.smoothScroll({
						scrollTarget: $infoMenu,
						offset: -50,
						speed: 250
					});
				}
			});
		});

		$('.im-drop').on('click', '.im-close', function () {
			$('.im-trigger').removeClass('im-active');
			$('.header-all').removeClass('im-open');

			// Animate 6 - The close button for the popout box was clicked, so hide the popout box
			var $box = $(this).closest('.im-box');
			$box.fadeOut(200, function () {
				$box.find('.im-box-inner').css({ maxHeight: 30, opacity: 0 });
			});
		});

		//open-close dropdown
		$('#open-close-trigger').click(function() {
			$(this).toggleClass('active');
			$('.open-close-content').toggleClass('active');
			$('#open-close-close').fadeToggle(300);
			return false;
		});
		$('#open-close-close').click(function() {
			$('.open-close-content').removeClass('active');
			$('#open-close-close').fadeOut(300).removeClass('active');
			return false;
		});

		var $imTriggers = $('.im-trigger');
		if ($imTriggers.length) {
			var infoMenuConverts = function () {
				var windowWidth = getViewportDimensions().w;

				$imTriggers.each(function () {
					var $trigger = $(this),
						override = false;

					if (reactL10n.infomenu_dropdown_convert === 'phone-ptr' && windowWidth < reactL10n.break_point_phone_ptr) {
						override = true;
					} else if (reactL10n.infomenu_dropdown_convert === 'phone-ldsp' && windowWidth < reactL10n.break_point_phone_ldsp) {
						override = true;
					} else if (reactL10n.infomenu_dropdown_convert === 'tablet-ptr' && windowWidth < reactL10n.break_point_tablet_ptr) {
						override = true;
					} else if (reactL10n.infomenu_dropdown_convert === 'tablet-ldsp' && windowWidth < reactL10n.break_point_tablet_ldsp) {
						override = true;
					} else if (reactL10n.infomenu_dropdown_convert === 'box-width' && windowWidth < reactL10n.infomenu_dropdown_width) {
						override = true;
					} else if (reactL10n.infomenu_dropdown_convert === 'custom' && windowWidth < reactL10n.infomenu_dropdown_convert_custom) {
						override = true;
					}

					if (override) {
						$trigger.data('type-override', 'slide-out');
					} else {
						$trigger.removeData('type-override');
					}
				});
			};
			$window.bind('orientationchange resize', $.isFunction($.throttle) ? $.throttle(250, infoMenuConverts) : infoMenuConverts);
			infoMenuConverts();
		}

		var $minHeightBlocks = $('.tcs-device-min-height > .tcs-block-inner > .tcs-block-wrap');
		if ($minHeightBlocks.length) {
			var blockMinHeights = function () {
				$minHeightBlocks.each(function () {
					var $block = $(this),
						heightToRemove = 0;

					if ($subfooter.css('position') === 'fixed') {
						heightToRemove += $subfooter.outerHeight(true);
					}

					$block.css('min-height', $window.height() - heightToRemove);
				});
			};
			$window.bind('orientationchange resize', $.isFunction($.throttle) ? $.throttle(250, blockMinHeights) : blockMinHeights);
			blockMinHeights();
		}

		var $fixedHeightBlocks = $('.tcs-device-fixed-height > .tcs-block-inner > .tcs-block-wrap');
		if ($fixedHeightBlocks.length) {
			var blockFixedHeights = function () {
				$fixedHeightBlocks.each(function () {
					var $block = $(this),
						heightToRemove = 0;

					if ($subfooter.css('position') === 'fixed') {
						heightToRemove += $subfooter.outerHeight(true);
					}

					$block.css('height', $window.height() - heightToRemove);
				});
			};
			$window.bind('orientationchange resize', $.isFunction($.throttle) ? $.throttle(250, blockFixedHeights) : blockFixedHeights);
			blockFixedHeights();
		}

		var $viewportWidthBlocks = $('.tcs-block-outer.tcs-viewport-width');
		if ($viewportWidthBlocks.length) {
			var scrollbarWidth = typeof $.scrollbarWidth === 'function' ? $.scrollbarWidth() : 0,
				blockViewportWidth = function () {
					$viewportWidthBlocks.each(function () {
						var $block = $(this);
						var width = viewport.w;

						if (scrollbarWidth > 0 && typeof $.fn.hasScrollbar === 'function' && $window.hasScrollbar()) {
							width = width - scrollbarWidth;
						}

						$block.css({
							width: width,
							marginLeft: '-' + $contentStyle.offset().left + 'px'
						});
					});
				};

			$window.bind('orientationchange resize', $.isFunction($.throttle) ? $.throttle(250, blockViewportWidth) : blockViewportWidth);
			blockViewportWidth();
		}

		var $outerWidthBlocks = $('.tcs-block-outer.tcs-outer-width');
		if ($outerWidthBlocks.length) {
			var blockOuterWidth = function () {
				var outerWidth = $afterHeaderWrap.outerWidth();
				$outerWidthBlocks.each(function () {
					$(this).css({
						width: outerWidth,
						marginLeft: '-' + ($contentStyle.offset().left - $afterHeaderWrap.offset().left) + 'px'
					});
				});
			};
			$window.bind('orientationchange resize', $.isFunction($.throttle) ? $.throttle(250, blockOuterWidth) : blockOuterWidth);
			blockOuterWidth();
		}

		// Screen min-height for Popdown
		var height = $(window).height();
		$("body.full-pop-rel .popdown-wrap").css("min-height", height);

		// Last & first child classes - required if sections are hidden
		$('.header-all > div:visible:last').addClass('last-child');
		$('.header-all > div:hidden:last').removeClass('last-child');
		$('.header-all > div:visible:first').addClass('first-child');
		$('.header-all > div:hidden:first').removeClass('first-child');
		$('.top-and-pop > div:visible:last').addClass('last-child');
		$('.top-and-pop > div:visible:first').addClass('first-child');
		$('.after-header-wrap > div:visible:last').addClass('last-child');
		$('.after-header-wrap > div:visible:first').addClass('first-child');
		$('.footer-all > div:visible:last').addClass('last-child');
		$('.footer-all > div:visible:first').addClass('first-child');

		// Last & first child classes
		$('#nav-single .nav-single-inner div:last-child').addClass('last-child');

		$('.widget:last-of-type').addClass('last-child');
		$('ul > li:last-child').addClass('last-child');
		$('.tcs-list ul li a:last-child, .tcs-menu ul li a:last-child').addClass('last-child');
		$('.units-row > div:last-child').addClass('last-child');

		if ($body.hasClass('page-template-template-fullscreen-media-php')) {
			$body.add($('html')).css('overflow', 'hidden');
		}

		if (videoBackgroundEnabled()) {
			var $video = $('#video-background'),
				$videoWrap = $('#video-background-wrap');

			if ($video.length) {
				var videoAutostart = reactL10n.video.autostart,
					videoMute = reactL10n.video.mute,
					userAutostart = $.cookie('reactVideoPlay'),
					userMute = $.cookie('reactVideoMute'),
					$videoControlsWrap = $('#video-controls'),
					$videoControls,
					$videoPlay,
					$videoMute,
					$videoFsControlsWrap,
					$videoFsControls,
					$videoFsPlay,
					$videoFsMute,
					$videoFsCloseWrap,
					$videoFsClose;

				$videoControls = $('<div class="video-controls">').append(
					$videoPlay = $('<div class="video-play">'),
					$videoMute = $('<div class="video-unmute">')
				);

				$videoFsControlsWrap = $('<div class="video-fs-controls-outer">').append(
					$videoFsControls = $('<div class="video-fs-controls">').append(
						$videoFsPlay = $('<div class="video-fs-play">'),
						$videoFsMute = $('<div class="video-fs-unmute">')
					),
					$videoFsCloseWrap = $('<div class="video-fs-close-wrap">').append(
						$videoFsClose = $('<div class="video-fs-close">')
					)
				);

				// Check if the user has clicked play or pause previously and use that state
				if (userAutostart === 'play') {
					videoAutostart = true;
				} else if (userAutostart === 'pause') {
					videoAutostart = false;
				}

				// Check if the user has muted previously and use that state
				if (userMute === 'mute') {
					videoMute = true;
				} else if (userMute === 'unmute') {
					videoMute = false;
				}

				if (videoAutostart) {
					$videoPlay.removeClass('video-play').addClass('video-pause');
					$videoFsPlay.removeClass('video-fs-play').addClass('video-fs-pause');
				}

				if (videoMute) {
					$videoMute.removeClass('video-unmute').addClass('video-mute');
					$videoFsMute.removeClass('video-fs-unmute').addClass('video-fs-mute');
				}

				if (reactL10n.video.fullScreen) {
					var $videoFullScreen = $('<div class="video-full-screen">'),
						goingFullScreen = false,
						exitingFullScreen = false,
						$overlay = $('.background-overlay');

					$videoControls.append($videoFullScreen);

					// Click function to exit full screen mode
					$videoFsClose.click(function () {
						if (!exitingFullScreen) {
							exitingFullScreen = true;
							$videoFsControlsWrap.hide();
							$body.css('overflow', 'visible');

							$('#outside').fadeIn('slow').show(0, function () {
								exitingFullScreen = false;
							});

							if (!reactL10n.video.fullScreenOverlay) {
								$overlay.fadeIn('slow');
							}

							$window.resize();
						}
					});

					// Click function to go to full screen mode
					$videoFullScreen.click(function () {
						if (!goingFullScreen) {
							goingFullScreen = true;
							$body.css('overflow', 'hidden');
							if (!reactL10n.video.fullScreenOverlay) {
								$overlay.fadeOut('slow');
							}

							$('#outside').fadeOut('slow').hide(0, function () {
								$videoFsControlsWrap.fadeIn('slow');
								goingFullScreen = false;
							});

							$window.resize();
						}
					});

					$body.append($videoFsControlsWrap);
				}

				$body.addClass('video-background');
				$videoControlsWrap.append($videoControls);

				if (!reactL10n.video.width) {
					reactL10n.video.width = 640;
				}
				if (!reactL10n.video.height) {
					reactL10n.video.height = 390;
				}

				if (isIE7) {
					$video.attr('src', $video.attr('src') + '&autoplay=1');
					$videoControlsWrap.remove();
				}

				var videoRatio = reactL10n.video.width / reactL10n.video.height;

				var resizeVideo = function () {
					var wWidth = $window.width(),
						wHeight = $window.height(),
						wRatio = wWidth / wHeight,
						newWidth,
						newHeight;

					if (wRatio > videoRatio) {
						newWidth = wWidth;
						newHeight = parseInt(wWidth / videoRatio, 10);
					} else {
						newWidth = wHeight * videoRatio;
						newHeight = wHeight;
					}

					if (reactL10n.video.type == 'vimeo') {
						$video.width(newWidth).height(newHeight);
					} else if (reactL10n.video.type == 'youtube' && youtubePlayer) {
						youtubePlayer.setSize(newWidth, newHeight);
					}

					$videoWrap.css({
						width: newWidth + 'px',
						height: newHeight + 'px',
						left: parseInt(((wWidth - newWidth) / 2), 10) + 'px',
						top: parseInt(((wHeight - newHeight) / 2), 10) + 'px'
					});
				};

				$window.bind('resize.react-video orientationchange.react-video', $.isFunction($.throttle) ? $.throttle(250, resizeVideo) : resizeVideo);

				if (reactL10n.video.type == 'vimeo') {
					var vimeoPlayer = $f($video[0]);

					vimeoPlayer.addEvent('ready', function () {
						$window.resize();

						if (videoMute) {
							vimeoPlayer.api('setVolume', 0);
						}

						if (reactL10n.video.start > 0) {
							vimeoPlayer.api('seekTo', reactL10n.video.start);
						}

						if (videoAutostart) {
							vimeoPlayer.api('play');
						}

						vimeoPlayer.addEvent('finish', function () {
							if (reactL10n.video.complete == 'redirect' && reactL10n.video.redirect) {
								window.location = reactL10n.video.redirect;
							} else if (reactL10n.video.complete == 'restart') {
								vimeoPlayer.api('play');
							} else if (reactL10n.video.complete == 'hide') {
								$window.unbind('resize.react-video orientationchange.react-video');
								$videoWrap.remove();
							}
						});

						// If the user played the video via clicking it, change the button state to match
						vimeoPlayer.addEvent('play', function () {
							if ($videoPlay.hasClass('video-play')) {
								$videoPlay.removeClass('video-play').addClass('video-pause');
								$videoFsPlay.removeClass('video-fs-play').addClass('video-fs-pause');
							}
						});

						// If the user paused the video via clicking it, change the button state to match
						vimeoPlayer.addEvent('pause', function () {
							if ($videoPlay.hasClass('video-pause')) {
								$videoPlay.removeClass('video-pause').addClass('video-play');
								$videoFsPlay.removeClass('video-fs-pause').addClass('video-fs-play');
							}
						});

						$videoPlay.add($videoFsPlay).click(function () {
							if ($videoPlay.hasClass('video-play')) {
								$videoPlay.removeClass('video-play').addClass('video-pause');
								$videoFsPlay.removeClass('video-fs-play').addClass('video-fs-pause');
								vimeoPlayer.api('play');
								$.cookie('reactVideoPlay', 'play', { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
							} else {
								$videoPlay.removeClass('video-pause').addClass('video-play');
								$videoFsPlay.removeClass('video-fs-pause').addClass('video-fs-play');
								vimeoPlayer.api('pause');
								$.cookie('reactVideoPlay', 'pause', { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
							}
						});

						$videoMute.add($videoFsMute).click(function () {
							if ($videoMute.hasClass('video-unmute')) {
								$videoMute.removeClass('video-unmute').addClass('video-mute');
								$videoFsMute.removeClass('video-fs-unmute').addClass('video-fs-mute');
								vimeoPlayer.api('setVolume', 0);
								$.cookie('reactVideoMute', 'mute', { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
							} else {
								$videoMute.removeClass('video-mute').addClass('video-unmute');
								$videoFsMute.removeClass('video-fs-mute').addClass('video-fs-unmute');
								vimeoPlayer.api('setVolume', 1);
								$.cookie('reactVideoMute', 'unmute', { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
							}
						});
					});
				} else if (reactL10n.video.type == 'youtube') {
					// Load the IFrame Player API code asynchronously.
					var tag = document.createElement('script');
					tag.src = "https://www.youtube.com/player_api";
					var firstScriptTag = document.getElementsByTagName('script')[0];
					firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

					// Check window size
					var wX = $window.width(),
						wY = $window.height(),
						wR = wX / wY,
						newX,
						newY;

					if (wR > videoRatio) {
						newX = wX;
						newY = parseInt(wX / videoRatio, 10);
					} else {
						newX = wY * videoRatio;
						newY = wY;
					}

					var youtubePlayer,
						playerVars = {
							wmode: 'transparent',
							autohide: 1,
							controls: 0,
							modestbranding: 1,
							rel: 0
						};

					if (reactL10n.video.start > 0) {
						playerVars.start = reactL10n.video.start;
					}

					var onReadyFired = false;
					var onPlayerReady = function (event) {
						// YouTube now fires this event twice, so only set up once
						if (onReadyFired) {
							return;
						}
						onReadyFired = true;

						$window.resize();

						if (videoMute) {
							youtubePlayer.mute();
						}

						if (videoAutostart) {
							youtubePlayer.playVideo();
						}

						setTimeout(function () {
							$videoWrap[animateFunc]({ opacity: 1 }, 1000);
						}, 500);

						$videoPlay.add($videoFsPlay).click(function () {
							if ($videoPlay.hasClass('video-play')) {
								$videoPlay.removeClass('video-play').addClass('video-pause');
								$videoFsPlay.removeClass('video-fs-play').addClass('video-fs-pause');
								youtubePlayer.playVideo();
								$.cookie('reactVideoPlay', 'play', { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
							} else {
								$videoPlay.removeClass('video-pause').addClass('video-play');
								$videoFsPlay.removeClass('video-fs-pause').addClass('video-fs-play');
								youtubePlayer.pauseVideo();
								$.cookie('reactVideoPlay', 'pause', { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
							}
						});

						$videoMute.add($videoFsMute).click(function () {
							if ($videoMute.hasClass('video-unmute')) {
								$videoMute.removeClass('video-unmute').addClass('video-mute');
								$videoFsMute.removeClass('video-fs-unmute').addClass('video-fs-mute');
								youtubePlayer.mute();
								$.cookie('reactVideoMute', 'mute', { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
							} else {
								$videoMute.removeClass('video-mute').addClass('video-unmute');
								$videoFsMute.removeClass('video-fs-mute').addClass('video-fs-unmute');
								youtubePlayer.unMute();
								$.cookie('reactVideoMute', 'unmute', { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
							}
						});
					};

					var onPlayerStateChange = function (event) {
						if (event.data == YT.PlayerState.ENDED) {
							if (reactL10n.video.complete == 'redirect' && reactL10n.video.redirect) {
								window.location = reactL10n.video.redirect;
							} else if (reactL10n.video.complete == 'restart') {
								youtubePlayer.playVideo();
							} else if (reactL10n.video.complete == 'hide') {
								$window.unbind('resize.react-video orientationchange.react-video');
								$videoWrap.remove();
							}
						}

						// If the user played the video via clicking it, change the button state to match
						if (event.data == YT.PlayerState.PLAYING && $videoPlay.hasClass('video-play')) {
							$videoPlay.removeClass('video-play').addClass('video-pause');
							$videoFsPlay.removeClass('video-fs-play').addClass('video-fs-pause');
						}

						// If the user paused the video via clicking it, change the button state to match
						if (event.data == YT.PlayerState.PAUSED && $videoPlay.hasClass('video-pause')) {
							$videoPlay.removeClass('video-pause').addClass('video-play');
							$videoFsPlay.removeClass('video-fs-pause').addClass('video-fs-play');
						}
					};

					window.onYouTubePlayerAPIReady = function () {
						youtubePlayer = new YT.Player('video-background', {
							width: newX,
							height: newY,
							videoId: reactL10n.video.id,
							events: {
								onReady: onPlayerReady,
								onStateChange: onPlayerStateChange
							},
							playerVars: playerVars
						});
					};
				} // end type == youtube

			} // end if $video.length
		} else {
			if ($.isFunction($.fullscreen)) {
				var size = viewport.w;

				for (var i = 0; i < reactL10n.backgroundOptions.backgrounds.length; i++) {
					if (size >= reactL10n.backgroundOptions.backgrounds[i].min && size <= reactL10n.backgroundOptions.backgrounds[i].max) {
						reactL10n.backgroundOptions.backgrounds = reactL10n.backgroundOptions.backgrounds[i].backgrounds;
						break;
					}
				}

				$.fullscreen($.extend({
					onLoad: function () {
						$('.fs-next, .fs-prev')[animateFunc]({ opacity: 0.5 }, { duration: 200 });
					},
					onComplete: function () {
						$('.fs-next, .fs-prev')[animateFunc]({ opacity: 1 }, { duration: 200 });
					},
					cookiePath: reactL10n.cookiePath,
					cookieDomain: reactL10n.cookieDomain
				}, reactL10n.backgroundOptions));
			}
		}

		// Audio player setup
		if (reactL10n.audio && reactL10n.audio.files && reactL10n.audio.files.length && $.isFunction($.fn.jPlayer)) {
			var audioIndex = 0,
			audioTotal = reactL10n.audio.files.length,
			audioAutostart = reactL10n.audio.autostart,
			userAudioAutostart = $.cookie('reactAudioPlay'),
			audioMute = $.cookie('reactAudioMute') === 'mute',
			userAudioIndex = parseInt($.cookie('reactAudioIndex'), 10),
			useUserAudioIndex = !reactL10n.audio.random && !reactL10n.audio.specific,
			$audioControls,
			$audioPlay,
			$audioNext,
			$audioPrev,
			$audioMute,
			$player;

			// Set up the controls
			$audioControls = $('<div class="audio-controls">').append(
				$audioPrev = $('<div class="audio-prev">'),
				$audioPlay = $('<div class="audio-play">'),
				$audioMute = $('<div class="audio-unmute">'),
				$audioNext = $('<div class="audio-next">')
			);

			// Check if the user has previously clicked the pause or play button and maintain that state
			if (userAudioAutostart === 'play') {
				audioAutostart = true;
			} else if (userAudioAutostart === 'pause') {
				audioAutostart = false;
			}

			if (audioMute) {
				$audioMute.removeClass('audio-unmute').addClass('audio-mute');
			}

			// Continue from the last played track if the audio is not randomised or page-specific
			if ($.isNumeric(userAudioIndex) && userAudioIndex >= 0 && userAudioIndex < audioTotal && useUserAudioIndex) {
				audioIndex = userAudioIndex;
			}

			// Hide the previous and next button if it's a single track
			if (audioTotal == 1) {
				$audioPrev.add($audioNext).hide();
			}

			$body.addClass('audio-background');
			$('#audio-controls').append($audioControls);

			$player = $('#jplayer-container').jPlayer({
				ready: function (event) {
					$player.jPlayer('setMedia', reactL10n.audio.files[audioIndex]);
					if (audioMute) {
						$player.jPlayer('mute');
					}

					if (audioAutostart) {
						$player.jPlayer('play');
					}
				},
				swfPath: reactL10n.themeUrl + '/js/',
				supplied: reactL10n.audio.supplied,
				wmode: 'window',
				ended: function () {
					// If we are at the last track, check if we should loop or stop
					if (audioIndex == (audioTotal - 1)) {
						if (reactL10n.audio.complete == 'restart') {
							$audioNext.click();
						}
					} else {
						// We are not at the end so play next track
						$audioNext.click();
					}
				}
			});

			$player.on($.jPlayer.event.play + '.storm', function (event) {
				$audioPlay.removeClass('audio-play').addClass('audio-pause');
			});

			$player.on($.jPlayer.event.pause + '.storm', function (event) {
				$audioPlay.removeClass('audio-pause').addClass('audio-play');
			});

			$audioPrev.click(function () {
				audioIndex = (audioIndex === 0) ? audioTotal - 1 : audioIndex - 1;
				$player.jPlayer('setMedia', reactL10n.audio.files[audioIndex]);
				$player.jPlayer('play');
				if (useUserAudioIndex) {
					$.cookie('reactAudioIndex', audioIndex, { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
				}
			});

			$audioPlay.click(function () {
				if ($audioPlay.hasClass('audio-play')) {
					$player.jPlayer('play');
					$.cookie('reactAudioPlay', 'play', { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
				} else {
					$player.jPlayer('pause');
					$.cookie('reactAudioPlay', 'pause', { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
				}
			});

			$audioMute.click(function () {
				if ($audioMute.hasClass('audio-unmute')) {
					$audioMute.removeClass('audio-unmute').addClass('audio-mute');
					$player.jPlayer('mute');
					$.cookie('reactAudioMute', 'mute', { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
				} else {
					$audioMute.removeClass('audio-mute').addClass('audio-unmute');
					$player.jPlayer('unmute');
					$.cookie('reactAudioMute', 'unmute', { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
				}
			});

			$audioNext.click(function () {
				audioIndex = (audioIndex == (audioTotal - 1)) ? 0 : audioIndex + 1;
				$player.jPlayer('setMedia', reactL10n.audio.files[audioIndex]);
				$player.jPlayer('play');
				if (useUserAudioIndex) {
					$.cookie('reactAudioIndex', audioIndex, { expires: 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
				}
			});
		} // end if reactL10n.audio

		// Initialise menus
		if ($.isFunction($.fn.superfish)) {
			$('ul.react-menu').superfish({
				animation:   {opacity:'show', marginTop:'12'},
				animationOut:  {opacity:'hide', marginTop:'40'},
				delay: 1000,
				speed: 350, // Was 'fast' before supposition,
				speedOut: 350
			}).supposition();
		}

		if ($.isFunction($.fn.fptabs)) {
			// Blog tabs
			$('#comment-tabs-nav').fptabs('.comment-tab');
		}

		// Accordion & toggles
		$('.react-accordion').each(function () {
			var $root = $(this),

			$triggers = $root.find('> h3').prepend('<span class="react-acc-icon"><i class="fa fa-angle-down"></i></span>');

			if ($root.hasClass('react-toggle')) {
				$triggers.click(function () {
					var $trigger = $(this),
						$content = $trigger.next();

					if ($trigger.hasClass('react-active')) {
						$content.slideUp(400, function () {
							$trigger.removeClass('react-active');
						});
					} else {
						$trigger.addClass('react-active');
						$.refreshIframes($content);
						$content.slideDown();
					}
				});
			} else {
				$triggers.click(function (e) {
					var $trigger = $(this),
						$content = $trigger.next();

					if ($content.is(':hidden')) {
						$triggers.removeClass('react-active').next().slideUp();

						$trigger.toggleClass('react-active');
						$.refreshIframes($content);
						$content.slideDown();
					} else {
						$trigger.removeClass('react-active');
						$content.slideUp();
					}
				});
			}

			$root.find('.react-acc-open').prev().click();
		});

		// Bind the view map button to slide down / up the map
		var $viewMapButton = $('.view-map'),
		$mapImg = $('.hidden-map'),
		$contactInfoWrap = $('.contact-info-wrap'),
		viewMapButtonText = $('.view-map').html();

		$viewMapButton.click(function() {
			if (!$mapImg.add($contactInfoWrap).is(':animated')) {
				if (!$mapImg.hasClass('map-visible')) {
					$contactInfoWrap.slideUp(600, function() {
						// Refresh any iframes inside it (for Google maps)
						$.refreshIframes($mapImg);

						$mapImg.slideDown(600, function() {
							$mapImg.addClass('map-visible');
							$viewMapButton.html(reactL10n.hideMap);
						});
					});
				} else {
					$mapImg.removeClass('map-visible').slideUp(600, function() {
						$contactInfoWrap.slideDown(600, function() {
							$viewMapButton.html(viewMapButtonText);
						});
					});
				}
			}
			return false;
		});

		rollovers();
		lightboxes();

		var portfolioZoomMouseEnter = function ($hover) {
			$hover.stop().fadeTo(1000, 0.6);
		},
		portfolioZoomMouseLeave = function ($hover) {
			$hover.stop().fadeTo(800, 0.0);
		};

		$doc.on('mouseenter', '.react-woo-image-hover', function () {
			portfolioZoomMouseEnter($(this));
		});

		$doc.on('mouseleave', '.react-woo-image-hover', function () {
			portfolioZoomMouseLeave($(this));
		});

		if ($.isFunction($.fn.fancybox)) {
			// Default WP gallery shortcode lightbox
			$('.gallery').each(function(index) {
				$(this).find('.gallery-icon > a').attr('data-fancybox-group', 'gallery-group-' + (index + 1)).fancybox({
					openEffect: 'elastic',
					closeEffect: 'elastic',
					prevEffect: 'fade',
					nextEffect: 'fade',
					padding: 1,
					beforeShow: function () {
						var caption = $(this.group[this.index].element).parent().siblings('.gallery-caption').html() || '', output = '';

						if (caption.length) {
							output += '<div class="fancybox-title-inner">' + caption + '</div>';
						}

						this.title = output;
					},
					helpers : {
						title: {
							type: 'over'
						}
					}
				});
			});
		}

		$('a.external').click(function () {
			var h = $(this).attr('href');
			if (h) {
				window.open(h);
			}
			return false;
		});

		$('a.popup-link').attr('target', '_blank');

		if ($.isFunction($.fn.qtip)) {
			var show = {
				effect: function() {
					$(this).show().css({ marginTop: 5, opacity: 0}).animate({ marginTop: 0, opacity: 0.9}, { duration: 350 });
				}
			},
			tooltipContent = {
				text: function(event, api) {
					var title = $(this).attr('title') || '';

					title = title.toString().replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/'/g, '&#039;').replace(/"/g, '&quot;');

					if (title === '') {
						api.destroy();
					}

					return title;
				}
			};

			if (reactL10n.show_tooltips_all) {
				if (reactL10n.rtl) {
					$('.content-outer a[title], .logo .strap-line[title]').not('.images a').qtip({
						content: tooltipContent,
						style: {
							classes: 'qtip-react content-tip tip-rtl',
							tip: false
						},
						position: {
							my: 'top right',
							at: 'bottom right',
							viewport: $window,
								adjust: {
									y: 5
								}
						},
						show: show
					});
					$('.tagcloud a[title]').qtip({
						content: tooltipContent,
						style: {
							classes: 'qtip-react content-tip tip-rtl',
							tip: false
						},
						position: {
							my: 'top right',
							at: 'bottom left',
							viewport: $window,
								adjust: {
									y: 5
								}
						},
						show: show
					});
					$('.tcs-icon[title]').qtip({
						content: tooltipContent,
						style: {
							classes: 'qtip-react tcs-icon-tip',
							tip: false
						},
						position: {
							my: 'top center',
							at: 'bottom center',
							viewport: $window,
								adjust: {
									y: 5
								}
						},
						show: show
					});

				} else {
					$('.content-outer a[title], .logo .strap-line[title]').not('.images a').qtip({
						content: tooltipContent,
						style: {
							classes: 'qtip-react content-tip',
							tip: false
						},
						position: {
							my: 'top left',
							at: 'bottom left',
							viewport: $window,
								adjust: {
									y: 5
								}
						},
						show: show
					});
					$('.tagcloud a[title]').qtip({
						content: tooltipContent,
						style: {
							classes: 'qtip-react content-tip',
							tip: false
						},
						position: {
							my: 'top right',
							at: 'bottom right',
							viewport: $window,
								adjust: {
									y: 5
								}
						},
						show: show
					});
					$('.tcs-icon[title]').qtip({
						content: tooltipContent,
						style: {
							classes: 'qtip-react tcs-icon-tip',
							tip: false
						},
						position: {
							my: 'top center',
							at: 'bottom center',
							viewport: $window,
								adjust: {
									y: 5
								}
						},
						show: show
					});

				}
			}

			if (reactL10n.rtl) {
				$('.react-vote span[title]').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react vote-tip tip-rtl',
						tip: false
					},
						position: {
						my: 'top right',
						at: 'top left',
						viewport: $window
					},
					show: show
				});
				$('.featured-image-wrap .react-vote span[title], .tcp-featured-image-wrap .react-vote span[title], .tcp-portfolio-item-title .react-vote span[title], .tcp-date-like-above .react-vote span[title]').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react fi-vote-tip tip-rtl',
						tip: false
					},
						position: {
						my: 'bottom left',
						at: 'top right',
						viewport: $window
					},
					show: show
				});
				$('.select-buttons li[title]').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react select-button-tip tip-rtl',
						tip: false
					},
						position: {
						my: 'top left',
						at: 'bottom left',
						viewport: $window
					},
					show: show
				});
			} else {
				$('.react-vote span[title]').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react vote-tip',
						tip: false
					},
					position: {
						my: 'top left',
						at: 'bottom left',
						viewport: $window,
						adjust: {
							y: 35
						}
					},

					show: show
				});
				$('.featured-image-wrap .react-vote span[title], .tcp-featured-image-wrap .react-vote span[title], .tcp-portfolio-item-title .react-vote span[title], .tcp-date-like-above .react-vote span[title]').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react fi-vote-tip vote-tip',
						tip: false
					},
					position: {
						my: 'bottom left',
						at: 'top left',
						viewport: $window,
						adjust: {
							x: -8,
							y: -7
						}
					},
					show: show
				});
				$('.select-buttons li[title]').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react select-button-tip',
						tip: false
					},
						position: {
						my: 'top right',
						at: 'bottom right',
						viewport: $window,
							adjust: {
								y: 2
							}
					},
					show: show
				});
			}

			if (reactL10n.show_tooltips_popdown) {
				$('#popdown-trigger a[title]').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react popdown-tip',
						tip: true
					},
					position: {
						my: 'top right',
						at: 'bottom center',
						viewport: $window
					},
					show: show
				});

				$('#popdown a[title]').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react popdown-tip',
						tip: false
					},
					position: {
						my: 'bottom right',
						at: 'top right',
						viewport: $window
					},
					show: show
				});
			}

			if (reactL10n.show_tooltips_social) {
				$('#tophead .social-icon-outer a[title], .tcw-widget-social-inner a[title], .socialcount li[title]').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react social-tip',
						tip: false
					},
					position: {
						my: 'top right',
						at: 'bottom right',
						viewport: $window,
						adjust: {
							y: 5
						}
					},
					show: show
				});
			}

			if (reactL10n.show_tooltips_footer) {
				$('#footer a[title]').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react foot-tip',
						tip: false
					},
					position: {
						my: 'bottom right',
						at: 'top right',
						viewport: $window
					},
					show: show
				});
			}

			if (reactL10n.show_tooltips_images) {
				$('img[title], .map-cover[title]').not('.product img').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react image-tip',
						tip: false
					},
					position: {
						my: 'top center',
						at: 'bottom center',
						target: 'mouse',
						viewport: $window,
						adjust: {
							y: 50
						}
					},
					show: show
				});
			}

			if (reactL10n.show_tooltips_nav) {
				$('ul.react-menu li a[title]').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react menu-tip',
						tip: false
					},
					position: {
						my: 'bottom center',
						at: 'top center',
						viewport: $window,
							adjust: {
								x: 7,
								y: -1
							}
					},
					show: show
				});

				$('ul.react-menu ul li a[title]').qtip({
					content: tooltipContent,
					style: {
						classes: 'qtip-react menu-tip',
						tip: false
					},
					position: {
						my: 'top left',
						at: 'bottom left',
						viewport: $window
					},
					show: show
				});
			}

			$('.tooltip').qtip({
				content: tooltipContent,
				style: {
					classes: 'qtip-react',
					tip: false
				},
				position: {
					my: 'top right',
					at: 'bottom right',
					viewport: $window,
						adjust: {
							y: 5
						}
				},
				show: show
			});

			$('.tooltip-right').qtip({
				content: tooltipContent,
				style: {
					classes: 'qtip-react',
					tip: false
				},
				position: {
					my: 'center left',
					at: 'center right',
					viewport: $window,
					show: show
				}
			});

			$('.tooltip-left').qtip({
				content: tooltipContent,
				style: {
					classes: 'qtip-react',
					tip: false
				},
				position: {
					my: 'center right',
					at: 'center left',
					viewport: $window
				},
				show: show
			});

		} // End isFunction($.fn.qtip)

		// Sharrre
		if ($.isFunction($.fn.sharrre)) {
			$('#twitter').sharrre({
				share: {
					twitter: true
				},
				template: '<a><span class="social-icon fa fa-twitter"></span><span class="network">Tweet</span></a>',
				enableHover: false,
				enableCounter: false,
				render: function (api, options) {
					api.renderer();
				},
				click: function(api, options) {
					api.simulateClick();
					api.openPopup('twitter');
				}
			});
			$('#facebook').sharrre({
				share: {
					facebook: true
				},
				template: '<a><span class="social-icon fa fa-facebook"></span><span class="network">Like</span><span class="count">{total}</span></a>',
				enableHover: false,
				click: function(api, options) {
					api.simulateClick();
					api.openPopup('facebook');
				}
			});
			$('#googleplus').sharrre({
				share: {
					googlePlus: true
				},
				urlCurl: '',
				template: '<a><span class="social-icon fa fa-google-plus"></span><span class="network">Google+</span></a>',
				enableHover: false,
				click: function(api, options) {
					api.simulateClick();
					api.openPopup('googlePlus');
				}
			});
			$('#pinterest').sharrre({
				share: {
					pinterest: true
				},
				urlCurl: '',
				template: '<a><span class="social-icon fa fa-pinterest"></span><span class="network">Pinterest</span></a>',
				enableHover: false,
				click: function(api, options) {
					api.simulateClick();
					api.openPopup('pinterest');
				}
			});
		}

		// Post like
		$('.post-like a').click(function(e) {
			e.preventDefault();

			var $heart = $(this),
				postId = $heart.data('post_id');

			$.ajax({
				type: 'POST',
				url: reactL10n.ajaxUrl,
				dataType: 'json',
				data: {
					action: 'react_post_like_ajax',
					_ajax_nonce: reactL10n.postLikeNonce,
					post_id: postId
				}
			})
			.done(function (response) {
				if (typeof response !== null && typeof response === 'object' && response.type === 'success') {
					$heart.addClass('voted');
					$heart.siblings('.count').addClass('voted').text(response.count);
				}
			});
		});

		// Scrolling optimisation
		var hasScrolled = false,
			headerHasScrolledClass = false,
			scrollPosition = $window.scrollTop(),
			setScrollPosition = function () {
				var newScrollPosition = $window.scrollTop();
				if (newScrollPosition != scrollPosition) {
					scrollPosition = newScrollPosition;
					hasScrolled = true;
				}
			},
			vergeWaypoints = function() {};

		if (scrollPosition > 0) {
			$headerAll.addClass('has-scrolled');
			headerHasScrolledClass = true;
		}

		$window.scroll($.isFunction($.throttle) ? $.throttle(200, setScrollPosition) : setScrollPosition);

		if (typeof verge === 'object' && animationsEnabled) {
			$.extend(verge);
			var checkingWaypoints = false;

			vergeWaypoints = function () {
				if (checkingWaypoints) {
					return;
				}
				checkingWaypoints = true;
				hasScrolled = false;

				// Verge
				var showFooterInfoPopup,
					showFooterInfoPopupPostId = $footerLogoInfoWrap.data('post-id');

				if (showFooterInfoPopupPostId) {
					showFooterInfoPopup = !$.cookie('hideFooterInfoPopup' + showFooterInfoPopupPostId) || $.cookie('hideFooterInfoPopup' + showFooterInfoPopupPostId) == 'false';
				} else {
					showFooterInfoPopup = !$.cookie('hideFooterInfoPopup') || $.cookie('hideFooterInfoPopup') == 'false';
				}

				var bottomInView = $.inY($bottom[0], 5);
				var headerInView = $.inY($top[0], 0);
				var pastContent = $.inY($bottom[0], 900);

				if (bottomInView) {
					if (showFooterInfoPopup) {

						$footerLogoInfoWrap.stop(true, true).animate({bottom: "100%", opacity: "1"}, 1000);
						$footerLogoInfoWrapInside.stop(true, true).animate({maxWidth: "100%"}, 1000);
					}
						$page.addClass('roc-bottom');
				} else {
					if (showFooterInfoPopup) {
						$footerLogoInfoWrap.stop(true, true).animate({bottom: "-100%", opacity: "0"}, 500);
						$footerLogoInfoWrapInside.stop(true, true).animate({maxWidth: "0"}, 500);
					}
						$page.removeClass('roc-bottom');
				}
				if (reactL10n.rtl) {
					if (!headerInView) {
						$goDown.animate({bottom: "-60px", opacity: "0"}, 250);
						$backToTop.animate({left: "20px", opacity: ".95"}, 450);
					} else {
						$goDown.animate({bottom: "20px", opacity: ".95"}, 450);
						$backToTop.animate({left: "-60px", opacity: "0"}, 250);
					}
				} else {
					if (!headerInView) {
						$goDown.animate({bottom: "-60px", opacity: "0"}, 250);
						$backToTop.animate({right: "20px", opacity: ".95"}, 450);
					} else {
						$goDown.animate({bottom: "20px", opacity: ".95"}, 450);
						$backToTop.animate({right: "-60px", opacity: "0"}, 250);
					}
				}

				if (pastContent) {
					$footerAllFixed.stop(true, true).animate({maxHeight: "1700px", opacity: "1"}, 250);
				} else {
					$footerAllFixed.stop(true, true).animate({maxHeight: "0", opacity: "0"}, 150);
				}

				var $fscaptionOuter = $('#fs-caption .fullscreen-caption');

				if ($body.hasClass('fs-caption-only-top')) {
					if (!headerInView) {
						$fscaptionOuter.removeClass('animated fadeIn').addClass('animated fadeOutUp');
					} else {
						$fscaptionOuter.removeClass('animated fadeOutUp').addClass('animated fadeIn');
					}
				}

				if ($body.hasClass('fs-caption-only-bottom')) {
					if (!bottomInView) {
						$fscaptionOuter.removeClass('animated fadeIn').addClass('animated fadeOutUp');
					} else {
						$fscaptionOuter.removeClass('animated fadeOutUp').addClass('animated fadeIn');
					}
				}


				if ($body.hasClass('hide-ft-after-top')) {
					var bodyRect = $.rectangle($body),
						subfooterHeight = $subfooter.outerHeight(true),
						convertSubfooter = bodyRect.top < 0 && (subfooterHeight < Math.abs(bodyRect.top)),
						isFixed = $subfooter.css('position') === 'fixed';

					if (isFixed && convertSubfooter) { // Changing from fixed to relative
						$subfooter.stop(true, true)[animateFunc]({ opacity: 0, height: subfooterHeight }, { complete: function () { $body.removeClass('ft-fix hide-ft-after-top');$body.addClass('position-rel');$subfooter.addClass('position-rel animated slideUpRetourn').removeClass('hide-after-top').css({ opacity: 1, height: 'auto' }); } });

					}
				}

				$animatedNumber_volatile.each(function () {
					var $this = $(this),
						inView = $.inY($this[0]);

					if (inView) { // Came into view
						var currentNumber = $this.text(), endValue = $this.data('end-number');

						$({numberValue: currentNumber}).animate({numberValue: endValue}, {
							duration: 2000,
							easing: 'linear',
							step: function() {
								$this.text(Math.ceil(this.numberValue));
							},
							complete: function () {
								$this.text(endValue);
							}
						});
						$animatedNumber_volatile = $animatedNumber_volatile.not($this);
					}
				});

				checkAnimations();

				$fhStyle_volatile.each(function () {
					var $this = $(this),
						inView = $.inY($this[0]);

					if (inView && !$this.hasClass('animating')) { // Came into view
						$this.removeClass('animating').addClass('animating');
						$fhStyle_volatile = $fhStyle_volatile.not($this);

						if ($this.hasClass('tcs-word-animation')) {
							$this.find('span.tcs-fancy-header-text').textillate();
						}
					}
				});

				$progress_volatile.each(function () {
					var $this = $(this),
						inView = $.inY($this[0]);

					if (inView && $this.hasClass('tcs-force')) { // Came into view
						$this.addClass('tcs-force').removeClass('tcs-force');
						$progress_volatile = $progress_volatile.not($this);
					}
				});

				$('.im-close').each(function () {
					var $this = $(this);

					if ($this.is(':visible')) {
						var $box = $this.closest('.im-box'),
							boxRect = $.rectangle($box),
							moveToBottom = boxRect.top < 0;

						$this.toggleClass('fadeInDown down', moveToBottom)
							 .toggleClass('fadeIn', !moveToBottom);
					}
				});

				checkingWaypoints = false;
			};

			$window.load(vergeWaypoints);

			$(document).on('react-check-animations', checkAnimations);
		}

		//toggle footer todo
			$('#subfooter-toggle').click(function(){
				$subfooter.removeClass('animated').addClass('animated');
				$subfooter.toggleClass('position-rel position-fixed slideUpRetourn');
				$subfooter.toggleClass('fadeInUp active-toggle');
				$body.toggleClass('ft-fix');
				$(this).toggleClass('active');
			});
			if ($body.hasClass('page-template-template-fullscreen-media-php')) {
				$('#subfooter-toggle').click(function(){
				$body.css({cursor: ''}).removeClass('distractions-on').addClass('distractions-off');

			});
		}

		// Scrolling optimisations part 2
		setInterval(function () {
			if (hasScrolled) {
				vergeWaypoints();

				if (scrollPosition > 0 && !headerHasScrolledClass) {
					$headerAll.addClass('has-scrolled');
					headerHasScrolledClass = true;
				} else if (scrollPosition === 0 && headerHasScrolledClass) {
					$headerAll.removeClass('has-scrolled');
					headerHasScrolledClass = false;
				}
			}
		}, 500);

		$footerLogoInfoWrap.stop(true, true).animate({bottom: "100%", opacity: "0"}, 500);
		$footerLogoInfoWrapInside.stop(true, true).animate({maxWidth: "0"}, 500);

		$('#close-footer-logo-info-wrap').click(function() {
			$footerLogoInfoWrap.stop(true, true).animate({bottom: "-100%", opacity: "0"}, 500);

			var hideFooterInfoPopupPostId = $footerLogoInfoWrap.data('post-id');
			if (hideFooterInfoPopupPostId) {
				$.cookie('hideFooterInfoPopup' + hideFooterInfoPopupPostId, true, { expires: reactL10n.footer_end_page_popout_cookie_expires || 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
			} else {
				$.cookie('hideFooterInfoPopup', true, { expires: reactL10n.footer_end_page_popout_cookie_expires || 28, path: reactL10n.cookiePath, domain: reactL10n.cookieDomain });
			}
		});

		if ($.isFunction($.fn.smoothScroll)) {
			var offset = $.isNumeric(reactL10n.smooth_scroll_offset) ? parseInt(reactL10n.smooth_scroll_offset, 10) : 0;

			if (offset > 0) {
				offset = -offset;
			}

			// Make links to anchors on the same page smooth scroll to them
			if (reactL10n.smooth_scroll_links) {
				$('.react-menu a[href*="#"], #back-to-top a, #go-down a, .tcs-icon-a, .tcs-button a, .tcs-impact-header-link-wrap a, a.react-smooth-scroll').click(function() {
					if (!this.hash || this.hash === '#') {
						return;
					}

					if (this.hash == '#top') {
						offset = 0;
					}

					if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
						var target = $(this.hash);
						target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
						if (target.length) {
							$.smoothScroll({
								scrollTarget: target,
								speed: 1500,
								easing: getEasingFunction('easeInOutQuad'),
								offset: offset
							});
							return false;
						}
					}
				});
			}

			// Stop scrolling if the page is clicked or mousewheel used
			$window.on('click wheel', function() {
				$('body,html').stop();
			});

			if (reactL10n.smooth_scroll_on_load) {
				var hashIndex = location.href.indexOf('#');
				if (hashIndex > -1) {
					var hash = escape(location.href.substring(hashIndex + 1));
					try {
						var $target = $('#' + hash + ', a[name="' + hash + '"]').first();

						if ($target.length) {
							$.smoothScroll({
								scrollTarget: $target,
								speed: 1500,
								easing: getEasingFunction('easeInOutQuad'),
								offset: offset
							});
						}
					} catch (e) { }
				}
			}

			// Smooth scroll to comment box if they clicked Reply
			if (window.location.hash === '#respond') {
				$.smoothScroll({
					scrollTarget: $('.comment-reply-wrap'),
					speed: 1500,
					easing: getEasingFunction('easeInOutQuad'),
					offset: offset
				});
			}
		} // if ($.isFunction($.fn.smoothScroll))

		if (reactL10n.page_loader == 'full') {
			var $pageLoader = $('#page-loader'),
				$pageLoaderInner = $pageLoader.find('.page-loader-inner');

			$pageLoader.fadeOut(400, function () {
				$pageLoaderInner.hide();
			});

			$window.on('beforeunload', function () {
				$pageLoader.fadeIn(200);
			});
		}
	}); // End (document).ready

	$(window).load(function () {
		// Sticky header
		if (reactL10n.general_sticky_header && !isTablet() && !isMobile() && $('.primary-menu').length) {
			var $sticky = $header.find('.primary-menu').length ? $header : $('#solonav'),
				offsetTweak = 150, // How many extra pixels below the bottom of the header should it turn sticky
				originalOffset = $headerAll.offset().top + offsetTweak,
				$stickyHeaderHelper = $('<div class="sticky-header-helper">').css('height', $sticky.outerHeight(true) + 'px'),
				going = false, at = 'static';

			if (!reactL10n.general_sticky_header_fullwidth) {
				$sticky.addClass('sticky-header-pagewidth');
			}

			var positionStickyHeader = function (event) {
				var scrollY = $window.scrollTop(),
					minY = originalOffset + $sticky.outerHeight(true),
					target = scrollY >= minY ? 'sticky' : 'static';

				if (at === target || going === target) {
					// The header is already where it should be
					return;
				}

				if (target === 'static') {
					going = 'static';
					$body.removeClass('sticky-header-active');
					$sticky.removeClass('stickied').addClass('animated fadeIn').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
						$(this).removeClass('animated fadeIn');
					});
					$stickyHeaderHelper.remove();
					at = 'static';
					going = false;
				} else {
					going = 'sticky';
					$body.addClass('sticky-header-active');
					$headerAll.append($stickyHeaderHelper);
					$sticky.addClass('stickied').queue(function () {
						at = 'sticky';
						going = false;
						$(this).addClass('animated fadeInDown').clearQueue().one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function () {
							$(this).removeClass('animated fadeInDown');
						});
					});
				}
			};

			$window.bind('scroll.sticky-header', $.isFunction($.throttle) ? $.throttle(250, positionStickyHeader) : positionStickyHeader);
			positionStickyHeader();
		}

		if ($.isFunction($.fn.sidr)) {
			var $primarySidrHtml = $('<div>'),
				$primaryMenu = $('.primary-menu'),
				$secondaryMenu = $('.secondary-menu'),
				$soloNavSearch = $('#solonav').find('.search-container');

			if ($soloNavSearch.length) {
				$primarySidrHtml = $primarySidrHtml.append($('<div class="sidr-search clearfix">').append($soloNavSearch.children().clone(true, true))).append($('<div class="sidr-sep">'));
			}

			if ($primaryMenu.length) {
				$primarySidrHtml = $primarySidrHtml.append($('<ul class="sidr-primary-menu">' + (reactL10n.nav_show_home_icon ? '<li class="sidr-home"><a href="' + reactL10n.homeUrl + '"><span class="main">' + reactL10n.homeText + '</span></a></li></ul>' : '</ul>')).append($primaryMenu.children().clone(true, true))).append($('<div class="sidr-sep">'));
			}

			if ($secondaryMenu.length) {
				$primarySidrHtml = $primarySidrHtml.append($('<ul class="sidr-secondary-menu">').append($secondaryMenu.children().clone(true, true))).append($('<div class="sidr-sep">'));
			}

			$primarySidrHtml.find('.sidr-sep').last().remove();

			$primarySidrHtml = $primarySidrHtml.children();

			// Primary and secondary device menus
			$('.device-menu-trigger').sidr({
				name: 'react-sidr-menu',
				body: '#outside',
				side: 'left',
				displace: reactL10n.sidr_displace,
				speed: reactL10n.sidr_speed,
				source: function () {
					return $primarySidrHtml;
				}
			});

			var $topSidrHtml = $('<div>'),
				$topMenu = $('.top-menu'),
				$contactDetails = $('.contact-details-top-head'),
				$socialIcons = $('#tophead .social-icon-outer');

			if ($topMenu.length) {
				$topSidrHtml.append($('<ul class="sidr-top-menu">').append($topMenu.children().clone(true, true))).append($('<div class="sidr-sep">'));
			}

			if ($contactDetails.length) {
				var $contactDetailsClone = $contactDetails.children().clone(true, true);

				// Remove the Quform forms before adding to the DOM
				var $quformTriggers = $contactDetailsClone.find('.iphorm-fancybox-link');
				$quformTriggers.each(function () {
					var $this = $(this),
						id = $this.attr('id');

					$this.removeAttr('id');
					$this.click(function () {
						$('#' + id).click();
					});
					$this.siblings('script, div').remove();
				});

				$topSidrHtml.append($contactDetailsClone);
			}

			if ($socialIcons.length) {
				$topSidrHtml.append($socialIcons.clone());
			}

			$topSidrHtml = $topSidrHtml.children();

			// Top device menu
			$('.device-top-menu-trigger').sidr({
				name: 'react-sidr-top-menu',
				body: '#outside',
				side: 'right',
				displace: reactL10n.sidr_displace,
				speed: reactL10n.sidr_speed,
				source: function () {
					return $topSidrHtml;
				}
			});

			// Toggle sidr sub menu
			$('.sidr ul li.menu-item-has-children').each(function () {
				var $li = $(this),
						  $toggle = $('<span class="sidr-menu-toggle"><i class="fa fa-angle-down"></i></span>'),
						  $submenu = $li.find('> .sub-menu');

				$toggle.click(function(e) {
					e.stopPropagation();

					if ($submenu.is(':hidden') ) {
						$submenu.slideDown(350);
						$(this).addClass('active').closest('li').addClass('active');
						$(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
					} else {
						$submenu.slideUp(280);
						$(this).removeClass('active').closest('li').removeClass('active');
						$(this).find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
					}
				});

				$li.append($toggle);
			});

			// Close sidr on clicking body ...
			$body.click(function () {
				$.sidr('close', 'react-sidr-menu');
				$.sidr('close', 'react-sidr-top-menu');
			});

			// ... But stop propagation of click events when clicking on sidr itself
			$('.sidr').click(function (e) { e.stopPropagation(); });
		}

		if ($.isFunction($.stellar) && animationsEnabled) {
			$.stellar({
				responsive: true,
				horizontalScrolling: false
			});
		}

		if ($.isFunction($.fn.isotope)) {
			var sidebarMasonryActive = false,
				sidebarMasonry = function () {
					if (reactL10n.sidebar_convert && reactL10n.sidebar_masonry && viewport.w <= reactL10n.sidebar_convert) {
						if (!sidebarMasonryActive) {
							$('#sidebar').isotope({
								itemSelector: '.widget',
								layoutMode: 'masonry',
								transitionDuration: '0.5s'
							}).isotope('on', 'layoutComplete', checkAnimations);
							sidebarMasonryActive = true;
						}
					} else {
						if (sidebarMasonryActive) {
							$('#sidebar').isotope('destroy');
							sidebarMasonryActive = false;
						}
					}
				};

			$(window).bind('resize.react-sidebar-masonry orientationchange.react-sidebar-masonry', $.isFunction($.throttle) ? $.throttle(100, sidebarMasonry) : sidebarMasonry);
			sidebarMasonry();
		}

		// Hide elements when user is inactive
		if ($body.hasClass('page-template-template-fullscreen-media-php')) {

			var notMouseMove = function () {
					$('.page-template-template-fullscreen-media-php #distraction-toggle').addClass('fadeOutDown active-toggle');
					$body.css({cursor: 'none'}).removeClass('distractions-off').addClass('distractions-on');
			};

			var timer;
			var mouseMoved = function () {
					clearTimeout(timer);
					timer = setTimeout(notMouseMove, 5500);
					$('.page-template-template-fullscreen-media-php #distraction-toggle').removeClass('fadeOutDown active-toggle');
					$body.css({cursor: 'default'}).removeClass('distractions-on').addClass('distractions-off');
			};

			timer = setTimeout(notMouseMove, 3000);

			setTimeout(function () {
					$body.on('mousemove', $.isFunction($.throttle) ? $.throttle(1000, mouseMoved) : mouseMoved);
			}, 3000);

			}
	});

})(jQuery, window);
