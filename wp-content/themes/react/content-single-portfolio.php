<?php
/**
 * The template for displaying content in the single-portfolio.php template. Displaying the content of a single portfolio item.
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>

<?php echo react_get_post_featured_image(); ?>

<?php if (react_get_option('portfolio_show_title_single')) : ?>
	<?php the_title('<h2 class="post-title-above-content">', '</h2>'); ?>
<?php endif; ?>

<?php if (is_array($info = react_get_current_post_meta('information')) && count($info)) : ?>

	<div class="portfolio-content-info-wrap clearfix">

		<div class="portfolio-info-wrap clearfix">

			<?php foreach ($info as $inf) : ?>

				<div class="portfolio-info custom-boxed-item">

					<?php if (strlen($inf['title'])) : ?>
						<h3 class="portfolio-info-title"><?php echo esc_html($inf['title']); ?></h3>
					<?php endif; ?>

					<?php if (strlen($inf['value'])) : ?>
						<div class="portfolio-info-value">
							<?php echo do_shortcode($inf['value']); ?>
						</div>
					<?php endif; ?>

				</div>

			<?php endforeach; ?>

		</div>

		<div class="entry-content clearfix">
			<?php
				the_content();
				react_link_pages();
			?>
		</div>

	</div>

	<?php edit_post_link('<i class="fa fa-pencil"></i> ' . esc_html__('Edit', 'react'), '<span class="edit-link">', '</span>'); ?>

<?php else : ?>

	<div class="entry-content clearfix">
		<?php
			the_content();
			react_link_pages();
		?>
	</div>

	<?php edit_post_link('<i class="fa fa-pencil"></i> ' . esc_html__('Edit', 'react'), '<span class="edit-link">', '</span>'); ?>

<?php endif; ?>

<?php
	if (react_get_option('portfolio_show_share')) {
		react_share();
	}
?>

<div class="entry-meta clearfix">
	<?php echo react_cats_tags_list(); ?>
</div>
