<# console.log( data ); #>
<# if ( data.is_home && data.is_front_page ) { #>
	<header>
		<h1 class="page-title screen-reader-text">{{ data.single_post_title }}</h1>
	</header>
<# } #>

<# _.each( data.posts, function( post, i ) { #>

	<header class="entry-header">
		<h2 class="entry-title"><a href="{{ post.permalink }}" rel="bookmark">{{ post.post_title }}</a></h2>
		<# if ( 'post' === data.post_type ) { #>
			<div class="entry-meta">{{{ post.posted_on }}}</div>
		<# } #>
	</header>

	<div class="entry-content">
		{{{ post.post_content }}}
	</div>

<# }); #>
