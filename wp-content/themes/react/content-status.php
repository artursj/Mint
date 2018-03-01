<?php
/**
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

$featuredImageType = react_get_post_featured_image_type();
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if ($featuredImageType != 'below') {
		echo react_get_post_featured_image($featuredImageType);
	}
	?>

	<?php the_title(sprintf('<h2 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h2>'); ?>

	<?php echo react_get_post_info(); ?>
	<div class="entry-meta">
		<?php echo react_posted_on(); ?>
	</div>

	<?php
	if ($featuredImageType == 'below') {
		echo react_get_post_featured_image($featuredImageType);
	}
	?>

	<div class="entry-content clearfix">
		<?php if (is_search()) : ?>
			<?php the_excerpt(); ?>
		<?php else : ?>
			<div class="avatar"><?php echo get_avatar(get_the_author_meta('ID'), apply_filters('react_status_avatar_size', 65)); ?></div>

			<?php the_content(react_t('Read More Text', react_get_option('general_read_more_text'))); ?>
		<?php endif; ?>

		<?php react_link_pages(); ?>
	</div>

	<?php edit_post_link('<i class="fa fa-pencil"></i> ' . esc_html__('Edit', 'react'), '<span class="edit-link">', '</span>'); ?>

</div>
