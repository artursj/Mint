<?php
/**
 * Product XML Feeds for WooCommerce - Settings
 *
 * @version 1.1.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Settings_Product_XML_Feeds' ) ) :

class Alg_WC_Settings_Product_XML_Feeds extends WC_Settings_Page {

	/**
	 * Constructor.
	 *
	 * @version 1.1.0
	 * @since   1.0.0
	 */
	function __construct() {
		$this->id    = 'alg_wc_product_xml_feeds';
		$this->label = __( 'Product XML Feeds', 'product-xml-feeds-for-woocommerce' );
		parent::__construct();
		add_action( 'woocommerce_admin_field_alg_wc_product_xml_custom_textarea', array( $this, 'output_custom_textarea' ) );
		add_filter( 'woocommerce_admin_settings_sanitize_option',                 array( $this, 'unclean_custom_textarea' ), PHP_INT_MAX, 3 );
	}

	/**
	 * output_custom_textarea.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function output_custom_textarea( $value ) {
		$option_value = get_option( $value['id'], $value['default'] );
		$custom_attributes = ( isset( $value['custom_attributes'] ) && is_array( $value['custom_attributes'] ) ) ? $value['custom_attributes'] : array();
		$description = ' <p class="description">' . $value['desc'] . '</p>';
		$tooltip_html = ( isset( $value['desc_tip'] ) && '' != $value['desc_tip'] ) ? '<span class="woocommerce-help-tip" data-tip="' . $value['desc_tip'] . '"></span>' : '';
		?><tr valign="top">
			<th scope="row" class="titledesc">
				<label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_html( $value['title'] ); ?></label>
				<?php echo $tooltip_html; ?>
			</th>
			<td class="forminp forminp-<?php echo sanitize_title( $value['type'] ) ?>">
				<?php echo $description; ?>

				<textarea
					name="<?php echo esc_attr( $value['id'] ); ?>"
					id="<?php echo esc_attr( $value['id'] ); ?>"
					style="<?php echo esc_attr( $value['css'] ); ?>"
					class="<?php echo esc_attr( $value['class'] ); ?>"
					placeholder="<?php echo esc_attr( $value['placeholder'] ); ?>"
					<?php echo implode( ' ', $custom_attributes ); ?>
					><?php echo esc_textarea( $option_value );  ?></textarea>
			</td>
		</tr><?php
	}

	/**
	 * unclean_custom_textarea.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function unclean_custom_textarea( $value, $option, $raw_value ) {
		return ( 'alg_wc_product_xml_custom_textarea' === $option['type'] ) ? $raw_value : $value;
	}

	/**
	 * get_settings.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function get_settings() {
		global $current_section;
		return apply_filters( 'woocommerce_get_settings_' . $this->id . '_' . $current_section, array() );
	}

}

endif;

return new Alg_WC_Settings_Product_XML_Feeds();
