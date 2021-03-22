<div class="pi-pp-wrapper style3 pi-pp-widget-list">
	<?php 
	foreach ( $aPiPPPosts as $postId ) : 
		$id 	   = isset($postId->post_id) ? $postId->post_id : $postId->ID;
		$permalink = get_permalink($id);
	?>
	<div class="pi-pp-item">
		<?php if ( has_post_thumbnail($id)  ) : ?>
	    <div class="pi-pp-item-image">
	        <div class="pi-pp-image-cover">
	            <a href="<?php echo esc_url($permalink); ?>">
	                <?php echo get_the_post_thumbnail($id, 'pi_pp_100_100'); ?>
	            </a>
	        </div>
	    </div>
	    <?php endif; ?>
	    <div class="pi-pp-item-content">
	        <h3 class="pi-pp-item-title" data-pipp-number-line="2">
	            <a href="<?php echo esc_url($permalink); ?>"><?php echo get_the_title($id); ?></a>
	        </h3>
	        <span class="pi-pp-item-meta"><?php echo get_the_date( get_option('date_format'), $id); ?></span>
	    </div>
	</div>
	<?php endforeach; ?>
</div>