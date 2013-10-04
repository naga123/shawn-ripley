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
	
	add_action( 'init', 'create_ourteam' );
	function create_ourteam() {
		//$portfolio_translation = get_option(THEME_NAME_S.'_cp_portfolio_slug','portfolio');
		
		$labels = array(
			'name' => _x('Our Team', 'Our Team General Name', 'crunchpress'),
			'singular_name' => _x('Our Team', 'Event Singular Name', 'crunchpress'),
			'add_new' => _x('Add New', 'Add New Our Team Name', 'crunchpress'),
			'add_new_item' => __('Add New Our Team', 'crunchpress'),
			'edit_item' => __('Edit Our Team', 'crunchpress'),
			'new_item' => __('New Our Team', 'crunchpress'),
			'view_item' => __('View Our Team', 'crunchpress'),
			'search_items' => __('Search Our Team', 'crunchpress'),
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
			'menu_icon' => CP_PATH_URL . '/framework/images/ourteam-icon.png',
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
			'has_archive' => true,
			'rewrite' => array('slug' => '', 'with_front' => false)
		  ); 
		  
		register_post_type( 'teams' , $args);		
	}
	
	
	add_action('add_meta_boxes', 'add_team_option');
	function add_team_option(){	
	
		add_meta_box('team-option', __('Our Team Options','crunchpress'), 'add_our_team_element',
			'teams', 'normal', 'high');
			
	}
	function add_our_team_element(){
		$team_social = '';
		$sidebar_team = '';
		$right_sidebar_team = '';
		$left_sidebar_team = '';
		$team_designation = '';
		$team_facebook = '';
		$team_linkedin = '';
		$team_twitter = '';
	
	
	
	foreach($_REQUEST as $keys=>$values){
		$$keys = $values;
	}
	global $post;
	

	$team_detail_xml = get_post_meta($post->ID, 'team_detail_xml', true);
	if($team_detail_xml <> ''){
		$cp_team_xml = new DOMDocument ();
		$cp_team_xml->loadXML ( $team_detail_xml );
		$team_social = find_xml_value($cp_team_xml->documentElement,'team_social');
		$sidebar_team = find_xml_value($cp_team_xml->documentElement,'sidebar_team');
		$left_sidebar_team = find_xml_value($cp_team_xml->documentElement,'left_sidebar_team');
		$right_sidebar_team = find_xml_value($cp_team_xml->documentElement,'right_sidebar_team');
		$team_designation = find_xml_value($cp_team_xml->documentElement,'team_designation');
		$team_facebook = find_xml_value($cp_team_xml->documentElement,'team_facebook');
		$team_linkedin = find_xml_value($cp_team_xml->documentElement,'team_linkedin');
		$team_twitter = find_xml_value($cp_team_xml->documentElement,'team_twitter');
	}
	?>
		<div class="event_options">
			<ul class="recipe_class top-bg">
				<li><h2>Social Sharing & Designation</h2></li>
			</ul>
			<ul class="panel-body recipe_class">
				<li class="panel-title">
					<label for="team_social" > <?php _e('SOCIAL NETWORKING', 'crunchpress'); ?> </label>
				</li>	
				<li class="panel-input">
					<label for="team_social"><div class="checkbox-switch <?php
					
					echo ($team_social=='enable' || ($team_social=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

				?>"></div></label>
				<input type="checkbox" name="team_social" class="checkbox-switch" value="disable" checked>
				<input type="checkbox" name="team_social" id="team_social" class="checkbox-switch" value="enable" <?php 
					
					echo ($team_social=='enable' || ($team_social=='' && empty($default)))? 'checked': ''; 
				
				?>>
				</li>
				<li class="description"><p><?php _e('Turn On/Off Social Sharing on Team Detail.', 'crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<?php echo show_sidebar($sidebar_team,'right_sidebar_team','left_sidebar_team',$right_sidebar_team,$left_sidebar_team);?>
			<div class="clear"></div>
			<ul class="panel-body recipe_class">
				<li class="panel-title">
					<label for="team_designation" > <?php _e('DESIGNATION', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="team_designation" id="team_designation" value="<?php if($team_designation <> ''){echo $team_designation;};?>" />
				</li>
				<li class="description"><p><?php _e('Please Enter Here Designation of the person.', 'crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<ul class="panel-body recipe_class">
				<li class="panel-title">
					<label for="team_facebook" > <?php _e('Facebook Profile', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="team_facebook" id="team_facebook" value="<?php if($team_facebook <> ''){echo $team_facebook;};?>" />
				</li>
				<li class="description"><p><?php _e('Please Enter Url for social profile.', 'crunchpress'); ?></p></li>
			</ul>	
			<div class="clear"></div>
			<ul class="panel-body recipe_class">
				<li class="panel-title">
					<label for="team_linkedin" > <?php _e('Linked In Profile', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="team_linkedin" id="team_linkedin" value="<?php if($team_linkedin <> ''){echo $team_linkedin;};?>" />
				</li>
				<li class="description"><p><?php _e('Please Enter Url for social profile.', 'crunchpress'); ?></p></li>
			</ul>	
			<div class="clear"></div>
			<ul class="panel-body recipe_class">
				<li class="panel-title">
					<label for="team_twitter" > <?php _e('Twitter Profile', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="team_twitter" id="team_twitter" value="<?php if($team_twitter <> ''){echo $team_twitter;};?>" />
				</li>
				<li class="description"><p><?php _e('Please Enter Url for social profile.', 'crunchpress'); ?></p></li>
			</ul>				
			<input type="hidden" name="team_submit" value="teams"/>
			<div class="clear"></div>
		</div>	
		<div class="clear"></div>
	<?php }
	add_action('save_post','save_team_option_meta');
	function save_team_option_meta($post_id){
		
		$team_social = '';
		$sidebars = '';
		$right_sidebar_team = '';
		$left_sidebar_team = '';
		$team_facebook = '';
		$team_linkedin = '';
		$team_twitter = '';
		
		foreach($_REQUEST as $keys=>$values){
			$$keys = $values;
		}
	
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
	
			if(isset($team_submit) AND $team_submit == 'teams'){
				$new_data = '<team_detail>';
				$new_data = $new_data . create_xml_tag('team_social',$team_social);
				$new_data = $new_data . create_xml_tag('sidebar_team',$sidebars);
				$new_data = $new_data . create_xml_tag('right_sidebar_team',$right_sidebar_team);
				$new_data = $new_data . create_xml_tag('left_sidebar_team',$left_sidebar_team);
				$new_data = $new_data . create_xml_tag('team_designation',$team_designation);
				$new_data = $new_data . create_xml_tag('team_facebook',$team_facebook);
				$new_data = $new_data . create_xml_tag('team_linkedin',$team_linkedin);
				$new_data = $new_data . create_xml_tag('team_twitter',$team_twitter);
				$new_data = $new_data . '</team_detail>';
		//Saving Sidebar and Social Sharing Settings as XML
		$old_data = get_post_meta($post_id, 'team_detail_xml',true);
		save_meta_data($post_id, $new_data, $old_data, 'team_detail_xml');
		
		}
	}
	
	
	
	//EVENT FRONTEND AREA START
	$team_div_size_num_class = array(
		"Full Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(260,220), "size2"=>array(260,220), "size3"=>array(260,220)));

	
	// Print Event item
	function print_team_item($item_xml){

		wp_reset_query();
		global $paged,$sidebar,$team_div_size_num_class,$post,$counter;
		
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		//$item_size = array(260,220);
				
		$feature_member = find_xml_value($item_xml, 'select_feature');
		$post_slider_slug = get_posts(array('post_type' => 'teams','ID' => $feature_member,'numberposts' => 1));
		if(!empty($post_slider_slug)){
			//$feature_member = $post_slider_slug[0]->ID;
			$post_content = $post_slider_slug[0]->post_content;
		}
		// get the blog meta value		
		$header = find_xml_value($item_xml, 'header');
		
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		if(!empty($header)){
			echo '<h2 class="heading">' . $header . '</h2><span class="border-line m-bottom"></span>';
		}
		
			$team_detail_xml = get_post_meta($feature_member, 'team_detail_xml', true);
			if($team_detail_xml <> ''){
				$cp_team_xml = new DOMDocument ();
				$cp_team_xml->loadXML ( $team_detail_xml );
				$team_designation = find_xml_value($cp_team_xml->documentElement,'team_designation');
				$team_facebook = find_xml_value($cp_team_xml->documentElement,'team_facebook');
				$team_linkedin = find_xml_value($cp_team_xml->documentElement,'team_linkedin');
				$team_twitter = find_xml_value($cp_team_xml->documentElement,'team_twitter');
			}
			?>
			<section class="span12 first mbtm2 outer_lyr">
				<section class="inner_lyr">
					<h3 class="heading1 bg-div"><span class="inner"><a><strong><?php _e('Feature Team Member','crunchpress');?></strong></a><span class="bgr1"></span></span></h3>
					<section class="section_content"> 
					<?php
						$thumbnail_id = get_post_thumbnail_id( $feature_member );
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(175,155) );
						if($thumbnail[1].'x'.$thumbnail[2] == '175x155'){?>
							<div class="span3 first img"><?php echo get_the_post_thumbnail($feature_member, array(175,155));?></div>
						<?php }?>
						<div class="span9"> 
							<h3><a href="<?php echo get_permalink($feature_member);?>"><?php echo get_the_title($feature_member);?></a></h3>
							<p><?php echo strip_tags(mb_substr($post_content,0,800));?></p>
						</div>
						<div class="span9"> 
							<div id="socialicons">
								<?php if(isset($team_facebook) AND $team_facebook <> ''){?>
								<a title="Facebook Sharing" href="<?php echo $team_facebook;?>" class="social_active" id="fb_hr">
									<span class="da-animate da-slideFromLeft"></span>
								</a>
								<?php }?>
								<?php if(isset($team_twitter) AND $team_twitter <> ''){?>
								<a title="Twitter Sharing" href="<?php echo $team_twitter;?>" class="social_active" id="twitter_hr">
									<span class="da-animate da-slideFromLeft"></span>
								</a>
								<?php }?>
								<?php if(isset($team_linkedin) AND $team_linkedin <> ''){?>
								<a title="Linked In Sharing" href="<?php echo $team_linkedin;?>" class="social_active" id="linked_hr">
									<span class="da-animate da-slideFromLeft"></span>
								</a>
								<?php }?>
							</div>		
						</div>	
					</section>
				</section>
			</section>
			<?php
			
			
		query_posts(array(
			'posts_per_page'			=> $num_fetch,
			'paged'						=> $paged,
			'post_type'					=> 'teams',
			'post_status'				=> 'publish',
			'order'						=> 'DESC',
			'post__not_in' => array($feature_member)
		));
			$counter_team = 0;
			?>
			<section class="span12 mbtm2 first" id="offices_slider_warpper">
				<h3 class="heading1 bg-div"><span class="inner"><strong> Charity Organizers</strong><span class="bgr1"></span></span></h3>
			<?php
			while( have_posts() ){
			the_post();	
			
			global $post;
				//if($counter_team <> 1){
					//Team Detail Other Elements
					$team_detail_xml = get_post_meta($post->ID, 'team_detail_xml', true);
					if($team_detail_xml <> ''){
						$cp_team_xml = new DOMDocument ();
						$cp_team_xml->loadXML ( $team_detail_xml );
						$team_designation = find_xml_value($cp_team_xml->documentElement,'team_designation');
						$team_facebook = find_xml_value($cp_team_xml->documentElement,'team_facebook');
						$team_linkedin = find_xml_value($cp_team_xml->documentElement,'team_linkedin');
						$team_twitter = find_xml_value($cp_team_xml->documentElement,'team_twitter');
					}
					
					if($feature_member <> $post->ID){
						if($counter_team % 4 == 0){?> 
						<div class="clear"></div>
							<figure class="team_member span3 first">
							<?php
							$thumbnail_id = get_post_thumbnail_id( $post->ID );
							$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(175,155) );
							if($thumbnail[1].'x'.$thumbnail[2] == '175x155'){?>
								<div class="member_img">
									<?php echo get_the_post_thumbnail($post->ID, array(175,155));?>
								</div>
							<?php }?>	
								<div class="team_member_description">
									<h5><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h5>
									<span class="mem_desig"><?php echo $team_designation;?></span>
									<div class="clear"></div>
									<div id="socialicons">
										<?php if(isset($team_facebook) AND $team_facebook <> ''){?>
										<a title="Facebook Sharing" href="<?php echo $team_facebook;?>" class="social_active" id="fb_hr">
											<span class="da-animate da-slideFromLeft"></span>
										</a>
										<?php }?>
										<?php if(isset($team_twitter) AND $team_twitter <> ''){?>
										<a title="Twitter Sharing" href="<?php echo $team_twitter;?>" class="social_active" id="twitter_hr">
											<span class="da-animate da-slideFromLeft"></span>
										</a>
										<?php }?>
										<?php if(isset($team_linkedin) AND $team_linkedin <> ''){?>
										<a title="Linked In Sharing" href="<?php echo $team_linkedin;?>" class="social_active" id="linked_hr">
											<span class="da-animate da-slideFromLeft"></span>
										</a>
										<?php }?>
									</div>			
								</div>
							</figure>	
					<?php 
						}else{?>					
						<figure class="team_member span3">
							<?php
							$thumbnail_id = get_post_thumbnail_id( $post->ID );
							$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(175,155) );
							if($thumbnail[1].'x'.$thumbnail[2] == '175x155'){?>
							<div class="member_img">
								<?php echo get_the_post_thumbnail($post->ID, array(175,155));?>
							</div>
							<?php }?>
							<div class="team_member_description">
								<h5><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h5>
								<span class="mem_desig"><?php echo $team_designation;?></span>
								<div class="clear"></div>
								<div id="socialicons">
									<?php if(isset($team_facebook) AND $team_facebook <> ''){?>
									<a title="Facebook Sharing" href="<?php echo $team_facebook;?>" class="social_active" id="fb_hr">
										<span class="da-animate da-slideFromLeft"></span>
									</a>
									<?php }?>
									<?php if(isset($team_twitter) AND $team_twitter <> ''){?>
									<a title="Twitter Sharing" href="<?php echo $team_twitter;?>" class="social_active" id="twitter_hr">
										<span class="da-animate da-slideFromLeft"></span>
									</a>
									<?php }?>
									<?php if(isset($team_linkedin) AND $team_linkedin <> ''){?>
									<a title="Linked In Sharing" href="<?php echo $team_linkedin;?>" class="social_active" id="linked_hr">
										<span class="da-animate da-slideFromLeft"></span>
									</a>
									<?php }?>
								</div>
							</div>
						</figure>					
					<?php }
				}	
				$counter_team++;
			}?>
		</section>
				<?php
		
	}	
		
?>