<?php
/*
	 * This file is used to generate footer section of theme.
 */	

		wp_reset_query();
			$header_logo_upload = '';
			$logo_width = '';
			$logo_height = '';
			$select_layout_cp = '';
			$boxed_scheme = '';
			$select_bg_pat = '';
			$color_scheme = '';
			$color_anchor = '';
			$bg_scheme = '';
			$body_patren = '';
			$body_image = '';
			$position_image_layout = '';
			$image_repeat_layout = '';
			$image_attachment_layout = '';
			$header_css_code = '';
			$google_webmaster_code = '';
			$news_headline = '';
			$news_headline_category = '';
			$countd_event_category = '';
			$copyright_code = '';
			$consumer_key = '';
			$consumer_secret = ''; 
			$user_token = '';
			$user_secret = '';
			$twitter_id = '';
		//	$homepage_on = '';
//			$homepage_layout_on = '';
//			$section_select_background = '';
//			$section_scheme = '';
//			$section_patren = '';
//			$section_body_patren = '';
//			$home_page_layout = '';
			$footer_banner = '';
			$footer_col_layout = '';
			$phone_contact = '';
			$social_networking = '';
			$footer_logo = '';
			$footer_logo_width = '';
			$footer_logo_height = '';
			$footer_layout = '';
			$breadcrumbs = '';			
			$rtl_layout = '';
			$tf_username = '';
			$tf_sec_api = '';
			
			$cp_general_settings = get_option('general_settings');
			if($cp_general_settings <> ''){
				$cp_logo = new DOMDocument ();
				$cp_logo->loadXML ( $cp_general_settings );
				$header_logo = find_xml_value($cp_logo->documentElement,'header_logo');
				$logo_width = find_xml_value($cp_logo->documentElement,'logo_width');
				$logo_height = find_xml_value($cp_logo->documentElement,'logo_height');
				$select_layout_cp = find_xml_value($cp_logo->documentElement,'select_layout_cp');
				$boxed_scheme = find_xml_value($cp_logo->documentElement,'boxed_scheme');
				$select_bg_pat = find_xml_value($cp_logo->documentElement,'select_bg_pat');
				$color_scheme = find_xml_value($cp_logo->documentElement,'color_scheme');
				$color_anchor = find_xml_value($cp_logo->documentElement,'color_anchor');
				$bg_scheme = find_xml_value($cp_logo->documentElement,'bg_scheme');
				$body_patren = find_xml_value($cp_logo->documentElement,'body_patren');
				$color_patren = find_xml_value($cp_logo->documentElement,'color_patren');
				$body_image = find_xml_value($cp_logo->documentElement,'body_image');
				$position_image_layout = find_xml_value($cp_logo->documentElement,'position_image_layout');
				$image_repeat_layout = find_xml_value($cp_logo->documentElement,'image_repeat_layout');
				$image_attachment_layout = find_xml_value($cp_logo->documentElement,'image_attachment_layout');
				$header_css_code = find_xml_value($cp_logo->documentElement,'header_css_code');
				$google_webmaster_code = find_xml_value($cp_logo->documentElement,'google_webmaster_code');
				$phone_contact_header = find_xml_value($cp_logo->documentElement,'phone_contact_header');
				$social_network_header = find_xml_value($cp_logo->documentElement,'social_network_header');
				$countd_event_category = find_xml_value($cp_logo->documentElement,'countd_event_category');
				$copyright_code = find_xml_value($cp_logo->documentElement,'copyright_code');
//				$homepage_layout_on = find_xml_value($cp_logo->documentElement,'homepage_layout_on');
//				$section_select_background = find_xml_value($cp_logo->documentElement,'section_select_background');
//				$section_scheme = find_xml_value($cp_logo->documentElement,'section_scheme');
//				$section_patren = find_xml_value($cp_logo->documentElement,'section_patren');
//				$section_body_patren = find_xml_value($cp_logo->documentElement,'section_body_patren');
//				$home_page_layout = find_xml_value($cp_logo->documentElement,'home_page_layout');
				$footer_banner = find_xml_value($cp_logo->documentElement,'footer_banner');
				$footer_col_layout = find_xml_value($cp_logo->documentElement,'footer_col_layout');
				$phone_contact = find_xml_value($cp_logo->documentElement,'phone_contact');
				$social_networking = find_xml_value($cp_logo->documentElement,'social_networking');
				//$footer_logo = find_xml_value($cp_logo->documentElement,'footer_logo');
				//$footer_logo_width = find_xml_value($cp_logo->documentElement,'footer_logo_width');
				//$footer_logo_height = find_xml_value($cp_logo->documentElement,'footer_logo_height');
				//$footer_layout = find_xml_value($cp_logo->documentElement,'footer_layout');
				$consumer_key = find_xml_value($cp_logo->documentElement,'consumer_key');
				$consumer_secret = find_xml_value($cp_logo->documentElement,'consumer_secret');
				$user_token = find_xml_value($cp_logo->documentElement,'user_token');
				$user_secret = find_xml_value($cp_logo->documentElement,'user_secret');
				$twitter_id = find_xml_value($cp_logo->documentElement,'twitter_id');
				$breadcrumbs = find_xml_value($cp_logo->documentElement,'breadcrumbs');
				$rtl_layout = find_xml_value($cp_logo->documentElement,'rtl_layout');
				$tf_username = find_xml_value($cp_logo->documentElement,'tf_username');
				$tf_sec_api = find_xml_value($cp_logo->documentElement,'tf_sec_api');
			}
		
?>	
	<footer>
		<section class="mtp " id="footer"> 
			<?php if($select_layout_cp == 'full_layout'){echo '<section class="footer_1">';}?>
				<section class="container-fluid container">
					<section class="row-fluid <?php if($select_layout_cp == 'boxed_layout'){echo 'footer_1';}?>">
						<?php if($footer_banner <> ''){?>
							<section id="banner" class="span12 first"> 
								<?php echo $footer_banner;?>
							</section>
						<?php }?>
						<section class="span12 first <?php if($footer_col_layout == 'home_3_col'){echo 'footer_3_col';}else{echo 'footer_4_col';}?>" id="footer_main">
							<?php dynamic_sidebar('sidebar-footer'); ?>
						</section>
					</section>
				</section>
			<?php if($select_layout_cp == 'full_layout'){echo '</section>';}
		
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
				
				$cp_social_settings = get_option('social_settings');
				if($cp_social_settings <> ''){
					$cp_social = new DOMDocument ();
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
					$flickr_network = find_xml_value($cp_social->documentElement,'flickr_network');
					//$picasa_network = find_xml_value($cp_social->documentElement,'picasa_network');
					$vimeo_network = find_xml_value($cp_social->documentElement,'vimeo_network');
					$pinterest_network = find_xml_value($cp_social->documentElement,'pinterest_network');
					
				}
?>
			<?php if($select_layout_cp == 'full_layout'){echo '<section class="footer_2">';}?>
				<section class="container-fluid container">
					<section class="row-fluid <?php if($select_layout_cp == 'boxed_layout'){echo 'footer_2';}?>">
						<figure class="span6" id="footer_left"><?php echo $phone_contact;?></figure>
						<figure class="span6" id="footer_right">
							<?php if($social_networking == 'enable'){?>
							<div id="socialicons">
								<?php if(isset($facebook_network) AND $facebook_network <> ''){?>
								<a title="Facebook Sharing" href="<?php echo $facebook_network;?>" class="social_active" id="fb_hr">
									<span class="da-animate da-slideFromLeft"></span>
								</a>
								<?php }?>
								<?php if(isset($twitter_network) AND $twitter_network <> ''){?>
								<a title="Twitter Sharing" href="<?php echo $twitter_network;?>" class="social_active" id="twitter_hr">
									<span class="da-animate da-slideFromLeft"></span>
								</a>
								<?php }?>
								<?php if(isset($linked_in_network) AND $linked_in_network <> ''){?>
								<a title="Linked In Sharing" href="<?php echo $linked_in_network;?>" class="social_active" id="linked_hr">
									<span class="da-animate da-slideFromLeft"></span>
								</a>
								<?php }?>
								<?php if(isset($google_plus_network) AND $google_plus_network <> ''){?>
								<a title="Google Plus Sharing" href="<?php echo $google_plus_network;?>" class="social_active" id="googleplus_hr">
									<span class="da-animate da-slideFromLeft"></span>
								</a>
								<?php }?>
								<?php if(isset($flickr_network) AND $flickr_network <> ''){?>
								<a title="Flickr Sharing" href="<?php echo $flickr_network;?>" class="social_active" id="flickr_hr">
									<span class="da-animate da-slideFromLeft"></span>
								</a>
								<?php }?>
								<?php if(isset($youtube_network) AND $youtube_network <> ''){?>
								<a title="Youtube Sharing" href="<?php echo $youtube_network;?>" class="social_active" id="youtube_hr">
									<span class="da-animate da-slideFromLeft"></span>
								</a>
								<?php }?>
								<?php if(isset($vimeo_network) AND $vimeo_network <> ''){?>
								<a title="Vimeo Sharing" href="<?php echo $vimeo_network;?>" class="social_active" id="vimeo_hr">
									<span class="da-animate da-slideFromLeft"></span>
								</a>
								<?php }?>
								<?php if(isset($pinterest_network) AND $pinterest_network <> ''){?>
								<a title="Pinterest Sharing" href="<?php echo $pinterest_network;?>" class="social_active" id="pinterest_hr">
									<span class="da-animate da-slideFromLeft"></span>
								</a>
								<?php }?>
							</div>
						<?php }?>
						</figure>
					</section>
				</section>
			<?php if($select_layout_cp == 'full_layout'){echo '</section><section class="footer_3">';}?>
				<section class="container-fluid container ">
					<section class="row-fluid <?php if($select_layout_cp == 'boxed_layout'){echo 'footer_3';}?>">
						<figure class="span6" id="footer_left">
							<?php				// Menu parameters		
							$defaults = array(
							  'theme_location'  => 'footer-menu',
							  'menu'            => '', 
							  'container'       => '', 
							  'container_class' => 'menu-{menu slug}-container', 
							  'container_id'    => '',
							  'menu_class'      => 'footer_nav', 
							  'menu_id'         => 'menusection',
							  'echo'            => true,
							  'fallback_cb'     => '',
							  'before'          => '',
							  'after'           => '',
							  'link_before'     => '',
							  'link_after'      => '',
							  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							  'depth'           => 0,
							  'walker'          => '',);				
							if(has_nav_menu('footer-menu')){?>		
								<?php wp_nav_menu( $defaults);?>
							<?php } ?>
							<p><?php echo $copyright_code;?></p>
						</figure>
						<figure class="span6" id="footer_right">
						<?php
						   include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
							if(is_plugin_active('twitter_widget/index.php')){
								
								$tweets_footer = get_tweets( $twitter_id, 1, $consumer_key, $consumer_secret, $user_token, $user_secret ); 
								if($twitter_id <> ''){ ?>
								<div id="tweets" class="latest_tweets">
									<ul id="latest_tweets">
									<?php while ($new_tweet = array_shift($tweets_footer)) { ?>
										<li> <?php echo linkify_tweet( $new_tweet->text, $new_tweet );?> <a href="https://twitter.com/intent/user?user_id=<?php echo $new_tweet->user->id_str; ?>"> @<?php echo $new_tweet->user->screen_name; ?></a> </li>
									<?php }?>
									</ul>
								</div>
							<?php 
								}
							}
						?>	
						</figure>
					</section>
				</section>
			<?php if($select_layout_cp == 'full_layout'){echo '</section>';}?>
		</section>
	</footer> 
</div>
<?php wp_footer();?>
  </body>
</html>

