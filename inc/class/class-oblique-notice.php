<?php
/**
 * Class to display notices in customizer.
 *
 * @package WordPress
 * @subpackage Oblique
 */

/**
 * Class Oblique_Colors_Notice
 */
class Oblique_Colors_Notice extends WP_Customize_Control {

	/**
	 * Enqueue required scripts and styles.
	 */
	public function enqueue() {
		wp_enqueue_style( 'oblique-notice-control', get_template_directory_uri() . 'inc/customizer-info/css/style.css','1.0.0' );
	}

	/**
	 * The render function for the controler
	 */
	public function render_content() {
	?>
		<div class="oblique-theme-info">
			<p>
				<?php
				echo esc_html__( 'Get full color schemes support for your site.', 'oblique' );
				echo sprintf( '<a href="https://themeisle.com/themes/oblique-pro/" target="_blank">%s</a>', __( 'View PRO version', 'oblique' ) ); ?>
				<span class="dashicons dashicons-admin-customizer"></span>
			</p>
		</div>
		<?php
	}
}
