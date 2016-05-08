<?php

class Shoestrap_Data_Post extends Shoestrap_Data {

	function __construct() {

		global $post;
		parent::$data['post'] = (array) $post;

		// Process shortcodes in the content and excerpt.
		parent::$data['post']['post_content'] = do_shortcode( parent::$data['post']['post_content'] );
		parent::$data['post']['post_excerpt'] = do_shortcode( parent::$data['post']['post_excerpt'] );

		// add permalink
		parent::$data['post']['permalink'] = get_permalink( parent::$data['post']['ID'] );

		// Do not expose the post password.
		if ( isset( parent::$data['post']['post_password'] ) ) {
			unset( parent::$data['post']['post_password'] );
		}
	}
}
