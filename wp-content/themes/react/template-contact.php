<?php
/*
 * Template Name: Contact Page
 *
 * Template for the contact page
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

$quformId = react_get_current_post_meta('quform_id', react_get_option('contact_quform_id'));
$contactPhone = react_t('Contact Phone Number', react_get_option('contact_phone_number'));
$contactFax = react_t('Contact Fax Number', react_get_option('contact_fax_number'));
$contactEmail = react_t('Contact Email', react_get_option('contact_email'));
$contactAddress = react_t('Contact Address', react_get_option('contact_address'));
$contactMap = react_t('Contact Map', react_get_option('contact_map'));
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

	<div class="entry-content clearfix"><?php the_content(); ?></div>

	<div class="contact-template-wrap clearfix">
		<div class="contact-left-col" id="contact-page-form">
			<?php if (function_exists('iphorm') && is_numeric($quformId) && iphorm_form_exists($quformId)) : ?>
				<?php echo iphorm($quformId); ?>
			<?php endif; ?>
		</div>

		<div class="contact-right-col">
			<div class="contact-info-wrap">

				<?php if ($contactPhone) : ?>
				<div class="contact-type-wrap phone clearfix">
					<div class="contact-type-left">
						<span class="fa fa-phone contact-ico"></span>
						<h3><?php echo esc_html(react_get_translation('phone', esc_html__('Phone', 'react'))); ?></h3>
					</div>
					<div class="contact-type-right">
						<?php echo esc_html($contactPhone); ?>
					</div>
				</div>
				<?php endif; ?>

				<?php if ($contactFax) : ?>
				<div class="contact-type-wrap fax clearfix">
					<div class="contact-type-left">
						<span class="fa fa-print contact-ico"></span>
						<h3><?php echo esc_html(react_get_translation('fax', esc_html__('Fax', 'react'))); ?></h3>
					</div>
					<div class="contact-type-right">
						<?php echo esc_html($contactFax); ?>
					</div>
				</div>
				<?php endif; ?>

				<?php if ($contactEmail) : ?>
				<div class="contact-type-wrap email clearfix">
					<div class="contact-type-left">
						<span class="fa fa-envelope contact-ico"></span>
						<h3><?php echo esc_html(react_get_translation('email', esc_html__('Email', 'react'))); ?></h3>
					</div>
					<div class="contact-type-right">
						<a href="mailto:<?php echo esc_attr($contactEmail); ?>"><?php echo esc_html($contactEmail); ?></a>
					</div>
				</div>
				<?php endif; ?>
			</div>

			<?php if ($contactAddress) : ?>
				<div class="contact-type-wrap address clearfix">
					<div class="clearfix">
						<div class="contact-type-left">
							<span class="fa fa-map-marker contact-ico"></span>
							<h3><?php echo esc_html(react_get_translation('location', esc_html__('Location', 'react'))); ?></h3>
						</div>
						<div class="contact-type-right">
							<?php echo nl2br(esc_html($contactAddress)); ?>

							<?php if (react_get_option('contact_map')) : ?>
							<div class="view-map-wrap clearfix">
								<a class="basic-button view-map"><?php echo esc_html(react_get_translation('find_us', esc_html__('Find us', 'react'))); ?></a>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<?php if ($contactMap) : ?>
				<div class="hidden-map" style="display: none;">
					<div class="flexible-frame map-default">
					<?php echo do_shortcode($contactMap); ?>
					</div>
				</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>

	</div>

	<?php edit_post_link('<i class="fa fa-pencil"></i> ' . esc_html__('Edit', 'react'), '<span class="edit-link">', '</span>'); ?>

<?php endwhile; ?>

<?php get_footer(); ?>