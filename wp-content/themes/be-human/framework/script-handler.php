<?php

	/*	
	*	CrunchPress Include Script File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	*   @ Package   Fine Food Theme
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file manage to embed the stylesheet and javascript to each page
	*	based on the content of that page.
	*	---------------------------------------------------------------------
	*/
	
	add_action('init', 'register_all_cp_scripts');
	function register_all_cp_scripts(){
	
		if( $GLOBALS['pagenow'] != 'wp-login.php' ){
			if(is_admin()){
				wp_enqueue_style('cp-back-office', CP_PATH_URL.'/framework/stylesheet/cp-backend.css', array('thickbox'));
				add_action('add_meta_boxes', 'register_meta_script');
				
			}else{
				add_action('wp_print_styles','register_non_admin_styles');
				add_action('wp_print_scripts','register_non_admin_scripts');
				
				
				
			}
		}
		
	}
	


	
	/* 	---------------------------------------------------------------------
	*	This section include the back-end script
	*	---------------------------------------------------------------------
	*/ 
	
	function register_meta_script(){
		global $post_type;
		
		wp_enqueue_style('ie-style',CP_PATH_URL . '/stylesheet/ie-style.php?path=' . CP_PATH_URL);

		
		wp_enqueue_style('admin-css',CP_PATH_URL.'/framework/stylesheet/admin-css.css');
		
		// register style and script when access to the "page" post_type page
		if( $post_type == 'page' ){
		
			wp_enqueue_style('meta-css',CP_PATH_URL.'/framework/stylesheet/meta-css.css');
			wp_enqueue_style('page-dragging',CP_PATH_URL.'/framework/stylesheet/page-dragging.css');
			wp_enqueue_style('image-picker',CP_PATH_URL.'/framework/stylesheet/image-picker.css');
			//wp_enqueue_style('bootstrap',CP_PATH_URL.'/framework/stylesheet/bootstrap.css');
			
			wp_register_script('image-picker', CP_PATH_URL.'/framework/javascript/image-picker.js', false, '1.0', true);
			wp_enqueue_script('image-picker');
		
			wp_register_script('page-dragging', CP_PATH_URL.'/framework/javascript/page-dragging.js', false, '1.0', true);
			wp_enqueue_script('page-dragging');
			
			wp_register_script('edit-box', CP_PATH_URL.'/framework/javascript/edit-box.js', false, '1.0', true);
			wp_enqueue_script('edit-box');
			
			wp_register_script('confirm-dialog', CP_PATH_URL.'/framework/javascript/jquery.confirm.js', false, '1.0', true);
			wp_enqueue_script('confirm-dialog');
			
			//wp_register_script('bootstrap', CP_PATH_URL.'/framework/javascript/bootstrap.min.js', false, '1.0', true);
			//wp_enqueue_script('bootstrap');
			
		// register style and script when access to the "post" post_type page
		}else if( $post_type == 'events' || $post_type == 'post' || $post_type == 'cp_slider' || $post_type == 'gallery' || $post_type == 'attraction' ){
		
			wp_enqueue_style('meta-css',CP_PATH_URL.'/framework/stylesheet/meta-css.css');
			wp_enqueue_style('image-picker',CP_PATH_URL.'/framework/stylesheet/image-picker.css');
			wp_enqueue_style('confirm-dialog',CP_PATH_URL.'/framework/stylesheet/jquery.confirm.css');
			
			wp_register_script('post-effects', CP_PATH_URL.'/framework/javascript/post-effects.js', false, '1.0', true);
			wp_enqueue_script('post-effects');
			
			wp_register_script('image-picker', CP_PATH_URL.'/framework/javascript/image-picker.js', false, '1.0', true);
			wp_localize_script( 'image-picker', 'URL', array('crunchpress' => CP_PATH_URL ));
			wp_enqueue_script('image-picker');
			
			wp_register_script('confirm-dialog', CP_PATH_URL.'/framework/javascript/jquery.confirm.js', false, '1.0', true);
			wp_enqueue_script('confirm-dialog');
		
		// register style and script when access to the "testimonial" post_type page		
		}else if( $post_type == 'testimonial' ){
		
			wp_enqueue_style('meta-css',CP_PATH_URL.'/framework/stylesheet/meta-css.css');
		
		}
		if( $post_type == 'event_location' || $post_type == 'attraction_location'){
			wp_register_script('event-loc', CP_PATH_URL.'/framework/javascript/jquery-gmaps-latlon-picker.js', false, '1.0', false);
			wp_enqueue_script('event-loc');			
			
			wp_register_script('event-api-key', 'http://maps.googleapis.com/maps/api/js?sensor=false', false, '1.0', false);
			wp_enqueue_script('event-api-key');						
			
		}
		
	}
	
	
	// register script in CrunchPress panel
	function register_crunchpress_panel_scripts(){
		global $post_type;
		wp_enqueue_style('ie-style',CP_PATH_URL . '/stylesheet/ie-style.php?path=' . CP_PATH_URL);	
	
		if($post_type == 'page'){
		
		}else{
			$cp_script_url = CP_PATH_URL.'/framework/javascript/cp-panel.js';
			wp_enqueue_script('cp_scripts_admin', $cp_script_url, array('jquery','media-upload','thickbox', 'jquery-ui-droppable','jquery-ui-datepicker','jquery-ui-tabs', 'jquery-ui-slider','jquery-timepicker','jquery-ui-position','mini-color','confirm-dialog','dummy_content'));


			wp_register_script('mini-color', CP_PATH_URL.'/framework/javascript/jquery.miniColors.js', false, '1.0', true);
			wp_register_script('confirm-dialog', CP_PATH_URL.'/framework/javascript/jquery.confirm.js', false, '1.0', true);
			wp_register_script('jquery-timepicker', CP_PATH_URL.'/framework/javascript/jquery.ui.timepicker.js', false, '1.0', true);
			wp_register_script('dummy_content', CP_PATH_URL.'/framework/javascript/dummy_content.js', false, '1.0', true);
		}		
	}

	// register style in CrunchPress panel
	function register_crunchpress_panel_styles(){
	
		wp_enqueue_style('jquery-ui',CP_PATH_URL.'/framework/stylesheet/jquery-ui.css');
		wp_enqueue_style('cp-panel',CP_PATH_URL.'/framework/stylesheet/cp-panel.css');
		wp_enqueue_style('mini-color',CP_PATH_URL.'/framework/stylesheet/jquery.miniColors.css');
		wp_enqueue_style('confirm-dialog',CP_PATH_URL.'/framework/stylesheet/jquery.confirm.css');
		wp_enqueue_style('jquery-timepicker',CP_PATH_URL.'/framework/stylesheet/jquery.ui.timepicker.css');
		
	}
	
	/* 	---------------------------------------------------------------------
	*	this section include the front-end script
	*	---------------------------------------------------------------------
	*/ 
	
	// Register all stylesheet

	function register_non_admin_styles(){
	
		$cp_page_xml = '';
		$slider_type = '';
	
		global $post,$post_id,$cp_page_xml,$slider_type;
		
		$cp_page_xml = get_post_meta($post_id,'page-option-item-xml', true);
		$slider_type = get_post_meta ( $post_id, "page-option-top-slider-types", true );
		
		//Default Stylsheet
		wp_enqueue_style( 'default-style', get_stylesheet_uri() ); 
		
		// Include css for shorcodes
		wp_enqueue_style('shortcode',CP_PATH_URL.'/frontend/css/shortcode.css');
		
		//Include Default Widgets and Other settings
		wp_enqueue_style('cp_default',CP_PATH_URL.'/frontend/css/cp_default.css');
		
		wp_enqueue_style('cp_mega_menu',CP_PATH_URL.'/frontend/css/mega_menu.css');
		
		$homepage_newsline_on = '';
		$header_headline = '';
		$section_headline_category = '';
		$homepage_twitter_on = '';
		$header_twitter = '';
		$twitter_id = '';				
		$cp_typography_settings = get_option('homepage_settings');
		if($cp_typography_settings <> ''){
			$cp_typo = new DOMDocument ();
			$cp_typo->loadXML ( $cp_typography_settings );
			$homepage_newsline_on = find_xml_value($cp_typo->documentElement,'homepage_newsline_on');
			$header_headline = find_xml_value($cp_typo->documentElement,'header_headline');
			$section_headline_category = find_xml_value($cp_typo->documentElement,'section_headline_category');
			$homepage_twitter_on = find_xml_value($cp_typo->documentElement,'homepage_twitter_on');
			$header_twitter = find_xml_value($cp_typo->documentElement,'header_twitter');
			$twitter_id = find_xml_value($cp_typo->documentElement,'twitter_id');
		}
		
		if(!is_front_page()){}else{
			if($homepage_twitter_on == 'enable' AND $twitter_id <> ''){
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
			}
			if($homepage_newsline_on == 'enable'){
				wp_enqueue_style('cp-flex-slider',CP_PATH_URL.'/frontend/css/flexslider.css');
			}
		}
		
		
	
		$rtl_layout = '';
		//General Settings Values
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$rtl_layout = find_xml_value($cp_logo->documentElement,'rtl_layout');
		}
		
		//Responsive stylesheet
		wp_enqueue_style('cp-bootstrap',CP_PATH_URL.'/frontend/css/bootstrap.css');
		
		//Retina Display
		wp_enqueue_style('cp-retina',CP_PATH_URL.'/frontend/css/retina.css');
		
		//Font Awesome
		wp_enqueue_style('cp-fontAW',CP_PATH_URL.'/frontend/cp_font/css/font-awesome.css');
		wp_enqueue_style('cp-fontAW',CP_PATH_URL.'/frontend/cp_font/css/font-awesome-ie7.css');
	
		
	
		//RTL Layouts
		if($rtl_layout == 'enable'){
			wp_enqueue_style('cp-rtl',CP_PATH_URL.'/rtl.css');
		}		
	
		//Facebook Fan Page Script
		if(isset($post->ID)){
			$facebook_fan = '';
			$facebook_fan = get_post_meta ( $post->ID, "page-option-item-facebook-selection", true );
			if($facebook_fan == 'Yes'){$facebook_fan = 'mywrapper';
				wp_enqueue_style('style_810',CP_PATH_URL.'/frontend/css/style810.css');
			}
		}	
	
		if( is_search() || is_archive() ){
		
			wp_enqueue_style('cp-anything-slider',CP_PATH_URL.'/frontend/anythingslider/css/anythingslider.css');
	
		
	
		// Post post_type
		}else if( isset($post) && $post->post_type == 'post' || 
			isset($post) && $post->post_type == 'events' ){
		
			// If using slider (flex slider)	
		if(!is_home()){
			$thumbnail_types = '';
			$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
			if($post_detail_xml <> ''){
				$cp_post_xml = new DOMDocument ();
				$cp_post_xml->loadXML ( $post_detail_xml );
				$thumbnail_types = find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
			}
			
			if( $thumbnail_types == 'Slider'){
			
				wp_enqueue_style('cp-anything-slider',CP_PATH_URL.'/frontend/anythingslider/css/anythingslider.css');
				
			}
			
			$event_detail_xml = get_post_meta($post->ID, 'event_detail_xml', true);
			if($event_detail_xml <> ''){
				$cp_event_xml = new DOMDocument ();
				$cp_event_xml->loadXML ( $event_detail_xml );
				$event_thumbnail = find_xml_value($cp_event_xml->documentElement,'event_thumbnail');
				
				//Condition for Slider
				if( $event_thumbnail == 'Slider'){
				
					wp_enqueue_style('cp-anything-slider',CP_PATH_URL.'/frontend/anythingslider/css/anythingslider.css');
					
				}
			}
		}
			
		// Page post_type
		}else if( isset($post) && $post->post_type == 'page' ){
		
			global $post,$cp_page_xml, $slider_type, $cp_top_slider_type;
			$cp_page_xml = get_post_meta($post->ID,'page-option-item-xml', true);
			$cp_top_slider_switch = get_post_meta($post->ID,'page-option-top-slider-on', true);
			$slider_type = get_post_meta ( $post->ID, "page-option-top-slider-types", true );
			$cp_top_slider_type = get_post_meta($post->ID,'page-option-top-slider-types', true);
			
			
			//Layer Slider
			if(strpos($cp_page_xml,'<slider-type>Layer-Slider</slider-type>') > -1 || $slider_type == 'Layer-Slider'){
				wp_enqueue_style('layerslider_js', CP_PATH_URL.'/frontend/css/layerslider.css');
			}
			
			// If using carousel slider
			if(	strpos($cp_page_xml,'<slider-type>Flex-Slider</slider-type>') > -1 || $slider_type == 'Flex-Slider'){
				
				wp_enqueue_style('cp-flex-slider',CP_PATH_URL.'/frontend/css/flexslider.css');
			}
			
			// If using nivo slider
			if( strpos($cp_page_xml,'<slider-type>Flex-Slider</slider-type>') > -1 ||
				$slider_type == 'Flex-Slider' ){
				wp_enqueue_style('cp-flex-slider',CP_PATH_URL.'/frontend/css/flexslider.css');
			}
			
			//Bx Slider Condition
			if(strpos($cp_page_xml,'<slider-type>Bx-Slider</slider-type>') > -1 || $slider_type == 'Bx-Slider' ){
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
			}
			
			// If using Fine slider
			if( strpos($cp_page_xml,'<slider-type>Default-Slider</slider-type>') > -1 ||
				$slider_type == 'Default-Slider' ){
			
				wp_enqueue_style('Default-Slider',CP_PATH_URL.'/frontend/css/slider.css');
				
			}				
			if( strpos($cp_page_xml, '<slider-type>Anything</slider-type>') > -1){
				wp_enqueue_style('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/css/anythingslider.css');
				
			}
			if($slider_type == 'Anything' AND $cp_top_slider_switch == 'Yes'){
				wp_enqueue_style('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/css/anythingslider.css');
			}
			
			if( strpos($cp_page_xml,'<eventview>Calendar View</eventview>') > -1 ){
		
				wp_enqueue_style('cp-calender-view', CP_PATH_URL.'/framework/javascript/fullcalendar/fullcalendar.css');
			
			}
			// If using filterable plugin
			if( strpos($cp_page_xml,'<show-filterable>') > -1 ){
			
				wp_enqueue_style('cp-style-view', CP_PATH_URL.'/frontend/css/style_animate.css');
			
			}
			
			// If using Services
			if( strpos($cp_page_xml,'<service-widget-style>Circle-Icon</service-widget-style>') > -1 ){
			
				wp_enqueue_style('circle-hover',CP_PATH_URL.'/frontend/css/circle-hover.css');
			
			}
			
			// If using NewsSlider
			if( strpos($cp_page_xml,'<News-Slider>') > -1 ){
			
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
			
			}
			
			// If using Services
			if( strpos($cp_page_xml,'<service-widget-style>Box-Style3</service-widget-style>') > -1 ){
			
				wp_enqueue_style('cp-services-view', CP_PATH_URL.'/frontend/css/style_css_services.css');
			
			}
			
		}
		
		$font_google = '';
		$font_size_normal = '';
		$menu_font_google = '';
		$fonts_array = '';
		$font_google_heading = '';
		$heading_h1 = '';
		$heading_h2 = '';
		$heading_h3 = '';
		$heading_h4 = '';
		$heading_h5 = '';
		$heading_h6 = '';
		$embed_typekit_code = '';
		$cp_typography_settings = get_option('typography_settings');
		
		//$dd = find_xml_node($logo_uploa_d,'logo_upload');
		if($cp_typography_settings <> ''){
			$cp_typo = new DOMDocument ();
			$cp_typo->loadXML ( $cp_typography_settings );
			$font_google = find_xml_value($cp_typo->documentElement,'font_google');
			$font_size_normal = find_xml_value($cp_typo->documentElement,'font_size_normal');
			$menu_font_google = find_xml_value($cp_typo->documentElement,'menu_font_google');
			$font_google_heading = find_xml_value($cp_typo->documentElement,'font_google_heading');
			$heading_h1 = find_xml_value($cp_typo->documentElement,'heading_h1');
			$heading_h2 = find_xml_value($cp_typo->documentElement,'heading_h2');
			$heading_h3 = find_xml_value($cp_typo->documentElement,'heading_h3');
			$heading_h4 = find_xml_value($cp_typo->documentElement,'heading_h4');
			$heading_h5 = find_xml_value($cp_typo->documentElement,'heading_h5');
			$heading_h6 = find_xml_value($cp_typo->documentElement,'heading_h6');
			$embed_typekit_code = find_xml_value($cp_typo->documentElement,'embed_typekit_code');
			
		}
		
		//Body Font Installing
		if(verify_google_f($font_google) == 'type_kit'){
			//Adobe Edge Font (TypeKit) 
			if($font_google <> ''){
				wp_register_script( 'adobe-edge-font', "http://use.edgefonts.net/".$font_google.".js", false, '1.0', false);
				wp_enqueue_script('adobe-edge-font');	
			}
		}else if(verify_google_f($font_google) == 'google_font'){
			//Google Font Body
			if($font_google <> ''){
				$font_google = str_replace(' ','+',$font_google);
				wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family='.$font_google.'');
			}	
		}
		//verify_google_para($font_google_heading);
		//Heading Font Installing
		if(verify_google_para($font_google_heading) == 'type_kit'){
			if($font_google_heading <> ''){
				wp_register_script( 'adobe-edge-heading', "http://use.edgefonts.net/".$font_google_heading.".js", false, '1.0', false);
				wp_enqueue_script('adobe-edge-heading');	
			}
		}else if(verify_google_para($font_google_heading) == 'google_font'){
			if($font_google_heading <> ''){
				$font_google_heading = str_replace(' ','+',$font_google_heading);
				wp_enqueue_style('googleFonts-heading', 'http://fonts.googleapis.com/css?family='.$font_google_heading.'' );
			}
		}

		//Menu Font Installing
		//verify_google_menu($menu_font_google);
		if(verify_google_menu($menu_font_google) == 'type_kit'){
			if($menu_font_google <> ''){
				wp_register_script( 'menu-edge-heading', "http://use.edgefonts.net/".$menu_font_google.".js", false, '1.0', false);
				wp_enqueue_script('menu-edge-heading');	
			}
		}else if(verify_google_menu($menu_font_google) == 'google_font'){
			if($menu_font_google <> ''){
				$menu_font_google = str_replace(' ','+',$menu_font_google);
				wp_enqueue_style('menu-googleFonts-heading', 'http://fonts.googleapis.com/css?family='.$menu_font_google.'' );
			}
		}
		
	}
		 
        // Register all scripts
	function register_non_admin_scripts(){
		global $post,$post_id;
		global $cp_is_responsive;
		global $crunchpress_element;		
		global $wp_scripts;
		$cp_page_xml = get_post_meta($post_id,'page-option-item-xml', true);
		$slider_type = get_post_meta ( $post_id, "page-option-top-slider-types", true );

		$social_networking = '';
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$social_networking = find_xml_value($cp_logo->documentElement,'social_networking');
		}
		
		wp_enqueue_script('jquery');
		
		if ( is_singular() && get_option( 'thread_comments' ) ) 	wp_enqueue_script( 'comment-reply' );
			
		//BootStrap Script Loaded
		wp_register_script('cp-bootstrap', CP_PATH_URL.'/frontend/js/bootstrap.js', array('jquery'), '1.0', true);
		wp_enqueue_script('cp-bootstrap');
		
		//Custom Script Loaded
		wp_register_script('cp-scripts', CP_PATH_URL.'/frontend/js/frontend_scripts.js', false, '1.0', true);
		wp_enqueue_script('cp-scripts');
		
		wp_register_script('add-to-cart-variation', CP_PATH_URL.'/frontend/js/add-to-cart-variation.js', false, '1.0', true);
		wp_enqueue_script('add-to-cart-variation');
		
		
		wp_deregister_script('wc-add-to-cart');
		wp_register_script('wc-add-to-cart', CP_PATH_URL.'/frontend/js/add-to-cart.js', false, '1.0', true);
		wp_enqueue_script('wc-add-to-cart');
		
		
		wp_register_script('cp-eqh', CP_PATH_URL.'/frontend/js/eqh.js', false, '1.0', true);
		wp_enqueue_script('cp-eqh');
		

		global $wp_scripts,$post;
		wp_register_script('html5shiv',CP_PATH_URL.'/frontend/js/html5shive.js',array(),'1.5.1',false);
		wp_enqueue_script('html5shiv');
		$wp_scripts->add_data( 'html5shiv', 'conditional', 'lt IE 9' );
		
		if($social_networking == 'enable'){
			wp_register_script('cp-social_scripts', CP_PATH_URL.'/frontend/js/social_slider_script.js', false, '1.0', true);
			wp_enqueue_script('cp-social_scripts');
			
			wp_register_script('cp-social_slider_main', CP_PATH_URL.'/frontend/js/social_slider_main.js', false, '1.0', true);
			wp_enqueue_script('cp-social_slider_main');
		}
			
		
		// Search and archive page
		if( is_search() || is_archive() ){
		
			wp_register_script('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.js', false, '1.0', true);
			wp_enqueue_script('cp-anything-slider');	
		
		// Post post_type
		}else if( isset($post) &&  $post->post_type == 'post' && !is_home() || 
			isset($post) &&  $post->post_type == 'events' && !is_home() ){
		
			if(!is_home()){
				$cp_post_thumbnail = '';
				$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
				if($post_detail_xml <> ''){
					$cp_post_xml = new DOMDocument ();
					$cp_post_xml->loadXML ( $post_detail_xml );
					$cp_post_thumbnail = find_xml_value($cp_post_xml->documentElement,'post_thumbnail');						

					if( $cp_post_thumbnail == 'Slider'){

						wp_register_script('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.js', false, '1.0', true);
						wp_enqueue_script('cp-anything-slider');
						
						wp_register_script('cp-anything-slider-fx', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.fx.js', false, '1.0', true);
						wp_enqueue_script('cp-anything-slider-fx');
						
					}
				}
			
				$event_detail_xml = get_post_meta($post->ID, 'event_detail_xml', true);
				if($event_detail_xml <> ''){
					$cp_event_xml = new DOMDocument ();
					$cp_event_xml->loadXML ( $event_detail_xml );
					$event_thumbnail = find_xml_value($cp_event_xml->documentElement,'event_thumbnail');
					
					if( $event_thumbnail == 'Slider'){

						wp_register_script('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.js', false, '1.0', true);
						wp_enqueue_script('cp-anything-slider');
						
					}
				}
			}
		
		// Page post_type
		}else if( isset($post) &&  $post->post_type == 'page' ){
			global $post,$cp_page_xml, $slider_type, $cp_top_slider_type;
			$cp_page_xml = get_post_meta($post->ID,'page-option-item-xml', true);
			$cp_top_slider_switch = get_post_meta($post->ID,'page-option-top-slider-on', true);
			$slider_type = get_post_meta ( $post->ID, "page-option-top-slider-types", true );
			$cp_top_slider_type = get_post_meta($post->ID,'page-option-top-slider-types', true);
			
			// if using Accordicns
			if( strpos($cp_page_xml,'<Accordion>') > -1 ){
				wp_enqueue_script('jquery-ui-accordion');
				wp_register_script('cp-accordian-script', CP_PATH_URL.'/frontend/js/accordian_script.js', false, '1.0', true);
				wp_enqueue_script('cp-accordian-script');
				
			}
			// if using tabs
			if( strpos($cp_page_xml,'<Tab>') > -1 ){
			    //wp_enqueue_script('jquery-ui-accordion');
				wp_enqueue_script('jquery-ui-tabs');
				wp_register_script('cp-tabs-script', CP_PATH_URL.'/frontend/js/tabs_script.js', false, '1.0', true);
				wp_enqueue_script('cp-tabs-script');
				
			}
			
			// If using Flex Slider
			if( strpos($cp_page_xml,'<slider-type>Flex-Slider</slider-type>') > -1 || $slider_type == 'Flex-Slider' AND $cp_top_slider_switch == 'Yes'){				
				wp_register_script('cp-flex-slider', CP_PATH_URL.'/frontend/js/jquery.flexslider.js', false, '1.0', true);
				wp_enqueue_script('cp-flex-slider');
			}
			
			//Layer Slider Scripts
			if(strpos($cp_page_xml,'<slider-type>Layer-Slider</slider-type>') > -1 || $slider_type == 'Layer-Slider' AND $cp_top_slider_switch == 'Yes'){
				wp_enqueue_script('layerslider_js', CP_PATH_URL.'/frontend/js/layerslider/layerslider.kreaturamedia.jquery.js', false, '1.0', true);
				wp_enqueue_script('jquery_easing', CP_PATH_URL.'/frontend/js/layerslider/jquery-easing-1.3.js', false, '1.0', true);
				wp_enqueue_script('transitions', CP_PATH_URL.'/frontend/js/layerslider/layerslider.transitions.js', false, '1.0', true);
				wp_enqueue_script('jquerytransit', CP_PATH_URL.'/frontend/js/layerslider/jquerytransit.js', false, '1.0', true);
			}
			
			//Bx Slider Scripts
			if(strpos($cp_page_xml,'<slider-type>Bx-Slider</slider-type>') > -1){
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');		

				wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/js/jquery.fitvids.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-fitdiv');
			}
			
			//Bx Slider Scripts
			if($slider_type == 'Bx-Slider' AND $cp_top_slider_switch == 'Yes'){
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');		

				wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/js/jquery.fitvids.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-fitdiv');
			}
			
			// If using Default slider
			if( strpos($cp_page_xml,'<slider-type>Default-Slider</slider-type>') > -1 ||
				$slider_type == 'Default-Slider' ){
				wp_register_script('cp-Default-Slider', CP_PATH_URL.'/frontend/js/slider.js', false, '1.0', true);
				wp_enqueue_script('cp-Default-Slider');
				
			}
			
			// ifcp_top_slider_switch = get_post_meta($post->ID,'page-option-top-slider-on', true); using Accordicns
			if( strpos($cp_page_xml,'<Accordion>') > -1 ){
				wp_enqueue_script('jquery-ui-accordion');
				wp_register_script('cp-accordian-script', CP_PATH_URL.'/frontend/js/accordian_script.js', false, '1.0', true);
				wp_enqueue_script('cp-accordian-script');
			}
			
			// If using Anything Slider
			if( strpos($cp_page_xml, '<slider-type>Anything</slider-type>') == 233 || $slider_type == 'Anything' AND $cp_top_slider_switch == 'Yes'){
				wp_register_script('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.js', false, '1.0', true);
				wp_enqueue_script('cp-anything-slider');	
				
				wp_register_script('cp-anything-slider-fx', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.fx.js', false, '1.0', true);
				wp_enqueue_script('cp-anything-slider-fx');	
			}
			
			// If using NewsSlider
			if( strpos($cp_page_xml,'<News-Slider>') > -1 ){
			
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');		
				
				wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/js/jquery.fitvids.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-fitdiv');		
				
			
			}
			
			
			// If using filterable plugin
			if( strpos($cp_page_xml,'<show-filterable>Yes</show-filterable>') > -1 ){
			
				wp_register_script('filterable', CP_PATH_URL.'/frontend/js/jquery-filterable.js', false, '1.0', true);
				wp_enqueue_script('filterable');
			
			}
			
			// If using filterable plugin
			if( strpos($cp_page_xml,'<filterable>Yes</filterable>') > -1 ){
			
				wp_register_script('filterable', CP_PATH_URL.'/frontend/js/jquery-filterable.js', false, '1.0', true);
				wp_enqueue_script('filterable');
				
				wp_register_script('jquery-easing-1.3', CP_PATH_URL.'/frontend/js/jquery-easing-1.3.js', false, '1.0', true);
				wp_enqueue_script('jquery-easing-1.3');
			
			}
			
			if( strpos($cp_page_xml,'<eventview>Calendar View</eventview>') > -1 ){
			
				wp_register_script('cp-calender-view', CP_PATH_URL.'/framework/javascript/fullcalendar/fullcalendar.js', false, '1.0', true);
				wp_enqueue_script('cp-calender-view');
			
			}
			
		}
	}

?>