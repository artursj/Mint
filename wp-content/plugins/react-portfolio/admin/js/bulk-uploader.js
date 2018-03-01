/*
 * ThemeCatcher Portfolio Bulk Uploader JavaScript
 *
 * Copyright www.themecatcher.net
 * All rights reserved.
 */
jQuery(document).ready(function ($) {
	var $uploadButton = $('.tcap-pbu-upload-button'),
		$saveButtonWrap = $('#tcap-pbu-buttons-wrap');

	$('#tcap-pbu-upload').css({
		width: $uploadButton.outerWidth(true),
		height: $uploadButton.outerHeight(true)
	});

	var $items = $('#tcap-pbu-items'),
		itemCount = 0,
		$status = $('#tcap-pbu-status');

	$('#tcap-pbu-upload').fileupload({
		url: tcapL10n.ajaxUrl,
		dataType: 'json',
		formData: function () {
			return [
				{ name: 'action', value: 'tcp_portfolio_bulk_upload_ajax' },
				{ name: '_ajax_nonce', value: tcapL10n.bulkUploadNonce },
				{ name: 'post_status', value: $status.val() || 'publish' }
			];
		},
		add: function (e, data) {
			data.context = $('<div class="tcap-progress"><div class="tcap-progress-bar"><span>' + data.files[0].name + '</span></div></div>').appendTo($items);
			data.process().done(function () {
				data.submit();
			});
		},
		progress: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			data.context.find('.tcap-progress-bar').css('width', progress + '%');
		},
		done: function (e, data) {
			itemCount++;
			var file = data._response.result.data;
			var $item = $(tcapL10n.bulkUploadItemHtml).data({ post_id: file.post_id, attach_id: file.attach_id, delete_nonce: file.delete_nonce });

			$item.find('.tcap-pbu-item-thumb').append('<img src="' + file.thumbnail[0] + '" alt="">');
			$item.find('.tcap-pbu-item-title input').attr('name', 'posts[' + file.post_id + '][title]').val(file.post_title);
			$item.find('.tcap-pbu-item-content textarea').attr('name', 'posts[' + file.post_id + '][content]');
			$item.find('.tcap-pbu-item-cat input').attr('name', 'posts[' + file.post_id + '][cats]');
			$item.find('.tcap-pbu-item-tag input').attr('name', 'posts[' + file.post_id + '][tags]');

			data.context.replaceWith($item);
			$saveButtonWrap.show();
		}
	});

	$items.on('click', '.tcap-pbu-item-delete', function () {
		if (!confirm(tcapL10n.confirmDeleteBulkItem)) {
			return;
		}

		var $item = $(this).closest('.tcap-pbu-item'),
			onDeleteError = function (message) {
				alert('An error occurred deleting the portfolio item:\n\n' + message);
			};

		$.ajax({
			url: tcapL10n.ajaxUrl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'tcp_portfolio_bulk_delete_ajax',
				post_id: $item.data('post_id'),
				attach_id: $item.data('attach_id'),
				_ajax_nonce: $item.data('delete_nonce')
			}
		})
		.done(function (response) {
			response = tcap.sanitizeResponse(response);

			if (response.type === 'success') {
				$item.remove();

				if ($items.children().length === 0) {
					$saveButtonWrap.hide();
				}
			} else {
				onDeleteError(response.message);
			}
		})
		.fail(function () {
			onDeleteError('Ajax error');
		});
	});

	$('#tcap-pbu-clear').click(function () {
		$items.empty();
		$saveButtonWrap.hide();
	});

	var $messageWrap = $('#tcap-pbu-message-wrap'),
		$message = $('#tcap-pbu-message'),
		messageTimeoutId,
		onSaveError = function (message) {
			alert('An error occurred saving the portfolio items:\n\n' + message);
		};

	$('#tcap-pbu-save').click(function () {
		$.ajax({
			url: tcapL10n.ajaxUrl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'tcp_portfolio_bulk_save_ajax',
				posts: JSON.stringify(tcap.serializeObject($('#tcap-pbu-form'))),
				_ajax_nonce: tcapL10n.bulkSaveNonce
			}
		})
		.done(function (response) {
			response = tcap.sanitizeResponse(response);

			if (response.type === 'success') {
				clearTimeout(messageTimeoutId);

				$message.text(response.message);
				$messageWrap.show();

				messageTimeoutId = setTimeout(function () {
					$messageWrap.hide();
				}, 3000);
			} else {
				onSaveError(response.message);
			}
		})
		.fail(function () {
			onSaveError('Ajax error');
		});
	});

	tcap.tooltips();
});
