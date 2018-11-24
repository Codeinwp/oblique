/* global oblique_disable_fitvids_var */

// Parallax
jQuery(function($) {
	$( '.site-header' ).parallax( '50%', 0.3 );
});

// Toggle sidebar
jQuery(function($) {
	$( '.sidebar-toggle' ).click(function() {
		$( '.widget-area' ).toggleClass( 'widget-area-visible' );
		$( '.sidebar-toggle' ).toggleClass( 'sidebar-toggled' );
		$( '.sidebar-toggle' ).find( 'i' ).toggleClass( 'fa-bars fa-times' );
	});
	$( '.sidebar-toggle-inside' ).click(function() {
		$( '.widget-area' ).toggleClass( 'widget-area-visible' );
	});
});

// Fitvids script
if ( ! oblique_disable_fitvids_var.oblique_disable_fitvids ) {
	jQuery(function($) {
		$( 'body' ).fitVids();
	});
}

// Menu
jQuery(function($) {
	$( '.main-navigation .menu' ).slicknav({
		label: '',
		duration: 500,
		prependTo:'.sidebar-nav',
		closedSymbol: '&#43;',
		openedSymbol: '&#45;',
		allowParentLinks: true
	});
});
