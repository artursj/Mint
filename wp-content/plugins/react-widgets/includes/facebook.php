<?php

// Prevent direct script access
if ( ! defined('ABSPATH')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}

/**
 * Facebook widget
 */
class TCW_Widget_Facebook extends WP_Widget
{
	/**
	 * The default widget options
	 * @var array
	 */
	protected $defaults;

	/**
	 * The locales supported by Facebook. From https://www.facebook.com/translations/FacebookLocales.xml
	 * @var array
	 */
	protected $locales = array(
		'af_ZA'=> 'Afrikaans',
		'ar_AR' => 'Arabic',
		'az_AZ' => 'Azerbaijani',
		'be_BY' => 'Belarusian',
		'bg_BG' => 'Bulgarian',
		'bn_IN' => 'Bengali',
		'bs_BA' => 'Bosnian',
		'ca_ES' => 'Catalan',
		'cs_CZ' => 'Czech',
		'cx_PH' => 'Cebuano',
		'cy_GB' => 'Welsh',
		'da_DK' => 'Danish',
		'de_DE' => 'German',
		'el_GR' => 'Greek',
		'en_GB' => 'English (UK)',
		'en_PI' => 'English (Pirate)',
		'en_UD' => 'English (Upside Down)',
		'en_US' => 'English (US)',
		'eo_EO' => 'Esperanto',
		'es_ES' => 'Spanish (Spain)',
		'es_LA' => 'Spanish',
		'et_EE' => 'Estonian',
		'eu_ES' => 'Basque',
		'fa_IR' => 'Persian',
		'fb_LT' => 'Leet Speak',
		'fi_FI' => 'Finnish',
		'fo_FO' => 'Faroese',
		'fr_CA' => 'French (Canada)',
		'fr_FR' => 'French (France)',
		'fy_NL' => 'Frisian',
		'ga_IE' => 'Irish',
		'gl_ES' => 'Galician',
		'gn_PY' => 'Guarani',
		'gu_IN' => 'Gujarati',
		'he_IL' => 'Hebrew',
		'hi_IN' => 'Hindi',
		'hr_HR' => 'Croatian',
		'hu_HU' => 'Hungarian',
		'hy_AM' => 'Armenian',
		'id_ID' => 'Indonesian',
		'is_IS' => 'Icelandic',
		'it_IT' => 'Italian',
		'ja_JP' => 'Japanese',
		'ja_KS' => 'Japanese (Kansai)',
		'jv_ID' => 'Javanese',
		'ka_GE' => 'Georgian',
		'kk_KZ' => 'Kazakh',
		'km_KH' => 'Khmer',
		'kn_IN' => 'Kannada',
		'ko_KR' => 'Korean',
		'ku_TR' => 'Kurdish',
		'la_VA' => 'Latin',
		'lt_LT' => 'Lithuanian',
		'lv_LV' => 'Latvian',
		'mk_MK' => 'Macedonian',
		'ml_IN' => 'Malayalam',
		'mn_MN' => 'Mongolian',
		'mr_IN' => 'Marathi',
		'ms_MY' => 'Malay',
		'nb_NO' => 'Norwegian (bokmal)',
		'ne_NP' => 'Nepali',
		'nl_NL' => 'Dutch',
		'nn_NO' => 'Norwegian (nynorsk)',
		'pa_IN' => 'Punjabi',
		'pl_PL' => 'Polish',
		'ps_AF' => 'Pashto',
		'pt_BR' => 'Portuguese (Brazil)',
		'pt_PT' => 'Portuguese (Portugal)',
		'ro_RO' => 'Romanian',
		'ru_RU' => 'Russian',
		'si_LK' => 'Sinhala',
		'sk_SK' => 'Slovak',
		'sl_SI' => 'Slovenian',
		'sq_AL' => 'Albanian',
		'sr_RS' => 'Serbian',
		'sv_SE' => 'Swedish',
		'sw_KE' => 'Swahili',
		'ta_IN' => 'Tamil',
		'te_IN' => 'Telugu',
		'tg_TJ' => 'Tajik',
		'th_TH' => 'Thai',
		'tl_PH' => 'Filipino',
		'tr_TR' => 'Turkish',
		'uk_UA' => 'Ukrainian',
		'ur_PK' => 'Urdu',
		'uz_UZ' => 'Uzbek',
		'vi_VN' => 'Vietnamese',
		'zh_CN' => 'Simplified Chinese (China)',
		'zh_HK' => 'Traditional Chinese (Hong Kong)',
		'zh_TW' => 'Traditional Chinese (Taiwan)'
	);

	public function __construct()
	{
		$this->defaults = array(
			'title' => sanitize_text_field(esc_html__('Facebook', 'react-widgets')),
			'href' => 'https://www.facebook.com/',
			'width' => '',
			'height' => '',
			'tabs' => 'timeline',
			'hide_cover' => false,
			'show_facepile' => true,
			'hide_cta' => false,
			'small_header' => false,
			'adapt_container_width' => true,
			'locale' => 'en_US',
			'app_id' => ''
		);

		$widget_ops = array('classname' => 'tcw-widget-facebook', 'description' => esc_html__('Embed and promote any Facebook Page on your site.', 'react-widgets'));
		$control_ops = array('width' => 400, 'height' => 350);

		parent::__construct('tcw-widget-facebook', 'React - ' . esc_html__('Facebook', 'react-widgets'), $widget_ops, $control_ops);
	}

	public function widget($args, $instance)
	{
		$instance = wp_parse_args((array) $instance, $this->defaults);

		// WPML integration
		if (function_exists('icl_t')) {
			$instance['title'] = icl_t('React Widgets', 'Facebook Title - '  . $this->id, $instance['title']);
			$instance['href'] = icl_t('React Widgets', 'Facebook URL - '  . $this->id, $instance['href']);
		}

		$instance['title'] = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		echo $args['before_widget'];

		if (!empty($instance['title'])) {
			echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
		}
		?>
		<div class="tcw-widget-facebook-inner tcw-clearfix"
			data-locale="<?php echo esc_attr($this->validateLocale($instance['locale'])); ?>"
			data-app-id="<?php echo esc_attr($instance['app_id']); ?>">
			<div class="fb-page"
				data-href="<?php echo esc_attr($instance['href']); ?>"
				data-tabs="<?php echo esc_attr($instance['tabs']); ?>"
				data-hide-cover="<?php echo esc_attr($instance['hide_cover'] ? 'true' : 'false'); ?>"
				data-show-facepile="<?php echo esc_attr($instance['show_facepile'] ? 'true' : 'false'); ?>"
				data-hide-cta="<?php echo esc_attr($instance['hide_cta'] ? 'true' : 'false'); ?>"
				data-small-header="<?php echo esc_attr($instance['small_header'] ? 'true' : 'false'); ?>"
				data-adapt-container-width="<?php echo esc_attr($instance['adapt_container_width'] ? 'true' : 'false'); ?>"
				data-width="<?php echo esc_attr($instance['width']); ?>"
				data-height="<?php echo esc_attr($instance['height']); ?>"></div>
		</div>
		<?php
		echo $args['after_widget'];
	}

	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['href'] = esc_url_raw($new_instance['href']);
		$instance['width'] = is_numeric($new_instance['width']) ? absint($new_instance['width']) : '';
		$instance['height'] = is_numeric($new_instance['height']) ? absint($new_instance['height']) : '';
		$instance['tabs'] = sanitize_text_field($new_instance['tabs']);
		$instance['hide_cover'] = isset($new_instance['hide_cover']);
		$instance['show_facepile'] = isset($new_instance['show_facepile']);
		$instance['hide_cta'] = isset($new_instance['hide_cta']);
		$instance['small_header'] = isset($new_instance['small_header']);
		$instance['adapt_container_width'] = isset($new_instance['adapt_container_width']);
		$instance['locale'] = $this->validateLocale(sanitize_text_field($new_instance['locale']));
		$instance['app_id'] = sanitize_text_field($new_instance['app_id']);

		// WPML integration
		if (function_exists('icl_register_string')) {
			icl_register_string('React Widgets', 'Facebook Title - ' . $this->id, $instance['title']);
			icl_register_string('React Widgets', 'Facebook URL - ' . $this->id, $instance['href']);
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
				<label for="<?php echo esc_attr($this->get_field_id('href')); ?>"><?php esc_html_e('URL', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-300" id="<?php echo esc_attr($this->get_field_id('href')); ?>" name="<?php echo esc_attr($this->get_field_name('href')); ?>" type="text" value="<?php echo esc_attr($instance['href']); ?>" />
				<p class="tcw-widgetfield-description"><?php esc_html_e('The URL of the Facebook Page.', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('width')); ?>"><?php esc_html_e('Width', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-50" id="<?php echo esc_attr($this->get_field_id('width')); ?>" name="<?php echo esc_attr($this->get_field_name('width')); ?>" type="text" value="<?php echo esc_attr($instance['width']); ?>" />
				<p class="tcw-widgetfield-description"><?php esc_html_e('The pixel width of the plugin. The default is 340 if not set. Minimum is 180, maximum is 500.', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('height')); ?>"><?php esc_html_e('Height', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-50" id="<?php echo esc_attr($this->get_field_id('height')); ?>" name="<?php echo esc_attr($this->get_field_name('height')); ?>" type="text" value="<?php echo esc_attr($instance['height']); ?>" />
				<p class="tcw-widgetfield-description"><?php esc_html_e('The pixel height of the plugin. The default is 500 if not set. Minimum is 70.', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('tabs')); ?>"><?php esc_html_e('Tabs', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-100p" id="<?php echo esc_attr($this->get_field_id('tabs')); ?>" name="<?php echo esc_attr($this->get_field_name('tabs')); ?>" type="text" value="<?php echo esc_attr($instance['tabs']); ?>" />
				<p class="tcw-widgetfield-description"><?php echo sprintf(esc_html__('Tabs to render i.e. %1$s. Use a comma-separated list to add multiple tabs, i.e. %2$s.', 'react-widgets'), '<code>timeline, events, messages</code>', '<code>timeline, events</code>'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('hide_cover')); ?>"><?php esc_html_e('Hide cover photo', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input id="<?php echo esc_attr($this->get_field_id('hide_cover')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_cover')); ?>" type="checkbox" value="1" <?php checked($instance['hide_cover'], true); ?> />
				<p class="tcw-widgetfield-description"><?php esc_html_e('Hide cover photo in the header.', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('show_facepile')); ?>"><?php esc_html_e("Show friend's faces", 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input id="<?php echo esc_attr($this->get_field_id('show_facepile')); ?>" name="<?php echo esc_attr($this->get_field_name('show_facepile')); ?>" type="checkbox" value="1" <?php checked($instance['show_facepile'], true); ?> />
				<p class="tcw-widgetfield-description"><?php esc_html_e('Show profile photos when friends like this.', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('hide_cta')); ?>"><?php esc_html_e('Hide CTA button', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input id="<?php echo esc_attr($this->get_field_id('hide_cta')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_cta')); ?>" type="checkbox" value="1" <?php checked($instance['hide_cta'], true); ?> />
				<p class="tcw-widgetfield-description"><?php esc_html_e('Hide the custom call to action button (if available).', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('small_header')); ?>"><?php esc_html_e('Use small header', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input id="<?php echo esc_attr($this->get_field_id('small_header')); ?>" name="<?php echo esc_attr($this->get_field_name('small_header')); ?>" type="checkbox" value="1" <?php checked($instance['small_header'], true); ?> />
				<p class="tcw-widgetfield-description"><?php esc_html_e('Use the small header instead.', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('adapt_container_width')); ?>"><?php esc_html_e('Adapt to plugin container width', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input id="<?php echo esc_attr($this->get_field_id('adapt_container_width')); ?>" name="<?php echo esc_attr($this->get_field_name('adapt_container_width')); ?>" type="checkbox" value="1" <?php checked($instance['adapt_container_width'], true); ?> />
				<p class="tcw-widgetfield-description"><?php esc_html_e('Try to fit inside the container width.', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('locale')); ?>"><?php esc_html_e('Locale', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<select id="<?php echo esc_attr($this->get_field_id('locale')); ?>" name="<?php echo esc_attr($this->get_field_name('locale')); ?>">
					<?php foreach ($this->locales as $locale => $name) : ?>
						<option value="<?php echo esc_attr($locale); ?>" <?php selected($instance['locale'], $locale); ?>><?php echo esc_html($name); ?></option>
					<?php endforeach; ?>
				</select>
				<p class="tcw-widgetfield-description"><?php esc_html_e('Set the language of the plugin, if you have more than one widget on the page the first widget will determine the locale of the others.', 'react-widgets'); ?></p>
			</div>
		</div>

		<div class="tcw-widgetfield-wrap">
			<div class="tcw-widgetfield-label">
				<label for="<?php echo esc_attr($this->get_field_id('app_id')); ?>"><?php esc_html_e('App ID (optional)', 'react-widgets'); ?></label>
			</div>
			<div class="tcw-widgetfield-input">
				<input class="tcw-width-200" id="<?php echo esc_attr($this->get_field_id('app_id')); ?>" name="<?php echo esc_attr($this->get_field_name('app_id')); ?>" type="text" value="<?php echo esc_attr($instance['app_id']); ?>" />
				<p class="tcw-widgetfield-description"><?php printf(esc_html__('Enter your Facebook App ID if you have one. You can %screate an App ID here%s.', 'react-widgets'), '<a target="_blank" href="https://developers.facebook.com/apps">', '</a>'); ?></p>
			</div>
		</div>
		<?php
	}

	/**
	 * Checks whether the given locale is valid, otherwise returns the default locale
	 *
	 * @param   string  $locale  The locale to validate
	 * @return  string           The given locale if valid, default locale otherwise
	 */
	protected function validateLocale($locale)
	{
		if (!array_key_exists($locale, $this->locales)) {
			$locale = $this->defaults['locale'];
		}

		return $locale;
	}
}