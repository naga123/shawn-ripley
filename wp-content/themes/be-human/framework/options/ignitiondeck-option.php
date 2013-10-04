<?php

	/*	
	*	Crunchpress Portfolio Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Crunchpress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) Crunchpress
	*	---------------------------------------------------------------------
	*	This file create and contains the portfolio post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	//FRONT END RECIPE LAYOUT
	$wooproduct_class = array("Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1170,420), "size2"=>array(770, 400), "size3"=>array(570,300)));

	
	// Print Recipe item
	function print_ignition_item($item_xml){
		wp_reset_query();
		global $paged,$sidebar,$wooproduct_class,$post,$wp_query,$counter;
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		$sidebar_class = '';
		$layout_set_ajax = '';
		$item_type = 'Full-Image';
		// get the item class and size from array
		$item_class = $wooproduct_class[$item_type]['class'];
		$item_index = $wooproduct_class[$item_type]['index'];
		$full_content = find_xml_value($item_xml, 'show-full-news-post');
		if( $sidebar == "no-sidebar" ){
			$item_size = $wooproduct_class[$item_type]['size'];
			$sidebar_class = 'no_sidebar';
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$sidebar_class = 'one_sidebar';
			$item_size = $wooproduct_class[$item_type]['size2'];
		}else{
			$sidebar_class = 'two_sidebar';
			$item_size = $wooproduct_class[$item_type]['size3'];
		}
		
				
		// get the product meta value
		$header = find_xml_value($item_xml, 'header');
		$category = find_xml_value($item_xml, 'category');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');		
		
		$pagination = find_xml_value($item_xml, 'pagination');
		$category_name = '';
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'category');
			$category = $category_term->term_id;
			$category_name = $category_term->name;
		}
		// page header
		//if(!empty($header)){
			//echo '<h2>' . $header . '</h2><span class="border-line m-bottom"></span>';
		//}
		
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'category');
			$category = $category_term->slug;
		}
		$quan = array();
		$quantity = '';
		$total = '';
		$currency = '';
	?>
				<figure id="page_title">
					<div class="span8 first">
						<h2><?php echo $header;?></h2>
					</div>
					<div class="span4 title_right">
						<div class="dropdown" id="cart_dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" role="button" id="cart_down" href="#">
								<i class="icon-ticket"></i>
								<?php _e('Product Categories','crunchpress');?>
								<span class="caret"></span>
							</a>
							<div class="dropdown-menu" aria-labelledby="cart_down" role="menu" id="listing_dropdown">
								<ul>                    
									<?php
									$get_categories = get_categories( array('child_of' => $category, 'taxonomy' => 'category', 'hide_empty' => 0,'post_status' => 'publish') );
									if($get_categories <> ""){
										foreach ( $get_categories as $mycat ) { ?>
											<li><?php echo $mycat->cat_name;?><a href="<?php echo get_term_link(intval($mycat->term_id),'category');?>"><?php echo $mycat->count;?></a></li>
										<?php
										}
									}
									?>					
								</ul>
							</div>
						</div>
					</div>	
				</figure>
				<section class="fund_rasising_listing" id="fund_rasising_listing">  				
					<section class="span12 first projects_holder">
				<?php
					query_posts(array(
						'posts_per_page'			=> $num_fetch,
						'paged'						=> $paged,
						'post_type'					=> 'ignition_product',
						'category'					=> $category,
						'post_status'				=> 'publish',
						'order'						=> 'DESC',
					));
					$counter_ignition = 0;
					while( have_posts() ){
						global $post,$product,$woocommerce;	
						the_post();	
						
						$ignition_date = get_post_meta($post->ID, 'ign_fund_end', true);
						$ignition_datee = date('d-m-Y h:i:s',strtotime($ignition_date));
						
						$ign_project_id = get_post_meta($post->ID, 'ign_project_id', true);
						
						$ign_fund_goal = get_post_meta($post->ID, 'ign_fund_goal', true);
						
						$ign_product_image1 = get_post_meta($post->ID, 'ign_product_image1', true);
						
						$getPledge_cp = getPledge_cp($ign_project_id);
						$current_date = date('d-m-Y h:i:s');
						$project_date = new DateTime($ignition_datee);
						$current = new DateTime($current_date);
						//$interval = $project_date->diff($current);
						$days = round(($project_date->format('U') - $current->format('U')) / (60*60*24));
						//echo getTotalProductFund_cp($post->ID);
						//echo getTotalProductFund_cp($ign_project_id);
						if($counter_ignition % 3 == 0){ 
						
						// $diff  = $current_date - $ignition_datee;
						// $remaing = date('d',strtotime($diff));
						
						
						//print_r($interval->days);
						
						//echo getPercentRaised_cp($post->ID);
						?>
						<section class="span4 first fund_project" id="">
							<h3><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h3>
							<img src="<?php echo $ign_product_image1;?>" alt=""/>
							<span class="current_collection">$<?php echo getTotalProductFund_cp($ign_project_id);?></span>
							<h4><?php _e('Pledged of','crunchpress');?> $<?php echo $ign_fund_goal;?><?php _e('Goal','crunchpress');?> </h4>
							<div class="progress progress-striped active">  
								<div style="width:<?php echo getPercentRaised_cp($ign_project_id);?>%;" class="bar p80"></div>    
							</div>
							<div class="info">
								<div class="span6 first">
									<i class="icon-user"></i><span><?php echo $getPledge_cp[0]->p_number;?></span> <?php _e('Pledgers','crunchpress');?>
								</div>
								<div class="span6">
									<i class="icon-calendar-empty"></i><span><?php echo $days;?></span> <?php _e('Days Left','crunchpress');?>
								</div>
							</div>
						</section>
					<?php }else{ ?>	
						<section class="span4 fund_project" id="">
							<h3><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h3>
							<img src="<?php echo $ign_product_image1;?>" alt=""/>
							<span class="current_collection">$<?php echo getTotalProductFund_cp($ign_project_id);?></span>
							<h4><?php _e('Pledged of','crunchpress');?> $<?php echo $ign_fund_goal;?><?php _e('Goal','crunchpress');?> </h4>
							<div class="progress progress-striped active">  
								<div style="width:<?php echo getPercentRaised_cp($ign_project_id);?>%;" class="bar p80"></div>    
							</div>						 
							<div class="info"> 
								<div class="span6 first">
									<i class="icon-user"></i><span><?php echo $getPledge_cp[0]->p_number;?></span> <?php _e('Pledgers','crunchpress');?>
								</div>
								<div class="span6">
									<i class="icon-calendar-empty"></i><span><?php echo $days;?></span> <?php _e('Days Left','crunchpress');?>
								</div>									
							</div>
						</section>
		<?php }$counter_ignition++;
		} // End While
		?>
					</section>
				</section>
		
		<div class="clear"></div>
		<?php
		if( find_xml_value($item_xml, "pagination") == "Yes"){	
			pagination();
		}	
	 }	

function getTotalProductFund_cp($productid) {
	global $wpdb;
	
	//$p_query = "SELECT * FROM ".$wpdb->prefix . "ign_pay_info where product_id='".$productid."'";
	//$orders = $wpdb->get_results( $p_query );
	
	//$total_price = 0;
	//foreach ($orders as $order) {
		//$total_price += getProductPrice( $order->product_level, $productid );
		//echo getProductPrice( $order->product_level, $productid )."<br />";
	//}
	$sql = "Select SUM(prod_price) AS prod_price from ".$wpdb->prefix . "ign_pay_info where product_id='".$productid."'";
	
	$result = $wpdb->get_row($sql);
	if ($result->prod_price != NULL || $result->prod_price != 0)
		return $result->prod_price;
	else
		return 0;
}

function getProjectGoal_cp($project_id) {
	global $wpdb;

	$goal_query = $wpdb->prepare('SELECT goal FROM '.$wpdb->prefix.'ign_products WHERE id=%d', $project_id);
	$goal_return = $wpdb->get_row($goal_query);
	return $goal_return->goal;
}
function getPledge_cp($project_id) {
	global $wpdb;

	$p_query = "SELECT count(*) as p_number FROM ".$wpdb->prefix . "ign_pay_info where product_id='".$project_id."'";
	//$goal_query = $wpdb->prepare('SELECT goal FROM '.$wpdb->prefix.'ign_products WHERE id=%d', $project_id);
	$p_counts = $wpdb->get_results($p_query);
	return $p_counts;
}


function getPercentRaised_cp($project_id) {
	global $wpdb;
	$total = getTotalProductFund_cp($project_id);
	$goal = getProjectGoal_cp($project_id);
	$percent = 0;
	if ($total > 0) {
		$percent = number_format($total/$goal*100, 2, '.', '');
	}
	return $percent;
}
	
?>