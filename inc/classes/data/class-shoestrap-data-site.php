<?php

class Shoestrap_Data_Site extends Shoestrap_Data {

	function __construct() {

		parent::$data['site'] = array(
			'id'                   => get_current_blog_id(),
			'site_url'             => site_url(),
			'description'          => get_bloginfo( 'description', 'display' ),
			'rdf_url'              => get_bloginfo( 'rdf_url' ),
			'rss_url'              => get_bloginfo( 'rss_url' ),
			'rss2_url'             => get_bloginfo( 'rss2_url' ),
			'atom_url'             => get_bloginfo( 'atom_url' ),
			'comments_atom_url'    => get_bloginfo( 'comments_atom_url' ),
			'comments_rss2_url'    => get_bloginfo( 'comments_rss2_url' ),
			'pingback_url'         => get_bloginfo( 'pingback_url' ),
			'template_url'         => get_template_directory_uri(),
			'charset'              => get_bloginfo( 'charset' ),
			'html_type'            => get_bloginfo( 'html_type' ),
			'version'              => get_bloginfo( 'version' ),
			'language'             => get_bloginfo( 'language' ),
			'name'                 => get_bloginfo( 'name' ),
			'is_customize_preview' => is_customize_preview(),
		);

	}

}
