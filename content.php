<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shoestrap
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>></article>
<?php

/**
 * Call the underscore.js template
 */
$data = array();
$data['is_single']  = is_single();
$data['post_title'] = get_the_title();
$data['permalink']  = get_permalink();
$data['post_type']  = get_post_type();
$data['posted_on']  = shoestrap_posted_on();
$data['content']    = apply_filters( 'the_content', get_the_content() );
$data['entry_footer'] = shoestrap_entry_footer();

shoestrap_templates()->add_template( array(
	'tmpl'    => 'shoestrap-post-content-' . get_the_ID(),
	'path'    => locate_template( 'views/content.php' ),
	'element' => '#post-' . get_the_ID(),
	'data'    => $data,
) );
