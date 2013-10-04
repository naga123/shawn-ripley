<?php get_header(); ?>
<?php if ( have_posts() ){ while (have_posts()){ the_post();
	global $post;
	
	// Get Post Meta Elements detail 
	$post_social = '';
	$sidebar = '';
	$right_sidebar = '';
	$left_sidebar = '';
	$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
	if($post_detail_xml <> ''){
		$cp_post_xml = new DOMDocument ();
		$cp_post_xml->loadXML ( $post_detail_xml );
		$post_social = find_xml_value($cp_post_xml->documentElement,'post_social');
		$sidebar = find_xml_value($cp_post_xml->documentElement,'sidebar_post');
		$right_sidebar = find_xml_value($cp_post_xml->documentElement,'right_sidebar_post');
		$left_sidebar = find_xml_value($cp_post_xml->documentElement,'left_sidebar_post');
	}
	
	$sidebar_class = '';
	$content_class = '';
	
	//Get Sidebar for page
	$sidebar_class = sidebar_func($sidebar);
	?>
	<div id="progress_news" class="mbtm">
		<div class="container-fluid container">
			<section id="blockContainer" class="row-fluid">
			<?php
				if(!is_front_page()){
					breadcrumbs_html();
				}
			?>
				<section class="page_content">
					<?php
					if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){?>
						<div id="block_first" class="sidebar <?php echo $sidebar_class[0];?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-left'){?>
					<div id="block_first_left" class="sidebar <?php echo $sidebar_class[0];?>">
						<?php dynamic_sidebar( $right_sidebar );?>
					</div>
					<?php } ?>
					<div id="post-<?php the_ID(); ?>" class="<?php echo $sidebar_class[1];?> blog_post_detail">
						<div <?php post_class(); ?>>
							<figure class="post_title">
								<h2 class="heading"><?php echo get_the_title();?></h2><span class="border-line m-bottom"></span>
							</figure>
							<figure class="blog_post mbtm">
								<div class="gallery_img gallery_img-first">
								<?php
									$slider_name = 'anything'.$post->ID;
										// Inside Thumbnail
										if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
												//$item_size = "620x230";
												$item_size = array(770, 400);
											}else if( $sidebar == "both-sidebar" ){
												$item_size = array(570,300);
											}else{
												$item_size = array(1170,420);
											} 
										echo '<figure class="blog_featured_image post_featured_image">';
											echo print_blog_thumbnail($post->ID,$item_size);
										echo '</figure>';
									?>
								</div>  

								<div class="span12 first post_detail"> 
									<h3><a> <?php echo get_the_title();?></a></h3>
									<?php the_content();?>
								</div>
								<div class="post_meta_detail"> 
									<ul>
										<li class="tags pull-right"> <i class="icon-tags"></i>
										<?php 
										$variable_tags = wp_get_post_terms( $post->ID, 'post_tag');
										$counterr = 0;
										foreach($variable_tags as $values){
											if($counterr == 0){ echo 'Tags:  ';}
											$counterr++;
											echo '<a href="'.get_term_link(intval($values->term_id),'post_tag').'">'.$values->name.'</a>  ';}?>
										</li>
										<li class="category "><i class="icon-reorder"></i>
										<?php 
										$variable_category = wp_get_post_terms( $post->ID, 'category');
										$counterr = 0;
										foreach($variable_category as $values){
											if($counterr == 0){ echo 'Category:  ';}
											$counterr++;
											echo '<a href="'.get_term_link(intval($values->term_id),'category').'">'.$values->name.'</a>  ';}?> </li>
									</ul>
								</div>
							</figure>
							<figure id="author_bio" class="span12 mbtm first">
								<div class="inner">
									<?php 
									// About Author
									echo get_post_meta($post->ID, 'post-option-author-info-enabled', true);
									 
									 ?>
									<div class="span6 first author_Summary">
										<div class="span2 first"><?php echo get_avatar(get_the_author_meta( 'ID' ));?></div>
										<div class="span9"> 
										<h3><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo ucfirst(get_the_author()); ?></a></h3>
										<p><?php echo mb_substr(get_the_author_meta( 'description' ),0,200);?></p>
										<?php if(strlen(get_the_author_meta( 'description' )) > 200){?>   <a class="view_posts" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php _e('View Post','crunchpress');?> </a><?php }?>
										</div>
									</div>
									
									<div class="span6 share_this">
										<h3><?php _e('Share this Story','crunchpress');?></h3>
										<p><?php _e('Do you like this post or do you just want to share it with people you know?','crunchpress');?></p>
										<?php
											if($post_social == "enable"){
												echo include_social_shares();
											}
										?>
									</div>
								</div>
							</figure>
							<?php 
								if(related_posts($post->ID) <> ''){
									echo '<div class="related_artiles text-divider2">';
										echo related_posts($post->ID);
									echo '</div>';
									echo "<div class='clear'></div>";
								}
								
																	
								//echo '<div class="clear"></div>';
								// Include Social Shares
								//if($post_social == "enable"){
									//echo include_social_shares();
									//echo "<div class='clear'></div>";
								//}
								echo "<div class='clear'></div>";
								echo '<div class="user_comments inner_page">';
									comments_template(); 
								echo '</div>';
							?>
						</div>
					</div>
					<?php
					if($sidebar == "both-sidebar-right"){?>
						<div class="<?php echo $sidebar_class[0];?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-right' || $sidebar == "right-sidebar" || $sidebar == "both-sidebar"){?>
					<div class="<?php echo $sidebar_class[0];?>">
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