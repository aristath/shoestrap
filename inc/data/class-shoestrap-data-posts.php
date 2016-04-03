<?php

class Shoestrap_Data_Posts extends Shoestrap_Data {

	function __construct() {

		global $wp_query;
		parent::$data['posts'] = (array) $wp_query->posts;

		// add permalinks
		foreach ( parent::$data['posts'] as $key => $post_data ) {
			parent::$data['posts'][ $key ] = (array) $post_data;
			parent::$data['posts'][ $key ]['permalink'] = get_permalink( parent::$data['posts'][ $key ]['ID'] );
		}

	}

}
