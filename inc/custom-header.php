<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package Oblique
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses oblique_header_style()
 * @uses oblique_admin_header_style()
 * @uses oblique_admin_header_image()
 */
function oblique_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'oblique_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/images/header.jpg',
		'default-text-color'     => '000000',
		'width'                  => 1920,
		'height'                 => 850,
		'flex-height'            => true,
		'wp-head-callback'       => 'oblique_header_style',
		'admin-head-callback'    => 'oblique_admin_header_style',
		'admin-preview-callback' => 'oblique_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'oblique_custom_header_setup' );

if ( ! function_exists( 'oblique_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see oblique_custom_header_setup().
 */
function oblique_header_style() {
	if ( get_header_image() ) {	
		?>
		<style type="text/css">
					.site-header {
					    background: url(<?php echo get_header_image(); ?>) no-repeat;
					    background-position: center top;
					    background-attachment: fixed;
					    background-size: cover;
					}
		</style>
		<?php
	}
}
endif; // oblique_header_style

if ( ! function_exists( 'oblique_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see oblique_custom_header_setup().
 */
function oblique_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // oblique_admin_header_style

if ( ! function_exists( 'oblique_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see oblique_custom_header_setup().
 */
function oblique_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // oblique_admin_header_image