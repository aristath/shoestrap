<?php

Shoestrap_Kirki::add_field( array(
	'type'        => 'color',
	'settings'    => 'header_bg',
	'label'       => __( 'Menu Background', 'shoestrap' ),
	'section'     => 'header',
	'default'     => 'rgba(0,0,0,0)',
	'priority'    => 10,
	'transport'   => 'auto',
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

Shoestrap_Kirki::add_field( array(
	'type'        => 'color',
	'settings'    => 'header_items_color',
	'label'       => __( 'Items Color', 'shoestrap' ),
	'section'     => 'header',
	'default'     => '#333333',
	'priority'    => 10,
	'transport'   => 'auto',
	'choices'     => array(
		'alpha'   => true,
	),
	'output'      => array(
		array(
			'element'  => array(
				'.top-bar li.menu-text',
				'.top-bar li a',
				'.top-bar li a:hover',
				'.top-bar li a:visited',
				'.top-bar li a:active',
			),
			'property' => 'color',
		),
		array(
			'element'       => '.top-bar .dropdown.menu.medium-horizontal > li.is-dropdown-submenu-parent > a::after',
			'property'      => 'border-color',
			'value_pattern' => '$ transparent transparent'
		),
		array(
			'element'       => '.top-bar .is-dropdown-submenu .is-dropdown-submenu-parent.opens-left > a::after',
			'property'      => 'border-color',
			'value_pattern' => 'transparent $ transparent transparent'
		),
		array(
			'element'       => '.top-bar .is-dropdown-submenu .is-dropdown-submenu-parent.opens-right > a::after',
			'property'      => 'border-color',
			'value_pattern' => 'transparent transparent transparent $'
		),
	),
));
