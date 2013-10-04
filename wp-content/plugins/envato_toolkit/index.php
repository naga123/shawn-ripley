<?php
/*

Plugin Name: Envato
Plugin URI: http://themeforest.net
Description: Envato Key
Version: 1.0.0
Author: Envato
Author URI: http://themeforest.net
*/
// Find the XML value from XML Object
	function find_xml_value_plugin($xml, $field){
	
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
// register an action (can be any suitable action)
	add_action('admin_init', 'on_admin_init');

	function on_admin_init()
	{
		// Get Options from theme forest
		$tf_username = '';
		$tf_sec_api = '';
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$tf_username = find_xml_value_plugin($cp_logo->documentElement,'tf_username');
			$tf_sec_api = find_xml_value_plugin($cp_logo->documentElement,'tf_sec_api');
		}
		// include the library
		include_once( 'class-envato-wordpress-theme-upgrader.php' );
		
		
		$upgrader = new Envato_WordPress_Theme_Upgrader( $tf_username, $tf_sec_api );
		
		//$upgrader->check_for_theme_update(); 
		
		//$upgrader->upgrade_theme();
	}
?>