<?php 

/**
 * Template Name: Portfolio
 */

get_header(); ?>

	<?php 
		if( have_posts() ) : 

			while ( have_posts() ) : the_post();

				$setting = get_post_meta($post->ID, 'settings', true ); 
				$style = isset($setting['style']) ? $setting['style'] : 'style1';
				$category_in = isset($setting['term_ids']) ? implode(',', $setting['term_ids']) : '';
				$show_post = isset($setting['show_post']) ? $setting['show_post'] : 8;
				$caption_pos = isset($setting['caption_pos']) ? $setting['caption_pos'] : 'caption-middle';
				$effect = isset($setting['effect']) ? $setting['effect'] : 'effet-fade';
				$vertical = isset($setting['vertical']) ? $setting['vertical'] : 0;
				$horizontal = isset($setting['horizontal']) ? $setting['horizontal'] : 0;
				$paging = isset($setting['paging']) ? $setting['paging'] : 'hidden';
				$order = isset($setting['order']) ? $setting['order'] : 'DESC';
				$orderby = isset($setting['orderby']) ? $setting['orderby'] : 'date';
				$col_lg = isset($setting['col_lg']) ? $setting['col_lg'] : '3';
				$col_md = isset($setting['col_md']) ? $setting['col_md'] : '3';
				$col_sm = isset($setting['col_sm']) ? $setting['col_sm'] : '2';
				$col_xs = isset($setting['col_xs']) ? $setting['col_xs'] : '1';
				$content_pos = isset($setting['content_pos']) ? $setting['content_pos'] : 'top';
				$category_pos = isset($setting['category_pos']) ? $setting['category_pos'] : 'bottom';
				$options = isset($setting['options']) ? implode(',', $setting['options']) : '';
				
				$param = array(
					'style' 			=> $style,
					'post_number'		=> $show_post,
					'category_in'		=> $category_in,
					'caption_pos'		=> $caption_pos,
					'category_pos'		=> $category_pos,
					'effect'			=> $effect,
					'col_lg'			=> $col_lg,
					'col_md'			=> $col_md,
					'col_sm'			=> $col_sm,
					'col_xs'			=> $col_xs,
					'vertical'			=> $vertical,
					'horizontal'		=> $horizontal,
					'paging'			=> $paging,
					'order'				=> $order,
					'orderby'			=> $orderby,
					'options'			=> $options
				);

				$attribute = rose_array_to_attributes($param); 
				$content   = get_the_content();
				?>

				<?php get_template_part('inc/heading/heading'); ?>

				<section id="portfolio" class="mb-50">
			        <div class="container">
			        	
			        	<?php if(!empty($content) && $content_pos == 'top') : ?>
				        	<div class="content">
				        		<?php the_content(); ?>
				        	</div>
			        	<?php endif; ?>

						<?php if( class_exists('rose_plugin_portfolio') ) {
								echo do_shortcode('[rose_shortcode_portfolio '. $attribute .' ]'); 
							}
						?>

						<?php if( !empty($content) && $content_pos == 'bottom' ) : ?>
				        	<div class="content">
				        		<?php the_content(); ?>
				        	</div>
			        	<?php endif; ?>

			        </div>
			    </section>

			<?php endwhile;

		endif; 
	?>

<?php get_footer();