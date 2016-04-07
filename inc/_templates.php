<?php

// Instantiate the templates class
$_template = Shoestrap_Template::get_instance();

// Add template for the header
$_template->add_template( array(
	'tmpl'    => 'shoestrap-site-header',
	'path'    => locate_template( 'views/site-header.php' ),
	'element' => '#masthead',
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
) );

// Add template for single posts
$_template->add_template( array(
	'tmpl'    => 'shoestrap-single-post',
	'path'    => locate_template( 'views/single.php' ),
	'element' => '#main.site-main',
) );
