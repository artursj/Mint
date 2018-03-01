<?php
/**
 * The template for displaying posts in the Gallery Post Format on index and archive pages
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

	<?php
	if ($featuredImageType == 'below') {
		echo react_get_post_featured_image($featuredImageType);
	}
	?>
	<?php echo react_entry_meta(); ?>

	<div class="entry-content clearfix">
		<?php if (is_search()) : ?>
			<?php the_excerpt(); ?>
		<?php else : ?>
			<?php if (post_password_required()) : ?>
				<?php the_content(react_t('Read More Text', react_get_option('general_read_more_text'))); ?>
			<?php else : ?>
				<?php
				$images = get_children(array('post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999));
				if ($images) :
					$totalImages = count($images);
					$image = array_shift($images);
					?>
					<div class="gallery-thumb"><a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image($image->ID, 'medium'); ?></a></div>

					<p><em>
					<?php
						printf(
							esc_html(_n('This gallery contains %1$s%2$s photo%3$s.', 'This gallery contains %1$s%2$s photos%3$s.', $totalImages, 'react')),
							'<a href="' . esc_url(get_permalink()) . '">',
							number_format_i18n($totalImages),
							'</a>'
						);
					?></em></p>
				<?php endif; ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>

		<?php endif; ?>

		<?php
			react_link_pages();

			echo react_comments_link();
		?>

	</div>

	<?php edit_post_link('<i class="fa fa-pencil"></i> ' . esc_html__('Edit', 'react'), '<span class="edit-link">', '</span>'); ?>

</div>
