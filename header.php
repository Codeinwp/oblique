<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Oblique
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) : ?>
	<?php if ( get_theme_mod( 'site_favicon' ) ) : ?>
		<link rel="shortcut icon" href="<?php echo esc_url( get_theme_mod( 'site_favicon' ) ); ?>" />
	<?php endif; ?>
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'oblique' ); ?></a>

	<?php $menu_text = get_theme_mod( 'menu_text' ); ?>
	<div class="sidebar-toggle">
	<?php if ( ! $menu_text || is_customize_preview() ) : ?>
		<i class="fa fa-bars<?php echo $menu_text && is_customize_preview() ? ' oblique-only-customizer' : ''; ?>"></i>
	<?php endif; ?>
	<?php if ( $menu_text || is_customize_preview() ) : ?>
		<?php echo '<span class="' . ( ! $menu_text && is_customize_preview() ? ' oblique-only-customizer' : '' ) . '">' . esc_html( $menu_text ) . '<span>'; ?>
		<?php endif; ?>
	</div>

	<div class="top-bar container">
		<?php if ( has_nav_menu( 'social' ) ) : ?>
			<nav class="social-navigation clearfix">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
						'menu_class'     => 'menu clearfix',
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		<?php endif; ?>
		<?php do_action( 'oblique_nav_search' ); ?>
		<?php if ( ! get_theme_mod( 'search_toggle' ) || is_customize_preview() ) : ?>
			<div class="header-search<?php echo get_theme_mod( 'search_toggle' ) && is_customize_preview() ? ' oblique-only-customizer' : ''; ?>">
				<?php get_search_form(); ?>
			</div>
		<?php endif; ?>
	</div>

	<?php do_action( 'oblique_nav_container' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="overlay"></div>
		<div class="container">
			<div class="site-branding">
				<?php
				$oblique_custom_logo_id = get_theme_mod( 'custom_logo' );
				if ( ! empty( $oblique_custom_logo_id ) ) {
					$oblique_custom_logo = wp_get_attachment_image_src( $oblique_custom_logo_id, 'full' );
				}
				/* Show only logo */
				if ( ! empty( $oblique_custom_logo ) && ! empty( $oblique_custom_logo[0] ) && get_theme_mod( 'logo_style', 'hide-title' ) == 'hide-title' ) :
				?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><img class="site-logo" src="<?php echo esc_url( $oblique_custom_logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a>
				<?php elseif ( get_theme_mod( 'logo_style', 'hide-title' ) == 'show-title' ) : ?>
					<?php if ( ! empty( $oblique_custom_logo ) && ! empty( $oblique_custom_logo[0] ) ) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><img class="site-logo show-title" src="<?php echo esc_url( $oblique_custom_logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a>
					<?php } ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php else : /* Show only site title and description */ ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php endif; ?>
			</div><!-- .site-branding -->
		</div>
		<div class="svg-container header-svg svg-block">
			<?php oblique_svg_1(); ?>
		</div>		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="container content-wrapper">
