<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>
<form role="search" method="get" class="search-form" action="<?php print esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php print esc_html__( 'Search &hellip;', 'drivic' ); ?>" value="<?php print get_search_query(); ?>" name="s" />
	<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
</form>