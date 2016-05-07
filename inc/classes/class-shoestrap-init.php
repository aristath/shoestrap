<?php

class Shoestrap_Init {

	public $data;

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'shoestrap/data/before', array( $this, 'add_data' ) );
		add_action( 'wp_print_footer_scripts', array( $this, 'templates_underscore' ), 26 );
		add_action( 'wp_print_footer_scripts', array( $this, 'template_underscore_script' ), 25 );

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

		$templates = Shoestrap_Template::get_instance()->get_templates();

		// Register the script
		wp_register_script( 'shoestrap-underscore-templating', get_template_directory_uri() . '/js/_templating.js', array( 'jquery' ), false, true );

		// Get the global data
		$data = Shoestrap_Data::get_data();

		// Build the array of arguments that will be passed-along to the script
		$shoestrap_data = array(
			'data'      => $data,
			'templates' => $templates,
		);
		?>
		<script type='text/javascript'>
		/* <![CDATA[ */
		var shoestrap = <?php echo json_encode( $shoestrap_data ); ?>;
		/* ]]> */
		</script>
		<?php
	}

	public function templates_underscore() {

		// Early exit if we have no templates to process.
		$_template = Shoestrap_Template::get_instance();
		$templates = $_template->get_templates();
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
