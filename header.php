<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shoestrap
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'shoestrap' ); ?></a>

	<header id="masthead" class="site-header" role="banner"></header><!-- #masthead -->

	<div id="content" class="site-content">

<?php
/**
 * Call underscore.js templates
 */
shoestrap_templates()->add_template( array(
	'tmpl'    => 'shoestrap-site-header',
	'path'    => locate_template( 'views/site-header.php' ),
	'element' => '#masthead',
	'data'    => array(
		'is_front_page'        => is_front_page(),
		'is_home'              => is_home(),
		'name'                 => get_bloginfo( 'name' ),
		'description'          => get_bloginfo( 'description', 'display' ),
		'url'                  => get_bloginfo( 'url' ),
		'is_customize_preview' => is_customize_preview(),
		'primary_menu_label'   => esc_html__( 'Primary Menu', 'shoestrap' ),
		'menu'                 => Shoestrap_Data_Menu::get_menu( 'primary' ),
	),
) );
