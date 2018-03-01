<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Related posts widget
 */
class TCW_Widget_Related extends WP_Widget
{
	/**
	 * The default widget options
	 * @var array
	 */
	protected $defaults;

	public function __construct()
	{
		$this->defaults = array(
			'title' => sanitize_text_field(esc_html__('Related Posts', 'react-widgets')),
			'count' => 5,
			'show_thumbnail' => true,
			'show_information' => 'date',
			'description_length' => 70,
			'categories' => array(),
			'related_by' => 'tags'
		);

		$widget_ops = array('classname' => 'tcw-widget-related', 'description' => esc_html__('Posts related to the one being currently viewed.', 'react-widgets'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('tcw-widget-related', 'React - ' . esc_html__('Related Posts', 'react-widgets'), $widget_ops, $control_ops);
	}

	public function widget($args, $instance)
	{
		$post = get_queried_object();

		if ( ! ($post instanceof WP_Post) || ! isset($post->ID, $post->post_type) || $post->post_type == 'page') {
			return;
		}

		$instance = wp_parse_args((array) $instance, $this->defaults);

		// WPML integration
		if (function_exists('icl_t')) {
			$instance['title'] = icl_t('React Widgets', 'Related Posts Title - '  . $this->id, $instance['title']);
		}

		$instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		$instance['show_information'] = $instance['show_information'] == 'both' ? array('date', 'description') : array($instance['show_information']);

		$query = array(
			'post__not_in' => array($post->ID),
			'posts_per_page' => $instance['count'],
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1
		);

		if (is_array($instance['categories']) && count($instance['categories'])) {
			$query['cat'] = join(',', $instance['categories']);
		}

		if ($instance['related_by'] == 'categories') {
			$categories = wp_get_post_categories($post->ID);
			$categoryIds = array();

			if (is_array($categories) && count($categories)) {
				foreach ($categories as $category) {
					$categoryIds[] = $category;
				}

				$query['category__in'] = $categoryIds;
			}
		} elseif ($instance['related_by'] == 'tags') {
			$tags = wp_get_post_tags($post->ID);
			$tagIds = array();

			if (is_array($tags) && count($tags)) {
				foreach ($tags as $tag) {
					$tagIds[] = $tag->term_id;
				}

				$query['tag__in'] = $tagIds;
			}
		}

		if (isset($query['category__in']) || isset($query['tag__in'])) {
			$items = new WP_Query($query);
			if ($items->have_posts()) :

				echo $args['before_widget'];

				if (!empty($instance['title'])) {
					echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
				}
				?>
				<div class="tcw-widget-related-inner">
					<?php while ($items->have_posts()) : $items->the_post(); ?>
						<div class="tcw-widget-post tcw-clearfix">
							<?php if ($instance['show_thumbnail'] && has_post_thumbnail()) : ?>
								<div class="tcw-widget-post-thumb">
									<a class="tcw-widget-post-thumb-link" href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail(array(80, 80), array('title' => get_the_title(), 'alt' => get_the_title())); ?>
									</a>
								</div>
							<?php endif; ?>
							<div class="tcw-widget-post-info">
								<h4><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h4>
								<?php if (in_array('date', $instance['show_information'])) : ?>
									<div class="tcw-widget-post-date">
										<?php echo esc_html(get_the_date()); ?>
									</div>
								<?php endif; ?>
								<?php if (in_array('description', $instance['show_information']) && get_the_excerpt()) : ?>
									<p class="tcw-widget-post-description">
										<?php echo esc_html(wp_html_excerpt(get_the_excerpt(), $instance['description_length'], '...')); ?>
									</p>
								<?php endif; ?>
							</div>
						</div>
					<?php endwhile; // have_posts() ?>
				</div>
				<?php
				echo $args['after_widget'];

			endif; // have_posts()

			wp_reset_postdata();
		} // post has category or tag
	}

	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['count'] = absint($new_instance['count']);
		$instance['show_thumbnail'] = isset($new_instance['show_thumbnail']);
		$instance['show_information'] = sanitize_text_field($new_instance['show_information']);
		$instance['description_length'] = is_numeric($new_instance['description_length']) && $new_instance['description_length'] > 0 ? absint($new_instance['description_length']) : '';
		$instance['categories'] = isset($new_instance['categories']) && is_array($new_instance['categories']) ? array_map('absint', $new_instance['categories']) : array();
		$instance['related_by'] = sanitize_text_field($new_instance['related_by']);

		// WPML integration
		if (function_exists('icl_register_string')) {
			icl_register_string('React Widgets', 'Related Posts Title - ' . $this->id, $instance['title']);
		}

		return $instance;
	}

	public function form($instance)
	{
		$instance = wp_parse_args((array) $instance, $this->defaults);
		?>
		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-300" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e('Number of posts', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-50" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($instance['count']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('show_thumbnail')); ?>"><?php esc_html_e('Show thumbnail', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input id="<?php echo esc_attr($this->get_field_id('show_thumbnail')); ?>" name="<?php echo esc_attr($this->get_field_name('show_thumbnail')); ?>" type="checkbox" <?php checked($instance['show_thumbnail'], true); ?> value="1" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('show_information')); ?>"><?php esc_html_e('Extra information', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<select id="<?php echo esc_attr($this->get_field_id('show_information')); ?>" name="<?php echo esc_attr($this->get_field_name('show_information')); ?>">
					<option value="date" <?php selected($instance['show_information'], 'date'); ?>><?php esc_html_e('Date', 'react-widgets'); ?></option>
					<option value="description" <?php selected($instance['show_information'], 'description'); ?>><?php esc_html_e('Description', 'react-widgets'); ?></option>
					<option value="both" <?php selected($instance['show_information'], 'both'); ?>><?php esc_html_e('Date and description', 'react-widgets'); ?></option>
				</select>
				<p class="tcw-widgetfield-description"><?php esc_html_e('Other post information to display.', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('description_length')); ?>"><?php esc_html_e('Description length', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-50" id="<?php echo esc_attr($this->get_field_id('description_length')); ?>" name="<?php echo esc_attr($this->get_field_name('description_length')); ?>" type="text" value="<?php echo esc_attr($instance['description_length']); ?>" />
				<p class="tcw-widgetfield-description"><?php esc_html_e('Limit the post description to this number of characters.', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Categories', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>[]" multiple="multiple">
					<?php foreach (tcw_get_all_category_options() as $categoryId => $categoryName) : ?>
						<option value="<?php echo absint($categoryId); ?>" <?php selected(in_array($categoryId, $instance['categories']), true); ?>><?php echo esc_html($categoryName); ?></option>
					<?php endforeach; ?>
				</select>
				<p class="tcw-widgetfield-description"><?php esc_html_e('Show only posts from these categories.', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('related_by')); ?>"><?php esc_html_e('Related by', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<select id="<?php echo esc_attr($this->get_field_id('related_by')); ?>" name="<?php echo esc_attr($this->get_field_name('related_by')); ?>">
					<option value="tags" <?php selected($instance['related_by'], 'date'); ?>><?php esc_html_e('Tags', 'react-widgets'); ?></option>
					<option value="categories" <?php selected($instance['related_by'], 'categories'); ?>><?php esc_html_e('Categories', 'react-widgets'); ?></option>
				</select>
				<p class="tcw-widgetfield-description"><?php esc_html_e('How related posts should be found.', 'react-widgets'); ?></p>
			</div>
		</div>
		<?php
	}
}
