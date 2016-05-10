<?php

class Shoestrap_Enqueue {

	/**
	 * The constructor.
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

	}

	/**
	 * Enqueue scrips & styles.
	 *
	 * @access public
	 */
	public function enqueue() {

		/**
		 * Enqueue the theme's styles.css.
		 * This is recommended because we can add inline styles there
		 * and some plugins use it to do exactly that.
		 */
		wp_enqueue_style(
			'shoestrap-style',
			get_stylesheet_uri()
		);

		/**
		 * Enqueue app.css stylesheet.
		 * Includes foundation CSS.
		 */
		wp_enqueue_style(
			'shoestrap-app',
			trailingslashit( get_template_directory_uri() ) . 'assets/css/app.css'
		);
		/**
		 * Load header styles if they exist.
		 */
		$header_mode = get_theme_mod( 'header_mode', 'top-navbar' );
		$url = false;
		if ( is_child_theme() ) {
			$path = wp_normalize_path( get_stylesheet_directory() . 'assets/css/header-' . $header_mode . '.css' );
			if ( file_exists( $path ) ) {
				$url = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/header-' . $header_mode . '.css';
			}
		}
		if ( ! $url ) {
			$path = wp_normalize_path( get_template_directory() . 'assets/css/header-' . $header_mode . '.css' );
			if ( file_exists( $path ) ) {
				$url = trailingslashit( get_template_directory_uri() ) . 'assets/css/header-' . $header_mode . '.css';
			}
		}
		if ( $url ) {
			wp_enqueue_style( 'shoestrap-header-' . $header_mode, $url );
		}

		/**
		 * Enqueue skip-link-focus-fix.
		 * Necessary for accessibility purposes.
		 */
		wp_enqueue_script(
			'shoestrap-skip-link-focus-fix',
			trailingslashit( get_template_directory_uri() ) . 'assets/js/skip-link-focus-fix.js',
			array(),
			false,
			true
		);

		/**
		 * Enqueue Foundation-6 JS.
		 */
		wp_enqueue_script(
			'foundation6',
			trailingslashit( get_template_directory_uri() ) . 'assets/js/foundation.js',
			array(),
			false,
			true
		);

		/**
		 * Enqueue shoestrap JS.
		 */
		wp_enqueue_script(
			'shoestrap-app',
			trailingslashit( get_template_directory_uri() ) . 'assets/js/app.js',
			array( 'jquery', 'foundation6' ),
			false,
			true
		);

		/**
		 * The comment-reply script.
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/**
		 * Enqueue script handling the underscore.js templating system.
		 */
		wp_enqueue_script(
			'shoestrap-underscore-templating',
			trailingslashit( get_template_directory_uri() ) . 'assets/js/_templating.js',
			array( 'jquery', 'wp-util' ),
			false,
			true
		);
	}
}
