<# if ( data.is_front_page && data.is_home ) { #>
	<h1 class="site-title"><a href="{{ data.url }}" rel="home">{{ data.name }}</a></h1>
<# } else { #>
	<p class="site-title"><a href="{{ data.site.url }}" rel="home">{{ data.name }}</a></p>
<# } #>
<# if ( data.description || data.is_customize_preview ) { #>
	<p class="site-description">{{ data.description }}</p>
<# } #>
<# console.log( data ); #>
