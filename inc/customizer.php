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
		$elements = array(
			'blockquote',
			'blockquote p',
			'cite',
			'label',
		);
		$css['global'][ implode( ',', $elements ) ]['color'] = '#dedede';
	}

	// Modify button text color depending on the primary color.
	if ( 50 < $primary_color->lightness ) {
		$elements = array(
			'.top-bar li a',
			'.top-bar li a:active',
			'.top-bar li a:hover',
			'.top-bar li a:visited',
			'.top-bar li.menu-text',
		);
		$css['global'][ implode( ',', $elements ) ]['color'] = '#333';
		$elements = array(
			'.top-bar .menu .active > a',
			'button',
			'html input[type="button"]',
			'input[type="reset"]',
			'input[type="submit"]',
		);
		$css['global'][ implode( ',', $elements ) ]['color'] = '#333';
	} else {
		$elements = array(
			'.top-bar li a',
			'.top-bar li a:active',
			'.top-bar li a:hover',
			'.top-bar li a:visited',
			'.top-bar li.menu-text',
		);
		$css['global'][ implode( ',', $elements ) ]['color'] = '#fff';
		$elements = array(
			'.top-bar .menu .active > a',
			'button, html input[type="button"]',
			'input[type="reset"]',
			'input[type="submit"]',
		);
		$css['global'][ implode( ',', $elements ) ]['color'] = '#fff';
	}

	// Modify the menu items color depending on the background.
	$header_bg_color_lightness = $header_bg_color->lightness;
	if ( 1 > $header_bg_color->alpha ) {
		$header_bg_color_lightness = ( ( $header_bg_color->lightness * $header_bg_color->alpha ) + $bg_color->lightness ) / 2;
	}
	if ( 50 > $header_bg_color->lightness ) {
		$elements = array(
			'.dropdown.menu.medium-horizontal > li.is-dropdown-submenu-parent > a::after',
			'.dropdown.menu > li.is-dropdown-submenu-parent > a::after',
		);
		$css['global'][ implode( ',', $elements ) ]['border-color'] = '#fff transparent transparent';
		$elements = array(
			'.is-dropdown-submenu .is-dropdown-submenu-parent.opens-left > a::after',
		);
		$css['global'][ implode( ',', $elements ) ]['border-color'] = 'transparent #fff transparent transparent';
		$elements = array(
			'.is-dropdown-submenu .is-dropdown-submenu-parent.opens-right > a::after',
		);
		$css['global'][ implode( ',', $elements ) ]['border-color'] = 'transparent transparent transparent #fff';
		$elements = array(
			'.top-bar li.menu-text, .top-bar li a',
			'.top-bar li a:hover',
			'.top-bar li a:visited',
			'.top-bar li a:active',
			'.dropdown.menu > li.is-dropdown-submenu-parent > a',
			'.menu > li > a',
		);
		$css['global'][ implode( ',', $elements ) ]['color'] = '#fff';
	} else {
		$elements = array(
			'.dropdown.menu.medium-horizontal > li.is-dropdown-submenu-parent > a::after',
			'.dropdown.menu > li.is-dropdown-submenu-parent > a::after',
		);
		$css['global'][ implode( ',', $elements ) ]['border-color'] = '#333 transparent transparent';
		$elements = array(
			'.is-dropdown-submenu .is-dropdown-submenu-parent.opens-left > a::after',
		);
		$css['global'][ implode( ',', $elements ) ]['border-color'] = 'transparent #333 transparent transparent';
		$elements = array(
			'.is-dropdown-submenu .is-dropdown-submenu-parent.opens-right > a::after',
		);
		$css['global'][ implode( ',', $elements ) ]['border-color'] = 'transparent transparent transparent #333';
		$elements = array(
			'.top-bar li.menu-text, .top-bar li a',
			'.top-bar li a:hover',
			'.top-bar li a:visited',
			'.top-bar li a:active',
			'.dropdown.menu > li.is-dropdown-submenu-parent > a',
			'.menu > li > a',
		);
		$css['global'][ implode( ',', $elements ) ]['color'] = '#333';
	}
	return $css;
}
add_filter( 'kirki/shoestrap/styles', 'shoestrap_extra_styles' );
