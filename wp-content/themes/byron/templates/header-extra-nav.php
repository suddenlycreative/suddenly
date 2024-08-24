<?php
/**
 * Header / Extra Nav
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get mobi logo from Customizer
$logo_size = '';
$logo_title = get_bloginfo( 'name' );
if ( $menu_logo_width = byron_get_mod( 'mobile_menu_logo_width' ) )
	$logo_size .= 'max-width:'. intval( $menu_logo_width ) .'px;';
?>

<ul class="mobi-nav-extra">
	<?php if ( $menu_logo = byron_get_mod( 'mobile_menu_logo' ) ) : ?>
		<li class="ext menu-logo"><span class="menu-logo-inner" style="<?php echo esc_attr( $logo_size ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $menu_logo ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>"/></a></span></li>
	<?php endif; ?>

	<?php if ( byron_get_mod( 'header_search_icon', false ) ) : ?>
	<li class="ext"><?php get_search_form(); ?></li>
	<?php endif; ?>

	<?php if ( class_exists( 'woocommerce' ) && byron_get_mod( 'header_cart_icon', false ) ) : ?>
	<li class="ext"><a class="cart-info" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'byron' ); ?>"><?php echo byron_svg( 'cart' ); ?><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'byron' ), WC()->cart->get_cart_contents_count() ); ?> <?php echo WC()->cart->get_cart_total(); ?></a></li>
	<?php endif; ?>
</ul>