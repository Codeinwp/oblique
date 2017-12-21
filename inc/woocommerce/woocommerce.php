<?php
/**
 * WooCommerce Compatibility
 *
 * @package oblique
 */

/**
 * Declare WooCommerce Support
 */
function oblique_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'oblique_woocommerce_support' );

/**
 * Shop Page
 */
// Remove pages navigation
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Remove sorting results after loop
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );

// Remove sorting results before loop
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// Remove drop down sort before loop
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/**
 * Remove Page Title
 */
function oblique_remove_woo_title() {
	return false;
}
add_filter( 'woocommerce_show_page_title', 'oblique_remove_woo_title' );

/**
 * Custom Title on Shop Page
 */
function oblique_shop_title() {

	do_action( 'oblique_archive_title_top_svg' ); ?>

	<header class="page-header">
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	</header><!-- .page-header -->

	<div class="svg-container svg-block page-header-svg">
		<?php do_action( 'oblique_archive_title_bottom_svg' ); ?>
	</div>
	<?php

}
add_action( 'woocommerce_before_main_content', 'oblique_shop_title', 40 );

// Remove product rating on shop page
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

/**
 * Top svg for products and categories on shop page
 */
function oblique_product_top_svg() {
	?>
	<div class="svg-container post-svg svg-block">
		<?php oblique_svg_3(); ?>
	</div>
	<?php
}
add_action( 'woocommerce_before_shop_loop_item', 'oblique_product_top_svg', 5 );
add_action( 'woocommerce_before_subcategory', 'oblique_product_top_svg', 5 );

/**
 * Bottom svg for products and categories on shop page
 */
function oblique_product_bottom_svg() {
	?>
	<div class="svg-container post-bottom-svg svg-block">
		<?php oblique_svg_5(); ?>
	</div>
	<?php
}
add_action( 'woocommerce_after_shop_loop_item', 'oblique_product_bottom_svg', 10 );
add_action( 'woocommerce_after_subcategory', 'oblique_product_bottom_svg', 10 );

// Change single product price position
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

// Remove reviews on single product page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

// Remove upsells on single product page
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

/**
 * Shop Page
 */

/**
 * Single Product Wrapper
 */
function oblique_single_product_wrapper() {
	?>
	<div class="svg-container svg-block single_product_top_svg">
		<?php do_action( 'oblique_single_product_top_svg' ); ?>
	</div>
	<div class="single_product_wrapper">
	<?php
}
add_action( 'woocommerce_before_single_product_summary', 'oblique_single_product_wrapper' );

/**
 * Related Product Custom Title
 */
function oblique_related_products_title() {

	global $product;
	$related_products = wc_get_related_products( $product->get_id(), 1, $product->get_upsell_ids() );

	?>
	<div class="svg-container svg-block single_product_bottom_svg">
		<?php do_action( 'oblique_single_product_bottom_svg' ); ?>
	</div>
	</div> <!-- Single Product Wrapper -->

	<?php if ( $related_products ) : ?>
		<div class="related_products_title_wrapper">
			<div class="svg-container svg-block related-title-top-svg">
				<?php do_action( 'oblique_related_products_title_before' ); ?>
			</div>
			<h2 class="related_products_title"><?php echo esc_html__( 'Suggested Items', 'oblique' ); ?></h2>
			<div class="svg-container svg-block related-title-bottom-svg">
				<?php do_action( 'oblique_related_products_title_after' ); ?>
			</div>
		</div>
		<?php
	endif;

}
add_action( 'woocommerce_after_single_product_summary', 'oblique_related_products_title' );

/**
 * Single Product Top SVG
 */
add_action( 'oblique_single_product_top_svg', 'oblique_svg_3' );

/**
 * Single Product Bottom SVG
 */
add_action( 'oblique_single_product_bottom_svg', 'oblique_svg_5' );

/**
 * Related Products Title Top SVG
 */
add_action( 'oblique_related_products_title_before', 'oblique_svg_3' );

/**
 * Related Products Title Bottom SVG
 */
add_action( 'oblique_related_products_title_after', 'oblique_svg_5' );
