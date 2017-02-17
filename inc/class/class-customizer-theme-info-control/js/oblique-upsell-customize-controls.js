( function( api ) {

    // Extends our custom "oblique-theme-info" section.
    api.sectionConstructor['oblique-theme-info'] = api.Section.extend( {

        // No events for this type of section.
        attachEvents: function () {},

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    } );

} )( wp.customize );
