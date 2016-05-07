<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Shoestrap
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<?php Shoestrap_Views::add_view(
			'main',
			array(
				'tmpl'  => 'shoestrap-single-post',
				'id'    => 'main',
				'class' => 'site-main',
				'role'  => 'main'
			)
		); ?>
		<div class="comments"><?php comments_template(); ?></div>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
