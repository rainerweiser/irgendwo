<?php

require_once(PI_FILE_CORE .'/TGM_Activation_Plugin/class-tgm-plugin-activation.php');

if (!function_exists('rose_tgm_activation')) {

    function rose_tgm_activation() {
        
      $dir = get_template_directory();
      $plugins = array(
        array(
            'name'      => 'WPBakery Visual Composer',
            'slug'      => 'js_composer',
            'source'    =>  $dir . '/core/plugins/js_composer.zip',
            'required'  => true,
            'force_activation'  => false
        ),

        array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'  => true,
            'force_activation'  => true
        ),

        array(
            'name'              => 'Wiloke Widgets',
            'slug'              => 'wiloke-widgets',
            'source'            =>  $dir . '/core/plugins/wiloke-widgets.zip',
            'required'          => true,
            'force_activation'  => false
        ),

        array(
            'name'      => 'Wiloke Post Format UI',
            'slug'      => 'wiloke-post-format-ui',
            'source'    =>  $dir . '/core/plugins/wiloke-post-format-ui.zip',
            'required'  => true,
            'force_activation'  => false
        ),

        array(
            'name'      => 'Rose Portfolio',
            'slug'      => 'rose-portfolio',
            'source'    =>  $dir . '/core/plugins/rose-portfolio.zip',
            'required'  => true,
            'force_activation'  => false
        ),

        array(
            'name'      => 'Rose Team',
            'slug'      => 'rose-team',
            'source'    =>  $dir . '/core/plugins/rose-team.zip',
            'required'  => true,
            'force_activation'  => false
        ),

        array(
            'name'      => 'Rose Pricing Table',
            'slug'      => 'rose-pricing',
            'source'    =>  $dir . '/core/plugins/rose-pricing.zip',
            'required'  => true,
            'force_activation'  => false
        ),

        array(
            'name'      => 'Rose Testimonial',
            'slug'      => 'rose-testimonial',
            'source'    =>  $dir . '/core/plugins/rose-testimonial.zip',
            'required'  => true,
            'force_activation'  => false
        ),

        array(
            'name'      => 'Rose Shortcodes',
            'slug'      => 'rose-shortcode',
            'source'    =>  $dir . '/core/plugins/rose-shortcode.zip',
            'required'  => true,
            'force_activation'  => false
        ),
        array(
            'name'      => 'Envato Market Master',
            'slug'      => 'wp-envato-market-master',
            'source'    =>  $dir . '/core/plugins/wp-envato-market-master.zip',
            'required'  => false
        ),

        // array(
        //     'name'      => 'Wiloke Automatically Update Plugin',
        //     'slug'      => 'wiloke-update',
        //     'source'    =>  $dir . '/core/plugins/wiloke-update.zip',
        //     'required'  => false
        // ),

        array(  
            'name'      => 'Wiloke Most Popular Posts Widget',
            'slug'      => 'wiloke-most-popular-posts-widget',
            'source'    =>  $dir . '/core/plugins/wiloke-most-popular-posts-widget.zip',
            'required'  => false
        ),

        array(  
            'name'      => 'Wiloke Rose Importdemo',
            'slug'      => 'wiloke-rose-importdemo',
            'source'    =>  $dir . '/core/plugins/wiloke-rose-importdemo.zip',
            'required'  => false
        ),

        array(
            'name'      => 'Revolution Slider',
            'slug'      => 'revslider',
            'source'    =>  $dir . '/core/plugins/revslider.zip',
            'required'  => false
        ),

        array(
            'name'      => 'Wiloke Sharing Post',
            'slug'      => 'wiloke-sharing-post',
            'source'    =>  $dir . '/core/plugins/wiloke-sharing-post.zip',
            'required'  => false
        ),

        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false
        ),

        array(
            'name'      => 'Wiloke Gallery',
            'slug'      => 'wiloke-gallery',
            'required'  => false
        )
      );

      $config = array(
            'default_path' => '',
            'menu' => 'tgmpa-install-plugins',
            'has_notices' => true,
            'dismissable' => false,
            'dismiss_msg' => false,
            'is_automatic' => true,
            'message' => '',
            'strings' => array(
                'page_title' => esc_html__( 'Install Required Plugins', 'rose' ),
                'menu_title' => esc_html__( 'Install Plugins', 'rose' ),
                'installing' => esc_html__( 'Installing Plugin: %s', 'rose' ),
                'oops' => esc_html__( 'Something went wrong with the plugin API.', 'rose' ),
                'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'rose'), // %1$s = plugin name(s).
                'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'rose'), // %1$s = plugin name(s).
                'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'rose'), // %1$s = plugin name(s).
                'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'rose'), // %1$s = plugin name(s).
                'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'rose'), // %1$s = plugin name(s).
                'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'rose'), // %1$s = plugin name(s).
                'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'rose'), // %1$s = plugin name(s).
                'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'rose'), // %1$s = plugin name(s).
                'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'rose'),
                'activate_link' => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'rose'),
                'return' => esc_html__( 'Return to Required Plugins Installer', 'rose' ),
                'plugin_activated' => esc_html__( 'Plugin activated successfully.', 'rose' ),
                'complete' => esc_html__( 'All plugins installed and activated successfully. %s', 'rose' ), // %s = dashboard link.
                'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );

        tgmpa( $plugins, $config );

    }

  add_action( 'tgmpa_register', 'rose_tgm_activation' );

}
