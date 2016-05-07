<?php

class Shoestrap_Data_Title extends Shoestrap_Data {

	function __construct() {

		if ( is_singular() ) {
			parent::$data['the_title'] = get_the_title();
		} else {
			parent::$data['the_title'] = get_the_archive_title();
		}

	}

}
