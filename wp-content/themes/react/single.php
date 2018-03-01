<?php
/**
 * The template for displaying single posts
 *
 * @see content-single.php
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<?php get_template_part('content', 'single'); ?>

	<?php comments_template('', true); ?>

	<?php if (react_get_option('blog_show_single_nav')) : ?>
		<div id="nav-single" class="clearfix">
			<div class="nav-single-inner">
				<div class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav"><i class="fa fa-angle-left"></i></span> %title'); ?></div>
				<div class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav"><i class="fa fa-angle-right"></i></span>'); ?></div>
			</div>
		</div>
	<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>