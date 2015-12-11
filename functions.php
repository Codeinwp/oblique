<?php
/**
 * Oblique functions and definitions
 *
 * @package Oblique
 */


if ( ! function_exists( 'oblique_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function oblique_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Oblique, use a find and replace
	 * to change 'oblique' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'oblique', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Content width
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1040;
	}

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('oblique-entry-thumb', 370);
	add_image_size('oblique-single-thumb', 1040);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'oblique' ),
		'social'  => __( 'Social', 'oblique' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'oblique_custom_background_args', array(
		'default-color' => '1c1c1c',
	) ) );
}
endif; // oblique_setup
add_action( 'after_setup_theme', 'oblique_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function oblique_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'oblique' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'oblique_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function oblique_scripts() {

	if ( get_theme_mod('body_font_name') !='' ) {
	    wp_enqueue_style( 'oblique-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('body_font_name')) );
	} else {
	    wp_enqueue_style( 'oblique-body-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600');
	}

	if ( get_theme_mod('headings_font_name') !='' ) {
	    wp_enqueue_style( 'oblique-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('headings_font_name')) );
	} else {
	    wp_enqueue_style( 'oblique-headings-fonts', '//fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic');
	}

	wp_enqueue_style( 'oblique-style', get_stylesheet_uri() );

	wp_enqueue_style( 'oblique-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );

	wp_enqueue_script( 'oblique-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), true );

	wp_enqueue_script( 'oblique-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true );

	wp_enqueue_script( 'oblique-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), true );

	wp_enqueue_script( 'oblique-masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array('jquery-masonry'), true );

	wp_enqueue_script( 'oblique-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'oblique-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'oblique_scripts' );


/* tgm-plugin-activation */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';

/**
 * TGMPA register
 */
function oblique_register_required_plugins() {
		$plugins = array(

			array(
				'name'      => 'WP Product Review',
				'slug'      => 'wp-product-review',
				'required'  => false,
			),

			array(
				'name'      => 'Intergeo Maps - Google Maps Plugin',
				'slug'      => 'intergeo-maps',
				'required'  => false
			),

			array(
				'name'     => 'Pirate Forms',
				'slug' 	   => 'pirate-forms',
				'required' => false
			));

	$config = array(
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'oblique' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'oblique' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'oblique' ),
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'oblique' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'oblique' ),
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'oblique' ),
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'oblique' ),
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'oblique' ),
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'oblique' ),
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'oblique' ),
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'oblique' ),
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'oblique' ),
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'oblique' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'oblique' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'oblique' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'oblique' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'oblique' ),
            'nag_type'                        => 'updated'
        )
    );

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'oblique_register_required_plugins' );


/**
 * Enqueue Bootstrap
 */
function oblique_enqueue_bootstrap() {
	wp_enqueue_style( 'oblique-bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'oblique_enqueue_bootstrap', 9 );

/**
 * Change the excerpt length
 */
function oblique_excerpt_length( $length ) {
	$excerpt = get_theme_mod('exc_lenght', '35');
	return esc_attr($excerpt);
}
add_filter( 'excerpt_length', 'oblique_excerpt_length', 999 );

/**
 * Hide the excerpt more if the excerpt is set to 0 words
 */
function oblique_excerpt_more( $more ) {
	$excerpt = get_theme_mod('exc_lenght', '35');
	if ($excerpt == '0') {
    	return '';
	} else {
		return '[...]';
	}
}
add_filter('excerpt_more', 'oblique_excerpt_more');

/**
 * Footer credits
 */
function oblique_footer_credits() {
	echo '<a href="' . esc_url( __( 'http://wordpress.org/', 'oblique' ) ) . '" rel="nofollow">';
		printf( __( 'Proudly powered by %s', 'oblique' ), 'WordPress' );
	echo '</a>';
	echo '<span class="sep"> | </span>';
	printf( __( 'Theme: %2$s by %1$s.', 'oblique' ), 'Themeisle', '<a href="http://themeisle.com/themes/oblique/" rel="nofollow">Oblique</a>' );
}
add_action( 'oblique_footer', 'oblique_footer_credits' );

/**
 * Load html5shiv
 */
function oblique_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'oblique_html5shiv' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * SVGs
 */
require get_template_directory() . '/inc/svg.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';
