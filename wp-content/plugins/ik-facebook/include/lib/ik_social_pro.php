<?php
global $ik_social_pro;
global $ik_social_pro_options;
global $ik_fb;

include('ik_social_pro_options.php');

class ikSocialPro
{	
	function __construct(){		
		//some init yang
		add_action( 'admin_init', array($this, 'ikfb_pro_admin_init') );
	}
	
    function ikfb_pro_admin_init() {
        wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script( 'farbtastic' );
		wp_enqueue_script( 'ik_fb_pro_options', plugins_url('../js/js.js', __FILE__), array( 'farbtastic', 'jquery' ) );
		
		//register our pro settings
		$ik_social_options = new ikSocialProOptions();		
		return $ik_social_options->register_settings();
    }
	
	//returns true if current item is written by the page owner
	function is_page_owner($item,$page_data){
		//only hide items if the option is toggled
		if(get_option('ik_fb_only_show_page_owner') && is_valid_key(get_option('ik_fb_pro_key'))){
			if($item->from->id == $page_data->id){
				return true;
			}
			return false;
		} else {
			return true;
		}
	}
	
	//inserts any selected custom styling options into the feed's message html
	//load custom style options from Pro Plugin, if available
	function pro_message_styling($message_html = ""){
		if(is_valid_key(get_option('ik_fb_pro_key'))){
			$ik_fb_font_color = strlen(get_option('ik_fb_font_color')) > 2 ? get_option('ik_fb_font_color') : '';
			$ik_fb_font_size = strlen(get_option('ik_fb_font_size')) > 0 ? get_option('ik_fb_font_size') : '';

			//load our custom styling, to insert
			$insertion = ' style="';
			if(strlen($ik_fb_font_size)>0){
				$insertion .= "font-size: {$ik_fb_font_size}px; ";
			}
			if(strlen($ik_fb_font_color)>0){
				$insertion .= "color: {$ik_fb_font_color};";
			}
			$insertion .= '"';					
			//find the position of the replacement shortcode in the HTML
			$position = strpos($message_html,'{ikfb:feed_item:message}');
			//move back one character from that position, assuming a closing bracket to some HTML tag, and insert our custom styling
			$message_html = substr_replace($message_html, $insertion, $position-1, 0);
		}
		
		return $message_html;
	}
	
	//inserts any selected custom styling options into the feed's image
	//$replace = '<img width="'.$width.'" src="'.$photo->data->url.'" />';
	function pro_image_styling($replace = ""){
		if(is_valid_key(get_option('ik_fb_pro_key'))){
			//do something
		}
		
		return $replace;
	}
	
	//inserts any selected custom styling options into the feed's link
	//$replace = <p class="ik_fb_facebook_link">{ikfb:feed_item:link}</p>
	function pro_link_styling($item_link = ""){	
		if(is_valid_key(get_option('ik_fb_pro_key'))){	
			$ik_fb_link_font_color = strlen(get_option('ik_fb_link_font_color')) > 2 ? get_option('ik_fb_link_font_color') : '';
			$ik_fb_link_font_size = strlen(get_option('ik_fb_link_font_size')) > 0 ? get_option('ik_fb_link_font_size') : '';
			
			//load our custom styling, to insert
			$insertion = ' style="';
			if(strlen($ik_fb_link_font_size)>0){
				$insertion .= "font-size: {$ik_fb_link_font_size}px; ";
			}
			if(strlen($ik_fb_link_font_color)>0){
				$insertion .= "color: {$ik_fb_link_font_color};";
			}
			$insertion .= '"';
			
			$replace = '<a href="'.$item_link.'" target="_blank" '.$insertion.'>';	
		}
		
		return $replace;
	}
	
	//inserts any selected custom styling options into the feed's posted by attribute
	//$line_item .= '<p class="ikfb_item_author">Posted By '.$from_text.'</p>';		
	function pro_posted_by_styling($line_item = ""){	
		if(is_valid_key(get_option('ik_fb_pro_key'))){
			$ik_fb_posted_by_font_color = strlen(get_option('ik_fb_posted_by_font_color')) > 2 ? get_option('ik_fb_posted_by_font_color') : '';
			$ik_fb_posted_by_font_size = strlen(get_option('ik_fb_posted_by_font_size')) > 0 ? get_option('ik_fb_posted_by_font_size') : '';
			
			//load our custom styling, to insert
			$insertion = ' style="';
			if(strlen($ik_fb_posted_by_font_size)>0){
				$insertion .= "font-size: {$ik_fb_posted_by_font_size}px; ";
			}
			if(strlen($ik_fb_posted_by_font_color)>0){
				$insertion .= "color: {$ik_fb_posted_by_font_color};";
			}
			$insertion .= '"';					
			//find the position of the replacement shortcode in the HTML
			$position = strpos($line_item,'Posted By');
			//move back one character from that position, assuming a closing bracket to some HTML tag, and insert our custom styling
			$line_item = substr_replace($line_item, $insertion, $position-1, 0);
		}
		
		return $line_item;
	}
	
	//inserts avatars into the message content, if option is enabled
	function pro_user_avatars($content = "", $item = array()){
		global $ik_fb;
		
		if(is_valid_key(get_option('ik_fb_pro_key')) && get_option('ik_fb_show_avatars')){	
			if(!isset($ik_fb->authToken)){
				$app_id = get_option('ik_fb_app_id');
				$app_secret = get_option('ik_fb_secret_key');
		
				$ik_fb->authToken = $ik_fb->fetchUrl("https://graph.facebook.com/oauth/access_token?type=client_cred&client_id={$app_id}&client_secret={$app_secret}");
			}	
			
			$content .= '<img src="https://graph.facebook.com/' . $item->from->id .'/picture?' . $ik_fb->authToken . '" class="ikfb_user_avatar" />';
		}
		
		return $content;
	}
	
	//insert comment info into feed, if enabled
	function pro_comments($item, $the_link){
		global $ik_fb;
	
		$comment_output = "";

		if(is_valid_key(get_option('ik_fb_pro_key'))){	
		
			if(get_option('ik_fb_show_reply_counts')){		
				if(isset($item->comments)){
				
					$num_comments = count($item->comments->data);
					
					$comment_string = "comment";
					
					if($num_comments > 1){
						$comment_string = "comments";
					}
					
					$comment_output = '<a href="'.$the_link.'" target="_blank" class="ikfb_comments" title="Click To Read On Facebook">' . $num_comments . ' ' . $comment_string . '</a>';
				}
			}

			if(get_option('ik_fb_show_replies')){	
				$has_comments = false;
				
				if(isset($item->comments)){
					$comment_list = '<ul class="ikfb_comment_list">';
					
					//list of comment groupss per feed item
					foreach($item->comments as $comments){
						//each comment group has multiple comments - conversations per feed item
						foreach($comments as $comment){
							if(isset($comment->message)){
								$comment_list .= '<li class="ikfb_comment">';
								//show avatars, if enabled
								if(get_option('ik_fb_show_avatars')){
									if(!isset($ik_fb->authToken)){
										$app_id = get_option('ik_fb_app_id');
										$app_secret = get_option('ik_fb_secret_key');
								
										$ik_fb->authToken = $ik_fb->fetchUrl("https://graph.facebook.com/oauth/access_token?type=client_cred&client_id={$app_id}&client_secret={$app_secret}");
									}	
									
									$comment_avatar = '<img src="https://graph.facebook.com/' . $comment->from->id .'/picture?' . $ik_fb->authToken . '" class="ikfb_user_comment_avatar" />';
									
									$comment_list .= $comment_avatar;
								}
								$comment_list .= '<p class="ikfb_comment_message"><span class="ikfb_comment_author">' . $comment->from->name . ' says:</span> ';
								$comment_list .= $comment->message . '</p>';
								
								//output date, if option to display it is enabled
								if(get_option('ik_fb_show_date')){
									if(strtotime($comment->created_time) >= strtotime('-1 day')){
										$date = $ik_fb->humanTiming(strtotime($comment->created_time)). " ago";
									}else{
										$date = date('F jS', strtotime($comment->created_time));
									}
								
									if(strlen($date)>2){
										$comment_list .= '<p class="ikfb_comment_date">' . $date . '</p>';
									}
								}	
								
								//ouput number of likes, if option to show them are enabled
								if(get_option('ik_fb_show_likes')){	
									if($comment->like_count > 0){
										$like_string = "person likes";
										if($comment->like_count > 1){
											$like_string = "people like";
										}
										$comment_list .= '<p class="ikfb_comment_likes">' . $comment->like_count . ' ' . $like_string . ' this.</p>';
									}
								}						
								
								$comment_list .= '<span class="ikfb_clear"></span>';
								
								$comment_list .= '</li>';
								
								$has_comments = true;
							}
						}
					}
					
					$comment_list .= '</ul>';
				}
				
				if($has_comments){
					$comment_output .= $comment_list;
				}
			}
		}
		
		return $comment_output;
	}
	
	//insert like info into feed, if enabled
	function pro_likes($item, $the_link){
		$likes = "";

		if(get_option('ik_fb_show_likes')){		
			if(isset($item->likes)){
			
				$num_likes = count($item->likes->data);
				
				$like_string = "like";
				
				if($num_likes > 1){
					$like_string = "likes";
				}
				
				$likes = '<a href="'.$the_link.'" target="_blank" class="ikfb_likes">' . $num_likes . ' ' . $like_string . '</a> ';
			}
		}
		
		return $likes;
	}
	
	//inserts any selected custom styling options into the feed's description
	//$replace = $item->description;				
	function pro_description_styling($replace = ""){	
		if(is_valid_key(get_option('ik_fb_pro_key'))){
			$ik_fb_description_font_color = strlen(get_option('ik_fb_description_font_color')) > 2 ? get_option('ik_fb_description_font_color') : '';
			$ik_fb_description_font_size = strlen(get_option('ik_fb_description_font_size')) > 0 ? get_option('ik_fb_description_font_size') : '';
			
			//load our custom styling, to insert
			$insertion = ' style="';
			if(strlen($ik_fb_description_font_size)>0){
				$insertion .= "font-size: {$ik_fb_description_font_size}px; ";
			}
			if(strlen($ik_fb_description_font_color)>0){
				$insertion .= "color: {$ik_fb_description_font_color};";
			}
			$insertion .= '"';					
			//find the position of the replacement shortcode in the HTML
			$position = strpos($replace,'{ikfb:feed_item:description}');
			//move back one character from that position, assuming a closing bracket to some HTML tag, and insert our custom styling
			$replace = substr_replace($replace, $insertion, $position-1, 0);
		}
		
		return $replace;
	}
	
	//inserts any selected custom styling options into the feed's powered by attribute	
	//$content = '<a href="https://illuminatikarate.com/ik-facebook-plugin/" target="_blank" id="ikfb_powered_by">Powered By IK Facebook Plugin</a>';	
	function pro_powered_by_styling($content = ""){
		if(is_valid_key(get_option('ik_fb_pro_key'))){
			$ik_fb_powered_by_font_color = strlen(get_option('ik_fb_powered_by_font_color')) > 2 ? get_option('ik_fb_powered_by_font_color') : '';
			$ik_fb_powered_by_font_size = strlen(get_option('ik_fb_powered_by_font_size')) > 0 ? get_option('ik_fb_powered_by_font_size') : '';
			
			//load our custom styling, to insert
			$insertion = ' style="';
			if(strlen($ik_fb_powered_by_font_size)>0){
				$insertion .= "font-size: {$ik_fb_powered_by_font_size}px; ";
			}
			if(strlen($ik_fb_powered_by_font_color)>0){
				$insertion .= "color: {$ik_fb_powered_by_font_color};";
			}
			$insertion .= '"';					
			//find the position of the replacement shortcode in the HTML
			$position = strpos($content,'id="ikfb_powered_by"');
			//move back one character from that position, assuming a closing bracket to some HTML tag, and insert our custom styling
			$content = substr_replace($content, $insertion, $position-1, 0);
		}
		
		return $content;
	}
}

if (!isset($ik_social_pro)){
	$ik_social_pro = new ikSocialPro();
}

if (!isset($ik_social_pro_options)){
	$ik_social_pro_options = new ikSocialProOptions();
}