(function($) {
    "use strict";

    // CONTACT MAP
    function RoseContactMap() {
        $('.contact-map .map').each(function(index, el) {
            var $this = $(this);
            var location = $this.data().latlng,
                title = $this.attr('data-title'),
                icon = $this.attr('data-icon');

            if(location) {

                var latlng = new google.maps.LatLng(location[0],location[1]);

                var options = {
                    zoom: 16,
                    center: latlng,
                    scrollwheel: false,
                };

                var map = new google.maps.Map($this[0], options);

                google.maps.event.addDomListener(window, 'resize', function() {
                    map.setCenter(latlng);
                });

                if(icon != '') {
                    var marker = new google.maps.Marker({
                        position: latlng,
                        title: title,
                        map: map,
                        zIndex: 1,
                        icon: icon
                    });

                    marker.setMap(map);
                }
            }
        });
    }

    // SKILL BAR
    function skill_bar() {
       
        $('.skill').appear(function (index, el) {
            var $self = $(this),
                defaults = {
                    'percent' :'50',
                    'duration' : '2000'
                },
                options = $.extend(defaults, $self.data()),
                duration = parseInt(options.duration),
                percent = parseInt(options.percent);

                if(isNaN(percent)) {
                    percent = 0;
                } else if(percent > 100) {
                    percent = 100;
                }

                if(isNaN(duration)) {
                    duration = 2000;
                }

                var unit = percent/100;

                $('.processbar-percent', $self)
                    .css({
                        'width' : percent + '%',
                        'webkit-transition-duration' : parseInt(duration) +'ms',
                        '-moz-transition-duration': parseInt(duration) +'ms',
                        '-ms-transition-duration': parseInt(duration) +'ms',
                        'transition-duration': parseInt(duration) +'ms',
                    })
                    .stop().animate({
                       foo : 100
                    }, {
                    duration: duration,
                    step: function( now, fx ){
                        var currentPercent = (now * percent)/ 100;

                        currentPercent = parseInt(currentPercent);

                        $('.percent', $self).html('(' + currentPercent + '%)');
                    }
                });

        })
    }

    $(document).ready(function() {
        RoseContactMap();
        skill_bar();
    });

    
})(jQuery);