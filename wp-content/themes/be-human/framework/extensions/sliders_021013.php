<?php

	/*
	*	CrunchPress Misc File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains all of the necessary function for the front-end to
	*	easily used. You can see the description of each function below.
	*	---------------------------------------------------------------------
	*/
	
	// Check if url is from youtube or vimeo
	function get_video($url, $width = 640, $height = 480){
	
		if(strpos($url,'youtube')){		
		
			get_youtube($url, $width, $height);
		
		}else if(strpos($url,'youtu.be')){
		
			get_youtube($url, $width, $height, 'youtu.be');
			
		}else{
		
			get_vimeo($url, $width, $height);
		}
		
	}
	
	// Print youtube video
	function get_youtube($url, $width = 640, $height = 480, $type = 'youtube'){
		
		if( $type == 'youtube' ){
			preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$url,$id);
		}else{
			preg_match('/youtu.be\/([^\\?\\&]+)/', $url, $id);
		}
		
		/*
		<object type="application/x-shockwave-flash" data="http://www.youtube.com/v/<?php echo $id[1]; ?>&hd=1" style="width:<?php echo $width; ?>px;height:<?php echo $height; ?>px">
			<param name="wmode" value="opaque"><param name="movie" value="http://www.youtube.com/v/<?php echo $id[1]; ?>&hd=1" />
		</object>
		*/
		?>
		
		<iframe src="http://www.youtube.com/embed/<?php echo $id[1]; ?>?wmode=transparent" width="<?php echo $width; ?>" height="<?php echo $height; ?>" ></iframe>
		
		<?php
		
	}
	
	// Print vimeo video
	function get_vimeo($url, $width = 640, $height = 480){
	
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $url, $id);
?>
		<object width="<?php echo $width; ?>" height="<?php echo $height; ?>">
			<param name="allowscriptaccess" value="always" >
			<param name="allowfullscreen" value="true" >
			<param name="wmode" value="transparent" >
			<param name="bgcolor" value="#000000" >
			<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $id[1]; ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" />
			<embed src="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $id[1]; ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00ADEF&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="<?php echo $width; ?>" height="<?php echo $height; ?>" wmode="transparent" bgcolor="#000000"></embed>
		</object> 
		
	
		
		<!--<iframe src="http://player.vimeo.com/video/<?php echo $id[1]; ?>?title=0&amp;byline=0&amp;portrait=0" width="<?php echo $width; ?>" height="<?php echo $height; ?>"></iframe>-->
		
		<?php
		
	}

	function print_flex_slider($slider_xml, $size){
		if( empty($slider_xml) ) return;

		$slider_style = 'slider';
		//Getting Slider Settings
		$cp_slider_settings = get_option('slider_settings');
		if($cp_slider_settings <> ''){
			
			$cp_slider = new DOMDocument ();
			$cp_slider->loadXML ( $cp_slider_settings );
			$animation_type_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','animation_type_flex');
			$reverse_order_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','reverse_order_flex');
				if($reverse_order_flex == 'disable'){$reverse_order_flex = 'false';}else{$reverse_order_flex = 'true';}
			$startat_flex_slider = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','startat_flex_slider');
			$auto_play_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','auto_play_flex');
				if($auto_play_flex == 'disable'){$auto_play_flex = 'false';}else{$auto_play_flex = 'true';}
			$animation_speed_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','animation_speed_flex');
			$pause_on_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','pause_on_flex');
			if($pause_on_flex == 'disable'){$pause_on_flex = 'false';}else{$pause_on_flex = 'true';}
			$navigation_on_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','navigation_on_flex');
			if($navigation_on_flex == 'disable'){$navigation_on_flex = 'false';}else{$navigation_on_flex = 'true';}
			$arrow_on_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','arrow_on_flex');
			if($arrow_on_flex == 'disable'){$arrow_on_flex = 'false';}else{$arrow_on_flex = 'true';}
			//Anything Slider Values
			$slide_mod_anything = find_xml_child_nodes($cp_slider_settings,'anything_slider_settings','slide_mod_anything');
			$auto_play_anything = find_xml_child_nodes($cp_slider_settings,'anything_slider_settings','auto_play_anything');
			if($auto_play_anything == 'disable'){$auto_play_anything = 'false';}else{$auto_play_anything = 'true';}
			$pause_on_anything = find_xml_child_nodes($cp_slider_settings,'anything_slider_settings','pause_on_anything');
			if($pause_on_anything == 'disable'){$pause_on_anything = 'false';}else{$pause_on_anything = 'true';}
			$animation_speed_anything = find_xml_child_nodes($cp_slider_settings,'anything_slider_settings','animation_speed_anything');
		}
		
		?>
		<script>
			jQuery(document).ready(function($) {
			  $('#flexslider').flexslider({
				animation: '<?php echo $animation_type_flex;?>',
				reverse: <?php echo $reverse_order_flex;?>,
				startAt: <?php echo $startat_flex_slider;?>,
				slideshow: <?php echo $auto_play_flex;?>,
				animationSpeed: <?php echo $animation_speed_flex;?>, 
				pauseOnHover: <?php echo $pause_on_flex;?>, 
				directionNav: <?php echo $navigation_on_flex;?>, 
				controlNav: <?php echo $arrow_on_flex;?>, 
				start: function(slider){
				  $('body').removeClass('loading');
				}
			  });
			});
		</script>
		
		<?php
		global $cp_is_responsive;
		
			echo '<div id="flexslider" class="flexslider ">';
				echo '<ul class="slides">';		
					foreach($slider_xml->childNodes as $slider){
						$title = find_xml_value($slider, 'title');
						$caption = html_entity_decode(find_xml_value($slider, 'caption'));
						$link = find_xml_value($slider, 'link');
						$link_type = find_xml_value($slider, 'linktype');
						$btn_txt = find_xml_value($slider, 'btn_txt');
						if(cp_get_width($size) == '5000'){
							$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'),'full');
						}else{
							$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'),$size);
						}
						$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);
						echo '<li class="slide-image">';				
							echo '<img src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
							if( !empty($title) ){
								echo '<div class="caption"><div class="cp-slider-title cp-title">' . $title . '</div>' . substr($caption,0,150) . '</div>'; 
							}
						echo '</li>';
					}
				echo "</ul>";
			echo "</div>";
	}
	
	// Anything Slider Function Start
	function print_anything_slider($slider_name,$slider_xml, $size){?>

		<?php
		//Getting Slider Settings
		$cp_slider_settings = get_option('slider_settings');
		if($cp_slider_settings <> ''){
			$cp_slider = new DOMDocument ();
			$cp_slider->loadXML ( $cp_slider_settings );
			$animation_type_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','animation_type_flex');
			$reverse_order_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','reverse_order_flex');
			$startat_flex_slider = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','startat_flex_slider');
			$auto_play_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','auto_play_flex');
			$animation_speed_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','animation_speed_flex');
			$pause_on_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','pause_on_flex');
			$navigation_on_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','navigation_on_flex');
			$arrow_on_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','arrow_on_flex');
			//Anything Slider Values
			$slide_mod_anything = find_xml_child_nodes($cp_slider_settings,'anything_slider_settings','slide_mod_anything');
			$auto_play_anything = find_xml_child_nodes($cp_slider_settings,'anything_slider_settings','auto_play_anything');
			if($auto_play_anything == 'disable'){$auto_play_anything = 'false';}else{$auto_play_anything = 'true';}
			$pause_on_anything = find_xml_child_nodes($cp_slider_settings,'anything_slider_settings','pause_on_anything');
			if($pause_on_anything == 'disable'){$pause_on_anything = 'false';}else{$pause_on_anything = 'true';}
			$animation_speed_anything = find_xml_child_nodes($cp_slider_settings,'anything_slider_settings','animation_speed_anything');
		}
		
		
		?>
				
		<!--Printing Anything Slider Script-->
		<script>
		jQuery(document).ready(function($) {
			$('#<?php echo $slider_name;?>')
			.anythingSlider({
				mode: "fade", 
				autoPlay: <?php echo $auto_play_anything?>,
				pauseOnHover: <?php echo $pause_on_anything?>,
				animationTime: <?php echo $animation_speed_anything?>,
				
			})
			.anythingSliderFx({
				'.caption-top'    : [ 'caption-Top', '50px' ],
				'.caption-right'  : [ 'caption-Right', '130px', '1000', 'easeOutBounce' ],
				'.caption-bottom' : [ 'caption-Bottom', '50px' ],
				'.caption-left'   : [ 'caption-Left', '130px', '1000', 'easeOutBounce' ]
			})
			// add a close button (x) to the caption
			.find('div[class*=caption]')
				.css({ position: 'absolute' })
				.prepend('')
				//.find('.as_close').click(function(){
					//var cap = $(this).parent(),
						//ani = { bottom : -50 }; // bottom
					//if (cap.is('.caption-top')) { ani = { top: -50 }; }
					//if (cap.is('.caption-left')) { ani = { left: -150 }; }
					//if (cap.is('.caption-right')) { ani = { right: -150 }; }
					//cap.animate(ani, 400);
				//});
		});
		</script>
	<?php 
	if( empty($slider_xml) ) return;
		echo '<ul id="'.$slider_name.'">';
		//Get Slider data	
		foreach($slider_xml->childNodes as $slider){
			$title = find_xml_value($slider, 'title');
			$caption = html_entity_decode(find_xml_value($slider, 'caption'));
			$link = find_xml_value($slider, 'link');
			$link_type = find_xml_value($slider, 'linktype');
			$btn_txt = find_xml_value($slider, 'btn_txt');
			if(cp_get_width($size) == '5000'){
				$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'),'full');
			}else if(cp_get_width($size) == '810'){
				$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'),array(770,400));
			}else{
				$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'),array(1170,420));
			}
			$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);
			echo '<li>';
			
			?>
				<a href="<?php echo esc_url($link);?>"><img src="<?php echo $image_url[0];?>" /></a>
				<div class="caption-bottom">
					<div id="slider_wrapper" class="slider_wrapper">
						<h2><?php echo $title;?></h2>
						<p><?php echo substr($caption,0,150); ?></p>
					</div>
				</div>
			<?php
			echo '</li>';
		}
		echo "</ul>";
	}
	function print_bx_slider($slider_xml,$size){
	//BX slider
	$slide_order_bx = '';
	$auto_play_bx = '';
	$pause_on_bx = '';
	$animation_speed_bx = '';
	
	$cp_slider_settings = get_option('slider_settings');
	//$dd = find_xml_node($logo_uploa_d,'logo_upload');
	if($cp_slider_settings <> ''){
		$cp_slider = new DOMDocument ();
		$cp_slider->loadXML ( $cp_slider_settings );
		//Bx Slider Values
		$slide_order_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','slide_order_bx');
		$auto_play_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','auto_play_bx');
		if($auto_play_bx == 'enable'){$auto_play_bx = 'true';}else{$auto_play_bx = 'false';}
		$pause_on_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','pause_on_bx');
		if($pause_on_bx == 'enable'){$pause_on_bx = 'true';}else{$pause_on_bx = 'false';}
		$animation_speed_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','animation_speed_bx');
	}
	
	?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.banner_sliderr').bxSlider({
				<?php if($slide_order_bx == 'slide'){}else{?> mode: 'fade', <?php }?>
				minSlides: 1,
				maxSlides: 1,
				slideMargin: 0,
				hideControlOnEnd: true,
				easing: 'swing',
				auto: <?php echo $auto_play_bx;?>,
				autoHover:<?php echo $pause_on_bx;?>,
				//auto
				speed: <?php if($animation_speed_bx <> ''){echo $animation_speed_bx;}else{echo '2000';}?>
			});
		});	
		</script>
		<section class="border_slider">
			<!--<section class="border_container"><img src="<?php echo CP_PATH_URL?>/images/slider_top_img.png" alt="" /></section>-->
			<ul class="banner_sliderr" >
			<?php 
				foreach($slider_xml->childNodes as $slider){
					$title = find_xml_value($slider, 'title');
					$caption = html_entity_decode(find_xml_value($slider, 'caption'));
					$link = find_xml_value($slider, 'link');
					$link_type = find_xml_value($slider, 'linktype');
					$btn_txt = find_xml_value($slider, 'btn_txt');
					if(cp_get_width($size) == '5000'){
						$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'),'full');
					}else{
						$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'),$size);
					}
					$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);?>
					<li> 
						<img src="<?php echo $image_url[0];?>" />
						<div class="slider_content">
							<a href="<?php echo esc_url($link);?>"><p class="b_dark"><?php echo $title;?> </p></a>
							<span class="clear"></span>
							<p class="b_green"> <?php echo $caption;?></p>
						</div>
					</li>
				<?php }?>
			</ul>
		</section>
	<?php
	
	
	}
	
	function print_bx_slider_page($slider_xml,$size){
	//BX slider
	$slide_order_bx = '';
	$auto_play_bx = '';
	$pause_on_bx = '';
	$animation_speed_bx = '';
	
	$cp_slider_settings = get_option('slider_settings');
	//$dd = find_xml_node($logo_uploa_d,'logo_upload');
	if($cp_slider_settings <> ''){
		$cp_slider = new DOMDocument ();
		$cp_slider->loadXML ( $cp_slider_settings );
		//Bx Slider Values
		$slide_order_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','slide_order_bx');
		$auto_play_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','auto_play_bx');
		if($auto_play_bx == 'enable'){$auto_play_bx = 'true';}else{$auto_play_bx = 'false';}
		$pause_on_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','pause_on_bx');
		$animation_speed_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','animation_speed_bx');
	}
	
	?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#banner_slider').bxSlider({
				<?php if($slide_order_bx == 'slide'){}else{?> mode: 'fade', <?php }?>
				minSlides: 1,
				maxSlides: 1,
				slideMargin: 0,
				hideControlOnEnd: true,
				easing: 'easeOutElastic',
				auto: <?php echo $auto_play_bx;?>,
				speed: <?php echo $animation_speed_bx;?>
			});
		});	
		</script>
		<section class="border_slider">
			<!--<section class="border_container"><img src="<?php echo CP_PATH_URL?>/images/slider_top_img.png" alt="" /></section>-->
			<ul id="banner_slider">
			<?php 
				foreach($slider_xml->childNodes as $slider){
					$title = find_xml_value($slider, 'title');
					$caption = html_entity_decode(find_xml_value($slider, 'caption'));
					$link = find_xml_value($slider, 'link');
					$link_type = find_xml_value($slider, 'linktype');
					$btn_txt = find_xml_value($slider, 'btn_txt');
					if(cp_get_width($size) == '5000'){
						$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'),'full');
					}else{
						$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'),$size);
					}
					$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);?>
					<li> 
						<a href="<?php echo esc_url($link);?>"><img src="<?php echo $image_url[0];?>" /></a>					
						<div class="slider_content">
							<p class="b_dark"><?php echo $title;?> </p>
							<span class="clear"></span>
							<p class="b_green"> <?php echo $caption;?></p>
						</div>
				</li>
				<?php }?>
			</ul>
		</section>
	<?php
	
	
	}
	
	// Default FineFood Slider Function Start
	function print_fine_slider($slider_xml,$size){?>
		<div id="homeContent">
			<div id="featured">
				<div class="gallery">
				<?php
					foreach($slider_xml->childNodes as $slider){
						$title = find_xml_value($slider, 'title');
						$caption = html_entity_decode(find_xml_value($slider, 'caption'));
						$link = find_xml_value($slider, 'link');
						$link_type = find_xml_value($slider, 'linktype');
						$btn_txt = find_xml_value($slider, 'btn_txt');
						if(cp_get_width($size) == '5000'){
							$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'),'full');
						}else{
							$image_url = wp_get_attachment_image_src(find_xml_value($slider, 'image'),$size);
						}
						$alt_text = get_post_meta(find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);?>
						<div class="site">
							<img src="<?php echo $image_url[0];?>" alt="<?php echo $alt_text;?>">
							<div class="main-holder">
								<div class="bannercon descriptionn">
									<h2><?php echo substr($title,0,50);?></h2>
									<p><?php echo substr($caption,0,150); ?></p>
									<?php if($link_type == 'Lightbox'){?>
										<a target="<?php echo $link_type;?>" data-gal="prettyPhoto[gal]" href="<?php echo $image_url[0];?>" class="bannerbtn"><?php echo $btn_txt;?></a> 
									<?php }else{?>
										<a target="<?php echo $link_type;?>" href="<?php echo esc_url($link);?>" class="bannerbtn"><?php echo $btn_txt;?></a> 
									<?php }?>
								</div>
							</div>
						</div>
				<?php } ?>
				</div>
				<div class="pagination stopClickPropagation"> <a href="#" class="left"><img src="<?php echo CP_PATH_URL; ?>/images/arrow_le.png" alt="left"></a>
					<div class="pages" style="display:none;"></div>
					<a href="#" class="right"><img src="<?php echo CP_PATH_URL; ?>/images/arrow_ri.png" alt="right"></a>
				</div>
			</div>
		</div>
		<?php } ?>