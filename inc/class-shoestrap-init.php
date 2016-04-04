<?php

class Shoestrap_Init {

	public $data;

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'shoestrap/data/before', array( $this, 'add_data' ) );
		add_action( 'wp_footer', array( $this, 'templates_underscore' ), 26 );
		add_action( 'wp_enqueue_scripts', array( $this, 'template_underscore_script' ), 25 );

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

	public function template_underscore_script() {
		// Early exit if we have no templates to process.
		$templates = shoestrap_templates()->get_templates();
		if ( empty( $templates ) ) {
			// return;
		}

		// Register the script
		wp_register_script( 'shoestrap-underscore-templating', get_template_directory_uri() . '/js/_templating.js', array( 'jquery' ), false, true );

		// Get the global data
		$data = Shoestrap_Data::get_data();

		// Build the array of arguments that will be passed-along to the script
		$shoestrap_data = array(
			'global_data' => $data,
			'templates'   => $templates,
		);

		// pass our data to the script using the wp_localize_script function
		wp_localize_script( 'shoestrap-underscore-templating', 'shoestrap', $shoestrap_data );

		// Enqueued script with localized data.
		wp_enqueue_script( 'shoestrap-underscore-templating' );

	}

	public function templates_underscore() {

		// Early exit if we have no templates to process.
		$templates = shoestrap_templates()->get_templates();
		if ( empty( $templates ) ) {
			return;
		}
		foreach ( $templates as $tmpl => $args ) {
			if ( file_exists( $args['path'] ) ) {
				echo '<script type="text/html" id="tmpl-' . $tmpl . '">';
				include $args['path'];
				echo '</script>';
			}
		}

	}

}
