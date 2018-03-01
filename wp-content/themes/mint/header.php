<?php
/**
 * The header for our theme
 *
 */

?><!DOCTYPE html>
<?php $itemCount = sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?>
<?php $itemCountM = sprintf ( WC()->cart->get_cart_contents_count()); ?>
<html>
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-53882306-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	
	  gtag('config', 'UA-53882306-1');
	</script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	   <!-- Latest compiled and minified CSS -->
		<?php wp_head(); ?>
	</head>
</html>
<body <?php body_class() ?>>

<div class="main-container ">
<div id="cart-sidebar" class="cart-closed">
	<div class="cart-customlocation">
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
	</div>
</div>
<div class="mobile-menu mobile-menu-closed">
<nav class="navbar">
	<div class="container  main-navbar" id="navbarSupportedContent">
		<ul class="navbar-nav">
			<?php
			$menu_name = 'Primary menu';
			$locations = get_nav_menu_locations();
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
			$menuitems = wp_get_nav_menu_items( $menu->term_id, array(
			'order' => 'DESC' ) );
			

			$count = 0;
			$submenu = false;
		

			foreach( $menuitems as $item ):
				// set up title and url
				$title = $item->title;
				$link = $item->url;
		

				// item does not have a parent so menu_item_parent
				// equals 0 (false)
				if ( !$item->menu_item_parent ):
		

				// save this id for later comparison with sub-menu items
				$parent_id = $item->ID;
				?>
				<li class="nav-item">
					<a href="<?php echo $link; ?>" class="nav-link">
						<?php echo $title; ?>
					</a>
				<?php endif; ?>
				<?php if ( $parent_id == $item->menu_item_parent ): ?>
					<?php if ( !$submenu ): $submenu = true; ?>
						<div class="dropdown-menu">
					<?php endif; ?>
							

							<a href="<?php echo $link; ?>"
							class="dropdown-item"><?php echo $title;
							?></a>
							

					<?php if ( $menuitems[ $count + 1
					]->menu_item_parent != $parent_id && $submenu ): ?>
						</div>
					<?php $submenu = false; endif; ?>
			

				<?php endif; ?>
				
			

			<?php $count++; endforeach; ?>
				<!--<li class="nav-item">
				   <a class="nav-link" href="#"><i class="fa fa-user" aria-hidden="true"></i> My Account</a>
				</li>
				<li class="nav-item">
				   <a class="nav-link" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
				</li>-->
				

		</ul>
	</ul>
</nav>
</div>
<div class="content-wrapper">
<header class="top-nav-header">
   <?php $menu_items = get_menu_items('Primary menu'); ?>
	<?php if ( has_nav_menu( 'Primary menu' ) ) : ?>
		<nav class="navbar navbar-expand-lg" id="navbar-top" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'mint' ); ?>">
			<div class="container">
			<div class="col-sm-5 mobile-nav-left">
				<ul class="navbar-nav social-top-nav">
					 <li class="nav-item">
						<a class="nav-link" href="https://www.facebook.com/mintfurnitureshop.se/"><i class="fa fa-facebook"
						aria-hidden="true"></i></a>
					</li>
					 <li class="nav-item">
						<a class="nav-link" href="https://www.instagram.com/mintfurnituresweden/"><i class="fa fa-instagram"
						aria-hidden="true"></i></a>
					</li>
					 <li class="nav-item">
						<a class="nav-link" href="https://www.pinterest.com/mintfurniturese/"><i class="fa
						fa-pinterest-p" aria-hidden="true"></i></a>
					</li>
					 <li class="nav-item">
						<a class="nav-link" href="#"><i class="fa
						fa-google-plus" aria-hidden="true"></i></i></a>
					</li>
				</ul>
				<div id="nav-icon">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				  </div>
			</div>
				<div class="col-sm-2 navbar-brand-cont mobile-nav-center">
					<a class="navbar-brand" href="https://www.mintfurnitureshop.se/"><img src="/wp-content/uploads/2017/06/cropped-mint-logo.png" alt="Mint furniture shop" /></a>
				</div>
				<div class="col-sm-5 mobile-nav-right">
					
					<a class="nav-link cart-button" ><span <?php if($itemCountM > 0){echo "class='mint-text'";} ?>><i class="fa fa-shopping-basket" aria-hidden="true"></i><span class="count-item"> (<?php echo $itemCountM; ?>)</span></span></a>
				</div>
			</div>
		</nav>
		<nav class="navbar navbar-expand-lg bottom-navbar">
			<button class="navbar-toggler" type="button" data-toggle="collapse"
			data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false"
			aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			<div class="container collapse navbar-collapse main-navbar"
			id="navbarSupportedContent">
				<ul class="navbar-nav">
					<?php
					$menu_name = 'Primary menu';
					$locations = get_nav_menu_locations();
					$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
					$menuitems = wp_get_nav_menu_items( $menu->term_id, array(
					'order' => 'DESC' ) );
					
					$count = 0;
					$submenu = false;
				
					foreach( $menuitems as $item ):
						// set up title and url
						$title = $item->title;
						$link = $item->url;
				
						// item does not have a parent so menu_item_parent
						// equals 0 (false)
						if ( !$item->menu_item_parent ):
				
						// save this id for later comparison with sub-menu items
						$parent_id = $item->ID;
						?>
						<li class="nav-item">
							<a href="<?php echo $link; ?>" class="nav-link">
								<?php echo $title; ?>
							</a>
						<?php endif; ?>
						<?php if ( $parent_id == $item->menu_item_parent ): ?>
							<?php if ( !$submenu ): $submenu = true; ?>
								<div class="dropdown-menu">
							<?php endif; ?>
									
									<a href="<?php echo $link; ?>"
									class="dropdown-item"><?php echo $title;
									?></a>
									
							<?php if ( $menuitems[ $count + 1
							]->menu_item_parent != $parent_id && $submenu ): ?>
								</div>
							<?php $submenu = false; endif; ?>
					
						<?php endif; ?>
					
					<?php $count++; endforeach; ?>
						<li class="nav-item">
						   <a class="nav-link cart-button cart_totals" ><span <?php
						   if($itemCount > 0){echo "class='mint-text'";} ?>><i
						   class="fa fa-shopping-basket" aria-hidden="true"></i>
						   <span class="icount"><?php echo $itemCount; ?></span></span></a>
						</li>
						<li class="nav-item">
						   <a class="nav-link" href="#"><i class="fa fa-search"
						   aria-hidden="true"></i></a>
						</li>
						
				</ul>
			</ul>
		</nav>
	<?php endif; ?>
</header>