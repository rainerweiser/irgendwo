<?php
/*
Plugin Name: Wiloke Most Popular Posts Widget
Plugin URI: http://wiloke.com
Author: Wiloke
Author URI: https://wiloke.com/product/wiloke-most-popular-posts-widget/
Version: 1.0.3
Description: This plugin allows you to create list of popular posts on your sidebar.
*/

define ( 'PI_PP_DIR', plugin_dir_path(__FILE__) );
define ( 'PI_PP_URL', plugin_dir_url(__FILE__) );

include plugin_dir_path(__FILE__) . 'core/wiloke-themes.php';



add_action( 'init', 'pi_pp_image_size' );
function pi_pp_image_size() {
    add_image_size( 'pi_pp_425_255', 425, 255, true ); //mobile
    add_image_size( 'pi_pp_100_100', 100, 100, true ); //mobile
}

function pi_pp_table_name($wpdb)
{
	return $wpdb->prefix . 'pi_hit_counter';
}

function pi_pp_get_date()
{
	return date('Y-m-d');
}

require_once PI_PP_DIR . 'core/func.creatingtbl.php';
register_activation_hook(__FILE__, 'pi_pp_creating_table');

require_once PI_PP_DIR . 'core/class.piPopularPosts.php';