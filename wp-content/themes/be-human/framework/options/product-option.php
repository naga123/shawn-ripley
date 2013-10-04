<?php

	/*	
	*	Crunchpress Portfolio Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Crunchpress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) Crunchpress
	*	---------------------------------------------------------------------
	*	This file create and contains the portfolio post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	//FRONT END RECIPE LAYOUT
	$wooproduct_class = array("Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1170,420), "size2"=>array(770, 400), "size3"=>array(570,300)));

	
	// Print Recipe item
	function print_wooproduct_item($item_xml){
		wp_reset_query();
		global $paged,$sidebar,$wooproduct_class,$post,$wp_query,$counter;
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		$sidebar_class = '';
		$layout_set_ajax = '';
		$item_type = 'Full-Image';
		// get the item class and size from array
		$item_class = $wooproduct_class[$item_type]['class'];
		$item_index = $wooproduct_class[$item_type]['index'];
		$full_content = find_xml_value($item_xml, 'show-full-news-post');
		if( $sidebar == "no-sidebar" ){
			$item_size = $wooproduct_class[$item_type]['size'];
			$sidebar_class = 'no_sidebar';
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$sidebar_class = 'one_sidebar';
			$item_size = $wooproduct_class[$item_type]['size2'];
		}else{
			$sidebar_class = 'two_sidebar';
			$item_size = $wooproduct_class[$item_type]['size3'];
		}
		
				
		// get the product meta value
		$header = find_xml_value($item_xml, 'header');
		$category = find_xml_value($item_xml, 'category');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$show_filterable = find_xml_value($item_xml, 'filterable');
		$layout_select = find_xml_value($item_xml, 'layout_select');
		
		$pagination = find_xml_value($item_xml, 'pagination');
		$category_name = '';
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'product_cat');
			$category = $category_term->term_id;
			$category_name = $category_term->name;
		}

	if(class_exists("Woocommerce")){
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'product_cat');
			$category = $category_term->slug;
		}
	$quan = array();
	$quantity = '';
	$total = '';
	$currency = '';
	if($show_filterable == 'Yes' AND $layout_select == 'Grid'){
		query_posts(array(
			'posts_per_page'			=> -1,
			'paged'						=> $paged,
			'post_type'					=> 'product',
			'product_cat'				=> $category,
			'post_status'				=> 'publish',
			'order'						=> 'DESC',
		));
		$counter_portfolio = 0;
	//Filterable Recipe Script start
	?>
	<script>
		jQuery(window).load(function() {
			var filter_container = jQuery('#portfolio-item-holder<?php echo $counter?>');

			filter_container.children().css('position','absolute');	
			filter_container.masonry({
				singleMode: true,
				itemSelector: '.portfolio-item:not(.hide)',
				animate: true,
				animationOptions:{ duration: 800, queue: false }
			});	
			jQuery(window).resize(function(){
				var temp_width =  filter_container.children().filter(':first').width() + 45;
				filter_container.masonry({
					columnWidth: temp_width,
					singleMode: true,
					itemSelector: '.portfolio-item:not(.hide)',
					animate: true,
					animationOptions:{ duration: 800, queue: false }
				});		
			});	
			jQuery('ul#portfolio-item-filter<?php echo $counter?> a').click(function(e){	

				jQuery(this).addClass("active");
				jQuery(this).parents("li").siblings().children("a").removeClass("active");
				e.preventDefault();
				
				var select_filter = jQuery(this).attr('data-value');
				
				if( select_filter == "All" || jQuery(this).parent().index() == 0 ){		
					filter_container.children().each(function(){
						if( jQuery(this).hasClass('hide') ){
							jQuery(this).removeClass('hide');
							jQuery(this).fadeIn();
						}
					});
				}else{
					filter_container.children().not('.' + select_filter).each(function(){
						if( !jQuery(this).hasClass('hide') ){
							jQuery(this).addClass('hide');
							jQuery(this).fadeOut();
						}
					});
					filter_container.children('.' + select_filter).each(function(){
						if( jQuery(this).hasClass('hide') ){
							jQuery(this).removeClass('hide');
							jQuery(this).fadeIn();
						}
					});
				}
				
				filter_container.masonry();	
				
			});
		});
		</script>
		
		
		<!--<ul id="portfolio-item-filter<?php echo $counter?>" class="category-list">
			<li><a data-value="all" class="gdl-button active" href="#">All</a></li>
			<?php

			$categories = get_categories( array('child_of' => $category, 'taxonomy' => 'product_cat', 'hide_empty' => 0) );
			//$categories = get_the_terms( $post->ID, 'recipe-category' );								 
				if($categories <> ""){
					foreach($categories as $values){?>
					<li><a data-value="<?php echo $values->term_id;?>" class="gdl-button" href="#"><?php echo $values->name;?></a></li>                                
				<?php
					}
				}?>                            
			<div class="clear"></div>
		</ul>-->
		<figure id="page_title">
			<div class="span4 first">
				<h2><?php echo $header;?></h2>
			</div>
			<div class="span8 title_right">
				<div id="cart_dropdown" class="dropdown">
					<ul id="portfolio-item-filter<?php echo $counter?>" class="category_list_filterable">
						<li><a data-value="all" class="gdl-button active" href="#"><?php _e('All','crunchpress');?></a></li>
						<?php

						$categories = get_categories( array('child_of' => $category, 'taxonomy' => 'product_cat', 'hide_empty' => 0) );
						//$categories = get_the_terms( $post->ID, 'recipe-category' );								 
							if($categories <> ""){
								foreach($categories as $values){?>
								<li><a data-value="<?php echo $values->term_id;?>" class="gdl-button" href="#"><?php echo $values->name;?></a></li>                                
							<?php
								}
							}?>                            
						<div class="clear"></div>
					</ul>
				</div>
			</div>	
		</figure>
		<hr />
		<section class="product_view" id="product_grid">  
			<ul id="portfolio-item-holder<?php echo $counter?>" class="product_image_holder">
				<?php
				$permalink_structure = get_option('permalink_structure');
				if($permalink_structure <> ''){
					$permalink_structure = '?';
				}else{
					$permalink_structure = '&';
				}
				$counter_product = 0;
				while( have_posts() ){
					global $post,$post_id,$product,$product_url;
					the_post();	
					
					$regular_price = get_post_meta($post->ID, '_regular_price', true);
					if($regular_price == ''){
						$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
					}
					$sale_price = get_post_meta($post->ID, '_sale_price', true);
					if($sale_price == ''){
						$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
					}
					$sku_num = get_post_meta($post->ID, '_sku', true);
					$currency = get_woocommerce_currency_symbol();
					 ?>
						<li class="product_char_info all portfolio-item item alpha
					<?php $categories = get_the_terms( $post->ID, 'product_cat' );
						if($categories <> ''){
							foreach ( $categories as $category ) {
								echo $category->term_id." ";
							}
						}?>" id="product"> 
							<div class="product_img">
								<?php echo get_the_post_thumbnail($post_id, $item_size);?>
							</div>
							<div class="first product_description">
								<h3><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h3>
								<p><?php echo substr(get_the_content(),0,$num_excerpt);?></p>
								<span class="price"> <sup><?php echo $currency;?></sup><?php echo $regular_price;?><del><sup><?php echo $currency;?></sup><?php echo $sale_price;?></del></span>
								<form enctype="multipart/form-data" method="post" class="cart" action="<?php echo get_permalink();?><?php echo $permalink_structure;?>add-to-cart=<?php echo $post->ID;?>">
									<!--<div class="quantity buttons_added"><input type="button" class="minus" value="-">
									<input type="number" class="input-text qty text" title="Qty" value="1" name="quantity" step="1">
									<input type="button" class="plus" value="+"></div>-->
									<button class="btn pull-right add_to_cart_button button product_type_simple" data-quantity="1" data-product_sku="<?php echo $sku_num;?>" data-product_id="<?php echo $post->ID;?>" type="submit"><?php _e('Add to cart','crunchpress');?></button>
								</form>
							</div>
						</li>
						<?php
						$counter_product++;
				}//End While
			?>
			</ul>	
		</section>
		<?php }else if($layout_select == 'Grid'){
		query_posts(array(
			'posts_per_page'			=> $num_fetch,
			'paged'						=> $paged,
			'post_type'					=> 'product',
			'product_cat'				=> $category,
			'post_status'				=> 'publish',
			'order'						=> 'DESC',
		));

		global $post,$post_id,$product,$woocommerce;	
		
		
		?>
		<figure id="page_title">
			<div class="span8 first">
				<h2><?php echo $header;?></h2>
			</div>
			<?php echo $woocommerce->messages[0];?>
			<div class="span4 title_right">
			
				<div class="dropdown" id="cart_dropdown">
					<!--<span><?php echo $woocommerce->messages[0];?></span>-->
					<span> Your have <span id="count" class="count"><?php echo $woocommerce->cart->cart_contents_count;?> item </span> in your cart.</span>
					<a data-toggle="dropdown" class="dropdown-toggle" role="button" id="cart_down" href="#">
					<i class="icon-shopping-cart"></i>
					Cart
					<span class="caret"></span>
					</a>
					<?php 
					//print_r($woocommerce->cart);
					
					if($woocommerce->cart->cart_contents_count <> 0){ ?>
					<div class="dropdown-menu cart_down_content" aria-labelledby="cart_down" role="menu" id="cart_down_content">
						<ul id="cart">
						<?php
						
							foreach($woocommerce->cart->get_cart() as $keys=>$values){ 
								$quantity = $values['quantity'];
								$_product = $values['data'];
								$id = $values['data']->post->ID;
								$post_content = $values['data']->post->post_content;
								$post_title = $values['data']->post->post_title;
								$guid = $values['data']->post->guid;
								
								//Price of Product
								$regular_price = get_post_meta($id, '_regular_price', true);
								if($regular_price == ''){
									$regular_price = get_post_meta($id, '_max_variation_regular_price', true);
								}
								$sale_price = get_post_meta($id, '_sale_price', true);
								if($sale_price == ''){
									$sale_price = get_post_meta($id, '_min_variation_sale_price', true);
								}
								$currency = get_woocommerce_currency_symbol();
								
								?>
								<li> 
									<div class="dropdown_cart_img"><?php echo get_the_post_thumbnail($id, array(60,60));?></div>
									<div class="product_name"><?php echo $post_title;?></div>
									<div class="actions">
										<?php
											$step	= apply_filters( 'woocommerce_quantity_input_step', '1', $_product );
											$min 	= apply_filters( 'woocommerce_quantity_input_min', '', $_product );
											$max 	= '';
											//$max 	= apply_filters( 'woocommerce_quantity_input_max', $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(), $_product );
											$product_quantity = sprintf( '<div class="quantity"><input type="number" name="cart[%s][qty]" step="%s" min="%s" max="%s" value="%s" size="4" title="' . _x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) . '" class="input-text qty text" maxlength="12" /></div>', $keys, $step, $min, $max, esc_attr( $quantity ) );
											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $keys );
										?>
										<a href="<?php echo get_remove_url($keys);?>"><i class="icon-trash"></i></a>
									</div>
								</li>
							<?php
							}
						?>
						</ul>
						<div class="cart_total_checkout"> 
							<span class="pull-left col1"><?php _e('Total','crunchpress');?></span> 
							<span class="pull-left col1"><?php echo $currency;?><?php echo $woocommerce->cart->subtotal;?></span>
							<?php $new_url = str_replace('index.php', 'cart', $_SERVER['PHP_SELF']);?>
							<a href="<?php echo $new_url;?>" class="pull-right continue_shopping"><?php _e('View Cart','crunchpress');?></a>
						</div>
					</div>
					<?php }else{?>
					<div class="dropdown-menu" aria-labelledby="cart_down" role="menu" id="cart_down_content">
						<h3 id="no_item_found" class="pull-left"><?php _e('No Item Found','crunchpress');?></h3>
					</div>	
					<?php }?>
				</div>
			</div>
		</figure>
		
		<section class="product_view" id="product_grid">  
			<div class="product_image_holder">
				<?php
				$counter_product = 0;
				while( have_posts() ){
					global $post,$post_id,$product,$product_url,$woocommerce;
					the_post();	
					//echo '<pre>';print_r($woocommerce->cart->get_cart());
					
					$permalink_structure = get_option('permalink_structure');
					if($permalink_structure <> ''){
						$permalink_structure = '?';
					}else{
						$permalink_structure = '&';
					}
					$regular_price = get_post_meta($post->ID, '_regular_price', true);
					if($regular_price == ''){
						$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
					}
					$sale_price = get_post_meta($post->ID, '_sale_price', true);
					$sku_num = get_post_meta($post->ID, '_sku', true);
					
					if($sale_price == ''){
						$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
					}
					$currency = get_woocommerce_currency_symbol();
					if($counter_product % 3 == 0){ ?>
					<hr />
						<div class="span4 first" id="product"> 
							<div class="product_img">
								<?php echo get_the_post_thumbnail($post_id, $item_size);?>
							</div>
							<div class="first product_description">
								<h3><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h3>
								<p><?php echo substr(get_the_content(),0,$num_excerpt);?></p>
								<span class="price"><sup><?php echo $currency;?></sup><?php echo $sale_price;?><del><sup><?php echo $currency;?></sup><?php echo $regular_price;?></del></span>
								<form enctype="multipart/form-data" method="post" class="cart" action="<?php echo get_permalink();?><?php echo $permalink_structure;?>add-to-cart=<?php echo $post->ID;?>">
									<!--<div class="quantity buttons_added"><input type="button" class="minus" value="-">
									<input type="number" class="input-text qty text" title="Qty" value="1" name="quantity" step="1">
									<input type="button" class="plus" value="+"></div>-->
									<button class="btn pull-right add_to_cart_button button product_type_simple added" data-quantity="1" data-product_sku="<?php echo $sku_num;?>" data-product_id="<?php echo $post->ID;?>" type="submit">Add to cart</button>
								</form>
								<!--<a href="<?php echo get_permalink();?><?php echo $permalink_structure;?>add-to-cart=<?php echo $post->ID;?>" class="add_to_cart_button btn pull-right"> Add to Cart </a>-->
								<!--<a data-product_sku="" data-product_id="" class="add_to_cart_button btn pull-right"> Add to Cart </a>-->
							</div>
						</div>
						<?php }else{ ?>
						<div class="span4" id="product"> 
							<div class="product_img">
								<?php echo get_the_post_thumbnail($post_id, $item_size);?>
							</div>
							<div class="first product_description">
								<h3><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h3>
								<p><?php echo substr(get_the_content(),0,$num_excerpt);?></p>
								<span class="price"><sup><?php echo $currency;?></sup><?php echo $sale_price;?><del><sup><?php echo $currency;?></sup><?php echo $regular_price;?></del></span>
								<!--<a href="<?php echo get_permalink();?><?php echo $permalink_structure;?>add-to-cart=<?php echo $post->ID;?>" class="add_to_cart_button btn pull-right"> Add to Cart </a>-->
								<!--<a data-product_sku="" data-product_id="" class="add_to_cart_button btn pull-right"> Add to Cart </a>-->
								<form enctype="multipart/form-data" method="post" class="cart" action="<?php echo get_permalink();?><?php echo $permalink_structure;?>add-to-cart=<?php echo $post->ID;?>">
									<!--<div class="quantity buttons_added"><input type="button" class="minus" value="-">
									<input type="number" class="input-text qty text" title="Qty" value="1" name="quantity" step="1">
									<input type="button" class="plus" value="+"></div>-->
									<button class="btn pull-right add_to_cart_button button product_type_simple" data-quantity="1" data-product_sku="<?php echo $sku_num;?>" data-product_id="<?php echo $post->ID;?>" type="submit"><?php _e('Add to cart','crunchpress');?></button>
								</form>
							</div>
						</div>
						<?php }$counter_product++;
				}//End While
			?>
			</div>	
		</section>
		<?php }else{ 
		query_posts(array(
			'posts_per_page'			=> $num_fetch,
			'paged'						=> $paged,
			'post_type'					=> 'product',
			'product_cat'				=> $category,
			'post_status'				=> 'publish',
			'order'						=> 'DESC',
		));
		?>
		<figure id="page_title">
			<div class="span8 first">
				<h2><?php echo $header;?></h2>
			</div>
			<div class="span4 title_right">
				<div class="dropdown" id="cart_dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" role="button" id="cart_down" href="#">
						<i class="icon-ticket"></i>
						<?php _e('Product Categories','crunchpress');?>
						<span class="caret"></span>
					</a>
					<div class="dropdown-menu" aria-labelledby="cart_down" role="menu" id="listing_dropdown">
						<ul>                    
							<?php
							$get_categories = get_categories( array('child_of' => $category, 'taxonomy' => 'product_cat', 'hide_empty' => 0,'post_status' => 'publish') );
							if($get_categories <> ""){
								foreach ( $get_categories as $mycat ) { ?>
									<li><?php echo $mycat->cat_name;?><a href="<?php echo get_term_link(intval($mycat->term_id),'product_cat');?>"><?php echo $mycat->count;?></a></li>
								<?php
								}
							}
							?>					
						</ul>
					</div>
				</div>
			</div>	
		</figure>
		<section class="product_view" id="product_grid">  
			
				<?php
				$counter_product = 0;
				while( have_posts() ){
					global $post,$post_id,$product,$product_url,$woocommerce;
					the_post();	
					
					$regular_price = get_post_meta($post->ID, '_regular_price', true);
					if($regular_price == ''){
						$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
					}
					$sale_price = get_post_meta($post->ID, '_sale_price', true);
					if($sale_price == ''){
						$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
					}
					$currency = get_woocommerce_currency_symbol();
					?>
						<figure id="product" class="span12 first">  
							<div class="product_img span4 first">
								<?php echo get_the_post_thumbnail($post_id, $item_size);?>
								<span class="sale_icon"></span>
							</div>
							<div class="span8 product_description">
								<h3><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h3>
								<p><?php echo substr(get_the_content(),0,$num_excerpt);?></p>
								<span class="price"> <sup><?php echo $currency;?></sup><?php echo $regular_price;?><del><sup><?php echo $currency;?></sup><?php echo $sale_price;?></del></span>
								<!--<a href="<?php echo get_permalink();?>&add-to-cart=<?php echo $post->ID;?>" class="add_to_cart_button btn pull-right">Add to Cart</a>-->
								<form enctype="multipart/form-data" method="post" class="cart" action="<?php echo get_permalink();?><?php echo $permalink_structure;?>add-to-cart=<?php echo $post->ID;?>">
									<!--<div class="quantity buttons_added"><input type="button" class="minus" value="-">
									<input type="number" class="input-text qty text" title="Qty" value="1" name="quantity" step="1">
									<input type="button" class="plus" value="+"></div>-->
									<button class="btn pull-right add_to_cart_button button product_type_simple" data-quantity="1" data-product_sku="<?php echo $sku_num;?>" data-product_id="<?php echo $post->ID;?>" type="submit"><?php _e('Add to cart','crunchpress');?></button>
								</form>
							</div>
						</figure>
					<hr />
						<?php
				}//End While
			?>
			
		</section>
		<?php }?>
		<div class="clear"></div>
		<?php
		if( find_xml_value($item_xml, "pagination") == "Yes"){	
			pagination();
		}
	}		
}	


	 function get_cart() {
		return array_filter( (array) $this->cart_contents );
	}
	
	function get_remove_url( $cart_item_key ) {
			global $woocommerce;
			$cart_page_id = woocommerce_get_page_id('cart');
			if ($cart_page_id)
				return apply_filters( 'woocommerce_get_remove_url', $woocommerce->nonce_url( 'cart', add_query_arg( 'remove_item', $cart_item_key, get_permalink($cart_page_id) ) ) );
		}


	
?>