<?php

class Shoestrap_Template {

	/**
	 * @static
	 * @access protected
	 * @var mixed
	 */
	protected static $data;

	/**
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $args;

	/**
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $errors = array();

	/**
	 * @static
	 * @access private
	 */
	private static $instance = null;

	/**
	 * Get a single instance of this class.
	 *
	 * @access public
	 * @return object Shoestrap_Template
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Adds our arguments to the global static $args property.
	 *
	 * @access public
	 * @param    $template_args    array
	 */
	public function add_template( $template_args = array() ) {
		// Add empty defaults.
		// We'll use these to detect errors and properly notify developers.
		$defaults = array(
			'tmpl'    => '',
			'path'    => '',
			'element' => '',
			'data'    => array(),
		);
		$template_args = wp_parse_args( $template_args, $defaults );

		// log errors
		self::error_handler( $template_args );

		// Early exit if we don't have all the required arguments.
		if ( empty( $template_args['tmpl'] ) || empty( $template_args['path'] ) || empty( $template_args['element'] ) || empty( $template_args['data'] ) ) {
			return;
		}
		// Sanitize the 'tmpl' argument
		$template_args['tmpl'] = esc_attr( $template_args['tmpl'] );
		// make sure the path is properly formatted
		$template_args['path'] = wp_normalize_path( $template_args['path'] );
		// Add our template to the global $args var.
		self::$args[ $template_args['tmpl'] ] = $template_args;

	}

	/**
	 * Handles any errors that may occur
	 *
	 * @static
	 * @access protected
	 * @param array
	 */
	protected static function error_handler( $template_args ) {

		foreach ( $template_args as $key => $value ) {
			if ( empty( $value ) ) {
				self::$errors[] = new WP_Error(
					'missing_shoestrap_template_arg' . $key,
					sprintf( esc_html__( 'Missing value for the %s argument when calling Shoestrap_Template::render method.', 'shoestrap' ), $key )
				);
			}
		}

		if ( ! empty( self::$errors ) ) {
			foreach ( self::$errors as $error ) {
				error_log( $error->get_error_message() );
			}
		}

	}

	/**
	 * returns the $args property.
	 *
	 * @access public
	 * @return array
	 */
	public function get_templates() {
		return self::$args;
	}

}
