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
	
add_action('wp_ajax_default_pages_settings','default_pages_settings');
function default_pages_settings(){
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}

	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');					
	if(isset($action) AND $action == 'default_pages_settings'){
		$default_pages_xml = '<default_pages_settings>';
		$default_pages_xml = $default_pages_xml . create_xml_tag('sidebar_default',$sidebars);
		$default_pages_xml = $default_pages_xml . create_xml_tag('right_sidebar_default',$right_sidebar_default);
		$default_pages_xml = $default_pages_xml . create_xml_tag('left_sidebar_default',$left_sidebar_default);
		$default_pages_xml = $default_pages_xml . create_xml_tag('default_excerpt',$default_excerpt);
		$default_pages_xml = $default_pages_xml . '</default_pages_settings>';

		if(!save_option('default_pages_settings', get_option('default_pages_settings'), $default_pages_xml)){
		
			die( json_encode($return_data) );
			
		}
		
		die( json_encode( array('success'=>'0') ) );
		
	}
	$sidebar_default = '';
	$right_sidebar_default = '';
	$left_sidebar_default = '';
	$default_excerpt = '';
	$cp_default_settings = get_option('default_pages_settings');
		if($cp_default_settings <> ''){
			$cp_default = new DOMDocument ();
			$cp_default->loadXML ( $cp_default_settings );
			$sidebar_default = find_xml_value($cp_default->documentElement,'sidebar_default');
			$right_sidebar_default = find_xml_value($cp_default->documentElement,'right_sidebar_default');
			$left_sidebar_default = find_xml_value($cp_default->documentElement,'left_sidebar_default');
			$default_excerpt = find_xml_value($cp_default->documentElement,'default_excerpt');
			
		}
	?>
<div id="wrapper_backend">
	<div id="header_theme_options">	<span id="backend_logo"> <h1> <a href="#">CrunchPress Framework </a> </h1> </span>
	</div>
	<div class="wrapper_1">
		
		<?php echo top_navigation_html();?>			
	</div>
	<div class="below_wrapper tabs">
		<div class="wrapper_left">
			<ul id="wp_t_o_right_menu">
				<li><a href="#default_pages" class=""><?php _e('Default Pages Settings', 'crunchpress'); ?></a></li>
			</ul>
		</div>
	<div class="wrapper_right">
	<form id="options-panel-form" name="goodlayer-panel-form">
		<div class="panel-elements" id="panel-elements">
			<div class="panel-element" id="panel-element-save-complete">
				<div class="panel-element-save-text"><?php _e('Save Options Complete', 'crunchpress'); ?>.</div>
				<div class="panel-element-save-arrow"></div>
			</div>
			
			<style>
			.cp_right_sidebar{
				display:none;
			}
			.cp_left_sidebar{
				display:none;
			}
			</style>
			<div class="clear"></div>
			<h3><?php _e('Default Page Settings', 'crunchpress'); ?></h3>	
			<p>Category Pages, Search, Archives, Taxonomy, Tags.</p>
			<?php echo show_sidebar($sidebar_default,'right_sidebar_default','left_sidebar_default',$right_sidebar_default,$left_sidebar_default);?>
			<div class="clear"></div>
			<ul class="default_excerpt recipe_class">
				<li class="panel-title">
					<label for="default_excerpt" > <?php _e('Default Excerpt', 'crunchpress'); ?> </label>
				</li>				
				<li class="panel-input">
					<input type="text" name="default_excerpt" id="default_excerpt" value="<?php if($default_excerpt <> ''){echo $default_excerpt;};?>" />
				</li>
				<li class="description"><p>Please Paste Your Default Excerpt(Number of words).</p></li>
			</ul>
			<div class="clear"></div>
			<div class="panel-element-tail">
				<div class="tail-save-changes">
					<div class="loading-save-changes"></div>
					<input type="submit" value="<?php echo __('Save Changes','crunchpress') ?>">
					<input type="hidden" name="action" value="default_pages_settings">				
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
