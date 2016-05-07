<?php

$sections = array(
	'colors',
	'header',
	'layout',
);
foreach ( $sections as $section ) {
	get_template_part( 'inc/customizer/fields-' . $section );
}
