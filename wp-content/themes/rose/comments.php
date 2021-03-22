<?php if( comments_open() ) : ?>

    <div id="comments" class="pt-40 mt-50">
        <?php if ( have_comments() ) : ?>
        	<div class="comments-inner-wrap">
		        <h3 id="comments-title"><?php comments_number( esc_html__('No Comment', 'rose'), wp_kses_post('Comment <span>(1)</span>'), wp_kses_post(' Comments <span>(%)</span>')); ?></h3>
		        <ol class="commentlist">
		            <?php  

		                wp_list_comments( array(
		                    'avatar_size'   => 70,
		                    'max_depth'     => 5,
		                    'style'         => 'ul',
		                    'callback'      => 'rose_custom_comment',
		                    'type'          => 'comment',
		                    'reverse_children' => true,
		                    'echo'          => true
		                ));

		            ?>
		        </ol>

		        <?php the_comments_navigation(); ?>
		        
	        </div>
        <?php endif; ?>
    </div>

	<div class="mt-50">

	    <?php 

	        $commenter = wp_get_current_commenter();
	        $aria_req = ( $req ? " aria-required='true'" : '' );

	        $fields = array(
	            'author'    => '<div class="form-item col-sm-4"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="'. esc_html__('Your name', 'rose') .'" /></div>',
	            'email'     => '<div class="form-item col-sm-4"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . ' placeholder="'. esc_html__('Your email', 'rose') .'" /></div>',
	            'url' 		=> '<div class="form-item col-sm-4"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"' . $aria_req . ' placeholder="'. esc_html__('Your website', 'rose') .'" /></div>',
	        );

	        $comment_field = '<div class="form-item col-sm-12"><textarea id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required" placeholder="'. esc_html__('Message', 'rose') . '"></textarea></div>';
	        $submit_button = '<div class="form-item col-sm-12"><input name="%1$s" type="submit" id="%2$s" class="button %3$s" value="%4$s" /></div>';
	        
	        $args = array(
	        	'fields'  				=> $fields,
	            'comment_notes_after'   => '',
	            'logged_in_as'          => '',
	            'comment_notes_before'  => '',
	            'class_submit'  		=> 'btn-submit',
	            'title_reply'   		=> esc_html__('Leave a comment', 'rose'),
	            'label_submit'  		=> esc_html__('Comment', 'rose'),
	            'comment_field' 		=> $comment_field,
	            'submit_button'  		=> $submit_button,
	        );

	        comment_form($args);
	    ?>

    </div>

<?php endif; ?>




