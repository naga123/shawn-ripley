<?php
class cp_testimonial_show extends WP_Widget
{
  function cp_testimonial_show()
  {
    $widget_ops = array('classname' => 'testimonial_aa', 'description' => 'Our Testimonials Widget' );
    $this->WP_Widget('cp_testimonial_show', 'CrunchPress : Testimonial Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );

    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	$get_testimon_posts = empty($instance['get_testimon_posts']) ? ' ' : apply_filters('widget_title', $instance['get_testimon_posts']);	
	$number_of_testimonails = empty($instance['number_of_testimonails']) ? ' ' : apply_filters('widget_title', $instance['number_of_testimonails']);
	
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	  Title: 
	  <input class="upcoming"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
  <p>
  <label for="<?php echo $this->get_field_id('get_testimon_posts'); ?>">
	  Select Category:
	  <select id="<?php echo $this->get_field_id('get_testimon_posts'); ?>" name="<?php echo $this->get_field_name('get_testimon_posts'); ?>" style="width:225px">
		<?php
        global $wpdb,$post;
		$categories = get_category_list_array('testimonial-category');
			if($categories != ''){
				foreach ( $categories as $category){ ?>
                    <option <?php if(esc_attr($get_testimon_posts) == $category->term_id){echo 'selected';}?> value="<?php echo $category->term_id;?>" >
	                    <?php echo substr($category->name, 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?>
                    </option>						
			<?php }
			
			}?>
      </select>
  </label>
  </p>     
  <p>
  <label for="<?php echo $this->get_field_id('number_of_testimonails'); ?>">
	  Number of Testimonials to Show
	  <input class="upcoming"  id="<?php echo $this->get_field_id('number_of_testimonails'); ?>" name="<?php echo $this->get_field_name('number_of_testimonails'); ?>" type="text" value="<?php echo esc_attr($number_of_testimonails); ?>" />
  </label>
 </p> 
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['get_testimon_posts'] = $new_instance['get_testimon_posts'];
		$instance['number_of_testimonails'] = $new_instance['number_of_testimonails'];
    return $instance;
  }
 
	function widget($args, $instance)
	{
	
	wp_reset_query();
	wp_reset_postdata();
		global $post;
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$get_testimon_posts = isset( $instance['get_testimon_posts'] ) ? esc_attr( $instance['get_testimon_posts'] ) : '';		
		$number_of_testimonails = isset( $instance['number_of_testimonails'] ) ? esc_attr( $instance['number_of_testimonails'] ) : '';		
		echo $before_widget;	
		// WIDGET display CODE Start
		if (!empty($title))?>
		
		<script>
            jQuery(document).ready(function($) {
              $('.flexslider').flexslider({
                animation: 'fade',
                animationSpeed: 400, 
                pauseOnHover: true, 
                directionNav: true, 
                controlNav: true, 
                start: function(slider){
                  $('body').removeClass('loading');
                }
              });
            });

			jQuery(document).ready(function($) {
				$(".ourteam .flex-prev").empty();
				$(".ourteam .flex-next").empty();
				$(".ourteam .flex-next").append('<span class="font_aw"><i class="icon-chevron-sign-right"></i></span>');
				$(".ourteam .flex-prev").append('<span class="font_aw"><i class="icon-chevron-sign-left"></i></span>');
			});
        </script>
			<?php
			wp_enqueue_style('cp-flex-slider',CP_PATH_URL.'/frontend/css/flexslider.css');
			wp_register_script('cp-flex-slider', CP_PATH_URL.'/frontend/js/jquery.flexslider.js', false, '1.0', true);
			wp_enqueue_script('cp-flex-slider');
			?>
			<?php
				$category_array = get_term_by('id', $get_testimon_posts, 'testimonial-category');
				if($category_array <> ''){
					$args = array(
						'posts_per_page'			=> $number_of_testimonails,
						'post_type'					=> 'testimonial',
						'testimonial-category'		=> $category_array->name,
						'post_status'				=> 'publish',
						'order'						=> 'ASC',
						);
				}else{
					$args = array(
						'posts_per_page'			=> $number_of_testimonails,
						'post_type'					=> 'testimonial',
						'post_status'				=> 'publish',
						'order'						=> 'ASC',
						);
				}
				query_posts($args);
                if ( have_posts() <> "" ) {
				?>
                <div class="testimonials happy_customers">
                    <h3 class="heading"><?php echo $title;?></h3>
                    <div class="flexslider testimonail_slider">
                        <span class="font_aw quotes"><i class="icon-quote-left"></i></span>
                        <ul class="slides">
                            <?php 
                                while ( have_posts() ): the_post();
                                $position = get_post_meta($post->ID, 'testimonial-option-author-position', true);?>
                                <li class="slide-image">
                                    <div class="caption">
                                        <p><?php echo substr(get_the_content(),0,150);?><a href="#"> <?php echo get_the_title();?> </a> - <span> <?php echo $position;?> </span></p>
                                    </div>
                                </li>
                                <?php endwhile; wp_reset_query();
                                ?>
                        </ul>
                    </div>
                </div>
	<?php
				}else{
				
				echo '<h3>No Testimonial Found in this category</h3>';
				}
	wp_reset_query();
	wp_reset_postdata();
	echo $after_widget;
	}
		
}
add_action( 'widgets_init', create_function('', 'return register_widget("cp_testimonial_show");') );?>