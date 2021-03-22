<?php get_header(); ?>

	<?php $setting = rose_blog::rose_blog_setting(); ?>

	<?php rose_blog::rose_blog_hero(); ?>
	
	<section id="main" class="mb-100">
		<div class="container">
			<div class="row">

				<div class="<?php echo esc_attr($setting['class_content']) ?>">
					<?php get_template_part( 'inc/blog/'. $setting['blog'] ); ?>
					<?php rose_blog::rose_blog_paginate(); ?>
				</div>

				<?php if( $setting['class_sidebar'] != 'hidden' ) : ?>
					<div class="<?php echo esc_attr($setting['class_sidebar']) ?>">
						<?php get_template_part('sidebar'); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</section>

<?php get_footer(); ?>