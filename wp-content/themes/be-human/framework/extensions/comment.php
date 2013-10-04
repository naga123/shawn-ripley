<?php

	/*	
	*	CrunchPress Comment File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file return the comment list to the selected post_type
	*	---------------------------------------------------------------------
	*/
	 
	function get_comment_list( $comment, $args, $depth ) {
	
		$GLOBALS['comment'] = $comment;
		
		switch ( $comment->comment_type ) :
			case 'pingback'  :
			case 'trackback' :
			?>
				<li class="post pingback">	
					<p>
						<?php _e( 'Pingback:', 'cp_front_end'); ?>
						<?php comment_author_link(); ?>
						<?php edit_comment_link( __('(Edit)', 'cp_front_end'), ' ' ); ?>
					</p>
					</li>
			<?php
				break;
				
			default :
			?>
			<div class="clear"></div>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				
				 
						<div class="c_outer_wrapper">
							
							<div class="span2 first img blockx"> <?php echo get_avatar( $comment, 60 ); ?> </div>
							<div class="span10 inner blockx"> 
									<h3> <?php echo get_comment_author_link(); ?></h3>
									<?php comment_text(); ?>
									<?php echo get_comment_date();?> - <?php _e('at','cp_front_end'); ?> <?php echo get_comment_time();?>
									<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							</div>
							
						</div>
				
				
				
			<?php
				break;
		endswitch;
		
	}
?>
