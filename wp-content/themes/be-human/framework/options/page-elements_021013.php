<?php

	/*
	*	CrunchPress Page Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each page item in 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/

	// Print the item size <div> with it's class
	function print_item_size($item_size, $addition_class=''){
		global $cp_item_row_size;
		$cp_item_row_size = (empty($cp_item_row_size))? 'first': $cp_item_row_size;
		if($cp_item_row_size >= 1){
			$cp_item_row_size = 'first';
		}
		
		switch($item_size){
			case 'element1-4':
				echo '<article class="span3 mbtm ' . $addition_class .' ' .$cp_item_row_size. '">';
				$cp_item_row_size += 1/4; 
				break;
			case 'element1-3':
				echo '<article class="span4 mbtm ' . $addition_class .' ' .$cp_item_row_size. '">';
				$cp_item_row_size += 1/3; 
				break;
			case 'element1-2':
				echo '<article class="span6 mbtm ' . $addition_class .' ' .$cp_item_row_size. '">';
				$cp_item_row_size += 1/2; 
				break;
			case 'element2-3':
				echo '<article class="span8 mbtm ' . $addition_class .' ' .$cp_item_row_size. '">';
				$cp_item_row_size += 2/3; 
				break;
			case 'element3-4':
				echo '<article class="span9 mbtm ' . $addition_class .' ' .$cp_item_row_size. '">';
				$cp_item_row_size += 3/4; 
				break;
			case 'element1-1':
				echo '<article class="span12 mbtm ' . $addition_class .' ' .$cp_item_row_size. '">';
				$cp_item_row_size += 1; 
				break;	
		}
		
	}
	
	// Print column 
	function print_column_item($item_xml){
		echo do_shortcode(html_entity_decode(find_xml_value($item_xml,'column-text')));
	}

	if( $cp_is_responsive ){
		$gallery_div_size_listing_class = array(
			'4 Column' => array( 'class'=>'span3', 'class2'=>'col4_gallery_one_sidebar','class3'=>'col4_gallery_two_sidebar','size'=>array(175,155),'size2'=>array(175,155),'size3'=>array(175,155)),
			'3 Column' => array( 'class'=>'span4', 'class2'=>'col3_gallery_one_sidebar','class3'=>'col3_gallery_two_sidebar','size'=>array(175,155),'size2'=>array(175,155),'size3'=>array(175,155)),
			'2 Column' => array( 'class'=>'span6', 'class2'=>'span4','class3'=>'span3','size'=>array(175,155),'size2'=>array(175,155),'size3'=>array(175,155)),
		); 	
	}else{
		$gallery_div_size_listing_class = array(
			'4 Column' => array( 'class'=>'span3', 'class2'=>'col4_gallery_one_sidebar','class3'=>'col4_gallery_two_sidebar','size'=>array(175,155),'size2'=>array(175,155),'size3'=>array(175,155)),
			'3 Column' => array( 'class'=>'span4', 'class2'=>'col3_gallery_one_sidebar','class3'=>'col3_gallery_two_sidebar','size'=>array(175,155),'size2'=>array(175,155),'size3'=>array(175,155)),
			'2 Column' => array( 'class'=>'span6', 'class2'=>'span4','class3'=>'span3','size'=>'','size2'=>'','size3'=>''),
		); 			
	}
	// Print gallery
	function print_gallery_item($item_xml){
	
		global $gallery_div_size_listing_class;
		global $paged,$sidebar,$post_id,$wp_query;		

		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		$gal_counter = '';
		$header = find_xml_value($item_xml, 'header');
		$gallery_page = find_xml_value($item_xml, 'page');
		$gallery_size = find_xml_value($item_xml, 'item-size');
		$num_size = find_xml_value($item_xml, 'num-size');
		if($gallery_size == '2 Column'){$gal_counter = 2;}else if($gallery_size == '3 Column'){$gal_counter = 3;}else if($gallery_size == '4 Column'){$gal_counter = 4;}else{}
		$gallery_class = $gallery_div_size_listing_class[$gallery_size]['class'];
			if( $sidebar == "no-sidebar" || $sidebar == ''){
				$gallery_class = $gallery_div_size_listing_class[$gallery_size]['class'];
				$item_size = $gallery_div_size_listing_class[$gallery_size]['size'];
			}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
				$gallery_class = $gallery_div_size_listing_class[$gallery_size]['class'];
				$item_size = $gallery_div_size_listing_class[$gallery_size]['size2'];
			}else{
				$gallery_class = $gallery_div_size_listing_class[$gallery_size]['class'];
				$item_size = $gallery_div_size_listing_class[$gallery_size]['size3'];
			}
		
		
		if(!empty($header)){
			echo '<h2 class="heading">' . $header . '</h2>';
			echo '<span class="border-line m-bottom"></span>';
		}

		//$gallery_post = get_posts(array('posts_per_page' => 1, 'post_type' => 'gallery', 'name'=>$gallery_page, 'numberposts'=> 2));
		wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/js/jquery.prettyphoto.js', false, '1.0', true);
		wp_enqueue_script('prettyPhoto');

		wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/js/pretty_script.js', false, '1.0', true);
		wp_enqueue_script('cp-pscript');	
		
		wp_enqueue_style('prettyPhoto',CP_PATH_URL.'/frontend/css/prettyphoto.css');
		if($gallery_page <> ''){
		$slider_xml_string = get_post_meta($gallery_page,'post-option-gallery-xml', true);
			if($slider_xml_string <> ''){
			$slider_xml_dom = new DOMDocument();
				if( !empty( $slider_xml_string ) ){
					$slider_xml_dom->loadXML($slider_xml_string);	
					?>
					<ul class="gallery gallery-page">
					<?php						
					$children = $slider_xml_dom->documentElement->childNodes;
					if ( empty($wp_query->query['paged']) ) $wp_query->query['paged'] = 1;
								$total_page = '';
								if($num_size > 0){
									$limit_start = $num_size * ($wp_query->query['paged']-1);
									$limit_end = $limit_start + $num_size;
									if ( $limit_end > $slider_xml_dom->documentElement->childNodes->length ) {
										$limit_end = $slider_xml_dom->documentElement->childNodes->length;
									}
									
									if($num_size < $slider_xml_dom->documentElement->childNodes->length){
										$total_page = ceil($slider_xml_dom->documentElement->childNodes->length/$num_size);
									}else{
										$total_page = 1;
									}
							}
							else {
								$limit_start = 0;
								$limit_end = $slider_xml_dom->documentElement->childNodes->length;
							}
					$counter_gal_element = 0;
					for($i=$limit_start;$i<$limit_end;$i++) { 
						
						$thumbnail_id = find_xml_value($children->item($i), 'image');
						$title = find_xml_value($children->item($i), 'title');
						$caption = find_xml_value($children->item($i), 'caption');
						$link_type = find_xml_value($children->item($i), 'linktype');
						$video = find_xml_value($children->item($i), 'video');
						
						$image_url = wp_get_attachment_image_src($thumbnail_id, $item_size);

						$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);	
					if($counter_gal_element % $gal_counter == 0){ ?>						
						<li class="view_new view-tenth pull-left first <?php echo $gallery_class;?>">
						<?php if( $link_type == 'Link to URL' ){
							$link = find_xml_value( $children->item($i), 'link');	?>
							<a href="<?php echo $link; ?>">
								<?php echo '<img class="cp-gallery-image" src="' . $image_thumb[0] . '" alt="' . $alt_text . '" />';?>
							</a>
						<?php }else if( $link_type == 'Lightbox' ){
							$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
							$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(570, 360));
							echo '<figure class="gal_img_container"><img class="galler-img" src="' . $image_thumb[0] . '" alt="">';
							echo '<div class="mask"><a class="image-gal info" rel="prettyPhoto[]" href="' . $image_full[0] . '"  title="' . $alt_text . '"><i class="icon-plus"></i></a></div>';
							//echo '<img class="cp-gallery-image" src="' . $image_thumb[0] . '" alt="' . $alt_text . '" />';
								// echo '<div class="text_container">';
									// echo '<h3>'.$title.'</h3>';
									// echo '<p>'.$caption.'</p>';
								// echo '</div>';
							echo '</figure>';
						}else if( $link_type == 'Video' ){
							$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
							$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(570, 360));
							echo  get_video($video,700,700);
							//echo '<div class="mask"><a class="image-gal info" rel="prettyPhoto[]" href="' . $video . '"  title="' . $title . '"><i class="icon-facetime-video"></i></a></div>';
							// echo '<a href="'.$video.'" rel="prettyPhoto" title="'.$title.'">';
								// echo '<img class="cp-gallery-image" src="' . $image_thumb[0] . '" alt="' . $alt_text . '" />';
									// echo '<div class="text_container">';
										// echo '<h3>'.$title.'</h3>';
										// echo '<p>'.$caption.'</p>';
									// echo '</div>';
							// echo '</a>';	
						}else{
							echo '<img class="cp-gallery-image" src="' . $image_thumb[0] . '" alt="' . $alt_text . '" />';
							echo '<div class="text_container">';
									echo '<h3>'.$title.'</h3>';
									echo '<p>'.$caption.'</p>';
								echo '</div>';
						}?>
						</li>
					<?php 
					}else{?>
						<li class="view_new view-tenth pull-left <?php echo $gallery_class;?>">
						<?php 
						$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(570, 360));
						if( $link_type == 'Link to URL' ){
							$link = find_xml_value( $children->item($i), 'link');	?>
							<a href="<?php echo $link; ?>">
								<?php echo '<img class="cp-gallery-image" src="' . $image_thumb[0] . '" alt="' . $alt_text . '" />';?>
							</a>
						<?php }else if( $link_type == 'Lightbox' ){
							$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
							$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(570, 360));
							echo '<figure class="gal_img_container"><img class="galler-img" src="' . $image_thumb[0] . '" alt="">';
							echo '<div class="mask"><a class="image-gal info" rel="prettyPhoto[aaa]" href="' . $image_full[0] . '"  title="' . $alt_text . '"><i class="icon-plus"></i></a></div>';
							//echo '<img class="cp-gallery-image" src="' . $image_thumb[0] . '" alt="' . $alt_text . '" />';
								// echo '<div class="text_container">';
									// echo '<h3>'.$title.'</h3>';
									// echo '<p>'.$caption.'</p>';
								// echo '</div>';
							echo '</figure>';
							
						}else if( $link_type == 'Video' ){
							$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
							$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(570, 360));
							echo  get_video($video,700,700);
							// echo '<a href="'.$video.'" rel="prettyPhoto" title="'.$title.'">';
								// echo '<img class="cp-gallery-image" src="' . $image_thumb[0] . '" alt="' . $alt_text . '" />';
									// echo '<div class="text_container">';
										// echo '<h3>'.$title.'</h3>';
										// echo '<p>'.$caption.'</p>';
									// echo '</div>';
							// echo '</a>';	
						}else{
							echo '<img class="cp-gallery-image" src="' . $image_thumb[0] . '" alt="' . $alt_text . '" />';
						}?>
						</li>
				<?php }
				$counter_gal_element++;
				}	?>
				</ul>
				<?php
				
				//pagination($pages = $total_page);
				}
			}
		}	
	}
	
	function get_gallery_image_one($post_id, $item_size){
		$thumbnail_id = get_post_thumbnail_id( $post_id );
		$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
		
		if($thumbnail[1].'x'.$thumbnail[2] == $item_size){
			echo get_the_post_thumbnail($post_id, $item_size);
		}else{
			echo get_the_post_thumbnail($post_id, 'full');
		}
	}

	function print_charity_events_item($item_xml){
		$header = find_xml_value($item_xml, 'header');
		$category = find_xml_value($item_xml, 'category');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$video_gallery = find_xml_value($item_xml, 'video-gallery');
		?>
		<div id="events_videos">
		<?php
		//$gallery_post = get_posts(array('posts_per_page' => 1, 'post_type' => 'gallery', 'name'=>$video_gallery, 'numberposts'=> 2));
		if($video_gallery <> ''){ 
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
		?>
		<script>
		jQuery(document).ready(function ($) {
			if ($('.video_slider').length) {
				$('.video_slider').bxSlider({
					minSlides: 1,
					maxSlides: 1,
					slideMargin: 25,
					speed: 500,
				});
			}
		});
		</script>
		
		<figure class="span6 first" id="video_slider">
			<h2><?php echo $header;?></h2>
			<div class="video_slider_container span8 offset2">
				<ul class="video_slider">
					<?php
					$slider_xml_string = get_post_meta($video_gallery,'post-option-gallery-xml', true);
						if($slider_xml_string <> ''){
						$slider_xml_dom = new DOMDocument();
							if( !empty( $slider_xml_string ) ){
								$slider_xml_dom->loadXML($slider_xml_string);
								foreach($slider_xml_dom->documentElement->childNodes as $items){
								
									$thumbnail_id = find_xml_value($items, 'image');
									$title = find_xml_value($items, 'title');
									$caption = find_xml_value($items, 'caption');
									$link_type = find_xml_value($items, 'linktype');
									$video = find_xml_value($items, 'video');
									
									$image_url = wp_get_attachment_image_src($thumbnail_id, array(570,300));

									$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
									
									//print_r($items);?>
									<li> 
										<div class="video">
											<?php 
											if($link_type == 'Video'){
												echo get_video($video,362,235);
											}else{ ?>
												<img src="<?php echo $image_url[0];?>" alt="<?php echo $alt_text;?>" />
											<?php }?>
											<div class="tag_line"> <?php echo $title;?> </div>
										</div>
									</li>
									<?php
								}
							}
						} ?>
				</ul>
			</div>
		</figure>

		<?php } 
		
		
		?>
		<script>
	jQuery(document).ready(function ($) {
		/* bootstrap Add class to accordion **/
		var sidebar = $('.accordion-heading'); /* cache sidebar to a variable for performance */
		sidebar.delegate('.accordion-toggle', 'click', function () {
			if ($(this).hasClass('active')) {
				$(this).removeClass('active');
				$(this).addClass('inactive');
				$("#icon_toggle i", this).removeClass('icon-minus').addClass('icon-plus');
			} else {
				sidebar.find('.active').addClass('inactive');
				sidebar.find('.active').removeClass('active');
				$(this).removeClass('inactive');
				$(this).addClass('active');
				$("#icon_toggle i", this).removeClass('icon-plus').addClass('icon-minus');
			}
		});
		/* End of bootstrap Add class to accordion **/
	});	
		</script>
			<figure class="span5" id="news_accordion">
			    <div class="accordion" id="accordion_news">
				<?php
				wp_reset_query();
				wp_reset_postdata();
					$category = ( $category == 'All' )? '': $category;
					if( !empty($category) ){
						$category_term = get_term_by( 'name', $category , 'event-category');
						$category = $category_term->slug;
					}				

					query_posts(array(
						'posts_per_page'			=> $num_fetch,
						'post_type'					=> 'events',
						'event-category'			=> $category,
						'post_status'				=> 'publish',
						'meta_key'					=> 'event_start_date',
						'meta_value'				=> date('m/d/Y'),
						'meta_compare'				=> '>=',
						'orderby'					=> 'meta_value',
						'order'						=> 'ASC',
					));
					$event_counter = 0;
					while( have_posts() ){
					the_post();	
					$event_counter++;
					global $post,$post_id;
						$event_start_date = get_post_meta($post->ID, 'event_start_date', true);
						$event_end_date = get_post_meta($post->ID, 'event_end_date', true);
						$event_detail_xml = get_post_meta($post->ID, 'event_detail_xml', true);
						if($event_detail_xml <> ''){
							$cp_event_xml = new DOMDocument ();
							$cp_event_xml->loadXML ( $event_detail_xml );
							$event_social = find_xml_value($cp_event_xml->documentElement,'event_social');
							$sidebar_event = find_xml_value($cp_event_xml->documentElement,'sidebar_event');
							$left_sidebar_event = find_xml_value($cp_event_xml->documentElement,'left_sidebar_event');
							$right_sidebar_event = find_xml_value($cp_event_xml->documentElement,'right_sidebar_event');
							$event_start_time = find_xml_value($cp_event_xml->documentElement,'event_start_time');
							$event_end_time = find_xml_value($cp_event_xml->documentElement,'event_end_time');
							$event_thumbnail = find_xml_value($cp_event_xml->documentElement,'event_thumbnail');
							$entry_level = find_xml_value($cp_event_xml->documentElement,'entry_level');
							$additional_info = find_xml_value($cp_event_xml->documentElement,'additional_info');
							$booking_url = find_xml_value($cp_event_xml->documentElement,'booking_url');
							$video_url_type = find_xml_value($cp_event_xml->documentElement,'video_url_type');
							$select_slider_type = find_xml_value($cp_event_xml->documentElement,'select_slider_type');
							$event_location_select = find_xml_value($cp_event_xml->documentElement,'event_location_select');
							
							
							//Get Date in Parts
							$event_year = date('Y',strtotime($event_start_date));
							$event_month = date('m',strtotime($event_start_date));
							$event_month_alpha = date('M',strtotime($event_start_date));
							$event_day = date('d',strtotime($event_start_date));
							
							//Change time format
							$event_start_time = date("G,i,s", strtotime($event_start_time));
							
							
							$map_search_field = '';
							$event_latitude = '';
							$event_longitude = '';
							$event_zoom = '';
							$event_loc_xml = get_post_meta($event_location_select, 'event_loc_xml', true);
							if($event_loc_xml <> ''){
								$cp_event_xml = new DOMDocument ();
								$cp_event_xml->loadXML ( $event_loc_xml );
								$map_search_field = find_xml_value($cp_event_xml->documentElement,'map_search_field');
								$event_latitude = find_xml_value($cp_event_xml->documentElement,'event_latitude');
								$event_longitude = find_xml_value($cp_event_xml->documentElement,'event_longitude');
								$event_zoom = find_xml_value($cp_event_xml->documentElement,'event_zoom');
							}
						}
					?>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle <?php if($event_counter == 1){echo 'active';}else{echo 'inactive';}?>" data-toggle="collapse" data-parent="#accordion_news" href="#<?php echo $post->ID?>-event">
									<span class="datem span3 first"> <?php echo date('d/m',strtotime($event_start_date));?> </span>
									<span class="title span8"> <?php echo get_the_title();?> 
										<span class="location_date"> 
												<span class="location"><i class="icon-map-marker"></i><?php echo $map_search_field;?></span>
												<span class="date"><i class="icon-time"></i><?php echo date('M , d , Y',strtotime($event_start_date));?></span>
										</span>
									</span>
									<span class="span1" id="icon_toggle"> <i class="icon-minus"> </i></span>	
								</a>
							</div>
							<div id="<?php echo $post->ID?>-event" class="accordion-body collapse <?php if($event_counter == 1){echo 'in';}?>">
								<div class="accordion-inner">
									<figure class="span3 img first">
										<?php echo get_the_post_thumbnail($post_id, array(60,60));?>
									</figure>
									<figure class="span9">
									<p><?php echo strip_tags(substr(get_the_content(),0,150));?></p>
									<a href="<?php echo get_permalink();?>"><?php _e('Read More','crunchpress');?></a>
									</figure>
								</div>
							</div>
						</div>
					<?php }?>
				</div>
			</figure>
				</div>	
<?php		
		wp_reset_query();
		wp_reset_postdata();
	}
	
	function print_blog_item_item($item_xml){
		$num_excerpt = 250;
		$header = find_xml_value($item_xml, 'header');
		$category = find_xml_value($item_xml, 'category');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'category');
			$category = $category_term->slug;
		}
		
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
		?>
		<script>
		jQuery(document).ready(function ($) {
			if ($('#blog_slider').length) {
				$('#blog_slider').bxSlider({
					minSlides: 1,
					maxSlides: 1
				});
			}
		});
		</script>
		<div class="blog_class" id="blog_store">
			<figure id="blog" class="span12 first">
				<?php if($header <> ''){?><h2 class="title"><?php echo $header;?><span class="h-line"></span></h2><?php }?>
				<div id="slider_blog">
					<ul id="blog_slider">
					<?php
					wp_reset_query();
				wp_reset_postdata();
					query_posts(array(
						'posts_per_page'			=> $num_fetch,
						'post_type'					=> 'post',
						'category'					=> $category,
						'post_status'				=> 'publish',
						'order'						=> 'DESC',
					));
					$event_counter = 0;
					while( have_posts() ){
					the_post();	
					global $post,$post_id;
					?>
						<li>
							<div class="img span4">
								<?php echo get_the_post_thumbnail($post_id, array(175,155));;?>
							</div>
							<div class="content span8">
								<div class="icon_date"> 
									<i class="icon-picture"></i>
									<span class="date"><?php echo date('M d, Y',strtotime(get_the_date()))?></span>
								</div>
								<div class="post_excerpt">
									<h4><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h4>
									<p><?php 
									if($num_excerpt <> ''){
										echo strip_tags(substr(get_the_content(),0,$num_excerpt));
									}else{
										echo strip_tags(substr(get_the_content(),0,250));
									}
									
									?></p>
									<a href="<?php echo get_permalink();?>"><?php _e('Read More','crunchpress');?><i class="icon-plus"></i> </a>
								</div>
							</div>
						</li>
					<?php }
					wp_reset_query();
					wp_reset_postdata();
					?>	
					</ul>
				</div>
			</figure>
		</div>	
	<?php
	}
	
	function print_woo_product_slider_item($item_xml){ 
		wp_reset_query();
		wp_register_script('cp-caroufredsel-slider', CP_PATH_URL.'/frontend/js/caroufredsel.js', false, '1.0', true);
		wp_enqueue_script('cp-caroufredsel-slider');	
		
		$header = find_xml_value($item_xml, 'header');
		$category = find_xml_value($item_xml, 'category');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'product_cat');
			$category = $category_term->slug;
		}
		global $post;
		$facebook_class = '';
		if($post <> ''){
			$facebook_class = get_post_meta ( $post->ID, "page-option-item-facebook-selection", true );
		}
	?>
			
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				<?php if($facebook_class == 'Yes'){?>
				var _visible = 4;
				<?php }else{?>
				var _visible = 6;
				<?php }?>
				var $pagers = $('#pager a');
				var _onBefore = function() {
					$(this).find('img').stop().fadeTo( 300, 1 );
					$pagers.removeClass( 'selected' );
				};

				$('#carousel').carouFredSel({
					items: _visible,
					width: '100%',
					auto: false,
					scroll: {
						duration: 750
					},
					prev: {
						button: '#prev',
						items: 2,
						onBefore: _onBefore
					},
					next: {
						button: '#next',
						items: 2,
						onBefore: _onBefore
					},
				});

				$pagers.click(function( e ) {
					e.preventDefault();
					
					var group = $(this).attr( 'href' ).slice( 1 );
					var slides = $('#carousel div.' + group);
					var deviation = Math.floor( ( _visible - slides.length ) / 2 );
					if ( deviation < 0 ) {
						deviation = 0;
					}

					$('#carousel').trigger( 'slideTo', [ $('#' + group), -deviation ] );
					$('#carousel div img').stop().fadeTo( 300, 1 );
					slides.find('img').stop().fadeTo( 300, 1 );

					$(this).addClass( 'selected' );
				});
			});
		</script>
			<div id="inner">
				<div id="carousel">
				<?php
					query_posts(array(
						'posts_per_page'			=> $num_fetch,
						'post_type'					=> 'product',
						'category'					=> $category,
						'post_status'				=> 'publish',
						'order'						=> 'DESC',
					));
					while( have_posts() ){
					the_post();	
					global $post,$post_id;
					$categories = '';
					$currency = '';
					//Price of Product
					$regular_price = get_post_meta($post->ID, '_regular_price', true);
					if($regular_price == ''){
						$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
					}
					$sale_price = get_post_meta($post->ID, '_sale_price', true);
					if($sale_price == ''){
						$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
					}
					if(function_exists('get_woocommerce_currency_symbol')){
						$currency = get_woocommerce_currency_symbol();
					}
					?>
					<div class="cp_product" id="<?php 
					if(class_exists("Woocommerce")){
						$categories = get_the_terms( $post->ID, 'product_cat' );
							if($categories <> ''){
								foreach ( $categories as $category ) {
									echo $category->term_id;
								}
							}
					}	
					?>">
						<?php echo get_the_post_thumbnail($post_id, array(140,200));;?>
						<em><?php echo get_the_title();?></em>
						<span class="cp_price"><sup><?php echo $currency;?></sup><?php echo $regular_price;?></span>
						<a class="view_detail" href="<?php echo get_permalink();?>"><?php _e('View Detail','crunchpress');?></a>
					</div>
				<?php }?>
				</div>
				<div id="pager">
				<?php
				$category = find_xml_value($item_xml, 'category');
				$category = ( $category == 'All' )? '': $category;
				if( !empty($category) ){
					$category_term = get_term_by( 'name', $category , 'product_cat');
					$category = $category_term->slug;
				}
				if(class_exists("Woocommerce")){
					$categories = get_categories( array('child_of' => $category, 'taxonomy' => 'product_cat', 'hide_empty' => 0) );
					if($categories <> ""){
						foreach($categories as $values){?>
						<a href="#<?php echo $values->term_id;?>"><?php echo $values->name;?></a>
					<?php
						}
					}
				}
				?>
				</div>
				<a href="#" id="prev"><span class="font_aw"><i class="icon-chevron-left"></i></span></a>
				<a href="#" id="next"><span class="font_aw"><i class="icon-chevron-right"></i></span></a>
			</div>
	<?php }
	
	// Print the slider item
	function print_slider_item($item_xml){
		
		global $counter;
		$xml_size = find_xml_value($item_xml, 'size');
		if( $xml_size == 'full-width' ){
			echo '<div class="Full-Image"><div class="thumbnail_image">';
		}else{
			echo '<div class="Full-Image"><div class="thumbnail_image">';
		}
		$slider_xml_dom  = new DOMDocument ();
		$slider_type= find_xml_value($item_xml,'slider-type');
		$slider_width = find_xml_value($item_xml, 'width');
		$slider_height = find_xml_value($item_xml, 'height');
		$slider_slide = find_xml_value($item_xml, 'slider-slide');
		$slider_slide_layer = find_xml_value($item_xml, 'slider-slide-layer');
		//$post_slider_slug = get_posts(array('post_type' => 'cp_slider','name' => $slider_slide,'numberposts' => 1));
		if(!empty($slider_slide)){
		$layer_slider_id = get_post_meta( $slider_slide, 'cp-slider-xml', true);
			if($layer_slider_id <> ''){
				$slider_xml_dom = new DOMDocument ();
				$slider_xml_dom->loadXML ( $layer_slider_id );
			}
		}
		if( !empty($slider_width) && !empty($slider_height) ){
			$xml_size = array($slider_width, $slider_height);
		} else if(!empty($slider_height)){
			$xml_size = array(980, $slider_height);
		}
		
		else{
			$xml_size = array(980,360);
		}
		$slider_name = 'anything'.$counter;
		switch(find_xml_value($item_xml,'slider-type')){
			
			case 'Anything': 
				wp_register_script('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.js', false, '1.0', true);
				wp_enqueue_script('cp-anything-slider');	

				wp_register_script('cp-anything-slider-fx', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.fx.js', false, '1.0', true);
				wp_enqueue_script('cp-anything-slider-fx');	
				//$slider_name = 'anything'.$counter;
				$slider_name = 'anything'.$counter;
				echo print_anything_slider($slider_name,$slider_xml_dom->documentElement,$size=$xml_size);
				break;
			case 'Flex-Slider': 
				print_flex_slider($slider_xml_dom->documentElement,$size=$xml_size);
				break;
			case 'Default-Slider': 
				print_fine_slider($slider_xml_dom->documentElement,$size=$xml_size);
				break;
			case 'Bx-Slider': 
				print_bx_slider($slider_xml_dom->documentElement,$size=$xml_size);
				
				break;
			case 'Layer-Slider': 
				echo do_shortcode('[layerslider id="' . $slider_slide_layer . '"]');
			break;	
				
		}
		?>
		
		<?php
		
		
		if( find_xml_value($item_xml, 'size') == 'full-width' ){
			echo "</div></div>";
		}else{
		      echo "</div></div>";
		}
		
	}
	
	// Print Content Item
	function print_content_item($item_xml){
		wp_reset_query();
		$show_big_toolbar = find_xml_value($item_xml, 'show-big-toolbar');
		$button_text = find_xml_value($item_xml, 'button-text');
		$button_link = find_xml_value($item_xml, 'button-link');
		
			if($show_big_toolbar == 'Yes'){ 
				if(have_posts()){
					while(have_posts()){
					the_post();
					global $post;				
					$content_title = get_post_meta ( $post->ID, "cp-show-content-title", true );
					$content_desc = get_post_meta ( $post->ID, "cp-show-content-descrip", true );?>
					<figure id="page_title">
						<div class="span8 first">
							<?php
								if($content_title == 'Yes'){
									echo '<h2>' . get_the_title() . '</h2>';
								}
							?>
						</div>
						<div class="span4 title_right">
							<div id="cart_dropdown" class="dropdown">
								<a href="<?php echo $button_link;?>" id="dd_title" role="button" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-user"></i>
								<?php echo $button_text;?>
								</a>
							</div>
						</div>
					</figure>
					<?php 
						if($content_desc == 'Yes'){
							the_content();
						}
					}
				}
			}else{
			if(have_posts()){
				while(have_posts()){
					the_post();
				global $post;				
				$content_title = get_post_meta ( $post->ID, "cp-show-content-title", true );
				$content_desc = get_post_meta ( $post->ID, "cp-show-content-descrip", true );
					if($content_title == 'Yes'){
						echo '<h2 class="heading">' . get_the_title() . '</h2><span class="border-line m-bottom"></span>';
					}
					
					if($content_desc == 'Yes'){
						the_content();
					}
					
				}
			}
		}
	}
	
	// Print Content Item
	function print_default_content_item(){
		wp_reset_query();
		
		if(have_posts()){
			while(have_posts()){
				the_post(); 
				echo '<figure id="page_title"><div class="span8 first"> <h2>'.get_the_title().'</h2></div></figure>';
				the_content();
			}
		}
	}
	
	// Print Accordion
	function print_accordion_item($item_xml){
	
		
		$tab_xml = find_xml_node($item_xml, 'tab-item');
		$header = find_xml_value($item_xml, 'header');
		if(!empty($header)){
			echo '<h2  class="heading">' . $header . '</h2>';
		}
		echo " <div class='accordion_cp'>";	
		foreach($tab_xml->childNodes as $accordion){
			echo "<h3 class='accordion-heading'><a href=''>";
			echo find_xml_value($accordion, 'title') . "</a></h3>";
			echo "<div><p>";
			echo do_shortcode(html_entity_decode(find_xml_value($accordion, 'caption'))) . '</p></div>';
		}
		
		echo "</div>";
	
	}
	
	
	
	// Print Divider
	function print_divider($item_xml){
		wp_register_script('cp-easing', CP_PATH_URL.'/frontend/js/jquery-easing-1.3.js', false, '1.0', true);
		wp_enqueue_script('cp-easing');
		wp_register_script('cp-top-script', CP_PATH_URL.'/frontend/js/jquery.scrollTo-min.js', false, '1.0', true);
		wp_enqueue_script('cp-top-script');
		echo '<div class="clear"></div><div class="divider mr10"><div class="scroll-top"><a class="scroll-topp">Back to Top</a>';
		echo find_xml_value($item_xml, 'text');
		echo '</div></div>';
		
	}
	
	// Print Message Box
	function print_message_box($item_xml){
		$box_color = find_xml_value($item_xml, 'color');
		$box_title = find_xml_value($item_xml, 'title');
		$box_content = html_entity_decode(find_xml_value($item_xml, 'content'));
		echo '<div class="message-box-wrapper ' . $box_color . '">';
		echo '<div class="message-box-title">' . $box_title . '</div>';
		echo '<div class="message-box-content">' . $box_content . '</div>';
		echo '</div>';
	}
	
	// Print Toggle Box
	function print_toggle_box_item($item_xml){
		$tab_xml = find_xml_node($item_xml, 'tab-item');
		$header = find_xml_value($item_xml, 'header');
		if(!empty($header)){
			echo '<h3 class="toggle-box-header-title title-color cp-title">' . $header . '</h3>';
		}
		echo "<ul class='toggle-view'>";
		foreach($tab_xml->childNodes as $toggle_box){
			$active = find_xml_value($toggle_box, 'active');
			echo "<li >";
			
			echo "<span class='link";
			echo ($active == 'Yes')? ' active':'';
			echo "' ></span>";
			echo "<h3 class='color'>". find_xml_value($toggle_box, 'title') . "</h3>";
			echo "<div class='panel"; 
			echo ($active == 'Yes')? ' active': '';
			echo "' id='toggle-box-content' >";
			echo do_shortcode(html_entity_decode(find_xml_value($toggle_box, 'caption'))) . '</div>';
			echo "</li>";
		
		}
		echo "</ul>";
	}

	// Print Tab
	function print_tab_item($item_xml){
	
		$tab_xml = find_xml_node($item_xml, 'tab-item');
		
		$tab_widget_title =  html_entity_decode(find_xml_value($item_xml,'tab-widget'));
		$tab_style =  html_entity_decode(find_xml_value($item_xml,'tab-styles'));
		$num = 0;
		$tab_title = array();
		$tab_content = array();
		$tab_title[$num] = find_xml_value($item_xml, 'title');
		if( !empty($tab_widget_title) ){
		echo '<h3 class="heading1 bg-div"><span class="inner"><strong>';
		echo  $tab_widget_title;
		echo '</strong><span class="bgr1"></span></span></h3>';
		}
		if($tab_style <> 'Verticle'){
			echo '<div id="horizontal-tabs" class="tabs">';
		}else{
			echo '<div id="vertical-tabs" class="tabs">';
		}
		foreach($tab_xml->childNodes as $toggle_box){
			$tab_title[$num] = find_xml_value($toggle_box, 'title');
			$tab_content[$num] = html_entity_decode(find_xml_value($toggle_box, 'caption'));
			$num++;
		}
		
			echo "<ul class='cp-divider'>";
			for($i=0; $i<$num; $i++){
				echo '<li><a href="#' . str_replace(' ', '-', $tab_title[$i]) . '" class=" cp-divider ';
				echo ( $i == 0 )? 'active':'';
				echo '" >' . $tab_title[$i] . '</a></li>';
			}
			echo "</ul>";
			
			echo "<ul class='contents'>";
			for($i=0; $i<$num; $i++){
				echo '<li id="' . str_replace(' ', '-', $tab_title[$i]) . '" class="tabscontent ';
				echo ( $i == 0 )? 'active':'';  
				echo '" >' . do_shortcode($tab_content[$i]) . '</li>';
			}
			echo "</ul>";	
			echo "</div>";	
		
	}
	
	
	// Print column service
	function print_column_service($item_xml){
		$column_service_img_id = find_xml_value($item_xml, 'image');
		$column_service_image = wp_get_attachment_image_src($column_service_img_id, 'full');
		$column_service_title = find_xml_value($item_xml, 'title');
		$column_service_link = find_xml_value($item_xml, 'morelink');
		$service_widget_style = find_xml_value($item_xml, 'service-widget-style');
		$column_service_caption = html_entity_decode(find_xml_value($item_xml, 'caption'));
		$alt_text = get_post_meta($column_service_img_id , '_wp_attachment_image_alt', true);
		
		$column_service_image = wp_get_attachment_image_src($column_service_img_id, array(300,110));
		if(!empty($column_service_image)){ ?>
			<div class="ftr_img f-img-1"> 
				<span class="img"><img src="<?php echo $column_service_image[0]?>" alt=""></span>
			</div>
		<?php }?>
			<div class="ftr_txt">
				<strong><?php echo $column_service_title;?></strong>
				<p><?php echo do_shortcode($column_service_caption);?></p>
			</div>
		<?php
	}

	// Print contact form
	function print_contact_form($item_xml){
		global $post,$counter;
		foreach ($_REQUEST as $keys=>$values) {
			$$keys = $values;
		}
		wp_register_script('contact-validation', CP_PATH_URL.'/frontend/js/jquery.validate.js', false, '1.0', true);
		wp_enqueue_script('contact-validation');
		
		?>
		<script>
			function contact_submit(){
				jQuery("#submit_btn").hide();
				jQuery("#loading_div").html('<img src="<?php echo CP_PATH_URL?>/images/ajax_loading.gif" alt="Loading" />');
				jQuery.ajax({
					type:'POST', 
					url: '<?php echo CP_PATH_URL?>/contact_submit.php',
					data:jQuery('#form_contact').serialize(), 
					success: function(response) {
						//$('#frm').get(0).reset();
						jQuery("#loading_div").html('');
						jQuery("#frm_area").hide();
						jQuery("#succ_mess").show('');
						jQuery("#succ_mess").html(response);
					}
				});
			}
			jQuery(document).ready(function($) {
				$('#form_contact').validate();
			});
		</script>
		<?php
		$header = find_xml_value($item_xml, 'header');
		if(!empty($header)){
			echo '<h2 class="heading">' . $header . '</h2><span class="border-line m-bottom"></span>';
		}
		?>
			<form id="form_contact" action="javascript:contact_submit()" method="POST">
				<div id="succ_mess"></div>
				<ul id="frm_area" class="comm-list contact">
					<li>
						<label><?php echo __('Name','cp_front_end'); ?><span>(required)</span></label>
						<input name="name_contact" type="text" class="required comm-field require-field">
					</li>
					<li>
						<label><?php echo __('Email','cp_front_end'); ?><span>(required)</span></label>
						<input name="email_contact" type="text" class="required email require-field email comm-field">
						<!--<div class="error"><?php echo __('Please enter a valid email address','cp_front_end'); ?></div>-->
					</li>
					<li class="textarea">
						<label><?php echo __('Message','cp_front_end'); ?><span>(required)</span></label>
						<textarea name="message_comment" cols="5" rows="10" class="required require-field comm-area"></textarea>
						<!--<div class="error">* <?php echo __('Please enter message','cp_front_end'); ?></div> -->
					</li>
					<div id="loading_div" class=""></div>
					<li class="hide"><input type="hidden" name="receiver" value="<?php echo find_xml_value($item_xml, 'email'); ?>"></li>
					<li class="hide"><input type="hidden" name="successful_msg_contact" value="Your message has been submitted."></li>
					<li class="hide"><input type="hidden" name="un_successful_msg_contact" value="Please Provide Correct Information!"></li>
					<li class="hide"><input type="hidden" name="form_submitted" value="form_submitted"></li>
					<div class="clear"></div>
					<li class="buttons">
						<input type="submit" id="submit_btn" class="btns" value="<?php echo __('Submit','cp_front_end'); ?>">
					</li>
				</ul>
			</form>
	<?php
		
	
	}
	
	
	function print_news_slider_box($item_xml){
		wp_reset_query();
		$header = find_xml_value($item_xml, 'header');
		$category = html_entity_decode(find_xml_value($item_xml, 'category'));
		$num_fetch = html_entity_decode(find_xml_value($item_xml, 'num-fetch'));
		if($category <> ''){
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'product_cat');
			$category = $category_term->slug;
		}
		?>
		<script>
        jQuery(document).ready(function($) {
			$('.news_slider').bxSlider({  minSlides: 1, maxSlides: 1, slideMargin: 18,  speed: 500, });
        });
        </script>
         <!-- Content -->
			<div id="news" class="blog_class">
			<?php if($header <> ''){?><h2 class="title"><?php echo $header;?><span class="h-line"></span></h2><?php }?>
				<ul class="news_slider" id="news_slider">
				<?php
				global $post;
				$args = array(
					'posts_per_page'			=> $num_fetch,
					'post_type'					=> 'post',
					'category'					=> $category,
					'post_status'				=> 'publish',
					'order'						=> 'ASC',
					);
				query_posts($args);
				if ( have_posts() <> "" ) {
					while ( have_posts() ): the_post();?>
					<li> 
						<div class="span5 first" id="img_holder"> 
							<div class="img">
							<?php echo get_the_post_thumbnail($post->ID, array(260,220))?>
							</div>
							<div class="img_title"> 
							<a> <i class="icon-plus"></i> </a>
							<a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a> 
							<p><?php echo strip_tags(substr(get_the_content(),0,10));?></p>
							</div>
						</div>
						<div class="span7 ns_desc"> 
							<a href="<?php echo get_permalink();?>" class="title"><?php echo get_the_title();?>  <span class="h-line"></span> </a> 
							<p><?php echo strip_tags(substr(get_the_content(),0,130));?></p>
							<a href="<?php echo get_permalink()?>" class="rm"><?php _e('View All News &nbsp;','crunchpress');?><i class="icon-plus"></i></a>
						</div> 
					</li>
					<?php endwhile;
				}	
					?>
				</ul>
			</div>
        <?php
		} //if Category Empty
	}
	
	
	function print_news_headline($item_xml){
		wp_reset_query();
		$header = find_xml_value($item_xml, 'header');
		$category = html_entity_decode(find_xml_value($item_xml, 'category'));
		$num_fetch = html_entity_decode(find_xml_value($item_xml, 'num-fetch'));
		if($category <> ''){
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'product_cat');
			$category = $category_term->slug;
		}
		?>
		<script>
        jQuery(document).ready(function($) {
			$('.news_slider').bxSlider({  minSlides: 1, maxSlides: 1, slideMargin: 18,  speed: 500, });
        });
        </script>
         <!-- Content -->
			<div id="news" class="blog_class">
			<?php if($header <> ''){?><h2 class="title"><?php echo $header;?><span class="h-line"></span></h2><?php }?>
				<ul class="news_slider" id="news_slider">
				<?php
				global $post;
				$args = array(
					'posts_per_page'			=> $num_fetch,
					'post_type'					=> 'post',
					'category'					=> $category,
					'post_status'				=> 'publish',
					'order'						=> 'ASC',
					);
				query_posts($args);
				if ( have_posts() <> "" ) {
					while ( have_posts() ): the_post();?>
					<li> 
						<div class="span5 first" id="img_holder"> 
							<div class="img">
							<?php echo get_the_post_thumbnail($post->ID, array(260,220))?>
							</div>
							<div class="img_title"> 
							<a> <i class="icon-plus"></i> </a>
							<a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a> 
							<p><?php echo strip_tags(substr(get_the_content(),0,10));?></p>
							</div>
						</div>
						<div class="span7 ns_desc"> 
							<a href="<?php echo get_permalink();?>" class="title"><?php echo get_the_title();?>  <span class="h-line"></span> </a> 
							<p><?php echo strip_tags(substr(get_the_content(),0,130));?></p>
							<a href="<?php echo get_permalink()?>" class="rm"><?php _e('View All News &nbsp;','crunchpress');?><i class="icon-plus"></i></a>
						</div> 
					</li>
					<?php endwhile;
				}	
					?>
				</ul>
			</div>
        <?php
		} //if Category Empty
	}

	
	// Print text widget
	function print_text_widget($item_xml){
		
		$title = find_xml_value($item_xml, 'title');
		$caption = html_entity_decode(find_xml_value($item_xml, 'caption'));
		$button_title =  find_xml_value($item_xml, 'button-title');
		echo '<div class="text-widget-wrapper"><div class="text-widget-content-wrapper ';   
		echo empty($button_title)? 'sixteen columns': 'twelve columns';
		echo ' mt0"><h3 class="text-widget-title">' . $title . '</h3>';
		echo '<div class="text-widget-caption">' . do_shortcode($caption) . '</div>';
		echo '</div>';
		if( !empty($button_title) ){
			$button_margin = (int) find_xml_value($item_xml, 'button-top-margin');
			echo '<div class="text-widget-button-wrapper three columns mt0" >';
			echo '<a class="text-widget-button" style="position:relative; top:' . $button_margin . 'px;" href="' . find_xml_value($item_xml, 'button-link') . '" >';
			echo  $button_title . '</a>';
			echo '</div> '; 
			echo '<br class="clear">';
		}  echo '</div>';
		
	}
	
//$cp_div_size_num_class = array("1/4" => "four columns", "1/3" => "one-third column", "1/2" => "eight columns", 	"2/3" => "two-thirds column", "3/4" => "twelve columns", "1/1" => "sixteen columns");
	
	// Print Testimonial
	function print_testimonial($item_xml){
		
		$display_type = find_xml_value($item_xml, 'display-type');
		$header = find_xml_value($item_xml, 'header');
		if($display_type == 'Specific Testimonial'){
			echo '<div class="tastimonialcon">';
			if(!empty($header)){
				echo '<h2 class="heading">' . $header . '</h2><span class="border-line m-bottom"></span>';
			}
			$item_size = find_xml_value($item_xml, 'item-size');
			$header = find_xml_value($item_xml, 'header');
			$specific = find_xml_value($item_xml, 'specific');
			//$posts = get_posts(array('post_type' => 'testimonial', 'name'=>$specific, 'numberposts'=> 1));
			global $cp_div_size_num_class;
			$position = get_post_meta($specific, 'testimonial-option-author-position', true);
			?>
			
			<div class="test-holder ">
				<?php if(get_the_post_thumbnail($specific, array(270,190)) <> ''){?>
				<figure class="span3">
					<?php echo get_the_post_thumbnail($specific, array(270,190));?>
				</figure>
				<article class="span9 client-testi">
					<p><?php echo $posts[0]->post_content;;?></p>
					<a href="<?php echo get_permalink($specific);?>" class="t-author"><?php echo get_the_title($specific);?> <span>- <?php echo $position;?>.</span></a>	
				</article>
				<?php }else{ ?>
					<article class="span12 client-testi">
						<p><?php echo $posts[0]->post_content;;?></p>
						<a href="<?php echo get_permalink($specific);?>" class="t-author"><?php echo get_the_title($specific);?> <span>- <?php echo $position;?>.</span></a>	
					</article>
				<?php }?>				
			</div>
		<?php
		}else{
		
			//global $cp_div_size_num_class;
		
			$item_size = find_xml_value($item_xml, 'item-size');
			$category = find_xml_value($item_xml, 'category');
			$category = ( $category == 'All' )? '': $category;
			$category_posts = get_posts(array('post_type'=>'testimonial', 'testimonial-category'=>$category, 'numberposts'=>100));
    
			if(!empty($header)){
				echo '<h2><span class="txt-left">' . $header . '</span> <span class="bg-right"></span></h2>';
			}else{
				
			}
			foreach( $category_posts as $category_post){
			$position = get_post_meta($category_post->ID, 'testimonial-option-author-position', true);
			?>
			<div class="test-holder ">
				<?php if(get_the_post_thumbnail($category_post->ID, array(270,190)) <> ''){?>
				<figure class="span3">
					<?php echo get_the_post_thumbnail($category_post->ID, array(270,190));?>
				</figure>
				<article class="span9 client-testi">
					<p><?php echo $category_post->post_content;;?></p>
					<a href="<?php echo get_permalink($category_post->ID);?>" class="t-author"><?php echo $category_post->post_title;?> <span>- <?php echo $position;?>.</span></a>	
				</article>
				<?php }else{ ?>
					<article class="span12 client-testi">
						<p><?php echo $category_post->post_content;;?></p>
						<a href="<?php echo get_permalink($category_post->ID);?>" class="t-author"><?php echo $category_post->post_title;?> <span>- <?php echo $position;?>.</span></a>	
					</article>
				<?php }?>				
			</div>
				
				<?php
			}
		}
	
	}

	// size is when no sidebar, side2 is use when 1 sidebar, side 3 is use when 3 sidebar
	if( $cp_is_responsive ){
		$port_div_size_num_class = array(
			"1/4" => array("class"=>"four columns", "size"=>"390x224", "size2"=>"390x245", "size3"=>"390x247"), 
			"1/3" => array("class"=>"one-third column", "size"=>"390x242", "size2"=>"390x238", "size3"=>"390x247"), 
			"1/2" => array("class"=>"eight columns", "size"=>"450x290", "size2"=>"390x247", "size3"=>"390x247"), 
			"1/1" => array("class"=>"sixteen columns", "size"=>"620x225", "size2"=>"390x182", "size3"=>"390x292"));	
	}else{
		$port_div_size_num_class = array(
			"1/4" => array("class"=>"four columns", "size"=>"210x121", "size2"=>"135x85", "size3"=>"210x135"), 
			"1/3" => array("class"=>"one-third column", "size"=>"290x180", "size2"=>"190x116", "size3"=>"210x135"), 
			"1/2" => array("class"=>"eight columns", "size"=>"450x290", "size2"=>"300x190", "size3"=>"210x135"), 
			"1/1" => array("class"=>"sixteen columns", "size"=>"620x225", "size2"=>"320x150", "size3"=>"180x135"));
	}
	$class_to_num = array(
		"element1-4" => 0.25,
		"1/4"=>0.25,
		"element1-3" => 0.33,
		"1/3"=>0.33,
		"element1-2" => 0.5,
		"1/2"=>0.5,
		"element2-3" => 0.66,
		"2/3"=>0.66,
		"element3-4" => 0.75,
		"3/4"=>0.75,
		"element1-1" => 1,
		"1/1" => 1	
	);
	

	// Print nested page
	function print_page_item($item_xml){
		
		wp_reset_query();
		global $paged;
		global $sidebar;
		global $port_div_size_num_class;	
		global $class_to_num;
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
	
		// get the item class and size from array
		$port_size = find_xml_value($item_xml, 'item-size');
		
		// get the item class and size from array
		$item_class = $port_div_size_num_class[$port_size]['class'];
		if( $sidebar == "no-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size2'];
		}else{
			$item_size = $port_div_size_num_class[$port_size]['size3'];
		}

		// get the page meta value
		$header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');	

		// page header
		if(!empty($header)){
			echo '<h2><span class="txt-left">' . $header . '</span> <span class="bg-right"></span></h2>';
		}
		global $post;
		$post_temp = query_posts(array('post_type'=>'page', 'paged'=>$paged, 'post_parent'=>$post->ID, 'posts_per_page'=>$num_fetch ));
		// get the portfolio size
		$port_wrapper_size = $class_to_num[find_xml_value($item_xml, 'size')];
		$port_current_size = 0;
		$port_size =  $class_to_num[$port_size];
		
		$port_num_have_bottom = sizeof($post_temp) % (int)($port_wrapper_size/$port_size);
		$port_num_have_bottom = ( $port_num_have_bottom == 0 )? (int)($port_wrapper_size/$port_size): $port_num_have_bottom;
		$port_num_have_bottom = sizeof($post_temp) - $port_num_have_bottom;
		
		echo '<section id="portfolio-item-holder" class="portfolio-item-holder">';
		while( have_posts() ){
			the_post();
			// start printing data
			echo '<figure class="' . $item_class . ' mt0 pt25 portfolio-item">'; 
			$image_type = get_post_meta( $post->ID, 'post-option-featured-image-type', true);
			$image_type = empty($image_type)? "Link to Current Post": $image_type; 
			$thumbnail_id = get_post_thumbnail_id();
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			
			$hover_thumb = "hover-link";
			$pretty_photo = "";
			$permalink = get_permalink();
			

			if( !empty($thumbnail[0]) ){
				echo '<div class="portfolio-thumbnail-image">';
				echo '<div class="overflow-hidden">';
				echo '<a href="' . $permalink . '" ' . $pretty_photo . ' title="' . get_the_title() . '">';
				echo '<span class="portfolio-thumbnail-image-hover">';
				echo '<span class="' . $hover_thumb . '"></span>';
				echo '</span>';
				echo '</a>';
				echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
				echo '</div>'; //overflow hidden
				echo '</div>'; //portfolio thumbnail image						
			}
			
			
			echo '<div class="portfolio-thumbnail-context">';
			// page title
			if( find_xml_value($item_xml, "show-title") == "Yes" ){
				echo '<h2 class="heading portfolio-thumbnail-title port-title-color cp-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			}
			// page excerpt
			if( find_xml_value($item_xml, "show-excerpt") == "Yes" ){			
				echo '<div class="portfolio-thumbnail-content">' . mb_substr( get_the_excerpt(), 0, $num_excerpt ) . '</div>';
			}
			// read more button
			if( find_xml_value($item_xml, "read-more") == "Yes" ){
				echo '<a href="' . get_permalink() . '" class="portfolio-read-more cp-button">' . __('Read More','cp_front_end') . '</a>';
			}
			echo '</div>';
			// print space if not last line
			if($port_current_size < $port_num_have_bottom){
				echo '<div class="portfolio-bottom"></div>';
				$port_current_size++;
			}
			echo '</figure>';

		}

		echo "</section>";
		echo '<div class="clear"></div>';
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}		
		
	}
	
	//Donation Box
	function print_donate_item($item_xml){
		$header = find_xml_value($item_xml, 'header');
		$description = find_xml_value($item_xml, 'description');
		$donate_button = find_xml_value($item_xml, 'donate_button_text');
		$button_link = find_xml_value($item_xml, 'button-link');
	?>
	<section id="donation_box">	
		<div class="donation_box">
			<figure class="span10">
				<?php echo $description;?>
			</figure>
			<figure class="span2">
					<a href="<?php echo $button_link;?>" class="donate-now btn btn-large dropdown-toggle" type="submit"><?php echo $donate_button;?></a>
			</figure>
		</div>
	</section>
	<?php }
	
	function print_funds_item_item($item_xml){ 
		$header = find_xml_value($item_xml, 'header');
		$project = find_xml_value($item_xml, 'project');
		//$posts = get_posts(array('post_type' => 'ignition_product', 'name'=>$project, 'numberposts'=> 1));
		if($project <> ''){
			$ign_fund_goal = get_post_meta($project, 'ign_fund_goal', true);
			$ign_project_id = get_post_meta($project, 'ign_project_id', true);
			$ign_product_image1 = get_post_meta($project, 'ign_product_image1', true);
			$ignition_date = get_post_meta($project, 'ign_fund_end', true);
			$ignition_datee = date('d-m-Y h:i:s',strtotime($ignition_date));
			
			$getPledge_cp = getPledge_cp($ign_project_id);
			$current_date = date('d-m-Y h:i:s');
			$project_date = new DateTime($ignition_datee);
			$current = new DateTime($current_date);
			//$interval = $project_date->diff($current);
			$days = round(($project_date->format('U') - $current->format('U')) / (60*60*24));

		?>
		<div id="charity_progress">
			<h3><a href="<?php echo get_permalink($project);?>"><?php echo get_the_title($project);?></a></h3>
			<div id="charity_process_inner">
				<div class="span4 img first">
					<img src="<?php echo $ign_product_image1;?>" alt="<?php echo get_the_title($project);?>"/>
				</div>
				<div class="span8 progress_report">
				<h2> $<?php echo getTotalProductFund_cp($ign_project_id);?> </h2>
				<h4><?php _e('Pledged of','crunchpress');?> $<?php echo $ign_fund_goal;?> <?php _e('Goal','crunchpress');?></h4>
					<div class="progress progress-striped active">  
						<div style="width:<?php echo getPercentRaised_cp($ign_project_id);?>%;" class="bar p80"></div>    
					</div>
					  <div class="info"> 
							<div class="span6 first">
								<i class="icon-user"></i> <span> <?php echo $getPledge_cp[0]->p_number;?></span> <?php _e('Pledgers','crunchpress');?>
							</div>
							<div class="span6 ntr">
								<i class="icon-calendar-empty"></i> <span> <?php echo $days;?></span> <?php _e('Days Left','crunchpress');?>
							</div>
					  </div>
				</div>
			</div>
		</div>	
	<?php
		}// Condition
	}
	
	function print_woo_product_feature_item($item_xml){ 
		$header = find_xml_value($item_xml, 'header');
		$category = find_xml_value($item_xml, 'category');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'product_cat');
			$category = $category_term->slug;
		}
		

		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
	?>
	<script>
	jQuery(document).ready(function ($) {
		$('.shop_slider').bxSlider({
				slideWidth: 140,
				minSlides: 1,
				maxSlides: 3,
				slideMargin: 28
		});
	});	
	</script>
	
			<figure id="blog_store">
				<?php if($header <> ''){?><h2 class="title"> <?php echo $header;?><span class="h-line"></span></h2><?php }?>
				<div class="slider_shop" id="slider_shop">
					<ul class="shop_slider" id="shop_slider">
					<?php
						query_posts(array(
							'posts_per_page'			=> $num_fetch,
							'post_type'					=> 'product',
							'product_cat'				=> $category,
							'post_status'				=> 'publish',
							'order'						=> 'DESC',
						));
						while( have_posts() ){
						the_post();
						$currency = '';
						global $post,$product,$product_url;
							$regular_price = get_post_meta($post->ID, '_regular_price', true);
							if($regular_price == ''){
								$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
							}
							$sale_price = get_post_meta($post->ID, '_sale_price', true);
							if($sale_price == ''){
								$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
							}
							if(function_exists('get_woocommerce_currency_symbol')){
								$currency = get_woocommerce_currency_symbol();
							}
							
						?>
						<li> 
							<div class="img"><a href="<?php echo get_permalink();?>"><?php echo get_the_post_thumbnail($post->ID, array(260,220));?></a></div>
							<div class="price_cart"><span class="price"><?php echo $currency;?><?php echo $sale_price;?></span><a href="<?php echo get_permalink();?>&add-to-cart=<?php echo $post->ID;?>"><i class="icon-shopping-cart"></i></a></div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</figure>
	<?php
	}

?>