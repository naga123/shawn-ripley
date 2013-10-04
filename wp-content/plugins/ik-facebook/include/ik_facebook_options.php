<?php
/*
This file is part of The IK Facebook Plugin .

The IK Facebook Plugin  is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

The IK Facebook Plugin  is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with The IK Facebook Plugin.  If not, see <http://www.gnu.org/licenses/>.
*/

class ikFacebookOptions
{
	function __construct(){
		//may be running in non WP mode (for example from a notification)
		if(function_exists('add_action')){
			//add a menu item
			add_action('admin_menu', array($this, 'add_admin_menu_item'));		
		}
	}
	
	function add_admin_menu_item(){
		if(get_option('ik_fb_unbranded') && is_valid_key(get_option('ik_fb_pro_key'))){
			$title = "Social Settings";
		} else {
			$title = "IK FB Settings";
		}
		
		if(get_option('ik_fb_unbranded') && is_valid_key(get_option('ik_fb_pro_key'))){
			$page_title = "Social Plugin Settings";
		} else {
			$page_title = "IK Facebook Plugin Settings";
		}
		
		//create new top-level menu
		add_menu_page($page_title, $title, 'administrator', __FILE__, array($this, 'settings_page'));

		//call register settings function
		add_action( 'admin_init', array($this, 'register_settings'));	
	}
	
	//function to produce tabs on admin screen
	function ik_fb_admin_tabs( $current = 'homepage' ) {
	
		$tabs = array( 'config_options' => 'Configuration Options', 'style_options' => 'Style Options', 'display_options' => 'Display Options', 'pro_options' => 'Pro Options' );
		echo '<div id="icon-themes" class="icon32"><br></div>';
		echo '<h2 class="nav-tab-wrapper">';
			foreach( $tabs as $tab => $name ){
				$class = ( $tab == $current ) ? ' nav-tab-active' : '';
				echo "<a class='nav-tab$class' href='?page=ik-facebook/include/ik_facebook_options.php&tab=$tab'>$name</a>";
			}
		echo '</h2>';
	}
	
	//register our settings
	function register_settings(){
		//register our config settings
		register_setting( 'ik-fb-config-settings-group', 'ik_fb_page_id' );
		register_setting( 'ik-fb-config-settings-group', 'ik_fb_app_id' );
		register_setting( 'ik-fb-config-settings-group', 'ik_fb_secret_key' );
		register_setting( 'ik-fb-config-settings-group', 'ik_fb_pro_key' );
		register_setting( 'ik-fb-config-settings-group', 'ik_fb_pro_url' );
		register_setting( 'ik-fb-config-settings-group', 'ik_fb_pro_email' );
		
		//register our style settings
		register_setting( 'ik-fb-style-settings-group', 'ik_fb_custom_css' );
		register_setting( 'ik-fb-style-settings-group', 'ik_fb_show_like_button' );
		register_setting( 'ik-fb-style-settings-group', 'ik_fb_show_profile_picture' );
		register_setting( 'ik-fb-style-settings-group', 'ik_fb_show_page_title' );
		register_setting( 'ik-fb-style-settings-group', 'ik_fb_fix_feed_image_width' );
		register_setting( 'ik-fb-style-settings-group', 'ik_fb_feed_image_width' );
		register_setting( 'ik-fb-style-settings-group', 'ik_fb_fix_feed_image_height' );
		register_setting( 'ik-fb-style-settings-group', 'ik_fb_feed_image_height' );
		register_setting( 'ik-fb-style-settings-group', 'ik_fb_feed_theme' );
		
		//register our display settings
		register_setting( 'ik-fb-display-settings-group', 'ik_fb_show_posted_by' );
		register_setting( 'ik-fb-display-settings-group', 'ik_fb_show_date' );
		register_setting( 'ik-fb-display-settings-group', 'ik_fb_feed_limit' );
		register_setting( 'ik-fb-display-settings-group', 'ik_fb_powered_by' );
		register_setting( 'ik-fb-display-settings-group', 'ik_fb_character_limit' );
		register_setting( 'ik-fb-display-settings-group', 'ik_fb_description_character_limit' );
		register_setting( 'ik-fb-display-settings-group', 'ik_fb_caption_character_limit' );
		
		//register any pro settings
		if(function_exists("ik_fb_pro_register_settings")){
			ik_fb_pro_register_settings();
		}
	}

	function settings_page(){
		global $pagenow;
		
		if(get_option('ik_fb_unbranded') && is_valid_key(get_option('ik_fb_pro_key'))){
			$title = "Facebook Settings";
			$message = "Facebook Settings Updated.";
		} else {
			$title = "IK Facebook Plugin Settings";
			$message = "IK Facebook Plugin Settings Updated.";
		}
		
	?>
	<div class="wrap">
		<h2><?php echo $title; ?></h2>		
		
		<?php if(!is_valid_key(get_option('ik_fb_pro_key') )): ?>
			<div class="updated" id="message">
				<h2>Want More Features?</h2>
				<p><a href="http://iksocialpro.com/purchase-ik-social-pro/?ikfbtop">Upgrade to IK Social Pro now</a> and get tons of new features and settings. </p>
				<h3>Pro Features Include:</h3>
				<ul>
					<li><strong>Unbranded Admin screens:</strong> Remove all IK FB branding from your Wordpress admin.</li>
					<li><strong>Hide non-page-owner posts from your feed:</strong> With this option, your feed will only show the posts from your own account.</li>
					<li><strong>Custom Styling Options:</strong> Unfamiliar with CSS? These options will enable you to style the output of the various text, links, change the dimensions of the feed, and more!</li>
					<li><strong>Custom HTML Output:</strong> Use any HTML tags you want for the feed. You'll be able to specify a custom HTML template for your feed.</li>
					<li><strong>Free Updates For Life:</strong> Get IK Social Pro now, and you'll get free updates for life!</li>
				</ul>
					
				<p>More to come! IK Social Pro plugin owners get new updates automatically by email. New features land in the Pro version first, so be sure to upgrade today.</p>
			</div>
		<?php endif; ?>
	
		<?php if (isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') : ?>
		<div id="message" class="updated fade"><p><?php echo $message; ?></p></div>
		<?php endif; ?>	
		
		<?php if ( isset ( $_GET['tab'] ) ) $this->ik_fb_admin_tabs($_GET['tab']); else $this->ik_fb_admin_tabs('config_options'); ?>
		
		<form method="post" action="options.php">
			
			<?php 
				if ( $pagenow == 'admin.php' && $_GET['page'] == 'ik-facebook/include/ik_facebook_options.php' ){
					if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab'];
					else $tab = 'config_options';
				}	
			
				switch ( $tab ){
					case 'config_options' :	
				?>
				<?php settings_fields( 'ik-fb-config-settings-group' ); ?>
			
			<h3>Configuration Options</h3>
			<p>The below options are used to configure your plugin to interact with your Facebook Page.</p>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_page_id">Page ID</label></th>
					<td><input type="text" name="ik_fb_page_id" id="ik_fb_page_id" value="<?php echo get_option('ik_fb_page_id'); ?>"  style="width: 250px" />
					<p class="description">This is your Username or Page ID.  For example, ours is IlluminatiKarate (the end of our Facebook Page URL), but some people's maybe an Integer (such as 199789123).  It depends on if you have a username.</p>
					</td>
				</tr>
			</table>

			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_app_id">Facebook App ID</label></th>
					<td><input type="text" name="ik_fb_app_id" id="ik_fb_app_id" value="<?php echo get_option('ik_fb_app_id'); ?>" style="width: 250px" />
					<p class="description">This is the App ID you acquired when you <a href="http://iksocialpro.com/installation-usage-instructions/how-to-get-an-app-id-and-secret-key-from-facebook/?ikfbsettings" target="_blank" title="How To Get An App ID and Secret Key From Facebook">setup your Facebook app</a>.</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_secret_key">Facebook Secret Key</label></th>
					<td><input type="text" name="ik_fb_secret_key" id="ik_fb_secret_key" value="<?php echo get_option('ik_fb_secret_key'); ?>" style="width: 250px" />
					<p class="description">This is the App Secret you acquired when you <a href="http://iksocialpro.com/installation-usage-instructions/how-to-get-an-app-id-and-secret-key-from-facebook/?ikfbsettings" target="_blank" title="How To Get An App ID and Secret Key From Facebook">setup your Facebook app</a>.</p></td>
				</tr>
			</table>
				<?php
					break;
					case 'style_options' :
				?>
				<?php settings_fields( 'ik-fb-style-settings-group' ); ?>
			
			<h3>Style Options</h3>
			<p>The below options are used to modify, or fully change, the style of your Facebook Feed displayed on your website.</p>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_feed_theme">Feed Style</a></th>
					<td>
						<select name="ik_fb_feed_theme" id="ik_fb_feed_theme">	
							<option value="default_style" <?php if(get_option('ik_fb_feed_theme') == "default_style"): echo 'selected="SELECTED"'; endif; ?>>Default Style</option>
							<option value="dark_style" <?php if(get_option('ik_fb_feed_theme') == "dark_style"): echo 'selected="SELECTED"'; endif; ?>>Dark Style</option>
							<option value="light_style" <?php if(get_option('ik_fb_feed_theme') == "light_style"): echo 'selected="SELECTED"'; endif; ?>>Light Style</option>
							<option value="blue_style" <?php if(get_option('ik_fb_feed_theme') == "blue_style"): echo 'selected="SELECTED"'; endif; ?>>Blue Style</option>
							<option value="no_style" <?php if(get_option('ik_fb_feed_theme') == "no_style"): echo 'selected="SELECTED"'; endif; ?>>No Style</option>
						</select>
						<p class="description">Select which style you want to use.  If 'No Style' is selected, only your Theme's CSS, and any Custom CSS you've added, will be used.</p>
					</td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_custom_css">Custom CSS</a></th>
					<td><textarea name="ik_fb_custom_css" id="ik_fb_custom_css" style="width: 250px; height: 250px;"><?php echo get_option('ik_fb_custom_css'); ?></textarea>
					<p class="description">Input any Custom CSS you want to use here.  You can also include a file in your theme's folder called 'ik_fb_custom_style.css' - any styles in that file will be loaded with the plugin.  The plugin will work without you placing anything here - this is useful in case you need to edit any styles for it to work with your theme, though.</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_show_like_button">Show Like Button</label></th>
					<td><input type="checkbox" name="ik_fb_show_like_button" id="ik_fb_show_like_button" value="1" <?php if(get_option('ik_fb_show_like_button')){ ?> checked="CHECKED" <?php } ?>/>
					<p class="description">If checked, the Like Button and number of people who like your page will be displayed above the Feed.</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_show_profile_picture">Show Profile Picture</label></th>
					<td><input type="checkbox" name="ik_fb_show_profile_picture" id="ik_fb_show_profile_picture" value="1" <?php if(get_option('ik_fb_show_profile_picture')){ ?> checked="CHECKED" <?php } ?>/>
					<p class="description">If checked, the Profile Picture will be shown next to the Title of the feed.</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_show_page_title">Show Page Title</label></th>
					<td><input type="checkbox" name="ik_fb_show_page_title" id="ik_fb_show_page_title" value="1" <?php if(get_option('ik_fb_show_page_title')){ ?> checked="CHECKED" <?php } ?>/>
					<p class="description">If checked, the Title of the feed will be shown.</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_fix_feed_image_width">Fix Feed Image Width</label></th>
					<td><input type="checkbox" name="ik_fb_fix_feed_image_width" id="ik_fb_fix_feed_image_width" value="1" <?php if(get_option('ik_fb_fix_feed_image_width')){ ?> checked="CHECKED" <?php } ?>/>
					<p class="description">If checked, images inside the feed will all be displayed at the width set below.  If both this and 'Fix Feed Image Height' are unchecked, feed will display image thumbnails.</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_feed_image_width">Feed Image Width</label></th>
					<td><input type="text" name="ik_fb_feed_image_width" id="ik_fb_feed_image_width" value="<?php echo get_option('ik_fb_feed_image_width'); ?>" style="width: 250px" />
					<p class="description">If 'Fix Feed Image Width' is checked, the images will be set to this width (integer only.)</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_fix_feed_image_height">Fix Feed Image Height</label></th>
					<td><input type="checkbox" name="ik_fb_fix_feed_image_height" id="ik_fb_fix_feed_image_height" value="1" <?php if(get_option('ik_fb_fix_feed_image_height')){ ?> checked="CHECKED" <?php } ?>/>
					<p class="description">If checked, images inside the feed will all be displayed at the height set below.  If both this and 'Fix Feed Image Width' are unchecked, feed will display image thumbnails.</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_feed_image_height">Feed Image Height</label></th>
					<td><input type="text" name="ik_fb_feed_image_height" id="ik_fb_feed_image_height" value="<?php echo get_option('ik_fb_feed_image_height'); ?>" style="width: 250px" />
					<p class="description">If 'Fix Feed Image Height' is checked, the images will be set to this width (integer only.)</p></td>
				</tr>
			</table>
				<?php
					break;
					case 'display_options' :
				?>
				<?php settings_fields( 'ik-fb-display-settings-group' ); ?>
			
			<h3>Display Options</h3>
			<p>The below options are used to control the type and amount of content that is displayed in your Facebook Feed.</p>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_feed_limit">Number of Feed Items</label></th>
					<td><input type="text" name="ik_fb_feed_limit" id="ik_fb_feed_limit" value="<?php echo get_option('ik_fb_feed_limit'); ?>" style="width: 250px" />
					<p class="description">If set, the feed will be limited to this number of items.</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_character_limit">Feed Item Message Character Limit</label></th>
					<td><input type="text" name="ik_fb_character_limit" id="ik_fb_character_limit" value="<?php echo get_option('ik_fb_character_limit'); ?>" style="width: 250px" />
					<p class="description">If set, the feed item will be limited to this number of characters.  If a feed item is shortened, a Read More link will be displayed.</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_description_character_limit">Feed Item Description Character Limit</label></th>
					<td><input type="text" name="ik_fb_description_character_limit" id="ik_fb_description_character_limit" value="<?php echo get_option('ik_fb_description_character_limit'); ?>" style="width: 250px" />
					<p class="description">If set, the feed item will be limited to this number of characters.  If a feed item is shortened, a Read More link will be displayed.</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_show_posted_by">Show Posted By</label></th>
					<td><input type="checkbox" name="ik_fb_show_posted_by" id="ik_fb_show_posted_by" value="1" <?php if(get_option('ik_fb_show_posted_by')){ ?> checked="CHECKED" <?php } ?>/>
					<p class="description">If checked, the text Posted By PosterName will be displayed in the feed.</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_show_date">Show Posted Date</label></th>
					<td><input type="checkbox" name="ik_fb_show_date" id="ik_fb_show_date" value="1" <?php if(get_option('ik_fb_show_date')){ ?> checked="CHECKED" <?php } ?>/>
					<p class="description">If checked, the date of the post will be displayed in the Feed.</p></td>
				</tr>
			</table>
			
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="ik_fb_powered_by">Show "Powered By IK Facebook"</label></th>
					<td><input type="checkbox" name="ik_fb_powered_by" id="ik_fb_powered_by" value="1" <?php if(get_option('ik_fb_powered_by')){ ?> checked="CHECKED" <?php } ?>/>
					<p class="description">Love this plugin but are unable to donate?  Show your love by displaying our inconspicuous "Powered By IK Facebook" link in the footer of your site.</p></td>
				</tr>
			</table>
				<?php
					break;
					case 'pro_options' :
						global $ik_social_pro_options;
						
						$ik_social_pro_options->output_settings();
					break;
					}//end switch
				?>			
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>		
				<?php
					if(!is_valid_key(get_option('ik_fb_pro_key'))):					
				?>
				<div style="margin: 20px auto; text-align: left; text-decoration: none;">					
					<a href="http://iksocialpro.com/purchase-ik-social-pro/?ikfbbottom" target="_blank" title="Learn More About IK Social Pro"><img src="<?php echo plugins_url('/img/ik_social_pro.jpg', __FILE__); ?>" alt="IK Social Pro" /><p class="description">Click Here To Learn About IK Social Pro</p></a>
				</div>
				<?php
					endif;
				?>
		</form>
	</div>
	<?php } // end settings_page function
	
} // end class
?>