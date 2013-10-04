<?php 
function get_taxonomy_list_cpt($post_type) {
	global $wpdb;
	$query = "
	SELECT wp_term_taxonomy.term_taxonomy_id , wp_terms.name 
	FROM $wpdb->term_taxonomy 
	INNER JOIN $wpdb->terms
	ON $wpdb->term_taxonomy.term_id=$wpdb->terms.term_id 
	WHERE $wpdb->term_taxonomy.taxonomy=$post_type";
	$p = $wpdb->get_results($query);
	$terms_arr= array();
	$terms_arr= null;
	
	foreach ($p as $term) {
	$terms_arr[$term->term_taxonomy_id]=$term->name;
	}
}	
?>
<?php

// Default options values
$mega_menu_options = array(
	'menu_name' => 'Mega Menu',
	'enable_mega' => false
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function sa_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'mega_menu_theme_options', 'mega_menu_options', 'sa_validate_options' );
}

add_action( 'admin_init', 'sa_register_settings' );

// Store categories in array
global $wpdb;
	$query = "
	SELECT wp_term_taxonomy.term_taxonomy_id , wp_terms.name 
	FROM $wpdb->term_taxonomy 
	INNER JOIN $wpdb->terms
	ON $wpdb->term_taxonomy.term_id=$wpdb->terms.term_id 
	WHERE $wpdb->term_taxonomy.taxonomy='cmm_menus'";
	$names = $wpdb->get_results($query);
foreach( $names as $name ) :
	$mega_menu_theme_optionss[$name->term_taxonomy_id] = array(
		'value' => $name->term_taxonomy_id,
		'label' => $name->name
	);
	
endforeach;

global $mega_menu_options;
$mega_menu = get_option( 'mega_menu_options', $mega_menu_options );
if($mega_menu['enable_mega'] !=1) { //$mega_menu_theme_optionss=null; $mega_menu_theme_optionss[0] = array('value' =>0,'label' => 'Mega Menu Disabled'8); 
}

function mega_menu_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( ' Primary Menu ', ' Primary Menu ', 'edit_theme_options', 'theme_options', 'mega_menu_theme_options_page' );
}

add_action( 'admin_menu', 'mega_menu_theme_options' );

// Function to generate options page
function mega_menu_theme_options_page() {
	global $mega_menu_options, $mega_menu_theme_optionss, $sa_layouts;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2> Mega Menu </h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved','crunchpress' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'mega_menu_options', $mega_menu_options ); ?>
	
	<?php settings_fields( 'mega_menu_theme_options' );	 ?>

	<table class="form-table">
	<br>
    <tr><?php if(!function_exists ("cmm_display_menu")) {echo'<div class="alert error"><p>Please Install mega menu plugin</p></div></tr>'?> <?php } else {?>
	<tr><?php if(empty($mega_menu_theme_optionss)) {$url = admin_url( 'edit-tags.php?taxonomy=cmm_menus&post_type=cmm', 'http' );			
     echo'<br><div class="alert error"><p>Please add a mega menu <a href="'.$url.'">Add menu</a></p></div>';} ?> <?php } ?>
   
	 </tr>
	<?php if(!empty($mega_menu_theme_optionss)) { ?>
	<tr valign="top"><th scope="row">Enable Mega Menu</th>
    <td>
    
    <?php 
	  global $mega_menu_options;
	$mega_menu = get_option( 'mega_menu_options', $mega_menu_options );
	 $prev = $mega_menu['menu_name'];
	 
	if (!$prev == "") { ?>
    <input type="checkbox" id="enable_mega" name="mega_menu_options[enable_mega]" value="1" <?php checked ( true, $settings['enable_mega'] ); ?>/>
    
	<?php }else { ?>
       <input type="checkbox" id="enable_mega" name="mega_menu_options[enable_mega]" value="1" checked=""/> 
    <?php } ?>
    
    
    <label for="enable_mega">Enable Mega Menu</label>
    </td>
    </tr>
	<?php global $mega_menu_options; ?>
	<tr valign="top"><th scope="row"><label for="menu_name">Select Mega Menu As Main Nav</label></th>
	<td>
	<select id="menu_name" name="mega_menu_options[menu_name]">
	<?php
	 if(!empty($mega_menu_theme_optionss)) {
	foreach ($mega_menu_theme_optionss as $mega ) :
		$label = $mega['label'];
		$selected = '';
		if ( $mega['value'] == $settings['menu_name'] )
			$selected = 'selected="selected"';
		echo '<option style="padding-right: 10px;" value="' . esc_attr( $mega['value'] ) . '" ' . $selected . '>' . $label . '</option>';
	endforeach;}
	else {echo '<div class="alert error"><p>Please Install mega menu plugin</p></div>';}
	?>
	</select>
    
	</td>
	</tr>
    <?php } ?>
	</table>
    
  <?php  if(!empty($mega_menu_theme_optionss)) {?>
	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>
  <?php }?>
  
	</form>
	</div>

	<?php
}

function sa_validate_options( $input ) {
	global $mega_menu_options, $mega_menu_theme_optionss, $sa_layouts;

	$settings = get_option( 'mega_menu_options', $mega_menu_options );
	

	// We select the previous value of the field, to restore it in case an invalid entry has been given
	$prev = $settings['menu_name'];
	// We verify if the given value exists in the categories array
	if ( !array_key_exists( $input['menu_name'], $mega_menu_theme_optionss ) )
		$input['menu_name'] = $prev;
		
	// If the checkbox has not been checked, we void it
    if ( ! isset( $input['enable_mega'] ) )
    $input['enable_mega'] = null;
    // We verify if the input is a boolean value
    $input['enable_mega'] = ( $input['enable_mega'] == 1 ? 1 : 0 );
 
	
	return $input;
}

endif;  // EndIf is_admin()