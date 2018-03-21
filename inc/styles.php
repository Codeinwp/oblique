<?php
/**
 * Oblique style functions.
 *
 * @package Oblique
 */

/**
 * Converts hex colors to rgba for the menu background color
 *
 * @param string $color Color input in hex or rgba format.
 * @param bool   $opacity Check if input have opacity.
 *
 * @return string
 */
function oblique_hex2rgba( $color, $opacity = false ) {

	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}
		$hex     = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		$rgb     = array_map( 'hexdec', $hex );
		$opacity = 0.4;
		$output  = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';

		return $output;
}

/**
 * Dynamic styles
 *
 * @param string $custom Custom style.
 */
function oblique_custom_styles( $custom ) {

	$custom = '';

	// Fonts
	$body_fonts     = get_theme_mod( 'body_font_family' );
	$headings_fonts = get_theme_mod( 'headings_font_family' );
	if ( ! empty( $body_fonts ) ) {
		$custom .= 'body { font-family:' . $body_fonts . ';}' . "\n";
	}
	if ( ! empty( $headings_fonts ) ) {
		$custom .= 'h1, h2, h3, h4, h5, h6 { font-family:' . $headings_fonts . ';}' . "\n";
	}
	// Site title
	$site_title_size = get_theme_mod( 'site_title_size', '82' );
	if ( ! empty( $site_title_size ) ) {
		$custom .= '.site-title { font-size:' . intval( $site_title_size ) . 'px; }' . "\n";
	}
	// Site description
	$site_desc_size = get_theme_mod( 'site_desc_size', '18' );
	if ( ! empty( $site_desc_size ) ) {
		$custom .= '.site-description { font-size:' . intval( $site_desc_size ) . 'px; }' . "\n";
	}
	// Menu
	$menu_size = get_theme_mod( 'menu_size', '16' );
	if ( ! empty( $menu_size ) ) {
		$custom .= '.main-navigation li { font-size:' . intval( $menu_size ) . 'px; }' . "\n";
	}
	// H1 size
	$h1_size = get_theme_mod( 'h1_size' );
	if ( ! empty( $h1_size ) ) {
		$custom .= 'h1 { font-size:' . intval( $h1_size ) . 'px; }' . "\n";
	}
	// H2 size
	$h2_size = get_theme_mod( 'h2_size' );
	if ( ! empty( $h2_size ) ) {
		$custom .= 'h2 { font-size:' . intval( $h2_size ) . 'px; }' . "\n";
	}
	// H3 size
	$h3_size = get_theme_mod( 'h3_size' );
	if ( ! empty( $h3_size ) ) {
		$custom .= 'h3 { font-size:' . intval( $h3_size ) . 'px; }' . "\n";
	}
	// H4 size
	$h4_size = get_theme_mod( 'h4_size' );
	if ( ! empty( $h4_size ) ) {
		$custom .= 'h4 { font-size:' . intval( $h4_size ) . 'px; }' . "\n";
	}
	// H5 size
	$h5_size = get_theme_mod( 'h5_size' );
	if ( ! empty( $h5_size ) ) {
		$custom .= 'h5 { font-size:' . intval( $h5_size ) . 'px; }' . "\n";
	}
	// H6 size
	$h6_size = get_theme_mod( 'h6_size' );
	if ( ! empty( $h6_size ) ) {
		$custom .= 'h6 { font-size:' . intval( $h6_size ) . 'px; }' . "\n";
	}
	// Body size
	$body_size = get_theme_mod( 'body_size' );
	if ( ! empty( $body_size ) ) {
		$custom .= 'body { font-size:' . intval( $body_size ) . 'px; }' . "\n";
	}

	// Header padding
	$branding_padding = get_theme_mod( 'branding_padding', '150' );
	if ( ! empty( $branding_padding ) ) {
		$custom .= '.site-branding { padding:' . intval( $branding_padding ) . 'px 0; }' . "\n";
	}

	// Header padding 1024
	$branding_padding_1024 = get_theme_mod( 'branding_padding_1024', '100' );
	if ( ! empty( $branding_padding_1024 ) ) {
		$custom .= '@media only screen and (max-width: 1024px) { .site-branding { padding:' . intval( $branding_padding_1024 ) . 'px 0; } }' . "\n";
	}

	// Logo size
	$logo_size = get_theme_mod( 'logo_size', '200' );
	if ( ! empty( $logo_size ) ) {
		$custom .= '.site-logo, .woocommerce .site-logo, .woocommerce-page .site-logo { max-width:' . intval( $logo_size ) . 'px; }' . "\n";
	}

	// Primary color
	$primary_color = get_theme_mod( 'primary_color', apply_filters( 'oblique_primary_color', '#23B6B6' ) );
	if ( ! empty( $primary_color ) && ( $primary_color != '#23B6B6' ) ) {
		$custom .= '.entry-meta a:hover, .entry-title a:hover, .widget-area a:hover, .social-navigation li a:hover, a { color:' . esc_attr( $primary_color ) . '}' . "\n";
		$custom .= '.read-more, .nav-previous:hover, .nav-next:hover, button, .button, input[type="button"], input[type="reset"], input[type="submit"] { background-color:' . esc_attr( $primary_color ) . '}' . "\n";
		$rgba    = oblique_hex2rgba( $primary_color, 0.3 );
		$custom .= '.entry-thumb:after { background-color:' . esc_attr( $rgba ) . ';}' . "\n";
		$custom .= '.woocommerce ul.products li.product .button { background-color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce ul.products li.product h2.woocommerce-loop-product__title:hover { color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce ul.products li.product-category h2.woocommerce-loop-category__title:hover { color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce ul.products li.product-category h2.woocommerce-loop-category__title:hover .count { color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce div.product form.cart button.button { background-color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce #reviews #comments ol.commentlist li div.star-rating { color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce #review_form #respond .form-submit input[type="submit"] { background-color: ' . esc_attr( esc_attr( $primary_color ) ) . ';}' . "\n";
		$custom .= '.woocommerce div.product .woocommerce-tabs ul.tabs li.active { color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.single-product h2.related_products_title { color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-cart header.entry-header h1.entry-title { color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-cart input.button { background-color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-cart div.wc-proceed-to-checkout a.button { background-color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-message { border-top-color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-message::before { color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-cart .return-to-shop a.button { background-color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-message .button { background-color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.single-product .woocommerce-message .button { background-color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-info { border-top-color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-info:before { color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-checkout div.place-order input.button { background-color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-checkout header.entry-header h1.entry-title { color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-account header.entry-header h1.entry-title { color: ' . esc_attr( $primary_color ) . ';}' . "\n";
		$custom .= '.woocommerce-page form.woocommerce-form-login input[type="submit"] { background-color: ' . esc_attr( $primary_color ) . ';}' . "\n";
	}
	// SVGs
	$background_color = get_background_color();
	if ( ! empty( $background_color ) ) {
		$custom .= '.svg-block { fill:#' . esc_attr( $background_color ) . ';}' . "\n";
	}

	// Footer background
	$footer_background = get_theme_mod( 'footer_background', apply_filters( 'oblique_footer_background_color', '#17191B' ) );
	if ( ! empty( $footer_background ) ) {
		$custom .= '.footer-svg.svg-block { fill:' . esc_attr( $footer_background ) . ';}' . "\n";
		$custom .= '.site-footer { background-color:' . esc_attr( $footer_background ) . ';}' . "\n";
	}

	// Body
	$body_text = get_theme_mod( 'body_text_color', apply_filters( 'oblique_body_text_color', '#50545C' ) );
	if ( ! empty( $body_text ) ) {
		$custom .= 'body { color:' . esc_attr( $body_text ) . '}' . "\n";
	}

	// Site title
	$site_title = get_theme_mod( 'site_title_color', apply_filters( 'oblique_site_title_color', '#f9f9f9' ) );
	if ( ! empty( $site_title ) ) {
		$custom .= '.site-title a, .site-title a:hover { color:' . esc_attr( $site_title ) . '}' . "\n";
	}

	// Site desc
	$site_desc = get_theme_mod( 'site_desc_color', apply_filters( 'oblique_site_desc_color', '#dddddd' ) );
	if ( ! empty( $site_desc ) ) {
		$custom .= '.site-description { color:' . esc_attr( $site_desc ) . '}' . "\n";
	}

	// Entry titles
	$entry_titles = get_theme_mod( 'entry_titles', apply_filters( 'oblique_entry_titles_color', '#000' ) );
	if ( ! empty( $entry_titles ) ) {
		$custom .= '.entry-title, .entry-title a { color:' . esc_attr( $entry_titles ) . '}' . "\n";
	}

	// Entry meta
	$entry_meta = get_theme_mod( 'entry_meta', apply_filters( 'oblique_entry_meta_color', '#9d9d9d' ) );
	if ( ! empty( $entry_meta ) ) {
		$custom .= '.entry-meta, .entry-meta a, .entry-footer, .entry-footer a { color:' . esc_attr( $entry_meta ) . '}' . "\n";
	}

	// Sidebar
	$sidebar_bg = get_theme_mod( 'sidebar_bg', '#17191B' );
	if ( ! empty( $sidebar_bg ) ) {
		$custom .= '.widget-area { background-color:' . esc_attr( $sidebar_bg ) . '}' . "\n";
	}

	$sidebar_color = get_theme_mod( 'sidebar_color', '#f9f9f9' );
	if ( ! empty( $sidebar_color ) ) {
		$custom .= '.widget-area, .widget-area a { color:' . esc_attr( $sidebar_color ) . '}' . "\n";
	}

	// Social
	$social_color = get_theme_mod( 'social_color', apply_filters( 'oblique_social_color', '#ffffff' ) );
	if ( ! empty( $social_color ) ) {
		$custom .= '.social-navigation li a { color:' . esc_attr( $social_color ) . '}' . "\n";
	}

	// Menu icon/Leave a review
	$menu_icon_color = get_theme_mod( 'menu_icon_color', apply_filters( 'oblique_menu_icon_color', '#ffffff' ) );
	if ( ! empty( $menu_icon_color ) ) {
		$custom .= '.sidebar-toggle, .comment-form, .comment-respond .comment-reply-title { color:' . esc_attr( $menu_icon_color ) . '}' . "\n";
	}

	// Output all the styles
	wp_add_inline_style( 'oblique-style', $custom );
}
add_action( 'wp_enqueue_scripts', 'oblique_custom_styles' );
