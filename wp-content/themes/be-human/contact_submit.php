<?php
require_once('../../../wp-load.php');
//$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
//get_template_part( ABSPATH.'/wp', 'load' );

foreach ($_REQUEST as $keys=>$values) {
	$$keys = $values;
}
if(isset($form_submitted) AND $form_submitted == 'form_submitted'){
	$subject = "Contact Form Received";
	$message = '
		<table width="100%" border="1">
		  <tr>
			<td width="100"><strong>Name:</strong></td>
			<td>'.$name_contact.'</td>
		  </tr>
		  <tr>
			<td><strong>Email:</strong></td>
			<td>'.$email_contact.'</td>
		  </tr>
		  <tr>
			<td><strong>Message:</strong></td>
			<td>'.$message_comment.'</td>
		  </tr>
		  <tr>
			<td><strong>IP Address:</strong></td>
			<td>'.$_SERVER["REMOTE_ADDR"].'</td>
		  </tr>
		</table>
		';
	$headers = "From: " . $name_contact . "\r\n";
	$headers .= "Reply-To: " . $email_contact . "\r\n";
	$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
	$headers .= "MIME-Version: 1.0" . "\r\n";
	$attachments = '';
	if($name_contact <> '' AND is_email($email_contact)){
		wp_mail( $receiver, $subject, $message, $headers, $attachments );
		echo '<div class="message-box-wrapper green">';
		echo $successful_msg_contact;
		echo '</div>';
	}else{
		echo '<div class="message-box-wrapper red">';
		echo $un_successful_msg_contact;
		echo '</div>';
	}
}else if(isset($form_reserve) AND $form_reserve == 'form_reservation'){
$subject = "Contact Form Received";
	$message = '
		<table width="100%" border="1">
		  <tr>
			<td width="100"><strong>Name:</strong></td>
			<td>'.$first_name.'</td>
		  </tr>
		  <tr>
			<td><strong>Phone Number:</strong></td>
			<td>'.$phone_number.'</td>
		  </tr>
		  <tr>
			<td><strong>Date:</strong></td>
			<td>'.$date_reserve.'</td>
		  </tr>
		  <tr>
			<td><strong>Email:</strong></td>
			<td>'.$email_reserve.'</td>
		  </tr>
		  <tr>
			<td><strong>People Arriving:</strong></td>
			<td>'.$people_arriving.'</td>
		  </tr>
		  <tr>
			<td><strong>Ocassion:</strong></td>
			<td>'.$ocassion_reserve.'</td>
		  </tr>
		  
		  <tr>
			<td><strong>IP Address:</strong></td>
			<td>'.$_SERVER["REMOTE_ADDR"].'</td>
		  </tr>
		</table>
		';
	$headers = "From: " . $first_name . "\r\n";
	$headers .= "Reply-To: " . $email_reserve . "\r\n";
	$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
	$headers .= "MIME-Version: 1.0" . "\r\n";
	$attachments = '';
	if($first_name <> '' AND is_email($email_reserve)){
		wp_mail( $receiver_email, $subject, $message, $headers, $attachments );
		echo '<div class="message-box-wrapper green">';
		echo $successful_msg;
		echo '</div>';
	}else{
		echo '<div class="message-box-wrapper red">';
		echo $un_successful_msg;
		echo '</div>';
	}
}
?>