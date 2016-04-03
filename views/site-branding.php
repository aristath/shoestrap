<# if ( data.is_front_page && data.is_home ) { #>
	<h1 class="site-title"><a href="{{ data.site.url }}" rel="home">{{ data.site.name }}</a></h1>
<# } else { #>
	<p class="site-title"><a href="{{ data.site.url }}" rel="home">{{ data.site.name }}</a></p>
<# } #>
<# if ( data.site.description || data.is_customize_preview ) { #>
	<p class="site-description">{{ data.site.description }}</p>
<# } #>
