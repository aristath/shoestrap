<?php

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
				'.top-bar',
				'.top-bar ul.submenu',
			),
			'property' => 'background',
		),
	),
));
