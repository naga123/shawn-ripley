<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>
<ul id="cart" class="cart_list  <?php echo $args['list_class']; ?>">
	<span id="count" class="count" style="display:none"><?php echo $woocommerce->cart->cart_contents_count;?> item </span>
	
	<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>

		<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

			$_product = $cart_item['data'];

			// Only display if allowed
			if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
				continue;

			// Get price
			$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

			$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
			?>

			<li>
				<div class="dropdown_cart_img"><?php echo get_the_post_thumbnail($_product->id, array(60,60));?></div>
				<div class="product_name"><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?></div>
				<?php 
				//echo $woocommerce->cart->get_item_data( $cart_item ); 
				
					$step	= apply_filters( 'woocommerce_quantity_input_step', '1', $_product );
					$min 	= apply_filters( 'woocommerce_quantity_input_min', '', $_product );
					$max 	= '';
					//$max 	= apply_filters( 'woocommerce_quantity_input_max', $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(), $_product );
					$product_quantity = sprintf( '<div class="quantity"><input type="number" name="cart[%s][qty]" step="%s" min="%s" max="%s" value="%s" size="4" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="input-text qty text" maxlength="12" /></div>', $cart_item_key, $step, $min, $max, esc_attr( $cart_item['quantity'] ) );
					echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
				?>
				<a class="trash_icon" href="<?php echo get_remove_url($cart_item_key);?>"><i class="icon-trash"></i></a>

				<?php 
				//echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); 
				?>
				
			</li>

		<?php endforeach; ?>

	<?php else : ?>

		<li class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>

	<?php endif; ?>

</ul><!-- end product list -->

<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
	<div class="cart_total_checkoutt"> 															
		<span class="pull-left col1"><?php _e( 'Total', 'woocommerce' ); ?>:</span><span class="pull-left col1"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span>
		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
		<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="pull-right continue_shopping"><?php _e( 'View Cart &rarr;', 'woocommerce' ); ?></a>
		<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="pull-right continue_shopping"><?php _e( 'Checkout &rarr;', 'woocommerce' ); ?></a>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
