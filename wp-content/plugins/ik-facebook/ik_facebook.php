<?php
/*
Plugin Name: IK Facebook Plugin
Plugin URI: http://iksocialpro.com/the-ik-facebook-plugin/
Description: IK Facebook Plugin - A Facebook Solution for WordPress
Author: Illuminati Karate, Inc.
Version: 2.3
Author URI: http://illuminatikarate.com

This file is part of the IK Facebook Plugin.

The IK Facebook Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

The IK Facebook Plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with the IK Facebook Plugin .  If not, see <http://www.gnu.org/licenses/>.
*/
include('include/widgets/ik_facebook_feed_widget.php');
include('include/ik_facebook_options.php');
include('include/lib/CachedCurl.php');
include('include/lib/lib.php');
include('include/lib/ik_social_pro.php');
$ik_fb_options = new ikFacebookOptions();

//use this to track if css/powered by have been output
global $ikfb_footer_css_output;
global $ikfb_footer_poweredby_output;

class ikFacebook
{
	var $authToken;

	function __construct(){
		//create shortcodes
		add_shortcode('ik_fb_feed', array($this, 'ik_fb_output_feed_shortcode'));
		add_shortcode('ik_fb_gallery', array($this, 'ik_fb_output_gallery_shortcode'));
		add_shortcode('ik_fb_like_button', array($this, 'ik_fb_output_like_button'));

		//add CSS
		add_action( 'wp_enqueue_scripts', array($this, 'ik_fb_setup_css'));
		add_action( 'wp_footer', array($this, 'ik_fb_setup_custom_css'));
		add_action( 'wp_enqueue_scripts', array($this, 'ik_fb_setup_custom_theme_css'));

		//register sidebar widgets
		add_action( 'widgets_init', array($this, 'ik_fb_register_widgets' ));

		//display "powered by"
		add_action('wp_footer', array($this, 'ik_fb_show_powered_by' ));
	}

	//register any widgets here
	function ik_fb_register_widgets() {
		register_widget( 'ikFacebookFeedWidget' );
	}
	
	//add Basic CSS
	function ik_fb_setup_css() {
		wp_register_style( 'ik_facebook_style', plugins_url('include/css/style.css', __FILE__) );
		wp_register_style( 'ik_facebook_dark_style', plugins_url('include/css/dark_style.css', __FILE__) );
		wp_register_style( 'ik_facebook_light_style', plugins_url('include/css/light_style.css', __FILE__) );
		wp_register_style( 'ik_facebook_blue_style', plugins_url('include/css/blue_style.css', __FILE__) );
		wp_register_style( 'ik_facebook_no_style', plugins_url('include/css/no_style.css', __FILE__) );
		wp_register_style( 'ik_facebook_gallery_style', plugins_url('include/css/gallery.css', __FILE__) );
		
		switch(get_option('ik_fb_feed_theme')){
			case 'dark_style':
				wp_enqueue_style( 'ik_facebook_dark_style' );
				wp_enqueue_style( 'ik_facebook_gallery_style' );
				break;
			case 'light_style':
				wp_enqueue_style( 'ik_facebook_light_style' );
				wp_enqueue_style( 'ik_facebook_gallery_style' );
				break;
			case 'blue_style':
				wp_enqueue_style( 'ik_facebook_blue_style' );
				wp_enqueue_style( 'ik_facebook_gallery_style' );
				break;
			case 'no_style':
				wp_enqueue_style( 'ik_facebook_no_style' );
				break;
			case 'default_style':
			default:
				wp_enqueue_style( 'ik_facebook_style' );
				wp_enqueue_style( 'ik_facebook_gallery_style' );
				break;
		}
	}

	//add Custom CSS
	function ik_fb_setup_custom_css() {
		//use this to track if css has been output
		global $ikfb_footer_css_output;
		
		if($ikfb_footer_css_output){
			return;
		} else {
			echo '<style type="text/css" media="screen">' . get_option('ik_fb_custom_css') . "</style>";
			$ikfb_footer_css_output = true;
		}
	}
	
	//add Custom CSS from Theme
	function ik_fb_setup_custom_theme_css() {
		//only enqueue CSS if it's there
		if(file_exists(get_stylesheet_directory() . '/ik_fb_custom_style.css' )){
			wp_register_style( 'ik_facebook_custom_style', get_stylesheet_directory_uri() . '/ik_fb_custom_style.css' );
			wp_enqueue_style( 'ik_facebook_custom_style' );
		}
	}
	
	//generates the like button HTML
	function ik_fb_like_button($url, $height = "45", $colorscheme = "light"){
		return '<iframe id="like_button" src="//www.facebook.com/plugins/like.php?href='.urlencode($url).'&amp;layout=standard&amp;show_faces=false&amp;action=like&amp;colorscheme='.$colorscheme.'&amp;height='.$height.'" scrolling="no" frameborder="0" allowTransparency="true"></iframe>';//add facebook like button
	}
	
	//output the like button
	function ik_fb_output_like_button($atts){		
		//load shortcode attributes into an array
		extract( shortcode_atts( array(
			'url' => site_url(),
			'height' => '45',
			'colorscheme' => 'light'
		), $atts ) );
		
		return $this->ik_fb_like_button($url,$height,$colorscheme);
	}
	
	function ik_fb_output_feed_shortcode($atts){			
		//load shortcode attributes into an array
		extract( shortcode_atts( array(
			'colorscheme' => 'light',
			'width' => get_option('ik_fb_feed_image_width'),
			'height' => get_option('ik_fb_feed_image_height'),
			'use_thumb' => !get_option('ik_fb_fix_feed_image_width') && !get_option('ik_fb_fix_feed_image_height'),
			'num_posts' => null,
			'id' => false
		), $atts ) );
		
		return $this->ik_fb_output_feed($colorscheme, $use_thumb, $width, false, $height, $num_posts, $id);				
	}
	
	function ik_fb_output_gallery_shortcode($atts){			
		//load shortcode attributes into an array
		extract( shortcode_atts( array(
			'id' => '',
			'size' => '320x180',
			'show_name' => true,
			'title' => null
		), $atts ) );
		
		return $this->ik_fb_output_gallery($id, $size, $show_name, $title);				
	}
	
	public function ik_fb_output_gallery($id = '', $size = '320x180', $show_name = true, $the_title = null){
		$output = '';
		
		$app_id = get_option('ik_fb_app_id');
		$app_secret = get_option('ik_fb_secret_key');
		
		$size_array = array(
			'2048x1152' => 0,
			'960x540' => 1,
			'720x405' => 2,
			'600x337' => 3,
			'480x270' => 4,
			'320x180' => 5,
			'130x73' => 7
		);
		
		$width_array = array (
			'2048x1152' => '1152px',
			'960x540' => '540px',
			'720x405' => '405px',
			'600x337' => '337px',
			'480x270' => '270px',
			'320x180' => '180px',
			'130x73' => '73px'
		);
		
		$height_array = array (
			'2048x1152' => '2048px',
			'960x540' => '960px',
			'720x405' => '720px',
			'600x337' => '600px',
			'480x270' => '480px',
			'320x180' => '320px',
			'130x73' => '130px'
		);
		
		$position = $size_array[$size];
		
		if(!isset($this->authToken)){
			$this->authToken = $this->fetchUrl("https://graph.facebook.com/oauth/access_token?type=client_cred&client_id={$app_id}&client_secret={$app_secret}");
		}
		
		$gallery = $this->fetchUrl("https://graph.facebook.com/{$id}/photos?{$this->authToken}", true);//the gallery data
		
		ob_start();
		
		echo '<div class="ik_fb_gallery_standard">';
		
		if(isset($the_title)){
			echo '<span class="ik_fb_gallery_standard_title">' . $the_title . '</span>';
		}
		
		foreach($gallery->data as $gallery_item){
			echo '<div class="ik_fb_gallery_item" style="width:'.$width_array[$size].';height:'.$height_array[$size].';">';
			
				echo '<a href="'.$gallery_item->source.'" target="_blank" title="Click to View Full Sized Photo"><img class="ik_fb_standard_image" src="'.$gallery_item->images[$position]->source.'" /></a>';
				
				if($show_name){
					echo '<p class="ik_fb_standard_image_name">' . $gallery_item->name . '</p>';
				}
			
			echo '</div>';
		}
		
		echo '</div>';
		
		$output = ob_get_contents();
		
		ob_end_clean();
		
		return $output;
	}
	
	//facebook feed
	public function ik_fb_output_feed($colorscheme = "light", $use_thumb = true, $width = "", $is_sidebar_widget = false, $height = "", $num_posts = -1, $id = false){		
		//load facebook data
		$fbData = $this->loadFacebook($id);
		
		$feed = $fbData['feed'];
		$page_data = $fbData['page_data'];
		
		$ik_fb_header_bg_color = strlen(get_option('ik_fb_header_bg_color')) > 2 && !get_option('ik_fb_use_custom_html') ? get_option('ik_fb_header_bg_color') : '';
		$ik_fb_window_bg_color = strlen(get_option('ik_fb_window_bg_color')) > 2 && !get_option('ik_fb_use_custom_html') ? get_option('ik_fb_window_bg_color') : '';
		
		//use different heigh/width styling options, if this is the sidebar widget
		if(!$is_sidebar_widget){
			$ik_fb_feed_height = strlen(get_option('ik_fb_feed_window_height')) > 0 && !get_option('ik_fb_use_custom_html') ? get_option('ik_fb_feed_window_height') : '';
			$ik_fb_feed_width = strlen(get_option('ik_fb_feed_window_width')) > 0 && !get_option('ik_fb_use_custom_html') ? get_option('ik_fb_feed_window_width') : '';
		} else {
			$ik_fb_feed_height = strlen(get_option('ik_fb_sidebar_feed_window_height')) > 0 && !get_option('ik_fb_use_custom_html') ? get_option('ik_fb_sidebar_feed_window_height') : '';
			$ik_fb_feed_width = strlen(get_option('ik_fb_sidebar_feed_window_width')) > 0 && !get_option('ik_fb_use_custom_html') ? get_option('ik_fb_sidebar_feed_window_width') : '';
		}
		
		//something went wrong!
		if(count($feed)<1){
			$output = "<p class='ik_fb_error'>IK FB: Please check your settings.</p>";
			return $output;
		}
		
		//feed window width
		$custom_styling_1 = ' style="';
		if(is_valid_key(get_option('ik_fb_pro_key'))){
			if(strlen($ik_fb_feed_width)>0){
				$custom_styling_1 .= "width: {$ik_fb_feed_width}px;";
			}	
			if(strlen($ik_fb_feed_height)>0){		
				$custom_styling_1 .= "height: auto; ";
			}
		}
		$custom_styling_1 .= '"';
		
		//feed window height, feed window bg color
		$custom_styling_2 = ' style="';
		if(is_valid_key(get_option('ik_fb_pro_key'))){
			if(strlen($ik_fb_feed_height)>0){		
				$custom_styling_2 .= "height: {$ik_fb_feed_height}px; ";
			}
			if(strlen($ik_fb_window_bg_color)>0){
				$custom_styling_2 .= " background-color: {$ik_fb_window_bg_color};";
			}
		}		
		
		$custom_styling_2 .= '"';
		
		//feed heading bg color
		$custom_styling_3 = ' style="';
		if(is_valid_key(get_option('ik_fb_pro_key'))){
			if(strlen($ik_fb_header_bg_color)>0){
				$custom_styling_3 .= "background-color: {$ik_fb_header_bg_color};";
			}
		}
		$custom_styling_3 .= '"';
		
		$default_html = '<div id="ik_fb_widget" ' . $custom_styling_1 . ' ><div id="ik_fb_widget_top" ' . $custom_styling_3 . ' ><div class="ik_fb_profile_picture">{ikfb:image}{ikfb:link}</div>{ikfb:like_button}</div><ul class="ik_fb_feed_window" ' . $custom_styling_2 . ' >{ikfb:feed}</ul></div>';
		
		//load custom HTML structure from Pro Plugin, if available and enabled
		$output = strlen(get_option('ik_fb_feed_html')) > 2 && get_option('ik_fb_use_custom_html') ? get_option('ik_fb_feed_html') : $default_html;		
		
		//only display photo if option is set
		if(get_option('ik_fb_show_profile_picture')){
			//use the username if available, otherwise fallback to page ID
			if(isset($page_data->username)){
				$replace = '<img src="//graph.facebook.com/'.$page_data->username.'/picture" />';
				$output = str_replace('{ikfb:image}', $replace, $output);
			} else {
				$replace = '<img src="//graph.facebook.com/'.$page_data->id.'/picture" />';
				$output = str_replace('{ikfb:image}', $replace, $output);
			}
		} else {
			$output = str_replace('{ikfb:image}', '', $output);
		}
		
		
		//only display title if option is set
		if(get_option('ik_fb_show_page_title')){
			/*
			//use the link if set, else fall back to /pages/name/id
			if(isset($page_data->link)){
				$the_link = $this->addhttp($page_data->link);
			} else {
			*/
				$the_link = "https://www.facebook.com/pages/".$page_data->name."/".$page_data->id;
			//}
			
			$replace = '<a target="_blank" href="'.$the_link.'"><span class="ik_fb_name">'.$page_data->name.'</span></a>';	
			$output = str_replace('{ikfb:link}', $replace, $output);	
		} else {
			/*
			//use the link if set, else fall back to /pages/name/id
			if(isset($page_data->link)){
				$the_link = $this->addhttp($page_data->link);
			} else {
			*/
				$the_link = "https://www.facebook.com/pages/".$page_data->name."/".$page_data->id;
			//}
			
			$output = str_replace('{ikfb:link}', '', $output);	
		}

		//only show like button if enabled in settings
		if(get_option('ik_fb_show_like_button')){
			$replace = $this->ik_fb_like_button($the_link, "45", $colorscheme);
			$output = str_replace('{ikfb:like_button}', $replace, $output);		
		} else {
			$output = str_replace('{ikfb:like_button}', '', $output);		
		}

		//build line items to replace with
		$replace = '';
		
		if(count($feed)>0){//check to see if feed data is set
			//see if a limit is set in the options
			if(!$num_posts){
				$limit = get_option('ik_fb_feed_limit');
			} else {
				$limit = $num_posts;
			}
			$count = 0;
			
			if(!is_numeric($limit)){				
				$limit = -1;
			}
			
			foreach($feed as $item){//$item is the feed object				
				if($limit == -1 || $count < $limit){
					$replace .= $this->buildFeedLineItem($item, $use_thumb, $width, $page_data, $height, $the_link);
					$count ++;
				}
			}
		}			
		
		$output = str_replace('{ikfb:feed}', $replace, $output);
		
		return $output;		
	}
	
	//thanks to Alix Axel, http://stackoverflow.com/questions/2762061/how-to-add-http-if-its-not-exists-in-the-url
	function addhttp($url) {
		if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
			$url = "http://" . $url;
		}
		return $url;
	}
	
	//passed a FB Feed Item, builds the appropriate HTML
	function buildFeedLineItem($item, $use_thumb, $width, $page_data, $height, $the_link = false){
		global $ik_social_pro;
	
		//build default HTML structure
		$default_feed_item_html = '<li class="ik_fb_feed_item">{ikfb:feed_item}</li>';		
		$default_message_html = '<p>{ikfb:feed_item:message}</p>';		
		$default_image_html = '<p class="ik_fb_facebook_image">{ikfb:feed_item:image}</p>';		
		$default_description_html = '<p class="ik_fb_facebook_description">{ikfb:feed_item:description}</p>';		
		$default_caption_html = '<p class="ik_fb_facebook_link">{ikfb:feed_item:link}</p>';	
		
		//load custom HTML structure from Pro Plugin, if available
		$feed_item_html = strlen(get_option('ik_fb_feed_item_html')) > 2 && get_option('ik_fb_use_custom_html') ? get_option('ik_fb_feed_item_html') : $default_feed_item_html;
		$message_html = strlen(get_option('ik_fb_message_html')) > 2 && get_option('ik_fb_use_custom_html') ? get_option('ik_fb_message_html') : $default_message_html;
		$image_html = strlen(get_option('ik_fb_image_html')) > 2 && get_option('ik_fb_use_custom_html') ? get_option('ik_fb_image_html') : $default_image_html;
		$description_html = strlen(get_option('ik_fb_description_html')) > 2 && get_option('ik_fb_use_custom_html') ? get_option('ik_fb_description_html') : $default_description_html;
		$caption_html = strlen(get_option('ik_fb_caption_html')) > 2 && get_option('ik_fb_use_custom_html') ? get_option('ik_fb_caption_html') : $default_caption_html;
		
		$output = '';
		
		$add_feed_item = false;
		
		if(is_valid_key(get_option('ik_fb_pro_key'))){
			$add_feed_item = $ik_social_pro->is_page_owner($item,$page_data);
		} else {
			$add_feed_item = true;
		}
		
		//parse post date for output
		$date = "";
		
		if(isset($item->created_time)){
			$date = $item->created_time;
		}
		
		$line_item = '';
		$shortened = false;
		
		if($add_feed_item){
			$replace = "";
		
			//output the item message
			if(isset($item->message)){				
				//add avatar for pro users
				if(is_valid_key(get_option('ik_fb_pro_key'))){		
					$replace = $ik_social_pro->pro_user_avatars($replace, $item) . " ";
				}
				
				$replace = $replace . $item->message;
				
				//if a character limit is set, here is the logic to handle that
				$limit = get_option('ik_fb_character_limit');
				if(is_numeric($limit)){
					//only perform changes on posts longer than the character limit
					if(strlen($replace) > $limit){
						//remove characters beyond limit
						$replace = substr($replace, 0, $limit);
						$replace .= "... ";
						
						$shortened = true;
					}
				}
				
				//add custom message styling from pro options
				if(is_valid_key(get_option('ik_fb_pro_key')) && !get_option('ik_fb_use_custom_html')){		
					$message_html = $ik_social_pro->pro_message_styling($message_html);
				}		
				
				$line_item .= str_replace('{ikfb:feed_item:message}', $replace, $message_html);			
			}				

			//output the item photo
			if(isset($item->picture)){ 		
				if(!isset($this->authToken)){
					$this->authToken = $this->fetchUrl("https://graph.facebook.com/oauth/access_token?type=client_cred&client_id={$app_id}&client_secret={$app_secret}");
				}	
				
				//need info about full sized photo for linking purposes
				//get the item id
				$item_id = $item->object_id;
								
				//load arguments into array for use below
				$parsed_url = parse_url($item->picture);
				parse_str($parsed_url['query'], $params);		
				
				if(isset($params['url'])) {
					//default the photo link to the thumbnail, in case any of the other methods don't work out
					$photo_link = $params['url'];
					$thumbnail_photo = false;
				} else {
					//no fullsized version available, use what's on FB
					$photo = $this->fetchUrl("https://graph.facebook.com/{$item_id}/picture?{$this->authToken}&redirect=false", true);	
					$photo_link = $item->picture;
					
					$thumbnail_photo = true;
				}
				
				//output the images
				//if set, load the custom image width from the options page
				if(!$use_thumb){			
					//TBD: add some logic to not distort the images being output (if the set height/width requirements are larger than the initial photo)
					
					//if using custom width, output fullsized image
					$width = get_option('ik_fb_fix_feed_image_width') ? $width : '';
					$height = get_option('ik_fb_fix_feed_image_height') ? $height : '';	
					
					if(!$thumbnail_photo){
						$replace = '<a href="'.$photo_link.'" title="Click to View Fullsize Photo" target="_blank"><img width="'.$width.'" height="'.$height.'" src="'.$photo_link.'" /></a>';
					} else {
						$replace = '<a href="'.$photo_link.'" title="Click to View Fullsize Photo" target="_blank"><img src="'.$photo_link.'" /></a>';
					}
			
					//add custom image styling from pro options
					if(is_valid_key(get_option('ik_fb_pro_key')) && !get_option('ik_fb_use_custom_html')){		
						$image_html = $ik_social_pro->pro_image_styling($image_html);
					}		
					
					$line_item .= str_replace('{ikfb:feed_item:image}', $replace, $image_html);						
				} else {						
					//otherwise, use thumbnail
					$replace = '<a href="'.$photo_link.'" target="_blank"><img src="'.$item->picture.'" /></a>';
				
					//add custom image styling from pro options
					if(is_valid_key(get_option('ik_fb_pro_key')) && !get_option('ik_fb_use_custom_html')){		
						$image_html = $ik_social_pro->pro_image_styling($image_html);
					}	
					
					$line_item .= str_replace('{ikfb:feed_item:image}', $replace, $image_html);	
				}

				//add the text for photo description
				if(isset($item->description)){
					$replace = $item->description;	

					//if a character limit is set, here is the logic to handle that
					$limit = get_option('ik_fb_description_character_limit');
					if(is_numeric($limit)){
						//only perform changes on posts longer than the character limit
						if(strlen($replace) > $limit){
							//remove characters beyond limit
							$replace = substr($replace, 0, $limit);
							$replace .= "... ";
						
							$shortened = true;
						}
					}					
				
					//add custom image styling from pro options
					if(is_valid_key(get_option('ik_fb_pro_key')) && !get_option('ik_fb_use_custom_html')){		
						$description_html = $ik_social_pro->pro_description_styling($description_html);
					}	
					
					$line_item .= str_replace('{ikfb:feed_item:description}', $replace, $description_html);	
				}
			}			
			
			if($shortened){
				$line_item .= ' <a href="'.$the_link.'" class="ikfb_read_more" target="_blank">Read More...</a>';
			}	

			if(isset($item->link)){ //output the item link
				if(isset($item->caption)){
					$link_text = $item->caption; //some items have a caption	
				} else {
					$link_text = $item->name;  //others might just have a name
				}
				
				//don't add the line item if the link text isn't set
				if(strlen($link_text) > 1){
					$replace_front = '<a href="'.$item->link.'" target="_blank">';
					$replace_back = $link_text.'</a>';				
				
					//add custom link styling from pro options
					if(is_valid_key(get_option('ik_fb_pro_key')) && !get_option('ik_fb_use_custom_html')){		
						$replace_front = $ik_social_pro->pro_link_styling($item->link);
					}	
					
					$line_item .= str_replace('{ikfb:feed_item:link}', $replace_front.$replace_back, $caption_html);	
				}
			}	
			
			if(strlen($line_item)>2){
				
				//output Posted By... text, if option is set
				if(get_option('ik_fb_show_posted_by')){
					//only add the author if there is line item content to display
					if(isset($item->from)){ //output the author of the item
						if(isset($item->from->name)){
							$from_text = $item->from->name;
						}
						
						if(strlen($from_text) > 1){
							$posted_by_text = '<p class="ikfb_item_author">Posted By '.$from_text.'</p>';
				
							//add custom posted by styling from pro options
							if(is_valid_key(get_option('ik_fb_pro_key')) && !get_option('ik_fb_use_custom_html')){		
								$posted_by_text = $ik_social_pro->pro_posted_by_styling($posted_by_text);
							}			
							//TBD: make Custom HTML option for Posted By
							$line_item .= $posted_by_text;
						}
					}
				}
				
				//output date, if option to display it is enabled
				if(get_option('ik_fb_show_date')){
					if(strtotime($date) >= strtotime('-1 day')){
						$date = $this->humanTiming(strtotime($date)). " ago";
					}else{
						$date = date('F jS', strtotime($date));
					}
				
					if(strlen($date)>2){
						$date = '<p class="date">' . $date . '</p>';
					}
										
					$line_item .= $date;
				}
			
				//add likes, if pro and enabled
				if(is_valid_key(get_option('ik_fb_pro_key'))){		
					$line_item .= $ik_social_pro->pro_likes($item, $the_link);
				}
				
				//add comments, if pro and enabled
				if(is_valid_key(get_option('ik_fb_pro_key'))){		
					$line_item .= $ik_social_pro->pro_comments($item, $the_link);
				}	
			
				$output = str_replace('{ikfb:feed_item}', $line_item, $feed_item_html);	
			} else if(strpos($item->link,'http://www.facebook.com/events/') !== false){
				//some event parsing				
				$event_id = explode('/',$item->link);
				$event_id = $event_id[4];
				
				if($event_id){
					$app_id = get_option('ik_fb_app_id');
					$app_secret = get_option('ik_fb_secret_key');
					
					if(!isset($this->authToken)){
						$this->authToken = $this->fetchUrl("https://graph.facebook.com/oauth/access_token?type=client_cred&client_id={$app_id}&client_secret={$app_secret}");
					}
					
					$event_data = $this->fetchUrl("https://graph.facebook.com/{$event_id}?{$this->authToken}", true);//the event data
					
					$replace = '';	
					
					//add avatar for pro users
					if(is_valid_key(get_option('ik_fb_pro_key'))){		
						$replace = $ik_social_pro->pro_user_avatars($replace, $item) . " ";
					}
					
					//load event image source
					$event_image = "http://graph.facebook.com/" . $event_id . "/picture";
					
					//event name
					$replace = '<p class="ikfb_event_title">' . $replace . $event_data->name . '</p>';
					
					//event start time - event end time
					//TBD: date formatting
					$replace .= '<p class="ikfb_event_date">' . date('l, F jS, Y', strtotime($event_data->start_time)) . ' - ' . date('l, F jS, Y', strtotime($event_data->end_time)) . '</p>';
					
					//event image					
					$replace .= '<img class="ikfb_event_image" src="' . $event_image . '" />';					
					
					//event description
					$event_description = substr($event_data->description, 0, 250);
					$event_description .= "... ";
						
					$replace .= '<p class="ikfb_event_description">' . $event_description . '</p>';
					
					//event read more link
					$replace .= '<p class="ikfb_event_link"><a href="http://facebook.com/events/'.$event_id.'" title="Click Here To Read More" target="_blank">Read More...</a></p>';
					
					$output = str_replace('{ikfb:feed_item}', $replace, $feed_item_html);	
				}
			}			
		}
		
		return $output;
	}
	
	//check to see time elapsed since given datetime
	//credit to http://stackoverflow.com/questions/2915864/php-how-to-find-the-time-elapsed-since-a-date-time
	function humanTiming ($time)	{
		$time = time() - $time; // to get the time since that moment

		$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);

		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}

	}
	
	//checks settings and outputs Powered By link
	function ik_fb_show_powered_by() {
		//use this to track if powered by has been output
		global $ikfb_footer_poweredby_output;
		global $ik_social_pro;
				
		if(get_option('ik_fb_powered_by')){			
			if($ikfb_footer_poweredby_output){
				return;
			} else {			
				$content = '<a href="https://illuminatikarate.com/ik-facebook-plugin/" target="_blank" id="ikfb_powered_by">Powered By IK Facebook Plugin</a>';			
				
				//add custom powered by styling from pro options
				if(is_valid_key(get_option('ik_fb_pro_key')) && !get_option('ik_fb_use_custom_html')){		
					$content = $ik_social_pro->pro_powered_by_styling($content);
				}		
				
				echo $content;
				
				$ikfb_footer_poweredby_output = true;
			}
		}
	}
	
	//fetches an URL
	function fetchUrl($url,$decode=false){		
		//caching
		$ch = new CachedCurl();

		$retData = $ch->load_url($url);
		
		if($decode){
			$retData = json_decode($retData);
		}
		
		return $retData;
	}
	
	//loads facebook feed based on current id
	function loadFacebook($id = false){
		$retData = array();
	
		if(!$id){
			$profile_id = get_option('ik_fb_page_id'); //id of the facebook page
		} else {
			$profile_id = $id;
		}
	
		if(isset($profile_id) && strlen($profile_id)>0){
			$app_id = get_option('ik_fb_app_id');
			$app_secret = get_option('ik_fb_secret_key');
			
			if(!isset($this->authToken)){
				$this->authToken = $this->fetchUrl("https://graph.facebook.com/oauth/access_token?type=client_cred&client_id={$app_id}&client_secret={$app_secret}");
			}
			
			$feed = $this->fetchUrl("https://graph.facebook.com/{$profile_id}/feed?{$this->authToken}", true);//the feed data
			$page_data = $this->fetchUrl("https://graph.facebook.com/{$profile_id}", true);//the page data
			
			if(isset($feed->data)){//check to see if feed data is set				
				$retData['feed'] = $feed->data;
			}
			if(isset($page_data)){//check to see if page data is set
				$retData['page_data'] = $page_data;
			}
		}
		
		return $retData;
	}
}//end ikFacebook

//publicly available functions

//display feed
function ik_fb_display_feed(){
	$ik_fb = new ikFacebook();
	echo $ik_fb->ik_fb_output_feed();
}

//display like box
function ik_fb_display_like_button($url, $height = "45", $colorscheme = "light"){
	$ik_fb = new ikFacebook();
	echo $ik_fb->ik_fb_like_button($url,$height,$colorscheme);
}

if (!isset($ik_fb)){
	$ik_fb = new ikFacebook();
}