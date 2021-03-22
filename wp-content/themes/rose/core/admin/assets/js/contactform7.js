;(function($){
    $(document).ready(function () {
        $("#wiloke-import-contactform7").on('click', function(event){
            console.log(ajaxurl);
            event.preventDefault();

            var $this = $(this);

            if ( $this.data('is_ajax') == true )
            {
                return false;
            }

            $this.data('is_ajax', true);

            $this.html('Processing...');

            $.ajax({
                type: 'GET',
                data: {action:'rose_contactform7_demo'},
                url: ajaxurl,
                success: function (contactform) {
                    $('#wpcf7-form').html(contactform);
                    $this.data('is_ajax', false);
                    $this.html('Import');
                }
            });

        })
    })
})(jQuery);