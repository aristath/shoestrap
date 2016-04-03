<?php

class Shoestrap_Data_Site extends Shoestrap_Data {

	function __construct() {

		parent::$data['site'] = array(
			'id'                   => get_current_blog_id(),
			'url'                  => get_bloginfo( 'url' ),
			'wpurl'                => get_bloginfo( 'wpurl' ),
			'description'          => get_bloginfo( 'description', 'display' ),
			'rdf_url'              => get_bloginfo( 'rdf_url' ),
			'rss_url'              => get_bloginfo( 'rss_url' ),
			'rss2_url'             => get_bloginfo( 'rss2_url' ),
			'atom_url'             => get_bloginfo( 'atom_url' ),
			'comments_atom_url'    => get_bloginfo( 'comments_atom_url' ),
			'comments_rss2_url'    => get_bloginfo( 'comments_rss2_url' ),
			'pingback_url'         => get_bloginfo( 'pingback_url' ),
			'stylesheet_url'       => get_bloginfo( 'stylesheet_url' ),
			// 'stylesheet_directory' => get_bloginfo( 'stylesheet_directory' ),
			// 'template_directory'   => get_bloginfo( 'template_directory' ),
			'template_url'         => get_bloginfo( 'template_url' ),
			// 'admin_email'          => get_bloginfo( 'admin_email' ),
			'charset'              => get_bloginfo( 'charset' ),
			'html_type'            => get_bloginfo( 'html_type' ),
			'version'              => get_bloginfo( 'version' ),
			'language'             => get_bloginfo( 'language' ),
			'name'                 => get_bloginfo( 'name' ),
		);

	}

}
