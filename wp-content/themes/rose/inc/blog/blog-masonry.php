<?php $setting = rose_blog::rose_blog_setting(); ?>

<?php if( $setting['class_sidebar'] == 'hidden' ) : ?>
	<div class="blog-masonry grid mb-50" data-col-md="3" data-col-sm="2" data-col-xs="1" data-vertical="30" data-horizontal="30">
<?php else: ?>
	<div class="blog-masonry grid mb-50" data-col-sm="2" data-col-xs="1" data-vertical="30" data-horizontal="30">
<?php endif; ?>

	<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>

				<div class="grid-item">
					<?php  get_template_part('content'); ?>
				</div>

			<?php endwhile;
		else:
			get_template_part('content-none');
		endif;
	?>
</div>
