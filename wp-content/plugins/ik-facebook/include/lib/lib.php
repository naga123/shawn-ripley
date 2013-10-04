<?php
	function is_valid_key($key){
		//check if social pro installed and activated
		$plugin = "ik-facebook-pro/ik_facebook_pro.php";
		
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		
		if(is_plugin_active($plugin)){
			return true;
		}
		
		return false;
	}
?>