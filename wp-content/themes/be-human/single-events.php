<?php 
	/*
	 * This file is used to generate single post page.
	 */	
get_header(); 
if ( have_posts() ){ while (have_posts()){ the_post();

	global $post;
	// Get Event Meta Elements detail 
	
	$event_social = '';
	$sidebar = '';
	$left_sidebar = '';
	$right_sidebar = '';
	$event_start_time_def = '';
	$event_end_time = '';
	$booking_url = '';
	$event_location_select = '';
	$schedule_head = '';
	$schedule_descrip = '';
	$team_parti_head = '';
	$team_parti_descrip = '';
	$name_post_schedule = '';
	$title_post_schedule = '';
	$des_post_schedule = '';
	
	$event_start_date = '';
	$event_end_date = '';
	$event_start_date = get_post_meta($post->ID, 'event_start_date', true);
	$event_end_date = get_post_meta($post->ID, 'event_end_date', true);
	$event_detail_xml = get_post_meta($post->ID, 'event_detail_xml', true);
	if($event_detail_xml <> ''){
		$cp_event_xml = new DOMDocument ();
		$cp_event_xml->loadXML ( $event_detail_xml );
		$event_social = find_xml_value($cp_event_xml->documentElement,'event_social');
		$sidebar = find_xml_value($cp_event_xml->documentElement,'sidebar_event');
		$left_sidebar = find_xml_value($cp_event_xml->documentElement,'left_sidebar_event');
		$right_sidebar = find_xml_value($cp_event_xml->documentElement,'right_sidebar_event');
		$event_start_time_def = find_xml_value($cp_event_xml->documentElement,'event_start_time');
		$event_end_time = find_xml_value($cp_event_xml->documentElement,'event_end_time');
		$entry_level = find_xml_value($cp_event_xml->documentElement,'entry_level');
		$additional_info = find_xml_value($cp_event_xml->documentElement,'additional_info');
		$booking_url = find_xml_value($cp_event_xml->documentElement,'booking_url');
		$event_thumbnail = find_xml_value($cp_event_xml->documentElement,'event_thumbnail');
		$video_url_type = find_xml_value($cp_event_xml->documentElement,'video_url_type');
		$select_slider_type = find_xml_value($cp_event_xml->documentElement,'select_slider_type');
		$event_location_select = find_xml_value($cp_event_xml->documentElement,'event_location_select');
		$schedule_head = find_xml_value($cp_event_xml->documentElement,'schedule_head');
		$schedule_descrip = find_xml_value($cp_event_xml->documentElement,'schedule_descrip');
		$team_parti_head = find_xml_value($cp_event_xml->documentElement,'team_parti_head');
		$team_parti_descrip = find_xml_value($cp_event_xml->documentElement,'team_parti_descrip');
		
		
		//Get Date in Parts
		$event_year = date('Y',strtotime($event_start_date));
		$event_month = date('m',strtotime($event_start_date));
		$event_month_alpha = date('M',strtotime($event_start_date));
		$event_day = date('d',strtotime($event_start_date));
		
		//Change time format
		$event_start_time = date("G,i,s", strtotime($event_start_time_def));
		
		//Location Detail	
		$map_search_field = '';
		$event_latitude = '';
		$event_longitude = '';
		$event_zoom = '';
		$event_loc_xml = get_post_meta($event_location_select, 'event_loc_xml', true);
		if($event_loc_xml <> ''){
			$cp_event_xml = new DOMDocument ();
			$cp_event_xml->recover = TRUE;
			$cp_event_xml->loadXML ( $event_loc_xml );
			$map_search_field = find_xml_value($cp_event_xml->documentElement,'map_search_field');
			$event_latitude = find_xml_value($cp_event_xml->documentElement,'event_latitude');
			$event_longitude = find_xml_value($cp_event_xml->documentElement,'event_longitude');
			$event_zoom = find_xml_value($cp_event_xml->documentElement,'event_zoom');
		}
	}

	$sidebar_class = '';
	$content_class = '';
	
	//Sidebar function
	$sidebar_class = sidebar_func($sidebar);
	
	wp_register_script('countdown', CP_PATH_URL.'/frontend/js/jquery_countdown.js', false, '1.0', true);
	wp_enqueue_script('countdown');
	?>
	<div id="progress_news" class="mbtm">
		<div class="container-fluid container">
			<section id="blockContainer" class="row-fluid">
			<?php
				if(!is_front_page()){
					breadcrumbs_html();
				}
			?>
				<section class="page_content">
					<?php
					if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){?>
						<div id="block_first" class="sidebar <?php echo $sidebar_class[0];?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-left'){?>
					<div id="block_first_left" class="sidebar <?php echo $sidebar_class[0];?>">
						<?php dynamic_sidebar( $right_sidebar );?>
					</div>
					<?php } ?>
					<div id="post-<?php the_ID(); ?>" class="<?php echo $sidebar_class[1];?>">
						<div <?php post_class(); ?>>
							<figure id="page_title">
								<div class="span8 first">
									<h2><?php echo get_the_title();?></h2>
								</div>
							</figure>
							<figure id="event_grid" class="span12 first outer_lyr mbtm">
								<div class="inner_lyr">
									<?php 
									wp_register_script('countdown', CP_PATH_URL.'/frontend/js/jquery_countdown.js', false, '1.0', true);
									wp_enqueue_script('countdown');
									//$slider_name = 'anything'.$post->ID;
										// Inside Thumbnail
										if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
											//$item_size = "620x230";
											$item_size = array(770, 400);
										}else if( $sidebar == "both-sidebar" ){
											$item_size = array(570,300);
										}else{
											$item_size = array(1170,420);
										}
									print_event_thumbnail($post->ID,$item_size);?>
									<div class="event_info">
										<div class="span4 first" id="event_title">
											<h3><?php echo get_the_title();?></h3>
											<p><?php echo date(get_option('date_format'),strtotime($event_start_date));?><span><?php echo date(get_option('time_format'),strtotime($event_start_time_def));?> - <?php echo date(get_option('time_format'),strtotime($event_end_time));?></span></p>
										</div>
										<div class="span4" id="event_loc">
											<h3> <i class="icon-map-marker"></i><?php echo $map_search_field?></h3>
										</div>
										<div class="span4" id="event_counter">
											<script>
												jQuery(document).ready(function($) {
													var austDay = new Date();
													austDay = new Date(<?php echo $event_year;?>, <?php echo $event_month;?>-1, <?php echo $event_day;?>,<?php echo $event_start_time;?>)
													$('#countdown-<?php echo $post->ID?>').countdown({
													labels: ['<?php _e('Years','crunchpress');?>', '<?php _e('Months','crunchpress');?>', '<?php _e('Weeks','crunchpress');?>', '<?php _e('Days','crunchpress');?>', '<?php _e('Hours','crunchpress');?>', '<?php _e('Minutes','crunchpress');?>', '<?php _e('Seconds','crunchpress');?>'],
													until: austDay});
													$('#year').text(austDay.getFullYear());
												});                
											</script>
											<div id="countdown-<?php echo $post->ID?>"></div>
										</div>
									</div>
								</div>
							</figure>
							<figure id="event_detail" class="span12 first outer_lyr mbtm2">
								<div class="inner_lyr">
									<?php the_content();?>
									<?php 
							$sch_select_organizer = get_post_meta($post->ID, 'sch_select_organizer', true);
							if($sch_select_organizer <> ''){	
								$schedule_title_xml = new DOMDocument();
								$schedule_title_xml->recover = TRUE;								
								$schedule_title_xml->loadXML($sch_select_organizer);
								$children_des = $schedule_title_xml->documentElement->childNodes;
								$nofields = $schedule_title_xml->documentElement->childNodes->length;
								$array_variable = return_xml_array($children_des);
							}
									
									if($team_parti_head <> ''){?><h3><?php echo $team_parti_head;?></h3><?php }?>
									<?php if($team_parti_descrip <> ''){?><h4><?php echo $team_parti_descrip;?></h4><?php }
										if($sch_select_organizer <> ''){
											$counter_team = 0;
											foreach($array_variable as $values){
											
												$team_detail_xml = get_post_meta($values, 'team_detail_xml', true);
												if($team_detail_xml <> ''){
													$cp_team_xml = new DOMDocument ();
													$cp_team_xml->recover = TRUE;
													$cp_team_xml->loadXML ( $team_detail_xml );
													$team_designation = find_xml_value($cp_team_xml->documentElement,'team_designation');
													$team_facebook = find_xml_value($cp_team_xml->documentElement,'team_facebook');
													$team_linkedin = find_xml_value($cp_team_xml->documentElement,'team_linkedin');
													$team_twitter = find_xml_value($cp_team_xml->documentElement,'team_twitter');
												}									
												if($counter_team % 3 == 0){?>
													<div class="clear"></div>
													<figure class="team_member span4 first">
														<?php
														$thumbnail_id = get_post_thumbnail_id( $values );
														$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'full' );
														//if($thumbnail[1].'x'.$thumbnail[2] == '260x220'){
														?>
															<div class="member_img"><?php echo get_the_post_thumbnail($values, 'full');?></div>
														<?php 
														
														//} 
														?>
														<div class="team_member_description">
															<h5><a href="<?php echo get_permalink($values); ?>"><?php echo get_the_title($values);?></a></h5>
															<span class="mem_desig"><?php echo $team_designation?></span>
															<div class="clear"></div>
															<div id="socialicons" >
																<?php if($team_facebook <> ''){?><a id="fb_hr" class="social_active" href="<?php echo $team_facebook?>" title="Visit Facebook page"><span></span></a><?php }?>
																<?php if($team_linkedin <> ''){?><a id="twitter_hr" class="social_active" href="<?php echo $team_linkedin?>" title="Visit Twitter page"><span></span></a><?php }?>
																<?php if($team_twitter <> ''){?><a id="googleplus_hr" class="social_active" href="<?php echo $team_twitter?>" title="Visit Google Plus page"><span></span></a><?php }?>
															</div>	
														</div>
													</figure>
												<?php }else{ ?>
													<figure class="team_member span4">
														<?php
														$thumbnail_id = get_post_thumbnail_id( $values );
														$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'full' );
														//if($thumbnail[1].'x'.$thumbnail[2] == '260x220'){
														?>
															<div class="member_img"><?php echo get_the_post_thumbnail($values, 'full');?></div>
														<?php 
														
														//} 
														?>
														<div class="team_member_description">
															<h5><a href="<?php echo get_permalink($values); ?>"><?php echo get_the_title($values);?></a></h5>
															<span class="mem_desig"><?php echo $team_designation?></span>
															<div class="clear"></div>
															<div id="socialicons" >
																<?php if($team_facebook <> ''){?><a id="fb_hr" class="social_active" href="<?php echo $team_facebook?>" title="Visit Facebook page"><span></span></a><?php }?>
																<?php if($team_linkedin <> ''){?><a id="twitter_hr" class="social_active" href="<?php echo $team_linkedin?>" title="Visit Twitter page"><span></span></a><?php }?>
																<?php if($team_twitter <> ''){?><a id="googleplus_hr" class="social_active" href="<?php echo $team_twitter?>" title="Visit Google Plus page"><span></span></a><?php }?>
															</div>	
														</div>							
													</figure>
											<?php 
													}
													$counter_team++;
											}
										} ?>
								</div>
							</figure>
							<?php if($event_latitude <> '' AND $event_longitude <> ''){?>
								<figure id="map_holder" class="span12 first mbtm2">
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
											map = new google.maps.Map(document.getElementById('map_canvas'),myOptions);
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
									<div id="map_canvas" class="map_canvas"></div>
									<div id="map_abs">
										<h4><?php _e('Lets join together!','cp_front_end');?></h4>
										<span><i class="icon-map-marker"></i><br /><?php echo $map_search_field?></span>
									</div>
								</figure>
							<?php } 
								
								echo '<div class="clear"></div>';
								//echo '<h3>';
								//echo __('Related Events','crunchpress');
								//echo '</h3>';
									echo '<div class="related_artiles text-divider2">';
										echo related_posts($post->ID);
									echo '</div>';
								
								// Include Social Shares
								if($event_social == "enable"){
									echo include_social_shares();
									echo "<div class='clear'></div>";
								}
								echo '<div class="user_comments inner_page">';
									comments_template(); 
								echo '</div>';
							}
						}
					?>
						</div>
					</div>
					<?php
					if($sidebar == "both-sidebar-right"){?>
						<div class="<?php echo $sidebar_class[0];?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-right' || $sidebar == "right-sidebar" || $sidebar == "both-sidebar"){?>
					<div class="<?php echo $sidebar_class[0];?>">
						<?php dynamic_sidebar( $right_sidebar );?>
					</div>
					<?php } ?>						   
			</section>
		</div>
	</div>
<?php get_footer(); ?>