<div class="row">
	<div id="site-branding" class="site-branding columns">
		<?php shoestrap_branding(); ?>
		<# if ( data.show_tagline && ( data.description || data.is_customize_preview ) ) { #>
			<span class="site-description">{{ data.description }}</span>
		<# } #>
	</div>
	<aside id="header-extra columns">
		<?php dynamic_sidebar( 'header-1' ); ?>
	</aside>
</div>

<nav id="site-navigation" class="main-navigation" role="navigation">
	<?php
	if ( 'center' === get_theme_mod( 'nav_pills_align', 'center' ) ) {
		echo '<div class="menu-centered">';
	}
	// Add menu.
	wp_nav_menu( array(
		'container'      => false,
		'menu_class'     => 'menu dropdown align-' . get_theme_mod( 'nav_pills_align', 'center' ),
		'items_wrap'     => '<ul id="%1$s" class="%2$s" data-dropdown-menu data-responsive-menu="drilldown medium-dropdown" data-disable-hover="true" data-click-open="true">%3$s</ul>',
		'walker'         => new Shoestrap_Topbar_Menu_Walker(),
		'theme_location' => 'primary',
		'menu_id'        => 'primary-menu',
	) );

	if ( 'center' === get_theme_mod( 'nav_pills_align', 'center' ) ) {
		echo '</div>';
	}
	?>
</nav><!-- #site-navigation -->
