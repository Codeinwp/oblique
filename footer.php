<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Oblique
 */
?>

		</div>
	</div><!-- #content -->

	<?php do_action( 'oblique_footer_svg' ); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="col-xs-12 col-md-6 site-info">
			<?php do_action( 'oblique_footer' ); ?>
		</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
