<?php 

	/**
	 * Template part for displaying header layout one
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package technix
	*/

	// info
    $header_topbar_switch = get_theme_mod( 'header_topbar_switch', false );

   // Email id 
   $header_top_email = get_theme_mod( 'header_email', __( 'technix@support.com', 'technix' ) );

   // Phone Number
   $header_top_phone = get_theme_mod( 'header_phone', __( '+88 01310-069824', 'technix' ) );

   // Header Address Text
   $header_top_address_text = get_theme_mod( 'header_address', __( '734 H, Bryan Burlington, NC 27215', 'technix' ) );

   // Header Address Link
   $header_top_address_link = get_theme_mod( 'header_address_link', __( '#', 'technix' ) );

   // Button Text
   $header_top_button_text = get_theme_mod( 'header_button_text', __( 'Get Started Today', 'technix' ) );

   // Button Text
   $header_top_button_link = get_theme_mod( 'header_button_link', __( '#', 'technix' ) );
   $header_language_switch = get_theme_mod( 'header_language_switch', __( 'false', 'technix' ) );

   // social links 
   $facebook = get_theme_mod( 'header_facebook_link', __( '#', 'technix' ) );
   $twitter = get_theme_mod( 'header_twitter_link', __( '#', 'technix' ) );
   $linkedin = get_theme_mod( 'header_linkedin_link', __( '#', 'technix' ) );

   // header right
   $technix_header_right = get_theme_mod( 'header_right_switch', false );
   $technix_menu_col = $technix_header_right ? 'col-xl-7 col-lg-8 d-none d-lg-block' : 'col-xl-10 col-lg-8 d-none d-lg-block';
   $technix_menu_end = $technix_header_right ? '' : 'justify-content-end';

   $header_search_switch = get_theme_mod( 'header_search_switch', false );


?>

<header class="tp-header-area tp-header-height p-relative">
   <?php if(!empty($header_topbar_switch)) : ?>
   <div class="tp-header-top tp-header-space d-none d-xl-block">
      <div class="container-fluid">
         <div class="row align-items-center">
            <div class="col-xxl-6 col-xl-8">
               <div class="tp-header-top-info">
                  <ul>
                     <?php  if ( !empty( $header_top_address_text ) ): ?>
                     <li>
                        <a href="<?php echo esc_attr($header_top_address_link); ?>" target="_blank"><span><i
                                 class="fa-sharp fa-solid fa-location-dot"></i></span><?php echo esc_html($header_top_address_text); ?></a>
                     </li>
                     <?php endif;  ?>
                     <?php  if ( !empty( $header_top_email ) ): ?>
                     <li>
                        <a href="mailto:<?php echo esc_attr($header_top_email); ?>"><span><i
                                 class="fa-solid fa-envelope"></i></span><?php echo esc_html($header_top_email); ?></a>
                     </li>
                     <?php endif;  ?>
                     <?php  if ( !empty( $header_language_switch ) ): ?>
                     <li>
                        <div class="tp-header-lang-wrapper d-flex align-items-center">
                           <div class="tp-header-lang-img">
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo/logo-lang.png"
                                 alt="">
                           </div>
                           <div class="tp-header-lang">
                              <?php echo technix_header_lang_defualt(); ?>
                           </div>
                        </div>
                     </li>
                     <?php endif;  ?>
                  </ul>
               </div>
            </div>
            <div class="col-xxl-6 col-xl-4">
               <div class="tp-header-top-right d-flex justify-content-end align-items-center">
                  <?php  if ( !empty( $header_top_phone ) ): ?>
                  <div class="header-call">
                     <a href="tel:<?php echo esc_attr($header_top_phone);?>"><i class="fa-solid fa-phone"></i>
                        <?php echo esc_html($header_top_phone); ?></a>
                  </div>
                  <?php endif;  ?>
                  <div class="header-social d-xxl-block d-none">
                     <?php  if ( !empty( $facebook ) ): ?>
                     <a href="<?php echo esc_attr( $facebook )  ?>"><i class="fa-brands fa-facebook"></i>
                        <?php echo esc_html__( "Facebook", 'technix') ?></a>
                     <?php endif; ?>
                     <?php  if ( !empty( $twitter ) ): ?>
                     <a href="<?php echo esc_attr( $twitter )  ?>"><i class="fa-brands fa-twitter"></i>
                        <?php echo esc_html__( "Twitter", 'technix') ?></a>
                     <?php endif; ?>
                     <?php  if ( !empty( $linkedin ) ): ?>
                     <a href="<?php echo esc_attr( $linkedin )  ?>"><i class="fa-brands fa-linkedin"></i>
                        <?php echo esc_html__( "Linkedin", 'technix') ?></a>
                     <?php endif; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php endif; ?>
   <div id="header-sticky" class="tp-header-bottom p-relative">
      <div class="tp-header-bottom-space p-relative">
         <div class="container-fluid">
            <div class="row  align-items-center">
               <div class="col-xl-2">
                  <div class="tp-header-main-left d-flex align-items-center p-relative">
                     <div class="tp-header-hamburger-btn offcanvas-open-btn d-none"
                        data-background="assets/img/icon/header-hamburger-shape.png">
                        <button class="hamburger-btn ">
                           <span>
                              <svg width="29" height="24" viewBox="0 0 29 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M0 1.13163C0 0.506972 0.499692 0 1.11538 0H20.4487C21.0644 0 21.5641 0.506972 21.5641 1.13163C21.5641 1.7563 21.0644 2.26327 20.4487 2.26327H1.11538C0.499692 2.26327 0 1.7563 0 1.13163ZM27.8846 10.5619H1.11538C0.499692 10.5619 0 11.0689 0 11.6935C0 12.3182 0.499692 12.8252 1.11538 12.8252H27.8846C28.5003 12.8252 29 12.3182 29 11.6935C29 11.0689 28.5003 10.5619 27.8846 10.5619ZM14.5 21.1238H1.11538C0.499692 21.1238 0 21.6308 0 22.2555C0 22.8801 0.499692 23.3871 1.11538 23.3871H14.5C15.1157 23.3871 15.6154 22.8801 15.6154 22.2555C15.6154 21.6308 15.1157 21.1238 14.5 21.1238Z"
                                    fill="currentColor" />
                              </svg>
                           </span>
                        </button>
                     </div>
                     <div class="tp-header-logo">
                        <?php technix_header_logo(); ?>
                     </div>
                  </div>
               </div>
               <div class="<?php echo esc_attr($technix_menu_col); ?>">
                  <div class="tp-main-menu-area d-flex align-items-center <?php echo esc_attr($technix_menu_end); ?>">
                     <div class="tp-main-menu">
                        <nav id="tp-mobile-menu">
                           <?php technix_header_menu(); ?>
                        </nav>
                     </div>
                  </div>
               </div>
               <?php if(!empty($technix_header_right)) : ?>
               <div class="col-xl-3">
                  <div class="tp-header-main-right d-flex align-items-center justify-content-xl-end">
                     <?php if(!empty($header_search_switch)) : ?>
                     <div class="tp-header-search search-open-btn d-none d-xxl-block">
                        <a href="javascript:void(0);"> <i class="fa-regular fa-magnifying-glass"></i></a>
                     </div>
                     <?php endif; ?>
                     <?php  if ( !empty( $header_top_button_text ) ): ?>
                     <div class="tp-header-btn d-none d-xl-block pl-40">
                        <a class="tp-btn"
                           href="<?php echo esc_url($header_top_button_link); ?>"><?php echo esc_html($header_top_button_text); ?></a>
                     </div>
                     <?php endif; ?>
                  </div>

                  <div class="tp-header-hamburger-btn offcanvas-open-btn d-xl-none"
                     data-background="assets/img/icon/header-hamburger-shape.png">
                     <button class="hamburger-btn ">
                        <span>
                           <svg width="29" height="24" viewBox="0 0 29 24" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                 d="M0 1.13163C0 0.506972 0.499692 0 1.11538 0H20.4487C21.0644 0 21.5641 0.506972 21.5641 1.13163C21.5641 1.7563 21.0644 2.26327 20.4487 2.26327H1.11538C0.499692 2.26327 0 1.7563 0 1.13163ZM27.8846 10.5619H1.11538C0.499692 10.5619 0 11.0689 0 11.6935C0 12.3182 0.499692 12.8252 1.11538 12.8252H27.8846C28.5003 12.8252 29 12.3182 29 11.6935C29 11.0689 28.5003 10.5619 27.8846 10.5619ZM14.5 21.1238H1.11538C0.499692 21.1238 0 21.6308 0 22.2555C0 22.8801 0.499692 23.3871 1.11538 23.3871H14.5C15.1157 23.3871 15.6154 22.8801 15.6154 22.2555C15.6154 21.6308 15.1157 21.1238 14.5 21.1238Z"
                                 fill="currentColor" />
                           </svg>
                        </span>
                     </button>
                  </div>

               </div>
               <?php endif; ?>

               <?php if(empty($technix_header_right)) : ?>
               <div class="col-xl-3 d-xl-none">
                  <div class="tp-header-hamburger-btn offcanvas-open-btn "
                     data-background="assets/img/icon/header-hamburger-shape.png">
                     <button class="hamburger-btn ">
                        <span>
                           <svg width="29" height="24" viewBox="0 0 29 24" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                 d="M0 1.13163C0 0.506972 0.499692 0 1.11538 0H20.4487C21.0644 0 21.5641 0.506972 21.5641 1.13163C21.5641 1.7563 21.0644 2.26327 20.4487 2.26327H1.11538C0.499692 2.26327 0 1.7563 0 1.13163ZM27.8846 10.5619H1.11538C0.499692 10.5619 0 11.0689 0 11.6935C0 12.3182 0.499692 12.8252 1.11538 12.8252H27.8846C28.5003 12.8252 29 12.3182 29 11.6935C29 11.0689 28.5003 10.5619 27.8846 10.5619ZM14.5 21.1238H1.11538C0.499692 21.1238 0 21.6308 0 22.2555C0 22.8801 0.499692 23.3871 1.11538 23.3871H14.5C15.1157 23.3871 15.6154 22.8801 15.6154 22.2555C15.6154 21.6308 15.1157 21.1238 14.5 21.1238Z"
                                 fill="currentColor" />
                           </svg>
                        </span>
                     </button>
                  </div>

               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </div>
</header>

<?php get_template_part( 'template-parts/header/header-side-info' ); ?>