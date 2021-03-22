<?php 
/*
Plugin Name: Rose Pricing Table
Plugin URI: http://wiloke.net
Description: Rose Pricing Table
Version: 1.0
Author: Love - Wiloke Team
Author URI: http://wiloke.net
*/
if (!defined('ABSPATH')) {
  die("You don't have sufficient permission to access this page");
}
define('ROSE_PRICING_URL', trailingslashit(plugins_url('', __FILE__)) );
define('ROSE_PRICING', '1.0');

if(!class_exists('rose_pricing')) {

	class rose_pricing { 

		public function __construct() {
			add_action('init', array($this, 'register_pricing'));
			add_shortcode( 'rose_shortcode_pricing', array($this, 'shortcode_render'));
			add_action('vc_before_init', array($this, 'rose_vc_map'));
		}

		public function register_pricing() {

	      	$labels = array(
		        'name' => esc_html__('Pricing Table', 'rose'),
		        'singular_name' => esc_html__('Pricing', 'rose'),
		        'all_items' => esc_html__('All Pricing', 'rose'),
		        'add_new' => esc_html__('Add Pricing', 'rose'),
		        'add_new_item' => esc_html__('Add Pricing', 'rose'),
		        'edit_item' => esc_html__('Edit Pricing', 'rose'),
		        'new_item' => esc_html__('New Pricing', 'rose'),
		        'view_item' => esc_html__('View Pricing', 'rose'),
		        'search_items' => esc_html__('Search Pricing', 'rose'),
		        'not_found' =>  esc_html__('No Member Pricing', 'rose'),
		        'not_found_in_trash' => esc_html__('No Member Found In Trash', 'rose'),
		        'parent_item_colon' => ''
	      	);

	      	$args = array(
		        'labels' => $labels,
		        'public' => true,
		        'publicly_queryable' => true,
		        'show_ui' => true,
		        'query_var' => true,
		        'rewrite' => true,
		        'capability_type' => 'post',
		        'show_in_nav_menus' => false,
		        'hierarchical' => false,
		        'exclude_from_search' => true,
		        'menu_position' => 21,
		        'menu_icon' => 'dashicons-list-view',
		        'supports' => array('title', 'page-attributes')
	      	);
		      
	      	register_post_type('pricing', $args);
	  	}

	  	public function rose_vc_map() {

			vc_map( array(
				'name'			=> esc_html__('Rose Pricing Table', 'rose'),
				'base'			=> 'rose_shortcode_pricing',
				'category'		=> esc_html__('Rose', 'rose'),
				'description'	=> '',
				'params'		=> array(

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Show Post', 'rose'),
						'param_name'	=> 'show_post',
						'value'			=> '3',
						'description'			=> esc_html__('Show number post.', 'rose')
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Column Lager', 'rose' ),
						'param_name' => 'col_lg',
						'std'	=> 3,
						'value' => array(
							esc_html__( '1 column', 'rose' ) => 1,
							esc_html__( '2 column', 'rose' ) => 2,
							esc_html__( '3 column', 'rose' ) => 3,
							esc_html__( '4 column', 'rose' ) => 4,
							esc_html__( '5 column', 'rose' ) => 5,
							esc_html__( '6 column', 'rose' ) => 6,
						),
						'description'			=> esc_html__('Large devices desktops (≥1200px).', 'rose')
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Column Medium', 'rose' ),
						'param_name' => 'col_md',
						'std'	=> 3,
						'value' => array(
							esc_html__( '1 column', 'rose' ) => 1,
							esc_html__( '2 column', 'rose' ) => 2,
							esc_html__( '3 column', 'rose' ) => 3,
							esc_html__( '4 column', 'rose' ) => 4,
							esc_html__( '5 column', 'rose' ) => 5,
							esc_html__( '6 column', 'rose' ) => 6,
						),
						'description' => esc_html__('Medium devices desktops (≥992px)', 'rose')
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Column Small', 'rose' ),
						'param_name' => 'col_sm',
						'std'	=> 2,
						'value' => array(
							esc_html__( '1 column', 'rose' ) => 1,
							esc_html__( '2 column', 'rose' ) => 2,
							esc_html__( '3 column', 'rose' ) => 3,
							esc_html__( '4 column', 'rose' ) => 4,
							esc_html__( '5 column', 'rose' ) => 5,
							esc_html__( '6 column', 'rose' ) => 6,
						),
						'description' => esc_html__('Small devices tablets (≥768px)', 'rose')
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Column Extra Small', 'rose' ),
						'param_name' => 'col_xs',
						'std'	=> 1,
						'value' => array(
							esc_html__( '1 column', 'rose' ) => 1,
							esc_html__( '2 column', 'rose' ) => 2,
							esc_html__( '3 column', 'rose' ) => 3,
							esc_html__( '4 column', 'rose' ) => 4,
							esc_html__( '5 column', 'rose' ) => 5,
							esc_html__( '6 column', 'rose' ) => 6,
						),
						'description'	=> esc_html__('Extra small devices phones (<768px)', 'rose')
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Spacing Vertical', 'rose' ),
						'param_name' => 'vertical',
						'std'	=> 30,
						'value' => array(
							esc_html__( 'No Spacing', 'rose' ) => 0,
							esc_html__( '5px', 'rose' ) 		=> 5,
							esc_html__( '10px', 'rose' ) 		=> 10,
							esc_html__( '15px', 'rose' ) 		=> 15,
							esc_html__( '20px', 'rose' ) 		=> 20,
							esc_html__( '25px', 'rose' ) 		=> 25,
							esc_html__( '30px', 'rose' ) 		=> 30,
						),
						'description'			=> esc_html__('Set spacing vertical.', 'rose')
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Spacing Horizontal', 'rose' ),
						'param_name' => 'horizontal',
						'std'	=> 30,
						'value' => array(
							esc_html__( 'No Spacing', 'rose' ) => 0,
							esc_html__( '5px', 'rose' ) 		=> 5,
							esc_html__( '10px', 'rose' ) 		=> 10,
							esc_html__( '15px', 'rose' ) 		=> 15,
							esc_html__( '20px', 'rose' ) 		=> 20,
							esc_html__( '25px', 'rose' ) 		=> 25,
							esc_html__( '30px', 'rose' ) 		=> 30,
						),
						'description'			=> esc_html__('Set spacing vertical', 'rose')
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order', 'rose' ),
						'param_name' => 'order',
						'std'			=> 'DESC',
						'value' => array(
							esc_html__( 'Descending', 'rose' ) 	=> 'DESC',
							esc_html__( 'Ascending', 'rose' ) 		=> 'ASC',
						),
						'description' => esc_html__( 'Designates the ascending or descending order of the orderby parameter.', 'rose' ),
					),

					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order By', 'rose' ),
						'param_name' => 'orderby',
						'std'			=> 'date',
						'value' => array(
							esc_html__( 'Post Date', 'rose' ) 		=> 'date',
							esc_html__( 'Menu Order', 'rose' ) 	=> 'menu_order',
							esc_html__( 'Title', 'rose' ) 			=> 'title',
						),
						'description' => esc_html__( 'Sort retrieved projects by parameter.', 'rose' ),
					),
				)
			));
		}

		public function shortcode_render( $attr, $content = '' ) {

			extract(shortcode_atts( array(
				'show_post'			=> 3,
				'col_lg'			=> '3',
				'col_md'			=> '3',
				'col_sm'			=> '2',
				'col_xs'			=> '1',
				'vertical'			=> 30,
				'horizontal'		=> 30,
				'order'				=> 'DESC',
				'orderby'			=> 'date'
			), $attr )); 

			$color_quote = !empty( $color_quote ) ? 'style="color:'. esc_attr($color_quote) .'"' : '';
			$color_name = !empty( $color_name) ? 'style="color:'. esc_attr($color_name) .'"' : '';
			$color_work = !empty( $color_work) ? 'style="color:'. esc_attr($color_work) .'"' : '';	

			$args = array(
				'post_type' 			=> 'pricing',
				'post_status' 			=> 'publish',
				'posts_per_page' 		=> $show_post,
				'ignore_sticky_posts'	=> 1,
				'order'					=> $order,
				'orderby'				=> $orderby
	  		);

			$query = new WP_Query( $args );

			ob_start(); ?>
			
			<?php if($query->have_posts() ) : ?>

				<div class="pricing-table">
					<div class="grid" data-col-lg="<?php echo esc_attr($col_lg); ?>" data-col-md="<?php echo esc_attr($col_md); ?>" data-col-sm="<?php echo esc_attr($col_sm); ?>" data-col-xs="<?php echo esc_attr($col_xs); ?>" data-vertical="<?php echo esc_attr($vertical); ?>" data-horizontal="<?php echo esc_attr($horizontal); ?>">
						<?php while ($query->have_posts()) : $query->the_post(); ?>

							<?php 
								global $post;
								$setting = get_post_meta( $post->ID, 'pricing_setting', true ); 
								$class = ( isset($setting['highlights']) && !empty($setting['highlights']) ) ? 'highlights' : '';
							?>
							<div class="grid-item">
								<div class="pricing-item text-center <?php echo esc_attr($class) ?>">

									<h2 class="h6"><?php the_title(); ?></h2>

									<?php if( isset($setting['price']) ) : ?>
										<span class="price">
											<span class="money"><?php echo esc_html($setting['price']); ?></span> 
											<?php if( isset($setting['unit']) ) : ?>
												<span class="unit"><?php echo esc_html($setting['unit']); ?></span>
											<?php endif; ?>
										</span>
									<?php endif; ?>
									<?php if(isset($setting['packages']) && !empty($setting['packages']) ) : ?>
										<ul>
											<?php echo wp_kses( $setting['packages'], array('li'=>array()) ); ?>
										</ul>
									<?php endif; ?>
									<?php if( !empty($setting['text_link']) ) : ?>
										<a href="<?php echo esc_url($setting['link']); ?>" class="button"><?php echo esc_html($setting['text_link']); ?></a>
									<?php endif; ?>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>

			<?php $output = ob_get_clean();

			return $output;
		}
	}

	new rose_pricing();
}
