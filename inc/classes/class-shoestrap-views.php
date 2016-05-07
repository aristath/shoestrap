<?php

class Shoestrap_Views {

	/**
	 * An array of all available views.
	 *
	 * @access private
	 * @var array
	 */
	private $views = array();

	/**
	 * An instance of the Shoestrap_Template object.
	 *
	 * @access private
	 * @var null|object
	 */
	private $_template = null;

	/**
	 * The constructor.
	 *
	 * @param array $args The arguments for our view.
	 */
	public function __construct( $args = array() ) {

		// Populate views.
		$this->views = $this->add_views();
		// Set the $_template property.
		$this->_template = Shoestrap_Template::get_instance();
		// Add the view.
		$this->add_view( $args );

	}

	/**
	 * Adds the view.
	 *
	 * @param array $args The arguments for our view.
	 */
	private function add_view( $args ) {
		// Early exit if 'tmpl' or 'id' are not set.
		if ( ! isset( $args['tmpl'] ) || ! isset( $args['id'] ) ) {
			return;
		}
		// Early exit if the defined template does not exist.
		if ( ! array_key_exists( $args['tmpl'], $this->views ) ) {
			return;
		}
		$view_args            = $this->views[ $args['tmpl'] ];
		$view_args['tmpl']    = $args['tmpl'];
		$view_args['element'] = '#' . $args['id'];
		$this->_template->add_template( $view_args );
	}

	private function add_views() {

		$views = array(
			// Add template for the header
			'shoestrap-site-header' => array(
				'path'    => locate_template( 'views/site-header.php' ),
				'data'    => array(
					'is_front_page'        => is_front_page(),
					'is_home'              => is_home(),
					'name'                 => get_bloginfo( 'name' ),
					'description'          => get_bloginfo( 'description', 'display' ),
					'url'                  => home_url(),
					'is_customize_preview' => is_customize_preview(),
					'primary_menu_label'   => esc_html__( 'Primary Menu', 'shoestrap' ),
					'menu'                 => Shoestrap_Data_Menu::get_menu( 'primary' ),
				),
			),
			// Add template for single posts
			'shoestrap-single-post' => array(
				'path'    => locate_template( 'views/single.php' ),
			)
		);
		return apply_filters( 'shoestrap/views', $views );
	}

}
