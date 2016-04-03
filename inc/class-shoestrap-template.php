<?php

class Shoestrap_Template {

	public $args = array();

	public function __construct( $args = array() ) {

		$defaults = array(
			'id'       => 'content',
			'template' => locate_template( 'views/content.php' ),
			'data'     => Shoestrap_Data::get_data(),
			'element'  => '.site-content',
		);
		$args = wp_parse_args( $args, $defaults );
		$this->args = $args;

		add_action( 'wp_footer', array( $this, 'add_template' ), 26 );
		add_action( 'wp_footer', array( $this, 'add_post_template' ), 25 );

	}

	public function add_post_template() { ?>
		<script type="text/javascript">
			jQuery( document ).ready( function() {
				var post_template = wp.template( '<?php echo $this->args['id']; ?>' );
				jQuery( '<?php echo $this->args['element']; ?>' ).append( post_template( <?php echo wp_json_encode( $this->args['data'] ); ?> ) );
			} );
		</script>
		<?php
	}

	public function add_template() {
		echo '<script type="text/html" id="tmpl-' . $this->args['id'] . '">';
		include $this->args['template'];
		echo '</script>';
	}

}
