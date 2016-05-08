<?php

class Shoestrap_Template {

	/**
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $args;

	/**
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $errors = array();

	/**
	 * @static
	 * @access private
	 */
	private static $instance = null;

	/**
	 * The constructor.
	 *
	 * @access private
	 */
	private function __construct() {

		add_action( 'shoestrap/data/before', array( $this, 'add_data' ) );
		add_action( 'wp_print_footer_scripts', array( $this, 'templates_underscore' ), 26 );
		add_action( 'wp_print_footer_scripts', array( $this, 'template_underscore_script' ), 25 );

	}

	/**
	 * Get a single instance of this class.
	 *
	 * @access public
	 * @return object Shoestrap_Template
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Instantiates the data classes.
	 *
	 * @access public
	 */
	public function add_data() {

		new Shoestrap_Data_Site();
		new Shoestrap_Data_Conditionals();
		new Shoestrap_Data_Post();
		new Shoestrap_Data_Posts();
		new Shoestrap_Data_Post_Class();
		new Shoestrap_Data_Title();

	}

	/**
	 * Adds our arguments to the global static $args property.
	 *
	 * @access public
	 * @param    $template_args    array
	 */
	public function add_template( $template_args = array() ) {

		// Add empty defaults.
		// We'll use these to detect errors and properly notify developers.
		$defaults = array(
			'tmpl'    => '',
			'path'    => '',
			'element' => '',
		);
		$template_args = wp_parse_args( $template_args, $defaults );

		// log errors
		self::error_handler( $template_args );

		// Early exit if we don't have all the required arguments.
		if ( empty( $template_args['tmpl'] ) || empty( $template_args['path'] ) || empty( $template_args['element'] ) ) {
			return;
		}

		// Sanitize the 'tmpl' argument
		$template_args['tmpl'] = esc_attr( $template_args['tmpl'] );

		// make sure the path is properly formatted
		$template_args['path'] = wp_normalize_path( $template_args['path'] );

		// If no data has been defined, set it to false
		if ( ! isset( $template_args['data'] ) || empty( $template_args['data'] ) ) {
			$template_args['data'] = false;
		}

		// Add our template to the global $args var.
		self::$args[ $template_args['tmpl'] ] = $template_args;

	}

	/**
	 * Handles any errors that may occur
	 *
	 * @static
	 * @access protected
	 * @param array
	 */
	protected static function error_handler( $template_args ) {

		foreach ( $template_args as $key => $value ) {
			if ( empty( $value ) ) {
				self::$errors[] = new WP_Error(
					'missing_shoestrap_template_arg' . $key,
					sprintf( esc_html__( 'Missing value for the %s argument when calling Shoestrap_Template::render method.', 'shoestrap' ), $key )
				);
			}
		}

		if ( ! empty( self::$errors ) ) {
			foreach ( self::$errors as $error ) {
				error_log( $error->get_error_message() );
			}
		}
	}

	/**
	 * returns the $args property.
	 *
	 * @access public
	 * @return array
	 */
	public function get_templates() {
		return self::$args;
	}

	/**
	 * Generates the script responsible for handling our underscore.js templates.
	 *
	 * @access public
	 */
	public function template_underscore_script() {

		$templates = Shoestrap_Template::get_instance()->get_templates();

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

	/**
	 * Adds our underscore.js templates.
	 *
	 * @access public
	 */
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
