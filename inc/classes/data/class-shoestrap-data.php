<?php

class Shoestrap_Data {

	/**
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $data = array();

	/**
	 * Returns the data
	 *
	 * @static
	 * @return  array
	 */
	public static function get_data() {

		do_action( 'shoestrap/data/before' );
		return apply_filters( 'shoestrap/data', self::$data );

	}
}
