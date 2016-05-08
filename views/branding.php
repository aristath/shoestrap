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
