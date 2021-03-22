<ol class="pi-pp-wrapper style4 pi-pp-widget-list">
	<?php 
	foreach ( $aPiPPPosts as $postId ) : 
		$id 	   = isset($postId->post_id) ? $postId->post_id : $postId->ID;
		$permalink = get_permalink($id);
	?>
	<li class="pi-pp-item"><a href="<?php echo esc_url($permalink); ?>"><?php echo get_the_title($id); ?></a></li>
	<?php endforeach; ?>
</ol>