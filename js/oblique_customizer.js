/*
Upsells
*/

jQuery(document).ready(function() {

	/* Upsells in customizer (Documentation link and Upgrade to PRO link */


	if( !jQuery( ".oblique-upsells" ).length ) {
		jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section oblique-upsells" style="padding-bottom: 15px">');
		}

    if( jQuery( ".oblique-upsells" ).length ) {

  		jQuery('.oblique-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="http://docs.themeisle.com/article/271-oblique-documentation" class="button" target="_blank">{documentation}</a>'.replace('{documentation}', obliqueCustomizerObject.documentation));

  	}

	if ( !jQuery( ".oblique-upsells" ).length ) {
		jQuery('#customize-theme-controls > ul').prepend('</li>');
	}
	
	jQuery('.preview-notice').append('<a class="oblique-upgrade-to-pro-button" href="http://themeisle.com/themes/oblique-pro/" class="button" target="_blank">{pro}</a>'.replace('{pro}',obliqueCustomizerObject.pro));
});
