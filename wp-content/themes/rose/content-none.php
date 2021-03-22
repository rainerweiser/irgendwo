<div class="content-none">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'rose' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

		<p><?php echo esc_html__( 'Für deinen Suchbegriff konnten wir leider keine Ergebnisse finden.', 'rose' ); ?></p>

		<form action="<?php echo esc_url( home_url( '/' ) ); ?>"  method="get" class="form-search">
		    <input type="search" name="s" class="input-text" value="<?php echo esc_attr(the_search_query()); ?>" placeholder="<?php echo esc_attr_e('Search...', 'rose') ?>">
		    <button class="submit"><i class="fa fa-search"></i></button>
		</form>

	<?php else : ?>

		<p><?php echo esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'rose' ); ?></p>
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>"  method="get" class="form-search">
		    <input type="search" name="s" class="input-text" value="<?php echo esc_attr(the_search_query()); ?>" placeholder="<?php echo esc_attr_e('Search...', 'rose') ?>">
		    <button class="submit"><i class="fa fa-search"></i></button>
		</form>

	<?php endif; ?>
</div>