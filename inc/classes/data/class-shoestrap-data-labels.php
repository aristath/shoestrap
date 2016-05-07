<?php

class Shoestrap_Data_Post extends Shoestrap_Data {

	function __construct() {

		parent::$data['labels'] = apply_filters( 'shoestrap/data/labels', array(
			'primary_menu_label' => esc_html__( 'Primary Menu', 'shoestrap' ),
		));

	}

}
