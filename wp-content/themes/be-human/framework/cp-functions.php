<?php

	/*	
	*	Crunchpress Function Registered File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Crunchpress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) Crunchpress
	*	---------------------------------------------------------------------
	*	This file use to register the wordpress function to the framework,
	*	and also use filter to hook some necessary events.
	*	---------------------------------------------------------------------
	*/
	
	if (function_exists('register_sidebar')){	
	
		// default sidebar array
		$sidebar_attr = array(
			'name' => '',
			'description' => '',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		);

			
		$footer_col_layout = '';
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$footer_col_layout = find_xml_value($cp_logo->documentElement,'footer_col_layout');
		}
		$sidebar_id = 0;
		//Home Page Layout		
		if($footer_col_layout == 'home_4_col'){
			$cp_sidebar = array("Footer");
			$sidebar_attr['before_title'] = '<h4>';
			foreach( $cp_sidebar as $sidebar_name ){
				$sidebar_attr['name'] = $sidebar_name;
				$sidebar_slug = strtolower(str_replace(' ','-',$sidebar_name));
				$sidebar_attr['id'] = 'sidebar-' . $sidebar_slug ;
				$sidebar_attr['before_widget'] = '<div class="span3 widget %2$s">' ;
				$sidebar_attr['before_title'] = '<h4>' ;
				$sidebar_attr['after_title'] = '<span class="h-line"></span></h4>' ;
				$sidebar_attr['description'] = 'Please place widget here' ;
				register_sidebar($sidebar_attr);
			}
		}else{$cp_sidebar = array("Footer");
			$sidebar_attr['before_title'] = '<h4>';
			foreach( $cp_sidebar as $sidebar_name ){
				$sidebar_attr['name'] = $sidebar_name;
				$sidebar_slug = strtolower(str_replace(' ','-',$sidebar_name));
				$sidebar_attr['id'] = 'sidebar-' . $sidebar_slug ;
				$sidebar_attr['before_widget'] = '<div class="span4 %2$s">' ;
				$sidebar_attr['before_title'] = '<h4>' ;
				$sidebar_attr['after_title'] = '<span class="h-line"></span></h4>' ;
				$sidebar_attr['description'] = 'Please place widget here' ;
				register_sidebar($sidebar_attr);
			}
		}		
		
		//Footer Layout
		//$cp_sidebar_footer = array("Footer");
		
		//$sidebar_attr['before_title'] = '<h2 class="custom-sidebar-title footer-title-color cp-title">';
		// foreach( $cp_sidebar_footer as $sidebar_name ){
			// $sidebar_attr['name'] = $sidebar_name;
			// $sidebar_slug = strtolower(str_replace(' ','-',$sidebar_name));
			// $sidebar_attr['id'] = 'sidebar-' . $sidebar_slug ;
			// $sidebar_attr['before_widget'] = '<div class="span4 %2$s">' ;
			// $sidebar_attr['before_title'] = '<h4>' ;
			// $sidebar_attr['after_title'] = '<span class="h-line"></span></h4>' ;
			// $sidebar_attr['description'] = 'Please place widget here' ;
			// register_sidebar($sidebar_attr);
		// }
		$cp_sidebar = '';
		$cp_sidebar = get_option('sidebar_settings');
		//$sidebar_attr['before_title'] = '<h3>';
		
		if(!empty($cp_sidebar)){
			$xml = new DOMDocument();
			$xml->loadXML($cp_sidebar);
			foreach( $xml->documentElement->childNodes as $sidebar_name ){
				$sidebar_attr['name'] = $sidebar_name->nodeValue;
				$sidebar_attr['id'] = 'custom-sidebar' . $sidebar_id++ ;
				$sidebar_attr['before_widget'] = '<div class="widget %2$s">' ;
				$sidebar_attr['before_title'] = '<h3>' ;
				$sidebar_attr['after_title'] = '</h3>' ;
				register_sidebar($sidebar_attr);
			}
		}
		
	}
	
	// enable featured image
	if(function_exists('add_theme_support')){
		add_theme_support('post-thumbnails');
	}
	
	// enable editor style
	add_editor_style('custom-editor-style.css');
	
	// enable navigation menu
	if(function_exists('add_theme_support')){
		add_theme_support('menus');
		register_nav_menus(array('top-menu' => 'Main Menu','footer-menu'=>'Footer Menu'));
	}
	
	// add filter to hook when user press "insert into post" to include the attachment id
	add_filter('media_send_to_editor', 'add_para_media_to_editor', 20, 2);
	function add_para_media_to_editor($html, $id){

		if(strpos($html, 'href')){
			$pos = strpos($html, '<a') + 2;
			$html = substr($html, 0, $pos) . ' attid="' . $id . '" ' . substr($html, $pos);
		}
		
		return $html ;
		
	}
	
	// enable theme to support the localization
	add_action('init', 'cp_word_translation');
	function cp_word_translation(){
		load_theme_textdomain( 'crunchpress', get_template_directory() . '/languages/' );
		load_theme_textdomain( 'cp_front_end', get_template_directory() . '/languages/' );
	}

	// excerpt filter
	add_filter('excerpt_length','cp_excerpt_length');
	function cp_excerpt_length(){
		return 1000;
	}
	


	add_action('wp_footer', 'add_google_analytics_code');
	// Google Analytics
	function add_google_analytics_code(){
		$google_webmaster_code = '';
		//Get Options
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$google_webmaster_code = find_xml_value($cp_logo->documentElement,'google_webmaster_code');
			}
		echo $google_webmaster_code;
	
	}
	
	add_action('wp_footer', 'add_typekit_code');
	// Google Analytics
	function add_typekit_code(){
		$embed_typekit_code = '';
		$cp_typography_settings = get_option('typography_settings');
		if($cp_typography_settings <> ''){
			$cp_typo = new DOMDocument ();
			$cp_typo->loadXML ( $cp_typography_settings );
			$embed_typekit_code = find_xml_value($cp_typo->documentElement,'embed_typekit_code');
		}
		echo $embed_typekit_code;
	
	}
	
	// Custom Post type Feed
	add_filter('request', 'myfeed_request');
	function myfeed_request($qv) {
		if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'portfolio');
		return $qv;
	}

	// Translate the wpml shortcode
	function webtreats_lang_test( $atts, $content = null ) {
		extract(shortcode_atts(array( 'lang' => '' ), $atts));
		
		$lang_active = ICL_LANGUAGE_CODE;
		
		if($lang == $lang_active){
			return $content;
		}
	}
	
	
	
	// Add Another theme support
	add_filter('widget_text', 'do_shortcode');
	add_theme_support( 'automatic-feed-links' );	
	
	if ( ! isset( $content_width ) ){ $content_width = 980; }
	
	// update the option if new value is exists and not equal to old one 
		function save_option($name, $old_value, $new_value){
		
			if(empty($new_value) && !empty($old_value)){
			
				if(!delete_option($name)){
				
					return false;
					
				}
				
			}else if($old_value != $new_value){
			
				if(!update_option($name, $new_value)){
				
					return false;
					
				}
				
			}
			
			return true;
			
		}
	
	
	//Add Newsletter Table
	function add_newsletter_table() {
		global $wpdb;
		$wpdb->query("
			CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."cp_newsletter` (
			  `name` varchar(100) NOT NULL,
			  `email` varchar(100) NOT NULL,
			  `ip` varchar(16) NOT NULL,
			  `date_time` datetime NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		");
	}
	
	
	/* Flush rewrite rules for custom post types. */
		global $pagenow, $wp_rewrite;
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ){
			//$wp_rewrite->flush_rules();
			add_action('init', 'add_newsletter_table');	
			//add_action('init', 'layerslider_create_db_table');	
			
			
			
		//Default Page Settings	
		if(get_option('default_pages_settings') == ''){
			$default_pages_xml = '<default_pages_settings>';
			$default_pages_xml = $default_pages_xml . create_xml_tag('sidebar_default','right-sidebar');
			$default_pages_xml = $default_pages_xml . create_xml_tag('right_sidebar_default','Sidebar');
			$default_pages_xml = $default_pages_xml . create_xml_tag('left_sidebar_default','Sidebar');
			$default_pages_xml = $default_pages_xml . create_xml_tag('default_excerpt','250');
			$default_pages_xml = $default_pages_xml . '</default_pages_settings>';

			save_option('default_pages_settings', get_option('default_pages_settings'), $default_pages_xml);
		}
		
		//Sidebar Settings
		if(get_option('sidebar_settings') == '<sidebar_settings></sidebar_settings>' || get_option('sidebar_settings') == ''){
			
			$sidebars = array('0'=>'Event Sidebar','1'=>'Sidebar','2'=>'Contact Us','3'=>'Shortcodes','4'=>'Sidebar Right','5'=>'Sidebar Left','6'=>'Home Sidebar');
			$sidebar_xml = '<sidebar_settings>';
			foreach($sidebars as $keys=>$values){
				$sidebar_xml = $sidebar_xml . create_xml_tag('sidebar_name',$values);
			}
			$sidebar_xml = $sidebar_xml . '</sidebar_settings>';
			save_option('sidebar_settings', get_option('sidebar_settings'), $sidebar_xml);
			
		}		

		//Slider Settings
		if(get_option('slider_settings') == ''){
			$slider_settings_xml = '<slider_settings>';
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('select_slider','');
			$slider_settings_xml = $slider_settings_xml . '<flex_slider_settings>';
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('animation_type_flex','fade');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('reverse_order_flex','true');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('startat_flex_slider','0');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('auto_play_flex','enable');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('animation_speed_flex','500');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('pause_on_flex','enable');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('navigation_on_flex','disable');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('arrow_on_flex','enable');
			$slider_settings_xml = $slider_settings_xml . '</flex_slider_settings>';
			
			$slider_settings_xml = $slider_settings_xml . '<anything_slider_settings>';
			//$slider_settings_xml = $slider_settings_xml . create_xml_tag('slide_mod_anything','fade');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('auto_play_anything','enable');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('pause_on_anything','enable');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('animation_speed_anything','500');
			$slider_settings_xml = $slider_settings_xml . '</anything_slider_settings>';
			
			$slider_settings_xml = $slider_settings_xml . '<bx_slider_settings>';
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('slide_order_bx','fade');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('auto_play_bx','enable');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('pause_on_bx','disable');
			$slider_settings_xml = $slider_settings_xml . create_xml_tag('animation_speed_bx','500');
			$slider_settings_xml = $slider_settings_xml . '</bx_slider_settings>';
			$slider_settings_xml = $slider_settings_xml . '</slider_settings>';
			save_option('slider_settings', get_option('slider_settings'), $slider_settings_xml);
		}
	
		//Typography Settings
		if(get_option('typography_settings') == ''){
			$typography_xml = '<typography_settings>';
			$typography_xml = $typography_xml . create_xml_tag('font_google','');
			$typography_xml = $typography_xml . create_xml_tag('font_size_normal','');
			$typography_xml = $typography_xml . create_xml_tag('font_google_heading','');
			$typography_xml = $typography_xml . create_xml_tag('menu_font_google','');
			$typography_xml = $typography_xml . create_xml_tag('heading_h1','');
			$typography_xml = $typography_xml . create_xml_tag('heading_h2','');
			$typography_xml = $typography_xml . create_xml_tag('heading_h3','');
			$typography_xml = $typography_xml . create_xml_tag('heading_h4','');
			$typography_xml = $typography_xml . create_xml_tag('heading_h5','');
			$typography_xml = $typography_xml . create_xml_tag('heading_h6','');
			$typography_xml = $typography_xml . create_xml_tag('embed_typekit_code',htmlspecialchars(stripslashes('')));
			$typography_xml = $typography_xml . '</typography_settings>';
			save_option('typography_settings', get_option('typography_settings'), $typography_xml);
		}	
		
		//General Settings
		if(get_option('general_settings') == ''){
			$general_logo_xml = '<general_settings>';
			$general_logo_xml = $general_logo_xml . create_xml_tag('header_logo',htmlspecialchars(stripslashes('4')));
			$general_logo_xml = $general_logo_xml . create_xml_tag('logo_width','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('logo_height','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('select_layout_cp','full_layout');
			$general_logo_xml = $general_logo_xml . create_xml_tag('boxed_scheme','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('select_bg_pat','Background-Patren');
			$general_logo_xml = $general_logo_xml . create_xml_tag('color_scheme','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('color_anchor','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('bg_scheme','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('body_patren','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('color_patren','/framework/images/pattern/pattern-45.png');
			$general_logo_xml = $general_logo_xml . create_xml_tag('body_image','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('position_image_layout','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('image_repeat_layout','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('image_attachment_layout','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('header_css_code',htmlspecialchars(stripslashes('')));
			$general_logo_xml = $general_logo_xml . create_xml_tag('google_webmaster_code',htmlspecialchars(stripslashes('')));
			$general_logo_xml = $general_logo_xml . create_xml_tag('phone_contact_header','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('social_network_header','enable');
			$general_logo_xml = $general_logo_xml . create_xml_tag('countd_event_category',179);
			$general_logo_xml = $general_logo_xml . create_xml_tag('copyright_code',htmlspecialchars(stripslashes('Copyright © 2013 Be Human. Designed by CrunchPress.com')));
			$general_logo_xml = $general_logo_xml . create_xml_tag('social_networking','enable');
			$general_logo_xml = $general_logo_xml . create_xml_tag('footer_banner',htmlspecialchars(stripslashes('<div class="inner"> 
											<div class="span9">
											<h2> Free shipping on all orders over $75 </h2>
											<h3> * FREE OVER $125 for international orders </h3>
											</div>
											<div class="pull-left span3">
											<div id="banner_rounded" class="img-circle">
											<h3>	DELIVERED TO YOUR DOOR IN <span> 3 days </span> </h3> </div>
											</div>
										</div>')));	
			$general_logo_xml = $general_logo_xml . create_xml_tag('footer_col_layout','home_4_col');	
			$general_logo_xml = $general_logo_xml . create_xml_tag('phone_contact',htmlspecialchars(stripslashes('<i class="icon-mobile-phone"></i> <span> +00 71 900 34 45 </span> <i class="icon-envelope-alt"></i> <span> contact@companyname.com  </span>')));				
			$general_logo_xml = $general_logo_xml . create_xml_tag('consumer_key','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('consumer_secret','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('user_token','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('user_secret','');
			$general_logo_xml = $general_logo_xml . create_xml_tag('twitter_id',htmlspecialchars(stripslashes('')));
			$general_logo_xml = $general_logo_xml . create_xml_tag('breadcrumbs','enable');	
			$general_logo_xml = $general_logo_xml . create_xml_tag('rtl_layout','disable');
			$general_logo_xml = $general_logo_xml . create_xml_tag('tf_username','');	
			$general_logo_xml = $general_logo_xml . create_xml_tag('tf_sec_api','');		
			$general_logo_xml = $general_logo_xml . '</general_settings>';
			save_option('general_settings',get_option('general_settings'), $general_logo_xml);
		}		
		
		//Social Sharing Settings
		if(get_option('social_settings') == ''){
			$social_xml = '<social_settings>';
			$social_xml = $social_xml . create_xml_tag('facebook_network','http://www.facebook.com');
			$social_xml = $social_xml . create_xml_tag('twitter_network','http://www.twiiter.com');
			$social_xml = $social_xml . create_xml_tag('delicious_network','http://www.delicious.com');
			$social_xml = $social_xml . create_xml_tag('google_plus_network','http://www.googleplus.com');
			$social_xml = $social_xml . create_xml_tag('linked_in_network','http://www.linkedin.com');
			$social_xml = $social_xml . create_xml_tag('youtube_network','http://www.youtube.com');
			$social_xml = $social_xml . create_xml_tag('flickr_network','http://www.flickr.com');
			$social_xml = $social_xml . create_xml_tag('vimeo_network','http://www.vimeo.com');
			$social_xml = $social_xml . create_xml_tag('pinterest_network','http://www.pinterest.com');
			
			//Social Sharing
			$social_xml = $social_xml . create_xml_tag('facebook_sharing','enable');
			$social_xml = $social_xml . create_xml_tag('twitter_sharing','enable');
			$social_xml = $social_xml . create_xml_tag('stumble_sharing','enable');
			$social_xml = $social_xml . create_xml_tag('delicious_sharing','enable');
			$social_xml = $social_xml . create_xml_tag('googleplus_sharing','enable');
			$social_xml = $social_xml . create_xml_tag('digg_sharing','enable');
			$social_xml = $social_xml . create_xml_tag('myspace_sharing','enable');
			$social_xml = $social_xml . create_xml_tag('reddit_sharing','enable');
			$social_xml = $social_xml . '</social_settings>';
			save_option('social_settings',get_option('social_settings'), $social_xml);
		}
		
		
	}

		//Custom background Support	
		$args = array(
			'default-color'          => '',
			'default-image'          => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		);

		//Custom Header Support	
		$defaults = array(
			'default-image'          => '',
			'random-default'         => false,
			'width'                  => 950,
			'height'                 => 200,
			'flex-height'            => false,
			'flex-width'             => false,
			'default-text-color'     => '',
			'header-text'            => true,
			'uploads'                => true,
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		global $wp_version;
		if ( version_compare( $wp_version, '3.4', '>=' ) ){ 
			add_theme_support( 'custom-background', $args );
			add_theme_support( 'custom-header', $defaults );
		}
	
?>
