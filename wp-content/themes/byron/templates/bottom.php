<?php
/**
 * Bottom Bar
 *
 * @package byron
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! byron_get_mod( 'bottom_bar', true ) ) return false;

$bottom_style = byron_get_mod( 'bottom_bar_style' );
$copyright = byron_get_mod( 'bottom_copyright', '&copy; Byron - Creative Multipurpose WordPress Theme.' );

$css = byron_element_bg_css( 'bottom_background_img' );

$cls = $bottom_style;

?>

<div id="bottom" class="<?php echo esc_attr( $cls ); ?>" style="<?php echo esc_attr( $css ); ?>">
    <div class="byron-container">
        <div class="bottom-bar-inner-wrap">
            <div class="inner-wrap">
                <?php if ( 'style-2' == $bottom_style ) : 
                    get_template_part( 'templates/bottom-logo');
                endif; ?>

                <?php if ( $copyright ) : ?>
                    <div id="copyright">
                        <?php printf( '%s', do_shortcode( $copyright ) ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( 'style-3' == $bottom_style ) : ?>
                    <div class="bottom-bar-menu">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'bottom',
                            'fallback_cb'    => false,
                            'container'      => false,
                            'menu_class'     => 'bottom-nav',
                        ) );
                        ?>
                    </div><!-- /.bottom-bar-menu -->
                <?php endif; ?>

                <?php if ( 'style-3' == $bottom_style ) : 
                    get_template_part( 'templates/bottom-social');
                endif; ?>
            </div><!-- /.bottom-bar-copyright -->

            <?php get_template_part( 'templates/scroll-top'); ?>
        </div>
    </div>
</div><!-- /#bottom -->