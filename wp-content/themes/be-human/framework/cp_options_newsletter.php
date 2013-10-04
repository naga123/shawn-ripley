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
	
add_action('wp_ajax_newsletter_settings','newsletter_settings');
function newsletter_settings(){
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}
	
	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');?>
<div id="wrapper_backend">
	<div id="header_theme_options">	<span id="backend_logo"> <h1> <a href="#"> CrunchPress Framework </a> </h1> </span>
	</div>
	<div class="wrapper_1">
		
		<?php echo top_navigation_html();?>			
	</div>
	<div class="below_wrapper tabs">
		<div class="wrapper_left">
			<ul id="wp_t_o_right_menu">
				<li><a href="#news_letter" class=""><?php _e('Newsletter Settings', 'crunchpress'); ?></a></li>
			</ul>
		</div>
	<div class="wrapper_right">
	<form id="options-panel-form" name="goodlayer-panel-form">
		<div class="panel-elements" id="panel-elements">
			<div class="panel-element" id="panel-element-save-complete">
				<div class="panel-element-save-text"><?php _e('Save Options Complete', 'crunchpress'); ?>.</div>
				<div class="panel-element-save-arrow"></div>
			</div>
<?php 
		if(isset($action) AND $action == 'newsletter_settings'){
			$newsletter_xml = '<newsletter_settings>';
			$newsletter_xml = $newsletter_xml . create_xml_tag('newsletter_config',$newsletter_config);
			$newsletter_xml = $newsletter_xml . create_xml_tag('feed_burner_text',$feed_burner_text);
			$newsletter_xml = $newsletter_xml . '</newsletter_settings>';

			if(!save_option('newsletter_settings', get_option('newsletter_settings'), $newsletter_xml)){
			
				die( json_encode($return_data) );
				
			}
			
			die( json_encode( array('success'=>'0') ) );
			
		}
		$newsletter_config = '';
		$feed_burner_text = '';
		$cp_newsletter_settings = get_option('newsletter_settings');
		if($cp_newsletter_settings <> ''){
			$cp_newsletter = new DOMDocument ();
			$cp_newsletter->loadXML ( $cp_newsletter_settings );
			$newsletter_config = find_xml_value($cp_newsletter->documentElement,'newsletter_config');
			$feed_burner_text = find_xml_value($cp_newsletter->documentElement,'feed_burner_text');
		}
?>			<style>
			.download_newsletter{
				display:none;
			}
			.feedburner_id{
				display:none;
			}
			</style>
				<ul>
					<li id="news_letter" class="newsletter_class">
					<h3><?php _e('Newsletter/News Feed Settings', 'crunchpress'); ?></h3>
						<ul class="recipe_class">
							<li class="panel-title">
								<label for="newsletter_settings"><?php _e('Newsletter Type', 'crunchpress'); ?></label>
							</li>
							<li class="panel-input">	
								<div class="combobox">
									<select name="newsletter_config" id="newsletter_settings">
										<option class="google_feed_burner" value="google_feed_burner" <?php if( $newsletter_config == 'google_feed_burner' ){ echo 'selected'; }?>>Google Feed Burner</option>
										<option class="built_in_newsletter" value="built_in_newsletter" <?php if( $newsletter_config == 'built_in_newsletter' ){ echo 'selected'; }?>>CP Newsletter</option>
									</select>
								</div>
							</li>
							<li class="description">Please Select Newsletter Type from dropdown</li>
						</ul>
						<div class="clear"></div>
						<ul class="feedburner_id recipe_class">
							<li class="panel-title">
								<label for="feed_burner_text" > <?php _e('Feed Burner ID', 'crunchpress'); ?> </label>
							</li>				
							<li class="panel-input">
								<input type="text" name="feed_burner_text" id="feed_burner_text" value="<?php if($feed_burner_text <> ''){echo $feed_burner_text;};?>" />
							</li>
							<li class="description">Please enter your google feed burner id in text field.</li>
						</ul>
						<ul class="download_newsletter recipe_class">
							<li class="panel-title">
								<label><?php _e('Download Newsletter', 'crunchpress'); ?> </label>
							</li>
							<li class="panel-input">
								<a href="<?php echo CP_PATH_URL?>/framework/extensions/export_newsletter.php"><input type="button" value="Download" id="download_newsletter" /></a>
							</li>
							<li class="description">Download your newsletters csv file from here.</li>
						</ul>
					</li>				
				</ul>
				<div class="clear"></div>
				<div class="panel-element-tail">
					<div class="tail-save-changes">
						<div class="loading-save-changes"></div>
						<input type="submit" value="<?php echo __('Save Changes','crunchpress') ?>">
						<input type="hidden" name="action" value="newsletter_settings">				
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
