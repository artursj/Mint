<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Twitter widget
 */
class TCW_Widget_Twitter extends WP_Widget
{
	/**
	 * The default widget options
	 * @var array
	 */
	protected $defaults;

	public function __construct()
	{
		$this->defaults = array(
			'title' => sanitize_text_field(esc_html__('Twitter', 'react-widgets')),
			'username' => '',
			'consumer_key' => '',
			'consumer_secret' => '',
			'access_token' => '',
			'access_token_secret' => '',
			'count' => 3,
			'retweets' => true,
			'exclude_replies' => false,
			'style' => 'underlined',
			'show_follow_button' => true,
			'follow_button_text' =>  sanitize_text_field(esc_html__('Follow Me', 'react-widgets')),
			'no_tweets_found' => sanitize_text_field(esc_html__('No tweets found.', 'react-widgets')),
		);

		$widget_ops = array('classname' => 'tcw-widget-twitter', 'description' => esc_html__('A Twitter feed and Follow button.', 'react-widgets'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('tcw-widget-twitter', 'React - ' . esc_html__('Twitter', 'react-widgets'), $widget_ops, $control_ops);
	}

	public function widget($args, $instance)
	{
		$instance = wp_parse_args((array) $instance, $this->defaults);

		// WPML integration
		if (function_exists('icl_t')) {
			$instance['title'] = icl_t('React Widgets', 'Twitter Title - '  . $this->id, $instance['title']);
			$instance['username'] = icl_t('React Widgets', 'Twitter Username - '  . $this->id, $instance['username']);
			$instance['no_tweets_found'] = icl_t('React Widgets', 'Twitter No Tweets Text - ' . $this->id, $instance['no_tweets_found']);
			$instance['follow_button_text']= icl_t('React Widgets', 'Twitter Follow Button Text - ' . $this->id, $instance['follow_button_text']);
		}

		$instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $args['before_widget'];

		if (!empty($instance['title'])) {
			echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
		}

		$consumerKey = '';
		if (strlen($instance['consumer_key'])) {
			$consumerKey =  $instance['consumer_key'];
		} elseif (defined('TCW_TWITTER_API_KEY')) {
			$consumerKey = TCW_TWITTER_API_KEY;
		}

		$consumerSecret = '';
		if (strlen($instance['consumer_secret'])) {
			$consumerSecret =  $instance['consumer_secret'];
		} elseif (defined('TCW_TWITTER_API_SECRET')) {
			$consumerSecret = TCW_TWITTER_API_SECRET;
		}

		$accessToken = '';
		if (strlen($instance['access_token'])) {
			$accessToken =  $instance['access_token'];
		} elseif (defined('TCW_TWITTER_ACCESS_TOKEN')) {
			$accessToken = TCW_TWITTER_ACCESS_TOKEN;
		}

		$accessTokenSecret = '';
		if (strlen($instance['access_token_secret'])) {
			$accessTokenSecret =  $instance['access_token_secret'];
		} elseif (defined('TCW_TWITTER_ACCESS_TOKEN_SECRET')) {
			$accessTokenSecret = TCW_TWITTER_ACCESS_TOKEN_SECRET;
		}

		if (function_exists('curl_init')) {
			if (strlen($instance['username']) && strlen($consumerKey) && strlen($consumerSecret) && strlen($accessToken) && strlen($accessTokenSecret)) {
				$transientKey = sanitize_key($this->id);
				$cacheTime = 10; // minutes
				$cached = get_transient($transientKey);

				if ($cached === false) {
					// Tweets not in cache - fetch new
					require_once TCW_INCLUDES_DIR . '/twitteroauth/twitteroauth.php';

					$connection = new TwitterOAuth(
						$consumerKey,
						$consumerSecret,
						$accessToken,
						$accessTokenSecret
					);

					$tweets = $connection->get('statuses/user_timeline', array(
						'screen_name' => $instance['username'],
						'count' => $instance['count'],
						'exclude_replies' => $instance['exclude_replies'],
						'include_rts' => $instance['retweets']
					));

					if ($connection->http_code != 200) {
						$tweets = false;
					} else {
						// Save the tweets to cache
						set_transient($transientKey, $tweets, $cacheTime * 60);
					}
				} else {
					// Tweets in cache, use them
					$tweets = $cached;
				}

				?>
				<div class="tcw-widget-twitter-inner">
					<?php if (is_array($tweets) && count($tweets)) : ?>
						<ul class="<?php echo esc_attr(tcw_sanitize_class('tcw-tweet-list tcw-tweet-' . $instance['style'])); ?>">
							<?php foreach ($tweets as $tweet) : ?><li><i class="fa fa-twitter"></i> <?php
									echo make_clickable(esc_html($tweet->text));
									echo '<span class="tcw-tweet-time"><a href="' . esc_url('https://twitter.com/' . $tweet->user->screen_name . '/statuses/' . $tweet->id_str) . '" target="_blank">' . esc_html($this->ago($tweet->created_at)) . ' <i class="fa fa-external-link"></i></a></span>';
								?></li><?php endforeach; ?>
						</ul>
					<?php else : ?>
						<p><?php echo esc_html($instance['no_tweets_found']); ?></p>
					<?php endif; ?>
					<?php if ($instance['show_follow_button']) : ?>
					<div class="tcw-follow-me-button">
						<a href="<?php echo esc_url('https://twitter.com/' . $instance['username']); ?>"><i class="fa fa-twitter"></i> <?php echo esc_html($instance['follow_button_text']); ?></a>
					</div>
					<?php endif; ?>
				</div>
				<?php
			} else {
				echo '<p class="tcw-twitter-error">' . esc_html__('Please configure the Twitter widget settings at Appearance &rarr; Widgets within the WordPress admin.', 'react-widgets') . '</p>';
			}
		} else {
			echo '<p class="tcw-twitter-error">' . esc_html__('Error: cURL is not available. Please ask your host to install the cURL package for PHP.', 'react-widgets') . '</p>';
		}

		echo $args['after_widget'];
	}

	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['username'] = sanitize_text_field($new_instance['username']);
		$instance['consumer_key'] = sanitize_text_field($new_instance['consumer_key']);
		$instance['consumer_secret'] = sanitize_text_field($new_instance['consumer_secret']);
		$instance['access_token'] = sanitize_text_field($new_instance['access_token']);
		$instance['access_token_secret'] = sanitize_text_field($new_instance['access_token_secret']);
		$instance['count'] = absint($new_instance['count']);
		$instance['retweets'] = isset($new_instance['retweets']);
		$instance['exclude_replies'] = isset($new_instance['exclude_replies']);
		$instance['style'] = sanitize_text_field($new_instance['style']);
		$instance['show_follow_button'] = isset($new_instance['show_follow_button']);
		$instance['follow_button_text'] = sanitize_text_field($new_instance['follow_button_text']);
		$instance['no_tweets_found'] = sanitize_text_field($new_instance['no_tweets_found']);

		// Clear the cache for this instance
		delete_transient(sanitize_key($this->id));

		// WPML integration
		if (function_exists('icl_register_string')) {
			icl_register_string('React Widgets', 'Twitter Title - ' . $this->id, $instance['title']);
			icl_register_string('React Widgets', 'Twitter Username - ' . $this->id, $instance['username']);
			icl_register_string('React Widgets', 'Twitter No Tweets Text - ' . $this->id, $instance['no_tweets_found']);
			icl_register_string('React Widgets', 'Twitter Follow Button Text - ' . $this->id, $instance['follow_button_text']);
		}

		return $instance;
	}

	public function form($instance)
	{
		$instance = wp_parse_args((array) $instance, $this->defaults);
		?>
		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-300" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('username')); ?>"><?php esc_html_e('Username', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-150" id="<?php echo esc_attr($this->get_field_id('username')); ?>" name="<?php echo esc_attr($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($instance['username']); ?>" />
			</div>
		</div>

		<p><a href="http://support.themecatcher.net/react-wordpress/components/widgets/twitter-widget" target="_blank"><?php esc_html_e('Click here for help finding the API keys.', 'react-widgets'); ?></a></p>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('consumer_key')); ?>"><?php esc_html_e('API key', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-300" id="<?php echo esc_attr($this->get_field_id('consumer_key')); ?>" name="<?php echo esc_attr($this->get_field_name('consumer_key')); ?>" type="text" value="<?php echo esc_attr($instance['consumer_key']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('consumer_secret')); ?>"><?php esc_html_e('API secret', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-300" id="<?php echo esc_attr($this->get_field_id('consumer_secret')); ?>" name="<?php echo esc_attr($this->get_field_name('consumer_secret')); ?>" type="text" value="<?php echo esc_attr($instance['consumer_secret']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('access_token')); ?>"><?php esc_html_e('Access token', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-300" id="<?php echo esc_attr($this->get_field_id('access_token')); ?>" name="<?php echo esc_attr($this->get_field_name('access_token')); ?>" type="text" value="<?php echo esc_attr($instance['access_token']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('access_token_secret')); ?>"><?php esc_html_e('Access token secret', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-300" id="<?php echo esc_attr($this->get_field_id('access_token_secret')); ?>" name="<?php echo esc_attr($this->get_field_name('access_token_secret')); ?>" type="text" value="<?php echo esc_attr($instance['access_token_secret']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e('Number of tweets', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-50" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($instance['count']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('retweets')); ?>"><?php esc_html_e('Include retweets', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input id="<?php echo esc_attr($this->get_field_id('retweets')); ?>" name="<?php echo esc_attr($this->get_field_name('retweets')); ?>" type="checkbox" <?php checked($instance['retweets'], true); ?> value="1" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('exclude_replies')); ?>"><?php esc_html_e('Exclude replies', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input id="<?php echo esc_attr($this->get_field_id('exclude_replies')); ?>" name="<?php echo esc_attr($this->get_field_name('exclude_replies')); ?>" type="checkbox" <?php checked($instance['exclude_replies'], true); ?> value="1" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('style')); ?>"><?php esc_html_e('Style', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<select id="<?php echo esc_attr($this->get_field_id('style')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>">
					<option value="underlined" <?php selected($instance['style'], 'underlined'); ?>><?php esc_html_e('Underlined', 'react-widgets'); ?></option>
					<option value="light" <?php selected($instance['style'], 'light'); ?>><?php esc_html_e('Light', 'react-widgets'); ?></option>
					<option value="dark" <?php selected($instance['style'], 'dark'); ?>><?php esc_html_e('Dark', 'react-widgets'); ?></option>
				</select>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('show_follow_button')); ?>"><?php esc_html_e('Show follow button', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input id="<?php echo esc_attr($this->get_field_id('show_follow_button')); ?>" name="<?php echo esc_attr($this->get_field_name('show_follow_button')); ?>" type="checkbox" <?php checked($instance['show_follow_button'], true); ?> value="1" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('follow_button_text')); ?>"><?php esc_html_e('Follow button text', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-300" id="<?php echo esc_attr($this->get_field_id('follow_button_text')); ?>" name="<?php echo esc_attr($this->get_field_name('follow_button_text')); ?>" type="text" value="<?php echo esc_attr($instance['follow_button_text']); ?>" />
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('no_tweets_found')); ?>"><?php esc_html_e('"No tweets found" text', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-300" id="<?php echo esc_attr($this->get_field_id('no_tweets_found')); ?>" name="<?php echo esc_attr($this->get_field_name('no_tweets_found')); ?>" type="text" value="<?php echo esc_attr($instance['no_tweets_found']); ?>" />
			</div>
		</div>
<?php
	}

	/**
	 * Turns a Date into relative time
	 *
	 * Credit to Matt Jones
	 * http://www.mdj.us/web-development/php-programming/another-variation-on-the-time-ago-php-function-use-mysqls-datetime-field-type/
	 *
	 * @param   string  $time  Date string
	 * @return  string
	 */
	private function ago($date, $granularity = 1)
	{
		$date = strtotime($date);
		$difference = time() - $date;
		$retval = '';
		$periods = array('decade' => 315360000,
			'year' => 31536000,
			'month' => 2628000,
			'week' => 604800,
			'day' => 86400,
			'hour' => 3600,
			'minute' => 60,
			'second' => 1);
		if ($difference < 5) { // less than 5 seconds ago, let's say "just now"
			$retval = 'just now';
			return $retval;
		} else {
			foreach ($periods as $key => $value) {
				if ($difference >= $value) {
					$time = floor($difference/$value);
					$difference %= $value;
					$retval .= ($retval ? ' ' : '').$time.' ';
					$retval .= (($time > 1) ? $key.'s' : $key);
					$granularity--;
				}
				if ($granularity == '0') { break; }
			}
			return 'about '.$retval.' ago';
		}
	}
}
