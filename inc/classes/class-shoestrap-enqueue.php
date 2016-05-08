<?php

class Shoestrap_Enqueue {

	/**
	 * The constructor.
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

	}

	/**
	 * Enqueue scrips.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_script(
			'shoestrap-underscore-templating',
			trailingslashit( get_template_directory_uri() ) . 'assets/js/_templating.js',
			array( 'jquery', 'wp-util' ),
			false,
			true
		);
	}
}
