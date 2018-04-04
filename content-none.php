<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Oblique
 */
?>

<section class="no-results not-found">
	<?php do_action( 'oblique_archive_title_top_svg' ); ?>
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'oblique' ); ?></h1>
	</header><!-- .page-header -->
	<div class="svg-container svg-block page-header-svg">
		<?php do_action( 'oblique_archive_title_bottom_svg' ); ?>
	</div>

	<div class="svg-container single-post-svg svg-block">
		<?php oblique_svg_1(); ?>
	</div>
	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<?php ;/* translators: Add new post link */ ?>
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'oblique' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'oblique' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'oblique' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
	<div class="svg-container single-post-svg single-svg-bottom svg-block">
		<?php do_action( 'oblique_single_page_post_svg' ); ?>
	</div>
</section><!-- .no-results -->
