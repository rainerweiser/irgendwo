<?php

if ( !class_exists('piWilokePopularWidget') )
{
	class piWilokePopularWidget extends piPopularPosts
	{
		public $aDef = array('title'=>'Most Popular Posts', 'number_of_posts'=>5, 'order_by'=>'most_commented', 'query_time'=>'this_week', 'show_hit_count'=>1, 'show_order_posts'=>1, 'show_order_post_thumbnails'=>1, 'style'=>'view-1');

		public function __construct()
		{
			parent::__construct( array('base_id'=>'pi_pp_posts', 'title'=>__('Wiloke Popular Posts', 'wiloke'), 'des'=>'') );

			add_action('wp_enqueue_scripts', array($this, 'pi_pp_popular_scripts'));
			add_action('wp_head', array($this, 'wp_head'));
		}

		public function wp_head()
		{
			global $post;
			
			if ( isset($post->post_type) && $post->post_type == 'post' ) :
			?>
			<script type="text/javascript">
			var wilokeMostPopularPostsPostID  = <?php echo esc_js($post->ID) ?>,
				wilokeMostPopularPostsNonce   = "<?php echo wp_create_nonce('wiloke_most_popular_posts'); ?>",
				wilokeMostPopularPostsAjaxUrl = "<?php echo esc_url(admin_url('admin-ajax.php')) ?>";
			</script>
			<?php
			endif;
		}

		public function pi_pp_popular_scripts()
		{
			wp_enqueue_style( 'pi_pp_style', PI_PP_URL . 'asset/css/style.css', array(), '1.0' );
			wp_enqueue_script( 'pi_pp_js', PI_PP_URL . 'asset/js/script.js', array('jquery'), '1.0' );
		}

		public function widget($atts, $aInstance)
		{
			global $wpdb;
			$aInstance = wp_parse_args($aInstance, $this->aDef);

			/*Get the most popular posts of week*/
			$today = date("l");
			$order = array_keys($this->aCalendar, $today);
			
			$order = (int)$order[0];

			$max   = 7 - $order;

			echo $atts['before_widget'];
				$tblName = pi_pp_table_name($wpdb);
				
				if ( $aInstance['query_time'] == 'this_week' )
				{
					$aPiPPPosts = $this->pi_query_in_ranger($wpdb, $tblName, $aInstance['order_by'], $aInstance['number_of_posts'], $order, $max);
				}elseif ( $aInstance['query_time'] == 'this_day' )
				{
					$aPiPPPosts = $this->pi_query_in_day($wpdb, $tblName, $aInstance['order_by'], $aInstance['number_of_posts']);
				}elseif ( $aInstance['query_time'] == 'this_month' )
				{
					$aPiPPPosts = $this->pi_query_in_month($wpdb, $tblName, $aInstance['order_by'], $aInstance['number_of_posts']);
				}else{
					if ( $aInstance['query_time'] == 'last_7_days' )
					{
						$min = 7;
					}elseif( $aInstance['query_time'] == 'last_30_days' )
					{
						$min = 30;
					}else{
						$min = 1;
					}
					$aPiPPPosts = $this->pi_query_in_ranger($wpdb, $tblName, $aInstance['order_by'], $aInstance['number_of_posts'], $min);
				}

				
				if ( !empty($aPiPPPosts) )
				{
					if ( !empty($aInstance['title']) )
					{
						echo $atts['before_title'].$aInstance['title'].$atts['after_title'];
					}
					include PI_PP_DIR . 'views/'.$aInstance['style'] . '.php';
				}



			echo $atts['after_widget'];
		}

		public function update($aNewInstance, $aOldInstance)
		{
			$aInstance = $aOldInstance;

			foreach ( $aNewInstance as $key => $val )
			{
				$aInstance[$key] = strip_tags($val);
			}

			return $aInstance;
		}

		public function form($aInstance)
		{
			$aInstance = wp_parse_args($aInstance, $this->aDef);
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title', 'wiloke'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($aInstance['title']); ?>" class="widefat" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>"><?php _e('Number Of Posts', 'wiloke'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>" type="text" name="<?php echo esc_attr($this->get_field_name('number_of_posts')); ?>" value="<?php echo esc_attr($aInstance['number_of_posts']); ?>" class="widefat" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('order_by')); ?>"><?php _e('Order By', 'wiloke'); ?></label>
				<select id="<?php echo esc_attr($this->get_field_id('order_by')); ?>" name="<?php echo esc_attr($this->get_field_name('order_by')); ?>" class="widefat">
					<option value="most_commented" <?php selected($aInstance['order_by'], 'most_commented'); ?>><?php _e('Most Commented', 'wiloke'); ?></option>
					<option value="most_viewed" <?php selected($aInstance['order_by'], 'most_viewed'); ?>><?php _e('Most Visited', 'wiloke'); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('query_time')); ?>"><?php _e('Show the posts which is the most Visited/Commented in', 'wiloke'); ?></label>
				<select id="<?php echo esc_attr($this->get_field_id('query_time')); ?>" name="<?php echo esc_attr($this->get_field_name('query_time')); ?>" class="widefat">
					<option value="this_week" <?php selected($aInstance['query_time'], 'this_week'); ?>><?php _e('This Week', 'wiloke'); ?></option>
					<option value="this_month" <?php selected($aInstance['query_time'], 'this_month'); ?>><?php _e('This Month', 'wiloke'); ?></option>
					<option value="this_day" <?php selected($aInstance['query_time'], 'this_day'); ?>><?php _e('This Day', 'wiloke'); ?></option>
					<option value="last_7_days" <?php selected($aInstance['query_time'], 'last_7_days'); ?>><?php _e('Last 7 Days', 'wiloke'); ?></option>
					<option value="last_30_days" <?php selected($aInstance['query_time'], 'last_30_days'); ?>><?php _e('Last 30 Days', 'wiloke'); ?></option>
					<option value="last_1_day" <?php selected($aInstance['query_time'], 'last_1_day'); ?>><?php _e('Last 1 Day', 'wiloke'); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('style')); ?>"><?php _e('Style', 'wiloke'); ?></label>
				<select id="<?php echo esc_attr($this->get_field_id('style')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" class="widefat">
					<option value="view-1" <?php selected($aInstance['style'], 'view-1'); ?>><?php _e('Style 1 (First larger + Thumbnail)', 'wiloke'); ?></option>
					<option value="view-2" <?php selected($aInstance['style'], 'view-2'); ?>><?php _e('Style 2 (First larger + Then No Thumbnail )', 'wiloke'); ?></option>
					<option value="view-3" <?php selected($aInstance['style'], 'view-3'); ?>><?php _e('Style 3 (Listing + Thumbnail)', 'wiloke'); ?></option>
					<option value="view-4" <?php selected($aInstance['style'], 'view-4'); ?>><?php _e('Style 4 (Unordered List + No Thumbnail)', 'wiloke'); ?></option>
					<option value="view-5" <?php selected($aInstance['style'], 'view-5'); ?>><?php _e('Style 5 (Ordered List + No Thumbnail)', 'wiloke'); ?></option>
				</select>
			</p>
			<?php
		}

		public function pi_query_in_ranger($wpdb, $tblName, $target, $numberOfPosts=5, $min="", $max="")
		{
			$target = $target ==  'most_viewed' ? $this->viewsField : $this->commentsField;
			
			$postTbl = $wpdb->prefix . 'posts';

			if ( !empty($max)  )
			{
				$sql = "SELECT pi_pp_tbl.post_id, SUM(pi_pp_tbl.$target) AS pi_pp_most_of_week FROM $tblName AS pi_pp_tbl LEFT JOIN $postTbl AS pi_posts_tbl ON pi_pp_tbl.post_id = pi_posts_tbl.ID WHERE pi_pp_tbl.post_date BETWEEN CURDATE() - INTERVAL $min DAY AND CURDATE() + INTERVAL $max DAY AND pi_posts_tbl.post_type = 'post' GROUP BY pi_pp_tbl.post_id ORDER BY pi_pp_most_of_week DESC LIMIT $numberOfPosts";
			}else if( !empty($min) ){
				$sql = "SELECT pi_pp_tbl.post_id, SUM(pi_pp_tbl.$target) AS pi_pp_most_of_week FROM $tblName AS pi_pp_tbl LEFT JOIN $postTbl AS pi_posts_tbl ON pi_pp_tbl.post_id = pi_posts_tbl.ID WHERE pi_pp_tbl.post_date > CURDATE() - INTERVAL $min DAY AND pi_posts_tbl.post_type = 'post'  GROUP BY pi_pp_tbl.post_id ORDER BY pi_pp_most_of_week DESC LIMIT $numberOfPosts";
			}

			$oRes = $wpdb->get_results($sql);
			
			return $oRes;
		}

		public function pi_query_in_month($wpdb, $tblName, $target, $numberOfPosts=5)
		{
			$date = date("Y-m");

			$target = $target == 'most_viewed' ? $this->viewsField : $this->commentsField;

			$postTbl = $wpdb->prefix . 'posts';
			$sql 	 = "SELECT pi_pp_tbl.post_id, SUM(pi_pp_tbl.$target) AS pi_pp_views_of_month FROM $tblName AS pi_pp_tbl LEFT JOIN $postTbl AS pi_posts_tbl ON pi_pp_tbl.post_id = pi_posts_tbl.ID  WHERE DATE_FORMAT(pi_pp_tbl.post_date,'%Y-%m') = '$date' AND pi_posts_tbl.post_type = 'post' GROUP BY pi_pp_tbl.post_id ORDER BY pi_pp_views_of_month DESC LIMIT $numberOfPosts";
			
			$oRes 	 = $wpdb->get_results($sql);

			return $oRes;
			
		}

		public function pi_query_in_day($wpdb, $tblName, $target, $numberOfPosts=5)
		{
			$target = $target == 'most_viewed' ? $this->viewsField : $this->commentsField;
			$postTbl = $wpdb->posts;

			$sql 	 = "SELECT pi_pp_tbl.post_id FROM $tblName AS pi_pp_tbl LEFT JOIN $postTbl AS pi_posts_tbl ON pi_pp_tbl.post_id = pi_posts_tbl.ID WHERE pi_pp_tbl.post_date = '{$this->piDate}' AND pi_posts_tbl.post_type = 'post' ORDER BY pi_pp_tbl.$target DESC LIMIT $numberOfPosts";
			
			$oRes 	 = $wpdb->get_results($sql);

			return $oRes;
		}
		
	}
}