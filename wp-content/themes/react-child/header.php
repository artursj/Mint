<?php
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
<body <?php body_class(); ?> <?php echo react_get_parallax_data('body'); ?>>
<div id="top"></div>
<?php do_action('react_body_start'); ?>
<div id="outside" class="clearfix">

	<?php do_action('react_outside_start'); ?>
	<div id="page" <?php echo react_page_animated(); ?>>

		<div class="top-and-pop clearfix">

			<?php react_popdown(); ?>

		

		</div>

		<?php react_slider('abovehead'); ?>

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

		<?php react_slider(); ?>

		<div class="after-header-wrap clearfix">
			<?php if (is_archive()){ ?>
				<?php do_action('react_after_header'); ?>
			<?php } ?>

			<div class="<?php echo esc_attr(react_sanitize_class(react_content_class('content-outer clearfix'))); ?>"<?php echo react_get_parallax_data('content'); ?>>
				<div class="content-inner-helper clearfix"><div class="content-inner clearfix">

					<?php do_action('react_before_content_style'); ?>

					<div class="content-style clearfix">

						<?php do_action('react_before_content'); ?>

						<main id="content">