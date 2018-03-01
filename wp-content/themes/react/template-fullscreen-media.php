<?php
/*
 * Template Name: Fullscreen Media
 *
 * Template for a video, image or audio display
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?><!DOCTYPE html>
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?> class="no-js">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?> class="no-js">
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_head(); ?>
</head>
<body id="top" <?php body_class(); ?> <?php echo react_get_parallax_data('body'); ?>>
<?php do_action('react_body_start'); ?>

<div id="outside">

	<?php do_action('react_outside_start'); ?>

	<div id="page"<?php echo react_page_animated(); ?>>

		<?php react_slider(); ?>

		<?php if (react_get_current_post_meta('show_footer', true)) : ?>
			<div class="footer-all">

				<div id="subfooter" class="<?php echo esc_attr(react_sanitize_class(react_subfooter_class('clearfix'))); ?>"<?php echo react_get_parallax_data('subfoot'); ?>>
					<div class="subfooter-inner-helper"><div class="subfooter-inner clearfix">
						<div class="subfooter-wrap clearfix">
							<?php do_action('react_footer'); ?>
						</div>
					</div></div>
				</div>

			</div>
		<?php endif; ?>

		<?php echo react_skip_intro(); ?>
		<span id="distraction-toggle" class="fa fa-plus"> </span>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>