<?php

Shoestrap_Kirki::add_section( 'layout', array(
	'priority'    => 10,
	'title'       => esc_attr__( 'Layout', 'shoestrap' ),
	'description' => esc_attr__( 'You can change the width of the header, footer & main content areas separately, as well as choose a layout mode for your sidebars.', 'shoestrap' ),
));

Shoestrap_Kirki::add_section( 'colors', array(
	'priority'    => 10,
	'title'       => esc_attr__( 'Colors', 'shoestrap' ),
));

Shoestrap_Kirki::add_section( 'header', array(
	'priority'    => 10,
	'title'       => esc_attr__( 'Header', 'shoestrap' ),
));

Shoestrap_Kirki::add_section( 'typography', array(
	'priority'    => 10,
	'title'       => esc_attr__( 'Typography', 'shoestrap' ),
));
