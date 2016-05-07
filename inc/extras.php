<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Shoestrap
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function shoestrap_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'shoestrap_body_classes' );

/**
 * Adds custom classes to the array of post claSSES.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function shoestrap_post_classes( $classes ) {

	// Modify the "sticky" class to avoid conflicts with Foundation.
	$sticky_key = array_search( 'sticky', $classes );
	if ( false !== $sticky_key ) {
		$classes[ $sticky_key ] = 'sticky-post';
	}

	return $classes;
}
add_filter( 'post_class', 'shoestrap_post_classes' );
