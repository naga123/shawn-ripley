<?php get_header(); 
 if ( have_posts() ){ while (have_posts()){ the_post();
	
	global $post;
	
	$career_social = '';
	$sidebar = '';
	$left_sidebar = '';
	$right_sidebar = '';
	$career_city = '';	
	$career_salary = '';
	$career_country = '';
	$career_apply = '';
	$date_posted = '';
	$date_posted = get_post_meta($post->ID, 'date_posted', true);
	$career_detail_xml = get_post_meta($post->ID, 'career_detail_xml', true);
	if($career_detail_xml <> ''){
		$cp_event_xml = new DOMDocument ();
		$cp_event_xml->loadXML ( $career_detail_xml );
		$career_social = find_xml_value($cp_event_xml->documentElement,'career_social');
		$sidebar = find_xml_value($cp_event_xml->documentElement,'sidebar_event');
		$left_sidebar = find_xml_value($cp_event_xml->documentElement,'left_sidebar_event');
		$right_sidebar = find_xml_value($cp_event_xml->documentElement,'right_sidebar_event');
		$career_city = find_xml_value($cp_event_xml->documentElement,'career_city');
		$career_salary = find_xml_value($cp_event_xml->documentElement,'career_salary');
		$career_country = find_xml_value($cp_event_xml->documentElement,'career_country');
		$career_apply = find_xml_value($cp_event_xml->documentElement,'career_apply');
	}
	
	
	
	$sidebar_class = '';
	$content_class = '';
	
	//Get Sidebar for page
	$sidebar_class = sidebar_func($sidebar);
	
	 
	 ?>	
	<div class="content-holder1 inner-pages">
		<div class="container container-fluid">
		<?php breadcrumbs_html();?>
				<section id="blockContainer" class="row-fluid">
					<?php
					if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){?>
						<div class="column <?php echo $sidebar_class[0];?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-left'){?>
					<div class="column <?php echo $sidebar_class[0];?>">
						<?php dynamic_sidebar( $right_sidebar );?>
					</div>
					<?php } ?>
					<div id="post-<?php the_ID(); ?>" class="column <?php echo $sidebar_class[1];?> holder-container inner-page">
						<div <?php post_class(); ?>>
							<article class="career_detail_wrapper blog_detail_wrapper text-divider2">
								<figure class="post_title"><h2><?php echo get_the_title();?></h2></figure>
								<ul class="career-list">
									<li><strong><?php echo __('Date Posted','cp_front_end') ?></strong><span><?php echo get_the_date(get_option('date_format'));?></span></li>
									<li><strong><?php echo __('Last Posted','cp_front_end') ?></strong><span><?php echo date(get_option('date_format'),strtotime($date_posted));?></span></li>
									<li><strong><?php echo __('City','cp_front_end') ?></strong><span><?php echo $career_city;?></span></li>
									<li><strong><?php echo __('Country','cp_front_end') ?></strong> <span><?php echo $career_country;?></span></li>
									<li><strong><?php echo __('Salary','cp_front_end') ?></strong><span><?php echo $career_salary;?></span></li>
									<?php
									$jobs_post_name = '';
									$jobs_post_title = '';
		
									$jobs_post_name = get_post_meta($post->ID, 'jobs_post_name', true);
									$jobs_post_title = get_post_meta($post->ID, 'jobs_post_title', true);
									
									if($jobs_post_name <> ''){
										$ingre_xml = new DOMDocument();
										$ingre_xml->loadXML($jobs_post_name);
										$children = $ingre_xml->documentElement->childNodes;
										$nofields = $ingre_xml->documentElement->childNodes->length;
									}
									if($jobs_post_title <> ''){
										$ingre_title_xml = new DOMDocument();
										$ingre_title_xml->loadXML($jobs_post_title);
										$children_title = $ingre_title_xml->documentElement->childNodes;
									}
										
										$counter = 0;
										//$ingre_xml->documentElement->childNodes;
										
										if($nofields <> 0){ 
											for($i=0;$i<$nofields;$i++) { 
												echo '<li><strong>'.$children->item($i)->nodeValue.'</strong>';
												echo '<span>'.$children_title->item($i)->nodeValue.'</span></li>';
											}
										}
									
									
									?>
								</ul>
								<?php the_content();
								  wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'cp_front_end' ) . '</span>', 'after' => '</div>' ) );
								  ?>
								   <?php if($career_apply <> ''){?><a class="more-btn1" href="<?php echo $career_apply;?>"><?php _e('Apply Now','cp_front_end'); ?></a><?php }?>
							</article>
						</div>
						<div class="clear"></div>
							  <?php
								// About Author
								if(get_post_meta($post->ID, 'post-option-author-info-enabled', true) == "Yes"){?>
								<article class="author-art">
									<strong class="title7"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo ucfirst(get_the_author()); ?></a></strong>
									<div class="author-inner">
										<?php echo get_avatar(get_the_author_meta( 'ID' ));?>
										<p><?php echo mb_substr(get_the_author_meta( 'description' ),0,360); if(strlen(get_the_author_meta( 'description' )) > 360){?>   <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><strong><?php _e('Continue...','crunchpress');?></strong></a><?php }?></p>
									</div>
								</article>
							<?php
								}?>
								<div class="clear"></div>
							<?php 								
								// Include Social Shares
								if($career_social == "enable"){
									echo include_social_shares();
									echo "<div class='clear'></div>";
								}
							echo '<div class="user_comments inner_page">';
									comments_template(); 
								echo '</div>'; ?>
						</div>
					<?php
					if($sidebar == "both-sidebar-right"){?>
						<div class="column <?php echo $sidebar_class[0];?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-right' || $sidebar == "right-sidebar" || $sidebar == "both-sidebar"){?>
					<div class="column <?php echo $sidebar_class[0];?>">
						<?php dynamic_sidebar( $right_sidebar );?>
					</div>
					<?php } ?>						   
				</section>
		</div>
	</div>
<?php 
	}
}
?>
<div class="clear"></div>
<?php get_footer(); ?>