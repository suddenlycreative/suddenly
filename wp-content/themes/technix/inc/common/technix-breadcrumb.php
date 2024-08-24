<?php
/**
 * Breadcrumbs for technix theme.
 *
 * @package     technix
 * @author      Theme_Pure
 * @copyright   Copyright (c) 2022, Theme_Pure
 * @link        https://www.weblearnbd.net
 * @since       technix 1.0.0
 */

function technix_breadcrumb_func() {
    global $post;  
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    if ( is_front_page() && is_home() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','technix'));
        $breadcrumb_class = 'home_front_page';
    }
    elseif ( is_front_page() ) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog','technix'));
        $breadcrumb_show = 0;
    }
    elseif ( is_home() ) {
        if ( get_option( 'page_for_posts' ) ) {
            $title = get_the_title( get_option( 'page_for_posts') );
        }
    }
    elseif ( is_single() && 'post' == get_post_type() ) {
      $title = get_the_title();
    } 
    elseif ( is_single() && 'product' == get_post_type() ) {
        $title = get_theme_mod( 'breadcrumb_product_details', __( 'Shop', 'technix' ) );
    } 
    elseif ( is_single() && 'courses' == get_post_type() ) {
      $title = esc_html__( 'Course Details', 'technix' );
    } 
    elseif ( is_search() ) {
        $title = esc_html__( 'Search Results for : ', 'technix' ) . get_search_query();
    } 
    elseif ( is_404() ) {
        $title = esc_html__( 'Page not Found', 'technix' );
    } 
    elseif ( is_archive() ) {
        $title = get_the_archive_title();
    } 
    else {
        $title = get_the_title();
    }
 


    $_id = get_the_ID();

    if ( is_single() && 'product' == get_post_type() ) { 
        $_id = $post->ID;
    } 
    elseif ( function_exists("is_shop") AND is_shop()  ) { 
        $_id = wc_get_page_id('shop');
    } 
    elseif ( is_home() && get_option( 'page_for_posts' ) ) {
        $_id = get_option( 'page_for_posts' );
    }

    $is_breadcrumb = function_exists('tpmeta_field')? tpmeta_field('technix_check_bredcrumb') : 'on';

    $con1 = $is_breadcrumb && ($is_breadcrumb== 'on') && $breadcrumb_show == 1;

    $con_main = is_404() ? is_404() : $con1;
    
      if (  $con_main ) {
        $bg_img_from_page = function_exists('tpmeta_image_field')? tpmeta_image_field('technix_breadcrumb_bg') : '';
        $hide_bg_img = function_exists('tpmeta_field')? tpmeta_field('technix_check_bredcrumb_img') : 'on';

        // get_theme_mod
        $bg_img = get_theme_mod( 'breadcrumb_image' );
        $breadcrumb_padding = get_theme_mod( 'breadcrumb_padding' );
        $breadcrumb_bg_color = get_theme_mod( 'breadcrumb_bg_color', '#f3fbfe' );

        if ( $hide_bg_img == 'off' ) {
            $bg_main_img = '';
        }else{  
            $bg_main_img = !empty( $bg_img_from_page ) ? $bg_img_from_page['url'] : $bg_img;
        }
        ?>




<!-- about breadcrumb area start -->
<section
    class="breadcrumb__area breadcrumb-style pt-190 pb-210 p-relative z-index-1 <?php print esc_attr( $breadcrumb_class );?>"
    data-background="<?php print esc_attr($bg_main_img);?>"
    style=" padding-top: <?php print esc_attr( $breadcrumb_padding['padding-top'] );?>;padding-bottom: <?php print esc_attr( $breadcrumb_padding['padding-bottom'] );?>">
    <div class="breadcrumb__bg-overlay m-img"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10">
                <div class="breadcrumb__content text-center">
                    <h3 class="breadcrumb__title"><?php echo technix_kses( $title ); ?></h3>
                    <?php if(function_exists('bcn_display')) : ?>
                    <div class="breadcrumb__list breadcrumb__list-translate">
                        <?php bcn_display(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about breadcrumb area end -->
<?php
      }
}

add_action( 'technix_before_main_content', 'technix_breadcrumb_func' );

// technix_search_form
function technix_search_form() {
    ?>
<!-- header-search-end -->

<!-- search popup start -->
<div class="search__popup">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="search__wrapper">
                    <div class="search__top d-flex justify-content-between align-items-center">
                        <div class="search__logo">
                            <img src="<?php echo esc_url( get_theme_mod("header_secondary_logo",get_template_directory_uri() . '/assets/img/logo/footer-logo.png') ); ?>">
                        </div>
                        <div class="search__close">
                            <button type="button" class="search__close-btn search-close-btn">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="search__form">
                        <form method="get" action="<?php print esc_url( home_url( '/' ) );?>">
                            <div class="search__input">
                                <input class="search-input-field" type="search" name="s"
                                    value="<?php print esc_attr( get_search_query() )?>"
                                    placeholder="<?php print esc_attr__( 'Type here to search...', 'technix' );?>">
                                <span class="search-focus-border"></span>
                                <button type="submit">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="search-popup-overlay"></div>
<!-- search popup end -->
<?php
}
add_action( 'technix_before_main_content', 'technix_search_form' );