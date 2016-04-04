<?php

class Shoestrap_Data_Menu extends Shoestrap_Data {

	public static function get_menu( $menu ) {
		$_menu = get_nav_menu_locations( $menu );
		$menu_items = wp_get_nav_menu_items( $_menu[ $menu ] );
		$menu_items = (array) $menu_items;
		$menu_final = array();
		foreach ( $menu_items as $key => $item ) {
			$item = (array) $item;
			$menu_final[ $item['ID'] ] = array(
				'id'        => $item['ID'],
				'title'     => $item['title'],
				'url'       => $item['url'],
				'parent'    => $item['menu_item_parent'],
				'object_id' => $item['object_id'],
			);
		}
		return $menu_final;
	}

}
