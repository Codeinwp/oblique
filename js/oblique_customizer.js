/*
Upsells
*/

jQuery(document).ready(function() {

	/* Upsells in customizer (Documentation link and Upgrade to PRO link */


	if( !jQuery( ".oblique-upsells" ).length ) {
		jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section oblique-upsells" style="padding-bottom: 15px">');
		}

    if( jQuery( ".oblique-upsells" ).length ) {

  		jQuery('.oblique-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="http://flyfreemedia.com/documentation/oblique/" class="button" target="_blank">{documentation}</a>'.replace('{documentation}', obliqueCustomizerObject.documentation));
  		jQuery('.oblique-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="https://github.com/Codeinwp/oblique" class="button" target="_blank">{github}</a>'.replace('{github}', obliqueCustomizerObject.github));
  		jQuery('.oblique-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="https://wordpress.org/support/view/theme-reviews/oblique#postform" class="button" target="_blank">{review}</a>'.replace('{review}', obliqueCustomizerObject.review));

  	}

	if ( !jQuery( ".oblique-upsells" ).length ) {
		jQuery('#customize-theme-controls > ul').prepend('</li>');
	}
});
