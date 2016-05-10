<?php

Shoestrap_Kirki::add_field( array(
	'type'        => 'select',
	'settings'    => 'header_mode',
	'label'       => __( 'Header Mode', 'shoestrap' ),
	'section'     => 'header',
	'default'     => 'top-navbar',
	'priority'    => 10,
	'choices'     => apply_filters( 'shoestrap/settings/header_mode/choices', array(
		'none'       => esc_attr__( 'None', 'shoestrap' ),
		'top-navbar' => esc_attr__( 'Top Navbar', 'shoestrap' ),
		'top-pills'  => esc_attr__( 'Top Pills', 'shoestrap' ),
	)),
));

Shoestrap_Kirki::add_field( array(
	'type'        => 'color',
	'settings'    => 'header_background_color',
	'label'       => __( 'Menu Background', 'shoestrap' ),
	'section'     => 'header',
	'default'     => 'rgba(0,0,0,0)',
	'priority'    => 10,
	'transport'   => 'refresh',
	'choices'     => array(
		'alpha'   => true,
	),
	'output'      => array(
		array(
			'element'  => array(
				'#site-navigation',
				'.top-bar',
				'.top-bar ul.submenu',
				'.is-dropdown-submenu',
			),
			'property' => 'background',
		),
	),
));

Shoestrap_Kirki::add_field( array(
	'type'        => 'dashicons',
	'settings'    => 'nav_pills_align',
	'label'       => __( 'Pills alignment', 'shoestrap' ),
	'section'     => 'header',
	'default'     => 'center',
	'priority'    => 10,
	'choices'     => array(
		'left'    => 'editor-alignleft',
		'center'  => 'editor-aligncenter',
		'right'   => 'editor-alignright',
	),
));

Shoestrap_Kirki::add_field( array(
	'type'        => 'spacing',
	'settings'    => 'main_nav_margins',
	'label'       => __( 'Navigation Top & Bottom Margins', 'shoestrap' ),
	'section'     => 'header',
	'transport'   => 'auto',
	'default'     => array(
		'top'     => '1.5rem',
		'bottom'  => '1.5rem',
	),
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => array(
				'#site-main-nav-pills',
				'#site-main-nav-navbar'
			),
			'property' => 'margin',
		),
	),
) );
