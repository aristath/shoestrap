<?php

class Shoestrap_Init {

	/**
	 * The constructor.
	 */
	public function __construct() {

		// Instantiates the Kirki_Enqueue object.
		new Shoestrap_Enqueue();

		// Apply filters to menus.
		new Shoestrap_Menu_Filters();

		// Adjust the content-width.
		add_action( 'after_setup_theme', array( $this, 'content_width' ), 0 );

		// Load the theme's textdomain.
		add_action( 'after_setup_theme', array( $this, 'load_theme_textdomain' ) );

		// Register navigation menus.
		add_action( 'after_setup_theme', array( $this, 'register_nav_menus' ) );

		// Add theme supports.
		add_action( 'after_setup_theme', array( $this, 'add_theme_supports' ) );

		// Register widget areas.
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );

	}

	/**
	 * Registers the Menus.
	 *
	 * @access public
	 */
	public function register_nav_menus() {

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'shoestrap' ),
		) );

	}

	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 *
	 * @access public
	 */
	public function load_theme_textdomain() {

		load_theme_textdomain( 'shoestrap', get_template_directory() . '/languages' );

	}

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @access public
	 * @global int $content_width
	 */
	public function content_width() {
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

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @access public
	 */
	public function add_theme_supports() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'shoestrap_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Enable logo support.
		add_theme_support( 'custom-logo', array(
			'flex-width' => true,
		) );
	}

	/**
	 * Register widget area.
	 *
	 * @access public
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	public function widgets_init() {
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
}
