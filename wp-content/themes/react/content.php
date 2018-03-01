<?php
/**
 * The default template for displaying content in index and archive pages
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
		<?php
			if (is_search() && !in_array(get_post_format(), array('audio', 'image', 'video'))) {
				the_excerpt();
			} else {
				the_content(react_t('Read More Text', react_get_option('general_read_more_text')));
			}

			react_link_pages();

			echo react_comments_link();
		?>
	</div>

	<?php edit_post_link('<i class="fa fa-pencil"></i> ' . esc_html__('Edit', 'react'), '<span class="edit-link">', '</span>'); ?>

</div>
