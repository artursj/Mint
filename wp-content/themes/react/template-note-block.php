<?php
/*
 * Template Name: Note Block
 *
 * Template for a page with note block
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

<div id="outside" class="left-intro-box-page">

	<?php do_action('react_outside_start'); ?>

	<div id="page"<?php echo react_page_animated(); ?>>

		<?php if (react_get_current_post_meta('note_block_header', false)) : ?>
			<header class="header-all clearfix">

				<div id="header" class="<?php echo esc_attr(react_sanitize_class(react_head_class('clearfix'))); ?>"<?php echo react_get_parallax_data('mainhead'); ?>>
					<div class="header-inner-helper"><div class="header-inner clearfix">
						<div class="header-wrap clearfix">
							<div class="clearfix header-wrap-inner">
								<?php do_action('react_header'); ?>
							</div>

							<?php echo react_infomenu_slide_out_box(); ?>
						</div>
					</div></div>
				</div>

				<?php react_solonav(); ?>

			</header>
		<?php endif; ?>

		<div class="<?php echo esc_attr(react_sanitize_class(react_content_class('content-outer left-intro-box clearfix'))); ?>"<?php echo react_get_parallax_data('content'); ?>>
			<div class="content-inner-helper clearfix"><div class="content-inner clearfix">

				<?php do_action('react_before_content_style'); ?>

				<div class="content-style clearfix">

					<?php do_action('react_before_content'); ?>

					<main id="content">

						<?php while (have_posts()) : the_post(); ?>

							<?php get_template_part('content', 'page'); ?>

						<?php endwhile; ?>

					</main>

					<?php do_action('react_after_content'); ?>

				</div>

			</div></div>
		</div>

		<?php if (react_get_current_post_meta('show_footer', true)) : ?>
			<div class="footer-all left-intro-box-foot clearfix">

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

	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>