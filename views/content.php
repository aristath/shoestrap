<header class="entry-header">
	<# if ( data.is_single ) { #>
		<h1 class="entry-title">{{ data.post_title }}</h1>
	<# } else { #>
		<h2 class="entry-title"><a href="{{ data.permalink }}" rel="bookmark">{{ data.post_title }}</a></h2>
	<# } #>

	<# if ( 'post' === data.post_type ) { #>
		<div class="entry-meta">{{{ data.posted_on }}}</div>
	<# } #>
</header>

<div class="entry-content">
	{{{ data.content }}}
</div>

<footer class="entry-footer">
	{{{ data.entry_footer }}}
</footer>
