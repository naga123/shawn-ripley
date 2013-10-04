<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>
<div class="clear"></div>
<figure id="page_title">
	<div class="span8 first">
		<h2><?php the_title();?></h2>
	</div>
	<div class="span4 title_right"></div>	
</figure>
<div class="clear"></div>

<div class="images span5 first">
<?php if ($product->is_on_sale()) : ?>

	<?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale!', 'woocommerce' ).'</span>', $post, $product); ?>

<?php endif; 
		if ( has_post_thumbnail() ) {

			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$attachment_count   = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>

<figure id="product_info" class="span4">
	<h3><?php the_title();?></h3>
	<div class="price_holder" itemprop="offers" itemscope itemtype="http://schema.org/Offer">

		<p itemprop="price" class="price"><?php echo $product->get_price_html(); ?></p>

		<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
		<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

	</div>
	<div class="description_holder"> 
		<?php if ( ! $post->post_excerpt ) return; ?>
		<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
	</div>
</figure>