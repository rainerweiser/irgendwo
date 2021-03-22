(function ($) {
    "use strict";
    
    /**
     * Metabox dependency
     */
    var $wilokeDependency               = $('.wiloke-has-dependency'),
        $wilokeDependencyOnTemplate     = $('.wiloke-has-dependency-on-template'),
        $wilokeFormDependencyOnTemplate = $('.wiloke-table-has-dependency-on-template');

    if ( $wilokeDependencyOnTemplate.length > 0 )
    {
        $wilokeDependencyOnTemplate.each(function(){
            var $this   = $(this),
                val     = '',
                oData   = $this.attr('data-dependencyontemplate'),
                status  = false,
                $target = $("#page_template");

            oData = wiloke_convert_string_to_object(oData);

            $target.change(function () {
                val = $(this).val();
                switch (oData.operator)
                {
                    case '=':
                        if ( val ==  oData.match)
                        {
                            status = true;
                        }else{
                            status = false;
                        }
                        break;
                    case 'contains':
                        var match = (oData.match).split(',');

                        if ( match.indexOf(val) == -1 )
                        {
                            status = false;
                        }else{
                            status = true;
                        }
                        break;
                    case 'not_contains':
                        var match = (oData.match).split(',');

                        if ( match.indexOf(val) == -1 )
                        {
                            status = true;
                        }else{
                            status = false;
                        }
                        break;
                }

                if ( status )
                {
                    $this.addClass('wiloke-is-hidden-with-template');
                    $this.closest('tr').show();
                }else{
                    $this.removeClass('wiloke-is-hidden-with-template');
                    $this.closest('tr').hide();
                }

            });

        });
    }

    if ( $wilokeDependency.length > 0 )
    {
        $wilokeDependency.each(function(){
            var $this   = $(this),
                oData   = $(this).data('dependency'),
                val     = '',
                status  = true,
                $target = $(this).closest('.cmb_metabox.form-table').find('[name="'+oData.name+'"]');

            oData = wiloke_convert_string_to_object(oData);

            $target.change(function ()
            {
                switch (oData.operator)
                {
                    case '=':
                        val = $(this).val();

                        if ( val ==  oData.match)
                        {
                            status = true;
                        }else{
                            status = false;
                        }
                        break;
                    case 'contains':
                        val = $(this).val();
                        var match = (oData.match).split(',');

                        if ( match.indexOf(val) == -1 )
                        {
                            status = false;
                        }else{
                            status = true;
                        }
                        break;
                    case 'not_contains':
                        val = $(this).val();
                        var match = (oData.match).split(',');

                        if ( match.indexOf(val) == -1 )
                        {
                            status = true;
                        }else{
                            status = false;
                        }
                        break;
                    case 'not_empty':
                        if ( $(this).attr('checked') )
                        {
                            status = true;
                        }else{
                            status = false;
                        }
                        break;
                }

                if ( status )
                {
                    if ( !$this.hasClass('wiloke-is-hidden-with-template') )
                    {
                        $this.closest('tr').show();
                    }
                }else{
                    $this.closest('tr').hide();
                }
            }).trigger('change');

        });
    }

    if ( $wilokeFormDependencyOnTemplate.length > 0 )
    {
        $wilokeFormDependencyOnTemplate.each(function () {
            var $this   = $(this),
                val     = '',
                oData   = $(this).data('dependencyontemplate'),
                status  = false,
                $target = $("#page_template");

            oData = wiloke_convert_string_to_object(oData);

            $target.change(function ()
            {
                val = $(this).val();
                switch (oData.operator)
                {
                    case '=':
                        if ( val ==  oData.match)
                        {
                            status = true;
                        }else{
                            status = false;
                        }
                        break;
                    case 'contains':

                        var match = (oData.match).split(',');

                        if ( match.indexOf(val) == -1 )
                        {
                            status = false;
                        }else{
                            status = true;
                        }
                        break;
                    case 'not_contains':

                        var match = (oData.match).split(',');

                        if ( match.indexOf(val) == -1 )
                        {
                            status = true;
                        }else{
                            status = false;
                        }
                        break;
                }

                if ( status )
                {
                    $this.closest('.postbox').show();
                }else{
                    $this.closest('.postbox').hide();
                }
            }).trigger('change');

        });
    }

    function wiloke_convert_string_to_object(data)
    {
        if ( typeof data  === 'object')
        {
            return data;
        }

        data =  data.replace(/\\/g, '');

        data = $.parseJSON(data);

        return data;
    }

})(jQuery);