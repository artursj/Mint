<?php
/**
 * The template for displaying comments
 */

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

if (post_password_required()) return; // Do not show comments if the post is password protected
if ( ! post_type_supports(get_post_type(), 'comments')) return; // Return if the post type doesn't support comments
?>
<?php if (have_comments()) : ?>

	<div id="comments" class="comments clearfix">

		<?php if (react_get_option('blog_comments_layout') == 'tabs') : // Comments and pingbacks in separate tabs ?>
			<?php
				$commentCount = count($comments_by_type['comment']);
				$trackbackCount = count($comments_by_type['pings']);
			?>
			<div class="comment-tabs-wrap">
				<ul id="comment-tabs-nav">
					<li><a class="pointer"><?php echo esc_html(sprintf(_n('%s Comment', '%s Comments', $commentCount, 'react'), number_format_i18n($commentCount))); ?></a></li>
					<?php if ($trackbackCount) : ?>
						<li><a class="pointer"><?php echo esc_html(sprintf(_n('%s Trackback', '%s Trackbacks', $trackbackCount, 'react'), number_format_i18n($trackbackCount))); ?></a></li>
					<?php endif; ?>
				</ul>

				<div class="comment-tab comment-tab-comments">
					<h3 class="comments-title"><i class="fa-comments fa"></i><?php echo esc_html(react_get_translation('comments', esc_html__('Comments', 'react'))); ?></h3>
					<ol class="commentlist">
						<?php wp_list_comments(array('type' => 'comment', 'callback' => 'react_comment')); ?>
					</ol>
				</div>

				<?php if ($trackbackCount) : ?>
					<div class="comment-tab comment-tab-pings">
						<h3 class="comments-title"><i class="fa-compress fa"></i><?php echo esc_html(react_get_translation('trackbacks', esc_html__('Trackbacks', 'react'))); ?></h3>
						<ol class="commentlist pinglist">
							<?php wp_list_comments(array('type' => 'pings', 'callback' => 'react_ping')); ?>
						</ol>
					</div>
				<?php endif; ?>
			</div>


		<?php else : // Normal comments layout ?>

			<h3 class="comments-title"><i class="fa-comments fa"></i> <?php comments_number(); ?></h3>

			<ol class="commentlist">
				<?php wp_list_comments(array('type' => 'all', 'callback' => 'react_comment_list')); ?>
			</ol>

		<?php endif; ?>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
			<div class="comments-pagination-wrap clearfix">
				<?php paginate_comments_links(); ?>
			</div>
		<?php endif; ?>

	</div>
<?php endif; ?>

<?php if (comments_open()) : ?>
<div class="comment-reply-wrap react-accordion react-toggle">
	<h3><a><?php echo esc_html(react_get_translation('write_a_comment', esc_html__('Write a comment ...', 'react'))); ?><i class="fa fa-pencil"></i></a></h3>
	<div class="comment-form-wrap react-accordion-content">
	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');

		if ($req) {
			$nameLabel = react_get_translation('name_required', esc_attr__('Name (required)', 'react'));
			$emailLabel = react_get_translation('email_required', esc_attr__('Email (required)', 'react'));
		} else {
			$nameLabel = react_get_translation('name', esc_attr__('Name', 'react'));
			$emailLabel = react_get_translation('email', esc_attr__('Email', 'react'));
		}

		$websiteLabel = react_get_translation('website', esc_attr__('Website', 'react'));
		$commentLabel = react_get_translation('comment', esc_attr__('Comment (required)', 'react'));

		$args = array(
			'fields' => apply_filters('comment_form_default_fields', array(
				'author' => '<div class="element-wrapper author-element clearfix">' .
								'<div class="input-wrapper">' .
									'<input type="text" id="author" placeholder="' . esc_attr($nameLabel) . '" title="' . esc_attr($nameLabel) . '" name="author" value="' . esc_attr($commenter['comment_author']) . '" tabindex="1" />' .
								'</div>' .
							'</div>',
				'email' => '<div class="element-wrapper email-element clearfix">' .
								'<div class="input-wrapper">' .
									'<input type="text" id="email" placeholder="' . esc_attr($emailLabel) . '" title="' . esc_attr($emailLabel) . '" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" tabindex="2" />' .
								'</div>' .
							'</div>',
				'url' => '<div class="element-wrapper url-element clearfix">' .
								'<div class="input-wrapper">' .
									'<input type="text" id="url" placeholder="' . esc_attr($websiteLabel) . '" title="' . esc_attr($websiteLabel) . '" name="url" value="' . esc_attr($commenter['comment_author_url']) . '" tabindex="3" />' .
								'</div>' .
							'</div>'
			)),
			'comment_field' => '<div class="element-wrapper comment-element clearfix">' .
									'<div class="input-wrapper">' .
										'<textarea id="comment" placeholder="' . esc_attr($commentLabel) . '" title="' . esc_attr($commentLabel) . '" name="comment" tabindex="4" aria-required="true"></textarea>' .
									'</div>' .
								'</div>',
			'comment_notes_before' => '',
			'comment_notes_after' => '',
			'title_reply' => ''
		);

		comment_form($args);
	?>
	</div>
</div>
<?php else : ?>
	<h3 class="nocomments text-alt"><i class="fa fa-lock"> </i> <?php echo esc_html(react_get_translation('comments_closed', esc_html__('Comments are closed.', 'react'))); ?></h3>
<?php endif; ?>