<?php get_header(); ?>
	<?php if( have_posts() ) : ?>
		<?php get_template_part('inc/heading/heading'); ?>
		<div class="container">
			<?php  
				while (have_posts() ) : the_post() ?>
					<div class="content-page">

						<?php if(!class_exists('rose_plugin_shortcode')): ?>
							<h1><?php the_title(); ?></h1>
						<?php endif; ?>

						<?php echo the_content(); ?>
					</div>
					<?php comments_template(); ?>
				<?php endwhile; 
			?>
		</div>
	<?php endif; ?>
<?php get_footer(); ?>