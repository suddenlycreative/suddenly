<?php
/**
 * Pre-footer
 *
 * @package octavian
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$args = array(
    'post_type' => 'pre_footer',
);

$query = new WP_Query( $args );
if ( ! $query->have_posts() ) { return; }


if ( $query->have_posts() ) : 
    while ( $query->have_posts() ) : $query->the_post(); 

        $blog = $single_post = $shop = $product = $project_single = false;
        if ( is_home() ) 
           $blog = byron_elementor( 'pre_footer_blog' );

        if ( is_singular( 'post' ) && ( byron_elementor( 'pre_footer_single_post' ) == 'yes') ) 
           $single_post = true;

        if ( byron_is_woocommerce_shop() && ( byron_elementor( 'pre_footer_shop' ) == 'yes') )
            $shop = true;

        if ( byron_is_woocommerce_page() && ( byron_elementor( 'pre_footer_product' ) == 'yes') )
            $product = true;

        if ( is_singular( 'project' ) && ( byron_elementor( 'pre_footer_project_single' ) == 'yes') ) 
           $project_single = true;

        if ( $single_post || $blog || $shop || $product || $project_single ) {
            the_content();
        }
    endwhile;
endif; 
wp_reset_postdata(); 
