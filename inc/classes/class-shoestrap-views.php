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
	 * The constructor.
	 *
	 * @param array $args The arguments for our view.
	 */
	public function __construct( $args = array() ) {

		// Populate views.
		$this->views = $this->add_views();

		// Add the view.
		$this->add_from_view( $args );

	}

	/**
	 * Renders a template element and adds the necessary views.
	 *
	 * @static
	 * @access public
	 * @param string $element The element to be rendered.
	 * @param array  $args    The element arguments.
	 * @return void
	 */
	public static function add_view( $element = 'div', $args = array() ) {
		$properties = array();
		foreach ( $args as $key => $value ) {
			if ( 'tmpl' === $key ) {
				continue;
			}
			$properties[] = $key . '="' . $value . '"';
		}
		echo '<' . $element . ' ' . implode( ' ', $properties ) . '></' . $element . '>';
		new self( $args );
	}

	/**
	 * Adds the view.
	 *
	 * @param array $args The arguments for our view.
	 */
	private function add_from_view( $args ) {

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

		Shoestrap_Template::get_instance()->add_template( $view_args );

	}

	private function add_views() {

		$views = array(
			// Add template for the header
			'shoestrap-site-header' => array(
				'path'    => locate_template( 'views/header/simple.php' ),
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
