<?php
/*
 * This file is used to generate WordPress standard archive/category pages.
 */
get_header ();
	
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
	global $paged,$post,$sidebar,$blog_div_size_num_class,$counter,$wp_query;	
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
	
        $sidebar_class = '';
		$content_class = '';
        //Sidebar for archives
		$sidebar_class = sidebar_func($sidebar);					
		//breadcrumbs_html();
		?>
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
							<div <?php post_class(); ?>>
								<figure id="page_title">
									<div class="span8 first">
									<?php if (is_category()) { ?>
									<h2 class="heading"><?php _e('Categories', 'cp_front_end'); ?> <?php echo single_cat_title(); ?></h2><span class="border-line m-bottom"></span>
									<?php } elseif (is_day()) { ?>
										<h2 class="heading"><?php _e('Archive for', 'cp_front_end'); ?> 
										<?php echo get_the_date(get_option("time_format")); ?></h2><span class="border-line m-bottom"></span>
									<?php } elseif (is_month()) { ?>
										<h2 class="heading"><?php _e('Archive for', 'cp_front_end'); ?> <?php echo get_the_date(get_option("time_format")); ?></h2><span class="border-line m-bottom"></span>
									<?php } elseif (is_year()) { ?>
										<h2 class="heading"><?php _e('Archive for', 'cp_front_end'); ?> <?php echo get_the_date(get_option("time_format")); ?></h2><span class="border-line m-bottom"></span>
									<?php }elseif (is_search()) { ?>
										<h2 class="title2"><?php _e('Search results for', 'cp_front_end'); ?> : <?php echo get_search_query() ?></h2><span class="border-line m-bottom"></span>
									<?php } elseif (is_tag()) { ?>
										<h2 class="title2"><?php _e('Tag Archives', 'cp_front_end'); ?> : <?php echo single_tag_title('', true); ?></h2><span class="border-line m-bottom"></span>
										<?php }elseif (is_author()) { ?>
										<h2 class="heading"><?php _e('Archive by Author', 'cp_front_end'); ?></h2><span class="border-line m-bottom"></span>
										<?php }?>
									</div>
								</figure>
								<?php if (is_author()) { ?>
										<!--<h2 class="heading"><?php _e('Archive by Author', 'cp_front_end'); ?></h2><span class="border-line m-bottom"></span>-->
									<?php 
									if ( have_posts() ) {
										the_post();?>
										<div class="clear"></div>
										<div class="span12 first mbtm2 outer_lyr">
											<div class="inner_lyr">
												<div class="span2 first img"><?php echo get_avatar(get_the_author_meta( 'ID' ));?></div>
												<div class="span10"> 
													<h3><?php echo get_the_author();?></h3>
													<p><?php echo get_the_author_meta( 'description' );?></p>
												</div>
											</div>
										</div>
										<div class="clear"></div>
									<?php
									}
								} wp_reset_query();
								if ( have_posts() ) : while ( have_posts() ) : the_post();
								global $post, $post_id;
									//Image dimenstion
									$arc_div_size_num_class = array("Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1170,420), "size2"=>array(770, 400), "size3"=>array(570,300)));
									$item_type = 'Full-Image';
									$item_class = $arc_div_size_num_class[$item_type]['class'];
									$item_index = $arc_div_size_num_class[$item_type]['index'];
									if( $sidebar == "no-sidebar" ){
										$item_size = $arc_div_size_num_class[$item_type]['size'];
									}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
										$item_size = $arc_div_size_num_class[$item_type]['size2'];
									}else{
										$item_size = $arc_div_size_num_class[$item_type]['size3'];
									}		
								?>
									<figure class="blog_item">
										<div class="gallery_img gallery_img-first">
											<?php echo get_the_post_thumbnail($post_id, $item_size);?>
											<div class="mask">
												<a href="<?php echo get_permalink();?>#comments" class="anchor"><span> </span> <i class="icon-comment"></i></a>
												<a href="<?php echo get_permalink();?>" class="anchor"> <i class="icon-link"></i></a>
											</div>
										</div>  
										<div class="outer_lyr span12 first">
											<div class="inner_lyr">
												<div class="span3 first post_meta"> 
													<ul>
														<li class="date"> <i class="icon-time"></i>  <?php echo get_the_date();?></li>
														<li class="author"><i class="icon-user"></i> by   <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author_link();?></a></li>
														<li class="commetns"> <i class="icon-comment"></i>  <?php comments_popup_link( __('0 Comment','cp_front_end'),__('1 Comment','cp_front_end'),__('% Comments','cp_front_end'), '',__('Comments are off','cp_front_end') );?></li>
														<!--<li class="tags"> <i class="icon-tags"></i><a href="#"> Charity , Donation, Food, Free Education </a></li>-->
														<li class="category"> <i class="icon-reorder"></i>
														<?php 
														$variable = wp_get_post_terms( $post->ID, 'category'); $counterr = 0;
														foreach($variable as $values){
															//if($counterr == 0){ echo 'Category:  ';}
															$counterr++;
															echo '<a href="'.get_term_link(intval($values->term_id),'category').'">'.$values->name.'</a>  ';}?>
														</li>
													</ul>						
												</div>
												<div class="span9 post_description"> 
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