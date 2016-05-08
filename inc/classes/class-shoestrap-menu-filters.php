<?php

class Shoestrap_Menu_Filters {

	/**
	 * Constructor.
	 * Apply filters.
	 *
	 * @access public
	 */
	public function __construct() {

		add_filter( 'nav_menu_css_class' , array( $this, 'nav_menu_css_class' ) , 10 , 4 );
		add_filter( 'wp_nav_menu', array( $this, 'wp_nav_menu' ), 10, 2 );

	}

	/**
	 * Filter the CSS class(es) applied to a menu item's list item element.
	 *
	 * @access public
	 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
	 * @param object $item    The current menu item.
	 * @param array  $args    An array of wp_nav_menu() arguments.
	 * @param int    $depth   Depth of menu item. Used for padding.
	 * @return string
	 */
	public function nav_menu_css_class( $classes, $item, $args, $depth ) {
		foreach( array( 'current-menu-item', 'current-menu-ancestor', 'current-menu-parent') as $class ) {
			if ( in_array( $class, $classes ) ) {
				$classes[] = 'active';
			}
		}
		return $classes;
	}

	/**
	 * Filter the HTML content for navigation menus.
	 *
	 * @access public
	 * @see wp_nav_menu()
	 * @param string $nav_menu The HTML content for the navigation menu.
	 * @param object $args     An object containing wp_nav_menu() arguments.
	 * @return string
	 */
	public function wp_nav_menu( $nav_menu, $args ) {
		return str_replace(
			array(
				"\t",   // Tabs.
				"\r\n", // New lines.
			),
			'',
			$nav_menu
		);
	}
}
