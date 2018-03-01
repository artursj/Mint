<?php
/**
 * The template for displaying content in the single.php template. Displaying the single post of all post formats.
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php echo react_get_post_featured_image(); ?>

	<?php if (react_get_option('blog_show_title_single')) : ?>
		<?php the_title('<h2 class="post-title-above-content">', '</h2>'); ?>
	<?php endif; ?>
	<?php if (react_get_option('blog_show_meta_above_content')) : ?>
		<?php echo react_entry_meta('entry-meta-above'); ?>
	<?php endif; ?>

	<div class="entry-content clearfix">
		<?php
			the_content();
			react_link_pages();
		?>
	</div>

	<?php edit_post_link('<i class="fa fa-pencil"></i> ' . esc_html__('Edit', 'react'), '<span class="edit-link">', '</span>'); ?>

	<?php
		if (react_get_option('blog_show_share')) {
			react_share();
		}
	?>

	<?php if (! react_get_option('blog_show_meta_above_content')) : ?>
	<div class="entry-meta clearfix">
		<?php echo react_cats_tags_list(); ?>
	</div>
	<?php endif; ?>

</div>