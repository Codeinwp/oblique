
//Masonry init
jQuery(function($) {

    var $container;

    function nsc_trigger_masonry() {
        // don't proceed if $grid has not been selected
        if ( !$container ) {
            return;
        }
        // init Masonry
        $container.imagesLoaded( function() {
            $container.masonry({
                itemSelector: '.hentry',
                isAnimated: true,
                animationOptions: {
                    duration: 300,
                    easing: 'linear',
                }
            });
        });
    }

    $(window).load(function(){
        $container = $('.grid-layout'); // this is the grid container

        nsc_trigger_masonry();

        // Triggers re-layout on infinite scroll
        $( document.body ).on( 'post-load', function () {

            // I removed the infinite_count code
            var $selector = $('.infinite-wrap');
            var $elements = $selector.find('.hentry');

            /* here is the idea which is to catch the selector whether it contain element or not, if it's move it to the masonry grid. */
            if( $selector.children().length > 0 ) {
                $container.append( $elements ).masonry( 'appended', $elements, true );
                nsc_trigger_masonry();
            }

        });
    });

});