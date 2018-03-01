<?php
/**
 * The default template for displaying pages
 *
 * @see content-page.php
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<?php get_template_part('content', 'page'); ?>

	<!-- Share -->
	<?php if (react_get_option('page_show_share')) : ?>
		<?php react_share(); ?>
	<?php endif; ?>

	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) {
			comments_template('', true);
		}
	?>

<?php endwhile; ?>

<?php get_footer(); ?>