<?php
/**
 * The template for displaying search results pages.
 *
 * @package Oblique
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php do_action( 'oblique_archive_title_top_svg' ); ?>
			<header class="page-header">
				<h1 class="page-title"><?php /* translators: Search query */ printf( __( 'Search Results for: %s', 'oblique' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->
			<div class="svg-container svg-block page-header-svg">
				<?php do_action( 'oblique_archive_title_bottom_svg' ); ?>
			</div>	

			<div class="svg-container single-post-svg svg-block">
				<?php oblique_svg_1(); ?>
			</div>
			<?php
			while ( have_posts() ) :
				the_post();
?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<div class="svg-container single-post-svg single-svg-bottom svg-block">
				<?php do_action( 'oblique_single_page_post_svg' ); ?>
			</div>

			<?php do_action( 'oblique_posts_navigation' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
