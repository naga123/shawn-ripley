<?php

	/*	
	*	CrunchPress Options File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the CrunchPress panel elements and create the 
	*	CrunchPress panel at the back-end of the framework
	*	---------------------------------------------------------------------
	*/
	
add_action('wp_ajax_sidebar_settings','sidebar_settings');
function sidebar_settings(){
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}

	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');//Sidebar settings Saved				
	if(isset($action) AND $action == 'sidebar_settings'){
		$sidebar_xml = '<sidebar_settings>';
		if(isset($_POST['sidebar'])){
			$sidebars = $_POST['sidebar'];
			foreach($sidebars as $keys=>$values){
				$sidebar_xml = $sidebar_xml . create_xml_tag('sidebar_name',$values);
			}
		}
		$sidebar_xml = $sidebar_xml . '</sidebar_settings>';

		if(!save_option('sidebar_settings', get_option('sidebar_settings'), $sidebar_xml)){
		
			die( json_encode($return_data) );
			
		}
		
		die( json_encode( array('success'=>'0') ) );
		
	}
		//Sidebar values getting from database
		$cp_sidebar_settings = get_option('sidebar_settings');
				
	?>
<div id="wrapper_backend">
	<div id="header_theme_options">	<span id="backend_logo"> <h1> <a href="#">CrunchPress Framework</a></h1></span>
	</div>
	<div class="wrapper_1">
		
		<?php echo top_navigation_html();?>		
	</div>
	<div class="below_wrapper tabs">
		<div class="wrapper_left">
			<ul id="wp_t_o_right_menu">
				<li><a href="#sidebar_settings" class=""><?php _e('Add New Sidebar', 'crunchpress'); ?></a></li>
			</ul>
		</div>
		<div class="wrapper_right">
			<form id="options-panel-form" name="goodlayer-panel-form">
				<div class="panel-elements" id="panel-elements">
					<div class="panel-element" id="panel-element-save-complete">
						<div class="panel-element-save-text"><?php _e('Save Options Complete', 'crunchpress'); ?>.</div>
						<div class="panel-element-save-arrow"></div>
					</div>
					<ul>
						<li id="sidebar_settings">
							<h3><?php _e('Sidebar Settings', 'crunchpress'); ?></h3>
							<div class="panel-title">
								<label> <?php _e('Add Sidebar Name', 'crunchpress'); ?> </label>
							</div>
							<div class="panel-input">
								<input type="text" id="add-more-sidebar" value="type title here" rel="type title here">
								<div id="add-more-sidebar" class="add-more-sidebar"></div>
							</div>
							<div class="description">Add New Sidebars, it will be shown as Widget area.</div>
							<div id="selected-sidebar" class="selected-sidebar">
								<div class="default-sidebar-item" id="sidebar-item">
									<div class="panel-delete-sidebar"></div>
									<div class="slider-item-text"></div>
									<input type="hidden" id="sidebar">
								</div>
							<?php
							//Sidebar addition
							if($cp_sidebar_settings <> ''){
								$sidebars_xml = new DOMDocument();
								$sidebars_xml->loadXML($cp_sidebar_settings);
								foreach( $sidebars_xml->documentElement->childNodes as $sidebar_name ){?>
								<div class="sidebar-item" id="sidebar-item">
									<div class="panel-delete-sidebar"></div>
									<div class="slider-item-text"><?php echo $sidebar_name->nodeValue; ?></div>
									<input type="hidden" name="sidebar[]" id="sidebar" value="<?php echo $sidebar_name->nodeValue; ?>">
								</div>
							<?php }
							}
							?>
							</div>
						</li>
					</ul>
					<div class="panel-element-tail">
						<div class="tail-save-changes">
							<div class="loading-save-changes"></div>
							<input type="submit" value="<?php echo __('Save Changes','crunchpress') ?>">
							<input type="hidden" name="action" value="sidebar_settings">				
							<!--<input type="hidden" name="security" value="<?php //echo wp_create_nonce(plugin_basename(__FILE__))?>">-->
						</div>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>	
	<?php
}	
?>
