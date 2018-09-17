	<?php
// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>
						</main><!-- #content -->

						<?php do_action('react_after_content'); ?>

					</div><!-- .content-style clearfix -->

					<?php do_action('react_after_content_style'); ?>

				</div></div><!-- .content-inner -->
			</div><!-- .content-outer -->

		  </div><!--   .after-header-wrap -->

		<?php do_action('react_before_footer'); ?>

		<footer id="footer-all" class="footer-all clearfix">

			<?php react_footer_widget_area(); ?>

			<div id="subfooter" class="<?php echo esc_attr(react_sanitize_class(react_subfooter_class('clearfix'))); ?>"<?php echo react_get_parallax_data('subfoot'); ?>>
				<div class="subfooter-inner-helper"><div class="subfooter-inner clearfix">
					<div class="subfooter-wrap clearfix">
						<?php do_action('react_footer'); ?>
					</div><!-- .wrap -->
				</div></div><!-- .inner -->
			</div><!-- #subfooter -->

		</footer><!-- .footer-all -->

		<?php do_action('react_after_footer'); ?>
		<span id="subfooter-toggle" class="fa fa-plus"> </span>
	</div><!-- #page -->

</div><!-- #outside -->
<div id="bottom"></div>

<?php wp_footer(); ?>
</body>
</html>