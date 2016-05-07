<?php

Shoestrap_Kirki::add_field( array(
	'type'        => 'color-palette',
	'settings'    => 'primary_color',
	'label'       => __( 'Primary Color', 'shoestrap' ),
	'section'     => 'colors',
	'default'     => '',
	'priority'    => 10,
	'transport'   => 'auto',
	'choices'     => array(
		'colors' => Kirki_Helper::get_material_design_colors( '400' ),
		'size'   => 32,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => array( 'a', 'a:hover', 'a:visited' ),
			'property' => 'color',
		),
		array(
			'element'  => '.menu .active > a',
			'property' => 'background',
		),
		array(
			'element'       => '.dropdown.menu.medium-horizontal > li.is-dropdown-submenu-parent > a::after',
			'property'      => 'border-color',
			'value_pattern' => '$ transparent transparent'
		),
		array(
			'element'       => '.is-dropdown-submenu .is-dropdown-submenu-parent.opens-left > a::after',
			'property'      => 'border-color',
			'value_pattern' => 'transparent $ transparent transparent'
		),
		array(
			'element'       => '.is-dropdown-submenu .is-dropdown-submenu-parent.opens-right > a::after',
			'property'      => 'border-color',
			'value_pattern' => 'transparent transparent transparent $'
		),
	),
));
