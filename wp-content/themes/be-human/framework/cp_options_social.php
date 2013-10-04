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
	
add_action('wp_ajax_social_settings','social_settings');
function social_settings(){
		
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}
	
	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');?>
<?php 
		//Social Sharing and Networking Values Saving as XML 
		if(isset($action) AND $action == 'social_settings'){
			$social_xml = '<social_settings>';
			$social_xml = $social_xml . create_xml_tag('facebook_network',$facebook_network);
			$social_xml = $social_xml . create_xml_tag('twitter_network',$twitter_network);
			$social_xml = $social_xml . create_xml_tag('delicious_network',$delicious_network);
			$social_xml = $social_xml . create_xml_tag('google_plus_network',$google_plus_network);
			//$social_xml = $social_xml . create_xml_tag('su_network',$su_network);
			$social_xml = $social_xml . create_xml_tag('linked_in_network',$linked_in_network);
			//$social_xml = $social_xml . create_xml_tag('digg_network',$digg_network);
			//$social_xml = $social_xml . create_xml_tag('myspace_network',$myspace_network);
			//$social_xml = $social_xml . create_xml_tag('reddit_network',$reddit_network);
			$social_xml = $social_xml . create_xml_tag('youtube_network',$youtube_network);
			$social_xml = $social_xml . create_xml_tag('flickr_network',$flickr_network);
			//$social_xml = $social_xml . create_xml_tag('picasa_network',$picasa_network);
			$social_xml = $social_xml . create_xml_tag('vimeo_network',$vimeo_network);
			$social_xml = $social_xml . create_xml_tag('pinterest_network',$pinterest_network);
			
			//Social Sharing
			$social_xml = $social_xml . create_xml_tag('facebook_sharing',$facebook_sharing);
			$social_xml = $social_xml . create_xml_tag('twitter_sharing',$twitter_sharing);
			$social_xml = $social_xml . create_xml_tag('stumble_sharing',$stumble_sharing);
			$social_xml = $social_xml . create_xml_tag('delicious_sharing',$delicious_sharing);
			$social_xml = $social_xml . create_xml_tag('googleplus_sharing',$googleplus_sharing);
			$social_xml = $social_xml . create_xml_tag('digg_sharing',$digg_sharing);
			$social_xml = $social_xml . create_xml_tag('myspace_sharing',$myspace_sharing);
			$social_xml = $social_xml . create_xml_tag('reddit_sharing',$reddit_sharing);			
			$social_xml = $social_xml . '</social_settings>';

			if(!save_option('social_settings', get_option('social_settings'), $social_xml)){
			
				die( json_encode($return_data) );
				
			}
			
			die( json_encode( array('success'=>'0') ) );
			
		}
		//Social Networking
		$facebook_network = '';
		$twitter_network = '';
		$delicious_network = '';
		$google_plus_network = '';
		$su_network = '';
		$linked_in_network = '';
		$digg_network = '';
		$myspace_network = '';
		$reddit_network = '';
		$youtube_network = '';
		$flickr_network = '';
		$picasa_network = '';
		$vimeo_network = '';
		$pinterest_network = '';
		
		//Social Sharing 
		$facebook_sharing = '';
		$twitter_sharing = '';
		$stumble_sharing = '';
		$delicious_sharing = '';
		$googleplus_sharing = '';
		$digg_sharing = '';
		$myspace_sharing = '';
		$reddit_sharing = '';		
		
		//Getting Values from database
		$cp_social_settings = get_option('social_settings');
		if($cp_social_settings <> ''){
			$cp_social = new DOMDocument();
			$cp_social->loadXML ( $cp_social_settings );
			
			//Social Networking Values
			$facebook_network = find_xml_value($cp_social->documentElement,'facebook_network');
			$twitter_network = find_xml_value($cp_social->documentElement,'twitter_network');
			$delicious_network = find_xml_value($cp_social->documentElement,'delicious_network');
			$google_plus_network = find_xml_value($cp_social->documentElement,'google_plus_network');
			//$su_network = find_xml_value($cp_social->documentElement,'su_network');
			$linked_in_network = find_xml_value($cp_social->documentElement,'linked_in_network');
			//$digg_network = find_xml_value($cp_social->documentElement,'digg_network');
			//$myspace_network = find_xml_value($cp_social->documentElement,'myspace_network');
			//$reddit_network = find_xml_value($cp_social->documentElement,'reddit_network');
			$youtube_network = find_xml_value($cp_social->documentElement,'youtube_network');
			//$flickr_network = find_xml_value($cp_social->documentElement,'flickr_network');
			//$picasa_network = find_xml_value($cp_social->documentElement,'picasa_network');
			$vimeo_network = find_xml_value($cp_social->documentElement,'vimeo_network');
			$pinterest_network = find_xml_value($cp_social->documentElement,'pinterest_network');
			
			
			// Social Sharing Values
			$facebook_sharing = find_xml_value($cp_social->documentElement,'facebook_sharing');
			$twitter_sharing = find_xml_value($cp_social->documentElement,'twitter_sharing');
			$stumble_sharing = find_xml_value($cp_social->documentElement,'stumble_sharing');
			$delicious_sharing = find_xml_value($cp_social->documentElement,'delicious_sharing');
			$googleplus_sharing = find_xml_value($cp_social->documentElement,'googleplus_sharing');
			$digg_sharing = find_xml_value($cp_social->documentElement,'digg_sharing');
			$myspace_sharing = find_xml_value($cp_social->documentElement,'myspace_sharing');
			$reddit_sharing = find_xml_value($cp_social->documentElement,'reddit_sharing');
			
		}
?>		
<div id="wrapper_backend">
	<div id="header_theme_options"><span id="backend_logo"> <h1> <a href="#">CrunchPress Framework</a></h1></span>
		
	</div>
	<div class="wrapper_1">
		
		<?php echo top_navigation_html();?>
	</div>
	<div class="below_wrapper tabs">
		<div class="wrapper_left">
			<ul id="wp_t_o_right_menu">
				<li><a href="#social_networking" class=""><?php _e('Social Networking', 'crunchpress'); ?></a></li>
				<li><a href="#social_sharing" class=""><?php _e('Social Sharing', 'crunchpress'); ?></a></li>
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
						<!--Social Networking Start -->
						<li id="social_networking" class="social_network_class">
							<h3><?php _e('Social Networking', 'crunchpress'); ?></h3>
							<div class="clear"></div>					
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="facebook_network" > <?php _e('Facebook', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="facebook_network" id="facebook_network" value="<?php if($facebook_network <> ''){echo esc_url($facebook_network);};?>" />
									<div class="admin-social-image">
										<span class="facebook">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>
							<div class="clear"></div>
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="twitter_network" > <?php _e('Twitter', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="twitter_network" id="twitter_network" value="<?php if($twitter_network <> ''){echo esc_url($twitter_network);};?>" />
									<div class="admin-social-image">
										<span class="twitter">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>
							<div class="clear"></div>
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="delicious_network" > <?php _e('Delicious', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="delicious_network" id="delicious_network" value="<?php if($delicious_network <> ''){echo esc_url($delicious_network);};?>" />
									<div class="admin-social-image">
										<span class="delicious">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>
							<div class="clear"></div>
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="google_plus_network" > <?php _e('Google Plus', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="google_plus_network" id="google_plus_network" value="<?php if($google_plus_network <> ''){echo esc_url($google_plus_network);};?>" />
									<div class="admin-social-image">
										<span class="googleplus">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>
							<div class="clear"></div>
							<!--<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="su_network" > <?php _e('Stumble Upon', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="su_network" id="su_network" value="<?php if($su_network <> ''){echo esc_url($su_network);};?>" />
									<div class="admin-social-image">
										<span class="su_network">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>-->
							<div class="clear"></div>
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="linked_in_network" > <?php _e('Linked In', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="linked_in_network" id="linked_in_network" value="<?php if($linked_in_network <> ''){echo esc_url($linked_in_network);};?>" />
									<div class="admin-social-image">
										<span class="linkedin">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>
							<div class="clear"></div>
							<!--<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="digg_network" > <?php _e('Digg', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="digg_network" id="digg_network" value="<?php if($digg_network <> ''){echo esc_url($digg_network);};?>" />
									<div class="admin-social-image">
										<span class="digg">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>
							<div class="clear"></div>
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="myspace_network" > <?php _e('Myspace', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="myspace_network" id="myspace_network" value="<?php if($myspace_network <> ''){echo esc_url($myspace_network);};?>" />
									<div class="admin-social-image">
										<span class="myspace">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>
							<div class="clear"></div>
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="reddit_network" > <?php _e('Reddit', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="reddit_network" id="reddit_network" value="<?php if($reddit_network <> ''){echo esc_url($reddit_network);};?>" />
									<div class="admin-social-image">
										<span class="reddit">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>
							<div class="clear"></div>-->
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="youtube_network" > <?php _e('Youtube', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="youtube_network" id="youtube_network" value="<?php if($youtube_network <> ''){echo esc_url($youtube_network);};?>" />
									<div class="admin-social-image">
										<span class="youtube">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>
							<div class="clear"></div>
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="flickr_network" > <?php _e('Flickr', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="flickr_network" id="flickr_network" value="<?php if($flickr_network <> ''){echo esc_url($flickr_network);};?>" />
									<div class="admin-social-image">
										<span class="flickr">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>
							<!--<div class="clear"></div>
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="picasa_network" > <?php _e('Picasa', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="picasa_network" id="picasa_network" value="<?php if($picasa_network <> ''){echo esc_url($picasa_network);};?>" />
									<div class="admin-social-image">
										<span class="picasa">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>-->
							<div class="clear"></div>
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="vimeo_network" > <?php _e('Vimeo', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="vimeo_network" id="vimeo_network" value="<?php if($vimeo_network <> ''){echo esc_url($vimeo_network);};?>" />
									<div class="admin-social-image">
										<span class="vimeo">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="pinterest_network" > <?php _e('Pinterest', 'crunchpress'); ?> </label>
								</li>				
								<li class="panel-input">
									<input type="text" name="pinterest_network" id="pinterest_network" value="<?php if($pinterest_network <> ''){echo esc_url($pinterest_network);};?>" />
									<div class="admin-social-image">
										<span class="pinterest">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please paste your Profile URl</li>
							</ul>								
						</li>
						<!--Social Sharing Start -->
						<li id="social_sharing" class="social_sharing_class">
							<h3>Social Sharing</h3>
							<div class="clear"></div>					
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="facebook_sharing" > <?php _e('FACEBOOK SHARING', 'crunchpress'); ?> </label>
								</li>	
								<li class="panel-input">
									<label for="facebook_sharing">
										<div class="checkbox-switch <?php echo ($facebook_sharing=='enable' || ($facebook_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
									</label>
									<input type="checkbox" name="facebook_sharing" class="checkbox-switch" value="disable" checked>
									<input type="checkbox" name="facebook_sharing" id="facebook_sharing" class="checkbox-switch" value="enable" <?php	echo ($facebook_sharing=='enable' || ($facebook_sharing==''))? 'checked': '';?>>
									<div class="admin-social-image">
										<span class="facebook">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please turn On/Off sharing on post detail page.</li>
							</ul>
							<div class="clear"></div>					
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="twitter_sharing" > <?php _e('TWITTER SHARING', 'crunchpress'); ?> </label>
								</li>	
								<li class="panel-input">
									<label for="twitter_sharing">
										<div class="checkbox-switch <?php echo ($twitter_sharing=='enable' || ($twitter_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
									</label>
									<input type="checkbox" name="twitter_sharing" class="checkbox-switch" value="disable" checked>
									<input type="checkbox" name="twitter_sharing" id="twitter_sharing" class="checkbox-switch" value="enable" <?php	echo ($twitter_sharing=='enable' || ($twitter_sharing==''))? 'checked': '';?>>
									<div class="admin-social-image">
										<span class="twitter">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please turn On/Off sharing on post detail page.</li>
							</ul>
							<div class="clear"></div>					
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="stumble_sharing" > <?php _e('STUMBLEUPON SHARING', 'crunchpress'); ?> </label>
								</li>	
								<li class="panel-input">
									<label for="stumble_sharing">
										<div class="checkbox-switch <?php echo ($stumble_sharing=='enable' || ($stumble_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
									</label>
									<input type="checkbox" name="stumble_sharing" class="checkbox-switch" value="disable" checked>
									<input type="checkbox" name="stumble_sharing" id="stumble_sharing" class="checkbox-switch" value="enable" <?php	echo ($stumble_sharing=='enable' || ($stumble_sharing==''))? 'checked': '';?>>
									<div class="admin-social-image">
										<span class="stumble">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please turn On/Off sharing on post detail page.</li>
							</ul>
							<div class="clear"></div>					
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="delicious_sharing" > <?php _e('DELICIOUS SHARING', 'crunchpress'); ?> </label>
								</li>	
								<li class="panel-input">
									<label for="delicious_sharing">
										<div class="checkbox-switch <?php echo ($delicious_sharing=='enable' || ($delicious_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
									</label>
									<input type="checkbox" name="delicious_sharing" class="checkbox-switch" value="disable" checked>
									<input type="checkbox" name="delicious_sharing" id="delicious_sharing" class="checkbox-switch" value="enable" <?php	echo ($delicious_sharing=='enable' || ($delicious_sharing==''))? 'checked': '';?>>
									<div class="admin-social-image">
										<span class="delicious">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please turn On/Off sharing on post detail page.</li>
							</ul>
							<div class="clear"></div>					
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="googleplus_sharing" > <?php _e('GOOGLE PLUS SHARING', 'crunchpress'); ?> </label>
								</li>	
								<li class="panel-input">
									<label for="googleplus_sharing">
										<div class="checkbox-switch <?php echo ($googleplus_sharing=='enable' || ($googleplus_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
									</label>
									<input type="checkbox" name="googleplus_sharing" class="checkbox-switch" value="disable" checked>
									<input type="checkbox" name="googleplus_sharing" id="googleplus_sharing" class="checkbox-switch" value="enable" <?php	echo ($googleplus_sharing=='enable' || ($googleplus_sharing==''))? 'checked': '';?>>
									<div class="admin-social-image">
										<span class="googleplus">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please turn On/Off sharing on post detail page.</li>
							</ul>
							<div class="clear"></div>					
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="digg_sharing" > <?php _e('DIGG SHARING', 'crunchpress'); ?> </label>
								</li>	
								<li class="panel-input">
									<label for="digg_sharing">
										<div class="checkbox-switch <?php echo ($digg_sharing=='enable' || ($digg_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
									</label>
									<input type="checkbox" name="digg_sharing" class="checkbox-switch" value="disable" checked>
									<input type="checkbox" name="digg_sharing" id="digg_sharing" class="checkbox-switch" value="enable" <?php	echo ($digg_sharing=='enable' || ($digg_sharing==''))? 'checked': '';?>>
									<div class="admin-social-image">
										<span class="digg">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please turn On/Off sharing on post detail page.</li>
							</ul>
							<div class="clear"></div>					
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="myspace_sharing" > <?php _e('MYSPACE SHARING', 'crunchpress'); ?> </label>
								</li>	
								<li class="panel-input">
									<label for="myspace_sharing">
										<div class="checkbox-switch <?php echo ($myspace_sharing=='enable' || ($myspace_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
									</label>
									<input type="checkbox" name="myspace_sharing" class="checkbox-switch" value="disable" checked>
									<input type="checkbox" name="myspace_sharing" id="myspace_sharing" class="checkbox-switch" value="enable" <?php	echo ($myspace_sharing=='enable' || ($myspace_sharing==''))? 'checked': '';?>>
									<div class="admin-social-image">
										<span class="myspace">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please turn On/Off sharing on post detail page.</li>
							</ul>
							<div class="clear"></div>					
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="reddit_sharing" > <?php _e('REDDIT SHARING', 'crunchpress'); ?> </label>
								</li>	
								<li class="panel-input">
									<label for="reddit_sharing">
										<div class="checkbox-switch <?php echo ($reddit_sharing=='enable' || ($reddit_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
									</label>
									<input type="checkbox" name="reddit_sharing" class="checkbox-switch" value="disable" checked>
									<input type="checkbox" name="reddit_sharing" id="reddit_sharing" class="checkbox-switch" value="enable" <?php	echo ($reddit_sharing=='enable' || ($reddit_sharing==''))? 'checked': '';?>>
									<div class="admin-social-image">
										<span class="reddit">&nbsp;</span>
									</div>
								</li>
								<li class="description">Please turn On/Off sharing on post detail page.</li>
							</ul>
						</li>
					</ul>				
					<div class="panel-element-tail">
						<div class="tail-save-changes">
							<div class="loading-save-changes"></div>
							<input type="submit" value="<?php echo __('Save Changes','crunchpress') ?>">
							<input type="hidden" name="action" value="social_settings">				
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