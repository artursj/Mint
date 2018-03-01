/*
 * ThemeCatcher Portfolio Metabox JavaScript
 *
 * Copyright www.themecatcher.net
 * All rights reserved.
 */
;(function ($) {
	"use strict";

	$(document).ready(function () {
		// Cache root for live events
		var $doc = $(document),
			fieldWrap = '.tcap-meta-box-field-outer',
			innerFieldWrap = '.tcap-meta-multi-outer';

		$('#_tcp_type').change(function () {
			switch ($(this).val()) {
				default:
				case 'image':
					$('#_tcp_video, #_tcp_link, #_tcp_link_target, #_tcp_video_embed').closest(fieldWrap).hide();
					$('#_tcp_image_uploaded, #_tcp_title, #_tcp_caption_position, #_tcp_caption').closest(fieldWrap).show();
					break;
				case 'video':
					$('#_tcp_image_uploaded, #_tcp_link, #_tcp_link_target, #_tcp_title, #_tcp_caption_position, #_tcp_caption, #_tcp_video_embed').closest(fieldWrap).hide();
					$('#_tcp_video').closest(fieldWrap).show();
					break;
				case 'video_embed':
					$('#_tcp_image_uploaded, #_tcp_link, #_tcp_link_target, #_tcp_title, #_tcp_caption_position, #_tcp_caption, #_tcp_video').closest(fieldWrap).hide();
					$('#_tcp_video_embed').closest(fieldWrap).show();
					break;
				case 'post':
				case 'plain':
					$('#_tcp_video, #_tcp_link, #_tcp_link_target, #_tcp_image_uploaded, #_tcp_title, #_tcp_caption_position, #_tcp_caption, #_tcp_video_embed').closest(fieldWrap).hide();
					break;
				case 'link':
					$('#_tcp_image_uploaded, #_tcp_video, #_tcp_title, #_tcp_caption_position, #_tcp_caption, #_tcp_video_embed').closest(fieldWrap).hide();
					$('#_tcp_link, #_tcp_link_target').closest(fieldWrap).show();
					break;
			}
		}).change();

		// Video embedded data check
		$('#_tcp_video_embed').bind('blur', function () {
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
								$('#_tcp_video_embed_width').val(response[0].width);
								$('#_tcp_video_embed_height').val(response[0].height);
							}
						});
					}
				} else if (youtubeMatch) {
					videoId = RegExp.$1;
					if (videoId) {
						$.ajax({
							url: tcapL10n.ajaxUrl,
							data: {
								action: 'tcp_get_youtube_video_dimensions',
								id: videoId
							},
							dataType: 'json'
						})
						.done(function (response) {
							response = tcap.sanitizeResponse(response);

							if (response.type === 'success') {
								$('#_tcp_video_embed_width').val(response.width);
								$('#_tcp_video_embed_height').val(response.height);
							}
						});
					}
				}
			} else {
				$('#_tcp_video_embed_width').val('');
				$('#_tcp_video_embed_height').val('');
			}
		});

		// Portfolio lightbox image uploader
		var $imageUploadButton = $('#_tcp_image_upload_button');
		if ($imageUploadButton.length) {
			var refreshUpload = function () {
				var $image = $('#_tcp_image_uploaded .tcap-uploaded-image'),
					url = $image.data('url');

				if (typeof url !== 'string' || !url.length) {
					url = '';
				}

				$('#_tcp_image').val(url);
			};

			tcap.mediaBrowser($imageUploadButton, {
				mediaOptions: tcap.imageMediaOptions,
				callback: function (selection) {
					try {
						var image = selection.first().toJSON(),
							shortUrl = tcap.makeUploadUrlRelative(image.url),
							$img = $('<img/>'),
							$div = $(tcapL10n.uploadThumbnailHtml)
									.hide()
									.prepend($img)
									.data('url', shortUrl);

						var url = image.url;

						if (typeof image.sizes === 'object' && typeof image.sizes.medium === 'object') {
							url = image.sizes.medium.url;
						}

						$img.load(function () {
							$('#_tcp_image_uploaded').html($div);
							$img.unbind('load');
							$div.fadeIn('slow');
							refreshUpload();
						})
						.attr('src', url);
					} catch (ex) {
						tcap.log(selection);
						throw ex;
					}
				}
			});

			$doc.on('click', '#_tcp_image_uploaded .tcap-delete-uploaded-image', function () {
				$('.qtip').hide();
				$(this).closest('.tcap-uploaded-image').remove();
				refreshUpload();
			});
		}

		tcap.tooltips();

	}); // End document.ready()
})(jQuery);
