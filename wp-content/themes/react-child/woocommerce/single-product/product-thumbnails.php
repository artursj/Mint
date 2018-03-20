<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   	3.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
	?>
	<div class="thumbnails woo-images <?php echo 'columns-' . $columns; ?>"><?php

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom', 'lightbox', 'tiny-hvr' );

			if ( $loop === 0 || $loop % $columns === 0 ) {
				$classes[] = 'first';
			}

			if ( ( $loop + 1 ) % $columns === 0 ) {
				$classes[] = 'last';
			}

			$image_class = implode( ' ', $classes );
			$props       = wc_get_product_attachment_props( $attachment_id, $post );

			if ( ! $props['url'] ) {
				continue;
			}

			$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
			$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
			$image_title     = get_post_field( 'post_excerpt', $attachment_id );

			$attributes = array(
				'title'                   => $image_title,
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
			);

			$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="' . esc_attr( $image_class ) . '" title="' . esc_attr( $image_title ) . '" data-fancybox-group="lightbox[product-gallery]">';
			$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
	 		$html .= '</a></div>';

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );

			$loop++;
		}

	?></div>
	<?php
}
