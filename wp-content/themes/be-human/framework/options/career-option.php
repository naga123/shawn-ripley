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
	
	add_action( 'init', 'create_career' );
	function create_career() {
		//$portfolio_translation = get_option(THEME_NAME_S.'_cp_portfolio_slug','portfolio');
		
		$labels = array(
			'name' => _x('Career', 'Career General Name', 'crunchpress'),
			'singular_name' => _x('Career Item', 'Career Singular Name', 'crunchpress'),
			'add_new' => _x('Add New', 'Add New Job Name', 'crunchpress'),
			'add_new_item' => __('Add New Job', 'crunchpress'),
			'edit_item' => __('Edit Job', 'crunchpress'),
			'new_item' => __('New Job', 'crunchpress'),
			'view_item' => __('View Event', 'crunchpress'),
			'search_items' => __('Search Job', 'crunchpress'),
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
			'menu_icon' => CP_PATH_URL . '/framework/images/career-icon.png',
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => 5,
			'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
			'rewrite' => array('slug' => 'career', 'with_front' => false)
		  ); 
		  
		register_post_type( 'career' , $args);
		
		
		register_taxonomy(
			"career-category", array("career"), array(
				"hierarchical" => true,
				"label" => "Career Categories", 
				"singular_label" => "Career Categories", 
				"rewrite" => true));
		register_taxonomy_for_object_type('career-category', 'career');
		
		register_taxonomy(
			"career-tag", array("career"), array(
				"hierarchical" => false, 
				"label" => "Career Tag", 
				"singular_label" => "Career Tag", 
				"rewrite" => true));
		register_taxonomy_for_object_type('career-tag', 'career');
		
	}
	
	
	add_action('add_meta_boxes', 'add_career_option');
	function add_career_option(){	
	
		add_meta_box('career-option', __('Career Options','crunchpress'), 'add_career_option_element',
			'career', 'normal', 'high');
			
	}
	
	function add_career_option_element(){
		$career_detail_xml = '';
		$career_social = '';
		$sidebar_event = '';
		$right_sidebar_event = '';
		$left_sidebar_event = '';
		$career_city = '';
		$career_salary = '';
		$career_country = '';
		$career_apply = '';
		$date_posted = '';
		$jobs_post_name = '';
		$jobs_post_title = '';
	
	
	
	foreach($_REQUEST as $keys=>$values){
		$$keys = $values;
	}
	global $post,$countries;
	
	$jobs_post_name = get_post_meta($post->ID, 'jobs_post_name', true);
	$jobs_post_title = get_post_meta($post->ID, 'jobs_post_title', true);
	
	$date_posted = get_post_meta($post->ID, 'date_posted', true);
	
	$career_detail_xml = get_post_meta($post->ID, 'career_detail_xml', true);
	if($career_detail_xml <> ''){
		$cp_event_xml = new DOMDocument ();
		$cp_event_xml->loadXML ( $career_detail_xml );
		$career_social = find_xml_value($cp_event_xml->documentElement,'career_social');
		$sidebar_event = find_xml_value($cp_event_xml->documentElement,'sidebar_event');
		$left_sidebar_event = find_xml_value($cp_event_xml->documentElement,'left_sidebar_event');
		$right_sidebar_event = find_xml_value($cp_event_xml->documentElement,'right_sidebar_event');
		$career_city = find_xml_value($cp_event_xml->documentElement,'career_city');
		$career_salary = find_xml_value($cp_event_xml->documentElement,'career_salary');
		$career_country = find_xml_value($cp_event_xml->documentElement,'career_country');
		$career_apply = find_xml_value($cp_event_xml->documentElement,'career_apply');
		
	}
	?>
	<style>
	.video_class{
		display:none;
	}
	.select_slider_option{
		display:none;
	}
	</style>
	<div class="event_options">
			<ul class="recipe_class top-bg">
				<li><h2><?php _e('Social Sharing & Job Settings','crunchpress'); ?></h2></li>
			</ul>
			<ul class="event_social_class recipe_class">
				<li class="panel-title">
					<label for="career_social" > <?php _e('SOCIAL NETWORKING', 'crunchpress'); ?> </label>
				</li>	
				<li class="panel-input">
					<label for="career_social"><div class="checkbox-switch <?php
					
					echo ($career_social=='enable' || ($career_social=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

				?>"></div></label>
				<input type="checkbox" name="career_social" class="checkbox-switch" value="disable" checked>
				<input type="checkbox" name="career_social" id="career_social" class="checkbox-switch" value="enable" <?php 
					
					echo ($career_social=='enable' || ($career_social=='' && empty($default)))? 'checked': ''; 
				
				?>>
				</li>
				<li class="description"><p><?php _e('You can turn On/Off social sharing from Job detail.','crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<?php echo show_sidebar($sidebar_event,'right_sidebar_event','left_sidebar_event',$right_sidebar_event,$left_sidebar_event);?>
			<div class="clear"></div>
			<ul class="event_start_class recipe_class">
				<li class="panel-title">
					<label for="date_posted" > <?php _e('APPLY DATE', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="date_posted" id="date_posted" value="<?php if($date_posted <> ''){echo $date_posted;};?>" />
				</li>
				<li class="description"><p><?php _e('Please select Job date.','crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<ul class="event_end_class recipe_class">
				<li class="panel-title">
					<label for="career_city" > <?php _e('City Name', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="career_city" id="career_city" value="<?php if($career_city <> ''){echo $career_city;};?>" />
				</li>
				<li class="description"><p><?php _e('Please write name of city.','crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
			<ul class="career_salary_class recipe_class">
				<li class="panel-title">
					<label for="career_salary" ><?php _e('Salary', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="career_salary" id="career_salary" value="<?php if($career_salary <> ''){echo $career_salary;};?>" />
				</li>
				<li class="description"><p><?php _e('Please enter salary here','crunchpress'); ?></p></li>
			</ul>
			<ul class="career_salary_class recipe_class">
				<li class="panel-title border_left">
					<label for="select_organizer"><h4><?php _e('Text Field Title', 'crunchpress'); ?></h4></label>
				</li>
				<li class="panel-title border_left">
					<label for="select_organizer"><h4><?php _e('TEXT FILED TEXT', 'crunchpress'); ?></h4></label>
				</li>
			</ul>
			<ul class="recipe_class">
				<li class="panel-title">
					<input type="text" id="add-more-name" value="type field heading here" rel="type field heading here">
				</li>
				<li class="panel-input">
					<input type="text" id="add-more-title" value="type field title here" rel="type field title here">
				</li>
				<li class="description"><div id="add-more-ingre" class="add-more-ingre"></div></li>
				<div class="clear"></div>
				<ul id="selected-ingre" class="selected-ingre nut_table_inner">
					<li class="default-ingre-item" id="ingre-item">
						<ul class="career_salary_class recipe_class">
							<li class="panel-title">
								<input class="ingre-item-name" type="text" id="add-more-name" value="type field heading here" rel="type field heading here">
								<!--<span class="ingre-item-text"></span>-->
							</li>				
							<li class="panel-input">
								<input class="ingre-item-title" type="text" id="add-more-title" value="type field title here" rel="type field title here">
								<!--<span class="ingre-item-text"></span>-->
							</li>
							<li class="description"><span class="panel-delete-ingre"></span></li>
						</ul>
					</li>
				<?php

				$children = '';
				$children_title = '';
				$nofields = '';
				//Sidebar addition
				if($jobs_post_name <> ''){
					$ingre_xml = new DOMDocument();
					$ingre_xml->loadXML($jobs_post_name);
					$children = $ingre_xml->documentElement->childNodes;
					$nofields = $ingre_xml->documentElement->childNodes->length;
				}		
				
				if($jobs_post_title <> ''){	
					$ingre_title_xml = new DOMDocument();
					$ingre_title_xml->loadXML($jobs_post_title);
					$children_title = $ingre_title_xml->documentElement->childNodes;
				}
					
					
					
					$counter = 0;
					//$ingre_xml->documentElement->childNodes;
					if($nofields <> ''){
						for($i=0;$i<$nofields;$i++) { 
							$counter++;?>
								<ul class="career_salary_class recipe_class">
									<li class="panel-title">
										<input type="text" name="add-more-name[]" value="<?php echo $children->item($i)->nodeValue;?>">
										<!--<span class="ingre-item-text"></span>-->
									</li>				
									<li class="panel-input">
										<?php if($children_title <> ''){?><input type="text" name="add-more-title[]" value="<?php echo $children_title->item($i)->nodeValue;?>"><?php }?>
										<!--<span class="ingre-item-text"></span>-->
									</li>
									<li class="description"><span class="panel-delete-ingre"></span></li>
								</ul>
							<?php
						}
					}
				
				?>
				</ul>
			</ul>
			<div class="clear"></div>
			<ul class="recipe_class">
				<li class="panel-title">
					<label for="career_country"><?php _e('Country', 'crunchpress'); ?></label>
				</li>
				<?php //print_r($countries);?>
				<li class="panel-input">	
					<div class="combobox">
						<select name="career_country" id="event_thumbnail">
								<option value="No Country"> -- No Country -- </option>
							<?php 
							foreach( $countries as $values){?>
								<option value="<?php echo $values;?>" <?php if($career_country == $values){echo 'selected';}?>><?php echo $values;?></option>
							<?php }?>
						</select>
					</div>
				</li>
				<li class="description"><p><?php _e('Please select Country Name.','crunchpress'); ?></p></li>			
			</ul>
			<div class="clear"></div>
			<input type="hidden" name="career_submit" value="career"/>
			<div class="clear"></div>
	</div>	
	<div class="clear"></div>
		
	<?php }
	add_action('save_post','save_career_option_meta');
	function save_career_option_meta($post_id){
		
		$career_detail_xml = '';
		$career_social = '';
		$sidebar_event = '';
		$right_sidebar_event = '';
		$left_sidebar_event = '';
		$date_posted = '';
		$career_city = '';
		$career_country = '';
		$career_apply = '';
		
		foreach($_REQUEST as $keys=>$values){
			$$keys = $values;
		}
	
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
	
			if(isset($career_submit) AND $career_submit == 'career'){
				$new_data = '<career_detail>';
				$new_data = $new_data . create_xml_tag('career_social',$career_social);
				$new_data = $new_data . create_xml_tag('sidebar_event',$sidebars);
				$new_data = $new_data . create_xml_tag('right_sidebar_event',$right_sidebar_event);
				$new_data = $new_data . create_xml_tag('left_sidebar_event',$left_sidebar_event);
				$new_data = $new_data . create_xml_tag('career_city',$career_city);
				$new_data = $new_data . create_xml_tag('career_salary',$career_salary);
				$new_data = $new_data . create_xml_tag('career_country',$career_country);
				$new_data = $new_data . create_xml_tag('career_apply',$career_apply);
				$new_data = $new_data . '</career_detail>';

				//Saving Sidebar and Social Sharing Settings as XML
				$old_data = get_post_meta($post_id, 'career_detail_xml',true);
				save_meta_data($post_id, $new_data, $old_data, 'career_detail_xml');
				
				if(isset($date_posted) AND $date_posted <> ''){
					$new_data_date = $date_posted;
				}else if(isset($date_posted)){
					$new_data_date = '';
				}
				//Date Posted
				$old_data = get_post_meta($post_id, 'date_posted',true);
				save_meta_data($post_id, $new_data_date, $old_data, 'date_posted');
				
				$jobs_post_xml = '<jobs_post_xml>';
				if(isset($_POST['add-more-name'])){$jobs_post_name = $_POST['add-more-name'];
					foreach($jobs_post_name as $keys=>$values){
						$jobs_post_xml = $jobs_post_xml . create_xml_tag('jobs_post_name',$values);
					}
				}else{$jobs_post_name = '';}
				$jobs_post_xml = $jobs_post_xml . '</jobs_post_xml>';
			
				//Date Posted
				$old_data = get_post_meta($post_id, 'jobs_post_name',true);
				save_meta_data($post_id, $jobs_post_xml, $old_data, 'jobs_post_name');
				
				$jobs_name_post_xml = '<jobs_title_xml>';
				if(isset($_POST['add-more-title'])){$jobs_post_title = $_POST['add-more-title'];
					foreach($jobs_post_title as $keys=>$values){
						$jobs_name_post_xml = $jobs_name_post_xml . create_xml_tag('jobs_post_title',$values);
					}
				}else{$jobs_post_title = '';}
				$jobs_name_post_xml = $jobs_name_post_xml . '</jobs_title_xml>';
			
				//Date Posted
				$old_data = get_post_meta($post_id, 'jobs_post_title',true);
				save_meta_data($post_id, $jobs_name_post_xml, $old_data, 'jobs_post_title');
			
			}
	}
	
	
	
	//EVENT FRONTEND AREA START
	$event_div_size_num_class = array(
		"Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1170,420), "size2"=>array(770, 400), "size3"=>array(570,300)),
		"Small-Thumbnail" => array("index"=>"2", "class"=>"sixteen", "size"=>array(175,155), "size2"=>array(175,155), "size3"=>array(175,155))
	);

	
	// Print Event item
	function print_career_item($item_xml){

		wp_reset_query();
		global $paged,$sidebar,$event_div_size_num_class,$post,$counter;
		
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		$item_type = find_xml_value($item_xml, 'event-thumbnail-type');
		// get the item class and size from array
		$item_class = '';
		if( $sidebar == "no-sidebar" ){
			
			$calendar_width = '900';
			$item_class = 'full_sidebar_class';
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			
			$calendar_width = '600';
		}else{
			
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
		
		
		
		
		if(!empty($header)){
		
			echo '<h2 class="heading">' . $header . '</h2>';
			echo '<span class="border-line m-bottom"></span>';
		}
		
		$category = find_xml_value($item_xml, 'category');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'career-category');
			$category = $category_term->slug;
		}
	
	
		?>
		<section class="horizontal_tabs_wrapper span12 first mbtm2">
		<?php
			if($category <> ''){
			query_posts(array(
				'posts_per_page'			=> $num_fetch,
				'paged'						=> $paged,
				'post_type'					=> 'career',
				'career-category'			=> $category,
				'post_status'				=> 'publish',
				'meta_key'					=> 'date_posted',
				'meta_value'				=> date('m/d/Y'),
				'meta_compare'				=> '>=',
				'orderby'					=> 'meta_value',
				'post_status'				=> 'publish',
				'order'						=> 'DESC',
				));
			}else{
			query_posts(array(
				'posts_per_page'			=> $num_fetch,
				'paged'						=> $paged,
				'post_type'					=> 'career',
				'post_status'				=> 'publish',
				'meta_key'					=> 'date_posted',
				'meta_value'				=> date('m/d/Y'),
				'meta_compare'				=> '>=',
				'orderby'					=> 'meta_value',
				'order'						=> 'DESC',
				));
			
			}
			echo '<section class="horizontal_tabs_wrapper span3 first mbtm2"><figure id="horizontal_tabs"><ul id="myTab">';
			$counter_selected = 0;
			while( have_posts() ){
				the_post();
				$counter_selected++;
				?>
					<li class="<?php if($counter_selected == 1){echo 'active';}?>"><a data-toggle="tab" href="#<?php echo $post->ID;?>-post"><?php echo get_the_title();?></a></li>
				<?php
				}
			echo '</ul></figure></section>';	
			?>
				<figure class="span9" id="horizontal_tabs_content">			
					<div class="tab-content" id="myTabContent">
		<?php
			$counter_selected = 0;
			while( have_posts() ){
				the_post();
				$counter_selected++;
				$date_posted = get_post_meta($post->ID, 'date_posted', true);
				$career_detail_xml = get_post_meta($post->ID, 'career_detail_xml', true);
				if($career_detail_xml <> ''){
					$cp_event_xml = new DOMDocument ();
					$cp_event_xml->loadXML ( $career_detail_xml );
					$career_social = find_xml_value($cp_event_xml->documentElement,'career_social');
					$sidebar_event = find_xml_value($cp_event_xml->documentElement,'sidebar_event');
					$left_sidebar_event = find_xml_value($cp_event_xml->documentElement,'left_sidebar_event');
					$right_sidebar_event = find_xml_value($cp_event_xml->documentElement,'right_sidebar_event');
					$career_city = find_xml_value($cp_event_xml->documentElement,'career_city');
					$career_salary = find_xml_value($cp_event_xml->documentElement,'career_salary');
					$career_country = find_xml_value($cp_event_xml->documentElement,'career_country');
					$career_apply = find_xml_value($cp_event_xml->documentElement,'career_apply');
				}
				?>
					<div id="<?php echo $post->ID;?>-post" class="tab-pane <?php if($counter_selected == 1){echo 'active';}?>">
						<h3><?php echo get_the_title();?></h3>
						<p><?php echo get_the_content();?></p>
						<strong><?php _e('Job Detail','crunchpress');?></strong>
						<ol>
							<li> <?php _e('Salary','crunchpress');?> - <?php echo $career_salary;?>	 </li>
							<li> <?php _e('Address','crunchpress');?> - <?php echo $career_city.' '.$career_country;?></li>
							<li> <?php _e('Date Posted','crunchpress');?> - <?php echo date(get_option('date_format'),strtotime($date_posted));?></li>
						</ol>
						<a class="donate_btn pull-right" href="<?php echo get_permalink()?>"> <?php _e('Apply Now','crunchpress');?> </a>
					</div>
			<?php	
			}//End While
		?>
					</div>
				</figure>
			</section>
			<div class="clear"></div>
		<?php
		if( find_xml_value($item_xml, "pagination") == "Yes" ){	
			pagination();
		}	
	}	
	
	// print the blog thumbnail
	function print_career_thumbnail( $post_id, $item_size ){
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
		wp_enqueue_style('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/css/anythingslider.css');
		
		wp_register_script('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.js', false, '1.0', true);
		wp_enqueue_script('cp-anything-slider');	

		wp_register_script('cp-anything-slider-fx', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.fx.js', false, '1.0', true);
		wp_enqueue_script('cp-anything-slider-fx');	
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
				
				echo '<div class="thumbnail_image">';
					echo print_anything_slider($slider_name,$slider_xml_dom->documentElement, $item_size);
				echo '</div>';		
			}
		}	
		
	}

	
?>