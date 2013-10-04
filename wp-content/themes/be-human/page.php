<?php
/*
 * This file is used to generate different page layouts set from backend.
 */
get_header ();
global $post,$post_id;
        $sidebar = get_post_meta ( $post->ID, 'page-option-sidebar-template', true );
        $sidebar_class = '';
		$content_class = '';
        $sidebar_class = sidebar_func($sidebar);

		$slider_off = '';
		$slider_type = '';
		$slider_slide = '';
		$slider_height = '';
		
		$left_sidebar = get_post_meta ( $post->ID, "page-option-choose-left-sidebar", true );
		$right_sidebar = get_post_meta ( $post->ID, "page-option-choose-right-sidebar", true );
		$slider_off = get_post_meta ( $post->ID, "page-option-top-slider-on", true );
		$slider_type = get_post_meta ( $post->ID, "page-option-top-slider-types", true );
	
		
		$select_layout_cp = '';
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$select_layout_cp = find_xml_value($cp_logo->documentElement,'select_layout_cp');
			
			
		}
		
		if($select_layout_cp == 'full_layout'){
			//Slider Condition
			if($slider_off == 'Yes'){
					echo page_slider();
			}
		}
	
			
			
	?>
	
	
	<div id="progress_news" class="mbtm">
		<div class="container-fluid container <?php if($select_layout_cp == 'boxed_layout'){echo 'boxed';}?>	">
		<?php
			if($select_layout_cp == 'boxed_layout'){
				if($slider_off == 'Yes'){
					echo page_slider();
				}
			}
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(1170,420) );
			if($thumbnail[1].'x'.$thumbnail[2] == '1170x420'){?>
				<div class="fulwidth_featured"><?php echo get_the_post_thumbnail($post->ID, array(1170,420));?></div>
			<?php }?>
			<section id="blockContainer" class="row-fluid">
			<?php
				if(!is_front_page()){
					breadcrumbs_html();
				}
			?>
				<section class="page_content row-fluid">
					<?php
					if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){?>
						<div id="block_first" class="sidebar <?php echo $sidebar_class[0];?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-left'){?>
					<div id="block_first_left" class="sidebar <?php echo $sidebar_class[0];?>">
						<?php dynamic_sidebar( $right_sidebar );?>
					</div>
					<?php } ?>
					<div id="block_content_first" class="<?php echo $sidebar_class[1];?>">
							<?php
							
							$cp_page_xml = get_post_meta($post->ID,'page-option-item-xml', true);
								global $cp_item_row_size;
								$cp_item_row_size = 0;	
								$counter = 0;
								// Page Item Part
								if (! empty ( $cp_page_xml )) {
									$page_xml_val = new DOMDocument ();
									$page_xml_val->loadXML ( $cp_page_xml );
									foreach ( $page_xml_val->documentElement->childNodes as $item_xml ) {
										$counter++;
										switch ($item_xml->nodeName) {
											case 'Accordion' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_accordion_item ( $item_xml );
												echo '</article>';
												break;
											case 'Blog' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												print_blog_item ( $item_xml );
												echo '</article>';
												break;
												case 'News-Slider' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												print_news_slider_box ( $item_xml );
												echo '</article>';
												break;
											case 'Events' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												print_event_item ( $item_xml );
												echo '</article>';
												break;
											case 'Product-Listing' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												if(class_exists("Woocommerce")){
													print_wooproduct_item ( $item_xml );
												}	
												echo '</article>';
												break;
											case 'Crowd-Funding' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												if(class_exists("Product_Widget")){
													print_ignition_item ( $item_xml );
												}
												echo '</article>';
												break;
											case 'Product-Slider' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												print_woo_product_slider_item ( $item_xml );
												echo '</article>';
												break;	
											case 'Feature-Product' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												if(class_exists("Woocommerce")){
													print_woo_product_feature_item ( $item_xml );
												}	
												echo '</article>';
												break;
											case 'Charity-Events' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ),'mbtm');
												print_charity_events_item ( $item_xml );
												echo '</article>';
												break;
											case 'Blog-Slider' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												print_blog_item_item ( $item_xml );
												echo '</article>';
												break;	
											case 'Feature-Project' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ),'charity_progress');
												if(class_exists("Product_Widget")){
													print_funds_item_item ( $item_xml );
												}
												echo '</article>';
												break;		
											case 'News' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												print_news_item ( $item_xml );
												echo '</article>';
												break;
											case 'Our-Team' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												print_team_item ( $item_xml );
												echo '</article>';
												break;
											case 'Contact-Form' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'mt0' );
												print_contact_form ( $item_xml );
												echo '</article>';
												break;
											case 'Column' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_column_item ( $item_xml );
												echo '</article>';
												break;
											case 'Services' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ),'feature' );
												print_column_service ( $item_xml );
												echo '</article>';
												break;
											case 'Content' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_content_item ( $item_xml );
												echo '</article>';
												break;
											case 'Divider' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'wrapper' );
												print_divider ( $item_xml );
												echo '</article>';
												break;
											case 'Gallery' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ),'overflow_class');
												print_gallery_item ( $item_xml );
												echo '</article>';
												break;
											case 'Message-Box' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_message_box ( $item_xml );
												echo '</article>';
												break;
											case 'Slider' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'containter_slider' );
												print_slider_item ( $item_xml );
												echo '</article>';
												break;
											case 'Tab' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_tab_item ( $item_xml );
												echo '</article>';
												break;
											case 'Testimonial' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												print_testimonial ( $item_xml );
												echo '</article>';
												break;
											case 'Toggle-Box' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_toggle_box_item ( $item_xml );
												echo '</article>';
												break;
											case 'DonateNow' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_donate_item ( $item_xml );
												echo '</article>';
												break;	
											case 'Venue' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_venue_item ( $item_xml );
												echo '</article>';
												break;		
											case 'Career' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_career_item ( $item_xml );
												echo '</article>';
												break;	
											default :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												echo '</article>';
												break;
										}
										
									}
								}else{
									print_default_content_item();
								}
		            	   ?>
					 </div>
					<?php
					if($sidebar == "both-sidebar-right"){?>
						<div id="block_second" class="sidebar <?php echo $sidebar_class[0];?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-right' || $sidebar == "right-sidebar" || $sidebar == "both-sidebar"){?>
						<div id="block_second_right" class="sidebar <?php echo $sidebar_class[0];?>">
							<?php dynamic_sidebar( $right_sidebar );?>
						</div>
					<?php } ?>						   
								
				</section>
			</section>
		</div>
	</div>
<div class="clear"></div>
<div style="display:none;">
<?php
//Navigation functions
posts_nav_link();
paginate_links();
next_posts_link();
previous_posts_link() 
?>
</div>
<?php get_footer(); ?>