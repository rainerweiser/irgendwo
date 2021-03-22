<?php 

	if ( ! defined( 'ABSPATH' ) ) {
	    exit;
	}

	if( !class_exists('rose_blog') ) { 

		class rose_blog extends rose_framework {

			public function __construct() {
				add_action('rose_post_single_footer', array($this, 'rose_sharing_post'));
			}

			// Blog hero
			public static function rose_blog_hero($isDemo=true) { 

				$title = $attachment_id = $overlay = $heading = '';

				if(is_single()) {
					$attachment_id = isset(parent::$option['single_attachment']['id']) ? parent::$option['single_attachment']['id'] : '';
					$overlay = isset(parent::$option['single_overlay']['rgba']) ? parent::$option['single_overlay']['rgba'] : '';
					$heading = isset(parent::$option['single_heading']) ? parent::$option['single_heading'] : '';
				} else if(is_author() || is_archive() || is_category() || is_tag() && is_search()) {
					$attachment_id=  isset(parent::$option['archive_attachment']['id']) ? parent::$option['archive_attachment']['id'] : '';
					$overlay = isset(parent::$option['archive_overlay']['rgba']) ? parent::$option['archive_overlay']['rgba'] : '';
					$heading = isset(parent::$option['archive_heading']) ? parent::$option['archive_heading'] : '';
				} else {
					$attachment_id=  isset(parent::$option['blog_attachment']['id']) ? parent::$option['blog_attachment']['id'] : '';
					$overlay = isset(parent::$option['blog_overlay']['rgba']) ? parent::$option['blog_overlay']['rgba'] : '';
					$heading = isset(parent::$option['blog_heading']) ? parent::$option['blog_heading'] : '';
				}

				if( is_category() ) {
					$title = esc_html__('Kategorie: ', 'rose') . single_cat_title('', false);
				} elseif(is_author() ) {
					global $wp_query;
					$curauth = $wp_query->get_queried_object();
					$title = esc_html__('Von: ', 'rose') . $curauth->user_nicename;
				} elseif( is_home() ) {
					$title = isset(parent::$option['blog_title']) ? parent::$option['blog_title'] : '';
				} elseif ( is_single() ) {
					$title = isset(parent::$option['single_title']) ? parent::$option['single_title'] : '';
				} elseif ( is_tag() ) {
					$title = esc_html__('Tags: ', 'rose') . single_tag_title('', false);
				} elseif ( is_archive() ) {
					if ( is_day() ) { 
						$title  = esc_html__('Daily: ', 'rose' ) . get_the_time('d');
				 	} elseif ( is_month() ) { 
						$title = esc_html__('Archiv: ', 'rose' ) . get_the_time( 'F Y' ); 
					} elseif ( is_year() ) { 
						$title = esc_html__('Yearly: ', 'rose' ) . get_the_time( 'Y' ); 
					} else { 
						$title =  esc_html__('Archiv', 'rose' );
					}
				} elseif( is_search() ){
					$title = esc_html__('Suche: ', 'rose' ) . get_search_query(); 
				}elseif ( $isDemo )
				{
					$title = esc_html__('Blog Masonry', 'rose');
				}

				$param = array(
					'title'					=> $title,
					'align'					=> 'text-center',
					'bg_img'				=> $attachment_id,
					'bg_overlay'			=> $overlay,
				);
				
				$attribute = rose_array_to_attributes($param); ?>

				<?php if( empty($heading) && ! is_home()) : ?>

					<section class="blog-hero mb-75">
						<div class="container">
							<?php if(class_exists('rose_plugin_shortcode')) {
								echo do_shortcode('[rose_shortcode_banner '. $attribute .']');
							} ?>
						</div>
					</section>

				<?php endif;
			}

			// Blog excerpt length
			public static function rose_blog_excerpt_length($limit='') {

				if (  empty($limit) )
				{
					if( isset( parent::$option['blog_excerpt'] )  && !empty( parent::$option['blog_excerpt'] )) {
						$limit = parent::$option['blog_excerpt'];
					} else {
						$limit = 55;
					}
				}	

				$excerpt = explode(' ', get_the_excerpt(), $limit);

			    if (count($excerpt)>=$limit) {

			        array_pop($excerpt);
			        $excerpt = implode(" ",$excerpt).'...';

			      } else {
			        $excerpt = implode(" ",$excerpt);
			      } 

			    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

			    return $excerpt;
			}

			// Blog meta date
			public static function rose_blog_meta_date() {

				if( isset( parent::$option['post_meta']['blog_meta_date'] ) && empty(parent::$option['post_meta']['blog_meta_date']) ) : ?>

					<span class="meta-date">
						<span class="day">
							<?php the_time('d'); ?>
						</span>
						<span class="month">
							<?php the_time('M'); ?>
						</span>
					</span>
				<?php endif;
			}

			// Author Post Link
			public static function rose_blog_meta_author() {
				if( isset( parent::$option['post_meta']['blog_meta_author'] ) && empty( parent::$option['post_meta']['blog_meta_author']) ) : ?>
					<span class="meta-author">
						 <?php the_time('d.m.Y'); ?> / <?php echo esc_html__('Von: ', 'rose'); ?><?php the_author_posts_link(); ?>
					</span>
				<?php endif;
			}

			// Blog meta category
			public static function rose_blog_meta_cat() {
				if( isset( parent::$option['post_meta']['blog_meta_cat'] ) && empty(parent::$option['post_meta']['blog_meta_cat']) ) {
				 	the_category(); 
				}
			}

			// Blog meta comment
			public static function rose_blog_meta_comment() {
				
				if( isset( parent::$option['post_meta']['blog_meta_comment'] ) && empty(parent::$option['post_meta']['blog_meta_comment']) ) : ?>

					<span class="meta-comment">
						<a href="<?php the_permalink() ?>#comments">
							<?php comments_number( esc_html__('No comment', 'rose'), esc_html__('1 comment', 'rose'), esc_html__('% comment', 'rose') ); ?>
						</a>
					</span>
				<?php endif;
			}

			// Blog meta tags
			public static function rose_blog_meta_tag() {
				if( isset( parent::$option['post_meta']['blog_meta_tag'] ) && empty( parent::$option['post_meta']['blog_meta_tag'] ) ) {
				 	the_tags('<span class="meta-author">Tags: ', ', ', '</span>'); 
				}
			}

			// Blog paginate
			public static function rose_blog_paginate($max_num_pages = '') {
				global $wp_query;
				$big = 999999999; 
				$align = isset(parent::$option['blog_paginate']) ? parent::$option['blog_paginate'] : 'text-left'; 
				$max_num_page = empty($max_num_pages) ? $wp_query->max_num_pages : $max_num_pages;
				?>
	

				<div class="nav-post mt-50 <?php echo esc_attr($align); ?>">
					<?php 
						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $max_num_page,
							'type'		=> 'list',
							'prev_text'			=> '<i class="fa fa-angle-left"></i>',
							'next_text'			=> '<i class="fa fa-angle-right"></i>',
						) );
					?>
				</div>

				<?php
			}

			// Blog Setting Layout
			public static function rose_blog_setting() {

				$setting = array(
					'blog'				=> 'blog-standard',
					'class_content'		=> 'col-md-9',
					'class_sidebar'		=> 'col-md-3'
				);

				if( isset(parent::$option['blog_style']) && !empty(parent::$option['blog_style']) ) {
					$setting['blog'] = parent::$option['blog_style'];
				}

				if( isset(parent::$option['blog_sidebar']) && !empty(parent::$option['blog_sidebar']) ) {

					if( parent::$option['blog_sidebar'] == 'sidebar_left' ) {
						$setting['class_content'] = 'col-md-9 col-md-push-3';
						$setting['class_sidebar'] = 'col-md-3 col-md-pull-9';
					} elseif( parent::$option['blog_sidebar'] == 'no_sidebar' ) {
						$setting['class_content'] = 'col-md-12';
						$setting['class_sidebar'] = 'hidden';
					}

				}

				return $setting; 
			}

			public static function rose_blog_related() {
				if( !isset(parent::$option['post_meta']['blog_related_post']) || empty(parent::$option['post_meta']['blog_related_post']) ) {
					
				    global $post;
				    $orig_post = $post;
				    $posts_per_page = (isset(parent::$option['related_post_number']) && !empty(parent::$option['related_post_number']) ) ? parent::$option['related_post_number'] : 3;
				    $tags = wp_get_post_tags($post->ID);
				    if ($tags) :

				    	$tag_ids = array();

				    	foreach($tags as $individual_tag) {
				    		$tag_ids[] = $individual_tag->term_id;
			    		}

				    	$args = array(
						    'tag__in' 				=> $tag_ids,
						    'post__not_in' 			=> array($post->ID),
						    'posts_per_page'		=> $posts_per_page,
						    'ignore_sticky_posts'	=> 1
				    	);
				     
				    	$query = new wp_query( $args );

				 		if($query->have_posts() ) : ?>

				 			<div class="blog-related">
				 				<h4><?php echo esc_html__('Sehenswertes', 'rose') ?></h4>

				 				<div class="related-gird">
							    	<?php while( $query->have_posts() ) : $query->the_post(); ?>
							     
								    	<div class="related-post">

								    		<?php if(has_post_thumbnail() ) : ?>
								    			<div class="img">
										    		<a href="<?php the_permalink(); ?>">
														<?php the_post_thumbnail(array(610, 410) ); ?>
										    		</a>
									    		</div>
								    		<?php endif; ?>

								    		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								    		<span><?php the_time( get_option( 'date_format' ) ); ?></span>

								    	</div>
							     
							    	<?php endwhile; ?>
						    	</div>
							</div>

				    	<?php endif;
				    	
					    $post = $orig_post;
					    wp_reset_query();

				    endif;
			    }
			}

			// Share Post
			function rose_sharing_post() {
				if( isset(parent::$option['post_meta']['blog_share_post']) && parent::$option['post_meta']['blog_share_post'] == '1' ) {
				    if ( class_exists('WilokeSharingPost') ) {
				    	echo '<div class="post-footer"><div class="post-share">';
				    	if(has_filter('post_share_before')) {
				    		$label = apply_filters( 'post_share_before');
				    		echo $label;
				    	}
				        echo do_shortcode('[wiloke_sharing_post]');
				        echo '</div></div>';
				    }
				}
			}
		}

		new rose_blog();
	}