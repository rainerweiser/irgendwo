<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<meta name="author" content="Rainer Weiser, Sandra Weiser">

		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
			rose_framework::rose_render_favicon(); 
		} ?>

		<?php wp_head(); ?>
		
	</head>
<body <?php body_class(); ?>>

	<?php // rose_framework::rose_loader(); RWE ?>

	<div id="page-wrap">
	
		<!-- HEADER -->
		<header id="header" class="mb-40">
			<div class="container">
				
				<?php if( class_exists('rose_framework') ) {
					rose_framework::rose_render_logo();
				} ?>

				<nav class="nav-menu">
					
					<?php if( class_exists('rose_framework') ) {
						rose_framework::rose_icon_social();
						rose_framework::rose_icon_search();
					} ?>
					
					<span class="toggle-menu"><i class="fa fa-bars"></i></span>
					
					<?php
						if ( is_page_template('template/portfolio.php') )
						{
							$setting = get_post_meta($post->ID, 'settings', true );
							if ( isset($setting['menu_specify']) && $setting['menu_specify'] != -1 )
							{
								$menuID = $setting['menu_specify'];
							}
						}

						if( !isset($menuID) && has_nav_menu('main-menu') )
						{
							wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'menu', 'menu_id' => 'rose-menu', 'container'=> '') ); 
						}else{
							if ( isset($menuID) && !empty($menuID) )
							{
								wp_nav_menu( array( 'menu' => $menuID, 'menu_class' => 'menu', 'menu_id' => 'rose-menu', 'container'=> '') );
							}
						}
					?>

				</nav>

			</div>
		</header>
		<!-- END / HEADER -->

		<!-- SEARCH FORM -->

		<?php if( class_exists('rose_framework') ) { 
			rose_framework::rose_popup_search_form(); 
			rose_framework::rose_popup_social(); 
		} ?>
		<!-- END / SEARCH FORM -->