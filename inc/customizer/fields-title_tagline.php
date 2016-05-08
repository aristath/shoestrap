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

Shoestrap_Kirki::add_field( array(
	'type'        => 'dashicons',
	'settings'    => 'logo_alignment',
	'label'       => __( 'Logo alignment', 'shoestrap' ),
	'section'     => 'title_tagline',
	'default'     => 'left',
	'priority'    => 8,
	'choices'     => array(
		'left'    => 'editor-alignleft',
		'center'  => 'editor-aligncenter',
		'right'   => 'editor-alignright',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '#site-branding',
			'property' => 'text-align',
		),
	),
));
