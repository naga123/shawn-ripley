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
	

add_action('wp_ajax_dummydata_import','dummydata_import');
function dummydata_import(){
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}
	
	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');?>
	<div id="wrapper_backend" class="wrapper_backend ">
		<div id="header_theme_options">
			<span id="backend_logo">
				<h1><a href="#">CrunchPress Framework</a></h1>
			</span>
		</div>
		<div class="wrapper_1">
			<?php echo top_navigation_html();?>			
		</div>
		<div class="below_wrapper tabs">
			<div class="wrapper_left">
				<ul id="wp_t_o_right_menu">
					<li><a href="#news_letter" class=""><?php _e('Dummy Data Settings', 'crunchpress'); ?></a></li>
				</ul>
			</div>
			<div class="wrapper_right themeple_container">
				<ul>
					<li id="news_letter" class="newsletter_class">
						<h3>Dummy Data Installation</h3>
						<ul class="download_newsletter recipe_class">
							<li class="panel-title">
								<label><?php _e('Import DummyData', 'crunchpress'); ?> </label>
							</li>
							<li class="panel-input">
								<input type="hidden" value="<?php echo wp_create_nonce ('themeple_nonce_import_dummy_data');?>" name="themeple-nonce-dummy">
								<a class="themeple_btn themeple_btn_active themeple_dummy_data"><input type="button" value="<?php _e('Import Data', 'crunchpress'); ?>" id="importcontent" /></a>
								<div class="js_data" id="themeple_js_data">
									<input type="hidden" value="<?php echo admin_url("admin-ajax.php");?>" name="admin_ajax_url">						
								</div>
							</li>
							<li class="description"><span class="loading"></span>Click on Import button to import your theme dummy data.</li>
						</ul>
					</li>
				</ul>	
			</div>	
		</div>
	</div>				
	<?php
}	



?>
