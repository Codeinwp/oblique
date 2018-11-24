<?php
/**
 * Oblique Theme Customizer
 *
 * @package Oblique
 */

/**
 * Register main controls in customize
 */
function oblique_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->remove_control( 'display_header_text' );
	$wp_customize->remove_section( 'background_image' );

	/**
	 * Class Oblique_Titles
	 */
	class Oblique_Titles extends WP_Customize_Control {

		/**
		 * The type of customize section being rendered.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'titles';

		/**
		 * Control label
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $label = '';

		/**
		 * The render function for the controler
		 */
		public function render_content() {
			?>
			<h3 style="padding: 10px; border: 1px solid #DF7B7B; color: #DF7B7B;"><?php echo esc_html( $this->label ); ?></h3>
			<?php
		}
	}

	/**
	 * Class Oblique_Theme_Info
	 */
	class Oblique_Theme_Info extends WP_Customize_Control {

		/**
		 * The type of customize section being rendered.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'info';

		/**
		 * The render function for the controler
		 */
		public function render_content() {
		}
	}

	/**
	 * Upsells
	 */
	require_once( trailingslashit( get_template_directory() ) . 'inc/class/class-customizer-theme-info-control/class-customizer-theme-info-control.php' );

	$wp_customize->add_section(
		'oblique_theme_info_main_section',
		array(
			'title'    => __( 'View PRO version', 'oblique' ),
			'priority' => 0,
		)
	);

	$wp_customize->add_setting(
		'oblique_theme_info_main_control',
		array(
			'sanitize_callback' => 'esc_html',
		)
	);

	// View Pro Version Section Control
	$wp_customize->add_control(
		new Oblique_Control_Upsell_Theme_Info(
			$wp_customize,
			'oblique_theme_info_main_control',
			array(
				'section'     => 'oblique_theme_info_main_section',
				'priority'    => 100,
				'options'     => array(
					esc_html__( 'Jetpack Related Posts', 'oblique' ),
					esc_html__( 'Slider', 'oblique' ),
					esc_html__( 'Extra Widget Area', 'oblique' ),
					esc_html__( 'Alternative Layout', 'oblique' ),
					esc_html__( 'Extra Colors', 'oblique' ),
					esc_html__( 'Footer Credits', 'oblique' ),
					esc_html__( 'Support', 'oblique' ),
				),
				'button_url'  => esc_url( 'https://themeisle.com/themes/oblique-pro/upgrade/' ),
				'button_text' => esc_html__( 'View PRO version', 'oblique' ),
			)
		)
	);

	/**
	 * Header Section Upsell
	 */
	$wp_customize->add_setting(
		'oblique_theme_info_header_section_control',
		array(
			'sanitize_callback' => 'esc_html',
		)
	);

	$wp_customize->add_control(
		new Oblique_Control_Upsell_Theme_Info(
			$wp_customize,
			'oblique_theme_info_header_section_control',
			array(
				'section'            => 'oblique_header',
				'priority'           => 500,
				'options'            => array(
					esc_html__( 'Slider', 'oblique' ),
				),
				'explained_features' => array(
					esc_html__( 'Add a shortcode for a slider to replace the header image.', 'oblique' ),
				),
				'button_url'         => esc_url( 'https://themeisle.com/themes/oblique-pro/upgrade/' ),
				'button_text'        => esc_html__( 'View PRO version', 'oblique' ),
			)
		)
	);

	// ___General___//
	$wp_customize->add_section(
		'oblique_general',
		array(
			'title'    => __( 'General', 'oblique' ),
			'priority' => 9,
		)
	);

	// Disable FitVids
	$wp_customize->add_setting(
		'disable_fitvids',
		array(
			'sanitize_callback' => 'oblique_sanitize_checkbox',
			'default'           => false,
		)
	);
	$wp_customize->add_control(
		'disable_fitvids',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Disable auto responsive video embeds?', 'oblique' ),
			'section'  => 'oblique_general',
			'priority' => 11,
		)
	);

	// Hide meta
	$wp_customize->add_setting(
		'search_toggle',
		array(
			'sanitize_callback' => 'oblique_sanitize_checkbox',
			'default'           => 0,
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'search_toggle',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Toggle a search form in the header?', 'oblique' ),
			'section'  => 'oblique_general',
			'priority' => 11,
		)
	);

	// Menu text
	$wp_customize->add_setting(
		'menu_text',
		array(
			'sanitize_callback' => 'oblique_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'menu_text',
		array(
			'label'       => __( 'Menu toggle text', 'oblique' ),
			'description' => __( 'You can use this to replace the menu toggle button with some text', 'oblique' ),
			'section'     => 'oblique_general',
			'type'        => 'text',
			'priority'    => 11,
		)
	);
	// ___Header___//
	$wp_customize->add_section(
		'oblique_header',
		array(
			'title'    => __( 'Header', 'oblique' ),
			'priority' => 10,
		)
	);
	// Logo size
	$wp_customize->add_setting(
		'logo_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '200',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'logo_size',
		array(
			'type'        => 'number',
			'priority'    => 12,
			'section'     => 'title_tagline',
			'label'       => __( 'Logo size', 'oblique' ),
			'description' => __( 'Max-width for the logo. Default 200px', 'oblique' ),
			'input_attrs' => array(
				'min'  => 50,
				'max'  => 600,
				'step' => 5,
			),
		)
	);
	// Logo style
	$wp_customize->add_setting(
		'logo_style',
		array(
			'default'           => 'hide-title',
			'sanitize_callback' => 'oblique_sanitize_logo_style',
		)
	);
	$wp_customize->add_control(
		'logo_style',
		array(
			'type'        => 'radio',
			'label'       => __( 'Logo style', 'oblique' ),
			'description' => __( 'This option applies only if you are using a logo', 'oblique' ),
			'section'     => 'title_tagline',
			'priority'    => 13,
			'choices'     => array(
				'hide-title' => __( 'Only logo', 'oblique' ),
				'show-title' => __( 'Logo plus site title&amp;description', 'oblique' ),
			),
		)
	);
	// Padding
	$wp_customize->add_setting(
		'branding_padding',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '150',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'branding_padding',
		array(
			'type'        => 'number',
			'priority'    => 14,
			'section'     => 'oblique_header',
			'label'       => __( 'Padding', 'oblique' ),
			'description' => __( 'Top&amp;bottom padding for the branding. Default: 150px', 'oblique' ),
			'input_attrs' => array(
				'min'  => 20,
				'max'  => 350,
				'step' => 5,
			),
		)
	);
	// Padding
	$wp_customize->add_setting(
		'branding_padding_1024',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '100',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'branding_padding_1024',
		array(
			'type'        => 'number',
			'priority'    => 15,
			'section'     => 'oblique_header',
			'label'       => __( 'Padding on screen sizes < 1024px', 'oblique' ),
			'description' => __( 'Top&amp;bottom padding for the branding. Default: 100px', 'oblique' ),
			'input_attrs' => array(
				'min'  => 20,
				'max'  => 350,
				'step' => 5,
			),
		)
	);

	// ___Blog options___//
	$wp_customize->add_section(
		'blog_options',
		array(
			'title'    => __( 'Blog options', 'oblique' ),
			'priority' => 13,
		)
	);
	// Excerpt
	$wp_customize->add_setting(
		'exc_lenght',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '35',
		)
	);
	$wp_customize->add_control(
		'exc_lenght',
		array(
			'type'        => 'number',
			'priority'    => 10,
			'section'     => 'blog_options',
			'label'       => __( 'Excerpt lenght', 'oblique' ),
			'description' => __( 'Choose your excerpt length. Default: 35 words', 'oblique' ),
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 200,
				'step' => 5,
			),
		)
	);
	// Hide meta
	$wp_customize->add_setting(
		'meta_index',
		array(
			'sanitize_callback' => 'oblique_sanitize_checkbox',
			'default'           => 0,
		)
	);
	$wp_customize->add_control(
		'meta_index',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Hide date/author/archives on index?', 'oblique' ),
			'section'  => 'blog_options',
			'priority' => 11,
		)
	);
	$wp_customize->add_setting(
		'meta_singles',
		array(
			'sanitize_callback' => 'oblique_sanitize_checkbox',
			'default'           => 0,
		)
	);
	$wp_customize->add_control(
		'meta_singles',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Hide date/author/archives on single posts?', 'oblique' ),
			'section'  => 'blog_options',
			'priority' => 12,
		)
	);
	$wp_customize->add_setting(
		'read_more',
		array(
			'sanitize_callback' => 'oblique_sanitize_checkbox',
			'default'           => 0,
		)
	);
	$wp_customize->add_control(
		'read_more',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Hide the read more button?', 'oblique' ),
			'section'  => 'blog_options',
			'priority' => 13,
		)
	);
	// Index images
	$wp_customize->add_setting(
		'index_feat_image',
		array(
			'sanitize_callback' => 'oblique_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'index_feat_image',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Hide featured images on index, archives?', 'oblique' ),
			'section'  => 'blog_options',
			'priority' => 15,
		)
	);
	// Post images
	$wp_customize->add_setting(
		'post_feat_image',
		array(
			'sanitize_callback' => 'oblique_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'post_feat_image',
		array(
			'type'     => 'checkbox',
			'label'    => __( 'Hide featured images on single posts?', 'oblique' ),
			'section'  => 'blog_options',
			'priority' => 16,
		)
	);

	// ___Fonts___//
	$wp_customize->add_section(
		'oblique_fonts',
		array(
			'title'       => __( 'Fonts', 'oblique' ),
			'priority'    => 15,
			'description' => __( 'You can use any Google Fonts you want for the heading and/or body. See the fonts here: google.com/fonts. See the documentation if you need help with this: docs.themeisle.com/article/294-oblique-documentation', 'oblique' ),
		)
	);
	// Body fonts title
	$wp_customize->add_setting(
		'oblique_options[titles]',
		array(
			'type'              => 'titles_control',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		new Oblique_Titles(
			$wp_customize,
			'body_fonts',
			array(
				'label'    => __( 'Body fonts', 'oblique' ),
				'section'  => 'oblique_fonts',
				'settings' => 'oblique_options[titles]',
				'priority' => 10,
			)
		)
	);
	// Body fonts
	$wp_customize->add_setting(
		'body_font_name',
		array(
			'default'           => 'Open+Sans:400italic,600italic,400,600',
			'sanitize_callback' => 'oblique_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'body_font_name',
		array(
			'label'    => __( 'Font name/style/sets', 'oblique' ),
			'section'  => 'oblique_fonts',
			'type'     => 'text',
			'priority' => 11,
		)
	);
	// Body fonts family
	$wp_customize->add_setting(
		'body_font_family',
		array(
			'default'           => '\'Open Sans\', sans-serif',
			'sanitize_callback' => 'oblique_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'body_font_family',
		array(
			'label'    => __( 'Font family', 'oblique' ),
			'section'  => 'oblique_fonts',
			'type'     => 'text',
			'priority' => 12,
		)
	);
	// Headings fonts title
	$wp_customize->add_setting(
		'oblique_options[titles]',
		array(
			'type'              => 'titles_control',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		new Oblique_Titles(
			$wp_customize,
			'headings_fonts',
			array(
				'label'    => __( 'Headings fonts', 'oblique' ),
				'section'  => 'oblique_fonts',
				'settings' => 'oblique_options[titles]',
				'priority' => 13,
			)
		)
	);
	// Headings fonts
	$wp_customize->add_setting(
		'headings_font_name',
		array(
			'default'           => 'Playfair+Display:400,700,400italic,700italic',
			'sanitize_callback' => 'oblique_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'headings_font_name',
		array(
			'label'    => __( 'Font name/style/sets', 'oblique' ),
			'section'  => 'oblique_fonts',
			'type'     => 'text',
			'priority' => 14,
		)
	);
	// Headings fonts family
	$wp_customize->add_setting(
		'headings_font_family',
		array(
			'default'           => '\'Playfair Display\', serif',
			'sanitize_callback' => 'oblique_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'headings_font_family',
		array(
			'label'    => __( 'Font family', 'oblique' ),
			'section'  => 'oblique_fonts',
			'type'     => 'text',
			'priority' => 15,
		)
	);
	// Font sizes title
	$wp_customize->add_setting(
		'oblique_options[titles]',
		array(
			'type'              => 'titles_control',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		new Oblique_Titles(
			$wp_customize,
			'font_sizes_title',
			array(
				'label'    => __( 'Font sizes', 'oblique' ),
				'section'  => 'oblique_fonts',
				'settings' => 'oblique_options[titles]',
				'priority' => 16,
			)
		)
	);
	// Site title
	$wp_customize->add_setting(
		'site_title_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '82',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'site_title_size',
		array(
			'type'        => 'number',
			'priority'    => 17,
			'section'     => 'oblique_fonts',
			'label'       => __( 'Site title', 'oblique' ),
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 90,
				'step' => 1,
			),
		)
	);
	// Site description
	$wp_customize->add_setting(
		'site_desc_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '18',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'site_desc_size',
		array(
			'type'        => 'number',
			'priority'    => 17,
			'section'     => 'oblique_fonts',
			'label'       => __( 'Site description', 'oblique' ),
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 50,
				'step' => 1,
			),
		)
	);
	// H1 size
	$wp_customize->add_setting(
		'h1_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '36',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'h1_size',
		array(
			'type'        => 'number',
			'priority'    => 17,
			'section'     => 'oblique_fonts',
			'label'       => __( 'H1 font size', 'oblique' ),
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 60,
				'step' => 1,
			),
		)
	);
	// H2 size
	$wp_customize->add_setting(
		'h2_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '30',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'h2_size',
		array(
			'type'        => 'number',
			'priority'    => 18,
			'section'     => 'oblique_fonts',
			'label'       => __( 'H2 font size', 'oblique' ),
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 60,
				'step' => 1,
			),
		)
	);
	// H3 size
	$wp_customize->add_setting(
		'h3_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '24',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'h3_size',
		array(
			'type'        => 'number',
			'priority'    => 19,
			'section'     => 'oblique_fonts',
			'label'       => __( 'H3 font size', 'oblique' ),
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 60,
				'step' => 1,
			),
		)
	);
	// H4 size
	$wp_customize->add_setting(
		'h4_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '18',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'h4_size',
		array(
			'type'        => 'number',
			'priority'    => 20,
			'section'     => 'oblique_fonts',
			'label'       => __( 'H4 font size', 'oblique' ),
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 60,
				'step' => 1,
			),
		)
	);
	// H5 size
	$wp_customize->add_setting(
		'h5_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '14',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'h5_size',
		array(
			'type'        => 'number',
			'priority'    => 21,
			'section'     => 'oblique_fonts',
			'label'       => __( 'H5 font size', 'oblique' ),
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 60,
				'step' => 1,
			),
		)
	);
	// H6 size
	$wp_customize->add_setting(
		'h6_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '12',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'h6_size',
		array(
			'type'        => 'number',
			'priority'    => 22,
			'section'     => 'oblique_fonts',
			'label'       => __( 'H6 font size', 'oblique' ),
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 60,
				'step' => 1,
			),
		)
	);
	// Body
	$wp_customize->add_setting(
		'body_size',
		array(
			'sanitize_callback' => 'absint',
			'default'           => '16',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'body_size',
		array(
			'type'        => 'number',
			'priority'    => 23,
			'section'     => 'oblique_fonts',
			'label'       => __( 'Body font size', 'oblique' ),
			'input_attrs' => array(
				'min'  => 10,
				'max'  => 24,
				'step' => 1,
			),
		)
	);

	// ___Colors___//
	// Primary color
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => apply_filters( 'oblique_primary_color', '#23B6B6' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color',
			array(
				'label'    => __( 'Primary color', 'oblique' ),
				'section'  => 'colors',
				'settings' => 'primary_color',
				'priority' => 12,
			)
		)
	);
	// Site title
	$wp_customize->add_setting(
		'site_title_color',
		array(
			'default'           => apply_filters( 'oblique_site_title_color', '#f9f9f9' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_title_color',
			array(
				'label'    => __( 'Site title', 'oblique' ),
				'section'  => 'colors',
				'settings' => 'site_title_color',
				'priority' => 13,
			)
		)
	);
	// Site desc
	$wp_customize->add_setting(
		'site_desc_color',
		array(
			'default'           => apply_filters( 'oblique_site_desc_color', '#dddddd' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_desc_color',
			array(
				'label'    => __( 'Site description', 'oblique' ),
				'section'  => 'colors',
				'priority' => 14,
			)
		)
	);
	// Body
	$wp_customize->add_setting(
		'body_text_color',
		array(
			'default'           => apply_filters( 'oblique_body_text_color', '#50545C' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'body_text_color',
			array(
				'label'    => __( 'Body text', 'oblique' ),
				'section'  => 'colors',
				'settings' => 'body_text_color',
				'priority' => 15,
			)
		)
	);
	// Entry titles
	$wp_customize->add_setting(
		'entry_titles',
		array(
			'default'           => apply_filters( 'oblique_entry_titles_color', '#000' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entry_titles',
			array(
				'label'    => __( 'Entry titles', 'oblique' ),
				'section'  => 'colors',
				'priority' => 16,
			)
		)
	);
	// Entry meta
	$wp_customize->add_setting(
		'entry_meta',
		array(
			'default'           => apply_filters( 'oblique_entry_meta_color', '#9d9d9d' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'entry_meta',
			array(
				'label'    => __( 'Entry meta', 'oblique' ),
				'section'  => 'colors',
				'priority' => 17,
			)
		)
	);
	// Sidebar
	$wp_customize->add_setting(
		'sidebar_bg',
		array(
			'default'           => '#17191B',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sidebar_bg',
			array(
				'label'    => __( 'Sidebar background', 'oblique' ),
				'section'  => 'colors',
				'priority' => 18,
			)
		)
	);
	// Sidebar color
	$wp_customize->add_setting(
		'sidebar_color',
		array(
			'default'           => '#f9f9f9',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'sidebar_color',
			array(
				'label'    => __( 'Sidebar color', 'oblique' ),
				'section'  => 'colors',
				'priority' => 19,
			)
		)
	);
	// Footer
	$wp_customize->add_setting(
		'footer_background',
		array(
			'default'           => apply_filters( 'oblique_footer_background_color', '#17191B' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_background',
			array(
				'label'    => __( 'Footer', 'oblique' ),
				'section'  => 'colors',
				'priority' => 20,
			)
		)
	);

	// Social icons
	$wp_customize->add_setting(
		'social_color',
		array(
			'default'           => apply_filters( 'oblique_social_color', '#ffffff' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'social_color',
			array(
				'label'    => __( 'Social color', 'oblique' ),
				'section'  => 'colors',
				'settings' => 'social_color',
				'priority' => 21,
			)
		)
	);

	// Menu icon
	$wp_customize->add_setting(
		'menu_icon_color',
		array(
			'default'           => apply_filters( 'oblique_menu_icon_color', '#ffffff' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'menu_icon_color',
			array(
				'label'    => 'Menu icon/Leave a review color',
				'section'  => 'colors',
				'settings' => 'menu_icon_color',
				'priority' => 21,
			)
		)
	);

	// ___Social___//
	$wp_customize->add_section(
		'oblique_social',
		array(
			'title'       => __( 'Social', 'oblique' ),
			'priority'    => 21,
			'description' => __( 'To create a social profile like in the theme demo, do this:<br><ol><li>Go to Appearance > Menus;</li><li>Create a new menu and add links to your social networks by using the Custom Links tab;</li><li>Assign that newly created menu to the Social position.</li></ol>', 'oblique' ),
		)
	);
	$wp_customize->add_setting(
		'oblique_theme_social',
		array(
			'type'              => 'info_control',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		new Oblique_Theme_Info(
			$wp_customize,
			'social',
			array(
				'section'  => 'oblique_social',
				'settings' => 'oblique_theme_social',
				'priority' => 10,
			)
		)
	);

}

add_action( 'customize_register', 'oblique_customize_register' );

/**
 * Sanitize Text
 */
function oblique_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Logo style
 */
function oblique_sanitize_logo_style( $input ) {
	$valid = array(
		'hide-title' => __( 'Only logo', 'oblique' ),
		'show-title' => __( 'Logo plus site title&amp;description', 'oblique' ),
	);
	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Checkboxes
 */
function oblique_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function oblique_customize_preview_js() {
	wp_enqueue_script( 'oblique_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}

add_action( 'customize_preview_init', 'oblique_customize_preview_js' );
