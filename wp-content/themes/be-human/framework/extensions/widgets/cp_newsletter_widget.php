<?php
class newsletter_widget extends WP_Widget
{
  function newsletter_widget()
  {
    $widget_ops = array('classname' => 'newsletter', 'description' => 'Newsletter and google feed widget to subscribe on website' );
    $this->WP_Widget('newsletter_widget', 'CrunchPress : Newsletter/Google Feed Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';	
	$show_name = isset( $instance['show_name'] ) ? esc_attr( $instance['show_name'] ) : '';	
	$news_letter_des = isset( $instance['news_letter_des'] ) ? esc_attr( $instance['news_letter_des'] ) : '';	
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	  Title: 
	  <input class="title"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
  <p>
  <label for="<?php echo $this->get_field_id('show_name'); ?>">
	  Show Name:
	  <select id="<?php echo $this->get_field_id('show_name'); ?>" name="<?php echo $this->get_field_name('show_name'); ?>" style="width:225px">
			<option <?php if(esc_attr($show_name) == 'Yes'){echo 'selected';}?>>Yes</option>
			<option <?php if(esc_attr($show_name) == 'No'){echo 'selected';}?>>No</option>
      </select>
  </label>
  </p>  
  <p>
  <label for="<?php echo $this->get_field_id('news_letter_des'); ?>">
	 Description:
	  <textarea rows="2"  cols="35" class="upcoming" id="<?php echo $this->get_field_id('news_letter_des'); ?>" name="<?php echo $this->get_field_name('news_letter_des'); ?>"><?php echo esc_attr($news_letter_des); ?></textarea>
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['show_name'] = $new_instance['show_name'];
		$instance['news_letter_des'] = $new_instance['news_letter_des'];
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$show_name = empty($instance['show_name']) ? ' ' : apply_filters('widget_title', $instance['show_name']);
		$news_letter_des = isset( $instance['news_letter_des'] ) ? esc_attr( $instance['news_letter_des'] ) : '';		
		echo $before_widget;	
		// WIDGET display CODE Start
		if (!empty($title))
			echo $before_title;
			echo $title;
			echo $after_title;

			$newsletter_config = '';
			$feed_burner_text = '';
			$cp_newsletter_settings = get_option('newsletter_settings');
			if($cp_newsletter_settings <> ''){
				$cp_newsletter = new DOMDocument ();
				$cp_newsletter->loadXML ( $cp_newsletter_settings );
				$newsletter_config = find_xml_value($cp_newsletter->documentElement,'newsletter_config');
				$feed_burner_text = find_xml_value($cp_newsletter->documentElement,'feed_burner_text');
			}
			if($newsletter_config <> 'google_feed_burner'){
			?>
			
			<!-- Newsletter Start -->
					<script>
						function slideout_msgs(){
							setTimeout(function(){
								jQuery("#newsletter_mess").slideUp("slow", function () {
								});
							}, 5000);
						}	
						function frm_newsletter(){
                           jQuery("#btn_newsletter").hide();
                            jQuery("#process_newsletter").html('<img src="<?php echo CP_PATH_URL?>/images/ajax_loading.gif" />');
                           jQuery.ajax({
                                type:'POST', 
                               url: '<?php echo CP_PATH_URL?>/framework/extensions/newsletter.php',
                                data: jQuery('#frm_newsletter').serialize(), 
                                success: function(response) {
                                    jQuery('#frm_newsletter').get(0).reset();
                                    jQuery('#newsletter_mess').show('');
                                    jQuery('#newsletter_mess').html(response);
                                    jQuery("#btn_newsletter").show('');
                                    jQuery("#process_newsletter").html('');
                                    slideout_msgs();
                                    //$('#frm_slide').find('.form_result').html(response);
                                }
                            });
                        }
                    </script>
                    <!-- Newsletter End -->
						<form id="frm_newsletter" action="javascript:frm_newsletter()">
                            <div class="message-box-wrapper red" id="newsletter_mess"></div>
								<?php if($news_letter_des <> ''){ 
											echo '<p>';
											echo substr($news_letter_des, 0, 200); 
											if ( strlen($news_letter_des) > 200 ) echo "..."; 
											echo '</p><br />';
										}
								?>
							<section class="field-holder">
								<input name="show_name" type="hidden" value="<?php echo $show_name;?>" />
								<?php if($show_name <> 'No'){?>
									<input type="text" class="letter-bg" name="newsletter_name" value="Enter Your Name" onfocus="if(this.value=='Enter Your Name') {this.value='';}" onblur="if(this.value=='') {this.value='Enter Your Name';}" />
								<?php }?>
								<input type="text" class="letter-bg" name="newsletter_email" value="Enter Email Address" onfocus="if(this.value=='Enter Email Address') {this.value='';}" onblur="if(this.value=='') {this.value='Enter Email Address';}" />
								<button class="sub-btn backcolr" id="btn_newsletter" >Submit</button>
								<div id="process_newsletter"></div>                            
							</section>	
				        </form>
                    <!-- Newsletter End -->     
	
	<?php
	}else{?>
							<form id="frm_newsletter" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feed_burner_text ?>', 'popupwindow', 'scrollbars=yes,width=600,height=550');return true">
                              <p>
							  <?php if($news_letter_des != ''){ 
											echo '<p>';
											echo substr($news_letter_des, 0, 120); 
											if ( strlen($news_letter_des) > 120 ) echo "..."; 
											echo '</p>';
										}
								?>
							  </p>
                                  <input type="text" class="letter-bg feedemail-input" name="email" onblur="this.value=this.value==''?'Enter your email':this.value;" onfocus="this.value=this.value=='Enter your email'?'':this.value" maxlength="150" value="Enter your email" />
                                  <input type="hidden" value="<?php echo $feed_burner_text ?>" name="uri"/>
                                  <input type="hidden" name="loc" value="en_US"/>
                                  <input id="btn_newsletter" type="submit" value="Submit" class="sub-btn backcolr newsletter-button"/>
                              
                              
                            </form>
	
	<?php }
	
	echo $after_widget;
	}
		
}
add_action( 'widgets_init', create_function('', 'return register_widget("newsletter_widget");') );?>