<?php
/*
 * This file is used to generate WordPress standard recipe taxonomy pages.
 */
get_header ();

	global $paged,$post,$sidebar,$arc_div_size_num_class,$counter,$wp_query;	
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		//Get Default Option for Archives, Category, Search.
		$num_excerpt = '';
		$cp_default_settings = get_option('default_pages_settings');
		if($cp_default_settings != ''){
			$cp_default = new DOMDocument ();
			$cp_default->loadXML ( $cp_default_settings );
			$sidebar = find_xml_value($cp_default->documentElement,'sidebar_default');
			$right_sidebar = find_xml_value($cp_default->documentElement,'right_sidebar_default');
			$left_sidebar = find_xml_value($cp_default->documentElement,'left_sidebar_default');
			$num_excerpt = find_xml_value($cp_default->documentElement,'default_excerpt');
		}	
		//Get Default Excerpt
		if($num_excerpt == ''){$num_excerpt = 250;}
        $sidebar_class = '';
		$content_class = '';
        //Sidebar for Taxonomy
		$sidebar_class = sidebar_func($sidebar);
		
		?>
		<div class="clear"></div>
	<div class="content-holder1 inner-pages">
		<div class="container-fluid container">
		<?php breadcrumbs_html();?>
				<section id="blockContainer" class="row-fluid">
					<?php
					if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){?>
						<div id="block_first" class="<?php echo $sidebar_class[0];?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-left'){?>
					<div id="block_first_left" class="<?php echo $sidebar_class[0];?>">
						<?php dynamic_sidebar( $right_sidebar );?>
					</div>
					<?php } ?>
					<div id="post-<?php the_ID(); ?>" class="<?php echo $sidebar_class[1];?>">
						<h2 class="heading"><?php echo $wp_query->query['career-category'];?></h2>
						<div <?php post_class();?>></div>			
						<span class="border-line m-bottom"></span>
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
							global $post, $post_id;	
								$arc_div_size_num_class = array("Full Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1160,350), "size2"=>array(770,270), "size3"=>array(620,230)),);
								$item_type = 'Full Image';
								$item_class = $arc_div_size_num_class[$item_type]['class'];
								$item_index = $arc_div_size_num_class[$item_type]['index'];		
								if( $sidebar == "no-sidebar" ){
									$item_size = $arc_div_size_num_class[$item_type]['size'];
								}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
									$item_size = $arc_div_size_num_class[$item_type]['size2'];
								}else{
									$item_size = $arc_div_size_num_class[$item_type]['size3'];
								}?>
									<figure class="blog_item">
										<div class="gallery_img gallery_img-first">
											<div class="mask">
												<a href="<?php echo get_permalink();?>#comments" class="anchor"><span> </span> <i class="icon-comment"></i></a>
												<a href="<?php echo get_permalink();?>" class="anchor"> <i class="icon-link"></i></a>
											</div>
										</div>  
										<div class="outer_lyr span12 first">
											<div class="inner_lyr">
												<div class="span12 post_description"> 
													<h3><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h3>
													<?php echo substr(get_the_excerpt(),0, $num_excerpt);?>
													<br />
													<?php if(strlen(get_the_excerpt() > $num_excerpt)){?><a class="read_more" href="<?php echo get_permalink()?>"><em><?php echo __('Read More','cp_front_end') ?></em></a><?php }?>
												</div>
											</div>
										</div>
									</figure>
					<?php endwhile; endif;?>                
				</div>
					<?php
					if($sidebar == "both-sidebar-right"){?>
						<div id="block_second" class="<?php echo $sidebar_class[0];?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-right' || $sidebar == "right-sidebar" || $sidebar == "both-sidebar"){?>
						<div id="block_second_right" class="<?php echo $sidebar_class[0];?>">
							<?php dynamic_sidebar( $right_sidebar );?>
						</div>
					<?php } ?>
			 </section>
		</div>
	</div>
<?php get_footer(); ?>