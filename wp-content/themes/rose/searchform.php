<form class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<input type="search" class="search-field" name="s" id="search" value="<?php echo esc_attr(the_search_query()); ?>"  placeholder="<?php esc_html_e('Suchbegriff eingeben ...', 'rose'); ?>"/>
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>