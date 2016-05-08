<?php
/**
 * Shoestrap functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Shoestrap
 */

/**
 * Load autoloader file.
 */
require get_template_directory() . '/inc/autoloader.php';

/**
 * Init the theme
 */
new Shoestrap_Init();

if ( ! function_exists( 'shoestrap_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function shoestrap_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Shoestrap, use a find and replace
	 * to change 'shoestrap' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'shoestrap', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'shoestrap' ),
	) );
}
endif;
add_action( 'after_setup_theme', 'shoestrap_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shoestrap_content_width() {

	// Get the maximum site-width.
	$site_width = get_theme_mod( 'content_max_width', '85rem' );

	// Calculate the site-width in pixels making some reasonable assumptions.
	$width = 1200;
	if ( false !== strpos( $site_width, 'em' ) ) {
		$width = absint( $site_width ) * 16;
	} elseif ( false !== strpos( $site_width, 'px' ) ) {
		$width = absint( $site_width );
	}

	// Make sure the site-width is between 640 & 1600.
	$width = min( 1600, max( 640, $width ) );

	// Calculate the main content area without the sidebar.
	$columns = get_theme_mod( 'content_columns_width', 8 );
	if ( 12 > $columns ) {
		$width = absint( ( $columns / 12 ) * $width - 30 );
	}
	// Set the content_width global.
	$GLOBALS['content_width'] = apply_filters( 'shoestrap_content_width', $width );
}
add_action( 'after_setup_theme', 'shoestrap_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shoestrap_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'shoestrap' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'shoestrap' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header', 'shoestrap' ),
		'id'            => 'header-1',
		'description'   => esc_html__( 'Add header widgets here.', 'shoestrap' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'shoestrap_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function shoestrap_scripts() {
	wp_enqueue_style(
		'shoestrap-style',
		get_stylesheet_uri()
	);
	wp_enqueue_style(
		'shoestrap-app',
		trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/app.css'
	);
	wp_enqueue_script(
		'shoestrap-skip-link-focus-fix',
		trailingslashit( get_template_directory_uri() ) . 'assets/js/skip-link-focus-fix.js',
		array(),
		false,
		true
	);
	wp_enqueue_script(
		'foundation6',
		trailingslashit( get_template_directory_uri() ) . 'assets/js/foundation.js',
		array(),
		false,
		true
	);
	wp_enqueue_script(
		'shoestrap-app',
		trailingslashit( get_template_directory_uri() ) . 'assets/js/app.js',
		array( 'jquery', 'foundation6' ),
		false,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'shoestrap_scripts' );

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
 * Recommend installing Kirki.
 */
require get_template_directory() . '/inc/include-kirki.php';
