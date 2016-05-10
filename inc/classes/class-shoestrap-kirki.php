<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This is a wrapper class for Kirki.
 * If the Kirki plugin is installed, then all CSS & Google fonts
 * will be handled by the plugin.
 * In case the plugin is not installed, this acts as a fallback
 * ensuring that all CSS & fonts still work.
 * It does not handle the customizer options, simply the frontend CSS.
 */
class Shoestrap_Kirki {

	/**
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $config = array();

	/**
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $fields = array();

	/**
	 * The class constructor
	 */
	public function __construct() {
		// If Kirki exists then there's no reason to procedd
		if ( class_exists( 'Kirki' ) ) {
			return;
		}
		// Add our CSS
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		// Add google fonts
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_fonts' ) );
	}

	/**
	 * Create a new panel
	 *
	 * @param   string      the ID for this panel
	 * @param   array       the panel arguments
	 */
	public static function add_panel( $id = '', $args = array() ) {
		if ( class_exists( 'Kirki' ) ) {
			Kirki::add_panel( $id, $args );
		}
		// If Kirki does not exist then there's no reason to add any panels.
	}

	/**
	 * Create a new section
	 *
	 * @param   string      the ID for this section
	 * @param   array       the section arguments
	 */
	public static function add_section( $id, $args ) {
		if ( class_exists( 'Kirki' ) ) {
			Kirki::add_section( $id, $args );
		}
		// If Kirki does not exist then there's no reason to add any sections.
	}


	/**
	 * Sets the configuration options.
	 *
	 * @param    string    $config_id    The configuration ID
	 * @param    array     $args         The configuration arguments
	 */
	public static function add_config( $config_id, $args = array() ) {
		// if Kirki exists, use it.
		if ( class_exists( 'Kirki' ) ) {
			if ( isset( $args['settings'] ) ) {
				foreach ( $args as $arg_id => $arg_params ) {
					$args[ $arg_id ] = apply_filters( 'shoestrap/settings/' . $args['settings'] . '/' . $arg_id, $arg_params );
				}
			}
			Kirki::add_config( $config_id, $args );
			return;
		}
		// Kirki does not exist, set the config arguments
		$config[ $config_id ] = $args;
		// Make sure an option_type is defined
		if ( ! isset( self::$config[ $config_id ]['option_type'] ) ) {
			self::$config[ $config_id ]['option_type'] = 'theme_mod';
		}
	}

	/**
	 * Create a new field
	 *
	 * @param    string    $config_id    The configuration ID
	 * @param    array     $args         The field's arguments
	 */
	public static function add_field( $args ) {

		// if Kirki exists, use it.
		if ( class_exists( 'Kirki' ) ) {
			Kirki::add_field( 'shoestrap', $args );
			return;
		}

		// Kirki was not located, so we'll need to add our fields here.
		// check that the "settings" & "type" arguments have been defined
		if ( isset( $args['settings'] ) && isset( $args['type'] ) ) {

			// Make sure we add the config_id to the field itself.
			// This will make it easier to get the value when generating the CSS later.
			if ( ! isset( $args['kirki_config'] ) ) {
				$args['kirki_config'] = 'shoestrap';
			}
			self::$fields[ $args['settings'] ] = $args;
		}
	}

	/**
	 * Enqueues the stylesheet
	 */
	public function enqueue_styles() {
		// If Kirki exists there's no need to proceed any further
		if ( class_exists( 'Kirki' ) ) {
			return;
		}
		// Get our inline styles
		$styles = $this->get_styles();
		// If we have some styles to add, add them now.
		if ( ! empty( $styles ) ) {
			// enqueue the theme's style.css file
			$current_theme = ( wp_get_theme() );
			wp_enqueue_style( $current_theme->stylesheet . '_no-kirki', get_stylesheet_uri(), null, null );
			wp_add_inline_style( $current_theme->stylesheet . '_no-kirki', $styles );
		}
	}

	/**
	 * Gets all our styles and returns them as a string.
	 */
	public function get_styles() {

		// Get an array of all our fields
		$fields = self::$fields;

		// Check if we need to exit early
		if ( empty( self::$fields ) || ! is_array( $fields ) ) {
			return;
		}

		// initially we're going to format our styles as an array.
		// This is going to make processing them a lot easier
		// and make sure there are no duplicate styles etc.
		$css = array();

		// start parsing our fields
		foreach ( $fields as $field ) {

			// No need to process fields without an output, or an improperly-formatted output
			if ( ! isset( $field['output'] ) || empty( $field['output'] ) || ! is_array( $field['output'] ) ) {
				continue;
			}

			// Get the value of this field
			$value = get_theme_mod( $field['settings'], $field['default'] );

			// start parsing the output arguments of the field
			foreach ( $field['output'] as $output ) {
				$defaults = array(
					'element'       => '',
					'property'      => '',
					'media_query'   => 'global',
					'prefix'        => '',
					'units'         => '',
					'suffix'        => '',
					'value_pattern' => '$',
				);
				$output = wp_parse_args( $output, $defaults );

				// If element is an array, convert it to a string
				if ( is_array( $output['element'] ) ) {
					$output['element'] = array_unique( $output['element'] );
					sort( $output['element'] );
					$output['element'] = implode( ',', $output['element'] );
				}

				// Simple fields
				if ( ! is_array( $value ) ) {
					$value = str_replace( '$', $value, $output['value_pattern'] );
					if ( ! empty( $output['element'] ) && ! empty( $output['property'] ) ) {
						$css[ $output['media_query'] ][ $output['element'] ][ $output['property'] ] = $output['prefix'] . $value . $output['units'] . $output['suffix'];
					}
				} else {
					if ( 'typography' == $field['type'] ) {
						foreach ( $value as $key => $subvalue ) {

							// add double quotes if needed to font-families
							if ( 'font-family' == $key && false !== strpos( $subvalue, ' ' ) && false === strpos( $subvalue, '"' ) ) {
								$css[ $output['media_query'] ][ $output['element'] ]['font-family'] = '"' . $subvalue . '"';
							}

							// variants contain both font-weight & italics
							if ( 'variant' == $key ) {
								$font_weight = str_replace( 'italic', '', $subvalue );
								$font_weight = ( in_array( $font_weight, array( '', 'regular' ) ) ) ? '400' : $font_weight;

								// Is this italic?
								$is_italic = ( false !== strpos( $subvalue, 'italic' ) );
								$styles[ $output['media_query'] ][ $output['element'] ]['font-weight'] = $font_weight;
								if ( $is_italic ) {
									$styles[ $output['media_query'] ][ $output['element'] ]['font-style'] = 'italic';
								}
							} else {
								$css[ $output['media_query'] ][ $output['element'] ][ $key ] = $subvalue;
							}
						}
					} elseif ( 'spacing' == $field['type'] ) {
						foreach ( $value as $key => $subvalue ) {
							if ( empty( $output['property'] ) ) {
								$output['property'] = $key;
							} elseif ( false !== strpos( $output['property'], '%%' ) ) {
								$output['property'] = str_replace( '%%', $key, $output['property'] );
							} else {
								$output['property'] = $output['property'] . '-' . $key;
							}
							$css[ $output['media_query'] ][ $output['element'] ][ $output['property'] ] = $subvalue;
						}
					}
				}
			}
		}

		// Process the array of CSS properties and produce the final CSS
		$final_css = '';
		if ( ! is_array( $css ) || empty( $css ) ) {
			return '';
		}

		// Parse the generated CSS array and create the CSS string for the output.
		foreach ( $css as $media_query => $styles ) {

			// Handle the media queries
			$final_css .= ( 'global' != $media_query ) ? $media_query . '{' : '';
			foreach ( $styles as $style => $style_array ) {
				$final_css .= $style . '{';
					foreach ( $style_array as $property => $value ) {
						$value = ( is_string( $value ) ) ? $value : '';

						// Make sure background-images are properly formatted
						if ( 'background-image' == $property ) {
							if ( false === strrpos( $value, 'url(' ) ) {
								$value = 'url("' . esc_url_raw( $value ) . '")';
							}
						} else {
							$value = esc_textarea( $value );
						}
						$final_css .= $property . ':' . $value . ';';
					}
				$final_css .= '}';
			}
			$final_css .= ( 'global' != $media_query ) ? '}' : '';
		}
		return $final_css;
	}

	public function enqueue_fonts() {

		// Check if we need to exit early
		if ( empty( self::$fields ) || ! is_array( self::$fields ) ) {
			return;
		}
		foreach ( self::$fields as $field ) {

			// Process typography fields
			if ( isset( $field['type'] ) && 'typography' == $field['type'] ) {

				// Check if we've got everything we need
				if ( ! isset( $field['kirki_config'] ) || ! isset( $field['settings'] ) ) {
					continue;
				}
				$value = self::get_option( $field['kirki_config'], $field['settings'] );
				if ( isset( $value['font-family'] ) ) {
					$url = '//fonts.googleapis.com/css?family=' . str_replace( ' ', '+', $value['font-family'] );
					if ( ! isset( $value['variant'] ) ) {
						$value['variant'] = '';
					}
					if ( ! empty( $value['variant'] ) ) {
						$url .= ':' . $value['variant'];
					}
					if ( ! isset( $value['subset'] ) ) {
						$value['subset'] = '';
					}
					if ( ! empty( $value['subset'] ) ) {
						if ( is_array( $value['subset'] ) ) {
							$value['subset'] = implode( ',', $value['subsets'] );
						}
						$url .= '&subset=' . $value['subset'];
					}
					$key = md5( $value['font-family'] . $value['variant'] . $value['subset'] );

					// check that the URL is valid. we're going to use transients to make this faster.
					$url_is_valid = get_transient( $key );
					if ( false === $url_is_valid ) { // transient does not exist
						$response = wp_remote_get( 'https:' . $url );
						if ( ! is_array( $response ) ) {

							// the url was not properly formatted,
							// cache for 12 hours and continue to the next field
							set_transient( $key, null, 12 * HOUR_IN_SECONDS );
							continue;
						}

						// check the response headers.
						if ( isset( $response['response'] ) && isset( $response['response']['code'] ) ) {
							if ( 200 == $response['response']['code'] ) {

								// URL was ok
								// set transient to true and cache for a week
								set_transient( $key, true, 7 * 24 * HOUR_IN_SECONDS );
								$url_is_valid = true;
							}
						}
					}

					// If the font-link is valid, enqueue it.
					if ( $url_is_valid ) {
						wp_enqueue_style( $key, $url, null, null );
					}
				}
			}
		}
	}
}
new Shoestrap_Kirki();
