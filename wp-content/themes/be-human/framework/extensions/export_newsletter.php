<?php
	require_once('../../../../../wp-load.php');
	global $wpdb;
	header( 'Content-Description: File Transfer' );
	header( 'Content-Disposition: attachment; filename=cp_newsletter-'.gmdate("Y-m-d").'.csv');
		$rs = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."cp_newsletter ORDER BY date_time ");
			echo '"Name",';
			echo '"Email",';
			echo '"IP",';
			echo '"Date Time"';
			echo "\n";
				foreach ( $rs as $row ) {
					echo '"' . $row->name . '",';
					echo '"' . $row->email . '",';
					echo '"' . $row->ip . '",';
					echo '"' . $row->date_time . '"';
					echo "\n";
				}
?>