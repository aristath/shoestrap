<?php
/**
 * Navigation Menu template functions
 *
 * @package Shoestrap
 * @since 1.0
 */

/**
 * Create HTML list of nav menu items.
 *
 * @since 1.0.0
 * @uses Walker
 */
class Shoestrap_Topbar_Menu_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker::start_lvl()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '<ul class="sub-menu menu vertical submenu is-dropdown-submenu" data-submenu>';
	}
}
