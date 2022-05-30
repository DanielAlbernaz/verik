(function($) {
    $(function() {
        var jcarousel = $('.jcarousel');

        jcarousel
                
            .on('jcarousel:reload jcarousel:create', function () {
                var carousel = $(this),
                    width = carousel.innerWidth();

                if (width >= 600) {
                    width = width;
                } else if (width >= 350) {
                    width = width;
                }

                carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
            })
            
            .jcarousel({
                wrap: 'circular',
                transitions: true,
                center: true
            })
            
            .jcarouselAutoscroll({
                interval: 10000,
                target: '+=1',
                autostart: true
            })
        ;

        $('.jcarousel-control-prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .jcarouselControl({
                target: '+=1'
            });

        $('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .on('click', function(e) {
                e.preventDefault();
            })

    });
})(jQuery);
