<?php 
	if (!defined('ABSPATH')) {
	  die("You don't have sufficient permission to access this page");
	}

	if (!class_exists('rose_portfolio')) {
		
		class rose_portfolio extends rose_framework { 

			public static function portfolio_info() {

				global $post;
				$info = get_post_meta($post->ID, 'portfolio_info', true);
				if( isset( $info['description'] ) && !empty( $info['description'] ) ) : ?>
                    <h3 class="h6"><i class="fa fa-angle-right"></i> <?php echo esc_html__('Description', 'rose') ?></h3>
                    <div class="descritption">
                    	<?php echo wp_kses_post($info['description']); ?>
                    </div>
                <?php endif ?>
				
				<?php if( isset( $info['client'] ) && !empty( $info['client'] ) ) : ?>
	                <h3 class="h6"><i class="fa fa-angle-right"></i> <?php echo esc_html__('Clients', 'rose') ?></h3>
	                <div class="client-portfolio">
	                	<?php echo wp_kses_post($info['client'] ); ?>
	                </div>
	            <?php endif; ?>

	            <?php if( isset( $info['tasks'] ) && !empty( $info['tasks'] ) ) : ?>
                    <h3 class="h6"><i class="fa fa-angle-right"></i> <?php echo esc_html__('Tasks', 'rose') ?></h3>
                    <p><em>“<?php echo esc_html( $info['tasks'] ); ?>”</em></p>
                <?php endif; ?>

                <h3 class="h6"><i class="fa fa-angle-right"></i> <?php echo esc_html__('Info', 'rose') ?></h3>

                <ul>

                    <?php
						if( isset( $info['date'] ) && !empty( $info['date'] ) ) :
							$dateFormat = get_option('date_format');
                        $date = date($dateFormat, $info['date']);
					?>
                        <li><?php printf(esc_html__('+ %s', 'rose'), $date ); ?></li>
                    <?php endif; ?>
                    
                    <li><?php printf(esc_html__('+ By: %s', 'rose'), get_the_author() ); ?></li>

                    <?php $terms = get_the_terms( $post->ID, 'category-portfolio' );

                        if ( $terms && !is_wp_error( $terms ) ) :

                            if( count($terms) > 0) : ?>
                                <li>
                                    <?php 
                                        echo esc_html__('+ In: ', 'rose'); 
                                        foreach ( $terms as $term ) : ?>
                                            <a href="<?php echo esc_url( get_term_link( $term->slug, 'category-portfolio') ) ?>"><?php echo esc_html( $term->name ); ?></a>
                                        <?php endforeach;
                                    ?>
                                </li>
                            <?php endif;

                        endif; 
                    ?>
                    
                </ul>

				<?php 
					if( isset(parent::$option['portfolio_single_social']) && parent::$option['portfolio_single_social'] == '1' ) {
                		do_shortcode('[wiloke_sharing_post]');
                	}
             	?>

                <?php if( isset($info['url']) && !empty($info['url']) ) : ?>
                	<?php $button_text = isset(parent::$option['portfolio_text_visit']) ? parent::$option['portfolio_text_visit'] : 'Visit project'; ?>
                    <a href="<?php echo esc_url( $info['url'] ); ?>" class="btn" target="_blank"><?php echo esc_html($button_text); ?></a>
                <?php endif;
			}

			public static function portfolio_paginate() {


				if( !isset(parent::$option['portfolio_nav']) ||  parent::$option['portfolio_nav'] == '0') {
					$prev_post = get_previous_post();
		            $next_post = get_next_post();

		            if( !empty($prev_post) || !empty($next_post) ) : ?>

		                <div class="nav-portfolio mb-35">

		                    <?php if ( !empty( $prev_post ) ) : 
		                        $att_id = get_post_thumbnail_id($prev_post->ID);
		                        $src = wp_get_attachment_image_src( $att_id, array(570, 56) ); ?> 
		                        <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="bg-scroll nav-left text-left fl" style="background-image: url(<?php echo esc_url($src[0]); ?>)"><span><?php echo esc_html__('‹ Previous', 'rose') ?></span></a> 
		                    <?php endif; ?>

		                    <?php if ( !empty( $next_post ) ) : 
		                        $att_id = get_post_thumbnail_id($next_post->ID);
		                        $src = wp_get_attachment_image_src( $att_id, array(570, 56) ); ?> 
		                        <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="bg-scroll nav-right text-right fr" style="background-image: url(<?php echo esc_url($src[0]); ?>)"><span><?php echo esc_html__('Next ›', 'rose') ?></span></a> 
		                    <?php endif; ?>

		                    <?php 

		                        if( isset(parent::$option['portfolio_url']) && !empty(parent::$option['portfolio_url']) ) : ?>
		                            <a href="<?php echo esc_url(parent::$option['portfolio_url']); ?>" class="center-block" title="<?php echo esc_html__('Home Page Portfolio', 'rose') ?>"><span></span></a>
		                        <?php endif;
		                    ?>
		                    

		                </div>

		            <?php endif;
	            }
			}

			public static function portfolio_setting() {

				$setting = array(
					'class_content' => 'col-md-8',
					'class_sidebar'	=> 'col-md-4'
				);

				if( isset( parent::$option['portfolio_sidebar'] ) ) {
					if( parent::$option['portfolio_sidebar'] == 'sidebar_left' ) {
						$setting['class_content'] = 'col-md-8 col-md-push-4';
						$setting['class_sidebar'] = 'col-md-4 col-md-pull-8';
					} else if(parent::$option['portfolio_sidebar'] == 'full_width') {
						$setting['class_content'] = 'col-xs-12 mb-30';
						$setting['class_sidebar'] = 'col-xs-12 mb-30';
					} else if(parent::$option['portfolio_sidebar'] == 'no_sidebar') {
						$setting['class_content'] = 'col-xs-12 mb-30';
						$setting['class_sidebar'] = 'no_sidebar';
					}
				}

				return $setting;
			}

			public static function portfolio_heading_taxonomy() {
				
				if(!isset(parent::$option['portfolio_heading']) || empty(parent::$option['portfolio_heading'])) :
					global $wp_query;
					$overlay = isset(parent::$option['portfolio_overlay']) ? parent::$option['portfolio_overlay'] : '';
					$attachment_id=  isset(parent::$option['portfolio_attachment']['id']) ? parent::$option['portfolio_attachment']['id'] : '';
				    $term = $wp_query->get_queried_object();
				    $title = $term->name;

					$param = array(
						'title'					=> $title,
						'align'					=> 'text-center',
						'bg_img'				=> $attachment_id,
						'bg_overlay'			=> $overlay,
					);

					$attribute = rose_array_to_attributes($param);
					
					?>
					<section class="mb-50">
						<div class="container">
							<?php if(class_exists('rose_plugin_shortcode')) {
								echo do_shortcode('[rose_shortcode_banner '. $attribute .']');
							} ?>
						</div>
					</section>

				<?php endif;
				
			}

			public static function portfolio_heading_single() {
				if(!isset(parent::$option['portfolio_single_heading']) || empty(parent::$option['portfolio_single_heading'])) :

					global $post;

					$attachment = get_post_meta($post->ID, 'portfolio_single', true);
					// var_dump($attachment);
					if( isset($attachment['header_img_id']) && !empty($attachment['header_img_id']) ) :
						$param = array(
							'title'					=> $post->post_title,
							'align'					=> 'text-center',
							'bg_img'				=> $attachment['header_img_id'],
							'bg_overlay'			=> 'rgba(255,255,255,0.3)',
						);

						$attribute = rose_array_to_attributes($param); ?>

						<div class="mb-40">
							<?php if(class_exists('rose_plugin_shortcode')) {
								echo do_shortcode('[rose_shortcode_banner '. $attribute .']');
							} ?>
						</div>

					<?php endif;
				endif;
				
			}

			public static function portfolio_content_taxonomy() {
				global $wp_query;
				$term = $wp_query->get_queried_object();
				$style = isset(parent::$option['portfolio_style']) ? parent::$option['portfolio_style'] : 'style1';
				$show_post = isset(parent::$option['show_post']) ? parent::$option['show_post'] : 8;
				$caption_pos = isset(parent::$option['caption_pos']) ? parent::$option['caption_pos'] : 'caption-middle';
				$effect = isset(parent::$option['effect']) ? parent::$option['effect'] : 'effet-fade';
				$vertical = isset(parent::$option['vertical']) ? parent::$option['vertical'] : 0;
				$horizontal = isset(parent::$option['horizontal']) ? parent::$option['horizontal'] : 0;
				$paging = isset(parent::$option['paging']) ? parent::$option['paging'] : 'hidden';
				$order = isset(parent::$option['order']) ? parent::$option['order'] : 'DESC';
				$orderby = isset(parent::$option['orderby']) ? parent::$option['orderby'] : 'date';
				$col_lg = isset(parent::$option['col_lg']) ? parent::$option['col_lg'] : '3';
				$col_md = isset(parent::$option['col_md']) ? parent::$option['col_md'] : '3';
				$col_sm = isset(parent::$option['col_sm']) ? parent::$option['col_sm'] : '2';
				$col_xs = isset(parent::$option['col_xs']) ? parent::$option['col_xs'] : '1';
				$category_pos = isset(parent::$option['category_pos']) ? parent::$option['category_pos'] : 'bottom';
				$options = array('filter');

				if( isset(parent::$option['arichive_option']) && !empty(parent::$option['arichive_option']) ) {

					foreach (parent::$option['arichive_option'] as $k => $v) {
						if( !empty($v) ) {
							$options[] = $k;
						}
					}
				}

				$options =implode(',', $options);
				$param = array(
					'style' 			=> $style,
					'post_number'		=> $show_post,
					'category_in'		=> $term->term_id,
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

				$attribute = rose_array_to_attributes($param); ?>

				<section id="portfolio" class="mb-50">
			        <div class="container">
						<?php echo do_shortcode('[rose_shortcode_portfolio '. $attribute .' ]'); ?>
			        </div>
			    </section>
			    <?php
			}

			public static function rose_portfolio_related() {

				if(!isset(parent::$option['portfolio_related']) || empty(parent::$option['portfolio_related'])) : 
					
					global $post;
					$orig_post = $post;
				    $args = array();
				    

				    $taxterms = wp_get_object_terms( $post->ID, 'category-portfolio', array('fields' => 'ids') );

				    if( !empty($taxterms) && !is_wp_error($taxterms) ) :
				    	$style = isset(parent::$option['related_style']) ? parent::$option['related_style'] : 'style2';
				      	$post__not_in = $post->ID;
				      	$category_in = implode(',', $taxterms);
						$show_post = isset(parent::$option['portfolio_related_post']) ? parent::$option['portfolio_related_post'] : 4;
						$caption_pos = isset(parent::$option['related_caption_pos']) ? parent::$option['related_caption_pos'] : 'caption-middle';
						$effect = isset(parent::$option['related_effect']) ? parent::$option['related_effect'] : 'effet-fade';
						$vertical = isset(parent::$option['related_vertical']) ? parent::$option['related_vertical'] : 0;
						$horizontal = isset(parent::$option['related_horizontal']) ? parent::$option['related_horizontal'] : 0;
						$order = isset(parent::$option['related_order']) ? parent::$option['related_order'] : 'DESC';
						$orderby = isset(parent::$option['related_orderby']) ? parent::$option['related_orderby'] : 'date';
						$col_lg = isset(parent::$option['related_col_lg']) ? parent::$option['related_col_lg'] : '3';
						$col_md = isset(parent::$option['related_col_md']) ? parent::$option['related_col_md'] : '3';
						$col_sm = isset(parent::$option['related_col_sm']) ? parent::$option['related_col_sm'] : '2';
						$col_xs = isset(parent::$option['related_col_xs']) ? parent::$option['related_col_xs'] : '1';
						$category_pos = isset(parent::$option['related_category_pos']) ? parent::$option['related_category_pos'] : 'bottom';
						$options = array('filter');

						if( isset(parent::$option['related_options']) && !empty(parent::$option['related_options']) ) {

							foreach (parent::$option['related_options'] as $k => $v) {
								if( !empty($v) ) {
									$options[] = $k;
								}
							}
						}

						$options =implode(',', $options);

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
							'paging'			=> 'hidden',
							'order'				=> $order,
							'orderby'			=> $orderby,
							'options'			=> $options,
							'post__not_in'		=> $post__not_in
						);

						$attribute = rose_array_to_attributes($param); 
						$title = isset(parent::$option['related_title']) ? parent::$option['related_title'] : '';
						if( class_exists('rose_plugin_portfolio') ) : ?>
							<div class="related-project mt-70">

								<?php if( !empty($title) ) : ?>
									<h4 class="related-project-title"><?php echo esc_html($title); ?></h4>
								<?php endif; ?>

								<?php echo do_shortcode('[rose_shortcode_portfolio '. $attribute .' ]');  ?>
							</div>
						<?php endif;
						
			  		endif;

			  		$post = $orig_post;
				    wp_reset_query();

				endif;

			}
		}
	}
