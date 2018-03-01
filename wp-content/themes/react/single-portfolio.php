<?php
/**
 * The Template for displaying a single portfolio item
 *
 * @see content-single-portfolio.php
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<?php get_template_part('content', 'single-portfolio'); ?>

	<?php if (react_get_option('portfolio_show_single_nav')) : ?>
	<div id="nav-single" class="clearfix">
		<div class="nav-single-inner">
			<div class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav"><i class="fa fa-angle-left"></i></span> %title', true, '', 'portfolio_category'); ?></div>
			<div class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav"><i class="fa fa-angle-right"></i></span>', true, '', 'portfolio_category'); ?></div>
		</div>
	</div>
	<?php endif; ?>

	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) {
			comments_template('', true);
		}
	?>

<?php endwhile; ?>
<?php get_footer(); ?>