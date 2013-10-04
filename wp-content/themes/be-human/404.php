<?php
	/*
	 * This file will generate 404 error page.
	 */	
get_header(); ?>
<section class="content-holder b-none inner_content p404">
	<section class="container">
		
		<section class="row-fluid">
			<figure class="mtt_element" id="page_title">
				<div class="span12 first">
					<h2><?php _e('Page Not Found','crunchpress');?></h2>
				</div>
			</figure>
			<h3><i class="icon-exclamation"></i><?php echo __('Oops! An error occured.','cp_front_end'); ?></h3>
			<p><?php echo __('The page you were looking for cannot be found.','cp_front_end'); ?></p>
			<article class="page_404">
				<h1><?php echo __('Error 404','cp_front_end'); ?></h1>
				<p><?php echo __('We are sorry! But the page you were looking for does not exist.','cp_front_end'); ?></p>
				<form method="get" id="searchform" action="<?php  echo home_url(); ?>/">
					<input id="s" name="s" value="<?php the_search_query(); ?>" autocomplete="off" type="text" class="text error-field">
					<span class="search_icon">
						<input type="submit" id="searchsubmit" class="send-btn" value="submit" />
						<i class="icon-search"></i>
					</span>
				</form>		 
			</article>
		</section>
	</section>
</section>
<div class="clear"></div>		
<!--content-separator-->
<?php get_footer();?>
