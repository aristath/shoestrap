<form role="search" method="get" class="search-form input-group" action="<?php echo home_url( '/' ); ?>">
	<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
	<input type="search" class="search-field input-group-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
	<div class="input-group-button">
		<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
	</div>
</form>
