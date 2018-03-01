<?php
/**
 * The template for displaying post archives
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<?php get_template_part('content', get_post_format()); ?>

	<?php endwhile; ?>

	<?php react_content_nav('content-nav-below'); ?>

<?php else : ?>

	<?php react_404(); ?>

<?php endif; ?>

<?php get_footer(); ?>