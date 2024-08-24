<?php
/**
 * Header / Button
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( !byron_get_mod( 'header_button', false) )
    return;

// Get defaults from Customizer
$text = byron_get_mod( 'header_button_text', 'Get a Quote' );
$url = byron_get_mod( 'header_button_url', 'https://your-link.com' );

if ( $text && $url ) : ?>
	<div class="header-button">
	    <?php
	    if ( $text && $url ) : ?>
	        <a href="<?php echo esc_url( do_shortcode( $url ) ); ?>">
	            <?php echo do_shortcode( $text ); ?>
	        </a>
	    <?php endif; ?>
	</div><!-- /.header-info -->
<?php endif; ?>