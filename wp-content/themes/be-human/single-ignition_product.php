<?php get_header(); 
 if ( have_posts() ){ while (have_posts()){ the_post();
	
	global $post;
	$ignition_date = get_post_meta($post->ID, 'ign_fund_end', true);
	$ignition_datee = date('d-m-Y h:i:s',strtotime($ignition_date));

	$ign_project_id = get_post_meta($post->ID, 'ign_project_id', true);

	$ign_fund_goal = get_post_meta($post->ID, 'ign_fund_goal', true);

	$ign_product_image1 = get_post_meta($post->ID, 'ign_product_image1', true);

	$getPledge_cp = getPledge_cp($ign_project_id);
	$current_date = date('d-m-Y h:i:s');
	$project_date = new DateTime($ignition_datee);
	$current = new DateTime($current_date);
	$interval = $project_date->diff($current);
	
	
	
	global $paged,$post,$sidebar,$counter,$wp_query;	
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
	$purchaseform = '';
	$sidebar_class = '';
	$content_class = '';
	//Sidebar for archives
	$sidebar_class = sidebar_func($sidebar);
	
	?>
	<div id="progress_news" class="mbtm">
		<div class="container-fluid container">
			<section id="blockContainer" class="row-fluid">
			<?php
				
					breadcrumbs_html();
				
			?>
				<section class="page_content">
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
					<div id="post-<?php the_ID(); ?>" class="fund_project_detail <?php echo $sidebar_class[1];?> holder-container inner-page">
						<div <?php post_class(); ?>>
						<?php 
						//if($_GET['purchaseform'] == 1 AND $_GET['prodid'] == $ign_project_id){ 
							//echo do_shortcode('[project_purchase_form product="' . $ign_project_id . '"]');
						//}else{ ?>
							<figure class="span12 first outer_lyr" id="category_image"> 
								<img src="<?php echo $ign_product_image1;?>" alt=""/>
								<figure class="span12 first fund_project" id="charity_progress">
									<div class="span12 first">
										<div class="progress progress-striped active">  
											<div style="width:<?php echo getPercentRaised_cp($ign_project_id);?>%;" class="bar p80"></div>
										</div>
										<div class="info">
											<div class="span3 first">
												<i class="icon-user"></i> <span> <?php echo $getPledge_cp[0]->p_number;?> </span> <?php _e('Pledgers','crunchpress');?>
											</div>
											<div class="span4 first">
												<i class="icon-fullscreen"></i> <span> <?php _e('Pledged of','crunchpress');?> $<?php echo $ign_fund_goal;?> <?php _e('Goal','crunchpress');?> </span>
											</div>
											<div class="span2 first">
												 <i class="icon-dashboard"></i>  <span> $<?php echo getTotalProductFund_cp($ign_project_id);?> </span>
											</div>
											<div class="span3" id="dayz">
												<i class="icon-calendar-empty"></i> <span> <?php echo $interval->days;?> </span> <?php _e('Days Left','crunchpress');?>
											</div>
										</div>
									</div>
								</figure>
							</figure>
							<figure class="span12 first outer_lyr" id="project_contet">
								<div class="inner_lyr">
									<h3><?php echo get_the_title();?></h3>
									<?php the_content();?>
								</div>
							</figure>					
							<?php
							$project_type = get_post_meta( $post->ID, "ign_project_type", true );
							$meta_no_levels = get_post_meta( $post->ID, $name="ign_product_level_count", true );
							if($project_type == 'level-based'){
							?>
							<figure class="span12 first">
								<a href="#" class="tier_button"><?php _e('Donation Tiers','crunchpress');?></a>
								<ul id="tiers">
								<?php
									
										$meta_title = stripslashes(get_post_meta( $post->ID, $name="ign_product_title", true ));
										$meta_limit = get_post_meta( $post->ID, $name="ign_product_limit", true );
										$meta_price = get_post_meta( $post->ID, $name="ign_product_price", true );
										$meta_desc = stripslashes(get_post_meta( $post->ID, $name="ign_product_details", true ));
										?>
										<li><span class="span3 first"><strong>  <?php echo $meta_title;?> </strong> : <?php _e('Pledge','crunchpress');?> <?php echo $meta_limit;?> <?php _e('Limited','crunchpress');?> <?php echo $meta_price;?> <?php _e('Spots Only','crunchpress');?> </span> <span class="span8"> <?php echo $meta_desc;?><a href="#" class="donate_btn pull-right"><?php _e('Donate','crunchpress');?></a> </span> </li>
										<?php
										
										for ($i=2 ; $i <= $meta_no_levels ; $i++) {
											$meta_title = stripslashes(get_post_meta( $post->ID, $name="ign_product_level_".($i)."_title", true ));
											$meta_limit = get_post_meta( $post->ID, $name="ign_product_level_".($i)."_limit", true );
											$meta_price = get_post_meta( $post->ID, $name="ign_product_level_".($i)."_price", true );
											$meta_desc = stripslashes(get_post_meta( $post->ID, $name="ign_product_level_".($i)."_desc", true ));
											?>
											<li><span class="span3 first"><strong>  <?php echo $meta_title;?> </strong> : <?php _e('Pledge','crunchpress');?> <?php echo $meta_limit;?> <?php _e('Limited','crunchpress');?> <?php echo $meta_price;?> </span> <span class="span8"> <?php echo $meta_desc;?><a href="#" class="donate_btn pull-right"><?php _e('Donate','crunchpress');?></a> </span> </li>
											<?php
										}
									
								?>
								</ul>
							</figure>
							<?php }
						//}	
							?>
						</div>
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