<?php $setting = rose_blog::rose_blog_setting(); ?>
<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
	<div class="post-media">

		<?php 
			if( !is_single() ) {

				if( has_post_thumbnail() ) : ?>
					<div class="image">
						<?php $size = $setting['blog'] == 'blog-standard' ? array(1200, 480) : array(500, 425); ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail($size); ?>
						</a>
					</div>
				<?php endif;

				rose_blog::rose_blog_meta_date(); 

			} else {
				do_shortcode('[wiloke_post_format_shortcode]');
			}
		?>

	</div>

	<div class="post-entry">

		<?php $post_tags = get_the_tags();

	 		$bFromAway = 0;

			if ( $post_tags ) {
			    foreach( $post_tags as $tag ) {
			   		if (stripos($tag->name, 'nterwegs') > 0) {
			    		$bFromAway = 1;
			   		}
				}
			}

		?>

		<?php if(is_single()) : ?>
			<h1 class="entry-title" style="display:inline"><?php the_title(); ?></h1><?php  //if ($bFromAway) echo('<span class="unterwegs">Von&nbsp;Unterwegs</span>'); ?>
		<?php else : ?>
			<h1 class="entry-title" style="display:inline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><?php  //if ($bFromAway) echo('<span class="unterwegs">Von&nbsp;Unterwegs</span>'); ?>
		<?php endif; ?>

		<div class="entry-meta">
			<?php  if ($bFromAway) echo('<span class="unterwegs" title="Von unterwegs geschrieben">Von&nbsp;Unterwegs</span>'); ?>
		 	<?php
				rose_blog::rose_blog_meta_author();
				if( is_single() && false) { rose_blog::rose_blog_meta_date(); }
				//rose_blog::rose_blog_meta_cat();
				rose_blog::rose_blog_meta_tag();
				//rose_blog::rose_blog_meta_comment();
			?>
		</div>

		<div class="entry-content">
			<?php 
				if( is_single() ) {
					the_content();

					wp_link_pages( array(
					    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'rose' ) . '</span>',
					    'after'       => '</div>',
					    'link_before' => '<span>',
					    'link_after'  => '</span>',
					    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'rose' ) . ' </span>%',
					    'separator'   => '<span class="screen-reader-text">, </span>',
				   	) );
				} else {
					echo rose_blog::rose_blog_excerpt_length();
				}
			?>
		</div>

	</div>

	<?php if( $setting['blog'] == 'blog-standard' && !is_single() ) :  ?>
		<div class="post-footer">
			<a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html__('Weiterlesen', 'rose'); ?></a>
		</div>
	<?php endif; ?>

	<?php if( is_single() ) { 
		do_action('rose_post_single_footer');
		rose_blog::rose_blog_related();
		//comments_template(); RWE Hide commments
	} ?>
	
</article>