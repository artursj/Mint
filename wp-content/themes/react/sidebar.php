<?php
/**
 * The theme sidebar
 *
 * @package React
 * @since React 1.0
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?><aside id="sidebar" class="<?php echo esc_attr(react_sanitize_class('widget-area ' . react_get_option_palette_class('sidebar_choose_scheme'))); ?>">
<div class="sidebar-inner clearfix">
	<?php do_action('react_sidebar_start'); ?>

	<?php react_dynamic_sidebar(); ?>

	<?php do_action('react_sidebar_end'); ?>
</div>
</aside>