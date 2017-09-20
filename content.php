<?php
/**
 * The template used for displaying page content
 *
 * @package Oblique
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="svg-container post-svg svg-block">
		<?php echo oblique_svg_3(); ?>
	</div>	

	<?php if ( has_post_thumbnail() && ( get_theme_mod( 'index_feat_image' ) != 1 ) ) : ?>
		<div class="entry-thumb">
			<?php the_post_thumbnail( 'oblique-entry-thumb' ); ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumb-link-wrap">
				<span class="thumb-link"><i class="fa fa-link"></i></span>
			</a>
		</div>
	<?php endif; ?>	

	<?php if ( has_post_thumbnail() && ( get_theme_mod( 'index_feat_image' ) != 1 ) ) : ?>
	<div class="post-inner">
	<?php else : ?>
	<div class="post-inner no-thumb">
	<?php endif; ?>		
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' == get_post_type() && ! get_theme_mod( 'meta_index' ) ) : ?>
			<div class="entry-meta">
				<?php oblique_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>

			<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'oblique' ),
						'after'  => '</div>',
					)
				);
			?>
		</div><!-- .entry-content -->
		<?php do_action( 'oblique_post_entry_content_bottom' ); ?>
	</div>
		<?php do_action( 'oblique_link_to_single' ); ?>

	<div class="svg-container post-bottom-svg svg-block">
		<?php
		do_action( 'oblique_post_bottom_svg' );
		?>
	</div>	
</article><!-- #post-## -->
