<?php 
	/*
	 * This file is used to generate comments form.
	 */	

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (post_password_required()){
		?> <p class="nopassword">This post is password protected. Enter the password to view comments.</p> <?php
		return;
	}
if ( have_comments() ) : ?>
	<h3><?php comments_number(__('No Comment','cp_front_end'), __('One Comment','cp_front_end'), __('% Comments','cp_front_end') );?></h3>
	<ul id="comments" class="comment-list">
		<?php wp_list_comments(array('callback' => 'get_comment_list')); ?>
	</ul>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<br>
		<div class="comments-navigation">
			<div class="previous"> <?php previous_comments_link('Older Comments'); ?> </div>
			<div class="next"> <?php next_comments_link('Newer Comments'); ?> </div>
		</div>
	<?php endif; ?>
<?php endif; ?>
<?php 

	$comment_form = array( 
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<ul class="comm-list contact"><li class="comment-form-author">' .
						'<label for="author">' . __( 'Name', 'cp_front_end' ) . ( $req ? '<span class="required">*</span>' : '' ).'</label> ' .
						'<input class="comm-field" id="author" name="author" type="text" value="' .
						esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" />' .						
						'<div class="clear"></div>' .
						'</li><!-- #form-section-author .form-section -->',
			'email'  => '<li class="comment-form-email">' .
						'<label for="email">' . __( 'Email', 'cp_front_end' ) . ( $req ? '<span class="required">*</span>' : '' ) .'</label> ' .
						'<input id="email" class="comm-field" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" />' .						
						'</li><!-- #form-section-email .form-section -->',
			'url'    => '<li class="comment-form-url">' .
						'<label for="url">' . __( 'Website', 'cp_front_end' ) . '</label>' .
						'<input id="url" class="comm-field" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />' .						
						'<div class="clear"></div>' .
						'</li><!-- #form-section-url .form-section -->' ) ),
			'comment_field' => '<li class="comment-form-comment">' .
						'<label for="url">' . __( 'Comment Here', 'cp_front_end' ) . '</label>' .
						'<textarea cols="60" rows="10" class="comm-area" id="comment" name="comment" aria-required="true"></textarea>' .
						'</li></ul><!-- #form-section-comment .form-section -->',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'title_reply' => __('Leave a Reply','cp_front_end'),
	);
	
	
	
	comment_form($comment_form, $post->ID); 
	

?>