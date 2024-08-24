<?php
/**
 * Header / Info
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get defaults from Customizer
$cls = '';

if ( !byron_get_mod( 'header_info', false) )
    return;

$email = byron_get_mod( 'header_info_email', 'info@ByronCo.com' );
$phone = byron_get_mod( 'header_info_phone', '(+1) 212-946-2707' );
$address = byron_get_mod( 'header_info_address', '112 W 34th St, NYC' );

$email_prev = byron_get_mod( 'header_info_email_prefix', 'Email Address' );
$phone_prev = byron_get_mod( 'header_info_phone_prefix', 'Phone Numbers' );
$address_prev = byron_get_mod( 'header_info_address_prefix', 'Our Location' );

?>

<div class="header-info <?php echo esc_attr( $cls ); ?>">
    <?php
    if ( $phone ) : ?>
        <div class="content-wrap">
            <span class="prefix"><?php echo do_shortcode( $phone_prev ); ?></span>
            <span class="phone content"><?php echo do_shortcode( $phone ); ?></span>
        </div>
    <?php endif; 

    if ( $email ) : ?>
        <div class="content-wrap">
            <span class="prefix"><?php echo do_shortcode( $email_prev ); ?></span>
            <span class="email content"><?php echo do_shortcode( $email ); ?></span>
        </div>
    <?php endif;

    if ( $address ) : ?>
        <div class="content-wrap">
            <span class="prefix"><?php echo do_shortcode( $address_prev ); ?></span>
            <span class="address content"><?php echo do_shortcode( $address ); ?></span>
        </div>
    <?php endif; ?>
</div><!-- /.header-info -->