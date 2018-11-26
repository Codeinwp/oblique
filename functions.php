<?php
/**
 * Oblique functions and definitions
 *
 * @package Oblique
 */

define( 'OBLIQUE_VERSION', '2.0.18' );

/**
 * Themeisle SDK filter.
 *
 * @param array $products products array.
 *
 * @return array
 */
function oblique_filter_sdk( $products ) {
	$products[] = get_template_directory() . '/style.css';
	return $products;
}
add_filter( 'themeisle_sdk_products', 'oblique_filter_sdk' );

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
		add_image_size( 'oblique-entry-thumb', 370 );
		add_image_size( 'oblique-single-thumb', 1040 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'oblique' ),
				'social'  => __( 'Social', 'oblique' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			)
		);

		/*
		 * Enable support for Custom Logo.
		 * See https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo' );

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'oblique_custom_background_args',
				array(
					'default-color' => '1c1c1c',
				)
			)
		);

		require_once( trailingslashit( get_template_directory() ) . 'inc/class/class-customizer-theme-info-control/class-customizer-theme-info-root.php' );
	}
endif; // oblique_setup
add_action( 'after_setup_theme', 'oblique_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function oblique_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'oblique' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'oblique_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function oblique_scripts() {

	if ( get_theme_mod( 'body_font_name' ) != '' ) {
		wp_enqueue_style( 'oblique-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr( get_theme_mod( 'body_font_name' ) ) );
	} else {
		wp_enqueue_style( 'oblique-body-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' );
	}

	if ( get_theme_mod( 'headings_font_name' ) != '' ) {
		wp_enqueue_style( 'oblique-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr( get_theme_mod( 'headings_font_name' ) ) );
	} else {
		wp_enqueue_style( 'oblique-headings-fonts', '//fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic' );
	}

	wp_enqueue_style( 'oblique-style', get_stylesheet_uri(), array(), OBLIQUE_VERSION );

	wp_enqueue_style( 'oblique-font-awesome', get_template_directory_uri() . '/fonts/fontawesome-all.min.css', array(), '5.0.9' );

	wp_enqueue_script( 'oblique-imagesloaded', get_template_directory_uri() . '/js/vendor/imagesloaded.pkgd.min.js', array(), true );

	wp_enqueue_script( 'oblique-main', get_template_directory_uri() . '/js/vendor/main.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'oblique-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), true );

	wp_localize_script( 'oblique-scripts', 'oblique_disable_fitvids_var', array( 'oblique_disable_fitvids' => get_theme_mod( 'disable_fitvids', false ) ) );

	wp_enqueue_script( 'oblique-masonry-init', get_template_directory_uri() . '/js/vendor/masonry-init.js', array( 'jquery', 'masonry' ), true );

	wp_enqueue_script( 'oblique-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'oblique-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'oblique_scripts' );


/* tgm-plugin-activation */
require_once get_template_directory() . '/vendor/class-tgm-plugin-activation.php';

/**
 * TGMPA register
 */
function oblique_register_required_plugins() {
	$plugins = array(

		array(
			'name'     => 'Orbit Fox',
			'slug'     => 'themeisle-companion',
			'required' => false,
		),
		array(
			'name'     => 'Pirate Forms',
			'slug'     => 'pirate-forms',
			'required' => false,
		),
		array(
			'name'     => 'Nivo Slider Lite',
			'slug'     => 'nivo-slider-lite',
			'required' => false,
		),
	);

	tgmpa( $plugins );

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
	$excerpt = get_theme_mod( 'exc_lenght', '35' );
	return esc_attr( $excerpt );
}
add_filter( 'excerpt_length', 'oblique_excerpt_length', 999 );

/**
 * Hide the excerpt more if the excerpt is set to 0 words
 */
function oblique_excerpt_more( $more ) {
	$excerpt = get_theme_mod( 'exc_lenght', '35' );
	if ( $excerpt == '0' ) {
		return '';
	} else {
		return '[...]';
	}
}
add_filter( 'excerpt_more', 'oblique_excerpt_more' );

/**
 * Footer credits
 */
function oblique_footer_credits() {
	echo '<a href="' . esc_url( __( 'http://wordpress.org/', 'oblique' ) ) . '" rel="nofollow">';
	/* translators: WordPress */
		printf( __( 'Proudly powered by %s', 'oblique' ), 'WordPress' );
	echo '</a>';
	echo '<span class="sep"> | </span>';
	/* translators: 1 - Theme author 2 - Theme name */
	printf( __( 'Theme: %2$s by %1$s.', 'oblique' ), 'Themeisle', '<a href="http://themeisle.com/themes/oblique/" rel="nofollow">Oblique</a>' );
	echo '</div>';
}
add_action( 'oblique_footer', 'oblique_footer_credits' );

/**
 * Load html5shiv
 */
function oblique_html5shiv() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . esc_url( get_template_directory_uri() . '/js/vendor/html5shiv.js' ) . '"></script>' . "\n";
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

/**
 * WooCommerce functions
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce/woocommerce.php';
}

/**
 * Header
 */
function oblique_nav_svg_container() {
	echo '<div class="svg-container nav-svg svg-block">';
		oblique_svg_3();
	echo '</div>';
}
add_action( 'oblique_nav_container', 'oblique_nav_svg_container' );

/**
 * Footer
 * footer svg
 */
function oblique_footer_svg_container() {
	echo '<div class="svg-container footer-svg svg-block">';
		oblique_svg_1();
	echo '</div>';
}
add_action( 'oblique_footer_svg', 'oblique_footer_svg_container' );

/**
 * Index
 * posts navigation
 */
function oblique_posts_navigation() {
	the_posts_navigation();
}
add_action( 'oblique_posts_navigation', 'oblique_posts_navigation' );

/**
 * Post
 * read more link
 */
function oblique_post_link_to_single() {
	if ( ! get_theme_mod( 'read_more' ) ) :
	?>
		<a href="<?php the_permalink(); ?>">
			<div class="read-more">
				<?php echo apply_filters( 'oblique_post_read_more', esc_html__( 'Continue reading &hellip;', 'oblique' ) ); ?>
			</div>
		</a>
	<?php
	endif;
}
add_action( 'oblique_link_to_single', 'oblique_post_link_to_single' );

/**
 * Archive
 * archive page title top svg
 */
function oblique_archive_title_top_svg() {
	echo '<div class="svg-container svg-block page-header-svg">';
					echo oblique_svg_1();
	echo '</div>';
}
add_action( 'oblique_archive_title_top_svg', 'oblique_archive_title_top_svg' );

/**
 * Archive
 * archive page title bottom svg
 */
function oblique_archive_title_bottom_svg() {
	oblique_svg_3();
}
add_action( 'oblique_archive_title_bottom_svg', 'oblique_archive_title_bottom_svg' );

/**
 * Content page
 * single post bottom svg
 */
function oblique_single_post_bottom_svg() {
	oblique_svg_3();
}
add_action( 'oblique_single_post_bottom_svg', 'oblique_single_post_bottom_svg' );

/**
 * Single post
 * change post navigation on single
 */
function oblique_single_post_navigation() {
	the_post_navigation();
}
add_action( 'oblique_single_post_navigation', 'oblique_single_post_navigation' );

/**
 * Single page post bottom svg
 */
function oblique_single_page_post_svg() {
	oblique_svg_4();
}
add_action( 'oblique_single_page_post_svg', 'oblique_single_page_post_svg' );

/**
 * Comments title
 */
function oblique_comments_title_text() {

	echo '<h2 class="comments-title">';

	$comments_number = get_comments_number();
	if ( 1 === $comments_number ) {
		/* translators: %s: post title */
		printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'oblique' ), '<span>' . get_the_title() . '</span>' );
	} else {
		printf(
			/* translators: 1: number of comments, 2: post title */
			_nx(
				'%1$s thought on &ldquo;%2$s&rdquo;',
				'%1$s thoughts on &ldquo;%2$s&rdquo;',
				$comments_number,
				'comments title',
				'oblique'
			),
			number_format_i18n( $comments_number ),
			'<span>' . get_the_title() . '</span>'
		);
	}

	echo '</h2>';
}
add_action( 'oblique_comments_title', 'oblique_comments_title_text' );

/**
 * Comments list
 */
function oblique_comments_list() {
	wp_list_comments(
		array(
			'style'       => 'ol',
			'short_ping'  => true,
			'avatar_size' => 60,
		)
	);
}
add_action( 'oblique_comments_list', 'oblique_comments_list' );

/**
 * Migrate logo from theme to core
 */
function oblique_migrate_logo() {
	if ( get_theme_mod( 'site_logo' ) ) {
		$logo = attachment_url_to_postid( get_theme_mod( 'site_logo' ) );
		if ( is_int( $logo ) ) {
			set_theme_mod( 'custom_logo', $logo );
		}
		remove_theme_mod( 'site_logo' );
	}
}
add_action( 'after_setup_theme', 'oblique_migrate_logo' );
/**
 * Footer menu
 */
function oblique_pro_register_footer_menu() {

	register_nav_menus(
		array(
			'footer' => __( 'Footer Menu', 'oblique' ),
		)
	);
}
add_action( 'after_setup_theme', 'oblique_pro_register_footer_menu' );

/**
 * Footer menu
 */
function oblique_pro_footer_menu() {

?>
	<nav id="footernav" class="footer-navigation col-md-6 col-xs-12" role="navigation">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'footer',
				'depth'          => '1',
				'menu_id'        => 'footer-menu',
				'fallback_cb'    => false,
			)
		);
		?>
	</nav><!-- #site-navigation -->
<?php

}
add_action( 'oblique_footer', 'oblique_pro_footer_menu' );

/**
 * Add a dismissible notice in the dashboard about Neve
 */
function oblique_neve_notice() {
	global $current_user;
	$user_id        = $current_user->ID;
	$ignored_notice = get_user_meta( $user_id, 'oblique_ignore_neve_notice' );
	if ( ! empty( $ignored_notice ) ) {
		return;
	}
	$dismiss_button =
		sprintf(
			/* translators: Install Neve link */
			'<a href="%s" class="notice-dismiss" style="text-decoration:none;"></a>',
			'?oblique_nag_ignore_neve=0'
		);
	$message = sprintf(
		/* translators: Install Neve link */
			esc_html__( 'Check out %1$s. Fully AMP optimized and responsive, Neve will load in mere seconds and adapt perfectly on any viewing device. Neve works perfectly with Gutenberg and the most popular page builders. You will love it!', 'oblique' ),
		sprintf(
			/* translators: Install Neve link */
				'<a target="_blank" href="%1$s"><strong>%2$s</strong></a>',
			esc_url( admin_url( 'theme-install.php?theme=neve' ) ),
			esc_html__( 'our newest theme', 'oblique' )
		)
	);
	printf( '<div class="notice updated" style="position:relative;">%1$s<p>%2$s</p></div>', $dismiss_button, $message );
}
add_action( 'admin_notices', 'oblique_neve_notice' );
/**
 * Update the oblique_ignore_hestia_notice option to true, to dismiss the notice from the dashboard
 */
function oblique_nag_ignore_neve() {
	global $current_user;
	$user_id = $current_user->ID;
	/* If user clicks to ignore the notice, add that to their user meta */
	if ( isset( $_GET['oblique_nag_ignore_neve'] ) && '0' == $_GET['oblique_nag_ignore_neve'] ) {
		add_user_meta( $user_id, 'oblique_ignore_neve_notice', 'true', true );
	}
}
add_action( 'admin_init', 'oblique_nag_ignore_neve' );
