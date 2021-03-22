(function ($) {
    "use strict";
    
    function heading_page() {
        if($('#heading_custom').length) {

            var value = $('#heading_custom').val();

            if(value == 'visible') {
                $('#heading_setting').show(0);
            }

            $('#heading_custom').on('change', function(event) {
                event.preventDefault();

                var this_value = $(this).val();

                if(this_value == 'hidden') {
                    $('#heading_setting').hide();
                } else {
                    $('#heading_setting').show(0);
                }
            });
        }
    }

    heading_page();

    $(document).ready(function(){
        $('.wiloke-dismissible .notice-dismiss').on('click', function(event){
            event.preventDefault();
            var $dismish = $(this).closest('.wiloke-dismissible'),
                _version = $dismish.data('version');
            $.ajax({
                type: 'post',
                url: ajaxurl,
                data: {action: 'wiloke_notice', version: _version},
                success: function(res)
                {
                    $dismish.remove();
                }
            })
        })
    })

})(jQuery);