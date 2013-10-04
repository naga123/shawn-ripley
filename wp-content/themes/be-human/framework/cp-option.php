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
	
	
	// add action to embeded the panel in to dashboard
	add_action('admin_menu','add_crunchpress_panel');
	function add_crunchpress_panel(){
	
		add_menu_page( 'CrunchPress Option', THEME_NAME_F, 'administrator', 'general_options', 'general_options', CP_PATH_URL."/framework/images/cp-icon.png" );
			//add_submenu_page( 'general_options', 'Home Page Settings', 'Home Page Settings', 'administrator','homepage_settings', 'homepage_settings' );
			add_submenu_page( 'general_options', 'Typography Settings', 'Typography Settings', 'administrator','typography_settings', 'typography_settings' );
			add_submenu_page( 'general_options', 'Slider Settings', 'Slider Settings', 'administrator','slider_settings', 'slider_settings' );
			add_submenu_page( 'general_options', 'Social Network', 'Social Network', 'administrator','social_settings', 'social_settings' );
			add_submenu_page( 'general_options', 'Sidebar Settings', 'Sidebar Settings', 'administrator','sidebar_settings', 'sidebar_settings' );
			add_submenu_page( 'general_options', 'Default Pages Settings', 'Default Pages Settings', 'administrator','default_pages_settings', 'default_pages_settings' );
			add_submenu_page( 'general_options', 'Newsletter Settings', 'Newsletter Settings', 'administrator','newsletter_settings', 'newsletter_settings' );
			add_submenu_page( 'general_options', 'Import Dummy Data', 'Import Dummy Data', 'administrator','dummydata_import', 'dummydata_import' );
		
		
		
		add_action('admin_enqueue_scripts','register_crunchpress_panel_scripts');
		add_action('admin_print_styles','register_crunchpress_panel_styles');
	}
	
		
add_action('wp_ajax_general_options','general_options');
function general_options(){
		
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}

	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');?>

	<div id="wrapper_backend">
	<div id="header_theme_options">
		<span id="backend_logo"><h1><a href="#">CrunchPress Framework</a></h1></span>
	</div>
	<div class="wrapper_1">
		<?php echo top_navigation_html();?>		
	</div>
	<div class="below_wrapper tabs">
		<div class="wrapper_left">
			<ul id="wp_t_o_right_menu">
				<li><a href="#logo" class=""><?php _e('Logo Settings', 'crunchpress'); ?></a></li>
				<li><a href="#color_style" class=""><?php _e('Style & Color Scheme', 'crunchpress'); ?></a></li>
				<li><a href="#hr_settings" class=""><?php _e('Header Settings', 'crunchpress'); ?></a></li>
				<li><a href="#ft_settings" class=""><?php _e('Footer Settings', 'crunchpress'); ?></a></li>
				<li><a href="#misc_settings" class=""><?php _e('MISC Settings', 'crunchpress'); ?></a></li>
				<?php if(!class_exists( 'Envato_WordPress_Theme_Upgrader' )){}else{?><li><a href="#envato_api" class=""><?php _e('User API Settings', 'crunchpress'); ?></a></li><?php }?>
			</ul>
		</div>
	<div class="wrapper_right">
	<form id="options-panel-form" name="goodlayer-panel-form">
		<div class="panel-elements" id="panel-elements">
			<div class="panel-element" id="panel-element-save-complete">
				<div class="panel-element-save-text"><?php _e('Save Options Complete', 'crunchpress'); ?>.</div>
				<div class="panel-element-save-arrow"></div>
			</div>
				<div class="panel-element">
					<?php 
						if(isset($action) AND $action == 'general_options'){
							$general_logo_xml = '<general_settings>';
							$general_logo_xml = $general_logo_xml . create_xml_tag('header_logo',htmlspecialchars(stripslashes($header_logo)));
							$general_logo_xml = $general_logo_xml . create_xml_tag('logo_width',$logo_width);
							$general_logo_xml = $general_logo_xml . create_xml_tag('logo_height',$logo_height);
							$general_logo_xml = $general_logo_xml . create_xml_tag('select_layout_cp',$select_layout_cp);
							$general_logo_xml = $general_logo_xml . create_xml_tag('boxed_scheme',$boxed_scheme);
							$general_logo_xml = $general_logo_xml . create_xml_tag('select_bg_pat',$select_background_patren);
							$general_logo_xml = $general_logo_xml . create_xml_tag('color_scheme',$color_scheme);
							$general_logo_xml = $general_logo_xml . create_xml_tag('color_anchor',$color_anchor);
							$general_logo_xml = $general_logo_xml . create_xml_tag('bg_scheme',$bg_scheme);
							$general_logo_xml = $general_logo_xml . create_xml_tag('body_patren',$body_patren);
							$general_logo_xml = $general_logo_xml . create_xml_tag('color_patren',$color_patren);
							$general_logo_xml = $general_logo_xml . create_xml_tag('body_image',$body_image);
							$general_logo_xml = $general_logo_xml . create_xml_tag('position_image_layout',$position_image_layout);
							$general_logo_xml = $general_logo_xml . create_xml_tag('image_repeat_layout',$image_repeat_layout);
							$general_logo_xml = $general_logo_xml . create_xml_tag('image_attachment_layout',$image_attachment_layout);
							$general_logo_xml = $general_logo_xml . create_xml_tag('header_css_code',htmlspecialchars(stripslashes($header_css_code)));
							$general_logo_xml = $general_logo_xml . create_xml_tag('topcart_icon',$topcart_icon);
							$general_logo_xml = $general_logo_xml . create_xml_tag('google_webmaster_code',htmlspecialchars(stripslashes($google_webmaster_code)));
							$general_logo_xml = $general_logo_xml . create_xml_tag('phone_contact_header',htmlspecialchars(stripslashes($phone_contact_header)));
							$general_logo_xml = $general_logo_xml . create_xml_tag('social_network_header',$social_network_header);
							$general_logo_xml = $general_logo_xml . create_xml_tag('countd_event_category',$countd_event_category);
							$general_logo_xml = $general_logo_xml . create_xml_tag('copyright_code',htmlspecialchars(stripslashes($copyright_code)));
							//$general_logo_xml = $general_logo_xml . create_xml_tag('homepage_layout_on',$homepage_layout_on);
//							$general_logo_xml = $general_logo_xml . create_xml_tag('section_select_background',$section_select_background);
//							$general_logo_xml = $general_logo_xml . create_xml_tag('section_scheme',$section_scheme);
//							$general_logo_xml = $general_logo_xml . create_xml_tag('section_patren',$section_patren);
//							$general_logo_xml = $general_logo_xml . create_xml_tag('section_body_patren',$section_body_patren);
//							$general_logo_xml = $general_logo_xml . create_xml_tag('home_page_layout',$home_page_layout);
							$general_logo_xml = $general_logo_xml . create_xml_tag('social_networking',$social_networking);
							$general_logo_xml = $general_logo_xml . create_xml_tag('top_count_header',$top_count_header);
							//$general_logo_xml = $general_logo_xml . create_xml_tag('footer_logo',$footer_logo);
							//$general_logo_xml = $general_logo_xml . create_xml_tag('footer_logo_width',$footer_logo_width);
							//$general_logo_xml = $general_logo_xml . create_xml_tag('footer_logo_height',$footer_logo_height);					
							//$general_logo_xml = $general_logo_xml . create_xml_tag('footer_layout',$footer_layout);
							$general_logo_xml = $general_logo_xml . create_xml_tag('footer_banner',htmlspecialchars(stripslashes($footer_banner)));	
							$general_logo_xml = $general_logo_xml . create_xml_tag('footer_col_layout',$footer_col_layout);	
							$general_logo_xml = $general_logo_xml . create_xml_tag('phone_contact',htmlspecialchars(stripslashes($phone_contact)));	
							$general_logo_xml = $general_logo_xml . create_xml_tag('consumer_key',$consumer_key);
							$general_logo_xml = $general_logo_xml . create_xml_tag('consumer_secret',$consumer_secret);
							$general_logo_xml = $general_logo_xml . create_xml_tag('user_token',$user_token);
							$general_logo_xml = $general_logo_xml . create_xml_tag('user_secret',$user_secret);
							$general_logo_xml = $general_logo_xml . create_xml_tag('twitter_id',htmlspecialchars(stripslashes($twitter_id)));
							$general_logo_xml = $general_logo_xml . create_xml_tag('breadcrumbs',$breadcrumbs);	
							$general_logo_xml = $general_logo_xml . create_xml_tag('rtl_layout',$rtl_layout);
							$general_logo_xml = $general_logo_xml . create_xml_tag('tf_username',$tf_username);	
							$general_logo_xml = $general_logo_xml . create_xml_tag('tf_sec_api',$tf_sec_api);	
							$general_logo_xml = $general_logo_xml . '</general_settings>';

							if(!save_option('general_settings', get_option('general_settings'), $general_logo_xml)){
							
								die( json_encode($return_data) );
								
							}
							
							die( json_encode( array('success'=>'0') ) );
							
						}?>
				</div>
	<?php
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
			$topcart_icon = '';
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
			$top_count_header = '';
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
				$topcart_icon = find_xml_value($cp_logo->documentElement,'topcart_icon');
				$header_css_code = find_xml_value($cp_logo->documentElement,'header_css_code');
				$google_webmaster_code = find_xml_value($cp_logo->documentElement,'google_webmaster_code');
				$phone_contact_header = find_xml_value($cp_logo->documentElement,'phone_contact_header');
				$social_network_header = find_xml_value($cp_logo->documentElement,'social_network_header');
				$top_count_header = find_xml_value($cp_logo->documentElement,'top_count_header');
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
			<ul class="logo_tab">
				<li id="logo" class="logo_dimenstion">
					<h3>Logo Settings</h3>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="header_logo" > <?php _e('Logo', 'crunchpress'); ?> </label>
						</li>	
						<?php 
						
							$image_src_head = '';
							
							if(!empty($header_logo)){ 
							
								$image_src_head = wp_get_attachment_image_src( $header_logo, 'full' );
								$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
								//$thumb_src_preview = wp_get_attachment_image_src( $header_logo, '150x150');
								//echo '<img src="' . $thumb_src_preview[0] . '" />';
								
							} 
							
						?>	
						<li class="panel-input">
							<input name="header_logo" type="hidden" class="clearme" id="upload_image_attachment_id" value="<?php echo $header_logo; ?>" />
							<input name="header_link" id="upload_image_text" class="clearme upload_image_text" type="text" value="<?php echo $image_src_head; ?>" />
							<input class="upload_image_button" type="button" value="Upload" />
							<div class="admin-logo-image">
							<?php 
							if(!empty($header_logo)){ 
								$image_src_head = wp_get_attachment_image_src( $header_logo, 'full' );
								$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
								$thumb_src_preview = wp_get_attachment_image_src( $header_logo, array(60,60));
								?>
								<img class="clearme img-class" src="<?php if(!empty($image_src_head)){echo $thumb_src_preview[0];}?>" /><span class="close-me"></span>
								<?php
							} ?>	
							</div>
						</li>
						<li class="description">Upload logo image here, PNG, Gif, JPEG, JPG format supported only.</li>
					</ul>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="logo_width" > <?php _e('Width', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<div id="logo_width" class="sliderbar" rel="logo_bar"></div>
							<input type="hidden" name="logo_width" value="<?php echo $logo_width;?>">
							<div id="slidertext"><?php echo $logo_width;?>px</div>
						</li>
						<li class="description">Please scroll Left to Right to adjust logo image width, you can also use Arrow keys UP,Down - Left,Right.</li>
					</ul>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="logo_height" > <?php _e('Height', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<div id="logo_height" class="sliderbar" rel="logo_bar"></div>
							<input type="hidden" name="logo_height" value="<?php echo $logo_height;?>">
							<div id="slidertext"><?php echo $logo_height;?>px</div>
						</li>
						<li class="description">Please scroll Left to Right to adjust logo image height, you can also use Arrow keys UP,Down - Left,Right.</li>
					</ul>
				</li>
				<li id="color_style" class="style_color_scheme">
					<h3>Style & Color Scheme Settings</h3>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="select_layout_cp"><?php _e('SELECT LAYOUT', 'crunchpress'); ?></label>
						</li>
						<li class="panel-input">	
							<div class="combobox">
								<select name="select_layout_cp" class="select_layout_cp" id="select_layout_cp">
									<option <?php if($select_layout_cp == 'full_layout'){echo 'selected';}?> value="full_layout" class="full_layout">Full Layout</option>
									<option <?php if($select_layout_cp == 'boxed_layout'){echo 'selected';}?> value="boxed_layout" class="box_layout">Box Layout</option>
								</select>
							</div>
						</li>
						<li class="description">Please select website layout Full or Boxed.</li>
					</ul>
					<div class="clear"></div>
					<ul id="boxed_layout" class="panel-body recipe_class ">
						<li class="panel-title">
							<label for="boxed_scheme" > <?php _e('BOXED LAYOUT BACKGROUND', 'crunchpress'); ?> </label>
						</li>				
						<li class="panel-input">
							<input type="text" name="boxed_scheme" class="color-picker" value="<?php if($boxed_scheme <> ''){echo $boxed_scheme;}?>"/>
						</li>
						<li class="description">Please select any color from color palette to use as color scheme, leaving blank color scheme will be auto selected as default.</li>
					</ul>					
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="color_scheme" > <?php _e('MAIN COLOR SCHEME', 'crunchpress'); ?> </label>
						</li>				
						<li class="panel-input">
							<input type="text" name="color_scheme" class="color-picker" value="<?php if($color_scheme <> ''){echo $color_scheme;}?>"/>
						</li>
						<li class="description">Please select any color from color palette to use as color scheme, leaving blank color scheme will be auto selected as default.</li>
					</ul>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="color_anchor" > <?php _e('ANCHOR COLOR', 'crunchpress'); ?> </label>
						</li>				
						<li class="panel-input">
							<input type="text" name="color_anchor" class="color-picker" value="<?php if($color_anchor <> ''){echo $color_anchor;}?>"/>
						</li>
						<li class="description">Please select any color from color palette to use as anchor color scheme, leaving blank color scheme will be auto selected as default.</li>
					</ul>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="select_background_patren"><?php _e('SELECT BACKGROUND TYPE', 'crunchpress'); ?></label>
						</li>
						<li class="panel-input">	
							<div class="combobox">
								<select name="select_background_patren" class="select_background_patren" id="select_background_patren">
									<option <?php if($select_bg_pat == 'Background-Patren'){echo 'selected';}?> value="Background-Patren" class="select_bg_patren">Background Pattern</option>
									<option <?php if($select_bg_pat == 'Background-Color'){echo 'selected';}?> value="Background-Color" class="select_bg_color">Background Color</option>
									<option <?php if($select_bg_pat == 'Background-Image'){echo 'selected';}?> value="Background-Image" class="select_bg_image">Background Image</option>
								</select>
							</div>
						</li>
						<li class="description">Please select background pattern or background color.</li>
					</ul>	
					<div class="clear"></div>
					<ul id="select_bg_color" class="panel-body recipe_class">
						<li class="panel-title">
							<label for="bg_scheme" > <?php _e('BACKGROUND STYLE', 'crunchpress'); ?> </label>
						</li>				
						<li class="panel-input">
							<input type="text" name="bg_scheme" class="color-picker" value="<?php if($bg_scheme <> ''){echo $bg_scheme;}?>"/>
						</li>
						<li class="description">Please select any color from color palette to use as background color, leaving blank background will be auto selected as default background.</li>
					</ul>
					<div class="clear"></div>
					<ul id="select_bg_patren" class="panel-body recipe_class">
						<div class="panel-body-gimmick"></div>
						<li class="panel-title">
							<label for=""><?php _e('BACKGROUND Pattern', 'crunchpress'); ?></label>
						</li>
						<li class="panel-radioimage">
							<?php 
							$options = array(
								'1'=>array('value'=>'1', 'image'=>'/framework/images/pattern/pattern-1.png'),
								'2'=>array('value'=>'2','image'=>'/framework/images/pattern/pattern-2.png'),
								'3'=>array('value'=>'3','image'=>'/framework/images/pattern/pattern-3.png'),
								'4'=>array('value'=>'4','image'=>'/framework/images/pattern/pattern-4.png'),
								'5'=>array('value'=>'5','image'=>'/framework/images/pattern/pattern-5.png'),
								'6'=>array('value'=>'6','image'=>'/framework/images/pattern/pattern-6.png'),
								'7'=>array('value'=>'7','image'=>'/framework/images/pattern/pattern-7.png'),
								'8'=>array('value'=>'8','image'=>'/framework/images/pattern/pattern-8.png'),
								'9'=>array('value'=>'9','image'=>'/framework/images/pattern/pattern-9.png'),
								'10'=>array('value'=>'10','image'=>'/framework/images/pattern/pattern-10.png'),
								'11'=>array('value'=>'11','image'=>'/framework/images/pattern/pattern-11.png'),
								'12'=>array('value'=>'12','image'=>'/framework/images/pattern/pattern-12.png'),
								'13'=>array('value'=>'13','image'=>'/framework/images/pattern/pattern-13.png'),
								'14'=>array('value'=>'14','image'=>'/framework/images/pattern/pattern-14.png'),
								'15'=>array('value'=>'15','image'=>'/framework/images/pattern/pattern-15.png'),
								'16'=>array('value'=>'16','image'=>'/framework/images/pattern/pattern-16.png'),
								'17'=>array('value'=>'17','image'=>'/framework/images/pattern/pattern-17.png'),
								'18'=>array('value'=>'18','image'=>'/framework/images/pattern/pattern-18.png'),
								'19'=>array('value'=>'19','image'=>'/framework/images/pattern/pattern-19.png'),
								'20'=>array('value'=>'20','image'=>'/framework/images/pattern/pattern-20.png'),
								'21'=>array('value'=>'21','image'=>'/framework/images/pattern/pattern-21.png'),
								'22'=>array('value'=>'22','image'=>'/framework/images/pattern/pattern-22.png'),
								'23'=>array('value'=>'23','image'=>'/framework/images/pattern/pattern-45.png'),
							);
							$value = '';
							$default = '';
							foreach( $options as $option ){ 
							?>
								<div class='radio-image-wrapper'>
									<label for="<?php echo $option['value']; ?>">
										<img src=<?php echo CP_PATH_URL.$option['image']?> class="color_patren" alt="color_patren">
										<div id="check-list"></div>                                
									</label>
									<input type="radio" class="checkbox_class" name="color_patren" value="<?php echo $option['image']; ?>" <?php 
										if($color_patren == $option['image']){
											echo 'checked';
										}else if($color_patren == '' && $default == $option['image']){
											echo 'checked';
										}
									?> id="<?php echo $option['value']; ?>" class=""
									>                            
								</div>
							<?php } ?>
							<br class="clear">	
						</li>
						<li class="description">Please select any pattern from pattern listing to use as background pattern.</li>
					</ul>	
					<ul id="bg_upload_id" class="recipe_class">	
						<div class="clear"></div>
						<li class="panel-title">
							<label for="body_patren" > <?php _e('Upload Background Pattern', 'crunchpress'); ?> </label>
						</li>	
						<?php 
							$image_src_head = '';
							if(!empty($body_patren)){ 
								$image_src_head = wp_get_attachment_image_src( $body_patren, 'full' );
								$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
								$thumb_src_preview = wp_get_attachment_image_src( $body_patren, array(60,60));
								echo '<img src="' . $thumb_src_preview[0] . '" />';
							} 
						?>	
						<li class="panel-input">
							<input name="body_patren" class="emptyme" type="hidden" id="upload_image_attachment_id" value="<?php echo $body_patren; ?>" />
							<input id="upload_image_text" class="emptyme upload_image_text" type="text" value="<?php echo $image_src_head; ?>" />
							<input class="upload_image_button" type="button" value="Upload" />
						</li>
						<li class="description">Upload background pattern for your theme this option provide you access to put your own image to use as background pattern.</li>
					</ul>	
					<ul id="image_upload_id" class="recipe_class">	
						<div class="clear"></div>
						<li class="panel-title">
							<label for="body_image" > <?php _e('Upload Background Image', 'crunchpress'); ?> </label>
						</li>	
						<?php 
							$image_src_head = '';
							if(!empty($body_image)){ 
								$image_src_head = wp_get_attachment_image_src( $body_image, 'full' );
								$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
								$thumb_src_preview = wp_get_attachment_image_src( $body_image, array(60,60));
								echo '<img src="' . $thumb_src_preview[0] . '" />';
							} 
						?>	
						<li class="panel-input">
							<input name="body_image" class="emptyme" type="hidden" id="upload_image_attachment_id" value="<?php echo $body_image; ?>" />
							<input id="upload_image_text" class="emptyme upload_image_text" type="text" value="<?php echo $image_src_head; ?>" />
							<input class="upload_image_button" type="button" value="Upload" />
						</li>
						<li class="description">Upload background Image for your theme this option provide you access to put your own image to use as background Image.</li>
					</ul>
					<div class="clear"></div>
					<ul class="recipe_class image_upload_options">
						<li class="panel-title">
							<label for="position_image_layout"><?php _e('Image Position', 'crunchpress'); ?></label>
						</li>
						<li class="panel-radioimage panel-input">
							<?php 
							
							//Radio Image Area for Widget layout
							
							//'1'=>array('value'=>'footer-style1','image'=>'/framework/images/footer-style1.png'),
							//'2'=>array('value'=>'footer-style2','image'=>'/framework/images/footer-style2.png'),
							//'3'=>array('value'=>'footer-style3','image'=>'/framework/images/footer-style3.png'),
							//'4'=>array('value'=>'footer-style4','image'=>'/framework/images/footer-style4.png'),
							//'5'=>array('value'=>'footer-style5','image'=>'/framework/images/footer-style5.png'),
							//'6'=>array('value'=>'footer-style6','image'=>'/framework/images/footer-style6.png'),
							
							$value = '';
							$options = array(
								'1'=>array('value'=>'left','image'=>'/framework/images/background/left.png'),
								'2'=>array('value'=>'center','image'=>'/framework/images/background/center.png'),
								'3'=>array('value'=>'right','image'=>'/framework/images/background/right.png'),
							);
							foreach( $options as $option ){ ?>
								<div class='radio-image-wrapper'>
									<label for="<?php echo $option['value']; ?>">
										<img src=<?php echo CP_PATH_URL.$option['image']?> class="position_image_layout" alt="Image Position" />
										<div id="check-list"></div>                                
									</label>
									<input type="radio" name="position_image_layout" value="<?php echo $option['value']; ?>" id="<?php echo $option['value']; ?>" class="dd"
									<?php 
										if($position_image_layout == $option['value']){
											echo 'checked';
										}
									?>
									
									>                            
								</div>
								
							<?php } ?>
							<br class="clear">	
						</li>
						<li class="description">You can manage background image position in this area.</li>
					</ul>
					<div class="clear"></div>
					<ul class="recipe_class image_upload_options">
						<li class="panel-title">
							<label for="image_repeat_layout"><?php _e('Image Repeat', 'crunchpress'); ?></label>
						</li>
						<li class="panel-radioimage panel-input">
							<?php 
							
							//Radio Image Area for Widget layout
							
							//'1'=>array('value'=>'footer-style1','image'=>'/framework/images/footer-style1.png'),
							//'2'=>array('value'=>'footer-style2','image'=>'/framework/images/footer-style2.png'),
							//'3'=>array('value'=>'footer-style3','image'=>'/framework/images/footer-style3.png'),
							//'4'=>array('value'=>'footer-style4','image'=>'/framework/images/footer-style4.png'),
							//'5'=>array('value'=>'footer-style5','image'=>'/framework/images/footer-style5.png'),
							//'6'=>array('value'=>'footer-style6','image'=>'/framework/images/footer-style6.png'),
							
							$value = '';
							$options = array(
								'1'=>array('value'=>'no-repeat','image'=>'/framework/images/background/no-repeat.png'),
								'2'=>array('value'=>'repeat-x','image'=>'/framework/images/background/repeat-x.png'),
								'3'=>array('value'=>'repeat-y','image'=>'/framework/images/background/repeat-y.png'),
								'4'=>array('value'=>'repeat','image'=>'/framework/images/background/repeat.png'),
							);
							foreach( $options as $option ){ ?>
								<div class='radio-image-wrapper'>
									<label for="<?php echo $option['value']; ?>">
										<img src=<?php echo CP_PATH_URL.$option['image']?> class="image_repeat_layout" alt="Repeat Image" />
										<div id="check-list"></div>                                
									</label>
									<input type="radio" name="image_repeat_layout" value="<?php echo $option['value']; ?>" id="<?php echo $option['value']; ?>" class="dd"
									<?php 
										if($image_repeat_layout == $option['value']){
											echo 'checked';
										}
									?>
									
									>                            
								</div>
								
							<?php } ?>
							<br class="clear">	
						</li>
						<li class="description">You can manage your image repeat whether its repeated horizontal verticle or both.</li>
					</ul>
					<div class="clear"></div>
					<ul class="recipe_class image_upload_options">
						<li class="panel-title">
							<label for="image_attachment_layout"><?php _e('Image Attachment', 'crunchpress'); ?></label>
						</li>
						<li class="panel-radioimage panel-input">
							<?php 
							
							//Radio Image Area for Widget layout
							
							//'1'=>array('value'=>'footer-style1','image'=>'/framework/images/footer-style1.png'),
							//'2'=>array('value'=>'footer-style2','image'=>'/framework/images/footer-style2.png'),
							//'3'=>array('value'=>'footer-style3','image'=>'/framework/images/footer-style3.png'),
							//'4'=>array('value'=>'footer-style4','image'=>'/framework/images/footer-style4.png'),
							//'5'=>array('value'=>'footer-style5','image'=>'/framework/images/footer-style5.png'),
							//'6'=>array('value'=>'footer-style6','image'=>'/framework/images/footer-style6.png'),
							
							$value = '';
							$options = array(
								'1'=>array('value'=>'fixed','image'=>'/framework/images/background/fixed.png'),
								'2'=>array('value'=>'scroll','image'=>'/framework/images/background/scroll.png'),
							);
							foreach( $options as $option ){ ?>
								<div class='radio-image-wrapper'>
									<label for="<?php echo $option['value']; ?>">
										<img src=<?php echo CP_PATH_URL.$option['image']?> class="image_attachment_layout" alt="Attachment Image" />
										<div id="check-list"></div>                                
									</label>
									<input type="radio" name="image_attachment_layout" value="<?php echo $option['value']; ?>" id="<?php echo $option['value']; ?>" class="dd"
									<?php 
										if($image_attachment_layout == $option['value']){
											echo 'checked';
										}
									?>
									
									>                            
								</div>
								
							<?php } ?>
							<br class="clear">	
						</li>
						<li class="description">You can manage your background image attachment fixed or scroll.</li>
					</ul>					
				</li>
				<li id="hr_settings" class="logo_dimenstion">
					<h3>Header Settings</h3>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="" ><?php _e('TOP CART', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<label for="topcart_icon"><div class="checkbox-switch <?php
							
							echo ($topcart_icon=='enable' || ($topcart_icon=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

						?>"></div></label>
						<input type="checkbox" name="topcart_icon" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="topcart_icon" id="topcart_icon" class="checkbox-switch" value="enable" <?php 
							
							echo ($topcart_icon=='enable' || ($topcart_icon=='' && empty($default)))? 'checked': ''; 
						
						?>>
						</li>
						<li class="description">You can turn On/Off Top Cart Baskit from Header.</li>
					</ul>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="header_css_code" > <?php _e('HEADER CODE', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<textarea name="header_css_code" id="header_css_code" ><?php echo ($header_css_code == '')? esc_textarea($header_css_code): esc_textarea($header_css_code);?></textarea>
						</li>
						<li class="description">Please write css code for you theme if you want to put some extra code in css for styling purpose only.</li>
					</ul>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="google_webmaster_code" > <?php _e('GOOGLE WEBMASTER VERIFY CODE', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<textarea name="google_webmaster_code" id="google_webmaster_code" ><?php if($google_webmaster_code <> '') { echo esc_textarea($google_webmaster_code);}?></textarea>
						</li>
						<li class="description">Please paste google, Bing, yahoo etc analytics code here to validate your site in webmaster.</li>
					</ul>
					<div class="clear"></div>
					
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="phone_contact_header" > <?php _e('CONTACT DETAIL', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<input type="text" name="phone_contact_header" id="phone_contact_header" value="<?php echo ($phone_contact_header == '')? esc_html($phone_contact_header): esc_html($phone_contact_header);?>" />
						</li>
						<li class="description">Please paste here your contact detail.</li>
					</ul>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="" ><?php _e('SOCIAL NETWORK', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<label for="social_network_header"><div class="checkbox-switch <?php
							
							echo ($social_network_header=='enable' || ($social_network_header=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

						?>"></div></label>
						<input type="checkbox" name="social_network_header" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="social_network_header" id="social_network_header" class="checkbox-switch" value="enable" <?php 
							
							echo ($social_network_header=='enable' || ($social_network_header=='' && empty($default)))? 'checked': ''; 
						
						?>>
						</li>
						<li class="description">You can turn On/Off header social network.</li>
					</ul>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="" ><?php _e('TOP COUNTER', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<label for="top_count_header"><div class="checkbox-switch <?php
							
							echo ($top_count_header=='enable' || ($top_count_header=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

						?>"></div></label>
						<input type="checkbox" name="top_count_header" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="top_count_header" id="top_count_header" class="checkbox-switch" value="enable" <?php 
							
							echo ($top_count_header=='enable' || ($top_count_header=='' && empty($default)))? 'checked': ''; 
						
						?>>
						</li>
						<li class="description">You can turn On/Off header top counter.</li>
					</ul>
					<div class="clear"></div>					
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="countd_event_category" > <?php _e('SELECT EVENT', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">	
							<div class="combobox">
								<select name="countd_event_category" class="countd_event_category" id="countd_event_category">
								<?php foreach(get_title_list_array('events') as $values)?>
									<option <?php if($values->ID == $countd_event_category){echo 'selected';}?> value="<?php echo $values->ID;?>"><?php echo $values->post_title?></option>
								</select>
							</div>
						</li>
						<li class="description">Please select event to show latest event to show in event countdown.</li>
					</ul>
					<div class="clear"></div>	
					
				</li>
				<li id="ft_settings" class="logo_dimenstion">
					<h3>Footer Settings</h3>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="consumer_key" > <?php _e('Consumer Key', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<input type="text" name="consumer_key" id="consumer_key" value="<?php echo ($consumer_key == '')? esc_html($consumer_key): esc_html($consumer_key);?>" />
						</li>
						<li class="description">Please enter your Consumer Key Here.</li>
					</ul>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="consumer_secret" > <?php _e('Consumer Secret Key', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<input type="text" name="consumer_secret" id="consumer_secret" value="<?php echo ($consumer_secret == '')? esc_html($consumer_secret): esc_html($consumer_secret);?>" />
						</li>
						<li class="description">Please enter your Consumer Secret Key here here.</li>
					</ul>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="user_token" > <?php _e('User Token', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<input type="text" name="user_token" id="user_token" value="<?php echo ($user_token == '')? esc_html($user_token): esc_html($user_token);?>" />
						</li>
						<li class="description">Please enter your User Token here.</li>
					</ul>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="user_secret" > <?php _e('User Secret Token', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<input type="text" name="user_secret" id="user_secret" value="<?php echo ($user_secret == '')? esc_html($user_secret): esc_html($user_secret);?>" />
						</li>
						<li class="description">Please enter your User Secret Token title here.</li>
					</ul>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="twitter_id" > <?php _e('Twitter ID', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<input type="text" name="twitter_id" id="twitter_id" value="<?php echo ($twitter_id == '')? esc_html($twitter_id): esc_html($twitter_id);?>" />
						</li>
						<li class="description">Please enter your news headline title here.</li>
					</ul>
					<div class="clear"></div>								
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="" ><?php _e('Search & Social Icons', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<label for="social_networking"><div class="checkbox-switch <?php
							
							echo ($social_networking=='enable' || ($social_networking=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

						?>"></div></label>
						<input type="checkbox" name="social_networking" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="social_networking" id="social_networking" class="checkbox-switch" value="enable" <?php 
							
							echo ($social_networking=='enable' || ($social_networking=='' && empty($default)))? 'checked': ''; 
						
						?>>
						</li>
						<li class="description">You can turn On/Off footer social networking profile icons.</li>
					</ul>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="copyright_code" > <?php _e('COPY RIGHT TEXT', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<input type="text" name="copyright_code" id="copyright_code" value="<?php echo ($copyright_code == '')? esc_html($copyright_code): esc_html($copyright_code);?>" />
						</li>
						<li class="description">Please paste here your copy right text.</li>
					</ul>
					<!--<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="footer_logo" > <?php _e('FOOTER LOGO', 'crunchpress'); ?> </label>
						</li>	
						<?php 
						
							$image_src = '';
							
							if(!empty($footer_logo)){ 
							
								$image_src = wp_get_attachment_image_src( $footer_logo, 'full' );
								$image_src = (empty($image_src))? '': $image_src[0];
								//$thumb_src_preview = wp_get_attachment_image_src( $footer_logo, '150x150');
								//echo '<img src="' . $thumb_src_preview[0] . '" />';
								
							} 
							
						?>	
						<li class="panel-input">
							<input name="footer_logo" class="clearme" type="hidden" id="upload_image_attachment_id" value="<?php echo $footer_logo; ?>" />
							<input id="upload_image_text" class="clearme upload_image_text" type="text" value="<?php echo $image_src; ?>" />
							<input class="upload_image_button" type="button" value="Upload" />
							<div class="admin-logo-image">
							<?php 
							if(!empty($footer_logo)){ 
								$image_src_head = wp_get_attachment_image_src( $footer_logo, 'full' );
								$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
								$thumb_src_preview = wp_get_attachment_image_src( $footer_logo, array(60,60));?>
									<img class="clearme img-class" src="<?php if(!empty($image_src_head)){echo $thumb_src_preview[0];}?>" /><span class="close-me"></span>
							<?php } ?>	
							</div>
						</li>
						<li class="description">Upload footer logo image here, PNG, Gif, JPEG, JPG format supported only.</li>
					</ul>					
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="footer_logo_width" > <?php _e('Width', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<div id="footer_logo_width" class="sliderbar" rel="logo_bar"></div>
							<input type="hidden" name="footer_logo_width" value="<?php echo $footer_logo_width;?>">
							<div id="slidertext"><?php echo $footer_logo_width;?>px</div>
						</li>
						<li class="description">Please scroll Left to Right to adjust footer logo image width, you can also use Arrow keys UP, Down - Left, Right.</li>
					</ul>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="footer_logo_height" > <?php _e('Height', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<div id="footer_logo_height" class="sliderbar" rel="logo_bar"></div>
							<input type="hidden" name="footer_logo_height" value="<?php echo $footer_logo_height;?>">
							<div id="slidertext"><?php echo $footer_logo_height;?>px</div>
						</li>
						<li class="description">Please scroll Left to Right to adjust footer logo image height, you can also use Arrow keys UP,Down - Left,Right.</li>
					</ul>
					<ul class="recipe_class">
						<li class="panel-title">
							<label for="footer_layout"><?php _e('Footer Layout', 'crunchpress'); ?></label>
						</li>
						<li class="panel-radioimage panel-input">
							<?php 
							
							//Radio Image Area for Widget layout
							
							//'1'=>array('value'=>'footer-style1','image'=>'/framework/images/footer-style1.png'),
							//'2'=>array('value'=>'footer-style2','image'=>'/framework/images/footer-style2.png'),
							//'3'=>array('value'=>'footer-style3','image'=>'/framework/images/footer-style3.png'),
							//'4'=>array('value'=>'footer-style4','image'=>'/framework/images/footer-style4.png'),
							//'5'=>array('value'=>'footer-style5','image'=>'/framework/images/footer-style5.png'),
							//'6'=>array('value'=>'footer-style6','image'=>'/framework/images/footer-style6.png'),
							
							$value = '';
							$options = array(
								'1'=>array('value'=>'footer_col_4','image'=>'/framework/images/footer-style1.png'),
								'2'=>array('value'=>'footer_col_3','image'=>'/framework/images/footer-style6.png'),
							);
							foreach( $options as $option ){ ?>
								<div class='radio-image-wrapper'>
									<label for="<?php echo $option['value']; ?>">
										<img src=<?php echo CP_PATH_URL.$option['image']?> class="footer_layout" alt="footer_layout" />
										<div id="check-list"></div>                                
									</label>
									<input type="radio" name="footer_layout" value="<?php echo $option['value']; ?>" id="<?php echo $option['value']; ?>" class="dd"
									<?php 
										if($footer_layout == $option['value']){
											echo 'checked';
										}
									?>
									
									>                            
								</div>
								
							<?php } ?>
							<br class="clear">	
						</li>
						<li class="description">You can change your footer widget area from here, 2 Options given 3 Column and 4 Column.</li>
					</ul>-->
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="footer_banner" > <?php _e('FOOTER BANNER TEXT', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<textarea name="footer_banner" id="footer_banner" ><?php echo ($footer_banner == '')? esc_textarea($footer_banner): esc_textarea($footer_banner);?></textarea>
						</li>
						<li class="description">Please enter footer banner text to show above the footer.</li>
					</ul>
					<ul class="recipe_class">
						<li class="panel-title">
							<label for=""><?php _e('Footer Widget Layout', 'crunchpress'); ?></label>
						</li>
						<li class="panel-radioimage panel-input">
							<?php 
							$value = '';
							$options = array(
								'1'=>array('value'=>'home_4_col','image'=>'/framework/images/footer-style1.png'),
								'2'=>array('value'=>'home_3_col','image'=>'/framework/images/footer-style6.png'),
							);
							foreach( $options as $option ){ ?>
								<div class='radio-image-wrapper'>
									<label for="<?php echo $option['value']; ?>">
										<img src=<?php echo CP_PATH_URL.$option['image']?> class="footer_col_layout" alt="footer_col_layout" />
										<div id="check-list"></div>                                
									</label>
									<input type="radio" name="footer_col_layout" value="<?php echo $option['value']; ?>" id="<?php echo $option['value']; ?>" class="dd"
									<?php 
										if($footer_col_layout == $option['value']){
											echo 'checked';
										}
									?>
									>                            
								</div>
							<?php } ?>
							<br class="clear">	
						</li>
						<li class="description">Please select home page layout style.</li>
					</ul>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="phone_contact" > <?php _e('CONTACT DETAIL', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<input type="text" name="phone_contact" id="phone_contact" value="<?php echo ($phone_contact == '')? esc_html($phone_contact): esc_html($phone_contact);?>" />
						</li>
						<li class="description">Please paste here your contact detail.</li>
					</ul>
				</li>
				<li id="misc_settings" class="misc_settings">
				<h3>Responsive/Breadcrumbs Settings</h3>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="" > <?php _e('BREADCRUMBS', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<label for="breadcrumbs"><div class="checkbox-switch <?php
							
							echo ($breadcrumbs=='enable' || ($breadcrumbs=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

						?>"></div></label>
						<input type="checkbox" name="breadcrumbs" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="breadcrumbs" id="breadcrumbs" class="checkbox-switch" value="enable" <?php 
							
							echo ($breadcrumbs=='enable' || ($breadcrumbs=='' && empty($default)))? 'checked': ''; 
						
						?>>
						</li>
						<li class="description">You can turn On/Off BreadCrumbs from Top of the page.</li>
					</ul>
					<div class="clear"></div>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="rtl_layout" > <?php _e('RTL LAYOUTS', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<label for="rtl_layout"><div class="checkbox-switch <?php
							
							echo ($rtl_layout=='enable' || ($rtl_layout=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

						?>"></div></label>
						<input type="checkbox" name="rtl_layout" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="rtl_layout" id="rtl_layout" class="checkbox-switch" value="enable" <?php 
							
							echo ($rtl_layout=='enable' || ($rtl_layout=='' && empty($default)))? 'checked': ''; 
						
						?>>
						</li>
						<li class="description">You can turn On/Off RTL Layout of website.</li>
					</ul>
				</li>
				<?php if(!class_exists( 'Envato_WordPress_Theme_Upgrader' )){}else{?>
				<li id="envato_api" class="envato_api">
				<h3>ENVATO Username & API Key Settings</h3>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="tf_username" > <?php _e('Username', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<input type="text" name="tf_username" id="tf_username" value="<?php echo ($tf_username == '')? esc_html($tf_username): esc_html($tf_username);?>" />
						</li>
						<li class="description">Please enter your Theme Forest username. <br /> For example: denonstudio</li>
					</ul>
					<ul class="panel-body recipe_class">
						<li class="panel-title">
							<label for="tf_sec_api" > <?php _e('API Key', 'crunchpress'); ?> </label>
						</li>	
						<li class="panel-input">
							<input type="text" name="tf_sec_api" id="tf_sec_api" value="<?php echo ($tf_sec_api == '')? esc_html($tf_sec_api): esc_html($tf_sec_api);?>" />
						</li>
						<li class="description">Please paste here your theme forest Secret API Key. <br />For example: xxxxxxxav7hny3p1ptm7xxxxxxxx</li>
					</ul>
				</li>
			<?php }?>
			</ul>
			<div class="clear"></div>
			<div class="panel-element-tail">
				<div class="tail-save-changes">
					<div class="loading-save-changes"></div>
					<input type="submit" value="<?php echo __('Save Changes','crunchpress') ?>">
					<input type="hidden" name="action" value="general_options">				
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
