<?php
/**
 * The template for displaying search results
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post();  ?>

		<?php get_template_part('content', get_post_format($post)); ?>

	<?php endwhile; ?>

	<?php react_content_nav('content-nav-below'); ?>

<?php else : ?>

	<div class="search-info"><div class="search-info-inner"><?php echo esc_html(react_get_translation('no_posts_found', esc_html__('Sorry, no posts matched your criteria. Try another search?', 'react'))); ?></div></div>
	<div class="units-row phone-width-100 search-page-row">
		<div class="unit-40">
			<form method="get" class="searchform" action="<?php echo esc_url(home_url()); ?>">
				<label><?php echo esc_html(react_get_translation('try_another_search', esc_html__('Try another search', 'react'))); ?></label>
				<input type="text" class="field" name="s" value="<?php echo esc_attr(get_search_query(false)); ?>" />
				<input type="submit" class="submit searchsubmit" value="<?php echo esc_attr(react_get_translation('search', esc_attr__('Search', 'react'))); ?>" />
			</form>
		</div>
		<?php if (react_get_option('search_tag_cloud')) : ?>
			<div class="unit-60">
				<div class="tag-cloud search-cloud clearfix">
					<?php wp_tag_cloud(array(
						'largest' => 13,
						'smallest' => 13,
						'unit' => 'px',
						'format' => 'list'
					)); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>

<?php endif; ?>

<?php get_footer(); ?>