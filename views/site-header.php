<div id="site-branding" class="site-branding">
	<# if ( data.is_front_page && data.is_home ) { #>
		<h1 class="site-title"><a href="{{ data.url }}" rel="home">{{ data.name }}</a></h1>
	<# } else { #>
		<p class="site-title"><a href="{{ data.url }}" rel="home">{{ data.name }}</a></p>
	<# } #>
	<# if ( data.description || data.is_customize_preview ) { #>
		<p class="site-description">{{ data.description }}</p>
	<# } #>

</div>

<nav id="site-navigation" class="main-navigation" role="navigation">
	<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">{{ data.primary_menu_label }}</button>
	<ul class="primary-menu">
		<# _.each( data.menu, function( menu_item, id ) { #>
			<li class="menu-{{ id }} object-{{ menu_item.object_id }}">
				<a href="{{ menu_item.url }}">{{ menu_item.title }}</a>
			</li>
		<# }); #>
	</ul>
</nav><!-- #site-navigation -->
<# console.log( data ); #>
