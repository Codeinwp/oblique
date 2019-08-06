<?php
/**
 * Oblique functions and definitions
 *
 * @package Oblique
 */

define( 'OBLIQUE_VERSION', '2.0.19' );

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
	$ignored_notice = get_user_meta( $user_id, 'oblique_ignore_neve_notice_new' );
	if ( ! empty( $ignored_notice ) ) {
		return;
	}
	$should_display_notice = oblique_is_before_date( '2019-09-12' );
	if ( ! $should_display_notice ) {
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
		add_user_meta( $user_id, 'oblique_ignore_neve_notice_new', 'true', true );
	}
}
add_action( 'admin_init', 'oblique_nag_ignore_neve' );

/**
 * Function that decide if current date is before a certain date.
 *
 * @param string $date Date to compare.
 * @return bool
 */
function oblique_is_before_date( $date ) {
	$countdown_time = strtotime( $date );
	$current_time   = time();
	return $current_time <= $countdown_time;
}

/**
 * Retirement notice
 */
function oblique_retirement_notice() {
	global $current_user;
	$user_id        = $current_user->ID;
	$ignored_notice = get_user_meta( $user_id, 'oblique_ignore_retirement_notice' );
	if ( ! empty( $ignored_notice ) ) {
		return;
	}
	$should_display_notice = ! oblique_is_before_date( '2019-09-12' );
	if ( ! $should_display_notice ) {
		return;
	}
	$dismiss_button =
		sprintf(
			/* translators: Install Neve link */
			'<a href="%s" class="notice-dismiss" style="text-decoration:none;"></a>',
			'?oblique_nag_ignore_retirement=0'
		);

	$theme_args = wp_get_theme();
	$name       = $theme_args->__get( 'Name' );

	$notice_template = '
			<div class="nv-notice-wrapper">
			%1$s
			<hr/>
				<div class="nv-notice-column-container">
					<div class="nv-notice-column nv-notice-image">%2$s</div>
					<div class="nv-notice-column nv-notice-starter-sites">%3$s</div>
					<div class="nv-notice-column nv-notice-documentation">%4$s</div>
				</div> 
			</div>
			<style>%5$s</style>';

	/* translators: 1 - notice title, 2 - notice message */
	$notice_header = sprintf(
		'<h2>%1$s</h2><p class="about-description">%2$s</p></hr>',
		esc_html__( 'Your theme is no longer maintained. A New, Modern WordPress Theme is Here!', 'oblique' ),
		sprintf(
			/* translators: %s - theme name */
			esc_html__( '%s is no longer maintained. Switch to Neve today and get more powerful features (for free).', 'oblique' ),
			$name
		)
	);

	$notice_picture = sprintf(
		'<picture>
					<source srcset="about:blank" media="(max-width: 1024px)">
					<img src="%1$s">
				</picture>',
		esc_url( get_template_directory_uri() . '/images/neve.png' )
	);

	$notice_right_side_content = sprintf(
		'<div><h3> %1$s</h3><p>%2$s</p></div>',
		__( 'Switch to Neve today', 'oblique' ),
		// translators: %s - theme name
		esc_html__( 'With Neve you get a super fast, multi-purpose theme, fully AMP optimized and responsive, that works perfectly with Gutenberg and the most popular page builders like Elementor, Beaver Builder, and many more.', 'oblique' )
	);

	$notice_left_side_content = sprintf(
		'<div><h3> %1$s</h3><p>%2$s</p><p class="nv-buttons-wrapper"><a class="button button-hero button-primary" href="%3$s" target="_blank">%4$s</a></p> </div>',
		// translators: %s - theme name
		sprintf( esc_html__( '%s is no longer maintained', 'oblique' ), $name ),
		// translators: %s - theme name
		sprintf( __( 'We\'re saying goodbye to oblique in favor of our more powerful Neve free WordPress theme. This means that there will not be any new features added although we will continue to update the theme for major security issues.', 'oblique' ) ),
		esc_url( admin_url( 'theme-install.php?theme=neve' ) ),
		esc_html__( 'See Neve theme', 'oblique' )
	);

	$style = '
				.nv-notice-wrapper p{
					font-size: 14px;
				}
				.nv-buttons-wrapper {
					padding-top: 20px !important;
				}
				.nv-notice-wrapper h2{
					margin: 0;
					font-size: 21px;
					font-weight: 400;
					line-height: 1.2;
				}
				.nv-notice-wrapper p.about-description{
					color: #72777c;
					font-size: 16px;
					margin: 0;
					padding:0px;
				}
				.nv-notice-wrapper{
					padding: 23px 10px 0;
					max-width: 1500px;
				}
				.nv-notice-wrapper hr {
					margin: 20px -23px 0;
					border-top: 1px solid #f3f4f5;
					border-bottom: none;
				}
				.nv-notice-column-container h3{	
					margin: 17px 0 0;
					font-size: 16px;
					line-height: 1.4;
				}
				.nv-notice-text p.ti-return-dashboard {
					margin-top: 30px;
				}
				.nv-notice-column-container .nv-notice-column{
					 padding-right: 60px;
				} 
				.nv-notice-column-container img{ 
					margin-top: 23px;
					width: 100%;
					border: 1px solid #f3f4f5; 
				} 
				.nv-notice-column-container { 
					display: -ms-grid;
					display: grid;
					-ms-grid-columns: 24% 32% 32%;
					grid-template-columns: 24% 32% 32%;
					margin-bottom: 13px;
				}
				.nv-notice-column-container a.button.button-hero.button-secondary,
				.nv-notice-column-container a.button.button-hero.button-primary{
					margin:0px;
				}
				@media screen and (max-width: 1280px) {
					.nv-notice-wrapper .nv-notice-column-container {
						-ms-grid-columns: 50% 50%;
						grid-template-columns: 50% 50%;
					}
					.nv-notice-column-container a.button.button-hero.button-secondary,
					.nv-notice-column-container a.button.button-hero.button-primary{
						padding:6px 18px;
					}
					.nv-notice-wrapper .nv-notice-image {
						display: none;
					}
				} 
				@media screen and (max-width: 870px) {
					 
					.nv-notice-wrapper .nv-notice-column-container {
						-ms-grid-columns: 100%;
						grid-template-columns: 100%;
					}
					.nv-notice-column-container a.button.button-hero.button-primary{
						padding:12px 36px;
					}
				}
			';

	$message = sprintf(
		$notice_template,
		$notice_header,
		$notice_picture,
		$notice_left_side_content,
		$notice_right_side_content,
		$style
	);// WPCS: XSS OK.

	printf( '<div class="notice updated" style="position:relative; padding-right: 35px;">%1$s<p>%2$s</p></div>', $dismiss_button, $message );
}
add_action( 'admin_notices', 'oblique_retirement_notice' );

/**
 * Update the oblique_ignore_retirement_notice option to true, to dismiss the notice from the dashboard
 */
function oblique_nag_ignore_retirement() {
	global $current_user;
	$user_id = $current_user->ID;
	/* If user clicks to ignore the notice, add that to their user meta */
	if ( isset( $_GET['oblique_nag_ignore_retirement'] ) && '0' == $_GET['oblique_nag_ignore_retirement'] ) {
		add_user_meta( $user_id, 'oblique_ignore_retirement_notice', 'true', true );
	}
}
add_action( 'admin_init', 'oblique_nag_ignore_retirement' );
