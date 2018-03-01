<?php
/**
 * Product XML Feeds for WooCommerce - Shortcodes
 *
 * @version 1.2.1
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Alg_Shortcodes' ) ) :

class Alg_Shortcodes {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	public function __construct() {
		foreach( $this->the_shortcodes as $the_shortcode ) {
			add_shortcode( $the_shortcode, array( $this, 'alg_shortcode' ) );
		}
		add_filter( 'alg_shortcodes_list', array( $this, 'add_shortcodes_to_the_list' ) );
	}

	/**
	 * add_extra_atts.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function add_extra_atts( $atts ) {
		if ( ! isset( $this->the_atts ) ) {
			$this->the_atts = array();
		}
		$final_atts = array_merge( $this->the_atts, $atts );
		return $final_atts;
	}

	/**
	 * init_atts.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function init_atts( $atts ) {
		return $atts;
	}

	/**
	 * add_shortcodes_to_the_list.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function add_shortcodes_to_the_list( $shortcodes_list ) {
		foreach( $this->the_shortcodes as $the_shortcode ) {
			$shortcodes_list[] = $the_shortcode;
		}
		return $shortcodes_list;
	}

	/**
	 * alg_shortcode.
	 *
	 * @version 1.2.1
	 * @since   1.0.0
	 * @todo    recheck global atts (before, after etc.)
	 */
	function alg_shortcode( $atts, $content, $shortcode ) {

		// Init
		if ( empty( $atts ) ) {
			$atts = array();
		}

		// Add child class specific atts
		$atts = $this->add_extra_atts( $atts );

		// Merge atts with global defaults
		$global_defaults = array(
			'before'              => '',
			'after'               => '',
			'find'                => '',
			'replace'             => '',
			'on_empty'            => '',
		);
		$atts = array_merge( $global_defaults, $atts );

		// Check for required atts
		if ( false === ( $atts = $this->init_atts( $atts ) ) ) {
			return '';
		}

		// Run the shortcode function
		$shortcode_function = $shortcode;
		if ( '' !== ( $result = $this->$shortcode_function( $atts, $content ) ) ) {
			if ( '' != $atts['find'] ) {
				$result = str_replace( $atts['find'], $atts['replace'], $result );
			}
			return $atts['before'] . strip_tags( $result ) . $atts['after'];
		} else {
			return $atts['on_empty'];
		}
	}

}

endif;
