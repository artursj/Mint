<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Plugin activation function
 *
 * Register the custom post type and flush the rewrite rules so that portfolio permalinks
 * work immediately after activation
 */
function tcp_plugin_activation()
{
	tcp_register_custom_post_types();
	flush_rewrite_rules();
}
register_activation_hook(TCP_PLUGIN_FILE, 'tcp_plugin_activation');

/**
 * Enqueue the admin CSS stylesheet
 *
 * @param string $hook The current page
 */
function tcp_admin_enqueue_styles($hook)
{
	if (in_array($hook, array('post.php', 'post-new.php', 'widgets.php', 'portfolio_page_tcp_bulk_upload', 'portfolio_page_tcp_settings'))) {
		wp_enqueue_style('qtip2', tcp_url('admin/js/qtip2/jquery.qtip.min.css'), array(), '2.2.1');

		if (in_array($hook, array('post.php', 'post-new.php', 'widgets.php'))) {
			wp_enqueue_style('chosen', tcp_url('admin/js/chosen/chosen.min.css'), array(), '1.4.2');
			wp_enqueue_style('jslider', tcp_url('admin/js/jslider/css/jquery.slider.css'), array(), '1.2.0');
		} elseif ($hook == 'portfolio_page_tcp_settings') {
			wp_enqueue_style('chosen', tcp_url('admin/js/chosen/chosen.min.css'), array(), '1.4.2');
		}

		wp_enqueue_style('tcap-styles', tcp_url('admin/css/styles.css'), array(), TCP_PLUGIN_VERSION);

		if (is_rtl()) {
			wp_enqueue_style('tcap-rtl', tcp_url('admin/css/rtl.css'), array(), TCP_PLUGIN_VERSION);
		}
	}
}
add_action('admin_enqueue_scripts', 'tcp_admin_enqueue_styles');

/**
 * Enqueue the admin JavaScript
 *
 * @param string $hook The current page
 */
function tcp_admin_enqueue_scripts($hook)
{
	if (in_array($hook, array('post.php', 'post-new.php', 'widgets.php', 'portfolio_page_tcp_bulk_upload', 'portfolio_page_tcp_settings'))) {
		wp_enqueue_script('qtip2', tcp_url('admin/js/qtip2/jquery.qtip.min.js'), array('jquery'), '2.2.1', true);
		wp_enqueue_script('jquery-toggleswitch', tcp_url('admin/js/jquery.toggleswitch.js'), array('jquery'), '1.2.1', true);

		if (in_array($hook, array('post.php', 'post-new.php', 'widgets.php'))) {
			wp_enqueue_script('chosen', tcp_url('admin/js/chosen/jquery.chosen.min.js'), array('jquery'), '1.4.2', true);
			wp_enqueue_script('jslider', tcp_url('admin/js/jslider/jquery.slider.min.js'), array('jquery'), '1.2.0', true);

			if (in_array($hook, array('post.php', 'post-new.php'))) {
				wp_enqueue_script('tcap-metabox', tcp_url('admin/js/metabox.js'), array('jquery'), TCP_PLUGIN_VERSION, true);
			}

			wp_enqueue_script('tcap-shortcode', tcp_url('admin/js/shortcode.js'), array('jquery', 'shortcode'), TCP_PLUGIN_VERSION, true);
		} elseif ($hook == 'portfolio_page_tcp_bulk_upload') {
			wp_enqueue_script('jquery-fileupload', tcp_url('admin/js/jquery.fileupload.js'), array('jquery', 'jquery-ui-widget'), '9.12.3', true);
			wp_enqueue_script('jquery-iframe-transport', tcp_url('admin/js/jquery.iframe-transport.js'), array('jquery'), '9.12.3', true);
			wp_enqueue_script('tcap-portfolio-bluk-uploader', tcp_url('admin/js/bulk-uploader.js'), array('jquery', 'jquery-ui-widget'), TCP_PLUGIN_VERSION, true);
		} elseif ($hook == 'portfolio_page_tcp_settings') {
			wp_enqueue_script('chosen', tcp_url('admin/js/chosen/jquery.chosen.min.js'), array('jquery'), '1.4.2', true);
			wp_enqueue_script('tcap-settings', tcp_url('admin/js/settings.js'), array('jquery'), TCP_PLUGIN_VERSION, true);
		}

		wp_enqueue_script('tcap-scripts', tcp_url('admin/js/admin.js'), array('jquery'), TCP_PLUGIN_VERSION, true);

		wp_localize_script('tcap-scripts', 'tcapL10n', tcp_admin_l10n());
	}
}
add_action('admin_enqueue_scripts', 'tcp_admin_enqueue_scripts');

/**
 * Admin script localization
 *
 * @return array
 */
function tcp_admin_l10n()
{
	$data = array(
		'siteUrl' => site_url(),
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'uploadsUrl' => tcp_uploads_url(),
		'close' => esc_html__('Close', 'react-portfolio'),
		'insert' => esc_html__('Insert', 'react-portfolio'),
		'insertClose' => esc_html__('Insert & Close', 'react-portfolio'),
		'shortcodeGeneratorUrl' => admin_url('admin-ajax.php?action=tcp_insert_shortcode'),
		'on' => esc_html__('On', 'react-portfolio'),
		'off' => esc_html__('Off', 'react-portfolio'),
		'_default' => esc_html__('Default', 'react-portfolio'),
		'yes' => esc_html__('Yes', 'react-portfolio'),
		'no' => esc_html__('No', 'react-portfolio'),
		'select' => esc_html__('Select', 'react-portfolio'),
		'selectImage' => esc_html__('Select Image', 'react-portfolio'),
		'bulkUploadNonce' => wp_create_nonce('portfolio_bulk_upload'),
		'bulkSaveNonce' => wp_create_nonce('portfolio_bulk_save'),
		'bulkUploadItemHtml' => tcp_portfolio_bulk_upload_item_html(),
		'confirmDeleteBulkItem' => esc_html__('Are you sure you want to delete the created portfolio item?', 'react-portfolio'),
		'saveSettingsNonce' => wp_create_nonce('tcp_save_settings'),
		'resetSettingsNonce' => wp_create_nonce('tcp_reset_settings'),
		'confirmResetSettings' => esc_html__('Are you sure you want to reset the settings?', 'react-portfolio') . "\n\n" . esc_html__('The page will reload and the current settings will be replaced with the defaults.', 'react-portfolio'),
		'postPosts' => tcp_get_all_post_options('post'),
		'postCategories' => tcp_get_all_category_options('category'),
		'postAuthors' => tcp_get_all_author_options('post'),
		'portfolioPosts' => tcp_get_all_post_options('portfolio'),
		'portfolioCategories' => tcp_get_all_category_options('portfolio_category'),
		'portfolioAuthors' => tcp_get_all_author_options('portfolio'),
		'selectPosts' => esc_html__('Select posts', 'react-portfolio'),
		'selectCategories' => esc_html__('Select categories', 'react-portfolio'),
		'selectAuthors' => esc_html__('Select authors', 'react-portfolio'),
		'uploadThumbnailHtml' => tcp_get_upload_thumbnail_html()
	);

	return array(
		'l10n_print_after' => 'tcapL10n = ' . wp_json_encode($data) . ';'
	);
}

/**
 * Add the "Insert shortcode" button to the end of the media buttons above a post/page
 *
 * @param  string  $widgetId  The ID of the text widget textarea
 */
function tcp_insert_shortcode_button($widgetId = '')
{
	printf('<button type="button" class="button tcap-insert-trigger" data-widget="%s"><span></span>%s</button>',
		esc_attr($widgetId),
		esc_attr__('Add / Edit Portfolio', 'react-portfolio')
	);
}
add_action('media_buttons', 'tcp_insert_shortcode_button', 20, 0);

/**
 * The "Insert shortcode" dialog
 */
function tcp_insert_shortcode()
{
	require_once TCP_ADMIN_INCLUDES_DIR . '/OptionsGenerator.php';
	require_once TCP_ADMIN_INCLUDES_DIR . '/ShortcodeOptionsGenerator.php';
	require_once TCP_ADMIN_INCLUDES_DIR . '/shortcode.php';
	wp_die();
}
add_action('wp_ajax_tcp_insert_shortcode', 'tcp_insert_shortcode');

function tcp_insert_shortcode_nopriv()
{
	wp_die(esc_html__('You do not have permission to perform this action. Are you logged in?', 'react-portfolio'));
}
add_action('wp_ajax_nopriv_tcp_insert_shortcode', 'tcp_insert_shortcode_nopriv');

/**
 * Returns an array of all posts in the format:
 *
 * id => title
 *
 * @param   string  $postType
 * @return  array
 */
function tcp_get_all_post_options($postType = 'post')
{
	$posts = get_posts(array('post_type' => $postType, 'numberposts' => -1));
	$options = array();

	foreach($posts as $post) {
		$options[$post->ID] = $post->post_title;
	}

	return $options;
}

/**
 * Returns an array of all categories in the format:
 *
 * id => name
 *
 * @param   string  $taxonomy
 * @return  array
 */
function tcp_get_all_category_options($taxonomy = 'category')
{
	$categories = get_terms($taxonomy, array('hide_empty' => false));
	$options = array();

	foreach($categories as $category) {
		$options[$category->term_id] = $category->name;
	}

	return $options;
}

/**
 * Returns an array of all authors in the format:
 *
 * id => display_name
 *
 * @param   string  $postType
 * @return  array
 */
function tcp_get_all_author_options($postType = 'post')
{
	global $wpdb;
	$options = array();
	$authors = $wpdb->get_results($wpdb->prepare("SELECT ID, display_name FROM $wpdb->users WHERE ID IN (SELECT post_author FROM $wpdb->posts WHERE post_type = %s) ORDER BY display_name", $postType));

	foreach ($authors as $author) {
		$options[$author->ID] = $author->display_name;
	}

	return $options;
}

/**
 * Get the HTML tag options for the portfolio title
 *
 * @return  array
 */
function tcp_get_header_tag_options()
{
	return array(
		'h1' => 'h1',
		'h2' => 'h2',
		'h3' => 'h3',
		'h4' => 'h4',
		'h5' => 'h5',
		'div' => 'div',
		'span' => 'span'
	);
}

/**
 * Set up the meta boxes
 */
function tcp_add_meta_boxes()
{
	require_once TCP_ADMIN_INCLUDES_DIR . '/OptionsGenerator.php';
	require_once TCP_ADMIN_INCLUDES_DIR . '/MetaboxGenerator.php';
	require_once TCP_ADMIN_INCLUDES_DIR . '/metabox.php';
}
add_action('admin_init', 'tcp_add_meta_boxes');

/**
 * Get the HTML for an uploaded image thumbnail
 *
 * Wrapper around tcp_get_upload_thumbnail_html() that will return no HTML if
 * there is no image URL.
 *
 * @param   string   $url  The URL of the image
 * @return  string         The HTML of the thumbnail
 */
function tcp_get_upload_thumbnail($url = '')
{
	$output = '';

	if (!empty($url)) {
		$output = tcp_get_upload_thumbnail_html($url);
	}

	return $output;
}

/**
 * Get the HTML for an uploaded image thumbnail
 *
 * @param   string   $url  The URL of the image
 * @return  string         The HTML of the thumbnail
 */
function tcp_get_upload_thumbnail_html($url = '')
{
	$output = '<div class="tcap-uploaded-image">';

	if (!empty($url)) {
		$output .= '<img src="' . esc_url(tcp_get_upload_thumbnail_url($url)) . '" alt="">';
	}

	$output .='<div class="tcap-uploaded-image-hover">
		<div class="tcap-uploaded-image-hover-inner">
			<div class="tcap-delete-uploaded-image tcap-tooltip"><span class="tcap-tooltip-text">' . esc_html__('Remove image', 'react-portfolio') . '</span></div>
		</div>
	</div>
</div>';

	return $output;
}

/**
 * Get the thumbnail image URL for an image file
 *
 * @param   string  $url  The URL of the image
 * @return  string        The URL of the thumbnail
 */
function tcp_get_upload_thumbnail_url($url)
{
	if (!is_string($url) || $url === '') {
		return '';
	}

	if (tcp_is_absolute_url($url)) {
		return $url;
	}

	if (tcp_is_absolute_path($url)) {
		return site_url($url);
	}

	$postId = attachment_url_to_postid($url);

	if ($postId > 0) {
		$image = wp_get_attachment_image_src($postId, 'medium');

		if (isset($image[0])) {
			$url = $image[0];
		}
	} else {
		$url = tcp_uploads_url($url);
	}

	return $url;
}

/**
 * Handle the Ajax request to get the YouTube video width/height
 */
function tcp_get_youtube_video_dimensions()
{
	if (!isset($_GET['id']) || !$_GET['id']) {
		wp_send_json(array('type' => 'error', 'message' => 'Video ID is missing or empty'));
	}

	$response = wp_remote_get('https://www.youtube.com/oembed?url=http%3A//www.youtube.com/watch?v%3D' . urlencode($_GET['id']) . '&format=json');

	if (wp_remote_retrieve_response_code($response) != 200 || !strlen($json = wp_remote_retrieve_body($response))) {
		wp_send_json(array('type' => 'error', 'message' => 'The request to the YouTube server failed'));
	}

	$video = json_decode($json, true);

	if (!is_array($video) || !isset($video['width'], $video['height'])) {
		wp_send_json(array('type' => 'error', 'message' => 'The response from the YouTube server was not in the expected format'));
	}

	wp_send_json(array(
		'type' => 'success',
		'width' => $video['width'],
		'height' => $video['height']
	));
}
add_action('wp_ajax_tcp_get_youtube_video_dimensions', 'tcp_get_youtube_video_dimensions');

/**
 * Add the portfolio post type columns to the list
 */
function tcp_edit_portfolio_columns($columns)
{
	$columns['description'] = esc_html__('Description', 'react-portfolio');
	$columns['thumbnail'] = esc_html__('Thumbnail', 'react-portfolio');
	return $columns;
}
add_filter('manage_edit-portfolio_columns', 'tcp_edit_portfolio_columns');

/**
 * Display the portfolio post type column values
 */
function tcp_manage_portfolio_columns($column) {
	global $post;

	if ($post->post_type == 'portfolio') {
		switch($column){
			case 'description':
				the_excerpt();
				break;
			case 'thumbnail':
				if (has_post_thumbnail()) {
					$src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
					$constrain = $src[2] > $src[1] ? 'max-width:100%;max-height:none;' : 'max-height:100%;max-width:none;';
					echo '<div style="position:relative;height:120px;width:120px;">';
					echo '<div style="position:absolute;top:0;left:0;height:100%;width:100%;overflow:hidden;">';
					echo '<div style="position:absolute;top:0;left:0;height:100%;width:100%;-webkit-transform:translate(50%,50%);-ms-transform:translate(50%,50%);transform:translate(50%,50%);">';
					echo '<img src="'. esc_url($src[0]) . '" alt="" style="position:absolute;top:0;left:0;-webkit-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);transform:translate(-50%,-50%);' . $constrain . '">';
					echo '</div></div></div>';
				}
				break;
		}
	}
}
add_action('manage_posts_custom_column', 'tcp_manage_portfolio_columns');

/**
 * Add the Porftolio Bulk Upload and Settings links to the WP menu
 */
function tcp_admin_menu()
{
	add_submenu_page(
		'edit.php?post_type=portfolio',
		esc_html__('Portfolio Bulk Upload', 'react-portfolio'),
		esc_html__('Bulk Upload', 'react-portfolio'),
		'edit_posts',
		'tcp_bulk_upload',
		'tcp_bulk_upload'
	);

	add_submenu_page(
		'edit.php?post_type=portfolio',
		esc_html__('Portfolio Settings', 'react-portfolio'),
		esc_html__('Settings', 'react-portfolio'),
		'edit_theme_options',
		'tcp_settings',
		'tcp_settings'
	);
}
add_action('admin_menu', 'tcp_admin_menu');

/**
 * Display the Bulk Upload page
 */
function tcp_bulk_upload()
{
	require_once TCP_ADMIN_INCLUDES_DIR . '/bulk-upload.php';
}

/**
 * Handle the portfolio bulk upload via Ajax
 */
function tcp_portfolio_bulk_upload_ajax()
{
	if (current_user_can('edit_posts') && check_ajax_referer('portfolio_bulk_upload')) {
		if (isset($_FILES['files'])) {
			$file = $_FILES['files'];
			$result = wp_handle_upload($file, array('action' => $_POST['action']));

			if (is_array($result)) {
				if (array_key_exists('error', $result)) {
					$response = array(
						'type' => 'error',
						'message' => $result['error']
					);
				} else {
					$title = sanitize_title(preg_replace('/\.[^.]+$/', '', $file['name']));

					$postId = wp_insert_post(array(
						'post_type' => 'portfolio',
						'post_title' => $title,
						'post_status' => $_POST['post_status']
					));

					$attachment = array(
						'guid' => $result['url'],
						'post_mime_type' => $result['type'],
						'post_title' => $title,
						'post_content' => '',
						'post_status' => 'inherit'
					);

					$attachId = wp_insert_attachment($attachment, $result['file'], $postId);

					require_once ABSPATH . 'wp-admin/includes/image.php';
					$attachData = wp_generate_attachment_metadata($attachId, $result['file']);
					wp_update_attachment_metadata($attachId, $attachData);

					set_post_thumbnail($postId, $attachId);

					$result += array(
						'post_id' => $postId,
						'post_title' => $title,
						'attach_id' => $attachId,
						'delete_nonce' => wp_create_nonce('tcp_pbu_delete_' . $postId),
						'thumbnail' => wp_get_attachment_image_src($attachId, 'medium')
					);

					$response = array(
						'type' => 'success',
						'data' => $result
					);
				}
			} else {
				$response = array(
					'type' => 'error',
					'message' => esc_html__('An unknown file upload error occurred', 'react-portfolio')
				);
			}
		} else {
			$response = array(
				'type' => 'error',
				'message' => esc_html__('$_FILES data is not set', 'react-portfolio')
			);
		}
	} else {
		$response = array(
			'type' => 'error',
			'message' => esc_html__('No permission or failed nonce check', 'react-portfolio')
		);
	}

	wp_send_json($response);
}
add_action('wp_ajax_tcp_portfolio_bulk_upload_ajax', 'tcp_portfolio_bulk_upload_ajax');

/**
 * Returns the HTML for the Portfolio Item bulk uploader
 *
 * @return  string
 */
function tcp_portfolio_bulk_upload_item_html()
{
	$categories = get_categories(array('taxonomy' => 'portfolio_category'));

	if ($categories instanceof WP_Error) {
		$categoryOutput = esc_html__('Error retrieving portfolio category list.', 'react-portfolio');
	} else {
		if (count($categories)) {
			$categoryOutput = '<div class="tcap-pbu-item-cats-label">' . esc_html__('Categories', 'react-portfolio') . '</div>';

			foreach ($categories as $category) {
				$categoryOutput .= '<div class="tcap-pbu-item-cat">' .
	'<label><input type="checkbox" value="' . esc_attr($category->term_id) . '"> ' . esc_html($category->name) . '</label>' .
'</div>';
			}

		} else {
			$categoryOutput = esc_html__('No portfolio categories found.', 'react-portfolio');
		}
	}

	$tags = get_terms('portfolio_tag');

	if ($tags instanceof WP_Error) {
		$tagOutput = esc_html__('Error retrieving portfolio tag list.', 'react-portfolio');
	} else {
		if (count($tags)) {
			$tagOutput = '<div class="tcap-pbu-item-tags-label">' . esc_html__('Tags', 'react-portfolio') . '</div>';

			foreach ($tags as $tag) {
				$tagOutput .= '<div class="tcap-pbu-item-tag">' .
	'<label><input type="checkbox" value="' . esc_attr($tag->term_id) . '"> ' . esc_html($tag->name) . '</label>' .
'</div>';
			}

		} else {
			$tagOutput = esc_html__('No portfolio categories found.', 'react-portfolio');
		}
	}

	$output = '<div class="tcap-pbu-item tcap-clearfix">' .
	'<div class="tcap-pbu-item-right">' .
		'<div class="tcap-pbu-item-delete-wrap"><span class="tcap-pbu-item-delete" title="' . esc_attr__('Delete this portfolio item', 'react-portfolio') . '">' . esc_html__('Delete', 'react-portfolio') . '</span></div>' .
		'<div class="tcap-pbu-item-thumb"></div>' .
		'<div class="tcap-pbu-item-cats">' . $categoryOutput . '</div>' .
		'<div class="tcap-pbu-item-tags">' . $tagOutput . '</div>' .
	'</div>' .
	'<div class="tcap-pbu-item-left">' .
		'<div class="tcap-pbu-item-fields">' .
			'<div class="tcap-pbu-item-title-label">' . esc_html__('Title', 'react-portfolio') . '</div>' .
			'<div class="tcap-pbu-item-title"><input type="text"></div>' .
			'<div class="tcap-pbu-item-content-label">' . esc_html__('Content', 'react-portfolio') . '</div>' .
			'<div class="tcap-pbu-item-content"><textarea></textarea></div>' .
		'</div>' .
	'</div>' .
'</div>';

	return $output;
}

/**
 * Handle the Ajax call to delete a portfolio item uploaded from the bulk uploader
 */
function tcp_portfolio_bulk_delete_ajax()
{
	if (!isset($_POST['post_id'], $_POST['attach_id']) || !is_numeric($_POST['attach_id']) || !is_numeric($_POST['post_id'])) {
		wp_send_json(array('type' => 'error', 'message' => 'Bad request'));
	}

	if (!current_user_can('delete_posts')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('tcp_pbu_delete_' . $_POST['post_id'], false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	wp_delete_attachment($_POST['attach_id'], true);

	wp_delete_post($_POST['post_id'], true);

	wp_send_json(array(
		'type' => 'success'
	));
}
add_action('wp_ajax_tcp_portfolio_bulk_delete_ajax', 'tcp_portfolio_bulk_delete_ajax');

/**
 * Handle the Ajax call to save the portfolio item data from the bulk uploader
 */
function tcp_portfolio_bulk_save_ajax()
{
	if (!isset($_POST['posts'])) {
		wp_send_json(array('type' => 'error', 'message' => 'Bad request'));
	}

	$posts = json_decode(stripslashes($_POST['posts']));
	parse_str(http_build_query($posts), $posts);

	if (!isset($posts['posts']) || !is_array($posts['posts'])) {
		wp_send_json(array('type' => 'error', 'message' => 'Bad request'));
	}

	if (!current_user_can('edit_posts')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('portfolio_bulk_save', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	foreach ($posts['posts'] as $id => $post) {
		wp_update_post(array(
			'ID' => $id,
			'post_title' => $post['title'],
			'post_content' => $post['content']
		));

		if (isset($post['cats'])) {
			$cats = (array) $post['cats'];
			$cats = array_unique(array_map('intval', $cats));
			wp_set_object_terms($id, $cats, 'portfolio_category');
		} else {
			wp_set_object_terms($id, null, 'portfolio_category');
		}

		if (isset($post['tags'])) {
			$tags = (array) $post['tags'];
			$tags = array_unique(array_map('intval', $tags));
			wp_set_object_terms($id, $tags, 'portfolio_tag');
		} else {
			wp_set_object_terms($id, null, 'portfolio_tag');
		}
	}

	$response = array(
		'type' => 'success',
		'message' => esc_html__('Portfolio items saved.', 'react-portfolio')
	);

	wp_send_json($response);
}
add_action('wp_ajax_tcp_portfolio_bulk_save_ajax', 'tcp_portfolio_bulk_save_ajax');

/**
 * Display the Settings page
 */
function tcp_settings()
{
	require_once TCP_ADMIN_INCLUDES_DIR . '/settings.php';
}

/**
 * Handle the Ajax call to save the settings
 */
function tcp_save_settings_ajax()
{
	if (!isset($_POST['options']) || !is_array($_POST['options'])) {
		wp_send_json(array('type' => 'error', 'message' => 'Bad request'));
	}

	if (!current_user_can('edit_theme_options')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('tcp_save_settings', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	$new = stripslashes_deep($_POST['options']);
	$defaults = tcp_get_default_options();

	$options = array(
		// General settings
		'search' => isset($new['tcap_search']),
		'comments' => isset($new['tcap_comments']),
		'rewrite_slug' => isset($new['tcap_rewrite_slug']) ? sanitize_title($new['tcap_rewrite_slug'], $defaults['rewrite_slug']) : $defaults['rewrite_slug'],
		'category_rewrite_slug' => isset($new['tcap_category_rewrite_slug']) ? sanitize_title($new['tcap_category_rewrite_slug'], $defaults['category_rewrite_slug']) : $defaults['category_rewrite_slug'],
		'tag_rewrite_slug' => isset($new['tcap_tag_rewrite_slug']) ? sanitize_title($new['tcap_tag_rewrite_slug'], $defaults['tag_rewrite_slug']) : $defaults['tag_rewrite_slug'],

		// Fancybox settings
		'video_width' => isset($new['tcap_video_width']) ? absint($new['tcap_video_width']) : $defaults['video_width'],
		'video_height' => isset($new['tcap_video_height']) ? absint($new['tcap_video_height']) : $defaults['video_height'],

		// Serene settings
		'speed' => isset($new['tcap_speed']) ? absint($new['tcap_speed']) : $defaults['speed'],
		'transition' => isset($new['tcap_transition']) ? sanitize_text_field($new['tcap_transition']) : $defaults['transition'],
		'fit_landscape' => isset($new['tcap_fit_landscape']),
		'fit_portrait' => isset($new['tcap_fit_portrait']),
		'fit_always' => isset($new['tcap_fit_always']),
		'position_x' => isset($new['tcap_position_x']) ? sanitize_text_field($new['tcap_position_x']) : $defaults['position_x'],
		'position_y' => isset($new['tcap_position_y']) ? sanitize_text_field($new['tcap_position_y']) : $defaults['position_y'],
		'easing' => isset($new['tcap_easing']) ? sanitize_text_field($new['tcap_easing']) : $defaults['easing'],
		'control_speed' => isset($new['tcap_control_speed']) ? absint($new['tcap_control_speed']) : $defaults['control_speed'],
		'slideshow' => isset($new['tcap_slideshow']),
		'slideshow_auto' => isset($new['tcap_slideshow_auto']),
		'slideshow_speed' => isset($new['tcap_slideshow_speed']) ? absint($new['tcap_slideshow_speed']) : $defaults['slideshow_speed'],
		'keyboard' => isset($new['tcap_keyboard']),
		'caption_position' => isset($new['tcap_caption_position']) ? sanitize_text_field($new['tcap_caption_position']) : $defaults['caption_position'],
		'caption_speed' => isset($new['tcap_caption_speed']) ? absint($new['tcap_caption_speed']) : $defaults['caption_speed'],
		'bullets' => isset($new['tcap_bullets']),
		'low_quality' => isset($new['tcap_low_quality']),

		// Performance settings
		'load_scripts' => isset($new['tcap_load_scripts']) ? sanitize_text_field($new['tcap_load_scripts']) : $defaults['load_scripts'],
		'load_scripts_custom' => isset($new['tcap_load_scripts_custom']) && is_array($new['tcap_load_scripts_custom']) ? array_map('absint', $new['tcap_load_scripts_custom']) : $defaults['load_scripts_custom'],

		// Disable script output
		'disabled_styles' => isset($new['tcap_disabled_styles']) && is_array($new['tcap_disabled_styles']) ? array_map('sanitize_text_field', $new['tcap_disabled_styles']) : $defaults['disabled_styles'],
		'disabled_scripts' => isset($new['tcap_disabled_scripts']) && is_array($new['tcap_disabled_scripts']) ? array_map('sanitize_text_field', $new['tcap_disabled_scripts']) : $defaults['disabled_scripts']
	);

	// This check needs to be before update_option
	$flushRewriteRules = tcp_have_rewrite_slugs_changed($options);

	update_option(TCP_OPTIONS_KEY, $options);

	wp_send_json(array(
		'type' => 'success',
		'flush' => $flushRewriteRules
	));
}
add_action('wp_ajax_tcp_save_settings_ajax', 'tcp_save_settings_ajax');

/**
 * Returns true if and only if the rewrite slugs in the given options are different from the saved slugs
 *
 * @param   array    $options  The plugin options
 * @return  boolean
 */
function tcp_have_rewrite_slugs_changed($options)
{
	return (tcp_get_option('rewrite_slug') != $options['rewrite_slug']) || (tcp_get_option('category_rewrite_slug') != $options['category_rewrite_slug']) || (tcp_get_option('tag_rewrite_slug') != $options['tag_rewrite_slug']);
}

/**
 * Handle the ajax request to flush the rewrite rules
 */
function tcp_flush_rewrite_rules_ajax()
{
	flush_rewrite_rules();
	wp_die();
}
add_action('wp_ajax_tcp_flush_rewrite_rules_ajax', 'tcp_flush_rewrite_rules_ajax');

/**
 * Handle the Ajax call to reset the settings
 */
function tcp_reset_settings_ajax()
{
	if (!current_user_can('edit_theme_options')) {
		wp_send_json(array('type' => 'error', 'message' => 'Insufficient permissions'));
	}

	if (!check_ajax_referer('tcp_reset_settings', false, false)) {
		wp_send_json(array('type' => 'error', 'message' => 'Nonce check failed'));
	}

	$options = tcp_get_default_options();

	// This check needs to be before update_option
	$flushRewriteRules = tcp_have_rewrite_slugs_changed($options);

	update_option(TCP_OPTIONS_KEY, $options);

	wp_send_json(array(
		'type' => 'success',
		'flush' => $flushRewriteRules
	));
}
add_action('wp_ajax_tcp_reset_settings_ajax', 'tcp_reset_settings_ajax');