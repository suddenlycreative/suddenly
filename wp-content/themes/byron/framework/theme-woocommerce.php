<?php
/**
 * Woocommerce
 *
 * @package byron
 * @version 3.6.8
 */

// Disable WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Remove breadcrumb (we're using the WooFramework default breadcrumb)
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Removes the "shop" title on the main shop page
add_filter( 'woocommerce_show_page_title', '__return_false' );

// Remove Heading Text Tab
add_filter( 'woocommerce_product_description_heading', '__return_false' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );

// Change gravatar size
add_filter( 'woocommerce_review_gravatar_size', 'byron_woocommerce_gravatar_size', 10 );
function byron_woocommerce_gravatar_size() { return 100; }

// Adjust markup on all WooCommerce pages
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Fix html on item product 
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

add_action( 'woocommerce_before_shop_loop_item', 'byron_before_shop_loop_item' );
add_action( 'byron_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'byron_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

// Relayout shop item
function byron_before_shop_loop_item() {
	global $product;
	echo '<div class="product-thumbnail">';
	echo '<a class="woocommerce_loop_product_link" href="' . get_the_permalink($product->get_id()) . '">'; 
	do_action( 'byron_before_shop_loop_item' );
	echo '</a>';
	echo '</div><div class="product-info">';
	echo '<a class="woocommerce_loop_product_link" href="' . get_the_permalink($product->get_id()) . '">';
}
add_action( 'woocommerce_after_shop_loop_item', function() {
	echo '</div></a>';
}, 99 );

// Update the number on cart icon
add_filter( 'woocommerce_add_to_cart_fragments', 'byron_woocommerce_cart_link_fragment' );
if ( ! function_exists( 'byron_woocommerce_cart_link_fragment' ) ) {
	// Ensure cart contents update when products are added to the cart via AJAX
	function byron_woocommerce_cart_link_fragment( $fragments ) {
		global $woocommerce;
		ob_start(); ?>

		<a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', ' byron' ); ?>">
			<?php
			echo byron_svg( 'cart' );
			$item_count = sprintf(
				_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'byron' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="cart-icon coreicon-shop"><span class="shopping-cart-items-count"><?php echo esc_html( $item_count ); ?></span></span>
		</a>		

		<?php $fragments['a.nav-cart-trigger'] = ob_get_clean();

		return $fragments;
	}
}

// Output the script placeholder for cart updater
add_action( 'wp_footer', 'byron_cart_fragments_placeholder', 100 );
function byron_cart_fragments_placeholder() {
	echo '<script id="shopping-cart-items-updater" type="text/javascript"></script>';
}

// Display products per page
add_filter( 'loop_shop_per_page', 'byron_products_per_page', 20 );
function byron_products_per_page() {
	if ( ! $items = byron_get_mod('shop_products_per_page') ) {
		return 6;
	} else {
		return $items;
	}
}

// Change columns in product loop
add_filter( 'loop_shop_columns', 'byron_shop_loop_columns', 20 );
function byron_shop_loop_columns() {
	if ( ! $cols = byron_get_mod('shop_columns') ) {
		return 3;
	} else {
		if ( $cols == '2' ) return 2;
		if ( $cols == '3' ) return 3;
		if ( $cols == '4' ) return 4;
	}
}

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Change columns in related products output to 4
add_filter( 'woocommerce_output_related_products_args', 'byron_related_products' );
function byron_related_products() {
	$args = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);
	return $args;
}

// Change product thumbnails columns to 6
add_filter('woocommerce_product_thumbnails_columns','byron_custom_storefront_gallery' );
function byron_custom_storefront_gallery( $column ) {
	$column  = 6;
	return $column ;
}

// Add category to product item
function byron_product_cat(){
    $cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
    if ( $cats && ! is_wp_error ( $cats ) ){
        $cat = array_shift( $cats ); ?>

        <div class="product-cat"><?php echo esc_html( $cat->name ); ?></div>
<?php }
}
add_action( 'woocommerce_shop_loop_item_title', 'byron_product_cat', 9 );

