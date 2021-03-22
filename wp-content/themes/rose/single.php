<?php get_header(); ?>
	
	<?php $setting = rose_blog::rose_blog_setting(); ?>

	<?php rose_blog::rose_blog_hero(); ?>

	<section id="main" class="mb-100">
		<div class="container">
			<div class="row">

				<div class="col-md-12"> <?php //echo esc_attr($setting['class_content']) ?>

					<div class="blog-single">
						
						<?php 
							if ( have_posts() ) :
								while ( have_posts() ) : the_post(); 
									get_template_part('content');
								endwhile;
							else:
								get_template_part('content-none');
							endif; 
						?>
						
					</div>

					<div class="nav-post mt-50 text-left">
						<?php if ( $prev = get_previous_post() ) { ?>
							<a class="button" style="float:left" href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>"><i class="fa fa-angle-left"></i>&nbsp;&nbsp;<?php echo($prev->post_title); ?></a>
						<?php }  ?>
						<?php if ( $next = get_next_post() ) { ?>
							<a class="button" style="float:right" href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>"><?php echo($next->post_title); ?>&nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
						<?php }  ?>
					</div>

				</div>



			</div>
		</div>
	</section>

<?php get_footer(); ?>