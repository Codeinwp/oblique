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

			<?php do_action( 'oblique_search_before_title' ); ?>
			<header class="page-header">
				<h1 class="page-title"><?php /* translators: Search query */ printf( __( 'Search Results for: %s', 'oblique' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->
			<?php do_action( 'oblique_search_after_title' ); ?>

			<?php ;/* Start the Loop */ ?>
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

			<?php do_action( 'oblique_posts_navigation' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
