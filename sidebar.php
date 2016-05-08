<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shoestrap
 */

// Load the sidebar template.
Shoestrap_Views::add_view( 'aside', array(
	'tmpl'  => 'shoestrap-site-sidebar',
	'id'    => 'secondary',
	'class' => 'widget-area columns large-' . absint( 12 - get_theme_mod( 'content_columns_width', 8 ) ),
	'role'  => 'complementary'
) );
