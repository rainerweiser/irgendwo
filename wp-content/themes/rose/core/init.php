<?php 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define('PI_ENQUEUE_CORE', get_template_directory_uri() . '/core/');
define('PI_FILE_CORE', get_template_directory() . '/core/');

if( !class_exists('rose_framework') ) {

	class rose_framework {

		public static $option;

		public function __construct() {
			$this->_init();
			add_action('wp_head', array($this, 'rose_render_css'));
			add_action('wp_footer', array($this, 'rose_render_js'));
			add_action('wp_enqueue_scripts',  array($this, 'custom_style_setting'));

			// add_action('admin_notices', array($this, 'rose_notices') );
			add_action('wp_ajax_wiloke_notice', array($this, 'rose_update_notice_status'));
		}

		static public function wiloke_get_nav_menus()
		{
			$aNavMenus          = wp_get_nav_menus();
			$aParseNavMenus     = array();

			if ( !empty($aNavMenus) )
			{
				$aParseNavMenus[-1] = esc_html__('Use default menu', 'rose');
				foreach ($aNavMenus as $aMenu)
				{
					$aParseNavMenus[$aMenu->term_id] = $aMenu->name;
				}
			}else{
				$aParseNavMenus[-1] = esc_html__('There are no menus', 'rose');
			}

			return $aParseNavMenus;
		}

		public function rose_update_notice_status()
		{
			if ( isset($_POST['version']) )
			{
				$aData[] = $_POST['version'];
				update_option('wiloke_notice', $aData);
			}
			die();
		}

		public function rose_notices()
		{
			$aStatus = get_option('wiloke_notice');
			
			if (  empty($aStatus) || !in_array('1.1', $aStatus) ) :
			?>
			<div class="notice notice-error is-dismissible wiloke-dismissible" data-version="1.1">
				<p><?php esc_html_e('There is a big change in Rose 1.1. At the version 1.0, You can\'t use Revolution Slider, gallery shortcode ...etc... for your project, this version allow you to do that.', 'rose'); ?></p>
				<p><?php esc_html_e('If you purchased Rose 1.1, you can skip this notice, but if you have used Rose before, MUST follow these steps below:', 'rose'); ?></p>
				<ol>
					<li><?php esc_html_e('Download Rose - Move Portfolio Data from this link', 'rose'); ?> <a target="_blank" href="http://blog.wiloke.com/wp-content/uploads/2016/03/rose-move-portfolio-data.zip">http://wp.me/a6RuVo-4m</a></li>
					<li><?php esc_html_e('Go to Plugins -> Upload Plugin, drag this package onto Choose File.', 'rose'); ?></li>
					<li><?php esc_html_e('Hit Install Now button then click Activate this plugin.', 'rose'); ?></li>
					<li><?php esc_html_e('Refresh your website.', 'rose'); ?></li>
					<li><?php esc_html_e('Finally, Go to Plugins from the admin panel and deactivate it.', 'rose'); ?></li>
				</ol>
			</div>
		<?php
			endif;
		}

		public function _init() {
			$option = get_option( 'rose_option' );
			self::$option = $option;
			$this->rose_render_google_font();
		}

		public static function rose_loader() {
			if( isset(self::$option['preloader']) && !empty(self::$option['preloader']) ) : ?>
				<div class="preloader">
			  		<div class="progress"></div>
				</div>
			<?php endif;
		}

		// Custon CSS
		function rose_render_css() {
			if( isset(self::$option['custom_css']) && !empty(self::$option['custom_css']) ) : ?>
				<style type="text/css">
					<?php print self::$option['custom_css']; ?>
				</style>
			<?php endif;
		}

		// Custon CSS
		function rose_render_js() {
			if( isset(self::$option['custom_js']) && !empty(self::$option['custom_js']) ) : ?>
				<script type="text/javascript">
					<?php print self::$option['custom_js']; ?>
				</script>
			<?php endif;
		}

		// Option Google Font
		public static function rose_googlefont_option() {
			$font_google = array();

			if( isset(self::$option['rose_google_font']) && !empty(self::$option['rose_google_font']) ) {
				$font_google  = rose_parse_googlefont(self::$option['rose_google_font']);
			}

			return $font_google;
		}

		// RENDER GOOGLE FONT
		public function rose_render_google_font() {
			if( isset(self::$option['rose_google_font']) && !empty(self::$option['rose_google_font']) ) {
		        $customGoogleFont = explode("\n", self::$option['rose_google_font']);

		        foreach ( $customGoogleFont as $key => $googleFont ) {
		            if ( !empty($googleFont) ) {

		            	preg_match('/(?:family=)([^:&\'\"]*)(?:\:?)((?:[^&\'\"]*))/', $googleFont, $match);

		                $font = str_replace('+', ' ', $match[1]);

		                if ( isset($match[2]) ) {
		                    $font .= ':'.$match[2];
		                }

		                wp_enqueue_style('rose_customgooglefont_'.$key, rose_studio_fonts_url($font), array(), null);
		            }
		        }
			}
		}

		// RENDER FAVICON
		public static function rose_render_favicon() { 
			if( isset(self::$option['favicon']['url']) ) : ?>
				<link rel="shortcut icon" href="<?php echo esc_url(self::$option['favicon']['url']); ?>">
			<?php endif;
		}

		// RENDER LOGO
		public static function rose_render_logo() {
			$src = isset(self::$option['logo']['url'] ) ? self::$option['logo']['url'] : ''; 
			$src = empty($src) ? get_template_directory_uri() .'/img/logo.png' : $src;
			if ( has_filter('rose_filter_render_logo') )
			{
				$src = apply_filters('rose_filter_render_logo', $src);
			}
			?>
			<div class="logo">
				<span>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( bloginfo('name') ); ?>">
						<img src="<?php echo esc_url($src); ?>" alt="<?php echo esc_attr( bloginfo('name') ) ?>">
					</a>
				</span>

				<span style="float:right">
					<a href="mailto:fernweh@bilder-von-irgendwo.de" target="_blank">
						<i class="far fa-envelope" style="font-size:20px;color:#888888;margin-right:18px"></i>
					</a>
					<a href="https://www.instagram.com/bildervonirgendwo/" target="_blank" rel="noreferrer">
						<i class="fab fa-instagram" style="font-size:20px;color:#888888;margin-right:18px"></i>
					</a>
					<a href="https://500px.com/rainerweiser" target="_blank" rel="noreferrer">
						<i class="fab fa-500px" style="font-size:18px;color:#888888;"></i>
					</a>
				</span>				
			</div>
			<?php
		}
		// SHEARCH ICON
		public static function rose_icon_search() {    
			if( !isset(self::$option['header_option']['social_icon']) || empty(self::$option['header_option']['social_icon']) ) : ?>
				<span class="icon-share"><i class="fa fa-share-alt"></i></span>
			<?php endif; 
		}

		// SEARCH FROM POPUP
		public static function rose_popup_search_form() { 
			if( !isset(self::$option['header_option']['search_icon']) || empty(self::$option['header_option']['search_icon']) ) : ?>
				<section class="popup-search">
					<div class="tb">
						<div class="tb-cell ver-middle">
							<form role="search" method="get" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="search" class="input-search" value="<?php echo get_search_query(); ?>" name="s"  placeholder="<?php echo esc_html__('Suchen ...', 'rose') ?>">
								<button type="submit" class="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>
					<div class="close-popup"></div>
				</section>
			<?php endif;
		}

		// SOCIAL ICON
		public static function rose_icon_social() {
			if( (!isset(self::$option['header_option']['search_icon']) || empty(self::$option['header_option']['search_icon']) ) && is_singular()): ?>
				<span class="icon-search"><i class="fa fa-search"></i></span>
			<?php endif;
		}

		// POPUP SOCIAL
		public static function rose_popup_social() { 
			$socials = array(
				'fa-facebook'			=> 'Facebook',
				'fa-twitter'			=> 'Twitter',
				'fa-google-plus'		=> 'Google Plus',
				'fa-pinterest'			=> 'Pinterest',
				'fa-linkedin'			=> 'Linkedin',
				'fa-rss'				=> 'RSS',
				'fa-instagram'			=> 'Instagram',
				'fa-skype'				=> 'Skype',
				'fa-tumblr'				=> 'Tumblr',
				'fa-vimeo-square'		=> 'Vimeo',
				'fa-yahoo'				=> 'Yahoo',
				'fa-youtube'			=> 'Youtube',
			);
			if( !isset(self::$option['header_option']['social_icon']) || empty(self::$option['header_option']['social_icon']) ) : ?>
				<section class="popup-social">
					<div class="tb">
						<div class="tb-cell ver-middle">
							<?php foreach ($socials as $k => $v) : ?>
								<?php if( isset(self::$option[$k]) && !empty(self::$option[$k]) ) : ?>
									<a href="<?php echo esc_url(self::$option[$k ]); ?>"><i class="fa <?php echo esc_attr($k) ?>"></i> <?php echo esc_html($v); ?></a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="close-popup"></div>
				</section>
			<?php endif;
		}

		// COPPYRIGHT
		public static function rose_copyright() {
			if( isset(self::$option['footer_text']) && !empty(self::$option['footer_text'])) : ?>
				<div class="copyright">
					<p>
						<?php //echo wp_kses(self::$option['footer_text'], array('a'=>array('href'=>array(), 'target'=>array(), 'title'=>array()), 'strong'=>array(), 'i'=>array())); ?>
						COPYRIGHT © <?php echo date('Y') ?> Rainer & Sandra Weiser&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.bilder-von-irgendwo.de/impressum/">Impressum</a></p>
				</div>
			<?php endif;
		}
		
		// FOOTER INSTAGRAM
		public static function rose_footer_instagram() {
            $title = isset(self::$option['instagram_title']) ? self::$option['instagram_title'] : '';
	        $userID = isset(self::$option['instagram_userid']) ? self::$option['instagram_userid'] : '';
	        $accesstoken = isset(self::$option['instagram_access']) ? self::$option['instagram_access'] : '';
			$transientKey = 'wiloke_instagram_caching_'.$userID;

			if(!empty($userID) &&  !empty($accesstoken)) : ?>
				<div class="widget">
					<h4 class="h6 widget-title"><?php echo esc_html($title); ?></h4>

					<?php
						$isRequestInstagram = true;

						if ( !empty(self::$option['instagram_cache_interval']) )
						{
							$instagramContent = get_transient($transientKey);

							if ( !empty($instagramContent) )
							{
								print $instagramContent;
								$isRequestInstagram = false;
							}
						}


						if ( $isRequestInstagram ) :
							$url = 'https://api.instagram.com/v1/users/'.$userID.'/media/recent?access_token='.$accesstoken.'&count=6';
							$getInstagram = wp_remote_get( esc_url_raw( $url ), array( 'decompress' => false ));

							if (!is_wp_error($getInstagram) ) :

								$getInstagram = wp_remote_retrieve_body($getInstagram);
								$getInstagram = json_decode($getInstagram);

								if ( $getInstagram->meta->code === 200 ) :
									$count = count($getInstagram->data) > 6 ? 6 : count($getInstagram->data);
									ob_start();
						?>
									<div class="footer-instagram">

										<?php for ( $i=0; $i<$count; $i++ ) :

											$caption = isset($getInstagram->data[$i]->caption->text) ? $getInstagram->data[$i]->caption->text : 'Instagram'; ?>
											<a href="<?php echo esc_url($getInstagram->data[$i]->link); ?>" target="_blank">
												<img src="<?php echo esc_url($getInstagram->data[$i]->images->standard_resolution->url); ?>" alt="<?php echo esc_attr($caption); ?>" width="<?php echo esc_attr($getInstagram->data[$i]->images->standard_resolution->width); ?>" height="<?php echo esc_attr($getInstagram->data[$i]->images->standard_resolution->height) ?>" />
											</a>
										<?php endfor; ?>

									</div>
	            	<?php
									$instagramContent = ob_get_clean();
									print $instagramContent;

									if ( !empty(self::$option['instagram_cache_interval']) )
									{
										delete_transient($transientKey);
										set_transient($transientKey, $instagramContent, absint(self::$option['instagram_cache_interval']));
									}

								endif;
							endif;
						endif;
					?>

	            </div>

            <?php endif;
		}

		public function custom_style_setting() {
			wp_enqueue_style('rose-custom-style', get_template_directory_uri() . '/css/custom_color.css');

			$custom_css = "";

			if( isset(self::$option['color_paragraph']['color']) && !empty(self::$option['color_paragraph']['color']) ) {
				$color_body = self::$option['color_paragraph']['color'];
				$custom_css .= "
					body, .portfolio-filter .ul-filter li:after,
					.portfolio-filter .ul-filter li a,
					.commentlist .comment .comment-body .comment-edit-reply a,
					.comment-respond .comment-form .form-item textarea:focus,
					.widget .tagcloud a {
						color: {$color_body};
					}";
			}

			if( isset(self::$option['color_title']['color']) && !empty(self::$option['color_title']['color']) ) {
				$color_title = self::$option['color_title']['color'];
				$custom_css .= "
					.c-title, h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6, .post .post-entry .entry-content blockquote cite, .icon-box .icon, .portfolio-item .caption .cat, .portfolio-item .caption .arrow, .portfolio-item .heart, .team-item .social-user a, .commentlist .comment .comment-body .fn, .tabs .ui-tabs-nav li a {
						color: {$color_title};
					}

					.page-header .divider, .heading span, .portfolio-item .caption .hr {
						background-color: {$color_title};
					}";
			}

			if( isset(self::$option['color_hover']['color']) && !empty(self::$option['color_hover']['color']) ) {
				$color_hover = self::$option['color_hover']['color'];
				$custom_css .= "
					.c-hover, .accordion .accordion-header:hover, .accordion .accordion-header.ui-accordion-header-active, .tabs .ui-tabs-nav li a:hover, .tabs .ui-tabs-nav li.ui-tabs-active a, #header .nav-menu .icon-share:hover, #header .nav-menu .icon-search:hover, #header .nav-menu .menu li:hover > a, #header .nav-menu .menu li.current-menu-item > a, #header .nav-menu .menu li.current-menu-parent > a, #header .nav-menu .menu li .sub-menu li:hover > a, #header .nav-menu .menu li .sub-menu li.current-menu-item > a, #header .nav-menu .menu li .sub-menu li.current-menu-parent > a, #header .nav-menu .menu-mobile li:hover > a, #header .nav-menu .menu-mobile li.current-menu-parent > a, #header .nav-menu .menu-mobile li.current-menu-item > a, .popup-social a:hover, .post .post-media .post-link a:hover .entry-title, .post .post-media .post-link a:hover span, .post .post-media .post-link a:hover .icon, .post .post-entry .entry-title:hover a, .post .post-entry .entry-meta a:hover, .post .post-entry .entry-meta .post-categories li a:hover, .comment-navigation .nav-links, .comment-navigation .nav-links a:hover, .related-gird .related-post h2:hover, .portfolio-filter .ul-filter li a:hover, .portfolio-filter .ul-filter li.active a, .portfolio-info ul li a:hover, .portfolio-isotop.caption-bottom .portfolio-item:hover h2, .portfolio-isotop.caption-bottom .portfolio-item:hover .arrow, .team-item .social-user a:hover, .twitter-slide .icon, .commentlist .comment .comment-body .comment-edit-reply a:hover, .widget ul li a:hover, .widget .calendar_wrap table a, .widget .tagcloud a:hover, .widget_categories ul li a:hover, .widget_archive ul li a:hover, .widget_pages ul li a:hover, .widget_meta ul li a:hover, .widget_nav_menu ul li a:hover, #footer .widget_footer_left ul li a:hover {
						color: {$color_hover};
					}

					.bg-hover, .progress, .preloader .progressFull, .bg-darkgold, .popup-search .close-popup:hover:before, .popup-search .close-popup:hover:after, .popup-social .close-popup:hover:before, .popup-social .close-popup:hover:after, .portfolio-filter .toggle-filter:hover, .portfolio-filter .ul-filter li a:after, .nav-portfolio .center-block:hover, .widget_pi_follow .pi-social-square a:hover, #footer .scroll-top:hover,
					.pricing-item.highlights .price {
						background-color: {$color_hover};
					}

					.b-color-hover, .popup-social a:hover i, .post .post-media .post-link a:hover .icon, .portfolio-isotop.caption-bottom .portfolio-item:hover .arrow, .twitter-slide .icon, .widget_pi_follow .pi-social-square a:hover, #footer .scroll-top:hover {
						border-color: {$color_hover};
					}";
			}

			if( isset(self::$option['rose_google_font']) && !empty(self::$option['rose_google_font']) ) {

		        if( isset(self::$option['rose_font_title']) && !empty(self::$option['rose_font_title']) && self::$option['rose_font_title'] != 'default' ) {
		        	$font_title = rose_explode_font(self::$option['rose_font_title']);
		        	$font_title_name = trim( str_replace('+',' ',$font_title[0]) );
		        	$font_title_weight = isset($font_title[1]) ? $font_title[1] : normal;
		        	$font_title_style = isset($font_title[2]) ? $font_title[2] : normal;
		        	$custom_css .= ".f-title, h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6, .button, .post-password-form p label, .post-password-form p input[type='submit'] {
	        		    font-family: '{$font_title_name}', sans-serif;
	        		    font-weight: {$font_title_weight};
	        		    font-style: {$font_title_style};
		        	}";
		        }

		        if( isset(self::$option['rose_font_sub_title']) && !empty(self::$option['rose_font_sub_title']) && self::$option['rose_font_sub_title'] != 'default' ) {
		        	$font_sub = rose_explode_font(self::$option['rose_font_sub_title']);
		        	$font_subtitle_name = trim( str_replace('+',' ',$font_sub[0]) );
		        	$font_subtitle_weight = isset($font_sub[1]) ? $font_sub[1] : normal;
		        	$font_subtitle_style = isset($font_sub[2]) ? $font_sub[2] : normal;
		        	$custom_css .= ".s-font, .page-header p, .heading p, .post .post-media .meta-date .day, .post .post-media p, .post .post-media .post-link span, .post .post-entry .entry-meta, .post .post-entry .entry-meta .post-categories li a, .post .post-entry .entry-content blockquote p, .post-password-form p, .nav-post ul, .comment-navigation .nav-links, .related-gird .related-post span, .page-404 h2, .portfolio-filter .ul-filter li, .portfolio-item .caption .cat, .portfolio-item .heart, .nav-portfolio .nav-left, .nav-portfolio .nav-right, .portfolio-info p em, .portfolio-info ul li, .team-item span, .pricing-item .price, .testimonial-item p, .testimonial-item span, #comments-title span, .comment-reply-title span, .commentlist .comment .comment-body .comment-date, .commentlist .comment .comment-body .comment-edit-reply a, .widget .tagcloud a, .widget_pi_follow p, .widget_pi_mailchimp .text-italic, .widget_recent_comments ul li .comment-author-link, .widget_recent_entries ul li .comment-author-link, .widget_rss ul li .comment-author-link, .widget_recent_comments ul li .rss-date, .widget_recent_comments ul li .post-date, .widget_recent_entries ul li .rss-date, .widget_recent_entries ul li .post-date, .widget_rss ul li .rss-date, .widget_rss ul li .post-date {
	        		    font-family: '{$font_subtitle_name}', sans-serif;
	        		    font-weight: {$font_subtitle_weight};
	        		    font-style: {$font_subtitle_style};
		        	}";
		        }

		        if( isset(self::$option['rose_font_content']) && !empty(self::$option['rose_font_content']) && self::$option['rose_font_content'] != 'default' ) {
		        	$font_content = rose_explode_font(self::$option['rose_font_content']);
		        	$font_content_name = trim( str_replace('+',' ',$font_content[0]) );
		        	$font_content_weight = isset($font_content[1]) ? $font_content[1] : normal;
		        	$font_content_style = isset($font_content[2]) ? $font_content[2] : normal;
		        	$custom_css .= ".f-content, body, .post .post-entry .entry-meta .meta-date:after, .post .post-entry .entry-meta .meta-author:after {
	        		    font-family: '{$font_content_name}', sans-serif;
	        		    font-weight: {$font_content_weight};
	        		    font-style: {$font_content_style};
		        	}";
		        }
			}

			if(!empty($custom_css) ) {
				wp_add_inline_style( 'rose-custom-style', $custom_css );
			}
		}
	}

	new rose_framework();

	require_once PI_FILE_CORE . 'TGM_Activation_Plugin/plugin_active.php';
	require_once PI_FILE_CORE . 'option_theme.php';
	require_once PI_FILE_CORE . 'admin/admin_init.php';
	require_once PI_FILE_CORE . 'blog/blog.php';
	require_once PI_FILE_CORE . 'visual/visual_init.php';
	require_once PI_FILE_CORE . 'portfolio/portfolio.php';

	// AFTER IMPORT DEMO
	add_action('import_end', 'rose_after_import_demo');
	function rose_after_import_demo() {

		// Update Front page displays
		$displays = get_option( 'show_on_front');
		$page_front = get_page_by_path('revolution');
		$page_posts = get_page_by_path('blog');

		if($page_front) {
			update_option('page_on_front', $page_front->ID);
		}

		if($page_posts) {
			update_option('page_for_posts', $page_posts->ID);
		}

		if($page_posts || $page_front ) {

			if($displays == 'posts') {
				update_option('show_on_front', 'page');
			}
		}

		// Update Portfolio
		$portfolio_page = get_pages(array(
			'post_type' => 'page',
			'meta_key' => '_wp_page_template',
			'meta_value' => 'template/portfolio.php'
		));

		if($portfolio_page) {

			$arr_slug = array('branding', 'marketing', 'motion', 'photography');

			$terms = get_terms(
				'category-portfolio', 

				array(
					'fields'	=> 'ids',
					'hide_empty' => true, 
					'parent' => 0,
					'slug' => $arr_slug
				)
			); 

			foreach ($portfolio_page as $k => $v) {
				$setting = get_post_meta($v->ID, 'settings', true ); 

				if( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
					$setting['term_ids'] = $terms;
				}

				update_post_meta($v->ID, 'settings', $setting );
			}
		}
	}

}

	


