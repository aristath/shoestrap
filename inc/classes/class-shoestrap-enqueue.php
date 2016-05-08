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

		wp_enqueue_script(
			'shoestrap-underscore-templating',
			trailingslashit( get_template_directory_uri() ) . 'assets/js/_templating.js',
			array( 'jquery', 'wp-util' ),
			false,
			true
		);
	}
}
