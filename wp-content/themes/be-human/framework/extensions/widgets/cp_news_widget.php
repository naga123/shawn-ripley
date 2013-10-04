<?php
class recent_news_show extends WP_Widget
{
  function recent_news_show()
  {
    $widget_ops = array('classname' => 'recent_news_show', 'description' => 'Blog/News Post Widget' );
    $this->WP_Widget('recent_news_show', 'CrunchPress : Latest News', $widget_ops);
  }
 
  function form($instance)
  {
	wp_reset_query();
	wp_reset_postdata();
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$recent_post_category = isset( $instance['recent_post_category'] ) ? esc_attr( $instance['recent_post_category'] ) : '';
	$number_of_news = isset( $instance['number_of_news'] ) ? esc_attr( $instance['number_of_news'] ) : '';
?>
 <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	  Title: 
	  <input class="title"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
  <p>
  <label for="<?php echo $this->get_field_id('recent_post_category'); ?>">
	  Select Category:
	  <select id="<?php echo $this->get_field_id('recent_post_category'); ?>" name="<?php echo $this->get_field_name('recent_post_category'); ?>" style="width:225px">
		<?php
		
				foreach ( get_category_list_array('category') as $category){ ?>
                    <option <?php if(esc_attr($recent_post_category) == $category->slug){echo 'selected';}?> value="<?php echo $category->slug;?>" >
	                    <?php echo substr($category->name, 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?>
                    </option>						
			<?php }?>
      </select>
  </label>
  </p>  
  <p>
  <label for="<?php echo $this->get_field_id('number_of_news'); ?>">
	  Number of News
	<input class="title" size="5" id="<?php echo $this->get_field_id('number_of_news'); ?>" name="<?php echo $this->get_field_name('number_of_news'); ?>" type="text" value="<?php echo esc_attr($number_of_news); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['recent_post_category'] = $new_instance['recent_post_category'];	
	$instance['number_of_news'] = $new_instance['number_of_news'];	
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$recent_post_category = isset( $instance['recent_post_category'] ) ? esc_attr( $instance['recent_post_category'] ) : '';		
		$number_of_news = isset( $instance['number_of_news'] ) ? esc_attr( $instance['number_of_news'] ) : '';				
		echo $before_widget;	
		// WIDGET display CODE Start
		if (!empty($title))
			echo $before_title;
			echo $title;
			echo $after_title;
			global $wpdb, $post;
			wp_reset_query();
			//print_r($post_slider_slug);
			  $category_array = get_term_by('slug', $recent_post_category, 'category');
				global $post, $wp_query;
				$class_odd = '';
					$args = array(
						'posts_per_page'			=> $number_of_news,
						'post_type'					=> 'post',
						'category'					=> $recent_post_category,
						'post_status'				=> 'publish',
						'order'						=> 'ASC',
						);
					query_posts($args);
					if ( have_posts() <> "" ) {?>
					<ul class="latest_post">
					<?php
						$counter_news = 0;
							while ( have_posts() ): the_post();
							$counter_news++;
							if($counter_news == 1){?>
							<li class="news-h first_post_news"> 
								<a href="<?php echo get_permalink();?>">
								<?php
									$thumbnail_id = get_post_thumbnail_id( $post->ID );
									$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(300,110) );
										if($thumbnail[1].'x'.$thumbnail[2] == '300x110'){
											echo get_the_post_thumbnail($post->ID, array(300,110));		
										}
									?>
								</a>
								<h3><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h3>
								<p><?php echo substr(get_the_content(),0,300);?></p>
							</li>
							<?php }else{ ?>
							<li class="news-h rest_post_news">
								<?php
									$thumbnail_id = get_post_thumbnail_id( $post->ID );
									$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(300,110) );
										if($thumbnail[1].'x'.$thumbnail[2] == '300x110'){
											echo get_the_post_thumbnail($post->ID, array(300,110));		
										}
								?>
								<span class="text_wrapper">
									<h3><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h3>
									<p><?php echo substr(get_the_content(),0,200);?>.</p>
									<a href="<?php echo get_permalink();?>" class="v-a">+ <?php _e('Keep Reading','crunchpress');?> <span class="h-line"></span></a>
								</span>
							</li>
							<?php }
							endwhile;?>
					</ul>
							<?php
					}
	wp_reset_query();
	wp_reset_postdata();
	echo $after_widget;
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("recent_news_show");') );?>