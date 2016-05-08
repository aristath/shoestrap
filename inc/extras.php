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

function shoestrap_the_custom_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	$site_title_classes = 'site-title';
	if ( function_exists( 'the_custom_logo' ) ) {
		echo get_custom_logo();
		if ( $custom_logo_id ) {
			$site_title_classes .= ' screen-reader-text';
		}
	}
	if ( is_front_page() && is_home() ) {
		echo '<h1 class="' . $site_title_classes . '"><a href="' . home_url() . '" rel="home">' . get_bloginfo( 'name' ) . '</a></h1>';
	} else {
		echo '<span class="' . $site_title_classes . '"><a href="' . home_url() . '" rel="home">' . get_bloginfo( 'name' ) . '</a></span>';
	}
}
