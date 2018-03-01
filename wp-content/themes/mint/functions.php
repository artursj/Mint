<?php
function wpb_custom_new_menu() {
  register_nav_menu('Primary menu',__( 'Primary menu' ));
  register_nav_menu('Footer',__( 'Footer' )); register_nav_menu('footer top',__(
  'footer top' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

function mint_adding_scripts() {
  wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css');
  wp_enqueue_style( 'swiper','https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css' );
  wp_enqueue_style( 'fontawesome','https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css' );
  wp_register_script( 'swiper','https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js', null, true);
  wp_register_script( 'popper','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js',array(), null, true);
  wp_register_script( 'bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js',array(), null, true);
  wp_register_script( 'jquery','https://ajax.googleapis.com/ajax/libs/jquery/1.1.2/jquery.min.js', array(),null, true);
  wp_register_script( 'main', get_template_directory_uri() .'/js/main.js', true);
  
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'swiper' );
  wp_enqueue_script( 'popper' );
  
  wp_enqueue_script( 'bootstrap' );
  wp_enqueue_script( 'main' );
  
  wp_localize_script( 'main', 'cart_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_enqueue_scripts', 'mint_adding_scripts' );
add_action('admin_enqueue_scripts', 'load_custom_script' );
function load_custom_script() {
  wp_enqueue_script('jquery',
  'https://ajax.googleapis.com/ajax/libs/jquery/1.1.2/jquery.min.js', array(),
  null, true);
}

// Async load
function ikreativ_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async"; 
    }
add_filter( 'clean_url', 'ikreativ_async_scripts', 11, 1 );
function get_menu_items($menu_name){
    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[
    $menu_name ] ) ) {
        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] ); return
        wp_get_nav_menu_items($menu->term_id);
    }
}
function mint_setup(){
    add_theme_support('menus');
	add_theme_support( 'widgets' );
}
add_action('init', 'mint_setup');
add_theme_support( 'custom-header', array('height'=> 100));
add_theme_support( 'post-thumbnails' );
add_theme_support( 'customize-selective-refresh-widgets' );
add_theme_support(
'post-formats', array(
    'aside', 'image', 'video', 'quote', 'link', 'gallery', 'audio',
) );

add_theme_support( 'html5', array(
    'comment-form', 'comment-list', 'gallery', 'caption',
) );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support('wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider');

remove_action( 'woocommerce_before_main_content','woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
function my_theme_wrapper_start() {
  if(is_product()){
  }else{
    echo '<div class="wrap">
        <div id="primary" class="content-area"> <main id="main"
        class="container" role="main">';
  }
}

function my_theme_wrapper_end() {
  echo '</main><!-- #main -->
        </div><!-- #primary --> </div><!-- .wrap -->';
}
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering',
30 ); remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count',
20 ); remove_action( 'woocommerce_before_shop_loop_item_title',
'woocommerce_template_loop_product_thumbnail', 10 );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
function remove_woocommerce_product_tabs( $tabs ) {
    unset( $tabs['description'] ); unset( $tabs['reviews'] ); unset(
    $tabs['additional_information'] ); return $tabs;
}
  
add_filter( 'woocommerce_product_tabs', 'remove_woocommerce_product_tabs', 98 );
  /**        * Hook in each tabs callback function after single content. */
add_action( 'woocommerce_after_single_product_summary_description',
'woocommerce_product_description_tab' ); add_action(
'woocommerce_after_single_product_summary_related',
'woocommerce_output_related_products' ); add_action(
'woocommerce_before_add_to_cart_quantity', 'echo_qty_front_add_cart' );

function echo_qty_front_add_cart() {
  echo '<label class="qty">Quantity</label>';
}

add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
  function wcs_woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']); return $tabs;
}

add_action( 'woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1);
function remove_add_to_cart_buttons() {
    remove_action( 'woocommerce_after_shop_loop_item',
    'woocommerce_template_loop_add_to_cart' );
}

add_filter( 'woocommerce_checkout_fields' , 'alter_woocommerce_checkout_fields');

function alter_woocommerce_checkout_fields( $fields ) {
     unset($fields['order']['order_comments']); return $fields;
}

add_action( 'woocommerce_before_cart_item_quantity_zero', 'kli_wc_fix_cart_remove_last' );
function kli_wc_fix_cart_remove_last(){

    if ( count(WC()->cart->cart_contents) == 1 ) {
        WC()->cart->empty_cart( true );

    }

    // Redirect to prevent any message.
    $referer = ( wp_get_referer() ) ? wp_get_referer() : $woocommerce->cart->get_cart_url();
    wp_safe_redirect( $referer );
    exit;
}

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value
  // stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 21;
  return $cols;
}


function crispshop_add_cart_single_ajax() {
	$product_id = $_POST['product_id'];
	$variation_id = $_POST['variation_id'];
	$quantity = $_POST['quantity'];

	if ($variation_id) {
		WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
	} else {
		WC()->cart->add_to_cart( $product_id, $quantity);
	}

	$items = WC()->cart->get_cart();
	global $woocommerce;
	$item_count = $woocommerce->cart->cart_contents_count; ?>

	<span class="item-count"><?php echo $item_count; ?></span>
	
	<h3>Varukorg</h3>
	  <?php if ( !WC()->cart->get_cart_contents_count() == 0 ) { ?>
	  <table>
	  <?php foreach( WC()->cart->get_cart() as $cart_item_key =>
	  $cart_item) {
		  $_product = apply_filters( 'woocommerce_cart_item_product',
		  $cart_item['data'], $cart_item, $cart_item_key );
		  $product_id = apply_filters( 'woocommerce_cart_item_product_id',
		  $cart_item['product_id'], $cart_item, $cart_item_key );
	  ?>
		  <tr>
			 <td>
				  <p class="product-name">
					  <?php echo apply_filters(
					  'woocommerce_cart_item_name', $_product->get_name(),
					  $cart_item, $cart_item_key ); ?>
					  <?php echo apply_filters(
					  'woocommerce_checkout_cart_item_quantity', ' <strong
					  class="product-quantity">' . sprintf( '&times; %s',
					  $cart_item['quantity'] ) . '</strong>', $cart_item,
					  $cart_item_key ); ?>
				  </p>
				  <?php echo WC()->cart->get_item_data( $cart_item ); ?>
				  <p class="product-price"><?php echo apply_filters(
				  'woocommerce_cart_item_price',
				  WC()->cart->get_product_price( $_product ), $cart_item,
				  $cart_item_key ); ?></p>
			 </td>
		  </tr>
		  
	  <?php } ?>
	  </table>
	  <div class="cart-container mini-cart-buttons">
		<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="button
		button-white">
			Visa Varukorg
		</a>
		<a href="<?php echo esc_url( wc_get_checkout_url() );?>"
		class="checkout-button button alt wc-forward">
		  <?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?>
		</a>
		
	  </div>
	  
	  <?php }else{ ?>
		<div class="cart-container">
			<p>Your cart is empty</p>
		</div>
	  <?php } ?>
	<?php die();
}

add_action('wp_ajax_crispshop_add_cart_single', 'crispshop_add_cart_single_ajax');
add_action('wp_ajax_nopriv_crispshop_add_cart_single', 'crispshop_add_cart_single_ajax');