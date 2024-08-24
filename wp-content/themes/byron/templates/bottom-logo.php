<?php
/**
 * Bottom / Logo
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define vars
$logo_size = '';
$logo_url = home_url( '/' );
$logo_title = get_bloginfo( 'name' );

$logo_img = byron_get_mod( 'bottom_custom_logo' );
$logo_width = byron_get_mod( 'bottom_logo_width' );

if ( $logo_width ) $logo_size .= 'max-width:'. intval( $logo_width ) .'px;';
?>

<div id="bottom-logo"> 
	<div class="logo-inner" <?php if ( $logo_size ) echo 'style="' . esc_attr( $logo_size ) . '"'; ?>>
		<?php if ( $logo_img ) : ?>
			<a class="main-logo" href="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( $logo_title ); ?>" rel="home" ><img src="<?php echo esc_url( $logo_img ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" /></a>
		<?php endif; ?>
	</div>
</div><!-- #bottom-logo -->
