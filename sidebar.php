<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Oblique
 */
?>

<div id="secondary" class="widget-area" role="complementary">



	<nav id="site-navigation" class="main-navigation" role="navigation">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
			)
		);
			?>
	</nav><!-- #site-navigation -->
	<nav class="sidebar-nav"></nav>



	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php endif; ?>

</div><!-- #secondary -->
