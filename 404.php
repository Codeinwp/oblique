<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Oblique
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<div class="svg-container svg-block page-header-svg">
					<?php oblique_svg_1(); ?>
				</div>				
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'oblique' ); ?></h1>
				</header><!-- .page-header -->
				<div class="svg-container svg-block page-header-svg">
					<?php echo oblique_svg_3(); ?>
				</div>	

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'oblique' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
