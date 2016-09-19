
//Masonry init
jQuery(function($) {

    var $container;

    function nsc_trigger_masonry() {
        // don't proceed if $grid has not been selected
        if ( !$container ) {
            return;
        }

        $container.show();

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

Masonry.prototype._getItemLayoutPosition = function(item) {
	item.getSize();
	// how many columns does this brick span
	var remainder = item.size.outerWidth % this.columnWidth;
	var mathMethod = remainder && remainder < 1 ? 'round' : 'ceil';
	// round if off by 1 pixel, otherwise use ceil
	var colSpan = Math[mathMethod](item.size.outerWidth / this.columnWidth);
	colSpan = Math.min(colSpan, this.cols);

	var colGroup = this._getColGroup(colSpan);
	// get the minimum Y value from the columns
	//var minimumY = Math.min.apply( Math, colGroup );
	//var shortColIndex = colGroup.indexOf( minimumY );
	var shortColIndex = this.items.indexOf(item) % this.cols;
	var minimumY = colGroup[shortColIndex];

	// position the brick
	var position = {
		x: this.columnWidth * shortColIndex,
		y: minimumY
	};

	// apply setHeight to necessary columns
	var setHeight = minimumY + item.size.outerHeight;
	var setSpan = this.cols + 1 - colGroup.length;
	for (var i = 0; i < setSpan; i++) {
		this.colYs[shortColIndex + i] = setHeight;
	}

	return position;
};