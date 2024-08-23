<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package technix
 */
?>

<!doctype html>
<html <?php language_attributes();?>>

<head>
   <meta charset="<?php bloginfo( 'charset' );?>">
   <?php if ( is_singular() && pings_open( get_queried_object() ) ): ?>
   <?php endif;?>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="profile" href="https://gmpg.org/xfn/11">
   <?php wp_head();?>
</head>

<body <?php body_class();?>>

   <?php wp_body_open();?>


   <?php
        $technix_preloader = get_theme_mod( 'header_preloader_switch', false );
        $technix_backtotop = get_theme_mod( 'header_backtotop_switch', false );

        $technix_preloader_logo = get_template_directory_uri() . '/assets/img/logo/favicon.png';

        $preloader_logo = get_theme_mod('preloader_logo', $technix_preloader_logo);

    ?>


   <?php if ( !empty( $technix_backtotop ) ): ?>
   <!-- back to top start -->
   <div class="back-to-top-wrapper">
      <button id="back_to_top" type="button" class="back-to-top-btn">
         <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
               stroke-linejoin="round" />
         </svg>
      </button>
   </div>
   <!-- back to top end -->
   <?php endif;?>


   <?php if ( !empty( $technix_preloader ) ): ?>
   <!-- pre loader area start -->
   <div id="loading">
      <div id="loading-center">
         <div id="loading-center-absolute">
            <div class="object" id="object_four"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_one"></div>
         </div>
      </div>
   </div>
   <!-- pre loader area end -->
   <?php endif;?>

   <!-- header start -->
   <?php do_action( 'technix_header_style' );?>
   <!-- header end -->

   <!-- wrapper-box start -->
   <?php do_action( 'technix_before_main_content' );?>