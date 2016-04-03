<?php

class Shoestrap_Init {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'shoestrap/data/before', array( $this, 'add_data' ) );
	}

	public function enqueue() {
		wp_enqueue_script( 'wp-util' );
	}

	public function add_data() {
		new Shoestrap_Data_Site();
		new Shoestrap_Data_Conditionals();
		new Shoestrap_Data_Post();
		new Shoestrap_Data_Posts();
		new Shoestrap_Data_Post_Class();
		new Shoestrap_Data_Title();
	}

}
