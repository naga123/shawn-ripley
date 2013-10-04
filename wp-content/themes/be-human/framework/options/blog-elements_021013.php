<?php

	/*
	*	CrunchPress Blog Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each blog item in 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/
	
	// size is when no sidebar, side2 is use when 1 sidebar, side 3 is use when 3 sidebar
	if( $cp_is_responsive ){
		$blog_div_listing_num_class = array(
			"Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1170,420), "size2"=>array(770, 265), "size3"=>array(570,300)),
			"Small-Thumbnail" => array("index"=>"2", "class"=>"sixteen", "size"=>array(175,155), "size2"=>array(175,155), "size3"=>array(175,155)));
	}	
	
	// Print blog item
	function print_blog_item($item_xml){

		wp_reset_query();
		?>
		<div id="content">
		<?php
		global $paged,$post,$sidebar,$blog_div_listing_num_class,$counter,$post_id;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
				
		// get the blog meta value		
		$header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'category');
			$category = $category_term->slug;
		}
		// print header
		if(!empty($header)){
		?>
		<figure id="page_title">
			<div class="span8 first">
				<h2><?php echo $header;?></h2>
			</div>
			<div class="span4 title_right">
				<div id="cart_dropdown" class="dropdown">
					<a href="#" id="cart_down" role="button" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-ticket"></i>
						<?php _e('Blog Categories','crunchpress');?>
						<span class="caret"></span>
					</a>
					<div id="listing_dropdown" role="menu" aria-labelledby="cart_down" class="dropdown-menu">
						<ul>                    
							<?php
							$get_categories = get_categories( array('child_of' => $category, 'taxonomy' => 'category', 'hide_empty' => 0,'post_status' => 'publish') );
							if($get_categories <> ""){
								foreach ( $get_categories as $mycat ) { ?>
									<li><?php echo $mycat->cat_name;?><a href="<?php echo get_term_link(intval($mycat->term_id),'category');?>"><?php echo $mycat->count;?></a></li>
								<?php
								}
							}
							?>					
						</ul>
					</div>
				</div>
			</div>	
		</figure>
			<?php
		}
		
		// start fetching database
		query_posts(array('post_type'=>'post', 'paged'=>$paged,'category_name'=>$category, 'posts_per_page'=>$num_fetch,'order'	=> 'DESC' ));
		
		while( have_posts() ){
		the_post();
		global $post, $post_id;
		$thumbnail_types = '';
		$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
		if($post_detail_xml <> ''){
			$cp_post_xml = new DOMDocument ();
			$cp_post_xml->loadXML ( $post_detail_xml );
			$thumbnail_types = find_xml_value($cp_post_xml->documentElement,'post_thumbnail');		
		}
		//Print Blog Listing?>
		
		<?php
			  // get the item class and size from array
			$item_type = 'Full-Image';
			$item_class = $blog_div_listing_num_class[$item_type]['class'];
			$item_index = $blog_div_listing_num_class[$item_type]['index'];
			if( $sidebar == "no-sidebar" ){
				$item_size = $blog_div_listing_num_class[$item_type]['size'];
			}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
				$item_size = $blog_div_listing_num_class[$item_type]['size2'];
			}else{
				$item_size = $blog_div_listing_num_class[$item_type]['size3'];
				$item_class = 'both_sidebar_class';
			}?>	 
				<figure class="blog_item">
					<div class="gallery_img gallery_img-first">
						<?php print_blog_thumbnail($post->ID,$item_size);?>
						
					</div>  
					<div class="outer_lyr span12 first">
						<div class="inner_lyr">
							<div class="span3 first post_meta"> 
								<ul>
									<li class="date"> <i class="icon-time"></i>  <?php echo date(get_option('date_format'),strtotime(get_the_date()));?></li>
									<li class="author"><i class="icon-user"></i> by   <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_link();?></a></li>
									<li class="commetns"> <i class="icon-comment"></i>  <?php comments_popup_link( __('0 Comment','cp_front_end'),__('1 Comment','cp_front_end'),__('% Comments','cp_front_end'), '',__('Comments are off','cp_front_end') );?></li>
									<!--<li class="tags"> <i class="icon-tags"></i><a href="#"> Charity , Donation, Food, Free Education </a></li>-->
									<li class="category"> <i class="icon-reorder"></i>
									<?php 
									$variable = wp_get_post_terms( $post->ID, 'category'); $counterr = 0;
									foreach($variable as $values){
										//if($counterr == 0){ echo 'Category:  ';}
										$counterr++;
										echo '<a href="'.get_term_link(intval($values->term_id),'category').'">'.$values->name.'</a>  ';}?>
									</li>
								</ul>						
							</div>
							<div class="span9 post_description"> 
								<h3><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h3>
								<?php echo substr(get_the_excerpt(),0, $num_excerpt);?>
								<br />
								<?php if(strlen(get_the_excerpt() > $num_excerpt)){?><a class="read_more" href="<?php echo get_permalink()?>"><em><?php echo __('Read More','cp_front_end') ?></em></a><?php }?>
							</div>
						</div>
					</div>
				</figure>
		<?php
		}//end while
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}
		?>
		</div>
		<?php
		echo '<div id="loader"></div>';
		
	
	}	
	
	// print the blog thumbnail
	function print_blog_thumbnail( $post_id, $item_size ){
		global $counter;
		//Get Post Meta Options
		$thumbnail_types = '';
		$video_url_type = '';
		$select_slider_type = '';
		$post_detail_xml = get_post_meta($post_id, 'post_detail_xml', true);
		if($post_detail_xml <> ''){
			$cp_post_xml = new DOMDocument ();
			$cp_post_xml->loadXML ( $post_detail_xml );
			$thumbnail_types = find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
			$video_url_type = find_xml_value($cp_post_xml->documentElement,'video_url_type');
			$select_slider_type = find_xml_value($cp_post_xml->documentElement,'select_slider_type');			
			//Print Image
			if( $thumbnail_types == "Image" || empty($thumbnail_types) ){
				echo '<div class="post_featured_image thumbnail_image">';
					echo get_the_post_thumbnail($post_id, $item_size);
				echo '</div>';
				echo '<div class="mask"><a href="'.get_permalink().'"#comments" class="anchor"><span> </span> <i class="icon-comment"></i></a><a href="'. get_permalink().'" class="anchor"> <i class="icon-link"></i></a></div>';
			}else if( $thumbnail_types == "Video" ){
				//Print Video
				echo '<div class="post_featured_image thumbnail_image">';
					echo '<div class="blog-thumbnail-video">';
					if(cp_get_width($item_size) == '175'){
						echo get_video($video_url_type, cp_get_width($item_size), cp_get_height($item_size));
					}else{
						echo get_video($video_url_type, '100%', cp_get_height($item_size));
					}
					echo '</div>';
				echo '</div>';
				
			}else if ( $thumbnail_types == "Slider" ){
				//Print Slider
				$slider_xml = get_post_meta( intval($select_slider_type), 'cp-slider-xml', true); 				
				if($slider_xml <> ''){
					$slider_xml_dom = new DOMDocument();
					$slider_xml_dom->loadXML($slider_xml);
					$slider_name='anything'.$counter.$post_id;				
					//Included Anything Slider Script/Style
					wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
					wp_enqueue_script('cp-bx-slider');	
					wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
					if(cp_get_width($item_size) == '175'){?>
						<style>
							#<?php echo $slider_name;?>{							
							width:<?php echo cp_get_width($item_size);?>px;
							height:<?php echo cp_get_height($item_size);?>px;
							float:left;
							}
						</style>					
					<?php }else{ ?>
							<style>
							#<?php echo $slider_name;?>{							
							width:100% !important;
							height:350px !important;
							float:left;
							}
							</style>
					<?php
						}
						echo '<div class="post_featured_image thumbnail_image">';
							echo print_bx_slider($slider_xml_dom->documentElement, $item_size);
						echo '</div>';
				}
			
			}	
		}
	}
	

	function print_news_item($item_xml){

		wp_reset_query();
		echo '<div id="content">';
		global $paged,$post,$sidebar,$blog_div_listing_num_class,$post_id;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		//Get Thumbnail Options
		$thumbnail_types = '';
		$post_detail_xml = get_post_meta($post_id, 'post_detail_xml', true);
		if($post_detail_xml <> ''){
			$cp_post_xml = new DOMDocument ();
			$cp_post_xml->loadXML ( $post_detail_xml );
			$thumbnail_types = find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
		}
				
		// get the blog meta value		
		$header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'category');
			$category = $category_term->slug;
		}

		// print header
		if(!empty($header)){
			echo '<h2 class="heading">' . $header . '</h2><span class="border-line m-bottom"></span>';
		}
		
		// start fetching database
		query_posts(array('post_type'=>'post', 'paged'=>$paged,
			 'category_name'=>$category, 'posts_per_page'=>$num_fetch,  'order'	=> 'DESC' ));
		
		$counter_news = 0;
		while( have_posts() ){
			the_post();
			$counter_news++;
			global $post, $post_id;
		?>
		<article id="press_release" class="related_artiles press_release">
		<?php
			  // get the item class and size from array
			$item_type = 'Full-Image';
			$item_class = $blog_div_listing_num_class[$item_type]['class'];
			$item_index = $blog_div_listing_num_class[$item_type]['index'];
			if( $sidebar == "no-sidebar" ){
				$item_size = $blog_div_listing_num_class[$item_type]['size'];
			}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
				$item_size = $blog_div_listing_num_class[$item_type]['size2'];
			}else{
				$item_size = $blog_div_listing_num_class[$item_type]['size3'];
				$item_class = 'both_sidebar_class';
			}
			?>
		  <div class="related_article_text_only text-divider4">
		  
			<div class="related_tile_social_wrapper">
				<h2 class="title2"><a class="related_text_link" href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
				<div class="blog-bottom">
			  <ul class="b-top-links">
				<li><span class="font_aw small_size"><i class="icon-time"></i></span><?php echo get_the_date(get_option('date_format'));?></li>
				<li class="author-name"><span class="font_aw small_size"><i class="icon-user"></i></span><?php echo get_the_author_link();?></li>
				<li class="comments2"><span class="font_aw small_size"><i class="icon-comments"></i></span>
				<?php
				comments_popup_link( __('0 Comment','cp_front_end'),
				__('1 Comment','cp_front_end'),
				__('% Comments','cp_front_end'), '',
				__('Comments are off','cp_front_end') );
				?>
				</li>
				<li class="design-icon"><span class="font_aw small_size"><i class="icon-reorder"></i></span><?php 
				$variable = wp_get_post_terms( $post->ID, 'category'); $counterr = 0;
				foreach($variable as $values){
					//if($counterr == 0){ echo 'Category:  ';}
					$counterr++;
					echo '<a href="'.get_term_link(intval($values->term_id),'category').'">'.$values->name.'</a>  ';}?>
				</li>
			  </ul>
			</div>
			</div>
			<p><?php echo mb_substr( get_the_excerpt(), 0, $num_excerpt ) ;?></p>
		  </div>
		</article>
		<div class="clear"></div>
		<?php
		}//end while
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}	
		echo '</div>';
		echo '<span id="loader"></span>';
		
	
	}	
?>