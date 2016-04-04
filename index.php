<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shoestrap
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main"></main><!-- #main -->
	</div><!-- #primary -->

<?php

/**
 * Call the underscore.js template
 */
shoestrap_templates()->add_template( array(
	'tmpl'    => 'shoestrap-posts',
	'path'    => locate_template( 'views/index.php' ),
	'element' => '#main',
	'data'    => Shoestrap_Data::get_data(),
) );


get_sidebar();
get_footer();
