<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Type your keyword...', 'placeholder', 'byron' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'byron' ); ?>" />
	<button type="submit" class="search-submit" title="<?php echo esc_attr__('Search', 'byron'); ?>"><?php echo esc_html__('SEARCH', 'byron'); ?><?php echo byron_svg( 'search' ); ?></button>
</form>
