<?php
	define("PI_WT_VERSION", "1.0");
	define('PI_CSS_URI', get_template_directory_uri() . '/css/');
	define('PI_JS_URI', get_template_directory_uri() . '/js/');
	define('PI_WT_IMG',  get_template_directory_uri() . '/img/');

	add_action( 'after_setup_theme', 'rose_setup' );
	function rose_setup() {

		load_theme_textdomain( 'rose', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support('title-tag');

		global $content_width;

		if ( ! isset( $content_width ) ) { 
			$content_width = 1200;
		}

		add_theme_support( 'menus' );
		register_nav_menus(
			array( 'main-menu' => esc_html__( 'Rose Menu', 'rose' ) )
		);

		add_theme_support( 'post-thumbnails' );
		add_image_size( 'blog-standard', 870);
		add_image_size( 'blog-masonry', 515);
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'link', 'quote' ) );
	}
	
	function rose_get_postformat($post) {
		return get_post_format($post);
	}

	// Widget Sidebar
	add_action('widgets_init', 'rose_widget_sidebar');
	function rose_widget_sidebar() {
		register_sidebar( array(
			'name'			=> esc_html__('Sidebar', 'rose'),
			'id'			=> 'sidebar',
			'description'	=> '',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="h5 widget-title"><span>',
			'after_title'	=> '</span></h4>'
		) );

		register_sidebar( array(
			'name'			=> esc_html__('Footer Left', 'rose'),
			'id'			=> 'footer_left',
			'description'	=> '',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="h5 widget-title">',
			'after_title'	=> '</h4>'
		) );

		register_sidebar( array(
			'name'			=> esc_html__('Footer Right', 'rose'),
			'id'			=> 'footer_right',
			'description'	=> '',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h4 class="h5 widget-title">',
			'after_title'	=> '</h4>'
		) );
	}

	/*
	Register Fonts
	*/
	function rose_studio_fonts_url($font) {
	    $font_url = '';
	    
	    /*
	    Translators: If there are characters in your language that are not supported
	    by chosen font(s), translate this to 'off'. Do not translate into your own language.
	     */
	    if ( 'off' !== _x( 'on', 'Google font: on or off', 'rose' ) ) {
	        $font_url = add_query_arg( 'family', urlencode( $font ), "//fonts.googleapis.com/css" );
	    }
	    return $font_url;
	}

	// Enqueue script and style
	add_action( 'wp_enqueue_scripts', 'rose_load_scripts' );
	function rose_load_scripts() 
	{
		wp_enqueue_style( 'rose', get_stylesheet_uri() );

		if( isset(rose_framework::$option['googlemap_api']) && !empty(rose_framework::$option['googlemap_api']) )
    	{
    		$url = add_query_arg( 'key', rose_framework::$option['googlemap_api'], '//maps.googleapis.com/maps/api/js' );
    		wp_enqueue_script('googlemap', $url, array(), 'v3', false);
    	}

	    if( !wp_style_is('rose_google_fonts' , 'enqueued') ) {
	    	$font_default = 'Raleway:400,600,700,300|Playfair Display:400,400italic,600';
		 	wp_enqueue_style('rose_google_fonts', rose_studio_fonts_url($font_default), array(), '1.0.0' );
	    }

	    if( !wp_style_is('font-awesome' , 'enqueued') ) {
	    	//wp_register_style('font-awesome', PI_CSS_URI . 'css/lib/font-awesome.min.css', array(), '4.4.0', 'all');
	    	wp_register_style('font-awesome', 'https://use.fontawesome.com/releases/v5.0.12/css/all.css', array(), '5.0.12', 'all');
		 	wp_enqueue_style('font-awesome');
	    }

	    if( !wp_style_is('font-linea' , 'enqueued') ) {
	    	wp_register_style('font-linea', PI_CSS_URI .'lib/font-linea.css', array(), '', 'all');
		 	wp_enqueue_style('font-linea');
	    }

	    if( !wp_style_is('bootstrap' , 'enqueued') ) {
	    	wp_register_style('bootstrap', PI_CSS_URI .'lib/bootstrap.min.css', array(), '3.3.6', 'all');
		 	wp_enqueue_style('bootstrap');
	    }

	    if( !wp_style_is('rose_style' , 'enqueued') ) {
	    	wp_register_style('rose_style', PI_CSS_URI .'style.css', array(), PI_WT_VERSION, 'all');
		 	wp_enqueue_style('rose_style');
	    }

	    wp_enqueue_script('jquery');

	    if( !wp_script_is('carousel', 'enqueued') ) {
	    	wp_register_style('carousel', PI_CSS_URI .'lib/owl.carousel.css', array(), '2.0.0', 'all');
	    	wp_register_script('carousel', PI_JS_URI .'lib/owl.carousel.min.js', array(), '2.0.0', true);
	    	wp_enqueue_style('carousel');
		 	wp_enqueue_script('carousel');
	    }

	    if( !wp_script_is('retina', 'enqueued') ) {
	    	wp_register_script('retina', PI_JS_URI .'lib/retina.min.js', array(), null, true);
		 	wp_enqueue_script('retina');
	    }

	    if( !wp_script_is('parallax' , 'enqueued') ) {
	    	wp_register_script('parallax', PI_JS_URI .'/lib/jquery.parallax-1.1.3.js', array(), '1.1.3', true);
		 	wp_enqueue_script('parallax');
	    }

	    if( !wp_script_is('imagesloaded', 'enqueued') ) {
	    	wp_register_script('imagesloaded', PI_JS_URI .'lib/imagesloaded.pkgd.js', array(), '3.2.0', true);
		 	wp_enqueue_script('imagesloaded');
	    }

	    if( !wp_script_is('isotope', 'enqueued') ) {
	    	wp_register_script('isotope', PI_JS_URI .'lib/isotope.pkgd.min.js', array(), '2.2.2', true);
		 	wp_enqueue_script('isotope');
	    }

	    if( !wp_style_is('animate', 'enqueued') ) {
	    	wp_register_style('animate', PI_CSS_URI .'lib/animate.css', array(), '', 'all');
	    	wp_enqueue_style('animate');
	    }

	    if( !wp_script_is('wow', 'enqueued') ) {
	    	wp_register_script('wow', PI_JS_URI .'lib/wow.min.js', array(), '1.0.4', true);
	    	wp_enqueue_script('wow');
	    }

	    if ( !wp_script_is('magnific-popup', 'enqueued') ) {
            wp_register_style('magnific-popup', PI_CSS_URI . 'lib/magnific-popup.css', array(), '');
            wp_enqueue_style('magnific-popup');

            wp_register_script('magnific-popup', PI_JS_URI . 'lib/jquery.magnific-popup.min.js', array('jquery'), '', true);
            wp_enqueue_script('magnific-popup');
        }

        if( !wp_script_is('jquery-ui-tabs', 'enqueued') ) {
		 	wp_enqueue_script('jquery-ui-tabs');
	    }

	    if( !wp_script_is('jquery-ui-accordion', 'enqueued') ) {
		 	wp_enqueue_script('jquery-ui-accordion');
	    }

	    if( !wp_script_is('rose_scripts', 'enqueued') ) {
	    	wp_register_script('rose_script', PI_JS_URI .'script.js', array(), PI_WT_VERSION, true);
	    	wp_localize_script( 'rose_script', 'rose_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
		 	wp_enqueue_script('rose_script');
	    }

	}

	// Custom comment
	add_action( 'comment_form_before', 'rose_enqueue_comment_reply_script' );
	function rose_enqueue_comment_reply_script() {

		if ( get_option( 'thread_comments' ) ) { 
			wp_enqueue_script( 'comment-reply' ); 
		}
	}

	// Custom title
	add_filter( 'wp_title', 'rose_filter_wp_title', 10, 2);
	function rose_filter_wp_title( $title, $sep ) {

	    global $paged, $page;

	    if ( is_feed() ) {
	      return $title;
	    }

	    // Add the site name.
	    $title .= get_bloginfo( 'name' );

	    // Add the site description for the home/front page.
	    $site_description = get_bloginfo( 'description', 'display' );

	    if ( $site_description && ( is_home() || is_front_page() ) ) {
	      	$title = "$title $sep $site_description";
      	}

	    // Add a page number if necessary.
	    if ( $paged >= 2 || $page >= 2 ) {
	      	$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'rose'), max( $paged, $page ) ); 
      	}

	  	return $title;
	}

	add_action('comment_form_top', 'rose_comment_form_top');
	function rose_comment_form_top() {
		echo '<div class="row">';
	}

	add_action('comment_form', 'rose_comment_form_bottom');
	function rose_comment_form_bottom($post_id) {
		echo '</div>';
	}

	add_filter( 'comment_form_fields', 'rose_move_comment_field_to_bottom' );
	function rose_move_comment_field_to_bottom( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}
	

	function rose_custom_comment ( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; ?>

		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

			<?php echo get_avatar($comment, $args['avatar_size'] ); ?>

			<div class="comment-body">
				<cite class="fn text-uppercase"><?php comment_author_link(); ?></cite>
			
				<span class="comment-date"><?php printf( esc_html__('%1s at %2s', 'rose'), get_comment_date(), get_comment_time() ); ?></span>

				<?php comment_text(); ?>

				<div class="comment-edit-reply">
					<?php comment_reply_link( array_merge( $args, array('reply_text'=> esc_html__('Reply', 'rose'), 'depth'=> $depth, 'max_depth'=>$args['max_depth']) ), $comment->comment_ID ); ?>
					<?php if( is_user_logged_in() ) { echo '/'; } ?>
					<?php edit_comment_link( esc_html__('Edit', 'rose') );  ?>
	            </div>

            </div>

		<?php 
	}

	// Convert array key=>value to attribute
	function rose_array_to_attributes($array_attr) {
		$str = null;


		foreach ($array_attr as $key => $value)
		{
			if ( $key == 'bg_overlay' )
			{
				if ( isset($value['rgba']) && !empty($value['rgba']) )
				{
					$str .= "$key='".$value['rgba']."'";
				}else{
					if ( isset($value['color']) && !empty($value['color']) )
					{
						$str .= "$key='".$value['color']."'";
					}
				}
			}else{
				$str .= "$key=\"$value\" ";
			}

		}

		return $str;
	}	

	if ( ! function_exists( 'redux_disable_dev_mode_plugin' ) ) {
        function redux_disable_dev_mode_plugin( $redux ) {
            if ( $redux->args['opt_name'] != 'redux_demo' ) {
                $redux->args['dev_mode'] = false;
                $redux->args['forced_dev_mode_off'] = false;
            }
        }
        add_action( 'redux/construct', 'redux_disable_dev_mode_plugin' );
    }

    // Remove font end editor
    if ( function_exists('vc_disable_frontend') )
    {
    	vc_disable_frontend();

    	add_filter( 'vc_load_default_templates', 'rose_custom_template_modify_array' ); // Hook in
		function rose_custom_template_modify_array( $data ) {
		    return array(); // This will remove all default templates. Basically you should use native PHP functions to modify existing array and then return it.
		}
    }

    // PARSE VIDEO
    function rose_parse_video($url) {

        $type = $id = '';

        if (strpos($url, 'youtube') > 0) {

            $type = 'youtube';
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $output_array);
            $id = $output_array[1];

        } else if (strpos($url, 'vimeo') > 0) {

            $type = 'vimeo';
            preg_match('/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/', $url, $output_array);
            $id = $output_array[5];

        }

        if ( !empty($id) && !empty($type) ) {
            return array('type'=>$type, 'id'=>$id);
        } else {
            return array('type'=>'self', 'id'=>$id);
        }
    }

    function rose_add_to_head()
    {
    	?>
		<script type="text/javascript">
		window.WilokeGlobal = {};
		WilokeGlobal.portfolio = {};
		</script>
    	<?php

    	if( isset(rose_framework::$option['header_code']) && !empty(rose_framework::$option['header_code']) )
    	{
    		print rose_framework::$option['header_code'];
    	}
    }

    function rose_add_to_footer()
    {
    	if( isset(rose_framework::$option['footer_code']) && !empty(rose_framework::$option['footer_code']) )
    	{
    		print rose_framework::$option['footer_code'];
    	}
    }

    add_action('wp_head', 'rose_add_to_head');
    add_action('wp_footer', 'rose_add_to_footer');

    function rose_parse_googlefont($aFont) {
	    $aParseFont = explode("\n", $aFont);
	    $aFontStyles = array('default' => 'Default');

	    foreach ( $aParseFont as $font ) {

	        preg_match('/(?:family=)([^:&\'\"]*)(?:\:?)((?:[^&\'\"]*))/', $font, $match);

	        $fontFamily = str_replace('+', ' ', $match[1]);

	        if ( isset($match[2]) && !empty($match[2]) )
	        {
	            $parseStyle = explode(",", $match[2]);

	            foreach ( $parseStyle as $style )
	            {
	                $fontStyle = preg_replace("/(\d*)/", "", $style);

	                $weight = (int)$style;

	                switch ($weight)
	                {
	                    case 100:
	                        $weightName = "Thin";
	                        break;
	                    case 300:
	                        $weightName = "Light";
	                        break;
	                    case 500:
	                        $weightName = "Medium";
	                        break;
	                    case 900:
	                        $weightName = "Ultra-Bold";
	                        break;
	                    case 700:
	                        $weightName = "Bold";
	                        break;
	                    case 800:
	                        $weightName = "Extra-Bold";
	                        break;
	                    default:
	                        $weightName = "Normal";
	                        break;
	                }

	                $fontkey = $match[1].'||'.$weight.'||'.$fontStyle;

	                $aFontStyles[$fontkey]    = $fontFamily . ' ' . $weightName . ' ' . $weight . ' ' . ucfirst($fontStyle);
	            }

	        }else{
	            $aFontStyles[$match[1]]  = $fontFamily;
	        }

	    }

	    return $aFontStyles;
	}

	function rose_explode_font($font) {
		
		if( !empty($font) ) {
			$font = explode('||', $font);
		}

		return $font;
	}

	require_once get_template_directory() . '/core/init.php';


	/*Filtro per modificare il permalink*/
	// add_action('pre_get_posts', 'rose_parse_request');
	// add_filter('post_type_link', 'pi_rose_permalink_structure', 10, 2);

	function pi_rose_permalink_structure($post_link, $post)
	{

		if ( !empty($post) && $post->post_type == 'portfolio' )
		{
			$portfolioLink = get_option('wiloke_portfolio_permalink');

			if ( $portfolioLink == 'category-portfolio' )
			{
				if ( false !== strpos( $post_link, '/'.$post->post_type.'/' ) )
				{
//					$event_type_term = get_the_terms( $post->ID, 'category-portfolio' );
					$post_link = str_replace( '/' . $post->post_type . '/', '/' , $post_link );
				}
			}

		}

		return $post_link;
	}

	function rose_parse_request( $query )
	{
		$portfolioLink = get_option('wiloke_portfolio_permalink');

		if ( $portfolioLink != 'category-portfolio' )
		{
			return false;
		}

		// Only noop the main query
		if ( ! $query->is_main_query() )
			return;

		// Only noop our very specific rewrite rule match
		if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
			return;
		}

		// 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
		if ( ! empty( $query->query['name'] ) ) {
			$query->set( 'post_type', array( 'portfolio' ) );
		}
	}


	// Custom Rose Link
	function wiloke_rose_portfolio_permalink() {

		add_settings_field(
			'wiloke_portfolio_permalink', // id
			 esc_html__('Custom Project URL', 'rose'), // setting title
			'wiloke_rose_settings_input',  // display callback
			'permalink', // settings page
			'optional'  // settings section
		);

	}
	add_action( 'admin_init', 'wiloke_rose_portfolio_permalink' );

	function wiloke_rose_permalink_save()
	{
		if ( !is_admin() )
			return;

		if ( isset($_POST['wiloke_portfolio_permalink']) && !empty($_POST['wiloke_portfolio_permalink']) )
		{
			$permalink = wiloke_rose_clean($_POST['wiloke_portfolio_permalink']);
			update_option('wiloke_portfolio_permalink', $permalink);
		}
	}
	wiloke_rose_permalink_save();

	function wiloke_rose_clean( $var ) {
		return is_array( $var ) ? array_map( 'wiloke_rose_clean', $var ) : sanitize_text_field( $var );
	}

	function wiloke_rose_settings_input()
	{
		$value = get_option('wiloke_portfolio_permalink');
		$value = $value ? $value : 'portfolio';
		?>
		<p>
			<input id='wiloke_portfolio_permalink_1' name='wiloke_portfolio_permalink' type='radio' value='portfolio' <?php checked($value, 'portfolio'); ?> />
			<code><?php echo esc_url(get_option('siteurl')); ?>/portfolio/%postname%</code>
		</p>
		<p>
			<input id='wiloke_portfolio_permalink_2' name='wiloke_portfolio_permalink' type='radio' value='category-portfolio' <?php checked($value, 'category-portfolio'); ?>/>
			<code><?php echo esc_url(get_option('siteurl')); ?>/category-slug/%postname%</code>
		</p>
		<p>
			<input id='wiloke_portfolio_permalink_3' name='wiloke_portfolio_permalink' type='radio' value='without-posttype' <?php checked($value, 'without-posttype'); ?>/>
			<code><?php echo esc_url(get_option('siteurl')); ?>/%postname%</code>
		</p>
		<?php

	}


	///


/**
 * Remove the slug from published post permalinks.
 */

function custom_rewrite_tag() {
        add_rewrite_tag('%wiloke-portfolio%', '/portfolio/(.+)');
}
// add_action('init', 'custom_rewrite_tag', 10, 0);

function custom_remove_cpt_slug( $post_link, $post, $leavename ) {

    if ( 'portfolio' != $post->post_type || 'publish' != $post->post_status ) {
        return $post_link;
    }

    $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
  	
    return $post_link;
}
// add_filter( 'post_type_link', 'custom_remove_cpt_slug', 10, 3 );

function custom_parse_request_tricksy( $query ) {

	// echo '<pre>';
	// 	var_dump($query);
	// echo '</pre>';
	
    // Only noop the main query
    if ( ! $query->is_main_query() )
        return;

  	
    // Only noop our very specific rewrite rule match
    if ( 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
        return;
    }

    
    // 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
    if ( ! empty( $query->query['name'] ) ) {
        $query->set( 'post_type', array( 'post', 'portfolio', 'page' ) );
    }
}
// add_action( 'pre_get_posts', 'custom_parse_request_tricksy' );


// remove Link from images
add_filter( 'the_content', 'attachment_image_link_remove_filter' );

function attachment_image_link_remove_filter( $content ) {
   $content = preg_replace(array('{<a(.*?)(wp-att|wp-content/uploads)[^>]*><img}','{ wp-image-[0-9]*" /></a>}'),array('<img','" />'),$content);
   return $content;
 }


function create_meta_description() {
	global $post;

    if ( is_singular() ) {
        if(!empty( $post->post_excerpt)) {
			echo "<meta name='description' content='$post->post_excerpt' />";
			} else{ $meta = apply_filters('the_content', $post->post_content);
				$meta = strip_tags($meta);
				$meta = strip_shortcodes($meta );
				$meta = str_replace(array("\n", "\r", "\t"), ' ', $meta);
				$meta = substr(trim($meta), 0, 300);
				echo "<meta name='description' content='$meta' />";
			} 
    }
    /*if ( is_home() ) {
        echo '<meta name="description" content="' . get_bloginfo( "description" ) . '" />' . "\n";
    }*/
    if ( is_category() ) {
        $des_cat = strip_tags(category_description());
        echo '<meta name="description" content="' . $des_cat . '" />' . "\n";
	}
	echo "<meta name='keywords' content='Reiseblog,Reiseberichte,Reisetipps,Reisemagazin,travel blog,Reiseblogger,Reisen,Travel,Reise,Individualreisen,Abenteuerreisen,Reiseplanung,Reiseinfo,Urlaub,Urlaubsplanung,Urlaubsreise,Flashpacking,Flashpacker,Reisetips,Reisebericht,Reiseerlebnis,Reisejournal,' />";
}
add_action( 'wp_head', 'create_meta_description');