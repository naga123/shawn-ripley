<?php

	/*
	*	CrunchPress Utility File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains all of the necessary functions for the front-end and
	*	back-end to use. You can see the description of each function below.
	*	---------------------------------------------------------------------
	*/
	require_once('../../../../../wp-load.php');
	global $wpdb;
	if(isset($_POST['newsletter_email'])){
		$_POST['newsletter_email'] = trim( $_POST['newsletter_email'] );
	}
	if(isset($_POST['show_name'])){
		$_POST['show_name'] = trim( $_POST['show_name'] );
	}
	$row = $wpdb->get_row("SELECT * from ".$wpdb->prefix."cp_newsletter where email = '" . $_POST['newsletter_email'] . "'" );

		if ( $_POST['newsletter_email'] == "") {
			echo "Empty Email Field";
		}
		else if ( !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['newsletter_email'] ) ) {
			echo '<div id="email_error">Invalid Email Address</div>';
		}
		else if ( $wpdb->num_rows > 0 ) {
			if ( $row->email == $_POST['newsletter_email'] ) {
			echo '<div id="email_error">This Email Already Exist</div>';
			}
		}
		else {
		
		if($_POST['newsletter_email'] <> ''){
			if($_POST['show_name'] <> 'No'){
			$_POST['newsletter_name'] = trim( $_POST['newsletter_name'] );
				$wpdb->insert( $wpdb->prefix.'cp_newsletter', 
						array( 
							'name' => $_POST['newsletter_name'],
							'email' => $_POST['newsletter_email'],
							'ip' => $_SERVER['REMOTE_ADDR'],
							'date_time' => gmdate("Y-m-d H:i:s")
						)
				);
			}
		}else if($_POST['newsletter_email'] <> ''){
			$wpdb->insert( $wpdb->prefix.'cp_newsletter', 
					array(
						'name' => 'no-name',
						'email' => $_POST['newsletter_email'],
						'ip' => $_SERVER['REMOTE_ADDR'],
						'date_time' => gmdate("Y-m-d H:i:s")
					)
			);
		
		}	
			echo '<div id="newsletter_thanks">Thank you! Your request has been submitted</div>';
		}
	
?>