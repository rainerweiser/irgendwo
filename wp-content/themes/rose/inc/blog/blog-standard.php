
<?php $setting = rose_blog::rose_blog_setting(); ?>

<div class="blog-standard">
	<?php 
		if ( have_posts() ) {
			while ( have_posts() ) { 
				the_post();
				get_template_part('content');
			}
		}  else {
			get_template_part('content-none');
		}
	?>
</div>