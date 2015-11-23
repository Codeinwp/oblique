<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Oblique
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function oblique_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'ob-grid',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'oblique_jetpack_setup' );
