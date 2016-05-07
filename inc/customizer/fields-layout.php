<?php

Shoestrap_Kirki::add_field( array(
	'type'        => 'dimension',
	'settings'    => 'content_width',
	'label'       => __( 'Content Width', 'shoestrap' ),
	'section'     => 'layout',
	'default'     => '85rem',
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '#content',
			'property' => 'max-width',
		),
	),
));
