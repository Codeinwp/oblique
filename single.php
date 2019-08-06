<?php
/**
 * The template for displaying all single posts.
 *
 * @package Oblique
 */

get_header(); ?>
	<?php
	$single_classes = apply_filters( 'oblique_main_classes', 'site-main' );
	?>
	<div id="primary" class="content-area">
		<main id="main" class="<?php echo esc_attr( $single_classes ); ?>" role="main">
		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', 'single' );
			do_action( 'oblique_single_post_navigation' );
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}
		?>
		</main><!-- #main -->
		<?php do_action( 'oblique_single_sidebar' ); ?>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
