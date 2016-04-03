<?php

class Shoestrap_Data_Post_Class extends Shoestrap_Data {

	function __construct() {

		parent::$data['post']['class'] = '';
		if ( is_singular() ) {
			parent::$data['post']['class'] = join( ' ', get_post_class() );
		}

	}

}
