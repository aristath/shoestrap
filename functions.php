<?php
/**
 * Shoestrap functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Shoestrap
 */

/**
 * Load autoloader file.
 */
require get_template_directory() . '/inc/autoloader.php';

/**
 * Init the theme
 */
new Shoestrap_Init();

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Recommend installing Kirki.
 */
require get_template_directory() . '/inc/include-kirki.php';
