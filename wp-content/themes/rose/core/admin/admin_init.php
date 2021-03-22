<?php 

add_action( 'admin_enqueue_scripts', 'rose_enqueue_admin' );

if( !function_exists('rose_enqueue_admin') ) {
	function rose_enqueue_admin() {

		if( !wp_script_is('admin_scripts' , 'enqueued') ) {
	    	wp_register_style('admin_css', PI_ENQUEUE_CORE . 'admin/assets/css/admin_css.css', array(), '1.0', 'all');
	    	wp_register_script('admin_scripts', PI_ENQUEUE_CORE .'admin/assets/js/admin_script.js', array(), '1.0', true);
		 	wp_enqueue_style('admin_css');
		 	wp_enqueue_script('admin_scripts');
	    }

	    if( !wp_script_is('metabox_scripts' , 'enqueued') ) {
	    	wp_register_script('metabox_scripts', PI_ENQUEUE_CORE .'admin/assets/js/metabox_scripts.js', array(), '1.0', true);
		 	wp_enqueue_script('metabox_scripts');
	    }

	    if( !wp_style_is('font-linea' , 'enqueued') ) {
	    	wp_register_style('font-linea', PI_CSS_URI .'lib/font-linea.css', array(), '', 'all');
		 	wp_enqueue_style('font-linea');
	    }
	}
}

require_once PI_FILE_CORE . 'admin/class.metaboxes.php';
require_once PI_FILE_CORE . 'admin/config.metaboxes.php';
require_once PI_FILE_CORE . 'admin/contactform7.php';
require_once PI_FILE_CORE . 'admin/admin_bar.php';