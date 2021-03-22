<?php
/** 
 * Creating pi_hit_counter
 * @author pirates - Wiloke Team
 * @since 1.0
 */

function pi_pp_creating_table()
{
	global $wpdb;

	$tblName = pi_pp_table_name($wpdb);

	if ( get_option('pi_hit_counter') && !get_option('wiloke_most_popular_posts_widget_test_query') )
	{
		$sql = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_NAME = '%s' AND COLUMN_NAME = '%s'";

		$isTableExist = $wpdb->query(
			$wpdb->prepare(
				$sql,
				$tblName,
				'post_iddad'
			)
		);

		if (empty($isTableExist))
		{
			$wpdb->query('DROP TABLE '.$tblName);
			delete_option('pi_hit_counter');
		}

		update_option('wiloke_most_popular_posts_widget_test_query', true);
	}


	if ( !get_option('pi_hit_counter') )
	{
		global $wpdb;

		$sql = "CREATE TABLE $tblName(
			ID bigint(20) NOT NULL AUTO_INCREMENT,
			post_id bigint(20) NOT NULL,
			views_of_day bigint(20) NOT NULL,
			comments_of_day bigint(20) NOT NULL,
			post_date DATE NOT NULL,
			PRIMARY KEY (ID) 
		)";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		update_option('pi_hit_counter', 1);
	}
}