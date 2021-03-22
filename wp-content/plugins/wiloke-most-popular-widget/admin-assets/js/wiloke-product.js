;(function($){
	$(document).ready(function(){
		var $cta = $('#toplevel_page_wiloke-themes .wp-menu-name');
		if ( !$cta.find('.wiloke-dashboard-cta').length )
		{
			$cta.append('<div class="wiloke-dashboard-cta"></div>');
		}
	})
})(jQuery)