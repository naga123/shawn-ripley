<?php 
/**
 * Template Name: Gallery Slide Show
 */

get_header(); 
?>
</div>
<!--Thumbnail Navigation-->
  <div id="prevthumb"></div>
  <div id="nextthumb"></div>
  
  <!--Arrow Navigation--> 
  <a id="prevslide" class="load-item"></a> <a id="nextslide" class="load-item"></a>
  <div id="thumb-tray" class="load-item">
    <div id="thumb-back"></div>
    <div id="thumb-forward"></div>
  </div>
  
  <!--Time Bar-->
  <div id="progress-back" class="load-item">
    <div id="progress-bar"></div>
  </div>
  
  <!--Control Bar-->
  <div id="controls-wrapper" class="load-item">
    <div id="controls"> <a id="play-button"><img id="pauseplay" alt="pause" src="<?php echo CP_PATH_URL;?>/images/img/pause.png"/></a> 
      
      <!--Slide counter-->
      <div id="slidecounter"> <span class="slidenumber"></span> / <span class="totalslides"></span> </div>
      
      <!--Slide captions displayed here-->
      <div id="slidecaption"></div>
      
      <!--Thumb Tray button--> 
      <a id="tray-button"><img id="tray-arrow" alt="try up" src="<?php echo CP_PATH_URL;?>/images/img/button-tray-up.png"/></a> 
      
      <!--Navigation-->
      <ul id="slide-list">
      </ul>
    </div>
  </div>
<?php
$gallery = get_post_meta ( $post->ID, "page-option-item-gallery-selection", true );
//$gallery = get_posts(array('post_type' => 'gallery', 'name'=>$gallery, 'numberposts'=> 1));
$slider_xml_string = get_post_meta($gallery,'post-option-gallery-xml', true);
$slider_xml_dom = new DOMDocument();
if( !empty( $slider_xml_string ) ){
	$slider_xml_dom->loadXML($slider_xml_string);

	
wp_enqueue_style('cp-gallery-slider', CP_PATH_URL.'/frontend/css/supersized.css');

wp_register_script('cp-gallery-slider', CP_PATH_URL.'/frontend/js/supersized.3.2.7.min.js', array('jquery'), '1.0', true);
wp_enqueue_script('cp-gallery-slider');
?> 
<link rel="stylesheet" href="<?php echo CP_PATH_URL; ?>/frontend/css/supersized.css">
<script type="text/javascript" src="<?php echo CP_PATH_URL;?>/frontend/js/supersized.3.2.7.min.js"></script><!-- Image Gallery -->
<script type="text/javascript">
jQuery(document).ready(function($) {
$.supersized({
// Functionality
	slide_interval  :   3000,		// Length between transitions
	transition      :   3, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
	transition_speed:	700,		// Speed of transition
	// Components							
	slide_links		:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
	slides 			:  	[			// Slideshow Images
						<?php 
						foreach( $slider_xml_dom->documentElement->childNodes as $slider ){
						$image_full = wp_get_attachment_image_src(find_xml_value($slider, 'image'), 'full');
						$image_full_small = wp_get_attachment_image_src(find_xml_value($slider, 'image'), array(175,155));
						?>
						{image : '<?php echo $image_full[0];?>', title : '', thumb : '<?php echo $image_full_small[0];?>'},
						<?php }?>
						]
				});
		    });
</script>
<?php }?>
<?php wp_footer(); ?>