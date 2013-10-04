<?php get_header(); 
 if ( have_posts() ){ while (have_posts()){ the_post();
	
	global $post;
	
	$team_social = '';
	$sidebar = '';
	$left_sidebar = '';
	$right_sidebar = '';
	$team_designation = '';
	// Get Post Meta Elements detail 
	$team_detail_xml = get_post_meta($post->ID, 'team_detail_xml', true);
	if($team_detail_xml <> ''){
		$cp_team_xml = new DOMDocument ();
		$cp_team_xml->loadXML ( $team_detail_xml );
		$team_social = find_xml_value($cp_team_xml->documentElement,'team_social');
		$sidebar = find_xml_value($cp_team_xml->documentElement,'sidebar_team');
		$left_sidebar = find_xml_value($cp_team_xml->documentElement,'left_sidebar_team');
		$right_sidebar = find_xml_value($cp_team_xml->documentElement,'right_sidebar_team');
		$team_designation = find_xml_value($cp_team_xml->documentElement,'team_designation');
	}
	
	$team_detail_xml = get_post_meta($post->ID, 'team_detail_xml', true);
	if($team_detail_xml <> ''){
		$cp_team_xml = new DOMDocument ();
		$cp_team_xml->loadXML ( $team_detail_xml );
		$team_designation = find_xml_value($cp_team_xml->documentElement,'team_designation');
		$team_facebook = find_xml_value($cp_team_xml->documentElement,'team_facebook');
		$team_linkedin = find_xml_value($cp_team_xml->documentElement,'team_linkedin');
		$team_twitter = find_xml_value($cp_team_xml->documentElement,'team_twitter');
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
						<section class="span12 first mbtm2 outer_lyr">
							<section class="inner_lyr">
								<h3 class="heading1 bg-div"><span class="inner"><a><strong><?php echo get_the_title();?></strong></a><span class="bgr1"></span></span></h3>
								<section class="section_content"> 
									<div class="span3 first img">
										<?php
											$thumbnail_id = get_post_thumbnail_id( $post->ID );
											$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(175,155) );
											if($thumbnail[1].'x'.$thumbnail[2] == '175x155'){
												echo '<figure class="img_team_feature">'.get_the_post_thumbnail($post->ID, array(175,155)).'</figure>';		
											}				
										?>
									</div>
									<div class="span9"> 
										<h3><?php echo $team_designation?></h3>
										<?php the_content();
											wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'cp_front_end' ) . '</span>', 'after' => '</div>' ) );?>
											<div id="socialicons">
												<?php if(isset($team_facebook) AND $team_facebook <> ''){?>
												<a title="Facebook Sharing" href="<?php echo $team_facebook;?>" class="social_active" id="fb_hr">
													<span class="da-animate da-slideFromLeft"></span>
												</a>
												<?php }?>
												<?php if(isset($team_twitter) AND $team_twitter <> ''){?>
												<a title="Twitter Sharing" href="<?php echo $team_twitter;?>" class="social_active" id="twitter_hr">
													<span class="da-animate da-slideFromLeft"></span>
												</a>
												<?php }?>
												<?php if(isset($team_linkedin) AND $team_linkedin <> ''){?>
												<a title="Linked In Sharing" href="<?php echo $team_linkedin;?>" class="social_active" id="linked_hr">
													<span class="da-animate da-slideFromLeft"></span>
												</a>
												<?php }?>
											</div>	
									</div>
								</section>
							</section>
						</section>
						<div class="clear"></div>
							  <?php
								// About Author
								if(get_post_meta($post->ID, 'post-option-author-info-enabled', true) == "Yes"){?>
								<article class="author-art">
									<strong class="title7"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo ucfirst(get_the_author()); ?></a></strong>
									<div class="author-inner">
										<?php echo get_avatar(get_the_author_meta( 'ID' ));?>
										<p><?php echo mb_substr(get_the_author_meta( 'description' ),0,360); if(strlen(get_the_author_meta( 'description' )) > 360){?>   <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><strong> Continue...</strong></a><?php }?></p>
									</div>
								</article>
							<?php
								}?>
								<div class="clear"></div>
							<?php 								
								// Include Social Shares
								if($team_social == "enable"){
									echo include_social_shares();
									echo "<div class='clear'></div>";
								}
							echo '<div class="user_comments inner_page">';
									comments_template(); 
								echo '</div>'; ?>
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