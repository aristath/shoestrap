<header class="entry-header">
	<h1 class="entry-title">{{ data.post.post_title }}</h1>
	<# if ( 'post' === data.post.post_type ) { #>
		<div class="entry-meta"></div>
	<# } #>
</header>

<div class="entry-content">
	{{{ data.post.post_content }}}
</div>
