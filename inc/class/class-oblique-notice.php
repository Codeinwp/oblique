<?php
class Oblique_Colors_Notice extends WP_Customize_Control {

	public function enqueue() {
		wp_enqueue_style( 'oblique-notice-control', get_template_directory_uri().'inc/customizer-info/css/style.css','1.0.0' );
	}

	public function render_content() { ?>
		<div class="oblique-theme-info">
			<p>
				<?php
				$url = 'http://themeisle.com/themes/shop-isle-pro/';
				echo esc_html__( 'Get full color schemes support for your site.', 'oblique' );
				echo sprintf( wp_kses( __( '<a href="%s">View PRO version</a>.', 'oblique' ), array(  'a' => array( 'href' => array() ) ) ), esc_url( $url ) ); ?>
				<span class="dashicons dashicons-admin-customizer"></span>
			</p>
		</div>
		<?php
	}
}