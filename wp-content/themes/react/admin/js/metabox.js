/*
 * ThemeCatcher Metabox JavaScript
 *
 * Copyright www.themecatcher.net
 * All rights reserved.
 */
;(function ($) {
	"use strict";

	$(document).ready(function () {
		// Cache root for live events
		var $doc = $(document),
			fieldWrap = '.react-meta-box-field-outer',
			innerFieldWrap = '.react-meta-multi-outer';

		// Layout selector
		$('.react-layout-selector').each(function () {
			var $select = $(this),
			$options = $select.find('option'),
			activeClass = 'react-select-active',
			$wrap = $('<div class="react-layout-selector react-selector"/>');

			$options.each(function () {
				var $this = $(this),
					$layout = $('<div class="react-layout-option react-tooltip"/>').appendTo($wrap).click(function () {
						$wrap.find(' > div').removeClass(activeClass);
						$layout.addClass(activeClass);
						$select.val($this.val());
					})
					.append('<img src="' + reactAdminL10n.themeAdminUrl + '/images/select-layout-' + ($this.val() || 'default') + '.png" alt="" />');

				var $tooltip = $('<span class="react-tooltip-text">').html($this.html());
				$layout.append($tooltip);

				if ($this.is(':selected')) {
					$layout.addClass(activeClass);
				}
			});

			$select.hide().after($wrap);
		});

		// Texture/detail selectors (admin.js)
		reactAdmin.textureSelectors();

		// Accordion (admin.js)
		reactAdmin.accordion();

		// Range sliders (admin.js)
		reactAdmin.rangeSliders();

		// Background position (admin.js)
		reactAdmin.backgroundPositionSelectors();

		// Background repeat (admin.js)
		reactAdmin.backgroundRepeatSelectors();

		// Background video data check
		$('#_react_background_video').bind('blur', function () {
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
								$('#_react_background_video_width').val(response[0].width);
								$('#_react_background_video_height').val(response[0].height);
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
								$('#_react_background_video_width').val(response.width);
								$('#_react_background_video_height').val(response.height);
							}
						});
					}
				}
			} else {
				$('#_react_background_video_width').val('');
				$('#_react_background_video_height').val('');
			}
		});

		// Video embedded data check
		$('#_react_video_embed').bind('blur', function () {
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
								$('#_react_video_embed_width').val(response[0].width);
								$('#_react_video_embed_height').val(response[0].height);
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
								$('#_react_video_embed_width').val(response.width);
								$('#_react_video_embed_height').val(response.height);
							}
						});
					}
				}
			} else {
				$('#_react_video_embed_width').val('');
				$('#_react_video_embed_height').val('');
			}
		});

		// Intro/background custom image upload
		$.each(['intro', 'body', 'background'], function (i, key) {
			$.each(['', '_retina'], function (j, retina) {
				reactAdmin.mediaBrowser($('#' + key + '_image' + retina + '_browse'), {
					mediaOptions: reactAdmin.imageMediaOptions,
					callback: function (selection) {
						try {
							var image = selection.first().toJSON();
							var shortUrl = reactAdmin.makeUploadUrlRelative(image.url);

							$('#_react_' + key + '_image' + retina).val(shortUrl).blur();
							$('#_react_' + key + '_image' + retina + '_width').val(image.width);
							$('#_react_' + key + '_image' + retina + '_height').val(image.height);
						} catch (ex) {
							reactAdmin.log(selection);
							throw ex;
						}
					}
				});

				$('#_react_' + key + '_image' + retina).blur(function () {
					reactAdmin.handleImageUploadSourceChange(
						$('#_react_' + key + '_image' + retina),
						$('#react-' + key + '_image' + retina + '-holder'),
						$('#_react_' + key + '_image' + retina + '_width'),
						$('#_react_' + key + '_image' + retina + '_height')
					);
				})
				.data('url', $('#_react_' + key + '_image' + retina).val());

				$doc.on('click', '#react-' + key + '_image' + retina + '-holder .react-delete-uploaded-image', function () {
					$('.qtip').hide();
					$('#_react_' + key + '_image' + retina + ', #_react_' + key + '_image' + retina + '_width, #_react_' + key + '_image' + retina + '_height').val('');
					$('#_react_' + key + '_image' + retina).blur();
				});
			});

			$('#_react_' + key + '_image_retina_use_main_img').change(function () {
				var $this = $(this),
					val = $this.val();

				if (val == 'use-new-img') {
					$this.closest(fieldWrap).find('.image_retina_use_main_img_is_yes').slideDown();
				} else {
					$this.closest(fieldWrap).find('.image_retina_use_main_img_is_yes').slideUp();
				}

				if (val != 'never') {
					$this.closest(fieldWrap).find('.image_retina_use_main_img_is_yes_or').slideDown();
					$this.closest(fieldWrap).find('.react-background-image-retina-settings').slideDown();
				} else {
					$this.closest(fieldWrap).find('.image_retina_use_main_img_is_yes_or').slideUp();
					$this.closest(fieldWrap).find('.react-background-image-retina-settings').slideUp();
				}
			}).change();

			$('#_react_' + key + '_image_convert').change(function () {
				if ($(this).val() == 'custom') {
					$('#_react_' + key + '_image_convert_custom').closest(innerFieldWrap).fadeIn();
				} else {
					$('#_react_' + key + '_image_convert_custom').closest(innerFieldWrap).fadeOut();
				}
			}).change();

			$('#react-toggle-meta-textures-' + key).click(function () {
				var $this = $(this);

				if (!$this.hasClass('active')) {
					$('.react-meta-texture-wrap-' + key + ', .react-meta-detail-wrap-' + key + ', .react-meta-image-wrap-' + key).slideDown();
					$this.addClass('active');
				} else {
					$('.react-meta-texture-wrap-' + key + ', .react-meta-detail-wrap-' + key + ', .react-meta-image-wrap-' + key).slideUp();
					$this.removeClass('active');
				}
			});

			$('#_react_' + key + '_image_parallax').bind('keyup blur', function () {
				if ($(this).val() != '1') {
					$('#_react_' + key + '_image_parallax_offset').closest(innerFieldWrap).fadeIn();
				} else {
					$('#_react_' + key + '_image_parallax_offset').closest(innerFieldWrap).fadeOut();
				}
			}).blur();
		}); // End .each intro, body, background

		var $pfInfoWrap = $('.react-information-wrap'),
			$pfInfoAdd = $pfInfoWrap.find('.react-add'),
			$pfInfoHolder = $pfInfoWrap.find('.react-information-holder'),
			$pfInfoValue = $('#_react_information'),
			updatePfInfo = function () {
				var info = [];

				$pfInfoHolder.find('.react-information').each(function () {
					var $this = $(this);
					info.push({
						title: $this.find('.react-information-title').val(),
						value: $this.find('.react-information-value').val()
					});
				});

				$pfInfoValue.val(JSON.stringify(info));
			};

		$pfInfoAdd.click(function () {
			var $info = $(reactAdminL10n.informationHtml);
			$pfInfoHolder.append($info);
			updatePfInfo();
		});

		$pfInfoHolder.on('click', '.react-information-remove', function () {
			$(this).closest('.react-information').remove();
			updatePfInfo();
		});

		$pfInfoHolder.on('keyup blur', '.react-information-title, .react-information-value', function () {
			updatePfInfo();
		});

		$('#_react_type').change(function () {
			switch ($(this).val()) {
				default:
				case 'image':
					$('#_react_video_embed').closest(fieldWrap).hide();
					break;
				case 'video_embed':
					$('#_react_video_embed').closest(fieldWrap).show();
					break;
			}
		}).change();

		$('#_react_page_layout_top_margin_choose').change(function () {
			if ($(this).val() === 'custom') {
				$('#_react_page_layout_top_margin').closest(innerFieldWrap).slideDown();
			} else {
				$('#_react_page_layout_top_margin').closest(innerFieldWrap).slideUp();
			}
		}).change();

		$('#_react_page_layout_top_margin_phones_choose').change(function () {
			if ($(this).val() === 'custom') {
				$('#_react_page_layout_top_margin_phones').closest(innerFieldWrap).slideDown();
			} else {
				$('#_react_page_layout_top_margin_phones').closest(innerFieldWrap).slideUp();
			}
		}).change();

		$('#_react_page_layout_top_margin_tablets_choose').change(function () {
			if ($(this).val() === 'custom') {
				$('#_react_page_layout_top_margin_tablets').closest(innerFieldWrap).slideDown();
			} else {
				$('#_react_page_layout_top_margin_tablets').closest(innerFieldWrap).slideUp();
			}
		}).change();

		$('#_react_page_layout_top_margin_tv_choose').change(function () {
			if ($(this).val() === 'custom') {
				$('#_react_page_layout_top_margin_tv').closest(innerFieldWrap).slideDown();
			} else {
				$('#_react_page_layout_top_margin_tv').closest(innerFieldWrap).slideUp();
			}
		}).change();

		$('#_react_page_layout_bottom_margin_choose').change(function () {
			if ($(this).val() === 'custom') {
				$('#_react_page_layout_bottom_margin').closest(innerFieldWrap).slideDown();
			} else {
				$('#_react_page_layout_bottom_margin').closest(innerFieldWrap).slideUp();
			}
		}).change();

		$('#_react_page_layout_bottom_margin_phones_choose').change(function () {
			if ($(this).val() === 'custom') {
				$('#_react_page_layout_bottom_margin_phones').closest(innerFieldWrap).slideDown();
			} else {
				$('#_react_page_layout_bottom_margin_phones').closest(innerFieldWrap).slideUp();
			}
		}).change();

		$('#_react_page_layout_bottom_margin_tablets_choose').change(function () {
			if ($(this).val() === 'custom') {
				$('#_react_page_layout_bottom_margin_tablets').closest(innerFieldWrap).slideDown();
			} else {
				$('#_react_page_layout_bottom_margin_tablets').closest(innerFieldWrap).slideUp();
			}
		}).change();

		$('#_react_page_layout_bottom_margin_tv_choose').change(function () {
			if ($(this).val() === 'custom') {
				$('#_react_page_layout_bottom_margin_tv').closest(innerFieldWrap).slideDown();
			} else {
				$('#_react_page_layout_bottom_margin_tv').closest(innerFieldWrap).slideUp();
			}
		}).change();

		$('#_react_slider').change(function () {
			if ($(this).val() !== '' && $(this).val() !== 'home') {
				$('#_react_slider_id').closest(fieldWrap).slideDown();
				$('#_react_slider_convert_id').closest(fieldWrap).slideDown();
			} else {
				$('#_react_slider_id').closest(fieldWrap).slideUp();
				$('#_react_slider_convert_id').closest(fieldWrap).slideUp();
			}
		}).change();

		$('#_react_background_video_complete').change(function () {
			if ($(this).val() == 'redirect') {
				$('#_react_background_video_redirect').closest(fieldWrap).slideDown();
			} else {
				$('#_react_background_video_redirect').closest(fieldWrap).slideUp();
			}
		}).change();

		$('#_react_show_skip').change(function () {
			if ($(this).is(':checked')) {
				$('#_react_skip_url, #_react_skip_text').closest(fieldWrap).slideDown();
			} else {
				$('#_react_skip_url, #_react_skip_text').closest(fieldWrap).slideUp();
			}
		}).change();

		if (typeof $.fn.toggleSwitch === 'function') {
			$('input.react-option-toggle, select.react-option-tritoggle').toggleSwitch({
				onText: reactAdminL10n.on,
				offText: reactAdminL10n.off,
				defaultText: reactAdminL10n._default
			});

			$('input.react-option-toggle-yn, select.react-option-tritoggle-yn').toggleSwitch({
				defaultText: reactAdminL10n._default,
				onText: reactAdminL10n.yes,
				offText: reactAdminL10n.no
			});
		}

		$('#_react_footer_convert').change(function () {
			$('#_react_footer_convert_custom').closest('.react-meta-multi-outer')[$(this).val() == 'custom' ? 'slideDown' : 'slideUp']();
		}).change();

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
			.end().find('.react-audio-format-m4a').focus();

			addAudioUploaders($track);

			updateAudioTracks();

			return false;
		});

		// Make the tracks sortable
		$audioTracks.sortable({
			handle: '.react-drag-audio-track',
			stop: updateAudioTracks
		});

		// Edit audio track
		$audioTracks.on('click', '.react-edit-audio-track', function () {
			var $editButton = $(this),
			$root = $editButton.closest('.react-audio-track'),
			$settings = $root.find('.react-audio-track-settings'),
			$nameLabel = $root.find('.react-audio-track-name-inner'),
			$nameInput = $root.find('.react-audio-track-name-input');

			if ($editButton.hasClass('react-open')) {
				$settings.add($nameInput).hide();
				$nameLabel.show();
				$editButton.removeClass('react-open');
			} else {
				$nameLabel.hide();
				$settings.add($nameInput).show();
				$editButton.addClass('react-open');
			}
		});

		// Change track name when typed
		$audioTracks.on('keyup blur', '.react-audio-track-name-input', function () {
			var $this = $(this);
			$this.siblings('.react-audio-track-name-inner').text($this.val());
			updateAudioTracks();
		});

		// Delete audio track
		$audioTracks.on('click', '.react-delete-audio-track', function () {
			if (confirm(reactAdminL10n.confirmDeleteAudioTrack)) {
				$('.qtip').hide();
				$(this).closest('.react-audio-track').remove();
				updateAudioTracks();
			}
		});

		// Set up audio uploaders
		$('.react-audio-track').each(function () {
			addAudioUploaders($(this));
		});

		/**
		 * Set up the audio uploaders for the given track
		 *
		 * @param object $track
		 */
		function addAudioUploaders($track) {
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
							updateAudioTracks();
						} catch (ex) {
							reactAdmin.log(selection);
							throw ex;
						}
					}
				});
			});
		}

		function updateAudioTracks()
		{
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
			$('#_react_audio').val(JSON.stringify(tracks));
		}

		// Handle manual typing of track URLs
		$audioTracks.on('blur', '.react-audio-format-input', updateAudioTracks);

		$('#page_template').change(function () {
			var template = $(this).val(),
				$subtitle = $('.react-page-template-settings').hide(),
				$showSkip = $('#_react_show_skip').closest(fieldWrap),
				$skipUrl = $('#_react_skip_url').closest(fieldWrap),
				$skipText = $('#_react_skip_text').closest(fieldWrap),
				$layout = $('#_react_layout').closest(fieldWrap),
				$contentStyle = $('#_react_content_style').closest(fieldWrap),
				$introHeading = $('.react-intro-settings'),
				$introStyle = $('#_react_intro_style').closest(fieldWrap),
				$introTitle = $('#_react_intro_title').closest(fieldWrap),
				$introSubtitle = $('#_react_intro_subtitle').closest(fieldWrap),
				$quformFormId = $('#_react_quform_id').closest(fieldWrap),
				$noteBlockAlign = $('#_react_note_block_align').closest(fieldWrap),
				$noteBlockHeader = $('#_react_note_block_header').closest(fieldWrap),
				$noteBlockPalette = $('#_react_note_block_palette').closest(fieldWrap),
				$showFooter = $('#_react_show_footer').closest(fieldWrap);

			if (template == 'template-fullscreen-media.php' || template == 'template-note-block.php') {
				$showSkip.add($subtitle).add($showFooter).show();

				if ($('#_react_show_skip').is(':checked')) {
					$skipUrl.add($skipText).show();
				} else {
					$skipUrl.add($skipText).hide();
				}
			} else {
				$showSkip.add($skipUrl).add($skipText).add($showFooter).hide();
			}

			if (template == 'template-note-block.php') {
				$noteBlockAlign.add($noteBlockHeader).add($noteBlockPalette).show();
			} else {
				$noteBlockAlign.add($noteBlockHeader).add($noteBlockPalette).hide();
			}

			if (template == 'template-fullscreen-media.php' || template == 'template-note-block.php' || template == 'template-no-content-style.php') {
				$layout.add($contentStyle).add($introHeading).add($introStyle).add($introTitle).add($introSubtitle).hide();
			} else {
				$layout.add($contentStyle).add($introHeading).add($introStyle).add($introTitle).add($introSubtitle).show();
			}

			if (template == 'template-contact.php') {
				$quformFormId.add($subtitle).show();
			} else {
				$quformFormId.hide();
			}
		}).change();
	}); // End document.ready()
})(jQuery);
