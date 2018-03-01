<?php
/**
 * The template for the search form
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?><form method="get" class="searchform" action="<?php echo esc_url(home_url()); ?>">
	<label><?php echo esc_html(react_get_translation('search', esc_html__('Search', 'react'))); ?></label>
	<input type="text" class="field" name="s" placeholder="<?php echo esc_attr(react_get_translation('type_here_to_search', esc_attr__('Type here to search', 'react'))); ?>" value="<?php echo esc_attr(get_search_query(false)); ?>" />
	<input type="submit" class="submit searchsubmit" value="<?php echo esc_attr(react_get_translation('search', esc_attr__('Search', 'react'))); ?>" />
</form>