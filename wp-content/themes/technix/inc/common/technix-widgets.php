<?php 

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function technix_widgets_init() {

    $footer_style_2_switch = get_theme_mod( 'footer_layout_2_switch', true );
    $footer_style_3_switch = get_theme_mod( 'footer_layout_2_switch', true );

    /**
     * blog sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Blog Sidebar', 'technix' ),
        'id'            => 'blog-sidebar',
        'before_widget' => '<div id="%1$s" class="blog-sidebar__widget mb-55 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="blog-sidebar__widget-head mb-30"><h3 class="blog-sidebar__widget-title">',
        'after_title'   => '</h3></div>',
    ] );    

    /**
     * services sidebar
     */
    register_sidebar( [
        'name'          => esc_html__( 'Services Sidebar', 'technix' ),
        'id'            => 'tp-services-sidebar',
        'before_widget' => '<div id="%1$s" class="tp-service-widget-item mb-40 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="blog-sidebar__widget-head mb-30"><h3 class="blog-sidebar__widget-title">',
        'after_title'   => '</h3></div>',
    ] );


    $footer_widgets = get_theme_mod( 'footer_widget_number', 4 );

    // footer default
    for ( $num = 1; $num <= $footer_widgets; $num++ ) {
        register_sidebar( [
            'name'          => sprintf( esc_html__( 'Footer %1$s', 'technix' ), $num ),
            'id'            => 'footer-' . $num,
            'description'   => sprintf( esc_html__( 'Footer Column %1$s', 'technix' ), $num ),
            'before_widget' => '<div id="%1$s" class="tp-footer-widget tp-footer-3-col-'.$num.' mb-40 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="tp-footer-widget-title">',
            'after_title'   => '</h3>',
        ] );
    }

    // footer 2
    if ( $footer_style_2_switch ) {
        for ( $num = 1; $num <= $footer_widgets; $num++ ) {

            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'technix' ), $num ),
                'id'            => 'footer-2-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 2 : %1$s', 'technix' ), $num ),
                'before_widget' => '<div id="%1$s" class="tp-footer-widget tp-footer-2-col-'.$num.' mb-40 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="tp-footer-widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }    

    // footer 3
    if ( $footer_style_3_switch ) {
        for ( $num = 1; $num <= $footer_widgets + 1; $num++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Style 3 : %1$s', 'technix' ), $num ),
                'id'            => 'footer-3-' . $num,
                'description'   => sprintf( esc_html__( 'Footer Style 3 : %1$s', 'technix' ), $num ),
                'before_widget' => '<div id="%1$s" class="tp-footer-widget tp-footer-col-'.$num.' mb-40 %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="tp-footer-widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }    

}
add_action( 'widgets_init', 'technix_widgets_init' );