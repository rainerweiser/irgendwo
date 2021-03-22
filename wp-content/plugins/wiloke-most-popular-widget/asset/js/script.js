;(function($){
    "use strict";

    var _pippFuncExist = false;

    if ( !$().imageCover )
    {
        $.fn.imageCover = function() {
            $(this).each(function() {
                var self = $(this),
                    image = self.find('img'),
                    heightWrap = self.outerHeight(),
                    widthImage = image.outerWidth(),
                    heightImage = image.outerHeight();
                if (heightImage < heightWrap) {
                    image.css({
                        'height': '100%',
                        'width': 'auto'
                    });
                }
            });
        } 

        _pippFuncExist = true; 
    }

    if ( !$().piPpNumberOfLine )
    {
        $.fn.piPpNumberOfLine = function(opts){
            $(this).each( function () {
                var $this = $(this),
                    defaults = {
                        numberLine: 0
                    },
                    data = $this.data(),
                    dataTemp = $.extend(defaults, opts),
                    options = $.extend(dataTemp, data);

                if (!options.numberLine)
                    return false;

                $this.bind('customResize', function(event) {
                    event.stopPropagation();
                    reInit();
                }).trigger('customResize');
                $(window).resize( function () {
                    $this.trigger('customResize');
                })
                function reInit() {
                    var fontSize = parseInt($this.css('font-size')),
                        lineHeight = parseInt($this.css('line-height')),
                        overflow = fontSize * (lineHeight / fontSize) * options.numberLine;

                    $this.css({
                        'display': 'block',
                        'max-height': overflow,
                        'overflow': 'hidden'
                    });
                }
            })
        }
    }

    $(document).ready(function(){

        if ( typeof wilokeMostPopularPostsAjaxUrl != 'undefined' )
        {
            $.ajax({
                type: 'POST',
                url: wilokeMostPopularPostsAjaxUrl,
                data: {action: 'wiloke_most_popular_posts_widget', post_id: wilokeMostPopularPostsPostID, _nonce: wilokeMostPopularPostsNonce},
                success: function(res){
                    console.log('did it');
                }
            });
        }

        $('[data-pipp-number-line]').piPpNumberOfLine();
    })

    $(window).load(function(){
        $('.pi-pp-image-cover').imageCover();
    })


})(jQuery)