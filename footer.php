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

	<div class="svg-container footer-svg svg-block">
		<?php oblique_svg_1(); ?>
	</div>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info container">
			<?php do_action('oblique_footer'); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
