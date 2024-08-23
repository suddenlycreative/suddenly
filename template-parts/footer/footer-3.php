<?php 

/**
 * Template part for displaying footer layout three
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package technix
*/

    $footer_bg_img = get_theme_mod( 'technix_footer_bg' );
    $technix_footer_logo = get_theme_mod( 'technix_footer_logo' );
    $technix_footer_top_space = function_exists('get_field') ? get_field('technix_footer_top_space') : '0';
    $technix_copyright_center = $technix_footer_logo ? 'col-lg-4 offset-lg-4 col-md-6 text-right' : 'col-lg-12 text-center';
    $technix_footer_bg_url_from_page = function_exists( 'get_field' ) ? get_field( 'technix_footer_bg' ) : '';
    $technix_footer_bg_color_from_page = function_exists( 'get_field' ) ? get_field( 'technix_footer_bg_color' ) : '';
    $footer_bg_color = get_theme_mod( 'technix_footer_bg_color' );
    $footer_copyright_switch = get_theme_mod( 'footer_copyright_switch', false );

    // bg image
    $bg_img = !empty( $technix_footer_bg_url_from_page['url'] ) ? $technix_footer_bg_url_from_page['url'] : $footer_bg_img;

    // bg color
    $bg_color = !empty( $technix_footer_bg_color_from_page ) ? $technix_footer_bg_color_from_page : $footer_bg_color;
    // Email id 
   $header_top_email = get_theme_mod( 'header_email', __( 'technix@support.com', 'technix' ) );

    // Phone Number
   $header_top_phone = get_theme_mod( 'header_phone', __( '+88 01310-069824', 'technix' ) );


      // footer area links  switch
      $footer_area_links_switch = get_theme_mod( 'footer_area_links_switch', false );
      // footer area links 
    $footer_area_links = get_theme_mod( 'footer_area_links', __( '#', 'technix' ) );

    // footer_columns
    $footer_columns = 0;
    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    for ( $num = 1; $num <= $footer_widgets + 1; $num++ ) {
        if ( is_active_sidebar( 'footer-3-' . $num ) ) {
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
        $footer_class[1] = 'col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-7';
        $footer_class[2] = 'col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-5';
        $footer_class[3] = 'col-xxl-3 col-xl-2 col-lg-2 col-md-3 col-sm-5';
        $footer_class[4] = 'col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-7';
        break;
    case '5':
        $footer_class[1] = 'col-xl-2 col-lg-2 col-md-3 col-sm-4';
        $footer_class[2] = 'col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6';
        $footer_class[3] = 'col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6';
        $footer_class[4] = 'col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6';
        $footer_class[5] = 'col-xl-4 col-lg-4 col-md-8 col-sm-8';
        break;
    default:
        $footer_class = 'col-xl-3 col-lg-3 col-md-6';
        break;
    }

?>


<!-- footer area start -->
<footer class="tp-footer-area p-relative">
    <div class="tp-footer-bg" data-background="<?php print esc_url( $bg_img );?>"></div>
    <div class="tp-footer-top-shape"
        data-background="<?php echo get_template_directory_uri(); ?>/assets/img/footer/footer-top-bg.png"></div>
    <div class="container container-large">
        <div class="row">
            <div class="col-lg-12">
                <div class="tp-footer-top-area">
                    <div class="row align-items-center">
                        <?php  if ( !empty( $header_top_email ) ): ?>
                        <div class="col-lg-6">
                            <div class="tp-footer-top-contact">
                                <a href="mailto:<?php echo esc_attr( $header_top_email ); ?>"><?php echo esc_html__( "Contact us at" , 'technix') ?>
                                    <span><?php echo esc_html( $header_top_email ); ?></span></a>
                            </div>
                        </div>
                        <?php endif;  ?>
                        <?php  if ( !empty( $header_top_phone ) ): ?>

                        <div class="col-lg-6">
                            <div class="tp-footer-top-right d-flex justify-content-start justify-content-lg-end">
                                <div class="tp-footer-top-right-headphone">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer/headphone.png"
                                        alt="">
                                </div>
                                <div class="tp-footer-top-right-content">
                                    <p><?php echo esc_html__( "PERFECT SOLUTION From It Advisor" , 'technix') ?></p>
                                    <a
                                        href="tel:<?php echo esc_attr( $header_top_phone ); ?>"><?php echo esc_html( $header_top_phone ); ?></a>
                                </div>
                            </div>
                        </div>
                        <?php endif;  ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if ( is_active_sidebar('footer-3-1') OR is_active_sidebar('footer-3-2') OR is_active_sidebar('footer-3-3') OR is_active_sidebar('footer-3-4') ): ?>
        <div class="tp-footer-main-area">
            <div class="row">
                <?php
                if ( $footer_columns < 5 ) {
                print '<div class="col-xl-3 col-lg-4 col-md-6">';
                dynamic_sidebar( 'footer-3-1' );
                print '</div>';

                print '<div class="col-xl-3 col-lg-4 col-md-6">';
                dynamic_sidebar( 'footer-3-2' );
                print '</div>';

                print '<div class="col-xl-3 col-lg-4 col-md-6">';
                dynamic_sidebar( 'footer-3-3' );
                print '</div>';

                print '<div class="col-xl-3 col-lg-5 col-md-6">';
                dynamic_sidebar( 'footer-3-4' );
                print '</div>';
                } else {
                    for ( $num = 1; $num <= $footer_columns; $num++ ) {
                        if ( !is_active_sidebar( 'footer-3-' . $num ) ) {
                            continue;
                        }
                        print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                        dynamic_sidebar( 'footer-3-' . $num );
                        print '</div>';
                    }
                }
            ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="tp-footer-copyright-area p-relative">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="tp-footer-copyright-inner">
                        <p><?php print technix_copyright_text(); ?></p>
                    </div>
                </div>
                <?php  if ( !empty( $footer_area_links_switch ) ): ?>
                <?php  if ( !empty( $footer_area_links ) ): ?>
                <div class="col-md-12 col-lg-6">
                    <div class="tp-footer-copyright-inner text-lg-end">
                        <?php echo technix_kses( $footer_area_links ) ?>
                    </div>
                </div>
                <?php endif;  ?>

                <?php endif;  ?>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->