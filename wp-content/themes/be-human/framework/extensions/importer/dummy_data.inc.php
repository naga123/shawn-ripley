<?php
/** 
     * @author Roy Stone
     * @copyright roshi[www.themeforest.net/user/crunchpress]
     * @version 2013
     */

if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

require_once ABSPATH . 'wp-admin/includes/import.php';

$import_filepath = get_template_directory()."/framework/extensions/importer/dummy_data";
$errors = false;
if ( !class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $class_wp_importer ) )
	{
		require_once($class_wp_importer);
	}
	else
	{
		$errors = true;
	}
}
if ( !class_exists( 'WP_Import' ) ) {
	$wp_importer = CP_FW. '/extensions/importer/wordpress-importer.php';
	if ( file_exists( $wp_importer ) )
	{
		require_once($wp_importer);
	}
	else
	{
		$errors = true;
	}
}

if($errors){
   echo "Errors while loading classes. Please use the standart wordpress importer."; 
}else{
    
    
	include_once('default_dummy_data.inc.php');
	if(!is_file($import_filepath.'_1.xml'))
	{
		echo "Problem with dummy data file. Please check the permisions of the xml file";
	}
	else
	{  
	   if(class_exists( 'WP_Import' )){
	       global $wp_version;
			$our_class = new themeple_dummy_data();
			$our_class->fetch_attachments = true;
			$our_class->import($import_filepath.'_1.xml');
			//$our_class->save_default_widgets();
			
			$widget_newsletter_widget =  array ( 2 => array ( 'title' => 'Subscribe Here', 'show_name' => 'Yes', 'news_letter_des' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', ), '_multiwidget' => 1, );
			$widget_gallery_image_show =   array ( 2 => array ( 'title' => 'Gallery Widget', 'select_gallery' => '187', 'nofimages' => '6', 'externallink' => 'http://www.google.com', ), '_multiwidget' => 1, );
			$widget_twitter_widget =  '';
			$widget_facebook_widget =  array (   3 =>    array (     'title' => 'Fan Us',     'pageurl' => 'http://www.facebook.com/envato',     'showfaces' => 'true',     'showstream' => 'false',     'showheader' => NULL,     'likebox_width' => '300',     'likebox_height' => '250',   ),   4 =>    array (     'title' => 'Fan Us',     'pageurl' => 'http://facebook.com/envato',     'showfaces' => 'true',     'showstream' => 'false',     'showheader' => NULL,     'likebox_width' => '300',     'likebox_height' => '250',   ),   '_multiwidget' => 1, );
			$widget_popular_post =   array ( 2 => array ( 'title' => 'Popular Posts', 'get_cate_posts' => NULL, 'nop' => '3', ), '_multiwidget' => 1, );
			
			
			//Default Widgets
			$widget_search =  array ( 2 => array ( 'title' => 'Search', ), '_multiwidget' => 1, );
			$widget_recent_posts =  array ( 2 => array ( 'title' => 'Recent Posts', 'number' => 5, 'show_date' => true, ), '_multiwidget' => 1, );
			$widget_recent_comments =  array ( '_multiwidget' => 1, );
			$widget_archives =  array ( 2 => array ( 'title' => 'Archives', 'count' => 0, 'dropdown' => 0, ), '_multiwidget' => 1, );
			$widget_meta =  array ( '_multiwidget' => 1, );
			$widget_tag_cloud =  array ( 2 => array ( 'title' => 'Tags', 'taxonomy' => 'post_tag', ), '_multiwidget' => 1, );
			$widget_calendar =  array ( 2 => array ( 'title' => 'Calendar', ), '_multiwidget' => 1, );
			
			if ( $wp_version == 3.6 ) {
				$main_menu	=	array ( 0 => false, 'nav_menu_locations' => array ( 'top-menu' => 29, 'footer-menu' => 30, ), );
			}else{
				$main_menu	=	array ( 0 => false, 'nav_menu_locations' => array ( 'top-menu' => 10, 'footer-menu' => 11, ), );
			}
			
			
			$sidebars_widgets =   array ( 'wp_inactive_widgets' => array ( ), 'sidebar-footer' => array ( 0 => 'popular_post-2', 1 => 'gallery_image_show-2', 2 => 'newsletter_widget-2', 3 => 'twitter_widget-3', ), 'custom-sidebar0' => array ( ), 'custom-sidebar1' => array ( 0 => 'search-2', 1 => 'archives-2', 2 => 'recent-posts-2', 3 => 'calendar-2', 4 => 'tag_cloud-2', ), 'custom-sidebar2' => array ( ), 'custom-sidebar3' => array ( ), 'custom-sidebar4' => array ( ), 'custom-sidebar5' => array ( ), 'custom-sidebar6' => array ( ), 'array_version' => 3, );

			save_option('sidebars_widgets','', $sidebars_widgets);			
			save_option('widget_newsletter_widget',get_option('widget_newsletter_widget'), $widget_newsletter_widget);			
			save_option('widget_gallery_image_show',get_option('widget_gallery_image_show'), $widget_gallery_image_show);
			save_option('widget_twitter_widget',get_option('widget_twitter_widget'), $widget_twitter_widget);
			save_option('widget_facebook_widget',get_option('widget_facebook_widget'), $widget_facebook_widget);
			save_option('widget_popular_post',get_option('widget_popular_post'), $widget_popular_post);

			
			//Default Widgets
			save_option('widget_search',get_option('widget_search'), $widget_search);
			save_option('widget_recent-posts',get_option('widget_recent-posts'), $widget_recent_posts);
			save_option('widget_recent-comments',get_option('widget_recent-comments'), $widget_recent_comments);
			save_option('widget_archives',get_option('widget_archives'), $widget_archives);
			save_option('widget_tag_cloud',get_option('widget_tag_cloud'), $widget_tag_cloud);			
			save_option('widget_calendar',get_option('widget_calendar'), $widget_calendar);
			save_option('show_on_front','', 'page');
			save_option('page_on_front','', '5');			
			save_option('theme_mods_be-human',get_option('theme_mods_be-human'), $main_menu);
		
			//$our_class->save_theme_options($import_filepath);
			//$our_class->set_default_menu();
        }
	}    
}


?>