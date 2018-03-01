/*
 * ThemeCatcher Options Panel JavaScript
 *
 * Copyright www.themecatcher.net
 * All rights reserved.
 */
;(function ($, window) {
	"use strict";

	// Array of colours used for colourpicker palette
	var colourPickerPalette = [];

	var reactOptions = window.reactOptions = {
		$form: null,
		hooks: {},
		options: {},
		savedFormJson: '',

		/**
		 * Initialise options panel
		 * @param array options
		 */
		init: function (options) {
			reactOptions.$form = $('#react-options-form');
			if (!reactOptions.$form.length) return;

			// Cache root for live events
			var $wrap = $('.react-wrap');

			reactOptions.options = options;

			// Prevent the enter key from submitting the form
			reactOptions.$form.submit(function(e) { e.preventDefault(); }).attr('autocomplete', 'off');

			$('#react-tabs-nav').fptabs('#react-tabs > div', { current: 'react-current' });

			$('.react-sub-tabs-nav').each(function (i) {
				$(this).fptabs($('.react-sub-tabs').eq(i).find('> div'), { current: 'react-current' });
			});

			$('.react-table-tabs-nav').each(function (i) {
				$(this).fptabs($('.react-table-tabs').eq(i).find('> div'), { current: 'react-current' });
			});

			if (window.location.hash == '#import-case-study') {
				$('#react-design-tab').click();
				$('#react-import-cs-tab').click();
			}

			// Layout selector
			$('.react-layout-selector').each(function () {
				var $select = $(this),
				$options = $select.find('option'),
				activeClass = 'react-select-active',
				$wrap = $('<div class="react-layout-selector react-selector"/>');

				$options.each(function () {
					var $this = $(this),
					$layout = $('<div class="react-layout-option react-tooltip"/>').appendTo($wrap).click(function () {
						$wrap.find('> div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val($this.val()).change();
					}).append('<img src="' + reactAdminL10n.themeAdminUrl + '/images/select-layout-' + ($this.val() || 'default') + '.png" alt="" />');

					var $tooltip = $('<span class="react-tooltip-text">').html($this.html());
					$layout.append($tooltip);

					if ($this.is(':selected')) {
						$layout.addClass(activeClass);
					}
				});

				$select.hide().after($wrap);
			});

			// Initialise elements from admin.js
			setTimeout(function () {
				reactOptions.toggleSwitches();
				setTimeout(function () {
					reactAdmin.accordion();
					setTimeout(function () {
						reactAdmin.textureSelectors();
						setTimeout(function () {
							reactAdmin.iconSelectors($wrap);
							setTimeout(function () {
								reactAdmin.rangeSliders();
								setTimeout(function () {
									reactOptions.colourPickers();
									setTimeout(function () {
										reactAdmin.backgroundPositionSelectors();
										setTimeout(function () {
											reactAdmin.backgroundRepeatSelectors();
										}, 20);
									}, 20);
								}, 20);
							}, 20);
						}, 20);
					}, 20);
				}, 20);
			}, 20);

			$('#react-download-cs').click(function (e) {
				e.preventDefault();

				$('#react-tabs-nav').data('tabs').click(0);
				$('.react-tab-0 .react-sub-tabs-nav').data('tabs').click(6);
			});

			$('.react-welcome-hide .react-button').click(function (e) {
				e.preventDefault();

				if (!confirm(reactAdminL10n.confirmHideWelcome)) {
					return;
				}

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'react_hide_welcome_tab_ajax'
					}
				});

				$('.qtip').hide();
				$('.react-sub-tabs-nav').eq(0).data('tabs').click(1);
				$('#react-welcome-trigger, #react-welcome-tab').remove();
			});

			var $previewOverlay = $('#react-website-preview-overlay'),
				$preview = $('#react-website-preview');

			$('.react-preview-link').click(function (e) {
				e.preventDefault();

				var width = $(this).data('width') || 800,
					height = $(this).data('height') || 600,
					marginLeft = -width / 2,
					marginTop = -height / 2;

				var $iframe = $('<iframe>').attr('src', reactAdminL10n.homeUrl).css({ height: '100%', width: '100%' });
				$preview.html($iframe).css({ width: width, height: height, marginLeft: marginLeft, marginTop: marginTop });
				$preview.append('<div class="react-overlay-buttons"><div class="react-overlay-button react-overlay-button-close" title="' + reactAdminL10n.cancel + '"></div></div>');
				$previewOverlay.show();
			});

			var closePreview = function (e) {
				e.stopPropagation();
				$previewOverlay.hide();
				$preview.html('');
			};

			$previewOverlay.click(closePreview);
			$('#react-website-preview-overlay .react-overlay-button-close').on('click', closePreview);

			$('.react-page-layout-selector').each(function () {
				var $select = $(this),
				$options = $select.find('option'),
				activeClass = 'react-select-active',
				$wrap = $('<div class="react-page-layout-selector react-selector"/>');

				$options.each(function () {
					var $this = $(this);

					var $layout = $('<div class="react-page-layout-option react-tooltip"/>').appendTo($wrap).click(function () {
						$wrap.find('> div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val($this.val()).change();
					}).append('<img src="' + reactAdminL10n.themeAdminUrl + '/images/' + ($this.val() || 'default') + '.gif" alt="" />');

					var $tooltip = $('<span class="react-tooltip-text">').html($this.html());
					$layout.append($tooltip);

					if ($this.is(':selected')) {
						$layout.addClass(activeClass);
					}
				});

				$select.hide().after($wrap);
			});

			$('.react-header-tophead-type-selector').each(function () {
				var $select = $(this),
				$options = $select.find('option'),
				activeClass = 'react-select-active',
				$wrap = $('<div class="react-header-tophead-type-selector react-selector"/>');

				$options.each(function () {
					var $this = $(this);

					var $layout = $('<div class="react-header-tophead-type-option react-tooltip"/>').appendTo($wrap).click(function () {
						$wrap.find('> div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val($this.val()).change();
					}).append('<img src="' + reactAdminL10n.themeAdminUrl + '/images/' + ($this.val() || 'default') + '.gif" alt="" />');

					var $tooltip = $('<span class="react-tooltip-text">').html($this.html());
					$layout.append($tooltip);

					if ($this.is(':selected')) {
						$layout.addClass(activeClass);
					}
				});

				$select.hide().after($wrap);
			});

			$('.react-social_icon_type-selector').each(function () {
				var $select = $(this),
				$options = $select.find('option'),
				activeClass = 'react-select-active',
				$wrap = $('<div class="react-social_icon_type-selector react-selector"/>');

				$options.each(function () {
					var $this = $(this);

					var $layout = $('<div class="react-social_icon_type-option react-tooltip"/>').appendTo($wrap).click(function () {
						$wrap.find('> div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val($this.val()).change();
					}).append('<img src="' + reactAdminL10n.themeAdminUrl + '/images/' + ($this.val().split(' ').join('-') || 'default') + '.png" alt="" />');

					var $tooltip = $('<span class="react-tooltip-text">').html($this.html());
					$layout.append($tooltip);

					if ($this.is(':selected')) {
						$layout.addClass(activeClass);
					}
				});

				$select.hide().after($wrap);
			});

			$wrap.on('click', '.react-background-group-images .react-delete-uploaded-image', function () {
				$('.qtip').hide();
				$(this).closest('.react-uploaded-image').remove();
			});

			// Editing background
			var $currentlyEditingBg,
			$bgSettingsForm = $('#react-background-settings-overlay'),
			$bgTitle = $('#react-background-title'),
			$bgCaption = $('#react-background-caption'),
			$bgCaptionPosition = $('#react-background-caption-position'),
			closeBgSettings = function () {
				$bgSettingsForm.hide();
				$bgTitle.add($bgCaption).add($bgCaptionPosition).val('');
				$(document).unbind('keyup.edit-background-image');
			},
			saveBgSettings = function () {
				var background = $currentlyEditingBg.data('image');

				background.title = $bgTitle.val();
				background.caption = $bgCaption.val();
				background.captionPosition = $bgCaptionPosition.val();

				$currentlyEditingBg.data('image', background);

				closeBgSettings();
			},
			$buttonWrap = $('<div class="react-overlay-buttons"/>').appendTo($('#react-background-settings'));

			$wrap.on('click', '.react-background-group-images .react-edit-background-image', function (e) {
				$bgSettingsForm.show();
				$currentlyEditingBg = $(this).closest('.react-uploaded-image');

				var background = $currentlyEditingBg.data('image');
				$bgTitle.val(background.title);
				$bgCaption.val(background.caption);
				$bgCaptionPosition.val(background.captionPosition);

				$(document).bind('keyup.edit-background-image', function (e) {
					if (e.keyCode === 27) {
						closeBgSettings();
					}
				});
			});

			$('#react-background-caption-save').click(function () {
				saveBgSettings();
			});

			$('#react-background-caption-cancel').click(closeBgSettings);

			$('<div class="react-overlay-button react-overlay-button-close"/>').click(function () {
				closeBgSettings();
			}).appendTo($buttonWrap).attr('title', reactAdminL10n.cancel);

			$('<div class="react-overlay-button react-overlay-button-save"/>').click(function () {
				saveBgSettings();
			}).appendTo($buttonWrap).attr('title', reactAdminL10n.save);

			// Background image groups
			var $backgroundGroups = $('#react-background-groups'),
				getNextGroupId = function () {
					var id = 0;
					$backgroundGroups.find('> .react-background-group').each(function () {
						id = Math.max($(this).data('id'), id);
					});
					return id + 1;
				};

			$('#react-add-background-group-button').click(function () {
				var $group = $(reactAdminL10n.backgroundGroupHtml),
					id = getNextGroupId();

				$group.data('id', id).find('.react-background-group-id-num').text(id);

				$backgroundGroups.append($group);

				$group.find('.react-edit-background-group').click()
				.end().find('.react-background-group-name-input').focus().select();

				reactOptions.addBackgroundGroupUploader($group);

				$group.find('.react-background-group-images').sortable({
					placeholder: 'react-sortable-placeholder',
					connectWith: '.react-background-group-images'
				});

				reactOptions.updateBackgroundGroupSelects();

				return false;
			});

			$backgroundGroups.on('blur', '.react-background-group-name-input', reactOptions.updateBackgroundGroupSelects);

			$backgroundGroups.on('click', '.react-background-group-name-input', function (e) {
				e.stopPropagation();

				if ($(this).val() === reactAdminL10n.untitled) {
					$(this).select();
				}
			});

			// Set up uploaders for existing background groups
			$('.react-background-group').each(function () {
				reactOptions.addBackgroundGroupUploader($(this));
			});

			// Existing uploaded backgrounds sortable
			$('.react-background-group-images').sortable({
				placeholder: 'react-sortable-placeholder',
				connectWith: '.react-background-group-images'
			});

			$backgroundGroups.on('click', '.react-edit-background-group', function (e) {
				e.stopPropagation();

				var $root = $(this).closest('.react-background-group'),
					$settings = $root.find('.react-background-group-settings'),
					$nameLabel = $root.find('.react-background-group-name-inner'),
					$nameInput = $root.find('.react-background-group-name-input');

				if ($root.hasClass('react-open')) {
					$settings.add($nameInput).hide();
					$nameLabel.text($nameInput.val()).show();
					$root.removeClass('react-open');
				} else {
					$nameLabel.hide();
					$settings.add($nameInput).show();
					$root.addClass('react-open');
				}
			});

			$backgroundGroups.on('click', '.react-background-group-name', function (e) {
				$(this).siblings('.react-edit-background-group').click();
			});

			// Stop selection of the area when clicking open/close repeatedly
			$backgroundGroups.on('selectstart', '.react-background-group-name', function () {
				return false;
			});

			$backgroundGroups.on('click', '.react-delete-background-group', function (e) {
				e.stopPropagation();

				if (confirm(reactAdminL10n.confirmDeleteBackgroundGroup)) {
					$(this).closest('.react-background-group').remove();
					reactOptions.updateBackgroundGroupSelects();
					$('.qtip').hide();
				}
			});

			// Background video data check
			$('#background_video').bind('blur', function () {
				var url = $(this).val();

				if (url) {
					var vimeoPattern = /http(s)?:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/,
						vimeoMatch = url.match(vimeoPattern),
						youtubePattern = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/,
						youtubeMatch = url.match(youtubePattern),
						videoId;

					if (vimeoMatch) {
						videoId = vimeoMatch[3];
						if (videoId) {
							$.getJSON('http://vimeo.com/api/v2/video/' + videoId + '.json?callback=?', function (response) {
								if (response !== null && typeof response[0] === 'object' && response[0].width && response[0].height) {
									$('#background_video_width').val(response[0].width);
									$('#background_video_height').val(response[0].height);
								}
							});
						}
					} else if (youtubeMatch) {
						videoId = RegExp.$1;
						if (videoId) {
							$.ajax({
								url: reactAdminL10n.ajaxUrl,
								data: {
									action: 'react_get_youtube_video_dimensions',
									id: videoId
								},
								dataType: 'json'
							})
							.done(function (response) {
								response = reactAdmin.sanitizeResponse(response);

								if (response.type === 'success') {
									$('#background_video_width').val(response.width);
									$('#background_video_height').val(response.height);
								}
							});
						}
					}
				} else {
					$('#background_video_width').val('');
					$('#background_video_height').val('');
				}
			});

			// Background audio
			var $audioTracks = $('#react-audio-tracks'),
				getNextTrackId = function () {
					var id = 0;
					$audioTracks.find('> .react-audio-track').each(function () {
						id = Math.max($(this).data('id'), id);
					});
					return id + 1;
				};

			$('#react-add-audio-track-button').click(function () {
				var $track = $(reactAdminL10n.backgroundAudioHtml).data('id', getNextTrackId());

				$audioTracks.append($track);

				$track.find('.react-edit-audio-track').click()
				.end().find('.react-audio-track-name-input').focus().select();

				reactOptions.addAudioUploaders($track);

				return false;
			});

			// Make the tracks sortable
			$audioTracks.sortable({
				handle: '.react-drag-audio-track'
			});

			// Edit audio track
			$audioTracks.on('click', '.react-edit-audio-track', function () {
				var $root = $(this).closest('.react-audio-track'),
				$settings = $root.find('.react-audio-track-settings'),
				$nameLabel = $root.find('.react-audio-track-name-inner'),
				$nameInput = $root.find('.react-audio-track-name-input');

				if ($root.hasClass('react-open')) {
					$settings.add($nameInput).hide();
					$nameLabel.show();
					$root.removeClass('react-open');
				} else {
					$nameLabel.hide();
					$settings.add($nameInput).show();
					$root.addClass('react-open');
				}
			});

			$audioTracks.on('click', '.react-audio-track-name-input', function (e) {
				e.stopPropagation();

				if ($(this).val() === reactAdminL10n.untitled) {
					$(this).select();
				}
			});

			// Change track name when typed
			$audioTracks.on('keyup blur', '.react-audio-track-name-input', function () {
				var $this = $(this);
				$this.siblings('.react-audio-track-name-inner').text($this.val());
			});

			// Delete audio track
			$audioTracks.on('click', '.react-delete-audio-track', function (e) {
				e.stopPropagation();

				if (confirm(reactAdminL10n.confirmDeleteAudioTrack)) {
					$(this).closest('.react-audio-track').remove();
					$('.qtip').hide();
				}
			});

			$audioTracks.on('click', '.react-audio-track-name', function (e) {
				$(this).siblings('.react-edit-audio-track').click();
			});

			// Stop selection of the area when clicking open/close repeatedly
			$audioTracks.on('selectstart', '.react-audio-track-name', function () {
				return false;
			});

			// Set up audio uploaders
			$('.react-audio-track').each(function () {
				reactOptions.addAudioUploaders($(this));
			});

			// Logo uploader
			var $generalLogo = $('#general_logo'),
				$generalLogoWidth = $('#general_logo_image_width'),
				$generalLogoHeight = $('#general_logo_image_height'),
				$generalLogoUploadHolder = $('#general_logo_upload_holder');

			reactAdmin.mediaBrowser($('#general_logo_upload'), {
				mediaOptions: reactAdmin.imageMediaOptions,
				callback: function (selection) {
					try {
						var image = selection.first().toJSON();
						var shortUrl = reactAdmin.makeUploadUrlRelative(image.url);

						$generalLogo.val(shortUrl).blur();
						$generalLogoWidth.val(image.width);
						$generalLogoHeight.val(image.height);
					} catch (ex) {
						reactAdmin.log(selection);
						throw ex;
					}
				}
			});

			$generalLogo.blur(function () {
				reactAdmin.handleImageUploadSourceChange($generalLogo, $generalLogoUploadHolder, $generalLogoWidth, $generalLogoHeight);
			}).data('url', $generalLogo.val());

			$generalLogoUploadHolder.on('click', '.react-delete-uploaded-image', function () {
				$('.qtip').hide();
				$generalLogo.add($generalLogoWidth).add($generalLogoHeight).val('');
				$generalLogo.blur();
			});

			// Retina logo upload
			var $generalLogoDouble = $('#general_logo_double'),
				$generalLogoDoubleUploadHolder = $('#general_logo_double_upload_holder');

			reactAdmin.mediaBrowser($('#general_logo_double_upload'), {
				mediaOptions: reactAdmin.imageMediaOptions,
				callback: function (selection) {
					try {
						var image = selection.first().toJSON();
						var shortUrl = reactAdmin.makeUploadUrlRelative(image.url);

						$generalLogoDouble.val(shortUrl).blur();
					} catch (ex) {
						reactAdmin.log(selection);
						throw ex;
					}
				}
			});

			$generalLogoDouble.blur(function () {
				reactAdmin.handleImageUploadSourceChange($generalLogoDouble, $generalLogoDoubleUploadHolder);
			}).data('url', $generalLogoDouble.val());

			$generalLogoDoubleUploadHolder.on('click', '.react-delete-uploaded-image', function () {
				$('.qtip').hide();
				$generalLogoDouble.val('').blur();
			});

			// Alt Logo uploader
			var $generalLogoAlt = $('#general_logo_alternative'),
				$generalLogoAltWidth = $('#general_logo_alternative_image_width'),
				$generalLogoAltHeight = $('#general_logo_alternative_image_height'),
				$generalLogoAltUploadHolder = $('#general_logo_alternative_upload_holder');

			reactAdmin.mediaBrowser($('#general_logo_alternative_upload'), {
				mediaOptions: reactAdmin.imageMediaOptions,
				callback: function (selection) {
					try {
						var image = selection.first().toJSON();
						var shortUrl = reactAdmin.makeUploadUrlRelative(image.url);

						$generalLogoAlt.val(shortUrl).blur();
						$generalLogoAltWidth.val(image.width);
						$generalLogoAltHeight.val(image.height);
					} catch (ex) {
						reactAdmin.log(selection);
						throw ex;
					}
				}
			});

			$generalLogoAlt.blur(function () {
				reactAdmin.handleImageUploadSourceChange($generalLogoAlt, $generalLogoAltUploadHolder, $generalLogoAltWidth, $generalLogoAltHeight);
			});

			$generalLogoAltUploadHolder.on('click', '.react-delete-uploaded-image', function () {
				$('.qtip').hide();
				$generalLogoAlt.add($generalLogoAltWidth).add($generalLogoAltHeight).val('');
				$generalLogoAlt.blur();
			});

			// Alt Retina logo upload
			var $generalLogoAltDouble = $('#general_logo_alternative_double'),
				$generalLogoAltDoubleUploadHolder = $('#general_logo_alternative_double_upload_holder');

			reactAdmin.mediaBrowser($('#general_logo_alternative_double_upload'), {
				mediaOptions: reactAdmin.imageMediaOptions,
				callback: function (selection) {
					try {
						var image = selection.first().toJSON();
						var shortUrl = reactAdmin.makeUploadUrlRelative(image.url);

						$generalLogoAltDouble.val(shortUrl).blur();
					} catch (ex) {
						reactAdmin.log(selection);
						throw ex;
					}
				}
			});

			$generalLogoAltDouble.blur(function () {
				reactAdmin.handleImageUploadSourceChange($generalLogoAltDouble, $generalLogoAltDoubleUploadHolder);
			});

			$generalLogoAltDoubleUploadHolder.on('click', '.react-delete-uploaded-image', function () {
				$('.qtip').hide();
				$generalLogoAltDouble.val('').blur();
			});

			// Footer logo uploader
			var $footerLogo = $('#footer_logo'),
				$footerLogoWidth = $('#footer_logo_image_width'),
				$footerLogoHeight = $('#footer_logo_image_height'),
				$footerLogoUploadHolder = $('#footer_logo_upload_holder');

			reactAdmin.mediaBrowser($('#footer_logo_upload'), {
				mediaOptions: reactAdmin.imageMediaOptions,
				callback: function (selection) {
					try {
						var image = selection.first().toJSON();
						var shortUrl = reactAdmin.makeUploadUrlRelative(image.url);

						$footerLogo.val(shortUrl).blur();
						$footerLogoWidth.val(image.width);
						$footerLogoHeight.val(image.height);
					} catch (ex) {
						reactAdmin.log(selection);
						throw ex;
					}
				}
			});

			$footerLogo.blur(function () {
				reactAdmin.handleImageUploadSourceChange($footerLogo, $footerLogoUploadHolder, $footerLogoWidth, $footerLogoHeight);
			}).data('url', $footerLogo.val());

			$footerLogoUploadHolder.on('click', '.react-delete-uploaded-image', function () {
				$('.qtip').hide();
				$footerLogo.add($footerLogoWidth).add($footerLogoHeight).val('');
				$footerLogo.blur();
			});

			// Footer retina logo
			var $footerLogoDouble = $('#footer_logo_double'),
				$footerLogoDoubleUploadHolder = $('#footer_logo_double_upload_holder');

			reactAdmin.mediaBrowser($('#footer_logo_double_upload'), {
				mediaOptions: reactAdmin.imageMediaOptions,
				callback: function (selection) {
					try {
						var image = selection.first().toJSON();
						var shortUrl = reactAdmin.makeUploadUrlRelative(image.url);

						$footerLogoDouble.val(shortUrl).blur();
					} catch (ex) {
						reactAdmin.log(selection);
						throw ex;
					}
				}
			});

			$footerLogoDouble.blur(function () {
				reactAdmin.handleImageUploadSourceChange($footerLogoDouble, $footerLogoDoubleUploadHolder);
			}).data('url', $footerLogoDouble.val());

			$footerLogoDoubleUploadHolder.on('click', '.react-delete-uploaded-image', function () {
				$('.qtip').hide();
				$footerLogoDouble.val('').blur();
			});

			// Favicon uploader
			reactAdmin.mediaBrowser($('#general_favicon_upload'), {
				mediaOptions: reactAdmin.imageMediaOptions,
				callback: function (selection) {
					try {
						var image = selection.first().toJSON();
						var shortUrl = reactAdmin.makeUploadUrlRelative(image.url);

						$('#general_favicon').val(shortUrl);
					} catch (ex) {
						reactAdmin.log(selection);
						throw ex;
					}
				}
			});

			// This part loops to set up the JS on the texture/detail/image fields for each section
			var sections = ['background', 'body', 'popdown', 'tophead', 'mainhead', 'solonav', 'intro', 'content', 'mainfoot', 'subfoot'];
			$.each(sections, function (i, key) {
				// Image / retina image uploaders
				$.each(['', '_retina'], function (j, retina) {
					reactAdmin.mediaBrowser($('#style_' + key + '_image' + retina + '_upload'), {
						mediaOptions: reactAdmin.imageMediaOptions,
						callback: function (selection) {
							try {
								var image = selection.first().toJSON();
								var shortUrl = reactAdmin.makeUploadUrlRelative(image.url);

								$('#style_' + key + '_image' + retina).val(shortUrl).blur();
								$('#style_' + key + '_image' + retina + '_width').val(image.width);
								$('#style_' + key + '_image' + retina + '_height').val(image.height);
							} catch (ex) {
								reactAdmin.log(selection);
								throw ex;
							}
						}
					});

					// Clear width/height and thumbnail if the field is manually emptied
					$('#style_' + key + '_image' + retina).blur(function () {
						reactAdmin.handleImageUploadSourceChange($('#style_' + key + '_image' + retina), $('#style_' + key + '_image' + retina + '_upload_holder'), $('#style_' + key + '_image' + retina + '_width'), $('#style_' + key + '_image' + retina + '_height'));
					}).data('url', $('#style_' + key + '_image' + retina).val());

					// Clear url/width/height and thumbnail if the remove image icon is clicked
					$('#style_' + key + '_image' + retina + '_upload_holder').on('click', '.react-delete-uploaded-image', function () {
						$('.qtip').hide();
						$('#style_' + key + '_image' + retina + ', #style_' + key + '_image' + retina + '_width, #style_' + key + '_image' + retina + '_height').val('');
						$('#style_' + key + '_image' + retina).blur();
					});

				}); // End each normal and retina

				$('#style_' + key + '_image_convert').change(function () {
					if ($(this).val() == 'custom') {
						$('#style_' + key + '_image_convert_custom').closest('.react-custom-convert-wrap').fadeIn();
					} else {
						$('#style_' + key + '_image_convert_custom').closest('.react-custom-convert-wrap').fadeOut();
					}
				}).change();

				$('#style_' + key + '_image_parallax').bind('keyup blur', function () {
					if ($(this).val() != '1') {
						$('#style_' + key + '_image_parallax_offset').closest('.react-multi-input-wrap').fadeIn();
					} else {
						$('#style_' + key + '_image_parallax_offset').closest('.react-multi-input-wrap').fadeOut();
					}
				}).blur();

				$('#style_' + key + '_image_retina_use_main_img').change(function () {
					var $this = $(this),
						val = $this.val();

					if (val == 'use-new-img') {
						$this.closest('.react-form-table-input-area-td').find('.image_retina_use_main_img_is_yes').slideDown();
					} else {
						$this.closest('.react-form-table-input-area-td').find('.image_retina_use_main_img_is_yes').slideUp();
					}

					if (val != 'never') {
						$this.closest('.react-form-table-input-area-td').find('.image_retina_use_main_img_is_yes_or').slideDown();
						$this.closest('.react-accordion-content').find('.react-background-image-retina-settings').slideDown();
					} else {
						$this.closest('.react-form-table-input-area-td').find('.image_retina_use_main_img_is_yes_or').slideUp();
						$this.closest('.react-accordion-content').find('.react-background-image-retina-settings').slideUp();
					}
				}).change();

			}); // End each section

			$('#general_font').change(function () {
				var val = $(this).val();

				if (val.length) {
					$('.react-show-if-heading-font-google').show();
				} else {
					$('.react-show-if-heading-font-google').hide();
				}
			}).change();

			$('#general_font_text').change(function () {
				var val = $(this).val();

				if (val == 'google') {
					$('.react-show-if-text-font-google').show();
				} else {
					$('.react-show-if-text-font-google').hide();
				}
			}).change();

			$('#background_video_complete').change(function () {
				if ($(this).val() == 'redirect') {
					$('#background_video_redirect_wrap').fadeIn();
				} else {
					$('#background_video_redirect_wrap').fadeOut();
				}
			}).change();

			$('#background_video_full_screen').change(function () {
				if ($(this).is(':checked')) {
					$('#background_video_full_screen_overlay_wrap').fadeIn();
				} else {
					$('#background_video_full_screen_overlay_wrap').fadeOut();
				}
			}).change();

			$('.react-description').click(function() {
				var $parent = $(this).toggleClass('react-zoom');
			});

			// Show hide options

			$('#im_contact_on').change(function () {
				if ($(this).is(':checked')) {
					$('#im_contact_on_hide').fadeIn();
				} else {
					$('#im_contact_on_hide').fadeOut();
				}
			}).change();
			$('#im_scroll_type_contact').change(function () {
				if ($(this).is(':checked')) {
					$('#im_scroll_type_contact_hide').fadeIn();
				} else {
					$('#im_scroll_type_contact_hide').fadeOut();
				}
			}).change();
			$('#react-im-custom-widget-areas').on('change', '.react-im-cwa-scroll', function () {
				if ($(this).is(':checked')) {
					$(this).closest('.react-form-table-input-area-td').find('.im_scroll_hide').fadeIn();
				} else {
					$(this).closest('.react-form-table-input-area-td').find('.im_scroll_hide').fadeOut();
				}
			}).change();
			$('#im_video_on').change(function () {
				if ($(this).is(':checked')) {
					$('#im_video_on_hide').fadeIn();
				} else {
					$('#im_video_on_hide').fadeOut();
				}
			}).change();
			$('#im_location_on').change(function () {
				if ($(this).is(':checked')) {
					$('#im_location_on_hide').fadeIn();
				} else {
					$('#im_location_on_hide').fadeOut();
				}
			}).change();
			$('#im_search_on').change(function () {
				if ($(this).is(':checked')) {
					$('#im_search_on_hide').fadeIn();
				} else {
					$('#im_search_on_hide').fadeOut();
				}
			}).change();

			$('#im_fscontrols_on').change(function () {
				if ($(this).is(':checked')) {
					$('#im_fscontrols_on_hide').fadeIn();
				} else {
					$('#im_fscontrols_on_hide').fadeOut();
				}
			}).change();
			$('#im_videocontrols_on').change(function () {
				if ($(this).is(':checked')) {
					$('#im_videocontrols_on_hide').fadeIn();
				} else {
					$('#im_videocontrols_on_hide').fadeOut();
				}
			}).change();
			$('#im_audiocontrols_on').change(function () {
				if ($(this).is(':checked')) {
					$('#im_audiocontrols_on_hide').fadeIn();
				} else {
					$('#im_audiocontrols_on_hide').fadeOut();
				}
			}).change();
			$('#im_woocart_on').change(function () {
				if ($(this).is(':checked')) {
					$('#im_woocart_on_hide').fadeIn();
				} else {
					$('#im_woocart_on_hide').fadeOut();
				}
			}).change();

			$('#show_footer_social_icon').change(function () {
				if ($(this).is(':checked')) {
					$('#footer_social_icon_type_hide').fadeIn();
				} else {
					$('#footer_social_icon_type_hide').fadeOut();
				}
			}).change();

			$('#show_header_social_icon').change(function () {
				if ($(this).is(':checked')) {
					$('#header_social_icon_type_hide').fadeIn();
				} else {
					$('#header_social_icon_type_hide').fadeOut();
				}
			}).change();

			$('#general_breadcrumbs').change(function () {
				if ($(this).is(':checked')) {
					$('#general_breadcrumbs_home_icon_hide').fadeIn();
				} else {
					$('#general_breadcrumbs_home_icon_hide').fadeOut();
				}
			}).change();

			$('#general_logo_above').change(function () {
				if ($(this).is(':checked')) {
					$('#general_logo_height_label').show();
					$('#general_logo_width_label').hide();
				} else {
					$('#general_logo_height_label').hide();
					$('#general_logo_width_label').show();
				}
			}).change();

			$('#woocommerce_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#woocommerce_convert_custom_hide').fadeIn();
				} else {
					$('#woocommerce_convert_custom_hide').fadeOut();
				}
			}).change();

			$('#pop_down_trigger_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#pop_down_trigger_convert_custom_hide').fadeIn();
				} else {
					$('#pop_down_trigger_convert_custom_hide').fadeOut();
				}
			}).change();

			$('#social_count_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#social_count_convert_custom_hide').fadeIn();
				} else {
					$('#social_count_convert_custom_hide').fadeOut();
				}
			}).change();

			$('#nav_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#nav_convert_custom_hide').fadeIn();
				} else {
					$('#nav_convert_custom_hide').fadeOut();
				}
			}).change();

			$('#subfoot_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#subfoot_convert_custom_hide').fadeIn();
				} else {
					$('#subfoot_convert_custom_hide').fadeOut();
				}
			}).change();

			$('#nav_prime_nav_location').change(function () {
				if ($(this).val() == 'prime_nav_in_solo') {
					$('#header_sticky_padding, #header_sticky_logo_top').closest('.react-multi-input-wrap').slideUp().prev('.react-break').slideUp();
				} else {
					$('#header_sticky_padding, #header_sticky_logo_top').closest('.react-multi-input-wrap').slideDown().prev('.react-break').slideDown();
				}
			}).change();

			$('#logo_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#logo_convert_custom_hide').fadeIn();
				} else {
					$('#logo_convert_custom_hide').fadeOut();
				}
			}).change();

			$('#top_nav_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#top_nav_convert_custom_hide').fadeIn();
				} else {
					$('#top_nav_convert_custom_hide').fadeOut();
				}
			}).change();

			$('#infomenu_dropdown_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#infomenu_dropdown_convert_custom_hide').fadeIn();
				} else {
					$('#infomenu_dropdown_convert_custom_hide').fadeOut();
				}
			}).change();

			$('#pop_down_trigger_absolute').change(function () {
				if ($(this).is(':checked')) {
					$('#only_for_absolute_popdown').fadeIn();
				} else {
					$('#only_for_absolute_popdown').fadeOut();
				}
			}).change();

			$('#footer_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#footer_convert_custom_hide').fadeIn();
				} else {
					$('#footer_convert_custom_hide').fadeOut();
				}
			}).change();

			$('#background_bullets_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#background_bullets_convert_custom_hide').fadeIn();
				} else {
					$('#background_bullets_convert_custom_hide').fadeOut();
				}
			}).change();

			$('#component_slider_convert_point').change(function () {
				if ($(this).val() == 'custom') {
					$('#component_slider_convert_point_custom_hide').fadeIn();
				} else {
					$('#component_slider_convert_point_custom_hide').fadeOut();
				}
			}).change();

			$('#quform_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#quform_convert_custom_hide').fadeIn();
				} else {
					$('#quform_convert_custom_hide').fadeOut();
				}
			}).change();

			$('#sidebar_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#sidebar_convert_custom_hide').fadeIn();
				} else {
					$('#sidebar_convert_custom_hide').fadeOut();
				}
			}).change();

			// Page loader
			$('#page_loader').change(function () {
				$('#page_loader_style').closest('.react-multi-input-wrap')[$(this).val() == 'full' ? 'fadeIn' : 'fadeOut']();
			}).change();

			var $reveal = $('#footer_reveal');

			$('#footer_position').change(function () {
				if ($(this).val() == 'fixed') {
					$('#only_for_fixed_subfooter').fadeIn();
					$('#footer_reveal_height_hide').fadeOut();
				} else {
					if ($reveal.is(':checked')) {
						$('#only_for_fixed_subfooter').fadeIn();
					} else {
						$('#only_for_fixed_subfooter').fadeOut();
					}
					$('#footer_reveal_height_hide').fadeIn();
				}
			}).change();

			$reveal.change(function () {
				if ($(this).is(':checked')) {
					$('#only_for_fixed_subfooter').fadeIn();
				} else {
					$('#only_for_fixed_subfooter').fadeOut();
				}
			}).change();

			$('#page_layout').change(function () {
				var val = $(this).val();

				if (val == 'pge-mxd') {
					$('#only_for_mixed').slideDown();
				} else {
					$('#only_for_mixed').slideUp();
				}
				if (val == 'pge-bxd-cnt') {
					$('.only_for_bxd_cnt').slideDown();
				} else {
					$('.only_for_bxd_cnt').slideUp();
				}

				if (val == 'pge-fld') {
					$('#pop_down_trigger_convert, #footer_convert').val('tablet-ldsp').change();
				} else {
					$('#pop_down_trigger_convert, #footer_convert').val('box-width').change();
				}

				if (val == 'mixed' || val == 'boxed') {
					$('.only_for_mixed_or_boxed').slideDown();
				} else {
					$('.only_for_mixed_or_boxed').slideUp();
				}
			}).change();

			$('#page_layout_stretched_allheader').change(function () {
				if ($(this).is(':checked')) {
					$('#page_layout_stretched_allheader_boxed_content_hide').fadeIn();
				} else {
					$('#page_layout_stretched_allheader_boxed_content_hide').fadeOut();
				}
			}).change();
			$('#page_layout_stretched_content').change(function () {
				if ($(this).is(':checked')) {
					$('#page_layout_stretched_content_boxed_content_hide').fadeIn();
				} else {
					$('#page_layout_stretched_content_boxed_content_hide').fadeOut();
				}
			}).change();
			$('#page_layout_stretched_top').change(function () {
				if ($(this).is(':checked')) {
					$('#page_layout_stretched_top_boxed_content_hide').fadeIn();
				} else {
					$('#page_layout_stretched_top_boxed_content_hide').fadeOut();
				}
			}).change();
			$('#page_layout_stretched_allfoot').change(function () {
				if ($(this).is(':checked')) {
					$('#page_layout_stretched_allfoot_boxed_content_hide').fadeIn();
				} else {
					$('#page_layout_stretched_allfoot_boxed_content_hide').fadeOut();
				}
			}).change();
			$('#page_layout_stretched_subfoot').change(function () {
				if ($(this).is(':checked')) {
					$('#page_layout_stretched_subfoot_boxed_content_hide').fadeIn();
				} else {
					$('#page_layout_stretched_subfoot_boxed_content_hide').fadeOut();
				}
			}).change();

			$('#footer_position').change(function () {
				if ($(this).val() == 'fixed') {
					$('#footer_position_height_hide').fadeIn();
				} else {
					$('#footer_position_height_hide').fadeOut();
				}
			}).change();

			$('#footer_position').change(function () {
				if ($(this).val() == 'fixed') {
					$('#footer_position_height_hide').fadeIn();
				} else {
					$('#footer_position_height_hide').fadeOut();
				}
			}).change();

			$('#footer_top_widget_area_layout').change(function () {
				if ($(this).val() !== '') {
					$('#footer_top_columns_convert_hide').fadeIn();
				} else {
					$('#footer_top_columns_convert_hide').fadeOut();
				}
			}).change();

			$('#footer_widget_area_layout').change(function () {
				if ($(this).val() !== '') {
					$('#footer_columns_convert_hide').fadeIn();
				} else {
					$('#footer_columns_convert_hide').fadeOut();
				}
			}).change();

			// Popdown
			$('#popdown_content_type').change(function () {
				if ($(this).val() == 'html') {
					$('#popdown_plain_content_wrap').show();
					$('#popdown_widget_area_layout_wrap').hide();
				} else {
					$('#popdown_plain_content_wrap').hide();
					$('#popdown_widget_area_layout_wrap').show();
				}
			}).change();

			// Color schemes in use
			$('#general_color_content_choose_scheme').change(function () {
				if ($(this).val() === '') {
					$('.hide-if-scheme-selected').show();
					$('.show-if-scheme-selected').hide();
				} else {
					$('.hide-if-scheme-selected').hide();
					$('.show-if-scheme-selected').show();
				}
			}).change();

			$('#general_color_subfoot_choose_scheme').change(function () {
				if ($(this).val() === '') {
					$('.hide-if-scheme-selected-subfoot').show();
					$('.show-if-scheme-selected-subfoot').hide();
				} else {
					$('.hide-if-scheme-selected-subfoot').hide();
					$('.show-if-scheme-selected-subfoot').show();
				}
			}).change();

			// Use FS controls in IM
			$('#controls_location_fs').change(function () {
				if ($(this).val() == 'infomenu') {
					$('#controls_location_fs_on').show();
					$('#controls_location_fs_off').hide();
				} else {
					$('#controls_location_fs_on').hide();
					$('#controls_location_fs_off').show();
				}
			}).change();

			// Use Audio controls in IM
			$('#controls_location_audio').change(function () {
				if ($(this).val() == 'infomenu') {
					$('#controls_location_audio_on').show();
					$('#controls_location_audio_off').hide();
				} else {
					$('#controls_location_audio_on').hide();
					$('#controls_location_audio_off').show();
				}
			}).change();

			// Use Video controls in IM
			$('#controls_location_video').change(function () {
				if ($(this).val() == 'infomenu') {
					$('#controls_location_video_on').show();
					$('#controls_location_video_off').hide();
				} else {
					$('#controls_location_video_on').hide();
					$('#controls_location_video_off').show();
				}
			}).change();

			// Slider show/hide
			$('#component_slider_homepage').change(function () {
				if ($(this).val() !== '') {
					$('#component_slider_id-wrap').show();
					$('#component_slider_convert_id-wrap').show();
				} else {
					$('#component_slider_id-wrap').hide();
					$('#component_slider_convert_id-wrap').hide();
				}
			}).change();

			// Shadow opacity
			$('#style_full_shadow').change(function () {
				if ($(this).val() !== '') {
					$('#style_full_shadow_hide').fadeIn();
				} else {
					$('#style_full_shadow_hide').fadeOut();
				}
			}).change();

			$('#style_outside_shadow').change(function () {
				if ($(this).is(':checked')) {
					$('#style_outside_shadow_hide').fadeIn();
				} else {
					$('#style_outside_shadow_hide').fadeOut();
				}
			}).change();

			$('#nav_prime_nav_location').change(function () {
				if ($(this).val() === 'prime_nav_in_head') {
					$(this).closest('.react-content-row').find('.only_for_solonav').hide();
				} else if (!$('#show_solonav_desktop').is(':checked') && !$('#show_solonav_phone').is(':checked') && !$('#show_solonav_tablet').is(':checked') && !$('#show_solonav_large').is(':checked')) {
					$(this).closest('.react-content-row').find('.only_for_solonav').show();
				}
			}).change();

			// Show hide options - ON / OFF section

			$('.react-on-off input').change(function () {
				if (!$('#show_popdown_desktop').is(':checked') && !$('#show_popdown_phone').is(':checked') && !$('#show_popdown_tablet').is(':checked') && !$('#show_popdown_large').is(':checked')) {
					$('.only_for_popdown').show();
				} else {
					$('.only_for_popdown').hide();
				}
				if (!$('#show_tophead_desktop').is(':checked') && !$('#show_tophead_phone').is(':checked') && !$('#show_tophead_tablet').is(':checked') && !$('#show_tophead_large').is(':checked')) {
					$('.only_for_tophead').show();
				} else {
					$('.only_for_tophead').hide();
				}
				if (!$('#show_infomenu_desktop').is(':checked') && !$('#show_infomenud_phone').is(':checked') && !$('#show_infomenud_tablet').is(':checked') && !$('#show_infomenu_large').is(':checked')) {
					$('.only_for_infomenu').show();
				} else {
					$('.only_for_infomenu').hide();
				}
				if (!$('#show_intro_desktop').is(':checked') && !$('#show_intro_phone').is(':checked') && !$('#show_intro_tablet').is(':checked') && !$('#show_intro_large').is(':checked')) {
					$('.only_for_intro').show();
				} else {
					$('.only_for_intro').hide();
				}
				if (!$('#show_solonav_desktop').is(':checked') && !$('#show_solonav_phone').is(':checked') && !$('#show_solonav_tablet').is(':checked') && !$('#show_solonav_large').is(':checked')) {
					$('.only_for_solonav').show();
					$('#nav_prime_nav_location').change();
				} else {
					$('.only_for_solonav').hide();
				}
				if (!$('#show_subfooter_desktop').is(':checked') && !$('#show_subfooter_phone').is(':checked') && !$('#show_subfooter_tablet').is(':checked') && !$('#show_subfooter_large').is(':checked')) {
					$('.only_for_subfooter').show();
				} else {
					$('.only_for_subfooter').hide();
				}
			}).change();

			function applyColorScheme(scheme)
			{
				if (!confirm(reactAdminL10n.change_colors)){
				  return false;
				}

				for (var id in scheme) {
					if (scheme.hasOwnProperty(id)) {
						$(id).val(scheme[id]).trigger('keyup');
					}
				}
			}

			$('.react-color-scheme').click(function () {
				var scheme = $(this).data('scheme');

				if (!confirm(reactAdminL10n.change_colors)){
					return false;
				}

				if (scheme && reactAdmin.schemes[scheme]) {
					for (var id in reactAdmin.schemes[scheme]) {
						if (reactAdmin.schemes[scheme].hasOwnProperty(id)) {
							$('#general_color_' + id).val(reactAdmin.schemes[scheme][id]).trigger('keyup');
						}
					}
				}

				return false;
			});

			$('#react-custom-palettes').on('click', '.react-palette-color-scheme', function () {
				var $this = $(this),
					scheme = $this.data('scheme'),
					$palette = $this.closest('.react-custom-palette');

				if (!confirm(reactAdminL10n.change_palette)){
					return false;
				}

				if (scheme && reactAdmin.paletteSchemes[scheme]) {
					for (var id in reactAdmin.paletteSchemes[scheme]) {
						if (reactAdmin.paletteSchemes[scheme].hasOwnProperty(id)) {
							$palette.find('.react-custom-palette-' + id).val(reactAdmin.paletteSchemes[scheme][id]).trigger('keyup');
						}
					}
				}

				return false;
			});

			$('#react-custom-palettes').sortable({
				placeholder: 'react-sortable-placeholder',
				handle: '.react-sort-custom-palette'
			});

			function getNextImCwaWidgetId()
			{
				var id = 0;
				$('#react-im-custom-widget-areas > div').each(function () {
					id = Math.max($(this).data('id'), id);
				});
				return id + 1;
			}

			// InfoMenu custom widget areas
			$('#react-im-add-widget-area').click(function () {
				var $widget = $(reactAdminL10n.imCustomWidgetAreaHtml),
					id = getNextImCwaWidgetId(),
					$sortOne = $('<div class="react-im-sort-one">');

				$widget.appendTo($('#react-im-custom-widget-areas'))
					   .data('id', id);

				$('.react-table-tabs-nav', $widget).each(function (i) {
					$(this).fptabs($('.react-table-tabs', $widget).eq(i).find('> div'), { current: 'react-current' });
				});

				$sortOne.data('id', 'im-cwa-' + id).text($widget.find('.react-im-cwa-name').val());

				$('#react-im-sort').append($sortOne);
				reactOptions.toggleSwitches($widget);
				$widget.find('.react-im-cwa-scroll').trigger('change');
			});

			function getNextCustomPaletteId()
			{
				var id = 0;
				$('#react-custom-palettes > div').each(function () {
					id = Math.max($(this).data('id'), id);
				});
				return id + 1;
			}

			// Custom colour palettes
			$('#react-add-custom-palette').click(function () {
				var $palette = $(reactAdminL10n.customPaletteHtml),
					id = getNextCustomPaletteId();

				$palette.appendTo($('#react-custom-palettes'))
					   .data('id', id)
					   .find('.react-custom-palette-id-num').text(id);

				$('.react-table-tabs-nav', $palette).each(function (i) {
					$(this).fptabs($('.react-table-tabs', $palette).eq(i).find('> div'), { current: 'react-current' });
				});

				$palette.find('.react-custom-palette-background-gradient').change();

				reactAdmin.accordion($palette);
				reactOptions.colourPickers($palette);
				reactOptions.toggleSwitches($palette);
				reactOptions.updateCustomPaletteDependents();
			});

			// Export
			var exporting = false;
			$('#react-start-export').click(function (e) {
				e.preventDefault();

				if (exporting) {
					return false;
				}
				exporting = true;

				reactOptions.update();

				var $loading = $(this).siblings('.react-export-loading').fadeIn(),
					onSuccess = function (data) {
						$('#react-export-textarea-wrap').show();
						$('#advanced_export').val(data);
						exporting = false;
					},
					onError = function (message) {
						alert('An error occurred fetching the export data:\n\n' + message);
						exporting = false;
					};

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'react_export_options_ajax',
						options: JSON.stringify(reactOptions.options),
						_ajax_nonce: reactAdminL10n.exportNonce
					},
					dataType: 'json'
				})
				.done(function (response) {
					response = reactAdmin.sanitizeResponse(response);

					if (response.type === 'success') {
						onSuccess(response.data);
					} else {
						onError(response.message);
					}
				})
				.fail(function () {
					onError('Ajax error');
				})
				.always(function () {
					$loading.hide();
				});
			});

			$('#advanced_export').click(function () {
				$(this).select();
			});

			// Import theme options
			var importing = false;
			$('#react-start-import').click(function (e) {
				e.preventDefault();

				if (importing) {
					return false;
				}
				importing = true;

				var $status = $('#react-import-status').html(''),
				onError = function (message) {
					$status.append('<p>Aborted!</p>');
					alert('An error occurred importing the data:\n\n' + message);
					importing = false;
				},
				onSuccess = function (response) {
					window.onbeforeunload = null; // Prevent "you have unsaved changes alert"
					$status.append('<p>'+ reactAdminL10n.reloadingPage + '...</p>');
					setTimeout(function () {
						window.location = '?page=react&message=import';
					}, 1000);
					importing = false;
				};

				$status.append('<p>'+ reactAdminL10n.startingImport + '...</p>');

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'react_import_options_ajax',
						options: $('#advanced_import').val(),
						_ajax_nonce: reactAdminL10n.importNonce
					},
					dataType: 'json'
				})
				.done(function (response) {
					response = reactAdmin.sanitizeResponse(response);

					if (response.type === 'success') {
						onSuccess();
					} else {
						onError(response.message);
					}
				})
				.fail(function() {
					onError('Ajax error');
				});
			});

			// Save theme options
			var saving = false;
			$('.react-save').click(function (e) {
				e.preventDefault();

				if (saving) {
					return;
				}
				saving = true;

				reactOptions.update();

				var $button = $(this).removeClass('react-save-save').addClass('react-save-saving');

				var optionsJSON = JSON.stringify(reactOptions.options),
					onSuccess = function () {
						reactOptions.savedFormJson = optionsJSON;
						$button.removeClass('react-save-saving').addClass('react-save-saved');
						$('#react-options-saved').fadeIn(200).show(0, function () {
							setTimeout(function () {
								$('#react-options-saved').fadeOut(350);
								$button.removeClass('react-save-saved').addClass('react-save-save');
							}, 800);
						});

						saving = false;
					},
					onError = function (message) {
						$button.removeClass('react-save-saving').addClass('react-save-save');
						alert('An error occurred saving the options:\n\n' + message);
						saving = false;
					};

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
					   action: 'react_save_options_ajax',
					   _ajax_nonce: reactAdminL10n.saveNonce,
					   options: optionsJSON
					},
					dataType: 'json'
				})
				.done(function (response) {
					response = reactAdmin.sanitizeResponse(response);

					if (response.type == 'success') {
						onSuccess();
					} else {
						onError(response.message);
					}
				})
				.fail(function () {
					onError('Ajax error');
				});
			});

			var resetting = false;
			$('#react-reset-options').click(function (e) {
				e.preventDefault();

				if (resetting) {
					return;
				}
				resetting = true;

				if (!confirm(reactAdminL10n.confirmResetOptions)) {
					resetting = false;
					return;
				}

				var onSuccess = function () {
					resetting = false;
					window.location = '?page=react&message=reset';
				},
				onError = function (message) {
					alert('An error occurred resetting the options:\n\n' + message);
					resetting = false;
				};

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'react_reset_options_ajax',
						_ajax_nonce: reactAdminL10n.resetNonce
					},
					dataType: 'json'
				})
				.done(function (response) {
					response = reactAdmin.sanitizeResponse(response);

					if (response.type === 'success') {
						onSuccess();
					} else {
						onError(response.message);
					}
				})
				.fail(function () {
					onError('Ajax error');
				});
			});

			// Show Case Studies
			var $caseStudiesWrap = $('#react-case-studies'),
				showingCaseStudies = false;

			$('#react-show-case-studies').click(function (e) {
				e.preventDefault();

				if (showingCaseStudies) {
					return;
				}
				showingCaseStudies = true;

				var setDefaultThumbnail = function () {
					$(this).attr('src', reactAdminL10n.themeAdminUrl + '/images/preview-coming-soon.png');
				};

				var onSuccess = function (caseStudies) {
					$caseStudiesWrap.empty();

					for (var i = 0, l = caseStudies.length; i < l; i++) {
						var caseStudy = caseStudies[i],
							$caseStudy = $(reactAdminL10n.caseStudyHtml),
							$thumb = $caseStudy.find('.react-case-study-thumbnail');

						if (caseStudy.thumbnail) {
							$thumb.on('error', setDefaultThumbnail);
							$thumb.attr('src', caseStudy.thumbnail);
						} else {
							setDefaultThumbnail.apply($thumb[0]);
						}

						$caseStudy.find('.react-case-study-name').html(caseStudy.name);
						$caseStudy.find('.react-case-study-thumbnail-wrap a').attr('href', caseStudy.preview);
						$caseStudy.find('.react-case-study-description').html(caseStudy.description);
						$caseStudy.find('.react-case-study-preview').attr('href', caseStudy.preview);
						$caseStudy.find('.react-case-study-install').data('caseStudy', caseStudy);
						$caseStudy.addClass('react-case-study-' + caseStudy.key);

						if (caseStudy.missingRequirements.length) {
							var $notices = $caseStudy.find('.react-case-study-right');
							for (var j = 0; j < caseStudy.missingRequirements.length; j++) {
								$notices.append('<p class="react-warning react-case-study-req">' + caseStudy.missingRequirements[j] + '</p>');
							}
						}

						$caseStudiesWrap.append($caseStudy);
					}
				},
				onError = function (message) {
					alert('An error occurred fetching the case studies:\n\n' + message);
				};

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'react_show_case_studies_ajax',
						_ajax_nonce: reactAdminL10n.showCaseStudiesNonce
					},
					dataType: 'json'
				})
				.done(function (response) {
					response = reactAdmin.sanitizeResponse(response);

					if (response.type === 'success') {
						onSuccess(response.caseStudies);
					} else {
						onError(response.message);
					}
				})
				.fail(function () {
					onError('Ajax error');
				})
				.always(function () {
					showingCaseStudies = false;
				});
			});

			// Install Case Study
			var $caseStudyVariationWrap = $('#react-case-study-variation-wrap'),
				$caseStudyVariationSelect = $('#react-case-study-variation');

			$caseStudiesWrap.on('click', '.react-case-study-install', function (e) {
				e.preventDefault();

				var caseStudy = $(this).data('caseStudy');

				$('#react-case-study-install-log').empty().hide();
				$caseStudyVariationWrap.hide();
				$caseStudyVariationSelect.empty();

				if (typeof caseStudy.variations === 'object' && caseStudy.variations.length > 0) {
					for (var i = 0; i < caseStudy.variations.length; i++) {
						var variation = caseStudy.variations[i];
						$caseStudyVariationSelect.append($('<option>', { value: variation.key, text: variation.name }));
					}

					$caseStudyVariationWrap.show();
				}

				// Show fixed position message
				var $overlay = $('.react-case-study-overlay');
				$overlay.find('.react-case-study-confirm-name').html(caseStudy.name);
				$overlay.fadeIn();

				$('#react-case-study-confirm-start').data('caseStudy', caseStudy);

				return;
			});

			var installingCaseStudy = false;
			$('#react-case-study-confirm-start').click(function (e) {
				e.preventDefault();

				if (installingCaseStudy) {
					return;
				}
				installingCaseStudy = true;

				var caseStudy = $(this).data('caseStudy');

				if (typeof caseStudy !== 'object' || typeof caseStudy.key !== 'string' || !caseStudy.key.length) {
					// Somehow the current case study data was lost
					alert('The Case Study data is missing, cancel the import and try again.');
					installingCaseStudy = false;
					return;
				}

				var $log = $('#react-case-study-install-log').empty(),
					$loading = $('#react-case-study-installing').fadeIn(),
					$waitLog = $('<div class="react-cs-log react-cs-log-info react-cs-log-wait">Please wait while the Case Study is imported</div>'),
					onSuccess = function (notices) {
						$('.react-case-study-hide-on-success').slideUp();
						$waitLog.remove();
						$('.react-case-study-show-on-success').slideDown();

						if (notices.length) {
							for (var i = 0; i < notices.length; i++) {
								$log.append('<div class="react-cs-log react-cs-log-' + notices[i].type + '">' + notices[i].message + '</div>');
							}
						} else {
							if ($log.children().length === 0) {
								$log.hide();
							}
						}
					},
					onError = function (message) {
						$waitLog.remove();
						$log.append('<div class="react-cs-log react-cs-log-error">An error occurred installing the Case Study: ' + message + '</div>');
					};

				$log.show().append($waitLog);

				var variation = $caseStudyVariationSelect.val() || '';

				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'react_install_case_study_ajax',
						_ajax_nonce: reactAdminL10n.installCaseStudyNonce,
						key: caseStudy.key,
						variation: variation
					},
					dataType: 'json'
				})
				.done(function (response) {
					response = reactAdmin.sanitizeResponse(response);

					if (response.type === 'success') {
						onSuccess(response.notices);
					} else {
						onError(response.message);
					}
				})
				.always(function () {
					$loading.hide();
					installingCaseStudy = false;
				});
			});

			$('#react-case-study-confirm-cancel').click(function (e) {
				if (installingCaseStudy) {
					return;
				}

				e.preventDefault();
				$('.react-case-study-overlay').hide();
			});

			$('#react-reset-translations').click(function (e) {
				e.preventDefault();
				if (confirm(reactAdminL10n.confirmResetTranslations)) {
					$('input[name^="translate_"]', reactOptions.$form).val('');
				}
			});

			$('#react-im-custom-widget-areas').on('click', '.react-im-delete-cwa', function () {
				if (confirm(reactAdminL10n.confirmDeleteImCwa)) {
					var $widget = $(this).closest('.react-im-custom-widget-area');
					$('#react-im-sort > div').filter(function () {
						return $(this).data('id') == 'im-cwa-' + $widget.data('id');
					}).remove();
					$widget.remove();
				}
			});

			$('#react-custom-palettes')
			.on('click', '.react-delete-custom-palette', function () {
				if (confirm(reactAdminL10n.confirmDeleteCustomPalette)) {
					$(this).closest('.react-custom-palette').remove();
					reactOptions.updateCustomPaletteDependents();
				}
			})
			.on('blur', '.react-custom-palette-name', function () {
				var $this = $(this),
					id = $this.closest('.react-custom-palette').data('id');

				$('.react-custom-palette-selector').find('option[value="' + id + '"]').text($this.val());
			})
			.on('change', '.react-custom-palette-background-gradient', function () {
				var $this = $(this),
					$palette = $this.closest('.react-custom-palette'),
					$color = $palette.find('.react-custom-palette-gradient-background-color'),
					$orientation = $palette.find('.react-custom-palette-gradient-orientation');

				$color.add($orientation).closest('.react-multi-input-wrap')[$this.is(':checked') ? 'show' : 'hide']();
			});

			$('#react-custom-palettes > .react-custom-palette').each(function () {
				$(this).find('.react-custom-palette-background-gradient').change();
			});

			$('#react-do-find-replace-color').click(function (e) {
				e.preventDefault();

				var $findInput = $('#react-find-color'),
					find = $findInput.val(),
					replace = $('#react-replace-color').val();

				if (find.length === 0) {
					alert(reactAdminL10n.pleaseEnterColor);
					return;
				}

				var $results = $('.react-colorpicker', '.react-colors-tab').not($findInput).filter(function () {
					return this.value === find;
				});

				var resultsCount = $results.length;

				if (resultsCount === 0) {
					alert(reactAdminL10n.noMatchingColors);
					return;
				}

				if (confirm(reactAdminL10n.areYouSureReplaceColors.replace('%d', resultsCount))) {
					$results.val(replace).blur();
				}
			});

			// Sortable InfoMenu widgets
			$('#react-im-sort').sortable();

			$('#react-im-custom-widget-areas').on('keyup blur', '.react-im-cwa-name', function () {
				var $widget = $(this).closest('.react-im-custom-widget-area');
				$('#react-im-sort > div').filter(function () {
					return $(this).data('id') == 'im-cwa-' + $widget.data('id');
				}).text($(this).val());
			});

			$('#advanced_combine_css').change(function() {
				if ($(this).is(':checked')) {
					$('#advanced_minify_css').closest('.react-form-table').show();
				} else {
					$('#advanced_minify_css').closest('.react-form-table').hide();
				}
			}).change();

			$('#advanced_combine_js').change(function() {
				if ($(this).is(':checked')) {
					$('#advanced_minify_js').closest('.react-form-table').show();
				} else {
					$('#advanced_minify_js').closest('.react-form-table').hide();
				}
			}).change();

			// If something has changed, show an alert if leaving the page
			reactOptions.update();
			reactOptions.savedFormJson = JSON.stringify(reactOptions.options);

			window.onbeforeunload = function () {
				reactOptions.update();
				if (reactOptions.savedFormJson !== JSON.stringify(reactOptions.options)) {
					return reactAdminL10n.unsaved_changes;
				}
			};

			$('.react-panel-loading').hide();
			$('.react-wrap').fadeIn();
		}, // end init()

		/**
		 * Update the JavaScript object to match the form values
		 */
		update: function () {
			reactOptions.options = reactOptions.$form.serializeObject();

			// Background groups
			var groups = {};
			$('.react-background-group').each(function () {
				var $group = $(this),
					groupId = $group.data('id'),
					backgrounds = [];

				$group.find('.react-background-group-images .react-uploaded-image').each(function () {
					backgrounds.push($(this).data('image'));
				});

				groups[groupId] = {
					name: $group.find('.react-background-group-name-input').val(),
					backgrounds: backgrounds
				};
			});
			reactOptions.options.background_groups = groups;

			// Audio tracks
			var tracks = [];
			$('#react-audio-tracks > .react-audio-track').each(function () {
				var $track = $(this);
				tracks.push({
					id: $(this).data('id'),
					name: $track.find('.react-audio-track-name-input').val(),
					m4a: $track.find('.react-audio-format-m4a').val(),
					mp3: $track.find('.react-audio-format-mp3').val(),
					oga: $track.find('.react-audio-format-ogg').val()
				});
			});
			reactOptions.options.background_audio = tracks;

			// InfoMenu custom widget areas
			var widgets = [];
			$('#react-im-custom-widget-areas > div').each(function () {
				var $widget = $(this);
				widgets.push({
					id: $widget.data('id'),
					name: $widget.find('.react-im-cwa-name').val(),
					box_type: $widget.find('.react-im-cwa-box_type').val(),
					scroll: $widget.find('.react-im-cwa-scroll').is(':checked'),
					scroll_height: $widget.find('.react-im-cwa-scroll_height').val(),
					title: $widget.find('.react-im-cwa-title').val(),
					icon: $widget.find('.react-icon-selector-hidden').val()
				});
			});
			reactOptions.options.im_custom_widget_areas = widgets;

			var imOrder = [];
			$('#react-im-sort > div').each(function () {
				imOrder.push($(this).data('id'));
			});
			reactOptions.options.im_order = imOrder;

			var palettes = [];
			$('#react-custom-palettes > .react-custom-palette').each(function () {
				var $palette = $(this);
				palettes.push({
					id: $palette.data('id'),
					name: $palette.find('.react-custom-palette-name').val(),
					background: $palette.find('.react-custom-palette-background').val(),
					background_gradient: $palette.find('.react-custom-palette-background-gradient').is(':checked') ? true : false,
					gradient_background_color: $palette.find('.react-custom-palette-gradient-background-color').val(),
					gradient_orientation: $palette.find('.react-custom-palette-gradient-orientation').val(),
					background_lighter: $palette.find('.react-custom-palette-background-lighter').val(),
					background_much_lighter: $palette.find('.react-custom-palette-background-much-lighter').val(),
					background_even_lighter: $palette.find('.react-custom-palette-background-even-lighter').val(),
					background_even_darker: $palette.find('.react-custom-palette-background-even-darker').val(),
					background_darker: $palette.find('.react-custom-palette-background-darker').val(),
					background_touch_darker: $palette.find('.react-custom-palette-background-touch-darker').val(),
					background_much_darker: $palette.find('.react-custom-palette-background-much-darker').val(),
					background_icon_image: $palette.find('.react-custom-palette-background-icon-image').val(),
					border: $palette.find('.react-custom-palette-border').val(),
					border_lr: $palette.find('.react-custom-palette-border-lr').val(),
					h1: $palette.find('.react-custom-palette-h1').val(),
					h2: $palette.find('.react-custom-palette-h2').val(),
					h3: $palette.find('.react-custom-palette-h3').val(),
					h4: $palette.find('.react-custom-palette-h4').val(),
					h5: $palette.find('.react-custom-palette-h5').val(),
					text: $palette.find('.react-custom-palette-text').val(),
					text_alt: $palette.find('.react-custom-palette-text-alt').val(),
					link: $palette.find('.react-custom-palette-link').val(),
					link_hover: $palette.find('.react-custom-palette-link-hover').val(),
					primary_bg: $palette.find('.react-custom-palette-primary-bg').val(),
					primary_bg_gradient: $palette.find('.react-custom-palette-primary-bg-gradient').is(':checked') ? true : false,
					primary_bg_lighter: $palette.find('.react-custom-palette-primary-bg-lighter').val(),
					primary_bg_even_lighter: $palette.find('.react-custom-palette-primary-bg-even-lighter').val(),
					primary_bg_even_darker: $palette.find('.react-custom-palette-primary-bg-even-darker').val(),
					primary_bg_much_darker: $palette.find('.react-custom-palette-primary-bg-much-darker').val(),
					primary_bg_darker: $palette.find('.react-custom-palette-primary-bg-darker').val(),
					primary_fg: $palette.find('.react-custom-palette-primary-fg').val(),
					primary_icon: $palette.find('.react-custom-palette-primary-icon').val(),
					primary_icon_image: $palette.find('.react-custom-palette-primary-icon-image').val(),
					dark_bg: $palette.find('.react-custom-palette-dark-bg').val(),
					dark_bg_gradient: $palette.find('.react-custom-palette-dark-bg-gradient').is(':checked') ? true : false,
					dark_bg_lighter: $palette.find('.react-custom-palette-dark-bg-lighter').val(),
					dark_bg_even_lighter: $palette.find('.react-custom-palette-dark-bg-even-lighter').val(),
					dark_bg_even_darker: $palette.find('.react-custom-palette-dark-bg-even-darker').val(),
					dark_bg_much_darker: $palette.find('.react-custom-palette-dark-bg-much-darker').val(),
					dark_bg_darker: $palette.find('.react-custom-palette-dark-bg-darker').val(),
					dark_fg: $palette.find('.react-custom-palette-dark-fg').val(),
					dark_icon: $palette.find('.react-custom-palette-dark-icon').val(),
					dark_icon_image: $palette.find('.react-custom-palette-dark-icon-image').val(),
					light_bg: $palette.find('.react-custom-palette-light-bg').val(),
					light_bg_gradient: $palette.find('.react-custom-palette-light-bg-gradient').is(':checked') ? true : false,
					light_bg_lighter: $palette.find('.react-custom-palette-light-bg-lighter').val(),
					light_bg_even_lighter: $palette.find('.react-custom-palette-light-bg-even-lighter').val(),
					light_bg_even_darker: $palette.find('.react-custom-palette-light-bg-even-darker').val(),
					light_bg_darker: $palette.find('.react-custom-palette-light-bg-darker').val(),
					light_bg_much_darker: $palette.find('.react-custom-palette-light-bg-much-darker').val(),
					light_fg: $palette.find('.react-custom-palette-light-fg').val(),
					light_fg_even_lighter: $palette.find('.react-custom-palette-light-fg-even-lighter').val(),
					light_fg_even_darker: $palette.find('.react-custom-palette-light-fg-even-lighter').val(),
					light_icon: $palette.find('.react-custom-palette-light-icon').val(),
					light_icon_image: $palette.find('.react-custom-palette-light-icon-image').val()
				});
			});
			reactOptions.options.custom_palettes = palettes;

			var advancedDisableCss = [];
			$('.advanced_disable_css').each(function () {
				var $this = $(this);
				if (!$this.is(':checked')) {
					advancedDisableCss.push($this.val());
				}
			});
			reactOptions.options.advanced_disable_css = advancedDisableCss;

			var advancedDisableJs = [];
			$('.advanced_disable_js').each(function () {
				var $this = $(this);
				if (!$this.is(':checked')) {
					advancedDisableJs.push($this.val());
				}
			});
			reactOptions.options.advanced_disable_js = advancedDisableJs;
		},

		/**
		 * Set up the audio uploaders for the given track
		 *
		 * @param object $track
		 */
		addAudioUploaders: function ($track) {
			$track.find('.react-audio-format').each(function () {
				var $root = $(this),
				$input = $root.find('.react-audio-format-input'),
				$uploadButton = $root.find('.react-upload-audio-format-button');

				reactAdmin.mediaBrowser($uploadButton, {
					mediaOptions: reactAdmin.audioMediaOptions,
					callback: function (selection) {
						try {
							var attachment = selection.first().toJSON(),
								shortUrl = reactAdmin.makeUploadUrlRelative(attachment.url);

							$input.val(shortUrl);
						} catch (ex) {
							reactAdmin.log(selection);
							throw ex;
						}
					}
				});
			});
		},

		/**
		 * Set up the image uploader for the given background group
		 *
		 * @param  {jQuery}  $group  The group wrapper
		 */
		addBackgroundGroupUploader: function ($group) {
			var $uploadButton = $group.find('.react-background-group-upload'),
			$uploadHolder = $group.find('.react-background-group-images');

			reactAdmin.mediaBrowser($uploadButton, {
				mediaOptions: $.extend({}, reactAdmin.imageMediaOptions, { multiple: true }),
				callback: function (selection) {
					try {
						var images = selection.toJSON();
						$.each(images, function (i, image) {
							var background = {
								image: reactAdmin.makeUploadUrlRelative(image.url),
								width: image.width,
								height: image.height,
								orientation: image.height > image.width ? 'portrait' : 'landscape',
								title: '',
								caption: '',
								captionPosition: ''
							};

							var url = image.url, orientation = image.orientation;

							if (typeof image.sizes === 'object' && typeof image.sizes.medium === 'object') {
								url = image.sizes.medium.url;
								orientation = image.sizes.medium.orientation;
							}

							var $img = $('<img/>').addClass('react-' + orientation),
								$div = $(reactAdminL10n.backgroundThumbnailHtml)
										.data('image', background)
										.hide();

							$div.find('.react-uploaded-image-centered').append($img);

							$img.load(function () {
								$img.unbind('load');
								$uploadHolder.append($div);
								$div.fadeIn('slow');
							})
							.attr('src', url);
						});
					} catch (ex) {
						reactAdmin.log(selection);
						throw ex;
					}
				}
			});
		},

		colourPickers: function ($context) {
			$context = $context || $(document);

			var $colorPickers = $('.react-colorpicker', $context);

			// First pass to gather palette colours
			$colorPickers.each(function () {
				var $this = $(this),
					val = $this.val(),
					tiny = tinycolor(val);

				if (val && tiny.isValid()) {
					var tinyStr = tiny.toString();

					if ($.inArray(tinyStr, colourPickerPalette) === -1) {
						colourPickerPalette.push(tinyStr);
					}
				}
			});

			// Returns a lighter or darker shade of the given color
			var getShadeRbgString = function(color, type, value) {
				var tries = 3,
					i = 0,
					shade = tinycolor(color.toString());

				do {
					shade = shade[type](value);

					if ( ! tinycolor.equals(color, shade)) {
						break;
					}

					i++;
				} while (i < tries);

				return shade.toRgbString();
			};

			// Second pass to init pickers
			$colorPickers.each(function () {
				var $this = $(this),
					originalVal = $this.val(),
					originalTiny = tinycolor(originalVal),
					$indicator = $('<div class="react-color-indicator"/>').insertAfter($this),
					hasShades = $this.hasClass('react-shades'),
					updateColor = function (color) {
						if (!color) color = tinycolor($this.val());

						if (color.isValid()) {
							$indicator.css('background-color', color);
						} else {
							$indicator.css('background-color', 'transparent');
						}

						if (hasShades) {
							var $filters = $this.siblings('.react-filter-output').toggleClass("react-hidden", !color.isValid());

							if (color.isValid()) {
									var lighten, darken;

									if ($('#contrast_reverse').is(':checked')) {
										lighten = 'darken';
										darken = 'lighten';
									} else {
										lighten = 'lighten';
										darken = 'darken';
									}

									var lightenVal = $('#contrast_lighter').val(),
										darkenVal = $('#contrast_darker').val();

									lightenVal = $.isNumeric(lightenVal) ? parseInt(lightenVal, 10) : 0;
									darkenVal = $.isNumeric(darkenVal) ? parseInt(darkenVal, 10) : 0;

									var	lightenValOne = lightenVal + 1,
										lightenValFour = lightenVal + 2,
										lightenValThree = lightenVal + 5,
										darkenValFive = darkenVal + 9,
										darkenValSix = darkenVal + 6,
										darkenValTwo = darkenVal + 3,
										darkenValSeven = darkenVal + 1;

									var lighten4 = getShadeRbgString(color, lighten, lightenValOne),
										lighten10 = getShadeRbgString(color, lighten, lightenValThree),
										lighten6 = getShadeRbgString(color, lighten, lightenValFour),
										darken5 = getShadeRbgString(color, darken, darkenValTwo),
										darken18 = getShadeRbgString(color, darken, darkenValFive),
										darken10 = getShadeRbgString(color, darken, darkenValSix),
										darken2 = getShadeRbgString(color, darken, darkenValSeven);


								$filters.find(".lighten").css("background-color", lighten4).find('input').val(lighten4);
								$filters.find(".darken").css("background-color", darken5).find('input').val(darken5);
								$filters.find(".much-lighter").css("background-color", lighten10).find('input').val(lighten10);
								$filters.find(".even-lighter").css("background-color", lighten6).find('input').val(lighten6);
								$filters.find(".even-darker").css("background-color", darken10).find('input').val(darken10);
								$filters.find(".much-darker").css("background-color", darken18).find('input').val(darken18);
								$filters.find(".touch-darker").css("background-color", darken2).find('input').val(darken2);
							} else {
								// Invalid color given... reset the values
								$filters.find(".lighten").css("background-color", "transparent").find('input').val('');
								$filters.find(".darken").css("background-color", "transparent").find('input').val('');
								$filters.find(".much-lighter").css("background-color", "transparent").find('input').val('');
								$filters.find(".even-lighter").css("background-color", "transparent").find('input').val('');
								$filters.find(".even-darker").css("background-color", "transparent").find('input').val('');
								$filters.find(".much-darker").css("background-color", "transparent").find('input').val('');
								$filters.find(".touch-darker").css("background-color", "transparent").find('input').val('');
							}
						}
					},
					updateField = function (color) {
						if (color && color.isValid()) {
							$this.val(color).trigger('changecolor');
						} else {
							$this.val('').trigger('changecolor');
						}
						updateColor(color);
					};

				$indicator.spectrum({
					color: originalTiny.isValid() ? originalTiny : '',
					clickoutFiresChange: true,
					allowEmpty: true,
					showPalette: true,
					showAlpha: true,
					showInput: true,
					preferredFormat: 'rgb',
					palette: colourPickerPalette,
					move: updateField,
					hide: function (color) {
						$('.qtip').hide();
						updateField(color);
					}
				});

				$this.bind('keyup blur', function () {
					$indicator.spectrum('set', $this.val());
					updateColor();
				});
				updateColor();

				if (originalTiny.isValid()) {
					$indicator.css('background-color', originalTiny);
				}
			});
		},

		toggleSwitches: function ($context) {
			$context = $context || $(document);

			$('input.react-toggle, select.react-tritoggle', $context).toggleSwitch({
				onText: reactAdminL10n.on,
				offText: reactAdminL10n.off,
				defaultText: reactAdminL10n._default
			});

			$('input.react-toggle-yn, select.react-tritoggle-yn', $context).toggleSwitch({
				defaultText: reactAdminL10n._default,
				onText: reactAdminL10n.yes,
				offText: reactAdminL10n.no
			});

			$('input.react-toggle-ld, select.react-tritoggle-ld', $context).toggleSwitch({
				defaultText: reactAdminL10n._default,
				onText: reactAdminL10n.light,
				offText: reactAdminL10n.dark
			});

			$('input.react-toggle-ed, select.react-tritoggle-ed', $context).toggleSwitch({
				defaultText: reactAdminL10n._default,
				onText: reactAdminL10n.enabled,
				offText: reactAdminL10n.disabled
			});
		},

		/**
		 * Updates any custom palette selection dropdowns when custom palettes are changed
		 */
		updateCustomPaletteDependents: function () {
			var ids = [],
				palettes = [new Option(reactAdminL10n.none, '')],
				$tmpSelect = $('<select>');

			$('#react-custom-palettes > div').each(function () {
				var $palette = $(this);
				palettes.push(new Option($palette.find('.react-custom-palette-name').val(), $palette.data('id')));
				ids.push('' + $palette.data('id')); // We need this to be a string for the inArray check below
			});

			// We need to temporarily store the options so they can be cloned in each select below
			$tmpSelect.html(palettes);

			$('.react-custom-palette-selector').each(function () {
				var $this = $(this),
					val = $this.val();

				$this.html($tmpSelect.html());

				if ($.inArray(val, ids) === -1) {
					$this.val('');
				} else {
					$this.val(val);
				}
			});
		},

		/**
		 * Updates any background image group dropdowns when their names are changed
		 */
		updateBackgroundGroupSelects: function () {
			var $tmpSelect = $('<select>'),
				groups = [new Option(reactAdminL10n.noBackground, '')],
				groupHTML = '',
				values = [];

			$('.react-background-group').each(function () {
				var $group = $(this),
					id = $group.data('id'),
					name = $group.find('.react-background-group-name-input').val();

				groups.push(new Option(name, id));
				values.push('' + id); // We need this to be a string for the inArray check below
			});

			// We need to temporarily store the options so they can be cloned in each select below
			$tmpSelect.html(groups);
			groupHTML = $tmpSelect.html();

			$('.react-background-group-select').each(function () {
				var $this = $(this),
					val = $this.val();

				$this.html(groupHTML);

				if ($.inArray(val, values) === -1) {
					$this.val('');
				} else {
					$this.val(val);
				}
			});
		}
	}; // End ThemeCatcher object

	// Convert the form to a serialized object
	$.fn.serializeObject = function() {
		var o = {};
		var a = this.serializeArray();
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
	};
})(jQuery, window);
