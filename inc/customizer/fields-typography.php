<?php

Shoestrap_Kirki::add_field( array(
	'type'        => 'typography',
	'settings'    => 'body_typography',
	'label'       => esc_attr__( 'Body Typography', 'shoestrap' ),
	'description' => esc_attr__( 'Select the main typography options for your site.', 'shoestrap' ),
	'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'shoestrap' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => 'regular',
		'font-size'      => '1rem',
		'line-height'    => '1.5',
	),
	'output' => array(
		array(
			'element' => 'body',
		),
	),
	'transport' => 'auto',
) );

Shoestrap_Kirki::add_field( array(
	'type'        => 'typography',
	'settings'    => 'headers_typography',
	'label'       => esc_attr__( 'Headers Typography', 'shoestrap' ),
	'description' => esc_attr__( 'Select the typography options for your headers.', 'shoestrap' ),
	'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'shoestrap' ),
	'section'     => 'typography',
	'priority'    => 10,
	'default'     => array(
		'font-family'    => 'Roboto',
		'variant'        => '500',
	),
	'output' => array(
		array(
			'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.h1', '.h2', '.h3', '.h4', '.h5', '.h6' ),
		),
	),
	'transport' => 'auto',
) );
