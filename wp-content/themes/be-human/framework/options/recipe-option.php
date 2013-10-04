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
	
	add_action( 'init', 'create_recipes' );
	function create_recipes() {
		//$portfolio_translation = get_option(THEME_NAME_S.'_cp_portfolio_slug','portfolio');
		
		$labels = array(
			'name' => _x('City Attractions', 'City Attraction General Name', 'crunchpress'),
			'singular_name' => _x('City Attraction Item', 'City Attraction Singular Name', 'crunchpress'),
			'add_new' => _x('Add New', 'Add New Attraction Name', 'crunchpress'),
			'add_new_item' => __('Add New City Attraction', 'crunchpress'),
			'edit_item' => __('Edit City Attraction', 'crunchpress'),
			'new_item' => __('New City Attraction', 'crunchpress'),
			'view_item' => __('View City Attraction', 'crunchpress'),
			'search_items' => __('Search City Attraction', 'crunchpress'),
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
			'menu_icon' => CP_PATH_URL . '/framework/images/attraction-icon.png',
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
			'rewrite' => array('slug' => 'attraction', 'with_front' => false)
		  ); 
		  
		register_post_type( 'attraction' , $args);
		
		// adding Manage Location start
			$labels = array(
				'name' => __('Manage Location', 'crunchpress'),
				'add_new_item' => __('Add New Location', 'crunchpress'),
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
				'menu_icon' => get_stylesheet_directory_uri() . '/images/attraction-icon.png',
				'show_in_menu' => 'edit.php?post_type=attraction',
				'show_in_nav_menus'=>true,
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title')
			); 
			register_post_type( 'attraction_location' , $args );  
			// adding Manage Location end
		
		
		register_taxonomy(
			"attraction-category", array("attraction"), array(
				"hierarchical" => true,
				"label" => "Attraction Categories", 
				"singular_label" => "Attraction Categories", 
				"rewrite" => true));
		register_taxonomy_for_object_type('attraction-category', 'attraction');
		
		register_taxonomy(
			"attraction-tag", array("attraction"), array(
				"hierarchical" => false, 
				"label" => "Attraction Tag", 
				"singular_label" => "Attraction Tag", 
				"rewrite" => true));
		register_taxonomy_for_object_type('attraction-tag', 'attraction');
		
	}
	
	
	add_action('add_meta_boxes', 'add_recipes_option');
	function add_recipes_option(){	
	
		add_meta_box('attraction-option', __('City Attraction Options','crunchpress'), 'add_recipe_option_element',
			'attraction', 'normal', 'high');
		add_meta_box('attraction_location', __('Attraction Location','crunchpress'), 'add_attraction_location_element',
			'attraction_location', 'normal', 'high');	
			
	}
	
	function add_attraction_location_element(){ 
	
	$map_search_field = '';
	$attraction_latitude = '';
	$attraction_longitude = '';
	$attraction_zoom = '';
	foreach($_REQUEST as $keys=>$values){
		$$keys = $values;
	}
	global $post;
		
	$event_loc_xml = get_post_meta($post->ID, 'attrac_loc_xml', true);
	if($event_loc_xml <> ''){
		$cp_event_xml = new DOMDocument ();
		$cp_event_xml->loadXML ( $event_loc_xml );
		$map_search_field = find_xml_value($cp_event_xml->documentElement,'map_search_field');
		$attraction_latitude = find_xml_value($cp_event_xml->documentElement,'attraction_latitude');
		$attraction_longitude = find_xml_value($cp_event_xml->documentElement,'attraction_longitude');
		$attraction_zoom = find_xml_value($cp_event_xml->documentElement,'attraction_zoom');
	}
	
	?>
	<form>
		<div class="event_options gllpLatlonPicker">
			<ul class="recipe_class top-bg">
				<li><h2>Attraction Location Detail</h2></li>
			</ul>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="map_search_field" > <?php _e('Address', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" class="gllpSearchField" name="map_search_field" id="map_search_field" value="<?php if($map_search_field <> ''){echo $map_search_field;};?>" />
					<input type="hidden" name="attraction_zoom" class="gllpZoom" value="<?php echo $attraction_zoom;?>"/>
					<input type="button" class="gllpSearchButton" value="search">
					<!--<input type="button" class="gllpUpdateButton" value="update map">-->
				</li>
				<li class="description"><p><?php _e('Please search your location then use drag and drop to mark your location.', 'crunchpress'); ?></p></li>
			</ul>
			<ul class="recipe_class">
			<li class=" gllpMap" style="height:400px"></li>
				<div class="clear"></div>
				<input type="hidden" name="attraction_latitude" class="gllpLatitude" value="<?php echo $attraction_latitude;?>"/>
				<input type="hidden" name="attraction_longitude" class="gllpLongitude" value="<?php echo $attraction_longitude;?>"/>
				<input type="hidden" name="attraction_loc_submit" value="attraction_location"/>
				<div class="clear"></div>
			</ul>	
		</div>	
		<div class="clear"></div>
	</form>
	<?php
	}
	add_action('save_post','save_attrac_location_meta');
	function save_attrac_location_meta($post_id){
		
		$map_search_field = '';
		$event_latitude = '';
		$event_longitude = '';	
		$event_zoom = '';
		
		foreach($_REQUEST as $keys=>$values){
			$$keys = $values;
		}
		
		global $post,$post_id;
		
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
	
			if(isset($attraction_loc_submit) AND $attraction_loc_submit == 'attraction_location'){
				$new_data = '<attraction_loc>';
				$new_data = $new_data . create_xml_tag('map_search_field',$map_search_field);
				$new_data = $new_data . create_xml_tag('attraction_latitude',$attraction_latitude);
				$new_data = $new_data . create_xml_tag('attraction_longitude',$attraction_longitude);
				$new_data = $new_data . create_xml_tag('attraction_zoom',$attraction_zoom);
				$new_data = $new_data . '</attraction_loc>';

			//Saving Sidebar and Social Sharing Settings as XML
			$old_data = get_post_meta($post_id, 'attrac_loc_xml',true);
			save_meta_data($post_id, $new_data, $old_data, 'attrac_loc_xml');
		
		}
		
	}
	
	
	$attraction_meta_box = array(	
		"Gallery Picker" => array(
			'type'=>'gallerypicker',
			'title'=> __('SELECT IMAGES', 'crunchpress'),
			'xml'=>'attraction-option-gallery-xml',
			'name'=>array(
				'image'=>'post-option-inside-thumbnail-slider-image',
				'title'=>'post-option-inside-thumbnail-slider-title',
				'caption'=>'post-option-inside-thumbnail-slider-caption',
				'link'=>'post-option-inside-thumbnail-slider-link',
				'linktype'=>'post-option-inside-thumbnail-slider-linktype',
				'video'=> 'post-option-inside-thumbnail-slider-video'),
			'hr'=>'none'
		)	
	);
	
	function add_recipe_option_element(){
		
		$rating_txt = '';
		$additional_info = '';
		$website_info = '';
		$pets_allowed = '';
		$portfolio_thumbnail = '';
		$video_url_type = '';
		$select_slider_type = '';
		$recipe_social = '';
		$sidebars = '';
		$attrac_location_select = '';
		$right_sidebar_recipe = '';
		$left_sidebar_recipe = '';
		$recipe_detail_xml = '';
		
	
	
	foreach($_REQUEST as $keys=>$values){
		$$keys = $values;
	}
	global $post,$attraction_meta_box;
	
	$recipe_detail_xml = get_post_meta($post->ID, 'recipe_detail_xml', true);
	if($recipe_detail_xml <> ''){
		$cp_recipe_xml = new DOMDocument ();
		$cp_recipe_xml->loadXML ( $recipe_detail_xml );
		$rating_txt = find_xml_value($cp_recipe_xml->documentElement,'rating_txt');
		$additional_info = find_xml_value($cp_recipe_xml->documentElement,'additional_info');
		$website_info = find_xml_value($cp_recipe_xml->documentElement,'website_info');
		$pets_allowed = find_xml_value($cp_recipe_xml->documentElement,'pets_allowed');
		$portfolio_thumbnail = find_xml_value($cp_recipe_xml->documentElement,'portfolio_thumbnail');
		$video_url_type = find_xml_value($cp_recipe_xml->documentElement,'video_url_type');
		$select_slider_type = find_xml_value($cp_recipe_xml->documentElement,'select_slider_type');
		$recipe_social = find_xml_value($cp_recipe_xml->documentElement,'recipe_social');
		$attrac_location_select = find_xml_value($cp_recipe_xml->documentElement,'attrac_location_select');
		$sidebars = find_xml_value($cp_recipe_xml->documentElement,'sidebars');
		$left_sidebar_recipe = find_xml_value($cp_recipe_xml->documentElement,'left_sidebar_recipe');
		$right_sidebar_recipe = find_xml_value($cp_recipe_xml->documentElement,'right_sidebar_recipe');
	}
	?>
		<div class="event_options">
			<ul class="recipe_class top-bg">
				<li><h2><?php _e('City Attraction Options and Social Sharing', 'crunchpress'); ?></h2></li>
			</ul>
			<div class="clear"></div>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="rating_txt" > <?php echo __('Visiting Hours', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="rating_txt" id="rating_txt" value="<?php echo ($rating_txt == '')? esc_html($rating_txt): esc_html($rating_txt);?>" />
				</li>
				<li class="description"><p><?php _e('Please write visiting hours here.', 'crunchpress'); ?></p></li>
			</ul>	
			<div class="clear"></div>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="additional_info"><?php _e('Additional Information', 'crunchpress'); ?></label>
				</li>				
				<li class="panel-input">	
					<textarea name="additional_info" id="additional_info" ><?php echo ($additional_info == '')? esc_textarea($additional_info): esc_textarea($additional_info);?></textarea>
				</li>
				<li class="description"><p><?php _e('Please enter additional information here.', 'crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="website_info"><?php _e('Website URL', 'crunchpress'); ?></label>
				</li>				
				<li class="panel-input">	
					<input type="text" name="website_info" id="website_info" value="<?php echo ($website_info == '')? esc_html($website_info): esc_html($website_info);?>" />
				</li>
				<li class="description"><p><?php _e('Please enter Website URL here.', 'crunchpress'); ?></p></li>
			</ul>				
			<div class="clear"></div>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="pets_allowed"><?php _e('Pets Allowed', 'crunchpress'); ?></label>
				</li>
				<li class="panel-input">	
					<div class="combobox">
						<select name="pets_allowed" id="pets_allowed">
							<option <?php if( $pets_allowed == 'Yes' ){ echo 'selected'; }?>>Yes</option>
							<option <?php if( $pets_allowed == 'No' ){ echo 'selected'; }?>>No</option>
						</select>
					</div>
				</li>
				<li class="description"><p><?php _e('Please select pets detail allowed or disallowed.', 'crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="portfolio_thumbnail"><?php _e('Select Type', 'crunchpress'); ?></label>
				</li>
				<li class="panel-input">	
					<div class="combobox">
						<select name="portfolio_thumbnail" id="event_thumbnail">
							<option class="Image" value="Image" <?php if( $portfolio_thumbnail == 'Image' ){ echo 'selected'; }?>>Feature Image</option>
							<option class="Video" value="Video" <?php if( $portfolio_thumbnail == 'Video' ){ echo 'selected'; }?>>Video</option>
							<option class="Slider" value="Slider" <?php if( $portfolio_thumbnail == 'Slider' ){ echo 'selected'; }?>>Slider</option>
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
					<label for="recipe_social" > <?php _e('SOCIAL NETWORKING', 'crunchpress'); ?> </label>
				</li>	
				<li class="panel-input">
					<label for="recipe_social"><div class="checkbox-switch <?php
					
					echo ($recipe_social=='enable' || ($recipe_social=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

				?>"></div></label>
				<input type="checkbox" name="recipe_social" class="checkbox-switch" value="disable" checked>
				<input type="checkbox" name="recipe_social" id="recipe_social" class="checkbox-switch" value="enable" <?php 
					
					echo ($recipe_social=='enable' || ($recipe_social=='' && empty($default)))? 'checked': ''; 
				
				?>>
				</li>
				<li class="description"><p><?php _e('Turn On/Off Social Sharing on Event Detail.', 'crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<?php echo show_sidebar($sidebars,'right_sidebar_recipe','left_sidebar_recipe',$right_sidebar_recipe,$left_sidebar_recipe);?>
			<div class="clear"></div>
				<ul class="recipe_class">
				<li class="panel-title">
					<label for="attrac_location_select"><?php _e('Select Attraction Location', 'crunchpress'); ?></label>
				</li>
				<li class="panel-input">	
					<div class="combobox">
						<select name="attrac_location_select" id="event_thumbnail">
								<option value="aa"><?php _e('--No Location--', 'crunchpress'); ?></option>
							<?php foreach( get_title_list_array('attraction_location') as $values){?>
								<option value="<?php echo $values->ID;?>" <?php if($attrac_location_select == $values->ID){echo 'selected';}?>><?php echo $values->post_title;?></option>
							<?php }?>
						</select>
					</div>
				</li>
				<li class="description"><p><?php _e('Please select your event venue.', 'crunchpress'); ?></p></li>			
			</ul>
			<div class="clear"></div>
			<ul class="recipe_class">
				<li><h3><?php _e('Image Gallery', 'crunchpress'); ?></h3></li>	
			</ul>
			<div class="clear"></div>
			<div class="gallery-option-meta" id="gallery-option-meta"> 
			 <?php
					foreach($attraction_meta_box as $meta_box){				
						if( $meta_box['type'] == 'gallerypicker' ){
						
							$xml_string = get_post_meta($post->ID, 'attraction-option-gallery-xml', true);
							if( !empty($xml_string) ){

								$xml_val = new DOMDocument();
								$xml_val->loadXML( $xml_string );
								$meta_box['value'] = $xml_val->documentElement;
								
							}
							print_gallery_picker($meta_box);
							
						}
					}					
				
				?>
				<input type="hidden" name="nutrition_type" value="nutrition">			
			</div>
		<div class="clear"></div>			
		</div>	
		<div class="clear"></div>
	<?php }
	add_action('save_post','save_recipe_option_meta');
	function save_recipe_option_meta($post_id){
		
		$rating_txt = '';
		$additional_info = '';
		$website_info = '';
		$portfolio_thumbnail = '';
		$video_url_type = '';
		$select_slider_type = '';
		$recipe_social = '';
		$sidebars = '';
		$right_sidebar_recpie = '';
		$left_sidebar_recpie = '';
		$attrac_location_select = '';
		
		foreach($_REQUEST as $keys=>$values){
			$$keys = $values;
		}
		
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
	
		if(isset($nutrition_type) AND $nutrition_type == 'nutrition'){
		
			$new_data = '<recipe_detail>';
			$new_data = $new_data . create_xml_tag('rating_txt',$rating_txt);
			$new_data = $new_data . create_xml_tag('additional_info',htmlspecialchars(stripslashes($additional_info)));
			$new_data = $new_data . create_xml_tag('website_info',$website_info);
			$new_data = $new_data . create_xml_tag('pets_allowed',$pets_allowed);
			$new_data = $new_data . create_xml_tag('portfolio_thumbnail',$portfolio_thumbnail);
			$new_data = $new_data . create_xml_tag('video_url_type',$video_url_type);
			$new_data = $new_data . create_xml_tag('select_slider_type',$select_slider_type);
			$new_data = $new_data . create_xml_tag('recipe_social',$recipe_social);
			$new_data = $new_data . create_xml_tag('sidebars',$sidebars);
			$new_data = $new_data . create_xml_tag('right_sidebar_recipe',$right_sidebar_recipe);
			$new_data = $new_data . create_xml_tag('left_sidebar_recipe',$left_sidebar_recipe);
			$new_data = $new_data . create_xml_tag('attrac_location_select',$attrac_location_select);
			$new_data = $new_data . '</recipe_detail>';
			
			//Saving Sidebar and Social Sharing Settings as XML
			$old_data = get_post_meta($post_id, 'recipe_detail_xml',true);
			save_meta_data($post_id, $new_data, $old_data, 'recipe_detail_xml');
		
			global $attraction_meta_box;
			$edit_meta_boxes = $attraction_meta_box;
			
			// save
			foreach ($edit_meta_boxes as $edit_meta_box){
			
				// save function for slider
				if( $edit_meta_box['type'] == 'gallerypicker' ){
				
					if(isset($_POST[$edit_meta_box['name']['image']])){
					
						$num = sizeof($_POST[$edit_meta_box['name']['image']]) - 1;
						
					}else{
					
						$num = -1;
						
					}
					
					$slider_xml_old = get_post_meta($post_id,$edit_meta_box['xml'],true);
					$slider_xml = "<slider-item>";
					
					for($i=0; $i<=$num; $i++){
					
						$slider_xml = $slider_xml. "<slider>";
						$image_new = stripslashes($_POST[$edit_meta_box['name']['image']][$i]);
						$slider_xml = $slider_xml. create_xml_tag('image',$image_new);
						$title_new = stripslashes($_POST[$edit_meta_box['name']['title']][$i]);
						$slider_xml = $slider_xml. create_xml_tag('title',$title_new);
						$caption_new = stripslashes($_POST[$edit_meta_box['name']['caption']][$i]);
						$slider_xml = $slider_xml. create_xml_tag('caption',$caption_new);
						$linktype_new = stripslashes($_POST[$edit_meta_box['name']['linktype']][$i]);
						$slider_xml = $slider_xml. create_xml_tag('linktype',$linktype_new);
						$link_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['link']][$i]));
						$slider_xml = $slider_xml. create_xml_tag('link',$link_new);
						$video_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['video']][$i]));
						$slider_xml = $slider_xml. create_xml_tag('video',$video_new);
						$slider_xml = $slider_xml . "</slider>";
						
					}
					
					$slider_xml = $slider_xml . "</slider-item>";
					save_meta_data($post_id, $slider_xml, $slider_xml_old, $edit_meta_box['xml']);
					
				}
				
			}
		}
		
	}
	
	
	
	//FRONT END RECIPE LAYOUT
	
	$recipe_div_size_num_class = array("Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1170,420), "size2"=>array(770, 400), "size3"=>array(570,300)));

	
	// Print Recipe item
	function print_recipe_item($item_xml){
		wp_reset_query();
		global $paged,$sidebar,$recipe_div_size_num_class,$post,$wp_query,$counter;
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		$sidebar_class = '';
		$item_type = 'Full-Image';
		// get the item class and size from array
		$item_class = $recipe_div_size_num_class[$item_type]['class'];
		$item_index = $recipe_div_size_num_class[$item_type]['index'];
		$full_content = find_xml_value($item_xml, 'show-full-news-post');
		if( $sidebar == "no-sidebar" ){
			$item_size = $recipe_div_size_num_class[$item_type]['size'];
			$sidebar_class = 'no_sidebar';
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$sidebar_class = 'one_sidebar';
			$item_size = $recipe_div_size_num_class[$item_type]['size2'];
		}else{
			$sidebar_class = 'two_sidebar';
			$item_size = $recipe_div_size_num_class[$item_type]['size3'];
		}
		
				
		// get the blog meta value		
		$header = find_xml_value($item_xml, 'header');
		$attraction_view = find_xml_value($item_xml, 'attractionview');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$location = find_xml_value($item_xml, 'location');
		$category_name = '';
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'attraction-category');
			$category = $category_term->term_id;
			$category_name = $category_term->name;
		}
		// page header
		if(!empty($header)){
			echo '<h2>' . $header . '</h2><span class="border-line m-bottom"></span>';
		}
	
	
	$category = find_xml_value($item_xml, 'category');
	$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'attraction-category');
			$category = $category_term->slug;
		}
	
	
		query_posts(array(
			'posts_per_page'			=> $num_fetch,
			'paged'						=> $paged,
			'post_type'					=> 'attraction',
			'attraction-category'		=> $category,
			'post_status'				=> 'publish',
			'order'						=> 'DESC',
			));
		$counter_portfolio = 0;
		while( have_posts() ){
			global $post;
			the_post();	

			$rating_txt = '';
			$additional_info = '';
			$portfolio_thumbnail = '';
			$video_url_type = '';
			$select_slider_type = '';
			$recipe_social = '';
			$attrac_location_select = '';
			$recipe_detail_xml = '';
			$recipe_detail_xml = get_post_meta($post->ID, 'recipe_detail_xml', true);
			if($recipe_detail_xml <> ''){
				$cp_recipe_xml = new DOMDocument ();
				$cp_recipe_xml->loadXML ( $recipe_detail_xml );
				$rating_txt = find_xml_value($cp_recipe_xml->documentElement,'rating_txt');
				$additional_info = find_xml_value($cp_recipe_xml->documentElement,'additional_info');
				$website_info = find_xml_value($cp_recipe_xml->documentElement,'website_info');
				$pets_allowed = find_xml_value($cp_recipe_xml->documentElement,'pets_allowed');
				$portfolio_thumbnail = find_xml_value($cp_recipe_xml->documentElement,'portfolio_thumbnail');
				$video_url_type = find_xml_value($cp_recipe_xml->documentElement,'video_url_type');
				$select_slider_type = find_xml_value($cp_recipe_xml->documentElement,'select_slider_type');
				$recipe_social = find_xml_value($cp_recipe_xml->documentElement,'recipe_social');
				$attrac_location_select = find_xml_value($cp_recipe_xml->documentElement,'attrac_location_select');
				
				$map_search_field = '';
				$attraction_latitude = '';
				$attraction_longitude = '';
				$attraction_zoom = '';	
				$attrac_loc_xml = get_post_meta($attrac_location_select, 'attrac_loc_xml', true);
				if($attrac_loc_xml <> ''){
					$cp_event_xml = new DOMDocument ();
					$cp_event_xml->loadXML ( $attrac_loc_xml );
					$map_search_field = find_xml_value($cp_event_xml->documentElement,'map_search_field');
					$attraction_latitude = find_xml_value($cp_event_xml->documentElement,'attraction_latitude');
					$attraction_longitude = find_xml_value($cp_event_xml->documentElement,'attraction_longitude');
					$attraction_zoom = find_xml_value($cp_event_xml->documentElement,'attraction_zoom');
				}
			}
			?>
				<figure class="elw_new span12">
					<figure class="event_detail_banner"> 
						<?php print_portfolio_thumbnail($post->ID,$item_size);?>
							<div class="span4 ttd_banner"> 
								<div class="entry_price">
									<?php if($additional_info <> ''){?><span class="price"><?php echo $additional_info;?></span><?php }?>
									<?php if($rating_txt <> ''){?><span class="quantity"><?php echo $rating_txt;?></span><?php }?>
									<?php if($website_info <> ''){?><a href="<?php echo $website_info;?>" class="bookin_btn" ><?php _e('Website', 'cp_front_end'); ?></a><?php }?>
									<a href="<?php echo get_permalink();?>" class="find_outm"><?php _e('Fine Out More', 'cp_front_end'); ?></a>
								</div>
							</div>
					</figure>
					<figure class="elw_description">
						<div class="span12 first margin_bottom_empty">
							<h2 class="heading"><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
							<p><?php echo mb_substr( get_the_excerpt(), 0, $num_excerpt ) ;?></p>
						</div>
					</figure>
				</figure>
			<?php 
		$counter_portfolio++;

		}//End While
	?>
		<div class="clear"></div>
		<?php
		if( find_xml_value($item_xml, "pagination") == "Yes"){	
			pagination();
		}	
	 }	
	

	// print the blog thumbnail
	function print_portfolio_thumbnail( $post_id, $item_size ){
		global $counter;
		//Get Post Meta Options
		$portfolio_thumbnail = '';
		$video_url_type = '';
		$select_slider_type = '';
		$post_detail_xml = get_post_meta($post_id, 'recipe_detail_xml', true);
		if($post_detail_xml <> ''){
			$cp_recipe_xml = new DOMDocument ();
			$cp_recipe_xml->loadXML ( $post_detail_xml );
			$portfolio_thumbnail = find_xml_value($cp_recipe_xml->documentElement,'portfolio_thumbnail');
			$video_url_type = find_xml_value($cp_recipe_xml->documentElement,'video_url_type');
			$select_slider_type = find_xml_value($cp_recipe_xml->documentElement,'select_slider_type');
			//Print Image
			if( $portfolio_thumbnail == "Image" || empty($portfolio_thumbnail) ){
				echo get_the_post_thumbnail($post_id, $item_size);
			}else if( $portfolio_thumbnail == "Video" ){
				//Print Video
				echo '<div class="blog-thumbnail-video">';
				if(cp_get_width($item_size) == '175'){
					echo get_video($video_url_type, cp_get_width($item_size), cp_get_height($item_size));
				}else{
					echo get_video($video_url_type, '100%', cp_get_height($item_size));
				}
				
				echo '</div>';
				
			}else if ( $portfolio_thumbnail == "Slider" ){
				//Print Slider
				$slider_xml = get_post_meta( intval($select_slider_type), 'cp-slider-xml', true); 				
				if($slider_xml <> ''){
					$slider_xml_dom = new DOMDocument();
					$slider_xml_dom->loadXML($slider_xml);
					$slider_name='anything'.$counter.$post_id;				
					//Included Anything Slider Script/Style
					wp_enqueue_style('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/css/anythingslider.css');
					
					wp_register_script('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.js', array('jquery'), '1.0', true);
					wp_enqueue_script('cp-anything-slider');	

					wp_register_script('cp-anything-slider-fx', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.fx.js', array('jquery'), '1.0', true);
					wp_enqueue_script('cp-anything-slider-fx');	
					
					if(cp_get_width($item_size) == '175'){?>
						<style>
							#<?php echo $slider_name;?>{							
							width:<?php echo cp_get_width($item_size);?>px !important;
							height:<?php echo cp_get_height($item_size);?>px !important;
							float:left;
							}
						</style>					
					<?php }else{ ?>
							<style>
							.attraction_slider .anythingSlider{width:100% !important;}
							#<?php echo $slider_name;?>{							
							width:<?php echo cp_get_width($item_size);?>px !important;
							height:<?php echo cp_get_height($item_size);?>px !important;
							float:left;
							}
							</style>
					<?php
						}
						echo print_anything_slider($slider_name,$slider_xml_dom->documentElement, $item_size);
				}
			
			}	
		}
	}
	
	
?>