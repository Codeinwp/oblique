<?php
if(!class_exists('WP_Customize_Control')){
	return;
}

class Oblique_Info extends WP_Customize_Control {
	public $type = 'info';
	public $label = '';
	public function enqueue() {
		wp_enqueue_style( 'oblique-theme-info-control', get_template_directory_uri().'inc/customizer-info/css/style.css','1.0.0' );
	}


	public function render_content() {
		$links = array(
			array(
				'name' => __('View Documentation','oblique'),
				'link' => esc_url('http://docs.themeisle.com/article/294-oblique-documentation')
			),
			array(
				'name' => __('Demo','oblique'),
				'link' => esc_url('http://themeisle.com/demo/?theme=Oblique')
			),
			array(
				'name' => __('Free VS Pro','oblique'),
				'link' => esc_url('http://docs.themeisle.com/article/478-what-is-the-difference-between-oblique-and-oblique-pro/')
			),
			array(
				'name' => __('View Pro','oblique'),
				'link' => esc_url('http://themeisle.com/themes/oblique-pro/')
			),
			array(
				'name' => __('Leave a review','oblique'),
				'link' => esc_url('https://wordpress.org/support/theme/oblique/reviews/')
			),
		); ?>


		<div class="oblique-theme-info">
			<?php
			foreach ($links as $item){ ?>
				<a href="<?php echo esc_url($item['link']); ?>" target="_blank"><?php echo esc_html($item['name']); ?></a>
				<hr/>
				<?php
			} ?>
		</div>
		<?php
	}
}
