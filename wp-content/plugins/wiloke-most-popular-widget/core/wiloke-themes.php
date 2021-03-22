<?php
if ( !function_exists('wiloke_list_themes') )
{
	add_action('admin_menu', 'wiloke_list_themes');
	add_action('admin_enqueue_scripts', 'wiloke_most_popoluar_posts_widget_list_themes_styling');
	function wiloke_list_themes()
	{
		add_menu_page('Wiloke', 'Wiloke', 'edit_theme_options', 'wiloke-themes', 'wiloke_theme_showcase', 'dashicons-admin-site');
	}

	function wiloke_theme_showcase()
	{
		include plugin_dir_path(__FILE__) . 'wiloke-theme-item.php';
	}

	function wiloke_most_popoluar_posts_widget_list_themes_styling()
	{
		if ( isset($_GET['page']) && $_GET['page'] == 'wiloke-themes' )
		{
			wp_enqueue_style('wiloke-themes', plugin_dir_url(dirname(__FILE__)) . 'admin-assets/css/style.css');
		}

		wp_enqueue_style('wiloke-product', plugin_dir_url(dirname(__FILE__)) . 'admin-assets/css/wiloke-product.css');
		wp_enqueue_script('wiloke-product', plugin_dir_url(dirname(__FILE__)) . 'admin-assets/js/wiloke-product.js', array('jquery'), null, true);
	}
}