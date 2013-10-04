<?php
class popular_post extends WP_Widget
{
  function popular_post()
  {
    $widget_ops = array('classname' => 'popular_post', 'description' => 'Select Category to show its Popular Posts' );
    $this->WP_Widget('popular_post', 'CrunchPress : Show Popular Posts', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$get_cate_posts = isset( $instance['get_cate_posts'] ) ? esc_attr( $instance['get_cate_posts'] ) : '';
	$nop = isset( $instance['nop'] ) ? esc_attr( $instance['nop'] ) : '';
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	  Title: 
	  <input class="upcoming"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>   
  <p>
  <label for="<?php echo $this->get_field_id('nop'); ?>">
	  Number of Posts To Display:
	  <input class="upcoming" size="2" id="<?php echo $this->get_field_id('nop'); ?>" name="<?php echo $this->get_field_name('nop'); ?>" type="text" value="<?php echo esc_attr($nop); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
  
  wp_reset_query();
	wp_reset_postdata();
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['get_cate_posts'] = $new_instance['get_cate_posts'];	
	$instance['nop'] = $new_instance['nop'];
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$get_cate_posts = isset( $instance['get_cate_posts'] ) ? esc_attr( $instance['get_cate_posts'] ) : '';		
		$nop = isset( $instance['nop'] ) ? esc_attr( $instance['nop'] ) : '';		
		if($nop == ""){$nop = '-1';}
		echo $before_widget;	
		// WIDGET display CODE Start
		if (!empty($title))
			echo $before_title;
			echo $title;
			echo $after_title;
			global $wpdb, $post;
			?>
			<ul id="popular_post">
			<?php
				$category_array = get_term_by('id', $get_cate_posts, 'recipe-category');
				$popularpost = new WP_Query( array( 'posts_per_page' => $nop, 'post_type'=> 'post', 'meta_key' => 'popular_post_views_count', 'orderby' => 'popular_post_views_count meta_value_num', 'order' => 'DESC'  ) );
					while ( $popularpost->have_posts() ) : $popularpost->the_post();
					global $post;
					$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
					if($post_detail_xml <> ''){
						$cp_post_xml = new DOMDocument ();
						$cp_post_xml->loadXML ( $post_detail_xml );
						$post_social = find_xml_value($cp_post_xml->documentElement,'post_social');
						$sidebars = find_xml_value($cp_post_xml->documentElement,'sidebar_post');
						$right_sidebar_post = find_xml_value($cp_post_xml->documentElement,'right_sidebar_post');
						$left_sidebar_post = find_xml_value($cp_post_xml->documentElement,'left_sidebar_post');
						$post_thumbnail = find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
						$video_url_type = find_xml_value($cp_post_xml->documentElement,'video_url_type');
						$select_slider_type = find_xml_value($cp_post_xml->documentElement,'select_slider_type');			
					}
					?>
					<li>
						<?php if($post_thumbnail == 'Image'){echo '<span> <i class="icon-picture"></i> </span>';}else if($post_thumbnail == 'Video'){echo '<span><i class="icon-facetime-video"></i></span>';}else{echo '<span><i class="icon-tasks"></i></span>';}?>
						<?php
							// $thumbnail_id = get_post_thumbnail_id( $post->ID );
							// $thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(60,60) );
								// if($thumbnail[1].'x'.$thumbnail[2] == '60x60'){
									// echo '<a href="#">'.get_the_post_thumbnail($post->ID, array(60,60)).'</a>';		
								// }
							?>
						<p><a href="<?php echo get_permalink();?>"><?php echo strip_tags(htmlspecialchars(substr(get_the_content(),0,40)));?></a></p>	
					</li>
				<?php endwhile;?>
			</ul>
			<!--<a class="v-a" href="http://www.google.com">+ <?php _e('View All','crunchpress');?> <span class="h-line"></span></a>-->
					
<?php wp_reset_query();
	wp_reset_postdata();
	echo $after_widget;
		}
	}
add_action( 'widgets_init', create_function('', 'return register_widget("popular_post");') );?>