<?php
/*
Plugin Name: Rose Shortcode
Plugin URI: http://wiloke.net
Description: Rose Shortcode
Version: 1.0
Author: Love - Wiloke Team
Author URI: http://wiloke.net
*/

if (!defined('ABSPATH')) {
	die("You don't have sufficient permission to access this page");
}

define('ROSE_SHORTCODE_URL', trailingslashit(plugins_url('', __FILE__)) );
define('ROSE_SHORTCODE', '1.0');

if(!class_exists('rose_plugin_shortcode')) {
	class rose_plugin_shortcode {
		public $shortcodes = array(
				'shortcode_banner',
				'shortcode_iconbox',
				'shortcode_client',
				'shortcode_title',
				'shortcode_twitter',
				'shortcode_google',
				'shortcode_skill',
		);

		public function __construct() {
			$this-> init_shortcode();
			add_action( 'wp_enqueue_scripts', array($this, 'enqueued' ) );
		}

		public function init_shortcode() {
			foreach ($this->shortcodes as $shortcode) {
				add_shortcode( 'rose_' . $shortcode, array($this, 'render_'. $shortcode));
				add_action( 'vc_before_init', array($this, 'vc_map_'. $shortcode));
			}
		}

		// BANNER
		public function vc_map_shortcode_banner() {
			vc_map( array(
					'name'			=> esc_html__('Rose Banner', 'rose'),
					'base'			=> 'rose_shortcode_banner',
					'category'		=> esc_html__('Rose', 'rose'),
					'description'	=> '',
					'params'		=> array(

							array(
									'type'			=> 'textfield',
									'heading'		=> esc_html__('Title', 'rose'),
									'param_name'	=> 'title',
									'value'			=> '',
									'description'	=> esc_html__('Set title for this banner', 'rose')
							),

							array(
									'type'			=> 'textarea',
									'heading'		=> esc_html__('Description', 'rose'),
									'param_name'	=> 'description',
									'value'			=> '',
									'description'	=> esc_html__('Description for this banner', 'rose')
							),

							array(
									'type'			=> 'dropdown',
									'heading'		=> esc_html__('Text Align', 'rose'),
									'param_name'	=> 'align',
									'std'			=> 'text-left',
									'value'			=> array(
											esc_html__( 'Text Left', 'rose' ) => 'text-left',
											esc_html__( 'Text Center', 'rose' ) => 'text-center',
											esc_html__( 'Text Right', 'rose' ) => 'text-right',
									),
									'description'	=> esc_html__('Set alignment for all text this banner', 'rose')
							),

							array(
									'type'			=> 'textfield',
									'heading'		=> esc_html__('Height', 'rose'),
									'param_name'	=> 'height',
									'std'			=> '',
									'value'			=> '',
									'description'	=> esc_html__('Set height for all text this banner. Default 300px.', 'rose')
							),

							array(
									'type'			=> 'textfield',
									'heading'		=> esc_html__('Font Size Title', 'rose'),
									'param_name'	=> 'font_title',
									'value'			=> '',
							),

							array(
									'type'			=> 'textfield',
									'heading'		=> esc_html__('Font Size Description', 'rose'),
									'param_name'	=> 'font_description',
									'value'			=> '',
							),

							array(
									'type'			=> 'colorpicker',
									'heading'		=> esc_html__('Heading Color', 'rose'),
									'param_name'	=> 'color_title',
									'value'			=> '',
									'description'	=> esc_html__('Set height for this banner', 'rose'),
									'group'			=> esc_html__('Design options','rose')
							),

							array(
									'type'			=> 'colorpicker',
									'heading'		=> esc_html__('Description Color', 'rose'),
									'param_name'	=> 'color_description',
									'value'			=> '',
									'description'	=> 'Set height for this banner',
									'group'			=> esc_html__('Design options','rose')
							),

							array(
									'type'			=> 'colorpicker',
									'heading'		=> esc_html__('Line Color', 'rose'),
									'param_name'	=> 'color_line',
									'value'			=> '',
									'description'	=> 'Set height for this banner',
									'group'			=> esc_html__('Design options','rose')
							),

							array(
									'type'			=> 'attach_image',
									'heading'		=> esc_html__('Background Image', 'rose'),
									'param_name'	=> 'bg_img',
									'value'			=> '',
									'group'			=> esc_html__('Design options','rose')
							),

							array(
									'type'			=> 'colorpicker',
									'heading'		=> esc_html__('Background overlay', 'rose'),
									'param_name'	=> 'bg_overlay',
									'value'			=> 'rgba(255,255,255,0.2)',
									'group'			=> esc_html__('Design option','rose')
							),

							array(
									'type'			=> 'dropdown',
									'heading'		=> esc_html__('Parallax', 'rose'),
									'param_name'	=> 'parallax',
									'std'			=> 'bg-scroll',
									'value'			=> array(
											esc_html__( 'Background Scroll', 'rose' ) => 'bg-scroll',
											esc_html__( 'Background Fixed', 'rose' ) => 'bg-fixed',
											esc_html__( 'Background Parallax', 'rose' ) => 'bg-parallax',
									),
									'description'	=> esc_html__('Set alignment for all text this banner'),
									'group'			=> esc_html__('Design options','rose')
							),
							array(
									'name'      => esc_html__('Background Position', 'rose'),
									'id'        => 'bg_position',
									'type'      => 'select',
									'default'   => 'bg-center',
									'desc'      => esc_html__('Sets the starting position of a background image.', 'rose'),
									'options'    => array(
											'bg-top'      => esc_html__('Background Top', 'rose'),
											'bg-bottom'   => esc_html__('Background Bottom', 'rose'),
											'bg-center'   => esc_html__('Background Center', 'rose')
									)
							)
					)
			));
		}

		public function render_shortcode_banner( $attr, $content = '' ) {

			extract(shortcode_atts( array(
					'title' 				=> '',
					'description'			=> '',
					'align'					=> 'text-left',
					'hide_line'				=> '0',
					'bg_img'				=> '',
					'bg_overlay'			=> 'rgba(255,255,255, 0.2)',
					'bg_position'			=> 'bg-center',
					'opacity'				=> '',
					'parallax'				=> 'bg-scroll',
					'color_title'			=> '',
					'color_description'		=> '',
					'color_line'			=> '',
					'height'				=> '',
					'font_description'		=> '',
					'font_title'			=> ''
			), $attr ));

			$bg_header = $style_title = $style_desc = '';

			if( !empty($bg_img) ) {
				$attachment = wp_get_attachment_image_src($bg_img ,'lager');
				$bg_header = 'style="background-image: url('. esc_url($attachment[0]) .')"';
			}
			$height = !empty($height) ? 'style="height:'. esc_attr($height) .'"' : '';
			$style_title .= ( !empty($color_title) && $color_title !="#" ) ? 'color:'. esc_attr($color_title) .';' : '';
			$style_title .= !empty($font_title) ? 'font-size:'. esc_attr($font_title) .';' : '';
			$opacity = !empty($opacity) ? 'data-opacity="'. esc_attr($opacity) .'"' : '';
			$bg_overlay = ( !empty($bg_overlay) && $bg_overlay != "#" ) ? 'style="background-color:'. esc_attr($bg_overlay) .'"' : '';
			$style_desc .= ( !empty($color_description) && $color_description !="#" ) ? 'color:'. esc_attr($color_description) .';' : '';
			$style_desc .= !empty($font_description) ? 'font-size:'. esc_attr($font_description) .';' : '';
			$color_line = ( !empty($color_line) && $color_line !="#" ) ? 'style="background-color:'. esc_attr($color_line) .'"' : '';

			if( !empty($style_title) ) {
				$style_title = 'style="'. $style_title .'"';
			}

			if( !empty($style_desc) ) {
				$style_desc = 'style="'. $style_desc .'"';
			}

			ob_start(); ?>

			<div class="page-header <?php echo esc_attr($bg_position); ?> <?php echo esc_attr($parallax); ?> <?php echo esc_attr($align); ?>" <?php print $bg_header; ?>>

				<?php if ($bg_overlay != '') : ?>
					<div class="overlay" <?php print $bg_overlay; ?> <?php print $opacity; ?>></div>
				<?php endif ?>

				<div class="tb" <?php print $height; ?>>
					<div class="tb-cell ver-middle">

						<?php if($title != '') : ?>
							<h1 class="h2 page-title" <?php print $style_title; ?> ><?php echo esc_html($title); ?></h1>
						<?php endif; ?>

						<?php if($description != '') : ?>
							<p <?php print $style_desc; ?> ><?php echo wp_kses($description, array('br' => array()), null); ?></p>
						<?php endif; ?>

						<?php if( $hide_line == '0' ) : ?>
							<span class="divider" <?php print $color_line; ?> ></span>
						<?php endif; ?>

					</div>
					<div class="tb-cell ver-middle" style="text-align: right;padding-bottom: 30px;">
							<?php  if (strpos($_SERVER['REQUEST_URI'], 'portfolio-') > 0) { ?>
								<a class="button" style="text-align:left;" title="Zurück" href="http://www.bilder-von-irgendwo.de/fotografie/"><i class="fa fa-angle-right"></i>Zurück zur Übersicht</a> 
							<?php } ?>
					</div>
				</div>
			</div>

			<?php $output = ob_get_clean();

			return $output;
		}

		// ICON BOX
		public function vc_map_shortcode_iconbox() {

			vc_map( array(
					'name'			=> esc_html__('Rose Box Icon', 'rose'),
					'base'			=> 'rose_shortcode_iconbox',
					'category'		=> esc_html__('Rose', 'rose'),
					'description'	=> '',
					'params'		=> array(

							array(
									'type' => 'iconpicker',
									'heading' => esc_html__( 'Icon', 'rose' ),
									'param_name' => 'icon',
									'value' => '', // default value to backend editor admin_label
									'settings' => array(
											'emptyIcon' => false,
											'iconsPerPage' => 4000,
									),
									'description' => esc_html__( 'Select icon from library.', 'rose' ),
							),

							array(
									'type' => 'dropdown',
									'heading' => esc_html__( 'Icon Alignment', 'rose' ),
									'param_name' => 'align_icon',
									'std'	=> 'icon-top',
									'value' => array(
											esc_html__( 'Default', 'rose' ) => 'icon-standard',
											esc_html__( 'Icon Left', 'rose' ) => 'icon-left',
											esc_html__( 'Icon Right', 'rose' ) => 'icon-right',
											esc_html__( 'Icon Center', 'rose' ) => 'icon-center',
									),
									'description' => esc_html__( 'Select icon alignment.', 'rose' ),
							),

							array(
									'type'			=> 'textfield',
									'heading'		=> esc_html__('Title', 'rose'),
									'param_name'	=> 'title',
									'value'			=> '',
									'description'	=> esc_html__('Set title for this banner', 'rose')
							),

							array(
									'type'			=> 'textarea',
									'heading'		=> esc_html__('Description', 'rose'),
									'param_name'	=> 'description',
									'value'			=> '',
									'description'	=> esc_html__('Description for this banner', 'rose')
							),

							array(
									'type'			=> 'colorpicker',
									'heading'		=> esc_html__('Icon Color', 'rose'),
									'param_name'	=> 'color_icon',
									'value'			=> '',
									'group'			=> esc_html__('Design options', 'rose')
							),

							array(
									'type'			=> 'colorpicker',
									'heading'		=> esc_html__('Title Color', 'rose'),
									'param_name'	=> 'color_title',
									'value'			=> '',
									'group'			=> esc_html__('Design options', 'rose')
							),

							array(
									'type'			=> 'colorpicker',
									'heading'		=> esc_html__('Description Color', 'rose'),
									'param_name'	=> 'color_description',
									'value'			=> '',
									'group'			=> esc_html__('Design options', 'rose')
							),
					)
			));
		}

		public function render_shortcode_iconbox( $attr, $content = '' ) {

			extract(shortcode_atts( array(
					'icon' 				=> '',
					'title' 			=> '',
					'description'		=> '',
					'align_icon'		=> '',
					'color_icon'		=> '',
					'color_title'		=> '',
					'color_description'	=> ''
			), $attr ));

			$color_icon = !empty( $color_icon) ? 'style="color:'. esc_attr($color_icon) .'"' : '';
			$color_title = !empty( $color_title) ? 'style="color:'. esc_attr($color_title) .'"' : '';
			$color_description = !empty( $color_title) ? 'style="color:'. esc_attr($color_description) .'"' : '';

			ob_start(); ?>


			<div class="icon-box <?php echo esc_attr($align_icon); ?>">

				<?php if( !empty($icon) ) : ?>
					<span class="icon" <?php echo $color_icon; ?> ><i class="<?php echo esc_attr($icon) ?>"></i></span>
				<?php endif; ?>

				<?php if( !empty($title) ) : ?>
					<h4 class="h6" <?php echo $color_title; ?>><?php echo esc_html($title) ?></h4>
				<?php endif; ?>

				<?php if( !empty($description) ) : ?>
					<p <?php echo $color_description; ?>>
						<?php echo wp_kses($description, array( 'br' => array(), 'em' => array(), 'strong' => array() ) ) ?>
					</p>
				<?php endif; ?>

			</div>

			<?php $output = ob_get_clean();

			return $output;
		}

		// CLIENT
		public function vc_map_shortcode_client() {
			vc_map( array(
					'name'			=> esc_html__('Rose Client Carousel', 'rose'),
					'base'			=> 'rose_shortcode_client',
					'category'		=> esc_html__('Rose', 'rose'),
					'params'		=> array(

							array(
									'type' => 'param_group',
									'heading'	=> esc_html__('Item', 'rose'),
									'param_name'	=> 'values',
									'params'	=> array(
											array(
													'type'			=> 'attach_image',
													'heading'		=>	esc_html__('Image', 'rose'),
													'param_name'		=> 'img'
											),

											array(
													'type' 			=> 'textfield',
													'heading'		=> esc_html__('Link', 'rose'),
													'param_name'	=> 'link'
											)
									)
							),

							array(
									'type' 			=> 'dropdown',
									'heading'		=> esc_html__('Target', 'rose'),
									'param_name'	=> 'target',
									'std'			=> '_blank',
									'value'			=> array(
											esc_html__('New Window', 'rose')		=> '_blank',
											esc_html__('Open in window', 'rose')	=> '_self',
									)
							)
					)
			));
		}

		public function render_shortcode_client($attr, $content = '') {

			extract(shortcode_atts( array(
					'values' 		=> '',
					'target'		=> '_blank'
			), $attr ));

			ob_start();

			if(!empty( $values)  ) : ?>

				<?php $clients = json_decode( urldecode( $values ), true ); ?>

				<div class="client">

					<?php foreach ($clients as $client) : ?>

						<?php
						$attachment_id = $client['img'];
						$attachment = wp_get_attachment_image_src( $attachment_id, array(255, 180));
						$link = isset($client['link']) ? $client['link'] : '';
						?>

						<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
							<img src="<?php echo esc_url($attachment[0]); ?>" alt="">
						</a>

					<?php endforeach; ?>

				</div>

			<?php endif;

			$output = ob_get_clean();

			return $output;
		}

		// TITLE
		public function vc_map_shortcode_title() {

			vc_map( array(
					'name'			=> esc_html__('Rose Title', 'rose'),
					'base'			=> 'rose_shortcode_title',
					'category'		=> esc_html__('Rose', 'rose'),
					'description'	=> '',
					'params'		=> array(

							array(
									'type'			=> 'textfield',
									'heading'		=> esc_html__('Title', 'rose'),
									'param_name'	=> 'title',
									'value'			=> '',
							),

							array(
									'type'			=> 'textarea',
									'heading'		=> esc_html__('Description', 'rose'),
									'param_name'	=> 'description',
									'value'			=> '',
							),

							array(
									'type'			=> 'dropdown',
									'heading'		=> esc_html__('Text Align', 'rose'),
									'param_name'	=> 'align',
									'std'			=> 'text-center',
									'value'			=> array(
											esc_html__( 'Text Left', 'rose' ) => 'text-left',
											esc_html__( 'Text Center', 'rose' ) => 'text-center',
											esc_html__( 'Text Right', 'rose' ) => 'text-right',
									),
									'description'	=> esc_html__('Set alignment for all text.', 'rose')
							),

							array(
									'type'			=> 'colorpicker',
									'heading'		=> esc_html__('Heading Color', 'rose'),
									'param_name'	=> 'color_title',
									'value'			=> '',
									'group'			=> esc_html__('Design options', 'rose')
							),

							array(
									'type'			=> 'colorpicker',
									'heading'		=> esc_html__('Description Color', 'rose'),
									'param_name'	=> 'color_description',
									'value'			=> '',
									'group'			=> esc_html__('Design options', 'rose')
							),

							array(
									'type'			=> 'colorpicker',
									'heading'		=> esc_html__('Line Color', 'rose'),
									'param_name'	=> 'color_line',
									'value'			=> '',
									'group'			=> esc_html__('Design options','rose')
							),
					)
			));
		}

		public function render_shortcode_title( $attr, $content = '' ) {

			extract(shortcode_atts( array(
					'title' 				=> '',
					'description'			=> '',
					'align'					=> 'text-center',
					'color_title'			=> '',
					'color_description'		=> '',
					'color_line'			=> '',
			), $attr ));

			$color_title = !empty($color_title) ? 'style="color:'. esc_attr($color_title) .'"' : '';
			$color_description = !empty($color_description) ? 'style="color:'. esc_attr($color_description) .'"' : '';
			$color_line = !empty($color_line) ? 'style="background-color:'. esc_attr($color_line) .'"' : '';

			ob_start(); ?>

			<div class="heading">
				<h2 class="h6" <?php echo  $color_title?> ><?php echo esc_html($title); ?></h2>
				<span class="line" <?php echo  $color_line?> ></span>
				<?php if( !empty($description) ) :  ?>
					<p <?php echo  $color_description?>>
						<?php echo wp_kses($description, array( 'br' => array(), 'em' => array(), 'strong' => array() ) ) ?>
					</p>
				<?php endif; ?>
			</div>

			<?php $output = ob_get_clean();

			return $output;
		}

		public function vc_map_shortcode_google() {

			vc_map( array(
				'name'			=> esc_html__('Rose Google Map', 'rose'),
				'base'			=> 'rose_shortcode_google',
				'category'		=> esc_html__('Rose', 'rose'),
				'description'	=> '',
				'params'		=> array(

					array(
						'type'			=> 'attach_image',
						'heading'		=> esc_html__('Icon Map', 'rose'),
						'param_name'	=> 'icon',
						'value'			=> '',
						'description'	=> esc_html__('Set icon location address', 'rose')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title', 'rose'),
						'param_name'	=> 'title',
						'value'			=> '',
						'description'	=> esc_html__('Name location address.', 'rose')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Latitude', 'rose'),
						'param_name'	=> 'lat',
						'value'			=> '',
							'description'	=> wp_kses_post('Latitude google map. <a hret="http://www.latlong.net/" target="_blank">Find My Lat&Long</a>')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Longitude', 'rose'),
						'param_name'	=> 'long',
						'value'			=> '',
						'description'	=> wp_kses_post('Longitude google map. <a hret="http://www.latlong.net/" target="_blank">Find My Lat&Long</a>')
					),

					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Height', 'rose'),
						'param_name'	=> 'height',
						'value'			=> '',
						'description'	=> esc_html__('Set height google map.', 'rose')
					),
				)
			));
		}
		
		public function render_shortcode_google( $attr, $content = '' ) {

			extract(shortcode_atts( array(
				'icon'					=> '',
				'title'					=> '',
				'lat'					=> '',
				'long'					=> '',
				'height'				=> '400'
			), $attr ));

			if( !empty($icon) ) {
				$icon = wp_get_attachment_image_src($icon);

				if( isset($icon) && !empty($icon)) {
					$icon = $icon[0];
				}
			}

			ob_start(); 

			if( !empty($lat) && !empty($long) ) : ?>
				<div class="contact-map" style="height: <?php echo esc_attr($height) ?>px">
					<div class="map" data-latlng="[<?php echo esc_attr($lat) ?>, <?php echo esc_attr($long) ?>]" data-title="<?php echo esc_attr($title); ?>" data-icon="<?php echo esc_url($icon); ?>"></div>
				</div>
			<?php endif;

			$output = ob_get_clean();

			return $output;
		}

		public function enqueued() {

			if(!wp_script_is('google-map', 'enqueued')) {
				wp_register_script('google-map', 'http://maps.googleapis.com/maps/api/js?v=3&sensor=false', array(), '3.0', true);
				// wp_enqueue_script('google-map');
			}

			if(!wp_script_is('appear', 'enqueued')) {
				wp_register_script('appear', ROSE_SHORTCODE_URL . 'assets/js/jquery.appear.js', array(), '', true);
				wp_enqueue_script('appear');
			}

			if(!wp_script_is('jquery-rose-shortcode', 'enqueued')) {
				wp_register_script('jquery-rose-shortcode', ROSE_SHORTCODE_URL . 'assets/js/rose.shortcode.js', array(), '', true);
				wp_enqueue_script('jquery-rose-shortcode');
			}
		}

		public function render_shortcode_twitter($attr, $content = '') {
			global $rose_option;

			extract(shortcode_atts( array(
					'username'		=> 'wilokethemes',
					'limit'			=> 3,
			), $attr ));

			if ( empty($rose_option['consumer_key']) || empty($rose_option['consumer_secret']) || empty($rose_option['access_token_secret']) || empty($rose_option['access_token']) )
			{
				_e('You haven\'t configured your twitter api', 'wiloke');
			}else{
				require_once plugin_dir_path(__FILE__).'twitter/twitteroauth.php';

				$initTWitter = new TwitterOAuth($rose_option['consumer_key'], $rose_option['consumer_secret'], $rose_option['access_token'], $rose_option['access_token_secret'], $rose_option['cache_interval']);
				$initTWitter->ssl_verifypeer = true;

				$limit  = !empty($limit) ? absint($limit) : 3;
				$tweets = $initTWitter->get('statuses/user_timeline', array('screen_name' => $username, 'include_rts' => 'false', 'count' => $limit));


				if ( !empty($tweets) )
				{
					$tweets = json_decode($tweets);

					if( is_array($tweets) )
					{
						echo '<div class="twitter-slide testimonial-slide text-center">';
						foreach($tweets as $control)
						{
							echo '<div class="testimonial-item">';
							echo '<i class="icon fa fa-twitter"></i>';
							$status =  preg_replace('/http:\/\/([^\s]+)/i', '<a href="http://$1" target="_blank">$1</a>', $control->text);
							print '<p>' . $status . '</p>';
							echo '</div>';
						}
						echo '</div>';
					}

				}else{
					_e('There isn\'t any tweet yet', 'wiloke');
				}
			}
		}

		public function vc_map_shortcode_twitter() {
			vc_map( array(
					'name'			=> esc_html__('Rose Twitter', 'rose'),
					'base'			=> 'rose_shortcode_twitter',
					'category'		=> esc_html__('Rose', 'rose'),
					'description'	=> '',
					'params'		=> array(

							array(
									'type'			=> 'textfield',
									'heading'		=> esc_html__('Username', 'rose'),
									'param_name'	=> 'username',
									'value'			=> 'wilokethemes',
									'std'			=> 'wilokethemes',
									'description'	=> esc_html__('Your twitter username.', 'rose')
							),

							array(
									'type'			=> 'textfield',
									'heading'		=> esc_html__('Limit', 'rose'),
									'param_name'	=> 'limit',
									'value'			=> 3,
									'std'			=> 3,
									'description'	=> esc_html__('Number of tweets will be showed.', 'rose')
							),
					)
			));
		}

		public function render_shortcode_skill($attr, $content = '') {
			extract(shortcode_atts( array(
					'title'					=> '',
					'percent'				=> '',
					'color_title'			=> '',
					'bg'					=> '',
					'bg_percent'			=> '',
					'duration'				=> ''
			), $attr ));
			$data_attribue = '';
			$bg = !empty($bg) ? 'style="bacground-color:'. esc_attr($bg) .';"' : '';
			$bg_percent = !empty($bg_percent) ? 'style="bacground-color:'. esc_attr($bg_percent) .';"' : '';
			$data_attribue .= !empty($duration) ? 'data-duration="'. esc_attr($duration) .'"' : '';
			$data_attribue .= !empty($percent) ? 'data-percent="'. esc_attr($percent) .'"' : '';

			ob_start(); ?>

			<div class="skill" <?php print $data_attribue; ?> >
				<?php if( !empty($title) ) : ?>
					<h4><?php echo esc_html($title) ?> <span class="percent"></span></h4>
				<?php endif; ?>
				<span class="processbar" <?php print $bg; ?>>
					<span class="processbar-percent" <?php print  $bg_percent; ?>></span>
				</span>
			</div>

			<?php $output = ob_get_clean();

			return $output;
		}

		public function vc_map_shortcode_skill() {
			vc_map( array(
					'name'			=> esc_html__('Rose Skill', 'rose'),
					'base'			=> 'rose_shortcode_skill',
					'category'		=> esc_html__('Rose', 'rose'),
					'description'	=> '',
					'params'		=> array(

						array(
								'type'			=> 'textfield',
								'heading'		=> esc_html__('Title', 'rose'),
								'param_name'	=> 'title',
								'value'			=> '',
								'description'	=> esc_html__('Skill name.', 'rose')
						),

						array(
								'type'			=> 'textfield',
								'heading'		=> esc_html__('Percent', 'rose'),
								'param_name'	=> 'percent',
								'description'	=> esc_html__('Example: 50', 'rose')
						),

						array(
								'type'			=> 'textfield',
								'heading'		=> esc_html__('Duration', 'rose'),
								'param_name'	=> 'duration',
								'description'	=> esc_html__('Example 2000', 'rose')
						),

						array(
								'type'			=> 'colorpicker',
								'heading'		=> esc_html__('Title Color', 'rose'),
								'param_name'	=> 'color_title',
								'value'			=> '',
								'group'			=> esc_html__('Design options', 'rose')
						),

						array(
								'type'			=> 'colorpicker',
								'heading'		=> esc_html__('Background Processbar', 'rose'),
								'param_name'	=> 'bg',
								'value'			=> '',
								'group'			=> esc_html__('Design options', 'rose')
						),

						array(
								'type'			=> 'colorpicker',
								'heading'		=> esc_html__('Background Processbar Percent', 'rose'),
								'param_name'	=> 'bg_percent',
								'value'			=> '',
								'group'			=> esc_html__('Design options', 'rose')
						),
					)
			));
		}

	}

	new rose_plugin_shortcode();
}
