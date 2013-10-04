<?php
class product_slider_widget extends WP_Widget
{
  function product_slider_widget()
  {
    $widget_ops = array('classname' => 'slider_products', 'description' => 'Event Box Widget' );
    $this->WP_Widget('product_slider_widget', 'CrunchPress : Product Slider Widget', $widget_ops);
  }
 
  function form($instance)
  {
	wp_reset_query();
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';
?>
  <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	  Title: 
	  <input class="upcoming"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
<p>
  <label for="<?php echo $this->get_field_id('select_category'); ?>">
	  Select Category:
	  <select id="<?php echo $this->get_field_id('select_category'); ?>" name="<?php echo $this->get_field_name('select_category'); ?>" style="width:225px">
		<?php
        global $wpdb,$post;
		foreach ( get_category_list_array('product_cat') as $category){ ?>
                    <option <?php if(esc_attr($c) == $category->slug){echo 'selected';}?> value="<?php echo $category->slug;?>" >
	                    <?php echo substr($category->name, 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?>
                    </option>						
			<?php }?>
      </select>
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['select_category'] = $new_instance['select_category'];	
	
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		wp_reset_query();
		wp_reset_postdata();
		
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';		
		
		
		echo $before_widget;	
		// WIDGET display CODE Start
		if (!empty($title))
			echo $before_title;
			echo '<i class="icon-pushpin"></i>';
			echo $title;
			echo $after_title;
			global $wpdb, $post;
			wp_reset_query();?>
				<ul id="slider_products">
					<?php
					$category_array = get_term_by('slug', $select_category, 'product_cat');
					global $post, $wp_query;
					$class_odd = '';
						$args = array(
							'posts_per_page'			=> -1,
							'post_type'					=> 'product',
							'event-category'			=> $select_category,
							'post_status'				=> 'publish',
							'orderby'					=> 'meta_value',
							'order'						=> 'DESC',
							);
						query_posts($args);
						 if ( have_posts() <> "" ) {
						 $counter_new = 0;
							while ( have_posts() ): the_post();
								$regular_price = get_post_meta($post->ID, '_regular_price', true);
								if($regular_price == ''){
									$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
								}
								$sale_price = get_post_meta($post->ID, '_sale_price', true);
								if($sale_price == ''){
									$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
								}
								$currency = get_woocommerce_currency_symbol();
							?>				
							<li> 
								<div class="product_img"> <?php echo get_the_post_thumbnail($post_id, array(300,110));;?> </div>
								<div class="bottom_sec"> <span class="price"><?php echo $regular_price;?></span><span><a href="<?php echo get_permalink();?>"><?php _e('Add to cart','crunchpress');?><i class="icon-shopping-cart"></i></a></span></div>
							</li>
						<?php 
						endwhile;
						}?>
				</ul>
	<?php
	wp_reset_query();
	wp_reset_postdata();
	echo $after_widget;
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("product_slider_widget");') );?>