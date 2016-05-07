<?php

class Shoestrap {

	/**
	 * Renders a template element and adds the necessary views.
	 *
	 * @static
	 * @access public
	 * @param string $element The element to be rendered.
	 * @param array  $args    The element arguments.
	 * @return void
	 */
	public static function add_view( $element = 'div', $args = array() ) {
		$properties = array();
		foreach ( $args as $key => $value ) {
			if ( 'tmpl' === $key ) {
				continue;
			}
			$properties[] = $key . '="' . $value . '"';
		}
		echo '<' . $element . ' ' . implode( ' ', $properties ) . '></' . $element . '>';
		new Shoestrap_Views( $args );
	}
}
