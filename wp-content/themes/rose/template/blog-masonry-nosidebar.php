<?php 

/**
 * Template Name: Blog Masonry No Sidebar
 */

get_header(); ?>
	
	<?php $setting = rose_blog::rose_blog_setting(); ?>

	<?php if( have_posts() ) : 

		while ( have_posts() ) : the_post(); ?>

			<?php get_template_part('inc/heading/heading'); ?>

			<section id="main" class="mb-100">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<?php 
								$paged = get_query_var( 'paged', 1 );

								$args = array(
									'post_type'				=> 'post',
									'post_status'			=> 'publish',
									'ignore_sticky_posts' 	=> 1,
									'paged'					=> $paged
								);

								$aPostMeta = get_post_meta($post->ID, 'blog_layout', true);
								if ( isset($aPostMeta['is_specify_categories']) && ( $aPostMeta['is_specify_categories'] == 'yes' ) )
								{
									$args['category__in'] = $aPostMeta['categories'];
								}

								$query = new WP_Query($args);
								
								if ( $query->have_posts() ) : ?>
									
									<div class="blog-masonry grid mb-50" data-col-md="3" data-col-sm="2" data-col-xs="1" data-vertical="30" data-horizontal="30">
								
										<?php 

										while ( $query->have_posts() ) : $query->the_post(); ?>

											<div class="grid-item">
												<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							
													<div class="post-media">

														<?php 
															if( has_post_thumbnail() ) : ?>
																<div class="image">
																	<a href="<?php the_permalink(); ?>">
																		<?php the_post_thumbnail(array(500, 425)); ?>
																	</a>
																</div>
															<?php endif;
															rose_blog::rose_blog_meta_date(); 
														?>

													</div>

													<div class="post-entry">

														<h2 class="h5 entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

														<div class="entry-meta">
														 	<?php
																rose_blog::rose_blog_meta_author();
																rose_blog::rose_blog_meta_cat();
																rose_blog::rose_blog_meta_tag();
																rose_blog::rose_blog_meta_comment();
															?>
														</div>

														<div class="entry-content">
															<?php echo rose_blog::rose_blog_excerpt_length(36); ?>
														</div>

													</div>

												</article>
											</div>

										<?php endwhile; ?>
											
									</div>

									<?php rose_blog::rose_blog_paginate($query->max_num_pages); 
									wp_reset_postdata();
									
								else:
									get_template_part('content-none');
							endif; ?>
						</div>

					</div>
				</div>
			</section>

		<?php endwhile; ?>

	<?php endif; ?>

<?php get_footer();