<?php

Shoestrap_Kirki::add_field( array(
	'type'        => 'dimension',
	'settings'    => 'logo_max_width',
	'label'       => __( 'Logo Max Width', 'shoestrap' ),
	'section'     => 'title_tagline',
	'default'     => '300px',
	'priority'    => 8,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => 'img.custom-logo',
			'property' => 'max-width',
		),
	),
));
