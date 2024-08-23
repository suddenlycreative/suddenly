<?php 

/**
 * Template part for displaying footer layout two
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package technix
*/


$technix_footer_logo = get_theme_mod( 'technix_footer_logo' );
$technix_footer_top_space = function_exists('get_field') ? get_field('technix_footer_top_space') : '0';
$technix_copyright_center = $technix_footer_logo ? 'col-lg-4 offset-lg-4 col-md-6 text-right' : 'col-lg-12 text-center';

$footer_top_space = get_theme_mod( 'technix_footer_top_space' );
$footer_copyright_switch = get_theme_mod( 'footer_copyright_switch', false );


// Footer Logo Image 
$footer_logo_image = get_theme_mod( 'footer_logo_image' );


// Phone Number
$phone = get_theme_mod( 'header_phone', __( '+88 01310-069824', 'technix' ) );

// footer bg color and image from customizer kirki plugin

$footer_bg_img = get_theme_mod( 'footer_bg_image' );
$footer_bg_color = get_theme_mod( 'footer_bg_color' );

// bg info from page
$test_footer_bg_image = function_exists('tpmeta_image_field')? tpmeta_image_field('test_footer_bg_image') : '';
$technix_footer_bg_image = function_exists('tpmeta_image_field')? tpmeta_image_field('technix_footer_bg_image') : '';
$technix_footer_bg_color = function_exists('tpmeta_field')? tpmeta_field('technix_footer_bg_color') : '';

// bg img condition
$bg_image = $technix_footer_bg_image ? $technix_footer_bg_image['url'] : $footer_bg_img ;

// bg color condition
$bg_color = $technix_footer_bg_color ? $technix_footer_bg_color  : $footer_bg_color;

// main bg data
$bg_data = !empty($bg_image) ? "background-image: url(".$bg_image.")" : "background: ".$bg_color;


$footer_columns = 0;
$footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

for ( $num = 1; $num <= $footer_widgets; $num++ ) {
    if ( is_active_sidebar( 'footer-2-' . $num ) ) {
        $footer_columns++;
    }
}

switch ( $footer_columns ) {
case '1':
    $footer_class[1] = 'col-lg-12';
    break;
case '2':
    $footer_class[1] = 'col-lg-6 col-md-6';
    $footer_class[2] = 'col-lg-6 col-md-6';
    break;
case '3':
    $footer_class[1] = 'col-xl-4 col-lg-6 col-md-5';
    $footer_class[2] = 'col-xl-4 col-lg-6 col-md-7';
    $footer_class[3] = 'col-xl-4 col-lg-6';
    break;
case '4':
    $footer_class[1] = 'col-xl-4 col-lg-6 col-md-12 col-sm-12';
    $footer_class[2] = 'col-xl-3 col-lg-6 col-md-6 col-sm-6';
    $footer_class[3] = 'col-xl-2 col-lg-6 col-md-6 col-sm-6';
    $footer_class[4] = 'col-xl-3 col-lg-6 col-md-8 col-sm-12';
    break;
default:
    $footer_class = 'col-xl-3 col-lg-3 col-md-6';
    break;
}

?>

<!-- footer area start -->
<footer class="tp-footer-2-area p-relative" style="<?php echo esc_attr( $bg_data); ?>">
    <div class="tp-footer-overlay" data-background="<?php print esc_url($bg_data );?>">
        <div class="tp-footer-2-shape">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer/shape-1.png" alt="">
        </div>
        <div class="container">
            <?php if ( is_active_sidebar('footer-2-1') OR is_active_sidebar('footer-2-2') OR is_active_sidebar('footer-2-3') ): ?>
            <div class="tp-footer-3-main-area">
                <div class="row">
                    <?php
                if ( $footer_columns < 4 ) {
                print '<div class="col-xl-4 col-lg-5 col-md-6">';
                dynamic_sidebar( 'footer-2-1' );
                print '</div>';

                print '<div class="col-xl-4 col-lg-3 col-md-6">';
                dynamic_sidebar( 'footer-2-2' );
                print '</div>';

                print '<div class="col-xl-4 col-lg-4 col-md-6">';
                dynamic_sidebar( 'footer-2-3' );
                print '</div>';
                } else {
                    for ( $num = 1; $num <= $footer_columns; $num++ ) {
                        if ( !is_active_sidebar( 'footer-2-' . $num ) ) {
                            continue;
                        }
                        print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                        dynamic_sidebar( 'footer-2-' . $num );
                        print '</div>';
                    }
                }
            ?>

                </div>
            </div>
            <?php endif; ?>
            <div class="tp-footer-copyright-area p-relative">

                <div class="tp-footer-2-menu-area p-relative">
                    <div class="row align-items-center">
                        <?php  if ( !empty( $footer_logo_image ) ): ?>
                        <div class="col-lg-2 col-md-2">
                            <div class="tp-footer-2-logo">
                                <img src="<?php echo esc_url($footer_logo_image); ?>" alt="">
                            </div>
                        </div>
                        <?php endif;  ?>
                        <div class="col-lg-8 col-md-10">
                            <div class="tp-footer-2-menu">
                                <?php technix_footer_menu();?>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <?php  if ( !empty( $phone ) ): ?>
                            <div class="tp-footer-2-call d-flex justify-content-lg-end">
                                <div class="ddf">
                                    <p><?php echo esc_html__( "Phone:", 'technix' ) ?></p>
                                    <span><a
                                            href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></span>
                                </div>
                            </div>
                            <?php endif;  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>