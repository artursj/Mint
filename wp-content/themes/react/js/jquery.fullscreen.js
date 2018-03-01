/*!
 * Full Screen Background v2.0.8 (21 Apr 2016)
 *
 * Copyright 2011-2016 ThemeCatcher
 *
 * All rights reserved
 */
(function ($, window) {
	'use strict';
	// Default settings
	var defaults = {
		speed: 2000,                        // Speed of the transition between background images, in milliseconds 1000 = 1 second
		transition: 'fade',                 // The transition animation. 'fade', 'fadeOutFadeIn', 'slideDown', 'slideRight', 'slideUp', 'slideLeft', 'carouselRight', 'carouselLeft'
		position: 'fixed',                  // Whether the background is positioned absolute or fixed
		fitLandscape: false,                // If landscape images should be locked to 100% width
		fitPortrait: true,                  // If portrait images should be locked to 100% height
		fitAlways: false,                   // Don't crop images at all
		positionX: 'center',                // Where to position the image on the X axis. 'left', 'center', 'right'
		positionY: 'center',                // Where to position the image on the Y axis. 'top', 'center', 'bottom'
		easing: 'swing',                    // The easing function to use when transitioning
		controlsSelector: '#fs-controls',   // The jQuery selector of the element to append the controls to
		hideSpeed: 1000,                    // Speed that the website is hidden at, when activating full screen mode, in milliseconds
		showSpeed: 1000,                    // Speed that the website is shown at, when closing full screen mode, in milliseconds
		controlSpeed: 500,                  // Speed that the controls fades in, in full screen mode, in milliseconds
		fadeIE: false,                      // Whether or not to fade the website in IE 7,8
		save: true,                         // Whether or not to save the current background across pages
		slideshow: true,                    // Whether or not to use the slideshow functionality
		slideshowAuto: true,                // Whether or not to start the slideshow automatically
		slideshowSpeed: 4000,               // How long the slideshow stays on one image, in milliseconds
		random: false,                      // Whether the images should be displayed in random order, forces save = false
		keyboard: true,                     // Whether or not to use the keyboard controls, left arrow, right arrow and esc key
		captionPosition: 'center bottom',   // The default caption position
		alwaysShowCaptions: false,          // Always show the captions
		captionSpeed: 600,                  // The speed of the caption fade animation
		bullets: true,                      // Dislay bullet navigation
		lowQuality: false,                  // Turns on lower quality but higher performance transitions
		errorBackground: '',                // Path to the background image shown if there is an error loading an image
		breaker: false,                     // Display breaker image
		breakerOnMax: false,                // Display breaker image in maximise mode
		onInit: false,                      // Callback before the first image is shown
		onLoad: false,                      // Callback when the current image starts loading
		onComplete: false,                  // Callback when the current image has completely loaded
		captionEnhancement: function () {}, // Called before the caption is shown and passed the $captionOuter jQuery object
		cookiePath: '/',                    // The cookie path used when setting cookies
		cookieDomain: '',                   // The cookie domain used when setting cookies, defaults to current domain
		spinnerClass: ''                    // The class to add to the spinner, integrates with SpinKit
	},

	// Wrappers & captions
	$outer,
	$stage,
	$captionOuter,
	$caption,
	$breaker,
	$spinner,

	// Full screen controls
	$controlsWrap,
	$controls,
	$prev,
	$play,
	$next,
	$loadingWrap,
	$loading,
	$closeWrap,
	$close,
	$bullets,

	// Template background controls
	$fsControls,
	$fsPrev,
	$fsPlay,
	$fsNext,
	$fsMax,

	// Window & body
	$window,
	$body,

	// Misc
	isIE = !$.support.opacity,
	cookiePlugin,
	backgrounds,
	total,
	imageCache = [],
	bodyOverflow,
	currentIndex = 0,
	animating = false,
	settings,
	fullscreen,
	captionXPositions = ['left', 'center', 'right'],
	captionYPositions = ['top', 'center', 'bottom'],
	isMaximised = false,
	slideshowTimeout,
	slideshowStarted = false,
	waitTimeout;

	/**
	 * Load the image with the given index
	 *
	 * @param  {int}       index     The index of the image to load.
	 * @param  {function}  callback  Callback function to call when loading is finished.
	 */
	function load(index, callback) {
		if (backgrounds[index] !== undefined && imageCache[index] === undefined) {
			imageCache[index] = true;

			var $image = $('<img>'),
			errorLoading = false;

			$image.one('load', function () {
				$('div', $stage).eq(index).append($image);

				setTimeout(function () {
					setImageData($image);
					resizeImages();

					if (typeof callback === 'function') {
						callback();
					}
				}, 1); // Chrome will sometimes report a 0 by 0 size if there isn't pause in execution
			})
			.bind('error', function () {
				if (!errorLoading && settings.errorBackground) {
					$image.attr('src', settings.errorBackground);
				}
				errorLoading = true;
			});

			setTimeout(function () {
				$image.attr('src', backgrounds[index].image);
			}, 1); // Opera 10.6+ will sometimes load the src before the onload function is set, so wait 1ms
		}
	}

	/**
	 * Get the index of the next image
	 *
	 * @return  {int}
	 */
	function getNextIndex() {
		return (currentIndex === (total - 1)) ? 0 : currentIndex + 1;
	}

	/**
	 * Get the index of the prev image
	 *
	 * @return  {int}
	 */
	function getPrevIndex() {
		return (currentIndex === 0) ? total - 1 : currentIndex - 1;
	}

	/**
	 * Return a random value from the given array
	 *
	 * @param   {array}  array
	 * @return  {array}
	 */
	function random(array) {
		return array[Math.floor(Math.random() * array.length)];
	}

	/**
	 * Randomly shuffle a given array
	 *
	 * @param   {array}  array
	 * @return  {array}
	 */
	function shuffle(array)
	{
		var tmp, current, top = array.length;

		if(top) {
			while(--top) {
				current = Math.floor(Math.random() * (top + 1));
				tmp = array[current];
				array[current] = array[top];
				array[top] = tmp;
			}
		}

		return array;
	}

	/**
	 * Trigger the given event and call callback
	 *
	 * @param  {string}    event
	 * @param  {function}  callback
	 */
	function trigger(event, callback) {
		if (typeof callback === 'function') {
			callback.call();
		}
		$outer.trigger(event);
	}

	/**
	 * Get a cookie
	 *
	 * @param  {string}  key  The key of the cookie.
	 */
	function getCookie(key)
	{
		if (cookiePlugin) {
			return $.cookie(key);
		}
	}

	/**
	 * Set a cookie
	 *
	 * @param  {string}  key      The key of the cookie.
	 * @param  {string}  value    The value of the cookie.
	 * @param  {object}  options  An object literal containing key/value pairs to provide optional cookie attributes.
	 */
	function setCookie(key, value, options) {
		if (cookiePlugin) {
			if (typeof options !== 'object' || options === null) {
				options = { expires: 365, path: settings.cookiePath, domain: settings.cookieDomain };
			}

			$.cookie(key, value, options);
		}
	}

	/**
	 * Add the inner parts required for the SpinKit animations (depends on the spinner type)
	 *
	 * @param {jQuery} $wrapper [description]
	 */
	function addInnerSpinKitParts($wrapper, spinnerClass)
	{
		switch (spinnerClass) {
			case 'sk-rotating-plane':
			case 'sk-spinner-pulse':
				/* No child required */
				break;
			case 'sk-double-bounce':
				$wrapper.append(
					$('<div class="sk-child sk-double-bounce1">'),
					$('<div class="sk-child sk-double-bounce2">')
				);
				break;
			case 'sk-wave':
				$wrapper.append(
					$('<div class="sk-rect sk-rect1">'),
					$('<div class="sk-rect sk-rect2">'),
					$('<div class="sk-rect sk-rect3">'),
					$('<div class="sk-rect sk-rect4">'),
					$('<div class="sk-rect sk-rect5">')
				);
				break;
			case 'sk-wandering-cubes':
				$wrapper.append(
					$('<div class="sk-cube sk-cube1">'),
					$('<div class="sk-cube sk-cube2">')
				);
				break;
			case 'sk-chasing-dots':
				$wrapper.append(
					$('<div class="sk-child sk-dot1">'),
					$('<div class="sk-child sk-dot2">')
				);
				break;
			case 'sk-three-bounce':
				$wrapper.append(
					$('<div class="sk-child sk-bounce1">'),
					$('<div class="sk-child sk-bounce2">'),
					$('<div class="sk-child sk-bounce3">')
				);
				break;
			case 'sk-circle':
				$wrapper.append(
					$('<div class="sk-child sk-circle1">'),
					$('<div class="sk-child sk-circle2">'),
					$('<div class="sk-child sk-circle3">'),
					$('<div class="sk-child sk-circle4">'),
					$('<div class="sk-child sk-circle5">'),
					$('<div class="sk-child sk-circle6">'),
					$('<div class="sk-child sk-circle7">'),
					$('<div class="sk-child sk-circle8">'),
					$('<div class="sk-child sk-circle9">'),
					$('<div class="sk-child sk-circle10">'),
					$('<div class="sk-child sk-circle11">'),
					$('<div class="sk-child sk-circle12">')
				);
				break;
			case 'sk-cube-grid':
				$wrapper.append(
					$('<div class="sk-cube sk-cube1">'),
					$('<div class="sk-cube sk-cube2">'),
					$('<div class="sk-cube sk-cube3">'),
					$('<div class="sk-cube sk-cube4">'),
					$('<div class="sk-cube sk-cube5">'),
					$('<div class="sk-cube sk-cube6">'),
					$('<div class="sk-cube sk-cube7">'),
					$('<div class="sk-cube sk-cube8">'),
					$('<div class="sk-cube sk-cube9">')
				);
				break;
			case 'sk-fading-circle':
				$wrapper.append(
					$('<div class="sk-circle1 sk-circle">'),
					$('<div class="sk-circle2 sk-circle">'),
					$('<div class="sk-circle3 sk-circle">'),
					$('<div class="sk-circle4 sk-circle">'),
					$('<div class="sk-circle5 sk-circle">'),
					$('<div class="sk-circle6 sk-circle">'),
					$('<div class="sk-circle7 sk-circle">'),
					$('<div class="sk-circle8 sk-circle">'),
					$('<div class="sk-circle9 sk-circle">'),
					$('<div class="sk-circle10 sk-circle">'),
					$('<div class="sk-circle11 sk-circle">'),
					$('<div class="sk-circle12 sk-circle">')
				);
				break;
			case 'sk-folding-cube':
				$wrapper.append(
					$('<div class="sk-cube1 sk-cube">'),
					$('<div class="sk-cube2 sk-cube">'),
					$('<div class="sk-cube4 sk-cube">'),
					$('<div class="sk-cube3 sk-cube">')
				);
				break;
		}
	}

	fullscreen = $.fullscreen = function (options) {
		settings = $.extend({}, defaults, options || {});

		backgrounds = settings.backgrounds;
		total = backgrounds.length;

		if (!total) {
			return;
		}

		for (var i = 0; i < total; i++) {
			if (typeof backgrounds[i] === 'string') {
				backgrounds[i] = { image: backgrounds[i] };
			}
		}

		if (settings.random) {
			backgrounds = shuffle(backgrounds);
			settings.save = false;
		}

		if (typeof settings.backgroundIndex === 'number') {
			currentIndex = settings.backgroundIndex;
			settings.save = false;
		}

		if (isIE && !settings.fadeIE) {
			settings.hideSpeed = 0;
			settings.showSpeed = 0;
			settings.controlSpeed = 0;
		}

		init();
	};

	/**
	 * Intialisation
	 *
	 * Sets up the HTML elements and JavaScript bindings then loads
	 * the first image.
	 */
	function init() {
		// Cache some common vars
		$window = $(window);
		$body = $('body');
		cookiePlugin = !!$.cookie;

		// Create the div structure
		$outer = $('<div class="fullscreen-outer">').append(
			$stage = $('<div class="fullscreen-stage">'),
			$breaker = $('<div class="fullscreen-breaker">'),
			$captionOuter = $('<div class="fullscreen-caption-outer" id="fs-caption">').append(
				$('<div class="fullscreen-caption-helper">').append(
					$caption = $('<div class="fullscreen-caption">')
				)
			)
		);

		$spinner = $('<div class="fullscreen-spinner">');
		if (settings.spinnerClass !== '') {
			var $spinnerInner = $('<div class="fullscreen-spinner-inner">').addClass(settings.spinnerClass);
			addInnerSpinKitParts($spinnerInner, settings.spinnerClass);
			$spinner.append($spinnerInner);
			$outer.prepend($spinner);
			$spinner.fadeIn();
		}

		$controlsWrap = $('<div class="fullscreen-controls-outer">').append(
			$controls = $('<div class="fullscreen-controls">').append(
				$prev = $('<div class="fullscreen-prev">'),
				$play = $('<div class="fullscreen-play">'),
				$next = $('<div class="fullscreen-next">')
			),
			$loadingWrap = $('<div class="fullscreen-loading-wrap">').append(
				$loading = $('<div class="fullscreen-loading">')
			),
			$closeWrap = $('<div class="fullscreen-close-wrap">').append(
				$close = $('<div class="fullscreen-close">')
			)
		);

		$fsControls = $('<div class="fs-controls">').append(
			$fsPrev = $('<div class="fs-prev">'),
			$fsPlay = $('<div class="fs-play">'),
			$fsNext = $('<div class="fs-next">'),
			$fsMax = $('<div class="fs-max">')
		);

		for (var i = 0; i < total; i++) {
			$stage.append('<div class="fullscreen-slide">');
		}

		if (settings.position === 'absolute') {
			$body.addClass('fs-absolute');
		} else {
			$body.addClass('fs-fixed');
		}

		// Put the controls on the page
		if (settings.controlsSelector) {
			$(settings.controlsSelector).append($fsControls);
		}

		$body.addClass('fullscreen-background fullscreen-mode-normal').prepend($outer).append($controlsWrap);

		if (total > 1) {
			$controls.add($fsPrev).add($fsNext).show();

			// Bullets functionality
			if (settings.bullets) {
				$bullets = $('<div class="fullscreen-bullets">');

				for (var j = 0; j < total; j++) {
					var title = backgrounds[j].title || '';
					$('<div class="fullscreen-bullet">' + j + '</div>').data('index', j).attr('title', title).appendTo($bullets);
				}

				$('.fullscreen-bullet', $bullets).click(function () {
					fullscreen.go($(this).data('index'));
					return false;
				});

				$controls.append($bullets);
			}
		} else {
			$controlsWrap.add($fsControls).addClass('fs-single');
			settings.slideshow = false;
		}

		// Bind the prev button to load the previous image
		$prev.add($fsPrev).click(function () {
			fullscreen.prev();
			return false;
		});

		// Bind the next button to load the next image
		$next.add($fsNext).click(function () {
			fullscreen.next();
			return false;
		});

		// Bind the maximise buttons to enter maximise mode
		$fsMax.click(fullscreen.max);

		// Bind the close button to close it
		$closeWrap.click(fullscreen.close);

		// Save the current body overflow value
		bodyOverflow = $body.css('overflow');

		if (settings.save) {
			// Check for the saved background cookie to override the default
			var savedBackground = parseInt(getCookie('fullscreenSavedBackground'), 10);
			for(var k = 0; k < total; k++) {
				if (k === savedBackground) {
					currentIndex = k;
					break;
				}
			}
		}

		trigger('fullscreenInit', settings.onInit);

		// Load the current image then do the first transition
		var loadingTimeout = setTimeout(function () { $controlsWrap.add($fsControls).addClass('fs-load'); }, 200);

		load(currentIndex, function () {
			clearTimeout(loadingTimeout);
			$controlsWrap.add($fsControls).removeClass('fs-load');

			// Put the breaker on the page
			if (settings.breaker) {
				$breaker.fadeIn('slow');
			}

			if (total > 1) {
				// Slideshow functionality
				if (settings.slideshow) {
					if (getCookie('fullscreenSlideshow') === 'start') {
						fullscreen.start();
					} else if (getCookie('fullscreenSlideshow') === 'stop') {
						fullscreen.stop();
					} else {
						if (settings.slideshowAuto) {
							fullscreen.start();
						} else {
							fullscreen.stop();
						}
					}

					$play.add($fsPlay).show();
					$controlsWrap.add($fsControls).addClass('fs-slideshow');
				}
			}

			// Bind the resize funtion when the window is resized
			$window.resize($.isFunction($.throttle) ? $.throttle(100, resizeImages) : resizeImages);

			$spinner.fadeOut(function () {
				$spinner.remove();
			});

			// Do the first transition
			doTransition();
		});
	}

	/**
	 * Resize the images
	 *
	 * @param  {function}  callback  Called after the resize is complete
	 */
	function resizeImages() {
		var windowWidth = $stage.width(),
		windowHeight = $stage.height(),
		windowRatio = windowHeight / windowWidth;

		$('img', $stage).each(function () {
			var $image = $(this),
			imageRatio = $image.data('imageRatio'),
			css = {};

			if (windowRatio > imageRatio) {
				// Window is more "portrait" than the image
				if (settings.fitAlways) {
					$image.width(windowWidth).height(windowWidth * imageRatio);
				} else {
					if (imageRatio <= 1 && settings.fitLandscape) {
						$image.width(windowWidth).height(windowWidth * imageRatio);
					} else {
						$image.height(windowHeight).width(windowHeight / imageRatio);
					}
				}
			} else {
				// Window is more "landscape" than the image
				if (settings.fitAlways) {
					$image.height(windowHeight).width(windowHeight / imageRatio);
				} else {
					if (imageRatio > 1 && settings.fitPortrait) {
						$image.height(windowHeight).width(windowHeight / imageRatio);
					} else {
						$image.width(windowWidth).height(windowWidth * imageRatio);
					}
				}
			}

			switch (settings.positionX) {
				case 'left':
					css.left = 0;
					css.right = 'auto';
					break;
				case 'right':
					css.left = 'auto';
					css.right = 0;
					break;
				default:
				case 'center':
					css.left = ((windowWidth - $image.width()) / 2) + 'px';
					css.right = 'auto';
					break;
			}

			switch (settings.positionY) {
				case 'top':
					css.top = 0;
					css.bottom = 'auto';
					break;
				case 'bottom':
					css.top = 'auto';
					css.bottom = 0;
					break;
				default:
				case 'center':
					css.top = ((windowHeight - $image.height()) / 2) + 'px';
					css.bottom = 'auto';
					break;
			}

			$image.css(css);
		});
	}

	/**
	 * Save the image data to use later
	 *
	 * @param  {object}  $image  The jQuery object of the image.
	 */
	function setImageData($image) {
		var imageWidth = $image.width(),
		imageHeight = $image.height();

		$image.data({
			imageWidth: imageWidth,
			imageHeight: imageHeight,
			imageRatio: imageHeight / imageWidth
		});
	}

	/**
	 * Do the transtion animation
	 *
	 * @param  {boolean}  reverse  Reverse the transition animation.
	 */
	function doTransition (reverse) {
		var $nextSlide = $('div:eq(' + currentIndex + ')', $stage);

		if ($nextSlide.find('img').length === 0) {
			if (waitTimeout !== undefined) {
				clearTimeout(waitTimeout);
			}

			// The target slide's image is not loaded yet, wait another half second and try again
			waitTimeout = setTimeout(function () {
				doTransition(reverse);
			}, 1000);

			return;
		}

		trigger('fullscreenLoad', settings.onLoad);

		animating = true;

		$controlsWrap.add($fsControls).addClass('fs-animating');
		$('.fs-prev-slide', $stage).removeClass('fs-prev-slide');

		var $currentSlide = $('.fs-current-slide', $stage).removeClass('fs-current-slide').addClass('fs-prev-slide');

		// Preload the next image in the direction we are going
		if (!reverse) {
			load(getNextIndex());
		} else {
			load(getPrevIndex());
		}

		setActiveBullet();

		if (settings.save) {
			setCookie('fullscreenSavedBackground', currentIndex);
		}

		// Hide captions before transitioning
		if (settings.alwaysShowCaptions || isMaximised) {
			$captionOuter.stop().animate({opacity: 0}, settings.captionSpeed, function () {
				$captionOuter.hide();
			});
		}

		$nextSlide.css('visibility', 'hidden').addClass('fs-current-slide');

		if (settings.lowQuality) {
			$stage.addClass('fullscreen-low');
		}

		switch (settings.transition) {
			case 'none':
				$nextSlide.css('visibility', 'visible'); doneTransition();
				break;
			default:
			case 'fade':
				$nextSlide.css({ opacity: 0, visibility: 'visible' })
					.animate({ opacity: 1 }, settings.speed, settings.easing, function () {
						$currentSlide.css('visibility', 'hidden'); /* Prevent deterioration of the transition in Chrome */
						doneTransition();
					});
				break;
			case 'fadeOutFadeIn':
				var fadeIn = function () {
					$nextSlide.css({ opacity: 0, visibility: 'visible' }).animate({ opacity: 1 }, settings.speed, settings.easing, doneTransition);
				};

				if ($currentSlide.length) {
					$currentSlide.animate({opacity: 0}, settings.speed, settings.easing, fadeIn);
				} else {
					fadeIn();
				}
				break;
			case 'slideDown':
				if (!reverse) {
					$nextSlide.css({ top: -$stage.height(), visibility: 'visible' }).animate({ top: 0 }, settings.speed, settings.easing, doneTransition);
				} else {
					$nextSlide.css({ top: $stage.height(), visibility: 'visible' }).animate({ top: 0 }, settings.speed, settings.easing, doneTransition);
				}
				break;
			case 'slideRight':
				if (!reverse) {
					$nextSlide.css({ left: $stage.width(), visibility: 'visible' }).animate({ left: 0 }, settings.speed, settings.easing, doneTransition);
				} else {
					$nextSlide.css({ left: -$stage.width(), visibility: 'visible' }).animate({ left: 0 }, settings.speed, settings.easing, doneTransition);
				}
				break;
			case 'slideUp':
				if (!reverse) {
					$nextSlide.css({ top: $stage.height(), visibility: 'visible' }).animate({ top: 0 }, settings.speed, settings.easing, doneTransition);
				} else {
					$nextSlide.css({ top: -$stage.height(), visibility: 'visible' }).animate({ top: 0 }, settings.speed, settings.easing, doneTransition);
				}
				break;
			case 'slideLeft':
				if (!reverse) {
					$nextSlide.css({ left: -$stage.width(), visibility: 'visible' }).animate({ left: 0 }, settings.speed, settings.easing, doneTransition);
				} else {
					$nextSlide.css({ left: $stage.width(), visibility: 'visible' }).animate({ left: 0 }, settings.speed, settings.easing, doneTransition);
				}
				break;
			case 'carouselRight':
				if (!reverse) {
					$nextSlide.css({ left: $stage.width(), visibility: 'visible' }).animate({ left: 0 }, settings.speed, settings.easing, doneTransition);
					$currentSlide.animate({ left: -$stage.width() }, settings.speed, settings.easing);
				} else {
					$nextSlide.css({ left: -$stage.width(), visibility: 'visible' }).animate({ left: 0 }, settings.speed, settings.easing, doneTransition);
					$currentSlide.css({ left: 0 }).animate({left: $stage.width()}, settings.speed, settings.easing);
				}
				break;
			case 'carouselLeft':
				if (!reverse) {
					$nextSlide.css({ left: -$stage.width(), visibility: 'visible' }).animate({ left: 0 }, settings.speed, settings.easing, doneTransition);
					$currentSlide.animate({left: $stage.width()}, settings.speed, settings.easing);
				} else {
					$nextSlide.css({ left: $stage.width(), visibility: 'visible' }).animate({ left: 0 }, settings.speed, settings.easing, doneTransition);
					$currentSlide.css({ left: 0 }).animate({left: -$stage.width()}, settings.speed, settings.easing);
				}
				break;
		}
	}

	/**
	 * Actions to run when the transition animation is complete
	 */
	function doneTransition() {
		animating = false;

		if (settings.lowQuality) {
			$stage.removeClass('fullscreen-low');
		}

		var caption = backgrounds[currentIndex].caption || '',
		captionPosition = backgrounds[currentIndex].captionPosition || settings.captionPosition;

		if (captionPosition === 'random') {
			captionPosition = random(captionXPositions) + ' ' + random(captionYPositions);
		}

		if (caption) {
			$caption.html(caption);
			settings.captionEnhancement($captionOuter);
			$captionOuter.attr('class', 'fullscreen-caption-outer') // Remove any previous caption position class
						 .addClass('fs-position-' + captionPosition.split(' ').join('-'));

			if (settings.alwaysShowCaptions || isMaximised) {
				$captionOuter.stop(true, true).show().animate({opacity: 1}, settings.captionSpeed);
			}
		} else {
			$caption.html('');
		}

		$controlsWrap.add($fsControls).removeClass('fs-animating');

		trigger('fullscreenComplete', settings.onComplete);
	}

	/**
	 * Set the active bullet
	 */
	function setActiveBullet() {
		if (settings.bullets && total > 1) {
			$bullets.children().removeClass('active-bullet').eq(currentIndex).addClass('active-bullet');
		}
	}

	/**
	 * Go to full screen mode
	 */
	fullscreen.max = function () {
		trigger('fullscreenMaxStart');

		$body.css('overflow', 'hidden');

		if (!settings.breakerOnMax) {
			$breaker.fadeOut(settings.hideSpeed);
		}

		$('#outside').fadeOut(settings.hideSpeed).hide(0, function () {
			isMaximised = true;
			$body.removeClass('fullscreen-mode-normal').addClass('fullscreen-mode-full');
			$controlsWrap.fadeIn(settings.controlSpeed).show(0, function () {
				if (settings.keyboard) {
					$(document).bind('keydown.fullscreen', function (e) {
						if (e.keyCode === 27) {
							e.preventDefault();
							fullscreen.close();
						}
					});
				}
			});

			if(!animating && $caption.html()) {
				$captionOuter.show().animate({opacity: 1}, settings.captionSpeed);
			}

			if (settings.keyboard) {
				$(document).bind('keydown.fullscreen', function (e) {
					if (e.keyCode === 37) {
						e.preventDefault();
						fullscreen.prev();
					} else if (e.keyCode === 39) {
						e.preventDefault();
						fullscreen.next();
					}
				});
			}
		});

		trigger('fullscreenMaxEnd');
		$window.resize();
	};

	/**
	 * Exit from full screen mode
	 */
	fullscreen.close = function () {
		trigger('fullscreenCloseStart');
		$(document).unbind('keydown.fullscreen');
		$controlsWrap.stop(true, true).hide();
		if (!settings.alwaysShowCaptions) {
			$captionOuter.stop(true, true).hide().css({ opacity: 0 });
		}
		isMaximised = false;

		$('#outside').fadeIn(settings.showSpeed);

		if (settings.breaker) {
			$breaker.fadeIn(settings.showSpeed);
		}

		$body.removeClass('fullscreen-mode-full').addClass('fullscreen-mode-normal').css('overflow', bodyOverflow);

		trigger('fullscreenCloseEnd');
		$window.resize();
	};

	/**
	 * Load the next image
	 */
	fullscreen.next = function () {
		if (animating) {
			return false;
		}

		currentIndex = getNextIndex();

		// Make sure this image is loaded
		if (imageCache[currentIndex] === undefined) {
			load(currentIndex, doTransition);
		} else {
			doTransition();
		}
	};

	/**
	 * Load the previous image
	 */
	fullscreen.prev = function () {
		if (animating) {
			return false;
		}

		currentIndex = getPrevIndex();

		// Make sure this image is loaded
		if (imageCache[currentIndex] === undefined) {
			load(currentIndex, function () {
				doTransition(true);
			});
		} else {
			doTransition(true);
		}
	};

	/**
	 * Load the image at the given index
	 */
	fullscreen.go = function (index) {
		if (animating || currentIndex === index) {
			return false;
		}

		currentIndex = index;

		// Make sure this image is loaded
		if (imageCache[currentIndex] === undefined) {
			if (index > currentIndex) {
				load(currentIndex, doTransition);
			} else {
				load(currentIndex, function () {
					doTransition(true);
				});
			}
		} else {
			doTransition();
		}
	};

	/**
	 * Start the slideshow
	 */
	fullscreen.start = function () {
		if (settings.slideshow && !slideshowStarted) {
			slideshowStarted = true;

			$outer.bind('fullscreenComplete', function () {
				slideshowTimeout = setTimeout(fullscreen.next, settings.slideshowSpeed);
			}).bind('fullscreenLoad', function () {
				clearTimeout(slideshowTimeout);
			});

			$play
				.removeClass('fullscreen-play')
				.addClass('fullscreen-pause')
				.add($fsPlay)
				.unbind('click')
				.one('click', function () {
					setCookie('fullscreenSlideshow', 'stop');
					fullscreen.stop();
				});
			$fsPlay
				.removeClass('fs-play')
				.addClass('fs-pause');

			slideshowTimeout = setTimeout(fullscreen.next, settings.slideshowSpeed);
		}
	};

	/**
	 * Stop the slideshow
	 */
	fullscreen.stop = function () {
		if (settings.slideshow) {
			clearTimeout(slideshowTimeout);

			$outer.unbind('fullscreenLoad fullscreenComplete');

			$play
				.removeClass('fullscreen-pause')
				.addClass('fullscreen-play')
				.add($fsPlay)
				.unbind('click')
				.one('click', function () {
					setCookie('fullscreenSlideshow', 'start');
					fullscreen.start();
				});
			$fsPlay
				.removeClass('fs-pause')
				.addClass('fs-play');

			slideshowStarted = false;
		}
	};
})(jQuery, window);
