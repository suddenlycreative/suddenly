<?php 

	/**
	 * Template part for displaying header layout two
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package technix
	*/

	 // info
    $technix_topbar_switch = get_theme_mod( 'header_topbar_switch', false );


     // Phone Number
   $header_top_phone = get_theme_mod( 'header_phone', __( '+88 01310-069824', 'technix' ) );

    // contact button
	$technix_button_text = get_theme_mod( 'technix_button_text', __( 'Make Request', 'technix' ) );
   $technix_button_link = get_theme_mod( 'technix_button_link', __( '#', 'technix' ) );

    // acc button
	$technix_acc_button_text = get_theme_mod( 'technix_acc_button_text', __( 'Login', 'technix' ) );
   $technix_acc_button_link = get_theme_mod( 'technix_acc_button_link', __( '#', 'technix' ) );

    $technix_site_logo = get_theme_mod( 'logo', get_template_directory_uri() . '/assets/img/logo/logo-white.png' );

    // Header Address Text
    $header_top_address_text = get_theme_mod( 'header_address', __( '734 H, Bryan Burlington, NC 27215', 'technix' ) );

    // Header Address Link
    $header_top_address_link = get_theme_mod( 'header_address_link', __( '#', 'technix' ) );

    // Header Office date
    $header_top_office_date = get_theme_mod( 'header_top_office_time', __( 'Friday - Jul 27, 2023', 'technix' ) );

    // Header Office Time
    $header_top_office_time = get_theme_mod( 'header_top_office_time', __( '<i class="fa-solid fa-clock"></i> Open Hours of City Govt. (Mon - Fri: <span>8.00</span> am - <span>6.00</span> pm)', 'technix' ) );

    //Header Button Text
    $header_button_text = get_theme_mod('header_button_text', __( 'Get A Quote', 'technix' ) );
    $header_button_link = get_theme_mod('header_button_link', __( '#', 'technix' ) );
       // header right
   $technix_header_right = get_theme_mod( 'header_right_switch', false );
   $technix_menu_col = $technix_header_right ? 'col-xxl-6 col-xl-6 col-lg-8 d-none d-lg-block' : 'col-xxl-9 col-xl-9 col-lg-8 d-none d-lg-block text-end';
    $header_search_switch = get_theme_mod( 'header_search_switch', false );

?>


<header class="tp-header-2-area tp-header-height p-relative">
   <?php  if ( !empty( $technix_topbar_switch ) ): ?>
   <div class="tp-header-2-top tp-header-2-space d-none d-xl-block">
      <div class="container-fluid">
         <div class="row align-items-center">
            <?php  if ( !empty( $header_top_office_time ) ): ?>
            <div class="col-xl-6">
               <div class="tp-header-2-top-info">
                  <p>
                     <?php echo technix_kses( $header_top_office_time ) ?>
                  </p>
               </div>
            </div>
            <?php endif;  ?>
            <div class="col-xl-6">
               <div class="tp-header-2-top-right d-flex justify-content-end align-items-center">
                  <?php  if ( !empty( $header_top_office_date ) ): ?>
                  <div class="header-date">
                     <p><i class="fa-regular fa-calendar-days"></i> <?php echo esc_html( $header_top_office_date )?></p>
                  </div>
                  <?php endif;  ?>


                  <?php  if ( !empty( $header_top_address_text ) ): ?>
                  <div class="header-location">
                     <a href="<?php echo esc_attr( $header_top_address_link ) ?>"><i
                           class="fa-sharp fa-solid fa-location-dot"></i>
                        <?php echo esc_html( $header_top_address_text ) ?></a>
                  </div>
                  <?php endif;  ?>
                  <div class="header-social d-xxl-block d-none">
                     <?php technix_header_social_profiles(); ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php endif;  ?>

   <div id="header-sticky" class="tp-header-2-bottom p-relative">
      <div class="tp-header-2-bottom-inner p-relative"
         data-background="<?php echo get_template_directory_uri(); ?>/assets/img/hero/hero-2/header-bg.png">
         <div class="container-fluid gx-0">
            <div class="row gx-0 align-items-center">
               <div class="col-xxl-2 col-xl-2 col-lg-10 col-md-6">
                  <div
                     class="tp-header-2-main-left d-flex align-items-center justify-content-xl-center justify-content-xxl-end p-relative">
                     <div class="tp-header-2-logo">
                        <?php technix_header_logo(); ?>
                        <img class="logo-shape"
                           src="<?php echo get_template_directory_uri(); ?>/assets/img/hero/hero-2/logo-shape.png"
                           alt="">
                     </div>
                  </div>
               </div>
               <div class="col-xxl-6 col-xl-7 d-none d-xl-block">
                  <div class="tp-main-menu-2-area d-flex align-items-center">
                     <div class="tp-main-menu">
                        <nav id="tp-mobile-menu">
                           <?php technix_header_menu(); ?>
                        </nav>
                     </div>
                  </div>
               </div>
               <?php if(!empty($technix_header_right)) : ?>
               <div class="col-xxl-4 col-xl-3 col-lg-2 col-md-6">
                  <div class="tp-header-2-right d-none d-xxl-block">
                     <div class="tp-header-2-main-right d-flex align-items-center justify-content-xxl-end">
                        <?php  if ( !empty( $header_top_phone ) ): ?>
                        <div class="tp-header-2-phone d-flex align-items-center">
                           <div class="tp-header-2-phone-icon">
                              <i class="fa-solid fa-phone"></i>
                           </div>
                           <div class="tp-header-2-phone-content">
                              <span><?php echo esc_html__( "Phone: ", 'technix' ) ?><br> <a
                                    href="tel:<?php echo esc_attr( $header_top_phone ) ?>"><?php echo esc_html( $header_top_phone ) ?></a></span>
                           </div>
                        </div>
                        <?php endif;  ?>
                        <?php  if ( !empty( $header_button_text ) ): ?>
                        <div class="tp-header-2-btn">
                           <a href="<?php echo esc_attr( $header_button_link ); ?>">
                              <?php echo esc_html( $header_button_text ); ?> <i
                                 class="fa-regular fa-angle-right"></i></a>
                        </div>
                        <?php endif;  ?>
                        <?php if(!empty($header_search_switch)) : ?>
                        <div class="tp-header-search search-open-btn d-none d-xxl-block">
                           <a href="javascript:void(0);"> <i class="fa-regular fa-magnifying-glass"></i></a>
                        </div>
                        <?php endif;  ?>
                     </div>
                  </div>
                  <div class="tp-header-2-mobile-menu d-flex justify-content-end d-block d-xxl-none">
                     <div class="tp-header-2-hamburger-btn offcanvas-open-btn"
                        data-background="<?php echo get_template_directory_uri(); ?>/assets/img/icon/header-hamburger-shape.png">
                        <button class="hamburger-btn">
                           <span>
                              <svg width="29" height="24" viewBox="0 0 29 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                    d="M0 1.13163C0 0.506972 0.499692 0 1.11538 0H20.4487C21.0644 0 21.5641 0.506972 21.5641 1.13163C21.5641 1.7563 21.0644 2.26327 20.4487 2.26327H1.11538C0.499692 2.26327 0 1.7563 0 1.13163ZM27.8846 10.5619H1.11538C0.499692 10.5619 0 11.0689 0 11.6935C0 12.3182 0.499692 12.8252 1.11538 12.8252H27.8846C28.5003 12.8252 29 12.3182 29 11.6935C29 11.0689 28.5003 10.5619 27.8846 10.5619ZM14.5 21.1238H1.11538C0.499692 21.1238 0 21.6308 0 22.2555C0 22.8801 0.499692 23.3871 1.11538 23.3871H14.5C15.1157 23.3871 15.6154 22.8801 15.6154 22.2555C15.6154 21.6308 15.1157 21.1238 14.5 21.1238Z"
                                    fill="currentColor"></path>
                              </svg>
                           </span>
                        </button>
                     </div>
                  </div>
               </div>
               <?php endif; ?>
            </div>
         </div>
      </div>
   </div>
</header>


<?php get_template_part( 'template-parts/header/header-side-info-header-2' ); ?>