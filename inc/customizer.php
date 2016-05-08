<?php
/**
 * Shoestrap Theme Customizer.
 *
 * @package Shoestrap
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shoestrap_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
}
add_action( 'customize_register', 'shoestrap_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function shoestrap_customize_preview_js() {
	wp_enqueue_script( 'shoestrap_customizer', trailingslashit( get_template_directory_uri() ) . 'assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'shoestrap_customize_preview_js' );

include_once wp_normalize_path( get_template_directory() . '/inc/classes/class-shoestrap-kirki.php' );
if ( class_exists( 'Shoestrap_Kirki' ) ) {

	// Add the Configuration.
	Shoestrap_Kirki::add_config( 'shoestrap', array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	));

	// Include files for panels, section & fields.
	include_once wp_normalize_path( get_template_directory() . '/inc/customizer/panels.php' );
	include_once wp_normalize_path( get_template_directory() . '/inc/customizer/sections.php' );
	include_once wp_normalize_path( get_template_directory() . '/inc/customizer/fields.php' );
}

function shoestrap_extra_styles( $css ) {
	if ( ! class_exists( 'ariColor' ) ) {
		include_once wp_normalize_path( get_template_directory() . '/inc/classes/class-aricolor.php' );
	}
	// Get the background color.
	$_bg_color = get_theme_mod( 'background_color', '#fff' );
	$bg_color  = ariColor::newColor( $_bg_color, 'hex' );

	// Get the header background color.
	$_header_bg_color = get_theme_mod( 'header_background_color', 'rgba(255,255,255,0)' );
	$header_bg_color  = ariColor::newColor( $_header_bg_color, 'auto' );

	// Get the primary color.
	$_primary_color = get_theme_mod( 'primary_color', '#29b6fc' );
	$primary_color  = ariColor::newColor( $_primary_color, 'hex' );

	// Modify text color depending on the background.
	if ( 50 > $bg_color->lightness ) {
		$css['global']['body']['color'] = '#fff';
		$css['global']['blockquote, blockquote p, cite, label']['color'] = '#dedede';
	}

	// Modify button text color depending on the primary color.
	if ( 50 < $primary_color->lightness ) {
		$css['global']['.top-bar li a, .top-bar li a:active, .top-bar li a:hover, .top-bar li a:visited, .top-bar li.menu-text']['color'] = '#333';
		$css['global']['.top-bar .menu .active > a, button, html input[type="button"], input[type="reset"], input[type="submit"]']['color'] = '#333';
	} else {
		$css['global']['.top-bar li a, .top-bar li a:active, .top-bar li a:hover, .top-bar li a:visited, .top-bar li.menu-text']['color'] = '#fff';
		$css['global']['.top-bar .menu .active > a, button, html input[type="button"], input[type="reset"], input[type="submit"]']['color'] = '#fff';
	}

	// Modify the menu items color depending on the background.
	$header_bg_color_lightness = $header_bg_color->lightness;
	if ( 1 > $header_bg_color->alpha ) {
		$header_bg_color_lightness = ( ( $header_bg_color->lightness * $header_bg_color->alpha ) + $bg_color->lightness ) / 2;
	}
	if ( 50 > $header_bg_color->lightness ) {
		$css['global']['.dropdown.menu.medium-horizontal > li.is-dropdown-submenu-parent > a::after']['border-color'] = '#fff transparent transparent';
		$css['global']['.is-dropdown-submenu .is-dropdown-submenu-parent.opens-left > a::after']['border-color'] = 'transparent #fff transparent transparent';
		$css['global']['.is-dropdown-submenu .is-dropdown-submenu-parent.opens-right > a::after']['border-color'] = 'transparent transparent transparent #fff';
		$css['global']['.top-bar li.menu-text, .top-bar li a, .top-bar li a:hover, .top-bar li a:visited, .top-bar li a:active']['color'] = '#fff';
	} else {
		$css['global']['.dropdown.menu.medium-horizontal > li.is-dropdown-submenu-parent > a::after']['border-color'] = '#333 transparent transparent';
		$css['global']['.is-dropdown-submenu .is-dropdown-submenu-parent.opens-left > a::after']['border-color'] = 'transparent #333 transparent transparent';
		$css['global']['.is-dropdown-submenu .is-dropdown-submenu-parent.opens-right > a::after']['border-color'] = 'transparent transparent transparent #333';
		$css['global']['.top-bar li.menu-text, .top-bar li a, .top-bar li a:hover, .top-bar li a:visited, .top-bar li a:active']['color'] = '#333';
	}
	return $css;
}
add_filter( 'kirki/shoestrap/styles', 'shoestrap_extra_styles' );
