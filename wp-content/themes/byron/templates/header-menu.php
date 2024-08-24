<?php
/**
 * Header / Menu
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Menu
if ( has_nav_menu( 'primary' ) || has_nav_menu( 'onepage' ) ) {
	$cls = '';
	if ( byron_get_mod( 'menu_show_current' ) ) $cls .= 'show-current';
	$menu = is_page_template( 'templates/page-onepage.php' )
		? 'onepage'
		: 'primary';
	?>

	<div class="mobile-button"><span></span></div>

	<nav id="main-nav" class="main-nav <?php echo esc_attr( $cls ); ?>">
		<?php
		wp_nav_menu( array(
			'theme_location' => $menu,
			'link_before' => '<span>',
			'link_after'=>'</span>',
			'fallback_cb' => false,
			'container' => false
		) );
		?>
	</nav>
<?php }

// Cart Icon
if ( byron_get_mod( 'header_cart_icon', false ) && class_exists( 'woocommerce' ) ) { ?>
    <div class="nav-top-cart-wrapper">
        <a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ) ?>">
        	<?php echo byron_svg( 'cart' ); ?>
            <?php if ( $items_count = WC()->cart->get_cart_contents_count() ): ?>
                <span class="shopping-cart-items-count"><?php echo esc_html( $items_count ) ?></span>
            <?php else: ?>
                <span class="shopping-cart-items-count">0</span>
            <?php endif ?>
        </a>

        <div class="nav-shop-cart">
            <div class="widget_shopping_cart_content">      	
                <?php woocommerce_mini_cart() ?>
            </div>
        </div>
    </div>

<?php }

// Search Icon
if ( byron_get_mod( 'header_search_icon', false ) ) {
	echo '<div class="header-search-wrap"><a href="#" class="header-search-trigger">' .
		byron_svg( 'search' ) . '</a></div>';
}

// Secondary Menu
if ( has_nav_menu( 'secondary' ) ) {
	$secondary_menu = 'secondary';
	?>

	<div class="second-menu-button">
		<?php echo byron_svg( 'menu' ); ?>
	</div>

	<div class="secondary-menu-overlay"></div>
	
	<div id="secondary-menu" class="secondary-menu">
		<div class="close-menu"></div>
		<?php
		wp_nav_menu( array(
			'theme_location' => $secondary_menu,
			'link_before' => '<span>',
			'link_after'=>'</span>',
			'fallback_cb' => false,
			'container' => false
		) );
		?>
	</div>
<?php }