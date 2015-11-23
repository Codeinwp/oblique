<?php
/**
 * @package Oblique
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="svg-container post-svg svg-block">
		<?php echo oblique_svg_3(); ?>
	</div>	

	<?php if ( has_post_thumbnail() && ( get_theme_mod( 'index_feat_image' ) != 1 ) ) : ?>
		<div class="entry-thumb">
			<?php the_post_thumbnail('oblique-entry-thumb'); ?>
			<a class="thumb-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><i class="fa fa-link"></i></a>		
		</div>	
	<?php endif; ?>	

	<?php if ( has_post_thumbnail() && ( get_theme_mod( 'index_feat_image' ) != 1 ) ) : ?>
	<div class="post-inner">
	<?php else : ?>
	<div class="post-inner no-thumb">
	<?php endif; ?>		
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

			<?php if ( 'post' == get_post_type() && !get_theme_mod('meta_index') ) : ?>
			<div class="entry-meta">
				<?php oblique_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'oblique' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
	<?php if (!get_theme_mod('read_more')) : ?>
	<div class="read-more">
		<a href="<?php the_permalink(); ?>"><?php echo __('Continue reading &hellip;','oblique'); ?></a>
	</div>		
	<?php endif; ?>
	<div class="svg-container post-bottom-svg svg-block">
		<?php echo oblique_svg_1(); ?>
	</div>	
</article><!-- #post-## -->