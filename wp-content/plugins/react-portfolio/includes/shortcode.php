<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * The [portfolio] shortcode
 *
 * @param   array   $atts     The shortcode attributes
 * @param   string  $content  The shortcode content
 * @return  string
 */
function tcp_shortcode_portfolio($atts, $content = '')
{
	$options = shortcode_atts(array(
		'type' => 'lightbox',
		'post_type' => 'portfolio',
		'boxed' => '0',
		'text_align' => '',
		'grid' => '0',
		'show_border' => '0',
		'columns' => '3',
		'convert' => 'units-tablet-50 phone-width-100',
		'posts' => '',
		'categories' => '',
		'category__and' => '',
		'category__not_in' => '',
		'include_children' => '1',
		'author' => '',
		'masonry_layout' => 'masonry',
		'masonry_use_layout_options' => '0',
		'sortable' => '1',
		'sortable_position' => '',
		'sortable_show_all' => '1',
		'sortable_all_text' => esc_html__('All', 'react-portfolio'),
		'show_title' => '1',
		'title_tag' => 'h2',
		'title_min_height' => '',
		'link_title' => '1',
		'like' => '0',
		'like_icon' => 'fa-thumbs-up',
		'show_meta' => '0',
		'show_date' => '0',
		'alt_date_like_layout' => '',
		'image_details_on_hover' => '1',
		'show_description' => '1',
		'description_min_height' => '',
		'description_length' => '',
		'full_description' => '0',
		'show_read_more' => '1',
		'read_more_button_style' => 'basic-button',
		'hover' => 'med-hvr',
		'read_more' => '',
		'show_image' => '1',
		'height' => '0',
		'image_type' => 'above',
		'content_on_hover' => '1',
		'hover_type_height' => '',
		'float_width' => '150',
		'float_height' => '0',
		'paging' => '0',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'max' => -1,
		'offset' => '0',
		'like_image' => '0',
		'like_image_icon' => 'fa-thumbs-up',
		'like_title' => '0',
		'like_title_icon' => 'fa-thumbs-up',
		'gap' => '',
		'margin_bottom' => '',
		'hover_animation' => '',
		'animation' => '',
		'animation_delay' => '',
		'animation_offset' => '',
		'show_title_icon' => '0'
	), $atts);

	// Ensure the post type is supported and use the correct taxonomy
	if ($options['post_type'] == 'post') {
		$taxonomy = 'category';
	} else {
		$options['post_type'] = 'portfolio';
		$taxonomy = 'portfolio_category';
	}

	$output = '';

	$columns = (int) $options['columns'];
	if ($columns < 1) {
		$columns = 1;
	} elseif ($columns > 10) {
		$columns = 10;
	}

	if ($options['grid'] != '1') {
		if ($options['gap'] === '') {
			$options['gap'] = tcp_gap_from_columns($columns);
		}
		if ($options['margin_bottom'] === '') {
			$options['margin_bottom'] = tcp_margin_bottom_from_columns($columns);
		}
	}

	if (!$options['hover']) {
		$options['hover'] = tcp_hover_from_columns($columns);
	}

	$width = tcp_get_image_size_for_columns($columns);

	// Custom excerpt length
	if ($options['description_length']) {
		$excerptLength = new Tcp_Excerpt_Length($options['description_length']);
		add_filter('excerpt_length', array($excerptLength, 'getLength'));
	}

	add_filter('excerpt_more', 'tcp_excerpt_more');

	$classes = array('tcp-portfolio', tcp_prefix_classes("portfolio-{$options['type']}"), tcp_prefix_classes("portfolio-{$columns}-column"), 'tcp-clearfix');

	if ($options['boxed'] == '1' && $options['image_type'] != 'on-hover') {
		$classes[] = 'tcp-boxed';
	}

	if ($options['image_details_on_hover'] == '1') {
		$classes[] = 'tcp-details-on-hover';
	} else {
		$classes[] = 'tcp-details-always';
	}

	if ($options['text_align'] && $options['image_type'] != 'on-hover') {
		$classes[] = tcp_prefix_classes($options['text_align']);
	}

	if (!$options['show_border']) {
		$classes[] = 'tcp-no-border';
	}

	if ($options['grid'] && $options['height'] > 0) {
		$classes[] = 'tcp-grid';
	}

	if ($options['image_type'] == 'on-hover') {
		$buttonClass = 'class="tcp-basic-button tcp-dark-button"';
		$classes[] = $options['content_on_hover'] ? '' : ' always';
		if ($options['like'] || $options['show_date']) {
			$classes[] = 'tcp-date-like-above';
		}
	} else {
		$buttonClass = 'class="' . esc_attr(tcp_prefix_classes($options['read_more_button_style'])) . '"';
		if ($options['alt_date_like_layout']) {
			$classes[] = tcp_prefix_classes($options['alt_date_like_layout']);
		} else {
			$classes[] = 'tcp-date-like-right';
		}
	}

	if ($options['hover_type_height']) {
		$classes[] = 'tcp-has-height';
	}

	if ($options['show_read_more'] == 1 && $options['image_type'] == 'on-hover' && $options['hover_type_height']) {
		$options['hover_type_height'] = max($options['hover_type_height'] - 30, 30);
	}

	if ($options['show_read_more'] == 0 && $options['show_description'] == 0 && $options['show_title'] == 1) {
		$classes[] = 'tcp-title-only';
	}

	if ($options['show_title'] == 0 && $options['show_description'] == 0 && $options['show_read_more'] == 1) {
		$classes[] = 'tcp-button-only';
	}

	$categories = $options['categories'] ? explode(',', $options['categories']) : array();
	$filterCats = count($categories);
	$isCategoryIds = $filterCats && is_numeric($categories[0]);

	if ($options['hover']) {
		$classes[] = tcp_prefix_classes($options['hover']);
	}

	$hover_animate = $options['hover_animation'] ? ' ' . $options['hover_animation'] : '';

	if ($options['convert']) {
		$classes[] = tcp_prefix_classes($options['convert']);
	}

	$dataOptions = array_intersect_key($options, array_flip(array('masonry_layout', 'sortable')));

	$output .= '<div class="' . esc_attr(tcp_sanitize_class($classes)) . '" data-options="' . esc_attr(wp_json_encode($dataOptions)) . '">';

	$query = array(
		'post_type' => $options['post_type'],
		'order' => $options['order'],
		'posts_per_page' => (int) $options['max'],
		'ignore_sticky_posts' => 1
	);

	if ($options['orderby'] == 'likes') {
		$query['orderby'] = 'meta_value_num';
		$query['meta_key'] = '_react_votes_count';
	} else {
		$query['orderby'] = $options['orderby'];
	}

	if($options['posts']) {
		$query['post__in'] = explode(',', $options['posts']);
	}

	if ($options['paging'] == '1') {
		$query['paged'] = tcp_get_paged_var();
	}

	if ($options['category__and']) {
		$query['category__and'] = explode(',', $options['category__and']);
	}

	if ($options['category__not_in']) {
		$query['category__not_in'] = explode(',', $options['category__not_in']);
	}

	if ($options['author']) {
		$query['author'] = $options['author'];
	}

	if ((int) $options['offset'] != 0) {
		$query['offset'] = (int) $options['offset'];
	}

	if ($filterCats) {
		$field = $isCategoryIds ? 'id' : 'slug';

		$query['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field' => $field,
				'terms' => $categories,
				'include_children' => $options['include_children'] == '1'
			)
		);
	}

	$items = new WP_Query($query);
	$index = 0;

	// Internal portfolio counter for unique image groups
	static $portfolioId = 0;
	$portfolioId++;

	$baseGroup = 'tcp-portfolio-' . $portfolioId;
	$sereneVideoBaseGroup = 'tcp-video-' . $portfolioId;
	$captions = array();
	$allTerms = array();

	if ($options['animation'] && function_exists('react_get_animation_data')) {
		$animationData = react_get_animation_data($options['animation'], $options['animation_delay'], $options['animation_offset']);
	}

	if ($items->have_posts()) {
		if ($options['sortable'] == '1') {
			$output .= '{{_TC_FILTER_}}'; // This is replaced later once we have the list of categories
		}

		$output .= '<div class="tcp-portfolio-items-offset-parent"><div class="tcp-portfolio-items tcp-clearfix">';
		$output .= '<div class="tcp-portfolio-item tcp-portfolio-item-sizer"></div>';

		$itemStyles = '';

		if ($options['grid'] != '1') {
			if (is_numeric($options['gap'])) {
				$itemStyles .= 'border-left-width: ' . $options['gap'] . 'px; border-right-width: ' . $options['gap'] . 'px;';
			}
			if (is_numeric($options['margin_bottom'])) {
				$itemStyles .= 'margin-bottom: ' . $options['margin_bottom'] . 'px';
			}
		}

		$titleTag = sanitize_key($options['title_tag']);

		$titleStyles = '';
		if ($options['title_min_height'] !== '') {
			if (is_numeric($options['title_min_height'])) {
				$options['title_min_height'] = $options['title_min_height'] . 'px';
			}
			$titleStyles .= ' style="min-height: ' . esc_attr($options['title_min_height']) . ';"';
		}

		$details_height = $options['image_type'] == 'on-hover' ? ' style="max-height: 70%;'. ($options['hover_type_height'] ? 'height: ' . absint($options['hover_type_height']) . 'px;' : '') . '"' : '';

		$descriptionStyles = '';
		if ($options['description_min_height'] !== '') {
			if (is_numeric($options['description_min_height'])) {
				$options['description_min_height'] = $options['description_min_height'] . 'px';
			}
			$descriptionStyles .= ' style="min-height: ' . esc_attr($options['description_min_height']) . ';"';
		}

		while ($items->have_posts()) {
			$index++;
			$items->the_post();

			$terms = get_the_terms(get_the_ID(), $taxonomy);
			$slugs = array();
			if (is_array($terms)) {
				foreach ($terms as $term) {
					$allTerms[$term->term_id] = $term;
					$slugs[] = esc_attr($term->slug);
				}
			}

			$itemType = tcp_get_post_meta(get_the_ID(), 'type', 'image');

			$itemClasses = array(
				'tcp-portfolio-item',
				tcp_prefix_classes('portfolio-item-type-' . $itemType),
				tcp_prefix_classes('portfolio-item-image-' . $options['image_type']),
				'tcp-clearfix'
			);

			if (tcp_has_featured_media()) {
				$itemClasses[] = 'portfolio-item-has-feat';
			}

			$thisHeight = $options['height'];

			if ($options['masonry_use_layout_options'] == '1') {
				// Masonry Column multiplier
				$cMultiplier = absint(tcp_get_post_meta(get_the_ID(), 'masonry_columns', 1));
				$cMultiplier = min($cMultiplier, $columns);
				if ($cMultiplier > 1) {
					$itemClasses[] = tcp_prefix_classes('portfolio-item-width-' . $cMultiplier);
				}

				// Masonry Row multiplier
				if ($options['height']) {
					$rMultiplier = absint(tcp_get_post_meta(get_the_ID(), 'masonry_rows', 1));
					if ($rMultiplier > 1) {
						$thisHeight *= $rMultiplier;
					}
				}
			}

			$output .= '<div class="' . esc_attr(tcp_sanitize_class($itemClasses)) . '"' . ($itemStyles ? ' style="' . esc_attr($itemStyles) .'"' : '') . ' data-id="' . esc_attr(get_the_ID()) . '" data-types="' . esc_attr(join(',', $slugs)) . '">';
			$output .= '<div class="tcp-portfolio-item-inner' . $hover_animate . ($options['animation'] ? ' has-animation' : '') . '"' . (isset($animationData) ? ' ' . $animationData : '') . '>';

			if ($options['show_image'] == '1') {
				if ($itemType == 'video_embed') {
					$videoOptions = array(
						'float_width' => $options['float_width'],
						'float_height' => $options['float_height']
					);
					if ($options['image_type'] != 'below') {
						$output .= tcp_get_featured_video(tcp_get_post_meta(get_the_ID(), 'video_embed'), $options['image_type'], $width, $thisHeight, $videoOptions);
					} else {
						$featuredImageOutput = tcp_get_featured_video(tcp_get_post_meta(get_the_ID(), 'video_embed'), $options['image_type'], $width, $thisHeight, $videoOptions);
					}
				} elseif (has_post_thumbnail()) {
					$thumbnailId = get_post_thumbnail_id();
					$imageOptions = array(
						'a' => array(
							'class' => array()
						),
						'like_image' => $options['like_image'] == '1',
						'like_image_icon' => $options['like_image_icon'],
						'float_width' => $options['float_width'],
						'float_height' => $options['float_height'],
					);

					$imageOptions['a']['data'][($options['type'] == 'serene' ? 'serene' : 'fancybox') . '-group'] = $baseGroup;

					switch ($itemType) {
						case 'image':
							$titleIcon = ' fa-image';
							$popupImage = tcp_get_post_meta(get_the_ID(), 'image');
							$imageOptions['a']['href'] = $popupImage ? tcp_get_upload_url($popupImage) : tcp_get_attachment_image_src($thumbnailId);
							$imageOptions['a']['class'][] = tcp_prefix_classes($options['type']);

							if ($title = tcp_get_post_meta(get_the_ID(), 'title') && $options['type'] == 'serene') {
								$imageOptions['a']['data']['title'] = $title;
							}

							$caption = tcp_get_post_meta(get_the_ID(), 'caption');
							if ($caption) {
								$captionId =  'portfolio-caption-' . $portfolioId . '-' . $index;
								$imageOptions['a']['data']['portfolio-caption'] = '#' . $captionId;
								$captions[$captionId] = $caption;
							}

							if ($options['type'] == 'serene') {
								$captionPosition = tcp_get_post_meta(get_the_ID(), 'caption_position');
								if ($captionPosition) {
									$imageOptions['a']['data']['portfolio-caption-position'] = $captionPosition;
								}
							}
							break;
						case 'video':
							$titleIcon = ' fa-film';
							$imageOptions['a']['href'] = tcp_get_post_meta(get_the_ID(), 'video', tcp_get_attachment_image_src($thumbnailId));
							$imageOptions['a']['data']['fancybox-width'] = (int) tcp_get_post_meta(get_the_ID(), 'video_width', tcp_get_option('video_width'));
							$imageOptions['a']['data']['fancybox-height'] = (int) tcp_get_post_meta(get_the_ID(), 'video_height', tcp_get_option('ideo_height'));
							$imageOptions['a']['class'][] = 'tcp-lightbox';
							if ($options['type'] == 'serene') {
								$imageOptions['a']['data']['fancybox-group'] = $sereneVideoBaseGroup;
							}
							break;
						case 'post':
							$titleIcon = ' fa-eye';
							$imageOptions['a']['href'] = get_permalink();
							unset($imageOptions['a']['class']);
							break;
						case 'link';
							$titleIcon = ' fa-link';
							$imageOptions['a']['href'] = tcp_get_post_meta(get_the_ID(), 'link');
							if ($linkTarget = tcp_get_post_meta(get_the_ID(), 'link_target')) {
								$imageOptions['a']['target'] = $linkTarget;
							}
							unset($imageOptions['a']['class']);
							break;
						case 'plain':
							$titleIcon = ' fa-image';
							unset($imageOptions['a']);
							break;
					}

					if ($options['image_type'] != 'below') {
						$output .= tcp_get_featured_image($options['image_type'], $width, $thisHeight, $imageOptions);
					} else {
						$featuredImageOutput = tcp_get_featured_image($options['image_type'], $width, $thisHeight, $imageOptions);
					}
				}
			}

			if ($options['full_description'] == '1') {
				global $more;
				$more = 0;
				$content = apply_filters('the_content', get_the_content(false));
				$content = str_replace(']]>', ']]&gt;', $content);
				$description = $content;
			} else {
				$description = do_shortcode(get_the_excerpt());
			}

			if ($options['show_title'] == '1' || ($options['show_description'] == '1' && $description !== '') || $options['show_read_more'] == '1' || ($options['image_type'] == 'below' && isset($featuredImageOutput))) {
				$output .= '<div' . $details_height . ' class="tcp-portfolio-details tcp-clearfix">';

				if ($options['show_title'] == '1') {
					$output .= '<' . $titleTag . ' class="tcp-portfolio-item-title"' . $titleStyles . '><span class="tcp-portfolio-title-inner">';
					if ($options['like_title'] == '1' && function_exists('react_get_post_like_html')) {
						$output .= react_get_post_like_html(get_the_ID(), $options['like_title_icon']);
					}

					$icon = $options['show_title_icon'] == '1' && isset($titleIcon) ? '<i class="' . esc_attr(tcp_sanitize_class('fa ' . $titleIcon)) . '"></i>' : '';

					if ($options['link_title'] == '1') {
						$titleLink = $itemType == 'link' ? tcp_get_post_meta(get_the_ID(), 'link') : get_permalink();
						$output .= '<a href="' . esc_url($titleLink) . '">' . $icon . get_the_title() . '</a>';
					} else {
						$output .= '<span class="tcp-portfolio-title-text">' . $icon . get_the_title() . '</span>';
					}
					$output .= '</span>';
					$output .= '</' . $titleTag . '>';
				}

				$output .= '<div class="tcp-entry-info">';

				if ($options['show_date'] == '1') {
					$output .= '<div class="tcp-date" title="' . esc_attr(get_the_date()) . '">';
					$output .= '<div class="tcp-day">' . esc_attr(get_the_date('j')) . '</div>';
					$output .= '<div class="tcp-month">' . esc_attr(get_the_date('M')) . '</div>';
					$output .= '</div>';
				}

				if ($options['like'] == '1' && function_exists('react_get_post_like_html')) {
					$output .= react_get_post_like_html(get_the_ID(), $options['like_icon']);
				}

				$output .= '</div>';

				if ($options['show_meta'] == '1') {
					$output .= '<div class="tcp-entry-meta">' . tcp_posted_on() . '</div>';
				}

				if ($options['image_type'] == 'below' && isset($featuredImageOutput)) {
					$output .= $featuredImageOutput;
				}

				if ($options['show_description'] == '1' && $description !== '') {
					$output .= '<div class="tcp-portfolio-item-description tcp-clearfix"' . $descriptionStyles . '>' . $description . '</div>';
				}

				if ($options['show_read_more'] == '1') {
					$options['read_more'] = $options['read_more'] ? $options['read_more'] : esc_html__('Read More', 'react-portfolio');
					$buttonLink = $itemType == 'link' ? tcp_get_post_meta(get_the_ID(), 'link') : get_permalink();
					if ($options['read_more_button_style'] == 'subtle-link') {
						$output .= '<div class="tcp-portfolio-read-more"><a ' . $buttonClass . ' href="' . esc_url($buttonLink) . '">' . esc_html($options['read_more']) . ' <i class="mix-ico icon-arrow-right"></i></a></div>';
					} else {
						$output .= '<div class="tcp-portfolio-read-more"><a ' . $buttonClass . ' href="' . esc_url($buttonLink) . '">' . esc_html($options['read_more']) . '</a></div>';
					}
				}

				$output .= '</div>'; // .tcp-portfolio-details
			}

			$output .= '</div></div>'; // .tcp-portfolio-item-inner .tcp-portfolio-item

		} // end while

		$output .= '</div></div>'; // .tcp-portfolio-items .tcp-portfolio-items-offset-parent

		if ($options['sortable'] == '1') {
			$filterClasses = array('tcp-portfolio-filter', 'tcp-clearfix');
			$filterStyles = '';

			if ($options['grid'] != '1') {
				if (is_numeric($options['gap'])) {
					$filterStyles .= 'padding-left: ' . $options['gap'] . 'px; padding-right: ' . $options['gap'] . 'px;';
				}
			}

			if ($options['sortable_position']) {
				$filterClasses[] = tcp_prefix_classes($options['sortable_position']);
			}

			$filterOutput = '<div class="' . esc_attr(tcp_sanitize_class($filterClasses)) . '"' . ($filterStyles ? ' style="' . esc_attr($filterStyles) .'"' : '') . '>';
			if ($options['sortable_show_all'] == '1') {
				$filterOutput .= '<span class="tcp-filter-button tcp-active-filter" data-filter="all"><span>' . esc_html($options['sortable_all_text']) . '</span></span>';
			}

			$terms = array();
			if ($filterCats) {
				foreach ($categories as $categoryIdOrSlug) {
					foreach ($allTerms as $allTerm) {
						if ($isCategoryIds && $allTerm->term_id == $categoryIdOrSlug) {
							$terms[$allTerm->term_id] = $allTerm;
						} elseif (!$isCategoryIds && $allTerm->slug == $categoryIdOrSlug) {
							$terms[$allTerm->term_id] = $allTerm;
						}
					}
				}
			} else {
				$terms = $allTerms;
			}

			reset($terms);
			$firstTermId = key($terms);
			foreach ($terms as $k => $term) {
				$extraClass = $k === $firstTermId && $options['sortable_show_all'] == '0' ? ' tcp-active-filter' : '';
				$filterOutput .= '<span class="' . esc_attr(tcp_sanitize_class('tcp-filter-button ' . $extraClass)) . '" data-filter="' . esc_attr($term->slug) . '"><span>' . esc_html($term->name) . '</span></span>';
			}
			$filterOutput .= '</div>';
			$output = str_replace('{{_TC_FILTER_}}', $filterOutput, $output);
		}

		if ($options['paging'] == '1' && function_exists('wp_pagenavi')) {
			$output .= wp_pagenavi(array(
				'query' => $items,
				'echo' => false
			));
		}

		if (count($captions)) {
			$output .= '<div class="tcp-portfolio-captions">';
			foreach ($captions as $captionId => $captionHtml) {
				$output .= '<div id="' . esc_attr($captionId) . '">' . $captionHtml . '</div>';
			}
			$output .= '</div>';
		}
	} else {
		$output .= '<div class="tcp-portfolio-empty">' . esc_html__('No portfolio items found.', 'react-portfolio') . '</div>';
	} // end have_posts()

	$output .= '</div>'; // .tcp-portfolio

	// Reset custom excerpt length
	if ($options['description_length']) {
		remove_filter('excerpt_length', array($excerptLength, 'getLength'));
	}

	remove_filter('excerpt_more', 'tcp_excerpt_more');

	wp_reset_postdata();

	return $output;
}
add_shortcode('portfolio', 'tcp_shortcode_portfolio');

function tcp_render_shortcode_portfolio_options()
{
	$portfolioCategories = tcp_get_all_category_options('portfolio_category');

	$config = array(
		'config' => array(
			'title' => esc_html__('Portfolio options', 'react-portfolio'),
			'shortcode' => 'portfolio',
			'type' => 'self-closing'
		),
		'options' => array(
			array(
				'name' => 'post_type',
				'label' => esc_html__('Post type', 'react-portfolio'),
				'description' => esc_html__('Choose the post type to display. Note: changing this option will regenerate the available Posts, Categories and Authors in the options below (so you will lose any selected options in those fields) and set some default values that are more appropriate for the chosen post type.', 'react-portfolio'),
				'type' => 'select',
				'default' => 'portfolio',
				'options' => array(
					'portfolio' => esc_html__('Portfolio', 'react-portfolio'),
					'post' => esc_html__('Post', 'react-portfolio')
				)
			),
			array(
				'name' => 'type',
				'label' => esc_html__('Type', 'react-portfolio'),
				'tooltip' => esc_html__('Method of displaying the enlarged image', 'react-portfolio'),
				'type' => 'select',
				'default' => 'lightbox',
				'options' => array(
					'lightbox' => esc_html__('Lightbox', 'react-portfolio') . ' (Fancybox)',
					'serene' => esc_html__('Full Screen', 'react-portfolio') . ' (Serene)'
				)
			),
			array(
				'name' => 'columns',
				'label' => esc_html__('Number of columns', 'react-portfolio'),
				'type' => 'select',
				'default' => '3',
				'options' => array(
					'1' => esc_html__('One Column', 'react-portfolio'),
					'2' => esc_html__('Two Columns', 'react-portfolio'),
					'3' => esc_html__('Three Columns', 'react-portfolio'),
					'4' => esc_html__('Four Columns', 'react-portfolio'),
					'5' => esc_html__('Five Columns', 'react-portfolio'),
					'6' => esc_html__('Six Columns (Masonry only)', 'react-portfolio'),
					'7' => esc_html__('Seven Columns (Masonry only)', 'react-portfolio'),
					'8' => esc_html__('Eight Columns (Masonry only)', 'react-portfolio'),
					'9' => esc_html__('Nine Columns (Masonry only)', 'react-portfolio'),
					'10' => esc_html__('Ten Columns (Masonry only)', 'react-portfolio')
				)
			),
			array(
				'name' => 'convert',
				'label' => esc_html__('Convert to full width', 'react-portfolio'),
				'tooltip' => esc_html__('At which screen size should the column layout adjust to full width', 'react-portfolio'),
				'type' => 'select',
				'default' => 'units-tablet-50 phone-width-100',
				'options' => array(
					'none' => esc_html__('None', 'react-portfolio'),
					'phone-width-100' => esc_html__('Phone 1 column', 'react-portfolio'),
					'units-phone-50' => esc_html__('Phone 2 columns', 'react-portfolio'),
					'mobile-width-100' => esc_html__('Tablet and phone 1 column', 'react-portfolio'),
					'units-mobile-50' => esc_html__('Tablet and phone 2 columns', 'react-portfolio'),
					'units-tablet-50 phone-width-100' => esc_html__('Tablet 2 columns, phone 1 column', 'react-portfolio')
				)
			),
			array(
				'name' => 'posts',
				'label' => esc_html__('Posts', 'react-portfolio'),
				'description' => esc_html__('Shows only these specific posts', 'react-portfolio'),
				'type' => 'multiselect',
				'default' => '',
				'options' => tcp_get_all_post_options('portfolio'),
				'class' => 'tcap-chosen-multi'
			),
			array(
				'name' => 'categories',
				'label' => esc_html__('Categories', 'react-portfolio'),
				'tooltip' => esc_html__('Select one or multiple', 'react-portfolio'),
				'type' => 'multiselect',
				'default' => '',
				'options' => $portfolioCategories,
				'class' => 'tcap-chosen-multi'
			),
			array(
				'name' => 'category__and',
				'label' => esc_html__('All categories', 'react-portfolio'),
				'tooltip' => esc_html__('Select one or multiple', 'react-portfolio'),
				'description' => esc_html__('Shows only posts that are in all of these categories', 'react-portfolio'),
				'type' => 'multiselect',
				'default' => '',
				'options' => $portfolioCategories,
				'class' => 'tcap-chosen-multi'
			),
			array(
				'name' => 'category__not_in',
				'label' => esc_html__('Exclude categories', 'react-portfolio'),
				'tooltip' => esc_html__('Select one or multiple', 'react-portfolio'),
				'description' => esc_html__('Do not show posts in these categories', 'react-portfolio'),
				'type' => 'multiselect',
				'default' => '',
				'options' => $portfolioCategories,
				'class' => 'tcap-chosen-multi'
			),
			array(
				'name' => 'include_children',
				'label' => esc_html__('Include children', 'react-portfolio'),
				'description' => esc_html__('When using categories, choose whether to also include items in child categories', 'react-portfolio'),
				'type' => 'toggle',
				'toggle' => 'yn',
				'default' => '1'
			),
			array(
				'name' => 'author',
				'label' => esc_html__('Authors', 'react-portfolio'),
				'tooltip' => esc_html__('Select one or multiple', 'react-portfolio'),
				'description' => esc_html__('Shows only posts by these authors', 'react-portfolio'),
				'type' => 'multiselect',
				'default' => '',
				'options' => tcp_get_all_author_options('portfolio'),
				'class' => 'tcap-chosen-multi'
			),
			array(
				'name' => 'masonry_layout',
				'label' => esc_html__('Masonry layout', 'react-portfolio'),
				'description' => esc_html__('Choose how the items should be displayed in the masonry layout, see the tooltip for more information.', 'react-portfolio'),
				'tooltip' => esc_html__('The "Masonry" layout will arrange items in a vertically cascading grid, filling empty space. The "Fit Rows" layout will arrange the items in rows of the same height.', 'react-portfolio'),
				'type' => 'select',
				'default' => 'masonry',
				'options' => array(
					'masonry' => esc_html__('Masonry', 'react-portfolio'),
					'fitRows' => esc_html__('Fit Rows', 'react-portfolio')
				)
			),
			array(
				'name' => 'masonry_use_layout_options',
				'label' => esc_html__('Masonry use layout options', 'react-portfolio'),
				'description' => esc_html__('Use the options in each portfolio item metabox settings to allow having some items larger than others.', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'sortable',
				'label' => esc_html__('Sortable', 'react-portfolio'),
				'description' => esc_html__('Make the portfolio items sortable by category.', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '1'
			),
			array(
				'name' => 'sortable_position',
				'label' => esc_html__('Sortable label alignment', 'react-portfolio'),
				'description' => esc_html__('Choose where to show the sortable button labels', 'react-portfolio'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Auto', 'react-portfolio'),
					'textleft' => esc_html__('Left', 'react-portfolio'),
					'textright' => esc_html__('Right', 'react-portfolio'),
					'textcenter' => esc_html__('Center', 'react-portfolio')
				)
			),
			array(
				'name' => 'sortable_show_all',
				'label' => esc_html__('Show "All" filter button', 'react-portfolio'),
				'description' => esc_html__('Show the "All" filter button', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '1'
			),
			array(
				'name' => 'sortable_all_text',
				'label' => esc_html__('"All" filter button text', 'react-portfolio'),
				'type' => 'text',
				'default' => esc_html__('All', 'react-portfolio')
			),
			array(
				'name' => 'show_image',
				'label' => esc_html__('Show image', 'react-portfolio'),
				'description' => esc_html__('Show the featured image or video', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '1',
				'toggle' => 'yn'
			),
			array(
				'name' => 'height',
				'label' => esc_html__('Image height', 'react-portfolio'),
				'description' => esc_html__('Set the image height in pixels, if set to 0 it will be scaled automatically', 'react-portfolio'),
				'type' => 'number',
				'default' => '0',
				'class' => 'tcap-width-60',
				'unit' => 'px'
			),
			array(
				'name' => 'grid',
				'label' => esc_html__('Grid', 'react-portfolio'),
				'description' => esc_html__('No border, gaps or margin will be used', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'image_type',
				'label' => esc_html__('Image type', 'react-portfolio'),
				'tooltip' => esc_html__('Select the image positioning', 'react-portfolio'),
				'description' => esc_html__('Choose how the image is displayed.', 'react-portfolio'),
				'type' => 'select',
				'default' => 'above',
				'options' => array(
					'above' => esc_html__('Above title (full width)', 'react-portfolio'),
					'below' => esc_html__('Below title (full width)', 'react-portfolio'),
					'left' => esc_html__('Float left', 'react-portfolio'),
					'right' => esc_html__('Float right', 'react-portfolio'),
					'on-hover' => esc_html__('Content shown over image', 'react-portfolio')
				)
			),
			array(
				'name' => 'content_on_hover',
				'label' => esc_html__('Show on hover', 'react-portfolio'),
				'tooltip' => esc_html__('Show details on hover or always', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '1'
			),
			array(
				'name' => 'gap',
				'label' => esc_html__('Column gap', 'react-portfolio'),
				'description' => esc_html__('The gap is set on both sides of the portfolio item so the actual visible gap between columns will be 2 times this number.  If left blank it will be set at an appropriate amount to fit the other settings.', 'react-portfolio'),
				'type' => 'number',
				'default' => '',
				'class' => 'tcap-width-50',
				'unit' => 'px'
			),
			array(
				'name' => 'margin_bottom',
				'label' => esc_html__('Margin bottom', 'react-portfolio'),
				'description' => esc_html__('The margin at the bottom of each portfolio item. If left blank it will be set at an appropriate amount to fit the other settings.', 'react-portfolio'),
				'type' => 'number',
				'default' => '',
				'class' => 'tcap-width-50',
				'unit' => 'px'
			),
			array(
				'name' => 'hover_type_height',
				'label' => esc_html__('Information area height', 'react-portfolio'),
				'tooltip' => esc_html__('Select the height', 'react-portfolio'),
				'description' => esc_html__('Set the height of the portfolio item description area, when Image type is set to show content on hover.', 'react-portfolio'),
				'type' => 'number',
				'unit' => 'px',
				'class' => 'tcap-width-50',
				'default' => ''
			),
			array(
				'name' => 'float_width',
				'label' => esc_html__('Float image width', 'react-portfolio'),
				'description' => esc_html__("If 'Image type' is set to Float left or right, this will set the image width.", 'react-portfolio'),
				'type' => 'slider',
				'slider' => array('from' => 10, 'to' => 1000, 'step' => 1, 'dimension' => 'px'),
				'default' => '150'
			),
			array(
				'name' => 'float_height',
				'label' => esc_html__('Float image height', 'react-portfolio'),
				'description' => esc_html__("If 'Image type' is set to Float left or right, this will set the image height. If set to 0 the height will be automatically scaled from the image dimensions.", 'react-portfolio'),
				'type' => 'slider',
				'slider' => array('from' => 0, 'to' => 1000, 'step' => 1, 'dimension' => 'px'),
				'default' => '0'
			),
			tcp_get_hover_animation_options(),
			tcp_get_extended_animation_options(),
			array(
				'name' => 'boxed',
				'label' => esc_html__('Boxed style', 'react-portfolio'),
				'tooltip' => esc_html__('Display a box around items', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'text_align',
				'label' => esc_html__('Text alignment', 'react-portfolio'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Inherit', 'react-portfolio'),
					'textleft' => esc_html__('Left', 'react-portfolio'),
					'textcenter' => esc_html__('Center', 'react-portfolio'),
					'textright' => esc_html__('Right', 'react-portfolio')
				)
			),
			array(
				'name' => 'show_border',
				'label' => esc_html__('Show border?', 'react-portfolio'),
				'tooltip' => esc_html__('Display image with bottom border effect', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'hover',
				'label' => esc_html__('Hover size', 'react-portfolio'),
				'tooltip' => esc_html__('The size of the hover icon, if "Auto" is chosen it will be set at an appropriate size to fit the other settings', 'react-portfolio'),
				'type' => 'select',
				'default' => 'med-hvr',
				'options' => array(
					'' => esc_html__('Auto', 'react-portfolio'),
					'tiny-hvr' => esc_html__('Tiny', 'react-portfolio'),
					'sml-hvr' => esc_html__('Small', 'react-portfolio'),
					'med-hvr' => esc_html__('Medium', 'react-portfolio'),
					'lrg-hvr' => esc_html__('Large', 'react-portfolio')
				)
			),
			array(
				'name' => 'paging',
				'label' => esc_html__('Paging', 'react-portfolio'),
				'description' => esc_html__('Portfolio items will be spread over multiple pages. Note: this option requires the WP-PageNavi plugin to be active, and the "Rewrite slug" option on the Portfolio &rarr; Settings page should not be the same slug as one of your pages.', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'max',
				'label' => esc_html__('Number of items', 'react-portfolio'),
				'description' => esc_html__('Number of portfolio items to show, or items per page if paging is on, -1 to show all', 'react-portfolio'),
				'type' => 'text',
				'default' => -1,
				'class' => 'tcap-width-50'
			),
			array(
				'name' => 'orderby',
				'label' => esc_html__('Order by', 'react-portfolio'),
				'type' => 'select',
				'default' => 'menu_order',
				'options' => array(
					'none' => esc_html__('None', 'react-portfolio'),
					'ID' => esc_html__('ID', 'react-portfolio'),
					'author' => esc_html__('Author', 'react-portfolio'),
					'title' => esc_html__('Title', 'react-portfolio'),
					'date' => esc_html__('Date', 'react-portfolio'),
					'modified' => esc_html__('Modified', 'react-portfolio'),
					'parent' => esc_html__('Parent', 'react-portfolio'),
					'rand' => esc_html__('Random', 'react-portfolio'),
					'comment_count' => esc_html__('Comment Count', 'react-portfolio'),
					'menu_order' => esc_html__('Menu Order', 'react-portfolio'),
					'likes' => esc_html__('Likes (will only show posts with at least 1 like)', 'react-portfolio')
				)
			),
			array(
				'name' => 'order',
				'label' => esc_html__('Order', 'react-portfolio'),
				'type' => 'select',
				'default' => 'ASC',
				'options' => array(
					'ASC' => 'ASC',
					'DESC' => 'DESC'
				)
			),
			array(
				'name' => 'offset',
				'label' => esc_html__('Offset', 'react-portfolio'),
				'description' => esc_html__('Number of posts to displace or pass over', 'react-portfolio'),
				'type' => 'text',
				'class' => 'tcap-width-50'
			),
			array(
				'name' => 'show_title',
				'label' => esc_html__('Show title', 'react-portfolio'),
				'description' => esc_html__('Show the title of the portfolio item', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '1',
				'toggle' => 'yn'
			),
			array(
				'name' => 'title_tag',
				'label' => esc_html__('Tag', 'react-portfolio'),
				'tooltip' => esc_html__('Choose which HTML tag to use for the title', 'react-portfolio'),
				'type' => 'select',
				'default' => 'h2',
				'options' => tcp_get_header_tag_options()
			),
			array(
				'name' => 'title_min_height',
				'label' => esc_html__('Title min-height', 'react-portfolio'),
				'description' => esc_html__('Site the title CSS min-height property to help with equal vertical alignment', 'react-portfolio'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcap-width-75'
			),
			array(
				'name' => 'link_title',
				'label' => esc_html__('Link title', 'react-portfolio'),
				'description' => esc_html__('Link the portfolio title to the portfolio item page', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '1',
				'toggle' => 'yn'
			),
			tcp_get_show_title_icon_option(),
			array(
				'name' => 'show_meta',
				'label' => esc_html__('Show post meta', 'react-portfolio'),
				'description' => esc_html__('Show the post meta data (author, date etc)', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'show_date',
				'label' => esc_html__('Show date', 'react-portfolio'),
				'description' => esc_html__('Show the post date', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '0',
				'toggle' => 'yn'
			),
			array(
				'name' => 'alt_date_like_layout',
				'label' => esc_html__('Alternative date and like position', 'react-portfolio'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('On the right (default)', 'react-portfolio'),
					'date-like-left' => esc_html__('On the left', 'react-portfolio'),
					'date-like-above' => esc_html__('Date and like above', 'react-portfolio')
				)
			),
			array(
				'name' => 'image_details_on_hover',
				'label' => esc_html__('Show image details on hover', 'react-portfolio'),
				'description' => esc_html__('Shows date and like boxes only when the item is hovered, except on touch devices.', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '1',
				'toggle' => 'yn'
			),
			array(
				'name' => 'show_description',
				'label' => esc_html__('Show description', 'react-portfolio'),
				'description' => esc_html__('Show the portfolio item description (excerpt)', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '1',
				'toggle' => 'yn'
			),
			array(
				'name' => 'description_min_height',
				'label' => esc_html__('Description min-height', 'react-portfolio'),
				'description' => esc_html__('Site the description CSS min-height property to help with equal vertical alignment', 'react-portfolio'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcap-width-75'
			),
			array(
				'name' => 'description_length',
				'label' => esc_html__('Description excerpt length', 'react-portfolio'),
				'description' => esc_html__('The number of words in the description excerpt, leave blank to use the default', 'react-portfolio'),
				'type' => 'text',
				'default' => '',
				'class' => 'tcap-width-50'
			),
			array(
				'name' => 'full_description',
				'label' => esc_html__('Full description', 'react-portfolio'),
				'description' => esc_html__('When enabled, the full post content will be shown, otherwise the excerpt will be shown', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '0'
			),
			array(
				'name' => 'show_read_more',
				'label' => esc_html__('Show "Read More" button', 'react-portfolio'),
				'type' => 'toggle',
				'default' => '1',
				'toggle' => 'yn'
			),
			array(
				'name' => 'read_more_button_style',
				'label' => esc_html__('Button style', 'react-portfolio'),
				'type' => 'select',
				'default' => 'basic-button',
				'options' => array(
					'basic-button' => esc_html__('Button (default)', 'react-portfolio'),
					'basic-button full' => esc_html__('Button fullwidth', 'react-portfolio'),
					'subtle-link' => esc_html__('Basic link', 'react-portfolio')
				)
			),
			array(
				'name' => 'read_more',
				'label' => esc_html__('"Read More" button text', 'react-portfolio'),
				'description' => esc_html__('Leave blank to use the default', 'react-portfolio'),
				'type' => 'text',
				'default' => ''
			),
			tcp_get_like_options(
				'like',
				'like_icon',
				__('"Like" button', 'react-portfolio'),
				__('Adds a like button to each item', 'react-portfolio')
			),
			tcp_get_like_options(
				'like_image',
				'like_image_icon',
				__('Image "Like" button', 'react-portfolio'),
				 esc_html__('Adds a like button to each image', 'react-portfolio')
			 ),
			tcp_get_like_options(
				'like_title',
				'like_title_icon',
				__('Title "Like" button', 'react-portfolio'),
				__('Adds a like button to each title', 'react-portfolio')
			)
		)
	);

	$generator = new TcpShortcodeOptionsGenerator($config['config'], $config['options']);
	$generator->render();
}

/**
 * Get the config for the extended animation options
 *
 * @param   string  $key               The name of the animation option
 * @param   string  $defaultAnimation  The default animation
 * @return  array
 */
function tcp_get_extended_animation_options($key = 'animation', $defaultAnimation = '')
{
	if (function_exists('react_get_animation_options')) {
		$options = array(
			'type' => 'multiple',
			'label' => esc_html__('Animation', 'react-portfolio'),
			'tooltip' => esc_html__('Add a subtle animation when the item comes into view', 'react-portfolio'),
			'elements' => array(
				array(
					'name' => $key,
					'label' => esc_html__('Animation', 'react-portfolio'),
					'type' => 'select',
					'default' => $defaultAnimation,
					'options' => react_get_animation_options(),
					'inline' => true
				),
				array(
					'name' => $key . '_delay',
					'label' => esc_html__('Delay', 'react-portfolio'),
					'tooltip' => esc_html__('The animation will not start until this number of milliseconds after the element comes into view (1000 milliseconds = 1 second)', 'react-portfolio'),
					'type' => 'number',
					'unit' => 'ms',
					'default' => '',
					'class' => 'tcap-width-50',
					'inline' => true
				),
				array(
					'name' => $key . '_offset',
					'label' => esc_html__('Offset', 'react-portfolio'),
					'tooltip' => esc_html__('If the number is positive, the animation will start when the element is this number of pixels below the viewport. If the number is negative, the animation will not start until the element is this number of pixels inside the viewport.', 'react-portfolio'),
					'type' => 'number',
					'unit' => 'ms',
					'default' => '',
					'class' => 'tcap-width-50',
					'inline' => true
				)
			)
		);
	} else {
		$options = array(
			'type' => 'multiple',
			'label' => esc_html__('Animation', 'react-portfolio'),
			'tooltip' => esc_html__('Add a subtle animation when the item comes into view', 'react-portfolio'),
			'elements' => array(
				array(
					'name' => $key,
					'type' => 'unavailable',
					'default' => $defaultAnimation,
					'inline' => true
				),
				array(
					'name' => $key . '_delay',
					'type' => 'hidden',
					'inline' => true
				),
				array(
					'name' => $key . '_offset',
					'type' => 'hidden',
					'inline' => true
				)
			)
		);
	}

	return $options;
}

/**
 * Get the hover animation options
 *
 * @return array
 */
function tcp_get_hover_animation_options()
{
	if (function_exists('react_get_hover_animation_options')) {
		$options = array(
			'name' => 'hover_animation',
			'label' => esc_html__('Hover animation', 'react-portfolio'),
			'tooltip' => esc_html__('Add a subtle animation when the item is hovered', 'react-portfolio'),
			'type' => 'select',
			'default' => '',
			'options' => react_get_hover_animation_options(),
		);
	} else {
		$options = array(
			'name' => 'hover_animation',
			'label' => esc_html__('Hover animation', 'react-portfolio'),
			'tooltip' => esc_html__('Add a subtle animation when the item is hovered', 'react-portfolio'),
			'type' => 'unavailable',
			'default' => ''
		);
	}

	return $options;
}

/**
 * Get the like options
 *
 * @param   string  $key          Toggle option key
 * @param   string  $iconKey      Icon option key
 * @param   string  $label        Option label
 * @param   string  $description  Option description
 * @return  array
 */
function tcp_get_like_options($key, $iconKey, $label, $description)
{
	if (function_exists('react_get_post_like_html')) {
		$options = array(
			'type' => 'multiple',
			'label' => $label,
			'description' => $description,
			'elements' => array(
				array(
					'name' => $key,
					'label' => esc_html__('Show / hide', 'react-portfolio'),
					'type' => 'toggle',
					'default' => '0',
					'inline' => true
				),
				array(
					'name' => $iconKey,
					'label' => esc_html__('Icon', 'react-portfolio'),
					'type' => 'select',
					'default' => 'fa-thumbs-up',
					'options' => array(
						'fa-thumbs-up' => esc_html__('Thumbs up', 'react-portfolio'),
						'fa-heart' => esc_html__('Heart', 'react-portfolio')
					),
					'inline' => true
				)
			)
		);
	} else {
		$options = array(
			'type' => 'multiple',
			'label' => $label,
			'description' => $description,
			'elements' => array(
				array(
					'name' => $key,
					'type' => 'unavailable',
					'default' => '0',
					'inline' => true
				),
				array(
					'name' => $iconKey,
					'type' => 'hidden',
					'default' => 'fa-thumbs-up',
					'inline' => true
				)
			)
		);
	}

	return $options;
}

/**
 * Get the show title icon option
 *
 * Conditionally displayed if React is active
 *
 * @return array
 */
function tcp_get_show_title_icon_option()
{
	if (function_exists('react_get_icons')) {
		$options = array(
			'name' => 'show_title_icon',
			'label' => esc_html__('Show icon', 'react-portfolio'),
			'tooltip' => esc_html__('Display the meta icon next to the title', 'react-portfolio'),
			'type' => 'toggle',
			'default' => '0'
		);
	} else {
		$options = array(
			'name' => 'show_title_icon',
			'label' => esc_html__('Show icon', 'react-portfolio'),
			'tooltip' => esc_html__('Display the meta icon next to the title', 'react-portfolio'),
			'type' => 'unavailable',
			'default' => '0'
		);
	}

	return $options;
}