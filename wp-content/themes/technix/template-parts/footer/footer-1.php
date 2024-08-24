<?php 

/**
 * Template part for displaying footer layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package technix
*/


// footer area links 
$footer_area_links = get_theme_mod( 'footer_area_links', __( '#', 'technix' ) );

$technix_footer_top_space = function_exists('get_field') ? get_field('technix_footer_top_space') : '0';


// footer bg color and image from customizer kirki plugin

$footer_bg_img = get_theme_mod( 'footer_bg_image' );
$footer_bg_color = get_theme_mod( 'footer_bg_color' );

// bg info from page
$technix_footer_bg_image = function_exists('tpmeta_image_field')? tpmeta_image_field('technix_footer_bg_image') : '';
$technix_footer_bg_color = function_exists('tpmeta_field')? tpmeta_field('technix_footer_bg_color') : '';

// bg img condition
$bg_image = $technix_footer_bg_image ? $technix_footer_bg_image['url'] : $footer_bg_img ;

// bg color condition
$bg_color = $technix_footer_bg_color ? $technix_footer_bg_color  : $footer_bg_color;

// main bg data
$bg_data = !empty($bg_image) ? "background-image: url(".$bg_image.")" : "background: ".$bg_color;
$footer_area_links_switch = get_theme_mod( 'footer_area_links_switch', false );


// footer_columns
$footer_columns = 0;
$footer_widgets = get_theme_mod( 'footer_widget_number', 3 );

for ( $num = 1; $num <= $footer_widgets; $num++ ) {
    if ( is_active_sidebar( 'footer-' . $num ) ) {
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
    $footer_class[1] = 'col-lg-3 col-md-6';
    $footer_class[2] = 'col-lg-3 col-md-6';
    $footer_class[3] = 'col-lg-3 col-md-6';
    $footer_class[4] = 'col-lg-3 col-md-6';
    break;
default:
    $footer_class = 'col-xl-3 col-lg-3 col-md-6';
    break;
}
?>

<!-- footer area start -->
<footer class="tp-footer-3-area p-relative" style="<?php echo esc_attr($bg_data); ?>">
    <div class="tp-footer-bg"></div>
    <div class="container">
        <?php if ( is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') ): ?>
        <div class="tp-footer-3-main-area">
            <div class="row">
                <?php
                if ( $footer_columns < 4 ) {
                print '<div class="col-lg-4 col-md-6">';
                dynamic_sidebar( 'footer-1' );
                print '</div>';

                print '<div class=col-lg-4 col-md-6">';
                dynamic_sidebar( 'footer-2' );
                print '</div>';

                print '<div class="col-lg-4 col-md-6">';
                dynamic_sidebar( 'footer-3' );
                print '</div>';
                } else {
                    for ( $num = 1; $num <= $footer_columns; $num++ ) {
                        if ( !is_active_sidebar( 'footer-' . $num ) ) {
                            continue;
                        }
                        print '<div class="' . esc_attr( $footer_class[$num] ) . '">';
                        dynamic_sidebar( 'footer-' . $num );
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