<?php

/**
 * technix_scripts description
 * @return [type] [description]
 */
function technix_scripts() {

    /**
     * all css files
    */

    wp_enqueue_style( 'technix-fonts', technix_fonts_url(), array(), '1.0.0' );
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', TECHNIX_THEME_CSS_DIR.'bootstrap.rtl.min.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', TECHNIX_THEME_CSS_DIR.'bootstrap.css', array() );
    }
    wp_enqueue_style( 'animate', TECHNIX_THEME_CSS_DIR . 'animate.css', [] );
    wp_enqueue_style( 'swiper-bundle', TECHNIX_THEME_CSS_DIR . 'swiper-bundle.css', [] );
    wp_enqueue_style( 'splide', TECHNIX_THEME_CSS_DIR . 'splide.css', [] );
    wp_enqueue_style( 'slick', TECHNIX_THEME_CSS_DIR . 'slick.css', [] );
    wp_enqueue_style( 'nouislider', TECHNIX_THEME_CSS_DIR . 'nouislider.css', [] );
    wp_enqueue_style( 'magnific-popup', TECHNIX_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'font-awesome-pro', TECHNIX_THEME_CSS_DIR . 'font-awesome-pro.css', [] );
    wp_enqueue_style( 'spacing', TECHNIX_THEME_CSS_DIR . 'spacing.css', [] );
    wp_enqueue_style( 'technix-core', TECHNIX_THEME_CSS_DIR . 'technix-core.css', [], time() );
    wp_enqueue_style( 'technix-unit', TECHNIX_THEME_CSS_DIR . 'technix-unit.css', [], time() );
    wp_enqueue_style( 'technix-custom', TECHNIX_THEME_CSS_DIR . 'technix-custom.css', [] );
    wp_enqueue_style( 'technix-style', get_stylesheet_uri() );


    // all js
    wp_enqueue_script( 'waypoints', TECHNIX_THEME_JS_DIR . 'waypoints.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'bootstrap-bundle', TECHNIX_THEME_JS_DIR . 'bootstrap-bundle.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'mean-menu', TECHNIX_THEME_JS_DIR . 'meanmenu.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'swiper-bundle', TECHNIX_THEME_JS_DIR . 'swiper-bundle.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'splide', TECHNIX_THEME_JS_DIR . 'splide.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'slick', TECHNIX_THEME_JS_DIR . 'slick.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'purecounter', TECHNIX_THEME_JS_DIR . 'purecounter.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'nouislider', TECHNIX_THEME_JS_DIR . 'nouislider.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'magnific-popup', TECHNIX_THEME_JS_DIR . 'magnific-popup.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-nice-select', TECHNIX_THEME_JS_DIR . 'nice-select.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'wow', TECHNIX_THEME_JS_DIR . 'wow.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'gsap', TECHNIX_THEME_JS_DIR . 'gsap.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'split-text', TECHNIX_THEME_JS_DIR . 'split-text.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'scrool-triger', TECHNIX_THEME_JS_DIR . 'scrool-triger.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'scrollMagic', TECHNIX_THEME_JS_DIR . 'scrollMagic.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'parallax-scroll', TECHNIX_THEME_JS_DIR . 'parallax-scroll.js', [ 'jquery' ], false, true );
    // wp_enqueue_script( 'animation-gsap', TECHNIX_THEME_JS_DIR . 'animation.gsap.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'isotope-pkgd', TECHNIX_THEME_JS_DIR . 'isotope-pkgd.js', [ 'imagesloaded' ], false, true );
    wp_enqueue_script( 'jquery-appear', TECHNIX_THEME_JS_DIR . 'jquery-appear.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'jquery-knob', TECHNIX_THEME_JS_DIR . 'jquery-knob.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'vanilla-tilt', TECHNIX_THEME_JS_DIR . 'vanilla-tilt.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'technix-main', TECHNIX_THEME_JS_DIR . 'main.js', [ 'jquery' ], false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'technix_scripts' );

/*
Register Fonts
 */
function technix_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'technix' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?'. urlencode('family=DM+Sans:wght@400;500;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Raleway:wght@300;400;500;600;700;800;900&display=swap');
    }
    return $font_url;
}