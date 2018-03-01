<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

$config = array(
	'id' => 'react-metabox',
	'title' => esc_html__('React Options', 'react'),
	'types' => array('page', 'post', 'portfolio'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);

$options = array(
	array(
		'name' => 'layout',
		'title' => esc_html__('Layout', 'react'),
		'tooltip' => esc_html__('Select a layout for this page', 'react'),
		'description' => esc_html__('Choose the page layout.', 'react')
						 . ' ' . esc_html__('Choosing Default will inherit the setting from the theme options panel.', 'react'),
		'type' => 'select',
		'default' => '',
		'options' => array(
			'' => esc_html__('Default', 'react'),
			'left-sidebar' => esc_html__('Left sidebar', 'react'),
			'full-width' => esc_html__('Full width', 'react'),
			'right-sidebar' => esc_html__('Right sidebar', 'react')
		),
		'class' => 'react-layout-selector'
	),
	array(
		'name' => 'sidebar_width',
		'title' => esc_html__('Sidebar width', 'react'),
		'description' => esc_html__('A value of 0 will inherit the setting from the theme options panel.', 'react'),
		'type' => 'slider',
		'default' => '0',
		'slider' => array('from' => 0, 'to' => 50, 'step' => 1, 'dimension' => '%'),
		'dontSaveIf' => array('sidebar_width' => '0')
	),
	array(
		'name' => 'information',
		'title' => esc_html__('Item information', 'react'),
		'description' => esc_html__('Adds extra information to the portfolio item single page view.', 'react'),
		'type' => 'information',
		'default' => array(),
		'types' => array('portfolio')
	),
	array(
		'title' =>  esc_html__('Page template settings', 'react'),
		'type' => 'subtitle',
		'class' => 'react-page-template-settings',
		'types' => array('page')
	),
	array(
		'name' => 'quform_id',
		'title' => esc_html__('Quform form', 'react'),
		'description' => esc_html__('The Quform form to use on the "Contact Page" template. Choosing Default will inherit the setting from the theme options panel at Contact &rarr; General.', 'react'),
		'type' => 'select',
		'default' => '',
		'options' => react_get_quform_forms_options(true),
		'types' => array('page')
	),
	array(
		'name' => 'show_skip',
		'title' => esc_html__('Show the skip intro button', 'react'),
		'description' => esc_html__('Show the "Skip intro" button for pages templates that support it.', 'react'),
		'type' => 'toggle',
		'default' => true,
		'toggle' => 'yn',
		'types' => array('page')
	),
	array(
		'name' => 'skip_url',
		'title' => esc_html__('Skip intro URL', 'react'),
		'description' => esc_html__('The URL of the "Skip intro" button.', 'react'),
		'type' => 'text',
		'class' => 'react-width-400',
		'types' => array('page')
	),
	array(
		'name' => 'skip_text',
		'title' => esc_html__('Skip intro text', 'react'),
		'description' => esc_html__('The text of the "Skip intro" button.', 'react'),
		'type' => 'text',
		'class' => 'react-width-400',
		'types' => array('page')
	),
	array(
		'name' => 'note_block_align',
		'title' => esc_html__('Note block alignment', 'react'),
		'description' => esc_html__('Specify the alignment of the note block within the page.', 'react'),
		'type' => 'select',
		'default' => '',
		'options' => array(
			'' => esc_html__('Left (Default)', 'react'),
			'center' => esc_html__('Center', 'react'),
			'right' => esc_html__('Right', 'react')
		),
		'types' => array('page')
	),
	array(
		'name' => 'note_block_palette',
		'title' => esc_html__('Palette', 'react'),
		'description' => esc_html__('Choose a color scheme', 'react'),
		'type' => 'select',
		'default' => '',
		'options' => array('' => esc_html__('None', 'react')) + react_get_custom_palette_options(),
		'types' => array('page')
	),
	array(
		'name' => 'note_block_header',
		'title' => esc_html__('Show header', 'react'),
		'description' => esc_html__('Show the header above the note block.', 'react'),
		'type' => 'toggle',
		'default' => false,
		'toggle' => 'yn',
		'types' => array('page')
	),
	array(
		'name' => 'show_footer',
		'title' => esc_html__('Show footer', 'react'),
		'description' => esc_html__('Show or hide the footer on this page.', 'react'),
		'type' => 'toggle',
		'default' => true,
		'toggle' => 'yn',
		'types' => array('page')
	),
	array(
		'title' =>  esc_html__('Slider settings', 'react'),
		'type' => 'subtitle'
	),
	array(
		'name' => 'slider',
		'title' => esc_html__('Slider', 'react'),
		'description' => esc_html__('Install the LayerSlider or Slider Revolution plugin to use this option. The Home page slider is set in the theme options panel at Components &rarr; Slider.', 'react'),
		'type' => 'select',
		'default' => '',
		'options' => array(
			'' => esc_html__('No slider', 'react'),
			'home' => esc_html__('Use Home page slider', 'react'),
			'revslider' => esc_html__('Slider Revolution', 'react'),
			'layerslider' => esc_html__('LayerSlider', 'react'),
		)
	),
	array(
		'name' => 'slider_id',
		'title' => esc_html__('Slider ID (or alias)', 'react'),
		'description' => esc_html__('Enter the ID of the slider you want to display, consult the slider documentation to find this. For Slider Revolution you can enter the slider alias.', 'react'),
		'type' => 'text',
		'default' => '',
		'class' => 'react-width-300'
	),
	array(
		'name' => 'slider_convert_id',
		'title' => esc_html__('Slider ID (or alias) for smaller screens', 'react'),
		'description' => esc_html__('Enter the ID of the slider you want to display for smaller screens. Default convert point is set in Options Panel - Components - Slider', 'react'),
		'type' => 'text',
		'default' => '',
		'class' => 'react-width-300'
	),
	array(
		'title' =>  esc_html__('Intro settings', 'react'),
		'type' => 'subtitle',
		'class' => 'react-intro-settings',
		'tooltip' => esc_html__('The Intro is the page heading area before the content, split into two parts: title and subtitle.', 'react'),
	),
	array(
		'name' => 'intro_title_style',
		'title' => esc_html__('Style of Intro title', 'react'),
		'tooltip' => esc_html__('The Default option will inherit the setting from the theme options panel at Global &rarr; Content', 'react'),
		'description' => esc_html__('Some extra style options for the text within the Intro section. Useful for when a background image is used on the Intro. Giving the text a background will help make it more legible.', 'react'),
		'type' => 'select',
		'default' => '',
		'options' => react_get_intro_title_style_options(true)
	),
	array(
		'name' => 'intro_title_position',
		'title' => esc_html__('Text align position title', 'react'),
		'description' => esc_html__('Position options for the text within the Intro section.', 'react'),
		'type' => 'select',
		'default' => '',
		'options' => react_get_intro_title_position_options(true)
	),
	array(
		'name' => 'intro_title_position_mobiles',
		'title' => esc_html__('Responsive Text align position', 'react'),
		'description' => esc_html__('Position for the text within the Intro section on smaller screens.', 'react'),
		'type' => 'select',
		'default' => '',
		'options' => react_get_intro_title_position_mobiles_options(true)
	),
	array(
		'name' => 'intro_title',
		'title' => esc_html__('Intro title', 'react'),
		'description' => esc_html__('By default this is set to the page or post title. You can override it by entering text in the box.', 'react'),
		'type' => 'text',
		'default' => '',
		'class' => 'react-width-400'
	),
	array(
		'name' => 'intro_subtitle',
		'title' => esc_html__('Intro subtitle', 'react'),
		'description' => esc_html__('By default this is set to the post date on posts, and not shown for pages. You can override it by entering text in the box.', 'react'),
		'type' => 'text',
		'default' => '',
		'class' => 'react-width-400'
	),
	array(
		'type' => 'custom_toggle',
		'id' => 'react-toggle-meta-textures-intro',
		'content' => esc_html__('Intro texture settings', 'react')
	),
	react_get_texture_metabox_config('intro', esc_html__('Intro texture', 'react')),
	react_get_detail_metabox_config('intro', esc_html__('Intro detail', 'react')),
	react_get_image_metabox_config('intro', esc_html__('Intro background image', 'react')),
	array(
		'type' => 'multiple',
		'title' => esc_html__('Show intro', 'react'),
		'tooltip' => esc_html__('Choose which devices should show the Intro area.', 'react'),
		'description' => esc_html__('Intro is the heading at the top of the content area.', 'react')
								 . ' ' . esc_html__('Choosing Default will inherit the setting from the theme options panel.', 'react'),
		'elements' => array(
			array(
				'name' => 'show_intro_desktop',
				'title' => esc_html__('Desktop / Laptop', 'react'),
				'type' => 'tritoggle',
				'default' => '',
				'toggle' => 'yn',
				'inline' => true
			),
			array(
				'name' => 'show_intro_phone',
				'title' => esc_html__('Phone', 'react'),
				'type' => 'tritoggle',
				'default' => '',
				'toggle' => 'yn',
				'inline' => true
			),
			array(
				'name' => 'show_intro_tablet',
				'title' => esc_html__('Tablet', 'react'),
				'type' => 'tritoggle',
				'default' => '',
				'toggle' => 'yn',
				'inline' => true
			),
			array(
				'name' => 'show_intro_large',
				'title' => esc_html__('Large Screens', 'react'),
				'type' => 'tritoggle',
				'default' => '',
				'toggle' => 'yn',
				'inline' => true
			)
		)
	),
	array(
		'title' =>  esc_html__('Featured image settings', 'react'),
		'type' => 'subtitle'
	),
	array(
		'name' => 'featured_image',
		'title' => esc_html__('Featured image', 'react'),
		'tooltip' => esc_html__('Show / hide featured image', 'react'),
		'description' => esc_html__('Display the featured image at the top of the post', 'react'),
		'type' => 'tritoggle',
		'default' => ''
	),
	array(
		'name' => 'type',
		'title' => esc_html__('Featured image type', 'react'),
		'description' => esc_html__('Choose a type based on the content that you are displaying on this post. "Image" type will use the featured image. "Video" type will allow you to embed a YouTube or Vimeo video.', 'react'),
		'type' => 'select',
		'default' => 'image',
		'options' => array(
			'' => esc_html__('Image', 'react'),
			'video_embed' => esc_html__('Video', 'react')
		),
		'types' => array('post', 'page')
	),
	array(
		'type' => 'multiple',
		'title' => esc_html__('YouTube / Vimeo video URL', 'react'),
		'tooltip' => esc_html__('Enter the full URL including http://', 'react'),
		'description' => esc_html__('Enter the URL for the YouTube or Vimeo video. The width and height will be fetched automatically and determines the aspect ratio of the embedded video.', 'react'),
		'elements' => array(
			array(
				'name' => 'video_embed',
				'title' => esc_html__('Video URL', 'react'),
				'tooltip' => esc_html__('Enter the full URL including http://', 'react'),
				'type' => 'text',
				'class' => 'react-width-400',
				'inline' => true
			),
			array(
				'name' => 'video_embed_width',
				'title' => esc_html__('Width', 'react'),
				'type' => 'number',
				'unit' => 'px',
				'default' => '',
				'class' => 'react-width-50',
				'inline' => true
			),
			array(
				'name' => 'video_embed_height',
				'title' => esc_html__('Height', 'react'),
				'type' => 'number',
				'unit' => 'px',
				'default' => '',
				'class' => 'react-width-50',
				'inline' => true
			)
		),
		'types' => array('post', 'page')
	),
	array(
		'name' => 'featured_image_type',
		'title' => esc_html__('Featured image position', 'react'),
		'tooltip' => esc_html__('Choose a layout type for the featured image', 'react'),
		'description' => esc_html__('"Default" will use the settings from the theme options panel at Pages &rarr; Images or Blog &rarr; Images (depending on the post type).', 'react'),
		'type' => 'select',
		'default' => '',
		'options' => array(
			'' => esc_html__('Default', 'react'),
			'full' => esc_html__('Full width', 'react'),
			'left' => esc_html__('Float left', 'react'),
			'right' => esc_html__('Float right', 'react')
		)
	),
	array(
		'title' =>  esc_html__('Background settings', 'react'),
		'type' => 'subtitle'
	),
	array(
		'type' => 'multiple',
		'title' => esc_html__('Backgrounds', 'react'),
		'tooltip' => esc_html__('Choose which devices should have background images. You can create groups in the theme options panel.', 'react'),
		'description' => esc_html__('Choose a group of images to use for each device; this will override the backgrounds chosen in the theme options panel for this specific page.', 'react')
			 . ' ' . esc_html__('Choosing Default will inherit the setting from the theme options panel.', 'react'),
		'elements' => array(
			array(
				'name' => 'background_phones',
				'title' => esc_html__('Phone', 'react'),
				'type' => 'select',
				'default' => '',
				'options' => react_get_background_group_options(true),
				'inline' => true
			),
			array(
				'name' => 'background_tablets',
				'title' => esc_html__('Tablet', 'react'),
				'type' => 'select',
				'default' => '',
				'options' => react_get_background_group_options(true),
				'inline' => true
			),
			array(
				'name' => 'background_desktops',
				'title' => esc_html__('Desktop / Laptop', 'react'),
				'type' => 'select',
				'default' => '',
				'options' => react_get_background_group_options(true),
				'inline' => true
			),
			array(
				'name' => 'background_large',
				'title' => esc_html__('Large Screens', 'react'),
				'type' => 'select',
				'default' => '',
				'options' => react_get_background_group_options(true),
				'inline' => true
			),
		)
	),
	array(
		'name' => 'always_show_captions',
		'title' => esc_html__('Always show captions', 'react'),
		'description' => esc_html__('Always show the background image captions, otherwise they will only be shown in full screen mode.', 'react')
						 . ' ' . esc_html__('Choosing Default will inherit the setting from the theme options panel.', 'react'),
		'tooltip' => esc_html__('Remember to add captions to images, by hovering the uploaded image thumbnail and clicking the cog icon.', 'react'),
		'type' => 'tritoggle',
		'default' => '',
		'toggle' => 'yn'
	),
	array(
		'type' => 'custom_toggle',
		'id' => 'react-toggle-meta-textures-body',
		'content' => esc_html__('Page body background settings', 'react')
	),
	react_get_texture_metabox_config('body', esc_html__('Page body texture', 'react')),
	react_get_detail_metabox_config('body', esc_html__('Page body detail', 'react')),
	react_get_image_metabox_config('body',__('Page body image', 'react')),
	array(
		'type' => 'custom_toggle',
		'id' => 'react-toggle-meta-textures-background',
		'content' => esc_html__('Background overlay texture settings', 'react')
	),
	react_get_texture_metabox_config('background', esc_html__('Background overlay texture', 'react')),
	react_get_detail_metabox_config('background', esc_html__('Background overlay detail', 'react')),
	react_get_image_metabox_config('background',__('Background overlay image', 'react')),
	array(
		'type' => 'multiple',
		'title' => esc_html__('Background video', 'react'),
		'tooltip' => esc_html__('Enter the full URL including http://', 'react'),
		'description' => esc_html__('Set a background video for this page by entering the URL of a YouTube or Vimeo video. The background video will show instead of the background images. The height and width of the original video will be fetched automatically.', 'react'),
		'elements' => array(
			array(
				'name' => 'background_video',
				'title' => esc_html__('Video URL', 'react'),
				'tooltip' => esc_html__('Enter the full URL including http://', 'react'),
				'type' => 'text',
				'class' => 'react-width-400',
				'inline' => true
			),
			array(
				'name' => 'background_video_width',
				'title' => esc_html__('Width', 'react'),
				'type' => 'number',
				'unit' => 'px',
				'default' => '',
				'class' => 'react-width-50',
				'inline' => true
			),
			array(
				'name' => 'background_video_height',
				'title' => esc_html__('Height', 'react'),
				'type' => 'number',
				'unit' => 'px',
				'default' => '',
				'class' => 'react-width-50',
				'inline' => true
			)
		)
	),
	array(
		'type' => 'multiple',
		'title' => esc_html__('Video on devices', 'react'),
		'tooltip' => esc_html__('Choose which devices to enable the video on', 'react'),
		'description' => esc_html__('Videos can use a lot of bandwidth, you might want to consider that users accessing your site from a mobile network may incur charges. If these options are set to Off then users will be shown background images instead if you have set them up.', 'react')
						. ' '. esc_html__('Choosing Default will inherit the setting from the theme options panel.', 'react'),
		'elements' => array(
			array(
				'name' => 'background_video_tablet',
				'title' => esc_html__('Tablet', 'react'),
				'type' => 'tritoggle',
				'default' => '',
				'inline' => true
			),
			array(
				'name' => 'background_video_mobile',
				'title' => esc_html__('Mobile', 'react'),
				'type' => 'tritoggle',
				'default' => '',
				'inline' => true
			)
		)
	),
	array(
		'name' => 'background_video_autostart',
		'title' => esc_html__('Auto-start video', 'react'),
		'description' => esc_html__('Start the video automatically.', 'react')
						 . ' ' . esc_html__('Choosing Default will inherit the setting from the theme options panel.', 'react'),
		'type' => 'tritoggle',
		'default' => ''
	),
	array(
		'name' => 'background_video_mute',
		'title' => esc_html__('Mute video', 'react'),
		'description' => esc_html__('Mute the video by default, the user can unmute it using the video controls.', 'react')
						 . ' ' . esc_html__('Choosing Default will inherit the setting from the theme options panel.', 'react'),
		'type' => 'tritoggle',
		'default' => ''
	),
	array(
		'name' => 'background_video_complete',
		'title' => esc_html__('When video finishes', 'react'),
		'description' => esc_html__('Choose an action to take when the video has finished playing.', 'react'),
		'type' => 'select',
		'default' => '',
		'options' => array(
			'' => esc_html__('Default', 'react'),
			'none' => esc_html__('Do nothing', 'react'),
			'restart' => esc_html__('Restart video', 'react'),
			'hide' => esc_html__('Hide video', 'react'),
			'redirect' => esc_html__('Redirect to another page', 'react')
		)
	),
	array(
		'name' => 'background_video_redirect',
		'title' => esc_html__('Redirect URL', 'react'),
		'description' => esc_html__('Enter the URL to redirect to when the video has finished playing.', 'react'),
		'type' => 'text',
		'default' => '',
		'class' => 'react-width-400'
	),
	array(
		'name' => 'background_video_start',
		'title' => esc_html__('Video start position', 'react'),
		'description' => esc_html__('Playback to the specified number of seconds into the video, if empty it will use the setting from the theme options panel.', 'react'),
		'tooltip' => esc_html__('The video will start at this number of seconds after the start', 'react'),
		'type' => 'text',
		'default' => '',
		'class' => 'react-width-50'
	),
	array(
		'title' =>  esc_html__('Audio settings', 'react'),
		'type' => 'subtitle'
	),
	array(
		'name' => 'audio',
		'title' => esc_html__('Music tracks', 'react'),
		'tooltip' => esc_html__('Upload audio files from your computer', 'react'),
		'description' => esc_html__('Either a .mp3 or .m4a file is required, uploading a .ogg version will increase browser support. You need to use the same chosen formats for every track you add. For example if you choose .m4a and .ogg for your first track, every other track should have both a .m4a and .ogg version.', 'react'),
		'type' => 'audioupload',
		'default' => array()
	),
	array(
		'name' => 'audio_random',
		'title' => esc_html__('Randomize tracks', 'react'),
		'description' => esc_html__('Randomize the order of the tracks.', 'react')
						 . ' ' . esc_html__('Choosing Default will inherit the setting from the theme options panel.', 'react'),
		'type' => 'tritoggle',
		'default' => ''
	),
	array(
		'name' => 'audio_autostart',
		'title' => esc_html__('Auto-start music', 'react'),
		'description' => esc_html__('Start the music automatically.', 'react')
						 . ' ' . esc_html__('Choosing Default will inherit the setting from the theme options panel.', 'react'),
		'type' => 'tritoggle',
		'default' => ''
	),
	array(
		'name' => 'audio_complete',
		'title' => esc_html__('When music finishes', 'react'),
		'description' => esc_html__('Choose an action to take when the music has finished playing.', 'react')
						 . ' ' . esc_html__('Choosing Default will inherit the setting from the theme options panel.', 'react'),
		'type' => 'select',
		'default' => '',
		'options' => array(
			'' => esc_html__('Default', 'react'),
			'none' => esc_html__('Do nothing', 'react'),
			'restart' => esc_html__('Restart music', 'react')
		)
	),
	array(
		'title' =>  esc_html__('Misc settings', 'react'),
		'type' => 'subtitle'
	),
	array(
		'name' => 'breadcrumbs',
		'title' => esc_html__('Enable breadcrumbs', 'react'),
		'tooltip' => esc_html__('The default is set in the theme options panel at Global &rarr; Content', 'react'),
		'description' => esc_html__('Enable breadcrumb navigation. Requires that the Breadcrumb NavXT or Yoast SEO plugin is activated.', 'react'),
		'type' => 'tritoggle',
		'default' => ''
	),
	array(
		'name' => 'go_down_link_location',
		'title' => esc_html__('"Go down" link location', 'react'),
		'tooltip' => esc_html__('The default is set in the theme options panel at Global &rarr; Navigation', 'react'),
		'description' => esc_html__('If you have enabled the "Go down" arrow, you can override the link location for this specific page.', 'react'),
		'type' => 'select',
		'default' => '',
		'options' => react_get_go_down_link_locations(true)
	),
	array(
		'type' => 'multiple',
		'title' => esc_html__('Footer reveal', 'react'),
		'description' => esc_html__('Enable or disable the reveal effect on the full footer section. You can also configure this globally at Theme Options - Global - Footer, this option does nothing if the Footer is Fixed.', 'react'),
		'elements' => array(
			array(
				'name' => 'footer_reveal',
				'title' => esc_html__('On / Off', 'react'),
				'tooltip' => esc_html__('The footer reveal will work best with some designs', 'react'),
				'inline' => true,
				'type' => 'tritoggle',
				'default' => ''
			),
			array(
				'name' => 'footer_reveal_help',
				'title' => esc_html__('Hide at top of page', 'react'),
				'tooltip' => esc_html__('If you can see the footer at the top of your page, switch this on', 'react'),
				'inline' => true,
				'type' => 'tritoggle',
				'default' => ''
			),
			array(
				'name' => 'footer_reveal_height',
				'title' => esc_html__('Height', 'react'),
				'tooltip' => esc_html__('What is the height of the area to reveal?', 'react'),
				'inline' => true,
				'type' => 'slider',
				'default' => '-1',
				'slider' => array('from' => -1, 'to' => 1000, 'step' => 1, 'dimension' => 'px')
			),
			array(
				'name' => 'footer_reveal_minheight',
				'title' => esc_html__('Min Height', 'react'),
				'tooltip' => esc_html__('Add a minimum height to ensure there is no gaps or hidden content.', 'react'),
				'inline' => true,
				'type' => 'slider',
				'default' => '-1',
				'slider' => array('from' => -1, 'to' => 1000, 'step' => 1, 'dimension' => 'px')
			),
			array('type' => 'clear'),
			array(
				'name' => 'footer_convert',
				'title' => esc_html__('When to convert Footer', 'react'),
				'tooltip' => esc_html__('Choose the viewport width to turn off the footer reveal effect. The Default option will use the value from Theme Options.', 'react'),
				'type' => 'select',
				'default' => '',
				'options' => react_get_convert_options(true),
				'inline' => true,
			),
			array(
				'name' => 'footer_convert_custom',
				'title' => esc_html__('Custom', 'react'),
				'type' => 'slider',
				'default' => '1000',
				'inline' => true,
				'slider' => array('from' => 0, 'to' => 5000, 'step' => 1, 'dimension' => 'px'),
				'dontSaveIf' => array(
					'footer_convert' => array('', 'only-retina-devices', 'phone-ptr', 'phone-ldsp', 'tablet-ptr', 'tablet-ldsp', 'box-width', 'only-retina-devices'),
				)
			)
		)
	),
	array(
		'name' => 'footer_end_page_popout',
		'title' => esc_html__('Footer popout box content', 'react'),
		'description' => esc_html__('The footer popout box is shown when the user scrolls to the bottom of the page. You can enter text/HTML and shortcodes here. If empty it will use the setting from the theme options panel.', 'react'),
		'type' => 'textarea',
		'default' => ''
	),
	react_get_margin_metabox_config('top', esc_html__('Top vertical space', 'react'), esc_html__('The Vertical space between the Top Header (or top of page) and Main header. Useful if you want to show the background. The Default setting will inherit from the theme options panel.', 'react')),
	react_get_margin_metabox_config('bottom', esc_html__('Bottom vertical space', 'react'), esc_html__('The Vertical space between the Main (and Sub Footer) and bottom of page. Useful if you want to show the background. The Default setting will inherit from the theme options panel.', 'react'))
);

new React_Metabox_Generator($config, $options);

/**
 * Returns the options array for textures
 *
 * @param   string  $key    The option prefix
 * @param   string  $title  Title label of the option section
 * @return  array           The config array
 */
function react_get_texture_metabox_config($key, $title)
{
	return array(
		'type' => 'multiple',
		'title' => $title,
		'tooltip' => esc_html__('Choose a style to be applied to this section or add your own in the options further down', 'react'),
		'wrap_class' => 'react-meta-texture-wrap-' . $key,
		'elements' => array(
			array(
				'name' => $key . '_texture',
				'type' => 'select',
				'default' => '',
				'class' => 'react-texture-select',
				'options' => react_get_texture_options(true)
			),
			array(
				'name' => $key . '_texture_opacity',
				'title' => esc_html__('Opacity level', 'react'),
				'description' => esc_html__('A value of 0 will inherit the setting from the theme options panel.', 'react'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => 0, 'to' => 50, 'step' => 10, 'dimension' => '%'),
				'dontSaveIf' => array($key . '_texture' => 'none', $key . '_texture_opacity' => '0')
			),
			array(
				'name' => $key . '_texture_fixed',
				'title' => esc_html__('Fixed', 'react'),
				'description' => esc_html__('Choosing Default will inherit the setting from the theme options panel.', 'react'),
				'type' => 'tritoggle',
				'default' => '',
				'toggle' => 'yn'
			),
			array(
				'name' => $key . '_texture_large',
				'title' => esc_html__('Use double size for non retina displays', 'react'),
				'tooltip' => esc_html__('By default the background image will be the same size for both hand held devices and for laptops / desktops. By selecting Yes here the background image will be double the size for screens larger than tablets.', 'react'),
				'description' => esc_html__('Choosing Default will inherit the setting from the theme options panel.', 'react'),
				'type' => 'tritoggle',
				'default' => '',
				'toggle' => 'yn'
			)
		)
	);
}

/**
 * Returns the options array for details
 *
 * @param   string  $key    The option prefix
 * @param   string  $title  Title label of the option section
 * @return  array           The config array
 */
function react_get_detail_metabox_config($key, $title)
{
	return array(
		'type' => 'multiple',
		'title' => $title,
		'tooltip' => esc_html__('Choose a style to be applied to this section or add your own in the options further down', 'react'),
		'wrap_class' => 'react-meta-detail-wrap-' . $key,
		'elements' => array(
			array(
				'name' => $key . '_detail',
				'type' => 'select',
				'default' => '',
				'class' => 'react-detail-select',
				'options' => react_get_detail_options(true)
			),
			array(
				'name' => $key . '_detail_opacity',
				'title' => esc_html__('Opacity level', 'react'),
				'description' => esc_html__('A value of 0 will inherit the setting from the theme options panel.', 'react'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => 0, 'to' => 50, 'step' => 10, 'dimension' => '%'),
				'dontSaveIf' => array($key . '_detail' => 'none', $key . '_detail_opacity' => '0')
			)
		)
	);
}

/**
 * Returns the options array for custom image
 *
 * @param   string  $key    The option prefix
 * @param   string  $title  Title label of the option section
 * @return  array           The config array
 */
function react_get_image_metabox_config($key, $title)
{
	return array(
		'type' => 'multiple',
		'title' => $title,
		'tooltip' => esc_html__('Add your own image background for this section. By adding a background image here you can now only use either the Texture or the Detail. Texture has priority if both are selected.', 'react'),
		'wrap_class' => 'react-meta-image-wrap-' . $key,
		'elements' => array(
			array(
				'name' => $key . '_image',
				'title' => esc_html__('Image URL', 'react'),
				'type' => 'text_upload',
				'default' => '',
				'class' => 'react-width-400',
				'inline' => true,
				'id' => $key . '_image_browse'
			),
			array(
				'name' => $key . '_image_width',
				'title' => esc_html__('Width', 'react'),
				'type' => 'number',
				'unit' => 'px',
				'default' => '',
				'class' => 'react-width-50',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'name' => $key . '_image_height',
				'title' => esc_html__('Height', 'react'),
				'type' => 'number',
				'unit' => 'px',
				'default' => '',
				'class' => 'react-width-50',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'type' => 'holder',
				'key' => $key . '_image',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'type' => 'tritoggle',
				'name' => $key . '_image_use_feat',
				'title' => esc_html__('Use featured image', 'react'),
				'inline' => true,
				'default' => '',
				'toggle' => 'yn',
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array('type' => 'clear'),
			array(
				'name' => $key . '_image_retina_use_main_img',
				'title' => esc_html__('What would you like to do for smaller screens and/or Retina devices?', 'react'),
				'tooltip' => esc_html__('Choose an option for smaller screens and/or Retina devices', 'react'),
				'type' => 'select',
				'default' => 'never',
				'options' => react_get_retina_use_main_img_options(),
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'type' => 'div_open',
				'class' => 'image_retina_use_main_img_is_yes'
			),
			array(
				'name' => $key . '_image_retina',
				'title' => esc_html__('Alternative or Retina image URL', 'react'),
				'type' => 'text_upload',
				'default' => '',
				'class' => 'react-width-400',
				'inline' => true,
				'id' => $key . '_image_retina_browse',
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'name' => $key . '_image_retina_width',
				'title' => esc_html__('Width', 'react'),
				'type' => 'number',
				'unit' => 'px',
				'default' => '',
				'class' => 'react-width-50',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'name' => $key . '_image_retina_height',
				'title' => esc_html__('Height', 'react'),
				'type' => 'number',
				'unit' => 'px',
				'default' => '',
				'class' => 'react-width-50',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'type' => 'holder',
				'key' => $key . '_image_retina',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array('type' => 'clear'),
			array(
				'name' => $key . '_image_is_retina',
				'title' => esc_html__('Is this a retina ready image?', 'react'),
				'tooltip' => esc_html__('The Retina ready image will be used at 50% size, so the image you upload must be double the actual size required. If you do not require a Retina ready image and are using this as an alternative device image, select NO.', 'react'),
				'type' => 'toggle',
				'default' => false,
				'toggle' => 'yn',
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'type' => 'div_close' // .image_retina_use_main_img_is_yes
			),
			array(
				'type' => 'div_open',
				'class' => 'image_retina_use_main_img_is_yes_or'
			),
			array(
				'name' => $key . '_image_convert',
				'title' => esc_html__('When would you like to start using this image?', 'react'),
				'tooltip' => esc_html__('Choose which viewport size to start showing the new image', 'react'),
				'type' => 'select',
				'default' => 'box-width',
				'options' => react_get_convert_options(),
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'name' => $key . '_image_convert_custom',
				'type' => 'slider',
				'default' => 1000,
				'slider' => array('from' => 0, 'to' => 5000, 'step' => 1, 'dimension' => 'px'),
				'inline' => true,
				'wrap_class' => 'react-custom-convert-wrap',
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array('type' => 'clear'),
			array(
				'type' => 'div_close' // .image_retina_use_main_img_is_yes_or
			),
			array(
				'type' => 'accordion_open',
				'content' => esc_html__('Manage the display settings for this background image', 'react')
			),
			array(
				'type' => 'div_open',
				'class' => 'react-background-image-settings'
			),
			array(
				'type' => 'div',
				'class' => 'react-meta-multi-title',
				'content' => esc_html__('Main image', 'react')
			),
			array(
				'name' => $key . '_image_position',
				'type' => 'select',
				'default' => 'center top',
				'options' => react_get_background_position_options(),
				'class' => 'react-bg-position-select',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'name' => $key . '_image_repeat',
				'type' => 'select',
				'default' => 'no-repeat',
				'options' => react_get_background_repeat_options(),
				'class' => 'react-bg-repeat-select',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array('type' => 'clear'),
			array(
				'name' => $key . '_image_position_custom',
				'title' => esc_html__('Custom value', 'react'),
				'type' => 'text',
				'default' => '',
				'tooltip' => esc_html__('The background-position property specifies the position of the background image. Examples: "95% 95%" or "300px 500px"', 'react'),
				'class' => 'react-image-position-custom react-width-100',
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'name' => $key . '_image_fixed',
				'title' => esc_html__('Fixed', 'react'),
				'type' => 'toggle',
				'default' => false,
				'toggle' => 'yn',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'name' => $key . '_image_background_size',
				'title' => esc_html__('Background size', 'react'),
				'type' => 'text',
				'default' => '',
				'class' => 'react-width-100',
				'tooltip' => esc_html__('The background-size property specifies the size of the background image. Examples: "100% auto" or "300px 500px"', 'react'),
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and',
				'placeholder' => 'auto auto'
			),
			array(
				'type' => 'div_close' // .react-background-image-settings
			),
			array(
				'type' => 'div_open',
				'class' => 'react-background-image-retina-settings'
			),
			array(
				'type' => 'div',
				'class' => 'react-meta-multi-title',
				'content' => esc_html__('Retina image', 'react')
			),
			array(
				'name' => $key . '_image_position_retina',
				'type' => 'select',
				'default' => 'center top',
				'options' => react_get_background_position_options(),
				'class' => 'react-bg-position-select',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'name' => $key . '_image_repeat_retina',
				'type' => 'select',
				'default' => 'no-repeat',
				'options' => react_get_background_repeat_options(),
				'class' => 'react-bg-repeat-select',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array('type' => 'clear'),
			array(
				'name' => $key . '_image_position_custom_retina',
				'title' => esc_html__('Custom value', 'react'),
				'type' => 'text',
				'default' => '',
				'tooltip' => esc_html__('The background-position property specifies the position of the background image. Examples: "95% 95%" or "300px 500px"', 'react'),
				'class' => 'react-image-position-custom react-width-100',
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'name' => $key . '_image_fixed_retina',
				'title' => esc_html__('Fixed', 'react'),
				'type' => 'toggle',
				'default' => false,
				'toggle' => 'yn',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'name' => $key . '_image_background_size_retina',
				'title' => esc_html__('Background size', 'react'),
				'type' => 'text',
				'default' => '',
				'class' => 'react-width-100',
				'tooltip' => esc_html__('The background-size property specifies the size of the background image. Examples: "100% auto" or "300px 500px"', 'react'),
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and',
				'placeholder' => 'auto auto'
			),
			array(
				'type' => 'div_close' // .react-background-image-retina-settings
			),
			array(
				'type' => 'div_open',
				'class' => 'react-background-image-parallax-settings'
			),
			array(
				'name' => $key . '_image_parallax',
				'title' => esc_html__('Parallax ratio', 'react'),
				'tooltip' => esc_html__('If you set this to anything other than 1, the background image will scroll at a different speed than the page, creating a parallax effect. Setting it to 0.5 will make it scroll at half the speed, setting it to 2 will make it scroll at twice the speed.', 'react'),
				'type' => 'text',
				'default' => '1',
				'class' => 'react-width-50',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'name' => $key . '_image_parallax_offset',
				'title' => esc_html__('Parallax offset', 'react'),
				'tooltip' => esc_html__('This number determines when the background image will be visible, it is the number of pixels from the top of the viewport that the top of background image should be at the top of this section. Experiment with different numbers.', 'react'),
				'type' => 'text',
				'default' => '0',
				'class' => 'react-width-50',
				'inline' => true,
				'dontSaveIf' => array($key . '_image' => '', $key . '_image_use_feat' => false, $key . '_image_use_feat' => ''),
				'dontSaveIfOperator' => 'and'
			),
			array(
				'type' => 'div_close' // .react-background-image-parallax-settings
			),
			array(
				'type' => 'accordion_close'
			)
		)
	);
}

function react_get_margin_metabox_config($key, $title, $tooltip)
{
	return array(
		'type' => 'multiple',
		'title' => $title,
		'tooltip' => $tooltip,
		'elements' => array(
			array(
				'name' => 'page_layout_' . $key . '_margin_choose',
				'title' => esc_html__('Default/Desktop', 'react'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Default', 'react'),
					'screen' => esc_html__('Set to viewport height', 'react'),
					'custom' => esc_html__('Custom', 'react')
				),
				'inline' => true
			),
			array(
				'name' => 'page_layout_' . $key . '_margin',
				'title' => esc_html__('Custom', 'react'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => 0, 'to' => 1000, 'step' => 5, 'dimension' => 'px'),
				'dontSaveIf' => array('page_layout_' . $key . '_margin_choose' => array('', 'screen')),
				'inline' => true
			),
			array('type' => 'clear'),
			array(
				'name' => 'page_layout_' . $key . '_margin_phones_choose',
				'title' => esc_html__('Phone', 'react'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Default', 'react'),
					'screen' => esc_html__('Set to viewport height', 'react'),
					'custom' => esc_html__('Custom', 'react')
				),
				'inline' => true
			),
			array(
				'name' => 'page_layout_' . $key . '_margin_phones',
				'title' => esc_html__('Custom', 'react'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => 0, 'to' => 1000, 'step' => 5, 'dimension' => 'px'),
				'dontSaveIf' => array('page_layout_' . $key . '_margin_phones_choose' => array('', 'screen')),
				'inline' => true
			),
			array('type' => 'clear'),
			array(
				'name' => 'page_layout_' . $key . '_margin_tablets_choose',
				'title' => esc_html__('Tablet', 'react'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Default', 'react'),
					'screen' => esc_html__('Set to viewport height', 'react'),
					'custom' => esc_html__('Custom', 'react')
				),
				'inline' => true
			),
			array(
				'name' => 'page_layout_' . $key . '_margin_tablets',
				'title' => esc_html__('Custom', 'react'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => 0, 'to' => 1000, 'step' => 5, 'dimension' => 'px'),
				'dontSaveIf' => array('page_layout_' . $key . '_margin_tablets_choose' => array('', 'screen')),
				'inline' => true
			),
			array('type' => 'clear'),
			array(
				'name' => 'page_layout_' . $key . '_margin_tv_choose',
				'title' => esc_html__('Large screens', 'react'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Default', 'react'),
					'screen' => esc_html__('Set to viewport height', 'react'),
					'custom' => esc_html__('Custom', 'react')
				),
				'inline' => true
			),
			array(
				'name' => 'page_layout_' . $key . '_margin_tv',
				'title' => esc_html__('Custom', 'react'),
				'type' => 'slider',
				'default' => '0',
				'slider' => array('from' => 0, 'to' => 1000, 'step' => 5, 'dimension' => 'px'),
				'dontSaveIf' => array('page_layout_' . $key . '_margin_tv_choose' => array('', 'screen')),
				'inline' => true
			),
		)
	);
}