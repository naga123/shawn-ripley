<?php
class recent_event_box_show extends WP_Widget
{
  function recent_event_box_show()
  {
    $widget_ops = array('classname' => 'charity_counter_wrapper', 'description' => 'Event Countdown widget to show event in countdown.' );
    $this->WP_Widget('recent_event_box_show', 'CrunchPress : Event Countdown Widget', $widget_ops);
  }
 
  function form($instance)
  {
	wp_reset_query();
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$select_event = isset( $instance['select_event'] ) ? esc_attr( $instance['select_event'] ) : '';
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	  Title: 
	  <input class="upcoming"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
<p>
  <label for="<?php echo $this->get_field_id('select_post'); ?>">
	  Select A Event:
	  <select id="<?php echo $this->get_field_id('select_event'); ?>" name="<?php echo $this->get_field_name('select_event'); ?>" style="width:225px">
		<?php
        global $wpdb,$post;
		$gallery_name = get_title_list_array('events');
		foreach ( $gallery_name as $gallery_title){ ?>
                    <option <?php if($select_event == $gallery_title->ID){echo 'selected';}?> value="<?php echo $gallery_title->ID;?>" >
	                    <?php echo substr($gallery_title->post_title, 0, 20);	if ( strlen($gallery_title->post_title) > 20 ) echo "...";?>
                    </option>						
			<?php }
			?>
      </select>
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['select_event'] = $new_instance['select_event'];	
	
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		wp_reset_query();
		wp_reset_postdata();
		
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$select_event = isset( $instance['select_event'] ) ? esc_attr( $instance['select_event'] ) : '';		
		if(!isset($numberofwords) || strlen($numberofwords) == 0){
			$numberofwords = 140;
		}		
		$post_event_slug = get_posts(array('post_type' => 'events','name' => $select_event,'numberposts' => 1));
		echo $before_widget;	
		// WIDGET display CODE Start
		if (!empty($title))
//			echo $before_title;
//			echo $title;
//			echo $after_title;
			global $wpdb, $post;
			wp_reset_query();			
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
			$event_start_date = get_post_meta($select_event, 'event_start_date', true);
			$event_end_date = get_post_meta($select_event, 'event_end_date', true);
			$event_detail_xml = get_post_meta($select_event, 'event_detail_xml', true);
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
			
			wp_register_script('countdown', CP_PATH_URL.'/frontend/js/jquery_countdown.js', false, '1.0', true);
			wp_enqueue_script('countdown');
			?>
			<script>
				jQuery(function () {
					var austDay = new Date();
					austDay = new Date(<?php echo $event_year;?>, <?php echo $event_month;?>-1, <?php echo $event_day;?>,<?php echo $event_start_time;?>)
					jQuery('#countdown<?php echo $post_event_slug[0]->ID?>').countdown({until: austDay});
					jQuery('#year').text(austDay.getFullYear());
				});                
			</script>
			<section class="span5">
				<div class="charity_title">
					<?php echo get_the_title($select_event);?>
				</div>
			</section>
			<section class="span1 event_more pull-right"> <a href="#"> <i class="icon">+</i>  </a> </section>
			<section class="span6 counter_bg pull-right">
				<div id="countdown<?php echo $select_event;?>" class="tCountdOwn"></div>
			</section>
                            
      <!-- Links End -->  
	<?php
	wp_reset_query();
	wp_reset_postdata();
	echo $after_widget;
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("recent_event_box_show");') );?>