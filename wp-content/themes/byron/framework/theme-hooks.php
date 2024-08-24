<?php

// Custom classes to body tag
function byron_body_classes() {
	$classes[] = '';

	// Get header style
	$header_style = byron_get_mod( 'header_site_style', 'style-3' );
	if ( is_page() && byron_elementor( 'header_style' ) )
		$header_style = byron_elementor( 'header_style' );

	$classes[] = 'header-' .  $header_style;

	// Header fixed
	if ( byron_get_mod( 'header_fixed', false ) )
		$classes[] = 'header-fixed';

	// Get layout position
	$classes[] = byron_layout_position();
	$layout_position = byron_layout_position();
	if ( ! is_page() && $layout_position != 'no-sidebar' && ! is_active_sidebar( 'sidebar-blog' ) )
		$classes[] = 'blog-empty-widget';

	if ( is_page() && $layout_position != 'no-sidebar' && ! is_active_sidebar( 'sidebar-page' ) )
		$classes[] = 'page-empty-widget';

	// Get layout style
	$layout_style = byron_get_mod( 'site_layout_style', 'full-width' );
	$classes[] = 'site-layout-'. $layout_style;

	if ( is_page() ) $classes[] = 'is-page';

	if ( is_page_template( 'templates/page-onepage.php' ) )
		$classes[] = 'one-page';

	// Add classes for Woo pages
	if ( byron_is_woocommerce_page() )
		$classes[] = 'woocommerce-page';

	if ( byron_is_woocommerce_shop() )
		$classes[] = 'main-shop-page';

	if ( byron_is_woocommerce_shop() || byron_is_woocommerce_archive_product() ) {
		$shop_cols = byron_get_mod( 'shop_columns', '3' );
		$classes[] = 'shop-col-'. $shop_cols;
	}

	// Add class for search page
	if ( is_search() )
		$classes[] = 'search-page';

	// Boxed Layout dropshadow
	if ( 'boxed' == $layout_style && byron_get_mod( 'site_layout_boxed_shadow' ) )
		$classes[] = 'box-shadow';

	if ( byron_get_mod( 'header_search_icon' ) )
		$classes[] = 'header-simple-search';

	if ( is_singular( 'post' ) )
		$classes[] = 'is-single-post';

	if ( is_singular( 'project' ) )
		$classes[] = 'page-single-project';

	if ( is_singular( 'member' ) )
		$classes[] = 'page-single-member';

	if ( is_singular( 'event' ) )
		$classes[] = 'page-single-event';

	if ( byron_get_mod( 'byron_blog_single_related', false ) )
		$classes[] = 'has-related-post';

	if ( byron_get_mod( 'project_related', false ) )
		$classes[] = 'has-related-project';

	if ( ! is_active_sidebar( 'sidebar-footer-1' ) &&
		! is_active_sidebar( 'sidebar-footer-2' ) &&
		! is_active_sidebar( 'sidebar-footer-3' ) &&
		! is_active_sidebar( 'sidebar-footer-4' ) &&
		! is_active_sidebar( 'sidebar-footer-5' ))
		$classes[] = 'footer-no-widget';

	// Footer Style
	if ( byron_is_woocommerce_shop() && byron_get_mod( 'shop_footer_style' ) ) {
		$classes[] = 'footer-' . byron_get_mod( 'shop_footer_style' );
	} elseif ( is_singular( 'product' ) && byron_get_mod( 'shop_single_footer_style', false ) ) {
		$classes[] = 'footer-' . byron_get_mod( 'shop_single_footer_style' );
	} else {
		$classes[] = 'footer-' . byron_get_mod( 'footer_style' );
	}

	// Return classes
	return $classes;
}
add_filter( 'body_class', 'byron_body_classes' );

// Remove products and pages results from the search form widget
function byron_custom_search_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() )
		return;

	if ( isset( $_GET['post_type'] ) && ( $_GET['post_type'] == 'product' ) )
		return;

	if ( $query->is_search() ) {
    	$in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );

	    $post_types_to_remove = array( 'product' );

	    foreach ( $post_types_to_remove as $post_type_to_remove ) {
			if ( is_array( $in_search_post_types ) 
				&& in_array( $post_type_to_remove, $in_search_post_types ) 
			) {
				unset( $in_search_post_types[ $post_type_to_remove ] );
				$query->set( 'post_type', $in_search_post_types );
			}
	    }
	}
}
add_action( 'pre_get_posts', 'byron_custom_search_query' );

// Update Woocommerce Cart
function byron_woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();

	if ( class_exists( 'woocommerce' ) ) : ?>
		<a class="cart-info" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr__( 'View your shopping cart', 'byron' ); ?>"><?php echo byron_svg( 'cart' ); ?><?php echo sprintf( _n( '%d item', '%d items', WC()->cart->cart_contents_count, 'byron' ), WC()->cart->cart_contents_count); ?> <?php echo WC()->cart->get_cart_total(); ?></a>
	<?php endif;

	$fragments['a.cart-info'] = ob_get_clean();
	
	return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'byron_woocommerce_header_add_to_cart_fragment');

// Sets the content width in pixels, based on the theme's design and stylesheet.
function byron_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'byron_content_width', 1140 );
}
add_action( 'after_setup_theme', 'byron_content_width', 0 );

// Modifies tag cloud widget arguments to have all tags in the widget same font size.
function byron_widget_tag_cloud_args( $args ) {
	$args['largest'] = 14;
	$args['smallest'] = 14;
	$args['unit'] = 'px';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'byron_widget_tag_cloud_args' );

// Change default read more style
function byron_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'byron_excerpt_more', 10 );

// Custom excerpt length for posts
function byron_content_length() {
	$length = byron_get_mod( 'blog_excerpt_length', '50' );
	$length = intval( $length );

	if ( ! empty( $length ) || $length != 0 )
		return $length;
}
add_filter( 'excerpt_length', 'byron_content_length', 999 );

// Prevent page scroll when clicking the more link
function byron_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );

	return $link;
}
add_filter( 'the_content_more_link', 'byron_remove_more_link_scroll' );

// Remove read-more link so we can custom it
function byron_remove_read_more_link() {
    return '';
}
add_filter( 'the_content_more_link', 'byron_remove_read_more_link' );

// Custom html categories widget
function cat_count_span( $link ) {
  $link = str_replace( '</a> (', '</a> <span>', $link );
  $link = str_replace( ')', '</span>', $link );
  return $link;
}
add_filter( 'wp_list_categories', 'cat_count_span' );
 
// Column of related product
function byron_related_products_args( $args ) {
	$column = byron_get_mod( 'shop_realted_columns', 3 );
	$args['posts_per_page'] = $column; 
	$args['columns'] = $column; 
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'byron_related_products_args', 20 );
