<?php 
	
	/*	
	*	CrunchPress function.php
	*	---------------------------------------------------------------------
	* 	@version	1.0
	*   @ Package   Fine Food Theme
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains all important functions and features of the theme.
	*	---------------------------------------------------------------------
	*/
	add_image_size('Main-Slider', 1160,450, true);	
	add_image_size('Post-Image1', 1170,420, true);
	add_image_size('Post-Image2', 770, 265, true);
	add_image_size('Post-Image3', 570, 300, true);
	add_image_size('Small-Image', 260, 220, true);
	add_image_size('Small-Image1', 300, 110, true);
	add_image_size('Small-Image3', 140, 200, true);
	add_image_size('Small-Image2', 175, 155, true);
	add_image_size('Small-thumb', 60, 60, true);
	
	// constants
	define('THEME_NAME_S','cp');                                   // Short name of theme (used for various purpose in CP framework)
	define('THEME_NAME_F','Be Human');                           // Full name of theme (used for various purpose in CP framework)
	define('CP_PATH_URL', get_template_directory_uri());           // logical location for CP framework
	define('CP_PATH_SER', get_template_directory() );                          // Physical location for CP framework
	define( 'CP_FW_URL', CP_PATH_URL . '/framework' );             // Define URL path of framework directory
	define( 'CP_FW', CP_PATH_SER . '/framework' );                 // Define server path of framework directory                   
	define('AJAX_URL', admin_url( 'admin-ajax.php' ));             // Define admin url
	//define('FONT_SAMPLE_TEXT', 'Font Family'); 				       // Demo font text of the CrunchPress panel
	
	$date_format = get_option(THEME_NAME_S.'_default_date_format','F d, Y');                     // Get default date format
	$widget_date_format = get_option(THEME_NAME_S.'_default_widget_date_format','M d, Y');       // Get default date format for widgets
	define('GDL_DATE_FORMAT', $date_format);
	define('GDL_WIDGET_DATE_FORMAT', $widget_date_format);
 
	$cp_is_responsive = 'enable';
	$cp_is_responsive = ($cp_is_responsive == 'enable')? true: false;
	
	$default_post_sidebar = get_option(THEME_NAME_S.'_default_post_sidebar','post-no-sidebar');   // Get default post sidebar
	$default_post_sidebar = str_replace('post-', '', $default_post_sidebar);               
	$default_post_left_sidebar = get_option(THEME_NAME_S.'_default_post_left_sidebar','');        // Get option for left sidebar
	$default_post_right_sidebar = get_option(THEME_NAME_S.'_default_post_right_sidebar','');      // Get option for right sidebar
	
	if( !function_exists('get_root_directory') ){                                                 // Get file path ( to support child theme )
		function get_root_directory( $path ){
			if( file_exists( get_stylesheet_directory() . '/' . $path ) ){
				return get_stylesheet_directory() . '/';
			}else{
				return get_stylesheet_directory() . '/';
			}
		}
	}
	
	// include essential files to enhance framework functionality
	include_once(CP_FW.	'/script-handler.php');							// It includes all javacript and style in theme
	include_once(CP_FW.	'/extensions/super-object.php'); 				// Super object function
	include_once(CP_FW.	'/cp-functions.php'); 							// Registered CP framework functions
	include_once(CP_FW.	'/cp-option.php');								// CP framework control panel
	include_once(CP_FW.	'/cp_options_typography.php');					// CP Typography control panel
	//include_once(CP_FW.	'/cp_options_home_page.php');					// CP Typography control panel
	include_once(CP_FW.	'/cp_options_slider.php');						// CP Slider control panel
	include_once(CP_FW.	'/cp_options_social.php');						// CP Social Sharing
	include_once(CP_FW.	'/cp_options_sidebar.php');						// CP Sidebar Option Page
	include_once(CP_FW.	'/cp_options_default_pages.php');				// CP Default Options control panel
	include_once(CP_FW.	'/cp_options_newsletter.php');					// CP Newsletter control panel

	include_once(CP_FW.	'/cp_dummy_data_import.php');					// CP Dummy Data control panel
	
	
	include_once(CP_FW.	'/extensions/shortcodes/shortcodes.php'); 		 // Register shortcode
	include_once(CP_FW.	'/extensions/cutom_meta_boxes.php'); 			 // Register meta boxes 
    //include_once(CP_FW. '/extensions/author-bio.php'); 					// Register meta fields page post_type	
	//include_once(CP_FW.	'/extensions/seo_module.php'); 					 // Register seo module
	include_once(CP_FW.	'/extensions/breadcrumbs.php');                  // Register breadcrumbs navigation
	include_once(CP_FW.	'/extensions/loadstyle.php');                  // Register breadcrumbs navigation
	//include_once(CP_FW.	'/extensions/register-menu-walker.php');      // Register breadcrumbs navigation
	//include_once(CP_FW.	'/extensions/mega-menu-pannel.php');      // Register breadcrumbs navigation
	
	
	
	
	
	// dashboard option
	include_once(CP_FW. '/options/meta-template.php'); 					// templates for post portfolio and gallery
	include_once(CP_FW. '/options/post-option.php');					// Register meta fields for post_type
	include_once(CP_FW. '/options/page-option.php'); 					// Register meta fields page post_type	
	//include_once(CP_FW. '/options/testimonial-option.php');				// Register meta fields testimonial post_type
	include_once(CP_FW. '/options/gallery-option.php');					// Gallery Option
	include_once(CP_FW. '/options/slider-option.php');					// Slider Option
	include_once(CP_FW. '/options/events-option.php');					// Event Option
	//include_once(CP_FW. '/options/recipe-option.php');				// Recipe Option
	include_once(CP_FW. '/options/team-option.php');					// Team Option
	include_once(CP_FW. '/options/career-option.php');					// Career Option
	include_once(CP_FW. '/options/product-option.php');					// WooCommerce Elements
	include_once(CP_FW. '/options/ignitiondeck-option.php');			// IgnitionDeck Elements
	
	
	
	
	include_once(CP_FW. '/extensions/widgets/cp_gallery_image_widget.php'); // Custom Gallery Widget
	include_once(CP_FW. '/extensions/widgets/cp_event_countdown_widget.php'); // Custom Countdown Widget
	include_once(CP_FW. '/extensions/widgets/cp_popular_posts_widget.php'); // Custom Popular Posts
	include_once(CP_FW. '/extensions/widgets/cp_facebook_widget.php'); // Custom Facebook Widget
	include_once(CP_FW. '/extensions/widgets/cp_newsletter_widget.php'); // Custom NewsLetter
	include_once(CP_FW. '/extensions/widgets/cp_news_widget.php'); // Custom News Widget
	include_once(CP_FW. '/extensions/widgets/cp_news_widget.php'); // Custom News Widget
	
	include_once(CP_FW. '/extensions/widgets/product_slider_widget.php'); // Custom Event Box Widget	

	include_once(CP_FW. '/extensions/plugins.php'); 				// Custom image size plugin
	include_once(CP_FW. '/extensions/player/mediaelement-js-wp.php'); 			// Register Player
	
	

	if(!is_admin()){
		
		include_once(CP_FW. '/extensions/sliders.php');	                            // Functions to print sliders
		include_once(CP_FW. '/options/page-elements.php');	                        // Organize page item element
		include_once(CP_FW. '/options/blog-elements.php');							// Organize blog item element
	    include_once(CP_FW. '/extensions/comment.php'); 							// function to get list of comment
		include_once(CP_FW. '/extensions/pagination.php'); 							// Register pagination plugin
		include_once(CP_FW. '/extensions/social-shares.php'); 						// Register social shares 
		
	}
	
	// include custom widget
	
	// Custom Function By HAMZA
	add_filter('get_avatar','add_avatar_css');

	function add_avatar_css($class) {
		$class = str_replace("class='avatar", "class='avatar avatar-96 photo team-img margin", $class) ;
		return $class;		
	}

	
	
	//Theme Dummy Data Installation	
	function themeple_ajax_dummy_data(){
		require_once CP_FW . '/extensions/importer/dummy_data.inc.php';
		die('themeple_dummy');
	}
	add_action('wp_ajax_themeple_ajax_dummy_data', 'themeple_ajax_dummy_data');
	
	
	// Ajax to include font infomation
	add_action('wp_ajax_get_cp_font_url','get_cp_font_url');
	function get_cp_font_url(){
	
		global $all_font;
		$recieve_font = $_POST['font'];
		
		if($all_font[$recieve_font]['type'] == "Google Font"){
			
			$font_url = array('type'=>$all_font[$recieve_font]['type'], 'url'=>'http://fonts.googleapis.com/css?family=' . str_replace(' ', '+' , $recieve_font));	
		
		}else{
		
			die(-1);
		
		}
		
		die(json_encode($font_url));
		
	}
	
	
	// Ajax to include font infomation
	add_action('wp_ajax_get_cp_typekit_url','get_cp_typekit_url');
	function get_cp_typekit_url(){
	
		global $all_font;
		$recieve_font = $_POST['font'];
		if($recieve_font <> ''){
			$font_url = array('type'=>'Used Font', 'url'=>'http://use.edgefonts.net/'. str_replace(' ', '+' , $recieve_font).'.js');
		}
		
		die(json_encode($font_url));
		
	}


	add_action( 'wp_enqueue_scripts', 'custom_frontend_scripts' );

	function custom_frontend_scripts() {

		global $post, $woocommerce;

			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			wp_deregister_script( 'jquery-cookie' ); 
			wp_register_script( 'jquery-cookie', CP_PATH_URL . '/frontend/js/jquery_cookie' . $suffix . '.js', array( 'jquery' ), '1.3.1', true );

	}
	
