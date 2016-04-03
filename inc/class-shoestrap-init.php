<?php

class Shoestrap_Init {

	public $data;

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'shoestrap/data/before', array( $this, 'add_data' ) );
		add_action( 'wp_footer', array( $this, 'templates_underscore' ), 26 );
		add_action( 'wp_footer', array( $this, 'template_underscore_script' ), 25 );

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
		var_dump( $this->data );
	}

	public function template_underscore_script() {
		// Early exit if we have no templates to process.
		$templates = shoestrap_templates()->get_templates();
		if ( empty( $templates ) ) {
			return;
		}
		$data = Shoestrap_Data::get_data();
		?>
		<script type="text/javascript">
			jQuery( document ).ready( function() {
				<?php foreach ( $templates as $tmpl => $args ) : ?>
					var post_template = wp.template( '<?php echo $tmpl; ?>' );
					jQuery( '<?php echo $args['element']; ?>' ).append( post_template( <?php echo wp_json_encode( $data ); ?> ) );
				<?php endforeach; ?>
			} );
		</script>
		<?php
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
