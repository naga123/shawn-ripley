<?php

	function include_social_shares(){
		
		global $cp_social_settings;
		
		//Social Sharing 
		$facebook_sharing = '';
		$twitter_sharing = '';
		$stumble_sharing = '';
		$delicious_sharing = '';
		$googleplus_sharing = '';
		$digg_sharing = '';
		$myspace_sharing = '';
		$reddit_sharing = '';	
		$cp_social_settings = '';
		
		//Getting Values from database
		$cp_social_settings = get_option('social_settings');
		if($cp_social_settings <> ''){
			$cp_social = new DOMDocument ();
			$cp_social->loadXML ( $cp_social_settings );
		
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
		
		
		
		$currentUrl = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		if( !empty($_SERVER['HTTPS']) ){
			$currentUrl = "https://" . $currentUrl;
		}else{
			$currentUrl = "http://" . $currentUrl;
		}
		
		echo '<div class="social-shares">';
		//echo "<h3 class='sub_head'>";
			//echo __('Social Share','crunchpress');
		//echo "</h3>";
		echo '<ul>';
		
		if( $facebook_sharing == 'enable'){
			?>
			<li>
				<a href="http://www.facebook.com/share.php?u=<?php echo $currentUrl;?>" target="_blank">
					<img alt="facebook" class="no-preload" src="<?php echo CP_PATH_URL;?>/images/icon/social/facebook-share.png">
				</a>
			</li>
			<?php
		}
		if( $twitter_sharing == 'enable'){		
			?>
			<li>
				<a href="http://twitter.com/home?status=<?php echo str_replace(' ', '%20', get_the_title());?>%20-%20<?php echo $currentUrl;?>" target="_blank">
					<img  alt="twitter" class="no-preload" src="<?php echo CP_PATH_URL;?>/images/icon/social/twitter-share.png">
				</a>
			</li>
			<?php
		}
		if( $googleplus_sharing == 'enable'){		
			?>
			<li>
				<a href="http://www.google.com/bookmarks/mark?op=edit&#038;bkmk=<?php echo $currentUrl;?>&#038;title=<?php the_title();?>" target="_blank">
					<img  alt="googleplus" class="no-preload" src="<?php echo CP_PATH_URL;?>/images/icon/social/google-share.png">
				</a>
			</li>
			<?php
		}
		if( $stumble_sharing == 'enable'){		
			?>
			<li>
				<a href="http://www.stumbleupon.com/submit?url=<?php echo $currentUrl;?>&#038;title=<?php the_title();?>" target="_blank">
					<img  alt="stumble" class="no-preload" src="<?php echo CP_PATH_URL;?>/images/icon/social/stumble-upon-share.png">
				</a>
			</li>
			<?php
		}
		if( $myspace_sharing == 'enable'){		
			?>
			<li>
				<a href="http://www.myspace.com/Modules/PostTo/Pages/?u=<?php echo $currentUrl;?>" target="_blank">
					<img  alt="myspace" class="no-preload" src="<?php echo CP_PATH_URL;?>/images/icon/social/my-space-share.png">
				</a>
			</li>
			<?php
		}
		if( $delicious_sharing == 'enable'){		
			?>
			<li>
				<a href="http://delicious.com/post?url=<?php echo $currentUrl;?>&#038;title=<?php the_title();?>" target="_blank">
					<img  alt="delicious" class="no-preload" src="<?php echo CP_PATH_URL;?>/images/icon/social/delicious-share.png">
				</a>
			</li>
			<?php
		}
		if( $digg_sharing == 'enable'){		
			?>
			<li>
				<a href="http://digg.com/submit?url=<?php echo $currentUrl;?>&#038;title=<?php the_title();?>" target="_blank">
					<img  alt="digg" class="no-preload" src="<?php echo CP_PATH_URL;?>/images/icon/social/digg-share.png">
				</a>
			</li>
			<?php
		}
		if( $reddit_sharing == 'enable'){		
			?>
			<li>
				<a href="http://reddit.com/submit?url=<?php echo $currentUrl;?>&#038;title=<?php the_title();?>" target="_blank">
					<img  alt="reddit" class="no-preload" src="<?php echo CP_PATH_URL;?>/images/icon/social/reddit-share.png">
				</a>
			</li>
			<?php
		}
		if( get_option(THEME_NAME_S.'_linkedin_share') == 'enable'){		
			?>
			<li>
				<a href="http://www.linkedin.com/shareArticle?mini=true&#038;url=<?php echo $currentUrl;?>&#038;title=<?php echo str_replace(' ', '%20', get_the_title()); ?>" target="_blank">
					<img  alt="linkedin" class="no-preload" src="<?php echo CP_PATH_URL;?>/images/icon/social/linkedin-share.png">
				</a>
			</li>
			<?php
		}
		
		if( get_option(THEME_NAME_S.'_google_plus_share') == 'enable'){		
			?>
			<li>		
				<a href="https://plus.google.com/share?url={<?php echo $currentUrl;?>}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
					<img  alt="googleplus" class="no-preload" src="<?php echo CP_PATH_URL;?>/images/icon/social/google-plus-share.png" alt="google-share">
				</a>					
			</li>
			<?php
		}		
		
		echo '</ul>';
		echo '</div>';
	
	}
	
?>