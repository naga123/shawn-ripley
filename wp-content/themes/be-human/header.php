<!DOCTYPE HTML>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->

<html <?php language_attributes(); ?>>


<!--<![endif]-->

<head>
<?php
			$header_logo_upload = '';
			$logo_width = '';
			$logo_height = '';
			$select_layout_cp = '';
			$boxed_scheme = '';
			$select_bg_pat = '';
			$color_scheme = '';
			$color_anchor = '';
			$bg_scheme = '';
			$body_patren = '';
			$body_image = '';
			$position_image_layout = '';
			$image_repeat_layout = '';
			$image_attachment_layout = '';
			$topcart_icon = '';
			$header_css_code = '';
			$google_webmaster_code = '';
			$news_headline = '';
			$news_headline_category = '';
			$countd_event_category = '';
			$copyright_code = '';
			$consumer_key = '';
			$consumer_secret = ''; 
			$user_token = '';
			$user_secret = '';
			$twitter_id = '';
		//	$homepage_on = '';
//			$homepage_layout_on = '';
//			$section_select_background = '';
//			$section_scheme = '';
//			$section_patren = '';
//			$section_body_patren = '';
//			$home_page_layout = '';
			$footer_banner = '';
			$footer_col_layout = '';
			$phone_contact = '';
			$social_networking = '';
			$top_count_header = '';
			$footer_logo = '';
			$footer_logo_width = '';
			$footer_logo_height = '';
			$footer_layout = '';
			$breadcrumbs = '';			
			$rtl_layout = '';
			$tf_username = '';
			$tf_sec_api = '';
			
			$cp_general_settings = get_option('general_settings');
			if($cp_general_settings <> ''){
				$cp_logo = new DOMDocument ();
				$cp_logo->loadXML ( $cp_general_settings );
				$header_logo = find_xml_value($cp_logo->documentElement,'header_logo');
				$logo_width = find_xml_value($cp_logo->documentElement,'logo_width');
				$logo_height = find_xml_value($cp_logo->documentElement,'logo_height');
				$select_layout_cp = find_xml_value($cp_logo->documentElement,'select_layout_cp');
				$boxed_scheme = find_xml_value($cp_logo->documentElement,'boxed_scheme');
				$select_bg_pat = find_xml_value($cp_logo->documentElement,'select_bg_pat');
				$color_scheme = find_xml_value($cp_logo->documentElement,'color_scheme');
				$color_anchor = find_xml_value($cp_logo->documentElement,'color_anchor');
				$bg_scheme = find_xml_value($cp_logo->documentElement,'bg_scheme');
				$body_patren = find_xml_value($cp_logo->documentElement,'body_patren');
				$color_patren = find_xml_value($cp_logo->documentElement,'color_patren');
				$body_image = find_xml_value($cp_logo->documentElement,'body_image');
				$position_image_layout = find_xml_value($cp_logo->documentElement,'position_image_layout');
				$image_repeat_layout = find_xml_value($cp_logo->documentElement,'image_repeat_layout');
				$image_attachment_layout = find_xml_value($cp_logo->documentElement,'image_attachment_layout');
				$topcart_icon = find_xml_value($cp_logo->documentElement,'topcart_icon');
				$header_css_code = find_xml_value($cp_logo->documentElement,'header_css_code');
				$google_webmaster_code = find_xml_value($cp_logo->documentElement,'google_webmaster_code');
				$phone_contact_header = find_xml_value($cp_logo->documentElement,'phone_contact_header');
				$social_network_header = find_xml_value($cp_logo->documentElement,'social_network_header');
				$top_count_header = find_xml_value($cp_logo->documentElement,'top_count_header');
				$countd_event_category = find_xml_value($cp_logo->documentElement,'countd_event_category');
				$copyright_code = find_xml_value($cp_logo->documentElement,'copyright_code');
//				$homepage_layout_on = find_xml_value($cp_logo->documentElement,'homepage_layout_on');
//				$section_select_background = find_xml_value($cp_logo->documentElement,'section_select_background');
//				$section_scheme = find_xml_value($cp_logo->documentElement,'section_scheme');
//				$section_patren = find_xml_value($cp_logo->documentElement,'section_patren');
//				$section_body_patren = find_xml_value($cp_logo->documentElement,'section_body_patren');
//				$home_page_layout = find_xml_value($cp_logo->documentElement,'home_page_layout');
				$footer_banner = find_xml_value($cp_logo->documentElement,'footer_banner');
				$footer_col_layout = find_xml_value($cp_logo->documentElement,'footer_col_layout');
				$phone_contact = find_xml_value($cp_logo->documentElement,'phone_contact');
				$social_networking = find_xml_value($cp_logo->documentElement,'social_networking');
				//$footer_logo = find_xml_value($cp_logo->documentElement,'footer_logo');
				//$footer_logo_width = find_xml_value($cp_logo->documentElement,'footer_logo_width');
				//$footer_logo_height = find_xml_value($cp_logo->documentElement,'footer_logo_height');
				//$footer_layout = find_xml_value($cp_logo->documentElement,'footer_layout');
				$consumer_key = find_xml_value($cp_logo->documentElement,'consumer_key');
				$consumer_secret = find_xml_value($cp_logo->documentElement,'consumer_secret');
				$user_token = find_xml_value($cp_logo->documentElement,'user_token');
				$user_secret = find_xml_value($cp_logo->documentElement,'user_secret');
				$twitter_id = find_xml_value($cp_logo->documentElement,'twitter_id');
				$breadcrumbs = find_xml_value($cp_logo->documentElement,'breadcrumbs');
				$rtl_layout = find_xml_value($cp_logo->documentElement,'rtl_layout');
				$tf_username = find_xml_value($cp_logo->documentElement,'tf_username');
				$tf_sec_api = find_xml_value($cp_logo->documentElement,'tf_sec_api');
			}

//Social Networking
				$facebook_network = '';
				$twitter_network = '';
				$delicious_network = '';
				$google_plus_network = '';
				$su_network = '';
				$linked_in_network = '';
				$digg_network = '';
				$myspace_network = '';
				$reddit_network = '';
				$youtube_network = '';
				$flickr_network = '';
				$picasa_network = '';
				$vimeo_network = '';
				$pinterest_network = '';
				
				$cp_social_settings = get_option('social_settings');
				if($cp_social_settings <> ''){
					$cp_social = new DOMDocument ();
					$cp_social->loadXML ( $cp_social_settings );
					//Social Networking Values
					$facebook_network = find_xml_value($cp_social->documentElement,'facebook_network');
					$twitter_network = find_xml_value($cp_social->documentElement,'twitter_network');
					$delicious_network = find_xml_value($cp_social->documentElement,'delicious_network');
					$google_plus_network = find_xml_value($cp_social->documentElement,'google_plus_network');
					//$su_network = find_xml_value($cp_social->documentElement,'su_network');
					$linked_in_network = find_xml_value($cp_social->documentElement,'linked_in_network');
					//$digg_network = find_xml_value($cp_social->documentElement,'digg_network');
					//$myspace_network = find_xml_value($cp_social->documentElement,'myspace_network');
					//$reddit_network = find_xml_value($cp_social->documentElement,'reddit_network');
					$youtube_network = find_xml_value($cp_social->documentElement,'youtube_network');
					$flickr_network = find_xml_value($cp_social->documentElement,'flickr_network');
					//$picasa_network = find_xml_value($cp_social->documentElement,'picasa_network');
					$vimeo_network = find_xml_value($cp_social->documentElement,'vimeo_network');
					$pinterest_network = find_xml_value($cp_social->documentElement,'pinterest_network');
					
				}			
?>
<!--[if IE]>
    <script type="text/javascript" src="<?php echo CP_PATH_URL?>/frontend/js/xcanvas.compiled.js"></script>
<![endif]--> 

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php
global $post_id,$post;
$facebook_class = '';
if($post <> ''){
	$facebook_class = get_post_meta ( $post->ID, "page-option-item-facebook-selection", true );
}
if($facebook_class == 'Yes'){$facebook_class = 'mywrapper';}
wp_head(); ?>
</head>

<body id="home" <?php body_class( $facebook_class ); ?>>

<div class="wrapper <?php if($select_layout_cp == 'full_layout'){echo 'full_layout';}else{echo 'boxed_main';}?>">
  <!-- header -->
	<header id="header">
	<?php if($social_network_header == 'enable'){?>
			<section class="top_bar">
				<section class="container-fluid container">
					<section class="row-fluid">
						<article class="span3 first">
							<?php echo $phone_contact_header;?>
						</article>
						<article class="span7"> 		
							<ul class="social">
								<?php if($pinterest_network <> ''){?><li> <a href="<?php echo $pinterest_network;?>" class="s8"><?php _e('Pintrest','crunchpress');?></a></li><?php }?>
								<?php if($youtube_network <> ''){?><li> <a href="<?php echo $youtube_network;?>" class="s7"><?php _e('Youtube','crunchpress');?></a></li><?php }?>
								<?php if($vimeo_network <> ''){?><li> <a href="<?php echo $vimeo_network;?>" class="s6"><?php _e('Vimeo','crunchpress');?></a> </li><?php }?>
								<?php if($twitter_network <> ''){?><li> <a href="<?php echo $twitter_network;?>" class="s5"><?php _e('Twitter','crunchpress');?></a> </li><?php }?>
								<?php if($flickr_network <> ''){?><li> <a href="<?php echo $flickr_network;?>" class="s3"><?php _e('Flicker','crunchpress');?></a> </li><?php }?>
								<?php if($facebook_network <> ''){?><li> <a href="<?php echo $facebook_network;?>" class="s1"><?php _e('Facebook','crunchpress');?></a></li><?php }?>
							</ul>
						</article>
						<article class="span2 pull-right cart_baskit"> 
						<?php 
						if(class_exists("Woocommerce")){
							if($topcart_icon == 'enable'){
							global $post,$post_id,$product,$woocommerce;	
							$currency = get_woocommerce_currency_symbol();?>
								<div class="c-btn">
									<ul data-success="Product added" class="cart_dropdown">
										<li class="cart_dropdown_first">
											<div class="dropdown" id="cart_dropdown">
												<i class="icon-shopping-cart"></i><span><?php _e('Cart','crunchpress');?></span></a>
												<?php 
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
														<span class="pull-left col1"><?php _e('Total','crunchpress');?> <?php echo $currency;?> </span> 
														<span class="pull-left col1"><?php echo $woocommerce->cart->subtotal;?></span>
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
										</li>
									</ul>
									<div class="btn-group">
										<div id="get_count_head"><span id="count_head" class="count"><?php echo $woocommerce->cart->cart_contents_count;?></span><?php _e('items','crunchpress');?></div>
									</div>            
								</div>
								<?php 
								}
							}?>
						</article>
					</section>
				</section>	
			</section>
			<?php }?>
			<section class="logo_container">
				<section class="container-fluid container">
					<section class="row-fluid">
						<section class="span4 <?php if($rtl_layout == 'enable'){echo 'pull-right';}?>">
							<h1 id="logo">
							  <?php
								//Print Logo
								$image_src = '';
								if(!empty($header_logo)){ 
									$image_src = wp_get_attachment_image_src( $header_logo, 'full' );
									$image_src = (empty($image_src))? '': $image_src[0];			
								}?>
								<a href="<?php echo home_url(); ?>">
									<img class="logo_img" width="<?php echo $logo_width;?>" height="<?php echo $logo_height;?>" src="<?php if($image_src <> ''){echo $image_src;}else{echo CP_PATH_URL.'/images/logo.png';}?>" alt="<?php echo bloginfo( 'name' )?>">
								</a>
							</h1>
						</section>
						<section class="span6 <?php if($rtl_layout <> 'enable'){echo 'pull-right';}?>">
							<figure class="charity_counter_wrapper">
								<?php
								if($top_count_header == 'enable'){
									$event_social = '';
									$sidebar = '';
									$left_sidebar = '';
									$right_sidebar = '';
									$event_start_time = '';
									$event_end_time = '';
									$booking_url = '';
									$event_location_select = '';
									$event_start_date = '';
									$event_end_date = '';
									$event_start_date = get_post_meta($countd_event_category, 'event_start_date', true);
									$event_end_date = get_post_meta($countd_event_category, 'event_end_date', true);
									$event_detail_xml = get_post_meta($countd_event_category, 'event_detail_xml', true);
									if($event_detail_xml <> ''){
										$cp_event_xml = new DOMDocument ();
										$cp_event_xml->loadXML ( $event_detail_xml );
										$event_social = find_xml_value($cp_event_xml->documentElement,'event_social');
										$sidebar = find_xml_value($cp_event_xml->documentElement,'sidebar_event');
										$left_sidebar = find_xml_value($cp_event_xml->documentElement,'left_sidebar_event');
										$right_sidebar = find_xml_value($cp_event_xml->documentElement,'right_sidebar_event');
										$event_start_time = find_xml_value($cp_event_xml->documentElement,'event_start_time');
										$event_end_time = find_xml_value($cp_event_xml->documentElement,'event_end_time');
										$booking_url = find_xml_value($cp_event_xml->documentElement,'booking_url');
										$event_location_select = find_xml_value($cp_event_xml->documentElement,'event_location_select');
										
										$event_year = date('Y',strtotime($event_start_date));
										$event_month = date('m',strtotime($event_start_date));
										$event_month_alpha = date('M',strtotime($event_start_date));
										$event_day = date('d',strtotime($event_start_date));
										
										//Change time format
										$event_start_time = date("h,i,s", strtotime($event_start_time));	
									}
									if($countd_event_category <> ''){
										wp_register_script('countdown', CP_PATH_URL.'/frontend/js/jquery_countdown.js', false, '1.0', true);
										wp_enqueue_script('countdown'); ?>
										<script>
											jQuery(function () {
												var austDay = new Date();
												austDay = new Date(<?php echo $event_year;?>, <?php echo $event_month;?>-1, <?php echo $event_day;?>,<?php echo $event_start_time;?>)
												jQuery('#countdown<?php echo $countd_event_category;?>').countdown({
												labels: ['<?php _e('Years','crunchpress');?>', '<?php _e('Months','crunchpress');?>', '<?php _e('Weeks','crunchpress');?>', '<?php _e('Days','crunchpress');?>', '<?php _e('Hours','crunchpress');?>', '<?php _e('Minutes','crunchpress');?>', '<?php _e('Seconds','crunchpress');?>'],
												until: austDay
												});
												jQuery('#year').text(austDay.getFullYear());
											});                
										</script>
										<section class="span5 <?php if($rtl_layout == 'enable'){echo 'pull-right';}?>">
											<div class="charity_title ">
												<?php echo wordwrap(get_the_title($countd_event_category), 15, "<br />\n");?>
											</div>
										</section>
										<section class="span1 event_more <?php if($rtl_layout <> 'enable'){echo 'pull-right';}?>"> <a href="<?php echo get_permalink($countd_event_category);?>"> <i class="icon">+</i>  </a> </section>
										<section class="span6 counter_bg <?php if($rtl_layout <> 'enable'){echo 'pull-right';}?>">
											<div id="countdown<?php echo $countd_event_category;?>" class="tCountdOwn"></div>
										</section>
									<?php }
								}
								?>
							</figure>
						</section>
					</section>
				</section>
			</section>
		<?php if($select_layout_cp == 'full_layout'){echo '<nav id="nav">';}?>
			<section class="container-fluid container">
				<section class="row-fluid">
				<?php if($select_layout_cp == 'boxed_layout'){echo '<nav style="float:left;"id="nav">';}?>
					<div class="navbar navbar-inverse <?php if($rtl_layout == 'enable'){echo 'pull-right';}?>">
						<div class="navbar-inner">
						<!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
						<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
						<?php 
										// Menu parameters		
										$defaults = array(
										  'theme_location'  => 'top-menu',
										  'menu'            => '', 
										  'container'       => '', 
										  'container_class' => 'menu-{menu slug}-container', 
										  'container_id'    => '',
										  'menu_class'      => 'nav', 
										  'menu_id'         => 'menusection',
										  'echo'            => true,
										  'fallback_cb'     => '',
										  'before'          => '',
										  'after'           => '',
										  'link_before'     => '',
										  'link_after'      => '',
										  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										  'depth'           => 0,
										  'walker'          => '',);				
										if(has_nav_menu('top-menu')){?>		
											<div id="mymenu" class="desktop_view nav-collapse collapse">
											<?php wp_nav_menu( $defaults);?>
											</div>
										<?php }else{
											$args = array(
												'sort_column' => 'menu_order, post_title',
												'menu_class'  => 'nav',
												'include'     => '',
												'exclude'     => '',
												'echo'        => true,
												'show_home'   => false,
												 'menu'            => '', 
										  'container'       => '', 
												'link_before' => '',
												'link_after'  => '' );?>
												<div id="custom_menu_cp" class="desktop_view nav-collapse collapse">
													<?php wp_page_menu( $args ); ?>                
												</div>
										<?php } ?>
					<!--/.nav-collapse -->
						</div>
				  <!-- /.navbar-inner -->
					</div>
				<!-- /.navbar -->
			<?php if($select_layout_cp == 'boxed_layout'){echo '</nav>';}?>	
				<div class="nav_search pull-right"> <form method="post" action="<?php  echo home_url(); ?>/"> <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" /> <button type="submit"><i class="icon-search"></i> </button></form></div>
				</section>
			</section>
		<?php if($select_layout_cp == 'full_layout'){echo '</nav>';}?>	
	</header>