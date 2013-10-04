<?php
class gallery_image_show extends WP_Widget
{
  function gallery_image_show()
  {
    $widget_ops = array('classname' => 'gallery_show', 'description' => 'Show Gallery Images' );
    $this->WP_Widget('gallery_image_show', 'CrunchPress : Gallery Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';		
	$select_gallery = isset( $instance['select_gallery'] ) ? esc_attr( $instance['select_gallery'] ) : '';		
	$nofimages = isset( $instance['nofimages'] ) ? esc_attr( $instance['nofimages'] ) : '';	
	$externallink = isset( $instance['externallink'] ) ? esc_attr( $instance['externallink'] ) : '';	
	
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	  Title: 
	  <input class="upcoming"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
  <div class="clear"></div>
  <p>
  <label for="<?php echo $this->get_field_id('select_gallery'); ?>">
	  Select Gallery:
	  <select id="<?php echo $this->get_field_id('select_gallery'); ?>" name="<?php echo $this->get_field_name('select_gallery'); ?>" style="width:225px">
		<?php
        global $wpdb,$post;
		$gallery_name = get_title_list_array('gallery');
		foreach ( $gallery_name as $gallery_title){ ?>
                    <option <?php if($select_gallery == $gallery_title->ID){echo 'selected';}?> value="<?php echo $gallery_title->ID;?>" >
	                    <?php echo substr($gallery_title->post_title, 0, 20);	if ( strlen($gallery_title->post_title) > 20 ) echo "...";?>
                    </option>						
			<?php }
			?>
      </select>
  </label>
  </p>     
  <div class="clear"></div>
  <p>
  <label for="<?php echo $this->get_field_id('nofimages'); ?>">
	  Number of Images to Show:
	  <input class="upcoming" size="5" id="<?php echo $this->get_field_id('nofimages'); ?>" name="<?php echo $this->get_field_name('nofimages'); ?>" type="text" value="<?php echo esc_attr($nofimages); ?>" />
  </label>
  </p>
    <div class="clear"></div>
  <p>
  <label for="<?php echo $this->get_field_id('externallink'); ?>">
	 Please enter url here.
	  <input class="upcoming"  id="<?php echo $this->get_field_id('externallink'); ?>" name="<?php echo $this->get_field_name('externallink'); ?>" type="text" value="<?php echo esc_attr($externallink); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['select_gallery'] = $new_instance['select_gallery'];
		$instance['nofimages'] = $new_instance['nofimages'];
		$instance['externallink'] = $new_instance['externallink'];
		
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$select_gallery = isset( $instance['select_gallery'] ) ? esc_attr( $instance['select_gallery'] ) : '';
		$nofimages = isset( $instance['nofimages'] ) ? esc_attr( $instance['nofimages'] ) : '';	
		$externallink = isset( $instance['externallink'] ) ? esc_attr( $instance['externallink'] ) : '';	
		
		echo $before_widget;	
		// WIDGET display CODE Start
		if (!empty($title))
			echo $before_title;
			echo $title;
			echo $after_title;

			wp_enqueue_style('prettyPhoto',CP_PATH_URL.'/frontend/css/prettyphoto.css');
			wp_enqueue_style('cp-pscript',CP_PATH_URL.'/frontend/css/style_animate_gal.css');
			wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/js/jquery.prettyphoto.js', false, '1.0', true);
			wp_enqueue_script('prettyPhoto');

			wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/js/pretty_script.js', false, '1.0', true);
			wp_enqueue_script('cp-pscript');
			
			$slider_xml_string = get_post_meta($select_gallery,'post-option-gallery-xml', true);
			$slider_xml_dom = new DOMDocument();
			if( !empty( $slider_xml_string ) ){
			$slider_xml_dom->loadXML($slider_xml_string);	
			?>
			<ul class="gallery-list gallery_widget">
				<?php
				$children = $slider_xml_dom->documentElement->childNodes;
				$counter_gallery = 0;
				$counter_limit = 0;
				if($nofimages > $slider_xml_dom->documentElement->childNodes->length){$nofimages = $slider_xml_dom->documentElement->childNodes->length;}
				for($i=0;$i<$nofimages;$i++) { 
				$counter_limit++;
					$link_type = find_xml_value($children->item($i), 'linktype');				
					$thumbnail_id = find_xml_value($children->item($i), 'image');				
					$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);						
					$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
					$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(60,60));
					echo '<li class="view_new view-tenth"><img class="galler-img" src="' . $image_thumb[0] . '" alt="' . $alt_text . '" />';
					echo '<div class="mask"><a class="image-gal info" rel="prettyPhoto[aaa]" href="' . $image_full[0] . '"  title="">&nbsp;</a></div></li>';
				}?>
			</ul>
			<div class="clear"></div>
			<?php if($externallink <> ''){?><a href="<?php echo $externallink;?>" class="more-btn2">+ View More</a><?php }
		}	
			
	wp_reset_query();
	echo $after_widget;
	}
		
}
add_action( 'widgets_init', create_function('', 'return register_widget("gallery_image_show");') );?>