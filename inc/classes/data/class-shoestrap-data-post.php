<?php

class Shoestrap_Data_Post extends Shoestrap_Data {

	function __construct() {

		global $post;
		parent::$data['post'] = (array) $post;

		// add permalink
		parent::$data['post']['permalink'] = get_permalink( parent::$data['post']['ID'] );

		// Do not expose the post password.
		if ( isset( parent::$data['post']['post_password'] ) ) {
			unset( parent::$data['post']['post_password'] );
		}
	}
}
