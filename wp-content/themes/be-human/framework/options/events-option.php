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
	
	add_action( 'init', 'create_events' );
	function create_events() {
		//$portfolio_translation = get_option(THEME_NAME_S.'_cp_portfolio_slug','portfolio');
		
		$labels = array(
			'name' => _x('Events', 'Event General Name', 'crunchpress'),
			'singular_name' => _x('Event Item', 'Event Singular Name', 'crunchpress'),
			'add_new' => _x('Add New', 'Add New Event Name', 'crunchpress'),
			'add_new_item' => __('Add New Event', 'crunchpress'),
			'edit_item' => __('Edit Event', 'crunchpress'),
			'new_item' => __('New Event', 'crunchpress'),
			'view_item' => __('View Event', 'crunchpress'),
			'search_items' => __('Search Event', 'crunchpress'),
			'not_found' =>  __('Nothing found', 'crunchpress'),
			'not_found_in_trash' => __('Nothing found in Trash', 'crunchpress'),
			'parent_item_colon' => ''
		);
		
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_icon' => CP_PATH_URL . '/framework/images/calendar-icon.png',
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
			'rewrite' => array('slug' => 'events', 'with_front' => false)
		  ); 
		  
		register_post_type( 'events' , $args);
		
		// adding Manage Location start
				$labels = array(
					'name' => __('Manage Location', 'crunchpress'),
					'add_new_item' => __('Add New Location (Venue Title)', 'crunchpress'),
					'edit_item' => __('Edit Location', 'crunchpress'),
					'new_item' => __('New Location Item', 'crunchpress'),
					'add_new' => __('Add New Location', 'crunchpress'),
					'view_item' => __('View Location Item', 'crunchpress'),
					'search_items' => __('Search Location', 'crunchpress'),
					'not_found' =>  __('Nothing found', 'crunchpress'),
					'not_found_in_trash' => __('Nothing found in Trash', 'crunchpress'),
					'parent_item_colon' => ''
				);
				$args = array(
					'labels' => $labels,
					'public' => true,
					'publicly_queryable' => true,
					'show_ui' => true,
					'query_var' => true,
					//'menu_icon' => get_stylesheet_directory_uri() . '/images/calendar.png',
					'show_in_menu' => 'edit.php?post_type=events',
					'show_in_nav_menus'=>true,
					'rewrite' => true,
					'capability_type' => 'post',
					'hierarchical' => false,
					'menu_position' => null,
					'supports' => array('title')
				); 
				register_post_type( 'event_location' , $args );  
			// adding Manage Location end
		
		
		register_taxonomy(
			"event-category", array("events"), array(
				"hierarchical" => true,
				"label" => "Event Categories", 
				"singular_label" => "Event Categories", 
				"rewrite" => true));
		register_taxonomy_for_object_type('events-category', 'events');
		
		register_taxonomy(
			"event-tag", array("events"), array(
				"hierarchical" => false, 
				"label" => "Event Tag", 
				"singular_label" => "Event Tag", 
				"rewrite" => true));
		register_taxonomy_for_object_type('events-tag', 'events');
		
	}
	
	
	add_action('add_meta_boxes', 'add_events_option');
	function add_events_option(){	
	
		add_meta_box('event-option', __('Event Options','crunchpress'), 'add_event_option_element',
			'events', 'normal', 'high');
	
		add_meta_box('event_location', __('Event Location','crunchpress'), 'add_event_location_element',
			'event_location', 'normal', 'high');
			
	}
	function add_event_location_element(){ 
	
	$map_search_field = '';
	$event_latitude = '';
	$event_longitude = '';
	$event_zoom = '';
	foreach($_REQUEST as $keys=>$values){
		$$keys = $values;
	}
	global $post;
		
	$event_loc_xml = get_post_meta($post->ID, 'event_loc_xml', true);
	if($event_loc_xml <> ''){
		$cp_event_xml = new DOMDocument ();
		$cp_event_xml->loadXML ( $event_loc_xml );
		$map_search_field = find_xml_value($cp_event_xml->documentElement,'map_search_field');
		$event_latitude = find_xml_value($cp_event_xml->documentElement,'event_latitude');
		$event_longitude = find_xml_value($cp_event_xml->documentElement,'event_longitude');
		$event_zoom = find_xml_value($cp_event_xml->documentElement,'event_zoom');
	}
	
	?>
	<form>
		<div class="event_options gllpLatlonPicker">
			<ul class="recipe_class top-bg">
				<li><h2><?php _e('Event Location Detail','crunchpress'); ?></h2></li>
			</ul>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="map_search_field" > <?php _e('Address', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" class="gllpSearchField" name="map_search_field" id="map_search_field" value="<?php if($map_search_field <> ''){echo $map_search_field;};?>" />
					<input type="hidden" name="event_zoom" class="gllpZoom" value="<?php echo $event_zoom;?>"/>
					<input type="button" class="gllpSearchButton" value="search">
					<!--<input type="button" class="gllpUpdateButton" value="update map">-->
				</li>
				<li class="description"><p><?php _e('Please search your location then use drag and drop to mark your location.','crunchpress'); ?></p></li>
			</ul>
			<ul class="recipe_class">
			<li class=" gllpMap" style="height:400px"></li>
				<div class="clear"></div>
				<input type="hidden" name="event_latitude" class="gllpLatitude" value="<?php echo $event_latitude;?>"/>
				<input type="hidden" name="event_longitude" class="gllpLongitude" value="<?php echo $event_longitude;?>"/>
				<input type="hidden" name="event_loc_submit" value="event_location"/>
				<div class="clear"></div>
			</ul>	
		</div>	
		<div class="clear"></div>
	</form>
	<?php
	}
	add_action('save_post','save_event_location_meta');
	function save_event_location_meta($post_id){
		
		$map_search_field = '';
		$event_latitude = '';
		$event_longitude = '';	
		$event_zoom = '';
		
		foreach($_REQUEST as $keys=>$values){
			$$keys = $values;
		}
		
		global $post,$post_id;
		
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
	
			if(isset($event_loc_submit) AND $event_loc_submit == 'event_location'){
				$new_data = '<event_loc>';
				$new_data = $new_data . create_xml_tag('map_search_field',$map_search_field);
				$new_data = $new_data . create_xml_tag('event_latitude',$event_latitude);
				$new_data = $new_data . create_xml_tag('event_longitude',$event_longitude);
				$new_data = $new_data . create_xml_tag('event_zoom',$event_zoom);
				$new_data = $new_data . '</event_loc>';

			//Saving Sidebar and Social Sharing Settings as XML
			$old_data = get_post_meta($post_id, 'event_loc_xml',true);
			save_meta_data($post_id, $new_data, $old_data, 'event_loc_xml');
		
		}
		
	}
		
	
	function add_event_option_element(){

		$event_detail_xml = '';
		$event_social = '';
		$sidebar_event = '';
		$right_sidebar_event = '';
		$left_sidebar_event = '';
		$event_start_date = '';
		$event_end_date = '';
		$event_start_time = '';
		$event_end_time = '';
		$additional_info = '';
		$entry_level = '';
		$booking_url = '';
		$event_thumbnail = '';
		$video_url_type = '';
		$select_slider_type = '';
		$event_location_select = '';
		$schedule_head = '';
		$schedule_descrip = '';
		$team_parti_head = '';
		$team_parti_descrip = '';
		$name_post_schedule = '';
		$title_post_schedule = '';
		$des_post_schedule = '';
		$sch_select_organizer = '';
		
		foreach($_REQUEST as $keys=>$values){
			$$keys = $values;
		}
		global $post;
		
		$name_post_schedule = get_post_meta($post->ID, 'name_post_schedule', true);
		$title_post_schedule = get_post_meta($post->ID, 'title_post_schedule', true);
		$des_post_schedule = get_post_meta($post->ID, 'des_post_schedule', true);
		$sch_select_organizer = get_post_meta($post->ID, 'sch_select_organizer', true);
		
		
		
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
			$additional_info = find_xml_value($cp_event_xml->documentElement,'additional_info');
			$entry_level = find_xml_value($cp_event_xml->documentElement,'entry_level');			
			$booking_url = find_xml_value($cp_event_xml->documentElement,'booking_url');
			$event_thumbnail = find_xml_value($cp_event_xml->documentElement,'event_thumbnail');
			$video_url_type = find_xml_value($cp_event_xml->documentElement,'video_url_type');
			$select_slider_type = find_xml_value($cp_event_xml->documentElement,'select_slider_type');
			$event_location_select = find_xml_value($cp_event_xml->documentElement,'event_location_select');
			$schedule_head = find_xml_value($cp_event_xml->documentElement,'schedule_head');
			$schedule_descrip = find_xml_value($cp_event_xml->documentElement,'schedule_descrip');
			$team_parti_head = find_xml_value($cp_event_xml->documentElement,'team_parti_head');
			$team_parti_descrip = find_xml_value($cp_event_xml->documentElement,'team_parti_descrip');
		}
	?>
		<div class="event_options" id="event_backend_options" >
			<ul class="recipe_class top-bg">
				<li><h2>Social Sharing & Event Management Settings</h2></li>
			</ul>
			<ul class="event_social_class recipe_class">
				<li class="panel-title">
					<label for="event_social" > <?php _e('SOCIAL NETWORKING', 'crunchpress'); ?> </label>
				</li>	
				<li class="panel-input">
					<label for="event_social"><div class="checkbox-switch <?php
					
					echo ($event_social=='enable' || ($event_social=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

				?>"></div></label>
				<input type="checkbox" name="event_social" class="checkbox-switch" value="disable" checked>
				<input type="checkbox" name="event_social" id="event_social" class="checkbox-switch" value="enable" <?php 
					
					echo ($event_social=='enable' || ($event_social=='' && empty($default)))? 'checked': ''; 
				
				?>>
				</li>
				<li class="description"><p><?php _e('You can turn On/Off social sharing from event detail.','crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<?php echo show_sidebar($sidebar_event,'right_sidebar_event','left_sidebar_event',$right_sidebar_event,$left_sidebar_event);?>
			<div class="clear"></div>
			<ul class="event_start_class recipe_class">
				<li class="panel-title">
					<label for="event_start_date" > <?php _e('EVENT START DATE', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="event_start_date" id="event_start_date" value="<?php if($event_start_date <> ''){echo $event_start_date;};?>" />
				</li>
				<li class="description"><p><?php _e('Please select your event start date.','crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<ul class="event_end_class recipe_class">
				<li class="panel-title">
					<label for="event_end_date" > <?php _e('EVENT END DATE', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="event_end_date" id="event_end_date" value="<?php if($event_end_date <> ''){echo $event_end_date;};?>" />
				</li>
				<li class="description"><p><?php _e('Please select your event end date.','crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="event_start_time" > <?php _e('EVENT START TIME', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" class="time_picker" name="event_start_time" id="event_start_time" value="<?php if($event_start_time <> ''){echo $event_start_time;};?>" />
				</li>
				<li class="description"><p><?php _e('Please select your event start time.','crunchpress'); ?></p></li>
			</ul>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="event_end_time" > <?php _e('EVENT END TIME', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" class="time_picker" name="event_end_time" id="event_end_time" value="<?php if($event_end_time <> ''){echo $event_end_time;};?>" />
				</li>
				<li class="description"><p><?php _e('Please select your event end time.','crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="entry_level"><?php _e('Entry Level', 'crunchpress'); ?></label>
				</li>
				<li class="panel-input">	
					<div class="combobox">
						<select name="entry_level" id="entry_level">
							<option class="external" value="external_link" <?php if( $entry_level == 'external' ){ echo 'selected'; }?>>Additional Information</option>
							<option class="free_entry" value="free_entry" <?php if( $entry_level == 'free_entry' ){ echo 'selected'; }?>>Free Entry</option>
							<option class="paid_entry" value="paid_entry" <?php if( $entry_level == 'paid_entry' ){ echo 'selected'; }?>>Paid URL</option>
						</select>
					</div>
				</li>
				<li class="description"><p><?php _e('Please select entry level of content.','crunchpress'); ?></p></li>			
			</ul>
			<div class="clear"></div>
			<ul class="recipe_class addi_info">
				<li class="panel-title">
					<label for="additional_info" ><?php _e('Additional Information', 'crunchpress'); ?></label>
				</li>				
				<li class="panel-input">
					<input type="text" class="additional_info" name="additional_info" id="additional_info" value="<?php if($additional_info <> ''){echo $additional_info;};?>" />
				</li>
				<li class="description"><p><?php _e('Please enter your additional information here you can also use HTML tags here.','crunchpress'); ?></p></li>
			</ul>
			<ul class="recipe_class bookingurl">
				<li class="panel-title">
					<label for="booking_url" ><?php _e('BOOKING URL', 'crunchpress'); ?></label>
				</li>				
				<li class="panel-input">
					<input type="text" class="booking_url" name="booking_url" id="booking_url" value="<?php if($booking_url <> ''){echo esc_url($booking_url);};?>" />
				</li>
				<li class="description"><p><?php _e('Please enter your event booking url <br />For Example: http://www.currentevent.com.', 'crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="event_thumbnail"><?php _e('Select Type', 'crunchpress'); ?></label>
				</li>
				<li class="panel-input">	
					<div class="combobox">
						<select name="event_thumbnail" id="event_thumbnail">
							<option class="Image" value="Image" <?php if( $event_thumbnail == 'Image' ){ echo 'selected'; }?>>Feature Image</option>
							<option class="Video" value="Video" <?php if( $event_thumbnail == 'Video' ){ echo 'selected'; }?>>Video</option>
							<option class="Slider" value="Slider" <?php if( $event_thumbnail == 'Slider' ){ echo 'selected'; }?>>Slider</option>
						</select>
					</div>
				</li>
				<li class="description"><p><?php _e('Please select your post type of content.', 'crunchpress'); ?></p></li>			
			</ul>
			<div class="clear"></div>
			<ul class="video_class recipe_class">
				<li class="panel-title">
					<label for="video_url_type" > <?php _e('Video URL', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="video_url_type" id="video_url_type" value="<?php if($video_url_type <> ''){echo $video_url_type;};?>" />
				</li>
				<li class="description"><p><?php _e('Please paste Youtube or Vimeo url.', 'crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<ul class="select_slider_option recipe_class">
				<li class="panel-title">
					<label for="event_thumbnail"><?php _e('Select Images Slide', 'crunchpress'); ?></label>
				</li>
				<li class="panel-input">	
					<div class="combobox">
						<select name="select_slider_type" id="select_slider_type">
							<?php foreach( get_title_list_array('cp_slider') as $values){?>
								<option value="<?php echo $values->ID;?>" <?php if($select_slider_type == $values->ID){echo 'selected';}?>><?php echo $values->post_title;?></option>
							<?php }?>
						</select>
					</div>
				</li>
				<li class="description"><p><?php _e('Please select slide to show in post.', 'crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="event_location_select"><?php _e('Select Event Venue', 'crunchpress'); ?></label>
				</li>
				<li class="panel-input">	
					<div class="combobox">
						<select name="event_location_select" id="event_thumbnail">
								<option value="aa"><?php _e('--No Location--', 'crunchpress'); ?></option>
							<?php foreach( get_title_list_array('event_location') as $values){?>
								<option value="<?php echo $values->ID;?>" <?php if($event_location_select == $values->ID){echo 'selected';}?>><?php echo $values->post_title;?></option>
							<?php }?>
						</select>
					</div>
				</li>
				<li class="description"><p><?php _e('Please select your event venue.', 'crunchpress'); ?></p></li>			
			</ul>
			<ul class="recipe_class top-bg">
				<li><h2><?php _e('Event Schedule', 'crunchpress'); ?></h2></li>
			</ul>
			<ul class="schedule_head recipe_class">
				<li class="panel-title">
					<label for="schedule_head" > <?php _e('Schedule Heading', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="schedule_head" id="schedule_head" value="<?php if($schedule_head <> ''){echo $schedule_head;};?>" />
				</li>
				<li class="description"><p><?php _e('Please write schedule heading here.', 'crunchpress'); ?></p></li>
			</ul>
			<ul class="schedule_descrip recipe_class">
				<li class="panel-title">
					<label for="schedule_descrip" > <?php _e('Schedule Descripton', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="schedule_descrip" id="schedule_descrip" value="<?php if($schedule_descrip <> ''){echo $schedule_descrip;};?>" />
				</li>
				<li class="description"><p><?php _e('Please write schedule heading here.', 'crunchpress'); ?></p></li>
			</ul>
			<ul class="recipe_class">
				<li class="panel-title"><h4><?php _e('Start Time', 'crunchpress'); ?></h4></li>
				<li class="panel-title border_left"><h4><?php _e('End Time', 'crunchpress'); ?></h4></li>
				<li class="panel-title border_left"><h4><?php _e('Description', 'crunchpress'); ?></h4></li>
				<li class="panel-title border_left"><h4><?php _e('Add / Delete', 'crunchpress'); ?></h4></li>
			</ul>
			<ul class="recipe_class">
				<li class="panel-title time-start">
					<input type="text" class="time_picker" id="add-more-name" value="Select start time" rel="Select start time">
				</li>
				<li class="panel-title border_left time_end">
					<input type="text" class="time_picker" id="add-more-title" value="Select end time" rel="Select end time">
				</li>
				<li class="panel-title border_left desc_start">
					<textarea id="add-more-desc" value="Enter Description here" rel="Enter description here" col="5"></textarea>
				</li>
				<li class="panel-title border_left delete_btn"><div id="add-more-elements" class="add-more-element"></div></li>
			</ul>	
				<div class="clear"></div>
				<ul id="selected-element" class="selected-element nut_table_inner">
					<li class="default-element-item" id="element-item">
						<ul class="career_salary_class recipe_class">
							<li class="panel-title">
								<input class="element-item-name" type="text" id="add-more-name" value="Select start time" rel="Select Start Time">
								<!--<span class="ingre-item-text"></span>-->
							</li>	
							<li class="panel-title border_left">
								<input class="element-item-title" type="text" id="add-more-title" value="Select end time" rel="Select End Time">
								<!--<span class="ingre-item-text"></span>-->
							</li>								
							<li class="panel-title border_left">
								<textarea class="element-item-desc" id="add-more-desc" rel="Enter description here" col="5"></textarea>
								<!--<span class="ingre-item-text"></span>-->
							</li>
							<li class="panel-title border_left"><span class="panel-delete-element"></span></li>
						</ul>
					</li>
				</ul>
				<?php

				$children = '';
				$children_title = '';

				//Sidebar addition
				if($name_post_schedule <> ''){
					$ingre_xml = new DOMDocument();
					$ingre_xml->recover = TRUE;
					$ingre_xml->loadXML($name_post_schedule);
					$children_name = $ingre_xml->documentElement->childNodes;
				}		
				
				if($title_post_schedule <> ''){	
					$ingre_title_xml = new DOMDocument();
					$ingre_title_xml->recover = TRUE;
					$ingre_title_xml->loadXML($title_post_schedule);
					$children_title = $ingre_title_xml->documentElement->childNodes;
				}
				
				if($des_post_schedule <> ''){	
					$ingre_schedule_xml = new DOMDocument();
					$ingre_schedule_xml->recover = TRUE;
					$ingre_schedule_xml->loadXML($des_post_schedule);
					$children_des = $ingre_schedule_xml->documentElement->childNodes;
					
				}
					
					
				if($name_post_schedule <> '' || $title_post_schedule <> '' || $des_post_schedule <> ''){
					$counter = 0;
					//$ingre_xml->documentElement->childNodes;
					$nofields = $ingre_xml->documentElement->childNodes->length;
					for($i=0;$i<$nofields;$i++) { 
						$counter++;?>
							<ul class="career_salary_class recipe_class">
								<li class="panel-title">
									<input class="time_picker" type="text" name="add-more-name[]" value="<?php echo $children_name->item($i)->nodeValue;?>">
									<!--<span class="ingre-item-text"></span>-->
								</li>	
								<li class="panel-title border_left">
									<input class="time_picker" type="text" name="add-more-title[]" value="<?php echo $children_title->item($i)->nodeValue;?>">
									<!--<span class="ingre-item-text"></span>-->
								</li>								
								<li class="panel-title border_left">
									<textarea class="element-item-desc" name="add-more-desc[]" col="5"><?php echo $children_des->item($i)->nodeValue;?></textarea>
									<!--<span class="ingre-item-text"></span>-->
								</li>
								<li class="panel-title border_left"><span class="panel-delete-element"></span></li>
							</ul>
						<?php
					}
				}
				?>
			<ul class="recipe_class top-bg">
				<li><h2><?php _e('Event Organizer Settings', 'crunchpress'); ?></h2></li>
			</ul>
			<ul class="team_parti_head recipe_class">
				<li class="panel-title">
					<label for="team_parti_head" > <?php _e('Team / Participants Heading', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="team_parti_head" id="team_parti_head" value="<?php if($team_parti_head <> ''){echo $team_parti_head;};?>" />
				</li>
				<li class="description"><p><?php _e('Please write schedule heading here.', 'crunchpress'); ?></p></li>
			</ul>
			<ul class="team_parti_descrip recipe_class">
				<li class="panel-title">
					<label for="team_parti_descrip" > <?php _e('Team / Participants Descripton', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="team_parti_descrip" id="team_parti_descrip" value="<?php if($team_parti_descrip <> ''){echo $team_parti_descrip;};?>" />
				</li>
				<li class="description"><p><?php _e('Please write schedule description here.', 'crunchpress'); ?></p></li>
			</ul>
			<ul class="recipe_class">
				<li class="panel-input less_width">
					<label for="select_organizer"><h4><?php _e('Click or Select Organizer / Participants', 'crunchpress'); ?></h4></label>
				</li>
				<li class="panel-input less_width">
					<label for="select_organizer"><h4><?php _e('Selected Organizer / Participants', 'crunchpress'); ?></h4></label>
				</li>
			</ul>
			<ul class="recipe_class">
				<?php 
					$array_difference = '';
					$array_variable = '';
					if($sch_select_organizer <> ''){	
						$schedule_title_xml = new DOMDocument();
						$schedule_title_xml->loadXML($sch_select_organizer);
						$children_des = $schedule_title_xml->documentElement->childNodes;
						$nofields = $schedule_title_xml->documentElement->childNodes->length;
						$array_variable = return_xml_array($children_des);
						//print_r($array_variable);
						$array_difference = array_diff(get_slug_id('teams'),$array_variable);
						//print_r($dd);
					}else{
						if($array_difference == ''){
							$array_difference = get_slug_id('teams');
						}
					}
					?>
				<li class="panel-input less_width">	
					<ul id="element_handler">
					<?php 
					if($array_difference <> ''){
						foreach($array_difference as $values){?>
						<li class="item_team" rel="<?php echo $values;?>"><a class="draggable"><?php echo get_the_post_thumbnail($values, array(60,60));?><span id="<?php echo $values;?>"><?php echo get_the_title($values);?></span></a></li>
					<?php }
					}
					?>	
					</ul>
				</li>
				<li class="panel-input less_width">
					<ul id="element_container">
						<li id="element_sec" class="element_sec item_team " ><img class="element-item-name" title="" src="" /><span></span><input class="element_text" type="hidden" value=""><div class="organ-delete-element"></div></li>
					</ul>
					<ul id="element_container_abc">
						<?php if($array_variable <> ''){ 
							foreach($array_variable as $values){?>
							<li id="element_sec" class="element_sec item_team" ><?php echo get_the_post_thumbnail($values, array(60,60));?><span><?php echo get_the_title($values);?></span><input class="element_text" type="hidden" name="select_organizer[]" value="<?php echo $values;?>"><div class="organ-delete-element"></div></li>
							<?php }?>
						<?php }?>
					</ul>
				</li>			
			</ul>
			<div class="clear"></div>
			<input type="hidden" name="event_submit" value="events"/>
			<div class="clear"></div>
		</div>	
		<div class="clear"></div>
		
	<?php }
	add_action('save_post','save_event_option_meta');
	function save_event_option_meta($post_id){
		
		$event_social = '';
		$sidebars = '';
		$right_sidebar_event = '';
		$left_sidebar_event = '';
		$event_start_date = '';
		$event_end_date = '';
		$event_start_time = '';
		$event_end_time = '';
		$entry_level = '';
		$additional_info = '';
		$event_detail_xml = '';
		$booking_url = '';
		$event_thumbnail = '';
		$video_url_type = '';
		$select_slider_type = '';
		$event_location_select = '';
		$schedule_head = '';
		$schedule_descrip = '';
		$team_parti_head = '';
		$team_parti_descrip = '';
		
		foreach($_REQUEST as $keys=>$values){
			$$keys = $values;
		}
	
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
	
			if(isset($event_submit) AND $event_submit == 'events'){
				$new_data = '<event_detail>';
				$new_data = $new_data . create_xml_tag('event_social',$event_social);
				$new_data = $new_data . create_xml_tag('sidebar_event',$sidebars);
				$new_data = $new_data . create_xml_tag('right_sidebar_event',$right_sidebar_event);
				$new_data = $new_data . create_xml_tag('left_sidebar_event',$left_sidebar_event);
				$new_data = $new_data . create_xml_tag('event_start_time',$event_start_time);
				$new_data = $new_data . create_xml_tag('event_end_time',$event_end_time);
				$new_data = $new_data . create_xml_tag('entry_level',$entry_level);
				$new_data = $new_data . create_xml_tag('additional_info',htmlspecialchars(stripslashes($additional_info)));
				$new_data = $new_data . create_xml_tag('booking_url',htmlspecialchars(stripslashes($booking_url)));
				$new_data = $new_data . create_xml_tag('event_thumbnail',$event_thumbnail);
				$new_data = $new_data . create_xml_tag('video_url_type',$video_url_type);
				$new_data = $new_data . create_xml_tag('select_slider_type',$select_slider_type);
				$new_data = $new_data . create_xml_tag('event_location_select',$event_location_select);
				$new_data = $new_data . create_xml_tag('schedule_head',$schedule_head);
				$new_data = $new_data . create_xml_tag('schedule_descrip',$schedule_descrip);
				$new_data = $new_data . create_xml_tag('team_parti_head',$team_parti_head);
				$new_data = $new_data . create_xml_tag('team_parti_descrip',$team_parti_descrip);
				$new_data = $new_data . '</event_detail>';
				//Saving Sidebar and Social Sharing Settings as XML
				$old_data = get_post_meta($post_id, 'event_detail_xml',true);
				save_meta_data($post_id, $new_data, $old_data, 'event_detail_xml');
				
				if(isset($event_start_date) AND $event_start_date <> ''){
					$new_data_date = $event_start_date;
				}else if(isset($event_start_date)){
					$new_data_date = '';
				}
				//Saving Start Date Plus Time in Database
				$old_data = get_post_meta($post_id, 'event_start_date',true);
				save_meta_data($post_id, $new_data_date, $old_data, 'event_start_date');
				
				if(isset($event_end_date) AND $event_end_date <> ''){
					$new_data_date_end = $event_end_date;
				}else if(isset($event_end_date)){
					$new_data_date_end = '';
				}
			
				//Saving End Date Plus Time in Database
				$old_data = get_post_meta($post_id, 'event_end_date',true);
				save_meta_data($post_id, $new_data_date_end, $old_data, 'event_end_date');
			
			
				$schedule_name_post_xml = '<time_start_xml>';
				if(isset($_POST['add-more-name'])){$name_post_schedule = $_POST['add-more-name'];
					foreach($name_post_schedule as $keys=>$values){
						$schedule_name_post_xml = $schedule_name_post_xml . create_xml_tag('name_post_schedule',$values);
					}
				}else{$name_post_schedule = '';}
				$schedule_name_post_xml = $schedule_name_post_xml . '</time_start_xml>';
			
				//Date Posted
				$old_data = get_post_meta($post_id, 'name_post_schedule',true);
				save_meta_data($post_id, $schedule_name_post_xml, $old_data, 'name_post_schedule');
				
				$schedule_title_post_xml = '<time_end_xml>';
				if(isset($_POST['add-more-title'])){$sch_post_title = $_POST['add-more-title'];
					foreach($sch_post_title as $keys=>$values){
						$schedule_title_post_xml = $schedule_title_post_xml . create_xml_tag('title_post_schedule',$values);
					}
				}else{$sch_post_title = '';}
				$schedule_title_post_xml = $schedule_title_post_xml . '</time_end_xml>';
			
				//Date Posted
				$old_data = get_post_meta($post_id, 'title_post_schedule',true);
				save_meta_data($post_id, $schedule_title_post_xml, $old_data, 'title_post_schedule');
				
				$schedule_des_post_xml = '<desc_end_xml>';
				if(isset($_POST['add-more-desc'])){$des_post_schedule = $_POST['add-more-desc'];
					foreach($des_post_schedule as $keys=>$values){
						$schedule_des_post_xml = $schedule_des_post_xml . create_xml_tag('des_post_schedule',$values);
					}
				}else{$des_post_schedule = '';}
				$schedule_des_post_xml = $schedule_des_post_xml . '</desc_end_xml>';
			
				//Date Posted
				$old_data = get_post_meta($post_id, 'des_post_schedule',true);
				save_meta_data($post_id, $schedule_des_post_xml, $old_data, 'des_post_schedule');
				
				$schedule_organ_post_xml = '<organizer_xml>';
				if(isset($_POST['select_organizer'])){$sch_select_organizer = $_POST['select_organizer'];
					foreach($sch_select_organizer as $keys=>$values){
						$schedule_organ_post_xml = $schedule_organ_post_xml . create_xml_tag('sch_select_organizer',$values);
					}
				}else{$sch_select_organizer = '';}
				$schedule_organ_post_xml = $schedule_organ_post_xml . '</organizer_xml>';
			
				//Date Posted
				$old_data = get_post_meta($post_id, 'sch_select_organizer',true);
				save_meta_data($post_id, $schedule_organ_post_xml, $old_data, 'sch_select_organizer');
			}
	}
	
	
	
	//EVENT FRONTEND AREA START
	$event_div_listing_num_class = array(
		"Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1170,420), "size2"=>array(770, 400), "size3"=>array(570,300)),
		"Small-Thumbnail" => array("index"=>"2", "class"=>"sixteen", "size"=>array(175,155), "size2"=>array(175,155), "size3"=>array(175,155)));

	
	// Print Event item
	function print_event_item($item_xml){

		wp_reset_query();
		echo '<div id="content">';
		global $paged,$sidebar,$event_div_listing_num_class,$post,$counter;
		
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		$item_type = 'Full-Image';
		// get the item class and size from array
		$item_class = '';
		if( $sidebar == "no-sidebar" ){
			$item_size = $event_div_listing_num_class[$item_type]['size'];
			$calendar_width = '900';
			$item_class = 'full_sidebar_class';
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $event_div_listing_num_class[$item_type]['size2'];
			$calendar_width = '600';
		}else{
			$item_size = $event_div_listing_num_class[$item_type]['size3'];
			$calendar_width = '400';
			$item_class = 'both_sidebar_class';
		}
		
				
		// get the blog meta value		
		$header = find_xml_value($item_xml, 'header');
		$eventview = find_xml_value($item_xml, 'eventview');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		$event_type = find_xml_value($item_xml, 'eventtype');
		$read_more = find_xml_value($item_xml, 'read-more');
		
				
		$category = find_xml_value($item_xml, 'category');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'event-category');
			$category = $category_term->slug;
		}
		
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
						<?php _e('Event Categories','crunchcpress');?>
						<span class="caret"></span>
					</a>
					<div id="listing_dropdown" role="menu" aria-labelledby="cart_down" class="dropdown-menu">
						<ul>                    
							<?php
							$get_categories = get_categories( array('child_of' => $category, 'taxonomy' => 'event-category', 'hide_empty' => 0,'post_status' => 'publish') );
							if($get_categories <> ""){
								foreach ( $get_categories as $mycat ) { ?>
								<li><?php echo $mycat->cat_name;?><a href="<?php echo get_term_link(intval($mycat->term_id),'event-category');?>"><?php echo $mycat->count;?></a></li>
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
	wp_reset_query();
	
	
		if($event_type == 'Upcoming Events'){
			query_posts(array(
				'posts_per_page'			=> $num_fetch,
				'paged'						=> $paged,
				'post_type'					=> 'events',
				'event-category'			=> $category,
				'post_status'				=> 'publish',
				'meta_key'					=> 'event_start_date',
				'meta_value'				=> date('m/d/Y'),
				'meta_compare'				=> '>=',
				'orderby'					=> 'meta_value',
				'order'						=> 'ASC',
				));
		}else if($event_type == 'Past Events'){
			query_posts(array(
				'posts_per_page'			=> $num_fetch,
				'paged'						=> $paged,
				'post_type'					=> 'events',
				'event-category'			=> $category,
				'post_status'				=> 'publish',
				'meta_key'					=> 'event_start_date',
				'meta_value'				=> date('m/d/Y'),
				'meta_compare'				=> '<=',
				'orderby'					=> 'meta_value',
				'order'						=> 'DESC',
				));
		}else{
			if($category <> 'All' AND $category <> ''){
			query_posts(array(
				'posts_per_page'			=> $num_fetch,
				'paged'						=> $paged,
				'post_type'					=> 'events',
				'event-category'			=> $category,
				'post_status'				=> 'publish',
				'order'						=> 'ASC',
				));
			}else{
			query_posts(array(
				'posts_per_page'			=> $num_fetch,
				'paged'						=> $paged,
				'post_type'					=> 'events',
				'post_status'				=> 'publish',
				'order'						=> 'ASC',
				));
			
			}
		}	
		if($eventview == 'Listing View'){		
			wp_register_script('countdown', CP_PATH_URL.'/frontend/js/jquery_countdown.js', false, '1.0', true);
			wp_enqueue_script('countdown');
			while( have_posts() ){
				the_post();	
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
					$event_start_time_def = find_xml_value($cp_event_xml->documentElement,'event_start_time');
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
					$event_start_time = date("G,i,s", strtotime($event_start_time_def));
					
					
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
			<script>
				jQuery(document).ready(function($) {
					var austDay = new Date();
					austDay = new Date(<?php echo $event_year;?>, <?php echo $event_month;?>-1, <?php echo $event_day;?>,<?php echo $event_start_time;?>);
					$('#countdown-<?php echo $post->ID.$counter;?>').countdown({
					labels: ['<?php _e('Years','crunchpress');?>', '<?php _e('Months','crunchpress');?>', '<?php _e('Weeks','crunchpress');?>', '<?php _e('Days','crunchpress');?>', '<?php _e('Hours','crunchpress');?>', '<?php _e('Minutes','crunchpress');?>', '<?php _e('Seconds','crunchpress');?>'],
					until: austDay});
					$('#year').text(austDay.getFullYear());
				});                
			</script>
			<figure id="event_grid" class="span12 first outer_lyr mbtm2">
				<div class="inner_lyr">
					<?php print_event_thumbnail($post->ID,$item_size);?>
					<div class="event_info">
						<div class="span4 first event_info_pad" id="event_title">
							<h3><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h3>
							<p><?php echo date(get_option('date_format'),strtotime($event_start_date));?><span><?php echo date(get_option('time_format'),strtotime($event_start_time_def));?> - <?php echo date(get_option('time_format'),strtotime($event_end_time));?></span></p>
						</div>
						<div class="span4 event_info_pad" id="event_loc">
							<h3><a href="<?php echo get_permalink();?>" title="Event Venue"><i class="icon-map-marker"></i><?php echo $map_search_field;?></a></h3>
						</div>
						<div class="span4" id="event_counter">
							<div id="countdown-<?php echo $post->ID.$counter;?>"></div>
						</div>
					</div>
				</div>
 			</figure>
			<?php	
			}//End While
		
		
		?>
		</div>
		<div class="clear"></div>
		<div id="loader"></div>
		<?php
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}	
		
	 
	 }else{
	 wp_reset_query();
	 wp_reset_postdata();
			global $post_id,$wp_query,$post;	 
			if($event_type == 'Upcoming Events'){
				query_posts(array(
					'posts_per_page'			=> -1,
					'post_type'					=> 'events',
					'event-category'			=> $category,
					'post_status'				=> 'publish',
					'meta_key'					=> 'event_start_date',
					'meta_value'				=> date('m/d/Y'),
					'meta_compare'				=> '>=',
					'orderby'					=> 'meta_value',
					'order'						=> 'DESC',
					));
			}else if($event_type == 'Past Events'){
				query_posts(array(
					'posts_per_page'			=> -1,
					'post_type'					=> 'events',
					'event-category'			=> $category,
					'post_status'				=> 'publish',
					'meta_key'					=> 'event_start_date',
					'meta_value'				=> date('m/d/Y'),
					'meta_compare'				=> '<=',
					'orderby'					=> 'meta_value',
					'order'						=> 'DESC',
					));
			}else{
				if($category <> 'All' AND $category <> ''){
				query_posts(array(
					'posts_per_page'			=> -1,
					'post_type'					=> 'events',
					'event-category'			=> $category,
					'post_status'				=> 'publish',
					'order'						=> 'DESC',
					));
				}else{
				query_posts(array(
					'posts_per_page'			=> -1,
					'post_type'					=> 'events',
					'post_status'				=> 'publish',
					'order'						=> 'DESC',
					));
				
				}
			}
			$category_des = find_xml_value($item_xml, 'category');
			//$category_des = ( $category_des == 'All' )? '': $category_des;
			if( !empty($category_des) AND $category_des <> 'All'){
				$category_term = get_term_by( 'name', $category_des , 'event-category');
			}
			?>
		<div class="event_calander">
				<section class="span3 first" id="calander_list">
					<?php if($header <> ''){?><h1> <?php echo $header;?> </h1><?php }?>
					<?php if($event_type <> ''){?><em> <?php echo $event_type;?> </em><?php }?>
					<?php if($category_des == 'All'){ ?><p><?php _e('Please Select Specific Category to Show its description','crunchpress'); ?></p><?php }else{ ?><p> <?php echo $category_term->description;?></p><?php }?>
					<ul id="tiers">
					<?php
					while( have_posts() ){
					the_post();	
					$event_start_date = get_post_meta($post->ID, 'event_start_date', true);
					$event_end_date = get_post_meta($post->ID, 'event_end_date', true);
					?>
					<?php 
					$date_format = get_option('date_format');
					$time_format = get_option('time_format');
					?>
					<li><span class="span12 first"><?php echo get_the_title();?> - <em><?php echo date($date_format,strtotime($event_start_date));?></em> <a class="donate_btn pull-right" href="<?php echo get_permalink();?>"><?php _e('More','crunchpress');?></a></span></li>
					<?php }?>
					</ul>
				</section>
			<?php
			//Calendar Name
			$calendar_name = 'event_calander';
			echo calendar_function($calendar_name);?>
			<style type='text/css'>
				#<?php echo $calendar_name;?> {
					width: 100%;
					margin: 0 auto;
				}
			</style>

			<div id="calendar" class="span9">
				<div class="full_calendar" id='<?php echo $calendar_name;?>'></div>
			</div>
		</div>
	<?php 
		}
	}	
	
	// print the blog thumbnail
	function print_event_thumbnail( $post_id, $item_size ){
	global $counter;
	
		$event_detail_xml = get_post_meta($post_id, 'event_detail_xml', true);
		if($event_detail_xml <> ''){
			$cp_event_xml = new DOMDocument ();
			$cp_event_xml->loadXML ( $event_detail_xml );
			$event_thumbnail = find_xml_value($cp_event_xml->documentElement,'event_thumbnail');
			$video_url_type = find_xml_value($cp_event_xml->documentElement,'video_url_type');
			$select_slider_type = find_xml_value($cp_event_xml->documentElement,'select_slider_type');
		}
		
		if( $event_thumbnail == "Image" || empty($event_thumbnail) ){
				echo '<div class="thumbnail_image">';
					echo get_the_post_thumbnail($post_id, $item_size);
				echo '</div>';
		
		}else if( $event_thumbnail == "Video" ){
			
			echo '<div class="blog-thumbnail-video">';
			echo get_video($video_url_type, cp_get_width($item_size), cp_get_height($item_size));
			echo '</div>';
			
		}else if ( $event_thumbnail == "Slider" ){
		$slider_name="slider".$counter.$post_id;
		//Included Anything Slider Script
			wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
			wp_enqueue_script('cp-bx-slider');	
			wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
		?>
		<style>
			#<?php echo $slider_name;?>{
			width:<?php echo cp_get_width($item_size)?>px !important;
			height:<?php echo cp_get_height($item_size)?>px !important;
			}
		</style>
		<?php
			
			$slider_xml = get_post_meta( $select_slider_type, 'cp-slider-xml', true);
			if($slider_xml <> ''){
				$slider_xml_dom = new DOMDocument();
				$slider_xml_dom->loadXML($slider_xml);
				
				echo '<div class="post_featured_image thumbnail_image">';
					echo print_bx_slider($slider_xml_dom->documentElement, $item_size);
				echo '</div>';	
			}
		}	
		
	}
	
	//Print Venue Information
	function print_venue_item($item_xml){
		
		global $paged, $post;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		$header = find_xml_value($item_xml, 'header');
		$location = find_xml_value($item_xml, 'location');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		
		
		if(!empty($header)){
			echo '<h2 class="heading">' . $header . '</h2>';
			echo '<span class="border-line m-bottom"></span>';
		}
		
		
		//Get Post id by Slug
		//$event_slider_slug = get_posts(array('post_type' => 'event_location','name' => $location,'numberposts' => 1));
		echo '<section class="event_detail">';
		if($location <> ''){
			//Location Detail	
			$map_search_field = '';
			$event_latitude = '';
			$event_longitude = '';
			$event_zoom = '';
			$event_loc_xml = get_post_meta($location, 'event_loc_xml', true);
			if($event_loc_xml <> ''){
				$cp_event_xml = new DOMDocument ();
				$cp_event_xml->loadXML ( $event_loc_xml );
				$map_search_field = find_xml_value($cp_event_xml->documentElement,'map_search_field');
				$event_latitude = find_xml_value($cp_event_xml->documentElement,'event_latitude');
				$event_longitude = find_xml_value($cp_event_xml->documentElement,'event_longitude');
				$event_zoom = find_xml_value($cp_event_xml->documentElement,'event_zoom');
			}
			?>
			<figure id="event_detail" class="span12 first outer_lyr">
				<div class="inner_lyr">
					<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
					<script>
					jQuery(function () {
					var map;
							var myLatLng = new google.maps.LatLng(<?php echo $event_latitude;?>, <?php echo $event_longitude;?>)
							//Initialize MAP
							var myOptions = {
							  zoom: <?php echo $event_zoom;?>,
							  center: myLatLng,
							  disableDefaultUI: true,
							  zoomControl: true,
							  mapTypeId: google.maps.MapTypeId.ROADMAP
							};
							map = new google.maps.Map(document.getElementById('map_canvas<?php echo $location;?>'),myOptions);
							//End Initialize MAP
							//Set Marker
							var marker = new google.maps.Marker({
							  position: map.getCenter(),
							  map: map
							});
							marker.getPosition();
							//End marker
							
							//Set info window
							var infowindow = new google.maps.InfoWindow({
								content: '',
								position: myLatLng
							});
							infowindow.open(map);
						});
					</script>
					<div id="map_canvas<?php echo $location;?>" class="span12 first outer_lyr map_canvas"></div>
				</div>
			</figure>
			<?php
			query_posts(array(
				'posts_per_page'			=> $num_fetch,
				'paged'						=> $paged,
				'post_type'					=> 'events',
				'post_status'				=> 'publish',
				'order'						=> 'ASC',
				));
			$counter_venue = 0;
			while( have_posts() ){
				the_post();	
				$counter_venue++;
				global $post,$post_id;
				//Event Detail
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
					$booking_url = find_xml_value($cp_event_xml->documentElement,'booking_url');
					$video_url_type = find_xml_value($cp_event_xml->documentElement,'video_url_type');
					$select_slider_type = find_xml_value($cp_event_xml->documentElement,'select_slider_type');
					$event_location_select = find_xml_value($cp_event_xml->documentElement,'event_location_select');
				}
				
				
				//Get Date in Parts
				$event_year = date('Y',strtotime($event_start_date));
				$event_month = date('m',strtotime($event_start_date));
				$event_month_alpha = date('M',strtotime($event_start_date));
				$event_day = date('d',strtotime($event_start_date));
				
				//Change time format
				
				
				if($location == $event_location_select){
					//Location Condition
					wp_register_script('countdown', CP_PATH_URL.'/frontend/js/jquery_countdown.js', false, '1.0', true);
					wp_enqueue_script('countdown');
					
					if($counter_venue == 1){ 
					$event_start_time = date("G,i,s", strtotime($event_start_time));
					?>
					<script>
						jQuery(document).ready(function($) {
							var austDay = new Date();
							austDay = new Date(<?php echo $event_year;?>, <?php echo $event_month;?>-1, <?php echo $event_day;?>,<?php echo $event_start_time;?>)
							jQuery('#countdown<?php echo $post->ID?>').countdown({
							labels: ['<?php _e('Years','crunchpress');?>', '<?php _e('Months','crunchpress');?>', '<?php _e('Weeks','crunchpress');?>', '<?php _e('Days','crunchpress');?>', '<?php _e('Hours','crunchpress');?>', '<?php _e('Minutes','crunchpress');?>', '<?php _e('Seconds','crunchpress');?>'],
							until: austDay});
							jQuery('#year').text(austDay.getFullYear());
						});                
					</script>
					<figure id="event_grid" class="span12 first outer_lyr mbtm">
						<div class="inner_lyr">
							<div class="event_info">
								<div class="span4 first" id="event_title">
									<h3><?php echo get_the_title();?></h3>
									<p><?php echo date('M, d, Y',strtotime($event_start_date));?></p>
								</div>
								<div class="span4" id="event_loc">
									<h3><i class="icon-map-marker"></i><?php echo $map_search_field;?></h3>
								</div>
								<div class="span4" id="countdown<?php echo $post->ID?>"></div>
							 </div>
						</div>					
					</figure>
					<?php }else{ ?>
					<div id="tiers">
						<div><span class="span4 first"> <?php echo date('M, d, Y',strtotime($event_start_date));?> : <?php echo $event_start_time;?> - <?php echo $event_end_time;?> </span><span class="span8"><?php echo strip_tags(substr(get_the_content(),0,70));?><a href="<?php echo get_permalink();?>" class="donate_btn pull-right"><?php _e('Read More','Crunchpress');?></a></span></div>
					</div>	
					<?php } 
				} //Location Condition
			} // Loop Ends
		} //Location Slug Condition Ends
		echo '</section>';
	}
	
?>