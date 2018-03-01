<?php
/**
 * The template used for displaying page content in page.php
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>

<?php echo react_get_post_featured_image(); ?>

<div class="entry-content clearfix">
	<?php
		the_content();
		react_link_pages();
	?>
</div>

<?php edit_post_link('<i class="fa fa-pencil"></i> ' . esc_html__('Edit', 'react'), '<span class="edit-link">', '</span>'); ?>
