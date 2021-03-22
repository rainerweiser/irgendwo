<?php 

if(!class_exists('rose_admin_bar')) {
	class rose_admin_bar {
		public function __construct()
	    {
	        add_action( 'admin_bar_menu', array($this, 'add_menu_to_admin_bar'), 100 );
	    }

	    public function add_menu_to_admin_bar()
	    {
	        global $wp_admin_bar, $wiloke;

	        do_action('wiloke_action_before_add_menu_to_admin_bar', $wp_admin_bar);

	        $wp_admin_bar->add_menu(
	        	array(
			        'id'    => 'wiloke-rose-online-documment',
			        'title' => esc_html__('Online Documentation', 'rose'),
			        'href'  => 'http://wiloke.net/documentation/Rose/',
			        'meta'  => array(
	                    'target' => '_blank'
	                )
			    )
	        );

	        $wp_admin_bar->add_menu(
	            array(
	                'id'    => 'wiloke-support-forum-url',
	                'title' => esc_html__('Theme Support', 'rose'),
	                'href'  => 'http://support.wiloke.com/',
	                'meta'  => array(
	                    'target' => '_blank'
	                )
	            )
	        );

	        $wp_admin_bar->add_menu(
	            array(
			        'id'    => 'wiloke-rose-options',
			        'title' => esc_html__('Rose Options', 'rose'),
			        'href'  => admin_url('themes.php?page=rose_option'),
			        'meta'  => ''
			    )
	        );

	        do_action('wiloke_action_after_add_menu_to_admin_bar', $wp_admin_bar);
	    }
	}

	new rose_admin_bar();
}