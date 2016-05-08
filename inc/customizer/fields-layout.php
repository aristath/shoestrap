<?php

Shoestrap_Kirki::add_field( array(
	'type'        => 'dimension',
	'settings'    => 'content_max_width',
	'label'       => __( 'Content Width', 'shoestrap' ),
	'section'     => 'layout',
	'default'     => '85rem',
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => array(
				'#content',
				'.top-bar',
				'#site-main-nav-pills #site-navigation #primary-menu',
			),
			'property' => 'max-width',
		),
	),
));

Shoestrap_Kirki::add_field( array(
	'type'        => 'slider',
	'settings'    => 'content_columns_width',
	'label'       => __( 'Content Width', 'shoestrap' ),
	'section'     => 'layout',
	'default'     => '8',
	'priority'    => 10,
	'choices'     => array(
		'min'  => '6',
		'max'  => '12',
		'step' => '1',
	),
));
