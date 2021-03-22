<?php

if ( !class_exists('piPopularPosts') )
{
	class piPopularPosts extends WP_Widget
	{
		public $piDate;

		public $viewsField 	 	= 'views_of_day';
		public $commentsField 	= 'comments_of_day';
		public $aCalendar 	 	= array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

		public function __construct($aWidgetInfo)
		{
			
			if ( !empty($aWidgetInfo) &&  is_array($aWidgetInfo) )
			{
				parent::__construct($aWidgetInfo['base_id'], $aWidgetInfo['title'], $aWidgetInfo['des']);
			}

			$this->piDate = pi_pp_get_date();
			/*Hit Counter*/
			add_action('wp_ajax_wiloke_most_popular_posts_widget', array($this, 'pi_pp_run_hit_counter'));
			add_action('wp_ajax_nopriv_wiloke_most_popular_posts_widget', array($this, 'pi_pp_run_hit_counter'));

			/*Comments Count*/
			add_action('wp_update_comment_count', array($this, 'pi_pp_update_comment_count_now'), 10, 1);
		}	


		/**
		 * Updating Visits
		 * @author pirates - Wiloke Team
		 * @since 1.0
		 */
		public function pi_pp_run_hit_counter()
		{
			check_ajax_referer('wiloke_most_popular_posts', '_nonce');

			if ( !isset($_POST['post_id']) || empty($_POST['post_id']) )
			{
				wp_die();
			}

			global $wpdb;

			$tblName = pi_pp_table_name($wpdb);
			
			$views   = 0;
			$postID  = (int)$_POST['post_id'];
			
			if ( $this->pi_is_today_exists($wpdb, $tblName, $postID) )
			{
				$views = $this->pi_pp_get_viewed_or_commented($wpdb, $tblName, $postID, $this->viewsField);

				$views = (int)$views + 1;
				
				$this->pi_pp_update_view_or_comment($wpdb, $tblName, $views, $postID, $this->viewsField);
			}else{
				$this->pi_pp_insert_view_or_comment($wpdb, $tblName, $postID, $this->viewsField);
			}

			wp_die();
		}

		/**
		 * Updating Comments
		 * @author pirates - Wiloke Team
		 * @since 1.0
		 */
		public function pi_pp_update_comment_count_now($postID)
		{
			global $wpdb;
			
			$tblName = pi_pp_table_name($wpdb);
			
			$comments   = 0;
		
			if ( $this->pi_is_today_exists($wpdb, $tblName, $postID) )
			{
				$comments = $this->pi_pp_get_viewed_or_commented($wpdb, $tblName, $postID, $this->commentsField);
				$comments = (int)$comments + 1;
				$this->pi_pp_update_view_or_comment($wpdb, $tblName, $comments, $postID, $this->commentsField);
			}else{
				$this->pi_pp_insert_view_or_comment($wpdb, $tblName, $postID, $this->commentsField);
			}
		}

		/**
		 * Do you see today in pi_hit_counter table?
		 * @author pirates - Wiloke Team
		 * @since 1.0
		 */
		public function pi_is_today_exists($wpdb, $tblName, $postID)
		{
			$res = $wpdb->get_var($wpdb->prepare( 
				"SELECT ID from $tblName WHERE post_date=%s AND post_id=%d ORDER BY DESC",
				$this->piDate,
				$postID
			));
			
			if ( empty($res) )
			{
				return FALSE;
			}

			return TRUE;
		}

		/**
		 * Get current viewed
		 * @author pirates - Wiloke Team
		 * @since 1.0
		 */
		public function pi_pp_get_viewed_or_commented($wpdb, $tblName, $postID, $fieldName)
		{
			$res =  $wpdb->get_var(
						$wpdb->prepare( 
							"
								SELECT $fieldName FROM $tblName
								WHERE post_date=%s 
								AND post_id=%d
							",
							$this->piDate,
							$postID
						)
					);

			return $res;
		}

		/**
		 * Update View
		 * @author pirates - Wiloke Team
		 * @since 1.0
		 */
		public function pi_pp_update_view_or_comment($wpdb, $tblName, $value, $postID, $fieldName)
		{
			$wpdb->update(
				$tblName,
				array(
					$fieldName => $value
				),
				array('post_date'=>$this->piDate, 'post_id'=>$postID),
				array(
					'%d'
				),
				array(
					'%s',
					'%s'
				)
			);
		}

		/**
		 * Wow, First view
		 * @author pirates - Wiloke Team
		 * @since 1.0
		 */
		public function pi_pp_insert_view_or_comment($wpdb, $tblName, $postID, $fieldName)
		{
			$wpdb->insert(
				$tblName,
				array(
					'post_id'	   => $postID,
					$fieldName     => 1,
					'post_date'	   => $this->piDate
				),
				array(
					'%d',
					'%d',
					'%s'
				)
			);
		}
	}

	/*Creating Widget*/
	add_action('widgets_init', 'pi_pp_register_popular_widget');

	/**
	 * Front end display
	 * @author pirates - Wiloke
	 * @since 1.0
	 */
	function pi_pp_register_popular_widget()
	{
		include PI_PP_DIR . 'core/class.piWilokePopularWidget.php';

		register_widget('piWilokePopularWidget');
	}
}