<?php

	/*	
	*	CrunchPress Portfolio Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file create and contains the post post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	add_action('add_meta_boxes', 'add_post_option');
	function add_post_option(){	
		add_meta_box('post-option', __('Post Option','crunchpress'), 'add_post_option_element',
			'post', 'normal', 'high');
	}
	function add_post_option_element(){
		
		// init array
		$post_social = '';
		$sidebars = '';
		$right_sidebar_post = '';
		$left_sidebar_post = '';
		$post_thumbnail = '';
		$video_url_type = '';
		$select_slider_type = '';
	
	
	
	foreach($_REQUEST as $keys=>$values){
		$$keys = $values;
	}
	global $post;
	
	$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
		if($post_detail_xml <> ''){
			$cp_post_xml = new DOMDocument ();
			$cp_post_xml->loadXML ( $post_detail_xml );
			$post_social = find_xml_value($cp_post_xml->documentElement,'post_social');
			$sidebars = find_xml_value($cp_post_xml->documentElement,'sidebar_post');
			$right_sidebar_post = find_xml_value($cp_post_xml->documentElement,'right_sidebar_post');
			$left_sidebar_post = find_xml_value($cp_post_xml->documentElement,'left_sidebar_post');
			$post_thumbnail = find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
			$video_url_type = find_xml_value($cp_post_xml->documentElement,'video_url_type');
			$select_slider_type = find_xml_value($cp_post_xml->documentElement,'select_slider_type');			
		}

	?>
		<div class="event_options">
			<ul class="recipe_class top-bg">
				<li><h2>Post Options and Social Sharing</h2></li>
			</ul>
			<ul class="event_social_class recipe_class">
				<li class="panel-title">
					<label for="post_social" > <?php _e('SOCIAL NETWORKING', 'crunchpress'); ?> </label>
				</li>	
				<li class="panel-input">
					<label for="post_social"><div class="checkbox-switch <?php
					
					echo ($post_social=='enable' || ($post_social=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

				?>"></div></label>
				<input type="checkbox" name="post_social" class="checkbox-switch" value="disable" checked>
				<input type="checkbox" name="post_social" id="post_social" class="checkbox-switch" value="enable" <?php 
					
					echo ($post_social=='enable' || ($post_social=='' && empty($default)))? 'checked': ''; 
				
				?>>
				</li>
				<li class="description"><p><?php _e('You can turn On/Off social sharing from event detail.', 'crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<?php echo show_sidebar($sidebars,'right_sidebar_post','left_sidebar_post',$right_sidebar_post,$left_sidebar_post);?>
			<div class="clear"></div>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="post_thumbnail"><?php _e('Select Type', 'crunchpress'); ?></label>
				</li>
				<li class="panel-input">	
					<div class="combobox">
						<select name="post_thumbnail" id="event_thumbnail">
							<option class="Image" value="Image" <?php if( $post_thumbnail == 'Image' ){ echo 'selected'; }?>>Feature Image</option>
							<option class="Video" value="Video" <?php if( $post_thumbnail == 'Video' ){ echo 'selected'; }?>>Video</option>
							<option class="Slider" value="Slider" <?php if( $post_thumbnail == 'Slider' ){ echo 'selected'; }?>>Slider</option>
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
					<label for="select_slider_type"><?php _e('Select Images Slide', 'crunchpress'); ?></label>
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
			<input type="hidden" name="default_post" value="post">			
			<div class="clear"></div>
		</div>	
		<div class="clear"></div> <?php
		

		
	}
	
	
	add_action('save_post','save_default_post_option_meta');
	function save_default_post_option_meta($post_id){	
		global $post_id;
				// init array
		$post_social = '';
		$sidebars = '';
		$right_sidebar_post = '';
		$left_sidebar_post = '';
		$post_thumbnail = '';
		$video_url_type = '';
		$select_slider_type = '';
		
		// save
		foreach($_REQUEST as $keys=>$values){
			$$keys = $values;
		}
	
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
			
			if(isset($default_post) AND $default_post == 'post'){
				$new_data = '<post_detail>';
				$new_data = $new_data . create_xml_tag('post_social',$post_social);
				$new_data = $new_data . create_xml_tag('sidebar_post',$sidebars);
				$new_data = $new_data . create_xml_tag('right_sidebar_post',$right_sidebar_post);
				$new_data = $new_data . create_xml_tag('left_sidebar_post',$left_sidebar_post);
				$new_data = $new_data . create_xml_tag('post_thumbnail',$post_thumbnail);
				$new_data = $new_data . create_xml_tag('video_url_type',$video_url_type);				
				$new_data = $new_data . create_xml_tag('select_slider_type',$select_slider_type);
				$new_data = $new_data . '</post_detail>';
		//Saving Sidebar and Social Sharing Settings as XML
		$old_data = get_post_meta($post_id, 'post_detail_xml',true);
		save_meta_data($post_id, $new_data, $old_data, 'post_detail_xml');
		
		}
	}
?>