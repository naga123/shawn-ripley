<?php
	// Find the XML value from XML Object
	function find_xml_value($xml, $field){
	
		if(!empty($xml)){
		
			foreach($xml->childNodes as $xmlChild){
			
				if($xmlChild->nodeName == $field){
					if( is_admin() ){
						return $xmlChild->nodeValue;
					}else{
						return $xmlChild->nodeValue;
					}
				}
				
			}
			
		}
		
		return '';
		
	}
	
	// Checking Google Font	
	function verify_font($font_google){
	//print_r($font_google);
	$fonts_array = get_font_array();
		foreach($fonts_array as $keys=>$values){
			if($values == 'Google Font'){
				if($keys == $font_google){
					return 'Google Font';
				}
			}
		}
	}
	
	function verify_google_f($font_google){
		$font_array = get_font_array();
		$google_array_find = array_keys($font_array);
		if($font_google == 'Default'){return 'no_font';}else{
			if(in_array($font_google,$google_array_find)){
				return 'google_font';
			}else{
				return 'type_kit';
			}
		}
	}
	
	
	function verify_google_para($font_heading){
		$font_array = get_font_array();
		$google_array_find = array_keys($font_array);
		if($font_heading == 'Default'){return 'no_font';}else{
			if(in_array($font_heading,$google_array_find)){
				return 'google_font';
			}else{
				return 'type_kit';
			}
		}
	}
	
	function verify_google_menu($font_menu){
		$font_array = get_font_array();
		$google_array_find = array_keys($font_array);
		if($font_menu == 'Default'){return 'no_font';}else{
			if(in_array($font_menu,$google_array_find)){
				return 'google_font';
			}else{
				return 'type_kit';
			}
		}
	}
	
	function find_xml_child_nodes($xml_data,$tag_name,$child_node){
		if(!empty($xml_data)){
			$cp_slider = new DOMDocument ();
			$cp_slider->loadXML ( $xml_data );
			$element_tag_name = $cp_slider->getElementsByTagName($tag_name);
			foreach($element_tag_name as $element_tag){
				foreach($element_tag->childNodes as $i){
					if($i->tagName == $child_node){
							return $i->nodeValue;
					}
				}
			}
		}
		return '';
	}
	
	//Array Values NodeValue
	function return_xml_array($children_des){
		$array_data = array();
		$counter = 0;
		foreach($children_des as $values){
			$array_data[] = $values->nodeValue;
		}
		return $array_data;
	}
	
	
	
		// return the title list of each post_type
	function get_slug_id( $post_type ){
		
		$posts_title = array();
		$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
		
		foreach ($posts as $post) {
			$posts_title[] = $post->ID;
		}
		
		return $posts_title;
	
	}	
	// Find the XML node from XML Object
	function find_xml_node($xml, $node){
	
		if(!empty($xml)){
		
			foreach($xml->childNodes as $xmlChild){
			
				if($xmlChild->nodeName == $node){
				
					return $xmlChild;
					
				}
				
			}
			
		}
		
		return '';
		
	}
	
	// Create tag string from nodename and value
	function create_xml_tag($node, $value){
	
		return '<' . $node . '>' . $value . '</' . $node . '>';
		
	}
	
	// Get array of sidebar name
	function get_sidebar_name(){
	
		global $cp_sidebar;
		$sidebar = array();
		
		if(!empty($cp_sidebar)){
		
			$xml = new DOMDocument();
			$xml->loadXML($cp_sidebar);
			
			foreach( $xml->documentElement->childNodes as $sidebar_name ){
			
				$sidebar[] = $sidebar_name->nodeValue;
				
			}
			
		}
		
		return $sidebar;
		
	}
	get_google_font();
	function get_google_font(){
	
	get_template_part( 'framework/extensions/google', 'font' );
	  
		global $all_font;
		$google_fonts = update_google_font_array();
		
		foreach($google_fonts as $google_font){
		
			$all_font[$google_font['family']] = array('status'=>'enabled','type'=>'Google Font','is-used'=>false);
		
		}
		
	}
	
	function get_font_array( $type = '' ){
		global $all_font;
		
		$cp_typekit_settings = get_option('typokit_settings');
		if($cp_typekit_settings <> ''){
			$typekit_xml = new DOMDocument();
			$typekit_xml->loadXML($cp_typekit_settings);
			foreach( $typekit_xml->documentElement->childNodes as $typekit_font ){
					$all_font[$typekit_font->nodeValue] = array('status'=>'enabled','type'=>'Used font','is-used'=>false,);
			}
		}
		foreach($all_font as $font_name => $font_value){
		
			if( empty($type) || $type == $font_value['type'] ){
				$fonts[$font_name] = $font_value['type'];
			}
			
		}
			
		return $fonts;
		
	}
	
	// get width and height from string WIDTHxHEIGHT
	function cp_get_width( $size ){
		$size_array = $size;
		return $size_array[0];
	}
	function cp_get_height( $size ){
		$size_array = $size;
		return $size_array[1];
	}
	
	// use ajax to print all of media image
	add_action('wp_ajax_get_media_image','get_media_image');
	function get_media_image(){
	
		$image_width = 70;
		$image_height = 70;
		
		$paged = (isset($_POST['page']))? $_POST['page'] : 1; 	
		if($paged == ''){ $paged = 1; }
		
		$statement = array('post_type' => 'attachment',
			'post_mime_type' =>'image',
			'post_status' => 'inherit', 
			'posts_per_page' => 12,
			'paged' => $paged);
		$media_query = new WP_Query($statement);
	
		?>
		
		<div class="media-title">
			<label><?php _e('Insert Gallery Items','cp_front_end'); ?></label>
		</div>
		
		<?php
		
		echo '<div class="media-gallery-nav" id="media-gallery-nav">';
		echo '<ul>';
		echo '<a><li class="nav-first" rel="1" ></li></a>';
		
		for( $i=1 ; $i<=$media_query->max_num_pages; $i++){
		
			if($i == $paged){
				echo '<li rel="' . $i . '">' . $i . '</li>';
			}else if( ($i <= $paged+2 && $i >= $paged-2) || $i%10 == 0){
				echo '<a><li rel="' . $i . '">' . $i . '</li></a>';		
			}
			
		}
		echo '<a><li class="nav-last" rel="' . $media_query->max_num_pages . '"></li></a>';
		echo '</ul>';
		echo '</div><br class=clear>';
	
		echo '<ul>';
		
		foreach( $media_query->posts as $image ){ 
		
			$thumb_src = wp_get_attachment_image_src( $image->ID, '150x150');
			$thumb_src_preview = wp_get_attachment_image_src( $image->ID, '160x110');
			echo '<li><img src="' . $thumb_src[0] .'" title="' . $image->post_title . '" attid="' . $image->ID . '" rel="' . $thumb_src_preview[0] . '"/></li>';
		
		}
		
		echo '</ul><br class=clear>';
		
		if(isset($_POST['page'])){ die(''); }
	}
	
	
	//Adding Ajax Url for Dummy Data
	add_action('wp_head','jajax_ajaxurl');
	function jajax_ajaxurl() {?>
		<script type="text/javascript">
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		</script>
	<?php
	}

	// return the slider option array to use with javascript file
	function get_cp_slider_option_array($slider_option){
	
		$slider_setting = array();
	// print_r($slider_option); die;
		foreach($slider_option as $value){
			
			$set_value = get_option($value['name']);
			
			if(isset($value['oldname']) && $set_value){
			
				$slider_setting[$value['oldname']] = $set_value;
			
			}
		}
		
		return $slider_setting;
	}

		// return the array of category
	function get_category_list( $category_name, $parent='' ){
		
		if( empty($parent) ){ 
		
			$get_category = get_categories( array( 'taxonomy' => $category_name	));
			$category_list = array( '0' =>'All');
			
			foreach( $get_category as $category ){
				$category_list[] = $category->cat_name;
			}
				
			return $category_list;
			
		}else{
			
			$parent_id = get_term_by('name', $parent, $category_name);
			$get_category = get_categories( array( 'taxonomy' => $category_name, 'child_of' => $parent_id->term_id	));
			$category_list = array( '0' => $parent );
			
			foreach( $get_category as $category ){
				$category_list[] = $category->cat_name;
			}
				
			return $category_list;		
		
		}
	}
	
		// return the array of category
	function get_category_list_array( $category_name, $parent='' ){
		
		if( empty($parent) ){ 
			//$category_list = array( '0' =>'All');
			$get_category = get_categories( array( 'taxonomy' => $category_name	));
			
			foreach( $get_category as $category ){
				$category_list[] = $category;
			}
				
			return $category_list;
			
		}else{
			//$category_list = array( '0' =>'All');
			$parent_id = get_term_by('name', $parent, $category_name);
			$get_category = get_categories( array( 'taxonomy' => $category_name, 'child_of' => $parent_id->term_id	));
			$category_list = array( '0' => $parent );
			
			foreach( $get_category as $category ){
				$category_list[] = $category;
			}
				
			return $category_list;		
		
		}
	}
	
	
		//Calendar Function
		function calendar_function($calendar_name){
		global $post_id,$wp_query,$post;
		wp_enqueue_style('cp-calender-view', CP_PATH_URL.'/framework/javascript/fullcalendar/fullcalendar.css');?>
			<script>
			jQuery(document).ready(function($) {
					var date = new Date();
				
					$('#<?php echo $calendar_name;?>').fullCalendar({
						editable: false,
						header: {
							left: 'prev,next',
							center: 'title',
							right: ''
						},
						buttonText: {
							prev: "<span class='fc-text-arrow'>Previous Month</span>",
							next: "<span class='fc-text-arrow'>Next Month</span>",
						},
						disableDragging: true,
						events: [
						<?php while ( $wp_query->have_posts() ): $wp_query->the_post();
						$event_start_date = get_post_meta($post->ID, 'event_start_date', true);
						$event_end_date = get_post_meta($post->ID, 'event_end_date', true);
						
						$event_detail_xml = get_post_meta($post->ID, 'event_detail_xml', true);
							if($event_detail_xml <> ''){
								$cp_event_xml = new DOMDocument ();
								$cp_event_xml->loadXML ( $event_detail_xml );
								
								$event_start_time = find_xml_value($cp_event_xml->documentElement,'event_start_time');
								$event_end_time = find_xml_value($cp_event_xml->documentElement,'event_end_time');
							
							$hour_start = date("H", strtotime($event_start_time));
							$mint_start = date("i", strtotime($event_start_time));					
							
							$hour_end = date("H", strtotime($event_end_time));
							$mint_end = date("i", strtotime($event_end_time));					
		
							//Start From
							$year_from = date("Y", strtotime($event_start_date));
							$month_from = date("m", strtotime($event_start_date));
							$day_from = date("d", strtotime($event_start_date));
							
							//Ends on 
							$year_to = date("Y", strtotime($event_end_date));
							$month_to = date("m", strtotime($event_end_date));
							$day_to = date("d", strtotime($event_end_date));
							
						
						?>
							{
							title: '<?php echo html_entity_decode(mb_substr(get_the_title(), 0, 30)).'....'?>',
							start: new Date(<?php echo $year_from;?>, <?php echo $month_from;?>-1, <?php echo $day_from;?>, <?php echo $hour_start?>, <?php echo $mint_start;?>),
							end: new Date(<?php echo $year_to;?>, <?php echo $month_to;?>-1, <?php echo $day_to;?>, <?php echo $hour_end;?>, <?php echo $mint_end;?>),
							url: '<?php echo get_permalink()?>',
							allDay: false

							},
						<?php 
						}
						endwhile; ?>
						]
					});
				});	
				</script>
			<?php }
	//Calendar Function Ends
	
	// return the title list of each post_type
	function get_title_list( $post_type ){
		
		$posts_title = array();
		$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
		
		foreach ($posts as $post) {
			$posts_title[] = $post->post_title;
		}
		
		return $posts_title;
	
	}
	
	function get_title_list_slug( $post_type ){
		
		$posts_title = array();
		$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
		
		foreach ($posts as $post) {
			$posts_title[] = $post->post_name;
		}
		
		return $posts_title;
	
	}
	
	// return the title list of each post_type
	function get_title_list_array( $post_type ){
		
		$posts_title = array();
		$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
		
		foreach ($posts as $post) {
			$posts_title[] = $post;
		}
		
		return $posts_title;
	
	}

	
	
	// return the title list of each post_type
	function get_slug_list( $post_type ){
		
		$posts_title = array();
		$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
		
		foreach ($posts as $post) {
			$posts_title[] = $post->post_name;
		}
		
		return $posts_title;
	
	}		

	// return the title list of each post_type
	function layer_slider_title(){
		if(function_exists('layerslider_activation_scripts')){
			global $wpdb;
			$table_name = $wpdb->prefix . "layerslider";
				$sliders = $wpdb->get_results( "SELECT * FROM $table_name
					WHERE flag_hidden = '0' AND flag_deleted = '0'
					ORDER BY date_c ASC LIMIT 100" );
			if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table_name."'"))==1) {
				foreach($sliders as $keys=>$values){
					$post_title[] = $values->name;
									
				}
				return $post_title;
			}
		}
	}
	
	// return the title list of each post_type
	function layer_slider_id(){
		
		global $wpdb,$post_id_slider;
		$post_id_slider = '';
		$table_name = $wpdb->prefix . "layerslider";
			$sliders = $wpdb->get_results( "SELECT * FROM $table_name
				WHERE flag_hidden = '0' AND flag_deleted = '0'
				ORDER BY date_c ASC LIMIT 100" );
		if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table_name."'"))==1) {
			foreach($sliders as $keys=>$values){
				$post_id_slider[] = $values->id;
								
			}
			return $post_id_slider;
		}
	
	}
	
	function hexLighter($hex,$factor = 80) { 
		$new_hex = ''; 
		 
		$base['R'] = hexdec($hex{0}.$hex{1}); 
		$base['G'] = hexdec($hex{2}.$hex{3}); 
		$base['B'] = hexdec($hex{4}.$hex{5}); 
		 
		foreach ($base as $k => $v) 
			{ 
			$amount = 255 - $v; 
			$amount = $amount / 100; 
			$amount = round($amount * $factor); 
			$new_decimal = $v + $amount; 
		 
			$new_hex_component = dechex($new_decimal); 
			if(strlen($new_hex_component) < 2) 
				{ $new_hex_component = "0".$new_hex_component; } 
			$new_hex .= $new_hex_component; 
			} 
			 
		return $new_hex;     
	} 
	
	function hexDarker($hex,$factor = 30){
        $new_hex = '';
        
        $base['R'] = hexdec($hex{0}.$hex{1});
        $base['G'] = hexdec($hex{2}.$hex{3});
        $base['B'] = hexdec($hex{4}.$hex{5});
        
        foreach ($base as $k => $v)
                {
                $amount = $v / 100;
                $amount = round($amount * $factor);
                $new_decimal = $v - $amount;
        
                $new_hex_component = dechex($new_decimal);
                if(strlen($new_hex_component) < 2)
                        { $new_hex_component = "0".$new_hex_component; }
                $new_hex .= $new_hex_component;
                }
                
        return $new_hex;        
    }
	function show_sidebar($sidebar_name, $right_sidebar,$left_sidebar,$value_right,$value_left){?>
			<style>
			.cp_right_sidebar{
				display:none;
			}
			.cp_left_sidebar{
				display:none;
			}
			</style>
			<ul class="panel-body recipe_class">
				<li class="panel-title">
					<label for=""><?php _e('Sidebars', 'crunchpress'); ?></label>
				</li>
				<div class="panel-radioimage">
					<?php 
						$options = array(
							'1'=>array('value'=>'right-sidebar','image'=>'/framework/images/right-sidebar.png'),
							'2'=>array('value'=>'left-sidebar','image'=>'/framework/images/left-sidebar.png'),
							'3'=>array('value'=>'both-sidebar','image'=>'/framework/images/both-sidebar.png','default'=>'selected'),
							'4'=>array('value'=>'both-sidebar-left','image'=>'/framework/images/both-sidebar-left.png'),
							'5'=>array('value'=>'both-sidebar-right','image'=>'/framework/images/both-sidebar-right.png'),
							'6'=>array('value'=>'no-sidebar','image'=>'/framework/images/no-sidebar.png')
						);
					foreach( $options as $option ){ ?>
						<div class='radio-image-wrapper'>
							<label for="<?php echo $option['value']; ?>">
								<img src=<?php echo CP_PATH_URL.$option['image']?> class="<?php echo $sidebar_name;?>" alt="<?php echo $sidebar_name;?>">
								<div id="check-list" <?php 
									if($sidebar_name == $option['value']){
										echo 'class="check-list"';
									}
								?>>
							</div>                                
							</label>
							<input type="radio" name="sidebars" value="<?php echo $option['value']; ?>" <?php 
									if($sidebar_name == $option['value']){
										echo 'checked';
									}
							?> id="<?php echo $option['value']; ?>" class="<?php echo $sidebar_name;?>"
							>                            
						</div>
					<?php } ?>
					<br class="clear">	
				</div>
				<div class="clear"></div>
			</ul>
			<div class="clear"></div>					
			<ul class="cp_right_sidebar recipe_class">
				<li class="panel-title">
					<label for="cp_sidebar_dropdown"><?php _e('Right Sidebar', 'crunchpress'); ?></label>
				</li>
				<li class="panel-input">	
					<div class="combobox">
						<select name="<?php echo $right_sidebar?>" id="cp_sidebar_dropdown">								
							<?php
							$cp_sidebar_settings = get_option('sidebar_settings');
							if($cp_sidebar_settings <> ''){
								$sidebars_xml = new DOMDocument();
								$sidebars_xml->loadXML($cp_sidebar_settings);
								foreach( $sidebars_xml->documentElement->childNodes as $sidebar_name ){?>
									<option <?php if($value_right == $sidebar_name->nodeValue){ echo 'selected';}?> value="<?php echo $sidebar_name->nodeValue; ?>"><?php echo $sidebar_name->nodeValue; ?></option>
							<?php }
							} ?>	
						</select>
					</div>
				</li>
				<li class="description"><p><?php _e('Select Slide from dropdown to use in main slider.', 'crunchpress'); ?></p></li>				
			</ul>
			<div class="clear"></div>
			<ul class="cp_left_sidebar recipe_class">
				<li class="panel-title">
					<label for="cp_sidebar_dropdown_left"><?php _e('Left Sidebar', 'crunchpress'); ?></label>
				</li>
				<li class="panel-input">	
					<div class="combobox">
						<select name="<?php echo $left_sidebar?>" id="cp_sidebar_dropdown_left">								
							<?php
							if($cp_sidebar_settings <> ''){
								$sidebars_xml = new DOMDocument();
								$sidebars_xml->loadXML($cp_sidebar_settings);
								foreach( $sidebars_xml->documentElement->childNodes as $sidebar_name ){?>
									<option <?php if($value_left == $sidebar_name->nodeValue){ echo 'selected';}?> value="<?php echo $sidebar_name->nodeValue; ?>"><?php echo $sidebar_name->nodeValue; ?></option>
							<?php }
							} ?>	
						</select>
					</div>
				</li>
				<li class="description"><p><?php _e('Select Slide from dropdown to use in main slider.', 'crunchpress'); ?></p></li>
			</ul>
			<div class="clear"></div>
<?php } 
	function top_navigation_html(){		
		if(is_admin()){?>
			<div class="user_login_detail">
				<span class="user_detail">
					<img src="<?php echo CP_PATH_URL;?>/framework/images/logo-backned.png"  alt="Be Human" />
				</span>
			</div>
			<div class="top_nav">
				<ul>
					<li class="icon gen_set<?php if($_GET['page']=="general_options"){echo " active";} ?>"> <a href="?page=general_options" > <span> <?php _e('General', 'crunchpress'); ?> </span> </a> </li>
					<!--<li class="icon home_set<?php if($_GET['page']=="homepage_settings"){echo " active";} ?>"> <a href="?page=homepage_settings" class=""> <span> <?php _e('Home Page', 'crunchpress'); ?> </span> </a> </li>-->
					<li class="icon typo_set<?php if($_GET['page']=="typography_settings"){echo " active";} ?>"> <a href="?page=typography_settings" class=""><span><?php _e('Typography', 'crunchpress'); ?> </span> </a> </li>
					<li class="icon slid_set<?php if($_GET['page']=="slider_settings"){echo " active";} ?>"> <a href="?page=slider_settings" class="">  <span> <?php _e('Slider', 'crunchpress'); ?> </span>  </a> </li>
					<li class="icon side_set<?php if($_GET['page']=="sidebar_settings"){echo " active";} ?>"> <a href="?page=sidebar_settings" class=" ">  <span> <?php _e('Sidebar', 'crunchpress'); ?> </span> </a> </li>
					<li class="icon default_set<?php if($_GET['page']=="default_pages_settings"){echo " active";} ?>"> <a href="?page=default_pages_settings" class=""> <span> <?php _e('Default Page', 'crunchpress'); ?> </span> </a> </li>
					<li class="icon social_set<?php if($_GET['page']=="social_settings"){echo " active";} ?>"> <a href="?page=social_settings" class=""> <span> <?php _e('Social', 'crunchpress'); ?> </span> </a> </li>
					<li class="icon news_set<?php if($_GET['page']=="newsletter_settings"){echo " active";} ?>"> <a href="?page=newsletter_settings" class=""> <span><?php _e('Newsletter', 'crunchpress'); ?> </span> </a></li>
					<li class="icon import_ex<?php if($_GET['page']=="dummydata_import"){echo " active";} ?>"> <a href="?page=dummydata_import" class=""> <span><?php _e('Import Data', 'crunchpress'); ?></span> </a></li>
					<?php $mystring = $_SERVER['REQUEST_URI'];
					$findme = 'seo_settings';
					$seo_settings = strpos($mystring, $findme);
					?>
					<!--<li class="icon seo_set <?php if(isset($seo_settings) AND $seo_settings <> '' ){echo "active";} ?>"> <a href="?page=admin.php?page=seo_settings" class=""> <span> SEO </span> </a></li>-->
				</ul>
			</div>			
		<?php
		}
	}
	
		function get_slider_id($slider_name){
			//$post_slider_slug = get_posts(array('post_type' => 'cp_slider','name' => $slider_slide,'numberposts' => 1));
			if(!empty($slider_name)){
			$layer_slider_id = get_post_meta( $slider_name, 'cp-slider-xml', true);
				if($layer_slider_id <> ''){
					$slider_xml_dom = new DOMDocument ();
					$slider_xml_dom->loadXML ( $layer_slider_id );
					return $slider_xml_dom->documentElement;
				}
			}
		}
	
	
	function popular_set_post_views($postID) {
		$count_key = 'popular_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
	//To keep the count accurate, lets get rid of prefetching
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

	function popular_track_post_views ($post_id) {
		if ( !is_single() ) return;
		if ( empty ( $post_id) ) {
			global $post;
			$post_id = $post->ID;    
		}
		popular_set_post_views($post_id);
	}
	add_action( 'wp_head', 'popular_track_post_views');


	function wpb_get_post_views($postID){
		$count_key = 'popular_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0 View";
		}
		return $count.' Views';
	}
	//Page Slider 
	function page_slider(){
	global $post;
		
		$slider_off = '';
		$slider_type = '';
		$slider_slide = '';
		$slider_height = '';
		$slider_off = get_post_meta ( $post->ID, "page-option-top-slider-on", true );
		if($slider_off == 'Yes'){
			//Get Page Main Slider Values
			$slider_type = get_post_meta ( $post->ID, "page-option-top-slider-types", true );
			$slider_layer_id = get_post_meta ( $post->ID, "page-option-top-slider-layer", true );
			
			$slider_slide = get_post_meta ( $post->ID, "page-option-top-slider-images", true );
			$slider_height = get_post_meta ( $post->ID, "page-option-top-slider-height", true );
			$size_new = '';
			//Print Main Slider Values on page
			//$post_slider_slug = get_posts(array('post_type' => 'cp_slider','name' => $slider_slide,'numberposts' => 1));
			if(!empty($slider_slide)){
				$slider_input_xml = get_post_meta( $slider_slide, 'cp-slider-xml', true);
				if($slider_input_xml <> ''){
				$slider_xml_dom = new DOMDocument ();
				$slider_xml_dom->loadXML ( $slider_input_xml );
					if($slider_type == 'Anything'){
						$slider_name = 'anything_page';
						echo '<div class="main-content anything_page">';
						echo print_anything_slider($slider_name,$slider_xml_dom->documentElement,array(5000,1400));
						echo '</div>';
						
					} else if($slider_type == 'Flex-Slider'){
							echo print_flex_slider($slider_xml_dom->documentElement,array(5000,1400));						
					}else if($slider_type == 'default'){
						echo print_fine_slider($slider_xml_dom->documentElement,$size='980x654');
					}else if($slider_type == 'Bx-Slider'){
						echo '<section class="banner_slider mbtm">';
							echo print_bx_slider_page($slider_xml_dom->documentElement,array(5000,1400));
						echo '</section>';
					}
				}
			}
			// Layer SLider
			if($slider_type == 'Layer-Slider'){
				if($slider_layer_id <> ''){
				// Link content resources
					echo do_shortcode('[layerslider id="' . $slider_layer_id . '"]');	
				}
			}
		}
	}
	//Social Networking Icons
	function social_networking_new(){
				//Social Networking
		$facebook_network = '';
		$twitter_network = '';
		$delicious_network = '';
		$google_plus_network = '';
		$su_network = '';
		$linked_in_network = '';
		$digg_network = '';
		$myspace_network = '';
		$reddit_network = '';
		$youtube_network = '';
		$flickr_network = '';
		$picasa_network = '';
		$vimeo_network = '';
		
		$cp_social_settings = get_option('social_settings');
		if($cp_social_settings <> ''){
			$cp_social = new DOMDocument ();
			$cp_social->loadXML ( $cp_social_settings );
			//Social Networking Values
			$facebook_network = find_xml_value($cp_social->documentElement,'facebook_network');
			$twitter_network = find_xml_value($cp_social->documentElement,'twitter_network');
			$delicious_network = find_xml_value($cp_social->documentElement,'delicious_network');
			$google_plus_network = find_xml_value($cp_social->documentElement,'google_plus_network');
			$su_network = find_xml_value($cp_social->documentElement,'su_network');
			$linked_in_network = find_xml_value($cp_social->documentElement,'linked_in_network');
			$digg_network = find_xml_value($cp_social->documentElement,'digg_network');
			$myspace_network = find_xml_value($cp_social->documentElement,'myspace_network');
			$reddit_network = find_xml_value($cp_social->documentElement,'reddit_network');
			$youtube_network = find_xml_value($cp_social->documentElement,'youtube_network');
			$flickr_network = find_xml_value($cp_social->documentElement,'flickr_network');
			$picasa_network = find_xml_value($cp_social->documentElement,'picasa_network');
			$vimeo_network = find_xml_value($cp_social->documentElement,'vimeo_network');
			
		}
		
		?>
		<ul class="social-list">
			<?php if(isset($facebook_network) AND $facebook_network <> ''){?><li class="fb"><a href="<?php echo esc_url($facebook_network);?>">Facebook</a></li><?php }?>
			<?php if(isset($twitter_network) AND $twitter_network <> ''){?><li class="twitter"><a href="<?php echo esc_url($twitter_network);?>">Twitter</a></li><?php }?>
			<?php if(isset($linked_in_network) AND $linked_in_network <> ''){?><li class="linkedin"><a href="<?php echo esc_url($linked_in_network);?>">Linked In</a></li><?php }?>
			<?php if(isset($google_plus_network) AND $google_plus_network <> ''){?><li class="social-icon"><a href="<?php echo esc_url($google_plus_network);?>">Google Plus</a></li><?php }?>
			<?php if(isset($flickr_network) AND $flickr_network <> ''){?><li class="flicker"><a href="<?php echo esc_url($flickr_network);?>">Flicker</a></li><?php }?>
			<?php if(isset($delicious_network) AND $delicious_network <> ''){?><li class="delcious"><a href="<?php echo esc_url($delicious_network);?>">Delicious</a></li><?php }?>
			<?php if(isset($su_network) AND $su_network <> ''){?><li class="stumbleupon"><a href="<?php echo esc_url($su_network);?>">Google Bookmark</a></li><?php }?>
			<?php if(isset($digg_network) AND $digg_network <> ''){?><li class="digg"><a href="<?php echo esc_url($digg_network);?>">Digg</a></li><?php }?>
			<?php if(isset($reddit_network) AND $reddit_network <> ''){?><li class="reddit"><a href="<?php echo esc_url($reddit_network);?>">Reddit</a></li><?php }?>
			<?php if(isset($youtube_network) AND $youtube_network <> ''){?><li class="youtube"><a href="<?php echo esc_url($youtube_network);?>">Youtube</a></li><?php }?>
			<?php if(isset($picasa_network) AND $picasa_network <> ''){?><li class="picasa"><a href="<?php echo esc_url($picasa_network);?>">Picasa</a></li><?php }?>
			<?php if(isset($vimeo_network) AND $vimeo_network <> ''){?><li class="vimeo"><a href="<?php echo esc_url($vimeo_network);?>">Vimeo</a></li><?php }?>
		</ul>
<?php } 

	//Home Page Slider
	function home_page_slider(){
		$home_slider_on = '';
		$home_select_slider = '';
		$layer_shortcode_text = '';
		$select_slide = '';
		$cp_typography_settings = get_option('homepage_settings');
		if($cp_typography_settings <> ''){
			$cp_typo = new DOMDocument ();
			$cp_typo->loadXML ( $cp_typography_settings );
			$home_slider_on = find_xml_value($cp_typo->documentElement,'home_slider_on');
			$home_select_slider = find_xml_value($cp_typo->documentElement,'home_select_slider');
			$layer_slider_id = find_xml_value($cp_typo->documentElement,'layer_shortcode_text');
			$select_slide = find_xml_value($cp_typo->documentElement,'select_slide');
		}
		if($home_slider_on == 'enable'){
			if($home_select_slider == 'layer_slider'){
				echo '<section class="layer_slider_holder">';
					echo do_shortcode('[layerslider id="' . $layer_slider_id . '"]');	
				echo '</section>';
			}
			//$post_slider_slug = get_posts(array('post_type' => 'cp_slider','name' => $select_slide,'numberposts' => 1));
			if(!empty($select_slide)){
				$slider_images = get_post_meta( $select_slide, 'cp-slider-xml', true);
				if($slider_images <> ''){
				$slider_xml_dom = new DOMDocument ();
				$slider_xml_dom->loadXML ( $slider_images );
					if($home_select_slider == 'anything_slider'){
						echo '<div class="main-content anything_page">';
							$slider_name = 'anything';
							//Included Anything Slider Script
							wp_enqueue_style('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/css/anythingslider.css');
							wp_register_script('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.js', false, '1.0', true);
							wp_enqueue_script('cp-anything-slider');	
							wp_register_script('cp-anything-slider-fx', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.fx.js', false, '1.0', true);
							wp_enqueue_script('cp-anything-slider-fx');	
							
							
							echo print_anything_slider($slider_name,$slider_xml_dom->documentElement,$size='980x654');
						echo '</div>';
					}else if($home_select_slider == 'flex_slider'){
						wp_register_script('cp-flex-slider', CP_PATH_URL.'/frontend/js/jquery.flexslider.js', false, '1.0', true);
						wp_enqueue_script('cp-flex-slider');
						wp_enqueue_style('cp-flex-slider',CP_PATH_URL.'/frontend/css/flexslider.css');
							echo '<div id="homeContent">';
								echo print_flex_slider($slider_xml_dom->documentElement,$size='100x654');
							echo '</div>';
					}else if($home_select_slider == 'default'){
						echo print_fine_slider($slider_xml_dom->documentElement,$size='980x654');
						wp_register_script('cp-Default-Slider', CP_PATH_URL.'/frontend/js/slider.js', false, '1.0', true);
						wp_enqueue_script('cp-Default-Slider');				
						wp_enqueue_style('Default-Slider',CP_PATH_URL.'/frontend/css/slider.css');
					}
				}
			}			
				
		}
	}
	
	//Sidebar function
	function sidebar_func($sidebarr){
		if ($sidebarr == "left-sidebar" || $sidebarr == "right-sidebar") {
            $sidebar_class[] = 'span3 content_sidebar sidebar';
			$sidebar_class[1] = 'span9';
        }else if ($sidebarr == "both-sidebar") {
            $sidebar_class[] = "span3 content_sidebar sidebar";
			$sidebar_class[1] = 'span6';
        }else if($sidebarr == "both-sidebar-left") {
		    $sidebar_class[] = "span3 content_sidebar sidebar";
			$sidebar_class[1] = 'span6';
		}else if($sidebarr == "both-sidebar-right") {
		    $sidebar_class[] = "span3 content_sidebar sidebar";
			$sidebar_class[1] = 'span6';
		}else{
			$sidebar_class[1] = 'span12';
		}
		return $sidebar_class;
	}

	
	
	function related_posts($post){
		$orig_post = $post;  
		global $post,$wp_query;  
		//$tags = wp_get_post_tags($post->ID);  
		$tags = '';
		$get_post_type = get_post_type( $post->ID );
		if($get_post_type == 'post'){
			$tag_type = 'post_tag';
			$tags = wp_get_post_terms($post->ID, 'post_tag');
		}else if($get_post_type == 'events'){
			$tag_type = 'event-tag';
			$tags = wp_get_post_terms($post->ID, 'event-tag');
		}else if($get_post_type == 'attraction'){
			$tag_type = 'attraction-tag';
			$tags = wp_get_post_terms($post->ID, 'attraction-tag');
		}
      
		if ($tags) {  
		$tag_ids = array();  
		foreach($tags as $individual_tag) 		
			$args = array(
				'post_type' => $get_post_type,
				'tax_query' => array(
					array(
						'taxonomy' => $tag_type,
						'field' => 'slug',
						'terms' => $individual_tag->slug,
					)
				)
			);
			$query = new WP_Query( $args );
			$counter_post = 0;
				while ( $query->have_posts() ){ $query->the_post();
				
				if($counter_post % 3 == 1){
						if($orig_post <> $post->ID){
							echo '<hr /><section class="span4 related_article first"> ';
								echo '<div class="related_img_wrapper">'.get_the_post_thumbnail($post->ID, array(300,110)).'</div>';
								echo '<a class="related_title" href="'.get_permalink().'">'.get_the_title().'</a>';
								echo '<p>'.htmlspecialchars(substr(get_the_content(),0,150)).'</p>';
							echo '</section> ';
						 }
					 }else{
						if($orig_post <> $post->ID){
							echo '<section class="span4 related_article"> ';
								echo '<div class="related_img_wrapper">'.get_the_post_thumbnail($post->ID, array(300,110)).'</div>';
								echo '<a class="related_title" href="'.get_permalink().'">'.get_the_title().'</a>';
								echo '<p>'.htmlspecialchars(substr(get_the_content(),0,150)).'</p>';
							echo '</section> ';
						 }
					 }$counter_post++;
				}
 
			}  
		  
		$post = $orig_post;  
		wp_reset_query();  
    }
	
$countries = array(
  "GB" => "United Kingdom",
  "US" => "United States",
  "AF" => "Afghanistan",
  "AL" => "Albania",
  "DZ" => "Algeria",
  "AS" => "American Samoa",
  "AD" => "Andorra",
  "AO" => "Angola",
  "AI" => "Anguilla",
  "AQ" => "Antarctica",
  "AG" => "Antigua And Barbuda",
  "AR" => "Argentina",
  "AM" => "Armenia",
  "AW" => "Aruba",
  "AU" => "Australia",
  "AT" => "Austria",
  "AZ" => "Azerbaijan",
  "BS" => "Bahamas",
  "BH" => "Bahrain",
  "BD" => "Bangladesh",
  "BB" => "Barbados",
  "BY" => "Belarus",
  "BE" => "Belgium",
  "BZ" => "Belize",
  "BJ" => "Benin",
  "BM" => "Bermuda",
  "BT" => "Bhutan",
  "BO" => "Bolivia",
  "BA" => "Bosnia And Herzegowina",
  "BW" => "Botswana",
  "BV" => "Bouvet Island",
  "BR" => "Brazil",
  "IO" => "British Indian Ocean Territory",
  "BN" => "Brunei Darussalam",
  "BG" => "Bulgaria",
  "BF" => "Burkina Faso",
  "BI" => "Burundi",
  "KH" => "Cambodia",
  "CM" => "Cameroon",
  "CA" => "Canada",
  "CV" => "Cape Verde",
  "KY" => "Cayman Islands",
  "CF" => "Central African Republic",
  "TD" => "Chad",
  "CL" => "Chile",
  "CN" => "China",
  "CX" => "Christmas Island",
  "CC" => "Cocos (Keeling) Islands",
  "CO" => "Colombia",
  "KM" => "Comoros",
  "CG" => "Congo",
  "CD" => "Congo, The Democratic Republic Of The",
  "CK" => "Cook Islands",
  "CR" => "Costa Rica",
  "CI" => "Cote D'Ivoire",
  "HR" => "Croatia (Local Name: Hrvatska)",
  "CU" => "Cuba",
  "CY" => "Cyprus",
  "CZ" => "Czech Republic",
  "DK" => "Denmark",
  "DJ" => "Djibouti",
  "DM" => "Dominica",
  "DO" => "Dominican Republic",
  "TP" => "East Timor",
  "EC" => "Ecuador",
  "EG" => "Egypt",
  "SV" => "El Salvador",
  "GQ" => "Equatorial Guinea",
  "ER" => "Eritrea",
  "EE" => "Estonia",
  "ET" => "Ethiopia",
  "FK" => "Falkland Islands (Malvinas)",
  "FO" => "Faroe Islands",
  "FJ" => "Fiji",
  "FI" => "Finland",
  "FR" => "France",
  "FX" => "France, Metropolitan",
  "GF" => "French Guiana",
  "PF" => "French Polynesia",
  "TF" => "French Southern Territories",
  "GA" => "Gabon",
  "GM" => "Gambia",
  "GE" => "Georgia",
  "DE" => "Germany",
  "GH" => "Ghana",
  "GI" => "Gibraltar",
  "GR" => "Greece",
  "GL" => "Greenland",
  "GD" => "Grenada",
  "GP" => "Guadeloupe",
  "GU" => "Guam",
  "GT" => "Guatemala",
  "GN" => "Guinea",
  "GW" => "Guinea-Bissau",
  "GY" => "Guyana",
  "HT" => "Haiti",
  "HM" => "Heard And Mc Donald Islands",
  "VA" => "Holy See (Vatican City State)",
  "HN" => "Honduras",
  "HK" => "Hong Kong",
  "HU" => "Hungary",
  "IS" => "Iceland",
  "IN" => "India",
  "ID" => "Indonesia",
  "IR" => "Iran (Islamic Republic Of)",
  "IQ" => "Iraq",
  "IE" => "Ireland",
  "IL" => "Israel",
  "IT" => "Italy",
  "JM" => "Jamaica",
  "JP" => "Japan",
  "JO" => "Jordan",
  "KZ" => "Kazakhstan",
  "KE" => "Kenya",
  "KI" => "Kiribati",
  "KP" => "Korea, Democratic People's Republic Of",
  "KR" => "Korea, Republic Of",
  "KW" => "Kuwait",
  "KG" => "Kyrgyzstan",
  "LA" => "Lao People's Democratic Republic",
  "LV" => "Latvia",
  "LB" => "Lebanon",
  "LS" => "Lesotho",
  "LR" => "Liberia",
  "LY" => "Libyan Arab Jamahiriya",
  "LI" => "Liechtenstein",
  "LT" => "Lithuania",
  "LU" => "Luxembourg",
  "MO" => "Macau",
  "MK" => "Macedonia, Former Yugoslav Republic Of",
  "MG" => "Madagascar",
  "MW" => "Malawi",
  "MY" => "Malaysia",
  "MV" => "Maldives",
  "ML" => "Mali",
  "MT" => "Malta",
  "MH" => "Marshall Islands",
  "MQ" => "Martinique",
  "MR" => "Mauritania",
  "MU" => "Mauritius",
  "YT" => "Mayotte",
  "MX" => "Mexico",
  "FM" => "Micronesia, Federated States Of",
  "MD" => "Moldova, Republic Of",
  "MC" => "Monaco",
  "MN" => "Mongolia",
  "MS" => "Montserrat",
  "MA" => "Morocco",
  "MZ" => "Mozambique",
  "MM" => "Myanmar",
  "NA" => "Namibia",
  "NR" => "Nauru",
  "NP" => "Nepal",
  "NL" => "Netherlands",
  "AN" => "Netherlands Antilles",
  "NC" => "New Caledonia",
  "NZ" => "New Zealand",
  "NI" => "Nicaragua",
  "NE" => "Niger",
  "NG" => "Nigeria",
  "NU" => "Niue",
  "NF" => "Norfolk Island",
  "MP" => "Northern Mariana Islands",
  "NO" => "Norway",
  "OM" => "Oman",
  "PK" => "Pakistan",
  "PW" => "Palau",
  "PA" => "Panama",
  "PG" => "Papua New Guinea",
  "PY" => "Paraguay",
  "PE" => "Peru",
  "PH" => "Philippines",
  "PN" => "Pitcairn",
  "PL" => "Poland",
  "PT" => "Portugal",
  "PR" => "Puerto Rico",
  "QA" => "Qatar",
  "RE" => "Reunion",
  "RO" => "Romania",
  "RU" => "Russian Federation",
  "RW" => "Rwanda",
  "KN" => "Saint Kitts And Nevis",
  "LC" => "Saint Lucia",
  "VC" => "Saint Vincent And The Grenadines",
  "WS" => "Samoa",
  "SM" => "San Marino",
  "ST" => "Sao Tome And Principe",
  "SA" => "Saudi Arabia",
  "SN" => "Senegal",
  "SC" => "Seychelles",
  "SL" => "Sierra Leone",
  "SG" => "Singapore",
  "SK" => "Slovakia (Slovak Republic)",
  "SI" => "Slovenia",
  "SB" => "Solomon Islands",
  "SO" => "Somalia",
  "ZA" => "South Africa",
  "GS" => "South Georgia, South Sandwich Islands",
  "ES" => "Spain",
  "LK" => "Sri Lanka",
  "SH" => "St. Helena",
  "PM" => "St. Pierre And Miquelon",
  "SD" => "Sudan",
  "SR" => "Suriname",
  "SJ" => "Svalbard And Jan Mayen Islands",
  "SZ" => "Swaziland",
  "SE" => "Sweden",
  "CH" => "Switzerland",
  "SY" => "Syrian Arab Republic",
  "TW" => "Taiwan",
  "TJ" => "Tajikistan",
  "TZ" => "Tanzania, United Republic Of",
  "TH" => "Thailand",
  "TG" => "Togo",
  "TK" => "Tokelau",
  "TO" => "Tonga",
  "TT" => "Trinidad And Tobago",
  "TN" => "Tunisia",
  "TR" => "Turkey",
  "TM" => "Turkmenistan",
  "TC" => "Turks And Caicos Islands",
  "TV" => "Tuvalu",
  "UG" => "Uganda",
  "UA" => "Ukraine",
  "AE" => "United Arab Emirates",
  "UM" => "United States Minor Outlying Islands",
  "UY" => "Uruguay",
  "UZ" => "Uzbekistan",
  "VU" => "Vanuatu",
  "VE" => "Venezuela",
  "VN" => "Viet Nam",
  "VG" => "Virgin Islands (British)",
  "VI" => "Virgin Islands (U.S.)",
  "WF" => "Wallis And Futuna Islands",
  "EH" => "Western Sahara",
  "YE" => "Yemen",
  "YU" => "Yugoslavia",
  "ZM" => "Zambia",
  "ZW" => "Zimbabwe"
);
	

	//Breadcrumbs Function 
	function breadcrumbs_html(){
		$breadcrumbs = '';						
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$breadcrumbs = find_xml_value($cp_logo->documentElement,'breadcrumbs');
		}
		echo '<section id="" class="content-holder1 inner-pages background_breadcrumbs">';
			 if($breadcrumbs == 'enable'){
			echo '<div class="span12 first" id="breadcrumbs">';
					echo cp_breadcrumbs();
			echo '</div>';
			 }
		echo '</section>';
	 }
	
?>